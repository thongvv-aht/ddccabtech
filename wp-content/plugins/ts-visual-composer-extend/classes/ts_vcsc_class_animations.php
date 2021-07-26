<?php
	if (!class_exists('TS_Animations')){
		class TS_Animations{
			function __construct(){
				global $VISUAL_COMPOSER_EXTENSIONS;
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						$this->TS_VCSC_Add_Animation_Lean();
					} else if (function_exists('vc_map')) {
						add_action('init',                                  array($this, 'TS_VCSC_Add_Animation_Elements'), 9999999);
					}
				} else {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Animation_Lean'), 9999999);
					} else if (function_exists('vc_map')) {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Animation_Elements'), 9999999);
					}
				}
				if ((is_admin() == false) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAJAX == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAlways == "true")) {
					add_shortcode('TS_VCSC_Animation_Frame',          		array($this, 'TS_VCSC_Animation_Frame_Function'));
				}
			}
			
			// Register Element(s) via LeanMap
			function TS_VCSC_Add_Animation_Lean() {
				vc_lean_map('TS_VCSC_Animation_Frame', 						array($this, 'TS_VCSC_Add_Animation_Elements'), null);
			}
			
			function TS_VCSC_Animation_Frame_Function($atts, $content = null){
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndWaypoints == "true") {
					if (wp_script_is('waypoints', $list = 'registered')) {
						wp_enqueue_script('waypoints');
					} else {
						wp_enqueue_script('ts-extend-waypoints');
					}
				}
	
				wp_enqueue_style('ts-extend-animations');
				wp_enqueue_style('ts-visual-composer-extend-front');
				wp_enqueue_script('ts-visual-composer-extend-front');
				
				extract(shortcode_atts(array(
					"enable"						=> "true",
					"animation" 					=> "bounce",
					"viewport" 						=> "true",
					'offset' 						=> 'bottom-in-view',
					"duration" 						=> 1000,
					"delay" 						=> 0,
					"infinite"						=> "false",
					"repeat" 						=> 1,
					"runonce"						=> "true",
					"mobile"						=> "false",
					'margin_bottom'					=> 0,
					'margin_top' 					=> 0,
					'el_id' 						=> '',
					'el_class'                  	=> '',
					'css'							=> '',
				),$atts));
				
				if (!empty($el_id)) {
					$animation_id					= $el_id;
				} else {
					$animation_id					= 'ts-vcsc-animation-frame-' . mt_rand(999999, 9999999);
				}
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$enable 						= "false";
				} else {
					$enable 						= $enable;
				}
				
				$output 							= '';
	
                // Check for Conversion of WBP Animations
                $animation							= TS_VCSC_ConvertLegacyAnimation($animation);
	
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$style 							= 'width: 100%; margin-top: ' . ($margin_top < 35 ? 35 : $margin_top) . 'px; margin-bottom: ' . $margin_bottom . 'px;';
				} else {
					$style 							= 'width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;';
				}
				
				if ($enable == "true") {
					$style							.= ' opacity: 0;';
					if ($viewport == "true"){
						$containerclass				= 'ts-animation-container-enabled ts-animation-frame ts-animation-container-viewport';
					} else {
						$containerclass	 			= 'ts-animation-container-enabled ts-animation-frame ts-animation-container-instant';
					}
				
					if ($infinite == "true"){
						$repeat 					= 'infinite';
						$animation					= 'ts-infinite-css-' . $animation;
						$style						.= ' -webkit-animation-iteration-count: infinite;';
						$style						.= ' -moz-animation-iteration-count: infinite;';
						$style						.= ' -ms-animation-iteration-count: infinite;';
						$style						.= ' -o-animation-iteration-count: infinite;';
						$style						.= ' animation-iteration-count: infinite;';
						$style						.= ' -webkit-animation-duration: ' . ($duration / 1000) . 's;';
						$style						.= ' -moz-animation-duration: ' . ($duration / 1000) . 's;';
						$style						.= ' -ms-animation-duration: ' . ($duration / 1000) . 's;';
						$style						.= ' -o-animation-duration: ' . ($duration / 1000) . 's;';
						$style						.= ' animation-duration: ' . ($duration / 1000) . 's;';
					} else {
						$animation					= 'ts-viewport-css-' . $animation;
						$style						.= ' -webkit-animation-iteration-count: ' . $repeat . ';';
						$style						.= ' -moz-animation-iteration-count: ' . $repeat . ';';
						$style						.= ' -ms-animation-iteration-count: ' . $repeat . ';';
						$style						.= ' -o-animation-iteration-count: ' . $repeat . ';';
						$style						.= ' animation-iteration-count: ' . $repeat . ';';
						$style						.= ' -webkit-animation-duration: ' . ($duration / 1000) . 's;';
						$style						.= ' -moz-animation-duration: ' . ($duration / 1000) . 's;';
						$style						.= ' -ms-animation-duration: ' . ($duration / 1000) . 's;';
						$style						.= ' -o-animation-duration: ' . ($duration / 1000) . 's;';
						$style						.= ' animation-duration: ' . ($duration / 1000) . 's;';
					}
				} else {
					$containerclass	 				= 'ts-animation-container-disabled';
				}
				
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, '' . $containerclass . ' ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Animation_Frame', $atts);
				} else {
					$css_class 						= $containerclass . ' ' . $el_class;
				}
				
				if ($enable == "true") {
					$output .= '<div id="' . $animation_id . '" class="' . $css_class . '" data-offset="' . $offset . '" data-mobile="' . $mobile . '" data-once="' . $runonce . '" data-animation="' . $animation . '" data-delay="' . $delay . '" data-infinite="' . $infinite . '" data-viewport="' . $viewport . '" data-duration="' . $duration . '" data-repeat="' . $repeat . '" style="' . $style . '">';
				} else {
					$output .= '<div id="' . $animation_id . '" class="' . $css_class . '" style="' . $style . '">';
				}
					$output .= do_shortcode($content);
				$output .= '</div>';
				
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
			function TS_VCSC_Add_Animation_Elements() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name" 								=> __("TS Animation Frame", "ts_visual_composer_extend"),
					"base" 								=> "TS_VCSC_Animation_Frame",
					"icon" 								=> "ts-composer-element-icon-animation-frame",
					"as_parent" 						=> array('except' => 'TS_VCSC_Animation_Frame'),
					"category" 							=> "Composium",
					"description" 						=> "Apply CSS3 animations to other elements.",
					"controls" 							=> "full",
					"content_element"                   => true,
					"is_container" 						=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseExtendedNesting == "true" ? false : true),
					"container_not_allowed" 			=> false,
					"show_settings_on_create"           => true,
					"admin_enqueue_js"            		=> "",
					"admin_enqueue_css"           		=> "",
					"js_view" 							=> 'VcColumnView',
					"params" 							=> array(
						array(
							"type"              		=> "messenger",
							"param_name"        		=> "messenger",
							"color"						=> "#FF0000",
							"size"						=> "14",
							"message"            		=> __( "For best performance and to avoid conflicts, it is advised not to assign additional CSS3 animations to the elements inside this container.", "ts_visual_composer_extend" )
						),
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_1",
							"seperator"					=> "Animation Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"			    	=> __( "Animation Active", "ts_visual_composer_extend" ),
							"param_name"		    	=> "enable",
							"value"             		=> "true",
							"admin_label"		        => true,
							"description"		    	=> __( "Switch the toggle if you want to use a CSS3 animation with this container element.", "ts_visual_composer_extend" )
						),
						array(
							"type" 						=> "css3animations",
							"heading" 					=> __("Animation Type", "ts_visual_composer_extend"),
							"param_name" 				=> "animation",
							"prefix"					=> "",
							"connector"					=> "css3animations_name",
							"default"					=> "",
							"value" 					=> "",
							"admin_label"				=> false,
							"description" 				=> __("Select the CSS3 animation you want to apply to the element.", "ts_visual_composer_extend"),
							"dependency"            	=> array( 'element' => "enable", 'value' => 'true' )
						),
						array(
							"type"                      => "hidden_input",
							"heading"                   => __( "Animation Type", "ts_visual_composer_extend" ),
							"param_name"                => "css3animations_name",
							"value"                     => "",
							"admin_label"		        => true,
							"dependency"            	=> array( 'element' => "enable", 'value' => 'true' )
						),						
						array(
							"type" 						=> "viewport_offset",
							"heading" 					=> __( "Animation Offset", "ts_visual_composer_extend"),
							"param_name" 				=> "offset",
							"value" 					=> 'bottom-in-view',
							"description" 				=> __("Define the offset (top of screen) that should trigger the viewport animation.", "ts_visual_composer_extend"),
							"dependency" 				=> array("element" => "animation", "not_empty" => true),
						),						
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Duration", "ts_visual_composer_extend" ),
							"param_name"				=> "duration",
							"value"						=> "1000",
							"min"						=> "1000",
							"max"						=> "20000",
							"step"						=> "100",
							"unit"						=> 'ms',
							"admin_label"           	=> true,
							"description"				=> __( "Define how long the CSS3 animation should last once triggered.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "enable", 'value' => 'true' )
						),
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Delay", "ts_visual_composer_extend" ),
							"param_name"				=> "delay",
							"value"						=> "0",
							"min"						=> "0",
							"max"						=> "20000",
							"step"						=> "100",
							"unit"						=> 'ms',
							"admin_label"           	=> true,
							"description"				=> __( "Define how long the CSS3 animation should be delayed after it has been triggered.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "enable", 'value' => 'true' )
						),
						array(
							"type"              		=> "switch_button",
							"heading"			    	=> __( "Viewport Trigger", "ts_visual_composer_extend" ),
							"param_name"		    	=> "viewport",
							"value"             		=> "true",
							"admin_label"           	=> true,
							"description"		    	=> __( "Switch the toggle if you want to trigger the CSS3 animation only once the element comes into viewport.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "enable", 'value' => 'true' )
						),
						array(
							"type"              		=> "switch_button",
							"heading"			    	=> __( "Infinite Repeats", "ts_visual_composer_extend" ),
							"param_name"		    	=> "infinite",
							"value"             		=> "false",
							"admin_label"           	=> true,
							"description"		    	=> __( "Switch the toggle if you want to repeat the CSS3 animation indefinitely.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "enable", 'value' => 'true' )
						),
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Repeat", "ts_visual_composer_extend" ),
							"param_name"				=> "repeat",
							"value"						=> "1",
							"min"						=> "1",
							"max"						=> "25",
							"step"						=> "1",
							"unit"						=> 'x',
							"description"				=> __( "Define how many times the CSS3 animation should be repeated after it has been triggered.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "infinite", 'value' => 'false' )
						),
						array(
							"type"              		=> "switch_button",
							"heading"			    	=> __( "Only First Viewport", "ts_visual_composer_extend" ),
							"param_name"		    	=> "runonce",
							"value"             		=> "true",
							"admin_label"           	=> true,
							"description"		    	=> __( "Switch the toggle if only the first viewport event should trigger the animation or if the animation should run again for subsequent viewport events.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "infinite", 'value' => 'false' )
						),
						array(
							"type"              		=> "switch_button",
							"heading"			    	=> __( "Animate on Mobile", "ts_visual_composer_extend" ),
							"param_name"		    	=> "mobile",
							"value"             		=> "false",
							"admin_label"           	=> true,
							"description"		    	=> __( "Switch the toggle if you want to show the CSS3 animations on mobile devices.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "enable", 'value' => 'true' )
						),
						// Other Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_2",
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
							"description"      		 	=> __( "Enter additional class names for the element.", "ts_visual_composer_extend" ),
							"group" 					=> "Other Settings",
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
	if ((class_exists('WPBakeryShortCodesContainer')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Animation_Frame'))) {
		class WPBakeryShortCode_TS_VCSC_Animation_Frame extends WPBakeryShortCodesContainer {};
	}	
	// Initialize "TS Animations" Class
	if (class_exists('TS_Animations')) {
		$TS_Animations = new TS_Animations;
	}
?>