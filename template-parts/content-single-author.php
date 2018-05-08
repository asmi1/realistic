<?php
/**
 * Template part for displaying post's author.
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !get_theme_mod( 'author_box', '1' ) ) {
	return '';
} ?>

<h3 class="section-title margin-8"><?php esc_html_e( 'About the author', 'realistic' ); ?></h3>

<div class="author-box mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col">
	<div class="author-box-wrap mdl-grid">

		<div class="author-box-avatar mdl-cell--3-col-desktop mdl-cell--2-col-tablet mdl-cell--4-col-phone">
			<?php echo get_avatar( get_the_author_meta( 'email' ), '120' ); ?>
		</div>

		<div class="author-box-content mdl-cell--9-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone">

			<div class="author">
				<div class="vcard clearfix">
					<?php if ( get_the_author_link() ) { ?>
						<a href="<?php echo get_the_author_meta( 'user_url' ); ?>" rel="nofollow" class="fn">
							<strong><?php the_author_meta( 'nickname' ); ?></strong>
						</a>
					<?php } else { ?>
						<strong><?php the_author_meta( 'nickname' ); ?></strong>
					<?php } ?>
				</div>
			</div>

			<?php if ( get_the_author_meta( 'description' ) ) { ?>
				<p><?php the_author_meta( 'description' ) ?></p>
			<?php }?>
		</div>

	</div>

	<div class="mdl-card__actions mdl-card--border">

		<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php esc_html_e( 'View Posts', 'realistic' ); ?></a>

		<?php if ( get_the_author_meta( 'facebook' ) ) { ?>
			<ul class="author-btns">

				<?php if( get_the_author_meta( 'facebook' ) ) { ?>
					<li>
						<a class="facebook" title="Facebook" href="<?php the_author_meta( 'facebook' ); ?>" target="_blank"><i class="icon icon-facebook"></i></a>
					</li>
				<?php } ?>
				
				<?php if( get_the_author_meta( 'twitter' ) ) { ?>
					<li>
						<a class="twitter" title="Twitter" href="<?php the_author_meta( 'twitter' ); ?>" target="_blank"><i class="icon icon-twitter-1"></i></a>
					</li>
				<?php } ?>
				
				<?php if( get_the_author_meta( 'googleplus' ) ) { ?>
					<li>
						<a class="gplus" title="Google+" href="<?php the_author_meta( 'googleplus' ); ?>" target="_blank"><i class="icon icon-gplus-1"></i></a>
					</li>
				<?php } ?>

			</ul>
		<?php } ?>

	</div>
</div>