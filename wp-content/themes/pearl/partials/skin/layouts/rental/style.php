<?php
    /*Fonts*/
    $fonts = pearl_get_font();

    $main_font = $fonts['main'];
    $secondary_font = $fonts['secondary'];

    /*Colors*/
    $main_color = pearl_get_option('main_color');
    $secondary_color = pearl_get_option('secondary_color');
    $third_color = pearl_get_option('third_color');
?>
.stm_layout_rental.woocommerce .widget_layered_nav ul li,
.stm_layout_rental.woocommerce .widget_product_categories ul li {
    font-family: inherit !important;
}
.stm_layout_rental.woocommerce .widget_layered_nav ul li a,
.stm_layout_rental.woocommerce .widget_product_categories ul li a {
    font-family: inherit !important;
}

.stm_layout_rental.woocommerce .widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle {
    border-radius: 50%;
}

.stm_layout_rental.woocommerce-account .stm_markup {
    padding-top: 0;
}
.stm_layout_rental.woocommerce-account .woocommerce-orders-table .woocommerce-button.view {
    text-transform: none;
    font-size: 14px;
}
.archive.stm_post_style_10 .stm_loop__list .stm_loop__single:hover a{
    color: #fff !important;
}
.archive.stm_post_style_10 .stm_loop__list .stm_loop__single .post_thumbnail{
    margin-bottom: 0;
}

.archive .stm_post_details{
    padding: 15px;
}
.archive .stm_post_details .comments_num a i{
    vertical-align: middle;
}
.archive .stm_post_details .comments_num a{
    color: #fff !important;
}
body.archive .stm_post_details>ul li{
    color: #fff;
}
.archive .stm_post_details ul li:before{
    font-size: 1.5rem;
}
.archive .stm_post_details .comments_num{
    margin: 0 0 0 auto;
}

@media(max-width:1023px) {
    .stm-navigation .stm_megamenu > ul > li.menu-item-has-children > a .stm_mobile__dropdown {
        right: -25px;
    }
    .stm-navigation .stm_megamenu > ul > li.menu-item-has-children > a .stm_mobile__dropdown:after {
        border-color: #fff transparent !important;
        opacity: .45;
    }
}

@media(max-width:550px) {
    .archive .stm_post_details .post_date{
        align-items: start;
    }
    .archive .stm_post_details ul li{
        margin: 0;
    }
    .archive .stm_post_details .post_date{
        height: auto;
    }
    .archive .stm_post_details .comments_num {
        margin: 5px 0 0;
    }
}