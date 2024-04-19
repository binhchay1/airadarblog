<?php
/**
 * Update version.
 *
 * @package easy-accordion-pro
 */

update_option( 'easy_accordion_pro_version', '2.5.0' );
update_option( 'easy_accordion_pro_db_version', '2.5.0' );

$args          = new \WP_Query(
	array(
		'post_type'      => array( 'sp_easy_accordion' ),
		'post_status'    => 'publish',
		'posts_per_page' => '500',
	)
);
$shortcode_ids = wp_list_pluck( $args->posts, 'ID' );
if ( count( $shortcode_ids ) > 0 ) {
	foreach ( $shortcode_ids as $shortcode_key => $shortcode_id ) {
		$shortcode_data = get_post_meta( $shortcode_id, 'sp_eap_shortcode_options', true );
		if ( ! is_array( $shortcode_data ) ) {
			continue;
		}
		$old_section_title_margin_bottom       = isset( $shortcode_data['section_title_margin_bottom']['all'] ) ? $shortcode_data['section_title_margin_bottom']['all'] : '30';
		$shortcode_data['eap_animation_style'] = 'normal';
		if ( ! empty( $shortcode_data['eap_section_title_typography'] ) ) {
			$shortcode_data['eap_section_title_typography']['margin-bottom'] = $old_section_title_margin_bottom;
		}

		update_post_meta( $shortcode_id, 'sp_eap_shortcode_options', $shortcode_data );
	}
}
