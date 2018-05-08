<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();

$class = 'no_sidebar' == get_theme_mod( 'sidebar_settings', REALISTIC_SIDEBAR_LAYOUT )? 'mdl-cell mdl-cell--12-col-desktop': 'mdl-cell mdl-cell--9-col-desktop'; ?>
		
<div id="primary" class="content-area <?php echo $class; ?> mdl-cell--8-col-tablet mdl-cell--4-col-phone">
	<main id="main" class="site-main" role="main">

	<?php if ( have_posts() ) : ?>
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content' );
			?>
		<?php endwhile; ?>
		
		<?php the_posts_pagination( array(
			'mid_size' => 2,
			'prev_text' => esc_html__( '&#8249; Previous', 'realistic' ),
			'next_text' => esc_html__( 'Next &#8250;', 'realistic' ),
		) ); ?>
		
	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>