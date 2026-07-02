import React from 'react';
import { AbsoluteFill, useCurrentFrame, useVideoConfig, interpolate } from 'remotion';
import { COLORS } from '../utils/theme';
import { seeded } from '../utils/math';

export type CtaBackgroundProps = {
  /** 'orange' matches the site's CTA banner; 'dark' is a subtle variant. */
  variant?: 'orange' | 'dark';
  /** Transparent overlay for layering over the existing CTA gradient on the site. */
  transparent?: boolean;
};

/**
 * The CTA banner's living background: a warm animated gradient with a moving
 * dot-matrix and a slow diagonal shimmer — matches `.cta-box` on the site and
 * loops seamlessly. On the website it mounts (transparent) over the existing
 * gradient to add life without altering the button/text layout.
 */
export const CtaBackground: React.FC<CtaBackgroundProps> = ({
  variant = 'orange',
  transparent = false,
}) => {
  const frame = useCurrentFrame();
  const { width, height, durationInFrames } = useVideoConfig();

  const base =
    variant === 'orange'
      ? `linear-gradient(135deg, ${COLORS.primary}, ${COLORS.primaryDeep})`
      : `linear-gradient(135deg, ${COLORS.surface2}, ${COLORS.secondary})`;

  const dotShift = (frame * 0.4) % 22;
  const shimmer = interpolate((frame % durationInFrames) / durationInFrames, [0, 1], [-40, 140]);
  const dotColor = variant === 'orange' ? 'rgba(255,255,255,0.16)' : 'rgba(255,255,255,0.06)';

  return (
    <AbsoluteFill style={{ overflow: 'hidden', background: transparent ? 'transparent' : base }}>
      {/* drifting dot matrix */}
      <AbsoluteFill
        style={{
          backgroundImage: `radial-gradient(${dotColor} 1.5px, transparent 1.5px)`,
          backgroundSize: '22px 22px',
          backgroundPosition: `${dotShift}px ${dotShift}px`,
          opacity: 0.6,
        }}
      />
      {/* soft moving light blobs */}
      {Array.from({ length: 3 }).map((_, i) => {
        const x = 50 + Math.sin(frame / 60 + i * 2) * 30;
        const y = 50 + Math.cos(frame / 70 + i) * 30;
        return (
          <div key={i} style={{ position: 'absolute', left: `${x}%`, top: `${y}%`, width: 420, height: 420, transform: 'translate(-50%,-50%)', borderRadius: '50%', background: `radial-gradient(circle, ${seeded(i) > 0.5 ? '#ffffff22' : COLORS.primaryLight + '22'}, transparent 65%)`, filter: 'blur(40px)' }} />
        );
      })}
      {/* diagonal shimmer */}
      <div style={{ position: 'absolute', top: 0, left: `${shimmer}%`, width: width * 0.35, height, background: 'linear-gradient(105deg, transparent, rgba(255,255,255,0.12), transparent)', transform: 'skewX(-16deg)' }} />
    </AbsoluteFill>
  );
};
