import React from 'react';
import { COLORS } from '../utils/theme';

export type ForkliftProps = {
  width?: number;
  accent?: string;
  /** Vertical fork lift in px (0 = ground). */
  forkLift?: number;
  wheelRotation?: number;
  carryingBox?: boolean;
  flip?: boolean;
};

/** Warehouse forklift with an animatable mast/forks and optional pallet. */
export const Forklift: React.FC<ForkliftProps> = ({
  width = 200,
  accent = COLORS.primary,
  forkLift = 0,
  wheelRotation = 0,
  carryingBox = true,
  flip = false,
}) => {
  const height = width * (150 / 200);
  return (
    <svg width={width} height={height} viewBox="0 0 200 150" style={{ transform: flip ? 'scaleX(-1)' : undefined, overflow: 'visible' }}>
      {/* mast */}
      <rect x={140} y={12} width={8} height={120} fill={COLORS.muted2} />
      <rect x={152} y={12} width={8} height={120} fill={COLORS.muted2} />
      {/* forks + carriage */}
      <g transform={`translate(0, ${-forkLift})`}>
        <rect x={138} y={104} width={24} height={12} fill={accent} />
        <rect x={160} y={112} width={34} height={7} fill={COLORS.muted} />
        {carryingBox && (
          <rect x={162} y={78} width={30} height={34} rx={3} fill={COLORS.surface2} stroke="#0a0f18" strokeWidth={1.5} />
        )}
      </g>
      {/* body */}
      <path d="M40 132 L40 80 Q40 72 48 72 L108 72 L128 96 L128 132 Z" fill={accent} />
      {/* cab frame */}
      <rect x={70} y={26} width={6} height={50} fill={COLORS.muted2} />
      <rect x={116} y={26} width={6} height={50} fill={COLORS.muted2} />
      <rect x={70} y={26} width={52} height={6} fill={COLORS.muted2} />
      {/* seat */}
      <rect x={84} y={60} width={22} height={14} rx={3} fill={COLORS.bg} />
      {/* wheels */}
      {[64, 116].map((cx) => (
        <g key={cx} transform={`translate(${cx}, 132)`}>
          <circle r={17} fill="#0a0f18" stroke={COLORS.muted2} strokeWidth={2} />
          <g transform={`rotate(${wheelRotation})`}>
            <rect x={-1.5} y={-14} width={3} height={8} fill={COLORS.muted2} />
            <rect x={-1.5} y={6} width={3} height={8} fill={COLORS.muted2} />
          </g>
        </g>
      ))}
    </svg>
  );
};
