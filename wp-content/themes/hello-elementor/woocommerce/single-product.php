<?php
/**
 * BwiCycling — Custom Single Product Page
 * Letakkan di: themes/hello-elementor/woocommerce/single-product.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Ambil data produk
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
$add_cart_url = $product->add_to_cart_url();
$product_url  = get_permalink();
$wa_msg       = urlencode( 'Halo BwiCycling! Saya tertarik dengan paket: ' . $title . '. Bisa info lebih lanjut?' );

get_header();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<?php wp_head(); ?>
<style>
/* ══════════════════════════════════════════
   BwiCycling — Single Product
   100% Custom, zero WooCommerce conflict
══════════════════════════════════════════ */
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
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body {
    font-family: var(--fb);
    background: var(--cream);
    color: var(--ink);
    -webkit-font-smoothing: antialiased;
    overflow-x: hidden;
}
/* Sembunyikan header/footer bawaan tema */
.site-header, .site-footer,
header.site-header, footer.site-footer,
#wpadminbar { display: none !important; }
html { margin-top: 0 !important; }

/* ── NAV ── */
.vs-nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 200;
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 52px;
    background: rgba(253,248,244,0.92);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(232,89,12,0.1);
}
.vs-logo {
    font-family: var(--fh); font-size: 1.6rem;
    color: var(--ink); text-decoration: none; letter-spacing: -.02em;
}
.vs-logo span { color: var(--orange); }
.vs-nav-links { display: flex; gap: 36px; list-style: none; }
.vs-nav-links a {
    text-decoration: none; color: var(--ink-soft);
    font-size: .875rem; font-weight: 500; transition: color .2s;
}
.vs-nav-links a:hover { color: var(--orange); }
.vs-nav-btn {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--orange); color: #fff;
    padding: 10px 22px; border-radius: 100px;
    font-size: .875rem; font-weight: 600;
    text-decoration: none; transition: all .25s;
    box-shadow: 0 4px 16px rgba(232,89,12,0.3);
}
.vs-nav-btn:hover { background: var(--orange-lt); transform: translateY(-1px); }
@media(max-width:768px){
    .vs-nav { padding: 14px 20px; }
    .vs-nav-links { display: none; }
}

/* ── BREADCRUMB ── */
.vs-breadcrumb {
    max-width: 1200px; margin: 0 auto;
    padding: 96px 32px 0;
    display: flex; align-items: center; gap: 8px;
    font-size: .8rem; color: var(--ink-soft);
}
.vs-breadcrumb a { color: var(--orange); text-decoration: none; }
.vs-breadcrumb a:hover { text-decoration: underline; }
.vs-breadcrumb i { font-size: .6rem; color: var(--warm-gray); }

/* ── PRODUCT LAYOUT ── */
.vs-product {
    max-width: 1200px; margin: 0 auto;
    padding: 32px 32px 80px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 64px;
    align-items: start;
}
@media(max-width:900px){
    .vs-product { grid-template-columns: 1fr; gap: 32px; padding: 24px 20px 60px; }
}

/* ── GALLERY KOLOM KIRI ── */
.vs-gallery { position: relative; }
.vs-gallery-main {
    width: 100%; border-radius: 22px; overflow: hidden;
    box-shadow: 0 20px 60px rgba(232,89,12,0.12);
    border: 1px solid var(--orange-mid);
    background: var(--white); margin-bottom: 12px;
    cursor: zoom-in; position: relative;
}
.vs-gallery-main img {
    width: 100%; height: 480px;
    object-fit: cover; display: block;
    transition: transform .5s ease;
}
.vs-gallery-main:hover img { transform: scale(1.03); }
.vs-gallery-badge {
    position: absolute; top: 16px; left: 16px;
    background: var(--orange); color: #fff;
    font-size: .7rem; font-weight: 600; letter-spacing: .08em;
    text-transform: uppercase; padding: 5px 14px;
    border-radius: 100px;
}
.vs-gallery-thumbs {
    display: flex; gap: 10px;
}
.vs-thumb {
    flex: 1; border-radius: 12px; overflow: hidden;
    cursor: pointer; border: 2px solid transparent;
    transition: border-color .2s, opacity .2s;
    opacity: .6;
}
.vs-thumb:hover, .vs-thumb.active {
    border-color: var(--orange); opacity: 1;
}
.vs-thumb img {
    width: 100%; height: 72px;
    object-fit: cover; display: block;
}

/* ── INFO KOLOM KANAN ── */
.vs-info { display: flex; flex-direction: column; }

.vs-info-cat {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: .72rem; font-weight: 600; letter-spacing: .1em;
    text-transform: uppercase; color: var(--orange);
    background: var(--orange-bg); padding: 5px 14px;
    border-radius: 100px; width: fit-content; margin-bottom: 14px;
}

.vs-info-title {
    font-family: var(--fh);
    font-size: clamp(1.8rem, 3vw, 2.6rem);
    font-weight: 700; color: var(--ink);
    letter-spacing: -.03em; line-height: 1.1;
    margin-bottom: 12px;
}

.vs-info-rating {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 20px; padding-bottom: 20px;
    border-bottom: 1px solid var(--warm-gray);
}
.vs-stars { color: #f59e0b; font-size: .9rem; letter-spacing: 1px; }
.vs-rating-txt { font-size: .8rem; color: var(--ink-soft); }

.vs-info-price {
    font-size: 2.2rem; font-weight: 700;
    color: var(--orange); margin-bottom: 16px; line-height: 1;
}
.vs-info-price del { color: var(--ink-soft); font-size: 1.2rem; opacity: .5; margin-right: 8px; }

.vs-short-desc {
    font-size: .95rem; color: var(--ink-soft);
    line-height: 1.8; margin-bottom: 24px;
}

/* Quick features */
.vs-features {
    display: grid; grid-template-columns: repeat(3,1fr);
    gap: 10px; margin-bottom: 28px;
}
.vs-feat {
    background: var(--orange-bg); border-radius: 14px;
    padding: 14px 10px; text-align: center;
}
.vs-feat i { color: var(--orange); font-size: 1.1rem; margin-bottom: 6px; display: block; }
.vs-feat span { font-size: .75rem; color: var(--ink-soft); font-weight: 500; line-height: 1.4; display: block; }

/* CTA Buttons */
.vs-cta-group { display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px; }

.vs-btn-cart {
    display: flex; align-items: center; justify-content: center; gap: 10px;
    background: var(--ink); color: #fff;
    padding: 15px 28px; border-radius: 100px;
    font-size: .9375rem; font-weight: 600;
    text-decoration: none; transition: all .25s;
    box-shadow: 0 4px 20px rgba(26,18,8,0.15);
    cursor: pointer; border: none; width: 100%;
    font-family: var(--fb);
}
.vs-btn-cart:hover { background: var(--orange); transform: translateY(-2px); box-shadow: 0 8px 28px rgba(232,89,12,0.3); }

.vs-btn-wa {
    display: flex; align-items: center; justify-content: center; gap: 10px;
    background: #25d366; color: #fff;
    padding: 14px 28px; border-radius: 100px;
    font-size: .9375rem; font-weight: 600;
    text-decoration: none; transition: all .25s;
    box-shadow: 0 4px 16px rgba(37,211,102,0.25);
}
.vs-btn-wa:hover { background: #1ebe5d; transform: translateY(-1px); }

/* Trust badges */
.vs-trust {
    display: flex; gap: 20px; flex-wrap: wrap;
    padding-top: 20px; border-top: 1px solid var(--warm-gray);
    margin-bottom: 20px;
}
.vs-trust-item {
    display: flex; align-items: center; gap: 7px;
    font-size: .78rem; color: var(--ink-soft); font-weight: 500;
}
.vs-trust-item i { color: var(--orange); font-size: .85rem; }

/* Meta */
.vs-meta { font-size: .8rem; color: var(--ink-soft); }
.vs-meta span { display: block; margin-bottom: 4px; }
.vs-meta a { color: var(--orange); text-decoration: none; }

/* ── TABS ── */
.vs-tabs-section {
    grid-column: 1 / -1;
    margin-top: 64px; padding-top: 48px;
    border-top: 2px solid var(--warm-gray);
}
.vs-tabs-nav {
    display: flex; gap: 4px; list-style: none;
    border-bottom: 2px solid var(--warm-gray);
    margin-bottom: 36px;
}
.vs-tab-btn {
    padding: 10px 24px;
    font-family: var(--fb); font-size: .875rem; font-weight: 600;
    color: var(--ink-soft); cursor: pointer;
    border: none; background: none;
    border-bottom: 3px solid transparent;
    margin-bottom: -2px; transition: color .2s;
}
.vs-tab-btn.active { color: var(--ink); border-bottom-color: var(--orange); }
.vs-tab-btn:hover { color: var(--ink); }
.vs-tab-panel { display: none; }
.vs-tab-panel.active { display: block; }
.vs-tab-panel h3 {
    font-family: var(--fh); font-size: 1.5rem; color: var(--ink);
    letter-spacing: -.02em; margin-bottom: 16px;
}
.vs-tab-panel p {
    font-size: .95rem; color: var(--ink-soft); line-height: 1.85;
    max-width: 720px; margin-bottom: 16px;
}
.vs-tab-panel ul {
    list-style: none; display: flex; flex-direction: column; gap: 10px;
    max-width: 600px;
}
.vs-tab-panel ul li {
    display: flex; align-items: flex-start; gap: 10px;
    font-size: .9rem; color: var(--ink-soft);
}
.vs-tab-panel ul li::before {
    content: ''; width: 8px; height: 8px;
    background: var(--orange); border-radius: 50%;
    flex-shrink: 0; margin-top: 7px;
}

/* ── Deskripsi konten dari WP editor ── */
.vs-desc-content {
    max-width: 760px;
    color: var(--ink-soft);
    font-size: .95rem;
    line-height: 1.9;
}
.vs-desc-content h1,
.vs-desc-content h2,
.vs-desc-content h3,
.vs-desc-content h4 {
    font-family: var(--fh);
    color: var(--ink);
    letter-spacing: -.02em;
    margin: 32px 0 12px;
    line-height: 1.2;
}
.vs-desc-content h2 { font-size: 1.5rem; }
.vs-desc-content h3 { font-size: 1.25rem; }
.vs-desc-content h4 { font-size: 1.05rem; }
.vs-desc-content p {
    margin-bottom: 16px;
    color: var(--ink-soft);
}
.vs-desc-content p:first-child { margin-top: 0; }
.vs-desc-content strong { color: var(--ink); font-weight: 600; }
.vs-desc-content em { color: var(--ink-soft); }
.vs-desc-content a { color: var(--orange); text-decoration: underline; }
.vs-desc-content a:hover { color: var(--orange-lt); }

/* List dalam deskripsi */
.vs-desc-content ul,
.vs-desc-content ol {
    margin: 12px 0 20px 0;
    padding: 0;
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.vs-desc-content ul li,
.vs-desc-content ol li {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: .9rem;
    color: var(--ink-soft);
    line-height: 1.7;
}
.vs-desc-content ul li::before {
    content: '';
    width: 7px; height: 7px;
    background: var(--orange);
    border-radius: 50%;
    flex-shrink: 0;
    margin-top: 8px;
}
.vs-desc-content ol {
    counter-reset: vs-counter;
}
.vs-desc-content ol li {
    counter-increment: vs-counter;
}
.vs-desc-content ol li::before {
    content: counter(vs-counter);
    min-width: 24px; height: 24px;
    background: var(--orange-bg);
    color: var(--orange);
    border-radius: 50%;
    font-size: .75rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
}

/* Tabel dalam deskripsi */
.vs-desc-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: .875rem;
}
.vs-desc-content table th {
    background: var(--orange-bg);
    color: var(--ink);
    font-weight: 600;
    padding: 12px 16px;
    text-align: left;
    border-bottom: 2px solid var(--orange-mid);
}
.vs-desc-content table td {
    padding: 11px 16px;
    border-bottom: 1px solid var(--warm-gray);
    color: var(--ink-soft);
    vertical-align: top;
}
.vs-desc-content table tr:last-child td { border-bottom: none; }
.vs-desc-content table tr:hover td { background: var(--cream); }

/* ── Highlights: satu baris per item, rapi ── */
.vs-desc-content ul li {
    display: flex;
    align-items: baseline;
    gap: 10px;
    flex-wrap: nowrap;
    white-space: normal;
    padding: 10px 14px;
    background: var(--white);
    border-radius: 10px;
    border: 1px solid var(--warm-gray);
    transition: border-color .2s, box-shadow .2s;
}
.vs-desc-content ul li:hover {
    border-color: var(--orange-mid);
    box-shadow: 0 4px 12px rgba(232,89,12,0.07);
}
.vs-desc-content ul li::before {
    content: '';
    width: 7px; height: 7px;
    background: var(--orange);
    border-radius: 50%;
    flex-shrink: 0;
    margin-top: 6px;
    align-self: flex-start;
}
/* Paksa semua inline element dalam li jadi inline biasa */
.vs-desc-content ul li strong { display: inline; white-space: nowrap; margin-right: 4px; }
.vs-desc-content ul li em    { display: inline; font-style: italic; }
.vs-desc-content ul li *     { display: inline; }

/* ── Map shortcode — eyecatching ── */
.vs-desc-content .sgpx-wrapper,
.vs-desc-content [class*="sgpx"],
.vs-desc-content .leaflet-container {
    width: 100% !important;
    max-width: 100% !important;
    border-radius: 20px !important;
    overflow: hidden !important;
    margin: 0 !important;
    border: none !important;
    display: block;
}
.vs-desc-content iframe {
    display: block;
    width: 100% !important;
    min-height: 380px;
    border: none;
    border-radius: 20px;
}
/* Wrapper cantik di sekitar map */
.vs-desc-content p:has(> .sgpx-wrapper),
.vs-desc-content p:has(> iframe),
.vs-desc-content p:has(> [class*="sgpx"]) {
    padding: 0;
    margin: 0;
}
/* Inject map card via sibling targeting — CSS only */
.vs-map-card {
    position: relative;
    margin: 28px 0;
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 16px 48px rgba(232,89,12,0.13);
    border: 1px solid var(--orange-mid);
    background: var(--white);
}
.vs-map-card-header {
    display: flex; align-items: center; gap: 12px;
    padding: 16px 20px;
    background: var(--orange);
    color: #fff;
}
.vs-map-card-header i { font-size: 1.1rem; }
.vs-map-card-header strong { font-size: .9rem; font-weight: 600; letter-spacing: .02em; }
.vs-map-card-header span { font-size: .78rem; opacity: .85; margin-left: auto; }
.vs-map-card-body { padding: 0; }
.vs-map-card-body .sgpx-wrapper,
.vs-map-card-body [class*="sgpx"],
.vs-map-card-body iframe {
    border-radius: 0 !important;
    margin: 0 !important;
    width: 100% !important;
}
.vs-map-card-footer {
    padding: 12px 20px;
    background: var(--orange-bg);
    display: flex; gap: 20px; flex-wrap: wrap;
}
.vs-map-stat {
    display: flex; align-items: center; gap: 7px;
    font-size: .78rem; color: var(--ink-soft); font-weight: 500;
}
.vs-map-stat i { color: var(--orange); font-size: .8rem; }

/* Blockquote / highlight */
.vs-desc-content blockquote {
    margin: 20px 0;
    padding: 16px 20px;
    background: var(--orange-bg);
    border-left: 4px solid var(--orange);
    border-radius: 0 12px 12px 0;
    color: var(--ink-soft);
    font-style: italic;
}

/* Image dalam deskripsi */
.vs-desc-content img {
    max-width: 100%;
    border-radius: 12px;
    margin: 16px 0;
    display: block;
}

/* ── RELATED ── */
.vs-related {
    grid-column: 1 / -1;
    margin-top: 64px;
}
.vs-related-title {
    font-family: var(--fh);
    font-size: clamp(1.5rem, 2.5vw, 2rem);
    color: var(--ink); letter-spacing: -.03em;
    margin-bottom: 28px;
}
.vs-related-grid {
    display: grid; grid-template-columns: repeat(3,1fr); gap: 20px;
}
@media(max-width:640px){ .vs-related-grid { grid-template-columns: 1fr 1fr; } }
.vs-rel-card {
    background: var(--white); border-radius: 18px;
    overflow: hidden; border: 1px solid var(--warm-gray);
    transition: transform .3s, box-shadow .3s;
    text-decoration: none; display: flex; flex-direction: column;
}
.vs-rel-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(232,89,12,0.1); }
.vs-rel-img { height: 170px; overflow: hidden; }
.vs-rel-img img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .5s; }
.vs-rel-card:hover .vs-rel-img img { transform: scale(1.06); }
.vs-rel-body { padding: 16px; flex: 1; display: flex; flex-direction: column; }
.vs-rel-title {
    font-family: var(--fh); font-size: 1rem; color: var(--ink);
    letter-spacing: -.01em; margin-bottom: 6px;
}
.vs-rel-price { font-size: .95rem; font-weight: 700; color: var(--orange); margin-top: auto; padding-top: 10px; }

/* ── FOOTER ── */
.vs-footer { background: var(--ink); color: rgba(255,255,255,0.45); padding: 56px 52px 36px; margin-top: 80px; }
.vs-footer-inner { max-width: 1200px; margin: 0 auto; }
.vs-footer-top {
    display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 48px; padding-bottom: 48px;
    border-bottom: 1px solid rgba(255,255,255,0.07);
    margin-bottom: 28px;
}
@media(max-width:900px){ .vs-footer-top { grid-template-columns: 1fr 1fr; gap: 32px; } }
@media(max-width:540px){ .vs-footer-top { grid-template-columns: 1fr; } }
.vs-footer-logo {
    font-family: var(--fh); font-size: 1.6rem; color: #fff;
    text-decoration: none; display: block; margin-bottom: 12px;
}
.vs-footer-logo span { color: var(--orange-lt); }
.vs-footer-desc { font-size: .875rem; line-height: 1.8; max-width: 240px; }
.vs-footer-col h6 {
    font-size: .7rem; font-weight: 700; letter-spacing: .12em;
    text-transform: uppercase; color: rgba(255,255,255,0.25);
    margin-bottom: 18px;
}
.vs-footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
.vs-footer-col a { text-decoration: none; color: rgba(255,255,255,0.45); font-size: .875rem; transition: color .2s; }
.vs-footer-col a:hover { color: #fff; }
.vs-footer-bottom {
    display: flex; justify-content: space-between; align-items: center;
    font-size: .78rem; flex-wrap: wrap; gap: 8px;
}

/* ── LIGHTBOX ── */
.vs-lightbox {
    display: none; position: fixed; inset: 0; z-index: 999;
    background: rgba(0,0,0,0.92); align-items: center; justify-content: center;
}
.vs-lightbox.open { display: flex; }
.vs-lightbox img { max-width: 90vw; max-height: 85vh; border-radius: 12px; }
.vs-lightbox-close {
    position: absolute; top: 20px; right: 28px;
    color: #fff; font-size: 2rem; cursor: pointer; opacity: .7;
    background: none; border: none; transition: opacity .2s;
}
.vs-lightbox-close:hover { opacity: 1; }

/* Animations */
.vs-fade { opacity: 0; transform: translateY(20px); transition: opacity .6s ease, transform .6s ease; }
.vs-fade.in { opacity: 1; transform: none; }
</style>
</head>
<body <?php body_class(); ?>>

<!-- ── NAV ── -->
<nav class="vs-nav">
    <a href="/" class="vs-logo">BwiCycling<span>.</span></a>
    <ul class="vs-nav-links">
        <li><a href="/#how">Cara Booking</a></li>
        <li><a href="/shop">Tour</a></li>
        <li><a href="/#contact">Kontak</a></li>
    </ul>
    <a href="https://wa.me/628123456789" class="vs-nav-btn">
        <i class="fab fa-whatsapp"></i> Booking Sekarang
    </a>
</nav>

<!-- ── BREADCRUMB ── -->
<div class="vs-breadcrumb">
    <a href="/">Home</a>
    <i class="fas fa-chevron-right"></i>
    <a href="/shop">Tour</a>
    <i class="fas fa-chevron-right"></i>
    <span><?php echo esc_html( $title ); ?></span>
</div>

<!-- ── PRODUCT ── -->
<div class="vs-product">

    <!-- KIRI: Gallery -->
    <div class="vs-gallery vs-fade">
        <div class="vs-gallery-main" id="vs-main-img-wrap" onclick="vsOpenLight('<?php echo esc_js( $thumb_url ); ?>')">
            <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" id="vs-main-img">
            <div class="vs-gallery-badge">Paket Tour</div>
        </div>

        <?php if ( ! empty( $gallery_ids ) ) : ?>
        <div class="vs-gallery-thumbs">
            <!-- Thumb utama -->
            <div class="vs-thumb active" onclick="vsSwitch(this, '<?php echo esc_js( $thumb_url ); ?>')">
                <img src="<?php echo esc_url( wp_get_attachment_image_url( $thumb_id, 'thumbnail' ) ); ?>" alt="">
            </div>
            <!-- Thumb gallery -->
            <?php foreach ( array_slice( $gallery_ids, 0, 4 ) as $gid ) :
                $full = wp_get_attachment_image_url( $gid, 'large' );
                $thumb = wp_get_attachment_image_url( $gid, 'thumbnail' );
                if ( ! $full ) continue;
            ?>
            <div class="vs-thumb" onclick="vsSwitch(this, '<?php echo esc_js( $full ); ?>')">
                <img src="<?php echo esc_url( $thumb ); ?>" alt="">
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
            <span class="vs-rating-txt"><?php echo $rating; ?> / 5 &nbsp;·&nbsp; <?php echo $review_count; ?> ulasan</span>
        </div>
        <?php endif; ?>

        <div class="vs-info-price"><?php echo $price_html; ?></div>

        <?php if ( $short_desc ) : ?>
        <div class="vs-short-desc"><?php echo wp_kses_post( $short_desc ); ?></div>
        <?php endif; ?>

        <!-- Quick features -->
        <div class="vs-features">
            <div class="vs-feat"><i class="fas fa-bicycle"></i><span>Sepeda Premium</span></div>
            <div class="vs-feat"><i class="fas fa-user-shield"></i><span>Guide Pro</span></div>
            <div class="vs-feat"><i class="fas fa-route"></i><span>Rute Lengkap</span></div>
            <div class="vs-feat"><i class="fas fa-helmet-safety"></i><span>Perlengkapan</span></div>
            <div class="vs-feat"><i class="fas fa-camera"></i><span>Foto Gratis</span></div>
            <div class="vs-feat"><i class="fas fa-coffee"></i><span>Snack Inklusif</span></div>
        </div>

        <!-- CTA Buttons -->
        <div class="vs-cta-group">
            <!-- <a href="<?php echo esc_url( $add_cart_url ); ?>" class="vs-btn-cart">
                <i class="fas fa-shopping-bag"></i> Booking Sekarang
            </a> -->
            <a href="https://wa.me/628123456789?text=<?php echo $wa_msg; ?>" target="_blank" class="vs-btn-wa">
                <i class="fab fa-whatsapp" style="font-size:1.1rem;"></i> Tanya via WhatsApp
            </a>
        </div>

        <!-- Trust badges -->
        <div class="vs-trust">
            <div class="vs-trust-item"><i class="fas fa-shield-alt"></i> Pembayaran Aman</div>
            <div class="vs-trust-item"><i class="fas fa-sync-alt"></i> Reschedule Gratis</div>
            <div class="vs-trust-item"><i class="fas fa-headset"></i> Support 24/7</div>
        </div>

        <!-- Meta -->
        <div class="vs-meta">
            <?php if ( $sku ) : ?><span>SKU: <?php echo esc_html( $sku ); ?></span><?php endif; ?>
            <?php if ( $cats ) : ?><span>Kategori: <?php echo wp_kses_post( $cats ); ?></span><?php endif; ?>
        </div>
    </div>

    <!-- TABS: Deskripsi & Info Tambahan -->
    <div class="vs-tabs-section vs-fade" style="transition-delay:.2s">
        <ul class="vs-tabs-nav">
            <li><button class="vs-tab-btn active" onclick="vsTab(event,'tab-desc')">Deskripsi</button></li>
            <li><button class="vs-tab-btn" onclick="vsTab(event,'tab-include')">Sudah Termasuk</button></li>
            <li><button class="vs-tab-btn" onclick="vsTab(event,'tab-faq')">FAQ</button></li>
            <?php if ( comments_open() ) : ?>
            <li><button class="vs-tab-btn" onclick="vsTab(event,'tab-review')">Ulasan (<?php echo $review_count; ?>)</button></li>
            <?php endif; ?>
        </ul>

        <div id="tab-desc" class="vs-tab-panel active">
            <?php if ( $desc ) : ?>
                <div class="vs-desc-content">
                    <?php echo do_shortcode( wpautop( wptexturize( $desc ) ) ); ?>
                </div>
            <?php else : ?>
                <div class="vs-desc-content">
                    <p>Nikmati pengalaman bersepeda premium di jalur-jalur ikonik Banyuwangi. Dengan pemandu berpengalaman dan sepeda road bike kelas atas, setiap pedal kayuhan membawa Anda lebih dekat ke keindahan alam Jawa Timur yang menakjubkan.</p>
                </div>
            <?php endif; ?>
        </div>

        <div id="tab-include" class="vs-tab-panel">
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

        <div id="tab-faq" class="vs-tab-panel">
            <h3>Pertanyaan Umum</h3>
            <p><strong>Apakah harus bisa bersepeda?</strong><br>Ya, peserta minimal bisa bersepeda mandiri. Untuk rute menengah/sulit, diperlukan fisik yang cukup fit.</p>
            <p><strong>Berapa usia minimum peserta?</strong><br>Minimal 14 tahun. Peserta di bawah 18 tahun harus didampingi orang tua/wali.</p>
            <p><strong>Bagaimana jika cuaca buruk?</strong><br>Kami akan menghubungi Anda H-1 dan menawarkan reschedule gratis jika cuaca tidak mendukung.</p>
            <p><strong>Apakah bisa custom rute?</strong><br>Tentu! Hubungi kami via WhatsApp untuk paket custom sesuai kebutuhan grup Anda.</p>
        </div>

        <?php if ( comments_open() ) : ?>
        <div id="tab-review" class="vs-tab-panel">
            <h3>Ulasan Pelanggan</h3>
            <?php comments_template(); ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- RELATED PRODUCTS -->
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
                <div class="vs-rel-img">
                    <img src="<?php echo esc_url( $rimg ); ?>" alt="<?php echo esc_attr( $rp->get_name() ); ?>">
                </div>
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

<!-- ── FOOTER ── -->
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

<!-- Lightbox -->
<div class="vs-lightbox" id="vs-lightbox" onclick="vsCloseLight()">
    <button class="vs-lightbox-close" onclick="vsCloseLight()">&times;</button>
    <img src="" id="vs-light-img" alt="">
</div>

<script>
// Gallery switch
function vsSwitch(el, src) {
    document.getElementById('vs-main-img').src = src;
    document.querySelectorAll('.vs-thumb').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
}

// Lightbox
function vsOpenLight(src) {
    document.getElementById('vs-light-img').src = src;
    document.getElementById('vs-lightbox').classList.add('open');
}
function vsCloseLight() {
    document.getElementById('vs-lightbox').classList.remove('open');
}

// Tabs
function vsTab(e, id) {
    document.querySelectorAll('.vs-tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.vs-tab-panel').forEach(p => p.classList.remove('active'));
    e.target.classList.add('active');
    document.getElementById(id).classList.add('active');
}

// Scroll fade-in
const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
    });
}, { threshold: 0.1 });
document.querySelectorAll('.vs-fade').forEach(el => io.observe(el));

// Wrap map shortcode in beautiful card
document.addEventListener('DOMContentLoaded', function() {

    // Wrap sgpx / leaflet map dalam card cantik
    const mapCandidates = document.querySelectorAll(
        '.vs-desc-content .sgpx-wrapper, ' +
        '.vs-desc-content [class*="sgpx"], ' +
        '.vs-desc-content .leaflet-container, ' +
        '.vs-desc-content iframe[src*="gpx"], ' +
        '.vs-desc-content iframe[src*="map"]'
    );

    mapCandidates.forEach(function(map) {
        // Cari parent terdekat yang bukan .vs-map-card-body
        if (map.closest('.vs-map-card')) return;
        const parent = map.parentElement;

        const card = document.createElement('div');
        card.className = 'vs-map-card';
        card.innerHTML =
            '<div class="vs-map-card-header">' +
                '<i class="fas fa-map-marked-alt"></i>' +
                '<strong>Peta Rute Perjalanan</strong>' +
                '<span><i class="fas fa-bicycle"></i> Cycling Route</span>' +
            '</div>' +
            '<div class="vs-map-card-body"></div>' +
            '<div class="vs-map-card-footer">' +
                '<div class="vs-map-stat"><i class="fas fa-road"></i> Lihat jalur lengkap di peta</div>' +
                '<div class="vs-map-stat"><i class="fas fa-mountain"></i> Elevasi & jarak tercatat</div>' +
                '<div class="vs-map-stat"><i class="fas fa-map-pin"></i> Semua titik pemberhentian</div>' +
            '</div>';

        parent.insertBefore(card, map);
        card.querySelector('.vs-map-card-body').appendChild(map);
    });

    // Jika sgpx render via shortcode di dalam <p> tag kosong, bersihkan
    document.querySelectorAll('.vs-desc-content p').forEach(function(p) {
        if (p.innerHTML.trim() === '' || p.innerHTML.trim() === '&nbsp;') {
            p.style.display = 'none';
        }
    });
});
</script>

<?php wp_footer(); ?>
</body>
</html>
<?php
// Prevent WordPress from outputting anything after
exit;