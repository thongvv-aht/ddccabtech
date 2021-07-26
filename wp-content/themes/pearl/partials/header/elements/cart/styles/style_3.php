<?php if( class_exists( 'WooCommerce' )) : ?>
    <div class="cart cart_rounded mbc_h">
        <a href="<?php echo wc_get_cart_url(); ?>">
            <i class="cart__icon fa fa-shopping-cart fa-16px"></i>
            <?php esc_html_e('Cart', 'pearl'); ?>
            <!--Quantitiy-->
            <?php get_template_part('partials/header/elements/cart/quantity'); ?>
        </a>

        <!--Mini cart-->
        <?php get_template_part('partials/header/elements/cart/mini', 'cart'); ?>
    </div>
<?php endif; ?>