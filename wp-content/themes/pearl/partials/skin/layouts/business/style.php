
body.stm_layout_business .booked-calendar-wrap .booked-appt-list .timeslot.timeslot-unavailable .timeslot-range{
    padding-top: 39px;
}

.upcoming .container .wpb_wrapper {
    color: #fff;
}

body .btn.btn_outline.btn_third:hover>i{
    color: #fff !important;
}

.stm_gmap_wrapper .owl-dots .owl-dot {
    position: relative;
    width: 4px;
    height: 4px;
    border-radius: 50%;
    transform: scale(1);
}

.stm_gmap_wrapper .owl-dots .owl-dot:before {
    content: "";
    position: absolute;
    top: -8px;
    left: -8px;
    display: block;
    opacity: 0;
    width: 16px;
    height: 16px;
    z-index: 20;
}

.stm_gmap_wrapper .owl-dots .owl-dot.active:before {
    transform: scale(0.5);
}

.stm_gmap_wrapper.style_1 .gmap_addresses .owl-dots-wr .owl-dots .owl-dot {
    margin-bottom: 35px;
}

.stm_gmap_wrapper .owl-dots .owl-dot.active {
    transform: scale(2);
}

.stm_gmap_wrapper.style_1 .gmap_addresses:before {
    opacity: 1;
}

html body .stm-navigation__default ul li.stm_megamenu .stm_megaicon {
    position: relative;
    top: 2px;
}

strong {
    font-weight: 600;
}

.stm-navigation__default>ul>li ul li>a {
    font-weight: 600;
}

.stm-footer {
    padding-top: 0 !important;
}

.stm-footer > .container {
    padding-top: 67px !important;
}

.stm-footer > .container.footer_widgets_count_0 {
    padding-top: 0 !important;
}

.stm-footer__bottom .stm_markup {
    align-items: center;
}

.heading_font {
    font-weight: 600;
}

.stm_projects_carousel__name {
    letter-spacing: 0;
    text-transform: none;
    font-size: 18px;
    line-height: 1.2em;
}
.stm_projects_carousel__item .stm_projects_carousel__btn {
    padding: 8px 15px;
    font-size: 14px;
}
.wpb_revslider_element.wpb_content_element {
    min-height: 300px;
    background: #23282d;
}
.wc-tab .comment-reply-title {
    font-weight: 700;
}


.stm_post_details{
    padding: 15px;
}
.stm_post_details .comments_num a i{
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

@media (max-width: 1023px) {
    .stm_layout_business.stm_header_style_1 .stm_titlebox {
        margin-top: 50px;
    }
}

@media(max-width:550px) {
    .stm_layout_business.stm_header_style_1 .stm_titlebox {
        margin-top: 0;
    }

    .stm_gmap_wrapper.style_1 .gmap_addresses .owl-dots-wr .owl-dots .owl-dot {
        margin-bottom: 15px;
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

    .stm-footer__bottom .stm_bottom_copyright {
        margin: 15px 0;
    }
    .stm-footer__bottom .stm_markup__sidebar {
        margin: 15px 0;
    }
}
