<?php
/*Colors*/
$main_color = pearl_get_option('main_color');
$secondary_color = pearl_get_option('secondary_color');
$third_color = pearl_get_option('third_color');
?>

.slide_button {
    position: relative !important;
    transition: all 0.4s !important;
}
.slide_button:hover {
    margin-top: -4px !important;
}

.stm_projects_cards_style_1 .stm_projects_cards__hint span:before {
    animation: shake 10s infinite !important;
}

body.stm_header_style_11 .stm-navigation__default {
    margin-top: 6px;
}
body.stm_header_style_11 .stm-navigation__default > ul > li > a {
    text-transform: uppercase;
    letter-spacing: 3.5px;
    font-weight: 400;
}

.stm_layout_app .stm_infobox_style_11 {
    display: block !important;
}
.stm_layout_app .stm_infobox_style_11 .stm_infobox__image {
    display: flex;
    justify-content: center;
    align-item: center;
    margin-bottom: 17px;
    min-height: 55px;
}
.stm_layout_app .stm_infobox_style_11 .stm_infobox__content {
    max-width: 90px;
    margin: 0 auto;
    font-weight: 400;
}

.stm_layout_app .stm_cta.style_1 {
    padding: 71px 62px 70px 62px;
    margin-bottom: 0;
    background-image: linear-gradient(to right, <?php echo wp_kses_post($secondary_color); ?>, <?php echo wp_kses_post($secondary_color); ?>, <?php echo wp_kses_post($third_color); ?>);
    border-radius: 8px;
}
.stm_layout_app .stm_cta.style_1 .stm_cta__link .btn_lg {
    padding: 20px 46px !important;
    border-radius: 40px;
}

.stm_testimonials_style_18 .stm_testimonials__info h6 {
    color: <?php echo wp_kses_post($third_color); ?> !important;
}

.stm_layout_app.wpb-js-composer .vc_tta-tabs.vc_tta-tabs-position-top .vc_tta-tabs-list {
    display: flex;
    justify-content: center;
    align-items: center;
}
.stm_layout_app.wpb-js-composer .vc_tta-tabs.vc_tta-tabs-position-top .vc_tta-tabs-list li:before {
    display: none;
}
.stm_layout_app.wpb-js-composer .vc_tta-tabs.vc_tta-tabs-position-top .vc_tta-tabs-list li.vc_active {
    border-radius: 35px;
    background-image: linear-gradient(to right, <?php echo wp_kses_post($secondary_color); ?>, <?php echo wp_kses_post($third_color); ?>);
}
.stm_layout_app.stm_tabs_style_4 .vc_tta.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab a {
    text-align: center;
    padding: 12px 30px !important;
}
.stm_layout_app.wpb-js-composer .vc_tta.vc_general .vc_tta-panel-title > a {
    margin-bottom: 2px;
    padding: 20px;
    background-image: linear-gradient(to right, <?php echo wp_kses_post($secondary_color); ?>, <?php echo wp_kses_post($third_color); ?>);
    font-weight: 400;
    font-size: 20px;
    color: #ffffff !important;
}
.stm_layout_app.wpb-js-composer .vc_tta.vc_general .vc_active .vc_tta-panel-title > a {
    background-color: <?php echo wp_kses_post($main_color); ?> !important;
    background-image: none;
}

.stm_layout_app .stm_floating_gallery_style_1 {
    padding-bottom: 0;
    height: 1110px;
}
.stm_layout_app .stm_floating_gallery_style_1 .stm_floating_gallery__cell {
    margin-right: 12px;
}

.subscribe-box {
    background: <?php echo wp_kses_post($secondary_color); ?>;
    background: -moz-linear-gradient(-45deg, <?php echo wp_kses_post($secondary_color); ?> 0%, <?php echo wp_kses_post($third_color); ?> 100%);
    background: -webkit-linear-gradient(-45deg, <?php echo wp_kses_post($secondary_color); ?> 0%,<?php echo wp_kses_post($third_color); ?> 100%);
    background: linear-gradient(135deg, <?php echo wp_kses_post($secondary_color); ?> 0%,<?php echo wp_kses_post($third_color); ?> 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=1 );
    padding: 114px 95px 96px;
    border-radius: 8px;
}
.stm_form_style_16 .subscribe-box .mc4wp-form-fields {
    display: flex;
}
.stm_form_style_16 .subscribe-box .stm_mailchimp_wrapper {
    display: flex;
    width: 67%;
    align-items: center;
    border-radius: 4px;
}
.stm_form_style_16 .subscribe-box .stm_mailchimp_wrapper input {
    text-transform: none;
    letter-spacing: 0;
    padding-left: 0 !important;
    padding-right: 0 !important;
    border-radius: 8px;
    font-weight: 400;
    font-size: 16px;
}
.stm_form_style_16 .subscribe-box .stm_mailchimp_wrapper i {
    width: 60px;
    text-align: center;
    color: <?php echo wp_kses_post($third_color); ?>;
}
.stm_form_style_16 .subscribe-box .btn {
    margin-right: 50px;
    margin-left: auto;
    padding: 15px 60px;
    box-shadow: 0 5px 20px rgba(<?php echo wp_kses_post(pearl_hex2rgb($main_color, 0.5)); ?>);
    background-color: <?php echo wp_kses_post($main_color); ?> !important;
    color: #ffffff !important;
}
.stm_form_style_16 .subscribe-box .btn:hover {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_app .stm_pricing-table_style_3 {
    padding: 60px 20px;
    border: 0;
    box-shadow: 0 5px 20px rgba(205,205,205, 0.6) !important;
}
.stm_layout_app .stm_pricing-table_style_3:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s;
    border: 3px solid <?php echo wp_kses_post($secondary_color); ?>;
}
.stm_layout_app .stm_pricing-table_style_3 .stm_pricing-table__head h5 {
    letter-spacing: 1.5px;
    margin-bottom: 10px;
    text-transform: uppercase;
    font-weight: 500;
    font-size: 16px;
    color: <?php echo wp_kses_post($third_color); ?> !important;
}
.stm_layout_app .stm_pricing-table_style_3 .stm_pricing-table__price {
    font-weight: 700;
    margin-bottom: 55px;
    line-height: 42px;
    font-size: 64px;
}
.stm_layout_app .stm_pricing-table_style_3 .stm_pricing-table__prefix {
    vertical-align: top;
    line-height: 24px;
    font-size: 30px;
}
.stm_layout_app .stm_pricing-table_style_3 .stm_pricing-table__separator {
    display: inline-block;
    margin-left: -5px;
    margin-bottom: 0;
}
.stm_layout_app .stm_pricing-table_style_3 .stm_pricing-table__content {
    margin-bottom: 43px;
}
.stm_layout_app .stm_pricing-table_style_3 .stm_pricing-table__content p {
    margin-bottom: 18px;
    letter-spacing: -0.5px;
}
.stm_layout_app .stm_pricing-table_style_3 .stm_pricing-table__footer .btn {
    padding: 19px 70px;
    border-radius: 50px;
}
.stm_pricing-table_style_3 .stm_pricing-table__label {
    opacity: 0;
    visibility: hidden;
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    font-size: 0 !important;
    width: 180px !important;
    height: 180px;
    border-radius: 50%;
    bottom: auto;
    right: -90px !important;
    top: -90px;
    transition: all 0.3s;
    transform: rotate(0deg) !important;
}
.stm_pricing-table_style_3 .stm_pricing-table__label:after {
    content: "\d9706";
    font-family: 'stmicons' !important;
    position: absolute;
    left: 38px;
    bottom: 40px;
    font-weight: 400;
    font-size: 30px;
}
.stm_layout_app .stm_pricing-table_style_3:hover .stm_pricing-table__label,
.stm_layout_app .stm_pricing-table_style_3:hover:before {
    opacity: 1;
    visibility: visible;
}

.wave_box.wpb_single_image img {
    max-width: none !important;
}

.contacts-box {
    background-color: #fff;
    padding: 96px 95px 60px;
    border-radius: 8px;
}
.stm_contact_form .contact-form-field {
    display: flex;
    margin: 22px 0;
    align-items: center;
    border: 2px solid #eeeeee;
    border-radius: 4px;
}
.stm_contact_form .contact-form-field i {
    width: 60px;
    text-align: center;
    font-size: 24px;
    color: <?php echo wp_kses_post($third_color); ?>;
}
.stm_contact_form .contact-form-field i.stmicon-app_email {
    font-size: 15px;
}
.stm_contact_form .contact-form-field i.stmicon-app_bubble {
    margin-top: 15px;
    margin-bottom: auto;
}
.stm_contact_form .wpcf7-form-control-wrap {
    margin-bottom: 0 !important;
}
.stm_contact_form .contact-form-field textarea,
.stm_contact_form .contact-form-field input {
    border: 0 !important;
    border-radius: 0 !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    text-transform: none !important;
    letter-spacing: 0 !important;
    font-size: 15px !important;
    font-weight: 400 !important;
}
.stm_contact_form .contact-form-field textarea {
    min-height: 134px !important;
}
.stm_contact_form .btn {
    margin-top: 4px;
}

.stm-footer .footer-widgets {
    padding-bottom: 24px;
}

.stm-footer .menu {
    display: flex;
    flex-wrap: wrap;
    padding-top: 3px;
    padding-left: 100px;
}
.stm-footer .menu li {
    margin-bottom: 16px;
    width: 50%;
}
.stm-footer .menu li a:hover {
    text-decoration: underline !important;
}

.admin-bar .stm-header__row_color.pearl_is_sticky.pearl_going_sticky {
    top: 32px;
}
.admin-bar .lg-outer.lg-visible {
    top: 32px;
}

.app_stretch_to_left > div {
    left: 130px;
    position: relative;
}

.stm_layout_app .stm_breadcrumbs {
    text-transform: none;
}
.stm_layout_app .stm_breadcrumbs span {
    text-transform: none;
}
.stm_layout_app .stm_breadcrumbs .container {
    padding: 0;
}

.stm_layout_app .owl-carousel .owl-nav .owl-prev:before,
.stm_layout_app .owl-carousel .owl-nav .owl-next:before {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_app .stm_carousel_style_1 .stm_carousel__pagination {
    bottom: 28px;
}
.stm_layout_app .stm_carousel_style_1 .stm_carousel__pagination .current {
    color: #fff !important;
}
.owl-controls .owl-dots .owl-dot.active span {
    background-color: <?php echo wp_kses_post($main_color); ?>;
}

.stm_cta.style_2 .stm_cta__link .btn .btn__icon {
    right: -10px !important;
}

.stm_widget_search.style_1 .widget.widget_search .search-form button {
    background: transparent !important;
    color: <?php echo wp_kses_post($main_color); ?> !important;
}

.stm_projects_carousel__item:hover .stm_projects_carousel__btn {
    padding: 15px 30px !important;
}
.stm_layout_app .stm_projects_carousel__tab a.active {
    color: #fff !important;
}

.stm_layout_app .stm_projects_grid__posts .btn.loading span,
.stm_layout_app .stm_projects_grid__posts .btn:hover span,
.stm_layout_app .stm_projects_grid__posts .btn:active span,
.stm_layout_app .stm_projects_grid__posts .btn.btn_load:hover:before {
    color: #fff !important;
}

.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__front .inner_flip .stm_projects__meta .inner span,
.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__back .inner_flip .stm_projects__meta .inner span {
    color: #fff !important;
}

.stm_staff_grid_style_3 .stm_staff__links .btn {
    padding: 15px 30px !important;
}

.stm_stories_style_1 .owl-controls .owl-dots {
    display: flex;
    flex-direction: row;
}
.stm_layout_app .stm_testimonials .owl-dots .owl-dot span {
    display: none;
}
.stm_layout_app .stm_testimonials_style_3 .owl-dots .owl-dot {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}


.stm-navigation__default>ul>li:before {
    content: '';
    display: block;
    position: absolute;
    left: 21px;
    right: 21px;
    bottom: -15px;
    height: 2px;
    opacity: 0;
    transition: all 0.3s;
    visibility: hidden;
    background-color: #fff !important;
}
.stm-navigation__default>ul>li:hover:before {
    opacity: 1;
    visibility: visible;
    bottom: -10px;
}

.stm_layout_app .stm_testimonials_style_18 .stm_testimonials__review:before {
    display: none;
}
.stm_layout_app .stm_testimonials_style_18 .stm_testimonial__carousel:before {
    content: "\e98e" !important;
    position: absolute;
    top: 50%;
    left: 50%;
    width: 242px;
    height: 242px;
    margin: -250px 0 0 -120px;
    font-family: 'stmicons' !important;
    font-size: 200px;
    transform: rotate(180deg) !important;
    color: #fff !important;
}
.stm_layout_app .stm_testimonials_style_18 .stm_testimonials__meta {
    position: relative;
}

.overlap {
    z-index: 20;
}
.archive.stm_header_transparent .stm-header{
    position: relative;
}
body.stm_layout_app.stm_header_style_11 .stm-navigation > ul > li > a {
    color: #fff !important;
}

@media (max-width: 1023px)  {
    .archive.stm_header_transparent .stm-header{
        position: fixed;
    }
    body.stm_header_style_11.stm_header_transparent .stm_mobile__header {
        background-color: <?php echo wp_kses_post($main_color); ?>;
    }
    .stm_mobile__switcher span {
        background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    }
    .stm-header {
        background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    }

    body.stm_layout_app.stm_header_style_11 .stm-navigation ul li a,
    body.stm_layout_app.stm_header_style_11 .stm-navigation__default .stm_megamenu > ul > li a {
        color: #fff !important;
    }
    body.stm_header_style_11 .stm-navigation__default > ul > li .stm_mobile__dropdown:after {
        border-color: #fff transparent transparent transparent !important;
    }
    body.stm_layout_app.stm_header_style_11 .stm-navigation__default .stm_megamenu > ul > li ul.sub-menu li a {
        padding: 0 !important;
        padding-left: 20px !important;
        color: #fff;
    }
    .stm-navigation__default>ul>li:before {
        display: none !important;
    }

    .wpb-js-composer .vc_tta.vc_general .vc_tta-panel-body {
        transition: all 0s !important;
    }

    .stm_layout_app .info_box_list .stm_infobox_style_11 {
        margin: 0 !important;
    }

    .stm_layout_app .mobile-empty-space {
        margin: 0 !important;
    }
    .stm_layout_app .mobile-empty-space > div {
        padding: 0 15px !important;
    }
    .mobile-empty-row-child-space > div {
        padding: 0 15px !important;
    }

    .stm-footer .footer-widgets {
        display: block;
        padding-bottom: 34px;
    }
    .stm-footer .footer-widgets aside.widget {
        width: 100%;
        text-align: center;
    }
    .stm-footer .menu {
        display: none;
        padding-left: 0;
    }
}

@media (max-width: 991px)  {
    .stm-footer .menu {
        padding-left: 50px;
    }

    .stm_layout_app .stm_pricing-table_style_3 .stm_pricing-table__footer .btn {
        padding: 15px 50px;
    }

    .subscribe-box {
        padding: 55px 50px 30px;
    }
    .stm_form_style_16 .subscribe-box .stm_mailchimp_wrapper {
        width: 60%;
    }
    .stm_form_style_16 .subscribe-box .btn {
        margin-right: 0;
    }

    .contacts-box {
        padding: 55px 50px 0;
    }
}

@media (max-width: 767px)  {
    .wpb-js-composer .vc_tta.vc_general .vc_tta-panel.vc_active .vc_tta-panel-body {
        padding: 20px 0 !important;
    }

    .subscribe-box {
        padding: 55px 15px 30px;
    }
    .stm_form_style_16 .subscribe-box .mc4wp-form-fields {
        display: block;
        text-align: center;
    }
    .stm_form_style_16 .subscribe-box .stm_mailchimp_wrapper {
        width: 100%;
        margin-bottom: 30px;
    }

    .stm_layout_app .stm_cta.style_1 {
        display: block;
        padding: 40px 15px 45px 15px;
        text-align: center;
    }
    .stm_layout_app .stm_cta.style_1 .stm_cta__content {
        padding: 0 0 20px;
    }

    .contacts-box {
        padding: 55px 15px 30px;
        border-radius: 8px;
    }

    .stm_sidebar_style_1 .stm-footer {
        padding: 40px 0 !important;
    }
    .stm-footer .footer-widgets {
        padding: 0 40px;
    }
}