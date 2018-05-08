<?php
/**
 * Template part for displaying single posts.
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col' ); ?>>

	<header class="entry-header">
		<?php if ( get_theme_mod( 'post_breadcrumb', '1' ) ) {
			realistic_breadcrumb();
		} ?>

		<?php the_title( sprintf( '<h1 class="entry-title post-title">', esc_url( get_permalink() ) ), '</h1>' ); ?>

		<?php if ( get_theme_mod( 'post_meta', '1' ) ) {
			get_template_part( 'template-parts/content', 'meta' );
		} ?>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>

		<?php if ( get_theme_mod( 'post_meta', '1' ) ) {
			realistic_entry_tags();
		} ?>

		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'realistic' ),
			'after'  => '</div>',
		) ); ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->

<?php get_template_part( 'template-parts/content-single', 'links' ); ?>

<?php get_template_part( 'template-parts/content-single', 'related' ); ?>

<?php get_template_part( 'template-parts/content-single', 'author' ); ?>