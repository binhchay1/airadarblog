<?php
/**
 * The post accordion template.
 * This template can be overridden by copying it to yourtheme/easy-accordion-pro/templates/post-accordion.php
 *
 * @package easy_accordion_pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
$number_of_total_posts = ( isset( $upload_data['number_of_total_posts'] ) ? $upload_data['number_of_total_posts'] : '' );

// Accordion Pagination.
$accordion_item_per_page = isset( $shortcode_data['pagination_show_per_page'] ) && (int) $shortcode_data['pagination_show_per_page'] > 0 ? (int) $shortcode_data['pagination_show_per_page'] : 8;

$accordion_item_per_page = ( $accordion_item_per_page > $number_of_total_posts ) ? $number_of_total_posts : $accordion_item_per_page;
$accordion_item_per_page = $show_pagination ? $accordion_item_per_page : $number_of_total_posts;
$eap_page                = isset( $_POST['sp_eap_page'] ) ? sanitize_text_field( wp_unslash( $_POST['sp_eap_page'] ) ) : 0; // phpcs:ignore

$post_query_data  = self::accordion_post_query( $upload_data, $shortcode_data );
$count_total_post = $post_query_data['count_total_post'];
$total_page       = $post_query_data['total_page'];
$args             = $post_query_data['args'];
$eap_args         = $post_query_data['post_query'];
$post_query       = new WP_Query( $eap_args );

$ea_key = 1;
// Collapse/Expand button.
require self::eap_locate_template( 'collapse-expand-button.php' );
echo '<div id="sp-ea-' . esc_attr( $post_id ) . '" class="' . esc_attr( $accordion_wraper_class . $multi_column ) . ' " data-ex-icon="' . esc_attr( $eap_expand_icon ) . '" data-col-icon="' . esc_attr( $eap_collapse_icon ) . '"  data-ea-active="' . esc_attr( $eap_active_event ) . '"  data-ea-mode="' . esc_attr( $accordion_layout ) . '" data-ea-multi-column="' . esc_attr( $multi_column ) . '"  data-ea-coll="' . esc_attr( $eap_mutliple_collapse ) . '" data-keep-accordion="' . esc_attr( $keep_accordion ) . '" data-autoclose="' . esc_attr( $eap_mouseout_autoclose ) . '" data-preloader="' . esc_attr( $eap_preloader ) . '" data-scroll-active-item="' . esc_attr( $eap_scroll_to_active_item ) . '" data-offset-to-scroll="' . esc_attr( $eap_offset_to_scroll ) . '" data-autoplaytime="' . esc_attr( $eap_autoplay_time ) . '" data-expand=' . esc_attr( $faq_collapse_button ) . '>';
// Preloader.
require self::eap_locate_template( 'preloader.php' );

if ( $post_query->have_posts() ) {
	global $wp_embed;
	while ( $post_query->have_posts() ) {
		$post_query->the_post();
		$key             = get_the_ID();
		$accordion_title = apply_filters( 'sp_easy_accordion_post_title', get_the_title( $key ) );
		$post_content    = apply_filters( 'sp_easy_accordion_post_content', get_the_content() );
		$post_content    = str_replace( ']]>', ']]&gt;', $post_content );
		if ( function_exists( 'do_blocks' ) ) {
			$post_content = do_blocks( $post_content );
		}
		if ( $eap_autop ) {
			$post_content = wpautop( trim( $post_content ) );
		}
		$content_main  = do_shortcode( shortcode_unautop( $wp_embed->autoembed( $post_content ) ) );
		$content_autop = $ea_strip_tag ? wp_strip_all_tags( $content_main ) : $content_main;
		if ( $eap_read_more ) {
			if ( apply_filters( 'eap_post_content_limit_by_charecter', false ) ) {
				$eap_post_content_character_limit = apply_filters( 'eap_post_content_character_limit', 300 );
				$limit_content                    = substr( $content_autop, 0, $eap_post_content_character_limit );
				$limit_content                   .= $limit_content ? '...' : '';
			} else {
				$eap_post_content_word_limit = apply_filters( 'eap_post_content_word_limit', 55 );
				$limit_content               = self::sp_eap_limit_words_from_html( $content_autop, $eap_post_content_word_limit, '...' );
			}
			$content_autop = force_balance_tags( $limit_content );
		}
		$aria_expanded        = 'false';
		$accordion_mode       = self::accordion_mode( $eap_accordion_mode, $ea_key, $eap_expand_icon, $eap_collapse_icon );
		$data_parent_id       = ( ! $eap_mutliple_collapse ) ? 'data-parent="#sp-ea-' . $post_id . '"' : '';
		$eap_exp_icon_markup  = ( $eap_icon ) ? '<i class="ea-expand-icon fa ' . $accordion_mode['expand_icon_first'] . '"></i>' : '';
		$data_sptarget        = 'data-sptarget="#collapse' . $post_id . $key . '"';
		$animated_classes     = ( $eap_animation ) ? "animated  $eap_animation_style" : '';
		$post_accordion_body  = ( $eap_read_more || has_post_thumbnail() ) ? 'eap-post-accordion-body' : '';
		$post_accordion_body .= ( ! has_post_thumbnail() ) ? ' post-accordion-width' : '';
		if ( 'sp-ea-thirteen' === $accordion_theme_class ) {
			$eap_icon_markup = '<span class="sp-numbering">' . $ea_key . '</span>';
		} elseif ( 'sp-ea-fourteen sp-ea-thirteen' === $accordion_theme_class ) {
			$eap_icon_markup = '<span class="sp-numbering">' . $eap_exp_icon_markup . '</span>';
		} else {
			$eap_icon_markup = $eap_exp_icon_markup;
		}

		$faq_search_id = $faq_search ? ' id="eap-faq' . $post_id . $key . '" ' : '';
		require self::eap_locate_template( 'accordion/single-item.php' );
		$ea_key++;
	}
	wp_reset_postdata();
}
echo '</div>';
