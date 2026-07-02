@php $isRtl = app()->getLocale() === 'ar'; @endphp
@extends('layouts.site', [
    'activeNav' => 'partners',
    'navHome' => $isRtl ? url('/') : url('/en'),
    'anchorBase' => $isRtl ? url('/') : url('/en'),
    'switchUrl' => $isRtl ? url('/en/partners') : url('/partners'),
])

@section('title', __('partners.meta.title'))
@section('description', __('partners.meta.description'))

@php
    $partners = [
        ['key' => 'm5azn', 'logo' => 'm5azn-color.png', 'url' => 'https://m5azn.com/'],
        ['key' => 'milejet', 'logo' => 'milejet.png', 'url' => 'https://www.milejet.com.sa/'],
    ];
@endphp

@push('styles')
<style>
  .partners-hero { position: relative; padding: 170px 0 60px; overflow: hidden; background: linear-gradient(180deg, var(--secondary), var(--bg)); }
  .partners-hero-motion { position: absolute; inset: 0; z-index: 0; opacity: 0.45; pointer-events: none; }
  .partners-hero-glow { position: absolute; z-index: 0; top: -160px; inset-inline-start: -120px; width: 620px; height: 620px; border-radius: 50%; background: radial-gradient(circle, rgba(255,122,26,0.15), transparent 65%); pointer-events: none; }
  .partners-hero .container { position: relative; z-index: 2; max-width: 780px; text-align: center; }
  .partners-hero h1 { font-family: var(--font-display); font-weight: 800; font-size: clamp(36px, 5.4vw, 64px); line-height: 1.05; letter-spacing: -0.02em; margin-top: 18px; }
  .partners-hero h1 .accent { background: linear-gradient(120deg, var(--primary-light), var(--primary)); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
  .partners-hero p { color: var(--muted); font-size: 18px; max-width: 620px; margin: 18px auto 0; line-height: 1.7; }

  .partners-section { padding: 40px 0 40px; }
  .partners-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 50px; }
  .partner-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); padding: 36px; transition: transform 0.4s var(--ease), border-color 0.4s var(--ease); display: flex; flex-direction: column; }
  .partner-card:hover { transform: translateY(-8px); border-color: rgba(255,122,26,0.3); }
  .partner-plate { background: #fff; border-radius: var(--r-md); height: 132px; display: grid; place-items: center; padding: 26px; margin-bottom: 28px; }
  .partner-plate img { max-height: 72px; max-width: 78%; width: auto; object-fit: contain; }
  .partner-name { font-family: var(--font-display); font-weight: 700; font-size: 23px; color: var(--white); }
  .partner-tagline { color: var(--primary-light); font-size: 14.5px; font-weight: 600; margin-top: 6px; }
  .partner-desc { color: var(--muted); font-size: 15px; line-height: 1.7; margin-top: 16px; flex: 1; }
  .partner-tags { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 22px; }
  .partner-tag { background: var(--surface-2); border: 1px solid var(--border); color: var(--muted); font-size: 12.5px; font-weight: 500; padding: 6px 13px; border-radius: 999px; }
  .partner-link { margin-top: 26px; display: inline-flex; align-items: center; gap: 8px; color: var(--primary-light); font-family: var(--font-display); font-weight: 600; font-size: 14.5px; text-decoration: none; align-self: flex-start; transition: gap 0.25s var(--ease); }
  .partner-link:hover { gap: 12px; }
  .partner-link svg { transition: transform 0.25s var(--ease); }

  .partners-network { padding: 70px 0 40px; border-top: 1px solid var(--border); margin-top: 30px; }
  .network-title { text-align: center; color: var(--muted); font-size: 13px; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 32px; }
  .marquee { position: relative; overflow: hidden; -webkit-mask-image: linear-gradient(90deg, transparent, #000 12%, #000 88%, transparent); mask-image: linear-gradient(90deg, transparent, #000 12%, #000 88%, transparent); }
  .marquee-track { display: flex; gap: 64px; width: max-content; animation: p-marquee 34s linear infinite; }
  [dir="rtl"] .marquee-track { animation-direction: reverse; }
  .marquee:hover .marquee-track { animation-play-state: paused; }
  .marquee-logo { font-family: var(--font-display); font-weight: 700; font-size: 26px; color: rgba(255,255,255,0.5); white-space: nowrap; transition: color 0.25s; flex-shrink: 0; }
  .marquee-logo:hover { color: var(--white); }
  @keyframes p-marquee { to { transform: translateX(-50%); } }

  .partners-cta { padding: 40px 0 100px; }
  .pcta-box { position: relative; overflow: hidden; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-deep) 100%); border-radius: var(--r-xl); padding: 60px 54px; display: grid; grid-template-columns: 1.5fr 1fr; gap: 40px; align-items: center; }
  .pcta-motion { position: absolute; inset: 0; z-index: 1; pointer-events: none; border-radius: inherit; overflow: hidden; }
  .pcta-box > * { position: relative; z-index: 2; }
  .pcta-box .eyebrow { color: rgba(26,10,0,0.75); }
  .pcta-box .eyebrow::before { background: rgba(26,10,0,0.5); }
  .pcta-box h2 { font-family: var(--font-display); font-weight: 800; font-size: clamp(28px, 3.6vw, 42px); color: #1a0a00; line-height: 1.1; letter-spacing: -0.02em; margin-top: 14px; }
  .pcta-box p { color: rgba(26,10,0,0.82); margin-top: 12px; font-size: 16px; max-width: 460px; }
  .pcta-actions { display: flex; gap: 12px; flex-wrap: wrap; justify-content: flex-end; }
  .pcta-actions .btn-primary { background: #0a0f18; color: var(--white); box-shadow: 0 20px 50px -20px rgba(0,0,0,0.6); }
  .pcta-actions .btn-primary:hover { background: #000; }
  .pcta-actions .btn-ghost { color: #1a0a00; border-color: rgba(26,10,0,0.35); background: rgba(255,255,255,0.14); }
  .pcta-actions .btn-ghost:hover { background: rgba(255,255,255,0.28); border-color: #1a0a00; color: #1a0a00; }

  @media (max-width: 860px) {
    .partners-grid { grid-template-columns: 1fr; }
    .pcta-box { grid-template-columns: 1fr; padding: 44px 32px; }
    .pcta-actions { justify-content: flex-start; }
  }
</style>
@endpush

@section('content')
<section class="partners-hero">
  <div class="partners-hero-motion" data-motion="ambient" aria-hidden="true"></div>
  <div class="partners-hero-glow"></div>
  <div class="container">
    <span class="eyebrow">{{ __('partners.hero.eyebrow') }}</span>
    <h1>{{ __('partners.hero.title_lead') }} <span class="accent">{{ __('partners.hero.title_accent') }}</span></h1>
    <p>{{ __('partners.hero.sub') }}</p>
  </div>
</section>

<section class="partners-section">
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow">{{ __('partners.featured.eyebrow') }}</span>
      <h2 class="h-section">{{ __('partners.featured.title_lead') }} <span class="accent">{{ __('partners.featured.title_accent') }}</span></h2>
      <p class="sub-section">{{ __('partners.featured.sub') }}</p>
    </div>
    <div class="partners-grid">
      @foreach($partners as $i => $partner)
      @php $base = 'partners.p.'.$partner['key']; @endphp
      <div class="partner-card reveal" data-delay="{{ $i }}">
        <div class="partner-plate">
          <img src="{{ asset('images/partners/'.$partner['logo']) }}" alt="{{ __($base.'.name') }}" loading="lazy">
        </div>
        <div class="partner-name">{{ __($base.'.name') }}</div>
        <div class="partner-tagline">{{ __($base.'.tagline') }}</div>
        <p class="partner-desc">{{ __($base.'.desc') }}</p>
        <div class="partner-tags">
          @foreach(__($base.'.tags') as $tag)
            <span class="partner-tag">{{ $tag }}</span>
          @endforeach
        </div>
        <a class="partner-link" href="{{ $partner['url'] }}" target="_blank" rel="noopener noreferrer">
          {{ __('partners.visit') }}
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section class="partners-cta">
  <div class="container">
    <div class="pcta-box reveal">
      <div class="pcta-motion" data-motion="cta" aria-hidden="true"></div>
      <div>
        <span class="eyebrow">{{ __('partners.cta.eyebrow') }}</span>
        <h2>{{ __('partners.cta.title') }}</h2>
        <p>{{ __('partners.cta.sub') }}</p>
      </div>
      <div class="pcta-actions">
        <a href="{{ ($isRtl ? url('/') : url('/en')) }}#contact" class="btn btn-primary">
          {{ __('partners.cta.primary') }}
          <svg class="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <a href="mailto:info@navix.com.sa" class="btn btn-ghost">{{ __('partners.cta.secondary') }}</a>
      </div>
    </div>
  </div>
</section>
@endsection
