import React from 'react';
import { AbsoluteFill, useCurrentFrame, useVideoConfig, interpolate } from 'remotion';
import { COLORS } from '../utils/theme';
import { EASE } from '../utils/math';
import { RobotArm } from '../components/RobotArm';
import { ConveyorBelt } from '../components/ConveyorBelt';
import { Package } from '../components/Package';
import { AnimatedGradient } from '../effects/AnimatedGradient';
import { Grain } from '../effects/Grain';

export type WarehouseAutomationProps = {
  accent?: string;
  transparent?: boolean;
};

/**
 * Automation cell: a conveyor feeds packages while a robotic arm performs a
 * looping pick-and-place. The arm joints and gripper are keyframed against a
 * normalized cycle so it feels mechanical and precise.
 */
export const WarehouseAutomation: React.FC<WarehouseAutomationProps> = ({
  accent = COLORS.primary,
  transparent = false,
}) => {
  const frame = useCurrentFrame();
  const { fps, width, height } = useVideoConfig();

  const beltOffset = frame * 3;
  const beltY = height * 0.62;

  // Pick-and-place cycle (2.4s).
  const cycleLen = fps * 2.4;
  const c = (frame % cycleLen) / cycleLen; // 0..1
  const shoulder = interpolate(c, [0, 0.25, 0.5, 0.75, 1], [-45, -10, -45, -70, -45], { easing: EASE.inOut });
  const elbow = interpolate(c, [0, 0.25, 0.5, 0.75, 1], [70, 30, 70, 95, 70], { easing: EASE.inOut });
  const gripping = c > 0.25 && c < 0.75;

  return (
    <AbsoluteFill style={{ background: transparent ? 'transparent' : COLORS.bg, overflow: 'hidden' }}>
      {!transparent && <AnimatedGradient background={COLORS.bg} colors={[accent, COLORS.info]} speed={0.4} opacity={0.18} />}

      {/* conveyor */}
      <div style={{ position: 'absolute', top: beltY, left: width * 0.08 }}>
        <ConveyorBelt width={width * 0.84} offset={beltOffset} />
      </div>

      {/* packages riding the belt */}
      {Array.from({ length: 6 }).map((_, i) => {
        const t = ((frame / fps) * 0.14 + i / 6) % 1;
        const x = width * 0.08 + t * width * 0.84;
        // packet dips out near the arm (mid) to simulate being picked
        const near = Math.abs(t - 0.5) < 0.05;
        return (
          <div key={i} style={{ position: 'absolute', left: x, top: beltY - 60, transform: 'translateX(-50%)', opacity: near ? interpolate(Math.abs(t - 0.5), [0, 0.05], [0, 1]) : 1 }}>
            <Package size={64} accent={accent} label={false} />
          </div>
        );
      })}

      {/* robotic arm centered over the belt */}
      <div style={{ position: 'absolute', top: beltY - 300, left: width * 0.5, transform: 'translateX(-50%)' }}>
        <RobotArm size={320} accent={accent} shoulder={shoulder} elbow={elbow} gripping={gripping} />
      </div>

      {/* status HUD */}
      <div style={{ position: 'absolute', top: 40, left: 40, display: 'flex', gap: 10, alignItems: 'center', color: COLORS.success, fontFamily: 'Space Grotesk, monospace', fontSize: 18 }}>
        <span style={{ width: 10, height: 10, borderRadius: '50%', background: COLORS.success, boxShadow: `0 0 10px ${COLORS.success}` }} />
        AUTOMATION ONLINE · {Math.round(interpolate(frame % 90, [0, 90], [980, 1040]))} u/hr
      </div>

      <Grain opacity={0.06} />
    </AbsoluteFill>
  );
};
