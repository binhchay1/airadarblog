<?php
/**
 * The abstract class functionality of the plugin.
 *
 * @link https://shapedplugin.com
 *
 * @package Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'SP_EAP_Abstract' ) ) {
	/**
	 *
	 * Abstract Class
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	abstract class SP_EAP_Abstract {

		/**
		 * Abstract
		 *
		 * @var string
		 */
		public $abstract = '';
		/**
		 * Output_css
		 *
		 * @var string
		 */
		public $output_css = '';
		/**
		 * Typographies
		 *
		 * @var array
		 */
		public $typographies = array();

		/**
		 * __construct
		 *
		 * @return void
		 */
		public function __construct() {

			// Check for embed custom css styles.
			if ( ! empty( $this->args['output_css'] ) ) {
				add_action( 'wp_head', array( &$this, 'add_output_css' ), 100 );
			}
		}

		/**
		 * Add_output_css
		 *
		 * @return void
		 */
		public function add_output_css() {

			$this->output_css = apply_filters( "eapro_{$this->unique}_output_css", $this->output_css, $this );

			if ( ! empty( $this->output_css ) ) {
				echo '<style type="text/css">' . wp_strip_all_tags( $this->output_css ) . '</style>';
			}
		}
	}
}
