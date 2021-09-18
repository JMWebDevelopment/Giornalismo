<?php
/**
 * WP_Rig\WP_Rig\Archive\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Archive;

use WP_Rig\WP_Rig\Component_Interface;
use WP_Rig\WP_Rig\Templating_Component_Interface;
use WP_Post;
use function add_action;
use function add_filter;
use function register_nav_menus;
use function esc_html__;
use function has_nav_menu;
use function wp_nav_menu;

/**
 * Class for managing navigation menus.
 *
 * Exposes template tags:
 * * `wp_rig()->is_primary_nav_menu_active()`
 * * `wp_rig()->display_primary_nav_menu( array $args = array() )`
 */
class Component implements Component_Interface, Templating_Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'archive';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'excerpt_more', array( $this, 'edit_read_more' ) );
		add_action( 'template_include', array( $this, 'change_page_two' ) );
		add_action( 'get_the_archive_title', array( $this, 'archive_title' ) );
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `wp_rig()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags() : array {
		return array();
	}

	public function edit_read_more( $more ) {
		return '...';
	}

	public function change_page_two( $template ) {
		if ( is_front_page() && is_paged() ) {
			$template = locate_template( array( 'index.php' ) );
		}
		return $template;
	}

	public function archive_title( $title ) {
		if ( is_day() ) {
			$title = esc_html__( 'Archives for ', 'wp-rig' ) . get_the_date( get_option( 'date_format' ) );
		} elseif ( is_month() ) {
			$title = esc_html__( 'Archives for ', 'wp-rig' ) . get_the_time( 'F Y' );
		} elseif ( is_year() ) {
			$title = esc_html__( 'Archives for ', 'wp-rig' ) . get_the_time( 'Y' );
		} elseif ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search results for ', 'wp-rig' ) . get_search_query();
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = get_the_author();
		} else {
			$page  = get_query_var( 'paged' );
			$title = esc_html__( 'Page ', 'wp-rig' ) . $page;
		}
		return $title;
	}
}
