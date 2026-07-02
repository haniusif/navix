# NAVIX Motion System (Remotion)

A reusable, brand-tuned motion system built with [Remotion](https://remotion.dev).
Every composition is **configurable via props**, renders to **marketing videos**,
and a curated subset embeds **live on the website** as lazy React islands — all
sharing one source of truth for colors, components and animation curves.

## Folder structure

```
remotion/
├── Root.tsx            # registers every Composition (Studio + rendering)
├── index.ts            # registerRoot entry
├── compositions/       # the 16 top-level scenes (one per deliverable)
├── components/         # reusable SVG building blocks (Truck, Package, Rack…)
├── animations/         # hooks & helpers (useEntrance, useCounter, useCamera, stagger)
├── effects/            # visual layers (AnimatedGradient, Grain, Glow, ScanLine…)
├── assets/             # inline icon set (static assets go in /public)
├── utils/              # theme tokens, math/easing, reduced-motion
├── web/                # live-site embedding (MotionPlayer + registry)
└── scripts/            # render-all / render-web batch scripts
```

## Compositions

| ID | Purpose |
|----|---------|
| `HeroCinematic` | Hero background — photo Ken-Burns + aurora + embers + light sweep |
| `AmbientBackground` | General reusable looping section backdrop |
| `CtaBackground` | Animated warm gradient for the CTA banner |
| `TruckMovement` | Truck crossing with motion-blur trail + parallax skyline |
| `WarehouseEnvironment` | Racks filling + forklift + dolly camera |
| `WarehouseAutomation` | Robotic pick-and-place over a conveyor |
| `RouteVisualization` | Map route drawing with nodes + vehicle marker |
| `SupplyChainFlow` | Supplier→customer nodes with flowing data packets |
| `FloatingKpiCards` | KPI cards: spring pop-in + counters + idle float |
| `DashboardWidgets` | Control-tower dashboard with live charts |
| `StatsCounter` | The five headline stats counting up |
| `BarcodeScanner` | Laser scan + progressive barcode + verify |
| `PackageTracking` | Parcel status timeline |
| `IntegrationLogos` | Partner logos orbiting the NAVIX hub |
| `LoadingAnimation` | Branded chevron/route loader (loops) |
| `SectionTransition` | `<TransitionSeries>` reel (fade/slide/wipe) |

## Preview & render

```bash
npm run studio        # open Remotion Studio (live preview of all compositions)
npm run render:all    # render every composition to ./out/<id>.mp4
npm run render:web    # render section backgrounds to public/motion/*.mp4
# one-off:
npx remotion render remotion/index.ts HeroCinematic out/hero.mp4
```

> The first render downloads a headless Chromium (cached afterwards).

## Live embedding on the website (hybrid strategy)

Two marquee moments run **live** via `@remotion/player`; everything else is
meant to ship as pre-rendered `<video>` or stay in Studio for marketing.

Add motion to any element with a data attribute — no other markup changes:

```html
<div data-motion="hero" aria-hidden="true"></div>
<div data-motion="cta"  aria-hidden="true"></div>
<!-- optional per-mount overrides -->
<div data-motion="cta" data-motion-props='{"variant":"dark"}'></div>
```

Keys live in `remotion/web/registry.ts`. The bootstrap
(`resources/js/motion.tsx`, loaded via `@vite`) will:

- **skip entirely** when `prefers-reduced-motion: reduce` (static UI shows through),
- **defer** to `requestIdleCallback` so it never blocks first paint,
- **code-split** React + Player so the initial HTML stays framework-free,
- **play only in view** and **pause on hidden tab** (see `MotionPlayer.tsx`).

All web variants render with a transparent/`background:"none"` layer so they sit
*over* the finalized UI without altering it.

## Extending

1. Add a scene under `compositions/`, reusing `components/`, `effects/` and
   `animations/` (keep all randomness in `utils/math.ts#seeded` — never
   `Math.random()`, which breaks frame-accurate rendering).
2. Register it in `Root.tsx`.
3. (Optional) expose it live by adding an entry to `remotion/web/registry.ts`.

## Design tokens

`utils/theme.ts` mirrors the website palette (`#07111F` bg, `#FF7A1A` primary,
etc.), so videos and the live site stay perfectly on-brand.
