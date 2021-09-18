<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

get_header();

wp_rig()->print_styles( 'wp-rig-page' );
wp_rig()->print_styles( 'wp-rig-content' );
wp_rig()->load_color_stylesheet();

?>
	<div class="site-container">
		<main id="primary" class="site-main">
			<article id="<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php echo wp_kses_post( wp_rig()->display_breadcrumbs() ); ?>
					<h1 class="single-title"><?php esc_html_e( '404 - Article Not Found', 'wp-rig' ); ?></h1>
				</header>

				<div class="entry-content">
					<p class="single-meta"><?php esc_html_e( 'The article you were looking for was not found.', 'wp-rig' ); ?></p>
					<p><?php esc_html_e( 'Please use the search bar below to search for the content you\'re looking for.', 'wp-rig' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</article>
		</main><!-- #primary -->
		<?php
		get_sidebar();
		?>
	</div>
<?php
get_footer();
