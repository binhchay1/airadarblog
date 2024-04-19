<?php
/**
 * The post accordion template.
 * This template can be overridden by copying it to yourtheme/easy-accordion-pro/templates/default-accordion.php
 *
 * @package easy_accordion_pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( empty( $content_sources ) ) {
	return;
}
$accordion_item_per_page = isset( $shortcode_data['pagination_show_per_page'] ) && (int) $shortcode_data['pagination_show_per_page'] > 0 ? (int) $shortcode_data['pagination_show_per_page'] : 8;
$content_sources         = isset( $upload_data['accordion_content_source'] ) ? $upload_data['accordion_content_source'] : '';
// Collapse/Expand button.
require self::eap_locate_template( 'collapse-expand-button.php' );

echo '<div id="sp-ea-' . esc_attr( $post_id ) . '" class="' . esc_attr( $accordion_wraper_class . $multi_column ) . '" data-ex-icon="' . esc_attr( $eap_expand_icon ) . '" data-col-icon="' . esc_attr( $eap_collapse_icon ) . '"  data-ea-active="' . esc_attr( $eap_active_event ) . '"  data-ea-mode="' . esc_attr( $accordion_layout ) . '" data-ea-multi-column="' . esc_attr( $multi_column ) . '" data-ea-coll="' . esc_attr( $eap_mutliple_collapse ) . '" data-keep-accordion="' . esc_attr( $keep_accordion ) . '" data-autoclose="' . esc_attr( $eap_mouseout_autoclose ) . '" data-preloader="' . esc_attr( $eap_preloader ) . '" data-scroll-active-item="' . esc_attr( $eap_scroll_to_active_item ) . '" data-offset-to-scroll="' . esc_attr( $eap_offset_to_scroll ) . '" data-autoplaytime="' . esc_attr( $eap_autoplay_time ) . '" data-expand=' . esc_attr( $faq_collapse_button ) . '>';
// Preloader.
require self::eap_locate_template( 'preloader.php' );

$eap_page         = isset( $_POST['sp_eap_page'] ) ? sanitize_text_field( wp_unslash( $_POST['sp_eap_page'] ) ) : 0; // phpcs:ignore.
$show_pagination  = isset( $shortcode_data['show_pagination'] ) ? $shortcode_data['show_pagination'] : false;
$content_sources  = isset( $upload_data['accordion_content_source'] ) ? $upload_data['accordion_content_source'] : '';
$count_total_post = count( $upload_data['accordion_content_source'] );

if ( $show_pagination && ! empty( $accordion_item_per_page ) && count( $content_sources ) > $accordion_item_per_page ) {
	$start_post          = $accordion_item_per_page * $eap_page;
	$eap_content_sources = array_slice( $content_sources, $start_post, $accordion_item_per_page );
} else {
	$eap_content_sources = $content_sources;
}
$total_page = 1;
if ( 'content-accordion' === $accordion_type && ! empty( $total_page ) ) {
	$number_of_content_sources = count( $upload_data['accordion_content_source'] );
	$total_page                = $number_of_content_sources / $accordion_item_per_page;
}

if ( empty( $eap_content_sources ) ) {
	return;
}
$ea_key = 1;
foreach ( $eap_content_sources as $key => $content_source ) {
	global $wp_embed;
	$accordion_title = $content_source['accordion_content_title'];
	$accordion_desc  = isset( $content_source['accordion_content_description'] ) ? $content_source['accordion_content_description'] : '';
	$content         = apply_filters( 'sp_easy_accordion_content', $accordion_desc );
	$content_embed   = str_replace( ']]>', ']]&gt;', $content );
	if ( $eap_autop ) {
		$content_embed = wpautop( $content_embed );
	}
	$content_embed       = do_shortcode( shortcode_unautop( $wp_embed->autoembed( $content_embed ) ) );
	$content_description = $ea_strip_tag ? wp_strip_all_tags( $content_embed ) : $content_embed;

	$title_icon              = isset( $content_source['accordion_content_icon'] ) ? $content_source['accordion_content_icon'] : '';
	$title_custom_icon       = isset( $content_source['accordion_custom_icon'] ) ? $content_source['accordion_custom_icon'] : '';
	$eap_inactive            = isset( $content_source['accordion_inactive'] ) ? $content_source['accordion_inactive'] : false;
	$hide_specific_accordion = isset( $content_source['hide_specific_accordion'] ) ? $content_source['hide_specific_accordion'] : false;

	$accordion_mode           = self::accordion_mode( $eap_accordion_mode, $ea_key, $eap_expand_icon, $eap_collapse_icon );
	$data_parent_id           = ( ! $eap_mutliple_collapse ) ? 'data-parent="#sp-ea-' . $post_id . '"' : '';
	$eap_exp_icon_markup      = ( $eap_icon ) ? '<i class="ea-expand-icon fa ' . $accordion_mode['expand_icon_first'] . '"></i>' : '';
	$eap_collapse_icon_markup = ( $eap_icon ) ? '<i class="ea-expand-icon fa ' . $eap_collapse_icon . '"></i>' : '';
	$eap_title_icon_html      = '';
	if ( ! empty( $title_icon ) ) {
		$eap_title_icon_html = '<span class="' . $title_icon . ' eap-title-icon"></span>';
	} elseif ( ! empty( $title_custom_icon['url'] ) ) {
		$eap_title_icon_html = '<img src="' . $title_custom_icon['url'] . '" class="eap-title-custom-icon" alt="' . $title_custom_icon['alt'] . '"/>';
	}

	$eap_title_icon_markup = ( $eap_title_icon ) ? $eap_title_icon_html : '';
	$data_sptarget         = 'data-sptarget="#collapse' . $post_id . $key . '"';
	$animated_classes      = ( $eap_animation ) ? "animated $eap_animation_style" : '';
	if ( 'sp-ea-thirteen' === $accordion_theme_class ) {
		$eap_icon_markup = '<span class="sp-numbering"> ' . $ea_key . ' </span>';
	} elseif ( 'sp-ea-fourteen sp-ea-thirteen' === $accordion_theme_class ) {
		$eap_icon_markup = '<span class="sp-numbering"> ' . $eap_exp_icon_markup . ' </span>';
	} else {
		$eap_icon_markup = $eap_exp_icon_markup;
	}

	$faq_search_id = $faq_search ? 'id="esp_faq' . $post_id . $key . '" ' : '';
	require self::eap_locate_template( 'accordion/single-item.php' );
	$ea_key++;
}
echo '</div>';
