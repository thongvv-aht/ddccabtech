<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://pressapps.co
 * @since      1.0.0
 *
 * @package    Pressapps_Login_Access
 * @subpackage Pressapps_Login_Access/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pressapps_Login_Access
 * @subpackage Pressapps_Login_Access/admin
 * @author     PressApps
 */
class Pressapps_Login_Access_Admin {

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
	 * ReCaptcha instance
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $recaptcha instance of the ReCaptcha Class
	 */
	private $recaptcha;

	/**
	 * Pressapps_Login_Access_Social instance
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $social instance of the Pressapps_Login_Access_Social Class
	 */
	private $social;

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
	 * @param      string $plugin_name The name of this plugin.
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

	public function get_recaptcha(  ) {
		return Pressapps_Login_Access_ReCaptcha::getInstance();
	}

	public function get_social(  ) {
		return Pressapps_Login_Access_Social::getInstance();
	}


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pressapps-login-access-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pressapps-login-access-admin.js', array( 'jquery' ), $this->version, true );
		wp_localize_script( $this->plugin_name, 'PALO_Admin',
			array(
				'preload' => __( 'Loading...', 'pressapps-login-access' ),
				'approve' => __( 'Approve', 'pressapps-login-access' ),
				'disable' => __( 'Disable', 'pressapps-login-access' )
			)
		);

	}


	public function custom_nav_menu(  ) {
		// Add the modal link metabbox in the Edit Menus page
		add_meta_box('palo_metabox_modal_link', __('Login & Access Modal Link', 'pressapps-login-access' ), array( $this, 'metabox_modal_link' ), 'nav-menus', 'side', 'high');
	}

	public function metabox_modal_link(  ) {

		?>
		<div id="posttype-palo-modal-link" class="posttypediv">
			<div id="tabs-panel-palo-modal-link" class="tabs-panel tabs-panel-active">
				<ul id ="palo-modal-link-checklist" class="categorychecklist form-no-clear">
					<li>
						<label class="menu-item-title">
							<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> <?php _e('Login', 'pressapps-login-access' ); ?> / <?php _e('Logout', 'pressapps-login-access' ); ?>
						</label>
						<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
						<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="<?php _e('Login', 'pressapps-login-access' ); ?> // <?php _e('Logout', 'pressapps-login-access' ); ?>">
						<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="#palo_modal_login">
					</li>
					<li>
						<label class="menu-item-title">
							<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> <?php _e('Register', 'pressapps-login-access' ); ?>
						</label>
						<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
						<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="<?php _e('Register', 'pressapps-login-access' ); ?>">
						<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="#palo_modal_register">
					</li>
				</ul>
			</div>
			<p class="button-controls">
			<span class="add-to-menu">
				<input type="submit" class="button-secondary submit-add-to-menu right" value="<?php _e( 'Add to Menu', 'pressapps-login-access' ); ?>" name="add-post-type-menu-item" id="submit-posttype-palo-modal-link">
				<span class="spinner"></span>
			</span>
			</p>
		</div>
		<?php
	}


	/**
	 * Adds a link to the plugin settings page
	 */
	public function settings_link( $links ) {

		$settings_link = sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=' . $this->plugin_name ), __( 'Settings', 'pressapps-login-access' ) );

		array_unshift( $links, $settings_link );

		return $links;

	}

	/**
	 * Adds links to the plugin links row
	 */
	public function row_links( $links, $file ) {

		if ( strpos( $file, $this->plugin_name . '.php' ) !== false ) {

			$link = '<a href="https://codecanyon.net/item/custom-login-access-wordpresss-plugin/7874646/support" target="_blank">' . __( 'Help', 'pressapps-login-access' ) . '</a>';

			array_push( $links, $link );

		}

		return $links;

	}

	/**
	 * Custom scripts on the login page
	 */
	public function login_custom_scripts() {
		$background_video = $this->get_skelet()->get( 'lp_background_video' );
		$background_image = $this->get_skelet()->get( 'lp_background_image' );

		//custom login script
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pressapps-login-access-admin.js', array( 'jquery' ), $this->version, true );
		wp_localize_script( $this->plugin_name, 'PALO', compact( 'background_video', 'background_image' ) );
		echo '<link rel="stylesheet" id="login-css" href="' . esc_url( plugin_dir_url( __FILE__ ) . 'css/pressapps-login-access-admin.css' ) . '" type="text/css" media="all">';
	}

	/**
	 * Custom styles on the login page and modal login
	 */
	public function login_enqueue_styles() {
		$login_custom_css_code = $this->get_skelet()->get( 'custom_css_login_page' );
		$css                   = '';

		/**
		 * Build the CSS for the wp-login.php page in normal conditions
		 */

		$background_image        = $this->get_skelet()->get( 'lp_background_image' );
		$login_image             = $this->get_skelet()->get( 'lp_logo_image' );
		$form_background_color   = $this->get_skelet()->get( 'lp_form_background_color' );
		$background_color        = $this->get_skelet()->get( 'lp_background_color' );
		$text_color              = $this->get_skelet()->get( 'lp_text_color' );
		$link_color              = $this->get_skelet()->get( 'lp_links_color' );
		$button_color            = $this->get_skelet()->get( 'lp_button_text_color' );
		$button_background_color = $this->get_skelet()->get( 'lp_button_background_color' );
		$button_full_width 		 = $this->get_skelet()->get( 'lp_button_full_width' );
		$is_user_set_password    = $this->get_skelet()->get( 'users_set_password' );

		//registration
		if ( $is_user_set_password ) {
			$css .= '#reg_passmail { display: none !important; }';
		}

		//background color
		if ( $background_color ) {
			$css .= '#palo-login-background { background-color: ' . $background_color . '; }';
			$css .= 'body.login { background-color: transparent; position: relative;}';
		} else {
			$css .= 'body.login { background-color: transparent; }';
		}

		//background image
		if ( $background_image ) {
			$css .= 'html { ';
			if ( $background_image ) {
				$css .= 'background-repeat: no-repeat; ';
				$css .= 'background-position: center center; ';
				$css .= 'background-attachment: fixed; ';
				$css .= 'background-size: cover; ';
			}
			$css .= '} ';
		}

		//logo
		if ( $login_image ) {
			$css .= 'body.login #login { padding: 3% 0 0; }';
			$css .= '.login h1 a { display: block !important; background-image: url( "' . $login_image . '" ) !important; }';
		}

		//text color
		if ( $text_color ) {
			$css .= '.login label, #reg_passmail { color: ' . $text_color . '; } ';
		}

		//form background color
		if ( $form_background_color ) {
			$css .= 'body.login form { background: ' . $form_background_color . '; } ';
		}

		//link color
		if ( $link_color ) {
			$css .= '#nav{ color: ' . sprintf( 'rgba(%s, %s)', $this->get_helper()->hex2rgb( $link_color ), .25 ) . '; } ';
			$css .= '.login #backtoblog a, .login #backtoblog a:hover, .login #nav, .login #nav a:hover, .login #nav a, div.updated, .login .message, .login #login_error a, div.error, .login #login_error { color: ' . $link_color . '; } ';
			//	$css .= '.login #backtoblog a, .login #nav a { opacity: 1; transition: opacity .2s ease; } .login #backtoblog a:hover, .login #nav a:hover { opacity: .7; } ';
		}

		//button color or button background
		if ( $button_color || $button_background_color ) {
			$css .= '.login #wp-submit { ';
			if ( $button_color ) {
				$css .= 'color: ' . $button_color . '; ';
			}
			if ( $button_background_color ) {
				$css .= 'background: ' . $button_background_color . '; ';
			}
			$css .= '} ';
		}

		//full width button
		if ( $button_full_width ) {
			$css .= '.login #wp-submit { ';
			$css .= 'float: none; ';
			$css .= 'width: 100%; ';
			$css .= 'margin-top: 20px; ';
			$css .= '} ';
		}

		/**
		 * Prepend custom code
		 */
		$css .= "\n" . $login_custom_css_code;
		$css = wp_strip_all_tags( $css );
		/**
		 * Output CSS
		 */
		printf( '<style type="text/css">%s</style>%s', "\n$css\n", "\n" );
	}


	/**
	 * Redirect the logo to the homepage
	 *
	 * @return string|void
	 */
	public function login_logo_link() {
		return home_url();
	}

	/**
	 * Change the title to the name of the site instead of powered by wordpress
	 *
	 * @return string|void
	 */
	public function login_logo_title() {
		return get_bloginfo( 'name' );
	}

	/**
	 * Filter hook that redirects user after login
	 *
	 * @param $redirect_to
	 * @param $request
	 * @param $user
	 *
	 * @return array|string|void
	 */
	public function redirect_after_login( $redirect_to, $request, $user ) {

		$redirect_link = $this->get_helper()->redirect_after_login( $redirect_to, $user );

		return $redirect_link ? $redirect_link : $redirect_to;
	}

	/**
	 * Action hook that redirects user after logout
	 */
	public function redirect_after_logout() {
		$current_user    = wp_get_current_user();
		$redirect_option = $this->get_skelet()->get( 'redirect_after_logout' );
		$redirect_url    = filter_var( $redirect_option, FILTER_VALIDATE_URL ) ? esc_url_raw( $redirect_option ) : wp_login_url();

		if ( ! in_array( 'administrator', $current_user->roles ) ) {
			wp_redirect( $redirect_url );
			exit;
		}
	}

	/**
	 * Displays recaptcha on login page
	 *
	 *
	 * @return string
	 */
	public function login_form( ) {
		echo apply_filters( 'palo_login_form', $login_field = '' );
	}

	/**
	 *  Collection of all login_form hook before outputting
	 *
	 *
	 * @param $login_field
	 *
	 * @return mixed|void
	 */
	public function login_form_filter( $login_field ) {
		$login_field .= $this->get_social()->display_social_button();
		$login_field .= $this->get_recaptcha()->the_recaptcha_field( 'login' );

		return $login_field;
	}

	/**
	 * Displays recaptcha on password reset
	 */
	public function lostpassword_form() {
		echo apply_filters( 'palo_lostpassword_form', $lostpassword_field = '' );
	}

	public function lostpassword_form_filter( $lostpassword_field ) {
		$lostpassword_field .= $this->get_recaptcha()->the_recaptcha_field( 'resetpass' );

		return $lostpassword_field;
	}

	/**
	 * Displays recaptcha on registration and password field
	 */
	public function registration_form() {
		echo apply_filters( 'palo_register_form', $registration_field = '' );
	}

	/**
	 *  Collection of all registration_form hook before outputting
	 *
	 *
	 * @param $registration_field
	 *
	 * @return mixed|void
	 */
	public function registration_form_filter( $registration_field ) {
		//will check if users are allowed to set passwords
		$registration_field .= $this->get_helper()->display_password_field();

		//will display custom fields
		$registration_field .= $this->get_helper()->display_custom_fields();

		//will display the recaptcha field
		$registration_field .= $this->get_recaptcha()->the_recaptcha_field( 'register' );

		//will display terms and condition
		$registration_field .= $this->get_helper()->display_terms_condition();

		return $registration_field;
	}

	/**
	 * Responsible for displaying reCaptcha error on registration
	 *
	 * @param $errors
	 * @param $sanitized_user_login
	 * @param $user_email
	 *
	 * @return mixed
	 */
	public function registration_authentication( $errors, $sanitized_user_login, $user_email ) {
		$is_recaptcha_enabled   = $this->get_recaptcha()->is_recaptcha_enabled( 'register' );
		$is_users_set_password  = $this->get_skelet()->get( 'users_set_password' );
		$is_confirm_password    = $this->get_skelet()->get( 'display_confirm_password' );
		$is_terms_and_condition = $this->get_skelet()->get( 'enable_terms_condition' );

		/**
		 * Custom Field Error Handling
		 */
		$custom_fields = $this->get_helper()->get_form_fields();

		if ( $custom_fields ){
			foreach ( $custom_fields as $field ) {
				if ( strstr( $field['name'], 'palo_checkbox' )  ) {
					if ( isset( $_POST[ $field['name'] ] ) && ( empty( $_POST[ $field['name'] ] ) || $_POST[ $field['name'] ] === 'on' ) ) {
						$_POST[ $field['name'] ] = '1';
					} else {
						$_POST[ $field['name'] ] = '';
					}
				}

				if ( ( isset( $_POST[ $field['name'] ] ) && empty( $_POST[ $field['name'] ] ) ) ||
				     ( ! isset( $_POST[ $field['name'] ] ) && $field['required']  ) ) {
					$errors->add( 'palo_custom_field', sprintf( __( '%s is required', 'pressapps-login-access' ), $field['label'] ) );
				}
			}


		}

		/**
		 * Password Validation
		 */
		if ( $is_users_set_password ) {
			//will validate if users set password is enabled
			if ( ( isset( $_POST['palo_password'] ) && ! trim( $_POST['palo_password'] ) ) || ( isset( $_POST['palo_password_2'] ) && ! trim( $_POST['palo_password_2'] ) && $is_confirm_password ) ) {
				$errors->add( 'palo_password', __( 'Password Missing', 'pressapps-login-access' ) );
			} else if ( ( isset( $_POST['palo_password'] ) && isset( $_POST['palo_password_2'] ) ) && $_POST['palo_password'] !== $_POST['palo_password_2'] && $is_confirm_password ) {
				$errors->add( 'palo_password', __( "Passwords Doesn't Match", 'pressapps-login-access' ) );
			}
		}

		/**
		 * Terms and Condition
		 */
		if ( $is_terms_and_condition && ( ! isset( $_POST['termscondition'] ) || ( isset( $_POST['termscondition'] ) && $_POST['termscondition'] === 'false' ) ) ) {
			$errors->add( 'palo_terms_condition', __( "Please accept the Terms and Condition", 'pressapps-login-access' ) );
		}

		/**
		 * Recaptcha Validation
		 */
		if ( $is_recaptcha_enabled ) {
			//will run validation if captcha is enabled
			if ( isset( $_POST['g-recaptcha-response'] ) && $_POST['g-recaptcha-response'] ) {
				$response = $this->get_recaptcha()->verify( $_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'] );
				if ( $response->isSuccess() ) {
					return $errors;
				} else {
					foreach ( $response->getErrorCodes() as $code ) {
						$errors->add( 'palo_captcha', wp_kses( sprintf( __( '<strong>ERROR CODE</strong> %s Check the <a href="https://developers.google.com/recaptcha/docs/verify#error-code-reference">error code reference</a>', 'pressapps-login-access' ), $code ),
							array(
								'strong' => array(),
								'a'      => array(
									'href' => array()
								)
							)
						) );
					}
				}
			} else {
				$errors->add( 'palo_captcha', wp_kses( _( 'Captcha Verification Failed!', 'pressapps-login-access' ), array( 'strong' => array() ) ) );
			}
		}

		return $errors;
	}

	/**
	 * Function will run after registration
	 *
	 * @param $user_id
	 */
	public function callback_after_registration( $user_id ) {
		//will check if it's an ajax request an will not enter the argument below
		if ( isset( $_REQUEST['provider'] ) && in_array( $_REQUEST['provider'], array(
				'facebook',
				'twitter',
				'google'
			) )
		) {
			return $user_id;
		}

		$this->update_user_password_on_registration( $user_id );

		if ( $this->get_skelet()->get( 'approve_user_after_registration' ) && ! $this->get_skelet()->get( 'login_user_after_registration' ) ) {
			//users needs to be approve after registration
			$this->registration_for_approval( $user_id );

		} else {
			$this->login_after_registration( $user_id );
		}

		return $user_id;


	}

	/**
	 * Added user meta to check if user has been approved or not will default to false which needs to be approved
	 *
	 * @param $user_id
	 */
	public function registration_for_approval( $user_id ) {
		add_user_meta( $user_id, 'palo_user_approve', 'false' );
	}

	/**
	 * Will update user password on registration
	 *
	 * @param $user_id
	 */
	public function update_user_password_on_registration( $user_id ) {
		//will set password if option for it is enabled
		if ( $this->get_skelet()->get( 'users_set_password' ) ) {
			$userdata              = array();
			$userdata['ID']        = $user_id;
			$userdata['user_pass'] = $_POST['palo_password'];


			//This will disable the email notification of password change
			add_filter( 'send_password_change_email', '__return_false' );

			//will update password
			wp_update_user( $userdata );
		}

	}


	/**
	 * Login user after registration
	 *
	 * @param $user_id
	 */
	public function login_after_registration( $user_id ) {
		$user_data_by_id = get_user_by( 'id', $user_id );

		if ( $this->get_skelet()->get( 'users_set_password' ) && $this->get_skelet()->get( 'login_user_after_registration' ) ) {
			$cred = array(
				'user_login'    => $user_data_by_id->data->user_login,
				'user_password' => $_POST['palo_password'],
				'remember'      => true
			);

			//will sign in user once registration is complete
			wp_signon( $cred, is_ssl() );
		}
	}

	/**
	 * Remove password message on email
	 *
	 * @param $text
	 *
	 * @return string
	 */
	public function remove_password_message_on_email( $text ) {
		if ( $text == 'A password will be e-mailed to you.' && $this->get_skelet()->get( 'users_set_password' ) ) {
			$text = '';
		}

		return $text;
	}

	/**
	 * Removes slashes added to the password by WordPress
	 *
	 * @param $args
	 *
	 * @return mixed
	 */
	public function remove_slashes_on_email( $args ) {
		/**
		 * If it's not an registration email
		 */
		if ( empty ( $_POST['palo_password'] ) || ! $this->get_skelet()->get( 'users_set_password' ) ) {
			return $args;
		}

		$password           = $_POST['palo_password'];
		$password_unslashed = wp_unslash( $password );

		$args['message'] = str_replace( $password, $password_unslashed, $args['message'] );

		return $args;
	}

	/**
	 * Filter hook to display errors when password reset failed
	 *
	 * @param $errors
	 *
	 * @return string
	 */
	public function display_password_reset_error( $errors ) {
		if ( ! empty ( $_GET['action'] ) && $_GET['action'] === 'lostpassword' ) {
			if ( stristr( $errors, 'Captcha Verification Failed' ) ) {
				return $errors;
			} else {
				return $errors . wp_kses( __( 'Captcha Verification Failed!', 'pressapps-login-access' ), array( 'strong' => array() ) );
			}

		} else {
			return $errors;
		}

	}

	/**
	 * will display die message when recaptcha failed on password reset
	 */
	public function recaptcha_reset_die( $errors ) {
		$is_recaptcha_enabled = $this->get_recaptcha()->is_recaptcha_enabled( 'resetpass' );


		if ( $is_recaptcha_enabled ) {
			if ( isset( $_POST['g-recaptcha-response'] ) && ! empty( $_POST['g-recaptcha-response'] ) ) {
				$response = $this->get_recaptcha()->verify( $_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'] );
				if ( $response->isSuccess() ) {
					return $errors ;
				} else {
					$errors->add( 'palo_recaptcha', $this->get_recaptcha()->recaptcha_message() );
				}
			} else {
				$errors->add( 'palo_recaptcha', $this->get_recaptcha()->recaptcha_message() );
			}

			return $errors;
		}
	}


	/**
	 * Initialize the social login
	 */
	public function social_login_init() {

		$social_login = array( 'facebook', 'twitter', 'google' );
		if ( isset( $_REQUEST['provider'] ) && in_array( $_REQUEST['provider'], $social_login ) ) {
			$provider = ucfirst( sanitize_text_field( $_REQUEST['provider'] ) );
			try {
				$hybridauth     = new Hybrid_Auth( $this->get_social()->get_config() );
				$adapter        = $hybridauth->authenticate( $provider );
				$social_profile = $adapter->getUserProfile();
				$wp_login       = $this->get_social()->wp_login( $social_profile );


				if ( is_wp_error( $wp_login ) ) {
					$GLOBALS['error'] = sprintf( __( '%s', 'pressapps-login-access' ), $wp_login->get_error_message() );
				}

			} catch ( Exception $e ) {
				$GLOBALS['error'] = sprintf( __( '%s', 'pressapps-login-access' ), $e->getMessage() );
			}
		}
	}

	/**
	 * Updates the avatar to the social avatar
	 *
	 * @param $avatar
	 * @param $id_or_email
	 *
	 * @return string
	 */
	public function social_avatar( $avatar, $id_or_email ) {
		$user = false;

		if ( is_int( $id_or_email ) ) {
			$user = get_user_by( 'id', $id_or_email );

		} elseif ( is_object( $id_or_email ) ) {

			if ( $id_or_email->user_id ) {
				$user = get_user_by( 'id', $id_or_email->user_id );
			}

		} else {
			$user = get_user_by( 'email', $id_or_email );
		}

		if ( $user && is_object( $user ) && get_user_meta( $id_or_email, 'palo_social_avatar', true ) ) {
			$img_src = get_user_meta( $id_or_email, 'palo_social_avatar', true );
			$avatar  = sprintf( '<img alt="social avatar" src="%s" class="avatar avatar-64 photo" height="64" width="64">', $img_src );
		}

		return $avatar;
	}

	/**
	 * Hides password for accounts created through social login
	 *
	 * @param $bool
	 * @param $profileuser
	 *
	 * @return bool
	 */
	public function hide_password_for_social_account( $bool, $profileuser ) {
		$is_social = get_user_meta( get_current_user_id(), 'palo_is_social', true );

		if ( $is_social ) {
			$bool = false;
		}

		return $bool;
	}

	/**
	 * Add fields for the user column on the dashboard
	 *
	 * @param $columns
	 *
	 * @return array
	 */
	public function add_user_approval_column( $columns ) {
		if ( $this->get_skelet()->get( 'approve_user_after_registration' )  ) {
			$columns = array_merge( $columns, array( 'status' => __( 'Status', 'pressapps-login-access' ) ) );
		}

		return $columns;
	}

	/**
	 * Add value on the user column field for the dashboard
	 *
	 * @param $value
	 * @param $column_name
	 * @param $user_id
	 *
	 * @return string
	 */
	public function user_status_column( $value, $column_name, $user_id ) {
		if ( $column_name === 'status' && $this->get_skelet()->get( 'approve_user_after_registration' )  ) {
			$is_user_approve = get_user_meta( $user_id, 'palo_user_approve', true );
			if ( $is_user_approve === 'false' ) {
				$value = '<a href="#" data-callback="approve_user" data-nonce="' . wp_create_nonce( 'approve_user_' . $user_id ) . '" data-id="' . esc_attr( $user_id ) . '" class="button button-primary button-user-status">' . __( 'Approve', 'pressapps-login-access' ) . '</a>';
			} else {
				$value = '<a href="#" data-callback="disable_user" data-nonce="' . wp_create_nonce( 'disable_user_' . $user_id ) . '" data-id="' . esc_attr( $user_id ) . '" class="button button-user-status">' . __( 'Disable', 'pressapps-login-access' ) . '</a>';
			}
		}

		return $value;
	}

	/**
	 * Ajax script for the user approval on the dashboard
	 */
	public function user_approval_ajax() {
		$user_id   = intval( $_REQUEST['user_id'] );
		$callback  = $_REQUEST['callback'];

		check_ajax_referer( $callback . '_' . $user_id, 'nonce' );
		if ( $callback === 'approve_user' ) {
			//will approve the user
			$update = update_user_meta( $user_id, 'palo_user_approve', 'true' );
			$nonce  = wp_create_nonce( 'disable_user_' . $user_id );

			//will send email notification for approved user
			wp_send_new_user_notifications( $user_id, 'user' );
		} else {
			$update = update_user_meta( $user_id, 'palo_user_approve', 'false' );
			$nonce  = wp_create_nonce( 'approve_user_' . $user_id );

			//will send email notification for approved user
			wp_send_new_user_notifications( $user_id, 'user' );
		}
		//will check on the update_user_meta() respond
		$status = ( is_int( $update ) || $update ) ? 'true' : 'false';

		echo json_encode( compact( 'status', 'nonce' ) );
		wp_die();
	}


	/**
	 * Custom field display on the dashboard
	 *
	 * @param $user
	 */
	public function custom_field_profile( $user ) {
		$this->get_helper()->display_profile_table( $user, 'Account Information' );
	}

	/**
	 * Update the custom fields in the dashboard
	 *
	 * @param $user_id
	 */
	public function custom_field_update_profile( $user_id ) {
		$this->get_helper()->custom_fields_for( 'update', $user_id );
	}

	/**
	 * Admin Access Control Redirection
	 *
	 */
	public function admin_access_control() {

		if ( $this->get_skelet()->get( 'admin_restrict_dashboard' ) ) {

			$current_user       = wp_get_current_user();
			$current_user_roles = $current_user->roles;
			$role_based_access  = $this->get_skelet()->get( 'admin_user_role' ) ? $this->get_skelet()->get( 'admin_user_role' ) : array();
			$redirect_url       = filter_var( $this->get_skelet()->get( 'admin_redirect_url' ), FILTER_VALIDATE_URL ) ? $this->get_skelet()->get( 'admin_redirect_url' ) : home_url();

			//if user is not logged in and will redirect the user if role based access control is enabled
			if ( is_array( $role_based_access ) && ! empty( $role_based_access ) ) {
				foreach( $current_user_roles as $role ) {
					if ( in_array( $role, $role_based_access ) && is_admin() ) {
						wp_redirect( $redirect_url );
						exit;
					}
				}
			}
		}
	}

	/**
	 * Load all data to prevent unwanted querries on options
	 */
	public function load_data(){
		$args = array(
			'public'             => true,
			'publicly_queryable' => true,
			'_builtin'           => false
		);

		$post_types = array_values( get_post_types( $args ) );
		$args_post_type = array(
			'posts_per_page' => -1,
			'post_type'      => $post_types,
			'fields'         => 'ids'
		);

		$all_post_type = new WP_Query( $args_post_type );
		$all_post_ids = isset( $all_post_type->posts ) ? $all_post_type->posts : array();

		update_option( 'palo_core_post_types', $post_types );
		update_option( 'palo_core_taxonomy', get_object_taxonomies( $post_types )  );
		update_option( 'palo_post_ids', $all_post_ids );
		update_option( 'palo_option_tax', palo_get_tax() );
		update_option( 'palo_option_cat', palo_get_categories() );
		update_option( 'palo_option_cpt', palo_get_post_types() );
		update_option( 'palo_option_posts', palo_get_posts() );
		update_option( 'palo_option_pages', palo_get_pages() );
		update_option( 'palo_option_role', palo_user_roles() );
	}
}
