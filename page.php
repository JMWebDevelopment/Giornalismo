<?php
/**
* Page.php
*
* Basic page template for Giornalismo
*
* @author Jacob Martella
* @package Giornalismo
* @version 1.5
*/
get_header();
get_sidebar();
?>
<main class="page-single">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( esc_attr( get_theme_mod( 'breadcrumbs' ) ) == 1) { echo giornalismo_breadcrumbs(); } ?>
			<h1 class="title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>
		<section id="content-area">
			<?php comments_template(); ?>
		</section>
		<?php wp_link_pages(); ?>
	<?php endwhile; ?>
</main>
<!--Begin Mobile Sidebar-->
<section class="mobile-sidebar">
</section>
<!--End Mobile Sidebar-->
<?php get_footer(); ?>