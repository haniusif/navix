import React, { useMemo } from 'react';
import { AbsoluteFill, useCurrentFrame } from 'remotion';

export type GrainProps = {
  opacity?: number;
  /** Frames the noise pattern reshuffles on (higher = calmer). */
  scrubEvery?: number;
  blendMode?: React.CSSProperties['mixBlendMode'];
};

/**
 * Cinematic film grain via an inline SVG turbulence filter. Adds the subtle
 * texture that keeps flat dark backgrounds from banding. Very light.
 */
export const Grain: React.FC<GrainProps> = ({
  opacity = 0.06,
  scrubEvery = 2,
  blendMode = 'overlay',
}) => {
  const frame = useCurrentFrame();
  const seed = Math.floor(frame / scrubEvery) % 12;
  const id = useMemo(() => `grain-${Math.round(Math.abs(Math.sin(seed) * 1000))}`, [seed]);

  return (
    <AbsoluteFill style={{ opacity, mixBlendMode: blendMode, pointerEvents: 'none' }}>
      <svg width="100%" height="100%">
        <filter id={id}>
          <feTurbulence
            type="fractalNoise"
            baseFrequency="0.85"
            numOctaves={2}
            seed={seed}
            stitchTiles="stitch"
          />
          <feColorMatrix type="saturate" values="0" />
        </filter>
        <rect width="100%" height="100%" filter={`url(#${id})`} />
      </svg>
    </AbsoluteFill>
  );
};
