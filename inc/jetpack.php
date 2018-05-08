<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function realistic_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'realistic_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function material_jetpack_setup
add_action( 'after_setup_theme', 'realistic_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function realistic_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content' );
	}
} // end function realistic_infinite_scroll_render
