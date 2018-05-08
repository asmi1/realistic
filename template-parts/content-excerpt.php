<?php
/**
 * Template part for displaying post excerpt.
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<div class="entry-content post-excerpt">
    <?php /* translators: %s: Name of current post */ ?>
    <span class="mdl-typography--font-light mdl-typography--subhead">
        <?php $length = get_theme_mod( 'excerpt_length', 20 );
		if ( $length && absint( $length ) >= 5 && absint( $length ) <= 120  ) { 
			echo realistic_truncate_string( get_the_excerpt(), $length, 'words' );;
		} ?>
    </span>
</div><!-- .entry-content -->

<div class="moretag">
    <a class="mdl-button mdl-js-button mdl-button--colored mdl-button--raised mdl-js-ripple-effect" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View article...', 'realistic' ); ?></a>
</div>