<?php
/*Default layout styles*/
$default = pearl_get_layout_config();

/*Colors*/
$main_color = pearl_get_option('main_color', $default['main_color']);
$secondary_color = pearl_get_option('secondary_color', $default['secondary_color']);
$third_color = pearl_get_option('third_color', $default['third_color']);

$elements_list = array(
    'colors'        => array(
        'main_color'      => array(
            '.__icon.mtc',
            '.stm_layout_businessfour .stm_testimonials_style_18 .stm_testimonials__info h6',
            '.stm_layout_businessfour .stm_post_type_list_style_1 .stm_post_type_list__single:hover .stm_post_type_list__content h4',
            '.stm_posttimeline_style_1 .stm_posttimeline__post:hover h5',
            'body .stm_widget_posts.style_2 ul>li>a:hover .stm_widget_posts__title',
            '.stm_layout_businessfour .widget.stm_widget_posts.style_2 ul li a:hover .stm_widget_posts__title',
            'body .stm_post_type_list_style_3 .stm_post_type_list__single:hover h4',
            'body .mtc:hover, body .stm_vacancies > a:hover',
            '.stm_vacancies_style_1 .stm_vacancies__single:hover > div',
            '.stm_layout_businessfour .stm_events_list:not(.inverted) .stm_event_single_list:hover .hasTitle h3',
            '.stm_services_style_5 .stm_loop__single_style5 .stm_service_icon_single'
        ),
        'secondary_color' => array(
            'body .ttc',
            'body .stm_vacancies > a',
            '.stm_services_text_carousel_style_1 .stm_services_carousel .item .content h5 a:hover',
            '.stm_services_style_1 a:hover>p',
            '.stm_services_style_5 .stm_loop__single_style5 > a:hover h4',
            '.stm_services_style_6 .stm_loop__single_style6 > a:hover h5',
            '.stm_stories_list_style_1 .stm_loop__story_1:hover .inner h4',
            'body .stm_iconbox_style_2 .stm_iconbox__text h5',
            '.stm_partners_style_2 .stm_partners__description, .stm_partners_style_2 .stm_partners__title',
            '.stm_post_type_list_style_1 .stm_post_type_list__content h4, .stm_post_type_list_style_1 .stm_post_type_list__terms',
            'body .stm_widget_posts.style_2 .stm_widget_posts__title',
            'body.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading .vc_tta-panel-title > a .vc_tta-title-text',

        ),
        'third_color'     => array(
        )
    ),
    'bg_colors'     => array(
        'main_color'      => array(
            '.stm_separator_style_1 .stm_separator.sbc',
            'body .tbc_b_h:hover:before',
            'body .stm_iconbox_style_14.stm_iconbox:hover:before, body .stm_iconbox_style_14.stm_iconbox:hover:after',
            'body .stm_testimonials_style_18 .image_dots .dots.active:after',
            'body .stm_testimonials_style_18 .image_dots .dots:hover:after',
            '.stm_layout_businessfour .stm_slider_style_11.stm_slider .stm_slide__overlay .stm_slide__button a:hover',
            '.mc4wp-alert.mc4wp-success, .mc4wp-alert.wpcf7-mail-sent-ok, .wpcf7-response-output.mc4wp-success, .wpcf7-response-output.wpcf7-mail-sent-ok',
            'body .pearl_arrow_top:hover .arrow',
            '.btn_primary.btn_solid.btn_default:hover',
            '.stm_layout_businessfour .wpcf7-submit.btn_default:hover',
            '.btn_primary.btn_solid:hover.wpcf7-submit',
            '.stm_layout_businessfour .ajax_message.success'
        ),
        'secondary_color' => array(
            'body .stm_iconbox_style_14.stm_iconbox:before, body .stm_iconbox_style_14.stm_iconbox:after',
            'body .tbc_b:before',
            '.stm_layout_businessfour .stm_slider_style_11.stm_slider .stm_slide__overlay .stm_slide__button a',
            '.stm_layout_businessfour .wpcf7-submit',
            '#stm_newsletter_submit:hover',
            '.stm_widget_search.style_1 .widget.widget_search .search-form button:hover',
            '.btn_primary.btn_solid:hover',
            '.stm_markup__sidebar .btn_primary.btn_solid.btn_default:hover',
            '.stm_tabs_style_2 .vc_tta.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active a span.vc_tta-title-text',
            '.gmap_addresses .owl-dots .owl-dot.active',
            '.stm_services_style_2 .stm_loop__single:hover .stm_services__title.stm_animated',
            '.stm_services_style_7 .mbc_h:hover, .stm_services_style_7 .tbc_h:hover',
            '.stm_layout_businessfour .stm_vacancies_style_2 .stm_vacancies__single:hover .inner:before'
        ),
        'third_color'     => array(

        )
    ),
    'border_colors' => array(
        'main_color'      => array(
            '.stm_layout_businessfour .stm_slider_style_11.stm_slider .stm_slide__overlay .stm_slide__button a:hover',
            '.mc4wp-alert.mc4wp-success, .mc4wp-alert.wpcf7-mail-sent-ok, .wpcf7-response-output.mc4wp-success, .wpcf7-response-output.wpcf7-mail-sent-ok',
            '.btn_primary.btn_solid.btn_default:hover',
            '.btn_primary.btn_solid:hover.wpcf7-submit',
        ),
        'secondary_color' => array(
            '.stm_layout_businessfour .stm_slider_style_11.stm_slider .stm_slide__overlay .stm_slide__button a',
            '.stm_layout_businessfour .wpcf7-submit',
            '.btn_primary.btn_solid:hover',
            '.stm_tabs_style_2 .vc_tta.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active a span.vc_tta-title-text',
            '.stm_markup__sidebar .btn_primary.btn_solid.btn_default:hover',
        ),
        'third_color'     => array(

        ),
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
body .stm_projects_carousel__name{
    text-transform: none;
}
.text-transform{
    text-transform: none !important;
}
.stm-effects_opacity:hover{
    text-decoration: underline !important;
}
.stm_projects_grid .stm_projects_carousel__item .btn{
    padding: 15px 20px;
}
.mg_auto{
    margin: 0 auto;
    display: table;
}
a:focus{
    text-decoration: none !important;
}
.pd_{
    padding-right: 30px;
    padding-left: 30px;
}
.my_heading.pd_{
    padding-right: 70px;
    padding-left: 70px;
}
body .my_pd_{
    padding-left: 15px;
}
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
    -webkit-animation: autofill 0s forwards;
    animation: autofill 0s forwards;
    -webkit-text-fill-color: #fff !important;
}

@keyframes autofill {
    100% {
        background: transparent;
        -webkit-text-fill-color: #fff !important;
    }
}

@-webkit-keyframes autofill {
    100% {
        background: transparent;
        -webkit-text-fill-color: #fff !important;
    }
}
.stm_layout_businessfour .stm_iconbox_style_14 .stm_iconbox__desc p{
    font-size: 13px !important;
}
.stm_layout_businessfour .stm_iconbox_style_14.stm_iconbox{
    padding: 30px 40px 38px;
    box-shadow: none;
}
.my_fa{
    padding-left: 5px;
    color: <?php echo wp_kses_post($main_color); ?>;
}
.stm_layout_businessfour.stm_header_style_1 .stm-navigation > ul > li.current-menu-item:before{
    bottom: 0;
}
.stm_layout_businessfour .stm-header__cell .stm-iconbox__icon.mtc{
    color: #fff !important;
    font-size: 32px;
    margin-right: 21px;
}
.stm_layout_businessfour .stm-header__cell .stm-iconbox__text{
    font-size: 18px;
    letter-spacing: 0;
    line-height: 16px;
    white-space: nowrap;
}
.stm_layout_businessfour .stm-header__cell .stm-iconbox__description{
    font-size: 12px;
    line-height: 20px;
    font-weight: 300;
    letter-spacing: 0;
    white-space: nowrap;
}
.stm_layout_businessfour .stm-header__row_color_top .stm-header__cell_right{
    justify-content: space-between;
    max-width: 785px;
    padding-top: 5px;
}
.stm_layout_businessfour .stm-header__cell_right .stm-header__element{

}
.stm_layout_businessfour .stm-header__cell_right .stm-header__element:nth-child(2){
    margin-left: 84px;
}
.stm_layout_businessfour .stm-header__cell_right .stm-header__element:nth-child(3){
    margin-left: 48px;
}
.stm_layout_businessfour .stm-header__cell_right .stm-header__element:nth-child(3) .stm-iconbox__icon.mtc{
    margin-right: 14px;
    margin-top: 2px;
}
.stm_layout_businessfour.stm_header_style_1 .stm-navigation__default > ul > li:first-child{
    margin-left: 30px;
}
.stm_layout_businessfour.stm_header_style_1 .stm-navigation__line_bottom > ul > li:hover:before {
    bottom: 0px;
}
.stm-navigation__default > ul > li > ul {
    top: 75px;
}
.stm-navigation__default > ul > li:hover > ul{
    top:65px;
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu{
    top: 60px;
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li{
    padding: 0 15px 0 25px;
}
.stm-navigation__default > ul > li ul li > a{
    text-transform: inherit;
}
.stm_layout_businessfour.stm_header_style_1 .stm-navigation__default > ul > li > a {
    font-size: 16px;
    padding: 5px 25px;
    line-height: 55px;
}
.stm_layout_businessfour .stm-header__element .stm-socials__icon{
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.5);
    color: rgba(255,255,255,0.5);
    margin-right: 0;
    width: 40px;
    height: 40px;
}
.stm_layout_businessfour .stm-header__element .stm-socials__icon:hover{
    border-color: #fff;
}
.stm_layout_businessfour .stm-header__element .stm-socials__icon:hover, .stm_layout_businessfour .stm_video.stm_video_style_11 .stm_video_title{
    color: #fff;
}
.stm_layout_businessfour .stm-header__element .stm-socials__icon i{
    font-size: 16px;
    margin-top: 10px;
}
.stm_layout_businessfour .stm-header__element .stm-socials__icon:last-child{
    margin-right: 13px;
}
.stm-header__cell_right .stm-header__element:last-child {
    margin-right: 15px;
}
.stm_layout_businessfour .wpb_single_image .vc_single_image-wrapper.vc_box_shadow_border{
    padding: 0 !important;
}
body .stm_iconbox_style_14.stm_iconbox:hover, body .stm_iconbox_style_14.stm_iconbox:hover{
    box-shadow: 0 5px 30px rgba(170,170,170,.7);
}
.stm_layout_businessfour .stm-counter_style_6 {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.stm_layout_businessfour .stm-counter_style_6 .stm-counter__value{
    font-size: 60px;
}
.stm_layout_businessfour .stm-counter_style_6 .stm-counter__value, .stm_projects_carousel_dark .stm_projects_carousel__tab .mtc_a_h.active,
body .vc_tta-accordion .vc_active .vc_tta-panel-heading .vc_tta-title-text, body .stm_services_style_12 .stm_services__title a:hover{
    color: #fff !important;
}
.stm_layout_businessfour .stm-counter_style_6 .stm-counter__label {
    line-height: 24px;
    font-size: 16px;
    margin-top: 21px;
    width: 100%;
    margin: 15px auto 0;
}
.stm_video.stm_video_style_11 .stm_video_title:after{
    opacity: 0;
    width: 50%;
    transition: all .25s ease !important;
}
.stm_video.stm_video_style_11:hover .stm_video_title:after{
    opacity: 1;
    width: 100%;
}
.stm_layout_businessfour .stm-counter_style_6 .stm-counter__icon{
    font-size: 54px;
    line-height: 45px;
    margin: 0;
}
.stm_layout_businessfour .stm-counter_style_6 .stm-counter__label{
    padding: 0 10px;
}
.stm_video.stm_video_style_11 .stm_playb_wrap{
    margin-left: 57px;
}
.stm_layout_businessfour .stm_video.stm_video_style_11 .stm_video_title:after{
    background-color: #fff !important;
}
.stm_layout_businessfour .stm_video.stm_video_style_11 .stm_playb{
    background-image: linear-gradient(to right,#e7174d 0,#b82b7b 51%,#e7174d 100%);
    background-size: 200% auto;
}
.stm_layout_businessfour .stm_video.stm_video_style_11:hover .stm_playb{
    background-position: right center;
}
.stm_layout_businessfour .stm_video.stm_video_style_11 .stm_playb_wrap:before,
.stm_layout_businessfour .stm_video.stm_video_style_11 .stm_playb_wrap:after{
    border: 1px solid #e7174d !important;
}
.right_ .text-right .main_font{
    display: block;
    margin-bottom: 6px;
}
.right_ .stm_icontext__icon{
    float: right;
    line-height: 36px;
    margin-left: 4px;
}
.stm_layout_businessfour .stm-header__cell .stm-iconbox__text,
.stm_layout_businessfour .stm-counter_style_6 .stm-counter__value, .stm_layout_businessfour .my_cont .wpb_wrapper .stm_icontext:nth-child(5) .stm_icontext__text span{
    font-weight: 600;
}
.right_ .stm_icontext_style_1 .stm_icontext__text ,.stm_layout_businessfour .stm_video.stm_video_style_11 .stm_video_title,
.stm_layout_businessfour.stm_header_style_1 .stm-navigation__default > ul > li > a, .stm_layout_businessfour .stm_testimonials_style_18 .stm_testimonials__info h6,
.stm_layout_businessfour .stm-counter_style_6 .stm-counter__value, .stm_layout_businessfour .my_cont .wpb_wrapper .stm_icontext:nth-child(6) .stm_icontext__text span,
body.stm_header_style_1 .stm-navigation__default > ul > li ul li > a, html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li > a, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li > a{
    font-weight: 500;
}
.stm_layout_businessfour .stm_infobox_style_1 .stm_infobox__content{
    max-width: 370px;
    margin: -26% 0 0;
    padding: 36px 40px 20px;
}
.deco_:hover, .right_ .stm_icontext_style_1 .stm_icontext__text:hover, .stm_layout_businessfour .my_cont .wpb_wrapper .stm_icontext:nth-child(6) .stm_icontext__text:hover span,
.widget ul li a:hover, .widget ol li a:hover{
    text-decoration: underline !important;
}
.stm_layout_businessfour .stm_infobox_style_1 .stm_infobox__image img{
    filter: none;
}
.stm_layout_businessfour .stm_testimonials_style_18 .stm_testimonials__review:before{
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
    z-index: -1;
}
.stm_layout_businessfour .stm_testimonials_style_18 .stm_testimonials__review{
    font-size: 30px;
    letter-spacing: -0.1px;
    color: #222527;
}
.stm_layout_businessfour .stm_testimonials_style_18 .stm_testimonials__info h6{
    font-size: 17px;
    line-height: 20px;
}
.stm_layout_businessfour .stm_testimonials_style_18 .image_dots .dots{
    margin: 0 10px;
}
.stm_layout_businessfour .stm_testimonials_style_18 .image_dots .dots img, .stm_layout_businessfour .stm_testimonials_style_18 .image_dots .dots:hover img{
    padding: 5px;
}
.stm_testimonials_style_18 .image_dots .dots:hover:after{
    display: block !important;
    opacity: 0.2;
    top: 7.5%;
    left: 0;
    right: 0;
    width: 85%;
    height: 85%;
    border-radius: 50%;
    margin: 0 auto;
}
.stm_testimonials_style_18 .image_dots .dots.active:hover:after{
    width: 100%;
    height: 100%;
    top: 0;
}
.white_ ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
    color: #fff;
}
.white_ ::-moz-placeholder { /* Firefox 19+ */
    color: #fff;
}
.white_ :-ms-input-placeholder { /* IE 10+ */
    color: #fff;
}
.white_ :-moz-placeholder { /* Firefox 18- */
    color: #fff;
}
.stm_layout_businessfour.stm_form_style_3.home .stm_material_form > span,
.stm_layout_businessfour.stm_form_style_3.home .stm_material_form > label{
    color: #fff;
}
.stm_layout_businessfour.stm_form_style_3.home .stm_material_form:not(.stm_has-value) textarea,
.stm_layout_businessfour.stm_form_style_3.home .stm_material_form:not(.stm_has-value) input{
    border-bottom-color: #fff !important;
}
.stm_layout_businessfour.stm_form_style_3.home .stm_material_form.stm_has-value input,
.stm_layout_businessfour.stm_form_style_3.home .stm_material_form.stm_has-value textarea,
.stm_layout_businessfour.stm_form_style_3 .stm-footer .stm_material_form.stm_has-value textarea,
.stm_layout_businessfour.stm_form_style_3 .stm-footer .stm_material_form.stm_has-value input{
    color: #fff;
}
.stm_layout_businessfour .stm_slider_style_11.stm_slider .stm_slide__overlay .stm_slide__button a,
.stm_layout_businessfour.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .widgettitle h4, .stmicon-notebook_b,
 body.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading .vc_tta-panel-title > a .vc_tta-title-text{
    color: #fff !important;
}
.mc4wp-alert.mc4wp-success:before, .mc4wp-alert.wpcf7-mail-sent-ok:before, .wpcf7-response-output.mc4wp-success:before, .wpcf7-response-output.wpcf7-mail-sent-ok:before{
    border-bottom-color: <?php echo wp_kses_post($main_color); ?>;
}
.stm_layout_businessfour .wpcf7-submit{
    padding: 14px 52px;
    margin-top: 44px;
}
.stm_layout_businessfour .stm_icon_links_style_6 a{
    min-width: 40px;
    min-height: 40px;
    line-height: 40px;
    margin-right: 7px !important;
}
.stm_layout_businessfour.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .widgettitle h4{
    font-size: 14px;
    border-left: 2px solid <?php echo wp_kses_post($main_color); ?>;
    line-height: 0.8;
    padding-left: 15px;
    margin-top: 5px;
    letter-spacing: 1.5px;
}
.stm_layout_businessfour .stm-footer .widget .widgettitle{
    margin-bottom: 33px;
}
.stm_layout_businessfour .stm-footer .widget#stm_custom_menu-2 .widgettitle {
    margin-bottom: 23px;
}
.stm_layout_businessfour .stm_custom_menu_style_1 .menu li{
    margin-bottom: 0;
}
.stm_layout_businessfour .stm_widget_posts.style_6 > ul li img{
    border-radius: 0;
}
.stm_layout_businessfour.stm_sidebar_style_1 .stm_wp_widget_text .textwidget{
    padding-right: 10px;
}
.stm_layout_businessfour.stm_sidebar_style_1 .stm-footer {
    padding: 75px 0 0;
}
.stm_layout_businessfour.stm_sidebar_style_1 .widget ul li:before, .stm_sidebar_style_1 .widget ol li:before,
.stm_layout_businessfour.stm_sidebar_style_1 .widget.widget_archive ul li:before,
.stm_layout_businessfour.stm_sidebar_style_1 .widget.widget_meta ul li:before{
    top: 8px;
    font-size: 16px;
}
.stm_layout_businessfour .widget.widget-footer ul li, .stm_layout_businessfour .widget.widget-footer ol li{
    font-size: 14px;
    line-height: 34px;
}
.stm_layout_businessfour .stm_widget_posts.style_6 > ul li .post-date{
    line-height: 18px !important;
    font-size: 11px;
    color: #808080;
    margin-bottom: 0;
}
.stm_layout_businessfour .stm_widget_posts.style_6 > ul li{
    margin-bottom: 13px !important;
}
.stm_widget_posts.style_6 > ul li > a{
    text-decoration: none !important;
}
.stm_layout_businessfour .stm_widget_posts.style_6 > ul li .stm_widget_posts__title{
    color: #bfbfbf !important;
}
.widget ul li a, .widget ol li a{
    color: #bfbfbf;
}
.widget ul li a:hover, .widget ol li a:hover{
    color: #fff;
}
.stm_layout_businessfour .stm_widget_posts.style_6 > ul li .stm_widget_posts__wrapper{
    padding-left: 17px;
}
.mc4wp-form .mc4wp-form-fields p{
    font-size: 13px;
    line-height: 18px;
    color: #999999;
    margin-top: -4px;
    margin-bottom: 20px;
}
.stm-footer .stm_newsletter_form{
    position: relative;
}
.stm-footer .stm_newsletter_form .stm_material_form{
    padding-top: 0;
}
.stm_layout_businessfour.stm_form_style_3 .stm-footer .stm_material_form > span{
    color: #a0a0a0;
    font-size: 13px;
    line-height: 24px;
    z-index: 99;
    top: 50%;
    left: 10px;
    margin-top: -12px;
    transition: all .25s ease !important;
    opacity: 1;
}
.stm_layout_businessfour.stm_form_style_3 .stm-footer .stm_material_form.stm_has-value > span, .stm_layout_businessfour.stm_form_style_3 .stm-footer .stm_material_form:hover > span{
    opacity: 0;
    z-index: 0;
}
.stm_layout_businessfour.stm_form_style_3 .stm-footer .stm_material_form input[type="email"]{
    border: 2px solid #fff !important;
}
.stm_layout_businessfour.stm_form_style_3 .stm-footer .stm_material_form:not(.stm_has-value) .form-control{
    background-color: #fff;
}
.stm_layout_businessfour.stm_form_style_3 .stm-footer .stm_material_form.stm_has-value .form-control{
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
    padding-left: 10px;
    font-size: 13px;
}
#stm_newsletter_submit{
    position: absolute;
    bottom: 0;
    z-index: 99;
    right: 0;
    padding: 11px 15px 10px;
    font-size: 13px;
    font-weight: 700;
}
.stm_layout_businessfour .stm-footer__bottom{
    border: none;
}
.stm_layout_businessfour .stm-footer__bottom .stm_markup__content{
    font-size: 13px;
    line-height: 30px;
    color: #999999;
    width: 70%;
}
.stm_layout_businessfour .stm-footer__bottom .stm_markup__sidebar{
    width: 30%;
}
.stm_layout_businessfour .stm-footer__bottom .stm_markup__content span a{
    color: #fff;
}
.stm_layout_businessfour .stm-footer .footer-widgets{
    padding-bottom: 25px;
}
.stm_layout_businessfour .stm-footer__bottom{
    padding-top: 23px;
}
.stm-footer__bottom .stm-socials .stm-socials__icon{
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.5);
    color: rgba(255,255,255,0.5);
    margin-right: 4px;
    width: 38px;
    height: 38px;
    background-color: transparent;
}
.stm-footer__bottom .stm-socials .stm-socials__icon:hover, .stm-footer__bottom .stm-socials .stm-socials__icon:hover i{
    background-color: transparent !important;
    color: #fff !important;
    border-color: #fff;
}
.stm-footer__bottom .stm-socials .stm-socials__icon i{
    font-size: 16px;
    margin-top: 10px;
    color: rgba(255,255,255,0.5) !important;
}
body .pearl_arrow_top:hover .arrow::before, body .pearl_arrow_top:hover::after, body .pearl_arrow_top:hover::before,
body .pearl_arrow_top:hover .arrow:after, body .pearl_arrow_top:hover .arrow:before, body .pearl_arrow_top:hover:after, body .pearl_arrow_top:hover:before{
    background-color: #fff;
}
.stm_post_type_list_style_2 .stm_post_type_list__single, .stm_post_type_list_style_2 .stm_post_type_list__content h4,
.stm_projects_grid_style_4 .stm_projects_grid__sorting .stm_projects_carousel__tab:hover a, .stm-effects_opacity.js_sort_carousels:hover,
.widget.stm_widget_posts.style_1 ul li a:hover, .widget.stm_widget_posts.style_2 ul li a:hover{
    text-decoration: none !important;
}
.stm_layout_businessfour .stm_services_style_12 .stm_services__more_link{
    text-decoration: none;
    color: #fff !important;
}
.stm_layout_businessfour .stm_services_style_12 .stm_services__more_link:hover{
    text-decoration: underline;
}
.stm_projects_grid_style_4 .stm_projects_grid__sorting .stm_projects_carousel__tab:hover a:after{
    opacity: 1;
}
.stm_layout_businessfour .stm_read_more_link:before{
    top: -2px;
}
 .stm_layout_businessfour .stm_read_more_link:after{
    top: -1px;
}
.btn_white.btn_solid:hover i, .stm_flipbox__front .mtc, .current.mtc{
    color: #fff !important;
}
.stm-header__row_color_top{
    padding-bottom: 70px;
}
.stm-header__row_color_center{
    margin-top: -32.5px;
    z-index: 999;
}
body .stm_slider_style_11.stm_slider .stm_slide__content span:before{
    background-color: <?php echo wp_kses_post($main_color); ?>;
}
body .stm_slider_style_11.stm_slider .owl-controls .owl-nav .owl-prev, body .stm_slider_style_11.stm_slider .owl-controls .owl-nav .owl-next{
    display: none !important;
}
.archive .stm-header{
    margin-bottom: 0;
}
body.stm_transparent_header_disabled.stm_title_box_disabled.stm_breadcrumbs_enabled .stm-header {
    margin-bottom: 60px;
}



















@media (max-width: 1024px){
    .stm_projects_carousel.stm_fullwidth .owl-nav{
        display: none;
    }
    .stm_layout_businessfour .stm-header__cell_right .stm-header__element:nth-child(2), .stm_layout_businessfour .stm-header__cell_right .stm-header__element:nth-child(3) {
        margin-left: 15px;
    }
    .stm_header_style_1 .stm-header, .stm_header_style_3 .stm-header, .stm_header_style_3 .stm_mobile__header, .stm_header_style_1 .stm_mobile__header, .stm_header_style_9 .stm-header, .stm_header_style_13 .stm-header, .stm_header_style_13 .stm_mobile__header{
        background-color: transparent !important;
    }
}
@media (max-width: 1023px){
    body .my_pd_{
        padding-left: 0;
    }
    .stm_header_style_1 .stm-header, .stm_header_style_3 .stm-header, .stm_header_style_3 .stm_mobile__header, .stm_header_style_1 .stm_mobile__header, .stm_header_style_9 .stm-header, .stm_header_style_13 .stm-header, .stm_header_style_13 .stm_mobile__header{
        background-color: <?php echo wp_kses_post($main_color); ?> !important;
    }
    .stm-header__row_color_top{
        padding-bottom: 35px;
    }
    .stm-header__row_color_center{
        margin-top: 0;
    }
    .stm_mobile__switcher span{
        background-color: #fff !important;
    }
    .stm_layout_businessfour.stm_header_style_1 .stm-navigation__default > ul > li:first-child{
        margin-left: 0;
    }
    .stm_header_style_1 .stm-header{
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
    }
    .stm_header_style_1 .stm-header .stm-header__row_color_top{
        -ms-flex-order: 2;
        order: 2;
    }
    body .stm-header__element{
        -ms-flex-order: inherit !important;
        order: inherit !important;
        padding: 0;
    }
    .stm_layout_businessfour .stm-header__cell .stm-iconbox__text{
        white-space: normal;
    }
    .stm_layout_businessfour .stm-header__cell .stm-iconbox__description{
        white-space: normal;
    }
    .stm_layout_businessfour.stm_header_style_1 .stm-navigation__default > ul > li > a{
        padding: 5px 15px;
    }
    body .stm_megamenu .stm_megaicon, .stm_header_style_1 .stm-navigation ul > li > ul > li.current-menu-item > a, html body.stm_layout_businessfour .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li.current-menu-item>a{
        color: #fff !important;
    }
    body .stm-navigation__default > ul > li a{
        padding: 0 15px;
    }
    body.stm_header_style_1 .stm-header{
        padding: 20px 0 20px 0;
    }
    body.stm_header_style_1 .stm-navigation__default > ul{
        margin: 0 !important;
    }
    body .stm-header__cell_right{
        padding: 0 15px;
    }
    html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a,
    html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li.menu-item-has-children a, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li.menu-item-has-children a{
        padding-right: 15px !important;
        padding-left: 15px !important;
    }
    .stm_layout_businessfour.stm_header_style_1 .stm-navigation > ul > li.current-menu-item>a, .stm_header_style_1 .stm-navigation ul > li > ul > li.current-menu-item > a,
    html body.stm_layout_businessfour .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li.current-menu-item>a,
    html body.stm_layout_businessfour .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li.current-menu-item>a{
        background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    }
    .stm_layout_businessfour .stm-footer__bottom .stm_markup__content{
         text-align: center;
    }
    .stm-footer__bottom .stm_markup__sidebar > div, .stm-footer__bottom .stm_markup__sidebar > div:first-child{
        margin: 0 auto;
    }

    
    .stm-navigation__default > ul > li .stm_mobile__dropdown {
        right: 0 !important;
    }
    .stm_header_style_1 .stm-navigation.stm-navigation__default ul li.menu-item-has-children > a .stm_mobile__dropdown:after {
        left: 50%;
        right: auto;
        margin: -2px 0 0 -2px;
    }
}

@media (max-width: 768px){
    body .stm_loop__single_list_style_2 .stm_loop__post_image{
        margin: 0;
    }
    body .vc_col-sm-6:nth-of-type(2n+1) {
        clear: none;
    }
    body .stm_donation_style_2 .stm_donation__details-wrapper{
        padding: 15px;
    }
    .right_ .text-right .main_font{
        margin-bottom: 15px;
    }
    .my_heading.pd_ {
        padding-right: 15px;
        padding-left: 15px;
    }
    .stm_layout_businessfour .wpb_single_image .vc_single_image-wrapper.vc_box_shadow_border{
        box-shadow: none !important;
    }
    #stm_newsletter_submit{
        padding: 10px 15px 10px;
    }
    .stm_layout_businessfour .stm_video.stm_video_style_11 .stm_playb_wrap{
        margin-left: 0;
        padding: 75px 60px;
    }
    .vc_row-flex > .container > .row > .vc_column_container.vc_col-has-fill{
        display: block;
        width: 100%;
        margin-bottom: 10px;
    }
    .vc_row-flex > .container > .row > .vc_column_container.vc_col-has-fill>.vc_column-inner{
        max-width: 100% !important;
        margin-right: 0 !important;
    }
    html body .stm_mgb_34{
        margin-bottom: 0;
    }
    body .stm_loop__single_list_style_2 .stm_loop__content{
        padding: 15px 15px 0;
    }
    body .stm_loop__single_list_style_2 .stm_post_details{
        margin-bottom: 10px;
    }
}

@media (max-width: 767px){
    .right_ .text-right .main_font{
        position: relative;
        text-align: left;
        display: table;
        padding-right: 25px;
    }
    .right_ .stm_icontext__icon{
        float: none;
        position: absolute;
        right: 0px;
    }
    body .stm_testimonials_style_18 .stm_testimonials__review{
        line-height: 1.3;
    }
}


@media (max-width: 640px){
    body .stm_donation_style_2 .stm_donation__details-wrapper{
        padding: 30px;
    }
    .align_ .wpb_wrapper>h2{
        text-align: center !important;
    }
    .stm_video.stm_video_style_11{
        justify-content: center;
    }
    .stm_video.stm_video_style_11 .stm_video_title{
        margin-left: 0;
    }
    body .my_block_.consulting-video-margin-right{
        margin-right: 0;
        border-right-style: none !important;
        border-bottom-style: none !important;
    }
    .vc_row-flex > .container > .row > .vc_column_container.vc_col-has-fill{
        margin-bottom: 0;
    }
}

@media (max-width: 550px){
    body .h2, body h2 {
        font-size: 24px !important;
        line-height: 1.3 !important;
    }
    body .h2, body h2 {
        font-size: 24px !important;
        line-height: 1.3 !important;
    }
}

@media (max-width: 520px){
    .stm_events_list_style_1 .stm_event_single_list .stm_event_single_list__alone.hasDate{
        margin-left: 6px;
    }
    .stm-footer .footer-widgets aside.widget:not(:first-child){
        margin-top: 20px;
    }
    html body .stm_mgb_34{
        margin-bottom: 15px;
    }
    body .stm_loop__single_list_style_2 .stm_loop__content{
        padding: 15px 30px 0;
    }
    body .stm_loop__single_list_style_2 .stm_post_details{
        margin-bottom: 15px;
    }
}
@media (max-width: 375px){
    .stm_layout_businessfour .stm_video.stm_video_style_11 .stm_playb_wrap{
        padding: 75px 35px;
    }
    .stm_events_list_style_1 .stm_event_single_list .stm_event_single_list__alone.hasDate{
        margin-left: 0px;
    }
}

@media (max-width: 320px){
    body.wpb-js-composer .vc_tta.vc_general .vc_tta-panel-title{
        line-height: 1.3;
    }
    body .stm-counter_style_3.no_icon .stm-counter__label{
        padding-right: 30px;
    }
}


@media (max-width: 812px) and (max-height: 375px) {
    .stm_layout_businessfour .wpb_single_image .vc_single_image-wrapper.vc_box_shadow_border {
        box-shadow: none !important;
    }
    .stm_video.stm_video_style_11 .stm_playb_wrap{
        margin-left: 0;
    }
}
@media (max-height: 414px) and (max-width: 736px) {
    .stm_layout_businessfour .wpb_single_image .vc_single_image-wrapper.vc_box_shadow_border {
        box-shadow: none !important;
    }
    .stm_video.stm_video_style_11 .stm_playb_wrap{
        margin-left: 0;
    }
    .align_ .wpb_wrapper>h2{
        text-align: center !important;
    }
    .stm_video.stm_video_style_11{
        justify-content: center;
    }
    .stm_video.stm_video_style_11 .stm_video_title{
        margin-left: 0;
    }
}