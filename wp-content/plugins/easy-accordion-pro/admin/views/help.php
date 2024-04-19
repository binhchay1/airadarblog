<?php
/**
 * The help page for the Easy Accordion Pro
 *
 * @package Easy Accordion Pro
 * @subpackage easy-accordion-pro/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access.

/**
 * The help class for the Easy Accordion Pro
 */
class Easy_Accordion_Pro_Help {

	/**
	 * Easy Accordion Pro single instance of the class
	 *
	 * @var null
	 * @since 2.0
	 */
	protected static $_instance = null;

	/**
	 * Main EASY_ACCORDION_PRO_HELP Instance
	 *
	 * @since 2.0
	 * @static
	 * @see sp_eap_help()
	 * @return self Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Add admin menu.
	 *
	 * @return void
	 */
	public function help_admin_menu() {
		add_submenu_page(
			'edit.php?post_type=sp_easy_accordion',
			__( 'Easy Accordion Help', 'easy-accordion-pro' ),
			__( 'Help', 'easy-accordion-pro' ),
			'manage_options',
			'eap_help',
			array(
				$this,
				'help_page_callback',
			)
		);
	}

	/**
	 * The Easy Accordion Help Callback.
	 *
	 * @return void
	 */
	public function help_page_callback() {
		echo '
        <div class="wrap about-wrap sp-eap-help">
        <h1>' . esc_html__( 'Welcome to Easy Accordion Pro!', ' Easy-accordion-pro' ) . '</h1>
        </div>
        <div class="wrap about-wrap sp-eap-help">
		<p class="about-text">' . esc_html__(
			'Thank you for installing Easy Accordion Pro! You\'re now running the most popular Easy Accordion plugin.
This video will help you get started with the plugin.',
			'easy-accordion-pro'
		) . '</p>

            <div class="headline-feature-video">
			<div class="headline-feature feature-video">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/videoseries?list=PLoUb-7uG-5jPNXkpGII8cTTfB-L4TCaqv" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
			</div>


			<div class="feature-section three-col">
			<div class="col">
					<div class="sp-eap-feature text-center">
						<h3><i class="sp-eap-font-icon fa fa-file-text"></i>
						' . esc_html__( 'Documentation', 'easy-accordion-pro' ) . '</h3>
						<p>' . esc_html__( 'Check out our documentation page and more information about what you can do with Easy Accordion Pro.', 'easy-accordion-pro' ) . '</p>
						<a href="https://docs.shapedplugin.com/docs/easy-accordion-pro/introduction/" target="_blank" class="button button-primary">' . esc_html__( 'Browse Docs', 'easy-accordion-pro' ) . '</a>
					</div>
				</div>
				<div class="col">
					<div class="sp-eap-feature text-center">
						<h3><i class="sp-eap-font-icon fa fa-envelope"></i>
						' . esc_html__( 'Email Support', 'easy-accordion-pro' ) . '</h3>
						<p>' . esc_html__( "Need one-to-one assistance? Get in touch with our top-notch support team! We'd love to help you immediately.", 'easy-accordion-pro' ) . '</p>
						<a href="https://shapedplugin.com/support/" target="_blank" class="button button-primary">' . esc_html__( 'Get Support', 'easy-accordion-pro' ) . '</a>
					</div>
				</div>
				<div class="col">
					<div class="sp-eap-feature text-center">
						<h3><i class="sp-eap-font-icon fa fa-file-video-o"></i>
						' . esc_html__( 'Video Tutorials', 'easy-accordion-pro' ) . '</h3>
						<p>' . esc_html__( 'Check our video tutorials which cover everything you need to know about Easy Accordion Pro.', 'easy-accordion-pro' ) . '</p>
						<a href="https://www.youtube.com/watch?v=JEv8hP5NvnY&list=PLoUb-7uG-5jPNXkpGII8cTTfB-L4TCaqv&ab_channel=ShapedPlugin" target="_blank" class="button button-primary">' . esc_html__( 'Watch Now', 'easy-accordion-pro' ) . '</a>
					</div>
				</div>
			</div>

			<div class="plugin-section">
				<div class="sp-plugin-section-title">
					<h2>' . esc_html__( 'Take your website beyond the typical with more premium plugins!', 'easy-accordion-pro' ) . '</h2>
					<h4>' . esc_html__( 'Some of our powerful premium plugins are ready to make your website awesome.', 'easy-accordion-pro' ) . '</h4>
				</div>
				<div class="feature-section first-cols three-col">
				<div class="col">
					<a href="https://wooproductslider.io/?ref=1"  target="_blank" alt="WooCommerce Product Slider Pro" class="eap-plugin-link">
					<div class="sp-eap-feature text-center">
						<img src="https://shapedplugin.com/wp-content/uploads/edd/2022/08/woo-product-slider.png" alt="WooCommerce Product Slider Pro" class="eap-help-img">
						<h3>
						' . esc_html__( 'Product Slider for WooCommerce', 'easy-accordion-pro' ) . '</h3>
						<p>' . esc_html__( 'Boost sales by interactive product Slider, Grid, and Table in your WooCommerce website or store.', 'easy-accordion-pro' ) . '</p>
					</div>
					</a>
				</div>
				<div class="col">
					<a href="https://wordpresscarousel.com/?ref=1" alt="WP Carousel" target="_blank" class="eap-plugin-link">
					<div class="sp-eap-feature text-center">
						<img src="https://shapedplugin.com/wp-content/uploads/edd/2022/08/wp-carousel.png" alt="WP Carousel" class="eap-help-img">
						<h3>
						' . esc_html__( 'WP Carousel', 'easy-accordion-pro' ) . '</h3>
						<p>' . esc_html__( 'The most powerful and user-friendly multi-purpose carousel, slider, & gallery plugin for WordPress.', 'easy-accordion-pro' ) . '</p>
					</div>
					</a>
				</div>
				<div class="col">
					<a href="https://realtestimonials.io/?ref=1" alt="Real Testimonials" target="_blank" class="eap-plugin-link">
					<div class="sp-eap-feature text-center">
						<img src="https://shapedplugin.com/wp-content/uploads/edd/2022/08/real-testimonials.png" alt="Real Testimonials" class="eap-help-img">
						<h3>
						' . esc_html__( 'Real Testimonials', 'easy-accordion-pro' ) . '</h3>
						<p>' . esc_html__( 'Simply collect, manage, and display Testimonials on your website and boost conversions.', 'easy-accordion-pro' ) . '</p>
					</div>
					</a>
				</div>
			</div>
			<div class="feature-section three-col">
				<div class="col">
					<a href="https://shapedplugin.com/plugin/woocommerce-gallery-slider-pro/?ref=1" target="_blank" alt="Gallery Slider for WooCommerce" class="eap-plugin-link">
					<div class="sp-eap-feature text-center">
						<img src="https://shapedplugin.com/wp-content/uploads/edd/2022/08/gallery-slider-for-woocommerce.png" alt="Gallery Slider for WooCommerce" class="eap-help-img">
						<h3>
						' . esc_html__( 'Gallery Slider for WooCommerce', 'easy-accordion-pro' ) . '</h3>
						<p>' . esc_html__( 'Product gallery slider and additional variation images gallery for WooCommerce and boost your sales.', 'easy-accordion-pro' ) . '</p>
					</div>
					</a>
				</div>
				<div class="col">
				    <a href="https://logocarousel.com/?ref=1" alt="Logo Carousel" target="_blank" class="eap-plugin-link">
					<div class="sp-eap-feature text-center">
						<img src="https://shapedplugin.com/wp-content/uploads/edd/2022/08/logo-carousel.png" alt="Logo Carousel" class="eap-help-img">
						<h3>
						' . esc_html__( 'Logo Carousel', 'easy-accordion-pro' ) . '</h3>
						<p>' . esc_html__( 'Showcase a group of logo images with Title, Description, Tooltips, Links, and Popup as a grid or in a carousel.', 'easy-accordion-pro' ) . '</p>
					</div>
					</a>
				</div>
				<div class="col">
				<a href="https://smartpostshow.com/?ref=1" alt="Smart Post Show" target="_blank" class="eap-plugin-link" >
					<div class="sp-eap-feature text-center">
						<img src="https://shapedplugin.com/wp-content/uploads/edd/2022/08/smart-post-show.png" alt="Smart Post Show" class="eap-help-img">
						<h3>
						' . esc_html__( 'Smart Post Show', 'easy-accordion-pro' ) . '</h3>
						<p>' . esc_html__( 'Filter and display posts (any post types), pages, taxonomy, custom taxonomy, and custom field, in beautiful layouts.', 'easy-accordion-pro' ) . '</p>

					</div>
					</a>
				</div>
			</div>
			</div>
		</div>';
	}

	/**
	 * Add plugin action menu
	 *
	 * @param array  $links The action link.
	 * @param string $file The file.
	 *
	 * @return array
	 */
	public function add_plugin_action_links( $links, $file ) {

		$manage_license     = new Easy_Accordion_Pro_License( SP_EASY_ACCORDION_PRO_FILE, SP_EAP_VERSION, 'ShapedPlugin', SP_EAP_STORE_URL, SP_EAP_ITEM_ID, SP_EAP_ITEM_SLUG );
		$license_key_status = $manage_license->get_license_status();
		$license_status     = ( is_object( $license_key_status ) ? $license_key_status->license : '' );

		if ( SP_EAP_BASENAME === $file ) {
			if ( 'valid' == $license_status ) {
				$new_links = array(
					sprintf( '<a href="%s">%s</a>', admin_url( 'post-new.php?post_type=sp_easy_accordion' ), __( 'Add Accordion', 'easy-accordion-pro' ) ),
				);
			} else {
				$new_links = array(
					sprintf( '<a style="color: red; font-weight: 600;" href="%s">%s</a>', admin_url( 'edit.php?post_type=sp_easy_accordion&page=eap_settings#tab=1' ), __( 'Activate license', 'easy-accordion-pro' ) ),
				);
			}
			return array_merge( $new_links, $links );
		}

		return $links;
	}
}
