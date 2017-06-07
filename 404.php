<?php
/**
* 404.php
*
* 404 template for Giornalismo
*
* @author Jacob Martella
* @package Giornalism
* @version 1.5
*/
get_header();
get_sidebar();
?>
<main class="post-404">
	<div class="not-found"></div>
	<h3 class="not-found-header"><?php _e( 'Whoops! That\'s not here.', 'giornalismo' ) ; ?></h3>
	<p><?php _e( 'We\'re sorry but the post or page you were looking for isn\'t here. ', 'giornalismo' ); ?><a href="<?php echo esc_url(home_url()); ?>"><?php _e( 'Click here', 'giornalismo' ); ?></a><?php _e( ' to return to the homepage or use the search bar below to search for what you were looking for.', 'giornalismo' ); ?></p>
	<?php get_search_form(); ?>
</main>
<?php get_footer(); ?>