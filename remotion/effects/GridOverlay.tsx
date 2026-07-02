import React from 'react';
import { AbsoluteFill, useCurrentFrame } from 'remotion';

export type GridOverlayProps = {
  cell?: number;
  color?: string;
  variant?: 'lines' | 'dots';
  /** Parallax scroll speed in px/frame. */
  scroll?: number;
  opacity?: number;
  /** Fade the grid out toward the edges. */
  mask?: boolean;
};

/** The website's faint tech grid, animated with a slow parallax scroll. */
export const GridOverlay: React.FC<GridOverlayProps> = ({
  cell = 60,
  color = 'rgba(255,255,255,0.05)',
  variant = 'lines',
  scroll = 0.15,
  opacity = 1,
  mask = true,
}) => {
  const frame = useCurrentFrame();
  const offset = (frame * scroll) % cell;

  const background =
    variant === 'dots'
      ? `radial-gradient(${color} 1px, transparent 1px)`
      : `linear-gradient(${color} 1px, transparent 1px), linear-gradient(90deg, ${color} 1px, transparent 1px)`;

  const maskStyle = mask
    ? {
        WebkitMaskImage:
          'radial-gradient(ellipse 75% 65% at center, black, transparent 72%)',
        maskImage:
          'radial-gradient(ellipse 75% 65% at center, black, transparent 72%)',
      }
    : {};

  return (
    <AbsoluteFill
      style={{
        backgroundImage: background,
        backgroundSize: `${cell}px ${cell}px`,
        backgroundPosition: `${offset}px ${offset}px`,
        opacity,
        pointerEvents: 'none',
        ...maskStyle,
      }}
    />
  );
};
