@php
    $locale = app()->getLocale();
    $isRtl = $locale === 'ar';
    $dir = $isRtl ? 'rtl' : 'ltr';
    $switchUrl = $isRtl ? url('/en') : url('/');
    $homeUrl = $isRtl ? url('/') : url('/en');
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>{{ __('landing.meta.title') }}</title>
<meta name="description" content="{{ __('landing.meta.description') }}" />
<meta name="theme-color" content="#07111F" />
<link rel="alternate" hreflang="ar" href="{{ url('/') }}" />
<link rel="alternate" hreflang="en" href="{{ url('/en') }}" />
<meta property="og:title" content="{{ __('landing.meta.title') }}" />
<meta property="og:description" content="{{ __('landing.meta.description') }}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="{{ asset('images/hero.png') }}" />
<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Crect width='24' height='24' rx='5' fill='%2307111F'/%3E%3Ctext x='12' y='17' font-family='Arial' font-weight='900' font-size='14' fill='%23FF7A1A' text-anchor='middle'%3EX%3C/text%3E%3C/svg%3E">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="image" href="{{ asset('images/hero.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

{{-- Live Remotion motion islands (lazy, reduced-motion aware). Progressively enhances the hero & CTA. --}}
@viteReactRefresh
@vite(['resources/js/motion.tsx'])

<style>
  :root {
    --bg: #07111F;
    --secondary: #0F172A;
    --surface: #111C2E;
    --surface-2: #16233A;
    --primary: #FF7A1A;
    --primary-light: #FF9A4D;
    --primary-deep: #E8620A;
    --white: #FFFFFF;
    --muted: #94A3B8;
    --muted-2: #64748B;
    --border: rgba(255,255,255,0.08);
    --border-strong: rgba(255,255,255,0.14);

    --font-display: 'Tajawal', sans-serif;
    --font-body: 'IBM Plex Sans Arabic', 'Tajawal', sans-serif;
    --font-num: 'Space Grotesk', 'Tajawal', sans-serif;

    --container: 1200px;
    --r-sm: 10px;
    --r-md: 16px;
    --r-lg: 24px;
    --r-xl: 34px;

    --shadow-card: 0 24px 60px -24px rgba(0, 0, 0, 0.6);
    --shadow-glow: 0 20px 60px -18px rgba(255, 122, 26, 0.45);
    --ease: cubic-bezier(0.22, 1, 0.36, 1);
  }

  [dir="ltr"] {
    --font-display: 'Space Grotesk', 'Inter', sans-serif;
    --font-body: 'Inter', sans-serif;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }
  html { scroll-behavior: smooth; -webkit-text-size-adjust: 100%; }
  body {
    font-family: var(--font-body);
    background: var(--bg);
    color: var(--white);
    line-height: 1.65;
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
  }
  ::selection { background: rgba(255,122,26,0.35); color: #fff; }
  img { max-width: 100%; display: block; }

  a:focus-visible, button:focus-visible, input:focus-visible {
    outline: 2px solid var(--primary);
    outline-offset: 3px;
    border-radius: 6px;
  }

  .container { max-width: var(--container); margin: 0 auto; padding: 0 24px; }

  /* ---------- Typography helpers ---------- */
  .eyebrow {
    display: inline-flex; align-items: center; gap: 10px;
    font-family: var(--font-display); font-weight: 600;
    font-size: 12.5px; letter-spacing: 0.14em; text-transform: uppercase;
    color: var(--primary-light);
  }
  .eyebrow::before {
    content: ""; width: 26px; height: 1.5px;
    background: linear-gradient(90deg, var(--primary), transparent);
  }
  [dir="rtl"] .eyebrow::before {
    background: linear-gradient(270deg, var(--primary), transparent);
  }
  .section-head { max-width: 640px; margin-bottom: 60px; }
  .section-head.center { margin-inline: auto; text-align: center; }
  .section-head.center .eyebrow { justify-content: center; }
  .h-section {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: clamp(30px, 4.4vw, 52px);
    line-height: 1.08;
    letter-spacing: -0.02em;
    color: var(--white);
    margin-top: 18px;
  }
  .h-section .accent {
    background: linear-gradient(120deg, var(--primary-light), var(--primary));
    -webkit-background-clip: text; background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  .sub-section {
    color: var(--muted);
    font-size: 17px;
    margin-top: 18px;
    line-height: 1.7;
  }

  /* ---------- Buttons ---------- */
  .btn {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 15px 28px;
    border-radius: 999px;
    font-family: var(--font-display);
    font-weight: 700; font-size: 15px;
    cursor: pointer; border: none; text-decoration: none;
    transition: transform 0.3s var(--ease), box-shadow 0.3s var(--ease), background 0.3s var(--ease), color 0.3s var(--ease), border-color 0.3s var(--ease);
    position: relative; white-space: nowrap;
  }
  .btn-primary {
    background: linear-gradient(180deg, var(--primary-light), var(--primary));
    color: #1a0a00;
    box-shadow: var(--shadow-glow);
  }
  .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 26px 70px -16px rgba(255,122,26,0.6); }
  .btn-ghost {
    background: rgba(255,255,255,0.04);
    color: var(--white);
    border: 1px solid var(--border-strong);
    backdrop-filter: blur(8px);
  }
  .btn-ghost:hover { border-color: var(--primary); color: var(--primary-light); transform: translateY(-3px); }
  .btn .arrow { transition: transform 0.3s var(--ease); }
  [dir="rtl"] .btn .arrow { transform: scaleX(-1); }
  [dir="rtl"] .btn:hover .arrow { transform: scaleX(-1) translateX(4px); }
  [dir="ltr"] .btn:hover .arrow { transform: translateX(4px); }

  /* ---------- Navbar ---------- */
  .nav-wrap {
    position: fixed; top: 0; inset-inline: 0; z-index: 200;
    transition: background 0.4s var(--ease), backdrop-filter 0.4s var(--ease), border-color 0.4s var(--ease);
    border-bottom: 1px solid transparent;
  }
  .nav-wrap.scrolled {
    background: rgba(7, 17, 31, 0.72);
    backdrop-filter: blur(18px) saturate(140%);
    border-bottom: 1px solid var(--border);
  }
  nav {
    max-width: var(--container); margin: 0 auto;
    padding: 18px 24px;
    display: flex; align-items: center; justify-content: space-between; gap: 24px;
  }
  .brand { display: flex; align-items: center; text-decoration: none; }
  .brand-logo { display: block; height: 34px; width: auto; }
  .footer-brand .brand-logo { height: 40px; }
  .nav-links { display: flex; align-items: center; gap: 6px; list-style: none; }
  .nav-links > li { position: relative; }
  .nav-links > li > a {
    color: rgba(255,255,255,0.82); text-decoration: none;
    font-size: 14.5px; font-weight: 500; white-space: nowrap;
    padding: 10px 12px; border-radius: 10px;
    transition: color 0.2s, background 0.2s;
    display: inline-flex; align-items: center; gap: 6px;
  }
  .nav-links > li > a:hover { color: var(--white); background: rgba(255,255,255,0.05); }
  .nav-links > li > a.active { color: var(--primary-light); }
  .nav-links .chev { transition: transform 0.3s var(--ease); opacity: 0.6; }
  .has-mega:hover .chev { transform: rotate(180deg); }

  /* Mega menu */
  .mega {
    position: absolute; top: calc(100% + 10px);
    inset-inline-start: 50%; transform: translateX(-50%) translateY(10px);
    width: 620px; max-width: 90vw;
    background: rgba(17, 28, 46, 0.96);
    backdrop-filter: blur(24px);
    border: 1px solid var(--border-strong);
    border-radius: var(--r-lg);
    padding: 14px;
    box-shadow: var(--shadow-card);
    opacity: 0; visibility: hidden; pointer-events: none;
    transition: opacity 0.3s var(--ease), transform 0.3s var(--ease), visibility 0.3s;
    display: grid; grid-template-columns: 1fr 1fr; gap: 6px;
  }
  [dir="rtl"] .mega { transform: translateX(50%) translateY(10px); }
  .has-mega:hover .mega {
    opacity: 1; visibility: visible; pointer-events: auto;
    transform: translateX(-50%) translateY(0);
  }
  [dir="rtl"] .has-mega:hover .mega { transform: translateX(50%) translateY(0); }
  .mega-item {
    display: flex; gap: 12px; align-items: flex-start;
    padding: 12px; border-radius: var(--r-sm);
    text-decoration: none; transition: background 0.2s;
  }
  .mega-item:hover { background: rgba(255,255,255,0.05); }
  .mega-ico {
    width: 38px; height: 38px; flex-shrink: 0;
    border-radius: 10px;
    background: linear-gradient(135deg, rgba(255,122,26,0.22), rgba(255,122,26,0.06));
    color: var(--primary-light);
    display: grid; place-items: center;
    border: 1px solid rgba(255,122,26,0.18);
  }
  .mega-item h6 { font-size: 14px; color: var(--white); font-weight: 700; margin-bottom: 2px; font-family: var(--font-display); }
  .mega-item span { font-size: 12.5px; color: var(--muted); }

  .nav-cta { display: flex; align-items: center; gap: 10px; }
  .auth-link {
    color: rgba(255,255,255,0.82); text-decoration: none; white-space: nowrap;
    font-size: 14px; font-weight: 600; padding: 8px 12px;
    border-radius: 10px; transition: color 0.2s, background 0.2s;
  }
  .auth-link:hover { color: var(--white); background: rgba(255,255,255,0.05); }
  .lang-btn {
    background: rgba(255,255,255,0.05); color: var(--white);
    border: 1px solid var(--border); padding: 9px 14px;
    border-radius: 999px; font-size: 13px; font-weight: 600;
    cursor: pointer; display: flex; align-items: center; gap: 7px;
    text-decoration: none; font-family: var(--font-display);
    transition: all 0.25s var(--ease);
  }
  .lang-btn:hover { background: rgba(255,122,26,0.14); color: var(--primary-light); border-color: rgba(255,122,26,0.35); }
  .nav-cta .btn { padding: 11px 20px; font-size: 14px; }
  .menu-toggle { display: none; background: none; border: none; color: white; cursor: pointer; padding: 6px; }

  /* Mobile drawer */
  .drawer {
    position: fixed; inset: 0; z-index: 300;
    background: rgba(7,17,31,0.98); backdrop-filter: blur(20px);
    padding: 90px 28px 40px;
    transform: translateX(100%); transition: transform 0.4s var(--ease);
    display: flex; flex-direction: column; gap: 6px;
  }
  [dir="rtl"] .drawer { transform: translateX(-100%); }
  .drawer.open { transform: translateX(0); }
  .drawer a {
    color: var(--white); text-decoration: none; font-size: 20px;
    font-weight: 600; font-family: var(--font-display);
    padding: 14px 0; border-bottom: 1px solid var(--border);
  }
  .drawer .drawer-cta { margin-top: 24px; border: none; padding: 0; }
  .drawer-close { position: absolute; top: 26px; inset-inline-end: 24px; background: none; border: none; color: white; cursor: pointer; }

  /* ---------- Hero ---------- */
  .hero {
    position: relative; min-height: 100svh;
    display: flex; align-items: center;
    padding: 140px 0 90px; overflow: hidden;
  }
  .hero-bg { position: absolute; inset: 0; z-index: 0; }
  .hero-bg img { width: 100%; height: 100%; object-fit: cover; object-position: center; }
  .hero-bg::after {
    content: ""; position: absolute; inset: 0;
    background:
      linear-gradient(180deg, rgba(7,17,31,0.72) 0%, rgba(7,17,31,0.5) 40%, rgba(7,17,31,0.85) 100%),
      linear-gradient(to var(--fade-dir, right), rgba(7,17,31,0.94) 0%, rgba(7,17,31,0.7) 45%, rgba(7,17,31,0.25) 100%);
  }
  [dir="ltr"] { --fade-dir: right; }
  [dir="rtl"] { --fade-dir: left; }
  /* Remotion live-motion overlay — sits above the photo, below hero content. */
  .hero-motion { position: absolute; inset: 0; z-index: 1; pointer-events: none; overflow: hidden; }
  .cta-motion { position: absolute; inset: 0; z-index: 1; pointer-events: none; border-radius: inherit; overflow: hidden; }
  .hero-glow {
    position: absolute; z-index: 1; pointer-events: none;
    width: 620px; height: 620px; border-radius: 50%;
    background: radial-gradient(circle, rgba(255,122,26,0.16), transparent 65%);
    top: -140px; inset-inline-end: -120px; filter: blur(20px);
  }
  .hero .container { position: relative; z-index: 3; width: 100%; }
  .hero-inner { max-width: 720px; }
  .hero-badge {
    display: inline-flex; align-items: center; gap: 9px;
    background: rgba(255,255,255,0.06);
    border: 1px solid var(--border-strong);
    padding: 7px 14px 7px 10px; border-radius: 999px;
    font-size: 13px; color: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px); margin-bottom: 24px;
  }
  .hero-badge .dot { width: 7px; height: 7px; border-radius: 50%; background: #4ADE80; box-shadow: 0 0 0 4px rgba(74,222,128,0.18); }
  .hero h1 {
    font-family: var(--font-display);
    font-size: clamp(40px, 6.4vw, 82px);
    font-weight: 800; line-height: 1.02;
    letter-spacing: -0.03em; color: var(--white);
    margin-bottom: 26px;
  }
  .hero h1 .accent {
    background: linear-gradient(120deg, var(--primary-light) 10%, var(--primary) 60%, var(--primary-deep));
    -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;
  }
  .hero p {
    font-size: clamp(17px, 1.6vw, 20px);
    color: rgba(255,255,255,0.82);
    max-width: 560px; margin-bottom: 38px; line-height: 1.7;
  }
  .hero-cta { display: flex; gap: 14px; flex-wrap: wrap; }

  .hero-kpis {
    position: absolute; z-index: 3; bottom: 46px; inset-inline-end: 24px;
    display: flex; flex-direction: column; gap: 14px; width: 260px;
  }
  .kpi-card {
    background: rgba(17, 28, 46, 0.55);
    backdrop-filter: blur(20px) saturate(140%);
    border: 1px solid var(--border-strong);
    border-radius: var(--r-md); padding: 16px 18px;
    display: flex; align-items: center; gap: 14px;
    box-shadow: var(--shadow-card);
  }
  .kpi-ico {
    width: 42px; height: 42px; border-radius: 12px; flex-shrink: 0;
    background: linear-gradient(135deg, rgba(255,122,26,0.28), rgba(255,122,26,0.08));
    color: var(--primary-light); display: grid; place-items: center;
    border: 1px solid rgba(255,122,26,0.2);
  }
  .kpi-meta { display: flex; flex-direction: column; }
  .kpi-value { font-family: var(--font-num); font-weight: 700; font-size: 22px; color: var(--white); line-height: 1.1; }
  .kpi-label { font-size: 12px; color: var(--muted); }
  .kpi-card.k1 { animation: float 5s var(--ease) infinite; }
  .kpi-card.k2 { animation: float 5s var(--ease) infinite 1.6s; }
  .kpi-card.k3 { animation: float 5s var(--ease) infinite 3.2s; }

  .scroll-hint {
    position: absolute; z-index: 3; bottom: 30px; inset-inline-start: 24px;
    display: flex; align-items: center; gap: 10px;
    color: var(--muted); font-size: 12px; letter-spacing: 0.08em; text-transform: uppercase;
  }
  .scroll-mouse {
    width: 22px; height: 34px; border: 1.5px solid var(--border-strong);
    border-radius: 12px; position: relative;
  }
  .scroll-mouse::after {
    content: ""; position: absolute; top: 6px; left: 50%; transform: translateX(-50%);
    width: 3px; height: 7px; border-radius: 3px; background: var(--primary-light);
    animation: scroll-dot 1.8s var(--ease) infinite;
  }
  @keyframes scroll-dot { 0% { opacity: 0; top: 6px; } 40% { opacity: 1; } 80% { opacity: 0; top: 16px; } 100% { opacity: 0; } }

  /* ---------- Marquee / Trusted ---------- */
  .trusted { padding: 46px 0; border-block: 1px solid var(--border); background: var(--secondary); }
  .trusted-title { text-align: center; color: var(--muted); font-size: 13px; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 30px; }
  .marquee { position: relative; overflow: hidden; -webkit-mask-image: linear-gradient(90deg, transparent, #000 12%, #000 88%, transparent); mask-image: linear-gradient(90deg, transparent, #000 12%, #000 88%, transparent); }
  .marquee-track { display: flex; gap: 64px; width: max-content; animation: marquee 34s linear infinite; }
  [dir="rtl"] .marquee-track { animation-direction: reverse; }
  .marquee:hover .marquee-track { animation-play-state: paused; }
  .marquee-logo {
    font-family: var(--font-display); font-weight: 700; font-size: 26px;
    color: rgba(255,255,255,0.5); letter-spacing: 0.01em; white-space: nowrap;
    transition: color 0.25s; flex-shrink: 0;
  }
  .marquee-logo:hover { color: var(--white); }
  @keyframes marquee { to { transform: translateX(-50%); } }

  /* ---------- Stats ---------- */
  .stats { padding: 110px 0; background: var(--bg); position: relative; }
  .stats-grid {
    display: grid; grid-template-columns: repeat(5, 1fr);
    margin-top: 56px; border: 1px solid var(--border); border-radius: var(--r-lg);
    overflow: hidden; background: var(--surface);
  }
  .stat { padding: 38px 26px; border-inline-start: 1px solid var(--border); position: relative; }
  .stat:first-child { border-inline-start: none; }
  .stat-value { font-family: var(--font-num); font-weight: 700; font-size: clamp(32px, 3.4vw, 46px); color: var(--white); line-height: 1; letter-spacing: -0.02em; }
  .stat-value .u { color: var(--primary); }
  .stat-label { color: var(--muted); font-size: 14px; margin-top: 10px; }

  /* ---------- Services ---------- */
  .services { padding: 120px 0; background: linear-gradient(180deg, var(--bg), var(--secondary)); }
  .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
  .service-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-lg); padding: 32px 28px;
    position: relative; overflow: hidden;
    transition: transform 0.4s var(--ease), border-color 0.4s var(--ease), background 0.4s var(--ease);
  }
  .service-card::after {
    content: ""; position: absolute; inset: 0; border-radius: inherit; pointer-events: none;
    background: radial-gradient(400px circle at var(--mx, 50%) var(--my, 0%), rgba(255,122,26,0.12), transparent 60%);
    opacity: 0; transition: opacity 0.4s var(--ease);
  }
  .service-card:hover { transform: translateY(-8px); border-color: rgba(255,122,26,0.35); background: var(--surface-2); }
  .service-card:hover::after { opacity: 1; }
  .service-icon {
    width: 60px; height: 60px; border-radius: 16px;
    background: linear-gradient(135deg, rgba(255,122,26,0.25), rgba(255,122,26,0.06));
    color: var(--primary-light); display: grid; place-items: center;
    margin-bottom: 22px; border: 1px solid rgba(255,122,26,0.18);
    transition: transform 0.4s var(--ease);
  }
  .service-card:hover .service-icon { transform: scale(1.08) rotate(-4deg); }
  .service-card h3 { font-family: var(--font-display); font-weight: 700; font-size: 20px; color: var(--white); margin-bottom: 10px; }
  .service-card p { color: var(--muted); font-size: 14.5px; line-height: 1.65; }
  .service-card .more { margin-top: 20px; color: var(--primary-light); font-size: 13.5px; font-weight: 600; display: inline-flex; align-items: center; gap: 7px; }
  [dir="rtl"] .more svg { transform: scaleX(-1); }

  /* ---------- Why (comparison) ---------- */
  .why { padding: 120px 0; background: var(--secondary); }
  .why-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 64px; align-items: center; }
  .why-features { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 36px; }
  .why-item { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-md); padding: 22px; transition: border-color 0.3s, transform 0.3s var(--ease); }
  .why-item:hover { border-color: rgba(255,122,26,0.3); transform: translateY(-4px); }
  .why-item-icon { width: 42px; height: 42px; border-radius: 12px; background: rgba(255,122,26,0.14); color: var(--primary-light); display: grid; place-items: center; margin-bottom: 14px; }
  .why-item h4 { font-family: var(--font-display); font-weight: 700; font-size: 16px; color: var(--white); margin-bottom: 7px; }
  .why-item p { color: var(--muted); font-size: 13.5px; }

  .compare {
    background: linear-gradient(160deg, var(--surface-2), var(--surface));
    border: 1px solid var(--border-strong); border-radius: var(--r-xl);
    padding: 8px; box-shadow: var(--shadow-card); position: relative; overflow: hidden;
  }
  .compare::before {
    content: ""; position: absolute; top: -80px; inset-inline-end: -80px;
    width: 260px; height: 260px; border-radius: 50%;
    background: radial-gradient(circle, rgba(255,122,26,0.16), transparent 70%);
  }
  .compare-head { display: grid; grid-template-columns: 1.4fr 1fr 1fr; padding: 20px 22px 14px; position: relative; }
  .compare-head .ch-title { font-family: var(--font-display); font-weight: 700; color: var(--white); font-size: 15px; align-self: center; }
  .compare-head .ch { text-align: center; font-family: var(--font-display); font-weight: 700; font-size: 14px; }
  .compare-head .ch.navix { color: var(--primary-light); }
  .compare-head .ch.legacy { color: var(--muted); }
  .compare-row { display: grid; grid-template-columns: 1.4fr 1fr 1fr; align-items: center; padding: 16px 22px; border-top: 1px solid var(--border); }
  .compare-row span { color: rgba(255,255,255,0.9); font-size: 14px; }
  .compare-row .cell { display: grid; place-items: center; }
  .ok { color: #4ADE80; } .no { color: var(--muted-2); }

  /* ---------- How ---------- */
  .how { padding: 120px 0; background: var(--bg); position: relative; overflow: hidden; }
  .how-glow { position: absolute; top: 10%; inset-inline-start: -120px; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(255,122,26,0.08), transparent 70%); pointer-events: none; }
  .flow-steps { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; position: relative; margin-top: 20px; }
  .flow-line { position: absolute; top: 34px; inset-inline: 12%; height: 2px; background: repeating-linear-gradient(90deg, rgba(255,122,26,0.6) 0 10px, transparent 10px 20px); }
  .flow-step { position: relative; z-index: 2; }
  .step-num {
    width: 68px; height: 68px; border-radius: 20px;
    background: linear-gradient(160deg, var(--surface-2), var(--surface));
    border: 1px solid var(--border-strong);
    color: var(--primary-light); font-family: var(--font-num);
    font-weight: 700; font-size: 24px; display: grid; place-items: center;
    margin-bottom: 22px; box-shadow: var(--shadow-card); position: relative;
  }
  .step-num .step-ico { position: absolute; bottom: -10px; inset-inline-end: -10px; width: 30px; height: 30px; border-radius: 9px; background: linear-gradient(180deg, var(--primary-light), var(--primary)); color: #1a0a00; display: grid; place-items: center; box-shadow: var(--shadow-glow); }
  .flow-step h4 { font-family: var(--font-display); font-weight: 700; font-size: 19px; color: var(--white); margin-bottom: 8px; }
  .flow-step p { color: var(--muted); font-size: 14px; }

  /* ---------- Tech ---------- */
  .tech { padding: 120px 0; background: linear-gradient(180deg, var(--bg), var(--secondary)); }
  .tech-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
  .tech-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--r-lg); padding: 30px 26px;
    transition: transform 0.4s var(--ease), border-color 0.4s var(--ease);
    position: relative; overflow: hidden;
  }
  .tech-card:hover { transform: translateY(-6px); border-color: var(--border-strong); }
  .tech-ico { width: 52px; height: 52px; border-radius: 14px; background: rgba(255,122,26,0.12); border: 1px solid rgba(255,122,26,0.18); color: var(--primary-light); display: grid; place-items: center; margin-bottom: 20px; }
  .tech-card h4 { font-family: var(--font-display); font-weight: 700; font-size: 17px; color: var(--white); margin-bottom: 8px; }
  .tech-card p { color: var(--muted); font-size: 13.5px; }

  /* ---------- Integrations ---------- */
  .integrations { padding: 120px 0; background: var(--secondary); }
  .int-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 16px; margin-bottom: 40px; }
  .int-cell {
    aspect-ratio: 1; background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--r-md); display: grid; place-items: center;
    color: rgba(255,255,255,0.7); font-family: var(--font-display); font-weight: 700;
    font-size: 14px; text-align: center; padding: 12px;
    transition: transform 0.35s var(--ease), border-color 0.35s var(--ease), color 0.35s, background 0.35s;
  }
  .int-cell:hover { transform: translateY(-6px) scale(1.03); border-color: rgba(255,122,26,0.35); color: var(--white); background: var(--surface-2); }
  .int-center { text-align: center; }
  .int-link { color: var(--primary-light); text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; }
  [dir="rtl"] .int-link svg { transform: scaleX(-1); }

  /* ---------- Testimonials ---------- */
  .testimonials { padding: 120px 0; background: var(--bg); }
  .t-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
  .t-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-lg); padding: 32px 28px; display: flex; flex-direction: column; transition: transform 0.4s var(--ease), border-color 0.4s; }
  .t-card:hover { transform: translateY(-6px); border-color: var(--border-strong); }
  .t-stars { display: flex; gap: 3px; margin-bottom: 18px; color: var(--primary); }
  .t-quote { color: rgba(255,255,255,0.9); font-size: 15.5px; line-height: 1.7; flex: 1; }
  .t-author { display: flex; align-items: center; gap: 13px; margin-top: 24px; padding-top: 22px; border-top: 1px solid var(--border); }
  .t-avatar { width: 46px; height: 46px; border-radius: 50%; display: grid; place-items: center; font-family: var(--font-num); font-weight: 700; color: #1a0a00; font-size: 15px; }
  .t-name { font-family: var(--font-display); font-weight: 700; color: var(--white); font-size: 15px; }
  .t-role { color: var(--muted); font-size: 13px; }

  /* ---------- Case studies ---------- */
  .cases { padding: 120px 0; background: linear-gradient(180deg, var(--bg), var(--secondary)); }
  .cases-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
  .case-card {
    background: linear-gradient(165deg, var(--surface-2), var(--surface));
    border: 1px solid var(--border); border-radius: var(--r-lg);
    padding: 34px 30px; position: relative; overflow: hidden;
    transition: transform 0.4s var(--ease), border-color 0.4s;
  }
  .case-card:hover { transform: translateY(-8px); border-color: rgba(255,122,26,0.3); }
  .case-metric { font-family: var(--font-num); font-weight: 700; font-size: clamp(40px, 5vw, 58px); line-height: 1; background: linear-gradient(120deg, var(--primary-light), var(--primary)); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -0.02em; }
  .case-label { font-family: var(--font-display); font-weight: 700; color: var(--white); font-size: 17px; margin: 14px 0 10px; }
  .case-card p { color: var(--muted); font-size: 14px; line-height: 1.6; }
  .case-read { margin-top: 22px; color: var(--primary-light); font-size: 13.5px; font-weight: 600; display: inline-flex; align-items: center; gap: 7px; text-decoration: none; }
  [dir="rtl"] .case-read svg { transform: scaleX(-1); }

  /* ---------- CTA ---------- */
  .cta-banner { padding: 40px 0 120px; background: var(--secondary); }
  .cta-box {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-deep) 100%);
    border-radius: var(--r-xl); padding: 70px 60px; position: relative; overflow: hidden;
    display: grid; grid-template-columns: 1.6fr 1fr; gap: 40px; align-items: center;
  }
  .cta-box::before { content: ""; position: absolute; inset: 0; background-image: radial-gradient(rgba(255,255,255,0.14) 1px, transparent 1px); background-size: 22px 22px; opacity: 0.5; }
  .cta-box::after { content: ""; position: absolute; top: -60%; inset-inline-start: -10%; width: 55%; height: 220%; background: rgba(255,255,255,0.08); transform: rotate(18deg); pointer-events: none; }
  .cta-box .eyebrow { color: rgba(26,10,0,0.75); }
  .cta-box .eyebrow::before { background: rgba(26,10,0,0.5); }
  .cta-box h2 { font-family: var(--font-display); font-weight: 800; font-size: clamp(30px, 4vw, 46px); color: #1a0a00; line-height: 1.08; letter-spacing: -0.02em; position: relative; z-index: 2; margin-top: 14px; }
  .cta-box p { color: rgba(26,10,0,0.82); margin-top: 14px; position: relative; z-index: 2; font-size: 16px; max-width: 520px; }
  .cta-actions { display: flex; gap: 12px; flex-wrap: wrap; position: relative; z-index: 2; justify-content: flex-end; }
  .cta-actions .btn-primary { background: #0a0f18; color: var(--white); box-shadow: 0 20px 50px -20px rgba(0,0,0,0.6); }
  .cta-actions .btn-primary:hover { background: #000; }
  .cta-actions .btn-ghost { color: #1a0a00; border-color: rgba(26,10,0,0.35); background: rgba(255,255,255,0.14); }
  .cta-actions .btn-ghost:hover { background: rgba(255,255,255,0.28); border-color: #1a0a00; color: #1a0a00; }

  /* ---------- Footer ---------- */
  footer { background: var(--bg); padding: 90px 0 34px; border-top: 1px solid var(--border); }
  .footer-top { display: grid; grid-template-columns: 1.6fr 1fr 1fr 1fr; gap: 44px; margin-bottom: 56px; }
  .footer-brand { max-width: 340px; }
  .footer-brand p { color: var(--muted); font-size: 14px; margin: 20px 0 24px; line-height: 1.7; }
  .socials { display: flex; gap: 10px; }
  .social-icon { width: 40px; height: 40px; border-radius: 12px; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: rgba(255,255,255,0.8); display: grid; place-items: center; transition: all 0.25s var(--ease); }
  .social-icon:hover { background: var(--primary); border-color: var(--primary); color: #1a0a00; transform: translateY(-3px); }
  .footer-col h5 { font-family: var(--font-display); font-weight: 700; font-size: 14px; color: var(--white); margin-bottom: 20px; letter-spacing: 0.02em; }
  .footer-col ul { list-style: none; }
  .footer-col li { margin-bottom: 13px; }
  .footer-col a { color: var(--muted); text-decoration: none; font-size: 14px; transition: color 0.2s; }
  .footer-col a:hover { color: var(--primary-light); }

  .footer-news { border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); padding: 34px 0; margin-bottom: 34px; display: grid; grid-template-columns: 1fr auto; gap: 30px; align-items: center; }
  .footer-news h4 { font-family: var(--font-display); font-weight: 700; font-size: 20px; color: var(--white); }
  .footer-news p { color: var(--muted); font-size: 14px; margin-top: 4px; }
  .news-form { display: flex; gap: 10px; }
  .news-form input {
    background: var(--surface); border: 1px solid var(--border-strong); border-radius: 999px;
    padding: 13px 20px; color: var(--white); font-size: 14px; font-family: var(--font-body);
    min-width: 260px; outline: none; transition: border-color 0.2s;
  }
  .news-form input::placeholder { color: var(--muted-2); }
  .news-form input:focus { border-color: var(--primary); }

  .footer-bottom { border-top: 1px solid var(--border); padding-top: 26px; display: flex; justify-content: space-between; align-items: center; color: var(--muted); font-size: 13px; gap: 16px; flex-wrap: wrap; }
  .footer-bottom-links { display: flex; gap: 24px; }
  .footer-bottom-links a { color: var(--muted); text-decoration: none; transition: color 0.2s; }
  .footer-bottom-links a:hover { color: var(--primary-light); }
  .contact-li { display: flex; align-items: flex-start; gap: 10px; color: var(--muted); font-size: 13.5px; margin-bottom: 13px; }
  .contact-li svg { color: var(--primary-light); flex-shrink: 0; margin-top: 3px; }

  /* ---------- Reveal animations ---------- */
  @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
  .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.7s var(--ease), transform 0.7s var(--ease); }
  .reveal.in { opacity: 1; transform: none; }
  .reveal[data-delay="1"] { transition-delay: 0.08s; }
  .reveal[data-delay="2"] { transition-delay: 0.16s; }
  .reveal[data-delay="3"] { transition-delay: 0.24s; }
  .reveal[data-delay="4"] { transition-delay: 0.32s; }
  .reveal[data-delay="5"] { transition-delay: 0.4s; }

  .hero-inner > * { opacity: 0; transform: translateY(24px); animation: heroUp 0.9s var(--ease) forwards; }
  .hero-inner > *:nth-child(1) { animation-delay: 0.1s; }
  .hero-inner > *:nth-child(2) { animation-delay: 0.24s; }
  .hero-inner > *:nth-child(3) { animation-delay: 0.38s; }
  .hero-inner > *:nth-child(4) { animation-delay: 0.52s; }
  @keyframes heroUp { to { opacity: 1; transform: none; } }

  @media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    *, *::before, *::after { animation-duration: 0.001ms !important; animation-iteration-count: 1 !important; transition-duration: 0.001ms !important; }
    .reveal { opacity: 1; transform: none; }
    .hero-inner > * { opacity: 1; transform: none; }
  }

  /* ---------- Responsive ---------- */
  @media (max-width: 1080px) {
    .nav-links, .nav-cta .auth-link, .nav-cta .btn { display: none; }
    .menu-toggle { display: block; }
    .stats-grid { grid-template-columns: repeat(3, 1fr); }
    .stat:nth-child(n+4) { border-top: 1px solid var(--border); }
    .stat:nth-child(4) { border-inline-start: none; }
    .services-grid, .tech-grid, .t-grid, .cases-grid { grid-template-columns: repeat(2, 1fr); }
    .why-grid { grid-template-columns: 1fr; }
    .int-grid { grid-template-columns: repeat(4, 1fr); }
    .footer-top { grid-template-columns: 1fr 1fr; }
    .hero-kpis { display: none; }
  }
  @media (max-width: 720px) {
    .hero { padding: 120px 0 80px; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .stat { border-inline-start: none !important; }
    .stat:nth-child(n+3) { border-top: 1px solid var(--border); }
    .services-grid, .tech-grid, .t-grid, .cases-grid, .why-features { grid-template-columns: 1fr; }
    .flow-steps { grid-template-columns: 1fr; gap: 30px; }
    .flow-line { display: none; }
    .int-grid { grid-template-columns: repeat(3, 1fr); }
    .compare-head .ch-title { font-size: 13px; }
    .cta-box { grid-template-columns: 1fr; padding: 44px 30px; }
    .cta-actions { justify-content: flex-start; }
    .footer-top { grid-template-columns: 1fr; }
    .footer-news { grid-template-columns: 1fr; }
    .news-form { flex-direction: column; }
    .news-form input { min-width: 0; width: 100%; }
    .footer-bottom { flex-direction: column; text-align: center; }
    .scroll-hint { display: none; }
  }
</style>
</head>
<body>

<!-- ============ NAV ============ -->
<div class="nav-wrap" id="navwrap">
  <nav>
    <a href="{{ $homeUrl }}" class="brand" aria-label="NAVIX">
      <img src="{{ asset('images/navix-logo.png') }}" alt="NAVIX" class="brand-logo">
    </a>
    <ul class="nav-links">
      <li><a href="#home" class="active">{{ __('landing.nav.home') }}</a></li>
      <li class="has-mega">
        <a href="#services">{{ __('landing.nav.services') }}
          <svg class="chev" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
        </a>
        <div class="mega">
          @php
            $mega = [
              ['mega_warehousing','mega_warehousing_desc','#services','M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z M9 22V12h6v10'],
              ['mega_fulfillment','mega_fulfillment_desc','#services','M12 2L2 7l10 5 10-5-10-5z M2 17l10 5 10-5 M2 12l10 5 10-5'],
              ['mega_transport','mega_transport_desc','#services','M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 18.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M18.5 18.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z'],
              ['mega_lastmile','mega_lastmile_desc','#services','M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z M12 13a3 3 0 100-6 3 3 0 000 6z'],
              ['mega_tracking','mega_tracking_desc', ($isRtl ? url('/track') : url('/en/track')),'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z M9 12l2 2 4-4'],
              ['mega_returns','mega_returns_desc','#services','M1 4v6h6 M23 20v-6h-6 M20.49 9A9 9 0 005.64 5.64L1 10 M3.51 15a9 9 0 0014.85 3.36L23 14'],
            ];
          @endphp
          @foreach($mega as $m)
          <a class="mega-item" href="{{ $m[2] }}">
            <span class="mega-ico"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $m[3] }}"/></svg></span>
            <span><h6>{{ __('landing.nav.'.$m[0]) }}</h6><span>{{ __('landing.nav.'.$m[1]) }}</span></span>
          </a>
          @endforeach
        </div>
      </li>
      <li><a href="{{ $isRtl ? url('/track') : url('/en/track') }}">{{ __('landing.nav.tracking') }}</a></li>
      <li><a href="#integrations">{{ __('landing.nav.integrations') }}</a></li>
      <li><a href="{{ $isRtl ? url('/partners') : url('/en/partners') }}">{{ __('landing.nav.partners') }}</a></li>
    </ul>
    <div class="nav-cta">
      @auth
        <a href="{{ url('/dashboard') }}" class="auth-link">{{ __('landing.nav.dashboard') }}</a>
      @endauth
      <a href="{{ $switchUrl }}" class="lang-btn" aria-label="Switch language">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>
        {{ __('landing.nav.lang_switch_label') }}
      </a>
      <a href="mailto:info@navix.com.sa?subject=Request%20a%20Quote" class="btn btn-primary">
        {{ __('landing.nav.quote_cta') }}
        <svg class="arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
    <button class="menu-toggle" id="menuToggle" aria-label="Open menu">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
    </button>
  </nav>
</div>

<!-- ============ MOBILE DRAWER ============ -->
<div class="drawer" id="drawer">
  <button class="drawer-close" id="drawerClose" aria-label="Close menu">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
  </button>
  <a href="#home">{{ __('landing.nav.home') }}</a>
  <a href="#services">{{ __('landing.nav.services') }}</a>
  <a href="{{ $isRtl ? url('/track') : url('/en/track') }}">{{ __('landing.nav.tracking') }}</a>
  <a href="#why">{{ __('landing.nav.why') }}</a>
  <a href="#integrations">{{ __('landing.nav.integrations') }}</a>
  <a href="{{ $isRtl ? url('/partners') : url('/en/partners') }}">{{ __('landing.nav.partners') }}</a>
  <a href="mailto:info@navix.com.sa?subject=Request%20a%20Quote" class="btn btn-primary drawer-cta">{{ __('landing.nav.quote_cta') }}</a>
</div>

<!-- ============ HERO ============ -->
<section class="hero" id="home">
  <div class="hero-bg">
    <img src="{{ asset('images/hero.png') }}" alt="{{ __('landing.hero.eyebrow') }}" fetchpriority="high">
  </div>
  <div class="hero-motion" data-motion="hero" aria-hidden="true"></div>
  <div class="hero-glow"></div>
  <div class="container">
    <div class="hero-inner">
      <div class="hero-badge"><span class="dot"></span>{{ __('landing.hero.badge') }}</div>
      <h1>
        {{ __('landing.hero.title_line_1') }}<br>
        @if (trim(__('landing.hero.title_line_2_prefix')) !== ''){{ __('landing.hero.title_line_2_prefix') }} @endif<span class="accent">{{ __('landing.hero.title_accent') }}</span>
      </h1>
      <p>{{ __('landing.hero.paragraph') }}</p>
      <div class="hero-cta">
        <a href="mailto:info@navix.com.sa?subject=Request%20a%20Quote" class="btn btn-primary">
          {{ __('landing.hero.cta_primary') }}
          <svg class="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <a href="#services" class="btn btn-ghost">{{ __('landing.hero.cta_secondary') }}</a>
      </div>
    </div>
  </div>

  <div class="hero-kpis">
    <div class="kpi-card k1">
      <span class="kpi-ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg></span>
      <span class="kpi-meta"><span class="kpi-value">{{ __('landing.hero.kpi_1_value') }}</span><span class="kpi-label">{{ __('landing.hero.kpi_1_label') }}</span></span>
    </div>
    <div class="kpi-card k2">
      <span class="kpi-ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 3h15v13H1z"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></span>
      <span class="kpi-meta"><span class="kpi-value">{{ __('landing.hero.kpi_2_value') }}</span><span class="kpi-label">{{ __('landing.hero.kpi_2_label') }}</span></span>
    </div>
    <div class="kpi-card k3">
      <span class="kpi-ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5"/></svg></span>
      <span class="kpi-meta"><span class="kpi-value">{{ __('landing.hero.kpi_3_value') }}</span><span class="kpi-label">{{ __('landing.hero.kpi_3_label') }}</span></span>
    </div>
  </div>

  <div class="scroll-hint"><span class="scroll-mouse"></span>{{ __('landing.hero.scroll') }}</div>
</section>


<!-- ============ STATS ============ -->
<section class="stats">
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow">{{ __('landing.stats.eyebrow') }}</span>
      <h2 class="h-section">{{ __('landing.stats.title_lead') }} <span class="accent">{{ __('landing.stats.title_accent') }}</span></h2>
      <p class="sub-section">{{ __('landing.stats.sub') }}</p>
    </div>
    <div class="stats-grid reveal">
      @php
        $stats = [
          ['12', '', 'countries_label'],
          ['8', 'M', 'deliveries_label'],
          ['50', 'K', 'warehouses_label'],
          ['640', '', 'fleet_label'],
          ['500', '', 'customers_label'],
        ];
      @endphp
      @foreach($stats as $s)
      <div class="stat">
        <div class="stat-value"><span class="count" data-target="{{ $s[0] }}">0</span><span class="u">{{ $s[1] }}{{ __('landing.stats.suffix_plus') }}</span></div>
        <div class="stat-label">{{ __('landing.stats.'.$s[2]) }}</div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ============ SERVICES ============ -->
<section class="services" id="services">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">{{ __('landing.services.eyebrow') }}</span>
      <h2 class="h-section">{{ __('landing.services.title_lead') }} <span class="accent">{{ __('landing.services.title_accent') }}</span></h2>
      <p class="sub-section">{{ __('landing.services.sub') }}</p>
    </div>
    <div class="services-grid">
      @php
        $services = [
          ['warehousing','M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z|M9 22V12h6v10'],
          ['fulfillment','M12 2L2 7l10 5 10-5-10-5z|M2 17l10 5 10-5|M2 12l10 5 10-5'],
          ['transport','M1 3h15v13H1z|M16 8h4l3 3v5h-7V8z|M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z|M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z'],
          ['lastmile','M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z|M12 13a3 3 0 100-6 3 3 0 000 6z'],
          ['tracking','M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z|M9 12l2 2 4-4'],
          ['returns','M1 4v6h6|M23 20v-6h-6|M20.49 9A9 9 0 005.64 5.64L1 10|M3.51 15a9 9 0 0014.85 3.36L23 14'],
        ];
      @endphp
      @foreach($services as $i => $sv)
      <div class="service-card reveal" data-delay="{{ $i % 3 }}" data-tilt>
        <div class="service-icon">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            @foreach(explode('|', $sv[1]) as $p)<path d="{{ $p }}"/>@endforeach
          </svg>
        </div>
        <h3>{{ __('landing.services.'.$sv[0].'_title') }}</h3>
        <p>{{ __('landing.services.'.$sv[0].'_desc') }}</p>
        <span class="more">{{ __('landing.services.more') }}
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </span>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ============ WHY ============ -->
<section class="why" id="why">
  <div class="container">
    <div class="why-grid">
      <div class="reveal">
        <span class="eyebrow">{{ __('landing.why.eyebrow') }}</span>
        <h2 class="h-section">{{ __('landing.why.title_lead') }} <span class="accent">{{ __('landing.why.title_accent') }}</span></h2>
        <p class="sub-section">{{ __('landing.why.sub') }}</p>
        <div class="why-features">
          @php
            $whys = [
              ['item_1','M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z'],
              ['item_2','M12 6v6l4 2|M12 22a10 10 0 100-20 10 10 0 000 20z'],
              ['item_3','M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z|M12 13a3 3 0 100-6 3 3 0 000 6z'],
              ['item_4','M13 2L3 14h9l-1 8 10-12h-9l1-8z'],
            ];
          @endphp
          @foreach($whys as $w)
          <div class="why-item">
            <div class="why-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">@foreach(explode('|', $w[1]) as $p)<path d="{{ $p }}"/>@endforeach</svg></div>
            <h4>{{ __('landing.why.'.$w[0].'_title') }}</h4>
            <p>{{ __('landing.why.'.$w[0].'_desc') }}</p>
          </div>
          @endforeach
        </div>
      </div>

      <div class="compare reveal" data-delay="1">
        <div class="compare-head">
          <div class="ch-title">{{ __('landing.why.compare_heading') }}</div>
          <div class="ch navix">{{ __('landing.why.col_navix') }}</div>
          <div class="ch legacy">{{ __('landing.why.col_legacy') }}</div>
        </div>
        @foreach(['row_1','row_2','row_3','row_4','row_5'] as $row)
        <div class="compare-row">
          <span>{{ __('landing.why.'.$row) }}</span>
          <div class="cell"><svg class="ok" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg></div>
          <div class="cell"><svg class="no" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg></div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- ============ HOW ============ -->
<section class="how" id="how">
  <div class="how-glow"></div>
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow">{{ __('landing.how.eyebrow') }}</span>
      <h2 class="h-section">{{ __('landing.how.title_lead') }} <span class="accent">{{ __('landing.how.title_accent') }}</span></h2>
      <p class="sub-section">{{ __('landing.how.sub') }}</p>
    </div>
    <div class="flow-steps">
      <div class="flow-line"></div>
      @php
        $steps = [
          ['step_1','M4 17l6-6-6-6|M12 19h8'],
          ['step_2','M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z|M9 22V12h6v10'],
          ['step_3','M12 2L2 7l10 5 10-5-10-5z|M2 17l10 5 10-5M2 12l10 5 10-5'],
          ['step_4','M1 3h15v13H1z|M16 8h4l3 3v5h-7V8z|M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z|M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z'],
        ];
      @endphp
      @foreach($steps as $i => $st)
      <div class="flow-step reveal" data-delay="{{ $i }}">
        <div class="step-num">{{ $i + 1 }}
          <span class="step-ico"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">@foreach(explode('|', $st[1]) as $p)<path d="{{ $p }}"/>@endforeach</svg></span>
        </div>
        <h4>{{ __('landing.how.'.$st[0].'_title') }}</h4>
        <p>{{ __('landing.how.'.$st[0].'_desc') }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ============ INTEGRATIONS ============ -->
<section class="integrations" id="integrations">
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow">{{ __('landing.integrations.eyebrow') }}</span>
      <h2 class="h-section">{{ __('landing.integrations.title_lead') }} <span class="accent">{{ __('landing.integrations.title_accent') }}</span></h2>
      <p class="sub-section">{{ __('landing.integrations.sub') }}</p>
    </div>
    <div class="int-grid reveal">
      @foreach(['Shopify','WooCommerce','Salla','Zid','Magento','Amazon','Noon','Shopify Plus','BigCommerce','Odoo','SAP','Zapier','Slack','QuickBooks'] as $int)
        <div class="int-cell">{{ $int }}</div>
      @endforeach
    </div>
    <div class="int-center reveal">
      <a href="#contact" class="int-link">{{ __('landing.integrations.cta') }}
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ============ CASE STUDIES ============ -->
<section class="cases">
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow">{{ __('landing.cases.eyebrow') }}</span>
      <h2 class="h-section">{{ __('landing.cases.title_lead') }} <span class="accent">{{ __('landing.cases.title_accent') }}</span></h2>
      <p class="sub-section">{{ __('landing.cases.sub') }}</p>
    </div>
    <div class="cases-grid">
      @foreach(['c1','c2','c3'] as $i => $c)
      <div class="case-card reveal" data-delay="{{ $i }}">
        <div class="case-metric">{{ __('landing.cases.'.$c.'_metric') }}</div>
        <div class="case-label">{{ __('landing.cases.'.$c.'_label') }}</div>
        <p>{{ __('landing.cases.'.$c.'_desc') }}</p>
        <a href="#contact" class="case-read">{{ __('landing.cases.read') }}
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="cta-banner" id="contact">
  <div class="container">
    <div class="cta-box reveal">
      <div class="cta-motion" data-motion="cta" aria-hidden="true"></div>
      <div>
        <span class="eyebrow">{{ __('landing.cta.eyebrow') }}</span>
        <h2>{{ __('landing.cta.title') }}</h2>
        <p>{{ __('landing.cta.sub') }}</p>
      </div>
      <div class="cta-actions">
        <a href="mailto:info@navix.com.sa?subject=Request%20a%20Quote" class="btn btn-primary">
          {{ __('landing.cta.primary') }}
          <svg class="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <a href="mailto:info@navix.com.sa" class="btn btn-ghost">{{ __('landing.cta.secondary') }}</a>
      </div>
    </div>
  </div>
</section>

<!-- ============ FOOTER ============ -->
<footer>
  <div class="container">
    <div class="footer-news reveal">
      <div>
        <h4>{{ __('landing.footer.newsletter_title') }}</h4>
        <p>{{ __('landing.footer.newsletter_desc') }}</p>
      </div>
      <form class="news-form" onsubmit="return false">
        <input type="email" placeholder="{{ __('landing.footer.newsletter_placeholder') }}" aria-label="{{ __('landing.footer.newsletter_placeholder') }}">
        <button type="submit" class="btn btn-primary">{{ __('landing.footer.newsletter_cta') }}</button>
      </form>
    </div>

    <div class="footer-top">
      <div class="footer-brand">
        <a href="{{ $homeUrl }}" class="brand"><img src="{{ asset('images/navix-logo.png') }}" alt="NAVIX" class="brand-logo"></a>
        <p>{{ __('landing.footer.brand_desc') }}</p>
        <div class="socials">
          <a href="https://www.facebook.com/profile.php?id=61590446084332" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07c0 6.03 4.39 11.03 10.12 11.93v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.79-4.69 4.53-4.69 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.95.93-1.95 1.89v2.25h3.32l-.53 3.49h-2.79V24C19.61 23.1 24 18.1 24 12.07z"/></svg></a>
          <a href="https://www.instagram.com/navix.ksa/" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zM17.5 6.5h.01"/></svg></a>
        </div>
      </div>

      <div class="footer-col">
        <h5>{{ __('landing.footer.services_heading') }}</h5>
        <ul>
          <li><a href="#services">{{ __('landing.footer.service_warehousing') }}</a></li>
          <li><a href="#services">{{ __('landing.footer.service_fulfillment') }}</a></li>
          <li><a href="#services">{{ __('landing.footer.service_transport') }}</a></li>
          <li><a href="#services">{{ __('landing.footer.service_lastmile') }}</a></li>
          <li><a href="#services">{{ __('landing.footer.service_returns') }}</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h5>{{ __('landing.footer.menu_heading') }}</h5>
        <ul>
          <li><a href="#home">{{ __('landing.nav.home') }}</a></li>
          <li><a href="#services">{{ __('landing.nav.services') }}</a></li>
          <li><a href="{{ $isRtl ? url('/track') : url('/en/track') }}">{{ __('landing.nav.tracking') }}</a></li>
          <li><a href="#integrations">{{ __('landing.nav.integrations') }}</a></li>
          <li><a href="{{ $isRtl ? url('/partners') : url('/en/partners') }}">{{ __('landing.nav.partners') }}</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h5>{{ __('landing.footer.contact_heading') }}</h5>
        <ul>
          <li class="contact-li">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
            <span dir="ltr">+966 9200 12345</span>
          </li>
          <li class="contact-li">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <span dir="ltr">info@navix.com.sa</span>
          </li>
          <li class="contact-li">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            {{ __('landing.footer.address') }}
          </li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <div>© {{ date('Y') }} NAVIX Logistics Services — {{ __('landing.footer.copyright') }}</div>
      <div class="footer-bottom-links">
        <a href="{{ $isRtl ? url('/privacy') : url('/en/privacy') }}">{{ __('landing.footer.privacy') }}</a>
        <a href="{{ $isRtl ? url('/terms') : url('/en/terms') }}">{{ __('landing.footer.terms') }}</a>
        <a href="https://navix.com.sa">navix.com.sa</a>
      </div>
    </div>
  </div>
</footer>

<script>
  // Navbar solidify on scroll
  const navwrap = document.getElementById('navwrap');
  const onScroll = () => navwrap.classList.toggle('scrolled', window.scrollY > 20);
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  // Active nav link on scroll-spy
  const sections = [...document.querySelectorAll('section[id]')];
  const navLinks = [...document.querySelectorAll('.nav-links > li > a')];
  const spy = () => {
    let current = 'home';
    for (const s of sections) { if (window.scrollY >= s.offsetTop - 120) current = s.id; }
    navLinks.forEach(l => l.classList.toggle('active', l.getAttribute('href') === '#' + current));
  };
  window.addEventListener('scroll', spy, { passive: true });

  // Mobile drawer
  const drawer = document.getElementById('drawer');
  document.getElementById('menuToggle').addEventListener('click', () => drawer.classList.add('open'));
  document.getElementById('drawerClose').addEventListener('click', () => drawer.classList.remove('open'));
  drawer.querySelectorAll('a').forEach(a => a.addEventListener('click', () => drawer.classList.remove('open')));

  // Reveal on scroll
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
  document.querySelectorAll('.reveal').forEach(el => io.observe(el));

  // Animated counters
  const easeOut = t => 1 - Math.pow(1 - t, 3);
  const runCount = (el) => {
    const target = parseFloat(el.dataset.target);
    const dur = 1600; let start = null;
    const step = (ts) => {
      if (!start) start = ts;
      const p = Math.min((ts - start) / dur, 1);
      const val = target * easeOut(p);
      el.textContent = target >= 100 ? Math.floor(val).toLocaleString() : val.toFixed(val < 10 && target % 1 === 0 ? 0 : 0);
      if (p < 1) requestAnimationFrame(step);
      else el.textContent = Number.isInteger(target) ? target.toLocaleString() : target;
    };
    requestAnimationFrame(step);
  };
  const countIO = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { runCount(e.target); countIO.unobserve(e.target); } });
  }, { threshold: 0.5 });
  document.querySelectorAll('.count').forEach(el => countIO.observe(el));

  // Spotlight tilt on service cards
  document.querySelectorAll('[data-tilt]').forEach(card => {
    card.addEventListener('pointermove', (e) => {
      const r = card.getBoundingClientRect();
      card.style.setProperty('--mx', ((e.clientX - r.left) / r.width * 100) + '%');
      card.style.setProperty('--my', ((e.clientY - r.top) / r.height * 100) + '%');
    });
  });
</script>

</body>
</html>
