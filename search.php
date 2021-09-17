<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

get_header();

wp_rig()->print_styles( 'wp-rig-content' );
wp_rig()->print_styles( 'wp-rig-archive' );

?>
	<div class="site-container">
		<main id="primary" class="site-main">
			<div class="entry-header">
				<?php echo wp_kses_post( wp_rig()->display_breadcrumbs() ); ?>
				<h1><?php the_archive_title(); ?></h1>
			</div>
			<div class="archive-posts">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/archive/post' );
				}
				the_posts_pagination();
				?>
			</div>
		</main><!-- #primary -->
		<?php
		get_sidebar();
		?>
	</div>
<?php
get_footer();
