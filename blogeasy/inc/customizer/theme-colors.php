<?php

if( class_exists( 'Kirki' ) ) {
    function blogeasy_colors_section( $wp_customize ) {
        $wp_customize->get_control( 'background_color' )->label = esc_html__( 'Body Background Color', 'blogeasy' );
        $wp_customize->get_section( 'colors' )->title = esc_html__( 'Theme Colors', 'blogeasy' );
    }
    add_action( 'customize_register', 'blogeasy_colors_section' );
}


Blogeasy_Kirki::add_field( 'blogeasy_theme', array(
	'settings' => 'styling_primary_color',
	'section'  => 'colors',
	'type'     => 'color',
    'label' => esc_html__( 'Primary Color', 'blogeasy' ),
    'default'  => '#002e5b',
    'output'   => array(
        array(
			'element'  => array( '.btn-outline-primary', '.entry-meta a', '.entry-footer a', '.widget a', '.btn-primary:hover', '.btn-primary:active', '.btn-primary:focus' ),
			'property' => 'color',
		),
        array(
			'element'  => array( '.main-nav-bg', '.main-navigation ul ul', '.btn-primary', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.button.add_to_cart_button', '.wc-proceed-to-checkout .checkout-button.button', '.price_slider_amount button[type="submit"]' ),
			'property' => 'background-color',
		),
        array(
			'element'  => array( '.btn-primary', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.btn-outline-primary', '.button.add_to_cart_button', '.wc-proceed-to-checkout .checkout-button.button', '.price_slider_amount button[type="submit"]' ),
			'property' => 'border-color',
		),
        array(
			'element'  => array( '.btn-outline-primary:hover', '.slicknav_menu' ),
			'property' => 'background-color',
		),
        array(
			'element'  => array( '.btn-outline-primary:hover', '.btn-primary:hover', '.btn-primary:active', '.btn-primary:focus' ),
			'property' => 'border-color',
		),
        array(
            'element' => array( '.shop_table.shop_table_responsive.woocommerce-cart-form__contents button[type="submit"]', '.form-row.place-order button[type="submit"]', '.single-product .summary.entry-summary button[type="submit"]' ),
            'property' => 'background-color',
        ),
        array(
            'element' => array( '.shop_table.shop_table_responsive.woocommerce-cart-form__contents button[type="submit"]', '.form-row.place-order button[type="submit"]', '.single-product .summary.entry-summary button[type="submit"]' ),
            'property' => 'border-color',
        ),
    ),
) );
