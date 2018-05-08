<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col'); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title mdl-cell mdl-cell--12-col">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content mdl-cell mdl-cell--12-col">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'realistic' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->