<?php
/**
 * Elementor easy accordion pro shortcode Widget.
 *
 * @since      2.2.2
 * @package     Easy_Accordion_Pro
 * @subpackage  Easy_Accordion_Pro/admin
 */

/**
 * SP_Eap_Shortcode_Widget
 */
class SP_Eap_Shortcode_Widget extends \Elementor\Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @since 2.2.2
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'sp_easy_accordion_pro_shortcode';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.2.2
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Easy Accordion Pro', 'easy-accordion-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.2.2
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eap-icon-menu';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 2.2.2
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'basic' );
	}

	/**
	 * Get all post list.
	 *
	 * @since 2.2.2
	 * @return array
	 */
	public function sp_eap_post_list() {
		$post_list    = array();
		$sp_eap_posts = new \WP_Query(
			array(
				'post_type'      => 'sp_easy_accordion',
				'post_status'    => 'publish',
				'posts_per_page' => 10000,
			)
		);
		$posts        = $sp_eap_posts->posts;
		foreach ( $posts as $post ) {
			$post_list[ $post->ID ] = ! empty( $post->post_title ) ? $post->post_title : '#' . $post->ID;
		}
		krsort( $post_list );
		return $post_list;
	}

	/**
	 * Controls register.
	 *
	 * @return void
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'easy-accordion-pro' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'sp_easy_accordion_pro_shortcode',
			array(
				'label'       => __( 'Easy Accordion Pro Shortcode(s)', 'easy-accordion-pro' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => '',
				'options'     => $this->sp_eap_post_list(),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render woo category slider pro shortcode widget output on the frontend.
	 *
	 * @since 2.2.2
	 * @access protected
	 */
	protected function render() {

		$settings         = $this->get_settings_for_display();
		$sp_eap_shortcode = $settings['sp_easy_accordion_pro_shortcode'];

		if ( '' === $sp_eap_shortcode ) {
			echo '<div style="text-align: center; margin-top: 0; padding: 10px" class="elementor-add-section-drag-title">Select a shortcode</div>';
			return;
		}

		$generator_id = esc_attr( (int) $sp_eap_shortcode );

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$post_id = $generator_id;
			// Content Accordion.
			$settings           = get_option( 'sp_eap_settings' );
			$upload_data        = get_post_meta( $post_id, 'sp_eap_upload_options', true );
			$shortcode_data     = get_post_meta( $post_id, 'sp_eap_shortcode_options', true );
			$main_section_title = get_the_title( $post_id );

			// if found_generator_id does not exist.
				$dynamic_style = SP_EAP_Front_Scripts::load_dynamic_style( $post_id, $shortcode_data );
				$enqueue_fonts = Easy_Accordion_Pro_Shortcode::load_google_fonts( $dynamic_style['typography'] );
			if ( ! empty( $enqueue_fonts ) ) {
				echo '<link rel="stylesheet" href="' . esc_url( 'https://fonts.googleapis.com/css?family=' . implode( '|', $enqueue_fonts ) ) . '" media="all">';
			} // Google font enqueue dequeue.
				echo '<style id="ea_dynamic_css' . esc_attr( $generator_id ) . '">' . wp_strip_all_tags( $dynamic_style['dynamic_css'] ) . '</style>';

			Easy_Accordion_Pro_Shortcode::sp_easy_accordion_html_show( $post_id, $settings, $upload_data, $shortcode_data, $main_section_title );
			?>
			<script src="<?php echo esc_url( SP_EAP_URL . 'public/assets/js/script.js' ); ?>" ></script>
			<?php
		} else {
			echo do_shortcode( '[sp_easyaccordion id="' . $generator_id . '"]' );
		}
	}
}
