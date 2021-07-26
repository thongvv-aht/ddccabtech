<?php
/*Colors*/
$main_color = pearl_get_option('main_color', $default['main_color']);
$secondary_color = pearl_get_option('secondary_color', $default['secondary_color']);
$third_color = pearl_get_option('third_color', $default['third_color']);
$body_font_data = pearl_get_option('body_font');
$footer_color = pearl_get_option('footer_color');
$top_bar_color = pearl_get_option('top_bar_text_color');
?>

.stm_layout_logisticstwo .special_service_bg {
background-position: -50% 0% !important;
}

.stm_layout_logisticstwo .about_pearl_bg {
background-position: 130% 0% !important;
}

.stm_layout_logisticstwo .faq_bg {
background-position: -50% -5% !important;
}

.stm_layout_logisticstwo .stm-footer .stm-footer__bottom .stm_markup__content {
width: 100%;
text-align: center;
color: <?php echo wp_kses_post($secondary_color); ?>;
font-size: 14px;
font-weight: 400;
line-height: 24px;
}

.stm_layout_logisticstwo .stm-footer .stm-footer__bottom .stm_markup__content a {
color: <?php echo wp_kses_post($main_color); ?>;
text-decoration: underline;
}

.stm_layout_logisticstwo .stm-footer .stm-socials a {
background-color: <?php echo wp_kses_post($main_color); ?>;
color: #fff;
border-radius: 100px;
height: 40px;
width: 40px;
}

.stm_layout_logisticstwo .stm-footer .stm-socials a i::before {
position: relative;
top: 4px;
}

.stm_layout_logisticstwo .stm-footer ul li::before {
position: relative;
top: -1px !important;
content: "";
display: inline-block;
width: 8px;
height: 8px;
border: 2px <?php echo wp_kses_post($main_color); ?> solid;
border-radius: 50%;
margin-right: 15px;
vertical-align: middle;
}

.btn_primary.btn_outline.btn_load:hover span {
color: #fff !important;
}
.comment-form input[type=text], .comment-form input[type=email] {
background: #fff !important;
}
.comment-form button:after {
margin-left: 10px;
}
.stm_layout_logisticstwo .stm-footer ul li a:hover {
color: <?php echo wp_kses_post($main_color); ?>;
}
.stm_loop__grid .stm_read_more_link:before, .stm_loop__grid .stm_read_more_link:after{
top: 0;
}
body .vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-controls-icon:before {
transform: rotate(225deg) translateY(50%) !important;
}
.widget-footer.widget_contacts a {
color: <?php echo wp_kses_post($main_color); ?>;
}
body button[type="submit"]:not(.btn), body input[type="submit"]:not(.btn) {
font-weight: 700;
}
html body .stm-navigation__default ul li.stm_megamenu .stm_megaicon {
margin-top: 4px;
}
.widget-footer.widget_contacts a:hover {
text-decoration: underline;
}
.stm_layout_logisticstwo .stm-footer .footer-widgets {
padding-bottom: 28px;
}

html body.stm_layout_logisticstwo .stm-footer .container .footer-widgets .widgettitle h4 {
color: <?php echo wp_kses_post($secondary_color); ?> !important;
font-size: 18px;
font-weight: 700;
line-height: 24px;
text-transform: none !important;
}
.stm_layout_logisticstwo .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2 .stm-icontext__text {
font-size: 14px;
}
.stm_layout_logisticstwo .stm-footer .widget .widgettitle {
    margin-bottom: 20px;
}
.stm_layout_logisticstwo .stm-footer .widget.stm_widget_pages ul li {
    margin-bottom: 3px;
}
.stm_layout_logisticstwo .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2 {
    margin-bottom: 10px;
}

.stm_layout_logisticstwo .stm-header__row_color_center a:hover {
color: <?php echo wp_kses_post($main_color); ?> !important;
}

.stm_layout_logisticstwo .stm-navigation li a {
font-weight: 400;
line-height: 26px;
}

.stm_layout_logisticstwo .stm-dropdown_style_1.stm-dropdown {
border-radius: 8px;
border: 1px solid #dddddd;
padding: 12px;
color: <?php echo wp_kses_post($secondary_color); ?>;
}

.stm_layout_logisticstwo .stm-dropdown_style_1.stm-dropdown li a {
color: <?php echo wp_kses_post($secondary_color); ?>;
background: #dddddd;
}

.stm_layout_logisticstwo .stm-dropdown_style_2.stm-dropdown {
-webkit-box-shadow: 0 5px 10px rgba(95, 149, 255, 0.2);
box-shadow: 0 5px 10px rgba(95, 149, 255, 0.2);
border-radius: 8px;
background-color: <?php echo wp_kses_post($main_color); ?>;
padding: 0;
}

.stm_layout_logisticstwo .stm-navigation > ul > li.current-menu-item:before {
top: -38px !important;
}

.stm_layout_logisticstwo .stm-header__element ul li::before {
top: -38px !important;
}

.stm_layout_logisticstwo .stm_testimonials_style_15 .owl-dots {
text-align: center;
}

.stm_layout_logisticstwo .stm_mailchimp_wrapper {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-orient: horizontal;
-webkit-box-direction: normal;
-ms-flex-direction: row;
flex-direction: row;
}

.stm_layout_logisticstwo .stm_mailchimp_wrapper input {
height: 51px;
border-radius: 10px;
background-color: #fff !important;
margin-right: 10px;
border-radius: 10px;
}

@media (max-width: 480px){
.stm_layout_logisticstwo .stm_mailchimp_wrapper {
flex-wrap: wrap;
}
.stm_layout_logisticstwo .stm_mailchimp_wrapper input {
width: 100%;
flex: 0 0 100%;
margin: 0 0 15px 0;
}
}

.stm_layout_logisticstwo .stm_mailchimp_wrapper input:focus {
background-color: #fff !important;
}

.stm_layout_logisticstwo .stm_mailchimp_wrapper button {
height: 50px;
-webkit-box-shadow: 0 5px 10px rgba(95, 149, 255, 0.2);
box-shadow: 0 5px 10px rgba(95, 149, 255, 0.2);
border-radius: 8px;
background-color: <?php echo wp_kses_post($main_color); ?> !important;
}

.stm_layout_logisticstwo .stm_posts_list_style_20 h5 a {
color: <?php echo wp_kses_post($secondary_color); ?>;
}

.stm_layout_logisticstwo .stm-counter_style_12 .stm-counter__value, .stm_layout_logisticstwo .stm-counter_style_12 .stm-counter__label {
color: <?php echo wp_kses_post($secondary_color); ?>;
}

.stm_layout_logisticstwo .stm_services_text_carousel_style_4 h5 a {
color: <?php echo wp_kses_post($secondary_color); ?> !important;
font-size: 18px;
font-weight: 700;
line-height: 23.93px;
}

.stm_layout_logisticstwo .stm_services_text_carousel_style_4 p {
color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_logisticstwo .stm_services_text_carousel_style_4 i {
color: <?php echo wp_kses_post($main_color); ?>;
}
.stm_layout_logisticstwo .vc_toggle.vc_toggle_default {
padding: 25px 30px;
background: #fff;
border-radius: 10px;
border: 1px #e8e8e9 solid; }
.stm_layout_logisticstwo .vc_toggle.vc_toggle_default.vc_toggle_active {
border: none;
box-shadow: 0px 15px 30px 0px rgba(0, 0, 0, 0.1); }
.stm_layout_logisticstwo .vc_toggle.vc_toggle_default .vc_toggle_title {
padding-left: 0 !important;
padding-right: 25px; }
.stm_layout_logisticstwo .vc_toggle.vc_toggle_default .vc_toggle_title i {
left: auto !important;
right: 0;
border-color: #5f95ff !important;
color: #5f95ff !important;
background: #5f95ff !important; }
.stm_layout_logisticstwo .vc_toggle.vc_toggle_default .vc_toggle_title i:before, .stm_layout_logisticstwo .vc_toggle.vc_toggle_default .vc_toggle_title i:after {
border-color: #5f95ff !important;
color: #5f95ff !important;
background: #5f95ff !important; }
.stm_layout_logisticstwo .vc_toggle.vc_toggle_default .vc_toggle_content {
padding-left: 0;
font-size: 14px;
line-height: 21px;
margin-bottom: 0; }
.stm_layout_logisticstwo .vc_toggle.vc_toggle_default .vc_toggle_content p {
font-size: 14px;
line-height: 21px; }
.stm_layout_logisticstwo .vc_toggle.vc_toggle_default .vc_toggle_content p:last-child {
margin-bottom: 0; }

.stm_layout_logisticstwo .wpcf7-form.stm_cf7_style_3 input:not([type=submit]) {
background: none;
border-width: 1px;
border-radius: 8px;
font-size: 14px; }

.stm_layout_logisticstwo .wpcf7-form.stm_cf7_style_3 .stm_select {
border-radius: 8px !important;
font-size: 14px; }

.stm_layout_logisticstwo .wpcf7-form.stm_cf7_style_3 textarea {
background: none;
border-width: 1px;
border-radius: 8px;
font-size: 14px; }

.stm_layout_logisticstwo .wpcf7-form.stm_cf7_style_3 [type="submit"] {
border-radius: 8px;
font-size: 14px; }

.stm_layout_logisticstwo .stm_mailchimp_wrapper [type="email"] {
border: none;
padding-bottom: 11px; }

.stm_layout_logisticstwo .stm_mailchimp_wrapper [type="submit"] {
padding-left: 35px;
padding-right: 35px; }
.stm_layout_logisticstwo .stm-footer {
font-size: 14px;
}

.stm_layout_logisticstwo .stm-footer .stm-socials .stm-socials__icon {
opacity: 1; }
.stm_layout_logisticstwo .stm-footer .stm-socials .stm-socials__icon i {
font-size: 18px;
color: #fff !important; }
.stm_layout_logisticstwo .stm-footer .stm-socials .stm-socials__icon:hover {
transform: scale(1.1); }

.stm_layout_logisticstwo .stm-footer__bottom {
position: relative; }
.stm_layout_logisticstwo .stm-footer__bottom:before {
content: '';
position: absolute;
display: block;
width: 1000000px;
height: 1px;
background: #eeeeee;
left: -1000px;
top: 0; }

.stm_layout_logisticstwo .stm-header .dropdown-list {
left: -12px;
right: -12px;
width: auto; }

.stm_layout_logisticstwo .stm_mobile__switcher span {
width: 24px;
height: 3px;
margin-bottom: 4px;
}
.stm_layout_logisticstwo .stm_mobile__switcher.active span:last-child {
top: -3px;
}
@media (max-width: 1024px){
.stm_layout_logisticstwo.stm_header_style_1 .stm_mobile__header, .stm_layout_logisticstwo.stm_header_style_1 .stm-header {
background: #fff !important;
}
.stm_header_style_1 .stm-navigation.stm-navigation__default ul li.menu-item-has-children > a:after {
border-color: <?php echo wp_kses_post($main_color); ?> transparent transparent transparent !important;
}
.stm_layout_logisticstwo.stm_header_style_1 .stm-navigation.stm-navigation__default ul li ul.sub-menu li a {
color: #333 !important;
text-transform: none;
font-weight: 400;
}
}
@media (max-width: 1023px){
    .stm_header_style_1 .stm-navigation.stm-navigation__default ul li.menu-item-has-children > a .stm_mobile__dropdown:after {
        border-color: #000 transparent transparent transparent !important;
    }
}
@media (max-width: 991px){
.stm_layout_logisticstwo .stm-footer {
padding-top: 20px !important;
}
.stm_widget_posts.style_1 ul li .stm_widget_posts__title {
padding-bottom: 37px;
}
}
.youtube-hover i {
transition: .3s;
}
.youtube-hover:hover i {
color: #fff !important;
background-color: #5f95ff !important;
}
.stm_header_style_1 .stm-navigation__default > ul > li ul li > a {
font-weight: 400 !important;
text-transform: none;
}
.stm_event_single_list__alone.hasButton .btn_outline.btn_primary:hover {
color: #fff !important;
}