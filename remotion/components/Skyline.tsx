import React from 'react';
import { COLORS } from '../utils/theme';
import { seeded } from '../utils/math';

export type SkylineProps = {
  width?: number;
  height?: number;
  color?: string;
  buildings?: number;
  seed?: number;
  opacity?: number;
};

/** A city skyline silhouette for hero/route backdrops (parallax-friendly). */
export const Skyline: React.FC<SkylineProps> = ({
  width = 1920,
  height = 240,
  color = COLORS.secondary,
  buildings = 26,
  seed = 1,
  opacity = 1,
}) => {
  const bw = width / buildings;
  return (
    <svg width={width} height={height} viewBox={`0 0 ${width} ${height}`} style={{ opacity }} preserveAspectRatio="none">
      {Array.from({ length: buildings }).map((_, i) => {
        const h = height * (0.35 + seeded(i + seed) * 0.6);
        const x = i * bw;
        return (
          <g key={i}>
            <rect x={x} y={height - h} width={bw - 4} height={h} fill={color} />
            {Array.from({ length: Math.floor(h / 26) }).map((_, r) =>
              seeded(i * 10 + r + seed) > 0.55 ? (
                <rect
                  key={r}
                  x={x + 6}
                  y={height - h + 8 + r * 26}
                  width={5}
                  height={7}
                  fill={COLORS.primaryLight}
                  opacity={0.5}
                />
              ) : null,
            )}
          </g>
        );
      })}
    </svg>
  );
};
