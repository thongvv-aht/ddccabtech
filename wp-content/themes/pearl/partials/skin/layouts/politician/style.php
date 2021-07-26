<?php
/*Fonts*/
$fonts = pearl_get_font();

$main_font = $fonts['main'];
$secondary_font = $fonts['secondary'];

/*Colors*/
$main_color = pearl_get_option('main_color', $default['main_color']);
$secondary_color = pearl_get_option('secondary_color', $default['secondary_color']);
$third_color = pearl_get_option('third_color', $default['third_color']);
?>
body.home #wrapper{
padding-bottom: 0;
}
.stm_layout_politician .btn.btn_icon-right{
    padding-right: 39px;
}

.stm_layout_politician .btn_white.btn_solid:hover i, .stm_layout_politician .btn.btn_icon-right:hover i{
   color: #fff !important;
}

.stm_layout_politician .stm_breadcrumbs {
    text-transform: none;
}
.stm_layout_politician .stm_breadcrumbs span {
    font-size: 12px;
    text-transform: none;
}
.stm_layout_politician .stm_breadcrumbs .container {
    padding: 0;
}

.stm-header__row_color.pearl_is_sticky.pearl_going_sticky,
body.stm_transparent_header_disabled .stm-header,
.stm_mobile__header {
    box-shadow: 0 3px 12px rgba(<?php echo wp_kses_post(pearl_hex2rgb($main_color, 0.2)); ?>);
}

.stm_layout_politician .stm_breadcrumbs {
    margin-bottom: 50px;
    margin-top: 20px;
    border: 0;
}

body.stm_header_style_11 .stm-navigation__default ul li a {
    font-weight: 500 !important;
}
html body.stm_header_style_11 .stm-navigation__default > ul > li > a {
    padding: 10px 21px;
    color: <?php echo wp_kses_post($main_color); ?>;

}
html body.stm_header_style_11 .stm-navigation__default > ul > li > a:hover {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu,
html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu {
    box-shadow: 0 8px 23px rgba(0,1,16, 0.3) !important;
    border-top: 3px solid <?php echo wp_kses_post($secondary_color); ?>;
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu li a,
html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu li a {
    font-weight: 400 !important;
}
html body .stm-navigation__default ul li.stm_megamenu:hover ul.sub-menu,
html body .stm-navigation__fullwidth ul li.stm_megamenu:hover ul.sub-menu {
    transform: translateY(10px);
}
html body.stm_header_style_11 .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li:hover a {
    color: <?php echo wp_kses_post($main_color); ?> !important;
}
html body.stm_header_style_11 .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li:hover ul.sub-menu > li > a {
    color: <?php echo wp_kses_post($third_color); ?> !important;
}

.stm_layout_politician .btn {
    padding: 14px 24px 12px;
    white-space: normal;
    font-weight: 500 !important;
}
.stm_layout_politician .btn .btn__label {
    display: inline-block;
    font-weight: 500;
    font-size: 18px;
}

.stm_layout_politician .stm-header .btn {
    padding: 10px 24px 11px;
    margin-left: 10px;
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    font-size: 16px;
}
.stm_layout_politician .stm-header .btn:hover {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_single_donation__action .btn {
    white-space: nowrap;
    height: 58px;
    padding: 12px 24px 12px;
    text-align: center;
    font-weight: 500;
    font-size: 20px;
    line-height: 28px;
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    color: #fff !important;
}
.stm_single_donation__action .btn:hover {
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
    background-color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_single_donation_style_1 .stm_single_donation__details {
    border: 0 !important;
    box-shadow: 0 8px 23px rgba(<?php echo wp_kses_post(pearl_hex2rgb($main_color, 0.4)); ?>);
}
.stm_single_donation__content ul {
    padding-left: 0;
    margin-bottom: 30px;
}
.stm_single_donation__content ul li {
    list-style: none;
}
.stm_single_donation__content ul li::before {
    content: '';
    height: 4px;
    width: 4px;
    border-radius: 50%;
    display: inline-block;
    margin: 0 12px;
    background-color: <?php echo wp_kses_post($secondary_color); ?>
}
.stm_single_donation_style_1 .stm_post_info > ul li.post_date i:before {
    content: "\d9611";
}
.stm_single_donation_style_1 .stm_donation_popup .stm_input_wrapper_radio.active + label {
    color: #fff;
}

.vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-controls-icon {
    transform: rotate(180deg);
}

.stm_layout_politician .stm_testimonials_style_4 .stm_testimonials__review {
    font-weight: 500;
}
.stm_layout_politician .stm_testimonials_style_4 .stm_testimonials__info h6 {
    text-transform: none !important;
}

.overlap {
    z-index: 20;
}

.stm_layout_politician .stm_cta.style_1 {
    padding: 40px 60px;
    background-color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_layout_politician .stm_cta.style_1 .stm_cta__content {
    max-width: 500px;
}
.stm_layout_politician .stm_cta.style_1 .stm_cta__link .btn {
    font-size: 18px;
}
.stm_layout_politician .stm_cta.style_1 .stm_cta__link .btn:hover {
    background: transparent !important;
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_politician .stm_video.stm_video_style_4 {
    box-shadow: 0 8px 23px rgba(<?php echo wp_kses_post(pearl_hex2rgb($main_color, 0.4)); ?>);
}
.stm_layout_politician .stm_video.stm_video_style_4 .stm_playb {
    width: 70px;
    height: 70px;
    margin: -35px 0 0 -35px;
    opacity: 1;
}
.stm_layout_politician .stm_video.stm_video_style_4:hover .stm_playb:after {
    background-color: rgba(<?php echo wp_kses_post(pearl_hex2rgb($main_color, 0.4)); ?>) !important;
}
.stm_layout_politician .stm_video.stm_video_style_4 .stm_playb:before {
    margin-left: -6px;
    border-width: 11px 0 11px 16px;
    border-left-color: #fff;
    border-top-color: transparent;
    border-bottom-color: transparent;
    border-right-color: transparent;
}
.stm_layout_politician .stm_video.stm_video_style_4 .stm_playb:after {
    border-width: 3px !important;
}

.stm_layout_politician .stm_iconbox_style_3 .stm_iconbox__icon {
    margin-top: 4px;
    margin-right: 25px;
}
.stm_layout_politician .stm_iconbox_style_3 .stm_iconbox__text h5 {
    margin-bottom: 10px;
    line-height: 22px;
    font-size: 19px;
}
.stm_layout_politician .stm_iconbox_style_3 .stm_iconbox__text p {
    font-size: 15px;
    line-height: 26px;
}

.stm_layout_politician.stm_sidebar_style_1 .stm_widget_posts.style_1 ul li img {
    margin-right: 27px;
}
.stm_layout_politician.stm_sidebar_style_1 .stm_widget_posts.style_1 ul li .stm_widget_posts__title {
    margin-top: -1px;
    line-height: 24px;
    font-weight: 500;
    font-size: 18px;
    color: <?php echo wp_kses_post($main_color); ?>;
}
.stm_layout_politician.stm_sidebar_style_1 .stm_widget_posts.style_1 ul li .post-date {
    font-size: 14px;
    color: #808080;
}
.stm_layout_politician.stm_sidebar_style_1 .stm_widget_posts.style_1 ul li .post-date:before {
    content: "\d9611";
    font-family: 'stmicons';
    position: relative;
    top: 2px;
    left: 2px;
    font-size: 16px;
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_politician.stm_sidebar_style_1 .stm_widget_posts.style_1 ul li:last-child .post-date {
    bottom: 30px;
}
.stm_layout_politician.stm_sidebar_style_1 .stm_widget_posts.style_1 ul li a {
    border-bottom: 1px solid #e5e5e5;
}
.stm_layout_politician.stm_sidebar_style_1 .stm_widget_posts.style_1 ul li:last-child a {
    padding-bottom: 30px;
    margin-bottom: 25px;
    border-bottom: 1px solid #e5e5e5;
}
.stm_layout_politician.stm_sidebar_style_1 .stm_markup__sidebar .stm_widget_posts.style_1 ul li img {
    margin-right: 17px;
    width: 60px;
}
.stm_layout_politician.stm_sidebar_style_1 .stm_markup__sidebar .stm_widget_posts.style_1 ul li .stm_widget_posts__title {
    font-size: 15px;
    line-height: 20px;
    margin-bottom: 10px;
}

.stm_layout_politician.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-body {
    padding: 24px 27px 27px;
}
.stm_layout_politician.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading .vc_tta-panel-title > a {
    font-size: 18px;
}
.stm_layout_politician.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading .vc_tta-panel-title > a .vc_tta-title-text {
    font-weight: 500;
    color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_layout_politician.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading .vc_tta-panel-title > a:hover .vc_tta-title-text {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_politician.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading .vc_tta-panel-title > a .vc_tta-title-text {
    color: #fff !important;
}
.stm_layout_politician.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading .vc_tta-controls-icon {
    color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_layout_politician.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading:hover .vc_tta-controls-icon {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_politician.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading .vc_tta-controls-icon {
    margin-top: -4px;
    color: #fff !important;
}

.stm_upcoming_events_style_2 .stm_upcoming_event__link a:after {
    color: <?php echo wp_kses_post($secondary_color); ?>;
}

.volunteer_box .vc_column-inner {
    width: auto;
}

.stm_layout_politician .volunteer_form {
    margin: 0 -15px !important;
}
.stm_layout_politician .volunteer_form [class*=col-md] {
    padding: 0 15px !important;
}
.stm_layout_politician .volunteer_form .form_field_wrap {
    position: relative;
    padding: 10px 0;
}
.stm_layout_politician .volunteer_form .form_field_wrap i {
    position: absolute;
    top: 50%;
    left: 20px;
    margin-top: -12px;
    font-size: 23px;
    color: <?php echo wp_kses_post($secondary_color); ?>;
    z-index: 10;
}
.stm_layout_politician .volunteer_form .form_field_wrap input {
    padding-top: 16px;
    padding-bottom: 16px;
    padding-left: 60px;
    background-color: #fff !important;
    font-size: 16px;
    height: 58px;
}
.stm_layout_politician .volunteer_form .btn {
    width: 100%;
    height: 58px;
    padding: 12px 24px 12px;
    text-align: center;
    font-weight: 500;
    font-size: 20px;
    color: #fff !important;
}
.stm_layout_politician .volunteer_form .btn:hover {
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    color: #fff !important;
}
.stm_layout_politician.stm_form_style_12 div.wpcf7-response-output {
    margin-top: 20px;
}

.admin-bar .stm-header__row_color.pearl_is_sticky.pearl_going_sticky {
    top: 32px;
}
.admin-bar .lg-outer.lg-visible {
    top: 32px;
}

.stm_pricing-table__footer .btn {
    white-space: nowrap;
}

.stm_layout_politician .stm_upcoming_event_style_1 .stm_upcoming_event__date-title {
    font-size: 11px;
    font-weight: 500;
}

.owl-controls .owl-dots .owl-dot.active span {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_politician .stm_iconbox_style_5 .stm_iconbox__text h5 span:before {
    font-size: 134px;
}

.stm_single_event__categories span a:hover {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_single_stm_events .stm_markup__content .stm_single_event__categories i {
    color: #ffffff !important;
}
.stm_sidebar_style_6 .stm_markup__sidebar_divider .widgettitle, .stm_schedule_style_1 .event_lesson_tabs a {
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_sidebar_style_6 .stm_markup__sidebar_divider .widgettitle, .stm_schedule_style_1 .event_lesson_tabs.active a {
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_schedule_style_1 .event_lesson_info_time_loc i {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_schedule_style_1 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_info_title {
    text-transform: none !important;
    font-weight: 500 !important;
}
.stm_schedule_style_1 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_speakers li .event_speaker_content .event_speaker_name {
    font-weight: 500 !important;
    <?php if(!empty($secondary_font['name'])): ?>
        font-family: <?php echo esc_attr($secondary_font['name']); ?>
    <?php endif; ?>
}
.stm_layout_politician .stm_single_stm_events .stm_markup__content .stm_single_event__form h3 {
    text-transform: none;
}
.stm_single_stm_events .stm_markup__content .stm_single_event__form .btn {
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_single_stm_events .stm_markup__content .stm_single_event__form .btn:hover {
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
    background-color: <?php echo wp_kses_post($main_color); ?> !important;
}

.stm_layout_politician .owl-carousel .owl-nav .owl-prev:before,
.stm_layout_politician .owl-carousel .owl-nav .owl-next:before {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_politician .stm_carousel_style_1 .stm_carousel__pagination {
    bottom: 28px;
}
.stm_layout_politician .stm_projects_carousel__tab a.active,
.stm_layout_politician .stm_carousel_style_1 .stm_carousel__pagination .current {
    color: #fff !important;
}
.stm_layout_politician .stm_projects_carousel__name {
    font-size: 20px;
}
.stm_pricing-table_style_2 .stm_pricing-table__head h5,
.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__front .inner_flip .stm_projects__meta .inner span,
.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__back .inner_flip .stm_projects__meta .inner span {
    color: #fff !important;
}

.stm_stories_style_1 .owl-controls .owl-dots {
    display: flex;
    flex-direction: row;
}
.stm_layout_politician .stm_testimonials .owl-dots .owl-dot span {
    display: none;
}
.stm_layout_politician .stm_testimonials_style_3 .owl-dots .owl-dot {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_form_style_2 input:active,
.stm_form_style_2 input:focus {
    background-color: #fff !important;
}

#menu-footer-menu {
    float: left;
    width: 100%;
    font-family: inherit;
}
#menu-footer-menu li {
    float: left;
    width: 33.333%;
    margin-bottom: 0;
}
#menu-footer-menu li a {
    line-height: 30px;
    font-size: 15px;
}
#menu-footer-menu li a:hover {
    text-decoration: underline !important;
}
.stm_sidebar_style_1 .stm-footer .stm_wp_widget_text .textwidget {
    padding-right: 50px;
}

.stm_layout_politician .woocommerce .button,
.stm_layout_politician.woocommerce .button {
    padding: 16px 20px !important;
}
.woocommerce .single_add_to_cart_button:after {
    display: none !important;
}
.stm_layout_politician.single-product span.onsale,
.stm_layout_politician .woocommerce ul.stm_products li.product .stm_single_product__image .onsale,
.stm_layout_politician.woocommerce ul.stm_products li.product .stm_single_product__image .onsale {
    top: -25px;
    min-width: 48px;
    min-height: 25px;
    line-height: 25px;
    padding: 0 10px;
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    border-radius: 0 !important;
    text-transform: uppercase;
    letter-spacing: -0.5px;
    font-weight: 600;
    font-size: 15px;
}
.stm_layout_politician.single-product span.onsale {
    top: 105px;
    left: 4px;
}
.stm_layout_politician .woocommerce ul.stm_products li.product .stm_single_product__image,
.stm_layout_politician.woocommerce ul.stm_products li.product .stm_single_product__image {
    margin-bottom: 18px;
    padding: 0 15px;
}
.stm_layout_politician .woocommerce-product-gallery__image {
    position: relative;
}
.stm_layout_politician .woocommerce ul.stm_products li.product a .stm_single_product__meta,
.stm_layout_politician.woocommerce ul.stm_products li.product a .stm_single_product__meta {
    padding: 0;
    text-align: center;
    background: transparent !important;
}
.stm_layout_politician .woocommerce ul.stm_products li.product.product:hover .stm_single_product__meta,
.stm_layout_politician.woocommerce ul.stm_products li.product.product:hover .stm_single_product__meta {
    background: transparent !important;
}
.stm_layout_politician .woocommerce ul.stm_products li.product a .woocommerce-loop-product__title,
.stm_layout_politician.woocommerce ul.stm_products li.product a .woocommerce-loop-product__title {
    margin-bottom: 6px;
    text-transform: none;
    letter-spacing: -0.5px;
    line-height: 24px !important;
    font-weight: 500;
    font-size: 19px !important;
    color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_layout_politician .woocommerce div.product .product_title,
.stm_layout_politician.woocommerce div.product .product_title {
    text-transform: none;
    font-weight: 500;
}
.stm_layout_politician .woocommerce .price {
    font-family: inherit;
}
.stm_layout_politician .woocommerce .price del {
    margin-top: 3px;
}
.stm_layout_politician .woocommerce .price del,
.stm_layout_politician .woocommerce .price del span,
.stm_layout_politician.woocommerce .price del,
.stm_layout_politician.woocommerce .price del span {
    font-family: inherit;
    font-size: 14px;
    color: #808080 !important;
}
.stm_layout_politician .woocommerce ul.stm_products li.product:hover .price del,
.stm_layout_politician.woocommerce ul.stm_products li.product:hover .price del {
    color: #808080 !important;
}
.stm_layout_politician .woocommerce .price ins,
.stm_layout_politician .woocommerce .price > span,
.stm_layout_politician.woocommerce .price ins,
.stm_layout_politician.woocommerce .price > span {
    font-family: inherit;
    font-weight: 500;
    font-size: 17px;
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_politician .woocommerce ul.stm_products li.product:hover .price ins,
.stm_layout_politician .woocommerce ul.stm_products li.product:hover .price > span,
.stm_layout_politician.woocommerce ul.stm_products li.product:hover .price ins,
.stm_layout_politician.woocommerce ul.stm_products li.product:hover .price > span {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_politician.single-product .related.products {
    float: left;
    width: 100%;
}
.stm_layout_politician.single-product .related.products h2 {
    margin-bottom: 60px;
}
.woocommerce #order_review #payment .place-order #place_order:after {
    display: none !important;
}

.stm_layout_politician.stm_sidebar_style_1 .stm_markup__sidebar .widget .widgettitle,
.stm_layout_politician.stm_sidebar_style_1 .stm_markup__sidebar .widget .widgettitle h5 {
    text-transform: none;
    font-size: 20px !important;
}
.stm_layout_politician .widget_tag_cloud .tagcloud a {
    color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_layout_politician .widget_tag_cloud .tagcloud a:hover {
    color: #fff !important;
}

.stm_layout_politician.stm_sidebar_style_1 .stm_markup__sidebar_divider .sbdc .widget {
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_politician .stm_widget_categories.style_2 .cat-item a:before {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_politician .stm_single_donation_style_1 .stm_post_info {
    display: none !important;
}

.stm_layout_politician .widget_search button {
    padding: 0 30px 0 20px !important;
}
.stm_layout_politician .widget_search button:after {
    display: none;
}

.stm_carousel .stm_carousel__single_small {
    cursor: pointer;
}

.stm_layout_politician .stm_loop__single_list_style_2:last-child {
    margin-bottom: 0;
}

.envato-preview-visible .modal .modal-content {
    top: 50px;
}

.stm_layout_politician .stm_single_stm_events .stm_markup__content .stm_single_event__categories i {
    transform: rotate(0deg);
}
.stm_layout_politician .stm_single_stm_events .stm_markup__content .stm_single_event__categories i:before {
    content: "\ec8d";
}
.stm_layout_politician .stmicon-comment2:before {
    content: "\e90b";
}

.stm_layout_politician .stm_single_stm_events .stm_markup__content .stm_single_event__title {
    text-transform: none !important;
    letter-spacing: 0;
}

.stm_single_stm_events .stm_markup__content .stm_single_event__addr h4,
.stm_single_stm_events .stm_markup__content .stm_single_event__date h4 {
    font-size: 18px;
}
.stm_single_stm_events .stm_markup__content .stm_single_event__addr p,
.stm_single_stm_events .stm_markup__content .stm_single_event__date p {
    font-size: 14px;
}
.stm_single_stm_events .stm_markup__content .stm_single_event__actions .btn.btn_outline {
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_single_stm_events .stm_markup__content .stm_single_event__actions .btn.btn_outline:hover {
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_single_stm_events .stm_markup__content .stm_single_event__actions .stm_single_event__calendar .btn {
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_single_stm_events .stm_markup__content .stm_single_event__actions .stm_single_event__calendar .btn:hover {
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
    background-color: <?php echo wp_kses_post($main_color); ?> !important;
}

@media (max-width: 1023px)  {
    .stm_layout_politician .stm_mobile__header {
        padding-left: 0;
        padding-right: 0;
        padding-bottom: 30px !important;
    }

    .stm_layout_politician .stm_breadcrumbs {
        margin-top: 40px;
    }

    .stm-header__element {
        padding: 0 !important;
    }
    body.stm_header_style_11 .stm-navigation__default > ul {
        margin: 0 !important;
    }
    html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu,
    html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu {
        box-shadow: none !important;
        padding: 20px !important;
    }
    body.stm_header_style_11 .stm-navigation__default > ul > li .stm_mobile__dropdown {
        right: 10px !important;
    }
    body.stm_layout_politician.stm_header_style_11 .stm-navigation__default > ul > li .stm_mobile__dropdown:after {
        content: "\e646" !important;
        font-family: 'stmicons' !important;
        border: 0 !important;
        margin: -10px 0 0 -7px !important;
        font-size: 8px;
        width: auto !important;
        height: auto !important;
    }

    body.stm_layout_politician .stm_mobile__switcher span {
        background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    }
    body.stm_layout_politician .stm-header__row_color_center:before {
        background-color: #ffffff !important;
    }
    body.stm_header_style_11 .stm-navigation__default > ul > li > a {
        color: <?php echo wp_kses_post($main_color); ?>;
    }
    body.stm_layout_politician.stm_header_style_11 .stm-navigation__default > ul > li > a:hover {
        color: <?php echo wp_kses_post($main_color); ?> !important;
    }
    body.stm_header_style_11 .stm-navigation__default > ul > li ul.sub-menu {
        padding: 5px 0 !important;
    }
    body.stm_layout_politician.stm_header_style_11 .stm-navigation__default .stm_megamenu > ul > li ul.sub-menu li {
        margin-bottom: 0 !important;
    }
    body.stm_layout_politician.stm_header_style_11 .stm-navigation__default .stm_megamenu > ul > li ul.sub-menu li a {
        padding: 11px 0 !important;
        padding-left: 20px !important;
    }
    
    .stm_layout_politician .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner ul li {
        padding: 7px 0;
    }
    .stm_layout_politician .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner .btn {
        padding: 14px 26px;
    }
    
    html body.stm_layout_politician .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li.current-menu-item > a {
        background-color: <?php echo wp_kses_post($main_color); ?> !important;
        color: #fff !important;
    }
}
@media (min-width: 992px) {
    .video-margin-right {
        margin-right: 17px;
    }
}
@media (max-width: 991px)  {
    .volunteer_box > .vc_column-inner {
        padding: 55px 50px 30px !important;
    }
    .stm_sidebar_style_1 .stm-footer .stm_wp_widget_text .textwidget {
        padding-right: 0;
    }
    .stm_layout_politician .woocommerce ul.stm_products li.product {
        margin-bottom: 60px;
    }
    .stm_layout_politician .woocommerce ul.stm_products li.product:last-child {
        margin-bottom: 30px;
    }

    .woocommerce .woocommerce-breadcrumb {
        margin-bottom: 0 !important;
    }

    .stm_layout_politician .stm_loop__single_list_style_2 .stm_loop__content {
        padding-top: 15px !important;
    }
    .stm_layout_politician .stm_loop__single_list_style_2 .stm_post_details {
        margin-bottom: 5px;
    }
    .stm_layout_politician .stm_loop__single_list_style_2 .post_excerpt {
        margin-bottom: 0!important;
    }

    .stm_layout_politician .stm_cta.style_1 {
        display: block;
        padding: 40px 30px;
    }
    .stm_layout_politician .stm_cta.style_1 .stm_cta__content {
        max-width: auto;
        margin-bottom: 30px;
    }
}
@media (max-width: 767px)  {
    .volunteer_box > .vc_column-inner {
        padding-right: 30px !important;
        padding-left: 30px !important;
    }
    .volunteer_box .wpb_text_column {
        padding-right: 0 !important;
    }
    .stm_cta.style_1 .stm_cta__content {
        padding-right: 0 !important;
    }
    #menu-footer-menu li {
        width: 50%;
    }
    .stm_layout_politician .woocommerce ul.stm_products li.product .stm_single_product__image {
        margin-bottom: 0;
    }
    .stm_layout_politician .stm_loop__single_list_style_2 .post_excerpt {
        margin-bottom: 30px !important;
    }

    .stm-footer {
        text-align: center;
    }
    .stm-footer .stm_wp_widget_text {
        margin-bottom: 0 !important;
    }
    .stm-footer .footer-widgets aside.widget {
        display: none;
    }
    .stm-footer .footer-widgets aside.widget:first-child {
        display: block;
        width: 100%;
    }

    .stm_layout_politician .mobile-empty-space {
        margin: 0 15px !important;
    }
}

@media (max-width: 400px)  {
    .stm_post_type_list_style_3 .stm_post_type_list__content {
        padding: 45px 40px 0 !important;
    }
}