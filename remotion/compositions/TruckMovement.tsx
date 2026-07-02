import React from 'react';
import {
  AbsoluteFill,
  useCurrentFrame,
  useVideoConfig,
  interpolate,
  Sequence,
} from 'remotion';
import { Trail } from '@remotion/motion-blur';
import { COLORS } from '../utils/theme';
import { EASE } from '../utils/math';
import { Truck } from '../components/Truck';
import { Skyline } from '../components/Skyline';
import { AnimatedGradient } from '../effects/AnimatedGradient';
import { Glow } from '../effects/Glow';

export type TruckMovementProps = {
  accent?: string;
  /** Direction of travel. */
  direction?: 'ltr' | 'rtl';
  truckWidth?: number;
  showSkyline?: boolean;
  /** Add a motion-blur trail behind the truck. */
  motionBlur?: boolean;
};

/**
 * A NAVIX truck crossing a highway at dusk with parallax skyline, moving road
 * dashes, spinning wheels and an optional motion-blur trail. Demonstrates
 * <Trail> (motion blur) + parallax + spring-eased road markings.
 */
export const TruckMovement: React.FC<TruckMovementProps> = ({
  accent = COLORS.primary,
  direction = 'ltr',
  truckWidth = 460,
  showSkyline = true,
  motionBlur = true,
}) => {
  const frame = useCurrentFrame();
  const { width, height, durationInFrames, fps } = useVideoConfig();

  const progress = interpolate(frame, [0, durationInFrames], [0, 1], { easing: EASE.inOut });
  const startX = -truckWidth;
  const endX = width;
  const rawX = interpolate(progress, [0, 1], [startX, endX]);
  const x = direction === 'ltr' ? rawX : width - rawX - truckWidth;

  const wheelRotation = (frame / fps) * 520 * (direction === 'ltr' ? 1 : -1);
  const roadY = height * 0.78;
  const dashOffset = (frame * 26) % 90;

  const truck = (
    <div style={{ position: 'absolute', left: x, top: roadY - truckWidth * (150 / 420) + 6 }}>
      <Truck width={truckWidth} accent={accent} wheelRotation={wheelRotation} flip={direction === 'rtl'} />
    </div>
  );

  return (
    <AbsoluteFill style={{ background: COLORS.bg, overflow: 'hidden' }}>
      <AnimatedGradient background={COLORS.bg} colors={[accent, COLORS.info]} speed={0.5} opacity={0.3} />
      <Glow x="50%" y="30%" size={900} color={accent} opacity={0.25} />

      {showSkyline && (
        <>
          <div style={{ position: 'absolute', bottom: height * 0.22, left: -interpolate(progress, [0, 1], [0, 120]), width: width + 240 }}>
            <Skyline width={width + 240} height={260} color={COLORS.secondary} opacity={0.6} seed={3} />
          </div>
          <div style={{ position: 'absolute', bottom: height * 0.22, left: -interpolate(progress, [0, 1], [0, 220]), width: width + 240 }}>
            <Skyline width={width + 240} height={180} color={COLORS.surface} opacity={0.9} seed={9} buildings={18} />
          </div>
        </>
      )}

      {/* road */}
      <div style={{ position: 'absolute', top: roadY, left: 0, width, height: height - roadY, background: `linear-gradient(180deg, ${COLORS.secondary}, ${COLORS.bg})` }} />
      <svg style={{ position: 'absolute', top: roadY + (height - roadY) * 0.35, left: 0 }} width={width} height={6}>
        <line x1={-dashOffset} y1={3} x2={width} y2={3} stroke={accent} strokeWidth={4} strokeDasharray="44 46" opacity={0.7} />
      </svg>

      {motionBlur ? (
        <Trail layers={6} lagInFrames={1.2} trailOpacity={0.5}>
          {truck}
        </Trail>
      ) : (
        truck
      )}

      {/* headlight wash */}
      <Sequence from={0}>
        <div
          style={{
            position: 'absolute',
            top: roadY - 30,
            left: direction === 'ltr' ? x + truckWidth * 0.9 : x - truckWidth * 0.3,
            width: 260,
            height: 90,
            background: `radial-gradient(ellipse at ${direction === 'ltr' ? 'left' : 'right'}, ${COLORS.primaryLight}55, transparent 70%)`,
            filter: 'blur(6px)',
          }}
        />
      </Sequence>
    </AbsoluteFill>
  );
};
