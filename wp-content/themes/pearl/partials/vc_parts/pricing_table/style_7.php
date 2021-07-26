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
        <div class="stm_pricing-table__head">
            <?php if ($title_icon) { ?>
                <i class="stm_pricing-table__head-icon <?php echo esc_attr( $title_icon ); ?>"></i>
            <?php } ?>
            <?php if ( $title ) { ?>
                <span class="h3 text-uppercase"><?php echo sanitize_text_field( $title ); ?></span>
            <?php } ?>

        </div>
        <div class="stm_pricing-table__content">
            <?php echo wpb_js_remove_wpautop( $content, true ); ?>
        </div>
        <div class="stm_pricing-table__footer">

            <div class="stm_pricing-table__pricing">
                <?php if(!empty($price_prefix)): ?>
                    <span class="stm_pricing-table__prefix"><?php echo sanitize_text_field($price_prefix); ?></span>
                <?php endif; ?>
                <?php if(!empty($price)): ?>
                    <span class="stm_pricing-table__price"><?php echo sanitize_text_field($price); ?></span>
                <?php endif; ?>
                <?php if(!empty($price_separator)): ?>
                    <span class="stm_pricing-table__separator"><?php echo sanitize_text_field($price_separator); ?></span>
                <?php endif; ?>
                <?php if(!empty($price_postfix)): ?>
                    <span class="stm_pricing-table__postfix"><?php echo sanitize_text_field($price_postfix); ?></span>
                <?php endif; ?>
            </div>
            <ul class="stm_pricing-table__list">
                <?php foreach (vc_param_group_parse_atts($list) as $list_item): ?>
                    <li class="stm_pricing-table__list-item">
                        <?php if ($list_item['list_icon']) { ?>
                            <i class="stm_pricing-table__list-icon <?php echo esc_attr($list_item['list_icon']) ?>"></i>
                        <?php } ?>
                        <?php if(!empty($list_item['list_label_text'])): ?>
                            <span class="stm_pricing-table__list-label"><?php echo sanitize_text_field($list_item['list_label_text']); ?></span>
                        <?php endif; ?>
                        <?php if(!empty($list_item['list_value_text'])): ?>
                            <span class="stm_pricing-table__list-value"><?php echo sanitize_text_field($list_item['list_value_text']); ?></span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
        <?php if( in_array('has-label', $classes) ) { ?>
            <span class="stm_pricing-table__label"><?php echo sanitize_text_field( $label_text ); ?></span>
        <?php } ?>
    </div>
</div>