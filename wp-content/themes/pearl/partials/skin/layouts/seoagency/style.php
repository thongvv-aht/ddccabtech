<?php
    /*Fonts*/
    $fonts = pearl_get_font();

    $main_font = $fonts['main'];
    $secondary_font = $fonts['secondary'];

    /*Colors*/
    $main_color = pearl_get_option('main_color');
    $secondary_color = pearl_get_option('secondary_color');
    $third_color = pearl_get_option('third_color');
?>

.upcoming .container .wpb_wrapper {
    color: #fff;
}

.stm_layout_seoagency .stm-navigation__default>ul>li:hover>ul{
    top: 65px;
}

.stm_layout_seoagency .stm_projects_cards_style_5 .stm_projects_cards__image img{
    -webkit-transform: scale(1) translate3D(0, 0, 0);
    transform: scale(1) translate3D(0, 0, 0);
}
.stm_layout_seoagency.stm_buttons_style_12 .btn{
    font-size: 14px;
    font-weight: 600;
    line-height: 24px;
}
.stm_layout_seoagency .text-transform{
    text-transform: none !important;
}
.stm_layout_seoagency .stm_markup__sidebar .mc4wp-form-fields .stm_mailchimp_wrapper{
    text-align: center;
}
.stm_layout_seoagency .stm_markup__sidebar .mc4wp-form-fields .btn.btn_solid:not(.btn_white){
    position: static;
    margin-top: 20px;
    background-color: <?php echo wp_kses_post($third_color); ?> !important;
}
.stm_layout_seoagency .stm_markup__sidebar .mc4wp-form-fields .btn.btn_solid:not(.btn_white):hover{
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
body.home{
    background-repeat: no-repeat;
    background: #e6e0e0;
    background: -webkit-gradient(linear, left top, left bottom, from(#e6e0e0), to(#ebe7e6));
    background: -moz-linear-gradient(top, #e6e0e0, #ebe7e6);
    filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#e6e0e0', endColorstr='#ebe7e6');
}

.stm_layout_seoagency .stm-navigation__default>ul>li.current-menu-item>a{
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm-navigation__default>ul>li ul li>a, .stm_layout_seoagency .stm_projects_cards_style_5 .stm_projects_cards__filter li{
    text-transform: none;
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li {
    padding: 0 20px;
}
.stm_layout_seoagency .stm-header .stm-socials .stm-socials__icon{
    margin: 0 7px;
    padding: 2px 10px;
    font-size: 20px;
    color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_layout_seoagency .stm-header .stm-socials .stm-socials__icon:nth-child(3){
    margin-right: 0;
    padding-right: 5px;
}
.stm_layout_seoagency .stm_projects_cards_style_5 .stm_projects_cards__filter li{
    font-weight: 400;
}
.stm_layout_seoagency .stm_projects_cards_style_5 .stm_projects_cards__filter li:after{
    display: none;
}
.stm_layout_seoagency .stm-header .stm-socials .stm-socials__icon:hover{
    color: <?php echo wp_kses_post($third_color); ?> !important;
}
.stm_layout_seoagency .stm_projects_cards_style_5 .stm_projects_cards__title{
    font-weight: 300;
}
.stm_layout_seoagency .stm_infobox_style_12 .stm_infobox__image{
    margin-right: 27px;
}
.vc_row.vc_row-o-content-middle>.color_white>.vc_column-inner{
    align-items: flex-end;
}
.stm_layout_seoagency .stm_video.stm_video_style_11 .stm_video_title {
    margin-left: 2px;
    font-weight: 500;
    font-size: 16px;
    line-height: 16px;
    margin-right: 1px;
}
.stm-counter.stm-counter_style_9 .stm-counter__label {
    margin-top: 13px;
    color: rgba(255,255,255,0.75) !important;
    font-size: 15px;
    line-height: 30px;
}
.stm-counter.stm-counter_style_9 .stm-counter__value {
    font-weight: 400;
    font-size: 54px;
}
.color_white .stm_animation.stm_viewport{
    margin-right: 7px;
}

.letter_sp{
    letter-spacing: 0.3px;
}
.stm_layout_seoagency .stm_testimonials_style_18 .stm_testimonials__review{
    max-width: 850px;
    color: <?php echo wp_kses_post($third_color); ?> ;
    letter-spacing: -0.2px;
}
.stm_layout_seoagency .stm_testimonials_style_18 .stm_testimonials__review:before {
    background: -webkit-linear-gradient(45deg, #5564ff, #01b3ff 70%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 50px;
}
.stm_layout_seoagency .stm_testimonials_style_18 .stm_testimonials__meta{
    margin-bottom: 0;
}
.stm_layout_seoagency  .stm_testimonials_style_18 .stm_testimonials__info h6{
    font-size: 18px;
    line-height: 24px;
}
.stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front, .stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back{
    border-radius: 0;
}
.stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front,
.stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back {
    height: 430px;
    border: 0 !important;
    border-top: 3px solid <?php echo wp_kses_post($main_color); ?> !important;
    background-color: #f7f9ff !important;
}
.stm_layout_seoagency .vc_inner .vc_column_container:nth-child(2) .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front,
.stm_layout_seoagency .vc_inner .vc_column_container:nth-child(2) .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back{
    border-color: #a08cba !important;
}
.stm_layout_seoagency .vc_inner .vc_column_container:nth-child(3) .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front,
.stm_layout_seoagency .vc_inner .vc_column_container:nth-child(3) .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back{
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_seoagency .vc_inner .vc_column_container:nth-child(2) .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .inner h5{
    color: #a08cba ;
}
.stm_layout_seoagency .vc_inner .vc_column_container:nth-child(3) .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .inner h5{
    color: <?php echo wp_kses_post($secondary_color); ?> ;
}
.stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .inner h5,
.stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner h5 {
    margin-bottom: 2px;
    letter-spacing: 2.5px;
    font-weight: 700;
    font-size: 12px;
    color: <?php echo wp_kses_post($main_color); ?> ;
}
.stm_layout_seoagency .vc_inner .vc_column_container .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .inner h5:last-child,
.stm_layout_seoagency .vc_inner .vc_column_container .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner h5:last-child {
    letter-spacing: 0px;
    text-transform: none;
    font-size: 14px;
    line-height: 14px;
    font-weight: 500;
    color: #222527;
}
.stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .stm_pricing-table__price {
    margin-bottom: 8px;
    font-size: 54px;
    font-weight: 400;
    letter-spacing: -0.4px;
    color: <?php echo wp_kses_post($third_color); ?> !important;
}
.stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .inner,
.stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner {
    padding: 31px  25px 39px;
}
.stm_form_style_3 .mc4wp-form-fields{
    position: relative;
}
.stm_form_style_3 .mc4wp-form-fields input[type="email"].wbc{
    border: 0;
    height: 52px;
    background: #fff;
    padding: 14px 34px;
    text-transform: uppercase;
    text-align: left;
    font-size: 14px;
    font-weight: 500;
    line-height: 24px;
    letter-spacing: 0.9px;
    border-radius: 50px;
    color: rgba(10,26,64,0.5);
}
.stm_layout_seoagency .mc4wp-form-fields .btn.btn_solid:not(.btn_white){
    background-color: <?php echo wp_kses_post($main_color); ?> !important;
    border-radius: 50px;
    position: absolute;
    top: 0;
    right: -1px;
    font-size: 14px;
    font-weight: 600;
    line-height: 24px;
    letter-spacing: 0.9px;
    text-transform: uppercase;
    padding: 13px 33px;
}
.stm_layout_seoagency .mc4wp-form-fields .btn.btn_solid:not(.btn_white):hover{
    -webkit-box-shadow: 0px 8px 16px 0px rgba(102,148,243,.52);
    -moz-box-shadow: 0px 8px 16px 0px rgba(102,148,243,.52);
    box-shadow: 0px 8px 16px 0px rgba(102,148,243,.52);
}
.stm_layout_seoagency.stm_sidebar_style_1 .stm-footer{
    padding: 56px 0 0;
}
.stm-footer .menu li {
    margin: 5px 27px !important;
    font-weight: 500;
    font-size: 16px;
}
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
    color: rgba(10,26,64,0.5);
}
::-moz-placeholder { /* Firefox 19+ */
    color: rgba(10,26,64,0.5);
}
:-ms-input-placeholder { /* IE 10+ */
    color: rgba(10,26,64,0.5);
}
:-moz-placeholder { /* Firefox 18- */
    color: rgba(10,26,64,0.5);
}
.stm_layout_seoagency  .stm-footer .menu li.current_page_item > a:after, body.stm_header_style_11 .stm-navigation__default > ul > li.current_page_item > a:after{
    opacity: 0;
}
.stm_layout_seoagency  .stm-footer .menu li a:hover, body.stm_header_style_11 .stm-navigation__default > ul > li > a:hover{
    color: <?php echo wp_kses_post($secondary_color); ?>;
}
.stm_layout_seoagency  .stm-footer .menu li a:hover:after, body.stm_header_style_11 .stm-navigation__default > ul > li > a:hover:after{
    opacity: 0;
}
.stm_layout_seoagency .stm_cta.style_1 {
    padding: 16px 30px 16px 54px;
    margin: 0;
}
.stm_projects_cards_style_5 .stm_projects_cards__filter li.active a{
    color: <?php echo wp_kses_post($secondary_color); ?>;
}
.stm_layout_seoagency .stm_infobox_style_11 .stm_infobox__link a{
    color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_layout_seoagency .stm_infobox_style_11 .stm_infobox__link a:after{
    background-color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_layout_seoagency .stm_infobox_style_11 .stm_infobox__link a:hover{
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_seoagency .stm-footer .stm-socials__icon> .ttc{
    color: rgba(146,146,146,0.9) !important;
}
.archive.stm_header_transparent .stm-header{
    position: relative;
}
@media (min-width: 1024px){
    .stm_layout_seoagency .stm-header__cell_center{
        justify-content: flex-end;
    }
    .stm_layout_seoagency .stm-header__cell_right{
        max-width: 170px;
    }
}

@media (max-width: 1024px){
    .vc_row.vc_row-o-content-middle>.color_white>.vc_column-inner{
        align-items: center;
    }
    .stm_layout_seoagency.stm_header_style_1 .stm-header{
        background-color: transparent !important;
    }
}

@media (max-width: 1023px){
    .stm_layout_seoagency.home.stm_header_style_1 .stm_mobile__header{
        margin-bottom: 0;
    }
    .archive.stm_header_transparent .stm-header{
        position: fixed;
    }
    .stm_layout_seoagency .stm-navigation {
        line-height: inherit !important;
    }
}

@media (max-width: 768px){
    .stm_layout_seoagency.stm_header_style_1 .stm-header{
        background-color: #fff !important;
    }
    .stm_header_style_1 .stm_mobile__header{
        background-color: #fff !important;
    }
    .stm_layout_seoagency.stm_header_style_1 .stm-navigation.stm-navigation__default ul li.menu-item-has-children > a:after{
        border-color: <?php echo wp_kses_post($main_color); ?> transparent transparent transparent;
    }
    .stm_layout_seoagency.stm_header_style_1 .stm-navigation.stm-navigation__default ul li ul.sub-menu li a{
        color: <?php echo wp_kses_post($third_color); ?> !important;
    }
    .stm_layout_seoagency.stm_header_style_1 .stm-navigation ul > li > ul > li:hover > a{
        color: #fff !important;
    }
    .stm_layout_seoagency.stm_header_style_1 .stm-navigation.stm-navigation__default ul li ul.sub-menu li.current-menu-item a{
        color: #fff !important;
    }
    .stm_layout_seoagency .stm_infobox_style_11 .stm_infobox__content h5,
    .stm_layout_seoagency .stm_infobox_style_12 .stm_infobox__content h5 {
        font-size: 20px !important;
    }
}

@media (max-width: 550px)  {
    .stm_layout_seoagency .h1, .stm_layout_seoagency h1{
        font-size: 30px !important;
    }
    .stm_layout_seoagency .h2, .stm_layout_seoagency h2{
        font-size: 25px !important;
    }
    .stm_layout_seoagency .h3, .stm_layout_seoagency h3{
        font-size: 20px !important;
    }
}

@media (max-width: 425px){
    .stm_layout_seoagency .stm_infobox_style_12 .stm_infobox__image{
        margin-top: 10px;
    }
    .stm_layout_seoagency .stm_testimonials_style_18 .image_dots{
        margin: 0 15px 0;
    }
    .stm_layout_seoagency .stm_mailchimp_wrapper{
        text-align: center;
    }
    .stm_layout_seoagency  .stm_video.stm_video_style_11 .stm_playb_wrap:before, .stm_video.stm_video_style_11 .stm_playb_wrap:after{
        width: 60px;
        height: 60px;
    }
    .stm_layout_seoagency .stm_video.stm_video_style_11 .stm_playb {
        width: 60px;
        height: 60px;
    }
    .stm_layout_seoagency .stm_video.stm_video_style_11 .stm_playb:after{
        width: 70px;
        height: 70px;
    }
}























body.stm_layout_seoagency.stm_header_style_11 .stm-navigation__default > ul > li ul {
    min-width: 160px;
}

.stm_layout_seoagency .stm_breadcrumbs {
    text-transform: none;
}
.stm_layout_seoagency .stm_breadcrumbs span {
    text-transform: none;
}
.stm_layout_seoagency .stm_breadcrumbs .container {
    padding: 0;
}


.stm_layout_seoagency .stm_cta.style_1 .stm_cta__content {
    width: 70%;
}

.stm_layout_seoagency .comment-reply-link i {
    margin-right: 10px;
}
.stm_layout_seoagency #commentform button:after {
    display: none;
}

.stm-counter.stm-counter_style_9 {
    border: 0;
    padding: 0;
    margin-bottom: 30px;
}


.stm-footer .menu li.current-menu-parent > a,
    body.stm_header_style_11 .stm-navigation__default > ul > li.current-menu-parent > a {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm-footer .menu li.current_page_item > a,
    body.stm_header_style_11 .stm-navigation__default > ul > li.current_page_item > a {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm-footer .menu li.current_page_item > a:after,
body.stm_header_style_11 .stm-navigation__default > ul > li.current_page_item > a:after {
    opacity: 1;
    bottom: -7px;
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li.current_page_item > a {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner .btn {
    border-color: <?php echo wp_kses_post($third_color); ?> !important;
    color: <?php echo wp_kses_post($third_color); ?> !important;
}
.stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner .btn:hover {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    color: #fff !important;
}

.stm_stories_style_1 .owl-controls .owl-dots {
    display: flex;
    flex-direction: row;
}

.stm_layout_seoagency .stm_testimonials .owl-dots .owl-dot span {
    display: none;
}
.stm_layout_seoagency .stm_testimonials_style_3 .owl-dots .owl-dot {
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_seoagency .stm_iconbox_style_6 {
    padding: 44px 30px;
}

.stm_layout_seoagency .stm_staff_grid_style_3 .btn {
    padding: 15px 30px;
}
.stm_layout_seoagency .stm_staff_grid_style_3 .btn:hover {
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_seoagency .btn.btn_outline.btn_xs {
    padding: 15px 30px;
}
.stm_layout_seoagency .btn_xs {
    padding: 15px 30px;
}
.stm_layout_seoagency .btn.stm_projects_carousel__btn:hover {
    color: #fff !important;
}

.stm_layout_seoagency .overlap_box {
    z-index: 11 !important;
}

.stm_layout_seoagency .stm_project_details_style_4 .stm_project_details__label {
    text-transform: none !important;
}

.quaint_box {
    width: 1270px;
    padding: 0 80px;
    border-radius: 0 78px 0 78px;
    z-index: 12 !important;
}

.overflow_hidden {
    overflow: hidden;
}

.stm_layout_seoagency .stm_services_style_12 .stm_services__content:before {
background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_seoagency .stm_services_style_12 .stm_services__title a:hover {
color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
.stm_layout_seoagency .stm_services_style_12 .stm_services__more_link {
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

.stm_layout_seoagency .color_white .stm_video.stm_video_style_11 .stm_video_title {
color: #fff;
}
.stm_layout_seoagency .color_white .stm_video.stm_video_style_11 .stm_video_title:after {
background-color: #fff !important;
width: 100%;
transition: all 0.3s;
}
.stm_layout_seoagency .color_white .stm_video.stm_video_style_11:hover .stm_video_title:after {
width: 0;
}

.stm_layout_seoagency .stm_cta.style_3 .btn {
padding-right: 46px;
}
.stm_layout_seoagency .stm_cta.style_3 .btn:hover {
background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_seoagency .stm_projects_carousel__tab a.active {
color: #fff !important;
}

.stm_post_type_list_style_2 .stm_post_type_list__content h4,
.stm_testimonials_style_4 .stm_testimonials__info h6,
.stm_layout_seoagency .widget .widgettitle {
    text-transform: none !important;
}

.stm_layout_seoagency .stm_projects_grid__posts .btn.loading span,
.stm_layout_seoagency .stm_projects_grid__posts .btn:hover span,
.stm_layout_seoagency .stm_projects_grid__posts .btn:focus span,
.stm_layout_seoagency .stm_projects_grid__posts .btn:active span,
.stm_layout_seoagency .stm_projects_grid__posts .btn.btn_load:hover:before {
color: #fff !important;
}

.stm_layout_seoagency .stm_pricing-table_style_2 .stm_pricing-table__head h5 {
color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_seoagency .stm_post_type_list_style_3 .stm_post_type_list__content {
padding-right: 15px;
padding-left: 15px;
}

.stm_layout_seoagency .stm_services_text_carousel_style_1 .stm_services_carousel .item .content .excerpt {
margin-bottom: 25px;
}

.stm_layout_seoagency .stm_events_list.stm_events_list_style_1 a .stm_event_single_list__alone .btn:hover,
.stm_layout_seoagency .stm_upcoming_event_style_1 .stm_upcoming_event__actions-button:hover {
color: #fff !important;
}

.stm_layout_seoagency .owl-carousel .owl-nav .owl-prev:before,
.stm_layout_seoagency .owl-carousel .owl-nav .owl-next:before {
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


.stm_layout_seoagency .stm_loop__single_list_style_2 {
margin-bottom: 0 !important;
}
.stm_layout_seoagency .stm_loop__single_grid_style_2 .stm_loop__container, .stm_single_post_style_2 .stm_loop__container {
height: 100%;
}
.stm_layout_seoagency .stm_loop__single_grid_style_2 h5, .stm_single_post_style_2 h5 {
font-weight: 400 !important;
}
.stm_layout_seoagency .stm_read_more_link {
font-weight: 400 !important;
font-size: 14px;
}

.stm_layout_seoagency .stm_carousel_style_1 .stm_carousel__pagination {
bottom: 28px;
}
.stm_layout_seoagency .stm_carousel_style_1 .stm_carousel__pagination .current {
color: #fff !important;
}
.owl-controls .owl-dots .owl-dot.active span {
background-color: <?php echo wp_kses_post($main_color); ?>;
}

.admin-bar .lg-outer.lg-visible {
top: 32px;
}

.home #wrapper {
padding-bottom: 0;
}

.stm-footer .footer-widgets {
padding-bottom: 4px;
}
.stm-footer .menu {
display: flex;
align-items: center;
justify-content: center;
}

.stm_footer_layout_2 .stm-footer__bottom {
border-color: rgba(0,0,0, 0.10) !important;
}
.stm_footer_layout_2 .stm-footer__bottom .stm_markup {
display: flex;
flex-direction: column;
}
.stm_footer_layout_2 .stm-footer__bottom .stm_bottom_copyright {
order: 0;
margin-bottom: 20px;
max-width: none !important;
}
.stm_footer_layout_2 .stm-footer__bottom .stm_bottom_copyright a {
color: inherit !important;
}
.stm_footer_layout_2 .stm-footer__bottom .stm_bottom_copyright a:hover {
text-decoration: none;
color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_footer_layout_2 .stm-footer__bottom .stm-socials {
order: 1;
}

@media (min-width: 1024px)  {
.stm-footer .menu li a,
body.stm_header_style_11 .stm-navigation__default > ul > li > a {
position: relative;
}
.stm-footer .menu li a:after,
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
.stm-footer .menu li a:after {
left: 0;
right: 0;
}
.stm-footer .menu li a:hover:after,
body.stm_header_style_11 .stm-navigation__default > ul > li > a:hover:after {
bottom: -7px;
opacity: 1;
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
}

@media (max-width: 1024px)  {
.stm_layout_seoagency .stm_mobile__logo {
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

.stm_layout_seoagency .stm-footer .footer-widgets aside.widget {
width: 100%;
}
}

@media (max-width: 1023px)  {
.stm_layout_seoagency .stm_mobile__header {
padding-left: 0;
padding-right: 0;
}
body.stm_layout_seoagency .stm_mobile__switcher span {
background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}
body.stm_layout_seoagency .stm-header__row_color_center:before {
background-color: #ffffff !important;
}
body.stm_header_style_11 .stm-navigation__default > ul > li > a {
color: <?php echo wp_kses_post($main_color); ?>;
}
body.stm_layout_seoagency.stm_header_style_11 .stm-navigation__default > ul > li > a:hover {
color: <?php echo wp_kses_post($main_color); ?> !important;
}
body.stm_header_style_11 .stm-navigation__default > ul > li ul.sub-menu {
padding: 5px 0 !important;
}
body.stm_layout_seoagency.stm_header_style_11 .stm-navigation__default .stm_megamenu > ul > li ul.sub-menu li {
margin-bottom: 0 !important;
}
body.stm_layout_seoagency.stm_header_style_11 .stm-navigation__default .stm_megamenu > ul > li ul.sub-menu li a {
padding: 11px 0 !important;
padding-left: 20px !important;
}

.stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner ul li {
padding: 7px 0;
}
.stm_layout_seoagency .stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__back .inner .btn {
padding: 14px 26px;
}

html body.stm_layout_seoagency .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li.current-menu-item > a {
background-color: <?php echo wp_kses_post($main_color); ?> !important;
color: #fff !important;
}

.stm_header_style_1 .stm-navigation.stm-navigation__default ul li.menu-item-has-children>a .stm_mobile__dropdown:after {
border-color: #000 transparent !important;
}
}

@media (max-width: 991px)  {
.mobile-empty-space .vc_column-inner {
margin-left: 0 !important;
padding-right: 15px !important;
padding-left: 15px !important;
}

body.stm_layout_seoagency.stm_header_style_11 .stm_mobile__header {
padding-bottom: 30px;
}
.stm_layout_seoagency .stm_services.stm_services_style_12 .stm_loop__grid {
width: 50%;
}

.stm_layout_seoagency .stm_markup__post .stm_loop__grid .stm_post_type_list__single {
width: 50%;
}

.stm_layout_seoagency .services_price_list_style_1 .services_pills_container {
margin-bottom: 0;
}
.stm_layout_seoagency .services_price_list_style_1 .service__tab {
flex-direction: column;
}

.stm_layout_seoagency .stm_loop__single_list_style_2 .stm_loop__content {
padding: 0 20px;
display: flex;
justify-content: center;
flex-direction: column;
align-items: center;
}
.stm_layout_seoagency .stm_loop__single_list_style_2 .stm_post_details {
margin-bottom: 10px;
}
.stm_layout_seoagency .stm_loop__single_list_style_2 .post_excerpt.stm_mgb_34 {
margin-bottom: 10px;
}

.quaint_box {
margin: 0 15px;
}
}

@media (min-width: 992px) {
.consulting-video-margin-right {
margin-right: 17px;
}
}

@media (max-width: 768px)  {
.stm_layout_seoagency .stm_cta.style_1 {
flex-direction: column;
}
.stm_layout_seoagency .stm_cta.style_1 .stm_cta__content {
width: 100%;
padding-right: 0;
margin-bottom: 32px;
text-align: center;
}
.stm_layout_seoagency .stm_cta.style_1 .stm_cta__link {
margin: 0;
}

.stm_layout_seoagency .vc_col-sm-6:nth-of-type(2n+1) {
clear: none;
}
}

@media (max-width: 767px)  {
.stm-counter.stm-counter_style_9 .stm-counter__value {
    font-size: 38px;
}
.stm-counter.stm-counter_style_9 .stm-counter__label {
    margin-top: 13px;
}
.stm_layout_seoagency .stm_services.stm_services_style_12 .stm_loop__grid {
    width: 100%;
}
.stm_layout_seoagency .stm_markup__post .stm_loop__grid .stm_post_type_list__single {
    width: 100%;
}

.stm_layout_seoagency .wpb_text_column ul li:before {
    margin-right: 9px;
}

.stm_layout_seoagency .wpb_text_column ul li {
display: block !important;
padding-left: 15px;
}

.stm_layout_seoagency.wpb-js-composer .vc_tta.vc_general .vc_tta-panel {
margin-bottom: 2px;
}

.stm-footer .menu {
flex-wrap: wrap;
padding-bottom: 24px;
}
.stm-footer .menu li {
width: 50%;
text-align: center;
margin: 5px 0 !important;
}

.stm_layout_seoagency .stm_loop__single_list_style_2 .stm_loop__content {
padding: 20px;
}
.stm_layout_seoagency.stm_post_style_2 .stm_post_details .post_details {
padding-top: 0;
border-top: 0;
}
}

@media (max-width: 550px)  {
.stm_layout_seoagency.stm_sidebar_style_1 .stm-footer {
padding: 50px 0 15px;
}
.stm-footer .footer-widgets {
padding-bottom: 0;
}
.stm_layout_seoagency .stm-footer .footer-widgets aside.widget {
margin-bottom: 10px;
}

.stm_layout_seoagency .stm_post_details ul {
display: flex;
flex-wrap: wrap;
}
.stm_layout_seoagency .stm_post_details ul li {
margin-right: 15px !important;
}
.stm_layout_seoagency.stm_tabs_style_4 .vc_tta-panels-container .vc_tta-panel .vc_tta-title-text {
font-size: 18px;
}
}