<?php

/**
 * Plugin Name:       PressApps Login & Access
 * Description:       Login and member access WordPress plugin
 * Version:           2.1.0
 * Author:            PressApps
 * Author URI:        https://codecanyon.net/user/pressapps
 * Text Domain:       pressapps-login-access
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Skelet Config
 */
$skelet_paths[] = array(
	// Set unique plugin prefix
    'prefix'      => 'palo',
    'dir'         => wp_normalize_path(  plugin_dir_path( __FILE__ ).'includes/' ),
    'uri'         => plugin_dir_url( __FILE__ ).'includes/skelet',
);

/**
 * Load Skelet Framework
 */
if( ! class_exists( 'Skelet_LoadConfig' ) ){
	include_once dirname( __FILE__ ) .'/includes/skelet/skelet.php';
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pressapps-login-access-activator.php
 */
function activate_pressapps_login_access() {

	// Check PHP Version and deactivate & die if it doesn't meet minimum requirements.
	if ( version_compare( PHP_VERSION, '5.3.0', '<' )  ) {
		deactivate_plugins( plugin_basename( dirname( __FILE__ )  ) );
		wp_die( __( 'The minimum PHP version required for this plugin is 5.3.0 Please upgrade the PHP version or contact your hosting provider to do it for you.', 'pressapps-knowledge-base' ) );
	}

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pressapps-login-access-activator.php';
	Pressapps_Login_Access_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pressapps-login-access-deactivator.php
 */
function deactivate_pressapps_login_access() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pressapps-login-access-deactivator.php';
	Pressapps_Login_Access_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pressapps_login_access' );
register_deactivation_hook( __FILE__, 'deactivate_pressapps_login_access' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pressapps-login-access.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pressapps_login_access() {

	$plugin = new Pressapps_Login_Access();
	$plugin->run();

}
run_pressapps_login_access();
