<?php
/**
* Functions.php
*
* This is the functions.php file. Custom functions referenced in the theme templates are defined here.
*
* @author Jacob Martella
* @package Giornalismo
* @version 1.5
*
* Table of Contents
* I. Theme Setup Functions
* II. Header Functions
* III. Single Post Functions
* IV. Archive Functions
* V. Comments Functions
* VI. Author Functions
* VII. Staff Functions
*/

/**
* I. Theme Setup Functions
*/

//* Set up the theme after it's installed and activated
function giornalismo_setup_theme() {
	register_nav_menus(
		array(
			'top-menu' 	=> __( 'Top Menu', 'giornalismo' ),
			'main-menu' => __( 'Main Menu', 'giornalismo' )
		)
	);

	//* Add Support for Custom Header
	$args = array(
		'flex-width' 			=> true,
		'width'					=> 530,
		'flex-height'			=> true,
		'height'				=> 150,
		'default-image' 		=> '',
		'default-text-color' 	=> '777777',
		'upload'				=> true,
	);
	add_theme_support( 'custom-header', $args );

	//* Add Support for Featured Images
	add_theme_support( 'post-thumbnails', array( 'post' ) );

	//* Add support for editor styles
	add_editor_style();

	//* Add Support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );

	//* Add in the text domain
	load_theme_textdomain( 'giornalismo', get_template_directory() . '/languages' );

	//* Load the file to show the recommended plugins
	require_once( get_template_directory() . '/admin/class-tgm-plugin-activation.php' );

  //* Set the content width
  if ( ! isset( $content_width ) ) $content_width = 640;

  //* Add Support for Title Tag
  add_theme_support( 'title-tag' );

  //* Add the needed image sizes
  add_image_size( 'giornalismo-single', 735, 440, true );
}
add_action ( 'after_setup_theme', 'giornalismo_setup_theme' );

/**
* Returns a custom read more link when the_excerpt() is used. This function is used in conjunction with the excerpt_more WordPress hook.
*
* @return string, the text to be displayed for the read more link
*/
function giornalismo_read_more( $more ) {
	return '<div class="read-more"><a href="' . get_the_permalink( get_the_ID() ) . '">' . __( 'Continue Reading&rsaquo;&rsaquo;', 'giornalismo' ) . '</a></div>';
}
add_action( 'excerpt_more', 'giornalismo_read_more' );

/**
* Register the sidebars
*/
function giornalismo_sidebars() {
	register_sidebar( array(
		'name'			=> __( 'Left Sidebar', 'giornalismo' ),
		'id' 			=> 'left_sidebar',
		'before_widget' => '<div id="widget-wrap">',
		'after_widget' 	=> '</p> </div>',
		'before_title' 	=> '<div class="widget-title"><h3>',
		'after_title' 	=> '</h3></div><p class="widget-body">'
	) );

	register_sidebar(array(
		'name'			=> __( 'Right Sidebar', 'giornalismo' ),
		'id' 			=> 'right_sidebar',
		'before_widget' => '<div id="widget-wrap">',
		'after_widget' 	=> '</p> </div>',
		'before_title' 	=> '<div class="widget-title"><h3>',
		'after_title' 	=> '</h3></div><p class="widget-body">'
	));

  register_sidebar(array(
    'name'			=> __( 'Header Widget Area', 'giornalismo' ),
    'id' 			=> 'header_widget_area',
    'description' 	=> __( 'Use this area to display an ad in the header area.', 'giornalismo' ),
    'before_widget' => '<div class="widget-wrap">',
    'after_widget' 	=> '</p> </div>',
    'before_title' 	=> '<div class="widget-title"><h3>',
    'after_title' 	=> '</h3></div><p class="widget-body">'
  ));
}
add_action( 'widgets_init', 'giornalismo_sidebars' );

/**
* Load the theme options
*/
require_once( get_template_directory() . '/admin/theme-options.php' );

/**
* Load the necessary scripts
*/
function giornalismo_enqueue_scripts() {
  wp_enqueue_style( 'giornalismo-stylesheet', get_template_directory_uri() . '/style.css' );
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( esc_attr( get_theme_mod( 'giornalismo-layout' ) ) == 'left-sidebar' ) {
		wp_enqueue_style( 'giornalismo-left-sidebar', get_template_directory_uri() . '/css/left-sidebar.css' );
	}
	wp_register_style( 'giornalismo-lato', '//fonts.googleapis.com/css?family=Lato:100,300,400,700' );
	wp_enqueue_style( 'giornalismo-lato'  );
	wp_register_style( 'giornalismo-oswald', '//fonts.googleapis.com/css?family=Oswald&subset=latin,latin-ext' );
	wp_enqueue_style( 'giornalismo-oswald' );
	wp_register_style( 'giornalismo-roboto', '//fonts.googleapis.com/css?family=Roboto:400,300,700' );
	wp_enqueue_style( 'giornalismo-roboto' );
	wp_register_style( 'giornalismo-source-sans', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' );
	wp_enqueue_style( 'giornalismo-source-sans-sans' );
	wp_register_style( 'giornalismo-quattrocento', '//fonts.googleapis.com/css?family=Quattrocento:700' );
	wp_enqueue_style( 'giornalismo-quattrocento' );
	wp_enqueue_script( 'giornalismo-jquery' );
	wp_enqueue_script( 'giornalismo-jquery-ui-core' );
    wp_register_script( 'giornalismo-mobile-nav', get_template_directory_uri() . '/js/mobile-nav.js', array('jquery') );
    wp_enqueue_script( 'giornalismo-mobile-nav' );
    wp_register_script( 'giornalismo-mobile-sidebar', get_template_directory_uri() . '/js/mobile-sidebar.js', array('jquery') );
    wp_enqueue_script( 'giornalismo-mobile-sidebar' );
	wp_register_style( 'giornalismo-mobile-css', get_template_directory_uri() . '/css/mobile.css' );
	wp_enqueue_style( 'giornalismo-mobile-css' );
	wp_register_style( 'giornalismo-tablet-css', get_template_directory_uri() . '/css/tablet.css' );
	wp_enqueue_style( 'giornalismo-tablet-css' );
    if ( esc_attr( get_theme_mod( 'giornalismo-layout' ) ) == 'two-sidebars' ) {
        wp_enqueue_style( 'giornalismo-two-sidebars', get_template_directory_uri() . '/css/two-sidebars.css' );
    }
	if ( esc_attr( get_theme_mod( 'giornalismo-color-theme' ) == 'red' ) ) {
		wp_enqueue_style( 'giornalismo-red-theme', get_template_directory_uri() . '/css/red.css' );
	} elseif ( esc_attr( get_theme_mod( 'giornalismo-color-theme' ) == 'green' ) ) {
		wp_enqueue_style( 'giornalismo-green-theme', get_template_directory_uri() . '/css/green.css' );
	} elseif ( esc_attr( get_theme_mod( 'giornalismo-color-theme' ) == 'blue' ) ) {
		wp_enqueue_style( 'giornalismo-blue-theme', get_template_directory_uri() . '/css/blue.css' );
	} elseif ( esc_attr( get_theme_mod( 'giornalismo-color-theme' ) == 'purple' ) ) {
		wp_enqueue_style( 'giornalismo-purple-theme', get_template_directory_uri() . '/css/purple.css' );
	}

}
add_action( 'wp_enqueue_scripts', 'giornalismo_enqueue_scripts', 1 );

/**
* For use to show the recommended plugins for Giornalismo.
*/
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function giornalismo_register_required_plugins() {
    $plugins = array(
        array(
            'name'      => 'JM Breaking News',
            'slug'      => 'jm-breaking-news',
            'required'  => false,
        ),
        array(
            'name'      => 'Extra User Details',
            'slug'      => 'extra-user-details',
            'required'  => false,
        ),
        array(
            'name'      => 'Story Lines',
            'slug'      => 'story-lines',
            'required'  => false,
        )
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'giornalismo_register_required_plugins' );

/**
 * Returns the location of the custom index template
 *
 * @return string, path to custom index template
 */
function giornalismo_change_page_two( $template ){
    if( is_front_page() && is_paged() ){
        $template = locate_template( array( 'index.php' ) );
    }
    return $template;
}
add_action( 'template_include','giornalismo_change_page_two' );

/**
* II. Header Functions
*/

/**
* Returns social links and images based on theme options
* 
* Goes through the social media theme options and adds an image and a link to that social media site if there is an option value for it
* @return string, the images and links for each social media site
*/
if (!function_exists('giornalismo_social_media_links')) {
	function giornalismo_social_media_links() {
		$html = '';
		$html = '<section class="social-area clearfix">';
		if ( esc_attr( get_theme_mod( 'giornalismo-facebook' ) ) != '' ) {
			$html .= '<span class="facebook-social giornalismo-social-link"><a href="' . esc_url( get_theme_mod( 'giornalismo-facebook' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/facebook.png" width="40px" /><span>' . get_bloginfo( 'name' ) . __( ' on Facebook', 'giornalismo' ) . '</span></a></span>';
		}
		if ( esc_attr( get_theme_mod( 'giornalismo-twitter' ) ) != '' ) {
			$html .= '<span class="twitter-social giornalismo-social-link"><a href="' . esc_url( get_theme_mod( 'giornalismo-twitter' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/twitter.png" width="40" /><span>' . get_bloginfo( 'name' ) . __( ' on Twitter', 'giornalismo' ) . '</span></a></span>';
		}
		if ( esc_attr( get_theme_mod( 'giornalismo-google-plus' ) ) != '' ) {
			$html .= '<span class="google-plus-social giornalismo-social-link"><a href="' . esc_url( get_theme_mod( 'giornalismo-google-plus' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/googleplus.png" width="40" /><span>' . get_bloginfo( 'name' ) . __( ' on Google+', 'giornalismo' ) . '</span></a></span>';
		}
		if ( esc_attr( get_theme_mod( 'giornalismo-youtube' ) ) != '' ) {
			$html .= '<span class="youtube-social giornalismo-social-link"><a href="' . esc_url( get_theme_mod( 'giornalismo-youtube' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/youtube.png" width="40" /><span>' . get_bloginfo( 'name' ) . __( ' on YouTube', 'giornalismo' ) . '</span></a></span>';
		}
		if ( esc_attr( get_theme_mod( 'giornalismo-linkedin' ) ) != '' ) {
			$html .= '<span class="linkedin-social giornalismo-social-link"><a href="' . esc_url( get_theme_mod( 'giornalismo-linkedin' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/linkedin.png" width="40" /><span>' . get_bloginfo( 'name' ) . __( ' on LinkedIn', 'giornalismo' ) . '</span></a></span>';
		}
		if ( esc_attr( get_theme_mod( 'giornalismo-tumblr' ) ) != '' ) {
			$html .= '<span class="tumblr-social giornalismo-social-link"><a href="' . esc_url( get_theme_mod( 'giornalismo-tumblr' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/tumblr.png" width="40" /><span>' . get_bloginfo( 'name' ) . __( ' on Tumblr', 'giornalismo' ) . '</span></a></span>';
		}
		if ( esc_attr( get_theme_mod( 'giornalismo-instagram' ) ) != '' ) {
			$html .= '<span class="instagram-social giornalismo-social-link"><a href="' . esc_url( get_theme_mod( 'giornalismo-instagram' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/instagram.png" width="40" /><span>' . get_bloginfo( 'name' ) . __( ' on Instagram', 'giornalismo' ) . '</span></a></span>';
		}
		if ( esc_attr( get_theme_mod( 'giornalismo-pinterest' ) ) != '' ) {
			$html .= '<span class="pinterest-social giornalismo-social-link"><a href="' . esc_url( get_theme_mod( 'giornalismo-pinterest' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/pinterest.png" width="40" /><span>' . get_bloginfo( 'name' ) . __( ' on Pinterest', 'giornalismo' ) . '</span></a></span>';
		}
		if ( esc_attr( get_theme_mod( 'giornalismo-rss-feed' ) ) != '' ) {
			$html .= '<span class="rss-social giornalismo-social-link"><a href="' . esc_url( get_theme_mod( 'giornalismo-rss-feed' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/rss.png" width="40" /><span>' . __( 'RSS Feed', 'giornalismo' ) . '</span></a></span>';
		} else {
			$html .= '<span class="rss-social giornalismo-social-link"><a href="' . get_feed_link( 'rss' ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/rss.png" width="40" /><span>' . __( 'RSS Feed', 'giornalismo' ) . '</span></a></span>';
		}
		$html .= '</section>';

		return $html;
	}
}

/**
* Returns the HTML for the breadcrumbs if the theme user wants
*
* @return string, HTML for breadcrumbs
*/
if ( ! function_exists( 'giornalismo_breadcrumbs' ) ) {
// Add function for Breadcrumbs
	function giornalismo_breadcrumbs() {
		global $post;
		$html = '<ul class="breadcrumbs">';
		if ( ! is_home() ) {
			$html .= '<li><a href="';
			$html .= esc_url( get_home_url() );
			$html .= '">';
			$html .= __( 'Home', 'giornalismo' );
			$html .= '</a></li>';
			if ( is_category() ) {
				$cat = get_the_category();
				$html .= '<li class="breadcrumbs-active .category-' . $cat[ 0 ]->slug . '">';
				$html .= single_cat_title( '', false );
				$html .= '</li>';
			} elseif ( is_single() ) {
				$cat = get_the_category();
				$html .= '<li class="breadcrumbs-active .category-' . $cat[ 0 ]->slug . '"><a href="/index.php?cat=' . $cat[ 0 ]->term_id . '">' . $cat[ 0 ]->name . '</a></li>';
				$html .= '<li class="breadcrumbs-active .category-' . $cat[ 0 ]->slug . '">';
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
				$html .= '<li class="breadcrumbs-active">' . __( 'Author Archive: ', 'giornalismo' );
				$html .= get_the_author_meta( 'display_name' );
				$html .= '</li>';
			} elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) {
				$html .= '<li class="breadcrumbs-active">' . __( 'Blog Archives', 'giornalismo' );
				$html .= '</li>';
			} elseif ( is_search() ) {
				$html .= '<li class="breadcrumbs-active">' . __( 'Search Results: ', 'giornalismo' );
				get_search_query();
				$html .= '</li>';
			} elseif ( is_page_template( 'page-staff-page.php' ) ) {
				$html .= '<li class="breadcrumbs-active">' . __( 'Staff', 'giornalismo' ) . '</li>';
			}
		}
		$html .= '</ul>';

		return $html;
	}
}

/**
* Returns the HTML for the masthead
*
* @return string, HTML for the masthead
*/
if ( ! function_exists( 'giornalismo_header' ) ) {
	function giornalismo_header() {
		$html = '<section class="masthead">';
		if ( get_header_image() ) {
			$html .= '<a href="' . esc_url( get_home_url() ) . '"><img src="' . get_header_image() . '" height="' . get_custom_header()->height . '" width="' . get_custom_header()->width . '" alt="" /></a>';
		} else {
			$html .= '<h1 class="site-title"><a href="' . esc_url( get_home_url() ) . '">' . get_bloginfo( 'name' ) . '</a></h1>';
			$html .= '<h2 class="site-description"><a href="' . esc_url( get_home_url() ) . '">' . get_bloginfo( 'description' ) . '</a></h2>';
		}
		$html .= '</section>';

		return $html;
	}
}

/**
* Returns the day's date in HTML if the theme user has the option selected
*
* @return string, the day's date in HTML
*/
if ( ! function_exists( 'giornalismo_todays_date' ) ) {
	function giornalismo_todays_date() {
		if ( esc_attr( get_theme_mod( 'giornalismo-todays-date' ) ) ) {
			return '<div class="todays-date"><h3>' . date_i18n( get_option( 'date_format' ) ) . '</h3></div>';
		}
	}
}

/**
* III. Single Functions
*/

/**
* Returns the HTML for the story lines section of the single post
*
* @return string, HTML and text for the story lines section
*/
if ( ! function_exists( 'giornalismo_story_lines' ) ) {
	function giornalismo_story_lines() {
		$html = "";
		if ( get_post_meta( get_the_ID(), 'giornalismo_highlight_one', true ) or get_post_meta( get_the_ID(), 'giornalismo_highlight_two', true ) or get_post_meta( get_the_ID(), 'giornalismo_highlight_three', true ) ) {
			$story_line_one   = get_post_meta( get_the_ID(), 'giornalismo_highlight_one', true );
			$story_line_two   = get_post_meta( get_the_ID(), 'giornalismo_highlight_two', true );
			$story_line_three = get_post_meta( get_the_ID(), 'giornalismo_highlight_three', true );
			$html .= '<aside class="story-lines">';
			$html .= '<ul class="story-lines-list">';
			$html .= '<h5 class="title">' . __( 'Story Highlights', 'giornalismo' ) . '</h5>';
			if ( $story_line_one != '' ) {
				$html .= '<li>' . $story_line_one . '</li>';
			}
			if ( $story_line_two != '' ) {
				$html .= '<li>' . $story_line_two . '</li>';
			}
			if ( $story_line_three != '' ) {
				$html .= '<li>' . $story_line_three . '</li>';
			}
			$html .= '</ul>';
			$html .= '</aside>';
		}

		return $html;
	}
}

/**
* Returns the HTML for the related stories section of the single post
*
* @return string, HTML for the related stories section
*/
if ( ! function_exists( 'giornalismo_related_stories' ) ) {
	function giornalismo_related_stories( $id ) {
		$html = "";
		if ( esc_attr( get_theme_mod( 'giornalismo-related-stories' ) ) == 1 ) {
			$tags = wp_get_post_tags( $id );
			if ( $tags ) {
				$first_tag       = $tags[ 0 ]->term_id;
				$args            = array(
						'tag__in'             => array( $first_tag ),
						'post__not_in'        => array( $id ),
						'showposts'           => 3,
						'ignore_sticky_posts' => 1
				);
				$related_stories = new WP_Query( $args );
				if ( $related_stories->have_posts() ) :
					$html .= '<section class="related-stories clearfix">';
					$html .= '<h3 class="title">' . __( 'Related Stories', 'giornalismo' ) . '</h3>';
					while ( $related_stories->have_posts() ) : $related_stories->the_post();
						$html .= '<article class="story">';
						if ( has_post_thumbnail() ) {
							$html .= '<div class="photo"><a href="' . get_the_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), 'giornalismo-single' ) . '</a></div>';
						}
						$html .= '<h5 class="headline"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h5>';
						$html .= '</article>';
					endwhile;
					$html .= '</section>';
				endif;
				wp_reset_postdata();
			}
		}

		return $html;
	}
}

/**
* Returns the HTML for the latest stories section of the single post
*
* @return string, HTML for the latest stories section
*/
if ( ! function_exists( 'giornalismo_latest_stories' ) ) {
	function giornalismo_latest_stories( $category ) {
		$html = '';
		if ( esc_attr( get_theme_mod( 'giornalismo-latest-stories' ) ) == 1 ) {
			$cat_name = $category[ 0 ]->cat_name;
			$id       = get_the_ID();
			$html .= '<section class="latest-category clearfix">';
			$html .= '<h3 class="title">' . __( 'More Stories From ', 'giornalismo' ) . $cat_name . '</h3>';
			$latest_stories_args = array(
					'posts_per_page' => 3,
					'category_name'  => $cat_name,
					'post__not_in'   => array( $id ),
					'orderby'        => 'date',
					'order'          => 'DES'
			);
			$latest_stories      = new WP_Query( $latest_stories_args );
			if ( $latest_stories->have_posts() ) : while ( $latest_stories->have_posts() ) : $latest_stories->the_post();
				$html .= '<article class="story">';
				if ( has_post_thumbnail() ) {
					$html .= '<div class="photo"><a href="' . get_the_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), 'giornalismo-single' ) . '</a></div>';
				}
				$html .= '<h5 class="headline"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h5>';
				$html .= '</article>';
			endwhile;
			endif;
			$html .= '</section>';
			wp_reset_postdata();
		}

		return $html;
	}
}

/**
* Returns the HTML for the author bio area on the single post
*
* @return string, HTML for the author bio area
*/
if ( ! function_exists( 'giornalismo_author_bio' ) ) {
	function giornalismo_author_bio() {
		$html = '';
		if ( get_theme_mod( 'giornalismo-author-bio' ) == 1 ) {
			$html = '<section class="author-bio clearfix">';
			if ( get_avatar( get_the_author_meta( 'email' ) ) ) {
				$html .= '<div class="mug-shot">' . get_avatar( get_the_author_meta( 'email' ), $size = 96 ) . '</div>';
			}
			if ( esc_attr( get_theme_mod( 'giornalismo-author-position' ) ) ) {
				$position = ', ' . get_the_author_meta( 'author-position' );
			} else {
				$position = '';
			}
			$html .= '<h3 class="title">' . __( 'About ', 'giornalismo' ) . get_the_author_meta( 'display_name' ) . $position . '</h3>';
			$html .= '<p class="bio">' . get_the_author_meta( 'description' ) . '</p>';
			$html .= giornalismo_author_social_area();
			$html .= '</section>';
		}

		return $html;
	}
}

/**
* IV. Archive Functions
*/
/**
* Returns the custom output for the archive page titles using the get_the_archive_title filter.
*
* @return string, HTML for archive page title
*/
function giornalismo_archive_title( $title ) {
  if ( is_day() ) {
    $title = __( 'Archives for ', 'giornalismo' ) . get_the_date( get_option( 'date_format' ) );
  }
  else if ( is_month() ) {
    $title = __('Archives for ', 'giornalismo' ) . get_the_time( 'F Y' );
  }
  else if ( is_year() ) {
    $title = __( 'Archives for ', 'giornalismo' ) . get_the_time( 'Y' );
  } 
  else if ( is_category() ) {
    $title = single_cat_title( '', false );
  }
  else if ( is_search() ) {
    $title = __( 'Search results for ', 'giornalismo' ) . get_search_query();
  }
  else if ( is_tag() ) {
    $title = single_tag_title( '', false );
  }
  else {
    $page = get_query_var( 'paged' );
    $title = __( 'Page ', 'giornalismo' ) . $page;
  }
  return $title;
}
add_filter( 'get_the_archive_title', 'giornalismo_archive_title');

/**
* V. Comments Functions
*/

/**
* Sets up the custom comments template
*/
function giornalismo_advanced_comment( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
 
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div class="comment-author vcard">
     <?php echo get_avatar( $comment,$size='48' ); ?>
       <div class="comment-meta"<a href="<?php the_author_meta( 'user_url'); ?>"><?php printf( __( '%s', 'giornalismo' ), get_comment_author_link() ) ?></a></div>
       <small><?php printf( __( '%1$s at %2$s', 'giornalismo' ), get_comment_date(),  get_comment_time() ) ?><?php edit_comment_link( __( '(Edit)', 'giornalismo' ),'  ','' ) ?></small>
     </div>
     <div class="clear"></div>
 
     <?php if ( $comment->comment_approved == '0' ) : ?>
       <em><?php _e( 'Your comment is awaiting moderation.', 'giornalismo' ) ?></em>
       <br />
     <?php endif; ?>
 
     <div class="comment-text">	
         <?php comment_text() ?>
     </div>
 
   <div class="reply">
      <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ) ) ) ?>
   </div>
   <div class="clear"></div>
</li>
<?php }

/**
* VI. Author Functions
*/
/**
* Returns the HTML for the social media area for the post author.
*
* @return string, images and links for social media
*/
if ( ! function_exists( 'giornalismo_author_social_area' ) ) {
	function giornalismo_author_social_area() {
		$html = '<div class="author-social-area">';
		if ( get_the_author_meta( 'facebook' ) ) {
			$html .= '<div class="author-social"><a href="' . esc_url( get_the_author_meta( 'facebook' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/facebook.png" /></a></div>';
		}
		if ( get_the_author_meta( 'twitter-link' ) ) {
			$html .= '<div class="author-social"><a href="' . esc_url( get_the_author_meta( 'twitter-link' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/twitter.png" /></a></div>';
		}
		if ( get_the_author_meta( 'google-plus' ) ) {
			$html .= '<div class="author-social"><a href="' . esc_url( get_the_author_meta( 'google-plus' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/googleplus.png" /></a></div>';
		}
		if ( esc_url( get_the_author_meta( 'email' ) ) ) {
			$html .= '<div class="author-social"><a href="mailto:' . get_the_author_meta( 'email' ) . '"><img src="' . get_template_directory_uri() . '/images/email.png" /></a></div>';
		}
		$html .= '</div>';

		return $html;
	}
}

/**
* Returns the HTML for the author's byline.
*
* @return string, text and links for author's byline
*/
if ( ! function_exists ( 'giornalismo_author_byline' ) ) {
	function giornalismo_author_byline()
	{
		if ( esc_attr( get_theme_mod( 'giornalismo-twitter-handle' ) == 1) and ( get_the_author_meta( 'twitter-handle' ) ) ) {
			$html = __( 'Written by ', 'giornalismo' ) . '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author_meta( 'display_name' ) . '</a>, <a href="' . get_the_author_meta( 'twitter-link' ) . ' target="_blank">' . get_the_author_meta( 'twitter-handle' ) . '</a>, ';
		} else {
			$html = __( 'Written by ', 'giornalismo' ) . '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author_meta( 'display_name' ) . '</a>, ';
		}
		return $html;
	}
}

/**
* VII. Staff Functions
*/

/**
* Returns the code for the staff page
*
* @return string, HTML for staff page
*/
if ( ! function_exists( 'giornalismo_staff' ) ) {
	function giornalismo_staff() {
		$giornalismo_writer = get_users( array( 'orderby' => 'menu_order', 'order' => 'DESC' ) );
		$html               = "";
		foreach ( $giornalismo_writer as $writer ) {
			$html .= '<div class="writer">';
			$html .= '<div class="photo-area">';
			if ( get_avatar( get_the_author_meta( 'email', $writer->ID ) ) ) {
				$html .= '<div class="photo">' . get_avatar( get_the_author_meta( 'email', $writer->ID ), $size = 96 ) . '</div>';
			}
			$html .= '</div>';
			if ( esc_attr( get_theme_mod( 'giornalismo-author-position' ) ) ) {
				$position = ' &#8212; ' . get_the_author_meta( 'author-position', $writer->ID );
			} else {
				$position = '';
			}
			$html .= '<h3 class="name-title"><a href="' . esc_url( get_author_posts_url( $writer->ID ) ) . ' ">' . $writer->display_name . $position . '</a></h3>';
			$html .= '<p class="bio">' . get_the_author_meta( 'description', $writer->ID ) . '</p>';
			$html .= giornalismo_staff_author_social_area( $writer->ID );
			$html .= '</div>';
		}

		return $html;
	}
}

/**
* Returns the HTML for the social media area for the post author.
*
* @return string, images and links for social media
*/
if ( ! function_exists( 'giornalismo_staff_author_social_area' ) ) {
	function giornalismo_staff_author_social_area( $id ) {
		$html = '<div class="author-social-area">';
		if ( get_the_author_meta( 'facebook', $id ) ) {
			$html .= '<div class="author-social"><a href="' . esc_url( get_the_author_meta( 'facebook', $id ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/facebook.png" /></a></div>';
		}
		if ( get_the_author_meta( 'twitter-link', $id ) ) {
			$html .= '<div class="author-social"><a href="' . esc_url( get_the_author_meta( 'twitter-link', $id ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/twitter.png" /></a></div>';
		}
		if ( get_the_author_meta( 'google-plus', $id ) ) {
			$html .= '<div class="author-social"><a href="' . esc_url( get_the_author_meta( 'google-plus', $id ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/googleplus.png" /></a></div>';
		}
		if ( get_the_author_meta( 'email', $id ) ) {
			$html .= '<div class="author-social"><a href="mailto:' . get_the_author_meta( 'email', $id ) . '"><img src="' . get_template_directory_uri() . '/images/email.png" /></a></div>';
		}
		$html .= '</div>';

		return $html;
	}
}
?>