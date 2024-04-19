<?php
/**
 * The image select field of the plugin.
 *
 * @link https://shapedplugin.com
 *
 * @package Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'SP_EAP_Field_image_select' ) ) {
	/**
	 * SP_EAP_Field_image_select
	 */
	class SP_EAP_Field_image_select extends SP_EAP_Fields {

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
					'multiple' => false,
					'options'  => array(),
				)
			);

			$value = ( is_array( $this->value ) ) ? $this->value : array_filter( (array) $this->value );

			echo wp_kses_post( $this->field_before() );

			if ( ! empty( $args['options'] ) ) {

				echo '<div class="eapro-siblings eapro--image-group" data-multiple="' . $args['multiple'] . '">';

				$num = 1;

				foreach ( $args['options'] as $key => $option ) {

					$type    = ( $args['multiple'] ) ? 'checkbox' : 'radio';
					$extra   = ( $args['multiple'] ) ? '[]' : '';
					$active  = ( in_array( $key, $value ) ) ? ' eapro--active' : '';
					$checked = ( in_array( $key, $value ) ) ? ' checked' : '';

					echo '<div class="eapro--sibling eapro--image' . esc_attr( $active ) . '">';
					if ( ! empty( $option['image'] ) ) {
						echo '<img src="' . esc_url( $option['image'] ) . '" alt="img-' . esc_attr( $num++ ) . '" />';
					} else {
						echo '<img src="' . esc_url( $option ) . '" alt="img-' . esc_attr( $num++ ) . '" />';
					}
					echo '<input type="' . esc_attr( $type ) . '" name="' . esc_attr( $this->field_name( $extra ) ) . '" value="' . esc_attr( $key ) . '"' . $this->field_attributes() . esc_attr( $checked ) . '/>';//phpcs:ignore
					if ( ! empty( $option['option_name'] ) ) {
						echo '<p class="eap-image-name">' . $option['option_name'] . '</p>';//phpcs:ignore
					}

					echo '</div>';

				}

				echo '</div>';

			}

			echo '<div class="clear"></div>';

			echo wp_kses_post( $this->field_after() );

		}

	}
}
