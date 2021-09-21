<?php
/**
 * Template part for displaying the latest posts section on the single post template
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

echo wp_kses_post( wp_rig()->display_latest_posts( get_the_category() ) );
