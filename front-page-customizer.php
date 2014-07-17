<?php
/**
 * Register Front Page Manger option with the WordPress Customizer
 *
 */
class FPM_Genesis_Customizer extends Genesis_Customizer_Base {

	/**
	 * Settings field.
	 */
	public $settings_field = 'genesis-settings';

	/**
	 *
	 */
	public function register( $wp_customize ) {

		$this->front_page( $wp_customize );
	}

	private function front_page( $wp_customize ) {

		$wp_customize->add_section(
			'front_page_manager',
			array(
				'title'    => 'Front Page Manager',
				'priority' => 10,
			)
		);

		$wp_customize->add_setting(
			$this->get_field_name( 'front_page_select' ),
			array(
				'default' => $this->get_field_name( 'front_page_select' ),
				'type'    => 'option',
			)
		);

		$wp_customize->add_control(
			'genesis_front_page_select',
			array(
				'label'    => __( 'Select Front Page', 'front-page-manager' ),
				'section'  => 'front_page_manager',
				'settings' => $this->get_field_name( 'front_page_select' ),
				'type'     => 'select',
				'choices'  => fpm_get_templates_for_customizer(),
			)
		);

	}

}

add_action( 'init', 'fpm_genesis_customizer_init' );
/**
 *
 */
function fpm_genesis_customizer_init() {
	new FPM_Genesis_Customizer;
}

function fpm_get_templates_for_customizer() {
	$templates = array();

	foreach ( (array) glob( CHILD_DIR . "/front-page*.php" ) as $template ) {
		$templates[] = str_replace( CHILD_DIR . '/', '', $template );
	}

	$templates = array_combine( $templates, $templates );

	return $templates;
}
