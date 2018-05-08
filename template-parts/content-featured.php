<?php
/**
 * Template part for displaying post featured image.
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php if ( 'video' == get_post_format() ) { ?>

    <div class="post-featured video">
        <div class="video-wrapper">
           <?php echo realistic_get_first_embed_video( get_the_ID() ); ?>
        </div>
    </div>

<?php } else if ( 'audio' == get_post_format() ) { ?>

    <div class="post-featured audio">
        <div class="audio-wrapper">
           <?php echo realistic_get_first_embed_audio( get_the_ID() ); ?>
        </div>
    </div>

<?php } else { ?>

    <?php if ( 'default' == esc_attr( get_theme_mod( 'realistic_display', REALISTIC_DISPLAY ) ) ) {
        $size = 'rc_big';
    } else {
        $size = 'featured';
    } ?>

	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<img src="<?php echo realistic_get_thumbnail( get_the_ID(), $size ); ?>" class="attachment-featured wp-post-image" alt="<?php the_title_attribute(); ?>">
		<?php realistic_post_format_icon( get_post_format() ); ?>
	</a>

<?php } ?>