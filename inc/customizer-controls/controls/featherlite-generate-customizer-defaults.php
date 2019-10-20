<?php

/**
* Set our Customizer default options
*/
if ( ! function_exists( 'featherlite_generate_defaults' ) ) {
	function featherlite_generate_defaults() {
		$customizer_defaults = array(
			'featherlite_sticky_navbar_setting' => 0,
			'featherlite_site_layout_default' => 'sidebarright',
		);

		return apply_filters( 'featherlite_customizer_defaults', $customizer_defaults );
	}
}