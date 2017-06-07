<?php
/**
* Comments.php
*
* Comments template for Giornalismo
*
* @author Jacob Martella
* @package Giornalismo
* @version 1.5
*/
?>
<?php
	if ( ! empty( $_SERVER[ 'SCRIPT_FILENAME' ] ) && 'comments.php' == basename( $_SERVER[ 'SCRIPT_FILENAME' ] ) )
		die ( __( 'Please do not load this page directly. Thanks!', 'giornalismo' ) );
 
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'giornalismo' ); ?></p>
	<?php
		return;
	}
?>
<?php if ( have_comments() ) : ?>
	<h3 class="comments"><?php comments_number( __( 'No Responses', 'giornalismo' ), __( 'One Response', 'giornalismo' ), __( '% Responses', 'giornalismo' ) );?> <?php __( 'to' ,'giornalismo' ); ?> &#8220;<?php the_title(); ?>&#8221;</h3>
	<ol class="commentlist">
		<?php wp_list_comments( 'type=comment&callback=giornalismo_advanced_comment' );
                ?>
	</ol>
	<div class="clear"></div>
	<div class="comment-navigation">
		<div class="older"><?php previous_comments_link() ?></div>
		<div class="newer"><?php next_comments_link() ?></div>
	</div>
 <?php else : ?>
	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else :?>
		<!-- If comments are closed. -->
	<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
<div class="respond">
<?php comment_form(); ?>
</div>
<?php endif; ?>