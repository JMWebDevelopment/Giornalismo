<?php
/**
 * WP_Rig\WP_Rig\Customizer\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Customizer;

use WP_Rig\WP_Rig\Component_Interface;
use function WP_Rig\WP_Rig\wp_rig;
use WP_Customize_Manager;
use function add_action;
use function bloginfo;
use function wp_enqueue_script;
use function get_theme_file_uri;
use function get_theme_file_path;

/**
 * Class for managing Customizer integration.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'customizer';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'customize_register', array( $this, 'action_customize_register' ) );
		add_action( 'customize_preview_init', array( $this, 'action_enqueue_customize_preview_js' ) );
	}

	/**
	 * Adds postMessage support for site title and description, plus a custom Theme Options section.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	public function action_customize_register( WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_panel(
			'giornalismo_main_options',
			array(
				'priority'       => 10,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => esc_html__( 'Sports Bench Main Theme', 'wp-rig' ),
			)
		);

		$wp_customize->add_section(
			'giornalismo_basic_options',
			array(
				'title'    => esc_html__( 'Basic Options', 'wp-rig' ),
				'priority' => 130, // Before Additional CSS.
				'panel'    => 'giornalismo_main_options',
			)
		);

		$wp_customize->add_section(
			'giornalismo_homepage_options',
			array(
				'title'    => esc_html__( 'Homepage Options', 'wp-rig' ),
				'priority' => 130, // Before Additional CSS.
				'panel'    => 'giornalismo_main_options',
			)
		);

		$wp_customize->add_section(
			'giornalismo_social_media_options',
			array(
				'title'    => esc_html__( 'Social Media Options', 'wp-rig' ),
				'priority' => 130, // Before Additional CSS.
				'panel'    => 'giornalismo_main_options',
			)
		);

		/**
		 * Basic options.
		 */

		$wp_customize->add_setting(
			'giornalismo-layout',
			array(
				'default'           => 'right-sidebar',
				'sanitize_callback' => array( $this, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-layout',
			array(
				'label'     => esc_html_e( 'Layout', 'wp-rig' ),
				'section'   => 'giornalismo_basic_options',
				'type'      => 'select',
				'choices'   => array(
					'right-sidebar' => esc_html_e( 'Right Sidebar', 'wp-rig' ),
					'left-sidebar'  => esc_html_e( 'Left Sidebar', 'wp-rig' ),
					'two-sidebars'  => esc_html_e( 'Two Sidebars', 'wp-rig' ),
				),
			)
		);

		$wp_customize->add_setting(
			'giornalismo-color-theme',
			array(
				'default'           => 'right-sidebar',
				'sanitize_callback' => array( $this, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-color-theme',
			array(
				'label'     => esc_html_e( 'Color Theme', 'wp-rig' ),
				'section'   => 'giornalismo_basic_options',
				'type'      => 'select',
				'choices'   => array(
					'default'   => esc_html_e( 'Default', 'wp-rig' ),
					'blue'      => esc_html_e( 'Blue', 'wp-rig' ),
					'green'     => esc_html_e( 'Green', 'wp-rig' ),
					'purple'    => esc_html_e( 'Purple', 'wp-rig' ),
					'red'       => esc_html_e( 'Red', 'wp-rig' ),
				),
			)
		);

		$wp_customize->add_setting(
			'giornalismo-top-menu',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-top-menu',
			array(
				'label'     => esc_html_e( 'Top Menu', 'wp-rig' ),
				'section'   => 'giornalismo_basic_options',
				'type'      => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-todays-date',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-todays-date',
			array(
				'label'     => esc_html_e( 'Show Today\'s Date', 'wp-rig' ),
				'section'   => 'giornalismo_basic_options',
				'type'      => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-author-bio',
			array(
				'default'           => '1',
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-author-bio',
			array(
				'label'     => esc_html_e( 'Display the Author\'s Bio After Posts', 'wp-rig' ),
				'section'   => 'giornalismo_basic_options',
				'type'      => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-author-position',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-author-position',
			array(
				'label'     => esc_html_e( 'Display the Author\'s Position', 'wp-rig' ),
				'section'   => 'giornalismo_basic_options',
				'type'      => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-author-byline',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-author-byline',
			array(
				'label'     => esc_html_e( 'Display the Author\'s Byline', 'wp-rig' ),
				'section'   => 'giornalismo_basic_options',
				'type'      => 'checkbox',
			)
		);

		//* Post Comments
		$wp_customize->add_setting(
			'giornalismo-post-comments',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-post-comments',
			array(
				'label'     => esc_html_e( 'Display the Number of Comments on a Post', 'wp-rig' ),
				'section'   => 'giornalismo_basic_options',
				'type'      => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-breadcrumbs',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-breadcrumbs',
			array(
				'label'     => esc_html_e( 'Display Breadcrumbs', 'wp-rig' ),
				'section'   => 'giornalismo_basic_options',
				'type'      => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-related-stories',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-related-stories',
			array(
				'label'     => esc_html_e( 'Show Related Stories', 'wp-rig' ),
				'section'   => 'giornalismo_basic_options',
				'type'      => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-latest-stories',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-latest-stories',
			array(
				'label'     => esc_html_e( 'Show latest posts from a category on the single post template', 'wp-rig' ),
				'section'   => 'giornalismo_basic_options',
				'type'      => 'checkbox',
			)
		);

		/**
		 * Homepage options.
		 */
		$cats             = get_categories();
		$cat_args['none'] = esc_html_e( 'None', 'wp-rig' );
		foreach ( $cats as $cat ) {
			$cat_args[ $cat->term_id ] = $cat->name;
		}

		$wp_customize->add_setting(
			'giornalismo-top-story-category',
			array(
				'default'           => 'None',
				'sanitize_callback' => array( $this, 'sanitize_category' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-top-story-category',
			array(
				'label'     => esc_html_e( 'Top Story Category', 'wp-rig' ),
				'section'   => 'home',
				'type'      => 'select',
				'choices'   => $cat_args,
			)
		);

		$wp_customize->add_setting(
			'giornalismo-column-one-category',
			array(
				'default'           => 'None',
				'sanitize_callback' => array( $this, 'sanitize_category' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-column-one-category',
			array(
				'label'     => esc_html_e( 'Column One Category', 'wp-rig' ),
				'section'   => 'home',
				'type'      => 'select',
				'choices'   => $cat_args,
			)
		);

		$wp_customize->add_setting(
			'giornalismo-column-one-count',
			array(
				'default'           => '5',
				'sanitize_callback' => array( $this, 'sanitize_num' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-column-one-count',
			array(
				'label'     => esc_html_e( 'Number of Stories in the First Column', 'wp-rig' ),
				'section'   => 'home',
				'type'      => 'text',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-column-two-category',
			array(
				'default'           => 'None',
				'sanitize_callback' => array( $this, 'sanitize_category' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-column-two-category',
			array(
				'label'     => esc_html_e( 'Column Two Category', 'wp-rig' ),
				'section'   => 'home',
				'type'      => 'select',
				'choices'   => $cat_args,
			)
		);

		$wp_customize->add_setting(
			'giornalismo-column-two-count',
			array(
				'default'           => '5',
				'sanitize_callback' => array( $this, 'sanitize_num' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-column-two-count',
			array(
				'label'     => esc_html_e( 'Number of Stories in the Second Column', 'wp-rig' ),
				'section'   => 'home',
				'type'      => 'text',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-column-three-category',
			array(
				'default'           => 'None',
				'sanitize_callback' => array( $this, 'sanitize_category' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-column-three-category',
			array(
				'label'     => esc_html_e( 'Column Three Category', 'wp-rig' ),
				'section'   => 'home',
				'type'      => 'select',
				'choices'   => $cat_args,
			)
		);

		$wp_customize->add_setting(
			'giornalismo-column-three-count',
			array(
				'default'           => '6',
				'sanitize_callback' => array( $this, 'sanitize_num' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-column-three-count',
			array(
				'label'     => esc_html_e( 'Number of Stories in the Third Column', 'wp-rig'  ),
				'section'   => 'home',
				'type'      => 'text',
			)
		);

		/**
		 * Social media options.
		 */
		$wp_customize->add_setting(
			'giornalismo-facebook',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_link' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-facebook',
			array(
				'label'     => esc_html_e( 'Facebook Link', 'wp-rig' ),
				'section'   => 'social',
				'type'      => 'text',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-twitter',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_link' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-twitter',
			array(
				'label'     => esc_html_e( 'Twitter Link', 'wp-rig' ),
				'section'   => 'social',
				'type'      => 'text',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-google-plus',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_link' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-google-plus',
			array(
				'label'     => esc_html_e( 'Google+ Link', 'wp-rig' ),
				'section'   => 'social',
				'type'      => 'text',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-youtube',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_link' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-youtube',
			array(
				'label'     => esc_html_e( 'YouTube Link', 'wp-rig' ),
				'section'   => 'social',
				'type'      => 'text',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-linkedin',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_link' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-linkedin',
			array(
				'label'     => esc_html_e( 'LinkedIn Link', 'wp-rig' ),
				'section'   => 'social',
				'type'      => 'text',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-tumblr',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_link' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-tumblr',
			array(
				'label'     => esc_html_e( 'Tumblr Link', 'wp-rig' ),
				'section'   => 'social',
				'type'      => 'text',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-instagram',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_link' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-instagram',
			array(
				'label'     => esc_html_e( 'Instagram Link', 'wp-rig' ),
				'section'   => 'social',
				'type'      => 'text',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-pinterest',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_link' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-pinterest',
			array(
				'label'     => esc_html_e( 'Pinterest Link', 'wp-rig' ),
				'section'   => 'social',
				'type'      => 'text',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-rss-feed',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_link' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-rss-feed',
			array(
				'label'     => esc_html_e( 'RSS Feed Link', 'wp-rig' ),
				'section'   => 'social',
				'type'      => 'text',
			)
		);

		$wp_customize->add_setting(
			'giornalismo-twitter-handle',
			array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'giornalismo-twitter-handle',
			array(
				'label'     => esc_html_e( 'Show Author\'s Twitter Handle', 'wp-rig' ),
				'section'   => 'social',
				'type'      => 'checkbox',
			)
		);
	}

	/**
	 * Enqueues JavaScript to make Customizer preview reload changes asynchronously.
	 */
	public function action_enqueue_customize_preview_js() {
		wp_enqueue_script(
			'wp-rig-customizer',
			get_theme_file_uri( '/assets/js/customizer.min.js' ),
			array( 'customize-preview' ),
			wp_rig()->get_asset_version( get_theme_file_path( '/assets/js/customizer.min.js' ) ),
			true
		);
	}

	public function giornalismo_sanitize_link( $input ) {
		return esc_url_raw( $input );
	}

	public function giornalismo_sanitize_select( $input, $setting ) {
		$input = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	public function giornalismo_sanitize_checkbox( $input ) {
		return ( ( isset( $input ) && true == $input ) ? 1 : 0 );
	}

	public function giornalismo_sanitize_category( $input, $setting ) {
		$input = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	public function giornalismo_sanitize_num( $input, $setting ) {
		$input = absint( $input );
		return ( $input ? $input : $setting->default );
	}

	public function giornalismo_sanitize_text( $input ) {
		return wp_filter_nohtml_kses( $input );
	}
}
