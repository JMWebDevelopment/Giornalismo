<?php
/**
 * Template part for displaying the top post section on the homepage
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

use WP_Query;

$top_story_args = array(
	'posts_per_page'      => 1,
	'cat'                 => esc_attr( get_theme_mod( 'giornalismo-top-story-category' ) ),
	'ignore_sticky_posts' => 1,
);
$top_story      = new WP_Query( $top_story_args );
?>
<section class="top-story">
<?php
if ( $top_story->have_posts() ) {
	while ( $top_story->have_posts() ) {
		$top_story->the_post();
		$args = array(
			'category' => 'none',
			'column'   => 'top',
		);
		?>
			<?php get_template_part( 'template-parts/home/post', null, $args ); ?>
		<?php
	}
}
?>
</section>
<?php
wp_reset_postdata();
