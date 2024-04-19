<?php
/**
 * The Collapse/Expand button markup of the plugin.
 * This template can be overridden by copying it to yourtheme/easy-accordion-pro/templates/collapse-expand-button.php
 *
 * @package   easy-accordion-pro
 * @subpackage easy-accordion-pro/includes
 */

// Collapse/Expand button.
if ( $faq_collapse_button && 'vertical' === $accordion_layout ) {
	?>
	<div id="eap-faq-collapse-button-<?php echo esc_attr( $post_id ); ?>" class="eap_faq_collapse_button" data-expand-text="<?php echo esc_attr( $expand_button_label ); ?>" data-collapse-text="<?php echo esc_attr( $collapse_button_label ); ?>">
		<a href="javascript:void(0)"><?php echo esc_html( $collapse_button_label ); ?>
			<span><i class="fa fa-angle-down"></i></span> 
			<span><i class="fa fa-angle-up"></i></i></span>
		</a>
	</div>
	<?php
}
