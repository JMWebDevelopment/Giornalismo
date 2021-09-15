<?php
/**
 * Template part for displaying the date
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( esc_attr( get_theme_mod( 'giornalismo-todays-date' ) ) ) {
	?>
	<div class="date-container">
		<div class="todays-date"><p><?php echo esc_html( date_i18n( get_option( 'date_format' ) ) ); ?></p></div>
	</div>
	<?php
}
