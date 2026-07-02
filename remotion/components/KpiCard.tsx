import React from 'react';
import { COLORS, FONTS } from '../utils/theme';

export type KpiCardProps = {
  label: string;
  value: string;
  icon?: React.ReactNode;
  accent?: string;
  width?: number;
  /** Optional sub value / delta line. */
  delta?: string;
  live?: boolean;
};

/**
 * The glassmorphic KPI card — pixel-matched to the website's `.kpi-card` so the
 * live hero player and the marketing video use the exact same chrome.
 */
export const KpiCard: React.FC<KpiCardProps> = ({
  label,
  value,
  icon,
  accent = COLORS.primary,
  width = 280,
  delta,
  live,
}) => (
  <div
    style={{
      width,
      display: 'flex',
      alignItems: 'center',
      gap: 16,
      padding: '18px 20px',
      borderRadius: 16,
      background: 'rgba(17, 28, 46, 0.55)',
      backdropFilter: 'blur(20px)',
      border: `1px solid ${COLORS.borderStrong}`,
      boxShadow: '0 24px 60px -24px rgba(0,0,0,0.6)',
      fontFamily: FONTS.body,
    }}
  >
    <div
      style={{
        width: 46,
        height: 46,
        flexShrink: 0,
        borderRadius: 13,
        display: 'grid',
        placeItems: 'center',
        color: COLORS.primaryLight,
        background: `linear-gradient(135deg, ${accent}47, ${accent}14)`,
        border: `1px solid ${accent}33`,
      }}
    >
      {icon}
    </div>
    <div style={{ display: 'flex', flexDirection: 'column', lineHeight: 1.2 }}>
      <span style={{ fontFamily: FONTS.num, fontWeight: 700, fontSize: 24, color: COLORS.white }}>
        {value}
      </span>
      <span style={{ fontSize: 13, color: COLORS.muted, display: 'flex', alignItems: 'center', gap: 6 }}>
        {live && (
          <span
            style={{
              width: 7,
              height: 7,
              borderRadius: '50%',
              background: COLORS.success,
              boxShadow: `0 0 0 4px ${COLORS.success}30`,
            }}
          />
        )}
        {label}
      </span>
      {delta && <span style={{ fontSize: 12, color: COLORS.success, marginTop: 2 }}>{delta}</span>}
    </div>
  </div>
);
