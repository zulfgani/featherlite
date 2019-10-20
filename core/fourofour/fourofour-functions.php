<?php

function featherlite_fourofour_header() { 
$featherlite_404_title = esc_html( 'Oops! The content you were looking for does not seem to exist on this site.', 'featherlite' ); 
?>
	<header class="page-header">
		<h1 class="page-title">
			<?php echo apply_filters( 'featherlite_404_title', $featherlite_404_title ); ?>
		</h1>
	</header><!-- .page-header -->
<?php
}
add_action( 'featherlite_fourofour_content', 'featherlite_fourofour_header', 10 );

function featherlite_fourofour_content_opener() {
	echo '<div class="page-content">';
}
add_action( 'featherlite_fourofour_content', 'featherlite_fourofour_content_opener',  15 );

function featherlite_fourofour_content_render() { 
$featherlite_404_content = esc_html( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'featherlite' );
?>
	<p>
		<?php echo apply_filters( 'featherlite_404_content', $featherlite_404_content ); ?>
	</p>
<?php
}
add_action( 'featherlite_fourofour_content', 'featherlite_fourofour_content_render', 20 );

function featherlite_fourofour_widgets_init() {
	if( ! is_admin() || is_customize_preview() ) {
		register_sidebar( 
			[
				'name'          => esc_html__( '404 Sidebar', 'featherlite' ),
				'id'            => 'featherlite-sidebar-404',
				'description'   => esc_html__( 'Replace the 404 widgets by adding custom/preferred widgets here.', 'featherlite' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<div class="widget-title"><h3>',
				'after_title'   => '</h3></div>',
			] 
		);
	}
}
add_action( 'widgets_init', 'featherlite_fourofour_widgets_init' );

if ( ! function_exists( 'featherlite_404_widgets' ) ) {
	function featherlite_404_widgets() {
		if ( is_active_sidebar( 'featherlite-sidebar-404' ) ) {
			do_action( 'featherlite_fourofour_before' );
			echo '<aside id="fourofour-widgets" class="fourofour-widgets-area">';
				
				dynamic_sidebar( 'featherlite-sidebar-404' );
				
			echo '</aside>';
			do_action( 'featherlite_fourofour_after' );
		}
	}	
}
add_action( 'featherlite_fourofour_content', 'featherlite_404_widgets', 30 );


function featherlite_fourofour_content_closer() {
	echo '</div><!-- .page-content -->';
}
add_action( 'featherlite_fourofour_content', 'featherlite_fourofour_content_closer',  50 );

function featherlite_fourofour_customize_register( $wp_customize ) {
		
	/**
	 * Add the panel
	 */
	$wp_customize->add_panel( 'featherlite_fourofour_panel', array(
		'priority'       	=> 210,
		'capability'     	=> 'edit_theme_options',
		'theme_supports' 	=> '',
		'title'				=> __( 'FeatherLite 404 Options', 'featherlite' ),
		'description'    	=> __( 'Customize the appearance and content of the 404 page of your site.', 'featherlite' ),
	) );
	
	$featherlite_fourofour_area = (object) $wp_customize->get_section( 'sidebar-widgets-featherlite-sidebar-404' );
	$featherlite_fourofour_area->panel = 'featherlite_fourofour_panel';
	$featherlite_fourofour_area->priority = '100';
	$featherlite_fourofour_area->description = __( 'A self adjusting widget area for upto 4 widgets per row.', 'featherlite' );
	
}
add_action( 'customize_register', 'featherlite_fourofour_customize_register' );