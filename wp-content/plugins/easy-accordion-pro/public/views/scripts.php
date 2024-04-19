<?php
/**
 * The plugin uninstall file.
 *
 * @link       https://shapedplugin.com/
 * @since      2.1.2
 *
 * @package    Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/public
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

/**
 * Scripts and styles
 */
class SP_EAP_Front_Scripts {

	/**
	 * Instance.
	 *
	 * @var null
	 * @since 1.0
	 */
	protected static $_instance = null;

	/**
	 * Instance.
	 *
	 * @return SP_EAP_Front_Scripts
	 * @since 1.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Plugin Scripts and Styles
	 */
	public function front_scripts() {
		$get_page_data      = self::get_page_data();
		$found_generator_id = $get_page_data['generator_id'];
		if ( $found_generator_id ) {
			wp_enqueue_style( 'sp-ea-font-awesome' );
			wp_enqueue_style( 'sp-ea-animation' );
			wp_enqueue_style( 'sp-ea-style' );
			// Dynamic style load.
			$dynamic_style = self::load_dynamic_style( $found_generator_id );
			$enqueue_fonts = Easy_Accordion_Pro_Shortcode::load_google_fonts( $dynamic_style['typography'] );
			if ( ! empty( $enqueue_fonts ) ) {
				wp_enqueue_style( 'sp-eap-google-fonts', 'https://fonts.googleapis.com/css?family=' . implode( '|', $enqueue_fonts ), array(), SP_EAP_VERSION );
			}
			wp_add_inline_style( 'sp-ea-style', $dynamic_style['dynamic_css'] );
		}
	}
	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    2.0
	 */
	public function register_all_scripts() {
		$prefix                    = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';
		$settings                  = get_option( 'sp_eap_settings' );
		$eap_dequeue_animation_css = isset( $settings['eap_dequeue_animation_css'] ) ? $settings['eap_dequeue_animation_css'] : '';
		$eap_dequeue_fa_css        = isset( $settings['eap_dequeue_fa_css'] ) ? $settings['eap_dequeue_fa_css'] : true;

		if ( $eap_dequeue_fa_css ) {
			wp_register_style( 'sp-ea-font-awesome', SP_EAP_URL . 'public/assets/css/font-awesome.min.css', array(), SP_EAP_VERSION );
		}
		if ( $eap_dequeue_animation_css ) {
			wp_register_style( 'sp-ea-animation', SP_EAP_URL . 'public/assets/css/animate' . $prefix . '.css', array(), SP_EAP_VERSION );
		}
		wp_register_style( 'sp-ea-style', SP_EAP_URL . 'public/assets/css/ea-style' . $prefix . '.css', array(), SP_EAP_VERSION );

		// Accordion frontend scripts.
		wp_register_script( 'sp-ea-accordion-js', SP_EAP_URL . 'public/assets/js/collapse' . $prefix . '.js', array( 'jquery' ), SP_EAP_VERSION, false );
		wp_register_script( 'sp-ea-autocomplete-js', SP_EAP_URL . 'public/assets/js/autocomplete.min.js', array( 'jquery' ), SP_EAP_VERSION, false );
		wp_register_script( 'sp-ea-accordion-pagination', SP_EAP_URL . 'public/assets/js/accordion-pagination.js', array( 'jquery' ), SP_EAP_VERSION, true );
		wp_register_script( 'sp-ea-accordion-config', SP_EAP_URL . 'public/assets/js/script.js', array( 'jquery', 'sp-ea-accordion-js' ), SP_EAP_VERSION, true );

		$ea_custom_js = isset( $settings['custom_js'] ) ? trim( html_entity_decode( $settings['custom_js'] ) ) : '';
		if ( ! empty( $ea_custom_js ) ) {
			wp_add_inline_script( 'sp-ea-accordion-config', $ea_custom_js );
		}
	}
	/**
	 * Plugin admin live preview Scripts and Styles
	 */
	public function admin_scripts() {
		// CSS Files.
		$current_screen        = get_current_screen();
		$the_current_post_type = $current_screen->post_type;
		if ( 'sp_easy_accordion' === $the_current_post_type ) {
			wp_enqueue_style( 'sp-ea-font-awesome' );
			wp_enqueue_style( 'sp-ea-animation' );
			wp_enqueue_style( 'sp-ea-style' );

			wp_enqueue_script( 'sp-ea-accordion-pagination' );
		}
	}

	/**
	 * Load dynamic style based on shortcode id.
	 *
	 * @param  mixed $found_generator_id to push id option for getting how many shortcode in the page.
	 * @param  mixed $shortcode_data to push all options.
	 * @return array dynamic style and typography use in the specific shortcode.
	 */
	public static function load_dynamic_style( $found_generator_id, $shortcode_data = '' ) {
		$ea_dynamic_css   = '';
		$eapro_typography = array();
		// If multiple shortcode found in the page.
		if ( is_array( $found_generator_id ) ) {
			foreach ( $found_generator_id  as $accordion_id ) {
				if ( $accordion_id && is_numeric( $accordion_id ) && get_post_status( $accordion_id ) !== 'trash' ) {
					$shortcode_data = get_post_meta( $accordion_id, 'sp_eap_shortcode_options', true );
					include SP_EAP_PATH . 'public/dynamic-style.php';
				}
			}
		} else {
			// If single shortcode found in the page.
			$accordion_id = $found_generator_id;
			include SP_EAP_PATH . 'public/dynamic-style.php';
		}
		// Custom css merge with dynamic style.
		$custom_css = isset( $settings['ea_custom_css'] ) ? trim( html_entity_decode( $settings['ea_custom_css'] ) ) : '';

		// Focus style to improve accessibility.
		$focus_style = isset( $settings['eap_focus_style'] ) ? $settings['eap_focus_style'] : false;
		if ( $focus_style ) {
			$ea_dynamic_css .= '.sp-easy-accordion .ea-header  a:focus,
			.sp-horizontal-accordion .ea-header  a:focus{
				box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
			}';
		}
		if ( ! empty( $custom_css ) ) {
			$ea_dynamic_css .= $custom_css;
		}
		// Google font enqueue dequeue check.
		$eapro_typography = $eap_dequeue_google_font ? $eapro_typography : array();
		$dynamic_style    = array(
			'dynamic_css' => Easy_Accordion_Pro_Shortcode::minify_output( $ea_dynamic_css ),
			'typography'  => $eapro_typography,
		);
		return $dynamic_style;
	}

	/**
	 * Gets all shortcode-id, page-id and option-key from the page.
	 *
	 * @return array
	 */
	public static function get_page_data() {
		$current_page_id    = get_queried_object_id();
		$option_key         = 'easy_accordion_page_id' . $current_page_id;
		$found_generator_id = get_option( $option_key );
		if ( is_multisite() ) {
			$option_key         = 'easy_accordion_page_id' . get_current_blog_id() . $current_page_id;
			$found_generator_id = get_site_option( $option_key );
		}
		$get_page_data = array(
			'page_id'      => $current_page_id,
			'generator_id' => $found_generator_id,
			'option_key'   => $option_key,
		);
		return $get_page_data;
	}

	/**
	 * If the option does not exist, it will be created.
	 *
	 * It will be serialized before it is inserted into the database.
	 *
	 * @param  string $post_id shortcode id.
	 * @param  array  $get_page_data get current page-id, shortcode-id and option-key from the page.
	 * @return void
	 */
	public static function eap_update_options( $post_id, $get_page_data ) {
		$found_generator_id = $get_page_data['generator_id'];
		$option_key         = $get_page_data['option_key'];
		$current_page_id    = $get_page_data['page_id'];
		if ( $found_generator_id ) {
			$found_generator_id = is_array( $found_generator_id ) ? $found_generator_id : array( $found_generator_id );
			if ( ! in_array( $post_id, $found_generator_id ) || empty( $found_generator_id ) ) {
				// If not found the shortcode id in the page options.
				array_push( $found_generator_id, $post_id );
				if ( is_multisite() ) {
					update_site_option( $option_key, $found_generator_id );
				} else {
					update_option( $option_key, $found_generator_id );
				}
			}
		} else {
			// If option not set in current page add option.
			if ( $current_page_id ) {
				if ( is_multisite() ) {
					add_site_option( $option_key, array( $post_id ) );
				} else {
					add_option( $option_key, array( $post_id ) );
				}
			}
		}
	}
}
