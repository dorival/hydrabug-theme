<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package HydraBug
 */

if ( ! function_exists( 'hydrabug_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function hydrabug_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'hydrabug' ), $time_string
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'hydrabug_posted_in' ) ) :
	/**
	 * Prints HTML of categories the post is in
	 */
	 function hydrabug_posted_in($sectionSeparator = '', $separator = ',&nbsp;') {
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( $separator, 'hydrabug' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( esc_html__($sectionSeparator, 'hydrabug') ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				/* translators: used between list items, there is a space after the comma */
				printf( '<span class="cat-links">'. $categories_list .'</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	 }
endif;

if ( ! function_exists( 'hydrabug_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function hydrabug_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'Posted by %s', 'post author', 'hydrabug' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'hydrabug_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function hydrabug_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {		
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ',&nbsp;', 'list item separator', 'hydrabug' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="tags-links"><div class="tag-img" title="' . esc_html__( 'Tagged', 'hydrabug' ) . '"></div>'. $tags_list .'</div>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><div class="comment-img"></div>';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'hydrabug' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'hydrabug' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'hydrabug_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function hydrabug_post_thumbnail() {
		if ( is_attachment() ) {
			return;
		}

		if (post_password_required()) {
			?>
			<div class="post-thumbnail no-thumbnail password-protected">
				<div class="post-thumbnail-decal"></div>
			</div>
			<?php
			return;
		}

		if (! has_post_thumbnail()) {
			$category = get_the_category()[0];
			if (function_exists('z_taxonomy_image_url')):
				$categoryUrl = z_taxonomy_image_url($category->term_id);
		?>
			<a class="post-thumbnail no-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true"
				tabindex="-1" style="background-image:url(<?php echo $categoryUrl; ?>)">
				<div class="post-thumbnail-decal"></div>
				<?php
					if ($categoryUrl == ""):
						$c = substr($category->name, 0, 1);
						echo $c;
					endif;
				?>
			</a>
		<?php
			else:
				?>
				<div class="post-thumbnail no-thumbnail">
					<div class="post-thumbnail-decal"></div>
				</div>
		<?php
			endif;
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<div class="post-thumbnail-decal"></div>
				<?php the_post_thumbnail('full', array( 'width' => '100%', 'height' => '250px' )); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true"
				tabindex="-1" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>)">
				<div class="post-thumbnail-decal"></div>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;


if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
