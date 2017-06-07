<?php
/**
* Template-staff-page.php
*
* Template Name: Staff
*
* Custom staff page for Giornalismo
*
* @author Jacob Martella
* @package Giornalismo
* @version 1.5
*/
get_header();
get_sidebar();
?>
<main class="staff">
	<?php if ( esc_attr( get_theme_mod( 'breadcrumbs' ) ) == 1) { echo giornalismo_breadcrumbs(); } ?>
	<h3 class="title"><?php bloginfo( 'name' ); _e( ' Staff', 'giornalismo' ); ?></h3>
	<?php echo giornalismo_staff(); ?>
</main>
<!--Begin Mobile Sidebar-->
<section class="mobile-sidebar">
</section>
<!--End Mobile Sidebar-->
<?php get_footer(); ?>