<?php
/**
 * Default/Content Accordion Markup of the plugin.
 * This template can be overridden by copying it to yourtheme/easy-accordion-pro/templates/accordion/default-content-markup.php
 *
 * @package   easy-accordion-pro
 * @subpackage easy-accordion-pro/includes
 */

if ( ! empty( $content_description ) ) { // make sure the default content or description is not empty before echoing.
	?>
<div class="ea-body <?php echo esc_attr( $animated_classes ); ?>"> 
	<?php
    // @codingStandardsIgnoreLine.
	echo $content_description;
	?>
</div>
	<?php
} elseif ( empty( $content_description ) ) { // If content description is empty, show "No Content" in the frontend.
	?>
	<div class="ea-body <?php echo esc_attr( $animated_classes ); ?>"> No Content </div>
	<?php
}
