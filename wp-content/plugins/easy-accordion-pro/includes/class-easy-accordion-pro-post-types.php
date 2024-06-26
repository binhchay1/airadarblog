<?php
/**
 * The file that defines the Accordion post type.
 *
 * A class the that defines the Accordion post type and make the plugins' menu.
 *
 * @link http://shapedplugin.com
 * @since 2.0.0
 *
 * @package Easy_Accordion_pro
 * @subpackage Easy_Accordion_pro/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Custom post class to register the Accordion.
 */
class Easy_Accordion_Pro_Post_Type {

	/**
	 * The single instance of the class.
	 *
	 * @var self
	 * @since 2.0.0
	 */
	private static $instance;

	/**
	 * Path to the file.
	 *
	 * @since 2.0.0
	 *
	 * @var string
	 */
	public $file = __FILE__;

	/**
	 * Holds the base class object.
	 *
	 * @since 2.0.0
	 *
	 * @var object
	 */
	public $base;

	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @since 1.0.0
	 * @static
	 * @return self Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Easy Accordion post type
	 */
	public function easy_accordion_post_type() {

		if ( post_type_exists( 'sp_easy_accordion' ) ) {
			return;
		}
		$capability      = apply_filters( 'sp_easy_accordion_ui_permission', 'manage_options' );
		$is_user_capable = current_user_can( $capability ) ? true : false;
		// Set the easy accordion post type labels.
		$labels = apply_filters(
			'sp_easy_accordion_post_type_labels',
			array(
				'name'               => esc_html_x( 'Accordion Groups', 'easy-accordion-pro' ),
				'singular_name'      => esc_html_x( 'Easy Accordion', 'easy-accordion-pro' ),
				'add_new'            => esc_html__( 'Add New', 'easy-accordion-pro' ),
				'add_new_item'       => esc_html__( 'Add New Accordion Group', 'easy-accordion-pro' ),
				'edit_item'          => esc_html__( 'Edit Accordion Group', 'easy-accordion-pro' ),
				'new_item'           => esc_html__( 'New Accordion', 'easy-accordion-pro' ),
				'view_item'          => esc_html__( 'View  Accordion', 'easy-accordion-pro' ),
				'search_items'       => esc_html__( 'Search Accordion Group', 'easy-accordion-pro' ),
				'not_found'          => esc_html__( 'No WP Accordion found.', 'easy-accordion-pro' ),
				'not_found_in_trash' => esc_html__( 'No WP Accordion found in trash.', 'easy-accordion-pro' ),
				'parent_item_colon'  => esc_html__( 'Parent Accordion:', 'easy-accordion-pro' ),
				'menu_name'          => esc_html__( 'Easy Accordion', 'easy-accordion-pro' ),
				'all_items'          => esc_html__( 'Accordion Groups', 'easy-accordion-pro' ),
			)
		);

		// Base 64 encoded SVG image.   // Base 64 encoded SVG image.
		$menu_icon = 'data:image/svg+xml;base64,' . base64_encode(
			'<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
			<style type="text/css">
				.st0{fill:#A0A5AA;}
			</style>
			<g>
				<path class="st0" d="M0,128v256h512V128H0z M480,352H32V224h448V352z"/>
				<path class="st0" d="M0,0h512v96H0V0z"/>
				<path class="st0" d="M0,416h512v96H0V416z"/>
			</g>
			</svg>'
		);

		// Set the easy accordion post type arguments.
		$args = apply_filters(
			'sp_easy_accordion_post_type_args',
			array(
				'labels'              => $labels,
				'public'              => false,
				'hierarchical'        => false,
				'exclude_from_search' => true,
				'show_ui'             => $is_user_capable,
				'show_in_admin_bar'   => false,
				'menu_position'       => apply_filters( 'sp_easy_accordion_menu_position', 115 ),
				'menu_icon'           => $menu_icon,
				// 'menu_icon'           => SP_EAP_URL . '/admin/img/eap-icon.svg',
				'rewrite'             => false,
				'query_var'           => false,
				'imported'            => true,
				'supports'            => array(
					'title',
				),
			)
		);
		register_post_type( 'sp_easy_accordion', $args );
	}
}
