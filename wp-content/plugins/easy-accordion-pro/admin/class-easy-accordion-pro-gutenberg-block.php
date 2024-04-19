<?php
/**
 * The plugin gutenberg block.
 *
 * @link       https://shapedplugin.com/
 * @since      2.4.1
 *
 * @package    Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/Admin
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Easy_Accordion_Pro_Gutenberg_Block' ) ) {

	/**
	 * Custom Gutenberg Block.
	 */
	class Easy_Accordion_Pro_Gutenberg_Block {

		/**
		 * Block Initializer.
		 */
		public function __construct() {
			require_once SP_EAP_PATH . '/admin/GutenbergBlock/class-easy-accordion-pro-gutenberg-block-init.php';
			new Easy_Accordion_Pro_Gutenberg_Block_Init();
		}
	}
}
