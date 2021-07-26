<?php
/*Colors*/
$main_color = pearl_get_option('main_color');
$secondary_color = pearl_get_option('secondary_color');
$third_color = pearl_get_option('third_color');
?>
body.home #wrapper{
padding-bottom: 0;
}
.stm_layout_finance.stm_header_style_1 .stm-navigation__default > ul > li > a {
    padding: 0 29px;
    color: <?php echo wp_kses_post($third_color); ?>;
}
.stm_layout_finance.stm_header_style_1.stm_title_box_enabled .stm-navigation__default > ul > li > a {
    color: #fff;
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu,
html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu {
    margin-top: -15px !important;
}
.stm_layout_finance .stm-header .stm-socials__icon {
    margin: 0 12px;
}
.stm_layout_finance .stm-dropdown_style_1 .dropdown-toggle {
    padding: 16px 20px;
    background: rgba(255,255,255, 0.15)
}
.stm_layout_finance .stm-dropdown_style_1 .dropdown-list {
    margin-top: 0;
    width: 100%;
}
.stm_layout_finance .stm-dropdown_style_1 .dropdown-list li a {
    padding: 16px 20px !important;
    border-bottom: 1px solid rgba(255,255,255, 0.4);
}
.stm_layout_finance .stm-dropdown_style_1 .dropdown-list li:last-child a {
    border: 0;
}
.stm_layout_finance.stm_header_style_1 .stm_mobile__header {
    background-color: #ffffff !important;
}
.stm_layout_finance .stm-header .stm-socials a {
    color: <?php echo wp_kses_post($third_color); ?>;
}
.stm_layout_finance.stm_header_style_1.stm_title_box_enabled .stm-header .stm-socials a {
    color: #fff;
}

.stm_layout_finance .stm_page_bc .stm_breadcrumbs .container {
    padding: 0;
}

.stm_layout_finance .btn.btn_icon-bg {
    overflow: hidden;
}
.stm_layout_finance .btn:hover i:before {
    color: #ffffff !important;
}

.stm_layout_finance .stm-counter_style_1 .stm-counter__value,
.stm_layout_finance .stm-counter_style_1 .stm-counter__affix,
.stm_layout_finance .stm-counter_style_1 .stm-counter__prefix {
    line-height: 24px;
    font-weight: 400;
    font-size: 48px;
}
.stm_layout_finance .stm-counter_style_1 .stm-counter__label {
    margin-top: 10px;
    text-transform: none;
    font-weight: 400;
    font-size: 14px;
    color: #ffffff !important;
}
.stm_layout_finance .stm_cta.style_1 {
    margin-bottom: 0;
    padding-top: 42px;
    padding-right: 0;
    padding-bottom: 42px;
    padding-left: 0;
}

.stm_layout_finance .stm_infobox_style_1 .stm_infobox__content p {
    font-size: 14px;
    line-height: 24px;
}

.stm_layout_finance .stm_icontext_style_1 .stm_icontext__icon {
    float: right;
    margin: 4px 0 0 4px;
}
.stm_layout_finance .stm_icontext_style_1 .stm_icontext__text {
    display: inline-block;
    padding: 0 4px;
    transition: all 0.3s;
    border-bottom: 1px solid <?php echo wp_kses_post($third_color); ?>;
    white-space: nowrap;
}
.stm_layout_finance .stm_icontext_style_1 .stm_icontext__text:hover {
    border-color: transparent;
}
.stm_layout_finance .stm_icontext_style_1 a:hover .stm_icontext__text {
    text-decoration: none;
}

.stm_layout_finance .stm_testimonials_style_2 .stm_testimonials__avatar {
    margin: 0;
}
.stm_layout_finance .stm_testimonials_style_2 .stm_testimonials__avatar:before {
    right: -72px;
    width: 40px;
    height: 40px;
    line-height: 40px;
    background: #fff;
    border-radius: 50%;
    font-size: 16px;
}
.stm_layout_finance .stm_testimonials_style_2 .stm_testimonials__item {
    align-items: inherit;
}
.stm_layout_finance .stm_testimonials.stm_testimonials_style_2 .stm_testimonials__info {
    position: absolute;
    bottom: 0;
    width: 100%;
    padding: 8px 0;
    background-color: #ffffff;
}
.stm_layout_finance .stm_testimonials_style_2 .stm_testimonials__meta {
    position: relative;
}
.stm_layout_finance .stm_testimonials.stm_testimonials_style_2 .stm_testimonials__info span {
    display: none;
}
.stm_layout_finance .stm_testimonials.stm_testimonials_style_2 .stm_testimonials__review {
    display: flex;
    align-items: center;
    padding: 30px 50px;
    background-color: #ffffff;
    font-weight: 500;
    font-size: 24px;
    color: #222222;
}
.stm_layout_finance .stm_testimonials_style_2 .owl-nav .owl-next,
.stm_layout_finance .stm_testimonials_style_2 .owl-nav .owl-prev {
    top: 0;
    right: 15px;
    width: 40px;
    height: 40px;
    margin-top: -102px;
    border-width: 2px;
    border-color: <?php echo wp_kses_post($main_color); ?>;
}
.stm_layout_finance .stm_testimonials_style_2 .owl-nav .owl-next:before,
.stm_layout_finance .stm_testimonials_style_2 .owl-nav .owl-prev:before {
    line-height: 38px;
    font-size: 14px;
    color: #ffffff;
}
.stm_layout_finance .stm_testimonials_style_2 .owl-nav .owl-prev {
    left: auto;
    right: 53px;
}

.stm_layout_finance .stm_widget_posts.style_1 ul li a {
    display: flex;
    flex-direction: row;
    align-items: center;
}
.stm_layout_finance .stm_widget_posts.style_1 ul li .stm_widget_posts__title {
    padding: 5px 0;
    line-height: 24px;
    font-weight: 700;
    font-size: 20px;
}
.stm_layout_finance .stm_widget_posts.style_1 ul li .post-date {
    position: relative;
    padding: 9px 0;
    top: auto; right: auto; bottom: auto; left: auto;
    font-size: 14px;
}
.stm_layout_finance .stm_widget_posts.style_1 ul li .post-date:before {
    font-size: 18px;
}

.stm_layout_finance.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading .vc_tta-panel-title {
    font-family: inherit;
}
.stm_layout_finance.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading .vc_tta-panel-title > a .vc_tta-title-text {
    font-family: inherit;
    font-weight: 400;
    font-size: 20px;
}

.stm_layout_finance .wpcf7-form-control-wrap {
    margin-bottom: 20px;
}

.stm_layout_finance.stm_sidebar_style_1 .stm-footer {
    padding-top: 24px;
    padding-bottom: 17px;
}
.stm_layout_finance.stm_sidebar_style_1 .stm-footer .stm_bottom_copyright {
    font-family: inherit;
}
.stm_layout_finance.stm_sidebar_style_1 .stm-footer .stm_bottom_copyright a:last-child {
    color: <?php echo wp_kses_post($main_color); ?>;
}

.stm_layout_finance .stm_iconbox_style_2 {
    padding-top: 5px;
}

.mc4wp-form-fields .stm_mailchimp_wrapper {
    display: flex;
    border: 1px solid #777777;
    padding: 5px 5px;
}
.mc4wp-form-fields .stm_mailchimp_wrapper input[type="email"] {
    background-color: transparent;
    border: 0;
    text-align: left;
    font-size: 14px;
}
.mc4wp-form-fields .stm_mailchimp_wrapper button[type=submit]:not(.btn) {
    background-color: transparent;
    padding: 0;
    margin-right: 14px;
    font-size: 15px;
}

.stm_contact_form input[type="text"],
.stm_contact_form input[type="email"],
.stm_contact_form input[type="password"],
.stm_contact_form input[type="number"],
.stm_contact_form input[type="date"],
.stm_contact_form input[type="tel"] {
    font-size: 14px !important;
}

.stm_contact_form {
    padding: 23px 40px;
    border-top: 8px solid <?php echo wp_kses_post($third_color); ?>;
    background-color: rgba(255,255,255, 0.8)
}
.stm_contact_form textarea {
    height: 80px !important;
    min-height: 80px;
    font-size: 14px !important;
    resize: none;
}
.stm_contact_form .stm_select {
    min-width: 194px !important;
}
.stm_contact_form .stm_select .stm-select__val,
.stm_contact_form .stm_select select:focus + .stm-select__val + .stm_select__dropdown {
    color: #747474;
    line-height: 22px !important;
    font-size: 14px !important;
}
.stm_contact_form button {
    margin-left: 0 !important;
    text-transform: none;
    font-size: 14px;
}
.stm_contact_form .col-md-6,
.stm_contact_form .col-md-12 {
    margin: 10px 0 !important;
}

.rev_slider .wpcf7-response-output {
    white-space: normal !important;
}
.rev_slider .wpcf7-response-output:before {
    top: -7px !important;
}

.stm_layout_finance .wpcf7-response-output {
    float: left;
    width: 100%;
}

.mc4wp-response {
    position: absolute;
    top: 100%;
    left: 15px;
    right: 15px;
}
.mc4wp-alert {
    margin: 0;
}

.stm_layout_finance .stm_cta.style_1 .btn:hover {
    background-color: #ffffff !important;
    color: <?php echo wp_kses_post($main_color); ?> !important;
}

.stm_layout_finance .stm_cta.style_1 .btn:hover .btn__icon:before {
    color: <?php echo wp_kses_post($main_color); ?> !important;
}
.archive.stm_header_transparent .stm-header{
    position: relative;
}
.archive .stm_post_details{
    padding: 15px;
}
.archive .stm_post_details .comments_num a i{
    vertical-align: middle;
}
.archive .stm_post_details .comments_num a{
    color: #fff !important;
}
body.archive .stm_post_details>ul li{
    color: #fff;
}
.archive .stm_post_details ul li:before{
    font-size: 1.5rem;
}
.archive .stm_post_details .comments_num{
    margin: 0 0 0 auto;
}

@media (max-width: 1023px) {
    .archive.stm_header_transparent .stm-header{
        position: fixed;
    }
    html body .stm-navigation__default ul li.stm_megamenu.active > .sub-menu {
        margin: 0 !important;
        padding-left: 20px !important;
    }
    .stm_header_style_1 .stm-navigation.stm-navigation__default ul li ul.sub-menu ul.sub-menu,
    .stm_header_style_1 .stm-navigation.stm-navigation__default ul li ul.sub-menu ul.sub-menu li {
        margin: 0 !important;
    }
    .stm_header_style_1 .stm-navigation.stm-navigation__default ul li ul.sub-menu ul.sub-menu li a {
        padding: 10px 0 !important;
    }
    .stm_header_style_1 .stm-navigation.stm-navigation__default ul li ul.sub-menu ul.sub-menu li a:hover,
    .stm_header_style_1 .stm-navigation.stm-navigation__default ul li ul.sub-menu ul.sub-menu li a:active {
        color: rgba(255, 255, 255, 0.7) !important;
    }

    .stm_layout_finance .stm_iconbox_style_2 .stm_iconbox__icon {
        float: left;
        padding-top: 0;
    }

    .stm_layout_finance.stm_header_style_1 .stm-navigation__default > ul > li > a {
        color: #fff !important;
    }

    .stm_layout_finance .stm-header .stm-socials a {
        color: #fff !important;
    }

    .stm-header__row_top .stm-header__cell_left .stm-header__element:first-child {
        order: -1500;
    }

    .stm-header__cell_left .stm-header__element {
        margin: 10px 0 !important;
    }

    .stm-header__row_center .stm-header__cell_left {
        margin: 0 !important;
    }

    .stm_header_style_1 .stm-navigation__default > ul > li > a {
        padding: 6px 10px 6px 10px !important;
    }
}

@media (max-width: 991px) {
    .stm_layout_finance .stm_icontext_style_1.text-right {
        text-align: left !important;
    }
}

@media (min-width: 767px) {
    .finance-video-margin-right {
        margin-right: 17px;
    }
}

@media (max-width: 767px) {
    .stm_layout_finance .stm_mobile__header {
        padding: 15px !important;
    }
    .stm_contact_form .row:before,
    .stm_contact_form .row:after {
        display: none;
    }

    .stm_layout_finance .stm_testimonials.stm_testimonials_style_2 .stm_testimonials__info {
        left: 50px;
        width: auto;
        padding: 10px 20px;
    }
}

@media (max-width: 550px) {
    .stm_layout_finance .stm_testimonials_style_2 .stm_testimonials__meta {
        display: block;
        margin: 0 auto;
    }
    .stm_layout_finance .stm_iconbox_style_7 .stm_iconbox__text {
        margin-top: -5px;
    }
    .archive .stm_post_details .post_date{
        align-items: start;
    }
    .archive .stm_post_details ul li{
     margin: 0;
    }
    .archive .stm_post_details .post_date{
        height: auto;
    }
    .archive .stm_post_details .comments_num {
        margin: 5px 0 0;
    }
}

@media (max-width: 420px) {
    .stm_layout_finance .stm_testimonials.stm_testimonials_style_2 .owl-controls {
        display: none;
    }
    .stm_layout_finance .stm_testimonials.stm_testimonials_style_2 .stm_testimonials__review {
        padding: 15px;
    }
    .stm_layout_finance .stm_testimonials.stm_testimonials_style_2 .stm_testimonials__info {
        left: 15px;
    }
}

