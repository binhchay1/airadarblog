<?php
/**
 * The single-item content markup of the plugin.
 * This template can be overridden by copying it to yourtheme/easy-accordion-pro/templates/accordion/single-item.php
 *
 * @package   easy-accordion-pro
 * @subpackage easy-accordion-pro/includes
 */

if ( ( 'content-accordion' === $accordion_type && ! $eap_inactive && ! $hide_specific_accordion ) || 'post-accordion' === $accordion_type ) {
	$eap_title_icon_markup = 'content-accordion' === $accordion_type ? $eap_title_icon_markup : '';
	?>
	<div class="ea-card <?php echo esc_attr( $accordion_mode['expand_class'] . ' ' . $accordion_item_class ); ?>" <?php echo esc_attr( $faq_search_id ); ?>>

		<<?php echo esc_attr( $eap_title_tag ); ?> class="ea-header">
			<a class="collapsed" data-sptoggle="spcollapse" rel="nofollow" <?php echo wp_kses_post( $data_sptarget ); ?> href="javascript:void(0)" data-title="efaq-<?php echo esc_attr( sanitize_title( $accordion_title ) ); ?>" aria-expanded="<?php echo esc_attr( $accordion_mode['aria_expanded'] ); ?>">
				<?php
				echo wp_kses_post( $eap_icon_markup . ' ' . $eap_title_icon_markup . ' ' . $accordion_title );
				?>
			</a>
		</<?php echo esc_attr( $eap_title_tag ); ?>>

		<div class="sp-collapse spcollapse <?php echo esc_attr( $accordion_mode['open_first'] ); ?>" id="collapse<?php echo esc_attr( $post_id . $key ); ?>" <?php echo wp_kses_post( $data_parent_id ); ?>>
		<?php
		if ( 'post-accordion' === $accordion_type ) {
			require self::eap_locate_template( 'accordion/post-content-markup.php' );
		} else {
			require self::eap_locate_template( 'accordion/default-content-markup.php' );
		}
		?>
		</div>
	</div>
	<?php
} elseif ( 'content-accordion' === $accordion_type && $eap_inactive && ! $hide_specific_accordion ) {
	?>
	<div class="<?php echo esc_attr( $accordion_item_class ); ?> eap_inactive">
		<<?php echo esc_attr( $eap_title_tag ); ?> class="ea-header">
			<a class="collapsed"  rel="nofollow" data-sptoggle="spcollapse" data-title="efaq-<?php echo esc_attr( sanitize_title( $accordion_title ) ); ?>" href="javascript:void(0)">
				<?php echo wp_kses_post( $eap_collapse_icon_markup . ' ' . $eap_title_icon_markup . ' ' . $accordion_title ); ?>
			</a>
		</<?php echo esc_attr( $eap_title_tag ); ?>>
	</div>
	<?php
}
