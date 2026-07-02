import React from 'react';

/**
 * Inline stroke icons (Feather-style) matching the website's iconography.
 * Kept as tiny components so KPI cards / widgets stay consistent across the
 * live site and rendered videos without external asset loading.
 */
const base = (paths: string[], props: React.SVGProps<SVGSVGElement> = {}) => (
  <svg
    width={props.width ?? 20}
    height={props.height ?? 20}
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    strokeWidth={1.9}
    strokeLinecap="round"
    strokeLinejoin="round"
    {...props}
  >
    {paths.map((d, i) => (
      <path key={i} d={d} />
    ))}
  </svg>
);

export const Icons = {
  check: (p?: React.SVGProps<SVGSVGElement>) => base(['M20 6L9 17l-5-5'], p),
  truck: (p?: React.SVGProps<SVGSVGElement>) =>
    base(['M1 3h15v13H1z', 'M16 8h4l3 3v5h-7V8z', 'M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z', 'M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z'], p),
  box: (p?: React.SVGProps<SVGSVGElement>) =>
    base(['M12 2L2 7l10 5 10-5-10-5z', 'M2 17l10 5 10-5', 'M2 12l10 5 10-5'], p),
  layers: (p?: React.SVGProps<SVGSVGElement>) =>
    base(['M12 2L2 7l10 5 10-5-10-5z', 'M2 17l10 5 10-5', 'M2 12l10 5 10-5'], p),
  clock: (p?: React.SVGProps<SVGSVGElement>) =>
    base(['M12 22a10 10 0 100-20 10 10 0 000 20z', 'M12 6v6l4 2'], p),
  pin: (p?: React.SVGProps<SVGSVGElement>) =>
    base(['M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z', 'M12 13a3 3 0 100-6 3 3 0 000 6z'], p),
  chart: (p?: React.SVGProps<SVGSVGElement>) =>
    base(['M3 3v18h18', 'M18 17V9', 'M13 17V5', 'M8 17v-3'], p),
  bolt: (p?: React.SVGProps<SVGSVGElement>) => base(['M13 2L3 14h9l-1 8 10-12h-9l1-8z'], p),
  scan: (p?: React.SVGProps<SVGSVGElement>) =>
    base(['M3 7V5a2 2 0 012-2h2', 'M17 3h2a2 2 0 012 2v2', 'M21 17v2a2 2 0 01-2 2h-2', 'M7 21H5a2 2 0 01-2-2v-2', 'M3 12h18'], p),
  globe: (p?: React.SVGProps<SVGSVGElement>) =>
    base(['M12 22a10 10 0 100-20 10 10 0 000 20z', 'M2 12h20', 'M12 2a15 15 0 010 20', 'M12 2a15 15 0 000 20'], p),
  shield: (p?: React.SVGProps<SVGSVGElement>) =>
    base(['M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z', 'M9 12l2 2 4-4'], p),
};
