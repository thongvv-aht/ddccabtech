<?php
/**
 * The file that holds helper functions and pluggable that are not in a class
 */


if ( ! function_exists( 'wp_authenticate' ) ) {

	/**
	 * Login authentication pluggable
	 *
	 * @param $username
	 * @param $password
	 *
	 * @return mixed|void|WP_Error
	 */
	function wp_authenticate( $username, $password ) {
		$palo_skelet          = $GLOBALS['palo_skelet'];
		$recaptcha            = Pressapps_Login_Access_ReCaptcha::getInstance();
		$username             = sanitize_user( $username );
		$password             = trim( $password );
		$is_recaptcha_enabled = $recaptcha->is_recaptcha_enabled( 'login' );
		$get_user_data        = get_user_by( 'login', $username );
		$user                 = apply_filters( 'authenticate', null, $username, $password );

		if ( isset( $_REQUEST['provider'] ) ) {
			//will disable password nag for social login user
			isset( $get_user_data->data->ID ) ? update_user_option( $get_user_data->data->ID, 'default_password_nag', false ) : null;

			return $user;
		} else {
			//will enable password nag
			isset( $get_user_data->data->ID ) && ! get_user_option( 'default_password_nag', $get_user_data->data->ID ) ? update_user_option( $get_user_data->data->ID, 'show_admin_bar_front', true ) : null;
		}

		/**
		 * Do nothing if no post data have been provided
		 */
		if ( empty( $_POST ) ) {
			return $user;
		}

		/**
		 * Force errors on missing username or password
		 */
		if ( $username == null || $password == null || empty( $username ) || empty( $password ) ) {
			$user = new WP_Error( 'palo_authentication_failed', wp_kses( __( 'Invalid username or incorrect password.', 'pressapps-login-access' ), array( 'strong' => array() ) ) );
		}


		/**
		 * check if recaptcha is enabled
		 */
		if ( ! empty ( $user ) && ! empty( $username ) && ! empty( $password ) ) {

			if ( $palo_skelet->get( 'approve_user_after_registration' ) ) {
				$user_data_by_login = get_user_by( 'login', $username );
				$user_id            = isset( $user_data_by_login->data->ID ) ? $user_data_by_login->data->ID : null;
				$is_user_approved   = is_null( $user_id ) ? 'false' : get_user_meta( intval( $user_id ), 'palo_user_approve', true );

				if ( $is_user_approved === 'false' ) {
					if ( is_wp_error( $user ) ) {
						$user->add( 'palo_account_approval', wp_kses( __( 'Your account is pending for approval. Please contact the administrator.', 'pressapps-login-access' ), array( 'strong' => array() ) ) );
					} else {
						$user = new WP_Error( 'palo_account_approval', wp_kses( __( 'Your account is pending for approval. Please contact the administrator.', 'pressapps-login-access' ), array( 'strong' => array() ) ) );
					}
				}
			}


			if ( $is_recaptcha_enabled ) {
				//will check if g-reccaptcha-response from recaptcha is sent as a $_POST
				if ( isset( $_POST['g-recaptcha-response'] ) && $_POST['g-recaptcha-response'] ) {
					$response = $recaptcha->verify( $_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'] );

					//will check if the recaptcha was valid and $user is not empty and has no error
					if ( ! $response->isSuccess() ) {
						//will display any errors on processing recaptcha
						foreach ( $response->getErrorCodes() as $code ) {
							$user->add( 'palo_recaptcha', wp_kses( sprintf( __( '<strong>ERROR CODE</strong>: %s Check the <a href="https://developers.google.com/recaptcha/docs/verify#error-code-reference">error code reference</a>', 'pressapps-login-access' ), $code ),
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
					//if $_POST['g-recaptcha-response'] is not set will display a generic error
					if ( is_wp_error( $user ) ) {
						$user->add( 'palo_recaptcha', wp_kses( __( 'Captcha Verification Failed!', 'pressapps-login-access' ), array( 'strong' => array() ) ) );
					} else {
						$user = new WP_Error( 'palo_recaptcha', wp_kses( __( 'Captcha Verification Failed!', 'pressapps-login-access' ), array( 'strong' => array() ) ) );
					}
				}

			}
		}

		if ( ! empty ( $user ) && is_wp_error( $user ) ) {
			switch ( true ) {
				case $is_recaptcha_enabled:
					if ( ! isset( $_POST['g-recaptcha-response'] ) || ( isset( $response ) && ! $response->isSuccess() ) ) {
						do_action( 'wp_login_failed', $username );
					}
					break;
				default:
					do_action( 'wp_login_failed', $username );
					break;
			}
		}

		return $user;
	}
}


if ( ! function_exists( 'wp_new_user_notification' ) ) {
	/**
	 * Pluggable for notifying user.
	 *
	 * @param        $user_id
	 * @param null $deprecated
	 * @param string $notify
	 */
	function wp_new_user_notification( $user_id, $deprecated = null, $notify = '' ) {
		if ( $deprecated !== null ) {
			_deprecated_argument( __FUNCTION__, '4.3.1' );
		}

		global $wpdb, $wp_hasher;

		$skelet = $GLOBALS['palo_skelet'];
		$helper = Pressapps_Login_Access_Helper::getInstance();

		$user = get_userdata( $user_id );

		// The blogname option is escaped with esc_html on the way into the database in sanitize_option
		// we want to reverse this for the plain text arena of emails.
		$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

		$message = sprintf( __( 'New user registration on your site %s:', 'pressapps-login-access' ), $blogname ) . "\r\n\r\n";
		$message .= sprintf( __( 'Username: %s', 'pressapps-login-access' ), $user->user_login ) . "\r\n\r\n";
		$message .= sprintf( __( 'E-mail: %s', 'pressapps-login-access' ), $user->user_email ) . "\r\n";

		if ( 'user' !== $notify || empty( $notify ) ) {
			@wp_mail( get_option( 'admin_email' ), sprintf( __( '[%s] New User Registration', 'pressapps-login-access' ), $blogname ), $message );
		}


		if ( 'admin' === $notify || empty( $notify ) ) {
			return;
		}

		// Generate something random for a password reset key.
		$key = wp_generate_password( 20, false );

		/** This action is documented in wp-login.php */
		do_action( 'retrieve_password_key', $user->user_login, $key );

		// Now insert the key, hashed, into the DB.
		if ( empty( $wp_hasher ) ) {
			require_once ABSPATH . WPINC . '/class-phpass.php';
			$wp_hasher = new PasswordHash( 8, true );
		}
		$hashed = time() . ':' . $wp_hasher->HashPassword( $key );
		$wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user->user_login ) );


		if ( $skelet->get( 'users_set_password' ) && ! $skelet->get( 'login_user_after_registration' ) ) {

			if ( isset( $_REQUEST['callback'] ) ) {

				if ( $_REQUEST['callback'] === 'approve_user' ) {
					$user_notification = $helper->user_notification_for( 'approve_user', $user_id );
					$subject           = $user_notification['subject'];
					$message           = $user_notification['message'];
					$header            = $user_notification['header'];
				} else {
					$user_notification = $helper->user_notification_for( 'disabled_account', $user_id );
					$subject           = $user_notification['subject'];
					$message           = $user_notification['message'];
					$header            = $user_notification['header'];
				}

			} else {
				// New Registration for user with set password
				$subject = sprintf( __( '[%s] Account created and pending for approval', 'pressapps-login-access' ), $blogname );
				$message = sprintf( __( 'Username: %s', 'pressapps-login-access' ), $user->user_login ) . "\r\n\r\n";

				//will include password on message if set
				if ( $skelet->get( 'users_set_password' ) && isset( $_POST['palo_password'] ) ) {
					$message .= sprintf( __( 'Password: %s', 'pressapps-login-access' ), $_POST['palo_password'] ) . "\r\n\r\n";
				}

				if ( $skelet->get( 'approve_user_after_registration' ) ) {
					$message .= __( 'Your account has been created, but still pending for approval.', 'pressapps-login-access' ) . "\r\n\r\n";
				}

				$message .= sprintf( __( 'If you have any concerns, please contact us at %s.', 'pressapps-login-access' ), get_option( 'admin_email' ) ) . "\r\n\r\n";
			}

		} else {

			if ( isset( $_REQUEST['callback'] ) ) {
				if ( $_REQUEST['callback'] === 'approve_user' ) {
					$user_notification = $helper->user_notification_for( 'approve_user', $user_id );
					$subject           = $user_notification['subject'];
					$message           = $user_notification['message'];
					$header            = $user_notification['header'];
				} else {
					$user_notification = $helper->user_notification_for( 'disabled_account', $user_id );
					$subject           = $user_notification['subject'];
					$message           = $user_notification['message'];
					$header            = $user_notification['header'];
				}
			} else {
				if ( $skelet->get( 'approve_user_after_registration' ) ) {
					$subject = sprintf( __( '[%s] Account created and pending for approval', 'pressapps-login-access' ), $blogname );
					$message = sprintf( __( 'Username: %s', 'pressapps-login-access' ), $user->user_login ) . "\r\n\r\n";
					$message .= __( 'Your account has been created, but still pending for approval.', 'pressapps-login-access' ) . "\r\n\r\n";
					$message .= __( 'To set your password, visit the following address:', 'pressapps-login-access' ) . "\r\n\r\n";
					$message .= network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user->user_login ), 'login' ) . "\r\n\r\n";
				} else {
					$subject = sprintf( __( '[%s] Your account information.', 'pressapps-login-access' ), $blogname );
					$message = sprintf( __( 'Username: %s', 'pressapps-login-access' ), $user->user_login ) . "\r\n\r\n";
					$message .= __( 'To set your password, visit the following address:', 'pressapps-login-access' ) . "\r\n\r\n";
					$message .= network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user->user_login ), 'login' ) . "\r\n\r\n";
				}

				$message .= sprintf( __( 'If you have any problems, please contact us at %s.', 'pressapps-login-access' ), get_option( 'admin_email' ) ) . "\r\n\r\n";
			}

		}


		if ( isset( $header ) ) {
			wp_mail( $user->user_email, $subject, $message, $header );
		} else {
			wp_mail( $user->user_email, $subject, $message );
		}
	}
}


if ( ! function_exists( 'retrieve_password' ) ) {
	/**
	 * Retrieve password pluggable
	 *
	 */
	function retrieve_password() {
		global $wpdb, $wp_hasher;

		$errors = new WP_Error();

		if ( empty( $_POST['user_login'] ) ) {
			$errors->add( 'empty_username', __( 'Enter a username or email address.', 'pressapps-login-access' ) );
		} elseif ( strpos( $_POST['user_login'], '@' ) ) {
			$user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
			if ( empty( $user_data ) ) {
				$errors->add( 'invalid_email', __( 'There is no user registered with that email address.', 'pressapps-login-access' ) );
			}
		} else {
			$login     = trim( $_POST['user_login'] );
			$user_data = get_user_by( 'login', $login );
		}

		/**
		 * Fires before errors are returned from a password reset request.
		 *
		 * @since 2.1.0
		 * @since 4.4.0 Added the `$errors` parameter.
		 *
		 * @param WP_Error $errors A WP_Error object containing any errors generated
		 *                         by using invalid credentials.
		 */
		do_action( 'lostpassword_post', $errors );

		if ( $errors->get_error_code() ) {
			return $errors;
		}

		if ( ! $user_data ) {
			$errors->add( 'invalidcombo', __( 'Invalid username or email.', 'pressapps-login-access' ) );

			return $errors;
		}

		// Redefining user_login ensures we return the right case in the email.
		$user_login = $user_data->user_login;
		$user_email = $user_data->user_email;
		$key        = get_password_reset_key( $user_data );

		if ( is_wp_error( $key ) ) {
			return $key;
		}

		$message = __( 'Someone has requested a password reset for the following account:', 'pressapps-login-access' ) . "\r\n\r\n";
		$message .= network_home_url( '/' ) . "\r\n\r\n";
		$message .= sprintf( __( 'Username: %s', 'pressapps-login-access' ), $user_login ) . "\r\n\r\n";
		$message .= __( 'If this was a mistake, just ignore this email and nothing will happen.', 'pressapps-login-access' ) . "\r\n\r\n";
		$message .= __( 'To reset your password, visit the following address:', 'pressapps-login-access' ) . "\r\n\r\n";
		$message .= '<' . network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";

		if ( is_multisite() ) {
			$blogname = $GLOBALS['current_site']->site_name;
		} else /*
			 * The blogname option is escaped with esc_html on the way into the database
			 * in sanitize_option we want to reverse this for the plain text arena of emails.
			 */ {
			$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
		}

		$title = sprintf( __( '[%s] Password Reset', 'pressapps-login-access' ), $blogname );

		/**
		 * Filter the subject of the password reset email.
		 *
		 * @since 2.8.0
		 * @since 4.4.0 Added the `$user_login` and `$user_data` parameters.
		 *
		 * @param string $title Default email title.
		 * @param string $user_login The username for the user.
		 * @param WP_User $user_data WP_User object.
		 */
		$title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );

		/**
		 * Filter the message body of the password reset mail.
		 *
		 * @since 2.8.0
		 * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
		 *
		 * @param string $message Default mail message.
		 * @param string $key The activation key.
		 * @param string $user_login The username for the user.
		 * @param WP_User $user_data WP_User object.
		 */
		$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );

		if ( $message && ! wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) ) {
			wp_die( __( 'The email could not be sent.', 'pressapps-login-access' ) . "<br />\n" . __( 'Possible reason: your host may have disabled the mail() function.', 'pressapps-login-access' ) );
		}

		return true;
	}
}


if ( ! function_exists( 'palo_login' ) ) {
	/**
	 * Login form php output function
	 *
	 */
	function palo_login() {
		echo apply_filters( 'palo_display_form', $form_html = '', 'login', false );
	}
}


if ( ! function_exists( 'pa_login' ) ) {
	/**
	 * Fallback function for deprecated login form
	 *
	 */
	function pa_login() {
		palo_login();
	}
}


if ( ! function_exists( 'palo_register' ) ) {
	/**
	 * Register form php output function
	 *
	 */
	function palo_register() {
		echo apply_filters( 'palo_display_form', $form_html = '', 'register', false );
	}
}


if ( ! function_exists( 'pa_register' ) ) {
	/**
	 * Fallback function for deprecated register form
	 *
	 */
	function pa_register() {
		palo_register();
	}
}


if ( ! function_exists( 'palo_reset' ) ) {
	/**
	 * Reset password form php output function
	 *
	 */
	function palo_reset() {
		echo apply_filters( 'palo_display_form', $form_html = '', 'resetpass', false );
	}
}


if ( ! function_exists( 'pa_reset' ) ) {
	/**
	 * Fallback function for deprecated reset password form
	 *
	 */
	function pa_reset() {
		palo_reset();
	}
}


if ( ! function_exists( 'palo_modal_login' ) ) {
	/**
	 * Login modal link php function
	 *
	 * @param string $login_text
	 * @param string $logout_text
	 *
	 * @return string
	 */
	function palo_modal_login( $login_text = 'Login', $logout_text = 'Logout' ) {
		if ( is_user_logged_in() ) {
			echo '<a href="' . esc_url( wp_logout_url() ) . '" class="palo-link-style palo-modal-logout">' . esc_html( $logout_text ) . '</a>';
		} else {
			echo '<a href="javascript:void(0)" data-form="login" class="palo-link-style palo-modal-link palo-modal-open">' . esc_html( $login_text ) . '</a>';
		}
	}
}


if ( ! function_exists( 'pa_modal_login' ) ) {
	/**
	 * Fallback function for deprecated login form link
	 *
	 * @param string $login_text
	 * @param string $logout_text
	 */
	function pa_modal_login( $login_text = 'Login', $logout_text = 'Logout' ) {
		palo_modal_login( $login_text, $logout_text );
	}
}

if ( ! function_exists( 'palo_modal_register' ) ) {
	/**
	 * Register modal link php function
	 *
	 * @param string $register_text
	 * @param string $registered_text
	 */
	function palo_modal_register( $register_text = 'Register', $registered_text = 'You are already registered' ) {
		if ( is_user_logged_in() ) {
			echo '<a href="javascript:void(0)" class="palo-link-style">' . esc_html( $registered_text ) . '</a>';
		} else {
			echo '<a href="javascript:void(0)" data-form="register" class="palo-link-style palo-modal-link palo-modal-open">' . esc_html( $register_text ) . '</a>';
		}
	}
}

if ( ! function_exists( 'pa_modal_register' ) ) {
	/**
	 * Fallback function for deprecated register form link
	 *
	 * @param string $register_text
	 * @param string $registered_text
	 */
	function pa_modal_register( $register_text = 'register', $registered_text = 'You are already registered' ) {
		palo_modal_register( $register_text, $registered_text );
	}
}

if ( ! function_exists( 'palo_user_roles' ) ) {
	/**
	 * Retrieves user roles
	 *
	 * @return array
	 */
	function palo_user_roles() {
		$user_roles = array_keys( wp_roles()->roles );

		array_walk( $user_roles, function ( &$role ) {
			if ( ! in_array( $role, array( 'administrator', 'editor' ) ) ) {
				$role = str_replace( '_', ' ', translate_user_role( ucfirst( $role ) ) );
			} else {
				$role = null;
			}
		} );

		$user_roles = array_filter( $user_roles );
		$user_keys  = array_map( 'strtolower', $user_roles );

		if ( ! empty( $user_keys ) && ! empty( $user_keys ) ) {
			return array_combine( $user_keys, $user_roles );
		} else {
			return array();
		}
	}
}

if ( ! function_exists( 'palo_get_categories' ) ) {
	/**
	 * Get all post categories
	 *
	 * @return array
	 */
	function palo_get_categories() {
		$categories = get_categories();
		$cat_keys   = array_map( function ( $value ) {
			return $value->term_id . '_cat';
		}, $categories );

		$cat_values = array_map( function ( $value ) {
			return ucfirst( $value->taxonomy ) . ': ' . ucfirst( $value->name );
		}, $categories );

		if ( ! empty( $cat_keys ) && ! empty( $cat_values ) ) {
			return array_combine( $cat_keys, $cat_values );
		} else {
			return array();
		}
	}
}


if ( ! function_exists( 'palo_get_posts' ) ) {
	/**
	 * Retrieve all posts
	 *
	 * @return array
	 */
	function palo_get_posts() {
		$args_post = array(
			'posts_per_page' => - 1,
			'post_type'      => 'post',
		);

		$post_default_keys   = array( 'all_post', 'archive_post' );
		$post_default_values = array(
			__( 'All Posts', 'pressapps-login-access' ),
			__( 'Archive', 'pressapps-login-access' )
		);

		$posts = get_posts( $args_post );

		$post_keys = array_map( function ( $value ) {
			return $value->ID . '_post';
		}, $posts );

		$post_values = array_map( function ( $value ) {
			return ucfirst( $value->post_type ) . ': ' . ucfirst( $value->post_title );
		}, $posts );

		$post_keys   = array_merge( $post_default_keys, $post_keys );
		$post_values = array_merge( $post_default_values, $post_values );


		if ( ! empty( $post_keys ) && ! empty( $post_values ) ) {
			return array_combine( $post_keys, $post_values );
		} else {
			return array();
		}
	}
}

if ( ! function_exists( 'palo_get_tax' ) ) {
	/**
	 * Get Taxonomy
	 *
	 * @return array|null
	 */
	function palo_get_tax() {

		if ( ! get_option( 'palo_core_taxonomy', array() ) ) {
			return null;
		}

		$obj_tax = get_option( 'palo_core_taxonomy', array() );

		$all_tax_keys = array_map( function ( $value ) {
			$tax_list = get_terms( $value );

			return array_map( function ( $item ) {
				return 'tax_' . $item->term_id . '_' . $item->taxonomy;
			}, $tax_list );
		}, $obj_tax );

		$all_tax_keys = array_filter( $all_tax_keys );
		if ( ! $all_tax_keys ) {
			return null;
		}

		$all_tax_keys = call_user_func_array( 'array_merge', $all_tax_keys );

		$all_tax_values = array_map( function ( $value ) {
			$tax_list = get_terms( $value );

			return array_map( function ( $item ) {
				return ucwords( str_replace( '_', ' ', $item->taxonomy ) ) . ': ' . ucfirst( $item->name );
			}, $tax_list );
		}, $obj_tax );

		$all_tax_values = array_filter( $all_tax_values );

		if ( ! $all_tax_values ) {
			return null;
		}

		$all_tax_values = call_user_func_array( 'array_merge', $all_tax_values );

		if ( ! empty( $all_tax_keys ) && ! empty( $all_tax_values ) ) {
			return array_combine( $all_tax_keys, $all_tax_values );
		} else {
			return array();
		}
	}
}

if ( ! function_exists( 'palo_get_post_types' ) ) {
	/**
	 * Get all post types
	 *
	 * @return array
	 */
	function palo_get_post_types() {

		$filtered_post_type = array();

		if ( get_option( 'palo_core_post_types', array() ) ) {

			$post_types   = get_option( 'palo_core_post_types', array() );
			$all_post_ids = get_option( 'palo_post_ids', array() );

			//Archive Keys
			$post_archive_keys = array_map( function ( $value ) {
				return 'archive_' . $value;
			}, $post_types );

			//Archive Values
			$post_archive_values = array_map( function ( $value ) {
				return sprintf( __( 'Archive %s', 'pressapps-login-access' ), ucwords( str_replace( '_', ' ', $value ) ) );
			}, $post_types );

			//CPT Keys
			$post_cpt_keys = array_map( function ( $value ) {
				return $value . '_cpt';
			}, $all_post_ids );

			//CPT Values
			$post_cpt_values = array_map( function ( $value ) {
				return ucwords( str_replace( '_', ' ', get_post_type( $value ) ) ) . ': ' . get_the_title( $value );
			}, $all_post_ids );

			$post_keys   = array_merge( $post_archive_keys, $post_cpt_keys );
			$post_values = array_merge( $post_archive_values, $post_cpt_values );

			$filtered_post_type = array_combine( $post_keys, $post_values );
		}

		if ( ! empty( $filtered_post_type ) ) {
			return array_unique( $filtered_post_type );
		} else {
			return array();
		}
	}
}

if ( ! function_exists( 'palo_get_pages' ) ) {
	/**
	 * Retrieve all pages
	 *
	 * @return array
	 */
	function palo_get_pages() {
		$args_page = array(
			'posts_per_page' => - 1,
			'post_type'      => 'page',
		);

		$get_default_values = array( __( 'All Pages', 'pressapps-login-access' ) );
		$get_default_keys   = array( 'all_page' );
		$get_posts          = get_posts( $args_page );

		$get_values = array_map( function ( $value ) {
			return ucfirst( $value->post_type ) . ': ' . ucfirst( $value->post_title );
		}, $get_posts );

		$get_keys = array_map( function ( $value ) {
			return $value->ID . "_page";
		}, $get_posts );

		$get_keys   = array_merge( $get_default_keys, $get_keys );
		$get_values = array_merge( $get_default_values, $get_values );

		$all_page = array_combine( $get_keys, $get_values );

		//will check if there are any page that was set for posts page and will exclude it
		if ( intval( get_option( 'page_for_posts' ) ) && isset( $all_page[ get_option( 'page_for_posts' ) . "_page" ] ) ) {
			unset( $all_page[ get_option( 'page_for_posts' ) . "_page" ] );
		}

		if ( ! empty( $all_page ) ) {
			return array_unique( $all_page );
		} else {
			return array();
		}
	}
}
