<?php
/**
 * WP_Rig\WP_Rig\Templating_Component_Interface interface
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Colors;

use WP_Rig\WP_Rig\Component_Interface;
use WP_Rig\WP_Rig\Templating_Component_Interface;
use function WP_Rig\WP_Rig\wp_rig;

/**
 * Interface for a theme component that exposes template tags.
 */
class Component implements Component_Interface, Templating_Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'colors';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_filter( 'body_class', array( $this, 'filter_body_classes' ) );
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
			'a11y_text_color'       => [ $this, 'a11y_text_color' ],
			'load_color_stylesheet' => [ $this, 'load_color_stylesheet' ],
		];
	}

	/**
	 * Determines whether to use white or black for a text color based on the background color.
	 *
	 * @since 2.0.0
	 *
	 * @param string $hex_color      The hexidecimal color code for the background.
	 * @return string                The color the text should be.
	 */
	public function a11y_text_color( $hex_color ) {
		$r1 = hexdec( substr( $hex_color, 1, 2 ) );
		$g1 = hexdec( substr( $hex_color, 3, 2 ) );
		$b1 = hexdec( substr( $hex_color, 5, 2 ) );

		$black_color   = '#000000';
		$r2black_color = hexdec( substr( $black_color, 1, 2 ) );
		$g2black_color = hexdec( substr( $black_color, 3, 2 ) );
		$b2black_color = hexdec( substr( $black_color, 5, 2 ) );

		$l1 = 0.2126 * pow( $r1 / 255, 2.2 ) +
				0.7152 * pow( $g1 / 255, 2.2 ) +
				0.0722 * pow( $b1 / 255, 2.2 );

		$l2 = 0.2126 * pow( $r2black_color / 255, 2.2 ) +
			0.7152 * pow( $g2black_color / 255, 2.2 ) +
			0.0722 * pow( $b2black_color / 255, 2.2 );

		$contrast_ratio = 0;
		if ( $l1 > $l2 ) {
			$contrast_ratio = (int) ( ( $l1 + 0.05 ) / ( $l2 + 0.05 ) );
		} else {
			$contrast_ratio = (int) ( ( $l2 + 0.05 ) / ( $l1 + 0.05 ) );
		}

		if ( $contrast_ratio > 5 ) {
			return '#000000';
		} else {
			return '#FFFFFF';
		}
	}

	/**
	 * Loads the selected color scheme if it's not the default.
	 *
	 * @since 2.0.0
	 */
	public function load_color_stylesheet() {
		if ( 'red' === get_theme_mod( 'giornalismo-color-theme' ) ) {
			wp_rig()->print_styles( 'wp-rig-red' );
		} elseif ( 'green' === get_theme_mod( 'giornalismo-color-theme' ) ) {
			wp_rig()->print_styles( 'wp-rig-green' );
		} elseif ( 'blue' === get_theme_mod( 'giornalismo-color-theme' ) ) {
			wp_rig()->print_styles( 'wp-rig-blue' );
		} elseif ( 'purple' === get_theme_mod( 'giornalismo-color-theme' ) ) {
			wp_rig()->print_styles( 'wp-rig-purple' );
		}
	}

	/**
	 * Loads the hexidecimal value for the darker color of a color scheme.
	 *
	 * @since 2.0.0
	 *
	 * @return string      The hexidecimal value for the darker color.
	 */
	public function load_color_hex_code() {
		if ( 'red' === get_theme_mod( 'sports-bench-main-color-theme' ) ) {
			return '#820900';
		} elseif ( 'orange' === get_theme_mod( 'sports-bench-main-color-theme' ) ) {
			return '#ad6800';
		} elseif ( 'yellow' === get_theme_mod( 'sports-bench-main-color-theme' ) ) {
			return '#c4b100';
		} elseif ( 'green' === get_theme_mod( 'sports-bench-main-color-theme' ) ) {
			return '#0c7a00';
		} elseif ( 'blue' === get_theme_mod( 'sports-bench-main-color-theme' ) ) {
			return '#000280';
		} elseif ( 'purple' === get_theme_mod( 'sports-bench-main-color-theme' ) ) {
			return '#4a0061';
		} else {
			return '#000000';
		}
	}

	/**
	 * Adds custom classes to indicate what color theme is being used to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array Filtered body classes.
	 */
	public function filter_body_classes( array $classes ) : array {
		if ( 'red' === get_theme_mod( 'giornalismo-color-theme' ) ) {
			$classes[] = 'has-red-theme';
		} elseif ( 'green' === get_theme_mod( 'giornalismo-color-theme' ) ) {
			$classes[] = 'has-green-theme';
		} elseif ( 'blue' === get_theme_mod( 'giornalismo-color-theme' ) ) {
			$classes[] = 'has-blue-theme';
		} elseif ( 'purple' === get_theme_mod( 'giornalismo-color-theme' ) ) {
			$classes[] = 'has-purple-theme';
		}

		return $classes;
	}
}
