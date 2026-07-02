import React from 'react';
import { AbsoluteFill } from 'remotion';

export type VignetteProps = {
  color?: string;
  strength?: number;
  /** Where the darkening starts (0..1 of the radius). */
  inner?: number;
};

/** Radial darkening at the edges — focuses the eye on center content. */
export const Vignette: React.FC<VignetteProps> = ({
  color = '#000',
  strength = 0.55,
  inner = 0.45,
}) => (
  <AbsoluteFill
    style={{
      pointerEvents: 'none',
      background: `radial-gradient(ellipse at center, transparent ${inner * 100}%, ${color} 140%)`,
      opacity: strength,
    }}
  />
);
