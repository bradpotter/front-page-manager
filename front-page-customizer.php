<?php
/**
 * Registers Front Page Manger option with the WordPress Customizer
 *
 */	
function register_customizer_front_page( $wp_customize ) {

	/* - - - - - Front Page Section - - - - - */

	$wp_customize->add_section( 'front_page_section', array(
		'title'          => __( 'Front Page', 'front-page-manager' ),
		'priority'       => 10,
	) );

	/* - - - - - Front Page Selector - - - - - */

	$wp_customize->add_setting(
		'front_page_selector',
		array(
			'default'     => '',
			'transport'   => 'refresh'
		)
	);

	$wp_customize->add_control(
		'front_page_selector',
		array(
			'type'     => 'select',
			'label'    => 'Select Front Page',
			'section'  => 'front_page_section',
			'settings' => 'front_page_selector',
			'choices'  => genesis_get_option('front_page_select'),
		)
	);

}
add_action( 'customize_register', 'register_customizer_front_page' );




