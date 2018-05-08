<?php
/**
 * Theme Common functions
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Time ago format function
if ( !function_exists( 'realistic_time_ago' ) ) {
	function realistic_time_ago( $date ) {

		// Array of time period chunks
		$chunks = array(
			array( 60 * 60 * 24 * 365 , esc_html__( 'year', 'realistic' ), esc_html__( 'years', 'realistic' ) ),
			array( 60 * 60 * 24 * 30 , esc_html__( 'month', 'realistic' ), esc_html__( 'months', 'realistic' ) ),
			array( 60 * 60 * 24 * 7, esc_html__( 'week', 'realistic' ), esc_html__( 'weeks', 'realistic' ) ),
			array( 60 * 60 * 24 , esc_html__( 'day', 'realistic' ), esc_html__( 'days', 'realistic' ) ),
			array( 60 * 60 , esc_html__( 'hour', 'realistic' ), esc_html__( 'hours', 'realistic' ) ),
			array( 60 , esc_html__( 'minute', 'realistic' ), esc_html__( 'minutes', 'realistic' ) ),
			array( 1, esc_html__( 'second', 'realistic' ), esc_html__( 'seconds', 'realistic' ) )
		);
	 
		if ( !is_numeric( $date ) ) {
			$time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
			$date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
			$date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
		}
	 
		$current_time = current_time( 'mysql', $gmt = 0 );
		$newer_date = strtotime( $current_time );
	 
		// Difference in seconds
		$since = $newer_date - $date;
	 
		// Something went wrong with date calculation and we ended up with a negative date.
		if ( 0 > $since )
			return esc_html__( 'sometime', 'realistic' );

		//Step one: the first chunk
		for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
			$seconds = $chunks[$i][0];
	 
			// Finding the biggest chunk (if the chunk fits, break)
			if ( ( $count = floor($since / $seconds) ) != 0 )
				break;
		}
	 
		// Set output var
		$output = ( 1 == $count ) ? '1 '. $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
	 
	 
		if ( !(int)trim($output) ){
			$output = '0 ' . esc_html__( 'seconds', 'realistic' );
		}
	 
		$output .= esc_html__( ' ago', 'realistic' );
	    return $output;
	}
}

// Display HTML with meta information for the current post-date/time.
if ( !function_exists( 'realistic_posted' ) ) {
    function realistic_posted() {

    	global $post;

		$format = get_theme_mod( 'date_format', 'ago' );

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {

			$pattern = '<time class="entry-date published" datetime="%1$s" style="display:none;">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';

			// Readable dates
			$date = $format == 'ago'? realistic_time_ago( get_post_time( 'G', true, $post ) ): esc_html( get_the_date() );
			$modified_date = $format == 'ago'? realistic_time_ago( get_post_modified_time( 'G', true, $post ) ): esc_html( get_the_modified_date() );

			$date_string = sprintf( $pattern,
				esc_attr( get_the_date( 'c' ) ),
				$date,
				esc_attr( get_the_modified_date( 'c' ) ),
				$modified_date
			);

		} else {

			$pattern = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			// Readable date
			$date = $format == 'ago'? realistic_time_ago( get_post_time( 'G', true, $post ) ): esc_html( get_the_date() );

			$date_string = sprintf( $pattern,
				esc_attr( get_the_date( 'c' ) ),
				$date
			);
		}

		$posted = sprintf(
			_x( '%s', 'post date', 'realistic' ),
			$date_string 
		);

		echo $posted;
	}
}

// Display HTML with meta information for Author.
if ( !function_exists( 'realistic_entry_author' ) ) {
	function realistic_entry_author() {

	    if ( 'post' == get_post_type() ) {

			$byline = sprintf(
				_x( '%s', 'post author', 'realistic' ),
				'<span class="author vcard"><span class="url fn"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>'
			);
			echo $byline;
	    }
	}
}

// Display HTML with meta information for Category.
if ( !function_exists( 'realistic_entry_category' ) ) {
    function realistic_entry_category() {

        $categories = get_the_category();
        if ( !empty( $categories ) ) {
			echo '<a href="'. get_category_link( $categories[0]->term_id ) .'">'. $categories[0]->name .'</a>';
        }
    }
}

// Display HTML with meta information for Tags.
if ( ! function_exists( 'realistic_entry_tags' ) ) {
	function realistic_entry_tags() {

	    if ( 'post' == get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'realistic' ) );
			if ( $tags_list ) {
				printf( '<span class="thetags"><i class="material-icons">label</i>'. esc_html__( '%1$s', 'realistic' ) .'</span>', $tags_list );
			}
	    }
	}
}

// Display HTML with meta information for Comments number.
if ( !function_exists( 'realistic_entry_comments' ) ) {
	function realistic_entry_comments() {

		if ( 'post' == get_post_type() ) {
			$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

			if ( comments_open() ) {
				$write_comments =  $num_comments;
			} else {
				$write_comments =  0;
			}

			echo $write_comments;
		}
	}
}

// Display Thumbnail/Featured image
if ( !function_exists( 'realistic_get_thumbnail' ) ) {
	function realistic_get_thumbnail( $post_id, $size = 'featured' ) {

        if ( has_post_thumbnail( $post_id ) ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
            $image = $image[0];

        } else {
            $image = get_template_directory_uri() . '/images/nothumb-'. $size .'.jpg';
        }

        return esc_url( $image );
	}
}

// Get first Video from Video Posts
if ( !function_exists( 'realistic_get_first_embed_video' ) ) {
	function realistic_get_first_embed_video( $post_id ) {

		$post = get_post( $post_id );
		$content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
		$embeds = get_media_embedded_in_content( $content );

		if ( empty( $embeds ) ) {
			return '';
		}

		//check what is the first embed containg video tag, youtube or vimeo
		foreach( $embeds as $embed ) {
			if ( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) || strpos( $embed, 'vimeo' ) || strpos( $embed, 'dailymotion' ) || strpos( $embed, 'vine' ) || strpos( $embed, 'wordPress.tv' ) || strpos( $embed, 'hulu' ) ) {
				return $embed;
			}
		}
	}
}

// Get First Embeded Audio
if ( !function_exists( 'realistic_get_first_embed_audio' ) ) {
    function realistic_get_first_embed_audio( $post_id ) {

        $post = get_post( $post_id );
        $content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
        $embeds = get_media_embedded_in_content( $content );

		if ( empty( $embeds ) ) {
			return '';
		}

        //check what is the first embed containg audio tag
        foreach( $embeds as $embed ) {
            if ( strpos( $embed, 'audio' ) || strpos( $embed, 'mixcloud' ) || strpos( $embed, 'rdio' ) || strpos( $embed, 'soundcloud' ) || strpos( $embed, 'spotify' ) ) {
                return $embed;
            }
        }
    }
}

// Display post format icon
if ( !function_exists( 'realistic_post_format_icon' ) ) {
	function realistic_post_format_icon( $format = 'format' ) {
		if ( $format == 'video' ) {

			$icon = '<i class="material-icons">play_circle_filled</i>';
		} else if ( $format == 'audio' ) {

			$icon = '<i class="material-icons">audiotrack</i>';			
		} else {

			$icon = '<i class="material-icons">description</i>';
		}
		echo '<div class="post-format">'. $icon .'</div>';
	}
}
	
// Display breadcrumb
if ( !function_exists( 'realistic_breadcrumb' ) ) {
	function realistic_breadcrumb() {

		// Separator, change this if you want to change breadcrumb items separator
		$sep = esc_html__( '/', 'realistic' ); ?>

		<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">

			<div typeof="v:Breadcrumb" class="root">
				<a rel="v:url" property="v:title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php esc_html_e( 'Home', 'realistic' ); ?>
				</a>
			</div>

			<div><?php echo $sep; ?></div>

			<?php if ( is_category() || is_single() ) { ?>

				<?php $categories = get_the_category();
				if ( $categories ) { ?>

					<div typeof="v:Breadcrumb">
						<a href="<?php echo get_category_link( $categories[0]->term_id ); ?>" rel="v:url" property="v:title">
							<?php echo $categories[0]->cat_name; ?>
						</a>
					</div>
					<div><?php echo $sep; ?></div>

				<?php } ?>

				<?php if ( is_single() ) { ?>
					<div typeof='v:Breadcrumb'>
						<span property='v:title'><?php the_title(); ?></span>
					</div>
				<?php } ?>

			<?php } else if ( is_page() ) { ?>

				<div typeof='v:Breadcrumb'><span property='v:title'>
					<?php the_title(); ?>
				</span></div>

			<?php } ?>

		</div>
	<?php }
}

// Truncate string to x letters/words
if ( !function_exists( 'realistic_truncate_string' ) ) {
    function realistic_truncate_string( $str, $length = 40, $units = 'letters', $ellipsis = '&nbsp;&hellip;' ) {

        if ( $units == 'letters' ) {

            if ( mb_strlen( $str ) > $length ) {
                return mb_substr( $str, 0, $length ) . $ellipsis;
            } else {
                return $str;
            }

        } else {

            $words = explode( ' ', $str );

            if ( count( $words ) > $length ) {
                return implode( " ", array_slice( $words, 0, $length ) ) . $ellipsis;
            } else {
                return $str;
            }
        }
    }
}