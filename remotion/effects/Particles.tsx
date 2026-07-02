import React from 'react';
import { AbsoluteFill, useCurrentFrame, useVideoConfig, interpolate } from 'remotion';
import { COLORS } from '../utils/theme';
import { seeded } from '../utils/math';

export type ParticlesProps = {
  count?: number;
  color?: string;
  maxSize?: number;
  /** Vertical drift speed in px/sec. */
  speed?: number;
  opacity?: number;
};

/**
 * Deterministic floating dust / spark particles that drift upward and wrap.
 * Uses `seeded()` (not Math.random) so every render is identical — required
 * for frame-accurate video output.
 */
export const Particles: React.FC<ParticlesProps> = ({
  count = 36,
  color = COLORS.primaryLight,
  maxSize = 4,
  speed = 22,
  opacity = 0.5,
}) => {
  const frame = useCurrentFrame();
  const { fps, height } = useVideoConfig();
  const seconds = frame / fps;

  return (
    <AbsoluteFill style={{ pointerEvents: 'none', opacity }}>
      {Array.from({ length: count }).map((_, i) => {
        const x = seeded(i + 1) * 100;
        const size = 1 + seeded(i + 7) * maxSize;
        const drift = speed * (0.5 + seeded(i + 3));
        const startY = seeded(i + 5) * height;
        const y = (((startY - seconds * drift) % height) + height) % height;
        const twinkle = interpolate(
          Math.sin(seconds * 2 + i),
          [-1, 1],
          [0.2, 1],
        );
        return (
          <div
            key={i}
            style={{
              position: 'absolute',
              left: `${x}%`,
              top: y,
              width: size,
              height: size,
              borderRadius: '50%',
              background: color,
              opacity: twinkle,
              boxShadow: `0 0 ${size * 2}px ${color}`,
            }}
          />
        );
      })}
    </AbsoluteFill>
  );
};
