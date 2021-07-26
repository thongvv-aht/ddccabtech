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
        ),
        'secondary_color' => array(
        ),
        'third_color'     => array(
        )
    ),
    'bg_colors'     => array(
        'main_color'      => array(
            '.stm_carousel_style_1 .owl-nav .owl-prev',
            '.stm_carousel_style_1 .owl-nav .owl-next',
        ),
        'secondary_color' => array(
        ),
        'third_color'     => array(

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

.stm_testimonials_style_8 .stm_testimonial__carousel .stm_testimonials__meta .stm_testimonials__avatar {
    width: 100px;
    margin: 0 0 30px;
}

.stm_pagination_style_9 .owl-controls .owl-nav .owl-prev:before,
.stm_pagination_style_9 .owl-controls .owl-nav .owl-next:before {
    color: #fff !important;
}

@media (max-width: 1023px) {
    body.stm_header_style_9 .stm-navigation.stm-navigation__default ul li.menu-item-has-children.active>a:after {
        transform: rotate(180deg) !important;
    }
    
    .stm-navigation .stm_megamenu > ul > li.menu-item-has-children > a > .stm_mobile__dropdown:after {
        content: '';
        display: block !important;
        position: absolute;
        left: 50%;
        top: 50%;
        margin: -2px 0 0 -2px;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 5px 3.5px 0;
        border-color: #fff transparent transparent;
    }

    html body .stm-navigation__default ul li.stm_megamenu .stm_megaicon,
    .stm_megamenu > ul > li.menu-item-has-children > a > .stm_mobile__dropdown:after {
        display: none !important;
    }

    html body.stm_header_style_9 .stm-navigation__default ul li.stm_megamenu>ul.sub-menu>li:hover ul.sub-menu>li>a {
        color: #fff !important;
    }
}

