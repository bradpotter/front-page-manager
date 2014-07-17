<?php
/**
 * 
 */
class Front_Page_Customizer extends Genesis_Customizer_Base {

	/**
	 * Settings field.
	 */
	public $settings_field = 'genesis-settings';

	/**
	 *
	 */
	public function register( $wp_customize ) {

		$this->front_page_manager( $wp_customize );		
	}

	private function front_page_manager( $wp_customize ) {
		
		$wp_customize->add_section(
			'front_page_section',
			array(
				'title'    => 'Front Page Manager',
				'priority' => 10,
			)
		);

		$wp_customize->add_setting(
			$this->get_field_name( 'front_page_select' ),
			array(
				'default' => 'front-page.php',
				'type'    => 'option',
			)
		);

		$wp_customize->add_control(
			'genesis_front_page_select',
			array(
				'label'    => 'Select Front Page',
				'section'  => 'front_page_section',
				'settings' => $this->get_field_name( 'front_page_select' ),
				'type'     => 'select',
				'choices'  => array( 
					'front-page.php' => __( 'front-page.php', 'front-page-manager' ),
					'front-page-two.php' => __( 'front-page-two.php', 'front-page-manager' ),
					'front-page-three.php' => __( 'front-page-three.php', 'front-page-manager' ),
					'front-page-four.php' => __( 'front-page-four.php', 'front-page-manager' ),
					'front-page-five.php'   => __( 'front-page-five.php', 'front-page-manager' ),
				),
			)			
		);
		
	}

}

add_action( 'init', 'front_page_customizer_init' );
/**
 * 
 */
function front_page_customizer_init() {
	new Front_Page_Customizer;
}