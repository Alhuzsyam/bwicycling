<?php
/**
 * Customizer
 * 
 * @package WordPress
 * @subpackage day-camp
 * @since day-camp 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function day_camp_customize_register( $wp_customize ) {
	$wp_customize->add_section( new Day_Camp_Upsell_Section($wp_customize,'upsell_section',array(
		'title'            => __( 'Day Camp Pro', 'day-camp' ),
		'button_text'      => __( 'Upgrade Pro', 'day-camp' ),
		'url'              => 'https://www.wpradiant.net/products/summer-camp-wordpress-theme',
		'priority'         => 0,
	)));
}
add_action( 'customize_register', 'day_camp_customize_register' );

/**
 * Enqueue script for custom customize control.
 */
function day_camp_custom_control_scripts() {
	wp_enqueue_script( 'day-camp-custom-controls-js', get_template_directory_uri() . '/assets/js/custom-controls.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0', true );
	wp_enqueue_style( 'day-camp-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'day_camp_custom_control_scripts' );
