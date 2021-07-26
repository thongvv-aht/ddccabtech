<?php
	global $VISUAL_COMPOSER_EXTENSIONS;	
    $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
		"name"                          => __( "TS Modal Popup", "ts_visual_composer_extend" ),
		"base"                          => "TS-VCSC-Modal-Popup",
		"icon" 	                        => "ts-composer-element-icon-modal-popup",
		"category"                      => __( "Composium", "ts_visual_composer_extend" ),
		"description"                   => __("Place a modal popup element", "ts_visual_composer_extend"),
		"admin_enqueue_js"              => "",
		"admin_enqueue_css"             => "",
		"params"                        => array(
			// Modal Settings
			array(
				"type"                  => "seperator",
				"param_name"            => "seperator_1",
				"seperator"             => "Modal Popup Settings",
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Transition Effect", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_effect",
				"width"                 => 150,
				"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Animations,
				"default" 				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxDefaultAnimation,
				"std" 					=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxDefaultAnimation,
				"admin_label"           => true,
				"description"           => __( "Select the transition effect to be used for the image in the lightbox.", "ts_visual_composer_extend" ),
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Backlight Color", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_backlight_choice",
				"width"                 => 150,
				"value"                 => array(
					__( 'Predefined Color', "ts_visual_composer_extend" )	=> "predefined",
					__( 'Custom Color', "ts_visual_composer_extend" )		=> "customized",
				),
				"description"           => __( "Select the (backlight) color style for the popup box.", "ts_visual_composer_extend" ),
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Select Backlight Color", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_backlight_color",
				"width"                 => 150,
				"value"                 => array(
					__( 'Default', "ts_visual_composer_extend" )      		=> "#0084E2",
					__( 'Neutral', "ts_visual_composer_extend" )      		=> "#FFFFFF",
					__( 'Success', "ts_visual_composer_extend" )      		=> "#4CFF00",
					__( 'Warning', "ts_visual_composer_extend" )      		=> "#EA5D00",
					__( 'Error', "ts_visual_composer_extend" )        		=> "#CC0000",
					__( 'None', "ts_visual_composer_extend" )         		=> "rgba(0,0,0,0)",
				),
				"description"           => __( "Select the predefined backlight color for the modal popup.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_backlight_choice", 'value' => 'predefined' )
			),
			array(
				"type"              	=> "colorpicker",
				"heading"           	=> __( "Select Backlight Color", "ts_visual_composer_extend" ),
				"param_name"        	=> "lightbox_backlight_custom",
				"value"             	=> "#000000",
				"description"       	=> __( "Define a custom backlight color for the modal popup.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_backlight_choice", 'value' => 'customized' )
			),
			/*array(
				"type"                  => "switch_button",
				"heading"			    => __( "Show on Page Load", "ts_visual_composer_extend" ),
				"param_name"		    => "content_open",
				"value"                 => "false",
				"admin_label"           => true,
				"description"		    => __( "Switch the toggle if you want show the popup on page load (limit to one per page).", "ts_visual_composer_extend" ),
			),*/
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Open Modal Popup", "ts_visual_composer_extend" ),
				"param_name"            => "content_open",
				"width"                 => 150,
				"value"                 => array(
					__( 'Manual Trigger', "ts_visual_composer_extend" )			=> "false",
					__( 'After Page Load', "ts_visual_composer_extend" )		=> "true",
					__( 'After In-View Scroll', "ts_visual_composer_extend" )	=> "inview",
				),
				"admin_label"           => true,
				"description"           => __( "Select when and how the modal popup should be opened.", "ts_visual_composer_extend" ),
			),
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "Hide Popup Trigger on Page", "ts_visual_composer_extend" ),
				"param_name"		    => "content_open_hide",
				"value"                 => "false",
				"description"		    => __( "Switch the toggle if you want to still show or hide the popup trigger on the page.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_open", 'value' => array('true', 'inview') )
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Time Delay", "ts_visual_composer_extend" ),
				"param_name"            => "content_open_delay",
				"value"                 => "0",
				"min"                   => "0",
				"max"                   => "10000",
				"step"                  => "50",
				"unit"                  => 'ms',
				"description"           => __( "Define the delay in ms until the modal popup should be shown after the trigger event.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_open", 'value' => array('true', 'inview') )
			),
			array(
				"type" 					=> "viewport_offset",
				"heading" 				=> __( "Viewport Offset", "ts_visual_composer_extend"),
				"param_name" 			=> "content_open_offset",
				"value" 				=> '50%',
				"description" 			=> __("Define the offset (top of screen) that should trigger the popup.", "ts_visual_composer_extend"),
				"dependency" 			=> array( 'element' => "content_open", 'value' => 'inview' ),
			),			
			// Custom Settings
			array(
				"type"                  => "seperator",
				"param_name"            => "seperator_2",
				"seperator"             => "Custom Settings",
			),
			/*array(
				"type"                  => "nouislider",
				"heading"               => __( "Custom Padding", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_custom_padding",
				"value"                 => "15",
				"min"                   => "0",
				"max"                   => "50",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Define a custom padding for the modal popup in order to create a simple frame effect.", "ts_visual_composer_extend" ),
			),*/
			// Modal Dimensions
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Lightbox Width", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_width",
				"width"                 => 150,
				"value"                 => array(
					__( 'Auto', "ts_visual_composer_extend" )                 	=> "auto",
					__( 'Set Width (%)', "ts_visual_composer_extend" )        	=> "widthpercent",
					__( 'Set Width (px)', "ts_visual_composer_extend" )       	=> "widthpixel",
				),
				"description"           => __( "Select the how the modal (lightbox) width should be determined.", "ts_visual_composer_extend" ),
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Lightbox Width", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_width_percent",
				"value"                 => "100",
				"min"                   => "25",
				"max"                   => "100",
				"step"                  => "1",
				"unit"                  => '%',
				"description"           => __( "Select lightbox width in percent.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_width", 'value' => 'widthpercent' )
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Lightbox Width", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_width_pixel",
				"value"                 => "1024",
				"min"                   => "1",
				"max"                   => "2048",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Select lightbox width in px.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_width", 'value' => 'widthpixel' )
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Lightbox Height", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_height",
				"width"                 => 150,
				"value"                 => array(
					__( 'Auto', "ts_visual_composer_extend" )                 	=> "auto",
					__( 'Set Height (%)', "ts_visual_composer_extend" )      	=> "heightpercent",
					__( 'Set Height (px)', "ts_visual_composer_extend" )      	=> "heightpixel",
				),
				"description"           => __( "Select the how the modal (lightbox) height should be determined.", "ts_visual_composer_extend" ),
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Lightbox Height", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_height_percent",
				"value"                 => "100",
				"min"                   => "25",
				"max"                   => "100",
				"step"                  => "1",
				"unit"                  => '%',
				"description"           => __( "Select lightbox height in px.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_height", 'value' => 'heightpercent' )
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Lightbox Height", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_height_pixel",
				"value"                 => "400",
				"min"                   => "100",
				"max"                   => "4096",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Select lightbox height in px.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_height", 'value' => 'heightpixel' )
			),				
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Custom Background", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_custom_background",
				"width"                 => 150,
				"value"                 => array(
					__( 'None', "ts_visual_composer_extend" )      		=> "none",
					__( 'Image', "ts_visual_composer_extend" )      	=> "image",
					__( 'Color', "ts_visual_composer_extend" )      	=> "color",
				),
				"description"           => __( "Select if you want to add a custom background to the modal popup element.", "ts_visual_composer_extend" ),
			),
			array(
				"type"                  => "attach_image",
				"heading"               => __( "Background Image", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_background_image",
				"value"                 => "",
				"description"           => __( "Select the background image for the modal popup element.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_custom_background", 'value' => 'image' ),
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Background Size", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_background_size",
				"width"                 => 150,
				"value" 				=> array(
					__( "Cover", "ts_visual_composer_extend" ) 			=> "cover",
					__( "150%", "ts_visual_composer_extend" )			=> "150%",
					__( "200%", "ts_visual_composer_extend" )			=> "200%",
					__( "Contain", "ts_visual_composer_extend" ) 		=> "contain",
					__( "Initial", "ts_visual_composer_extend" ) 		=> "initial",
					__( "Auto", "ts_visual_composer_extend" ) 			=> "auto",
				),
				"description"           => __( "Select how the custom background image should be sized.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_custom_background", 'value' => 'image' ),
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Background Repeat", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_background_repeat",
				"width"                 => 150,
				"value" 				=> array(
					__( "No Repeat", "ts_visual_composer_extend" )		=> "no-repeat",
					__( "Repeat X + Y", "ts_visual_composer_extend" )	=> "repeat",
					__( "Repeat X", "ts_visual_composer_extend" )		=> "repeat-x",
					__( "Repeat Y", "ts_visual_composer_extend" )		=> "repeat-y"
				),
				"description"           => __( "Select if and how the background image should be repeated.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_custom_background", 'value' => 'image' ),
			),				
			array(
				"type"              	=> "colorpicker",
				"heading"           	=> __( "Background Color", "ts_visual_composer_extend" ),
				"param_name"        	=> "lightbox_background_color",
				"value"             	=> "#ffffff",
				"description"       	=> __( "Define a custom background color for the modal popup element.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_custom_background", 'value' => 'color' )
			),
			array(
				"type"              	=> "switch_button",
				"heading"			    => __( "Create Lightbox Group", "ts_visual_composer_extend" ),
				"param_name"		    => "lightbox_group",
				"value"				    => "false",
				"description"		    => __( "Switch the toggle if you want the plugin to group this element with other lightbox elements on the page.", "ts_visual_composer_extend" ),
			),
			array(
				"type"                  => "textfield",
				"heading"               => __( "Group Name", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_group_name",
				"value"                 => "krautgroup",
				"description"           => __( "Enter an optional group name to manually build a group with other lightbox items.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_group", 'value' => 'true' ),
			),			
			// Modal Triggger
			array(
				"type"				    => "seperator",
				"param_name"		    => "seperator_3",
				"seperator"				=> "Modal Popup Trigger",
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Trigger Type", "ts_visual_composer_extend" ),
				"param_name"            => "content_trigger",
				"value"                 => array(
					__("Default Image", "ts_visual_composer_extend")          	=> "default",
					__("Custom Image", "ts_visual_composer_extend")           	=> "image",
					__("Font Icon", "ts_visual_composer_extend")              	=> "icon",
					__("Winged Button", "ts_visual_composer_extend")          	=> "winged",
					__("Simple Button", "ts_visual_composer_extend")          	=> "simple",
					__("Flat Icon Button", "ts_visual_composer_extend")       	=> "flaticon",
					__("Flat Button", "ts_visual_composer_extend")       		=> "flat",
					__("Text", "ts_visual_composer_extend")                   	=> "text",
					__("Custom HTML", "ts_visual_composer_extend")            	=> "custom",
					__("Other Shortcode", "ts_visual_composer_extend")			=> "shortcode",
				),
				"admin_label"           => true,
				"description"           => __( "Select the type of trigger to click on in order to show the lightbox.", "ts_visual_composer_extend" ),
				"group" 				=> "Trigger Settings",
			),
			// Custom Image
			array(
				"type"                  => "attach_image",
				"heading"               => __( "Select Image", "ts_visual_composer_extend" ),
				"param_name"            => "content_image",
				"value"                 => "",
				"description"           => __( "Select the preview image for the modal popup.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => 'image' ),
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "Simple Image Only", "ts_visual_composer_extend" ),
				"param_name"		    => "content_image_simple",
				"value"                 => "false",
				"description"		    => __( "Switch the toggle if you want display just the image without any styling.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => 'image' ),
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Auto Height Setting", "ts_visual_composer_extend" ),
				"param_name"            => "content_image_height",
				"width"                 => 150,
				"value"                 => array(
					__( '100% Height Setting', "ts_visual_composer_extend" )		=> "height: 100%;",
					__( 'Auto Height Setting', "ts_visual_composer_extend" )     	=> "height: auto;",
				),
				"description"           => __( "Select what CSS height setting should be applied to the image (change only if image height does not display correctly).", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => array('default', 'image') ),
				"group" 				=> "Trigger Settings",
			),
			// Font Icon
			array(
				"type" 					=> "icons_panel",
				'heading' 				=> __( 'Select Icon', 'ts_visual_composer_extend' ),
				'param_name' 			=> 'content_icon',
				'value'					=> '',
				"settings" 				=> array(
					"emptyIcon" 				=> false,
					'emptyIconValue'			=> 'transparent',
					"type" 						=> 'extensions',
				),
				"description"       	=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorVisualSelector == "true" ? __( "Select the icon you want to display.", "ts_visual_composer_extend" ) : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorString),
				"dependency"            => array( 'element' => "content_trigger", 'value' => array('icon', 'flaticon') ),
				"group" 				=> "Trigger Settings",
			),			
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Icon Size", "ts_visual_composer_extend" ),
				"param_name"            => "content_iconsize",
				"value"                 => "30",
				"min"                   => "16",
				"max"                   => "512",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Select the icon size", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => 'icon' ),
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"                  => "colorpicker",
				"heading"               => __( "Icon Color", "ts_visual_composer_extend" ),
				"param_name"            => "content_iconcolor",
				"value"                 => "#cccccc",
				"description"           => __( "Define the color of the icon.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => 'icon' ),
				"group" 				=> "Trigger Settings",
			),
			// Flat Button
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Button Color Style", "ts_visual_composer_extend" ),
				"param_name"            => "content_buttonstyle",
				"width"                 => 300,
				"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Flat_Button_Default_Colors,
				"description"           => __( "Select the general color style for button.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => array('flat', 'flaticon') ),
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Button Hover Style", "ts_visual_composer_extend" ),
				"param_name"            => "content_buttonhover",
				"width"                 => 300,
				"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Flat_Button_Hover_Colors,
				"description"           => __( "Select the general hover style for button.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => array('flat', 'flaticon') ),
				"group" 				=> "Trigger Settings",
			),
			// Button
			array(
				"type"                  => "textfield",
				"heading"               => __( "Button Text", "ts_visual_composer_extend" ),
				"param_name"            => "content_buttontext",
				"value"                 => "View Popup",
				"description"           => __( "Enter the text for the button.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => array('winged', 'simple', 'flat', 'flaticon') ),
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Button Text Size", "ts_visual_composer_extend" ),
				"param_name"            => "content_buttonsize",
				"value"                 => "16",
				"min"                   => "12",
				"max"                   => "20",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Select the font size for the trigger button.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => array('flat', 'flaticon') ),
				"group" 				=> "Trigger Settings",
			),
			// Text Link
			array(
				"type"                  => "textfield",
				"heading"               => __( "Trigger Text", "ts_visual_composer_extend" ),
				"param_name"            => "content_text",
				"value"                 => "",
				"description"           => __( "Enter the trigger text for the modal popup.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => 'text' ),
				"group" 				=> "Trigger Settings",
			),
			// Custom Code
			array(
				"type"                  => "textarea_raw_html",
				"heading"               => __("Raw HTML", "ts_visual_composer_extend"),
				"param_name"            => "content_raw",
				"value"                 => base64_encode(""),
				"description"           => __("Enter your custom HTML code; code will be wrapped in appropriate link automatically.", "ts_visual_composer_extend"),
				"dependency"            => array( 'element' => "content_trigger", 'value' => 'custom' ),
				"group" 				=> "Trigger Settings",
			),
			// Other Shortcode
			array(
				"type"              	=> "textarea_raw_html",
				"heading"           	=> __( "Shortcode", "ts_visual_composer_extend" ),
				"param_name"        	=> "content_shortcode",
				"value"             	=> base64_encode(""),
				"description"       	=> __( "Enter the shortcode that will render the modal trigger; make sure that the shortcode output does NOT render any links by itself.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => 'shortcode' ),
				"group" 				=> "Trigger Settings",
			),
			// Title + Subtitle
			array(
				"type"                  => "textfield",
				"heading"               => __( "Title", "ts_visual_composer_extend" ),
				"param_name"            => "content_title",
				"value"                 => "",
				"description"           => __( "Enter a title for the modal popup trigger.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => array('image', 'default', 'simple', 'winged', 'icon', 'text', 'custom') ),
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"                  => "textfield",
				"heading"               => __( "Subtitle", "ts_visual_composer_extend" ),
				"param_name"            => "content_subtitle",
				"value"                 => "",
				"description"           => __( "Enter a subtitle for the modal popup trigger.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => array('winged') ),
				"group" 				=> "Trigger Settings",
			),
			// Tooltip Settings
			array(
				"type"				    => "seperator",
				"param_name"		    => "seperator_4",
				"seperator"				=> "Trigger Tooltip",
				"dependency"            => array( 'element' => "content_trigger", 'value' => array('image', 'default', 'simple', 'icon', 'text', 'custom', 'flat', 'flaticon') ),
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "Use Advanced Tooltip", "ts_visual_composer_extend" ),
				"param_name"		    => "content_tooltip_css",
				"value"                 => "true",
				"description"		    => __( "Switch the toggle if you want to apply am advanced tooltip to the image.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => array('image', 'default', 'simple', 'icon', 'text', 'custom', 'flat', 'flaticon') ),
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"				    => "textarea",
				"heading"			    => __( "Tooltip Content", "ts_visual_composer_extend" ),
				"param_name"		    => "content_tooltip_content",
				"value"				    => "",
				"description"		    => __( "Enter the tooltip content here (do not use quotation marks).", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_trigger", 'value' => array('image', 'default', 'simple', 'icon', 'text', 'custom', 'flat', 'flaticon') ),
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"				    => "dropdown",
				"heading"			    => __( "Tooltip Position", "ts_visual_composer_extend" ),
				"param_name"		    => "content_tooltip_position",
				"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Vertical,
				"description"		    => __( "Select the tooltip position in relation to the image.", "ts_visual_composer_extend" ),
				"dependency"		    => array( 'element' => "content_tooltip_css", 'value' => 'true' ),
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"				    => "dropdown",
				"heading"			    => __( "Tooltip Style", "ts_visual_composer_extend" ),
				"param_name"		    => "content_tooltip_style",
				"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Layouts,
				"description"		    => __( "Select the tooltip style.", "ts_visual_composer_extend" ),
				"dependency"		    => array( 'element' => "content_tooltip_css", 'value' => 'true' ),
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"				    => "dropdown",
				"heading"			    => __( "Tooltip Animation", "ts_visual_composer_extend" ),
				"param_name"		    => "content_tooltip_animation",
				"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Animations,
				"description"		    => __( "Select how the tooltip entry and exit should be animated once triggered.", "ts_visual_composer_extend" ),
				"dependency"		    => array( 'element' => "content_tooltip_css", 'value' => 'true' ),
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"					=> "nouislider",
				"heading"				=> __( "Tooltip X-Offset", "ts_visual_composer_extend" ),
				"param_name"			=> "tooltipster_offsetx",
				"value"					=> "0",
				"min"					=> "-100",
				"max"					=> "100",
				"step"					=> "1",
				"unit"					=> 'px',
				"description"			=> __( "Define an optional X-Offset for the tooltip position.", "ts_visual_composer_extend" ),
				"dependency"		    => array( 'element' => "content_tooltip_css", 'value' => 'true' ),
				"group" 				=> "Trigger Settings",
			),
			array(
				"type"					=> "nouislider",
				"heading"				=> __( "Tooltip Y-Offset", "ts_visual_composer_extend" ),
				"param_name"			=> "tooltipster_offsety",
				"value"					=> "0",
				"min"					=> "-100",
				"max"					=> "100",
				"step"					=> "1",
				"unit"					=> 'px',
				"description"			=> __( "Define an optional Y-Offset for the tooltip position.", "ts_visual_composer_extend" ),
				"dependency"		    => array( 'element' => "content_tooltip_css", 'value' => 'true' ),
				"group" 				=> "Trigger Settings",
			),		
			// Modal Content
			array(
				"type"				    => "seperator",
				"param_name"		    => "seperator_5",
				"seperator"				=> "Modal Popup Content",
				"group" 				=> "Content Settings",
			),
			array(
				"type"				    => "dropdown",
				"heading"			    => __( "Content Provider", "ts_visual_composer_extend" ),
				"param_name"		    => "content_provider",
				"value"                 => array(
					__("Provide Custom Content", "ts_visual_composer_extend")				=> "custom",
					__("Retrieve Content via ID", "ts_visual_composer_extend")				=> "identifier",
				),
				"description"		    => __( "Select how the content for the modal popup should be provided or retrieved.", "ts_visual_composer_extend" ),
				"group" 				=> "Content Settings",
			),
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "Show Modal Title", "ts_visual_composer_extend" ),
				"param_name"		    => "content_show_title",
				"value"                 => "true",
				"description"		    => __( "Switch the toggle if you want show a title in the modal popup.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_provider", 'value' => 'custom' ),
				"group" 				=> "Content Settings",
			),
			array(
				"type"                  => "textfield",
				"heading"               => __( "Modal Title", "ts_visual_composer_extend" ),
				"param_name"            => "title",
				"value"                 => "",
				"description"           => __( "Enter the title for the modal popup.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_show_title", 'value' => 'true' ),
				"group" 				=> "Content Settings",
			),
			array(
				"type"					=> "dropdown",
				"heading"				=> __( "Title Wrap", "ts_visual_composer_extend" ),
				"param_name"			=> "title_wrap",
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
				"dependency"            => array( 'element' => "content_show_title", 'value' => 'true' ),
				"group" 				=> "Content Settings",
			),			
			array(
				"type"                  => "textfield",
				"heading"               => __( "Unique ID Name", "ts_visual_composer_extend" ),
				"param_name"            => "content_retrieve",
				"value"                 => "",
				"description"           => __( "Enter the unique ID for the element that is used to provide the external content. You are responsible for the styling of the content; not all elements are suited to be shown in a lightbox.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_provider", 'value' => 'identifier' ),
				"group" 				=> "Content Settings",
			),				
			array(
				"type"		            => "textarea_html",
				"heading"               => __( "Modal Content", "ts_visual_composer_extend" ),
				"param_name"            => "content",
				"value"                 => "",
				"admin_label"           => false,
				"description"           => __( "Create the content for the modal popup.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_provider", 'value' => 'custom' ),
				"group" 				=> "Content Settings",
			),
			// Other Settings
			array(
				"type"				    => "seperator",
				"param_name"		    => "seperator_6",
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
				"type"                  => "textfield",
				"heading"               => __( "Define ID Name", "ts_visual_composer_extend" ),
				"param_name"            => "el_id",
				"value"                 => "",
				"description"           => __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
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