<?php
/*Default layout styles*/
$default = pearl_get_layout_config();

$main_font = $fonts['main'];
$secondary_font = $fonts['secondary'];

/*Colors*/
$main_color = pearl_get_option('main_color', $default['main_color']);
$secondary_color = pearl_get_option('secondary_color', $default['secondary_color']);
$third_color = pearl_get_option('third_color', $default['third_color']);

$elements_list = array(
	'colors'        => array(
		'main_color'      => array(
            '.stm_staff_container_list .stm_staff_list_style_2 .stm_staff__contacts .stm_staff__contact i:before',
            '.stm_upcoming_event_style_1 .stm_upcoming_event__date-title',
            '.stm_upcoming_event_style_1 .stm_upcoming_event__counter .counter__value',
            '.stm_pricing-table_style_4 .stm_pricing-table__label',
            '.stm_post_type_list_style_3 .stm_post_type_list__single:hover h4',
            '.stm_post_type_list_style_3 .stm_post_type_list__content:before',
            'body .btn.btn_outline.btn_primary.btn_load span',
            'body .btn.btn_outline',
            'html body .btn.btn_outline.btn_primary i',
		),
		'secondary_color' => array(
            '.stm_projects_grid_style_2 .stm_projects__meta .inner .stm_projects__meta_terms',
			'.stm_pricing-table_style_2 .stm_pricing-table__head h5',
			'.stm_projects_carousel__tab a.active',
            'body.stm_sidebar_style_11 .widget.widget_recent_entries ul li a:hover',
		),
		'third_color'     => array(
		        'body .stm_stories_list_style_1 .stm_loop__story_1:hover .inner h4',
		)
	),
	'bg_colors'     => array(
		'main_color'      => array(
			'.stm_donation_style_2 .stm_donation__progress-bar',
            '.stm_testimonials_style_3 .owl-dots .owl-dot.active',
			'.services_price_list_style_1.services_price_list_tabs ul li.active a',
			'.stm_donation_style_2 .stm_donation__progress-bar',
			'.stm_single_donation_style_1 .stm_single_donation__progress-bar span',
			'.stm_services_style_7 .stm_loop__grid > a',
            'body .stm_projects_cards__filter li a:after',
            'body .stm_project_details_style_7 .stm_project_details__single:before',
            'body.stm_sidebar_style_11 .stm_widget_categories.style_1 ul li:before',
            'body.stm_lists_style_9 .wpb_text_column ul li:before',
            'body .stm_project_details_style_6 .stm_project_details__single:before',
            'body .stm_project_details_style_5 .stm_project_details__single:before',
            'body .tbc',
		),
		'secondary_color' => array(

		),
		'third_color'     => array(
            'body .stm_services_style_7 .stm_loop__grid > a:hover',
            'body .stm_stories_list_style_1 .stm_loop__story_1:hover .inner h4:before',
		)
	),
	'border_colors' => array(
		'main_color'      => array(

		),
		'secondary_color' => array(

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

body.home #wrapper{
padding-bottom: 0;
}
.upcoming .container .wpb_wrapper {
    color: #fff;
}

a{
    letter-spacing: 0;
}

.stm_headings_line.stm_headings_line_top .h1:before, .stm_headings_line.stm_headings_line_top h1:before{
    margin: 0 0 42px;
}

.stm_headings_line.stm_headings_line_top .h2:before, .stm_headings_line.stm_headings_line_top h2:before{
    margin: 0 0 36px;
}

.stm_headings_line.stm_headings_line_top .h3:before, .stm_headings_line.stm_headings_line_top h3:before{
    margin: 0 0 24px;
}

.stm_headings_line.stm_headings_line_top .h4:before, .stm_headings_line.stm_headings_line_top h4:before{
    margin: 0 0 24px;
}

.stm_headings_line.stm_headings_line_top .h6:before, .stm_headings_line.stm_headings_line_top h6:before,
.stm_headings_line.stm_headings_line_top .h5:before, .stm_headings_line.stm_headings_line_top .h5:before{
    display: none;
}

body .stm_projects_cards__filter li a{
    font-weight: 600;
    line-height: 30px;
}

body .stm_projects_cards__filter{
    margin: 0 -10px 26px;
}

.stm_projects_cards_style_4 .stm_projects_card .stm_projects_cards__title{
    line-height: 42px;
    font-weight: 500;
}

.stm_projects_cards_style_4 .stm_projects_card:hover .stm_projects_cards__tags{
    line-height: 30px;
}

body a.stm_projects_card:after{
    background-color: rgba(27,27,255,0.75);
}
body .stm_projects_cards_style_4 .stm_projects_card:hover:after{
    opacity: 1;
}

body .wpb_content_element ._before_none:before{
    display: none;
}

._before_none:before{
    display: none !important;
}

body .stm-counter_style_5 .stm-counter__value{
    font-size: 60px;
    line-height: 72px;
    letter-spacing: -0.27px;
    text-align: left;
    margin-bottom: 6px;
    color: <?php echo wp_kses_post($main_color); ?>;
}

body .stm-counter_style_5 .stm-counter__label{
    font-size: 14px;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    padding: 0;
    text-align: left;
}

.white .stm_pricing-table_style_2 .stm_pricing-table__head h5, .white .stm_projects_carousel__tab a.active,
body .stm_projects_carousel__tab a.active, .white .stc, .white .stm_projects_grid_style_2 .stm_projects__meta .inner .stm_projects__meta_terms, html body .btn.btn_outline.btn_primary:hover i{
    color: #fff !important;
}

body .stm_posttimeline_style_2 .stm_posttimeline__post .stm_posttimeline__post_title{
    max-height: 30px;
}
.stm_posttimeline_style_2 .stm_posttimeline__post_title h5:before, ._before_none .stm_posttimeline__heading .ttc:before,
._before_none h5:before, body .stm_single_post .stm_single_post_style_11 h1:after, body ._before_none h3:before, ._before_none h4:before,
body ._before_none h5:before, body .stm_services_style_4 .stm_services__title:after, .stm_services_style_6 .stm_loop__single_style6 .inner .inner_info:before{
    display:none !important;
}

body .btn, body .btn_primary.btn_outline{
    border-color: rgba(27,27,255,.25) !important;
}

body .btn {
    border-width: 1px;
}

body .stm_read_more_link:after, body .stm_read_more_link:before{
    top: -1px;
}

body .btn.stm_read_more_link{
    border-color: transparent !important;
}

body .stm_cta.style_2 .stm_cta__link .btn{
    border-radius: 0;
}

body  h1.white:before{
    background-color: #fff !important;
}

.pd_zero{
    margin: 0;
}



#our_works .stm_cta__link a{
    padding: 11px !important;
    margin-top: 48px;
    font-size: 24px;
    line-height: 54px;
    width: 320px;
    text-align: center;
    border-width: 1px;
    border-color: rgba(27,27,255, 0.25) !important;
    color: <?php echo wp_kses_post($main_color); ?> !important;
    font-weight: 500;
}

#our_works .stm_cta__link a:hover{
    color: #fff !important;
}


.stm_projects_cards_style_4 .stm_projects_card .stm_projects_cards__title:before{
    display: none;
}

body .pos_abs .stm_infobox_style_1 .stm_infobox__image{
    position: absolute;
    top: 13px;
    left: 80px;
    width: 413px;
}
body .pos_abs .stm_infobox_style_1 .stm_infobox__content{
    background-color: transparent !important;
}

body .vc_images_carousel.vc_per-view-more .vc_carousel-slideline .vc_carousel-slideline-inner>.vc_item>.vc_inner{
    margin: 0 36px;
}

body .stm_infobox_style_1 .stm_infobox__image img{
    -webkit-filter: none;
    filter: none;
}

body.stm_form_style_3 input[type="email"].wbc{
    background-color: transparent;
    border-color: transparent;
    border-bottom: 1px solid rgba(255,255,255,0.6);
    font-size: 26px;
    line-height: 24px;
    color: #fff;
    text-align: left;
    padding-left: 0;
    padding-bottom: 22px;
    letter-spacing: 0;
}

.stm_mailchimp_wrapper{
    position: relative;
}

.letter_sps{
    letter-spacing: -1px;
}

body .mc4wp-form-fields .stm_mailchimp_wrapper button[type=submit]:not(.btn){
    color: #fff !important;
    background-color: transparent;
    position: absolute;
    top: 0;
    right: 0;
    padding: 7px 15px;
    font-size: 16px;
}



.stm-footer .footer-widgets aside.widget .widgettitle h4:before{
    display: none;
}

body .widget_follow.widget_follow_style_1 .stm-icontext a, body .widget_follow.widget_follow_style_1 .stm-icontext__text{
    font-size: 20px;
    line-height: 42px;
    font-weight: 500;
}

.stm-footer a, .stm-footer .stm-socials__icon:hover, .stm-footer .footer-widgets aside.widget .widgettitle h4,
.stm-footer, body .widget-footer.widget_text p>a, .stm_bottom_copyright a:hover{
    color: #fff;
}

body .widget_follow.widget_follow_style_1 a{
    color: #fff !important;
}

body .stm_custom_menu_style_3 .menu li a, body .widget_follow.widget_follow_style_1 a, ._underline{
    position: relative;
}

body .stm_custom_menu_style_3 .menu li a:after, body .widget_follow.widget_follow_style_1 a:after,
._underline:after{
    content: '';
    position: absolute;
    visibility: hidden;
    top: 100%;
    left:0;
    right: 0;
    text-align: center;
    height: 2px;
    background-color: #fff;
}

body .stm_custom_menu_style_3 .menu li a:hover:after, body .widget_follow.widget_follow_style_1 a:hover:after,
._underline:hover:after{
    visibility: visible;
}

.stm-footer .stm-socials__icon:hover, .stm-footer .footer-widgets aside.widget .widgettitle h4,
.stm_bottom_copyright a{
    color: rgba(255,255,255,0.5);
    font-size: 14px;
    line-height: 24px;
    letter-spacing: 1.2px;
    font-weight: 500;
    padding-left: 4px;
}

.stm-footer, .stm_bottom_copyright a{
    letter-spacing: 0;
}

.widget_follow.widget_follow_style_1 .stm-icontext__icon, .stm_custom_menu_style_3 .menu li:before{
    display: none;
}

body.stm_sidebar_style_11 .stm-footer{
    padding-top: 95px;
}

body .stm_custom_menu_style_3 .menu li a{
    font-size: 20px;
    line-height: 42px;
    letter-spacing: 0;
}

body.stm_sidebar_style_11 .widgettitle{
    margin-bottom: 26px;
}

.widget-footer.widget_text p:first-child{
    padding-top:4px;
}

.widget-footer.widget_text p, .widget-footer.widget_text p>a{
    padding-top: 10px;
    color: rgba(255,255,255,0.5);
    font-size: 20px;
    line-height: 42px;
    letter-spacing: 0;
}

.widget-footer.widget_text p{
    color: #fff;
}

body .stm-footer .footer-widgets{
    padding-bottom: 0;
}

body.stm_sidebar_style_11 .stm-footer__bottom{
    margin: -3px 0 30px;
    border: none;
    padding-top: 0;
}

.stm_sidebar_style_11 .stm-footer__bottom .stm_markup .stm_bottom_copyright{
    text-align: left;
    color: rgba(255,255,255,0.5);
    font-size: 16px;
    line-height: 24px;
}

body .stm_partners_style_4 .stm_partners__single{
    width: 20%;
    min-height: 170px;
}

.stm_partners_style_4 .stm_partners__single:before, .stm_partners_style_4 .stm_partners__single:after,
.stm_partners_style_4 .stm_partners__single_plus:before, .stm_partners_style_4 .stm_partners__single_plus:after,
.stm_partners_style_4 .stm_partners__single:nth-child(4) a:before, .stm_partners_style_4 .stm_partners__single:nth-child(4) a:after,
.stm_partners_style_4 .stm_partners__single:nth-child(5) a:before, .stm_partners_style_4 .stm_partners__single:nth-child(5) a:after, .stm_partners_style_4 .stm_partners__single:first-child a:before,
.stm_partners_style_4 .stm_partners__single:first-child a:after, .stm_partners_style_4 .stm_partners__single:nth-child(2) a:before,.stm_partners_style_4 .stm_partners__single:nth-child(2) a:after,
.stm_partners_style_4 .stm_partners__single:nth-last-child(2) a:before, .stm_partners_style_4 .stm_partners__single:nth-last-child(2) a:after,
.stm_partners_style_4 .stm_partners__single:last-child a:before, .stm_partners_style_4 .stm_partners__single:last-child a:after{
    display: none !important;
}

body .my_h5{
    line-height: 32px;
}
body.stm_form_style_3 input[type=email].wbc{
    padding-right: 40px;
}

.stm_mailchimp_wrapper ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
    color: #fff;
}
.stm_mailchimp_wrapper ::-moz-placeholder { /* Firefox 19+ */
    color: #fff;
}
.stm_mailchimp_wrapper :-ms-input-placeholder { /* IE 10+ */
    color: #fff;
}
.stm_mailchimp_wrapper :-moz-placeholder { /* Firefox 18- */
    color: #fff;
}

body .stm_partners_style_4 .stm_partners__single:hover .stm_partners__image{
    box-shadow: none;
}

.stm_form_style_3 .stm_select .stm-select__val{
    line-height: 24px;
}
body .stm_material_form:not(.stm_has-value) input, body .stm_select:not(.stm_has-value),
body.stm_form_style_3 .stm_material_form textarea{
    border-bottom-color: #a6a9aa !important;
}

body .stm_material_form input:focus, body.stm_form_style_3 .stm_material_form textarea:focus,
body .stm_select.open{
    border-bottom-color: <?php echo wp_kses_post($main_color); ?> !important;
}
.stm_select.open .stm_select__dropdown{
    margin-top: 2px;
}
.archive .stm_loop__grid_11 .inner .post_thumbnail,
.archive .stm_loop__list .inner .post_thumbnail{
    margin: 0;
}
.archive .stm_loop__grid_11 .inner, .archive .stm_loop__list .inner{
    border: none;
    display: initial;
}

body .stm_carousel_style_1 .stm_carousel__title{
    padding: 33px 150px 33px 100px;
}

@media (max-width: 1023px){
    body .stm_color_presentation_style_1 .stm_color_presentation__text_1{
        margin-top: 0;
    }
}
@media (max-width: 1023px){

    .mg_top-30, .container .mg_top-30{
        margin-top: -30px !important;
    }

    body .h1, body h1{
        font-size: 50px !important;
    }

    body .h2, body h2{
        font-size: 40px !important;
    }

    .stm_cta.style_2 .stm_cta__content *:last-child{
        font-size: 40px !important;
    }

    body .stm_cta.style_2 .stm_cta__content{
        width: auto;
    }
    .stm_header_style_1 .stm-navigation__default > ul > li.current-menu-item > a{
        color: <?php echo wp_kses_post($secondary_color); ?> !important;
    }
    .stm_header_style_1 .stm-navigation > ul li.current-menu-item a:before{
        opacity: 1;
        visibility: visible;
        bottom: -11px;
    }

    body.stm_header_style_1 .stm_mobile__logo {
        min-width: 65px;
        max-width: 65px;
    }
    .mg_top60{
        margin-top: 30px !important;
    }
    .home.stm_header_style_1 .stm_mobile__header{
        margin-bottom: 0;
    }
    html body .stm-navigation__default ul li.stm_megamenu.active .sub-menu, html body .stm-navigation__fullwidth ul li.stm_megamenu.active .sub-menu{
        padding-left: 10px !important;
    }
}

@media (max-width: 990px){
    .overflow_hidden{
        overflow: hidden;
    }
}

@media (max-width: 768px ){

    body .my_h5{
        line-height: 32px;
    }
}

@media (max-width: 640px ){



    body .stm_partners_style_4 .stm_partners__single{
        width: 50%;
    }
    #our_works .stm_cta__link a{
        margin-top: 0;
    }
    #follow-2{
        margin-top: 30px;
    }
}

@media (max-width: 320px ){
    #our_works .stm_cta__link a{
        width: 290px;
    }
}

.stm_layout_portfoliotwo .stm_iconbox_style_6 {
	padding: 44px 30px;
}

.stm_layout_portfoliotwo .stm_donation_style_2 .stm_donation__details-wrapper {
	padding-bottom: 20px;
}

.stm_posttimeline_style_1 .stm_posttimeline__post h3 {
    text-transform: none !important;
    font-size: 24px;
}

.stm_pagination_style_10 .owl-dots .owl-dot {
    display: inline-block;
}

.stm_testimonials_style_3 .owl-dots .owl-dot {
    padding: 0 !important;
}

.stm_testimonials_style_3 .owl-dots .owl-dot.active span {
    opacity: 1 !important;
}

.stm_events_list_style_1 .stm_event_single_list > div.hasTitle h3 {
    font-size: 20px;
    line-height: 1.2em;
}

.stm_upcoming_event_style_1 .stm_upcoming_event__date {
    line-height: 1.2em !important;
    margin-bottom: 15px !important;
}

.stm_projects_carousel__name {
    line-height: 1.2em;
    font-size: 16px !important;
}

.stm_projects_grid_style_2 .stm_projects__meta .inner h5 {
    text-transform: none !important;
}

.stm_projects_grid_style_2 .stm_projects__meta .inner .stm_projects__meta_terms {
    line-height: 1.4em
}

.stm_carousel_style_1 .owl-controls .owl-nav > *{
    background-color: transparent !important;
}

.stm_carousel .owl-nav .owl-prev:after {
	background: transparent !important;
}

.services_price_list_style_2 .service__tab.active {
    padding:0 30px;
}

.services_price_list_style_2 .service__tab_item {
    padding: 0 15px
}

.woocommerce .widget_layered_nav ul li a:hover {
    color: #fff !important;
}

.stm_layout_portfoliotwo .stm_products li .price {
    color: #fff !important;
}
.stm_layout_portfoliotwo .stm_products li .price ins,
.stm_layout_portfoliotwo .stm_products li .price del,
.stm_layout_portfoliotwo .stm_products li .price span {
    color: #fff !important;
}

.stm_layout_portfoliotwo  div.product .woocommerce-tabs ul.tabs li a {
    transition: .3s ease;
}

.stm_layout_portfoliotwo  div.product .woocommerce-tabs ul.tabs li:not(.active) {
    background: transparent !important;
}
.stm_layout_portfoliotwo  div.product .woocommerce-tabs ul.tabs li:not(.active) a {
    color: #000 !important;
}

.stm_layout_portfoliotwo.woocommerce .widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle {
    transform: none;
    border-radius: 50%;
}