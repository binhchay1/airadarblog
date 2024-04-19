<?php
/**
 * The file that defines the shortcode plugin class.
 *
 * A class definition that define easy accordion  shortcode of the plugin.
 *
 * @link       https://shapedplugin.com/
 * @since      2.0.0
 *
 * @package   easy-accordion-pro
 * @subpackage easy-accordion-pro/includes
 */

/**
 * The Shortcode class.
 *
 * This is used to define shortcode, shortcode attributes.
 */
class Easy_Accordion_Pro_Shortcode {

	/**
	 * Holds the class object.
	 *
	 * @since 2.0.0
	 * @var object
	 */
	public static $instance;

	/**
	 * Contain the base class object.
	 *
	 * @since 2.0.0
	 * @var object
	 */
	public $base;

	/**
	 * Holds the accordion data.
	 *
	 * @since 2.0.0
	 * @var array
	 */
	public $data;


	/**
	 * Undocumented variable
	 *
	 * @var string $post_id The post id of the accordion shortcode.
	 */
	public $post_id;


	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @since 2.0.0
	 * @static
	 * @return Easy_Accordion_Pro_Shortcode Shortcode instance.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Primary class constructor.
	 *
	 * @since 2.0.0
	 */
	public function __construct() {

		add_shortcode( 'sp_easyaccordion', array( $this, 'sp_easy_accordion_shortcode' ) );
		add_action( 'wp_ajax_sp_eap_ajax_load', array( $this, 'sp_eap_ajax_load' ) );
		add_action( 'wp_ajax_nopriv_sp_eap_ajax_load', array( $this, 'sp_eap_ajax_load' ) );
		add_action( 'wp_ajax_sp_eap_ajax_load_search', array( $this, 'sp_eap_ajax_load_search' ) );
		add_action( 'wp_ajax_nopriv_sp_eap_ajax_load_search', array( $this, 'sp_eap_ajax_load_search' ) );
		add_action( 'wp_ajax_data_fetch', array( $this, 'data_fetch' ) );
		add_action( 'wp_ajax_nopriv_data_fetch', array( $this, 'data_fetch' ) );
		add_action( 'save_post', array( $this, 'delete_page_accordion_option_on_save' ) );
		// Polylang support.
		add_filter( 'pll_get_post_types', array( $this, 'easy_accordion_pro_polylang_cpt_to_pll' ), 10, 2 );
	}

	/**
	 * Polylang_cpt_to_pll
	 *
	 * @param  mixed $post_types post types.
	 * @param  mixed $is_settings hide.
	 * @return array
	 */
	public function easy_accordion_pro_polylang_cpt_to_pll( $post_types, $is_settings ) {
		// enables language and translation management.
		$post_types['sp_easy_accordion'] = 'sp_easy_accordion';
		return $post_types;
	}

	/**
	 * Delete page shortcode ids array option on save
	 *
	 * @param  int $post_ID current post id.
	 * @return void
	 */
	public function delete_page_accordion_option_on_save( $post_ID ) {
		if ( is_multisite() ) {
			$option_key = 'easy_accordion_page_id' . get_current_blog_id() . $post_ID;
			if ( get_site_option( $option_key ) ) {
				delete_site_option( $option_key );
			}
		} else {
			if ( get_option( 'easy_accordion_page_id' . $post_ID ) ) {
				delete_option( 'easy_accordion_page_id' . $post_ID );
			}
		}
	}

	/**
	 * Minify output
	 *
	 * @param  string $html output minifier.
	 * @return statement
	 */
	public static function minify_output( $html ) {
		$html = preg_replace( '/<!--(?!s*(?:[if [^]]+]|!|>))(?:(?!-->).)*-->/s', '', $html );
		$html = str_replace( array( "\r\n", "\r", "\n", "\t" ), '', $html );
		while ( stristr( $html, '  ' ) ) {
			$html = str_replace( '  ', ' ', $html );
		}
		return $html;
	}

	/**
	 * The load google fonts function merge all fonts from shortcodes.
	 *
	 * @param  array $typography store the all shortcode typography.
	 * @return array
	 */
	public static function load_google_fonts( $typography ) {
		$enqueue_fonts = array();
		if ( ! empty( $typography ) ) {
			foreach ( $typography as $font ) {
				if ( isset( $font['type'] ) && 'google' === $font['type'] ) {
					$weight          = isset( $font['font-weight'] ) ? ( ( 'normal' !== $font['font-weight'] ) ? ':' . $font['font-weight'] : ':400' ) : ':400';
					$style           = isset( $font['font-style'] ) ? substr( $font['font-style'], 0, 1 ) : '';
					$enqueue_fonts[] = str_replace( ' ', '+', $font['font-family'] ) . $weight . $style;
				}
			}
		}
		$enqueue_fonts = array_unique( $enqueue_fonts );
		return $enqueue_fonts;
	}

	/**
	 * Accordion_mode
	 *
	 * @param  mixed $eap_accordion_mode mode type.
	 * @param  mixed $ea_key key.
	 * @param  mixed $eap_expand_icon expand icon.
	 * @param  mixed $eap_collapse_icon collapse icon.
	 * @return array
	 */
	public static function accordion_mode( $eap_accordion_mode = null, $ea_key = null, $eap_expand_icon = null, $eap_collapse_icon = null ) {
		$a_open_first      = '';
		$expand_icon_first = '';
		$expand_class      = '';
		$aria_expanded     = 'false';
		if ( 'ea-first-open' === $eap_accordion_mode ) {
			$a_open_first      = ( 1 === $ea_key ) ? 'collapsed show' : ' ';
			$expand_icon_first = ( 1 === $ea_key ) ? $eap_expand_icon : $eap_collapse_icon;
			$expand_class      = ( 1 === $ea_key ) ? 'ea-expand' : ' ';
			$aria_expanded     = ( 1 === $ea_key ) ? 'true' : 'false';
		} elseif ( 'ea-multi-open' === $eap_accordion_mode ) {
			$a_open_first      = 'collapsed show';
			$expand_icon_first = $eap_expand_icon;
			$expand_class      = 'ea-expand';
			$aria_expanded     = 'true';
		} elseif ( 'ea-all-close' === $eap_accordion_mode ) {
			$a_open_first      = 'spcollapse';
			$expand_icon_first = $eap_collapse_icon;
			$expand_class      = ' ';
			$aria_expanded     = 'false';
		} elseif ( 'custom' === $eap_accordion_mode ) {
			$a_open_first      = 'spcollapse';
			$expand_icon_first = $eap_collapse_icon;
			$expand_class      = ' ';
			$aria_expanded     = 'false';
		}
		$accordion_mode = array(
			'open_first'        => $a_open_first,
			'expand_icon_first' => $expand_icon_first,
			'expand_class'      => $expand_class,
			'aria_expanded'     => $aria_expanded,
		);
		return $accordion_mode;
	}
	/**
	 * Accordion_expand_collapse_icon
	 *
	 * @param  mixed $eap_expand_collapse_icon accordion icon.
	 * @return array
	 */
	public static function accordion_expand_collapse_icon( $eap_expand_collapse_icon = null ) {
		switch ( $eap_expand_collapse_icon ) {
			case '1':
				$eap_collapse_icon = 'fa-plus';
				$eap_expand_icon   = 'fa-minus';
				break;
			case '2':
				$eap_collapse_icon = 'fa-angle-down';
				$eap_expand_icon   = 'fa-angle-right';
				break;
			case '3':
				$eap_collapse_icon = 'fa-angle-double-down';
				$eap_expand_icon   = 'fa-angle-double-right';
				break;
			case '4':
				$eap_collapse_icon = 'fa-arrow-down';
				$eap_expand_icon   = 'fa-arrow-right';
				break;
			case '5':
				$eap_collapse_icon = 'fa-check';
				$eap_expand_icon   = 'fa-times';
				break;
			case '6':
				$eap_collapse_icon = 'fa-chevron-down';
				$eap_expand_icon   = 'fa-chevron-right';
				break;
			case '7':
				$eap_collapse_icon = 'fa-hand-o-down';
				$eap_expand_icon   = 'fa-hand-o-right';
				break;
			case '8':
				$eap_collapse_icon = 'fa-caret-down';
				$eap_expand_icon   = 'fa-caret-right';
				break;
			case '9':
				$eap_collapse_icon = 'fa-angle-up';
				$eap_expand_icon   = 'fa-angle-down';
				break;
			case '10':
				$eap_collapse_icon = 'fa-angle-double-up';
				$eap_expand_icon   = 'fa-angle-double-down';
				break;
			case '11':
				$eap_collapse_icon = 'fa-arrow-up';
				$eap_expand_icon   = 'fa-arrow-down';
				break;
			case '12':
				$eap_collapse_icon = 'fa-chevron-up';
				$eap_expand_icon   = 'fa-chevron-down';
				break;
			case '13':
				$eap_collapse_icon = 'fa-angle-down';
				$eap_expand_icon   = 'fa-angle-up';
				break;
			case '14':
				$eap_collapse_icon = 'fa-caret-down';
				$eap_expand_icon   = 'fa-caret-up';
				break;
			case '15':
				$eap_collapse_icon = 'fa-angle-double-down';
				$eap_expand_icon   = 'fa-angle-double-up';
				break;
			case '16':
				$eap_collapse_icon = 'fa-arrow-down';
				$eap_expand_icon   = 'fa-arrow-up';
				break;
			case '17':
				$eap_collapse_icon = 'fa-caret-up';
				$eap_expand_icon   = 'fa-caret-down';
				break;
			case '18':
				$eap_collapse_icon = 'fa-angle-down';
				$eap_expand_icon   = 'fa-angle-up';
				break;
			case '19':
				$eap_collapse_icon = 'fa-plus';
				$eap_expand_icon   = 'fa-times';
				break;
			case '20':
				$eap_collapse_icon = 'fa-q-img';
				$eap_expand_icon   = 'fa-a-img';
				break;
			default:
				$eap_collapse_icon = 'fa-plus';
				$eap_expand_icon   = 'fa-minus';
		}
		$expand_collapse_icon = array(
			'collapse' => $eap_collapse_icon,
			'expand'   => $eap_expand_icon,
		);
		return $expand_collapse_icon;
	}

	/**
	 * Accordion post query.
	 *
	 * @param array $upload_data get all layout options.
	 * @param array $shortcode_data get all meta options.
	 * @return void
	 */
	public static function accordion_post_query( $upload_data, $shortcode_data ) {
		$eap_post_type          = ( isset( $upload_data['eap_post_type'] ) ? $upload_data['eap_post_type'] : 'post' );
		$post_from              = ( isset( $upload_data['eap_display_posts_from'] ) ? $upload_data['eap_display_posts_from'] : '' );
		$specific_post_ids      = ( isset( $upload_data['eap_specific_posts'] ) ? $upload_data['eap_specific_posts'] : '' );
		$post_taxonomy          = ( isset( $upload_data['eap_post_taxonomy'] ) ? $upload_data['eap_post_taxonomy'] : '' );
		$post_taxonomy_terms    = ( isset( $upload_data['eap_taxonomy_terms'] ) ? $upload_data['eap_taxonomy_terms'] : '' );
		$post_taxonomy_operator = ( isset( $upload_data['taxonomy_operator'] ) ? $upload_data['taxonomy_operator'] : '' );
		$number_of_total_posts  = ( isset( $upload_data['number_of_total_posts'] ) ? $upload_data['number_of_total_posts'] : '' );

		$post_order_by           = ( isset( $upload_data['post_order_by'] ) ? $upload_data['post_order_by'] : 'date' );
		$post_order              = ( isset( $upload_data['post_order'] ) ? $upload_data['post_order'] : 'DESC' );
		$show_pagination         = isset( $shortcode_data['show_pagination'] ) ? $shortcode_data['show_pagination'] : false;
		$accordion_item_per_page = isset( $shortcode_data['pagination_show_per_page'] ) && (int) $shortcode_data['pagination_show_per_page'] > 0 ? (int) $shortcode_data['pagination_show_per_page'] : 8;

		$accordion_item_per_page = ( $accordion_item_per_page > $number_of_total_posts ) ? $number_of_total_posts : $accordion_item_per_page;
		$accordion_item_per_page = $show_pagination ? $accordion_item_per_page : $number_of_total_posts;

		if ( empty( $eap_post_type ) ) {
			return;
		}
		$ignore_sticky = apply_filters( 'sp_eap_ignore_sticky_post', 1 );
		$args          = array(
			'post_type'           => $eap_post_type,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => $ignore_sticky,
			'fields'              => 'ids',
			'posts_per_page'      => $number_of_total_posts,
			'order'               => $post_order,
			'orderby'             => $post_order_by,
		);

		if ( 'specific_post' === $post_from ) {
			$args['post__in'] = $specific_post_ids;
		}
		if ( 'taxonomy' === $post_from && ! empty( $post_taxonomy ) && ! empty( $post_taxonomy_terms ) ) {
			$args['tax_query'][] = array(
				'taxonomy'         => $post_taxonomy,
				'field'            => 'term_id',
				'include_children' => apply_filters( 'sp_eap_include_children_cat', false ),
				'terms'            => $post_taxonomy_terms,
				'operator'         => $post_taxonomy_operator,

			);
		}

		$all_post_ids     = get_posts( $args );
		$count_total_post = count( $all_post_ids );
		$total_page       = 1;
		$total_page       = $count_total_post / $accordion_item_per_page;
		$eap_args         = array(
			'post_type'           => $eap_post_type,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => $ignore_sticky,
			'posts_per_page'      => $accordion_item_per_page,
			'order'               => $post_order,
			'post__in'            => $all_post_ids,
			'orderby'             => $post_order_by,
		);
		$post_query       = array(
			'post_query'       => $eap_args,
			'args'             => $args,
			'count_total_post' => $count_total_post,
			'total_page'       => $total_page,
		);
		return $post_query;
	}

	/**
	 * Custom Template locator.
	 *
	 * @param  mixed $template_name template name.
	 * @param  mixed $template_path template path.
	 * @param  mixed $default_path default path.
	 * @return string
	 */
	public static function eap_locate_template( $template_name, $template_path = '', $default_path = '' ) {
		if ( ! $template_path ) {
			$template_path = 'easy-accordion-pro/templates';
		}
		if ( ! $default_path ) {
			$default_path = SP_EAP_PATH . '/public/views/templates/';
		}
		$template = locate_template( trailingslashit( $template_path ) . $template_name );
		// Get default template.
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}
		// Return what we found.
		return $template;
	}

	/**
	 * Full html show.
	 *
	 * @param array $post_id Shortcode ID.
	 * @param array $settings settings options.
	 * @param array $upload_data get all layout options.
	 * @param array $shortcode_data get all meta options.
	 * @param array $main_section_title shows section title.
	 */
	public static function sp_easy_accordion_html_show( $post_id, $settings, $upload_data, $shortcode_data, $main_section_title ) {
		if ( empty( $upload_data ) ) {
			return;
		}
		$accordion_type  = isset( $upload_data['eap_accordion_type'] ) ? $upload_data['eap_accordion_type'] : 'content-accordion';
		$content_sources = isset( $upload_data['accordion_content_source'] ) ? $upload_data['accordion_content_source'] : '';
		// Pagination options.
		$show_pagination = isset( $shortcode_data['show_pagination'] ) ? $shortcode_data['show_pagination'] : false;
		// Shortcode Option.
		$accordion_layout = isset( $shortcode_data['eap_accordion_layout'] ) ? $shortcode_data['eap_accordion_layout'] : '';
		$multi_column     = 'multi-column' === $accordion_layout ? ' ea-multi-column' : '';

		if ( 'multi-column' === $accordion_layout || wp_is_mobile() ) {
			$accordion_layout = 'vertical';
		}
		$eap_scroll_to_active_item = isset( $shortcode_data['eap_scroll_to_active_item'] ) ? $shortcode_data['eap_scroll_to_active_item'] : false;
		$eap_offset_to_scroll      = apply_filters( 'eap_offset_to_scroll', 0 );

		$accordion_theme_class = isset( $shortcode_data['eap_accordion_theme'] ) ? $shortcode_data['eap_accordion_theme'] : '';
		$eap_title_slug_class  = isset( $shortcode_data['eap_title_url'] ) && $shortcode_data['eap_title_url'] ? 'eap_title_to_slug' : '';
		global $accordion_wraper_class;
		$accordion_item_class = '';
		if ( 'vertical' === $accordion_layout ) {
			$accordion_wraper_class = $accordion_theme_class . ' sp-easy-accordion ' . $eap_title_slug_class;
			$accordion_item_class   = 'sp-ea-single';
		} elseif ( 'horizontal' === $accordion_layout ) {
			$accordion_wraper_class = 'sp-horizontal-accordion sp-easy-accordion ' . $eap_title_slug_class;
			$accordion_item_class   = 'single-horizontal';
		}
		$eap_schema_markup = isset( $shortcode_data['eap_schema_markup'] ) ? $shortcode_data['eap_schema_markup'] : false;

		// Accordion settings.
		$eap_preloader      = isset( $shortcode_data['eap_preloader'] ) ? $shortcode_data['eap_preloader'] : false;
		$eap_active_event   = isset( $shortcode_data['eap_accordion_event'] ) ? $shortcode_data['eap_accordion_event'] : '';
		$eap_accordion_mode = isset( $shortcode_data['eap_accordion_mode'] ) ? $shortcode_data['eap_accordion_mode'] : '';
		$keep_accordion     = isset( $shortcode_data['keep_accordion'] ) && 'custom' === $eap_accordion_mode ? $shortcode_data['keep_accordion'] : '';
		$eap_autoplay_time  = isset( $shortcode_data['autoplay_time'] ) ? $shortcode_data['autoplay_time'] : '3000';

		// Collapse/Expand button.
		$faq_collapse_button    = isset( $shortcode_data['eap_faq_collapse_button'] ) ? $shortcode_data['eap_faq_collapse_button'] : '';
		$collapse_button_fields = isset( $shortcode_data['eap_faq_collapse_fields'] ) ? $shortcode_data['eap_faq_collapse_fields'] : '';
		$expand_button_label    = isset( $collapse_button_fields['eap_faq_expand_label'] ) && $collapse_button_fields['eap_faq_expand_label'] ? $collapse_button_fields['eap_faq_expand_label'] : 'Expand All';
		$collapse_button_label  = isset( $collapse_button_fields['eap_faq_collapse_label'] ) && $collapse_button_fields['eap_faq_collapse_label'] ? $collapse_button_fields['eap_faq_collapse_label'] : 'Collapse All';

		if ( $faq_collapse_button && 'vertical' === $accordion_layout ) {
			$eap_mutliple_collapse = true;
		} else {
			$eap_mutliple_collapse = isset( $shortcode_data['eap_mutliple_collapse'] ) ? $shortcode_data['eap_mutliple_collapse'] : '';
		}

		/**
		 * Hover auto close option.
		 *
		 * @since 2.0.9
		 */
		$eap_mouseout_autoclose = isset( $shortcode_data['eap_auto_close'] ) ? $shortcode_data['eap_auto_close'] : false;
		// Accordion style.
		$acc_section_title = isset( $shortcode_data['section_title'] ) ? $shortcode_data['section_title'] : false;

		// Accordion title.
		$eap_title_tag = isset( $shortcode_data['ea_title_heading_tag'] ) ? 'h' . $shortcode_data['ea_title_heading_tag'] : 'h3';
		$ea_strip_tag  = isset( $shortcode_data['ea_strip_tag'] ) ? $shortcode_data['ea_strip_tag'] : false;

		$eap_title_icon = isset( $shortcode_data['eap_title_icon'] ) ? $shortcode_data['eap_title_icon'] : '';
		// Header icon.
		// Expand / Collapse Icon.
		$eap_icon                 = isset( $shortcode_data['eap_expand_close_icon'] ) ? $shortcode_data['eap_expand_close_icon'] : '';
		$eap_expand_collapse_icon = isset( $shortcode_data['eap_expand_collapse_icon'] ) ? $shortcode_data['eap_expand_collapse_icon'] : '';
		$eap_autop                = isset( $shortcode_data['eap_autop'] ) ? $shortcode_data['eap_autop'] : true;
		$eap_read_more            = isset( $shortcode_data['eap_read_more'] ) ? $shortcode_data['eap_read_more'] : false;
		$expand_collapse_icon     = self::accordion_expand_collapse_icon( $eap_expand_collapse_icon );
		$eap_expand_icon          = $expand_collapse_icon['expand'];
		$eap_collapse_icon        = $expand_collapse_icon['collapse'];
		// Animation.
		$eap_animation       = isset( $shortcode_data['eap_animation'] ) ? $shortcode_data['eap_animation'] : '';
		$eap_animation_style = isset( $shortcode_data['eap_animation_style'] ) ? $shortcode_data['eap_animation_style'] : '';

		$faq_autocomplete_search = isset( $shortcode_data['eap_faq_search_autocomplete'] ) ? $shortcode_data['eap_faq_search_autocomplete'] : false;
		wp_enqueue_script( 'sp-ea-imagesLoaded-js' );
		wp_enqueue_script( 'sp-ea-isotope-min-js' );

		// JS Files.
		wp_enqueue_script( 'sp-ea-accordion-js' );
		if ( $faq_autocomplete_search ) {
			wp_enqueue_script( 'sp-ea-autocomplete-js' );
		}
		wp_enqueue_script( 'sp-ea-accordion-config' );
		wp_localize_script(
			'sp-ea-accordion-config',
			'sp_eap_ajax_obj',
			array(
				'ajax_url'   => admin_url( 'admin-ajax.php' ),
				'nonce'      => wp_create_nonce( 'sp_eap_nonce' ),
				'loadScript' => SP_EAP_URL . 'public/assets/js/script.js',
			)
		);
		wp_enqueue_script( 'sp-ea-accordion-pagination' );
		wp_localize_script(
			'sp-ea-accordion-pagination',
			'sp_eap_ajax_pagi',
			array(
				'ajax_url'       => admin_url( 'admin-ajax.php' ),
				'nonce'          => wp_create_nonce( 'sp_eap_nonce' ),
				'loadPagiScript' => SP_EAP_URL . 'public/assets/js/accordion-pagination.js',
			)
		);
		echo '<div id="sp-eap-accordion-section-' . esc_attr( $post_id ) . '" class="sp-eap-container">';
		// Section title.
		include self::eap_locate_template( 'section-title.php' );
		// FAQ search.
		include self::eap_locate_template( 'faq-search.php' );
		if ( 'content-accordion' === $accordion_type ) {
			include self::eap_locate_template( 'default-accordion.php' );
		} elseif ( 'post-accordion' === $accordion_type ) {
			include self::eap_locate_template( 'post-accordion.php' );
		}
		if ( $show_pagination ) {
			include self::eap_locate_template( 'pagination.php' );
		}
		if ( $eap_schema_markup ) {
			include SP_EAP_PATH . '/public/views/partials/schema.php';
		}
		echo '</div>';
		$html = ob_get_contents();
		return apply_filters( 'sp_easy_accordion', $html, $post_id );
	}

	/**
	 * A shortcode for rendering the accordion.
	 *
	 * @param [string] $attributes Shortcode attributes.
	 * @param [string] $content Shortcode content.
	 * @return array
	 */
	public function sp_easy_accordion_shortcode( $attributes, $content = null ) {
		$manage_license     = new Easy_Accordion_Pro_License( SP_EASY_ACCORDION_PRO_FILE, SP_EAP_VERSION, 'ShapedPlugin', SP_EAP_STORE_URL, SP_EAP_ITEM_ID, SP_EAP_ITEM_SLUG );
		$license_key_status = $manage_license->get_license_status();
		$license_status     = ( is_object( $license_key_status ) && $license_key_status ? $license_key_status->license : '' );
		$if_license_status  = array( 'valid', 'expired' );
		if ( ! in_array( $license_status, $if_license_status ) ) {
			$activation_notice = '';
			if ( current_user_can( 'manage_options' ) ) {
				$activation_notice = sprintf(
					'<div class="easy-accordion-pro-license-notice" style="background: #ffebee;color: #444;padding: 18px 16px;border: 1px solid #d0919f;border-radius: 4px;font-size: 18px;line-height: 28px;">Please <strong><a href="%1$s">activate</a></strong> the license key to get the output of the <strong>Easy Accordion Pro</strong> plugin.</div>',
					esc_url( admin_url( 'edit.php?post_type=sp_easy_accordion&page=eap_settings#tab=1' ) )
				);
			}
			return $activation_notice;
		}

		if ( empty( $attributes['id'] ) || 'sp_easy_accordion' !== get_post_type( $attributes['id'] ) || ( get_post_status( $attributes['id'] ) === 'trash' ) ) {
			return;
		}
		$post_id            = esc_attr( (int) $attributes['id'] );
		$settings           = get_option( 'sp_eap_settings' );
		$upload_data        = get_post_meta( $post_id, 'sp_eap_upload_options', true );
		$shortcode_data     = get_post_meta( $post_id, 'sp_eap_shortcode_options', true );
		$main_section_title = get_the_title( $post_id );

		/**
		 * Stylesheet loading problem solving here. Shortcode id to push page id option for getting how many shortcode in the page.
		 */
		$get_page_data      = SP_EAP_Front_Scripts::get_page_data();
		$found_generator_id = $get_page_data['generator_id'];

		ob_start();
		// If shortcode is array and not exist then run this block of code.
		if ( ! is_array( $found_generator_id ) || ! $found_generator_id || ! in_array( $post_id, $found_generator_id ) ) {
			wp_enqueue_style( 'sp-ea-font-awesome' );
			wp_enqueue_style( 'sp-ea-animation' );
			wp_enqueue_style( 'sp-ea-style' );

			// Load dynamic style.
			$dynamic_style = SP_EAP_Front_Scripts::load_dynamic_style( $post_id, $shortcode_data );

			// Google font enqueue dequeue.
			$enqueue_fonts = self::load_google_fonts( $dynamic_style['typography'] );
			if ( ! empty( $enqueue_fonts ) ) {
				wp_enqueue_style( 'sp-eap-google-fonts' . $post_id, 'https://fonts.googleapis.com/css?family=' . implode( '|', $enqueue_fonts ), array(), SP_EAP_VERSION );
			}
			// Print dynamic style.
			echo '<style id="ea_dynamic_css' . esc_attr( $post_id ) . '">' . wp_strip_all_tags( $dynamic_style['dynamic_css'] ) . '</style>';
		}
		// Update all option If the option does not exist in the current page.
		SP_EAP_Front_Scripts::eap_update_options( $post_id, $get_page_data );
		// Render all output of the shortcode.
		self::sp_easy_accordion_html_show( $post_id, $settings, $upload_data, $shortcode_data, $main_section_title );
		return ob_get_clean();
	}

	/**
	 * Accordion ajax pagination and ajax-search function of the plugin.
	 *
	 * @return statement
	 */
	public function sp_eap_ajax_load_search() {
		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
		if ( ! wp_verify_nonce( $nonce, 'sp_eap_nonce' ) ) {
			return false;
		}
		$post_id        = isset( $_POST['id'] ) ? sanitize_text_field( wp_unslash( $_POST['id'] ) ) : '';
		$eap_page       = isset( $_POST['sp_eap_page'] ) ? sanitize_text_field( wp_unslash( $_POST['sp_eap_page'] ) ) : 1;
		$upload_data    = get_post_meta( $post_id, 'sp_eap_upload_options', true );
		$shortcode_data = get_post_meta( $post_id, 'sp_eap_shortcode_options', true );

		if ( empty( $upload_data ) ) {
			return;
		}

		// Pagination options.
		$show_pagination = isset( $shortcode_data['show_pagination'] ) ? $shortcode_data['show_pagination'] : false;
		// Shortcode Option.
		$accordion_layout = isset( $shortcode_data['eap_accordion_layout'] ) ? $shortcode_data['eap_accordion_layout'] : '';
		if ( 'multi-column' === $accordion_layout || wp_is_mobile() ) {
			$accordion_layout = 'vertical';
		}
		$accordion_theme_class = isset( $shortcode_data['eap_accordion_theme'] ) ? $shortcode_data['eap_accordion_theme'] : '';
		$eap_title_slug_class  = isset( $shortcode_data['eap_title_url'] ) && $shortcode_data['eap_title_url'] ? 'eap_title_to_slug' : '';
		global $accordion_wraper_class;
		$accordion_item_class = '';
		if ( 'vertical' === $accordion_layout ) {
			$accordion_wraper_class = $accordion_theme_class . ' sp-easy-accordion ' . $eap_title_slug_class;
			$accordion_item_class   = 'sp-ea-single';
		} elseif ( 'horizontal' === $accordion_layout ) {
			$accordion_wraper_class = 'sp-horizontal-accordion sp-easy-accordion ' . $eap_title_slug_class;
			$accordion_item_class   = 'single-horizontal';
		}
		$eap_schema_markup = isset( $shortcode_data['eap_schema_markup'] ) ? $shortcode_data['eap_schema_markup'] : false;
		// Accordion settings.
		$eap_preloader      = isset( $shortcode_data['eap_preloader'] ) ? $shortcode_data['eap_preloader'] : false;
		$eap_active_event   = isset( $shortcode_data['eap_accordion_event'] ) ? $shortcode_data['eap_accordion_event'] : '';
		$eap_accordion_mode = isset( $shortcode_data['eap_accordion_mode'] ) ? $shortcode_data['eap_accordion_mode'] : '';
		$keep_accordion     = ( isset( $shortcode_data['keep_accordion'] ) && 'custom' === $eap_accordion_mode ) ? $shortcode_data['keep_accordion'] : '';
		$eap_autoplay_time  = isset( $shortcode_data['autoplay_time'] ) ? $shortcode_data['autoplay_time'] : '3000';

		// Collapse/Expand button.
		$faq_collapse_button    = isset( $shortcode_data['eap_faq_collapse_button'] ) ? $shortcode_data['eap_faq_collapse_button'] : '';
		$collapse_button_fields = isset( $shortcode_data['eap_faq_collapse_fields'] ) ? $shortcode_data['eap_faq_collapse_fields'] : '';
		$expand_button_label    = isset( $collapse_button_fields['eap_faq_expand_label'] ) && $collapse_button_fields['eap_faq_expand_label'] ? $collapse_button_fields['eap_faq_expand_label'] : 'Expand All';
		$collapse_button_label  = isset( $collapse_button_fields['eap_faq_collapse_label'] ) && $collapse_button_fields['eap_faq_collapse_label'] ? $collapse_button_fields['eap_faq_collapse_label'] : 'Collapse All';

		if ( $faq_collapse_button && 'vertical' === $accordion_layout ) {
			$eap_mutliple_collapse = true;
		} else {
			$eap_mutliple_collapse = isset( $shortcode_data['eap_mutliple_collapse'] ) ? $shortcode_data['eap_mutliple_collapse'] : '';
		}

		/**
		 * Hover auto close option.
		 *
		 * @since 2.0.9
		 */
		$eap_mouseout_autoclose = isset( $shortcode_data['eap_auto_close'] ) ? $shortcode_data['eap_auto_close'] : false;

		// Accordion title.
		$eap_title_tag = isset( $shortcode_data['ea_title_heading_tag'] ) ? 'h' . $shortcode_data['ea_title_heading_tag'] : 'h3';
		$ea_strip_tag  = isset( $shortcode_data['ea_strip_tag'] ) ? $shortcode_data['ea_strip_tag'] : false;

		$eap_title_icon = isset( $shortcode_data['eap_title_icon'] ) ? $shortcode_data['eap_title_icon'] : '';
		// header icon.
		// Expand / Collapse Icon.
		$eap_icon                 = isset( $shortcode_data['eap_expand_close_icon'] ) ? $shortcode_data['eap_expand_close_icon'] : '';
		$eap_expand_collapse_icon = isset( $shortcode_data['eap_expand_collapse_icon'] ) ? $shortcode_data['eap_expand_collapse_icon'] : '';
		$eap_autop                = isset( $shortcode_data['eap_autop'] ) ? $shortcode_data['eap_autop'] : true;

		$expand_collapse_icon = self::accordion_expand_collapse_icon( $eap_expand_collapse_icon );
		$eap_expand_icon      = $expand_collapse_icon['expand'];
		$eap_collapse_icon    = $expand_collapse_icon['collapse'];

		// Animation.
		$eap_animation         = isset( $shortcode_data['eap_animation'] ) ? $shortcode_data['eap_animation'] : '';
		$eap_animation_style   = isset( $shortcode_data['eap_animation_style'] ) ? $shortcode_data['eap_animation_style'] : '';
		$eap_post_type         = ( isset( $upload_data['eap_post_type'] ) ? $upload_data['eap_post_type'] : 'post' );
		$number_of_total_posts = ( isset( $upload_data['number_of_total_posts'] ) ? $upload_data['number_of_total_posts'] : '' );
		$faq_search            = isset( $shortcode_data['eap_faq_search'] ) ? $shortcode_data['eap_faq_search'] : '';
		$faq_placeholder       = isset( $shortcode_data['faq_search_placeholder'] ) ? $shortcode_data['faq_search_placeholder'] : '';

		$accordion_type = isset( $upload_data['eap_accordion_type'] ) ? $upload_data['eap_accordion_type'] : 'content-accordion';
		$eap_read_more  = isset( $shortcode_data['eap_read_more'] ) ? $shortcode_data['eap_read_more'] : false; // read more button.
		// Accordion Pagination.
		$accordion_item_per_page = isset( $shortcode_data['pagination_show_per_page'] ) && (int) $shortcode_data['pagination_show_per_page'] > 0 ? (int) $shortcode_data['pagination_show_per_page'] : 8;
		$accordion_item_per_page = $show_pagination ? $accordion_item_per_page : $number_of_total_posts;
		$ea_key                  = (int) $accordion_item_per_page * ( (int) $eap_page - 1 );
		global $wp_embed;
		if ( 'post-accordion' === $accordion_type ) {
			$keyword = isset( $_POST['keyword'] ) ? sanitize_text_field( wp_unslash( $_POST['keyword'] ) ) : '';
			if ( empty( $eap_post_type ) ) {
				return;
			}
			$post_query_data  = self::accordion_post_query( $upload_data, $shortcode_data );
			$count_total_post = $post_query_data['count_total_post'];
			$total_page       = $post_query_data['total_page'];
			$args             = $post_query_data['args'];
			$eap_args         = $post_query_data['post_query'];
			if ( ! empty( $keyword ) ) {
				$eap_args['s'] = $keyword;
				$args['s']     = $keyword;
			}
			if ( ! empty( $eap_page ) ) {
				$eap_args['paged'] = $eap_page;
			}
			if ( empty( $keyword ) ) {
				$eap_args['posts_per_page'] = $accordion_item_per_page;
			}
			$post_query = new WP_Query( $eap_args );

			require self::eap_locate_template( 'preloader.php' );
			if ( $post_query->have_posts() ) {
				while ( $post_query->have_posts() ) {
					$post_query->the_post();
					$key             = get_the_ID();
					$accordion_title = get_the_title( $key );
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

					$aria_expanded       = 'false';
					$ea_key_check        = 0;
					$accordion_mode      = self::accordion_mode( $eap_accordion_mode, $ea_key_check, $eap_expand_icon, $eap_collapse_icon );
					$data_parent_id      = ( ! $eap_mutliple_collapse ) ? 'data-parent="#sp-ea-' . $post_id . '"' : '';
					$eap_exp_icon_markup = ( $eap_icon ) ? '<i class="ea-expand-icon fa ' . $accordion_mode['expand_icon_first'] . '"></i>' : '';
					$data_sptarget       = 'data-sptarget="#collapse' . $post_id . $key . '"';
					$animated_classes    = ( $eap_animation ) ? "animated  $eap_animation_style" : '';
					// Post meta( author name, date & categories ).
					$post_author          = esc_html( get_the_author_meta( 'display_name', $post_query->post_author ) );
					$post_date            = esc_html( get_the_date( get_option( 'date_format' ) ) );
					$eap_post_categories  = wp_get_post_categories( $key, array( 'fields' => 'names' ) );
					$post_accordion_body  = ( $eap_read_more || has_post_thumbnail() ) ? 'eap-post-accordion-body' : '';
					$post_accordion_body .= ( ! has_post_thumbnail() ) ? ' post-accordion-width' : '';

					if ( 'sp-ea-thirteen' === $accordion_theme_class ) {
						$eap_icon_markup = '<span class="sp-numbering">' . ++$ea_key . '</span>';
					} elseif ( 'sp-ea-fourteen sp-ea-thirteen' === $accordion_theme_class ) {
						$eap_icon_markup = '<span class="sp-numbering">' . $eap_exp_icon_markup . '</span>';
					} else {
						$eap_icon_markup = $eap_exp_icon_markup;
					}
					$faq_search_id = $faq_search ? ' id="eap-faq' . $post_id . $key . '" ' : '';

					require self::eap_locate_template( 'accordion/single-item.php' );
				}
			}
			wp_die();
		} elseif ( 'content-accordion' === $accordion_type ) {

			$content_sources     = isset( $upload_data['accordion_content_source'] ) ? $upload_data['accordion_content_source'] : '';
			$eap_content_sources = $content_sources;

			$keyword    = isset( $_POST['keyword'] ) ? sanitize_text_field( wp_unslash( $_POST['keyword'] ) ) : '';
			$start_post = 0;
			if ( empty( $keyword ) && $show_pagination && ! empty( $accordion_item_per_page ) && count( $content_sources ) > $accordion_item_per_page ) {
				$start_post          = $accordion_item_per_page * ( $eap_page - 1 );
				$eap_content_sources = array_slice( $content_sources, $start_post, $accordion_item_per_page );
			} elseif ( $keyword ) {
				$eap_content_sources = $content_sources;
			}

			$total_page = 1;
			if ( 'content-accordion' === $accordion_type ) {
				$content_sources = count( $upload_data['accordion_content_source'] );
				$total_page      = $content_sources / $accordion_item_per_page;
			}

			$count_total_post = count( $eap_content_sources );

			if ( empty( $eap_content_sources ) ) {
				return;
			}
			foreach ( $eap_content_sources as $key => $content_source ) {
				$key = $start_post + $key;
				global $wp_embed;
				$accordion_title = $content_source['accordion_content_title'];
				$accordion_desc  = isset( $content_source['accordion_content_description'] ) ? $content_source['accordion_content_description'] : '';
				$content         = apply_filters( 'sp_easy_accordion_content', $accordion_desc );
				$content_embed   = str_replace( ']]>', ']]&gt;', $content );
				if ( $eap_autop ) {
					$content_embed = wpautop( $content_embed );
				}
				$content_embed           = do_shortcode( shortcode_unautop( $wp_embed->autoembed( $content_embed ) ) );
				$content_description     = $ea_strip_tag ? wp_strip_all_tags( $content_embed ) : $content_embed;
				$title_icon              = isset( $content_source['accordion_content_icon'] ) ? $content_source['accordion_content_icon'] : '';
				$title_custom_icon       = isset( $content_source['accordion_custom_icon'] ) ? $content_source['accordion_custom_icon'] : '';
				$eap_inactive            = isset( $content_source['accordion_inactive'] ) ? $content_source['accordion_inactive'] : false;
				$hide_specific_accordion = isset( $content_source['hide_specific_accordion'] ) ? $content_source['hide_specific_accordion'] : false;

				$aria_expanded            = 'false';
				$ea_key_check             = 0;
				$accordion_mode           = self::accordion_mode( $eap_accordion_mode, $ea_key_check, $eap_expand_icon, $eap_collapse_icon );
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
					$eap_icon_markup = '<span class="sp-numbering"> ' . ++$ea_key . ' </span>';
				} elseif ( 'sp-ea-fourteen sp-ea-thirteen' === $accordion_theme_class ) {
					$eap_icon_markup = '<span class="sp-numbering"> ' . $eap_exp_icon_markup . ' </span>';
				} else {
					$eap_icon_markup = $eap_exp_icon_markup;
				}

				$faq_search_id = $faq_search ? 'id="esp_faq' . $post_id . $key . '" ' : '';

				if ( $keyword ) {
					$keywords         = explode( apply_filters( 'sp_eap_keyword_search_type', '+' ), $keyword );
					$keyword_in_title = false;

					foreach ( $keywords as $key_word ) {
						if ( stripos( $accordion_title . $content_description, $key_word ) !== false ) {
							$keyword_in_title = true;
							break;
						} else {
							$keyword_in_title = false;
						}
					}
				}
				if ( $keyword && $keyword_in_title || empty( $keyword ) && empty( $keyword_in_title ) ) {
					require self::eap_locate_template( 'accordion/single-item.php' );
				}
			}
			wp_die();
		}
	}



	/**
	 * Limit the text with html with exact no of words.
	 *
	 * @param mixed  $html The text you want to limit.
	 * @param int    $word_count The number of words to display.
	 * @param string $ellipsis The ellipsis at the end of the text.
	 * @return statement
	 */
	public static function sp_eap_limit_words_from_html( $html, $word_count = 55, $ellipsis = '...' ) {
		// Remove extra white spaces and new lines from the HTML.
		$html = preg_replace( '/\s+/', ' ', $html );

		// Split the HTML string into individual tags and words.
		$tokens = preg_split( '/(<[^>]+>| )/', $html, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE );

		$word_counter = 0;
		$excerpt      = '';

		foreach ( $tokens as $token ) {
			if ( $word_counter >= $word_count ) {
				break;
			}

			if ( '<' === $token[0] ) {
				// Append tags as they are.
				$excerpt .= $token;
			} else {
				// Split the token into words.
				$words = preg_split( '/\s+/', $token, -1, PREG_SPLIT_NO_EMPTY );

				foreach ( $words as $word ) {
					if ( $word_counter >= $word_count ) {
						break 2;
					}

					$excerpt .= $word . ' ';
					$word_counter++;
				}
			}
		}

		// Trim any trailing space.
		$excerpt = rtrim( $excerpt );

		// Add ellipsis if necessary.
		if ( count( $tokens ) > $word_count ) {
			$excerpt .= $ellipsis;
		}

		$excerpt = force_balance_tags( $excerpt );
		return $excerpt;
	}
}
new Easy_Accordion_Pro_Shortcode();
