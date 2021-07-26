<?php
add_action('vc_after_init', 'pearl_moduleVC_infobox');

function pearl_moduleVC_infobox()
{
    vc_map(array(
        'name'     => esc_html__('Pearl Infobox', 'pearl'),
        'base'     => 'stm_infobox',
        'icon'     => 'stmicon-flag',
        'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'description' => esc_html__('Text information', 'pearl'),
		'params'   => array(
            array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Infobox Image', 'pearl'),
                'param_name' => 'image'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Image Size', 'pearl'),
                'param_name'  => 'image_size',
                'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl'),
                'std' => '500x335'
            ),
            array(
                'type'        => 'colorpicker',
                'heading'     => esc_html__('Background Color', 'pearl'),
                'param_name'  => 'bg_color',
                'description' => esc_html__('Choose background color', 'pearl'),
                'dependency' => array(
                    'element' => 'style',
                    'value'   => 'style_15'
                )
            ),
            array(
                'type'        => 'colorpicker',
                'heading'     => esc_html__('Background Color On Hover', 'pearl'),
                'param_name'  => 'bg_color_hover',
                'description' => esc_html__('Choose background color for hover event', 'pearl'),
                'dependency' => array(
                    'element' => 'style',
                    'value'   => 'style_15'
                )
            ),
            array(
                'type'       => 'iconpicker',
                'heading'    => esc_html__('Icon', 'pearl'),
                'param_name' => 'icon',
                'value'      => '',
                'dependency' => array(
                    'element' => 'style',
                    'value'   => 'style_13'
                )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Infobox URL', 'pearl'),
                'param_name'  => 'url',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Link title attribute', 'pearl'),
                'param_name'  => 'link_title',
            ),
            array(
                'type'       => 'textarea_html',
                'heading'    => esc_html__('Text', 'pearl'),
                'holder'     => 'div',
                'param_name' => 'content'
            ),
            pearl_load_styles(15),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor()
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Infobox extends WPBakeryShortCode
    {
    }
}