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
        ),
        'secondary_color' => array(
            '.stm-search_style_2 .search-form button:hover i',
            'body .stm_widget_pages_style_1.widget ul li.current_page_item a, body .stm_widget_pages_style_1.widget ul li:hover a'
        ),
        'third_color' => array(
            'body .stm_testimonials_style_15 .owl-controls .owl-nav .owl-next:hover:before, body .stm_testimonials_style_15 .owl-controls .owl-nav .owl-prev:hover:before',
            '.stm-footer__bottom .stm_markup__sidebar .stm-socials__icon_filled',
        )
    ),
    'bg_colors' => array(
        'main_color' => array(
        ),
        'secondary_color' => array(
            'body .stm_testimonials_style_3 .owl-dots .owl-dot.active',
        ),
        'third_color' => array(
            '.stm-footer #mc4wp_form_widget-2 .mailchimp:hover',
            'body .stm_testimonials_style_5 .owl-controls .owl-nav .owl-prev:hover, body .stm_testimonials_style_5 .owl-controls .owl-nav .owl-next:hover'
        )
    ),
    'border_colors' => array(
        'main_color' => array(),
        'secondary_color' => array(
                'body .stm_testimonials_style_3 .owl-dots .owl-dot',
        ),
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

.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__front .inner_flip .stm_projects__meta .inner h5:before,
.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__back .inner_flip .stm_projects__meta .inner h5:before {
	margin: 0 auto 23px;
}
body .btn.btn_outline.btn_third:hover>i{
    color: #fff !important;
}
.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__front .inner_flip .stm_projects__meta,
.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__back .inner_flip .stm_projects__meta {
	justify-content: center;
}
.stm-header__row_color.stm-header__row_color_center{
    margin-top: -45px;
    position: relative;
    z-index: 9999;
}
body:not(.home) .stm-header__row_color.stm-header__row_color_center{
    background-color: <?php echo wp_kses_post($secondary_color); ?>;
}
.stm-header__row_color_center > .container > .stm-header__row_center{
    padding: 25px 55px;
}
.stm-header__row_color.stm-header__row_color_center > .container{
    width: 1260px;
}
.stm-header__cell_right{
    justify-content: space-between;
}
.stm-header__cell_right .stm-header__element_icon_only{
    margin-left: 40px;
}
.stm-header__cell_right .stm-header__element_icon_only .stm-socials__icon{
    margin: 0 13px;
}
.stm-header__row_top .stm-header__cell_left .stm-header__element:last-child{
    margin-left: 50px;
}
.stm-header__row_color_top .stm-icontext__text a{
    color: #fff;
}
.stm-header__row_color_top .stm-icontext__text a:hover{
    text-decoration: none;
}
.stm-search_style_2 .search-form .form-control{
    width: 255px;
    padding-right: 35px;
    margin-top: 4px;
    height: 40px;
}
.stm-search_style_2 .search-form .search-form{
    margin-right: 10px;
}
.stm-search_style_2 .search-form button{
    font-size: 20px;
    margin-top: 2px;
}
.stm_form_style_4 .stm-search_style_2 .search-form input[type="search"]{
    background-color: rgba(255,255,255,0.1);
    border: none;
}
.stm-header__row_color_top .stm-icontext__text a:hover{
    color: #04a5dd;
}
.stm_markup__sidebar_divider .stm_widget_pages_style_1 .widgettitle h5{
    font-weight: 700;
    font-size: 16px;
}
.stm-header__row_color_top a,
.stm-search_style_2 .search-form button i{
    color: rgba(255,255,255,0.5);
}
select, input[type="text"], input[type="email"], input[type="search"], input[type="password"], input[type="number"], input[type="date"], input[type="tel"], textarea, .stm_select .form-control{
    background: rgba(255,255,255,0.1);
    border: none;
}
body input[type="search"]:focus{
    border: none !important;
    border-radius: 0 !important;
}
body .stm-navigation__default > ul > li > a, .stm-navigation__default > ul > li ul li > a{
    font-weight: 600;
    text-transform: uppercase;
}
.stm-navigation__line_bottom > ul > li:hover:before{
    bottom: -13px;
}
.stm-navigation__default > ul > li:hover > ul{
    top: 41px;
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu{
    top: 71px;
    margin: 0 auto;
}

.stm_headings_line.stm_headings_line_bottom h1:after,
.stm_headings_line.stm_headings_line_bottom .h1:after,
.stm_headings_line.stm_headings_line_bottom h2:after,
.stm_headings_line.stm_headings_line_bottom .h2:after{
    margin: 37px 0 15px !important;
}

.stm_headings_line.stm_headings_line_bottom h3:after,
.stm_headings_line.stm_headings_line_bottom .h3:after,
.stm_headings_line.stm_headings_line_bottom h4:after,
.stm_headings_line.stm_headings_line_bottom .h4:after,
.stm_headings_line.stm_headings_line_bottom h5:after,
.stm_headings_line.stm_headings_line_bottom .h5:after,
.stm_headings_line.stm_headings_line_bottom h6:after,
.stm_headings_line.stm_headings_line_bottom .h6:after{
    display: none;
}

.strich_cont{
    max-width: 1750px;
}
body .stm_services_style_11 .stm_service__image {
    filter: none;
}
body .stm_services_style_11 .stm_service__image:after {
    content: '';
    display: block;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.25);
}
.stm_services_style_11 .stm_loop__grid_4:hover .stm_service__single .stm_service__image:after{
    background-color: rgba(<?php echo wp_kses_post(pearl_hex2rgb($main_color, 0.85)); ?>) !important;
}
body .stm_services_style_11 .stm_service__single{
    border-radius: 0;
}
body .stm_services_style_11 .stm_service__title{
    bottom: 10px;
}
.stm_services_style_11 .stm_loop__grid_4:hover .stm_service__title > span{
    color: <?php echo wp_kses_post($third_color); ?>;
}
body .stm_services_style_11 .stm_service__title > span {
    font-size: 30px;
    line-height: 36px;
    font-weight: 600;
    letter-spacing: -1.2px;
    padding-right: 30px;
}
body .stm_services_style_11 .stm_service__title > span:after {
    content: "\f054";
    font: normal normal normal 14px/1 FontAwesome;
    background: transparent !important;
    position: absolute;
    top: auto;
    bottom: 14px;
    left: auto;
    right: 13px;
    height: 12px;
    font-size: 26px;
    opacity: 0;
}
body .stm_services_style_11 .stm_loop__grid_4:hover .stm_service__title > span:after{
    opacity: 1;
}
.z-index{
    z-index: 0 !important;
}
.stm_markup__sidebar .stm_posts_list_single__body h5:after, .stm_markup__sidebar .stm_posts_list .h4:after{
    display: none;
}
body .link_:hover{
    text-decoration: none;
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
body .stm-counter_style_8{
    border-left-color: <?php echo wp_kses_post($third_color); ?>;
}
body .stm-counter_style_8 .stm-counter__value{
    font-size: 60px;
    font-weight: 700;
    line-height: 36px;
    letter-spacing: 0.25px;
}
body .stm-counter_style_8 .stm-counter__label{
    font-size: 16px;
    line-height: 36px;
    font-weight: 600;
}
.counter_ .vc_column_container:first-child .stm-counter_style_8{
    border: none;
}
.arrow_:after{
    display: block;
    content: "" !important;
    font-family: stmicons !important;
    font-size: 66px;
    line-height: 1.1;
    position: absolute;
    top: 95px;
    left: -85px;
    color: <?php echo wp_kses_post($secondary_color); ?>;
}
body .stm_testimonials_style_5 .owl-controls .owl-nav .owl-prev:before,
body .stm_testimonials_style_5 .owl-controls .owl-nav .owl-next:before{
    font-size: 25px;
    line-height: 47px;
}
body .stm_testimonials .owl-dots .owl-dot.active span,
body .stm_testimonials .owl-dots .owl-dot span, body .owl-controls .owl-dots .owl-dot span{
    display: none;
}
.stm_testimonials_style_15 h2{
    text-align: center;
    font-size: 42px;
    margin-bottom: 57px;
}
body .widget.widget_archive ul li:before{
    left: 20px;
}
body.stm_headings_line.stm_headings_line_bottom .stm_testimonials_style_15 h2:after{
    margin-right: auto !important;
    margin-left: auto !important;
}
.stm_testimonials_style_15 .owl-dots{
    text-align: center;
}
body .stm_testimonials_style_15 .stm_testimonials__review{
    line-height: 48px;
    font-weight: 500;
}
body .stm_testimonials_style_15 .owl-controls .owl-nav{
    width: 260px;
    position: absolute;
    left: 0;
    right: 0;
    text-align: center;
    margin: 0 auto;
}
body .owl-nav .owl-prev, body .owl-nav .owl-next{
    background-color: #ffffff;
}
body .stm_testimonials_style_15 .owl-controls .owl-nav .owl-next:before,
body .stm_testimonials_style_15 .owl-controls .owl-nav .owl-prev:before{
    color: #12aadf;
}
body .stm_testimonials_style_15 .stm_testimonials__info h6{
    font-weight: 700;
}
body .stm_carousel_style_1{
    margin: 0 auto 45px;
}
body .stm_iconbox_style_3 .stm_iconbox__icon{
    margin-right: 20px;
}
body .stm_iconbox_style_3 .stm_iconbox__icon i{
    line-height: 1.5;
}
.stm_form_style_4 div.wpcf7-response-output {
    margin-top: 30px !important;
    line-height: 24px !important;
}
.stm_form_style_4 .request_box .wpcf7-form-control-wrap {
    margin-bottom: 20px;
    max-width: 320px;
}
.stm_form_style_4 .request_box input[type="tel"],
.stm_form_style_4 .request_box input[type="email"],
.stm_form_style_4 .request_box input[type="password"],
.stm_form_style_4 .request_box input[type="text"] {
    height: 44px;
    padding: 10px 15px 10px;
    font-size: 14px;
    border: none;
    outline: none !important;
}
select, input[type="text"], input[type="email"],
input[type="search"], input[type="password"],
input[type="number"], input[type="date"],
input[type="tel"], textarea,
.stm_select .form-control{
    height: 38px;
}
.stm_form_style_4 .feedback_form input[type="tel"]:focus,
.stm_form_style_4 .feedback_form input[type="email"]:focus,
.stm_form_style_4 .feedback_form input[type="password"]:focus,
.stm_form_style_4 .feedback_form input[type="text"]:focus,
.stm_form_style_4 .feedback_form textarea:focus {
    background: #ffffff;
    border-radius: 0 !important;
}
.widget.widget-default.widget_search .search-form input[name="s"]:focus{
    border: 1px solid <?php echo wp_kses_post($secondary_color); ?> !important;
    border-radius: 0 !important;
}
.stm_form_style_4 .feedback_form label {
    font-size: 16px;
    font-weight: 300;
}
.stm_form_style_4 .wpcf7-form-control-wrap {
    margin-bottom: 30px;
}
.btn__icon{
    top: -1px;
    bottom: -1px;
}
.stm_form_style_4 .feedback_form textarea {
    border: 1px solid #c4c4c4;
    min-height: 150px;
    resize: none;
}
.stm_buttons_style_17.stm_form_style_4 .feedback_form [type=submit] {
    margin-top: 22px;
    padding: 10px 30px !important;
}
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
    color: rgba(10,26,64,0.5);
    line-height: 1.5;
}
::-moz-placeholder { /* Firefox 19+ */
    color: rgba(10,26,64,0.5);
    line-height: 1.5;
}
:-ms-input-placeholder { /* IE 10+ */
    color: rgba(10,26,64,0.5);
    line-height: 1.5;
}
:-moz-placeholder { /* Firefox 18- */
    color: rgba(10,26,64,0.5);
    line-height: 1.5;
}

.btn{
    font-size: 16px;
    line-height: 24px;
    padding: 10px 30px;
    text-transform: none;
}
<!--.request_box .btn.btn_solid.btn_white:hover{-->
<!--    background-color: #fff !important;-->
<!--    color: --><?php //echo wp_kses_post($third_color); ?><!-- !important;-->
<!--}-->
body.home #wrapper{
    padding-bottom: 0;
}
.stm-footer{
    padding-top: 76px;
}
.stm-footer a, .stm-footer .stm-socials__icon:hover,
.stm-footer .footer-widgets aside.widget .widgettitle h4,
body .stm-footer .stm_post_type_list_style_1 .stm_post_type_list__content h4{
    font-size: 14px;
    line-height: 24px;
}
body .stm-footer .stm_post_type_list_style_1 .stm_post_type_list__content h4{
    text-transform: none;
    color: #fff !important;
}
body .stm-footer .stm_post_type_list_style_1 .stm_post_type_list__terms{
    margin-top: 5px;
    font-size: 12px;
    line-height: 16px;
    color: rgba(255,255,255,0.6) !important;
}
body .stm-footer .stm_post_type_list_style_1 .stm_post_type_list__single{
    border: none;
    margin-bottom: 0;
    padding-bottom: 16px;
}
.stm-footer{
    font-size: 13px;
    line-height: 28px;
}
.stm-footer .footer-widgets aside.widget .widgettitle h4{
    border-bottom: 1px solid rgba(204,204,204,0.25);
    letter-spacing: 0.4px;
    padding-bottom: 20px;
    color: #fff;
}
.widget .widgettitle{
    margin-bottom: 20px;
}
.textwidget .btn.btn_primary.btn_outline{
    color: #fff !important;
}
.textwidget .btn.btn_primary.btn_outline{
    margin-top: 20px;
}
body .stm_custom_menu_style_3 .menu li{
    padding: 0 0 0 15px !important;
}
body .stm_custom_menu_style_3 .menu li a{
    font-size: 14px;
    line-height: 38px;
}
#stm_custom_menu-2.stm_custom_menu_style_3 .widgettitle.widget-footer-title{
    margin-bottom: 16px;
}
body .stm_custom_menu_style_3 .menu li:before{
    line-height: 37px;
    font-size: 14px;
    margin-right: 5px;
}
.stm-footer #mc4wp_form_widget-2 form .mc4wp-form-fields{
    position: relative;
}
.stm-footer #mc4wp_form_widget-2 .mailchimp{
    position: absolute;
    top: 0;
    right: 0;
    height: 100%;
    padding: 5px 13px 5px 15px;
}
.stm-footer #mc4wp_form_widget-2 .mailchimp i{
    font-size: 25px;
    line-height: 22px;
}
#mc4wp_form_widget-2.widget .widgettitle{
    margin-bottom: 30px;
}
.stm-footer__bottom .stm_markup__sidebar .stm-socials__icon_filled{
    background-color: #999999;
}
.stm-footer__bottom .stm_markup__sidebar .stm-socials__icon_filled{
    font-size: 20px;
    line-height: 1.5;
}
body .stm-footer .stm-footer__bottom{
    border-top: 1px solid rgba(204,204,204,0.25);
}
body .stm_iconbox__text h5:before{
    display: none;
}
.owl-nav .owl-prev:before, .owl-nav .owl-next:before{
    color: inherit;
}
body .stm_widget_categories.style_1 .widgettitle .no_line:before{
    display: none !important;
}
body .stm_testimonials_style_3 .owl-dots .owl-dot{
    padding: 5px;
}
.stm_header_style_1 .stm-navigation > ul > li.current-menu-item:before,
.stm_header_style_1 .stm-navigation > ul > li.current-menu-parent:before{
    opacity: 1;
    visibility: visible;
    bottom: -11px;
}
body.wpb-js-composer .vc_tta.vc_general .vc_tta-panel-title{
    line-height: 1.2;
}
.stm_titlebox .stm_breadcrumbs span.current-item, .stm_titlebox .stm_breadcrumbs a:hover span{
    color: #fff !important;
}
body .stm_markup__sidebar_divider .stm_widget_pages_style_1 ul li a{
    font-weight: 600;
    font-size: 13px;
    line-height: 1.4;
}
body .stm_staff_list_style_1 .stm_staff__name{
    margin-bottom: 10px;
}
body .stm-icontext__text{
    font-size: 14px;
}
.vc_tta.vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab>a .vc_tta-title-text, .vc_tta.vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab>a:hover .vc_tta-title-text{
    font-weight: 700;
}
body .stm-footer .footer-widgets{
    padding-bottom: 20px;
}
body .stm-footer{
    padding-top: 60px;
}
body .stm_services_style_11 .stm_service__title>span{
    font-size: 24px;
    line-height: 28px;
}
body .stm_services_style_11 .stm_service__title>span:after{
    right: 0;
}
html body .stm_lh_24{
    line-height: 1.2;
}
body .stm_mobile__switcher{
    margin-left: auto;
}
body .stm_testimonials_style_15 .stm_testimonials__info h6{
    text-transform: none !important;
}
@media (max-width: 1280px){
    body .stm_services_style_11 .stm_service__title > span{
        padding-right: 0;
    }
}
@media (max-width: 1024px){
    html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a{
        padding: 8px 0 !important;
    }
    body.stm_header_style_1 .stm-navigation__default > ul > li > a{
        padding: 0 15px;
    }
    .stm-header__cell_left .stm-header__element .stm-logo img{
        max-width: 150px;
    }
    .stm-header__row_color.stm-header__row_color_center > .container {
        width: 970px;
    }
    .stm-header__row_color_center > .container > .stm-header__row_center{
        padding: 25px 30px;
    }
    body .stm_carousel_style_1 .stm_carousel__single_big{
        min-height: 50px;
    }
    body .stm_services_style_11 .stm_service__title > span{
        font-size: 20px;
        line-height: 30px;
    }
    .stm-header__cell_left{
        flex-grow: 0;
    }
}

@media (max-width: 1023px){
    body.stm_header_style_1 .stm-navigation__default > ul > li > a{
        padding: 10px 0;
    }
    .stm_header_style_1 .stm-header, .stm_header_style_3 .stm-header, .stm_header_style_3 .stm_mobile__header, .stm_header_style_1 .stm_mobile__header, .stm_header_style_9 .stm-header, .stm_header_style_13 .stm-header, .stm_header_style_13 .stm_mobile__header{
        background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    }
    .stm_mobile__switcher span{
        background-color: <?php echo wp_kses_post($third_color); ?> !important;
    }
    .stm_header_style_1 .stm-header {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
    }
    body.stm_header_style_1 .stm-header .stm-header__row_color:first-child {
        -ms-flex-order: 2;
        order: 2;
        padding-top: 35px !important;
    }
    body .stm-navigation__default > ul > li{
        line-height: 20px;
    }
    .stm-header__row_color_center > .container > .stm-header__row_center{
        padding: 25px 15px;
    }
    body.stm_header_style_1 .stm-header{
        padding: 20px 0 20px 0px;
    }
    html body .stm-navigation__default ul li.stm_megamenu .sub-menu > li, html body .stm-navigation__fullwidth ul li.stm_megamenu .sub-menu > li{
        margin: 0 !important;
    }
    body.stm_header_style_1 .stm-header .stm-header__row_color:before,
    body.stm_header_style_1 .stm-header .stm-header__row_color{
        background-color: <?php echo wp_kses_post($third_color); ?> !important;
    }
    body.home.stm_header_style_1 .stm_mobile__header{
        margin-bottom: 0;
    }
    body .stm-navigation__default > ul > li ul li > a{
        padding: 10px;
    }
    body.stm_header_style_1 .stm-navigation.stm-navigation__default ul li ul.sub-menu li a{
        color: <?php echo wp_kses_post($third_color); ?> !important;
    }
    body.stm_header_style_1 .stm-navigation.stm-navigation__default ul > li > ul > li.current-menu-item > a,
    body.stm_header_style_1 .stm-navigation.stm-navigation__default ul > li.current_page_parent > a {
        color: #fff  !important;
    }
    html body .stm-navigation__default ul li.stm_megamenu:hover ul.sub-menu, html body .stm-navigation__fullwidth ul li.stm_megamenu:hover ul.sub-menu,
    .stm_header_style_1 .stm-navigation.stm-navigation__default ul li ul.sub-menu ul.sub-menu{
        padding-left: 10px !important;
    }
}

@media (max-width: 812px){
    body .stm_services_style_11 .stm_service__title > span:after{
        right: -30px;
    }
    .arrow_:after{
        display: none;
    }
    .counter_ .vc_column_container:first-child .stm-counter_style_8{
        border-left: 1px solid <?php echo wp_kses_post($third_color); ?> ;
    }
    .cont_ .vc_column-inner{
        background: #fff !important;
    }
    .stm-footer__bottom .stm_markup.stm_markup_right .stm_markup__content,
    .stm-footer__bottom .stm_markup.stm_markup_left .stm_markup__content,
    .stm-footer__bottom .stm_markup.stm_markup__right .stm_markup__content,
    .stm-footer__bottom .stm_markup.stm_markup__left .stm_markup__content{
        text-align: center;
    }
    .stm-footer__bottom .stm_markup__sidebar > div:first-child{
        margin: 0 auto;
    }
    body .stm_services_style_11 .stm_service__title{
        padding: 15px;
    }
    body .stm_loop .stm_loop__grid_4{
        width: 50%;
    }
    .cont_top{
        margin-top: 0 !important;
    }
}
@media(max-width: 768px){
    body .stm_widget_posts.style_1 ul li img{
        max-width: 50px !important;
        margin-right: 15px;
    }
}
@media (max-width: 550px){
    .h1, h1 {
        font-size: 36px !important;
        line-height: 1.2 !important;
    }
    .stm-footer .footer-widgets{
        padding-bottom: 70px;
    }
    body .stm_loop .stm_loop__grid_4{
        width: 100%;
    }
    body .stm-counter_style_8 .stm-counter__label{
        line-height: 25px;
    }
    .stm-footer .footer-widgets aside.widget{
        margin-bottom: 60px;
    }
    .stm-footer .footer-widgets aside.widget:last-child{
        margin-bottom: 0;
    }
    .stm_form_style_4 .request_box .wpcf7-form-control-wrap{
        max-width: 100%;
    }
}
@media (max-width: 375px){
    body .stm_infobox_style_1 .stm_infobox__content{
        margin: 0;
        padding: 20px 30px;
    }
}
@media (max-width: 320px){
    body .stm-counter_style_8{
        padding-left: 10px;
        border: none !important;
    }
}