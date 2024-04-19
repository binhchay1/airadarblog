<?php
/**
 * The typography field of the plugin.
 *
 * @link https://shapedplugin.com
 *
 * @package Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'SP_EAP_Field_typography' ) ) {
	/**
	 * SP_EAP_Field_typography
	 */
	class SP_EAP_Field_typography extends SP_EAP_Fields {

		/**
		 * Chosen
		 *
		 * @var bool
		 */
		public $chosen = false;

		/**
		 * Value
		 *
		 * @var array
		 */
		public $value = array();

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

			echo wp_kses_post( $this->field_before() );

			$args = wp_parse_args(
				$this->field,
				array(
					'font_family'        => true,
					'font_weight'        => true,
					'font_style'         => true,
					'font_size'          => true,
					'line_height'        => true,
					'letter_spacing'     => true,
					'text_align'         => true,
					'text_transform'     => true,
					'color'              => true,
					'hover_color'        => false,
					'active_color'       => false,
					'chosen'             => true,
					'preview'            => true,
					'subset'             => true,
					'multi_subset'       => false,
					'extra_styles'       => false,
					'backup_font_family' => false,
					'font_variant'       => false,
					'word_spacing'       => false,
					'text_decoration'    => false,
					'custom_style'       => false,
					'margin_bottom'      => false,
					'exclude'            => '',
					'unit'               => 'px',
					'line_height_unit'   => '',
					'preview_text'       => 'The quick brown fox jumps over the lazy dog',
				)
			);

			$default_value = array(
				'font-family'        => '',
				'font-weight'        => '',
				'font-style'         => '',
				'font-variant'       => '',
				'font-size'          => '',
				'line-height'        => '',
				'letter-spacing'     => '',
				'word-spacing'       => '',
				'text-align'         => '',
				'text-transform'     => '',
				'text-decoration'    => '',
				'backup-font-family' => '',
				'color'              => '',
				'hover_color'        => '',
				'active_color'       => '',
				'custom-style'       => '',
				'type'               => '',
				'subset'             => '',
				'margin-bottom'      => '',
				'extra-styles'       => array(),
			);

			$default_value    = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;
			$this->value      = wp_parse_args( $this->value, $default_value );
			$this->chosen     = $args['chosen'];
			$chosen_class     = ( $this->chosen ) ? ' eapro--chosen' : '';
			$line_height_unit = ( ! empty( $args['line_height_unit'] ) ) ? $args['line_height_unit'] : $args['unit'];

			echo '<div class="eapro--typography' . esc_attr( $chosen_class ) . '" data-unit="' . esc_attr( $args['unit'] ) . '" data-line-height-unit="' . esc_attr( $line_height_unit ) . '" data-exclude="' . esc_attr( $args['exclude'] ) . '">';

			echo '<div class="eapro--blocks eapro--blocks-selects">';

			//
			// Font Family.
			if ( ! empty( $args['font_family'] ) ) {
				echo '<div class="eapro--block">';
				echo '<div class="eapro--title">' . esc_html__( 'Font Family', 'easy-accordion-pro' ) . '</div>';
				echo $this->create_select( array( $this->value['font-family'] => $this->value['font-family'] ), 'font-family', esc_html__( 'Select a font', 'easy-accordion-pro' ) );//phpcs:ignore
				echo '</div>';
			}

			//
			// Backup Font Family.
			if ( ! empty( $args['backup_font_family'] ) ) {
				echo '<div class="eapro--block eapro--block-backup-font-family hidden">';
				echo '<div class="eapro--title">' . esc_html__( 'Backup Font Family', 'easy-accordion-pro' ) . '</div>';
				//phpcs:ignore
				echo $this->create_select(
					apply_filters(
						'eapro_field_typography_backup_font_family',
						array(
							'Arial, Helvetica, sans-serif',
							"'Arial Black', Gadget, sans-serif",
							"'Comic Sans MS', cursive, sans-serif",
							'Impact, Charcoal, sans-serif',
							"'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
							'Tahoma, Geneva, sans-serif',
							"'Trebuchet MS', Helvetica, sans-serif'",
							'Verdana, Geneva, sans-serif',
							"'Courier New', Courier, monospace",
							"'Lucida Console', Monaco, monospace",
							'Georgia, serif',
							'Palatino Linotype',
						)
					),
					'backup-font-family',
					esc_html__( 'Default', 'easy-accordion-pro' )
				);
				echo '</div>';
			}

			//
			// Font Style and Extra Style Select.
			if ( ! empty( $args['font_weight'] ) || ! empty( $args['font_style'] ) ) {

				//
				// Font Style Select.
				echo '<div class="eapro--block eapro--block-font-style hidden">';
				echo '<div class="eapro--title">' . esc_html__( 'Font Style', 'easy-accordion-pro' ) . '</div>';
				echo '<select class="eapro--font-style-select" data-placeholder="Default">';
				echo '<option value="">' . ( ! $this->chosen ? esc_html__( 'Default', 'easy-accordion-pro' ) : '' ) . '</option>';//phpcs:ignore
				if ( ! empty( $this->value['font-weight'] ) || ! empty( $this->value['font-style'] ) ) {
					echo '<option value="' . esc_attr( strtolower( $this->value['font-weight'] . $this->value['font-style'] ) ) . '" selected></option>';
				}
				echo '</select>';
				echo '<input type="hidden" name="' . esc_attr( $this->field_name( '[font-weight]' ) ) . '" class="eapro--font-weight" value="' . esc_attr( $this->value['font-weight'] ) . '" />';
				echo '<input type="hidden" name="' . esc_attr( $this->field_name( '[font-style]' ) ) . '" class="eapro--font-style" value="' . esc_attr( $this->value['font-style'] ) . '" />';

				//
				// Extra Font Style Select.
				if ( ! empty( $args['extra_styles'] ) ) {
					echo '<div class="eapro--block-extra-styles hidden">';
					echo ( ! $this->chosen ) ? '<div class="eapro--title">' . esc_html__( 'Load Extra Styles', 'easy-accordion-pro' ) . '</div>' : '';
					$placeholder = ( $this->chosen ) ? esc_html__( 'Load Extra Styles', 'easy-accordion-pro' ) : esc_html__( 'Default', 'easy-accordion-pro' );
					echo $this->create_select( $this->value['extra-styles'], 'extra-styles', $placeholder, true );//phpcs:ignore
					echo '</div>';
				}

				echo '</div>';

			}

			//
			// Subset.
			if ( ! empty( $args['subset'] ) ) {
				echo '<div class="eapro--block eapro--block-subset hidden">';
				echo '<div class="eapro--title">' . esc_html__( 'Subset', 'easy-accordion-pro' ) . '</div>';
				$subset = ( is_array( $this->value['subset'] ) ) ? $this->value['subset'] : array_filter( (array) $this->value['subset'] );
				echo $this->create_select( $subset, 'subset', esc_html__( 'Default', 'easy-accordion-pro' ), $args['multi_subset'] );//phpcs:ignore
				echo '</div>';
			}

			//
			// Text Align.
			if ( ! empty( $args['text_align'] ) ) {
				echo '<div class="eapro--block">';
				echo '<div class="eapro--title">' . esc_html__( 'Text Align', 'easy-accordion-pro' ) . '</div>';
				//phpcs:ignore
				echo $this->create_select(
					array(
						'inherit' => esc_html__( 'Inherit', 'easy-accordion-pro' ),
						'left'    => esc_html__( 'Left', 'easy-accordion-pro' ),
						'center'  => esc_html__( 'Center', 'easy-accordion-pro' ),
						'right'   => esc_html__( 'Right', 'easy-accordion-pro' ),
						'justify' => esc_html__( 'Justify', 'easy-accordion-pro' ),
						'initial' => esc_html__( 'Initial', 'easy-accordion-pro' ),
					),
					'text-align',
					esc_html__( 'Default', 'easy-accordion-pro' )
				);
				echo '</div>';
			}

			//
			// Font Variant.
			if ( ! empty( $args['font_variant'] ) ) {
				echo '<div class="eapro--block">';
				echo '<div class="eapro--title">' . esc_html__( 'Font Variant', 'easy-accordion-pro' ) . '</div>';
				//phpcs:ignore
				echo $this->create_select(
					array(
						'normal'         => esc_html__( 'Normal', 'easy-accordion-pro' ),
						'small-caps'     => esc_html__( 'Small Caps', 'easy-accordion-pro' ),
						'all-small-caps' => esc_html__( 'All Small Caps', 'easy-accordion-pro' ),
					),
					'font-variant',
					esc_html__( 'Default', 'easy-accordion-pro' )
				);
				echo '</div>';
			}

			//
			// Text Transform.
			if ( ! empty( $args['text_transform'] ) ) {
				echo '<div class="eapro--block">';
				echo '<div class="eapro--title">' . esc_html__( 'Text Transform', 'easy-accordion-pro' ) . '</div>';
				//phpcs:ignore
				echo $this->create_select(
					array(
						'none'       => esc_html__( 'None', 'easy-accordion-pro' ),
						'capitalize' => esc_html__( 'Capitalize', 'easy-accordion-pro' ),
						'uppercase'  => esc_html__( 'Uppercase', 'easy-accordion-pro' ),
						'lowercase'  => esc_html__( 'Lowercase', 'easy-accordion-pro' ),
					),
					'text-transform',
					esc_html__( 'Default', 'easy-accordion-pro' )
				);
				echo '</div>';
			}

			//
			// Text Decoration.
			if ( ! empty( $args['text_decoration'] ) ) {
				echo '<div class="eapro--block">';
				echo '<div class="eapro--title">' . esc_html__( 'Text Decoration', 'easy-accordion-pro' ) . '</div>';
				//phpcs:ignore
				echo $this->create_select(
					array(
						'none'               => esc_html__( 'None', 'easy-accordion-pro' ),
						'underline'          => esc_html__( 'Solid', 'easy-accordion-pro' ),
						'underline double'   => esc_html__( 'Double', 'easy-accordion-pro' ),
						'underline dotted'   => esc_html__( 'Dotted', 'easy-accordion-pro' ),
						'underline dashed'   => esc_html__( 'Dashed', 'easy-accordion-pro' ),
						'underline wavy'     => esc_html__( 'Wavy', 'easy-accordion-pro' ),
						'underline overline' => esc_html__( 'Overline', 'easy-accordion-pro' ),
						'line-through'       => esc_html__( 'Line-through', 'easy-accordion-pro' ),
					),
					'text-decoration',
					esc_html__( 'Default', 'easy-accordion-pro' )
				);
				echo '</div>';
			}

			echo '</div>';

			echo '<div class="eapro--blocks eapro--blocks-inputs">';

			//
			// Font Size.
			if ( ! empty( $args['font_size'] ) ) {
				echo '<div class="eapro--block">';
				echo '<div class="eapro--title">' . esc_html__( 'Font Size', 'easy-accordion-pro' ) . '</div>';
				echo '<div class="eapro--input-wrap">';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[font-size]' ) ) . '" class="eapro--font-size eapro--input eapro-input-number" value="' . esc_attr( $this->value['font-size'] ) . '" />';
				echo '<span class="eapro--unit">' . esc_attr( $args['unit'] ) . '</span>';
				echo '</div>';
				echo '</div>';
			}

			//
			// Line Height.
			if ( ! empty( $args['line_height'] ) ) {
				echo '<div class="eapro--block">';
				echo '<div class="eapro--title">' . esc_html__( 'Line Height', 'easy-accordion-pro' ) . '</div>';
				echo '<div class="eapro--input-wrap">';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[line-height]' ) ) . '" class="eapro--line-height eapro--input eapro-input-number" value="' . esc_attr( $this->value['line-height'] ) . '" />';
				echo '<span class="eapro--unit">' . esc_attr( $line_height_unit ) . '</span>';
				echo '</div>';
				echo '</div>';
			}

			//
			// Letter Spacing.
			if ( ! empty( $args['letter_spacing'] ) ) {
				echo '<div class="eapro--block">';
				echo '<div class="eapro--title">' . esc_html__( 'Letter Spacing', 'easy-accordion-pro' ) . '</div>';
				echo '<div class="eapro--input-wrap">';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[letter-spacing]' ) ) . '" class="eapro--letter-spacing eapro--input eapro-input-number" value="' . esc_attr( $this->value['letter-spacing'] ) . '" />';
				echo '<span class="eapro--unit">' . esc_attr( $args['unit'] ) . '</span>';
				echo '</div>';
				echo '</div>';
			}

			//
			// Word Spacing.
			if ( ! empty( $args['word_spacing'] ) ) {
				echo '<div class="eapro--block">';
				echo '<div class="eapro--title">' . esc_html__( 'Word Spacing', 'easy-accordion-pro' ) . '</div>';
				echo '<div class="eapro--input-wrap">';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[word-spacing]' ) ) . '" class="eapro--word-spacing eapro--input eapro-input-number" value="' . esc_attr( $this->value['word-spacing'] ) . '" />';
				echo '<span class="eapro--unit">' . esc_attr( $args['unit'] ) . '</span>';
				echo '</div>';
				echo '</div>';
			}

			echo '</div>';

			echo '<div class="eapro--blocks eapro--blocks-colors">';
			//
			// Color.
			if ( ! empty( $args['color'] ) ) {
				$default_color_attr = ( ! empty( $default_value['color'] ) ) ? ' data-default-color="' . esc_attr( $default_value['color'] ) . '"' : '';
				echo '<div class="eapro--block eapro--block-font-color">';
				echo '<div class="eapro--title">' . esc_html__( 'Color', 'easy-accordion-pro' ) . '</div>';
				echo '<div class="eapro-field-color">';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[color]' ) ) . '" class="eapro-color eapro--color" value="' . esc_attr( $this->value['color'] ) . '"' . $default_color_attr . ' />';//phpcs:ignore
				echo '</div>';
				echo '</div>';
			}

			//
			// Active Color.
			if ( ! empty( $args['active_color'] ) ) {
				$default_color_attr = ( ! empty( $default_value['active_color'] ) ) ? ' data-default-color="' . esc_attr( $default_value['active_color'] ) . '"' : '';
				echo '<div class="eapro--block eapro--block-font-color">';
				echo '<div class="eapro--title">' . esc_html__( 'Active Color', 'easy-accordion-pro' ) . '</div>';
				echo '<div class="eapro-field-color">';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[active_color]' ) ) . '" class="eapro-color eapro--color" value="' . esc_attr( $this->value['active_color'] ) . '"' . $default_color_attr . ' />';//phpcs:ignore
				echo '</div>';
				echo '</div>';
			}

			//
			// Hover Color.
			if ( ! empty( $args['hover_color'] ) ) {
				$default_color_attr = ( ! empty( $default_value['hover_color'] ) ) ? ' data-default-color="' . esc_attr( $default_value['hover_color'] ) . '"' : '';
				echo '<div class="eapro--block eapro--block-font-color">';
				echo '<div class="eapro--title">' . esc_html__( 'Hover Color', 'easy-accordion-pro' ) . '</div>';
				echo '<div class="eapro-field-color">';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[hover_color]' ) ) . '" class="eapro-color eapro--color" value="' . esc_attr( $this->value['hover_color'] ) . '"' . $default_color_attr . ' />';//phpcs:ignore
				echo '</div>';
				echo '</div>';
			}
			// Margin Bottom.
			if ( ! empty( $args['margin_bottom'] ) ) {
				echo '<div class="eapro--block eapro--block-margin">';
				echo '<div class="eapro--title">' . esc_html__( 'Margin Bottom', 'easy-accordion-pro' ) . '</div>';
				echo '<div class="eapro--blocks lw-typo-margin">';
				echo '<div class="eapro--block eapro--unit icon"><i class="fa fa-long-arrow-down"></i></div>';
				echo '<div class="eapro--block"><input type="number" name="' . esc_attr( $this->field_name( '[margin-bottom]' ) ) . '" class="eapro--margin-bottom eapro--input eapro-number" value="' . esc_attr( $this->value['margin-bottom'] ) . '" /></div>';
				echo '<div class="eapro--block eapro--unit">' . esc_html( $args['unit'] ) . '</div>';
				echo '</div>';
				echo '</div>';
			}
			echo '</div>';

			//
			// Custom style.
			if ( ! empty( $args['custom_style'] ) ) {
				echo '<div class="eapro--block eapro--block-custom-style">';
				echo '<div class="eapro--title">' . esc_html__( 'Custom Style', 'easy-accordion-pro' ) . '</div>';
				echo '<textarea name="' . esc_attr( $this->field_name( '[custom-style]' ) ) . '" class="eapro--custom-style">' . esc_attr( $this->value['custom-style'] ) . '</textarea>';
				echo '</div>';
			}

			//
			// Preview.
			$always_preview = ( 'always' !== $args['preview'] ) ? ' hidden' : '';

			if ( ! empty( $args['preview'] ) ) {
				echo '<div class="eapro--block eapro--block-preview' . esc_attr( $always_preview ) . '">';
				echo '<div class="eapro--toggle fa fa-toggle-off"></div>';
				echo '<div class="eapro--preview">' . esc_attr( $args['preview_text'] ) . '</div>';
				echo '</div>';
			}

			echo '<input type="hidden" name="' . esc_attr( $this->field_name( '[type]' ) ) . '" class="eapro--type" value="' . esc_attr( $this->value['type'] ) . '" />';
			echo '<input type="hidden" name="' . esc_attr( $this->field_name( '[unit]' ) ) . '" class="eapro--unit-save" value="' . esc_attr( $args['unit'] ) . '" />';

			echo '</div>';

			echo wp_kses_post( $this->field_after() );

		}

		/**
		 * Create_select
		 *
		 * @param  mixed $options options.
		 * @param  mixed $name name.
		 * @param  mixed $placeholder placeholder.
		 * @param  mixed $is_multiple check multiple.
		 * @return statement
		 */
		public function create_select( $options, $name, $placeholder = '', $is_multiple = false ) {

			$multiple_name = ( $is_multiple ) ? '[]' : '';
			$multiple_attr = ( $is_multiple ) ? ' multiple data-multiple="true"' : '';
			$chosen_rtl    = ( $this->chosen && is_rtl() ) ? ' chosen-rtl' : '';

			$output  = '<select name="' . esc_attr( $this->field_name( '[' . $name . ']' . $multiple_name ) ) . '" class="eapro--' . esc_attr( $name ) . esc_attr( $chosen_rtl ) . '" data-placeholder="' . esc_attr( $placeholder ) . '"' . $multiple_attr . '>';
			$output .= ( ! empty( $placeholder ) ) ? '<option value="">' . esc_attr( ( ! $this->chosen ) ? $placeholder : '' ) . '</option>' : '';

			if ( ! empty( $options ) ) {
				foreach ( $options as $option_key => $option_value ) {
					if ( $is_multiple ) {
						$selected = ( in_array( $option_value, $this->value[ $name ] ) ) ? ' selected' : '';
						$output  .= '<option value="' . esc_attr( $option_value ) . '"' . esc_attr( $selected ) . '>' . esc_attr( $option_value ) . '</option>';
					} else {
						$option_key = ( is_numeric( $option_key ) ) ? $option_value : $option_key;
						$selected   = ( $option_key === $this->value[ $name ] ) ? ' selected' : '';
						$output    .= '<option value="' . esc_attr( $option_key ) . '"' . esc_attr( $selected ) . '>' . esc_attr( $option_value ) . '</option>';
					}
				}
			}

			$output .= '</select>';

			return $output;

		}

		/**
		 * Enqueue
		 *
		 * @return void
		 */
		public function enqueue() {

			if ( ! wp_script_is( 'eapro-webfontloader' ) ) {

				SP_EAP::include_plugin_file( 'fields/typography/google-fonts.php' );

				wp_enqueue_script( 'eapro-webfontloader', 'https://cdn.jsdelivr.net/npm/webfontloader@1.6.28/webfontloader.min.js', array( 'eapro' ), '1.6.28', true );

				$webfonts = array();

				$customwebfonts = apply_filters( 'eapro_field_typography_customwebfonts', array() );

				if ( ! empty( $customwebfonts ) ) {
					$webfonts['custom'] = array(
						'label' => esc_html__( 'Custom Web Fonts', 'easy-accordion-pro' ),
						'fonts' => $customwebfonts,
					);
				}

				$webfonts['safe'] = array(
					'label' => esc_html__( 'Safe Web Fonts', 'easy-accordion-pro' ),
					'fonts' => apply_filters(
						'eapro_field_typography_safewebfonts',
						array(
							'Arial',
							'Arial Black',
							'Helvetica',
							'Times New Roman',
							'Courier New',
							'Tahoma',
							'Verdana',
							'Impact',
							'Trebuchet MS',
							'Comic Sans MS',
							'Lucida Console',
							'Lucida Sans Unicode',
							'Georgia, serif',
							'Palatino Linotype',
						)
					),
				);

				$webfonts['google'] = array(
					'label' => esc_html__( 'Google Web Fonts', 'easy-accordion-pro' ),
					'fonts' => apply_filters(
						'eapro_field_typography_googlewebfonts',
						eapro_get_google_fonts()
					),
				);

				$defaultstyles = apply_filters( 'eapro_field_typography_defaultstyles', array( 'normal', 'italic', '700', '700italic' ) );

				$googlestyles = apply_filters(
					'eapro_field_typography_googlestyles',
					array(
						'100'       => 'Thin 100',
						'100italic' => 'Thin 100 Italic',
						'200'       => 'Extra-Light 200',
						'200italic' => 'Extra-Light 200 Italic',
						'300'       => 'Light 300',
						'300italic' => 'Light 300 Italic',
						'normal'    => 'Normal 400',
						'italic'    => 'Normal 400 Italic',
						'500'       => 'Medium 500',
						'500italic' => 'Medium 500 Italic',
						'600'       => 'Semi-Bold 600',
						'600italic' => 'Semi-Bold 600 Italic',
						'700'       => 'Bold 700',
						'700italic' => 'Bold 700 Italic',
						'800'       => 'Extra-Bold 800',
						'800italic' => 'Extra-Bold 800 Italic',
						'900'       => 'Black 900',
						'900italic' => 'Black 900 Italic',
					)
				);

				$webfonts = apply_filters( 'eapro_field_typography_webfonts', $webfonts );

				wp_localize_script(
					'eapro',
					'eapro_typography_json',
					array(
						'webfonts'      => $webfonts,
						'defaultstyles' => $defaultstyles,
						'googlestyles'  => $googlestyles,
					)
				);

			}

		}

		/**
		 * Enqueue_google_fonts
		 *
		 * @return statement
		 */
		public function enqueue_google_fonts() {

			$value     = $this->value;
			$families  = array();
			$is_google = false;

			if ( ! empty( $this->value['type'] ) ) {
				$is_google = ( 'google' === $this->value['type'] ) ? true : false;
			} else {
				SP_EAP::include_plugin_file( 'fields/typography/google-fonts.php' );
				$is_google = ( array_key_exists( $this->value['font-family'], eapro_get_google_fonts() ) ) ? true : false;
			}

			if ( $is_google ) {

				// set style.
				$font_weight = ( ! empty( $value['font-weight'] ) ) ? $value['font-weight'] : '';
				$font_style  = ( ! empty( $value['font-style'] ) ) ? $value['font-style'] : '';

				if ( $font_weight || $font_style ) {
					$style                       = $font_weight . $font_style;
					$families['style'][ $style ] = $style;
				}

				// set extra styles.
				if ( ! empty( $value['extra-styles'] ) ) {
					foreach ( $value['extra-styles'] as $extra_style ) {
						$families['style'][ $extra_style ] = $extra_style;
					}
				}

				// set subsets.
				if ( ! empty( $value['subset'] ) ) {
					$value['subset'] = ( is_array( $value['subset'] ) ) ? $value['subset'] : array_filter( (array) $value['subset'] );
					foreach ( $value['subset'] as $subset ) {
						$families['subset'][ $subset ] = $subset;
					}
				}

				$all_styles  = ( ! empty( $families['style'] ) ) ? ':' . implode( ',', $families['style'] ) : '';
				$all_subsets = ( ! empty( $families['subset'] ) ) ? ':' . implode( ',', $families['subset'] ) : '';

				$families = $this->value['font-family'] . str_replace( array( 'normal', 'italic' ), array( 'n', 'i' ), $all_styles ) . $all_subsets;

				$this->parent->typographies[] = $families;

				return $families;

			}

			return false;

		}
	}
}
