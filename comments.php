<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 * 
 * @package realistic
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( post_password_required() ) { ?>
	<p class="nocomments"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'realistic' ); ?></p>
	<?php return;
} ?>

<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>

<div id="comments">
	<h3 class="total-comments section-title margin-8">
		<?php comments_number( esc_html__( 'No Comments', 'realistic' ), esc_html__(' One Comment','realistic' ),  esc_html__( '% Comments','realistic' ) ); ?>
	</h3>

	<ol class="commentlist clearfix">
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
		<?php wp_list_comments('type=comment&callback=realistic_custom_comments'); ?>
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
	</ol>
</div>

<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments"></p>
<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<div id="commentsAdd" class="mdl-cell mdl-cell--12-col">
	<?php global $aria_req; $comments_args = array(

		'title_reply'=> esc_html__( 'Add a Comment', 'realistic' ),
		'comment_notes_after' => '',
		'label_submit' => esc_html__( 'Add Comment', 'realistic' ),
		'class_submit' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent',
		'comment_field' => '<div class="comment-form-comment mdl-textfield mdl-js-textfield"><textarea id="comment" class="mdl-textfield__input" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
		'fields' => apply_filters( 'comment_form_default_fields',

			array(
				'author' => '
					<div class="comment-form-fields mdl-grid">
						<div class="comment-form-author mdl-textfield mdl-js-textfield mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--4-col-phone"><input id="author" class="mdl-textfield__input" name="author" type="text" placeholder="'. esc_html__( 'Name', 'realistic' ) .'*" value="'. esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',

				'email' => '
						<div class="comment-form-email mdl-textfield mdl-js-textfield mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--4-col-phone"><input id="email" class="mdl-textfield__input" name="email" type="text" placeholder="'. esc_html__( 'Email', 'realistic' ) .'*" value="'. esc_attr(  $commenter['comment_author_email'] ).'" size="30"'. $aria_req .' /></div>',

				'url' => '
						<div class="comment-form-url mdl-textfield mdl-js-textfield mdl-cell mdl-cell--4-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone"><input id="url" class="mdl-textfield__input" name="url" type="text" placeholder="'. esc_html__( 'Website', 'realistic' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) .'" size="30" /></div>
					</div>',
			)
		)
	);

	comment_form( $comments_args ); ?>
</div>
<?php endif; ?>