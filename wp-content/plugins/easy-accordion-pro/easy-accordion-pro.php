<?php
/**
 * Plugin name: Easy Accordion Pro
 * Plugin URI:  https://easyaccordion.io/
 * Description: The best Responsive and Touch-friendly drag & drop <strong>Accordion FAQ</strong> builder plugin for WordPress.
 * Author:      ShapedPlugin, LLC
 * Author URI:  https://shapedplugin.com
 * Version:     2.5.2
 * Text Domain: easy-accordion-pro
 * Domain Path: /languages
 * WC requires at least: 5.0
 * WC tested up to: 8.7.0
 *
 * @package Easy_Accordion_Pro
 **/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

define( 'SP_EASY_ACCORDION_PRO_FILE', __FILE__ );

/**
 * The main class.
 */
class SP_EASY_ACCORDION_PRO {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      Easy_Accordion_Pro_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	public $loader;
	/**
	 * Currently plugin version.
	 *
	 * @since 2.0.0
	 *
	 * @var string
	 */
	public $version = '2.5.2';

	/**
	 * The name of the plugin.
	 *
	 * @since 2.0.0
	 *
	 * @var string
	 */
	public $plugin_name = 'easy-accordion-pro';

	/**
	 * Plugin textdomain.
	 *
	 * @since 2.0.0
	 *
	 * @var string
	 */
	public $domain = 'easy-accordion-pro';
	/**
	 * Plugin file.
	 *
	 * @var string
	 */
	private $file = __FILE__;
	/**
	 * Primary class constructor.
	 *
	 * @since 2.0.0
	 */

	/**
	 * Holds class object
	 *
	 * @var   object
	 * @since 2.0.0
	 */
	private static $instance;

	/**
	 * Initialize the SP_EASY_ACCORDION_PRO() class
	 *
	 * @since  2.0.0
	 * @return object
	 */
	public static function init() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof SP_EASY_ACCORDION_PRO ) ) {
			self::$instance = new SP_EASY_ACCORDION_PRO();
			self::$instance->setup();
		}
		return self::$instance;
	}

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since 2.0.0
	 */
	public function setup() {
		$this->define_constants();
		$this->includes();
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_common_hooks();
		$this->define_public_hooks();
		$this->eap_wc_tab();
	}

	/**
	 * Define constants
	 *
	 * @since 2.0.0
	 */
	public function define_constants() {
		define( 'SP_EAP_VERSION', $this->version );
		define( 'SP_EAP_ITEM_NAME', 'Easy Accordion Pro' );
		define( 'SP_EAP_ITEM_SLUG', 'easy-accordion-pro' );
		define( 'SP_EAP_PLUGIN_NAME', $this->plugin_name );
		define( 'SP_EAP_STORE_URL', 'https://shapedplugin.com' );
		define( 'SP_EAP_PRODUCT_URL', 'https://easyaccordion.io/' );
		define( 'SP_EAP_ITEM_ID', '541' );
		define( 'SP_EAP_PATH', plugin_dir_path( __FILE__ ) );
		define( 'SP_EAP_URL', plugin_dir_url( __FILE__ ) );
		define( 'SP_EAP_BASENAME', plugin_basename( __FILE__ ) );
		define( 'SP_EAP_INCLUDES', SP_EAP_PATH . '/includes' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Easy_Accordion_Pro_Admin( SP_EAP_PLUGIN_NAME, SP_EAP_VERSION );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_admin_styles' );
		$this->loader->add_filter( 'post_updated_messages', $plugin_admin, 'eap_updated_messages', 10, 2 );
		$this->loader->add_filter( 'manage_sp_easy_accordion_posts_columns', $plugin_admin, 'filter_accordion_admin_column' );

		$this->loader->add_action(
			'manage_sp_easy_accordion_posts_custom_column',
			$plugin_admin,
			'display_accordion_admin_fields',
			10,
			2
		);

		$this->loader->add_action( 'admin_action_sp_eap_duplicate_accordion', $plugin_admin, 'sp_eap_duplicate_accordion' );
		$this->loader->add_filter( 'post_row_actions', $plugin_admin, 'sp_eap_duplicate_accordion_link', 10, 2 );
		$this->loader->add_filter( 'admin_footer_text', $plugin_admin, 'sp_eap_review_text', 10, 2 );
		$this->loader->add_filter( 'plugin_row_meta', $plugin_admin, 'after_easy_accordion_row_meta', 10, 4 );
		$this->loader->add_action( 'before_woocommerce_init', $plugin_admin, 'declare_compatibility_with_woo_hpos_feature' );

		// License Page.
		$manage_license = new Easy_Accordion_Pro_License( SP_EASY_ACCORDION_PRO_FILE, SP_EAP_VERSION, 'ShapedPlugin', SP_EAP_STORE_URL, SP_EAP_ITEM_ID, SP_EAP_ITEM_SLUG );

		// Admin Menu.
		add_action( 'admin_init', array( $manage_license, 'easy_accordion_pro_activate_license' ) );
		add_action( 'admin_init', array( $manage_license, 'easy_accordion_pro_deactivate_license' ) );

		add_action( 'easy_accordion_pro_weekly_scheduled_events', array( $manage_license, 'check_license_status' ) );
		// this code for testing.
		// add_action( 'admin_init', array( $manage_license, 'check_license_status' ) );
		// Init Updater.
		add_action( 'admin_init', array( $manage_license, 'init_updater' ), 0 );

		// Display notices to admins.
		add_action( 'admin_notices', array( $manage_license, 'license_active_notices' ) );
		add_action( 'in_plugin_update_message-' . SP_EAP_BASENAME, array( $manage_license, 'plugin_row_license_missing' ), 10, 2 );

		// Redirect after active.
		add_action( 'activated_plugin', array( $this, 'redirect_to' ) );

		// Help Page.
		$help_page = new Easy_Accordion_Pro_Help( SP_EAP_PLUGIN_NAME, SP_EAP_VERSION );
		$this->loader->add_action( 'admin_menu', $help_page, 'help_admin_menu', 100 );
		$this->loader->add_filter( 'plugin_action_links', $help_page, 'add_plugin_action_links', 10, 2 );
		$import_export = new Easy_Accordion_Pro_Import_Export( SP_EAP_PLUGIN_NAME, SP_EAP_VERSION );
		$this->loader->add_action( 'wp_ajax_eap_export_accordions', $import_export, 'export_accordions' );
		$this->loader->add_action( 'wp_ajax_eap_import_accordions', $import_export, 'import_accordions' );
		// Elementor shortcode addons.
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		if ( ( is_plugin_active( 'elementor/elementor.php' ) || is_plugin_active_for_network( 'elementor/elementor.php' ) ) ) {
			require_once SP_EAP_PATH . 'admin/class-easy-accordion-pro-element-shortcode-addons.php';
		}
		if ( version_compare( $GLOBALS['wp_version'], '5.3', '>=' ) ) {
			// Gutenberg block.
			new Easy_Accordion_Pro_Gutenberg_Block();
		}
		add_filter( 'wp_is_mobile', array( $this, 'exclude_ipad_from_is_mobile' ) );
	}

	/**
	 * Exclude_ipad_from_is_mobile
	 *
	 * @param  boolean $is_mobile mobile or not.
	 * @return statement
	 */
	public function exclude_ipad_from_is_mobile( $is_mobile ) {
		if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && strpos( $_SERVER['HTTP_USER_AGENT'], 'iPad' ) !== false ) {
			$is_mobile = false;
		}
		$is_mobile = apply_filters( 'eap_exclude_include_custom_mobile_screen_size', $is_mobile );
		return $is_mobile;
	}

	/**
	 * Register common hooks.
	 *
	 * @since 2.0.0
	 * @access private
	 */
	private function define_common_hooks() {
		$plugin_cpt = new Easy_Accordion_Pro_Post_Type( $this->plugin_name, $this->version );
		$this->loader->add_action( 'init', $plugin_cpt, 'easy_accordion_post_type', 10 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    3.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new SP_EAP_Front_Scripts( $this->plugin_name, $this->version );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'front_scripts' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_public, 'admin_scripts' );
		$this->loader->add_action( 'wp_loaded', $plugin_public, 'register_all_scripts' );
	}

	/**
	 * Register WooCommerce hooks.
	 *
	 * @since 2.0.2
	 * @access private
	 */
	private function eap_wc_tab() {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		$settings    = get_option( 'sp_eap_settings' );
		$eap_woo_faq = isset( $settings['eap_woo_faq'] ) ? $settings['eap_woo_faq'] : '';
		if ( ( $eap_woo_faq ) && ( is_plugin_active( 'woocommerce/woocommerce.php' ) || is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) ) {
			// Product tab.
			$product_tab = new Easy_Accordion_Pro_Product_Tab( SP_EAP_PLUGIN_NAME, SP_EAP_VERSION );
			$this->loader->add_filter( 'woocommerce_product_tabs', $product_tab, 'eap_woo_faq_tab', 10, 2 );
			$this->loader->add_filter( 'woocommerce_product_data_tabs', $product_tab, 'easy_accordion_add_product_tab', 10, 1 );
			$this->loader->add_action( 'woocommerce_product_data_panels', $product_tab, 'eap_wc_product_page_faqs' );
			$this->loader->add_action( 'wp_ajax_eap_add_wc_faqs', $product_tab, 'eap_add_wc_faqs' );
			$this->loader->add_action( 'wp_ajax_eap_delete_wc_faqs', $product_tab, 'eap_delete_wc_faqs' );
		}
	}

	/**
	 * Included required files.
	 *
	 * @return void
	 */
	public function includes() {
		require_once SP_EAP_PATH . '/admin/helper/class-easy-accordion-pro-cron.php';
		require_once SP_EAP_INCLUDES . '/class-easy-accordion-pro-updates.php';
		require_once SP_EAP_INCLUDES . '/class-easy-accordion-pro-license.php';
		require_once SP_EAP_INCLUDES . '/class-easy-accordion-pro-post-types.php';
		require_once SP_EAP_INCLUDES . '/class-easy-accordion-pro-import-export.php';
		require_once SP_EAP_PATH . '/public/views/scripts.php';
		require_once SP_EAP_PATH . '/admin/class-easy-accordion-pro-admin.php';
		require_once SP_EAP_PATH . '/admin/views/help.php';
		require_once SP_EAP_PATH . '/admin/views/models/classes/setup.class.php';
		require_once SP_EAP_PATH . '/admin/views/metabox-config.php';
		require_once SP_EAP_PATH . '/admin/views/option-config.php';
		require_once SP_EAP_PATH . '/admin/views/tools-config.php';
		require_once SP_EAP_PATH . '/admin/views/widget.php';
		require_once SP_EAP_INCLUDES . '/class-easy-accordion-pro-loader.php';
		require_once SP_EAP_INCLUDES . '/class-easy-accordion-pro-product-tab.php';
		require_once SP_EAP_PATH . '/public/views/class-easy-accordion-pro-shortcode.php';
		require_once SP_EAP_PATH . '/admin/preview/class-easy-accordion-pro-preview.php';
		require_once SP_EAP_PATH . '/admin/class-easy-accordion-pro-gutenberg-block.php';
	}

	/**
	 * Redirect after active.
	 *
	 * @param  mixed $plugin basename.
	 * @return void
	 */
	public function redirect_to( $plugin ) {
		$manage_license     = new Easy_Accordion_Pro_License( SP_EASY_ACCORDION_PRO_FILE, SP_EAP_VERSION, 'ShapedPlugin', SP_EAP_STORE_URL, SP_EAP_ITEM_ID, SP_EAP_ITEM_SLUG );
		$license_key_status = $manage_license->get_license_status();
		deactivate_plugins( 'easy-accordion-free/plugin-main.php' );
		$license_status = ( is_object( $license_key_status ) ? $license_key_status->license : '' );
		if ( SP_EAP_BASENAME === $plugin && 'valid' !== $license_status ) {
			wp_safe_redirect( admin_url( 'edit.php?post_type=sp_easy_accordion&page=eap_settings#tab=1' ) );
			exit;
		}
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Easy_Accordion_Pro_Loader. Orchestrates the hooks of the plugin.
	 * - Easy_Accordion_Pro_i18n. Defines internationalization functionality.
	 * - Easy_Accordion_Pro_Admin. Defines all hooks for the admin area.
	 * - Easy_Accordion_Pro_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		$this->loader = new Easy_Accordion_Pro_Loader();
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    2.0.0
	 */
	public function run() {
		$this->loader->run();
	}
}

/**
 * Main instance of Easy Accordion Pro
 *
 * Returns the main instance of the Easy Accordion Pro.
 *
 * @since 2.0.0
 */
function sp_easy_accordion_pro() {
	if ( class_exists( 'SP_EASY_ACCORDION_PRO' ) ) {
		$plugin = SP_EASY_ACCORDION_PRO::init();
		$plugin->loader->run();
	}
}
sp_easy_accordion_pro();
