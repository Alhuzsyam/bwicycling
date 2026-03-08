<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package WordPress
 * @subpackage day-camp
 * @since day-camp 1.0
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 *
	 * @since day-camp 1.0
	 *
	 * @return void
	 */
	function day_camp_register_block_styles() {
		

		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'day-camp-border',
				'label' => esc_html__( 'Borders', 'day-camp' ),
			)
		);

		
	}
	add_action( 'init', 'day_camp_register_block_styles' );
}