import React from 'react';
import { AbsoluteFill, useCurrentFrame, useVideoConfig, interpolate } from 'remotion';
import { COLORS, FONTS } from '../utils/theme';
import { useCounter } from '../animations/useCounter';
import { gridStagger } from '../animations/stagger';
import { AnimatedGradient } from '../effects/AnimatedGradient';
import { Icons } from '../assets/icons';

export type StatSpec = {
  to: number;
  suffix?: string;
  label: string;
  icon?: React.ReactNode;
};

export type StatsCounterProps = {
  stats?: StatSpec[];
  accent?: string;
  transparent?: boolean;
};

const DEFAULT_STATS: StatSpec[] = [
  { to: 12, suffix: '+', label: 'Regions covered', icon: Icons.globe() },
  { to: 8, suffix: 'M+', label: 'Deliveries completed', icon: Icons.truck() },
  { to: 50, suffix: 'K+', label: 'm² of warehousing', icon: Icons.box() },
  { to: 640, suffix: '+', label: 'Vehicles in fleet', icon: Icons.bolt() },
  { to: 500, suffix: '+', label: 'Active customers', icon: Icons.shield() },
];

const Stat: React.FC<{ spec: StatSpec; delay: number; accent: string }> = ({ spec, delay, accent }) => {
  const frame = useCurrentFrame();
  const rise = interpolate(frame - delay, [0, 20], [0, 1], { extrapolateLeft: 'clamp', extrapolateRight: 'clamp' });
  const value = useCounter({ to: spec.to, delay: delay + 4, durationInSeconds: 1.8, group: spec.to >= 1000 });
  return (
    <div style={{ opacity: rise, transform: `translateY(${interpolate(rise, [0, 1], [26, 0])}px)`, textAlign: 'center', padding: '0 20px' }}>
      <div style={{ width: 54, height: 54, margin: '0 auto 16px', borderRadius: 14, display: 'grid', placeItems: 'center', color: accent, background: `${accent}1f`, border: `1px solid ${accent}30` }}>
        {spec.icon}
      </div>
      <div style={{ fontFamily: FONTS.num, fontWeight: 700, fontSize: 60, color: COLORS.white, lineHeight: 1, letterSpacing: '-0.02em' }}>
        {value}
        <span style={{ color: accent }}>{spec.suffix}</span>
      </div>
      <div style={{ color: COLORS.muted, fontSize: 18, marginTop: 12, fontFamily: FONTS.body }}>{spec.label}</div>
    </div>
  );
};

/** The five headline statistics counting up in a staggered cascade. */
export const StatsCounter: React.FC<StatsCounterProps> = ({
  stats = DEFAULT_STATS,
  accent = COLORS.primary,
  transparent = false,
}) => (
  <AbsoluteFill style={{ background: transparent ? 'transparent' : COLORS.bg, overflow: 'hidden' }}>
    {!transparent && <AnimatedGradient background={COLORS.bg} colors={[accent, COLORS.info]} speed={0.4} opacity={0.2} />}
    <AbsoluteFill style={{ flexDirection: 'row', justifyContent: 'center', alignItems: 'center', gap: 10 }}>
      {stats.map((s, i) => (
        <Stat key={i} spec={s} accent={accent} delay={gridStagger(stats.length, i, 6)} />
      ))}
    </AbsoluteFill>
  </AbsoluteFill>
);
