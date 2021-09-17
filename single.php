<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

get_header();

wp_rig()->print_styles( 'wp-rig-single' );
wp_rig()->print_styles( 'wp-rig-content' );

?>
	<div class="site-container">
		<main id="primary" class="site-main">
			<?php

			while ( have_posts() ) {
				the_post();
				?>
				<article id="<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php get_template_part( 'template-parts/single-post/header' ); ?>

					<?php get_template_part( 'template-parts/single-post/content' ); ?>

					<footer class="post-footer">
						<?php wp_link_pages(); ?>
						<p class="tags"><?php the_tags( '<strong>' . esc_html__( 'Tags: ', 'wp-rig' ) . '</strong>' ); ?></p>

						<?php get_template_part( 'template-parts/single-post/navigation' ); ?>

						<?php comments_template(); ?>

						<?php get_template_part( 'template-parts/single-post/related' ); ?>

						<?php get_template_part( 'template-parts/single-post/latest' ); ?>

						<?php get_template_part( 'template-parts/single-post/bio' ); ?>
					</footer>
				</article>
				<?php
			}
			?>
		</main><!-- #primary -->
		<?php
		get_sidebar();
		?>
	</div>
<?php
get_footer();
