<?php
	if (!class_exists('TS_Figure_Navigation')){
		class TS_Figure_Navigation {
			function __construct() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						$this->TS_VCSC_Add_Figure_Navigation_Lean();
					} else if (function_exists('vc_map')) {
						add_action('init',									array($this, 'TS_VCSC_Add_Figure_Navigation_Element_Container'), 9999999);
						add_action('init',									array($this, 'TS_VCSC_Add_Figure_Navigation_Element_Item'), 9999999);
					}
				} else {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Figure_Navigation_Lean'), 9999999);
					} else if (function_exists('vc_map')) {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Figure_Navigation_Element_Container'), 9999999);
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Figure_Navigation_Element_Item'), 9999999);
					}
				}
				if ((is_admin() == false) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAJAX == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAlways == "true")) {
					add_shortcode('TS_VCSC_Figure_Navigation_Item',			array($this, 'TS_VCSC_Figure_Navigation_Item'));
					add_shortcode('TS_VCSC_Figure_Navigation_Container',	array($this, 'TS_VCSC_Figure_Navigation_Container'));
				}
			}
	
			// Register Element(s) via LeanMap
			function TS_VCSC_Add_Figure_Navigation_Lean() {
				vc_lean_map('TS_VCSC_Figure_Navigation_Container', 			array($this, 'TS_VCSC_Add_Figure_Navigation_Element_Container'), null);
				vc_lean_map('TS_VCSC_Figure_Navigation_Item', 				array($this, 'TS_VCSC_Add_Figure_Navigation_Element_Item'), null);
			}
	
			// Single Navigation Item
			function TS_VCSC_Figure_Navigation_Item ($atts, $content = null) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();

				extract( shortcode_atts( array(
					'figure_active'					=> 'false',
					'figure_background_shape'		=> 'hexagon',
					'figure_background_type'		=> 'color',
					'figure_background_color'		=> '#ffffff',
					'figure_background_image'		=> '',
					'figure_background_pattern'		=> '',
					'figure_background_size'		=> 'cover',
					'figure_background_repeat'		=> 'repeat',

					'content_wpautop'				=> 'true',
					
					'handle_border_color'			=> '#87CEEB',
					'handle_border_width'			=> 4,
					'handle_text_color'				=> '#000000',
					
					'figure_image'					=> '',
					'figure_maxheight_set'			=> 'false',
					'figure_maxheight_value'		=> '600',
					'figure_title'					=> '',
					'figure_title_color'			=> '#4e4e4d',
					'figure_note'					=> '',
					'figure_note_color'				=> '#787876',
					'figure_icon_handle'			=> 'false',
					'figure_handle_icon'			=> '',
					'figure_handle_text'			=> '',
					
					'button_link'					=> '',
					'button_text'					=> 'Click Here!',
					'button_font'					=> '#ffffff',
					'button_color'					=> '#e9544e',
					
					'scroll_navigate'				=> 'false',
					'scroll_target'					=> '',
					'scroll_speed'					=> 2000,
					'scroll_effect'					=> 'linear',
					'scroll_offset'					=> 'desktop:0px;tablet:0px;mobile:0px',
					'scroll_hashtag'				=> 'false',		
					
					'tooltip_html'					=> 'false',
					'tooltip_content'				=> '',
					'tooltip_position'				=> 'ts-simptip-position-top',
					'tooltip_style'					=> 'ts-simptip-style-black',
					'tooltip_animation'				=> 'swing',
					'tooltipster_offsetx'			=> 0,
					'tooltipster_offsety'			=> 0,
					
					'el_id' 						=> '',
					'el_class'                  	=> '',
					'css'							=> '',
				), $atts ));
				
				if ($tooltip_content != '') {
					wp_enqueue_style('ts-extend-tooltipster');
					wp_enqueue_script('ts-extend-tooltipster');
				}
				
				$navigation_random					= mt_rand(999999, 9999999);
				
				// Navigation Link
				if (($scroll_navigate == "true") && ($scroll_target != '')) {
					$scroll_target					= str_replace("#", "", $scroll_target);
					$a_href							= "#" . $scroll_target;
					$a_title 						= "";
					$a_target 						= "_parent";
				} else {
					$link 							= TS_VCSC_Advancedlinks_GetLinkData($button_link);
					$a_href							= $link['url'];
					$a_title 						= $link['title'];
					$a_target 						= $link['target'];
				}
				if (($scroll_navigate == "true") && ($scroll_target != '')) {
					$scroll_offset 					= explode(';', $scroll_offset);			
					$offsetDesktop					= explode(':', $scroll_offset[0]);
					$offsetDesktop					= str_replace("px", "", $offsetDesktop[1]);
					$offsetTablet					= explode(':', $scroll_offset[1]);
					$offsetTablet					= str_replace("px", "", $offsetTablet[1]);
					$offsetMobile					= explode(':', $scroll_offset[2]);
					$offsetMobile					= str_replace("px", "", $offsetMobile[1]);	
					$scroll_class					= 'ts-button-page-navigator';			
					$scroll_data					= 'data-scroll-target="' . $scroll_target . '" data-scroll-speed="' . $scroll_speed . '" data-scroll-effect="' . $scroll_effect . '" data-scroll-offsetdesktop="' . $offsetDesktop . '" data-scroll-offsettablet="' . $offsetTablet . '" data-scroll-offsetmobile="' . $offsetMobile . '" data-scroll-hashtag="' . $scroll_hashtag . '"';
				} else {
					$scroll_class					= '';
					$scroll_data					= '';
				}
		
				// Check for Front End Editor
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$frontend_edit					= 'true';
				} else {
					$frontend_edit					= 'false';
				}
		
				// Figure Image
				$figure_image						= wp_get_attachment_image_src($figure_image, 'full');
				$figure_background					= 'background-image: url(' . $figure_image[0] . ');';				
				$figure_border						= 'border-bottom: ' . $handle_border_width . 'px solid ' . $handle_border_color . ';';
				
				// Background Settings
				if ($figure_background_type == "pattern") {
					$figure_background_style		= 'background: url(' . $figure_background_pattern . ') repeat;';
				} else if ($figure_background_type == "color") {
					$figure_background_style		= 'background-color: ' . $figure_background_color .';';
				} else if ($figure_background_type == "image") {
					$background_image				= wp_get_attachment_image_src($figure_background_image, 'full');
					$background_image				= $background_image[0];
					$figure_background_style		= 'background: url(' . $background_image . ') ' . $figure_background_repeat . ' 0 0; background-size: ' . $figure_background_size . ';';
				}
				
				// Tooltip
				$tooltip_position					= TS_VCSC_TooltipMigratePosition($tooltip_position);
				$tooltip_style						= TS_VCSC_TooltipMigrateStyle($tooltip_style);
				if (strlen($tooltip_content) != 0) {
					$icon_tooltipclasses			= "ts-has-tooltipster-tooltip";
					$icon_tooltipcontent			= 'data-tooltipster-title="" data-tooltipster-text="' . $tooltip_content . '" data-tooltipster-image="" data-tooltipster-position="' . $tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $tooltip_style . '" data-tooltipster-animation="' . $tooltip_animation . '" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '" data-tooltipster-movetip="' . $tooltipster_offsety . '"';
				} else {
					$icon_tooltipclasses			= "";
					$icon_tooltipcontent			= "";
				}
				
				// Max Height Settings
				if ($figure_maxheight_set == "true") {
					$image_maxheight				= 'max-height: ' . $figure_maxheight_value . 'px;';
				} else {
					$image_maxheight				= '';
				}
				
				$output 							= '';
				$wpautop 							= ($content_wpautop == "true" ? true : false);
				
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-teaser ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Figure_Navigation_Item', $atts);
				} else {
					$css_class						= 'ts-teaser ' . $el_class;
				}
				
				$output .= '<div class="ts-figure-navigation-item ' . $icon_tooltipclasses . ' ' . ($frontend_edit=="true" ? "frontend" : "") . '" ' . $icon_tooltipcontent . ' style="width: 25%; height: 110px;" data-active="' . $figure_active . '" data-frontend="' . $frontend_edit . '">';
					$output .= '<div class="ts-figure-navigation-inner" style="' . $figure_background_style . ';">';
						$output .= '<figure class="ts-figure-navigation-figure" style="' . $figure_background . ' ' . $figure_border . ' height: 0px;"></figure>';
						if (isset($figure_image[0])) {
							$output .= '<img class="ts-figure-navigation-image" src="' . $figure_image[0] . '" data-no-lazy="1" style="' . $image_maxheight . '">';
						}
						if ($figure_icon_handle == "true") {
							$output .= '<div class="ts-figure-navigation-handle ts-figure-navigation-handle-' . $figure_background_shape . ' ts-figure-navigation-handle-icon" style="background-color: ' . $handle_border_color . '; border-color: ' . $handle_border_color . '; color: ' . $handle_text_color . ';"><i class="' . $figure_handle_icon . '"></i></div>';
						} else if ($figure_handle_text != "") {
							$output .= '<div class="ts-figure-navigation-handle ts-figure-navigation-handle-' . $figure_background_shape . ' ts-figure-navigation-handle-custom" style="background-color: ' . $handle_border_color . '; border-color: ' . $handle_border_color . '; color: ' . $handle_text_color . ';">' . $figure_handle_text . '</div>';
						} else {
							$output .= '<div class="ts-figure-navigation-handle ts-figure-navigation-handle-' . $figure_background_shape . ' ts-figure-navigation-handle-text" style="background-color: ' . $handle_border_color . '; border-color: ' . $handle_border_color . '; color: ' . $handle_text_color . ';"></div>';
						}
						$output .= '<div class="ts-figure-navigation-content" style="height: auto; display: none;">';
							if (function_exists('wpb_js_remove_wpautop')){
								$output .= wpb_js_remove_wpautop(do_shortcode($content), $wpautop);
							} else {
								$output .= do_shortcode($content);
							}
						$output .= '</div>';
						if ($a_href != '') {
							$output .= '<a id="ts-figure-navigation-button-' . $navigation_random . '" class="ts-figure-navigation-button ' . $scroll_class . '" href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '" ' . $scroll_data . ' style="background-color: ' . $button_color . '; color: ' . $button_font . ';">' . $button_text . '</a>';
						} else {
							$output .= '<div id="ts-figure-navigation-placeholder-' . $navigation_random . '" class="ts-figure-navigation-placeholder"></div>';
						}
						$output .= '<div class="ts-figure-navigation-title">';
							if ($figure_note != '') {
								$output .= '<span class="ts-figure-navigation-title-note" style="color: ' . $figure_note_color . '">' . $figure_note . '</span>';
							}
							$output .= '<span class="ts-figure-navigation-title-main" style="color: ' . $figure_title_color . '">' . $figure_title . '</span>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
		
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
			
			// Figure Navigation Container
			function TS_VCSC_Figure_Navigation_Container ($atts, $content = null){
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
	
				wp_enqueue_style('ts-visual-composer-extend-front');
				wp_enqueue_script('ts-visual-composer-extend-front');
				
				extract( shortcode_atts( array(
					'numbering'						=> 'number',
					'start'							=> 1,
					'trigger'						=> 'click',
					'width_full'					=> 'false',
					'min_width'						=> 250,
					'multiple'						=> 'false',
					'openmobile'					=> 'false',
					'content_shadow'				=> 'true',
					'content_page'					=> 'true',
					'content_nofigure'				=> 'false',
					'content_wpautop'				=> 'true',
					'content_spacing'				=> 0,
					'global_click'					=> 'false',
					'global_hover'					=> 'false',
					'margin_top'                    => 0,
					'margin_bottom'                 => 0,
					'el_id' 						=> '',
					'el_class'                  	=> '',
					'css'							=> '',
				), $atts ));
				
				$navigation_random					= mt_rand(999999, 9999999);
				
				// Check for Front End Editor
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$frontend_edit					= 'true';
				} else {
					$frontend_edit					= 'false';
				}
				
				if (!empty($el_id)) {
					$figure_navigation_id			= $el_id;
				} else {
					$figure_navigation_id			= 'ts-vcsc-figure-navigation-item-' . $navigation_random;
				}
				
				if ($frontend_edit == "true") {
					$trigger 						= "click";
				}
				
				// Trigger Type
				if ($trigger == "hover") {
					$figure_trigger					= 'ts-figure-navigation-hover';	
				} else if ($trigger == "click") {
					$figure_trigger					= 'ts-figure-navigation-click';
				}
				// Push or Cover Effect
				$figure_type						= 'ts-figure-navigation-' . $content_page;
				
				// Contingency Checks
				if ($width_full == "true") {
					$content_spacing				= 0;
				}
				
				// Global Close Event
				if ($trigger == "click") {
					$content_global					= $global_click;
				} else if ($trigger == "hover") {
					$content_global					= $global_hover;
				} else {
					$content_global					= "false";
				}
				
				// Shadow Effect
				if ($content_shadow == "true") {
					$figure_shadow					= 'ts-figure-navigation-shadow';	
				} else {
					$figure_shadow					= '';	
				}
				
				// No Icon Figure
				if ($content_nofigure == "true") {
					$figure_noicon					= 'ts-figure-navigation-nofigure';	
				} else {
					$figure_noicon					= '';
				}
				
				// Contingency Checks
				if ($trigger == "hover") {
					$multiple						= "false";
				}
				
				$output 							= '';
				$wpautop 							= ($content_wpautop == "true" ? true : false);
				
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-figure-navigation-container ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Figure_Navigation_Container', $atts);
				} else {
					$css_class						= 'ts-figure-navigation-container ' . $el_class;
				}
				
				$output .= '<div id="' . $figure_navigation_id . '" class="' . $css_class . ' ' . $figure_trigger . ' ' . $figure_type . ' ' . $figure_shadow . ' ' . $figure_noicon . ' cover" data-pagecontent="' . $content_page . '" data-spacing="' . $content_spacing . '" data-global="' . $content_global . '" data-nofigure="' . $content_nofigure . '" data-trigger="' . $trigger . '" data-multiple="' . $multiple . '" data-openmobile="' . $openmobile . '" data-start="' . $start . '" data-widthfull="' . $width_full . '" data-minwidth="' . $min_width . '" data-numbering="' . $numbering . '" data-frontend="' . $frontend_edit . '">';
					if (function_exists('wpb_js_remove_wpautop')){
						$output .= wpb_js_remove_wpautop(do_shortcode($content), $wpautop);
					} else {
						$output .= do_shortcode($content);
					}
				$output .= '</div>';
				
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}		
		
			// Add Figure Navigation Elements
			function TS_VCSC_Add_Figure_Navigation_Element_Container() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Navigation Container
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                              => __("TS Figure Navigation", "ts_visual_composer_extend"),
					"base"                              => "TS_VCSC_Figure_Navigation_Container",
					"icon"                              => "ts-composer-element-icon-figure-navigation-main",
					"category"                          => __("Composium", "ts_visual_composer_extend"),
					"as_parent"                         => array('only' => 'TS_VCSC_Figure_Navigation_Item'),
					"description"                       => __("Build a Figure Navigation Element", "ts_visual_composer_extend"),
					"controls" 							=> "full",
					"content_element"                   => true,
					"is_container" 						=> true,
					"container_not_allowed" 			=> false,
					"show_settings_on_create"           => true,
					"admin_enqueue_js"            		=> "",
					"admin_enqueue_css"           		=> "",
					"js_view"                           => 'VcColumnView',
					"params"                            => array(
						// Navigation Settings
						array(
							"type"						=> "seperator",
							"param_name"				=> "seperator_1",
							"seperator"					=> "Figure Navigation Settings",
						),
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Handle Numbering", "ts_visual_composer_extend" ),
							"param_name"        		=> "numbering",
							"width"             		=> 300,
							"value"             		=> array(
								__( 'Auto Standard Number', "ts_visual_composer_extend" )		=> "number",
								__( 'Auto Roman Number', "ts_visual_composer_extend" )      	=> "roman",
								__( 'Auto Letter', "ts_visual_composer_extend" )      			=> "letter",
							),
							"admin_label"           	=> true,
							"description"       		=> __( "Select how the navigation items should be numbered if no custom value has been provided.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Start of Auto Numbering", "ts_visual_composer_extend" ),
							"param_name"                => "start",
							"value"                     => "1",
							"min"                       => "1",
							"max"                       => "100",
							"step"                      => "1",
							"unit"                      => '',
							"admin_label"           	=> true,
							"description"               => __( "Define with which number the auto numbering should begin; treat letters as numbers.", "ts_visual_composer_extend" ),
						),
						array(
							"type"						=> "switch_button",
							"heading"           		=> __( "Make Full Column Width", "ts_visual_composer_extend" ),
							"param_name"        		=> "width_full",
							"value"             		=> "false",
							"description"       		=> __( "Switch the toggle if you want to make each navigation element the full width of its column.", "ts_visual_composer_extend" )
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Min. Width per Item", "ts_visual_composer_extend" ),
							"param_name"                => "min_width",
							"value"                     => "250",
							"min"                       => "100",
							"max"                       => "2048",
							"step"                      => "1",
							"unit"                      => 'px',
							"admin_label"           	=> true,
							"description"               => __( "Define the minimum width for each individal navigation item.", "ts_visual_composer_extend" ),
							"dependency"				=> array( 'element' => "width_full", 'value' => "false" ),
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Item Spacing", "ts_visual_composer_extend" ),
							"param_name"                => "content_spacing",
							"value"                     => "0",
							"min"                       => "0",
							"max"                       => "30",
							"step"                      => "2",
							"unit"                      => 'px',
							"description"               => __( "Define the spacing between each individal navigation item.", "ts_visual_composer_extend" ),
							"dependency"				=> array( 'element' => "width_full", 'value' => "false" ),
						),		
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Page Content", "ts_visual_composer_extend" ),
							"param_name"        		=> "content_page",
							"width"             		=> 300,
							"value"             		=> array(
								__( 'Push Content Below', "ts_visual_composer_extend" )		=> "push",
								__( 'Place Above Content', "ts_visual_composer_extend" )	=> "cover",								
							),
							"admin_label"           	=> true,
							"description"       		=> __( "Select how the page content below the element should be treated once an item is opened.", "ts_visual_composer_extend" ),
						),						
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Trigger Type", "ts_visual_composer_extend" ),
							"param_name"        		=> "trigger",
							"width"             		=> 300,
							"value"             		=> array(
								__( 'Click', "ts_visual_composer_extend" )      			=> "click",
								__( 'Hover', "ts_visual_composer_extend" )					=> "hover",								
							),
							"admin_label"           	=> true,
							"description"       		=> __( "Select by which trigger action the navigation items should be opened.", "ts_visual_composer_extend" ),
						),
						array(
							"type"						=> "switch_button",
							"heading"           		=> __( "Allow Multiple Open", "ts_visual_composer_extend" ),
							"param_name"        		=> "multiple",
							"value"             		=> "false",
							"description"       		=> __( "Switch the toggle if you want to allow that multiple items can be open at the same time.", "ts_visual_composer_extend" ),
							"dependency"				=> array( 'element' => "trigger", 'value' => "click" ),
						),
						array(
							"type"						=> "switch_button",
							"heading"           		=> __( "Close Pagewide", "ts_visual_composer_extend" ),
							"param_name"        		=> "global_click",
							"value"             		=> "false",
							"description"       		=> __( "Switch the toggle if you want to close all open figure navigation elements on the page, once an item opens, even the ones belonging to other containers.", "ts_visual_composer_extend" ),
							"dependency"				=> array( 'element' => "multiple", 'value' => "false" ),
						),
						array(
							"type"						=> "switch_button",
							"heading"           		=> __( "Close Pagewide", "ts_visual_composer_extend" ),
							"param_name"        		=> "global_hover",
							"value"             		=> "false",
							"description"       		=> __( "Switch the toggle if you want to close all open figure navigation elements on the page, once an item opens, even the ones belonging to other containers.", "ts_visual_composer_extend" ),
							"dependency"				=> array( 'element' => "trigger", 'value' => "hover" ),
						),
						array(
							"type"						=> "switch_button",
							"heading"           		=> __( "Open Active On Mobile", "ts_visual_composer_extend" ),
							"param_name"        		=> "openmobile",
							"value"             		=> "false",
							"description"       		=> __( "Switch the toggle if you want items active on page load to be auto-opened on mobile devices as well.", "ts_visual_composer_extend" ),
						),
						array(
							"type"						=> "switch_button",
							"heading"           		=> __( "Show Shadow", "ts_visual_composer_extend" ),
							"param_name"        		=> "content_shadow",
							"value"             		=> "true",
							"description"       		=> __( "Switch the toggle if you want to apply a shadow effect to each item.", "ts_visual_composer_extend" ),
						),
						array(
							"type"						=> "switch_button",
							"heading"           		=> __( "Remove Figure Handle", "ts_visual_composer_extend" ),
							"param_name"        		=> "content_nofigure",
							"value"             		=> "false",
							"description"       		=> __( "Switch the toggle if you want to hide the top figure handle for all items.", "ts_visual_composer_extend" ),
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
			function TS_VCSC_Add_Figure_Navigation_Element_Item() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Single Navigation Item
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                      	=> __( "TS Figure Navigation Item", "ts_visual_composer_extend" ),
					"base"                      	=> "TS_VCSC_Figure_Navigation_Item",
					"icon" 	                    	=> "ts-composer-element-icon-figure-navigation-item",
					"content_element"				=> true,
					"as_child"						=> array('only' => 'TS_VCSC_Figure_Navigation_Container'),
					"category"                  	=> __( "Composium", "ts_visual_composer_extend" ),
					"description"               	=> __("Place a single navigation item", "ts_visual_composer_extend"),
					"admin_enqueue_js"            	=> "",
					"admin_enqueue_css"           	=> "",
					"params"                    	=> array(
						// Main Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1",
							"seperator"				=> "Basic Settings",
						),
						array(
							"type"                  => "attach_image",
							"holder" 				=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? "img" : ""),
							"heading"               => __( "Top Image", "ts_visual_composer_extend" ),
							"param_name"            => "figure_image",
							"class"					=> "ts_vcsc_holder_image",
							"value"                 => "",
							"admin_label"           => ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? false : true),
							"description"           => __( "Select the top image you want to use for the figure navigation item.", "ts_visual_composer_extend" )
						),
						array(
							"type"					=> "switch_button",
							"heading"           	=> __( "Set Max. Image Height", "ts_visual_composer_extend" ),
							"param_name"        	=> "figure_maxheight_set",
							"value"             	=> "false",
							"description"       	=> __( "Switch the toggle if you want to apply a maximum height to the image; otherwise auto-height will be used.", "ts_visual_composer_extend" )
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Image Max. Height", "ts_visual_composer_extend" ),
							"param_name"            => "figure_maxheight_value",
							"value"                 => "200",
							"min"                   => "50",
							"max"                   => "1024",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"       	=> __( "Define a maximum height for the image.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "figure_maxheight_set", 'value' => "true" ),
						),
						array(
							"type"					=> "switch_button",
							"heading"           	=> __( "Show on Page Load", "ts_visual_composer_extend" ),
							"param_name"        	=> "figure_active",
							"value"             	=> "false",
							"admin_label"       	=> true,
							"description"       	=> __( "Switch the toggle if you want to show this figure navigation item on page load.", "ts_visual_composer_extend" )
						),
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Handle Shape", "ts_visual_composer_extend" ),
							"param_name"			=> "figure_background_shape",
							"width"					=> 300,
							"value"					=> array(
								__( 'Hexagon', "ts_visual_composer_extend" )		=> "hexagon",
								__( 'Square', "ts_visual_composer_extend" )      	=> "square",
								__( 'Circle', "ts_visual_composer_extend" )			=> "circle",
							),
							"admin_label"			=> true,
							"description"			=> __( "Select the type of shape that should be applied to the figure navigation handle.", "ts_visual_composer_extend" ),
						),
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Handle Background", "ts_visual_composer_extend" ),
							"param_name"			=> "figure_background_type",
							"width"					=> 300,
							"value"					=> array(
								__( 'Color', "ts_visual_composer_extend" )			=> "color",
								__( 'Pattern', "ts_visual_composer_extend" )      	=> "pattern",
								__( 'Custom Image', "ts_visual_composer_extend" )	=> "image",
							),
							"admin_label"			=> true,
							"description"			=> __( "Select the type of background that should be applied to the figure navigation handle.", "ts_visual_composer_extend" ),
						),												
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "figure_background_color",
							"value"             	=> "#ffffff",
							"description"       	=> __( "Define the background color for the figure navigation item.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "figure_background_type", 'value' => "color" ),
						),
						array(
							"type"              	=> "background",
							"heading"           	=> __( "Background Pattern", "ts_visual_composer_extend" ),
							"param_name"        	=> "figure_background_pattern",
							"height"             	=> 200,
							"pattern"             	=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Background_List,
							"value"					=> "",
							"encoding"          	=> "false",
							"description"       	=> __( "Select the background pattern for the figure navigation item.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "figure_background_type", 'value' => 'pattern' )
						),
						array(
							"type"                  => "attach_image",
							"heading"               => __( "Top Image", "ts_visual_composer_extend" ),
							"param_name"            => "figure_background_image",
							"value"                 => "",
							"admin_label"           => false,
							"description"           => __( "Select the custom background image you want to use for the figure navigation item.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "figure_background_type", 'value' => "image" ),
						),
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Background Size", "ts_visual_composer_extend" ),
							"param_name"			=> "figure_background_size",
							"width"					=> 150,
							"value"					=> array(
								__( "Cover", "ts_visual_composer_extend" ) 			=> "cover",
								__( "150%", "ts_visual_composer_extend" )			=> "150%",
								__( "200%", "ts_visual_composer_extend" )			=> "200%",
								__( "Contain", "ts_visual_composer_extend" ) 		=> "contain",
								__( "Initial", "ts_visual_composer_extend" ) 		=> "initial",
								__( "Auto", "ts_visual_composer_extend" ) 			=> "auto",
							),
							"description"			=> __( "Select how the custom background image should be sized.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "figure_background_type", 'value' => 'image' )
						),
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Background Repeat", "ts_visual_composer_extend" ),
							"param_name"			=> "figure_background_repeat",
							"width"					=> 150,
							"value"					=> array(
								__( "No Repeat", "ts_visual_composer_extend" )		=> "no-repeat",
								__( "Repeat X + Y", "ts_visual_composer_extend" )	=> "repeat",
								__( "Repeat X", "ts_visual_composer_extend" )		=> "repeat-x",
								__( "Repeat Y", "ts_visual_composer_extend" )		=> "repeat-y"
							),
							"description"			=> __( "Select if and how the background image should be repeated.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "figure_background_type", 'value' => 'image' )
						),
						// Handle Settings
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Handle Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "handle_border_color",
							"value"             	=> "#87CEEB",
							"description"       	=> __( "Define the color for the figure navigation handle.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Handle Width", "ts_visual_composer_extend" ),
							"param_name"            => "handle_border_width",
							"value"                 => "4",
							"min"                   => "1",
							"max"                   => "25",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"       	=> __( "Define the width for the figure navigation handle line.", "ts_visual_composer_extend" ),
						),
						array(
							"type"					=> "switch_button",
							"heading"           	=> __( "Use Icon", "ts_visual_composer_extend" ),
							"param_name"        	=> "figure_icon_handle",
							"value"             	=> "false",
							"admin_label"       	=> true,
							"description"       	=> __( "Switch the toggle if you want to use a font icon in the figure navigation handle.", "ts_visual_composer_extend" )
						),
						array(
							"type" 					=> "icons_panel",
							'heading' 				=> __( 'Handle Icon', 'ts_visual_composer_extend' ),
							'param_name' 			=> 'figure_handle_icon',
							'value'					=> '',
							"settings" 				=> array(
								"emptyIcon" 				=> false,
								'emptyIconValue'			=> 'transparent',
								"type" 						=> 'extensions',
							),
							"description"       	=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorVisualSelector == "true" ? __( "Select the icon you want to display in the handle instead of the automatic numbering.", "ts_visual_composer_extend" ) : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorString),
							"dependency"			=> array( 'element' => "figure_icon_handle", 'value' => "true" ),
						),
						array(
							"type"              	=> "textfield",
							"heading"           	=> __( "Custom Handle Number / Letter", "ts_visual_composer_extend" ),
							"param_name"        	=> "figure_handle_text",
							"value"             	=> "",
							"description"       	=> __( "Enter a custom number or letter for the figure navigation handle; otherwise an automatic number will be applied.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "figure_icon_handle", 'value' => "false" ),
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Handle Icon / Text Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "handle_text_color",
							"value"             	=> "#000000",
							"description"       	=> __( "Define the text or icon color for the figure navigation handle.", "ts_visual_composer_extend" ),
						),
						// Content Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_2",
							"seperator"				=> "Navigation Content",
							"group" 				=> "Navigation Content",
						),
						array(
							"type"              	=> "textfield",
							"heading"           	=> __( "Title", "ts_visual_composer_extend" ),
							"param_name"        	=> "figure_title",
							"value"             	=> "",
							"admin_label"           => true,
							"description"       	=> __( "Enter a title for the figure navigation item.", "ts_visual_composer_extend" ),
							"group" 				=> "Navigation Content",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Title Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "figure_title_color",
							"value"             	=> "#4e4e4d",
							"description"       	=> __( "Define the font color for the figure navigation title.", "ts_visual_composer_extend" ),
							"group" 				=> "Navigation Content",
						),
						array(
							"type"              	=> "textfield",
							"heading"           	=> __( "Description", "ts_visual_composer_extend" ),
							"param_name"        	=> "figure_note",
							"value"             	=> "",
							"admin_label"           => true,
							"description"       	=> __( "Enter a short description for the figure navigation item.", "ts_visual_composer_extend" ),
							"group" 				=> "Navigation Content",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Description Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "figure_note_color",
							"value"             	=> "#787876",
							"description"       	=> __( "Define the font color for the figure navigation description.", "ts_visual_composer_extend" ),
							"group" 				=> "Navigation Content",
						),
						array(
							"type"					=> "textarea_html",
							"heading"				=> __( "Box Content", "ts_visual_composer_extend" ),
							"param_name"			=> "content",
							"value"					=> "",
							"description"			=> __( "Create the content for the figure navigation item.", "ts_visual_composer_extend" ),
							"group" 				=> "Navigation Content",
						),
						// Link Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_3",
							"seperator"				=> "Link Settings",
							"group" 				=> "Link Settings",
						),
						array(
							"type"                  => "switch_button",
							"heading"			    => __( 'Use for Page Navigation', "ts_visual_composer_extend" ),
							"param_name"		    => "scroll_navigate",
							"value"                 => "false",
							"admin_label"       	=> true,
							"description"		    => __( "Switch the toggle if you want to use this button to navigate to another section on the same page.", "ts_visual_composer_extend" ),
							"group" 				=> "Link Settings",
						),
						array(
							"type" 					=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ParameterLinkPicker['enabled'] == "false" ? "vc_link" : "advancedlinks"),
							"heading" 				=> __("Link", "ts_visual_composer_extend"),
							"param_name" 			=> "button_link",
							"description" 			=> __("Provide a link to another site/page for the figure navigation element.", "ts_visual_composer_extend"),
							"dependency"    		=> array( 'element' => 'scroll_navigate', 'value' => "false" ),
							"group" 				=> "Link Settings",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Page Scroll Target", "ts_visual_composer_extend" ),
							"param_name"            => "scroll_target",
							"value"                 => "",
							"description"           => __( "Enter the unique ID for the page section you want to scroll to.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => 'true' ),
							"group" 				=> "Link Settings",
						),
						array(
							"type" 					=> "devicetype_selectors",
							"heading"           	=> __( "Device Type Scroll Offset", "ts_visual_composer_extend" ),
							"param_name"        	=> "scroll_offset",
							"unit"  				=> "px",
							"collapsed"				=> "true",
							"devices" 				=> array(
								"Desktop"           		=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
								"Tablet"            		=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
								"Mobile"            		=> array("default" => 0, "min" => 0, "max" => 250, "step" => 1),
							),
							"value"					=> "desktop:0px;tablet:0px;mobile:0px",
							"description"			=> __( "Define an additional scroll offset to account for menu bars and other top fixed elements.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => 'true' ),
							"group" 				=> "Link Settings",
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Page Scroll Speed", "ts_visual_composer_extend" ),
							"param_name"			=> "scroll_speed",
							"value"					=> "2000",
							"min"					=> "1000",
							"max"					=> "10000",
							"step"					=> "100",
							"unit"					=> 'ms',
							"description"			=> __( "Define the speed that should be used to scroll to the section.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => 'true' ),
							"group" 				=> "Link Settings",
						),							
						array(
							"type"                 	=> "dropdown",
							"heading"               => __( "Page Scroll Easing", "ts_visual_composer_extend" ),
							"param_name"            => "scroll_effect",
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"width"                 => 150,
							"value" 				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Easings_Array,
							"description"           => __( "Select the easing animation that should be applied to the page scroll.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => 'true' ),
							"group" 				=> "Link Settings",
						),
						array(
							"type"                  => "switch_button",
							"heading"			    => __( 'Add Target as Hashtag', "ts_visual_composer_extend" ),
							"param_name"		    => "scroll_hashtag",
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"value"                 => "false",
							"description"		    => __( "Switch the toggle if you want to add the scroll target to the browser URL via hashtag.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => 'true' ),
							"group" 				=> "Link Settings",
						),
						array(
							"type"              	=> "textfield",
							"heading"           	=> __( "Button Text", "ts_visual_composer_extend" ),
							"param_name"        	=> "button_text",
							"value"             	=> "Click Here!",
							"description"       	=> __( "Enter a text for the figure navigation link button.", "ts_visual_composer_extend" ),
							"dependency"			=> "",
							"group" 				=> "Link Settings",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Button Background Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "button_color",
							"value"             	=> "#e9544e",
							"description"       	=> __( "Define the background color for the link button.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"group" 				=> "Link Settings",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Button Font Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "button_font",
							"value"             	=> "#ffffff",
							"description"       	=> __( "Define the font color for the link button.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"group" 				=> "Link Settings",
						),
						// Tooltip Settings
						array(
							"type"					=> "seperator",
							"param_name"			=> "seperator_4",
							"seperator"				=> "Tooltip Settings",
							"group" 				=> "Tooltip Settings",
						),
						array(
							"type"					=> "textarea",
							"heading"				=> __( "Tooltip Content", "ts_visual_composer_extend" ),
							"param_name"			=> "tooltip_content",
							"value"					=> "",
							"description"			=> __( "Enter the tooltip content here (do not use quotation marks).", "ts_visual_composer_extend" ),
							"group" 				=> "Tooltip Settings",
						),
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Tooltip Style", "ts_visual_composer_extend" ),
							"param_name"			=> "tooltip_style",
							"value"             	=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Layouts,
							"description"			=> __( "Select the tooltip style.", "ts_visual_composer_extend" ),
							"group" 				=> "Tooltip Settings",
						),
						array(
							"type"				    => "dropdown",
							"heading"			    => __( "Tooltip Animation", "ts_visual_composer_extend" ),
							"param_name"		    => "tooltip_animation",
							"value"                 => array(
								__("Swing", "ts_visual_composer_extend")                    => "swing",
								__("Fall", "ts_visual_composer_extend")                 	=> "fall",
								__("Grow", "ts_visual_composer_extend")                 	=> "grow",
								__("Slide", "ts_visual_composer_extend")                 	=> "slide",
								__("Fade", "ts_visual_composer_extend")                 	=> "fade",
							),
							"description"		    => __( "Select how the tooltip entry and exit should be animated once triggered.", "ts_visual_composer_extend" ),
							"group"					=> "Tooltip Settings",
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
							"group" 				=> "Tooltip Settings",
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
							"group" 				=> "Tooltip Settings",
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
	if ((class_exists('WPBakeryShortCodesContainer')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Figure_Navigation_Container'))) {
		class WPBakeryShortCode_TS_VCSC_Figure_Navigation_Container extends WPBakeryShortCodesContainer {};
	}
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Figure_Navigation_Item'))) {
		class WPBakeryShortCode_TS_VCSC_Figure_Navigation_Item extends WPBakeryShortCode {};
	}
	// Initialize "TS Figure Navigation" Class
	if (class_exists('TS_Figure_Navigation')) {
		$TS_Figure_Navigation = new TS_Figure_Navigation;
	}
?>