<?php


class Pressapps_Login_Access_Helper {

	/**
	 * @var Pressapps_Login_Access_Helper The reference to *Pressapps_Login_Access_Helper* instance of this class
	 */
	private static $instance;

	/**
	 * Returns the *Pressapps_Login_Access_Helper* instance of this class.
	 *
	 * @return Pressapps_Login_Access_Helper The *Pressapps_Login_Access_Helper* instance.
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
	 * *Pressapps_Login_Access_Helper* via the `new` operator from outside of this class.
	 */
	protected function __construct(){}

	/**
	 * Private clone method to prevent cloning of the instance of the
	 * *Pressapps_Login_Access_Helper* instance.
	 *
	 * @return void
	 */
	private function __clone(){}

	/**
	 * Private unserialize method to prevent unserializing of the *Pressapps_Login_Access_Helper*
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
	 * Will parse url adding query string on the url
	 *
	 * @param $url
	 * @param $args
	 *
	 * @return string
	 */
	public function parse_args_url( $url, $args ) {
		$query = parse_url( $url, PHP_URL_QUERY );
		$url .= ( $query ) ? '&' : '?';
		$url .= $args;

		return $url;
	}

	/**
	 * Converts hex value to rgb
	 *
	 * @param $hex
	 *
	 * @return string
	 */
	public function hex2rgb( $hex ) {
		$hex = str_replace( "#", "", $hex );

		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = array( $r, $g, $b );

		return implode( ", ", $rgb ); // returns the rgb values separated by commas
	}

	/**
	 * Will return a list of user roles
	 */
	public function user_roles() {
		global $wp_roles;

		$user_role = array();

		foreach ( array_keys( $wp_roles->roles ) as $role ) {
			if ( ! in_array( $role, array( 'administrator', 'editor' ) ) ) {
				$user_role[ $role ] = translate_user_role( ucfirst( $role ) );
			}
		}

		return $user_role;
	}

	/**
	 * Format taxonomy into a key value pair
	 *
	 * @param $array - termid
	 *
	 * @return array - taxonomy
	 */
	public function format_tax_list( $array ) {
		$array_value = array();
		if ( is_array( $array ) ) {
			foreach ( $array as $value ) {
				$explode_tax                    = explode( '_', str_replace( 'tax_', '', $value ) );
				$array_value[ $explode_tax[0] ] = $explode_tax[1];
			}
		}

		return $array_value;
	}

	/**
	 * Retrieve taxonomy list
	 *
	 * @param $post_type
	 *
	 * @return array
	 */
	public function get_tax( $post_type ) {
		$all_tax = array();

		foreach ( get_object_taxonomies( $post_type ) as $taxonomy ) {
			$tax_list = get_terms( $taxonomy );
			foreach ( $tax_list as $tax ) {
				$all_tax[ 'tax_' . $tax->term_id . '_' . $tax->taxonomy ] = ucwords( str_replace( '_', ' ', $tax->taxonomy ) ) . ': ' . ucfirst( $tax->name );
			}
		}

		return array_unique( $all_tax );
	}

	/**
	 * Retrive all taxonomy of all post types
	 *
	 * @return array
	 */
	public function get_taxonomy() {
		$args       = array(
			'public'             => true,
			'publicly_queryable' => true,
			'_builtin'           => false,
		);
		$post_types = get_post_types( $args );

		$all_post_type = array();
		$all_taxonomy  = array();

		foreach ( $post_types as $post_type ) {

			$args_post_type = array(
				'posts_per_page' => - 1,
				'post_type'      => $post_type,
				'include'
			);

			$all_post_type = array_merge( $all_post_type, get_posts( $args_post_type ) );
		}

		//will simplify the post type array
		foreach ( $all_post_type as $post_type ) {
			if ( isset( $post_type->ID ) && $post_type->post_type && $post_type->post_title ) {
				$all_taxonomy = array_merge( $all_taxonomy, $this->get_tax( $post_type->post_type ) );
			}
		}

		return array_unique( $all_taxonomy );
	}

	/**
	 * Get all post types
	 *
	 * @return array
	 */
	public function get_post_types() {
		//Will Check on Post Type
		$filtered_post_type = array();
		$all_post_type      = array();

		if ( get_option( 'palo_core_post_types', array() ) ) {

			$post_types = get_option( 'palo_core_post_types' );

			foreach ( $post_types as $post_type ) {

				$args_post_type = array(
					'posts_per_page' => - 1,
					'post_type'      => $post_type,
					'include'
				);
				$all_post_type  = array_merge( $all_post_type, get_posts( $args_post_type ) );

			}

			foreach ( $all_post_type as $post_type ) {
				if ( isset( $post_type->ID ) && $post_type->post_type && $post_type->post_title ) {
					$filtered_post_type[ 'archive_' . $post_type->post_type ] = sprintf( __( 'Archive %s', 'pressapps-login-access' ), ucfirst( $post_type->post_type ) );
					$filtered_post_type[ $post_type->ID . '_cpt' ]            = ucwords( str_replace( '_', ' ', $post_type->post_type ) ) . ': ' .$post_type->post_title;
				}
			}
		}

		return array_unique( $filtered_post_type );

	}

	/**
	 * Retrieve all posts
	 *
	 * @return array
	 */
	public function get_posts() {
		$args_post = array(
			'posts_per_page' => - 1,
			'post_type'      => 'post',
		);

		$all_post = array(
			'all_post'     => __( 'All Posts', 'pressapps-login-access' ),
			'archive_post' => __( 'Archive', 'pressapps-login-access' )
		);

		$posts = get_posts( $args_post );

		foreach ( $posts as $post ) {
			$all_post[ $post->ID . '_post' ] = ucfirst( $post->post_type ) . ': ' . ucfirst( $post->post_title );
		}

		return $all_post;
	}

	/**
	 * Get all post categories
	 *
	 * @return array
	 */
	public function get_categories() {
		$all_category = array();
		$categories   = get_categories();

		foreach ( $categories as $category ) {
			$all_category[ $category->term_id . '_cat' ] = ucfirst( $category->taxonomy ) . ': ' . ucfirst( $category->name );
		}

		return $all_category;
	}

	/**
	 * Retrieve all pages
	 *
	 * @return array
	 */
	public function get_pages() {
		$args_page = array(
			'posts_per_page' => - 1,
			'post_type'      => 'page',
		);

		$all_page = array(
			'all_page' => __( 'All Pages', 'pressapps-login-access' )
		);

		foreach ( get_posts( $args_page ) as $page ) {
			$all_page[ $page->ID . "_page" ] = ucfirst( $page->post_type ) . ': ' . ucfirst( $page->post_title );
		}
		//will check if there are any page that was set for posts page and will exclude it
		if ( intval( get_option( 'page_for_posts' ) ) && isset( $all_page[ get_option( 'page_for_posts' ) . "_page" ] ) ) {
			unset( $all_page[ get_option( 'page_for_posts' ) . "_page" ] );
		}
		return array_unique( $all_page );
	}

	/**
	 * Helper function for redirect after logout
	 *
	 * @param        $default_redirect
	 * @param string $user
	 *
	 * @return string
	 */
	public function redirect_after_login( $default_redirect, $user = '' ) {
		$redirect_option = $this->get_skelet()->get( 'redirect_after_login' );
		$user            = empty( $user ) ? get_user_by( 'id', get_current_user_id() ) : $user;

		switch ( $redirect_option ) {
			case 'disable':
				//will redirect user to default WordPress redirection
				return $default_redirect;
				break;
			case 'redirect_all':
				//will redirect all user except administrator
				if ( isset( $user->roles ) && is_array( $user->roles ) ) {
					if ( in_array( 'administrator', $user->roles ) ) {
						return $default_redirect;
					} else {
						return filter_var( $this->get_skelet()->get( 'redirect_all_url' ), FILTER_VALIDATE_URL ) ?
							esc_url_raw( $this->get_skelet()->get( 'redirect_all_url' ) ) :
							$default_redirect;
					}
				} else {
					return $default_redirect;
				}
				break;
			case 'role_based_redirection':
				if ( $this->get_skelet()->get( 'role_based_redirection' ) ) {

					$role_based_redirection = $this->get_skelet()->get( 'role_based_redirection' );

					if ( isset( $user->roles ) && is_array( $user->roles ) ) {

						foreach ( $role_based_redirection as $entry ) {
							if ( isset( $entry['palo_group_user_role'] ) && in_array( $entry['palo_group_user_role'], $user->roles ) ) {
								return filter_var( $entry['palo_group_user_redirect'], FILTER_VALIDATE_URL ) ?
									esc_url_raw( $entry['palo_group_user_redirect'] ) : $default_redirect;
							}
						}
					}
				} else {
					return $default_redirect;
				}

				break;
			default:
				return $default_redirect;
				break;
		}
	}

	/**
	 * Email notification function
	 *
	 * @param $notification
	 * @param $user_id
	 *
	 * @return array
	 */
	public function user_notification_for( $notification, $user_id ) {
		$blogname  = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
		$user_data = get_user_by( 'id', $user_id );

		$subject    = '';
		$message    = '';
		$from_email = '';

		if ( $notification === 'approve_user' && $this->get_skelet()->get( 'approved_user_notification_emails' ) ) {
			$user_notification = $this->get_skelet()->get( 'approved_user_email_field' );
			$user_from_email   = $user_notification['palo_approved_user_from_email'];
			$user_subject      = $user_notification['palo_approved_user_subject'];
			$user_message      = $user_notification['palo_approved_user_message'];

			$from_email = $user_from_email;
			$subject    = $user_subject ? $user_subject : sprintf( __( '[%s] Account has been approved.', 'pressapps-login-access' ), $blogname );
			$message    = '';

			if ( trim( $user_message ) && $user_data ) {
				$message .= str_replace( '%user%', $user_data->data->user_login, $user_message );
			} else {
				$message .= __( 'Your account has been approved and you can now login to the site.', 'pressapps-login-access' ) . "\r\n\r\n";
				$message .= wp_login_url() . "\r\n\r\n";
				$message .= sprintf( __( 'If you have any concerns, please contact us at %s.', 'pressapps-login-access' ), get_option( 'admin_email' ) ) . "\r\n\r\n";
			}

		} elseif ( $notification === 'disabled_account' && $this->get_skelet()->get( 'disabled_account_notification_emails' ) ) {
			$user_notification = $this->get_skelet()->get( 'disabled_account_email_field' );
			$user_from_email   = $user_notification['palo_disabled_account_from_email'];
			$user_subject      = $user_notification['palo_disabled_account_subject'];
			$user_message      = $user_notification['palo_disabled_account_message'];


			$from_email = $user_from_email;
			$subject    = $user_subject ? $user_subject : sprintf( __( '[%s] Account has been disabled.', 'pressapps-login-access' ), $blogname );
			$message    = '';

			if ( trim( $user_message ) && $user_data ) {
				$message .= str_replace( '%user%', $user_data->data->user_login, $user_message );
			} else {
				$message .= __( 'Your account has been disabled.', 'pressapps-login-access' ) . "\r\n\r\n";
				$message .= sprintf( __( 'If you have any concerns, please contact us at %s.', 'pressapps-login-access' ), get_option( 'admin_email' ) ) . "\r\n\r\n";
			}
		}


		return array(
			'subject' => $subject,
			'message' => $message,
			'header'  => "From : {$from_email}"
		);
	}

	/**
	 * Create a field for custom registration
	 *
	 * @param            $field_type
	 * @param            $label
	 * @param bool|false $required
	 * @param null       $options
	 * @param bool|false $table
	 * @param string     $value
	 *
	 * @return string
	 */
	public function display_field( $field_type, $label, $required = false, $options = null, $table = false, $value = '' ) {

		$name       = 'palo_' . $field_type . '_' . strtolower( str_replace( ' ', '_', $label ) );
		$id         = 'palo_' . $field_type . '_' . strtolower( str_replace( ' ', '_', $label ) );
		$required   = $required ? 'required' : '';
		$post_value = isset( $_POST[ $name ] ) ? $_POST[ $name ] : '';

		if ( ! is_null( $options ) ) {
			$options = array_map( array( $this, 'map_field_options' ), explode( "\n", $options ) );
		}

		//if value will be assigned
		$user_meta = ! empty( $value ) ? $value : '';

		$em_placeholder	= $this->get_skelet()->get( 'em_placeholder' );

		switch ( $field_type ) {
			case 'checkbox':
			case 'text':
				$class = ( $field_type === 'text' ? 'regular-text input' : 'checkbox' );
				$field = '';

				if ( $table ) {
					$field_table = sprintf( '<label for="%s">%s</label>', $name, $label );
					if ( $field_type === 'checkbox' ) {
						$field .= sprintf( '<input name="%s" type="%s" id="%s" class="%s" value="%s" %s>', $name, $field_type, $id, $class, $user_meta, checked( $user_meta, '1', false ) );
					} else {
						$field .= sprintf( '<input name="%s" type="%s" id="%s" class="%s" value="%s">', $name, $field_type, $id, $class, $user_meta );
					}
				} else {
					if ( $field_type === 'checkbox' ) {
						$field .= sprintf( '<label for="%s"><input name="%s" type="%s" id="%s" class="%s" %s %s> %s</label>', $name, $name, $field_type, $id, $class, checked( $post_value, '1', false ), $required, $label );
					} else {
						if ( $em_placeholder ) {
							$field .= sprintf( '<label for="%s"> <input placeholder="%s" name="%s" type="%s" id="%s" class="%s" value="%s" %s>', $name, $label, $name, $field_type, $id, $class, $post_value, $required );
						} else {
							$field .= sprintf( '<label for="%s">%s <input name="%s" type="%s" id="%s" class="%s" value="%s" %s>', $name, $label, $name, $field_type, $id, $class, $post_value, $required );
						}
					}
				}

				return $table ? sprintf( '<tr><th>%s</th><td>%s</td></tr>', $field_table, $field ) : sprintf( '<p>%s</p>', $field );
				break;
			case 'textarea':
				$class = 'palo_' . strtolower( $field_type );
				$field = '';

				if ( $table ) {
					$field_table = sprintf( '<label for="%s">%s</label>', $name, $label );
					$field .= sprintf( '<textarea name="%s" id="%s" class="%s" rows="5" cols="30">%s</textarea>', $name, $id, $class, $user_meta );
				} else {
					$field .= sprintf( '<label for="%s">%s <textarea name="%s" id="%s" class="%s" rows="5" cols="30" %s>%s</textarea></label>', $name, $label, $name, $id, $class, $required, $post_value );
				}

				return $table ? sprintf( '<tr><th>%s</th><td>%s</td></tr>', $field_table, $field ) : sprintf( '<p>%s</p>', $field );
				break;
			case 'select':
				$class = 'palo_' . strtolower( $field_type );

				if ( ! is_null( $options ) && is_array( $options ) ) {
					$field = '';

					if ( $table ) {
						$field_table = sprintf( '<label for="%s">%s</label>', $name, $label );
						$field .= sprintf( '<select name="%s" id="%s" class="%s">', $name, $id, $class );
					} else {
						$field .= sprintf( '<label for="%s">%s</label><br>', $name, $label );
						$field .= sprintf( '<select name="%s" id="%s" class="%s" %s>', $name, $id, $class, $required );
					}


					foreach ( $options as $option ) {
						$select_value = $post_value === '' ? $user_meta : $post_value;
						$field .= sprintf( '<option value="%s" %s>%s</option>', str_replace( ' ', '_', $option ), selected( $select_value, str_replace( ' ', '_', $option ), false ), $option );
					}
					$field .= '</select>';

					return $table ? sprintf( '<tr><th>%s</th><td>%s</td></tr>', $field_table, $field ) : sprintf( '<p>%s</p>', $field );
				}
				break;
			case 'radio':
				$class = 'palo_input_' . strtolower( $field_type );

				if ( ! is_null( $options ) && is_array( $options ) ) {
					$field = '';

					if ( $table ) {
						$field_table = sprintf( '<label for="%s">%s</label><br>', $name, $label );
					} else {
						$field .= sprintf( '<label for="%s">%s</label><br>', $name, $label );
					}

					foreach ( $options as $option ) {
						if ( $table ) {
							$field .= sprintf( '<p class="checkbox"><input type="radio" name="%s" id="%s" class="%s" value="%s" %s> %s</p>', $name, $id, $class, $option, checked( $user_meta, $option, false ), $option );
						} else {
							$field .= sprintf( '<span class="checkbox"><input type="radio" name="%s" id="%s" class="%s" value="%s" %s> %s</span>', $name, $id, $class, $option, checked( $post_value, $option, false ), $option );
						}
					}

					return $table ? sprintf( '<tr><th>%s</th><td>%s</td></tr>', $field_table, $field ) : sprintf( '<p>%s</p>', $field );
				}
				break;
		}
	}

	/**
	 * Mapping options
	 *
	 * @param $value
	 *
	 * @return string
	 */
	public function map_field_options( $value ) {
		return trim( preg_replace( '/\s+/', ' ', $value ) );
	}

	/**
	 * Display a table format for input fields
	 *
	 * @param        $user
	 * @param string $text
	 */
	public function display_profile_table( $user, $text = '' ) { ?>
		<?php
		$custom_fields = $this->get_skelet()->get( 'custom_fields' );

		if ( $custom_fields ): ?>
			<h3><?php printf( __( "%s", "pressapps-login-access" ), $text ); ?></h3>
			<table class="form-table">
				<?php foreach ( $custom_fields as $field ) {

					$field_type = isset( $field['palo_modal_field_type'] ) ? $field['palo_modal_field_type'] : '';
					$label      = isset( $field['palo_modal_field_label'] ) ? $field['palo_modal_field_label'] : '';
					$required   = isset( $field['palo_modal_field_required'] ) ? $field['palo_modal_field_required'] : false;
					$options    = isset( $field['palo_modal_field_options'] ) ? $field['palo_modal_field_options'] : array();
					$name       = 'palo_' . $field_type . '_' . strtolower( str_replace( ' ', '_', $label ) );

					echo $this->display_field(
						$field_type,
						ucwords( $label ),
						$required,
						$options,
						true,
						get_user_meta( $user->ID, $name, true )
					);

				}; ?>
			</table>
		<?php endif;
	}

	/***
	 * Retrieve all custom fields value
	 *
	 * @return array
	 */
	public function get_form_fields() {
		$custom_fields     = $this->get_skelet()->get( 'custom_fields' );
		$custom_fields_arr = array();
		if ( $custom_fields ) {
			//will save custom fields in session
			foreach ( $custom_fields as $field ) {

				$field_type = isset( $field['palo_modal_field_type'] ) ? $field['palo_modal_field_type'] : '';
				$label      = isset( $field['palo_modal_field_label'] ) ? $field['palo_modal_field_label'] : '';
				$required   = isset( $field['palo_modal_field_required'] ) ? $field['palo_modal_field_required'] : false;
				$options    = isset( $field['palo_modal_field_options'] ) ? $field['palo_modal_field_options'] : array();

				$custom_fields_arr[] = array(
					'label'    => $label,
					'name'     => 'palo_' . $field_type . '_' . strtolower( str_replace( ' ', '_', $label ) ),
					'required' => (bool) $required
				);
			}

		}

		return $custom_fields_arr;
	}

	/**
	 * Helper function to update or add meta data for custom fields
	 *
	 * @param $type
	 * @param $user_id
	 */
	public function custom_fields_for( $type, $user_id ) {
		$custom_fields = $this->get_form_fields();
		$type          = $type . '_user_meta';

		foreach ( $custom_fields as $field ) {
			if ( isset( $field['name'] ) ) {

				if ( isset( $_POST[ $field['name'] ] ) ) {
					$sanitize_post = sanitize_text_field( $_POST[ $field['name'] ] );

					if ( strstr( $field['name'], 'palo_checkbox' ) ) {
						$sanitize_post = '1';
					}

					$type( $user_id, $field['name'], $sanitize_post );

				} elseif ( strstr( $field['name'], 'palo_checkbox' ) ) {

					$type( $user_id, $field['name'], '' );
				}

			}
		}
	}

	/**
	 * Display password field
	 *
	 * @return string
	 */
	public function display_password_field() {
		$output = '';
		if ( $this->get_skelet()->get( 'users_set_password' ) ) {
			$output .= '<p>
				<label for="palo_password">' . __( 'Password', 'pressapps-login-access' ) . '</label>
				<input type="password" class="input" name="palo_password" id="palo_password"/>
			</p>';
			if ( $this->get_skelet()->get( 'display_confirm_password' ) ) {
				$output .= '<p>
					<label for="palo_password_2">' . __( 'Confirm Password', 'pressapps-login-access' ) . '</label>
					<input type="password" class="input" name="palo_password_2" id="palo_password_2"/>
				</p>';
			}
		}

		return $output;
	}

	/**
	 * Display custom fields
	 *
	 * @return string
	 */
	public function display_custom_fields() {
		$custom_fields = $this->get_skelet()->get( 'custom_fields' );

		$output = '';

		if ( $custom_fields ) {

			foreach ( $custom_fields as $field ) {

				$field_type = isset( $field['palo_modal_field_type'] ) ? $field['palo_modal_field_type'] : '';
				$label      = isset( $field['palo_modal_field_label'] ) ? $field['palo_modal_field_label'] : '';
				$required   = isset( $field['palo_modal_field_required'] ) ? $field['palo_modal_field_required'] : false;
				$options    = isset( $field['palo_modal_field_options'] ) ? $field['palo_modal_field_options'] : array();

				$output .= $this->display_field(
					$field_type,
					$label,
					$required,
					$options
				);
			}
		}

		return $output;
	}

	/**
	 * Display terms and condition
	 *
	 * @return string
	 */
	public function display_terms_condition() {
		$output = '';
		if ( $this->get_skelet()->get( 'enable_terms_condition' ) ) {
			$output .= '<p class="palo-terms-condition">
			<label for="termscondition">
				<input type="checkbox" name="termscondition" id="termscondition" class="checkbox" value=""> <a
					href="' . esc_url( get_the_permalink( $this->get_skelet()->get( 'modal_terms_condition' ) ) ) . '"
					target="_blank">' . get_the_title( $this->get_skelet()->get( 'modal_terms_condition' ) ) . '</a>
			</label>
		</p>';
		}

		return $output;
	}
}