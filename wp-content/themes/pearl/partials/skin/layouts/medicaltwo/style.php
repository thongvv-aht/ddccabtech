<?php
/*Default layout styles*/
$default = pearl_get_layout_config();

/*Colors*/
$main_color = pearl_get_option('main_color', $default['main_color']);
$secondary_color = pearl_get_option('secondary_color', $default['secondary_color']);
$third_color = pearl_get_option('third_color', $default['third_color']);

$elements_list = array(
    'colors' => array(
        'main_color' => array(
            '.stm-header__cell_left .stm-header__element:last-child .stm-icontext__text',
        ),
        'secondary_color' => array(
            '.stm-header__cell_left .stm-header__element .stm-icontext__icon'
        ),
        'third_color' => array(
            'body .stm_services_style_11 .stm_service__title > span',
            'body .stm_testimonials_style_5 .stm_testimonials__info h6'
        )
    ),
    'bg_colors' => array(
        'main_color' => array(
            'body .btn_extended.btn_secondary.btn_solid',
        ),
        'secondary_color' => array(
            'body .btn_extended.btn_secondary.btn_solid:hover',
        ),
        'third_color' => array(

        )
    ),
    'border_colors' => array(
        'main_color' => array(),
        'secondary_color' => array(),
        'third_color' => array(),
    )
);

foreach ($elements_list['colors'] as $color => $elements) { ?>
    <?php echo implode(',', $elements) ?> {color: <?php echo sanitize_text_field(${$color}); ?> !important}
<?php }

foreach ($elements_list['bg_colors'] as $bg_color => $elements) { ?>
    <?php echo implode(',', $elements) ?> {background-color: <?php echo sanitize_text_field(${$bg_color}); ?> !important}
<?php }

foreach ($elements_list['border_colors'] as $border_color => $elements) { ?>
    <?php echo implode(',', $elements) ?> {border-color: <?php echo sanitize_text_field(${$border_color}); ?> !important}
<?php } ?>
body.home #wrapper{
padding-bottom: 0;
}
body .stm-header{
    margin-bottom: 0;
}
._underline{
    position: relative;
}
.main_color{
    color: <?php echo wp_kses_post($main_color); ?>;
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li{
    padding: 0 30px;
}
body .stm_custom_menu_style_3 .menu li a:after, body .widget_follow.widget_follow_style_1 a:after, ._underline:after {
    content: '';
    position: absolute;
    visibility: hidden;
    top: 100%;
    left: 0;
    right: 0;
    text-align: center;
    height: 2px;
    background-color: <?php echo wp_kses_post($main_color); ?>;
}
body .stm_custom_menu_style_3 .menu li a:hover:after, body .widget_follow.widget_follow_style_1 a:hover:after, ._underline:hover:after{
    visibility: visible;
}
body .stm_custom_menu_style_3 .menu li a{
    font-size: 15px;
    line-height: 40px;
}
body .stm-header__row_color_top, .stm-header__row_color_top .stm-icontext__text{
    color: #595959;
}
body .stm-header__row_color_top{
    border-bottom: 1px solid #e4e4e4;
}
body .btn_extended{
    padding: 16px 21px 18px 55px !important;
}
.btn_extended .stm-button__text{
    text-transform: uppercase;
    font-weight: 600;
    margin-top: 1px;
}
.btn_extended .stm-button__icon{
    font-size: 14px;
    left: 22px;
}
.stm-header__cell_left .stm-header__element:nth-child(2) .stm-icontext__icon{
    transform: rotateY(180deg);
    display: inline-block;
}
.stm-header__element .stm-socials__icon{
    margin: 0;
    padding: 0 12px;
}
body.stm_header_style_1 .stm-navigation__default > ul > li > a{
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
}
body.stm_header_style_1 .stm-navigation > ul > li.current-menu-item:before {
    bottom: -10px;
}
body ul.comment-list .comment .comment-text p{
    line-height: 1.2;
}
body .stm_titlebox_style_6 .stm_titlebox__inner .stm_breadcrumbs{
    margin: 0 -15px 5px;
}
body.stm_header_style_1 .stm-navigation__line_bottom > ul > li:hover:before{
    bottom: -10px;
}
body .stm-navigation__default > ul > li:hover > ul{
    top: 40px;
}
body .stm-navigation__default > ul > li:after{
    content: '';
    display: block;
    clear: both;
}
.stm_slider .stm_slide__title .heading_font mark{
    background-color: transparent !important;
    color: <?php echo wp_kses_post($main_color); ?>;
    padding: 0;
    margin: 0;
}
body .stm_slider_style_4.stm_slider .text-left .stm_slide__overlay{
    padding-left: 15px;
    top: 297px;
}
body .stm_slider_style_4.stm_slider .stm_slide__content{
    max-width: 450px;
    margin-bottom: 35px;
}
.stm_slider .stm_slide__content span{
    line-height: 30px;
}
body .stm_slider_style_4.stm_slider .stm_slide__title span{
    font-size: 42px;
    line-height: 54px;
    letter-spacing: -0.6px;
}
body .stm_slider .stm_slide__title{
    margin-bottom: 20px;
    padding-top: 48px;
}
body .stm_slider_style_4.stm_slider .stm_slide__button a{
    padding: 8px 50px;
    background: linear-gradient(-180deg, <?php echo wp_kses_post($secondary_color); ?>,#ff5f58);
    transition: all .25s ease !important;
    border: none;
    outline: none !important;
}
body .stm_slider_style_4.stm_slider .stm_slide__button a:hover{
    background: linear-gradient(-180deg,<?php echo wp_kses_post($main_color); ?>, #9099fd);
}
body .stm_services_style_11 .stm_service__title > span{
    font-size: 24px;
    line-height: 30px;
    font-weight: 500;
    transition: all .25s ease;
}
body .stm_services_style_11 .stm_service__title > span:after{
    display: none;
}
body .stm_services_style_11 .stm_service__image{
    filter: none;
}
body .stm_services_style_11 .stm_service__image:after{
    content: '';
    display: block;
    position: absolute;
    top: 50%;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, #fff, 80%, rgba(0,0,0,0));
}
body .stm_services_style_11 .stm_service__single:hover .stm_service__image:after{
    background: linear-gradient(-180deg,<?php echo wp_kses_post($main_color); ?>, #9099fd);
    opacity: 0.85;
    top: 0;
}
body button[type="submit"]:not(.btn){
    background: linear-gradient(-180deg, <?php echo wp_kses_post($secondary_color); ?>,#ff5f58);
}
body button[type="submit"]:not(.btn):hover{
    background: linear-gradient(-180deg,<?php echo wp_kses_post($main_color); ?>, #9099fd);
}
body .stm_services_style_11 .stm_service__single{
    box-shadow: 0px 1px 30px 0px rgba(119, 119, 119, 0.35);
}
body .stm_services_style_11 .stm_service__single:hover{
    box-shadow: none;
}
body .stm_services_style_11 .stm_service__single:hover .stm_service__title > span{
    color: #fff !important;
}
body .pos_abs .stm_infobox_style_1 .stm_infobox__image{
    position: absolute;
    top: 13px;
    left: 80px;
    width: 495px;
}
body .stm_infobox_style_1 .stm_infobox__image img{
    filter: none;
}
body .stm-counter_style_5 .stm-counter__value{
    color: <?php echo wp_kses_post($main_color); ?>;
    font-size: 60px;
    line-height: 72px;
    font-weight: 500;
    letter-spacing: -0.8px;
    margin: 0 0 5px;
}
body .stm-counter_style_5 .stm-counter__label{
    color: <?php echo wp_kses_post($third_color); ?>;
}
body .stm_infobox_style_1 .stm_infobox__content{
    display: none;
}
body .stm-counter_style_5 .stm-counter__label{
    font-size: 16px;
    padding: 0;
}
body .stm-counter_style_5{
    text-align: left;
}
body .stm_iconbox_style_15.stm_iconbox__icon-center .stm_iconbox__icon{
    margin: 47px auto 0 !important;
}
body .stm_iconbox_style_15.stm_iconbox .stm_iconbox__text p{
    font-size: 14px;
    line-height: 24px;
    color: #404040;
}
body .stm_iconbox_style_15.stm_iconbox .stm_iconbox__text p,
body .stm_iconbox_style_15.stm_iconbox .stm_iconbox__text span{
    transition: none;
}
body .stm_iconbox_style_15.stm_iconbox .stm_iconbox__text h5 span{
    font-size: 24px;
    line-height: 30px;
    font-weight: 500;
}
body .stm_iconbox_style_15.stm_iconbox:hover.mtc_h:hover .stm_iconbox__text h5 span,
body .stm_iconbox_style_15.stm_iconbox:hover.mtc_h:hover .stm_iconbox__text p span,
.stm_iconbox_style_15.stm_iconbox.mtc_h:hover .stm_iconbox__text .stm_iconbox__desc p,
body .stm_iconbox_style_15.stm_iconbox.mtc_h:hover .stm_iconbox__icon i,
body.stm_form_style_3 .form_icon:after{
    color: #fff !important;
}
body.home.stm_form_style_3 .stm_material_form input[type="text"], .home.stm_material_form:not(.stm_has-value) input{
    border-bottom: 1px solid rgba(255,255,255,0.5) !important;
}
.stm_form_style_3 .form-reverse .stm_material_form select,
.stm_form_style_3 .form-reverse .stm_material_form input[type="text"],
.stm_form_style_3 .form-reverse .stm_material_form input[type="email"],
.stm_form_style_3 .form-reverse .stm_material_form input[type="search"],
.stm_form_style_3 .form-reverse .stm_material_form input[type="password"],
.stm_form_style_3 .form-reverse .stm_material_form input[type="number"],
.stm_form_style_3 .form-reverse .stm_material_form input[type="date"],
.stm_form_style_3 .form-reverse .stm_material_form input[type="tel"],
.stm_form_style_3 .form-reverse .stm_material_form textarea,
.stm_form_style_3 .form-reverse .stm_material_form .form-control{
    border-bottom: 1px solid rgba(255,255,255,0.5) !important;
}
body .stm_iconbox_style_15{
    border-color: #f1f2f3 !important;
    background-color: #fff;
}
body .stm_iconbox_style_15.stm_iconbox:hover{
    background-color: transparent !important;
    background: linear-gradient(-180deg,<?php echo wp_kses_post($main_color); ?>, #9099fd);
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
}
body.stm_form_style_3 .form-group,
body.stm_form_style_3 .wpcf7-form-control-wrap{
    margin-bottom: 11px;
}
body .textarea_230 textarea{
    min-height: 194px !important;
}
body button[type="submit"]:not(.btn).wpcf7-form-control.wpcf7-submit{
    margin-top: 24px;
    padding: 10px 32px;
}
body.stm_pagination_style_6 .owl-nav .owl-next:hover,
body.stm_pagination_style_6 .owl-nav .owl-prev:hover,
.stm_testimonials_style_5 .owl-controls .owl-nav .owl-prev:hover,
.stm_testimonials_style_5 .owl-controls .owl-nav .owl-next:hover{
    background: linear-gradient(-180deg,<?php echo wp_kses_post($main_color); ?>, #9099fd);
    border: none;
}
body .stm_testimonial__carousel .owl-controls .owl-nav .owl-next:before,
body .stm_testimonial__carousel .owl-controls .owl-nav .owl-prev:before,
body .stm_staff_container_grid .owl-controls .owl-nav .owl-next:before,
body .stm_staff_container_grid .owl-controls .owl-nav .owl-prev:before{
    color: #d9d9d9 !important;
    font-size: 20px;
}
.stm_staff_container_grid .owl-nav .owl-prev{
    left: -105px;
}
.stm_staff_container_grid .owl-nav .owl-next{
    right: -105px;
}
body .stm_staff_grid_style_3 .stm_staff__name{
    line-height: 30px;
    font-weight: 500;
    text-align: center;
    text-transform: none !important;
    margin-bottom: 0;
}
.stm_testimonials_style_5 .owl-controls .owl-nav .owl-prev,
.stm_testimonials_style_5 .owl-controls .owl-nav .owl-next{
    border: 1px solid #d9d9d9 !important;
}
body .stm_testimonials_style_5 .owl-controls .owl-nav .owl-prev,
body .stm_testimonials_style_5 .owl-controls .owl-nav .owl-next{
    top: 40% !important;
}
body .stm_testimonials_style_5 .owl-controls .owl-nav .owl-prev{
    left: -200px !important;
}
body .stm_testimonials_style_5 .owl-controls .owl-nav .owl-next{
    right: -200px !important;
}
body .stm_staff_grid_style_3 .stm_staff__job{
    font-style: normal;
    line-height: 24px;
    text-align: center;
    text-transform: none !important;
}
body .stm_staff_grid_style_3{
    background-color: #fff !important;
}
body .stm_staff_container__carousel .stm_staff_grid_style_3:after{
    content: '';
    display: block;
    position: relative;
    width: 100%;
    height: 3px;
    z-index: 999;
    background: linear-gradient(-90deg,#04a5dd, #9099fd);
}
.stm_single_stm_events .stm_markup__content .stm_single_event__categories i{
    color: #fff !important;
}
._upcoming>.vc_column-inner>.wpb_wrapper{
    color: #fff;
}
body .btn.btn_outline:hover, body .btn.btn_outline:hover i{
    color: #fff !important;
}
body .stm_staff_grid_style_3 .stm_staff__image{
    margin-bottom: 24px;
}
body .stm_testimonials_style_5 .stm_testimonials__review{
    padding: 84px 80px 120px;
    font-style: normal;
    font-weight: 400;
    text-align: center;
    font-size: 24px;
    line-height: 46px;
    background: #fff;
}
body .stm_testimonials_style_5 .stm_testimonials__avatar {
    max-width: 137px;
    margin: -96px auto 27px;
    border: 0;
    background: 0 0;
    box-shadow: none;
}
.stm_testimonials_style_5 .stm_testimonials__avatar img {
    border-radius: 50%;
}
body .widget_contacts_style_11 .widget_contacts_inner .stm-icontext i.stmicon-med_time:before{
    content: "\ec4e" !important;
}
body .stm_testimonials_style_5 .stm_testimonials__info h6{
    font-size: 24px;
    font-weight: 500;
}
body .stm_testimonials_style_5 .stm_testimonials__info span {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #404040 !important;
}
body .stm_testimonials_style_5 .stm_testimonials__item .stm_testimonials__review{
    margin: 10px;
    box-shadow: 0px 0px 10px 2px rgba(119, 119, 119, 0.35);
}
body .btn .btn_subtitle_label{
    margin-bottom: 8px;
}
body .btn.btn_subtitle{
    padding: 5px 20px 5px;
}
body .stm_donation_style_2 .stm_donation__details-wrapper{
    padding: 21px 50px 30px 40px;
}
body.home .stm_carousel__big .stm_owl_navRight .owl-controls .owl-nav{
    position: relative;
    top: -193px;
}
body.home .stm_carousel__big .stm_owl_navRight .owl-controls .owl-nav .owl-next{
    right: 0 !important;
    width: 60px;
    height: 60px;
    margin-top: 0;
    border-color: #c8c8c8;
}
body.home .stm_carousel__big .stm_owl_navRight .owl-controls .owl-nav .owl-prev{
    right: 80px !important;
    left: auto !important;
    width: 60px;
    height: 60px;
    margin-top: 0;
    border-color: #c8c8c8;
}
body.home .stm_carousel__big .stm_owl_navRight .owl-controls .owl-nav .owl-next:before,
body.home .stm_carousel__big .stm_owl_navRight .owl-controls .owl-nav .owl-prev:before{
    line-height: 60px;
    font-size: 20px;
}
body .tbc{
    background: linear-gradient(-180deg,<?php echo wp_kses_post($main_color); ?>, #9099fd);
}
body .tbc:hover{
    background: linear-gradient(-180deg, <?php echo wp_kses_post($secondary_color); ?>,#ff5f58);
}

body .stm-footer .footer-widgets aside.widget.stm_wp_widget_text p{
    font-size: 15px;
    line-height: 30px;
    color: rgba(255,255,255,0.5) !important;
}
body .stm-footer__bottom{
    border: none;
    padding: 25px 0 20px;
}
body .stm_markup_right.stm_markup_50 > .stm_markup__sidebar{
    padding-right: 0;
}
body .stm-footer__bottom a{
    color: rgba(255,255,255,0.5) !important;
    font-size: 14px;
}
.stm_custom_menu_style_3 .menu li a:after{
    display: none;
}
body .stm-footer a, body .stm-footer .stm-socials__icon:hover,  body .stm-footer, .stm-footer__bottom .stm-socials .stm-socials__icon .fa{
    color: rgba(255,255,255,0.5) !important;
}
body .stm-footer .stm-footer__bottom a, body .stm-footer .stm-footer__bottom span,
body .stm-footer__bottom .stm-socials .stm-socials__icon .fa{
    color: rgba(255,255,255,0.2) !important;
}
body .stm-footer .stm-footer__bottom a:hover,
body .stm-footer__bottom .stm-socials .stm-socials__icon:hover .fa{
    color: rgba(255,255,255,1) !important;
}
body .stm_custom_menu_style_3 .menu li:before{
    color: <?php echo wp_kses_post($main_color); ?>;
    content: '';
    position: relative;
    top: 15px;
    left: 0;
    margin-right: 10px;
    height: 10px;
    width: 10px;
    border: 1px solid #04a5dd;
    border-radius: 50%;
}
body .stm_custom_menu_style_3 .menu li:hover:before{
    color: <?php echo wp_kses_post($secondary_color); ?>;
}
body .widget_contacts_style_11 .widget_contacts_inner .stm-icontext i{
    color: <?php echo wp_kses_post($secondary_color); ?>;
    line-height: 32px;
}
.stm-footer .footer-widgets aside.widget#stm_custom_menu-2 .widgettitle{
    margin-bottom: 20px;
}
.stm-footer .footer-widgets aside.widget#contacts-2 .widgettitle{
    margin-bottom: 13px;
}
body .stm-footer .footer-widgets aside.widget .widgettitle h4{
    font-size: 24px;
}
body .stm_custom_menu_style_3 .menu li a:hover{
    color: #fff !important;
}
body .stm-icontext_style2 .stm-icontext__text{
    font-size: 15px;
    line-height: 30px;
}
body .stm-footer .footer-widgets aside.widget{
    margin-top: 5px;
}
.stm-footer__bottom .stm-socials .stm-socials__icon{
    background-color: transparent;
}
body .stm-navigation__default > ul > li ul{
    z-index: 9999;
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu{
    top: 48px;
}
body .stm_services_style_4 .stm_services__icon:before{
    display: none;
}
<!--//Liner gradient for icons-->
<!--body .stm_iconbox_style_15.stm_iconbox__icon-center .stm_iconbox__icon{-->
<!--    background: linear-gradient(-180deg, --><?php //echo wp_kses_post($secondary_color); ?><!--,#ff5f58);-->
<!--    -webkit-background-clip: text;-->
<!--    -moz-background-clip: text;-->
<!--    background-clip: text;-->
<!--    -webkit-text-fill-color: transparent;-->
<!--}-->

@media (max-width: 1024px){
    .stm_header_style_1 .stm-header{
        background-color: transparent !important;
    }
}
@media (max-width: 1023px){
    .stm_header_style_1 .stm-header, .stm_header_style_3 .stm-header, .stm_header_style_3 .stm_mobile__header, .stm_header_style_1 .stm_mobile__header, .stm_header_style_9 .stm-header, .stm_header_style_13 .stm-header, .stm_header_style_13 .stm_mobile__header{
        background-color: #ffffff !important;
    }
    html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu{
        padding: 15px 0 0 15px !important;
    }
    .stm_header_style_1 .stm-header{
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
    }
    body.stm_header_style_1 .stm-header .stm-header__row_color:first-child{
        -ms-flex-order: 2;
        order: 2;
    }
    body .stm-header__element .btn_extended{
        padding: 15px !important;
        text-align: center;
    }
    body .stm-header__element .btn_extended i{
        display: none;
    }
    body .stm-header__element:last-child{
        margin-bottom: 15px !important;
    }
    body .stm-header__row_color_top{
        border: none;
    }
    body.stm_header_style_1 .stm-navigation.stm-navigation__default ul li.menu-item-has-children > a:after{
        border-color: <?php echo wp_kses_post($main_color); ?> transparent transparent transparent;
    }
    body.stm_header_style_1 .stm-navigation.stm-navigation__default ul li ul.sub-menu li a{
        color: <?php echo wp_kses_post($third_color); ?>  !important;
    }
    body.stm_header_style_1 .stm-navigation.stm-navigation__default ul > li > ul > li.current-menu-item > a{
        color: #fff  !important;
    }
    body .stm_services_style_11 .stm_service__image img{
        height: auto;
    }
    .stm_header_style_1 .stm-navigation.stm-navigation__default ul li.menu-item-has-children>a .stm_mobile__dropdown:after {
        border-color: #000 transparent !important;
    }
}
@media (max-width: 812px){
    body .stm_widget_posts.style_1 ul li .post-date{
        position: relative;
        bottom: 12px;
    }
    .stm_markup.stm_markup_right .stm_markup__content, .stm_markup.stm_markup_left .stm_markup__content, .stm_markup.stm_markup__right .stm_markup__content, .stm_markup.stm_markup__left .stm_markup__content{
        text-align: center;
    }
    .stm-footer__bottom .stm_markup__sidebar > div:first-child{
        margin: 0 auto;
    }
    body .stm_donation_style_2 .stm_donation__details-wrapper{
        padding: 20px 15px;
    }
}
@media (max-width: 550px){
    body .stm_slider_style_4.stm_slider{
        max-height: 500px !important;
    }
    body .stm_slider_style_4.stm_slider .text-left .stm_slide__overlay{
        top: 240px;
    }
    body .stm_services_style_11 .stm_service__image, body .stm_services_style_11 .stm_service__image img{
        width: 100%;
    }
    body .stm_testimonials_style_5 .stm_testimonials__review{
        padding: 84px 20px 120px;
    }
    body .h2, body h2 {
        font-size: 30px !important;
        line-height: 1.2 !important;
    }
    body .stm_slider_style_4.stm_slider .stm_slide__title span{
        font-size: 36px;
        line-height: 42px;
    }
}
@media (max-width: 375px){
    body .stm_testimonials_style_5 .stm_testimonials__review{
        font-size: 18px;
        line-height: 30px;
    }

}
