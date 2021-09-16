<?php
/**
 * Template part for displaying the single post header
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<header class="post-header">
	<?php
	if ( get_post_meta( $post->ID, 'giornalismo_featured_video', true ) ) {
		?>
		<div class="featured-video">
			<?php echo wp_oembed_get( get_post_meta( $post->ID, 'giornalismo_featured_video', true ) ); ?>
		</div>
		<?php
	} elseif ( has_post_thumbnail() ) {
		?>
		<div class="featured-photo">
			<?php the_post_thumbnail( 'single' ); ?>
		</div>
		<?php
	}
	?>

	<?php
	if ( get_post_meta( $post->ID, 'giornalismo_photo_caption', true ) ) {
		?>
		<p class="caption"><?php echo get_post_meta( $post->ID, 'giornalismo_photo_caption', true ); ?></p>
		<?php
	}
	if ( get_post_meta( $post->ID, 'giornalismo_photo_credit', true ) ) {
		?>
		<p class="photo-credit"><?php echo get_post_meta( $post->ID, 'giornalismo_photo_credit', true ); ?></p>
		<?php
	}
	?>
	<h1 class="headline"><?php the_title(); ?></h1>
	<p class="byline">
		<?php
		if ( 1 === esc_attr( get_theme_mod( 'giornalismo-author-byline' ) ) ) {
			echo giornalismo_author_byline();
		}
		?>
		<?php the_date( get_option( 'date_format' ) );?>
		<?php
		if ( 1 === esc_attr( get_theme_mod( 'giornalismo-post-comments' ) ) ) {
			echo ', ';
			comments_popup_link( esc_html__( '0 Comments', 'wp-rig' ), esc_html__( '1 Comment', 'wp-rig' ), esc_html__( '% Comments', 'wp-rig' ), '', esc_html__( 'Comments Off', 'wp-rig' ) );
		}
		?>
		</p>
	<hr />
</header>
