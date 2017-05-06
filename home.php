<?php 
/**
* Home.php
*
* Home page file for Giornalismo
*
* @author Jacob Martella
* @package Giornalismo
* @version 1.4
*/
get_header(); ?>
<?php get_sidebar(); ?>
<main class="home-posts-area">
	<section class="home-center">
		<!--Begin Top Story Section-->
		<section class="top-story">
			<?php 
				$top_story_args = array(
					'posts_per_page' => 1,
					'cat' => esc_attr( get_theme_mod( 'giornalismo-top-story-category' ) )
				);
				$top_story = new WP_Query($top_story_args);
				if ( $top_story->have_posts() ) : while ( $top_story->have_posts() ) : $top_story->the_post(); $do_not_duplicate[] = $post->ID;
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'top-story-article' ); ?>>
				<?php if ( get_post_meta( $post->ID, 'giornalismo_featured_video', true ) ) { ?>
					<div class="featured-video">
						<?php echo wp_oembed_get( get_post_meta( $post->ID, 'giornalismo_featured_video', true ) ); ?>
					</div>
				<?php } elseif ( has_post_thumbnail() ) { ?>
					<div class="featured-photo">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'giornalismo-single' ); ?></a>
					</div>
				<?php } else { } ?>
				<?php if ( get_post_meta( $post->ID, 'giornalismo_photo_caption', true ) ) { ?>
				<p class="caption"><?php echo get_post_meta( $post->ID, 'giornalismo_photo_caption', true ); ?></p>
			<?php } ?>
			<?php if ( get_post_meta( $post->ID, 'giornalismo_photo_credit', true ) ) { ?>
				<p class="photo-credit"><?php echo get_post_meta( $post->ID, 'giornalismo_photo_credit', true ); ?></p>
			<?php } ?>
				<header class="top-story-header">
					<h3 class="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<h5 class="byline"><?php if ( esc_attr( get_theme_mod( 'giornalismo-author-byline' ) ) == 1 ) { echo giornalismo_author_byline(); } ?><?php the_date( get_option( 'date_format' ) );?><?php if ( esc_attr( get_theme_mod( 'giornalismo-post-comments' ) ) == 1 ) { echo ', '; comments_popup_link( __( '0 Comments', 'giornalismo' ), __( '1 Comment', 'giornalismo' ), __( '% Comments', 'giornalismo' ),'', __( 'Comments Off', 'giornalismo' ) ); } ?></h5>
				</header>
				<?php the_excerpt(); ?>
			</article>
			<?php endwhile; endif; wp_reset_postdata(); ?>
		</section>
		<!--End Top Story Section-->
		<!--Begin Column One-->
		<section class="column-one home-column">
			<?php if ( esc_attr( get_theme_mod( 'giornalismo-column-one-category' ) ) ) { $column_one_cat = esc_attr( get_theme_mod( 'giornalismo-column-one-category' ) ); } else { $column_one_cat = ''; } ?>
			<?php if ( esc_attr( get_theme_mod( 'giornalismo-column-one-count' ) ) ) { $column_one_count = esc_attr( get_theme_mod( 'giornalismo-column-one-count' ) ); } else { $column_one_count = 5; } ?>
			<?php if ( ( $column_one_cat != '' ) and ( $column_one_cat != 'none' ) ) {
				$column_one_slug = get_category( $column_one_cat );
				if ( function_exists( 'rl_color' ) ){ $category_one_color = 'style="background-color: ' .rl_color( $column_one_cat ) . ';"'; } else { $category_one_color = ''; } ?>
				<h5 class="category-<?php echo $column_one_slug->slug; ?> label-head" <?php echo $category_one_color; ?>><a <?php echo $category_one_color; ?> href="<?php echo esc_url( get_category_link( $column_one_cat, 'category' ) ); ?>"><?php echo get_cat_name( $column_one_cat ); ?></a></h5>
			<?php } ?>
			<?php
				$column_one_args = array(
					'category_name' 	=> get_cat_name( $column_one_cat ),
					'posts_per_page' 	=> $column_one_count,
					'post__not_in' 		=> $do_not_duplicate,
					'orderby' 			=> 'date',
					'order' 			=> 'DESC'
				);
				$column_one = new WP_Query( $column_one_args );
				if ( $column_one->have_posts() ) : while ( $column_one->have_posts() ) : $column_one->the_post(); $do_not_duplicate[] = $post->ID;
				if ( ( $column_one_cat == '' ) or ( $column_one_cat == 'none' ) ) { $margin = 'style="margin-top:0px;margin-bottom:10px;"'; } else { $margin = ''; }
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'column-one-story column-story clearfix' ); echo $margin; ?>>
				<?php if ( ( $column_one_cat == '' ) or ( $column_one_cat == 'none' ) ) { $cats = get_the_category(); if ( function_exists( 'rl_color' ) ) { $category_one_color = 'style="background-color: ' .rl_color( $cats[ 0 ]->term_id ) . ';"'; } else { $category_one_color = ''; } ?><h5 class="label-head" <?php echo $category_one_color; ?>><a <?php echo $category_one_color; ?> href="<?php echo esc_url( get_category_link( $cats[ 0 ]->term_id ) ); ?>"><?php echo $cats[ 0 ]->cat_name; ?></h5><?php } ?>
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="featured-photo"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'giornalismo-single' ); ?></a></div>
				<?php } ?>
				<?php if ( get_post_meta( $post->ID, 'giornalismo_photo_credit', true ) ) { ?>
					<p class="photo-credit"><?php echo get_post_meta($post->ID, 'giornalismo_photo_credit', true); ?></p>
				<?php } ?>
				<header class="column-one-header column-header">
					<h3 class="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<h5 class="byline"><?php if ( esc_attr( get_theme_mod( 'giornalismo-author-byline' ) ) == 1 ) { echo giornalismo_author_byline(); } ?><?php the_date( get_option( 'date_format' ) );?><?php if ( esc_attr( get_theme_mod( 'giornalismo-post-comments' ) ) == 1 ) { echo ', '; comments_popup_link( __( '0 Comments', 'giornalismo' ), __( '1 Comment', 'giornalismo' ), __( '% Comments', 'giornalismo' ),'', __( 'Comments Off', 'giornalismo' ) ); } ?> </h5>
				</header>
				<?php the_excerpt(); ?>
			</article>
			<?php endwhile; endif; wp_reset_postdata(); ?>
            <?php
            if ( esc_attr( get_theme_mod( 'giornalismo-column-one-category' ) ) ) { ?>
                <a class="read-more-posts-link" <?php echo $category_one_color; ?> href="<?php echo esc_url( get_category_link( $column_one_cat, 'category' ) ); ?>"><?php _e( 'View More &rsaquo;&rsaquo;', 'giornalismo' ); ?></a>
            <?php } else { ?>
                <a class="read-more-posts-link" href="<?php echo esc_url( get_home_url() . '/?paged=2' ); ?>"><?php _e( 'View More &rsaquo;&rsaquo;', 'giornalismo' ); ?></a>
            <?php }
            ?>
		</section>
		<!--End Column One-->
		<!--Begin Column Two-->
		<section class="column-two home-column">
			<?php if ( esc_attr( get_theme_mod( 'giornalismo-column-two-category' ) ) ) { $column_two_cat = esc_attr( get_theme_mod( 'giornalismo-column-two-category' ) ); } else { $column_two_cat = ''; } ?>
			<?php if ( esc_attr( get_theme_mod( 'giornalismo-column-two-count' ) ) ) { $column_two_count = esc_attr( get_theme_mod( 'giornalismo-column-two-count' ) ); } else { $column_two_count = 5; } ?>
			<?php if ( ( $column_two_cat != '' ) and ( $column_two_cat != 'none' ) ) {
				$column_two_slug = get_category( $column_two_cat );
				if ( function_exists( 'rl_color' ) ) { $category_two_color = 'style="background-color: ' . rl_color( $column_two_cat ) . ';"'; } else { $category_two_color = ''; } ?>
				<h5 class="label-head category-<?php echo $column_two_slug->slug; ?>" <?php echo $category_two_color; ?>><a href="<?php echo esc_url( get_category_link( $column_two_cat ) ); ?>" <?php echo $category_two_color; ?>><?php echo get_cat_name( $column_two_cat ); ?></a></h5>
			<?php } ?>
			<?php
				$column_two_args = array(
					'category_name' 	=> get_cat_name( $column_two_cat ),
					'posts_per_page' 	=> $column_two_count,
					'post__not_in' 		=> $do_not_duplicate,
					'orderby' 			=> 'date',
					'order' 			=> 'DESC'
				);
				$column_two = new WP_Query( $column_two_args );
				if ( $column_two->have_posts() ) : while ( $column_two->have_posts() ) : $column_two->the_post(); $do_not_duplicate[] = $post->ID;
				if ( ( $column_two_cat == '' ) or ( $column_two_cat == 'none' ) ) { $margin = 'style="margin-top:0px;margin-bottom:10px;"'; } else { $margin = ''; }
					if ( function_exists( 'rl_color' ) ) { $category_two_color = 'style="background-color: ' .rl_color( $cats[ 0 ]->term_id ) . ';"'; } else { $category_two_color = ''; }
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'column-two-story column-story clearfix' ); echo $margin; ?>>
				<?php if ( ( $column_two_cat == '' ) or ( $column_two_cat == 'none' ) ) { $cats = get_the_category(); if ( function_exists( 'rl_color' ) ) { $category_two_color = 'style="background-color: ' .rl_color( $cats[ 0 ]->term_id) . ';"'; } else { $category_two_color = ''; } ?><h5 class="label-head" <?php echo $category_two_color; ?>><a href="<?php echo esc_url( get_category_link( $cats[ 0 ]->term_id ) ); ?>" <?php echo $category_two_color; ?>><?php echo $cats[ 0 ]->cat_name; ?></h5><?php } ?>
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="featured-photo"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'giornalismo-single' ); ?></a></div>
				<?php } ?>
				<?php if ( get_post_meta( $post->ID, 'giornalismo_photo_credit', true ) ) { ?>
					<p class="photo-credit"><?php echo get_post_meta( $post->ID, 'giornalismo_photo_credit', true ); ?></p>
				<?php } ?>
				<header class="column-two-header column-header">
					<h3 class="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<h5 class="byline"><?php if ( esc_attr( get_theme_mod( 'giornalismo-author-byline' ) ) == 1 ) { echo giornalismo_author_byline(); } ?><?php the_date( get_option( 'date_format' ) );?><?php if ( esc_attr( get_theme_mod( 'giornalismo-post-comments' ) ) == 1 ) { echo ', '; comments_popup_link( __( '0 Comments', 'giornalismo' ), __( '1 Comment', 'giornalismo' ), __( '% Comments', 'giornalismo' ),'', __( 'Comments Off', 'giornalismo' ) ); } ?></h5>
				</header>
				<?php the_excerpt(); ?>
			</article>
			<?php endwhile; endif; wp_reset_postdata(); ?>
		</section> 
	</section>
	<!--End Column Two-->
	<!--Begin Column Three-->
	<section class="column-three home-column">
		<?php if ( esc_attr( get_theme_mod( 'giornalismo-column-three-category' ) ) ) { $column_three_cat = esc_attr( get_theme_mod( 'giornalismo-column-three-category' ) ); } else { $column_three_cat = ''; } ?>
			<?php if ( esc_attr( get_theme_mod( 'giornalismo-column-three-count' ) ) ) { $column_three_count = esc_attr( get_theme_mod( 'giornalismo-column-three-count' ) ); } else { $column_three_count = 5; } ?>
			<?php if ( ( $column_three_cat != '' ) and ( $column_three_cat != 'none' ) ) {
				$column_three_slug = get_category( $column_three_cat );
				if( function_exists( 'rl_color' ) ) { $category_three_color = 'style="background-color: ' . rl_color( $column_three_cat ) . ';"'; } else { $category_three_color = ''; }?>
				<h5 class="label-head category-<?php echo $column_three_cat->slug; ?>" <?php echo $category_three_color; ?>><a href="<?php echo esc_url( get_category_link( $column_three_cat ) ); ?>" <?php echo $category_three_color; ?>><?php echo get_cat_name( $column_three_cat ); ?></a></h5>
			<?php } ?>
			<?php
				$column_three_args = array(
					'category_name' 	=> get_cat_name( $column_three_cat ),
					'posts_per_page' 	=> intval( $column_three_count ),
					'post__not_in' 		=> $do_not_duplicate,
					'orderby' 			=> 'date',
					'order' 			=> 'DESC'
				);
				$column_three = new WP_Query( $column_three_args );
				if ( $column_three->have_posts() ) : while ( $column_three->have_posts() ) : $column_three->the_post();
				if ( ( $column_three_cat == '' ) or ( $column_three_cat == 'none' ) ) { $margin = 'style="margin-top:0px;margin-bottom:10px;"'; } else { $margin = ''; }
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'column-three-story column-story clearfix' ); echo $margin; ?>>
				<?php if ( ( $column_three_cat == '' ) or ( $column_three_cat == 'none' ) ) { $cats = get_the_category(); if ( function_exists( 'rl_color' ) ) { $category_three_color = 'style="background-color: ' . rl_color( $cats[ 0 ]->term_id ) . ';"'; } else { $category_three_color = ''; } ?><h5 class="label-head" <?php echo $category_three_color; ?>><a href="<?php echo esc_url( get_category_link( $cats[ 0 ]->term_id ) ); ?>" <?php echo $category_three_color; ?>><?php echo $cats[ 0 ]->cat_name; ?></h5><?php } ?>
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="featured-photo"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'giornalismo-single' ); ?></a></div>
				<?php } ?>
				<?php if ( get_post_meta( $post->ID, 'giornalismo_photo_credit', true) ) { ?>
					<p class="photo-credit"><?php echo get_post_meta( $post->ID, 'giornalismo_photo_credit', true ); ?></p>
				<?php } ?>
				<header class="column-three-header column-header">
					<h3 class="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<h5 class="byline"><?php if ( esc_attr( get_theme_mod( 'giornalismo-author-byline' ) ) == 1 ) { echo giornalismo_author_byline(); } ?><?php the_date( get_option( 'date_format' ) );?><?php if ( esc_attr( get_theme_mod( 'giornalismo-post-comments' ) ) == 1) { echo ', '; comments_popup_link( __( '0 Comments', 'giornalismo' ), __( '1 Comment', 'giornalismo' ), __( '% Comments', 'giornalismo' ),'', __( 'Comments Off', 'giornalismo' ) ); } ?></h5>
				</header>
				<?php the_excerpt(); ?>
			</article>
			<?php endwhile; endif; wp_reset_postdata(); ?>
	</section>
	<!--End Column Three-->
</main>
<!--Begin Mobile Sidebar-->
<section class="mobile-sidebar">
</section>
<!--End Mobile Sidebar-->
<?php get_footer(); ?>