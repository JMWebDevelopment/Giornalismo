<?php
/**
 * Template part for displaying the related posts section on the single post template
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

echo wp_kses_post( wp_rig()->display_related_posts( get_the_ID() ) );
