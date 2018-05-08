<?php
/**
 * Template part for displaying posts (style1 display).
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-box post-style1 mdl-card mdl-shadow--2dp mdl-grid mdl-cell mdl-cell--12-col'); ?>>

	<?php if ( is_sticky() ) { ?>
		<div class="featured"><i class="material-icons">star_rate</i></div>
	<?php } ?>

	<div class="post-img mdl-cell mdl-cell--12-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone">
		<?php get_template_part( 'template-parts/content', 'featured' ); ?>
	</div>

	<div class="post-data  mdl-cell mdl-cell--12-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone">
	
		<?php get_template_part( 'template-parts/content', 'actions' ); ?>

		<?php the_title( sprintf( '<h2 class="entry-title post-title mdl-card__title-text"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		
		<?php if ( get_theme_mod( 'archives_post_meta', '1' ) ) {
			get_template_part( 'template-parts/content', 'meta' );
		} ?>

		<?php if ( 0 < absint( get_theme_mod( 'excerpt_length', 20 ) ) ) {
			get_template_part( 'template-parts/content', 'excerpt' );
		} ?>

	</div><!-- .post-data -->

</article><!-- #post-## -->