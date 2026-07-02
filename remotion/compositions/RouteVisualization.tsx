import React from 'react';
import { AbsoluteFill, useCurrentFrame, useVideoConfig, interpolate } from 'remotion';
import { COLORS } from '../utils/theme';
import { EASE, bezier } from '../utils/math';
import { Node } from '../components/Node';
import { Truck } from '../components/Truck';
import { Skyline } from '../components/Skyline';
import { AnimatedGradient } from '../effects/AnimatedGradient';
import { GridOverlay } from '../effects/GridOverlay';

export type RouteStop = { x: number; y: number; label: string };

export type RouteVisualizationProps = {
  stops?: RouteStop[];
  accent?: string;
  transparent?: boolean;
};

const DEFAULT_STOPS: RouteStop[] = [
  { x: 0.12, y: 0.62, label: 'Riyadh' },
  { x: 0.4, y: 0.32, label: 'Dammam' },
  { x: 0.66, y: 0.55, label: 'Jeddah' },
  { x: 0.88, y: 0.3, label: 'NEOM' },
];

/**
 * A logistics route drawing across a stylized map: nodes ping in sequence, a
 * curved path draws with a strokeDashoffset reveal, and a vehicle marker rides
 * the path. Uses a cubic-bezier evaluator so the marker follows the real curve.
 */
export const RouteVisualization: React.FC<RouteVisualizationProps> = ({
  stops = DEFAULT_STOPS,
  accent = COLORS.primary,
  transparent = false,
}) => {
  const frame = useCurrentFrame();
  const { width, height, durationInFrames } = useVideoConfig();

  const pts = stops.map((s) => [s.x * width, s.y * height] as [number, number]);

  // Build a smooth path + control points per segment for the marker.
  const segments = pts.slice(0, -1).map((p, i) => {
    const n = pts[i + 1];
    const c1: [number, number] = [p[0] + (n[0] - p[0]) * 0.4, p[1]];
    const c2: [number, number] = [p[0] + (n[0] - p[0]) * 0.6, n[1]];
    return { p, n, c1, c2 };
  });
  const d = segments
    .map((s, i) => `${i === 0 ? `M${s.p[0]},${s.p[1]} ` : ''}C${s.c1[0]},${s.c1[1]} ${s.c2[0]},${s.c2[1]} ${s.n[0]},${s.n[1]}`)
    .join(' ');

  const drawP = interpolate(frame, [10, durationInFrames * 0.7], [0, 1], { extrapolateLeft: 'clamp', extrapolateRight: 'clamp', easing: EASE.inOut });

  // Marker position along the multi-segment curve.
  const totalT = drawP * segments.length;
  const segIdx = Math.min(segments.length - 1, Math.floor(totalT));
  const localT = totalT - segIdx;
  const seg = segments[segIdx];
  const [mx, my] = bezier(localT, seg.p, seg.c1, seg.c2, seg.n);

  return (
    <AbsoluteFill style={{ background: transparent ? 'transparent' : COLORS.bg, overflow: 'hidden' }}>
      {!transparent && <AnimatedGradient background={COLORS.bg} colors={[accent, COLORS.info]} speed={0.35} opacity={0.18} />}
      <GridOverlay cell={72} scroll={0.03} opacity={0.4} mask />
      <div style={{ position: 'absolute', bottom: 0, width, opacity: 0.25 }}>
        <Skyline width={width} height={200} />
      </div>

      <svg style={{ position: 'absolute', inset: 0 }} width={width} height={height}>
        <path d={d} fill="none" stroke={COLORS.borderStrong} strokeWidth={3} strokeDasharray="2 10" strokeLinecap="round" />
        <path
          d={d}
          fill="none"
          stroke={accent}
          strokeWidth={4}
          strokeLinecap="round"
          pathLength={1}
          strokeDasharray={1}
          strokeDashoffset={1 - drawP}
          style={{ filter: `drop-shadow(0 0 8px ${accent})` }}
        />
      </svg>

      {stops.map((s, i) => {
        const appear = interpolate(frame, [i * 14, i * 14 + 14], [0, 1], { extrapolateLeft: 'clamp', extrapolateRight: 'clamp' });
        const ping = ((frame - i * 14) % 60) / 60;
        return (
          <div key={i} style={{ position: 'absolute', left: s.x * width, top: s.y * height, transform: 'translate(-50%,-50%)', opacity: appear }}>
            <Node size={20} color={i === 0 ? accent : COLORS.info} pulse={ping > 0 ? ping : 0} label={s.label} active />
          </div>
        );
      })}

      {/* vehicle marker */}
      <div style={{ position: 'absolute', left: mx, top: my, transform: 'translate(-50%,-70%) scale(0.42)' }}>
        <Truck width={200} accent={accent} branded={false} />
      </div>
    </AbsoluteFill>
  );
};
