<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cuisine_a_la_Toile
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cuisine-a-la-toile' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<a class="site-branding" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class="logo" src="<?php echo get_template_directory_uri();?>/assets/logo.png">
			</a>
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<i class="icon-hamburger">
					<i class="icon-hamburger-line"></i>
					<i class="icon-hamburger-line"></i>
					<i class="icon-hamburger-line"></i>
				</i>

				<span class="text">
					<?php esc_html_e( 'Menu', 'cuisine-a-la-toile' ); ?>
				</span>
			</button>

			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
