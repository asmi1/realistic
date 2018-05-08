<?php
/**
 * Realistic functions and definitions
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*-----------------------------------------------------------------------------------*/
/*  Theme dependencies & libs
/*-----------------------------------------------------------------------------------*/
require_once ( get_template_directory() . '/inc/defaults.php' );
require_once ( get_template_directory() . '/inc/common.php' );
require_once ( get_template_directory() . '/inc/widgets.php' );
require_once ( get_template_directory() . '/inc/custom-menus.php' );
require_once ( get_template_directory() . '/inc/customizer.php' );
require_once ( get_template_directory() . '/inc/jetpack.php' );

/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers support for various WordPress features.
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'realistic_setup' ) ) {
	function realistic_setup() {

		// Make theme available for translation.
		load_theme_textdomain( REALISTIC_THEME_NAME, get_template_directory() . '/languages' );
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		
		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'realistic' ),
			'mobile-menu' => esc_html__( 'Mobile Menu', 'realistic' )
		) );
		
		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );
		
		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array(
			'video',
			'audio',
		) );

		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'rc_big', 850, 380, true ); 		//big image
		add_image_size( 'featured', 218, 181, true ); 			//featured image
		add_image_size( 'rc_related', 400, 250, true ); 	//related thumb
		add_image_size( 'small', 120, 120, true ); 				//small thumb
		add_image_size( 'tiny', 70, 70, true ); 				//tiny thumb

		// Add support for Jetpack's infinite scroll
		add_theme_support( 'infinite-scroll', array(
			'type'           => 'scroll',
			'footer_widgets' => false,
			'container'      => 'content',
			'wrapper'        => true,
			'render'         => false,
			'posts_per_page' => false
		) );
	}
}
add_action( 'after_setup_theme', 'realistic_setup' );

/*-----------------------------------------------------------------------------------*/
/*  Set the content width based on the theme's design and stylesheet.
/*-----------------------------------------------------------------------------------*/
if ( !isset( $content_width ) ) {
	$content_width = REALISTIC_CONTENT_WIDTH; /* pixels */
}

/*-----------------------------------------------------------------------------------*/
/*  Register Sidebar & Widget-areas 
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'realistic_sidebars_init' ) ) {
	function realistic_sidebars_init() {

		register_sidebar( array(
			'name'          => esc_html__( 'Main Sidebar', 'realistic' ),
			'id'            => 'sidebar',
			'description'   => 'Main Sidebar widget area.',
			'before_widget' => '<aside id="%1$s" class="widget sidebar-widget mdl-card mdl-shadow--2dp mdl-grid mdl-cell mdl-cell--12-col %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget-title"><h3><div class="thin-bar"></div>',
			'after_title'   => '</h3></div>',
		) );
	}
}
add_action( 'widgets_init', 'realistic_sidebars_init' );

/*-----------------------------------------------------------------------------------*/
/*  Enqueue scripts and styles.
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'realistic_scripts' ) ) {
	function realistic_scripts() {
			
		// Loading jQuery
		wp_enqueue_script( 'jquery' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Loading Google's font "Roboto"
	    wp_enqueue_style( 'gfonts', 'https://fonts.googleapis.com/css?family=Roboto:400italic,300,700,400', false, null, 'all' );
		
		// Loading MDL JS
		wp_enqueue_script( 'material', get_template_directory_uri() . '/js/material.min.js' );
		
		// Loading MDL CSS ( based on selected Color Scheme )
		$theme_color = get_theme_mod( 'theme_color', 'indigo-pink' );
		if ( $theme_color == 'indigo-pink' ) {
			wp_enqueue_style('materialcss', get_template_directory_uri().'/css/material.indigo-pink.min.css');
		} elseif ( $theme_color == 'blue-indigo' ) {
			wp_enqueue_style('materialcss', get_template_directory_uri().'/css/material.blue-indigo.min.css');
		} elseif ( $theme_color == 'bluegrey-teal' ) {
			wp_enqueue_style('materialcss', get_template_directory_uri().'/css/material.bluegrey-teal.min.css');
		} elseif ( $theme_color == 'red-deeporange' ) {
			wp_enqueue_style('materialcss', get_template_directory_uri().'/css/material.red-deeporange.min.css');
		} elseif ( $theme_color == 'purple-blue' ) {
			wp_enqueue_style('materialcss', get_template_directory_uri().'/css/material.purple-blue.min.css');
		} elseif ( $theme_color == 'green-lightgreen' ) {
			wp_enqueue_style('materialcss', get_template_directory_uri().'/css/material.green-lightgreen.min.css');
		}

		// Fontello
		wp_enqueue_style( 'fontello', get_template_directory_uri().'/css/fontello.css' );

		// Loading Material icons
	    wp_enqueue_style( 'materialicons', 'https://fonts.googleapis.com/icon?family=Material+Icons', false, null, 'all' );

		// Theme Scripts
		wp_enqueue_script( 'realistic-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), REALISTIC_THEME_VERSION, true );

		// Theme Stylesheet
		wp_enqueue_style( 'realistic-stylesheet', get_stylesheet_uri(), null, REALISTIC_THEME_VERSION );

	}
}
add_action( 'wp_enqueue_scripts', 'realistic_scripts' );

/*-----------------------------------------------------------------------------------*/
/*  Admin Scripts
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'realistic_admin_scripts' ) ) {
    function realistic_admin_scripts() {

        // Load Admin scripts & styles
        wp_enqueue_style( 'realistic-admin-stylesheet', get_template_directory_uri() . '/css/admin.css', null, REALISTIC_THEME_VERSION );
        wp_enqueue_script( 'realistic-admin-scripts', get_template_directory_uri() . '/js/admin.js', array( 'jquery' ), REALISTIC_THEME_VERSION, true );
    }
}
add_action( 'admin_enqueue_scripts', 'realistic_admin_scripts', 20 );

/*-----------------------------------------------------------------------------------*/
/*  Actions & Filters
/*-----------------------------------------------------------------------------------*/

// Remove [...] & shortcodes from excerpt
add_filter( 'get_the_excerpt', 'realistic_custom_excerpt' );
remove_filter( 'the_excerpt', 'wpautop' );
if ( !function_exists( 'realistic_custom_excerpt' ) ) {
	function realistic_custom_excerpt( $output ) {
		return preg_replace( '/\[[^\]]*]/', '', $output );
	}
}

// Set max excerpt length to 400
add_filter( 'excerpt_length', 'realistic_custom_excerpt_length', 999 );
if ( !function_exists( 'realistic_custom_excerpt_length' ) ) {
	function realistic_custom_excerpt_length( $length ){
	    return 400;
	}
}

// Custom previous_post_link && next_post_link link class
add_filter( 'next_post_link', 'realistic_next_prev_link_attributes' );
add_filter( 'previous_post_link', 'realistic_next_prev_link_attributes' );
if ( !function_exists( 'realistic_next_prev_link_attributes' ) ) {
	function realistic_next_prev_link_attributes( $output ) {
		$code = 'class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"';
    	return str_replace( '<a href=', '<a '.$code.' href=', $output );
	}
}

/*-----------------------------------------------------------------------------------*/
/*  Custom Comments template
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'realistic_custom_comments' ) ) {
	function realistic_custom_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		    <div id="comment-<?php comment_ID(); ?>" class="comment-box mdl-shadow--2dp">

		        <div class="comment-author vcard clearfix">
		            <?php echo get_avatar( $comment->comment_author_email, 80 ); ?>
					<?php global $post;

					if( $comment->user_id === $post->post_author ) {
						printf( '<span class="fn">%s</span><span class="commenter_is_author">%s</span>', get_comment_author_link(), esc_html__( 'Author', 'realistic' ) );
					} else {
						printf( '<span class="fn">%s</span>', get_comment_author_link() );
					} ?> 
		            
					<span class="ago"><?php comment_date(get_option( 'date_format' ) ); ?></span>
		            
		            <span class="comment-meta">
		                <?php edit_comment_link( esc_html__( '(Edit)', 'realistic' ),'  ','' ); ?>
		                <?php $args['reply_text'] = '<i class="fa fa-mail-forward"></i> '. esc_html__( 'Reply', 'realistic' );
						comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</span>
				</div>

		        <?php if ($comment->comment_approved == '0') { ?>
					<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'realistic' ); ?></em>
					<br />
		        <?php } ?>

		        <div class="commentmetadata">
		            <?php comment_text() ?>
				</div>
			</div>
		</li>
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/*  That's All, Bye :)
/*-----------------------------------------------------------------------------------*/	