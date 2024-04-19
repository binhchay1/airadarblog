<?php
/**
 * The plugin elementor addons.
 *
 * @link       https://shapedplugin.com/
 * @since      2.2.2
 *
 * @package    Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/Admin
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

/**
 * Elementor shortcode addon class.
 *
 * @since      2.2.2
 * @package     Easy_Accordion_Pro
 * @subpackage  Easy_Accordion_Pro/admin
 */
class Easy_Accordion_Pro_Element_Shortcode_Addons {
	/**
	 * Instance
	 *
	 * @since 2.2.2
	 *
	 * @access private
	 * @static
	 *
	 * @var Easy_Accordion_Pro_Element_Shortcode_Addons The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 2.2.2
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * @since 2.2.2
	 *
	 * @access public
	 */
	public function __construct() {
		$this->on_plugins_loaded();
		add_action( 'elementor/preview/enqueue_scripts', array( $this, 'eap_addons_enqueue_scripts' ) );
		add_action( 'elementor/preview/enqueue_styles', array( $this, 'eap_addons_enqueue_style' ) );
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'easy_accordion_pro_addons_icon' ) );
	}

	/**
	 * Elementor block icon.
	 *
	 * @since    2.2.2
	 * @return void
	 */
	public function easy_accordion_pro_addons_icon() {
		wp_enqueue_style( 'easy_accordion_pro_elementor_addons_icon', SP_EAP_URL . 'admin/css/fontello.min.css', array(), SP_EAP_VERSION, 'all' );
	}

	/**
	 * Register the JavaScript for the elementor block area.
	 *
	 * @since    2.2.2
	 */
	public function eap_addons_enqueue_scripts() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in easy_accordion_pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The easy_accordion_pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'sp-ea-accordion-js' );
		wp_enqueue_script( 'sp-ea-accordion-pagination' );
		wp_enqueue_script( 'sp-ea-autocomplete-js' );
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
	}
	/**
	 * Register the stylesheet for the elementor block area.
	 *
	 * @since    2.2.2
	 */
	public function eap_addons_enqueue_style() {
		// Style load in elementor page.
		wp_enqueue_style( 'sp-ea-font-awesome' );
		wp_enqueue_style( 'sp-ea-animation' );
		wp_enqueue_style( 'sp-ea-style' );
	}

	/**
	 * On Plugins Loaded
	 *
	 * Checks if Elementor has loaded, and performs some compatibility checks.
	 * If All checks pass, inits the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 2.2.2
	 *
	 * @access public
	 */
	public function on_plugins_loaded() {
		add_action( 'elementor/init', array( $this, 'init' ) );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 2.2.2
	 *
	 * @access public
	 */
	public function init() {
		// Add Plugin actions.
		add_action( 'elementor/widgets/register', array( $this, 'init_widgets' ) );
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 2.2.2
	 *
	 * @access public
	 */
	public function init_widgets() {
		// Register widget.
		require_once SP_EAP_PATH . 'admin/ElementAddons/SP_Eap_Shortcode_Widget.php';
		\Elementor\Plugin::instance()->widgets_manager->register( new SP_Eap_Shortcode_Widget() );
	}
}

Easy_Accordion_Pro_Element_Shortcode_Addons::instance();
