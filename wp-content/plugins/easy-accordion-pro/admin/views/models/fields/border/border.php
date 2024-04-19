<?php
/**
 * The border field of the plugin.
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

if ( ! class_exists( 'SP_EAP_Field_border' ) ) {
	/**
	 *
	 * Field: border
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SP_EAP_Field_border extends SP_EAP_Fields {

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
					'top_icon'           => '<i class="fa fa-long-arrow-up"></i>',
					'left_icon'          => '<i class="fa fa-long-arrow-left"></i>',
					'bottom_icon'        => '<i class="fa fa-long-arrow-down"></i>',
					'right_icon'         => '<i class="fa fa-long-arrow-right"></i>',
					'all_icon'           => '<i class="fa fa-arrows"></i>',
					'top_placeholder'    => esc_html__( 'top', 'easy-accordion-pro' ),
					'right_placeholder'  => esc_html__( 'right', 'easy-accordion-pro' ),
					'bottom_placeholder' => esc_html__( 'bottom', 'easy-accordion-pro' ),
					'left_placeholder'   => esc_html__( 'left', 'easy-accordion-pro' ),
					'all_placeholder'    => esc_html__( 'all', 'easy-accordion-pro' ),
					'top'                => true,
					'left'               => true,
					'bottom'             => true,
					'right'              => true,
					'all'                => false,
					'color'              => true,
					'style'              => true,
					'unit'               => 'px',
				)
			);

			$default_value = array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
				'color'  => '',
				'style'  => 'solid',
				'all'    => '',
			);

			$border_props = array(
				'solid'  => esc_html__( 'Solid', 'easy-accordion-pro' ),
				'dashed' => esc_html__( 'Dashed', 'easy-accordion-pro' ),
				'dotted' => esc_html__( 'Dotted', 'easy-accordion-pro' ),
				'double' => esc_html__( 'Double', 'easy-accordion-pro' ),
				'inset'  => esc_html__( 'Inset', 'easy-accordion-pro' ),
				'outset' => esc_html__( 'Outset', 'easy-accordion-pro' ),
				'groove' => esc_html__( 'Groove', 'easy-accordion-pro' ),
				'ridge'  => esc_html__( 'ridge', 'easy-accordion-pro' ),
				'none'   => esc_html__( 'None', 'easy-accordion-pro' ),
			);

			$default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

			$value = wp_parse_args( $this->value, $default_value );

			echo wp_kses_post( $this->field_before() );

			echo '<div class="eapro--inputs">';

			if ( ! empty( $args['all'] ) ) {

				$placeholder = ( ! empty( $args['all_placeholder'] ) ) ? ' placeholder="' . esc_attr( $args['all_placeholder'] ) . '"' : '';
				$title       = ( ! empty( $args['width_title'] ) ) ? $args['width_title'] : __( 'width', 'easy-accordion-pro' );

				echo '<div class="eapro--input">';
				echo '<div class="eapro--title">' . esc_html( $title ) . '</div>';
				echo ( ! empty( $args['all_icon'] ) ) ? '<span class="eapro--label eapro--icon">' . wp_kses_post( $args['all_icon'] ) . '</span>' : '';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[all]' ) ) . '" value="' . esc_attr( $value['all'] ) . '"' . $placeholder . ' class="eapro-input-number eapro--is-unit" />'; // phpcs:ignore 
				// preloader already escaping.
				echo ( ! empty( $args['unit'] ) ) ? '<span class="eapro--label eapro--unit">' . esc_attr( $args['unit'] ) . '</span>' : '';
				echo '</div>';

			} else {

				$properties = array();

				foreach ( array( 'top', 'right', 'bottom', 'left' ) as $prop ) {
					if ( ! empty( $args[ $prop ] ) ) {
						$properties[] = $prop;
					}
				}

				$properties = ( array( 'right', 'left' ) === $properties ) ? array_reverse( $properties ) : $properties;

				foreach ( $properties as $property ) {

					$placeholder = ( ! empty( $args[ $property . '_placeholder' ] ) ) ? ' placeholder="' . esc_attr( $args[ $property . '_placeholder' ] ) . '"' : '';

					echo '<div class="eapro--input">';
					echo ( ! empty( $args[ $property . '_icon' ] ) ) ? '<span class="eapro--label eapro--icon">' . wp_kses_post( $args[ $property . '_icon' ] ) . '</span>' : '';
					echo '<input type="number" name="' . esc_attr( $this->field_name( '[' . $property . ']' ) ) . '" value="' . esc_attr( $value[ $property ] ) . '"' . $placeholder . ' class="eapro-input-number eapro--is-unit" />'; // phpcs:ignore 
					// preloader already escaping.
					echo ( ! empty( $args['unit'] ) ) ? '<span class="eapro--label eapro--unit">' . esc_attr( $args['unit'] ) . '</span>' : '';
					echo '</div>';

				}
			}

			if ( ! empty( $args['style'] ) ) {
				echo '<div class="eapro--input">';
				echo '<div class="eapro--title">' . esc_html__( 'Style', 'easy-accordion-pro' ) . '</div>';
				echo '<select name="' . esc_attr( $this->field_name( '[style]' ) ) . '">';
				foreach ( $border_props as $border_prop_key => $border_prop_value ) {
					$selected = ( $value['style'] === $border_prop_key ) ? ' selected' : '';
					echo '<option value="' . esc_attr( $border_prop_key ) . '"' . esc_attr( $selected ) . '>' . esc_attr( $border_prop_value ) . '</option>';
				}
				echo '</select>';
				echo '</div>';
			}

			echo '</div>';

			if ( ! empty( $args['color'] ) ) {
				$default_color_attr = ( ! empty( $default_value['color'] ) ) ? ' data-default-color="' . esc_attr( $default_value['color'] ) . '"' : '';
				echo '<div class="eapro--color">';
				echo '<div class="eapro--title">' . esc_html__( 'Color', 'easy-accordion-pro' ) . '</div>';
				echo '<div class="eapro-field-color">';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[color]' ) ) . '" value="' . esc_attr( $value['color'] ) . '" class="eapro-color"' . $default_color_attr . ' />'; // phpcs:ignore 
				// default_color_attr already escaping.
				echo '</div>';
				echo '</div>';
			}

			echo wp_kses_post( $this->field_after() );

		}

	}
}
