<?php
/* Colors */
$main_color=pearl_get_option('main_color');
$secondary_color=pearl_get_option('secondary_color');
$third_color=pearl_get_option('third_color');

/* Fonts */
$fonts=pearl_get_font();
$main_font=$fonts['main'];
$secondary_font=$fonts['secondary'];

?>
<style>
    * {}

    a {
        color: #fff;
    }
    p {
        <?php if( !empty($main_font['name'])): ?> 
        font-family: <?php echo esc_attr($main_font['name']);?> !important;
        <?php endif;?>
    }
    /* font: main */

    
    /* font: secondary */
    .stm_pricing-table_style_11 .stm_pricing-table__head,
    .wpb_image_grid .isotope-item a:after,
    .stm-counter_style_14 {
        <?php if( !empty($main_font['name'])): ?> 
        font-family: <?php echo esc_attr($secondary_font['name']);?> !important;
        <?php endif;?>
    }
    /* font: secondary */

   
    /* text-color: main-color */
    .stm_layout_gym .stm_donation_style_1 .stm_donation__title h5 a:hover,
    .stm_layout_gym .stm_donation_style_2 .stm_donation__title h5 a:hover,
    .stm_loop__list h3 span,
    .stm_staff_container_list .stm_staff_list_style_2 .stm_staff__contacts .stm_staff__contact i,
    .stm_staff_container_list .stm_staff_list_style_2 .stm_staff__contacts .stm_staff__contact a,
    .stm_iconbox_style_4 .stm_iconbox__text h5,
    .stm_testimonials.stm_testimonials_style_24:before,
    .stm_pricing-table_style_11 .stm_pricing-table__content ul li:before,
    .stm_buttons_style_24 .btn,
    .stm_widget_posts.style_1 ul li .stm_widget_posts__title:hover {
        color: <?php echo esc_attr($main_color) ?> !important;
    }
    /* text-color: main-color */


    /* text-color: secondary-color */
    .table.table-striped>tbody>tr td:first-child,
    .stm_vacancies_style_3 .stm_details .info .stm_details__value,
    .stm_staff_list_style_4 .stm_staff__info,
    .stm_staff_list_style_4 .stm_staff__name,
    .stm_staff_grid_style_4 .stm_staff__name,
    .stm_staff_grid_style_4 .stm_staff__job,
    .stm_staff_container_grid.style_5 .stm_staff__name,
    .stm_staff_container_grid.style_6 .stm_staff__name,
    .stm_layout_gym .stm_testimonials_style_1 .stm_testimonials__review,
    .stm_layout_gym .stm_testimonials_style_2 .stm_testimonials__info h6,
    .stm_layout_gym .stm_posttimeline_style_2 .stm_posttimeline__year span,
    .stm_layout_gym .stm_testimonials_style_5 .stm_testimonials__review,
    .stm_layout_gym .stm_donation_style_1 .stm_donation__title h5 a,
    .stm_layout_gym .stm_donation_style_1 .stm_donation__donated-info,
    .stm_layout_gym .stm_donation_style_2 .stm_donation__title h5 a,
    .stm_layout_gym .stm_donation_style_2 .stm_donation__donated-info,
    .stm_layout_gym .stm_staff_container_list .stm_staff_list_style_2 .stm_staff__socials a:hover i {
        color: <?php echo esc_attr($secondary_color) ?> !important;
    }
    /* text-color: secondary-color */

    /* text-color: third-color */
    .stm_posttimeline_style_2 .stm_posttimeline__post_title h5 {
        color: <?php echo esc_attr($third_color) ?> !important;
    }
    /* text-color: third-color */

    /* background-color: main-color */
    .stm_post__tags a:hover,
    .owl-carousel .owl-dots .owl-dot.active span,
    .stm_staff_container_grid.style_10 .stm_staff:hover,
    .stm_staff_grid_style_1 .stm_staff__name:before,
    .stm_headings_line h1:before,
    .stm_headings_line h1:after,
    .stm_headings_line h2:before,
    .stm_headings_line h2:after,
    .stm_headings_line h3:before,
    .stm_headings_line h3:after,
    .stm_headings_line h4:before,
    .stm_headings_line h4:after,
    .stm_headings_line h5:before,
    .stm_headings_line h5:after,
    .stm_headings_line h6:before,
    .stm_headings_line h6:after,
    .stm_gmap_wrapper.style_1 .gmap_addresses:before,
    .stm_footer_layout_4 .stm-footer .stm-socials a:hover,
    .wpb_image_grid .isotope-item a:before {
        background-color: <?php echo esc_attr($main_color) ?> !important;
    }
    /* background-color: main-color */
    /* background-color: secondary-color */
    .stm_post__tags a,
    .vc_tta-panel .vc_tta-panel-title>a,
    .stm_single_stm_events .stm_markup__content .stm_single_event__form,
    .stm_blockquote_style_3 blockquote,
    .stm_author_box,
    .stm_post_comments .comment-form,
    .stm-counter_style_14,
    .stm_staff_container_grid.style_10 .stm_staff,
    .stm_pricing-table_style_11:hover:before,
    .stm_footer_layout_4 .stm-footer .stm-socials a {
        background-color: <?php echo esc_attr($secondary_color) ?> !important;
    }
    .stm_staff_container_list .stm_staff_list_style_2 .stm_staff__socials a i {
        background-color: <?php echo esc_attr($secondary_color) ?>;
    }
    /* background-color: secondary-color */
    /* background-color: third-color */
    .stm_staff_list_style_6 {
        background-color: <?php echo esc_attr($third_color) ?> !important;
    }

    /* background-color: third-color */

    .stm_donation_style_2 .stm_donation__details-wrapper {
        background: #fff;
    }

    .stm_post__tags a,
    .table.table-striped>tbody>tr:nth-of-type(even) td,
    .stm_staff_list_style_6 .stm_staff__info .stm_staff__job,
    .stm_single_stm_events .stm_markup__content .stm_single_event__categories i,
    .stm_single_donation_style_1 .stm_post_info>ul li i,
    .stm_pagination_style_16 .page-numbers.current,
    ul.page-numbers li.stm_page_num a,
    ul.page-numbers .page-numbers,
    ul.comment-list .comment .comment-author,
    .stm_layout_gym .services_price_list_style_1 .services_pills_container > ul > li a,
    .stm_layout_gym .services_price_list_style_2.services_price_list_tabs .services_pills_container > ul > li.active a, 
    .stm_layout_gym .services_price_list_style_2.services_price_list_list .services_pills_container > ul > li.active a,
    .stm_layout_gym .services_price_list_style_2 .service__text,
    .stm_layout_gym .services_price_list_style_3.services_price_list_tabs .services_pills_container > ul > li.active a,
    .stm_layout_gym .services_price_list_style_3.services_price_list_list .services_pills_container > ul > li.active a,
    .stm_layout_gym .stm_schedule_style_1 .event_lesson_tabs a span,
    .stm_layout_gym .stm_schedule_style_1 .event_lesson_info_time_loc,
    .stm_layout_gym .stm_schedule_style_1 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_info_title,
    .stm_layout_gym .stm_schedule_style_1 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_info_description,
    .stm_layout_gym .stm_schedule_style_1 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_speakers li .event_speaker_content .event_speaker_description,
    .stm_layout_gym .stm_testimonials_style_2 .stm_testimonials__info h6,
    .stm_layout_gym .stm_opening_hours_table_style_1 .day .icon i,
    .stm_layout_gym .stm_opening_hours_table_style_1 .day > div,
    .stm_layout_gym .stm_projects_carousel__tab a,
    .stm_layout_gym .stm_widget_posts.style_1 ul li .stm_widget_posts__title,
    .stm_layout_gym .stm_projects_grid__posts .btn.btn_primary.btn_outline.btn_load:hover span {
        color: #fff !important;
    }

    @media (max-width: 1023px) {

        html body.stm_layout_gym ul li.stm_megamenu > ul.sub-menu > li > a {
            color: #fff !important;
        }
        html body.stm_layout_gym ul li.stm_megamenu > ul.sub-menu > li.current_page_item > a,
        html body.stm_layout_gym ul li.stm_megamenu > ul.sub-menu > li.active > a {
            color: <?php echo esc_attr($main_color) ?> !important;
        }
    }

    
    .stm_layout_gym .stm_post_details span, 
    .stm_layout_gym .stm_page_bc .stm_breadcrumbs {
        color: rgba(255, 255, 255, 0.5) !important;
    }
    .stm_layout_gym .stm_page_bc .stm_breadcrumbs, 
    .stm_layout_gym .stm_post_details .post_details {
        border-color: rgba(255, 255, 255, .1) !important;
    }


    body {
        background-color: #2c2d33;
    }

    .home #wrapper {
        max-width: 1720px;
        margin: 0 auto;
    }

    

    /* header */
    .stm-header {
        background-color: #2c2d33;
        padding-right: 100px;
        padding-left: 100px;
    }
    .home .stm-header {
        margin-bottom: 0;
    }
    .stm-header .stm-navigation__default > ul > li a {
        text-transform: uppercase;
        letter-spacing: .6px;
        position: relative;
    }
    .stm_megamenu {}
    @media (min-width: 1024px) {
        html body.stm_layout_gym .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li.menu-item-has-children > a, 
        html body.stm_layout_gym .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li.menu-item-has-children > a {
            padding-top: 0 !important;
        }
    }
    @media (max-width: 1800px) {
        .stm-header {
            padding-left: 40px;
            padding-right: 40px;
        }
    }
    @media (max-width: 1023px) {
        .stm-header {
            padding-left: 0;
            padding-right: 0;
        }

        .stm-header__cell {
            margin-bottom: 100px;
        }

        body.stm_header_style_11 .stm-navigation__default > ul > li .stm_mobile__dropdown:after {
            border-color: #fff transparent !important;
        }
    }
    /* header */
    
    /* infobox */
    .stm_infobox_style_15 {
        border-right: 1px solid rgba(255,255,255,.1);
    }
    @media (max-width: 767px) {
        .stm_infobox_style_15 {
            border-right: none;
            border-top: 1px solid rgba(255,255,255,.1);
        }
    }
    /* infobox */

    /* partners */
    .stm_layout_gym .stm_partners_style_3 .stm_partners__single {
        opacity: .3;
        filter: brightness(0) invert(1) !important;
    }
    @media (max-width: 550px) {
        .stm_partners_style_3 .stm_partners__single {
            flex: 0 1 50% !important;
        }
    }

    .stm_partners_style_1 .stm_partners__single .stm_partners__image, 
    .stm_partners_style_2 .stm_partners__single .stm_partners__image {
        background-color: #fff;
    }

    /* partners */

    /* pricing tables */
    .stm_pricing-table_style_11 .stm_pricing-table__pricing {
        color: #fff !important;
    }
    .stm_pricing-table_style_11 .stm_pricing-table__footer .btn {
        border-color: <?php echo esc_attr($main_color) ?> !important;
        color: <?php echo esc_attr($main_color) ?> !important;
    }
    .stm_pricing-table_style_11 .stm_pricing-table__footer .btn:hover {
        background-color: <?php echo esc_attr($main_color) ?> !important;
        color: #fff !important;
    }
    .stm_pricing-table_style_11 .stm_pricing-table__content {}
    .stm_pricing-table_style_11 .stm_pricing-table__content ul {
        list-style-type: none;
    }
    .stm_pricing-table_style_11 .stm_pricing-table__content ul li {
        position: relative;
        padding-left: 17px;
    }
    .stm_pricing-table_style_11 .stm_pricing-table__content ul li:before {
        content: '•';
        position: absolute;
        left: 0;
        top: 0 !important;
    }


    .stm_pricing-table_style_1 .stm_pricing-table__head h5,
    .stm_pricing-table_style_1 .stm_pricing-table__content ul li,
    .stm_pricing-table_style_2 .stm_pricing-table__head h5,
    .stm_pricing-table_style_2 .stm_pricing-table__content ul li,
    .stm_pricing-table_style_4.has-label .stm_pricing-table__head h5,
    .stm_pricing-table_style_4.has-label .stm_pricing-table__content ul li {
        color: #000 !important;
    }
    /* pricing tables */

    /* gallery */
    .wpb_image_grid .wpb_image_grid_ul {
        display: grid;
    }
    .wpb_image_grid .wpb_image_grid_ul .isotope-item {
        width: 20%;
        margin: 0;
    }
    .wpb_image_grid .isotope-item a {
        filter: grayscale(1);
        transition: all .3s;
    }
    .wpb_image_grid .isotope-item a:hover {
        filter: grayscale(0);
    }
    .wpb_image_grid .isotope-item a:before {
        transition: inherit;
        position: absolute;
        height: 100%;
        width: 100%;
        content: '';
        opacity: 0;
        z-index: 1;
    }
    .wpb_image_grid .isotope-item a:after {
        transition: inherit;
        content: '+';
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        color: #fff;
        font-size: 100px;
        font-weight: 300;
        z-index: 2;
    }
    .wpb_image_grid .isotope-item a:hover:before {
        opacity: .5;
    }
    .wpb_image_grid .isotope-item a:hover:after {
        opacity: 1;
    }
    .wpb_image_grid .wpb_image_grid_ul img {
        width: 100%;
    }
    @media (max-width: 767px) {
        .wpb_image_grid .wpb_image_grid_ul .isotope-item {
            width: 25%;
        }
    }
    @media (min-width: 576px) and (max-width: 767px) {
        .wpb_image_grid .wpb_image_grid_ul .isotope-item:nth-child(n+9) {
            display: none;
        }
    }
    @media (max-width: 575px) {
        .wpb_image_grid .wpb_image_grid_ul .isotope-item {
            width: 33.3%;
        }
        .wpb_image_grid .wpb_image_grid_ul .isotope-item:nth-child(n+10) {
            display: none;
        }
    }
    /* gallery */

    /* gym_contact_form */
   #gym_contact_form {
       margin: 0 15%;
   }
   #gym_contact_form .contact-form-field {}
   #gym_contact_form textarea {
       min-height: 120px !important;
   }
   #gym_contact_form {}
    /* gym_contact_form */


    /* testimonials */
    .stm_testimonials.stm_testimonials_style_24 {
        margin: 0 15%;
        max-width: 910px;
    }
    .stm_testimonials.stm_testimonials_style_24:before {
        content: "\e9007";
        font-family: "stmicons";
        text-align: center;
        font-size: 52px;
        display: block;
        margin-bottom: 45px;
    }
    .stm_testimonials_style_24 .image_dots .dots:after {
        border-color: <?php echo esc_attr($main_color) ?> !important;
    }
    .stm_testimonials_style_24 .image_dots .dots.active img,
    .stm_testimonials_style_24 .image_dots .dots.active:hover img {
        padding: 4px !important;
    }

    @media (max-width: 992px) {
        .stm_testimonials.stm_testimonials_style_24 {
            margin: 0 20px;
            max-width: 100%;
        }
    }


    .stm_testimonials_style_4 .stm_testimonials__review {
        color: #000;
    }
    /* testimonials */

    /* contact form */
    .stm_layout_gym.stm_form_style_17 select, 
    .stm_layout_gym.stm_form_style_17 .stm_select, 
    .stm_layout_gym.stm_form_style_17 input[type="text"], 
    .stm_layout_gym.stm_form_style_17 input[type="email"], 
    .stm_layout_gym.stm_form_style_17 input[type="password"], 
    .stm_layout_gym.stm_form_style_17 input[type="number"], 
    .stm_layout_gym.stm_form_style_17 input[type="date"], 
    .stm_layout_gym.stm_form_style_17 input[type="tel"], 
    .stm_layout_gym.stm_form_style_17 textarea, 
    .stm_layout_gym.stm_form_style_17 .stm_select .form-control {
        background-color: #2c2d33 !important;
    }
    /* contact form */

    /* owl carousel styles */
    .owl-carousel .owl-nav .owl-prev, 
    .owl-carousel .owl-nav .owl-next {
        border: none;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, .1);
        height: 50px;
        width: 50px;
    }
    .owl-carousel .owl-nav .owl-prev:before, 
    .owl-carousel .owl-nav .owl-next:before {
        line-height: 50px;
        font-family: 'stmicons';
    }
    .owl-carousel .owl-nav .owl-prev:before {
        content: "\ebb2" !important;
    }
    .owl-carousel .owl-nav .owl-next:before {
        content: "\ebb4" !important;
    }

    .owl-carousel .owl-dots {
        display: flex;
    }    
    /* owl carousel styles */

    /* footer */
    .stm_layout_gym.stm_footer_layout_4 .stm-footer {
        border: none;
        padding-bottom: 30px !important;
    }
    
    .stm_layout_gym.stm_footer_layout_4 .stm-footer .footer-widgets {
        padding-bottom: 30px;
    }
    .stm_layout_gym.stm_footer_layout_4 .stm-footer .widget_nav_menu {
        margin: 0;
    }
    .stm_layout_gym.stm_footer_layout_4 .stm-footer .widget_nav_menu .menu {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        text-transform: uppercase;
    }
    .stm_layout_gym.stm_footer_layout_4 .stm-footer .widget_nav_menu .menu li {
        padding: 0 15px;
        letter-spacing: .6px;
    }
    .stm_footer_layout_4 .stm-footer .stm-socials a .fa {
        color: #fff !important;
    }
    @media (max-width: 1024px) {
        .stm-footer .footer-widgets aside.widget {
            width: 100%;
        }
    }
    @media (max-width: 768px) {
        .stm-footer .footer-widgets aside.widget {
            width: 100%;
        }
        .stm_layout_gym.stm_footer_layout_4 .stm-footer .widget_nav_menu .menu {
            flex-direction: column;
            align-items: center;
        }
    }
    /* footer */

    
    .stm_layout_gym .stm_staff_grid_style_3 .btn {
        padding: 14px 40px;
    }

    .stm_widget_search.style_1 .widget.widget_search .search-form input[name="s"] {
        background-color: rgba(255, 255, 255, 0.05) !important;
        color: #fff !important;
    }

    .wpb_text_column ul li {display: block !important;}

    .stm_linear_repeater {
        background: repeating-linear-gradient(135deg,rgba(255,255,255,.1) 5px,rgba(255,255,255,.1) 10px,transparent 10px,transparent 15px);
    }

    @media (max-width: 550px) {
        .stm_staff_list_style_4 .stm_staff__info {
            padding-left: 30px;
        }
    }

    /* post single page */
    .stm_layout_gym .stm_post_comments .comment-form {
        padding: 20px 20px 1px;
    }
    .stm_layout_gym.stm_form_style_17 .form-group textarea {
        border-radius: 0;
    }
    .stm_layout_gym ul.comment-list > li,
    .stm_layout_gym ul.comment-list .children > li {
        border-color: rgba(255, 255, 255, .1) !important;
    }
    .stm_layout_gym ul.comment-list .comment .comment-meta {
        margin-bottom: 6px;
    }
    .stm_layout_gym ul.comment-list .comment .comment-text p {
        line-height: 1.4;
    }
    /* post single page */
</style>