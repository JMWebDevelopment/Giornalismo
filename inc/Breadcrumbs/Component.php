<?php
/**
 * WP_Rig\WP_Rig\Breadcrumbs\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Breadcrumbs;

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
		return 'breadcrumbs';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `wp_rig()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags() : array {
		return array(
			'display_breadcrumbs' => array( $this, 'display_breadcrumbs' ),
		);
	}

	/**
	 * Displays the breadcrumbs for a post or page.
	 *
	 * @since 2.0.0
	 *
	 * @return string       The HTML for the breadcrumbs section.
	 */
	public function display_breadcrumbs() {
		global $post;
		$html = '<ul class="breadcrumbs">';
		if ( ! is_home() ) {
			$html .= '<li><a href="';
			$html .= esc_url( get_home_url() );
			$html .= '">';
			$html .= esc_html__( 'Home', 'wp-rig' );
			$html .= '</a></li>';
			if ( is_category() ) {
				$cat   = get_the_category();
				$html .= '<li class="breadcrumbs-active .category-' . $cat[0]->slug . '">';
				$html .= single_cat_title( '', false );
				$html .= '</li>';
			} elseif ( is_single() ) {
				$cat   = get_the_category();
				$html .= '<li class="breadcrumbs-active .category-' . $cat[0]->slug . '"><a href="/index.php?cat=' . $cat[0]->term_id . '">' . $cat[0]->name . '</a></li>';
				$html .= '<li class="breadcrumbs-active .category-' . $cat[0]->slug . '">';
				$html .= get_the_title();
				$html .= '</li>';
			} elseif ( is_page() ) {
				if ( $post->post_parent ) {
					$anc   = get_post_ancestors( $post->ID );
					$title = get_the_title();
					foreach ( $anc as $ancestor ) {
						$output = '<li><a href="' . esc_url( get_permalink( $ancestor ) ) . '" title="' . get_the_title( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li>';
					}
					$html .= $output;
					$html .= '<strong title="' . $title . '"> ' . $title . '</strong>';
				} else {
					$html .= '<li class="breadcrumbs-active"><strong> ' . get_the_title() . '</strong></li>';
				}
			} elseif ( is_tag() ) {
				$html .= '<li class="breadcrumbs-active">';
				single_tag_title( '', false );
				$html .= '</li>';
			} elseif ( is_day() ) {
				$html .= '<li class="breadcrumbs-active">';
				$html .= get_the_date( get_option( 'date_format' ) );
				$html .= '</li>';
			} elseif ( is_month() ) {
				$html .= '<li class="breadcrumbs-active">';
				$html .= get_the_time( 'F Y' );
				$html .= '</li>';
			} elseif ( is_year() ) {
				$html .= '<li class="breadcrumbs-active">';
				$html .= get_the_time( 'Y' );
				$html .= '</li>';
			} elseif ( is_author() ) {
				$html .= '<li class="breadcrumbs-active">' . esc_html__( 'Author Archive: ', 'wp-rig' );
				$html .= get_the_author_meta( 'display_name' );
				$html .= '</li>';
			} elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) {
				$html .= '<li class="breadcrumbs-active">' . esc_html__( 'Blog Archives', 'wp-rig' );
				$html .= '</li>';
			} elseif ( is_search() ) {
				$html .= '<li class="breadcrumbs-active">' . esc_html__( 'Search Results: ', 'wp-rig' );
				$html .= get_search_query();
				$html .= '</li>';
			} elseif ( is_page_template( 'page-staff-page.php' ) ) {
				$html .= '<li class="breadcrumbs-active">' . esc_html__( 'Staff', 'wp-rig' ) . '</li>';
			}
		}
		$html .= '</ul>';

		return $html;
	}
}
