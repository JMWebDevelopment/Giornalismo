<?php
/**
 * WP_Rig\WP_Rig\Single_Post\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Single_Post;

use WP_Rig\WP_Rig\Component_Interface;
use WP_Rig\WP_Rig\Templating_Component_Interface;
use WP_Post;
use WP_Query;
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
		return 'single-post';
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
			'display_story_lines'     => array( $this, 'display_story_lines' ),
			'display_post_navigation' => array( $this, 'display_post_navigation' ),
			'display_related_posts'   => array( $this, 'display_related_posts' ),
			'display_latest_posts'    => array( $this, 'display_latest_posts' ),
			'display_author_bio'      => array( $this, 'display_author_bio' ),
		);
	}

	public function display_story_lines() {
		$html = '';
		if ( get_post_meta( get_the_ID(), 'giornalismo_highlight_one', true ) || get_post_meta( get_the_ID(), 'giornalismo_highlight_two', true ) || get_post_meta( get_the_ID(), 'giornalismo_highlight_three', true ) ) {
			$story_line_one   = get_post_meta( get_the_ID(), 'giornalismo_highlight_one', true );
			$story_line_two   = get_post_meta( get_the_ID(), 'giornalismo_highlight_two', true );
			$story_line_three = get_post_meta( get_the_ID(), 'giornalismo_highlight_three', true );

			$html .= '<aside class="story-lines">';
			$html .= '<h2 class="title">' . esc_html__( 'Story Highlights', 'wp-rig' ) . '</h2>';
			$html .= '<ul class="story-lines-list">';
			if ( '' !== $story_line_one ) {
				$html .= '<li>' . $story_line_one . '</li>';
			}
			if ( '' !== $story_line_two ) {
				$html .= '<li>' . $story_line_two . '</li>';
			}
			if ( '' !== $story_line_three ) {
				$html .= '<li>' . $story_line_three . '</li>';
			}
			$html .= '</ul>';
			$html .= '</aside>';
		}

		return $html;
	}

	public function display_post_navigation() {
		$prev_post = get_previous_post();
		$next_post = get_next_post();
		?>
		<div class="post-navigation clearfix">
			<?php
			if ( $prev_post ) {
				previous_post_link( '<div class="previous-post"><div class="featured-photo">' . get_the_post_thumbnail( $prev_post->ID ) . '</div><h3 class="paginate-title">&laquo;&laquo; %link</h3></div>', '%title' );
			}
			if ( $next_post ) {
				next_post_link( '<div class="next-post"><div class="featured-photo">' . get_the_post_thumbnail( $next_post->ID ) . '</div><h3 class="paginate-title">%link &raquo;&raquo;</h3></div>', '%title' );
			}
			?>
		</div>
		<?php
	}

	public function display_related_posts( $id ) {
		$html = '';
		if ( '1' === esc_attr( get_theme_mod( 'giornalismo-related-stories' ) ) ) {
			$tags = wp_get_post_tags( $id );
			if ( $tags ) {
				$first_tag       = $tags[0]->term_id;
				$args            = array(
					'tag__in'             => array( $first_tag ),
					'post__not_in'        => array( $id ),
					'showposts'           => 3,
					'ignore_sticky_posts' => 1,
				);
				$related_stories = new WP_Query( $args );
				if ( $related_stories->have_posts() ) {
					$html .= '<section class="related-stories">';
					$html .= '<h2>' . esc_html__( 'Related Stories', 'wp-rig' ) . '</h2>';
					while ( $related_stories->have_posts() ) {
						$related_stories->the_post();
						$html .= '<article id="' . get_the_ID() . '" class="' . esc_attr( implode( ' ', get_post_class( 'story' ) ) ) . '">';
						if ( has_post_thumbnail() ) {
							$html .= '<div class="photo"><a href="' . get_the_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), 'giornalismo-single' ) . '</a></div>';
						}
						$html .= '<p class="headline"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></p>';
						$html .= '</article>';
					}
					$html .= '</section>';
				}
				wp_reset_postdata();
			}
		}

		return $html;
	}

	public function display_latest_posts( $category ) {
		$html = '';
		if ( '1' === esc_attr( get_theme_mod( 'giornalismo-latest-stories' ) ) ) {
			$cat_name            = $category[0]->cat_name;
			$id                  = get_the_ID();
			$html               .= '<section class="latest-category clearfix">';
			$html               .= '<h2 class="title">' . esc_html__( 'More Stories From ', 'wp-rig' ) . $cat_name . '</h2>';
			$latest_stories_args = array(
				'posts_per_page' => 3,
				'category_name'  => $cat_name,
				'post__not_in'   => array( $id ),
				'orderby'        => 'date',
				'order'          => 'DES',
			);
			$latest_stories      = new WP_Query( $latest_stories_args );
			if ( $latest_stories->have_posts() ) {
				while ( $latest_stories->have_posts() ) {
					$latest_stories->the_post();
					$html .= '<article id="' . get_the_ID() . '" class="' . esc_attr( implode( ' ', get_post_class( 'story' ) ) ) . '">';
					if ( has_post_thumbnail() ) {
						$html .= '<div class="photo"><a href="' . get_the_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), 'giornalismo-single' ) . '</a></div>';
					}
					$html .= '<p class="headline"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></p>';
					$html .= '</article>';
				}
			}
			$html .= '</section>';
			wp_reset_postdata();
		}

		return $html;
	}

	public function display_author_bio() {
		$html = '';
		if ( get_theme_mod( 'giornalismo-author-bio' ) ) {
			$html .= '<section class="author-bio clearfix">';
			if ( get_avatar( get_the_author_meta( 'email' ) ) ) {
				$html .= '<div class="mug-shot">' . get_avatar( get_the_author_meta( 'email' ), $size = 96 ) . '</div>';
			}
			if ( esc_attr( get_theme_mod( 'giornalismo-author-position' ) ) ) {
				$position = ', ' . get_the_author_meta( 'author-position' );
			} else {
				$position = '';
			}
			$html .= '<div class="author-info">';
			$html .= '<p class="title">' . esc_html__( 'About ', 'wp-rig' ) . get_the_author_meta( 'display_name' ) . $position . '</p>';
			$html .= '<p class="bio">' . get_the_author_meta( 'description' ) . '</p>';
			$html .= $this->author_social_area();
			$html .= '</div>';
			$html .= '</section>';
		}

		return $html;
	}

	public function author_social_area() {
		$html = '<div class="author-social-area">';
		if ( get_the_author_meta( 'facebook' ) ) {
			$html .= '<div class="author-social"><a href="' . esc_url( get_the_author_meta( 'facebook' ) ) . '" target="_blank"><span class="fab fa-facebook-f"><span class="screen-reader-text">' . esc_html__( 'Facebook Profile', 'wp-rig' ) . '</span></span></a></div>';
		}
		if ( get_the_author_meta( 'twitter-link' ) ) {
			$html .= '<div class="author-social"><a href="' . esc_url( get_the_author_meta( 'twitter-link' ) ) . '" target="_blank"><span class="fab fa-twitter"><span class="screen-reader-text">' . esc_html__( 'Twitter Profile', 'wp-rig' ) . '</span></span></div>';
		}
		if ( esc_url( get_the_author_meta( 'email' ) ) ) {
			$html .= '<div class="author-social"><a href="mailto:' . get_the_author_meta( 'email' ) . '"><span class="fal fa-envelope"><span class="screen-reader-text">' . esc_html__( 'Email the Author', 'wp-rig' ) . '</span></span></div>';
		}
		$html .= '</div>';

		return $html;
	}
}
