<?php
/**
 * The widget.
 *
 * @link https://shapedplugin.com
 * @since 2.0.11
 *
 * @package Easy_Accordion_Pro
 * @subpackage Easy_Accordion_Pro/admin
 */

/**
 * Easy_accordion_pro_widget
 *
 * @return void
 */
function easy_accordion_pro_widget() {
	register_widget( 'easy_accordion_pro_widget_content' );
}

add_action( 'widgets_init', 'easy_accordion_pro_widget' );

/**
 * Easy_accordion_pro_widget_content
 */
class easy_accordion_pro_widget_content extends WP_Widget {

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct(
			'easy_accordion_pro_widget_content',
			__( 'Easy Accordion Pro', 'easy-accordion-pro' ),
			array(
				'description' => __( 'Display accordion.', 'easy-accordion-pro' ),
			)
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args args.
	 * @param array $instance instance.
	 */
	public function widget( $args, $instance ) {
		extract( $args );//phpcs:ignore

		$title        = apply_filters( 'widget_title', esc_attr( $instance['title'] ) );
		$shortcode_id = isset( $instance['shortcode_id'] ) ? absint( $instance['shortcode_id'] ) : 0;

		if ( ! $shortcode_id ) {
			return;
		}

		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];//phpcs:ignore
		}

		echo do_shortcode( '[sp_easyaccordion id=' . esc_attr( $shortcode_id ) . ']' );
		echo wp_kses_post( $args['after_widget'] );
	}


	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options.
	 */
	public function form( $instance ) {
		$shortcodes   = $this->shortcodes_list();
		$shortcode_id = ! empty( $instance['shortcode_id'] ) ? absint( $instance['shortcode_id'] ) : null;
		$title        = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		if ( count( $shortcodes ) > 0 ) {

			echo sprintf( '<p><label for="%1$s">%2$s</label>', $this->get_field_id( 'title' ), esc_html__( 'Title:', 'easy-accordion-pro' ) );//phpcs:ignore
			echo sprintf( '<input type="text" class="widefat" id="%1$s" name="%2$s" value="%3$s" /></p>', $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $title );//phpcs:ignore

			echo sprintf( '<p><label>%s</label>', esc_html__( 'Shortcode:', 'easy-accordion-pro' ) );
			echo sprintf( '<select class="widefat" name="%s">', $this->get_field_name( 'shortcode_id' ) );//phpcs:ignore
			foreach ( $shortcodes as $shortcode ) {
				$selected = $shortcode->id == $shortcode_id ? 'selected="selected"' : '';
				echo sprintf(
					'<option value="%1$d" %3$s>%2$s</option>',
					esc_attr( $shortcode->id ),
					$shortcode->title, //phpcs:ignore
					esc_attr( $selected )
				);
			}
			echo '</select></p>';

		} else {
			echo sprintf(
				'<p>%1$s <a href="' . admin_url( 'post-new.php?post_type=sp_easy_accordion' ) . '">%3$s</a> %2$s</p>',
				esc_html__( 'You did not generate any accordion yet.', 'easy-accordion-pro' ),
				esc_html__( 'to generate a new accordion now.', 'easy-accordion-pro' ),
				esc_html__( 'click here', 'easy-accordion-pro' )
			);
		}
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options.
	 * @param array $old_instance The previous options.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                 = array();
		$instance['title']        = sanitize_text_field( $new_instance['title'] );
		$instance['shortcode_id'] = absint( $new_instance['shortcode_id'] );

		return $instance;
	}

	/**
	 * Shortcodes_list
	 *
	 * @return statement
	 */
	private function shortcodes_list() {
		$shortcodes = get_posts(
			array(
				'post_type'      => 'sp_easy_accordion',
				'post_status'    => 'publish',
				'posts_per_page' => 1000,

			)
		);

		if ( count( $shortcodes ) < 1 ) {
			return array();
		}

		return array_map(
			function ( $shortcode ) {
					return (object) array(
						'id'    => absint( $shortcode->ID ),
						'title' => esc_html( $shortcode->post_title ),
					);
			},
			$shortcodes
		);
	}
}
