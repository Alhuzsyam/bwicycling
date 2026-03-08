<?php
/**
 * BwiCycling — Custom Single Product Page (Mobile Responsive Fixed)
 * Letakkan di: themes/hello-elementor/woocommerce/single-product.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

global $product;
$product = wc_get_product( get_the_ID() );
if ( ! $product ) { wp_redirect( home_url() ); exit; }

$title        = get_the_title();
$price_html   = $product->get_price_html();
$desc         = $product->get_description();
$short_desc   = $product->get_short_description();
$sku          = $product->get_sku();
$cats         = wc_get_product_category_list( $product->get_id(), ', ' );
$gallery_ids  = $product->get_gallery_image_ids();
$thumb_id     = $product->get_image_id();
$thumb_url    = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'large' ) : 'https://images.unsplash.com/photo-1544191696-102dbdaeeaa0?q=80&w=900&auto=format&fit=crop';
$rating       = $product->get_average_rating();
$review_count = $product->get_review_count();
$wa_msg       = urlencode( 'Halo BwiCycling! Saya tertarik dengan paket: ' . $title . '. Bisa info lebih lanjut?' );

get_header();
?>

<!-- CSS Styles -->
<style>
:root {
    --orange:    #e8590c;
    --orange-lt: #fd7c35;
    --orange-bg: #fff4ee;
    --orange-mid:#fde8d8;
    --ink:       #1a1208;
    --ink-soft:  #5a4a3a;
    --cream:     #fdf8f4;
    --warm-gray: #f0e9e2;
    --white:     #ffffff;
    --fh:        'Playfair Display', Georgia, serif;
    --fb:        'Plus Jakarta Sans', sans-serif;
    --safe-area-bottom: env(safe-area-inset-bottom);
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; scroll-padding-top: 80px; }
body {
    font-family: var(--fb);
    background: var(--cream);
    color: var(--ink);
    -webkit-font-smoothing: antialiased;
    overflow-x: hidden;
    font-size: 16px; /* Base font size untuk mobile */
    line-height: 1.5;
}

/* Hide WP elements */
.site-header, .site-footer,
header.site-header, footer.site-footer,
#wpadminbar { display: none !important; }
html { margin-top: 0 !important; }

/* ══ NAV ══ */
.vs-nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 200;
    display: flex; align-items: center; justify-content: space-between;
    padding: 12px 24px;
    background: rgba(253,248,244,0.95);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(232,89,12,0.1);
    min-height: 56px;
}
.vs-logo {
    font-family: var(--fh); font-size: clamp(1.25rem, 4vw, 1.5rem);
    color: var(--ink); text-decoration: none; letter-spacing: -.02em;
    flex-shrink: 0;
}
.vs-logo span { color: var(--orange); }
.vs-nav-links { display: flex; gap: 24px; list-style: none; }
.vs-nav-links a {
    text-decoration: none; color: var(--ink-soft);
    font-size: 0.875rem; font-weight: 500; transition: color .2s;
    padding: 8px 4px; /* Touch target */
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

/* Hamburger */
.vs-hamburger {
    display: none; flex-direction: column; gap: 5px;
    cursor: pointer; background: none; border: none; padding: 8px;
    min-width: 44px; min-height: 44px; /* Touch target */
    align-items: center; justify-content: center;
}
.vs-hamburger span {
    display: block; width: 22px; height: 2px;
    background: var(--ink); border-radius: 2px; transition: all .3s;
}

/* Mobile menu */
.vs-mobile-menu {
    display: none; position: fixed;
    top: 56px; left: 0; right: 0; z-index: 199;
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
    display: block; min-height: 44px; display: flex; align-items: center;
}
.vs-mobile-menu a:last-child { border-bottom: none; }
.vs-mobile-menu a:hover { color: var(--orange); }

@media(max-width: 768px) {
    .vs-nav { padding: 10px 16px; }
    .vs-nav-links { display: none; }
    .vs-nav-btn { display: none; }
    .vs-hamburger { display: flex; }
}

/* ══ BREADCRUMB ══ */
.vs-breadcrumb {
    max-width: 1200px; margin: 0 auto;
    padding: 72px 20px 0;
    display: flex; align-items: center; gap: 6px; flex-wrap: wrap;
    font-size: 0.75rem; color: var(--ink-soft);
}
.vs-breadcrumb a { color: var(--orange); text-decoration: none; }
.vs-breadcrumb a:hover { text-decoration: underline; }
.vs-breadcrumb i { font-size: 0.55rem; color: var(--warm-gray); }

/* ══ PRODUCT LAYOUT ══ */
.vs-product {
    max-width: 1200px; margin: 0 auto;
    padding: 24px 20px 60px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 32px;
    align-items: start;
}
@media(min-width: 900px) {
    .vs-product {
        grid-template-columns: 1fr 1fr;
        gap: 48px;
        padding: 28px 32px 80px;
    }
}

/* ══ GALLERY ══ */
.vs-gallery { position: relative; }
.vs-gallery-main {
    width: 100%; border-radius: 16px; overflow: hidden;
    box-shadow: 0 12px 32px rgba(232,89,12,0.12);
    border: 1px solid var(--orange-mid);
    background: var(--white); margin-bottom: 8px;
    cursor: zoom-in; position: relative;
    aspect-ratio: 4/3; /* Maintain ratio on mobile */
}
.vs-gallery-main img {
    width: 100%; height: 100%;
    object-fit: cover; display: block;
    transition: transform .5s ease;
}
.vs-gallery-main:hover img { transform: scale(1.03); }
.vs-gallery-badge {
    position: absolute; top: 12px; left: 12px;
    background: var(--orange); color: #fff;
    font-size: 0.65rem; font-weight: 600; letter-spacing: .08em;
    text-transform: uppercase; padding: 4px 10px; border-radius: 100px;
}
.vs-gallery-thumbs { 
    display: flex; gap: 6px; 
    overflow-x: auto; 
    padding-bottom: 4px;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
}
.vs-gallery-thumbs::-webkit-scrollbar { display: none; }
.vs-thumb {
    flex: 0 0 auto; width: 64px; height: 64px;
    border-radius: 8px; overflow: hidden;
    cursor: pointer; border: 2px solid transparent;
    transition: border-color .2s, opacity .2s; opacity: .6;
}
.vs-thumb:hover, .vs-thumb.active { border-color: var(--orange); opacity: 1; }
.vs-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }

/* ══ INFO ══ */
.vs-info { display: flex; flex-direction: column; }
.vs-info-cat {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.7rem; font-weight: 600; letter-spacing: .1em;
    text-transform: uppercase; color: var(--orange);
    background: var(--orange-bg); padding: 4px 12px;
    border-radius: 100px; width: fit-content; margin-bottom: 10px;
}
.vs-info-title {
    font-family: var(--fh);
    font-size: clamp(1.5rem, 5vw, 2.2rem);
    font-weight: 700; color: var(--ink);
    letter-spacing: -.03em; line-height: 1.2; margin-bottom: 10px;
}
.vs-info-rating {
    display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
    margin-bottom: 14px; padding-bottom: 14px;
    border-bottom: 1px solid var(--warm-gray);
}
.vs-stars { color: #f59e0b; font-size: 0.85rem; letter-spacing: 1px; }
.vs-rating-txt { font-size: 0.75rem; color: var(--ink-soft); }
.vs-info-price {
    font-size: clamp(1.4rem, 4vw, 1.8rem);
    font-weight: 700; color: var(--orange); margin-bottom: 12px; line-height: 1.1;
}
.vs-info-price del { color: var(--ink-soft); font-size: 1rem; opacity: .5; margin-right: 6px; }
.vs-short-desc { font-size: 0.9rem; color: var(--ink-soft); line-height: 1.7; margin-bottom: 18px; }

/* Quick features */
.vs-features {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 6px; margin-bottom: 20px;
}
@media(max-width: 400px) {
    .vs-features { grid-template-columns: repeat(2, 1fr); }
}
.vs-feat {
    background: var(--orange-bg); border-radius: 10px;
    padding: 10px 6px; text-align: center;
}
.vs-feat i { color: var(--orange); font-size: 0.9rem; margin-bottom: 4px; display: block; }
.vs-feat span { font-size: 0.65rem; color: var(--ink-soft); font-weight: 500; line-height: 1.3; display: block; }

/* CTA */
.vs-cta-group { display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px; }
.vs-btn-cart,
.vs-btn-wa {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    padding: 14px 20px; border-radius: 100px;
    font-size: 0.9rem; font-weight: 600;
    text-decoration: none; transition: all .25s;
    cursor: pointer; border: none; width: 100%; font-family: var(--fb);
    min-height: 48px; /* Touch target */
}
.vs-btn-cart {
    background: var(--ink); color: #fff;
    box-shadow: 0 4px 20px rgba(26,18,8,0.15);
}
.vs-btn-cart:hover { background: var(--orange); transform: translateY(-2px); }
.vs-btn-wa {
    background: #25d366; color: #fff;
    box-shadow: 0 4px 16px rgba(37,211,102,0.25);
}
.vs-btn-wa:hover { background: #1ebe5d; transform: translateY(-1px); }

/* Trust */
.vs-trust {
    display: flex; gap: 12px; flex-wrap: wrap;
    padding-top: 14px; border-top: 1px solid var(--warm-gray); margin-bottom: 14px;
}
.vs-trust-item {
    display: flex; align-items: center; gap: 5px;
    font-size: 0.72rem; color: var(--ink-soft); font-weight: 500;
}
.vs-trust-item i { color: var(--orange); font-size: 0.75rem; }
.vs-meta { font-size: 0.75rem; color: var(--ink-soft); }
.vs-meta span { display: block; margin-bottom: 2px; }
.vs-meta a { color: var(--orange); text-decoration: none; }

/* ══ TABS ══ */
.vs-tabs-section {
    grid-column: 1 / -1;
    margin-top: 40px; padding-top: 32px;
    border-top: 2px solid var(--warm-gray);
}
.vs-tabs-nav {
    display: flex; list-style: none;
    border-bottom: 2px solid var(--warm-gray); margin-bottom: 24px;
    overflow-x: auto; -webkit-overflow-scrolling: touch; scrollbar-width: none;
    gap: 4px;
    /* Scroll indicator */
    position: relative;
}
.vs-tabs-nav::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(to right, transparent, var(--warm-gray), transparent);
    pointer-events: none;
}
.vs-tabs-nav::-webkit-scrollbar { display: none; }
.vs-tab-btn {
    padding: 12px 16px; font-family: var(--fb); font-size: 0.85rem; font-weight: 600;
    color: var(--ink-soft); cursor: pointer; border: none; background: none;
    border-bottom: 3px solid transparent; margin-bottom: -2px;
    transition: color .2s; white-space: nowrap; flex-shrink: 0;
    min-height: 44px; display: flex; align-items: center;
}
.vs-tab-btn.active { color: var(--ink); border-bottom-color: var(--orange); }
.vs-tab-btn:hover { color: var(--ink); }
.vs-tab-panel { display: none; }
.vs-tab-panel.active { display: block; animation: fadeIn .3s ease; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: none; } }

.vs-tab-panel h3 {
    font-family: var(--fh); font-size: clamp(1.2rem, 4vw, 1.4rem); color: var(--ink);
    letter-spacing: -.02em; margin-bottom: 12px;
}
.vs-tab-panel p { font-size: 0.9rem; color: var(--ink-soft); line-height: 1.8; max-width: 720px; margin-bottom: 12px; }
.vs-tab-panel > ul { list-style: none; display: flex; flex-direction: column; gap: 8px; max-width: 600px; }
.vs-tab-panel > ul li { display: flex; align-items: flex-start; gap: 8px; font-size: 0.875rem; color: var(--ink-soft); }
.vs-tab-panel > ul li::before { content: ''; width: 6px; height: 6px; background: var(--orange); border-radius: 50%; flex-shrink: 0; margin-top: 8px; }

/* Desc content */
.vs-desc-content { max-width: 760px; color: var(--ink-soft); font-size: 0.9rem; line-height: 1.8; }
.vs-desc-content h1, .vs-desc-content h2, .vs-desc-content h3, .vs-desc-content h4 {
    font-family: var(--fh); color: var(--ink); letter-spacing: -.02em; margin: 24px 0 8px; line-height: 1.2;
}
.vs-desc-content h2 { font-size: clamp(1.2rem, 4vw, 1.4rem); }
.vs-desc-content h3 { font-size: clamp(1.1rem, 3.5vw, 1.2rem); }
.vs-desc-content p { margin-bottom: 12px; }
.vs-desc-content strong { color: var(--ink); font-weight: 600; }
.vs-desc-content a { color: var(--orange); text-decoration: underline; word-break: break-word; }
.vs-desc-content ul, .vs-desc-content ol {
    margin: 8px 0 16px; padding: 0; list-style: none;
    display: flex; flex-direction: column; gap: 6px;
}
.vs-desc-content ul li {
    display: flex; align-items: flex-start; gap: 8px;
    font-size: 0.85rem; color: var(--ink-soft); line-height: 1.6;
    padding: 8px 12px; background: var(--white);
    border-radius: 8px; border: 1px solid var(--warm-gray);
}
.vs-desc-content ul li::before {
    content: ''; width: 6px; height: 6px;
    background: var(--orange); border-radius: 50%;
    flex-shrink: 0; margin-top: 8px; align-self: flex-start;
}
.vs-desc-content ol { counter-reset: vs-counter; }
.vs-desc-content ol li {
    counter-increment: vs-counter;
    display: flex; align-items: flex-start; gap: 8px;
    font-size: 0.85rem; color: var(--ink-soft); line-height: 1.6;
}
.vs-desc-content ol li::before {
    content: counter(vs-counter); min-width: 22px; height: 22px;
    background: var(--orange-bg); color: var(--orange); border-radius: 50%;
    font-size: 0.7rem; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-top: 3px;
}
.vs-desc-content table {
    width: 100%; border-collapse: collapse; margin: 16px 0; font-size: 0.825rem;
    display: block; overflow-x: auto; -webkit-overflow-scrolling: touch;
}
.vs-desc-content table th {
    background: var(--orange-bg); color: var(--ink); font-weight: 600;
    padding: 8px 12px; text-align: left; border-bottom: 2px solid var(--orange-mid); white-space: nowrap;
}
.vs-desc-content table td { padding: 8px 12px; border-bottom: 1px solid var(--warm-gray); color: var(--ink-soft); vertical-align: top; }
.vs-desc-content blockquote {
    margin: 16px 0; padding: 12px 16px;
    background: var(--orange-bg); border-left: 4px solid var(--orange);
    border-radius: 0 10px 10px 0; color: var(--ink-soft); font-style: italic;
}
.vs-desc-content img { max-width: 100%; height: auto; border-radius: 10px; margin: 12px 0; display: block; }

/* Map */
.vs-desc-content .sgpx-wrapper,
.vs-desc-content [class*="sgpx"],
.vs-desc-content .leaflet-container {
    width: 100% !important; max-width: 100% !important;
    border-radius: 14px !important; overflow: hidden !important;
    margin: 0 !important; border: none !important; display: block;
}
.vs-desc-content iframe { display: block; width: 100% !important; min-height: 280px; border: none; border-radius: 14px; }
.vs-map-card {
    position: relative; margin: 20px 0; border-radius: 16px; overflow: hidden;
    box-shadow: 0 10px 32px rgba(232,89,12,0.12); border: 1px solid var(--orange-mid); background: var(--white);
}
.vs-map-card-header {
    display: flex; align-items: center; gap: 8px;
    padding: 12px 16px; background: var(--orange); color: #fff;
}
.vs-map-card-header i { font-size: 0.9rem; }
.vs-map-card-header strong { font-size: 0.85rem; font-weight: 600; }
.vs-map-card-header span { font-size: 0.7rem; opacity: .85; margin-left: auto; }
.vs-map-card-footer {
    padding: 8px 16px; background: var(--orange-bg);
    display: flex; gap: 12px; flex-wrap: wrap;
}
.vs-map-stat { display: flex; align-items: center; gap: 4px; font-size: 0.7rem; color: var(--ink-soft); font-weight: 500; }
.vs-map-stat i { color: var(--orange); font-size: 0.7rem; }

/* ══ RELATED ══ */
.vs-related { grid-column: 1 / -1; margin-top: 40px; }
.vs-related-title {
    font-family: var(--fh); font-size: clamp(1.3rem, 4vw, 1.7rem);
    color: var(--ink); letter-spacing: -.03em; margin-bottom: 20px;
}
.vs-related-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
@media(min-width: 768px) { .vs-related-grid { grid-template-columns: repeat(3, 1fr); gap: 16px; } }
.vs-rel-card {
    background: var(--white); border-radius: 14px; overflow: hidden;
    border: 1px solid var(--warm-gray); transition: transform .3s, box-shadow .3s;
    text-decoration: none; display: flex; flex-direction: column;
}
.vs-rel-card:hover { transform: translateY(-3px); box-shadow: 0 12px 28px rgba(232,89,12,0.1); }
.vs-rel-img { aspect-ratio: 4/3; overflow: hidden; }
.vs-rel-img img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .5s; }
.vs-rel-card:hover .vs-rel-img img { transform: scale(1.05); }
.vs-rel-body { padding: 12px; flex: 1; display: flex; flex-direction: column; }
.vs-rel-title { font-family: var(--fh); font-size: 0.9rem; color: var(--ink); letter-spacing: -.01em; margin-bottom: 4px; line-height: 1.3; }
.vs-rel-price { font-size: 0.875rem; font-weight: 700; color: var(--orange); margin-top: auto; padding-top: 6px; }

/* ══ FOOTER ══ */
.vs-footer {
    background: var(--ink); color: rgba(255,255,255,0.45);
    padding: 40px 20px 24px; margin-top: 56px;
    width: 100%;
}
.vs-footer-inner { max-width: 1200px; margin: 0 auto; }
.vs-footer-top {
    display: grid; grid-template-columns: 1fr;
    gap: 32px; padding-bottom: 32px;
    border-bottom: 1px solid rgba(255,255,255,0.07); margin-bottom: 20px;
}
@media(min-width: 768px) { .vs-footer-top { grid-template-columns: 2fr 1fr 1fr 1fr; gap: 36px; } }
.vs-footer-logo { font-family: var(--fh); font-size: 1.4rem; color: #fff; text-decoration: none; display: block; margin-bottom: 8px; }
.vs-footer-logo span { color: var(--orange-lt); }
.vs-footer-desc { font-size: 0.825rem; line-height: 1.7; max-width: 220px; }
.vs-footer-col h6 { font-size: 0.65rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: rgba(255,255,255,0.25); margin-bottom: 14px; }
.vs-footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 8px; }
.vs-footer-col a { text-decoration: none; color: rgba(255,255,255,0.45); font-size: 0.825rem; transition: color .2s; min-height: 36px; display: flex; align-items: center; }
.vs-footer-col a:hover { color: #fff; }
.vs-footer-bottom { display: flex; justify-content: space-between; align-items: center; font-size: 0.72rem; flex-wrap: wrap; gap: 8px; }

/* ══ LIGHTBOX ══ */
.vs-lightbox {
    display: none; position: fixed; inset: 0; z-index: 999;
    background: rgba(0,0,0,0.94); align-items: center; justify-content: center; padding: 16px;
}
.vs-lightbox.open { display: flex; }
.vs-lightbox img { max-width: 100%; max-height: 85vh; border-radius: 10px; object-fit: contain; }
.vs-lightbox-close { position: absolute; top: 12px; right: 16px; color: #fff; font-size: 1.75rem; cursor: pointer; opacity: .7; background: none; border: none; min-width: 44px; min-height: 44px; display: flex; align-items: center; justify-content: center; }
.vs-lightbox-close:hover { opacity: 1; }

/* Animations */
.vs-fade { opacity: 0; transform: translateY(16px); transition: opacity .5s ease, transform .5s ease; }
.vs-fade.in { opacity: 1; transform: none; }

/* ══ STICKY WA (mobile) ══ */
.vs-sticky-wa {
    display: none; position: fixed; bottom: calc(16px + var(--safe-area-bottom)); right: 16px; z-index: 300;
    background: #25d366; color: #fff;
    width: 52px; height: 52px; border-radius: 50%;
    align-items: center; justify-content: center;
    font-size: 1.3rem; box-shadow: 0 6px 24px rgba(37,211,102,0.4);
    text-decoration: none; transition: transform .2s;
}
.vs-sticky-wa:hover { transform: scale(1.08); }
@media(max-width: 768px) { .vs-sticky-wa { display: flex; } }

/* Prevent horizontal scroll */
img, video, iframe, embed, object { max-width: 100%; height: auto; display: block; }
</style>

<!-- NAV -->
<nav class="vs-nav">
    <a href="/" class="vs-logo">BwiCycling<span>.</span></a>
    <ul class="vs-nav-links">
        <li><a href="/#how">Cara Booking</a></li>
        <li><a href="/shop">Tour</a></li>
        <li><a href="/#contact">Kontak</a></li>
    </ul>
    <div class="vs-nav-right">
        <a href="https://wa.me/628123456789" class="vs-nav-btn">
            <i class="fab fa-whatsapp"></i> <span>Booking</span>
        </a>
        <button class="vs-hamburger" onclick="vsToggleMenu()" aria-label="Menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- Mobile Menu -->
<div class="vs-mobile-menu" id="vs-mobile-menu">
    <a href="/#how" onclick="vsToggleMenu()">Cara Booking</a>
    <a href="/shop" onclick="vsToggleMenu()">Tour</a>
    <a href="/#contact" onclick="vsToggleMenu()">Kontak</a>
    <a href="https://wa.me/628123456789" style="color:var(--orange);font-weight:600;" onclick="vsToggleMenu()">
        <i class="fab fa-whatsapp"></i> Booking via WhatsApp
    </a>
</div>

<!-- BREADCRUMB -->
<div class="vs-breadcrumb">
    <a href="/">Home</a>
    <i class="fas fa-chevron-right"></i>
    <a href="/shop">Tour</a>
    <i class="fas fa-chevron-right"></i>
    <span><?php echo esc_html( $title ); ?></span>
</div>

<!-- PRODUCT -->
<div class="vs-product">

    <!-- KIRI: Gallery -->
    <div class="vs-gallery vs-fade">
        <div class="vs-gallery-main" id="vs-main-img-wrap" onclick="vsOpenLight('<?php echo esc_js( $thumb_url ); ?>')">
            <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" id="vs-main-img" loading="lazy">
            <div class="vs-gallery-badge">Paket Tour</div>
        </div>
        <?php if ( ! empty( $gallery_ids ) ) : ?>
        <div class="vs-gallery-thumbs">
            <div class="vs-thumb active" onclick="vsSwitch(this, '<?php echo esc_js( $thumb_url ); ?>')">
                <img src="<?php echo esc_url( wp_get_attachment_image_url( $thumb_id, 'thumbnail' ) ); ?>" alt="" loading="lazy">
            </div>
            <?php foreach ( array_slice( $gallery_ids, 0, 4 ) as $gid ) :
                $full  = wp_get_attachment_image_url( $gid, 'large' );
                $thumb = wp_get_attachment_image_url( $gid, 'thumbnail' );
                if ( ! $full ) continue;
            ?>
            <div class="vs-thumb" onclick="vsSwitch(this, '<?php echo esc_js( $full ); ?>')">
                <img src="<?php echo esc_url( $thumb ); ?>" alt="" loading="lazy">
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- KANAN: Info -->
    <div class="vs-info vs-fade" style="transition-delay:.1s">
        <?php if ( $cats ) : ?>
        <div class="vs-info-cat"><i class="fas fa-tag"></i> <?php echo wp_kses_post( $cats ); ?></div>
        <?php endif; ?>
        <h1 class="vs-info-title"><?php echo esc_html( $title ); ?></h1>
        <?php if ( $rating > 0 ) : ?>
        <div class="vs-info-rating">
            <div class="vs-stars">
                <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                    <i class="fa<?php echo $i <= round( $rating ) ? 's' : 'r'; ?> fa-star"></i>
                <?php endfor; ?>
            </div>
            <span class="vs-rating-txt"><?php echo number_format( $rating, 1 ); ?> / 5 · <?php echo $review_count; ?> ulasan</span>
        </div>
        <?php endif; ?>
        <div class="vs-info-price"><?php echo $price_html; ?></div>
        <?php if ( $short_desc ) : ?>
        <div class="vs-short-desc"><?php echo wp_kses_post( $short_desc ); ?></div>
        <?php endif; ?>
        <div class="vs-features">
            <div class="vs-feat"><i class="fas fa-bicycle"></i><span>Sepeda Premium</span></div>
            <div class="vs-feat"><i class="fas fa-user-shield"></i><span>Guide Pro</span></div>
            <div class="vs-feat"><i class="fas fa-route"></i><span>Rute Lengkap</span></div>
            <div class="vs-feat"><i class="fas fa-helmet-safety"></i><span>Perlengkapan</span></div>
            <div class="vs-feat"><i class="fas fa-camera"></i><span>Foto Gratis</span></div>
            <div class="vs-feat"><i class="fas fa-coffee"></i><span>Snack Inklusif</span></div>
        </div>
        <div class="vs-cta-group">
            <a href="https://wa.me/628123456789?text=<?php echo $wa_msg; ?>" target="_blank" class="vs-btn-wa">
                <i class="fab fa-whatsapp" style="font-size:1.1rem;"></i> Tanya via WhatsApp
            </a>
        </div>
        <div class="vs-trust">
            <div class="vs-trust-item"><i class="fas fa-shield-alt"></i> Pembayaran Aman</div>
            <div class="vs-trust-item"><i class="fas fa-sync-alt"></i> Reschedule Gratis</div>
            <div class="vs-trust-item"><i class="fas fa-headset"></i> Support 24/7</div>
        </div>
        <div class="vs-meta">
            <?php if ( $sku ) : ?><span>SKU: <?php echo esc_html( $sku ); ?></span><?php endif; ?>
            <?php if ( $cats ) : ?><span>Kategori: <?php echo wp_kses_post( $cats ); ?></span><?php endif; ?>
        </div>
    </div>

    <!-- TABS -->
    <div class="vs-tabs-section vs-fade" style="transition-delay:.2s">
        <ul class="vs-tabs-nav" role="tablist">
            <li><button class="vs-tab-btn active" onclick="vsTab(event,'tab-desc')" role="tab" aria-selected="true">Deskripsi</button></li>
            <li><button class="vs-tab-btn" onclick="vsTab(event,'tab-include')" role="tab" aria-selected="false">Sudah Termasuk</button></li>
            <li><button class="vs-tab-btn" onclick="vsTab(event,'tab-faq')" role="tab" aria-selected="false">FAQ</button></li>
            <?php if ( comments_open() ) : ?>
            <li><button class="vs-tab-btn" onclick="vsTab(event,'tab-review')" role="tab" aria-selected="false">Ulasan (<?php echo $review_count; ?>)</button></li>
            <?php endif; ?>
        </ul>

        <div id="tab-desc" class="vs-tab-panel active" role="tabpanel">
            <div class="vs-desc-content">
                <?php if ( $desc ) : ?>
                    <?php echo do_shortcode( wpautop( wptexturize( $desc ) ) ); ?>
                <?php else : ?>
                    <p>Nikmati pengalaman bersepeda premium di jalur-jalur ikonik Banyuwangi. Dengan pemandu berpengalaman dan sepeda road bike kelas atas, setiap pedal kayuhan membawa Anda lebih dekat ke keindahan alam Jawa Timur yang menakjubkan.</p>
                <?php endif; ?>
            </div>
        </div>

        <div id="tab-include" class="vs-tab-panel" role="tabpanel" hidden>
            <h3>Sudah Termasuk</h3>
            <ul>
                <li>Sepeda road bike premium (ukuran disesuaikan)</li>
                <li>Helm & perlengkapan keselamatan lengkap</li>
                <li>Pemandu profesional berpengalaman</li>
                <li>Snack dan air mineral selama perjalanan</li>
                <li>Dokumentasi foto perjalanan</li>
                <li>Asuransi perjalanan dasar</li>
                <li>Transfer dari meeting point</li>
            </ul>
        </div>

        <div id="tab-faq" class="vs-tab-panel" role="tabpanel" hidden>
            <h3>Pertanyaan Umum</h3>
            <p><strong>Apakah harus bisa bersepeda?</strong><br>Ya, peserta minimal bisa bersepeda mandiri. Untuk rute menengah/sulit, diperlukan fisik yang cukup fit.</p>
            <p><strong>Berapa usia minimum peserta?</strong><br>Minimal 14 tahun. Peserta di bawah 18 tahun harus didampingi orang tua/wali.</p>
            <p><strong>Bagaimana jika cuaca buruk?</strong><br>Kami akan menghubungi Anda H-1 dan menawarkan reschedule gratis jika cuaca tidak mendukung.</p>
            <p><strong>Apakah bisa custom rute?</strong><br>Tentu! Hubungi kami via WhatsApp untuk paket custom sesuai kebutuhan grup Anda.</p>
        </div>

        <?php if ( comments_open() ) : ?>
        <div id="tab-review" class="vs-tab-panel" role="tabpanel" hidden>
            <h3>Ulasan Pelanggan</h3>
            <?php comments_template(); ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- RELATED -->
    <?php
    $related_ids = wc_get_related_products( get_the_ID(), 3 );
    if ( ! empty( $related_ids ) ) :
    ?>
    <div class="vs-related vs-fade" style="transition-delay:.3s">
        <h2 class="vs-related-title">Paket Tour Lainnya</h2>
        <div class="vs-related-grid">
            <?php foreach ( $related_ids as $rid ) :
                $rp = wc_get_product( $rid );
                if ( ! $rp ) continue;
                $rimg = $rp->get_image_id() ? wp_get_attachment_image_url( $rp->get_image_id(), 'medium' ) : 'https://images.unsplash.com/photo-1476041776130-7a2e391aeb44?q=80&w=600&auto=format&fit=crop';
            ?>
            <a href="<?php echo get_permalink( $rid ); ?>" class="vs-rel-card">
                <div class="vs-rel-img"><img src="<?php echo esc_url( $rimg ); ?>" alt="<?php echo esc_attr( $rp->get_name() ); ?>" loading="lazy"></div>
                <div class="vs-rel-body">
                    <div class="vs-rel-title"><?php echo esc_html( $rp->get_name() ); ?></div>
                    <div class="vs-rel-price"><?php echo $rp->get_price_html(); ?></div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

</div><!-- .vs-product -->

<!-- FOOTER -->
<footer class="vs-footer">
    <div class="vs-footer-inner">
        <div class="vs-footer-top">
            <div>
                <a href="/" class="vs-footer-logo">BwiCycling<span>.</span></a>
                <p class="vs-footer-desc">Road bike premium, pemandu asik, dan rute terbaik di Banyuwangi.</p>
            </div>
            <div class="vs-footer-col">
                <h6>Menu</h6>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/shop">Rental & Tour</a></li>
                    <li><a href="/#how">Cara Booking</a></li>
                </ul>
            </div>
            <div class="vs-footer-col">
                <h6>Info</h6>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Privasi</a></li>
                </ul>
            </div>
            <div class="vs-footer-col">
                <h6>Kontak</h6>
                <ul>
                    <li><a href="tel:+628123456789"><i class="fab fa-whatsapp"></i> +62 812 3456 789</a></li>
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> Banyuwangi, Jawa Timur</a></li>
                </ul>
            </div>
        </div>
        <div class="vs-footer-bottom">
            <span>&copy; <?php echo date('Y'); ?> BwiCycling · Banyuwangi Cycling Tours.</span>
            <span>Made with ♥ in Banyuwangi</span>
        </div>
    </div>
</footer>

<!-- Sticky WA (mobile only) -->
<a href="https://wa.me/628123456789?text=<?php echo $wa_msg; ?>" target="_blank" class="vs-sticky-wa" aria-label="WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Lightbox -->
<div class="vs-lightbox" id="vs-lightbox" onclick="vsCloseLight()" role="dialog" aria-modal="true">
    <button class="vs-lightbox-close" onclick="vsCloseLight()" aria-label="Close">&times;</button>
    <img src="" id="vs-light-img" alt="">
</div>

<script>
// Gallery switch
function vsSwitch(el, src) {
    document.getElementById('vs-main-img').src = src;
    document.getElementById('vs-main-img-wrap').onclick = function(){ vsOpenLight(src); };
    document.querySelectorAll('.vs-thumb').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
}

// Lightbox
function vsOpenLight(src) {
    document.getElementById('vs-light-img').src = src;
    document.getElementById('vs-lightbox').classList.add('open');
    document.body.style.overflow = 'hidden'; // Prevent scroll
}
function vsCloseLight() { 
    document.getElementById('vs-lightbox').classList.remove('open');
    document.body.style.overflow = '';
}

// Tabs
function vsTab(e, id) {
    const btn = e.currentTarget;
    const tablist = btn.closest('.vs-tabs-nav');
    
    // Update buttons
    tablist.querySelectorAll('.vs-tab-btn').forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-selected', 'false');
    });
    btn.classList.add('active');
    btn.setAttribute('aria-selected', 'true');
    
    // Update panels
    const section = tablist.closest('.vs-tabs-section');
    section.querySelectorAll('.vs-tab-panel').forEach(p => {
        p.classList.remove('active');
        p.hidden = true;
    });
    const panel = document.getElementById(id);
    panel.classList.add('active');
    panel.hidden = false;
}

// Mobile menu toggle
function vsToggleMenu() {
    const menu = document.getElementById('vs-mobile-menu');
    const btn = document.querySelector('.vs-hamburger');
    const isOpen = menu.classList.toggle('open');
    btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
}

// Close menu when clicking outside
document.addEventListener('click', function(e) {
    const menu = document.getElementById('vs-mobile-menu');
    const nav = document.querySelector('.vs-nav');
    if (menu.classList.contains('open') && !e.target.closest('.vs-nav') && !e.target.closest('.vs-mobile-menu')) {
        menu.classList.remove('open');
        document.querySelector('.vs-hamburger').setAttribute('aria-expanded', 'false');
    }
});

// Fade-in animation on scroll
const io = new IntersectionObserver(entries => {
    entries.forEach(e => { 
        if (e.isIntersecting) { 
            e.target.classList.add('in'); 
            io.unobserve(e.target); 
        } 
    });
}, { threshold: 0.08 });
document.querySelectorAll('.vs-fade').forEach(el => io.observe(el));

// Map card wrapper
document.addEventListener('DOMContentLoaded', function() {
    const maps = document.querySelectorAll(
        '.vs-desc-content .sgpx-wrapper, .vs-desc-content [class*="sgpx"], ' +
        '.vs-desc-content .leaflet-container, .vs-desc-content iframe[src*="gpx"], .vs-desc-content iframe[src*="map"]'
    );
    maps.forEach(function(map) {
        if (map.closest('.vs-map-card')) return;
        const parent = map.parentElement;
        const card = document.createElement('div');
        card.className = 'vs-map-card';
        card.innerHTML =
            '<div class="vs-map-card-header">' +
                '<i class="fas fa-map-marked-alt"></i>' +
                '<strong>Peta Rute Perjalanan</strong>' +
                '<span><i class="fas fa-bicycle"></i> Cycling Route</span>' +
            '</div><div class="vs-map-card-body"></div>' +
            '<div class="vs-map-card-footer">' +
                '<div class="vs-map-stat"><i class="fas fa-road"></i> Lihat jalur lengkap</div>' +
                '<div class="vs-map-stat"><i class="fas fa-mountain"></i> Elevasi & jarak</div>' +
                '<div class="vs-map-stat"><i class="fas fa-map-pin"></i> Titik pemberhentian</div>' +
            '</div>';
        parent.insertBefore(card, map);
        card.querySelector('.vs-map-card-body').appendChild(map);
    });
    
    // Remove empty paragraphs
    document.querySelectorAll('.vs-desc-content p').forEach(function(p) {
        if (p.innerHTML.trim() === '' || p.innerHTML.trim() === '&nbsp;') p.style.display = 'none';
    });
});

// Prevent zoom on input focus (iOS)
document.addEventListener('touchstart', function() {}, true);
</script>

<?php wp_footer(); ?>