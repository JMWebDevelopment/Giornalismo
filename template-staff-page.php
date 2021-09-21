<?php
/**
 * Template Name: Staff
 *
 * The template for displaying the staff page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

get_header();

wp_rig()->print_styles( 'wp-rig-staff-page' );
wp_rig()->print_styles( 'wp-rig-content' );
wp_rig()->load_color_stylesheet();

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
						<?php
						$writers = get_users(
							array(
								'orderby' => 'menu_order',
								'order' => 'DESC',
							)
						);
						if ( $writers ) {
							foreach ( $writers as $writer ) {
								get_template_part( 'template-parts/staff/member', null, array( 'writer' => $writer ) );
							}
						}
						?>
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
