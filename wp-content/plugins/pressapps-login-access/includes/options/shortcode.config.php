<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

/**
 * Global skelet shortcodes variable
 */
global $skelet_shortcodes;

/**
 * Fullscreen navigation     Shortcode options and settings
 */
$skelet_shortcodes[]     = sk_shortcode_apply_prefix( array(
	'title'      => __( 'LOGIN & ACCESS', 'pressapps' ),
	'shortcodes' => array(
		array(
			'name'      => 'login',
			'title'     => __( 'Insert Login Form', 'pressapps' )
		),
		array(
			'name'      => 'register',
			'title'     => __( 'Insert Register Form', 'pressapps' )
		),
		array(
			'name'      => 'forgotten',
			'title'     => __( 'Insert Reset Password Form', 'pressapps' )
		),
		array(
			'name'      => 'modal_login',
			'title'     => __( 'Insert Modal Login', 'pressapps' ),
			'fields'    => array(
				array(
					'id'       => 'login_text',
					'type'     => 'text',
					'title'    => __( 'Login Link Text', 'pressapps' ),
					'default'  => ''
				),
				array(
					'id'       => 'logout_text',
					'type'     => 'text',
					'title'    => __( 'Logout Link Text', 'pressapps' ),
					'default'  => ''
				),
			),
		),
		array(
			'name'      => 'modal_register',
			'title'     => __( 'Insert Modal Register', 'pressapps' ),
			'fields'    => array(
				array(
					'id'       => 'register_text',
					'type'     => 'text',
					'title'    => __( 'Register Link Text', 'pressapps' ),
					'default'  => ''
				),
				array(
					'id'       => 'registered_text',
					'type'     => 'text',
					'title'    => __( 'Registered Link Text', 'pressapps' ),
					'default'  => ''
				),
			),
		)

	),

));