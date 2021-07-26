<?php
/*
Plugin Name:        Composium - WP Bakery Page Builder Extensions Addon
Plugin URI:         http://codecanyon.net/item/visual-composer-extensions-addon/7190695
Version:            5.5.1
Description:        A plugin to add new advanced content elements, custom post types, a premium built-in lightbox solution, icon fonts, Google fonts, custom fonts and much more to the WP Bakery Page Builder plugin.
Author:             Tekanewa Scripts by Kraut Coding
Author URI:         http://www.composium.krautcoding.com
Text Domain:        ts_visual_composer_extend
Domain Path:        /locale
*/


// Do NOT Load Directly
// --------------------
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}
if (!defined('ABSPATH')) exit;


// Functions that need to be available immediately
// -----------------------------------------------
if (!function_exists('TS_VCSC_GetResourceURL')){
	function TS_VCSC_GetResourceURL($relativePath){
		return plugins_url($relativePath, plugin_basename(__FILE__));
	}
}
if (!function_exists('TS_VCSC_GetPluginVersion')){
	function TS_VCSC_GetPluginVersion() {
		$plugin_data 						= get_plugin_data( __FILE__ );
		$plugin_version 					= $plugin_data['Version'];
		return $plugin_version;
	}
}
	

// Define Global Variables
// -----------------------
if (!defined('COMPOSIUM_EXTENSIONS')){
	define('COMPOSIUM_EXTENSIONS', 			dirname(__FILE__));
}
if (!defined('COMPOSIUM_VERSION')){
	define('COMPOSIUM_VERSION', 			'5.5.1');
}
if (!defined('COMPOSIUM_SLUG')){
	define('COMPOSIUM_SLUG', 				plugin_basename(__FILE__));
}
if (!defined('COMPOSIUM_URL')){
	define('COMPOSIUM_URL', 				plugin_dir_url(__FILE__));
}
if (!defined('COMPOSIUM_PATH')){
	define('COMPOSIUM_PATH', 				plugin_dir_path(__FILE__));
}
if (!defined('COMPOSIUM_NAME')){
	define('COMPOSIUM_NAME', 				'Composium - WP Bakery Page Builder Extensions Addon');
}


// Ensure that Function for Network Activate is Ready
// --------------------------------------------------
if (!function_exists('is_plugin_active_for_network')) {
	require_once(ABSPATH . '/wp-admin/includes/plugin.php');
}


// Main Class for Composium - WP Bakery Page Builder Extensions
// ------------------------------------------------------------
if (!class_exists('VISUAL_COMPOSER_EXTENSIONS')) {
	// Load Absolutely Required Functions
	// ----------------------------------
	require_once('registrations/ts_vcsc_registrations_required.php');
	
	// Register / Remove Plugin Settings on Plugin Activation / Removal
	// ----------------------------------------------------------------
	require_once('registrations/ts_vcsc_registrations_plugin.php');
	
	// WordPres Register Hooks
	// -----------------------
	register_activation_hook(__FILE__, 		array('VISUAL_COMPOSER_EXTENSIONS', 	'TS_VCSC_On_Activation'));
	register_deactivation_hook(__FILE__, 	array('VISUAL_COMPOSER_EXTENSIONS', 	'TS_VCSC_On_Deactivation'));
	register_uninstall_hook(__FILE__, 		array('VISUAL_COMPOSER_EXTENSIONS', 	'TS_VCSC_On_Uninstall'));
	
	// Create Plugin Class
	// -------------------
	class VISUAL_COMPOSER_EXTENSIONS {
		// Functions for Plugin Activation / Deactivation / Uninstall
		// ----------------------------------------------------------
		public static function TS_VCSC_On_Activation($network_wide) {
			if (!isset($wpdb)) $wpdb = $GLOBALS['wpdb'];
			global $wpdb;
			if (!current_user_can('activate_plugins')) {
				return;
			}
			// Check if Plugin has been Activated Before
			if (!get_option('ts_vcsc_extend_settings_envatoInfo')) {
				$memory_required						= 20 * 1024 * 1024;
			} else {
				$memory_required						= 5 * 1024 * 1024;
			}
			$memory_provided							= ini_get('memory_limit');
			if (($memory_provided === "-1") || ($memory_provided === -1)) {
				$memory_unlimited						= true;
			} else {
				$memory_unlimited						= false;
			}
			if (preg_match('/^(\d+)(.)$/', $memory_provided, $matches)) {
				if (($matches[2] == 'T') || ($matches[2] == 't')) {
					$memory_provided 					= $matches[1] * 1024 * 1024 * 1024 * 1024;
				} else if (($matches[2] == 'G') || ($matches[2] == 'g')) {
					$memory_provided 					= $matches[1] * 1024 * 1024 * 1024;
				} else if (($matches[2] == 'M') || ($matches[2] == 'm')) {
					$memory_provided 					= $matches[1] * 1024 * 1024;
				} else if (($matches[2] == 'K') || ($matches[2] == 'k')) {
					$memory_provided 					= $matches[1] * 1024;
				} else if (($matches[2] == 'B') || ($matches[2] == 'b') || ($matches[2] == '')) {
					$memory_provided 					= $matches[1];
				}
			}
			$memory_peakusage 							= memory_get_peak_usage(true);
			if ((($memory_provided - $memory_peakusage) <= $memory_required) && ($memory_unlimited == false)) {
				$part1 									= __("Unfortunately, and to prevent a potential system crash, the plugin 'Composium - WP Bakery Page Builder Extensions Addon' could not be activated. It seems your available PHP memory is already close to exhaustion and so there is not enough left for this plugin.", "ts_visual_composer_extend") . '<br/>';
				$part2 									= __('Available Memory:', 'ts_visual_composer_extend') . '' . ($memory_provided / 1024 / 1024) . 'MB / ' . __('Already Utilized Memory:', 'ts_visual_composer_extend') . '' . ($memory_peakusage / 1024 / 1024) . 'MB / ' . __('Required Memory:', 'ts_visual_composer_extend') . '' . ($memory_required / 1024 / 1024) . 'MB<br/>';
				$part3 									= __('Please contact our', 'ts_visual_composer_extend');
				error_log($part1 . ' ' . $part2, 0);
				trigger_error($part1 . ' ' . $part3 . ' <a href="http://helpdesk.krautcoding.com/">' . __('Plugin Support', 'ts_visual_composer_extend') . '</a> for assistance.', E_USER_ERROR);
			} else {				
				if (function_exists('is_multisite') && is_multisite()) {					
					if ($network_wide) {
						// Options for License Data
						add_site_option('ts_vcsc_extend_settings_updated', 				            	0);
						add_site_option('ts_vcsc_extend_settings_created', 				            	0);
						add_site_option('ts_vcsc_extend_settings_deleted', 				            	0);
						add_site_option('ts_vcsc_extend_settings_license', 				            	'');
						add_site_option('ts_vcsc_extend_settings_licenseUpdate',						0);
						add_site_option('ts_vcsc_extend_settings_licenseInfo',							'');
						add_site_option('ts_vcsc_extend_settings_licenseKeyed',							'emptydelimiterfix');
						add_site_option('ts_vcsc_extend_settings_licenseValid',							0);
						// Options for Update Data
						add_site_option('ts_vcsc_extend_settings_versionCurrent', 				    	'');
						add_site_option('ts_vcsc_extend_settings_versionLatest', 				    	'');
						add_site_option('ts_vcsc_extend_settings_updateAvailable', 				    	0);
						add_site_option('ts_vcsc_extend_settings_notificationCache', 				    '');
						add_site_option('ts_vcsc_extend_settings_notificationLast', 				    '');
						add_site_option('ts_vcsc_extend_settings_notificationTime', 				    43200);
						$old_blog 	= $wpdb->blogid;
						$blogids 	= $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
						foreach ($blogids as $blog_id) {
							switch_to_blog($blog_id);
							TS_VCSC_Set_Plugin_Options();
						}
						switch_to_blog($old_blog);
						return;
					}
				}
				if ((isset($network_wide)) && (!$network_wide)) {
					// Options for License Data
					add_option('ts_vcsc_extend_settings_updated', 				            			0);
					add_option('ts_vcsc_extend_settings_created', 				            			0);
					add_option('ts_vcsc_extend_settings_deleted', 				            			0);
					add_option('ts_vcsc_extend_settings_license', 				            			'');
					add_option('ts_vcsc_extend_settings_licenseUpdate',									0);
					add_option('ts_vcsc_extend_settings_licenseInfo',									'');
					add_option('ts_vcsc_extend_settings_licenseKeyed',									'emptydelimiterfix');
					add_option('ts_vcsc_extend_settings_licenseValid',									0);
					// Options for Update Data
					add_option('ts_vcsc_extend_settings_versionCurrent', 				    			'');
					add_option('ts_vcsc_extend_settings_versionLatest', 				    			'');
					add_option('ts_vcsc_extend_settings_updateAvailable', 				    			0);
					add_option('ts_vcsc_extend_settings_notificationCache', 				    		'');
					add_option('ts_vcsc_extend_settings_notificationLast', 				    			'');
					add_option('ts_vcsc_extend_settings_notificationTime', 				    			43200);
				}
				TS_VCSC_Set_Plugin_Options();
				if (!$network_wide) {
					update_option('ts_vcsc_extend_settings_redirect',									1);
				}
			}
		}
		public static function TS_VCSC_On_Deactivation($network_wide) {
			if (!isset($wpdb)) $wpdb = $GLOBALS['wpdb'];
			global $wpdb;
			if (!current_user_can('activate_plugins')) {
				return;
			}
			if (function_exists('is_multisite') && is_multisite()) {
				if ($network_wide) {
					$old_blog 	= $wpdb->blogid;
					$blogids 	= $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
					foreach ($blogids as $blog_id) {
						switch_to_blog($blog_id);
						$roles = get_editable_roles();
						foreach ($GLOBALS['wp_roles']->role_objects as $key => $role) {
							if (isset($roles[$key]) && $role->has_cap('ts_vcsc_extend')) {
								$role->remove_cap('ts_vcsc_extend');
							}
						}
					}
					switch_to_blog($old_blog);
					return;
				}
			}
			$roles = get_editable_roles();
			foreach ($GLOBALS['wp_roles']->role_objects as $key => $role) {
				if (isset($roles[$key]) && $role->has_cap('ts_vcsc_extend')) {
					$role->remove_cap('ts_vcsc_extend');
				}
			}
		}
		public static function TS_VCSC_On_Uninstall($network_wide) {
			if (!isset($wpdb)) $wpdb = $GLOBALS['wpdb'];
			global $wpdb;
			if (!current_user_can('activate_plugins')) {
				return;
			}
			if ( __FILE__ != WP_UNINSTALL_PLUGIN) {
				return;
			}
			if (function_exists('is_multisite') && is_multisite()) {
				if ($network_wide) {
					$old_blog 	= $wpdb->blogid;
					$blogids 	= $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
					foreach ($blogids as $blog_id) {
						switch_to_blog($blog_id);
						//array('VISUAL_COMPOSER_EXTENSIONS', 	'TS_VCSC_Delete_Plugin_Options');
						TS_VCSC_Delete_Plugin_Options();
					}
					switch_to_blog($old_blog);
					return;
				}
			}
			//array('VISUAL_COMPOSER_EXTENSIONS', 	'TS_VCSC_Delete_Plugin_Options');
			TS_VCSC_Delete_Plugin_Options();
		}


		// Constructor for Plugin
		// ----------------------
		function __construct() {
			$this->assets_js 								= plugin_dir_path( __FILE__ ) . 'js/';
			$this->assets_css 								= plugin_dir_path( __FILE__ ) . 'css/';
			$this->assets_dir 								= plugin_dir_path( __FILE__ ) . 'assets/';
			$this->classes_dir 								= plugin_dir_path( __FILE__ ) . 'classes/';
			$this->elements_dir 							= plugin_dir_path( __FILE__ ) . 'elements/';
			$this->shortcode_dir 							= plugin_dir_path( __FILE__ ) . 'shortcodes/';
			$this->plugins_dir 								= plugin_dir_path( __FILE__ ) . 'plugins/';
			$this->woocommerce_dir 							= plugin_dir_path( __FILE__ ) . 'woocommerce/';
			$this->bbpress_dir 								= plugin_dir_path( __FILE__ ) . 'bbpress/';
			$this->posttypes_dir 							= plugin_dir_path( __FILE__ ) . 'posttypes/';
			$this->images_dir 								= plugin_dir_path( __FILE__ ) . 'images/';
			$this->icons_dir 								= plugin_dir_path( __FILE__ ) . 'icons/';
			$this->detector_dir  							= plugin_dir_path( __FILE__ ) . 'detector/';
			$this->parameters_dir 							= plugin_dir_path( __FILE__ ) . 'parameters/';
			$this->widgets_dir 								= plugin_dir_path( __FILE__ ) . 'widgets/';
			$this->templates_dir 							= plugin_dir_path( __FILE__ ) . 'templates/';
			$this->detector_dir 							= plugin_dir_path( __FILE__ ) . 'detector/';
			$this->codestar_dir 							= plugin_dir_path( __FILE__ ) . 'codestar/';
			$this->registrations_dir						= plugin_dir_path( __FILE__ ) . 'registrations/';
			
			$this->TS_VCSC_PluginSlug						= plugin_basename(__FILE__);
			$this->TS_VCSC_PluginPath						= plugin_dir_url(__FILE__);
			$this->TS_VCSC_PluginDir 						= plugin_dir_path( __FILE__ );			
			$this->TS_VCSC_PluginPHP						= (TS_VCSC_VersionCompare(PHP_VERSION, '5.3.0') >= 0) ? "true" : "false";
			$this->TS_VCSC_PluginMobile						= "false";

			// Load Public Class Variables
			// ---------------------------
			require_once($this->registrations_dir . 'ts_vcsc_registrations_essentials.php');
			
			// Check and Store WBP Version, Applicable Post Types, Icon Picker + Gutenberg Status
			// ----------------------------------------------------------------------------------
			add_action('plugins_loaded',					array($this, 	'TS_VCSC_VisualComposerCheck'),				11);
            add_action('plugins_loaded',					array($this, 	'TS_VCSC_GutenbergStatusCheck'),			12);            
			
			// Load Public Arrays that Define Icon Fonts
			// -----------------------------------------
            require_once($this->registrations_dir . 'ts_vcsc_registrations_iconfonts.php');
            
            // Load Public Arrays that Define Element Settings
			// -----------------------------------------------
			require_once($this->registrations_dir . 'ts_vcsc_registrations_elements.php');
			
			// Check for Current User Role
			// ---------------------------
			add_action('init',								array($this, 	'TS_VCSC_DetermineCurrentUser'),			11);

			// Load Mobile Detector + Downtime Manager
			// ---------------------------------------
			if ($this->TS_VCSC_CustomPostTypesDownpage == "true") {
				add_action('init',							array($this, 	'TS_VCSC_DowntimeManagerInit'));
				
			}
			
			// Init Additional Sidebars
			// ------------------------
			if ($this->TS_VCSC_UseSidebarsManager == "true") {
				add_action('widgets_init', 					array($this, 	'TS_VCSC_CustomSidebarsInit'), 				7777);
			}
			
			// Load and Initialize the Auto-Update Class
			// -----------------------------------------
			if (($this->TS_VCSC_PluginUsage == "true") && ($this->TS_VCSC_PluginExtended == "false") && ($this->TS_VCSC_PluginValid == "true") && (strlen($this->TS_VCSC_PluginLicense) != 0) && (is_admin()) && (function_exists('get_plugin_data'))) {
				if ($this->TS_VCSC_UseUpdateAutomatic == "true") {
					if (!class_exists('PluginUpdateChecker_2_0')) {
						require_once ('assets/ts_vcsc_autoupdate.php');
					}
					$this->TS_VCSC_PluginKernl					= new PluginUpdateChecker_2_0 ('https://kernl.us/api/v1/updates/566724710a25612471e649ef/', __FILE__, 'ts-visual-composer-extend', 1);
					$this->TS_VCSC_PluginKernl->purchaseCode	= $this->TS_VCSC_PluginLicense;
                    //$this->TS_VCSC_PluginKernl->license       = $this->TS_VCSC_PluginLicense;
				}
			}
			
			// Load Language / Translation Files
			// ---------------------------------
			if ((get_option('ts_vcsc_extend_settings_translationsDomain', 1) == 1) && (substr(get_bloginfo('language'), 0, 2) != "en")) {
				add_action('init',							array($this, 	'TS_VCSC_LoadTextDomains'), 				9);
			}
			
			// Add Additional Links to Plugin Page
			// -----------------------------------
			$plugin 										= plugin_basename( __FILE__ );
			add_filter("plugin_action_links_$plugin", 		array($this, 	"TS_VCSC_PluginAddSettingsLink"));
			
			// Register Custom CSS and JS Inputs
			// ---------------------------------
			if ($this->TS_VCSC_UseCodeEditors == "true") {
				add_action('admin_init', 					array($this, 	'TS_VCSC_RegisterCustomCSS_Setting'));
				add_action('admin_init', 					array($this, 	'TS_VCSC_RegisterCustomJS_Setting'));
			}
			
			// Function to Register / Load External Files on Back-End
			// ------------------------------------------------------
            add_action('admin_enqueue_scripts', 			array($this, 	'TS_VCSC_FilesRegistrations'),			    1);
			add_action('admin_enqueue_scripts', 			array($this, 	'TS_VCSC_Extensions_Admin_Files'),			999999999);
			add_action('admin_head', 						array($this, 	'TS_VCSC_Extensions_Admin_Variables'),		999999999);
			add_action('admin_head', 						array($this, 	'TS_VCSC_Extensions_Admin_Head'),			999999999);
			add_action('admin_footer', 						array($this, 	'TS_VCSC_Extensions_Admin_Footer'));
			//add_action('vc_after_init', 					array($this, 	'TS_VCSC_Extensions_Admin_Bakery'), 		888888888);
			
			// Function to Register / Load External Files on Front-End
			// -------------------------------------------------------
			add_action('wp_enqueue_scripts', 				array($this, 	'TS_VCSC_Extensions_Front_Main'), 			999999999);
			add_action('wp_head', 							array($this, 	'TS_VCSC_Extensions_Front_Variables'), 		$this->TS_VCSC_Extensions_VariablesPriority);
			add_action('wp_head', 							array($this, 	'TS_VCSC_Extensions_Front_Head'), 			8888);
			add_action('wp_footer', 						array($this, 	'TS_VCSC_Extensions_Front_Footer'), 		8888);
			add_action('wp_print_scripts', 					array($this, 	'TS_VCSC_Extensions_Front_DequeueJS'), 		9999);
			add_action('wp_print_styles', 					array($this, 	'TS_VCSC_Extensions_Front_DequeueCSS'),		9999);
			
			// Output of Custom CSS + JS Code
			// ------------------------------
			if ($this->TS_VCSC_UseCodeEditors == "true") {
				add_action('wp_head', 						array($this, 'TS_VCSC_DisplayCustomCSS'));
				add_action('wp_footer', 					array($this, 'TS_VCSC_DisplayCustomJS'), 					9999);
			}			
			
			// Add Dashboard Widget
			// --------------------
			if ($this->TS_VCSC_PluginDashboard == "true") {
				add_action('wp_dashboard_setup', 			array($this, 	'TS_VCSC_IconFontsArrays'), 				8888);
				add_action('wp_dashboard_setup', 			array($this, 	'TS_VCSC_DashboardHelpWidget'), 			9999);
			}			
			
			// Create Custom Post Types
			// ------------------------
			if (($this->TS_VCSC_PluginExtended == "true") && ($this->TS_VCSC_UseCustomPostTypes == "true")) {
				if (($this->TS_VCSC_UseCustomPostWidget == "false") && ($this->TS_VCSC_UseCustomPostTeam == "false") && ($this->TS_VCSC_UseCustomPostTestimonial == "false") && ($this->TS_VCSC_UseCustomPostLogo == "false") && ($this->TS_VCSC_UseCustomPostSkillset == "false") && ($this->TS_VCSC_UseCustomPostTimeline == "false")) {
					update_option('ts_vcsc_extend_settings_posttypes', 0);
					$this->TS_VCSC_UseCustomPostTypes 																= "false";
				}
			}
			if (((($this->TS_VCSC_PluginExtended == "true") && ($this->TS_VCSC_UseCustomPostTypes == "true")) || (($this->TS_VCSC_PluginExtended == "false"))) && ($this->TS_VCSC_PluginUsage == "true")) {
				$this->TS_VCSC_CustomPostTypesCheckup																= "true";
				if ($this->TS_VCSC_CustomPostTypesDownpage == "true") {
					$this->TS_VCSC_Extensions_PostTypes['Downpages'] 												= 1;
				} else {
					$this->TS_VCSC_Extensions_PostTypes['Downpages'] 												= 0;
				}
				if ((($this->TS_VCSC_PluginExtended == "false") && ($this->TS_VCSC_CustomPostTypesWidgets == "true")) || (($this->TS_VCSC_PluginExtended == "true") && ($this->TS_VCSC_UseCustomPostWidget == "true")  && ($this->TS_VCSC_CustomPostTypesWidgets == "true") && ($this->TS_VCSC_UseCustomPostTypes == "true"))) {
					$this->TS_VCSC_CustomPostTypesWidgets 															= "true";
					$this->TS_VCSC_Extensions_PostTypes['Widgets'] 													= 1;
				} else {
					$this->TS_VCSC_CustomPostTypesWidgets 															= "false";
					$this->TS_VCSC_Extensions_PostTypes['Widgets'] 													= 0;
				}
				if ((($this->TS_VCSC_PluginExtended == "false") && ($this->TS_VCSC_CustomPostTypesTeam == "true")) || (($this->TS_VCSC_PluginExtended == "true") && ($this->TS_VCSC_UseCustomPostTeam == "true")  && ($this->TS_VCSC_CustomPostTypesTeam == "true") && ($this->TS_VCSC_UseCustomPostTypes == "true"))) {
					$this->TS_VCSC_CustomPostTypesTeam 																= "true";
					$this->TS_VCSC_Extensions_PostTypes['Teams'] 													= 1;
				} else {
					$this->TS_VCSC_CustomPostTypesTeam 																= "false";
					$this->TS_VCSC_Extensions_PostTypes['Teams'] 													= 0;
				}
				if ((($this->TS_VCSC_PluginExtended == "false") && ($this->TS_VCSC_CustomPostTypesTestimonial == "true")) || (($this->TS_VCSC_PluginExtended == "true") && ($this->TS_VCSC_UseCustomPostTestimonial == "true") && ($this->TS_VCSC_CustomPostTypesTestimonial == "true") && ($this->TS_VCSC_UseCustomPostTypes == "true"))) {
					$this->TS_VCSC_CustomPostTypesTestimonial 														= "true";
					$this->TS_VCSC_Extensions_PostTypes['Testimonials'] 											= 1;
				} else {
					$this->TS_VCSC_CustomPostTypesTestimonial 														= "false";
					$this->TS_VCSC_Extensions_PostTypes['Testimonials'] 											= 0;
				}
				if ((($this->TS_VCSC_PluginExtended == "false") && ($this->TS_VCSC_CustomPostTypesLogo == "true")) || (($this->TS_VCSC_PluginExtended == "true") && ($this->TS_VCSC_UseCustomPostLogo == "true") && ($this->TS_VCSC_CustomPostTypesLogo == "true") && ($this->TS_VCSC_UseCustomPostTypes == "true"))) {
					$this->TS_VCSC_CustomPostTypesLogo 																= "true";
					$this->TS_VCSC_Extensions_PostTypes['Logos'] 													= 1;
				} else {
					$this->TS_VCSC_CustomPostTypesLogo 																= "false";
					$this->TS_VCSC_Extensions_PostTypes['Logos'] 													= 0;
				}
				if ((($this->TS_VCSC_PluginExtended == "false") && ($this->TS_VCSC_CustomPostTypesSkillset == "true")) || (($this->TS_VCSC_PluginExtended == "true") && ($this->TS_VCSC_UseCustomPostSkillset == "true") && ($this->TS_VCSC_CustomPostTypesSkillset == "true") && ($this->TS_VCSC_UseCustomPostTypes == "true"))) {
					$this->TS_VCSC_CustomPostTypesSkillset 															= "true";
					$this->TS_VCSC_Extensions_PostTypes['Skillsets'] 												= 1;
				} else {
					$this->TS_VCSC_CustomPostTypesSkillset 															= "false";
					$this->TS_VCSC_Extensions_PostTypes['Skillsets'] 												= 0;
				}
				if ((($this->TS_VCSC_PluginExtended == "false") && ($this->TS_VCSC_CustomPostTypesTimeline == "true")) || (($this->TS_VCSC_PluginExtended == "true") && ($this->TS_VCSC_UseCustomPostTimeline == "true") && ($this->TS_VCSC_CustomPostTypesTimeline == "true") && ($this->TS_VCSC_UseCustomPostTypes == "true"))) {
					$this->TS_VCSC_CustomPostTypesTimeline 															= "true";
					$this->TS_VCSC_Extensions_PostTypes['Timelines'] 												= 1;
				} else {
					$this->TS_VCSC_CustomPostTypesTimeline 															= "false";
					$this->TS_VCSC_Extensions_PostTypes['Timelines'] 												= 0;
				}				
			} else {
				$this->TS_VCSC_CustomPostTypesCheckup																= "false";
				$this->TS_VCSC_CustomPostTypesDownpage																= "false";
				$this->TS_VCSC_CustomPostTypesWidgets 																= "false";
				$this->TS_VCSC_CustomPostTypesTeam 																	= "false";
				$this->TS_VCSC_CustomPostTypesTestimonial 															= "false";
				$this->TS_VCSC_CustomPostTypesLogo 																	= "false";
				$this->TS_VCSC_CustomPostTypesSkillset 																= "false";
				$this->TS_VCSC_CustomPostTypesTimeline 																= "false";
				$this->TS_VCSC_Extensions_PostTypes['Widgets'] 														= 0;
				$this->TS_VCSC_Extensions_PostTypes['Teams'] 														= 0;
				$this->TS_VCSC_Extensions_PostTypes['Testimonials'] 												= 0;
				$this->TS_VCSC_Extensions_PostTypes['Skillsets'] 													= 0;
				$this->TS_VCSC_Extensions_PostTypes['Logos'] 														= 0;
				$this->TS_VCSC_Extensions_PostTypes['Timelines'] 													= 0;
			}
			if (($this->TS_VCSC_CustomPostTypesWidgets == "true") || ($this->TS_VCSC_CustomPostTypesDownpage == "true") || ($this->TS_VCSC_CustomPostTypesTeam == "true") || ($this->TS_VCSC_CustomPostTypesTestimonial == "true") || ($this->TS_VCSC_CustomPostTypesLogo == "true") || ($this->TS_VCSC_CustomPostTypesSkillset == "true") || ($this->TS_VCSC_CustomPostTypesTimeline == "true")) {
				require_once($this->posttypes_dir.'ts_vcsc_custom_post_essentials.php');
				require_once($this->posttypes_dir.'ts_vcsc_custom_post_registration.php');
				$this->TS_VCSC_CustomPostTypesLoaded																	= "true";				
				if ($this->TS_VCSC_CustomPostTypesWidgets == "true") {
					require_once($this->widgets_dir . 'ts_vcsc_widgets_elements.php');
					add_action('admin_footer',				array($this, 'TS_VCSC_Extensions_Admin_Template'));
				}
				if (is_admin()) {
					if (($this->TS_VCSC_CustomPostTypesWidgets == "true") || ($this->TS_VCSC_CustomPostTypesDownpage == "true") || ($this->TS_VCSC_CustomPostTypesTeam == "true") || ($this->TS_VCSC_CustomPostTypesTestimonial == "true") || ($this->TS_VCSC_CustomPostTypesLogo == "true") || ($this->TS_VCSC_CustomPostTypesSkillset == "true") || ($this->TS_VCSC_CustomPostTypesTimeline == "true")) {
                        add_action('plugins_loaded',        array($this, 	'TS_VCSC_CustomPostsCheck'),				777777777);
                        add_action('plugins_loaded',        array($this, 	'TS_VCSC_CustomPostsInit'),					888888888);
					}
				}
				add_action('admin_menu',					array($this, 	'TS_VCSC_RemoveMetaBoxesPostTypeGlobal'));
			} else {
				$this->TS_VCSC_CustomPostTypesLoaded																	= "false";
                if (($this->TS_VCSC_IconicumStandard == "false") && (($this->TS_VCSC_IconicumMenuGenerator == "true") || ($this->TS_VCSC_UseTinyMCEGenerator == "true"))) {
                    add_action('plugins_loaded',            array($this, 	'TS_VCSC_CustomPostsCheck'),				777777777);
                    add_action('plugins_loaded',            array($this, 	'TS_VCSC_CustomPostsInit'),					888888888);
                }
			}
			
			// Create Custom Admin Menu for Plugin
			// -----------------------------------
			require_once($this->registrations_dir . 'ts_vcsc_registrations_menu.php');			

			// Determine Loading + Element Statuses
			// ------------------------------------
			add_action('init',								array($this, 	'TS_VCSC_DetermineLoadingStatus'),			1);
			add_action('init',								array($this, 	'TS_VCSC_DetermineElementStatus'),			2);
			
			// Load Arrays of Font Settings
			// ----------------------------
			add_action('init', 								array($this, 	'TS_VCSC_IconFontsRequired'), 				3);			
			
			// Register Shortcode Definitions
			// ------------------------------
			add_action('init',								array($this, 	'TS_VCSC_RegisterAllShortcodes'), 			888888888);
			
			// Register Composer Elements
			// --------------------------
			add_action('init',								array($this, 	'TS_VCSC_RegisterWithComposer'), 			999999999);
			//add_action('vc_before_init',					array($this, 	'TS_VCSC_RegisterWithComposer'));
			
			// Get Collection of All Public Post Types
			// ---------------------------------------
			add_action('wp_loaded', 						array($this, 	'TS_VCSC_GetPublicPostTypes'));
			
			// Create Post Excerpt without Shortcodes
			// --------------------------------------
			//add_action('after_setup_theme', 				array($this, 	'TS_VCSC_Custom_Excerpt_Routines'));

			// Custom Font Upload Routines
			// ---------------------------
			add_action('admin_init',						array($this, 	'TS_VCSC_ChangeDownloadsUploadDirectory'), 	999999999);
			add_action('admin_notices',						array($this, 	'TS_VCSC_CustomPackInstalledError'));
			
			// Register AJAX Callbacks
			// -----------------------
			add_action('wp_ajax_ts_delete_custom_pack',		array($this, 	'TS_VCSC_DeleteCustomPack_Ajax'));
			add_action('wp_ajax_ts_getpostspages',			array($this, 	'TS_VCSC_GetPostsPages_Ajax'));
			add_action('wp_ajax_ts_savepostmetadata',		array($this, 	'TS_VCSC_SavePostMetaData'));
			add_action('wp_ajax_ts_system_download', 		array($this, 	'TS_VCSC_DownloadSystemInfoData'));
			add_action('wp_ajax_ts_export_settings', 		array($this, 	'TS_VCSC_ExportPluginSettings'));            

			// Allow Shortcodes in Widgets / Sidebar
			// -------------------------------------
			if ($this->TS_VCSC_UseShortcodesWidgets == "true") {
				add_filter('widget_text', 'shortcode_unautop');  
				add_filter('widget_text', 'do_shortcode', 11);
			}
			
			// Remove Auto Paragraphs from Content + Excerpts
			// ----------------------------------------------
			if ($this->TS_VCSC_UseAutoParagraphs == "false") {
				add_action('after_setup_theme', 			array($this,	'TS_VCSC_RemoveAutoParagraphs'));
			}
			
			// Enable / Disable WP Bakery Page Builder Frontend Editor
			// -------------------------------------------------------
			if ((function_exists('vc_enabled_frontend')) && (function_exists('vc_disable_frontend'))) {
				if ($this->TS_VCSC_UseFrontendEditorVC == "false") {
					vc_disable_frontend(true);
				} else if ($this->TS_VCSC_UseFrontendEditorVC == "true") {
					vc_disable_frontend(false);
				}
			}
			
			// Redirect to "About Composium" Page After Activation
			// ---------------------------------------------------
			if (($this->TS_VCSC_PluginIsMultiSiteActive == "false") && ($this->TS_VCSC_ActivationRedirect == "true")) {
				add_action('admin_init',					array($this, 	'TS_VCSC_ActivationRedirect'), 				1);
			}
			
			// Lightbox Media Integrations
			// ---------------------------
			if (($this->TS_VCSC_UseLightboxAutoMedia == "true") && ($this->TS_VCSC_PluginUsage == "true")) {
				add_filter('image_send_to_editor', 			array($this, 	'TS_VCSC_AddLightboxClassMediaEditor'), 	10, 3);
			}
		}
		
		// Check WP Bakery Page Builder Internals
		// --------------------------------------
		function TS_VCSC_VisualComposerCheck() {
			if (defined('WPB_VC_VERSION')) {
				$this->TS_VCSC_VisualComposer_Version 		= WPB_VC_VERSION;
				if (TS_VCSC_VersionCompare(WPB_VC_VERSION, '4.3.0') >= 0) {
					if (get_option('ts_vcsc_extend_settings_backendPreview', 1) == 1) {
						$this->TS_VCSC_EditorLivePreview	= "true";
					} else {
						$this->TS_VCSC_EditorLivePreview	= "false";
					}
				} else {
					$this->TS_VCSC_EditorLivePreview		= "false";
				}
				if (TS_VCSC_VersionCompare(WPB_VC_VERSION, '4.4.0') >= 0) {
					$this->TS_VCSC_EditorIconFontsInternal	= "true";
					$this->TS_VCSC_VisualComposer_Compliant	= "true";
					$this->TS_VCSC_EditorFullWidthInternal	= "true";
				} else {
					$this->TS_VCSC_EditorIconFontsInternal	= "false";
					$this->TS_VCSC_VisualComposer_Compliant	= "false";
					$this->TS_VCSC_EditorFullWidthInternal	= "false";
				}
				if ((TS_VCSC_VersionCompare(WPB_VC_VERSION, '4.9.0') >= 0) && (function_exists('vc_lean_map'))) {
					$this->TS_VCSC_VisualComposer_LeanMap 	= "true";
				} else {
					$this->TS_VCSC_VisualComposer_LeanMap 	= "false";
				}
			} else {
				$this->TS_VCSC_EditorLivePreview			= "false";
				$this->TS_VCSC_EditorIconFontsInternal		= "false";
				$this->TS_VCSC_VisualComposer_Version		= __( "Not Activated", "ts_visual_composer_extend" );
				$this->TS_VCSC_VisualComposer_Compliant		= "false";
				$this->TS_VCSC_VisualComposer_LeanMap 		= "false";
                $this->TS_VCSC_VisualComposer_Loading       = "false";
				$this->TS_VCSC_EditorFullWidthInternal		= "false";
                $this->TS_VCSC_UseExtendedRows              = "false";
                $this->TS_VCSC_UseExtendedColumns           = "false";
			}
		}
        
        // Check for Gutenberg Editor
        // --------------------------
		function TS_VCSC_GutenbergStatusCheck() {
			$this->TS_VCSC_GutenbergPlugin                  = "false";
			$this->TS_VCSC_GutenbergBlocks                  = "false";
            $this->TS_VCSC_GutenbergExists                  = "false";
			if (has_filter('replace_editor', 'gutenberg_init')) {
				$this->TS_VCSC_GutenbergPlugin              = "true";
                $this->TS_VCSC_GutenbergExists              = "true";
			}		
            if (TS_VCSC_VersionCompare($GLOBALS['wp_version'], '5.0-beta') >= 0) {
				$this->TS_VCSC_GutenbergBlocks              = "true";
                $this->TS_VCSC_GutenbergExists              = "true";
			}
		}
		
		// Initialize Custom Post Types Framework
		// --------------------------------------
        function TS_VCSC_CustomPostsCheck() {
            if (!class_exists('CSF')) {
                $this->TS_VCSC_CodestarInternal             = "true";
            } else {
                $this->TS_VCSC_CodestarInternal             = "false";
            }
        }
        function TS_VCSC_CustomPostsInit() {
			global $pagenow;            
			$this->TS_VCSC_UseCodestarFramework				= "false";
			$this->TS_VCSC_VCStandardEditMode				= (TS_VCSC_IsEditPagePost() == 1 ? "true" : "false");
			$this->TS_VCSC_VCCurrentPostTypeEdit			= TS_VCSC_GetCurrentPostType();
            $this->TS_VCSC_GeneratorPosts                   = $this->TS_VCSC_UsePostTypesGenerator;
            $this->TS_VCSC_GeneratorType                    = $this->TS_VCSC_VCCurrentPostTypeEdit;
            $this->TS_VCSC_GeneratorEdit			        = $this->TS_VCSC_VCStandardEditMode;
            $this->TS_VCSC_GeneratorAjax			        = strpos('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'admin-ajax.php');
            if ($this->TS_VCSC_GeneratorAjax !== false) {            
                $this->TS_VCSC_GeneratorHTTP                = parse_url($_SERVER['HTTP_REFERER']);
            } else {
                $this->TS_VCSC_GeneratorHTTP                = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            }
            if ($this->TS_VCSC_GeneratorType == "") {
                if (is_string($this->TS_VCSC_GeneratorHTTP)) {
                    $this->TS_VCSC_GeneratorType            = $this->TS_VCSC_GetValueFromStringURL($this->TS_VCSC_GeneratorHTTP, 'post_type');
                } else {
                    $this->TS_VCSC_GeneratorType            = '';
                }
                if (($this->TS_VCSC_GeneratorType == "") && (is_string($this->TS_VCSC_GeneratorHTTP))) {
                    $this->TS_VCSC_GeneratorType            = ((preg_match('/post-new.php|post.php/i', $this->TS_VCSC_GeneratorHTTP)) ? 'post' : '');
                }
            }
			if ($this->TS_VCSC_GeneratorAjax !== false) {
				if ($this->TS_VCSC_GeneratorEdit == "false") {
					$this->TS_VCSC_GeneratorRefer		    = strpos('http://' . $_SERVER['HTTP_REFERER'], '?page=TS_VCSC_Generator');
					if (($this->TS_VCSC_GeneratorRefer === false) && ($this->TS_VCSC_UseTinyMCEGenerator == "true")) {
						$this->TS_VCSC_GeneratorRefer	    = (preg_match('/post-new.php|post.php/i', 'http://' . $_SERVER['HTTP_REFERER']));
					}
				} else {
					$this->TS_VCSC_GeneratorRefer		    = false;
				}
			} else {
				$this->TS_VCSC_GeneratorRefer			    = false;
			}
			$this->TS_VCSC_GeneratorPage 			        = strpos('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], '?page=TS_VCSC_Generator');	
            // Check Conditions
			if (is_admin()) {
				if (($this->TS_VCSC_GeneratorEdit == "false") && (($this->TS_VCSC_GeneratorPage !== false) || ($this->TS_VCSC_GeneratorRefer !== false))) {
					$this->TS_VCSC_GeneratorLoad	        = "true";                    
				} else if ($this->TS_VCSC_GeneratorEdit == "true") {
                    if (($this->TS_VCSC_UseTinyMCEGenerator == "true") && (in_array($this->TS_VCSC_GeneratorType, $this->TS_VCSC_GeneratorPosts))) {                        
                        $this->TS_VCSC_GeneratorLoad        = "true";                   
                    } else {
                        $this->TS_VCSC_GeneratorLoad       = "false";
                    }
				} else {
                    $this->TS_VCSC_GeneratorLoad           = "false";
				}
			} else {
				$this->TS_VCSC_GeneratorLoad               = "false";
			}
            foreach ($this->TS_VCSC_PostTypeMenuNames_Default as $key => $value) {
				if (($this->TS_VCSC_VCCurrentPostTypeEdit == $key) && ($key != "ts_widgets")) {
					$this->TS_VCSC_UseCodestarFramework		= "true";
				}
			}
			if ((is_admin()) && (($pagenow == 'post-new.php') || ($pagenow == 'post.php') || ($pagenow == 'edit.php'))) {
				if ((($this->TS_VCSC_UseCodestarFramework == "true") && ($this->TS_VCSC_PluginPHP == "true")) || ($this->TS_VCSC_VCCurrentPostTypeEdit == "ts_widgets")) {
					$this->TS_VCSC_CustomsPostsRoutines($this->TS_VCSC_VCCurrentPostTypeEdit);
				}
			}            
			if (($this->TS_VCSC_GeneratorLoad == "true") || (($this->TS_VCSC_VCStandardEditMode == "true") && (is_admin()) && ($this->TS_VCSC_UseCodestarFramework == "true") && ($this->TS_VCSC_PluginPHP == "true") && (($pagenow == 'post-new.php') || ($pagenow == 'post.php')))) {
                if (($this->TS_VCSC_IconicumStandard == "false") && ($this->TS_VCSC_GeneratorLoad == "true")) {
                    require_once($this->registrations_dir . 'ts_vcsc_registrations_generator.php');
                }
                if ($this->TS_VCSC_CodestarInternal == "true") {
					require_once('codestar/codestar-framework.php');
				}
				require_once($this->registrations_dir . 'ts_vcsc_registrations_codestar.php');                
			}            
		}
		function TS_VCSC_CustomsPostsRoutines($posttype) {
			if (($this->TS_VCSC_CustomPostTypesDownpage == "true") && ($posttype == "ts_widgets")) {
				require_once($this->posttypes_dir . 'ts_vcsc_custom_post_templates.php');
			} else if (($this->TS_VCSC_CustomPostTypesDownpage == "true") && ($posttype == "ts_downtime")) {
				require_once($this->posttypes_dir . 'ts_vcsc_custom_post_downpages.php');
			} else if (($this->TS_VCSC_CustomPostTypesTeam == "true") && ($posttype == "ts_team")) {
				require_once($this->posttypes_dir . 'ts_vcsc_custom_post_team.php');
			} else if (($this->TS_VCSC_CustomPostTypesTestimonial == "true") && ($posttype == "ts_testimonials")) {
				require_once($this->posttypes_dir . 'ts_vcsc_custom_post_testimonials.php');
			} else if (($this->TS_VCSC_CustomPostTypesSkillset == "true") && ($posttype == "ts_skillsets")) {
				require_once($this->posttypes_dir . 'ts_vcsc_custom_post_skillsets.php');
			} else if (($this->TS_VCSC_CustomPostTypesTimeline == "true") && ($posttype == "ts_timeline")) {
				require_once($this->posttypes_dir . 'ts_vcsc_custom_post_timeline.php');
			} else if (($this->TS_VCSC_CustomPostTypesLogo == "true") && ($posttype == "ts_logos")) {
				require_once($this->posttypes_dir . 'ts_vcsc_custom_post_logos.php');
			}
		}
        function TS_VCSC_GetValueFromStringURL($url , $parameter_name) {
            $parts                                      = parse_url($url);
            if (isset($parts['query'])) {
                parse_str($parts['query'], $query);
                if(isset($query[$parameter_name])) {
                    return $query[$parameter_name];
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }
		
		// Initialize Mobile Detector
		// --------------------------
		function TS_VCSC_MobileDetectorInit() {
			// Load Detector Class
			if (!class_exists('Mobile_Detect')) {
				require_once($this->detector_dir . 'ts_mobile_detect.php');
			}
			// Check Device Type
			if ((class_exists('Mobile_Detect')) && ($this->TS_VCSC_PluginMobile == "false")) {
				$this->TS_VCSC_MobileDetector_Global			= new Mobile_Detect;
				$this->TS_VCSC_MobileDetector_Mobile			= ($this->TS_VCSC_MobileDetector_Global->isMobile() == 1 ? 'true' : 'false');
				$this->TS_VCSC_MobileDetector_Tablet			= ($this->TS_VCSC_MobileDetector_Global->isTablet() == 1 ? 'true' : 'false');
				$this->TS_VCSC_MobileDetector_Phone				= (($this->TS_VCSC_MobileDetector_Mobile == "true" &&  $this->TS_VCSC_MobileDetector_Tablet == "false") ? 'true' : 'false');
				if ($this->TS_VCSC_MobileDetector_Mobile == 'false') {
					$this->TS_VCSC_MobileDetector_Desktop		= 'true';
				} else {
					$this->TS_VCSC_MobileDetector_Desktop		= 'false';
				}
				unset($this->TS_VCSC_MobileDetector_Global);
				$this->TS_VCSC_PluginMobile						= 'true';
			}
		}
		
		// Check + Initialize Downtime Mode
		// --------------------------------
		function TS_VCSC_DowntimeManagerInit() {
			if ($this->TS_VCSC_Downtime_Manager_Settings['active'] == 1) {
				// Init Mobile Detector Routine
				$this->TS_VCSC_MobileDetectorInit();
				// Redirect WordPress to Downpage
				require_once($this->registrations_dir . 'ts_vcsc_registrations_downpage.php');
			}
		}
		
		// Create Additional Sidebars
		// --------------------------
		function TS_VCSC_CustomSidebarsInit() {
			$Sidebars_Count				= $this->TS_VCSC_Sidebars_Manager_Settings["count"];
			$Sidebars_Names				= $this->TS_VCSC_Sidebars_Manager_Settings["names"];
			$Sidebars_Names				= explode(",", $Sidebars_Names);
			if (!is_array($Sidebars_Names)) {
				$Sidebars_Names			= array();
			}
			if ($Sidebars_Count > 0) {
				for ($i=1; $i<=$Sidebars_Count; $i++) {
					if (isset($Sidebars_Names[$i - 1]) && ($Sidebars_Names[$i - 1] != '')) {
						$Siderbar_Name	= $Sidebars_Names[$i - 1];
					} else {
						$Siderbar_Name	= "Custom Sidebar #" . $i;
					}
					$args = array(
						'name'          => $Siderbar_Name,
						'id'            => "ts-custom-sidebar-" . $i,
						'description'   => '',
						'class'         => '',
						'before_widget' => '<li id="%1$s" class="widget %2$s">',
						'after_widget'  => '</li>',
						'before_title'  => '<h2 class="widgettitle">',
						'after_title'   => '</h2>',
					);					
					register_sidebar($args);
				}
			}
		}

		// Activation Redirect
		// -------------------
		function TS_VCSC_ActivationRedirect() {
			wp_redirect(admin_url('admin.php?page=TS_VCSC_About'));
			update_option('ts_vcsc_extend_settings_activation', 			1);
			update_option('ts_vcsc_extend_settings_redirect', 				0);
		}
		
		// Create Post Excerpt without Shortcodes
		// --------------------------------------
		function TS_VCSC_Custom_Excerpt_Routines() {
			// Setze Auszugslänge Global auf 100 Wörter
			function TS_VCSC_Custom_Excerpt_Length($length) {
				return 100;
			}
			add_filter('excerpt_length', 'TS_VCSC_Custom_Excerpt_Length', 	888);
			
			// Entferne Standard WP Routine für den Beitragsauszug
			remove_filter('get_the_excerpt', 'wp_trim_excerpt');
			
			// Erstellt Auszugsinhalt unter Berücksichtigung von WBP Textblock Inhalten
			function TS_VCSC_Custom_Excerpt_Content($text) {
				global $post;
				// Speichere RAW Auszugs Text
				$excerpt_rawcode	= $text;
				// Setze Auszugslänge auf 100 Wörter
				$excerpt_length 	= apply_filters('excerpt_length', 		100);
				// Definiere den Indikator für mehr Inhalt
				$excerpt_more 		= apply_filters('excerpt_more', ' ' . '[...]');
				// Entferne WBP Textblock Shortcodes vom Filter
				$excerpt_composer 	= array('vc_column_text', 'TS_VCSC_Advanced_Textblock');
				$excerpt_values		= array_values($excerpt_composer);
				$excerpt_exclude  	= implode('|', $excerpt_values);
				// Nutze Beitragsinhalt wenn kein Auszug vorhanden	
				if ('' == $text) {
					$text 			= get_the_content('');
					$text			= preg_replace("~(?:\[/?)(?!(?:$excerpt_exclude))[^/\]]+/?\]~s", '', $text);
					$text 			= apply_filters('the_content', $text);
					$text 			= str_replace(']]>', ']]&gt;', $text);
				}
				// Entferne jedweden HTML oder PHP Code
				$text 				= strip_tags($text);
				// Kürze Ausug auf die Anzahl von vorgegebenen Wörtern
				$text 				= wp_trim_words($text, $excerpt_length, $excerpt_more);
				return apply_filters('wp_trim_excerpt', $text, $excerpt_rawcode);
			}
			add_filter('get_the_excerpt', 'TS_VCSC_Custom_Excerpt_Content', 999);
		}
		
		// Determine User Role
		// -------------------
		function TS_VCSC_DetermineCurrentUser() {
			global $current_user;
			if ((isset($current_user->roles)) && (!empty($current_user->roles))) {
				foreach ($current_user->roles as $key => $value) {
					if ($value == 'administrator') {
						$this->TS_VCSC_UserIsAdministrator      = "true";
						break;
					}
				}
			}
		}
		
		// Determine Registered Post Types
		function TS_VCSC_GetPublicPostTypes() {
            // Check if Routine is necessary
            $this->TS_VCSC_PublicPostRequireCheck							= array();
            $this->TS_VCSC_PublicPostRequireCheck[]                         = (isset($this->TS_VCSC_Visual_Composer_Elements['TS Posts Isotope Grid']['active']) ? $this->TS_VCSC_Visual_Composer_Elements['TS Posts Isotope Grid']['active'] : "false");
            $this->TS_VCSC_PublicPostRequireCheck[]                         = (isset($this->TS_VCSC_Visual_Composer_Elements['TS Posts Image Grid']['active']) ? $this->TS_VCSC_Visual_Composer_Elements['TS Posts Image Grid']['active'] : "false");          
            $this->TS_VCSC_PublicPostRequireCheck[]                         = (isset($this->TS_VCSC_Visual_Composer_Elements['TS Posts Slider']['active']) ? $this->TS_VCSC_Visual_Composer_Elements['TS Posts Slider']['active'] : "false");
            $this->TS_VCSC_PublicPostRequireCheck[]                         = (isset($this->TS_VCSC_Visual_Composer_Elements['TS Posts Ticker']['active']) ? $this->TS_VCSC_Visual_Composer_Elements['TS Posts Ticker']['active'] : "false");
            $this->TS_VCSC_PublicPostRequireCheck[]                         = (isset($this->TS_VCSC_Visual_Composer_Elements['TS Posts Timeline']['active']) ? $this->TS_VCSC_Visual_Composer_Elements['TS Posts Timeline']['active'] : "false");
            if (in_array("true", $this->TS_VCSC_PublicPostRequireCheck)) {
                // Get All Public Custom Post Types			
                $this->TS_VCSC_PublicPostTypesSelect						= array();
                $this->TS_VCSC_PublicPostTypesDepend						= array();
                $this->TS_VCSC_PublicPostTypesFound							= get_post_types(array('public' => true, '_builtin' => false,), 'object', 'and');
                $this->TS_VCSC_PublicPostTypesSelect[__( "Standard Post Type", "ts_visual_composer_extend" )] = "post";
                foreach ($this->TS_VCSC_PublicPostTypesFound as $post_type) {
                    if (post_type_supports($post_type->name, 'editor')) {
                        $this->TS_VCSC_PublicPostTypesSelect[$post_type->label  . ' (' . $post_type->name . ')']	= $post_type->name;
                        array_push($this->TS_VCSC_PublicPostTypesDepend, $post_type->name);				
                    }
                }
                // Get All Public Custom Taxonomies
                $this->TS_VCSC_PublicPostTaxosSelect 						= array();
                $this->TS_VCSC_PublicPostTaxosFound							= get_taxonomies(array('public' => true, '_builtin' => false), 'objects', 'and');			
                if ($this->TS_VCSC_PublicPostTaxosFound) {
                    foreach ($this->TS_VCSC_PublicPostTaxosFound as $taxonomy) {
                        if (array_key_exists(0, $taxonomy->object_type)) {                        
                            $this->TS_VCSC_PublicPostTaxosSelect[$taxonomy->label . ' (' . $taxonomy->object_type[0] . ')'] = $taxonomy->name;
                        } else if (array_key_exists(1, $taxonomy->object_type)) {
                            $this->TS_VCSC_PublicPostTaxosSelect[$taxonomy->label . ' (' . $taxonomy->object_type[1] . ')'] = $taxonomy->name;
                        }
                    }
                }
                // Unset Variables
                unset($this->TS_VCSC_PublicPostTypesFound);
                unset($this->TS_VCSC_PublicPostTaxosFound);
            }
            unset($this->TS_VCSC_PublicPostRequireCheck);
		}
		
		// Lightbox Media Integrations
		// ---------------------------
		function TS_VCSC_AddLightboxClassMediaEditor($html, $id, $attachment) {
			$linkptrn 														= "/<a(.*?)href=('|\")(.*?).(bmp|BMP|gif|GIF|jpeg|JPEG|jpg|JPG|png|PNG)('|\")(.*?)>/i";
			$found 															= preg_match($linkptrn, $html, $a_elem);
			// If no Link, do nothing
			if ($found <= 0) {return $html;};
			$a_elem 														= $a_elem[0];
			// Check to see if the link is to an uploaded image
			$is_attachment_link 											= strstr($a_elem, "wp-content/uploads/");
			// If link is to external resource, do nothing
			if ($is_attachment_link === FALSE) {return $html;};
			// Add data-title Attribute
			$a_title 														= get_the_title($id); 
			$a_data  														= 'data-title="' . $a_title . '"';
			// Add Lightbox Class Name
			$html 															= str_replace( "<a ", "<a {$a_data} ", $html );
			if (strstr($a_elem, "class=\"") !== FALSE) {
				// If link already has class defined inject it to attribute
				$a_elem_new 												= str_replace("class=\"", "class=\"ts-lightbox-integration no-ajaxy", $a_elem);
				$html 														= str_replace($a_elem, $a_elem_new, $html);
			} else {
				// If no class defined, just add class attribute
				$html 														= str_replace("<a ", "<a class=\"ts-lightbox-integration no-ajaxy\" ", $html);
			}
			return $html;
		}		
		
		// Load Language Domain
		// --------------------
		function TS_VCSC_LoadTextDomains(){
			if (($this->TS_VCSC_VCFrontEditMode == "true") || ($this->TS_VCSC_VisualComposer_Loading == "true")) {
				load_plugin_textdomain('ts_visual_composer_extend', false, dirname(plugin_basename( __FILE__ )) . '/locale');
			}
		}
		
		
		// Remove Auto-Paragrpahs for Content + Excerpts
		// ---------------------------------------------
		function TS_VCSC_RemoveAutoParagraphs() {
			remove_filter('the_content', 'wpautop');
			remove_filter('the_excerpt', 'wpautop');
		}

		
		// Remove Metaboxes from Custom Post Types
		// ---------------------------------------
		function TS_VCSC_RemoveMetaBoxesPostTypeGlobal() {
			foreach ($this->TS_VCSC_PostTypeMenuNames_Default as $key => $value) {
				if (post_type_exists($key)) {
					$this->TS_VCSC_RemoveMetaBoxesPostTypeSingle($key);
				}
			}
		}
		function TS_VCSC_RemoveMetaBoxesPostTypeSingle($posttype) {
			remove_meta_box('commentstatusdiv', 	$posttype, 				'normal');
			remove_meta_box('commentsdiv', 			$posttype, 				'normal');
			remove_meta_box('slugdiv', 				$posttype, 				'normal');
		}
		
		
		// Declare Arrays with Icon Font Data
		// ----------------------------------
		function TS_VCSC_IconFontsRequired() {
			if (($this->TS_VCSC_PluginFontSummary == "true") || ($this->TS_VCSC_VisualComposer_Loading == "true") || ($this->TS_VCSC_VCFrontEditMode == "true") || ($this->TS_VCSC_Icons_Compliant_Loading == "true") || ($this->TS_VCSC_IconicumMenuGenerator == "true")) {
				$this->TS_VCSC_IconFontsArrays(false);
			}
		}
		function TS_VCSC_IconFontsArrays($generator = false) {
			// Define Arrays for Font Icons
			// ----------------------------
			$this->TS_VCSC_Active_Icon_Fonts          	= 0;
			$this->TS_VCSC_Active_Icon_Count          	= 0;
			$this->TS_VCSC_Total_Icon_Count           	= 0;
			$this->TS_VCSC_Default_Icon_Fonts         	= array();

			// Define Global Font Arrays
			$this->TS_VCSC_Icons_Blank 					= array(
				'' 						=> '',
			);
			$this->TS_VCSC_Fonts_Blank 					= array(
				'All Fonts' 			=> '',
			);
			
			// Set Array for Full Icon List based on Icon Picker
			$this->TS_VCSC_List_Icons_Compliant			= array();	
			
			$this->TS_VCSC_List_Active_Fonts          	= array();
			$this->TS_VCSC_List_Select_Fonts          	= $this->TS_VCSC_Fonts_Blank;
			
			$this->TS_VCSC_List_Initial_Icons         	= $this->TS_VCSC_Icons_Blank;
			
			$this->TS_VCSC_Name_Initial_Font          	= "";
			$this->TS_VCSC_Class_Initial_Font         	= "";
			
			$TS_VCSC_IconFont_Settings 					= get_option('ts_vcsc_extend_settings_IconFontSettings', 	'');
			$TS_VCSC_IconFont_Override					= get_option('ts_vcsc_extend_settings_tinymceFontsAll', 	0);
			
			// Add "Composium" Internal Fonts
			foreach ($this->TS_VCSC_Icon_Font_Settings as $Icon_Font => $iconfont) {
				if ($iconfont['setting'] != 'Custom') {
					$this->TS_VCSC_Default_Icon_Fonts[$Icon_Font] 								= $iconfont['setting'];
					// Check if Font is enabled
					$default 																	= ($iconfont['default'] == "true" ? 1 : 0);
					$this->{'TS_VCSC_tinymce' . $iconfont['setting'] . ''}              		= get_option('ts_vcsc_extend_settings_tinymce' . $iconfont['setting'], $default);
					// Load Font Arrays					
					if ((!isset($this->{'TS_VCSC_Icons_' . $iconfont['setting'] . ''})) && (($this->{'TS_VCSC_tinymce' . $iconfont['setting'] . ''} == 1) || ($TS_VCSC_IconFont_Override == 1))) {
						if (($generator) || ($this->TS_VCSC_IconicumMenuGenerator == "true")) {
                            require_once($this->assets_dir.('ts_vcsc_font_' . strtolower($iconfont['setting']) . '.php'));
                        } else if (($this->TS_VCSC_VisualComposer_Loading == "true") || ($this->TS_VCSC_Icons_Compliant_Loading == "true")) {
							require_once($this->assets_dir.('ts_vcsc_font_' . strtolower($iconfont['setting']) . '.php'));
						} else {
							$this->{'TS_VCSC_Icons_Compliant_' . $iconfont['setting'] . ''}		= array();
						}
					} else {
						$this->{'TS_VCSC_Icons_Compliant_' . $iconfont['setting'] . ''}			= array();
					}
					// Get Icon Count in Font
					$this->{'TS_VCSC_tinymce' . $iconfont['setting'] . 'Count'}					= $iconfont['count'];
					// Add Font Icons to Global Arrays
					if (($this->{'TS_VCSC_tinymce' . $iconfont['setting'] . ''} == 0) && ($TS_VCSC_IconFont_Override == 0)) {
						$this->TS_VCSC_Icon_Font_Settings[$Icon_Font]['active'] 				= "false";
					} else {
						$this->TS_VCSC_Active_Icon_Fonts++;
						$this->TS_VCSC_List_Active_Fonts[$Icon_Font] 							= $iconfont['setting'];
						$this->TS_VCSC_Icon_Font_Settings[$Icon_Font]['active'] 				= "true";
						uksort($this->{'TS_VCSC_Icons_Compliant_' . $iconfont['setting'] . ''}, "TS_VCSC_CaseInsensitiveSort");
						$this->TS_VCSC_Active_Icon_Count  										= $this->TS_VCSC_Active_Icon_Count + $this->{'TS_VCSC_tinymce' . $iconfont['setting'] . 'Count'};
						if ($this->TS_VCSC_Active_Icon_Fonts == 1) {
							$this->TS_VCSC_List_Initial_Icons 									= $this->TS_VCSC_List_Initial_Icons + $this->{'TS_VCSC_Icons_Compliant_' . $iconfont['setting'] . ''};
							$this->TS_VCSC_Name_Initial_Font 									= $Icon_Font;
							$this->TS_VCSC_Class_Initial_Font 									= $iconfont['setting'];
						}
					}
					$this->TS_VCSC_List_Icons_Compliant											= $this->TS_VCSC_List_Icons_Compliant + $this->{'TS_VCSC_Icons_Compliant_' . $iconfont['setting'] . ''};
					$this->TS_VCSC_Total_Icon_Count       										= $this->TS_VCSC_Total_Icon_Count + $this->{'TS_VCSC_tinymce' . $iconfont['setting'] . 'Count'};
				}
			}
			
			// Add WP Bakery Page Builder Internal Fonts (WBP v4.4.0+)
			if ($this->TS_VCSC_EditorIconFontsInternal == "true") {
				foreach ($this->TS_VCSC_Composer_Font_Settings as $Icon_Font => $iconfont) {
					$this->TS_VCSC_Default_Icon_Fonts[$Icon_Font] 								= $iconfont['setting'];
					// Check if Font is enabled
					$default 																	= ($iconfont['default'] == "true" ? 1 : 0);					
					$this->{'TS_VCSC_tinymce' . $iconfont['setting'] . ''}              		= get_option('ts_vcsc_extend_settings_tinymce' . $iconfont['setting'], $default);
					// Load Font Arrays
					if ((!isset($this->{'TS_VCSC_Icons_' . $iconfont['setting'] . ''})) && (($this->{'TS_VCSC_tinymce' . $iconfont['setting'] . ''} == 1) || ($TS_VCSC_IconFont_Override == 1))) {
						if (($generator) || ($this->TS_VCSC_IconicumMenuGenerator == "true")) {
                            require_once($this->assets_dir.('ts_vcsc_font_' . strtolower($iconfont['setting']) . '.php'));
                        } else if (($this->TS_VCSC_VisualComposer_Loading == "true") || ($this->TS_VCSC_Icons_Compliant_Loading == "true")) {
							require_once($this->assets_dir.('ts_vcsc_font_' . strtolower($iconfont['setting']) . '.php'));
						} else {
							$this->{'TS_VCSC_Icons_Compliant_' . $iconfont['setting'] . ''}		= array();
						}
					} else {
						$this->{'TS_VCSC_Icons_Compliant_' . $iconfont['setting'] . ''}			= array();
					}
					// Get Icon Count in Font
					$this->{'TS_VCSC_tinymce' . $iconfont['setting'] . 'Count'}					= $iconfont['count'];
					// Add Font Icons to Global Arrays					
					if (($this->{'TS_VCSC_tinymce' . $iconfont['setting'] . ''} == 0) && ($TS_VCSC_IconFont_Override == 0)) {
						$this->TS_VCSC_Composer_Font_Settings[$Icon_Font]['active'] 			= "false";
					} else {
						$this->TS_VCSC_Active_Icon_Fonts++;
						$this->TS_VCSC_List_Active_Fonts[$Icon_Font] 							= $iconfont['setting'];
						$this->TS_VCSC_Composer_Font_Settings[$Icon_Font]['active'] 			= "true";
						uksort($this->{'TS_VCSC_Icons_Compliant_' . $iconfont['setting'] . ''}, "TS_VCSC_CaseInsensitiveSort");
						$this->TS_VCSC_Active_Icon_Count  										= $this->TS_VCSC_Active_Icon_Count + $this->{'TS_VCSC_tinymce' . $iconfont['setting'] . 'Count'};
						if ($this->TS_VCSC_Active_Icon_Fonts == 1) {
							$this->TS_VCSC_List_Initial_Icons 									= $this->TS_VCSC_List_Initial_Icons + $this->{'TS_VCSC_Icons_Compliant_' . $iconfont['setting'] . ''};
							$this->TS_VCSC_Name_Initial_Font 									= $Icon_Font;
							$this->TS_VCSC_Class_Initial_Font 									= $iconfont['setting'];
						}
					}
					$this->TS_VCSC_List_Icons_Compliant											= $this->TS_VCSC_List_Icons_Compliant + $this->{'TS_VCSC_Icons_Compliant_' . $iconfont['setting'] . ''};
					$this->TS_VCSC_Total_Icon_Count       										= $this->TS_VCSC_Total_Icon_Count + $this->{'TS_VCSC_tinymce' . $iconfont['setting'] . 'Count'};
				}
			}
			
			// Add Custom Icon Font to Global Arrays (if enabled)
			if ((($this->TS_VCSC_PluginExtended == "true") && (get_option('ts_vcsc_extend_settings_fontimport', 1) == 1)) || ($this->TS_VCSC_PluginExtended == "false")) {
				if (($this->TS_VCSC_UseCustomIconFontUpload == "true") && (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') != '') && (get_option('ts_vcsc_extend_settings_tinymceCustomCount', 0) > 0)) {
					$this->TS_VCSC_Icons_Custom           										= get_option('ts_vcsc_extend_settings_tinymceCustomArray');
				} else {
					$this->TS_VCSC_Icons_Custom          										= array();
				}
				$this->TS_VCSC_Icons_Compliant_Custom = array(
					"Custom User Font" 															=> array()
				);
				$font_path																		= get_option('ts_vcsc_extend_settings_tinymceCustomPath', '');
				$font_directory																	= get_option('ts_vcsc_extend_settings_tinymceCustomDirectory', '');
				if (file_exists($font_directory . '/style.css')) {
					$font_files_style															= true;
				} else if (file_exists($font_path)) {
					$font_files_style															= true;
				} else {
					$font_files_style															= false;
				}
				if (($this->TS_VCSC_UseCustomIconFontUpload == "true") && ($font_files_style == true)) {
					$this->TS_VCSC_Default_Icon_Fonts[$Icon_Font] 								= $iconfont['setting'];
					$this->TS_VCSC_Active_Icon_Fonts++;
					$this->TS_VCSC_List_Active_Fonts['Custom User Font'] 						= 'Custom';
					$this->TS_VCSC_List_Icons_Custom          									= $this->TS_VCSC_Icons_Custom;
					if (count(($this->TS_VCSC_Icons_Custom)) > 1) {
						if (is_array($this->TS_VCSC_Icons_Custom)) {
							$this->TS_VCSC_tinymceCustomCount									= count(array_unique($this->TS_VCSC_Icons_Custom));
						} else {
							$this->TS_VCSC_tinymceCustomCount									= count($this->TS_VCSC_Icons_Custom);
						}
					} else {
						$this->TS_VCSC_tinymceCustomCount       								= count($this->TS_VCSC_Icons_Custom);
					}
					$this->TS_VCSC_Icon_Font_Settings['Custom User Font']['count'] 				= $this->TS_VCSC_tinymceCustomCount;
					$this->TS_VCSC_Total_Icon_Count           									= $this->TS_VCSC_Total_Icon_Count + $this->TS_VCSC_tinymceCustomCount;
					$this->TS_VCSC_Active_Icon_Count          									= $this->TS_VCSC_Active_Icon_Count + $this->TS_VCSC_tinymceCustomCount;
					if ($this->TS_VCSC_Active_Icon_Fonts == 1) {
						$this->TS_VCSC_List_Initial_Icons     									= $this->TS_VCSC_List_Initial_Icons + $this->TS_VCSC_Icons_Compliant_Custom;
						$this->TS_VCSC_Name_Initial_Font      									= 'Custom User Font';
						$this->TS_VCSC_Class_Initial_Font     									= 'Custom';
					}					
					foreach ($this->TS_VCSC_List_Icons_Custom as $key => $option) {
						$custom_array 															= array();
						$custom_array[$key] 													= $key; //$option
						array_push($this->TS_VCSC_Icons_Compliant_Custom["Custom User Font"], $custom_array);
					}
					$this->TS_VCSC_List_Icons_Compliant											= $this->TS_VCSC_List_Icons_Compliant + $this->TS_VCSC_Icons_Compliant_Custom;
					$this->TS_VCSC_IconSelectorComposer 										= 'true';
				} else if ($font_files_style == false) {					
					TS_VCSC_ResetCustomFont(); 
				}
			} else {
				$this->TS_VCSC_DeleteCustomPack_Ajax();
			}
			
			$this->TS_VCSC_List_Select_Fonts          											= $this->TS_VCSC_List_Select_Fonts + $this->TS_VCSC_List_Active_Fonts;
			
			// Define Icon Selector Settings
			$this->TS_VCSC_IconSelectorPager			= intval(get_option('ts_vcsc_extend_settings_nativePaginator', '200'));
			$this->TS_VCSC_IconSelectorString			= __( "Manually enter the class name for the icon you want to use for this element.", "ts_visual_composer_extend" ) . '<br/><a href="' . site_url() . '/wp-admin/admin.php?page=TS_VCSC_Previews" target="_blank">' . __( "Find Icon Class Name", "ts_visual_composer_extend" ) . '</a>';
		}
		function TS_VCSC_IconFontsEnqueue($forceload = false) {
			// Enqueue Internal Composium Fonts
			foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
				$default = ($iconfont == "Awesome" ? 1 : 0);                
				if (!$forceload) {
					if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, $default) == 1) && ($iconfont != "Custom") && ($iconfont != "Dashicons")) {
						wp_enqueue_style('ts-font-' . strtolower($iconfont));
					} else if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, $default) == 1) && ($iconfont != "Custom") && ($iconfont == "Dashicons")) {
						wp_enqueue_style('dashicons');
						wp_enqueue_style('ts-font-' . strtolower($iconfont));
					} else if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, $default) == 1) && ($iconfont == "Custom")) {
						wp_enqueue_style('ts-font-' . strtolower($iconfont) . 'vcsc');
					}
				} else {
					if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, $default) == 1) && (get_option('ts_vcsc_extend_settings_load' . $iconfont, 0) == 1) && ($iconfont != "Custom") && ($iconfont != "Dashicons")) {
						wp_enqueue_style('ts-font-' . strtolower($iconfont));
					} else if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, $default) == 1) && (get_option('ts_vcsc_extend_settings_load' . $iconfont, 0) == 1) && ($iconfont != "Custom") && ($iconfont == "Dashicons")) {
						wp_enqueue_style('dashicons');
						wp_enqueue_style('ts-font-' . strtolower($iconfont));
					} else if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, $default) == 1) && (get_option('ts_vcsc_extend_settings_load' . $iconfont, 0) == 1) && ($iconfont == "Custom")) {
						$Custom_Font_CSS = get_option('ts_vcsc_extend_settings_tinymceCustomPath', '');
						wp_enqueue_style('ts-font-' . strtolower($iconfont) . 'vcsc');
					}
				}
			}
			// Enqueue Internal WP Bakery Page Builder Fonts
			if ($this->TS_VCSC_EditorIconFontsInternal == "true") {
				foreach ($this->TS_VCSC_Composer_Font_Settings as $Icon_Font => $iconfont) {
					if (!$forceload) {
						if (get_option('ts_vcsc_extend_settings_tinymce' . $iconfont['setting'], 0) == 1) {
							wp_enqueue_style(strtolower($iconfont['handle']));
						}
					} else {
						if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont['setting'], 0) == 1) && (get_option('ts_vcsc_extend_settings_load' . $iconfont['setting'], 0) == 1)) {
							wp_enqueue_style(strtolower($iconfont['handle']));
						}
					}
				}
			}
		}
		
		
		// Add additional "Settings" Link to Plugin Listing Page
		// -----------------------------------------------------
		function TS_VCSC_PluginAddSettingsLink($links) {
			if (current_user_can('manage_options')) {
				$links[] = '<a href="admin.php?page=TS_VCSC_Extender" target="_parent">' . __( "Settings", "ts_visual_composer_extend" ) . '</a>';
			}
			$links[] = '<a href="http://www.composium.krautcoding.com/documentation" target="_blank">' . __( "Documentation", "ts_visual_composer_extend" ) . '</a>';
			$links[] = '<a href="http://helpdesk.krautcoding.com/changelog-composium-visual-composer-extensions/" target="_blank">' . __( "Changelog", "ts_visual_composer_extend" ) . '</a>';
			return $links;
		}
		
		
		// Register Custom CSS and JS Inputs
		// ---------------------------------
		function TS_VCSC_RegisterCustomCSS_Setting() {
			register_setting('ts_vcsc_extend_custom_css', 	'ts_vcsc_extend_custom_css', 	    	array($this, 'TS_VCSC_CustomCSS_Validation'));
		}
		function TS_VCSC_RegisterCustomJS_Setting() {
			register_setting('ts_vcsc_extend_custom_js', 	'ts_vcsc_extend_custom_js',          	array($this, 'TS_VCSC_CustomJS_Validation'));
		}
		function TS_VCSC_CustomCSS_Validation($input) {
			if (!empty($input['ts_vcsc_extend_custom_css'])) {
				$input['ts_vcsc_extend_custom_css'] = trim( $input['ts_vcsc_extend_custom_css'] );
			}
			return $input;
		}
		function TS_VCSC_CustomJS_Validation($input) {
			if (!empty($input['ts_vcsc_extend_custom_js'])) {
				$input['ts_vcsc_extend_custom_js'] = trim( $input['ts_vcsc_extend_custom_js'] );
			}
			return $input;
		}
		
		
		// Output of Custom CSS + JS + META Code + TinyMCE Button
		// ------------------------------------------------------
		function TS_VCSC_DisplayCustomCSS() {
			if (($this->TS_VCSC_PluginExtended == "false") || (($this->TS_VCSC_PluginExtended == "true") && ($this->TS_VCSC_UseCodeEditors == "true"))) {
				$ts_vcsc_extend_custom_css = 				get_option('ts_vcsc_extend_custom_css');
				$ts_vcsc_extend_custom_css_default =		get_option('ts_vcsc_extend_settings_customCSS');
				if ((!empty($ts_vcsc_extend_custom_css)) && ($ts_vcsc_extend_custom_css != $ts_vcsc_extend_custom_css_default)) {
					echo '<style type="text/css" media="all">' . "\n";
						echo '/* Custom CSS for Composium - WP Bakery Page Builder Extensions Addon */' . "\n";
						echo TS_VCSC_MinifyCSS($ts_vcsc_extend_custom_css) . "\n";
					echo '</style>' . "\n";
				}
			}
		}
		function TS_VCSC_DisplayCustomJS() {
			if (($this->TS_VCSC_PluginExtended == "false") || (($this->TS_VCSC_PluginExtended == "true") && ($this->TS_VCSC_UseCodeEditors == "true"))) {
				$ts_vcsc_extend_custom_js = 				get_option('ts_vcsc_extend_custom_js');
				$ts_vcsc_extend_custom_js_default = 		get_option('ts_vcsc_extend_settings_customJS');
				if ((!empty($ts_vcsc_extend_custom_js)) && ($ts_vcsc_extend_custom_js != $ts_vcsc_extend_custom_js_default)) {
					echo '<script type="text/javascript">' . "\n";
						echo '(function ($) {' . "\n";
							echo '/* Custom JS for Composium - WP Bakery Page Builder Extensions Addon */' . "\n";
							echo TS_VCSC_MinifyJS($ts_vcsc_extend_custom_js) . "\n";
						echo '})(jQuery);' . "\n";
					echo '</script>' . "\n";
				}
			}
		}
		
		
		// Function to Register Scripts and Stylesheets
		// --------------------------------------------
		function TS_VCSC_FilesRegistrations() {
			require_once($this->registrations_dir . 'ts_vcsc_registrations_files.php');
		}
		
		
		// Function to translate PHP Settings into JS Variables
		// ----------------------------------------------------
		function TS_VCSC_Extensions_Create_Variables() {
            // Create Data Holder Object (window.krautcomposium)
            $TS_VCSC_VariablesOutput                                            = array();
            $TS_VCSC_VariablesOutput['Releases']                                = array();
            $TS_VCSC_VariablesOutput['Lightbox']                                = array();
            $TS_VCSC_VariablesOutput['Other']                                   = array();
			echo '<script type="text/javascript">';                
				// Current Plugin Version
				echo 'var $TS_VCSC_CurrentPluginRelease = "' . COMPOSIUM_VERSION . '";';
                $TS_VCSC_VariablesOutput['Releases']['Composium']               = COMPOSIUM_VERSION;
				// Current WP Bakery Page Builder Extensions Addon Version
				echo 'var $TS_VCSC_CurrentComposerRelease = "' . $this->TS_VCSC_VisualComposer_Version . '";';
                $TS_VCSC_VariablesOutput['Releases']['WPBakeryBuilder']         = $this->TS_VCSC_VisualComposer_Version;
				// Current Page/Post Title
				if ((TS_VCSC_IsEditPagePost()) && ($this->TS_VCSC_EditorLivePreview == "true") && ($this->TS_VCSC_Visual_Composer_Elements['TS Title Advanced']['active'] == 'true')) {
					global $post;
					if ($post) {
						echo 'var $TS_VCSC_CurrentPageTitle = "' . get_the_title($post->ID) . '";';
                        $TS_VCSC_VariablesOutput['CurrentPageTitle']            = get_the_title($post->ID);
					} else {
						echo 'var $TS_VCSC_CurrentPageTitle = ' . __( "Title could not (yet) be retrieved!", "ts_visual_composer_extend" ) . ';';
                        $TS_VCSC_VariablesOutput['CurrentPageTitle']            = __( "Title could not (yet) be retrieved!", "ts_visual_composer_extend" );
					}
				}
				// Lightbox Settings
				if ($this->TS_VCSC_UseInternalLightbox == "true") {                   
					echo 'var $TS_VCSC_Lightbox_Activated = true;';
                    $TS_VCSC_VariablesOutput['Lightbox']['Activated']           = true;
					echo 'var $TS_VCSC_Lightbox_Thumbs = "' . 					((array_key_exists('thumbs', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['thumbs'] : $this->TS_VCSC_Lightbox_Setting_Defaults['thumbs']) . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['Thumbnails']          = ((array_key_exists('thumbs', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['thumbs'] : $this->TS_VCSC_Lightbox_Setting_Defaults['thumbs']);
					echo 'var $TS_VCSC_Lightbox_Thumbsize = ' . 				((array_key_exists('thumbsize', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['thumbsize'] : $this->TS_VCSC_Lightbox_Setting_Defaults['thumbsize']) . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['Thumbsize']           = (int)((array_key_exists('thumbsize', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['thumbsize'] : $this->TS_VCSC_Lightbox_Setting_Defaults['thumbsize']);
					echo 'var $TS_VCSC_Lightbox_Animation = "' . 				((array_key_exists('animation', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['animation'] : $this->TS_VCSC_Lightbox_Setting_Defaults['animation']) . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['Animation']           = ((array_key_exists('animation', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['animation'] : $this->TS_VCSC_Lightbox_Setting_Defaults['animation']);
					echo 'var $TS_VCSC_Lightbox_Captions = "' . 				((array_key_exists('captions', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['captions'] : $this->TS_VCSC_Lightbox_Setting_Defaults['captions']) . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['Captions']            = ((array_key_exists('captions', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['captions'] : $this->TS_VCSC_Lightbox_Setting_Defaults['captions']);
                    echo 'var $TS_VCSC_Lightbox_Closer = ' . 					(((array_key_exists('closer', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['closer'] : $this->TS_VCSC_Lightbox_Setting_Defaults['closer']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['Closer']              = (((array_key_exists('closer', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['closer'] : $this->TS_VCSC_Lightbox_Setting_Defaults['closer']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_Durations = ' . 				((array_key_exists('duration', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['duration'] : $this->TS_VCSC_Lightbox_Setting_Defaults['duration']) . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['Duration']            = (int)((array_key_exists('duration', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['duration'] : $this->TS_VCSC_Lightbox_Setting_Defaults['duration']);
					echo 'var $TS_VCSC_Lightbox_Share = ' . 					(((array_key_exists('share', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['share'] : $this->TS_VCSC_Lightbox_Setting_Defaults['share']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['Share']                = (((array_key_exists('share', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['share'] : $this->TS_VCSC_Lightbox_Setting_Defaults['share']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_Save = ' . 						(((array_key_exists('save', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['save'] : $this->TS_VCSC_Lightbox_Setting_Defaults['save']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['Save']                = (((array_key_exists('save', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['save'] : $this->TS_VCSC_Lightbox_Setting_Defaults['save']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_LoadAPIs = ' . 					(((array_key_exists('loadapis', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['loadapis'] : $this->TS_VCSC_Lightbox_Setting_Defaults['loadapis']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['LoadAPIs']            = (((array_key_exists('loadapis', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['loadapis'] : $this->TS_VCSC_Lightbox_Setting_Defaults['loadapis']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_Social = "' . 					((array_key_exists('social', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['social'] : $this->TS_VCSC_Lightbox_Setting_Defaults['social']) . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['Social']              = ((array_key_exists('social', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['social'] : $this->TS_VCSC_Lightbox_Setting_Defaults['social']);
					echo 'var $TS_VCSC_Lightbox_NoTouch = ' . 					(((array_key_exists('notouch', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['notouch'] : $this->TS_VCSC_Lightbox_Setting_Defaults['notouch']) == 1 ? 'false' : 'true') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['NoTouch']             = (((array_key_exists('notouch', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['notouch'] : $this->TS_VCSC_Lightbox_Setting_Defaults['notouch']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_BGClose = ' . 					(((array_key_exists('bgclose', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['bgclose'] : $this->TS_VCSC_Lightbox_Setting_Defaults['bgclose']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['BGClose']             = (((array_key_exists('bgclose', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['bgclose'] : $this->TS_VCSC_Lightbox_Setting_Defaults['bgclose']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_NoHashes = ' . 					(((array_key_exists('nohashes', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['nohashes'] : $this->TS_VCSC_Lightbox_Setting_Defaults['nohashes']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['NoHashes']            = (((array_key_exists('nohashes', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['nohashes'] : $this->TS_VCSC_Lightbox_Setting_Defaults['nohashes']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_Keyboard = ' . 					(((array_key_exists('keyboard', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['keyboard'] : $this->TS_VCSC_Lightbox_Setting_Defaults['keyboard']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['Keyboard']            = (((array_key_exists('keyboard', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['keyboard'] : $this->TS_VCSC_Lightbox_Setting_Defaults['keyboard']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_FullScreen = ' . 				(((array_key_exists('fullscreen', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['fullscreen'] : $this->TS_VCSC_Lightbox_Setting_Defaults['fullscreen']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['FullScreen']          = (((array_key_exists('fullscreen', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['fullscreen'] : $this->TS_VCSC_Lightbox_Setting_Defaults['fullscreen']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_Zoom = ' . 						(((array_key_exists('zoom', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['zoom'] : $this->TS_VCSC_Lightbox_Setting_Defaults['zoom']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['Zoom']                = (((array_key_exists('zoom', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['zoom'] : $this->TS_VCSC_Lightbox_Setting_Defaults['zoom']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_FXSpeed = ' . 					((array_key_exists('fxspeed', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['fxspeed'] : $this->TS_VCSC_Lightbox_Setting_Defaults['fxspeed']) . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['FXSpeed']             = (int)((array_key_exists('fxspeed', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['fxspeed'] : $this->TS_VCSC_Lightbox_Setting_Defaults['fxspeed']);
					echo 'var $TS_VCSC_Lightbox_Scheme = "' . 					((array_key_exists('scheme', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['scheme'] : $this->TS_VCSC_Lightbox_Setting_Defaults['scheme']) . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['Scheme']              = ((array_key_exists('scheme', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['scheme'] : $this->TS_VCSC_Lightbox_Setting_Defaults['scheme']);                    
					echo 'var $TS_VCSC_Lightbox_Controls = "' .                 ((array_key_exists('controls', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['controls'] : $this->TS_VCSC_Lightbox_Setting_Defaults['controls']) . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['Buttons']             = ((array_key_exists('controls', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['controls'] : $this->TS_VCSC_Lightbox_Setting_Defaults['controls']);
                    echo 'var $TS_VCSC_Lightbox_URLColor = ' . 					(((array_key_exists('urlcolorscan', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['urlcolorscan'] : $this->TS_VCSC_Lightbox_Setting_Defaults['urlcolorscan']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['URLColor']            = (((array_key_exists('urlcolorscan', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['urlcolorscan'] : $this->TS_VCSC_Lightbox_Setting_Defaults['urlcolorscan']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_Backlight = "' . 				((array_key_exists('backlight', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['backlight'] : $this->TS_VCSC_Lightbox_Setting_Defaults['backlight']) . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['Backlight']           = ((array_key_exists('backlight', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['backlight'] : $this->TS_VCSC_Lightbox_Setting_Defaults['backlight']);
                    echo 'var $TS_VCSC_Lightbox_UseColor = ' . 					(((array_key_exists('usecolor', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['usecolor'] : $this->TS_VCSC_Lightbox_Setting_Defaults['usecolor']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['UseColor']            = (((array_key_exists('usecolor', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['usecolor'] : $this->TS_VCSC_Lightbox_Setting_Defaults['usecolor']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_Overlay = "' . 					((array_key_exists('overlay', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['overlay'] : $this->TS_VCSC_Lightbox_Setting_Defaults['overlay']) . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['Overlay']             = ((array_key_exists('overlay', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['overlay'] : $this->TS_VCSC_Lightbox_Setting_Defaults['overlay']);
					echo 'var $TS_VCSC_Lightbox_Background = "' . 				((array_key_exists('background', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['background'] : $this->TS_VCSC_Lightbox_Setting_Defaults['background']) . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['Background']          = ((array_key_exists('background', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['background'] : $this->TS_VCSC_Lightbox_Setting_Defaults['background']);
					echo 'var $TS_VCSC_Lightbox_Repeat = "' . 					((array_key_exists('repeat', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['repeat'] : $this->TS_VCSC_Lightbox_Setting_Defaults['repeat']) . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['Repeat']              = ((array_key_exists('repeat', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['repeat'] : $this->TS_VCSC_Lightbox_Setting_Defaults['repeat']); 
					echo 'var $TS_VCSC_Lightbox_Noise = "' . 					((array_key_exists('noise', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['noise'] : $this->TS_VCSC_Lightbox_Setting_Defaults['noise']) . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['Noise']               = ((array_key_exists('noise', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['noise'] : $this->TS_VCSC_Lightbox_Setting_Defaults['noise']); 
					echo 'var $TS_VCSC_Lightbox_CORS = ' . 						(((array_key_exists('cors', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['cors'] : $this->TS_VCSC_Lightbox_Setting_Defaults['cors']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['CORS']                = (((array_key_exists('cors', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['cors'] : $this->TS_VCSC_Lightbox_Setting_Defaults['cors']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_Tapping = ' . 					(((array_key_exists('tapping', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['tapping'] : $this->TS_VCSC_Lightbox_Setting_Defaults['tapping']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['Tapping']             = (((array_key_exists('tapping', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['tapping'] : $this->TS_VCSC_Lightbox_Setting_Defaults['tapping']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_ScrollBlock = "' . 				((array_key_exists('scrollblock', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['scrollblock'] : $this->TS_VCSC_Lightbox_Setting_Defaults['scrollblock']) . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['ScrollBlock']         = ((array_key_exists('scrollblock', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['scrollblock'] : $this->TS_VCSC_Lightbox_Setting_Defaults['scrollblock']);
                    echo 'var $TS_VCSC_Lightbox_Protection = "' . 				((array_key_exists('protection', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['protection'] : $this->TS_VCSC_Lightbox_Setting_Defaults['protection']) . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['Protection']          = ((array_key_exists('protection', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['protection'] : $this->TS_VCSC_Lightbox_Setting_Defaults['protection']);
                    echo 'var $TS_VCSC_Lightbox_HistoryClose = ' .				(((array_key_exists('historyclose', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['historyclose'] : $this->TS_VCSC_Lightbox_Setting_Defaults['historyclose']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['HistoryClose']        = (((array_key_exists('historyclose', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['historyclose'] : $this->TS_VCSC_Lightbox_Setting_Defaults['historyclose']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_CustomScroll = ' .				(((array_key_exists('customscroll', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['customscroll'] : $this->TS_VCSC_Lightbox_Setting_Defaults['customscroll']) == 1 ? 'true' : 'false') . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['CustomScroll']        = (((array_key_exists('customscroll', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['customscroll'] : $this->TS_VCSC_Lightbox_Setting_Defaults['customscroll']) == 1 ? true : false);
					echo 'var $TS_VCSC_Lightbox_HomeURL = "' . 					get_home_url() . '";';
                    $TS_VCSC_VariablesOutput['Lightbox']['HomeURL']             = get_home_url();
					echo 'var $TS_VCSC_Lightbox_LastScroll = 0;';
                    $TS_VCSC_VariablesOutput['Lightbox']['LastScroll']          = 0;
					echo 'var $TS_VCSC_Lightbox_Showing = false;';
                    $TS_VCSC_VariablesOutput['Lightbox']['Showing']             = false;
					echo 'var $TS_VCSC_Lightbox_PrettyPhoto = ' . 				$this->TS_VCSC_UseLightboxPrettyPhoto . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['PrettyPhoto']         = ((($this->TS_VCSC_UseLightboxPrettyPhoto == "true") || ($this->TS_VCSC_UseLightboxPrettyPhoto == true)) ? true : false);
					echo 'var $TS_VCSC_Lightbox_AttachAllOther = ' .			$this->TS_VCSC_UseLightboxAttachAllOther . ';';
                    $TS_VCSC_VariablesOutput['Lightbox']['AttachAllOther']      = ((($this->TS_VCSC_UseLightboxAttachAllOther == "true") || ($this->TS_VCSC_UseLightboxAttachAllOther == true)) ? true : false);
				} else {
					echo 'var $TS_VCSC_Lightbox_Activated = false;';
                    $TS_VCSC_VariablesOutput['Lightbox']['Activated']           = false;
				}                
				// Hammer Version Setting
				echo 'var $TS_VCSC_Hammer_ReleaseNew = ' . $this->TS_VCSC_LoadFrontEndHammerNew . ';';
                $TS_VCSC_VariablesOutput['Other']['HammerReleaseNew']           = ((($this->TS_VCSC_LoadFrontEndHammerNew == "true") || ($this->TS_VCSC_LoadFrontEndHammerNew == true)) ? true : false);
				// Extended Row Effects (Breakpoint)
				if (get_option('ts_vcsc_extend_settings_additionsRows', 0) == 1) {
					echo 'var $TS_VCSC_RowEffects_Breakpoint = ' . 				get_option('ts_vcsc_extend_settings_additionsRowEffectsBreak', '600') . ';';
                    $TS_VCSC_VariablesOutput['Other']['RowsBreakPoint']         = (int)get_option('ts_vcsc_extend_settings_additionsRowEffectsBreak', '600');
				}
                // AJAX Callback URL
                $TS_VCSC_VariablesOutput['Other']['AjaxURL']                    = admin_url('admin-ajax.php');                
                // Output Data Holder Object (window.krautcomposium)              
                //echo 'window.krautcomposium = ' . json_encode($TS_VCSC_VariablesOutput) . ';';
			echo '</script>';
		}
		function TS_VCSC_Extensions_Create_GoogleFontArray() {
			$parameter_selection				= array();
			$parameter_favorites				= array();
			if ($this->TS_VCSC_UseGoogleFontManager == "true") {
				$font_stored 					= get_option('ts_vcsc_extend_settings_fontDefaults', '');
				if (($font_stored == false) || (empty($font_stored)) || ($font_stored == "") || (!is_array($font_stored))) {
					$font_stored				= array();
				}
				foreach ($this->TS_VCSC_Fonts_Google as $Font_Network => $font) {
					$font_active				= (isset($font_stored[$Font_Network]['active']) ? ($font_stored[$Font_Network]['active'] == 'on' ? "true" : "false") : $font['active']);
					$font_favorite				= (isset($font_stored[$Font_Network]['favorite']) ? ($font_stored[$Font_Network]['favorite'] == 'on' ? "true" : "false") : $font['favorite']);
					if ($font['variants'] != '') {
						$Font_Variants			= ':' . $font['variants'];
					}
					if ($font_active == "true") {
						if ($font_favorite == "true") {
							$parameter_favorites[]	= $font['google'] . $Font_Variants;
						} else {
							$parameter_selection[]	= $font['google'] . $Font_Variants;
						}
					}
				}
			} else {
				foreach ($this->TS_VCSC_Fonts_Google as $Font_Network => $font) {
					if ($font['variants'] != '') {
						$Font_Variants			= ':' . $font['variants'];
					}
					$parameter_selection[]		= $font['google'] . $Font_Variants;
				}
			}
			echo '<script type="text/javascript">';
				echo 'var $TS_VCSC_Google_Favorites = ' . json_encode($parameter_favorites) . ';';
				echo 'var $TS_VCSC_Google_Selection = ' . json_encode($parameter_selection) . ';';
			echo '</script>';
		}
		function TS_VCSC_Extensions_Create_CustomFontArray() {
			$parameter_selection				= array();
			$parameter_favorites				= array();
			$parameter_retrieval				= $this->TS_VCSC_RegisteredCustomFonts;
			if ($this->TS_VCSC_UseCustomFontManager == "true") {
				foreach ($parameter_retrieval as $fonts => &$font) {
					$font->family				= base64_decode($font->family);
					if ($font->favorite) {
						$parameter_favorites[]	= $font->family;
					} else {
						$parameter_selection[]	= $font->family;
					}					
				}
			}
			echo '<script type="text/javascript">';
				echo 'var $TS_VCSC_Custom_Favorites = ' . json_encode($parameter_favorites) . ';';
				echo 'var $TS_VCSC_Custom_Selection = ' . json_encode($parameter_selection) . ';';
				echo 'var $TS_VCSC_Custom_Completed = ' . json_encode($parameter_retrieval) . ';';
			echo '</script>';
		}
		
		
		// Function to load External Files on Back-End when Editing
		// --------------------------------------------------------
		function TS_VCSC_Extensions_Admin_Files($hook_suffix) {
			global $pagenow, $typenow;
			if (!function_exists('get_current_screen')) {
				require_once(ABSPATH . '/wp-admin/includes/screen.php');
			}
			$screen 						= get_current_screen();
			if (empty($typenow) && !empty($_GET['post'])) {
				$post 						= get_post($_GET['post']);
				$typenow 					= $post->post_type;
			}
			$url							= plugin_dir_url( __FILE__ );
			$TS_VCSC_IsEditPagePost 		= TS_VCSC_IsEditPagePost();
            // Check if Invalid WP Bakery PAGE Builder Editor
            if ($this->TS_VCSC_WebsiteBuilder_Instead == "true") {
                $TS_VCSC_IsEditPagePost     = false;
            }
            // Check if Page/Post has been edited with Gutenberg
            if (($this->TS_VCSC_GutenbergExists == "true") && ((method_exists($screen, 'is_block_editor') && $screen->is_block_editor()) || ((function_exists('is_gutenberg_page') && is_gutenberg_page())))) {
                $TS_VCSC_IsGutenbergPost    = "true";
            } else {
                $TS_VCSC_IsGutenbergPost    = "false";
            }
            // Check for WP Bakery PAGE Builder Content
            if (($this->TS_VCSC_GutenbergExists == "true") && ($this->TS_VCSC_VCFrontEditMode == "false") && ($this->TS_VCSC_Gutenberg_Classic == "false") && ($TS_VCSC_IsGutenbergPost == "false")) {
                $TS_VCSC_IsWBPBContent      = (TS_VCSC_CheckWBPageBuilderContent() == true ? "true" : "false");
            } else {
                $TS_VCSC_IsWBPBContent      = "true";
            }
            // Check for Custom Post Type without VC
			$TS_VCSC_IsEditCustomPost 		= false;			
			if ($screen != '' && $screen != "false" && $screen != false && ($screen->id == "ts_timeline" || $screen->id == "ts_team" || $screen->id == "ts_testimonials" || $screen->id == "ts_skillsets" || $screen->id == "ts_logos")) {
				$TS_VCSC_IsEditCustomPost 	= true;
			}
			// Files to be loaded on Widgets Page
			if ($pagenow == "widgets.php") {
				if ($this->TS_VCSC_CustomPostTypesWidgets == "true") {
					wp_enqueue_style('ts-visual-composer-extend-widgets');
					wp_enqueue_script('ts-visual-composer-extend-widgets');
				}
			}
			// Files to be loaded on WBP Settings Page
			if (($this->TS_VCSC_Extension_RoleManager == "true") || ($this->TS_VCSC_Extension_ElementsUser == "true")) {
				wp_enqueue_style('ts-visual-composer-extend-composer');
			}
			// Files to be loaded with WP Bakery PAGE Builder Extensions Addon                   
			if ((($TS_VCSC_IsEditPagePost) && ($TS_VCSC_IsEditCustomPost == false) && ($this->TS_VCSC_WebsiteBuilder_Instead == "false") && (($this->TS_VCSC_GutenbergExists == "false") || ($this->TS_VCSC_Gutenberg_Classic == "true") || ($this->TS_VCSC_VCFrontEditMode == "true") || ($TS_VCSC_IsGutenbergPost = "false") || ($TS_VCSC_IsWBPBContent == "true"))) || ($this->TS_VCSC_Extension_ToolsetsUser == "true")) {				
                if ($this->TS_VCSC_CustomPostTypesLoaded == "true") {
					wp_enqueue_script('jquery-ui-sortable');
				}
				if (($this->TS_VCSC_EditorVisualSelector == "true") || ($this->TS_VCSC_IconicumActivated == "true") || ($this->TS_VCSC_GeneratorLoad == "true")) {
					$this->TS_VCSC_IconFontsEnqueue(false);
				}
				wp_enqueue_style('ts-font-teammates');
				if ($this->TS_VCSC_EditorLivePreview == "true") {
					wp_enqueue_style('ts-visual-composer-extend-preview');
				} else {
					wp_enqueue_style('ts-visual-composer-extend-basic');
				}
				if ($this->TS_VCSC_LoadEditorNoUiSlider == "true") {
					wp_enqueue_style('ts-extend-nouislider');				
					wp_enqueue_script('ts-extend-nouislider');
				}
				wp_enqueue_style('ts-extend-multiselect');
				wp_enqueue_script('ts-extend-multiselect');
				wp_enqueue_script('ts-extend-picker');		
				wp_enqueue_script('ts-extend-iconpicker');
				wp_enqueue_style('ts-extend-iconpicker');
				wp_enqueue_style('ts-extend-colorpicker');
				wp_enqueue_script('ts-extend-colorpicker');	
				wp_enqueue_script('ts-extend-classygradient');
				wp_enqueue_style('ts-extend-animations');
				wp_enqueue_style('ts-extend-preloaders');
				wp_enqueue_style('ts-visual-composer-extend-admin');				
				wp_enqueue_script('ts-visual-composer-extend-admin');
				if (($this->TS_VCSC_WooCommerceActive == "true") || ($this->TS_VCSC_Visual_Composer_Elements['TS Rating Scales']['active'] == 'true')) {
					wp_enqueue_style('ts-font-ecommerce');
				}
				if ($this->TS_VCSC_Visual_Composer_Elements['TS Google Maps PLUS']['active'] == 'true') {
					wp_enqueue_style('ts-font-mapmarker');
				}
				// Load Custom Backbone View and Files for Rows
				if ($this->TS_VCSC_VCFrontEditMode == "false") {
					if ((($this->TS_VCSC_PluginExtended == "true") && (get_option('ts_vcsc_extend_settings_additions', 1) == 1)) || (($this->TS_VCSC_PluginExtended == "false"))) {
						if (get_option('ts_vcsc_extend_settings_additionsRows', 0) == 1) {
							wp_enqueue_script('ts-vcsc-backend-rows');
						}
					}					
				}
				if ($this->TS_VCSC_VCFrontEditMode == "false") {
					// Load Custom Backbone View for Other Elements
					if ($this->TS_VCSC_EditorLivePreview == "true") {
						wp_enqueue_script('ts-vcsc-backend-other');
					} else if (($this->TS_VCSC_Visual_Composer_Elements['TS Fancy Tabs (BETA)']['active'] == 'true') || ($this->TS_VCSC_Visual_Composer_Elements['TS Image Hotspot']['active'] == 'true')) {
						wp_enqueue_script('ts-vcsc-backend-basic');
					}
					// Load Custom Backbone for Shortcode Viewer
					if ($this->TS_VCSC_EditorShortcodesPopup == "true") {
						wp_enqueue_script('ts-vcsc-backend-shortcode');
						wp_enqueue_script('ts-extend-clipboard');
					}
					// Load Custom Backbone for Container Toggle
					if ($this->TS_VCSC_EditorContainerToggle == "true") {
						wp_enqueue_script('ts-vcsc-backend-collapse');
					}
				}
				// Element Setting Panels
				wp_enqueue_script('jquery-ui-autocomplete');
				wp_enqueue_style('ts-visual-composer-extend-composer');
				wp_enqueue_style('ts-visual-composer-extend-parameters');
				wp_enqueue_script('ts-visual-composer-extend-parameters');
				if ($this->TS_VCSC_EditorElementFilter == "true") {
					wp_enqueue_script('ts-visual-composer-extend-categories');
				}
			} else if (($TS_VCSC_IsEditPagePost) && ($TS_VCSC_IsEditCustomPost == true) && ($this->TS_VCSC_WebsiteBuilder_Instead == "false")) {
                if ($this->TS_VCSC_CustomPostTypesLoaded == "true") {
					wp_enqueue_script('jquery-ui-sortable');
				}
				wp_enqueue_style('ts-visual-composer-extend-admin');
			}
			// Files to be loaded for Plugin Settings Pages
            if (!is_null($hook_suffix)) {
                global $ts_vcsc_main_page;
                global $ts_vcsc_settings_page;
                global $ts_vcsc_upload_page;
                global $ts_vcsc_preview_page;
                global $ts_vcsc_generator_page;
                global $ts_vcsc_customCSS_page;
                global $ts_vcsc_customJS_page;
                global $ts_vcsc_transfer_page;
                global $ts_vcsc_system_page;
                global $ts_vcsc_license_page;
                global $ts_vcsc_about_page;
                global $ts_vcsc_google_fonts;
                global $ts_vcsc_custom_fonts;
                global $ts_vcsc_enlighterjs_page;
                global $ts_vcsc_downtime_page;
                global $ts_vcsc_sidebars_page;
                global $ts_vcsc_update_page;
                global $ts_vcsc_statistics_page;
                if (($ts_vcsc_main_page == $hook_suffix) || ($ts_vcsc_settings_page == $hook_suffix) || ($ts_vcsc_upload_page == $hook_suffix) || ($ts_vcsc_preview_page == $hook_suffix) || ($ts_vcsc_customCSS_page == $hook_suffix) || ($ts_vcsc_customJS_page == $hook_suffix) || ($ts_vcsc_system_page == $hook_suffix) || ($ts_vcsc_transfer_page == $hook_suffix) || ($ts_vcsc_license_page == $hook_suffix) || ($ts_vcsc_about_page == $hook_suffix) || ($ts_vcsc_google_fonts == $hook_suffix) || ($ts_vcsc_custom_fonts == $hook_suffix) || ($ts_vcsc_enlighterjs_page == $hook_suffix) || ($ts_vcsc_downtime_page == $hook_suffix) || ($ts_vcsc_sidebars_page == $hook_suffix) || ($ts_vcsc_statistics_page == $hook_suffix)) {
                    if (!wp_script_is('jquery')) {
                        wp_enqueue_script('jquery');
                    }
                    if (($ts_vcsc_main_page == $hook_suffix) || ($ts_vcsc_settings_page == $hook_suffix) || ($ts_vcsc_enlighterjs_page == $hook_suffix)) {
                        wp_enqueue_style('wp-color-picker');				
                        wp_enqueue_script('ts-extend-colorpickeralpha');					
                        if ($ts_vcsc_enlighterjs_page != $hook_suffix) {
                            wp_enqueue_script('ts-extend-dragsort');
                        }
                        wp_enqueue_style('ts-extend-nouislider');
                        wp_enqueue_script('ts-extend-nouislider');
                        wp_enqueue_style('ts-visual-composer-extend-admin');
                    }
                    if ($ts_vcsc_upload_page == $hook_suffix) {
                        if (get_option('ts_vcsc_extend_settings_tinymceCustomPath', '') != '') {
                            wp_enqueue_style('ts-font-customvcsc');
                        }
                        wp_enqueue_style('ts-visual-composer-extend-admin');
                        wp_enqueue_script('ts-visual-composer-extend-admin');
                    }
                    if (($ts_vcsc_upload_page == $hook_suffix) || ($ts_vcsc_preview_page == $hook_suffix)) {
                        wp_enqueue_style('ts-extend-dropdown');
                        wp_enqueue_script('ts-extend-dropdown');
                        wp_enqueue_script('ts-extend-freewall');
                        wp_enqueue_style('ts-visual-composer-extend-admin');
                    }
                    if ($ts_vcsc_about_page == $hook_suffix) {
                        wp_enqueue_script('ts-extend-slidesjs');
                    }
                    wp_enqueue_style('dashicons');
                    wp_enqueue_style('ts-font-teammates');
                    wp_enqueue_style('ts-extend-sweetalert');
                    wp_enqueue_script('ts-extend-sweetalert');
                    if ($ts_vcsc_enlighterjs_page != $hook_suffix) {
                        wp_enqueue_style('ts-vcsc-extend');
                        if ($ts_vcsc_downtime_page != $hook_suffix) {
                            wp_enqueue_script('ts-vcsc-extend');
                        }
                    }
                    wp_enqueue_script('validation-engine');
                    wp_enqueue_style('validation-engine');
                    wp_enqueue_script('validation-engine-en');
                    wp_enqueue_style('ts-visual-composer-extend-buttons');
                }
                if (($ts_vcsc_generator_page == $hook_suffix) && ($this->TS_VCSC_IconicumStandard == "false")) {
                    wp_enqueue_style('ts-vcsc-extend');
                    wp_enqueue_script('ts-vcsc-extend');
                    wp_enqueue_style('ts-visual-composer-extend-admin');
                    wp_enqueue_script('ts-extend-clipboard');
                    wp_enqueue_style('ts-visual-composer-extend-buttons');
                }
                if ($ts_vcsc_preview_page == $hook_suffix) {
                    $this->TS_VCSC_IconFontsEnqueue(false);
                    wp_enqueue_style('ts-visual-composer-extend-admin');
                    wp_enqueue_script('ts-visual-composer-extend-admin');
                }
                if (($ts_vcsc_system_page == $hook_suffix) || ($ts_vcsc_transfer_page == $hook_suffix) || ($ts_vcsc_about_page == $hook_suffix)) {
                    wp_enqueue_style('ts-visual-composer-extend-admin');
                    wp_enqueue_script('ts-visual-composer-extend-admin');				
                }
                if ($ts_vcsc_downtime_page == $hook_suffix) {
                    wp_enqueue_style('ts-extend-preloaders');
                    wp_enqueue_script('ts-extend-picker');
                    wp_enqueue_style('ts-extend-nouislider');
                    wp_enqueue_style('ts-extend-multiselect');
                    wp_enqueue_script('ts-extend-nouislider');
                    wp_enqueue_script('ts-extend-multiselect');
                    wp_enqueue_script('ts-extend-sumo');
                    wp_enqueue_style('ts-visual-composer-extend-admin');
                    wp_enqueue_script('ts-visual-composer-extend-admin');
                    wp_enqueue_style('ts-visual-composer-extend-downtime');
                    wp_enqueue_script('ts-visual-composer-extend-downtime');	
                }
                if ($ts_vcsc_sidebars_page == $hook_suffix) {
                    wp_enqueue_style('ts-extend-preloaders');
                    wp_enqueue_style('ts-extend-nouislider');
                    wp_enqueue_script('ts-extend-nouislider');
                    wp_enqueue_style('ts-visual-composer-extend-admin');
                    wp_enqueue_script('ts-visual-composer-extend-admin');
                    wp_enqueue_script('ts-visual-composer-extend-sidebars');
                }
                if ($ts_vcsc_google_fonts == $hook_suffix) {
                    wp_enqueue_style('ts-extend-preloaders');
                    wp_enqueue_style('ts-visual-composer-extend-admin');
                    wp_enqueue_style('ts-visual-composer-extend-google');
                    wp_enqueue_script('ts-visual-composer-extend-google');
                }
                if ($ts_vcsc_custom_fonts == $hook_suffix) {
                    wp_enqueue_style('ts-extend-preloaders');
                    wp_enqueue_style('ts-visual-composer-extend-admin');
                    wp_enqueue_script('jquery-ui-sortable');
                    wp_enqueue_script('ts-extend-repeatable');
                    wp_enqueue_style('ts-visual-composer-extend-fonts');
                    wp_enqueue_script('ts-visual-composer-extend-fonts');
                }
                if (($ts_vcsc_main_page == $hook_suffix) || ($ts_vcsc_settings_page == $hook_suffix)) {
                    wp_enqueue_script('jquery-ui-sortable');
                    wp_enqueue_style('ts-extend-preloaders');
                    wp_enqueue_style('ts-extend-sumo');
                    wp_enqueue_script('ts-extend-sumo');
                    wp_enqueue_style('ts-extend-multiselect');
                    wp_enqueue_script('ts-extend-multiselect');
                    wp_enqueue_media();
                }
                if ($ts_vcsc_license_page == $hook_suffix) {
                    wp_enqueue_style('ts-extend-preloaders');
                    wp_enqueue_style('ts-visual-composer-extend-admin');
                }
                if ($ts_vcsc_statistics_page == $hook_suffix) {
                    wp_enqueue_style('ts-font-tablefont');
                    wp_enqueue_style('ts-extend-preloaders');
                    wp_enqueue_style('ts-extend-datatables-full');
                    wp_enqueue_style('ts-extend-datatables-custom');
                    wp_enqueue_script('ts-extend-datatables-full');
                    wp_enqueue_script('ts-extend-datatables-jszip');
                    wp_enqueue_script('ts-extend-datatables-pdfmaker');
                    wp_enqueue_script('ts-extend-datatables-pdffonts');
                    wp_enqueue_style('ts-visual-composer-extend-admin');
                    wp_enqueue_script('ts-visual-composer-extend-admin');
                    wp_enqueue_style('ts-visual-composer-extend-statistics');
                    wp_enqueue_script('ts-visual-composer-extend-statistics');
                }
                if (($ts_vcsc_customCSS_page == $hook_suffix) || ($ts_vcsc_customJS_page == $hook_suffix)) {
                    wp_enqueue_script('ace_code_highlighter_js', 	                $url.'assets/ACE/ace.js', '', false, true );
                }
                if ($ts_vcsc_customCSS_page == $hook_suffix) {
                    wp_enqueue_script('ace_mode_css',                               $url.'assets/ACE/mode-css.js', array('ace_code_highlighter_js'), false, true );
                    wp_enqueue_script('custom_css_js', 		                		$url.'assets/ACE/custom-css.js', array( 'jquery', 'ace_code_highlighter_js' ), false, true );
                    wp_enqueue_style('ts-vcsc-extend');
                    wp_enqueue_style('ts-visual-composer-extend-admin');
                }
                if ($ts_vcsc_customJS_page == $hook_suffix) {
                    wp_enqueue_script('ace_mode_js',                                $url.'assets/ACE/mode-javascript.js', array('ace_code_highlighter_js'), false, true );
                    wp_enqueue_script('custom_js_js',                               $url.'assets/ACE/custom-js.js', array( 'jquery', 'ace_code_highlighter_js' ), false, true );
                    wp_enqueue_style('ts-vcsc-extend');
                    wp_enqueue_style('ts-visual-composer-extend-admin');
                }
                if ($ts_vcsc_enlighterjs_page == $hook_suffix) {
                    wp_enqueue_style('ts-extend-preloaders');
                    wp_enqueue_script('ts-library-mootools');
                    wp_enqueue_style('ts-extend-enlighterjs');				
                    wp_enqueue_script('ts-extend-enlighterjs');				
                    wp_enqueue_style('ts-extend-syntaxinit');
                    wp_enqueue_script('ts-extend-syntaxinit');
                    wp_enqueue_style('ts-extend-themebuilder');	
                    wp_enqueue_script('ts-extend-themebuilder');
                }
                // Files to be loaded for Update Notification
                if ($ts_vcsc_update_page == $hook_suffix) {
                    wp_enqueue_style('dashicons');
                    wp_enqueue_style('ts-visual-composer-extend-admin');
                    wp_enqueue_script('ts-visual-composer-extend-admin');
                    wp_enqueue_style('ts-vcsc-extend');
                    wp_enqueue_script('ts-vcsc-extend');
                }
            }
		}
		function TS_VCSC_Extensions_Admin_Variables() {
			if (($this->TS_VCSC_VisualComposer_Loading == "true") || ($this->TS_VCSC_PluginFontSummary == "true") || ($this->TS_VCSC_Icons_Compliant_Loading == "true") || ($this->TS_VCSC_GoggleFontSummary == "true")) {
				$this->TS_VCSC_Extensions_Create_Variables();
				$this->TS_VCSC_Extensions_Create_GoogleFontArray();
				$this->TS_VCSC_Extensions_Create_CustomFontArray();
			}
		}
		function TS_VCSC_Extensions_Admin_Head() {
			global $pagenow, $typenow;
			if (!function_exists('get_current_screen')) {
				require_once(ABSPATH . '/wp-admin/includes/screen.php');
			}
			$screen 		= get_current_screen();
			if (empty($typenow) && !empty($_GET['post'])) {
				$post 		= get_post($_GET['post']);
				$typenow 	= $post->post_type;
			}
			$url			= plugin_dir_url( __FILE__ );
			if (($this->TS_VCSC_UseEnlighterJS == "true") && ($this->TS_VCSC_UseThemeBuilder == "true")) {
				if (strpos($screen->id, 'TS_VCSC_EnlighterJS') !== false) {
					echo '<script>$Theme_Template = "' . $this->templates_dir . 'ts-enlighter-template.css";</script>';
					TS_VCSC_GenerateCustomCSS(false);
				}
			}
			if (($this->TS_VCSC_CustomPostTypesDownpage == "true") && (($this->TS_VCSC_Downtime_Manager_Settings['active'] == "1") || ($this->TS_VCSC_Downtime_Manager_Settings['active'] == 1))) {
				$admin_message = '';
				$admin_message .= '<style id="ts-downtime-mode-status-style" type="text/css">';
					$admin_message .= '#wp-toolbar .ts-downtime-mode-message-active {';
						$admin_message .= 'background: #FF0000;';
						$admin_message .= 'color: #ffffff;';
					$admin_message .= '}';
					$admin_message .= '#wp-toolbar .ts-downtime-mode-message-expired {';
						$admin_message .= 'background: #FF7700;';
						$admin_message .= 'color: #ffffff;';
					$admin_message .= '}';
				$admin_message .= '</style>';
				echo TS_VCSC_MinifyCSS($admin_message);
			}
			// Limit Editor AJAX Calls
			if (($this->TS_VCSC_Limit_Editor_AJAX_Calls['disableasync'] == true) || ($this->TS_VCSC_Limit_Editor_AJAX_Calls['composerimage'] == true) || ($this->TS_VCSC_Limit_Editor_AJAX_Calls['wpheartbeat'] == true)) {
				if ($screen->post_type == 'post' || $screen->post_type == 'page') {
					echo '<script type="text/javascript">';
						echo 'jQuery.ajaxSetup({';
							if ($this->TS_VCSC_Limit_Editor_AJAX_Calls['disableasync'] == true) {
								echo 'async: false,';
							}
							if (($this->TS_VCSC_Limit_Editor_AJAX_Calls['composerimage'] == true) || ($this->TS_VCSC_Limit_Editor_AJAX_Calls['wpheartbeat'] == true)) {
								echo 'beforeSend : function(xhr, setting) {';
									echo 'if (setting.hasOwnProperty("data")) {';
										if ($this->TS_VCSC_Limit_Editor_AJAX_Calls['composerimage'] == true) {
											echo 'if (setting.data.toLowerCase().indexOf("action=wpb_single_image_src") >= 0) {';
												echo 'xhr.abort();';
												echo 'return false;';
											echo '}';
										}
										if ($this->TS_VCSC_Limit_Editor_AJAX_Calls['wpheartbeat'] == true) {
											echo 'if (setting.data.toLowerCase().indexOf("action=heartbeat") >= 0) {';
												echo 'xhr.abort();';
												echo 'return false;';
											echo '}';
										}
									echo '}';
								echo '},';
							}
						echo '});';
					echo '</script>';
				}
			}
		}
		function TS_VCSC_Extensions_Admin_Editor() {
			if ($this->TS_VCSC_VCFrontEditMode == "true") {
				wp_enqueue_script('ts-visual-composer-extend-editor');
				wp_enqueue_style('ts-visual-composer-extend-editor');
			}
		}
		function TS_VCSC_Extensions_Admin_Footer() {
			if ((TS_VCSC_IsEditPagePost()) && ($this->TS_VCSC_VisualComposer_Loading == "true") && ($this->TS_VCSC_ParameterLinkPicker['enabled'] == "true") && ($this->TS_VCSC_ParameterLinkPicker['global'] == "true")) {
				$randomizer         = mt_rand(999999, 9999999);
                $totalPages         = wp_count_posts('page')->publish;
                $totalPosts         = wp_count_posts('post')->publish;
                $totalCustom        = 0;
                // Get Custom Post Types
				if ($this->TS_VCSC_ParameterLinkPicker['custom'] == "true") {
					$args = array(
					   'public'                 => true,
					   'publicly_queryable'     => true,
					   'exclude_from_search'    => false,
					   '_builtin'               => false
					);
					$availableTypes	= get_post_types($args, 'names', 'and');
				}
				// Create Output
				$output 			= '';
				$output .= '<div class="ts-advancedbackup-wrapper" style="display: none !important; visibility: hidden !important; width: 0; height: 0; margin: 0; padding: 0; border: none;">';
					// Starter Pages Listing
					$availablePages	= TS_VCSC_GetPostOptions(array('post_type' => 'page', 'posts_per_page' => $this->TS_VCSC_ParameterLinkPicker['offset'], 'offset' => 0, 'orderby' => $this->TS_VCSC_ParameterLinkPicker['orderby'], 'order' => $this->TS_VCSC_ParameterLinkPicker['order']), false);
					//TS_VCSC_SortMultiArray($availablePages, 'name');
					$output .= '<ul name="ts-advancedbackup-pages-' . $randomizer . '" id="ts-advancedbackup-pages-' . $randomizer . '" class="ts-advancedbackup-scroller ts-advancedbackup-pages" data-requests="0" data-offset="0" data-current="' . count($availablePages) . '" data-total="' . $totalPages . '">';
						foreach ($availablePages as $page) {
							$output .= '<li class="" data-link="' . $page['link'] . '" data-name="' . $page['name'] . '" data-id="' . $page['value'] . '">';
								$output .= '' . $page['name'] . ' (' . $page['value'] . ')';
							$output .= '</li>';
						}
					$output .= '</ul>';
					// Starter Posts Listing
					if ($this->TS_VCSC_ParameterLinkPicker['posts'] == "true") {
						$availablePosts	= TS_VCSC_GetPostOptions(array('post_type' => 'post', 'posts_per_page' => $this->TS_VCSC_ParameterLinkPicker['offset'], 'offset' => 0, 'orderby' => $this->TS_VCSC_ParameterLinkPicker['orderby'], 'order' => $this->TS_VCSC_ParameterLinkPicker['order']), false);
						//TS_VCSC_SortMultiArray($availablePosts, 'name');
						$output .= '<ul name="ts-advancedbackup-posts-' . $randomizer . '" id="ts-advancedbackup-posts-' . $randomizer . '" class="ts-advancedbackup-scroller ts-advancedbackup-posts" data-requests="0" data-offset="0" data-current="' . count($availablePosts) . '" data-total="' . $totalPosts . '">';
							foreach ($availablePosts as $post) {
								$output .= '<li class="" data-link="' . $post['link'] . '" data-name="' . $post['name'] . '" data-id="' . $post['value'] . '">';
									$output .= '' . $post['name'] . ' (' . $post['value'] . ')';
								$output .= '</li>';
							}
						$output .= '</ul>';
					}
					// Starter Custom Listing
					if ($this->TS_VCSC_ParameterLinkPicker['custom'] == "true") {
						$availableCustom    = array();
						$availableRequest   = array();
						if (count($availableTypes) > 0) {
							foreach ($availableTypes as $type) {
								$totalCustom        = $totalCustom + wp_count_posts($type)->publish;
								$availableRequest   = TS_VCSC_GetPostOptions(array('post_type' => $type, 'posts_per_page' => $this->TS_VCSC_ParameterLinkPicker['offset'], 'offset' => 0, 'orderby' => $this->TS_VCSC_ParameterLinkPicker['orderby'], 'order' => $this->TS_VCSC_ParameterLinkPicker['order']), false);
								$availableCustom    = array_merge($availableCustom, $availableRequest);
							}
							//TS_VCSC_SortMultiArray($availableCustom, 'name');
							$output .= '<ul name="ts-advancedbackup-custom-' . $randomizer . '" id="ts-advancedbackup-custom-' . $randomizer . '" class="ts-advancedbackup-scroller ts-advancedbackup-custom" data-requests="0" data-offset="0" data-current="' . count($availableCustom) . '" data-total="' . $totalCustom . '">';
								foreach ($availableCustom as $post) {
									$output .= '<li class="" data-link="' . $post['link'] . '" data-name="' . $post['name'] . '" data-id="' . $post['value'] . '">';
										$output .= '' . $post['type'] . ' - ' . $post['name'] . ' (' . $post['value'] . ')';
									$output .= '</li>';
								}
							$output .= '</ul>'; 
						}
					}
				$output .= '</div>';
				unset($availablePages);
				unset($availablePosts);
				unset($availableTypes);
				unset($availableCustom);
				unset($availableRequest);				
				echo $output;
			}
		}
		function TS_VCSC_Extensions_Admin_Template() {
			if ((TS_VCSC_IsEditPagePost()) && ($this->TS_VCSC_VCFrontEditMode == "false")) {
				// Get Template Edit Link
				$buttonLink 		= str_replace(get_the_ID(), '{{id}}', get_edit_post_link());
				// Create Button HTML				
				$buttonTemplate		= '';
				$buttonTemplate .= '<a class="vc_control-btn ts-vcsc-template-edit-button" href="' . $buttonLink . '" title="Edit CP Widget / Template Post" target="_blank">';
					$buttonTemplate .= '<span class="vc_btn-content"><span class="icon"></span></span>';
				$buttonTemplate .= '</a>';
				echo '<script type="text/javascript">window.TS_VCSC_TemplateEditButton = \'' . $buttonTemplate . '\'</script>';
			}
		}
		function TS_VCSC_Extensions_Admin_Bakery() {

		}
		
		
		// Function to load External Files on Front-End
		// --------------------------------------------
		function TS_VCSC_Extensions_Front_Main() {
			global $post;
			global $wp_query;
			$url 									= plugin_dir_url( __FILE__ );
			$this->TS_VCSC_FilesRegistrations();
			// Check For Standard Frontend Page
			if (!is_404() && !is_search() && !is_archive()) {
				$TS_VCSC_StandardFrontendPage		= "true";
			} else {
				$TS_VCSC_StandardFrontendPage		= "false";
			}
			// Load Scripts As Needed
			if (!empty($post)){
				// Check for Standard Shortcodes
				if ((stripos($post->post_content, '[TS-VCSC-') !== FALSE) || (stripos($post->post_content, '[TS_VCSC_') !== FALSE)) {
					$TS_VCSC_StandardShorcodes		= "true";			
				} else {
					$TS_VCSC_StandardShorcodes		= "false";
				}
				// Check for EnlighterJS Shortcodes
				if (stripos($post->post_content, '[TS_EnlighterJS_') !== FALSE) {
					$TS_VCSC_EnlighterShorcodes		= "true";
				} else {
					$TS_VCSC_EnlighterShorcodes		= "false";
				}
				// Define Ajax Path Variable
				/*if (stripos($post->post_content, '[TS_VCSC_Timeline_CSS_Container') !== FALSE) {
					wp_enqueue_style('ts-visual-composer-extend-ajax', 		$url . '/css/ts-visual-composer-extend-ajax.css', null, false, 'all');
					wp_enqueue_script('ts-visual-composer-extend-ajax', 	$url . '/js/ts-visual-composer-extend-ajax.js', array('jquery'), false, true);
					wp_localize_script('ts-visual-composer-extend-ajax', 	'$TS_VCSC_AjaxData', array(
						'ajaxurl' 		=> admin_url('admin-ajax.php'),
						'queryvars' 	=> json_encode($wp_query->query)
					));
				}*/
				if ((($this->TS_VCSC_LoadFrontEndLightbox == "true") || ($this->TS_VCSC_UseLightboxPrettyPhoto == "true") || ($this->TS_VCSC_UseLightboxAutoMedia == "true")) && ($TS_VCSC_StandardFrontendPage == "true") && ($this->TS_VCSC_UseInternalLightbox == "true") && ($this->TS_VCSC_VCFrontEditMode == "false")) {
					if ((((array_key_exists('customscroll', $this->TS_VCSC_LightboxGlobalSettings)) ? $this->TS_VCSC_LightboxGlobalSettings['customscroll'] : $this->TS_VCSC_Lightbox_Setting_Defaults['customscroll']) == 1 ? 'true' : 'false') == "true") {
                        wp_enqueue_script('ts-extend-perfectscrollbar');
                        wp_enqueue_style('ts-extend-perfectscrollbar');
                    }
                    wp_enqueue_script('ts-extend-krautlightbox');
					wp_enqueue_style('ts-extend-krautlightbox');
				}
				if (($this->TS_VCSC_LoadFrontEndTooltips == "true") && ($TS_VCSC_StandardFrontendPage == "true") && ($this->TS_VCSC_VCFrontEditMode == "false")) {
					wp_enqueue_style('ts-extend-tooltipster');
					wp_enqueue_script('ts-extend-tooltipster');	
				}
				if (get_option('ts_vcsc_extend_settings_loadFonts', 0) == 1) {
					// Add CSS for each enabled Font to WordPress Frontend
					$this->TS_VCSC_IconFontsEnqueue(true);
				}
				/* Force Load of Core Files */				
				if (($this->TS_VCSC_LoadFrontEndForcable == "true") && ($TS_VCSC_StandardFrontendPage == "true")) {					
					// Load jQuery (if not already loaded)
					if (($this->TS_VCSC_LoadFrontEndJQuery == "true") && (!wp_script_is('jquery'))) {
						wp_enqueue_script('jquery');
					}
					if ($this->TS_VCSC_VCFrontEditMode == "false") {
						// Load Waypoints
						if ($this->TS_VCSC_LoadFrontEndWaypoints == "true") {
							if (wp_script_is('waypoints', $list = 'registered')) {
								wp_enqueue_script('waypoints');
							} else {
								wp_enqueue_script('ts-extend-waypoints');
							}
						}
					}
					// Add CSS for each enabled Icon Font to Page
					$this->TS_VCSC_IconFontsEnqueue(false);
					// Load Other Required Files
					if ($this->TS_VCSC_VCFrontEditMode == "false") {
						wp_enqueue_style('ts-extend-animations');
						wp_enqueue_style('ts-extend-tooltipster');
						wp_enqueue_script('ts-extend-tooltipster');	
						wp_enqueue_style('ts-visual-composer-extend-front');
						wp_enqueue_script('ts-visual-composer-extend-forms');
						wp_enqueue_script('ts-visual-composer-extend-galleries');
						wp_enqueue_script('ts-visual-composer-extend-backgrounds');
						wp_enqueue_script('ts-visual-composer-extend-front');						
					}
				}
				/* Files if Shortcode Detected or Widgets Activated */
				if ((($TS_VCSC_StandardShorcodes == "true" || $TS_VCSC_EnlighterShorcodes == "true") && ($TS_VCSC_StandardFrontendPage == "true")) || (($this->TS_VCSC_CustomPostTypesWidgets == "true") && ($TS_VCSC_StandardFrontendPage == "true"))) { 
					// Load jQuery (if not already loaded)
					if (($this->TS_VCSC_LoadFrontEndJQuery == "true") && (!wp_script_is('jquery'))) {
						wp_enqueue_script('jquery');
					}
					// Load MooTools (for EnlighterJS)
					if (($this->TS_VCSC_LoadFrontEndMooTools == "true") && ($TS_VCSC_EnlighterShorcodes == "true")) {
						wp_enqueue_script('ts-library-mootools');
					}
					// Load Google Charts API
					if ((TS_VCSC_CheckShortcode('TS-VCSC-Google-Charts') == "true") || (TS_VCSC_CheckShortcode('TS-VCSC-Google-Tables') == "true")) {
						wp_enqueue_script('ts-extend-google-charts');
					}
					// Add CSS for each enabled Icon Font to Page
					$this->TS_VCSC_IconFontsEnqueue(false);
				} else {
					// Add CSS for Each Enabled Font (Force Load)
					$this->TS_VCSC_IconFontsEnqueue(true);
				}
			}
		}
		function TS_VCSC_Extensions_Front_Head() {
			global $post;
			// Check For Standard Frontend Page
			if (!is_404() && !is_search() && !is_archive()) {
				$TS_VCSC_StandardFrontendPage		= "true";
			} else {
				$TS_VCSC_StandardFrontendPage		= "false";
			}
			if ((!empty($post)) && (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 1)){
				if ((stripos($post->post_content, '[TS-VCSC-') !== FALSE) || (stripos($post->post_content, '[TS_VCSC_') !== FALSE) || (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 1)) { 
					$url 		= plugin_dir_url( __FILE__ );
					$includes 	= includes_url();
					if ($this->TS_VCSC_LoadFrontEndJQuery == "true") {
						echo '<script data-cfasync="false" type="text/javascript" src="' . $includes . 'js/jquery/jquery.js"></script>';
						echo '<script data-cfasync="false" type="text/javascript" src="' . $includes . 'js/jquery/jquery-migrate.min.js"></script>';
					}
					if (get_option('ts_vcsc_extend_settings_loadEnqueue', 1) == 0) {
						echo '<link rel="stylesheet" id="ts-extend-tooltipster"  href="' .						$url . 'css/jquery.vcsc.tooltipster.min.css" type="text/css" media="all" />';
						echo '<link rel="stylesheet" id="ts-extend-animations"  href="' .						$url . 'css/ts-visual-composer-extend-animations.min.css" type="text/css" media="all" />';
						echo '<link rel="stylesheet" id="ts-visual-composer-extend-front"  href="' .			$url . 'css/ts-visual-composer-extend-front.min.css" type="text/css" media="all" />';
						if (get_option('ts_vcsc_extend_settings_loadHeader', 0) == 1) {
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/jquery.vcsc.tooltipster.min.js"></script>';
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/ts-visual-composer-extend-forms.min.js"></script>';
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/ts-visual-composer-extend-galleries.min.js"></script>';
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/ts-visual-composer-extend-backgrounds.min.js"></script>';
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/ts-visual-composer-extend-front.min.js"></script>';
						}
					}
				}
			}
			if (($this->TS_VCSC_UseEnlighterJS == "true") && ($this->TS_VCSC_UseThemeBuilder == "true")) {
				if (!empty($post)) {
					if (((stripos($post->post_content, '[TS_EnlighterJS') !== FALSE)) && ($TS_VCSC_StandardFrontendPage == "true")) {
                        require_once($this->registrations_dir . 'ts_vcsc_registrations_enlighterjs.php');
						TS_VCSC_GenerateCustomCSS(false);
					}
				}
			}
			// Files to loaded in Downtime Mode
			if ((is_admin_bar_showing()) && ($this->TS_VCSC_CustomPostTypesDownpage == "true") && (($this->TS_VCSC_Downtime_Manager_Settings['active'] == "1") || ($this->TS_VCSC_Downtime_Manager_Settings['active'] == 1))) {
				$admin_message = '';
				$admin_message .= '<style id="ts-downtime-mode-status-style" type="text/css">';
					$admin_message .= '#wp-toolbar .ts-downtime-mode-message-active {';
						$admin_message .= 'background: #FF0000;';
						$admin_message .= 'color: #ffffff;';
					$admin_message .= '}';
					$admin_message .= '#wp-toolbar .ts-downtime-mode-message-expired {';
						$admin_message .= 'background: #FF7700;';
						$admin_message .= 'color: #ffffff;';
					$admin_message .= '}';
				$admin_message .= '</style>';
				echo TS_VCSC_MinifyCSS($admin_message);
			}
			// Custom Fonts Files
			if ($this->TS_VCSC_UseCustomFontManager == "true") {
				foreach ($this->TS_VCSC_RegisteredCustomFonts as $fonts => $font) {
					if (($font->path != "") && ($font->load == "always")) {
						if ($font->enqueue != "") {
							wp_enqueue_style('ts-font-' . strtolower(base64_decode($font->enqueue)), rawurldecode($font->path), null, false, 'all');
						} else {
							$format_name 		= strpos($font->family, ':');
							if ($format_name !== false) {
								$custom_font 	= my_strstr(str_replace('+', ' ', $font->family), ':', true);
							} else {
								$custom_font 	= str_replace('+', ' ', $font->family);
							}	
							wp_enqueue_style('ts-font-' . strtolower(preg_replace('/[^a-zA-Z0-9]/','', $custom_font)), rawurldecode($font->path), null, false, 'all');
						}								
					}
				}
			}
		}
		function TS_VCSC_Extensions_Front_Footer() {
			global $post;
			$url 		= plugin_dir_url( __FILE__ );
			$includes 	= includes_url();
			if ((!empty($post)) || (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 1)){
				if ((stripos($post->post_content, '[TS-VCSC-') !== FALSE) || (stripos($post->post_content, '[TS_VCSC_') !== FALSE) || (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 1)) { 
					if (get_option('ts_vcsc_extend_settings_loadEnqueue', 1) == 0) {
						if (get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0) {
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/jquery.vcsc.tooltipster.min.js"></script>';
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/ts-visual-composer-extend-forms.min.js"></script>';
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/ts-visual-composer-extend-galleries.min.js"></script>';
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/ts-visual-composer-extend-backgrounds.min.js"></script>';
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/ts-visual-composer-extend-front.min.js"></script>';
						}
					}
				}
			}
		}
		function TS_VCSC_Extensions_Front_Variables() {
			global $post;
			if (!empty($post)){
				$this->TS_VCSC_Extensions_Create_Variables();
			}
		}
		function TS_VCSC_Extensions_Front_DequeueJS() {
			global $post;
			if (!empty($post)){
				if ($this->TS_VCSC_LoadFrontEndWaypoints == "false") {
					wp_deregister_script('waypoints');
					wp_dequeue_script('waypoints');
					wp_deregister_script('ts-extend-waypoints');
					wp_dequeue_script('ts-extend-waypoints');
				}
				if ($this->TS_VCSC_UseLightboxPrettyPhoto == "true") {
					wp_dequeue_script('prettyphoto');
					wp_deregister_script('prettyphoto');
				}
			}
		}
		function TS_VCSC_Extensions_Front_DequeueCSS() {
			global $post;
			if (!empty($post)){
				if ($this->TS_VCSC_UseLightboxPrettyPhoto == "true") {
					wp_dequeue_style('prettyphoto');
					wp_deregister_style('prettyphoto');
				}
			}
		}
		
		
		// Add Dashboard Widget
		// --------------------
		function TS_VCSC_DashboardHelpWidget() {
			global $wp_meta_boxes;
			wp_add_dashboard_widget('TS_VCSC_DashboardHelp', 'Composium - WP Bakery Page Builder Extensions Addon', array($this, 'TS_VCSC_DashboardHelpContent'));
		}
		function TS_VCSC_DashboardHelpContent() {
			$output = '';
			$output .= '<p><strong>Welcome to the most awesome "Composium - WP Bakery Page Builder Extensions Addon"!</strong></p>';
			if ((function_exists('get_plugin_data'))) {
				$output .= '<p>Current Version: ' . COMPOSIUM_VERSION . '</p>';
			}
			$output .= '<p style="font-size: 90%; font-style: italic;">WP Bakery Page Builder Version: '. $this->TS_VCSC_VisualComposer_Version . '</p>';
			if (function_exists('is_multisite') && is_multisite()) {
				$output .= '<p>Multisite Environment: Yes</p>';
				$output .= '<p>Plugin Activated Network Wide: ' . ($this->TS_VCSC_PluginIsMultiSiteActive == "true" ? "Yes" : "No") . '</p>';
			} else {
				$output .= '<p>Multisite Environment: No</p>';
			}
			$output .= '<p>Available Elements: ' . $this->TS_VCSC_CountTotalElements . ' / <span style="font-weight: bold; color: #0078CE;">Active Elements: ' . $this->TS_VCSC_CountActiveElements . '</span></p>';			
			$output .= '<p style="font-size: 10px;">Additional Deprecated Elements: ' . $this->TS_VCSC_CountDeprecatedElements . '</p>';
			if ($this->TS_VCSC_EditorIconFontsInternal == "true") {
				$TS_VCSC_TotalIconFontsInstalled = (count($this->TS_VCSC_Installed_Icon_Fonts) + count($this->TS_VCSC_Composer_Icon_Fonts));
			} else {
				$TS_VCSC_TotalIconFontsInstalled = count($this->TS_VCSC_Installed_Icon_Fonts);
			}
			if (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') != '') {
				$output .= '<p>Available Fonts: ' . $TS_VCSC_TotalIconFontsInstalled . ' / <span style="font-weight: bold; color: #0078CE;">Active Fonts: ' . $this->TS_VCSC_Active_Icon_Fonts . '</span></p>';
			} else {
				$output .= '<p>Available Fonts: ' . ($TS_VCSC_TotalIconFontsInstalled - 1) . ' / <span style="font-weight: bold; color: #0078CE;">Active Fonts: ' . $this->TS_VCSC_Active_Icon_Fonts . '</span></p>';
			}
			$output .= '<p>Available Icons: ' . number_format($this->TS_VCSC_Total_Icon_Count) . ' / <span style="font-weight: bold; color: #0078CE;">Active Icons: ' . number_format($this->TS_VCSC_Active_Icon_Count) . '</span></p>';
			$output .= 'You will find the manual here:<br/><a href="http://www.composium.krautcoding.com/documentation/" target="_blank">http://www.composium.krautcoding.com/documentation/</a></p>';
			if ($this->TS_VCSC_PluginExtended == "true") {
				$output .= '<p style="text-align: justify;">Need more help? Please contact the developer of your theme as it includes this plugin via extended license.<br/><br/>';
			} else {
				$output .= '<p style="text-align: justify;">Need more help? Please open a ticket in our support forum:<br/><a href="http://helpdesk.krautcoding.com/" target="_blank">http://helpdesk.krautcoding.com/</a><br/><br/>';
			}			
			echo $output;
		}
		
		
		// Determine Enabled/Disabled Elements + Counter + Editor Status
		// -------------------------------------------------------------
		function TS_VCSC_DetermineLoadingStatus() {
			// Retrieve Current Browser URL
			$TS_VCSC_Extension_Browser							= 'http://';
			if (isset($_SERVER['SERVER_NAME'])) {
				$TS_VCSC_Extension_Browser						.= $_SERVER['SERVER_NAME'];
			} else if (isset($_SERVER['HTTP_HOST'])) {
				$TS_VCSC_Extension_Browser						.= $_SERVER['HTTP_HOST'];
			}			
			if (isset($_SERVER['REQUEST_URI'])) {
				$TS_VCSC_Extension_Browser 						.= $_SERVER['REQUEST_URI'];
			}
			// Check for Plugin Specific Pages
			$this->TS_VCSC_PluginFontSummary					= "false";
			if (strpos($TS_VCSC_Extension_Browser, '?page=TS_VCSC_Extender') !== false) {
				$this->TS_VCSC_PluginFontSummary				= "true";
			} else if (strpos($TS_VCSC_Extension_Browser, '?page=TS_VCSC_System') !== false) {
				$this->TS_VCSC_PluginFontSummary				= "true";
			}
			$this->TS_VCSC_GoggleFontSummary					= "false";
			if ((strpos($TS_VCSC_Extension_Browser, '?page=TS_VCSC_GoogleFonts') !== false) || (strpos($TS_VCSC_Extension_Browser, '?page=TS_VCSC_System') !== false)) {
				$this->TS_VCSC_GoggleFontSummary				= "true";
			}
			$this->TS_VCSC_PluginSettingsTransfer				= "false";
			if (strpos($TS_VCSC_Extension_Browser, '?page=TS_VCSC_Transfers') !== false) {
				$this->TS_VCSC_PluginSettingsTransfer			= "true";
			}
			$this->TS_VCSC_PluginEnlighterTheme					= "false";
			if (strpos($TS_VCSC_Extension_Browser, '?page=TS_VCSC_EnlighterJS') !== false) {
				$this->TS_VCSC_PluginEnlighterTheme				= "true";
			}
			$this->TS_VCSC_PluginDownTimeManager				= "false";
			if (strpos($TS_VCSC_Extension_Browser, '?page=TS_VCSC_Downtime') !== false) {
				$this->TS_VCSC_PluginDownTimeManager			= "true";
			}
			$this->TS_VCSC_PluginIconFontImport					= "false";
			if (strpos($TS_VCSC_Extension_Browser, '?page=TS_VCSC_Uploader') !== false) {
				$this->TS_VCSC_PluginIconFontImport				= "true";
			}
			$this->TS_VCSC_PluginUsageCompiler					= "false";
			if (strpos($TS_VCSC_Extension_Browser, '?page=TS_VCSC_Usage') !== false) {
				$this->TS_VCSC_PluginUsageCompiler				= "true";
			}
            $this->TS_VCSC_PluginIconGenerator                  = "false";
			if (strpos($TS_VCSC_Extension_Browser, '?page=TS_VCSC_Generator') !== false) {
				$this->TS_VCSC_PluginIconGenerator				= "true";
			}
			$this->TS_VCSC_Icons_Compliant_Loading				= "false";
			if ((strpos($TS_VCSC_Extension_Browser, '?page=TS_VCSC_Previews') !== false) || (strpos($TS_VCSC_Extension_Browser, '?page=TS_VCSC_Generator') !== false)) {
				$this->TS_VCSC_Icons_Compliant_Loading			= "true";
			}
            // Check for Composium Custom Post Types
            $this->TS_VCSC_CustomPostTypesPresent               = "false";
            if (strpos($TS_VCSC_Extension_Browser, '?post_type=ts_timeline') !== false) {
                $this->TS_VCSC_CustomPostTypesPresent           = "true";
            }
			// Check for WP Bakery Page Builder Roles Manager			
			$this->TS_VCSC_Extension_RoleManager				= "false";
			if (strpos($TS_VCSC_Extension_Browser, '?page=vc-roles') !== false) {
				$this->TS_VCSC_Extension_RoleManager			= "true";		
			}
			// Check for Elements for Users - Addon for WP Bakery Page Builder
			$this->TS_VCSC_Extension_ElementsUser				= "false";
			if (strpos($TS_VCSC_Extension_Browser, '?page=mcw_elements_for_users') !== false) {
				$this->TS_VCSC_Extension_ElementsUser			= "true";		
			}
			// Check for Toolsets Template Editor
			$this->TS_VCSC_Extension_ToolsetsUser				= "false";
			if (strpos($TS_VCSC_Extension_Browser, '?page=ct-editor') !== false) {
				$this->TS_VCSC_Extension_ToolsetsUser			= "true";		
			}
			// Determine if WP Bakery Page Builder Form Request
			if (array_key_exists('action', $_REQUEST)) {
				$TS_VCSC_Extension_Request						= ($_REQUEST["action"] != "vc_edit_form" ? "false" : "true");
			} else {
				$TS_VCSC_Extension_Request						= "false";
			}
			// Determine Standard Page Editor
			$this->TS_VCSC_VCStandardEditMode					= (TS_VCSC_IsEditPagePost() == 1 ? "true" : "false");
			// Determine Frontend Editor Status
			if (function_exists('vc_is_inline')){
				if (vc_is_inline() == true) {
					$this->TS_VCSC_VCFrontEditMode 				= "true";
				} else {
					if ((vc_is_inline() == NULL) || (vc_is_inline() == '')) {
						if (TS_VCSC_CheckFrontEndEditor() == true) {
							$this->TS_VCSC_VCFrontEditMode 		= "true";
						} else {
							$this->TS_VCSC_VCFrontEditMode 		= "false";
						}	
					} else {
						$this->TS_VCSC_VCFrontEditMode 			= "false";
					}
				}
			} else {
				$this->TS_VCSC_VCFrontEditMode 					= "false";
			}
			// Check AJAX Request Status
			$this->TS_VCSC_PluginAJAX							= ($this->TS_VCSC_RequestIsFrontendAJAX() == 1 ? "true" : "false");
			// Set Global Load Status
			$this->TS_VCSC_VisualComposer_Loading				= "false";            
            $this->TS_VCSC_Gutenberg_Classic                    = (TS_VCSC_CheckGBClassicEditor() == true ? "true" : "false");
			if ((defined('WPB_VC_VERSION')) && (($TS_VCSC_Extension_Request == "true") || ($this->TS_VCSC_VCFrontEditMode == "true") || ($this->TS_VCSC_VCStandardEditMode == "true") || ($this->TS_VCSC_PluginAJAX == "true")) || ($this->TS_VCSC_Extension_ToolsetsUser == "true")) {
                $this->TS_VCSC_VisualComposer_Loading           = "true";
			}
            // Check for In-Compatible WP Bakery WEBSITE Builder
            $this->TS_VCSC_WebsiteBuilder_Instead               = "false";
            $this->TS_VCSC_WebsiteBuilder_Instead               = (TS_VCSC_CheckVCWebsiteEditor() === true ? "true" : "false");
			// Register Global Data/Functions As Needed
			$this->TS_VCSC_RegisterGlobalData();
		}
		function TS_VCSC_DetermineElementStatus() {			
			// Standard Element Settings
			$TS_VCSC_Extension_Elements 						= get_option('ts_vcsc_extend_settings_StandardElements', array());
			if ((!is_array($TS_VCSC_Extension_Elements)) || ($TS_VCSC_Extension_Elements == '')) {
				$TS_VCSC_Extension_Elements 					= array();
			}
			foreach ($this->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
				$defaultstatus 	= ($element['default'] == "true" ? 1 : 0);
				$key 			= $element['setting'];
				$this->TS_VCSC_CountTotalElements++;
				if ($element['deprecated'] == "true") {
					$this->TS_VCSC_CountDeprecatedElements++;
				}
				if (array_key_exists($key, $TS_VCSC_Extension_Elements)) {
					if ($TS_VCSC_Extension_Elements[$key] == "1") {							
						$this->TS_VCSC_Visual_Composer_Elements[$ElementName]['active'] = "true";
					} else {
						$this->TS_VCSC_Visual_Composer_Elements[$ElementName]['active'] = "false";
					}
				} else {
					if ($defaultstatus == 1) {$defaultstatus = "true";} else {$defaultstatus = "false";};
					$this->TS_VCSC_Visual_Composer_Elements[$ElementName]['active'] = $defaultstatus;
				}
				if ($this->TS_VCSC_Visual_Composer_Elements[$ElementName]['active'] == "true") {
					$this->TS_VCSC_CountActiveElements++;
				}
			}
			// Count Child Elements
			foreach ($this->TS_VCSC_Visual_Composer_Children as $ElementName => $element) {
				$this->TS_VCSC_CountTotalElements++;
				if ($element['deprecated'] == "true") {
					$this->TS_VCSC_CountDeprecatedElements++;
				}
				$CrossMatch 									= $element["parent"];
				foreach ($this->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
					if (($element["setting"] == $CrossMatch) && ($element["type"] == "class")) {
						if ($element['active'] == "true") {
							$this->TS_VCSC_CountActiveElements++;
						}
						$this->TS_VCSC_Visual_Composer_Elements[$ElementName]['children'] = intval($this->TS_VCSC_Visual_Composer_Elements[$ElementName]['children']) + 1;
						break;
					}
				}
				unset($CrossMatch);
			}
			// Count Post Type Elements
			foreach ($this->TS_VCSC_Visual_Composer_Types as $ElementName => $element) {
				$this->TS_VCSC_CountTotalElements++;
				if (($element['posttype'] == "ts_skillsets") && ($this->TS_VCSC_CustomPostTypesSkillset == "true")) {
					$this->TS_VCSC_CountActiveElements++;
					$this->TS_VCSC_Visual_Composer_Types[$ElementName]["active"] = "true";
				} else if (($element['posttype'] == "ts_team") && ($this->TS_VCSC_CustomPostTypesTeam == "true")) {
					$this->TS_VCSC_CountActiveElements++;
					$this->TS_VCSC_Visual_Composer_Types[$ElementName]["active"] = "true";
				} else if (($element['posttype'] == "ts_testimonials") && ($this->TS_VCSC_CustomPostTypesTestimonial == "true")) {
					$this->TS_VCSC_CountActiveElements++;
					$this->TS_VCSC_Visual_Composer_Types[$ElementName]["active"] = "true";
				} else if (($element['posttype'] == "ts_timeline") && ($this->TS_VCSC_CustomPostTypesTimeline == "true")) {
					$this->TS_VCSC_CountActiveElements++;
					$this->TS_VCSC_Visual_Composer_Types[$ElementName]["active"] = "true";
				} else if (($element['posttype'] == "ts_logos") && ($this->TS_VCSC_CustomPostTypesLogo == "true")) {
					$this->TS_VCSC_CountActiveElements++;
					$this->TS_VCSC_Visual_Composer_Types[$ElementName]["active"] = "true";
				} else if (($element['posttype'] == "ts_widgets") && ($this->TS_VCSC_CustomPostTypesWidgets == "true")) {
					$this->TS_VCSC_CountActiveElements++;
					$this->TS_VCSC_Visual_Composer_Types[$ElementName]["active"] = "true";
				}
			}
			// Count Extra Elements
			foreach ($this->TS_VCSC_Visual_Composer_Extra as $ElementName => $element) {
				$this->TS_VCSC_CountTotalElements++;
				if ($element['deprecated'] == "true") {
					$this->TS_VCSC_CountDeprecatedElements++;
				}
				if (($element['feature'] == "Enlighter") && ($this->TS_VCSC_UseEnlighterJS == "true")) {
					$this->TS_VCSC_CountActiveElements++;
					$this->TS_VCSC_Visual_Composer_Extra[$ElementName]["active"] = "true";
				} else if (($element['feature'] == "Navigator") && ($this->TS_VCSC_UsePageNavigator == "true")) {
					$this->TS_VCSC_CountActiveElements++;
					$this->TS_VCSC_Visual_Composer_Extra[$ElementName]["active"] = "true";
				}
			}
			// Demo Elements
			$TS_VCSC_Extension_Demos 							= get_option('ts_vcsc_extend_settings_DemoElements', array());
			if ((!is_array($TS_VCSC_Extension_Demos)) || ($TS_VCSC_Extension_Demos == '')) {
				$TS_VCSC_Extension_Demos 						= array();
			}
			foreach ($this->TS_VCSC_Visual_Composer_Demos as $ElementName => $element) {
				$defaultstatus 	= ($element['default'] == "true" ? 1 : 0);
				$key 			= $element['setting'];
				if ($element['base'] != '') {
					$this->TS_VCSC_CountTotalElements++;
				}
				if (array_key_exists($key, $TS_VCSC_Extension_Demos)) {
					if ($TS_VCSC_Extension_Demos[$key] == "1") {							
						$this->TS_VCSC_Visual_Composer_Demos[$ElementName]['active'] = "true";
					} else {
						$this->TS_VCSC_Visual_Composer_Demos[$ElementName]['active'] = "false";
					}
				} else {
					if ($defaultstatus == 1) {$defaultstatus = "true";} else {$defaultstatus = "false";};
					$this->TS_VCSC_Visual_Composer_Demos[$ElementName]['active'] = $defaultstatus;
				}
				if ($this->TS_VCSC_Visual_Composer_Demos[$ElementName]['active'] == "true") {
					if ($element['base'] != '') {
						$this->TS_VCSC_CountActiveElements++;
					}
				}
			}
			// WooCommerce Elements Settings
			if ($this->TS_VCSC_WooCommerceActive == "true") {
				$TS_VCSC_WooCommerce_Elements 					= get_option('ts_vcsc_extend_settings_WooCommerceElements', array());
				if ((!is_array($TS_VCSC_WooCommerce_Elements)) || ($TS_VCSC_WooCommerce_Elements == '')) {
					$TS_VCSC_WooCommerce_Elements 	= array();
				}
				foreach ($this->TS_VCSC_WooCommerce_Elements as $ElementName => $element) {
					$defaultstatus 	= ($element['default'] == "true" ? "true" : "false");
					$key 			= $element['setting'];
					$type			= $element['type'];
					$this->TS_VCSC_CountTotalElements++;
					if ($element['deprecated'] == "true") {
						$this->TS_VCSC_CountDeprecatedElements++;
					}
					if (array_key_exists($key, $TS_VCSC_WooCommerce_Elements)) {
						if ($TS_VCSC_WooCommerce_Elements[$key] == "1") {
							$this->TS_VCSC_WooCommerce_Elements[$ElementName]['active'] = "true";
							if ($type == "class") {
								$this->TS_VCSC_CountActiveElements++;
							}
						} else {
							$this->TS_VCSC_WooCommerce_Elements[$ElementName]['active'] = "false";
						}
					} else {
						$this->TS_VCSC_WooCommerce_Elements[$ElementName]['active'] = $defaultstatus;
						if ($defaultstatus == "true") {
							if ($type == "class") {
								$this->TS_VCSC_CountActiveElements++;
							}
						}
					}
				}
			}
			// bbPress Elements Settings
			if ($this->TS_VCSC_bbPressActive == "true") {
				$TS_VCSC_bbPress_Elements 						= get_option('ts_vcsc_extend_settings_bbPressElements', array());
				if ((!is_array($TS_VCSC_bbPress_Elements)) || ($TS_VCSC_bbPress_Elements == '')) {
					$TS_VCSC_bbPress_Elements = array();
				}
				foreach ($this->TS_VCSC_bbPress_Elements as $ElementName => $element) {
					$defaultstatus 	= ($element['default'] == "true" ? "true" : "false");
					$key 			= $element['setting'];
					$this->TS_VCSC_CountTotalElements++;
					if ($element['deprecated'] == "true") {
						$this->TS_VCSC_CountDeprecatedElements++;
					}
					if (array_key_exists($key, $TS_VCSC_bbPress_Elements)) {
						if ($TS_VCSC_bbPress_Elements[$key] == "1") {
							$this->TS_VCSC_bbPress_Elements[$ElementName]['active'] = "true";
							$this->TS_VCSC_CountActiveElements++;
						} else {
							$this->TS_VCSC_bbPress_Elements[$ElementName]['active'] = "false";
						}
					} else {
						$this->TS_VCSC_bbPress_Elements[$ElementName]['active'] = $defaultstatus;
						if ($defaultstatus == "true") {
							$this->TS_VCSC_CountActiveElements++;
						}
					}
				}
			}
			// Count Adjustments
			if (($this->TS_VCSC_CustomPostTypesTimeline == "true") && ($this->TS_VCSC_Visual_Composer_Elements["TS CSS Media Timeline"]["active"] == "true")) {
				$this->TS_VCSC_CountTotalElements--;
				$this->TS_VCSC_CountActiveElements--;
			}
			$this->TS_VCSC_CountTotalElements = $this->TS_VCSC_CountTotalElements - $this->TS_VCSC_CountDeprecatedElements;
			// Load Conditional Files
			if ($this->TS_VCSC_VisualComposer_Loading == "true") {
				if ($this->TS_VCSC_Visual_Composer_Elements["TS Google Maps PLUS"]["active"] == "true") {
					require_once($this->assets_dir . 'ts_vcsc_font_mapmarker.php');
				}
			}
		}
		
		
		/* Load + Register Global Data */
		/* --------------------------- */
		function TS_VCSC_RegisterGlobalData() {
			// Load Required Data Arrays + Functions
			if (($this->TS_VCSC_VisualComposer_Loading == "true") || ($this->TS_VCSC_PluginDownTimeManager == "true") || ($this->TS_VCSC_PluginFontSummary == "true") || ($this->TS_VCSC_Icons_Compliant_Loading == "true") || ($this->TS_VCSC_GoggleFontSummary == "true") || ($this->TS_VCSC_PluginSettingsTransfer == "true") || ($this->TS_VCSC_PluginIconFontImport == "true") || ($this->TS_VCSC_PluginUsageCompiler == "true") || ($this->TS_VCSC_PluginIconGenerator == "true") || ($this->TS_VCSC_CustomPostTypesPresent == "true")) {
				require_once($this->registrations_dir . 'ts_vcsc_registrations_functions.php');
				require_once($this->registrations_dir . 'ts_vcsc_registrations_other.php');                
				if (($this->TS_VCSC_VisualComposer_Loading == "true") || ($this->TS_VCSC_GoggleFontSummary == "true") || ($this->TS_VCSC_PluginFontSummary == "true") || ($this->TS_VCSC_Icons_Compliant_Loading == "true") || ($this->TS_VCSC_PluginIconGenerator == "true")) {
					require_once($this->registrations_dir . 'ts_vcsc_registrations_googlefonts.php');
				}
				require_once($this->registrations_dir . 'ts_vcsc_registrations_conditionals.php');
			} else if (($this->TS_VCSC_Extension_RoleManager == "true") || ($this->TS_VCSC_Extension_ElementsUser == "true")) {
				require_once($this->registrations_dir . 'ts_vcsc_registrations_other.php');
				require_once($this->registrations_dir . 'ts_vcsc_registrations_conditionals.php');                
			} else if ((!is_admin()) || ($this->TS_VCSC_PluginAlways == "true")) {
				require_once($this->registrations_dir . 'ts_vcsc_registrations_functions.php');
				require_once($this->registrations_dir . 'ts_vcsc_registrations_other.php');
				require_once($this->registrations_dir . 'ts_vcsc_registrations_conditionals.php');                
			}
			// EnlighterJS - Syntax Highlighter
			if (($this->TS_VCSC_UseEnlighterJS == "true") && (($this->TS_VCSC_PluginEnlighterTheme == "true") || ($this->TS_VCSC_VisualComposer_Loading == "true"))) {
				require_once($this->registrations_dir . 'ts_vcsc_registrations_functions.php');
				require_once($this->registrations_dir . 'ts_vcsc_registrations_enlighterjs.php');
			}			
			// Add Custom Icon Font to WBP Elements
			if ($this->TS_VCSC_VisualComposer_Loading == "true") {
				//require_once($this->registrations_dir . 'ts_vcsc_registrations_composer.php');
			}
		}
		
		
		// Load Composer Shortcodes + Elements + Add Custom Parameters
		// -----------------------------------------------------------
		function TS_VCSC_RegisterAllShortcodes() {
			if ($this->TS_VCSC_PluginSupport == "true") {
				// Standard Elements
				foreach ($this->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
					if ($this->TS_VCSC_Visual_Composer_Elements[$ElementName]['active'] == "true") {
						if ($element['type'] == 'internal') {							
							if (($this->TS_VCSC_VCFrontEditMode == "true") || (is_admin() == false) || ($this->TS_VCSC_PluginAJAX == "true") || ($this->TS_VCSC_PluginAlways == "true")) {
								require_once($this->shortcode_dir.'ts_vcsc_shortcode_' . $element['file'] . '.php');
							}							
						}
					}
				}
				// Load Inter-Dependent Shortocdes
				if ((($this->TS_VCSC_Visual_Composer_Elements['TS Icon Info Box']['active'] == "true") || ($this->TS_VCSC_Visual_Composer_Elements['TS Panel Flip']['active'] == "true")) && ($this->TS_VCSC_Visual_Composer_Elements['TS Creative Link']['active'] == "false")) {
					if (($this->TS_VCSC_VCFrontEditMode == "true") || (is_admin() == false) || ($this->TS_VCSC_PluginAJAX == "true") || ($this->TS_VCSC_PluginAlways == "true")) {
						require_once($this->shortcode_dir.'ts_vcsc_shortcode_' . $this->TS_VCSC_Visual_Composer_Elements['TS Creative Link']['file'] . '.php');
					}
				}				
				// Demo Elements
				foreach ($this->TS_VCSC_Visual_Composer_Demos as $ElementName => $element) {
					if ($this->TS_VCSC_Visual_Composer_Demos[$ElementName]['active'] == "true") {
						if (($this->TS_VCSC_VCFrontEditMode == "true") || (is_admin() == false) || ($this->TS_VCSC_PluginAJAX == "true") || ($this->TS_VCSC_PluginAlways == "true")) {
							require_once($this->shortcode_dir.'ts_vcsc_shortcode_' . $element['file'] . '.php');
						}	
					}
				}	
				// Extended Row + Columns + Iconicum
				if (($this->TS_VCSC_VCFrontEditMode == "true") || (is_admin() == false) || ($this->TS_VCSC_PluginAJAX == "true") || ($this->TS_VCSC_PluginAlways == "true")) {
					// Extended Row Settings
					if ($this->TS_VCSC_UseExtendedRows == "true") {
						require_once($this->shortcode_dir . 'ts_vcsc_shortcode_row.php');
					}
					// Extended Column Settings
					if ($this->TS_VCSC_UseExtendedColumns == "true") {
						require_once($this->shortcode_dir . 'ts_vcsc_shortcode_column.php');
					}
				}
				// bbPress Elements
				if ($this->TS_VCSC_bbPressActive == "true") {
					// Shortcodes Defined by bbPress itself
				}
			}
		}
		function TS_VCSC_RegisterWithComposer() {			
			if (($this->TS_VCSC_PluginSupport == "true") && ($this->TS_VCSC_WebsiteBuilder_Instead == "false")) {
				// Determine Registration Approach
				if (($this->TS_VCSC_VCFrontEditMode == "true") || ($this->TS_VCSC_VisualComposer_Loading == "true")) {
					$this->TS_VCSC_AddParametersToComposer();					
					$this->TS_VCSC_AddElementsToComposer();
				} else if (($this->TS_VCSC_Extension_RoleManager == "true") || ($this->TS_VCSC_Extension_ElementsUser == "true")) {
					$this->TS_VCSC_AddElementsToComposer();
				} else {
					$this->TS_VCSC_LoadClassElements();
				}
				// Remove Element Mapping Array (WBP 4.9.x)
				unset($this->TS_VCSC_VisualComposer_Element);
				// Add Mapped Shortcodes to WBP (AJAX Callabck Fix)
				if (class_exists("WPBMap") && method_exists("WPBMap", "addAllMappedShortcodes")) {
					WPBMap::addAllMappedShortcodes();
				}
			}
		}
		function TS_VCSC_AddParametersToComposer() {
			if (($this->TS_VCSC_PluginSupport == "true") && ($this->TS_VCSC_WebsiteBuilder_Instead == "false")) {
				if ($this->TS_VCSC_VisualComposer_Loading == "true") {
					foreach ($this->TS_VCSC_ComposerParameters as $ParameterName => $parameter) {
						if ($parameter['file'] == "advancedlinks") {
							if ($this->TS_VCSC_ParameterLinkPicker['enabled'] == "true") {
								require_once($this->parameters_dir . 'ts_vcsc_parameter_' . $parameter['file'] . '.php');
							}
						} else {
							require_once($this->parameters_dir . 'ts_vcsc_parameter_' . $parameter['file'] . '.php');
						}
					}
					if ($this->TS_VCSC_EditorElementFilter == "true") {
						require_once($this->registrations_dir . 'ts_vcsc_registrations_subcategories.php');
					}
				}
			}
		}
		function TS_VCSC_AddElementsToComposer() {			
			if (($this->TS_VCSC_PluginSupport == "true") && ($this->TS_VCSC_WebsiteBuilder_Instead == "false")) {
				if (($this->TS_VCSC_VisualComposer_Loading == "true") || ($this->TS_VCSC_Extension_RoleManager == "true") || ($this->TS_VCSC_Extension_ElementsUser == "true")) {
					// Load Standard Elements
					foreach ($this->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
						if ($element['active'] == "true") {						
							if ($this->TS_VCSC_VisualComposer_LeanMap == "true") {
								if ($element['type'] == 'internal') {
									vc_lean_map($element['base'], null, $this->elements_dir . 'ts_vcsc_element_' . $element['file'] . '.php');							
								} else if ($element['type'] == 'class') {
									require_once($this->classes_dir . 'ts_vcsc_class_' . $element['file'] . '.php');
								} else if ($element['type'] == 'external') {
									vc_lean_map($element['base'], null, $this->plugins_dir . 'ts_vcsc_element_' . $element['file'] . '.php');
								}
							} else if (function_exists('vc_map')) {
								if ($element['type'] == 'internal') {
									require_once($this->elements_dir . 'ts_vcsc_element_' . $element['file'] . '.php');
								} else if ($element['type'] == 'class') {						
									require_once($this->classes_dir . 'ts_vcsc_class_' . $element['file'] . '.php');
								} else if ($element['type'] == 'external') {
									require_once($this->plugins_dir . 'ts_vcsc_element_' . $element['file'] . '.php');
								}
							}
						}
					}
					// Load Demo Elements
					foreach ($this->TS_VCSC_Visual_Composer_Demos as $ElementName => $element) {
						if (($element['active'] == "true") && ($element['base'] != '')) {
							if ($this->TS_VCSC_VisualComposer_LeanMap == "true") {
								vc_lean_map($element['base'], null, $this->elements_dir . 'ts_vcsc_element_' . $element['file'] . '.php');
							} else if (function_exists('vc_map')) {
								require_once($this->elements_dir . 'ts_vcsc_element_' . $element['file'] . '.php');
							}
						}
					}
					// Load WooCommerce Elements
					if ($this->TS_VCSC_WooCommerceActive == "true") {
						if (($this->TS_VCSC_VisualComposer_LeanMap == "true") || (function_exists('vc_map'))) {
							foreach ($this->TS_VCSC_WooCommerce_Elements as $ElementName => $element) {
								if ($element['active'] == "true") {
									require_once($this->woocommerce_dir . 'ts_vcsc_woocommerce_' . $element['file'] . '.php');
								}
							}
						}
					}
					// Load bbPress Elements
					if ($this->TS_VCSC_bbPressActive == "true") {
						foreach ($this->TS_VCSC_bbPress_Elements as $ElementName => $element) {
							if ($element['active'] == "true") {
								if ($this->TS_VCSC_VisualComposer_LeanMap == "true") {
									vc_lean_map($element['base'], null, $this->bbpress_dir . 'ts_vcsc_bbpress_' . $element['file'] . '.php');
								} else if (function_exists('vc_map')) {
									require_once($this->bbpress_dir . 'ts_vcsc_bbpress_' . $element['file'] . '.php');
								}
							}
						}
					}
					// Load Custom Post Type Elements
					if ($this->TS_VCSC_CustomPostTypesCheckup == "true") {
						// Load Teammate Settings
						if ($this->TS_VCSC_CustomPostTypesTeam == "true") {
							require_once($this->classes_dir . 'ts_vcsc_class_teammates.php');
							require_once($this->classes_dir . 'ts_vcsc_class_teampage.php');
						}
						// Load Testimonial Settings
						if ($this->TS_VCSC_CustomPostTypesTestimonial == "true") {
							require_once($this->classes_dir . 'ts_vcsc_class_testimonials.php');
						}
						// Load Logo Settings
						if ($this->TS_VCSC_CustomPostTypesLogo == "true") {
							require_once($this->classes_dir . 'ts_vcsc_class_logos.php');
						}
						// Load Skillset Settings
						if ($this->TS_VCSC_CustomPostTypesSkillset == "true") {
							require_once($this->classes_dir . 'ts_vcsc_class_skillsets.php');
						}
						// Load Timeline Settings
						if ($this->TS_VCSC_CustomPostTypesTimeline == "true") {
							if ($this->TS_VCSC_Visual_Composer_Elements["TS CSS Media Timeline"]["active"] == "false") {
								require_once($this->classes_dir . 'ts_vcsc_class_timeline_css.php');
							}
						}
					}
					// CP Widgets Element
					if ($this->TS_VCSC_CustomPostTypesWidgets == "true") {
						require_once($this->classes_dir . 'ts_vcsc_class_vcwidgets.php');
					}
					// Single Page Navigator Builder
					if ($this->TS_VCSC_UsePageNavigator == "true") {
						require_once($this->classes_dir . 'ts_vcsc_class_singlepage.php');
					}
					// Extended Row Settings
					if ($this->TS_VCSC_UseExtendedRows == "true") {
						require_once($this->elements_dir . 'ts_vcsc_element_row.php');
						// ------------------------
						// Add Custom BackEnd Views
						// ------------------------
						if (function_exists('vc_map_update')) {
							if ($this->TS_VCSC_EditorBackgroundIndicator == "true") {
								$setting = array (
									"js_view" 				=> 'TS_VCSC_VcRowViewCustom',
								);
							} else {
								$setting = array ();
							}				
							vc_map_update('vc_row', $setting);
							if (TS_VCSC_VersionCompare($this->TS_VCSC_VisualComposer_Version, '5.0.0') >= 0) {
								if ($this->TS_VCSC_EditorBackgroundIndicator == "true") {
									$setting = array (
										"js_view" 			=> 'TS_VCSC_VcSectionViewCustom',
									);
								} else {
									$setting = array ();
								}				
								vc_map_update('vc_section', $setting);
							}
						}
					}
					// Extended Column Settings
					if ($this->TS_VCSC_UseExtendedColumns == "true") {
						require_once($this->elements_dir . 'ts_vcsc_element_column.php');
					}	
					// Load EnlighterJS Elements
					if ($this->TS_VCSC_UseEnlighterJS == "true") {
						require_once($this->classes_dir . 'ts_vcsc_class_enlighterjs.php');	
					}
				}
			}
		}
		function TS_VCSC_LoadClassElements() {			
			if (($this->TS_VCSC_PluginSupport == "true") && ($this->TS_VCSC_WebsiteBuilder_Instead == "false")) {
				if (($this->TS_VCSC_VisualComposer_Loading == "true") || (is_admin() == false) || ($this->TS_VCSC_PluginAJAX == "true") || ($this->TS_VCSC_PluginAlways == "true")) {
					// Load Standards Elements with Class Definitions
					foreach ($this->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
						if ($element['type'] == 'class') {
							if ($element['active'] == "true") {
								require_once($this->classes_dir . '/ts_vcsc_class_' . $element['file'] . '.php');
							}
						}
					}
					// Load WooCommerce Class Elements
					if ($this->TS_VCSC_WooCommerceActive == "true") {
						foreach ($this->TS_VCSC_WooCommerce_Elements as $ElementName => $element) {
							if ($element['active'] == "true") {
								require_once($this->woocommerce_dir . 'ts_vcsc_woocommerce_' . $element['file'] . '.php');
							}
						}
					}
					// Load Custom Post Type Class Elements
					if ($this->TS_VCSC_CustomPostTypesLoaded == "true") {
						// Load Teammate Settings
						if ($this->TS_VCSC_CustomPostTypesTeam == "true") {
							require_once($this->classes_dir . 'ts_vcsc_class_teammates.php');
							require_once($this->classes_dir . 'ts_vcsc_class_teampage.php');
						}
						// Load Testimonial Settings
						if ($this->TS_VCSC_CustomPostTypesTestimonial == "true") {
							require_once($this->classes_dir . 'ts_vcsc_class_testimonials.php');
						}
						// Load Logo Settings
						if ($this->TS_VCSC_CustomPostTypesLogo == "true") {
							require_once($this->classes_dir . 'ts_vcsc_class_logos.php');
						}
						// Load Skillset Settings
						if ($this->TS_VCSC_CustomPostTypesSkillset == "true") {
							require_once($this->classes_dir . 'ts_vcsc_class_skillsets.php');
						}
						// Load Timeline Settings
						if ($this->TS_VCSC_CustomPostTypesTimeline == "true") {
							if ($this->TS_VCSC_Visual_Composer_Elements["TS CSS Media Timeline"]["active"] == "false") {
								require_once($this->classes_dir . 'ts_vcsc_class_timeline_css.php');
							}
						}
					}
					// CP Widgets Element
					if ($this->TS_VCSC_CustomPostTypesWidgets == "true") {
						require_once($this->classes_dir . 'ts_vcsc_class_vcwidgets.php');
					}
					// Single Page Navigator Builder
					if ($this->TS_VCSC_UsePageNavigator == "true") {
						require_once($this->classes_dir . 'ts_vcsc_class_singlepage.php');
					}
					// Load EnlighterJS Elements
					if ($this->TS_VCSC_UseEnlighterJS == "true") {
						require_once($this->classes_dir . 'ts_vcsc_class_enlighterjs.php');	
					}
					// Iconicum Generator
					if ($this->TS_VCSC_IconicumStandard == "false") {
                        if ((($this->TS_VCSC_IconicumActivated == "true") && ($this->TS_VCSC_IconicumStandard == "false")) || ($this->TS_VCSC_IconicumMenuGenerator == "true")) {
                            if ($this->TS_VCSC_Visual_Composer_Elements['TS Icon Fonts']['active'] == "false") {
                                require_once($this->classes_dir . 'ts_vcsc_class_fonticon.php');
                            }
						}
					}
				}
			}
		}
		
		
		/* Functions for Custom Font Upload */
		/* -------------------------------- */
		
		// Sets Path to wp-content/uploads/ts-vcsc-icons/custom-pack
		function TS_VCSC_SetUploadDirectory($upload) {
			$upload['subdir'] 	= '/ts-vcsc-icons/custom-pack';
			$upload['path'] 	= $upload['basedir'] . $upload['subdir'];
			$upload['url']   	= $upload['baseurl'] . $upload['subdir'];
			return $upload;
		}
		//Set custom path for all icon uploads to wp-content/uploads/ts-vcsc-icons/custom-pack
		function TS_VCSC_ChangeDownloadsUploadDirectory() {
			$isSecure 			= false;
			if ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || ($_SERVER['SERVER_PORT'] == 443)) {
				$isSecure 		= true;
			} else if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
				$isSecure 		= true;
			}
			$actual_link 		= ($isSecure ? 'https' : 'http');
			$actual_link 		= $actual_link . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];			
			$actual_link 		= explode('/', $actual_link);
			$urlBasename 		= array_pop($actual_link);
			$upload_directory 	= wp_upload_dir();
			$font_directory		= $upload_directory['basedir'] . '/ts-vcsc-icons/custom-pack';
			update_option('ts_vcsc_extend_settings_tinymceCustomDirectory', $font_directory);
			if ($urlBasename == 'admin.php?page=TS_VCSC_Uploader') {
				add_filter('upload_dir', array($this, 'TS_VCSC_SetUploadDirectory'));
			}
		}
		// Register Custom Pack already installed error
		function TS_VCSC_CustomPackInstalledError(){
			if ((ini_get('allow_url_fopen') == '1') || (TS_VCSC_cURLcheckBasicFunctions() == true)) {
				$RemoteFileAccess 	= true;
			} else {
				$RemoteFileAccess 	= false;
			}
			$actual_link 			= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$actual_link 			= explode('/', $actual_link);
			$urlBasename 			= array_pop($actual_link);
			if ($urlBasename == 'admin.php?page=TS_VCSC_Uploader' ) {
				$dest 				= wp_upload_dir();
				$dest_path 			= $dest['path'];
				// If a file exists display included icons
				if ((file_exists($dest_path.'/ts-vcsc-custom-pack.zip')) && ($RemoteFileAccess == true) && (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') != '')) {
					// Disable File Upload Field if custom font pack exists or system requirements are not met
					echo '<script>
						jQuery(document).ready(function() {
							jQuery(".ts-vcsc-custom-pack-preloader").hide();
							jQuery(".preview-icon-code-box").show();
							jQuery("#dropDownDownload").removeAttr("disabled");							
							jQuery("input#ts_vcsc_custom_pack_replace").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_replace_label").addClass("disabled");							
							jQuery("input#ts_vcsc_custom_pack_relative").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_relative_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_debug").attr("disabled", "disabled");							
							jQuery("#ts_vcsc_custom_pack_debug_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_nocurl").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_nocurl_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_user").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_user_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_password").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_password_label").addClass("disabled");							
							jQuery("#ts-custom-iconfont-import-file").attr("disabled", "disabled");
							jQuery("#ts-custom-iconfont-import-file").parent().addClass("ts-custom-iconfont-import-disabled");	
							jQuery("#ts_vcsc_import_font_submit").attr("disabled", "disabled");
						});
					</script>';
				} else if ($RemoteFileAccess == false) {
					TS_VCSC_ResetCustomFont();
					echo '<script>
						jQuery(document).ready(function() {
							jQuery(".ts-vcsc-custom-pack-preloader").hide();
							jQuery(".preview-icon-code-box").hide();
							jQuery("#ts-custom-iconfont-import-file").attr("disabled", "disabled");
							jQuery("#ts-custom-iconfont-import-file").parent().addClass("ts-custom-iconfont-import-disabled");
							jQuery("#uninstall-pack-button").attr("disabled", "disabled");
							jQuery("#dropDownDownload").attr("disabled", "disabled");
							jQuery("#ts_vcsc_import_font_submit").attr("disabled", "disabled");
							jQuery("input#ts_vcsc_custom_pack_replace").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_replace_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_relative").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_relative_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_debug").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_debug_label").addClass("disabled");							
							jQuery("input#ts_vcsc_custom_pack_nocurl").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_nocurl_label").addClass("disabled");							
							jQuery("input#ts_vcsc_custom_pack_user").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_user_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_password").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_password_label").addClass("disabled");							
							jQuery(".ts-vcsc-custom-pack-buttons").after("<div class=error><p class=fontPackUploadedError>Your system does not fulfill the requirements to import a custom font.</p></div>");
						});
					</script>';	
				}
				if (($RemoteFileAccess == true) && (file_exists( $dest_path.'/ts-vcsc-custom-pack.json' )) && (file_exists($dest_path.'/style.css')) && (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') != '')) {
					// Create Preview of Imported Icons
					$output = "";
					$output .= "<div id='ts-vcsc-extend-preview' class=''>";
						$output .="<div id='ts-vcsc-extend-preview-name'>Font Name: " . 		get_option('ts_vcsc_extend_settings_tinymceCustomName', 'Custom User Font') . "</div>";
						$output .="<div id='ts-vcsc-extend-preview-author'>Font Author: " . 	get_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 'Custom User') . "</div>";
						$output .="<div id='ts-vcsc-extend-preview-count'>Icon Count: " . 		get_option('ts_vcsc_extend_settings_tinymceCustomCount', 0) . "</div>";
						$output .="<div id='ts-vcsc-extend-preview-date'>Uploaded: " . 			get_option('ts_vcsc_extend_settings_tinymceCustomDate', '') . "</div>";
						$output .= "<div id='ts-vcsc-extend-preview-list' class=''>";
						$icon_counter = 0;
						foreach (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') as $key => $option ) {
							$font = explode('-', $key);
							$output .= "<div class='ts-vcsc-icon-preview ts-freewall-active' data-name='" . $key . "' data-code='" . $option . "' data-font='Custom' data-count='" . $icon_counter . "' rel='" . $key . "'><span class='ts-vcsc-icon-preview-icon'><i class='" . $key . "'></i></span><span class='ts-vcsc-icon-preview-name'>" . $key . "</span></div>";
							$icon_counter = $icon_counter + 1;
						}
						$output .= "</div>";
					$output .= "</div>";
					echo '<script>
						jQuery(document).ready(function() {
							jQuery("#current-font-pack-preview").html("' . $output. '");
						});
					</script>';
				} else if ((file_exists($dest_path.'/ts-vcsc-custom-pack.zip')) && ($RemoteFileAccess == true) && ($this->TS_VCSC_UseCustomIconFontUpload == "false") && (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') == '')) {
					TS_VCSC_ResetCustomFont();
					echo '<script>
						jQuery(document).ready(function() {
							jQuery("#ts-custom-iconfont-import-file").attr("disabled", "disabled");
							jQuery("#ts-custom-iconfont-import-file").parent().addClass("ts-custom-iconfont-import-disabled");
							jQuery("#ts_vcsc_import_font_submit").attr("disabled", "disabled");							
							jQuery("input#ts_vcsc_custom_pack_replace").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_replace_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_relative").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_relative_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_debug").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_debug_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_nocurl").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_nocurl_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_user").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_user_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_password").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_password_label").addClass("disabled");	
							jQuery(".ts-vcsc-custom-pack-preloader").hide();
							jQuery(".preview-icon-code-box").hide();
							jQuery("#ts-custom-iconfont-import-file").attr("disabled", "disabled");
							jQuery("#ts-custom-iconfont-import-file").parent().addClass("ts-custom-iconfont-import-disabled");
							jQuery("#uninstall-pack-button").removeAttr("disabled").addClass("uninstallnow");
							jQuery("#dropDownDownload").attr("disabled", "disabled");
							jQuery(".ts-vcsc-custom-pack-buttons").after("<div class=error><p class=fontPackUploadedError>Hi there, something went wrong during your last font import. Please uninstall the current font package and try importing again (with a valid font package).</p></div>");
						});
					</script>';
				} else {
					TS_VCSC_ResetCustomFont();
					echo '<script>
						jQuery(document).ready(function() {
							jQuery(".ts-vcsc-custom-pack-preloader").hide();
							jQuery(".preview-icon-code-box").hide();
							jQuery("#uninstall-pack-button").attr("disabled", "disabled");
							jQuery("#ts-custom-iconfont-import-file").removeAttr("disabled");
							jQuery("#ts-custom-iconfont-import-file").parent().removeClass("ts-custom-iconfont-import-disabled");
							jQuery("#dropDownDownload").attr("disabled", "disabled");
							jQuery("input#ts_vcsc_custom_pack_replace").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_replace_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_relative").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_relative_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_debug").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_debug_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_nocurl").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_nocurl_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_user").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_user_label").addClass("disabled");
							jQuery("input#ts_vcsc_custom_pack_password").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_password_label").addClass("disabled");	
						});
					</script>';
				}
			}	
		}
		// Function that handles the AJAX request of Deleting Files
		function TS_VCSC_DeleteCustomPack_Ajax() {
			$dest 								= wp_upload_dir();
			$dest_path 							= $dest['path'];	
			$this_year 							= date('Y');
			$this_month 						= date('m');
			$the_date_string 					= $this_year . '/' . $this_month.'/';
			$customFontPackPath 				= $dest_path . '/ts-vcsc-icons/custom-pack/';
			$newCustomFontPackPath 				= str_replace($the_date_string, '', $customFontPackPath);
			$fileName 							= 'ts-vcsc-custom-pack.zip';
			$deleteZip 							= TS_VCSC_RemoveDirectory($newCustomFontPackPath, false);
			TS_VCSC_RemoveDirectory($newCustomFontPackPath, false);
			TS_VCSC_ResetCustomFont();
			$this->TS_VCSC_tinymceCustomCount 	= 0;
			$this->TS_VCSC_Icons_Custom 		= array();
		}
		// Function that handles the AJAX request of appending List of Posts/Pages
		function TS_VCSC_GetPostsPages_Ajax() {
			//if (check_ajax_referer('vc-admin-nonce', $_GET['_vcnonce'])) {
			if (vc_verify_admin_nonce($_GET['_vcnonce'])) {
				$selector 						= $_GET['selector'];
				$loadcount						= $_GET['loadcount'];
				$offset							= $_GET['offset'];
				$orderby						= $_GET['orderby'];
				$order							= $_GET['order'];
				// Page Selector
				if ($selector == "page") {
					$availablePages				= TS_VCSC_GetPostOptions(array('post_type' => 'page', 'posts_per_page' => $loadcount, 'offset' => $offset, 'orderby' => $orderby, 'order' => $order), false);
					$output						= '';
					foreach ($availablePages as $page) {
						$output .= '<li class="" data-link="' . $page['link'] . '" data-name="' . $page['name'] . '" data-id="' . $page['value'] . '" value="' . $page['value'] . '">' . $page['name'] . ' (' . $page['value'] . ')</li>';
					}
				}
				// Post Selector
				if ($selector == "post") {
					$availablePosts				= TS_VCSC_GetPostOptions(array('post_type' => 'post', 'posts_per_page' => $loadcount, 'offset' => $offset, 'orderby' => $orderby, 'order' => $order), false);
					$output						= '';
					foreach ($availablePosts as $post) {
						$output .= '<li class="" data-link="' . $post['link'] . '" data-name="' . $post['name'] . '" data-id="' . $post['value'] . '" value="' . $post['value'] . '">' . $post['name'] . ' (' . $post['value'] . ')</li>';
					}
				}
				// Custom Selector
				if ($selector == "custom") {
					// Get Custom Post Types
					$args = array(
					   'public'                 => true,
					   'publicly_queryable'     => true,
					   'exclude_from_search'    => false,
					   '_builtin'               => false
					);
					$availableTypes     = get_post_types($args, 'names', 'and');
					$availableCustom    = array();
					$availableRequest   = array();
					if (count($availableTypes) > 0) {
						foreach ($availableTypes as $type) {
							$totalCustom        = $totalCustom + wp_count_posts($type)->publish;
							$availableRequest   = TS_VCSC_GetPostOptions(array('post_type' => $type, 'posts_per_page' => $loadcount, 'offset' => $offset, 'orderby' => $orderby, 'order' => $order), false);
							$availableCustom    = array_merge($availableCustom, $availableRequest);
						}
						foreach ($availableCustom as $custom) {
							$output .= '<li class="" data-link="' . $post['link'] . '" data-name="' . $custom['name'] . '" data-id="' . $custom['value'] . '" value="' . $custom['value'] . '">' . $post['type'] . ' - ' . $custom['name'] . ' (' . $custom['value'] . ')</li>';
						}
					}
				}
				unset($availablePages);
				unset($availablePosts);
				unset($availableTypes);
				unset($availableCustom);
				unset($availableRequest);
				echo $output;
			}
			die();
		}
		// Function to Download System Information
		function TS_VCSC_DownloadSystemInfoData() {
            if (!isset($_GET['secret']) || $_GET['secret'] != md5( md5( AUTH_KEY . SECURE_AUTH_KEY ) . '-' . 'ts-vcsc-extend') ) {
                wp_die( 'Invalid Secret for options use' );
                exit;
            }			
			$content 	= get_option('ts_vcsc_extend_settings_systemInfo', '');
			$siteturl	= site_url();
			$find_h 	= '#^http(s)?://#';
			$find_w 	= '/^www\./';
			$siteturl 	= preg_replace($find_h, '', $siteturl);
			$siteturl 	= preg_replace($find_w, '', $siteturl);
			$siteturl 	= str_replace('/', '.', $siteturl);
			if (isset($_GET['action']) && $_GET['action'] == 'ts_system_download') {
				header( 'Content-Description: File Transfer' );
				header( 'Content-type: application/txt' );
				header( 'Content-Disposition: attachment; filename="' . $siteturl . '-systeminfo.txt"' );
				header( 'Content-Transfer-Encoding: binary' );
				header( 'Expires: 0' );
				header( 'Cache-Control: must-revalidate' );
				header( 'Pragma: public' );
				echo $content;
				/*echo '<script>';
					echo 'window.location="' . $_SERVER['REQUEST_URI'] . '";';
				echo '</script>';*/
				//Header('Location: '.$_SERVER['REQUEST_URI']);
				Exit();
			} else {
				header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
				header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
				header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
				header( 'Cache-Control: no-store, no-cache, must-revalidate' );
				header( 'Cache-Control: post-check=0, pre-check=0', false );
				header( 'Pragma: no-cache' );
				// Can't include the type. Thanks old Firefox and IE. BAH.
				//header("Content-type: application/json");
				echo $content;
				/*echo '<script>';
					echo 'window.location="' . $_SERVER['REQUEST_URI'] . '";';
				echo '</script>';*/
				//Header('Location: '.$_SERVER['REQUEST_URI']);
				Exit();
			}
		}
		// Function to Export Plugin Settings
		function TS_VCSC_ExportPluginSettings() {
            if (!isset($_GET['secret']) || $_GET['secret'] != md5( md5( AUTH_KEY . SECURE_AUTH_KEY ) . '-' . 'ts-vcsc-extend') ) {
                wp_die( 'Invalid Secret for options use' );
                exit;
            }			
			$content 	= get_option('ts_vcsc_extend_settings_exportSettings', '');
			$siteturl	= site_url();
			$find_h 	= '#^http(s)?://#';
			$find_w 	= '/^www\./';
			$siteturl 	= preg_replace($find_h, '', $siteturl);
			$siteturl 	= preg_replace($find_w, '', $siteturl);
			$siteturl 	= str_replace('/', '.', $siteturl);
			if (isset($_GET['action']) && $_GET['action'] == 'ts_export_settings') {
				header( 'Content-Description: File Transfer' );
				header( 'Content-type: application/txt' );
				header( 'Content-Disposition: attachment; filename="' . $siteturl . '-vcextensions-settings.json"' );
				header( 'Content-Transfer-Encoding: binary' );
				header( 'Expires: 0' );
				header( 'Cache-Control: must-revalidate' );
				header( 'Pragma: public' );
				echo $content;
				Exit();
			} else {
				header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
				header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
				header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
				header( 'Cache-Control: no-store, no-cache, must-revalidate' );
				header( 'Cache-Control: post-check=0, pre-check=0', false );
				header( 'Pragma: no-cache' );
				// Can't include the type. Thanks old Firefox and IE. BAH.
				//header("Content-type: application/json");
				echo $content;
				Exit();
			}
		}
		// Function to retrieve WooCommerce Version
		function TS_VCSC_WooCommerceVersion() {
			// If get_plugins() isn't available, require it
			if (!function_exists('get_plugins')) {
				require_once(ABSPATH . 'wp-admin/includes/plugin.php');
			}
			// Create the plugins folder and file variables
			$plugin_folder 	= get_plugins('/' . 'woocommerce');
			$plugin_file 	= 'woocommerce.php';
			// If the plugin version number is set, return it 
			if (isset($plugin_folder[$plugin_file]['Version'])) {
				return $plugin_folder[$plugin_file]['Version'];
			} else {
				return NULL;
			}
		}
		
		// Function to Check if AJAX Request Originates in Frontend
		function TS_VCSC_RequestIsFrontendAJAX() {
			$script_filename = isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME'] : '';		   
			// Try to figure out if frontend AJAX request... If we are DOING_AJAX; let's look closer
			if ((defined('DOING_AJAX') && DOING_AJAX)) {
				$ref = '';
				if (!empty($_REQUEST['_wp_http_referer'])) {
					$ref = wp_unslash( $_REQUEST['_wp_http_referer'] );
				} elseif (!empty($_SERVER['HTTP_REFERER'])) {
					$ref = wp_unslash( $_SERVER['HTTP_REFERER']);
				}		   
				// If referer does not contain admin URL and we are using the admin-ajax.php endpoint, this is likely a frontend AJAX request
				if (((strpos($ref, admin_url()) === false) && (basename($script_filename) === 'admin-ajax.php'))) {
					return true;
				}
			}
			// If no checks triggered, we end up here - not an AJAX request.
			return false;
		}
	}
}
global $VISUAL_COMPOSER_EXTENSIONS;
if (class_exists('VISUAL_COMPOSER_EXTENSIONS') && !$VISUAL_COMPOSER_EXTENSIONS) {
	$VISUAL_COMPOSER_EXTENSIONS = new VISUAL_COMPOSER_EXTENSIONS;
}
?>