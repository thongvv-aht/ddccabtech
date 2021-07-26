<?php
$element = 'stm_infobox_' . $style;

$classes = array('stm_infobox', $element);
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/*Default layout styles*/
$default = pearl_get_layout_config();
/*Colors*/
$m_color = pearl_get_option('main_color', $default['main_color']);

$inline_styles = ".{$element}:hover .stm_infobox__content {";
$inline_styles .= "background-color: {$m_color};";
$inline_styles .= "}";

pearl_add_element_style('infobox', $style, $inline_styles);

$url = (!empty($url)) ? $url : '';
$link_title = (!empty($link_title)) ? $link_title : '';

$image_size = (empty($image_size)) ? '500x335' : $image_size;
$image = pearl_get_VC_img($image, $image_size);
?>

<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
    <div class="stm_infobox__image">
        <?php echo wp_kses_post($image); ?>
    </div>
    <div class="stm_infobox__content">
        <?php echo wpb_js_remove_wpautop($content, true); ?>
    </div>
</div>