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
    $content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
    /**
     * Set up theme support.
     *
     * @return void
     */
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
            add_theme_support(
                'html5',
                [
                    'search-form',
                    'comment-form',
                    'comment-list',
                    'gallery',
                    'caption',
                    'script',
                    'style',
                    'navigation-widgets',
                ]
            );
            add_theme_support(
                'custom-logo',
                [
                    'height'      => 100,
                    'width'       => 350,
                    'flex-height' => true,
                    'flex-width'  => true,
                ]
            );
            add_theme_support( 'align-wide' );
            add_theme_support( 'responsive-embeds' );

            /*
             * Editor Styles
             */
            add_theme_support( 'editor-styles' );
            add_editor_style( 'assets/css/editor-styles.css' );

            /*
             * WooCommerce.
             */
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
        $hello_elementor_header_footer = true;
        return apply_filters( 'hello_elementor_header_footer', $hello_elementor_header_footer );
    }
}

if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
    function hello_elementor_scripts_styles() {
        if ( apply_filters( 'hello_elementor_enqueue_style', true ) ) {
            wp_enqueue_style(
                'hello-elementor',
                HELLO_THEME_STYLE_URL . 'reset.css',
                [],
                HELLO_ELEMENTOR_VERSION
            );
        }

        if ( apply_filters( 'hello_elementor_enqueue_theme_style', true ) ) {
            wp_enqueue_style(
                'hello-elementor-theme-style',
                HELLO_THEME_STYLE_URL . 'theme.css',
                [],
                HELLO_ELEMENTOR_VERSION
            );
        }

        if ( hello_elementor_display_header_footer() ) {
            wp_enqueue_style(
                'hello-elementor-header-footer',
                HELLO_THEME_STYLE_URL . 'header-footer.css',
                [],
                HELLO_ELEMENTOR_VERSION
            );
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
        if ( ! apply_filters( 'hello_elementor_description_meta_tag', true ) ) {
            return;
        }
        if ( ! is_singular() ) {
            return;
        }
        $post = get_queried_object();
        if ( empty( $post->post_excerpt ) ) {
            return;
        }
        echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $post->post_excerpt ) ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'hello_elementor_add_description_meta_tag' );

// Settings page
require get_template_directory() . '/includes/settings-functions.php';
require get_template_directory() . '/includes/elementor-functions.php';

if ( ! function_exists( 'hello_elementor_customizer' ) ) {
    function hello_elementor_customizer() {
        if ( ! is_customize_preview() ) {
            return;
        }
        if ( ! hello_elementor_display_header_footer() ) {
            return;
        }
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


/* * =================================================================
 * TAMBAHAN KHUSUS: VACASKY STYLE (TAILWIND + PRODUCT PAGE FIX)
 * =================================================================
 */

// 1. Matikan Style Bawaan Hello Elementor (Agar tidak bentrok dengan Tailwind)
add_filter( 'hello_elementor_enqueue_style', '__return_false' );
add_filter( 'hello_elementor_enqueue_theme_style', '__return_false' );

// 2. Load Assets Vacasky (Tailwind, Fonts, Icons, DAN CSS PRODUK)
function vacasky_load_assets() {
    // A. Font Awesome
    wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css' );

    // B. Google Fonts: Oswald & Inter
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Oswald:wght@400;500;700&display=swap' );

    // Tutup PHP sebentar untuk menulis HTML/JS/CSS dengan aman
    ?>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                vacasky: {
                  blue: "#56B4E9",
                  dark: "#111111",
                  gray: "#666666",
                  light: "#F4F8FB"
                }
              },
              fontFamily: {
                sans: ["Inter", "sans-serif"],
                heading: ["Oswald", "sans-serif"]
              }
            }
          }
        }
    </script>

    <?php if ( function_exists('is_product') && is_product() ) : ?>
    <style>
        /* 1. Layout Container 2 Kolom */
        div.product {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 50px;
        }
        @media (min-width: 992px) {
            div.product {
                grid-template-columns: 1fr 1fr; /* Kiri Gambar, Kanan Teks */
                align-items: start;
            }
        }

        /* 2. Gambar Produk */
        .woocommerce-product-gallery {
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid #f3f4f6;
        }
        .woocommerce-product-gallery img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* 3. Judul & Harga */
        h1.product_title {
            font-family: 'Oswald', sans-serif !important;
            font-size: 2.5rem;
            text-transform: uppercase;
            color: #111;
            line-height: 1.1;
            margin-bottom: 10px;
        }
        p.price {
            font-family: 'Inter', sans-serif;
            font-size: 1.5rem;
            color: #56B4E9;
            font-weight: 700;
            margin-bottom: 20px;
        }

        /* 4. Deskripsi */
        .woocommerce-product-details__short-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        /* 5. Tombol Add to Cart */
        form.cart {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }
        .quantity input {
            width: 70px;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
        }
        button.single_add_to_cart_button {
            background-color: #111;
            color: #fff;
            border: none;
            padding: 14px 40px;
            border-radius: 8px;
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.3s;
            flex-grow: 1;
        }
        button.single_add_to_cart_button:hover {
            background-color: #56B4E9;
            transform: translateY(-2px);
        }

        /* 6. Tabs & Meta */
        .product_meta { font-size: 0.9rem; color: #888; border-top: 1px solid #eee; padding-top: 20px; }
        .woocommerce-tabs { grid-column: 1 / -1; margin-top: 50px; border-top: 1px solid #eee; padding-top: 30px; }
        .woocommerce-tabs ul.tabs { list-style: none; padding: 0; display: flex; gap: 20px; border-bottom: 2px solid #f3f4f6; margin-bottom: 20px; }
        .woocommerce-tabs ul.tabs li a { text-decoration: none; font-weight: bold; text-transform: uppercase; color: #999; }
        .woocommerce-tabs ul.tabs li.active a { color: #111; border-bottom: 2px solid #56B4E9; padding-bottom: 5px; }

        /* Hide Header Footer Bawaan di Halaman Produk */
        .site-header, .site-footer { display: none !important; }
    </style>
    <?php endif; ?>

    <?php
    // Buka PHP lagi untuk menutup fungsi
}
add_action( 'wp_head', 'vacasky_load_assets' );
?>