<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.

/**
 * Framework page settings
 */
$settings = array(
	'header_title' => __( 'Login & Access', 'pressapps' ),
	'menu_title'   => __( 'Login & Access', 'pressapps' ),
	'menu_type'    => 'add_submenu_page',
	'menu_slug'    => 'pressapps-login-access',
	'ajax_save'    => false,
);

/**
 *  Home
 */
/*
$options[] = array(
	'name'   => 'home',
	'title'  => __( 'Home', 'pressapps' ),
	'icon'   => 'si-home2',
	'fields' => array(
		array(
			'type'    => 'heading',
			'content' => __( 'Welcome to Login & Access', 'pressapps' ),
		),

	)
);
*/

/**
 *  Forms options tab and fields settings
 */
$options[] = array(
	'name'     => 'forms',
	'title'    => __( 'Forms', 'pressapps' ),
	'icon'     => 'si-hamburger-menu',
	'sections' => array(
		array(
			'name'   => 'styling_login',
			'title'  => __( 'WP Login', 'pressapps' ),
			'icon'   => 'si-wordpress',
			'fields' => array(
				array(
					'type'    => 'heading',
					'content' => __( 'WP Login', 'pressapps' ),
				),
				array(
					'id'    => 'lp_logo_image',
					'type'  => 'upload',
					'title' => __( 'Logo Image', 'pressapps' )
				),
				array(
					'id'       => 'lp_background_image',
					'type'     => 'upload',
					'title'    => __( 'Background Image', 'pressapps' ),
					'settings' => array(
						'upload_type'  => 'image',
						'button_title' => __( 'Upload', 'pressapps' ),
						'frame_title'  => __( 'Select an image', 'pressapps' ),
						'insert_title' => __( 'Use this image', 'pressapps' ),
					),
				),
				array(
					'id'       => 'lp_background_video',
					'type'     => 'upload',
					'title'    => __( 'Background Video', 'pressapps' ),
					'settings' => array(
						'upload_type'  => 'video',
						'button_title' => __( 'Upload', 'pressapps' ),
						'frame_title'  => __( 'Select a video', 'pressapps' ),
						'insert_title' => __( 'Use this video', 'pressapps' ),
					),
				),
				array(
					'id'    => 'lp_background_color',
					'type'  => 'color_picker',
					'title' => __( 'Background Color', 'pressapps' ),
					'rgba'  => true
				),
				array(
					'id'    => 'lp_form_background_color',
					'type'  => 'color_picker',
					'title' => __( 'Form Background Color', 'pressapps' ),
				),
				array(
					'id'    => 'lp_text_color',
					'type'  => 'color_picker',
					'title' => __( 'Text Color', 'pressapps' ),
				),
				array(
					'id'    => 'lp_links_color',
					'type'  => 'color_picker',
					'title' => __( 'Link Color', 'pressapps' ),
				),
				array(
					'id'    => 'lp_button_text_color',
					'type'  => 'color_picker',
					'title' => __( 'Button Text Color', 'pressapps' ),
				),
				array(
					'id'    => 'lp_button_background_color',
					'type'  => 'color_picker',
					'title' => __( 'Button Background Color', 'pressapps' ),
				),
				array(
					'id'      => 'lp_button_full_width',
					'type'    => 'switcher',
					'title'   => __( 'Full Width Button', 'pressapps' ),
					'default' => false,
				),
			)
		),
		array(
			'name'   => 'modal_login',
			'title'  => __( 'Modal Forms', 'pressapps' ),
			'icon'   => 'si-unchecked-checkbox',
			'fields' => array(
				array(
					'type'    => 'heading',
					'content' => __( 'Modal Forms', 'pressapps' ),
				),
				array(
					'id'      => 'modal_option',
					'type'    => 'radio',
					'title'   => __( 'Form Size', 'pressapps' ),
					'options' => array(
						'modal'      => __( 'Small', 'pressapps' ),
						'fullscreen' => __( 'Fullscreen', 'pressapps' )
					),
					'default' => 'modal'
				),
				array(
					'id'      => 'modal_effect',
					'type'    => 'select',
					'title'   => __( 'Effect', 'pressapps' ),
					'options' => array(
						'hugeinc'      => __( 'Huge Inc', 'pressapps' ),
						'corner'       => __( 'Corner', 'pressapps' ),
						'slidedown'    => __( 'Slide Down', 'pressapps' ),
						'scale'        => __( 'Scale', 'pressapps' ),
						'door'         => __( 'Door', 'pressapps' ),
						//'contentpush'  => __( 'Content Push', 'pressapps' ),
						'contentscale' => __( 'Content Scale', 'pressapps' ),
						'simplegenie'  => __( 'Simple Genie', 'pressapps' ),
					),
					'default' => 'hugeinc'
				),

				array(
					'id'      => 'ml_background_color',
					'type'    => 'color_picker',
					'title'   => __( 'Background Color', 'pressapps' ),
					'default' => '#03A9F4',
				),
				array(
					'id'         => 'ml_form_background_color',
					'type'       => 'color_picker',
					'title'      => __( 'Form Background Color', 'pressapps' ),
					'default'    => '#455A64',
					'dependency' => array( 'palo_modal_option_modal', '==', 'true' )
				),
				array(
					'id'      => 'ml_text_color',
					'type'    => 'color_picker',
					'title'   => __( 'Text Color', 'pressapps' ),
					'default' => '#ffffff',
				),
				/*
				array(
					'id'    => 'ml_links_color',
					'type'  => 'color_picker',
					'title' => __( 'Links Color', 'pressapps' ),
					'default' => '#ffffff',
				),
				*/
				array(
					'id'      => 'ml_button_text_color',
					'type'    => 'color_picker',
					'title'   => __( 'Button Text Color', 'pressapps' ),
					'default' => '#ffffff',
				),
				array(
					'id'      => 'ml_button_background_color',
					'type'    => 'color_picker',
					'title'   => __( 'Button Background Color', 'pressapps' ),
					'default' => '#03A9F4',
				),
				array(
					'id'      => 'ml_input_border_radius',
					'type'    => 'number',
					'title'   => 'Border Radius',
					'after'   => '<i>px</i>',
					'default' => '2',
				),
			)
		),
		array(
			'name'   => 'embed_login',
			'title'  => __( 'Embed Forms', 'pressapps' ),
			'icon'   => 'si-source-code',
			'fields' => array(
				array(
					'type'    => 'heading',
					'content' => __( 'Embed Forms', 'pressapps' ),
				),
				array(
					'id'      => 'em_button_text_color',
					'type'    => 'color_picker',
					'title'   => __( 'Button Text Color', 'pressapps' ),
					'default' => '#ffffff',
				),
				array(
					'id'      => 'em_button_background_color',
					'type'    => 'color_picker',
					'title'   => __( 'Button Background Color', 'pressapps' ),
					'default' => '#03A9F4',
				),
				array(
					'id'      => 'em_button_background_hover_color',
					'type'    => 'color_picker',
					'title'   => __( 'Button Background Hover Color', 'pressapps' ),
					'default' => '#181818',
				),
				array(
					'id'      => 'em_button_full_width',
					'type'    => 'switcher',
					'title'   => __( 'Full Width Button', 'pressapps' ),
					'default' => false,
				),
				array(
					'id'      => 'em_input_border_width',
					'type'    => 'number',
					'title'   => 'Border Width',
					'after'   => '<i>px</i>',
					'default' => '1',
				),
				array(
					'id'      => 'em_input_border_radius',
					'type'    => 'number',
					'title'   => 'Border Radius',
					'after'   => '<i>px</i>',
					'default' => '2',
				),
				array(
					'id'      => 'em_input_border_color',
					'type'    => 'color_picker',
					'title'   => __( 'Input Border Color', 'pressapps' ),
					'default' => '#181818',
				),
				array(
					'id'      => 'em_input_border_focus_color',
					'type'    => 'color_picker',
					'title'   => __( 'Input Border Focus Color', 'pressapps' ),
					'default' => '#03A9F4',
				),
				array(
					'id'      => 'em_input_border_bottom',
					'type'    => 'switcher',
					'title'   => __( 'Bottom Border Only', 'pressapps' ),
					'default' => false,
				),

				array(
					'id'      => 'em_placeholder',
					'type'    => 'switcher',
					'title'   => __( 'Placeholders', 'pressapps' ),
					'desc'    => __( 'Display placeholders instead of labels, applies to text fields only.', 'pressapps' ),
					'default' => false,
					/*
					'options' => array(
						'label'        => __( 'Labels', 'pressapps' ),
						'placeholder'  => __( 'Placebolders All', 'pressapps' ),
					),
					'default' => 'label'
					*/
				),
			)
		),
		array(
			'name'   => 'styling_custom',
			'title'  => __( 'Custom CSS', 'pressapps' ),
			'icon'   => 'si-brush',
			'fields' => array(
				array(
					'type'    => 'heading',
					'content' => __( 'Custom Styles', 'pressapps' ),
				),
				array(
					'id'     => 'custom_css_front_end',
					'type'   => 'textarea',
					'title'  => __( 'Front End Custom CSS', 'pressapps' ),
					'desc'   => __( 'Enter custom CSS for the front-end', 'pressapps' ),
					'before' => '&lt;style&gt;',
					'after'  => '&lt;&sol;style&gt;'
				),
				array(
					'id'     => 'custom_css_login_page',
					'type'   => 'textarea',
					'title'  => __( 'WP Login Custom CSS', 'pressapps' ),
					'desc'   => __( 'Enter custom CSS for WP login page', 'pressapps' ),
					'before' => '&lt;style&gt;',
					'after'  => '&lt;&sol;style&gt;'
				)
			)
		)
	)
);

/**
 * Role Based Access Control
 */
$options[] = array(
	'name'   => 'access_control',
	'title'  => __( 'Access', 'pressapps' ),
	'icon'   => 'si-lock',
	'fields' => array(
		array(
			'type'    => 'heading',
			'content' => __( 'Front End Access', 'pressapps' )
		),
		array(
			'id'              => 'role_based_access',
			'type'            => 'group',
			'title'           => __( 'Role Based Access Control', 'pressapps' ),
			'button_title'    => __( 'Add New Rule', 'pressapps' ),
			'accordion_title' => __( 'Access Control Details', 'pressapps' ),
			'fields'          => array(
				array(
					'id'      => 'user_access_redirect',
					'type'    => 'radio',
					'title'   => __( 'Redirect To', 'pressapps' ),
					'desc'    => __( 'Redirect unauthorised users.', 'pressapps' ),
					'options' => array(
						'login_page' => __( 'Login Page', 'pressapps' ),
						'custom_url' => __( 'Custom URL', 'pressapps' ),
					),
					'default' => 'login_page'
				),
				array(
					'id'         => 'user_access_custom_redirect',
					'type'       => 'text',
					'title'      => __( 'Custom URL', 'pressapps' ),
					'dependency' => array( 'palo_user_access_redirect_custom_url', '==', 'true' )
				),
				array(
					'id'         => 'user_access_role',
					'type'       => 'select',
					'title'      => __( 'User Role', 'pressapps' ),
					'desc'       => __( 'Authorize user roles to access content.', 'pressapps' ),
					'options'    => get_option( 'palo_option_role', array() ),
					'class'      => 'chosen',
					'attributes' => array(
						'placeholder' => __( 'Select a page', 'pressapps' ),
						'multiple'    => 'multiple',
						'style'       => 'width: 150px;'
					)
				),
				array(
					'id'     => 'user_access_control',
					'type'   => 'fieldset',
					'title'  => __( 'Content', 'pressapps' ),
					'desc'   => __( 'Authorize or block content except for the content below.', 'pressapps' ),
					'fields' => array(
						array(
							'id'      => 'user_access_action',
							'type'    => 'select',
							'title'   => __( 'Action', 'pressapps' ),
							'options' => array(
								'authorize_except' => __( 'Authorize All Content', 'pressapps' ),
								'block_except'     => __( 'Block All Content', 'pressapps' ),
							),
							'default' => 'authorize_except',
						),
						array(
							'id'         => 'user_access_page',
							'type'       => 'select',
							'title'      => __( 'Except: Page', 'pressapps' ),
							'options'    => get_option( 'palo_option_pages', array() ),
							'class'      => 'chosen',
							'attributes' => array(
								'placeholder' => __( 'Select a page', 'pressapps' ),
								'multiple'    => 'multiple',
								'style'       => 'width: 150px;'
							),
						),
						array(
							'id'         => 'user_access_cpt',
							'type'       => 'select',
							'title'      => __( 'Except: Post Type', 'pressapps' ),
							'options'    => get_option( 'palo_option_cpt', array() ),
							'class'      => 'chosen',
							'attributes' => array(
								'placeholder' => __( 'Select a post type', 'pressapps' ),
								'multiple'    => 'multiple',
								'style'       => 'width: 150px;'
							),
						),
						array(
							'id'         => 'user_access_tax',
							'type'       => 'select',
							'title'      => __( 'Except: Taxonomy', 'pressapps' ),
							'options'    => get_option( 'palo_option_tax', array() ),
							'class'      => 'chosen',
							'attributes' => array(
								'placeholder' => __( 'Select a taxonomy', 'pressapps' ),
								'multiple'    => 'multiple',
								'style'       => 'width: 150px;'
							),
						),
						array(
							'id'         => 'user_access_post',
							'type'       => 'select',
							'title'      => __( 'Except: Post', 'pressapps' ),
							'options'    => get_option( 'palo_option_cpt', array() ),
							'class'      => 'chosen',
							'attributes' => array(
								'placeholder' => __( 'Select a post', 'pressapps' ),
								'multiple'    => 'multiple',
								'style'       => 'width: 150px;'
							),
						),
						array(
							'id'         => 'user_access_cat',
							'type'       => 'select',
							'title'      => __( 'Except: Category', 'pressapps' ),
							'options'    => get_option( 'palo_option_cat', array() ),
							'class'      => 'chosen',
							'attributes' => array(
								'placeholder' => __( 'Select a category', 'pressapps' ),
								'multiple'    => 'multiple',
								'style'       => 'width: 150px;'
							),
						)
					)
				)
			)
		),
		array(
			'type'    => 'heading',
			'content' => __( 'Dashboard Access', 'pressapps' )
		),
		array(
			'id'      => 'admin_restrict_dashboard',
			'type'    => 'switcher',
			'title'   => __( 'Restrict Dashboard Access', 'pressapps' ),
			'default' => false
		),
		array(
			'id'         => 'admin_user_role',
			'type'       => 'select',
			'title'      => __( 'User Role', 'pressapps' ),
			'options'    => get_option( 'palo_option_role', array() ),
			'class'      => 'chosen',
			'dependency' => array( 'palo_admin_restrict_dashboard', '==', 'true' ),
			'attributes' => array(
				'placeholder' => __( 'Select a page', 'pressapps' ),
				'multiple'    => 'multiple',
				'style'       => 'width: 320px;'
			)
		),
		array(
			'id'         => 'admin_redirect_url',
			'type'       => 'text',
			'title'      => __( 'Redirect URL', 'pressapps' ),
			'dependency' => array( 'palo_admin_restrict_dashboard', '==', 'true' ),
			'default'    => false
		),
		array(
			'type'    => 'notice',
			'class'   => 'danger',
			'content' => 'Consider accress rules carefully, redirecting user to restricted page will lock the user out, creating redirect loop.',
		),
	)
);

/**
 * Google ReCaptcha
 */
$options[] = array(
	'name'   => 'google_recaptcha',
	'title'  => __( 'reCaptcha', 'pressapps' ),
	'icon'   => 'si-protect',
	'fields' => array(
		array(
			'type'    => 'heading',
			'content' => __( 'Google reCaptcha', 'pressapps' ),
		),
		array(
			'id'      => 'enable_google_recaptcha',
			'type'    => 'checkbox',
			'title'   => __( 'Enable reCaptcha', 'pressapps' ),
			'options' => array(
				'login'     => __( 'Login', 'pressapps' ),
				'register'  => __( 'Register', 'pressapps' ),
				'resetpass' => __( 'Password Reset', 'pressapps' )
			),
			'default' => 'login_page'
		),
		array(
			'id'    => 'recaptcha_sitekey',
			'type'  => 'text',
			'title' => __( 'Site Key', 'pressapps' ),
		),
		array(
			'id'    => 'recaptcha_secret',
			'type'  => 'text',
			'title' => __( 'Secret Key', 'pressapps' ),
		),
		array(
			'type'    => 'notice',
			'class'   => 'info',
			'content' => 'Generate reCaptcha keys here <a target="_blank" href="https://www.google.com/recaptcha/intro/index.html">https://www.google.com/recaptcha/intro/index.html</a>.',
		),
	)
);

/**
 * Social Login
 */
$options[] = array(
	'name'   => 'social_login',
	'title'  => __( 'Social Login', 'pressapps' ),
	'icon'   => 'si-profile-avatar',
	'fields' => array(
		array(
			'type'    => 'heading',
			'content' => __( 'Social Login', 'pressapps' ),
		),
		array(
			'id'      => 'facebook_login',
			'type'    => 'switcher',
			'title'   => __( 'Facebook Login', 'pressapps' ),
			'default' => false
		),
		array(
			'type'       => 'subheading',
			'content'    => __( 'Facebook Login', 'pressapps' ),
			'dependency' => array( 'palo_facebook_login', '==', 'true' )
		),
		array(
			'id'         => 'facebook_app_id',
			'type'       => 'text',
			'title'      => __( 'App ID', 'pressapps' ),
			'dependency' => array( 'palo_facebook_login', '==', 'true' )
		),
		array(
			'id'         => 'facebook_app_secret',
			'type'       => 'text',
			'title'      => __( 'App Secret', 'pressapps' ),
			'dependency' => array( 'palo_facebook_login', '==', 'true' )
		),
		array(
			'id'         => 'facebook_login_text',
			'type'       => 'text',
			'title'      => __( 'Facebook Login Button Text', 'pressapps' ),
			'dependency' => array( 'palo_facebook_login', '==', 'true' ),
			'default'    => 'Sign in with Facebook'
		),
		array(
			'type'       => 'notice',
			'class'      => 'info',
			'dependency' => array( 'palo_facebook_login', '==', 'true' ),
			'content'    => '
                <h2>How to Generate <strong>App ID</strong> and <strong>App Secret</strong>?</h2>
                <ol>
                <li>Go to <a href="https://developers.facebook.com/" target="_blank">https://developers.facebook.com/</a> ( requires to sign in with facebook account ).</li>
                <li>Click on <strong>My Apps</strong>, then under the dropdown select <strong>Add a New App</strong>.</li>
                <li>A list of choice will popup through a modal after clicking <strong>Add a New App</strong>, select <strong>Website</strong>.</li>
                <li>It will redirect you to <strong>Quick Start for Website</strong>, just type in the <strong>name</strong> for the new App and click <strong>Create New Facebook App ID</strong>.</li>
                <li>It will prompt you with a message <strong>Create (name of the app) App?</strong>, select a <strong>Category</strong> then click <strong>Create App ID</strong>.</li>
                <li>It will redirect you to a page named <strong>Setup the Facebook SDK for JavaScript</strong>.</li>
                <li>Scroll down under <strong>Tell us about your website</strong> there is a text field which is <strong>Site URL</strong>, then type in the url of your website.</li>
                <li>After it if you will scroll down you can see a <strong>Finished!</strong> text with a check icon, then your done.</li>
                <li>Just <strong>refresh</strong> the page and you will be able to see under <strong>My Apps</strong> the new App that you created.</li>
                <li>When you click on your new App you will be able to see <strong>App ID</strong> , <strong>API Version</strong>, <strong>App Secret</strong>.</li>
                </ol>
                '
		),
		array(
			'id'      => 'twitter_login',
			'type'    => 'switcher',
			'title'   => __( 'Twitter Login', 'pressapps' ),
			'default' => false
		),
		array(
			'type'       => 'subheading',
			'content'    => __( 'Twitter Login', 'pressapps' ),
			'dependency' => array( 'palo_twitter_login', '==', 'true' )
		),
		array(
			'id'         => 'twitter_api_key',
			'type'       => 'text',
			'title'      => __( 'Consumer Key (API Key)', 'pressapps' ),
			'dependency' => array( 'palo_twitter_login', '==', 'true' )
		),
		array(
			'id'         => 'twitter_api_secret',
			'type'       => 'text',
			'title'      => __( 'Consumer Secret (API Secret)', 'pressapps' ),
			'dependency' => array( 'palo_twitter_login', '==', 'true' )
		),
		array(
			'id'         => 'twitter_login_text',
			'type'       => 'text',
			'title'      => __( 'Twitter Login Button Text', 'pressapps' ),
			'dependency' => array( 'palo_twitter_login', '==', 'true' ),
			'default'    => 'Sign in with Twitter'
		),
		array(
			'type'       => 'notice',
			'class'      => 'info',
			'dependency' => array( 'palo_twitter_login', '==', 'true' ),
			'content'    => '
                <h2>How to Generate <strong>Consumer Key (API Key)</strong> and <strong>Consumer Secret (API Secret)</strong>?</h2>
                <h3>You must add your mobile phone to your Twitter profile before creating an application.</h3>
                <ol>
                <li>Go to <a href="https://apps.twitter.com/" target="_blank">https://apps.twitter.com/</a> ( requires to sign in with twitter account ).</li>
                <li>Click on <strong>Create New App</strong> button, then fill up the <strong>Application Details</strong> including <strong>Callback URL</strong> which is the home url.</li>
                <li>You can access your new app, then go to <strong>Keys and Access Tokens</strong> tab.</li>
                <li>Under <strong>Application Settings</strong> you can copy your <strong>Consumer Key (API Key)</strong> and <strong>Consumer Secret (API Secret)</strong>.</li>
                </ol>
                '
		),
		array(
			'id'      => 'google_login',
			'type'    => 'switcher',
			'title'   => __( 'Google Login', 'pressapps' ),
			'default' => false
		),
		array(
			'type'       => 'subheading',
			'content'    => __( 'Google Login', 'pressapps' ),
			'dependency' => array( 'palo_google_login', '==', 'true' )
		),
		array(
			'id'         => 'google_client_id',
			'type'       => 'text',
			'title'      => __( 'Client ID', 'pressapps' ),
			'dependency' => array( 'palo_google_login', '==', 'true' )
		),
		array(
			'id'         => 'google_client_secret',
			'type'       => 'text',
			'title'      => __( 'Client Secret', 'pressapps' ),
			'dependency' => array( 'palo_google_login', '==', 'true' )
		),
		array(
			'id'         => 'google_login_text',
			'type'       => 'text',
			'title'      => __( 'Google Login Button Text', 'pressapps' ),
			'dependency' => array( 'palo_google_login', '==', 'true' ),
			'default'    => 'Sign in with Google'
		),
		array(
			'type'       => 'notice',
			'class'      => 'info',
			'dependency' => array( 'palo_google_login', '==', 'true' ),
			'content'    => '
                <h2>How to Generate <strong>Client ID</strong> and <strong>Client Secret</strong>?</h2>
                <ol>
                <li>Go to <a href="https://console.developers.google.com" target="_blank">https://console.developers.google.com</a>.</li>
                <li>Click on <strong>Create a project</strong> under the dropdown.</li>
                <li>In the Project name field, type in a name for your project then click on <strong>Create</strong> button.</li>
                <li>In the sidebar under <strong>API Manager</strong>, select <strong>Credentials</strong>, and click the OAuth consent screen tab. Choose an Email Address, specify a Product Name, and click Save.</li>
                <li>Click <strong>Create a new Client ID</strong>, a dialog box appears.</li>
                <li>In the Application type section of the dialog, select <strong>Web application</strong>.</li>
                <li>In the <strong>Authorized JavaScript origins</strong> field, enter the origin for your app. You can enter multiple origins to allow for your app to run on different protocols, domains, or subdomains. Wildcards are not allowed. ( URL of your website ).</li>
                <li>In the <strong>Authorized redirect URI</strong> field, delete the default value and add <code>' . plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'public/lib/hybridauth/?hauth.done=Google</code> then click <strong>Save</strong>.</li>
                <li><strong style="color:red;font-weight:bold;">IMPORTANT!</strong> Enable Google+ API or your app will not work. To enable Google+ API, in the sidebar under <strong>API Manager</strong>, select <strong>Overview</strong> then click on <strong>Google APIs</strong> tab and under <strong>Social APIs</strong> click on <strong>Google+ API</strong> , then click on <strong>Enable API</strong> button.</li>
                </ol>
                '
		)
	)
);

/**
 *  Registration
 */
$options[] = array(
	'name'   => 'registration',
	'title'  => __( 'Registration', 'pressapps' ),
	'icon'   => 'si-pencil',
	'fields' => array(
		array(
			'type'    => 'heading',
			'content' => __( 'Registration', 'pressapps' ),
		),
		array(
			'id'      => 'users_set_password',
			'type'    => 'switcher',
			'title'   => __( 'User Set Passwords', 'pressapps' ),
			'desc'    => __( 'Allow users to set password during registration', 'pressapps' ),
			'default' => false
		),
		array(
			'id'         => 'display_confirm_password',
			'type'       => 'switcher',
			'title'      => __( 'Display Confirm Password Field', 'pressapps' ),
			'default'    => false,
			'dependency' => array( 'palo_users_set_password', '==', 'true' )
		),
		array(
			'id'         => 'login_user_after_registration',
			'type'       => 'switcher',
			'title'      => __( 'Login User After Registration', 'pressapps' ),
			'default'    => false,
			'dependency' => array( 'palo_users_set_password', '==', 'true' )
		),
		array(
			'id'         => 'approve_user_after_registration',
			'type'       => 'switcher',
			'title'      => __( 'Approve New User Registration', 'pressapps' ),
			'desc'       => __( 'Users registration must be approved by admin before user can login to site.', 'pressapps' ),
			'default'    => false,
			'dependency' => array( 'palo_login_user_after_registration', '!=', 'true' ),
		),
		array(
			'id'         => 'approved_user_notification_emails',
			'type'       => 'switcher',
			'title'      => __( 'Approved User Notification Emails', 'pressapps' ),
			'desc'       => __( 'Send users email notification when their account is approved.', 'pressapps' ),
			'default'    => false,
			'dependency' => array(
				'palo_approve_user_after_registration|palo_login_user_after_registration',
				'==|!=',
				'true|true'
			),
		),
		array(
			'id'         => 'approved_user_email_field',
			'type'       => 'fieldset',
			'title'      => __( 'Approved User Email Template', 'pressapps' ),
			'dependency' => array(
				'palo_approved_user_notification_emails|palo_login_user_after_registration|palo_approve_user_after_registration',
				'==|!=|==',
				'true|true|true'
			),
			'desc'       => __( 'Leave blank to use the default template. Use %user% to include the user on the message field.', 'pressapps' ),
			'fields'     => array(
				array(
					'id'    => 'approved_user_from_email',
					'type'  => 'text',
					'title' => __( 'From Email', 'pressapps' )
				),
				array(
					'id'    => 'approved_user_subject',
					'type'  => 'text',
					'title' => __( 'Subject', 'pressapps' )
				),
				array(
					'id'    => 'approved_user_message',
					'type'  => 'textarea',
					'title' => __( 'Message', 'pressapps' )
				),

			),
		),
		array(
			'id'         => 'disabled_account_notification_emails',
			'type'       => 'switcher',
			'title'      => __( 'Disabled Account Notification Emails', 'pressapps' ),
			'desc'       => __( 'Send users email notification when their account is disabled.', 'pressapps' ),
			'default'    => false,
			'dependency' => array(
				'palo_approve_user_after_registration|palo_login_user_after_registration',
				'==|!=',
				'true|true'
			),
		),
		array(
			'id'         => 'disabled_account_email_field',
			'type'       => 'fieldset',
			'title'      => __( 'Disabled Account Email Template', 'pressapps' ),
			'dependency' => array(
				'palo_disabled_account_notification_emails|palo_login_user_after_registration|palo_approve_user_after_registration',
				'==|!=|==',
				'true|true|true'
			),
			'desc'       => __( 'Leave blank to use the default template. Use %user% to include the user on the message field.', 'pressapps' ),
			'fields'     => array(
				array(
					'id'    => 'disabled_account_from_email',
					'type'  => 'text',
					'title' => __( 'From Email', 'pressapps' )
				),
				array(
					'id'    => 'disabled_account_subject',
					'type'  => 'text',
					'title' => __( 'Subject', 'pressapps' )
				),
				array(
					'id'    => 'disabled_account_message',
					'type'  => 'textarea',
					'title' => __( 'Message', 'pressapps' )
				),
			),
		),
		array(
			'id'    => 'enable_terms_condition',
			'type'  => 'switcher',
			'title' => __( 'Terms and Conditions', 'pressapps' ),
			'desc'  => __( 'Require users to accept terms and conditions during registration.', 'pressapps' ),
		),
		array(
			'id'         => 'modal_terms_condition',
			'type'       => 'select',
			'title'      => __( 'Terms and Condition Page', 'pressapps' ),
			'options'    => 'pages',
			'dependency' => array( 'palo_enable_terms_condition', '==', 'true' ),
		),
		array(
			'id'              => 'custom_fields',
			'type'            => 'group',
			'title'           => __( 'Form Custom Fields', 'pressapps' ),
			'button_title'    => __( 'Add New Field', 'pressapps' ),
			'accordion_title' => __( 'Field Details', 'pressapps' ),
			'fields'          => array(
				array(
					'id'      => 'modal_field_type',
					'type'    => 'select',
					'title'   => __( 'Type', 'pressapps' ),
					'options' => array(
						'checkbox' => __( 'Checkbox', 'pressapps' ),
						'radio'    => __( 'Radio', 'pressapps' ),
						'select'   => __( 'Select', 'pressapps' ),
						'text'     => __( 'Text', 'pressapps' ),
						'textarea' => __( 'Textarea', 'pressapps' ),
					)
				),
				array(
					'id'    => 'modal_field_label',
					'type'  => 'text',
					'title' => __( 'Label', 'pressapps' ),
					'desc'  => __( 'Name of the field that will be displayed on the form.', 'pressapps' ),
				),
				array(
					'id'         => 'modal_field_options',
					'type'       => 'textarea',
					'title'      => __( 'Options', 'pressapps' ),
					'desc'       => __( 'Add each option on a new line. For select or radio type only.', 'pressapps' ),
					'dependency' => array( 'palo_modal_field_type', 'any', 'select,radio' ),
				),
				array(
					'id'    => 'modal_field_required',
					'type'  => 'switcher',
					'desc'  => __( 'Whether this field is required for user to fill in.', 'pressapps' ),
					'title' => __( 'Required', 'pressapps' )
				),
			)
		),
	)
);

/**
 *  Redirection
 */
$options[] = array(
	'name'   => 'redirection',
	'title'  => __( 'Redirection', 'pressapps' ),
	'icon'   => 'si-forward-arrow',
	'fields' => array(
		array(
			'type'    => 'heading',
			'content' => __( 'Redirection', 'pressapps' ),
		),
		array(
			'id'      => 'redirect_after_login',
			'type'    => 'radio',
			'title'   => __( 'Login Redirect', 'pressapps' ),
			'options' => array(
				'disable'                => __( 'Redirect To WP Dashboard', 'pressapps' ),
				'redirect_all'           => __( 'Redirect All Users To URL', 'pressapps' ),
				'role_based_redirection' => __( 'Redirect Users Based On Their Role', 'pressapps' )
			),
			'default' => 'disable'
		),
		array(
			'id'              => 'role_based_redirection',
			'type'            => 'group',
			'title'           => __( 'Login Role Redirection Rules', 'pressapps' ),
			'button_title'    => __( 'Add New Rule', 'pressapps' ),
			'accordion_title' => __( 'Add New Rule', 'pressapps' ),
			'dependency'      => array( 'palo_redirect_after_login_role_based_redirection', '==', 'true' ),
			'fields'          => array(
				array(
					'id'      => 'group_user_role',
					'type'    => 'select',
					'title'   => __( 'User Role', 'pressapps' ),
					'options' => get_option( 'palo_option_role', array() )
				),
				array(
					'id'    => 'group_user_redirect',
					'type'  => 'text',
					'title' => __( 'Redirect URL', 'pressapps' ),
				)
			)
		),
		array(
			'id'         => 'redirect_all_url',
			'type'       => 'text',
			'title'      => __( 'Login Redirect URL', 'pressapps' ),
			'dependency' => array( 'palo_redirect_after_login_redirect_all', '==', 'true' )
		),
		array(
			'id'    => 'redirect_after_logout',
			'type'  => 'text',
			'title' => __( 'Logout Redirect URL ', 'pressapps' )
		),
		array(
			'id'         => 'redirect_after_registration',
			'type'       => 'text',
			'title'      => __( 'Redirect After Registration', 'pressapps' ),
			'dependency' => array( 'palo_users_set_password', '==', 'true' )
		)
	)
);

SkeletFramework::instance( $settings, $options );
