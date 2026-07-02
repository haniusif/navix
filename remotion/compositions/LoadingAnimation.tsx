import React from 'react';
import { AbsoluteFill, useCurrentFrame, useVideoConfig, interpolate } from 'remotion';
import { COLORS, FONTS } from '../utils/theme';
import { EASE } from '../utils/math';

export type LoadingAnimationProps = {
  accent?: string;
  label?: string;
  transparent?: boolean;
};

/**
 * A branded loader: the NAVIX chevron/route draws itself on a loop while a dot
 * travels the path — perfect as an app splash or a page-load overlay. Loops
 * seamlessly over its duration.
 */
export const LoadingAnimation: React.FC<LoadingAnimationProps> = ({
  accent = COLORS.primary,
  label = 'NAVIX',
  transparent = false,
}) => {
  const frame = useCurrentFrame();
  const { durationInFrames } = useVideoConfig();
  const loop = (frame % durationInFrames) / durationInFrames;

  // Draw on 0→0.5, hold, fade path 0.85→1 for a clean loop.
  const draw = interpolate(loop, [0, 0.5], [0, 1], { extrapolateRight: 'clamp', easing: EASE.inOut });
  const dot = interpolate(loop, [0.05, 0.6], [0, 1], { extrapolateLeft: 'clamp', extrapolateRight: 'clamp', easing: EASE.inOut });
  const ringRot = loop * 360;

  // Chevron path (the ">" motif from the brand).
  const path = 'M40 30 L90 80 L40 130';
  const dotX = interpolate(dot, [0, 0.5, 1], [40, 90, 40]);
  const dotY = interpolate(dot, [0, 0.5, 1], [30, 80, 130]);

  return (
    <AbsoluteFill style={{ background: transparent ? 'transparent' : COLORS.bg, alignItems: 'center', justifyContent: 'center', flexDirection: 'column', gap: 26 }}>
      <div style={{ position: 'relative', width: 160, height: 160 }}>
        {/* spinner ring */}
        <svg width={160} height={160} style={{ position: 'absolute', inset: 0, transform: `rotate(${ringRot}deg)` }}>
          <circle cx={80} cy={80} r={72} fill="none" stroke={COLORS.border} strokeWidth={4} />
          <circle cx={80} cy={80} r={72} fill="none" stroke={accent} strokeWidth={4} strokeLinecap="round" pathLength={1} strokeDasharray="0.25 0.75" />
        </svg>
        {/* drawing chevron */}
        <svg width={160} height={160} viewBox="0 0 130 160" style={{ position: 'absolute', inset: 0 }}>
          <path d={path} fill="none" stroke={accent} strokeWidth={12} strokeLinecap="round" strokeLinejoin="round" pathLength={1} strokeDasharray={1} strokeDashoffset={1 - draw} style={{ filter: `drop-shadow(0 0 8px ${accent})` }} />
          <circle cx={dotX} cy={dotY} r={7} fill={COLORS.white} />
        </svg>
      </div>
      <div style={{ fontFamily: FONTS.display, fontWeight: 800, letterSpacing: 6, fontSize: 22, color: COLORS.white, opacity: interpolate(loop, [0, 0.2], [0.3, 1], { extrapolateRight: 'clamp' }) }}>
        {label}
      </div>
    </AbsoluteFill>
  );
};
