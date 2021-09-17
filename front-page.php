<?php
/**
 * Render your site front page, whether the front page displays the blog posts index or a static page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#front-page-display
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;


get_header();

wp_rig()->print_styles( 'wp-rig-front-page' );
wp_rig()->print_styles( 'wp-rig-content' );

?>
	<div class="site-container">
		<main id="primary" class="site-main">
			<?php
			get_template_part( 'template-parts/home/top' );

			get_template_part( 'template-parts/home/column', 'one' );

			get_template_part( 'template-parts/home/column', 'two' );

			get_template_part( 'template-parts/home/column', 'three' );
			?>
		</main><!-- #primary -->
		<?php
		get_sidebar();
		?>
	</div>
<?php
get_footer();
