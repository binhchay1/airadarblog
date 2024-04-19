<?php
/**
 * The admin-specific of the plugin.
 *
 * @link https://shapedplugin.com
 * @since 2.0.0
 *
 * @package Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

/**
 * The class for the admin-specific functionality of the plugin.
 */
class Easy_Accordion_Pro_Admin {

	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @since 2.0.0
	 * @static
	 * @return self Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Register the stylesheets for the admin area of the plugin.
	 *
	 * @since  2.0.0
	 * @return void
	 */
	public function enqueue_admin_styles() {
		$current_screen        = get_current_screen();
		$the_current_post_type = $current_screen->post_type;
		if ( 'sp_easy_accordion' === $the_current_post_type ) {
			wp_enqueue_style( 'sp-ea-font-awesome' );
		}
		wp_enqueue_style( SP_EAP_PLUGIN_NAME . 'admin', SP_EAP_URL . 'admin/css/easy-accordion-pro-admin.css', array(), SP_EAP_VERSION, 'all' );
	}

	/**
	 * Change Accordion updated messages.
	 *
	 * @param string $messages The Update messages.
	 * @return statement
	 */
	public function eap_updated_messages( $messages ) {
		$screen = get_current_screen();
		if ( 'sp_easy_accordion' === $screen->post_type ) {
			$messages['post'][1]  = esc_html__( 'Accordion updated.', 'easy-accordion-pro' );
			$messages['post'][4]  = esc_html__( 'Accordion updated.', 'easy-accordion-pro' );
			$messages['post'][6]  = esc_html__( 'Accordion published.', 'easy-accordion-pro' );
			$messages['post'][8]  = esc_html__( 'Accordion submitted.', 'easy-accordion-pro' );
			$messages['post'][10] = esc_html__( 'Accordion draft updated.', 'easy-accordion-pro' );
		}
		return $messages;
	}

	/**
	 * Add accordion admin columns.
	 *
	 * @return statement
	 */
	public function filter_accordion_admin_column() {
		$admin_columns['cb']             = '<input type="checkbox" />';
		$admin_columns['title']          = __( 'Accordion Group Title', 'easy-accordion-pro' );
		$admin_columns['shortcode']      = __( 'Shortcode', 'easy-accordion-pro' );
		$admin_columns['accordion_type'] = __( 'Accordion Type', 'easy-accordion-pro' );
		$admin_columns['date']           = __( 'Date', 'easy-accordion-pro' );

		return $admin_columns;
	}

	/**
	 * Display admin columns for the accordions.
	 *
	 * @param mix    $column The columns.
	 * @param string $post_id The post ID.
	 * @return void
	 */
	public function display_accordion_admin_fields( $column, $post_id ) {
		$upload_data    = get_post_meta( $post_id, 'sp_eap_upload_options', true );
		$accordion_type = isset( $upload_data['eap_accordion_type'] ) ? $upload_data['eap_accordion_type'] : '';
		switch ( $column ) {
			case 'shortcode':
				$column_field = '<div class="sp_eap-after-copy-text"><i class="fa fa-check-circle"></i>  Shortcode  Copied to Clipboard! </div><input style="width: 270px; padding: 6px; cursor:pointer;" type="text" onClick="this.select();" readonly="readonly" value="[sp_easyaccordion id=&quot;' . $post_id . '&quot;]"/>';
				echo $column_field; //phpcs:ignore
				break;
			case 'accordion_type':
				echo ucwords( str_replace( '-', ' ', $accordion_type ) ); //phpcs:ignore
		} // end switch.
	}


	/**
	 * Duplicate the accordion
	 *
	 * @return void
	 */
	public function sp_eap_duplicate_accordion() {
		global $wpdb;
		if ( ! ( isset( $_GET['post'] ) || isset( $_POST['post'] ) || ( isset( $_REQUEST['action'] ) && 'sp_eap_duplicate_accordion' === $_REQUEST['action'] ) ) ) {
			wp_die( esc_html__( 'No shortcode to duplicate has been supplied!', 'easy-accordion-pro' ) );
		}

		/**
		 * Nonce verification
		 */
		$nonce = isset( $_GET['sp_eap_duplicate_nonce'] ) ? sanitize_text_field( wp_unslash( $_GET['sp_eap_duplicate_nonce'] ) ) : null;
		if ( ! wp_verify_nonce( $nonce, basename( __FILE__ ) ) ) {
			return;
		}

		/**
		 * Get the original shortcode id
		 */
		$post_id         = ( isset( $_GET['post'] ) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
		$capability      = apply_filters( 'sp_easy_accordion_ui_permission', 'manage_options' );
		$is_user_capable = current_user_can( $capability ) ? true : false;

		if ( ! $is_user_capable && get_post_type( $post_id ) !== 'sp_easy_accordion' ) {
			wp_die( esc_html__( 'No shortcode to duplicate has been supplied!', 'easy-accordion-pro' ) );
		}

		/**
		 * And all the original shortcode data then
		 */
		$post = get_post( $post_id );

		$current_user    = wp_get_current_user();
		$new_post_author = $current_user->ID;

		/*
		 * if shortcode data exists, create the shortcode duplicate
		 */
		if ( isset( $post ) && null !== $post ) {

			// New shortcode data array.
			$args = array(
				'comment_status' => $post->comment_status,
				'ping_status'    => $post->ping_status,
				'post_author'    => $new_post_author,
				'post_content'   => $post->post_content,
				'post_excerpt'   => $post->post_excerpt,
				'post_name'      => $post->post_name,
				'post_parent'    => $post->post_parent,
				'post_password'  => $post->post_password,
				'post_status'    => 'draft',
				'post_title'     => $post->post_title,
				'post_type'      => $post->post_type,
				'to_ping'        => $post->to_ping,
				'menu_order'     => $post->menu_order,
			);

			/*
			 * insert the shortcode by wp_insert_post() function
			 */
			$new_post_id = wp_insert_post( $args );

			/*
			 * get all current post terms ad set them to the new post draft
			 */
			$taxonomies = get_object_taxonomies( $post->post_type );
			foreach ( $taxonomies as $taxonomy ) {
				$post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
				wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
			}

			/*
			 * duplicate all post meta just in two SQL queries
			 */
			$post_meta_infos = get_post_custom( $post_id );
			if ( 0 !== count( $post_meta_infos ) ) {
				foreach ( $post_meta_infos as $key => $values ) {
					foreach ( $values as $value ) {
						$value = wp_slash( maybe_unserialize( $value ) ); // Unserialize data to avoid conflicts.
						add_post_meta( $new_post_id, $key, $value );
					}
				}
			}

			/*
			 * finally, redirect to the edit post screen for the new draft
			 */
			wp_safe_redirect( admin_url( 'edit.php?post_type=' . $post->post_type ) );

			exit;
		} else {
			wp_die( esc_html__( 'Accordion duplication failed, could not find original accordion: ', 'easy-accordion-pro' ) . esc_attr( $post_id ) );
		}
	}

	/**
	 * Add the duplicate link to action list for post_row_actions
	 *
	 * @param mix    $actions The actions of the link.
	 * @param object $post The post to provide its ID.
	 * @return statement
	 */
	public function sp_eap_duplicate_accordion_link( $actions, $post ) {
		if ( current_user_can( 'edit_posts' ) && 'sp_easy_accordion' === $post->post_type ) {
			$actions['duplicate'] = '<a href="' . wp_nonce_url( 'admin.php?action=sp_eap_duplicate_accordion&post=' . esc_attr( $post->ID ), basename( __FILE__ ), 'sp_eap_duplicate_nonce' ) . '" rel="permalink">' . __( 'Duplicate', 'easy-accordion-pro' ) . '</a>';
		}
		return $actions;
	}
	/**
	 * Bottom review notice.
	 *
	 * @param string $text The review notice.
	 * @return string
	 */
	public function sp_eap_review_text( $text ) {
		$screen = get_current_screen();
		if ( 'sp_easy_accordion' === get_post_type() || 'sp_easy_accordion_page_eap_settings' === $screen->id || 'sp_easy_accordion_page_eap_help' === $screen->id ) {
			$url  = 'https://wordpress.org/support/plugin/easy-accordion-free/reviews/?filter=5#new-post';
			$text = sprintf( __( 'If you like <strong>Easy Accordion Pro</strong>, please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'easy-accordion-pro' ), $url );
		}

		return $text;
	}
	/**
	 *  Add plugin row meta link
	 *
	 * @param [array] $plugin_meta Add plugin row meta link.
	 * @param [url]   $file plugin row meta link.
	 * @return array
	 */
	public function after_easy_accordion_row_meta( $plugin_meta, $file ) {
		if ( SP_EAP_BASENAME === $file ) {
			$plugin_meta[] = '<a href="https://easyaccordion.io/all-accordion-themes/" target="_blank">' . __( 'Live Demo', 'easy-accordion-pro' ) . '</a>';
		}
			return $plugin_meta;
	}

	/**
	 * Declare that this plugin is compatible with WooCommerce High-Performance Order Storage (HPOS) feature.
	 *
	 * @since 2.4.1
	 *
	 * @return void
	 */
	public function declare_compatibility_with_woo_hpos_feature() {
		if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', 'easy-accordion-pro/easy-accordion-pro.php', true );
		}
	}
}
