<?php
/*Colors*/
$main_color = pearl_get_option('main_color');
$secondary_color = pearl_get_option('secondary_color');
$third_color = pearl_get_option('third_color');
?>
.services_price_list_style_2.services_price_list_tabs .services_pills_container>ul>li a,
.services_price_list_style_2.services_price_list_list .services_pills_container>ul>li a {
    padding: 18px 25px;
    font-size: 17px;
}

.stm_stories_style_1 .owl-dots .owl-dot {
    display: inline-block;
}
.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__front .inner_flip .stm_projects__meta .inner h5:after,
.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__back .inner_flip .stm_projects__meta .inner h5:after {
    margin: 15px auto !important;
}
.stm_carousel_style_1 .stm_carousel__pagination {
    right: 20px;
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
    .stm-navigation ul li.menu-item-has-children > a .stm_mobile__dropdown:after {
        border-color: #fff transparent !important;
    }
    .stm-navigation li.stm_megamenu li.menu-item-has-children > a .stm_mobile__dropdown:after {
        border-color: <?php echo wp_kses_post($main_color); ?> transparent !important;
    }
}
@media(max-width:550px) {
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