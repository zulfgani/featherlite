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
function featherlite_fullwidth_widgets_register() {
	
	$pages = get_pages( array( 'post_status' =>  array('publish', 'pending', 'private', 'draft') ) );

	foreach ( $pages as $page ) {

		$page_template = get_page_template_slug($page->ID);

		if ( $page_template == 'templates/fullwidth.php' ) {
			if( ! is_admin() || is_customize_preview() ) {
				register_sidebar( array(
					'name'          => esc_html__( 'Fullwidth Top Primary', 'featherlite' ),
					'id'            => 'fullwidth-top-primary',
					'description'   => esc_html__( 'Full width Fullwidth above the fold widget area.', 'featherlite' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="widget-title"><h3>',
					'after_title'   => '</h3></div>',
					'container_selector' => '#widget-area',
				) );
				
				register_sidebar( array(
					'name'          => esc_html__( 'Fullwidth Top Secondary', 'featherlite' ),
					'id'            => 'fullwidth-top-secondary',
					'description'   => esc_html__( 'Full width Fullwidth above the fold widget area.', 'featherlite' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="widget-title"><h3>',
					'after_title'   => '</h3></div>',
					'container_selector' => '#widget-area',
				) );
				
				register_sidebar( array(
					'name'          => esc_html__( 'Fullwidth Bottom Primary', 'featherlite' ),
					'id'            => 'fullwidth-bottom-primary',
					'description'   => esc_html__( 'Full width Fullwidth below the fold widget area.', 'featherlite' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="widget-title"><h3>',
					'after_title'   => '</h3></div>',
					'container_selector' => '#widget-area',
				) );
				
				register_sidebar( array(
					'name'          => esc_html__( 'Fullwidth Bottom Secondary', 'featherlite' ),
					'id'            => 'fullwidth-bottom-secondary',
					'description'   => esc_html__( 'Full width Fullwidth below the fold widget area.', 'featherlite' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="widget-title"><h3>',
					'after_title'   => '</h3></div>',
					'container_selector' => '#widget-area',
				) );

			}
		}

	}// End Foreach
	
}
add_action( 'widgets_init', 'featherlite_fullwidth_widgets_register' );

if ( ! function_exists( 'featherlite_fullwidth_top_primary' ) ) {
	function featherlite_fullwidth_top_primary() {
		if ( is_active_sidebar( 'fullwidth-top-primary' ) ) {
			do_action( 'featherlite_designer_htp_area_top_location' );
			echo '<aside id="atf-widgets" class="atf-widgets-area">';
				
				dynamic_sidebar( 'fullwidth-top-primary' );
				
			echo '</aside>';
			do_action( 'featherlite_designer_htp_area_bottom_location' );
		}
	}	
}
add_action( 'featherlite_fullwidth', 'featherlite_fullwidth_top_primary', 10 );

if ( ! function_exists( 'featherlite_fullwidth_top_secondary' ) ) {
	function featherlite_fullwidth_top_secondary() {
		if ( is_active_sidebar( 'fullwidth-top-secondary' ) ) {
			do_action( 'featherlite_designer_hts_area_top_location' );
			echo '<aside id="atf-widgets" class="atf-widgets-area">';
				
				dynamic_sidebar( 'fullwidth-top-secondary' );
				
			echo '</aside>';
			do_action( 'featherlite_designer_hts_area_bottom_location' );
		}
	}	
}
add_action( 'featherlite_fullwidth', 'featherlite_fullwidth_top_secondary', 20 );

function featherlite_fullwidth_content_render() {
	do_action( 'featherlite_fullwidth_before' );
	while ( have_posts() ) : the_post();
		do_action( 'featherlite_fullwidth_open' );
			featherlite_fullwidth_builder_content();
		do_action( 'featherlite_fullwidth_close' );
	endwhile; // End of the loop.
	do_action( 'featherlite_fullwidth_after' );
}
add_action( 'featherlite_fullwidth', 'featherlite_fullwidth_content_render', 50 );

function featherlite_fullwidth_open() {
	echo '<div id="primary" class="content-area">';
		echo '<main id="main" class="site-main">';
}
add_action( 'featherlite_fullwidth_before', 'featherlite_fullwidth_open', 10 );

function featherlite_fullwidth_close() {
		echo '</main><!-- #main -->';
	echo '</div><!-- #primary -->';
}
add_action( 'featherlite_fullwidth_after', 'featherlite_fullwidth_close', 10 );

function featherlite_fullwidth_content_open() { ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
}
add_action( 'featherlite_fullwidth_open', 'featherlite_fullwidth_content_open', 10 );

function featherlite_fullwidth_content_close() {
	echo '</article><!-- #post-## -->';
}
add_action( 'featherlite_fullwidth_close', 'featherlite_fullwidth_content_close', 10 );

if ( ! function_exists( 'featherlite_fullwidth_bottom_primary' ) ) {
	function featherlite_fullwidth_bottom_primary() {
		if ( is_active_sidebar( 'fullwidth-bottom-primary' ) ) {
			do_action( 'featherlite_designer_hbp_area_top_location' );
			
			echo '<aside id="btf-widgets" class="btf-widgets-area">';				
				dynamic_sidebar( 'fullwidth-bottom-primary' );
			echo '</aside>';
			
			do_action( 'featherlite_designer_hbp_area_bottom_location' );
		}
	}	
}
add_action( 'featherlite_fullwidth', 'featherlite_fullwidth_bottom_primary', 60 );

if ( ! function_exists( 'featherlite_fullwidth_bottom_secondary' ) ) {
	function featherlite_fullwidth_bottom_secondary() {
		if ( is_active_sidebar( 'fullwidth-bottom-secondary' ) ) {
			do_action( 'featherlite_designer_hbs_area_top_location' );
			
			echo '<aside id="btf-widgets" class="btf-widgets-area">';				
				dynamic_sidebar( 'fullwidth-bottom-secondary' );
			echo '</aside>';
			
			do_action( 'featherlite_designer_hbs_area_bottom_location' );
		}
	}	
}
add_action( 'featherlite_fullwidth', 'featherlite_fullwidth_bottom_secondary', 70 );

/**
 * Print `the_content` without the `wpautop` filter. Designed to be used
 * to print the content from pagebuilders.
 *
 * @since 0.1
 */
function featherlite_fullwidth_builder_content() {
	remove_filter( 'the_content', 'wpautop' );
		the_content();
	add_filter( 'the_content', 'wpautop' );
}

function featherlite_fullwidth_customize_register( $wp_customize ) {
	
	$featherlite_hps = (object) $wp_customize->get_section( 'static_front_page' );
	$featherlite_hps->panel = 'featherlite_fullwidth_panel';
	$featherlite_hps->priority = 1;
	
	$featherlite_htp_pri = (object) $wp_customize->get_section( 'sidebar-widgets-fullwidth-top-primary' );
	$featherlite_htp_pri->panel = 'featherlite_fullwidth_panel';
	$featherlite_htp_pri->priority = 10;
	$featherlite_htp_pri->description = __( 'Add widget(s) to the fullwidth top primary area', 'featherlite' );
	
	$featherlite_hts_sec = (object) $wp_customize->get_section( 'sidebar-widgets-fullwidth-top-secondary' );
	$featherlite_hts_sec->panel = 'featherlite_fullwidth_panel';
	$featherlite_hts_sec->priority = 20;
	$featherlite_hts_sec->description = __( 'Add widget(s) to the fullwidth top secondary area', 'featherlite' );
	
	$featherlite_hbp_pri = (object) $wp_customize->get_section( 'sidebar-widgets-fullwidth-bottom-primary' );
	$featherlite_hbp_pri->panel = 'featherlite_fullwidth_panel';
	$featherlite_hbp_pri->priority = 30;
	$featherlite_hbp_pri->description = __( 'Add widget(s) to the fullwidth bottom primary area', 'featherlite' );
	
	$featherlite_hbs_sec = (object) $wp_customize->get_section( 'sidebar-widgets-fullwidth-bottom-secondary' );
	$featherlite_hbs_sec->panel = 'featherlite_fullwidth_panel';
	$featherlite_hbs_sec->priority = 40;
	$featherlite_hbs_sec->description = __( 'Add widget(s) to the fullwidth bottom secondary area', 'featherlite' );
	
}
add_action( 'customize_register', 'featherlite_fullwidth_customize_register' );