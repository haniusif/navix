import React from 'react';
import { COLORS } from '../utils/theme';

export type ConveyorBeltProps = {
  width?: number;
  /** Belt tread scroll offset (drive from frame). */
  offset?: number;
  color?: string;
};

/** A conveyor belt with rollers and moving tread segments. */
export const ConveyorBelt: React.FC<ConveyorBeltProps> = ({
  width = 640,
  offset = 0,
  color = COLORS.surface2,
}) => {
  const height = 70;
  const seg = 28;
  const treadOffset = ((offset % seg) + seg) % seg;
  return (
    <svg width={width} height={height} viewBox={`0 0 ${width} ${height}`}>
      <rect x={0} y={18} width={width} height={26} rx={13} fill={color} stroke={COLORS.border} />
      {/* tread */}
      {Array.from({ length: Math.ceil(width / seg) + 1 }).map((_, i) => (
        <rect key={i} x={i * seg - treadOffset} y={22} width={12} height={18} rx={2} fill="rgba(255,255,255,0.06)" />
      ))}
      {/* rollers */}
      {Array.from({ length: Math.floor(width / 60) }).map((_, i) => (
        <circle key={i} cx={30 + i * 60} cy={52} r={12} fill="#0a0f18" stroke={COLORS.muted2} strokeWidth={1.5}>
        </circle>
      ))}
    </svg>
  );
};
