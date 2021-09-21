<?php
/**
 * Template part for displaying the header widget area
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<div class="header-widget-area">

	<h2 class="screen-reader-text"><?php esc_attr_e( 'Header Widget Area', 'wp-rig' ); ?></h2>
	<?php wp_rig()->display_header_sidebar(); ?>

</div>
