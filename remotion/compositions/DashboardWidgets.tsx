import React from 'react';
import { AbsoluteFill, useCurrentFrame, useVideoConfig, interpolate, spring } from 'remotion';
import { COLORS, FONTS } from '../utils/theme';
import { seeded, EASE } from '../utils/math';
import { useCounter } from '../animations/useCounter';
import { Icons } from '../assets/icons';
import { AnimatedGradient } from '../effects/AnimatedGradient';

export type DashboardWidgetsProps = {
  accent?: string;
  transparent?: boolean;
};

const Panel: React.FC<{ children: React.ReactNode; style?: React.CSSProperties; delay: number }> = ({ children, style, delay }) => {
  const frame = useCurrentFrame();
  const { fps } = useVideoConfig();
  const s = spring({ frame: frame - delay, fps, config: { damping: 18 } });
  return (
    <div
      style={{
        background: COLORS.surface,
        border: `1px solid ${COLORS.border}`,
        borderRadius: 20,
        padding: 24,
        opacity: s,
        transform: `translateY(${interpolate(s, [0, 1], [30, 0])}px)`,
        boxShadow: '0 24px 60px -30px rgba(0,0,0,0.6)',
        ...style,
      }}
    >
      {children}
    </div>
  );
};

/** Live line + bar chart that draw on. */
const LineChart: React.FC<{ accent: string }> = ({ accent }) => {
  const frame = useCurrentFrame();
  const w = 460;
  const h = 180;
  const pts = Array.from({ length: 24 }, (_, i) => {
    const x = (w * i) / 23;
    const y = h - (0.25 + seeded(i + 2) * 0.55 + (i / 23) * 0.15) * h;
    return [x, y] as const;
  });
  const draw = interpolate(frame, [10, 70], [0, 1], { extrapolateLeft: 'clamp', extrapolateRight: 'clamp', easing: EASE.out });
  const shown = Math.max(2, Math.round(pts.length * draw));
  const line = pts.slice(0, shown).map((p, i) => `${i === 0 ? 'M' : 'L'}${p[0]},${p[1]}`).join(' ');
  const area = `${line} L${pts[shown - 1][0]},${h} L0,${h} Z`;
  return (
    <svg width="100%" viewBox={`0 0 ${w} ${h}`}>
      <defs>
        <linearGradient id="dwfill" x1="0" y1="0" x2="0" y2="1">
          <stop offset="0%" stopColor={accent} stopOpacity={0.3} />
          <stop offset="100%" stopColor={accent} stopOpacity={0} />
        </linearGradient>
      </defs>
      {[0.25, 0.5, 0.75].map((g) => (
        <line key={g} x1={0} y1={h * g} x2={w} y2={h * g} stroke={COLORS.border} />
      ))}
      <path d={area} fill="url(#dwfill)" />
      <path d={line} fill="none" stroke={accent} strokeWidth={3} strokeLinecap="round" strokeLinejoin="round" />
      {shown > 1 && <circle cx={pts[shown - 1][0]} cy={pts[shown - 1][1]} r={5} fill={accent} />}
    </svg>
  );
};

const Bars: React.FC<{ accent: string }> = ({ accent }) => {
  const frame = useCurrentFrame();
  return (
    <div style={{ display: 'flex', gap: 10, alignItems: 'flex-end', height: 120 }}>
      {Array.from({ length: 7 }).map((_, i) => {
        const target = 0.35 + seeded(i + 5) * 0.6;
        const grow = interpolate(frame - 20 - i * 4, [0, 24], [0, 1], { extrapolateLeft: 'clamp', extrapolateRight: 'clamp', easing: EASE.out });
        return <div key={i} style={{ flex: 1, height: `${target * grow * 100}%`, background: i === 5 ? accent : COLORS.surface2, borderRadius: 6 }} />;
      })}
    </div>
  );
};

const Tile: React.FC<{ label: string; to: number; suffix?: string; icon: React.ReactNode; accent: string; delay: number }> = ({ label, to, suffix, icon, accent, delay }) => {
  const value = useCounter({ to, suffix, delay: delay + 8, durationInSeconds: 1.5, group: to >= 1000 });
  return (
    <Panel delay={delay} style={{ padding: 20 }}>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', color: accent }}>{icon}<span style={{ color: COLORS.success, fontSize: 13 }}>▲</span></div>
      <div style={{ fontFamily: FONTS.num, fontWeight: 700, fontSize: 34, color: COLORS.white, marginTop: 12 }}>{value}</div>
      <div style={{ color: COLORS.muted, fontSize: 13 }}>{label}</div>
    </Panel>
  );
};

/** A logistics control-tower dashboard: KPI tiles, a live area chart and a bar chart. */
export const DashboardWidgets: React.FC<DashboardWidgetsProps> = ({ accent = COLORS.primary, transparent = false }) => (
  <AbsoluteFill style={{ background: transparent ? 'transparent' : COLORS.bg, overflow: 'hidden', padding: 60 }}>
    {!transparent && <AnimatedGradient background={COLORS.bg} colors={[accent, COLORS.info]} speed={0.35} opacity={0.16} />}
    <div style={{ position: 'relative', display: 'grid', gridTemplateColumns: '1.6fr 1fr', gridTemplateRows: 'auto auto', gap: 20, width: '100%', height: '100%' }}>
      <Panel delay={0} style={{ gridRow: '1 / span 2', display: 'flex', flexDirection: 'column' }}>
        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 16 }}>
          <span style={{ fontFamily: FONTS.display, fontWeight: 700, color: COLORS.white, fontSize: 20 }}>Throughput</span>
          <span style={{ color: COLORS.muted, fontSize: 13 }}>Last 24h</span>
        </div>
        <LineChart accent={accent} />
        <div style={{ marginTop: 24 }}>
          <div style={{ color: COLORS.muted, fontSize: 13, marginBottom: 10 }}>Orders by hub</div>
          <Bars accent={accent} />
        </div>
      </Panel>
      <Tile label="Orders today" to={18420} icon={Icons.box({ width: 22, height: 22 })} accent={accent} delay={8} />
      <Tile label="Fleet active" to={512} icon={Icons.truck({ width: 22, height: 22 })} accent={accent} delay={14} />
    </div>
  </AbsoluteFill>
);
