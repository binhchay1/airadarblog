<?php
/**
 * Update version.
 */
update_option( 'easy_accordion_pro_version', '2.0.18' );
update_option( 'easy_accordion_pro_db_version', '2.0.18' );

/**
 * Shortcode query for id.
 */
$args          = new WP_Query(
	array(
		'post_type'      => 'sp_easy_accordion',
		'post_status'    => 'any',
		'posts_per_page' => '300',
	)
);
$shortcode_ids = wp_list_pluck( $args->posts, 'ID' );

if ( count( $shortcode_ids ) > 0 ) {
	foreach ( $shortcode_ids as $shortcode_key => $shortcode_id ) {

		$shortcode_data    = get_post_meta( $shortcode_id, 'sp_eap_shortcode_options', 'true' );
		$icon_height_width = $shortcode_data['icon_height_width'];
		$icon_height       = isset( $icon_height_width['desktop'] ) ? $icon_height_width['desktop'] : '40';
		$icon_width        = isset( $icon_height_width['laptop'] ) ? $icon_height_width['laptop'] : '40';

		$shortcode_data['icon_height_width'] = array(
			'top'   => $icon_height,
			'right' => $icon_width,
		);

		update_post_meta( $shortcode_id, 'sp_eap_shortcode_options', $shortcode_data );
	}
}
