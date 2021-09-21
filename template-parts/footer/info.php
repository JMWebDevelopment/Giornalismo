<?php
/**
 * Template part for displaying the footer info
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<div class="site-info">
	<?php
	if ( wp_rig()->social_media_links() ) {
		?>
		<div class="social-links">
			<?php echo wp_kses_post( wp_rig()->social_media_links() ); ?>
		</div>
		<?php
	}
	?>
	<p>
	&copy; <?php echo esc_html( date( 'Y' ) ); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html( bloginfo( 'name' ) ); ?></a>
	</p>
</div><!-- .site-info -->
