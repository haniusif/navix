import React from 'react';
import { AbsoluteFill, useCurrentFrame, useVideoConfig, interpolate } from 'remotion';
import { COLORS } from '../utils/theme';
import { KpiCard } from '../components/KpiCard';
import { Icons } from '../assets/icons';
import { useCounter } from '../animations/useCounter';
import { usePopIn } from '../animations/useEntrance';
import { AnimatedGradient } from '../effects/AnimatedGradient';
import { Glow } from '../effects/Glow';

export type KpiSpec = {
  label: string;
  icon: React.ReactNode;
  /** Numeric target for the counter. */
  to: number;
  decimals?: number;
  prefix?: string;
  suffix?: string;
  live?: boolean;
};

export type FloatingKpiCardsProps = {
  cards?: KpiSpec[];
  accent?: string;
  transparent?: boolean;
};

const DEFAULT_CARDS: KpiSpec[] = [
  { label: 'On-time delivery', icon: Icons.check(), to: 99.5, decimals: 1, suffix: '%' },
  { label: 'Shipments in transit', icon: Icons.truck(), to: 1240, prefix: '+', live: true },
  { label: 'Order accuracy', icon: Icons.layers(), to: 99.9, decimals: 1, suffix: '%' },
];

const FloatingCard: React.FC<{ spec: KpiSpec; index: number; accent: string }> = ({ spec, index, accent }) => {
  const frame = useCurrentFrame();
  const { fps } = useVideoConfig();
  const pop = usePopIn({ delay: index * 10 });
  const float = interpolate(Math.sin((frame / fps) * 1.4 + index * 1.6), [-1, 1], [-10, 10]);
  const value = useCounter({
    to: spec.to,
    decimals: spec.decimals,
    prefix: spec.prefix,
    suffix: spec.suffix,
    delay: index * 10 + 6,
    durationInSeconds: 1.8,
  });
  return (
    <div style={{ ...pop, transform: `${pop.transform} translateY(${float}px)` }}>
      <KpiCard label={spec.label} value={value} icon={spec.icon} accent={accent} live={spec.live} />
    </div>
  );
};

/** Floating KPI cards with spring pop-in, counter animation and idle float. */
export const FloatingKpiCards: React.FC<FloatingKpiCardsProps> = ({
  cards = DEFAULT_CARDS,
  accent = COLORS.primary,
  transparent = false,
}) => (
  <AbsoluteFill style={{ background: transparent ? 'transparent' : COLORS.bg, overflow: 'hidden' }}>
    {!transparent && (
      <>
        <AnimatedGradient background={COLORS.bg} colors={[accent, COLORS.info]} speed={0.5} opacity={0.25} />
        <Glow x="70%" y="40%" size={640} color={accent} opacity={0.3} />
      </>
    )}
    <AbsoluteFill style={{ flexDirection: 'column', justifyContent: 'center', alignItems: 'flex-end', gap: 20, padding: 60 }}>
      {cards.map((c, i) => (
        <FloatingCard key={i} spec={c} index={i} accent={accent} />
      ))}
    </AbsoluteFill>
  </AbsoluteFill>
);
