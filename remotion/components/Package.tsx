import React from 'react';
import { COLORS } from '../utils/theme';

export type PackageProps = {
  size?: number;
  accent?: string;
  /** Show a shipping label. */
  label?: boolean;
};

/** A parcel box with tape + label — the atom of the fulfillment scenes. */
export const Package: React.FC<PackageProps> = ({
  size = 90,
  accent = COLORS.primary,
  label = true,
}) => (
  <svg width={size} height={size} viewBox="0 0 100 100" style={{ overflow: 'visible' }}>
    {/* box top */}
    <polygon points="50,6 92,26 50,46 8,26" fill={COLORS.surface2} stroke={COLORS.border} strokeWidth={1.5} />
    {/* left face */}
    <polygon points="8,26 50,46 50,92 8,72" fill={COLORS.surface} stroke={COLORS.border} strokeWidth={1.5} />
    {/* right face */}
    <polygon points="92,26 50,46 50,92 92,72" fill={COLORS.secondary} stroke={COLORS.border} strokeWidth={1.5} />
    {/* tape */}
    <polygon points="50,6 62,12 62,54 50,46" fill={accent} opacity={0.85} />
    <polygon points="50,46 62,54 62,80 50,92" fill={accent} opacity={0.55} />
    {label && (
      <g>
        <rect x={16} y={40} width={20} height={14} rx={2} fill={COLORS.white} opacity={0.92} transform="skewY(15)" />
      </g>
    )}
  </svg>
);
