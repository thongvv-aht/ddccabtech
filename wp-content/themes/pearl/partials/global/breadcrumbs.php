<?php

$is_shop = (pearl_is_shop()) ? true : false;
$is_product = (function_exists('is_product') && is_product()) ? true : false;
$is_product_category = (function_exists('is_product_category') && is_product_category()) ? true : false;
$is_product_tag = (function_exists('is_product_tag') && is_product_tag()) ? true : false;
$queried_object = get_queried_object();
$is_product_attribute = ((!empty($queried_object->taxonomy)) && substr($queried_object->taxonomy, 0, 3) == 'pa_') ? true : false;
$classes = array(
    'stm_breadcrumbs',
    'heading-font'
);

if(pearl_check_string(get_post_meta(get_the_ID(), 'page_bc_fullwidth', true))) {
    $classes[] = 'vc_container-fluid-force';
}

if ($is_shop || $is_product || $is_product_category || $is_product_tag || $is_product_attribute) {
    woocommerce_breadcrumb();
} else {
    if (function_exists('bcn_display')) { ?>
        <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
            <div class="container">
                <?php bcn_display(); ?>
            </div>
        </div>
    <?php }
}