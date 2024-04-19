<?php
/**
 * The Section title markup of the plugin.
 * This template can be overridden by copying it to yourtheme/easy-accordion-pro/templates/section-title.php
 *
 * @package   easy-accordion-pro
 * @subpackage easy-accordion-pro/includes
 */

if ( $acc_section_title ) {
	echo '<h2 class="eap_section_title_' . esc_attr( $post_id ) . '"> ' . wp_kses_post( $main_section_title ) . ' </h2>';
}
