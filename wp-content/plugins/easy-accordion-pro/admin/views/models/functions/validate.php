<?php
/**
 * The validate function of the plugin.
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

if ( ! function_exists( 'eapro_validate_email' ) ) {
	/**
	 * Email validate
	 *
	 * @param  mixed $value value.
	 * @return statement
	 */
	function eapro_validate_email( $value ) {

		if ( ! filter_var( $value, FILTER_VALIDATE_EMAIL ) ) {
			return esc_html__( 'Please write a valid email address!', 'easy-accordion-pro' );
		}
	}
}

if ( ! function_exists( 'eapro_validate_numeric' ) ) {
	/**
	 *
	 * Numeric validate
	 *
	 * @param mixed $value value.
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function eapro_validate_numeric( $value ) {

		if ( ! is_numeric( $value ) ) {
			return esc_html__( 'Please write a numeric data!', 'easy-accordion-pro' );
		}
	}
}

if ( ! function_exists( 'eapro_validate_required' ) ) {
	/**
	 *
	 * Required validate
	 *
	 * @param mixed $value value.
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function eapro_validate_required( $value ) {

		if ( empty( $value ) ) {
			return esc_html__( 'Error! This field is required!', 'easy-accordion-pro' );
		}
	}
}

if ( ! function_exists( 'eapro_validate_url' ) ) {
	/**
	 *
	 * URL validate
	 *
	 * @param mixed $value value.
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function eapro_validate_url( $value ) {

		if ( ! filter_var( $value, FILTER_VALIDATE_URL ) ) {
			return esc_html__( 'Please write a valid url!', 'easy-accordion-pro' );
		}
	}
}
