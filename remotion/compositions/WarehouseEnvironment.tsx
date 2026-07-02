import React from 'react';
import {
  AbsoluteFill,
  useCurrentFrame,
  useVideoConfig,
  interpolate,
  spring,
} from 'remotion';
import { COLORS } from '../utils/theme';
import { EASE } from '../utils/math';
import { WarehouseRack } from '../components/WarehouseRack';
import { Forklift } from '../components/Forklift';
import { useCamera } from '../animations/useCamera';
import { AnimatedGradient } from '../effects/AnimatedGradient';
import { Grain } from '../effects/Grain';
import { GridOverlay } from '../effects/GridOverlay';

export type WarehouseEnvironmentProps = {
  accent?: string;
  rackCount?: number;
  /** Slow dolly camera across the aisle. */
  camera?: boolean;
};

/**
 * An animated fulfillment centre: rows of racking that fill up as the scene
 * plays, a forklift trundling down the aisle, and a slow dolly camera. Shows
 * useCamera (virtual camera), staggered spring reveals and depth layering.
 */
export const WarehouseEnvironment: React.FC<WarehouseEnvironmentProps> = ({
  accent = COLORS.primary,
  rackCount = 4,
  camera = true,
}) => {
  const frame = useCurrentFrame();
  const { fps, width, height, durationInFrames } = useVideoConfig();

  const cam = useCamera({
    keyframes: [
      { at: 0, x: 60, scale: 1.12 },
      { at: 1, x: -80, scale: 1.0 },
    ],
  });

  const forkP = interpolate(frame, [0, durationInFrames], [0, 1], { easing: EASE.inOut });
  const forkX = interpolate(forkP, [0, 1], [-220, width * 0.7]);
  const forkLift = interpolate(
    Math.sin((frame / fps) * 1.5),
    [-1, 1],
    [0, 70],
  );

  return (
    <AbsoluteFill style={{ background: COLORS.bg, overflow: 'hidden' }}>
      <AnimatedGradient background={COLORS.bg} colors={[accent, COLORS.info]} speed={0.4} opacity={0.22} />
      {/* floor */}
      <div style={{ position: 'absolute', bottom: 0, width, height: height * 0.34, background: `linear-gradient(180deg, ${COLORS.secondary}, ${COLORS.bg})` }} />
      <GridOverlay cell={90} scroll={0.05} opacity={0.35} mask={false} />

      <AbsoluteFill style={{ transform: camera ? cam : undefined }}>
        {/* rack row */}
        <div style={{ position: 'absolute', bottom: height * 0.2, left: 0, width, display: 'flex', justifyContent: 'space-around', alignItems: 'flex-end' }}>
          {Array.from({ length: rackCount }).map((_, i) => {
            const s = spring({ frame: frame - i * 8, fps, config: { damping: 18 } });
            const fill = interpolate(frame - i * 12, [0, 90], [0, 1], { extrapolateLeft: 'clamp', extrapolateRight: 'clamp' });
            return (
              <div key={i} style={{ opacity: s, transform: `translateY(${interpolate(s, [0, 1], [60, 0])}px)` }}>
                <WarehouseRack width={300} fill={fill} seed={i + 1} color={accent} />
              </div>
            );
          })}
        </div>

        {/* forklift */}
        <div style={{ position: 'absolute', bottom: height * 0.16, left: forkX }}>
          <Forklift width={230} accent={accent} forkLift={forkLift} wheelRotation={(frame / fps) * 360} />
        </div>
      </AbsoluteFill>

      <Grain opacity={0.06} />
    </AbsoluteFill>
  );
};
