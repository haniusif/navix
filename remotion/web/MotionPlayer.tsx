import React, { useEffect, useRef } from 'react';
import { Player, PlayerRef } from '@remotion/player';

export type MotionPlayerProps = {
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  component: React.ComponentType<any>;
  durationInFrames: number;
  fps: number;
  compositionWidth: number;
  compositionHeight: number;
  inputProps?: Record<string, unknown>;
  loop?: boolean;
  style?: React.CSSProperties;
};

/**
 * A performance-conscious wrapper around @remotion/player for embedding
 * compositions live on the website:
 *  - only plays while scrolled into view (IntersectionObserver → play/pause)
 *  - pauses when the browser tab is hidden
 *  - muted, chrome-less, non-interactive (pure background motion)
 * Reduced-motion is handled upstream (the island is never mounted at all when
 * the user prefers reduced motion), so the static UI shows through unchanged.
 */
export const MotionPlayer: React.FC<MotionPlayerProps> = ({
  component,
  durationInFrames,
  fps,
  compositionWidth,
  compositionHeight,
  inputProps,
  loop = true,
  style,
}) => {
  const ref = useRef<PlayerRef>(null);
  const hostRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const player = ref.current;
    const host = hostRef.current;
    if (!player || !host) return;

    let visible = false;
    const sync = () => {
      if (visible && !document.hidden) player.play();
      else player.pause();
    };

    const io = new IntersectionObserver(
      ([entry]) => {
        visible = entry.isIntersecting;
        sync();
      },
      { threshold: 0.05 },
    );
    io.observe(host);
    document.addEventListener('visibilitychange', sync);

    return () => {
      io.disconnect();
      document.removeEventListener('visibilitychange', sync);
    };
  }, []);

  return (
    <div ref={hostRef} style={{ width: '100%', height: '100%' }}>
      <Player
        ref={ref}
        component={component}
        durationInFrames={durationInFrames}
        compositionWidth={compositionWidth}
        compositionHeight={compositionHeight}
        fps={fps}
        loop={loop}
        controls={false}
        clickToPlay={false}
        doubleClickToFullscreen={false}
        spaceKeyToPlayOrPause={false}
        initiallyMuted
        inputProps={inputProps}
        style={{ width: '100%', height: '100%', ...style }}
        renderLoading={() => <></>}
      />
    </div>
  );
};
