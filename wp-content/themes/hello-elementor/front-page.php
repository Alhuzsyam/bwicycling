<?php
/**
 * Template Name: BwiCycling Homepage
 * Mobile Responsive Fixed Version
 */
get_header();
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* ── RESET & BASE ── */
    header.site-header, .site-footer, #wpadminbar { display: none !important; }
    html { margin-top: 0 !important; scroll-behavior: smooth; scroll-padding-top: 70px; }
    
    :root {
        --orange:     #e8590c;
        --orange-lt:  #fd7c35;
        --orange-bg:  #fff4ee;
        --orange-mid: #fde8d8;
        --ink:        #1a1208;
        --ink-soft:   #5a4a3a;
        --cream:      #fdf8f4;
        --warm-gray:  #f0e9e2;
        --white:      #ffffff;
        --font-head:  'Playfair Display', Georgia, serif;
        --font-body:  'Plus Jakarta Sans', sans-serif;
        --safe-bottom: env(safe-area-inset-bottom);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    
    body {
        font-family: var(--font-body);
        background: var(--cream);
        color: var(--ink);
        -webkit-font-smoothing: antialiased;
        overflow-x: hidden;
        font-size: clamp(14px, 2vw, 16px);
        line-height: 1.5;
    }

    /* Prevent image overflow */
    img, picture, video, iframe { max-width: 100%; height: auto; display: block; }

    /* ── NAV ── */
    .vs-nav {
        position: fixed; top: 0; left: 0; right: 0; z-index: 200;
        display: flex; align-items: center; justify-content: space-between;
        padding: 12px 20px;
        background: rgba(253,248,244,0.95);
        backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(232,89,12,0.1);
        min-height: 56px;
    }
    .vs-logo {
        font-family: var(--font-head);
        font-size: clamp(1.25rem, 4vw, 1.6rem);
        color: var(--ink); text-decoration: none; letter-spacing: -.02em;
        flex-shrink: 0;
    }
    .vs-logo span { color: var(--orange); }
    
    .vs-nav-links { display: flex; gap: 24px; list-style: none; }
    .vs-nav-links a {
        text-decoration: none; color: var(--ink-soft);
        font-size: 0.875rem; font-weight: 500; transition: color .2s;
        padding: 8px 4px; /* Touch target padding */
    }
    .vs-nav-links a:hover { color: var(--orange); }
    
    .vs-nav-right { display: flex; align-items: center; gap: 8px; }
    
    .vs-nav-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        background: var(--orange); color: #fff;
        padding: 10px 16px; border-radius: 100px;
        font-size: 0.875rem; font-weight: 600;
        text-decoration: none; transition: all .25s;
        box-shadow: 0 4px 16px rgba(232,89,12,0.3);
        white-space: nowrap;
        min-height: 44px; /* Touch target minimum */
    }
    .vs-nav-btn:hover { background: var(--orange-lt); transform: translateY(-1px); }

    /* Hamburger Menu */
    .vs-hamburger {
        display: none;
        flex-direction: column; gap: 5px;
        cursor: pointer; background: none; border: none;
        padding: 8px;
        min-width: 44px; min-height: 44px;
        align-items: center; justify-content: center;
        z-index: 201;
    }
    .vs-hamburger span {
        display: block; width: 22px; height: 2px;
        background: var(--ink); border-radius: 2px; transition: all .3s;
    }
    .vs-hamburger[aria-expanded="true"] span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
    .vs-hamburger[aria-expanded="true"] span:nth-child(2) { opacity: 0; }
    .vs-hamburger[aria-expanded="true"] span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

    /* Mobile Menu Dropdown */
    .vs-mobile-menu {
        display: none;
        position: fixed; top: 56px; left: 0; right: 0; z-index: 199;
        background: var(--cream);
        border-bottom: 1px solid var(--warm-gray);
        padding: 8px 20px 24px;
        flex-direction: column;
        max-height: calc(100vh - 56px);
        overflow-y: auto;
    }
    .vs-mobile-menu.open { display: flex; }
    .vs-mobile-menu a {
        padding: 14px 0; border-bottom: 1px solid var(--warm-gray);
        font-size: 1rem; font-weight: 500;
        color: var(--ink); text-decoration: none;
        display: flex; align-items: center; min-height: 44px;
    }
    .vs-mobile-menu a:last-child { border-bottom: none; }
    .vs-mobile-menu a:hover { color: var(--orange); }
    .vs-mobile-menu .vs-nav-btn {
        margin-top: 12px; width: 100%; justify-content: center;
    }

    @media(max-width: 768px) {
        .vs-nav { padding: 10px 16px; }
        .vs-nav-links { display: none; }
        .vs-nav-btn { display: none; }
        .vs-hamburger { display: flex; }
    }

    /* ── HERO SLIDESHOW ── */
    .vs-hero {
        position: relative; width: 100%;
        min-height: 100vh; min-height: 100dvh; /* Dynamic viewport height */
        overflow: hidden;
        display: flex; align-items: flex-end;
    }
    .vs-slides { position: absolute; inset: 0; }
    .vs-slide {
        position: absolute; inset: 0;
        opacity: 0; transition: opacity 1s ease;
    }
    .vs-slide.active { opacity: 1; }
    .vs-slide img {
        width: 100%; height: 100%; object-fit: cover; display: block;
    }
    .vs-slide::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(
            to bottom,
            rgba(26,18,8,0.15) 0%,
            rgba(26,18,8,0.1) 40%,
            rgba(26,18,8,0.72) 100%
        );
    }

    .vs-hero-content {
        position: relative; z-index: 10;
        width: 100%; padding: 0 24px 60px;
        display: grid; grid-template-columns: 1fr;
        gap: 32px; align-items: flex-end;
    }
    .vs-hero-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(232,89,12,0.85); color: #fff;
        padding: 6px 14px; border-radius: 100px;
        font-size: 0.7rem; font-weight: 600; letter-spacing: .1em;
        text-transform: uppercase; margin-bottom: 16px;
        backdrop-filter: blur(8px);
        animation: fadeUp .7s .2s ease both;
    }
    .vs-hero-badge::before {
        content: ''; width: 6px; height: 6px;
        background: #fff; border-radius: 50%;
        animation: blink 2s infinite;
    }
    .vs-hero-h1 {
        font-family: var(--font-head);
        font-size: clamp(2.2rem, 8vw, 4.5rem);
        color: #fff; line-height: 1.05;
        letter-spacing: -.03em; margin-bottom: 16px;
        animation: fadeUp .7s .3s ease both;
    }
    .vs-hero-h1 em { color: #ffb085; font-style: italic; }
    .vs-hero-sub {
        color: rgba(255,255,255,0.85);
        font-size: clamp(0.9rem, 3vw, 1.05rem);
        max-width: 100%; line-height: 1.6; margin-bottom: 24px;
        animation: fadeUp .7s .4s ease both;
    }
    .vs-hero-btns {
        display: flex; flex-wrap: wrap; gap: 10px;
        animation: fadeUp .7s .5s ease both;
    }
    .vs-btn-orange, .vs-btn-outline-white {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        padding: 12px 24px; border-radius: 100px;
        font-size: 0.9rem; font-weight: 600;
        text-decoration: none; transition: all .25s;
        min-height: 48px; /* Touch target */
    }
    .vs-btn-orange {
        background: var(--orange); color: #fff;
        box-shadow: 0 6px 24px rgba(232,89,12,0.4);
    }
    .vs-btn-orange:hover { background: var(--orange-lt); transform: translateY(-2px); }
    .vs-btn-outline-white {
        background: rgba(255,255,255,0.15); color: #fff;
        border: 1.5px solid rgba(255,255,255,0.35);
        backdrop-filter: blur(4px);
    }
    .vs-btn-outline-white:hover { background: rgba(255,255,255,0.28); }

    /* Slide controls - mobile friendly */
    .vs-slide-controls {
        display: flex; flex-direction: row;
        align-items: center; justify-content: space-between;
        gap: 12px; width: 100%;
        animation: fadeUp .7s .4s ease both;
    }
    .vs-slide-arrows { display: flex; gap: 8px; }
    .vs-arrow {
        width: 44px; height: 44px; border-radius: 50%;
        background: rgba(255,255,255,0.15); border: 1.5px solid rgba(255,255,255,0.3);
        color: #fff; font-size: 0.85rem;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all .25s; backdrop-filter: blur(6px);
        min-width: 44px; min-height: 44px;
    }
    .vs-arrow:hover { background: var(--orange); border-color: var(--orange); }
    .vs-dots { display: flex; gap: 6px; align-items: center; }
    .vs-dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: rgba(255,255,255,0.4); cursor: pointer;
        transition: all .3s; min-width: 8px; min-height: 8px;
    }
    .vs-dot.active { width: 20px; border-radius: 4px; background: var(--orange); }
    .vs-slide-caption {
        color: rgba(255,255,255,0.7); font-size: 0.75rem;
        text-align: right; min-width: 120px;
    }

    @media(min-width: 769px) {
        .vs-hero-content {
            padding: 0 52px 80px;
            grid-template-columns: 1fr auto;
        }
        .vs-slide-controls {
            flex-direction: column; align-items: flex-end;
            justify-content: flex-start; width: auto;
        }
    }

    /* ── STATS BAR ── */
    .vs-stats {
        background: var(--white);
        border-bottom: 1px solid var(--warm-gray);
        padding: 0 20px;
    }
    .vs-stats-inner {
        max-width: 1280px; margin: 0 auto;
        display: grid; grid-template-columns: repeat(2, 1fr);
        gap: 1px; background: var(--warm-gray); /* Fake borders via gap */
    }
    .vs-stat-item {
        padding: 20px 16px;
        background: var(--white);
        display: flex; align-items: center; gap: 12px;
    }
    .vs-stat-icon {
        width: 40px; height: 40px; flex-shrink: 0;
        background: var(--orange-bg); color: var(--orange);
        border-radius: 10px; display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
    }
    .vs-stat-num {
        font-family: var(--font-head); font-size: clamp(1.2rem, 4vw, 1.6rem);
        color: var(--ink); line-height: 1;
    }
    .vs-stat-lbl { font-size: 0.75rem; color: var(--ink-soft); margin-top: 2px; }

    @media(min-width: 768px) {
        .vs-stats { padding: 0 24px; }
        .vs-stats-inner { grid-template-columns: repeat(4, 1fr); }
        .vs-stat-item { padding: 28px 24px; border-right: 1px solid var(--warm-gray); }
        .vs-stat-item:last-child { border-right: none; }
    }

    /* ── HOW IT WORKS ── */
    .vs-how { padding: 60px 20px; background: var(--cream); }
    .vs-how-inner { max-width: 1280px; margin: 0 auto; }
    .vs-section-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 0.7rem; font-weight: 600; letter-spacing: .1em;
        text-transform: uppercase; color: var(--orange); margin-bottom: 12px;
    }
    .vs-section-eyebrow::before {
        content: ''; width: 20px; height: 2px; background: var(--orange); border-radius: 2px;
    }
    .vs-section-title {
        font-family: var(--font-head);
        font-size: clamp(1.6rem, 5vw, 2.5rem);
        color: var(--ink); letter-spacing: -.03em; line-height: 1.15;
    }
    .vs-section-title em { font-style: italic; color: var(--ink-soft); }

    /* Steps - Mobile First */
    .vs-steps {
        margin-top: 40px;
        display: grid; grid-template-columns: 1fr;
        gap: 32px; position: relative;
    }
    .vs-steps::before { display: none; } /* Hide connector on mobile */
    
    .vs-step {
        padding: 0; text-align: center; position: relative;
    }
    .vs-step-visual {
        width: 100%; max-width: 280px; height: auto; margin: 0 auto 20px;
        position: relative; aspect-ratio: 5/4;
    }
    .vs-step-img-wrap {
        width: 100%; height: 100%;
        border-radius: 16px; overflow: hidden;
        box-shadow: 0 12px 40px rgba(232,89,12,0.15);
        position: relative;
    }
    .vs-step-img-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .vs-step-num {
        position: absolute; top: -10px; right: -10px;
        width: 36px; height: 36px; border-radius: 50%;
        background: var(--orange); color: #fff;
        font-family: var(--font-head); font-size: 1rem; font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 12px rgba(232,89,12,0.35);
        border: 3px solid var(--cream);
    }
    .vs-step h4 {
        font-family: var(--font-head); font-size: clamp(1.1rem, 4vw, 1.25rem);
        color: var(--ink); margin-bottom: 8px; letter-spacing: -.01em;
    }
    .vs-step p { font-size: 0.9rem; color: var(--ink-soft); line-height: 1.7; max-width: 100%; margin: 0 auto 16px; }

    .vs-step-detail {
        margin-top: 16px; padding: 14px;
        background: var(--white); border-radius: 12px;
        border: 1px solid var(--orange-mid);
        text-align: left;
    }
    .vs-step-detail-item {
        display: flex; align-items: flex-start; gap: 8px;
        font-size: 0.8rem; color: var(--ink-soft);
        padding: 4px 0; line-height: 1.5;
    }
    .vs-step-detail-item i { color: var(--orange); width: 14px; text-align: center; font-size: 0.7rem; margin-top: 3px; flex-shrink: 0; }

    @media(min-width: 992px) {
        .vs-how { padding: 100px 52px; }
        .vs-steps {
            grid-template-columns: repeat(3, 1fr); gap: 0;
        }
        .vs-steps::before {
            display: block;
            content: '';
            position: absolute; top: 100px; left: calc(16.67% + 16px); right: calc(16.67% + 16px);
            height: 2px;
            background: repeating-linear-gradient(90deg, var(--orange) 0, var(--orange) 8px, transparent 8px, transparent 16px);
            pointer-events: none;
        }
        .vs-step { padding: 0 32px 0; }
        .vs-step-visual { width: 200px; height: 160px; margin: 0 auto 28px; aspect-ratio: auto; }
        .vs-step p { max-width: 240px; }
    }

    /* ── TOURS ── */
    .vs-tours { padding: 60px 20px; background: var(--white); }
    .vs-tours-inner { max-width: 1280px; margin: 0 auto; }
    .vs-tours-head {
        display: flex; justify-content: space-between;
        align-items: flex-end; margin-bottom: 32px; gap: 16px; flex-wrap: wrap;
    }
    .vs-view-all {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.875rem; font-weight: 500; color: var(--orange);
        text-decoration: none; border-bottom: 1px solid transparent;
        transition: border-color .2s; padding: 4px 0; min-height: 44px;
    }
    .vs-view-all:hover { border-color: var(--orange); }
    
    .vs-tours-grid { display: grid; grid-template-columns: 1fr; gap: 20px; }
    .vs-tour-card {
        background: var(--cream); border-radius: 18px;
        overflow: hidden; border: 1px solid var(--warm-gray);
        transition: transform .3s, box-shadow .3s;
        display: flex; flex-direction: column;
    }
    .vs-tour-card:hover { transform: translateY(-4px); box-shadow: 0 20px 50px rgba(232,89,12,0.12); }
    .vs-tour-img { aspect-ratio: 4/3; overflow: hidden; position: relative; }
    .vs-tour-img img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .6s; }
    .vs-tour-card:hover .vs-tour-img img { transform: scale(1.05); }
    .vs-tour-tag-wrap { position: absolute; top: 12px; left: 12px; }
    .vs-tour-tag {
        display: inline-block;
        background: rgba(232,89,12,0.9); color: #fff;
        font-size: 0.65rem; font-weight: 600; letter-spacing: .07em;
        text-transform: uppercase; padding: 4px 10px; border-radius: 100px;
        backdrop-filter: blur(4px);
    }
    .vs-tour-body { padding: 18px; flex: 1; display: flex; flex-direction: column; }
    .vs-tour-meta { display: flex; gap: 10px; margin-bottom: 8px; flex-wrap: wrap; }
    .vs-tour-meta span {
        font-size: 0.75rem; color: var(--ink-soft);
        display: flex; align-items: center; gap: 4px;
    }
    .vs-tour-meta i { color: var(--orange); }
    .vs-tour-title {
        font-family: var(--font-head); font-size: 1.1rem; color: var(--ink);
        text-decoration: none; display: block; margin-bottom: 6px;
        transition: color .2s; letter-spacing: -.01em; line-height: 1.3;
    }
    .vs-tour-title:hover { color: var(--orange); }
    .vs-tour-price { font-size: 1.15rem; font-weight: 700; color: var(--orange); margin: auto 0 16px; padding-top: 12px; }
    .vs-tour-btn {
        display: block; width: 100%; text-align: center;
        background: var(--ink); color: #fff;
        padding: 12px; border-radius: 100px;
        font-size: 0.875rem; font-weight: 600;
        text-decoration: none; transition: all .25s;
        min-height: 44px; display: flex; align-items: center; justify-content: center;
    }
    .vs-tour-btn:hover { background: var(--orange); }

    @media(min-width: 640px) {
        .vs-tours-grid { grid-template-columns: repeat(2, 1fr); gap: 24px; }
    }
    @media(min-width: 992px) {
        .vs-tours { padding: 100px 52px; }
        .vs-tours-grid { grid-template-columns: repeat(3, 1fr); }
        .vs-tour-img { height: 220px; aspect-ratio: auto; }
    }

    /* ── CTA ── */
    .vs-cta { padding: 48px 20px; background: var(--cream); }
    .vs-cta-box {
        max-width: 1280px; margin: 0 auto;
        background: var(--orange);
        border-radius: 24px; padding: 40px 24px;
        display: grid; grid-template-columns: 1fr;
        gap: 24px; align-items: center;
        position: relative; overflow: hidden;
    }
    .vs-cta-box::before, .vs-cta-box::after { display: none; } /* Hide decorative circles on mobile */
    .vs-cta-box h2 {
        font-family: var(--font-head);
        font-size: clamp(1.5rem, 5vw, 2.2rem);
        color: #fff; letter-spacing: -.03em; margin-bottom: 10px;
    }
    .vs-cta-box h2 em { font-style: italic; opacity: .8; }
    .vs-cta-box p { color: rgba(255,255,255,0.85); font-size: 0.95rem; line-height: 1.6; }
    .vs-wa-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        background: #fff; color: var(--orange);
        padding: 14px 28px; border-radius: 100px;
        font-size: 0.9rem; font-weight: 700;
        text-decoration: none; white-space: nowrap;
        transition: all .25s;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        min-height: 48px; width: 100%; max-width: 280px; margin: 0 auto;
    }
    .vs-wa-btn:hover { transform: translateY(-2px); box-shadow: 0 16px 40px rgba(0,0,0,0.18); }

    @media(min-width: 768px) {
        .vs-cta { padding: 80px 52px; }
        .vs-cta-box {
            grid-template-columns: 1fr auto; gap: 40px;
            padding: 56px 48px; border-radius: 28px;
        }
        .vs-cta-box::before, .vs-cta-box::after { display: block; }
        .vs-cta-box::before {
            content: ''; position: absolute; right: -60px; top: -80px;
            width: 360px; height: 360px; border-radius: 50%;
            background: rgba(255,255,255,0.08); pointer-events: none;
        }
        .vs-cta-box::after {
            content: ''; position: absolute; left: 40%; bottom: -100px;
            width: 200px; height: 200px; border-radius: 50%;
            background: rgba(255,255,255,0.06); pointer-events: none;
        }
        .vs-wa-btn { width: auto; margin: 0; }
    }

    /* ── FOOTER ── */
    .vs-footer { background: var(--ink); color: rgba(255,255,255,0.45); padding: 48px 20px 32px; }
    .vs-footer-inner { max-width: 1280px; margin: 0 auto; }
    .vs-footer-grid {
        display: grid; grid-template-columns: 1fr;
        gap: 32px; padding-bottom: 32px;
        border-bottom: 1px solid rgba(255,255,255,0.07);
        margin-bottom: 24px;
    }
    .vs-footer-brand-logo {
        font-family: var(--font-head);
        font-size: 1.5rem; color: #fff;
        text-decoration: none; display: block; margin-bottom: 12px;
    }
    .vs-footer-brand-logo span { color: var(--orange-lt); }
    .vs-footer-brand p { font-size: 0.85rem; line-height: 1.7; max-width: 100%; }
    .vs-footer-col h6 {
        font-size: 0.65rem; font-weight: 700; letter-spacing: .12em;
        text-transform: uppercase; color: rgba(255,255,255,0.25);
        margin-bottom: 16px;
    }
    .vs-footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 8px; }
    .vs-footer-col a { text-decoration: none; color: rgba(255,255,255,0.45); font-size: 0.85rem; transition: color .2s; min-height: 36px; display: flex; align-items: center; }
    .vs-footer-col a:hover { color: #fff; }
    .vs-footer-bottom {
        display: flex; justify-content: center; align-items: center;
        font-size: 0.75rem; flex-wrap: wrap; gap: 8px; text-align: center;
    }
    .vs-footer-contact { display: flex; align-items: center; gap: 6px; color: rgba(255,255,255,.6); }
    .vs-footer-contact i { color: var(--orange-lt); }

    @media(min-width: 768px) {
        .vs-footer { padding: 72px 52px 40px; }
        .vs-footer-grid { grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; }
        .vs-footer-bottom { justify-content: space-between; text-align: left; }
    }

    /* ── UTILS & ANIMATIONS ── */
    @keyframes fadeDown { from { opacity:0; transform:translateY(-14px) } to { opacity:1; transform:none } }
    @keyframes fadeUp   { from { opacity:0; transform:translateY(20px)  } to { opacity:1; transform:none } }
    @keyframes blink    { 0%,100%{opacity:1}50%{opacity:.3} }

    .reveal { opacity:0; transform:translateY(20px); transition: opacity .6s ease, transform .6s ease; }
    .reveal.visible { opacity:1; transform:none; }

    /* Prevent horizontal scroll */
    html, body { max-width: 100%; overflow-x: hidden; }
    [class*="vs-"] { max-width: 100%; }
</style>

<!-- ──────────── NAV ──────────── -->
<nav class="vs-nav">
    <a href="/" class="vs-logo">BwiCycling<span>.</span></a>
    <ul class="vs-nav-links">
        <li><a href="#how">Cara Booking</a></li>
        <li><a href="#booking">Tour</a></li>
        <li><a href="#contact">Kontak</a></li>
    </ul>
    <div class="vs-nav-right">
        <a href="https://wa.me/628123456789" class="vs-nav-btn">
            <i class="fab fa-whatsapp"></i> <span>Booking</span>
        </a>
        <button class="vs-hamburger" id="vs-menu-toggle" aria-label="Menu" aria-expanded="false" aria-controls="vs-mobile-menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- Mobile Menu -->
<div class="vs-mobile-menu" id="vs-mobile-menu">
    <a href="#how" class="vs-mobile-link">Cara Booking</a>
    <a href="#booking" class="vs-mobile-link">Tour</a>
    <a href="#contact" class="vs-mobile-link">Kontak</a>
    <a href="https://wa.me/628123456789" class="vs-nav-btn" style="margin-top:12px;">
        <i class="fab fa-whatsapp"></i> Booking via WhatsApp
    </a>
</div>

<!-- ──────────── HERO SLIDESHOW ──────────── -->
<section class="vs-hero">
    <div class="vs-slides">
        <div class="vs-slide active">
            <img src="https://images.unsplash.com/photo-1544191696-102dbdaeeaa0?q=80&w=1600&auto=format&fit=crop" alt="Cycling Banyuwangi" loading="eager">
        </div>
        <div class="vs-slide">
            <img src="http://168.110.193.105:4151/wp-content/uploads/2026/02/IMG_5058-scaled.jpg" alt="Ijen Sunrise" loading="lazy">
        </div>
        <div class="vs-slide">
            <img src="https://images.unsplash.com/photo-1490682143684-14369e18dce8?q=80&w=1600&auto=format&fit=crop" alt="Road Cycling Java" loading="lazy">
        </div>
    </div>

    <div class="vs-hero-content">
        <div>
            <div class="vs-hero-badge">Premium Cycling Tour · Banyuwangi</div>
            <h1 class="vs-hero-h1">
                Jelajahi<br>
                <em>Sunrise of Java</em><br>
                dengan Sepeda
            </h1>
            <p class="vs-hero-sub">
                Sewa road bike premium & paket tour seru di Banyuwangi. Rute keren, pemandu asik, dan pemandangan yang bikin nagih.
            </p>
            <div class="vs-hero-btns">
                <a href="#booking" class="vs-btn-orange">
                    <i class="fas fa-bicycle"></i> Lihat Paket
                </a>
                <a href="#how" class="vs-btn-outline-white">
                    Cara Booking <i class="fas fa-arrow-down"></i>
                </a>
            </div>
        </div>

        <div class="vs-slide-controls">
            <div class="vs-slide-arrows">
                <button class="vs-arrow" id="vs-prev" aria-label="Previous slide"><i class="fas fa-chevron-left"></i></button>
                <button class="vs-arrow" id="vs-next" aria-label="Next slide"><i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="vs-dots">
                <button class="vs-dot active" data-idx="0" aria-label="Go to slide 1"></button>
                <button class="vs-dot" data-idx="1" aria-label="Go to slide 2"></button>
                <button class="vs-dot" data-idx="2" aria-label="Go to slide 3"></button>
            </div>
            <div class="vs-slide-caption" id="vs-caption">Cycling Banyuwangi</div>
        </div>
    </div>
</section>

<!-- ──────────── STATS BAR ──────────── -->
<div class="vs-stats">
    <div class="vs-stats-inner">
        <div class="vs-stat-item">
            <div class="vs-stat-icon"><i class="fas fa-users"></i></div>
            <div>
                <div class="vs-stat-num">500+</div>
                <div class="vs-stat-lbl">Pengendara Puas</div>
            </div>
        </div>
        <div class="vs-stat-item">
            <div class="vs-stat-icon"><i class="fas fa-route"></i></div>
            <div>
                <div class="vs-stat-num">8</div>
                <div class="vs-stat-lbl">Rute Tersedia</div>
            </div>
        </div>
        <div class="vs-stat-item">
            <div class="vs-stat-icon"><i class="fas fa-star"></i></div>
            <div>
                <div class="vs-stat-num">4.9★</div>
                <div class="vs-stat-lbl">Rating Tamu</div>
            </div>
        </div>
        <div class="vs-stat-item">
            <div class="vs-stat-icon"><i class="fas fa-calendar-alt"></i></div>
            <div>
                <div class="vs-stat-num">7 Hari</div>
                <div class="vs-stat-lbl">Buka Setiap Hari</div>
            </div>
        </div>
    </div>
</div>

<!-- ──────────── HOW IT WORKS ──────────── -->
<section id="how" class="vs-how">
    <div class="vs-how-inner">
        <div class="reveal" style="text-align:center; max-width:560px; margin:0 auto 40px;">
            <div class="vs-section-eyebrow">Gampang Banget</div>
            <h2 class="vs-section-title">Tiga langkah <em>untuk mulai petualangan</em></h2>
        </div>

        <div class="vs-steps">
            <!-- Step 1 -->
            <div class="vs-step reveal">
                <div class="vs-step-visual">
                    <div class="vs-step-img-wrap">
                        <img src="https://images.unsplash.com/photo-1452421822248-d4c2b47f0c81?q=80&w=600&auto=format&fit=crop" alt="Pilih Rute" loading="lazy">
                    </div>
                    <div class="vs-step-num">1</div>
                </div>
                <h4>Pilih Rute</h4>
                <p>Temukan rute yang pas dan santai di tepi pantai atau tantang diri ke Kawah Ijen.</p>
                <div class="vs-step-detail">
                    <div class="vs-step-detail-item"><i class="fas fa-check-circle"></i> Rute pemula & pro</div>
                    <div class="vs-step-detail-item"><i class="fas fa-check-circle"></i> Peta digital tersedia</div>
                    <div class="vs-step-detail-item"><i class="fas fa-check-circle"></i> Info elevasi lengkap</div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="vs-step reveal" style="transition-delay:.1s">
                <div class="vs-step-visual">
                    <div class="vs-step-img-wrap">
                        <img src="https://images.unsplash.com/photo-1611532736597-de2d4265fba3?q=80&w=600&auto=format&fit=crop" alt="Book Tanggal" loading="lazy">
                    </div>
                    <div class="vs-step-num">2</div>
                </div>
                <h4>Tentukan Tanggal</h4>
                <p>Pilih tanggal, bayar aman, dan konfirmasi langsung masuk WhatsApp.</p>
                <div class="vs-step-detail">
                    <div class="vs-step-detail-item"><i class="fas fa-check-circle"></i> Pembayaran 100% aman</div>
                    <div class="vs-step-detail-item"><i class="fas fa-check-circle"></i> Konfirmasi instan</div>
                    <div class="vs-step-detail-item"><i class="fas fa-check-circle"></i> Reschedule mudah</div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="vs-step reveal" style="transition-delay:.2s">
                <div class="vs-step-visual">
                    <div class="vs-step-img-wrap">
                        <img src="https://www.cycleplan.co.uk/media/qozc4i45/cycling-terms.jpg" alt="Start Riding" loading="lazy">
                    </div>
                    <div class="vs-step-num">3</div>
                </div>
                <h4>Start Riding!</h4>
                <p>Sepeda premium siap, didampingi guide terbaik banyuwangi. Tinggal gowes!</p>
                <div class="vs-step-detail">
                    <div class="vs-step-detail-item"><i class="fas fa-check-circle"></i> Road bike premium</div>
                    <div class="vs-step-detail-item"><i class="fas fa-check-circle"></i> Helm & perlengkapan</div>
                    <div class="vs-step-detail-item"><i class="fas fa-check-circle"></i> Guide berpengalaman</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ──────────── TOURS ──────────── -->
<section id="booking" class="vs-tours">
    <div class="vs-tours-inner">
        <div class="vs-tours-head reveal">
            <div>
                <div class="vs-section-eyebrow">Destinasi Favorit</div>
                <h2 class="vs-section-title">Paket Tour <em>Terpopuler</em></h2>
            </div>
            <a href="/shop" class="vs-view-all">Semua Paket <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="vs-tours-grid reveal">
            <?php
            $args = array( 'post_type' => 'product', 'posts_per_page' => 3 );
            $loop = new WP_Query( $args );
            if ( $loop->have_posts() ) :
                while ( $loop->have_posts() ) : $loop->the_post();
                    global $product;
            ?>
            <div class="vs-tour-card">
                <div class="vs-tour-img">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) :
                            the_post_thumbnail( 'medium_large', array('alt' => get_the_title()) );
                        else : ?>
                            <img src="https://images.unsplash.com/photo-1544191696-102dbdaeeaa0?q=80&w=800&auto=format&fit=crop" alt="Tour">
                        <?php endif; ?>
                    </a>
                    <div class="vs-tour-tag-wrap"><span class="vs-tour-tag">Paket Tour</span></div>
                </div>
                <div class="vs-tour-body">
                    <div class="vs-tour-meta">
                        <span><i class="fas fa-clock"></i> Full Day</span>
                        <span><i class="fas fa-map-marker-alt"></i> Banyuwangi</span>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="vs-tour-title"><?php the_title(); ?></a>
                    <div class="vs-tour-price"><?php echo $product ? $product->get_price_html() : ''; ?></div>
                    <a href="<?php the_permalink(); ?>" class="vs-tour-btn">Booking Sekarang</a>
                </div>
            </div>
            <?php endwhile; else : ?>
                <p style="grid-column:1/-1; text-align:center; color:var(--ink-soft); padding:40px 0; font-size:0.9rem;">Belum ada paket tour tersedia.</p>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<!-- ──────────── CTA ──────────── -->
<section id="contact" class="vs-cta">
    <div class="vs-cta-box reveal">
        <div>
            <h2>Mau trip <em>khusus buat grupmu?</em></h2>
            <p>Kami siap atur perjalanan seru untuk grup perusahaan, keluarga, atau komunitas sepeda kamu.</p>
        </div>
        <a href="https://wa.me/628123456789" class="vs-wa-btn">
            <i class="fab fa-whatsapp" style="font-size:1.2rem; color:#25d366;"></i>
            Chat WhatsApp
        </a>
    </div>
</section>

<!-- ──────────── FOOTER ──────────── -->
<footer class="vs-footer">
    <div class="vs-footer-inner">
        <div class="vs-footer-grid">
            <div class="vs-footer-brand">
                <a href="/" class="vs-footer-brand-logo">BwiCycling<span>.</span></a>
                <p>Road bike premium, pemandu asik, dan rute terbaik di Banyuwangi.</p>
            </div>
            <div class="vs-footer-col">
                <h6>Menu</h6>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/shop">Rental & Tour</a></li>
                    <li><a href="#how">Cara Booking</a></li>
                </ul>
            </div>
            <div class="vs-footer-col">
                <h6>Info</h6>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div class="vs-footer-col">
                <h6>Kontak</h6>
                <ul>
                    <li>
                        <div class="vs-footer-contact">
                            <i class="fab fa-whatsapp"></i>
                            <a href="tel:+628123456789" style="color:rgba(255,255,255,0.6);">+62 812 3456 789</a>
                        </div>
                    </li>
                    <li>
                        <div class="vs-footer-contact" style="margin-top:4px;">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Banyuwangi, Jawa Timur</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="vs-footer-bottom">
            <span>&copy; <?php echo date('Y'); ?> BwiCycling · Banyuwangi Cycling Tours.</span>
            <span>Made with ♥ in Banyuwangi</span>
        </div>
    </div>
</footer>

<script>
// ── MOBILE MENU TOGGLE ──
const menuToggle = document.getElementById('vs-menu-toggle');
const mobileMenu = document.getElementById('vs-mobile-menu');
const mobileLinks = document.querySelectorAll('.vs-mobile-link');

function toggleMenu() {
    const isOpen = mobileMenu.classList.toggle('open');
    menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    document.body.style.overflow = isOpen ? 'hidden' : '';
}

menuToggle?.addEventListener('click', toggleMenu);

// Close menu when clicking links
mobileLinks.forEach(link => {
    link.addEventListener('click', () => {
        mobileMenu.classList.remove('open');
        menuToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    });
});

// Close menu when clicking outside
document.addEventListener('click', (e) => {
    if (mobileMenu.classList.contains('open') && 
        !e.target.closest('.vs-nav') && 
        !e.target.closest('.vs-mobile-menu')) {
        mobileMenu.classList.remove('open');
        menuToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }
});

// ── SLIDESHOW ──
const slides = document.querySelectorAll('.vs-slide');
const dots = document.querySelectorAll('.vs-dot');
const caption = document.getElementById('vs-caption');
const captions = ['Cycling Banyuwangi', 'Sunrise Kawah Ijen', 'Road Cycling Java'];
let current = 0, timer;

function goTo(n) {
    slides[current]?.classList.remove('active');
    dots[current]?.classList.remove('active');
    current = (n + slides.length) % slides.length;
    slides[current]?.classList.add('active');
    dots[current]?.classList.add('active');
    if (caption) caption.textContent = captions[current];
    resetTimer();
}

function resetTimer() {
    clearInterval(timer);
    timer = setInterval(() => goTo(current + 1), 5000);
}

document.getElementById('vs-next')?.addEventListener('click', () => goTo(current + 1));
document.getElementById('vs-prev')?.addEventListener('click', () => goTo(current - 1));
dots.forEach(d => d?.addEventListener('click', () => goTo(+d.dataset.idx)));

resetTimer();

// ── SCROLL REVEAL ──
const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
        if (e.isIntersecting) {
            e.target.classList.add('visible');
            io.unobserve(e.target);
        }
    });
}, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

document.querySelectorAll('.reveal').forEach(el => io.observe(el));

// ── PREVENT ZOOM ON INPUT FOCUS (iOS) ──
document.addEventListener('touchstart', function(){}, {passive: true});
</script>

<?php get_footer(); ?>