<?php
/**
 * Post thumbnail
 * This template can be overridden by copying it to yourtheme/easy-accordion-pro/templates/accordion/post-thumbnail.php
 *
 * @package   easy-accordion-pro
 * @subpackage easy-accordion-pro/includes
 */

$post_thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
$post_thumb_url = $post_thumb_url && is_array( $post_thumb_url ) ? $post_thumb_url : array( '' );
// Check if featured image exist in the post.
if ( $post_thumb_url[0] && has_post_thumbnail() ) {
	?>
<div class="eap-post-accordion-featured-image">
	<img src=" <?php echo esc_attr( $post_thumb_url[0] ); ?> " class="post-accordion-image">
</div> 
	<?php
}
