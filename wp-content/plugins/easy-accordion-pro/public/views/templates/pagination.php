<?php
/**
 * Pagination display provider.
 * This template can be overridden by copying it to yourtheme/easy-accordion-pro/templates/pagination.php
 *
 * @package easy_accordion_pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$pagination_type            = isset( $shortcode_data['pagination_type'] ) ? $shortcode_data['pagination_type'] : 'ajax_load_more';
$accordion_pagination_label = isset( $shortcode_data['load_more_label'] ) ? $shortcode_data['load_more_label'] : 'Load More';
$end_accordion_text         = apply_filters( 'sp_eap_end_accordion_text', __( 'End of the Accordion items', 'easy-accordion-pro' ) );

if ( ! empty( $total_page ) && $total_page > 1 && ( 'ajax_load_more' === $pagination_type || 'ajax_infinite_scrl' === $pagination_type ) && $show_pagination ) {
	$page_num = 1;
	echo '<div class="sp-eap-load-more sp-eap-load-more-' . esc_attr( $post_id ) . '"
	data-pagi="' . esc_attr( $pagination_type ) . '" data-text="' . esc_attr( $end_accordion_text ) . '">';
	echo '<button data-item_per_page="' . esc_attr( $accordion_item_per_page ) . '" data-total-post="' . esc_attr( $count_total_post ) . '" sp-eap-processing="0" data-id="' . esc_attr( $post_id ) . '" data-page="' . esc_attr( $page_num ) . '" data-total="' . esc_attr( $total_page ) . '">' . esc_html( $accordion_pagination_label ) . '</button>
    </div>';
} elseif ( ! empty( $total_page ) && $total_page > 1 && 'ajax_number' === $pagination_type && $show_pagination ) {
	echo '<div class="sp-eap-ajax-number-pagination sp-eap-ajax-number-pagination-' . esc_attr( $post_id ) . '" data-pagination="' . esc_attr( $pagination_type ) . '" data-text="' . esc_attr( $end_accordion_text ) . '">';
	echo '<div data-total-post="' . esc_attr( $count_total_post ) . '"  class="sp-eap-pagination-number" data-id="' . esc_attr( $post_id ) . '" data-total="' . esc_attr( $total_page ) . '"><a href="#" class="sp-eap-page-numbers prev" ><i class="fa fa-angle-left"></i></a>';
	$page_num = 1;
	while ( $page_num <= ceil( $total_page ) ) {
		echo '<a href="#" class="sp-eap-page-numbers" data-page="' . esc_attr( $page_num ) . '">' . esc_attr( $page_num ) . '</a>';
		$page_num++;
	}
	echo '<a href="#" class="sp-eap-page-numbers next"><i class="fa fa-angle-right"></i></a></div></div>';
}
