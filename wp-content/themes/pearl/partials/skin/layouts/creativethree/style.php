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

.btn {
    padding: 12px 36px;
    font-size: 14px;
    line-height: 22px;
    text-transform: none;
}

.stm_layout_creativethree.stm_title_box_style_14 .stm_titlebox_style_14 {
    padding-top: 280px;
    margin-bottom: 0;
}
.stm_layout_creativethree.stm_title_box_style_14 .stm_titlebox__inner .stm_separator {
    display: none;
}

.stm_layout_creativethree.stm_header_transparent .stm-header__row_color:before {
    border-bottom: 1px solid rgba(255,255,255, 0.1);
}
.stm_layout_creativethree.home.stm_header_transparent .stm-header__row_color:before {
    border: 0;
}

.stm_layout_creativethree .stm_mobile__switcher span {
    background: #ffffff !important;
    border-radius: 4px;
    height: 3px;
    width: 25px;
    margin-bottom: 5px;
}
.stm_layout_creativethree .stm_mobile__switcher span:last-child {
    margin-bottom: 0;

}
.stm_layout_creativethree .stm_mobile__switcher.active span:first-child {
    top: 8px;
}
.stm_layout_creativethree .stm_mobile__switcher.active span:last-child {
    top: -8px;
}

.stm_layout_creativethree .stm_post_type_list_style_1 .stm_post_type_list__single {
    display: flex;
    flex-direction: row;
    align-items: center;
}
.stm_layout_creativethree .stm_post_type_list_style_1 .stm_post_type_list__content h4,
.stm_layout_creativethree .stm_post_type_list_style_1 .stm_post_type_list__content .stm_post_type_list__terms {
    color: #ffffff !important;
}
.stm_layout_creativethree .stm_post_type_list_style_1 .stm_post_type_list__single:hover .stm_post_type_list__content h4 {
    color: <?php echo wp_kses_post( $secondary_color ); ?> !important;
}

.stm_layout_creativethree .stm_testimonials_style_4 {
    margin: 0 0 30px;
    background: #111111;
}
.stm_layout_creativethree .stm_testimonials_style_4 .stm_testimonials__review {
    background: transparent;
    padding: 35px 25px 0;
    color: #ffffff;
}
.stm_layout_creativethree .stm_testimonials_style_4 .stm_testimonials__review:before,
.stm_layout_creativethree .stm_testimonials_style_4 .stm_testimonials__review:after {
    display: none;
}
.stm_layout_creativethree .stm_testimonials_style_4 .stm_testimonials__meta_align-center h6 {
    margin-bottom: 10px;
    text-transform: none !important;
    color: #ffffff;
}
.stm_layout_creativethree .stm_testimonials_style_4 .stm_testimonials__meta_align-center {
    padding: 0 25px;
    line-height: 16px;
    color: rgba(255,255,255, 0.5);
}

.stm_layout_creativethree.stm_header_style_1 .stm_mobile__header {
    margin-bottom: 0;
}

.stm_layout_creativethree.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading .vc_tta-panel-title > a {
    border: 0 !important;
    background: rgba(255,255,255, 0.1) !important;
    margin-bottom: 10px;
}
.stm_layout_creativethree.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading .vc_tta-panel-title > a .vc_tta-title-text {
    color: #ffffff;
}
.stm_layout_creativethree.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading .vc_tta-panel-title > a:hover .vc_tta-title-text {
    color: rgba(255,255,255, 0.8) !important;
}
.stm_layout_creativethree.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading .vc_tta-panel-title > a:hover .vc_tta-controls-icon {
    color: rgba(255,255,255, 0.8) !important;
}

#wrapper {
    padding-bottom: 0;
}

.stm_header_transparent .stm_mobile__header {
    position: absolute;
    top: 0;
}

html > body.stm_layout_creativethree.stm_header_style_1 .stm-navigation__hamburger_full > ul {
    position: fixed;
    height: 100vh;
    margin: auto;
    flex-wrap: wrap;
    max-width: 550px;
    justify-content: center;
}
html > body.stm_layout_creativethree.stm_header_style_1 .stm-navigation__hamburger_full > ul > li {
    border-bottom: 1px solid rgba(255,255,255, 0.1);
    text-align: left;
}
html > body.stm_layout_creativethree.stm_header_style_1 .stm-navigation__hamburger_full > ul > li:last-child {
    border-bottom: 0;
}
html > body.stm_layout_creativethree.stm_header_style_1 .stm-navigation__hamburger_full > ul > li > a {
    display: flex;
    padding: 0 !important;
    font-weight: 400;
    font-size: 30px;
}
html > body.stm_layout_creativethree.stm_header_style_1 .stm-navigation__hamburger_full > ul > li > a:before {
    content: "\e97e";
    font-family: 'stmicons' !important;
    position: relative;
    overflow: hidden;
    margin-left: -24px;
    transition: all 0.3s;
    opacity: 0;
    visibility: hidden;
    font-size: 20px;
}
html > body.stm_layout_creativethree.stm_header_style_1 .stm-navigation__hamburger_full > ul > li > a:hover {
    background: transparent;
}
html > body.stm_layout_creativethree.stm_header_style_1 .stm-navigation__hamburger_full > ul > li > a:hover:before {
    margin-right: 14px;
    margin-left: 0;
    opacity: 1;
    visibility: visible;
}
html > body.stm_layout_creativethree.stm_header_style_1.active .site-content {
    -webkit-filter: blur(7px);
    -moz-filter: blur(7px);
    -o-filter: blur(7px);
    -ms-filter: blur(7px);
    filter: blur(7px);
}
html > body.stm_layout_creativethree.stm_header_style_1.active .stm-header .btn {
    display: none;
}

.stm_layout_creativethree.blog .site-content {
    padding-bottom: 100px;
}
.stm_layout_creativethree.blog .site-content .stm_markup__content.stm_markup_right {
    width: 70%;
}
.stm_layout_creativethree.blog .site-content .stm_markup__sidebar {
    width: 30%;
}

.stm_layout_creativethree .stm-counter.stm-counter_style_1 .stm-counter__label {
    color: #ffffff !important;
    text-transform: none;
    margin-top: 0;
    line-height: 1.29;
    font-weight: 400;
    font-size: 14px;
}
.stm_layout_creativethree .stm-counter.stm-counter_style_1 .stm-counter__value,
.stm_layout_creativethree .stm-counter.stm-counter_style_1 .stm-counter__affix,
.stm_layout_creativethree .stm-counter.stm-counter_style_1 .stm-counter__prefix {
    text-transform: uppercase;
    font-weight: 700;
    font-size: 46px;
}

.stm_layout_creativethree .stm_iconbox_style_15 {
    display: block !important;
    border-color: #222222 !important;
}

.stm_layout_creativethree .stm_iconbox_style_15:hover .stm_iconbox__icon i {
    color: #ffffff !important;
}

.stm_layout_creativethree .stm_testimonials_style_24 .stm_testimonials__item {
    max-width: 770px;
    margin: 0 auto;
}
.stm_layout_creativethree .stm_testimonials.white_color .stm_testimonials__review,
.stm_layout_creativethree .stm_testimonials.white_color .stm_testimonials__info h6,
.stm_layout_creativethree .stm_testimonials.white_color .stm_testimonials__info {
    color: #ffffff !important;
}
.stm_layout_creativethree .stm_testimonials.white_color .stm_testimonials__review {
    margin-bottom: 70px;
}
.stm_layout_creativethree .stm_testimonials.white_color .stm_testimonials__review:before {
    content: "\e98e";
    display: block;
    text-align: center;
    margin-bottom: 35px;
    transform: rotate( -180deg );
    font-family: 'stmicons' !important;
    font-size: 40px;
    color: <?php echo wp_kses_post( $secondary_color ); ?> !important;
}
.stm_layout_creativethree .stm_testimonials.white_color .stm_testimonials__info h6 {
    margin-bottom: 4px;
}
.stm_layout_creativethree .stm_testimonials.white_color .stm_testimonials__info {
    font-size: 14px;
}
.stm_layout_creativethree .stm_testimonials_style_24 .image_dots {
    min-height: 72px;
}
.stm_layout_creativethree .stm_testimonials_style_24 .image_dots .dots.active {
    border: 4px solid <?php echo wp_kses_post( $third_color ); ?> !important;
}
.stm_layout_creativethree .stm_testimonials_style_24 .image_dots .dots:after {
    display: none !important;
}
.stm_layout_creativethree .stm_testimonials_style_24 .image_dots .dots.active img {
    margin: 2px;
}

.stm_layout_creativethree .stm_projects_cards_style_6 .stm_projects_cards__filter li {
    text-transform: uppercase;
    padding: 0;
    margin: 0 26px;
}
.stm_layout_creativethree .stm_projects_cards_style_6 .stm_projects_cards__filter li a {
    padding: 10px 0;
}
.stm_layout_creativethree .stm_project_details_style_6 .stm_project_details__single:before {
    top: 13px;
    left: 0;
    background-color: <?php echo wp_kses_post( $secondary_color ); ?>;
}
.stm_layout_creativethree .stm_project_details_style_6 .stm_project_details__single {
    font-size: 13px;
    color: <?php echo wp_kses_post( $secondary_color ); ?>;
}
.stm_layout_creativethree .stm_project_details_style_6 .stm_project_details__value {
    margin: 0;
    font-weight: 700;
    font-size: 16px;
    color: #ffffff;
}
.stm_layout_creativethree .stm_projects_cards_style_6 .stm_projects_cards__filter li.active:after {
    background: <?php echo wp_kses_post( $secondary_color ); ?> !important
}
.stm_layout_creativethree .stm_projects_cards_style_6 .btn {
    text-transform: uppercase;
}

.stm_layout_creativethree .stm_color_presentation_style_1 {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    align-items: center;
    margin: 0;
}
.stm_layout_creativethree .stm_color_presentation_style_1 .stm_color_presentation__color {
    border-radius: 0;
    margin: 0 10px 0 0 !important;
}
.stm_layout_creativethree .stm_color_presentation_style_1 .stm_color_presentation__text {
    margin: 0 10px !important;
    color: #ffffff;
}

.stm_layout_creativethree .stm_projects_carousel .owl-carousel .owl-nav .owl-prev,
.stm_layout_creativethree .stm_projects_carousel .owl-carousel .owl-nav .owl-next {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    border: 0;
    border-radius: 50%;
    background: rgba(255,255,255, 0.1);
}

.stm_layout_creativethree .stm_projects_carousel_dark,
.stm_layout_creativethree .stm_projects_carousel__carousels {
    padding: 0 !important;
    margin: 0 !important;
}

.stm_layout_creativethree .stm_staff_grid_style_3 {
    background: #000000;
}
.stm_layout_creativethree .stm_staff_grid_style_3 .stm_staff__image {
    margin-bottom: 0;
}
.stm_layout_creativethree .stm_staff_grid_style_3 .stm_staff__image:before {
    display: none;
}
.stm_layout_creativethree .stm_staff_grid_style_3 .stm_staff__info {
    padding: 20px;
    background-color: #111111;
}
.stm_layout_creativethree .stm_staff_grid_style_3 .stm_staff__name {
    margin-bottom: 0;
    text-transform: none !important;
    color: #ffffff;
}
.stm_layout_creativethree .stm_staff_grid_style_3 .stm_staff__job {
    font-style: normal;
    margin: 0;
}
.stm_layout_creativethree .stm_staff_grid_style_3 .stm_staff__links {
    display: none;
}

.stm_layout_creativethree .stm_video.stm_video_style_3:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0, 0.5);
    z-index: 1;
}
.stm_layout_creativethree .stm_video.stm_video_style_3 .stm_playb {
    z-index: 10;
}
.stm_layout_creativethree .stm_video.stm_video_style_3 .stm_playb:before {
    border-left-color: #ffffff;
}
.stm_layout_creativethree .stm_video.stm_video_style_3 .stm_playb:after {
    background-color: <?php echo wp_kses_post( $third_color ); ?>;
}

.stm_layout_creativethree.stm_form_style_11 input[type="text"],
.stm_layout_creativethree.stm_form_style_11 input[type="email"],
.stm_layout_creativethree.stm_form_style_11 input[type="search"],
.stm_layout_creativethree.stm_form_style_11 input[type="password"],
.stm_layout_creativethree.stm_form_style_11 input[type="number"],
.stm_layout_creativethree.stm_form_style_11 input[type="date"],
.stm_layout_creativethree.stm_form_style_11 input[type="tel"],
.stm_layout_creativethree.stm_form_style_11 textarea {
    background: rgba(225,225,225, 0.1) !important;
    height: 52px;
    border: 0 !important;
    font-size: 14px;
    color: #ffffff;
}
.stm_layout_creativethree.stm_form_style_11 textarea::placeholder,
.stm_layout_creativethree.stm_form_style_11 input::placeholder {
    color: rgba(255,255,255, 0.5);
}

.stm_layout_creativethree.stm_form_style_11 textarea:-ms-input-placeholder,
.stm_layout_creativethree.stm_form_style_11 input:-ms-input-placeholder {
    color: rgba(255,255,255, 0.5);
}

.stm_layout_creativethree.stm_form_style_11 textarea::-ms-input-placeholder,
.stm_layout_creativethree.stm_form_style_11 input::-ms-input-placeholder {
    color: rgba(255,255,255, 0.5);
}

.stm_layout_creativethree .wpcf7 .stm_select {
    background: rgba(225,225,225, 0.1) !important;
    border: 0 !important;
    color: rgba(255,255,255, 0.5);
}
.stm_layout_creativethree .wpcf7 .stm_select .stm-select__val {
    padding: 13px 10px;
    font-size: 14px;
}
.stm_layout_creativethree .stm_select.open .stm_select__dropdown {
    background-color: #000000;
    border-color: #000000;
    overflow-y: scroll;
    height: 150px;
    min-height: 150px;
}
.stm_layout_creativethree .stm_select.open .stm_select__dropdown li span:hover {
    background-color: <?php echo wp_kses_post( $secondary_color ); ?>;
    color: #ffffff;
}

.stm_layout_creativethree .stm_iconbox_style_2 {
    display: flex;
    align-items: center;
    padding: 0;
}
.stm_layout_creativethree .stm_iconbox_style_2 .stm_iconbox__text h5 {
    margin-bottom: 4px;
}
.stm_layout_creativethree .stm_iconbox_style_2 .stm_iconbox__icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 50px;
    background-color: <?php echo wp_kses_post( $secondary_color ); ?>;
    margin: 0 20px 0 0;
}

.stm_layout_creativethree.stm_footer_layout_2 .stm-footer {
    padding-top: 40px;
    border-top: 1px solid rgba(225,225,225, 0.1);
}
.stm_layout_creativethree.stm_footer_layout_2 .stm-footer .footer-widgets {
    padding-bottom: 0;
}
.stm_layout_creativethree.stm_footer_layout_2 .stm-footer .footer-widgets .widget {
    margin-bottom: 0;
}
.stm_layout_creativethree.stm_footer_layout_2 .stm-footer__bottom {
    border: 0;
    padding: 20px 0 30px;
}
.stm_layout_creativethree.stm_footer_layout_2 .stm_custom_menu_style_1 .menu {
    text-align: center;
}
.stm_layout_creativethree.stm_footer_layout_2 .stm_custom_menu_style_1 .menu li {
    display: inline-block;
    padding: 0 15px !important;
    margin-bottom: 0;
    font-size: 14px;
}
.stm_layout_creativethree.stm_footer_layout_2 .stm_custom_menu_style_1 .menu li:before {
    display: none;
}
.stm_layout_creativethree.stm_footer_layout_2 .stm-footer__bottom .stm_markup {
    flex-direction: column;
}
.stm_layout_creativethree.stm_footer_layout_2 .stm-socials {
    margin-bottom: 40px;
}
.stm_layout_creativethree.stm_footer_layout_2 .stm-socials a {
    display: inline-block;
    vertical-align: top;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    border-radius: 50%;
    background-color: rgba(225,225,225, 0.1);
    color: #ffffff !important;
}
.stm_layout_creativethree.stm_footer_layout_2 .stm-footer__bottom .stm-socials__icon:hover {
    background-color: rgba(225,225,225, 0.4) !important;
}
.stm_layout_creativethree.stm_footer_layout_2 .stm-socials a i {
    color: #ffffff !important;
}
.stm_layout_creativethree.stm_footer_layout_2 .stm-footer__bottom .stm_bottom_copyright {
    max-width: none;
    color: inherit;
}

.stm_layout_creativethree .text-center > .wpcf7-submit {
    margin: 0 auto !important;
}

.stm_layout_creativethree .wpb_text_column ul li:before {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: <?php echo wp_kses_post( $secondary_color ); ?> !important;
}

.stm_layout_creativethree .stm-footer .stm-socials a {
    width: 45px;
    height: 45px;
    line-height: 45px;
}
.stm_layout_creativethree .stm_custom_heading__side {
    display: block;
}
.stm_layout_creativethree .stm_custom_heading__side .stm_custom_heading__side_line {
    display: block;
    margin: 10px 0 0;
    width: 40px;
    height: 4px;
    background: <?php echo wp_kses_post( $secondary_color ); ?> !important;
}

.stm_layout_creativethree .stm_post__actions {
    margin-bottom: 0 !important;
}

.stm_layout_creativethree.stm_pagination_style_5 ul.page-numbers li {
    margin: 0 5px;
}
.stm_layout_creativethree.stm_pagination_style_5 ul.page-numbers li a,
.stm_layout_creativethree.stm_pagination_style_5 ul.page-numbers li span {
    width: 45px;
    height: 45px;
    line-height: 42px;
    font-weight: 400;
    font-size: 14px;
    color: #ffffff !important;
}
.stm_layout_creativethree.stm_pagination_style_5 ul.page-numbers li.stm_page_num .page-numbers.current {
    border-color: <?php echo wp_kses_post( $secondary_color ); ?> !important;
    background: <?php echo wp_kses_post( $secondary_color ); ?> !important;
    font-weight: 700;
}

@media (max-width: 1199px) {
    .stm_layout_creativethree .stm_projects_carousel .owl-carousel .owl-nav {
        display: none !important;
    }
}

@media (max-width: 1024px) {
    .stm_layout_creativethree .stm-footer .footer-widgets aside.widget {
        width: 100%;
    }
    h1 {
        font-size: 56px !important;
        line-height: 66px !important;
    }
}

@media (max-width: 1023px) {
    .stm_layout_creativethree.stm_header_transparent .stm-header {
        position: absolute;
        top: 0;
        left: 0;
        height: 100px;
        box-shadow: none !important;
        background-color: transparent !important;
        width: auto;
    }
    .stm_layout_creativethree.stm_header_transparent .stm-header.active {
        height: auto;
    }
    .stm_layout_creativethree.stm_header_style_1 .stm-logo {
        display: block !important;
    }
    .stm_layout_creativethree.stm_header_transparent .stm-header .btn {
        display: none;
    }
    .stm_layout_creativethree.stm_header_transparent .stm_mobile__header {
        width: 100%;
    }
    .stm_layout_creativethree.stm_header_transparent .stm_mobile__header .container > div {
        justify-content: flex-end;
    }

}

@media (max-width: 991px) {
    .stm_layout_creativethree .stm-header.active .stm-navigation_hamburger_full > ul {
        margin: 0 auto !important;
        padding: 0 10%;
    }
    .stm_layout_creativethree .stm-header__overlay {
        background-color: rgba(0,0,0, 0.7) !important;
    }
    .mobile_align_center {
        text-align: center !important;
        margin: 0 auto !important;
    }

    .mobile-empty-space .vc_column-inner {
        margin-left: 0 !important;
        padding-right: 15px !important;
        padding-left: 15px !important;
    }

    .mobile-empty-space.mobile-empty-space-inner {
        padding-right: 30px !important;
        padding-left: 30px !important;
    }

    .stm_layout_creativethree .stm-counter.stm-counter_style_1 {
        text-align: center;
    }

    .stm_layout_creativethree.stm_title_box_style_14 .stm_titlebox_style_14 {
        padding-top: 180px;
        padding-bottom: 40px;
    }

    .stm_layout_creativethree .stm_single_stm_services .container-fluid {
        background-size: cover !important;
    }

}

@media (max-width: 768px) {
    h1 {
        font-size: 42px !important;
    }
    .vc_col-sm-6:nth-of-type(2n+1) {
        clear: none !important;
    }

    .stm_layout_creativethree .stm_testimonials_style_24 .image_dots .dots {
        margin: 5px 10px;
    }

    .stm_layout_creativethree .stm_testimonials_style_24 .stm_testimonials__item {
        padding: 0 15px;
    }

    .stm_layout_creativethree .stm_iconbox_style_15 {
        margin: 0;
    }
}

@media (max-width: 550px) {
    .stm_layout_creativethree .stm_color_presentation_style_1 {
        flex-direction: column;
    }
    .stm_layout_creativethree .stm_color_presentation_style_1 .stm_color_presentation__color {
        width: 80px;
        height: 80px;
        margin: 0 0 10px !important;
    }

    .stm_layout_creativethree .stm_projects_cards_style_6 .stm_projects_cards__filter li:after {
        bottom: -2px;
    }

    .stm_layout_creativethree.stm_title_box_style_14 .stm_titlebox_style_14 {
        padding-top: 180px !important;
        padding-bottom: 0px !important;
        text-align: center;
    }
    .stm_layout_creativethree.stm_title_box_style_14 .stm_titlebox_style_14 .stm_titlebox__title {
        text-align: center;
    }

    .stm_layout_creativethree .stm_video_style_3 {
        height: 300px !important;
    }

    .stm_layout_creativethree .stm_lazyload_image {
        background-color: #000000;
    }
}