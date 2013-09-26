<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Lucid
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<?php if (is_home()): ?>
	 <title><?php bloginfo('name'); ?> </title>

	<?php else: ?>

	<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php endif ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory');?>/img/favicon.ico">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> onload="prettyPrint();">
	<?php do_action( 'before' ); ?>

<div class="snap-drawers">
	
	<header id="masthead" class="site-header snap-drawer snap-drawer-left" role="banner">
		<div class="header-content">
			
			<div class="site-branding">

				<?php $header_image = get_header_image();
				if ( ! empty( $header_image ) ) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
					</a>
				<?php }else{ // if ( ! empty( $header_image ) ) ?>


				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

				<?php } ?>

				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<h1 class="menu-toggle"><?php _e( 'Menu', 'lucid' ); ?></h1>
				<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'lucid' ); ?>"><?php _e( 'Skip to content', 'lucid' ); ?></a></div>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->

			<div class="copyright">
				theme by <a href="http://themeskult.com">Themes Kult</a>
			</div>
		</div>
	</header><!-- #masthead -->

</div>

<div id="snap-content" class="snap-content">
	<div id="main" class="site-main">
		<?php get_header('2');  ?>
