<?php
/* Colors */
$main_color=pearl_get_option('main_color');
$secondary_color=pearl_get_option('secondary_color');
$third_color=pearl_get_option('third_color');

/* Fonts */
$fonts=pearl_get_font();
$main_font=$fonts['main'];
$secondary_font=$fonts['secondary'];

?>
<style>
* {}
/* font: main */
body,
body a {
    color: #ffffff;
}

p {
    <?php if( !empty($main_font['name'])): ?> 
    font-family: <?php echo esc_attr($main_font['name']);?> !important;
    <?php endif;?>
}
/* font: main */


/* font: secondary */
.stm_testimonials_style_24 .stm_testimonials__info h6 {
    <?php if( !empty($main_font['name'])): ?> 
    font-family: <?php echo esc_attr($secondary_font['name']);?> !important;
    <?php endif;?>
}

/* font: secondary */


/* text-color: main-color */
.stm_single_event__actions>.btn,
.stm_events_list_style_1 .stm_event_single_list>div.hasButton .btn,
.stm_upcoming_event_style_1 .stm_upcoming_event__title h5 a:hover,
.services_price_list_style_2 .service__name a,
.stm_layout_hosting .services_price_list_style_2 .service__cost,
.stm_layout_hosting .services_price_list_style_2.services_price_list_tabs .services_pills_container>ul>li.active a,
.services_price_list_style_1 .service__name a,
.services_price_list_style_1 .services_pills_container>ul>li:not(.active) a:hover,
.stm_staff_list_style_4 .stm_staff__links .btn:hover,
.stm_staff_list_style_5 .btn,
.stm_staff_grid_style_4 .stm_staff__socials li a,
.stm_post_type_list_style_3 .stm_post_type_list__single:hover h4,
.btn.btn_solid.btn_default:hover,
.ccb-main-calc a.ccb-next-button:hover,
.stm_tabs_style_7 .vc_tta.vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab.vc_active .vc_tta-icon,
.stm_pricing-table_style_9 .stm_pricing-table__head h5,
.stm_pricing-table_style_9 .stm_pricing-table__list-icon,
html body ul li.stm_megamenu>ul.sub-menu>li>a:hover,
.stm-header a.btn,
.mc4wp_form_hosting button.btn:hover,
.stm-counter_style_13 .stm-counter__value,
.stm-counter_style_13 .stm-counter__prefix,
.stm-counter_style_13 .stm-counter__affix,
.stm_testimonials_style_25 .stm_testimonials__info span,
.stm_layout_hosting .stm_staff_container_grid.style_5 .stm_staff__socials li a:hover {
    color: <?php echo esc_attr($main_color) ?> !important;
}

@media (max-width: 1023px) {
    .stm_layout_hosting .stm-header .stm-navigation ul li.stm_megamenu ul.sub-menu > li.active > a {
        color: <?php echo esc_attr($main_color) ?> !important;
    }
}
/* text-color: main-color */


/* text-color: secondary-color */
.stm_layout_hosting .stm_widget_search.style_1 .widget.widget_search .search-form .form-control,
.stm_vacancies_style_3 h2,
ul.comment-list .comment .comment-author,
.stm_single_event__actions>.btn:hover,
.stm_single_event_part-label,
.stm_events_list_style_1 .stm_event_single_list>div,
.stm_events_list_style_1 .stm_event_single_list>div.hasTitle h3,
.stm_events_list_style_1 .stm_event_single_list>div.hasButton .btn:hover,
.stm_vacancies_style_1 .stm_vacancies__single,
.stm_stories_list_style_1 .stm_loop__story_1 .inner .stm_story_intro,
.services_price_list_style_2 .service__text,
.stm_schedule_style_1 .event_lesson_tabs a,
.stm_schedule_style_1 .event_lesson_tabs a span,
.stm_schedule_style_1 .event_lesson_info_time_loc,
.stm_schedule_style_1 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_info_title,
.stm_schedule_style_1 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_info_description,
.stm_schedule_style_1 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_speakers li .event_speaker_content .event_speaker_description,
.stm_services_style_6 .stm_loop__single_style6 .inner .inner_info p,
.stm_services_style_6 .stm_loop__single_style6 .inner .inner_info h5,
.stm_services_style_3 .stm_read_more_link,
.stm_services_text_carousel_style_1 .stm_services_carousel .item .content h5 a,
.stm_services_style_1 .stm_loop__single p,
.stm_posttimeline_style_1 .stm_posttimeline__heading h4,
.stm_posttimeline_style_1 .stm_posttimeline__post p,
.stm_sidebar_style_1 .stm_markup__sidebar .widget .widgettitle h5,
.stm_post_type_list_style_1 .stm_post_type_list__content h4,
.stm_widget_posts.style_1 ul li .stm_widget_posts__title,
.stm_widget_posts.style_2>ul li .stm_widget_posts__title,
.stm_opening_hours_table_style_1 .day>div,
.stm_partners_style_2 .stm_partners__title,
.stm_partners_style_2 .stm_partners__description,
.stm-footer .stm-socials i,
.stm_iconbox_style_2 .stm_iconbox__text h5,
.stm_projects_carousel__tab a,
.btn.btn_outline.btn_primary.btn_load span,
.stm_pricing-table_style_4 .stm_pricing-table__pricing,
.ccb-main-calc .ccb-next-button,
.stm_staff_container_list .stm_staff_list_style_2 .stm_staff__socials a:hover i {
    color: <?php echo esc_attr($secondary_color) ?> !important;
}

@media (max-width: 1023px) {
    .stm_layout_hosting .stm-header .stm-navigation ul li.stm_megamenu ul.sub-menu > li > a {
        color: <?php echo esc_attr($secondary_color) ?> !important;
    }
}
/* text-color: secondary-color */


/* text-color: third-color */
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a, 
html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a,
.stm_vacancies_style_3 .stm_details .info .stm_details__value,
.stm_project_details_style_4 .stm_project_details__label,
.stm_upcoming_event_style_1 .stm_upcoming_event__date-title,
.stm_upcoming_event_style_1 .stm_upcoming_event__title h5 a,
.stm_upcoming_event_style_1 .stm_upcoming_event__counter-container .counter .counter__label,
.stm_upcoming_event_style_1 .stm_upcoming_event__counter-container .counter .counter__value,
.stm_testimonials_style_1 .stm_testimonials__review,
.stm_testimonials_style_5 .stm_testimonials__review,
.stm_staff_container_list .stm_staff_list_style_2 .stm_staff__socials i,
.stm_layout_hosting .stm_staff_container_grid.style_4 .stm_staff__socials li a:hover,
.stm_staff_grid_style_4 .stm_staff__name,
.stm_staff_grid_style_4 .stm_staff__job,
.stm_staff_container_grid.style_5 .stm_staff__name,
.stm_staff_container_grid.style_6 .stm_staff__name,
.stm_pricing-table_style_1 .stm_pricing-table__label,
.stm_pricing-table_style_4 .stm_pricing-table__label,
.stm_posttimeline_style_2 .stm_posttimeline__year span,
.stm_posttimeline_style_2 .stm_posttimeline__post_title h5 {
    color: <?php echo esc_attr($third_color) ?> !important;
}

/* text-color: third-color */


/* background-color: main-color */
.stm_footer_layout_4 .stm-footer .stm-socials a:hover,
.stm_layout_hosting .stm_post__tags a:hover,
.ccb-main-calc .ccb-inner-wrapper input[type="checkbox"]:checked+label:before,
.services_price_list_style_1.services_price_list_tabs .services_pills_container>ul>li.active a,
.stm_services_style_7 .stm_loop__grid>a.sbc,
.ccb-main-calc .ccb-next-button,
.ccb-range-slider__value,
.stm_pricing-table_style_9 .stm_pricing-table__footer .btn:hover,
.stm_pricing-table_style_9 .stm_pricing-table__label,
.stm_posts_list_style_22 .stm_posts_list_single__date,
.stm-header .stm-cart_style_3 .cart .cart__quantity-badge,
.stm_staff_list_style_5 .stm_staff__socials:after {
    background-color: <?php echo esc_attr($main_color) ?> !important;
}

/* background-color: main-color */
/* background-color: secondary-color */
.stm_services_style_1 .stm_loop__single .stm_separator,
.stm_layout_hosting .stm_partners_style_2 .stm_partners__title:before,
.ccb-main-calc a.ccb-next-button:hover {
    background-color: <?php echo esc_attr($secondary_color) ?> !important;
}

/* background-color: secondary-color */
/* background-color: third-color */
.stm_footer_layout_4 .stm-footer .stm-socials a,
.stm_blockquote_style_3 blockquote,
.stm_staff_list_style_6 .stm_staff__socials li a,
.stm_services_style_3 .stm_services__container,
.stm_services_style_7 .stm_loop__grid>a.sbc:hover,
.stm_author_box,
.stm_testimonials_style_4 .stm_testimonials__review,
.stm_pricing-table_style_1,
.stm_pricing-table_style_2,
.stm_icon_links.stm_icon_links_style_1 a:hover,
.ccb-main-calc,
.stm_staff_list_style_4 .stm_staff__image:before,
.stm_staff_list_style_4 .stm_staff__image:after,
.stm_staff_list_style_6 {
    background-color: <?php echo esc_attr($third_color) ?> !important;
}

/* background-color: third-color */

.stm_single_stm_events .stm_markup__content .stm_single_event__form {
    background-color: transparent !important;
}

/* border colors */
.stm_layout_hosting .vc_tta .vc_tta-tabs-container:before {
    border-top: 1px solid <?php echo esc_attr($third_color) ?>;
}

.stm_testimonials_style_4 .stm_testimonials__review:after {
    border-color: <?php echo esc_attr($third_color) ?> transparent transparent transparent !important;
}

.ccb-main-calc .ccb-inner-wrapper input[type="checkbox"]:checked+label:before,
.stm_staff_list_style_5,
.stm_staff_list_style_5 .stm_staff__image,
.stm_staff_list_style_5 .stm_staff__socials,
.stm_staff_list_style_5 .stm_staff__socials li,
.stm_staff_list_style_4 .stm_staff__links .btn:hover,
.mc4wp_form_hosting button.btn:hover,
.wpb_text_column ul li:before,
.stm_pricing-table_style_9 .stm_pricing-table__footer .btn:hover {
    border-color: <?php echo esc_attr($main_color) ?> !important;
}

.stm_services_style_3 .stm_services__container,
.stm_pricing-table_style_1 {
    border-color: <?php echo esc_attr($third_color) ?> !important;
}

.ccb-range-slider__value:after {
    border-right-color: <?php echo esc_attr($main_color) ?> !important;
}

/* border colors */

body {
    background: rgb(21, 28, 87);
    background: linear-gradient(180deg, rgba(21, 28, 87, 1) 0%, rgba(2, 2, 48, 1) 100%);
}

.home #wrapper {
    padding-bottom: 18px;
}

.btn {
    font-size: 14px !important;
}

.btn.btn_xs {
    padding-top: 4px;
}

/* header */
.stm-header a.btn {
    height: 40px;
    line-height: 34px;
    padding: 0 18px;
    font-size: 14px;
}

.btn.btn_divider .btn__label, 
.btn.btn_divider .btn_subtitle_label {
    line-height: 1.3;
}

.stm-header .stm-navigation ul li a {
    text-transform: uppercase;
}

.stm-navigation__line_top>ul>li:hover:before {
    top: -56px;
}

html body.stm_layout_hosting .stm-navigation__default ul li.stm_megamenu>ul.sub-menu, 
html body.stm_layout_hosting .stm-navigation__fullwidth ul li.stm_megamenu>ul.sub-menu {
    padding-bottom: 35px;
}

@media (max-width: 1023px) {
    body.stm_header_style_11 .stm-navigation__default>ul>li .stm_mobile__dropdown {
        height: 48px !important;
    }
    body.stm_header_style_11 .stm-navigation__default > ul > li .stm_mobile__dropdown:after {
        border-color: #fff transparent transparent transparent !important;
    }

    html body .stm-navigation__default ul li.stm_megamenu ul.sub-menu li a, 
    html body .stm-navigation__fullwidth ul li.stm_megamenu ul.sub-menu li a,
    html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a, 
    html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a {
        padding: 15px 30px 15px 0 !important;
    }
}

/* header */


.full_img img {
    max-width: initial;
}

@media (max-width: 1023px) {
    .full_img img {
        max-width: 100%;
    }

    .stm-header {
        background: rgb(21, 28, 87);
        background: linear-gradient(180deg, rgba(21, 28, 87, 1) 0%, rgba(2, 2, 48, 1) 100%);
    }
}


/* partners */
.stm_layout_hosting .stm_partners_style_3 .stm_partners__single {
    opacity: .3;
    filter: brightness(0) invert(1) !important;
}

/* partners */


/* tabs */
@media (max-width: 767px) {
    .vc_tta-tabs .vc_tta-panel-title a {
        display: flex;
        align-items: center;
    }
}
/* tabs */

/* pricing plans */
.stm_pricing-table_style_9 .stm_pricing-table__list-icon.icon-internet {
    font-size: 26px;
}

.stm_pricing-table_style_9 .stm_pricing-table__list-icon.icon-www {
    font-size: 22px;
}

@media (max-width: 767px) {
    .wpb-js-composer .vc_tta.vc_general .vc_tta-panel.vc_active .vc_tta-panel-body {
        padding: 10px;
    }
}

/* pricing plans */


/* calculator */
.ccb-main-calc {
    position: relative;
    border-radius: 20px;
}

.ccb-main-calc .form-wrapper {
    padding: 40px;
}

.ccb-main-calc .form-wrapper-content {
    margin: 0;
}

.ccb-main-calc .form-wrapper .form-inner-content {
    background: none;
}

.ccb-main-calc .ccb-horizontal-calc-wrapper+.ccb-main-calc .ccb-horizontal-calc-wrapper {
    margin-top: 30px;
}

.ccb-main-calc h3,
.ccb-main-calc .ccb-horizontal-summary-title {
    display: none;
}

.ccb-main-calc .ccb-total-description li:before,
.ccb-main-calc #ccb-horizontal-total-summary li:before,
.ccb-main-calc .ccb-summary-title h4::before,
.ccb-main-calc .ccb-summary-value:after {
    content: none;
}

.ccb-main-calc .form-wrapper label {
    font-weight: 400;
    margin-bottom: 8px !important;
}

.ccb-main-calc .ccb-summary-value {
    background: none;
    border: none;
    box-shadow: none;
    height: auto;
    font-size: 24px;
    padding: 0 0 0 10px;
    min-width: auto;
}

.ccb-main-calc #ccb-horizontal-main {
    display: flex;
    flex-wrap: wrap;
}

.ccb-main-calc #ccb-horizontal-total-summary {}

.ccb-main-calc .ccb-horizontal-summary-list {
    border: none !important;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    font-size: 16px;
    font-weight: 400 !important;
    margin: 0 !important;
}

.stm_layout_hosting #ccb-horizontal-total-summary .form-wrapper-content.next-button-active {
    margin: -44px 0 0 0 !important;
    float: right !important;
    width: auto !important;
}

.ccb-main-calc a.ccb-next-button {
    padding: 15px 30px !important;
    transform: none !important;
    height: 50px;
    line-height: 20px;
    border: none;
    border-radius: 50px;
    font-weight: bold;
}

.ccb-main-calc .ccb-next-button:before,
.ccb-main-calc .ccb-next-button:after {
    content: none;
}

.ccb-main-calc .ccb-range-slider {
    display: flex;
    align-items: center;
}

.ccb-main-calc .ccb-range-slider__range {
    background-color: rgba(255, 255, 255, .2) !important;
    height: 2px;
}

.ccb-main-calc .ccb-range-slider__value {
    margin-left: 15px;
}

input[type=range]::-ms-track {
    background-color: <?php echo esc_attr($main_color) ?> !important;
}

.ccb-main-calc .ccb-range-slider__range::-webkit-slider-thumb {
    background-color: <?php echo esc_attr($main_color) ?> !important;
}

.ccb-main-calc .ccb-range-slider__range::-webkit-slider-thumb:hover {
    background-color: <?php echo esc_attr($main_color) ?> !important;
}

.ccb-main-calc .ccb-range-slider__range:active::-webkit-slider-thumb {
    background-color: <?php echo esc_attr($main_color) ?> !important;
}

.ccb-main-calc .ccb-range-slider__range::-moz-range-thumb {
    background-color: <?php echo esc_attr($main_color) ?> !important;
}

.ccb-main-calc .ccb-range-slider__range::-moz-range-thumb:hover {
    background-color: <?php echo esc_attr($main_color) ?> !important;
}

.ccb-main-calc .ccb-range-slider__range:active::-moz-range-thumb {
    background-color: <?php echo esc_attr($main_color) ?> !important;
}

.ccb-main-calc .ccb-range-slider__range:focus::-webkit-slider-thumb {
    background-color: <?php echo esc_attr($main_color) ?> !important;
}

.ccb-send-form-wrapper legend {
    color: #fff;
}

.ccb-send-form-wrapper input {
    margin-bottom: 20px;
}

.ccb-main-calc .ccb-inner-wrapper {}

.ccb-main-calc .ccb-inner-wrapper input[type="checkbox"] {
    display: none;
}

.ccb-main-calc .ccb-inner-wrapper input[type="checkbox"]+label {}

.ccb-main-calc .ccb-inner-wrapper input[type="checkbox"]+label:before {
    content: '';
    width: 20px;
    height: 20px;
    display: inline-block;
    border-radius: 4px;
    border: 2px solid rgba(255, 255, 255, .2);
    vertical-align: text-bottom;
    margin-right: 6px;
    font-family: FontAwesome;
    line-height: 16px;
    font-size: 14px;
    text-align: center;
}

.ccb-main-calc .ccb-inner-wrapper input[type="checkbox"]:checked+label:before {
    content: "\f00c";
    color: rgba(0, 0, 0, .5);
}

.ccb-send-form-wrapper legend,
.ccb-total-description li+li {
    border-color: rgba(255, 255, 255, .1);
}
.ccb-send-form-wrapper label {
    font-size: 14px;
    margin: 0 0 0 20px;
}
.ccb-send-form-wrapper input {
    padding: 10px 34px !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
    height: 40px !important;
}

.ccb-main-calc .ccb-inner-wrapper ::selection {
    background-color: transparent;
}


@media (max-width: 576px) {
    .ccb-main-calc .form-wrapper {
        padding: 20px;
    }

    .ccb-main-calc .ccb-horizontal-summary-list {
        justify-content: center;
        margin: 0 0 20px !important;
    }

    .stm_layout_hosting #ccb-horizontal-total-summary .form-wrapper-content.next-button-active {
        float: none !important;
        width: 125px !important;
        margin: 0px auto !important;
    }

    .ccb-main-calc form.ccb-send-form-wrapper {
        padding: 20px !important;
        margin: 0 -10px;
    }
}

/* calculator */


/* mc4wp form */
.mc4wp_form_hosting {
    display: flex;
}

.mc4wp_form_hosting .form-group {
    margin-right: 20px;
    margin-bottom: 0 !important;
    width: 100%;
}

.mc4wp_form_hosting .btn {
    min-width: 175px;
}

@media (max-width: 767px) {
    .mc4wp_form_hosting {
        flex-direction: column;
    }

    .mc4wp_form_hosting .form-group {
        margin-right: 0;
        margin-bottom: 20px !important;
        width: 100%;
    }
}

/* mc4wp form */


/* footer */
.stm-footer .footer-widgets .widget_nav_menu {
    margin: 0 !important;
    width: 100% !important;
}

.stm-footer .footer-widgets .widget_nav_menu .menu {
    justify-content: center;
    flex-wrap: wrap;
    display: flex;
}

.stm-footer .footer-widgets .widget_nav_menu .menu li {
    padding: 0 13px;
    font-size: 14px;
}

@media (max-width: 576px) {
    .stm-footer .footer-widgets .widget_nav_menu .menu {
        flex-direction: column;
        align-items: center;
    }
}

/* footer */

/* carousel */
.stm_carousel_style_1 .owl-controls {
    padding-top: 15px;
}
/* carousel */


/* donations */
.stm_donation_style_1 .stm_donation__title h5 a,
.stm_donation_style_1 .stm_donation__details {
    color: #000;
}

.stm_donation_style_1 .stm_donation__progress-bar {
    background-color: <?php echo esc_attr($main_color) ?> !important;
}

.stm_layout_hosting .stm_donation_style_2 .stm_donation__details {
    background-color: transparent;
}

/* donations */


/* partners */
.stm_partners_style_1 .stm_partners__single .stm_partners__image,
.stm_partners_style_2 .stm_partners__single .stm_partners__image {
    background-color: #fff;
}

/* partners */


/* post */
.stm_layout_hosting .stm_page_bc .stm_breadcrumbs,
.stm_layout_hosting .stm_post_details .post_details {
    border-color: rgba(255, 255, 255, .1) !important;
}

.stm_layout_hosting .stm_post_details span,
.stm_layout_hosting .stm_page_bc .stm_breadcrumbs {
    color: rgba(255, 255, 255, 0.5) !important;
}


.stm_layout_hosting .stm_post_details .post_date span,
.stm_layout_hosting .stm-header a.btn,
.stm_layout_hosting .stm_post_details .comments_num a,
.stm_layout_hosting .stm_post_type_list_style_2 .stm_post_type_list__content h4,
.stm_layout_hosting .stm_page_bc .stm_breadcrumbs a {
    color: #fff !important;
}

.stm_layout_hosting .stm_post_type_list_style_2 .stm_post_type_list__single {
    background-color: rgba(255, 255, 255, .1);
}

.stm_layout_hosting .stm_post__tags a {
    color: #fff !important;
    background-color: transparent !important;
}
/* post */

/* sidebar */

.stm_layout_hosting.stm_sidebar_style_1 .stm_markup__sidebar_divider .widget {
    border-color: transparent !important;
}
.stm_layout_hosting .stm_widget_search.style_1 .widget.widget_search .search-form .form-control {
    border-radius: 50px !important;
}

.stm_layout_hosting .stm_widget_search.style_1 .widget.widget_search .search-form button {
    width: 50px !important;
}

/* sidebar */


.stm_layout_hosting.stm_pagination_style_12 .owl-nav .owl-next:before {
    content: "\f054" !important;
    font-family: "FontAwesome" !important;
}

.stm_layout_hosting.stm_pagination_style_12 .owl-nav .owl-prev:before {
    content: "\f053" !important;
    font-family: "FontAwesome" !important;
}

/* post timeline */
.stm_posttimeline_style_2 .stm_posttimeline__year_posts_right {
    padding-top: 150px !important;
}

/* post timeline */

/* pricing lists */
.stm_layout_hosting .stm_pricing-table_style_4.has-label {
    background-color: inherit !important;
}

/* pricing lists */

/* posts */
.stm_post_comments .comment-form {
    background: none !important;
    padding: 50px 0 !important;
}

/* posts */

/* services */
.stm_loop__single.stm_repeating_line:after {
    background: repeating-linear-gradient(135deg, rgba(255, 255, 255, .5) 5px, rgba(255, 255, 255, .5) 10px, transparent 10px, transparent 15px);
}

/* services */

/* staff grid */
.stm_linear_repeater {
    background: repeating-linear-gradient(135deg, rgba(255, 255, 255, .5) 5px, rgba(255, 255, 255, .5) 10px, transparent 10px, transparent 15px);
}

/* staff grid */

/* vacancies */
.stm_vacancies_style_1 .stm_vacancies__department {
    white-space: normal !important;
}
/* vacancies */


</style>