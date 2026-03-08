<?php
/**
 * Day Camp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package day-camp
 * @since day-camp 1.0
 */

if ( ! function_exists( 'day_camp_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since day-camp 1.0
	 *
	 * @return void
	 */
	function day_camp_support() {

		load_theme_textdomain( 'day-camp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'align-wide' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

		add_theme_support( 'responsive-embeds' );
		
		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );
	}

endif;

add_action( 'after_setup_theme', 'day_camp_support' );

if ( ! function_exists( 'day_camp_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since day-camp 1.0
	 *
	 * @return void
	 */
	function day_camp_styles() {

		// Register theme stylesheet.
		wp_register_style(
			'day-camp-style',
			get_template_directory_uri() . '/style.css',
			array(),
			wp_get_theme()->get( 'Version' )
		);

		wp_enqueue_style(
			'animate',
			esc_url(get_template_directory_uri()).'/assets/css/animate.css' 
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'day-camp-style' );

		wp_style_add_data( 'day-camp-style', 'rtl', 'replace' );

		wp_enqueue_style( 'dashicons' );

		//font-awesome
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/inc/fontawesome/css/all.css', array(), '6.7.0' );

		wp_enqueue_style('owl-carousel-css',
		esc_url(get_template_directory_uri()) . '/assets/css/owl.carousel.css',
		array()
		);

		wp_enqueue_style('swiper-css',
		esc_url(get_template_directory_uri()) . '/assets/css/swiper-bundle.css',
		array()
		);
		
	}

endif;

add_action( 'wp_enqueue_scripts', 'day_camp_styles' );

/* Enqueue Custom Js */
function day_camp_scripts() {

	wp_enqueue_script( 
		'wow', esc_url(get_template_directory_uri()) . '/assets/js/wow.js', 
		array('jquery') 
	);

	wp_enqueue_script(
		'day-camp-custom', esc_url(get_template_directory_uri()) . '/assets/js/custom.js',
		array('jquery')
	);

	wp_enqueue_script(
        'scroll-to-top',
        esc_url(get_template_directory_uri()) . '/assets/js/scroll-to-top.js',
        array(), 
        null, 
        true // Load in footer
    );

	wp_enqueue_script(
		'swiper-js',
		esc_url(get_template_directory_uri()) . '/assets/js/swiper-bundle.js',
		array(),
		true
	);

	wp_enqueue_script(
		'owl-carousel-js',
		esc_url(get_template_directory_uri()) . '/assets/js/owl.carousel.js',
		array(),
		true
	);

}
add_action( 'wp_enqueue_scripts', 'day_camp_scripts' );

/* Enqueue admin-notice-script js */
add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook !== 'appearance_page_day-camp') return;

    wp_enqueue_script('admin-notice-script', get_template_directory_uri() . '/get-started/js/admin-notice-script.js', ['jquery'], null, true);
    wp_localize_script('admin-notice-script', 'pluginInstallerData', [
        'ajaxurl'     => admin_url('admin-ajax.php'),
        'nonce'       => wp_create_nonce('install_plugin_nonce'), // Match this with PHP nonce check
        'redirectUrl' => admin_url('themes.php?page=day-camp'),
    ]);
});

add_action('wp_ajax_check_plugin_activation', function () {
    if (!isset($_POST['plugin']) || empty($_POST['plugin'])) {
        wp_send_json_error(['message' => 'Missing plugin identifier']);
    }

    include_once ABSPATH . 'wp-admin/includes/plugin.php';

    // Map plugin identifiers to their main files
    $day_camp_plugin_map = [
        'woocommerce'          => 'woocommerce/woocommerce.php',
        'wordclever_ai_content_writer'    => 'wordclever-ai-content-writer/wordclever.php',  
    ];

    $day_camp_requested_plugin = sanitize_text_field($_POST['plugin']);

    if (!isset($day_camp_plugin_map[$day_camp_requested_plugin])) {
        wp_send_json_error(['message' => 'Invalid plugin']);
    }

    $day_camp_plugin_file = $day_camp_plugin_map[$day_camp_requested_plugin];
    $day_camp_is_active   = is_plugin_active($day_camp_plugin_file);

    wp_send_json_success(['active' => $day_camp_is_active]);
});

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );


function day_camp_theme_setting() {
	
// Add block patterns
require get_template_directory() . '/inc/block-pattern.php';

// Add block Style
require get_template_directory() . '/inc/block-style.php';

// TGM
require get_template_directory() . '/inc/tgm/plugin-activation.php';

// Get Started
require get_template_directory() . '/get-started/getstart.php';

// Get Notice
require get_template_directory() . '/get-started/notice.php';

// Get Notice
require get_template_directory() . '/inc/customizer.php';


}
add_action('after_setup_theme', 'day_camp_theme_setting');