<?php
/**
 * Post Meta ( post author, post date and categories list).
 * This template can be overridden by copying it to yourtheme/easy-accordion-pro/templates/accordion/post-meta.php
 *
 * @package   easy-accordion-pro
 * @subpackage easy-accordion-pro/includes
 */

// Post meta( author name, date and categories).
$post_author                = esc_html( get_the_author_meta( 'display_name', $post_query->post_author ) );
$post_date                  = esc_html( get_the_date( get_option( 'date_format' ) ) );
$eap_post_categories        = wp_get_post_categories( $key, array( 'fields' => 'names' ) );
$prefix_before_author_name  = apply_filters( 'sp_accordion_author_before_author_name', 'By ' );
$separator_among_posts_meta = apply_filters( 'sp_accordion_meta_separator', ' / ' );
$prefix_before_date         = apply_filters( 'sp_accordion_prefix_before_date', 'On ' );
?>
<div class="eap-post-accordion-meta">
		<span class="post-author"><?php echo esc_html( $prefix_before_author_name ); ?>
			<?php echo esc_html( $post_author ); ?> 
			</span>
			<?php
			// Meta separator.
			echo esc_html( $separator_among_posts_meta );
			?>
		<span class="post-date"><?php echo esc_html( $prefix_before_date ); ?> <?php echo esc_html( $post_date ); ?> </span> 
		<?php
		// meta separator.
		echo esc_html( $separator_among_posts_meta );
		?>
		<?php
		if ( $eap_post_categories ) { // Always Check before loop for category name!
			$last_key         = array_key_last( $eap_post_categories ); // get the last array element.
			$count_total_cats = count( $eap_post_categories ) >= 2 ? ', ' : '';
			// Loop for the category name.
			foreach ( $eap_post_categories as $category_key => $category_name ) {
				$count_total_cats = ( $category_key === $last_key ) ? $count_total_cats = '' : $count_total_cats; // remove comma from the last array element.
				?>
				<span class="eap-post-category-name">
					<?php
					echo esc_html( $category_name );
					echo esc_html( $count_total_cats );
					?>
				</span>
				<?php
			}
		}
		?>
	</div>

