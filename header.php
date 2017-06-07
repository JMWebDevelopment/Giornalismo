<?php 
/**
* Header.php
*
* Header file for Giornalismo
*
* @author Jacob Martella
* @package Giornalismo
* @version 1.5
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php if ( esc_attr( get_theme_mod( 'giornalismo-top-menu' ) ) == 1 ) { ?>
		<!--Begin Top Menu-->
		<nav class="top-menu giornalismo-menu clearfix" role="navigation">
			<?php wp_nav_menu(
				array(
					'theme_location' => 'top-menu'
				)
			); ?>
		</nav>
		<!--End Top Menu-->
	<?php } ?>
	<!--Begin Mobile Nav-->
		<div class="mobile-nav-area">
			<a href="#" class="hide-show-mobile-nav">
				<div class="mobile-nav-bar">
					<div class="mobile-nav-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/mobile-nav-icon.png" /></div>
					<h5><?php _e( 'Go to ...', 'giornalismo' ); ?></h5>
				</div>
			</a>
			<nav class="mobile-nav clearfix" role="navigation">
				<?php if ( esc_attr( get_theme_mod( 'giornalismo-top-menu' ) ) == 1 ) { ?>
				<div class="mobile-nav-left">
					<?php wp_nav_menu(
						array(
							'theme_location' => 'top-menu'
						)
					); ?>
				</div>
				<?php } ?>
				<div class="mobile-nav-right" <?php if ( esc_attr( get_theme_mod( 'giornalismo-top-menu' ) ) != 1 ) { echo 'style="width:100%;float:left;"'; } ?>>
					<?php wp_nav_menu(
						array(
							'theme_location' => 'main-menu'
						)
					); ?>
				</div>
			</nav>
		</div>
		<!--End Mobile Nav-->
	<header class="header-area clearfix">
		<!--Begin Masthead-->
		<?php echo giornalismo_header(); ?>
		<!--End Masthead-->
		<!--Begin Header Right Area-->
		<section class="header-right">
			<?php if ( dynamic_sidebar( 'header_widget_area' ) ) : else : ?>
			<?php endif; ?>
		</section>
		<!--End Header Right Area-->
		<!--Begin Social Media Area-->
		<?php echo giornalismo_social_media_links(); ?>
		<!--End Social Media Area-->
		<?php if ( function_exists( 'jm_breaking_news' ) ) {
			echo jm_breaking_news();
		} ?>
	</header>
	<!--Begin Main Menu-->
	<nav class="main-menu giornalismo-menu clearfix" role="navigation">
		<?php wp_nav_menu(
			array(
				'theme_location' => 'main-menu'
			)
		); ?>
	</nav>
	<!--End Main Menu-->
	<!--Display Today's Date if Wanted-->
	<?php echo giornalismo_todays_date(); ?>
	<div class="wrap">