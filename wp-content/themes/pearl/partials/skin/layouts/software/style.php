<?php
/*Colors*/
$main_color = pearl_get_option('main_color');
$secondary_color = pearl_get_option('secondary_color');
$third_color = pearl_get_option('third_color');

$fonts = pearl_get_font();
$main_font = $fonts['main'];
$secondary_font = $fonts['secondary'];
?>
.stm_mobile__header {
    background: #fff;
    padding: 15px !important;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, .4);
}

.stm_sticky_header_placeholder {
    height: 0 !important;
}
.stm-navigation {
    margin-top: -38px;
}
.stm-navigation ul > li > a {
    line-height: 24px;
}
@media (min-width: 1024px) {
    .stm-navigation ul > li {
        padding-top: 34px;
    }
    .stm-navigation ul > li + li {
        margin-left: 30px;
    }
    .stm-navigation ul > li > a {
        padding: 0 !important;
    }
    .stm-navigation__line_top > ul > li:before {
        top: 0 !important;
        width: 0% !important;
        left: 50% !important;
        height: 3px !important;
        transform: translate(-50%, 0);
    }
    .stm-navigation__line_top > ul > li:hover:before {
        visibility: visible;
        opacity: 1;
        width: 100% !important;
    }
    .stm-navigation > ul > li > .sub-menu {
        top: 100% !important;
    }
    .stm-navigation .sub-menu li {
        padding-top: 0;
        margin-left: 0;
    }
    .stm-navigation .sub-menu li a {
        white-space: nowrap;
        padding: 10px 20px !important;
    }
    .stm_megamenu > ul.sub-menu > li ul.sub-menu > li {
        margin-left: 0;
    }
}
@media (max-width: 1023px) {
    body.stm_layout_software.stm_header_style_11 .stm-navigation__default > ul > li ul li:hover a, 
    body.stm_layout_software.stm_header_style_11 .stm-navigation__default > ul > li ul li.current-menu-item a {
        color: <?php echo esc_html($main_color); ?> !important;
    }
}



@media (max-width: 767px) {
    .wpb_single_image.vc_align_left {
        text-align: center;
    }
}


.software-banner-image img {
    max-width: 150%;
}


.wpb_single_image .vc_single_image-wrapper img {
    border-radius: 0 !important;
    box-shadow: none !important;
}
.wpb_single_image.vc_box_shadow_rounded .vc_single_image-wrapper {
    box-shadow: 0px 15px 40px 0px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    padding: 0;
}


.stm_layout_software .stm_iconbox.stm_iconbox_style_6 {
    background-color: #fff !important;
    border-radius: 20px;
    box-shadow: 0px 15px 30px 0px rgba(0, 0, 0, 0.1);
    padding: 50px 30px 40px;
    transition: box-shadow .3s;
}

.stm_layout_software .stm_iconbox.stm_iconbox_style_6:hover {
    box-shadow: 0px 15px 50px 0px rgba(0, 0, 0, 0.3);
}

.stm_layout_software .stm_iconbox.stm_iconbox_style_6:before {
    content: none;
}

.stm_layout_software .stm_iconbox.stm_iconbox_style_6 .stm_iconbox__icon {
    min-width: 80px;
    min-height: 80px;
    background-color: <?php echo esc_html($third_color); ?>;
    margin-bottom: 0 !important;
}

.stm_layout_software .stm_iconbox.stm_iconbox_style_6 .stm_iconbox__icon i {
    line-height: 80px;
}

.stm_layout_software .stm_iconbox.stm_iconbox_style_6 .stm_iconbox__text {
    padding-top: 40px;
}
.stm_layout_software .stm_iconbox.stm_iconbox_style_6 .stm_iconbox__desc {
    color: <?php echo esc_html($main_color); ?>
}
.stm_layout_software .stm_iconbox.stm_iconbox_style_6 .stm_iconbox__desc:after {
    content: "\eb9c";
    font-family: "stmicons";
    display: inline-block;
    font-size: 24px;
    box-sizing: border-box;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid <?php echo esc_html($secondary_color); ?>;
    color: <?php echo esc_html($secondary_color); ?>;
    margin-top: 25px;
    line-height: 46px;
    font-weight: bold;
}


.stm_layout_software .stm_iconbox_style_12.stm_iconbox {
    max-width: 400px;
    margin: 0 auto;
}
.stm_layout_software .stm_iconbox.stm_iconbox_style_12 .stm_iconbox__icon {
    height: 70px;
    align-items: start;
    background-color: transparent !important;
}


.stm_layout_software .stm_video_style_5 .stm_playb {
    width: 80px !important;
    height: 80px !important;
    margin: 9px 0 0 -38px !important;
}
.stm_layout_software .stm_video_style_5 .stm_playb:before {
    margin: -16px 0 0 -10px !important;
    border-width: 16px 0 16px 28px !important;
}
.stm_layout_software .stm_video_style_5 .stm_playb:after {
    background-color: <?php echo esc_html($secondary_color); ?> !important;
    border: none !important;
}

.cloud-services-icons .wpb_wrapper {
    display: flex;
    flex-wrap: wrap;
}
.cloud-services-icons .wpb_content_element {
    margin: 0 30px 30px 0;
}



.stm_layout_software .vc_toggle {
    padding: 0;
    background-color: #ffffff;
    border-radius: 20px;
    box-shadow: 0 10px 30px 0 rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.stm_layout_software .vc_toggle .vc_toggle_title {
    padding: 18px 68px 18px 48px;
}
.stm_layout_software .vc_toggle .vc_toggle_title .vc_toggle_icon {
    left: auto;
    right: 50px;
    transition: opacity .2s;
    background-color: #2e5deb;
}
.stm_layout_software .vc_toggle .vc_toggle_content {
    padding: 0 50px;
    margin-top: 8px;
}

.stm_layout_software .vc_tta-panel {
    background-color: #ffffff;
    padding: 0;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px 0 rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}
.stm_layout_software .vc_tta-panel-heading .vc_tta-panel-title {
    background-color: #fff !important;
}
.stm_layout_software .vc_tta-panel-heading .vc_tta-panel-title a {
    padding: 18px 68px 18px 48px !important;
    background-color: inherit !important;
    border: none !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    text-transform: none !important;
}
.stm_layout_software .vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-title-text {
    color: <?php echo esc_html($main_color) ?> !important;
    opacity: 1 !important;
}
.stm_layout_software .vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-title-text {
    color: <?php echo esc_html($main_color) ?> !important;
}
.vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading .vc_tta-controls-icon {
    right: 40px;
    transition: opacity .2s;
    background-color: <?php echo esc_html($third_color) ?>;
    font-size: 16px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    text-align: center;
    line-height: 22px;
    color: #fff;
    padding: 3px;
    opacity: 1;
}
.vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading .vc_tta-controls-icon:before,
.vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading .vc_tta-controls-icon:after {
    border-color: #fff;
    width: 12px;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}
.vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading .vc_tta-controls-icon:after {
    width: 0;
    height: 12px;
    content: "" !important;
}
.stm_layout_software .vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-controls-icon:before {
    transform: translate(-50%, -50%) !important;
}

.stm_layout_software .vc_tta-panel-body  .wpb_content_element {
    padding: 0 50px;
}


.what-are-you-waiting-for__image img {
    margin-left: 46px;
}

.subscribe-form form .mc4wp-form-fields {
    display: flex;
    margin-left: 2px;
}
.subscribe-form form ::-webkit-input-placeholder { /* Edge */
    color: #fff;
    text-transform: initial;
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($main_font['name']); ?>
    <?php endif; ?>
    letter-spacing: -0.2px;
}

.subscribe-form form :-ms-input-placeholder { /* Internet Explorer 10-11 */
    color: #fff;
    text-transform: initial;
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($main_font['name']); ?>
    <?php endif; ?>
    letter-spacing: -0.2px;
}

.subscribe-form form ::placeholder {
    color: #fff;
    text-transform: initial;
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($main_font['name']); ?>
    <?php endif; ?>
    letter-spacing: -0.2px;
}

.subscribe-form form .stm_mailchimp_wrapper {
    width: 300px;
    margin-right: 20px;
    height: 50px;
    background: none;
}
.subscribe-form form .stm_mailchimp_wrapper i {
    display: none;
}
.subscribe-form form .stm_mailchimp_wrapper input[type=email] {
    padding-left: 30px;
    height: 48px;
    color: #fff;
    text-transform: initial;
    <?php if(!empty($main_font['name'])): ?>
    font-family: <?php echo esc_attr($main_font['name']); ?>
    <?php endif; ?>
    letter-spacing: -0.2px;
}
.subscribe-form form .btn {
    border: 2px solid <?php echo esc_html($secondary_color); ?> !important;
    background-color: <?php echo esc_html($secondary_color); ?> !important;
    color: #fff !important;
    font-weight: bold;
    font-size: 14px;
    padding: 14px 42px;
}
.subscribe-form form .btn:hover {
    background-color: <?php echo esc_html($third_color); ?> !important;
    color: <?php echo esc_html($secondary_color); ?> !important;
}

.stm_sidebar_style_1 .stm-footer {
    padding-top: 52px !important;
}
.stm_sidebar_style_1 .stm-footer h4 {
    font-size: 18px;
}

#custom_html-2 {
    width: 33.5%;
}
#stm_custom_menu-2 {
    width: 16.5%;
}

.stm-footer .widget ul li:before {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background-color: <?php echo esc_html($third_color); ?>;
    top: 6px !important;
    content: "";
}

.stm-footer .footer-widgets {
    padding-bottom: 0;
}
.footer_logo {
    margin-top: -20px;
}
.footer_logo img {
    display: block;
}
.stm_footer_layout_3 .stm-footer__bottom {
    padding: 0 0 30px !important;
}
.stm_footer_layout_3 .stm-footer__bottom .stm_markup {
    justify-content: center !important;
}

.stm-socials .stm-socials__icon {
    color: #fff;
    background-color: <?php echo esc_html($third_color); ?>;
    border-radius: 50%;
    display: inline-block;
    width: 40px;
    height: 40px;
    font-size: 18px;
    line-height: 40px;
    margin: 0 10px 0 0;
}
.stm-socials .stm-socials__icon:hover {
    color: #fff !important;
}

.stm_testimonials_style_20 .owl-controls .owl-nav .owl-prev,
.stm_testimonials_style_20 .owl-controls .owl-nav .owl-next {
    background: <?php echo esc_html($third_color); ?>;
    box-shadow: 0 0 0 5px <?php echo esc_html($third_color); ?>;
}
.stm_testimonials_style_20 .owl-controls .owl-nav .owl-prev:hover:before,
.stm_testimonials_style_20 .owl-controls .owl-nav .owl-next:hover:before {
    color: <?php echo esc_html($third_color); ?> ;
}
.stm_testimonials_style_20 .stm_testimonials__avatar {
    box-shadow: 0 0 0 5px <?php echo esc_html($third_color); ?>;
}

.stm_posts_list_style_21 .stm_posts_list_single__info .categories a {
    <?php if(!empty($secondary_font['name'])): ?>
    font-family: <?php echo esc_attr($secondary_font['name']); ?>
    <?php endif; ?>
}


.stm_pricing-table_style_6 .stm_pricing-table__head h5 {
    color: <?php echo esc_html($third_color) ?>;
}
.stm_pricing-table_style_6 .stm_pricing-table__pricing {
    <?php if(!empty($secondary_font['name'])): ?>
    font-family: <?php echo esc_attr($secondary_font['name']); ?>
    <?php endif; ?>
}
.stm_pricing-table_style_6 .stm_pricing-table__content li:before {
    color: <?php echo esc_html($third_color) ?> !important;
}
.stm_pricing-table_style_6 .stm_pricing-table__footer .btn {
    border: 2px solid <?php echo esc_html($secondary_color) ?> !important;
    color: <?php echo esc_html($secondary_color) ?> !important;
}
.stm_pricing-table_style_6 .stm_pricing-table__footer .btn:hover {
    background-color: <?php echo esc_html($secondary_color) ?> !important;
}
.stm_pricing-table_style_6 .stm_pricing-table__label {
    background-color: <?php echo esc_html($third_color) ?>;
}

.stm_layout_software .stm_custom_menu_style_1 .menu li a:hover {
    color: <?php echo esc_html($third_color) ?>
}
.stm_layout_software .stm_projects_carousel__tab a {
    opacity: 1 !important;
}
.stm_layout_software .stm_projects_carousel__tab a.active {
    color: #fff !important;
}

.stm_layout_software .btn.btn_outline.btn_primary.btn_load:hover span {
    color: #fff !important;
}

.stm_layout_software .stm_pricing-table_style_1 .stm_pricing-table__label {
    font-weight: bold;
}

.ordered-list__text {
    color: <?php echo esc_html($main_color) ?>;
}

.stm_layout_software .stm_widget_search.style_1 .widget.widget_search .search-form input[name="s"] {
    border-radius: 50px;
}
.stm_layout_software .stm_widget_search.style_1 .widget.widget_search .search-form button {
    width: 54px;
}

.stm_single_donation_style_1 .stm_donation_popup .stm_input_wrapper_radio.active {
    color: #fff;
}


<!-- MEDIA -->

@media (max-width: 1199px) {
    .stm-navigation ul > li + li {
        margin-left: 20px;
    }
    .cloud-services-icons .wpb_content_element {
        width: 120px;
    }
}
@media (max-width: 1023px) {
    .stm-navigation ul > li + li {
        margin-left: 0;
    }
}
@media (max-width: 991px) {
    .cloud-services-icons .wpb_content_element {
        width: 100px;
    }
    .stm_sidebar_style_1 .stm-footer {
        padding: 0 !important;
    }
    .stm_sidebar_style_1 .stm-footer .footer-widgets {
        justify-content: center;
    }
    #stm_custom_menu-2, #contacts-2, #stm_text-2 { display: none; }
    .footer_logo {
        margin-top: 0;
    }
    .footer_logo ~ * {
        display: none;
    }
}
@media (max-width: 767px) {
    .faq-image {
        display: none;
    }
}
@media (max-width: 575px) {
    .cloud-services-icons .wpb_wrapper {
        justify-content: space-between;
    }
    .cloud-services-icons .wpb_content_element {
        width: 25vw;
        margin: 2vw;
    }
}
@media (max-width: 550px) {
    h1 {
        text-align: center !important;
        font-size: 35px !important;
    }
    h1 ~ div {
        width: 100%;
        text-align: center;
    }
    .stm_layout_software .stm_partners_style_3 .stm_partners__single {
        flex: 0 1 50%;
    }
    .stm_layout_software .stm_iconbox.stm_iconbox_style_6 .stm_iconbox__text {
        padding-top: 0;
    }
    .stm_video.stm_video_style_5 {
        height: 50vw !important;
    }
    .stm_video.stm_video_style_5 .stm_playb {
        margin: -40px 0 0 -40px !important;
    }
}