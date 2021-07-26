<?php
$element = 'stm_infobox_' . $style;

$classes = array('stm_infobox', $element);
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/*Default layout styles*/
$default = pearl_get_layout_config();

pearl_add_element_style('infobox', $style);

$url = (!empty($url)) ? $url : '';
$link_title = (!empty($link_title)) ? $link_title : '';
$tag = (empty($url)) ? 'div' : 'a';

$image_size = (empty($image_size)) ? '700x700' : $image_size;
$image = pearl_get_VC_img($image, $image_size);
?>

<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
    <<?php echo esc_attr($tag) ?> href="<?php echo esc_url($url); ?>" class="stm_infobox__image" target="_blank" rel="nofolow">
        <?php echo wp_kses_post($image); ?>

        <?php if(!empty($url)): ?>
            <span class="stm_infobox__button btn btn_solid btn_third">
                <span class="stm_infobox__title"><?php echo sanitize_text_field($link_title); ?></span>
                <span class="stm_infobox__text"><?php echo wpb_js_remove_wpautop($content, false); ?></span>
            </span>
        <?php endif; ?>
    </<?php echo esc_attr($tag) ?>>
</div>
