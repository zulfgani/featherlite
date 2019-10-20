<?php
/**
 * Customizer Setup and Custom Controls
 *
 */

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class featherlite_initialise_customizer_settings {
	// Get our default values
	private $defaults;

	public function __construct() {
		// Get our Customizer defaults		
		require_once trailingslashit( dirname(__FILE__) ) . 'controls/featherlite-generate-customizer-defaults.php';
		$this->defaults = featherlite_generate_defaults();

		// Register our Panels
		add_action( 'customize_register', array( $this, 'featherlite_add_customizer_panels' ) );

		// Register our sections
		add_action( 'customize_register', array( $this, 'featherlite_add_customizer_sections' ) );
		
		// Register our sample Custom Control controls
		add_action( 'customize_register', array( $this, 'featherlite_register_header_navigation_controls' ) );
		
		// Register our sample Custom Control controls
		add_action( 'customize_register', array( $this, 'featherlite_register_layout_controls' ) );
		
		// Register our sample Custom Control controls
		add_action( 'customize_register', array( $this, 'featherlite_register_sidebar_controls' ) );
		
		// Register our sample Custom Control controls
		add_action( 'customize_register', array( $this, 'featherlite_register_footer_controls' ) );

	}

	/**
	 * Register the Customizer panels
	 */
	public function featherlite_add_customizer_panels( $wp_customize ) {
		
		/**
		 * Add our theme homepage panel
		 */
		$pages = get_pages( array( 'post_status' =>  array('publish', 'pending', 'private', 'draft') ) );

		foreach ( $pages as $page ) {

			$page_template = get_page_template_slug($page->ID);

			if ( $page_template == 'templates/homepage.php' ) {
				$wp_customize->add_panel( 'featherlite_homepage_panel',
					array(
						'title' => __( 'FeatherLite Homepage', 'featherlite' ),
						'description' => esc_html__( 'Custom content for FeatherLite homepage.', 'featherlite' )
					)
				);
			}
		}
		
		/**
		 * Add our theme options panel
		 */
		 $wp_customize->add_panel( 'featherlite_options_panel',
		 	array(
				'title' => __( 'FeatherLite Options', 'featherlite' ),
				'description' => esc_html__( 'Custom options for the FeatherLite theme.', 'featherlite' )
			)
		);
	}

	/**
	 * Register the Customizer sections
	 */
	public function featherlite_add_customizer_sections( $wp_customize ) {
		/**
		 * Add our Site Header & Navigation Section
		 */
		
		$wp_customize->add_section( 'featherlite_menu_section',
			array(
				'title' => __( 'Sticky Menu', 'featherlite' ),
				'description' => esc_html__( 'Make the Primary Navbar Menu Sticky.', 'featherlite'  ),
				'panel' => 'nav_menus',
				'priority'       => 20
			)
		);
		
		/**
		 * Add our Site Layout Section
		 */
		$wp_customize->add_section( 'featherlite_layout_section',
			array(
				'title' => __( 'Site Layout Options', 'featherlite' ),
				'description' => esc_html__( 'Theme layout customization controls.', 'featherlite'  ),
				'panel' => 'featherlite_options_panel',
				'priority'       => 10
			)
		);
		
		/**
		 * Add our Sidebar Section
		 */
		$wp_customize->add_section( 'featherlite_sidebar_section',
			array(
				'title' => __( 'Sidebar Options', 'featherlite' ),
				'description' => esc_html__( 'Sidebar customization controls.', 'featherlite'  ),
				'panel' => 'featherlite_options_panel'
			)
		);
		
		/**
		 * Add our Site Footer Section
		 */
		$wp_customize->add_section( 'featherlite_footer_section',
			array(
				'title' => __( 'Footer Options', 'featherlite' ),
				'description' => esc_html__( 'Theme footer customization Controls.', 'featherlite'  ),
				'panel' => 'featherlite_options_panel',
				'priority'       => 100
			)
		);

	}
	
	/**
	 * Register our header & navigation controls
	 */
	public function featherlite_register_header_navigation_controls( $wp_customize ) {
		
		$wp_customize->add_setting( 'featherlite_sticky_navbar_setting',
			array(
				'default' => $this->defaults['featherlite_sticky_navbar_setting'],
				'transport' => 'refresh',
				'sanitize_callback' => 'featherlite_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Featherlite_Toggle_Switch_Custom_control( $wp_customize, 'featherlite_sticky_navbar_setting',
			array(
				'label' => __( 'Sticky Primary Navbar', 'featherlite' ),
				'section' => 'featherlite_menu_section'
			)
		) );
	}
	
	/**
	 * Register our site layout controls
	 */
	public function featherlite_register_layout_controls( $wp_customize ) {
		// Test of Image Radio Button Custom Control
		$wp_customize->add_setting( 'featherlite_site_layout_setting',
			array(
				'default' => $this->defaults['featherlite_site_layout_default'],
				'transport' => 'refresh',
				'sanitize_callback' => 'featherlite_radio_sanitization'
			)
		);
		$wp_customize->add_control( new Featherlite_Image_Radio_Button_Custom_Control( $wp_customize, 'featherlite_site_layout_setting',
			array(
				'label' => __( 'Blog Layout Control', 'featherlite' ),
				'description' => esc_html__( 'Blog layout selector', 'featherlite' ),
				'section' => 'featherlite_layout_section',
				'choices' => array(
					'sidebarleft' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar-left.png',
						'name' => __( 'Left Sidebar', 'featherlite' )
					),
					'sidebarright' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar-right.png',
						'name' => __( 'Right Sidebar', 'featherlite' )
					)
				)
			)
		) );
	}
	
	/**
	 * Register our sidebar controls
	 */
	public function featherlite_register_sidebar_controls( $wp_customize ) {
		
	}
	
	/**
	 * Register our site footer controls
	 */
	public function featherlite_register_footer_controls( $wp_customize ) {
		
	}
	
}

/**
 * Load all our Customizer Custom Controls
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
	require_once trailingslashit( dirname(__FILE__) ) . 'controls/class-featherlite-base-control.php';
	require_once trailingslashit( dirname(__FILE__) ) . 'controls/class-featherlite-image-radio-button-control.php'; // Used
	require_once trailingslashit( dirname(__FILE__) ) . 'controls/class-featherlite-toggle-switch-control.php'; // Used
	require_once trailingslashit( dirname(__FILE__) ) . 'controls/sanitization-functions.php';
}

/**
 * Initialise our Customizer settings
 */
$featherlite_settings = new featherlite_initialise_customizer_settings();
