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
<style>
* {}

/* font: main */
p {
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($main_font['name']); ?> !important;
    <?php endif; ?>
}
/* font: main */
/* font: secondary */
.stm_testimonials_style_24 .stm_testimonials__info h6 {
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($secondary_font['name']); ?> !important;
    <?php endif; ?>
}
/* font: secondary */


/* text-color: main-color */
.stm_custom_menu_style_2 .menu li a:hover,
.stm_pricing-table_style_8 .stm_pricing-table__footer .btn,
.stm_pricing-table_style_8:hover .stm_pricing-table__pricing {
    color: <?php echo esc_attr($main_color) ?> !important;
}
/* text-color: main-color */
/* text-color: secondary-color */
/* text-color: secondary-color */
/* text-color: third-color */
#free_preview_form .btn:hover,
.stm_testimonials_style_24 .stm_testimonials__info h6 {
    color: <?php echo esc_attr($third_color) ?> !important;
}
/* text-color: third-color */


/* background-color: main-color */
.stm_infobox_style_14 .stm_infobox__content .btn,
.stm_pricing-table_style_8 .stm_pricing-table__content ul li:before,
.stm_pricing-table_style_8 .stm_pricing-table__footer .btn:hover,
.stm_pricing-table_style_8:hover .stm_pricing-table__pricing:before,
.stm_pricing-table_style_8:hover .stm_pricing-table__pricing:after,
.stm_icon_links.stm_icon_links_style_1 a {
    background-color: <?php echo esc_attr($main_color) ?> !important;
}
/* background-color: main-color */
/* background-color: secondary-color */
.stm_layout_taxi .owl-carousel .owl-dot {
    background-color: <?php echo esc_attr($secondary_color) ?> !important;
}
/* background-color: secondary-color */
/* background-color: third-color */
.stm_icon_links.stm_icon_links_style_1 a:hover {
    background-color: <?php echo esc_attr($third_color) ?> !important;
}
/* background-color: third-color */

.stm_pricing-table_style_8:hover {
    border-color: <?php echo esc_attr($main_color) ?> !important;
    box-shadow: inset 0 0 0 2px <?php echo esc_attr($main_color) ?>;
}
.stm_testimonials_style_24 .image_dots .dots:after,
.stm_pricing-table_style_8 .stm_pricing-table__footer .btn {
    border-color: <?php echo esc_attr($main_color) ?> !important;
}



.button,
.btn {
    padding: 10px 30px !important;
    line-height: 26px !important;
    text-align: center;
    text-transform: uppercase !important;
    border-radius: 30px !important;
    border-width: 2px;
}
.btn_primary {
    min-width: 176px !important;
}
.btn_fullwidth {
    line-height: 1.3 !important;
}


/* header */
.mini-cart__actions {
    text-align: center;
}
.mini-cart__actions .btn {
    padding: 10px 30px !important;
}
.mini-cart a.mini-cart__action-link {
    margin-left: 0;
}
/* header */

/* banner */
.hero_img img {
    max-width: 140%;
}
/* banner */

/* icon box */
.stm_layout_book .stm_iconbox_style_12 .stm_iconbox__icon {
    margin-bottom: 20px !important;
}
.stm_layout_book .stm_iconbox_style_12 .stm_iconbox__text h5 {
    margin-bottom: 10px !important;
}
.stm_layout_book .stm_iconbox_style_12 .stm_iconbox__desc p {
    font-size: 14px !important;
    line-height: 20px !important;
    margin-bottom: 37px;
}
/* icon box */

/* partners */
.home .stm_partners_style_3 {
    padding-top: 27px;
}
/* partners */

/* topics */
.stm_layout_book .custom-list__outline-dots ul {
    list-style-type: none;
}
.stm_layout_book .custom-list__outline-dots ul li {
    position: relative;
}
.stm_layout_book .custom-list__outline-dots ul li:before {
    content: '';
    width: 10px;
    height: 10px;
    border-radius: 50%;
    border: 3px solid <?php echo esc_attr($main_color) ?>;
    position: absolute;
    background-color: #fff !important;
    left: 0;
    top: 7px;
}
/* topics */


/* icon list */
.stm_icon_links.stm_icon_links_style_1 {}
.stm_icon_links.stm_icon_links_style_1 a {
    line-height: 45px;
    height: 45px;
    width: 45px;
    margin-right: 5px;
    box-shadow: 0 10px 30px 0 rgba(31, 213, 129, 0.3);
}
.stm_icon_links.stm_icon_links_style_1 a {}
/* icon list */


/* free preview form */
#free_preview_form ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
    color: #ffffff;
    opacity: 1; /* Firefox */
}

#free_preview_form :-ms-input-placeholder { /* Internet Explorer 10-11 */
    color: #ffffff;
}

#free_preview_form ::-ms-input-placeholder { /* Microsoft Edge */
    color: #ffffff;
}
#free_preview_form .stm_mailchimp_header {
    display: flex;
    margin-bottom: 37px;
}
#free_preview_form .stm_mailchimp_header img {
    margin-left: -33px;
    margin-top: -117px;
    float: left;
    margin-right: -60px;
}
#free_preview_form .stm_mailchimp_header h2 {
    color: #fff;
    max-width: 200px;
}
#free_preview_form .stm_mailchimp_wrapper {
    background: none;
    height: 50px;
    margin-bottom: 30px;
}
#free_preview_form .stm_mailchimp_wrapper input {
    border: none;
    background: none;
    padding: 14px 30px;
    color: #fff;
    text-transform: none;
    height: 48px;
}
#free_preview_form .btn {
    width: 100%;
}
#free_preview_form .btn:hover {
    background-color: #fff !important;
}
/* free preview form */

/* footer */
.stm-footer {
    text-align: center;
    padding-top: 40px !important;
    border-top: 1px solid #eeeeee;
    background-color: transparent !important;
}
.footer__logo {
    text-align: center;
}
.footer-widgets .stm_custom_menu {}
.footer-widgets .stm_custom_menu ul {
    display: flex;
    justify-content: center;
    margin-top: 17px;
    font-size: 18px;
}
.footer-widgets .stm_custom_menu ul li {
    width: auto;
    float: none;
}
.stm-footer .stm-footer__bottom .stm_markup__content {
    width: 100%;
    opacity: 0.5;
}

.footer__buttons a {
    margin: 0 19px;
}

.stm-footer__bottom {
    padding: 5px 0 33px;
    font-size: 14px;
}
.stm-footer__bottom:before {
    content: none;
}
/* footer */


/* product single */
.stm_layout_book.stm_shop_layout_store.single-product div.product .summary.entry-summary form.cart {
    float: none;
}
/* product single */

/* open hours */
.stm_widget_search.style_1 .widget.widget_search .search-form .form-control {
    height: 50px;
}
.stm_widget_search.style_1 .widget.widget_search .search-form button {
    border-radius: 0;
}
/* open hours */

.stm_layout_book .vc_col-sm-6:nth-of-type(2n+1) {
    clear: none;
}


@media (max-width: 1023px) {
    .stm_mobile__header {
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        padding-bottom: 20px !important;
        padding-top: 20px !important;
    }
    .stm_sticky_header_mobile .stm-header {
        padding-top: 28px;
    }

    .stm_layout_book .stm_titlebox {
        margin-top: 90px;
    }
    .stm-footer .footer-widgets {
        flex-direction: column;
    }
    .stm-footer .footer-widgets aside.widget {
        width: initial;
    }
}
@media (max-width: 992px) {
    .hero_img img {
        max-width: 130%;
    }

    #free_preview_form .stm_mailchimp_header img {
        margin-top: -27px;
        margin-right: -50px;
        height: 170px;
        width: 170px;
    }
}
@media (max-width: 768px) {
    .stm_layout_book .stm_testimonials_style_24 .image_dots .dots {
        margin: 0;
    }
}
@media (max-width: 576px) {
    .footer-widgets .stm_custom_menu ul {
        flex-direction: column;
    }
}
@media (max-width: 550px) {
    .stm_mobile__header {
        
    }
}

/* megamenu fix */
@media (max-width: 1023px) {    
    html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li.menu-item-has-children a, 
    html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li.menu-item-has-children a {
        padding: 15px 15px 15px 0 !important;
        line-height: 24px !important;
    }
    body.stm_header_style_11 .stm-navigation__default > ul > li ul.sub-menu li {
        float: none !important;
    }
    html body .stm-navigation__default ul li.stm_megamenu .sub-menu > li, html body .stm-navigation__fullwidth ul li.stm_megamenu .sub-menu > li {
        margin: 0 !important;
    }
    html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a, 
    html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a {
        color: #000 !important;
    }
}
/* megamenu fix */

</style>