<?php
/**
 * The tools config.
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
$prefix = 'sp_eap_tools';

//
// Create options.
//
SP_EAP::createOptions(
	$prefix,
	array(
		'menu_title'       => __( 'Tools', 'easy-accordion-pro' ),
		'menu_slug'        => 'eap_tools',
		'menu_parent'      => 'edit.php?post_type=sp_easy_accordion',
		'menu_type'        => 'submenu',
		'ajax_save'        => false,
		'show_bar_menu'    => false,
		'save_defaults'    => false,
		'show_reset_all'   => false,
		'show_all_options' => false,
		'show_search'      => false,
		'show_footer'      => false,
		'show_buttons'     => false, // Custom show button option added for hide save button in tools page.
		'framework_title'  => __( 'Tools', 'easy-accordion-pro' ),
		'framework_class'  => 'sp-eap-options eap_tools',
		'theme'            => 'light',
	)
);
SP_EAP::createSection(
	$prefix,
	array(
		'title'  => __( 'Export', 'easy-accordion-pro' ),
		'icon'   => 'fa fa-arrow-circle-o-down ',
		'fields' => array(
			array(
				'id'       => 'eap_what_export',
				'type'     => 'radio',
				'class'    => 'eap_what_export',
				'title'    => __( 'Choose What To Export', 'easy-accordion-pro' ),
				'multiple' => false,
				'options'  => array(
					'all_accordion'      => __( 'All Accordion Groups', 'easy-accordion-pro' ),
					'selected_accordion' => __( 'Selected Accordion group(s)', 'easy-accordion-pro' ),
				),
				'default'  => 'all_accordion',
			),
			array(
				'id'          => 'eap_post',
				'class'       => 'eap_post_ids',
				'type'        => 'select',
				'title'       => ' ',
				'options'     => 'sp_easy_accordion',
				'chosen'      => true,
				'sortable'    => false,
				'multiple'    => true,
				'placeholder' => __( 'Choose group(s)', 'easy-accordion-pro' ),
				'query_args'  => array(
					'posts_per_page' => -1,
				),
				'dependency'  => array( 'eap_what_export', '==', 'selected_accordion', true ),
			),
			array(
				'id'      => 'export',
				'class'   => 'eap_export',
				'type'    => 'button_set',
				'title'   => ' ',
				'options' => array(
					'' => 'Export',
				),
			),
		),
	)
);
SP_EAP::createSection(
	$prefix,
	array(
		'title'  => __( 'Import', 'easy-accordion-pro' ),
		'icon'   => 'fa fa-arrow-circle-o-up ',
		'fields' => array(
			array(
				'id'         => 'import_unSanitize',
				'type'       => 'checkbox',
				'title'      => __( 'Allow Iframe/Script Tags', 'easy-accordion-pro' ),
				'title_info' => __( 'Enabling this option, you are allowing to import the accordion which contains iframe, script or embed tags', 'easy-accordion-pro' ),
				'default'    => false,
			),
			array(
				'class' => 'eap_import',
				'type'  => 'custom_import',
				'title' => __( 'Import JSON File To Upload', 'easy-accordion-pro' ),
			),
		),
	)
);
