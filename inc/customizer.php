<?php
/**
 * Theme Customizer
 *
 * @package realistic
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*-----------------------------------------------------------------------------------*/
/* Require Classes & Functions
/*-----------------------------------------------------------------------------------*/
require_once( get_template_directory() . '/inc/customizer/customizer-render.php' );
require_once( get_template_directory() . '/inc/customizer/customizer-output.php' );
require_once( get_template_directory() . '/inc/customizer/customizer-sanitize.php' );
require_once( get_template_directory() . '/inc/customizer/customizer-controls.php' );

/*-----------------------------------------------------------------------------------*/
/*  Registering the Customizer Settings
/*-----------------------------------------------------------------------------------*/
function realistic_options_theme_customizer_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// General
	realistic_customizer_render_section( 'general', esc_html__( 'General', 'realistic' ), '', 10 );

		// Date format
        realistic_customizer_render_radio_button( 'date_format', 'general', esc_html__( 'Date Format', 'realistic' ), array(
            'default' => esc_html__( 'Site Default', 'realistic' ),
            'ago' => esc_html__( 'Time Ago', 'realistic' ),
        ), 1, REALISTIC_DATE_FORMAT, '' );

	// Header
	realistic_customizer_render_section( 'header', esc_html__( 'Header', 'realistic' ), '', 20 );

		// Logo
		realistic_customizer_render_uploader( 'logo_image', 'header', esc_html__( 'Logo Image', 'realistic' ), 1, REALISTIC_LOGO, '' );


	// Footer
	realistic_customizer_render_section( 'footer', esc_html__( 'Footer', 'realistic' ), '', 30 );

		// Footer Text
		realistic_customizer_render_textarea( 'footer_left', 'footer', esc_html__( 'Footer Text', 'realistic' ), 1, REALISTIC_FOOTER_TEXT, htmlspecialchars( 'Allowed tags; <a>, <br>, <em>, <strong>, <i> and <img>. You can add shortcodes too.' ), 'realistic_sanitize_text' );


	// Archives
	realistic_customizer_render_section( 'archives', esc_html__( 'Archives', 'realistic' ), '', 40 );

		// Meta Info
		realistic_customizer_render_switcher( 'archives_post_meta', 'archives', esc_html__( 'Post Meta', 'realistic' ), 1, REALISTIC_ARCHIVES_META, '' );

		// Excerpt Length
		realistic_customizer_render_number( 'excerpt_length', 'archives', esc_html__( 'Excerpt Length', 'realistic' ), 2, REALISTIC_EXCERPT_LENGTH, 0, 400, esc_html__( 'Excerpt length (in Words) for Homepage & archive pages. Min is 0, max is 500. Set to 0 to disable.', 'realistic' ), 'realistic_sanitize_posint' );


	// Articles
	realistic_customizer_render_section( 'articles', esc_html__( 'Articles', 'realistic' ), '', 50 );

		// Breadcrumbs
		realistic_customizer_render_switcher( 'post_breadcrumb', 'articles', esc_html__( 'Breadcrumbs', 'realistic' ), 1, REALISTIC_BREADCRUMBS, '' );

		// Post Meta
		realistic_customizer_render_switcher( 'post_meta', 'articles', esc_html__( 'Post Meta', 'realistic' ), 2, REALISTIC_POST_META, '' );
		
		// Related Posts
		realistic_customizer_render_switcher( 'related_posts', 'articles', esc_html__( 'Related Posts', 'realistic' ), 3, REALISTIC_POST_RELATED, '' );
		
		// Related Posts Number
		realistic_customizer_render_number( 'related_posts_number', 'articles', esc_html__( 'Related Posts Number', 'realistic' ), 4, REALISTIC_POST_RELATED_NUMBER, 1, 6, '', 'realistic_sanitize_posint' );

        // Related Posts Query
        realistic_customizer_render_radio_button( 'related_posts_query', 'articles', esc_html__( 'Related Posts Query', 'realistic' ), array(
            'tags' => esc_html__( 'Tags', 'realistic' ),
            'categories' => esc_html__( 'Categories', 'realistic' ),
        ), 5, REALISTIC_POST_RELATED_QUERY, '' );
		
		// Next/Previous Links
		realistic_customizer_render_switcher( 'next_prev_post', 'articles', esc_html__( 'Next/Previous Links', 'realistic' ), 6, REALISTIC_NEXT_PREV, '' );
		
		// Author Box
		realistic_customizer_render_switcher( 'author_box', 'articles', esc_html__( 'Author Box', 'realistic' ), 7, REALISTIC_AUTHOR_BOX, '' );


	// Design
	realistic_customizer_render_section( 'design', esc_html__( 'Design', 'realistic' ), '', 60 );

		// Display
		realistic_customizer_render_radio_image( 'realistic_display', 'design', esc_html__( 'Display', 'realistic' ), array(
            'default' => get_template_directory_uri() .'/images/customizer/display_default.png',
            'style1' => get_template_directory_uri() .'/images/customizer/display_style1.png',
        ), 1, REALISTIC_DISPLAY, '' );

		// Sidebar Settings
		realistic_customizer_render_radio_image( 'sidebar_settings', 'design', esc_html__( 'Sidebar Settings', 'realistic' ), array(
            'right_sidebar' => get_template_directory_uri() .'/images/customizer/sidebar_right.png',
            'left_sidebar' => get_template_directory_uri() .'/images/customizer/sidebar_left.png',
            'no_sidebar' => get_template_directory_uri() .'/images/customizer/sidebar_no.png',
        ), 2, REALISTIC_SIDEBAR_LAYOUT, '' );

		// color scheme
		realistic_customizer_render_radio_image( 'theme_color', 'design', esc_html__( 'Color Scheme', 'realistic' ), array(
			'indigo-pink' => get_template_directory_uri() .'/images/customizer/indigo-pink.png',
			'blue-indigo' => get_template_directory_uri() .'/images/customizer/blue-indigo.png',
			'bluegrey-teal' => get_template_directory_uri() .'/images/customizer/bluegrey-teal.png',
			'red-deeporange' => get_template_directory_uri() .'/images/customizer/red-deeporange.png',
			'purple-blue' => get_template_directory_uri() .'/images/customizer/purple-blue.png',
			'green-lightgreen' => get_template_directory_uri() .'/images/customizer/green-lightgreen.png',
        ), 2, REALISTIC_COLOR_SCHEME, '' );

        // Background Color
        realistic_customizer_render_color( 'bg_color', 'design', esc_html__( 'Background Color', 'realistic' ), 3, REALISTIC_BG_COLOR, '' );

        realistic_customizer_render_radio_button( 'background_settings', 'design', esc_html__( 'Background Image', 'realistic' ), array(
			'none' => esc_html__( 'None', 'realistic' ),
			'pattern' => esc_html__( 'Pattern', 'realistic' ),					
			'custom_image' => esc_html__( 'Custom Image', 'realistic' ),
        ), 4, REALISTIC_BG_SETTINGS, '' );

		// Background Pattern
		realistic_customizer_render_radio_image( 'background_pattern', 'design', esc_html__( 'Background Pattern', 'realistic' ), array(
			get_template_directory_uri() .'/images/patterns/21.gif' => get_template_directory_uri() .'/images/patterns/21.gif',
			get_template_directory_uri() .'/images/patterns/22.gif' => get_template_directory_uri() .'/images/patterns/22.gif',
			get_template_directory_uri() .'/images/patterns/23.gif' => get_template_directory_uri() .'/images/patterns/23.gif',
			get_template_directory_uri() .'/images/patterns/24.gif' => get_template_directory_uri() .'/images/patterns/24.gif',
			get_template_directory_uri() .'/images/patterns/25.gif' => get_template_directory_uri() .'/images/patterns/25.gif',
			get_template_directory_uri() .'/images/patterns/26.gif' => get_template_directory_uri() .'/images/patterns/26.gif',
			get_template_directory_uri() .'/images/patterns/27.gif' => get_template_directory_uri() .'/images/patterns/27.gif',
			get_template_directory_uri() .'/images/patterns/28.gif' => get_template_directory_uri() .'/images/patterns/28.gif',
			get_template_directory_uri() .'/images/patterns/29.gif' => get_template_directory_uri() .'/images/patterns/29.gif',
			get_template_directory_uri() .'/images/patterns/30.gif' => get_template_directory_uri() .'/images/patterns/30.gif',
			get_template_directory_uri() .'/images/patterns/31.gif' => get_template_directory_uri() .'/images/patterns/31.gif',
			get_template_directory_uri() .'/images/patterns/32.gif' => get_template_directory_uri() .'/images/patterns/32.gif',
			get_template_directory_uri() .'/images/patterns/33.gif' => get_template_directory_uri() .'/images/patterns/33.gif',
			get_template_directory_uri() .'/images/patterns/34.gif' => get_template_directory_uri() .'/images/patterns/34.gif',
			get_template_directory_uri() .'/images/patterns/35.gif' => get_template_directory_uri() .'/images/patterns/35.gif',
			get_template_directory_uri() .'/images/patterns/36.gif' => get_template_directory_uri() .'/images/patterns/36.gif',
			get_template_directory_uri() .'/images/patterns/37.gif' => get_template_directory_uri() .'/images/patterns/37.gif',
			get_template_directory_uri() .'/images/patterns/38.gif' => get_template_directory_uri() .'/images/patterns/38.gif',
			get_template_directory_uri() .'/images/patterns/39.gif' => get_template_directory_uri() .'/images/patterns/39.gif',
			get_template_directory_uri() .'/images/patterns/40.gif' => get_template_directory_uri() .'/images/patterns/40.gif',
			get_template_directory_uri() .'/images/patterns/1.jpg' => get_template_directory_uri() .'/images/patterns/1.jpg',
			get_template_directory_uri() .'/images/patterns/2.jpg' => get_template_directory_uri() .'/images/patterns/2.jpg',
			get_template_directory_uri() .'/images/patterns/3.jpg' => get_template_directory_uri() .'/images/patterns/3.jpg',
			get_template_directory_uri() .'/images/patterns/4.jpg' => get_template_directory_uri() .'/images/patterns/4.jpg',
			get_template_directory_uri() .'/images/patterns/5.jpg' => get_template_directory_uri() .'/images/patterns/5.jpg',			
			get_template_directory_uri() .'/images/patterns/6.jpg' => get_template_directory_uri() .'/images/patterns/6.jpg',
			get_template_directory_uri() .'/images/patterns/7.jpg' => get_template_directory_uri() .'/images/patterns/7.jpg',
			get_template_directory_uri() .'/images/patterns/8.jpg' => get_template_directory_uri() .'/images/patterns/8.jpg',
			get_template_directory_uri() .'/images/patterns/9.jpg' => get_template_directory_uri() .'/images/patterns/9.jpg',
			get_template_directory_uri() .'/images/patterns/10.jpg' => get_template_directory_uri() .'/images/patterns/10.jpg',
			get_template_directory_uri() .'/images/patterns/11.jpg' => get_template_directory_uri() .'/images/patterns/11.jpg',
			get_template_directory_uri() .'/images/patterns/12.jpg' => get_template_directory_uri() .'/images/patterns/12.jpg',
			get_template_directory_uri() .'/images/patterns/13.jpg' => get_template_directory_uri() .'/images/patterns/13.jpg',
			get_template_directory_uri() .'/images/patterns/14.jpg' => get_template_directory_uri() .'/images/patterns/14.jpg',
			get_template_directory_uri() .'/images/patterns/15.jpg' => get_template_directory_uri() .'/images/patterns/15.jpg',			
			get_template_directory_uri() .'/images/patterns/16.jpg' => get_template_directory_uri() .'/images/patterns/16.jpg',
			get_template_directory_uri() .'/images/patterns/17.jpg' => get_template_directory_uri() .'/images/patterns/17.jpg',
			get_template_directory_uri() .'/images/patterns/18.jpg' => get_template_directory_uri() .'/images/patterns/18.jpg',
			get_template_directory_uri() .'/images/patterns/19.jpg' => get_template_directory_uri() .'/images/patterns/19.jpg',
			get_template_directory_uri() .'/images/patterns/20.jpg' => get_template_directory_uri() .'/images/patterns/20.jpg',
        ), 5, REALISTIC_BG_PATTERN, '' );

        // Background Image
        realistic_customizer_render_background( 'realistic_bg', 'design', esc_html__( 'Background Image', 'realistic' ), 6, array(
            'repeat' => REALISTIC_BG_REPEAT,
            'size' => REALISTIC_BG_SIZE, 
            'position' => REALISTIC_BG_ATTACHMENT,
            'attach' => REALISTIC_BG_POSITION 
        ), '' );

	// Social
	realistic_customizer_render_section( 'social', esc_html__( 'Social', 'realistic' ), '', 70 );

		$profiles = realistic_social_profiles_array();
		$i = 1;

		foreach ( $profiles as $key => $data ) {

			// URL
			realistic_customizer_render_textfield( 'social_'. $key, 'social', $data['label'], $i, '', '', 'realistic_sanitize_social_url' );

			$i++;
		}
}
add_action( 'customize_register', 'realistic_options_theme_customizer_register' );

/*-----------------------------------------------------------------------------------*/
/*  Customizer Styles & Scripts
/*-----------------------------------------------------------------------------------*/

// Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
function realistic_options_theme_customizer_preview_js() {
	wp_enqueue_script( 'realistic-options-theme-customizer', get_template_directory_uri() .'/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'realistic_options_theme_customizer_preview_js' );