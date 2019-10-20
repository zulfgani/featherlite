<?php

/**
 * URL sanitization
 *
 * @param  string	Input to be sanitized (either a string containing a single url or multiple, separated by commas)
 * @return string	Sanitized input
 */
if ( ! function_exists( 'featherlite_url_sanitization' ) ) {
	function featherlite_url_sanitization( $input ) {
		if ( strpos( $input, ',' ) !== false) {
			$input = explode( ',', $input );
		}
		if ( is_array( $input ) ) {
			foreach ($input as $key => $value) {
				$input[$key] = esc_url_raw( $value );
			}
			$input = implode( ',', $input );
		}
		else {
			$input = esc_url_raw( $input );
		}
		return $input;
	}
}

/**
 * Switch sanitization
 *
 * @param  string		Switch value
 * @return integer	Sanitized value
 */
if ( ! function_exists( 'featherlite_switch_sanitization' ) ) {
	function featherlite_switch_sanitization( $input ) {
		if ( true === $input ) {
			return 1;
		} else {
			return 0;
		}
	}
}

/**
 * Radio Button and Select sanitization
 *
 * @param  string	Radio Button value
 * @return integer	Sanitized value
 */
if ( ! function_exists( 'featherlite_radio_sanitization' ) ) {
	function featherlite_radio_sanitization( $input, $setting ) {
		//get the list of possible radio box or select options
		$choices = $setting->manager->get_control( $setting->id )->choices;

		if ( array_key_exists( $input, $choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
}

/**
 * Integer sanitization
 *
 * @param  string		Input value to check
 * @return integer	Returned integer value
 */
if ( ! function_exists( 'featherlite_sanitize_integer' ) ) {
	function featherlite_sanitize_integer( $input ) {
		return (int) $input;
	}
}
