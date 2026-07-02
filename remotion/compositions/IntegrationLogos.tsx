import React from 'react';
import { AbsoluteFill, useCurrentFrame, useVideoConfig, interpolate, spring } from 'remotion';
import { COLORS, FONTS } from '../utils/theme';
import { LogoChip } from '../components/LogoChip';
import { AnimatedGradient } from '../effects/AnimatedGradient';
import { Glow } from '../effects/Glow';

export type IntegrationLogosProps = {
  logos?: string[];
  accent?: string;
  transparent?: boolean;
};

const DEFAULT_LOGOS = ['Shopify', 'Salla', 'Zid', 'Amazon', 'Noon', 'WooCommerce', 'Magento', 'SAP'];

/**
 * Integration constellation: partner logos orbit a central NAVIX hub, connected
 * by lines along which data pulses flow inward — "everything plugs into NAVIX".
 */
export const IntegrationLogos: React.FC<IntegrationLogosProps> = ({
  logos = DEFAULT_LOGOS,
  accent = COLORS.primary,
  transparent = false,
}) => {
  const frame = useCurrentFrame();
  const { fps, width, height } = useVideoConfig();
  const cx = width / 2;
  const cy = height / 2;
  const radius = Math.min(width, height) * 0.34;
  const n = logos.length;

  return (
    <AbsoluteFill style={{ background: transparent ? 'transparent' : COLORS.bg, overflow: 'hidden' }}>
      {!transparent && <AnimatedGradient background={COLORS.bg} colors={[accent, COLORS.info]} speed={0.35} opacity={0.16} />}
      <Glow x="50%" y="50%" size={520} color={accent} opacity={0.3} />

      {/* connective lines with inward pulses */}
      <svg style={{ position: 'absolute', inset: 0 }} width={width} height={height}>
        {logos.map((_, i) => {
          const angle = (i / n) * Math.PI * 2 - Math.PI / 2;
          const lx = cx + Math.cos(angle) * radius;
          const ly = cy + Math.sin(angle) * radius;
          const pulse = ((frame / fps) * 0.6 + i / n) % 1;
          const px = interpolate(pulse, [0, 1], [lx, cx]);
          const py = interpolate(pulse, [0, 1], [ly, cy]);
          return (
            <g key={i}>
              <line x1={lx} y1={ly} x2={cx} y2={cy} stroke={COLORS.border} strokeWidth={2} />
              <circle cx={px} cy={py} r={4} fill={accent} opacity={interpolate(pulse, [0, 0.1, 0.9, 1], [0, 1, 1, 0])} />
            </g>
          );
        })}
      </svg>

      {/* central hub */}
      <div style={{ position: 'absolute', left: cx, top: cy, transform: 'translate(-50%,-50%)' }}>
        <div style={{ width: 150, height: 150, borderRadius: 36, display: 'grid', placeItems: 'center', background: `linear-gradient(160deg, ${COLORS.surface2}, ${COLORS.surface})`, border: `1px solid ${accent}55`, boxShadow: `0 0 60px -10px ${accent}88`, fontFamily: FONTS.display, fontWeight: 800, fontSize: 30, color: COLORS.white }}>
          NAVI<span style={{ color: accent }}>X</span>
        </div>
      </div>

      {/* orbiting logo chips */}
      {logos.map((label, i) => {
        const angle = (i / n) * Math.PI * 2 - Math.PI / 2;
        const lx = cx + Math.cos(angle) * radius;
        const ly = cy + Math.sin(angle) * radius;
        const pop = spring({ frame: frame - i * 6, fps, config: { damping: 15 } });
        const active = interpolate(Math.sin((frame / fps) * 1.2 + i), [-1, 1], [0, 1]);
        return (
          <div key={i} style={{ position: 'absolute', left: lx, top: ly, transform: `translate(-50%,-50%) scale(${pop})`, opacity: pop }}>
            <LogoChip label={label} size={128} active={active} />
          </div>
        );
      })}
    </AbsoluteFill>
  );
};
