<?php
/**
 * The radio field of the plugin.
 *
 * @link https://shapedplugin.com
 *
 * @package Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'SP_EAP_Field_radio' ) ) {
	/**
	 * SP_EAP_Field_radio
	 */
	class SP_EAP_Field_radio extends SP_EAP_Fields {

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

			$args = wp_parse_args(
				$this->field,
				array(
					'inline'     => false,
					'query_args' => array(),
				)
			);

			$inline_class = ( $args['inline'] ) ? ' class="eapro--inline-list"' : '';

			echo wp_kses_post( $this->field_before() );

			if ( isset( $this->field['options'] ) ) {

				$options = $this->field['options'];
				$options = ( is_array( $options ) ) ? $options : array_filter( $this->field_data( $options, false, $args['query_args'] ) );

				if ( is_array( $options ) && ! empty( $options ) ) {

					echo '<ul' . $inline_class . '>';
					foreach ( $options as $option_key => $option_value ) {

						if ( is_array( $option_value ) && ! empty( $option_value ) ) {

							echo '<li>';
							echo '<ul>';
							echo '<li><strong>' . esc_attr( $option_key ) . '</strong></li>';
							foreach ( $option_value as $sub_key => $sub_value ) {
								$checked = ( $sub_key == $this->value ) ? ' checked' : '';
								echo '<li><label><input type="radio" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $sub_key ) . '"' . $this->field_attributes() . esc_attr( $checked ) . '/> ' . $sub_value . '</label></li>';//phpcs:ignore
							}
							echo '</ul>';
							echo '</li>';

						} else {

							$checked = ( $option_key == $this->value ) ? ' checked' : '';
							echo '<li><label><input type="radio" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $option_key ) . '"' . $this->field_attributes() . esc_attr( $checked ) . '/> ' . esc_attr( $option_value ) . '</label></li>';//phpcs:ignore

						}
					}
					echo '</ul>';

				} else {

					echo ! empty( $this->field['empty_message'] ) ? esc_attr( $this->field['empty_message'] ) : esc_html__( 'No data provided for this option type.', 'easy-accordion-pro' );

				}
			} else {
				$label = ( isset( $this->field['label'] ) ) ? $this->field['label'] : '';
				echo '<label><input type="radio" name="' . esc_attr( $this->field_name() ) . '" value="1"' . $this->field_attributes() . esc_attr( checked( $this->value, 1, false ) ) . '/> ' . esc_attr( $label ) . '</label>';//phpcs:ignore
			}

			echo wp_kses_post( $this->field_after() );

		}

	}
}
