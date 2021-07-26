<?php
/*Colors*/
$main_color = pearl_get_option('main_color');
$secondary_color = pearl_get_option('secondary_color');
$third_color = pearl_get_option('third_color');
?>

.stm_layout_creative .btn {
    border-width: 3px;
    text-transform: uppercase;
}

.stm_layout_creative .btn.btn_outline.btn_icon-bg.btn_icon-right .btn__icon {
    border-radius: 0 50px 50px 0;
    right: -1px !important;
}
.stm_layout_creative .btn.btn_outline.btn_icon-bg.btn_icon-left .btn__icon {
    border-radius: 50px 0 0 50px;
    left: -1px !important;
}

.stm_layout_creative .stm_infobox_style_8 .stm_infobox__content {
    padding: 53px 32px 33px;
    border: 1px solid #e7e7e7;
}

.stm_layout_creative .stm-counter_style_1 {
    padding: 0 0 0 30px;
}
.stm_layout_creative .stm-counter_style_1 .stm-counter__value,
.stm_layout_creative .stm-counter_style_1 .stm-counter__affix,
.stm_layout_creative .stm-counter_style_1 .stm-counter__prefix {
    letter-spacing: 0;
    letter-spacing: 1px;
    line-height: 72px;
    font-weight: 700;
    font-size: 60px;
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_creative .stm-counter_style_1 .stm-counter__label {
    padding-top: 1px;
    margin-top: 11px;
    text-transform: uppercase;
    line-height: 30px;
    font-weight: 500;
    font-size: 16px;
}

.stm_layout_creative .stm_testimonials_style_15 .owl-controls .owl-nav {
    width: 260px;
    margin-left: -130px;
}
.stm_layout_creative .stm_testimonials_style_15 .owl-controls .owl-nav .owl-prev,
.stm_layout_creative .stm_testimonials_style_15 .owl-controls .owl-nav .owl-next {
    background-color: #ffffff;
}
.stm_layout_creative .stm_testimonials_style_15 .owl-controls .owl-nav .owl-prev:before {
    content: "\eb93";
    font-family: 'stmicons' !important;
}
.stm_layout_creative .stm_testimonials_style_15 .owl-controls .owl-nav .owl-next:before {
    content: "\eb94";
    font-family: 'stmicons' !important;
}
.stm_testimonials__review {
    margin-bottom: 64px !important;
}

.stm_layout_creative.stm_sidebar_style_1 .stm_markup__sidebar_divider .widget {
    border-bottom: 0;
}

.stm_layout_creative .stm_video.stm_video_style_10 {
    margin: 0 auto;
    width: 100px;
    height: 100px !important;

}
.stm_layout_creative .stm_video.stm_video_style_10:before {
    width: 100px;
    height: 100px;
    border-color: #fff !important;
}
.stm_layout_creative .stm_video.stm_video_style_10:after {
    display: none !important;
}
.stm_layout_creative .stm_video.stm_video_style_10 .stm_playb {
    width: 100px;
    height: 100px;
    background-color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_layout_creative .stm_video.stm_video_style_10 .stm_playb:hover {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_creative .stm_video.stm_video_style_10 .stm_playb:before {
    border-width: 12px 0 12px 17px;
}

.stm_layout_creative.single-stm_projects .stm_mobile__header {
    margin-bottom: 0;
}
@media (min-width: 1025px) {
    .stm_layout_creative.stm_title_box_enabled .stm-header {
        position: relative;
        margin-bottom: 30px;
    }
    .stm_layout_creative.stm_title_box_enabled .stm_titlebox_style_14 {
        padding: 100px 0;
    }
    .stm_layout_creative.single-stm_projects .stm-header {
        position: relative;
        margin-bottom: 0;
    }
}
@media (max-width: 767px) {
    .stm_layout_creative .stm-counter_style_1 {
        padding: 0;
        text-align:center;
    }
}

@media (max-width: 1023px) {
    .home.stm_layout_creative.stm_header_style_1 .stm_mobile__header {
        margin-bottom: 0;
    }
}

.stm_layout_creative .stm_lightgallery__iframe {
    text-decoration: none !important;
    position: relative;
    transition: all 0.5s;
}

.stm_layout_creative .stmicon-play {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: all .3s ease !important;
    width: 90px;
    height: 90px;
    border: 4px solid #ffffff;
    border-radius: 50%;
    color: #fff;
}

.stm_layout_creative .stmicon-play:before {
    margin-left: 5px;
    font-size: 16px;
}

body.stm_transparent_header_disabled.stm_title_box_disabled.stm_breadcrumbs_enabled .stm-header {
    margin-bottom: 40px;
}

body.stm_layout_creative .stm_breadcrumbs .container {
    padding: 0;
}

.stm_layout_creative.stm_title_box_enabled.stm_breadcrumbs_enabled .stm_titlebox.stm_titlebox_style_8 {
    margin-bottom: 70px;
}

.stm_layout_creative .stmicon-play:hover {
    background-color: #fff;
    color: <?php echo wp_kses_post($main_color); ?>
}

.stm_layout_creative .stm-navigation__default ul li.stm_megamenu ul.sub-menu,
.stm_layout_creative .stm-navigation__fullwidth ul li.stm_megamenu ul.sub-menu {
    margin-top: -10px;
}
.stm_layout_creative.stm_header_style_1 .stm-navigation__default > ul > li a {
    font-weight: 500;
}
.stm_layout_creative.stm_header_style_1 .stm-navigation__default > ul > li > a {
    font-weight: 400;
    font-size: 18px;
}
.stm_layout_creative.stm_header_style_1 .stm-navigation__default > ul > li.stm_megamenu > ul {
    margin-top: -15px;
}
.stm_layout_creative.stm_title_box_disabled .stm-header .stm-header__row_color_center {
    border-bottom: 1px solid #d6dadd;
}

.stm_layout_creative .stm-header .btn {
    font-size: 14px;
    padding: 16px 28px 19px !important;
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
    background: #ffffff !important;
    color: <?php echo wp_kses_post($main_color); ?> !important;
}

.stm_layout_creative .stm-header .btn:hover {
    background: <?php echo wp_kses_post($main_color); ?> !important;
    color: #ffffff !important;
}

.stm_layout_creative .stm_iconbox_style_2 .stm_iconbox__text p {
    font-size: 14px;
    line-height: 24px;
}

.stm_layout_creative .stm_sliding_images.style_1 .stm_sliding_image {
    position: absolute;
    left: -50px;
    max-width: 100%;
}
.stm_layout_creative .stm_sliding_images.style_1 .stm_sliding_image__right {
    position: absolute;
    right: 0;
    margin-left: 0;
    max-width: 100%;
    z-index: 30;
}

.stm_layout_creative .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .stm_pricing-table__price {
    color: <?php echo wp_kses_post($third_color); ?> !important;
}
.stm_layout_creative .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back {
    background-color: #ffffff !important;
}
.stm_layout_creative .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner .btn {
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
    color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_layout_creative .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner .btn:hover {
    background-color: <?php echo wp_kses_post($main_color); ?> !important;
    color: #ffffff !important;
}

.stm_layout_creative.stm_sidebar_style_1 .stm-footer {
    padding-top: 27px;
}

.stm_layout_creative .stm-footer__bottom {
    padding-top: 34px;
    padding-bottom: 30px;
    border-top: 1px solid #d6d6d6;
}


.stm_layout_creative .stm-footer .textwidget {
    line-height: 30px;
}

.stm_layout_creative .stm-footer .stm-socials a:hover i {
    color: #ffffff !important;
}

.stm_layout_creative.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .widgettitle h4 {
    padding: 6px 0 13px;
    text-transform: none !important;
    color: <?php echo wp_kses_post($third_color); ?> !important;
}

.stm_layout_creative.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .tp_recent_tweets {
    margin-top: -5px;
}
.stm_layout_creative.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .tp_recent_tweets ul li {
    padding-left: 30px;
}
.stm_layout_creative.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .tp_recent_tweets ul li:before {
    font-size: 16px;
}
.stm_layout_creative.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .tp_recent_tweets ul li .twitter_time {
    margin-top: 18px;
}

.stm_layout_creative.stm_sidebar_style_1 .stm_custom_menu_style_1 .menu li {
    padding-left: 28px !important;
    line-height: 20px;
    margin-bottom: 28px;
}

.stm_layout_creative.stm_sidebar_style_1 .stm_custom_menu_style_1 .menu li a:hover {
    color: <?php echo wp_kses_post($main_color); ?> !important;
}

.stm_layout_creative.stm_sidebar_style_1 .stm_custom_menu_style_1 .menu li:before {
    font-size: 16px;
    top: 2px;
    left: 4px;
}

.stm_layout_creative .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2:first-child {
    margin-top: -5px;
}

.stm_layout_creative .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2 {
    margin-bottom: 6px !important;
}

.stm_layout_creative .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2 .stm-icontext__text {
    line-height: 30px;
    font-size: 14px;
}

.stm_layout_creative .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2 .stm-icontext__text a {
    color: <?php echo wp_kses_post($main_color); ?> !important;
    text-decoration: underline !important;
}

.stm_layout_creative .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2 .stm-icontext__text a:hover {
    text-decoration: none !important;
}

.stm_layout_creative  .widget_tp_widget_recent_tweets .tp_recent_tweets ul li {
    font-size: 14px;
    line-height: 30px;
}

.stm_layout_creative .widget_tp_widget_recent_tweets .tp_recent_tweets ul li .twitter_time {
    font-style: normal;
    font-size: 14px;
    color: #7e7e7e;
}

.stm_layout_creative .stm_projects_cards_style_2 .stm_projects_cards__image img {
    width: 100%;
}

.stm_layout_creative.stm_pagination_style_10 .owl-dots .owl-dot {
    display: inline-block;
}

.stm_layout_creative.stm_header_style_1 .stm_mobile__header {
    background-color: #ffffff !important;
}

.stm_layout_creative.stm_header_style_1.stm_title_box_disabled .stm_mobile__header {
    border-bottom: 1px solid #d6dadd;
}

@media (max-width: 1099px) {
    .stm_layout_creative .remove_row_indents {
        padding-right: 15px !important;
        padding-left: 15px !important;
    }

    .stm_cta.style_1 .stm_cta__content img {
        display: none;
    }
}

@media (max-width: 991px) {
    .stm_layout_creative .stm_markup__stm_projects .stm_loop__grid .stm_loop__single {
        width: 50%;
    }
}

@media (max-width: 550px) {
    .stm_layout_creative .stm_cta.style_1 .stm_cta__content {
        text-align: center;
    }
    .stm_layout_creative .stm_cta.style_1 .stm_cta__link {
        margin: 20px auto 0;
    }

    .stm_layout_creative .stm_markup__stm_projects .stm_loop__grid .stm_loop__single {
        width: 100%;
    }
}

@media (max-width: 1023px) {
    .stm_mobile__header {
        position: relative;
        z-index: 100;
    }

    .stm_layout_creative .stm-header .stm-header__row_color_center {
        border-bottom: 0;
    }

    .stm_layout_creative.stm_header_style_1 .stm-navigation__default > ul > li > a {
        color: #ffffff !important;
    }

    .stm_layout_creative .stm-header__element:last-child {
        margin-bottom: 30px !important;
    }

    html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a {
        padding: 0 !important;
    }

    .stm_layout_creative.stm_header_style_1 .stm_mobile__logo {
        min-width: 120px;
        max-width: 120px;
    }
}