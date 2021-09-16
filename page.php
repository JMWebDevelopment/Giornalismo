<?php
/**
 * The template for displaying all pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

get_header();

wp_rig()->print_styles( 'wp-rig-page' );
wp_rig()->print_styles( 'wp-rig-content' );

?>
	<div class="site-container">
		<main id="primary" class="site-main">
			<?php

			while ( have_posts() ) {
				the_post();
				?>
				<article id="<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php echo wp_kses_post( wp_rig()->display_breadcrumbs() ); ?>
						<h1><?php the_title(); ?></h1>
					</header>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>

					<footer class="entry-footer">
						<?php
						if ( post_type_supports( get_post_type(), 'comments' ) && ( comments_open() || get_comments_number() ) ) {
							comments_template();
						}
						?>
						<?php wp_link_pages(); ?>
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
