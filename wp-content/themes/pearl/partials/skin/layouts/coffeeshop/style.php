<?php
/* Colors */
$main_color = pearl_get_option('main_color');
$secondary_color = pearl_get_option('secondary_color');
$third_color = pearl_get_option('third_color');

/* Fonts */
$fonts = pearl_get_font();
$main_font = $fonts['main'];
$secondary_font = $fonts['secondary'];
?>

* {
    box-sizing: border-box;
}

.stm_layout_coffeeshop #wrapper {
    padding-bottom: 0;
}

.btn {
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($main_font['name']); ?> !important;
    <?php endif; ?>
}

h5 {
    display: flex;
    align-items: center;
}
h5:before, h5:after {
    width: 50px;
    height: 1px;
    display: block;
    margin: 0 10px;
    background-color: #000 !important;
}
h5.text-left:after {
    content: '';
}
h5.text-center {
    justify-content: center;
}
h5.text-center:before, 
h5.text-center:after {
    content: '';
}

blockquote:before,
blockquote:after {
    color: <?php echo esc_attr($third_color); ?> !important;
}
blockquote p {
    color: <?php echo esc_attr($main_color); ?>;
}

.stm_titlebox {
    margin-bottom: 0 !important;
}

.stm_form_style_6 select {
    padding: 0 13px !important;
}


.widget.widget-default.widget_search .search-form button {
    padding: 10px !important;
    margin-top: 0 !important;
}
.stm_widget_categories.style_1 .widgettitle h5:before {
    content: none !important;
}

.wpb_single_image .vc_single_image-wrapper.vc_box_shadow {
    box-shadow: 50px 60px 0 0 <?php echo esc_attr($secondary_color); ?>;

}
.wpb_single_image .vc_single_image-wrapper.vc_box_shadow img {
    box-shadow: none;
}

body.stm_header_style_9.stm_layout_coffeeshop .stm-navigation.stm-navigation__default ul li a {
    text-transform: none;
}


.stm-cart_style_3 .cart a.mini-cart__action-link,
.stm-cart_style_3 .cart a.mini-cart__product-title {
    color: <?php echo esc_attr($main_color) ?> !important;
}




.stm_layout_coffeeshop .stm-navigation ul li.current-menu-item:before {
    opacity: 1;
    visibility: visible;
}
.stm_layout_coffeeshop .stm-navigation__line_bottom > ul > li:before {
    height: 2px;
    width: 30px;
    left: 50%;
    transform: translateX(-50%);
}
.stm_layout_coffeeshop .stm-navigation li.menu-item-has-children li{
    border: none;
}
.stm_layout_coffeeshop .stm-navigation > ul > li.current-menu-parent > a,
.stm_layout_coffeeshop .stm-navigation > ul > li.current-menu-item > a {
    color: #fff !important;
}

.stm_layout_coffeeshop .stm-navigation li.menu-item-has-children li a:hover {
    opacity: .4
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu {
    top: 60%;
}

/* index: about */
.stm_layout_coffeeshop .stm_icon_links_style_5 {
    text-align: left;
}
.stm_layout_coffeeshop .stm_icon_links_style_5 .stm_icon_links_title {
    color: #fff;
    margin-bottom: 12px;
}
.stm_layout_coffeeshop .stm_icon_links_style_5 a {
    margin-left: 0;
}
/* index: about */


/* index: counter */
.stm_layout_coffeeshop .stm-counter_style_1 .stm-counter__value,
.stm_layout_coffeeshop .stm-counter_style_1 .stm-counter__prefix {
    font-size: 36px;
    font-weight: 700;
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($secondary_font['name']); ?>;
    <?php endif; ?>
    color: <?php echo esc_attr($third_color); ?>
}

.stm_layout_coffeeshop .stm-counter_style_1 .stm-counter__label {
    font-size: 16px;
    font-weight: 400;
    text-transform: none;
    margin-top: 5px;
    border-top: 1px solid #ddd;
    padding-top: 5px;
}
/* index: counter */


/* index: open table / reservation */
.stm_open_table_style_2 .stm_open_table__title {}
.stm_layout_coffeeshop .stm_open_table_style_2 .otw-submit-btn {
    background-color: <?php echo esc_attr($third_color); ?>;
}
.stm_layout_coffeeshop .stm_open_table_style_2 .otw-submit-btn:active,
.stm_layout_coffeeshop .stm_open_table_style_2 .otw-submit-btn:focus,
.stm_layout_coffeeshop .stm_open_table_style_2 .otw-submit-btn:hover {
    background-color: <?php echo esc_attr($secondary_color); ?> !important;
    color: <?php echo esc_attr($main_color) ?>;
}
.stm_layout_coffeeshop .stm_open_table_style_2 .stm-select,
.stm_layout_coffeeshop .stm_open_table_style_2 .selectric-wrapper .selectric .button {
    display: none !important;
}
.open-table-widget-datepicker.datepicker-dropdown {
    width: 255px !important;
}
.open-table-widget-datepicker .datepicker-panel > ul {
    width: 100% !important;
}
.open-table-widget-datepicker .datepicker-panel > ul > li[data-view='month current'] {
    width: calc(100% - 60px);
}
.open-table-widget-datepicker .datepicker-panel > ul[data-view] > li {
    width: calc(100% / 7) !important;
}
.stm_open_table_style_2 .otw-input-wrap:before {
    color: <?php echo esc_attr($third_color) ?>;
}
.stm_open_table_style_2 .otw-widget-form-wrap input[type="text"],
.stm_open_table.stm_open_table_style_2 .selectric-wrapper .selectric .label {
  color: #333333 !important;
  font-size: 14px;
  line-height: 25px;
}
.stm_layout_coffeeshop .stm_open_table_style_2 .otw-submit-btn {
    height: 45px;
    border-radius: 0 !important;
}
/* index: open table / reservation */


/* index: shop */

.woocommerce .price > span,
.stm_shop_layout_coffee-shop.single-product .product .summary.entry-summary p.price span, 
.stm_shop_layout_coffee-shop.single-product .product .summary.entry-summary .price span,
.stm_layout_coffeeshop .stm_single_product__meta .price > span,
.stm_layout_coffeeshop .woocommerce ul.stm_products li.product:hover a .price > span {
    color: <?php echo esc_attr($third_color) ?> !important;
    font-weight: 700 !important;
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($main_font['name']); ?> !important;
    <?php endif; ?>
}
.stm_layout_coffeeshop.stm_shop_layout_coffee-shop .woocommerce ul.stm_products li.product .stm_single_product__meta {
    background: transparent none !important;
}
/* index: shop */


/* index: news */
.stm_posts_list_style_17 .stm_posts_list_single__excerpt {
    font-size: 14px !important;
    line-height: 24px !important;
}
.stm_posts_list_style_17 .stm_posts_list_single .footer,
.stm_posts_list_style_17 .stm_posts_list_single .category {
    display: none !important;
}
.stm_posts_list_style_17 .stm_posts_list_single__body {
    padding: 0 0 34px 0 !important;
    margin-bottom: 0 !important;
    border-bottom: none !important;
}
/* index: news */




/* instagram */
.sb_instagram_header,
#sbi_load {
    display: none;
}
#sb_instagram .sbi_photo {
    position: relative;
}
#sb_instagram .sbi_photo:before {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    content: '';
    display: block;
    opacity: 0;
    background-color: rgba(0,0,0,.5);
    transition: opacity .2s;
}
#sb_instagram .sbi_photo:after {
    opacity: 0;
    content: '\f16d';
    font-family: 'FontAwesome';
    font-size: 36px;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background-color: <?php echo esc_attr($third_color) ?>;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    transition: opacity .2s;
}
#sb_instagram .sbi_photo:hover:before,
#sb_instagram .sbi_photo:hover:after {
    opacity: 1;
}
/* instagram */




.stm-footer {
    padding-top: 100px;
}

.stm-footer .footer-widgets {
    padding-bottom: 0;
}

.stm-footer .footer-widgets a {
    color: <?php echo esc_attr($third_color) ?>;
}

.footer-widgets .stm-icontext__icon {
    display: none;
}
.footer-widgets .widget-footer-title h4 {
    font-size: 18px;
    line-height: 24px;
    color: #fff !important;
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($main_font['name']); ?>;
    <?php endif; ?>
}
.stm_layout_coffeeshop .stm-footer__bottom {
    padding-top: 0;
}
.stm_layout_coffeeshop .stm-footer__bottom:before {
    content: none;
}

.stm_layout_coffeeshop .stm-footer__bottom .stm_markup {
    flex-direction: column;
}

.stm-footer__bottom .stm-socials {
    margin-bottom: 60px;
}

.stm-footer__bottom .stm-socials__icon .fa {
    color: #fff !important;
    font-size: 24px;
}
.stm-footer__bottom .stm-socials__icon:hover .fa {
    color: <?php echo esc_attr($third_color) ?> !important;
} 

.stm_layout_coffeeshop.stm_footer_layout_2 .stm-footer__bottom .stm_bottom_copyright {
    max-width: none;
    color: #fff;
}
.stm_layout_coffeeshop.stm_footer_layout_2 .stm-footer__bottom .stm_bottom_copyright a:hover {
    color: <?php echo esc_attr($third_color) ?> !important;
}

.single-image-hover-opacity-0 {
    margin: -100px 0;
}
.single-image-hover-opacity-0 img {
    transition: opacity .3s;
}
.single-image-hover-opacity-0 img:hover {
    opacity: 0;
}

.stm_testimonials .stmicon-star2 {
    color: <?php echo esc_attr($third_color) ?>;
}

.stm_layout_coffeeshop .stm_testimonials_style_21 .owl-dot {
    border-color: <?php echo esc_attr($third_color) ?>;
}
.stm_layout_coffeeshop .stm_testimonials_style_21 .owl-dot.active {
    background-color: <?php echo esc_attr($third_color) ?> !important;
}

.stm_shop_layout_coffee-shop .woo_grid_view_button {
    display: none !important;
}




.home .services_price_list_style_4 .services_pills_container ul {
    border-color: #fff !important;
}

.stmicon-grid_3_13:before {
    content: "\d9011";
}
.stmicon-grid_4_13:before {
    content: "\d9012";
}

.woocommerce:after {
    content: '';
    display: table;
    width: 100%;
}

/* cart */
.woocommerce table.shop_table {
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($main_font['name']); ?>;
    <?php endif; ?>
}
.woocommerce table.shop_table tbody td.product-name {
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($secondary_font['name']); ?>;
    <?php endif; ?>
}
.woocommerce #customer_details h3 {
    color: <?php echo esc_attr($main_color) ?> !important;
}
table.shop_table .cart-subtotal .woocommerce-Price-amount,
table.shop_table .cart-subtotal .woocommerce-Price-amount span {
    font-weight: 400 !important;
}
table.shop_table .product-price span {
    color: <?php echo esc_attr($third_color) ?>;
}
.stmicon-close_13:before {
    content: "\ebc4";
}
.stm_shop_layout_coffee-shop .cart-collaterals .cart_totals_info {
    background: none !important;
    padding: 0 !important; 
}
.cart-subtotal th {
    font-weight: 400 !important;
}
.stm_shop_layout_coffee-shop .cart-collaterals .cart_totals .shop_table tbody tr:first-child th, 
.stm_shop_layout_coffee-shop .cart-collaterals .cart_totals .shop_table tbody tr:first-child td {
    color: #777777 !important;
}
.stm_shop_layout_coffee-shop .cart-collaterals .wc-proceed-to-checkout .checkout-button {
    width: 100%;
    margin-bottom: 0;
}
.stm_shop_layout_coffee-shop .cart-collaterals .wc-proceed-to-checkout {
    padding: 10px 0 0 !important;
}
.stm_shop_layout_coffee-shop .cart-collaterals .wc-proceed-to-checkout .checkout-button:after {
    content: none !important;
}
table.shop_table tfoot {}
table.shop_table tfoot tr + tr th,
table.shop_table tfoot tr + tr td {
    border-top: none !important;
}
table.shop_table tfoot .order-total {}
table.shop_table tfoot .order-total th {
    text-transform: uppercase;
}
.stm_shop_layout_coffee-shop .woocommerce .checkout_coupon input[type="text"],
.woocommerce .checkout input[type="text"],
.woocommerce .checkout input[type="tel"],
.woocommerce .checkout input[type="email"],
.woocommerce .checkout select,
.woocommerce .checkout textarea {
    border: 1px solid #dddddd !important;
    background-color: #fff !important;
}
.woocommerce .checkout input[type="text"]:focus,
.woocommerce .checkout input[type="tel"]:focus,
.woocommerce .checkout input[type="email"]:focus,
.woocommerce .checkout select:focus,
.woocommerce .checkout textarea:focus{
    border: 2px solid <?php echo esc_attr($third_color) ?> !important;
}

.woocommerce .coupon #coupon_code {
    height: 35px;
    padding: 5px 20px;
}

.stm_layout_coffeeshop.stm_shop_layout_coffee-shop .woocommerce .woocommerce-info {
    background-color: <?php echo esc_attr($secondary_color) ?> !important;
    border: none !important;
}
.stm_shop_layout_coffee-shop .woocommerce .woocommerce-info:after {
    content: none !important;
}
.stm_shop_layout_coffee-shop .woocommerce .woocommerce-info a {
    font-weight: 400 !important;
    text-decoration: underline !important;
}

.stm_layout_coffeeshop.stm_shop_layout_coffee-shop .woocommerce .button {
    background-color: <?php echo esc_attr($main_color) ?> !important;
    color: #fff;
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($main_font['name']); ?>;
    <?php endif; ?>
}
.stm_layout_coffeeshop.stm_shop_layout_coffee-shop .woocommerce .button:hover {
    background-color: <?php echo esc_attr($third_color) ?> !important;
}

.stm_shop_layout_coffee-shop.single-product div.product .summary.entry-summary form.cart {
    float: none !important;
}
.stm_layout_coffeeshop.stm_shop_layout_coffee-shop.single-product div.product .woocommerce-tabs ul.tabs li.active a {
    color: <?php echo esc_attr($main_color) ?> !important;
    font-size: 28px;
    text-transform: none;
}
.stm_layout_coffeeshop .comment-form-rating .stars a,
.stm_layout_coffeeshop .product .star-rating span:before {
    color: <?php echo esc_attr($third_color); ?> !important;
}
.product .posted_in {
    display: none;
}

.stm_layout_coffeeshop.stm_shop_layout_coffee-shop.single-product div.product .summary.entry-summary .product_title {
    font-size: 42px !important;
    text-transform: none !important;
    font-weight: 700 !important;
}
.stm_shop_layout_coffee-shop.single-product div.product .summary.entry-summary p.price span, 
.stm_shop_layout_coffee-shop.single-product div.product .summary.entry-summary .price span {
    font-weight: 700 !important;
    font-size: 24px;
    color: <?php echo esc_attr($third_color); ?> !important;
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($main_font['name']); ?>;
    <?php endif; ?>
}
.stm_shop_layout_coffee-shop.single-product div.product .summary.entry-summary .woocommerce-product-rating {
    display: none !important;
}
.stm_shop_layout_coffee-shop.single-product div.product .summary.entry-summary .single_add_to_cart_button {
    background-color: <?php echo esc_attr($third_color) ?> !important;
}
.stm_shop_layout_coffee-shop.single-product div.product .summary.entry-summary .single_add_to_cart_button:hover {
    background-color: <?php echo esc_attr($main_color) ?> !important;
}
.woocommerce-product-gallery__image:nth-child(n+2):hover img {
    border-color: <?php echo esc_attr($third_color) ?> !important;
}

.product .woocommerce-Tabs-panel--reviews {
    box-shadow: none;
}
.stm_layout_coffeeshop .related.products h2 {
    text-align: center;
    font-size: 42px;
    text-transform: none;
    margin-bottom: 60px;
}

.wpcf7-form-control-wrap {}

.stm_form_style_6 .wpcf7 textarea {
    min-height: 120px !important;
    height: 120px !important;
}

.related_post__title {
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($secondary_font['name']); ?>;
    <?php endif; ?>
}

/* product single */
.woocommerce div.product .woocommerce-tabs ul.tabs li.active {
    background: none !important;
}
/* product single */



/* carousel page */
.stm_pagination_style_10 .stm_carousel .owl-nav .owl-prev:after {
    content: none !important;
}
.stm_carousel .owl-nav .owl-prev:before, 
.stm_carousel .owl-nav .owl-next:before,
.stm_carousel_style_1 .stm_carousel__pagination span {
    color: #fff !important;
}
/* carousel page */

/* donations page */
.stm_donation__progress-bar {
    background-color: <?php echo esc_attr($third_color) ?> !important;
}
/* donations page */

/* projects gallery */
.stm_projects_carousel__name {
    font-size: 22px;
}
/* projects gallery */

/* recent posts */
.stm_post_type_list_style_3 .stm_post_type_list__content:before {
    color: <?php echo esc_attr($third_color) ?> !important;
}
.stm_post_type_list_style_3 .stm_post_type_list__single:hover h4 {
    color: <?php echo esc_attr($main_color) ?> !important;
}
/* recent posts */

/* services price list */
.services_price_list_style_2 .service__badge,
.services_price_list_style_1 .service__badge,
.services_price_list_style_1.services_price_list_tabs .services_pills_container > ul > li.active a {
    background-color: <?php echo esc_attr($third_color) ?> !important;
}
/* services price list */

/* staff grid */
.stm_staff_grid_style_4 .stm_staff__socials li a {
    color: #000 !important;
}
.stm_staff_grid_style_4 .stm_staff__socials li a:hover {
    color: <?php echo esc_attr($third_color) ?> !important;
}
/* staff grid */

/* Testimonials page */
h3 i.position_top {
    top: -40px;
}
/* Testimonials page */




/* media properties */
@media (min-width: 1024px) {
    .stm_header__row {
        display: flex;
    }
    .stm-header__cell_center {
        flex: 0 0 133px;
    }
    .stm-header__cell_left,
    .stm-header__cell_right {
        flex: 0 1 50%;
    }
    .stm_layout_coffeeshop .stm-navigation li.menu-item-has-children li a {
        color: #000 !important;
    }
    .stm-header__cell_center .stm-header__element {
        margin: 0 !important;
    }
}

@media (max-width: 1023px) {

    .stm_header__cell {
        flex: none;
    }
    .stm_header_style_9 .stm_mobile__header {
        padding: 15px;
        background: rgba(0, 0, 0, .85) !important;
    }
    .stm-header__row_color_center {
        background-image: none !important;
    }
    .stm_mobile__logo img {
        width: 50px;
    }
    .stm_mobile__switcher span {
        background-color: #fff !important;
    }
    .stm_layout_coffeeshop.stm_header_style_9 .stm-header {
        background-color: #000 !important;
        padding-top: 80px;
    }
    .stm_layout_coffeeshop.stm_header_style_9 .stm-header__cell {
        margin-bottom: 0;
    }
    body.stm_header_style_9 .stm-navigation.stm-navigation__default ul {
        padding-top: 0 !important;
        margin: 0;
    }
    body.stm_header_style_9 .stm-navigation.stm-navigation__default ul li {
        padding: 0 !important;
    }
    body.stm_header_style_9 .stm-navigation.stm-navigation__default ul li ul.sub-menu {
        padding: 0 23px !important;
    }
    html body.stm_header_style_9 .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li > a,
    html body.stm_header_style_9 .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li:hover ul.sub-menu > li > a,
    body.stm_header_style_9.stm_layout_coffeeshop .stm-navigation.stm-navigation__default ul li a {
        padding: 11px 0 !important;
        color: #fff !important;
    }
    body.stm_header_style_9.stm_layout_coffeeshop .stm-navigation.stm-navigation__default ul li a:hover {
        opacity: 0.4;
    }
    html body .stm-navigation__default ul li.stm_megamenu .sub-menu > li, 
    html body .stm-navigation__fullwidth ul li.stm_megamenu .sub-menu > li {
        margin: 0 !important;
    }

    body.stm_header_style_9 .stm-navigation.stm-navigation__default ul li.menu-item-has-children.active > a:after {
        transform: rotate(180deg) !important;
    }

    #sb_instagram {
        padding: 0 !important;
    }

    .stm-navigation ul li.menu-item-has-children>a .stm_mobile__dropdown:after {
        border-color: #fff transparent !important;
    }

    html body .stm-navigation__default ul li.stm_megamenu .stm_megaicon,
    .stm_megamenu > ul > li.menu-item-has-children > a > .stm_mobile__dropdown:after {
        display: none !important;
    }

    html body.stm_header_style_9 .stm-navigation__default ul li.stm_megamenu>ul.sub-menu>li:hover ul.sub-menu>li>a {
        color: #fff !important;
    }
}


@media (max-width: 992px) {
    .wpb_single_image .vc_single_image-wrapper.vc_box_shadow {
        box-shadow: 25px 60px 0 0 #f6f0ed !important;
    }
}

@media (max-width: 767px) {
    .stm_layout_coffeeshop .stm_icon_links_style_5 {
        text-align: center;
    }
    .stm_sticky_header_placeholder {
        display: none !important;
    }
    .stm_layout_coffeeshop .stm_icon_links_style_5 .stm_icon_links_title {
        color: #000;
    }
    .stm_layout_coffeeshop .stm_icon_links_style_5 a {
        color: #000 !important;
    }
    #sb_instagram.sbi_col_6 #sbi_images .sbi_item {
        width: 33.333% !important;
    }
    h1 {
        text-align: center !important;
    }
    h2, h5 {
        text-align: center !important;
        justify-content: center ;
    }
    h5:before {
        content: '';
    }
    #section--banner h5:before {
        content: none;
    }
    #section--banner .stm_video {
        margin: 0 auto !important;
    }
}
@media (max-width: 640px) {
    #sb_instagram.sbi_col_6 #sbi_images .sbi_item {
        width: 50% !important;
    }
}
@media (max-width: 600px) {
    .stm_icon_links_style_5 a {
        display: inline-block !important;
        width: auto !important;
        margin: 0 12px !important;
    }
}
@media (max-width: 550px) {
    .stm_partners_style_3 .stm_partners__single {
        flex: 0 1 50% !important;
    }
}
@media (max-width: 480px) {
    #sb_instagram.sbi_col_6 #sbi_images .sbi_item {
        width: 100% !important;
    }
}
