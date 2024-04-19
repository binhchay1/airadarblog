<?php
/**
 * The helper function of the plugin.
 *
 * @link https://shapedplugin.com
 * @since 2.0.11
 *
 * @package Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! function_exists( 'eapro_array_search' ) ) {
	/**
	 * Array search key & value
	 *
	 * @param  mixed $array array.
	 * @param  mixed $key key.
	 * @param  mixed $value value.
	 * @return statement
	 */
	function eapro_array_search( $array, $key, $value ) {

		$results = array();

		if ( is_array( $array ) ) {
			if ( isset( $array[ $key ] ) && $array[ $key ] == $value ) {
				$results[] = $array;
			}

			foreach ( $array as $sub_array ) {
				$results = array_merge( $results, eapro_array_search( $sub_array, $key, $value ) );
			}
		}

		return $results;

	}
}

if ( ! function_exists( 'eapro_microtime' ) ) {
	/**
	 * Between Microtime
	 *
	 * @param  mixed $timenow current time.
	 * @param  mixed $starttime start time.
	 * @param  mixed $timeout time out.
	 * @return statement
	 */
	function eapro_timeout( $timenow, $starttime, $timeout = 30 ) {
		return ( ( $timenow - $starttime ) < $timeout ) ? true : false;
	}
}

if ( ! function_exists( 'eapro_wp_editor_api' ) ) {
	/**
	 * Check for wp editor api
	 *
	 * @return statement
	 */
	function eapro_wp_editor_api() {
		global $wp_version;
		return version_compare( $wp_version, '4.8', '>=' );
	}
}
