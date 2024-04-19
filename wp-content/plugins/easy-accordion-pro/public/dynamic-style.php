<?php
/**
 * The dynamic style file.
 *
 * @link       https://shapedplugin.com/
 * @since      2.1.2
 *
 * @package    Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/public
 */

$accordion_layout = isset( $shortcode_data['eap_accordion_layout'] ) ? $shortcode_data['eap_accordion_layout'] : '';
$multi_column     = 'multi-column' === $accordion_layout ? true : false;
if ( $multi_column || wp_is_mobile() ) {
	$accordion_layout = 'vertical';
}
$settings                = get_option( 'sp_eap_settings' );
$eap_dequeue_google_font = isset( $settings['eap_dequeue_google_font'] ) ? $settings['eap_dequeue_google_font'] : '';
$accordion_theme_class   = isset( $shortcode_data['eap_accordion_theme'] ) ? $shortcode_data['eap_accordion_theme'] : '';
// Accordion settings.
$eap_preloader                      = isset( $shortcode_data['eap_preloader'] ) ? $shortcode_data['eap_preloader'] : false;
$eap_accordion_fillspace            = isset( $shortcode_data['eap_accordion_fillspace'] ) ? $shortcode_data['eap_accordion_fillspace'] : false;
$old_eap_accordion_fillspace_height = isset( $shortcode_data['eap_accordion_fillspace_height'] ) ? $shortcode_data['eap_accordion_fillspace_height'] : '200';
$eap_accordion_fillspace_height     = isset( $shortcode_data['eap_accordion_fillspace_height']['all'] ) ? $shortcode_data['eap_accordion_fillspace_height'] ['all'] : $old_eap_accordion_fillspace_height;
// Accordion style.
$acc_bottom_margin      = isset( $shortcode_data['accordion_margin_bottom']['all'] ) ? $shortcode_data['accordion_margin_bottom']['all'] : '10';
$acc_section_title      = isset( $shortcode_data['section_title'] ) ? $shortcode_data['section_title'] : false;
$accordion_height       = isset( $shortcode_data['accordion_height'] ) ? $shortcode_data['accordion_height'] : '';
$accordion_header_width = isset( $shortcode_data['accordion_header_width'] ) ? $shortcode_data['accordion_header_width'] : 60;
$acc_border_value       = isset( $shortcode_data['accordion_border_radius']['all'] ) ? $shortcode_data['accordion_border_radius']['all'] : '';
$acc_border_unit        = isset( $shortcode_data['accordion_border_radius']['unit'] ) ? $shortcode_data['accordion_border_radius']['unit'] : 'px';
if ( ! empty( $acc_border_value ) ) {
	$acc_border_radius = $acc_border_value . $acc_border_unit;
} else {
	$acc_border_radius = '0';
}
$acc_header_border_radius_value = isset( $shortcode_data['accordion_header_border_radius'] ['all'] ) ? $shortcode_data['accordion_header_border_radius'] ['all'] : '32';
$acc_header_border_radius_unit  = isset( $shortcode_data['accordion_header_border_radius']['unit'] ) ? $shortcode_data['accordion_header_border_radius']['unit'] : 'px';
$acc_header_border_radius       = $acc_header_border_radius_value . $acc_header_border_radius_unit;
$eap_animation_time             = isset( $shortcode_data['eap_animation_time'] ) ? $shortcode_data['eap_animation_time'] : '500';
$eap_des_padding                = isset( $shortcode_data['eap_description_padding'] ) ? $shortcode_data['eap_description_padding'] : '';
$eap_des_padding_top            = isset( $eap_des_padding['top'] ) ? $eap_des_padding['top'] : '15';
$eap_des_padding_bottom         = isset( $eap_des_padding['bottom'] ) ? $eap_des_padding['bottom'] : '15';
$eap_des_padding_right          = isset( $eap_des_padding['right'] ) ? $eap_des_padding['right'] : '15';
$eap_des_padding_left           = isset( $eap_des_padding['left'] ) ? $eap_des_padding['left'] : '15';
$eap_border                     = isset( $shortcode_data['eap_border_css'] ) && is_array( $shortcode_data['eap_border_css'] ) ? $shortcode_data['eap_border_css'] : array(
	'all'   => '1',
	'style' => 'solid',
	'color' => '#e2e2e2',
);
$old_eap_border                 = isset( $eap_border['width'] ) ? $eap_border['width'] : '1';
$eap_border_width               = isset( $shortcode_data['eap_border_css']['all'] ) && ! empty( $shortcode_data['eap_border_css']['all'] ) ? $shortcode_data['eap_border_css']['all'] : $old_eap_border;
$eap_expand_border              = isset( $shortcode_data['eap_expand_border_css'] ) ? $shortcode_data['eap_expand_border_css'] : '';
$eap_expand_border_width        = isset( $eap_expand_border['all'] ) ? $eap_expand_border['all'] : '1';
// Section title.
$section_title_typho           = isset( $shortcode_data['eap_section_title_typography'] ) ? $shortcode_data['eap_section_title_typography'] : '';
$section_title_typho_color     = isset( $section_title_typho['color'] ) ? $section_title_typho['color'] : '#444444';
$section_title_typho_size      = isset( $section_title_typho['font-size'] ) ? $section_title_typho['font-size'] : '28';
$section_title_typho_height    = isset( $section_title_typho['line-height'] ) ? $section_title_typho['line-height'] : '36';
$section_title_typho_alignment = isset( $section_title_typho['text-align'] ) ? $section_title_typho['text-align'] : 'left';
$section_title_typho_spacing   = isset( $section_title_typho['letter-spacing'] ) ? $section_title_typho['letter-spacing'] : '0';
$section_title_typho_transform = isset( $section_title_typho['text-transform'] ) ? $section_title_typho['text-transform'] : 'none';
$section_title_typho_family    = isset( $section_title_typho['font-family'] ) ? $section_title_typho['font-family'] : '';
$section_title_typho_style     = ! empty( $section_title_typho['font-style'] ) ? $section_title_typho['font-style'] : 'normal';
$section_title_typho_weight    = ! empty( $section_title_typho['font-weight'] ) ? $section_title_typho['font-weight'] : '400';
$section_title_bottom_margin   = isset( $section_title_typho['margin-bottom'] ) ? $section_title_typho['margin-bottom'] : '30';

// Accordion title.
$eap_title_typho           = isset( $shortcode_data['eap_title_typography'] ) ? $shortcode_data['eap_title_typography'] : '';
$eap_title_typho_color     = isset( $eap_title_typho['color'] ) ? $eap_title_typho['color'] : '#444';
$eap_title_typho_hcolor    = isset( $eap_title_typho['hover_color'] ) ? $eap_title_typho['hover_color'] : '#444';
$eap_title_typho_acolor    = isset( $eap_title_typho['active_color'] ) ? $eap_title_typho['active_color'] : '#444';
$eap_title_typho_size      = isset( $eap_title_typho['font-size'] ) ? $eap_title_typho['font-size'] : '20';
$eap_title_typho_height    = isset( $eap_title_typho['line-height'] ) ? $eap_title_typho['line-height'] : '30';
$eap_title_typho_align     = isset( $eap_title_typho['text-align'] ) ? $eap_title_typho['text-align'] : 'left';
$eap_title_typho_spacing   = isset( $eap_title_typho['letter-spacing'] ) ? $eap_title_typho['letter-spacing'] : '0';
$eap_title_typho_transform = isset( $eap_title_typho['text-transform'] ) ? $eap_title_typho['text-transform'] : 'none';
$eap_title_typho_family    = isset( $eap_title_typho['font-family'] ) ? $eap_title_typho['font-family'] : '';
$eap_title_typho_style     = ! empty( $eap_title_typho['font-style'] ) ? $eap_title_typho['font-style'] : 'normal';
$eap_title_typho_weight    = ! empty( $eap_title_typho['font-weight'] ) ? $eap_title_typho['font-weight'] : '400';
$eap_title_padding         = isset( $shortcode_data['eap_title_padding'] ) ? $shortcode_data['eap_title_padding'] : '';
$eap_title_padding_top     = isset( $eap_title_padding['top'] ) ? $eap_title_padding['top'] : '15';
$eap_title_padding_right   = isset( $eap_title_padding['right'] ) ? $eap_title_padding['right'] : '15';
$eap_title_padding_bottom  = isset( $eap_title_padding['bottom'] ) ? $eap_title_padding['bottom'] : '15';
$eap_title_padding_left    = isset( $eap_title_padding['left'] ) ? $eap_title_padding['left'] : '15';

// Header background style.
$eap_title_bg_color_type      = isset( $shortcode_data['eap_header_bg_color_type'] ) ? $shortcode_data['eap_header_bg_color_type'] : 'solid';
$eap_header_bg_gradient_color = isset( $shortcode_data['eap_header_bg_gradient_color'] ) ? $shortcode_data['eap_header_bg_gradient_color'] : '';
$eap_gradient_direction       = isset( $eap_header_bg_gradient_color['background-gradient-direction'] ) ? $eap_header_bg_gradient_color['background-gradient-direction'] : '135deg';
$eap_background_color         = isset( $eap_header_bg_gradient_color['background-color'] ) ? $eap_header_bg_gradient_color['background-color'] : 'rgb(255 95 109)';
$eap_gradient_color           = isset( $eap_header_bg_gradient_color['background-gradient-color'] ) ? $eap_header_bg_gradient_color['background-gradient-color'] : 'rgb(255, 195, 113)';
$eap_header_bg                = isset( $shortcode_data['eap_header_bg_color'] ) ? $shortcode_data['eap_header_bg_color'] : '';
if ( $eap_header_bg && is_string( $eap_header_bg ) ) { // free to pro issue fix.
	$eap_header_bg = array(
		'color1' => $eap_header_bg,
		'color2' => $eap_header_bg,
		'color3' => $eap_header_bg,
	);
}
$eap_header_bg_normal     = isset( $eap_header_bg['color1'] ) ? $eap_header_bg['color1'] : '#eee';
$eap_header_bg_active     = isset( $eap_header_bg['color2'] ) && $eap_header_bg['color2'] ? $eap_header_bg['color2'] : '#eee';
$eap_header_bg_hover      = isset( $eap_header_bg['color3'] ) ? $eap_header_bg['color3'] : '#eee';
$eap_title_icon_size_data = isset( $shortcode_data['eap_title_icon_size'] ) ? $shortcode_data['eap_title_icon_size'] : '';
$eap_title_icon_size      = isset( $eap_title_icon_size_data['all'] ) ? $eap_title_icon_size_data['all'] : '20';
$eap_title_icon_color     = isset( $shortcode_data['eap_title_icon_color'] ) ? $shortcode_data['eap_title_icon_color'] : '';
if ( ! is_array( $eap_title_icon_color ) ) {
	$eap_title_icon_color_normal = '#444';
} else {
	$eap_title_icon_color_normal = isset( $eap_title_icon_color['color1'] ) ? $eap_title_icon_color['color1'] : '#444';
}
$eap_title_icon_color_active = isset( $eap_title_icon_color['color2'] ) ? $eap_title_icon_color['color2'] : '#444';
$eap_title_icon_color_hover  = isset( $eap_title_icon_color['color3'] ) ? $eap_title_icon_color['color3'] : '#444';
$eap_title_icon              = isset( $shortcode_data['eap_title_icon'] ) ? $shortcode_data['eap_title_icon'] : '';
$eap_expand_bg               = isset( $shortcode_data['eap_expand_bg_color'] ) ? $shortcode_data['eap_expand_bg_color'] : '';

// header icon.
// Expand / Collapse Icon.
$eap_expand_collapse_icon = isset( $shortcode_data['eap_expand_collapse_icon'] ) ? $shortcode_data['eap_expand_collapse_icon'] : '';
$eap_ex_icon_position     = isset( $shortcode_data['eap_icon_position'] ) ? $shortcode_data['eap_icon_position'] : '';
$eap_ex_icon_position_hr  = isset( $shortcode_data['eap_icon_position_horizontal'] ) ? $shortcode_data['eap_icon_position_horizontal'] : 'left';
$eap_icon_size            = isset( $shortcode_data['eap_icon_size']['all'] ) ? $shortcode_data['eap_icon_size']['all'] : '';
$eap_icon_margin_right    = isset( $shortcode_data['eap_icon_margin']['all'] ) && $shortcode_data['eap_icon_margin']['all'] ? $shortcode_data['eap_icon_margin']['all'] : '10';
$eap_icon_color           = isset( $shortcode_data['eap_icon_color_set'] ) ? $shortcode_data['eap_icon_color_set'] : '';

$eap_icon = isset( $shortcode_data['eap_expand_close_icon'] ) ? $shortcode_data['eap_expand_close_icon'] : '';
if ( ! is_array( $eap_icon_color ) ) {
	$eap_icon_color_normal = $eap_icon_color;
} else {
	$eap_icon_color_normal = isset( $eap_icon_color['color1'] ) ? $eap_icon_color['color1'] : '#444';
}
$eap_icon_color_active = isset( $eap_icon_color['color2'] ) ? $eap_icon_color['color2'] : '#444';
$eap_icon_color_hover  = isset( $eap_icon_color['color3'] ) ? $eap_icon_color['color3'] : '#444';
$eap_icon_bg           = isset( $shortcode_data['eap_icon_bg_color'] ) ? $shortcode_data['eap_icon_bg_color'] : '';
if ( ! is_array( $eap_icon_bg ) ) {
	$eap_icon_bg_normal = $eap_icon_bg;
} else {
	$eap_icon_bg_normal = isset( $eap_icon_bg['color1'] ) ? $eap_icon_bg['color1'] : '#546a77';
}
$eap_icon_bg_active    = isset( $eap_icon_bg['color2'] ) ? $eap_icon_bg['color2'] : '#546a77';
$eap_icon_bg_hover     = isset( $eap_icon_bg['color3'] ) ? $eap_icon_bg['color3'] : '#546a77';
$eap_icon_radius_value = isset( $shortcode_data['eap_icon_border_radius']['all'] ) ? $shortcode_data['eap_icon_border_radius']['all'] : '';
$eap_icon_radius_unit  = isset( $shortcode_data['eap_icon_border_radius']['unit'] ) ? $shortcode_data['eap_icon_border_radius']['unit'] : 'px';
$eap_icon_radius       = $eap_icon_radius_value . $eap_icon_radius_unit;
$eap_icon_height       = isset( $shortcode_data['icon_height_width']['top'] ) ? $shortcode_data['icon_height_width']['top'] : '40';
$eap_icon_width        = isset( $shortcode_data['icon_height_width']['right'] ) ? $shortcode_data['icon_height_width']['right'] : '40';
$eap_title_font_load   = isset( $shortcode_data['eap_title_font_load'] ) ? $shortcode_data['eap_title_font_load'] : '';
$eap_desc_font_load    = isset( $shortcode_data['eap_desc_font_load'] ) ? $shortcode_data['eap_desc_font_load'] : '';

// Description.
$eap_content_typo           = isset( $shortcode_data['eap_content_typography'] ) ? $shortcode_data['eap_content_typography'] : '';
$eap_content_typo_color     = isset( $eap_content_typo['color'] ) ? $eap_content_typo['color'] : '#444';
$eap_content_typo_size      = isset( $eap_content_typo['font-size'] ) ? $eap_content_typo['font-size'] : '16';
$eap_content_typo_alignment = isset( $eap_content_typo['text-align'] ) ? $eap_content_typo['text-align'] : 'left';
$eap_content_typo_spacing   = isset( $eap_content_typo['letter-spacing'] ) ? $eap_content_typo['letter-spacing'] : '0';
$eap_content_typo_height    = isset( $eap_content_typo['line-height'] ) ? $eap_content_typo['line-height'] : '26';
$eap_content_typo_transform = isset( $eap_content_typo['text-transform'] ) ? $eap_content_typo['text-transform'] : 'none';
$eap_content_typo_family    = isset( $eap_content_typo['font-family'] ) ? $eap_content_typo['font-family'] : '';
$eap_content_typo_style     = ! empty( $eap_content_typo['font-style'] ) ? $eap_content_typo['font-style'] : '';
$eap_content_typo_weight    = isset( $eap_content_typo['font-weight'] ) ? $eap_content_typo['font-weight'] : '';
$eap_description_bg         = isset( $shortcode_data['eap_description_bg_color'] ) ? $shortcode_data['eap_description_bg_color'] : '';
// Animation.
$eap_animation       = isset( $shortcode_data['eap_animation'] ) ? $shortcode_data['eap_animation'] : '';
$eap_animation_style = isset( $shortcode_data['eap_animation_style'] ) ? $shortcode_data['eap_animation_style'] : '';

// Collapse/Expand button.
$faq_collapse_button        = isset( $shortcode_data['eap_faq_collapse_button'] ) ? $shortcode_data['eap_faq_collapse_button'] : '';
$collapse_button_fields     = isset( $shortcode_data['eap_faq_collapse_fields'] ) ? $shortcode_data['eap_faq_collapse_fields'] : '';
$collapse_button_alignment  = ( isset( $collapse_button_fields['eap_faq_collapse_button_alignment'] ) && $collapse_button_fields['eap_faq_collapse_button_alignment'] ) ? $collapse_button_fields['eap_faq_collapse_button_alignment'] : 'right';
$collapse_button_text_color = ( isset( $collapse_button_fields['eap_faq_collapse_button_color']['color1'] ) && $collapse_button_fields['eap_faq_collapse_button_color']['color1'] ? $collapse_button_fields['eap_faq_collapse_button_color']['color1'] : '#fff' );
$collapse_button_bg_color   = ( isset( $collapse_button_fields['eap_faq_collapse_button_color']['color2'] ) && $collapse_button_fields['eap_faq_collapse_button_color']['color2'] ? $collapse_button_fields['eap_faq_collapse_button_color']['color2'] : '#fd7d4e' );
$multi_column_class         = $multi_column ? '.eap-multi-items-container>' : '';
$ea_dynamic_css            .= '#sp-ea-' . $accordion_id . ' .spcollapsing{height: 0; overflow: hidden; transition-property: height; transition-duration: ' . $eap_animation_time . 'ms;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.eap_inactive>.ea-header a{background-color: #bb0000 !important; color: #fff !important;}';
if ( $eap_preloader ) {
	$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '{position: relative;}#sp-ea-' . $accordion_id . ' .ea-card{opacity: 0;}#eap-preloader-' . $accordion_id . '{position: absolute; left: 0; top: 0; height: 100%; width: 100%; text-align: center; display: flex; align-items: center; justify-content: center;}';
} if ( $acc_section_title ) {
	$section_title_font_load = isset( $shortcode_data['section_title_font_load'] ) ? $shortcode_data['section_title_font_load'] : '';
	$ea_dynamic_css         .= '
	#poststuff .eap_section_title_' . $accordion_id . ',
	.post-type-sp_easy_accordion .eap_section_title_' . $accordion_id . ',
	.eap_section_title_' . $accordion_id . '{color: ' . $section_title_typho_color . '; font-size: ' . $section_title_typho_size . 'px; line-height: ' . $section_title_typho_height . 'px; text-align: ' . $section_title_typho_alignment . '; letter-spacing: ' . $section_title_typho_spacing . 'px; text-transform: ' . $section_title_typho_transform . '; margin-bottom: ' . $section_title_bottom_margin . 'px; padding:0px;';
	if ( $section_title_font_load && ! empty( $section_title_typho_family ) && $eap_dequeue_google_font ) {
		$eapro_typography[] = $section_title_typho;
		$ea_dynamic_css    .= 'font-family: ' . $section_title_typho_family . '; font-weight: ' . $section_title_typho_weight . '; font-style: ' . $section_title_typho_style . ';';
	} $ea_dynamic_css .= '}';
} if ( 'vertical' === $accordion_layout ) {
	$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{ margin-bottom: ' . $acc_bottom_margin . 'px; border: ' . $eap_border_width . 'px ' . $eap_border['style'] . ' ' . $eap_border['color'] . '; border-radius: ' . $acc_border_radius . ';}';
	switch ( $eap_title_bg_color_type ) {
		case 'solid':
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{background: ' . $eap_header_bg_normal . ';}
				#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a{background: ' . $eap_header_bg_active . ';}
				#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a{background: ' . $eap_header_bg_hover . ';}';
			break;
		case 'gradient':
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{
					background-color: ' . $eap_background_color . ';
					background-image: linear-gradient( ' . $eap_gradient_direction . ' , ' . $eap_background_color . ', ' . $eap_gradient_color . ' );}';
			break;
	}
	$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .eap-title-icon{ color: ' . $eap_title_icon_color_normal . ';font-size: ' . $eap_title_icon_size . 'px;} #sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .eap-title-custom-icon{ max-width: ' . $eap_title_icon_size . 'px; }#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .eap-title-icon{color: ' . $eap_title_icon_color_hover . ';} #sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .eap-title-icon{color: ' . $eap_title_icon_color_active . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{padding: ' . $eap_title_padding_top . 'px ' . $eap_title_padding_right . 'px ' . $eap_title_padding_bottom . 'px ' . $eap_title_padding_left . 'px; color: ' . $eap_title_typho_color . '; font-size: ' . $eap_title_typho_size . 'px; line-height: ' . $eap_title_typho_height . 'px; text-align: ' . $eap_title_typho_align . '; letter-spacing: ' . $eap_title_typho_spacing . 'px; text-transform: ' . $eap_title_typho_transform . ';';
	if ( $eap_title_font_load && ! empty( $eap_title_typho_family ) && $eap_dequeue_google_font ) {
		$eapro_typography[] = $eap_title_typho;
		$ea_dynamic_css    .= 'font-family: ' . $eap_title_typho_family . '; font-weight: ' . $eap_title_typho_weight . '; font-style: ' . $eap_title_typho_style . ';';
	}
	$ea_dynamic_css .= '}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a{color: ' . $eap_title_typho_hcolor . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a{color: ' . $eap_title_typho_acolor . ';}';
	$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.sp-collapse>.ea-body p,#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.sp-collapse>.ea-body{background: ' . $eap_description_bg . '; padding: ' . $eap_des_padding_top . 'px ' . $eap_des_padding_right . 'px ' . $eap_des_padding_bottom . 'px ' . $eap_des_padding_left . 'px; border-radius: 0 0 ' . $acc_border_radius . ' ' . $acc_border_radius . '; color: ' . $eap_content_typo_color . '; font-size: ' . $eap_content_typo_size . 'px; text-align: ' . $eap_content_typo_alignment . '; letter-spacing: ' . $eap_content_typo_spacing . 'px; line-height: ' . $eap_content_typo_height . 'px; animation-delay: 200ms; text-transform: ' . $eap_content_typo_transform . ';';
	if ( $eap_desc_font_load ) {
		$eapro_typography[] = $eap_content_typo;
		$ea_dynamic_css    .= 'font-family: ' . $eap_content_typo_family . '; font-weight: ' . $eap_content_typo_weight . '; font-style: ' . $eap_content_typo_style . ';';
	} $ea_dynamic_css .= '}';
	$ea_dynamic_css   .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{color: ' . $eap_icon_color_normal . '; font-size: ' . $eap_icon_size . 'px; font-style: normal;}
	#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon.fa{color: ' . $eap_icon_color_hover . ';}
	#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon.fa{color: ' . $eap_icon_color_active . ';}';
	if ( $eap_accordion_fillspace ) {
		$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single .ea-body{display: block; height: ' . $eap_accordion_fillspace_height . 'px; overflow: auto;}';
	} if ( 'sp-ea-one' === $accordion_theme_class ) {
		$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{border-radius: ' . $acc_border_radius . '; border: ' . $eap_border_width . 'px ' . $eap_border['style'] . ' ' . $eap_border['color'] . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.sp-collapse>.ea-body{border-radius: 0 0 ' . $acc_border_radius . ' ' . $acc_border_radius . '; border: none;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{float: ' . $eap_ex_icon_position . '; margin-right: ' . $eap_icon_margin_right . 'px;}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{margin-right: 0; margin-left: ' . $eap_icon_margin_right . 'px;}';
		}
	} if ( 'sp-ea-two' === $accordion_theme_class ) {
		$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{border: ' . $eap_border_width . 'px ' . $eap_border['style'] . ' ' . $eap_border['color'] . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.sp-collapse>.ea-body{border: none;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_normal . '; border-radius: ' . $eap_icon_radius . '; line-height:' . $eap_icon_height . 'px; width: ' . $eap_icon_width . 'px; margin-right: ' . $eap_icon_margin_right . 'px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon{background: ' . $eap_icon_bg_hover . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_hover . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{clear: both; overflow: hidden;}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{margin-right: 0; overflow: hidden; float: ' . $eap_ex_icon_position . '; margin-left: ' . $eap_icon_margin_right . 'px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.sp-collapse>.ea-body{border: none; padding-left: ' . $eap_des_padding['left'] . 'px;}';
		}
	} if ( 'sp-ea-three ea-icon-style-three' === $accordion_theme_class ) {
		$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{position: relative; padding-left:' . intval( $eap_icon_margin_right + 60 ) . 'px !important;}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.ea-icon-style-three.sp-easy-accordion .sp-ea-single>.ea-header a .ea-expand-icon.fa{right: -10px; left: auto;}#sp-ea-' . $accordion_id . '.ea-icon-style-three.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{border-radius: 0 ' . $eap_icon_radius . ' ' . $eap_icon_radius . ' 0px; background: ' . $eap_icon_bg_normal . ';}#sp-ea-' . $accordion_id . '.ea-icon-style-three.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon{background: ' . $eap_icon_bg_hover . ';}#sp-ea-' . $accordion_id . '.ea-icon-style-three.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_active . ';}#sp-ea-' . $accordion_id . '.ea-icon-style-three.sp-easy-accordion .sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{border-radius: 0px ' . $eap_icon_radius . ' 0px 0px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{padding-left: ' . $eap_title_padding['left'] . 'px !important; padding-right:' . intval( $eap_icon_margin_right + 60 ) . 'px !important;}';
		} else {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.ea-icon-style-three.sp-easy-accordion .sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{border-radius: ' . $eap_icon_radius . ' 0 0 0;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{border: ' . $eap_border_width . 'px ' . $eap_border['style'] . ' ' . $eap_border['color'] . ';}#sp-ea-' . $accordion_id . '.ea-icon-style-three.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{border-radius: ' . $eap_icon_radius . ' 0 0 ' . $eap_icon_radius . '; background: ' . $eap_icon_bg_normal . ';}#sp-ea-' . $accordion_id . '.ea-icon-style-three.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon{background: ' . $eap_icon_bg_hover . ';}#sp-ea-' . $accordion_id . '.ea-icon-style-three.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_active . ';}';
		}
	} if ( 'sp-ea-four ea-icon-style-three' === $accordion_theme_class ) {
		if ( ! empty( $eap_icon_bg_normal ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon:after{border-color: transparent transparent transparent ' . $eap_icon_bg_normal . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_normal . ';}';
		} if ( ! empty( $eap_icon_bg_hover ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon:after{border-color: transparent transparent transparent ' . $eap_icon_bg_hover . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon{background: ' . $eap_icon_bg_hover . ';}';
		} if ( ! empty( $eap_icon_bg_active ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon:after{border-color: transparent transparent transparent ' . $eap_icon_bg_active . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_active . ';}';
		} $ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{position: relative; padding-left:' . intval( $eap_title_padding['right'] + 70 ) . 'px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{border-radius: ' . $acc_border_radius . ' 0 0 ' . $acc_border_radius . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{border-radius: ' . $acc_border_radius . ' 0 0 0;}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{
				margin-right: 0;
				margin-left: ' . $eap_icon_margin_right . 'px;
				left: auto;
				right:0;
				border-radius: 0 ' . $acc_border_radius . ' ' . $acc_border_radius . ' 0;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon:after{
				left:-14px;
				right:auto;
				border-width: 11px 14px 11px 0;
                border-color: transparent ' . $eap_icon_bg_normal . ' transparent transparent;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{
				border-radius: 0 ' . $acc_border_radius . ' 0 0;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon:after{border-color: transparent ' . $eap_icon_bg_active . ' transparent transparent;}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{
				padding-left: ' . $eap_title_padding['left'] . 'px;
				padding-right:' . intval( $eap_title_padding['right'] + 70 ) . 'px;
			}';
		}
	} if ( 'sp-ea-five ea-icon-style-three' === $accordion_theme_class ) {
		if ( ! empty( $eap_icon_bg_normal ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon:after{border-color: transparent transparent transparent ' . $eap_icon_bg_normal . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_normal . ';}';
		} if ( ! empty( $eap_icon_bg_hover ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon:after{border-color: transparent transparent transparent ' . $eap_icon_bg_hover . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon{background: ' . $eap_icon_bg_hover . ';}';
		} if ( ! empty( $eap_icon_bg_active ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon:after{border-color: transparent transparent transparent ' . $eap_icon_bg_active . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_active . ';}';
		} $ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{position: relative; padding-left:' . intval( $eap_title_padding['right'] + 65 ) . 'px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{border-radius: ' . $acc_border_radius . ' 0 0 ' . $acc_border_radius . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{border-radius: ' . $acc_border_radius . ' 0 0 0;}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{
				margin-right: 0;
				margin-left: ' . $eap_icon_margin_right . 'px;
				left: auto;
				right:0;
				padding-right: 22px;
				padding-left: 0;
				border-radius: 0 ' . $acc_border_radius . ' ' . $acc_border_radius . ' 0;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon:after{
				left:-30px;
				right:auto;
				border-width: 30px 30px 30px 0;
                border-color: transparent ' . $eap_icon_bg_normal . ' transparent transparent;
			}
            #sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{
				border-radius: 0 ' . $acc_border_radius . ' 0 0;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon:after{
				border-color: transparent ' . $eap_icon_bg_active . ' transparent transparent;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{
				padding-left: ' . $eap_title_padding['left'] . 'px;
				padding-right:' . intval( $eap_title_padding['right'] + 65 ) . 'px;
			}';
		}
	} if ( 'sp-ea-six ea-icon-style-three' === $accordion_theme_class ) {
		if ( ! empty( $eap_icon_bg_normal ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon:after{border-color: transparent transparent transparent ' . $eap_icon_bg_normal . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_normal . ';}';
		} if ( ! empty( $eap_icon_bg_hover ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon:after{border-color: transparent transparent transparent ' . $eap_icon_bg_hover . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon{background: ' . $eap_icon_bg_hover . ';}';
		} if ( ! empty( $eap_icon_bg_active ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon:after{border-color: transparent transparent transparent ' . $eap_icon_bg_active . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_active . ';}';
		} $ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{padding-left:' . intval( $eap_icon_margin_right + 70 ) . 'px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{border-radius: ' . $acc_border_radius . ' 0 0 ' . $acc_border_radius . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{border-radius: ' . $acc_border_radius . ' 0 0 0;}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{
				margin-right: 0;
				margin-left: ' . $eap_icon_margin_right . 'px;
				left: auto;
				right:0;
				padding-left: 0;
				border-radius: 0 ' . $acc_border_radius . ' ' . $acc_border_radius . ' 0;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon:after{
				left:-17px;
				right:auto;
				border-width: 17px 17px 17px 0;
                border-color: transparent ' . $eap_icon_bg_normal . ' transparent transparent;
			}
            #sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{
				border-radius: 0 ' . $acc_border_radius . ' 0 0;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon:after{
				border-color: transparent ' . $eap_icon_bg_active . ' transparent transparent;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{
				padding-left: ' . $eap_title_padding['left'] . 'px;
				padding-right:' . intval( $eap_title_padding['right'] + 70 ) . 'px;
			}';
		}
	} if ( 'sp-ea-seven' === $accordion_theme_class ) {
		$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{background: transparent; margin-bottom: 10px; border-radius: 0; border: none;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.sp-collapse>.ea-body{border: 0;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header{border-left: ' . $eap_border_width . 'px ' . $eap_border['style'] . ' ' . $eap_border['color'] . ';}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{float: ' . $eap_ex_icon_position . '; margin-left:' . $eap_icon_margin_right . 'px !important;}';
		} else {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{float: ' . $eap_ex_icon_position . '; margin-right:' . $eap_icon_margin_right . 'px !important;}';
		}
	} if ( 'sp-ea-eight ea-icon-style-three' === $accordion_theme_class ) {
		if ( ! empty( $eap_icon_bg_normal ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon:after{border-color:' . $eap_icon_bg_normal . ' transparent transparent transparent ;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_normal . ';}';
		} if ( ! empty( $eap_icon_bg_hover ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon:after{border-color: ' . $eap_icon_bg_hover . ' transparent transparent transparent ;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>.sp-ea-single>.ea-header:hover a .ea-expand-icon{background: ' . $eap_icon_bg_hover . ';}';
		} if ( ! empty( $eap_icon_bg_active ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon:after{border-color: ' . $eap_icon_bg_active . ' transparent transparent transparent;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_active . ';}';
		} $ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{padding-left:' . intval( $eap_icon_margin_right + 65 ) . 'px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{border-radius: ' . $acc_border_radius . ' 0 0 ' . $acc_border_radius . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{border-radius: ' . $acc_border_radius . ' 0 0 0;}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{
				margin-right: 0;
				margin-left: ' . $eap_icon_margin_right . 'px;
				left: auto;
				right:0;
				padding-right: 10px;
				padding-left: 0;
				border-radius: 0 ' . $acc_border_radius . ' ' . $acc_border_radius . ' 0;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon:after{
				left:-35px;
				right:auto;
				border-width: 0 35px 60px 0;
                border-color: transparent ' . $eap_icon_bg_normal . ' transparent transparent ;
			}
            #sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{
				border-radius: 0 ' . $acc_border_radius . ' 0 0;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon:after{
				border-color: transparent ' . $eap_icon_bg_active . ' transparent transparent;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{
				padding-left: ' . $eap_title_padding['left'] . 'px;
				padding-right:' . intval( $eap_icon_margin_right + 65 ) . 'px;
			}';
		}
	} if ( 'sp-ea-nine ea-icon-style-three' === $accordion_theme_class ) {
		if ( ! empty( $eap_icon_bg_normal ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon:after{border-color: transparent transparent transparent ' . $eap_icon_bg_normal . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_normal . ';}';
		} if ( ! empty( $eap_icon_bg_hover ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon:after{border-color: transparent transparent transparent ' . $eap_icon_bg_hover . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon{background: ' . $eap_icon_bg_hover . ';}';
		} if ( ! empty( $eap_icon_bg_active ) ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon:after{border-color: transparent transparent transparent ' . $eap_icon_bg_active . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_active . ';}';
		} $ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{padding-left:' . intval( $eap_icon_margin_right + 70 ) . 'px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{border-radius: ' . $acc_border_radius . ' 0 0 ' . $acc_border_radius . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{border-radius: ' . $acc_border_radius . ' 0 0 0;}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{
				margin-right: 0;
				margin-left: ' . $eap_icon_margin_right . 'px;
				left: auto;
				right:0;
				padding-right: 10px;
				padding-left: 0;
				border-radius: 0 ' . $acc_border_radius . ' ' . $acc_border_radius . ' 0;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon:after{
				left:-35px;
				right:auto;
				border-width: 60px 35px 0 0;
                border-color: transparent ' . $eap_icon_bg_normal . ' transparent transparent ;
			}
            #sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{
				border-radius: 0 ' . $acc_border_radius . ' 0 0;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon:after{
				border-color: transparent ' . $eap_icon_bg_active . ' transparent transparent;
			}
			#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{
				padding-left: ' . $eap_title_padding['left'] . 'px;
				padding-right:' . intval( $eap_icon_margin_right + 70 ) . 'px;
			}';
		}
	} if ( 'sp-ea-ten' === $accordion_theme_class ) {
		$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{border: ' . $eap_border_width . 'px ' . $eap_border['style'] . ' ' . $eap_border['color'] . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand{background-color: ' . $eap_expand_bg . ';} #sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand .ea-header{background-color: ' . $eap_expand_bg . '; border-top: ' . $eap_expand_border_width . 'px ' . $eap_expand_border['style'] . ' ' . $eap_expand_border['color'] . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand .ea-header a{background-color: ' . $eap_expand_bg . ' !important;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{margin-right: ' . $eap_icon_margin_right . 'px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{float: ' . $eap_ex_icon_position . ';}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{margin-right: 0;}';
		}
	} if ( 'sp-ea-eleven' === $accordion_theme_class ) {
		$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion.sp-ea-eleven>.sp-ea-single{background: none; border: none;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{border-radius: ' . $acc_header_border_radius . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{margin-right: ' . $eap_icon_margin_right . 'px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{float: ' . $eap_ex_icon_position . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{border: none}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{margin-right: 0;}';
		}
	} if ( 'sp-ea-twelve' === $accordion_theme_class ) {
		$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single .ea-body{border: 0;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{background: transparent; border: none;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{border-left: ' . $eap_border_width . 'px ' . $eap_border['style'] . ' ' . $eap_border['color'] . '; border-radius: 0; border-bottom: ' . $eap_border_width . 'px ' . $eap_border['style'] . ' ' . $eap_border['color'] . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{margin-right: ' . $eap_icon_margin_right . 'px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{float: ' . $eap_ex_icon_position . ';}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{margin-right: 0;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{border-right: ' . $eap_border_width . 'px ' . $eap_border['style'] . ' ' . $eap_border['color'] . '; border-left:0}';
		}
	} if ( 'sp-ea-thirteen' === $accordion_theme_class ) {
		$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{border-radius: 0;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{background: none; overflow: visible;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .sp-numbering{background: ' . $eap_icon_bg_hover . '; color: ' . $eap_icon_color_hover . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .sp-numbering{background: ' . $eap_icon_bg_active . '; color: ' . $eap_icon_color_active . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .sp-numbering{line-height: 60px; color: ' . $eap_icon_color_normal . '; background: ' . $eap_icon_bg_normal . '; top: 0; border-radius: ' . $eap_icon_radius . ';}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .sp-numbering{right: -70px; left: auto;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{margin-left: 0; margin-right: 70px;}';
		}
	} if ( 'sp-ea-fourteen sp-ea-thirteen' === $accordion_theme_class ) {
		$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{border-radius: 0;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .sp-numbering .ea-expand-icon{background: none;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .sp-numbering{background: ' . $eap_icon_bg_normal . '; color: ' . $eap_icon_color_normal . '; line-height: 56px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .sp-numbering{background: ' . $eap_icon_bg_hover . '; color: ' . $eap_icon_color_hover . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .sp-numbering{background: ' . $eap_icon_bg_active . '; color: ' . $eap_icon_color_active . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{background: none; overflow: visible;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .sp-numbering{line-height: 60px; color: ' . $eap_icon_color_normal . '; background: ' . $eap_icon_bg_normal . '; top: 0;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .sp-numbering{color: ' . $eap_icon_color_hover . '; background: ' . $eap_icon_bg_hover . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .sp-numbering{color: ' . $eap_icon_color_active . '; background: ' . $eap_icon_bg_active . ';}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .sp-numbering{right: -70px; left: auto;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{margin-left: 0; margin-right: 70px;}';
		}
	} if ( 'sp-ea-fifteen' === $accordion_theme_class ) {
		$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{background: transparent; border: none;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{border-bottom: ' . $eap_border_width . 'px ' . $eap_border['style'] . ' ' . $eap_border['color'] . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_normal . '; border-radius: ' . $eap_icon_radius . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon{background: ' . $eap_icon_bg_hover . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_active . ';}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{margin-right: 0; overflow: hidden; float: ' . $eap_ex_icon_position . '; margin-left: ' . $eap_icon_margin_right . 'px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.sp-collapse>.ea-body{border: none; padding-left: ' . $eap_des_padding['left'] . 'px;}';
		}
	} if ( 'sp-ea-sixteen' === $accordion_theme_class ) {
		$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{background: transparent; border: none;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{background: transparent; border-bottom: ' . $eap_border_width . 'px ' . $eap_border['style'] . ' ' . $eap_border['color'] . '; padding: 0;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon{line-height:' . $eap_icon_height . 'px; width: ' . $eap_icon_width . 'px; background: ' . $eap_icon_bg_normal . '; margin-right: ' . $eap_icon_margin_right . 'px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header:hover a .ea-expand-icon{background: ' . $eap_icon_bg_hover . ';}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a .ea-expand-icon{background: ' . $eap_icon_bg_hover . ';}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{margin-right: 0; overflow: hidden; float: ' . $eap_ex_icon_position . '; margin-left: ' . $eap_icon_margin_right . 'px;}#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{line-height: ' . $eap_icon_height . 'px;padding-left: ' . $eap_des_padding['left'] . 'px;}';
		}
	}
	if ( 'sp-ea-seventeen' === $accordion_theme_class ) {
		$ea_dynamic_css .= '
		#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single{
			border: 0 ' . $eap_border['style'] . ' ' . $eap_border['color'] . ';
			border-radius: ' . $acc_border_radius . ';
			background: transparent;
			border-top-width: ' . $eap_border_width . 'px;
			margin-bottom: 0;
			border-radius:0;
		}
		#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.sp-collapse>.ea-body p,
		#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.sp-collapse>.ea-body,
		#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single.ea-expand>.ea-header a,
		#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a{
			background: transparent;
		}
		#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{float: ' . $eap_ex_icon_position . '; margin-right: ' . $eap_icon_margin_right . 'px;}';
		if ( 'right' === $eap_ex_icon_position ) {
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.ea-header a .ea-expand-icon.fa{margin-right: 0; margin-left: ' . $eap_icon_margin_right . 'px;}';
		}
	}
} if ( 'horizontal' === $accordion_layout ) {
	$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal, #sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal>.ea-header{-webkit-transition: width ' . $eap_animation_time . 'ms ease; -moz-transition: width ' . $eap_animation_time . 'ms ease; -ms-transition: width ' . $eap_animation_time . 'ms ease; -o-transition: width ' . $eap_animation_time . 'ms ease; transition: width ' . $eap_animation_time . 'ms ease;}#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal{width: ' . $accordion_header_width . 'px; height: ' . $accordion_height . 'px; background: ' . $eap_description_bg . '; border: ' . $eap_border_width . 'px ' . $eap_border['style'] . ' ' . $eap_border['color'] . '; border-radius: ' . $acc_border_radius . '; margin-right: ' . $acc_bottom_margin . 'px; ;}#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal>.ea-header{width: ' . $accordion_height . 'px; top: ' . $accordion_height . 'px; ;}
	#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal>.ea-header{height: ' . ( (int) $accordion_header_width - (int) ( $eap_border['all'] * 2 ) ) . 'px}
	';
	switch ( $eap_title_bg_color_type ) {
		case 'solid':
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal>.ea-header{ background: ' . $eap_header_bg_normal . ';}
			#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal>.ea-header:hover{background: ' . $eap_header_bg_hover . ';}
			#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal.ea-expand>.ea-header{background: ' . $eap_header_bg_active . '; z-index: 9999;}';
			break;
		case 'gradient':
			$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal>.ea-header{
					background-color: ' . $eap_background_color . ';
					background-image: linear-gradient( ' . $eap_gradient_direction . ' , ' . $eap_background_color . ', ' . $eap_gradient_color . ' );}';
			break;
	}
	$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-horizontal-accordion > .single-horizontal:last-of-type {
		border-right: ' . $eap_border_width . 'px ' . $eap_border['style'] . ' ' . $eap_border['color'] . ';
		margin-right: 0;
	}
	#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal .ea-header a {
		color: ' . $eap_title_typho_color . ';
		font-size: ' . $eap_title_typho_size . 'px;
		letter-spacing: ' . $eap_title_typho_spacing . 'px;
		text-transform: ' . $eap_title_typho_transform . ';';
	if ( $eap_title_font_load && ! empty( $eap_title_typho_family ) && $eap_dequeue_google_font ) {
		$eapro_typography[] = $eap_title_typho;
		$ea_dynamic_css    .= 'font-family: ' . $eap_title_typho_family . '; font-weight: ' . $eap_title_typho_weight . '; font-style: ' . $eap_title_typho_style . ';';
	}
	$ea_dynamic_css .= '}
	#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal .ea-header:hover a {
		color: ' . $eap_title_typho_hcolor . ';
	}
	#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal.ea-expand>.ea-header a {
		color: ' . $eap_title_typho_acolor . ';
	}
	#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal>.ea-header {
		line-height: ' . $eap_title_typho_height . 'px;
		text-align: ' . $eap_title_typho_align . ';
	}
	#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal>.sp-collapse>.ea-body {
		margin-left: ' . ( (int) $accordion_header_width - (int) ( $eap_border['all'] * 2 ) ) . 'px; height: ' . $accordion_height . 'px; overflow: auto;
		animation-delay: ' . $eap_animation_time . 'ms;
		padding: ' . $eap_des_padding['top'] . 'px ' . $eap_des_padding['right'] . 'px ' . $eap_des_padding['bottom'] . 'px ' . $eap_des_padding['left'] . 'px;
		background: ' . $eap_description_bg . ';
		border-radius: 0 0 ' . $acc_border_radius . ' ' . $acc_border_radius . ';
		color: ' . $eap_content_typo_color . ';
		font-size: ' . $eap_content_typo_size . 'px;
		text-align: ' . $eap_content_typo_alignment . ';
		letter-spacing: ' . $eap_content_typo_spacing . 'px;
		line-height: ' . $eap_content_typo_height . 'px;
		text-transform: ' . $eap_content_typo_transform . ';';
	if ( $eap_desc_font_load ) {
		$eapro_typography[] = $eap_content_typo;
		$ea_dynamic_css    .= 'font-family: ' . $eap_content_typo_family . ';
		font-weight: ' . $eap_content_typo_weight . ';
		font-style: ' . $eap_content_typo_style . ';';
	}
	$ea_dynamic_css .= '}';
	$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal>.ea-header a .ea-expand-icon{
		margin-right: ' . $eap_icon_margin_right . 'px;
		font-size: ' . $eap_icon_size . 'px;
		color: ' . $eap_icon_color_normal . ';
	}
	#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal>.ea-header:hover a .ea-expand-icon{
		color: ' . $eap_icon_color_hover . ';
	}
	#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal.ea-expand>.ea-header a .ea-expand-icon{
		color: ' . $eap_icon_color_active . ';
	}';
	if ( 'right' === $eap_ex_icon_position_hr ) {
		$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-horizontal-accordion>.single-horizontal>.ea-header a .ea-expand-icon{
			float: right; line-height: 60px; padding-right: 9px;
		}';
	}
}
$ea_dynamic_css .= '#sp-ea-' . $accordion_id . ' #eap_faq_search_bar_container input{display:none; opacity:0;}
#sp-ea-' . $accordion_id . ' #eap_faq_search_bar_container ::before{content:"";}';
// Collapse/Expand button.
if ( $faq_collapse_button ) {
	$ea_dynamic_css .= '#sp-eap-accordion-section-' . $accordion_id . ' .eap_faq_collapse_button {text-align: ' . $collapse_button_alignment . '}';
	$ea_dynamic_css .= '#sp-eap-accordion-section-' . $accordion_id . ' .eap_faq_collapse_button a {color: ' . $collapse_button_text_color . '; background-color: ' . $collapse_button_bg_color . '}';
	$ea_dynamic_css .= '#sp-eap-accordion-section-' . $accordion_id . ' .eap_faq_collapse_button a:hover {filter: brightness(90%)}';
}
$ea_dynamic_css .= '#sp-ea-' . $accordion_id . '.sp-easy-accordion>' . $multi_column_class . '.sp-ea-single>.sp-collapse>.ea-body p{ padding:0px}';

// Pagination Style.
$show_pagination = isset( $shortcode_data['show_pagination'] ) ? $shortcode_data['show_pagination'] : false;

if ( $show_pagination ) {
	$pagination_color = isset( $shortcode_data['pagination_color'] ) ? $shortcode_data['pagination_color'] : array(
		'text_color'        => '#5e5e5e',
		'text_active_clr'   => '#ffffff',
		'border_color'      => '#bbbbbb',
		'border_active_clr' => '#FE7C4D',
		'background'        => '#ffffff',
		'active_background' => '#FE7C4D',
	);
	// Accordion number pagination color.
	$ea_dynamic_css .= '#sp-eap-accordion-section-' . $accordion_id . ' .sp-eap-pagination-number a.sp-eap-page-numbers {
		color: ' . $pagination_color['text_color'] . ';
		border-color: ' . $pagination_color['border_color'] . ';
		background: ' . $pagination_color['background'] . ';
	}';
	$ea_dynamic_css .= '#sp-eap-accordion-section-' . $accordion_id . ' .sp-eap-pagination-number a.sp-eap-page-numbers.active {
		color: ' . $pagination_color['text_active_clr'] . ';
		border-color: ' . $pagination_color['border_active_clr'] . ';
		background: ' . $pagination_color['active_background'] . ';
	}';
	$ea_dynamic_css .= '#sp-eap-accordion-section-' . $accordion_id . ' .sp-eap-pagination-number a.sp-eap-page-numbers:hover {
		color: ' . $pagination_color['text_active_clr'] . ';
		border-color: ' . $pagination_color['border_active_clr'] . ';
		background: ' . $pagination_color['active_background'] . ';
	}';
	// Accordion load more pagination color.
	$ea_dynamic_css .= '#sp-eap-accordion-section-' . $accordion_id . ' .sp-eap-load-more button {
		color: ' . $pagination_color['text_color'] . ';
		border-color: ' . $pagination_color['border_color'] . ';
		background: ' . $pagination_color['background'] . ';
	}';
	$ea_dynamic_css .= '#sp-eap-accordion-section-' . $accordion_id . ' .sp-eap-load-more button:hover {
		color: ' . $pagination_color['text_active_clr'] . ';
		border-color: ' . $pagination_color['border_active_clr'] . ';
		background: ' . $pagination_color['active_background'] . ';
	}';
}
$accordion_layout = isset( $shortcode_data['eap_accordion_layout'] ) ? $shortcode_data['eap_accordion_layout'] : '';
if ( 'multi-column' === $accordion_layout ) {
	$ea_dynamic_css .= '#sp-eap-accordion-section-' . $accordion_id . ' .sp-easy-accordion.ea-multi-column{
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		align-items: start;
		justify-content: space-between;
		overflow: hidden;
		box-sizing: border-box;
    }
	#sp-eap-accordion-section-' . $accordion_id . ' .sp-easy-accordion> .eap-multi-items-container{
		flex: 0 0 50%;
		width: 50%;
		padding-right: ' . $acc_bottom_margin . 'px;
		float: left;
		box-sizing: border-box;
		height: auto;
	}
	#sp-eap-accordion-section-' . $accordion_id . ' .sp-easy-accordion> .eap-multi-items-container:nth-last-child(1){
		padding-right:0;
	}';
}
$pagination_alignment = isset( $shortcode_data['pagination_alignment'] ) ? $shortcode_data['pagination_alignment'] : '';
if ( $pagination_alignment ) {
	$ea_dynamic_css .= '#sp-eap-accordion-section-' . $accordion_id . '.sp-eap-container .sp-eap-infinite-scroll-loader,#sp-eap-accordion-section-' . $accordion_id . '.sp-eap-container div:is(.sp-eap-load-more,.sp-eap-ajax-number-pagination){
	text-align:' . $pagination_alignment . ';
}';
}
