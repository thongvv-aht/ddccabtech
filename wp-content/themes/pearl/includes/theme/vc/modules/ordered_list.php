<?php
add_action('vc_after_init', 'pearl_moduleVC_ordered_list');

function pearl_moduleVC_ordered_list()
{
    vc_map(array(
        'name'        => esc_html__('Pearl Ordered List', 'pearl'),
        'base'        => 'stm_ordered_list',
        'icon'        => 'stmicon-list',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Ordered list with number', 'pearl'),
		'params'      => array(
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__('List', 'pearl'),
                'param_name' => 'list',
                'value'      => urlencode(json_encode(array(
                    array(
                        'label'       => esc_html__('List Item Text', 'pearl'),
                        'admin_label' => true
                    ),
                ))),
                'params'     => array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Text', 'pearl'),
						'param_name'  => 'text',
						'admin_label' => true,
					),
                ),
            ),
            array(
            	'type' => 'colorpicker',
				'heading'     => esc_html__('Number\'s background color', 'pearl'),
				'param_name' => 'color',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Starts with leading zero (ex. 01)', 'pearl'),
                'param_name' => 'leading_zero',
                'std' => 'true'
            ),
            pearl_load_styles(1)
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_ordered_list extends WPBakeryShortCode
    {
    }
}

