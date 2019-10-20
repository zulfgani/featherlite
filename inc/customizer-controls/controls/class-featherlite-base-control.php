<?php

/**
 * Custom Control Base Class
 */
class Featherlite_Custom_Control extends WP_Customize_Control {
	protected function get_featherlite_resource_url() {
		if( strpos( wp_normalize_path( __DIR__ ), wp_normalize_path( WP_PLUGIN_DIR ) ) === 0 ) {
			// We're in a plugin directory and need to determine the url accordingly.
			return plugin_dir_url( __DIR__ );
		}

		return trailingslashit( get_template_directory_uri() );
	}
}