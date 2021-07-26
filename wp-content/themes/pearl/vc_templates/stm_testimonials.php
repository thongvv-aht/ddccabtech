<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_style('owl-carousel2');
wp_enqueue_script('pearl-owl-carousel2');

$classes = array('stm_testimonials');
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );
$classes[] = 'stm_testimonials_' . $style;
$classes[] = $el_class;

$atts['classes'] = $classes;

pearl_add_element_style('testimonials', $style);
pearl_load_vc_element('testimonials', $atts, $style);

?>