@php $isRtl = app()->getLocale() === 'ar'; @endphp
@extends('layouts.site', [
    'activeNav' => 'news',
    'navHome' => $isRtl ? url('/') : url('/en'),
    'anchorBase' => $isRtl ? url('/') : url('/en'),
    'switchUrl' => $isRtl ? url('/en/news/'.$article['slug']) : url('/news/'.$article['slug']),
])

@php $ak = 'news.articles.'.$article['key']; @endphp

@section('title', __($ak.'.title').' | NAVIX')
@section('description', __($ak.'.excerpt'))

@push('styles')
<style>
  .article-wrap { padding: 132px 0 100px; background: linear-gradient(180deg, var(--secondary) 0%, var(--bg) 340px); }
  .article { max-width: 820px; margin: 0 auto; padding: 0 24px; }

  .article-back { display: inline-flex; align-items: center; gap: 8px; color: var(--muted); font-size: 14px; font-weight: 600; text-decoration: none; margin-bottom: 26px; transition: color 0.2s, gap 0.25s var(--ease); }
  .article-back:hover { color: var(--primary-light); gap: 12px; }
  [dir="rtl"] .article-back svg { transform: scaleX(-1); }

  .article-top { display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; margin-bottom: 30px; }
  .article-badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,122,26,0.12); border: 1px solid rgba(255,122,26,0.28); color: var(--primary-light); font-family: var(--font-display); font-weight: 700; font-size: 12.5px; letter-spacing: 0.05em; padding: 8px 16px; border-radius: 999px; }
  .article-lockup { display: flex; align-items: center; gap: 12px; }
  .article-lockup .plate { border-radius: 12px; height: 46px; display: grid; place-items: center; padding: 8px 14px; }
  .article-lockup .plate img { height: 26px; width: auto; object-fit: contain; }
  .article-lockup .plate-navix { background: var(--surface-2); border: 1px solid var(--border-strong); }
  .article-lockup .plate-partner { background: #fff; }
  .article-lockup .cross { color: var(--muted); font-size: 18px; font-weight: 300; }

  .article h1 { font-family: var(--font-display); font-weight: 800; font-size: clamp(28px, 4vw, 44px); line-height: 1.2; letter-spacing: -0.02em; color: var(--white); }
  .article-dateline { color: var(--primary-light); font-size: 14px; font-weight: 600; font-family: var(--font-num); margin-top: 16px; letter-spacing: 0.01em; }

  .article-hero { margin: 34px 0 40px; border-radius: var(--r-lg); overflow: hidden; border: 1px solid var(--border); box-shadow: var(--shadow-card); }
  .article-hero img { width: 100%; height: auto; display: block; }

  .article-body p { color: #cbd5e1; font-size: 17.5px; line-height: 1.95; margin-bottom: 24px; }
  .article-body p strong { color: var(--white); font-weight: 700; }

  .article-quote { position: relative; margin: 44px 0; padding-inline-start: 24px; border-inline-start: 3px solid var(--primary); }
  .article-quote p { font-family: var(--font-display); font-weight: 700; font-size: clamp(20px, 2.6vw, 27px); line-height: 1.45; color: var(--white); letter-spacing: -0.01em; }

  .article-gallery { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin: 44px 0; }
  .article-gallery figure { margin: 0; border-radius: var(--r-md); overflow: hidden; border: 1px solid var(--border); aspect-ratio: 1 / 1; }
  .article-gallery img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s var(--ease); }
  .article-gallery figure:hover img { transform: scale(1.06); }

  .article-signed { margin-top: 50px; padding-top: 34px; border-top: 1px solid var(--border); text-align: center; }
  .article-signed h4 { color: var(--muted); font-size: 13px; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 26px; font-weight: 600; }
  .signed-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; max-width: 620px; margin: 0 auto; }
  .signed-item { position: relative; }
  .signed-item + .signed-item::before { content: ""; position: absolute; inset-inline-start: -12px; top: 4px; bottom: 4px; width: 1px; background: var(--border); }
  .signed-name { font-family: var(--font-display); font-weight: 700; font-size: 16px; color: var(--white); }
  .signed-role { color: var(--muted); font-size: 13.5px; margin-top: 5px; }

  .article-footer-cta { margin-top: 46px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; padding-top: 30px; border-top: 1px solid var(--border); }
  .article-footer-cta .article-back { margin-bottom: 0; }
  .share-row { display: flex; align-items: center; gap: 10px; }
  .share-row span { color: var(--muted); font-size: 13px; }
  .share-btn { width: 38px; height: 38px; border-radius: 10px; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: rgba(255,255,255,0.8); display: grid; place-items: center; transition: all 0.25s var(--ease); }
  .share-btn:hover { background: var(--primary); border-color: var(--primary); color: #1a0a00; transform: translateY(-3px); }

  @media (max-width: 640px) {
    .article-gallery { grid-template-columns: 1fr; }
    .signed-grid { grid-template-columns: 1fr; gap: 22px; }
    .signed-item + .signed-item::before { display: none; }
    .article-lockup .plate { height: 40px; }
    .article-lockup .plate img { height: 22px; }
  }
</style>
@endpush

@section('content')
@php
    $newsIndex = $isRtl ? url('/news') : url('/en/news');
    $shareUrl = $isRtl ? url('/news/'.$article['slug']) : url('/en/news/'.$article['slug']);
@endphp
<article class="article-wrap">
  <div class="article">
    <a href="{{ $newsIndex }}" class="article-back">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
      {{ __('news.back_to_news') }}
    </a>

    <div class="article-top">
      <span class="article-badge">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 22h16a2 2 0 002-2V4a2 2 0 00-2-2H8a2 2 0 00-2 2v16a2 2 0 01-2 2zm0 0a2 2 0 01-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8M15 18h-5M10 6h8v4h-8z"/></svg>
        {{ __($ak.'.badge') }}
      </span>
      <div class="article-lockup" aria-label="NAVIX × M5AZN">
        <span class="plate plate-navix"><img src="{{ asset('images/navix-logo.png') }}" alt="NAVIX"></span>
        <span class="cross">×</span>
        <span class="plate plate-partner"><img src="{{ asset('images/partners/m5azn-color.png') }}" alt="M5AZN"></span>
      </div>
    </div>

    <h1>{{ __($ak.'.title') }}</h1>
    <p class="article-dateline">{{ __($ak.'.dateline') }}</p>

    <div class="article-hero">
      <img src="{{ asset($article['cover']) }}" alt="{{ __($ak.'.title') }}">
    </div>

    <div class="article-body">
      @foreach(__($ak.'.body') as $para)
        <p>{{ $para }}</p>
      @endforeach

      <blockquote class="article-quote">
        <p>"{{ __($ak.'.pullquote') }}"</p>
      </blockquote>

      @foreach(__($ak.'.body_after') as $para)
        <p>{{ $para }}</p>
      @endforeach
    </div>

    @if(!empty($article['gallery']))
      <div class="article-gallery">
        @foreach($article['gallery'] as $g)
          <figure><img src="{{ asset($g) }}" alt="{{ __($ak.'.title') }}" loading="lazy"></figure>
        @endforeach
      </div>
    @endif

    <div class="article-signed">
      <h4>{{ __('news.signed_by') }}</h4>
      <div class="signed-grid">
        @foreach(__($ak.'.signatories') as $person)
          <div class="signed-item">
            <div class="signed-name">{{ $person['name'] }}</div>
            <div class="signed-role">{{ $person['role'] }}</div>
          </div>
        @endforeach
      </div>
    </div>

    <div class="article-footer-cta">
      <a href="{{ $newsIndex }}" class="article-back">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        {{ __('news.back_to_news') }}
      </a>
      <div class="share-row">
        <span>{{ __('news.share') }}</span>
        <a class="share-btn" href="https://x.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode(__($ak.'.title')) }}" target="_blank" rel="noopener noreferrer" aria-label="X">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18.24 2.25h3.31l-7.23 8.26 8.5 11.24h-6.66l-5.21-6.82-5.97 6.82H1.66l7.73-8.84L1.24 2.25h6.83l4.71 6.23 5.46-6.23zm-1.16 17.52h1.83L7.01 4.13H5.05l12.03 15.64z"/></svg>
        </a>
        <a class="share-btn" href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.44-2.13 2.94v5.67H9.35V9h3.42v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.06 2.06 0 110-4.13 2.06 2.06 0 010 4.13zM7.12 20.45H3.55V9h3.57v11.45zM22.22 0H1.77C.79 0 0 .77 0 1.73v20.54C0 23.22.79 24 1.77 24h20.45c.98 0 1.78-.78 1.78-1.73V1.73C24 .77 23.2 0 22.22 0z"/></svg>
        </a>
      </div>
    </div>
  </div>
</article>
@endsection
