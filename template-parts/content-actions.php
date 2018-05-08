<?php
/**
 * Template part for displaying post actions menu.
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !current_user_can( 'editor' ) && !current_user_can( 'administrator' ) ) {
	return '';
} ?>

<button id="post-actions<?php the_ID(); ?>" class="post-actions mdl-button mdl-js-button mdl-button--icon">
	<i class="material-icons">more_vert</i>
</button>

<ul class="post-actions-menu mdl-menu mdl-menu--top-right mdl-js-menu mdl-js-ripple-effect" for="post-actions<?php the_ID(); ?>">

	<?php edit_post_link( esc_html__( 'Edit', 'realistic' ), '<li class="mdl-menu__item">', '</li>'); ?>

	<?php if ( current_user_can( 'administrator' ) ) {

		$delLink = wp_nonce_url( admin_url() . "post.php?post=" . get_the_ID() . "&action=delete", 'delete-' . get_post_type() . '_' . get_the_ID() ); ?>

		<li class="mdl-menu__item">
			<a href="<?php echo $delLink; ?>"><?php esc_html_e( 'Delete', 'realistic' ); ?></a>
		</li>

	<?php } ?>

</ul>