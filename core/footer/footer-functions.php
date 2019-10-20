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
function featherlite_footer_widgets_register() {
	if( ! is_admin() || is_customize_preview() ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widgets Area', 'featherlite' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'Self adjusting widget area ~ upto 4 widgets per row.', 'featherlite' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );
	}
}
add_action( 'widgets_init', 'featherlite_footer_widgets_register' );

if ( ! function_exists( 'featherlite_footer_widgets' ) ) {
	function featherlite_footer_widgets() {
		if ( is_active_sidebar( 'sidebar-footer' ) ) {
			do_action( 'featherlite_designer_footer_area_top_location' );
			echo '<aside id="footer-widgets" class="footer-widgets-area" role="complementary">';
				
				dynamic_sidebar( 'sidebar-footer' );
				
			echo '</aside>';
			do_action( 'featherlite_designer_footer_area_bottom_location' );
		}
	}	
}
add_action( 'featherlite_footer', 'featherlite_footer_widgets', 10 );

function featherlite_footer_content() { ?>
	<footer id="colophon" class="site-footer">
		<div class="main-footer">
			<div class="site-info">
				<?php 
				$copyrightText = get_theme_mod( 'featherlite_theme_options_copyright', 'Copyright &copy; ' .date('Y'). ' ' . get_bloginfo( 'name' ) );
				$copyrightRender = apply_filters( 'featherlite_footer_copyright_text', $copyrightText );
				echo wp_kses( $copyrightRender, featherlite_allowed_html() );				
				?>
				<span class="sep"> | </span>
				<?php
				/* translators: 1: theme name, 2: theme developer */
				printf( esc_html__( 'ClassicPress Theme: %1$s by %2$s.', 'featherlite' ), '<a href="https://github.com/zulfgani/featherlite/" target="_blank" rel="nofollow noopener" title="FeatherLite">FeatherLite</a>', 'GetFeatherLite' );
				?>
			</div><!-- .site-info -->
		</div><!-- .main_footer -->
	</footer><!-- #colophon -->
<?php
}
add_action( 'featherlite_footer', 'featherlite_footer_content', 20 );

function featherlite_back_to_top() {
	echo '<a href="#top" id="toTop">&uarr;</a>';
}
add_action( 'featherlite_site_end', 'featherlite_back_to_top', 10 );

function featherlite_footer_customize_register( $wp_customize ) {
		
	/**
	 * Add the panel
	 */
	$wp_customize->add_panel( 'featherlite_footer_panel', array(
		'priority'       	=> 200,
		'capability'     	=> 'edit_theme_options',
		'theme_supports' 	=> '',
		'title'				=> __( 'FeatherLite Footer Options', 'featherlite' ),
		'description'    	=> __( 'Customize the appearance and content of the footer area of your site.', 'featherlite' ),
	) );
	
	$featherlite_footer_area = (object) $wp_customize->get_section( 'sidebar-widgets-sidebar-footer' );
	$featherlite_footer_area->panel = 'featherlite_footer_panel';
	$featherlite_footer_area->priority = '100';
	$featherlite_footer_area->description = __( 'A self adjusting widget area for upto 4 widgets per row.', 'featherlite' );
	
}
add_action( 'customize_register', 'featherlite_footer_customize_register' );