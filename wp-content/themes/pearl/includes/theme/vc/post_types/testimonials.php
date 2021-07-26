<?php
add_action('vc_before_init', 'pearl_testimonials_VC');

function pearl_testimonials_VC()
{


    vc_map(array(
        'name' => esc_html__('Pearl Testimonials', 'pearl'),
        'base' => 'stm_testimonials',
        'description' => esc_html__('Reviews from customers', 'pearl'),
        'icon' => 'pearl-testimonials',
        'category' => esc_html__('Carousels', 'pearl'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'pearl'),
                'param_name' => 'title'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Show number', 'pearl'),
                'param_name' => 'number'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Carousel', 'pearl'),
                'param_name' => 'carousel',
                'value' => array(
                    esc_html__('Enable', 'pearl') => 'true',
                    esc_html__('Disable', 'pearl') => 'false',
                ),
                'std' => 'true'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Show number in row', 'pearl'),
                'param_name' => 'number_row',
                'std' => 1,
                'dependency' => array(
                    'element' => 'carousel',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show number in row', 'pearl'),
                'param_name' => 'list_number_row',
                'value' => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '6' => 6,
                ),
                'dependency' => array(
                    'element' => 'carousel',
                    'value' => 'false'
                ),
                'std' => 'false',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show Image', 'pearl'),
                'param_name' => 'show_image',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'style_1',
                        'style_2',
                        'style_3',
                        'style_4',
                        'style_5',
                        'style_6',
                        'style_7',
                        'style_8',
                        'style_9',
                        'style_10',
                        'style_11',
                        'style_12',
                        'style_13',
                        'style_14',
                        'style_15',
                        'style_16',
                        'style_21',
                        'style_22',
                    )
                ),
                'std' => 'true'
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show Image bullets', 'pearl'),
                'param_name' => 'show_image_bullets',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'style_18',
                        'style_24',
                        'style_26',
                    )
                ),
                'std' => 'false'
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show Partners Logo', 'pearl'),
                'param_name' => 'show_partners_logo',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'style_17'
                    )
                ),
                'std' => 'false'
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Loop', 'pearl'),
                'param_name' => 'loop',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'style_20'
                    )

                ),
                'std' => 'true'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Autoscroll', 'pearl'),
                'param_name' => 'autoscroll',
                'value' => array(
                    esc_html__('Enable', 'pearl') => 'true',
                    esc_html__('Disable', 'pearl') => 'false',
                ),
                'dependency' => array(
                    'element' => 'carousel',
                    'value' => 'true'
                ),
                'std' => 'false',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Show review text symbols', 'pearl'),
                'param_name' => 'crop',
                'std' => '',
                'description' => esc_html__('You can set number of symbols to crop review text', 'pearl'),
            ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Margins', 'pearl'),
				'param_name' => 'margin',
				'std' => '30',
				'description' => esc_html__('Set margins between slides', 'pearl'),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Enable center mode', 'pearl'),
				'param_name' => 'center_mode',
				'value' => array(
					esc_html__('Enabled', 'pearl') => 'true',
					esc_html__('Disabled', 'pearl') => 'false',
				),
				'std' => 'false',
			),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show bullets', 'pearl'),
                'param_name' => 'bullets',
                'value' => array(
                    esc_html__('Show', 'pearl') => 'true',
                    esc_html__('Hide', 'pearl') => 'false',
                ),
                'dependency' => array(
                    'element' => 'carousel',
                    'value' => 'true'
                ),
                'std' => 'true',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show arrows', 'pearl'),
                'param_name' => 'arrows',
                'dependency' => array(
                    'element' => 'carousel',
                    'value' => 'true'
                ),
                'value' => array(
                    esc_html__('Show', 'pearl') => 'true',
                    esc_html__('Hide', 'pearl') => 'false',
                ),
                'std' => 'false',
            ),

            array(
                'type' => 'textfield',
                'heading' => esc_html__('Avatar size', 'pearl'),
                'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'pearl'),
                'param_name' => 'img_size',
                'value' => '100x100'
            ),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
            pearl_load_styles(26, 'style', true),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Extra class name', 'pearl'),
                'param_name'  => 'el_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'pearl')
            )
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Testimonials extends WPBakeryShortCode
    {
    }
}