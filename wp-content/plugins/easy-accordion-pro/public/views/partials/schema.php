<?php
/**
 * The Schema markup of the plugin.
 *
 * @package   easy-accordion-pro
 * @subpackage easy-accordion-pro/includes
 */

if ( ! function_exists( 'sp_clean_schema' ) ) {
	/**
	 * Sp_clean_schema clean schema function.
	 *
	 * @param  mixed $string string.
	 * @return statement
	 */
	function sp_clean_schema( $string ) {
		$string = strip_shortcodes( $string );
		$string = strip_tags( $string, '<p><b>' );
		$string = str_replace( '"', "'", $string );
		$string = str_replace( '\\', '', $string );
		return $string;
	}
}

if ( ! function_exists( 'schema_markup' ) ) {
	/**
	 * Schema_markup
	 *
	 * @param  mixed $title title of the accordion.
	 * @param  mixed $content accordion content.
	 * @return statement
	 */
	function schema_markup( $title = null, $content = null ) {
		$title   = sp_clean_schema( $title );
		$content = sp_clean_schema( $content );
		$markup  = '{
			"@type": "Question",
			"name": "' . $title . '",
			"acceptedAnswer": {
				"@type": "Answer",
				"text": "' . $content . '"
			}
		}';
		return $markup;
	}
}

if ( $eap_schema_markup ) {
	$markup = '<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "FAQPage",
		"mainEntity": [';
	if ( 'content-accordion' === $accordion_type && is_array( $content_sources ) ) {
		foreach ( $content_sources as $keys => $content_source ) {
			$accordion_title     = $content_source['accordion_content_title'];
			$content_description = $content_source['accordion_content_description'];
			$markup             .= schema_markup( $accordion_title, $content_description );
			$keys++;
			if ( $number_of_content_sources !== $keys ) {
				$markup .= ',';
			}
		}
	} elseif ( 'post-accordion' === $accordion_type ) {
		$post_schema_query = new WP_Query( $args );
		$accordion_count   = 0;
		if ( $post_schema_query->have_posts() ) {
			while ( $post_schema_query->have_posts() ) {
				$post_schema_query->the_post();
				$key             = get_the_ID();
				$accordion_title = get_the_title( $key );
				$content_main    = get_the_content();
				$markup         .= schema_markup( $accordion_title, $content_main );
				++$accordion_count;
				if ( $count_total_post !== $accordion_count ) {
					$markup .= ',';
				}
			}
			wp_reset_postdata();
		}
	}
	$markup .= ']
	}
	</script>';
	echo $markup;
}
