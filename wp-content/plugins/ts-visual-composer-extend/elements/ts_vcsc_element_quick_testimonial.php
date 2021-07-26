<?php
    global $VISUAL_COMPOSER_EXTENSIONS;	
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Quick_Testimonial'))) {
		class WPBakeryShortCode_TS_VCSC_Quick_Testimonial extends WPBakeryShortCode {};
	};
    $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
		"name"                      		=> __( "TS Quick Testimonial", "ts_visual_composer_extend" ),
		"base"                      		=> "TS_VCSC_Quick_Testimonial",
		"icon" 	                    		=> "ts-composer-element-icon-quick-testimonial",
		"category"                  		=> __( "Composium", "ts_visual_composer_extend" ),
		"description"               		=> __("Place a single testimonial element", "ts_visual_composer_extend"),
		"admin_enqueue_js"        			=> "",
		"admin_enqueue_css"       			=> "",
		"js_view"     						=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorLivePreview == "true" ? "TS_VCSC_QuickTestimonialViewCustom" : ""),
		"params"                    		=> array(
			// Testimonial Content
			array(
				"type"              		=> "seperator",
				"param_name"        		=> "seperator_1",
				"seperator"         		=> "Testimonial Content",
			),
			array(
				"type"                  	=> "attach_image",
				"heading"               	=> __( "Avatar", "ts_visual_composer_extend" ),
				"param_name"            	=> "avatar",
				"value"                 	=> "",
				"description"           	=> __( "Select the image you want to use as avatar for the author; otherwise, a default image will be used. Image should have square dimensions.", "ts_visual_composer_extend" ),
			),				
			array(
				"type"                      => "hidden_input",
				"heading"                   => __( "Placeholder", "ts_visual_composer_extend" ),
				"param_name"                => "placeholder",
				"value"                     => TS_VCSC_GetResourceURL('images/defaults/default_person.jpg'),
				'save_always' 				=> true,
			),				
			array(
				"type"                      => "textfield",
				"heading"                   => __( "Name / Author", "ts_visual_composer_extend" ),
				"param_name"                => "author",
				"value"                     => "",
				"description"               => __( "Enter the name of the person this testimonial or quote is associated with.", "ts_visual_composer_extend" ),
			),
			array(
				"type"                      => "textfield",
				"heading"                   => __( "Position / Title", "ts_visual_composer_extend" ),
				"param_name"                => "position",
				"value"                     => "",
				"description"               => __( "Enter the position or title of the person this testimonial or quote is associated with.", "ts_visual_composer_extend" ),
			),
			array(
				"type"		            	=> "textarea_html",
				"heading"              	 	=> __( "Testimonial / Quote", "ts_visual_composer_extend" ),
				"param_name"            	=> "content",
				"value"                 	=> "",
				"admin_label"				=> false,
				"description"           	=> __( "Enter the testimonial or quote you want to show with this element.", "ts_visual_composer_extend" ),
			),
			// Testimonial Design
			array(
				"type"                      => "seperator",
				"param_name"                => "seperator_2",
				"seperator"					=> "Testimonial Style",
				"group"						=> "Style Settings",
			),
			array(
				"type"                      => "dropdown",
				"heading"                   => __( "Design", "ts_visual_composer_extend" ),
				"param_name"                => "style",
				"value"                     => array(
					__( 'Style 1', "ts_visual_composer_extend" )          => "style1",
					__( 'Style 2', "ts_visual_composer_extend" )          => "style2",
					__( 'Style 3', "ts_visual_composer_extend" )          => "style3",
					__( 'Style 4', "ts_visual_composer_extend" )          => "style4",
				),
				"admin_label"               => true,
				"group"						=> "Style Settings",
			),
			array(
				"type"              	    => "switch_button",
				"heading"                   => __( "Show Autor Name", "ts_visual_composer_extend" ),
				"param_name"                => "show_author",
				"value"                     => "true",
				"admin_label"		        => true,
				"description"               => __( "Switch the toggle if you want to show the author name for the testimonial.", "ts_visual_composer_extend" ),
				"group"						=> "Style Settings",
			),
			array(
				"type"              	    => "switch_button",
				"heading"                   => __( "Show Avatar", "ts_visual_composer_extend" ),
				"param_name"                => "show_avatar",
				"value"                     => "true",
				"admin_label"		        => true,
				"description"               => __( "Switch the toggle if you want to show the user avatar for the testimonial.", "ts_visual_composer_extend" ),
				"group"						=> "Style Settings",
			),
			// Other Settings
			array(
				"type"                      => "seperator",
				"param_name"                => "seperator_3",
				"seperator"					=> "Other Settings",
				"group" 			        => "Other Settings",
			),
			array(
				"type"                      => "nouislider",
				"heading"                   => __( "Margin: Top", "ts_visual_composer_extend" ),
				"param_name"                => "margin_top",
				"value"                     => "0",
				"min"                       => "0",
				"max"                       => "200",
				"step"                      => "1",
				"unit"                      => 'px',
				"description"               => __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
				"group" 			        => "Other Settings",
			),
			array(
				"type"                      => "nouislider",
				"heading"                   => __( "Margin: Bottom", "ts_visual_composer_extend" ),
				"param_name"                => "margin_bottom",
				"value"                     => "0",
				"min"                       => "0",
				"max"                       => "200",
				"step"                      => "1",
				"unit"                      => 'px',
				"description"               => __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
				"group" 			        => "Other Settings",
			),
			array(
				"type"                      => "textfield",
				"heading"                   => __( "Define ID Name", "ts_visual_composer_extend" ),
				"param_name"                => "el_id",
				"value"                     => "",
				"description"               => __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
				"group" 			        => "Other Settings",
			),
			array(
				"type"                  	=> "tag_editor",
				"heading"           		=> __( "Extra Class Names", "ts_visual_composer_extend" ),
				"param_name"            	=> "el_class",
				"value"                 	=> "",
				"description"      			=> __( "Enter additional class names for the element.", "ts_visual_composer_extend" ),
				"group" 					=> "Other Settings",
			),
		)
	);	
	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
		return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
	} else {			
		vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
	};
?>