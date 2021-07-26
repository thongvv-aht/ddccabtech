<?php
/*Colors*/
$main_color = pearl_get_option('main_color');
$secondary_color = pearl_get_option('secondary_color');
$third_color = pearl_get_option('third_color');
?>


body.stm_layout_creativetwo.stm_header_style_11 .stm-navigation__default > ul > li ul {
    min-width: 160px;
}

.stm_layout_creativetwo .stm_breadcrumbs {
    text-transform: none;
}
.stm_layout_creativetwo .stm_breadcrumbs span {
    text-transform: none;
}
.stm_layout_creativetwo .stm_breadcrumbs .container {
    padding: 0;
}

.stm_layout_creativetwo .stm_cta.style_1 {
    padding: 0;
    margin: 0;
}
.stm_layout_creativetwo .stm_cta.style_1 .stm_cta__content {
    width: 70%;
}

.stm_layout_creativetwo .comment-reply-link i {
    margin-right: 10px;
}
.stm_layout_creativetwo #commentform button:after {
    display: none;
}

.stm-counter.stm-counter_style_9 {
    border: 0;
    padding: 0;
    margin-bottom: 30px;
}
.stm-counter.stm-counter_style_9 .stm-counter__value {
    font-weight: 500;
    font-size: 48px;
}
.stm-counter.stm-counter_style_9 .stm-counter__label {
    margin-top: 3px;
}

.stm-footer .menu li.current-menu-parent > a,
body.stm_header_style_11 .stm-navigation__default > ul > li.current-menu-parent > a {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm-footer .menu li.current_page_item > a,
body.stm_header_style_11 .stm-navigation__default > ul > li.current_page_item > a {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm-footer .menu li.current_page_item > a:after,
body.stm_header_style_11 .stm-navigation__default > ul > li.current_page_item > a:after {
    opacity: 1;
    bottom: -7px;
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li.current_page_item > a {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.border-radius_left_bottom .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front,
.border-radius_left_bottom .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back {
    border-radius: 0 0 0 65px !important;
}
.border-radius_top_right .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front,
.border-radius_top_right .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back {
    border-radius: 0 65px 0 0 !important;
}
.stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front,
.stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back {
    height: 430px;
    border: 0 !important;
    background-color: #f7f9ff !important;
}
.stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .inner,
.stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner {
    padding: 39px 25px;


}
.stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .inner h5,
.stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner h5 {
    margin-bottom: 2px;
    letter-spacing: 3px;
    font-weight: 300;
    font-size: 12px;
}
.stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .inner h5:last-child,
.stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner h5:last-child {
    letter-spacing: 0px;
    text-transform: none;
}
.stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .stm_pricing-table__price {
    margin-bottom: 2px;
    font-size: 56px;
    font-weight: 600;
    color: <?php echo wp_kses_post($third_color); ?> !important;
}
.stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner .btn {
    border-color: <?php echo wp_kses_post($third_color); ?> !important;
    color: <?php echo wp_kses_post($third_color); ?> !important;
}
.stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner .btn:hover {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    color: #fff !important;
}

.stm_stories_style_1 .owl-controls .owl-dots {
    display: flex;
    flex-direction: row;
}

.stm_layout_creativetwo .stm_testimonials .owl-dots .owl-dot span {
    display: none;
}
.stm_layout_creativetwo .stm_testimonials_style_3 .owl-dots .owl-dot {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_creativetwo .stm_iconbox_style_6 {
    padding: 44px 30px;
}

.stm_layout_creativetwo .stm_staff_grid_style_3 .btn {
    padding: 15px 30px;
}
.stm_layout_creativetwo .stm_staff_grid_style_3 .btn:hover {
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_creativetwo .btn.btn_outline.btn_xs {
    padding: 15px 30px;
}
.stm_layout_creativetwo .btn_xs {
    padding: 15px 30px;
}
.stm_layout_creativetwo .btn.stm_projects_carousel__btn:hover {
    color: #fff !important;
}

.stm_layout_creativetwo .overlap_box {
    z-index: 11 !important;
}

.stm_testimonials_style_18 .stm_testimonials__review:before {
    background: -webkit-linear-gradient(45deg, #5564ff, #01b3ff 70%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.stm_layout_creativetwo .stm_project_details_style_4 .stm_project_details__label {
    text-transform: none !important;
}

.quaint_box {
    width: 1270px;
    padding: 0 80px;
    border-radius: 0 78px 0 78px;
    z-index: 12 !important;
}
.quaint_box .stm_row-opacity {
    border-radius: 0 78px 0 78px;
}
.overflow_hidden {
    overflow: hidden;
}

.stm_layout_creativetwo .stm_services_style_12 .stm_services__content:before {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_creativetwo .stm_services_style_12 .stm_services__title a:hover {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_creativetwo .stm_services_style_12 .stm_services__more_link {
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

.stm_layout_creativetwo .stm_video.stm_video_style_11 .stm_video_title {
    margin-left: 2px;
    font-weight: 500;
    text-transform: lowercase;
    font-size: 16px;
}
.stm_layout_creativetwo .color_white .stm_video.stm_video_style_11 .stm_video_title {
    color: #fff;
}
.stm_layout_creativetwo .color_white .stm_video.stm_video_style_11 .stm_video_title:after {
    background-color: #fff !important;
    width: 100%;
    transition: all 0.3s;
}
.stm_layout_creativetwo .color_white .stm_video.stm_video_style_11:hover .stm_video_title:after {
    width: 0;
}

.stm_layout_creativetwo .stm_cta.style_3 .btn {
    padding-right: 46px;
}
.stm_layout_creativetwo .stm_cta.style_3 .btn:hover {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_creativetwo .stm_projects_carousel__tab a.active {
    color: #fff !important;
}

.stm_post_type_list_style_2 .stm_post_type_list__content h4,
.stm_testimonials_style_4 .stm_testimonials__info h6,
.stm_layout_creativetwo .widget .widgettitle {
    text-transform: none !important;
}

.stm_layout_creativetwo .stm_projects_grid__posts .btn.loading span,
.stm_layout_creativetwo .stm_projects_grid__posts .btn:hover span,
.stm_layout_creativetwo .stm_projects_grid__posts .btn:focus span,
.stm_layout_creativetwo .stm_projects_grid__posts .btn:active span,
.stm_layout_creativetwo .stm_projects_grid__posts .btn.btn_load:hover:before {
    color: #fff !important;
}

.stm_layout_creativetwo .stm_pricing-table_style_2 .stm_pricing-table__head h5 {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_creativetwo .stm_post_type_list_style_3 .stm_post_type_list__content {
    padding-right: 15px;
    padding-left: 15px;
}

.stm_layout_creativetwo .stm_services_text_carousel_style_1 .stm_services_carousel .item .content .excerpt {
    margin-bottom: 25px;
}

.stm_layout_creativetwo .stm_events_list.stm_events_list_style_1 a .stm_event_single_list__alone .btn:hover,
.stm_layout_creativetwo .stm_upcoming_event_style_1 .stm_upcoming_event__actions-button:hover {
    color: #fff !important;
}

.stm_layout_creativetwo .owl-carousel .owl-nav .owl-prev:before,
.stm_layout_creativetwo .owl-carousel .owl-nav .owl-next:before {
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

.stm_widget_search.style_1 .widget.widget_search .search-form button {
    border-radius: 0 !important;
}


.stm_layout_creativetwo .stm_loop__single_list_style_2 {
    margin-bottom: 0 !important;
}
.stm_layout_creativetwo .stm_loop__single_grid_style_2 .stm_loop__container, .stm_single_post_style_2 .stm_loop__container {
    height: 100%;
}
.stm_layout_creativetwo .stm_loop__single_grid_style_2 h5, .stm_single_post_style_2 h5 {
    font-weight: 400 !important;
}
.stm_layout_creativetwo .stm_read_more_link {
    font-weight: 400 !important;
    font-size: 14px;
}

.stm_layout_creativetwo .stm_carousel_style_1 .stm_carousel__pagination {
    bottom: 28px;
}
.stm_layout_creativetwo .stm_carousel_style_1 .stm_carousel__pagination .current {
    color: #fff !important;
}
.owl-controls .owl-dots .owl-dot.active span {
    background-color: <?php echo wp_kses_post($main_color); ?>;
}

.admin-bar .lg-outer.lg-visible {
    top: 32px;
}

.home #wrapper {
    padding-bottom: 0;
}

.stm-footer .footer-widgets {
    padding-bottom: 4px;
}
.stm-footer .menu {
    display: flex;
    align-items: center;
    justify-content: center;
}
.stm-footer .menu li {
    margin: 5px 32px !important;
    font-weight: 500;
}
.stm_footer_layout_2 .stm-footer__bottom {
    border-color: rgba(0,0,0, 0.10) !important;
}
.stm_footer_layout_2 .stm-footer__bottom .stm_markup {
    display: flex;
    flex-direction: column;
}
.stm_footer_layout_2 .stm-footer__bottom .stm_bottom_copyright {
    order: 0;
    margin-bottom: 20px;
    max-width: none !important;
}
.stm_footer_layout_2 .stm-footer__bottom .stm_bottom_copyright a {
    color: inherit !important;
}
.stm_footer_layout_2 .stm-footer__bottom .stm_bottom_copyright a:hover {
    text-decoration: none;
    color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_footer_layout_2 .stm-footer__bottom .stm-socials {
    order: 1;
}
.archive.stm_header_transparent .stm-header{
    position: relative;
}
@media (min-width: 1024px)  {
    .stm-footer .menu li a,
    body.stm_header_style_11 .stm-navigation__default > ul > li > a {
        position: relative;
    }
    .stm-footer .menu li a:after,
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
    .stm-footer .menu li a:after {
        left: 0;
        right: 0;
    }
    .stm-footer .menu li a:hover:after,
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
    .stm_layout_creativetwo .stm_mobile__logo {
        z-index: 100;
    }

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

    .stm_layout_creativetwo .stm-footer .footer-widgets aside.widget {
        width: 100%;
    }
}

@media (max-width: 1023px)  {
    .archive.stm_header_transparent .stm-header{
        position: fixed;
    }
    .stm_layout_creativetwo .stm_mobile__header {
        padding-left: 0;
        padding-right: 0;
    }
    body.stm_layout_creativetwo .stm_mobile__switcher span {
        background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    }
    body.stm_layout_creativetwo .stm-header__row_color_center:before {
        background-color: #ffffff !important;
    }
    body.stm_header_style_11 .stm-navigation__default > ul > li > a {
        color: <?php echo wp_kses_post($main_color); ?>;
    }
    body.stm_layout_creativetwo.stm_header_style_11 .stm-navigation__default > ul > li > a:hover {
        color: <?php echo wp_kses_post($main_color); ?> !important;
    }
    body.stm_header_style_11 .stm-navigation__default > ul > li ul.sub-menu {
        padding: 5px 0 !important;
    }
    body.stm_layout_creativetwo.stm_header_style_11 .stm-navigation__default .stm_megamenu > ul > li ul.sub-menu li {
        margin-bottom: 0 !important;
    }
    body.stm_layout_creativetwo.stm_header_style_11 .stm-navigation__default .stm_megamenu > ul > li ul.sub-menu li a {
        padding: 11px 0 11px 20px !important;
        color: <?php echo wp_kses_post($main_color); ?> !important;
    }

    .stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner ul li {
        padding: 7px 0;
    }
    .stm_layout_creativetwo .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner .btn {
        padding: 14px 26px;
    }

    html body.stm_layout_creativetwo .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li.current-menu-item > a {
        background-color: <?php echo wp_kses_post($main_color); ?> !important;
        color: #fff !important;
    }
}

@media (max-width: 991px)  {
    .mobile-empty-space .vc_column-inner {
        margin-left: 0 !important;
        padding-right: 15px !important;
        padding-left: 15px !important;
    }

    body.stm_layout_creativetwo.stm_header_style_11 .stm_mobile__header {
        padding-bottom: 30px;
    }
    .stm_layout_creativetwo .stm_services.stm_services_style_12 .stm_loop__grid {
        width: 50%;
    }

    .stm_layout_creativetwo .stm_markup__post .stm_loop__grid .stm_post_type_list__single {
        width: 50%;
    }

    .stm_layout_creativetwo .services_price_list_style_1 .services_pills_container {
        margin-bottom: 0;
    }
    .stm_layout_creativetwo .services_price_list_style_1 .service__tab {
        flex-direction: column;
    }

    .stm_layout_creativetwo .stm_loop__single_list_style_2 .stm_loop__content {
        padding: 0 20px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }
    .stm_layout_creativetwo .stm_loop__single_list_style_2 .stm_post_details {
        margin-bottom: 10px;
    }
    .stm_layout_creativetwo .stm_loop__single_list_style_2 .post_excerpt.stm_mgb_34 {
        margin-bottom: 10px;
    }

    .quaint_box {
        margin: 0 15px;
    }
}

@media (min-width: 992px) {
    .consulting-video-margin-right {
        margin-right: 17px;
    }
}

@media (max-width: 768px)  {
    .stm_layout_creativetwo .stm_cta.style_1 {
        flex-direction: column;
    }
    .stm_layout_creativetwo .stm_cta.style_1 .stm_cta__content {
        width: 100%;
        padding-right: 0;
        margin-bottom: 32px;
        text-align: center;
    }
    .stm_layout_creativetwo .stm_cta.style_1 .stm_cta__link {
        margin: 0;
    }

    .stm_layout_creativetwo .vc_col-sm-6:nth-of-type(2n+1) {
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
    .stm_layout_creativetwo .stm_services.stm_services_style_12 .stm_loop__grid {
        width: 100%;
    }
    .stm_layout_creativetwo .stm_markup__post .stm_loop__grid .stm_post_type_list__single {
        width: 100%;
    }

    .stm_layout_creativetwo .wpb_text_column ul li:before {
        margin-right: 9px;
        margin-left: -15px;
    }
    .stm_layout_creativetwo .wpb_text_column ul li {
        display: block !important;
        padding-left: 15px;
    }

    .stm_layout_creativetwo.wpb-js-composer .vc_tta.vc_general .vc_tta-panel {
        margin-bottom: 2px;
    }

    .stm-footer .menu {
        flex-wrap: wrap;
        padding-bottom: 24px;
    }
    .stm-footer .menu li {
        width: 50%;
        text-align: center;
        margin: 5px 0 !important;
    }

    .stm_layout_creativetwo .stm_loop__single_list_style_2 .stm_loop__content {
        padding: 20px;
    }
    .stm_layout_creativetwo.stm_post_style_2 .stm_post_details .post_details {
        padding-top: 0;
        border-top: 0;
    }
}

@media (max-width: 550px)  {
    .stm_layout_creativetwo.stm_sidebar_style_1 .stm-footer {
        padding: 50px 0 15px;
    }
    .stm-footer .footer-widgets {
        padding-bottom: 0;
    }
    .stm_layout_creativetwo .stm-footer .footer-widgets aside.widget {
        margin-bottom: 10px;
    }

    .stm_layout_creativetwo .stm_post_details ul {
        display: flex;
        flex-wrap: wrap;
    }
    .stm_layout_creativetwo .stm_post_details ul li {
        margin-right: 15px !important;
    }
    .stm_layout_creativetwo.stm_tabs_style_4 .vc_tta-panels-container .vc_tta-panel .vc_tta-title-text {
        font-size: 18px;
    }
}