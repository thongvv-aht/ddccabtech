<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = array('stm_contact');
$classes[] = 'stm_contact_' . $style;
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );
$classes[] = (empty($name)) ? 'stm_contact_noname' : '';

$image = pearl_get_VC_img($image, $image_size);
$classes[] = (empty($name)) ? 'nameless' : 'named';

$atts['image'] = $image;
$atts['classes'] = $classes;

pearl_add_element_style('contact', $style);
pearl_load_vc_element('contact', $atts, $style);

?>
