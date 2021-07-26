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
            '.stm_staff_container_list .stm_staff_list_style_2 .stm_staff__contacts .stm_staff__contact i:before',
            '.stm_upcoming_event_style_1 .stm_upcoming_event__date-title',
            '.stm_upcoming_event_style_1 .stm_upcoming_event__counter .counter__value',
            '.stm_pricing-table_style_4 .stm_pricing-table__label',
            '.stm_post_type_list_style_3 .stm_post_type_list__content:before',
            'body .stm_prevnext_wr_style_2 .stm_prevnext__image i',
            'body .stm_prevnext_wr_style_2 .stm_projects_prevnext__main',
            'body .stm_read_more_link:before',
            'body .blockquote:before',
            'body .btn_white.btn_solid:hover',
            'body .stm_iconbox_style_4 .stm_iconbox__text h5',
            'body .stm_opening_hours_table_style_1 .day .day_title',
            'body .stm_opening_hours_table_style_1 .day .working_time',
            'body .stm_services_style_7 .stm_loop__grid > a:hover .stm_services__content',
            'body .stm_services_style_7 .stm_loop__grid > a:hover .stm_services__content>h5',
            'body .stm_services_style_7 .stm_loop__grid > a:hover .stm_services__icon>i',
            '.stm_sidebar_style_11 .widget.widget-default.widget_search .search-form input[name="s"]',
            'body .stm_widget_posts.style_1 ul li .stm_widget_posts__title',
            'body .stm_schedule_style_1 .event_lesson_tabs a span',
            '.stm_schedule_style_1 .event_lesson_info_time_loc .event_lesson_info_times',
            '.stm_schedule_style_1 .event_lesson_info_time_loc',
            '.stm_schedule_style_1 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_info_title',
            '.stm_schedule_style_1 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_info_description',
            'body .services_price_list_style_2.services_price_list_tabs .services_pills_container > ul > li.active a',
            'body .services_price_list_style_2 .service__text',
            '.services_price_list_style_1 .service__text',
            '.stm_staff_grid_style_1 p',
            '.stm_staff_grid_style_1 .stm_staff__job',
            '.stm_staff_list_style_1 .stm_staff__info>p',
            '.stm_staff_list_style_1 .stm_staff__info>.stm_staff__job',
            '.stm_staff_container_grid .stm_staff_grid_style_2 .stm_staff__job',
            '.stm_staff_container_grid .stm_staff_grid_style_2 .stm_staff__contacts',
            '.stm_staff_grid_style_3 .stm_staff__job',
            '.stm_staff_grid_style_3 p',
            'body .stm_staff_list_style_5 .stm_staff__socials li a:hover',
            'body .stm_staff_list_style_5 .stm_staff__info p',
            'body .stm_staff_container_list .stm_staff_list_style_2 .stm_staff__job',
            '.stm_stories_style_1 .stm_story__text',
            '.stm_testimonials_style_2 .stm_testimonials__review',
            'body .stm_testimonials_style_2 .stm_testimonials__info h6',
            'body .stm_testimonials_style_3 .stm_testimonials__review',
            'h1.stm_custom_heading__icon.text-center i',
            '.h1.stm_custom_heading__icon.text-center i',
            'h2.stm_custom_heading__icon.text-center i',
            '.h2.stm_custom_heading__icon.text-center i',
            'h3.stm_custom_heading__icon.text-center i',
            '.h3.stm_custom_heading__icon.text-center i',
            'h4.stm_custom_heading__icon.text-center i',
            '.h4.stm_custom_heading__icon.text-center i',
            'h5.stm_custom_heading__icon.text-center i',
            '.h5.stm_custom_heading__icon.text-center i',
            'h6.stm_custom_heading__icon.text-center i',
            '.h6.stm_custom_heading__icon.text-center i',
            '.stm_testimonials_style_4 .stm_testimonials__info span',
            '.stm_form_style_3 .stm_material_form.stm_has-value input',
            '.stm_form_style_3 .stm_material_form.stm_has-value textarea',
            '.wpb_text_column :last-child, .wpb_text_column p:last-child',
            'body.woocommerce .widget_price_filter .price_slider_wrapper .price_slider_amount .price_label',
            'body.woocommerce .widget_price_filter .price_slider_wrapper .price_slider_amount .button',
            'body.stm_layout_photographer div.product .woocommerce-tabs ul.tabs li:not(.active) a',
            'body.woocommerce div.product form.cart .button:hover',
            'body .widget.widget-default.widget_search .search-form button i',
            '.search .stm_loop .stc',
            'body .stm_single_post_style_11 .stm_post_panel .stm_share .__icon i',
            'body .btn.btn_primary.btn_solid:not(.btn_white):hover .btn__icon',
            'body .btn.btn_third.btn_solid:not(.btn_white):hover .btn__icon',
            'body .stm_pricing-table_style_4.has-label .btn.btn_solid',
            'html body .stm_pricing-table_style_1 .btn.btn_solid',
            'html body .stm_pricing-table_style_3 ul li',
            'html body .stm_pricing-table_style_4 ul li',
            'body .stm_staff_container_list .stm_staff_list_style_2 .stm_staff__socials a:hover i',
            'body.woocommerce .entry-summary .star-rating span:before',
            'body.stm_form_style_3 .woocommerce select, .woocommerce .cart input.button:hover',
            '.woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea',
            '.stm_form_style_3 .woocommerce input[type=email], body .woocommerce #order_review .woocommerce-info',
            '.woocommerce table.shop_table tbody tr td.product-quantity .quantity .qty',
            'body.woocommerce-cart .wc-proceed-to-checkout a.button.alt.checkout-button:hover',
            '.woocommerce table.shop_table tbody tr td.product-price',
            '.shop_table .woocommerce-cart-form__cart-item.cart_item td:before',
            'body .variations_form .variations tbody tr td label',
            '.woocommerce .widget_shopping_cart .buttons a:hover, .woocommerce.widget_shopping_cart .buttons a:hover',
		),
		'secondary_color' => array(
            '.stm_projects_grid_style_2 .stm_projects__meta .inner .stm_projects__meta_terms',
			'.stm_pricing-table_style_2 .stm_pricing-table__head h5',
            'body.woocommerce .widget_price_filter .price_slider_wrapper .price_slider_amount .button:hover',
			'.stm_projects_carousel__tab a.active',
            'body .btn_white.btn_solid',
            '.stm_infobox_style_1 .stm_infobox__content p',
            'body .stm_opening_hours_table_style_1 .day.today .time_to_closing',
            'body .stm_opening_hours_table_style_1 .day.today .time_to_closing .wtc',
            'body .stm_posttimeline_style_2 .stm_posttimeline__post_inner',
            'body .stm_posttimeline_style_2 .stm_posttimeline__year',
            'body .stm_services_style_2 .stm_services__title span',
            'body .stm_services_style_5 .stm_post_type_list__content h4',
            'body .stm_services_style_7 .stm_loop__grid > a .stm_services__content',
            'body .stm_services_style_7 .stm_loop__grid > a .stm_services__content>h5',
            'body .stm_services_style_7 .stm_loop__grid > a .stm_services__icon>i',
            'body.stm_accordions_style_2 .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading .vc_tta-panel-title > a .vc_tta-title-text',
            'body .stm_pricing-table_style_1 .stm_pricing-table__head h5',
            'body .stm_pricing-table_style_1 .stm_pricing-table__pricing',
            'body .stm_pricing-table_style_1 .stm_pricing-table__content ul li',
            'body .stm_pricing-table_style_1 .stm_pricing-table__content ul li:before',
            'body .stm_pricing-table_style_2 .stm_pricing-table__head h5',
            '.stm_pricing-table_style_2 .stm_pricing-table__prefix',
            '.stm_pricing-table_style_2 .stm_pricing-table__price',
            'stm_pricing-table_style_2 .stm_pricing-table__separator',
            '.stm_pricing-table_style_2 .stm_pricing-table__content ul li',
            '.stm_pricing-table_style_2 .stm_pricing-table__content ul li:before',
            '.stm_pricing-table_style_4.has-label .stm_pricing-table__head h5',
            '.stm_pricing-table_style_4.has-label .stm_pricing-table__pricing',
            '.stm_pricing-table_style_4.has-label .stm_pricing-table__content ul li',
            '.stm_pricing-table_style_4.has-label .stm_pricing-table__content ul li:before',
            'body .stm_projects_carousel__tab a:hover',
            'body .wtc_h:not(.wbc):hover',
            '.widget.widget-default.widget_search .search-form button:hover i',
            '.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__front .inner_flip .stm_projects__meta .inner h5',
            '.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__back .inner_flip .stm_projects__meta .inner h5',
            '.stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__back .inner_flip .stm_projects__meta .inner > *',
            '.widget.widget-default.widget_search .search-form button i',
            '.stm_sidebar_style_11 .widget_tag_cloud .tagcloud a:hover',
            '.owl-nav .owl-prev:hover:before, .owl-nav .owl-next:hover:before',
            '.stm_post_type_list_style_3 .stm_post_type_list__content:before',
            '.stm_post_type_list_style_3 .stm_post_type_list__content h4',
            'body .stm_post_type_list_style_2 .stm_post_type_list__single.active .stm_post_type_list__content h4',
            'body .stm_post_type_list_style_2 .stm_post_type_list__single:hover .stm_post_type_list__content h4',
            '.stm_errorpage__inner h1',
            '.stm_errorpage__inner h2',
            '.services_price_list_style_1.services_price_list_tabs .services_pills_container > ul > li.active a',
            'body .stm_staff_grid_style_1 .stm_staff__image .stm_staff__socials li a:hover',
            'body .stm_staff_grid_style_3 .stm_staff__image .stm_staff__socials li a:hover',
            '.stm_staff_grid_style_4 .stm_staff__name',
            '.stm_staff_container_grid.style_5 .stm_staff__name',
            '.stm_staff_container_grid.style_6 .stm_staff__name',
            'body .stm_staff_container_grid.style_6 .stm_staff__socials li a:hover',
            '.stm_staff_list_style_4 .stm_staff__name',
            'body .stm_staff_list_style_6 .stm_staff__info .stm_staff__name',
            'body .stm_staff_list_style_6 .stm_staff__socials li a:hover>i',
            '.twentytwenty-horizontal .twentytwenty-handle .twentytwenty-right-arrow:after',
            '.twentytwenty-horizontal .twentytwenty-handle .twentytwenty-left-arrow:after',
            '.stm_testimonials_style_4 .stm_testimonials__review:before',
            '.wtc.stm_mf',
            '.wtc.stm_mf>a',
            '.stm_single_stm_events .stm_markup__content .stm_single_event__categories i',
            '.stm_input_wrapper:after',
            '.stm_vacancies_style_2 .stm_vacancies__single .inner .__icon',
            '.stm_vacancies_style_2 .stm_vacancies__single .inner > div',
            'body .stm_video.stm_video_style_4 .stm_playb:before',
            'body.woocommerce ul.stm_products li.product a .woocommerce-loop-product__title',
            '.stm_layout_photographer .stm_products li .price ins',
            '.stm_layout_photographer .stm_products li .price del',
            '.stm_layout_photographer .stm_products li .price span',
            'body.woocommerce ul.stm_products li.product .stm_single_product__image .onsale',
            'body.woocommerce ul.stm_products li.product .stm_single_product__image .stm_single_product__more i.stmicon-zoom-in3',
            'body.woocommerce ul.stm_products li.product .stm_single_product__image .button:after',
            'body.woocommerce ul.stm_products li.product:hover a .price del',
            'body.woocommerce ul.stm_products li.product:hover a .price > span',
            'body.stm_pagination_style_10 ul.page-numbers .page-numbers.current',
            'body.stm_pagination_style_10 ul.page-numbers li.stm_page_num a:hover',
            'body.woocommerce .widget_product_categories .product-categories li a',
            'body.woocommerce .widget_product_categories .product-categories li .children li a',
            'body.woocommerce .widget_product_categories .product-categories > li:hover > a',

            'body.woocommerce .widget_layered_nav ul li',
            'body.woocommerce .widget_layered_nav ul li a',
            'body.woocommerce div.product .woocommerce-tabs .panel p:last-child',
            'body.woocommerce div.product .woocommerce-tabs ul.tabs li.active a',
            'body.woocommerce div.product .woocommerce-tabs ul.tabs li a',
            'body.woocommerce #review_form #respond .stars a',
            'body.woocommerce #review_form #respond .star-rating a',
            'body.woocommerce .star-rating span:before',
            'body.woocommerce .comment-text p',
            'body.woocommerce #review_form #respond',
            '.woocommerce div.product form.cart .button',
            'body .stm_single_post_style_11 .stm_post_panel .stm_share .__icon:hover i',
            'body .stm_posttimeline_style_1 .stm_posttimeline__post:hover .stm_posttimeline__post_image:before',
            'html body .stm_pricing-table_style_4.has-label .btn.btn_solid:hover',
            'html body #wrapper .stm_pricing-table_style_1 .btn.btn_solid:hover',
            'body .stm_pricing-table_style_1 .stm_pricing-table__label',
            'body .stm_staff_grid_style_4 .stm_staff__job',
            'body .stm_staff_container_grid.style_5 .stm_staff__socials li a:hover',
            'body .stm_staff_container_list .stm_staff_list_style_2 .stm_staff__socials i',
            'body .stm_staff_list_style_6 p',
            'body .stm_testimonials_style_1 .stm_testimonials__review',
            'body .stm_testimonials_style_5 .stm_testimonials__review',
            'body .stm_testimonials_style_4 .stm_testimonials__review',
            'body .black .wpb_wrapper, .woocommerce .cart-collaterals .cart_totals .shop_table tbody tr.cart-subtotal th',
            'body .stm_projects_carousel__carousel .owl-nav .owl-prev:hover:before, body .stm_projects_carousel__carousel .owl-nav .owl-next:hover:before',
            'body .woocommerce .woocommerce-info, .woocommerce table.shop_table tbody tr td, body .woocommerce .woocommerce-form-coupon-toggle .woocommerce-info>.showcoupon',
            '.woocommerce form.checkout_coupon, .woocommerce .cart input.button, body.woocommerce-cart .wc-proceed-to-checkout a.button.alt.checkout-button',
            '.woocommerce .cart-collaterals .cart_totals .shop_table tbody tr.order-total th',
            '.woocommerce-page .cart-collaterals .cart_totals .shop_table tbody tr.order-total th',
            '.shop_table.shop_table_responsive .order-total span.amount',
            '.return-to-shop .button.wc-backward, body .woocommerce .woocommerce-info .showlogin, body .woocommerce-form-login.login p, body .woocommerce-form-login.login p>a',
            '.woocommerce-privacy-policy-text, .woocommerce-privacy-policy-text a, .woocommerce span.onsale, .woocommerce .woocommerce-message .button.wc-forward:hover',
            '.woocommerce .widget_shopping_cart .buttons a, .woocommerce.widget_shopping_cart .buttons a',
		),
		'third_color'     => array(
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
            'body .stm_prevnext_wr_style_1 .stm_projects_prevnext__main',
            'body .stm_prevnext_wr_style_2 .stm_projects_prevnext__main',
            'body .stm_partners_style_2 .stm_partners__title:before',
            'body .widget.widget-default.widget_search .search-form button:hover',
            'body .stm_single_post_style_11 .stm_post_panel .stm_share .__icon:hover',
            'body .btn.btn_primary.btn_solid:not(.btn_white):hover .btn__icon:after',
            'body .btn.btn_third.btn_solid:not(.btn_white):hover .btn__icon:after',
            'html body .stm_pricing-table_style_4.has-label .btn.btn_solid:hover',
            'html body #wrapper .stm_pricing-table_style_1 .btn.btn_solid:hover',
            '.woocommerce .cart input.button',
            'body.woocommerce .widget_price_filter .price_slider_wrapper .price_slider_amount .button:hover',
            'body.woocommerce #woocommerce_price_filter-2.widget_price_filter .price_slider_wrapper  .price_slider_amount .button:hover',
		),
		'secondary_color' => array(
            '.woocommerce .woocommerce-message',
            'body .stm_prevnext_wr_style_1 .stm_projects_prevnext__main:before',
            'body .stm_prevnext_wr_style_1 .stm_projects_prevnext__main:after',
            'body .stm_prevnext_wr_style_1 .stm_projects_prevnext__main span:before',
            'body .stm_prevnext_wr_style_1 .stm_projects_prevnext__main span:after',
            'body .stm_prevnext_wr_style_2 .stm_projects_prevnext__main:before',
            'body .stm_prevnext_wr_style_2 .stm_projects_prevnext__main:after',
            'body .stm_prevnext_wr_style_2 .stm_projects_prevnext__main span:before',
            'body .stm_prevnext_wr_style_2 .stm_projects_prevnext__main span:after',
            'body .btn_white.btn_solid:hover',
            'body .stm_gmap_wrapper.style_1 .gmap_addresses:before',
            'body .stm_posttimeline_style_2 .stm_posttimeline__year.active span',
            'body .stm_services_style_7 .stm_loop__grid > a:hover',
            'body .btn.btn_outline.btn_white:hover',
            'body .btn.btn_outline:not(.btn_white):hover .btn__icon:after',
            'body .btn.btn_solid:not(.btn_white) .btn__icon:after',
            'body .btn.btn_solid:not(.btn_white):hover .btn__icon:after',
            '.stm_post_type_list_style_2 .stm_post_type_list__single',
            '.stm_single_event__overlay.mbc',
            '.stm_single_stm_events .stm_markup__content .stm_single_event__form',
            'body .stm_post_details.mbc ',
            '.widget.widget-default.widget_search .search-form button',
            'body .stm_video.stm_video_style_2 .stm_playb:after',
            'body .stm_video.stm_video_style_3 .stm_playb:after',
            'body.woocommerce .widget_price_filter .price_slider_wrapper .price_slider_amount .button',
            'body button[type="submit"]:not(.btn), input[type="submit"]:not(.btn)',
            'body .search-form button[type="submit"]:not(.btn)',
            '.stm_form_style_3.woocommerce select',
            'body .btn.btn_primary.btn_solid:not(.btn_white):hover',
            'body .btn.btn_third.btn_solid:not(.btn_white):hover',
            'body .stm_pricing-table_style_4.has-label .btn.btn_solid',
            'body .stm_pricing-table_style_1 .btn.btn_solid',
            'body .stm_partners_style_4 .stm_partners__single:hover a',
            'body.woocommerce #woocommerce_price_filter-2.widget_price_filter .price_slider_wrapper  .price_slider_amount .button',
            'body.woocommerce .woocommerce-info',
            'body .woocommerce #order_review .woocommerce-info',
            '.stm_form_style_3 .woocommerce input[type=text], .stm_form_style_3 .woocommerce textarea, .stm_form_style_3 .woocommerce select',
            '.stm_form_style_3 .woocommerce input[type=tel], .stm_form_style_3 .woocommerce textarea, .stm_form_style_3 .woocommerce input[type=email]',
            '.woocommerce table.shop_table thead tr th, .woocommerce .woocommerce-checkout-review-order-table tfoot tr th, .woocommerce .woocommerce-checkout-review-order-table tfoot tr td',
            '.woocommerce #order_review #payment .place-order #place_order, body.stm_form_style_3 .woocommerce input[type=password]',
            '.woocommerce .widget_shopping_cart .buttons a:hover, .woocommerce.widget_shopping_cart .buttons a:hover',
		),
		'third_color'     => array(

		)
	),
	'border_colors' => array(
		'main_color'      => array(
            'body .stm_project_details_style_7',

		),
        'secondary_color' => array(
            'body .stm_video.stm_video_style_4 .stm_playb:after',
            'body .stm_staff_container_grid.style_6 .stm_staff__socials li a:hover',
            'body .stm_video.stm_video_style_1 .stm_playb:after',
            'html body .stm_pricing-table_style_4.has-label .btn.btn_solid',
            'html body .stm_pricing-table_style_4.has-label .btn.btn_solid:hover',
            'html body #wrapper .stm_pricing-table_style_1 .btn.btn_solid',
            'html body #wrapper .stm_pricing-table_style_1 .btn.btn_solid:hover',
            'html body #wrapper .stm_pricing-table_style_2 .btn.btn_solid',
            'body.error404 .stm_errorpage__inner .btn.btn_primary.btn_solid',
            'body .woocommerce-form-login .stm_input_wrapper_checkbox:before',
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

.site-content .stm_widget_categories.style_1 ul li a:hover{
    text-decoration: line-through !important;
}

body.stm_sidebar_style_11 .widget.widget-default.widget_search .search-form input[name="s"],
.stm_form_style_3.woocommerce select, .stm_loop__grid_11 .inner, .widget_tag_cloud .tagcloud a{
    border-color: rgba(255,255,255,0.5);
}

.search .stm_loop{
    overflow: hidden;
}

body.active>#wrapper{
    overflow: visible;
}

body{
    background-color: #1a1a1a;
}

body a:hover{
    text-decoration: line-through;
}

body .stm_mobile__switcher span{
    width: 34px;
    height: 3px;
    margin-bottom: 6px;
}

body .stm_mobile__switcher.active span:last-child{
    top: -7px;
}

body .stm_loop__list .inner{
    height: auto;
}

body .stm_loop__single.stm_loop__list.stm_loop__single_style3> a{
    border: none;
}

body.woocommerce div.product form.cart .button:hover, body .stm_prevnext__post .stm_prevnext__content,
body .wp-caption, body.woocommerce-cart .wc-proceed-to-checkout a.button.alt.checkout-button:hover{
    background-color: transparent !important;
}

.stm_partners_style_4 .stm_partners__single:before, .stm_partners_style_4 .stm_partners__single:after,
.stm_partners_style_4 .stm_partners__single_plus:before, .stm_partners_style_4 .stm_partners__single_plus:after,
.stm_partners_style_4 .stm_partners__single:nth-child(4) a:before, .stm_partners_style_4 .stm_partners__single:nth-child(4) a:after,
.stm_partners_style_4 .stm_partners__single:nth-child(5) a:before, .stm_partners_style_4 .stm_partners__single:nth-child(5) a:after, .stm_partners_style_4 .stm_partners__single:first-child a:before,
.stm_partners_style_4 .stm_partners__single:first-child a:after, .stm_partners_style_4 .stm_partners__single:nth-child(2) a:before,.stm_partners_style_4 .stm_partners__single:nth-child(2) a:after,
.stm_partners_style_4 .stm_partners__single:nth-last-child(2) a:before, .stm_partners_style_4 .stm_partners__single:nth-last-child(2) a:after,
.stm_partners_style_4 .stm_partners__single:last-child a:before, .stm_partners_style_4 .stm_partners__single:last-child a:after{
    background-color: rgba(255,255,255,0.25) !important;
}

.stm_prevnext_wr_style_1 .stm_projects_prevnext .stm_prevnext__image:after{
    opacity: 0.3;
}

.btn, .btn .btn__label{
    border: 1px solid transparent !important;
    font-weight: 500;
    text-transform: uppercase;
}



body .stm_loop__single.stm_loop__list.stm_loop__single_style3> .stm_post_details, body.woocommerce div.product form.cart .button:hover{
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
}

body .btn.btn_primary.btn_default:not(.btn_white):hover{
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
}

body .search-form button[type="submit"]:not(.btn):hover{
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
    color: <?php echo wp_kses_post($main_color); ?> !important;
}

body .btn.btn_primary:not(.btn_white):hover,
body button[type="submit"]:not(.btn):hover,
body input[type="submit"]:not(.btn):hover{
    border-color: <?php echo wp_kses_post($secondary_color); ?> !important;
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

body .btn.btn_primary.btn_solid:not(.btn_white):hover, body .btn.btn_third.btn_solid:not(.btn_white):hover{
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
    color: <?php echo wp_kses_post($main_color); ?> !important;
}

body.woocommerce .quantity .decrease:hover{
    border-top-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

body.woocommerce .quantity .increase:hover{
    border-bottom-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.woocommerce .woocommerce-cart-form__cart-item .quantity .increase{
    border-color: transparent transparent <?php echo wp_kses_post($main_color); ?>;
}

.woocommerce .woocommerce-cart-form__cart-item .quantity .decrease{
    border-color: <?php echo wp_kses_post($main_color); ?> transparent transparent;
}

body .stm_video.stm_video_style_1 .stm_playb:before{
    border-color: transparent transparent transparent <?php echo wp_kses_post($secondary_color); ?>;
}

body .stm_video.stm_video_style_4 .stm_playb:before, body .stm_video.stm_video_style_5 .stm_playb:before{
    border-left-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

body.wpb-js-composer .vc_tta .vc_tta-controls-icon.vc_tta-controls-icon-triangle::before{
    border-bottom-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

body .stm_services_style_7 .stm_loop__grid > a:hover, body.woocommerce .widget_price_filter .price_slider_wrapper .price_slider_amount .button:hover{
    border-color: <?php echo wp_kses_post($main_color); ?> !important;
}

body .stm_loop__single.stm_repeating_line:after, body .stm_linear_repeater{
    background: repeating-linear-gradient(135deg, rgba(255, 255, 255, 1) 5px, rgba(0, 0, 0, 0.15) 10px, transparent 10px, transparent 15px);
}

body .owl-nav .owl-prev:hover:before, body .owl-nav .owl-next:hover:before,
body .stm_testimonials_style_5 .owl-controls .owl-nav .owl-next:hover, .stm_post_details .comments_num>a:hover,
body.stm_sidebar_style_11 .widget.widget_recent_entries ul li a:hover,
body .stm_stories_list_style_1 .stm_loop__story_1:hover .inner h4{
    color: rgba(255,255,255,0.5) !important;
}

body.woocommerce .widget_product_categories .product-categories li .children li a:hover,
body.woocommerce .widget_product_categories .product-categories li a:hover,
body.woocommerce .widget_layered_nav ul li:hover, body.woocommerce .widget_layered_nav ul li:hover a,
body .stm_staff_container_grid.style_4 .stm_staff__socials li a:hover{
    color: rgba(0,0,0,0.5) !important;
}

body.stm_pagination_style_10 .owl-dots .owl-dot, body .stm_pagination_style_10 .owl-dots .owl-dot,
body.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content{
    background-color: rgba(255,255,255,0.5);
}

.stm-footer__bottom .stm_markup > div, body .stm-footer a, .stm_footer_layout_2 .stm-footer__bottom .stm-socials__icon i,
.stm_single_post_layout_11 .stm_carousel_style_1 .owl-nav .owl-next:hover:before,
.stm_single_post_layout_11 .stm_carousel_style_1 .owl-nav .owl-prev:hover:before{
    color: rgba(255,255,255,0.5) !important;
}

body a, body .stm_projects_cards__filter li a, .stm-footer__bottom .stm_markup > div a:hover, body .stm-footer a:hover,
.stm_footer_layout_2 .stm-footer__bottom .stm-socials__icon:hover i, body .stm_cta__link .btn.btn_solid:hover .btn__icon{
    color: <?php echo wp_kses_post($main_color); ?> !important;
}

body .btn.btn_solid.primary, body .btn.btn_solid:not(.btn_white), body .btn.btn_outline.btn_primary:hover,
.btn.btn_outline.btn_third:hover, .btn.btn_outline.wtc, .btn.btn_outline.wtc:hover, .btn.btn_outline.wtc_h:hover,
.btn.btn_solid:not(.btn_white), .btn.wtc, .btn.btn_outline:hover .btn__icon, body .btn.btn_solid .btn__icon, body .btn.btn_outline.btn_primary:hover,
 body .btn.btn_outline.btn_primary.btn_load:hover span, .woocommerce #order_review #payment .place-order #place_order:hover{
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

body .stm_markup__content button[type="submit"]:not(.btn):hover,
.woocommerce #order_review #payment .place-order #place_order:hover{
    outline: 1px solid <?php echo wp_kses_post($secondary_color); ?> !important;
}

body.woocommerce .stm_markup__content div.product form.cart .button:hover,
body.woocommerce #woocommerce_price_filter-2.widget_price_filter .price_slider_wrapper  .price_slider_amount .button,
.woocommerce .cart input.button:hover, body.woocommerce-cart .wc-proceed-to-checkout a.button.alt.checkout-button:hover,
.woocommerce .woocommerce-message, .woocommerce .widget_shopping_cart .buttons a:hover, .woocommerce.widget_shopping_cart .buttons a:hover{
    outline: 1px solid <?php echo wp_kses_post($main_color); ?> !important;
}

body .widget.widget-default.widget_search .search-form button{
    outline: 1px solid rgba(255,255,255,0.5) !important;
}

.stm_pagination_style_10 ul.page-numbers li.stm_next, .stm_pagination_style_10 ul.page-numbers li.stm_prev{
    width: 40px;
}

.stm_pagination_style_10 ul.page-numbers li.stm_prev a.page-numbers i,
.stm_pagination_style_10 ul.page-numbers li.stm_next a.page-numbers i,
.stm_prevnext_wr_style_2 .stm_prevnext__post_next .stmicon-portfolio_next,
.stm_prevnext_wr_style_2 .stm_prevnext__post_prev .stmicon-portfolio_prev{
    transition: .3s ease;
}

.stm_pagination_style_10 ul.page-numbers li.stm_prev a.page-numbers:hover i,
.stm_pagination_style_10 ul.page-numbers li.stm_next a.page-numbers:hover i{
    font-size: 22px;
}

.stm_prevnext_wr_style_2 .stm_prevnext__post_next .stmicon-portfolio_next:hover,
.stm_prevnext_wr_style_2 .stm_prevnext__post_prev .stmicon-portfolio_prev:hover{
    font-size: 24px;
}

.woocommerce ul.stm_products li.product a .stm_single_product__meta{
    background-color: #f2f2f2 !important;
}

body.woocommerce div.product .woocommerce-tabs .panel{
    border-radius: 0 0 4px 4px;
}

body .widget.widget-default.widget_search .search-form button{
    height: 48px;
    top: 1px;
}

body .stm_projects_cards__filter li a:after{
    background-color: <?php echo wp_kses_post($main_color); ?> !important;
}

.btn.btn_solid:not(.btn_white) .btn__icon:after, .btn.btn_solid:not(.btn_white):hover .btn__icon:after{
    background-color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

body.stm_sidebar_style_11 .stm-footer__bottom .stm_markup > div{
    width: auto;
    display: inline-block;
    font-size: 13px;
    line-height: 26px;
}

body.stm_footer_layout_2 .stm-footer__bottom .stm_bottom_copyright{
    max-width: 340px;
}

body.stm_sidebar_style_11 .stm-footer__bottom .stm_markup > .stm_bottom_copyright {
    text-align: right;
    margin-bottom: 0;
}

body .stm_projects_cards_style_1 .stm_projects_cards__hint span:before{
    background: url(http://pearl.stylemixthemes.com/photographer/wp-content/themes/pearl/assets/img/white_hint.svg) no-repeat;
}

body .stm_projects_cards_style_1 .stm_projects_cards__title{
    line-height: 36px;
}

body .stm_projects_cards_style_1 .stm_projects_cards__tags{
    line-height: 24px;
}

body .stm_projects_cards_style_2 .stm_projects_cards__tags, body .stm_projects_cards_style_3 .stm_projects_cards__tags{
    line-height: 30px;
}

body .stm_projects_cards_style_2 .stm_projects_cards__title, body .stm_projects_cards_style_3 .stm_projects_cards__title{
    line-height: 54px;
}

html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li{
    padding: 0 15px;
}
body .stm_prevnext_wr_style_1 .stm_projects_prevnext .stm_prevnext__post .stm_prevnext__content,
body button[type="submit"]:not(.btn):hover, body input[type="submit"]:not(.btn):hover, .woocommerce #order_review #payment .place-order #place_order:hover{
    background-color: transparent !important;
}

body .stm_gmap_wrapper.style_1 .gmap_addresses .owl-dots-wr .owl-dots .owl-dot{
    margin: 5px 5px !important;
}

body .stm_iconbox_style_4:hover{
    border-color: rgba(255,255,255,0.5);
}

::-webkit-input-placeholder { /* Chrome/Opera/Safari */
    color: #fff !important;
}
::-moz-placeholder { /* Firefox 19+ */
    color: #fff !important;
}
:-ms-input-placeholder { /* IE 10+ */
    color: #fff !important;
}
:-moz-placeholder { /* Firefox 18- */
    color: #fff !important;
}

body .stm_staff_list_style_5{
    border-top-width: 1px;
}
body .stm_staff_list_style_6 .stm_flex_last{
    margin-bottom: 12px;
}

body .stm_carousel_style_1 .stm_carousel__title{
    padding-left: 100px;
}

body .stm_projects_carousel__tab{
    margin-bottom: 2px;
}

body .stm_opening_hours_table_style_1 .day.opens .time_to_closing .wtc,
body .stm_opening_hours_table_style_1 .day.today .time_to_closing .wtc{
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_projects_carousel.stm_fullwidth .owl-item img{
    max-width: none;
    width: auto;
}

body .stm_single_event__calendar.active .addtocalendar{
    visibility: hidden;
    display: none;
}









@media (max-width: 1024px){
    .stm_projects_carousel .owl-controls{
        display: none;
    }
    body .stm_widget_posts.style_1 ul li .post-date{
        position: static;
    }
}

@media (max-width: 1023px){

    .stm_post_type_list_style_3 .stm_post_type_list__image img{
        width: 100%;
    }

    body .stm_single_post_style_11 .stm_prevnext__post.stm_prevnext__post_prev:before, body .stm_single_post_style_11 .stm_prevnext__post.stm_prevnext__post_prev:after,
    body .stm_single_post_style_11 .stm_prevnext__post.stm_prevnext__post_next:before, body .stm_single_post_style_11 .stm_prevnext__post.stm_prevnext__post_next:after{
        background-color: transparent;
    }

    body .stm_single_post_style_11 .stm_prevnext__post_next .stm_prevnext__content{
        border-left: 1px solid;
    }

    body .stm_single_post_style_11 .stm_prevnext__post_prev .stm_prevnext__content{
        border-right: 1px solid;
    }

    body .stm_services_text_carousel_style_1 .owl-dots{
        margin-bottom: 15px;
    }

    body .stm_color_presentation_style_1 .stm_color_presentation__text_1{
        margin-top: 0;
    }

    body .h1, body h1{
     font-size: 50px !important;
    }

    body .h2, body h2{
      font-size: 40px !important;
    }

    .stm_cta.style_2 .stm_cta__content *:last-child{
       font-size: 40px !important;
        line-height: 40px;
    }

    body .stm_cta.style_2 .stm_cta__content{
      width: auto;
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
     .stm_markup_full .vc_col-has-fill{
        overflow: hidden;
    }
}

@media (max-width: 768px){

    .stm_events_list_style_1 .stm_event_single_list .stm_event_single_list__alone.hasAddress{
        left: 15px;
    }

    .stm_iconbox_style_7 .stm_iconbox__text{
        margin-top: -11px;
    }

    body .mg_bottom{
        margin-bottom: 70px !important;
    }

    body .mg_left>vc_column-inner, body .mg_left{
        margin-left: 0 !important;
    }

    body .stm_partners_style_4{
        padding-right: 15px;
        padding-left: 15px;
    }

    body .stm_projects_grid_style_2 .stm_projects__meta{
        padding: 10px 20px;
    }
    body .stm_projects_grid_style_2 .stm_flipbox .stm_flipbox__back .inner_flip .stm_projects__meta .inner{
        top: 10px;
    }
    body .stm_mgb_0.agreement{
        margin-bottom: 30px;
    }
}

@media (max-width: 767px){

    .stm_markup_full.stm_single_post{
        margin: 0 15px;
    }

    .stm_markup_full .mg_bottom .vc_col-has-fill{
        margin-right: 15px;
        margin-left: 15px;
    }

    body .container .stm_markup_full .vc_container{
        padding: 0 15px;
    }

    body .pd_right0{
        padding-right: 0 !important;
    }

    body .stm_carousel_style_1 .stm_carousel__title{
        padding-left: 80px;
    }
}

@media (max-width: 640px ){
    body .stm_partners_style_4 .stm_partners__single{
        width: 50%;
    }
    #our_works .stm_cta__link a{
         margin-top: 0;
    }

}

@media(max-width: 550px){

    .stm_events_list_style_1 .stm_event_single_list .stm_event_single_list__alone.hasAddress{
        left: 5px;
    }

    .stm_events_list_style_1 .stm_event_single_list>.__icon{
        position: absolute;
        left: 5px;
    }

    .stm_events_list_style_1 .stm_event_single_list .stm_event_single_list__alone.hasDate{
        left: 5px;
    }

    body .stm_single_stm_events .stm_markup__content .stm_single_event__info{
        padding: 50px 10px 10px;
    }

    body .stm_carousel_style_1.stm_carousel_dots_bottom .owl-controls .owl-nav{
        display: none;
    }

    body .stm_carousel_style_1 .stm_carousel__title{
        padding-left: 20px;
    }
}

@media (max-width: 375px ){
    .stm_cta.style_2 .stm_cta__content *:last-child{
        letter-spacing: -1px;
    }
    body .stm_cta.style_1 .stm_cta__content{
        padding-right: 0;
    }
    .vc_row-has-fill .vc_column_container>.vc_column-inner{
        padding-right: 15px !important;
    }

    .h5, h5{
        font-size: 30px !important;
        line-height: 36px !important;
    }

    body .pd_left_right10{
        padding-left: 10px !important;
        padding-right: 10px !important;
    }

    body .widget_contacts_style_2_style_2 .widget_contacts_inner{
        padding: 20px 15px 5px;
    }

}

@media (max-width: 320px ){
    #our_works .stm_cta__link a{
        width: 290px;
    }
    body h2{
        font-size: 35px !important;
        line-height: 40px !important;
    }

    body .widget_contacts_style_2_style_2{
        margin-right: 0 !important;
    }
}


























.stm_layout_photographer .stm_iconbox_style_6 {
	padding: 44px 30px;
}

.stm_layout_photographer .stm_donation_style_2 .stm_donation__details-wrapper {
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

.stm_donation_style_1 .stm_donation__progress-bar {
	background: #000 !important;
}

.stm_staff_grid_style_4 .stm_staff__socials li a {
	color: #000 !important;
}

.stm_layout_photographer  div.product .woocommerce-tabs ul.tabs li a {
    transition: .3s ease;
}

.stm_layout_photographer  div.product .woocommerce-tabs ul.tabs li:not(.active) {
    background: transparent !important;
}
.stm_layout_photographer  div.product .woocommerce-tabs ul.tabs li:not(.active) a {
    color: #000 !important;
}

.stm_layout_photographer.woocommerce .widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle {
    transform: none;
    border-radius: 50%;
}