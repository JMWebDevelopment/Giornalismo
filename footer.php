<?php 
/**
* Footer.php
*
* Footer file for Giornalismo
*
* @author Jacob Martella
* @package Giornalismo
* @version 1.5
*/
?>
</div><!--End Wrap-->
<footer class="footer">
	<p><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a> <?php _e( '|', 'giornalismo' ); ?> <a href="https://jacobmartella.com/wordpress/wordpress-themes/giornalismo-wordpress-theme/" target="_blank"><?php _e( 'Giornalismo', 'giornalismo' ); ?></a> <?php _e( '| Copyright  &copy;', 'giornalismo' ); ?><?php echo date( 'Y' ); ?> | <?php wp_loginout(); ?><?php wp_register( ' | ', '' ); ?></p>
</footer>
<?php wp_footer(); ?>
</body>
</html>