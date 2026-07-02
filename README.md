# NAVIX — Smart Logistics Website

Marketing website for **NAVIX** (smart logistics, fulfillment, warehousing, transportation, last-mile delivery). Built on Laravel + Blade with a dark-luxury design system, full bilingual **Arabic / English** support (RTL/LTR), a **Remotion** motion system, and a **live shipment-tracking** integration.

- **Live site:** https://navix.com.sa
- **Repo:** https://github.com/haniusif/navix

---

## Tech stack

| Area | Stack |
|------|-------|
| Backend | Laravel 13 (PHP **8.3+**), Jetstream, Livewire, Sanctum |
| Frontend | Blade + inline CSS design system, Vite 8 |
| Motion | Remotion 4 + React 19 (`@remotion/player` islands, lazy-loaded) |
| i18n | `lang/{ar,en}` + per-locale routes, RTL/LTR |
| Tracking API | Rushly public API (server-side proxied) |

---

## Pages & routes

| Route | Page |
|-------|------|
| `/` · `/en` | Home (landing) |
| `/track` · `/en/track` | Shipment tracking (live) |
| `/partners` · `/en/partners` | Partners |
| `/track/lookup/{id}` | JSON proxy for the tracking API (internal) |
| `/dashboard` | App dashboard (auth) |

Arabic is served at the bare paths; English at the `/en` prefix. The language switch toggles between the two.

---

## Local development

> **PHP version:** this app requires **PHP 8.3+**. If the default `php` is 8.2, use the 8.3 binary (e.g. `/opt/homebrew/opt/php@8.3/bin/php`) and put it first on `PATH` when running `artisan`/`composer`.

```bash
# install
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate      # SQLite by default (database/database.sqlite)

# run (two servers)
php artisan serve        # http://localhost:8000
npm run dev              # Vite dev server (http://localhost:5173)
```

The landing page loads its motion bundle via `@vite`, so the Vite dev server must be running in development.

---

## Environment

The tracking page calls the **Rushly** API through a server-side proxy so the API key is never exposed to the browser. Set in `.env`:

```env
RUSHLY_API_KEY=rxk_xxxxxxxxxxxxxxxxxxxxxxxx
RUSHLY_BASE_URL=https://navix.rushly.tech/api/public
```

`.env` is git-ignored — the key must be configured on each environment (see `.env.example` for the placeholders). After changing it: `php artisan config:clear`.

---

## Build & deploy

```bash
npm run build            # compiles Vite assets (required in production)
php artisan config:cache # optional
```

Production checklist:
1. `npm run build` — the homepage loads the Vite bundle for the live motion.
2. Set `RUSHLY_API_KEY` in the server environment (otherwise tracking returns "not configured").
3. Standard Laravel deploy (migrate, caches, storage link as needed).

Pushing to `main` triggers the GitHub Actions SSH deploy workflow.

---

## Internationalization

- Translations live in `lang/en/*.php` and `lang/ar/*.php` (`landing`, `tracking`, `partners`).
- `dir="rtl"` is applied for Arabic; layout uses logical CSS properties so components mirror automatically.

---

## Motion system (Remotion)

A reusable, brand-tuned motion system lives in [`/remotion`](remotion/README.md) — 16 configurable compositions (hero, warehouse, trucks, KPIs, route/supply-chain, barcode scan, integrations, CTA, etc.) that both render to marketing videos and embed live on the site.

```bash
npm run studio       # preview all compositions
npm run render:all   # render every composition to ./out/*.mp4
npm run render:web   # section-background videos -> public/motion/
```

On the website, approved compositions embed as lazy `@remotion/player` islands (hero background, CTA background, tracking route). They respect `prefers-reduced-motion`, defer to idle, code-split the runtime, and only play while in view.

---

## Shipment tracking

`/track` is fully live:

1. The browser posts the tracking id to `/track/lookup/{id}` (same-origin).
2. The Laravel proxy calls Rushly with the `X-API-Key` from config and returns the JSON.
3. The page renders the real `status_label` (colored badge), a **5-step progress bar** mapped from the numeric `status` (with a label-keyword fallback), the `events` timeline, meta fields, and a live route visualization — with empty and error states.

---

## Project structure

```
app/                    Laravel application
lang/{ar,en}/           translations (landing, tracking, partners)
public/images/          hero.png, navix-logo.png, partners/
remotion/               Remotion motion system (see remotion/README.md)
resources/
  js/motion.tsx         live-motion island bootstrap
  views/
    welcome.blade.php    home
    tracking.blade.php   shipment tracking
    partners.blade.php   partners
    layouts/site.blade.php  shared chrome (nav, footer, JS)
routes/web.php          routes + tracking proxy
config/services.php     Rushly config
```
