<?php
/* Colors */
$main_color = pearl_get_option('main_color');
$secondary_color = pearl_get_option('secondary_color');
$third_color = pearl_get_option('third_color');

/* Fonts */
$fonts = pearl_get_font();
$main_font = $fonts['main'];
$secondary_font = $fonts['secondary'];
?>
<style>
    * {}
    
    .stm_layout_barbershop.home #wrapper {
        padding-bottom: 0;
    }
    .stm_layout_barbershop .pearl_is_sticky.pearl_sticked {
        padding-top: 20px;
    }

    /* font: main */
    p {
        <?php if(!empty($main_font['name'])): ?>
        font-family: <?php echo esc_attr($main_font['name']); ?> !important;
        <?php endif; ?>
    }
    /* font: main */
    /* font: secondary */
    .stm_layout_barbershop .services_price_list_style_2.services_price_list_tabs .services_pills_container > ul > li a,
    .stm_layout_barbershop .services_price_list_style_2 .service__name,
    .stm_layout_barbershop .services_price_list_style_2 .service__cost {
        <?php if(!empty($main_font['name'])): ?>
        font-family: <?php echo esc_attr($secondary_font['name']); ?> !important;
        <?php endif; ?>
    }
    /* font: secondary */


    /* text-color: main-color */
    html body.stm_header_style_11 .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li a:hover,
    .wpcf7-form button.wpcf7-submit.wpcf7-form-control:hover,
    .stm_layout_barbershop .widget.widget-footer ul li a:hover,
    .stm_events_list_style_10 .stm_event_single_list__btn.btn.btn_primary:hover {
        color: <?php echo esc_attr($main_color) ?> !important;
    }
    /* text-color: main-color */
    /* text-color: secondary-color */
    /* text-color: secondary-color */
    /* text-color: third-color */
    body.stm_layout_barbershop table.booked-calendar td:hover .date span,
    body.stm_layout_barbershop table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,
    .stm_layout_barbershop .services_price_list_style_2 .service__badge,
    .stm_icon_links.stm_icon_links_style_1 a:hover i,
    body.stm_layout_barbershop table.booked-calendar thead th .monthName,
    body.stm_layout_barbershop table.booked-calendar thead th .page-right, 
    body.stm_layout_barbershop table.booked-calendar thead th .page-left,
    .stm_events_list_style_10 .stm_event_single_list__btn.btn.btn_primary {
        color: <?php echo esc_attr($third_color) ?> !important;
    }
    /* text-color: third-color */


    /* background-color: main-color */
    body.stm_layout_barbershop table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,
    body.stm_layout_barbershop table.booked-calendar td:hover .date span,
    body.stm_layout_barbershop table.booked-calendar thead th,
    .stm_layout_barbershop .stm_donation__progress-bar,
    .stm_layout_barbershop .services_price_list_style_2 .service__badge,
    .stm_layout_barbershop .stm_video.stm_video_style_3 .stm_playb:after,
    .stm_layout_barbershop .stm_custom_menu_style_1 .menu li:before,
    .stm_layout_barbershop .barbershop_mc4wp_form .btn,
    .stm_icon_links.stm_icon_links_style_1 a:hover {
        background-color: <?php echo esc_attr($main_color) ?> !important;
    }
    /* background-color: main-color */
    /* background-color: secondary-color */
    .stm_layout_taxi .owl-carousel .owl-dot {
        background-color: <?php echo esc_attr($secondary_color) ?> !important;
    }
    /* background-color: secondary-color */
    /* background-color: third-color */
    body.stm_layout_barbershop table.booked-calendar thead .days th,
    .services_price_list_style_1.services_price_list_tabs ul li.active a,
    .services_price_list_style_1 .service__badge,
    .wpcf7-form button.wpcf7-submit.wpcf7-form-control:hover {
        background-color: <?php echo esc_attr($third_color) ?> !important;
    }
    /* background-color: third-color */

    body.stm_layout_barbershop table.booked-calendar .booked-appt-list .timeslot .timeslot-people button {
        border-color: <?php echo esc_attr($main_color) ?> !important;
    }
    .stm_layout_barbershop .services_price_list_style_2,
    .stm_layout_barbershop .services_price_list_style_2.services_price_list_tabs .services_pills_container:before, 
    .stm_layout_barbershop .services_price_list_style_2.services_price_list_tabs .services_pills_container:after, 
    .stm_layout_barbershop .services_price_list_style_2 .service__dots .separator_dots {
        border-color: <?php echo esc_attr($secondary_color) ?> !important;
    }

    .stm_layout_barbershop .stm_video.stm_video_style_3 .stm_playb:before {
        border-left-color: #fff;
    }
    .stm_events_list_style_10 .stm_event_single_list__btn.btn.btn_primary:hover {
        background-color: transparent !important;
    }
    body table.booked-calendar thead th,
    body table.booked-calendar td.today .date span,
    .stm_events_list_style_10 .stm_event_single_list__btn.btn.btn_primary:hover {
        border-color: <?php echo esc_attr($main_color) ?> !important;
    }

    .btn {
        font-size: 12px !important;
    }


    /* header */
    body.stm_layout_barbershop.stm_header_style_11.stm_header_transparent .stm_mobile__header {
        background-color: #111;
        padding: 10px;
    }

    html body.stm_header_style_11 .stm-navigation__default > ul > li > a {
        opacity: .5;
    }
    html body.stm_header_style_11 .stm-navigation__default ul > li > a:hover {
        opacity: 1;
        color: #fff !important;
    }
    
    .stm_layout_barbershop .stm-navigation__line_bottom > ul > li:before,
    .stm_layout_barbershop .stm-navigation__line_bottom > ul > li:hover:before {
        bottom: 0;
        height: 6px !important;
        width: 6px !important;
        left: 50%;
        margin-left: -3px;
        border-radius: 50%;
        opacity: 1;
    }
    html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu {
        top: 100px;
    }
    html body .pearl_sticked .stm-navigation__default ul li.stm_megamenu > ul.sub-menu {
        top: 48px;
    }

    .stm-header__row_color.pearl_is_sticky.pearl_sticked .stm-logo img {
        width: 60px !important;
    }
    
    /* header */

    /* about us */
    .stm_layout_barbershop .stm_sliding_images.style_1 .stm_sliding_image {
        z-index: 10;
    }
    /* about us */

    /* services */
    .stm_layout_barbershop .services_price_list_style_2.services_price_list_tabs .services_pills_container > ul > li.active a:after {
        content: none;
    }
    .stm_layout_barbershop .services_price_list_style_2.services_price_list_tabs .services_pills_container > ul > li a {
        font-size: 36px;
        padding-left: 36px;
        padding-right: 36px;
        text-transform: uppercase;
        font-weight: 500;
    }
    .stm_layout_barbershop .services_price_list_style_2.services_price_list_tabs .services_pills_container > ul > li.active a {
        font-weight: 700;
    }

    .stm_layout_barbershop .services_price_list_style_2 .service__tab.active {
        padding: 17px 30px 35px;
    }
    .stm_layout_barbershop .services_price_list_style_2 .service__tab_item {
        padding: 25px 30px 0;
        position: relative;
        margin-bottom: 22px;
    }

    .stm_layout_barbershop .services_price_list_style_2 .service__badge_container {
        position: absolute;
        top: 7px;
        height: 16px;
        margin-left: 0;
    }
    .stm_layout_barbershop .services_price_list_style_2 .service__badge {
        line-height: 16px;
    }
    .stm_layout_barbershop .services_price_list_style_2 .service__header {
        margin-bottom: 14px;
    }

    .stm_layout_barbershop .services_price_list_style_2 .service__name,
    .stm_layout_barbershop .services_price_list_style_2 .service__cost {
        text-transform: uppercase;
        letter-spacing: 0 !important;
        font-size: 18px;
        line-height: 20px;
        font-weight: bold;
        padding: 0;
    }

    .stm_layout_barbershop .services_price_list_style_2 .service__text {
        line-height: 20px;
        opacity: 0.7;
    }
    /* services */

    /* counters */
    .stm_layout_barbershop .stm-counter_style_6 {
        margin-bottom: 30px;
    }
    .stm_layout_barbershop .stm-counter_style_6 .stm-counter__value,
    .stm_layout_barbershop .stm-counter_style_6 .stm-counter__prefix {
        font-size: 48px;
        line-height: 55px;
        color: #fff !important;
    }
    .stm_layout_barbershop .stm-counter_style_6 .stm-counter__label {
        font-size: 18px;
        line-height: 24px;
        margin: 5px 0 0;
        color: #fff !important;
    }
    /* counters */

    /* instagram feed */
     #sb_instagram .sbi_photo {
        position: relative;
    }
    #sb_instagram .sbi_photo:before {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        content: '';
        display: block;
        opacity: 0;
        background-color: rgba(0,0,0,.5);
        transition: opacity .2s;
    }
    #sb_instagram .sbi_photo:after {
        opacity: 0;
        content: '\f16d';
        font-family: 'FontAwesome';
        font-size: 65px;
        color: #fff;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        transition: opacity .2s;
    }
    #sb_instagram .sbi_photo:hover:before,
    #sb_instagram .sbi_photo:hover:after {
        opacity: 1;
    }
    /* instagram feed */


    /* blog */
    .stm_layout_barbershop .stm_posts_list {
        padding: 0;
        background: none;
    }
    .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single {
        width: 100%;
    }
    .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single__container {
        position: relative;
        height: 456px;
        width: 100%;
        min-height: 132px;
    }
    .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single__image {
        position: relative;
        margin-bottom: 0;
        width: 100%;
        overflow: hidden;
        height: 100%;
    }
    .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single__body {
        position: absolute;
        display: flex;
        flex-direction: column;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        margin: 0;
        justify-content: flex-end;
        padding: 45px 40px;
        background-image: linear-gradient(to bottom, rgba(0, 0, 1, 0.1), #000000);
    }
    .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single .category,
    .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single .read_more,
    .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single__excerpt {
        display: none;
    }
    .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single .title {
        order: 3;
        margin: 0;  
    }
    .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single .title a {
        color: #fff;
        font-size: 24px;
        font-weight: bold;
        text-transform: uppercase;
    }
    .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single .date {
        color: #FFF;
    }
    .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single .date i {
        display: none;
    }

    .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single:hover .stm_posts_list_single__image img {
        transform: scale(1.1);
    }




    .stm_layout_barbershop .stm_posts_list_style_11 .stm_posts_list_single {
        margin-bottom: 30px !important;
        height: 132px;
    }
    .stm_layout_barbershop .stm_posts_list_style_11 .stm_posts_list_single:hover .stm_posts_list_single__image img  {
        transform: scale(1.1);
    } 
    .stm_layout_barbershop .stm_posts_list_style_11 .stm_posts_list_single__image {
        margin-right: 24px;
        overflow: hidden;
    }
    .stm_layout_barbershop .stm_posts_list_style_11 .stm_posts_list_single__body {
        display: flex;
        flex-direction: column;
    }
    .stm_layout_barbershop .stm_posts_list_style_11 .stm_posts_list_single__body h5 {
        font-size: 18px !important;
        text-transform: uppercase;
        line-height: 22px !important;
        margin-bottom: 6px;
        letter-spacing: 0 !important;
    }
    .stm_layout_barbershop .stm_posts_list_style_11 .stm_posts_list_single__info {
        order: -1;
    }
    .stm_layout_barbershop .stm_posts_list_style_11 .stm_posts_list_single__info .date {
        margin-bottom: 6px;
        font-size: 14px;
        line-height: 1;
    }
    .stm_layout_barbershop .stm_posts_list_style_11 .stm_posts_list_single__excerpt {
        height: 63px;
        overflow: hidden;
    }
    .stm_layout_barbershop .stm_posts_list_style_11 .stm_posts_list_single__excerpt p {
        line-height: 21px;
    }
    /* blog */

    /* prefooter */


    .stm_icon_links.stm_icon_links_style_1 a {
        width: 45px;
        height: 45px;
        line-height: 45px;
        font-size: 16px;
        margin-right: 0;
    }
    .stm_icon_links.stm_icon_links_style_1 a + a {
        margin-left: 6px;
    }

    #barbershop_subscribe_form {
        margin-left: auto;
        max-width: 300px;
        width: 100%;
    }
    #barbershop_subscribe_form .stm_mailchimp_wrapper {
        height: 46px;
        position: relative;
    }
    #barbershop_subscribe_form .stm_mailchimp_wrapper input,
    #barbershop_subscribe_form .stm_mailchimp_wrapper input[type="text"],
    #barbershop_subscribe_form .stm_mailchimp_wrapper input[type="email"] {
        background-color: #111;
        height: 100%;
        width: 100%;
        text-align: left;
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
    }
    #barbershop_subscribe_form .stm_mailchimp_wrapper .btn {
        position: absolute;
        width: 35px;
        height: 35px;
        right: 5px;
        top: 5px;
        border-radius: 50%;
        padding: 0;
        text-align: center;
        font-size: 24px !important;
    }
    #barbershop_subscribe_form .mc4wp-response {
        position: absolute;
    }
    #barbershop_subscribe_form .mc4wp-alert {
        margin-top: 10px;
    }

    /* prefooter */

    /* footer */
    .stm_layout_barbershop .stm-footer__bottom {
        
    }
    .stm_layout_barbershop .stm_custom_menu_style_1 .menu li:before {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        content: "";
        top: 50%;
        transform: translate(0, -50%);
    }
    .stm_layout_barbershop.stm_footer_layout_3 .stm-footer__bottom {
        text-align: center;
        padding: 25px 0;
        border-top: 1px solid rgba(255, 255, 255, .1);
        background-color: #111111;
    }
    .stm_layout_barbershop.stm_footer_layout_3 .stm-footer__bottom:before {
        content: none;
    }
    .stm_layout_barbershop.stm_footer_layout_3 .stm-footer__bottom .stm_bottom_copyright {
        margin: 0 auto;
        color: #FFF;
    }
    .stm_layout_barbershop .widget.widget-footer ul li {}
    .stm_layout_barbershop .widget.widget-footer ul li a:hover {}
    /* footer */


    .stm_layout_barbershop .stm_carousel_style_1 .stm_carousel__pagination {
        bottom: 28px;
    }


    .stm_layout_barbershop .stm_sliding_images.style_1 .stm_sliding_image img {
        max-width: 150%;
    }

    .stm_layout_barbershop .stm_video.stm_video_style_3 {
        background-position: center !important;
        background-size: 100%;
    }
    .stm_layout_barbershop .stm_video.stm_video_style_3:hover {
        background-size: 110%;
    }

    .stm_sidebar_style_2 .stm_markup__sidebar_divider .stm-button:before {
        content: none !important;
    }

    @media (max-width: 1199px) {
        .stm_layout_barbershop .stm_posts_list_style_11 .stm_posts_list_single__excerpt {
            height: 64px;
        }
    }
    @media (max-width: 1023px) {
        .stm_layout_barbershop .stm-header,
        .stm_layout_barbershop .stm_mobile__header {
            background-color: #111;
        }
        .stm_layout_barbershop .stm_mobile__header {
            padding: 20px 0 !important;
        }
        .stm_layout_barbershop.home .stm_mobile__header {
            margin-bottom: 0;
        }
        .stm_layout_barbershop .stm-header__element {
            margin-bottom: 0 !important;
        }
        html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu {
            padding-left: 15px !important;
            padding-top: 0 !important;
        }
        body.stm_header_style_11 .stm-navigation__default > ul > li .stm_mobile__dropdown {
            height: 45px !important;
        }
        html body .stm-navigation__default ul li.stm_megamenu .sub-menu > li {
            margin: 0 !important;
        }
        html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li.menu-item-has-children a,
        .stm_layout_barbershop .stm-header a {
            padding: 10px 0 !important;
            line-height: 25px;
        }
        body.stm_layout_barbershop.stm_header_style_11 .stm-navigation__default > ul > li .stm_mobile__dropdown:after {
            border-color: #fff transparent transparent transparent;
        }
        html body.stm_header_style_11 .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li:hover a,
        html body.stm_header_style_11 .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li:hover ul.sub-menu > li > a {
            color: #fff !important;
        }
    }
    @media (max-width: 991px) {
        
    }
    @media (max-width: 767px) {
        #sb_instagram.sbi_col_6 #sbi_images .sbi_item {
            width: 33.333% !important;
        }
        .stm_icon_links.stm_icon_links_style_1 {
            text-align: center;
            margin-top: 20px;
        }
        .stm_layout_barbershop .barbershop_mc4wp_form {
            float: none;
            margin: 0 auto;
        }
        .stm_layout_barbershop .stm_sliding_images.style_1 .stm_sliding_image img {
            max-width: 100%;
        }

        #barbershop_subscribe_form {
            margin-right: auto;
            margin-top: 50px;
        }
    }
    @media (max-width: 575px) {
        #sb_instagram.sbi_col_6 #sbi_images .sbi_item {
            width: 50% !important;
        }
        .stm_layout_barbershop .stm_posts_list_style_17 .stm_posts_list_single__container {
            height: auto;
        }
    }
    @media (max-width: 550px) {
        .stm_posts_list_style_17 .stm_posts_list_single {
            margin-bottom: 0 !important;
        }
        .stm_layout_barbershop .services_price_list_style_2 .service__tab_item {
            padding: 25px 0 0;
        }
    }
    @media (max-width: 480px) {
        .stm_layout_barbershop .stm_posts_list_style_11 .stm_posts_list_single__image {
            float: none;
            width: 100%;
            margin-right: 0;
            margin-bottom: 15px;
            display: block;
        }
        .stm_layout_barbershop .stm_posts_list_style_11 .stm_posts_list_single__image img {
            width: 100%;
        }
        .stm_layout_barbershop .stm_posts_list_style_11 .stm_posts_list_single__excerpt {
            height: auto;
        }
    }


    .stm_layout_barbershop {}
    .stm_layout_barbershop {}

</style>