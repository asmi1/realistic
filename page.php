<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();

$class = 'no_sidebar' == get_theme_mod( 'sidebar_settings', REALISTIC_SIDEBAR_LAYOUT )? 'mdl-cell mdl-cell--12-col-desktop': 'mdl-cell mdl-cell--9-col-desktop'; ?>
		
<div id="primary" class="content-area <?php echo $class; ?> mdl-cell--8-col-tablet mdl-cell--4-col-phone">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
