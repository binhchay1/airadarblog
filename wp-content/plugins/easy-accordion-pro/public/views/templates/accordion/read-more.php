<?php
/**
 * Read More Button of the plugin.
 * This template can be overridden by copying it to yourtheme/easy-accordion-pro/templates/accordion/read-more.php
 *
 * @package   easy-accordion-pro
 * @subpackage easy-accordion-pro/includes
 */

// Check if read more is on and then include the read more button.
if ( $eap_read_more ) {
	$read_more_text = apply_filters( 'sp_easy_accordion_read_more_text', __( 'Read More', 'easy-accordion-pro' ) );
	?>
	<div class="sp-post-accordion-read-more-button">
	<a class="single-post-title" href="<?php the_permalink( $key ); ?>">
		<?php echo esc_html( $read_more_text ); ?>
	</a>
	</div>
	<?php
}
