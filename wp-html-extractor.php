<?php
// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ){
	exit;
}

/**
 * Plugin Name:       HTML Extractor
 * Description:       Produces a static HTML version of your WordPress install and adjusts URLs accordingly.
 * Version:           1.0
 * Author:            Mateusz Buc Wojdała
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

if( version_compare( PHP_VERSION, '7.0', '<' ) ){
	if( is_admin() ){
		if( ! is_plugin_active( plugin_basename( __FILE__ ) ) ){
			$message = __( '<b>HTML Exctractor</b> requires PHP 7.0 or higher, and the plugin has now deactivated itself.', 'html-extractor' ) .
				'<br />' .
				__( 'Contact your hosting company or your system administrator and ask for an upgrade to version 7.0 of PHP.', 'html-extractor' );
			printf( "<p style='color: #444; font-size: 13px; line-height: 1.5; font-family: -apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Oxygen-Sans,Ubuntu,Cantarell,\"Helvetica Neue\",sans-serif'>%s</p>", $message );
			exit;
		}
		deactivate_plugins( __FILE__ );
	}
}
else{
	// Loading up HTML Extractor in a separate file so that there's nothing to
	// trigger a PHP error in this file
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-he-load.php';
}