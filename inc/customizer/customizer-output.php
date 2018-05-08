<?php
/**
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Dynamic CSS
if ( !function_exists( 'realistic_dynamic_css' ) ) {
	function realistic_dynamic_css() {

        // Sidebar Settings
        $theme_css = '';
        $theme_css .= 'left_sidebar' == esc_attr( get_theme_mod( 'sidebar_settings', REALISTIC_SIDEBAR_LAYOUT ) )? '.content-area{float:right;}': '';

        // Background color
        $bg_color = get_theme_mod( 'bg_color', REALISTIC_BG_COLOR );
        $theme_css .= $bg_color != ''? 'body{background-color:'. realistic_sanitize_color( $bg_color ) .';}': '';

        // Background settings
        $bg_settings = get_theme_mod( 'background_settings', REALISTIC_BG_SETTINGS );

        if ( 'pattern' == $bg_settings ) {

            $pattern = get_theme_mod( 'background_pattern', REALISTIC_BG_PATTERN );
            if ( $pattern != '' ) {
                $theme_css .= 'body{background:url('. esc_url( $pattern ) .') repeat top left;}';
            }

        } else if ( 'custom_image' == $bg_settings ) {

            // BG image
            $bg_image = get_theme_mod( 'realistic_bg_image_url', '' );
            if ( $bg_image != '' ) {
                $theme_css .= 'body{background-image:url('. esc_url( $bg_image ) .');}';
            }

            // BG repeat
            $bg_repeat = get_theme_mod( 'realistic_bg_repeat', REALISTIC_BG_REPEAT );
            if ( $bg_repeat != '' ) {
                $theme_css .= 'body{background-repeat:'. esc_attr( $bg_repeat ) .';}';
            }

            // BG size
            $bg_size = get_theme_mod( 'realistic_bg_size', REALISTIC_BG_SIZE );
            if ( $bg_size != '' ) {
                $theme_css .= 'body{background-size:'. esc_attr( $bg_size ) .';}';
            }

            // BG attachment
            $bg_attach = get_theme_mod( 'realistic_bg_attach', REALISTIC_BG_ATTACHMENT );
            if ( $bg_attach != '' ) {
                $theme_css .= 'body{background-attachment:'. esc_attr( $bg_attach ) .';}';
            }

            // BG position
            $bg_pos = get_theme_mod( 'realistic_bg_position', REALISTIC_BG_POSITION );
            if ( $bg_pos != '' ) {
                $theme_css .= 'body{background-position:'. esc_attr( $bg_pos ) .';}';
            }
        }

        $output = '';
		$output .= $theme_css; ?>

		<style type="text/css">
            <?php echo $output ?>
		</style>
    <?php }
}
add_action( 'wp_head', 'realistic_dynamic_css' );