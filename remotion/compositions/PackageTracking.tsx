import React from 'react';
import { AbsoluteFill, useCurrentFrame, useVideoConfig, interpolate, spring } from 'remotion';
import { COLORS, FONTS } from '../utils/theme';
import { EASE } from '../utils/math';
import { Package } from '../components/Package';
import { Icons } from '../assets/icons';
import { AnimatedGradient } from '../effects/AnimatedGradient';

export type TrackStep = { label: string; icon: React.ReactNode };

export type PackageTrackingProps = {
  steps?: TrackStep[];
  accent?: string;
  transparent?: boolean;
};

const DEFAULT_STEPS: TrackStep[] = [
  { label: 'Order placed', icon: Icons.box() },
  { label: 'Picked & packed', icon: Icons.scan() },
  { label: 'In transit', icon: Icons.truck() },
  { label: 'Out for delivery', icon: Icons.pin() },
  { label: 'Delivered', icon: Icons.check() },
];

/**
 * A parcel tracking timeline: the progress bar fills, each milestone lights up
 * in turn, and a package glides along the track to the current status.
 */
export const PackageTracking: React.FC<PackageTrackingProps> = ({
  steps = DEFAULT_STEPS,
  accent = COLORS.primary,
  transparent = false,
}) => {
  const frame = useCurrentFrame();
  const { fps, durationInFrames } = useVideoConfig();
  const n = steps.length;

  const progress = interpolate(frame, [15, durationInFrames - 20], [0, 1], { extrapolateLeft: 'clamp', extrapolateRight: 'clamp', easing: EASE.inOut });
  const activeIndex = Math.min(n - 1, Math.floor(progress * (n - 1) + 0.5));

  return (
    <AbsoluteFill style={{ background: transparent ? 'transparent' : COLORS.bg, overflow: 'hidden', alignItems: 'center', justifyContent: 'center' }}>
      {!transparent && <AnimatedGradient background={COLORS.bg} colors={[accent, COLORS.info]} speed={0.35} opacity={0.16} />}

      <div style={{ width: '78%', position: 'relative' }}>
        {/* package gliding above the track */}
        <div style={{ position: 'absolute', top: -70, left: `${progress * 100}%`, transform: 'translateX(-50%)' }}>
          <Package size={64} accent={accent} />
        </div>

        {/* track */}
        <div style={{ position: 'relative', height: 6, background: COLORS.border, borderRadius: 4 }}>
          <div style={{ position: 'absolute', inset: 0, width: `${progress * 100}%`, background: `linear-gradient(90deg, ${accent}, ${COLORS.primaryLight})`, borderRadius: 4, boxShadow: `0 0 16px ${accent}` }} />
        </div>

        {/* milestones */}
        <div style={{ display: 'flex', justifyContent: 'space-between', marginTop: -24 }}>
          {steps.map((s, i) => {
            const on = i <= activeIndex;
            const pop = spring({ frame: frame - (15 + i * 12), fps, config: { damping: 14 } });
            return (
              <div key={i} style={{ textAlign: 'center', width: 140 }}>
                <div style={{ width: 44, height: 44, margin: '0 auto', borderRadius: '50%', display: 'grid', placeItems: 'center', color: on ? COLORS.bg : COLORS.muted, background: on ? accent : COLORS.surface, border: `2px solid ${on ? accent : COLORS.border}`, boxShadow: on ? `0 0 20px ${accent}88` : 'none', transform: `scale(${0.8 + pop * 0.2})` }}>
                  {React.isValidElement(s.icon) ? React.cloneElement(s.icon as React.ReactElement, { width: 20, height: 20 } as never) : s.icon}
                </div>
                <div style={{ marginTop: 12, fontSize: 14, fontFamily: FONTS.body, color: on ? COLORS.white : COLORS.muted }}>{s.label}</div>
              </div>
            );
          })}
        </div>
      </div>
    </AbsoluteFill>
  );
};
