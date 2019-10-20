<?php
/**
 * FeatherLite Theme Customizer.
 *
 * @package FeatherLite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function featherlite_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'            => '.site-title a',
				'container_inclusive' => false,
				'render_callback'     => 'featherlite_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'            => '.site-description',
				'container_inclusive' => false,
				'render_callback'     => 'featherlite_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'featherlite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function featherlite_customize_preview_js() {
	wp_enqueue_script( 'featherlite-customizer-preview', get_template_directory_uri() . '/assets/js/featherlite-customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'featherlite_customize_preview_js' );

require get_template_directory() . '/inc/customizer-controls/customizer-controls.php';

function featherlite_customize_backend_scripts() {
    wp_enqueue_style( 'featherlite-customizer-style', get_template_directory_uri() . '/assets/css/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'featherlite_customize_backend_scripts', 10 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since FeatherLite 1.0.0
 * @see featherlite_customize_register()
 *
 * @return void
 */
function featherlite_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since FeatherLite 1.0.0
 * @see featherlite_customize_register()
 *
 * @return void
 */
function featherlite_customize_partial_blogdescription() {
	bloginfo( 'description' );
}