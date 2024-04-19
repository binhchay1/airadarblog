<?php
/**
 * The shortcode field of the plugin.
 *
 * @link https://shapedplugin.com
 *
 * @package Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'SP_EAP_Field_shortcode' ) ) {
	/**
	 * SP_EAP_Field_shortcode
	 */
	class SP_EAP_Field_shortcode extends SP_EAP_Fields {

		/**
		 * Field constructor.
		 *
		 * @param array  $field The field type.
		 * @param string $value The values of the field.
		 * @param string $unique The unique ID for the field.
		 * @param string $where To where show the output CSS.
		 * @param string $parent The parent args.
		 */
		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		/**
		 * Render
		 *
		 * @return void
		 */
		public function render() {

			// Get the Post ID.
			$post_id = get_the_ID();

			echo ( ! empty( $post_id ) ) ? '<div class="eap-scode-wrap">
			<div class="sp_eap-after-copy-text sp-eap-pagination-not-work"><i class="fa fa-check-circle"></i>  The pagination will work in the frontend well. </div></div><div class="eap-scode-wrap"><p>To display the Accordion FAQs group, copy and paste this shortcode into your post, page, custom post, block editor, or page builder. <a href="https://docs.shapedplugin.com/docs/easy-accordion-pro/configurations/how-to-use-easy-accordion-shortcode-to-your-theme-files-or-php-templates/" target="_blank">Learn how</a> to include it in your template file.</p><span class="eap-shortcode-selectable">[sp_easyaccordion id="' . esc_attr( $post_id ) . '"]</span></div><div class="sp_eap-after-copy-text"><i class="fa fa-check-circle"></i> Shortcode Copied to Clipboard! </div>' : '';
		}
	}
}
