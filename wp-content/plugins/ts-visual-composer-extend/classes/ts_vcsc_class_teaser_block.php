<?php
	if (!class_exists('TS_Teaser_Blocks')){
		class TS_Teaser_Blocks {
			function __construct() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						$this->TS_VCSC_Add_Teaser_Block_Elements_Lean();
					} else if (function_exists('vc_map')) {
						add_action('init',									array($this, 'TS_VCSC_Add_Teaser_Block_Element_Standalone'), 9999999);
						add_action('init',									array($this, 'TS_VCSC_Add_Teaser_Block_Element_Single'), 9999999);
						add_action('init',									array($this, 'TS_VCSC_Add_Teaser_Block_Element_SliderCustom'), 9999999);
					}
				} else {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Teaser_Block_Elements_Lean'), 9999999);
					} else if (function_exists('vc_map')) {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Teaser_Block_Element_Standalone'), 9999999);
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Teaser_Block_Element_Single'), 9999999);
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Teaser_Block_Element_SliderCustom'), 9999999);
					}
				}
				if ((is_admin() == false) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAJAX == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAlways == "true")) {
					add_shortcode('TS_VCSC_Teaser_Block_Standalone',		array($this, 'TS_VCSC_Teaser_Block_Standalone'));
					add_shortcode('TS_VCSC_Teaser_Block_Single',			array($this, 'TS_VCSC_Teaser_Block_Single'));
					add_shortcode('TS_VCSC_Teaser_Block_Slider_Custom',		array($this, 'TS_VCSC_Teaser_Block_Slider_Custom'));
				}
			}
			
			// Register Element(s) via LeanMap
			function TS_VCSC_Add_Teaser_Block_Elements_Lean() {
				vc_lean_map('TS_VCSC_Teaser_Block_Standalone', 				array($this, 'TS_VCSC_Add_Teaser_Block_Element_Standalone'), null);
				vc_lean_map('TS_VCSC_Teaser_Block_Single',					array($this, 'TS_VCSC_Add_Teaser_Block_Element_Single'), null);
				vc_lean_map('TS_VCSC_Teaser_Block_Slider_Custom',			array($this, 'TS_VCSC_Add_Teaser_Block_Element_SliderCustom'), null);
			}
			
			// Standalone Teaser Block
			function TS_VCSC_Teaser_Block_Standalone ($atts, $content = null) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
	
				wp_enqueue_style('ts-visual-composer-extend-front');
				wp_enqueue_script('ts-visual-composer-extend-front');
			
				extract( shortcode_atts( array(
					'height_type'					=> 'auto', // auto, minmessage, fixmessage, minteaser
					'height_custom'					=> 300,					
					'scroll_nice'					=> 'true',
					'scroll_color'					=> '#cacaca',
					'scroll_background'				=> '#ededed',
					'styling_border'				=> '',
					'teaser_graphic'				=> 'true',
					'image'							=> '',
					'image_responsive'				=> 'true',
					'image_width'					=> 300,
					'image_height'					=> 200,
					'attribute_alt'					=> 'false',
					'attribute_alt_value'			=> '',
					'overlay'						=> '#0094FF',
					'color_background'				=> '#ffffff',
					'color_separator'				=> '#049cdb',
					'color_title'					=> '#a2a2a2',
					'color_subtitle'				=> '#aaaaaa',
					'title'							=> '',
					'title_wrap'					=> 'h2',
					'info_position'					=> 'bottom',
					'icon_position'					=> '',
					'icon'							=> '',
					'icon_size'						=> 18,
					'icon_color'					=> '#aaaaaa',
					'content_html'					=> 'false',
					'subtitle'						=> '',
					'link'							=> '',
					'button_type'					=> '',
					'button_square'					=> 'ts-button-3d',
					'button_rounded'				=> 'ts-button-3d ts-button-rounded',
					'button_pill'					=> 'ts-button-3d ts-button-pill',
					'button_circle'					=> 'ts-button-3d ts-button-circle',
					'button_flat'					=> 'ts-dual-buttons-sun-flower',
					'button_hover'					=> 'ts-dual-buttons-preview-default ts-dual-buttons-hover-default',
					'button_text'					=> 'Read More',
					'button_font'					=> 14,
					'font_title_family'				=> 'Default',
					'font_title_type'				=> '',
					'font_title_size'				=> 18,
					'font_content_family'			=> 'Default',
					'font_content_type'				=> '',
					'font_content_size'				=> 14,
					'font_button_family'			=> 'Default',
					'font_button_type'				=> '',
					'content_wpautop'				=> 'true',
					'margin_top'                    => 0,
					'margin_bottom'                 => 0,				
					'el_id' 						=> '',
					'el_class'                  	=> '',
					'css'							=> '',
				), $atts ));
				
				// Load NiceScroll Files
				if (($scroll_nice == "true") && ($height_type == "fixmessage")) {
					wp_enqueue_style('ts-extend-perfectscrollbar');
					wp_enqueue_script('ts-extend-perfectscrollbar');
				} else {
					$scroll_nice					= 'false';
				}
				
				// Public Variables
				$wpautop 							= ($content_wpautop == "true" ? true : false);
				$style_height						= "";
				$style_padding						= "";
				$output 							= "";
				$styling							= "";
				$inline								= TS_VCSC_FrontendAppendCustomRules('style');
		
				// Load Button Files
				if (($button_type != '') && ($button_type != 'flat')) {
					wp_enqueue_style('ts-extend-buttons');
				} else if (($button_type != '') && ($button_type == 'flat')) {
					wp_enqueue_style('ts-extend-buttonsdual');
				}
		
				// Determine Teaser ID
				if (!empty($el_id)) {
					$image_teaser_id				= $el_id;
				} else {
					$image_teaser_id				= 'ts-vcsc-image-teaser-' . mt_rand(999999, 9999999);
				}
				
				// Teaser Link
				$link 								= TS_VCSC_Advancedlinks_GetLinkData($link);
				$a_href								= $link['url'];
				$a_title 							= $link['title'];
				$a_target 							= $link['target'];
				$a_rel								= $link['rel'];
				if (!empty($a_rel)) {
					$a_rel 							= 'rel="' . esc_attr(trim($a_rel)) . '"';
				}

				// Height Settings
				if (($height_type == "minmessage") || ($height_type == "minteaser")) {
					$style_height					= "min-height: " . $height_custom . 'px;';
				} else if ($height_type == "fixmessage") {
					$style_height					= "height: " . $height_custom . 'px;';
				}
				
				// Padding Settings
				if ($button_type == "square") {
					$style_padding					= 'padding-bottom: 80px;';
				} else if ($button_type == "rounded") {
					$style_padding					= 'padding-bottom: 80px;';
				} else if ($button_type == "pill") {
					$style_padding					= 'padding-bottom: 80px;';
				} else if ($button_type == "circle") {
					$style_padding					= 'padding-bottom: 160px;';
				} else if ($button_type == "flat") {
					$style_padding					= 'padding-bottom: 85px;';
				}
		
				// Teaser Image
				if ($teaser_graphic == 'false') {
					$info_position					= "top";
					$alt_attribute					= "";
				} else {
					if ($image_responsive == "true") {
						$teaser_image				= wp_get_attachment_image_src($image, 'full');
					} else {
						$teaser_image				= wp_get_attachment_image_src($image, array($image_width, $image_height));
					}
					if ($teaser_image == false) {
						$teaser_image				= TS_VCSC_GetResourceURL('images/defaults/no_image.jpg');
					} else {
						$teaser_image				= $teaser_image[0];
					}
					$image_extension 				= pathinfo($teaser_image, PATHINFO_EXTENSION);
					if ($attribute_alt == "true") {
						$alt_attribute				= $attribute_alt_value;
					} else {
						$alt_attribute				= basename($teaser_image, "." . $image_extension);
					}
				}
				
				// Teaser Button Type
				if ($button_type == "square") {
					$button_style					= 'ts-button ' . $button_square;
					$button_font					= '';
					$button_padding					= '';
				} else if ($button_type == "rounded") {
					$button_style					= 'ts-button ' . $button_rounded;
					$button_font					= '';
					$button_padding					= '';
				} else if ($button_type == "pill"){
					$button_style					= 'ts-button ' . $button_pill;
					$button_font					= '';
					$button_padding					= '';
				} else if ($button_type == "circle") {
					$button_style					= 'ts-button ' . $button_circle;
					$button_font					= 'font-size: ' . $button_font . 'px;';
					$button_padding					= '';
				} else if ($button_type == "flat"){
					$button_flat					= str_replace("ts-color-button", "ts-dual-buttons", $button_flat);
					$button_style					= $button_flat . ' ' . $button_hover;
					$button_font					= 'font-size: ' . $button_font . 'px;';
					$button_padding					= 'padding: 10px 5px;';
				} else {
					$button_style					= '';
					$button_font					= '';
					$button_padding					= '';
				}
				
				// Teaser Icon Settings
				if ((!empty($icon)) && ($icon != "transparent") && ($icon_position != "")) {
					$icon_style                 	= 'color: ' . $icon_color . '; width:' . $icon_size . 'px; height:' . $icon_size . 'px; font-size:' . $icon_size . 'px; line-height:' . $icon_size . 'px;';
				} else {
					$icon_style						= '';
				}
				
				// Custom Font Settings		
				if (strpos($font_title_family, 'Default') === false) {
					$google_font_title				= TS_VCSC_GetFontFamily($image_teaser_id . " .ts-teaser-title", $font_title_family, $font_title_type, false, true, false);
				} else {
					$google_font_title				= '';
				}
				if (strpos($font_content_family, 'Default') === false) {
					$google_font_content			= TS_VCSC_GetFontFamily($image_teaser_id . " .ts-teaser-text", $font_content_family, $font_content_type, false, true, false);
				} else {
					$google_font_content			= '';
				}
				if (strpos($font_button_family, 'Default') === false) {
					$google_font_button				= TS_VCSC_GetFontFamily($image_teaser_id . " .ts-readmore", $font_button_family, $font_button_type, false, true, false);
				} else {
					$google_font_button				= '';
				}
				
				// Create Styling Output
				if ($inline == "false") {
					$styling .= '<style id="' . $image_teaser_id . '-style" type="text/css">';
				}
					// Border Settings
					$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item {';
						$styling .= str_replace('|', '', $styling_border);
						$styling .= 'background: ' . $color_background . ';';
					$styling .= '}';
					// Various Settings
					$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-padding {';
						$styling .= $style_padding;
						if ($height_type == "minteaser") {
							$styling .= $style_height;
						}
					$styling .= '}';
					// Custom Scrollbar Styling
					if (($scroll_nice == "true") && ($height_type == "fixmessage")) {
						$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-text .ps__scrollbar-x-rail:hover,';
						$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-text .ps__scrollbar-y-rail:hover,';
						$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-text.ps--in-scrolling .ps__scrollbar-x-rail,';
						$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-text.ps--in-scrolling .ps__scrollbar-y-rail {';
							$styling .= 'background-color: ' . $scroll_background . ';';
						$styling .= '}';
						$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-text .ps__scrollbar-x-rail .ps__scrollbar-x,';
						$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-text .ps__scrollbar-y-rail .ps__scrollbar-y {';
							$styling .= 'background-color: ' . $scroll_color . ';';
						$styling .= '}';
					}
				if ($inline == "false") {
					$styling .= '</style>';
				}
				if (($styling != "") && ($inline == "true")) {
					wp_add_inline_style('ts-visual-composer-extend-custom', TS_VCSC_MinifyCSS($styling));
				}
				
				// WP Bakery Page Builder Custom Override
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 					= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Teaser_Block_Standalone', $atts);
				} else {
					$css_class					= $el_class;
				}				
				
				// Custom Style Rules
				if (($styling != "") && ($inline == "false")) {
					$output .= TS_VCSC_MinifyCSS($styling);
				}
				
				// Create Final Output
				$output .= '<div id="' . $image_teaser_id . '" class="ts-teaser ts-teaser-container' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;" data-height-type="' . $height_type . '">';
					$output .= '<div class="ts-teaser-item">';
						$output .= '<div class="ts-teaser-padding">';
							if ($info_position == "top") {
								$output .= '<div class="ts-teaser-head">';
									$output .= '<' . $title_wrap . ' class="ts-teaser-title" style="' . ($teaser_graphic == 'false' ? 'padding-top: 20px;' : '') . ' color: ' . $color_title . '; font-size: ' . $font_title_size . 'px; background: ' . $color_background . '; ' . $google_font_title . '">';
										if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "top")) {
											$output .= '<span style="display: block; width: 100%; text-align: center; margin-top: 0px; margin-bottom: 10px;"><i style="' . $icon_style . '" class="' . $icon . '"></i></span>';
										} else if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "left")) {
											$output .= '<i style="margin-right: 5px; ' . $icon_style . '" class="' . $icon . '"></i>';
										}
										if ($a_href != "") {
											$output .= '<a href="' . $a_href . '" target="' . $a_target . '" ' . $a_rel . '>';
										}
											$output .= $title;
										if ($a_href != "") {
											$output .= '</a>';
										}
										if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "right")) {
											$output .= '<i style="margin-left: 5px; ' . $icon_style . '" class="' . $icon . '"></i>';
										} else if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "bottom")) {
											$output .= '<span style="display: block; width: 100%; text-align: center; margin-top: 10px; margin-bottom: 0px;"><i style="' . $icon_style . '" class="' . $icon . '"></i></span>';
										}
									$output .= '</' . $title_wrap . '>';
								$output .= '</div>';
								$output .= '<div class="ts-teaser-seperator" style="background: ' . $color_separator . ';"></div>';
								$output .= '<div class="ts-teaser-text ts-teaser-' . $height_type . '" data-scroll-nice="' . $scroll_nice . '" data-scroll-color="' . $scroll_color . '" data-scroll-background="' . $scroll_background . '" data-scroll-init="false" style="font-size: ' . $font_content_size . 'px; color: ' . $color_subtitle . '; ' . $google_font_content . ' ' . ((($height_type == "minmessage") || ($height_type == "fixmessage")) ? $style_height : "") . '">';
									if ($content_html == "true") {
										if (function_exists('wpb_js_remove_wpautop')){
											$output .= wpb_js_remove_wpautop(do_shortcode($content), $wpautop);
										} else {
											$output .= do_shortcode($content);
										}
									} else {
										$output .= $subtitle;
									}
								$output .= '</div>';
							}
							if ($teaser_graphic == 'true') {
								$output .= '<div class="ts-teaser-image-container">';
									if ($a_href != '') {
										$output .= '<a href="' . $a_href . '" target="' . $a_target . '" ' . $a_rel . '>';
									}
										$output .= '<img src="' . $teaser_image . '" alt="' . $alt_attribute . '" class="ts-teaser-image">';
										if ($a_href != '') {
											$output .= '<span class="ts-teaser-hovercontent" style="background-color: ' . $overlay . ';"></span>';
											$output .= '<span class="ts-teaser-hoverimage"></span>';
										}
									if ($a_href != '') {
										$output .= '</a>';
									}
								$output .= '</div>';
							}
							if ($info_position == "bottom") {
								$output .= '<div class="ts-teaser-head">';
									$output .= '<' . $title_wrap . ' class="ts-teaser-title" style="color: ' . $color_title . '; font-size: ' . $font_title_size . 'px; background: ' . $color_background . '; ' . $google_font_title . '">';
										if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "top")) {
											$output .= '<span style="display: block; width: 100%; text-align: center; margin-top: 0px; margin-bottom: 10px;"><i style="' . $icon_style . '" class="' . $icon . '"></i></span>';
										} else if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "left")) {
											$output .= '<i style="margin-right: 5px; ' . $icon_style . '" class="' . $icon . '"></i>';
										}
										if ($a_href != "") {
											$output .= '<a href="' . $a_href . '" target="' . $a_target . '" ' . $a_rel . '>';
										}
											$output .= $title;
										if ($a_href != "") {
											$output .= '</a>';
										}
										if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "right")) {
											$output .= '<i style="margin-left: 5px; ' . $icon_style . '" class="' . $icon . '"></i>';
										} else if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "bottom")) {
											$output .= '<span style="display: block; width: 100%; text-align: center; margin-top: 10px; margin-bottom: 0px;"><i style="' . $icon_style . '" class="' . $icon . '"></i></span>';
										}
									$output .= '</' . $title_wrap . '>';
								$output .= '</div>';
								$output .= '<div class="ts-teaser-seperator" style="background: ' . $color_separator . ';"></div>';
								$output .= '<div class="ts-teaser-text ts-teaser-' . $height_type . '" data-scroll-nice="' . $scroll_nice . '" data-scroll-color="' . $scroll_color . '" data-scroll-background="' . $scroll_background . '" data-scroll-init="false" style="font-size: ' . $font_content_size . 'px; color: ' . $color_subtitle . '; ' . $google_font_content . ' ' . ((($height_type == "minmessage") || ($height_type == "fixmessage")) ? $style_height : "") . '">';
									if ($content_html == "true") {
										if (function_exists('wpb_js_remove_wpautop')){
											$output .= wpb_js_remove_wpautop(do_shortcode($content), $wpautop);
										} else {
											$output .= do_shortcode($content);
										}
									} else {
										$output .= $subtitle;
									}
								$output .= '</div>';
							}
							if (($button_type != "") && ($a_href != "")) {
								$output .= '<div class="ts-teaser-button-wrap ts-teaser-button-' . $button_type . '">';
									$output .= '<a href="' . $a_href . '" target="' . trim($a_target) . '" ' . $a_rel . ' class="ts-readmore ' . $button_style . '" style="' . $button_font . ' ' . $button_padding . ' ' . $google_font_button . '"><span>' . $button_text . '</span></a>';
								$output .= '</div>';
							}
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
		
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
			
			// Single Teaser Block for Custom Slider
			function TS_VCSC_Teaser_Block_Single ($atts, $content = null) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
			
				extract( shortcode_atts( array(
					'height_type'					=> 'auto', // auto, minmessage, fixmessage, minteaser
					'height_custom'					=> 300,
					'scroll_nice'					=> 'true',
					'scroll_color'					=> '#cacaca',
					'scroll_background'				=> '#ededed',
					'styling_border'				=> '',
					'teaser_graphic'				=> 'true',
					'image'							=> '',
					'image_responsive'				=> 'true',
					'image_width'					=> 300,
					'image_height'					=> 200,
					'attribute_alt'					=> 'false',
					'attribute_alt_value'			=> '',
					'overlay'						=> '#0094FF',
					'color_background'				=> '#ffffff',
					'color_separator'				=> '#049cdb',
					'color_title'					=> '#a2a2a2',
					'color_subtitle'				=> '#aaaaaa',
					'title'							=> '',
					'title_wrap'					=> 'h2',
					'info_position'					=> 'bottom',
					'icon_position'					=> '',
					'icon'							=> '',
					'icon_size'						=> 18,
					'icon_color'					=> '#aaaaaa',
					'content_html'					=> 'false',
					'subtitle'						=> '',
					'link'							=> '',
					'button_type'					=> '',
					'button_square'					=> 'ts-button-3d',
					'button_rounded'				=> 'ts-button-3d ts-button-rounded',
					'button_pill'					=> 'ts-button-3d ts-button-pill',
					'button_circle'					=> 'ts-button-3d ts-button-circle',
					'button_flat'					=> 'ts-dual-buttons-sun-flower',
					'button_hover'					=> 'ts-dual-buttons-preview-default ts-dual-buttons-hover-default',
					'button_text'					=> 'Read More',
					'button_font'					=> 14,
					'font_title_family'				=> 'Default',
					'font_title_type'				=> '',
					'font_title_size'				=> 18,
					'font_content_family'			=> 'Default',
					'font_content_type'				=> '',
					'font_content_size'				=> 14,
					'font_button_family'			=> 'Default',
					'font_button_type'				=> '',
					'content_wpautop'				=> 'true',
					'border_width'					=> 1,
					'border_color'					=> '#dddddd',
					'border_radius'					=> 20,
					'el_id' 						=> '',
					'el_class'                  	=> '',
					'css'							=> '',
				), $atts ));
				
				// Load NiceScroll Files
				if (($scroll_nice == "true") && ($height_type == "fixmessage")) {
					wp_enqueue_style('ts-extend-perfectscrollbar');
					wp_enqueue_script('ts-extend-perfectscrollbar');
				} else {
					$scroll_nice					= 'false';
				}
				
				// Public Variables
				$wpautop 							= ($content_wpautop == "true" ? true : false);
				$output								= "";
				$style_height						= "";
				$style_padding						= "";
				$styling							= "";
				$inline								= TS_VCSC_FrontendAppendCustomRules('style');
				
				// Create Teaser ID
				$image_teaser_id					= 'ts-vcsc-image-teaser-' . mt_rand(999999, 9999999);
				
				// Teaser Link
				$link 								= TS_VCSC_Advancedlinks_GetLinkData($link);
				$a_href								= $link['url'];
				$a_title 							= $link['title'];
				$a_target 							= $link['target'];
				$a_rel								= $link['rel'];
				if (!empty($a_rel)) {
					$a_rel 							= 'rel="' . esc_attr(trim($a_rel)) . '"';
				}
				
				// Border Settings
				$style_border						= 'border: ' . $border_width . 'px solid ' . $border_color . ';';
				if ($border_radius > 0) {
					$style_border					.= '-webkit-border-radius: ' . $border_radius . 'px; -moz-border-radius: ' . $border_radius . 'px; border-radius: ' . $border_radius . 'px;';
				}		
				
				// Height Settings
				if (($height_type == "minmessage") || ($height_type == "minteaser")) {
					$style_height					= "min-height: " . $height_custom . 'px;';
				} else if ($height_type == "fixmessage") {
					$style_height					= "height: " . $height_custom . 'px;';
				}
				
				// Padding Settings
				if ($button_type == "square") {
					$style_padding					= 'padding-bottom: 80px;';
				} else if ($button_type == "rounded") {
					$style_padding					= 'padding-bottom: 80px;';
				} else if ($button_type == "pill") {
					$style_padding					= 'padding-bottom: 80px;';
				} else if ($button_type == "circle") {
					$style_padding					= 'padding-bottom: 160px;';
				} else if ($button_type == "flat") {
					$style_padding					= 'padding-bottom: 85px;';
				}
		
				// Check for Front End Editor
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$frontend_edit					= 'true';
				} else {
					$frontend_edit					= 'false';
				}		
				
				// Teaser Image
				if ($teaser_graphic == 'false') {
					$info_position					= "top";
					$alt_attribute					= "";
				} else {
					if ($image_responsive == "true") {
						$teaser_image				= wp_get_attachment_image_src($image, 'full');
					} else {
						$teaser_image				= wp_get_attachment_image_src($image, array($image_width, $image_height));
					}
					if ($teaser_image == false) {
						$teaser_image				= TS_VCSC_GetResourceURL('images/defaults/no_image.jpg');
					} else {
						$teaser_image				= $teaser_image[0];
					}
					$image_extension 				= pathinfo($teaser_image, PATHINFO_EXTENSION);
					if ($attribute_alt == "true") {
						$alt_attribute				= $attribute_alt_value;
					} else {
						$alt_attribute				= basename($teaser_image, "." . $image_extension);
					}
				}
				
				// Teaser Button Type
				if ($button_type == "square") {
					$button_style				= 'ts-button ' . $button_square;
					$button_font				= '';
					$button_padding				= '';
				} else if ($button_type == "rounded") {
					$button_style				= 'ts-button ' . $button_rounded;
					$button_font				= '';
					$button_padding				= '';
				} else if ($button_type == "pill"){
					$button_style				= 'ts-button ' . $button_pill;
					$button_font				= '';
					$button_padding				= '';
				} else if ($button_type == "circle") {
					$button_style				= 'ts-button ' . $button_circle;
					$button_font				= 'font-size: ' . $button_font . 'px;';
					$button_padding				= '';
				} else if ($button_type == "flat"){
					$button_flat				= str_replace("ts-color-button", "ts-dual-buttons", $button_flat);
					$button_style				= $button_flat . ' ' . $button_hover;
					$button_font				= 'font-size: ' . $button_font . 'px;';
					$button_padding				= 'padding: 10px 5px;';
				} else {
					$button_style				= '';
					$button_font				= '';
					$button_padding				= '';
				}
				
				// Teaser Icon Settings
				if ((!empty($icon)) && ($icon != "transparent") && ($icon_position != "")) {
					$icon_style                 = 'color: ' . $icon_color . '; width:' . $icon_size . 'px; height:' . $icon_size . 'px; font-size:' . $icon_size . 'px; line-height:' . $icon_size . 'px;';
				} else {
					$icon_style					= '';
				}
				
				// Custom Font Settings		
				if (strpos($font_title_family, 'Default') === false) {
					$google_font_title			= TS_VCSC_GetFontFamily($image_teaser_id . " .ts-teaser-title", $font_title_family, $font_title_type, false, true, false);
				} else {
					$google_font_title			= '';
				}
				if (strpos($font_content_family, 'Default') === false) {
					$google_font_content		= TS_VCSC_GetFontFamily($image_teaser_id . " .ts-teaser-text", $font_content_family, $font_content_type, false, true, false);
				} else {
					$google_font_content		= '';
				}
				if (strpos($font_button_family, 'Default') === false) {
					$google_font_button			= TS_VCSC_GetFontFamily($image_teaser_id . " .ts-readmore", $font_button_family, $font_button_type, false, true, false);
				} else {
					$google_font_button			= '';
				}
				
				// Create Styling Output
				if ($inline == "false") {
					$styling .= '<style id="' . $image_teaser_id . '-style" type="text/css">';
				}
					// Border Settings
					$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item {';
						$styling .= str_replace('|', '', $styling_border);
						$styling .= 'background: ' . $color_background . ';';
					$styling .= '}';
					// Various Settings
					$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-padding {';
						$styling .= $style_padding;
						if ($height_type == "minteaser") {
							$styling .= $style_height;
						}
					$styling .= '}';
					// Custom Scrollbar Styling
					if (($scroll_nice == "true") && ($height_type == "fixmessage")) {
						$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-text .ps__scrollbar-x-rail:hover,';
						$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-text .ps__scrollbar-y-rail:hover,';
						$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-text.ps--in-scrolling .ps__scrollbar-x-rail,';
						$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-text.ps--in-scrolling .ps__scrollbar-y-rail {';
							$styling .= 'background-color: ' . $scroll_background . ';';
						$styling .= '}';
						$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-text .ps__scrollbar-x-rail .ps__scrollbar-x,';
						$styling .= 'body #' . $image_teaser_id . ' .ts-teaser-item .ts-teaser-text .ps__scrollbar-y-rail .ps__scrollbar-y {';
							$styling .= 'background-color: ' . $scroll_color . ';';
						$styling .= '}';
					}
				if ($inline == "false") {
					$styling .= '</style>';
				}
				if (($styling != "") && ($inline == "true")) {
					wp_add_inline_style('ts-visual-composer-extend-custom', TS_VCSC_MinifyCSS($styling));
				}
				
				// WP Bakery Page Builder Custom Override
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Teaser_Block_Single', $atts);
				} else {
					$css_class						= $el_class;
				}
				
				// Custom Style Rules
				if (($styling != "") && ($inline == "false")) {
					$output .= TS_VCSC_MinifyCSS($styling);
				}
				
				// Create Final Output
				$output .= '<div id="' . $image_teaser_id . '" class="ts-teaser ts-teaser-container ' . $css_class . '" style="width: 100%; margin: 0px auto; padding: 0px;" data-height-type="' . $height_type . '">';
					$output .= '<div class="ts-teaser-item">';
						$output .= '<div class="ts-teaser-padding">';
							if ($info_position == "top") {
								$output .= '<div class="ts-teaser-head">';
									$output .= '<' . $title_wrap . ' class="ts-teaser-title" style="' . ($teaser_graphic == 'false' ? 'padding-top: 20px;' : '') . ' color: ' . $color_title . '; font-size: ' . $font_title_size . 'px; background: ' . $color_background . '; ' . $google_font_title . '">';
										if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "top")) {
											$output .= '<span style="display: block; width: 100%; text-align: center; margin-top: 0px; margin-bottom: 10px;"><i style="' . $icon_style . '" class="' . $icon . '"></i></span>';
										} else if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "left")) {
											$output .= '<i style="margin-right: 5px; ' . $icon_style . '" class="' . $icon . '"></i>';
										}
										if ($a_href != "") {
											$output .= '<a href="' . $a_href . '" target="' . $a_target . '" ' . $a_rel . '>';
										}
											$output .= $title;
										if ($a_href != "") {
											$output .= '</a>';
										}
										if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "right")) {
											$output .= '<i style="margin-left: 5px; ' . $icon_style . '" class="' . $icon . '"></i>';
										} else if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "bottom")) {
											$output .= '<span style="display: block; width: 100%; text-align: center; margin-top: 10px; margin-bottom: 0px;"><i style="' . $icon_style . '" class="' . $icon . '"></i></span>';
										}
									$output .= '</' . $title_wrap . '>';
								$output .= '</div>';
								$output .= '<div class="ts-teaser-seperator" style="background: ' . $color_separator . ';"></div>';
								$output .= '<div class="ts-teaser-text ts-teaser-' . $height_type . '" data-scroll-nice="' . $scroll_nice . '" data-scroll-color="' . $scroll_color . '" data-scroll-background="' . $scroll_background . '" data-scroll-init="false" style="font-size: ' . $font_content_size . 'px; color: ' . $color_subtitle . '; ' . $google_font_content . ' ' . ((($height_type == "minmessage") || ($height_type == "fixmessage")) ? $style_height : "") . '">';
									if ($content_html == "true") {
										if (function_exists('wpb_js_remove_wpautop')){
											$output .= wpb_js_remove_wpautop(do_shortcode($content), $wpautop);
										} else {
											$output .= do_shortcode($content);
										}
									} else {
										$output .= $subtitle;
									}
								$output .= '</div>';
							}
							if ($teaser_graphic == 'true') {
								$output .= '<div class="ts-teaser-image-container">';
									if ($a_href != '') {
										$output .= '<a href="' . $a_href . '" target="' . $a_target . '" ' . $a_rel . '>';
									}
										$output .= '<img src="' . $teaser_image . '" alt="' . $alt_attribute . '" class="ts-teaser-image">';
										if ($a_href != '') {
											$output .= '<span class="ts-teaser-hovercontent" style="background-color: ' . $overlay . '"></span>';
											$output .= '<span class="ts-teaser-hoverimage"></span>';
										}
									if ($a_href != '') {
										$output .= '</a>';
									}
								$output .= '</div>';
							}
							if ($info_position == "bottom") {
								$output .= '<div class="ts-teaser-head">';
									$output .= '<' . $title_wrap . ' class="ts-teaser-title" style="color: ' . $color_title . '; font-size: ' . $font_title_size . 'px; background: ' . $color_background . '; ' . $google_font_title . '">';
										if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "top")) {
											$output .= '<span style="display: block; width: 100%; text-align: center; margin-top: 0px; margin-bottom: 10px;"><i style="' . $icon_style . '" class="' . $icon . '"></i></span>';
										} else if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "left")) {
											$output .= '<i style="margin-right: 5px; ' . $icon_style . '" class="' . $icon . '"></i>';
										}
										if ($a_href != "") {
											$output .= '<a href="' . $a_href . '" target="' . $a_target . '" ' . $a_rel . '>';
										}
											$output .= $title;
										if ($a_href != "") {
											$output .= '</a>';
										}
										if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "right")) {
											$output .= '<i style="margin-left: 5px; ' . $icon_style . '" class="' . $icon . '"></i>';
										} else if ((!empty($icon)) && ($icon != "transparent") && ($icon_position == "bottom")) {
											$output .= '<span style="display: block; width: 100%; text-align: center; margin-top: 10px; margin-bottom: 0px;"><i style="' . $icon_style . '" class="' . $icon . '"></i></span>';
										}
									$output .= '</' . $title_wrap . '>';
								$output .= '</div>';
								$output .= '<div class="ts-teaser-seperator" style="background: ' . $color_separator . ';"></div>';
								$output .= '<div class="ts-teaser-text ts-teaser-' . $height_type . '" data-scroll-nice="' . $scroll_nice . '" data-scroll-color="' . $scroll_color . '" data-scroll-background="' . $scroll_background . '" data-scroll-init="false" style="font-size: ' . $font_content_size . 'px; color: ' . $color_subtitle . '; ' . $google_font_content . ' ' . ((($height_type == "minmessage") || ($height_type == "fixmessage")) ? $style_height : "") . '">';
									if ($content_html == "true") {
										if (function_exists('wpb_js_remove_wpautop')){
											$output .= wpb_js_remove_wpautop(do_shortcode($content), $wpautop);
										} else {
											$output .= do_shortcode($content);
										}
									} else {
										$output .= $subtitle;
									}
								$output .= '</div>';
							}
							if (($button_type != "") && ($a_href != "")) {
								$output .= '<div class="ts-teaser-button-wrap ts-teaser-button-' . $button_type . '"">';
									$output .= '<a href="' . $a_href . '" target="' . trim($a_target) . '" ' . $a_rel . ' class="ts-readmore ' . $button_style . '" style="' . $button_font . ' ' . $button_padding . ' ' . $google_font_button . '"><span>' . $button_text . '</span></a>';
								$output .= '</div>';
							}
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
		
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
			
			// Custom Teaser Block Slider
			function TS_VCSC_Teaser_Block_Slider_Custom ($atts, $content = null){
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
		
				wp_enqueue_style('ts-extend-animations');
				wp_enqueue_style('ts-extend-owlcarousel2');
				wp_enqueue_script('ts-extend-owlcarousel2');
				wp_enqueue_style('ts-font-ecommerce');
				wp_enqueue_style('ts-extend-buttons');
				wp_enqueue_style('ts-extend-buttonsdual');
				wp_enqueue_style('ts-visual-composer-extend-front');
				wp_enqueue_script('ts-visual-composer-extend-front');
				
				extract( shortcode_atts( array(
					'number_teasers'				=> 1,
					'auto_height'                   => 'true',
					'page_rtl'						=> 'false',
					'auto_play'                     => 'false',
					'show_playpause'				=> 'true',
					'show_bar'                      => 'true',
					'bar_color'                     => '#dd3333',
					'show_speed'                    => 5000,
					'stop_hover'                    => 'true',
					'show_navigation'               => 'true',
					'show_dots'						=> 'true',
					'page_numbers'                  => 'false',
					'items_loop'					=> 'true',				
					'animation_in'					=> 'ts-viewport-css-flipInX',
					'animation_out'					=> 'ts-viewport-css-slideOutDown',
					'animation_mobile'				=> 'false',
					'margin_top'                    => 0,
					'margin_bottom'                 => 0,
					'el_id' 						=> '',
					'el_class'                  	=> '',
					'css'							=> '',
				), $atts ));
				
				$teaser_random                    	= mt_rand(999999, 9999999);
				
				// Check for Front End Editor
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$slider_class					= 'owl-carousel2-edit';
					$slider_message					= '<div class="ts-composer-frontedit-message">' . __( 'The slider is currently viewed in front-end edit mode; slider features are disabled for performance and compatibility reasons.', "ts_visual_composer_extend" ) . '</div>';
					$product_style					= 'width: ' . (100 / $number_teasers) . '%; height: 100%; float: left; margin: 0; padding: 0;';
					$frontend_edit					= 'true';
				} else {
					$slider_class					= 'ts-owlslider-parent owl-carousel2';
					$slider_message					= '';
					$product_style					= '';
					$frontend_edit					= 'false';
				}
				
				if (!empty($el_id)) {
					$teaser_slider_id			    = $el_id;
				} else {
					$teaser_slider_id			    = 'ts-vcsc-image-teaser-slider-' . $teaser_random;
				}
				
				$output = '';
				
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 	= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-teaser-block-slider ' . $slider_class . ' ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Teaser_Block_Slider_Custom', $atts);
				} else {
					$css_class	= 'ts-teaser-block-slider ' . $slider_class . ' ' . $el_class;
				}
				
				$output .= '<div id="' . $teaser_slider_id . '-container" class="ts-teaser-block-slider-container" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					// Front-Edit Message
					if ($frontend_edit == "true") {
						$output .= $slider_message;
					}
					// Add Progressbar
					if (($auto_play == "true") && ($show_bar == "true") && ($frontend_edit == "false")) {
						$output .= '<div id="ts-owlslider-progressbar-' . $teaser_random . '" class="ts-owlslider-progressbar-holder" style=""><div class="ts-owlslider-progressbar" style="background: ' . $bar_color . '; height: 100%; width: 0%;"></div></div>';
					}
					// Add Navigation Controls
					if ($frontend_edit == "false") {
						$output .= '<div id="ts-owlslider-controls-' . $teaser_random . '" class="ts-owlslider-controls" style="' . (((($auto_play == "true") && ($show_playpause == "true")) || ($show_navigation == "true")) ? "display: block;" : "display: none;") . '">';
							$output .= '<div id="ts-owlslider-controls-next-' . $teaser_random . '" style="' . (($show_navigation == "true") ? "display: block;" : "display: none;") . '" class="ts-owlslider-controls-next"><span class="ts-ecommerce-arrowright5"></span></div>';
							$output .= '<div id="ts-owlslider-controls-prev-' . $teaser_random . '" style="' . (($show_navigation == "true") ? "display: block;" : "display: none;") . '" class="ts-owlslider-controls-prev"><span class="ts-ecommerce-arrowleft5"></span></div>';
							if (($auto_play == "true") && ($show_playpause == "true")) {
								$output .= '<div id="ts-owlslider-controls-play-' . $teaser_random . '" class="ts-owlslider-controls-play active"><span class="ts-ecommerce-pause"></span></div>';
							}
						$output .= '</div>';
					}
					// Add Slider
					$output .= '<div id="' . $teaser_slider_id . '" class="' . $css_class . '" data-id="' . $teaser_random . '" data-items="' . $number_teasers . '" data-rtl="' . $page_rtl . '" data-loop="' . $items_loop . '" data-navigation="' . $show_navigation . '" data-dots="' . $show_dots . '" data-mobile="' . $animation_mobile . '" data-animationin="' . $animation_in . '" data-animationout="' . $animation_out . '" data-height="' . $auto_height . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '">';
						$output .= do_shortcode($content);
					$output .= '</div>';
				$output .= '</div>';
				
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
		
		
			// Add Teaser Block Elements
			function TS_VCSC_Add_Teaser_Block_Element_Standalone() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Standalone Teaser Block
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                      	=> __( "TS Single Teaser Block", "ts_visual_composer_extend" ),
					"base"                      	=> "TS_VCSC_Teaser_Block_Standalone",
					"icon" 	                    	=> "ts-composer-element-icon-teaser-block-single",
					"category"                  	=> __( "Composium", "ts_visual_composer_extend" ),
					"description"               	=> __("Place a teaser block element", "ts_visual_composer_extend"),
					"js_view"     					=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorLivePreview == "true" ? "TS_VCSC_TeaserBlockViewCustom" : ""),
					"admin_enqueue_js"            	=> "",
					"admin_enqueue_css"           	=> "",
					"params"                    	=> array(
						// Teaser Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1",
							"seperator"				=> "Teaser Image + Colors",
						),
						array(
							"type"                  => "switch_button",
							"heading"			    => __( "Teaser Block Image", "ts_visual_composer_extend" ),
							"param_name"		    => "teaser_graphic",
							"value"                 => "true",
							"admin_label"           => true,
							"description"		    => __( "Switch the toggle if you want to use an image to further highlight the teaser block.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  => "attach_image",
							"holder" 				=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? "img" : ""),
							"heading"               => __( "Image", "ts_visual_composer_extend" ),
							"param_name"            => "image",
							"class"					=> "ts_vcsc_holder_image",
							"value"                 => "",
							"admin_label"           => ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? false : true),
							"dependency"		    => array( 'element' => "teaser_graphic", 'value' => 'true' ),
							"description"           => __( "Select the image you want to use for the teaser.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Overlay Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "overlay",
							"value"             	=> "#0094FF",
							"description"       	=> __( "Define the hover overlay color for the teaser image.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"		    => array( 'element' => "teaser_graphic", 'value' => 'true' ),
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "color_background",
							"value"             	=> "#ffffff",
							"description"       	=> __( "Define the background color for the teaser block.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Separator Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "color_separator",
							"value"             	=> "#049cdb",
							"description"       	=> __( "Define the color for the teaser separator.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_2",
							"seperator"				=> "Teaser Link",
						),
						array(
							"type" 					=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ParameterLinkPicker['enabled'] == "false" ? "vc_link" : "advancedlinks"),
							"heading" 				=> __("Link", "ts_visual_composer_extend"),
							"param_name" 			=> "link",
							"description" 			=> __("Provide a link to another site/page for the Image Teaser.", "ts_visual_composer_extend")
						),
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_3",
							"seperator"				=> "Teaser Height",
						),
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Teaser Height", "ts_visual_composer_extend" ),
							"param_name"        	=> "height_type",
							"width"             	=> 300,
							"value"             	=> array(								
								__( 'Auto', "ts_visual_composer_extend" )						=> "auto",
								__( 'Minimum Text Height', "ts_visual_composer_extend" )      	=> "minmessage",
								__( 'Fixed Text Height', "ts_visual_composer_extend" )      	=> "fixmessage",
								__( 'Minimum Total Height', "ts_visual_composer_extend" )      	=> "minteaser",
							),
							"admin_label"           => true,
							"description"       	=> __( "Select if and what height limitation should be applied to the element.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Custom Height", "ts_visual_composer_extend" ),
							"param_name"            => "height_custom",
							"value"                 => "300",
							"min"                   => "100",
							"max"                   => "1280",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"       	=> __( "Define the desired minimum or fixed height, based on your selection above.", "ts_visual_composer_extend" ),
							"dependency"		    => array( 'element' => "height_type", 'value' => array('minmessage', 'fixmessage', 'minteaser') ),
						),						
						// Scrollbar Settings
                        array(
                            "type"					=> "seperator",
                            "param_name"			=> "seperator_4",
                            "seperator"				=> "Scrollbar Settings",							
							"dependency"			=> array( 'element' => "height_type", 'value' => 'fixmessage' ),
                        ),
						array(
							"type"                  => "switch_button",
							"heading"			    => __( "Scrollbar: Custom", "ts_visual_composer_extend" ),
							"param_name"		    => "scroll_nice",
							"value"                 => "true",
							"description"		    => __( "Switch the toggle if you want to apply a custom scrollbar to the content section.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "height_type", 'value' => 'fixmessage' ),
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Scrollbar: Main Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "scroll_color",
							"value"             	=> "#cacaca",
							"description"       	=> __( "Define the main color for the scrollbar.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "scroll_nice", 'value' => 'true' ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Scrollbar: Background Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "scroll_background",
							"value"             	=> "#ededed",
							"description"       	=> __( "Define the background color for the scrollbar.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "scroll_nice", 'value' => 'true' ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						// Teaser Border
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_5",
							"seperator"				=> "Teaser Border",
						),
						array(
							"type" 					=> "advanced_styling",
							"heading" 				=> __("Border Settings", "ts_visual_composer_extend"),
							"param_name" 			=> "styling_border",
							"style_type"			=> "border",
							"show_main"				=> "false",
							"show_preview"			=> "true",
							"show_width"			=> "true",
							"show_style"			=> "true",
							"show_radius" 			=> "true",					
							"show_color"			=> "true",
							"show_unit_width"		=> "true",
							"show_unit_radius"		=> "true",
							"override_all"			=> "true",
							"default_positions"		=> array(
								"All"						=> array("string" => __("All", "ts_visual_composer_extend"),	"width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#dddddd", "radius" => "0", "unitradius" => "px"),
								"Top"						=> array("string" => __("Top", "ts_visual_composer_extend"),	"width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#dddddd", "radius" => "0", "unitradius" => "px"),
								"Right"						=> array("string" => __("Right", "ts_visual_composer_extend"),	"width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#dddddd", "radius" => "0", "unitradius" => "px"),
								"Bottom"					=> array("string" => __("Bottom", "ts_visual_composer_extend"),	"width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#dddddd", "radius" => "0", "unitradius" => "px"),
								"Left"						=> array("string" => __("Left", "ts_visual_composer_extend"),	"width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#dddddd", "radius" => "0", "unitradius" => "px"),
							),
							"description"       	=> __( "Define the border settings for each side and corner of the element.", "ts_visual_composer_extend" ),
						),
						// Teaser Header
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_6",
							"seperator"				=> "Teaser Title",
							"group"					=> "Title"
						),
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Header Position", "ts_visual_composer_extend" ),
							"param_name"        	=> "info_position",
							"width"             	=> 300,
							"value"             	=> array(								
								__( 'Bottom', "ts_visual_composer_extend" )		=> "bottom",
								__( 'Top', "ts_visual_composer_extend" )      	=> "top",
							),
							"admin_label"           => true,
							"dependency"		    => array( 'element' => "teaser_graphic", 'value' => 'true' ),
							"description"       	=> __( "Select where the header (title + description) should be shown in relation to the teaser image.", "ts_visual_composer_extend" ),
							"group"					=> "Header"
						),
						array(
							"type"              	=> "textfield",
							"heading"           	=> __( "Title", "ts_visual_composer_extend" ),
							"param_name"        	=> "title",
							"class"					=> "ts_vcsc_holder_text_main",
							"value"             	=> "",
							"admin_label"           => true,
							"description"       	=> __( "Enter a title for the image teaser.", "ts_visual_composer_extend" ),
							"group"					=> "Header"
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
							"standard"				=> "h2",
							"std"					=> "h2",
							"default"				=> "h2",
							"group"					=> "Header"
						),	
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Title Font Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "color_title",
							"value"             	=> "#a2a2a2",
							"description"       	=> __( "Define the font color for the teaser title.", "ts_visual_composer_extend" ),
							"group"					=> "Header"
						),
						array(
							"type"					=> "fontsmanager",
							"heading"				=> __( "Font Family", "ts_visual_composer_extend" ),
							"param_name"			=> "font_title_family",
							"value"					=> "",
							"default"				=> "true",
							"connector"				=> "font_title_type",
							"description"			=> __( "Select the font to be used for the title text.", "ts_visual_composer_extend" ),
							"group"					=> "Header"
						),
						array(
							"type"					=> "hidden_input",
							"param_name"			=> "font_title_type",
							"value"					=> "",
							"group"					=> "Header"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Title Font Size", "ts_visual_composer_extend" ),
							"param_name"            => "font_title_size",
							"value"                 => "18",
							"min"                   => "10",
							"max"                   => "100",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"       	=> __( "Define the font size for the teaser header.", "ts_visual_composer_extend" ),
							"group"					=> "Header"
						),
						// Teaser Message
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_7",
							"seperator"				=> "Teaser Message",
							"group"					=> "Message"
						),
						array(
							"type"					=> "switch_button",
							"heading"           	=> __( "Use Full HTML Editor", "ts_visual_composer_extend" ),
							"param_name"        	=> "content_html",
							"value"             	=> "false",
							"description"       	=> __( "Switch the toggle if you want to use the full tinyMCE editor to provide the element content.", "ts_visual_composer_extend" ),
							"group"					=> "Message"
						),
						array(
							"type"              	=> "textarea",
							"heading"           	=> __( "Description", "ts_visual_composer_extend" ),
							"param_name"        	=> "subtitle",
							"class"					=> "ts_vcsc_holder_text_sub",
							"value"             	=> "Teaser Subtitle",
							"admin_label"           => true,
							"description"       	=> __( "Enter a short description for the image teaser.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "content_html", 'value' => 'false' ),
							"group"					=> "Message"
						),
						array(
							"type"					=> "textarea_html",
							"heading"				=> __( "Description", "ts_visual_composer_extend" ),
							"param_name"			=> "content",
							"value"					=> "",
							"description"       	=> __( "Enter a short description for the image teaser.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "content_html", 'value' => 'true' ),
							"group"					=> "Message"
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Message Font Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "color_subtitle",
							"value"             	=> "#aaaaaa",
							"description"       	=> __( "Define the font color for the teaser message.", "ts_visual_composer_extend" ),
							"group"					=> "Message"
						),
						array(
							"type"					=> "fontsmanager",
							"heading"				=> __( "Font Family", "ts_visual_composer_extend" ),
							"param_name"			=> "font_content_family",
							"value"					=> "",
							"default"				=> "true",
							"connector"				=> "font_content_type",
							"description"			=> __( "Select the font to be used for the description text.", "ts_visual_composer_extend" ),
							"group"					=> "Message"
						),
						array(
							"type"					=> "hidden_input",
							"param_name"			=> "font_content_type",
							"value"					=> "",
							"group"					=> "Message"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Message Font Size", "ts_visual_composer_extend" ),
							"param_name"            => "font_content_size",
							"value"                 => "14",
							"min"                   => "10",
							"max"                   => "100",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"       	=> __( "Define the font size for the teaser message.", "ts_visual_composer_extend" ),
							"group"					=> "Message"
						),
						// Icon Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_8",
							"seperator"				=> "Icon Settings",
							"group" 				=> "Icon Settings",
						),
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Icon Position", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_position",
							"width"             	=> 300,
							"value"             	=> array(
								__( 'No Icon', "ts_visual_composer_extend" )      	=> "",
								__( 'Left Icon', "ts_visual_composer_extend" )		=> "left",
								__( 'Right Icon', "ts_visual_composer_extend" )		=> "right",
								__( 'Top Icon', "ts_visual_composer_extend" )			=> "top",
								__( 'Bottom Icon', "ts_visual_composer_extend" )		=> "bottom",
							),
							"description"       	=> __( "Select if and where an icon should be shown in the teaser title.", "ts_visual_composer_extend" ),
							"group" 				=> "Icon Settings",
						),
						array(
							"type" 					=> "icons_panel",
							'heading' 				=> __( 'Title Icon', 'ts_visual_composer_extend' ),
							'param_name' 			=> 'icon',
							'value'					=> '',
							"settings" 				=> array(
								"emptyIcon" 				=> false,
								'emptyIconValue'			=> 'transparent',
								"type" 						=> 'extensions',
							),
							"admin_label"       	=> true,
							"description"       	=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorVisualSelector == "true" ? __( "Select the icon you want to display in the teaser title.", "ts_visual_composer_extend" ) : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorString),
							"dependency"			=> array( 'element' => "icon_position", 'value' => array('left', 'right', 'top', 'bottom') ),
							"group" 				=> "Icon Settings",
						),						
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Icon Size", "ts_visual_composer_extend" ),
							"param_name"            => "icon_size",
							"value"                 => "18",
							"min"                   => "4",
							"max"                   => "256",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"       	=> __( "Define the size for the icon in the image teaser.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "icon_position", 'value' => array('left', 'right', 'top', 'bottom') ),
							"group" 				=> "Icon Settings",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Icon Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_color",
							"value"             	=> "#aaaaaa",
							"description"       	=> __( "Define the color of the icon for the image teaser.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "icon_position", 'value' => array('left', 'right', 'top', 'bottom') ),
							"group" 				=> "Icon Settings",
						),
						// Button Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_9",
							"seperator"				=> "Button Settings",
							"group" 				=> "Link Button",
						),
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Button Type", "ts_visual_composer_extend" ),
							"param_name"        	=> "button_type",
							"width"             	=> 300,
							"value"             	=> array(
								__( 'None', "ts_visual_composer_extend" )      		=> "",
								__( '3D Square', "ts_visual_composer_extend" )		=> "square",
								__( '3D Rounded', "ts_visual_composer_extend" )		=> "rounded",
								__( '3D Pill', "ts_visual_composer_extend" )		=> "pill",
								__( '3D Circle', "ts_visual_composer_extend" )		=> "circle",
								__( 'Flat Button', "ts_visual_composer_extend" )	=> "flat",
							),
							"admin_label"           => true,
							"description"       	=> __( "Select if and what type of link button should be shown.", "ts_visual_composer_extend" ),
							"group" 				=> "Link Button",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Button Style", "ts_visual_composer_extend" ),
							"param_name"            => "button_square",
							"width"                 => 300,
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Button_Square,
							"description"           => __( "Select the actual button style for the 'Read More' Link.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => 'square' ),
							"group" 				=> "Link Button",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Button Style", "ts_visual_composer_extend" ),
							"param_name"            => "button_rounded",
							"width"                 => 300,
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Button_Rounded,
							"description"           => __( "Select the actual button style for the 'Read More' Link.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => 'rounded' ),
							"group" 				=> "Link Button",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Button Style", "ts_visual_composer_extend" ),
							"param_name"            => "button_pill",
							"width"                 => 300,
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Button_Pill,
							"description"           => __( "Select the actual button style for the 'Read More' Link.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => 'pill' ),
							"group" 				=> "Link Button",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Button Style", "ts_visual_composer_extend" ),
							"param_name"            => "button_circle",
							"width"                 => 300,
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Button_Circle,
							"description"           => __( "Select the actual button style for the 'Read More' Link.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => 'circle' ),
							"group" 				=> "Link Button",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Button Style", "ts_visual_composer_extend" ),
							"param_name"            => "button_flat",
							"width"                 => 150,
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Flat_Button_Default_Colors,
							"description"           => __( "Select the color scheme for the link button.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => 'flat' ),
							"group" 				=> "Link Button",
						),						
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Button Hover Style", "ts_visual_composer_extend" ),
							"param_name"            => "button_hover",
							"width"                 => 150,
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Flat_Button_Hover_Colors,
							"description"           => __( "Select the hover color scheme for the link button.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => 'flat' ),
							"group" 				=> "Link Button",
						),
						array(
							"type"              	=> "textfield",
							"heading"           	=> __( "Button Text", "ts_visual_composer_extend" ),
							"param_name"        	=> "button_text",
							"value"             	=> "Read More",
							"description"       	=> __( "Enter a text for the 'Read More' button.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => array('square', 'rounded', 'pill', 'circle', 'flat') ),
							"group" 				=> "Link Button",
						),						
						array(
							"type"					=> "fontsmanager",
							"heading"				=> __( "Button Text Font", "ts_visual_composer_extend" ),
							"param_name"			=> "font_button_family",
							"value"					=> "",
							"default"				=> "true",
							"connector"				=> "font_button_type",
							"description"			=> __( "Select the font to be used for the link button text.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => array('square', 'rounded', 'pill', 'circle', 'flat') ),
							"group" 				=> "Link Button",
						),
						array(
							"type"					=> "hidden_input",
							"param_name"			=> "font_button_type",
							"value"					=> "",
							"dependency"			=> array( 'element' => "button_type", 'value' => array('square', 'rounded', 'pill', 'circle', 'flat') ),
							"group" 				=> "Link Button",
						),						
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Button Font Size", "ts_visual_composer_extend" ),
							"param_name"            => "button_font",
							"value"                 => "14",
							"min"                   => "10",
							"max"                   => "100",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"       	=> __( "Define the font size for the icon / text in the button.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => array('circle', 'flat') ),
							"group" 				=> "Link Button",
						),
						// Other Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_10",
							"seperator"				=> "Other Settings",
							"group" 				=> "Other Settings",
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Margin: Top", "ts_visual_composer_extend" ),
							"param_name"        	=> "margin_top",
							"value"             	=> "0",
							"min"               	=> "-50",
							"max"               	=> "200",
							"step"              	=> "1",
							"unit"              	=> 'px',
							"description"       	=> __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
							"group" 				=> "Other Settings",
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Margin: Bottom", "ts_visual_composer_extend" ),
							"param_name"        	=> "margin_bottom",
							"value"             	=> "0",
							"min"               	=> "-50",
							"max"               	=> "200",
							"step"              	=> "1",
							"unit"              	=> 'px',
							"description"       	=> __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
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
			}
			function TS_VCSC_Add_Teaser_Block_Element_Single() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Single Teaser Block (for Custom Slider)
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                      	=> __( "TS Teaser Block Slide", "ts_visual_composer_extend" ),
					"base"                      	=> "TS_VCSC_Teaser_Block_Single",
					"icon" 	                    	=> "ts-composer-element-icon-teaser-block-single",
					"content_element"                => true,
					"as_child"                       => array('only' => 'TS_VCSC_Teaser_Block_Slider_Custom'),
					"category"                  	=> __( "Composium", "ts_visual_composer_extend" ),
					"description"               	=> __("Place a teaser block element", "ts_visual_composer_extend"),
					"admin_enqueue_js"            	=> "",
					"admin_enqueue_css"           	=> "",
					"params"                    	=> array(
						// Teaser Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1",
							"seperator"				=> "Teaser Image + Colors",
						),
						array(
							"type"                  => "switch_button",
							"heading"			    => __( "Teaser Block Image", "ts_visual_composer_extend" ),
							"param_name"		    => "teaser_graphic",
							"value"                 => "true",
							"admin_label"           => true,
							"description"		    => __( "Switch the toggle if you want to use an image to further highlight the teaser block.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  => "attach_image",
							"holder" 				=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? "img" : ""),
							"heading"               => __( "Image", "ts_visual_composer_extend" ),
							"param_name"            => "image",
							"class"					=> "ts_vcsc_holder_image",
							"value"                 => "",
							"admin_label"           => ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? false : true),
							"dependency"		    => array( 'element' => "teaser_graphic", 'value' => 'true' ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"description"           => __( "Select the image you want to use for the teaser.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Overlay Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "overlay",
							"value"             	=> "#0094FF",
							"description"       	=> __( "Define the hover overlay color for the teaser image.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"		    => array( 'element' => "teaser_graphic", 'value' => 'true' ),
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "color_background",
							"value"             	=> "#ffffff",
							"description"       	=> __( "Define the background color for the teaser block.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Separator Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "color_separator",
							"value"             	=> "#049cdb",
							"description"       	=> __( "Define the color for the teaser separator.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_2",
							"seperator"				=> "Teaser Link",
						),
						array(
							"type" 					=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ParameterLinkPicker['enabled'] == "false" ? "vc_link" : "advancedlinks"),
							"heading" 				=> __("Link", "ts_visual_composer_extend"),
							"param_name" 			=> "link",
							"description" 			=> __("Provide a link to another site/page for the Image Teaser.", "ts_visual_composer_extend")
						),
						// Height Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_3",
							"seperator"				=> "Teaser Height",
						),
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Teaser Height", "ts_visual_composer_extend" ),
							"param_name"        	=> "height_type",
							"width"             	=> 300,
							"value"             	=> array(								
								__( 'Auto', "ts_visual_composer_extend" )						=> "auto",
								__( 'Minimum Text Height', "ts_visual_composer_extend" )      	=> "minmessage",
								__( 'Fixed Text Height', "ts_visual_composer_extend" )      	=> "fixmessage",
								__( 'Minimum Total Height', "ts_visual_composer_extend" )      	=> "minteaser",
							),
							"admin_label"           => true,
							"description"       	=> __( "Select if and what height limitation should be applied to the element.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Custom Height", "ts_visual_composer_extend" ),
							"param_name"            => "height_custom",
							"value"                 => "300",
							"min"                   => "100",
							"max"                   => "1280",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"       	=> __( "Define the desired minimum or fixed height, based on your selection above.", "ts_visual_composer_extend" ),
							"dependency"		    => array( 'element' => "height_type", 'value' => array('minmessage', 'fixmessage', 'minteaser') ),
						),
						// Scrollbar Settings
                        array(
                            "type"					=> "seperator",
                            "param_name"			=> "seperator_4",
                            "seperator"				=> "Scrollbar Settings",							
							"dependency"			=> array( 'element' => "height_type", 'value' => 'fixmessage' ),
                        ),
						array(
							"type"                  => "switch_button",
							"heading"			    => __( "Scrollbar: Custom", "ts_visual_composer_extend" ),
							"param_name"		    => "scroll_nice",
							"value"                 => "true",
							"description"		    => __( "Switch the toggle if you want to apply a custom scrollbar to the content section.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "height_type", 'value' => 'fixmessage' ),
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Scrollbar: Main Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "scroll_color",
							"value"             	=> "#cacaca",
							"description"       	=> __( "Define the main color for the scrollbar.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "scroll_nice", 'value' => 'true' ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Scrollbar: Background Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "scroll_background",
							"value"             	=> "#ededed",
							"description"       	=> __( "Define the background color for the scrollbar.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "scroll_nice", 'value' => 'true' ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						// Teaser Border
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_5",
							"seperator"				=> "Teaser Border",
						),
						array(
							"type" 					=> "advanced_styling",
							"heading" 				=> __("Border Settings", "ts_visual_composer_extend"),
							"param_name" 			=> "styling_border",
							"style_type"			=> "border",
							"show_main"				=> "false",
							"show_preview"			=> "true",
							"show_width"			=> "true",
							"show_style"			=> "true",
							"show_radius" 			=> "true",					
							"show_color"			=> "true",
							"show_unit_width"		=> "true",
							"show_unit_radius"		=> "true",
							"override_all"			=> "true",
							"default_positions"		=> array(
								"All"						=> array("string" => __("All", "ts_visual_composer_extend"),	"width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#dddddd", "radius" => "0", "unitradius" => "px"),
								"Top"						=> array("string" => __("Top", "ts_visual_composer_extend"),	"width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#dddddd", "radius" => "0", "unitradius" => "px"),
								"Right"						=> array("string" => __("Right", "ts_visual_composer_extend"),	"width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#dddddd", "radius" => "0", "unitradius" => "px"),
								"Bottom"					=> array("string" => __("Bottom", "ts_visual_composer_extend"),	"width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#dddddd", "radius" => "0", "unitradius" => "px"),
								"Left"						=> array("string" => __("Left", "ts_visual_composer_extend"),	"width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#dddddd", "radius" => "0", "unitradius" => "px"),
							),
							"description"       	=> __( "Define the border settings for each side and corner of the element.", "ts_visual_composer_extend" ),
						),
						// Teaser Header
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_6",
							"seperator"				=> "Teaser Title",
							"group"					=> "Header"
						),
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Header Position", "ts_visual_composer_extend" ),
							"param_name"        	=> "info_position",
							"width"             	=> 300,
							"value"             	=> array(								
								__( 'Bottom', "ts_visual_composer_extend" )		=> "bottom",
								__( 'Top', "ts_visual_composer_extend" )      	=> "top",
							),
							"admin_label"           => true,
							"dependency"		    => array( 'element' => "teaser_graphic", 'value' => 'true' ),
							"description"       	=> __( "Select where the header (title + description) should be shown in relation to the teaser image.", "ts_visual_composer_extend" ),
							"group"					=> "Header"
						),
						array(
							"type"              	=> "textfield",
							"heading"           	=> __( "Title", "ts_visual_composer_extend" ),
							"param_name"        	=> "title",
							"class"					=> "ts_vcsc_holder_text_main",
							"value"             	=> "Teaser Title",
							"admin_label"           => true,
							"description"       	=> __( "Enter a title for the image teaser.", "ts_visual_composer_extend" ),
							"group"					=> "Header"
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
							"standard"				=> "h2",
							"std"					=> "h2",
							"default"				=> "h2",
							"group"					=> "Header"
						),	
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Title Font Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "color_title",
							"value"             	=> "#a2a2a2",
							"description"       	=> __( "Define the font color for the teaser title.", "ts_visual_composer_extend" ),
							"group"					=> "Header"
						),
						array(
							"type"					=> "fontsmanager",
							"heading"				=> __( "Font Family", "ts_visual_composer_extend" ),
							"param_name"			=> "font_title_family",
							"value"					=> "",
							"default"				=> "true",
							"connector"				=> "font_title_type",
							"description"			=> __( "Select the font to be used for the title text.", "ts_visual_composer_extend" ),
							"group"					=> "Header"
						),
						array(
							"type"					=> "hidden_input",
							"param_name"			=> "font_title_type",
							"value"					=> "",
							"group"					=> "Header"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Title Font Size", "ts_visual_composer_extend" ),
							"param_name"            => "font_title_size",
							"value"                 => "18",
							"min"                   => "10",
							"max"                   => "100",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"       	=> __( "Define the font size for the teaser header.", "ts_visual_composer_extend" ),
							"group"					=> "Header"
						),
						// Teaser Message
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_7",
							"seperator"				=> "Teaser Message",
							"group"					=> "Message"
						),
						array(
							"type"					=> "switch_button",
							"heading"           	=> __( "Use Full HTML Editor", "ts_visual_composer_extend" ),
							"param_name"        	=> "content_html",
							"value"             	=> "false",
							"description"       	=> __( "Switch the toggle if you want to use the full tinyMCE editor to provide the element content.", "ts_visual_composer_extend" ),
							"group"					=> "Message"
						),
						array(
							"type"              	=> "textarea",
							"heading"           	=> __( "Description", "ts_visual_composer_extend" ),
							"param_name"        	=> "subtitle",
							"class"					=> "ts_vcsc_holder_text_sub",
							"value"             	=> "Teaser Subtitle",
							"admin_label"           => true,
							"description"       	=> __( "Enter a short description for the image teaser.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "content_html", 'value' => 'false' ),
							"group"					=> "Message"
						),
						array(
							"type"					=> "textarea_html",
							"heading"				=> __( "Description", "ts_visual_composer_extend" ),
							"param_name"			=> "content",
							"value"					=> "",
							"description"       	=> __( "Enter a short description for the image teaser.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "content_html", 'value' => 'true' ),
							"group"					=> "Message"
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Message Font Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "color_subtitle",
							"value"             	=> "#aaaaaa",
							"description"       	=> __( "Define the font color for the teaser message.", "ts_visual_composer_extend" ),
							"group"					=> "Message"
						),
						array(
							"type"					=> "fontsmanager",
							"heading"				=> __( "Font Family", "ts_visual_composer_extend" ),
							"param_name"			=> "font_content_family",
							"value"					=> "",
							"default"				=> "true",
							"connector"				=> "font_content_type",
							"description"			=> __( "Select the font to be used for the description text.", "ts_visual_composer_extend" ),
							"group"					=> "Message"
						),
						array(
							"type"					=> "hidden_input",
							"param_name"			=> "font_content_type",
							"value"					=> "",
							"group"					=> "Message"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Message Font Size", "ts_visual_composer_extend" ),
							"param_name"            => "font_content_size",
							"value"                 => "14",
							"min"                   => "10",
							"max"                   => "100",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"       	=> __( "Define the font size for the teaser message.", "ts_visual_composer_extend" ),
							"group"					=> "Message"
						),
						// Icon Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_8",
							"seperator"				=> "Icon Settings",
							"group" 				=> "Icon Settings",
						),
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Icon Position", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_position",
							"width"             	=> 300,
							"value"             	=> array(
								__( 'No Icon', "ts_visual_composer_extend" )      	=> "",
								__( 'Left Icon', "ts_visual_composer_extend" )		=> "left",
								__( 'Right Icon', "ts_visual_composer_extend" )		=> "right",
								__( 'Top Icon', "ts_visual_composer_extend" )			=> "top",
								__( 'Bottom Icon', "ts_visual_composer_extend" )		=> "bottom",
							),
							"description"       	=> __( "Select if and where an icon should be shown in the teaser title.", "ts_visual_composer_extend" ),
							"group" 				=> "Icon Settings",
						),
						array(
							"type" 					=> "icons_panel",
							'heading' 				=> __( 'Title Icon', 'ts_visual_composer_extend' ),
							'param_name' 			=> 'icon',
							'value'					=> '',
							"settings" 				=> array(
								"emptyIcon" 				=> false,
								'emptyIconValue'			=> 'transparent',
								"type" 						=> 'extensions',
							),
							"admin_label"       	=> true,
							"description"       	=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorVisualSelector == "true" ? __( "Select the icon you want to display in the teaser title.", "ts_visual_composer_extend" ) : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorString),
							"dependency"			=> array( 'element' => "icon_position", 'value' => array('left', 'right', 'top', 'bottom') ),
							"group" 				=> "Icon Settings",
						),						
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Icon Size", "ts_visual_composer_extend" ),
							"param_name"            => "icon_size",
							"value"                 => "18",
							"min"                   => "4",
							"max"                   => "256",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"       	=> __( "Define the size for the icon in the image teaser.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "icon_position", 'value' => array('left', 'right', 'top', 'bottom') ),
							"group" 				=> "Icon Settings",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Icon Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_color",
							"value"             	=> "#aaaaaa",
							"description"       	=> __( "Define the color of the icon for the image teaser.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "icon_position", 'value' => array('left', 'right', 'top', 'bottom') ),
							"group" 				=> "Icon Settings",
						),
						// Button Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_9",
							"seperator"				=> "Button Settings",
							"group" 				=> "Link Button",
						),
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Button Type", "ts_visual_composer_extend" ),
							"param_name"        	=> "button_type",
							"width"             	=> 300,
							"value"             	=> array(
								__( 'None', "ts_visual_composer_extend" )      		=> "",
								__( '3D Square', "ts_visual_composer_extend" )		=> "square",
								__( '3D Rounded', "ts_visual_composer_extend" )		=> "rounded",
								__( '3D Pill', "ts_visual_composer_extend" )		=> "pill",
								__( '3D Circle', "ts_visual_composer_extend" )		=> "circle",
								__( 'Flat Button', "ts_visual_composer_extend" )	=> "flat",
							),
							"admin_label"           => true,
							"description"       	=> __( "Select if and what type of link button should be shown.", "ts_visual_composer_extend" ),
							"group" 				=> "Link Button",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Button Style", "ts_visual_composer_extend" ),
							"param_name"            => "button_square",
							"width"                 => 300,
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Button_Square,
							"description"           => __( "Select the actual button style for the 'Read More' Link.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => 'square' ),
							"group" 				=> "Link Button",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Button Style", "ts_visual_composer_extend" ),
							"param_name"            => "button_rounded",
							"width"                 => 300,
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Button_Rounded,
							"description"           => __( "Select the actual button style for the 'Read More' Link.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => 'rounded' ),
							"group" 				=> "Link Button",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Button Style", "ts_visual_composer_extend" ),
							"param_name"            => "button_pill",
							"width"                 => 300,
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Button_Pill,
							"description"           => __( "Select the actual button style for the 'Read More' Link.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => 'pill' ),
							"group" 				=> "Link Button",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Button Style", "ts_visual_composer_extend" ),
							"param_name"            => "button_circle",
							"width"                 => 300,
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Button_Circle,
							"description"           => __( "Select the actual button style for the 'Read More' Link.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => 'circle' ),
							"group" 				=> "Link Button",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Button Style", "ts_visual_composer_extend" ),
							"param_name"            => "button_flat",
							"width"                 => 150,
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Flat_Button_Default_Colors,
							"description"           => __( "Select the color scheme for the link button.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => 'flat' ),
							"group" 				=> "Link Button",
						),						
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Button Hover Style", "ts_visual_composer_extend" ),
							"param_name"            => "button_hover",
							"width"                 => 150,
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Flat_Button_Hover_Colors,
							"description"           => __( "Select the hover color scheme for the link button.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => 'flat' ),
							"group" 				=> "Link Button",
						),
						array(
							"type"              	=> "textfield",
							"heading"           	=> __( "Button Text", "ts_visual_composer_extend" ),
							"param_name"        	=> "button_text",
							"value"             	=> "Read More",
							"description"       	=> __( "Enter a text for the 'Read More' button.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => array('square', 'rounded', 'pill', 'circle', 'flat') ),
							"group" 				=> "Link Button",
						),						
						array(
							"type"					=> "fontsmanager",
							"heading"				=> __( "Button Text Font", "ts_visual_composer_extend" ),
							"param_name"			=> "font_button_family",
							"value"					=> "",
							"default"				=> "true",
							"connector"				=> "font_button_type",
							"description"			=> __( "Select the font to be used for the link button text.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => array('square', 'rounded', 'pill', 'circle', 'flat') ),
							"group" 				=> "Link Button",
						),
						array(
							"type"					=> "hidden_input",
							"param_name"			=> "font_button_type",
							"value"					=> "",
							"dependency"			=> array( 'element' => "button_type", 'value' => array('square', 'rounded', 'pill', 'circle', 'flat') ),
							"group" 				=> "Link Button",
						),						
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Button Font Size", "ts_visual_composer_extend" ),
							"param_name"            => "button_font",
							"value"                 => "14",
							"min"                   => "10",
							"max"                   => "100",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"       	=> __( "Define the font size for the icon / text in the button.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "button_type", 'value' => array('circle', 'flat') ),
							"group" 				=> "Link Button",
						),
					)
				);
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
					return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
				} else {			
					vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
				};
			}
			function TS_VCSC_Add_Teaser_Block_Element_SliderCustom() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Teaser Block Slider 1 (Custom Build)
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                              => __("TS Teaser Block Slider", "ts_visual_composer_extend"),
					"base"                              => "TS_VCSC_Teaser_Block_Slider_Custom",
					"icon"                              => "ts-composer-element-icon-teaser-block-slider",
					"category"                          => __("Composium", "ts_visual_composer_extend"),
					"as_parent"                         => array('only' => 'TS_VCSC_Teaser_Block_Single'),
					"description"                       => __("Build a custom Teaser Block Slider", "ts_visual_composer_extend"),
					"controls" 							=> "full",
					"content_element"                   => true,
					"is_container" 						=> true,
					"container_not_allowed" 			=> false,
					"show_settings_on_create"           => true,
					"admin_enqueue_js"            		=> "",
					"admin_enqueue_css"           		=> "",
					"js_view"                           => "VcColumnView",
					"params"                            => array(
						// Slider Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_1",
							"seperator"					=> "Slider Settings",
						),
						array(
							"type" 						=> "css3animations",
							"heading" 					=> __("In-Animation Type", "ts_visual_composer_extend"),
							"param_name" 				=> "animation_in",
							"prefix"					=> "ts-viewport-css-",
							"connector"					=> "css3animations_in",
							"default"					=> "flipInX",
							"value" 					=> "",
							"admin_label"				=> false,
							"description" 				=> __("Select the CSS3 in-animation you want to apply to the slider.", "ts_visual_composer_extend"),
						),
						array(
							"type"                      => "hidden_input",
							"heading"                   => __( "In-Animation Type", "ts_visual_composer_extend" ),
							"param_name"                => "css3animations_in",
							"value"                     => "",
							"admin_label"		        => true,
						),						
						array(
							"type" 						=> "css3animations",
							"heading" 					=> __("Out-Animation Type", "ts_visual_composer_extend"),
							"param_name" 				=> "animation_out",
							"prefix"					=> "ts-viewport-css-",
							"connector"					=> "css3animations_out",
							"default"					=> "slideOutDown",
							"value" 					=> "",
							"admin_label"				=> false,
							"description" 				=> __("Select the CSS3 out-animation you want to apply to the slider.", "ts_visual_composer_extend"),
						),
						array(
							"type"                      => "hidden_input",
							"heading"                   => __( "Out-Animation Type", "ts_visual_composer_extend" ),
							"param_name"                => "css3animations_out",
							"value"                     => "",
							"admin_label"		        => true,
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Animate on Mobile", "ts_visual_composer_extend" ),
							"param_name"                => "animation_mobile",
							"value"                     => "false",
							"description"               => __( "Switch the toggle if you want to show the CSS3 animations on mobile devices.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Auto-Height", "ts_visual_composer_extend" ),
							"param_name"                => "auto_height",
							"value"                     => "true",
							"admin_label"		        => true,
							"description"               => __( "Switch the toggle if you want the slider to auto-adjust its height.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "RTL Page", "ts_visual_composer_extend" ),
							"param_name"                => "page_rtl",
							"value"                     => "false",
							"description"               => __( "Switch the toggle if the slider is used on a page with RTL (Right-To-Left) alignment.", "ts_visual_composer_extend" )
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Max Number of Teasers", "ts_visual_composer_extend" ),
							"param_name"                => "number_teasers",
							"value"                     => "1",
							"min"                       => "1",
							"max"                       => "10",
							"step"                      => "1",
							"unit"                      => '',
							"description"               => __( "Define the maximum number of Teaser Blocks per slide.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Auto-Play", "ts_visual_composer_extend" ),
							"param_name"                => "auto_play",
							"value"                     => "false",
							"admin_label"		        => true,
							"description"               => __( "Switch the toggle if you want the auto-play the slider on page load.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Play / Pause", "ts_visual_composer_extend" ),
							"param_name"                => "show_playpause",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show a play / pause button to control the autoplay.", "ts_visual_composer_extend" ),
							"dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Progressbar", "ts_visual_composer_extend" ),
							"param_name"                => "show_bar",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show a progressbar during auto-play.", "ts_visual_composer_extend" ),
							"dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
						),
						array(
							"type"                      => "colorpicker",
							"heading"                   => __( "Progressbar Color", "ts_visual_composer_extend" ),
							"param_name"                => "bar_color",
							"value"                     => "#dd3333",
							"description"               => __( "Define the color of the animated progressbar.", "ts_visual_composer_extend" ),
							"dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Auto-Play Speed", "ts_visual_composer_extend" ),
							"param_name"                => "show_speed",
							"value"                     => "5000",
							"min"                       => "1000",
							"max"                       => "20000",
							"step"                      => "100",
							"unit"                      => 'ms',
							"description"               => __( "Define the speed used to auto-play the slider.", "ts_visual_composer_extend" ),
							"dependency" 				=> array("element" 	=> "auto_play","value" 	=> "true"),
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Stop on Hover", "ts_visual_composer_extend" ),
							"param_name"                => "stop_hover",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want the stop the auto-play while hovering over the slider.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "auto_play", 'value' => 'true' )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Top Navigation", "ts_visual_composer_extend" ),
							"param_name"                => "show_navigation",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show a left/right navigation buttons for the slider.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Dot Navigation", "ts_visual_composer_extend" ),
							"param_name"                => "show_dots",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show dot navigation buttons below the slider.", "ts_visual_composer_extend" )
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
	if ((class_exists('WPBakeryShortCodesContainer')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Teaser_Block_Slider_Custom'))) {
		class WPBakeryShortCode_TS_VCSC_Teaser_Block_Slider_Custom extends WPBakeryShortCodesContainer {};
	}
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Teaser_Block_Standalone'))) {
		class WPBakeryShortCode_TS_VCSC_Teaser_Block_Standalone extends WPBakeryShortCode {};
	}
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Teaser_Block_Single'))) {
		class WPBakeryShortCode_TS_VCSC_Teaser_Block_Single extends WPBakeryShortCode {};
	}
	// Initialize "TS Teaser Blocks" Class
	if (class_exists('TS_Teaser_Blocks')) {
		$TS_Teaser_Blocks = new TS_Teaser_Blocks;
	}
?>