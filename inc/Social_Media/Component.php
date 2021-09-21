<?php
/**
 * WP_Rig\WP_Rig\Social_Media\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Social_Media;

use WP_Rig\WP_Rig\Component_Interface;
use WP_Rig\WP_Rig\Templating_Component_Interface;
use function add_action;
use function add_filter;
use function register_sidebar;
use function esc_html__;
use function is_active_sidebar;
use function dynamic_sidebar;

/**
 * Class for managing sidebars.
 *
 * Exposes template tags:
 * * `wp_rig()->is_primary_sidebar_active()`
 * * `wp_rig()->display_primary_sidebar()`
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/
 */
class Component implements Templating_Component_Interface, Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'social-media';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {

	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `wp_rig()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags() : array {
		return [
			'social_media_links' => [ $this, 'social_media_links' ],
		];
	}

	/**
	 * Displays social media links for the site.
	 *
	 * @since 2.0.0
	 *
	 * @return string      The HTML for the social media section.
	 */
	public function social_media_links() {
		$html = '<div class="social-links">';
		if ( esc_attr( get_theme_mod( 'giornalismo-facebook' ) ) ) {
			$html .= '<a href="' . esc_url( get_theme_mod( 'giornalismo-facebook' ) ) . '" target="_blank"><span class="fab fa-facebook-f"><span class="screen-reader-text">' . esc_html__( 'Facebook Profile', 'wp-rig' ) . '</span></span></a>';
		}
		if ( esc_attr( get_theme_mod( 'giornalismo-twitter' ) ) ) {
			$html .= '<a href="' . esc_url( get_theme_mod( 'giornalismo-twitter' ) ) . '" target="_blank"><span class="fab fa-twitter"><span class="screen-reader-text">' . esc_html__( 'Twitter Profile', 'wp-rig' ) . '</span></span></a>';
		}
		if ( esc_attr( get_theme_mod( 'giornalismo-youtube' ) ) ) {
			$html .= '<a href="' . esc_url( get_theme_mod( 'giornalismo-youtube' ) ) . '" target="_blank"><span class="fab fa-youtube"><span class="screen-reader-text">' . esc_html__( 'YouTube Channel', 'wp-rig' ) . '</span></span></a>';
		}
		if ( esc_attr( get_theme_mod( 'giornalismo-tumblr' ) ) ) {
			$html .= '<a href="' . esc_url( get_theme_mod( 'giornalismo-tumblr' ) ) . '" target="_blank"><span class="fab fa-tumblr"><span class="screen-reader-text">' . esc_html__( 'Tumblr Blog', 'wp-rig' ) . '</span></span></a>';
		}
		if ( esc_attr( get_theme_mod( 'giornalismo-instagram' ) ) ) {
			$html .= '<a href="' . esc_url( get_theme_mod( 'giornalismo-instagram' ) ) . '" target="_blank"><span class="fab fa-instagram"><span class="screen-reader-text">' . esc_html__( 'Facebook Profile', 'wp-rig' ) . '</span></span></a>';
		}
		if ( esc_attr( get_theme_mod( 'giornalismo-rss-feed' ) ) ) {
			$html .= '<a href="' . esc_url( get_theme_mod( 'giornalismo-rss-feed' ) ) . '" target="_blank"><span class="fas fa-rss"><span class="screen-reader-text">' . esc_html__( 'RSS Feed', 'wp-rig' ) . '</span></span></a>';
		} else {
			$html .= '<a href="' . get_feed_link( 'rss' ) . '" target="_blank"><span class="fas fa-rss"><span class="screen-reader-text">' . esc_html__( 'RSS Feed', 'wp-rig' ) . '</span></span></a>';
		}
		$html .= '</div>';
		return $html;
	}
}
