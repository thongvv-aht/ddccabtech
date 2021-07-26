<?php
/*Post types modules*/
$pearl_vc_types = get_template_directory() . '/includes/theme/vc/post_types/';

$modules = get_template_directory() . '/includes/theme/vc/modules/';

$vc_types_modules = array(
	'testimonials',
	'projects',
	'vacancies',
	'services',
	'events',
	'stories',
	'donations',
	'music',
	'videos',
	'media_events',
	'products'
);

//WooCommerce
if (class_exists('WooCommerce')) {
	$vc_types_modules[] = 'product';
}

foreach ($vc_types_modules as $vc_types_module) {
	require_once($pearl_vc_types . $vc_types_module . '.php');
}

$vc_modules = array(
	'animation',
	'infobox',
	'icontext',
	'button',
	'recent_posts',
	'services_carousel',
	'staff',
	'iconbox',
	'stats_counter',
	'gallery',
	'pricing_table',
	'pricing_table_flip',
	'products_categories',
	'circle_progress',
	'video',
	'partners',
	'contact',
	'google_map',
	'post_type_list',
	'carousel_gallery',
	'post_timeline',
	'schedule',
	'charts',
	'separator',
	'taxonomy',
	'icon',
	'cf7',
	'icon_list',
	'company_history',
	'vertical_carousel',
	'pages',
	'contacts_widget',
	'opening_hours',
	'call_to_action',
	'post_list',
	'icon_links',
	'opentable_widget',
	'icon_separator',
	'color_presentation',
	'post_prev_next',
	'categories',
	'staff_tabs',
	'breadcrumbs',
	'pages_grid',
	'sliding_images',
	'sliding_images_with_text',
	'tilting_images',
	'floating_gallery',
	'countdown',
	'items_grid',
	'post_carousel',
	'post_video',
	'post_jumbotron',
	'categories_tabs',
	'popular_posts',
	'image_posts_slider',
	'likes_and_share',
	'post_details',
	'waves',
	'ordered_list'
);

/*Modules*/
foreach ($vc_modules as $vc_module) {
	require_once($modules . $vc_module . '.php');
}

add_action('vc_after_init', 'pearl_integrateWithVC');

function pearl_integrateWithVC()
{
	$post_types = pearl_get_post_types();
	$sidebars = pearl_vc_post_type('stm_sidebars');


	vc_map(array(
		'name' => esc_html__('Pearl Spacer', 'pearl'),
		'description' => esc_html__('Empty block for paddings', 'pearl'),
		'base' => 'stm_spacer',
		'icon' => 'icon-wpb-ui-empty_space',
		'category' => esc_html__('Content', 'pearl'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Default Spacer height', 'pearl'),
				'param_name' => 'height',
				'admin_label' => true,
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Tablet (landscape) Spacer height', 'pearl'),
				'param_name' => 'height_tablet_landscape'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Tablet Spacer height', 'pearl'),
				'param_name' => 'height_tablet'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Mobile Spacer height', 'pearl'),
				'param_name' => 'height_mobile'
			),
			pearl_vc_add_css_editor()
		)
	));
	vc_map(array(
		'name' => esc_html__('Pearl Sidebar', 'pearl'),
		'base' => 'stm_sidebar',
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Select sidebar', 'pearl'),
				'param_name' => 'sidebar',
				'value' => $sidebars
			),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));
	vc_map(array(
		'name' => esc_html__('Media Gallery', 'pearl'),
		'base' => 'stm_media_gallery',
		'icon' => 'stmicon-image',
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Title', 'pearl'),
				'param_name' => 'title',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Images Source', 'pearl'),
				'param_name' => 'post_type',
				'value' => $post_types,
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Number of images', 'pearl'),
				'param_name' => 'num',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Image Size', 'pearl'),
				'param_name' => 'size',
				'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl')
			),
			pearl_load_styles(3),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));
}

if (class_exists('WPBakeryShortCode')) {

	class WPBakeryShortCode_Stm_Spacer extends WPBakeryShortCode
	{
	}

	class WPBakeryShortCode_Stm_Sidebar extends WPBakeryShortCode
	{
	}

	class WPBakeryShortCode_Stm_Media_Gallery extends WPBakeryShortCode
	{
	}
}