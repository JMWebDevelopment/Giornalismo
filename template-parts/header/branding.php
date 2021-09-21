<?php
/**
 * Template part for displaying the header branding
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( has_header_image() ) {
	$title_class = 'screen-reader-text';
} else {
	$title_class = '';
}

?>

<div class="site-branding">

	<?php
	if ( is_front_page() && is_home() ) {
		?>
		<h1 class="site-title <?php echo esc_attr( $title_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php
	} else {
		?>
		<p class="site-title <?php echo esc_attr( $title_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php
	}
	?>

	<?php
	$wp_rig_description = get_bloginfo( 'description', 'display' );
	if ( $wp_rig_description || is_customize_preview() ) {
		?>
		<p class="site-description <?php echo esc_attr( $title_class ); ?>">
			<?php echo $wp_rig_description; /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?>
		</p>
		<?php
	}
	?>
</div><!-- .site-branding -->
