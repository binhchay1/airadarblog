<?php
/**
 * The icon field of the plugin.
 *
 * @link https://shapedplugin.com
 *
 * @package Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'SP_EAP_Field_icon' ) ) {
	/**
	 * SP_EAP_Field_icon
	 */
	class SP_EAP_Field_icon extends SP_EAP_Fields {

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
					'button_title' => esc_html__( 'Add Icon', 'easy-accordion-pro' ),
					'remove_title' => '<img src="' . SP_EAP_URL . 'admin/img/ea-remove-icon.svg"/>',
				)
			);

			echo wp_kses_post( $this->field_before() );

			$nonce  = wp_create_nonce( 'eapro_icon_nonce' );
			$hidden = ( empty( $this->value ) ) ? ' hidden' : '';

			echo '<div class="eapro-icon-select">';
			echo '<span class="eapro-icon-preview' . esc_attr( $hidden ) . '"><i class="' . esc_attr( $this->value ) . '"></i></span>';
			echo '<a href="#" class="button button-primary eapro-icon-add" data-nonce="' . esc_attr( $nonce ) . '">' . wp_kses_post( $args['button_title'] ) . '</a>';
			echo '<a href="#" class="button eapro-warning-primary eapro-icon-remove' . esc_attr( $hidden ) . '">' . wp_kses_post( $args['remove_title'] ) . '</a>';
			echo '<input type="text" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $this->value ) . '" class="eapro-icon-value"' . $this->field_attributes() . ' />';//phpcs:ignore
			echo '</div>';

			echo wp_kses_post( $this->field_after() );

		}

	}
}
