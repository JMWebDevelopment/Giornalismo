<?php 
/**
* Archive.php
*
* File for the Archive, Category, Index, Search and Tag templates Giornalismo
*
* @author Jacob Martella
* @package Giornalismo
* @version 1.5
*/
get_header();
get_sidebar();
?>
<main class="index">
	<?php the_post(); ?>
		<?php if( esc_attr( get_theme_mod( 'giornalismo-breadcrumbs' ) ) ) { echo giornalismo_breadcrumbs(); } ?>
		<?php the_archive_title( '<h1 class="title">', '</h1>' ); ?>
	<?php rewind_posts(); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="<?php the_ID(); ?>" <?php post_class( 'story' ); ?>>
			<div class="photo-area">
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="photo"><?php the_post_thumbnail( 'giornalismo-single' ); ?></div>
				<?php } else { } ?>
			</div>
			<header class="index-header">
				<h3 class="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<h5 class="byline"><?php if ( esc_attr( get_theme_mod( 'giornalismo-author-byline' ) ) == 1) { echo giornalismo_author_byline(); } ?><?php the_date( get_option( 'date_format' ) );?><?php if ( esc_attr( get_theme_mod( 'giornalismo-post-comments' ) ) == 1 ) { echo ', '; comments_popup_link( __( '0 Comments', 'giornalismo' ), __( '1 Comment', 'giornalismo' ), __( '% Comments', 'giornalismo' ),'', __( 'Comments Off', 'giornalismo' ) ); } ?></h5>
				<?php if ( is_category() == false ) { ?>
					<div class="label-head">
						<h5 class="label-head"><?php the_category(); ?></a></h5>
					</div>
				<?php } ?>
			</header>
			<?php the_excerpt(); ?>
		</article>
	<?php endwhile; ?>
	<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
		<span class="older"><?php next_posts_link( __( 'Older Posts&rsaquo;&rsaquo;', 'giornalismo' ) ); ?></span>
		<span class="newer"><?php previous_posts_link( __( '&lsaquo;&lsaquo;Newer Posts', 'giornalismo' ) ); ?></span>
	<?php } ?>
</main>
<!--Begin Mobile Sidebar-->
<section class="mobile-sidebar">
</section>
<!--End Mobile Sidebar-->
<?php get_footer(); ?>