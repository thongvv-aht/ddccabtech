<?php
require_once(STM_CONFIGURATIONS_PATH . '/page_importer/helpers/export.php');
require_once(STM_CONFIGURATIONS_PATH . '/page_importer/helpers/import.php');


add_action('admin_enqueue_scripts', 'pearl_page_layouts_importer');

function pearl_page_layouts_importer()
{
	$assets_url = STM_CONFIGURATIONS_URL . '/page_importer/assets';

	wp_enqueue_script('pearl_pli_main', $assets_url . '/js/app.js');

	wp_enqueue_style('pearl_pli_main', $assets_url . '/css/app.css');
}


add_action('edit_form_after_title', 'add_content_before_editor');

function add_content_before_editor() {
	require_once(STM_CONFIGURATIONS_PATH . '/page_importer/tpl/button.php');
	require_once(STM_CONFIGURATIONS_PATH . '/page_importer/tpl/pages.php');
}