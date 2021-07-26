<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://pressapps.co
 * @since      1.0.0
 *
 * @package    Pressapps_Login_Access
 * @subpackage Pressapps_Login_Access/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Pressapps_Login_Access
 * @subpackage Pressapps_Login_Access/includes
 * @author     PressApps
 */
class Pressapps_Login_Access {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Pressapps_Login_Access_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'pressapps-login-access';
		$this->version     = '1.0.0';
		$this->set_global();
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Pressapps_Login_Access_Loader. Orchestrates the hooks of the plugin.
	 * - Pressapps_Login_Access_i18n. Defines internationalization functionality.
	 * - Pressapps_Login_Access_Admin. Defines all hooks for the admin area.
	 * - Pressapps_Login_Access_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pressapps-login-access-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pressapps-login-access-i18n.php';

		/**
		 * This file is responsible for the autoload function of
		 * composer.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/autoload.php';

		/**
		 * ReCaptcha Class
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pressapps-login-access-recaptcha.php';

		/**
		 * Social Login Class
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pressapps-login-access-social.php';

		/**
		 * Helper Class
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pressapps-login-access-helper.php';

		/**
		 * Pluggable functions
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/pressapps-login-access-pluggable.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-pressapps-login-access-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-pressapps-login-access-public.php';

		$this->loader = new Pressapps_Login_Access_Loader();

	}
	/**
	 * Define global variables
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_global(  ) {
		$GLOBALS['palo_skelet'] = new Skelet( 'palo' );
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Pressapps_Login_Access_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Pressapps_Login_Access_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Pressapps_Login_Access_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'plugin_row_meta', $plugin_admin, 'row_links', 10, 2 );
		$this->loader->add_action( 'plugin_action_links_' . $this->get_plugin_name() . "/" . $this->get_plugin_name() . ".php", $plugin_admin, 'settings_link' );

		//Login CSS
		$this->loader->add_action( 'login_enqueue_scripts', $plugin_admin, 'login_custom_scripts' );

		//Login scripts
		$this->loader->add_action( 'login_enqueue_scripts', $plugin_admin, 'login_enqueue_styles' );

		//Login Logo Link
		$this->loader->add_filter( 'login_headerurl', $plugin_admin, 'login_logo_link' );

		//Login Logo Title
		$this->loader->add_filter( 'login_headertitle', $plugin_admin, 'login_logo_title' );

		//Redirects user after login
		$this->loader->add_filter( 'login_redirect', $plugin_admin, 'redirect_after_login', 10, 3 );
		$this->loader->add_action( 'wp_logout', $plugin_admin, 'redirect_after_logout' );

		//Login page
		$this->loader->add_action( 'login_form', $plugin_admin, 'login_form' );
		$this->loader->add_filter( 'palo_login_form', $plugin_admin, 'login_form_filter' );

		//Registration page
		$this->loader->add_action( 'register_form', $plugin_admin, 'registration_form' );
		$this->loader->add_filter( 'palo_register_form', $plugin_admin, 'registration_form_filter' );

		$this->loader->add_action( 'registration_errors', $plugin_admin, 'registration_authentication', 10, 3 );
		$this->loader->add_action( 'user_register', $plugin_admin, 'callback_after_registration' );

		$this->loader->add_filter( 'gettext', $plugin_admin, 'remove_password_message_on_email' );
		$this->loader->add_filter( 'wp_mail', $plugin_admin, 'remove_slashes_on_email' );

		//Lost Password page
		$this->loader->add_action( 'lostpassword_form', $plugin_admin, 'lostpassword_form' );
		$this->loader->add_filter( 'palo_lostpassword_form', $plugin_admin, 'lostpassword_form_filter' );

		$this->loader->add_action( 'lostpassword_post', $plugin_admin, 'recaptcha_reset_die' );
		$this->loader->add_filter( 'login_errors', $plugin_admin, 'display_password_reset_error' );

		//Social login
		$this->loader->add_action( 'login_init', $plugin_admin, 'social_login_init' );

		//Social Avatar
		$this->loader->add_filter( 'get_avatar', $plugin_admin, 'social_avatar', 1, 2 );
		$this->loader->add_filter( 'show_password_fields', $plugin_admin, 'hide_password_for_social_account', 10, 2 );

		//User Admin Dashboard
		$this->loader->add_filter( 'manage_users_columns', $plugin_admin, 'add_user_approval_column' );
		$this->loader->add_action( 'manage_users_custom_column', $plugin_admin, 'user_status_column', 10, 3 );


		$this->loader->add_action( 'wp_ajax_user_approval_ajax', $plugin_admin, 'user_approval_ajax' );

		//Custom registration fields
		$this->loader->add_action( 'show_user_profile', $plugin_admin, 'custom_field_profile' );
		$this->loader->add_action( 'edit_user_profile', $plugin_admin, 'custom_field_profile' );

		//Update dashboard custom field profile entry
		$this->loader->add_action( 'personal_options_update', $plugin_admin, 'custom_field_update_profile' );
		$this->loader->add_action( 'edit_user_profile_update', $plugin_admin, 'custom_field_update_profile' );

		//Custom Nav Menu
		$this->loader->add_action( 'admin_init', $plugin_admin, 'custom_nav_menu' );

		//Admin Access Restriction
		$this->loader->add_action( 'admin_init', $plugin_admin, 'admin_access_control', 1 );

		//Load Data
		$this->loader->add_action( 'wp_loaded', $plugin_admin, 'load_data' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Pressapps_Login_Access_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'dynamic_styles' );
		$this->loader->add_action( 'init', $plugin_public, 'register_shortcodes' );

		//Page redirection
		$this->loader->add_action( 'template_redirect', $plugin_public, 'user_access_control' );


		//Attached html modal on the footer
		$this->loader->add_action( 'wp_footer', $plugin_public, 'display_modal_login' );

		//Ajax Modal Login
		$this->loader->add_action( 'wp_ajax_palo_login', $plugin_public, 'login_modal' );
		$this->loader->add_action( 'wp_ajax_nopriv_palo_login', $plugin_public, 'login_modal' );

		//Ajax Modal Register
		$this->loader->add_action( 'wp_ajax_palo_register', $plugin_public, 'register_modal' );
		$this->loader->add_action( 'wp_ajax_nopriv_palo_register', $plugin_public, 'register_modal' );

		//Ajax Modal Reset Password
		$this->loader->add_action( 'wp_ajax_palo_resetpass', $plugin_public, 'resetpass_modal' );
		$this->loader->add_action( 'wp_ajax_nopriv_palo_resetpass', $plugin_public, 'resetpass_modal' );

		//Modal Custom Fields Hook
		$this->loader->add_action( 'register_new_user', $plugin_public, 'custom_field_registration' );

		//Display Custom Form
		$this->loader->add_filter( 'palo_display_form', $plugin_public, 'display_form', 10, 4 );

		// Display right label for login/logout WP_Menu
		$this->loader->add_filter( 'wp_nav_menu_objects', $plugin_public, 'frontend_modal_link_label', 10, 1 );

		// Filter Menu attributes
		$this->loader->add_filter( 'nav_menu_link_attributes', $plugin_public, 'frontend_modal_link_atts', 10, 3 );

		// Hide Register from Menu when user is logged in
		$this->loader->add_filter( 'wp_nav_menu_objects', $plugin_public, 'frontend_modal_link_register_hide', 10, 1 );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Pressapps_Login_Access_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
