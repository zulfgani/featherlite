<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function featherlite_skip_links() { ?>
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'featherlite' ); ?></a>
<?php
}
add_action( 'featherlite_masthead_before', 'featherlite_skip_links', 1 );

/*
 * May look a bit odd doing a function(s) to add to (an)other function(s) but there's a method to the madness ;)
 */
function featherlite_masthead_render() { 
	/*
	 * Content hooked to featherlite_masthead_before()
	 *
	 * featherlite_skip_links(); @priority 1
	 */
	do_action( 'featherlite_masthead_before' );
	?>
	<header id="masthead" class="site-header">
		<?php 
		/*
		 * Content hooked to featherlite_masthead();
		 *
		 * featherlite_main_header(); @priority 20
		 */
		do_action( 'featherlite_masthead' ); ?>		
		
	</header><!-- #masthead -->
<?php
}
add_action( 'featherlite_header', 'featherlite_masthead_render', 20 );

function featherlite_max_mega_menu() {
	wp_nav_menu( array( 'theme_location' => 'primary' ) );
}

/*
 * Primary Navigation hooked to featherlite_header() @priority 10
 */
function featherlite_primary_navigation() {
	if ( has_nav_menu( 'primary' ) ) { ?>
		<nav id="primary-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<div class="bar1"></div>
				<div class="bar2"></div>
				<div class="bar3"></div>
			</button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	<?php }
}

if ( class_exists( 'Mega_Menu' ) ) {
	add_action( 'featherlite_header', 'featherlite_max_mega_menu', 10 );
} else {
	add_action( 'featherlite_header', 'featherlite_primary_navigation', 10 );
}

/*
 * Main Header hooked to featherlite_masthead() @priority 20
 */
function featherlite_main_header_render() { ?>
	<div class="main-header">
			<div class="header-wrapper">
			
			<?php 
			/*
			 * Content hooked to featherlite_header_content();
			 *
			 * featherlite_header_aside_left(); @priority 10
			 * featherlite_header_brand(); @priority 20
			 * featherlite_header_aside_right(); @priority 30
			 */
			do_action( 'featherlite_main_header' ); ?>
			
			</div><!-- .header_wrapper -->
		</div><!-- .main_header -->

<?php	
}
add_action( 'featherlite_masthead', 'featherlite_main_header_render', 20 );

/*
 * Secondary navigation hooked to featherlite_header() @priority 30
 */
function featherlite_secondary_navigation() {
	if ( has_nav_menu( 'secondary' ) ) { ?>
		<nav id="secondary-navigation" class="secondary-navigation">
			<button class="menu-toggle" aria-controls="secondary-menu" aria-expanded="false">
				<div class="bar1"></div>
				<div class="bar2"></div>
				<div class="bar3"></div>
			</button>
			<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	<?php }
}
add_action( 'featherlite_header', 'featherlite_secondary_navigation', 30 );


/*
 * Header Site Branding hooked to featherlite_main_header() @priority 20
 */
function featherlite_header_brand() {
	echo '<div class="site-branding">';
		
		/*
		 * Content hooked to featherlite_brand_area();
		 *
		 * featherlite_logo_render(); @priority 10
		 * featherlite_site_title_render(); @priority 20
		 * featherlite_site_description_render(); @priority 30
		 * featherlite_site_brand_after(); @priority 40
		 */
		do_action( 'featherlite_brand_area' ); 		
		
	echo '</div><!-- .site-branding -->';
}
add_action( 'featherlite_main_header', 'featherlite_header_brand', 20 );

function featherlite_logo_render() {
	if( has_custom_logo() ) {
		the_custom_logo(); 
	}
}
add_action( 'featherlite_brand_area', 'featherlite_logo_render', 10 );

function featherlite_site_title_render() {
	
	if ( is_front_page() && is_home() ) { ?>
		<h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?>
			</a>
		</h1>
	<?php } else { ?>
		<p class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?>
			</a>
		</p>
	<?php
	}
}
add_action( 'featherlite_brand_area', 'featherlite_site_title_render', 20 );

function featherlite_site_description_render() {
	$featherlite_description = get_bloginfo( 'description', 'display' );
	if ( $featherlite_description || is_customize_preview() ) {
		echo '<p class="site-description">';
			echo esc_attr( $featherlite_description ); /* WPCS: xss ok. */
		echo '</p>';		
	}
}
add_action( 'featherlite_brand_area', 'featherlite_site_description_render', 30 );

/**
 * Register widget areas for the theme header.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package FeatherLite
 *
 */
function featherlite_header_widgets_register() {
	if( ! is_admin() || is_customize_preview() ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Site Identity After', 'featherlite' ),
			'id'            => 'brand-after',
			'description'   => esc_html__( 'Ideal for extra text that includes html for a CTA button or two.', 'featherlite' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Left of Site Identity', 'featherlite' ),
			'id'            => 'brand-left',
			'description'   => esc_html__( 'Add a single widgets here.', 'featherlite' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Right of Site Identity', 'featherlite' ),
			'id'            => 'brand-right',
			'description'   => esc_html__( 'Add a single widgets here.', 'featherlite' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );
	}
}
add_action( 'widgets_init', 'featherlite_header_widgets_register' );

/*
 * Header Aside Left hooked to featherlite_main_header() @priority 10
 */
function featherlite_header_aside_left() {
	echo '<aside class="brand-left">';
		dynamic_sidebar( 'brand-left' );
	echo '</aside><!-- .brand-left -->';
}
add_action( 'featherlite_main_header', 'featherlite_header_aside_left', 10 );

/*
 * Header Brand after hooked to () @priority 40
 */
function featherlite_site_brand_after() {
	echo '<aside class="brand-after">';
		dynamic_sidebar( 'brand-after' );
	echo '</aside><!-- .brand-after -->';
}
add_action( 'featherlite_brand_area', 'featherlite_site_brand_after', 40 );

/*
 * Header Aside Right hooked to featherlite_main_header() @priority 30
 */
function featherlite_header_aside_right() {
	echo '<aside class="brand-right">';
		dynamic_sidebar( 'brand-right' );
	echo '</aside><!-- .brand-right -->';
}
add_action( 'featherlite_main_header', 'featherlite_header_aside_right', 30 );

function featherlite_header_body_class( $header_class ) {
	$default 	= featherlite_generate_defaults();
	$sticky 	= get_theme_mod( 'featherlite_sticky_navbar_setting', $default['featherlite_sticky_navbar_setting'] );
	if ( $sticky == true ) {
		$header_class[] = 'sticky-navbar';
	}
	
	return $header_class;
}
add_filter( 'body_class', 'featherlite_header_body_class' );

function featherlite_header_customize_register( $wp_customize ) {
		
	/**
	 * Add the panels
	 */
	$wp_customize->add_panel( 'featherlite_header_panel', array(
		'priority'       	=> 60,
		'capability'     	=> 'edit_theme_options',
		'theme_supports' 	=> '',
		'title'				=> __( 'FeatherLite Header Options', 'featherlite' ),
		'description'    	=> __( 'Customise the appearance and content of the header area of your site.', 'featherlite' ),
	) );
	
	$featherlite_brand = (object) $wp_customize->get_section( 'title_tagline' );
	$featherlite_brand->panel = 'featherlite_header_panel';
	$featherlite_brand->priority = '25';
	
	$featherlite_brand_left = (object) $wp_customize->get_section( 'sidebar-widgets-brand-left' );
	$featherlite_brand_left->panel = 'featherlite_header_panel';
	$featherlite_brand_left->priority = '30';
	$featherlite_brand_left->description = __( 'Add a widget to the left of site brand', 'featherlite' );
	
	$featherlite_brand_after = (object) $wp_customize->get_section( 'sidebar-widgets-brand-after' );
	$featherlite_brand_after->panel = 'featherlite_header_panel';
	$featherlite_brand_after->priority = '40';
	$featherlite_brand_after->description = __( 'Add a widget below the site identity ~ appears below the Site Description', 'featherlite' );
	
	$featherlite_brand_right = (object) $wp_customize->get_section( 'sidebar-widgets-brand-right' );
	$featherlite_brand_right->panel = 'featherlite_header_panel';
	$featherlite_brand_right->priority = '50';
	$featherlite_brand_right->description = __( 'Add a widget to the right of site brand', 'featherlite' );
	
}
add_action( 'customize_register', 'featherlite_header_customize_register' );