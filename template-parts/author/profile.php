<?php
/**
 * Template part for displaying the author bio section in the author archive template
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

the_post();
?>

<div class="archive-author-bio">
	<?php echo wp_kses_post( wp_rig()->display_author_bio() ); ?>
</div>
