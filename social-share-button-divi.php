<?php
/*
Plugin Name: Social Share Button Divi
Plugin URI:  https://owlpixel.com
Description: A divi extension for social share button integration
Version:     1.0.0
Author:      Owlpixel
Author URI:  https://owlpixel.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: ssbd-social-share-button-divi
Domain Path: /languages
*/


if ( ! function_exists( 'ssbd_initialize_extension' ) ):
/**
 * Creates the extension's main class instance.
 *
 * @since 1.0.0
 */
function ssbd_initialize_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/SocialShareButtonDivi.php';
}
add_action( 'divi_extensions_init', 'ssbd_initialize_extension' );
endif;
