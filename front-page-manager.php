<?php
/**
 * Front Page Manager
 *
 * @package           FrontPageManager
 * @author            Brad Potter
 * @license           GPL-2.0+
 * @link              http://www.bradpotter.com/plugins/front-page-manager
 * @copyright         2014, Brad Potter
 *
 * @wordpress-plugin
 * Plugin Name:       Front Page Manager
 * Plugin URI:        https://github.com/bradpotter/front-page-manager
 * Description:       Adds additional front page selections to the Genesis Framework.
 * Version:           1.0.0
 * Author:            Brad Potter
 * Author URI:        http://www.bradpotter.com
 * Text Domain:       front-page-manager
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/bradpotter/front-page-manager
 * GitHub Branch:     master
 */

/**
 * If this file is called directly, abort.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Setting constants
 */
define( 'FPM_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'FPM_URL' , plugins_url() . '/' . str_replace( basename( __FILE__ ), "" , plugin_basename( __FILE__ ) ) );

/**
 * Required files if Admin
 */
add_action( 'genesis_init', 'fpm_init', 99 );
function fpm_init() {

		if ( is_admin() ) {
			require_once( FPM_PLUGIN_DIR . '/front-page-manager-functions.php' );
			require_once( FPM_PLUGIN_DIR . '/front-page-customizer.php' );
		}
}

/**
 * Return pattern for front-page template file name.
 *
 * @since 1.0.0
 *
 * @return string Regular expression pattern.
 */
function fpm_get_file_name_pattern() {
    return '#^front-page-[a-z0-9-]+\.php$#';
}

/**
 * Provided file name matches pattern for expected front page templates.
 *
 * @since 1.0.0
 *
 * @param string $file_name File name that may be a front page template.
 *
 * @return bool True if pattern matches, false otherwise.
 */
function fpm_is_file_name_match( $file_name ) {
    return preg_match( fpm_get_file_name_pattern(), $file_name );
}

/**
 * Potentially switch to chosen front page template.
 *
 * @since 1.0.0
 *
 * @param string $template Existing template path.
 *
 * @return string Potentially amended template path.
 */
function front_page_manager_include( $template ) {
    if ( ! is_home() && ! is_front_page() ) {
        return $template;
    }

    $front_page_manager = genesis_get_option( 'front_page_select' );

    if ( $front_page_manager && fpm_is_file_name_match ( $front_page_manager ) ) {
        return trailingslashit( get_stylesheet_directory() ) . $front_page_manager;
    }

    return $template;
}
add_filter( 'template_include', 'front_page_manager_include' );
