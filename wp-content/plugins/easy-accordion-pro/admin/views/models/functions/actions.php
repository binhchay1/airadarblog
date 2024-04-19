<?php
/**
 * The action function of the plugin.
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

/**
 * Populate the taxonomy name list to he select option.
 *
 * @return void
 */
function sp_eap_get_taxonomies() {
	extract( $_REQUEST );// phpcs:ignore
	$taxonomy_names = get_object_taxonomies( array( 'post_type' => $eap_post_type ), 'names' );
	echo '<option value="">Select Taxonomy</option>';
	foreach ( $taxonomy_names as $key => $label ) {
		echo '<option value="' . esc_attr( $label ) . '">' . esc_html( $label ) . '</option>';
	}
	die( 0 );
}
add_action( 'wp_ajax_sp_eap_get_taxonomies', 'sp_eap_get_taxonomies' );

/**
 * Populate the taxonomy terms list to the select option.
 *
 * @return void
 */
function sp_eap_get_terms() {
	extract( $_REQUEST );// phpcs:ignore
	$terms = get_terms( $eap_post_taxonomy );
	foreach ( $terms as $key => $value ) {
		echo '<option value="' . esc_attr( $value->term_id ) . '">' . esc_html( $value->name ) . '</option>';
	}
	die( 0 );
}
add_action( 'wp_ajax_sp_eap_get_terms', 'sp_eap_get_terms' );

/**
 * Get specific post to the select box.
 *
 * @return void
 */
function sp_eap_get_posts() {
	extract( $_REQUEST );// phpcs:ignore
	$all_posts = get_posts(
		array(
			'post_type'      => $eap_post_type,
			'posts_per_page' => -1,
		)
	);
	foreach ( $all_posts as $key => $post_obj ) {
		echo '<option value="' . esc_attr( $post_obj->ID ) . '">' . esc_html( $post_obj->post_title ) . '</option>';
	}
	die( 0 );
}
add_action( 'wp_ajax_sp_eap_get_posts', 'sp_eap_get_posts' );


if ( ! function_exists( 'eapro_get_icons' ) ) {
	/**
	 *
	 * Get icons from admin ajax
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function eapro_get_icons() {

		$nonce = ( ! empty( $_POST['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

		if ( ! wp_verify_nonce( $nonce, 'eapro_icon_nonce' ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'easy-accordion-pro' ) ) );
		}

		ob_start();

		$icon_library = ( apply_filters( 'eapro_fa4', false ) ) ? 'fa4' : 'fa5';

		SP_EAP::include_plugin_file( 'fields/icon/' . $icon_library . '-icons.php' );

		$icon_lists = apply_filters( 'eapro_add_custom_icons', eapro_get_default_icons() );

		if ( ! empty( $icon_lists ) ) {

			foreach ( $icon_lists as $list ) {

				echo ( count( $icon_lists ) >= 2 ) ? '<div class="eapro-icon-title">' . esc_attr( $list['title'] ) . '</div>' : '';

				foreach ( $list['icons'] as $icon ) {
					echo '<i title="' . esc_attr( $icon ) . '" class="' . esc_attr( $icon ) . '"></i>';
				}
			}
		} else {

				echo '<div class="eapro-text-error">' . esc_html__( 'No data provided by developer', 'easy-accordion-pro' ) . '</div>';

		}

		$content = ob_get_clean();

		wp_send_json_success( array( 'content' => $content ) );
	}
	add_action( 'wp_ajax_eapro-get-icons', 'eapro_get_icons' );
}


if ( ! function_exists( 'eapro_reset_ajax' ) ) {
	/**
	 *
	 * Reset Ajax
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function eapro_reset_ajax() {

		$nonce           = ( ! empty( $_POST['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
		$unique          = ( ! empty( $_POST['unique'] ) ) ? sanitize_text_field( wp_unslash( $_POST['unique'] ) ) : '';
		$capability      = apply_filters( 'sp_easy_accordion_ui_permission', 'manage_options' );
		$is_user_capable = current_user_can( $capability ) ? true : false;

		if ( ! wp_verify_nonce( $nonce, 'eapro_backup_nonce' ) || ! $is_user_capable ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'easy-accordion-pro' ) ) );
		}

		// Success.
		delete_option( $unique );

		wp_send_json_success();
	}
	add_action( 'wp_ajax_eapro-reset', 'eapro_reset_ajax' );
}

if ( ! function_exists( 'eapro_chosen_ajax' ) ) {
	/**
	 *
	 * Chosen Ajax
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function eapro_chosen_ajax() {

		$nonce           = ( ! empty( $_POST['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
		$type            = ( ! empty( $_POST['type'] ) ) ? sanitize_text_field( wp_unslash( $_POST['type'] ) ) : '';
		$term            = ( ! empty( $_POST['term'] ) ) ? sanitize_text_field( wp_unslash( $_POST['term'] ) ) : '';
		$query = ( ! empty( $_POST['query_args'] ) ) ? wp_kses_post_deep( $_POST['query_args'] ) : array(); // phpcs:ignore
		$capability      = apply_filters( 'sp_easy_accordion_ui_permission', 'manage_options' );
		$is_user_capable = current_user_can( $capability ) ? true : false;

		if ( ! wp_verify_nonce( $nonce, 'eapro_chosen_ajax_nonce' ) || ! $is_user_capable ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'easy-accordion-pro' ) ) );
		}

		if ( empty( $type ) || empty( $term ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Missing request arguments.', 'easy-accordion-pro' ) ) );
		}

		$capability = apply_filters( 'eapro_chosen_ajax_capability', 'manage_options' );

		if ( ! current_user_can( $capability ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'You do not have required permissions to access.', 'easy-accordion-pro' ) ) );
		}

		// Success.
		$options = SP_EAP_Fields::field_data( $type, $term, $query );

		wp_send_json_success( $options );
	}
	add_action( 'wp_ajax_eapro-chosen', 'eapro_chosen_ajax' );
}

if ( ! function_exists( 'eapro_set_icons' ) ) {
	/**
	 *
	 * Set icons for wp dialog
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function eapro_set_icons() {
		$current_screen            = get_current_screen();
			$the_current_post_type = $current_screen->post_type;
		if ( 'sp_easy_accordion' === $the_current_post_type ) {
			?>
	<div id="eapro-modal-icon" class="eapro-modal eapro-modal-icon">
		<div class="eapro-modal-table">
			<div class="eapro-modal-table-cell">
				<div class="eapro-modal-overlay"></div>
				<div class="eapro-modal-inner">
			<div class="eapro-modal-title">
			<?php esc_html_e( 'Add Icon', 'easy-accordion-pro' ); ?>
				<div class="eapro-modal-close eapro-icon-close"></div>
			</div>
			<div class="eapro-modal-header eapro-text-center">
				<input type="text" placeholder="<?php esc_html_e( 'Search a Icon...', 'easy-accordion-pro' ); ?>" class="eapro-icon-search" />
			</div>
			<div class="eapro-modal-content">
				<div class="eapro-modal-loading"><div class="eapro-loading"></div></div>
				<div class="eapro-modal-load"></div>
			</div>
		</div>
		</div>
	</div>
	</div>
			<?php
		}
	}
	add_action( 'admin_footer', 'eapro_set_icons' );
}

add_filter( 'eapro_fa4', '__return_true' );
