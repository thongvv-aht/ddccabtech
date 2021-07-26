<?php
    global $VISUAL_COMPOSER_EXTENSIONS;	
    $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
		"name"                          => __( "TS Basic Pricing Table", "ts_visual_composer_extend" ),
		"base"                          => "TS-VCSC-Pricing-Table",
		"icon"                          => "ts-composer-element-icon-pricing-table",
		"category"                      => __( "Composium", "ts_visual_composer_extend" ),
		"description" 		            => __("Place a basic pricing table", "ts_visual_composer_extend"),
		"js_view"     					=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorLivePreview == "true" ? "TS_VCSC_PricingTableViewCustom" : ""),
		"admin_enqueue_js"            	=> "",
		"admin_enqueue_css"           	=> "",
		"params"                        => array(
			// Pricing Table Settings
			array(
				"type"				    => "seperator",
				"param_name"		    => "seperator_1",
				"seperator"				=> "Pricing Table Settings",
			),
			array(
				"type"			        => "dropdown",
				"heading"               => __( "Design", "ts_visual_composer_extend" ),
				"param_name"            => "style",
				"admin_label"           => true,
				"value"			        => array(
					__( "Style 1", "ts_visual_composer_extend")          => "1",
					__( "Style 2", "ts_visual_composer_extend" )         => "2",
					__( "Style 3", "ts_visual_composer_extend" )         => "3",
					__( "Style 4", "ts_visual_composer_extend" )         => "4",
					__( "Style 5", "ts_visual_composer_extend" )         => "5",
				),
			),
			array(
				"type"                  => "switch_button",
				"heading"               => __( "Featured Table", "ts_visual_composer_extend" ),
				"param_name"            => "featured",
				"value"                 => "false",
				"description"           => __( "Switch the toggle if this table will be a featured table.", "ts_visual_composer_extend" )
			),
			array(
				"type"                  => "textfield",
				"heading"               => __( "Plan", "ts_visual_composer_extend" ),
				"param_name"            => "featured_text",
				"value"                 => "Recommended",
				"dependency"            => array( 'element' => "style", 'value' => "3" )
			),
			array(
				"type"                  => "textfield",
				"heading"               => __( "Plan", "ts_visual_composer_extend" ),
				"param_name"            => "plan",
				"value"                 => "Basic",
				"admin_label"           => true,
			),
            array(
                "type"					=> "dropdown",
                "heading"				=> __( "Plan Wrap", "ts_visual_composer_extend" ),
                "param_name"			=> "plan_wrap",
                "width"					=> 150,
                "value"					=> array(
                    __( "Standard DIV", "ts_visual_composer_extend" )		=> "div",
                    __( "H1", "ts_visual_composer_extend" )					=> "h1",
                    __( "H2", "ts_visual_composer_extend" )					=> "h2",
                    __( "H3", "ts_visual_composer_extend" )					=> "h3",
                    __( "H4", "ts_visual_composer_extend" )					=> "h4",
                    __( "H5", "ts_visual_composer_extend" )					=> "h5",
                    __( "H6", "ts_visual_composer_extend" )					=> "h6",
                ),
                "description"			=> __( "Select in which DOM element type the title should be wrapped in; specific theme styling might apply.", "ts_visual_composer_extend" ),
                "standard"				=> "h3",
                "std"					=> "h3",
                "default"				=> "h3",
            ),	
			array(
				"type"                  => "textfield",
				"heading"               => __( "Cost", "ts_visual_composer_extend" ),
				"param_name"            => "cost",
				"value"                 => "$20",
				"admin_label"           => true,
			),
			array(
				"type"		            => "textfield",
				"heading"               => __( "Per (optional)", "ts_visual_composer_extend" ),
				"param_name"            => "per",
				"value"                 => "/ month",
				"dependency"            => array( 'element' => "style", 'value' => array("1", "3", "4", "5") )
			),
			array(
				"type"		            => "textarea_html",
				"heading"               => __( "Features", "ts_visual_composer_extend" ),
				"param_name"            => "content",
				"value"                 => "<ul>
											<li>30GB Storage</li>
											<li>512MB Ram</li>
											<li>10 databases</li>
											<li>1,000 Emails</li>
											<li>25GB Bandwidth</li>
										</ul>",
			),
			// Link Settings
			array(
				"type"				    => "seperator",
				"param_name"		    => "seperator_2",
				"seperator"				=> "Link Settings",
				"group" 				=> "Link Settings",
			),
			array(
				"type"			        => "dropdown",
				"heading"               => __( "Link Style", "ts_visual_composer_extend" ),
				"param_name"            => "link_type",
				"admin_label"           => true,
				"value"			        => array(
					__( "Default Link Button", "ts_visual_composer_extend")		=> "default",
					__( "Flat Button", "ts_visual_composer_extend")				=> "flat",
					__( "Custom Code Block", "ts_visual_composer_extend" )		=> "custom",
					__( "No Link", "ts_visual_composer_extend" )         		=> "none",
				),
				"group"					=> "Link Settings"
			),
			array(
				"type"			        => "textfield",
				"heading"		        => __( "Button: Text", "ts_visual_composer_extend" ),
				"param_name"	        => "button_text",
				"value"			        => "Purchase",
				"description"	        => __( "Button: Text", "ts_visual_composer_extend" ),
				"dependency"			=> array( 'element' => "link_type", 'value' => array('default', 'flat') ),
				"group"					=> "Link Settings"
			),
			array(
				"type"			        => "textfield",
				"heading"		        => __( "Button: URL", "ts_visual_composer_extend" ),
				"param_name"	        => "button_url",
				"value"			        => "",
				"description"	        => __( "Button: URL", "ts_visual_composer_extend" ),
				"dependency"			=> array( 'element' => "link_type", 'value' => array('default', 'flat') ),
				"group"					=> "Link Settings"
			),
			array(
				"type"			        => "dropdown",
				"heading"               => __( "Button: Link Target", "ts_visual_composer_extend" ),
				"param_name"	        => "button_target",
				"value"             => array(
					__( "Same Window", "ts_visual_composer_extend" )                    => "_parent",
					__( "New Window", "ts_visual_composer_extend" )                     => "_blank"
				),
				"dependency"			=> array( 'element' => "link_type", 'value' => array('default', 'flat') ),
				"group"					=> "Link Settings"
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Button Color Style", "ts_visual_composer_extend" ),
				"param_name"            => "button_style",
				"width"                 => 300,
				"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Flat_Button_Default_Colors,
				"description"           => __( "Select the general color style for button.", "ts_visual_composer_extend" ),
				"dependency"			=> array( 'element' => "link_type", 'value' => 'flat' ),
				"group"					=> "Link Settings"
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Button Hover Style", "ts_visual_composer_extend" ),
				"param_name"            => "button_hover",
				"width"                 => 300,
				"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Flat_Button_Hover_Colors,
				"description"           => __( "Select the general hover style for button.", "ts_visual_composer_extend" ),
				"dependency"			=> array( 'element' => "link_type", 'value' => 'flat' ),
				"group"					=> "Link Settings"
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Button Font Size", "ts_visual_composer_extend" ),
				"param_name"            => "button_size",
				"value"                 => "16",
				"min"                   => "12",
				"max"                   => "30",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Select the font size for the button.", "ts_visual_composer_extend" ),
				"dependency"			=> array( 'element' => "link_type", 'value' => 'flat' ),
				"group"					=> "Link Settings"
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Button Width", "ts_visual_composer_extend" ),
				"param_name"            => "button_width",
				"value"                 => "80",
				"min"                   => "50",
				"max"                   => "100",
				"step"                  => "1",
				"unit"                  => '%',
				"description"           => __( "Define the width of the button in relation to the pricing table.", "ts_visual_composer_extend" ),
				"dependency"			=> array( 'element' => "link_type", 'value' => 'flat' ),
				"group"					=> "Link Settings"
			),
			array(
				"type"              	=> "textarea_raw_html",
				"heading"           	=> __( "Custom Code", "ts_visual_composer_extend" ),
				"param_name"        	=> "button_custom",
				"value"             	=> base64_encode(""),
				"description"       	=> __( "Enter the HTML code to build your custom link (button).", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "link_type", 'value' => 'custom' ),
				"group"					=> "Link Settings"
			),
			// Graphic Settings
			array(
				"type"				    => "seperator",
				"param_name"		    => "seperator_3",
				"seperator"				=> "Icon / Image Settings",
				"group" 				=> "Style Settings",
			),
			array(
				"type"			        => "dropdown",
				"class"			        => "",
				"heading"               => __( "Icon / Image Addition", "ts_visual_composer_extend" ),
				"param_name"	        => "graphic_type",
				"value"             	=> array(
					__( "None", "ts_visual_composer_extend" )                    		=> "none",
					__( "Font Icon", "ts_visual_composer_extend" )                     	=> "icon",
					__( "Image", "ts_visual_composer_extend" )                     		=> "image",
				),
				"group"					=> "Style Settings"
			),
			array(
				"type"			        => "dropdown",
				"class"			        => "",
				"heading"               => __( "Icon / Image Placement", "ts_visual_composer_extend" ),
				"param_name"	        => "graphic_position",
				"value"             	=> array(
					__( "Above Title", "ts_visual_composer_extend" )					=> "title",
					__( "Above Content", "ts_visual_composer_extend" )					=> "content",
				),
				"dependency"        	=> array( 'element' => "graphic_type", 'value' => array('icon', 'image') ),
				"group"					=> "Style Settings"
			),
			array(
				"type" 					=> "icons_panel",
				'heading' 				=> __( 'Select Icon', 'ts_visual_composer_extend' ),
				'param_name' 			=> 'graphic_icon',
				'value'					=> '',
				"settings" 				=> array(
					"emptyIcon" 				=> false,
					'emptyIconValue'			=> 'transparent',
					"type" 						=> 'extensions',
				),
				"description"       	=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorVisualSelector == "true" ? __( "Select the icon you want to display.", "ts_visual_composer_extend" ) : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorString),
				"dependency"        	=> array( 'element' => "graphic_type", 'value' => 'icon' ),
				"group"					=> "Style Settings"
			),			
			array(
				"type"                  => "colorpicker",
				"heading"               => __( "Icon Color", "ts_visual_composer_extend" ),
				"param_name"            => "graphic_color",
				"value"                 => "#333333",
				"description"           => __( "Define the color of the icon.", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "graphic_type", 'value' => 'icon' ),
				"group"					=> "Style Settings"
			),
			array(
				"type"              	=> "attach_image",
				"heading"           	=> __( "Select Image", "ts_visual_composer_extend" ),
				"param_name"        	=> "graphic_image",
				"value"             	=> "",
				"description"       	=> __( "Image must have equal dimensions for scaling purposes (i.e. 100x100).", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "graphic_type", 'value' => 'image' ),
				"group"					=> "Style Settings"
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Icon / Image Size", "ts_visual_composer_extend" ),
				"param_name"            => "graphic_size",
				"value"                 => "30",
				"min"                   => "20",
				"max"                   => "200",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Select the size (width) for the icon or image.", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "graphic_type", 'value' => array('icon', 'image') ),
				"group"					=> "Style Settings"
			),
			// Box Shadow Settings
			array(
				"type"				    => "seperator",
				"param_name"		    => "seperator_4",
				"seperator"				=> "Shadow Settings",
				"group" 				=> "Style Settings",
			),
			array(
				"type"                  => "switch_button",
				"heading"               => __( "Add Box-Shadow", "ts_visual_composer_extend" ),
				"param_name"            => "shadow_enabled",
				"value"                 => "true",
				"description"           => __( "Switch the toggle if you want to apply a box shadow effect to the table.", "ts_visual_composer_extend" ),
				"group"					=> "Style Settings"
			),
			array(
				"type"                  => "colorpicker",
				"heading"               => __( "Featured Standard Shadow Color", "ts_visual_composer_extend" ),
				"param_name"            => "shadow_featured_default",
				"value"                 => "rgba(0, 0, 0, 0.15)",
				"description"           => __( "Define the shadow color for the featured pricing table.", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "shadow_enabled", 'value' => 'true' ),
				"group"					=> "Style Settings"
			),
			array(
				"type"                  => "colorpicker",
				"heading"               => __( "Featured Hover Shadow Color", "ts_visual_composer_extend" ),
				"param_name"            => "shadow_featured_hover",
				"value"                 => "rgba(129, 215, 66, 0.5)",
				"description"           => __( "Define the hover shadow color for the featured pricing table.", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "shadow_enabled", 'value' => 'true' ),
				"group"					=> "Style Settings"
			),
			array(
				"type"                  => "colorpicker",
				"heading"               => __( "Hover Shadow Color", "ts_visual_composer_extend" ),
				"param_name"            => "shadow_standard_hover",
				"value"                 => "rgba(55, 188, 229, 0.5)",
				"description"           => __( "Define the the hover shadow color for the pricing table.", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "shadow_enabled", 'value' => 'true' ),
				"group"					=> "Style Settings"
			),
			// Other Settings
			array(
				"type"				    => "seperator",
				"param_name"		    => "seperator_5",
				"seperator"				=> "Other Settings",
				"group" 				=> "Other Settings",
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Margin: Top", "ts_visual_composer_extend" ),
				"param_name"            => "margin_top",
				"value"                 => "0",
				"min"                   => "0",
				"max"                   => "200",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
				"group" 				=> "Other Settings",
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Margin: Bottom", "ts_visual_composer_extend" ),
				"param_name"            => "margin_bottom",
				"value"                 => "0",
				"min"                   => "0",
				"max"                   => "200",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
				"group" 				=> "Other Settings",
			),
			array(
				"type"              	=> "textfield",
				"heading"           	=> __( "Define ID Name", "ts_visual_composer_extend" ),
				"param_name"        	=> "el_id",
				"value"             	=> "",
				"description"       	=> __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
				"group" 				=> "Other Settings",
			),
			array(
				"type"                  => "tag_editor",
				"heading"           	=> __( "Extra Class Names", "ts_visual_composer_extend" ),
				"param_name"            => "el_class",
				"value"                 => "",
				"description"      		=> __( "Enter additional class names for the element.", "ts_visual_composer_extend" ),
				"group" 				=> "Other Settings",
			),
		)
	);	
	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
		return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
	} else {			
		vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
	};
?>