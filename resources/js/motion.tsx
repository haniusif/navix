/**
 * NAVIX live-motion bootstrap.
 *
 * Mounts approved Remotion compositions as lazy React islands into any element
 * with `data-motion="<key>"`. Loaded only on the landing page. It:
 *   - respects prefers-reduced-motion (bails entirely → static UI shows through)
 *   - defers mounting to idle time so it never blocks first paint
 *   - code-splits the player runtime so the initial HTML stays framework-free
 */
import { prefersReducedMotion } from '../../remotion/utils/reduced-motion';

const bootstrap = async () => {
  if (prefersReducedMotion()) return;

  const hosts = Array.from(
    document.querySelectorAll<HTMLElement>('[data-motion]'),
  );
  if (hosts.length === 0) return;

  // Code-split: only download React + Player + compositions when we actually
  // have something to mount and motion is allowed.
  const [{ createRoot }, React, { MotionPlayer }, { MOTION_REGISTRY }] =
    await Promise.all([
      import('react-dom/client'),
      import('react'),
      import('../../remotion/web/MotionPlayer'),
      import('../../remotion/web/registry'),
    ]);

  for (const host of hosts) {
    const key = host.dataset.motion as keyof typeof MOTION_REGISTRY;
    const entry = MOTION_REGISTRY[key];
    if (!entry) continue;

    // Merge any per-element JSON overrides: data-motion-props='{"variant":"dark"}'
    let overrides: Record<string, unknown> = {};
    if (host.dataset.motionProps) {
      try {
        overrides = JSON.parse(host.dataset.motionProps);
      } catch {
        /* ignore malformed props */
      }
    }

    const root = createRoot(host);
    root.render(
      React.createElement(MotionPlayer, {
        component: entry.component,
        durationInFrames: entry.durationInFrames,
        fps: entry.fps,
        compositionWidth: entry.width,
        compositionHeight: entry.height,
        loop: entry.loop,
        inputProps: { ...entry.inputProps, ...overrides },
      }),
    );
  }
};

const schedule =
  'requestIdleCallback' in window
    ? (cb: () => void) => (window as unknown as { requestIdleCallback: (cb: () => void) => void }).requestIdleCallback(cb)
    : (cb: () => void) => window.setTimeout(cb, 200);

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => schedule(bootstrap));
} else {
  schedule(bootstrap);
}
