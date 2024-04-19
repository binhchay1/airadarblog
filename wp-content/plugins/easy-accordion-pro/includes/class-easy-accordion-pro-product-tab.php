<?php
/**
 * The file that defines the Accordion post type.
 *
 * A class the that defines the Accordion post type and make the plugins' menu.
 *
 * @link http://shapedplugin.com
 * @since 2.0.2
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
class Easy_Accordion_Pro_Product_Tab {

	/**
	 * The single instance of the class.
	 *
	 * @var self
	 * @since 2.0.2
	 */
	private static $instance;

	/**
	 * Path to the file.
	 *
	 * @since 2.0.2
	 *
	 * @var string
	 */
	public $file = __FILE__;

	/**
	 * Holds the base class object.
	 *
	 * @since 2.0.2
	 *
	 * @var object
	 */
	public $base;

	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @since 2.0.2
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
	 * Adds a custom FAQ tab to WooCommerce product pages.
	 *
	 * @param array $tabs The existing tabs array.
	 * @return array The modified tabs array with the FAQ tab added.
	 */
	public function eap_woo_faq_tab( $tabs ) {
		global $product;

		// Retrieve settings from options.
		$settings         = get_option( 'sp_eap_settings' );
		$ea_tab_label     = isset( $settings['eap_woo_faq_label'] ) ? $settings['eap_woo_faq_label'] : 'FAQ';
		$ea_tab_priority  = isset( $settings['eap_woo_faq_label_priority'] ) ? $settings['eap_woo_faq_label_priority'] : '35';
		$eap_woo_set_tabs = isset( $settings['eap_woo_set_tab'] ) ? $settings['eap_woo_set_tab'] : array();

		// Get the current product post.
		if ( is_object( $product ) ) {
			$product_post = get_post( $product->get_id() );
		} else {
			$product_post = get_post( get_the_id() );
		}

		// Get the product ID.
		$product_id = method_exists( $product, 'get_id' ) === true ? $product->get_id() : $product->ID;

		$eap_woo_set_tab           = array();
		$eap_woo_tab_shortcode_ids = array();

		if ( $eap_woo_set_tabs ) {
			foreach ( $eap_woo_set_tabs as $eap_woo_set_tab ) {
				// Determine if the tab should be displayed for the current product.
				$eap_display_tab_for = $eap_woo_set_tab['eap_display_tab_for'];
				$cat_ids             = get_the_terms( $product_id, 'product_cat' );
				$cat_ids             = wp_list_pluck( $cat_ids, 'term_id' );
				$eap_cat             = isset( $eap_woo_set_tab['eap_taxonomy_terms'] ) ? array_map( 'intval', $eap_woo_set_tab['eap_taxonomy_terms'] ) : array();
				$eap_product_ids     = isset( $eap_woo_set_tab['eap_specific_product'] ) ? array_map( 'intval', $eap_woo_set_tab['eap_specific_product'] ) : array();

				if ( ( is_array( $cat_ids ) && array_intersect( $eap_cat, $cat_ids ) && 'taxonomy' === $eap_display_tab_for ) || 'all' === $eap_display_tab_for || ( 'Specific_Products' === $eap_display_tab_for && is_array( $eap_product_ids ) ) && in_array( $product_id, $eap_product_ids ) ) {
					$eap_woo_set_tab           = $eap_woo_set_tab;
					$eap_woo_tab_shortcode     = isset( $eap_woo_set_tab['eap_woo_tab_shortcode'] ) ? $eap_woo_set_tab['eap_woo_tab_shortcode'] : array();
					$eap_woo_tab_shortcode_ids = array_merge( $eap_woo_tab_shortcode_ids, $eap_woo_tab_shortcode );
				}
			}
		}

		// Check if there are specific FAQs selected for the current product.
		$current_faqs = get_post_meta( $product_post->ID, 'EAP_Selected_FAQs', true );
		if ( ! empty( $current_faqs ) ) {
			$eap_woo_tab_shortcode_ids = is_array( $current_faqs ) ? $current_faqs : $eap_woo_tab_shortcode_ids;
		}

		// Add the FAQ tab if there are shortcode IDs.
		if ( ! empty( $eap_woo_tab_shortcode_ids ) ) {
			$tabs['eap_faq_tab'] = array(
				'title'      => $ea_tab_label,
				'callback'   => array( $this, 'woo_new_product_tab_content' ),
				'priority'   => $ea_tab_priority,
				'shortcodes' => $eap_woo_tab_shortcode_ids,
			);
		}

		return $tabs;
	}

	/**
	 * Adds a new product tab to an existing array.
	 *
	 * @param array $array The existing array of tabs.
	 * @return array The modified array with the new tab added.
	 */
	public function easy_accordion_add_product_tab( $array ) {
		$add_tab       = array(
			'label'  => __( 'EA FAQs', 'easy-accordion-pro' ),
			'target' => 'eap_faqs',
			'class'  => array(),
		);
		$array['faqs'] = $add_tab;
		return $array;
	}

	/**
	 * Displays the content of a custom tab in a WooCommerce product page.
	 *
	 * @param string $key The key or identifier of the tab.
	 * @param array  $tab The tab configuration array.
	 */
	public function woo_new_product_tab_content( $key, $tab ) {
		$current_faqs = (array) $tab['shortcodes'];
		// Display the content of the new tab.
		if ( ! empty( $current_faqs ) ) {
			foreach ( $current_faqs as $faq_list ) {
				echo do_shortcode( "[sp_easyaccordion id='" . esc_attr( $faq_list ) . "']" );
			}
		}
	}

	/**
	 * Displays a form to add or delete FAQs on a WooCommerce product page.
	 *
	 * @return void
	 */
	public function eap_wc_product_page_faqs() {
		global $thepostid;

		$current_faqs = get_post_meta( $thepostid, 'EAP_Selected_FAQs', true );

		if ( ! is_array( $current_faqs ) ) {
			$current_faqs = array();}

		$all_faqs = get_posts(
			array(
				'numberposts' => -1,
				'post_type'   => 'sp_easy_accordion',
			)
		);
		echo "<div id='eap_faqs' class='panel woocommerce_options_panel'>";

		echo "<div id='eap-form-container'>";
		echo "<div id='eap-add-faq-form-div'>";
		echo "<form id='eap-add-faq-form'>";

		echo '<h3>' . esc_html__( 'Accordion Shortcodes Available:', 'easy-accordion-pro' ) . '</h3>';
		echo "<div class='form-table eap-faq-add-table'>";
		// Display the list of available FAQs.
		foreach ( $all_faqs as $faqs ) {
			echo "<p class='eap-faq-row' data-faqid='" . esc_attr( $faqs->ID ) . "'>";
			echo "<input type='checkbox' class='eap-add-faq' name='Add_FAQs[]' value='" . esc_attr( $faqs->ID ) . "'/>";
			if ( ! empty( $faqs->post_title ) ) {
				echo esc_html( $faqs->post_title );
			} else {
				echo esc_html__( 'No Title', 'easy-accordion-pro' );
			}
			echo '</p>';
		}
		echo '</div>';
		echo '</form>';
		echo "<button class='eap-add-faq-button'>" . esc_html__( 'Add FAQs', 'easy-accordion-pro' ) . '</button>';
		echo '</div>'; // eap-add-faq-form-div.

		echo "<div id='eap-delete-faq-form-div'>";
		echo "<form id='eap-delete-faq-form'>";
		echo "<input type='hidden' id='eap-post-id' value='" . esc_attr( $thepostid ) . "' />";
		echo "<div class='form-table eap-delete-table'>";
		echo '<p>' . esc_html__( 'Delete?', 'easy-accordion-pro' ) . '</p>';
		// Display the list of selected FAQs.
		foreach ( $current_faqs as $faq_id ) {
			$faq = get_post( $faq_id );
			echo "<p class='eap-faq-row eap-delete-faq-row' data-faqid='" . esc_attr( $faq_id ) . "'>";
			echo "<input type='checkbox' class='eap-delete-faq' name='Delete_FAQs[]' value='" . esc_attr( $faq_id ) . "'/>";
			if ( ! empty( $faq->post_title ) ) {
				echo esc_html( $faq->post_title );
			} else {
				echo esc_html__( 'No Title', 'easy-accordion-pro' );
			}
			echo '</p>';
		}
		echo '</div>';
		echo '</form>';
		echo "<button class='eap-delete-faq-button'>" . esc_html__( 'Delete FAQs', 'easy-accordion-pro' ) . '</button>';
		echo '</div>'; // eap-add-faq-form-div.
		echo '</div>'; // eap-form-container.
		echo '</div>';
	}

	/**
	 * Handles the addition of FAQs to a WooCommerce product page.
	 *
	 * @return void
	 */
	public function eap_add_wc_faqs() {
		$post_id = sanitize_text_field( wp_unslash( $_POST['Post_ID'] ) );

		if ( ! is_numeric( $post_id ) ) {
			return;
		}

		$current_faqs = get_post_meta( $post_id, 'EAP_Selected_FAQs', true );
		if ( ! is_array( $current_faqs ) ) {
			$current_faqs = array();}

		$faqs = json_decode( stripslashes_deep( $_POST['FAQs'] ) );
		if ( ! is_array( $faqs ) ) {
			$faqs = array();
		}

		$added_faqs = array();
		foreach ( $faqs as $faq ) {
			if ( ! in_array( $faq, $current_faqs ) ) {
				$current_faqs[] = $faq;
				$faq_post       = get_post( $faq );
				$added_faqs[]   = array(
					'ID'   => $faq,
					'Name' => $faq_post->post_title,
				);
			}
		}

		update_post_meta( $post_id, 'EAP_Selected_FAQs', $current_faqs );

		echo wp_json_encode( $added_faqs );

		die();
	}
	/**
	 * Handles the deletion of FAQs from a WooCommerce product page.
	 *
	 * @return void
	 */
	public function eap_delete_wc_faqs() {
		$post_id = sanitize_text_field( wp_unslash( $_POST['Post_ID'] ) );

		$current_faqs = get_post_meta( $post_id, 'EAP_Selected_FAQs', true );
		if ( ! is_array( $current_faqs ) ) {
			$current_faqs = array();}

		$faqs = json_decode( stripslashes_deep( $_POST['FAQs'] ) );
		if ( ! is_array( $faqs ) ) {
			$faqs = array();}

		$remaining_faqs = array_diff( $current_faqs, $faqs );

		update_post_meta( $post_id, 'EAP_Selected_FAQs', $remaining_faqs );

		die();
	}
}
