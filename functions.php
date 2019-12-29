<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
/**
 * FeatherLite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package featherlite
 */
 
/**
 * Assign the FeatherLite version to a var
 */
$theme 			  		= wp_get_theme( 'featherlite' );
$theme_name  			= $theme['Name'];
$featherlite_version  	= $theme['Version'];

if ( ! function_exists( 'featherlite_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various ClassicPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function featherlite_setup() {
		global $theme_name;
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on FeatherLite, use a find and replace
		 * to change 'featherlite' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'featherlite' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let ClassicPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect ClassicPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		// Add theme support for Custom Logo.
		add_theme_support( 
			'custom-logo', 
			[
				'width'       => 250,
				'height'      => 250,
				//'flex-width'  => true,
				'flex-height'  => true,
			] 
		);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( 
			[
				'primary' 	=> esc_html__( 'Primary', 'featherlite' ),
				'secondary' => esc_html__( 'Secondary', 'featherlite' ),
			] 
		);
		
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'featherlite-default', 800, 9999);
		add_image_size( 'featherlite-post-thumbnail', 800, 400, true);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 
			'html5', [
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			]
		);
		
		if ( class_exists( 'totclcInit' ) ) {
			add_theme_support( 
				'components-page-builder', [
					'components' => [
						'classic-hero-block',
						'classic-content-block',
						'classic-content-block-two',
						'classic-cta-banner',
						'classic-cta-banner-two',					
						'classic-recent-posts',
						'gallery',
						'classic-commerce-products',
					],
					'control_title' => __( $theme_name .' Page Components', 'totc-layout-control' ),
				] 
			);
			
		}
		
	}
}
add_action( 'after_setup_theme', 'featherlite_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function featherlite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'featherlite_content_width', 790 );
}
add_action( 'after_setup_theme', 'featherlite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function featherlite_widgets_init() {
	register_sidebar( 
		[
			'name'          => esc_html__( 'Main Sidebar', 'featherlite' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'featherlite' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
			'container_selector' => '#secondary',
		] 
	);
}
add_action( 'widgets_init', 'featherlite_widgets_init' );

/**
 * Register custom fonts.
 */
function featherlite_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Oswald, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Oswald font: on or off', 'featherlite' ) ) {
		$fonts[] = 'Oswald:400,700';
	}
	
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Roboto, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'featherlite' ) ) {
		$fonts[] = 'Roboto:400,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}


	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Element 1.0.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function featherlite_resource_hints( $urls, $relation_type ) {
	
	if ( wp_style_is( 'featherlite-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'featherlite_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function featherlite_scripts() {
	global $featherlite_version;
	$parent_style = 'featherlite-style'; // This is handle for the FeatherLite theme.
	$child_style = 'featherlite-child-style'; // This is handle for the FeatherLite child themes.
	$dir_uri = get_template_directory_uri();
	
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'featherlite-fonts', featherlite_fonts_url(), array(), null );
	
	// Theme stylesheet.
	if ( wp_get_theme()->get('Name') != 'FeatherLite' ) {
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array( 'featherlite-fonts' ), $featherlite_version );
		wp_enqueue_style( $child_style, get_stylesheet_directory_uri() . '/style.css', array( $parent_style, 'featherlite-fonts' ), $featherlite_version );
	} else {
		wp_enqueue_style( $parent_style, get_stylesheet_uri(), array(), $featherlite_version );
	}
	
	wp_enqueue_script( 'featherlite-custom-js', $dir_uri . '/assets/js/featherlite.js', array( 'jquery' ), $featherlite_version, true );
	
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script( 'featherlite-primary-navigation', $dir_uri . '/assets/js/primary-navigation.js', array(), $featherlite_version, true );
	}
	
	if ( has_nav_menu( 'secondary' ) ) { 
		wp_enqueue_script( 'featherlite-secondary-navigation', $dir_uri . '/assets/js/secondary-navigation.js', array(), $featherlite_version, true );
	}
	
	wp_enqueue_script( 'featherlite-skip-link-focus-fix', $dir_uri . '/assets/js/skip-link-focus-fix.js', array(), $featherlite_version, true );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'featherlite_scripts' );

if ( !function_exists( 'featherlite_locale_css' ) ) {
    function featherlite_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_parent_theme_file_path() . '/rtl.css' ) )
            $uri = get_theme_file_uri() . '/rtl.css';
        return $uri;
    }
}
add_filter( 'locale_stylesheet_uri', 'featherlite_locale_css' );

/**
 * Replace Excerpt More
 */
if ( ! function_exists( 'featherlite_new_excerpt_more' ) ) {

	function featherlite_new_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			return '';
		}
	}
	add_filter( 'excerpt_more', 'featherlite_new_excerpt_more' );
}

 /**
 * Delete font size style from tag cloud widget
 */
if ( ! function_exists( 'featherlite_fix_tag_cloud' ) ) {
	function featherlite_fix_tag_cloud($tag_string){
	   return preg_replace('/ style=("|\')(.*?)("|\')/','',$tag_string);
	}
}
add_filter( 'wp_generate_tag_cloud', 'featherlite_fix_tag_cloud', 10, 1 );

// Remove P Tags Around Images 
function featherlite_filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter( 'the_content', 'featherlite_filter_ptags_on_images' );

/**
 * Custom location functions for this theme.
 */
require get_parent_theme_file_path() . '/core/layout/layout-functions.php';
require get_parent_theme_file_path() . '/core/header/header-functions.php';
require get_parent_theme_file_path() . '/core/templates/homepage-functions.php';
require get_parent_theme_file_path() . '/core/templates/fullwidth-functions.php';
require get_parent_theme_file_path() . '/core/posts/summary-functions.php';
require get_parent_theme_file_path() . '/core/singular/single-post-functions.php';
require get_parent_theme_file_path() . '/core/sidebars/sidebar-functions.php';
require get_parent_theme_file_path() . '/core/fourofour/fourofour-functions.php';
require get_parent_theme_file_path() . '/core/footer/footer-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_parent_theme_file_path() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_parent_theme_file_path() . '/inc/customizer.php';

