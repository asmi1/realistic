<?php
/**
 * Template part for displaying post's next & previous posts links.
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !get_theme_mod( 'next_prev_post', '1' ) ) {
	return '';
} ?>

<div class="next_prev_post mdl-grid mdl-cell mdl-cell--12-col">
	<?php previous_post_link( '<div class="left-button">%link</div>', esc_html__( 'Previous Post','realistic' ) );
	echo '<div class="mdl-layout-spacer"></div>';	
	next_post_link( '<div class="right-button">%link</div>', esc_html__( 'Next Post','realistic' ) ); ?>
</div>