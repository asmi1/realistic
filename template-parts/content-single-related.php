<?php
/**
 * Template part for displaying post's related posts.
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
$related_posts = get_theme_mod( 'related_posts', '1' );
$related_posts_number = get_theme_mod( 'related_posts_number', '4' );				
$related_posts_query = get_theme_mod( 'related_posts_query', 'tags' );

if ( !( $related_posts && absint( $related_posts_number ) > 0 && absint( $related_posts_number ) <= 6 ) ) {
	return '';
}

$orig_post = $post;
$args = array();

// Build query args
if ( $related_posts_query == 'tags' ) {
	$tags = wp_get_post_tags( $post->ID );
	$tag_ids = array();

	foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;
	$args = array(
		'tag__in'				=> $tag_ids,
		'post__not_in'			=> array( $post->ID ),
		'posts_per_page'		=> $related_posts_number, // Number of related posts.
		'ignore_sticky_posts'	=> 1,
		'orderby'				=> 'rand', // Randomize the posts.
	);

} else if ( $related_posts_query == 'categories' ) {
	$categories = get_the_category( $post->ID );
	$category_ids = array();

	foreach( $categories as $individual_category ) $category_ids[] = $individual_category->term_id;
	$args = array(
		'category__in'			=> $category_ids,
		'post__not_in'			=> array( $post->ID ),
		'posts_per_page'		=> $related_posts_number,
		'ignore_sticky_posts'	=> 1,
		'orderby'				=> 'rand',
	);
}

$my_query = new wp_query( $args );

if ( $my_query->have_posts() ) { ?>

	<h3 class="related-posts-title section-title margin-8"><?php esc_html_e( 'Related Posts', 'realistic' ); ?></h3>
	<div class="related-posts mdl-grid mdl-cell mdl-cell--12-col">

		<?php while( $my_query->have_posts() ) {
			$my_query->the_post(); ?>

			<div class="related-item mdl-card mdl-shadow--2dp mdl-cell mdl-cell--6-col-desktop mdl-cell--4-col-tablet mdl-cell--4-col-phone">

				<div class="relatedthumb">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<img src="<?php echo realistic_get_thumbnail( $post->ID, 'rc_related' ); ?>" class="attachment-featured wp-post-image" alt="<?php the_title_attribute(); ?>">
						<?php realistic_post_format_icon( get_post_format( $post->ID ) ); ?>
					</a>
				</div>

				<div class="post-data-container">
					<h4>
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h4>
					<div class="post-info">
						<div class="meta-info">
							<span class="posted"><i class="material-icons">access_time</i><?php realistic_posted(); ?></span>
							<span class="comments"><i class="material-icons">chat_bubble</i><?php realistic_entry_comments(); ?></span>
						</div>
					</div>
				</div>

			</div>
		<?php } ?>
	</div>

<?php }

$post = $orig_post;
wp_reset_query();