<?php
/**
 * Template part for displaying posts.
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$style = esc_attr( get_theme_mod( 'realistic_display', REALISTIC_DISPLAY ) );

get_template_part( 'template-parts/content', $style );