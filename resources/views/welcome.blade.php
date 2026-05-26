<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>NAVIX | حلول لوجستية ذكية — نربط أعمالك، نوصل بثقة</title>
<meta name="description" content="NAVIX — حلول لوجستية متكاملة: تخزين، تجهيز طلبات، شحن، وتوصيل أخير في جميع أنحاء المملكة. Smart Fulfillment, Delivered." />
<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Crect width='24' height='24' fill='%230A1A35'/%3E%3Ctext x='12' y='17' font-family='Arial' font-weight='900' font-size='14' fill='%23F47B20' text-anchor='middle'%3EX%3C/text%3E%3C/svg%3E">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  :root {
    --navy-900: #0A1A35;
    --navy-800: #0F2548;
    --navy-700: #16315C;
    --navy-600: #1E3D72;
    --navy-500: #2E4D85;
    --orange-500: #F47B20;
    --orange-400: #FF8C2E;
    --orange-300: #FFA557;
    --ink-100: #F5F7FB;
    --ink-200: #E4E8F0;
    --ink-300: #B8C0CF;
    --ink-400: #8290A8;
    --white: #FFFFFF;

    --font-display: 'Tajawal', sans-serif;
    --font-body: 'IBM Plex Sans Arabic', 'Tajawal', sans-serif;
    --font-num: 'Space Grotesk', 'Tajawal', sans-serif;

    --container: 1240px;
    --r-sm: 8px;
    --r-md: 14px;
    --r-lg: 22px;
    --r-xl: 32px;

    --shadow-card: 0 10px 30px -12px rgba(10, 26, 53, 0.35);
    --shadow-elev: 0 20px 50px -20px rgba(244, 123, 32, 0.35);
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }
  html { scroll-behavior: smooth; }
  body {
    font-family: var(--font-body);
    background: var(--navy-900);
    color: var(--ink-100);
    line-height: 1.6;
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
  }

  .container { max-width: var(--container); margin: 0 auto; padding: 0 24px; }
  .eyebrow {
    display: inline-flex; align-items: center; gap: 10px;
    font-family: var(--font-display); font-weight: 500;
    font-size: 13px; letter-spacing: 0.08em; text-transform: uppercase;
    color: var(--orange-400);
  }
  .eyebrow::before {
    content: ""; width: 28px; height: 2px; background: var(--orange-500);
  }
  .h-section {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: clamp(28px, 4vw, 44px);
    line-height: 1.2;
    color: var(--white);
    margin-top: 14px;
  }
  .h-section .accent { color: var(--orange-400); }
  .sub-section {
    color: var(--ink-300);
    font-size: 16px;
    max-width: 620px;
    margin-top: 14px;
  }

  .btn {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 14px 26px;
    border-radius: var(--r-md);
    font-family: var(--font-display);
    font-weight: 700; font-size: 15px;
    cursor: pointer;
    border: none;
    text-decoration: none;
    transition: all 0.25s ease;
    position: relative;
  }
  .btn-primary {
    background: var(--orange-500);
    color: var(--white);
    box-shadow: var(--shadow-elev);
  }
  .btn-primary:hover { background: var(--orange-400); transform: translateY(-2px); }
  .btn-ghost {
    background: transparent;
    color: var(--white);
    border: 1.5px solid rgba(255,255,255,0.2);
  }
  .btn-ghost:hover { border-color: var(--orange-400); color: var(--orange-400); }
  .btn .arrow { transition: transform 0.25s; }
  .btn:hover .arrow { transform: translateX(-4px); }

  .nav-wrap {
    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
    backdrop-filter: blur(14px);
    background: rgba(10, 26, 53, 0.85);
    border-bottom: 1px solid rgba(255,255,255,0.06);
  }
  nav {
    max-width: var(--container);
    margin: 0 auto;
    padding: 18px 24px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 24px;
  }
  .brand {
    display: flex; align-items: center; gap: 4px;
    font-family: var(--font-display); font-weight: 900;
    font-size: 28px; letter-spacing: -0.02em;
    color: var(--white);
    text-decoration: none;
  }
  .brand .x {
    color: var(--orange-500);
    display: inline-block;
    transform: skewX(-8deg);
  }
  .nav-links {
    display: flex; align-items: center; gap: 30px;
    list-style: none;
  }
  .nav-links a {
    color: var(--ink-200);
    text-decoration: none;
    font-size: 14px; font-weight: 500;
    transition: color 0.2s;
    position: relative;
  }
  .nav-links a:hover { color: var(--orange-400); }
  .nav-links a.active { color: var(--orange-400); }
  .nav-links a.active::after {
    content: ""; position: absolute; right: 0; left: 0; bottom: -8px;
    height: 2px; background: var(--orange-500);
  }
  .nav-cta {
    display: flex; align-items: center; gap: 12px;
  }
  .auth-link {
    color: var(--ink-200);
    text-decoration: none;
    font-size: 14px; font-weight: 600;
    padding: 8px 14px;
    border-radius: var(--r-sm);
    transition: color 0.2s;
  }
  .auth-link:hover { color: var(--orange-400); }
  .lang-btn {
    background: rgba(255,255,255,0.06);
    color: var(--white);
    border: 1px solid rgba(255,255,255,0.1);
    padding: 8px 14px;
    border-radius: var(--r-sm);
    font-size: 13px; font-weight: 600;
    cursor: pointer;
    display: flex; align-items: center; gap: 6px;
  }
  .nav-cta .btn { padding: 11px 20px; font-size: 14px; }
  .menu-toggle { display: none; background: none; border: none; color: white; cursor: pointer; }

  .hero {
    position: relative;
    padding: 140px 0 80px;
    overflow: hidden;
    background:
      radial-gradient(circle at 85% 30%, rgba(244, 123, 32, 0.18), transparent 50%),
      radial-gradient(circle at 15% 70%, rgba(30, 61, 114, 0.4), transparent 55%),
      var(--navy-900);
  }
  .hero::before {
    content: "";
    position: absolute; inset: 0;
    background-image:
      linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
    background-size: 60px 60px;
    mask-image: radial-gradient(ellipse 80% 60% at center, black, transparent 70%);
    -webkit-mask-image: radial-gradient(ellipse 80% 60% at center, black, transparent 70%);
    pointer-events: none;
  }
  .hero-grid {
    display: grid;
    grid-template-columns: 1.05fr 0.95fr;
    gap: 60px;
    align-items: center;
    position: relative;
    z-index: 2;
  }
  .hero-copy h1 {
    font-family: var(--font-display);
    font-size: clamp(38px, 5.5vw, 68px);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.02em;
    color: var(--white);
    margin: 18px 0 22px;
  }
  .hero-copy h1 .accent {
    color: var(--orange-400);
    position: relative;
    display: inline-block;
  }
  .hero-copy h1 .accent::after {
    content: "";
    position: absolute;
    right: 0; left: 0; bottom: 4px;
    height: 8px;
    background: rgba(244, 123, 32, 0.2);
    z-index: -1;
  }
  .hero-copy p {
    font-size: 18px;
    color: var(--ink-300);
    max-width: 540px;
    margin-bottom: 36px;
  }
  .hero-cta { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 40px; }
  .hero-trust {
    display: flex; align-items: center; gap: 14px;
    color: var(--ink-400); font-size: 13px;
  }
  .avatars { display: flex; }
  .avatar {
    width: 32px; height: 32px; border-radius: 50%;
    background: linear-gradient(135deg, var(--orange-400), var(--orange-500));
    border: 2px solid var(--navy-900);
    margin-left: -10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 700; color: white;
    font-family: var(--font-num);
  }
  .avatar:nth-child(2) { background: linear-gradient(135deg, #4A90E2, #357ABD); }
  .avatar:nth-child(3) { background: linear-gradient(135deg, #50C9B5, #2E9D8C); }
  .avatar:nth-child(4) { background: linear-gradient(135deg, #B968D9, #8E44AD); }

  .hero-visual {
    position: relative;
    height: 520px;
  }
  .x-chevron {
    position: absolute;
    inset: 0;
    display: flex; align-items: center; justify-content: center;
  }
  .chevron-shape {
    width: 100%; height: 100%;
    position: relative;
  }
  .chevron-shape svg { width: 100%; height: 100%; }
  .floating-card {
    position: absolute;
    background: rgba(15, 37, 72, 0.85);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--r-md);
    padding: 14px 18px;
    display: flex; align-items: center; gap: 12px;
    box-shadow: var(--shadow-card);
    z-index: 3;
  }
  .floating-card.fc-1 { top: 60px; right: -10px; }
  .floating-card.fc-2 { bottom: 80px; left: -20px; }
  .fc-icon {
    width: 38px; height: 38px;
    border-radius: 10px;
    background: rgba(244, 123, 32, 0.15);
    color: var(--orange-400);
    display: grid; place-items: center;
  }
  .fc-meta { display: flex; flex-direction: column; }
  .fc-label { font-size: 11px; color: var(--ink-400); }
  .fc-value { font-family: var(--font-num); font-weight: 700; font-size: 16px; color: var(--white); }

  @keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.4); }
  }
  .pulse-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: #4ADE80;
    animation: pulse-dot 1.8s ease-in-out infinite;
  }

  .stats {
    background: var(--navy-800);
    border-top: 1px solid rgba(255,255,255,0.05);
    border-bottom: 1px solid rgba(255,255,255,0.05);
    padding: 36px 0;
    position: relative;
  }
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 24px;
  }
  .stat {
    text-align: center;
    padding: 0 16px;
    border-left: 1px solid rgba(255,255,255,0.08);
  }
  .stat:last-child { border-left: none; }
  .stat-icon {
    width: 48px; height: 48px;
    border-radius: 12px;
    background: rgba(244,123,32,0.12);
    color: var(--orange-400);
    display: grid; place-items: center;
    margin: 0 auto 12px;
  }
  .stat-value {
    font-family: var(--font-num);
    font-weight: 700; font-size: 28px;
    color: var(--white);
    line-height: 1;
  }
  .stat-label {
    color: var(--ink-300);
    font-size: 13px;
    margin-top: 6px;
  }

  .services { padding: 100px 0; background: var(--navy-900); }
  .section-head { text-align: center; margin-bottom: 60px; }
  .section-head .eyebrow { display: inline-flex; justify-content: center; }
  .section-head .sub-section { margin: 14px auto 0; }
  .services-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
  }
  .service-card {
    background: linear-gradient(180deg, var(--navy-800), var(--navy-700));
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: var(--r-lg);
    padding: 30px 24px;
    position: relative;
    overflow: hidden;
    transition: all 0.35s ease;
    cursor: pointer;
  }
  .service-card::before {
    content: "";
    position: absolute;
    top: 0; right: 0;
    width: 60px; height: 4px;
    background: var(--orange-500);
    transform: translateX(100%);
    transition: transform 0.35s ease;
  }
  .service-card:hover {
    transform: translateY(-6px);
    border-color: rgba(244,123,32,0.3);
  }
  .service-card:hover::before { transform: translateX(0); }
  .service-icon {
    width: 56px; height: 56px;
    border-radius: 14px;
    background: linear-gradient(135deg, rgba(244,123,32,0.25), rgba(244,123,32,0.08));
    color: var(--orange-400);
    display: grid; place-items: center;
    margin-bottom: 20px;
  }
  .service-card h3 {
    font-family: var(--font-display);
    font-weight: 700; font-size: 18px;
    color: var(--white);
    margin-bottom: 10px;
  }
  .service-card p { color: var(--ink-300); font-size: 14px; line-height: 1.6; }
  .service-card .more {
    margin-top: 18px;
    color: var(--orange-400);
    font-size: 13px; font-weight: 600;
    display: flex; align-items: center; gap: 6px;
  }

  .how-section {
    padding: 100px 0;
    background:
      linear-gradient(180deg, var(--navy-900) 0%, var(--navy-800) 100%);
    position: relative;
    overflow: hidden;
  }
  .how-section::before {
    content: "";
    position: absolute;
    top: -100px; left: -100px;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(244,123,32,0.08), transparent 70%);
    pointer-events: none;
  }
  .how-flow {
    margin-top: 60px;
    position: relative;
    background: rgba(10, 26, 53, 0.6);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: var(--r-xl);
    padding: 50px 30px;
  }
  .flow-steps {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    position: relative;
  }
  .flow-line {
    position: absolute;
    top: 36px;
    right: 12.5%;
    left: 12.5%;
    height: 2px;
    background: repeating-linear-gradient(90deg, var(--orange-500) 0 8px, transparent 8px 16px);
    z-index: 1;
  }
  .flow-step {
    position: relative;
    text-align: center;
    z-index: 2;
  }
  .step-num {
    width: 72px; height: 72px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--orange-500), var(--orange-400));
    color: var(--white);
    font-family: var(--font-num);
    font-weight: 700; font-size: 28px;
    display: grid; place-items: center;
    margin: 0 auto 18px;
    box-shadow: 0 8px 24px -8px rgba(244,123,32,0.5);
    border: 4px solid var(--navy-800);
  }
  .step-icon {
    color: var(--orange-400);
    margin-bottom: 8px;
    display: inline-block;
  }
  .flow-step h4 {
    font-family: var(--font-display);
    font-weight: 700; font-size: 17px;
    color: var(--white);
    margin-bottom: 6px;
  }
  .flow-step p { color: var(--ink-300); font-size: 13px; }

  .why { padding: 100px 0; background: var(--navy-900); }
  .why-grid {
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    gap: 60px;
    align-items: center;
  }
  .why-features {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    margin-top: 36px;
  }
  .why-item {
    background: rgba(15, 37, 72, 0.5);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: var(--r-md);
    padding: 20px;
  }
  .why-item-icon {
    width: 38px; height: 38px;
    border-radius: 10px;
    background: rgba(244,123,32,0.15);
    color: var(--orange-400);
    display: grid; place-items: center;
    margin-bottom: 12px;
  }
  .why-item h4 {
    font-family: var(--font-display);
    font-weight: 700; font-size: 15px;
    color: var(--white);
    margin-bottom: 6px;
  }
  .why-item p { color: var(--ink-300); font-size: 13px; }

  .why-visual {
    position: relative;
    background: linear-gradient(135deg, var(--navy-700), var(--navy-800));
    border-radius: var(--r-xl);
    padding: 40px;
    overflow: hidden;
    aspect-ratio: 4/5;
  }
  .why-visual::before {
    content: "";
    position: absolute;
    inset: 0;
    background:
      radial-gradient(circle at 30% 20%, rgba(244,123,32,0.2), transparent 50%),
      radial-gradient(circle at 70% 80%, rgba(30,61,114,0.5), transparent 50%);
  }
  .why-badge {
    position: absolute;
    background: rgba(10, 26, 53, 0.85);
    backdrop-filter: blur(16px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--r-md);
    padding: 16px;
    box-shadow: var(--shadow-card);
  }
  .why-badge.wb-1 { top: 40px; right: 40px; min-width: 180px; }
  .why-badge.wb-2 { bottom: 80px; left: 40px; min-width: 200px; }
  .why-badge.wb-3 { top: 50%; right: 30%; transform: translateY(-50%); min-width: 160px; }
  .wb-title { font-size: 12px; color: var(--ink-400); margin-bottom: 4px; }
  .wb-val { font-family: var(--font-num); font-weight: 700; color: var(--white); font-size: 18px; }
  .wb-progress {
    height: 4px;
    background: rgba(255,255,255,0.1);
    border-radius: 4px;
    margin-top: 10px;
    overflow: hidden;
  }
  .wb-bar { height: 100%; background: var(--orange-500); border-radius: 4px; }

  .partners {
    padding: 70px 0;
    background: var(--navy-800);
    border-top: 1px solid rgba(255,255,255,0.05);
    border-bottom: 1px solid rgba(255,255,255,0.05);
  }
  .partners-title {
    text-align: center;
    color: var(--ink-400);
    font-size: 14px; font-weight: 500;
    letter-spacing: 0.06em;
    margin-bottom: 36px;
  }
  .partners-logos {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 30px;
    align-items: center;
  }
  .partner-logo {
    font-family: var(--font-display);
    font-weight: 700;
    color: var(--ink-300);
    text-align: center;
    font-size: 18px;
    opacity: 0.6;
    transition: opacity 0.2s;
    letter-spacing: 0.02em;
  }
  .partner-logo:hover { opacity: 1; color: var(--white); }

  .cta-banner {
    padding: 90px 0;
    background: var(--navy-900);
    position: relative;
  }
  .cta-box {
    background:
      linear-gradient(135deg, var(--orange-500) 0%, #D8651A 100%);
    border-radius: var(--r-xl);
    padding: 60px 50px;
    position: relative;
    overflow: hidden;
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 40px;
    align-items: center;
  }
  .cta-box::before {
    content: "";
    position: absolute;
    top: -50%; left: -10%;
    width: 60%; height: 200%;
    background: rgba(255,255,255,0.05);
    transform: rotate(20deg);
    pointer-events: none;
  }
  .cta-box::after {
    content: "";
    position: absolute;
    inset: 0;
    background-image:
      radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
    background-size: 24px 24px;
    opacity: 0.4;
    pointer-events: none;
  }
  .cta-box h2 {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: clamp(26px, 3.5vw, 38px);
    color: var(--white);
    line-height: 1.2;
    position: relative;
    z-index: 2;
  }
  .cta-box p { color: rgba(255,255,255,0.9); margin-top: 12px; position: relative; z-index: 2; }
  .cta-actions { display: flex; gap: 12px; flex-wrap: wrap; position: relative; z-index: 2; justify-content: flex-end; }
  .cta-actions .btn-primary { background: var(--white); color: var(--navy-900); }
  .cta-actions .btn-primary:hover { background: var(--navy-900); color: var(--white); }
  .cta-actions .btn-ghost { color: var(--white); border-color: rgba(255,255,255,0.4); }
  .cta-actions .btn-ghost:hover { background: rgba(255,255,255,0.1); border-color: var(--white); }

  footer {
    background: var(--navy-900);
    padding: 80px 0 30px;
    border-top: 1px solid rgba(255,255,255,0.06);
  }
  .footer-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1fr 1fr;
    gap: 40px;
    margin-bottom: 50px;
  }
  .footer-brand { max-width: 320px; }
  .footer-brand p {
    color: var(--ink-300);
    font-size: 14px;
    margin: 18px 0 24px;
  }
  .socials { display: flex; gap: 10px; }
  .social-icon {
    width: 38px; height: 38px;
    border-radius: 10px;
    background: rgba(255,255,255,0.06);
    color: var(--ink-200);
    display: grid; place-items: center;
    transition: all 0.2s;
    cursor: pointer;
  }
  .social-icon:hover {
    background: var(--orange-500);
    color: var(--white);
  }
  .footer-col h5 {
    font-family: var(--font-display);
    font-weight: 700; font-size: 15px;
    color: var(--white);
    margin-bottom: 20px;
  }
  .footer-col ul { list-style: none; }
  .footer-col li { margin-bottom: 12px; }
  .footer-col a {
    color: var(--ink-300);
    text-decoration: none;
    font-size: 14px;
    transition: color 0.2s;
  }
  .footer-col a:hover { color: var(--orange-400); }
  .contact-li { display: flex; align-items: flex-start; gap: 10px; color: var(--ink-300); font-size: 13px; }
  .contact-li svg { color: var(--orange-400); flex-shrink: 0; margin-top: 2px; }

  .footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.06);
    padding-top: 24px;
    display: flex; justify-content: space-between; align-items: center;
    color: var(--ink-400); font-size: 13px;
  }
  .footer-bottom-links { display: flex; gap: 24px; }
  .footer-bottom-links a { color: var(--ink-400); text-decoration: none; }
  .footer-bottom-links a:hover { color: var(--orange-400); }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .hero-copy > * { animation: fadeUp 0.7s ease-out backwards; }
  .hero-copy .eyebrow { animation-delay: 0.1s; }
  .hero-copy h1 { animation-delay: 0.2s; }
  .hero-copy p { animation-delay: 0.3s; }
  .hero-copy .hero-cta { animation-delay: 0.4s; }
  .hero-copy .hero-trust { animation-delay: 0.5s; }

  @keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-12px); }
  }
  .floating-card.fc-1 { animation: float 4s ease-in-out infinite; }
  .floating-card.fc-2 { animation: float 4s ease-in-out infinite 2s; }

  @media (max-width: 1024px) {
    .hero-grid { grid-template-columns: 1fr; }
    .hero-visual { height: 380px; max-width: 500px; margin: 0 auto; }
    .stats-grid { grid-template-columns: repeat(3, 1fr); }
    .stat:nth-child(n+4) { border-top: 1px solid rgba(255,255,255,0.08); padding-top: 24px; margin-top: 12px; }
    .services-grid { grid-template-columns: repeat(2, 1fr); }
    .flow-steps { grid-template-columns: repeat(2, 1fr); }
    .flow-line { display: none; }
    .why-grid { grid-template-columns: 1fr; }
    .partners-logos { grid-template-columns: repeat(4, 1fr); row-gap: 24px; }
    .footer-grid { grid-template-columns: 1fr 1fr; }
    .cta-box { grid-template-columns: 1fr; }
    .cta-actions { justify-content: flex-start; }
  }
  @media (max-width: 640px) {
    .nav-links { display: none; }
    .menu-toggle { display: block; }
    .auth-link { display: none; }
    .hero { padding: 110px 0 60px; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .stat { border-left: none; }
    .services-grid { grid-template-columns: 1fr; }
    .flow-steps { grid-template-columns: 1fr; }
    .why-features { grid-template-columns: 1fr; }
    .partners-logos { grid-template-columns: repeat(2, 1fr); }
    .footer-grid { grid-template-columns: 1fr; }
    .footer-bottom { flex-direction: column; gap: 14px; text-align: center; }
    .cta-box { padding: 40px 28px; }
    .floating-card { padding: 10px 14px; }
    .fc-value { font-size: 14px; }
  }
</style>
</head>
<body>

<div class="nav-wrap">
  <nav>
    <a href="{{ url('/') }}" class="brand" aria-label="NAVIX">
      <span>NAVI</span><span class="x">X</span>
    </a>
    <ul class="nav-links">
      <li><a href="#home" class="active">الرئيسية</a></li>
      <li><a href="#services">خدماتنا</a></li>
      <li><a href="#how">كيف نعمل</a></li>
      <li><a href="#why">لماذا نافيكس</a></li>
      <li><a href="#partners">شركاؤنا</a></li>
      <li><a href="#contact">تواصل معنا</a></li>
    </ul>
    <div class="nav-cta">
      @auth
        <a href="{{ url('/dashboard') }}" class="auth-link">لوحة التحكم</a>
      @else
        @if (Route::has('login'))
          <a href="{{ route('login') }}" class="auth-link">تسجيل الدخول</a>
        @endif
      @endauth
      <button class="lang-btn" type="button" aria-label="language">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>
        EN
      </button>
      <a href="#contact" class="btn btn-primary">
        اطلب عرض سعر
        <svg class="arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
      </a>
    </div>
    <button class="menu-toggle" aria-label="menu">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
    </button>
  </nav>
</div>

<section class="hero" id="home">
  <div class="container hero-grid">
    <div class="hero-copy">
      <span class="eyebrow">Smart Fulfillment, Delivered</span>
      <h1>
        نوصِّل ما يهمّك<br>
        في <span class="accent">الوقت المحدد</span>
      </h1>
      <p>
        حلول لوجستية ذكية متكاملة — من التخزين إلى تجهيز الطلبات وحتى التوصيل الأخير. نربط أعمالك بعملائك في جميع أنحاء المملكة بأعلى معايير الجودة والأمان.
      </p>
      <div class="hero-cta">
        <a href="#contact" class="btn btn-primary">
          ابدأ مع نافيكس
          <svg class="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </a>
        <a href="#services" class="btn btn-ghost">استكشف خدماتنا</a>
      </div>
      <div class="hero-trust">
        <div class="avatars">
          <div class="avatar">SN</div>
          <div class="avatar">NA</div>
          <div class="avatar">IH</div>
          <div class="avatar">+</div>
        </div>
        <span>أكثر من <strong style="color:var(--white)">500 شركة</strong> تثق بنا لإدارة عملياتها اللوجستية</span>
      </div>
    </div>

    <div class="hero-visual">
      <div class="x-chevron">
        <div class="chevron-shape">
          <svg viewBox="0 0 500 500" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <linearGradient id="g1" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#FF8C2E"/>
                <stop offset="100%" stop-color="#D8651A"/>
              </linearGradient>
              <linearGradient id="g2" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#1E3D72"/>
                <stop offset="100%" stop-color="#0F2548"/>
              </linearGradient>
              <linearGradient id="gWhite" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.95"/>
                <stop offset="100%" stop-color="#E4E8F0" stop-opacity="0.85"/>
              </linearGradient>
            </defs>
            <path d="M 260 60 L 380 60 L 480 250 L 380 440 L 260 440 L 360 250 Z" fill="url(#g1)" opacity="0.95"/>
            <path d="M 20 60 L 140 60 L 240 250 L 140 440 L 20 440 L 120 250 Z" fill="url(#gWhite)" opacity="0.9"/>
            <g transform="translate(180, 200)">
              <rect x="0" y="20" width="90" height="60" rx="6" fill="url(#g2)" stroke="#0A1A35" stroke-width="2"/>
              <rect x="90" y="35" width="50" height="45" rx="4" fill="url(#g2)" stroke="#0A1A35" stroke-width="2"/>
              <rect x="100" y="42" width="32" height="20" rx="2" fill="#FF8C2E" opacity="0.8"/>
              <circle cx="25" cy="85" r="10" fill="#0A1A35" stroke="#FF8C2E" stroke-width="2"/>
              <circle cx="115" cy="85" r="10" fill="#0A1A35" stroke="#FF8C2E" stroke-width="2"/>
              <text x="20" y="58" font-family="Arial, sans-serif" font-weight="900" font-size="14" fill="#FFFFFF">NAVIX</text>
            </g>
            <circle cx="80" cy="120" r="4" fill="#FF8C2E"/>
            <circle cx="420" cy="120" r="4" fill="#FF8C2E"/>
            <circle cx="80" cy="380" r="4" fill="#FFFFFF"/>
            <circle cx="420" cy="380" r="4" fill="#FFFFFF"/>
          </svg>
        </div>
      </div>

      <div class="floating-card fc-1">
        <div class="fc-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
        </div>
        <div class="fc-meta">
          <span class="fc-label">معدل التسليم في الوقت</span>
          <span class="fc-value">99.5%</span>
        </div>
      </div>

      <div class="floating-card fc-2">
        <div class="pulse-dot"></div>
        <div class="fc-meta">
          <span class="fc-label">شحنة قيد التوصيل الآن</span>
          <span class="fc-value">+1,240</span>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="stats">
  <div class="container">
    <div class="stats-grid">
      <div class="stat">
        <div class="stat-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
        </div>
        <div class="stat-value">99.5%</div>
        <div class="stat-label">دقة الطلبات</div>
      </div>
      <div class="stat">
        <div class="stat-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 01-9 8.5 8.5 8.5 0 01-7.6-4.7L3 21l1.7-1.4A8.38 8.38 0 013 11.5a8.5 8.5 0 0117 0z"/></svg>
        </div>
        <div class="stat-value">24/7</div>
        <div class="stat-label">دعم وضمانة</div>
      </div>
      <div class="stat">
        <div class="stat-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><path d="M3.27 6.96L12 12l8.73-5.04M12 22.08V12"/></svg>
        </div>
        <div class="stat-value">+1M</div>
        <div class="stat-label">طلب تمت معالجته</div>
      </div>
      <div class="stat">
        <div class="stat-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><path d="M9 22V12h6v10"/></svg>
        </div>
        <div class="stat-value">+50K</div>
        <div class="stat-label">م² مساحة تخزين</div>
      </div>
      <div class="stat">
        <div class="stat-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
        </div>
        <div class="stat-value">+500</div>
        <div class="stat-label">عميل نشط</div>
      </div>
    </div>
  </div>
</section>

<section class="services" id="services">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">خدماتنا</span>
      <h2 class="h-section">حلول متكاملة لدعم كل مرحلة من <span class="accent">رحلتك</span></h2>
      <p class="sub-section">من لحظة استلام البضاعة وحتى وصولها لباب العميل — نوفّر لك كل ما تحتاجه لتنمو بثقة.</p>
    </div>
    <div class="services-grid">
      <div class="service-card">
        <div class="service-icon">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
        </div>
        <h3>الشحن والتوصيل</h3>
        <p>توصيل سريع ضمن المملكة وخارجها عبر شبكة موزّعين موثوقين.</p>
        <span class="more">المزيد <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg></span>
      </div>
      <div class="service-card">
        <div class="service-icon">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <h3>التوصيل في نفس اليوم</h3>
        <p>خدمة Same-day delivery داخل المدن الكبرى مع تتبع لحظي للشحنة.</p>
        <span class="more">المزيد <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg></span>
      </div>
      <div class="service-card">
        <div class="service-icon">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        </div>
        <h3>تجهيز الطلبات</h3>
        <p>التقاط، تغليف، وفهرسة احترافية مع ضمان دقة لا تقل عن 99.5%.</p>
        <span class="more">المزيد <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg></span>
      </div>
      <div class="service-card">
        <div class="service-icon">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <h3>التخزين الذكي</h3>
        <p>مستودعات حديثة بنظام WMS متقدم يناسب احتياجات أعمالك المتغيرة.</p>
        <span class="more">المزيد <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg></span>
      </div>
      <div class="service-card">
        <div class="service-icon">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><polyline points="23 20 23 14 17 14"/><path d="M20.49 9A9 9 0 005.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 013.51 15"/></svg>
        </div>
        <h3>إدارة المرتجعات</h3>
        <p>إدارة سلسة وآمنة للمرتجعات مع تقارير شاملة وفحص جودة دقيق.</p>
        <span class="more">المزيد <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg></span>
      </div>
    </div>
  </div>
</section>

<section class="how-section" id="how">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">كيف نعمل</span>
      <h2 class="h-section">عملية بسيطة... <span class="accent">نتائج استثنائية</span></h2>
      <p class="sub-section">أربع خطوات فقط تفصلك عن نظام لوجستي متكامل يدير عملياتك بكفاءة.</p>
    </div>
    <div class="how-flow">
      <div class="flow-steps">
        <div class="flow-line"></div>
        <div class="flow-step">
          <div class="step-num">1</div>
          <div class="step-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          </div>
          <h4>استلام البضائع</h4>
          <p>نستلم شحناتك ونفحصها بدقة في مستودعاتنا.</p>
        </div>
        <div class="flow-step">
          <div class="step-num">2</div>
          <div class="step-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
          </div>
          <h4>التخزين الذكي</h4>
          <p>تخزين منظم وفهرسة في أفضل الظروف مع إدارة ذكية.</p>
        </div>
        <div class="flow-step">
          <div class="step-num">3</div>
          <div class="step-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
          </div>
          <h4>تجهيز الطلبات</h4>
          <p>تجهيز طلبات عملائك بدقة عالية وسرعة قياسية.</p>
        </div>
        <div class="flow-step">
          <div class="step-num">4</div>
          <div class="step-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
          </div>
          <h4>الشحن والتوصيل</h4>
          <p>نوصّل سريعاً لعملائك أينما كانوا بسهولة وموثوقية.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="why" id="why">
  <div class="container">
    <div class="why-grid">
      <div>
        <span class="eyebrow">لماذا نافيكس</span>
        <h2 class="h-section">شريك لوجستي ذكي لأعمال <span class="accent">تنمو بثقة</span></h2>
        <p class="sub-section">نختصر عليك تعقيدات اللوجستيات لتركّز أنت على أهم شيء: نمو أعمالك.</p>
        <div class="why-features">
          <div class="why-item">
            <div class="why-item-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <h4>أمان وموثوقية</h4>
            <p>تأمين شامل لشحناتك في كل مرحلة من رحلتها.</p>
          </div>
          <div class="why-item">
            <div class="why-item-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <h4>التزام بالمواعيد</h4>
            <p>التزام صارم بأوقات التسليم المتفق عليها.</p>
          </div>
          <div class="why-item">
            <div class="why-item-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <h4>تغطية واسعة</h4>
            <p>شبكة توصيل تشمل كل مناطق المملكة.</p>
          </div>
          <div class="why-item">
            <div class="why-item-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            </div>
            <h4>تتبع لحظي</h4>
            <p>تتبع شحناتك خطوة بخطوة عبر منصتنا الذكية.</p>
          </div>
        </div>
      </div>

      <div class="why-visual">
        <div class="why-badge wb-1">
          <div class="wb-title">شحنات هذا الشهر</div>
          <div class="wb-val">+84,200</div>
          <div class="wb-progress"><div class="wb-bar" style="width: 86%"></div></div>
        </div>
        <div class="why-badge wb-2">
          <div class="wb-title">رضا العملاء</div>
          <div class="wb-val">4.9 / 5.0</div>
          <div style="display: flex; gap: 2px; margin-top: 8px;">
            <span style="color: var(--orange-400);">★</span><span style="color: var(--orange-400);">★</span><span style="color: var(--orange-400);">★</span><span style="color: var(--orange-400);">★</span><span style="color: var(--orange-400);">★</span>
          </div>
        </div>
        <div class="why-badge wb-3">
          <div class="wb-title">وقت الاستجابة</div>
          <div class="wb-val">&lt; 30 ثانية</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="partners" id="partners">
  <div class="container">
    <div class="partners-title">نفخر بثقة العلامات التجارية الرائدة</div>
    <div class="partners-logos">
      <div class="partner-logo">noon</div>
      <div class="partner-logo">SHEIN</div>
      <div class="partner-logo">Humana</div>
      <div class="partner-logo">floward</div>
      <div class="partner-logo">NICE ONE</div>
      <div class="partner-logo">iHerb</div>
      <div class="partner-logo">NAMSHI</div>
    </div>
  </div>
</section>

<section class="cta-banner" id="contact">
  <div class="container">
    <div class="cta-box">
      <div>
        <h2>جاهز لشحن شحنتك مع نافيكس؟</h2>
        <p>احصل على عرض سعر مخصص لأعمالك خلال 24 ساعة فقط — بدون التزام.</p>
      </div>
      <div class="cta-actions">
        @if (Route::has('register'))
          <a href="{{ route('register') }}" class="btn btn-primary">
            احصل على عرض سعر
            <svg class="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
          </a>
        @endif
        <a href="mailto:info@navix.com.sa" class="btn btn-ghost">تواصل معنا</a>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <a href="{{ url('/') }}" class="brand">
          <span>NAVI</span><span class="x">X</span>
        </a>
        <p>حلول لوجستية ذكية متكاملة — نقدّم خدمات التخزين، تجهيز الطلبات، الشحن والتوصيل في نفس اليوم، وإدارة المرتجعات لشركات التجارة الإلكترونية في المملكة العربية السعودية.</p>
        <div class="socials">
          <a href="#" class="social-icon" aria-label="LinkedIn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.5 2h-17A1.5 1.5 0 002 3.5v17A1.5 1.5 0 003.5 22h17a1.5 1.5 0 001.5-1.5v-17A1.5 1.5 0 0020.5 2zM8 19H5v-9h3zM6.5 8.25A1.75 1.75 0 118.3 6.5a1.78 1.78 0 01-1.8 1.75zM19 19h-3v-4.74c0-1.42-.6-1.93-1.38-1.93A1.74 1.74 0 0013 14.19a.66.66 0 000 .14V19h-3v-9h2.9v1.3a3.11 3.11 0 012.7-1.4c1.55 0 3.36.86 3.36 3.66z"/></svg>
          </a>
          <a href="#" class="social-icon" aria-label="X">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <a href="#" class="social-icon" aria-label="Instagram">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zM17.5 6.5h.01"/></svg>
          </a>
          <a href="#" class="social-icon" aria-label="WhatsApp">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.002-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
          </a>
        </div>
      </div>

      <div class="footer-col">
        <h5>خدماتنا</h5>
        <ul>
          <li><a href="#services">التخزين</a></li>
          <li><a href="#services">تجهيز الطلبات</a></li>
          <li><a href="#services">الشحن والتوصيل</a></li>
          <li><a href="#services">التوصيل في نفس اليوم</a></li>
          <li><a href="#services">إدارة المرتجعات</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h5>حلولنا</h5>
        <ul>
          <li><a href="#">التجارة الإلكترونية</a></li>
          <li><a href="#">الشركات الناشئة</a></li>
          <li><a href="#">الشركات الكبيرة</a></li>
          <li><a href="#">تكامل الأنظمة</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h5>روابط سريعة</h5>
        <ul>
          <li><a href="#">من نحن</a></li>
          <li><a href="#">الأسعار</a></li>
          <li><a href="#">الموارد</a></li>
          <li><a href="#">المدونة</a></li>
          <li><a href="#contact">تواصل معنا</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h5>تواصل معنا</h5>
        <ul>
          <li class="contact-li">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
            +966 9200 12345
          </li>
          <li class="contact-li">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            info@navix.com.sa
          </li>
          <li class="contact-li">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            الرياض، المملكة العربية السعودية
          </li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <div>© {{ date('Y') }} NAVIX Logistics Services — جميع الحقوق محفوظة</div>
      <div class="footer-bottom-links">
        <a href="#">سياسة الخصوصية</a>
        <a href="#">الشروط والأحكام</a>
        <a href="https://navix.com.sa">navix.com.sa</a>
      </div>
    </div>
  </div>
</footer>

<script>
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-links a');
  window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(s => {
      const top = s.offsetTop - 100;
      if (window.scrollY >= top) current = s.id;
    });
    navLinks.forEach(l => {
      l.classList.remove('active');
      if (l.getAttribute('href') === '#' + current) l.classList.add('active');
    });
  });
</script>

</body>
</html>
