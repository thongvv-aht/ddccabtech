<?php
/*Default layout styles*/
$default = pearl_get_layout_config();

/*Colors*/
$main_color = pearl_get_option('main_color', $default['main_color']);
$secondary_color = pearl_get_option('secondary_color', $default['secondary_color']);
$third_color = pearl_get_option('third_color', $default['third_color']);

$elements_list = array(
	'colors' => array(
		'main_color' => array(
			'body .site-content .stm_widget_popular_posts_style_1 > ul > li > a:hover .stm_widget_popular_posts__title',
			'.stm_image_posts_slider_style_1 .owl-item:after',
			'.stm_image_posts_slider_style_1 .slider__thumbnail.active img',
			'.stm_custom_menu_style_3 .menu li:before',
			'.stm_custom_menu_style_3 .menu li:hover a'
		),
		'secondary_color' => array(),
		'third_color' => array()
	),
	'bg_colors' => array(
		'main_color' => array(
			'.stm_video_style_8 .stm_playb:after',
			'.stm_image_posts_slider_style_1 .slider__nav .owl-prev:hover',
			'.stm_image_posts_slider_style_1 .slider__nav .owl-next:hover',
			'.stm_header_style_15 .stm-navigation ul>li>ul>li:hover>a',
		),
		'secondary_color' => array(),
		'third_color' => array(
		)
	),
	'border_colors' => array(
		'main_color' => array(
			'body.stm_header_style_12 .stm-header__element_fullwidth_simple',
			'.pearl_arrow_top .arrow',
			'html body ul li.stm_megamenu > ul.sub-menu',
			'.stm_layout_personal_blog .stm_single_post_style_12 .stm_share a:hover,
            .stm_layout_personal_blog .stm_single_post_style_14 .stm_share a:hover,
            .stm_layout_personal_blog .stm_single_post_style_15 .stm_share a:hover,
			.stm_layout_personal_blog .stm_single_post_style_16 .stm_share a:hover',
			'.stm_image_posts_slider_style_1 .slider__nav .owl-prev:hover',
			'.stm_image_posts_slider_style_1 .slider__nav .owl-next:hover',
			'.stm_image_posts_slider_style_1 .slider__thumbnail.active img',
		),
		'secondary_color' => array(),
		'third_color' => array(),
	)
);

foreach ($elements_list['colors'] as $color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {color: <?php echo sanitize_text_field(${$color}); ?> !important}
<?php 
}

foreach ($elements_list['bg_colors'] as $bg_color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {background-color: <?php echo sanitize_text_field(${$bg_color}); ?> !important}
<?php 
}

foreach ($elements_list['border_colors'] as $border_color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {border-color: <?php echo sanitize_text_field(${$border_color}); ?> !important}
<?php 
} ?>


.stm_lists_style_10 .site-content ul > li:before {
top:5px;
line-height: 25px !important;
}

.stm_lists_style_10 .site-content ul > li {
font-size:16px;
}

.amp-wp-article .stm_markup__sidebar_divider {
    display: none !important;
}

.stm_layout_magazine .stm_projects_carousel .owl-controls {
    display: none;
}

.stm_post_style_21.archive .stm_markup:not(.stm_markup_right) .stm_loop__grid,
.stm_post_style_21.archive .stm_markup:not(.stm_markup_right) .stm_loop__list{
    margin: 0;
}

.archive .stm_post_details{
    padding: 15px;
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