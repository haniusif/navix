import React from 'react';
import { AbsoluteFill, useCurrentFrame, useVideoConfig, interpolate, spring } from 'remotion';
import { COLORS, FONTS } from '../utils/theme';
import { Icons } from '../assets/icons';
import { AnimatedGradient } from '../effects/AnimatedGradient';

export type FlowStage = { label: string; icon: React.ReactNode };

export type SupplyChainFlowProps = {
  stages?: FlowStage[];
  accent?: string;
  transparent?: boolean;
};

const DEFAULT_STAGES: FlowStage[] = [
  { label: 'Supplier', icon: Icons.box() },
  { label: 'Warehouse', icon: Icons.layers() },
  { label: 'Fulfillment', icon: Icons.scan() },
  { label: 'Transport', icon: Icons.truck() },
  { label: 'Customer', icon: Icons.pin() },
];

/**
 * The end-to-end supply chain as connected nodes with data packets flowing
 * between them — a continuous loop that reads as "one connected system".
 */
export const SupplyChainFlow: React.FC<SupplyChainFlowProps> = ({
  stages = DEFAULT_STAGES,
  accent = COLORS.primary,
  transparent = false,
}) => {
  const frame = useCurrentFrame();
  const { fps, width } = useVideoConfig();
  const n = stages.length;
  const gap = 1 / (n - 1);

  return (
    <AbsoluteFill style={{ background: transparent ? 'transparent' : COLORS.bg, overflow: 'hidden' }}>
      {!transparent && <AnimatedGradient background={COLORS.bg} colors={[accent, COLORS.info]} speed={0.35} opacity={0.16} />}
      <AbsoluteFill style={{ alignItems: 'center', justifyContent: 'center' }}>
        <div style={{ position: 'relative', width: '82%', display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
          {/* connective line */}
          <div style={{ position: 'absolute', left: 40, right: 40, top: 50, height: 3, background: COLORS.border }} />
          {/* flowing packets */}
          {Array.from({ length: n - 1 }).flatMap((_, seg) =>
            [0, 0.5].map((o, k) => {
              const t = ((frame / fps) * 0.5 + o + seg * 0.12) % 1;
              const segStart = 40;
              const segSpan = (width * 0.82 - 80) / (n - 1);
              const x = segStart + seg * segSpan + t * segSpan;
              return (
                <div
                  key={`${seg}-${k}`}
                  style={{
                    position: 'absolute',
                    left: x,
                    top: 50,
                    width: 10,
                    height: 10,
                    borderRadius: '50%',
                    background: accent,
                    boxShadow: `0 0 12px ${accent}`,
                    transform: 'translate(-50%,-50%)',
                    opacity: interpolate(t, [0, 0.1, 0.9, 1], [0, 1, 1, 0]),
                  }}
                />
              );
            }),
          )}
          {/* stage nodes */}
          {stages.map((s, i) => {
            const pop = spring({ frame: frame - i * 8, fps, config: { damping: 16 } });
            return (
              <div key={i} style={{ position: 'relative', zIndex: 2, textAlign: 'center', opacity: pop, transform: `scale(${pop})` }}>
                <div style={{ width: 100, height: 100, borderRadius: 26, display: 'grid', placeItems: 'center', color: accent, background: COLORS.surface, border: `1px solid ${accent}40`, boxShadow: `0 0 30px -8px ${accent}66` }}>
                  {React.isValidElement(s.icon) ? React.cloneElement(s.icon as React.ReactElement, { width: 34, height: 34 } as never) : s.icon}
                </div>
                <div style={{ marginTop: 14, color: COLORS.white, fontFamily: FONTS.display, fontWeight: 600, fontSize: 17 }}>{s.label}</div>
              </div>
            );
          })}
        </div>
      </AbsoluteFill>
    </AbsoluteFill>
  );
};
