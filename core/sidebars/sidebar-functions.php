<?php

function featherlite_sidebars_customize_register( $wp_customize ) {
		
	$featherlite_sidebars 			= (object) $wp_customize->get_panel( 'widgets' );
	$featherlite_sidebars->title 	= __( 'Sidebars', 'featherlite' );
	$featherlite_sidebars->priority = 200;
	
}
add_action( 'customize_register', 'featherlite_sidebars_customize_register' );