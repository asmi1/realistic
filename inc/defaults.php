<?php
/**
 * Theme defaults: colors, settings, etc.
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'REALISTIC_THEME_NAME', 'realistic' );
define( 'REALISTIC_THEME_VERSION', '1.3.0' );
define( 'REALISTIC_THEME_DEMO_URL', 'http://realistic.themient.com' );
define( 'REALISTIC_CONTENT_WIDTH', 640 ); // in pixels

// General
define( 'REALISTIC_DATE_FORMAT', 'ago' );

// Header
define( 'REALISTIC_LOGO', '' );

// Footer
define( 'REALISTIC_FOOTER_TEXT', wp_kses_post( __( 'Proudly powered by <a href="http://wordpress.org/" rel="generator">WordPress</a>', 'realistic' ) ) );
define( 'REALISTIC_AUTHOR', wp_kses_post( __( 'Designed by <a href="http://themient.com">Themient</a>', 'realistic' ) ) );

// Archives
define( 'REALISTIC_ARCHIVES_META', 1 );
define( 'REALISTIC_EXCERPT_LENGTH', 30 );

// Articles
define( 'REALISTIC_BREADCRUMBS', 1 );
define( 'REALISTIC_POST_META', 1 );
define( 'REALISTIC_POST_RELATED', 1 );
define( 'REALISTIC_POST_RELATED_NUMBER', 4 );
define( 'REALISTIC_POST_RELATED_QUERY', 'tags' );
define( 'REALISTIC_NEXT_PREV', 1 );
define( 'REALISTIC_AUTHOR_BOX', 1 );

// Design
define( 'REALISTIC_DISPLAY', 'default' );
define( 'REALISTIC_SIDEBAR_LAYOUT', 'right_sidebar' );
define( 'REALISTIC_COLOR_SCHEME', 'indigo-pink' );
define( 'REALISTIC_BG_SETTINGS', 'none' );
define( 'REALISTIC_BG_PATTERN', '' );
define( 'REALISTIC_BG_COLOR', '#f7f7f7' );
define( 'REALISTIC_BG_REPEAT', 'no-repeat' );
define( 'REALISTIC_BG_SIZE', 'cover' );
define( 'REALISTIC_BG_ATTACHMENT', 'scroll' );
define( 'REALISTIC_BG_POSITION', 'center center' );

if ( !function_exists( 'realistic_social_profiles_array' ) ) {
    function realistic_social_profiles_array() {

        $services = array(
            'facebook' => array(
                'label'   => esc_html__( 'Facebook', 'realistic' ),
                'pattern' => '<li class="social-facebook"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-facebook"></i></a></li>',
            ),
            'twitter' => array(
                'label'   => esc_html__( 'Twitter', 'realistic' ),
                'pattern' => '<li class="social-twitter"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-twitter"></i></a></li>',
            ),
            'google_plus' => array(
                'label'   => esc_html__( 'Google+', 'realistic' ),
                'pattern' => '<li class="social-gplus"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-gplus"></i></a></li>',
            ),
            'youtube' => array(
                'label'   => esc_html__( 'YouTube', 'realistic' ),
                'pattern' => '<li class="social-youtube"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-youtube"></i></a></li>',
            ),          
            'pinterest' => array(
                'label'   => esc_html__( 'Pinterest', 'realistic' ),
                'pattern' => '<li class="social-pinterest"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-pinterest"></i></a></li>',
            ),      
            'linkedin' => array(
                'label'   => esc_html__( 'LinkedIn', 'realistic' ),
                'pattern' => '<li class="social-linkedin"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-linkedin"></i></a></li>',
            ),
            'rss' => array(
                'label'   => esc_html__( 'RSS', 'realistic' ),
                'pattern' => '<li class="social-rss"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-rss"></i></a></li>',
            ),
            'email' => array(
                'label'   => esc_html__( 'Email', 'realistic' ),
                'pattern' => '<li class="social-email"><a title="%s" href="%s" %s><i class="icon-envelope-open"></i></a></li>',
            ),
            'stumbleupon' => array(
                'label'   => esc_html__( 'StumbleUpon', 'realistic' ),
                'pattern' => '<li class="social-stumbleupon"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-stumbleupon"></i></a></li>',
            ),
            'reddit' => array(
                'label'   => esc_html__( 'Reddit', 'realistic' ),
                'pattern' => '<li class="social-reddit"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-reddit-alien"></i></a></li>',
            ),
            'instagram' => array(
                'label'   => esc_html__( 'Instagram', 'realistic' ),
                'pattern' => '<li class="social-instagram"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-instagram"></i></a></li>',
            ),
            'soundcloud' => array(
                'label'   => esc_html__( 'Soundcloud', 'realistic' ),
                'pattern' => '<li class="social-soundcloud"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-soundcloud"></i></a></li>',
            ),
            'github' => array(
                'label'   => esc_html__( 'GitHub', 'realistic' ),
                'pattern' => '<li class="social-github"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-github"></i></a></li>',
            ),
            'skype' => array(
                'label'   => esc_html__( 'Skype', 'realistic' ),
                'pattern' => '<li class="social-skype"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-skype"></i></a></li>',
            ),
            'amazon' => array(
                'label'   => esc_html__( 'Amazon', 'realistic' ),
                'pattern' => '<li class="social-amazon"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-amazon"></i></a></li>',
            ),
            'vimeo' => array(
                'label'   => esc_html__( 'Vimeo', 'realistic' ),
                'pattern' => '<li class="social-vimeo"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-vimeo"></i></a></li>',
            ),  
            'behance' => array(
                'label'   => esc_html__( 'Behance', 'realistic' ),
                'pattern' => '<li class="social-behance"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-behance"></i></a></li>',
            ),
            'vk' => array(
                'label'   => esc_html__( 'Vk', 'realistic' ),
                'pattern' => '<li class="social-vk"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-vkontakte"></i></a></li>',
            ),
            'paypal' => array(
                'label'   => esc_html__( 'PayPal', 'realistic' ),
                'pattern' => '<li class="social-paypal"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-paypal"></i></a></li>',
            ),
            'steam' => array(
                'label'   => esc_html__( 'Steam', 'realistic' ),
                'pattern' => '<li class="social-steam"><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="%s" href="%s" %s><i class="icon-steam"></i></a></li>',
            ),
        );

        return apply_filters( 'realistic_social_profiles', $services );
    }
}