<?php

add_action( 'wp_enqueue_scripts', 'pearl_child_enqueue_parent_styles' );

function pearl_child_enqueue_parent_styles() {
	wp_enqueue_style( 'child-style', get_stylesheet_uri());
	// wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri().'/fontawesome.css' );
	wp_enqueue_style( 'company-stm', '/wp-content/uploads/stm_fonts/stmicons/company/stmicons.css' );
	//wp_enqueue_style( 'custom', get_stylesheet_directory_uri().'/styles.css', '', time());
	wp_enqueue_style( 'custom', get_stylesheet_directory_uri().'/custom.css', '', time());
}

add_action( 'wp_enqueue_scripts', 'pearl_child_enqueue_parent_js' );

function pearl_child_enqueue_parent_js() {
	wp_enqueue_script(
		'child-js',
		get_theme_file_uri() . '/custom.js',
		array( 'jquery' ),
		time()
	);
}

function add_cors_http_header(){
	header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');