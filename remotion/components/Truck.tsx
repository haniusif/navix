import React from 'react';
import { COLORS } from '../utils/theme';

export type TruckProps = {
  width?: number;
  /** Brand color for the cab/accents. */
  accent?: string;
  bodyColor?: string;
  /** Rotation of the wheels in degrees (drive it with frame for rolling). */
  wheelRotation?: number;
  /** Show the NAVIX wordmark on the trailer. */
  branded?: boolean;
  /** Face left instead of right. */
  flip?: boolean;
};

/**
 * Clean side-view semi-truck (Scania/Volvo silhouette). Wheels are separate
 * groups so a composition can spin them as the truck moves.
 */
export const Truck: React.FC<TruckProps> = ({
  width = 420,
  accent = COLORS.primary,
  bodyColor = COLORS.surface2,
  wheelRotation = 0,
  branded = true,
  flip = false,
}) => {
  const height = width * (150 / 420);
  const Wheel = ({ cx }: { cx: number }) => (
    <g transform={`translate(${cx}, 128)`}>
      <circle r={20} fill="#0a0f18" stroke={COLORS.muted2} strokeWidth={2} />
      <g transform={`rotate(${wheelRotation})`}>
        <circle r={9} fill={COLORS.surface2} />
        {[0, 60, 120, 180, 240, 300].map((a) => (
          <rect
            key={a}
            x={-1.5}
            y={-18}
            width={3}
            height={9}
            fill={COLORS.muted2}
            transform={`rotate(${a})`}
          />
        ))}
      </g>
    </g>
  );

  return (
    <svg
      width={width}
      height={height}
      viewBox="0 0 420 150"
      style={{ transform: flip ? 'scaleX(-1)' : undefined, overflow: 'visible' }}
    >
      {/* trailer */}
      <rect x={6} y={26} width={250} height={100} rx={8} fill={bodyColor} stroke={COLORS.border} strokeWidth={2} />
      {branded && (
        <text x={130} y={86} textAnchor="middle" fontFamily="Space Grotesk, sans-serif" fontWeight={800} fontSize={34} fill={COLORS.white} letterSpacing={1}>
          NAVI<tspan fill={accent}>X</tspan>
        </text>
      )}
      {/* chassis */}
      <rect x={6} y={126} width={402} height={8} fill="#0a0f18" />
      {/* cab */}
      <path d="M262 126 L262 54 Q262 44 272 44 L322 44 Q332 44 340 54 L372 96 L406 104 Q414 106 414 116 L414 126 Z" fill={accent} />
      <path d="M300 52 L332 52 Q338 52 342 58 L364 92 L306 92 Z" fill={COLORS.bg} opacity={0.85} />
      <rect x={402} y={108} width={12} height={14} rx={3} fill={COLORS.primaryLight} opacity={0.9} />
      <Wheel cx={70} />
      <Wheel cx={150} />
      <Wheel cx={330} />
    </svg>
  );
};
