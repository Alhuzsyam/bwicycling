<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_VERSION', '3.4.6' );
define( 'EHP_THEME_SLUG', 'hello-elementor' );

define( 'HELLO_THEME_PATH', get_template_directory() );
define( 'HELLO_THEME_URL', get_template_directory_uri() );
define( 'HELLO_THEME_ASSETS_PATH', HELLO_THEME_PATH . '/assets/' );
define( 'HELLO_THEME_ASSETS_URL', HELLO_THEME_URL . '/assets/' );
define( 'HELLO_THEME_SCRIPTS_PATH', HELLO_THEME_ASSETS_PATH . 'js/' );
define( 'HELLO_THEME_SCRIPTS_URL', HELLO_THEME_ASSETS_URL . 'js/' );
define( 'HELLO_THEME_STYLE_PATH', HELLO_THEME_ASSETS_PATH . 'css/' );
define( 'HELLO_THEME_STYLE_URL', HELLO_THEME_ASSETS_URL . 'css/' );
define( 'HELLO_THEME_IMAGES_PATH', HELLO_THEME_ASSETS_PATH . 'images/' );
define( 'HELLO_THEME_IMAGES_URL', HELLO_THEME_ASSETS_URL . 'images/' );

if ( ! isset( $content_width ) ) {
    $content_width = 800;
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
    function hello_elementor_setup() {
        if ( is_admin() ) {
            hello_maybe_update_theme_version_in_db();
        }

        if ( apply_filters( 'hello_elementor_register_menus', true ) ) {
            register_nav_menus( [ 'menu-1' => esc_html__( 'Header', 'hello-elementor' ) ] );
            register_nav_menus( [ 'menu-2' => esc_html__( 'Footer', 'hello-elementor' ) ] );
        }

        if ( apply_filters( 'hello_elementor_post_type_support', true ) ) {
            add_post_type_support( 'page', 'excerpt' );
        }

        if ( apply_filters( 'hello_elementor_add_theme_support', true ) ) {
            add_theme_support( 'post-thumbnails' );
            add_theme_support( 'automatic-feed-links' );
            add_theme_support( 'title-tag' );
            add_theme_support( 'html5', [
                'search-form', 'comment-form', 'comment-list',
                'gallery', 'caption', 'script', 'style', 'navigation-widgets',
            ] );
            add_theme_support( 'custom-logo', [
                'height' => 100, 'width' => 350,
                'flex-height' => true, 'flex-width' => true,
            ] );
            add_theme_support( 'align-wide' );
            add_theme_support( 'responsive-embeds' );
            add_theme_support( 'editor-styles' );
            add_editor_style( 'assets/css/editor-styles.css' );

            if ( apply_filters( 'hello_elementor_add_woocommerce_support', true ) ) {
                add_theme_support( 'woocommerce' );
                add_theme_support( 'wc-product-gallery-zoom' );
                add_theme_support( 'wc-product-gallery-lightbox' );
                add_theme_support( 'wc-product-gallery-slider' );
            }
        }
    }
}
add_action( 'after_setup_theme', 'hello_elementor_setup' );

function hello_maybe_update_theme_version_in_db() {
    $theme_version_option_name = 'hello_theme_version';
    $hello_theme_db_version = get_option( $theme_version_option_name );
    if ( ! $hello_theme_db_version || version_compare( $hello_theme_db_version, HELLO_ELEMENTOR_VERSION, '<' ) ) {
        update_option( $theme_version_option_name, HELLO_ELEMENTOR_VERSION );
    }
}

if ( ! function_exists( 'hello_elementor_display_header_footer' ) ) {
    function hello_elementor_display_header_footer() {
        return apply_filters( 'hello_elementor_header_footer', true );
    }
}

if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
    function hello_elementor_scripts_styles() {
        if ( apply_filters( 'hello_elementor_enqueue_style', true ) ) {
            wp_enqueue_style( 'hello-elementor', HELLO_THEME_STYLE_URL . 'reset.css', [], HELLO_ELEMENTOR_VERSION );
        }
        if ( apply_filters( 'hello_elementor_enqueue_theme_style', true ) ) {
            wp_enqueue_style( 'hello-elementor-theme-style', HELLO_THEME_STYLE_URL . 'theme.css', [], HELLO_ELEMENTOR_VERSION );
        }
        if ( hello_elementor_display_header_footer() ) {
            wp_enqueue_style( 'hello-elementor-header-footer', HELLO_THEME_STYLE_URL . 'header-footer.css', [], HELLO_ELEMENTOR_VERSION );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_scripts_styles' );

if ( ! function_exists( 'hello_elementor_register_elementor_locations' ) ) {
    function hello_elementor_register_elementor_locations( $elementor_theme_manager ) {
        if ( apply_filters( 'hello_elementor_register_elementor_locations', true ) ) {
            $elementor_theme_manager->register_all_core_location();
        }
    }
}
add_action( 'elementor/theme/register_locations', 'hello_elementor_register_elementor_locations' );

if ( ! function_exists( 'hello_elementor_content_width' ) ) {
    function hello_elementor_content_width() {
        $GLOBALS['content_width'] = apply_filters( 'hello_elementor_content_width', 800 );
    }
}
add_action( 'after_setup_theme', 'hello_elementor_content_width', 0 );

if ( ! function_exists( 'hello_elementor_add_description_meta_tag' ) ) {
    function hello_elementor_add_description_meta_tag() {
        if ( ! apply_filters( 'hello_elementor_description_meta_tag', true ) ) return;
        if ( ! is_singular() ) return;
        $post = get_queried_object();
        if ( empty( $post->post_excerpt ) ) return;
        echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $post->post_excerpt ) ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'hello_elementor_add_description_meta_tag' );

require get_template_directory() . '/includes/settings-functions.php';
require get_template_directory() . '/includes/elementor-functions.php';

if ( ! function_exists( 'hello_elementor_customizer' ) ) {
    function hello_elementor_customizer() {
        if ( ! is_customize_preview() ) return;
        if ( ! hello_elementor_display_header_footer() ) return;
        require get_template_directory() . '/includes/customizer-functions.php';
    }
}
add_action( 'init', 'hello_elementor_customizer' );

if ( ! function_exists( 'hello_elementor_check_hide_title' ) ) {
    function hello_elementor_check_hide_title( $val ) {
        if ( defined( 'ELEMENTOR_VERSION' ) ) {
            $current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );
            if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
                $val = false;
            }
        }
        return $val;
    }
}
add_filter( 'hello_elementor_page_title', 'hello_elementor_check_hide_title' );

if ( ! function_exists( 'hello_elementor_body_open' ) ) {
    function hello_elementor_body_open() {
        wp_body_open();
    }
}

require HELLO_THEME_PATH . '/theme.php';
HelloTheme\Theme::instance();


/* =================================================================
 * VACASKY CUSTOM ASSETS & PRODUCT PAGE STYLE
 * Tema: Orange Warm — selaras dengan front-page.php
 * ================================================================= */

// 1. Matikan style bawaan Hello Elementor agar tidak bentrok
add_filter( 'hello_elementor_enqueue_style', '__return_false' );
add_filter( 'hello_elementor_enqueue_theme_style', '__return_false' );

// 2. Load semua asset Vacasky
function vacasky_load_assets() {

    // Font Awesome
    wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css' );

    // Google Fonts — sama persis dengan front-page.php
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap' );

    ?>

    <!-- CSS Variables Global — dipakai di semua halaman -->
    <style>
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
    }
    *, *::before, *::after { box-sizing: border-box; }
    body {
        font-family: var(--font-body);
        background: var(--cream);
        color: var(--ink);
        -webkit-font-smoothing: antialiased;
    }
    .site-header, .site-footer, #wpadminbar { display: none !important; }
    html { margin-top: 0 !important; }
    </style>

    <?php if ( function_exists('is_product') && is_product() ) : ?>
    <style>
    /* ════════════════════════════════════════════
       VACASKY — Single Product Page
       Selaras dengan front-page.php orange theme
    ════════════════════════════════════════════ */

    /* ── Breadcrumb ── */
    .woocommerce-breadcrumb {
        max-width: 1200px;
        margin: 0 auto;
        padding: 100px 32px 0;
        font-size: .8rem;
        color: var(--ink-soft);
    }
    .woocommerce-breadcrumb a {
        color: var(--orange);
        text-decoration: none;
    }
    .woocommerce-breadcrumb a:hover { text-decoration: underline; }

    /* ── Layout utama 2 kolom ── */
    .woocommerce div.product {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 32px 80px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 64px;
        align-items: start;
    }
    @media (max-width: 900px) {
        .woocommerce div.product {
            grid-template-columns: 1fr;
            gap: 32px;
            padding: 24px 20px 60px;
        }
    }

    /* ── Galeri Foto ── */
    .woocommerce-product-gallery {
        grid-column: 1;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(232,89,12,0.1);
        border: 1px solid var(--orange-mid);
        background: var(--white);
        position: sticky;
        top: 100px;
    }
    .woocommerce-product-gallery .woocommerce-product-gallery__image img {
        width: 100%;
        height: 480px;
        object-fit: cover;
        display: block;
    }
    /* Thumbnail strip */
    .flex-control-thumbs {
        display: flex;
        gap: 8px;
        padding: 12px;
        background: var(--cream);
        list-style: none;
        margin: 0;
    }
    .flex-control-thumbs li { flex: 1; }
    .flex-control-thumbs img {
        border-radius: 10px;
        cursor: pointer;
        height: 72px !important;
        object-fit: cover;
        opacity: .65;
        transition: opacity .2s, transform .2s;
        border: 2px solid transparent;
    }
    .flex-control-thumbs img:hover,
    .flex-control-thumbs .flex-active { opacity: 1 !important; border-color: var(--orange) !important; }

    /* ── Kolom kanan: info produk ── */
    .woocommerce div.product .entry-summary {
        grid-column: 2;
        display: flex;
        flex-direction: column;
        gap: 0;
    }
    @media (max-width: 900px) {
        .woocommerce div.product .entry-summary { grid-column: 1; }
    }

    /* Kategori badge di atas judul */
    .posted_in {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .72rem;
        font-weight: 600;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--orange);
        background: var(--orange-bg);
        padding: 5px 14px;
        border-radius: 100px;
        margin-bottom: 16px;
        width: fit-content;
    }
    .posted_in a { color: var(--orange) !important; text-decoration: none; }

    /* ── Judul produk ── */
    h1.product_title.entry-title {
        font-family: var(--font-head) !important;
        font-size: clamp(2rem, 3.5vw, 2.8rem) !important;
        font-weight: 700 !important;
        color: var(--ink) !important;
        line-height: 1.1 !important;
        letter-spacing: -.03em !important;
        margin: 0 0 8px !important;
    }

    /* ── Rating bintang ── */
    .woocommerce-product-rating {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }
    .star-rating { color: #f59e0b; font-size: .95rem; }
    .woocommerce-review-link {
        font-size: .8rem;
        color: var(--ink-soft);
        text-decoration: none;
    }
    .woocommerce-review-link:hover { color: var(--orange); }

    /* ── Harga ── */
    p.price, .woocommerce-Price-amount {
        font-family: var(--font-body) !important;
        font-size: 2rem !important;
        font-weight: 700 !important;
        color: var(--orange) !important;
        margin: 0 0 24px !important;
        line-height: 1 !important;
    }
    p.price del { color: var(--ink-soft) !important; font-size: 1.2rem !important; opacity: .6; }
    p.price ins { text-decoration: none !important; }

    /* ── Deskripsi singkat ── */
    .woocommerce-product-details__short-description {
        color: var(--ink-soft);
        font-size: .95rem;
        line-height: 1.8;
        margin-bottom: 28px;
        padding-bottom: 28px;
        border-bottom: 1px solid var(--warm-gray);
    }

    /* ── Info cepat (ikon) ── */
    .vs-product-quick-info {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-bottom: 28px;
    }
    .vs-quick-item {
        background: var(--orange-bg);
        border-radius: 14px;
        padding: 14px;
        text-align: center;
    }
    .vs-quick-item i {
        color: var(--orange);
        font-size: 1.1rem;
        margin-bottom: 6px;
        display: block;
    }
    .vs-quick-item span {
        font-size: .75rem;
        color: var(--ink-soft);
        font-weight: 500;
        display: block;
        line-height: 1.4;
    }

    /* ── Form qty + tombol ── */
    form.cart {
        display: flex;
        gap: 12px;
        align-items: center;
        margin-bottom: 20px;
    }
    .quantity {
        display: flex;
        align-items: center;
        border: 1.5px solid var(--warm-gray);
        border-radius: 100px;
        overflow: hidden;
        background: var(--white);
    }
    .quantity input.qty {
        width: 52px;
        padding: 12px 8px;
        border: none;
        text-align: center;
        font-family: var(--font-body);
        font-size: 1rem;
        font-weight: 600;
        color: var(--ink);
        background: transparent;
        outline: none;
        -moz-appearance: textfield;
    }
    .quantity input.qty::-webkit-outer-spin-button,
    .quantity input.qty::-webkit-inner-spin-button { -webkit-appearance: none; }

    button.single_add_to_cart_button.button.alt {
        flex: 1;
        background: var(--ink) !important;
        color: #fff !important;
        border: none !important;
        padding: 14px 32px !important;
        border-radius: 100px !important;
        font-family: var(--font-body) !important;
        font-size: .9375rem !important;
        font-weight: 600 !important;
        letter-spacing: .01em !important;
        cursor: pointer !important;
        transition: all .25s !important;
        box-shadow: 0 4px 16px rgba(26,18,8,0.15) !important;
        text-transform: none !important;
    }
    button.single_add_to_cart_button.button.alt:hover {
        background: var(--orange) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 24px rgba(232,89,12,0.3) !important;
    }

    /* WhatsApp quick order */
    .vs-wa-order {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        background: #25d366;
        color: #fff;
        padding: 13px 24px;
        border-radius: 100px;
        font-size: .875rem;
        font-weight: 600;
        text-decoration: none;
        transition: all .25s;
        box-shadow: 0 4px 16px rgba(37,211,102,0.25);
        margin-bottom: 24px;
    }
    .vs-wa-order:hover { background: #1ebe5d; transform: translateY(-1px); }

    /* ── Meta (SKU, Kategori) ── */
    .product_meta {
        font-size: .82rem;
        color: var(--ink-soft);
        border-top: 1px solid var(--warm-gray);
        padding-top: 18px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .product_meta a { color: var(--orange); text-decoration: none; }
    .product_meta a:hover { text-decoration: underline; }

    /* ── Tabs deskripsi lengkap ── */
    .woocommerce-tabs.wc-tabs-wrapper {
        grid-column: 1 / -1;
        margin-top: 60px;
        border-top: 1px solid var(--warm-gray);
        padding-top: 48px;
    }
    .woocommerce-tabs ul.tabs {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 4px;
        border-bottom: 2px solid var(--warm-gray);
        margin-bottom: 32px;
    }
    .woocommerce-tabs ul.tabs li {
        position: relative;
    }
    .woocommerce-tabs ul.tabs li a {
        display: block;
        text-decoration: none;
        font-weight: 600;
        font-size: .875rem;
        color: var(--ink-soft);
        padding: 10px 20px;
        transition: color .2s;
    }
    .woocommerce-tabs ul.tabs li a:hover { color: var(--orange); }
    .woocommerce-tabs ul.tabs li.active a { color: var(--ink); }
    .woocommerce-tabs ul.tabs li.active::after {
        content: '';
        position: absolute;
        bottom: -2px; left: 0; right: 0;
        height: 2px;
        background: var(--orange);
        border-radius: 2px;
    }
    .woocommerce-Tabs-panel {
        color: var(--ink-soft);
        font-size: .95rem;
        line-height: 1.8;
        max-width: 720px;
    }
    .woocommerce-Tabs-panel h2 {
        font-family: var(--font-head);
        font-size: 1.5rem;
        color: var(--ink);
        margin-bottom: 16px;
        letter-spacing: -.02em;
    }

    /* ── Related Products ── */
    .related.products {
        grid-column: 1 / -1;
        margin-top: 60px;
    }
    .related.products h2 {
        font-family: var(--font-head);
        font-size: 1.8rem;
        color: var(--ink);
        letter-spacing: -.03em;
        margin-bottom: 32px;
    }
    .related.products ul.products {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        list-style: none;
        padding: 0;
    }
    @media (max-width: 640px) {
        .related.products ul.products { grid-template-columns: 1fr 1fr; }
    }
    .related.products ul.products li.product {
        background: var(--white);
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid var(--warm-gray);
        transition: transform .3s, box-shadow .3s;
    }
    .related.products ul.products li.product:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(232,89,12,0.1);
    }
    .related.products ul.products li.product img {
        width: 100%; height: 180px; object-fit: cover; display: block;
    }
    .related.products ul.products li.product .woocommerce-loop-product__title {
        font-family: var(--font-head);
        font-size: 1rem;
        color: var(--ink);
        padding: 14px 16px 4px;
        letter-spacing: -.01em;
    }
    .related.products ul.products li.product .price {
        padding: 0 16px;
        font-size: 1rem;
        font-weight: 700;
        color: var(--orange) !important;
    }
    .related.products ul.products li.product .button {
        display: block;
        margin: 12px 16px 16px;
        background: var(--ink);
        color: #fff;
        text-align: center;
        padding: 10px;
        border-radius: 100px;
        text-decoration: none;
        font-size: .8rem;
        font-weight: 600;
        transition: background .25s;
    }
    .related.products ul.products li.product .button:hover { background: var(--orange); }

    /* ── Notif add to cart ── */
    .woocommerce-message {
        background: var(--orange-bg);
        border-top: 3px solid var(--orange);
        color: var(--ink);
        border-radius: 0 0 12px 12px;
        padding: 14px 20px;
        font-size: .9rem;
    }
    .woocommerce-message .button {
        background: var(--orange);
        color: #fff;
        padding: 8px 18px;
        border-radius: 100px;
        text-decoration: none;
        font-size: .8rem;
        font-weight: 600;
    }
    </style>

    <?php
    // Inject info cepat + tombol WA setelah harga via JS (non-invasive)
    $phone = '628123456789';
    $product_name = get_the_title();
    $wa_msg = urlencode("Halo Vacasky! Saya tertarik dengan paket: $product_name. Bisa info lebih lanjut?");
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quick info bar
        var summary = document.querySelector('.entry-summary');
        var shortDesc = document.querySelector('.woocommerce-product-details__short-description');
        if (summary && shortDesc) {
            var quickInfo = document.createElement('div');
            quickInfo.className = 'vs-product-quick-info';
            quickInfo.innerHTML = `
                <div class="vs-quick-item"><i class="fas fa-route"></i><span>Rute Termasuk</span></div>
                <div class="vs-quick-item"><i class="fas fa-user-shield"></i><span>Guide Pro</span></div>
                <div class="vs-quick-item"><i class="fas fa-bicycle"></i><span>Sepeda Premium</span></div>
            `;
            shortDesc.after(quickInfo);
        }

        // Tombol WhatsApp
        var cartForm = document.querySelector('form.cart');
        if (cartForm) {
            var waBtn = document.createElement('a');
            waBtn.href = 'https://wa.me/<?php echo $phone; ?>?text=<?php echo $wa_msg; ?>';
            waBtn.target = '_blank';
            waBtn.className = 'vs-wa-order';
            waBtn.innerHTML = '<i class="fab fa-whatsapp" style="font-size:1.1rem;"></i> Tanya via WhatsApp';
            cartForm.after(waBtn);
        }
    });
    </script>

    <?php endif; ?>

    <?php
}
add_action( 'wp_head', 'vacasky_load_assets' );