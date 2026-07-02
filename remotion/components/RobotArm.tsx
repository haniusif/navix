import React from 'react';
import { COLORS } from '../utils/theme';

export type RobotArmProps = {
  size?: number;
  accent?: string;
  /** Base joint angle (deg). */
  shoulder?: number;
  /** Elbow joint angle (deg). */
  elbow?: number;
  gripping?: boolean;
};

/** An articulated automation arm; drive `shoulder`/`elbow` for pick-and-place. */
export const RobotArm: React.FC<RobotArmProps> = ({
  size = 240,
  accent = COLORS.primary,
  shoulder = -30,
  elbow = 40,
  gripping = false,
}) => (
  <svg width={size} height={size} viewBox="0 0 240 240" style={{ overflow: 'visible' }}>
    {/* base */}
    <rect x={92} y={200} width={56} height={22} rx={5} fill={COLORS.surface2} stroke={COLORS.border} />
    <rect x={106} y={176} width={28} height={30} rx={4} fill={COLORS.muted2} />
    <g transform={`translate(120, 180) rotate(${shoulder})`}>
      {/* upper arm */}
      <rect x={-10} y={-96} width={20} height={100} rx={8} fill={accent} />
      <circle r={12} fill={COLORS.bg} stroke={accent} strokeWidth={4} />
      <g transform={`translate(0, -92) rotate(${elbow})`}>
        {/* forearm */}
        <rect x={-8} y={-84} width={16} height={88} rx={7} fill={COLORS.surface2} stroke={COLORS.border} />
        <circle r={10} fill={COLORS.bg} stroke={accent} strokeWidth={3} />
        {/* gripper */}
        <g transform="translate(0, -86)">
          <rect x={gripping ? -10 : -16} y={0} width={6} height={18} rx={2} fill={accent} />
          <rect x={gripping ? 4 : 10} y={0} width={6} height={18} rx={2} fill={accent} />
        </g>
      </g>
    </g>
  </svg>
);
