<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);

extract($atts);

$atts['content'] = (!empty($content)) ? $content : '';
$atts['css_animation'] = (!empty($css_animation)) ? $css_animation : '';

pearl_load_vc_element('pricing_table', $atts, $style);