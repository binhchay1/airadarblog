<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://shapedplugin.com/
 * @since      2.0.0
 *
 * @package    Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/includes
 */

/**
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 */
class Easy_Accordion_Pro_I18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    2.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'easy-accordion-pro',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
