<?php
/**
 * The metabox config of the plugin.
 *
 * @link https://shapedplugin.com
 * @since 2.0.11
 *
 * @package Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.

//
// Metabox of the uppers section / Upload section.
// Set a unique slug-like ID.
//
$eap_accordion_content_source_settings = 'sp_eap_upload_options';

/**
 * Preview metabox.
 *
 * @param string $prefix The metabox main Key.
 * @return void
 */
SP_EAP::createMetabox(
	'sp_eap_live_preview',
	array(
		'title'        => __( 'Live Preview', 'easy-accordion-pro' ),
		'post_type'    => 'sp_easy_accordion',
		'show_restore' => false,
		'context'      => 'normal',
	)
);
SP_EAP::createSection(
	'sp_eap_live_preview',
	array(
		'fields' => array(
			array(
				'type' => 'preview',
			),
		),
	)
);

//
// Metabox of the footer section / shortcode section.
// Set a unique slug-like ID.
//
$eap_display_shortcode = 'sp_eap_display_shortcode_sidebar';

//
// Create a metabox.
//
SP_EAP::createMetabox(
	$eap_display_shortcode,
	array(
		'title'     => 'How To Use',
		'post_type' => 'sp_easy_accordion',
		'context'   => 'side',
	)
);

//
// Create a section.
//
SP_EAP::createSection(
	$eap_display_shortcode,
	array(
		'fields' => array(
			array(
				'type'  => 'shortcode',
				'class' => 'eap-admin-sidebar',
			),
		),
	)
);

//
// Create a metabox.
//
SP_EAP::createMetabox(
	$eap_accordion_content_source_settings,
	array(
		'title'     => __( 'Easy Accordion Pro', 'easy-accordion-pro' ),
		'post_type' => 'sp_easy_accordion',
		'context'   => 'normal',
	)
);

//
// Create a section.
//
SP_EAP::createSection(
	$eap_accordion_content_source_settings,
	array(
		'fields' => array(
			array(
				'type'  => 'heading',
				'image' => plugin_dir_url( __DIR__ ) . 'img/ea-logo.svg',
				'after' => '<i class="fa fa-life-ring"></i> Support',
				'link'  => 'https://shapedplugin.com/support/',
				'class' => 'eap-admin-header',
			),
			array(
				'id'      => 'eap_accordion_type',
				'class'   => 'eap_accordion_type',
				'type'    => 'button_set',
				'title'   => __( 'Accordion Type', 'easy-accordion-pro' ),
				'options' => array(
					'content-accordion' => '<img src="' . plugin_dir_url( __DIR__ ) . 'img/ea-content.svg"/>' . __( 'Content', 'easy-accordion-pro' ),
					'post-accordion'    => '<img src="' . plugin_dir_url( __DIR__ ) . 'img/ea-post.svg"/>' . __( 'Post', 'easy-accordion-pro' ),
				),
				'default' => 'content-accordion',
			),
			// Content Accordion.
			array(
				'id'                     => 'accordion_content_source',
				'type'                   => 'group',
				'title'                  => __( 'Content', 'easy-accordion-pro' ),
				'button_title'           => __( 'Add New Item', 'easy-accordion-pro' ),
				'class'                  => 'eap_accordion_content_wrapper',
				'accordion_title_prefix' => __( 'Item :', 'easy-accordion-pro' ),
				'accordion_title_number' => true,
				'accordion_title_auto'   => true,
				'fields'                 => array(
					array(
						'id'    => 'accordion_content_title',
						'type'  => 'text',
						'class' => 'eap-accordion-content-title',
						'title' => __( 'Accordion Title', 'easy-accordion-pro' ),
					),
					array(
						'id'           => 'accordion_content_icon',
						'type'         => 'icon',
						'wrap_class'   => 'eap_accordion_content_source',
						'button_title' => __( 'Font Icon', 'easy-accordion-pro' ),
						'dependency'   => array( 'accordion_custom_icon', '==', '' ),
					),
					array(
						'type'       => 'content',
						'content'    => __( 'Or', 'easy-accordion-pro' ),
						'dependency' => array( 'accordion_custom_icon|accordion_content_icon', '==|==', '' ),
					),
					array(
						'id'           => 'accordion_custom_icon',
						'type'         => 'media',
						'library'      => 'image',
						'url'          => false,
						'class'        => 'eap-custom-icon',
						'button_title' => __( 'Custom Icon', 'easy-accordion-pro' ),
						'remove_title' => __( 'Remove Icon', 'easy-accordion-pro' ),
						'dependency'   => array( 'accordion_content_icon', '==', '' ),
					),
					array(
						'id'         => 'accordion_content_description',
						'type'       => 'wp_editor',
						'wrap_class' => 'eap_accordion_content_source',
						'title'      => __( 'Description', 'easy-accordion-pro' ),
						'height'     => '150px',
						'sanitize'   => false,
					),
					array(
						'id'      => 'accordion_inactive',
						'type'    => 'checkbox',
						'class'   => 'eap-accordion-inactive',
						'title'   => __( 'Make it Inactive', 'easy-accordion-pro' ),
						'default' => false,
					),
					array(
						'id'      => 'hide_specific_accordion',
						'type'    => 'checkbox',
						'class'   => 'hide-accordion-inactive',
						'title'   => __( 'Hide this Item', 'easy-accordion-pro' ),
						'default' => false,
					),
				),
				'dependency'             => array( 'eap_accordion_type', '==', 'content-accordion' ),
			), // End of Content Accordion.
			// Post Accordion.
			array(
				'id'         => 'eap_post_type',
				'type'       => 'select',
				'title'      => __( 'Select Post Type', 'easy-accordion-pro' ),
				'options'    => 'post_type',
				'class'      => 'sp_eap_post_type',
				'attributes' => array(
					'placeholder' => __( 'Select Post Type', 'easy-accordion-pro' ),
					'style'       => 'min-width: 150px;',
				),
				'default'    => 'post',
				'dependency' => array( 'eap_accordion_type', '==', 'post-accordion' ),
			),
			array(
				'id'         => 'eap_display_posts_from',
				'type'       => 'select',
				'title'      => __( 'Filter Posts', 'easy-accordion-pro' ),
				'options'    => array(
					'latest'        => __( 'Latest', 'easy-accordion-pro' ),
					'taxonomy'      => __( 'Taxonomy', 'easy-accordion-pro' ),
					'specific_post' => __( 'Specific Posts', 'easy-accordion-pro' ),
				),
				'default'    => 'latest',
				'class'      => 'chosen',
				'dependency' => array( 'eap_accordion_type', '==', 'post-accordion' ),
			),
			array(
				'id'         => 'eap_post_taxonomy',
				'type'       => 'select',
				'title'      => __( 'Select Taxonomy', 'easy-accordion-pro' ),
				'options'    => 'taxonomies',
				'class'      => 'sp_eap_post_taxonomy',
				'attributes' => array(
					'style' => 'min-width: 200px;',
				),
				'dependency' => array( 'eap_display_posts_from|eap_accordion_type', '==|==', 'taxonomy|post-accordion' ),
			),
			array(
				'id'          => 'eap_taxonomy_terms',
				'type'        => 'select',
				'title'       => __( 'Choose Term(s)', 'easy-accordion-pro' ),
				'help'        => __( 'Choose the taxonomy term(s) to show the posts from.', 'easy-accordion-pro' ),
				'options'     => 'terms',
				'class'       => 'sp_eap_taxonomy_terms',
				'attributes'  => array(
					'style' => 'width: 280px;',
				),
				'multiple'    => 'multiple',
				'placeholder' => __( 'Select Term(s)', 'easy-accordion-pro' ),
				'chosen'      => true,
				'dependency'  => array( 'eap_display_posts_from|eap_accordion_type', '==|==', 'taxonomy|post-accordion' ),
			),
			array(
				'id'         => 'taxonomy_operator',
				'type'       => 'select',
				'class'      => 'eap_taxonomy_operator',
				'title'      => __( 'Operator', 'easy-accordion-pro' ),
				'options'    => array(
					'IN'     => __( 'IN', 'easy-accordion-pro' ),
					'AND'    => __( 'AND', 'easy-accordion-pro' ),
					'NOT IN' => __( 'NOT IN', 'easy-accordion-pro' ),
				),
				'default'    => 'IN',
				'help'       => '<b>IN</b> - Show posts which associate with one or more terms.<br/>
				<b>AND</b> - Show posts which match all terms.<br/>
				<b>NOT IN</b> - Show posts which don\'t match the terms.<br/>',
				'dependency' => array( 'eap_display_posts_from|eap_accordion_type', '==|==', 'taxonomy|post-accordion' ),
			),
			array(
				'id'          => 'eap_specific_posts',
				'type'        => 'select',
				'title'       => __( 'Select Posts', 'easy-accordion-pro' ),
				'class'       => 'sp_eap_specific_posts',
				'options'     => 'posts',
				'chosen'      => true,
				'sortable'    => true,
				'ajax'        => true,
				'multiple'    => true,
				'placeholder' => __( 'Choose Posts', 'easy-accordion-pro' ),
				'dependency'  => array(
					'eap_display_posts_from|eap_accordion_type',
					'==|==',
					'specific_post|post-accordion',
				),
			),
			array(
				'id'         => 'post_order_by',
				'type'       => 'select',
				'title'      => __( 'Order by', 'easy-accordion-pro' ),
				'options'    => array(
					'ID'         => __( 'ID', 'easy-accordion-pro' ),
					'date'       => __( 'Date', 'easy-accordion-pro' ),
					'rand'       => __( 'Random', 'easy-accordion-pro' ),
					'title'      => __( 'Title', 'easy-accordion-pro' ),
					'modified'   => __( 'Modified', 'easy-accordion-pro' ),
					'menu_order' => __( 'Menu Order', 'easy-accordion-pro' ),
					'post__in'   => __( 'Drag & Drop', 'easy-accordion-pro' ),
				),
				'default'    => 'date',
				'class'      => 'chosen',
				'dependency' => array( 'eap_display_posts_from|eap_accordion_type', 'any|==', 'latest,taxonomy,specific_post|post-accordion' ),
			),
			array(
				'id'         => 'post_order',
				'type'       => 'select',
				'title'      => __( 'Order', 'easy-accordion-pro' ),
				'options'    => array(
					'ASC'  => __( 'Ascending', 'easy-accordion-pro' ),
					'DESC' => __( 'Descending', 'easy-accordion-pro' ),
				),
				'default'    => 'DESC',
				'attributes' => array( 'data-depend-id' => 'post_order' ),
				'dependency' => array( 'eap_display_posts_from|eap_accordion_type', 'any|==', 'latest,taxonomy,specific_post|post-accordion' ),
			),
			array(
				'id'         => 'number_of_total_posts',
				'type'       => 'spinner',
				'title'      => __( 'Limit', 'easy-accordion-pro' ),
				'default'    => '20',
				'dependency' => array( 'eap_display_posts_from|eap_accordion_type', '!=|==', 'specific_post|post-accordion' ),
			),
		), // End of fields array.
	)
);

//
// Metabox for the Carousel Post Type.
// Set a unique slug-like ID.
//
$eap_accordion_shortcode_settings = 'sp_eap_shortcode_options';

//
// Create a metabox.
//
SP_EAP::createMetabox(
	$eap_accordion_shortcode_settings,
	array(
		'title'     => __( 'Shortcode Section', 'easy-accordion-pro' ),
		'post_type' => 'sp_easy_accordion',
		'theme'     => 'light',
		'context'   => 'normal',
	)
);

//
// Create a section.
//
SP_EAP::createSection(
	$eap_accordion_shortcode_settings,
	array(
		'title'  => __( 'Accordion Settings', 'easy-accordion-pro' ),
		'icon'   => 'fa fa-list-ul',
		'fields' => array(
			array(
				'id'         => 'eap_accordion_layout',
				'class'      => 'eap_accordion_layout',
				'type'       => 'image_select',
				'title'      => __( 'Accordion Layout', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Choose an accordion layout.', 'easy-accordion-pro' ),
				'options'    => array(
					'vertical'     => array(
						'image'       => SP_EAP_URL . 'admin/img/ea-vertical.svg',
						'option_name' => __( 'Vertical', 'easy-accordion-pro' ),
					),
					'multi-column' => array(
						'image'       => SP_EAP_URL . 'admin/img/ea-multicolumn.svg',
						'option_name' => __( 'Multicolumn', 'easy-accordion-pro' ),
					),
					'horizontal'   => array(
						'image'       => SP_EAP_URL . 'admin/img/ea-horizontal.svg',
						'option_name' => __( 'Horizontal', 'easy-accordion-pro' ),
					),
				),
				'title_info' => __( '<div class="ea-info-label">Accordion Layout</div> <div class="ea-short-content">Accordion Layout determines how accordion information is displayed, with choices like vertical, horizontal, or multi column layouts.</div>', 'easy-accordion-pro' ),
				'radio'      => true,
				'default'    => 'vertical',
			),
			array(
				'id'         => 'eap_accordion_theme',
				'type'       => 'select',
				'title'      => __( 'Accordion Theme', 'easy-accordion-pro' ),
				'class'      => 'sp_eap_accordion_theme',
				'preview'    => true,
				'subtitle'   => __( 'Select a theme style for your accordion FAQs. See <a class="ea-link" href="https://easyaccordion.io/all-accordion-themes/" target="_blank">All the Themes</a> at a glance.', 'easy-accordion-pro' ),
				'options'    => array(
					'sp-ea-one'                       => __( 'Default Theme', 'easy-accordion-pro' ),
					'sp-ea-two'                       => __( 'Theme Two', 'easy-accordion-pro' ),
					'sp-ea-three ea-icon-style-three' => __( 'Theme Three', 'easy-accordion-pro' ),
					'sp-ea-four ea-icon-style-three'  => __( 'Theme Four', 'easy-accordion-pro' ),
					'sp-ea-five ea-icon-style-three'  => __( 'Theme Five', 'easy-accordion-pro' ),
					'sp-ea-six ea-icon-style-three'   => __( 'Theme Six', 'easy-accordion-pro' ),
					'sp-ea-seven'                     => __( 'Theme Seven', 'easy-accordion-pro' ),
					'sp-ea-eight ea-icon-style-three' => __( 'Theme Eight', 'easy-accordion-pro' ),
					'sp-ea-nine ea-icon-style-three'  => __( 'Theme Nine', 'easy-accordion-pro' ),
					'sp-ea-ten'                       => __( 'Theme Ten', 'easy-accordion-pro' ),
					'sp-ea-eleven'                    => __( 'Theme Eleven', 'easy-accordion-pro' ),
					'sp-ea-twelve'                    => __( 'Theme Twelve', 'easy-accordion-pro' ),
					'sp-ea-thirteen'                  => __( 'Theme Thirteen', 'easy-accordion-pro' ),
					'sp-ea-fourteen sp-ea-thirteen'   => __( 'Theme Fourteen', 'easy-accordion-pro' ),
					'sp-ea-fifteen'                   => __( 'Theme Fifteen', 'easy-accordion-pro' ),
					'sp-ea-sixteen'                   => __( 'Theme Sixteen', 'easy-accordion-pro' ),
					'sp-ea-seventeen'                 => __( 'Theme Seventeen', 'easy-accordion-pro' ),
				),
				'default'    => 'sp-ea-one',
				'dependency' => array( 'eap_accordion_layout', 'any', 'vertical,multi-column' ),
			),
			array(
				'id'         => 'eap_accordion_event',
				'type'       => 'button_set',
				'title'      => __( 'Activator Event', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set an event to switch between accordions with Click, Mouse Over, or AutoPlay.', 'easy-accordion-pro' ),
				'title_info' => __( '<div class="ea-info-label">Activator Event</div> <div class="ea-short-content">The <strong>Activator Event</strong> option allows you to define the user interaction that triggers accordion transitions, such as clicking, hovering, or autoplaying.</div><div class="info-button"><a class="ea-open-live-demo" href="https://easyaccordion.io/activator-events/" target="_blank">Live Demo</a></div>', 'easy-accordion-pro' ),
				'options'    => array(
					'ea-click' => __( 'Click', 'easy-accordion-pro' ),
					'ea-hover' => __( 'Mouse Over', 'easy-accordion-pro' ),
					'ea-auto'  => __( 'AutoPlay', 'easy-accordion-pro' ),
				),
				'default'    => 'ea-click',
			),
			// since v2.0.9.
			array(
				'id'         => 'eap_auto_close',
				'type'       => 'switcher',
				'title'      => __( 'Auto-close on MouseOut', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Switch on to auto-close on mouse out.', 'easy-accordion-pro' ),
				'dependency' => array( 'eap_accordion_event|eap_accordion_layout', '==|any', 'ea-hover|vertical,multi-column', true ),
				'default'    => false,
			),
			array(
				'id'         => 'autoplay_time',
				'type'       => 'spinner',
				'title'      => __( 'AutoPlay Delay Time', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set autoplay time in milisecond.', 'easy-accordion-pro' ),
				'title_info' => __( '<div class="ea-info-label">AutoPlay Delay Time</div>Set autoplay delay or interval time. The amount of time to delay between automatically cycling a accordion item. e.g. 1000 milliseconds(ms) = 1 second.', 'easy-accordion-pro' ),
				'unit'       => 'ms',
				'min'        => 1000,
				'max'        => 100000,
				'default'    => 3000,
				'dependency' => array( 'eap_accordion_event', '==', 'ea-auto', true ),
			),
			array(
				'id'         => 'accordion_height',
				'type'       => 'spinner',
				'title'      => __( 'Accordion Height', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set accordion height. It\'s applicable only for horizontal accordion layout.', 'easy-accordion-pro' ),
				'unit'       => 'px',
				'min'        => 100,
				'max'        => 1200,
				'default'    => 500,
				'dependency' => array( 'eap_accordion_layout', '==', 'horizontal', true ),
			),
			array(
				'id'         => 'accordion_header_width',
				'type'       => 'spinner',
				'title'      => __( 'Accordion Header Width', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set accordion header width. It\'s applicable only for horizontal accordion layout.', 'easy-accordion-pro' ),
				'unit'       => 'px',
				'min'        => 1,
				'max'        => 1200,
				'default'    => 60,
				'dependency' => array( 'eap_accordion_layout', '==', 'horizontal', true ),
			),
			array(
				'id'         => 'eap_accordion_mode',
				'type'       => 'radio',
				'title'      => __( 'Accordion Mode', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Expand or collapse accordion option on page load.', 'easy-accordion-pro' ),
				'title_info' => __( '<div class="ea-info-label">Accordion Mode</div> <div class="ea-short-content">The <strong>Accordion Mode</strong> option lets you choose whether the accordion items should be initially expanded or collapsed when the page loads.</div><div class="info-button"><a class="ea-open-live-demo" href="https://easyaccordion.io/accordion-modes/" target="_blank">Live Demo</a></div>', 'easy-accordion-pro' ),
				'options'    => array(
					'ea-first-open' => __( 'First Open', 'easy-accordion-pro' ),
					'ea-multi-open' => __( 'All Open', 'easy-accordion-pro' ),
					'ea-all-close'  => __( 'All Folded', 'easy-accordion-pro' ),
					'custom'        => __( 'Custom Open', 'easy-accordion-pro' ),
				),
				'default'    => 'ea-first-open',
				'dependency' => array( 'eap_accordion_event|eap_accordion_layout', '!=|any', 'ea-auto|vertical,multi-column' ),
			),
			array(
				'id'         => 'keep_accordion',
				'type'       => 'spinner',
				'title'      => __( 'Keep Accordion Open', 'easy-accordion-pro' ),
				'default'    => 1,
				'subtitle'   => __( 'Choose which accordion you want to keep open during the page load.', 'easy-accordion-pro' ),
				'min'        => 1,
				'unit'       => 'th',
				'dependency' => array( 'eap_accordion_mode', '==', 'custom' ),
			),
			array(
				'id'         => 'eap_mutliple_collapse',
				'type'       => 'switcher',
				'title'      => __( 'Multiple Active Together', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Enable/Disable multiple opening or active accordions together.', 'easy-accordion-pro' ),
				'text_on'    => __( 'Enabled', 'easy-accordion-pro' ),
				'text_off'   => __( 'Disabled', 'easy-accordion-pro' ),
				'text_width' => 100,
				'default'    => false,
				'dependency' => array( 'eap_accordion_event|eap_accordion_layout', '!=|any', 'ea-auto|vertical,multi-column' ),
				'title_info' => '<div class="ea-img-tag"><img src="' . esc_url( SP_EAP_URL ) . 'admin/img/ea-multiple-opening-together.svg" alt="Multiple Active Together"></div><div class="ea-info-label img">' . __( 'Multiple Active or Opening Together', 'easy-accordion-pro' ) . '</div>',
			),
			array(
				'id'         => 'eap_accordion_fillspace',
				'type'       => 'checkbox',
				'title'      => __( 'Fixed Content Height', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Check to display collapsible accordion content in a limited amount of space.', 'easy-accordion-pro' ),
				'default'    => false,
				'dependency' => array( 'eap_accordion_layout', 'any', 'vertical,multi-column' ),
				'title_info' => '<div class="ea-img-tag"><img src="' . esc_url( SP_EAP_URL ) . 'admin/img/ea-fixed-content-height.svg" alt="Fixed Content Height"></div><div class="ea-info-label img">' . __( 'Fixed Content Height', 'easy-accordion-pro' ) . '</div>',
			),
			array(
				'id'              => 'eap_accordion_fillspace_height',
				'type'            => 'spacing',
				'title'           => __( 'Maximum Height', 'easy-accordion-pro' ),
				'subtitle'        => __( 'Set fixed accordion content panel height. Defualt height 200px.', 'easy-accordion-pro' ),
				'all'             => true,
				'all_icon'        => '<i class="fa fa-arrows-v"></i>',
				'all_placeholder' => __( 'Height', 'easy-accordion-pro' ),
				'units'           => array(
					'px',
				),
				'default'         => array(
					'all' => '200',
				),
				'attributes'      => array(
					'min' => 50,
				),
				'dependency'      => array( 'eap_accordion_layout|eap_accordion_fillspace', 'any|==', 'vertical,multi-column|true' ),
			),
			array(
				'id'         => 'eap_title_url',
				'type'       => 'switcher',
				'title'      => __( 'Accordion Item to URL', 'easy-accordion-pro' ),
				'title_info' => __( '<div class="ea-info-label">Accordion Item to URL</div> <div class="ea-short-content">This option transforms the accordion item title into a URL-friendly format, allowing direct linking to specific accordion sections on a webpage.</div><div class="info-button"><a class="ea-open-docs" href="https://docs.shapedplugin.com/docs/easy-accordion-pro/configurations/how-to-enable-accordion-item-to-url/" target="_blank">Open Docs</a></div>', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Enable/Disable to make accordion item title as a slug to URL', 'easy-accordion-pro' ),
				'text_on'    => __( 'Enabled', 'easy-accordion-pro' ),
				'text_off'   => __( 'Disabled', 'easy-accordion-pro' ),
				'text_width' => 100,
				'default'    => false,
			),
			array(
				'id'         => 'eap_scroll_to_active_item',
				'type'       => 'switcher',
				'title'      => __( 'Scroll to Active Item', 'easy-accordion-pro' ),
				'title_info' => __( '<div class="ea-info-label">Scroll to Active Item</div> <div class="ea-short-content">This option allows automatic scrolling to the active accordion item. This provides a smoother and more user-friendly experience when navigating through accordion faqs section.</div><div class="info-button"><a class="ea-open-docs" href="https://docs.shapedplugin.com/docs/easy-accordion-pro/configurations/how-to-enable-accordion-scrolling-to-active-item/" target="_blank">Open Docs</a></div>', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Enable/Disable this option to scroll to  active accordion item.', 'easy-accordion-pro' ),
				'text_on'    => __( 'Enabled', 'easy-accordion-pro' ),
				'text_off'   => __( 'Disabled', 'easy-accordion-pro' ),
				'text_width' => 100,
				'default'    => false,
				'dependency' => array( 'eap_accordion_layout', 'any', 'vertical,multi-column' ),
			),
			array(
				'id'         => 'eap_schema_markup',
				'type'       => 'switcher',
				'title'      => __( 'Schema Markup', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Enable/Disable schema markup.', 'easy-accordion-pro' ),
				'title_info' => __( '<div class="ea-info-label">Schema Markup</div> <div class="ea-short-content"><strong>Schema Markup</strong> adds structured data to your Accordion FAQs, enhancing search engine visibility and improving the display of your Accordion FAQs in search results.</div><div class="info-button"><a class="ea-open-docs" href="https://docs.shapedplugin.com/docs/easy-accordion-pro/configurations/how-to-enable-schema-markup/" target="_blank">Open Docs</a></div>', 'easy-accordion-pro' ),
				'text_on'    => __( 'Enabled', 'easy-accordion-pro' ),
				'text_off'   => __( 'Disabled', 'easy-accordion-pro' ),
				'text_width' => 100,
				'default'    => false,
			),
			array(
				'id'         => 'eap_preloader',
				'type'       => 'switcher',
				'title'      => __( 'Preloader', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Accordion will be hidden until page load completed.', 'easy-accordion-pro' ),
				'default'    => false,
				'text_on'    => __( 'Enabled', 'easy-accordion-pro' ),
				'text_off'   => __( 'Disabled', 'easy-accordion-pro' ),
				'text_width' => 100,
			),
		), // Fields array end.
	)
); // End of Upload section.
//
// Carousel settings section begin.
//
SP_EAP::createSection(
	$eap_accordion_shortcode_settings,
	array(
		'title'  => __( 'Display Settings', 'easy-accordion-pro' ),
		'icon'   => 'fa fa-th-large',
		'fields' => array(
			array(
				'id'         => 'section_title',
				'type'       => 'switcher',
				'title'      => __( 'Accordion Section Title', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Show/hide the accordion section title.', 'easy-accordion-pro' ),
				'text_on'    => __( 'Show', 'easy-accordion-pro' ),
				'text_off'   => __( 'Hide', 'easy-accordion-pro' ),
				'text_width' => 80,
				'default'    => false,
			),
			array(
				'id'              => 'accordion_margin_bottom',
				'type'            => 'spacing',
				'title'           => __( 'Space Between', 'easy-accordion-pro' ),
				'subtitle'        => __( 'Set a margin to make space between accordion items. Default value is 10px.', 'easy-accordion-pro' ),
				'all'             => true,
				'all_icon'        => '<i class="fa fa-arrows-v"></i>',
				'all_placeholder' => 'margin',
				'default'         => array(
					'all' => '10',
				),
				'units'           => array(
					'px',
				),
				'attributes'      => array(
					'min' => 0,
				),
				'title_info'      => '<div class="ea-img-tag"><img src="' . esc_url( SP_EAP_URL ) . 'admin/img/ea-accordion-margin.svg" alt="Accordion Margin"></div><div class="ea-info-label img">' . __( 'Space Between Accordion FAQs', 'easy-accordion-pro' ) . '</div>',
			),
			array(
				'id'         => 'eap_faq_collapse_button',
				'type'       => 'switcher',
				'title'      => __( 'Expand/Collapse All Button', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Show/hide expand/collapse all button.', 'easy-accordion-pro' ),
				'text_on'    => __( 'Show', 'easy-accordion-pro' ),
				'text_off'   => __( 'Hide', 'easy-accordion-pro' ),
				'text_width' => 80,
				'default'    => false,
				'dependency' => array( 'eap_accordion_layout', 'any', 'vertical,multi-column' ),
				'title_info' => '<div class="ea-img-tag"><img src="' . esc_url( SP_EAP_URL ) . 'admin/img/ea-expand-collapse-all-button.svg" alt="Expand/Collapse All Button"></div><div class="ea-info-label img">' . __( 'Expand/Collapse All Button', 'easy-accordion-pro' ) . '</div><div class="info-button img"><a class="ea-open-live-demo" href="https://easyaccordion.io/expand-collapse-all/" target="_blank">Live Demo</a></div>',
			),
			array(
				'id'         => 'eap_faq_collapse_fields',
				'class'      => 'eap_faq_collapse_button_fields',
				'type'       => 'fieldset',
				'title'      => ' ',
				'dependency' => array( 'eap_accordion_layout|eap_faq_collapse_button', 'any|==', 'vertical,multi-column|true', true ),
				'fields'     => array(
					array(
						'id'          => 'eap_faq_expand_label',
						'type'        => 'text',
						'placeholder' => __( 'Expand All', 'easy-accordion-pro' ),
						'title'       => __( '"Expand All" Label', 'easy-accordion-pro' ),
					),
					array(
						'id'          => 'eap_faq_collapse_label',
						'type'        => 'text',
						'placeholder' => __( 'Collapse All', 'easy-accordion-pro' ),
						'title'       => __( '"Collapse All" Label', 'easy-accordion-pro' ),
					),
					array(
						'id'      => 'eap_faq_collapse_button_color',
						'type'    => 'color_group',
						'title'   => __( 'Color', 'easy-accordion-pro' ),
						'options' => array(
							'color1' => __( 'Label', 'easy-accordion-pro' ),
							'color2' => __( 'Background', 'easy-accordion-pro' ),
						),
						'default' => array(
							'color1' => '#fff',
							'color2' => '#fd7d4e',
						),
					),
					array(
						'id'      => 'eap_faq_collapse_button_alignment',
						'type'    => 'button_set',
						'title'   => __( 'Alignment', 'easy-accordion-pro' ),
						'options' => array(
							'left'   => '<i class="fa fa-align-left" title="Left"></i>',
							'center' => '<i class="fa fa-align-center" title="Center"></i>',
							'right'  => '<i class="fa fa-align-right" title="Right"></i>',
						),
						'default' => 'right',
					),
				),
			),
			array(
				'id'         => 'eap_faq_search',
				'type'       => 'switcher',
				'title'      => __( 'Accordion FAQ Search', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Show/hide accordion FAQ search field.', 'easy-accordion-pro' ),
				'text_on'    => __( 'Show', 'easy-accordion-pro' ),
				'text_off'   => __( 'Hide', 'easy-accordion-pro' ),
				'text_width' => 80,
				'default'    => false,
				'title_info' => '<div class="ea-img-tag"><img src="' . esc_url( SP_EAP_URL ) . 'admin/img/ea-accordion-faq-search.svg" alt="Accordion FAQ Search"></div><div class="ea-info-label img">' . __( 'Accordion FAQ Search', 'easy-accordion-pro' ) . '</div><div class="info-button img"><a class="ea-open-live-demo " href="https://easyaccordion.io/faqs-search-option/" target="_blank">Live Demo</a></div>',
			),
			array(
				'id'         => 'eap_faq_search_autocomplete',
				'type'       => 'switcher',
				'title'      => __( 'Accordion FAQ Auto Suggest', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Enable/Disable FAQ auto suggest or complete in search field.', 'easy-accordion-pro' ),
				'text_on'    => __( 'Enabled', 'easy-accordion-pro' ),
				'text_off'   => __( 'Disabled', 'easy-accordion-pro' ),
				'text_width' => 100,
				'default'    => false,
				'dependency' => array( 'eap_faq_search', '==', true ),

			),
			array(
				'id'         => 'faq_search_placeholder',
				'type'       => 'text',
				'class'      => 'eap-accordion-content-title',
				'title'      => __( 'Search Placeholder', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Change search placeholder text.', 'easy-accordion-pro' ),
				'default'    => 'Search your FAQ',
				'dependency' => array( 'eap_faq_search', '==', true ),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Accordion Expand & Collapse Icon', 'easy-accordion-pro' ),
			),
			array(
				'id'         => 'eap_expand_close_icon',
				'type'       => 'switcher',
				'title'      => __( 'Expand & Collapse Icon', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Show/hide expand and collapse icon.', 'easy-accordion-pro' ),
				'default'    => true,
				'text_on'    => __( 'Show', 'easy-accordion-pro' ),
				'text_off'   => __( 'Hide', 'easy-accordion-pro' ),
				'text_width' => 80,
			),
			array(
				'id'         => 'eap_expand_collapse_icon',
				'class'      => 'eap_expand_collapse_icon',
				'type'       => 'image_select',
				'title'      => __( 'Expand & Collapse Icon Style', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Choose a expand and collapse icon style.', 'easy-accordion-pro' ),
				'options'    => array(
					'1'  => SP_EAP_URL . 'admin/img/collapse-expand-icon/plus-minus.svg',
					'19' => SP_EAP_URL . 'admin/img/collapse-expand-icon/plus-times.svg',
					'5'  => SP_EAP_URL . 'admin/img/collapse-expand-icon/check-times.svg',
					'6'  => SP_EAP_URL . 'admin/img/collapse-expand-icon/chevron-down-right.svg',
					'13' => SP_EAP_URL . 'admin/img/collapse-expand-icon/angle-down-up.svg',
					'9'  => SP_EAP_URL . 'admin/img/collapse-expand-icon/angle-up-down.svg',
					'2'  => SP_EAP_URL . 'admin/img/collapse-expand-icon/angle-down-right-7.svg',
					'18' => SP_EAP_URL . 'admin/img/collapse-expand-icon/angle-down-up-18.svg',
					'9'  => SP_EAP_URL . 'admin/img/collapse-expand-icon/angle-up-down-9.svg',
					'3'  => SP_EAP_URL . 'admin/img/collapse-expand-icon/angle-double-down-right.svg',
					'15' => SP_EAP_URL . 'admin/img/collapse-expand-icon/angle-double-down-up.svg',
					'10' => SP_EAP_URL . 'admin/img/collapse-expand-icon/angle-double-up-down.svg',
					'8'  => SP_EAP_URL . 'admin/img/collapse-expand-icon/caret-down-right.svg',
					'17' => SP_EAP_URL . 'admin/img/collapse-expand-icon/caret-up-down-14.svg',
					'14' => SP_EAP_URL . 'admin/img/collapse-expand-icon/caret-down-up.svg',
					'4'  => SP_EAP_URL . 'admin/img/collapse-expand-icon/arrow-down-right.svg',
					'16' => SP_EAP_URL . 'admin/img/collapse-expand-icon/arrow-down-up.svg',
					'11' => SP_EAP_URL . 'admin/img/collapse-expand-icon/arrow-up-down-18.svg',
					'7'  => SP_EAP_URL . 'admin/img/collapse-expand-icon/hand-o-down-right.svg',
					'20' => SP_EAP_URL . 'admin/img/collapse-expand-icon/q-a-img.svg',
				),
				'radio'      => true,
				'default'    => '1',
				'dependency' => array(
					'eap_expand_close_icon',
					'==',
					'true',
				),
			),

			array(
				'id'              => 'eap_icon_size',
				'type'            => 'spacing',
				'title'           => __( 'Expand & Collapse Icon Size', 'easy-accordion-pro' ),
				'subtitle'        => __( 'Set accordion collapse and expand icon size. Default value is 16px.', 'easy-accordion-pro' ),
				'all'             => true,
				'all_icon'        => false,
				'all_placeholder' => '',
				'default'         => array(
					'all' => '16',
				),
				'units'           => array(
					'px',
				),
				'dependency'      => array(
					'eap_expand_close_icon',
					'==',
					'true',
				),
			),
			array(
				'id'              => 'eap_icon_margin',
				'type'            => 'spacing',
				'title'           => __( 'Margin Between Icon and Title', 'easy-accordion-pro' ),
				'subtitle'        => __( 'Set a margin between collapsible icon and title.', 'easy-accordion-pro' ),
				'title_info'      => '<div class="ea-img-tag"><img src="' . esc_url( SP_EAP_URL ) . 'admin/img/ea-margin-between-icon-and-title.svg" alt="Margin Between Collapsible Icon and Title"></div><div class="ea-info-label img">' . __( 'Margin Between Icon and Title', 'easy-accordion-pro' ) . '</div>',
				'all'             => true,
				'all_icon'        => '<i class="fa fa-arrows-h"></i>',
				'all_placeholder' => '',
				'default'         => array(
					'all' => 10,
				),
				'units'           => array(
					'px',
				),
				'attributes'      => array(
					'min' => 0,
				),
				'dependency'      => array(
					'eap_expand_close_icon|eap_accordion_theme|eap_accordion_theme',
					'==|!=|!=',
					'true|sp-ea-fourteen sp-ea-thirteen|sp-ea-fifteen',
					true,
				),
			),
			array(
				'id'         => 'eap_icon_color_set',
				'type'       => 'color_group',
				'title'      => __( 'Icon Color', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set icon color.', 'easy-accordion-pro' ),
				'options'    => array(
					'color1' => __( 'Color', 'easy-accordion-pro' ),
					'color2' => __( 'Active Color', 'easy-accordion-pro' ),
					'color3' => __( 'Hover Color', 'easy-accordion-pro' ),
				),
				'default'    => array(
					'color1' => '#444',
					'color2' => '#444',
					'color3' => '#444',
				),
				'dependency' => array(
					'eap_expand_close_icon',
					'==',
					'true',
				),
			),
			array(
				'id'         => 'eap_icon_bg_color',
				'type'       => 'color_group',
				'title'      => __( 'Icon Background Color', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set icon background color.', 'easy-accordion-pro' ),
				'options'    => array(
					'color1' => __( 'Background', 'easy-accordion-pro' ),
					'color2' => __( 'Active Background', 'easy-accordion-pro' ),
					'color3' => __( 'Hover Background', 'easy-accordion-pro' ),
				),
				'default'    => array(
					'color1' => '#546a77',
					'color2' => '#546a77',
					'color3' => '#546a77',
				),
				'dependency' => array( 'eap_accordion_theme|eap_expand_close_icon|eap_accordion_layout', 'any|==|!=', 'sp-ea-two,sp-ea-three ea-icon-style-three,sp-ea-four ea-icon-style-three,sp-ea-five ea-icon-style-three,sp-ea-six ea-icon-style-three,sp-ea-eight ea-icon-style-three,sp-ea-nine ea-icon-style-three,sp-ea-thirteen,sp-ea-fourteen sp-ea-thirteen,sp-ea-fifteen,sp-ea-sixteen|true|horizontal', true ),
			),
			array(
				'id'                => 'icon_height_width',
				'type'              => 'spacing',
				'title'             => __( 'Icon Background Size', 'easy-accordion-pro' ),
				'subtitle'          => __( 'Set icon background size.', 'easy-accordion-pro' ),
				'unit'              => true,
				'units'             => array(
					'px',
				),
				'top_icon'          => __( 'Height', 'easy-accordion-pro' ),
				'right_icon'        => __( 'Width', 'easy-accordion-pro' ),
				'top_placeholder'   => __( 'Height', 'easy-accordion-pro' ),
				'right_placeholder' => __( 'Width', 'easy-accordion-pro' ),
				'bottom'            => false,
				'left'              => false,
				'default'           => array(
					'top'   => '40',
					'right' => '40',
				),
				'dependency'        => array( 'eap_accordion_theme|eap_accordion_layout', 'any|!=', 'sp-ea-two,sp-ea-sixteen|horizontal', true ),
			),

			array(
				'id'              => 'eap_icon_border_radius',
				'type'            => 'spacing',
				'title'           => __( 'Icon Border Radius', 'easy-accordion-pro' ),
				'subtitle'        => __( 'Set accordion icon border badius. Defualt value is 3px.', 'easy-accordion-pro' ),
				'all'             => true,
				'all_placeholder' => '',
				'all_title'       => __( 'Radius', 'easy-accordion-pro' ),
				'default'         => array(
					'all'   => 3,
					'units' => '%',
				),
				'units'           => array(
					'px',
					'%',
				),
				'attributes'      => array(
					'min' => 0,
				),
				'dependency'      => array( 'eap_accordion_theme|eap_expand_close_icon|eap_accordion_layout', 'any|==|!=', 'sp-ea-two,sp-ea-thirteen,sp-ea-fourteen sp-ea-thirteen,sp-ea-fifteen|true|horizontal', true ),
			),
			array(
				'id'         => 'eap_icon_position',
				'type'       => 'button_set',
				'title'      => __( 'Expand & Collapse Icon Position', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set accordion expand and collapse icon position or alingment.', 'easy-accordion-pro' ),
				'options'    => array(
					'left'  => __( 'Left', 'easy-accordion-pro' ),
					'right' => __( 'Right', 'easy-accordion-pro' ),
				),
				'radio'      => true,
				'default'    => 'left',
				'title_info' => '<div class="ea-img-tag"><img src="' . esc_url( SP_EAP_URL ) . 'admin/img/ea-expand-&-collapse-icon-position.svg" alt="Expand & Collapse Icon Position"></div><div class="ea-info-label img">' . __( 'Expand & Collapse Icon Position', 'easy-accordion-pro' ) . '</div>',
				'dependency' => array( 'eap_expand_close_icon|eap_accordion_layout', '==|!=', 'true|horizontal', true ),
			),
			array(
				'id'         => 'eap_icon_position_horizontal',
				'type'       => 'button_set',
				'title'      => __( 'Expand and Collapse Icon Position', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set accordion expand and collapse icon position or alingment.', 'easy-accordion-pro' ),
				'options'    => array(
					'left'  => __( 'Bottom', 'easy-accordion-pro' ),
					'right' => __( 'Top', 'easy-accordion-pro' ),
				),
				'radio'      => true,
				'default'    => 'left',
				'dependency' => array( 'eap_expand_close_icon|eap_accordion_layout', '==|==', 'true|horizontal', true ),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Accordion Item Title & Description', 'easy-accordion-pro' ),
			),
			array(
				'id'         => 'eap_border_css',
				'type'       => 'border',
				'title'      => __( 'Accordion Border', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set accordion item border. Defualt value is 1px.', 'easy-accordion-pro' ),
				'all'        => true,
				'default'    => array(
					'all'   => '1',
					'style' => 'solid',
					'color' => '#e2e2e2',
				),
				'title_info' => '<div class="ea-img-tag"><img src="' . esc_url( SP_EAP_URL ) . 'admin/img/ea-accordion-border.svg" alt="Accordion Border"></div><div class="ea-info-label img">' . __( 'Accordion Border', 'easy-accordion-pro' ) . '</div>',
				'dependency' => array( 'eap_accordion_theme', '!=', 'sp-ea-eleven' ),
			),
			array(
				'id'              => 'accordion_border_radius',
				'type'            => 'spacing',
				'title'           => __( 'Border Radius ', 'easy-accordion-pro' ),
				'subtitle'        => __( 'Set accordion item border radius. Defualt value is 3px.', 'easy-accordion-pro' ),
				'all'             => true,
				'all_placeholder' => '',
				'all_title'       => __( 'Radius', 'easy-accordion-pro' ),
				'default'         => array(
					'all'   => 3,
					'units' => 'px',
				),
				'units'           => array(
					'px',
					'%',
				),
				'attributes'      => array(
					'min' => 0,
					'max' => 200,
				),
				'dependency'      => array( 'eap_accordion_theme|eap_accordion_theme|eap_accordion_theme|eap_accordion_theme', '!=|!=|!=|!=', 'sp-ea-twelve|sp-ea-fifteen|sp-ea-sixteen|sp-ea-seven', true ),
			),
			array(
				'id'              => 'accordion_header_border_radius',
				'type'            => 'spacing',
				'title'           => __( 'Accordion Header Radius ', 'easy-accordion-pro' ),
				'subtitle'        => __( 'Set accordion header radius.', 'easy-accordion-pro' ),
				'dependency'      => array( 'eap_accordion_theme', '==', 'sp-ea-eleven' ),
				'all'             => true,
				'all_placeholder' => '',
				'default'         => array(
					'all'   => 32,
					'units' => 'px',
				),
				'units'           => array(
					'px',
					'%',
				),
				'attributes'      => array(
					'min' => 0,
					'max' => 200,
				),
			),
			array(
				'id'         => 'eap_expand_border_css',
				'type'       => 'border',
				'title'      => __( 'Accordion Exapand Border', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Used as the Accordion Exapand border.', 'easy-accordion-pro' ),
				'all'        => true,
				'default'    => array(
					'all'   => 7,
					'style' => 'solid',
					'color' => '#ff5c5c',
				),
				'attributes' => array(
					'data-depend-id' => 'eap_expand_border_css',
				),
				'dependency' => array(
					'eap_accordion_theme',
					'==',
					'sp-ea-ten',
				),
			),
			array(
				'id'         => 'eap_title_icon',
				'type'       => 'switcher',
				'title'      => __( 'Title Icon', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Show/hide title icon. e.g. FontAwesome icon before the accordion title.', 'easy-accordion-pro' ),
				'default'    => true,
				'text_on'    => __( 'Show', 'easy-accordion-pro' ),
				'text_off'   => __( 'Hide', 'easy-accordion-pro' ),
				'text_width' => 80,
			),
			array(
				'id'              => 'eap_title_icon_size',
				'type'            => 'spacing',
				'title'           => __( 'Title Icon Size ', 'easy-accordion-pro' ),
				'subtitle'        => __( 'Set title icon size.', 'easy-accordion-pro' ),
				'dependency'      => array( 'eap_title_icon', '==', 'true' ),
				'all'             => true,
				'all_icon'        => false,
				'all_placeholder' => '',
				'default'         => array(
					'all'   => 20,
					'units' => 'px',
				),
				'units'           => array(
					'px',
				),
			),
			array(
				'id'         => 'eap_title_icon_color',
				'type'       => 'color_group',
				'title'      => __( 'Title Icon Color', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set accordion title icon color.', 'easy-accordion-pro' ),
				'options'    => array(
					'color1' => __( 'Color', 'easy-accordion-pro' ),
					'color2' => __( 'Active Color', 'easy-accordion-pro' ),
					'color3' => __( 'Hover Color', 'easy-accordion-pro' ),
				),
				'default'    => array(
					'color1' => '#444',
					'color2' => '#444',
					'color3' => '#444',
				),
				'dependency' => array(
					'eap_title_icon',
					'==',
					'true',
				),
			),
			array(
				'id'       => 'eap_header_bg_color_type',
				'type'     => 'button_set',
				'title'    => __( 'Title Background Color Type ', 'easy-accordion-pro' ),
				'subtitle' => __( 'Choose a color type for the title background.', 'easy-accordion-pro' ),
				'options'  => array(
					'solid'    => __( 'Solid', 'easy-accordion-pro' ),
					'gradient' => __( 'Gradient', 'easy-accordion-pro' ),
				),
				'default'  => array( 'solid' ),
			),
			array(
				'id'         => 'eap_header_bg_color',
				'type'       => 'color_group',
				'title'      => __( 'Title Background Color', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set accordion title background color.', 'easy-accordion-pro' ),
				'options'    => array(
					'color1' => __( 'Background', 'easy-accordion-pro' ),
					'color2' => __( 'Active Background', 'easy-accordion-pro' ),
					'color3' => __( 'Hover Background', 'easy-accordion-pro' ),
				),
				'default'    => array(
					'color1' => '#eee',
					'color2' => '#eee',
					'color3' => '#eee',
				),
				'dependency' => array( 'eap_header_bg_color_type', '==', 'solid' ),
			),
			array(
				'id'                    => 'eap_header_bg_gradient_color',
				'type'                  => 'background',
				'title'                 => __( 'Gradient Color', 'easy-accordion-pro' ),
				'subtitle'              => __( 'Set gradient color for the accordion title background.', 'easy-accordion-pro' ),
				'background_gradient'   => true,
				'background_color'      => true,
				'background_image'      => false,
				'background_position'   => false,
				'background_repeat'     => false,
				'background_attachment' => false,
				'background_size'       => false,
				'default'               => array(
					'background-color'              => 'rgb(255 95 109)',
					'background-gradient-color'     => 'rgb(255, 195, 113)',
					'background-gradient-direction' => '135deg',
				),
				'dependency'            => array( 'eap_header_bg_color_type', '==', 'gradient' ),
			),
			array(
				'id'         => 'eap_expand_bg_color',
				'type'       => 'color',
				'title'      => __( 'Accordion Expand Background Color', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set accordion expand background color.', 'easy-accordion-pro' ),
				'default'    => '#ffeded',
				'dependency' => array(
					'eap_accordion_theme',
					'==',
					'sp-ea-ten',
				),
			),
			array(
				'id'       => 'ea_title_heading_tag',
				'type'     => 'select',
				'title'    => __( 'Title HTML Tag', 'easy-accordion-pro' ),
				'subtitle' => __( 'Select Tag for accordion title.', 'easy-accordion-pro' ),
				'options'  => array(
					'1' => __( 'H1', 'easy-accordion-pro' ),
					'2' => __( 'H2', 'easy-accordion-pro' ),
					'3' => __( 'H3', 'easy-accordion-pro' ),
					'4' => __( 'H4', 'easy-accordion-pro' ),
					'5' => __( 'H5', 'easy-accordion-pro' ),
					'6' => __( 'H6', 'easy-accordion-pro' ),
				),
				'default'  => '3',
				'radio'    => true,
			),
			array(
				'id'         => 'eap_title_padding',
				'type'       => 'spacing',
				'title'      => __( 'Title Padding', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set accordion title custom padding.', 'easy-accordion-pro' ),
				'units'      => array( 'px' ),
				'default'    => array(
					'left'   => '15',
					'top'    => '15',
					'bottom' => '15',
					'right'  => '15',
				),
				'title_info' => '<div class="ea-img-tag"><img src="' . esc_url( SP_EAP_URL ) . 'admin/img/ea-title-padding.svg" alt="Title Padding"></div><div class="ea-info-label img">' . __( 'Title Padding', 'easy-accordion-pro' ) . '</div>',
				'dependency' => array( 'eap_accordion_layout', 'any', 'vertical,multi-column' ),
			),
			array(
				'id'       => 'ea_strip_tag',
				'type'     => 'checkbox',
				'title'    => __( 'Strip all HTML tags from Description Content', 'easy-accordion-pro' ),
				'subtitle' => __( 'Check to strip all HTML tags from description content including script and style.', 'easy-accordion-pro' ),
				'default'  => false,
			),
			array(
				'id'         => 'eap_autop',
				'type'       => 'switcher',
				'title'      => __( 'Line Break', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Wpautop/line break with paragraph in description.', 'easy-accordion-pro' ),
				'text_on'    => __( 'Enabled', 'easy-accordion-pro' ),
				'text_off'   => __( 'Disabled', 'easy-accordion-pro' ),
				'text_width' => 100,
				'default'    => true,
			),
			array(
				'id'       => 'eap_description_bg_color',
				'type'     => 'color',
				'title'    => __( 'Description Background Color', 'easy-accordion-pro' ),
				'subtitle' => __( 'Set accordion description background color.', 'easy-accordion-pro' ),
				'default'  => '#fff',
				'rgba'     => true,
			),
			array(
				'id'         => 'eap_description_padding',
				'type'       => 'spacing',
				'title'      => __( 'Description Padding', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set accordion description custom padding.', 'easy-accordion-pro' ),
				'units'      => array( 'px' ),
				'default'    => array(
					'left'   => '15',
					'top'    => '15',
					'bottom' => '15',
					'right'  => '15',
				),
				'title_info' => '<div class="ea-img-tag"><img src="' . esc_url( SP_EAP_URL ) . 'admin/img/ea-description-padding.svg" alt="Description Padding"></div><div class="ea-info-label img">' . __( 'Description Padding', 'easy-accordion-pro' ) . '</div>',
			),
			array(
				'id'         => 'eap_read_more',
				'type'       => 'switcher',
				'title'      => __( 'Read More', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Show/Hide read more button.', 'easy-accordion-pro' ),
				'default'    => false,
				'text_on'    => __( 'Show', 'easy-accordion-pro' ),
				'text_off'   => __( 'Hide', 'easy-accordion-pro' ),
				'text_width' => 80,
				'dependency' => array( 'eap_accordion_type', '==', 'post-accordion' ),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Accordion Animation', 'easy-accordion-pro' ),
			),
			array(
				'id'         => 'eap_animation',
				'type'       => 'switcher',
				'title'      => __( 'Animation', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Enable/Disable accordion animation.', 'easy-accordion-pro' ),
				'title_info' => __(
					'<div class="ea-info-label">Animation</div> <div class="ea-short-content">The Animation option allows you to control the accordion animation. Customize the visual experience of accordion transitions according to your preference.</div><div class="info-button"><a class="ea-open-live-demo" href="https://easyaccordion.io/accordion-animation/" target="_blank">Live Demo</a></div>',
					'easy-accordion-pro'
				),
				'default'    => true,
				'text_on'    => __( 'Enabled', 'easy-accordion-pro' ),
				'text_off'   => __( 'Disabled', 'easy-accordion-pro' ),
				'text_width' => 100,
			),
			array(
				'id'         => 'eap_animation_style',
				'type'       => 'select',
				'title'      => __( 'Animation Style', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Select an animation style for the description content.', 'easy-accordion-pro' ),
				'options'    => array(
					'fadeIn'        => __( 'fadeIn', 'easy-accordion-pro' ),
					'fadeInLeft'    => __( 'fadeInLeft', 'easy-accordion-pro' ),
					'fadeInUp'      => __( 'fadeInUp', 'easy-accordion-pro' ),
					'fadeInDownBig' => __( 'fadeInDownBig', 'easy-accordion-pro' ),
					'shake'         => __( 'shake', 'easy-accordion-pro' ),
					'swing'         => __( 'swing', 'easy-accordion-pro' ),
					'rollIn'        => __( 'rollIn', 'easy-accordion-pro' ),
					'bounce'        => __( 'bounce', 'easy-accordion-pro' ),
					'wobble'        => __( 'wobble', 'easy-accordion-pro' ),
					'shake'         => __( 'shake', 'easy-accordion-pro' ),
					'slideInDown'   => __( 'slideInDown', 'easy-accordion-pro' ),
					'slideInLeft'   => __( 'slideInLeft', 'easy-accordion-pro' ),
					'slideInUp'     => __( 'slideInUp', 'easy-accordion-pro' ),
					'zoomIn'        => __( 'zoomIn', 'easy-accordion-pro' ),
					'zoomInDown'    => __( 'zoomInDown', 'easy-accordion-pro' ),
					'zoomInUp'      => __( 'zoomInUp', 'easy-accordion-pro' ),
					'zoomInLeft'    => __( 'zoomInLeft', 'easy-accordion-pro' ),
					'bounceIn'      => __( 'bounceIn', 'easy-accordion-pro' ),
					'bounceInDown'  => __( 'bounceInDown', 'easy-accordion-pro' ),
					'bounceInUp'    => __( 'bounceInUp', 'easy-accordion-pro' ),
					'jello'         => __( 'jello', 'easy-accordion-pro' ),
					'swing'         => __( 'swing', 'easy-accordion-pro' ),
					'rubberBand'    => __( 'rubberBand', 'easy-accordion-pro' ),
					'shake'         => __( 'shake', 'easy-accordion-pro' ),
					'swing'         => __( 'swing', 'easy-accordion-pro' ),
					'rollIn'        => __( 'rollIn', 'easy-accordion-pro' ),
				),
				'default'    => 'fadeIn',
				'dependency' => array(
					'eap_animation',
					'==',
					'true',
				),
			),
			array(
				'id'         => 'eap_animation_time',
				'class'      => 'eap_animation_time',
				'type'       => 'spinner',
				'title'      => __( 'Transition Time', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set accordion expand and collapse transition time. Defualt value is 500 milliseconds.', 'easy-accordion-pro' ),
				'unit'       => 'ms',
				'min'        => 0,
				'max'        => 99999,
				'default'    => 500,
				'dependency' => array(
					'eap_animation',
					'==',
					'true',
				),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Ajax Pagination', 'easy-accordion-pro' ),
			),
			array(
				'id'         => 'show_pagination',
				'type'       => 'switcher',
				'title'      => __( 'Ajax Pagination', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Enable/Disable accordion item pagination.', 'easy-accordion-pro' ),
				'text_on'    => __( 'Enabled', 'easy-accordion-pro' ),
				'text_off'   => __( 'Disabled', 'easy-accordion-pro' ),
				'text_width' => 100,
				'default'    => false,
				'title_info' => '<div class="ea-img-tag"><img src="' . esc_url( SP_EAP_URL ) . 'admin/img/ea-ajax-pagination.svg" alt="Ajax Pagination"></div><div class="ea-info-label img">' . __( 'Ajax Pagination', 'easy-accordion-pro' ) . '</div><div class="info-button img"><a class="ea-open-live-demo" href="https://easyaccordion.io/ajax-paginations/" target="_blank">Live Demo</a></div>',
			),
			array(
				'id'         => 'pagination_type',
				'type'       => 'radio',
				'title'      => __( 'Ajax Pagination Type', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Choose an accordion item pagination type.', 'easy-accordion-pro' ),
				'options'    => array(
					'ajax_load_more'     => __( 'Ajax Load More', 'easy-accordion-pro' ),
					'ajax_infinite_scrl' => __( 'Ajax Infinite Scroll', 'easy-accordion-pro' ),
					'ajax_number'        => __( 'Ajax Number', 'easy-accordion-pro' ),
				),
				'default'    => 'ajax_load_more',
				'dependency' => array( 'show_pagination', '==', 'true' ),
			),
			array(
				'id'         => 'load_more_label',
				'type'       => 'text',
				'title'      => __( 'Load More Label', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Change load more label text.', 'easy-accordion-pro' ),
				'default'    => __( 'Load More', 'easy-accordion-pro' ),
				'dependency' => array( 'show_pagination|pagination_type', '==|==', 'true|ajax_load_more' ),
			),
			array(
				'id'         => 'pagination_show_per_page',
				'type'       => 'spinner',
				'title'      => __( 'Accordion Items Per Page', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set number of accordion items to show per page/click.', 'easy-accordion-pro' ),
				'default'    => 8,
				'dependency' => array( 'show_pagination|pagination_type', '==|any', 'true|ajax_number,ajax_load_more,ajax_infinite_scrl' ),
			),
			array(
				'id'         => 'pagination_alignment',
				'type'       => 'button_set',
				'class'      => 'pagination_alignment',
				'title'      => __( 'Alignment', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set an alignment for the pagination.', 'easy-accordion-pro' ),
				'options'    => array(
					'left'   => '<i class="fa fa-align-left" title="Left"></i>',
					'center' => '<i class="fa fa-align-center" title="Center"></i>',
					'right'  => '<i class="fa fa-align-right" title="Right"></i>',
				),
				'default'    => 'center',
				'dependency' => array( 'show_pagination|pagination_type', '==|!=', 'true|ajax_infinite_scrl' ),
			),
			array(
				'id'         => 'pagination_color',
				'class'      => 'pagination_color',
				'type'       => 'color_group',
				'title'      => __( 'Color', 'easy-accordion-pro' ),
				'subtitle'   => __( 'Set pagination color.', 'easy-accordion-pro' ),
				'dependency' => array( 'show_pagination', '==', 'true' ),
				'options'    => array(
					'text_color'        => __( 'Text Color', 'easy-accordion-pro' ),
					'text_active_clr'   => __( 'Text Active & Hover', 'easy-accordion-pro' ),
					'border_color'      => __( 'Border Color', 'easy-accordion-pro' ),
					'border_active_clr' => __( 'Border Active & Hover', 'easy-accordion-pro' ),
					'background'        => __( 'Background', 'easy-accordion-pro' ),
					'active_background' => __( 'Active & Hover BG', 'easy-accordion-pro' ),
				),
				'default'    => array(
					'text_color'        => '#5e5e5e',
					'text_active_clr'   => '#ffffff',
					'border_color'      => '#bbbbbb',
					'border_active_clr' => '#FE7C4D',
					'background'        => '#ffffff',
					'active_background' => '#FE7C4D',
				),
			),
		),
	)
); // Carousel settings section end.

//
// Typography section begin.
//
SP_EAP::createSection(
	$eap_accordion_shortcode_settings,
	array(
		'title'           => __( 'Typography', 'easy-accordion-pro' ),
		'icon'            => 'fa fa-font',
		'enqueue_webfont' => true,
		'fields'          => array(
			array(
				'type'    => 'submessage',
				'class'   => 'typography-notice',
				/* translators: 1: start link tag, 2: close tag. */
				'content' => sprintf( __( 'The %1$sGlobal Google Fonts%2$s option must be enabled for the font family to work properly, and the font weight depends on the font family.', 'easy-accordion-pro' ), '<a href="' . esc_url( admin_url( 'edit.php?post_type=sp_easy_accordion&page=eap_settings#tab=2' ) ) . '" target="_blank"><b>', '</b></a>' ),
			),
			array(
				'id'         => 'section_title_font_load',
				'type'       => 'switcher',
				'title'      => __( 'Load Accordion Section Title Font', 'easy-accordion-pro' ),
				'subtitle'   => __( 'On/Off google font for the section title.', 'easy-accordion-pro' ),
				'default'    => false,
				'dependency' => array(
					'section_title',
					'==',
					'true',
				),
			),
			array(
				'id'            => 'eap_section_title_typography',
				'type'          => 'typography',
				'title'         => __( 'Accordion Section Title Font', 'easy-accordion-pro' ),
				'subtitle'      => __( 'Set Accordion section title font properties.', 'easy-accordion-pro' ),
				'default'       => array(
					'color'          => '#444444',
					'font-family'    => '',
					'font-weight'    => '',
					'font-style'     => '',
					'font-size'      => '28',
					'line-height'    => '32',
					'letter-spacing' => '0',
					'text-align'     => 'left',
					'text-transform' => 'none',
					'type'           => 'google',
					'unit'           => 'px',
					'margin-bottom'  => '30',
				),
				'margin_bottom' => true,
				'preview'       => 'always',
				'dependency'    => array(
					'section_title',
					'==',
					'true',
					true,
				),
				'preview_text'  => 'Accordion Section Title',
			),
			array(
				'id'       => 'eap_title_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Accordion Item Title Font', 'easy-accordion-pro' ),
				'subtitle' => __( 'On/Off google font for the accordion item title.', 'easy-accordion-pro' ),
				'default'  => false,
			),
			array(
				'id'           => 'eap_title_typography',
				'type'         => 'typography',
				'title'        => __( 'Item Title Font', 'easy-accordion-pro' ),
				'subtitle'     => __( 'Set accordion item title font properties.', 'easy-accordion-pro' ),
				'default'      => array(
					'font-family'    => '',
					'font-weight'    => '',
					'font-style'     => '',
					'font-size'      => '20',
					'line-height'    => '30',
					'letter-spacing' => '0',
					'color'          => '#444',
					'active_color'   => '#444',
					'hover_color'    => '#444',
					'text-align'     => 'left',
					'text-transform' => 'none',
					'type'           => 'google',
				),
				'preview_text' => 'Accordion Item Title',
				'preview'      => 'always',
				'color'        => true,
				'hover_color'  => true,
				'active_color' => true,
			),
			array(
				'id'       => 'eap_desc_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Accordion Item Description Font', 'easy-accordion-pro' ),
				'subtitle' => __( 'On/Off google font for the accordion item description.', 'easy-accordion-pro' ),
				'default'  => false,
			),
			array(
				'id'           => 'eap_content_typography',
				'type'         => 'typography',
				'title'        => __( 'Description Font', 'easy-accordion-pro' ),
				'subtitle'     => __( 'Set accordion description font properties.', 'easy-accordion-pro' ),
				'default'      => array(
					'color'          => '#444',
					'font-family'    => '',
					'font-weight'    => '',
					'font-style'     => '',
					'font-size'      => '16',
					'line-height'    => '26',
					'letter-spacing' => '0',
					'text-align'     => 'left',
					'text-transform' => 'none',
					'type'           => 'google',
				),
				'preview'      => 'always',
				'preview_text' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel voluptatum, earum quibusdam quaerat cum quidem Culpa nam placeat iste laudantium illum, in aperiam deserunt ullam cumque libero. Vero, aut pariatur amet consectetur adipisicing elit. Facilis, tempora, quasi repellat reiciendis praesentium accusantium perspiciatis vero vitae numquam blanditiis nisi accusamus saepe eius.',
			),
		), // End of fields array.
	)
); // Style settings section end.
