<?php
/**
 * Post Content Markup of the plugin.
 * This template can be overridden by copying it to yourtheme/easy-accordion-pro/templates/accordion/post-content-markup.php
 *
 * @package   easy-accordion-pro
 * @subpackage easy-accordion-pro/includes
 */

if ( ! empty( $content_autop ) ) { // make sure post's content or description is not empty before including & echoing files and variables.
	?>
<div class="ea-body <?php echo esc_attr( $post_accordion_body ); ?> <?php echo esc_attr( $animated_classes ); ?>">
	<?php
	require self::eap_locate_template( 'accordion/post-thumbnail.php' );
	?>
	<div class="eap-post-accordion-content">
		<?php
		// post meta.
		require self::eap_locate_template( 'accordion/post-meta.php' );
		?>
			<!-- Post content. -->
			<div class="sp-accordion-post-content">
			<?php echo $content_autop;// phpcs:ignore ?>
			</div>
		<?php
		require self::eap_locate_template( 'accordion/read-more.php' );
		?>
	</div>
</div>	
	<?php
} else { // If content is empty then show "No Content" in the accordion.
	?>
		<div class="ea-body <?php echo esc_attr( $animated_classes ); ?>"> No Content </div>
	<?php
}
