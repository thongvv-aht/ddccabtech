<?php
/*Colors*/
$main_color = pearl_get_option('main_color');
$secondary_color = pearl_get_option('secondary_color');
$third_color = pearl_get_option('third_color');
?>

.stm_layout_businesstwo .stm-header .stm-socials__icon {
    border: 2px solid rgba(39,48,68, 0.5);
    width: 38px;
    height: 38px;
    line-height: 36px;
}
.stm_layout_businesstwo .stm-socials__icon:hover {
    background-color: <?php echo wp_kses_post($secondary_color); ?>;
    color: #ffffff !important;
}

.stm_layout_businesstwo .stm_breadcrumbs .container {
    padding: 0;
}

body.stm_header_style_11 .stm-navigation__default > ul > li ul {
    min-width: 164px !important;
}

.stm_layout_businesstwo .stm_infobox_style_8 .stm_infobox__content h4 {
    margin-bottom: 10px;
}

.stm_layout_businesstwo .rev-btn:hover {
    margin-top: -5px !important;
    box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0.2) !important;
}
.stm_layout_businesstwo .btn:hover {
    margin-top: -5px;
    margin-bottom: 5px;
    transition: all 0.5s;
    box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0.2);
}
.btn {
    text-transform: none;
}
.btn.btn_lg {
    padding: 20px 40px;
    border-radius: 10px;
    font-size: 16px !important;
}

.btn.btn_icon-right .btn__icon {
    top: 0px;
    bottom: 0px;
    right: 0px !important;
}

.btn.btn_icon-left .btn__icon {
    top: 0px;
    bottom: 0px;
    left: 0px !important;
}

.stm_layout_businesstwo .stm_infobox_style_8 .stm_infobox__content h4 {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_businesstwo .stm_infobox_style_8 {
    border-radius: 13px;
}
.stm_layout_businesstwo .stm_infobox_style_8 .stm_infobox__content {
    padding: 53px 32px 33px;
    border-radius: 13px;
}
.stm_layout_businesstwo .stm_infobox_style_8 .stm_infobox__content img {
    margin: 0 auto;
}

.stm_layout_businesstwo .stm_iconbox_style_2 {
    padding: 0;
}
.stm_layout_businesstwo .stm_iconbox_style_2 .stm_iconbox__icon {
    margin: 0;
}
.stm_layout_businesstwo .stm_iconbox_style_2 .stm_iconbox__icon i {
    color: <?php echo wp_kses_post($third_color); ?> !important;
}
.stm_layout_businesstwo .stm_iconbox_style_2 .stm_iconbox__text h5 {
    text-transform: uppercase;
    line-height: 22px !important;
    font-size: 22px !important;
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_businesstwo .stm_cta .stm_cta__link .btn:hover {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_businesstwo .stm_testimonials_style_15 .stm_testimonials__review {
    margin-bottom: 64px;
    line-height: 36px;
    font-size: 28px;
}
.stm_layout_businesstwo .stm_testimonials_style_15 .stm_testimonials__meta .stm_testimonials__info h6 {
    text-transform: uppercase !important;
    margin-bottom: 9px;
    font-size: 28px;
}
.stm_layout_businesstwo .stm_testimonials_style_15 .owl-controls .owl-nav {
    width: 260px;
    margin-left: -130px;
}
.stm_testimonials_style_15 .owl-controls .owl-nav .owl-next, .stm_testimonials_style_15 .owl-controls .owl-nav .owl-prev {
    background-color: #ffffff;
}
.stm_testimonials_style_15 .owl-controls .owl-nav .owl-next:before {
    content: "\eb94";
    font-family: 'stmicons' !important;
}
.stm_testimonials_style_15 .owl-controls .owl-nav .owl-prev:before {
    content: "\eb93";
    font-family: 'stmicons' !important;
}

.stm_layout_businesstwo .stm_cta.style_4 {
    padding: 20px 0;
}
.stm_layout_businesstwo .stm_cta.style_4 .stm_cta__content {
    text-transform: uppercase;
    letter-spacing: -1px;
    font-style: normal;
    font-weight: 700;
    font-size: 35px;
}

.stm_layout_businesstwo .stm-counter_style_8 {
    padding: 0;
    border: 0;
}
.stm_layout_businesstwo .stm-counter_style_8 .stm-counter__affix,
.stm_layout_businesstwo .stm-counter_style_8 .stm-counter__prefix,
.stm_layout_businesstwo .stm-counter_style_8 .stm-counter__value {
    font-size: 80px;
    font-weight: 700;
    letter-spacing: 0;
}
.stm_layout_businesstwo .stm-counter_style_8 .stm-counter__label {
    margin-top: 8px;
    font-size: 17px;
    font-weight: 400;
    color: <?php echo wp_kses_post($secondary_color); ?>;
}

.white_color {
    color: #ffffff !important;
}

.wpb_single_image .vc_single_image-wrapper.vc_box_border_circle,
.wpb_single_image .vc_single_image-wrapper.vc_box_circle,
.wpb_single_image .vc_single_image-wrapper.vc_box_outline_circle,
.wpb_single_image .vc_single_image-wrapper.vc_box_shadow_border_circle,
.wpb_single_image .vc_single_image-wrapper.vc_box_shadow_circle {
    overflow: hidden;
    position: relative;
    transition: all 0.3s !important;
    border-radius: 15px !important;
    box-shadow: 0 26px 26px rgba(0,0,0, 0.20);
}
.stm_layout_businesstwo .wpb_single_image .vc_single_image-wrapper.vc_box_shadow_border_circle img,
.stm_layout_businesstwo .wpb_single_image .vc_single_image-wrapper.vc_box_shadow_circle img {
    border-radius: 15px !important;
}
.wpb_single_image .vc_single_image-wrapper.vc_box_shadow_circle:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transition: all 0.5s;
    background-color: <?php echo wp_kses_post($secondary_color); ?>;
    visibility: hidden;
    opacity: 0;
    z-index: 10;
}
.wpb_single_image .vc_single_image-wrapper.vc_box_shadow_circle:hover:before {
    visibility: visible;
    opacity: 0.5;
}
.wpb_single_image .vc_single_image-wrapper.vc_box_shadow_circle:after {
    content: "\e114";
    font-family: 'stmicons' !important;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    transition: all 0.5s;
    justify-content: center;
    align-items: center;
    font-size: 48px;
    color: #ffffff;
    visibility: hidden;
    opacity: 0;
    z-index: 11;
}
.wpb_single_image .vc_single_image-wrapper.vc_box_shadow_circle:hover:after {
    visibility: visible;
    opacity: 1;
}

.stm-footer .footer_widgets_count_4:before {
    content: "";
    display: block;
    position: absolute;
    top: -30px;
    left: 15px;
    right: 15px;
    height: 1px;
    background: #e5e8ec;
}
.home .stm-footer .footer_widgets_count_4:before {
    display: none;
}
.home #wrapper,
.home.stm_layout_businesstwo.stm_sidebar_style_1 .stm-footer {
    padding-top: 0;
    padding-bottom: 0;
}
.stm_layout_businesstwo.stm_sidebar_style_1 .stm-footer {
    padding: 33px 0 0;
}
.stm_layout_businesstwo.stm_sidebar_style_1 .stm-footer a {
    color: <?php echo wp_kses_post($third_color); ?> !important;
}
.stm_layout_businesstwo.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .widgettitle h4 {
    font-size: 22px;
    line-height: 26px;
    margin-bottom: 30px;
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_businesstwo.stm_sidebar_style_1 .stm-footer .widget_nav_menu li {
    float: left;
    width: 50%;
    position: relative;
    padding-left: 15px;
    font-family: inherit;
    margin-bottom: 7px;
    font-size: 14px;
    color: inherit;
}
.stm_layout_businesstwo.stm_sidebar_style_1 .stm-footer .widget_nav_menu li:before {
    content: '';
    position: absolute;
    top: 11px;
    left: 0;
    width: 4px;
    height: 4px;
    background-color: <?php echo wp_kses_post($secondary_color); ?>;
    border-radius: 50%;
    opacity: 0.5;
}
.stm_layout_businesstwo.stm_sidebar_style_1 .stm-footer .widget_nav_menu li a {
    color: inherit !important;
}
.stm_layout_businesstwo.stm_sidebar_style_1 .stm-footer .widget_nav_menu li a:hover {
    color: <?php echo wp_kses_post($third_color); ?> !important;
}
.stm_layout_businesstwo .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2 {
    margin-bottom: 2px;
}
.stm_layout_businesstwo .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2:first-child {
    margin-bottom: 24px;
}
.stm_layout_businesstwo .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2 .stm-icontext__text {
    font-size: 14px;
    line-height: 22px;
}
.stm_footer_layout_3 .stm-footer__bottom .stm_bottom_copyright a:first-child {
    color: inherit !important;
}
.stm_layout_businesstwo.stm_footer_layout_3 .stm-footer__bottom {
    padding: 33px 5000px;
    margin: 0 -5000px;
    text-align: center;
    border-top: 0;
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_businesstwo.stm_footer_layout_3 .stm-footer__bottom .stm_markup {
    display: block;
}
.stm_layout_businesstwo.stm_sidebar_style_1 .stm-footer .stm_wp_widget_text .stm-socials__icon {
    display: flex;
    width: 50px;
    height: 50px;
    justify-content: center;
    align-items: center;
    background-color: #f2f3f5;
    margin: 0 5px;
    font-size: 18px;
    text-decoration: none;
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_businesstwo .stm_testimonials_style_2 .stm_testimonials__review {
    font-size: 24px;
    line-height: 34px;
    font-family: inherit;
}

.stm_layout_businesstwo .stm_infobox_style_8 .stm_infobox__content p {
    font-size: 14px;
    line-height: 24px;
}
.stm_layout_businesstwo .stm_infobox_style_8 .stm_infobox__content:hover p {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_businesstwo .stm_projects_carousel__tab a.active {
    color: #fff !important;
}
.stm_layout_businesstwo .stm-icontext__text {
    font-size: 14px;
}
.stm_layout_businesstwo .stm_post_type_list_style_2 .stm_post_type_list__content h4 {
    font-size: 16px;
    line-height: 20px;
}
.stm_layout_businesstwo .stm_post_type_list_style_1 .stm_post_type_list__content h4,
.stm_layout_businesstwo .stm_contact_style_4 h5,
.stm_layout_businesstwo .stm_contact_style_2 h5 {
    font-size: 18px;
}
.stm_layout_businesstwo .widget_contacts_style_2 .widget_contacts_inner .stm-icontext_style2 .stm-icontext__text {
    font-size: 18px;
}
.stm_layout_businesstwo .vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading .vc_tta-panel-title>a {
    font-size: 20px;
}
.archive.stm_header_transparent .stm-header{
    position: relative;
}
@media (max-width: 1700px) {
    .stm_layout_businesstwo .stm_infobox_style_8 .stm_infobox__content {
        padding-left: 22px;
        padding-right: 22px;
    }
}
@media (max-width: 1440px) {
    .stm_layout_businesstwo .remove_row_indents,
    .stm_layout_businesstwo .remove_colum_inner_indents .vc_column-inner {
        padding-right: 15px !important;
        padding-left: 15px !important;
    }
}
@media (max-width: 1280px) {
    .stm_layout_businesstwo .stm_infobox_style_8 .stm_infobox__content {
        padding-left: 28px;
        padding-right: 28px;
    }
}
@media (max-width: 1170px) {
    .stm_layout_businesstwo .stm_infobox_style_8 .stm_infobox__content {
    padding-left: 20px;
    padding-right: 20px;
    }
}
@media (max-width: 1024px) {
    .stm_layout_businesstwo.stm_footer_layout_3 .stm-footer__bottom .stm_markup > div {
        margin: 0;
    }
}
@media (max-width: 1023px) {
    body.stm_header_style_11 .stm_mobile__header {
        padding-bottom: 30px !important;
    }
    .archive.stm_header_transparent .stm-header{
        position: fixed;
    }
    body.stm_layout_businesstwo.stm_header_style_11 .stm-navigation__default>ul>li ul li:hover a, 
    body.stm_layout_businesstwo.stm_header_style_11 .stm-navigation__default>ul>li ul li.current-menu-item a {
        color: initial !important;
    }
}
@media (max-width: 991px) {
    .mobile_align_center {
        text-align: center !important;
        margin: 0 auto !important;
    }
    .mobile_align_center_button {
        display: block !important;
        margin: 0 auto !important;
        max-width: 180px !important;
    }
    .stm_services.stm_loop.stm_services_style_12 .stm_loop__grid {
        width: 50%;
    }

    .stm_layout_businesstwo.stm_tabs_style_4 .vc_tta.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab {
        margin-top: 4px;
        background-color: #f6f7f8;
    }
    .stm_layout_businesstwo.stm_tabs_style_4 .vc_tta.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab:before {
        top: 0;
        width: 4px;
        height: 100%;
    }
    .stm_markup__post .stm_loop__grid .stm_post_type_list__single {
        width: 50% !important;
    }

    .stm_projects_grid_style_1 .stm_projects_carousel__item {
        width: 50%;
    }
}
@media (max-width: 767px) {
    .stm_layout_businesstwo.stm_sidebar_style_1 .stm-footer {
        padding: 50px 0 0 !important;
    }

    .stm_layout_businesstwo .stm-counter_style_8 {
        text-align: center;
    }

    .stm_layout_businesstwo.stm_tabs_style_4 .vc_tta.vc_tta-tabs .vc_tta-panel-heading {
        margin-top: 4px;
        background-color: #f6f7f8;
    }
    .stm_layout_businesstwo.stm_tabs_style_4 .vc_tta.vc_tta-tabs .vc_active .vc_tta-panel-heading .vc_tta-panel-title a {
        color: #ffffff !important;
    }
    .stm_layout_businesstwo.stm_tabs_style_4 .vc_tta.vc_tta-tabs .vc_active .vc_tta-panel-body {
        padding-top: 20px;
    }
    .stm_layout_businesstwo.stm_tabs_style_4 .vc_tta.vc_tta-tabs .vc_tta-panel-heading .vc_tta-panel-title {

        border-left: 4px solid <?php echo wp_kses_post($main_color); ?>;
    }

    .stm_markup__post .stm_loop__grid .stm_post_type_list__single {
        width: 100% !important;
    }
    .stm_markup__post .stm_loop__grid .stm_post_type_list__single img {
        width: 100%;
    }
    .stm_projects_grid_style_1 .stm_projects_carousel__item {
        width: 100% !important;
    }
}

@media (min-width: 767px) {
    .businesstwo-video-margin-right {
        margin-right: 17px;
    }
}

@media (max-width: 520px) {
    .stm_services.stm_loop.stm_services_style_12 .stm_loop__grid {
        width: 100%;
    }
}