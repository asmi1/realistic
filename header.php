<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed mdl-layout mdl-js-layout mdl-layout--fixed-header">
	<header id="masthead" class="site-header mdl-layout__header" role="banner">
		<div class="site-branding mdl-layout__header-row">

			<span class="site-title mdl-layout-title">
				<?php $logo_image = get_theme_mod( 'logo_image' );
				if ( $logo_image ) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="nofollow">
						<img src="<?php echo esc_url( $logo_image ); ?>" alt="<?php bloginfo( 'name' ); echo ' - '; bloginfo( 'description' ); ?>" />
					</a>
				<?php } else { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				<?php } ?>
			</span>

			<span class="site-tagline" style="display: none;"><?php bloginfo( 'description' ); ?></span>

			<div class="mdl-layout-spacer"></div>

			<nav id="site-navigation" class="main-navigation mdl-navigation mdl-layout--large-screen-only" role="navigation">
				<?php wp_nav_menu( 
					array( 
						'theme_location' => 'primary',
						'container' 	 => '',
					)
				); ?>
			</nav>

			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="search-box mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right mdl-textfield--full-width is-upgraded">
                    <label class="mdl-button mdl-js-button mdl-button--icon" for="search-field">
                        <i class="material-icons">search</i>
                    </label>
                    <div class="search-form mdl-textfield__expandable-holder">
                        <input class="search-field mdl-textfield__input" type="search" id="search-field" name="s" value="">
                    </div>
				</div>
			</form>

		</div>
	</header>

	<div class="mdl-layout__drawer">

		<nav id="site-navigation" class="mobile-navigation mdl-navigation" role="navigation">
			<?php wp_nav_menu( 
				array( 
					'theme_location' => 'mobile-menu',
					'container' 	 => '',
					'walker' 		 => new Realistic_Mobile_Menu_Walker()
				)
			); ?>
		</nav>

	</div>

	<div id="content" class="site-content mdl-layout__content mdl-grid">