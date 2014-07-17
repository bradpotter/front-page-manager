<?php
/**
 * Front Page Manager
 *
 * @package   Front_Page_Manager
 * @author    Brad Potter
 * @license   GPL-2.0+
 * @link      http://www.bradpotter.com/plugins/front-page-manager
 * @copyright Copyright (c) 2014, Brad Potter
 */

/**
 * Add metabox for Front Page Manager
 */
add_action( 'genesis_theme_settings_metaboxes', 'front_page_manager_metaboxes', 10, 1 );
function front_page_manager_metaboxes( $pagehook ) {

	add_meta_box( 'front-page-manager', __( 'Front Page Manager', 'front-page-manager' ), 'front_page_metabox', $pagehook, 'main', 'high' );

}

/**
 * Content for the Front Page Manager metabox
 */
function front_page_metabox() {
    
    // set the default selection (if empty)
    $frontpageselect = genesis_get_option('front_page_select') ? genesis_get_option('front_page_select') : 'front-page.php';
?>

    <p> 
        <select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[front_page_select]">
            <?php
            foreach ( glob(CHILD_DIR . "/front-page*.php") as $file ) {
            $file = str_replace( CHILD_DIR . '/', '', $file );
            
            ?>
                
            <option value="<?php echo esc_attr( $file ); ?>" <?php selected($file, $frontpageselect); ?>><?php echo esc_html( $file ); ?></option>
            
            <?php } ?>
        </select>
    </p>
    <p><span class="description">Select your desired <b>Front Page</b> from the drop down list and save your settings.</span></p>
<?php
}