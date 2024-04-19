<?php
/**
 * The plugin gutenberg block Initializer.
 *
 * @link       https://shapedplugin.com/
 * @since      2.4.1
 *
 * @package    Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/Admin
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Easy_Accordion_Pro_Gutenberg_Block_Init' ) ) {
	/**
	 * Easy_Accordion_Pro_Gutenberg_Block_Init class.
	 */
	class Easy_Accordion_Pro_Gutenberg_Block_Init {
		/**
		 * Script and style suffix
		 *
		 * @since 2.4.1
		 * @access protected
		 * @var string
		 */
		protected $suffix;
		/**
		 * Custom Gutenberg Block Initializer.
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'sp_easy_accordion_pro_gutenberg_shortcode_block' ) );
			add_action( 'enqueue_block_editor_assets', array( $this, 'sp_easy_accordion_pro_block_editor_assets' ) );
		}

		/**
		 * Register block editor script for backend.
		 */
		public function sp_easy_accordion_pro_block_editor_assets() {
			wp_enqueue_script(
				'sp-easy-accordion-pro-shortcode-block',
				plugins_url( '/GutenbergBlock/build/index.js', dirname( __FILE__ ) ),
				array( 'jquery' ),
				SP_EAP_VERSION,
				true
			);

			/**
			 * Register block editor css file enqueue for backend.
			 */
			wp_enqueue_style( 'sp-ea-font-awesome' );
			wp_enqueue_style( 'sp-ea-animation' );
			wp_enqueue_style( 'sp-ea-style' );
		}
		/**
		 * Shortcode list.
		 *
		 * @return array
		 */
		public function sp_easy_accordion_pro_post_list() {
			$shortcodes = get_posts(
				array(
					'post_type'      => 'sp_easy_accordion',
					'post_status'    => 'publish',
					'posts_per_page' => 9999,
				)
			);

			if ( count( $shortcodes ) < 1 ) {
				return array();
			}

			return array_map(
				function ( $shortcode ) {
						return (object) array(
							'id'    => absint( $shortcode->ID ),
							'title' => esc_html( $shortcode->post_title ),
						);
				},
				$shortcodes
			);
		}

		/**
		 * Register Gutenberg shortcode block.
		 */
		public function sp_easy_accordion_pro_gutenberg_shortcode_block() {
			/**
			 * Register block editor js file enqueue for backend.
			 */
			$prefix = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';
			wp_register_script( 'sp-ea-accordion-config', SP_EAP_URL . 'public/assets/js/script.js', array( 'jquery', 'sp-ea-accordion-js' ), SP_EAP_VERSION, true );

			wp_localize_script(
				'sp-ea-accordion-config',
				'sp_easy_accordion_pro',
				array(
					'url'                  => SP_EAP_URL,
					'loadScript'           => SP_EAP_URL . 'public/assets/js/script.js',
					'loadPaginationScript' => SP_EAP_URL . 'public/assets/js/accordion-pagination.js',
					'link'                 => admin_url( 'post-new.php?post_type=sp_easy_accordion' ),
					'shortCodeList'        => $this->sp_easy_accordion_pro_post_list(),
				)
			);
			wp_localize_script(
				'sp-ea-accordion-config',
				'sp_eap_ajax_obj',
				array(
					'ajax_url'   => admin_url( 'admin-ajax.php' ),
					'nonce'      => wp_create_nonce( 'sp_eap_nonce' ),
					'loadScript' => SP_EAP_URL . 'public/assets/js/script.js',
				)
			);

			/**
			 * Register Gutenberg block on server-side.
			 */
			register_block_type(
				'sp-easy-accordion-pro/shortcode',
				array(
					'attributes'      => array(
						'shortcode'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'showInputShortcode' => array(
							'type'    => 'boolean',
							'default' => true,
						),
						'preview'            => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'is_admin'           => array(
							'type'    => 'boolean',
							'default' => is_admin(),
						),
					),
					'example'         => array(
						'attributes' => array(
							'preview' => true,
						),
					),
					// Enqueue blocks.editor.build.js in the editor only.
					'editor_script'   => array(
						'sp-ea-accordion-js',
						'sp-ea-accordion-pagination',
						'sp-ea-accordion-config',
					),
					// Enqueue blocks.editor.build.css in the editor only.
					'editor_style'    => array(),
					'render_callback' => array( $this, 'sp_easy_accordion_pro_render_shortcode' ),
				)
			);
		}

		/**
		 * Render callback.
		 *
		 * @param string $attributes Shortcode.
		 * @return string
		 */
		public function sp_easy_accordion_pro_render_shortcode( $attributes ) {

			$class_name = '';
			if ( ! empty( $attributes['className'] ) ) {
				$class_name = 'class="' . esc_attr( $attributes['className'] ) . '"';
			}

			if ( ! $attributes['is_admin'] ) {
				return '<div ' . $class_name . '>' . do_shortcode( '[sp_easyaccordion id="' . sanitize_text_field( $attributes['shortcode'] ) . '"]' ) . '</div>';
			}

			// Load Dynamic style for gutenberg edit page.
			$accordion_id   = esc_attr( (int) $attributes['shortcode'] );
			$shortcode_data = get_post_meta( $accordion_id, 'sp_eap_shortcode_options', true );
			$dynamic_style  = SP_EAP_Front_Scripts::load_dynamic_style( $accordion_id, $shortcode_data );
			$style          = '';

			// Load Google font for the gutenberg edit page.
			$enqueue_fonts = Easy_Accordion_Pro_Shortcode::load_google_fonts( $dynamic_style['typography'] );
			if ( ! empty( $enqueue_fonts ) ) {
				$style .= '<link rel="stylesheet" href="' . esc_url( 'https://fonts.googleapis.com/css?family=' . implode( '|', $enqueue_fonts ) ) . '" media="all">';
			}// Google font enqueue dequeue.
			$edit_page_link = get_edit_post_link( sanitize_text_field( $accordion_id ) );

			return $style . '<div id="' . uniqid() . '" ' . $class_name . ' ><a href="' . $edit_page_link . '" target="_blank" class="sp_easy_accordion_edit_button">Edit View</a>' . do_shortcode( '[sp_easyaccordion id="' . sanitize_text_field( $accordion_id ) . '"]' ) . '</div>';
		}
	}
}
