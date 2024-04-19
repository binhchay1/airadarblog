<?php
/**
 * The preloader markup of the plugin.
 * This template can be overridden by copying it to yourtheme/easy-accordion-pro/templates/preloader.php
 *
 * @package   easy-accordion-pro
 * @subpackage easy-accordion-pro/includes
 */

if ( $eap_preloader ) {
	echo '<div id="eap-preloader-' . esc_attr( $post_id ) . '" class="accordion-preloader">';
	echo '<img src="' . SP_EAP_URL . 'public/assets/spinner.svg"  alt="loader-image"/>';// phpcs:ignore.
	echo '</div>';
}
