@php $isRtl = app()->getLocale() === 'ar'; @endphp
@extends('layouts.site', [
    'activeNav' => 'news',
    'navHome' => $isRtl ? url('/') : url('/en'),
    'anchorBase' => $isRtl ? url('/') : url('/en'),
    'switchUrl' => $isRtl ? url('/en/news') : url('/news'),
])

@section('title', __('news.meta.title'))
@section('description', __('news.meta.description'))

@php
    $items = array_values($articles);
    $featured = $items[0] ?? null;
    $rest = array_slice($items, 1);
    $newsUrl = fn($slug) => $isRtl ? url('/news/'.$slug) : url('/en/news/'.$slug);
@endphp

@push('styles')
<style>
  .news-hero { position: relative; padding: 170px 0 40px; overflow: hidden; background: linear-gradient(180deg, var(--secondary), var(--bg)); }
  .news-hero-motion { position: absolute; inset: 0; z-index: 0; opacity: 0.45; pointer-events: none; }
  .news-hero-glow { position: absolute; z-index: 0; top: -160px; inset-inline-start: -120px; width: 620px; height: 620px; border-radius: 50%; background: radial-gradient(circle, rgba(255,122,26,0.15), transparent 65%); pointer-events: none; }
  .news-hero .container { position: relative; z-index: 2; max-width: 780px; text-align: center; }
  .news-hero h1 { font-family: var(--font-display); font-weight: 800; font-size: clamp(36px, 5.4vw, 64px); line-height: 1.05; letter-spacing: -0.02em; margin-top: 18px; }
  .news-hero h1 .accent { background: linear-gradient(120deg, var(--primary-light), var(--primary)); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
  .news-hero p { color: var(--muted); font-size: 18px; max-width: 620px; margin: 18px auto 0; line-height: 1.7; }

  .news-section { padding: 40px 0 100px; }

  /* Featured card */
  .news-featured { display: grid; grid-template-columns: 1.15fr 1fr; gap: 0; background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); overflow: hidden; margin-bottom: 46px; transition: transform 0.4s var(--ease), border-color 0.4s var(--ease); }
  .news-featured:hover { transform: translateY(-6px); border-color: rgba(255,122,26,0.3); }
  .news-featured-media { position: relative; min-height: 340px; overflow: hidden; }
  .news-featured-media img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s var(--ease); }
  .news-featured:hover .news-featured-media img { transform: scale(1.04); }
  .news-featured-flag { position: absolute; top: 18px; inset-inline-start: 18px; background: linear-gradient(180deg, var(--primary-light), var(--primary)); color: #1a0a00; font-family: var(--font-display); font-weight: 700; font-size: 12px; letter-spacing: 0.04em; padding: 7px 14px; border-radius: 999px; box-shadow: var(--shadow-glow); }
  .news-featured-body { padding: 46px 44px; display: flex; flex-direction: column; justify-content: center; }
  .news-meta { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; margin-bottom: 16px; }
  .news-tag { background: var(--surface-2); border: 1px solid var(--border); color: var(--primary-light); font-size: 12.5px; font-weight: 600; padding: 5px 13px; border-radius: 999px; }
  .news-date { color: var(--muted); font-size: 13px; font-family: var(--font-num); letter-spacing: 0.02em; }
  .news-featured-body h2 { font-family: var(--font-display); font-weight: 800; font-size: clamp(24px, 2.6vw, 32px); line-height: 1.25; letter-spacing: -0.01em; color: var(--white); }
  .news-featured-body p { color: var(--muted); font-size: 16px; line-height: 1.75; margin-top: 16px; }
  .news-link { margin-top: 26px; display: inline-flex; align-items: center; gap: 8px; color: var(--primary-light); font-family: var(--font-display); font-weight: 700; font-size: 15px; text-decoration: none; align-self: flex-start; transition: gap 0.25s var(--ease); }
  .news-link:hover { gap: 12px; }
  [dir="rtl"] .news-link svg { transform: scaleX(-1); }

  /* Grid of remaining articles */
  .news-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
  .news-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-lg); overflow: hidden; display: flex; flex-direction: column; text-decoration: none; transition: transform 0.4s var(--ease), border-color 0.4s var(--ease); }
  .news-card:hover { transform: translateY(-8px); border-color: rgba(255,122,26,0.3); }
  .news-card-media { aspect-ratio: 16 / 10; overflow: hidden; }
  .news-card-media img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s var(--ease); }
  .news-card:hover .news-card-media img { transform: scale(1.05); }
  .news-card-body { padding: 24px; display: flex; flex-direction: column; flex: 1; }
  .news-card-body h3 { font-family: var(--font-display); font-weight: 700; font-size: 18px; line-height: 1.35; color: var(--white); margin-top: 12px; }
  .news-card-body p { color: var(--muted); font-size: 14px; line-height: 1.6; margin-top: 10px; flex: 1; }
  .news-card .news-link { font-size: 14px; margin-top: 18px; }

  @media (max-width: 900px) {
    .news-featured { grid-template-columns: 1fr; }
    .news-featured-media { min-height: 240px; aspect-ratio: 16 / 9; }
    .news-grid { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 640px) {
    .news-featured-body { padding: 32px 26px; }
    .news-grid { grid-template-columns: 1fr; }
  }
</style>
@endpush

@section('content')
<section class="news-hero">
  <div class="news-hero-motion" data-motion="ambient" aria-hidden="true"></div>
  <div class="news-hero-glow"></div>
  <div class="container">
    <span class="eyebrow">{{ __('news.hero.eyebrow') }}</span>
    <h1>{{ __('news.hero.title_lead') }} <span class="accent">{{ __('news.hero.title_accent') }}</span></h1>
    <p>{{ __('news.hero.sub') }}</p>
  </div>
</section>

<section class="news-section">
  <div class="container">
    @if($featured)
      @php $fk = 'news.articles.'.$featured['key']; @endphp
      <a class="news-featured reveal" href="{{ $newsUrl($featured['slug']) }}" aria-label="{{ __($fk.'.title') }}">
        <div class="news-featured-media">
          <img src="{{ asset($featured['cover']) }}" alt="{{ __($fk.'.title') }}" loading="lazy">
          <span class="news-featured-flag">{{ __('news.featured_label') }}</span>
        </div>
        <div class="news-featured-body">
          <div class="news-meta">
            <span class="news-tag">{{ __($fk.'.tag') }}</span>
            <span class="news-date">{{ __($fk.'.date_label') }}</span>
          </div>
          <h2>{{ __($fk.'.title') }}</h2>
          <p>{{ __($fk.'.excerpt') }}</p>
          <span class="news-link">
            {{ __('news.read_more') }}
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </span>
        </div>
      </a>
    @endif

    @if(count($rest))
      <div class="news-grid">
        @foreach($rest as $i => $article)
          @php $ak = 'news.articles.'.$article['key']; @endphp
          <a class="news-card reveal" data-delay="{{ $i }}" href="{{ $newsUrl($article['slug']) }}">
            <div class="news-card-media">
              <img src="{{ asset($article['cover']) }}" alt="{{ __($ak.'.title') }}" loading="lazy">
            </div>
            <div class="news-card-body">
              <div class="news-meta">
                <span class="news-tag">{{ __($ak.'.tag') }}</span>
                <span class="news-date">{{ __($ak.'.date_label') }}</span>
              </div>
              <h3>{{ __($ak.'.title') }}</h3>
              <p>{{ __($ak.'.excerpt') }}</p>
              <span class="news-link">
                {{ __('news.read_more') }}
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </span>
            </div>
          </a>
        @endforeach
      </div>
    @endif
  </div>
</section>
@endsection
