<?php
/**
* Sidebar.php
*
* Sidebar template for Giornalismo
*
* @author Jacob Martella
* @package Giornalismo
* @version 1.5
*/
?>
<section class="left-sidebar">
	<?php if ( dynamic_sidebar('left_sidebar') ) : else : ?>
	<?php endif; ?>
</section>
<section class="right-sidebar">
	<?php if ( dynamic_sidebar('right_sidebar') ) : else : ?>
	<?php endif; ?>
</section>