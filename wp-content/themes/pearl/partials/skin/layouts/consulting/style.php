<?php
/*Colors*/
$main_color = pearl_get_option('main_color');
$secondary_color = pearl_get_option('secondary_color');
$third_color = pearl_get_option('third_color');
?>

body .wpb_text_column ul li{
    padding-left: 18px;
    position: relative;
    display: inline-block;
}

body .wpb_text_column ul li:before{
    content: '';
    font-size: 18px;
    position: absolute;
    top: 10px;
    left: 0;
    width: 4px;
    height: 4px;
    margin-right: 0;
    transform: rotate(45deg);
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

body.stm_layout_consulting.stm_header_style_11 .stm-navigation__default > ul > li ul {
    min-width: 160px;
}
body.stm_header_style_11 .stm-navigation__default > ul > li > a {
    color: #fff;
}
body.stm_layout_consulting.stm_header_style_11 .stm-navigation__default > ul > li > a:hover {
    color: #fff !important;
}

.home .stm-header {
    margin-bottom: 0;
}

.stm_layout_consulting .stm_cta.style_1 {
    padding: 0;
    margin: 0;
}
.stm_layout_consulting .stm_cta.style_1 .stm_cta__content {
    width: 70%;
}

.stm_layout_consulting .stm-footer .footer-widgets aside.widget .widgettitle {
    margin-bottom: 20px;
}
.stm_layout_consulting .stm-footer .footer-widgets aside.widget .widgettitle h4 {
    margin-bottom: 10px;
    text-transform: none;
    font-weight: 500;
    font-size: 18px;
    color: #fff !important;
}
.stm_layout_consulting .stm-footer .footer-widgets aside.widget .textwidget h4 {
    margin-bottom: 10px;
    font-weight: 500;
    font-size: 18px;
    color: #ffffff;
}
.stm_layout_consulting .stm-footer p {
    line-height: 20px;
    font-size: 14px;
}
.stm_layout_consulting .widget_follow.widget_follow_style_1 .stm-icontext_style1 {
    margin-bottom: 15px;
}
.stm_layout_consulting .widget_follow.widget_follow_style_1 a {
    display: flex;
    flex-direction: row;
    align-items: center;
}
.stm_layout_consulting .widget_follow.widget_follow_style_1 a .stm-icontext__icon {
    width: 16px;
    height: auto;
    margin: 0 20px 0 0;
    line-height: 18px;
    background-color: transparent !important;
    font-size: 18px;
    opacity: 0.30;
}
.stm_layout_consulting .widget_follow.widget_follow_style_1 a .stm-icontext__text {
    top: 0;
    font-size: 14px;
}

.stm-counter.stm-counter_style_9 {
    border: 0;
    padding: 0;
    margin-bottom: 30px;
}
.stm-counter.stm-counter_style_9 .stm-counter__value {
    font-size: 48px;
}
.stm-counter.stm-counter_style_9 .stm-counter__label {
    margin-top: 3px;
}

.custom_icon_box {
    margin-bottom: 40px;
}
.custom_icon_box p {
    margin-bottom: 15px;
}
.custom_icon_box a {
    display: inline-block;
    vertical-align: top;
    position: relative;
}
.custom_icon_box a:before,
.custom_icon_box a:after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -1px;
    width: 100%;
    height: 1px;
    background-color: <?php echo wp_kses_post($secondary_color); ?>;
    transition: all 0.3s;
}
.custom_icon_box a:after {
    width: 0;
    background-color: <?php echo wp_kses_post($main_color); ?>;
}
.custom_icon_box a:hover:after {
    width: 100%;
}

.quaint_box {
    width: 1270px;
    padding: 0 80px;
    border-radius: 4px;
}
.overflow_hidden {
    overflow: hidden;
}

.stm_layout_consulting .stm_services_style_12 .stm_services__content:before {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_consulting .stm_services_style_12 .stm_services__title a:hover {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_consulting .stm_services_style_12 .stm_services__more_link {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_projects_carousel__item .stm_projects_carousel__name {
    margin-bottom: 10px;
    text-transform: none;
}
.stm_projects_carousel__item .stm_projects_carousel__btn:hover {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    color: <?php echo wp_kses_post($main_color); ?> !important;
}

.stm_layout_consulting .stm_video.stm_video_style_11 .stm_video_title {
    margin-left: 2px;
    font-weight: 500;
    font-size: 16px;
}

.stm_layout_consulting .stm_cta.style_3 .btn {
    padding-right: 46px;
}
.stm_layout_consulting .stm_cta.style_3 .btn:hover {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_consulting .stm_projects_carousel__tab a.active {
    color: #fff !important;
}

.stm_post_type_list_style_2 .stm_post_type_list__content h4,
.stm_testimonials_style_4 .stm_testimonials__info h6,
.stm_layout_consulting .widget .widgettitle {
    text-transform: none !important;
}

.stm_layout_consulting .stm_projects_grid__posts .btn.loading span,
.stm_layout_consulting .stm_projects_grid__posts .btn:hover span,
.stm_layout_consulting .stm_projects_grid__posts .btn:focus span,
.stm_layout_consulting .stm_projects_grid__posts .btn:active span,
.stm_layout_consulting .stm_projects_grid__posts .btn.btn_load:hover:before {
    color: #fff !important;
}

.stm_layout_consulting .stm_pricing-table_style_2 .stm_pricing-table__head h5 {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_consulting .stm_post_type_list_style_3 .stm_post_type_list__content {
    padding-right: 15px;
    padding-left: 15px;
}

.stm_layout_consulting .stm_services_text_carousel_style_1 .stm_services_carousel .item .content .excerpt {
    margin-bottom: 25px;
}

.stm_layout_consulting .stm_events_list.stm_events_list_style_1 a .stm_event_single_list__alone .btn:hover,
.stm_layout_consulting .stm_upcoming_event_style_1 .stm_upcoming_event__actions-button:hover {
    color: #fff !important;
}

.stm_layout_consulting .owl-carousel .owl-nav .owl-prev:before,
.stm_layout_consulting .owl-carousel .owl-nav .owl-next:before {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__front .inner_flip .stm_projects__meta .inner span,
.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__back .inner_flip .stm_projects__meta .inner span {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.color_white .stm_video.stm_video_style_11 .stm_playb_wrap:before,
.color_white .stm_video.stm_video_style_11 .stm_playb_wrap:after {
    border-color: #fff !important;
}
.color_white .stm_video.stm_video_style_11 .stm_playb {
    background-color: #fff !important;
}
.color_white .stm_video.stm_video_style_11 .stm_playb:before {
    border-color: transparent transparent transparent <?php echo wp_kses_post($main_color); ?> !important;
}
.color_white .stm_video.stm_video_style_11 .stm_playb:after {
    border-color: #ffffff !important;
}
.archive.stm_header_transparent .stm-header{
    position: relative;
}
@media (min-width: 1024px)  {
    body.stm_header_style_11 .stm-navigation__default > ul > li > a {
        position: relative;
    }
    body.stm_header_style_11 .stm-navigation__default > ul > li > a:after {
        content: '';
        position: absolute;
        bottom: -17px;
        left: 21px;
        right: 21px;
        height: 3px;
        transition: all 0.3s;
        background-color: <?php echo wp_kses_post($secondary_color); ?>;
        opacity: 0;
    }
    body.stm_header_style_11 .stm-navigation__default > ul > li > a:hover:after {
        bottom: -7px;
        opacity: 1;
    }
}

@media (max-width: 1335px)  {
    .quaint_box {
        width: 1140px;
    }
}

@media (max-width: 1199px)  {
    .quaint_box {
        width: 970px;
        padding: 0 15px;
    }
}

@media (max-width: 1024px)  {
    .quaint_box {
        width: auto;
        padding-top: 0;
        border-radius: 0;
    }

    .quaint_box * {
        text-align: center !important;
    }

    .quaint_box .stm_video.stm_video_style_11 {
        justify-content: center;
    }
}

@media (max-width: 1023px)  {
    .archive.stm_header_transparent .stm-header{
        position: fixed;
    }
    body.stm_layout_consulting.stm_header_style_11 .stm_mobile__header {
        background-color: <?php echo wp_kses_post($main_color); ?>;
    }
    body.stm_layout_consulting .stm_mobile__switcher span {
        background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    }
    body.stm_layout_consulting .stm-header__row_color_center:before {
        background-color: #ffffff !important;
    }
    body.stm_layout_consulting.stm_header_style_11 .stm-navigation__default .stm_megamenu > ul > li ul.sub-menu li a,
    body.stm_header_style_11 .stm-navigation__default > ul > li > a,
    body.stm_layout_consulting.stm_header_style_11 .stm-navigation__default > ul > li > a:hover {
        color: <?php echo wp_kses_post($main_color); ?> !important;
    }
    body.stm_header_style_11 .stm-navigation__default > ul > li ul.sub-menu {
        padding: 5px 0 !important;
    }
    body.stm_layout_consulting.stm_header_style_11 .stm-navigation__default .stm_megamenu > ul > li ul.sub-menu li {
        margin-bottom: 0 !important;
    }
    body.stm_layout_consulting.stm_header_style_11 .stm-navigation__default .stm_megamenu > ul > li ul.sub-menu li a {
        padding-left: 20px !important;
    }

    html body.stm_layout_consulting .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li.current-menu-item > a {
        background-color: <?php echo wp_kses_post($main_color); ?> !important;
        color: #fff !important;
    }
}

@media (max-width: 991px)  {
    .stm_layout_consulting #wrapper {
        overflow: inherit !important;
    }
    .mobile-empty-space .vc_column-inner {
        margin-left: 0 !important;
        padding-right: 15px !important;
        padding-left: 15px !important;
    }

    body.stm_layout_consulting.stm_header_style_11 .stm_mobile__header {
        padding-bottom: 30px;
    }
    .stm_layout_consulting .stm_services.stm_services_style_12 .stm_loop__grid {
        width: 50%;
    }

    .stm_layout_consulting .stm_markup__post .stm_loop__grid .stm_post_type_list__single {
        width: 50%;
    }

    .stm_layout_consulting .services_price_list_style_1 .services_pills_container {
        margin-bottom: 0;
    }
    .stm_layout_consulting .services_price_list_style_1 .service__tab {
        flex-direction: column;
    }
}

@media (min-width: 992px) {
    .consulting-video-margin-right {
        margin-right: 17px;
    }
}

@media (max-width: 768px)  {
    .stm_layout_consulting .stm_cta.style_1 {
        flex-direction: column;
    }
    .stm_layout_consulting .stm_cta.style_1 .stm_cta__content {
        width: 100%;
        padding-right: 0;
        margin-bottom: 32px;
        text-align: center;
    }
    .stm_layout_consulting .stm_cta.style_1 .stm_cta__link {
        margin: 0;
    }

    .stm_layout_consulting .vc_col-sm-6:nth-of-type(2n+1) {
        clear: none;
    }
}

@media (max-width: 767px)  {
    .stm-counter.stm-counter_style_9 .stm-counter__value {
        font-size: 38px;
    }
    .stm-counter.stm-counter_style_9 .stm-counter__label {
        margin-top: 3px;
    }
    .stm_layout_consulting .stm_services.stm_services_style_12 .stm_loop__grid {
        width: 100%;
    }
    .stm_layout_consulting .stm_markup__post .stm_loop__grid .stm_post_type_list__single {
        width: 100%;
    }

    .stm_layout_consulting .wpb_text_column ul li {
        display: block !important;
        padding-left: 15px;
    }

    .stm_layout_consulting.wpb-js-composer .vc_tta.vc_general .vc_tta-panel {
        margin-bottom: 2px;
    }
}

@media (max-width: 550px)  {
    .stm_layout_consulting.stm_sidebar_style_1 .stm-footer {
        padding: 50px 0 15px;
    }
    .stm-footer .footer-widgets {
        padding-bottom: 0;
    }
    .stm_layout_consulting .widget_follow.widget_follow_style_1 .stm-icontext_style1:last-child {
        margin-bottom: 30px;
    }
    .stm_layout_consulting .stm-footer .footer-widgets aside.widget {
        margin-bottom: 10px;
    }

    .stm_layout_consulting .stm_post_details ul {
        display: flex;
        flex-wrap: wrap;
    }
    .stm_layout_consulting .stm_post_details ul li {
        margin-right: 15px !important;
    }
}