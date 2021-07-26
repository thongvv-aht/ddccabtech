<?php

$classes = array('stm_pricing-table');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = (!empty($css_animation)) ? $css_animation : '';
$classes[] = (!empty($label_text)) ? 'has-label' : '';
$classes[] = 'stm_pricing-table_' . $style;

pearl_add_element_style('pricing_table', $style);


$button = vc_build_link($button);
?>

<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <div class="stm_pricing-table__inner">

        <?php if (in_array('has-label', $classes)) { ?>
            <span class="stm_pricing-table__label sbc"><?php echo sanitize_text_field($label_text); ?></span>
        <?php } ?>

        <div class="stm_pricing-table__head">
            <?php if ($title) { ?>
                <h5><?php echo sanitize_text_field($title); ?></h5>
            <?php } ?>
            <div class="stm_pricing-table__pricing">
                <?php if (!empty($price_prefix)): ?>
                    <span class="stm_pricing-table__prefix"><?php echo sanitize_text_field($price_prefix); ?></span>
                <?php endif; ?>
                <?php if (!empty($price)): ?>
                    <span class="stm_pricing-table__price"><?php echo sanitize_text_field($price); ?></span>
                <?php endif; ?>
                <?php if (!empty($price_separator)): ?>
                    <span class="stm_pricing-table__separator"><?php echo sanitize_text_field($price_separator); ?></span>
                <?php endif; ?>
                <?php if (!empty($price_postfix)): ?>
                    <span class="stm_pricing-table__postfix"><?php echo sanitize_text_field($price_postfix); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="stm_pricing-table__content">
            <?php echo wpb_js_remove_wpautop($content, true); ?>
        </div>
        <?php if ($button['url'] != '') { ?>
            <a href="<?php echo esc_url($button['url']); ?>"
               class="btn btn_solid"
               target="<?php echo(($button['target'] == '') ? '_self' : $button['target']); ?>">
                <span><?php echo sanitize_text_field($button['title']); ?></span>
            </a>
        <?php } ?>

    </div>
</div>