<?php
	if (!class_exists('TS_Circle_Steps')){
		class TS_Circle_Steps{
			function __construct(){
				global $VISUAL_COMPOSER_EXTENSIONS;
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						$this->TS_VCSC_Add_Circle_Loop_Lean();
					} else if (function_exists('vc_map')) {
						add_action('init',									array($this, 'TS_VCSC_Add_Circle_Loop_Element_Container'), 9999999);
						add_action('init',									array($this, 'TS_VCSC_Add_Circle_Loop_Element_Item'), 9999999);
					}
				} else {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Circle_Loop_Lean'), 9999999);
					} else if (function_exists('vc_map')) {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Circle_Loop_Element_Container'), 9999999);
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Circle_Loop_Element_Item'), 9999999);
					}
				}
				if ((is_admin() == false) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAJAX == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAlways == "true")) {
					add_shortcode('TS_VCSC_Circle_Steps_Container',			array($this, 'TS_VCSC_Circle_Steps_Container'));
					add_shortcode('TS_VCSC_Circle_Steps_Item',				array($this, 'TS_VCSC_Circle_Steps_Item'));
				}
			}
			
			// Register Element(s) via LeanMap
			function TS_VCSC_Add_Circle_Loop_Lean() {
				vc_lean_map('TS_VCSC_Circle_Steps_Container', 				array($this, 'TS_VCSC_Add_Circle_Loop_Element_Container'), null);
				vc_lean_map('TS_VCSC_Circle_Steps_Item', 					array($this, 'TS_VCSC_Add_Circle_Loop_Element_Item'), null);
			}
			
			// Circle Steps Container
			function TS_VCSC_Circle_Steps_Container($atts, $content = null){
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
	
				extract(shortcode_atts(array(
					// Circle Setup
					'circle_initial'				=> 1,
					'circle_position'				=> 'right',
					'circle_direction'				=> 'clockwise',
					'circle_speed'					=> 500,
					'circle_indicator'				=> 'numeric',
					'circle_deeplinking'			=> 'none',
					'circle_rtl'					=> 'false',
					'circle_resize'					=> 'false',
					// Mobile Settings
					'mobile_layout'					=> 'columns',	// columns, slider, circle
					'mobile_slider'					=> 640,
					'mobile_large'					=> 720,
					'mobile_small'					=> 480,
					// Circle Styling				
					'circle_strength'				=> 2,
					'circle_radius'					=> 220,
					'circle_color'					=> '#CCCCCC',
					'circle_shadow'					=> 'rgba(0, 0, 0, 0.10)',
					'circle_decoration'				=> 'color',		// color, transparent, gradient_rotate, gradient_fixed, rotate, fixed
					'circle_back'					=> '#F7F7F7',
					'circle_image'					=> '',
					'circle_gradient'				=> '',
					'circle_sizing'					=> 'cover',
					'circle_custom'					=> '440px 440px',
					'circle_repeat'					=> 'no-repeat',
					'circle_padding'				=> 50,
					'circle_margin'					=> 100,					
					// Size Settings
					'size_border' 					=> 3,
					'size_normal' 					=> 100,
					'size_selected' 				=> 150,
					'size_icon'						=> 75,
					// Active Icon Settings
					'icon_color_active'				=> '#D63838',
					'icon_back_active'				=> '#FFF782',
					'icon_border_active'			=> '#D63838',
					'icon_shadow_active'			=> 'rgba(0, 0, 0, 0.25)',
					// Hover Icon Settings
					'icon_color_hover'				=> '#333333',
					'icon_back_hover'				=> '#F7F7F7',
					'icon_border_hover'				=> '#636363',
					'icon_shadow_hover'				=> 'rgba(0, 0, 0, 0.25)',
					// Step Indicator
					'indicator_active_inherit'		=> 'true',
					'indicator_active_border'		=> '#D63838',
					'indicator_active_color'		=> '#D63838',
					'indicator_hover_inherit'		=> 'true',
					'indicator_hover_border'		=> '#636363',
					'indicator_hover_color'			=> '#333333',
					// AutoRotation Settings
					'automatic_rotation'			=> 'false',
					'automatic_interval'			=> 5000,
					'automatic_controls'			=> 'true',
					'automatic_color'				=> '#636363',
					'automatic_hover'				=> 'true',
					// Content Height Settings
					'height_type'					=> 'auto', // auto, fixed, maximum
					'height_fixed'					=> 400,
					'height_maximum'				=> 400,
					// NiceScroll Settings
					'scroll_nice'					=> 'false',
					'scroll_color'					=> '#cacaca',
					'scroll_border'					=> '#ededed',
					// Tooltip Settings
					'tooltipster_allow'				=> 'true',
					'tooltipster_always'			=> 'false',
					'tooltipster_delay'				=> 250,
					'tooltipster_position'			=> 'ts-simptip-position-top',
					'tooltipster_style'				=> 'ts-simptip-style-black',
					'tooltipster_effect'			=> 'swing',
					'tooltipster_offsetx'			=> 0,
					'tooltipster_offsety'			=> 0,
					// Other Settings
					'margin_bottom'					=> 0,
					'margin_top' 					=> 0,
					'el_id' 						=> '',
					'el_class'                  	=> '',
					'css'							=> '',
				),$atts));
				
				// Load Required Files
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					wp_enqueue_style('dashicons');
					if ($scroll_nice == "true") {
						wp_enqueue_style('ts-extend-perfectscrollbar');
						wp_enqueue_script('ts-extend-perfectscrollbar');
					}
					if ($tooltipster_allow == "true") {
						wp_enqueue_style('ts-extend-tooltipster');
						wp_enqueue_script('ts-extend-tooltipster');
					}
					wp_enqueue_style('ts-extend-circlesteps');
					wp_enqueue_script('ts-extend-circlesteps');
					wp_enqueue_style('ts-visual-composer-extend-front');
					wp_enqueue_script('ts-visual-composer-extend-front');
				} else {
					wp_enqueue_style('ts-extend-circlesteps');
				}
				
				// Define Required Variables
				$randomizer							= mt_rand(999999, 9999999);
				$output 							= '';
				
				// Circle Background
				if (($circle_decoration == "color") || ($circle_decoration == "transparent")) {
					$circle_image					= "";
					$circle_gradient				= "";
					if ($circle_decoration == "transparent") {
						$circle_back				= 'transparent';
					}
				} else if (($circle_decoration == "gradient_rotate") || ($circle_decoration == "gradient_fixed")) {
					$circle_image					= "";
					$circle_back					= 'transparent';
					$circle_gradient				= base64_encode($circle_gradient);
				} else if (($circle_decoration == "rotate") || ($circle_decoration == "fixed")) {
					if ($circle_image != '') {
						$circle_back				= 'transparent';
						$circle_image				= wp_get_attachment_image_src($circle_image, 'full');
						$circle_image				= $circle_image[0];
						if (($circle_sizing == "custom") && ($circle_custom != "")) {
							$circle_sizing			= $circle_custom;
						} else if (($circle_sizing == "custom") && ($circle_custom == "")) {
							$circle_sizing			= "cover";
						}
					} else {
						$circle_decoration			= 'transparent';
						$circle_back				= 'transparent';
					}
					$circle_gradient				= "";
				}
				
				if (!empty($el_id)) {
					$steps_id						= $el_id;
				} else {
					$steps_id						= 'ts-vcsc-process-loop-steps-container-' . $randomizer;
				}
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$frontend 						= "true";
					$margin_top						= 40;
				} else {
					$frontend 						= "false";
					$margin_top						= $margin_top;
				}
				
				// Tooltip Adjustments
				$tooltipster_position				= TS_VCSC_TooltipMigratePosition($tooltipster_position);
				$tooltipster_style					= TS_VCSC_TooltipMigrateStyle($tooltipster_style);	
				
				// Create Data Attributes
				$data_circle						= 'data-circle-position="' . $circle_position . '" data-circle-initial="' . ($circle_initial - 1) . '" data-circle-rtl="' . $circle_rtl . '"  data-circle-deeplink="' . $circle_deeplinking . '" data-circle-resize="' . $circle_resize . '" data-circle-speed="' . $circle_speed . '" data-circle-direction="' . $circle_direction . '" data-circle-strength="' . $circle_strength . '" data-circle-color="' . $circle_color . '" data-circle-radius="' . $circle_radius . '" data-circle-indicator="' . $circle_indicator . '"';
				$data_background					= 'data-circle-decoration="' . $circle_decoration . '" data-circle-background="' . $circle_back . '" data-circle-gradient="' . $circle_gradient . '" data-circle-image="' . $circle_image . '" data-circle-repeat="' . $circle_repeat . '" data-circle-sizing="' . $circle_sizing . '" data-circle-shadow="' . $circle_shadow . '"';
				$data_mobile						= 'data-mobile-layout="' . $mobile_layout . '" data-mobile-slider="' . $mobile_slider . '" data-mobile-large="' . $mobile_large . '" data-mobile-small="' . $mobile_small . '"';
				$data_sizes							= 'data-size-border="' . $size_border . '" data-size-normal="' . $size_normal . '" data-size-selected="' . $size_selected . '" data-size-icon="' . $size_icon . '"';
				$data_offsets						= 'data-offset-padding="' . $circle_padding . '" data-offset-margin="' . $circle_margin . '"';
				$data_automatic						= 'data-automatic-allow="' . $automatic_rotation . '" data-automatic-controls="' . $automatic_controls . '" data-automatic-color="' . $automatic_color . '" data-automatic-interval="' . $automatic_interval . '" data-automatic-hover="' . $automatic_hover . '"';
				$data_height						= 'data-height-type="' . $height_type . '" data-height-fixed="' . $height_fixed . '" data-height-maximum="' . $height_maximum . '"';
				$data_scroll						= 'data-scroll-nice="' . $scroll_nice . '" data-scroll-color="' . $scroll_color . '" data-scroll-border="' . $scroll_border . '"';
				$data_tooltip						= 'data-tooltipster-enable="' . $tooltipster_allow . '" data-tooltipster-always="' . $tooltipster_always . '" data-tooltipster-delay="' . $tooltipster_delay . '" data-tooltipster-animation="' . $tooltipster_effect . '" data-tooltipster-position="' . $tooltipster_position . '" data-tooltipster-style="' . $tooltipster_style . '" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
				$data_icons_active					= 'data-active-color="' . $icon_color_active . '" data-active-border="' . $icon_border_active . '" data-active-background="' . $icon_back_active . '" data-active-shadow="' . $icon_shadow_active . '"';
				$data_icons_hover					= 'data-hover-color="' . $icon_color_hover . '" data-hover-border="' . $icon_border_hover . '" data-hover-background="' . $icon_back_hover . '" data-hover-shadow="' . $icon_shadow_hover . '"';
				$data_icons_indicator				= 'data-indicator-active-inherit="' . $indicator_active_inherit . '" data-indicator-active-border="' . $indicator_active_border . '" data-indicator-active-color="' . $indicator_active_color . '" data-indicator-hover-inherit="' . $indicator_hover_inherit . '" data-indicator-hover-border="' . $indicator_hover_border . '" data-indicator-hover-color="' . $indicator_hover_color . '"';

				// WP Bakery Page Builder Class Override
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-process-circle-steps-main-wrapper ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Circle_Steps_Container', $atts);
				} else {
					$css_class 						= 'ts-process-circle-steps-main-wrapper ' . $el_class;
				}
				
				// Create Final Output
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$output .= '<div id="ts-process-circle-fronteditor-wrapper-' . $randomizer . '" class="ts-process-circle-fronteditor-wrapper" data-random="' . $randomizer . '">';
						$output .= '<div id="ts-process-circle-fronteditor-dataset-' . $randomizer . '" class="ts-process-circle-fronteditor-dataset" data-random="' . $randomizer . '">';
							$output .= do_shortcode($content);
						$output .= '</div>';
					$output .= '</div>';
				} else {
					$output .= '<div id="' . $steps_id . '" class="' . $css_class . '" data-random="' . $randomizer . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;" ' . $data_circle . ' ' . $data_background . ' ' . $data_mobile . ' ' . $data_sizes . ' ' . $data_offsets . ' ' . $data_automatic . ' ' . $data_height . ' ' . $data_scroll . ' ' . $data_tooltip . ' ' . $data_icons_active . ' ' . $data_icons_hover . ' ' . $data_icons_indicator . ' data-frontend="' . $frontend . '">';
						$output .= '<div id="ts-process-circle-preloader-wrapper-' . $randomizer . '" class="ts-process-circle-preloader-wrapper" data-random="' . $randomizer . '" style="display: block;"></div>';
						$output .= '<div id="ts-process-circle-dataset-wrapper-' . $randomizer . '" class="ts-process-circle-dataset-wrapper" data-random="' . $randomizer . '">';
							$output .= do_shortcode($content);
						$output .= '</div>';
						$output .= '<div id="ts-process-circle-circle-wrapper-' . $randomizer . '" class="ts-process-circle-circle-wrapper ts-process-circle-text-position-' . $circle_position . ' ts-process-circle-circle-rendering" data-init="false" data-hover="false" data-stop="false" data-random="' . $randomizer . '" style="display: block; opacity: 0;"></div>';
					$output .= '</div>';
				}
				
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
			
			// Single Circle Steps Item
			function TS_VCSC_Circle_Steps_Item($atts, $content = null){
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
				
				extract(shortcode_atts(array(
					'step_replace'					=> 'false',
					'step_icon'						=> '',
					'step_image'					=> '',
					'step_title'					=> '',
					// Title + Content Settings
					'title_color'					=> '#4E4E4E',
					'title_align'					=> 'center',
					'title_size'					=> 26,
					'title_weight'					=> '300',
					'title_type'					=> '',
					'title_family'					=> 'Default',
					'prettify_title'				=> 'none',
					'prettify_icon'					=> '',
					'prettify_image'				=> '',
					'prettify_size'					=> 75,
					'content_color'					=> '#6C6C6C',
					'content_align'					=> 'justify',
					'content_size'					=> 18,
					'content_type'					=> '',
					'content_family'				=> 'Default',
					'content_wpautop'				=> 'true',
					// Icon Settings
					'icon_color_default'			=> '#CCCCCC',
					'icon_back_default'				=> '#FFFFFF',
					'icon_border_default'			=> '#636363',
					'icon_shadow_default'			=> 'rgba(99, 99, 99, 0.25)',
					// Indicator Settings
					'indicator_inherit'				=> 'true',
					'indicator_border'				=> '#636363',
					'indicator_color'				=> '#CCCCCC',
					// Circle Change
					'circle_decoration'				=> 'nochange',		// nochange, original, color, transparent, gradient_rotate, gradient_fixed, rotate, fixed
					'circle_back'					=> '#F7F7F7',
					'circle_image'					=> '',
					'circle_gradient'				=> '',
					'circle_sizing'					=> 'cover',
					'circle_custom'					=> '440px 440px',
					'circle_repeat'					=> 'no-repeat',
					'circle_controls'				=> '#636363',
					// Tooltip Settings
					'tooltip_source'				=> 'title',
					'tooltip_content'				=> '',
					// Other Settings
					'hash_id'						=> '',
					'el_id' 						=> '',
					'el_class'                  	=> '',
					'css'							=> '',
				),$atts));
				
				$output								= '';
				$style								= '';
				$randomizer							= mt_rand(999999, 9999999);
				$wpautop 							= ($content_wpautop == "true" ? true : false);
				
				if (!empty($el_id)) {
					$steps_id						= $el_id;
				} else {
					$steps_id						= $hash_id;
				}
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$frontend 						= "true";
				} else {
					$frontend 						= "false";
				}
				
				if (($step_replace == "true") && (!empty($step_image))) {
					$step_type						= 'image';
					$step_icon						= '';
					$step_image_path 				= wp_get_attachment_image_src($step_image, 'large');
					$step_image_path				= (isset($step_image_path[0]) ? $step_image_path[0] : '');
				} else {
					$step_type						= 'icon';
					$step_icon						= $step_icon;
					$step_image_path				= '';
				}
				if (($prettify_title == "image") && (!empty($prettify_image))) {
					$prettify_path 					= wp_get_attachment_image_src($prettify_image, 'medium');
					$prettify_path					= (isset($prettify_path[0]) ? $prettify_path[0] : '');
				} else {
					$prettify_path					= '';
				}
				
				// Tooltip
				if ($tooltip_source != 'none') {
					if ($tooltip_source == 'title') {
						$Tooltip_Content			= base64_encode(rawurlencode(strip_tags($step_title)));
					} else if ($tooltip_source == 'custom') {
						$Tooltip_Content			= $tooltip_content;
					}
				} else {
					$Tooltip_Content				= '';
				}
				
				// Custom Font Settings		
				if (strpos($title_family, 'Default') === false) {
					$title_font						= TS_VCSC_GetFontFamily($steps_id . " .ts-process-circle-single-title", $title_family, $title_type, false, true, false);
				} else {
					$title_font						= '';
				}
				if (strpos($title_family, 'Default') === false) {
					$content_font					= TS_VCSC_GetFontFamily($steps_id . " .ts-process-circle-single-content", $content_family, $content_type, false, true, false);
				} else {
					$content_font					= '';
				}
				
				// Circle Background
				if (($circle_decoration == "color") || ($circle_decoration == "transparent")) {
					$circle_image					= '';
					$circle_gradient				= '';
					if ($circle_decoration == "transparent") {
						$circle_back				= 'transparent';
					}
				} else if (($circle_decoration == "gradient_rotate") || ($circle_decoration == "gradient_fixed")) {
					$circle_image					= '';
					$circle_back					= 'transparent';
					$circle_gradient				= base64_encode($circle_gradient);
				} else if (($circle_decoration == "rotate") || ($circle_decoration == "fixed")) {
					if ($circle_image != '') {
						$circle_back				= 'transparent';
						$circle_image				= wp_get_attachment_image_src($circle_image, 'full');
						$circle_image				= $circle_image[0];
						if (($circle_sizing == "custom") && ($circle_custom != "")) {
							$circle_sizing			= $circle_custom;
						} else if (($circle_sizing == "custom") && ($circle_custom == "")) {
							$circle_sizing			= "cover";
						}
					} else {
						$circle_decoration			= 'transparent';
						$circle_back				= 'transparent';
					}
					$circle_gradient				= '';
				} else {
					$circle_image					= '';
					$circle_gradient				= '';
					$circle_back					= '';
				}
				
				// WP Bakery Page Builder Class Override
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-circle-loop-steps-item ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Circle_Steps_Item', $atts);
				} else {
					$css_class 						= 'ts-circle-loop-steps-item ' . $el_class;
				}
				
				// Data Attributes
				$data_icon							= 'data-icon="' . $step_icon . '" data-image="' . $step_image_path . '" data-icon-color="' . $icon_color_default . '" data-icon-background="' . $icon_back_default . '" data-icon-border="' . $icon_border_default . '" data-icon-shadow="' . $icon_shadow_default . '"';
				$data_title							= 'data-title="' . base64_encode(rawurlencode(strip_tags($step_title))) . '" data-title-size="' . $title_size . '" data-title-color="' . $title_color . '" data-title-align="' . $title_align . '" data-title-weight="' . $title_weight . '" data-title-font="' . $title_font . '"';
				$data_content						= 'data-content-size="' . $content_size . '" data-content-color="' . $content_color . '" data-content-align="' . $content_align . '" data-content-font="' . $content_font . '"';
				$data_indicator						= 'data-indicator-inherit="' . $indicator_inherit . '" data-indicator-border="' . $indicator_border . '" data-indicator-color="' . $indicator_color . '"';
				$data_circle						= 'data-circle-decoration="' . $circle_decoration . '" data-circle-background="' . $circle_back . '" data-circle-gradient="' . $circle_gradient . '" data-circle-image="' . $circle_image . '" data-circle-repeat="' . $circle_repeat . '" data-circle-sizing="' . $circle_sizing . '" data-circle-custom="' . $circle_custom . '" data-circle-controls="' . $circle_controls . '"';
				$data_prettify						= 'data-prettify-title="' . $prettify_title . '" data-prettify-icon="' . $prettify_icon . '" data-prettify-image="' . $prettify_path . '" data-prettify-size="' . $prettify_size . '"';
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$output .= '<div id="ts-process-circle-fronteditor-single-wrapper-' . $randomizer . '" class="ts-process-circle-fronteditor-single-wrapper">';				
						if (($step_replace == "true") && (!empty($step_image))) {
							$output .= '<div id="ts-process-circle-fronteditor-single-image-' . $randomizer . '" class="ts-process-circle-fronteditor-single-image"><img src="' . $step_image_path . '"/></div>';
						} else if ($step_icon != '') {
							$output .= '<div id="ts-process-circle-fronteditor-single-icon-' . $randomizer . '" class="ts-process-circle-fronteditor-single-icon"><i class="' . $step_icon . '" style="color: ' . $icon_color_default . ';"></i></div>';
						}
						$output .= '<div id="ts-process-circle-fronteditor-single-title-' . $randomizer . '" class="ts-process-circle-fronteditor-title-content" style="color: ' . $title_color . '; text-align: ' . $title_align . '; font-size: ' . $title_size . 'px; line-height: ' . $title_size . 'px; font-weight: ' . $title_weight . ';">' . $step_title . '</div>';
						$output .= '<div id="ts-process-circle-fronteditor-single-content-' . $randomizer . '" class="ts-process-circle-fronteditor-single-content" style="color: ' . $content_color . '; font-size: ' . $content_size . 'px; text-align: ' . $content_align . ';">';
							if (function_exists('wpb_js_remove_wpautop')){
								$output .= wpb_js_remove_wpautop(do_shortcode($content), $wpautop);
							} else {
								$output .= do_shortcode($content);
							}
						$output .= '</div>';
					$output .= '</div>';
				} else {
					$output .= '<div id="' . $steps_id . '" class="ts-process-circle-dataset-single ' . $el_class . '" data-type="' . $step_type . '" data-deeplink="' . $hash_id . '" ' . $data_icon . ' ' . $data_title . ' ' . $data_content . ' ' . $data_indicator . ' ' . $data_circle . ' ' . $data_prettify . '>';
						/*$output .= '<div id="ts-process-circle-dataset-single-prettify-' . $randomizer . '" class="ts-process-circle-dataset-single-prettify">';
							if ($prettify_title == "title") {
							
							} elseif (($prettify_title == "icon") && (!empty($prettify_icon))) {
								
							} elseif (($prettify_title == "image") && (!empty($prettify_path))) {
								
							}
						$output .= '</div>';*/
						$output .= '<div id="ts-process-circle-dataset-single-content-' . $randomizer . '" class="ts-process-circle-dataset-single-content">';
							if (function_exists('wpb_js_remove_wpautop')){
								$output .= wpb_js_remove_wpautop(do_shortcode($content), $wpautop);
							} else {
								$output .= do_shortcode($content);
							}
						$output .= '</div>';
						$output .= '<div id="ts-process-circle-dataset-single-tooltip-' . $randomizer . '" class="ts-process-circle-dataset-single-tooltip">';
							$output .= $Tooltip_Content;
						$output .= '</div>';
					$output .= '</div>';
				}
				
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
			
			function TS_VCSC_Add_Circle_Loop_Element_Container() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Steps Container
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name" 								=> __("TS Circle Steps", "ts_visual_composer_extend"),
					"base" 								=> "TS_VCSC_Circle_Steps_Container",
					"icon" 								=> "ts-composer-element-icon-circle-steps-container",
					"as_parent" 						=> array('only' => 'TS_VCSC_Circle_Steps_Item'),
					"category" 							=> __( "Composium", "ts_visual_composer_extend" ),
					"description" 						=> "Place a circle steps element.",
					"controls" 							=> "full",
					"content_element"                   => true,
					"is_container" 						=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseExtendedNesting == "true" ? false : true),
					"container_not_allowed" 			=> false,
					"show_settings_on_create"           => true,
					"admin_enqueue_js"            		=> "",
					"admin_enqueue_css"           		=> "",
					"js_view" 							=> 'VcColumnView',
					"params" 							=> array(
						// Step Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_1",
							"seperator"					=> "Circle Setup",
						),
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Circle Direction", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_direction",
							"width"             		=> 150,
							"value"             		=> array(
								__( "Clockwise (Right)", "ts_visual_composer_extend" )			=> "clockwise",
								__( "Counterclockwise (Left)", "ts_visual_composer_extend" )	=> "counterclockwise",
							),
							"admin_label"       		=> true,
							"description"       		=> __( "Define in which direction the circle should be rotated.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  	=> "switch_button",
							"heading"			    	=> __( "RTL Adjustments", "ts_visual_composer_extend" ),
							"param_name"		    	=> "circle_rtl",
							"value"                 	=> "false",
							"admin_label"       		=> true,
							"description"		    	=> __( "Switch the toggle if you are using this element on a site with RTL (right to left) layout.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Circle Speed", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_speed",
							"value"             		=> "500",
							"min"               		=> "100",
							"max"               		=> "2000",
							"step"              		=> "100",
							"unit"              		=> 'ms',
							"admin_label"       		=> true,
							"description"       		=> __( "Define the speed in ms at which the circle should be rotated.", "ts_visual_composer_extend" ),
						),		
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Text Position", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_position",
							"width"             		=> 150,
							"value"             		=> array(
								__( "Right", "ts_visual_composer_extend" )             			=> "right",
								__( "Left", "ts_visual_composer_extend" )						=> "left",
								__( "Top", "ts_visual_composer_extend" )						=> "top",
								__( "Bottom", "ts_visual_composer_extend" )						=> "bottom",
							),
							"admin_label"       		=> true,
							"description"       		=> __( "Select where the step content block should be placed in relation to the circle.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Step Indicator", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_indicator",
							"width"             		=> 150,
							"value"             		=> array(
								__( 'Auto Standard Number', "ts_visual_composer_extend" )		=> "numeric",
								__( 'Auto Roman Number', "ts_visual_composer_extend" )      	=> "roman",
								__( 'Auto Letter', "ts_visual_composer_extend" )      			=> "alpha",
								__( "None", "ts_visual_composer_extend" )						=> "none",
							),
							"admin_label"       		=> true,
							"description"       		=> __( "Select if and what type of indicator should be shown, highlighting the step position in the circle.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Initial Step", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_initial",
							"value"             		=> "1",
							"min"               		=> "1",
							"max"               		=> "20",
							"step"              		=> "1",
							"unit"              		=> '',
							"admin_label"       		=> true,
							"description"       		=> __( "Define the step the circle should initially be starting out.", "ts_visual_composer_extend" ),
						),
						array(
							'type' 						=> 'dropdown',
							'heading' 					=> __( 'Step Deeplinking', 'ts_visual_composer_extend' ),
							'param_name' 				=> 'circle_deeplinking',
							'value' => array(
								__('No Deeplinking', 'ts_visual_composer_extend')				=> 'none',
								__('Only for Active Session', 'ts_visual_composer_extend')		=> 'session',
								__('Page Load + Active Session', 'ts_visual_composer_extend')	=> 'all',
							),
							'description' 				=> __( 'Select what type of deeplinking should be applied to the steps.', 'ts_visual_composer_extend' ),
						),
						// Content Height Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_2",
							"seperator"					=> "Content Height Settings",
						),
						array(
							"type"              		=> "messenger",
							"param_name"        		=> "messenger",
							"color"						=> "#006BB7",
							"size"						=> "13",
							"layout"					=> "notice",
							"message"            		=> __( "The height settings below will only apply to content that is shown either above or below the circle, but not to content that is shown to the left or right of the circle.", "ts_visual_composer_extend" ),
						),
						array(
							'type' 						=> 'dropdown',
							'heading' 					=> __( 'Content Height: Type', 'ts_visual_composer_extend' ),
							'param_name' 				=> 'height_type',
							'value' => array(
								__('Adjust Holder Automatically', 'ts_visual_composer_extend')		=> 'auto',
								__('Use Fixed Height for Holder', 'ts_visual_composer_extend')		=> 'fixed',
								__('Use Maximum Height for Holder', 'ts_visual_composer_extend')	=> 'maximum',
							),
							'description' 				=> __( 'Select if and how the height for the step content holder shall be set.', 'ts_visual_composer_extend' ),
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Content Height: Fixed", "ts_visual_composer_extend" ),
							"param_name"        		=> "height_fixed",
							"value"             		=> "400",
							"min"               		=> "240",
							"max"               		=> "960",
							"step"              		=> "1",
							"unit"              		=> "px",
							"dependency"        		=> array( 'element' => "height_type", 'value' => 'fixed' ),
							"description"       		=> __( "Define the fixed height for the content holder, no matter the actual height of the content within.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Content Height: Maximum", "ts_visual_composer_extend" ),
							"param_name"        		=> "height_maximum",
							"value"             		=> "400",
							"min"               		=> "240",
							"max"               		=> "960",
							"step"              		=> "1",
							"unit"              		=> "px",
							"dependency"        		=> array( 'element' => "height_type", 'value' => 'maximum' ),
							"description"       		=> __( "Define the maximum height for the content holder; if content height exceeds the maximum, a scrollbar will be provided.", "ts_visual_composer_extend" ),
						),
						// Mobile (Column) Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_3",
							"seperator"					=> "Mobile Settings",
						),
						
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Mobile Layout", "ts_visual_composer_extend" ),
							"param_name"        		=> "mobile_layout",
							"width"             		=> 150,
							"value"             		=> array(
								__( "Force Column(s) Layout", "ts_visual_composer_extend" )				=> "columns",
								//__( "Force Slider Layout", "ts_visual_composer_extend" )				=> "slider",
								__( "Attempt to Maintain Circle", "ts_visual_composer_extend" )			=> "circle",
							),
							"admin_label"       		=> true,
							"description"       		=> __( "Define which layout you want to use on smaller devices.", "ts_visual_composer_extend" ),
						),
						/*array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Slider Switch", "ts_visual_composer_extend" ),
							"param_name"        		=> "mobile_slider",
							"value"             		=> "640",
							"min"               		=> "360",
							"max"               		=> "1280",
							"step"              		=> "1",
							"unit"              		=> "px",
							"dependency"        		=> array( 'element' => "mobile_layout", 'value' => 'slider' ),
							"description"       		=> __( "Define the width at which the element should switch to a basic slider layout.", "ts_visual_composer_extend" ),
						),*/
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Two Columns Switch", "ts_visual_composer_extend" ),
							"param_name"        		=> "mobile_large",
							"value"             		=> "720",
							"min"               		=> "360",
							"max"               		=> "1280",
							"step"              		=> "1",
							"unit"              		=> "px",
							"dependency"        		=> array( 'element' => "mobile_layout", 'value' => 'columns' ),
							"description"       		=> __( "Define the width at which the element should switch to a basic two column layout.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Single Column Switch", "ts_visual_composer_extend" ),
							"param_name"        		=> "mobile_small",
							"value"             		=> "480",
							"min"               		=> "180",
							"max"               		=> "780",
							"step"              		=> "1",
							"unit"              		=> "px",
							"dependency"        		=> array( 'element' => "mobile_layout", 'value' => 'columns' ),
							"description"       		=> __( "Define the width at which the element should switch to a basic one column layout.", "ts_visual_composer_extend" ),
						),
						// AutoPlay Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_4",
							"seperator"					=> "AutoPlay Settings",
						),
						array(
							"type"                  	=> "switch_button",
							"heading"			    	=> __( "Use AutoPlay", "ts_visual_composer_extend" ),
							"param_name"		    	=> "automatic_rotation",
							"value"                 	=> "false",
							"admin_label"       		=> true,
							"description"		    	=> __( "Switch the toggle if you want to apply an AutoPlay to the circle steps.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "AutoPlay Speed", "ts_visual_composer_extend" ),
							"param_name"        		=> "automatic_interval",
							"value"             		=> "5000",
							"min"               		=> "2000",
							"max"               		=> "10000",
							"step"              		=> "100",
							"unit"              		=> "ms",
							"dependency"        		=> array( 'element' => "automatic_rotation", 'value' => 'true' ),
							"description"       		=> __( "Define the autoplay interval speed in ms.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  	=> "switch_button",
							"heading"			    	=> __( "Show Controls", "ts_visual_composer_extend" ),
							"param_name"		    	=> "automatic_controls",
							"value"                 	=> "true",
							"description"		    	=> __( "Switch the toggle if you want to show play and pause control buttons for the autoplay feature.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "automatic_rotation", 'value' => 'true' ),
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Controls Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "automatic_color",
							"value"             		=> "#CCCCCC",
							"description"       		=> __( "Define the color for the autoplay controls.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "automatic_controls", 'value' => 'true' ),
						),
						array(
							"type"                  	=> "switch_button",
							"heading"			    	=> __( "Stop on Hover", "ts_visual_composer_extend" ),
							"param_name"		    	=> "automatic_hover",
							"value"                 	=> "true",
							"description"		    	=> __( "Switch the toggle if you want to automatically pause the autoplay when hovering over the element.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "automatic_rotation", 'value' => 'true' ),
						),
						// Circle Styling
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_5",
							"seperator"					=> "Circle Styling",
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Circle: Radius", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_radius",
							"value"             		=> "220",
							"min"               		=> "100",
							"max"               		=> "400",
							"step"              		=> "1",
							"unit"              		=> "px",
							"admin_label"       		=> true,
							"description"       		=> __( "Define the (maximum) radius for the circle.", "ts_visual_composer_extend" ),
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Circle: Border Strength", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_strength",
							"value"             		=> "2",
							"min"               		=> "1",
							"max"               		=> "10",
							"step"              		=> "1",
							"unit"              		=> "px",
							"description"       		=> __( "Define the border strength for the circle.", "ts_visual_composer_extend" ),
							"group"						=> "Circle Styling",
						),		
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Circle: Border Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_color",
							"value"             		=> "#CCCCCC",
							"description"       		=> __( "Define the border color for the circle.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group"						=> "Circle Styling",
						),						
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Circle: Shadow Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_shadow",
							"value"             		=> "rgba(0, 0, 0, 0.10)",
							"description"       		=> __( "Define the shadow color for the circle.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group"						=> "Circle Styling",
						),						
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Circle: Background Type", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_decoration",
							"width"             		=> 150,
							"value"             		=> array(
								__( "Solid Color", "ts_visual_composer_extend" )			=> "color",
								__( "Transparent", "ts_visual_composer_extend" )			=> "transparent",
								__( "Rotating Gradient", "ts_visual_composer_extend" )		=> "gradient_rotate",
								__( "Fixed Gradient", "ts_visual_composer_extend" )			=> "gradient_fixed",
								__( "Rotating Image", "ts_visual_composer_extend" )			=> "rotate",
								__( "Fixed Image", "ts_visual_composer_extend" )			=> "fixed",
							),
							"admin_label"       		=> true,
							"description"       		=> __( "Define what type of circle background you want to apply.", "ts_visual_composer_extend" ),
							"group"						=> "Circle Styling",
						),						
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Circle: Background Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_back",
							"value"             		=> "#F7F7F7",
							"description"       		=> __( "Define the background color for the circle.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "circle_decoration", 'value' => 'color' ),
							"group"						=> "Circle Styling",
						),						
						array(
							"type"						=> "advanced_gradient",
							"heading"					=> __("Circle: Gradient Background", "ts_visual_composer_extend"),						
							"param_name"				=> "circle_gradient",
							"description"				=> __('Use the controls above to create a custom gradient background for the element.', 'ts_visual_composer_extend'),
							"dependency"        		=> array( 'element' => "circle_decoration", 'value' => array('gradient_rotate', 'gradient_fixed') ),
							"group"						=> "Circle Styling",
						),
						array(
							'type' 						=> 'dropdown',
							'heading' 					=> __( 'Circle: Background Sizing', 'ts_visual_composer_extend' ),
							'param_name' 				=> 'circle_sizing',
							'value' => array(
								__('Cover', 'ts_visual_composer_extend')				=> 'cover',
								__('Contain', 'ts_visual_composer_extend')				=> 'contain',
								__('Auto', 'ts_visual_composer_extend')					=> 'auto',
								__('Custom', 'ts_visual_composer_extend')				=> 'custom',
							),
							'description' 				=> __( 'Select how the background image should be sized and/or scaled.', 'ts_visual_composer_extend' ),
							"dependency"        		=> array( 'element' => "circle_decoration", 'value' => array('rotate', 'fixed') ),
							"group"						=> "Circle Styling",
						),
						array(
							"type"                      => "textfield",
							"heading"                   => __( "Circle: Image Sizing", "ts_visual_composer_extend" ),
							"param_name"                => "circle_custom",
							"value"                     => "440px 440px",
							"description"               => __( "Enter the custom sizing values for the background image.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "circle_sizing", 'value' => 'custom' ),
							"group"						=> "Circle Styling",
						),
						array(
							"type" 						=> "dropdown",
							"heading" 					=> __( "Circle: Background Repeat", "ts_visual_composer_extend" ),
							"param_name" 				=> "circle_repeat",
							"value" 					=> array(
								__( "No Repeat", "ts_visual_composer_extend" )		=> "no-repeat",
								__( "Repeat X + Y", "ts_visual_composer_extend" )	=> "repeat",
								__( "Repeat X", "ts_visual_composer_extend" )		=> "repeat-x",
								__( "Repeat Y", "ts_visual_composer_extend" )		=> "repeat-y"
							),
							"description" 				=> __("Select if and how the background image should be repeated."),
							"dependency"        		=> array( 'element' => "circle_decoration", 'value' => array('rotate', 'fixed') ),
							"group"						=> "Circle Styling",
						),	
						array(
							"type"                  	=> "attach_image",
							"heading"               	=> __( "Circle: Background Image", "ts_visual_composer_extend" ),
							"param_name"            	=> "circle_image",
							"value"                 	=> "",
							"description"           	=> __( "Select the background image for the circle.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "circle_decoration", 'value' => array('rotate', 'fixed') ),
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Circle: Left/Right Offset", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_padding",
							"value"             		=> "50",
							"min"               		=> "0",
							"max"               		=> "100",
							"step"              		=> "1",
							"unit"              		=> "px",
							"description"       		=> __( "Define the left or right offset for the circle.", "ts_visual_composer_extend" ),
							"group"						=> "Circle Styling",
						),	
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Circle: Top/Bottom Offset", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_margin",
							"value"             		=> "100",
							"min"               		=> "0",
							"max"               		=> "250",
							"step"              		=> "1",
							"unit"              		=> "px",
							"description"       		=> __( "Define the top and bottom offset for the circle.", "ts_visual_composer_extend" ),
							"group"						=> "Circle Styling",
						),						
						// Global Step Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_6",
							"seperator"					=> "Step Styling",
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Step: Border Strength", "ts_visual_composer_extend" ),
							"param_name"        		=> "size_border",
							"value"             		=> "3",
							"min"               		=> "1",
							"max"               		=> "6",
							"step"              		=> "1",
							"unit"              		=> "px",
							"description"       		=> __( "Define the border strength for the steps.", "ts_visual_composer_extend" ),
							"group"						=> "Circle Styling",
						),	
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Step: Normal Size", "ts_visual_composer_extend" ),
							"param_name"        		=> "size_normal",
							"value"             		=> "100",
							"min"               		=> "50",
							"max"               		=> "150",
							"step"              		=> "1",
							"unit"              		=> "px",
							"description"       		=> __( "Define the (maximum) standard (non-active) size for the steps.", "ts_visual_composer_extend" ),
							"group"						=> "Circle Styling",
						),	
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Step: Active Size", "ts_visual_composer_extend" ),
							"param_name"        		=> "size_selected",
							"value"             		=> "150",
							"min"               		=> "75",
							"max"               		=> "200",
							"step"              		=> "1",
							"unit"              		=> "px",
							"description"       		=> __( "Define the (maximum) size for the active step.", "ts_visual_composer_extend" ),
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Step: Icon Size", "ts_visual_composer_extend" ),
							"param_name"        		=> "size_icon",
							"value"             		=> "75",
							"min"               		=> "50",
							"max"               		=> "200",
							"step"              		=> "1",
							"unit"              		=> "px",
							"description"       		=> __( "Define the (maximum) size for the icon or image in the step; in relation to the active step size.", "ts_visual_composer_extend" ),
							"group"						=> "Circle Styling",
						),
						// Active Icon Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_7",
							"seperator"					=> "Active Icon Styling",
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Active Icon: Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_color_active",
							"value"             		=> "#D63838",
							"description"       		=> __( "Define the color for the icon in the active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Active Icon: Background Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_back_active",
							"value"             		=> "#FFF782",
							"description"       		=> __( "Define the background color for the icon in the active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Active Icon: Border Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_border_active",
							"value"             		=> "#D63838",
							"description"       		=> __( "Define the border color for the icon in the active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Active Icon: Shadow Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_shadow_active",
							"value"             		=> "rgba(0, 0, 0, 0.25)",
							"description"       		=> __( "Define the shadow color for the icon in the active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group"						=> "Circle Styling",
						),
						array(
							"type"                  	=> "switch_button",
							"heading"			    	=> __( "Active Icon: Indicator Inherit", "ts_visual_composer_extend" ),
							"param_name"		    	=> "indicator_active_inherit",
							"value"                 	=> "true",
							"description"		    	=> __( "Switch the toggle if you want to customize the color settings for the step indicators; otherwise, the colors will be inherited from the icon color settings above.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "circle_indicator", 'value' => array('numeric', 'roman', 'alpha') ),
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Active Icon: Indicator Border", "ts_visual_composer_extend" ),
							"param_name"        		=> "indicator_active_border",
							"value"             		=> "#D63838",
							"description"       		=> __( "Define the border color for the indicator in the active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"        		=> array( 'element' => "indicator_active_inherit", 'value' => 'false' ),
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Active Icon: Indicator Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "indicator_active_color",
							"value"             		=> "#D63838",
							"description"       		=> __( "Define the font color for the indicator in the active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"        		=> array( 'element' => "indicator_active_inherit", 'value' => 'false' ),
							"group"						=> "Circle Styling",
						),
						// Hover Icon Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_8",
							"seperator"					=> "Hover Icon Styling",
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Hover Icon: Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_color_hover",
							"value"             		=> "#333333",
							"description"       		=> __( "Define the hover color for the icon in a non-active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Hover Icon: Background Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_back_hover",
							"value"             		=> "#F7F7F7",
							"description"       		=> __( "Define the hover background color for the icon in a non-active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Hover Icon: Border Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_border_hover",
							"value"             		=> "#636363",
							"description"       		=> __( "Define the hover border color for the icon in a non-active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Hover Icon: Shadow Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_shadow_hover",
							"value"             		=> "rgba(0, 0, 0, 0.25)",
							"description"       		=> __( "Define the hover shadow color for the icon in a non-active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group"						=> "Circle Styling",
						),
						array(
							"type"                  	=> "switch_button",
							"heading"			    	=> __( "Hover Icon: Indicator Inherit", "ts_visual_composer_extend" ),
							"param_name"		    	=> "indicator_hover_inherit",
							"value"                 	=> "true",
							"description"		    	=> __( "Switch the toggle if you want to customize the color settings for the step indicators; otherwise, the colors will be inherited from the icon color settings above.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "circle_indicator", 'value' => array('numeric', 'roman', 'alpha') ),
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Hover Icon: Indicator Border", "ts_visual_composer_extend" ),
							"param_name"        		=> "indicator_hover_border",
							"value"             		=> "#636363",
							"description"       		=> __( "Define the border color for the indicator in the non-active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"        		=> array( 'element' => "indicator_hover_inherit", 'value' => 'false' ),
							"group"						=> "Circle Styling",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Hover Icon: Indicator Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "indicator_hover_color",
							"value"             		=> "#333333",
							"description"       		=> __( "Define the font color for the indicator in the non-active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"        		=> array( 'element' => "indicator_hover_inherit", 'value' => 'false' ),
							"group"						=> "Circle Styling",
						),
						// Tooltip Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_9",
							"seperator"					=> "Tooltip Settings",
							"group"						=> "Additional Effects",
						),
						array(
							"type"                  	=> "switch_button",
							"heading"			    	=> __( "Use Tooltips", "ts_visual_composer_extend" ),
							"param_name"		    	=> "tooltipster_allow",
							"value"                 	=> "true",
							"description"		    	=> __( "Switch the toggle if you want to apply a tooltip to each step icon.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group" 					=> "Additional Effects",
						),						
						array(
							"type"                  	=> "switch_button",
							"heading"			    	=> __( "Tooltip Always", "ts_visual_composer_extend" ),
							"param_name"		    	=> "tooltipster_always",
							"value"                 	=> "false",
							"description"		    	=> __( "Switch the toggle if you want to always show the tooltips for all steps.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"        		=> array( 'element' => "tooltipster_allow", 'value' => 'true' ),
							"group" 					=> "Additional Effects",
						),
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Tooltip Delay", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltipster_delay",
							"value"						=> "250",
							"min"						=> "0",
							"max"						=> "1000",
							"step"						=> "10",
							"unit"						=> 'ms',
							"description"				=> __( "Define the delay between each tooltip after each circle rotation; set to zero (0) for all at once.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "tooltipster_always", 'value' => 'true' ),
							"group" 					=> "Additional Effects",
						),						
						array(
							"type"				    	=> "dropdown",
							"heading"			    	=> __( "Tooltip Position", "ts_visual_composer_extend" ),
							"param_name"		    	=> "tooltipster_position",
							"value"                 	=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Positions,
							"description"		    	=> __( "Select the tooltip position in relation to the hotspot.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "tooltipster_allow", 'value' => 'true' ),
							"group" 					=> "Additional Effects",
						),
						array(
							"type"				    	=> "dropdown",
							"heading"			    	=> __( "Tooltip Animation", "ts_visual_composer_extend" ),
							"param_name"		    	=> "tooltipster_effect",
							"value"                 	=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Animations,
							"description"		    	=> __( "Select how the tooltip entry and exit should be animated once triggered.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "tooltipster_allow", 'value' => 'true' ),
							"group" 					=> "Additional Effects",
						),
						array(
							"type"				    	=> "dropdown",
							"heading"			    	=> __( "Tooltip Style", "ts_visual_composer_extend" ),
							"param_name"		    	=> "tooltipster_style",
							"value"                 	=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Layouts,
							"description"		    	=> __( "Select the tooltip style.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "tooltipster_allow", 'value' => 'true' ),
							"group" 					=> "Additional Effects",
						),
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Tooltip X-Offset", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltipster_offsetx",
							"value"						=> "0",
							"min"						=> "-100",
							"max"						=> "100",
							"step"						=> "1",
							"unit"						=> 'px',
							"description"				=> __( "Define an optional X-Offset for the tooltip position.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "tooltipster_allow", 'value' => 'true' ),
							"group" 					=> "Additional Effects",
						),
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Tooltip Y-Offset", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltipster_offsety",
							"value"						=> "0",
							"min"						=> "-100",
							"max"						=> "100",
							"step"						=> "1",
							"unit"						=> 'px',
							"description"				=> __( "Define an optional Y-Offset for the tooltip position.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "tooltipster_allow", 'value' => 'true' ),
							"group" 					=> "Additional Effects",
						),
						// NiceScroll Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_10",
							"seperator"					=> "NiceScroll Settings",
							"group"						=> "Additional Effects",
						),
						array(
							"type"                  	=> "switch_button",
							"heading"			    	=> __( "Scrollbar: Custom", "ts_visual_composer_extend" ),
							"param_name"		    	=> "scroll_nice",
							"value"                 	=> "false",
							"description"		    	=> __( "Switch the toggle if you want to apply a custom scrollbar to the step content if taller than circle.", "ts_visual_composer_extend" ),
							"group" 					=> "Additional Effects",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Scrollbar: Main Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "scroll_border",
							"value"             		=> "#cacaca",
							"description"       		=> __( "Define the main color for the scrollbar.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "scroll_nice", 'value' => 'true' ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group" 					=> "Additional Effects",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Scrollbar: Background Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "scroll_color",
							"value"             		=> "#ededed",
							"description"       		=> __( "Define the background color for the scrollbar.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "scroll_nice", 'value' => 'true' ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group" 					=> "Additional Effects",
						),
						// Other Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_11",
							"seperator"					=> "Other Settings",
							"group" 			        => "Other Settings",
						),						
						array(
							"type"                  	=> "switch_button",
							"heading"			    	=> __( "Circle Resize Event", "ts_visual_composer_extend" ),
							"param_name"		    	=> "circle_resize",
							"value"                 	=> "false",
							"description"		    	=> __( "Switch the toggle if you want to trigger a global resize event every time after a step change occured.", "ts_visual_composer_extend" ),
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
			function TS_VCSC_Add_Circle_Loop_Element_Item() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Single Circle Step Item
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                      		=> __( "TS Circle Steps Item", "ts_visual_composer_extend" ),
					"base"                      		=> "TS_VCSC_Circle_Steps_Item",
					"icon" 	                    		=> "ts-composer-element-icon-circle-steps-item",
					"content_element"					=> true,
					"as_child"							=> array('only' => 'TS_VCSC_Circle_Steps_Container'),
					"category"                  		=> __( "Composium", "ts_visual_composer_extend" ),
					"description"               		=> __("Place a single circle steps item", "ts_visual_composer_extend"),
					"admin_enqueue_js"            		=> "",
					"admin_enqueue_css"           		=> "",
					"js_view"							=> "TS_VCSC_CircleStepSingleViewCustom",
					"front_enqueue_js"					=> preg_replace( '/\s/', '%20', TS_VCSC_GetResourceURL('/js/frontend/ts-vcsc-frontend-circlestep-single.min.js')),
					"params"                    		=> array(
						// Main Settings
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_1a",
							"seperator"					=> "Icon Settings",
						),
						array(
							"type"						=> "switch_button",
							"heading"           		=> __( "Use Normal Image", "ts_visual_composer_extend" ),
							"param_name"        		=> "step_replace",
							"value"             		=> "false",
							"admin_label"       		=> true,
							"description"       		=> __( "Switch the toggle to either use an icon or a normal image.", "ts_visual_composer_extend" )
						),
						array(
							"type" 						=> "icons_panel",
							'heading' 					=> __( 'Icon', 'ts_visual_composer_extend' ),
							'param_name' 				=> 'step_icon',
							'value'						=> '',
							"settings" 					=> array(
								"emptyIcon" 					=> false,
								'emptyIconValue'				=> 'transparent',
								"type" 							=> 'extensions',
							),
							"admin_label"				=> true,
							"description"       		=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorVisualSelector == "true" ? __( "Select the icon for the circle step.", "ts_visual_composer_extend" ) : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorString),
							"dependency"        		=> array( 'element' => "step_replace", 'value' => 'false' )
						),						
						array(
							"type"              		=> "attach_image",
							"heading"           		=> __( "Select Image", "ts_visual_composer_extend" ),
							"param_name"        		=> "step_image",
							"value"             		=> "",
							"admin_label"       		=> true,
							"description"       		=> __( "Image must have equal dimensions for scaling purposes (i.e. 100x100).", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "step_replace", 'value' => 'true' )
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Icon: Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_color_default",
							"value"             		=> "#CCCCCC",
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"description"       		=> __( "Define the color for the icon.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "step_replace", 'value' => 'false' )
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Icon: Background", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_back_default",
							"value"             		=> "#FFFFFF",
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"description"       		=> __( "Define the background color for the icon or image.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Icon: Border", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_border_default",
							"value"             		=> "#636363",
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"description"       		=> __( "Define the border color for the icon or image.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Icon: Shadow", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_shadow_default",
							"value"             		=> "rgba(99, 99, 99, 0.25)",
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"description"       		=> __( "Define the shadow color for the icon or image.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_1b",
							"seperator"					=> "Icon Settings",
						),
						array(
							"type"                  	=> "switch_button",
							"heading"			    	=> __( "Indicator: Inherit", "ts_visual_composer_extend" ),
							"param_name"		    	=> "indicator_inherit",
							"value"                 	=> "true",
							"description"		    	=> __( "Switch the toggle if you want to customize the color settings for the optional step indicator; otherwise, the colors will be inherited from the icon color settings above.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Indicator: Border", "ts_visual_composer_extend" ),
							"param_name"        		=> "indicator_border",
							"value"             		=> "#636363",
							"description"       		=> __( "Define the border color for the indicator in the non-active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"        		=> array( 'element' => "indicator_inherit", 'value' => 'false' ),
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Indicator: Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "indicator_color",
							"value"             		=> "#CCCCCC",
							"description"       		=> __( "Define the font color for the indicator in the non-active step.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"        		=> array( 'element' => "indicator_inherit", 'value' => 'false' ),
						),
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_1c",
							"seperator"					=> "Circle Settings",
						),
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Circle: Background Type", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_decoration",
							"width"             		=> 150,
							"value"             		=> array(
								__( "No Change", "ts_visual_composer_extend" )				=> "nochange",
								__( "Restore Original", "ts_visual_composer_extend" )		=> "original",
								__( "Solid Color", "ts_visual_composer_extend" )			=> "color",
								__( "Transparent", "ts_visual_composer_extend" )			=> "transparent",
								__( "Rotating Gradient", "ts_visual_composer_extend" )		=> "gradient_rotate",
								__( "Fixed Gradient", "ts_visual_composer_extend" )			=> "gradient_fixed",
								__( "Rotating Image", "ts_visual_composer_extend" )			=> "rotate",
								__( "Fixed Image", "ts_visual_composer_extend" )			=> "fixed",
							),
							"description"       		=> __( "Define what type of circle background you want to apply.", "ts_visual_composer_extend" ),
						),						
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Circle: Background Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_back",
							"value"             		=> "#F7F7F7",
							"description"       		=> __( "Define the background color for the circle.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "circle_decoration", 'value' => 'color' ),
						),						
						array(
							"type"						=> "advanced_gradient",
							"heading"					=> __("Circle: Gradient Background", "ts_visual_composer_extend"),						
							"param_name"				=> "circle_gradient",
							"description"				=> __('Use the controls above to create a custom gradient background for the element.', 'ts_visual_composer_extend'),
							"dependency"        		=> array( 'element' => "circle_decoration", 'value' => array('gradient_rotate', 'gradient_fixed') ),
						),
						array(
							'type' 						=> 'dropdown',
							'heading' 					=> __( 'Circle: Background Sizing', 'ts_visual_composer_extend' ),
							'param_name' 				=> 'circle_sizing',
							'value' => array(
								__('Cover', 'ts_visual_composer_extend')				=> 'cover',
								__('Contain', 'ts_visual_composer_extend')				=> 'contain',
								__('Auto', 'ts_visual_composer_extend')					=> 'auto',
								__('Custom', 'ts_visual_composer_extend')				=> 'custom',
							),
							'description' 				=> __( 'Select how the background image should be sized and/or scaled.', 'ts_visual_composer_extend' ),
							"dependency"        		=> array( 'element' => "circle_decoration", 'value' => array('rotate', 'fixed') ),
						),
						array(
							"type"                      => "textfield",
							"heading"                   => __( "Circle: Image Sizing", "ts_visual_composer_extend" ),
							"param_name"                => "circle_custom",
							"value"                     => "440px 440px",
							"description"               => __( "Enter the custom sizing values for the background image.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "circle_sizing", 'value' => 'custom' ),
						),
						array(
							"type" 						=> "dropdown",
							"heading" 					=> __( "Circle: Background Repeat", "ts_visual_composer_extend" ),
							"param_name" 				=> "circle_repeat",
							"value" 					=> array(
								__( "No Repeat", "ts_visual_composer_extend" )		=> "no-repeat",
								__( "Repeat X + Y", "ts_visual_composer_extend" )	=> "repeat",
								__( "Repeat X", "ts_visual_composer_extend" )		=> "repeat-x",
								__( "Repeat Y", "ts_visual_composer_extend" )		=> "repeat-y"
							),
							"description" 				=> __("Select if and how the background image should be repeated."),
							"dependency"        		=> array( 'element' => "circle_decoration", 'value' => array('rotate', 'fixed') ),
						),	
						array(
							"type"                  	=> "attach_image",
							"heading"               	=> __( "Circle: Background Image", "ts_visual_composer_extend" ),
							"param_name"            	=> "circle_image",
							"value"                 	=> "",
							"description"           	=> __( "Select the background image for the circle.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "circle_decoration", 'value' => array('rotate', 'fixed') ),
						),						
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Circle: Controls Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "circle_controls",
							"value"             		=> "#636363",
							"description"       		=> __( "Define the color for the optional auto-rotate controls.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "circle_decoration", 'value' => array('color', 'transparent', 'gradient_rotate', 'gradient_fixed', 'rotate', 'fixed') ),
						),						
						// Tooltip Settings
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_2a",
							"seperator"					=> "Tooltip Content",
							"group"						=> "Tooltip Content"
						),
						array(
							"type"              		=> "messenger",
							"param_name"        		=> "messenger",
							"size"						=> "13",
							"layout"					=> "notice",
							"message"            		=> __( "The tooltip will only be shown if you globally enabled the tooltip feature in the main container element.", "ts_visual_composer_extend" ),
							"group"						=> "Tooltip Content"
						),
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Tooltip Source", "ts_visual_composer_extend" ),
							"param_name"        		=> "tooltip_source",
							"width"             		=> 150,
							"value"             		=> array(
								__( "Use Step Title", "ts_visual_composer_extend" )             => "title",
								__( "Enter Custom Tooltip", "ts_visual_composer_extend" )		=> "custom",
								__( "No Tooltip", "ts_visual_composer_extend" )					=> "none",
							),
							"admin_label"       		=> true,
							"description"       		=> __( "Select if and what type of tooltip should be used for the circle step.", "ts_visual_composer_extend" ),
							"group"						=> "Tooltip Content"
						),
						array(
							"type"              		=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorBase64TinyMCE == "true" ? "wysiwyg_base64" : "textarea_raw_html"),
							"heading"           		=> __( "Tooltip Content", "ts_visual_composer_extend" ),
							"param_name"        		=> "tooltip_content",
							"minimal"					=> "true",
							"value"             		=> base64_encode(""),
							"description"       		=> __( "Enter the tooltip that should be used for the circle step; HTML code can be used.", "ts_visual_composer_extend" ),
							"dependency"        		=> array( 'element' => "tooltip_source", 'value' => 'custom' ),
							"group"						=> "Tooltip Content"
						),
						// Title Settings
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_3a",
							"seperator"					=> "Title Settings",
							"group"						=> "Step Content"
						),
						array (
							'type' 						=> 'textfield',
							'heading' 					=> __( 'Title', 'ts_visual_composer_extend' ),
							'param_name' 				=> 'step_title',
							"admin_label"				=> true,
							'description' 				=> __( 'Provide a title or name for this step element.', 'ts_visual_composer_extend' ),
							"group"						=> "Step Content"
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Title Font Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "title_color",
							"value"             		=> "#4E4E4E",
							"description"       		=> __( "Define the font color for the title.", "ts_visual_composer_extend" ),
							"group"						=> "Step Content"
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Title Font Size", "ts_visual_composer_extend" ),
							"param_name"        		=> "title_size",
							"value"             		=> "26",
							"min"               		=> "16",
							"max"               		=> "60",
							"step"              		=> "1",
							"unit"              		=> 'px',
							"description"       		=> __( "Define the font size for the title.", "ts_visual_composer_extend" ),
							"group"						=> "Step Content"
						),						
						array(
							"type"						=> "fontsmanager",
							"heading"					=> __( "Title Font Family", "ts_visual_composer_extend" ),
							"param_name"				=> "title_family",
							"value"						=> "",
							"default"					=> "true",
							"connector"					=> "title_type",
							"description"				=> __( "Select the font to be used for the title text.", "ts_visual_composer_extend" ),
							"group" 					=> "Step Content"
						),
						array(
							"type"						=> "hidden_input",
							"param_name"				=> "title_type",
							"value"						=> "",
							"group" 					=> "Step Content"
						),						
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Title Font Weight", "ts_visual_composer_extend" ),
							"param_name"        		=> "title_weight",
							"width"             		=> 150,
							"value"             		=> array(
								__( 'Normal', "ts_visual_composer_extend" )   		=> "normal",
								__( 'Bold', "ts_visual_composer_extend" )     		=> "bold",
								__( 'Bolder', "ts_visual_composer_extend" )   		=> "bolder",
								__( 'Light', "ts_visual_composer_extend" )    		=> "300",
								__( 'Lighter', "ts_visual_composer_extend" )		=> "100",
							),
							"std"						=> "300",
							"default"					=> "300",
							"description"       		=> __( "Select the font weight for the title text.", "ts_visual_composer_extend" ),
							"group"						=> "Step Content"
						),
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Title Align", "ts_visual_composer_extend" ),
							"param_name"        		=> "title_align",
							"width"             		=> 150,
							"value"             		=> array(
								__( "Center", "ts_visual_composer_extend" )                   	=> "center",
								__( "Left", "ts_visual_composer_extend" )                      	=> "left",
								__( "Right", "ts_visual_composer_extend" )                    	=> "right",
								__( "Justify", "ts_visual_composer_extend" )                   	=> "justify",

							),
							"std"						=> "center",
							"default"					=> "center",
							"description"       		=> __( "Select how the title text should be aligned.", "ts_visual_composer_extend" ),
							"group"						=> "Step Content"
						),
						// Content Settings
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_3b",
							"seperator"					=> "Content Settings",
							"group"						=> "Step Content"
						),
						array(
							"type"						=> "textarea_html",
							"heading"					=> __( "Content", "ts_visual_composer_extend" ),
							"param_name"				=> "content",
							"value"						=> "",
							"description"				=> __( "Create the content for this step element.", "ts_visual_composer_extend" ),
							"group"						=> "Step Content"
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Content Font Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "content_color",
							"value"             		=> "#6C6C6C",
							"description"       		=> __( "Define the font color for the content.", "ts_visual_composer_extend" ),
							"group"						=> "Step Content"
						),
						array(
							"type"              		=> "nouislider",
							"heading"           		=> __( "Content Font Size", "ts_visual_composer_extend" ),
							"param_name"        		=> "content_size",
							"value"             		=> "18",
							"min"               		=> "12",
							"max"               		=> "60",
							"step"              		=> "1",
							"unit"              		=> 'px',
							"description"       		=> __( "Define the font size for the content.", "ts_visual_composer_extend" ),
							"group"						=> "Step Content"
						),
						array(
							"type"						=> "fontsmanager",
							"heading"					=> __( "Content Font Family", "ts_visual_composer_extend" ),
							"param_name"				=> "content_family",
							"value"						=> "",
							"default"					=> "true",
							"connector"					=> "content_type",
							"description"				=> __( "Select the font to be used for the content text.", "ts_visual_composer_extend" ),
							"group" 					=> "Step Content"
						),
						array(
							"type"						=> "hidden_input",
							"param_name"				=> "content_type",
							"value"						=> "",
							"group" 					=> "Step Content"
						),							
						array(
							"type"              		=> "dropdown",
							"heading"           		=> __( "Content Align", "ts_visual_composer_extend" ),
							"param_name"        		=> "content_align",
							"width"             		=> 150,
							"value"             		=> array(
								__( "Justify", "ts_visual_composer_extend" )                   	=> "justify",
								__( "Center", "ts_visual_composer_extend" )                   	=> "center",
								__( "Left", "ts_visual_composer_extend" )                      	=> "left",
								__( "Right", "ts_visual_composer_extend" )                    	=> "right",
							),
							"std"						=> "justify",
							"default"					=> "justify",
							"description"       		=> __( "Select how the content text should be aligned.", "ts_visual_composer_extend" ),
							"group"						=> "Step Content"
						),
						// Other Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_4a",
							"seperator"					=> "Other Settings",
							"group" 			        => "Other Settings",
						),
						array (
							'type' 						=> 'auto_generate',
							'heading' 					=> __( 'Deeplink ID', 'ts_visual_composer_extend' ),
							'param_name' 				=> "hash_id",
							"prefix"					=> 'step-',
							'description' 				=> __( 'This is the automatic identifier used for the optional deeplinking; it can not be changed.', 'ts_visual_composer_extend' ),
							"admin_label"				=> true,
							"group" 					=> "Other Settings",
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
	if ((class_exists('WPBakeryShortCodesContainer')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Circle_Steps_Container'))) {
		class WPBakeryShortCode_TS_VCSC_Circle_Steps_Container extends WPBakeryShortCodesContainer {};
	}
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Circle_Steps_Item'))) {
		class WPBakeryShortCode_TS_VCSC_Circle_Steps_Item extends WPBakeryShortCode {};
	}	
	// Initialize "TS Circle Steps" Class
	if (class_exists('TS_Circle_Steps')) {
		$TS_Circle_Steps = new TS_Circle_Steps;
	}
?>