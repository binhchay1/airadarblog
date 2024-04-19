<?php
/**
 * The options config of the plugin .
 *
 * @link https://shapedplugin.com
 * @since 2.0.11
 *
 * @package Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Set a unique slug-like ID.
//
$prefix = 'sp_eap_settings';

//
// Create options.
//
SP_EAP::createOptions(
	$prefix,
	array(
		'menu_title'       => __( 'Settings', 'easy-accordion-pro' ),
		'menu_slug'        => 'eap_settings',
		'menu_parent'      => 'edit.php?post_type=sp_easy_accordion',
		'menu_type'        => 'submenu',
		'ajax_save'        => true,
		'show_bar_menu'    => false,
		'save_defaults'    => true,
		'show_reset_all'   => false,
		'show_all_options' => false,
		'show_search'      => false,
		'show_footer'      => false,
		'framework_title'  => __( 'Settings', 'easy-accordion-pro' ),
		'framework_class'  => 'sp-eap-options',
		'theme'            => 'light',
	)
);

//
// License key section.
//
SP_EAP::createSection(
	$prefix,
	array(
		'id'     => 'license_key_section',
		'title'  => __( 'License Key', 'easy-accordion-pro' ),
		'icon'   => 'fa fa-key',
		'fields' => array(
			array(
				'id'   => 'license_key',
				'type' => 'license',
			),
		),
	)
);


//
// Create a section.
//
SP_EAP::createSection(
	$prefix,
	array(
		'title'  => __( 'Advanced Controls', 'easy-accordion-pro' ),
		'icon'   => 'fa fa-wrench',
		'fields' => array(
			array(
				'id'         => 'eap_data_remove',
				'type'       => 'checkbox',
				'title'      => __( 'Clean-up Data on Deletion', 'easy-accordion-pro' ),
				'title_info' => __( 'Check this if you would like Easy Accordion Pro to completely remove all of its data when the plugin is deleted.', 'easy-accordion-pro' ),
				'default'    => false,
			),
			array(
				'id'         => 'eap_focus_style',
				'type'       => 'checkbox',
				'class'      => 'eap-focus-style',
				'title'      => __( 'Focus Style for Accessibility', 'easy-accordion-pro' ),
				'title_info' => __( 'Check this to enable focus style to improve accessibility.', 'easy-accordion-pro' ),
				'default'    => false,
			),
			array(
				'id'         => 'eap_dequeue_google_font',
				'type'       => 'switcher',
				'title'      => __( 'Google Fonts', 'easy-accordion-pro' ),
				'default'    => false,
				'text_on'    => __( 'enqueued', 'easy-accordion-pro' ),
				'text_off'   => __( 'dequeued', 'easy-accordion-pro' ),
				'text_width' => '106',
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Asset Controls', 'easy-accordion-pro' ),
			),
			array(
				'id'         => 'eap_dequeue_fa_css',
				'type'       => 'switcher',
				'title'      => __( 'Font Awesome CSS', 'easy-accordion-pro' ),
				'default'    => true,
				'text_on'    => __( 'enqueued', 'easy-accordion-pro' ),
				'text_off'   => __( 'dequeued', 'easy-accordion-pro' ),
				'text_width' => '106',
			),
			array(
				'id'         => 'eap_dequeue_animation_css',
				'type'       => 'switcher',
				'title'      => __( 'Animation CSS', 'easy-accordion-pro' ),
				'default'    => true,
				'text_on'    => __( 'enqueued', 'easy-accordion-pro' ),
				'text_off'   => __( 'dequeued', 'easy-accordion-pro' ),
				'text_width' => '106',
			),
		),
	)
);
//
// Woo commerce faq.
//
SP_EAP::createSection(
	$prefix,
	array(
		'title'  => __( 'WooCommerce FAQs', 'easy-accordion-pro' ),
		'icon'   => 'fa fa-shopping-cart',
		'fields' => array(
			array(
				'type'    => 'submessage',
				'content' => __( 'Note: <a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a> is required to use this feature.', 'easy-accordion-pro' ),
				'style'   => 'warning',
			),
			array(
				'id'         => 'eap_woo_faq',
				'type'       => 'switcher',
				'title'      => __( 'WooCommerce FAQs Tab', 'easy-accordion-pro' ),
				'text_on'    => __( 'Enabled', 'easy-accordion-pro' ),
				'text_off'   => __( 'Disabled', 'easy-accordion-pro' ),
				'text_width' => '100',
				'default'    => false,
				'title_info' => __( '<div class="ea-info-label">WooCommerce FAQs Tab</div> <div class="ea-short-content">WooCommerce\'s FAQs tab gives quick answers to common customer queries about products and services.</div><div class="info-button"><a class="ea-open-live-demo" href="https://easyaccordion.io/product/ninja-t-shirt/" target="_blank">Live Demo</a></div>', 'easy-accordion-pro' ),
			),
			array(
				'id'         => 'eap_woo_faq_label',
				'type'       => 'text',
				'class'      => 'eap_woo_faq_label',
				'title'      => __( 'FAQs Tab Label', 'easy-accordion-pro' ),
				'title_info' => __( 'Set custom text for faq tab.', 'easy-accordion-pro' ),
				'default'    => __( 'FAQs', 'easy-accordion-pro' ),
				'dependency' => array( 'eap_woo_faq', '==', true ),
			),
			array(
				'id'         => 'eap_woo_faq_label_priority',
				'type'       => 'spinner',
				'class'      => 'eap_woo_faq_label_priority',
				'title'      => __( 'FAQs Tab Priority', 'easy-accordion-pro' ),
				'title_info' => __( 'Set WooCommerce FAQs tab priority position. Default value is 50.', 'easy-accordion-pro' ),
				'default'    => '50',
				'dependency' => array( 'eap_woo_faq', '==', true ),
			),
			array(
				'id'         => 'eap_woo_set_tab',
				'type'       => 'group',
				'title'      => 'FAQs Tabs',
				'fields'     => array(
					array(
						'id'      => 'eap_display_tab_for',
						'type'    => 'select',
						'title'   => __( 'Display FAQs on', 'easy-accordion-pro' ),
						'options' => array(
							'all'               => __( 'All Products', 'easy-accordion-pro' ),
							'taxonomy'          => __( 'Category', 'easy-accordion-pro' ),
							'Specific_Products' => __( 'Specific Products', 'easy-accordion-pro' ),
						),
						'default' => 'latest',
						'class'   => 'chosen',
					),
					array(
						'id'          => 'eap_specific_product',
						'type'        => 'select',
						'title'       => __( 'Specific Product(s)', 'easy-accordion-pro' ),
						'options'     => 'posts',
						'query_args'  => array(
							'post_type'      => 'product',
							'orderby'        => 'post_date',
							'order'          => 'DESC',
							'numberposts'    => 3000,
							'posts_per_page' => 3000,
							'cache_results'  => false,
							'no_found_rows'  => true,
						),
						'chosen'      => true,
						'sortable'    => true,
						'multiple'    => true,
						'placeholder' => __( 'Choose Product', 'easy-accordion-pro' ),
						'dependency'  => array( 'eap_display_tab_for', '==', 'Specific_Products' ),
					),
					array(
						'id'          => 'eap_taxonomy_terms',
						'type'        => 'select',
						'class'       => 'eap_taxonomy_terms',
						'title'       => __( 'Category Term(s)', 'easy-accordion-pro' ),
						'options'     => 'categories',
						'query_args'  => array(
							'post_type' => 'product',
							'taxonomy'  => 'product_cat',
						),
						'chosen'      => true,
						'sortable'    => true,
						'multiple'    => true,
						'placeholder' => __( 'Choose term(s)', 'easy-accordion-pro' ),
						'dependency'  => array( 'eap_display_tab_for', '==', 'taxonomy' ),
						'attributes'  => array(
							'style' => 'min-width: 250px;',
						),
					),
					array(
						'id'         => 'eap_woo_tab_shortcode',
						'type'       => 'select',
						'title'      => __( 'Select FAQs Group(s)', 'easy-accordion-pro' ),
						'options'    => 'shortcode_list',
						'query_args' => array(
							'post_type'      => 'sp_easy_accordion',
							'orderby'        => 'post_date',
							'order'          => 'DESC',
							'posts_per_page' => 100,
						),
						'chosen'     => true,
						'sortable'   => true,
						'multiple'   => true,
					),
				),
				'dependency' => array( 'eap_woo_faq', '==', true ),
				'attributes' => array(
					'style' => 'max-width: 250px;',
				),
			),
		),
	)
);

//
// Custom CSS Fields.
//
SP_EAP::createSection(
	$prefix,
	array(
		'id'     => 'custom_css_section',
		'title'  => __( 'Custom CSS & JS', 'easy-accordion-pro' ),
		'icon'   => 'fa fa-file-code-o',
		'fields' => array(
			array(
				'id'       => 'ea_custom_css',
				'type'     => 'code_editor',
				'title'    => __( 'Custom CSS', 'easy-accordion-pro' ),
				'settings' => array(
					'mode'  => 'css',
					'theme' => 'monokai',
				),
			),
			array(
				'id'       => 'custom_js',
				'type'     => 'code_editor',
				'title'    => __( 'Custom JS', 'easy-accordion-pro' ),
				'settings' => array(
					'theme' => 'monokai',
					'mode'  => 'javascript',
				),
			),
		),
	)
);
