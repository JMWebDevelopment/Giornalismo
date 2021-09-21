<?php
/**
 * Template part for displaying a post on the homepage
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'story-article' ); ?>>
	<?php
	if ( '' === $args['category'] || 'none' === $args['category'] || false === $args['category'] ) {
		$cats = get_the_category();
		?>
		<p class="label-head"><?php echo esc_html( $cats[0]->cat_name ); ?></p>
		<?php
	}
	?>
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
			<?php the_post_thumbnail( 'giornalismo-single' ); ?>
		</div>
		<?php
	}
	?>
	<?php
	if ( get_post_meta( $post->ID, 'giornalismo_photo_caption', true ) && 'top' !== $args['column'] ) {
		?>
		<p class="caption"><?php echo wp_kses_post( get_post_meta( $post->ID, 'giornalismo_photo_caption', true ) ); ?></p>
		<?php
	}
	?>
	<?php if ( get_post_meta( $post->ID, 'giornalismo_photo_credit', true ) && 'top' !== $args['column'] ) { ?>
		<p class="photo-credit"><?php echo wp_kses_post( get_post_meta( $post->ID, 'giornalismo_photo_credit', true ) ); ?></p>
	<?php } ?>
	<h2 class="headline"><?php the_title(); ?></h2>
	<p class="byline">
		<?php
		if ( '1' === esc_attr( get_theme_mod( 'giornalismo-author-byline' ) ) ) {
			echo wp_kses_post( wp_rig()->display_author_byline() );
		}
		the_date( get_option( 'date_format' ) );
		if ( '1' === esc_attr( get_theme_mod( 'giornalismo-post-comments' ) ) ) {
			echo ', ';
			comments_popup_link( esc_html__( '0 Comments', 'wp-rig' ), esc_html__( '1 Comment', 'wp-rig' ), esc_html__( '% Comments', 'wp-rig' ), '', esc_html__( 'Comments Off', 'wp-rig' ) );
		}
		?>
	</p>
	<?php the_excerpt(); ?>

	<a class="button off-black" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'wp-rig' ); ?><span class="screen-reader-text"> <?php esc_html_e( 'about', 'wp-rig' ); ?> <?php the_title(); ?></span></a>
</article>
