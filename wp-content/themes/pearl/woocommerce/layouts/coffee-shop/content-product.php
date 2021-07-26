<!--Link start-->
<?php $three_hundred_sixty = get_post_meta(get_the_ID(), 'three_hundred_sixty', true); ?>
<div class="stm_single_product__image">
    <?php if ($three_hundred_sixty == 'true') : ?>
        <div class="store-360">
            <span class="stmicon-store-360"></span>
        </div>
    <?php endif; ?>
    <!--Image, onsale label-->
    <?php do_action('woocommerce_before_shop_loop_item_title'); ?>

    <div class="stm_single_product__button_selectors">
        <!--Add to cart, link end-->
        <?php do_action('woocommerce_after_shop_loop_item'); ?> 
    </div>

</div>

<?php do_action('woocommerce_before_shop_loop_item'); ?>

<div class="stm_single_product__meta">
    <!--Title-->
    <?php do_action('woocommerce_shop_loop_item_title'); ?>

    <!--Price, rating-->
    <?php do_action('woocommerce_after_shop_loop_item_title'); ?>

</div>
</a>