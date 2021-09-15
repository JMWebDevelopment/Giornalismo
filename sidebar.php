<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( ! wp_rig()->is_left_sidebar_active() && ! wp_rig()->is_right_sidebar_active() ) {
	return;
}

wp_rig()->print_styles( 'wp-rig-sidebar', 'wp-rig-widgets' );

if ( 'two-sidebars' === get_theme_mod( 'giornalismo-layout' ) || 'left-sidebar' === get_theme_mod( 'giornalismo-layout' ) ) {
	?>
	<aside id="left-sidebar" class="primary-sidebar widget-area">
		<h2 class="screen-reader-text"><?php esc_attr_e( 'Left Asides', 'wp-rig' ); ?></h2>
		<?php wp_rig()->display_left_sidebar(); ?>
	</aside><!-- #secondary -->
	<?php
}

if ( 'two-sidebars' === get_theme_mod( 'giornalismo-layout' ) || 'right-sidebar' === get_theme_mod( 'giornalismo-layout' ) ) {
	?>
	<aside id="right-sidebar" class="primary-sidebar widget-area">
		<h2 class="screen-reader-text"><?php esc_attr_e( 'Right Asides', 'wp-rig' ); ?></h2>
		<?php wp_rig()->display_right_sidebar(); ?>
	</aside><!-- #secondary -->
	<?php
}

