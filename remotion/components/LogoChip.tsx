import React from 'react';
import { COLORS, FONTS } from '../utils/theme';

export type LogoChipProps = {
  label: string;
  size?: number;
  /** 0..1 emphasis (scale + border highlight) for the "connect" moment. */
  active?: number;
};

/**
 * Integration logo tile matching the website's `.int-cell`. Uses the brand
 * name as a wordmark (swap in real SVG logos via /assets when available).
 */
export const LogoChip: React.FC<LogoChipProps> = ({ label, size = 150, active = 0 }) => (
  <div
    style={{
      width: size,
      height: size,
      display: 'grid',
      placeItems: 'center',
      textAlign: 'center',
      padding: 14,
      borderRadius: 18,
      background: `color-mix(in srgb, ${COLORS.surface2} ${active * 100}%, ${COLORS.surface})`,
      border: `1px solid ${active > 0.5 ? COLORS.primary + '59' : COLORS.border}`,
      transform: `translateY(${active * -8}px) scale(${1 + active * 0.04})`,
      boxShadow: active > 0.5 ? `0 20px 50px -20px ${COLORS.primary}55` : 'none',
      color: active > 0.5 ? COLORS.white : 'rgba(255,255,255,0.7)',
      fontFamily: FONTS.display,
      fontWeight: 700,
      fontSize: size * 0.11,
    }}
  >
    {label}
  </div>
);
