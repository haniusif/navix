import React from 'react';
import { AbsoluteFill, useVideoConfig } from 'remotion';
import { TransitionSeries, linearTiming, springTiming } from '@remotion/transitions';
import { fade } from '@remotion/transitions/fade';
import { slide } from '@remotion/transitions/slide';
import { wipe } from '@remotion/transitions/wipe';
import { COLORS, FONTS } from '../utils/theme';

export type TransitionKind = 'fade' | 'slide' | 'wipe';

export type SectionTransitionProps = {
  /** Panels to play through. Defaults to three branded title cards. */
  panels?: React.ReactNode[];
  kind?: TransitionKind;
  /** Frames each panel holds before transitioning. */
  holdInFrames?: number;
  /** Frames the transition takes. */
  transitionInFrames?: number;
  accent?: string;
};

// Return type is intentionally loose: the three presentations have distinct
// prop generics that don't unify, but <TransitionSeries.Transition> accepts any.
// eslint-disable-next-line @typescript-eslint/no-explicit-any
const presentation = (kind: TransitionKind): any => {
  switch (kind) {
    case 'slide':
      return slide();
    case 'wipe':
      return wipe();
    default:
      return fade();
  }
};

const TitleCard: React.FC<{ title: string; sub: string; bg: string; accent: string }> = ({ title, sub, bg, accent }) => (
  <AbsoluteFill style={{ background: bg, alignItems: 'center', justifyContent: 'center', flexDirection: 'column', gap: 14 }}>
    <div style={{ fontFamily: FONTS.display, fontWeight: 800, fontSize: 72, color: COLORS.white, letterSpacing: '-0.02em' }}>
      {title.split(' ').map((w, i) => (
        <span key={i} style={{ color: i % 2 ? accent : COLORS.white }}>{w} </span>
      ))}
    </div>
    <div style={{ fontFamily: FONTS.body, fontSize: 24, color: COLORS.muted }}>{sub}</div>
  </AbsoluteFill>
);

/**
 * A reusable transition reel built on <TransitionSeries> — the mechanism for
 * stitching scenes together in marketing videos and for section-to-section
 * transitions. Swap `panels` for real scenes; `kind` picks fade / slide / wipe.
 */
export const SectionTransition: React.FC<SectionTransitionProps> = ({
  panels,
  kind = 'slide',
  holdInFrames = 60,
  transitionInFrames = 18,
  accent = COLORS.primary,
}) => {
  useVideoConfig();
  const content: React.ReactNode[] = panels ?? [
    <TitleCard key="a" title="Warehousing" sub="Smart storage at scale" bg={COLORS.bg} accent={accent} />,
    <TitleCard key="b" title="Fulfillment" sub="Pick · pack · ship" bg={COLORS.secondary} accent={accent} />,
    <TitleCard key="c" title="Delivered" sub="To the doorstep, on time" bg={COLORS.surface} accent={accent} />,
  ];

  const timing =
    kind === 'slide'
      ? springTiming({ config: { damping: 200 }, durationInFrames: transitionInFrames })
      : linearTiming({ durationInFrames: transitionInFrames });

  return (
    <AbsoluteFill style={{ background: COLORS.bg }}>
      <TransitionSeries>
        {content.map((node, i) => (
          <React.Fragment key={i}>
            <TransitionSeries.Sequence durationInFrames={holdInFrames}>
              {node as React.ReactElement}
            </TransitionSeries.Sequence>
            {i < content.length - 1 && (
              <TransitionSeries.Transition presentation={presentation(kind)} timing={timing} />
            )}
          </React.Fragment>
        ))}
      </TransitionSeries>
    </AbsoluteFill>
  );
};
