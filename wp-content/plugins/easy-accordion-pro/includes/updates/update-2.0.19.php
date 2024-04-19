<?php
/**
 * Update version.
 */
update_option( 'easy_accordion_pro_version', '2.0.19' );
update_option( 'easy_accordion_pro_db_version', '2.0.19' );

$old_license             = get_option( 'sp_eapro_license_key' );
$settings                = get_option( 'sp_eap_settings' );
$settings['license_key'] = $old_license;

update_option( 'sp_eap_settings', $settings );
// delete_option( 'sp_eapro_license_key' );
// delete_option( 'sp_eapro_license_status' );

/**
 * Update license status.
 */
$manage_license = new Easy_Accordion_Pro_License( SP_EASY_ACCORDION_PRO_FILE, SP_EAP_VERSION, 'ShapedPlugin', SP_EAP_STORE_URL, SP_EAP_ITEM_ID, SP_EAP_ITEM_SLUG );
$manage_license->check_license_status();
