import React from 'react';
import { AbsoluteFill, useCurrentFrame, interpolate } from 'remotion';
import { COLORS } from '../utils/theme';

export type AnimatedGradientProps = {
  /** Two-or-more colors to cycle the aurora blobs through. */
  colors?: string[];
  /** Base fill behind the blobs. */
  background?: string;
  /** Animation speed multiplier. */
  speed?: number;
  /** Blur radius of the blobs in px. */
  blur?: number;
  opacity?: number;
};

/**
 * Slow, drifting "aurora" gradient — the ambient brand glow used behind the
 * hero and CTA. Pure CSS radial gradients driven by frame, so it's GPU-cheap
 * and renders crisply to video.
 */
export const AnimatedGradient: React.FC<AnimatedGradientProps> = ({
  colors = [COLORS.primary, COLORS.primaryDeep, COLORS.info],
  background = COLORS.bg,
  speed = 1,
  blur = 90,
  opacity = 0.55,
}) => {
  const frame = useCurrentFrame();
  const t = (frame * speed) / 100;

  const blob = (i: number, color: string) => {
    const phase = t + i * 2.1;
    const x = 50 + Math.sin(phase) * 28;
    const y = 50 + Math.cos(phase * 0.8) * 26;
    const scale = interpolate(Math.sin(phase * 0.6), [-1, 1], [0.8, 1.3]);
    return (
      <div
        key={i}
        style={{
          position: 'absolute',
          left: `${x}%`,
          top: `${y}%`,
          width: '55%',
          height: '55%',
          transform: `translate(-50%, -50%) scale(${scale})`,
          borderRadius: '50%',
          background: `radial-gradient(circle, ${color}, transparent 62%)`,
          filter: `blur(${blur}px)`,
          mixBlendMode: 'screen',
        }}
      />
    );
  };

  return (
    <AbsoluteFill style={{ background, opacity, overflow: 'hidden' }}>
      {colors.map((c, i) => blob(i, c))}
    </AbsoluteFill>
  );
};
