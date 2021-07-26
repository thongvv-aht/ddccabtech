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

.stm_layout_sports_complex.home #wrapper {
    padding-bottom: 0;
}

.stm_layout_sports_complex .stm-header,
body.stm_transparent_header_disabled.stm_title_box_disabled.stm_breadcrumbs_enabled .stm-header {
    margin-bottom: 15px;
}

.stm_layout_sports_complex .stm-button .btn {
    font-size: 16px;
    padding: 14px 36px;
    letter-spacing: -0.5px;
    border-width: 2px;
    <?php if(!empty($secondary_font['name'])): ?>
        font-family: <?php echo esc_attr($secondary_font['name']); ?>;
    <?php endif; ?>
}
.stm-button .btn.btn_secondary:hover,
.stm-button .btn.btn_third:hover {
    border-color: <?php echo wp_kses_post( $secondary_color ); ?>;
    color: <?php echo wp_kses_post( $secondary_color ); ?>;
    background-color: transparent;
}

.stm_testimonials.stm_testimonials_style_12 .owl-stage {
    align-items: flex-start;
}
.stm_testimonials.stm_testimonials_style_12 .stm_testimonials__item {
    padding: 38px 30px;
    margin: 0;
    border-radius: 6px;
    background-color: <?php echo wp_kses_post( $main_color ); ?>;
}
.stm_testimonials.stm_testimonials_style_12 .stm_testimonials__review {
    text-align: left;
    line-height: 30px;
    margin-bottom: 28px;
    font-style: normal;
    font-size: 15px;
    color: #ffffff;
}
.stm_testimonials.stm_testimonials_style_12 .stm_testimonials__meta {
    display: flex;
    align-items: center;
    position: relative;
}
.stm_testimonials.stm_testimonials_style_12 .stm_testimonials__meta:after {
    content: "“";
    position: absolute;
    top: 58px;
    right: 18px;
<?php if(!empty($secondary_font['name'])): ?>
    font-family: <?php echo esc_attr($secondary_font['name']); ?> !important;
<?php endif; ?>
    line-height: 30px;
    font-size: 72px;
    color: <?php echo wp_kses_post( $secondary_color ); ?>;
}
.stm_testimonials.stm_testimonials_style_12 .stm_testimonials__avatar {
    width: 80px;
    margin: 0 15px 0 0;
}
.stm_testimonials.stm_testimonials_style_12 .stm_testimonials__avatar img {
    border: 3px solid #ffffff;
}
.stm_testimonials.stm_testimonials_style_12 .stm_testimonials__info h6 {
    margin-bottom: 0;
<?php if(!empty($secondary_font['name'])): ?>
    font-family: <?php echo esc_attr($secondary_font['name']); ?> !important;
<?php endif; ?>
    color: #ffffff;
}
.stm_testimonials.stm_testimonials_style_12 .owl-controls {
    position: relative;
    top: auto;
    left: auto;
    bottom: auto;
    right: auto;
    padding: 22px 0 0;
    transform: translateX(0);
}
.stm_testimonials.stm_testimonials_style_12 .owl-controls .owl-dots .owl-dot {
    padding: 0;
    width: 10px;
    height: 10px;
    margin: 0 10px;
    border: 0;
    background-color: #ffffff !important;
    border-radius: 50%;
    opacity: 0.3;
}
.stm_testimonials.stm_testimonials_style_12 .owl-controls .owl-dots .owl-dot.active {
    border-color: transparent;
    background-color: #ffffff !important;
    transform: none;
    opacity: 1;
}

.stm_layout_sports_complex .stm_iconbox_style_3 .stm_iconbox__text {
    padding-top: 5px;
}

.stm_layout_sports_complex .stm-counter.stm-counter_style_1 {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    text-align: center;
}
.stm_layout_sports_complex .stm-counter.stm-counter_style_1:before {
    content: "";
    order: 0;
    width: 30px;
    height: 2px;
    margin-right: 10px;
    background-color: <?php echo wp_kses_post( $secondary_color ); ?>;
}
.stm_layout_sports_complex .stm-counter.stm-counter_style_1:after {
    content: "";
    order: 4;
    width: 30px;
    height: 2px;
    margin-left: 10px;
    background-color: <?php echo wp_kses_post( $secondary_color ); ?>;
}
.stm_layout_sports_complex .stm-counter.stm-counter_style_1 .stm-counter__value {
    order: 2;
}
.stm_layout_sports_complex .stm-counter.stm-counter_style_1 .stm-counter__affix {
    order: 1;
}
.stm_layout_sports_complex .stm-counter.stm-counter_style_1 .stm-counter__prefix {
    order: 3;
}
.stm_layout_sports_complex .stm-counter.stm-counter_style_1 .stm-counter__value,
.stm_layout_sports_complex .stm-counter.stm-counter_style_1 .stm-counter__affix,
.stm_layout_sports_complex .stm-counter.stm-counter_style_1 .stm-counter__prefix {
<?php if(!empty($secondary_font['name'])): ?>
    font-family: <?php echo esc_attr($secondary_font['name']); ?> !important;
<?php endif; ?>
    font-size: 40px;
    color: <?php echo wp_kses_post( $secondary_color ); ?> !important;
}

.stm_layout_sports_complex .stm_services_text_carousel_style_1 .stm_services_carousel .item .item_thumbnail {
    position: relative;
    overflow: hidden;
}
.stm_layout_sports_complex .stm_services_text_carousel_style_1 .stm_services_carousel .item .item_thumbnail img {
    position: relative;
    transition: all 0.3s;
}
.stm_layout_sports_complex .stm_services_text_carousel_style_1 .stm_services_carousel .item .item_thumbnail:hover img {
    transform: scale(1.1);
}
.stm_layout_sports_complex .stm_services_text_carousel_style_1 .stm_services_carousel .item .content .excerpt {
    margin-bottom: 20px;
}
.stm_layout_sports_complex .stm_services_text_carousel_style_1 .stm_services_carousel .item .content .stm_read_more_link {
    margin-bottom: 0;
}
.stm_layout_sports_complex .stm_services_style_3 .btn:before,
.stm_layout_sports_complex .stm_services_style_3 .btn:after {
    top: -2px !important;
}

.stm_layout_sports_complex #sb_instagram .sbi_photo {
    position: relative;
    overflow: hidden;
    opacity: 1 !important;
}
.sbi_photo:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transition: all 0.3s;
    visibility: hidden;
    opacity: 0;
    background-color: rgba(0,0,0, 0.4) !important;
}
.sbi_photo:after {
    content: "\d782";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'stmicons';
    transition: all 0.6s;
    visibility: hidden;
    opacity: 0;
    font-size: 50px;
    color: #ffffff;
}
.sbi_photo:hover:before,
.sbi_photo:hover:after {
    visibility: visible;
    opacity: 1;
}

.stm_layout_sports_complex .owl-nav .owl-prev:before,
.stm_layout_sports_complex .owl-nav .owl-next:before {
    color: #ffffff !important;
}
.stm_layout_sports_complex .stm_carousel__pagination .current {
    color: <?php echo wp_kses_post( $secondary_color ); ?> !important;
}

.stm_layout_sports_complex .stm-counter.stm-counter_style_1 .stm-counter__affix,
.stm_layout_sports_complex .stm-counter.stm-counter_style_1 .stm-counter__prefix {
    margin: 5px 0 0;
    position: relative;
    font-weight: 700;
    font-size: 26px;
}

.stm_pagination_style_17 .gmap_addresses .owl-dots .owl-dot.active {
    margin: 8px 4px !important;
}
.stm_layout_sports_complex .stm_testimonials_style_3 .owl-dots .owl-dot.active {
    border-color: <?php echo wp_kses_post( $main_color ); ?> !important;
    background-color: <?php echo wp_kses_post( $main_color ); ?> !important;
}
.stm_layout_sports_complex .stm_testimonials_style_3 .owl-dots .owl-dot span {
    display: none;
}

.stm_layout_sports_complex .stm-counter.stm-counter_style_1 .stm-counter__label {
    flex: 0 0 100%;
    order: 5;
    margin: 0 auto;
    text-transform: none;
    margin-top: 15px;
    font-size: 18px;
<?php if(!empty($secondary_font['name'])): ?>
    font-family: <?php echo esc_attr($secondary_font['name']); ?> !important;
<?php endif; ?>
}

.stm_layout_sports_complex .stm_pricing-table_style_1 {
    background-color: #ffffff;
    border: 1px solid #dddddd;
    padding: 35px 38px;
}
.stm_layout_sports_complex .stm_pricing-table_style_1 .stm_pricing-table__inner {
    display: block;
    text-align: center;
}
.stm_layout_sports_complex .stm_pricing-table_style_1 .stm_pricing-table__head {
    margin-bottom: 32px;
}
.stm_layout_sports_complex .stm_pricing-table_style_1 .stm_pricing-table__head h5 {
    text-transform: uppercase;
    margin-bottom: 24px;
    line-height: 46px;
    font-size: 24px;
}
.stm_layout_sports_complex .stm_pricing-table_style_1 .stm_pricing-table__pricing {
<?php if(!empty($secondary_font['name'])): ?>
    font-family: <?php echo esc_attr($secondary_font['name']); ?> !important;
<?php endif; ?>
}
.stm_layout_sports_complex .stm_pricing-table_style_1 .stm_pricing-table__pricing .stm_pricing-table__prefix {
    margin-right: -8px;
    font-weight: 700;
}
.stm_layout_sports_complex .stm_pricing-table_style_1 .stm_pricing-table__content ul li {
    padding: 0;
}
.stm_layout_sports_complex .stm_pricing-table_style_1 .stm_pricing-table__content ul li:before {
    right: 0;
    left: auto;
    top: 50%;
    margin-top: -7px;
    color: <?php echo wp_kses_post( $secondary_color ); ?> !important;
}
.stm_layout_sports_complex .stm_pricing-table_style_1 .stm_pricing-table__content {
    padding: 0;
    text-align: left;
    font-size: 16px;
}
.stm_layout_sports_complex .stm_pricing-table_style_1 .stm_pricing-table__footer .btn {
    background-color: transparent !important;
    padding: 14px 46px;
    border: 2px solid <?php echo wp_kses_post( $secondary_color ); ?> !important;
<?php if(!empty($secondary_font['name'])): ?>
    font-family: <?php echo esc_attr($secondary_font['name']); ?> !important;
<?php endif; ?>
    font-size: 16px;
    color: <?php echo wp_kses_post( $secondary_color ); ?> !important;
}
.stm_layout_sports_complex .stm_pricing-table_style_1 .stm_pricing-table__footer .btn:hover {
    background-color: <?php echo wp_kses_post( $secondary_color ); ?> !important;
    color: #ffffff !important;
}

.stm_layout_sports_complex .stm_iconbox.stm_iconbox_style_2.text-center .stm_iconbox__icon {
    line-height: 26px;
}
.stm_layout_sports_complex .stm_iconbox.stm_iconbox_style_2.text-center .stm_iconbox__icon,
.stm_layout_sports_complex .stm_iconbox.stm_iconbox_style_2.text-center .stm_iconbox__text {
    display: inline-block;
    vertical-align: top;
}

.stm_loop__list .stm_loop__single h3 {
    color: #fff;
}

.stm_header_style_1 .stm-navigation__default > ul > li > a {
    text-transform: uppercase;
}

.stm-footer {
    background: #f5f5f5;
}
.stm-footer .footer-widgets {
    padding-bottom: 10px;
}
.stm_layout_sports_complex .stm-footer__bottom {
    border-top: 1px solid <?php echo wp_kses_post( $main_color ); ?>;
<?php if(!empty($secondary_font['name'])): ?>
    font-family: <?php echo esc_attr($secondary_font['name']); ?> !important;
<?php endif; ?>
}

.stm_layout_sports_complex.stm_sidebar_style_1 .widget.widget_text img {
    margin: 0 0 30px;
}

.stm-icontext_style2 .stm-icontext__icon {
    min-width: 28px;
    margin-top: 1px;
}

.widget_tp_widget_recent_tweets .tp_recent_tweets ul li:before {
    top: 4px !important;
    color: <?php echo wp_kses_post( $secondary_color ); ?> !important;
}
.widget_tp_widget_recent_tweets .tp_recent_tweets ul li span a {
    color: <?php echo wp_kses_post( $main_color ); ?> !important;
}

.stm_layout_sports_complex .stm_custom_menu_style_1 .menu li {
    line-height: 22px;
    margin-bottom: 16px;
}
.stm_layout_sports_complex .stm_custom_menu_style_1 .menu li a:hover {
    color: <?php echo wp_kses_post( $main_color ); ?> !important;
}
.stm_layout_sports_complex .stm_custom_menu_style_1 .menu li:before {
    top: 6px !important;
}

.stm_layout_sports_complex .stm-socials__icon_filled {
    background-color: <?php echo wp_kses_post( $main_color ); ?> !important;
}
.stm_layout_sports_complex .stm-socials__icon_filled i {
    color: #fff !important;
}
.stm_layout_sports_complex .stm-socials__icon_filled:hover {
    background-color: <?php echo wp_kses_post( $secondary_color ); ?> !important;
}

.stm_layout_sports_complex .stm_single_post_layout_1 {
    padding-top: 50px;
}
.stm_layout_sports_complex.stm_breadcrumbs_enabled .stm_single_post_layout_1 {
    padding-top: 0;
}

@media (max-width: 1024px) {
    .stm_layout_sports_complex .stm_services_text_carousel_style_1 .owl-dots {
        margin-bottom: 24px;
    }
}

@media (max-width: 1023px) {
    .stm_layout_sports_complex.stm_header_style_1 .stm_titlebox {
        margin-top: 0;
    }
    .stm_layout_sports_complex.stm_header_style_1 .stm_mobile__header {
        margin-bottom: 0;
    }
    .stm_layout_sports_complex.stm_header_style_1 .stm-navigation__default > ul > li:hover > a,
    .stm_layout_sports_complex.stm_header_style_1 .stm-navigation__default > ul > li > a:hover {
        color: #ffffff !important;
    }
    html body.stm_layout_sports_complex .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a,
    html body.stm_layout_sports_complex .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a {
        padding: 0 !important;
    }
}

@media (max-width: 767px) {
    .align_center_in_mobile {
        text-align: center !important;
    }

    .stm_layout_sports_complex .no_spaces_in_mobile {
        padding: 0 15px !important;
    }

    .stm_layout_sports_complex .stm_pricing-table_style_1 {
        padding: 35px 15px;
    }
}