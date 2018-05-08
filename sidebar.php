<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !is_active_sidebar( 'sidebar' ) || 'no_sidebar' == get_theme_mod( 'sidebar_settings', REALISTIC_SIDEBAR_LAYOUT ) ) {
	return '';
} ?>

<div id="secondary" class="widget-area mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet mdl-cell--2-offset-tablet mdl-cell--4-col-phone" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</div><!-- #secondary -->