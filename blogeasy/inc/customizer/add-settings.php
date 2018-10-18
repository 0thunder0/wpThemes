<?php

require get_template_directory() . '/inc/customizer/class-theme-kirki.php';

Blogeasy_Kirki::add_config( 'blogeasy_theme', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

Blogeasy_Kirki::add_panel( 'theme_options', array(
    'priority'    => 31,
    'title'       => esc_html__( 'Theme Options', 'blogeasy' ),
) );

Blogeasy_Kirki::add_field( 'blogeasy_theme', array(
	'settings' => 'logo_height',
	'label'    => esc_html__( 'Logo Height (in px)', 'blogeasy' ),
	'section'  => 'title_tagline',
	'type'     => 'number',
	'priority' => 8,
	'default'  => 60,
    'tooltip'  => esc_html__( 'Minimum height 25px & maximum height 200px. Width will be adjusted automatically.', 'blogeasy' ),
    'choices'  => array(
		'min'  => 25,
		'max'  => 200,
		'step' => 1,
	),
    'output'   => array(
        array(
			'element'  => '.custom-logo',
			'property' => 'height',
			'units'    => 'px',
		),
        array(
			'element'       => '.custom-logo',
			'property'      => 'width',
            'value_pattern' => 'auto',
		)
    )
) );

include( get_template_directory() . '/inc/customizer/theme-colors.php' );



Blogeasy_Kirki::add_section( 'upgrade_theme', array(
    'title'          => esc_html__( 'Get More Features', 'blogeasy' ),
    'panel'          => '',
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
	'priority'		 => 500
) );

Blogeasy_Kirki::add_field( 'blogeasy_theme', array(
	'settings' => 'pro_features',
	'section'  => 'upgrade_theme',
	'type'     => 'custom',
    'default'  => '<h2 class="wp-bp-region-title first-region-title">' . esc_html__( 'Upgrade To Pro', 'blogeasy' ) . '</h2>
					<p>' . esc_html__( 'Let\'s make your website even better with the pro version of this theme.', 'blogeasy' ) . '</p>
					<ul style="list-style: square; margin-left: 20px;margin-bottom: 20px;">
						<li>' . esc_html__( 'Posts Slider on home page', 'blogeasy' ) .'</li>
						<li>' . esc_html__( 'Advanced Customization', 'blogeasy' ) . '</li>
						<li>' . esc_html__( 'Change Website Fonts', 'blogeasy' ) . '</li>
						<li>' . esc_html__( 'Remove Footer Credits', 'blogeasy' ) . '</li>
						<li>' . esc_html__( 'Sticky Navbar', 'blogeasy' ) . '</li>
						<li>' . esc_html__( 'Premium Support', 'blogeasy' ) . '</li>
						' . esc_html__( 'and much more...', 'blogeasy' ) . '
					</ul>
					<a class="button button-primary button-hero" href="https://wp-themespoint.com/blogeasy-pro/" target="_blank">Read More</a>',
) );


/**
* Styling Customizer
*/
function blogeasy_customizer_css()
{
	if( class_exists( 'Kirki' ) ) {
		wp_enqueue_style( 'logeasy-customizer-css', get_template_directory_uri() . '/inc/customizer/customizer.css' );
	}
}
add_action( 'customize_controls_print_styles', 'blogeasy_customizer_css' );
