<?php
/*Enqueue styles and scripts only for admin*/
add_action('admin_enqueue_scripts', 'pearl_admin_styles');
function pearl_admin_styles($hook)
{
	$theme_info = pearl_get_assets_path();

	/* GLOBAL CSS */
	wp_enqueue_style('pearl-admin-styles', $theme_info['admin_css'] . 'styles.css', null, $theme_info['v'], 'all');
	wp_enqueue_style('pearl-vc-styles', $theme_info['admin_css'] . 'vendors/vc/vc.css', null, $theme_info['v'], 'all');

    wp_enqueue_style('pearl_default_google_font', pearl_google_fonts('Exo', 'Open Sans'), null, $theme_info['v'], 'all');
    wp_enqueue_style('pearl-gutenberg-styles', $theme_info['admin_css'] . 'gutenberg/style.css', null, $theme_info['v'], 'all');

	/* GLOBAL JS */
	if($hook !== 'pearl_page_pearl-theme-options') {
		wp_enqueue_script('wp-color-picker-alpha', $theme_info['admin_js'] . 'wp-color-picker-alpha.js', array('wp-color-picker'), $theme_info['v'], true);
	}


	if ($hook === 'widgets.php') {
		wp_enqueue_script( 'stm_widgets', $theme_info['admin_js'] . 'stm_widgets.js', array( 'backbone', 'jquery' ), $theme_info['v'], true );
		wp_enqueue_script('jquery-ui-autocomplete');
	}

	switch ($hook) {
		case 'widgets.php':
			wp_enqueue_script( 'stm_widgets', $theme_info['admin_js'] . 'stm_widgets.js', array( 'backbone', 'jquery' ), $theme_info['v'], true );
			wp_enqueue_script('jquery-ui-autocomplete');
			break;
		case 'pearl_page_pearl-theme-options' :
			break;
	}

	wp_register_script('fontIconPicker', $theme_info['admin_vendor'] . 'fontIconPicker/jquery.fonticonpicker.min.js', array('jquery'));



	wp_register_style('fontIconPicker', $theme_info['admin_vendor'] . 'fontIconPicker/css/jquery.fonticonpicker.min.css');
	wp_register_style('fontIconPicker-grey-theme', $theme_info['admin_vendor'] . 'fontIconPicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css');
	wp_register_style('font-awesome', $theme_info['admin_vendor'] . 'font-awesome/css/font-awesome.min.css');

	ob_start();
	get_template_part('includes/admin/theme_options/font-preview.css');
	wp_add_inline_style('pearl-admin-styles', ob_get_clean());

}

add_action('admin_head', 'pearl_custom_admin_styles');
function pearl_custom_admin_styles() {
	echo html_entity_decode("<link rel='stylesheet' href='" . esc_url(pearl_google_fonts()) . " ' type='text/css' media='all' />");
}