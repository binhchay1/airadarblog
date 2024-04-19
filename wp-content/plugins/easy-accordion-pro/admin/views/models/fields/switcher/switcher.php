<?php
/**
 * The switcher field of the plugin.
 *
 * @link https://shapedplugin.com
 *
 * @package Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'SP_EAP_Field_switcher' ) ) {
	/**
	 * SP_EAP_Field_switcher
	 */
	class SP_EAP_Field_switcher extends SP_EAP_Fields {

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

			$active     = ( ! empty( $this->value ) ) ? ' eapro--active' : '';
			$text_on    = ( ! empty( $this->field['text_on'] ) ) ? $this->field['text_on'] : esc_html__( 'On', 'easy-accordion-pro' );
			$text_off   = ( ! empty( $this->field['text_off'] ) ) ? $this->field['text_off'] : esc_html__( 'Off', 'easy-accordion-pro' );
			$text_width = ( ! empty( $this->field['text_width'] ) ) ? ' style="width: ' . esc_attr( $this->field['text_width'] ) . 'px;"' : '';

			echo wp_kses_post( $this->field_before() );

			echo '<div class="eapro--switcher' . esc_attr( $active ) . '"' . $text_width . '>';//phpcs:ignore
			echo '<span class="eapro--on">' . esc_attr( $text_on ) . '</span>';
			echo '<span class="eapro--off">' . esc_attr( $text_off ) . '</span>';
			echo '<span class="eapro--ball"></span>';
			echo '<input type="text" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $this->value ) . '"' . $this->field_attributes() . ' />';//phpcs:ignore
			echo '</div>';

			echo ( ! empty( $this->field['label'] ) ) ? '<span class="eapro--label">' . esc_attr( $this->field['label'] ) . '</span>' : '';

			echo wp_kses_post( $this->field_after() );

		}

	}
}