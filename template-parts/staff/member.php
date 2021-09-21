<?php
/**
 * Template part for displaying a staff member for the staff template.
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

$writer = $args['writer'];
?>

<section class="author-bio clearfix">
	<?php
	if ( get_avatar( get_the_author_meta( 'email' ) ) ) {
		?>
		<div class="mug-shot"><?php echo wp_kses_post( get_avatar( get_the_author_meta( 'email' ), $size = 96 ) ); ?></div>
		<?php
	}
	if ( esc_attr( get_theme_mod( 'giornalismo-author-position' ) ) ) {
		$position = ' &#8212; ' . get_the_author_meta( 'author-position' );
	} else {
		$position = '';
	}
	?>
	<div class="author-info">
		<h2 class="name-title"><a href="<?php echo esc_url( get_author_posts_url( $writer->ID ) ); ?>"><?php echo esc_html( $writer->display_name . $position ); ?></a></h2>
		<p class="bio"><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
		<?php echo wp_kses_post( wp_rig()->author_social_area() ); ?>
	</div>
</section>
