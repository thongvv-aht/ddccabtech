<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'stm_services_tabs ' . $el_class . vc_shortcode_custom_css_class($css, ' '), $this->settings['base'], $atts);

$classes = array('mbdc');

$classes[] = 'services_price_list';
$classes[] = "services_price_list_{$style}";
$classes[] = "services_price_list_{$layout}";
$classes[] = $css_class;

if ($lightbox === 'enable') {
	wp_enqueue_script('lightgallery.js');
	wp_enqueue_style('lightgallery');
}

$uniq = uniqid('price_list_');


$link = !empty($link) ? vc_build_link($link) : '';


if (!empty($link) && !empty(array_filter($link))) {
	$classes[] = "services_price_list_has_button";
}
if (!empty($title)) {
	$classes[] = 'services_price_list_has_title';
}

$atts['classes'] = $classes;

pearl_add_element_style('price_list', $style);
pearl_load_vc_element('price_list', $atts, $style);

?>