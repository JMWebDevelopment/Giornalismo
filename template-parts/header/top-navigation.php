<?php
/**
 * Template part for displaying the header top navigation menu
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( ! wp_rig()->is_primary_nav_menu_active() ) {
	return;
}

?>

<nav id="top-site-navigation" class="top-navigation nav--toggle-sub nav--toggle-small" aria-label="<?php esc_attr_e( 'Main menu', 'wp-rig' ); ?>">>
		<?php esc_html_e( 'Menu', 'wp-rig' ); ?>
	</button>

	<div class="secondary-menu-container">
		<?php wp_rig()->display_secondary_nav_menu( array( 'menu_id' => 'top-menu' ) ); ?>
	</div>
</nav><!-- #site-navigation -->
