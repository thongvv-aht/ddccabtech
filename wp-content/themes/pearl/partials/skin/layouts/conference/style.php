<?php
/*Colors*/
$main_color = pearl_get_option('main_color');
$secondary_color = pearl_get_option('secondary_color');
$third_color = pearl_get_option('third_color');
?>

body.home #wrapper{
padding-bottom: 0;
}
body.stm_layout_conference.stm_header_style_11 .stm-navigation__default > ul > li ul {
    min-width: 175px;
}
body.stm_header_style_11 .stm-navigation__default > ul > li > a:hover {
    color: inherit !important;
}
body.stm_header_style_11 .stm-navigation__default > ul > li.current-menu-parent > a {
    color: inherit !important;
}
body.stm_header_style_11 .stm-navigation__default > ul > li > ul > li > a,
body.stm_header_style_11 .stm-navigation__default > ul > li > ul > li > ul > li > a {
    color: <?php echo wp_kses_post($main_color); ?> !important;
}
body.stm_header_style_11 .stm-navigation__default > ul > li > a:hover,
body.stm_header_style_11 .stm-navigation__default > ul > li.current-menu-parent > a {
    color: #fff !important;
}
body.stm_header_style_11 .stm-navigation__default > ul > li:hover > a:after {
    opacity: 1;
    bottom: -7px;
}
body.stm_header_style_11 .stm_mobile__header {
    background-color: <?php echo wp_kses_post($main_color); ?> !important;
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li.current_page_item > a {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_conference.stm_buttons_style_8 .stm-header .stm-header-popup__button {
    background-color: transparent !important;
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    padding: 13px 28px;
    margin-left: 20px;
    text-transform: none;
    font-weight: 700;
    font-size: 17px;
}
.stm_layout_conference.stm_buttons_style_8 .stm-header .stm-header-popup__button:hover {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_conference .modal .container {
    padding: 0;
}
.stm_layout_conference .modal .close_popup {
    position: absolute;
    top: 15px;
    right: 25px;
    cursor: pointer;
}
.stm_layout_conference .modal h4 {
    margin-bottom: 30px;
}
.stm_layout_conference.stm_form_style_4 .modal .wpcf7-form-control-wrap {
    margin-bottom: 0;
}

.stm_layout_conference .stm_sliding_images.style_1 {
    text-align: right;
}
.stm_layout_conference .stm_sliding_images.style_1 .stm_sliding_image__left {
    box-shadow: 0 26px 26px rgba(0,0,0, 0.2);
    max-width: 100%;
    z-index: 9;
}
.stm_layout_conference .stm_sliding_images.style_1 .stm_sliding_image__right {
    box-shadow: 0 26px 26px rgba(0,0,0, 0.2);
    margin: -100px 110px 0 0;
    max-width: 100%;
}

.stm_layout_conference.stm_buttons_style_8 .btn {
    letter-spacing: 1px;
    border-width: 2px;
}
.stm_layout_conference.stm_buttons_style_8 .btn_lg {
    padding: 18px 38px 20px !important;
    font-size: 18px;
}

.stm_layout_conference .stm_lightgallery__iframe {
    text-decoration: none;
}
.stm_layout_conference .stmicon-play {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: all .3s ease !important;
    width: 100px;
    height: 100px;
    padding-left: 8px;
    background: <?php echo wp_kses_post($secondary_color); ?>;
    border: 4px solid <?php echo wp_kses_post($secondary_color); ?>;
    border-radius: 50%;
    color: #fff;
}
.stm_layout_conference .stmicon-play:hover {
    background: transparent;
    color: <?php echo wp_kses_post($secondary_color); ?>;
}

.stm_layout_conference .stm_breadcrumbs {
    text-transform: none;
}
.stm_layout_conference .stm_breadcrumbs span {
    text-transform: none;
}
.stm_layout_conference .stm_breadcrumbs .container {
    padding: 0;
}

.stm_layout_conference .stm_cta.style_1 {
    padding: 0;
    margin: 0;
}
.stm_layout_conference .stm_cta.style_1 .stm_cta__content {
    width: 70%;
}

.stm_layout_conference .comment-reply-link i {
    margin-right: 10px;
}
.stm_layout_conference #commentform button:after {
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

.border-radius_left_bottom .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front,
.border-radius_left_bottom .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back {
    border-radius: 0 0 0 65px !important;
}
.border-radius_top_right .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front,
.border-radius_top_right .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back {
    border-radius: 0 65px 0 0 !important;
}
.stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front,
.stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back {
    height: 430px;
    border: 0 !important;
    background-color: #f7f9ff !important;
}
.stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .inner,
.stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner {
    padding: 39px 25px;


}
.stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .inner h5,
.stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner h5 {
    margin-bottom: 2px;
    letter-spacing: 3px;
    font-weight: 300;
    font-size: 12px;
}
.stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .inner h5:last-child,
.stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner h5:last-child {
    letter-spacing: 0px;
    text-transform: none;
}
.stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .stm_pricing-table__price {
    margin-bottom: 2px;
    font-size: 56px;
    font-weight: 600;
    color: <?php echo wp_kses_post($third_color); ?> !important;
}
.stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner .btn {
    border-color: <?php echo wp_kses_post($third_color); ?> !important;
    color: <?php echo wp_kses_post($third_color); ?> !important;
}
.stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner .btn:hover {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    color: #fff !important;
}

.stm_stories_style_1 .owl-controls .owl-dots {
    display: flex;
    flex-direction: row;
}

.stm_layout_conference .stm_testimonials .owl-dots .owl-dot span {
    display: none;
}
.stm_layout_conference .stm_testimonials_style_3 .owl-dots .owl-dot {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_conference .stm_iconbox_style_6 {
    padding: 44px 30px;
}

.stm_layout_conference .stm_staff_grid_style_3 .btn {
    padding: 15px 30px;
}
.stm_layout_conference .stm_staff_grid_style_3 .btn:hover {
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_conference .btn.btn_outline.btn_xs {
    padding: 15px 30px;
}
.stm_layout_conference .btn_xs {
    padding: 15px 30px;
}
.stm_layout_conference .btn.stm_projects_carousel__btn:hover {
    color: #fff !important;
}

.stm_layout_conference .overlap_box {
    z-index: 11 !important;
}

.stm_testimonials_style_18 .stm_testimonials__review:before {
    background: -webkit-linear-gradient(45deg, #5564ff, #01b3ff 70%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.stm_layout_conference .stm_project_details_style_4 .stm_project_details__label {
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

.stm_layout_conference .stm_services_style_12 .stm_services__content:before {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_conference .stm_services_style_12 .stm_services__title a:hover {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_conference .stm_services_style_12 .stm_services__more_link {
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

.stm_layout_conference .stm_video.stm_video_style_11 .stm_video_title {
    margin-left: 2px;
    font-weight: 500;
    text-transform: lowercase;
    font-size: 16px;
}
.stm_layout_conference .color_white .stm_video.stm_video_style_11 .stm_video_title {
    color: #fff;
}
.stm_layout_conference .color_white .stm_video.stm_video_style_11 .stm_video_title:after {
    background-color: #fff !important;
    width: 100%;
    transition: all 0.3s;
}
.stm_layout_conference .color_white .stm_video.stm_video_style_11:hover .stm_video_title:after {
    width: 0;
}

.stm_layout_conference .stm_cta.style_3 .btn {
    padding-right: 46px;
}
.stm_layout_conference .stm_cta.style_3 .btn:hover {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_conference .stm_projects_carousel__tab a.active {
    color: #fff !important;
}

.stm_post_type_list_style_2 .stm_post_type_list__content h4,
.stm_testimonials_style_4 .stm_testimonials__info h6,
.stm_layout_conference .widget .widgettitle {
    text-transform: none !important;
}

.stm_post_type_list_style_2 .stm_post_type_list__content h4 {
    font-size: 14px !important;
}

.stm_layout_conference .stm_projects_grid__posts .btn.loading span,
.stm_layout_conference .stm_projects_grid__posts .btn:hover span,
.stm_layout_conference .stm_projects_grid__posts .btn:focus span,
.stm_layout_conference .stm_projects_grid__posts .btn:active span,
.stm_layout_conference .stm_projects_grid__posts .btn.btn_load:hover:before,
.stm_layout_conference .stm_projects_cards .btn.loading span,
.stm_layout_conference .stm_projects_cards .btn:hover span,
.stm_layout_conference .stm_projects_cards .btn:focus span,
.stm_layout_conference .stm_projects_cards .btn:active span,
.stm_layout_conference .stm_projects_cards .btn.btn_load:hover:before {
    color: #fff !important;
}

.stm_layout_conference .stm_pricing-table_style_2 .stm_pricing-table__head h5 {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_conference .stm_post_type_list_style_3 .stm_post_type_list__content {
    padding-right: 15px;
    padding-left: 15px;
}

.stm_layout_conference .stm_services_text_carousel_style_1 .stm_services_carousel .item .content .excerpt {
    margin-bottom: 25px;
}

.stm_layout_conference .stm_events_list.stm_events_list_style_1 a .stm_event_single_list__alone .btn:hover,
.stm_layout_conference .stm_upcoming_event_style_1 .stm_upcoming_event__actions-button:hover {
    color: #fff !important;
}

.stm_layout_conference .owl-carousel .owl-nav .owl-prev:before,
.stm_layout_conference .owl-carousel .owl-nav .owl-next:before {
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

.stm_layout_conference .stm_testimonials_style_17 {
    display: flex;
    flex-direction: column;
}
.stm_layout_conference .stm_testimonials_style_17 .stm_testimonials__review:before {
    content: "\ec93";
    display: block;
    margin: 0 auto 48px;
    font-family: 'stmicons' !important;
    font-size: 56px;
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_conference .stm_testimonials_style_17 .stm_testimonials__review {
    min-width: 780px;
    line-height: 54px;
    font-weight: 400;
    font-size: 42px;
    color: #fff;
}
.stm_layout_conference .stm_testimonials_style_17 .image_dots {
    order: 2;
    margin: 40px 0 0;
}
.stm_layout_conference .stm_testimonials_style_17 .image_dots .dots img {
    opacity: 0.5;
}
.stm_layout_conference .stm_testimonials_style_17 .image_dots .dots.active img {
    opacity: 1;
}


.stm_layout_conference .stm_loop__single_list_style_2 {
    margin-bottom: 0 !important;
}
.stm_layout_conference .stm_loop__single_grid_style_2 .stm_loop__container, .stm_single_post_style_2 .stm_loop__container {
    height: 100%;
}
.stm_layout_conference .stm_loop__single_grid_style_2 h5, .stm_single_post_style_2 h5 {
    font-weight: 400 !important;
}
.stm_layout_conference .stm_read_more_link {
    font-weight: 400 !important;
    font-size: 14px;
}

.stm_layout_conference .stm_carousel_style_1 .stm_carousel__pagination {
    bottom: 28px;
}
.stm_layout_conference .stm_carousel_style_1 .stm_carousel__pagination .current {
    color: #fff !important;
}
.owl-controls .owl-dots .owl-dot.active span {
    background-color: <?php echo wp_kses_post($main_color); ?>;
}

.admin-bar .lg-outer.lg-visible {
    top: 32px;
}

.stm_layout_conference .custom_conference_box,
.stm_layout_conference .custom_conference_box_inner {
    z-index: 20;
}
.custom_conference_box_inner .vc_column-inner {
    width: auto !important;
}

.stm_layout_conference .stm-footer {
    font-size: 12px;
}
.stm_layout_conference .stm-footer .footer-widgets aside.widget .widgettitle h4 {
    text-transform: none;
    font-size: 18px;
    color: #fff !important;
}
.stm_layout_conference .stm-footer p {
    margin-bottom: 22px;
}
.stm_layout_conference.stm_sidebar_style_1 .stm_wp_widget_text .textwidget {
    padding-right: 0;
}
.stm_layout_conference .widget_follow.widget_follow_style_1 .stm-icontext_style1 {
    margin-bottom: 14px;
}
.stm_layout_conference .widget_follow.widget_follow_style_1 a {
    display: flex;
    flex-direction: row;
    align-items: center;
}
.stm_layout_conference .widget_follow.widget_follow_style_1 a .stm-icontext__icon {
    width: 16px;
    height: auto;
    margin: 0 18px 0 0;
    line-height: 18px;
    background-color: transparent !important;
    font-size: 18px;
    opacity: 0.30;
}
.stm_layout_conference .widget_follow.widget_follow_style_1 a .stm-icontext__text {
    top: 0;
    font-size: 12px;
}
.archive.stm_header_transparent .stm-header{
    position: relative;
}

.stm_layout_conference .stm_post_details .post_date {
    width: auto;
}


@media (max-width: 1270px)  {
    .stm_layout_conference .custom_conference_box {
        margin: 0 !important;
    }
    .custom_conference_box_inner .vc_column-inner {
        margin: 0 15px !important;
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

    .stm_layout_conference .stm_testimonials_style_17 .stm_testimonials__review {
        min-width: 600px;
    }
}

@media (min-width: 1024px)  {
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
    body.stm_header_style_11 .stm-navigation__default > ul > li.stm_megamenu > a:after {
        display: none;
    }
}

@media (max-width: 1024px)  {
    .stm_layout_conference .stm_mobile__logo {
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
}

@media (max-width: 1023px)  {
    .archive.stm_header_transparent .stm-header{
        position: fixed;
    }
    .stm_layout_conference .stm_mobile__header {
        padding-left: 0;
        padding-right: 0;
    }
    body.stm_layout_conference .stm_mobile__switcher span {
        background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    }
    body.stm_layout_conference .stm-header__row_color_center:before {
        background-color: #ffffff !important;
    }
    body.stm_header_style_11 .stm-navigation__default > ul > li > a {
        color: <?php echo wp_kses_post($main_color); ?>;
    }
    body.stm_layout_conference.stm_header_style_11 .stm-navigation__default > ul > li > a:hover {
        color: <?php echo wp_kses_post($main_color); ?> !important;
    }
    body.stm_header_style_11 .stm-navigation__default > ul > li ul.sub-menu {
        padding: 5px 0 !important;
    }
    body.stm_layout_conference.stm_header_style_11 .stm-navigation__default .stm_megamenu > ul > li ul.sub-menu li {
        margin-bottom: 0 !important;
    }
    body.stm_layout_conference.stm_header_style_11 .stm-navigation__default .stm_megamenu > ul > li ul.sub-menu li a {
        padding: 11px 0 !important;
        padding-left: 20px !important;
    }

    .stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner ul li {
        padding: 7px 0;
    }
    .stm_layout_conference .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner .btn {
        padding: 14px 26px;
    }

    html body.stm_layout_conference .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li.current-menu-item > a {
        background-color: <?php echo wp_kses_post($main_color); ?> !important;
        color: #fff !important;
    }
    body.stm_layout_conference.stm_header_style_11 .stm-navigation__default>ul>li ul li:hover a, 
    body.stm_layout_conference.stm_header_style_11 .stm-navigation__default>ul>li ul li.current-menu-item a,
    .stm_layout_conference .stm-header__row_color_center li:hover > a {
        color: #000 !important;
    }
}

@media (max-width: 991px)  {
    .mobile-empty-space .vc_column-inner {
        margin-left: 0 !important;
        padding-right: 15px !important;
        padding-left: 15px !important;
    }

    .stm_layout_conference .custom_conference_box {
        padding: 40px 15px 55px !important;
    }
    .stm_layout_conference .custom_conference_box_inner .vc_column-inner {
        padding: 0 15px !important;
    }

    body.stm_layout_conference.stm_header_style_11 .stm_mobile__header {
        padding-bottom: 30px;
    }
    .stm_layout_conference .stm_services.stm_services_style_12 .stm_loop__grid {
        width: 50%;
    }

    .stm_layout_conference .stm_markup__post .stm_loop__grid .stm_post_type_list__single {
        width: 50%;
    }

    .stm_layout_conference .services_price_list_style_1 .services_pills_container {
        margin-bottom: 0;
    }
    .stm_layout_conference .services_price_list_style_1 .service__tab {
        flex-direction: column;
    }

    .stm_layout_conference .stm_loop__single_list_style_2 .stm_loop__content {
        padding: 0 20px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }
    .stm_layout_conference .stm_loop__single_list_style_2 .stm_post_details {
        margin-bottom: 10px;
    }
    .stm_layout_conference .stm_loop__single_list_style_2 .post_excerpt.stm_mgb_34 {
        margin-bottom: 10px;
    }

    .quaint_box {
        margin: 0 15px;
    }

    .mobile_align_center_button {
        display: block;
        max-width: 300px;
        margin: 0 auto;
        text-align: center;
    }
}

@media (min-width: 992px) {
    .consulting-video-margin-right {
        margin-right: 17px;
    }
}

@media (max-width: 768px)  {
    .stm_layout_conference .stm_cta.style_1 {
        flex-direction: column;
    }
    .stm_layout_conference .stm_cta.style_1 .stm_cta__content {
        width: 100%;
        padding-right: 0;
        margin-bottom: 32px;
        text-align: center;
    }
    .stm_layout_conference .stm_cta.style_1 .stm_cta__link {
        margin: 0;
    }

    .stm_layout_conference .vc_col-sm-6:nth-of-type(2n+1) {
        clear: none;
    }
}

@media (max-width: 767px)  {
    .stm_layout_conference .custom_conference_box,
    .stm_layout_conference .custom_conference_box_inner {
        padding: 35px 15px 50px !important;
    }
    .stm-counter.stm-counter_style_9 .stm-counter__value {
        font-size: 38px;
    }
    .stm-counter.stm-counter_style_9 .stm-counter__label {
        margin-top: 3px;
    }
    .stm_layout_conference .stm_services.stm_services_style_12 .stm_loop__grid {
        width: 100%;
    }
    .stm_layout_conference .stm_markup__post .stm_loop__grid .stm_post_type_list__single {
        width: 100%;
    }

    .stm_layout_conference .wpb_text_column ul li:before {
        margin-right: 9px;
        margin-left: -15px;
    }
    .stm_layout_conference .wpb_text_column ul li {
        display: block !important;
        padding-left: 15px;
    }

    .stm_layout_conference.wpb-js-composer .vc_tta.vc_general .vc_tta-panel {
        margin-bottom: 2px;
    }

    .stm_layout_conference .stm_loop__single_list_style_2 .stm_loop__content {
        padding: 20px;
    }
    .stm_layout_conference.stm_post_style_2 .stm_post_details .post_details {
        padding-top: 0;
        border-top: 0;
    }

    .stm_layout_conference .stm_testimonials_style_17 .stm_testimonials__review:before {
        font-size: 36px;
    }
    .stm_layout_conference .stm_testimonials_style_17 .stm_testimonials__review {
        min-width: 280px;
        line-height: 42px;
        font-size: 32px;
    }
}

@media (max-width: 550px)  {
    .stm_layout_conference .stm_post_details ul {
        display: flex;
        flex-wrap: wrap;
    }
    .stm_layout_conference .stm_post_details ul li {
        margin-right: 15px !important;
    }
    .stm_layout_conference.stm_tabs_style_4 .vc_tta-panels-container .vc_tta-panel .vc_tta-title-text {
        font-size: 18px;
    }
}