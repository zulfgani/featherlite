<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package FeatherLite
 *
 */
function featherlite_homepage_widgets_register() {
	
	$pages = get_pages( array( 'post_status' =>  array('publish', 'pending', 'private', 'draft') ) );

	foreach ( $pages as $page ) {

		$page_template = get_page_template_slug($page->ID);

		if ( $page_template == 'templates/homepage.php' ) {
			if( ! is_admin() || is_customize_preview() ) {
				register_sidebar( array(
					'name'          => esc_html__( 'Homepage Top Primary', 'featherlite' ),
					'id'            => 'homepage-top-primary',
					'description'   => esc_html__( 'Full width Homepage above the fold widget area.', 'featherlite' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="widget-title"><h3>',
					'after_title'   => '</h3></div>',
				) );
				
				register_sidebar( array(
					'name'          => esc_html__( 'Homepage Top Secondary', 'featherlite' ),
					'id'            => 'homepage-top-secondary',
					'description'   => esc_html__( 'Full width Homepage above the fold widget area.', 'featherlite' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="widget-title"><h3>',
					'after_title'   => '</h3></div>',
				) );
				
				register_sidebar( array(
					'name'          => esc_html__( 'Homepage Bottom Primary', 'featherlite' ),
					'id'            => 'homepage-bottom-primary',
					'description'   => esc_html__( 'Full width Homepage below the fold widget area.', 'featherlite' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="widget-title"><h3>',
					'after_title'   => '</h3></div>',
				) );
				
				register_sidebar( array(
					'name'          => esc_html__( 'Homepage Bottom Secondary', 'featherlite' ),
					'id'            => 'homepage-bottom-secondary',
					'description'   => esc_html__( 'Full width Homepage below the fold widget area.', 'featherlite' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="widget-title"><h3>',
					'after_title'   => '</h3></div>',
				) );

			}
		}

	}// End Foreach
	
}
add_action( 'widgets_init', 'featherlite_homepage_widgets_register' );

if ( ! function_exists( 'featherlite_homepage_top_primary' ) ) {
	function featherlite_homepage_top_primary() {
		if ( is_active_sidebar( 'homepage-top-primary' ) ) {
			do_action( 'featherlite_designer_htp_area_top_location' );
			echo '<aside id="atf-widgets" class="atf-widgets-area">';
				
				dynamic_sidebar( 'homepage-top-primary' );
				
			echo '</aside>';
			do_action( 'featherlite_designer_htp_area_bottom_location' );
		}
	}	
}
add_action( 'featherlite_homepage', 'featherlite_homepage_top_primary', 10 );

if ( ! function_exists( 'featherlite_homepage_top_secondary' ) ) {
	function featherlite_homepage_top_secondary() {
		if ( is_active_sidebar( 'homepage-top-secondary' ) ) {
			do_action( 'featherlite_designer_hts_area_top_location' );
			echo '<aside id="atf-widgets" class="atf-widgets-area">';
				
				dynamic_sidebar( 'homepage-top-secondary' );
				
			echo '</aside>';
			do_action( 'featherlite_designer_hts_area_bottom_location' );
		}
	}	
}
add_action( 'featherlite_homepage', 'featherlite_homepage_top_secondary', 20 );

function featherlite_homepage_content_render() {
	do_action( 'featherlite_homepage_before' );
	while ( have_posts() ) : the_post();
		do_action( 'featherlite_homepage_open' );
			if ( is_home() ) {
				the_content();
			} else {
				featherlite_homepage_builder_content();
			}
		do_action( 'featherlite_homepage_close' );
	endwhile; // End of the loop.
	do_action( 'featherlite_homepage_after' );
}
add_action( 'featherlite_homepage', 'featherlite_homepage_content_render', 50 );

function featherlite_homepage_open() {
	echo '<div id="primary" class="content-area">';
		echo '<main id="main" class="site-main">';
}
add_action( 'featherlite_homepage_before', 'featherlite_homepage_open', 10 );

function featherlite_homepage_close() {
		echo '</main><!-- #main -->';
	echo '</div><!-- #primary -->';
}
add_action( 'featherlite_homepage_after', 'featherlite_homepage_close', 10 );

function featherlite_homepage_content_open() { ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
}
add_action( 'featherlite_homepage_open', 'featherlite_homepage_content_open', 10 );

function featherlite_homepage_content_close() {
	echo '</article><!-- #post-## -->';
}
add_action( 'featherlite_homepage_close', 'featherlite_homepage_content_close', 10 );

if ( ! function_exists( 'featherlite_homepage_bottom_primary' ) ) {
	function featherlite_homepage_bottom_primary() {
		if ( is_active_sidebar( 'homepage-bottom-primary' ) ) {
			do_action( 'featherlite_designer_hbp_area_top_location' );
			
			echo '<aside id="btf-widgets" class="btf-widgets-area">';				
				dynamic_sidebar( 'homepage-bottom-primary' );
			echo '</aside>';
			
			do_action( 'featherlite_designer_hbp_area_bottom_location' );
		}
	}	
}
add_action( 'featherlite_homepage', 'featherlite_homepage_bottom_primary', 60 );

if ( ! function_exists( 'featherlite_homepage_bottom_secondary' ) ) {
	function featherlite_homepage_bottom_secondary() {
		if ( is_active_sidebar( 'homepage-bottom-secondary' ) ) {
			do_action( 'featherlite_designer_hbs_area_top_location' );
			
			echo '<aside id="btf-widgets" class="btf-widgets-area">';				
				dynamic_sidebar( 'homepage-bottom-secondary' );
			echo '</aside>';
			
			do_action( 'featherlite_designer_hbs_area_bottom_location' );
		}
	}	
}
add_action( 'featherlite_homepage', 'featherlite_homepage_bottom_secondary', 70 );

/**
 * Print `the_content` without the `wpautop` filter. Designed to be used
 * to print the content from the `content-layout-control` lib.
 *
 * @since 0.1
 */
function featherlite_homepage_builder_content() {
	remove_filter( 'the_content', 'wpautop' );
		the_content();
	add_filter( 'the_content', 'wpautop' );
}

function featherlite_homepage_customize_register( $wp_customize ) {
	
	$featherlite_hps = (object) $wp_customize->get_section( 'static_front_page' );
	$featherlite_hps->panel = 'featherlite_homepage_panel';
	$featherlite_hps->priority = 1;
	
	$featherlite_htp_pri = (object) $wp_customize->get_section( 'sidebar-widgets-homepage-top-primary' );
	$featherlite_htp_pri->panel = 'featherlite_homepage_panel';
	$featherlite_htp_pri->priority = 10;
	$featherlite_htp_pri->description = __( 'Add widget(s) to the homepage top primary area', 'featherlite' );
	
	$featherlite_hts_sec = (object) $wp_customize->get_section( 'sidebar-widgets-homepage-top-secondary' );
	$featherlite_hts_sec->panel = 'featherlite_homepage_panel';
	$featherlite_hts_sec->priority = 20;
	$featherlite_hts_sec->description = __( 'Add widget(s) to the homepage top secondary area', 'featherlite' );
	
	$featherlite_hbp_pri = (object) $wp_customize->get_section( 'sidebar-widgets-homepage-bottom-primary' );
	$featherlite_hbp_pri->panel = 'featherlite_homepage_panel';
	$featherlite_hbp_pri->priority = 30;
	$featherlite_hbp_pri->description = __( 'Add widget(s) to the homepage bottom primary area', 'featherlite' );
	
	$featherlite_hbs_sec = (object) $wp_customize->get_section( 'sidebar-widgets-homepage-bottom-secondary' );
	$featherlite_hbs_sec->panel = 'featherlite_homepage_panel';
	$featherlite_hbs_sec->priority = 40;
	$featherlite_hbs_sec->description = __( 'Add widget(s) to the homepage bottom secondary area', 'featherlite' );
	
}
add_action( 'customize_register', 'featherlite_homepage_customize_register' );