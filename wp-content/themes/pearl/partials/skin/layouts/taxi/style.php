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
  
    .vc_section {
        padding-top: 30px !important;
        padding-bottom: 30px !important;
    }

    .home h1 {
        position: relative;
    }
    .home h1:before {
        content: "";
        width: 6px;
        height: 85%;
        position: absolute;
        top: 50%;
        left: -20px;
        transform: translateY(-50%);
        display: inline-block;
    }
    .home .banner_image {
        width: 882px;
        margin-left: -25%;
        margin-top: 100px;
    }
    
    /* text-color: main-color */
    .stm-header__element .btn_extended.btn_solid:hover .stm-button__description,
    .stm_layout_taxi .stm_testimonials_style_21 .stm_testimonials__stars i,
    .stm_layout_taxi .stm_testimonials_style_22 .stm_testimonials__avatar:after,
    .stm_layout_taxi.home .mc4wp-form .btn,
    .stm-socials__icon:hover,
    html body.stm_header_style_11 .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li.active > a,
    html body.stm_header_style_11 .stm-navigation__default ul li.stm_megamenu > ul.sub-menu li.active > a,
    .stm_layout_taxi .stm_custom_menu_style_1 .menu li a:hover,
    .wpcf7-form button.wpcf7-submit.wpcf7-form-control:hover {
        color: <?php echo esc_attr($main_color) ?> !important;
    }
    /* text-color: main-color */
    /* text-color: secondary-color */
    /* text-color: secondary-color */
    /* text-color: third-color */
    html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li, 
    html body.stm_layout_taxi .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li.menu-item-has-children a,
    .stm-header__element .btn_extended.btn_solid,
    .stm_layout_taxi .stm-counter_style_6 .stm-counter__value,
    .stm_layout_taxi .stm-counter_style_6 .stm-counter__prefix,
    .stm_layout_taxi .stm-counter_style_6 .stm-counter__label,
    .stm_iconbox.stm_iconbox_style_1 .stm_iconbox__icon i,
    .stm-footer .footer-widgets .widget.widget-default.widget-footer .widgettitle.widget-footer-title h4,
    html body ul li.stm_megamenu > ul.sub-menu > li > a,
    .wpcf7-form button.wpcf7-submit.wpcf7-form-control,
    .stm_layout_taxi.home .mc4wp-form .btn:hover {
        color: <?php echo esc_attr($third_color) ?> !important;
    }
    /* text-color: third-color */


    /* background-color: main-color */
    .stm-header__element .btn_extended.btn_solid i,
    .home h1:before,
    .stm_layout_taxi .stm_pricing-table_style_7 .stm_pricing-table__pricing:after,
    .stm_iconbox.stm_iconbox_style_1 .stm_iconbox__icon,
    .stm_layout_taxi .owl-carousel .owl-dot.active,
    .stm_layout_taxi .stm_testimonials_style_22 .stm_testimonials__avatar:before,
    .stm-footer .footer-widgets .widget-footer.stm_custom_menu ul li:before,
    .stm-socials__icon,
    .stm_layout_taxi .stm_donation_style_1 .stm_donation__progress-bar,
    .wpcf7-form button.wpcf7-submit.wpcf7-form-control,
    .stm_layout_taxi.home .mc4wp-form .btn:hover {
        background-color: <?php echo esc_attr($main_color) ?> !important;
    }
    /* background-color: main-color */
    /* background-color: secondary-color */
    .stm_layout_taxi .owl-carousel .owl-dot {
        background-color: <?php echo esc_attr($secondary_color) ?> !important;
    }
    /* background-color: secondary-color */
    /* background-color: third-color */
    .stm_layout_taxi .stm-counter_style_6:before,
    .stm_layout_taxi.home .mc4wp-form .btn,
    .stm-socials__icon:hover,
    .wpcf7-form button.wpcf7-submit.wpcf7-form-control:hover {
        background-color: <?php echo esc_attr($third_color) ?> !important;
    }
    /* background-color: third-color */

    .btn {
        text-align: center !important;
    }

    /* header */
    .stm-header__element .btn_extended.btn_solid {
        width: auto;
        height: 45px;
        border: none;
        background: none !important;
        padding: 0 0 0 60px !important;
        text-align: left !important;
    }
    .stm-header__element .btn_extended.btn_solid:hover {
        background: none !important;
    }
    .stm-header__element .btn_extended.btn_solid i {
        font-size: 21px;
        width: 45px;
        height: 45px;
        line-height: 48px;
        border-radius: 50%;
        text-align: center;
        top: 0;
        left: 0;
        transform: none;
        transition: all .2s;
    }
    .stm-header__element .btn_extended.btn_solid:hover i {
        font-size: 25px;
    }
    .stm-header__element .btn_extended.btn_solid .stm-button__text {
        font-size: 14px;
        margin: 5px 0 2px;
    }
    .stm-header__element .btn_extended.btn_solid .stm-button__description {
        font-size: 18px;
        line-height: 1;
        font-weight: bold;
        letter-spacing: 0.4px;
        transition: color .3s;
    }

    .stm_layout_taxi .stm-navigation {
        margin-right: 30px;
    }
    .stm_layout_taxi .stm-navigation > ul > li > a {
        padding: 0 15px !important;
        text-transform: uppercase;
    }
    .stm-header__row_color_center.pearl_sticked {
        padding: 10px 0;
    }
    /* header */


    /* index: counters */
    .stm_layout_taxi .stm-counter_style_6 {
        margin-bottom: 20px;
        position: relative;
    }
    .stm_layout_taxi .wpb_column + .wpb_column .stm-counter_style_6:before {
        content: '';
        width: 1px;
        height: 100%;
        opacity: .2;
        display: block;
        position: absolute;
        top: 50%;
        left: -15px;
        transform: translate(-50%, -50%);
    }
    .stm_layout_taxi .stm-counter_style_6 .stm-counter__value {
        font-size: 46px;
    }
    .stm_layout_taxi .stm-counter_style_6 .stm-counter__prefix {
        font-size: 46px;
        margin-left: 0;
    }
    .stm_layout_taxi .stm-counter_style_6 .stm-counter__label {
        margin-top: 10px;
        font-size: 17px;
    }
    /* index: counters */

    /* index: iconbox */
    .stm_iconbox.stm_iconbox_style_1 {
        padding: 27px 5px;
        border: none;
        margin: 0 auto;
        max-width: 320px;
    }
    .stm_iconbox.stm_iconbox_style_1 .stm_iconbox__icon {
        width: 60px !important;
        height: 60px !important;
        border-radius: 50%;
        margin-bottom: 30px !important;
        justify-content: center;
        align-items: center;
        display: flex;
        font-size: 20px;
    }
    .stm_iconbox.stm_iconbox_style_1 .stm_iconbox__text h5 {
        text-transform: uppercase;
        line-height: 24px;
        letter-spacing: 1px;
    }
    .stm_iconbox.stm_iconbox_style_1 .stm_iconbox__text p {
        font-size: 16px;
        line-height: 24px;
    }
    /* index: iconbox */


    /* index: order taxi now */
    .order_now_image {
        /* margin: -87px 0 0 0px; */
        width: 553px;
        position: absolute;
        left: -68px;
        bottom: 0;
    }
    /* index: order taxi now */

    /* index: testimonials */
    .stm_layout_taxi .stm_testimonials_style_21 .stm_testimonials__stars i {
        font-size: 24px;
    }
    .stm_layout_taxi .stm_testimonials_style_21 .stm_testimonials__review {
        line-height: 24px;
    }
    .stm_layout_taxi .stm_testimonials_style_21 .owl-dots {
        margin-top: 38px;
    }
    .stm_layout_taxi .owl-carousel .owl-dots {
        display: flex;
    }
    .stm_layout_taxi .owl-carousel .owl-dot {
        width: 10px !important;
        height: 10px !important;
        border: none;
        border-radius: 50%;
        margin-right: 10px
    }
    /* index: testimonials */


    .stm_layout_taxi  .form-group {
        margin-bottom: 30px;
    }

    .wpcf7-form button.wpcf7-submit.wpcf7-form-control {
        height: 50px;
        padding: 0 30px !important;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: bold;
    }
    
    .stm_layout_taxi .stm-button .btn_custom {
        letter-spacing: 1px;
        line-height: 24px;
        text-align: center !important;
        padding: 13px 26px !important;
        width: 180px;
        height: 50px;
        border-radius: 6px;
    }

    /* index: news */

    .stm_layout_taxi .stm_posts_list_style_20 .stm_posts_list_single__image {
        margin: 0;
    }
    .stm_layout_taxi .stm_posts_list_style_20 .stm_posts_list_single__image a {
        display: block;
        position: relative;
        padding-bottom: 63.8%;
        border-radius: 10px;
        overflow: hidden;
    }
    .stm_layout_taxi .stm_posts_list_style_20 .stm_posts_list_single__image img {
        border-radius: 0;
        transform: translate(-50%, -50%);
        display: block;
        width: 100%;
        position: absolute;
        left: 50%;
        top: 50%;
    }
    .stm_layout_taxi .stm_posts_list_style_20 .stm_posts_list_single__body {
        position: static;
        box-shadow: none;
        background: none;
        padding: 36px 30px 30px;
        width: 100%;
    }
    .stm_layout_taxi .stm_posts_list_style_20 .stm_posts_list_single__body h5 {
        line-height: 26px;
        margin-bottom: 9px;
    }
    .stm_layout_taxi .stm_posts_list_style_20 .stm_posts_list_single__body .date {
        font-size: 16px;
        line-height: 24px;
    }
    .stm_layout_taxi .stm_posts_list_style_20 .stm_posts_list_single:hover {
        top: 0;
    }
    .stm_layout_taxi .stm_posts_list_style_20 .stm_posts_list_single:hover .stm_posts_list_single__image img {
        transform: translate(-50%, -50%) scale(1.1);
    }
    .stm_layout_taxi .stm_posts_list_style_20 .stm_posts_list_single:hover {
    }
    .stm_layout_taxi .stm_posts_list_style_20 .stm_posts_list_single__excerpt,
    .stm_layout_taxi .stm_posts_list_style_20 .stm_posts_list_single__info .comments,
    .stm_layout_taxi .stm_posts_list_style_20 .stm_posts_list_single__info i,
    .stm_layout_taxi .stm_posts_list_style_20 .read_more {
        display: none;
    }
    /* index: news */

    /* index: mailchimp form */
    .stm_layout_taxi.home .mc4wp-form {}
    .stm_layout_taxi.home .mc4wp-form-fields {
        display: flex;
    }
    .stm_layout_taxi.home .mc4wp-form .stm_mailchimp_wrapper {
        flex: 1 1 100%;
    }
    .stm_layout_taxi.home .mc4wp-form .stm_mailchimp_wrapper i {
        display: none;
    }
    .stm_layout_taxi.home .mc4wp-form .stm_mailchimp_wrapper input {
        width: 100%;
        height: 50px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border: none;
        text-align: left;
        padding-left: 30px;
    }
    .stm_layout_taxi.home .mc4wp-form .btn {
        margin-top: 0px;
        flex: 0 0 130px;
        height: 50px;
        border-color: <?php echo esc_attr($third_color) ?>;
        border-radius: 0 3px 3px 0;
    }
    /* index: mailchimp form */

    /* footer */
    
    .stm-footer .footer-widgets {
        padding-bottom: 10px;
    }
    .stm-footer .footer-widgets .widget-footer.stm_custom_menu ul li:before {
        content: "";
        width: 5px;
        height: 5px;
        border-radius: 50%;
        top: 6px;
    }

    .stm-socials__icon {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        opacity: 1;
        font-size: 20px !important;
    }
    .stm_layout_taxi.stm_footer_layout_3 .stm-footer__bottom {
        padding: 0 0 40px;
    }
    .stm_layout_taxi.stm_footer_layout_3 .stm-footer__bottom .stm_markup {
        font-size: 14px;
        justify-content: center;
    }
    .stm_layout_taxi.stm_footer_layout_3 .stm-footer__bottom .stm_markup .stm_bottom_copyright {
        margin-bottom: 0;
    }
    /* footer */

    .stm_layout_taxi .stm_widget_search.style_1 .widget.widget_search .search-form button {
        margin: 0;
        padding: 0 !important;
    }

    @media (min-width: 1024px) {
        .stm-footer .footer-widgets .widget-footer.widget_custom_html {
        width: calc(100%/12 * 4);
        }
        .stm-footer .footer-widgets .widget-footer.stm_custom_menu {
            width: calc(100%/6);
        }
    }
    @media (max-width: 1200px) {
        .home .banner_image {
            width: 130%;
            margin-left: -10%;
            margin-top: 0;
        }   
    }
    @media (max-width: 1023px) {
        .stm_layout_taxi.stm_sticky_header_mobile .stm-header {
            padding-top: 50px;
        }
        body.stm_layout_taxi.stm_header_style_11.stm_header_transparent .stm_mobile__header {
            padding-top: 10px;
            padding-bottom: 10px;
            box-shadow: 0 0 10px 0 #eee;
            background: #fff !important;
        }
        body.admin-bar.stm_layout_taxi.stm_header_style_11.stm_header_transparent .stm_mobile__header {
            padding-top: 45px;
        }
        .stm-header__element .btn_extended.btn_solid {
            margin-bottom: 30px;
        }
        .stm_layout_taxi .stm-navigation {
            margin-right: 0;
        }
        body.stm_layout_taxi.stm_header_style_11 .stm-navigation__default > ul {
            margin: 0 !important;
        }
        body.stm_layout_taxi.stm_header_style_11 .stm-navigation__default > ul > li {}
        body.stm_layout_taxi.stm_header_style_11 .stm-navigation__default > ul > li > a {
            padding: 10px 0 !important;
        }
        body.stm_layout_taxi.stm_header_style_11 .stm-navigation__default > ul > li > .sub-menu {
            padding: 0 0 0 10px !important;
        }
        html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li.menu-item-has-children a {
            padding: 10px 0 !important;
        }
        html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li,
        html body.stm_layout_taxi .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li.menu-item-has-children a {
            float: none !important;
            margin: 0 !important;
            line-height: 26px !important;
        }
        body.stm_layout_taxi.stm_header_style_11 .stm-navigation__default > ul > li .stm_mobile__dropdown {
            height: 46px;
        }
        html body .stm-navigation__default ul li.stm_megamenu .sub-menu > li {
            margin: 0 !important;
        }
body.stm_header_style_11 .stm_mobile__header
        html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu,
        html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li > ul.sub-menu {
            display: none !important;
        }
        html body .stm-navigation__default ul li.stm_megamenu.active > ul.sub-menu,
        html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li.active > ul.sub-menu {
            display: block !important;
            padding-left: 10px !important;
        }
        

    }
    @media (max-width: 991px) {
        .home .banner_image {
            width: 100%;
            margin-left: 0;
        }
        .order_now_image {
            left: -240px;
        }
    }
    @media (max-width: 767px) {
        .home h1 {
            white-space: normal !important;
        }
        .stm_layout_taxi .stm_partners_style_3 {
            flex-wrap: wrap;
        }
        .stm_layout_taxi .stm_partners_style_3 .stm_partners__single {
            flex: 0 1 33.3333%;
        }

        .stm_layout_taxi .stm_testimonials_style_21 {
            margin: 70px 0 0;
        }
        .stm_layout_taxi .wpb_column + .wpb_column .stm-counter_style_6:before {
            content: none;
        }
    }
    @media (max-width: 550px) {
        .home h1 {
            font-size: 30px !important;
        }
        .stm_layout_taxi .stm_partners_style_3 .stm_partners__single {
            flex: 0 1 50%;
        }
    }

</style>
