@php
    $locale = app()->getLocale();
    $isRtl = $locale === 'ar';
    $dir = $isRtl ? 'rtl' : 'ltr';
    // Cross-page navigation targets (overridable per page via view data).
    $navHome = $navHome ?? ($isRtl ? url('/') : url('/en'));
    $anchorBase = $anchorBase ?? $navHome;
    $switchUrl = $switchUrl ?? ($isRtl ? url('/en') : url('/'));
    $activeNav = $activeNav ?? '';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title', __('landing.meta.title'))</title>
<meta name="description" content="@yield('description', __('landing.meta.description'))" />
<meta name="theme-color" content="#07111F" />
<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Crect width='24' height='24' rx='5' fill='%2307111F'/%3E%3Ctext x='12' y='17' font-family='Arial' font-weight='900' font-size='14' fill='%23FF7A1A' text-anchor='middle'%3EX%3C/text%3E%3C/svg%3E">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

@viteReactRefresh
@vite(['resources/js/motion.tsx'])

<style>
  :root {
    --bg: #07111F; --secondary: #0F172A; --surface: #111C2E; --surface-2: #16233A;
    --primary: #FF7A1A; --primary-light: #FF9A4D; --primary-deep: #E8620A;
    --white: #FFFFFF; --muted: #94A3B8; --muted-2: #64748B;
    --border: rgba(255,255,255,0.08); --border-strong: rgba(255,255,255,0.14);
    --success: #4ADE80; --info: #60A5FA;
    --font-display: 'Tajawal', sans-serif;
    --font-body: 'IBM Plex Sans Arabic', 'Tajawal', sans-serif;
    --font-num: 'Space Grotesk', 'Tajawal', sans-serif;
    --container: 1200px;
    --r-sm: 10px; --r-md: 16px; --r-lg: 24px; --r-xl: 34px;
    --shadow-card: 0 24px 60px -24px rgba(0, 0, 0, 0.6);
    --shadow-glow: 0 20px 60px -18px rgba(255, 122, 26, 0.45);
    --ease: cubic-bezier(0.22, 1, 0.36, 1);
  }
  [dir="ltr"] { --font-display: 'Space Grotesk', 'Inter', sans-serif; --font-body: 'Inter', sans-serif; --fade-dir: right; }
  [dir="rtl"] { --fade-dir: left; }

  * { margin: 0; padding: 0; box-sizing: border-box; }
  html { scroll-behavior: smooth; -webkit-text-size-adjust: 100%; }
  body { font-family: var(--font-body); background: var(--bg); color: var(--white); line-height: 1.65; overflow-x: hidden; -webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility; }
  ::selection { background: rgba(255,122,26,0.35); color: #fff; }
  img { max-width: 100%; display: block; }
  a:focus-visible, button:focus-visible, input:focus-visible { outline: 2px solid var(--primary); outline-offset: 3px; border-radius: 6px; }
  .container { max-width: var(--container); margin: 0 auto; padding: 0 24px; }

  .eyebrow { display: inline-flex; align-items: center; gap: 10px; font-family: var(--font-display); font-weight: 600; font-size: 12.5px; letter-spacing: 0.14em; text-transform: uppercase; color: var(--primary-light); }
  .eyebrow::before { content: ""; width: 26px; height: 1.5px; background: linear-gradient(90deg, var(--primary), transparent); }
  [dir="rtl"] .eyebrow::before { background: linear-gradient(270deg, var(--primary), transparent); }
  .section-head { max-width: 640px; margin-bottom: 60px; }
  .section-head.center { margin-inline: auto; text-align: center; }
  .section-head.center .eyebrow { justify-content: center; }
  .h-section { font-family: var(--font-display); font-weight: 800; font-size: clamp(30px, 4.4vw, 52px); line-height: 1.08; letter-spacing: -0.02em; color: var(--white); margin-top: 18px; }
  .h-section .accent { background: linear-gradient(120deg, var(--primary-light), var(--primary)); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
  .sub-section { color: var(--muted); font-size: 17px; margin-top: 18px; line-height: 1.7; }

  .btn { display: inline-flex; align-items: center; gap: 10px; padding: 15px 28px; border-radius: 999px; font-family: var(--font-display); font-weight: 700; font-size: 15px; cursor: pointer; border: none; text-decoration: none; transition: transform 0.3s var(--ease), box-shadow 0.3s var(--ease), background 0.3s var(--ease), color 0.3s var(--ease), border-color 0.3s var(--ease); position: relative; white-space: nowrap; }
  .btn-primary { background: linear-gradient(180deg, var(--primary-light), var(--primary)); color: #1a0a00; box-shadow: var(--shadow-glow); }
  .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 26px 70px -16px rgba(255,122,26,0.6); }
  .btn-ghost { background: rgba(255,255,255,0.04); color: var(--white); border: 1px solid var(--border-strong); backdrop-filter: blur(8px); }
  .btn-ghost:hover { border-color: var(--primary); color: var(--primary-light); transform: translateY(-3px); }
  .btn .arrow { transition: transform 0.3s var(--ease); }
  [dir="rtl"] .btn .arrow { transform: scaleX(-1); }
  [dir="rtl"] .btn:hover .arrow { transform: scaleX(-1) translateX(4px); }
  [dir="ltr"] .btn:hover .arrow { transform: translateX(4px); }

  .nav-wrap { position: fixed; top: 0; inset-inline: 0; z-index: 200; transition: background 0.4s var(--ease), backdrop-filter 0.4s var(--ease), border-color 0.4s var(--ease); border-bottom: 1px solid transparent; }
  .nav-wrap.scrolled { background: rgba(7, 17, 31, 0.72); backdrop-filter: blur(18px) saturate(140%); border-bottom: 1px solid var(--border); }
  nav { max-width: var(--container); margin: 0 auto; padding: 18px 24px; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
  .brand { display: flex; align-items: center; text-decoration: none; }
  .brand-logo { display: block; height: 34px; width: auto; }
  .footer-brand .brand-logo { height: 40px; }
  .nav-links { display: flex; align-items: center; gap: 6px; list-style: none; }
  .nav-links > li { position: relative; }
  .nav-links > li > a { color: rgba(255,255,255,0.82); text-decoration: none; font-size: 14.5px; font-weight: 500; white-space: nowrap; padding: 10px 12px; border-radius: 10px; transition: color 0.2s, background 0.2s; display: inline-flex; align-items: center; gap: 6px; }
  .nav-links > li > a:hover { color: var(--white); background: rgba(255,255,255,0.05); }
  .nav-links > li > a.active { color: var(--primary-light); }
  .nav-links .chev { transition: transform 0.3s var(--ease); opacity: 0.6; }
  .has-mega:hover .chev { transform: rotate(180deg); }
  .mega { position: absolute; top: calc(100% + 10px); inset-inline-start: 50%; transform: translateX(-50%) translateY(10px); width: 620px; max-width: 90vw; background: rgba(17, 28, 46, 0.96); backdrop-filter: blur(24px); border: 1px solid var(--border-strong); border-radius: var(--r-lg); padding: 14px; box-shadow: var(--shadow-card); opacity: 0; visibility: hidden; pointer-events: none; transition: opacity 0.3s var(--ease), transform 0.3s var(--ease), visibility 0.3s; display: grid; grid-template-columns: 1fr 1fr; gap: 6px; }
  [dir="rtl"] .mega { transform: translateX(50%) translateY(10px); }
  .has-mega:hover .mega { opacity: 1; visibility: visible; pointer-events: auto; transform: translateX(-50%) translateY(0); }
  [dir="rtl"] .has-mega:hover .mega { transform: translateX(50%) translateY(0); }
  .mega-item { display: flex; gap: 12px; align-items: flex-start; padding: 12px; border-radius: var(--r-sm); text-decoration: none; transition: background 0.2s; }
  .mega-item:hover { background: rgba(255,255,255,0.05); }
  .mega-ico { width: 38px; height: 38px; flex-shrink: 0; border-radius: 10px; background: linear-gradient(135deg, rgba(255,122,26,0.22), rgba(255,122,26,0.06)); color: var(--primary-light); display: grid; place-items: center; border: 1px solid rgba(255,122,26,0.18); }
  .mega-item h6 { font-size: 14px; color: var(--white); font-weight: 700; margin-bottom: 2px; font-family: var(--font-display); }
  .mega-item span { font-size: 12.5px; color: var(--muted); }
  .nav-cta { display: flex; align-items: center; gap: 10px; }
  .auth-link { color: rgba(255,255,255,0.82); text-decoration: none; white-space: nowrap; font-size: 14px; font-weight: 600; padding: 8px 12px; border-radius: 10px; transition: color 0.2s, background 0.2s; }
  .auth-link:hover { color: var(--white); background: rgba(255,255,255,0.05); }
  .lang-btn { background: rgba(255,255,255,0.05); color: var(--white); border: 1px solid var(--border); padding: 9px 14px; border-radius: 999px; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 7px; text-decoration: none; font-family: var(--font-display); transition: all 0.25s var(--ease); }
  .lang-btn:hover { background: rgba(255,122,26,0.14); color: var(--primary-light); border-color: rgba(255,122,26,0.35); }
  .nav-cta .btn { padding: 11px 20px; font-size: 14px; }
  .menu-toggle { display: none; background: none; border: none; color: white; cursor: pointer; padding: 6px; }
  .drawer { position: fixed; inset: 0; z-index: 300; background: rgba(7,17,31,0.98); backdrop-filter: blur(20px); padding: 90px 28px 40px; transform: translateX(100%); transition: transform 0.4s var(--ease); display: flex; flex-direction: column; gap: 6px; }
  [dir="rtl"] .drawer { transform: translateX(-100%); }
  .drawer.open { transform: translateX(0); }
  .drawer a { color: var(--white); text-decoration: none; font-size: 20px; font-weight: 600; font-family: var(--font-display); padding: 14px 0; border-bottom: 1px solid var(--border); }
  .drawer .drawer-cta { margin-top: 24px; border: none; padding: 0; }
  .drawer-close { position: absolute; top: 26px; inset-inline-end: 24px; background: none; border: none; color: white; cursor: pointer; }

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
  .news-form input { background: var(--surface); border: 1px solid var(--border-strong); border-radius: 999px; padding: 13px 20px; color: var(--white); font-size: 14px; font-family: var(--font-body); min-width: 260px; outline: none; transition: border-color 0.2s; }
  .news-form input::placeholder { color: var(--muted-2); }
  .news-form input:focus { border-color: var(--primary); }
  .footer-bottom { border-top: 1px solid var(--border); padding-top: 26px; display: flex; justify-content: space-between; align-items: center; color: var(--muted); font-size: 13px; gap: 16px; flex-wrap: wrap; }
  .footer-bottom-links { display: flex; gap: 24px; }
  .footer-bottom-links a { color: var(--muted); text-decoration: none; transition: color 0.2s; }
  .footer-bottom-links a:hover { color: var(--primary-light); }
  .contact-li { display: flex; align-items: flex-start; gap: 10px; color: var(--muted); font-size: 13.5px; margin-bottom: 13px; }
  .contact-li svg { color: var(--primary-light); flex-shrink: 0; margin-top: 3px; }

  .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.7s var(--ease), transform 0.7s var(--ease); }
  .reveal.in { opacity: 1; transform: none; }
  .reveal[data-delay="1"] { transition-delay: 0.08s; }
  .reveal[data-delay="2"] { transition-delay: 0.16s; }
  .reveal[data-delay="3"] { transition-delay: 0.24s; }
  .reveal[data-delay="4"] { transition-delay: 0.32s; }
  .reveal[data-delay="5"] { transition-delay: 0.4s; }

  @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }

  @media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    *, *::before, *::after { animation-duration: 0.001ms !important; animation-iteration-count: 1 !important; transition-duration: 0.001ms !important; }
    .reveal { opacity: 1; transform: none; }
  }
  @media (max-width: 1080px) {
    .nav-links, .nav-cta .auth-link, .nav-cta .btn { display: none; }
    .menu-toggle { display: block; }
    .footer-top { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 720px) {
    .footer-top { grid-template-columns: 1fr; }
    .footer-news { grid-template-columns: 1fr; }
    .news-form { flex-direction: column; }
    .news-form input { min-width: 0; width: 100%; }
    .footer-bottom { flex-direction: column; text-align: center; }
  }
</style>
@stack('styles')
</head>
<body>

<div class="nav-wrap" id="navwrap">
  <nav>
    <a href="{{ $navHome }}" class="brand" aria-label="NAVIX">
      <img src="{{ asset('images/navix-logo.png') }}" alt="NAVIX" class="brand-logo">
    </a>
    <ul class="nav-links">
      <li><a href="{{ $anchorBase }}#home">{{ __('landing.nav.home') }}</a></li>
      <li class="has-mega">
        <a href="{{ $anchorBase }}#services">{{ __('landing.nav.services') }}
          <svg class="chev" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
        </a>
        <div class="mega">
          @php
            $mega = [
              ['mega_warehousing','mega_warehousing_desc','#services','M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z M9 22V12h6v10'],
              ['mega_fulfillment','mega_fulfillment_desc','#services','M12 2L2 7l10 5 10-5-10-5z M2 17l10 5 10-5 M2 12l10 5 10-5'],
              ['mega_transport','mega_transport_desc','#services','M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 18.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M18.5 18.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z'],
              ['mega_lastmile','mega_lastmile_desc','#services','M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z M12 13a3 3 0 100-6 3 3 0 000 6z'],
              ['mega_tracking','mega_tracking_desc',$isRtl ? url('/track') : url('/en/track'),'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z M9 12l2 2 4-4', true],
              ['mega_returns','mega_returns_desc','#services','M1 4v6h6 M23 20v-6h-6 M20.49 9A9 9 0 005.64 5.64L1 10 M3.51 15a9 9 0 0014.85 3.36L23 14'],
            ];
          @endphp
          @foreach($mega as $m)
            @php $href = (isset($m[4]) && $m[4]) ? $m[2] : $anchorBase.$m[2]; @endphp
            <a class="mega-item" href="{{ $href }}">
              <span class="mega-ico"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $m[3] }}"/></svg></span>
              <span><h6>{{ __('landing.nav.'.$m[0]) }}</h6><span>{{ __('landing.nav.'.$m[1]) }}</span></span>
            </a>
          @endforeach
        </div>
      </li>
      <li><a href="{{ $isRtl ? url('/track') : url('/en/track') }}" class="{{ $activeNav === 'track' ? 'active' : '' }}">{{ __('landing.nav.tracking') }}</a></li>
      <li><a href="{{ $anchorBase }}#integrations">{{ __('landing.nav.integrations') }}</a></li>
      <li><a href="{{ $isRtl ? url('/partners') : url('/en/partners') }}" class="{{ $activeNav === 'partners' ? 'active' : '' }}">{{ __('landing.nav.partners') }}</a></li>
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

<div class="drawer" id="drawer">
  <button class="drawer-close" id="drawerClose" aria-label="Close menu">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
  </button>
  <a href="{{ $anchorBase }}#home">{{ __('landing.nav.home') }}</a>
  <a href="{{ $anchorBase }}#services">{{ __('landing.nav.services') }}</a>
  <a href="{{ $isRtl ? url('/track') : url('/en/track') }}">{{ __('landing.nav.tracking') }}</a>
  <a href="{{ $anchorBase }}#integrations">{{ __('landing.nav.integrations') }}</a>
  <a href="{{ $isRtl ? url('/partners') : url('/en/partners') }}">{{ __('landing.nav.partners') }}</a>
  <a href="mailto:info@navix.com.sa?subject=Request%20a%20Quote" class="btn btn-primary drawer-cta">{{ __('landing.nav.quote_cta') }}</a>
</div>

@yield('content')

<footer>
  <div class="container">
    <div class="footer-top">
      <div class="footer-brand">
        <a href="{{ $navHome }}" class="brand"><img src="{{ asset('images/navix-logo.png') }}" alt="NAVIX" class="brand-logo"></a>
        <p>{{ __('landing.footer.brand_desc') }}</p>
        <div class="socials">
          <a href="https://x.com/navixksa" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="X"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18.24 2.25h3.31l-7.23 8.26 8.5 11.24h-6.66l-5.21-6.82-5.97 6.82H1.66l7.73-8.84L1.24 2.25h6.83l4.71 6.23 5.46-6.23zm-1.16 17.52h1.83L7.01 4.13H5.05l12.03 15.64z"/></svg></a>
          <a href="https://www.linkedin.com/company/navixsa/" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="LinkedIn"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.44-2.13 2.94v5.67H9.35V9h3.42v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.06 2.06 0 110-4.13 2.06 2.06 0 010 4.13zM7.12 20.45H3.55V9h3.57v11.45zM22.22 0H1.77C.79 0 0 .77 0 1.73v20.54C0 23.22.79 24 1.77 24h20.45c.98 0 1.78-.78 1.78-1.73V1.73C24 .77 23.2 0 22.22 0z"/></svg></a>
          <a href="https://www.instagram.com/navix.ksa" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zM17.5 6.5h.01"/></svg></a>
          <a href="https://www.facebook.com/share/1JVTakAJqU/?mibextid=wwXIfr" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07c0 6.03 4.39 11.03 10.12 11.93v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.79-4.69 4.53-4.69 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.95.93-1.95 1.89v2.25h3.32l-.53 3.49h-2.79V24C19.61 23.1 24 18.1 24 12.07z"/></svg></a>
        </div>
      </div>
      <div class="footer-col">
        <h5>{{ __('landing.footer.services_heading') }}</h5>
        <ul>
          <li><a href="{{ $anchorBase }}#services">{{ __('landing.footer.service_warehousing') }}</a></li>
          <li><a href="{{ $anchorBase }}#services">{{ __('landing.footer.service_fulfillment') }}</a></li>
          <li><a href="{{ $anchorBase }}#services">{{ __('landing.footer.service_transport') }}</a></li>
          <li><a href="{{ $anchorBase }}#services">{{ __('landing.footer.service_lastmile') }}</a></li>
          <li><a href="{{ $anchorBase }}#services">{{ __('landing.footer.service_returns') }}</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>{{ __('landing.footer.menu_heading') }}</h5>
        <ul>
          <li><a href="{{ $anchorBase }}#home">{{ __('landing.nav.home') }}</a></li>
          <li><a href="{{ $anchorBase }}#services">{{ __('landing.nav.services') }}</a></li>
          <li><a href="{{ $isRtl ? url('/track') : url('/en/track') }}">{{ __('landing.nav.tracking') }}</a></li>
          <li><a href="{{ $anchorBase }}#integrations">{{ __('landing.nav.integrations') }}</a></li>
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
  const navwrap = document.getElementById('navwrap');
  const onScroll = () => navwrap.classList.toggle('scrolled', window.scrollY > 20);
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  const drawer = document.getElementById('drawer');
  document.getElementById('menuToggle')?.addEventListener('click', () => drawer.classList.add('open'));
  document.getElementById('drawerClose')?.addEventListener('click', () => drawer.classList.remove('open'));
  drawer?.querySelectorAll('a').forEach(a => a.addEventListener('click', () => drawer.classList.remove('open')));

  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
  document.querySelectorAll('.reveal').forEach(el => io.observe(el));

  const easeOut = t => 1 - Math.pow(1 - t, 3);
  const runCount = (el) => {
    const target = parseFloat(el.dataset.target);
    const dur = 1600; let start = null;
    const step = (ts) => {
      if (!start) start = ts;
      const p = Math.min((ts - start) / dur, 1);
      el.textContent = (target * easeOut(p)).toFixed(0);
      if (p < 1) requestAnimationFrame(step);
      else el.textContent = Number.isInteger(target) ? target.toLocaleString() : String(target);
    };
    requestAnimationFrame(step);
  };
  const countIO = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { runCount(e.target); countIO.unobserve(e.target); } });
  }, { threshold: 0.5 });
  document.querySelectorAll('.count').forEach(el => countIO.observe(el));
</script>
@stack('scripts')
</body>
</html>
