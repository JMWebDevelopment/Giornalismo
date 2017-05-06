<?php
/**
* Theme-options.php
*
* Theme options file, using the Customizer, for Giornalismo
*
* @author Jacob Martella
* @package Giornalismo
* @version 1.4
*/

//* Create the general settings section
function giornalismo_general_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'general',
        array(
            'title'         => __( 'General Settings', 'giornalismo' ),
            'description'   => __( 'This is the general settings section.', 'giornalismo' ),
            'priority'      => 35,
        )
    );

    //* Layout option
    $wp_customize->add_setting(
   		'giornalismo-layout',
    	array(
        	'default'           => 'right-sidebar',
        	'sanitize_callback' => 'giornalismo_sanitize_select',
    	)
	);

	$wp_customize->add_control(
    	'giornalismo-layout',
    	array(
        	'label'     => __ ( 'Layout', 'giornalismo' ),
        	'section'   => 'general',
        	'type'      => 'select',
        	'choices'   => array(
        		'right-sidebar' => __( 'Right Sidebar', 'giornalismo' ),
        		'left-sidebar'  => __( 'Left Sidebar', 'giornalismo' ),
        		'two-sidebars'  => __( 'Two Sidebars', 'giornalismo' )
        	)
    	)
	);

    //* Layout option
    $wp_customize->add_setting(
        'giornalismo-color-theme',
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'giornalismo_sanitize_select',
        )
    );

    $wp_customize->add_control(
        'giornalismo-color-theme',
        array(
            'label'     => __ ( 'Color Theme', 'giornalismo' ),
            'section'   => 'general',
            'type'      => 'select',
            'choices'   => array(
                'default'   => __( 'Default', 'giornalismo' ),
                'blue'      => __( 'Blue', 'giornalismo' ),
                'green'     => __( 'Green', 'giornalismo' ),
                'purple'    => __( 'Purple', 'giornalismo' ),
                'red'       => __( 'Red', 'giornalismo' )
            )
        )
    );

	//* Top Menu
	$wp_customize->add_setting(
   		'giornalismo-top-menu',
    	array(
        	'default'           => '',
        	'sanitize_callback' => 'giornalismo_sanitize_checkbox',
    	)
	);

	$wp_customize->add_control(
    	'giornalismo-top-menu',
    	array(
        	'label'     => __( 'Top Menu', 'giornalismo' ),
        	'section'   => 'general',
        	'type'      => 'checkbox',
    	)
	);

	//* Today's Date
	$wp_customize->add_setting(
   		'giornalismo-todays-date',
    	array(
        	'default'           => '',
        	'sanitize_callback' => 'giornalismo_sanitize_checkbox',
    	)
	);

	$wp_customize->add_control(
    	'giornalismo-todays-date',
    	array(
        	'label'     => __( 'Show Today\'s Date', 'giornalismo' ),
        	'section'   => 'general',
        	'type'      => 'checkbox',
    	)
	);

    //* Author Bio
    $wp_customize->add_setting(
        'giornalismo-author-bio',
        array(
            'default'           => '1',
            'sanitize_callback' => 'giornalismo_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'giornalismo-author-bio',
        array(
            'label'     => __('Display the Author\'s Bio After Posts', 'giornalismo'),
            'section'   => 'general',
            'type'      => 'checkbox',
        )
    );

    //* Author Position
    $wp_customize->add_setting(
   		'giornalismo-author-position',
    	array(
        	'default'           => '',
        	'sanitize_callback' => 'giornalismo_sanitize_checkbox',
    	)
	);

	$wp_customize->add_control(
    	'giornalismo-author-position',
    	array(
        	'label'     => __( 'Display the Author\'s Position', 'giornalismo' ),
        	'section'   => 'general',
        	'type'      => 'checkbox',
    	)
	);

	//* Author Byline
	$wp_customize->add_setting(
			'giornalismo-author-byline',
			array(
					'default'           => '',
					'sanitize_callback' => 'giornalismo_sanitize_checkbox',
			)
	);

	$wp_customize->add_control(
			'giornalismo-author-byline',
			array(
					'label'     => __('Display the Author\'s Byline', 'giornalismo'),
					'section'   => 'general',
					'type'      => 'checkbox',
			)
	);

	//* Post Comments
	$wp_customize->add_setting(
			'giornalismo-post-comments',
			array(
					'default'           => '',
					'sanitize_callback' => 'giornalismo_sanitize_checkbox',
			)
	);

	$wp_customize->add_control(
			'giornalismo-post-comments',
			array(
					'label'     => __( 'Display the Number of Comments on a Post', 'giornalismo' ),
					'section'   => 'general',
					'type'      => 'checkbox',
			)
	);

    //* Breadcrumbs
    $wp_customize->add_setting(
   		'giornalismo-breadcrumbs',
    	array(
        	'default'           => '',
        	'sanitize_callback' => 'giornalismo_sanitize_checkbox',
    	)
	);

	$wp_customize->add_control(
    	'giornalismo-breadcrumbs',
    	array(
        	'label'     => __( 'Display Breadcrumbs', 'giornalismo' ),
        	'section'   => 'general',
        	'type'      => 'checkbox',
    	)
	);

    //* Show Related Stories
    $wp_customize->add_setting(
        'giornalismo-related-stories',
        array(
            'default'           => '',
            'sanitize_callback' => 'giornalismo_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'giornalismo-related-stories',
        array(
            'label'     => __( 'Show Related Stories', 'giornalismo' ),
            'section'   => 'general',
            'type'      => 'checkbox',
        )
    );

    //* Show Latest Stories
    $wp_customize->add_setting(
        'giornalismo-latest-stories',
        array(
            'default'           => '',
            'sanitize_callback' => 'giornalismo_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'giornalismo-latest-stories',
        array(
            'label'     => __( 'Show latest posts from a category on the single post template', 'giornalismo' ),
            'section'   => 'general',
            'type'      => 'checkbox',
        )
    );
}
add_action( 'customize_register', 'giornalismo_general_customizer' );

//* Create the social media section
function giornalismo_social_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'social',
        array(
            'title'         => __( 'Social Media Settings', 'giornalismo' ),
            'description'   => __( 'This is the social media settings section.', 'giornalismo' ),
            'priority'      => 35,
        )
    );

    //* Facebook
    $wp_customize->add_setting(
   		'giornalismo-facebook',
    	array(
        	'default'           => '',
        	'sanitize_callback' => 'giornalismo_sanitize_link',
    	)
	);

	$wp_customize->add_control(
    	'giornalismo-facebook',
    	array(
        	'label'     => __( 'Facebook Link', 'giornalismo' ),
        	'section'   => 'social',
        	'type'      => 'text',
    	)
	);

	//* Twitter
	$wp_customize->add_setting(
   		'giornalismo-twitter',
    	array(
        	'default' => '',
        	'sanitize_callback' => 'giornalismo_sanitize_link',
    	)
	);

	$wp_customize->add_control(
    	'giornalismo-twitter',
    	array(
        	'label'     => __( 'Twitter Link', 'giornalismo' ),
        	'section'   => 'social',
        	'type'      => 'text',
    	)
	);

	//* Google Plus
	$wp_customize->add_setting(
   		'giornalismo-google-plus',
    	array(
        	'default'           => '',
        	'sanitize_callback' => 'giornalismo_sanitize_link',
    	)
	);

	$wp_customize->add_control(
    	'giornalismo-google-plus',
    	array(
        	'label'     => __( 'Google+ Link', 'giornalismo' ),
        	'section'   => 'social',
        	'type'      => 'text',
    	)
	);

    //* YouTube
    $wp_customize->add_setting(
        'giornalismo-youtube',
        array(
            'default'           => '',
            'sanitize_callback' => 'giornalismo_sanitize_link',
        )
    );

    $wp_customize->add_control(
        'giornalismo-youtube',
        array(
            'label'     => __( 'YouTube Link', 'giornalismo' ),
            'section'   => 'social',
            'type'      => 'text',
        )
    );

    //* LinkedIn
    $wp_customize->add_setting(
        'giornalismo-linkedin',
        array(
            'default'           => '',
            'sanitize_callback' => 'giornalismo_sanitize_link',
        )
    );

    $wp_customize->add_control(
        'giornalismo-linkedin',
        array(
            'label'     => __( 'LinkedIn Link', 'giornalismo' ),
            'section'   => 'social',
            'type'      => 'text',
        )
    );

    //* Tumblr
    $wp_customize->add_setting(
        'giornalismo-tumblr',
        array(
            'default'           => '',
            'sanitize_callback' => 'giornalismo_sanitize_link',
        )
    );

    $wp_customize->add_control(
        'giornalismo-tumblr',
        array(
            'label'     => __( 'Tumblr Link', 'giornalismo' ),
            'section'   => 'social',
            'type'      => 'text',
        )
    );

    //* Instagram
    $wp_customize->add_setting(
        'giornalismo-instagram',
        array(
            'default'           => '',
            'sanitize_callback' => 'giornalismo_sanitize_link',
        )
    );

    $wp_customize->add_control(
        'giornalismo-instagram',
        array(
            'label'     => __( 'Instagram Link', 'giornalismo' ),
            'section'   => 'social',
            'type'      => 'text',
        )
    );

    //* Pinterest
    $wp_customize->add_setting(
        'giornalismo-pinterest',
        array(
            'default'           => '',
            'sanitize_callback' => 'giornalismo_sanitize_link',
        )
    );

    $wp_customize->add_control(
        'giornalismo-pinterest',
        array(
            'label'     => __( 'Pinterest Link', 'giornalismo' ),
            'section'   => 'social',
            'type'      => 'text',
        )
    );

	//* RSS Feed
	$wp_customize->add_setting(
   		'giornalismo-rss-feed',
    	array(
        	'default'           => '',
        	'sanitize_callback' => 'giornalismo_sanitize_link',
    	)
	);

	$wp_customize->add_control(
    	'giornalismo-rss-feed',
    	array(
        	'label'     => __( 'RSS Feed Link', 'giornalismo' ),
        	'section'   => 'social',
        	'type'      => 'text',
    	)
	);

	//* Author Twitter Handle
	$wp_customize->add_setting(
   		'giornalismo-twitter-handle',
    	array(
        	'default'           => '',
        	'sanitize_callback' => 'giornalismo_sanitize_checkbox',
    	)
	);

	$wp_customize->add_control(
    	'giornalismo-twitter-handle',
    	array(
        	'label'     => __( 'Show Author\'s Twitter Handle', 'giornalismo' ),
        	'section'   => 'social',
        	'type'      => 'checkbox',
    	)
	);

}
add_action( 'customize_register', 'giornalismo_social_customizer' );

//* Create the social media section
function giornalismo_home_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'home',
        array(
            'title' => __( 'Homepage Settings', 'giornalismo' ),
            'description' => __( 'This is the homepage settings section.', 'giornalismo' ),
            'priority' => 35,
        )
    );

    //* Get the categories for the home page options
    $cats = get_categories();
    $cat_args[ 'none' ] = __( 'None', 'giornalismo' );
    foreach($cats as $cat) {
          $cat_args[ $cat->term_id ] = $cat->name;
    }

    //* Top Story Category
    $wp_customize->add_setting(
        'giornalismo-top-story-category',
        array(
            'default'           => 'None',
            'sanitize_callback' => 'giornalismo_sanitize_category',
        )
    );

    $wp_customize->add_control(
        'giornalismo-top-story-category',
        array(
            'label'     => __( 'Top Story Category', 'giornalismo' ),
            'section'   => 'home',
            'type'      => 'select',
            'choices'   => $cat_args
        )
    );

    //* Column One Category
    $wp_customize->add_setting(
        'giornalismo-column-one-category',
        array(
            'default'           => 'None',
            'sanitize_callback' => 'giornalismo_sanitize_category',
        )
    );

    $wp_customize->add_control(
        'giornalismo-column-one-category',
        array(
            'label'     => __( 'Column One Category', 'giornalismo' ),
            'section'   => 'home',
            'type'      => 'select',
            'choices'   => $cat_args
        )
    );

    //* Number of Column One Stories
    $wp_customize->add_setting(
        'giornalismo-column-one-count',
        array(
            'default'           => '5',
            'sanitize_callback' => 'giornalismo_sanitize_num',
        )
    );

    $wp_customize->add_control(
        'giornalismo-column-one-count',
        array(
            'label'     => __( 'Number of Stories in the First Column', 'giornalismo' ),
            'section'   => 'home',
            'type'      => 'text',
        )
    );

    //* Column Two Category
    $wp_customize->add_setting(
        'giornalismo-column-two-category',
        array(
            'default'           => 'None',
            'sanitize_callback' => 'giornalismo_sanitize_category',
        )
    );

    $wp_customize->add_control(
        'giornalismo-column-two-category',
        array(
            'label'     => __( 'Column Two Category', 'giornalismo' ),
            'section'   => 'home',
            'type'      => 'select',
            'choices'   => $cat_args
        )
    );

    //* Number of Column Two Stories
    $wp_customize->add_setting(
        'giornalismo-column-two-count',
        array(
            'default'           => '5',
            'sanitize_callback' => 'giornalismo_sanitize_num',
        )
    );

    $wp_customize->add_control(
        'giornalismo-column-two-count',
        array(
            'label'     => __( 'Number of Stories in the Second Column', 'giornalismo' ),
            'section'   => 'home',
            'type'      => 'text',
        )
    );

    //* Column Three Category
    $wp_customize->add_setting(
        'giornalismo-column-three-category',
        array(
            'default'           => 'None',
            'sanitize_callback' => 'giornalismo_sanitize_category',
        )
    );

    $wp_customize->add_control(
        'giornalismo-column-three-category',
        array(
            'label'     => __( 'Column Three Category', 'giornalismo' ),
            'section'   => 'home',
            'type'      => 'select',
            'choices'   => $cat_args
        )
    );

    //* Number of Column Three Stories
    $wp_customize->add_setting(
        'giornalismo-column-three-count',
        array(
            'default'           => '6',
            'sanitize_callback' => 'giornalismo_sanitize_num',
        )
    );

    $wp_customize->add_control(
        'giornalismo-column-three-count',
        array(
            'label'     => __(  'Number of Stories in the Third Column', 'giornalismo'  ),
            'section'   => 'home',
            'type'      => 'text',
        )
    );

}
add_action( 'customize_register', 'giornalismo_home_customizer' );

//* Sanitize Links
function giornalismo_sanitize_link( $input ) {
	return esc_url_raw( $input );
}

//* Sanitize Layout Option
function giornalismo_sanitize_select( $input, $setting ) {
    $input = sanitize_key( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

//* Sanitize Checkboxes
function giornalismo_sanitize_checkbox( $input ) {
    return ( ( isset( $input ) && true == $input ) ? 1 : 0 );
}

//* Sanitize Category Options
function giornalismo_sanitize_category( $input, $setting ) {
	$input = sanitize_key( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

//* Sanitize Numbers
function giornalismo_sanitize_num( $input, $setting ) {
    $input = absint( $input );
    return ( $input ? $input : $setting->default );
}

//* Sanitize Text
function giornalismo_sanitize_text( $input ) {
	return wp_filter_nohtml_kses( $input );
}
?>