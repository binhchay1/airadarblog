<?php
/**
 * The background field of the plugin.
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

if ( ! class_exists( 'SP_EAP_Field_background' ) ) {
	/**
	 *
	 * Field: background
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SP_EAP_Field_background extends SP_EAP_Fields {

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
					'background_color'              => true,
					'background_image'              => true,
					'background_position'           => true,
					'background_repeat'             => true,
					'background_attachment'         => true,
					'background_size'               => true,
					'background_origin'             => false,
					'background_clip'               => false,
					'background_blend_mode'         => false,
					'background_gradient'           => false,
					'background_gradient_color'     => true,
					'background_gradient_direction' => true,
					'background_image_preview'      => true,
					'background_auto_attributes'    => false,
					'background_image_library'      => 'image',
					'background_image_placeholder'  => esc_html__( 'No background selected', 'easy-accordion-pro' ),
				)
			);

			$default_value = array(
				'background-color'              => '',
				'background-image'              => '',
				'background-position'           => '',
				'background-repeat'             => '',
				'background-attachment'         => '',
				'background-size'               => '',
				'background-origin'             => '',
				'background-clip'               => '',
				'background-blend-mode'         => '',
				'background-gradient-color'     => '',
				'background-gradient-direction' => '',
			);

			$default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

			$this->value = wp_parse_args( $this->value, $default_value );

			echo wp_kses_post( $this->field_before() );

			echo '<div class="eapro--background-colors">';

			//
			// Background Color.
			if ( ! empty( $args['background_color'] ) ) {

				echo '<div class="eapro--color">';

				echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="eapro--title">' . esc_html__( 'From', 'easy-accordion-pro' ) . '</div>' : '';

				SP_EAP::field(
					array(
						'id'      => 'background-color',
						'type'    => 'color',
						'default' => $default_value['background-color'],
					),
					$this->value['background-color'],
					$this->field_name(),
					'field/background'
				);

				echo '</div>';

			}

			//
			// Background Gradient Color.
			if ( ! empty( $args['background_gradient_color'] ) && ! empty( $args['background_gradient'] ) ) {

				echo '<div class="eapro--color">';

				echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="eapro--title">' . esc_html__( 'To', 'easy-accordion-pro' ) . '</div>' : '';

				SP_EAP::field(
					array(
						'id'      => 'background-gradient-color',
						'type'    => 'color',
						'default' => $default_value['background-gradient-color'],
					),
					$this->value['background-gradient-color'],
					$this->field_name(),
					'field/background'
				);

				echo '</div>';

			}

			//
			// Background Gradient Direction.
			if ( ! empty( $args['background_gradient_direction'] ) && ! empty( $args['background_gradient'] ) ) {

				echo '<div class="eapro--color">';

				echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="eapro---title">' . esc_html__( 'Direction', 'easy-accordion-pro' ) . '</div>' : '';

				SP_EAP::field(
					array(
						'id'      => 'background-gradient-direction',
						'type'    => 'select',
						'options' => array(
							''          => esc_html__( 'Gradient Direction', 'easy-accordion-pro' ),
							'to bottom' => esc_html__( '&#8659; top to bottom', 'easy-accordion-pro' ),
							'to right'  => esc_html__( '&#8658; left to right', 'easy-accordion-pro' ),
							'135deg'    => esc_html__( '&#8664; corner top to right', 'easy-accordion-pro' ),
							'-135deg'   => esc_html__( '&#8665; corner top to left', 'easy-accordion-pro' ),
						),
					),
					$this->value['background-gradient-direction'],
					$this->field_name(),
					'field/background'
				);

				echo '</div>';

			}

			echo '</div>';

			//
			// Background Image.
			if ( ! empty( $args['background_image'] ) ) {

				echo '<div class="eapro--background-image">';

				SP_EAP::field(
					array(
						'id'          => 'background-image',
						'type'        => 'media',
						'class'       => 'eapro-assign-field-background',
						'library'     => $args['background_image_library'],
						'preview'     => $args['background_image_preview'],
						'placeholder' => $args['background_image_placeholder'],
						'attributes'  => array( 'data-depend-id' => $this->field['id'] ),
					),
					$this->value['background-image'],
					$this->field_name(),
					'field/background'
				);

				echo '</div>';

			}

			$auto_class   = ( ! empty( $args['background_auto_attributes'] ) ) ? ' eapro--auto-attributes' : '';
			$hidden_class = ( ! empty( $args['background_auto_attributes'] ) && empty( $this->value['background-image']['url'] ) ) ? ' eapro--attributes-hidden' : '';

			echo '<div class="eapro--background-attributes' . esc_attr( $auto_class . $hidden_class ) . '">';

			//
			// Background Position.
			if ( ! empty( $args['background_position'] ) ) {

				SP_EAP::field(
					array(
						'id'      => 'background-position',
						'type'    => 'select',
						'options' => array(
							''              => esc_html__( 'Background Position', 'easy-accordion-pro' ),
							'left top'      => esc_html__( 'Left Top', 'easy-accordion-pro' ),
							'left center'   => esc_html__( 'Left Center', 'easy-accordion-pro' ),
							'left bottom'   => esc_html__( 'Left Bottom', 'easy-accordion-pro' ),
							'center top'    => esc_html__( 'Center Top', 'easy-accordion-pro' ),
							'center center' => esc_html__( 'Center Center', 'easy-accordion-pro' ),
							'center bottom' => esc_html__( 'Center Bottom', 'easy-accordion-pro' ),
							'right top'     => esc_html__( 'Right Top', 'easy-accordion-pro' ),
							'right center'  => esc_html__( 'Right Center', 'easy-accordion-pro' ),
							'right bottom'  => esc_html__( 'Right Bottom', 'easy-accordion-pro' ),
						),
					),
					$this->value['background-position'],
					$this->field_name(),
					'field/background'
				);

			}

			//
			// Background Repeat.
			if ( ! empty( $args['background_repeat'] ) ) {

				SP_EAP::field(
					array(
						'id'      => 'background-repeat',
						'type'    => 'select',
						'options' => array(
							''          => esc_html__( 'Background Repeat', 'easy-accordion-pro' ),
							'repeat'    => esc_html__( 'Repeat', 'easy-accordion-pro' ),
							'no-repeat' => esc_html__( 'No Repeat', 'easy-accordion-pro' ),
							'repeat-x'  => esc_html__( 'Repeat Horizontally', 'easy-accordion-pro' ),
							'repeat-y'  => esc_html__( 'Repeat Vertically', 'easy-accordion-pro' ),
						),
					),
					$this->value['background-repeat'],
					$this->field_name(),
					'field/background'
				);

			}

			//
			// Background Attachment.
			if ( ! empty( $args['background_attachment'] ) ) {

				SP_EAP::field(
					array(
						'id'      => 'background-attachment',
						'type'    => 'select',
						'options' => array(
							''       => esc_html__( 'Background Attachment', 'easy-accordion-pro' ),
							'scroll' => esc_html__( 'Scroll', 'easy-accordion-pro' ),
							'fixed'  => esc_html__( 'Fixed', 'easy-accordion-pro' ),
						),
					),
					$this->value['background-attachment'],
					$this->field_name(),
					'field/background'
				);

			}

			//
			// Background Size.
			if ( ! empty( $args['background_size'] ) ) {

				SP_EAP::field(
					array(
						'id'      => 'background-size',
						'type'    => 'select',
						'options' => array(
							''        => esc_html__( 'Background Size', 'easy-accordion-pro' ),
							'cover'   => esc_html__( 'Cover', 'easy-accordion-pro' ),
							'contain' => esc_html__( 'Contain', 'easy-accordion-pro' ),
						),
					),
					$this->value['background-size'],
					$this->field_name(),
					'field/background'
				);

			}

			//
			// Background Origin
			if ( ! empty( $args['background_origin'] ) ) {

				SP_EAP::field(
					array(
						'id'      => 'background-origin',
						'type'    => 'select',
						'options' => array(
							''            => esc_html__( 'Background Origin', 'easy-accordion-pro' ),
							'padding-box' => esc_html__( 'Padding Box', 'easy-accordion-pro' ),
							'border-box'  => esc_html__( 'Border Box', 'easy-accordion-pro' ),
							'content-box' => esc_html__( 'Content Box', 'easy-accordion-pro' ),
						),
					),
					$this->value['background-origin'],
					$this->field_name(),
					'field/background'
				);

			}

			//
			// Background Clip.
			if ( ! empty( $args['background_clip'] ) ) {

				SP_EAP::field(
					array(
						'id'      => 'background-clip',
						'type'    => 'select',
						'options' => array(
							''            => esc_html__( 'Background Clip', 'easy-accordion-pro' ),
							'border-box'  => esc_html__( 'Border Box', 'easy-accordion-pro' ),
							'padding-box' => esc_html__( 'Padding Box', 'easy-accordion-pro' ),
							'content-box' => esc_html__( 'Content Box', 'easy-accordion-pro' ),
						),
					),
					$this->value['background-clip'],
					$this->field_name(),
					'field/background'
				);

			}

			//
			// Background Blend Mode.
			if ( ! empty( $args['background_blend_mode'] ) ) {

				SP_EAP::field(
					array(
						'id'      => 'background-blend-mode',
						'type'    => 'select',
						'options' => array(
							''            => esc_html__( 'Background Blend Mode', 'easy-accordion-pro' ),
							'normal'      => esc_html__( 'Normal', 'easy-accordion-pro' ),
							'multiply'    => esc_html__( 'Multiply', 'easy-accordion-pro' ),
							'screen'      => esc_html__( 'Screen', 'easy-accordion-pro' ),
							'overlay'     => esc_html__( 'Overlay', 'easy-accordion-pro' ),
							'darken'      => esc_html__( 'Darken', 'easy-accordion-pro' ),
							'lighten'     => esc_html__( 'Lighten', 'easy-accordion-pro' ),
							'color-dodge' => esc_html__( 'Color Dodge', 'easy-accordion-pro' ),
							'saturation'  => esc_html__( 'Saturation', 'easy-accordion-pro' ),
							'color'       => esc_html__( 'Color', 'easy-accordion-pro' ),
							'luminosity'  => esc_html__( 'Luminosity', 'easy-accordion-pro' ),
						),
					),
					$this->value['background-blend-mode'],
					$this->field_name(),
					'field/background'
				);

			}

			echo '</div>';

			echo wp_kses_post( $this->field_after() );

		}

	}
}
