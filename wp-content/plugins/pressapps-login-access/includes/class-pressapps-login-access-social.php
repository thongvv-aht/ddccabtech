<?php


class Pressapps_Login_Access_Social {
	
	/**
	 * @var Pressapps_Login_Access_Social The reference to *Pressapps_Login_Access_Social* instance of this class
	 */
	private static $instance;

	/**
	 * Returns the *Pressapps_Login_Access_Social* instance of this class.
	 *
	 * @return Pressapps_Login_Access_Social The *Pressapps_Login_Access_Social* instance.
	 */
	public static function getInstance()
	{
		if (null === static::$instance) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Protected constructor to prevent creating a new instance of the
	 * *Pressapps_Login_Access_Social* via the `new` operator from outside of this class.
	 */
	protected function __construct(){}

	/**
	 * Private clone method to prevent cloning of the instance of the
	 * *Pressapps_Login_Access_Social* instance.
	 *
	 * @return void
	 */
	private function __clone(){}

	/**
	 * Private unserialize method to prevent unserializing of the *Pressapps_Login_Access_Social*
	 * instance.
	 *
	 * @return void
	 */
	private function __wakeup(){}

	/**
	 * Get the skelet instance
	 *
	 * @return Skelet
	 */
	public function get_skelet() {
		return $GLOBALS['palo_skelet'];
	}

	/**
	 * Get helper instance
	 * 
	 * @return Pressapps_Login_Access_Helper
	 */
	public function get_helper(  ) {
		return Pressapps_Login_Access_Helper::getInstance();
	}

	public function get_hybridauth_dir(  ) {
		return trailingslashit( plugin_dir_url( dirname( __FILE__ ) ) ) . 'includes/hybridauth/hybridauth/hybridauth/';
	}

	public function get_hybridauth(  ) {
		return new Hybrid_Auth( $this->get_config() );
	}

	public function set_config( $config ) {
		$this->config = $config;
	}

	public function get_config(  ) {
		return array(
			"base_url" => $this->get_hybridauth_dir(),
			"providers" => array(
				//Facebook Login
				"Facebook" => array(
					"enabled" => true,
					"keys"    => array( "id" => $this->get_skelet()->get( 'facebook_app_id' ), "secret" => $this->get_skelet()->get( 'facebook_app_secret' ) ),
					"scope"   => "email, user_about_me"
				),

				//Twitter Login
				"Twitter"  => array(
					"enabled" => true,
					"keys"    => array( "key" => $this->get_skelet()->get( 'twitter_api_key' ), "secret" => $this->get_skelet()->get( 'twitter_api_secret' ) )
				),

				//Google Login
				"Google"   => array(
					"enabled" => true,
					"keys"    => array( "id" => $this->get_skelet()->get( 'google_client_id' ), "secret" => $this->get_skelet()->get( 'google_client_secret' ) ),
				),
			)
		);
	}

	/**
	 * will display social login button
	 *
	 * @param $social
	 *
	 * @return string
	 */
	public function display_login_for( $social ) {
		$social_login = strtolower( $social ) . '_login';
		$button_text  = $this->get_skelet()->get( $social_login . '_text' );

		if ( $this->get_skelet()->get( $social_login ) ) {
			return '<a href="'. add_query_arg( array( 'provider' => $social ), home_url( '/wp-login.php' ) ) .'" class="'. esc_attr( 'palo_social_login ' . $social_login ) .'">' . esc_html( $button_text ) . '</a>';
		}

		return '';
	}

	public function display_social_button(){
		$socials = array( 'facebook', 'twitter', 'google' );
		$output = '';
		foreach ( $socials as $social ) {
			$output .= $this->display_login_for( $social );
		}

		return $output;
	}

	public function wp_login( $hybridauth_obj ) {
		if ( is_object( $hybridauth_obj ) && $hybridauth_obj ) {
			//information from adapter
			$data['first_name']     = $hybridauth_obj->firstName;
			$data['last_name']      = $hybridauth_obj->lastName;
			$data['email']          = $hybridauth_obj->email;
			$data['username']       = $hybridauth_obj->identifier;
			$data['user_url']       = $hybridauth_obj->webSiteURL;
			$data['description']    = $hybridauth_obj->description;
			$data['avatar']         = $hybridauth_obj->photoURL;
			$data['password']       = wp_generate_password( 10, true, true );
			$user_data_by_email     = get_user_by( 'email', $data['email'] );
			$user_login_data        = isset( $user_data_by_email->data->user_login ) ? $user_data_by_email->data->user_login : null;
			$is_user_needs_approval = $this->get_skelet()->get( 'approve_user_after_registration' );

			//username is taken from the hybridauth identifier which is unique for each user and provider
			if ( ! username_exists( $data['username'] ) && ! username_exists( $user_login_data ) ) {

				//if successful will return a user id
				$user_id = wp_create_user( $data['username'], $data['password'], $data['email'] );

				//check if there is an error when creating user
				if ( ! is_wp_error( $user_id ) ) {
					if ( $is_user_needs_approval ) {
						add_user_meta( $user_id, 'palo_user_approve', 'false' );
					}
					$creds                  = array();
					$creds['user_login']    = $data['username'];
					$creds['user_password'] = $data['password'];
					$login_approval_error   = new WP_Error( 'user_needs_approval', __( 'Account has been created and waiting for approval.', 'pressapps-login-access' ) );
					$login                  = $is_user_needs_approval ? $login_approval_error : wp_signon( $creds, is_ssl() );

					//update user info
					$update_user_info = wp_update_user( array(
						'ID'           => $user_id,
						'first_name'   => $data['first_name'],
						'last_name'    => $data['last_name'],
						'display_name' => $data['first_name'],
						'nickname'     => $data['first_name'],
						'user_url'     => $data['user_url'],
						'description'  => $data['description']
					) );

					//will add meta for profile photo link
					add_user_meta( $user_id, 'palo_social_avatar', $data['avatar'] );
					add_user_meta( $user_id, 'palo_is_social', true );

					//check if there is an error when updating the user info and will output error and end execution
					if ( is_wp_error( $update_user_info ) ) {
						return new WP_Error( 'social_login_failed', wp_kses( sprintf( __('%s', 'pressapps-login-access'), $update_user_info->get_error_message() ), array( 'strong' => array() ) ) );
					}

					//check if there is a problem logging in
					if ( ! is_wp_error( $login ) ) {
						wp_redirect( $this->get_helper()->redirect_after_login( admin_url(), $login ) );
						exit;
					} else {
						if ( in_array( 'user_needs_approval', $login->get_error_codes() ) ) {
							return new WP_Error( 'social_login_failed', wp_kses( sprintf( __('%s', 'pressapps-login-access'), $login->get_error_message() ), array( 'strong' => array() ) ) );
						} else {
							return new WP_Error( 'social_login_failed', wp_kses( sprintf( __('%s', 'pressapps-login-access'), $login->get_error_message() ), array( 'strong' => array() ) ) );
						}
					}

				} else {
					//if unable to create the user
					return new WP_Error( 'social_login_failed', wp_kses( sprintf( __('%s', 'pressapps-login-access'), $user_id->get_error_message() ), array( 'strong' => array() ) ) );
				}
			} else {

				if ( username_exists( $user_login_data ) ) {
					$login_username = $user_login_data;
					$login_ID       = $user_data_by_email->data->ID;

					add_user_meta( $login_ID, 'palo_social_avatar', $data['avatar'] );
					add_user_meta( $login_ID, 'palo_is_social', true );
				} else {
					//if username and email already exist and we will login the user
					//will only use the username since twitter will not return email
					$user_data      = get_user_by( 'login', $data['username'] );
					$login_username = $user_data->data->user_login;
					$login_ID       = $user_data->data->ID;
				}

				if ( $this->get_skelet()->get( 'approve_user_after_registration' ) ) {
					$is_user_approve = get_user_meta( intval( $login_ID ), 'palo_user_approve', 'true' );

					if ( $is_user_approve === 'false' ) {
						return new WP_Error( 'social_login_failed', wp_kses( __('Account is pending for approval or has been disabled. Please contact the administrator.', 'pressapps-login-access'), array( 'strong' => array() ) ) );
					}
				}

				//check if the profile pic has been changed and will update
				update_user_meta( $login_ID, 'pafl_social_profile', $data['avatar'], get_user_meta( $login_ID, 'social_profile', true ) );

				//will generate a new password on each login
				$data['password'] = wp_generate_password( 10, true, true );

				wp_set_password( $data['password'], $login_ID );

				//will login the user
				$creds                  = array();
				$creds['user_login']    = $login_username;
				$creds['user_password'] = $data['password'];
				$login                  = wp_signon( $creds, is_ssl() );

				//check if there is a problem logging in
				if ( ! is_wp_error( $login ) ) {
					wp_redirect( $this->get_helper()->redirect_after_login( admin_url(), $login ) );
					exit;
				} else {
					return new WP_Error( 'social_login_failed', wp_kses( sprintf( __('%s', 'pressapps-login-access'), $login->get_error_message() ), array( 'strong' => array() ) ) );
				}
			}
		}
	}
}