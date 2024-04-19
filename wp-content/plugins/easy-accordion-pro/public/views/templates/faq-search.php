<?php
/**
 * The FAQ search markup of the plugin.
 * This template can be overridden by copying it to yourtheme/easy-accordion-pro/templates/faq-search.php
 *
 * @package   easy-accordion-pro
 * @subpackage easy-accordion-pro/includes
 */

$faq_search      = isset( $shortcode_data['eap_faq_search'] ) ? $shortcode_data['eap_faq_search'] : false;
$faq_placeholder = isset( $shortcode_data['faq_search_placeholder'] ) ? $shortcode_data['faq_search_placeholder'] : '';
if ( $faq_search ) {
	?>
	<div id="eap_faq_search_bar_container">
		<input type="search"  data-shortcode-id="<?php echo esc_attr( $post_id ); ?>" data-autocomplete="<?php echo esc_attr( $faq_autocomplete_search ); ?>" name="eap_faq_search_bar_sp-ea" id="eap_faq_search_bar_sp-ea-<?php echo esc_attr( $post_id ); ?>" placeholder="<?php echo esc_attr( $faq_placeholder ); ?>" value="" onkeyup="this.setAttribute('value', this.value);">
		<a></a>
	</div>
	<?php
}
