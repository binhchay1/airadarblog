<?php
/**
 * The license field of the plugin.
 *
 * @link https://shapedplugin.com
 *
 * @package Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'SP_EAP_Field_license' ) ) {
	/**
	 * SP_EAP_Field_license
	 */
	class SP_EAP_Field_license extends SP_EAP_Fields {

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
			$type = ( ! empty( $this->field['attributes']['type'] ) ) ? $this->field['attributes']['type'] : 'text';

			$manage_license       = new Easy_Accordion_Pro_License( SP_EASY_ACCORDION_PRO_FILE, SP_EAP_VERSION, 'ShapedPlugin', SP_EAP_STORE_URL, SP_EAP_ITEM_ID, SP_EAP_ITEM_SLUG );
			$license_key          = $manage_license->get_license_key();
			$license_key_status   = $manage_license->get_license_status();
			$license_status       = ( is_object( $license_key_status ) ? $license_key_status->license : '' );
			$license_notices      = $manage_license->license_notices();
			$license_status_class = '';
			$license_active       = '';
			$license_data         = $manage_license->api_request();

			echo '<div class="easy-accordion-pro-license text-center">';
			echo '<h3>' . esc_html__( 'Easy Accordion Pro License Key', 'easy-accordion-pro' ) . '</h3>';
			if ( 'valid' == $license_status ) {
				$license_status_class = 'license-key-active';
				$license_active       = '<span>' . esc_html__( 'Active', 'easy-accordion-pro' ) . '</span>';
				echo '<p>' . esc_html__( 'Your license key is active.', 'easy-accordion-pro' ) . '</p>';
			} elseif ( 'expired' == $license_status ) {
				echo '<p style="color: red;">Your license key expired on ' . date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) ) . '. <a href="' . SP_EAP_STORE_URL . '/checkout/?edd_license_key=' . $license_key . '&download_id=' . SP_EAP_ITEM_ID . '&utm_campaign=easy_accordion_pro&utm_source=licenses&utm_medium=expired" target="_blank">Renew license key at discount.</a></p>';//phpcs:ignore
			} else {
				echo '<p>Please activate your license key to make the plugin work. <a href="https://docs.shapedplugin.com/docs/easy-accordion-pro/getting-started/activating-license-key/" target="_blank">How to activate license key?</a></p>';
			}
			echo '<div class="easy-accordion-pro-license-area">';
			echo '<div class="easy-accordion-pro-license-key"><input class="easy-accordion-pro-license-key-input ' . $license_status_class . '" type="' . $type . '" name="' . $this->field_name() . '" value="' . $this->value . '"' . $this->field_attributes() . ' />' . $license_active . '</div>';//phpcs:ignore
			wp_nonce_field( 'sp_easy_accordion_pro_nonce', 'sp_easy_accordion_pro_nonce' );
			if ( 'valid' == $license_status ) {
				echo '<input style="color: #dc3545; border-color: #dc3545;" type="submit" class="button-secondary btn-license-deactivate" name="sp_easy_accordion_pro_license_deactivate" value="' . esc_html__( 'Deactivate', 'easy-accordion-pro' ) . '"/>';
			} else {
				echo '<input type="submit" class="button-secondary btn-license-save-activate" name="' . $this->unique . '[_nonce][save]" value="' . esc_html__( 'Activate', 'easy-accordion-pro' ) . '"/>';//phpcs:ignore
				echo '<input type="hidden" class="btn-license-activate" name="sp_easy_accordion_pro_license_activate" value="' . esc_html__( 'Activate', 'easy-accordion-pro' ) . '"/>';
			}
			echo '<br><div class="easy-accordion-pro-license-error-notices">' . $license_notices . '</div>';//phpcs:ignore
			echo '</div>';
			echo '</div>';
			echo wp_kses_post( $this->field_after() );
		}

	}
}
