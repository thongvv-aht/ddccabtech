<?php


class Pressapps_Login_Access_ReCaptcha {


	/**
	 * @var Pressapps_Login_Access_ReCaptcha The reference to *Pressapps_Login_Access_ReCaptcha* instance of this class
	 */
	private static $instance;

	/**
	 * Returns the *Pressapps_Login_Access_ReCaptcha* instance of this class.
	 *
	 * @return Pressapps_Login_Access_ReCaptcha The *Pressapps_Login_Access_ReCaptcha* instance.
	 */
	public static function getInstance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Protected constructor to prevent creating a new instance of the
	 * *Pressapps_Login_Access_ReCaptcha* via the `new` operator from outside of this class.
	 */
	protected function __construct() {}

	/**
	 * Private clone method to prevent cloning of the instance of the
	 * *Pressapps_Login_Access_ReCaptcha* instance.
	 *
	 * @return void
	 */
	private function __clone() {}

	/**
	 * Private unserialize method to prevent unserializing of the *Pressapps_Login_Access_ReCaptcha*
	 * instance.
	 *
	 * @return void
	 */
	private function __wakeup() {}

	/**
	 * Get the skelet instance
	 *
	 * @return Skelet
	 */
	public function get_skelet() {
		return $GLOBALS['palo_skelet'];
	}

	/**
	 * Get the Helper instance
	 *
	 * @return Pressapps_Login_Access_Helper
	 */
	public function get_helper() {
		return Pressapps_Login_Access_Helper::getInstance();
	}


	/**
	 * Get recaptcha sitekey
	 * 
	 * @return string
	 */
	public function get_sitekey(  ) {
		return $this->get_skelet()->get( 'recaptcha_sitekey' );
	}

	/**
	 * Get recaptcha secret
	 * 
	 * @return string
	 */
	public function get_secret(  ) {
		return $this->get_skelet()->get( 'recaptcha_secret' );
	}

	/**
	 * Get recaptcha instance
	 * 
	 * @return \ReCaptcha\ReCaptcha
	 */
	public function get_recaptcha_instance() {
		return new ReCaptcha\ReCaptcha( $this->get_secret()  );
	}

	/**
	 * Helper to check if a method exist inside a class
	 *
	 * @param $method
	 *
	 * @return bool
	 */
	public function is_method_exists( $method ) {
		return method_exists( 'ReCaptcha\ReCaptcha', $method );
	}


	/**
	 * Verify if the response is valid
	 *
	 * @param $response
	 * @param $remoteIp
	 *
	 * @return null
	 */
	public function verify( $response, $remoteIp ) {
		if ( $this->is_method_exists( 'verify' ) ) {
			return $this->get_recaptcha_instance()->verify( $response, $remoteIp );
		}

		return null;
	}


	/**
	 * Check if the response is successful
	 */
	public function is_success() {
		if ( $this->is_method_exists( 'isSuccess' ) ) {
			$this->get_recaptcha_instance()->isSuccess();
		}
	}

	/**
	 * Get any error that was return
	 */
	public function get_error_codes() {
		if ( $this->is_method_exists( 'getErrorCodes' ) ) {
			$this->get_recaptcha_instance()->getErrorCodes();
		}
	}

	/**
	 * Display recaptcha field
	 *
	 * @param $page
	 *
	 * @return string
	 */
	public function the_recaptcha_field( $page ) {
		global $pagenow;

		$field_enabled = $this->get_skelet()->get( 'enable_google_recaptcha' );
		$output        = '';
		$page_list     = array( 'wp-login.php' );
		$page_list     = apply_filters( 'palo_recaptcha_default_page', $page_list );

		if ( is_array( $field_enabled ) && in_array( $page, $field_enabled ) ) {
			if ( in_array( $pagenow, $page_list ) ) {
				$output .= '<div class="g-recaptcha" data-sitekey="' . esc_attr( $this->get_sitekey() ) . '"></div>
		<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=en"></script>';
			} else {
				$output .= '<div id="' . $page . '" class="palo-recaptcha"></div>';
			}

		}

		return $output;
	}

	/**
	 * Check if recaptcha is enabled
	 *
	 * @param $page
	 *
	 * @return bool
	 */
	public function is_recaptcha_enabled( $page ) {
		$enabled_recaptcha = $this->get_skelet()->get( 'enable_google_recaptcha' );

		return ( is_array( $enabled_recaptcha ) && in_array( $page, $enabled_recaptcha ) ) ? true : false;
	}

	/**
	 * Die method to display message on failed on password reset
	 */
	public function recaptcha_message() {
		return wp_kses( sprintf( __( '<strong>%s</strong>: %s', 'pressapps-login-access' ),
			'ERROR',
			'Captcha Verification Failed!' ),
			array( 'strong' => array() )
		);
	}

}