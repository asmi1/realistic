<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

	</div>

	<footer id="colophon" class="site-footer mdl-mega-footer" role="contentinfo">
		<div class="site-info mdl-mega-footer--bottom-section">

			<div id="copyright-note">
				<div class="left">
					<?php echo realistic_sanitize_text( do_shortcode( get_theme_mod( 'footer_left', REALISTIC_FOOTER_TEXT ) ) ); ?>
				</div>
				<div class="right">
					<?php echo REALISTIC_AUTHOR; ?>
				</div>
			</div>

		</div><!-- .site-info -->	
	</footer><!-- #colophon -->
</div><!-- .mdl-layout -->

<?php wp_footer(); ?>

</body>
</html>