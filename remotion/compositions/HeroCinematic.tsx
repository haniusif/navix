import React from 'react';
import {
  AbsoluteFill,
  Img,
  staticFile,
  useCurrentFrame,
  useVideoConfig,
  interpolate,
} from 'remotion';
import { COLORS } from '../utils/theme';
import { EASE } from '../utils/math';
import { AnimatedGradient } from '../effects/AnimatedGradient';
import { GridOverlay } from '../effects/GridOverlay';
import { Glow } from '../effects/Glow';
import { Particles } from '../effects/Particles';
import { Grain } from '../effects/Grain';

export type HeroCinematicProps = {
  /** 'photo' = full marketing scene, 'none' = transparent motion overlay for the live site. */
  background?: 'photo' | 'color' | 'none';
  photoSrc?: string;
  /** Enable the slow Ken-Burns camera push on the photo. */
  kenBurns?: boolean;
  accent?: string;
};

/**
 * The signature hero motion. On the website it renders as a TRANSPARENT overlay
 * (background="none") layered above the existing hero photo but below the text —
 * adding drifting glow, parallax grid, floating embers and a light sweep without
 * changing a pixel of the finalized layout. In Studio (background="photo") it is
 * a complete, self-contained cinematic hero for marketing videos.
 */
export const HeroCinematic: React.FC<HeroCinematicProps> = ({
  background = 'photo',
  photoSrc,
  kenBurns = true,
  accent = COLORS.primary,
}) => {
  const frame = useCurrentFrame();
  const { durationInFrames } = useVideoConfig();

  // Slow cinematic camera push (Ken-Burns) on the photo layer.
  const zoom = kenBurns ? interpolate(frame, [0, durationInFrames], [1.06, 1.14]) : 1;
  const panX = kenBurns ? interpolate(frame, [0, durationInFrames], [0, -30]) : 0;

  // Diagonal light sweep across the frame, once per loop.
  const sweep = interpolate(
    (frame % 300) / 300,
    [0, 0.5, 1],
    [-120, 160, 160],
    { easing: EASE.inOut },
  );

  return (
    <AbsoluteFill style={{ overflow: 'hidden', backgroundColor: background === 'color' ? COLORS.bg : 'transparent' }}>
      {background === 'photo' && (
        <AbsoluteFill style={{ transform: `scale(${zoom}) translateX(${panX}px)` }}>
          <Img
            src={photoSrc ?? staticFile('images/hero.png')}
            style={{ width: '100%', height: '100%', objectFit: 'cover' }}
          />
          <AbsoluteFill
            style={{
              background:
                'linear-gradient(180deg, rgba(7,17,31,0.7) 0%, rgba(7,17,31,0.45) 40%, rgba(7,17,31,0.85) 100%)',
            }}
          />
        </AbsoluteFill>
      )}

      {/* drifting brand aurora */}
      <AbsoluteFill style={{ opacity: background === 'none' ? 0.5 : 0.7 }}>
        <AnimatedGradient
          colors={[accent, COLORS.primaryDeep, COLORS.info]}
          background="transparent"
          speed={0.7}
          opacity={0.6}
        />
      </AbsoluteFill>

      <GridOverlay cell={64} scroll={0.12} opacity={0.5} />
      <Glow x="82%" y="18%" size={720} color={accent} opacity={0.4} pulse={0.12} />
      <Particles count={30} color={COLORS.primaryLight} speed={16} opacity={0.45} />

      {/* light sweep */}
      <div
        style={{
          position: 'absolute',
          top: 0,
          left: `${sweep}%`,
          width: '30%',
          height: '100%',
          background:
            'linear-gradient(105deg, transparent, rgba(255,255,255,0.06), transparent)',
          transform: 'skewX(-12deg)',
          pointerEvents: 'none',
        }}
      />

      <Grain opacity={0.05} />
    </AbsoluteFill>
  );
};
