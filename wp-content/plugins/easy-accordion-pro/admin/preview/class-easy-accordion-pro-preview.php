<?php
/**
 * The admin preview.
 *
 * @link       https://shapedplugin.com/
 * @since      2.1.2
 *
 * @package    Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

/**
 * The admin preview.
 */
class Easy_Accordion_Pro_Preview {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.1.2
	 */
	public function __construct() {
		$this->sp_easy_accordion_preview_action();
	}

	/**
	 * Public Action
	 *
	 * @return void
	 */
	private function sp_easy_accordion_preview_action() {
		// admin Preview.
		add_action( 'wp_ajax_sp_eap_preview_meta_box', array( $this, 'sp_easy_accordion_backend_preview' ) );
	}

	/**
	 * Function Backed preview.
	 *
	 * @since 2.1.2
	 */
	public function sp_easy_accordion_backend_preview() {
		$nonce = isset( $_POST['ajax_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['ajax_nonce'] ) ) : '';
		if ( ! wp_verify_nonce( $nonce, 'eapro_metabox_nonce' ) ) {
			return;
		}

		$setting = array();
		// XSS ok.
		// No worries, This "POST" requests is sanitizing in the below array map.
		$data = ! empty( $_POST['data'] ) ? wp_unslash( $_POST['data'] )  : ''; // phpcs:ignore
		parse_str( $data, $setting );
		// Preset Layouts.
		$post_id            = $setting['post_ID'];
		$upload_data        = $setting['sp_eap_upload_options'];
		$shortcode_data     = ! empty( $setting['sp_eap_shortcode_options'] ) ? $setting['sp_eap_shortcode_options'] : array();
		$accordion_id       = $post_id;
		$main_section_title = $setting['post_title'];
		$settings           = get_option( 'sp_eap_settings' );

		/**
		 * Load dynamic style for backend preview.
		 */
		$dynamic_style = SP_EAP_Front_Scripts::load_dynamic_style( $post_id, $shortcode_data );

		/**
		 *Load Google font enqueue for the backend preview.
		 */
		$enqueue_fonts = Easy_Accordion_Pro_Shortcode::load_google_fonts( $dynamic_style['typography'] );
		if ( ! empty( $enqueue_fonts ) ) {
			echo '<link rel="stylesheet" href="' . esc_url( 'https://fonts.googleapis.com/css?family=' . implode( '|', $enqueue_fonts ) ) . '" media="all">';
		}
		echo '<style>' . wp_strip_all_tags( $dynamic_style['dynamic_css'] ) . '</style>';
		Easy_Accordion_Pro_Shortcode::sp_easy_accordion_html_show( $post_id, $settings, $upload_data, $shortcode_data, $main_section_title );
		?>
		<script src="<?php echo esc_url( SP_EAP_URL . 'public/assets/js/collapse.min.js' ); ?>" ></script>
		<script src="<?php echo esc_url( SP_EAP_URL . 'public/assets/js/script.min.js' ); ?>" ></script>
		<script src="<?php echo esc_url( SP_EAP_URL . 'public/assets/js/accordion-pagination.min.js' ); ?>" ></script>
		<?php
		die();
	}
}
new Easy_Accordion_Pro_Preview();
