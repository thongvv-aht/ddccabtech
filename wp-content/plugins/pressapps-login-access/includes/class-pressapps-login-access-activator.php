<?php

/**
 * Fired during plugin activation
 *
 * @link       http://pressapps.co
 * @since      1.0.0
 *
 * @package    Pressapps_Login_Access
 * @subpackage Pressapps_Login_Access/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Pressapps_Login_Access
 * @subpackage Pressapps_Login_Access/includes
 * @author     PressApps
 */
class Pressapps_Login_Access_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		// Check for skelet compatibility
		if ( version_compare( PHP_VERSION, '5.3.0', '<' )  ) {
			deactivate_plugins( plugin_basename( dirname( __FILE__ )  ) );
			wp_die( 'The plugin requires PHP 5.3 and above to function.' );
		}
 	}

}
