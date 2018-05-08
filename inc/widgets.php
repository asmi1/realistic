<?php
/**
 * Register theme widgets
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once ( 'widgets/login.php' );
require_once ( 'widgets/popularposts.php' );
require_once ( 'widgets/recentposts.php' );
require_once ( 'widgets/socialicons.php' );

if( !function_exists( 'realistic_widgets_init' ) ) {
	function realistic_widgets_init() {

		register_widget( 'realistic_login_widget' );
		register_widget( 'realistic_popular_posts_widget' );
		register_widget( 'realistic_recent_posts_widget' );
		register_widget( 'realistic_social_icons_widget' );
	}

	add_action( 'widgets_init', 'realistic_widgets_init' );
}