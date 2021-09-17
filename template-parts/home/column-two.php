<?php
/**
 * Template part for displaying a post on the homepage
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

use WP_Query;

if ( get_theme_mod( 'giornalismo-column-two-count' ) ) {
	$count = esc_attr( get_theme_mod( 'giornalismo-column-two-count' ) );
} else {
	$count = 5;
}

$posts_args   = array(
	'posts_per_page' => $count,
	'cat'            => esc_attr( get_theme_mod( 'giornalismo-column-two-category' ) ),
);
$column_posts = new WP_Query( $posts_args );
?>
<section class="column-two column">
	<?php
	if ( false !== get_theme_mod( 'giornalismo-column-two-category' ) && 'none' !== get_theme_mod( 'giornalismo-column-two-category' ) ) {
		?>
		<p class="label-head"><?php echo esc_html( get_cat_name( get_theme_mod( 'giornalismo-column-two-category' ) ) ); ?></p>
		<?php
	}
	if ( $column_posts->have_posts() ) {
		while ( $column_posts->have_posts() ) {
			$column_posts->the_post();
			$args = array(
				'category' => get_theme_mod( 'giornalismo-column-two-category' ),
				'column'   => 'column-two',
			);
			get_template_part( 'template-parts/home/post', null, $args );
		}

		if ( false === get_theme_mod( 'giornalismo-column-two-category' ) || 'none' === get_theme_mod( 'giornalismo-column-two-category' ) ) {
			?>
			<a href="<?php echo esc_attr( get_next_posts_page_link( $column_posts->max_num_pages ) ); ?>" class="button off-black view-more-link"><?php esc_html_e( 'View More', 'wp-rig' ); ?></a>
			<?php
		} else {
			?>
			<a class="button off-black view-more-link" href="<?php echo esc_url( get_category_link( get_theme_mod( 'giornalismo-column-two-category' ), 'category' ) ); ?>"><?php esc_html_e( 'View More &rsaquo;&rsaquo;', 'wp-rig' ); ?></a>
			<?php
		}
	}
	?>
</section>
<?php
wp_reset_postdata();
