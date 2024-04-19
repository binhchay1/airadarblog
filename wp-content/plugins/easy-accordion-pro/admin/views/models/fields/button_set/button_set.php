<?php
/**
 * The button set field of the plugin.
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

if ( ! class_exists( 'SP_EAP_Field_button_set' ) ) {
	/**
	 *
	 * Field: button_set
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SP_EAP_Field_button_set extends SP_EAP_Fields {

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
					'multiple'   => false,
					'options'    => array(),
					'query_args' => array(),
				)
			);

			$value = ( is_array( $this->value ) ) ? $this->value : array_filter( (array) $this->value );

			echo wp_kses_post( $this->field_before() );

			if ( isset( $this->field['options'] ) ) {

				$options = $this->field['options'];
				$options = ( is_array( $options ) ) ? $options : array_filter( $this->field_data( $options, false, $args['query_args'] ) );

				if ( is_array( $options ) && ! empty( $options ) ) {

					echo '<div class="eapro-siblings eapro--button-group" data-multiple="' . esc_attr( $args['multiple'] ) . '">';

					foreach ( $options as $key => $option ) {

						$type    = ( $args['multiple'] ) ? 'checkbox' : 'radio';
						$extra   = ( $args['multiple'] ) ? '[]' : '';
						$active  = ( in_array( $key, $value ) || ( empty( $value ) && empty( $key ) ) ) ? ' eapro--active' : '';
						$checked = ( in_array( $key, $value ) || ( empty( $value ) && empty( $key ) ) ) ? ' checked' : '';

						echo '<div class="eapro--sibling eapro--button' . esc_attr( $active ) . '">';
						echo '<input type="' . esc_attr( $type ) . '" name="' . esc_attr( $this->field_name( $extra ) ) . '" value="' . esc_attr( $key ) . '"' . $this->field_attributes() . esc_attr( $checked ) . '/>'; // phpcs:ignore 
						echo wp_kses_post( $option );
						echo '</div>';

					}

					echo '</div>';

				} else {

					echo ! empty( $this->field['empty_message'] ) ? esc_attr( $this->field['empty_message'] ) : esc_html__( 'No data provided for this option type.', 'easy-accordion-pro' );

				}
			}

			echo wp_kses_post( $this->field_after() );

		}

	}
}
