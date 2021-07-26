<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://pressapps.co
 * @since      1.0.0
 *
 * @package    Pressapps_Login_Access
 * @subpackage Pressapps_Login_Access/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pressapps_Login_Access
 * @subpackage Pressapps_Login_Access/public
 * @author     PressApps
 */
class Pressapps_Login_Access_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Skelet instance
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $skelet instance of the Skelet Class
	 */
	private $skelet;

	/**
	 * Pressapps_Login_Access_Helper instance
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $helper instance of the Pressapps_Login_Access_Helper Class
	 */
	private $helper;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	public function get_skelet(  ) {
		return $GLOBALS['palo_skelet'];
	}

	public function get_helper(  ) {
		return Pressapps_Login_Access_Helper::getInstance();
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		global $skelet_path;

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pressapps-login-access-public.css', array(), $this->version, 'all' );
		wp_register_style( 'sk-icons', $skelet_path["uri"] .'/assets/css/sk-icons.css', array(), '1.0.0', 'all' );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pressapps-login-access-public.js', array( 'jquery' ), $this->version, true );

		wp_localize_script( $this->plugin_name, 'PALO_Public', array(
			'ajaxurl'   => admin_url( 'admin-ajax.php' ),
			'modal'     => $this->get_skelet()->get( 'modal_option' ),
			'effect'    => $this->get_skelet()->get( 'modal_effect' ),
			'load_text' => __( 'Processing', 'presssapps-login-access' ),
			'recaptcha' => $this->get_skelet()->get( 'enable_google_recaptcha' ),
			'sitekey'   => $this->get_skelet()->get( 'recaptcha_sitekey' )
		) );
	}

	/**
	 * Add inline styles in header, set in options settings
	 *
	 * @return callback custom css
	 *
	 */
	public function dynamic_styles() {
		$login_custom_css_code = $this->get_skelet()->get( 'custom_css_front_end' );
		$css                   = '';

		/**
		 * Build the CSS for the modal window
		 */
		// Modal forms
		$background_color        = $this->get_skelet()->get( 'ml_background_color' );
		$form_background_color   = $this->get_skelet()->get( 'ml_form_background_color' );
		$text_color              = $this->get_skelet()->get( 'ml_text_color' );
		$link_color              = $this->get_skelet()->get( 'ml_links_color' );
		$button_color            = $this->get_skelet()->get( 'ml_button_text_color' );
		$button_background_color = $this->get_skelet()->get( 'ml_button_background_color' );
		$ml_input_border_radius		= $this->get_skelet()->get( 'ml_input_border_radius' );
		/**
		 * Modal form
		 */
		// Merge form with background
		//$css .= '.palo-modal-form form { box-shadow: none; padding: 10px 40px!important; } ';

		if ( $background_color ) {
			$css .= '#palo-modal-wrapper { background-color: ' . $background_color . '; } ';
		}
		if ( $text_color ) {
			$css .= '.palo-modal-form label, .palo-modal-form > form > p, .palo-modal-form #reg_passmail, .palo-modal-form div.updated, .palo-modal-form .message, .palo-modal-form div.error, .palo-modal-close, .palo-modal-close:hover, .palo-modal-form .palo-terms-condition a, .palo-modal-form .palo-terms-condition a:hover, .palo-modal-form .palo-form-title, .palo-form-links, .palo-form-links a, .palo-form-links a:hover { color: ' . $text_color . '; } ';
		}
		/*
		if ( $link_color ) {
			$css .= '#nav { color: ' . sprintf( 'rgba(%s, %s)', $this->get_helper()->hex2rgb( $link_color ), .25 ) . '; } ';
			$css .= '.palo-modal-form > h1 > a, .palo-modal-form > h1 > a:hover, .palo-modal-form #backtoblog a, .palo-modal-form #backtoblog a:hover, .palo-modal-form #nav a, .palo-modal-form #nav a:hover, .palo-modal-form #nav, .palo-modal-form .palo-terms-condition a { color: ' . $link_color . ' !important } ';
			$css .= '.palo-modal-form > h1 > a, .palo-modal-form #backtoblog a, .palo-modal-form #nav a { opacity: 1; transition: opacity .5s ease; } .palo-modal-form #backtoblog a:hover, .palo-modal-form #nav a:hover { opacity: .5; } ';
		}
		*/
		if ( $button_color || $button_background_color ) {
			$css .= '#palo-modal-wrapper #wp-submit { ';
			if ( $button_color ) {
				$css .= 'color: ' . $button_color . '; ';
			}
			if ( $button_background_color ) {
				$css .= 'background: ' . $button_background_color . '; ';
			}
			$css .= '} ';
		}
		if ( $form_background_color ) {
			$css .= '#palo-modal-wrapper.palo-class-modal .palo-main-method-form { background-color: '. $form_background_color . '}';
		}
		// Border radius
		if ( $ml_input_border_radius ) {
			$css .= '.palo-modal-form input[type=text], .palo-modal-form input[type=email], .palo-modal-form input[type=password], .palo-modal-form input[type=submit], .palo-modal-form textarea, .palo-modal-form .palo_select { ';
			$css .= 'border-radius: ' . $ml_input_border_radius . 'px; ';
			$css .= '} ';
		}

		/**
		 * Embed form
		 */
		$em_input_border_width		= $this->get_skelet()->get( 'em_input_border_width' );
		$em_input_border_radius		= $this->get_skelet()->get( 'em_input_border_radius' );
		$em_button_color            = $this->get_skelet()->get( 'em_button_text_color' );
		$em_button_background_color = $this->get_skelet()->get( 'em_button_background_color' );
		$em_button_background_hover_color = $this->get_skelet()->get( 'em_button_background_hover_color' );
		$em_button_full_width		= $this->get_skelet()->get( 'em_button_full_width' );
		$em_input_border_bottom	= $this->get_skelet()->get( 'em_input_border_bottom' );
		$em_input_border_color		= $this->get_skelet()->get( 'em_input_border_color' );
		$em_input_border_focus_color= $this->get_skelet()->get( 'em_input_border_focus_color' );


		if ( $em_button_color || $em_button_background_color ) {
			$css .= '.palo-embed-form #wp-submit { ';
			if ( $em_button_color ) {
				$css .= 'color: ' . $em_button_color . '; ';
			}
			if ( $em_button_background_color ) {
				$css .= 'background: ' . $em_button_background_color . '; ';
				$css .= 'border: solid ' . $em_button_background_color . ' ' . $em_input_border_width . 'px; ';

			}
			$css .= '} ';
		}
		if ( $em_button_background_hover_color ) {
			$css .= '.palo-embed-form #wp-submit:hover { ';
			$css .= 'background: ' . $em_button_background_hover_color . '; ';
			$css .= 'border: solid ' . $em_button_background_hover_color . ' ' . $em_input_border_width . 'px; ';
			$css .= '} ';
		}
		if ( $em_button_full_width ) {
			$css .= '.palo-embed-form #wp-submit { float: none; width: 100%; } ';
		}

		// Border radius
		if ( $em_input_border_radius & $em_input_border_bottom ) {
			$css .= '.palo-embed-form input[type=submit], .palo-embed-form textarea, .palo-embed-form .palo_select { ';
			$css .= 'border-radius: ' . $em_input_border_radius . 'px; ';
			$css .= '} ';
		} else {
			$css .= '.palo-embed-form input[type=text], .palo-embed-form input[type=email], .palo-embed-form input[type=password], .palo-embed-form input[type=submit], .palo-embed-form textarea, .palo-embed-form .palo_select { ';
			$css .= 'border-radius: ' . $em_input_border_radius . 'px; ';
			$css .= '} ';
		}

		// Border focus color
		if ( $em_input_border_focus_color ) {
			$css .= '.palo-embed-form input[type=text]:focus, .palo-embed-form input[type=email]:focus, .palo-embed-form input[type=password]:focus, .palo-embed-form textarea:focus, .palo-embed-form .palo_select:focus { ';
			$css .= 'border-color: ' . $em_input_border_focus_color . '; ';
			$css .= '} ';
		}

		$css .= '.palo-embed-form input[type=text], .palo-embed-form input[type=email], .palo-embed-form input[type=password] { ';
		if ( $em_input_border_bottom ) {
			$css .= 'padding-left: 0!important; ';
			if ( $em_input_border_width ) {
				$css .= 'border-width: 0; border-bottom-width: ' . $em_input_border_width . 'px; ';
			}
		} else {
			if ( $em_input_border_width ) {
				$css .= 'border-width: ' . $em_input_border_width . 'px; ';
			}
		}
		if ( $em_input_border_color ) {
			$css .= 'border-color: ' . $em_input_border_color . '; ';
		}
		$css .= '} ';

		$css .= '.palo-embed-form textarea, .palo_select { ';
		if ( $em_input_border_color ) {
			$css .= 'border-color: ' . $em_input_border_color . '; ';
		}
		if ( $em_input_border_width ) {
			$css .= 'border-width: ' . $em_input_border_width . 'px; ';
		}
		$css .= '} ';

		$css .= '.palo-embed-form input:focus { ';
		if ( $em_input_border_bottom ) {
			$css .= 'padding-left: 0!important; ';
			if ( $em_input_border_width ) {
				$css .= 'border-width: 0; border-bottom-width: ' . $em_input_border_width . 'px; ';
			}
		} else {
			if ( $em_input_border_width ) {
				$css .= 'border-width: ' . $em_input_border_width . 'px; ';
			}
		}
		if ( $em_input_border_color ) {
			$css .= 'border-color: ' . $em_input_border_color . '; ';
		}
		$css .= '} ';

		/**
		 * Prepend custom code
		 */
		$css .= "\n" . $login_custom_css_code;
		$css = wp_strip_all_tags( $css );

		/**
		 * Output CSS
		 */
		wp_add_inline_style( $this->plugin_name, $css );
	}

	/**
	 * Registers all shortcodes at once
	 */
	public function register_shortcodes() {
		/**
		 * Form
		 */
		//login shortcode
		add_shortcode( 'palo_login', array( $this, 'display_login_form' ) );
		add_shortcode( 'pa_login', array( $this, 'display_login_form' ) ); //fallback for old shortcode

		//register shortcode
		add_shortcode( 'palo_register', array( $this, 'display_register_form' ) );
		add_shortcode( 'pa_register', array( $this, 'display_register_form' ) ); //fallback for old shortcode

		//forgotten shortcode
		add_shortcode( 'palo_forgotten', array( $this, 'display_resetpass_form' ) );
		add_shortcode( 'pa_forgotten', array( $this, 'display_resetpass_form' ) ); //fallback for old shortcode

		/**
		 * Modal
		 */
		//login modal shortcode
		add_shortcode( 'palo_modal_login', array( $this, 'modal_login_shortcode' ) );
		add_shortcode( 'pa_modal_login', array( $this, 'modal_login_shortcode' ) ); //fallback for old shortcode

		//register modal shortcode
		add_shortcode( 'palo_modal_register', array( $this, 'modal_register_shortcode' ) );
		add_shortcode( 'pa_modal_register', array( $this, 'modal_register_shortcode' ) ); //fallback for old shortcode
	}

	public function register_shortcode() {
		do_action( 'palo_display_form', 'register' );
	}

	public function forgotten_shortcode() {
		do_action( 'palo_display_form', 'resetpass' );
	}

	/**
	 * Callback for modal login shortcode
	 *
	 * @param $atts
	 *
	 * @return string
	 */
	public function modal_login_shortcode( $atts ) {
		$attributes = shortcode_atts( array(
			'login_text'  => __( 'Login', 'pressapps-login-access' ),
			'logout_text' => __( 'Logout', 'pressapps-login-access' )
		), $atts );

		if ( is_user_logged_in() ) {
			return '<a href="' . esc_url( wp_logout_url() ) . '" class="palo-link-style palo-modal-logout">' . esc_html( $attributes['logout_text'] ) . '</a>';
		} else {
			return '<a href="javascript:void(0)" data-form="login" class="palo-link-style palo-modal-link palo-modal-open">' . esc_html( $attributes['login_text'] ) . '</a>';
		}

	}

	/**
	 * Callback for modal register shortcode
	 *
	 * @param $atts
	 *
	 * @return string
	 */
	public function modal_register_shortcode( $atts ) {
		$attributes = shortcode_atts( array(
			'register_text'   => __( 'Register', 'pressapps-login-access' ),
			'registered_text' => __( 'You are already registered', 'pressapps-login-access' )
		), $atts );

		if ( is_user_logged_in() ) {
			return '<a href="javascript:void(0)" class="palo-link-style">' . esc_html( $attributes['registered_text'] ) . '</a>';
		} else {
			return '<a href="javascript:void(0)" data-form="register" class="palo-link-style palo-modal-link palo-modal-open">' . esc_html( $attributes['register_text'] ) . '</a>';
		}

	}

	/**
	 * Redirect function that is hook on template_redirect
	 *
	 */
	public function user_access_control() {
		$current_user       = wp_get_current_user();
		$current_user_roles = is_user_logged_in() ? $current_user->roles : array( 'not_logged_in' );
		$role_based_access  = $this->get_skelet()->get( 'role_based_access' );

		//if user is not logged in and will redirect the user if role based access control is enabled
		if ( ! empty( $role_based_access ) ) {
			array_walk( $current_user_roles, array( $this, 'role_based_access' ) );
		}

	}



	/**
	 * Redirect user based on access that the admin granted
	 *
	 * @param $role
	 */
	public function role_based_access( $role ) {
		global $post;

		$role_based_access = $this->get_skelet()->get( 'role_based_access' );
		$current_post_type = isset( $post->post_type ) ? $post->post_type : null;


		if ( $role_based_access ) {


			foreach ( $role_based_access as $access_role ) {
				$user_roles       = isset( $access_role['palo_user_access_role'] ) ? $access_role['palo_user_access_role'] : array();
				$access_action    = isset( $access_role['palo_user_access_control']['user_access_action'] ) ? $access_role['palo_user_access_control']['user_access_action'] : '';
				$access_page      = isset( $access_role['palo_user_access_control']['user_access_page'] ) ? $access_role['palo_user_access_control']['user_access_page'] : array();
				$access_post      = isset( $access_role['palo_user_access_control']['user_access_post'] ) ? $access_role['palo_user_access_control']['user_access_post'] : array();
				$access_cpt       = isset( $access_role['palo_user_access_control']['user_access_cpt'] ) ? $access_role['palo_user_access_control']['user_access_cpt'] : array();
				$access_cat       = isset( $access_role['palo_user_access_control']['user_access_cat'] ) ? $access_role['palo_user_access_control']['user_access_cat'] : array();

				//redeclare variable
				$access_page      = ( is_array( $access_cpt ) && ! empty( $access_cpt ) ) ? array_merge( $access_page, $access_cpt ) : $access_page;
				$access_tax       = isset( $access_role['palo_user_access_control']['user_access_tax'] ) ? $access_role['palo_user_access_control']['user_access_tax'] : array();;
				$access_cat       = preg_grep( "/^(\d+)_cat$/", $access_cat );

				$tax_termid       = array_keys( $this->get_helper()->format_tax_list( $access_tax ) );
				$tax_taxonomy     = array_values( array_unique( $this->get_helper()->format_tax_list( $access_tax ) ) );
				$redirect         = isset( $access_role['palo_user_access_redirect'] ) ? $access_role['palo_user_access_redirect'] : '';
				$custom_redirect  = isset( $access_role['palo_user_access_custom_redirect'] ) && filter_var( $access_role['palo_user_access_custom_redirect'], FILTER_VALIDATE_URL ) ? $access_role['palo_user_access_custom_redirect'] : wp_login_url();
				$get_redirect_url = $redirect === 'custom_url' ? $custom_redirect : admin_url();
				$filtered_page    = array_filter( array_map( 'intval', $access_page ) );
				$filtered_post    = array_filter( array_map( 'intval', $access_post ) );
				$is_all_page      = in_array( 'all_page', (array) $access_page );
				$is_all_post      = in_array( 'all_post', (array) $access_post );
				$is_archive_post  = in_array( 'archive_post', (array) $access_post );
				$is_archive_cpt   = in_array( 'archive_' . $current_post_type, $access_page );

				/**
				 * List of Conditions for the Access Control
				 */

				//Page Conditions
				$is_blocked_page     = ( $access_action === 'authorize_except' ) && ( ( is_page( $filtered_page ) && ! empty( $filtered_page ) ) || $is_all_page );
				$is_not_allowed_page = ( $access_action === 'block_except' ) && ( ( ( ! is_page( $filtered_page ) && ! empty( $filtered_page ) ) || empty( $filtered_page ) ) && ! $is_all_page );

				//Post Conditions
				$is_blocked_post     = ( $access_action === 'authorize_except' ) && ( ( is_single( $filtered_post ) && ! empty( $filtered_post ) ) || $is_all_post );
				$is_not_allowed_post = ( $access_action === 'block_except' ) && ( ( ( ! is_single( $filtered_post ) && ! empty( $filtered_post ) ) || empty( $filtered_post ) ) && ! $is_all_post );

				//CPT Conditions
				$is_blocked_cpt     = ( $access_action === 'authorize_except' ) && ( ( is_single( $filtered_page ) && ! empty( $filtered_page ) ) );
				$is_not_allowed_cpt = ( $access_action === 'block_except' ) && ( ( ( ! is_single( $filtered_page ) && ! empty( $filtered_page ) ) || empty( $filtered_page ) ) );

				//Taxonomy Conditions
				$is_blocked_tax     = ( $access_action === 'authorize_except' ) && ( ( is_tax( $tax_taxonomy, array_map( 'intval', $tax_termid ) ) && ! empty( $access_tax ) ) || $is_all_page );
				$is_not_allowed_tax = ( $access_action === 'block_except' ) && ( ( ! is_tax( $tax_taxonomy, array_map( 'intval', $tax_termid ) ) && ! empty( $access_tax ) || empty( $access_tax ) ) && ! is_category() && ! $is_all_page && ! is_post_type_archive() );

				//Category Conditions
				$is_blocked_cat     = ( $access_action === 'authorize_except' ) && ( ( in_category( array_map( 'intval', $access_cat ) ) && ! empty( $access_cat ) ) || $is_all_post && ! is_tax() );
				$is_not_allowed_cat = ( $access_action === 'block_except' ) && ( ( ! in_category( array_map( 'intval', $access_cat ) ) && ! empty( $access_cat ) || empty( $access_cat ) ) && ! $is_all_post && ! is_tax() && ! is_post_type_archive() );

				//Archive Conditions
				$is_not_allowed_archive_page = ( $access_action === 'block_except' ) && ( ( ( ! is_post_type_archive() && ! is_archive() ) ) || ( ( ! is_post_type_archive() && ! is_tax() && ! is_category() && is_archive() ) ) );
				$is_blocked_archive_cpt      = ( $access_action === 'authorize_except' ) && ( is_post_type_archive() && $is_archive_cpt );
				$is_not_allowed_archive_cpt  = ( $access_action === 'block_except' ) && ( ( ! is_post_type_archive() && $is_archive_cpt ) || ( is_post_type_archive() && ! $is_archive_cpt ) );
				$is_blocked_archive_post     = ( $access_action === 'authorize_except' ) && ( is_home() && $is_archive_post );
				$is_not_allowed_archive_post = ( $access_action === 'block_except' ) && ( ( ! is_home() && $is_archive_post ) || ( is_home() && ! $is_archive_post ) );

				foreach ( $user_roles as $user_role ) {

					$is_redirect = false; //default

					switch ( true ) {
						case ( $current_post_type === 'page' && is_page() ):
							if ( ( $is_blocked_page || $is_not_allowed_page ) && $role !== $user_role ) {
								$is_redirect = true;
							}
							break;
						case ( $current_post_type === 'post' && is_single() ):

							$is_not_allowed_post = ( ( has_category( array_map( 'intval', $access_cat ) ) && ! empty( $access_cat ) ) && $is_not_allowed_post !== true ) || ( ( has_category( array_map( 'intval', $access_cat ) ) && ! empty( $access_cat ) ) === false && $is_not_allowed_post );

							if ( ( $is_blocked_post || $is_not_allowed_post ) && $role !== $user_role ) {
								$is_redirect = true;
							}
							break;
						case is_singular( $current_post_type ):
							$is_not_allowed_cpt = ( ( has_term( $tax_termid, $tax_taxonomy ) && ! empty( $tax_termid ) ) && $is_not_allowed_cpt !== true ) || ( ( has_term( $tax_termid, $tax_taxonomy ) && ! empty( $tax_termid ) ) === false && $is_not_allowed_cpt );

							if ( ( $is_blocked_cpt || $is_not_allowed_cpt ) && $role !== $user_role ) {
								$is_redirect = true;
							}
							break;
						case ( is_post_type_archive() && $is_archive_cpt ):
			
							if ( $is_blocked_archive_cpt && $role !== $user_role ) {
								$is_redirect = true;
							}
							break;
						case ( is_home() && $is_archive_post ):

							if ( $is_blocked_archive_post && ( $role !== $user_role ) ) {
								$is_redirect = true;
							}
							break;
						case ( is_tax() && $access_action === 'authorize_except' ):
							if ( $is_blocked_tax && ( $role !== $user_role ) ) {
								$is_redirect = true;
							}
							break;
						case ( is_category() && $access_action === 'authorize_except' ):
							if ( $is_blocked_cat && ( $role !== $user_role ) ) {
								$is_redirect = true;
							}
							break;
						default:

							if ( ( $is_not_allowed_archive_page || $is_not_allowed_archive_cpt || $is_not_allowed_archive_post || $is_not_allowed_tax || $is_not_allowed_cat ) && ( $role !== $user_role ) ) {
								$is_redirect = true;
							}
							break;
					}

					//will check if the content has been blocked and will redirect the user
					if ( $is_redirect ) {
						wp_redirect( $get_redirect_url );
						exit;
					}
				}
			}
		}

	}

	/**
	 * Display the modal wrapper at the bottom of DOM
	 *
	 */
	public function display_modal_login() {
		$modal_class  = $this->get_skelet()->get( 'modal_option' ) === 'modal' || $this->get_skelet()->get( 'modal_option' ) === 'fullscreen' ? sprintf( 'class="%s %s palo-close"', esc_attr( 'palo-overlay-' . $this->get_skelet()->get( 'modal_effect' ) ), 'palo-class-' . $this->get_skelet()->get( 'modal_option' ) ) : '';
		$close_button = $this->get_skelet()->get( 'modal_option' ) === 'fullscreen' ? '<a class="palo-modal-close" href="#"><i class="si-delete"></i></a>' : '';
		$form_html = '';
		foreach ( array( 'login', 'register', 'resetpass' ) as $form ) {
			$form_html .= str_replace( 'id="'.$form.'"', 'id="modal-'.$form.'"', $this->display_modal_form( $form ) );
		}
		$html = ( $this->get_skelet()->get( 'modal_effect' ) === 'hugeinc' ? sprintf( '<nav><ul><li id="palo-modal-inner">%s</li></ul></nav>', $form_html ) : sprintf( '<div id="palo-modal-inner">%s</div>', $form_html ) );

		printf( '<div id="palo-modal-wrapper" %s>%s%s</div>', $modal_class, $close_button, $html );

		wp_enqueue_style( 'sk-icons' );
	}

	/**
	 * Modal form HTML
	 *
	 * @param string $form_type
	 *
	 * @return string HTML Content
	 */
	public function display_modal_form( $form_type = '' ) {
		$modal_form         = '';

		switch ( $form_type ) {
			case 'login':
				$modal_form .=
					'<div id="palo-login" class="palo-modal-form" style="display: none;">';
				//Will display the login form
				$modal_form .= apply_filters( 'palo_display_form', $form_html = '', 'login', true );
				$modal_form .= '</div>';
				break;
			case 'register':
				$modal_form .=
					'<div id="palo-register" class="palo-modal-form" style="display: none;">';
				//Will display the registration form
				$modal_form .= apply_filters( 'palo_display_form', $form_html = '', 'register', true );
				$modal_form .= '</div>';
				break;
			case 'resetpass':
				$modal_form .=
					'<div id="palo-resetpass" class="palo-modal-form" style="display: none;">';
				//Will display the registration form
				$modal_form .= apply_filters( 'palo_display_form', $form_html = '', 'resetpass', true );
				$modal_form .= '</div>';
				break;
		}

		return $modal_form;
	}


	/**
	 * Display form filter hook
	 *
	 * @param      $form_html
	 * @param      $form
	 *
	 * @param bool $display_close
	 *
	 *
	 * @param bool $embedded
	 *
	 * @return string
	 */
	public function display_form( $form_html, $form, $display_close = true, $embedded = false ) {
		$form_class = $embedded ? 'palo-main-method-form palo-embed-form' : 'palo-main-method-form';
		$em_placeholder	= $this->get_skelet()->get( 'em_placeholder' );
		$login_header_title = apply_filters( 'login_headertitle', $login_header_title = '' );

		$label_login 	= __( "Login", 'pressapps-login-access' );
		$label_forgot 	= __( "Forgot password?", 'pressapps-login-access' );
		$label_register = __( "Register", 'pressapps-login-access' );

		switch( $form ) {

			case 'login':
				$form_html .= '<form name="palo-loginform" class="'.$form_class.'" action="palo_login" method="post">';
				if ( $this->get_skelet()->get( 'modal_option' ) === 'modal' && $display_close ){
					$form_html .= '<a class="palo-modal-close" href="#"><i class="si-delete"></i></a>';
				}
				$form_html .= '
					<h2 class="palo-form-title">' . __( 'Login', 'pressapps-login-access' ) . '</h2>
					<p>
						<label for="user_login">' . ( !$em_placeholder ? __( 'Username', 'pressapps-login-access' ) . '<br>' : '' ) . '
							<input type="text" name="log" id="user_login" class="input" value="" size="20" ' . ( $em_placeholder ? 'placeholder="' . __( 'Username', 'pressapps-login-access' ) . '"' : '' ) . '">
						</label>
					</p>

					<p>
						<label for="user_pass">' . ( !$em_placeholder ? __( 'Password', 'pressapps-login-access' ) . '<br>' : '' ) . '
							<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" ' . ( $em_placeholder ? 'placeholder="' . __( 'Password', 'pressapps-login-access' ) . '"' : '' ) . '">
						</label>
					</p>';
				$form_html .= apply_filters( 'palo_login_form', $login_field = '' );
				$form_html .= '
					<p class="forgetmenot">
						<label for="rememberme">
							<input name="rememberme" type="checkbox" id="rememberme" class="checkbox" value="forever"> ' . __( 'Remember Me', 'pressapps-login-access' ) . '
						</label>
					</p>

					<p class="submit">
						<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="' . esc_attr( 'Log In', 'pressapps-login-access' ) . '">
						' . wp_nonce_field( 'palo-login', 'palo-login-nonce', true, false ) . '
					</p>
					<p class="palo-form-links"><a href="#" data-form="forgot" class="palo-forgot-form-link">' . esc_html( $label_forgot ) . '</a>' . ( get_option( 'users_can_register' ) ? ' | <a href="#" data-form="register" class="palo-register-form-link"> ' . esc_html( $label_register ) . '</a>' : '' ) . '</p>
					</form>';
				break;

			case 'register':
				$form_html = '<form name="palo-registerform" class="'.$form_class.'" action="palo_register" method="post" novalidate="novalidate">';
				if ( $this->get_skelet()->get( 'modal_option' ) === 'modal' && $display_close ){
					$form_html .= '<a class="palo-modal-close" href="#"><i class="si-delete"></i></a>';
				}
				$form_html .= '
					<h2 class="palo-form-title">' . __( 'Register', 'pressapps-login-access' ) . '</h2>
					<p>
						<label for="user_login">' . ( !$em_placeholder ? __( 'Username', 'pressapps-login-access' ) . '<br>' : '' ) . '
							<input type="text" name="user_login" id="user_login" class="input" value="" size="20" ' . ( $em_placeholder ? 'placeholder="' . __( 'Username', 'pressapps-login-access' ) . '"' : '' ) . '/>
						</label>
					</p>

					<p>
						<label for="user_email">' . ( !$em_placeholder ? __( 'Email', 'pressapps-login-access' ) . '<br>' : '' ) . '
							<input type="email" name="user_email" id="user_email" class="input" value="" size="25" ' . ( $em_placeholder ? 'placeholder="' . __( 'Email', 'pressapps-login-access' ) . '"' : '' ) . '/>
						</label>
					</p>';
				$form_html .= apply_filters( 'palo_register_form', $login_field = '' );
				$form_html .= '
					<p id="reg_passmail">'.__( 'Registration confirmation will be emailed to you.', 'pressapps-login-access' ).'</p>
					<p class="submit">
						<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary"
						       value="'.esc_attr__( 'Register', 'pressapps-login-access' ).'"/>
		            ' . wp_nonce_field( 'palo-register', 'palo-register-nonce' ) . '
					</p>
					<p class="palo-form-links"><a href="#" data-form="login" class="palo-login-form-link"> ' . esc_html( $label_login ) . '</a> | <a href="#" data-form="forgot" class="palo-forgot-form-link">' . esc_html( $label_forgot ) . '</a></p>
				</form>';
				break;
			case 'resetpass':
				$form_html = '<form name="palo-lostpasswordform" class="'.$form_class.'" action="palo_resetpass" method="post">';
				if ( $this->get_skelet()->get( 'modal_option' ) === 'modal' && $display_close ){
					$form_html .= '<a class="palo-modal-close" href="#"><i class="si-delete"></i></a>';
				}

				$form_html .= '
					<h2 class="palo-form-title">' . __( 'Reset Password', 'pressapps-login-access' ) . '</h2>
					<p class="message">' . apply_filters( 'palo_modal_resetpass_header', __( 'Please enter your username or email address. You will receive a link to create a new password via email.', 'pressapps-login-access' ) ) . '</p>
					<p>
						<label for="user_login">'.__( 'Username or Email:', 'pressapps-login-access' ).'<br>
							<input type="text" name="user_login" id="user_login" class="input" value="" size="20">
						</label>
					</p>';
				$form_html .= apply_filters( 'palo_lostpassword_form', $lostpassword_field = '' );
				$form_html .= '
					<p class="submit">
						<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary"
						       value="'.esc_attr__( 'Get New Password', 'pressapps-login-access' ).'"/>
						' . wp_nonce_field( 'palo-resetpass', 'palo-resetpass-nonce' ) . '
					</p>
					<p class="palo-form-links"><a href="#" data-form="login" class="palo-login-form-link"> ' . esc_html( $label_login ) . '</a></p>
				</form>';
				break;
		}


		return $form_html;
	}

	/**
	 * Login form shortcode
	 *
	 * @return mixed|void
	 */
	public function display_login_form(  ) {
		return apply_filters( 'palo_display_form', $form_html = '', 'login', false, true );
	}

	/**
	 * Register form shortcode
	 *
	 * @return mixed|void
	 */
	public function display_register_form(  ) {
		if ( intval( get_option( 'users_can_register' ) ) ) {
			return apply_filters( 'palo_display_form', $form_html = '', 'register', false, true );
		} else {
			return __( 'Please allow membership on the site.', 'pressapps-login-access' );
		}

	}

	/**
	 * Reset Password form shortcode
	 *
	 * @return mixed|void
	 */
	public function display_resetpass_form(  ) {
		return apply_filters( 'palo_display_form', $form_html = '', 'resetpass', false, true );
	}


	/**
	 * Login ajax request
	 *
	 */
	public function login_modal() {

		check_ajax_referer( 'palo-login', 'palo-login-nonce' );

		$creds['user_login']    = sanitize_user( $_POST['log'] );
		$creds['user_password'] = $_POST['pwd'];
		$creds['remember']      = $_POST['rememberme'];

		$user = wp_signon( $creds, is_ssl() );

		if ( is_wp_error( $user ) ) {
			echo json_encode( array(
				'status'  => false,
				'message' => sprintf( __( '%s', 'pressapps-login-access' ), $user->get_error_message() ),
			) );
		} else {
			echo json_encode( array(
				'status'   => true,
				'redirect' => apply_filters( 'login_redirect', $redirect_to = admin_url(), $request = '', $user )
			) );
		}

		wp_die();
	}

	/**
	 * Registration ajax request
	 *
	 */
	public function register_modal() {

		check_ajax_referer( 'palo-register', 'palo-register-nonce' );

		$user_login                  = sanitize_user( $_POST['user_login'] );
		$user_email                  = sanitize_email( $_POST['user_email'] );
		$registration                = register_new_user( $user_login, $user_email );
		$user_set_password           = $this->get_skelet()->get( 'users_set_password' );
		$login_after_registration    = $this->get_skelet()->get( 'login_user_after_registration' );
		$redirect_after_registration = $this->get_skelet()->get( 'redirect_after_registration' );

		if ( is_wp_error( $registration ) ) {
			echo json_encode( array(
				'status'  => false,
				'message' => sprintf( __( '%s', 'pressapps-login-access' ), $registration->get_error_message() )
			) );
		} else {
			$user_data_by_id = get_user_by( 'id', intval( $registration ) );
			$user_roles      = $user_data_by_id->roles;

			if ( ! in_array( 'administrator', $user_roles ) ) {
				//will redirect after registration
				$redirect        = filter_var( $redirect_after_registration, FILTER_VALIDATE_URL ) ? esc_url_raw( $redirect_after_registration ) : '';
				$redirect        = ( $user_set_password && $login_after_registration && $redirect === '' ) ? admin_url() : $redirect;
			} else {
				$redirect = admin_url();
			}

			echo json_encode( array(
				'status'   => true,
				'message'  => __( 'Registration Successful!', 'pressapps-login-access' ),
				'redirect' => ( $redirect !== '' ? $redirect : false )
			) );
		}

		wp_die();
	}

	/**
	 * Reset Password ajax request
	 *
	 */
	public function resetpass_modal() {

		check_ajax_referer( 'palo-resetpass', 'palo-resetpass-nonce' );

		$resetpass = retrieve_password();

		if ( is_wp_error( $resetpass ) ) {
			echo json_encode( array(
				'status'  => false,
				'message' => sprintf( __( '%s', 'pressapps-login-access' ), $resetpass->get_error_message() )
			) );
		} else {
			echo json_encode( array(
				'status'  => true,
				'message' => __( 'Password reset has been sent to your email!', 'pressapps-login-access' )
			) );
		}

		wp_die();
	}

	/**
	 * Saved data on registration in frontend
	 *
	 * @param $user_id
	 */
	public function custom_field_registration( $user_id ) {
		$this->get_helper()->custom_fields_for( 'add', $user_id );

		//will remove password nag when user set password has been set in dashboard
		if ( $this->get_skelet()->get( 'users_set_password' ) ) {
			update_user_option( $user_id, 'default_password_nag', false, false );
		}

	}

	/**
	 * Change the frontend label of the links generated by wp_nav_menu
	 *
	 * @param $items
	 *
	 * @return mixed
	 */
	public function frontend_modal_link_label( $items ) {

		foreach ( $items as $i => $item ) {
			if ( '#palo_modal_login' === $item->url ) {
				$item_parts = explode( ' // ', $item->title );
				if ( is_user_logged_in() ) {
					$items[ $i ]->title = array_pop( $item_parts );
				} else {
					$items[ $i ]->title = array_shift( $item_parts );
				}
			}
		}

		return $items;
	}

	/**
	 * Change the frontend attributes of the links generated by wp_nav_menu
	 *
	 * @param $atts
	 * @param $item
	 * @param $args
	 *
	 * @return mixed
	 */
	public function frontend_modal_link_atts( $atts, $item, $args ) {
		// Only apply when URL is #pafl_modal_login/#pafl_modal_register
		if ( '#palo_modal_login' === $atts['href'] ) {
			// Check if we have an over riding logout redirection set. Other wise, default to the home page.
			$logout_url = $this->get_skelet()->get( 'redirect_allow_after_logout_redirection_url' );

			if ( isset( $logout_url ) && $logout_url == '' ) {
				$logout_url = home_url();
			}

			// Is the user logged in? If so, serve them the logout button, else we'll show the login button.
			if ( is_user_logged_in() ) {
				$atts['href']  = wp_logout_url( $logout_url );
				$atts['class'] = 'palo-link-style palo-modal-logout';
			} else {
				$atts['href']      = 'javascript:void(0)';
				$atts['data-form'] = 'login';
				$atts['class']     = 'palo-link-style palo-modal-link palo-modal-open';
			}
		} else {
			if ( '#palo_modal_register' === $atts['href'] ) {
				$atts['href']      = 'javascript:void(0)';
				$atts['data-form'] = 'register';
				$atts['class']     = 'palo-link-style palo-modal-link palo-modal-open';
			}
		}

		return $atts;
	}

	/**
	 * Hide link if the user is already registered
	 *
	 * @param $items
	 *
	 * @return mixed
	 */
	public function frontend_modal_link_register_hide( $items ) {
		foreach ( $items as $i => $item ) {
			if ( '#palo_modal_register' === $item->url ) {
				if ( is_user_logged_in() ) {
					unset( $items[ $i ] );
				}
			}
		}

		return $items;
	}

}
