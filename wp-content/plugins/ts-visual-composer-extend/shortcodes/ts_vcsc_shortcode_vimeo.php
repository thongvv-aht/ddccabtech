<?php
	add_shortcode('TS-VCSC-Vimeo', 'TS_VCSC_Vimeo_Function');
	function TS_VCSC_Vimeo_Function ($atts, $content = null) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		extract( shortcode_atts( array(
			'content_image_responsive'		=> 'true',
			'content_image_height'			=> 'height: 100%;',
			'content_image_width_r'			=> 100,
			'content_image_width_f'			=> 300,
			'content_image_size'			=> 'large',

			'lightbox_group_name'			=> 'krautgroup',
			'lightbox_size'					=> 'full',
			'lightbox_effect'				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxDefaultAnimation,
			'lightbox_speed'				=> 5000,
			'lightbox_social'				=> 'true',
			'lightbox_play'					=> 'false',
			'lightbox_loop'					=> 'false',
			'lightbox_mute'					=> 'false',
			'lightbox_backlight_auto'		=> 'true',
			'lightbox_backlight_color'		=> '#ffffff',
			
			'lightbox_width'				=> 'auto',
			'lightbox_width_percent'		=> 100,
			'lightbox_width_pixel'			=> 1024,
			'lightbox_height'				=> 'auto',
			'lightbox_height_percent'		=> 100,
			'lightbox_height_pixel'			=> 400,
			
			'content_lightbox'				=> 'false',
			'content_ratio'					=> 'ts-ratio-sixteen-to-nine',
			'content_vimeo'					=> '',
			'content_vimeo_trigger'			=> 'preview',
			'content_vimeo_title'			=> '',
			'content_vimeo_subtitle'		=> '',
			'content_vimeo_image'			=> '',
			'content_vimeo_image_simple'	=> 'false',
			'content_vimeo_icon'			=> '',
			'content_vimeo_iconsize'		=> 30,
			'content_vimeo_iconcolor' 		=> '#cccccc',
			'content_vimeo_button'			=> '',
			'content_vimeo_buttonstyle'		=> 'ts-dual-buttons-color-sun-flower',
			'content_vimeo_buttonhover'		=> 'ts-dual-buttons-preview-default ts-dual-buttons-hover-default',
			'content_vimeo_buttontext'		=> 'View Video',
			'content_vimeo_buttonsize'		=> 16,
			'content_vimeo_text'			=> '',
			'content_raw'					=> '',
			
			'overlay_visibility'			=> 'hover', // hover, only_deco, only_title, always
			'overlay_animation'				=> 'zoom', // zoom, rotate, none
			'overlay_background'			=> 'rgba(24, 24, 24, 0.3)',
			'overlay_decoration'			=> 'default', // default, icon, image, external, none
			'overlay_image'					=> '',
			'overlay_external'				=> '',
			'overlay_icon_name'				=> '',
			'overlay_icon_color'			=> '#ededed',
			'overlay_size'					=> 100,
			'overlay_opacity'				=> 75,
			'overlay_title_color'			=> '#ffffff',
			'overlay_title_back'			=> 'rgba(0, 0, 0, 0.4)',
			
			'content_tooltip_css'			=> 'false',
			'content_tooltip_content'		=> '',
			'content_tooltip_encoded'		=> '',
			'content_tooltip_position'		=> 'ts-simptip-position-top',
			'content_tooltip_style'			=> '',
			'tooltipster_offsetx'			=> 0,
			'tooltipster_offsety'			=> 0,
			
			'margin_top'					=> 0,
			'margin_bottom'					=> 0,
			'el_id'							=> '',
			'el_class'						=> '',
			'css'							=> '',
		), $atts ));
		
		// Load Required Files
		if ($content_lightbox == "true") {
			wp_enqueue_script('ts-extend-krautlightbox');
			wp_enqueue_style('ts-extend-krautlightbox');
		}
		if (($content_tooltip_content != '') || ($content_tooltip_encoded != '')) {
			wp_enqueue_style('ts-extend-tooltipster');
			wp_enqueue_script('ts-extend-tooltipster');
		}
		wp_enqueue_style('ts-visual-composer-extend-front');
		wp_enqueue_script('ts-visual-composer-extend-front');
	
		if (!empty($el_id)) {
			$modal_id						= $el_id;
		} else {
			$modal_id						= 'ts-vcsc-vimeo-' . mt_rand(999999, 9999999);
		}

		// Tooltip
		$content_tooltip_position			= TS_VCSC_TooltipMigratePosition($content_tooltip_position);
		$content_tooltip_style				= TS_VCSC_TooltipMigrateStyle($content_tooltip_style);	
		if ($content_tooltip_css == "false") {
			if (strlen($content_tooltip_content) != 0) {
				$vimeo_tooltipclasses		= " ts-has-tooltipster-tooltip";
				$vimeo_tooltipcontent 		= 'data-tooltipster-html="false" data-tooltipster-title="" data-tooltipster-text="' . strip_tags($content_tooltip_content) . '" data-tooltipster-image="" data-tooltipster-position="' . $content_tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $content_tooltip_style . '" data-tooltipster-animation="swing" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
			} else {
				$vimeo_tooltipclasses		= "";
				$vimeo_tooltipcontent		= "";
			}
		} else {
			if (strlen($content_tooltip_encoded) != 0) {
				$vimeo_tooltipclasses		= " ts-has-tooltipster-tooltip";
				$vimeo_tooltipcontent 		= 'data-tooltipster-html="true" data-tooltipster-title="" data-tooltipster-text="' . strip_tags($content_tooltip_encoded) . '" data-tooltipster-image="" data-tooltipster-position="' . $content_tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $content_tooltip_style . '" data-tooltipster-animation="swing" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
			} else {
				$vimeo_tooltipclasses		= "";
				$vimeo_tooltipcontent		= "";
			}
		}
		
		if ($lightbox_backlight_auto == "false") {
			$nacho_color					= 'data-backlight="' . $lightbox_backlight_color . '"';
		} else {
			$nacho_color					= '';
		}		
		$lightbox_dimensions				= ' ';
		if ($lightbox_width == "auto") {
			$lightbox_dimensions			.= '';
		} else if ($lightbox_width == "widthpercent") {
			$lightbox_dimensions 			.= 'data-width="' . $lightbox_width_percent . '%" ';
		} else if ($lightbox_width == "widthpixel") {
			$lightbox_dimensions 			.= 'data-width="' . $lightbox_width_pixel . '" ';
		}
		if ($lightbox_height == "auto") {
			$lightbox_dimensions			.= '';
		} else if ($lightbox_height == "heightpercent") {
			$lightbox_dimensions 			.= 'data-height="' . $lightbox_height_percent . '%" ';
		} else if ($lightbox_height == "heightpixel") {
			$lightbox_dimensions 			.= 'data-height="' . $lightbox_height_pixel . '" ';
		}
		$nacho_color						.= $lightbox_dimensions;
		
		// Overlay Settings
		$overlay_styling					= '';
		$overlay_addition					= '';
		$overlay_classes					= '';
		$overlay_visible					= '';
		if (($overlay_decoration == 'image') && ($overlay_image != '')) {
			$overlay_classes				= 'krautgrid-caption-custom';
			$overlay_image					= wp_get_attachment_image_src($overlay_image, 'medium');
			$overlay_addition				= '<img class="krautgrid-caption-image" src="' . $overlay_image[0] . '" style="opacity: ' . ($overlay_opacity/100) . '; width: ' . $overlay_size . 'px;">';
		} else if (($overlay_decoration == 'external') && ($overlay_external != '')) {
			$overlay_classes				= 'krautgrid-caption-custom';
			$overlay_addition				= '<img class="krautgrid-caption-image" src="' . $overlay_external . '" style="opacity: ' . ($overlay_opacity/100) . '; width: ' . $overlay_size . 'px;">';
		} else if (($overlay_decoration == 'icon') && ($overlay_icon_name != '')) {
			$overlay_classes				= 'krautgrid-caption-custom';
			$overlay_addition				= '<i class="krautgrid-caption-icon ' . $overlay_icon_name . '" style="opacity: ' . ($overlay_opacity/100) . '; color: ' . $overlay_icon_color . '; font-size: ' . $overlay_size . 'px; line-height: ' . $overlay_size . 'px;"></i>';
		} else if ($overlay_decoration == 'none') {
			$overlay_styling				= 'background-image: none;';
		}
		if ($overlay_background != "") {
			$overlay_background				= 'background-color: ' . $overlay_background . ';';
		}
		if ($overlay_visibility == 'only_deco') {
			$overlay_visible				= 'krautgrid-lighbox-show-onlydeco';
		} else if ($overlay_visibility == 'only_title') {
			$overlay_visible				= 'krautgrid-lighbox-show-onlytitle';
		} else if ($overlay_visibility == 'always') {
			$overlay_visible				= 'krautgrid-lighbox-show-all';
		}
		
		// Other Settings
		if ($content_image_responsive == "true") {
			$image_dimensions				= 'width: 100%; height: auto;';
			$parent_dimensions				= 'width: ' . $content_image_width_r . '%; ' . $content_image_height . '';
		} else {
			$image_dimensions				= 'width: 100%; height: auto;';
			$parent_dimensions				= 'width: ' . $content_image_width_f . 'px; ' . $content_image_height . '';
		}
		
		if (preg_match('~((http|https|ftp|ftps)://|www.)(.+?)~', $content_vimeo)) {
			$content_vimeo					= $content_vimeo;
		} else {
			$content_vimeo					= $content_vimeo;
		}
		
		if ($lightbox_play == "true") {
			$video_autoplay					= '?autoplay=1';
		} else {
			$video_autoplay					= '?autoplay=0';
		}
		if ($lightbox_loop == "true") {
			$video_loop						= '&loop=1';
		} else {
			$video_loop						= '&loop=0';
		}
		if ($lightbox_mute == "true") {
			$video_mute						= '&muted=1';
		} else {
			$video_mute						= '&muted=0';
		}
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Vimeo', $atts);
		} else {
			$css_class						= '';
		}
		
		$output								= '';

		if ($content_lightbox == "true") {
			// Retrieve Poster Image from Vimeo
			$modal_image 					= TS_VCSC_VideoImage_Vimeo($content_vimeo);
			if ($modal_image == '') {
				$modal_image 				= TS_VCSC_GetResourceURL('images/defaults/default_vimeo.jpg');
			}
			// Output Based on Trigger
			if ($content_vimeo_trigger == "preview") {
				if ($vimeo_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $vimeo_tooltipclasses . '" ' . $vimeo_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' krautgrid-item kraut-lightbox-vimeo kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' krautgrid-item kraut-lightbox-vimeo kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_vimeo . '" class="kraut-lightbox-media no-ajaxy" target="_blank" data-title="' . $content_vimeo_title . '" data-videoplay="' . $lightbox_play . '" data-loop="' . $lightbox_loop . '" data-mute="' . $lightbox_mute . '" data-type="vimeo" data-thumbnail="' . $modal_image . '" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img class="krautgrid-image-' . $overlay_animation . '" src="' . $modal_image . '" title="" data-no-lazy="1" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="krautgrid-caption ' . $overlay_classes . '" style="' . $overlay_background . ' ' . $overlay_styling . '">' . $overlay_addition . '</div>';
							if (!empty($content_vimeo_title)) {
								$output .= '<div class="krautgrid-caption-text" style="background: ' . $overlay_title_back . '; color: ' . $overlay_title_color . ';">' . $content_vimeo_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($vimeo_tooltipcontent != '') {
					$output .= '</div>';
				}
			}
			if ($content_vimeo_trigger == "default") {
				$modal_image = TS_VCSC_GetResourceURL('images/defaults/default_vimeo.jpg');
				if ($vimeo_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $vimeo_tooltipclasses . '" ' . $vimeo_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' krautgrid-item kraut-lightbox-vimeo kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' krautgrid-item kraut-lightbox-vimeo kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_vimeo . '" class="kraut-lightbox-media no-ajaxy" target="_blank" data-title="' . $content_vimeo_title . '" data-videoplay="' . $lightbox_play . '" data-loop="' . $lightbox_loop . '" data-mute="' . $lightbox_mute . '" data-type="vimeo" data-thumbnail="' . $modal_image . '" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img class="krautgrid-image-' . $overlay_animation . '" src="' . $modal_image . '" title="" data-no-lazy="1" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="krautgrid-caption ' . $overlay_classes . '" style="' . $overlay_background . ' ' . $overlay_styling . '">' . $overlay_addition . '</div>';
							if (!empty($content_vimeo_title)) {
								$output .= '<div class="krautgrid-caption-text" style="background: ' . $overlay_title_back . '; color: ' . $overlay_title_color . ';">' . $content_vimeo_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($vimeo_tooltipcontent != '') {
					$output .= '</div>';
				}
			}
			if ($content_vimeo_trigger == "image") {
				$modal_image = wp_get_attachment_image_src($content_vimeo_image, 'large');
				$modal_image = $modal_image[0];
				if ($content_vimeo_image_simple == "false") {
					if ($vimeo_tooltipcontent != '') {
						$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $vimeo_tooltipclasses . '" ' . $vimeo_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
							$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' krautgrid-item kraut-lightbox-vimeo kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="width: 100%; height: 100%;">';
					} else {
							$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' krautgrid-item kraut-lightbox-vimeo kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
					}
							$output .= '<a href="' . $content_vimeo . '" class="kraut-lightbox-media no-ajaxy" target="_blank" data-title="' . $content_vimeo_title . '" data-videoplay="' . $lightbox_play . '" data-loop="' . $lightbox_loop . '" data-mute="' . $lightbox_mute . '" data-type="vimeo" data-thumbnail="' . $modal_image . '" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
								$output .= '<img class="krautgrid-image-' . $overlay_animation . '" src="' . $modal_image . '" title="" data-no-lazy="1" style="display: block; ' . $image_dimensions . '">';
								$output .= '<div class="krautgrid-caption ' . $overlay_classes . '" style="' . $overlay_background . ' ' . $overlay_styling . '">' . $overlay_addition . '</div>';
								if (!empty($content_vimeo_title)) {
									$output .= '<div class="krautgrid-caption-text" style="background: ' . $overlay_title_back . '; color: ' . $overlay_title_color . ';">' . $content_vimeo_title . '</div>';
								}
							$output .= '</a>';
						$output .= '</div>';
					if ($vimeo_tooltipcontent != '') {
						$output .= '</div>';
					}
				} else {
					$output .= '<a href="' . $content_vimeo . '" class="' . $modal_id . '-parent nch-holder kraut-lightbox-media no-ajaxy ' . $vimeo_tooltipclasses . '" ' . $vimeo_tooltipcontent . ' target="_blank" style="' . $parent_dimensions . '" data-title="' . $content_vimeo_title . '" data-videoplay="' . $lightbox_play . '" data-loop="' . $lightbox_loop . '" data-mute="' . $lightbox_mute . '" data-type="vimeo" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
						$output .= '<img class="" src="' . $modal_image . '" style="display: block; ' . $image_dimensions . '">';
					$output .= '</a>';
				}
			}
			if ($content_vimeo_trigger == "icon") {
				$icon_style = 'color: ' . $content_vimeo_iconcolor . '; width:' . $content_vimeo_iconsize . 'px; height:' . $content_vimeo_iconsize . 'px; font-size:' . $content_vimeo_iconsize . 'px; line-height:' . $content_vimeo_iconsize . 'px;';
				$output .= '<div id="' . $modal_id . '" style="" class="' . $modal_id . '-parent nch-holder ts-vcsc-font-icon ts-font-icons ts-shortcode ts-icon-align-center ' . $el_class . ' ' . $css_class . ' ' . $vimeo_tooltipclasses . '" ' . $vimeo_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a class="ts-font-icons-link kraut-lightbox-media no-ajaxy" href="' . $content_vimeo . '" target="_blank" data-title="' . $content_vimeo_title . '" data-videoplay="' . $lightbox_play . '" data-loop="' . $lightbox_loop . '" data-mute="' . $lightbox_mute . '" data-type="vimeo" data-thumbnail="' . $modal_image . '" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
						$output .= '<i class="ts-font-icon ' . $content_vimeo_icon . '" style="' . $icon_style . '"></i>';
					$output .= '</a>';
				$output .= '</div>';
			}
			if (($content_vimeo_trigger == "flat") || ($content_vimeo_trigger == "flaticon")) {
				wp_enqueue_style('ts-extend-buttonsdual');
				$button_style				= $content_vimeo_buttonstyle . ' ' . $content_vimeo_buttonhover;
				$output .= '<a id="' . $modal_id . '" class="ts-dual-buttons-container kraut-lightbox-media no-ajaxy ' . $css_class . ' ' . $el_class . '" href="' . $content_vimeo . '" target="_blank" data-title="' . $content_vimeo_title . '" data-videoplay="' . $lightbox_play . '" data-loop="' . $lightbox_loop . '" data-mute="' . $lightbox_mute . '" data-type="vimeo" data-thumbnail="' . $modal_image . '" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
					$output .= '<div id="' . $modal_id . '-trigger" class="ts-dual-buttons-wrapper clearFixMe ' . $button_style . ' ' . $modal_id . '-parent nch-holder ' . $vimeo_tooltipclasses . '" ' . $vimeo_tooltipcontent . ' style="width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						if (($content_vimeo_icon != '') && ($content_vimeo_icon != 'transparent') && ($content_vimeo_trigger == "flaticon")) {
							$output .= '<i class="ts-dual-buttons-icon ' . $content_vimeo_icon . '" style="font-size: ' . $content_vimeo_buttonsize . 'px; line-height: ' . $content_vimeo_buttonsize . 'px;"></i>';
						}
						$output .= '<span class="ts-dual-buttons-title" style="font-size: ' . $content_vimeo_buttonsize . 'px; line-height: ' . $content_vimeo_buttonsize . 'px;">' . $content_vimeo_buttontext . '</span>';			
					$output .= '</div>';
				$output .= '</a>';
			}
			if ($content_vimeo_trigger == "winged") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' ' . $css_class . '" style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<div class="ts-lightbox-button-1 clearFixMe">';
						$output .= '<div class="top">' . $content_vimeo_title . '</div>';
						$output .= '<div class="bottom">' . $content_vimeo_subtitle . '</div>';
						$output .= '<a href="' . $content_vimeo . '" class="kraut-lightbox-media no-ajaxy icon" target="_blank" data-title="' . $content_vimeo_title . '" data-videoplay="' . $lightbox_play . '" data-loop="' . $lightbox_loop . '" data-mute="' . $lightbox_mute . '" data-type="vimeo" data-thumbnail="' . $modal_image . '" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '><span class="vimeo">' . $content_vimeo_buttontext . '</span></a>';
					$output .= '</div>';
				$output .= '</div>';
			}
			if ($content_vimeo_trigger == "simple") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' ' . $vimeo_tooltipclasses . ' ' . $css_class . '" ' . $vimeo_tooltipcontent . ' style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a href="' . $content_vimeo . '" class="ts-lightbox-button-2 icon kraut-lightbox-media no-ajaxy" target="_blank" data-title="' . $content_vimeo_title . '" data-videoplay="' . $lightbox_play . '" data-loop="' . $lightbox_loop . '" data-mute="' . $lightbox_mute . '" data-type="vimeo" data-thumbnail="' . $modal_image . '" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '><span class="vimeo">' . $content_vimeo_buttontext . '</span></a>';
				$output .= '</div>';
			}
			if ($content_vimeo_trigger == "text") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' ' . $css_class . '" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a href="' . $content_vimeo . '" class="kraut-lightbox-media no-ajaxy ' . $vimeo_tooltipclasses . '" ' . $vimeo_tooltipcontent . ' data-title="' . $content_vimeo_title . '" data-videoplay="' . $lightbox_play . '" data-loop="' . $lightbox_loop . '" data-mute="' . $lightbox_mute . '" data-type="vimeo" data-thumbnail="' . $modal_image . '" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . ' target="_blank">' . $content_vimeo_text . '</a>';
				$output .= '</div>';
			}
			if ($content_vimeo_trigger == "custom") {
				if ($content_raw != "") {
					$content_raw =  rawurldecode(base64_decode(strip_tags($content_raw)));
					$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' ' . $css_class . '" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						$output .= '<a href="' . $content_vimeo . '" class="kraut-lightbox-media no-ajaxy ' . $vimeo_tooltipclasses . '" ' . $vimeo_tooltipcontent . ' data-title="' . $content_vimeo_title . '" data-videoplay="' . $lightbox_play . '" data-loop="' . $lightbox_loop . '" data-mute="' . $lightbox_mute . '" data-type="vimeo" data-thumbnail="' . $modal_image . '" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . ' style="" target="_blank">';
							$output .= $content_raw;
						$output .= '</a>';
					$output .= '</div>';
				}
			}
		} else {
			$modal_image = TS_VCSC_VideoID_Vimeo($content_vimeo);
			$output .= '<div id="' . $modal_id . '" class="ts-video-container ' . $content_ratio . ' ' . $vimeo_tooltipclasses . '" ' . $vimeo_tooltipcontent . '>';
				$output .= '<iframe class="ts-video-iframe" src="https://player.vimeo.com/video/' . $modal_image . $video_autoplay . $video_loop . $video_mute . '&autopause=0" width="100%" height="auto" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay; fullscreen"></iframe>';
			$output .= '</div>';
		}

		echo $output;
	
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>