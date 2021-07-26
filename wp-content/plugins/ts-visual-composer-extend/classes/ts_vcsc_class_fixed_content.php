<?php
	if (!class_exists('TS_FixedContent_Block')){
		class TS_FixedContent_Block{
			function __construct(){
				global $VISUAL_COMPOSER_EXTENSIONS;
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						$this->TS_VCSC_Add_FixedContent_Block_Lean();
					} else if (function_exists('vc_map')) {
						add_action('init',                                  array($this, 'TS_VCSC_Add_FixedContent_Block_Elements'), 9999999);
					}
				} else {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_FixedContent_Block_Lean'), 9999999);
					} else if (function_exists('vc_map')) {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_FixedContent_Block_Elements'), 9999999);
					}
				}
				if ((is_admin() == false) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAJAX == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAlways == "true")) {
					add_shortcode('TS_VCSC_FixedContent_Block',			array($this, 'TS_VCSC_FixedContent_Block_Function'));
				}
			}
			
			// Register Element(s) via LeanMap
			function TS_VCSC_Add_FixedContent_Block_Lean() {
				vc_lean_map('TS_VCSC_FixedContent_Block',					array($this, 'TS_VCSC_Add_FixedContent_Block_Elements'), null);
			}
			
			function TS_VCSC_FixedContent_Block_Function($atts, $content = null){
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
				
				extract(shortcode_atts(array(
					// Anchor Settings
					'fixed_enable'					=> 'true',
					'fixed_anchor'					=> 'column',
					'fixed_zindex'					=> 9999,
					'fixed_position'				=> "topleft", 	// topleft, topcenter, topright, centerleft, centercenter, centerright, bottomleft, bottomcenter, bottomright
					'fixed_init'					=> "ready", 	// load, ready
					// Disable Settings
					'disable_screen'				=> 480,
					'disable_height'				=> 50,
					'disable_width'					=> 320,
					// Offset Settings
					'fixed_global'					=> "desktop:0px;tablet:0px;mobile:0px",
					'fixed_top'						=> "desktop:0px;tablet:0px;mobile:0px",
					'fixed_bottom'					=> "desktop:0px;tablet:0px;mobile:0px",
					'fixed_left'					=> "desktop:0px;tablet:0px;mobile:0px",
					'fixed_right'					=> "desktop:0px;tablet:0px;mobile:0px",
					// Width Settings					
					'width_type'					=> 'inherit', 	// inherit, full, pixel, percent
					'width_adjust'					=> 'false',
					'width_pixel'					=> 320,
					'width_percent'					=> 25,
					// Style Settings
					'style_adjust'					=> 'false',
					'style_fixedonly'				=> 'true',
					'style_background'				=> 'transparent', // transparent, color, gradient, image
					'style_color'					=> '#ffffff',
					'style_gradient'				=> '',
					'style_image'					=> '',
					'style_size' 					=> 'cover',
					'style_repeat' 					=> 'no-repeat',
					'style_position'				=> 'center center',
					'style_border'					=> '',
					'style_margin'					=> 'margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;',
					'style_padding'					=> 'padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;',
					// VC Class Names
					'class_modify'					=> 'false',
					'class_column'					=> 'wpb_column',
					'class_inner'					=> 'vc_row_inner',
					'class_row'						=> 'vc_row',
					'class_section'					=> 'vc_section',
					// Other Settings
					'conditionals'					=> '',
					'el_id' 						=> '',
					'el_class'                  	=> '',
					'css'							=> '',
				),$atts));
				
				// Check Conditional Output
				$render_conditionals				= (empty($conditionals) ? true : TS_VCSC_CheckConditionalOutput($conditionals));
				if (!$render_conditionals) {
					$myvariable 					= ob_get_clean();
					return $myvariable;
				}
				
				// Load Required Files
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					wp_enqueue_script('ts-extend-fixto');				
					wp_enqueue_script('ts-visual-composer-extend-front');
					wp_enqueue_script('ts-extend-fixedcontent');	
				}
				wp_enqueue_style('ts-visual-composer-extend-front');
				
				// Define Required Variables
				$ranomizer							= mt_rand(999999, 9999999);
				$classes							= array('wpb_column', 'vc_row_inner', 'vc_row', 'vc_section');
				$inline								= TS_VCSC_FrontendAppendCustomRules('style');
				$output 							= '';
				
				// Determine Element ID
				if (!empty($el_id)) {
					$fixedcontent_id				= $el_id;
				} else {
					$fixedcontent_id				= 'ts-fixed-content-container-' . $ranomizer;
				}
				
				// Check for Frontend Mode
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$fixed_enable					= "false";
				}
				
				// Enable/Disable Class
				if ($fixed_enable == "true") {
					$containerclass	 				= 'ts-fixed-content-container ts-fixed-content-' . $fixed_init . ' ts-fixed-content-' . $fixed_anchor . ' ts-fixed-content-enabled';
				} else {
					$containerclass					= 'ts-fixed-content-container ts-fixed-content-' . $fixed_init . ' ts-fixed-content-' . $fixed_anchor . ' ts-fixed-content-disabled';
				}
				
				// Data Attributes
				$fixed_data							= 'data-fixed-enabled="' . $fixed_enable . '" data-fixed-init="false" data-fixed-anchor="' . $fixed_anchor . '" data-fixed-position="' . $fixed_position . '" data-fixed-zindex="' . $fixed_zindex . '"';
				$fixed_data							.= ' data-offset-global="' . $fixed_global . '" data-offset-top="' . $fixed_top . '" data-offset-bottom="' . $fixed_bottom . '" data-offset-left="' . $fixed_left . '" data-offset-right="' . $fixed_right . '"';
				$fixed_data							.= ' data-class-column="' . ($class_modify == "true" ? $class_column : $classes[0]) . '" data-class-inner="' . ($class_modify == "true" ? $class_inner : $classes[1]) . '" data-class-row="' . ($class_modify == "true" ? $class_row : $classes[2]) . '" data-class-section="' . ($class_modify == "true" ? $class_section : $classes[3]) . '"';
				$fixed_data							.= ' data-width-type="' . $width_type . '" data-width-change="' . $width_adjust . '" data-width-pixel="' . $width_pixel . '" data-width-percent="' . $width_percent . '"';
				$fixed_data							.= ' data-disable-screen="' . $disable_screen . '" data-disable-width="' . $disable_width . '" data-disable-height="' . $disable_height . '"';
				
				// Style Settings
				$fixed_style						= '';
				if ($style_adjust == "true") {
					if ($inline == "false") {
						$fixed_style .= '<style id="' . $fixedcontent_id . '-style" type="text/css">';
					}
						if ($style_fixedonly == "true") {
							$fixed_style .= 'body #' . $fixedcontent_id . '.ts-fixed-content-container.ts-fixed-content-fixtofixed .ts-fixed-content-inner,';
							$fixed_style .= 'body #' . $fixedcontent_id . '.ts-fixed-content-container.ts-fixed-content-permanent .ts-fixed-content-inner {';
						} else {
							$fixed_style .= 'body #' . $fixedcontent_id . '.ts-fixed-content-container .ts-fixed-content-inner {';
						}
							if ($style_background == 'transparent') {
								$fixed_style		.= 'background-color: transparent; background-image: none;';
							} else if ($style_background == 'color') {
								$fixed_style		.= 'background-color: ' . $style_color . '; background-image: none;';
							} else if ($style_background == 'gradient') {
								$fixed_style		.= $style_gradient;
							} else if ($style_background == 'image') {
								$style_image		= wp_get_attachment_image_src($style_image, 'full');
								$style_image		= (isset($style_image[0]) ? $style_image[0] : '');
								if ($style_image != '') {
									$fixed_style	.= "background-color: transparent; background-image: url('" . $style_image . "');";
									$fixed_style	.= 'background-position: ' . $style_position . ';';
									$fixed_style	.= 'background-size: ' . $style_size . ';';
									$fixed_style	.= 'background-repeat: ' . $style_repeat . ';';
								} else {
									$fixed_style	.= "background-color: transparent; background-image: none;";
								}
							}
							$fixed_style			.= $style_border;
							$fixed_style			.= $style_margin;
							$fixed_style			.= $style_padding;
						$fixed_style .= '}';
					if ($inline == "false") {
						$fixed_style .= '</style>';
					}
					$fixed_style					= trim($fixed_style);
					if (($fixed_style != "") && ($inline == "true")) {
						wp_add_inline_style('ts-visual-composer-extend-custom', TS_VCSC_MinifyCSS($fixed_style));
					}					
				}
				
				// WP Bakery Page Builder Class Override
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, '' . $containerclass . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_FixedContent_Block', $atts);
				} else {
					$css_class 						= $containerclass . ' ' . $el_class;
				}
				
				
				// Custom Style Rules
				if (($fixed_style != "") && ($fixed_style == "false")) {
					$output .= TS_VCSC_MinifyCSS($fixed_style);
				}
				
				// Final Element Output
				$output .= '<div id="' . $fixedcontent_id . '" class="' . $css_class . '" ' . $fixed_data . '>';
					$output .= '<div class="ts-fixed-content-inner">';
						$output .= do_shortcode($content);
					$output .= '</div>';
				$output .= '</div>';
				
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
			function TS_VCSC_Add_FixedContent_Block_Elements() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name" 								=> __("TS Sticky Content Block", "ts_visual_composer_extend"),
					"base" 								=> "TS_VCSC_FixedContent_Block",
					"icon" 								=> "ts-composer-element-icon-fixcontent-container",
					"as_parent"                       	=> array('except' => implode(",", $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_AnyLayout_Excluded)),
					"category"                      	=> __( "Composium", "ts_visual_composer_extend" ),
					"description" 						=> "Fix content on the screen based on row or window position.",
					"controls" 							=> "full",
					"content_element"                   => true,
					"is_container" 						=> true,
					"container_not_allowed" 			=> true,
					"show_settings_on_create"           => false,
					"admin_enqueue_js"            		=> "",
					"admin_enqueue_css"           		=> "",
					"js_view" 							=> "VcColumnView",
					"params" 							=> array(
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_1a",
							"seperator"					=> "Sticky Settings",
						),
						array(
							"type"              		=> "messenger",
							"param_name"        		=> "messenger_1",
							"layout"					=> "info",
							"size"						=> "13",
							"message"            		=> __( "This element is intended to hold a single basic (non-interactive) content element. Please note that not every element in WP Bakery Page Builder is suitable to be used as (scroll) fixed element on the screen; add your content carefully.", "ts_visual_composer_extend" )
						),
						array(
							"type"              		=> "switch_button",
							"heading"			    	=> __( "Sticky: Active", "ts_visual_composer_extend" ),
							"param_name"		    	=> "fixed_enable",
							"value"             		=> "true",
							"admin_label"		        => true,
							"description"		    	=> __( "Switch the toggle if you want to fix the contents of this element on this page.", "ts_visual_composer_extend" )
						),
						array(
							"type" 						=> "dropdown",
							"heading" 					=> __( "Sticky: Anchor", "ts_visual_composer_extend" ),
							"param_name" 				=> "fixed_anchor",
							"value" => array(
								__( "Sticky Within Column", "ts_visual_composer_extend" )		=> 'column',
								__( "Sticky Within Row", "ts_visual_composer_extend" )   		=> 'row',
								__( "Sticky Within Section", "ts_visual_composer_extend" )		=> 'section',
								__( "Sticky Within Window", "ts_visual_composer_extend" )   	=> 'window',
								__( "Fix to Window", "ts_visual_composer_extend" )   			=> 'permanent',
							),
							"admin_label"		        => true,
							"description" 				=> __( "Select what anchor the content should be fixed to.", "ts_visual_composer_extend" ),
						),
						array(
							"type" 						=> "dropdown",
							"heading" 					=> __( "Sticky: Position", "ts_visual_composer_extend" ),
							"param_name" 				=> "fixed_position",
							"value" => array(
								__( "Top Left", "ts_visual_composer_extend" )					=> 'topleft',
								__( "Top Center", "ts_visual_composer_extend" )   				=> 'topcenter',
								__( "Top Right", "ts_visual_composer_extend" )					=> 'topright',
								__( "Center Left", "ts_visual_composer_extend" )   				=> 'centerleft',
								__( "Center Center", "ts_visual_composer_extend" )   			=> 'centercenter',
								__( "Center Right", "ts_visual_composer_extend" )   			=> 'centerright',
								__( "Bottom Left", "ts_visual_composer_extend" )   				=> 'bottomleft',
								__( "Bottom Center", "ts_visual_composer_extend" )   			=> 'bottomcenter',
								__( "Bottom Right", "ts_visual_composer_extend" )   			=> 'bottomright',
							),
							"dependency"            	=> array( 'element' => "fixed_anchor", 'value' => 'permanent'),
							"description" 				=> __( "Select where on the screen the contents of this element should be fixed at.", "ts_visual_composer_extend" ),
						),
						array(
							"type" 						=> "dropdown",
							"heading" 					=> __( "Sticky: Initialization", "ts_visual_composer_extend" ),
							"param_name" 				=> "fixed_init",
							"value" => array(
								__( "Page Ready Event", "ts_visual_composer_extend" )			=> 'ready',
								__( "Page Loaded Event", "ts_visual_composer_extend" )			=> 'load',
							),
							"admin_label"		        => true,
							"description" 				=> __( "Select at which point during the page loading process the element should be initialized.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Sticky: z-Index", "ts_visual_composer_extend" ),
							"param_name"        		=> "fixed_zindex",
							"value"             		=> "9999",
							"min"               		=> "99",
							"max"               		=> "999999",
							"step"              		=> "1",
							"unit"              		=> '',
							"description"       		=> __( "Define the z-index that should be applied to the sticky container in order to place it above other visible content.", "ts_visual_composer_extend" ),
						),
						// Position Offsets
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_1b",
							"seperator"					=> "Offset Settings",
						),						
						array(
							"type" 						=> "devicetype_selectors",
							"heading"           		=> __( "Offset: Top", "ts_visual_composer_extend" ),
							"param_name"        		=> "fixed_global",
							"unit"  					=> "px",
							"collapsed"					=> "true",
							"devices" 					=> array(
								"Desktop"           			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
								"Tablet"            			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
								"Mobile"            			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
							),
							"value"						=> "desktop:0px;tablet:0px;mobile:0px",
							"description"				=> __( "Define an additional scroll offset to account for menu bars and other top fixed elements.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "fixed_anchor", 'value' => array('column', 'row', 'section', 'window')),
						),
						array(
							"type" 						=> "devicetype_selectors",
							"heading"           		=> __( "Offset: Top", "ts_visual_composer_extend" ),
							"param_name"        		=> "fixed_top",
							"unit"  					=> "px",
							"collapsed"					=> "true",
							"devices" 					=> array(
								"Desktop"           			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
								"Tablet"            			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
								"Mobile"            			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
							),
							"value"						=> "desktop:0px;tablet:0px;mobile:0px",
							"description"				=> __( "Define an additional scroll offset to account for menu bars and other top fixed elements.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "fixed_position", 'value' => array('topleft', 'topcenter', 'topright', 'centerleft', 'centerright', 'centercenter')),
						),
						array(
							"type" 						=> "devicetype_selectors",
							"heading"           		=> __( "Offset: Bottom", "ts_visual_composer_extend" ),
							"param_name"        		=> "fixed_bottom",
							"unit"  					=> "px",
							"collapsed"					=> "true",
							"devices" 					=> array(
								"Desktop"           			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
								"Tablet"            			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
								"Mobile"            			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
							),
							"value"						=> "desktop:0px;tablet:0px;mobile:0px",
							"description"				=> __( "Define an additional scroll offset to account for menu bars and other bottom fixed elements.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "fixed_position", 'value' => array('bottomleft', 'bottomcenter', 'bottomright')),
						),
						array(
							"type" 						=> "devicetype_selectors",
							"heading"           		=> __( "Offset: Left", "ts_visual_composer_extend" ),
							"param_name"        		=> "fixed_left",
							"unit"  					=> "px",
							"collapsed"					=> "true",
							"devices" 					=> array(
								"Desktop"           			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
								"Tablet"            			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
								"Mobile"            			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
							),
							"value"						=> "desktop:0px;tablet:0px;mobile:0px",
							"description"				=> __( "Define an additional scroll offset to account for menu bars and other left fixed elements.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "fixed_position", 'value' => array('topleft', 'centerleft', 'bottomleft')),
						),
						array(
							"type" 						=> "devicetype_selectors",
							"heading"           		=> __( "Offset: Right", "ts_visual_composer_extend" ),
							"param_name"        		=> "fixed_right",
							"unit"  					=> "px",
							"collapsed"					=> "true",
							"devices" 					=> array(
								"Desktop"           			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
								"Tablet"            			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
								"Mobile"            			=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
							),
							"value"						=> "desktop:0px;tablet:0px;mobile:0px",
							"description"				=> __( "Define an additional scroll offset to account for menu bars and other right fixed elements.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "fixed_position", 'value' => array('topright', 'centerright', 'bottomright')),
						),
						// Width Settings
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_1c",
							"seperator"					=> "Width Settings",
							"dependency"            	=> array( 'element' => "fixed_anchor", 'value' => 'permanent'),
						),
						array(
							"type" 						=> "dropdown",
							"heading" 					=> __( "Width: Fixed Anchor", "ts_visual_composer_extend" ),
							"param_name" 				=> "width_type",
							"value" => array(
								__( "Inherit Column Width", "ts_visual_composer_extend" )			=> 'inherit',
								__( "Full Screen Width", "ts_visual_composer_extend" )				=> 'full',
								__( "Fixed Width in Pixel", "ts_visual_composer_extend" )			=> 'pixel',
								__( "Percentage of Screen", "ts_visual_composer_extend" )   		=> 'percent',
							),
							"description" 				=> __( "Select what width the fixed anchor should be using for its content; applicable offsets defined above will be deducted automatically.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "fixed_anchor", 'value' => 'permanent'),
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Width: Pixel", "ts_visual_composer_extend" ),
							"param_name"        		=> "width_pixel",
							"value"             		=> "320",
							"min"               		=> "50",
							"max"               		=> "1920",
							"step"              		=> "1",
							"unit"              		=> 'px',
							"description"       		=> __( "Select the width in pixel for the fixed content.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "width_type", 'value' => 'pixel'),
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Width: Percent", "ts_visual_composer_extend" ),
							"param_name"        		=> "width_percent",
							"value"             		=> "25",
							"min"               		=> "5",
							"max"               		=> "100",
							"step"              		=> "1",
							"unit"              		=> '%',
							"description"       		=> __( "Select the width in percent of the available screen size for the fixed content.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "width_type", 'value' => 'percent'),
						),
						// Disable Settings
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_1d",
							"seperator"					=> "Disable Settings",
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Sticky: Disable", "ts_visual_composer_extend" ),
							"param_name"        		=> "disable_screen",
							"value"             		=> "480",
							"min"               		=> "240",
							"max"               		=> "1024",
							"step"              		=> "1",
							"unit"              		=> 'px',
							"description"       		=> __( "Define at which screen width the fixed element should always return to its normal position within the page. If the screen width or height is insufficient to fully show the fixed content, it will become unfixed automatically.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Sticky: Maximum Height", "ts_visual_composer_extend" ),
							"param_name"        		=> "disable_height",
							"value"             		=> "50",
							"min"               		=> "5",
							"max"               		=> "100",
							"step"              		=> "1",
							"unit"              		=> '%',
							"description"       		=> __( "Define how much of the available window height the fixed element can take up before it will return to its normal position within the page.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Sticky: Maximum Width", "ts_visual_composer_extend" ),
							"param_name"        		=> "disable_width",
							"value"             		=> "320",
							"min"               		=> "200",
							"max"               		=> "1280",
							"step"              		=> "1",
							"unit"              		=> 'px',
							"description"       		=> __( "Define the maximum width the fixed element is allowed to have before it will return to its normal position within the page.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "width_type", 'value' => 'percent'),
						),
						// Style Settings
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_2a",
							"seperator"					=> "Style Settings",
							"group" 					=> "Style Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"			    	=> __( "Modify Styling", "ts_visual_composer_extend" ),
							"param_name"		    	=> "style_adjust",
							"value"             		=> "false",
							"description"		    	=> __( "Switch the toggle if you want to modify the styling of the container element that will be (scroll) fixed based on your selections before.", "ts_visual_composer_extend" ),
							"group" 					=> "Style Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"			    	=> __( "Apply to Fixed only", "ts_visual_composer_extend" ),
							"param_name"		    	=> "style_fixedonly",
							"value"             		=> "true",
							"description"		    	=> __( "Switch the toggle if you want to apply the custom styling only when the container element is actually (scroll) fixed.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "style_adjust", 'value' => 'true'),
							"group" 					=> "Style Settings",
						),
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Background Type", "ts_visual_composer_extend" ),
							"param_name"        		=> "style_background",
							"width"             		=> 300,
							"value"             		=> array(
								__( "Transparent Background", "ts_visual_composer_extend" )		=> "transparent",
								__( "Solid Color", "ts_visual_composer_extend" )				=> "color",
								__( "Gradient Background", "ts_visual_composer_extend" )		=> "gradient",
								__( "Custom Image", "ts_visual_composer_extend" )				=> "image",
							),
							"description"       		=> __( "Select the background type for the element.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "style_adjust", 'value' => 'true'),
							"group" 					=> "Style Settings",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "style_color",
							"value"             		=> "#ffffff",
							"description"       		=> __( "Select the background color for the element.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "style_background", 'value' => array('color', 'image') ),
							"group" 					=> "Style Settings",
						),			
						array(
							"type"						=> "advanced_gradient",
							"heading"					=> __("Gradient Background", "ts_visual_composer_extend"),						
							"param_name"				=> "style_gradient",
							"description"				=> __('Use the controls above to create a custom gradient background for the element.', 'ts_visual_composer_extend'),
							"dependency"        		=> array( 'element' => "style_background", 'value' => 'gradient' ),
							"group" 					=> "Style Settings",
						),
						array(
							"type"              		=> "attach_image",
							"heading"           		=> __( "Background Image", "ts_visual_composer_extend" ),
							"param_name"        		=> "style_image",
							"value"             		=> "",
							"description"       		=> __( "Select an image or pattern to be used as background for the element.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "style_background", 'value' => 'image' ),
							"group" 					=> "Style Settings",
						),		
						array(
							"type"						=> "dropdown",
							"heading"					=> __( "Background Size", "ts_visual_composer_extend" ),
							"param_name"				=> "style_size",
							"width"						=> 150,
							"value"						=> array(
								__( "Cover", "ts_visual_composer_extend" ) 			=> "cover",
								__( "150%", "ts_visual_composer_extend" )			=> "150%",
								__( "200%", "ts_visual_composer_extend" )			=> "200%",
								__( "Contain", "ts_visual_composer_extend" ) 		=> "contain",
								__( "Initial", "ts_visual_composer_extend" ) 		=> "initial",
								__( "Auto", "ts_visual_composer_extend" ) 			=> "auto",
							),
							"description"				=> __( "Select how the custom background image should be sized.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "style_background", 'value' => 'image' ),
							"group" 					=> "Style Settings",
						),
						array(
							"type"						=> "dropdown",
							"heading"					=> __( "Background Repeat", "ts_visual_composer_extend" ),
							"param_name"				=> "style_repeat",
							"width"						=> 150,
							"value"						=> array(
								__( "No Repeat", "ts_visual_composer_extend" )		=> "no-repeat",
								__( "Repeat X + Y", "ts_visual_composer_extend" )	=> "repeat",
								__( "Repeat X", "ts_visual_composer_extend" )		=> "repeat-x",
								__( "Repeat Y", "ts_visual_composer_extend" )		=> "repeat-y"
							),
							"description"				=> __( "Select if and how the background image should be repeated.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "style_background", 'value' => 'image' ),
							"group" 					=> "Style Settings",
						),						
						array(
							"type" 						=> "dropdown",
							"heading" 					=> __( "Background Position", "ts_visual_composer_extend" ),
							"param_name" 				=> "style_position",
							"value" 					=> array(
								__( "Center Center", "ts_visual_composer_extend" ) 				=> "center center",
								__( "Center Top", "ts_visual_composer_extend" )					=> "center top",
								__( "Center Bottom", "ts_visual_composer_extend" ) 				=> "center bottom",
								__( "Left Top", "ts_visual_composer_extend" ) 					=> "left top",
								__( "Left Center", "ts_visual_composer_extend" ) 				=> "left center",
								__( "Left Bottom", "ts_visual_composer_extend" ) 				=> "left bottom",
								__( "Right Top", "ts_visual_composer_extend" ) 					=> "right top",
								__( "Right Center", "ts_visual_composer_extend" ) 				=> "right center",
								__( "Right Bottom", "ts_visual_composer_extend" ) 				=> "right bottom",
							),
							"description" 				=> __("Select the position of the background image; will have most effect on smaller screens.", "ts_visual_composer_extend"),
							"dependency"        		=> array( 'element' => "style_background", 'value' => 'image' ),
							"group" 					=> "Style Settings",
						),
						array(
							"type" 						=> "advanced_styling",
							"heading" 					=> __("Style: Border Settings", "ts_visual_composer_extend"),
							"param_name" 				=> "style_border",
							"style_type"				=> "border",
							"show_main"					=> "false",
							"show_preview"				=> "true",
							"show_width"				=> "true",
							"show_style"				=> "true",
							"show_radius" 				=> "true",					
							"show_color"				=> "true",
							"show_unit_width"			=> "true",
							"show_unit_radius"			=> "true",
							"override_all"				=> "true",
							"default_positions"			=> array(
								"All"							=> array("string" => __("All", "ts_visual_composer_extend"),	"width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#cccccc", "radius" => "0", "unitradius" => "px"),
								"Top"							=> array("string" => __("Top", "ts_visual_composer_extend"),	"width" => "0", "unitwidth" => "px", "style" => "solid", "color" => "#cccccc", "radius" => "0", "unitradius" => "px"),
								"Right"							=> array("string" => __("Right", "ts_visual_composer_extend"),	"width" => "0", "unitwidth" => "px", "style" => "solid", "color" => "#cccccc", "radius" => "0", "unitradius" => "px"),
								"Bottom"						=> array("string" => __("Bottom", "ts_visual_composer_extend"),	"width" => "0", "unitwidth" => "px", "style" => "solid", "color" => "#cccccc", "radius" => "0", "unitradius" => "px"),
								"Left"							=> array("string" => __("Left", "ts_visual_composer_extend"),	"width" => "0", "unitwidth" => "px", "style" => "solid", "color" => "#cccccc", "radius" => "0", "unitradius" => "px"),
							),
							"description"       		=> __( "Define the border settings for each side and corner of the element.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "style_adjust", 'value' => 'true'),
							"group" 					=> "Style Settings",
						),
						array(
							"type" 						=> "advanced_styling",
							"heading" 					=> __("Style: Internal Paddings", "ts_visual_composer_extend"),
							"param_name" 				=> "style_padding",
							"style_type"				=> "padding",
							"show_main"					=> "false",
							"show_preview"				=> "false",
							"show_width"				=> "true",
							"show_style"				=> "false",
							"show_radius" 				=> "false",					
							"show_color"				=> "false",
							"show_unit_width"			=> "false",
							"show_unit_radius"			=> "false",
							"label_width"				=> "",
							"override_all"				=> "false",
							"default_positions"			=> array(
								//"All"							=> array("string" => __("All", "ts_visual_composer_extend"),	"width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px"),
								"Top"							=> array("string" => __("Top", "ts_visual_composer_extend"),	"width" => "0", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px"),
								"Right"							=> array("string" => __("Right", "ts_visual_composer_extend"),	"width" => "0", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px"),
								"Bottom"						=> array("string" => __("Bottom", "ts_visual_composer_extend"),	"width" => "0", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px"),
								"Left"							=> array("string" => __("Left", "ts_visual_composer_extend"),	"width" => "0", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px"),
							),
							"value"						=> "padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;",
							"description"       		=> __( "Define the internal paddings for the element.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "style_adjust", 'value' => 'true'),
							"group" 					=> "Style Settings",
						),
						array(
							"type" 						=> "advanced_styling",
							"heading" 					=> __("Style: External Margins", "ts_visual_composer_extend"),
							"param_name" 				=> "style_margin",
							"style_type"				=> "margin",
							"show_main"					=> "false",
							"show_preview"				=> "false",
							"show_width"				=> "true",
							"show_style"				=> "false",
							"show_radius" 				=> "false",					
							"show_color"				=> "false",
							"show_auto"					=> "false",
							"show_unit_width"			=> "false",
							"show_unit_radius"			=> "false",
							"label_width"				=> "",
							"override_all"				=> "false",
							"default_positions"			=> array(
								//"All"							=> array("string" => __("All", "ts_visual_composer_extend"),	"width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px"),
								"Top"							=> array("string" => __("Top", "ts_visual_composer_extend"),	"width" => "0", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "false"),
								"Right"							=> array("string" => __("Right", "ts_visual_composer_extend"),	"width" => "0", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
								"Bottom"						=> array("string" => __("Bottom", "ts_visual_composer_extend"),	"width" => "0", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "false"),
								"Left"							=> array("string" => __("Left", "ts_visual_composer_extend"),	"width" => "0", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
							),
							"value"						=> "margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;",
							"description"       		=> __( "Define the external margins for the element.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "style_adjust", 'value' => 'true'),
							"group" 					=> "Style Settings",
						),
						// Other Conditionals
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_3a",
							"seperator"					=> "Output Conditions",
							"group" 					=> "Other Settings",
						),
						array(
							"type"              		=> "ts_conditionals",
							"heading"                   => __( "Output Conditions", "ts_visual_composer_extend" ),
							"param_name"        		=> "conditionals",
							"group" 					=> "Other Settings",
						),						
						// Class Settings
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_3b",
							"seperator"					=> "Class Settings",
							"group" 					=> "Other Settings",
						),
						array(
							"type"              		=> "messenger",
							"param_name"        		=> "messenger_2",
							"layout"					=> "info",
							"size"						=> "13",
							"level"						=> "critical",
							"message"            		=> __( "You should only make changes below if your WP Bakery Page Builder is using modified class names, which can happen if you received WP Bakery Page Builder bundled with your theme.", "ts_visual_composer_extend" ),
							"group" 					=> "Other Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"			    	=> __( "Class: Modify", "ts_visual_composer_extend" ),
							"param_name"		    	=> "class_modify",
							"value"             		=> "false",
							"description"		    	=> __( "Switch the toggle if you want to modify the class names used to identify columns, rows and sections within WP Bakery Page Builder.", "ts_visual_composer_extend" ),
							"group" 					=> "Other Settings",
						),
						array(
							"type"              		=> "textfield",
							"heading"           		=> __( "Class: Column", "ts_visual_composer_extend" ),
							"param_name"        		=> "class_column",
							"value"             		=> "wpb_column",
							"description"       		=> __( "Enter the class name that is used by WP Bakery Page Builder to identify columns.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "class_modify", 'value' => 'true'),
							"group" 					=> "Other Settings",
						),
						array(
							"type"              		=> "textfield",
							"heading"           		=> __( "Class: Inner Row", "ts_visual_composer_extend" ),
							"param_name"        		=> "class_inner",
							"value"             		=> "vc_row_inner",
							"description"       		=> __( "Enter the class name that is used by WP Bakery Page Builder to identify inner rows.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "class_modify", 'value' => 'true'),
							"group" 					=> "Other Settings",
						),
						array(
							"type"              		=> "textfield",
							"heading"           		=> __( "Class: Main Row", "ts_visual_composer_extend" ),
							"param_name"        		=> "class_row",
							"value"             		=> "vc_row",
							"description"       		=> __( "Enter the class name that is used by WP Bakery Page Builder to identify main rows.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "class_modify", 'value' => 'true'),
							"group" 					=> "Other Settings",
						),
						array(
							"type"              		=> "textfield",
							"heading"           		=> __( "Class: Section", "ts_visual_composer_extend" ),
							"param_name"        		=> "class_section",
							"value"             		=> "vc_section",
							"description"       		=> __( "Enter the class name that is used by WP Bakery Page Builder to identify page sections.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "class_modify", 'value' => 'true'),
							"group" 					=> "Other Settings",
						),						
						// Other Settings
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_3c",
							"seperator"					=> "Other Settings",
							"group" 					=> "Other Settings",
						),
						array(
							"type"              		=> "textfield",
							"heading"           		=> __( "Define ID Name", "ts_visual_composer_extend" ),
							"param_name"        		=> "el_id",
							"value"             		=> "",
							"description"       		=> __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
							"group" 					=> "Other Settings",
						),
						array(
							"type"						=> "tag_editor",
							"heading"					=> __( "Extra Class Names", "ts_visual_composer_extend" ),
							"param_name"				=> "el_class",
							"value"						=> "",
							"description"				=> __( "Enter additional class names for the element.", "ts_visual_composer_extend" ),
							"group"						=> "Other Settings",
						),
					)							
				);
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
					return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
				} else {			
					vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
				};
			}
		}
	}
	// Register Container and Child Shortcode with WP Bakery Page Builder
	if ((class_exists('WPBakeryShortCodesContainer')) && (!class_exists('WPBakeryShortCode_TS_VCSC_FixedContent_Block'))) {
		class WPBakeryShortCode_TS_VCSC_FixedContent_Block extends WPBakeryShortCodesContainer {};
	}	
	// Initialize "TS Fixed Content Section" Class
	if (class_exists('TS_FixedContent_Block')) {
		$TS_FixedContent_Block = new TS_FixedContent_Block;
	}
?>