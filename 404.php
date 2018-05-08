<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

<div id="primary" class="content-area mdl-cell mdl-cell--12-col">
	<main id="main" class="site-main mdl-grid" role="main">

        <div class="error-404 not-found text-center mdl-cell mdl-cell--6-col-desktop mdl-cell--3-offset-desktop mdl-cell--6-col-tablet mdl-cell--1-offset-tablet mdl-cell--4-col-phone">

        	<span class="icon404"><?php esc_html_e( '404', 'realistic' ); ?></span>

            <h1 class="mdl-card__title-text"><?php esc_html_e( 'Page  Not Found', 'realistic' ); ?></h1>
            <p><?php esc_html_e( 'Sorry! That page doesn\'t seem to exist. You could return to the previous page.', 'realistic' ); ?></p>

            <button class="button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="window.history.back();"><i class="material-icons">arrow_back</i> <?php esc_html_e( 'Go Back', 'realistic' ); ?></button>

        </div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();