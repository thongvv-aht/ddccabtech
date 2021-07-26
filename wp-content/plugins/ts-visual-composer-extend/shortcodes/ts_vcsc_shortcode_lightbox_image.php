<?php
	add_shortcode('TS-VCSC-Lightbox-Image', 'TS_VCSC_Lightbox_Image_Function');
	function TS_VCSC_Lightbox_Image_Function ($atts, $content = null) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();

		extract( shortcode_atts( array(
			'featured_image'				=> 'false',
			
			'external_link_usage'			=> 'false', // true, false, featured
			'external_link_lightbox'		=> '',
			'external_link_preview'			=> '',
			
			'content_overlay'				=> 'custom',
			'content_title'					=> '',
			'content_image'					=> '',
			'content_align'					=> 'center', // center, left, right
			'content_shape'					=> 'standard', // standard, circle, losange, diamond, hexagon, octagon
			
			'content_image_responsive'		=> 'true',
			'content_image_height'			=> 'height: 100%;',
			'content_image_width_r'			=> 100,
			'content_image_width_f'			=> 300,
			'content_image_size'			=> 'medium',
			'content_custom_width'			=> 1280,
			'content_custom_height'			=> 720,

			'attribute_alt'					=> 'false',
			'attribute_alt_value'			=> '',
			
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
			
			'lightbox_title'				=> 'overlay',
			'lightbox_alternative'			=> 'false',
			'lightbox_image'				=> '',			
			'lightbox_group'				=> 'true',
			'lightbox_group_name'			=> '',
			'lightbox_size'					=> 'full',
			'lightbox_effect'				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxDefaultAnimation,
			'lightbox_speed'				=> 5000,
			'lightbox_social'				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxSocialShare,
			'lightbox_save'					=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxSaveImages,
			'lightbox_backlight'			=> 'auto',
			'lightbox_backlight_color'		=> '#ffffff',
			'lightbox_usecors'				=> 'global',
			'lightbox_nohashes'				=> 'true',

			'margin_top'					=> 0,
			'margin_bottom'					=> 0,
			'el_id'							=> '',
			'el_class'						=> '',
			'css'							=> '',
		), $atts ));		
		
		// Load Required Files
		wp_enqueue_script('ts-extend-krautlightbox');
		wp_enqueue_style('ts-extend-krautlightbox');
		wp_enqueue_style('ts-extend-animations');		
		if ($content_shape != "standard") {
			wp_enqueue_style('ts-extend-imageshapes');
			wp_enqueue_script('ts-extend-imageshapes');
		}
		wp_enqueue_style('ts-visual-composer-extend-front');
		wp_enqueue_script('ts-visual-composer-extend-front');
	
		if (!empty($el_id)) {
			$modal_id						= $el_id;
		} else {
			$modal_id						= 'ts-vcsc-lightbox-image-' . mt_rand(999999, 9999999);
		}
		
		$output								= '';
		$nacho_color						= '';
		$modal_id							= '';
		$modal_image						= '';
		$modal_thumb						= '';
		$modal_retina						= '';
		$modal_preview						= '';

		if ($external_link_usage == 'featured') {
			$post_id 						= get_the_ID();
			if ($post_id && has_post_thumbnail($post_id)) {
				$img_id 					= get_post_thumbnail_id($post_id);
			} else {
				$img_id 					= 0;
			}
			if (($post_id == '') || ($img_id == '') || ($img_id == 0)) {
				$myvariable = ob_get_clean();
				return $myvariable;
			} else {
				$modal_image 				= wp_get_attachment_image_src($img_id, $lightbox_size);
				$modal_image				= $modal_image[0];
				if ($content_image_size == 'custom') {
					$modal_thumb			= TS_VCSC_CreateCustomImageSize(preg_replace('/[^\d]/', '', $img_id), $content_custom_width, $content_custom_height);
				} else {
					$modal_thumb			= wp_get_attachment_image_src(preg_replace('/[^\d]/', '', $img_id), $content_image_size);
				}				
				$modal_thumb				= $modal_thumb[0];
			}
			$modal_id						= $img_id;
		} else {		
			if ($external_link_usage == 'true') {
				$modal_image				= $external_link_lightbox;
				$modal_thumb				= $external_link_preview;
				$modal_id					= '';
			} else {
				if (!empty($content_image)) {
					if ($lightbox_alternative == "true") {
						$modal_image 		= wp_get_attachment_image_src($lightbox_image, $lightbox_size);
						$modal_image		= $modal_image[0];
					} else {
						$modal_image 		= wp_get_attachment_image_src($content_image, $lightbox_size);
						$modal_image		= $modal_image[0];
					}
					if ($content_image_size == 'custom') {
						$modal_thumb		= TS_VCSC_CreateCustomImageSize(preg_replace('/[^\d]/', '', $content_image), $content_custom_width, $content_custom_height);
					} else {
						$modal_thumb		= wp_get_attachment_image_src(preg_replace('/[^\d]/', '', $content_image), $content_image_size);
					}
					$modal_thumb			= $modal_thumb[0];
					if ((function_exists('wp_get_attachment_image_srcset')) && ($content_image_size != 'custom')) {
						$modal_retina		= wp_get_attachment_image_srcset($content_image, $content_image_size);
						$modal_retina		= 'srcset="' . $modal_retina . '"';
					}
					$modal_id				= $content_image;
				} else {
					$myvariable = ob_get_clean();
					return $myvariable;
				}
			}
		}

		if ($lightbox_backlight == "auto") {
			$nacho_color					= 'data-nohashes="' . $lightbox_nohashes . '"';
		} else if ($lightbox_backlight == "custom") {
			$nacho_color					= 'data-color="' . $lightbox_backlight_color . '" data-nohashes="' . $lightbox_nohashes . '"';
		} else if ($lightbox_backlight == "hideit") {
			$nacho_color					= 'data-color="rgba(0, 0, 0, 0)" data-nohashes="' . $lightbox_nohashes . '"';
		}
		
		if ($content_image_responsive == "true") {
			$image_dimensions				= 'width: 100%; height: auto;';
			$parent_dimensions				= 'width: ' . $content_image_width_r . '%; ' . $content_image_height;
		} else {
			$image_dimensions				= 'width: 100%; height: auto;';
			$parent_dimensions				= 'width: ' . $content_image_width_f . 'px; ' . $content_image_height;
		}
		
		$image_extension 					= pathinfo($modal_image, PATHINFO_EXTENSION);
		
		// Image Data
		$modal_data 						= TS_VCSC_GetImageMetaData($modal_id);
		
		if ($content_overlay == "custom") {
			$content_title					= $content_title;
		} else if ($content_overlay == "title") {
			$content_title					= (isset($modal_data['title']) ? $modal_data['title'] : "");
		} else if ($content_overlay == "alt") {
			$content_title					= (isset($modal_data['alt']) ? $modal_data['alt'] : "");
		} else if ($content_overlay == "caption") {
			$content_title					= (isset($modal_data['caption']) ? $modal_data['caption'] : "");
		} else if ($content_overlay == "content") {
			$content_title					= (isset($modal_data['content']) ? $modal_data['content'] : "");
		} else {
			$content_title					= "";
		}
		
		if ($lightbox_title == "overlay") {
			$content_lightbox				= $content_title;
		} else if ($lightbox_title == "title") {
			$content_lightbox				= (isset($modal_data['title']) ? $modal_data['title'] : "");
		} else if ($lightbox_title == "alt") {
			$content_lightbox				= (isset($modal_data['alt']) ? $modal_data['alt'] : "");
		} else if ($lightbox_title == "caption") {
			$content_lightbox				= (isset($modal_data['caption']) ? $modal_data['caption'] : "");
		} else if ($lightbox_title == "content") {
			$content_lightbox				= (isset($modal_data['content']) ? $modal_data['content'] : "");
		} else {
			$content_lightbox				= "";
		}
		
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
		
		if ($attribute_alt == "true") {
			$alt_attribute					= $attribute_alt_value;
		} else {
			if (($modal_id == "") && ($external_link_usage != 'true')) {
				$alt_attribute				= basename($modal_image[0], "." . $image_extension);
			} else if (($modal_id != "") && ($external_link_usage != 'true')) {
				$alt_attribute				= $modal_data['alt'];
				if ($alt_attribute == "") {
					$alt_attribute			= basename($modal_image[0], "." . $image_extension);
				}
			} else if ($external_link_usage == 'true') {
				$alt_attribute				= $external_link_preview;
			} else {
				$alt_attribute				= '';
			}
		}
		
		if ($content_align == 'center') {
			$parent_alignment				= 'margin-left: auto; margin-right: auto; float: none;';
		} else if ($content_align == 'left') {
			$parent_alignment				= 'margin-left: 0px; margin-right: 0px; float: left;';
		} else if ($content_align == 'right') {
			$parent_alignment				= 'margin-left: 0px; margin-right: 0px; float: right;';
		}
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			if ($content_shape == "standard") {
				$css_class 					= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'krautgrid-item krautgrid-tile kraut-lightbox-single kraut-lightbox-image ' . $modal_id . '-parent ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Lightbox-Image', $atts);
			} else {
				$css_class 					= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-lightbox-shape-container ' . $modal_id . '-parent ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Lightbox-Image', $atts);
			}
		} else {
			if ($content_shape == "standard") {
				$css_class					= 'krautgrid-item krautgrid-tile kraut-lightbox-single kraut-lightbox-image ' . $modal_id . '-parent ' . $el_class;
			} else {
				$css_class					= 'ts-lightbox-shape-container ' . $modal_id . '-parent ' . $el_class;
			}
		}
		
		$output .= '<div id="' . $modal_id . '" class="' . $css_class . ' ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . ' ' . $parent_alignment . '">';
			$output .= '<a href="' . $modal_image . '" class="kraut-lightbox-media nofancybox no-ajaxy" data-title="' . $content_lightbox . '" rel="' . ($lightbox_group == "true" ? "krautgroup" : $lightbox_group_name) . '" data-thumbnail="' . $modal_thumb . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-effect="' . $lightbox_effect . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
				if ($content_shape == "standard") {
					$output .= '<img class="krautgrid-image-' . $overlay_animation . '" src="' . $modal_thumb . '" ' . $modal_retina . ' alt="' . $alt_attribute . '" title="" style="display: block; ' . $image_dimensions . '">';
					$output .= '<div class="krautgrid-caption ' . $overlay_classes . '" style="' . $overlay_background . ' ' . $overlay_styling . '">' . $overlay_addition . '</div>';
					if (!empty($content_title)) {
						$output .= '<div class="krautgrid-caption-text" style="background: ' . $overlay_title_back . '; color: ' . $overlay_title_color . ';">' . $content_title . '</div>';
					}
				} else {
					if ($content_shape == "circle") {
						$output .= '<div class="ts-lightbox-shape-padding">';
							$output .= '<div class="ts-lightbox-shape-holder" data-effect="ts-lightbox-shape-' . $content_shape . '" style="">';
								$output .= '<div class="ts-lightbox-shape-inner">';
									$output .= '<img class="ts-lightbox-shape-image" src="' . $modal_thumb . '" ' . $modal_retina . ' data-no-lazy="1" alt="' . $alt_attribute . '" title="" style="">';
									$output .= '<div class="ts-lightbox-shape-caption"></div>';					
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</div>';
					} else if ($content_shape == "losange") {
						$output .= '<div class="ts-lightbox-shape-padding">';
							$output .= '<div class="ts-lightbox-shape-holder" data-effect="ts-lightbox-shape-' . $content_shape . '" style="">';
								$output .= '<div class="ts-lightbox-shape-inner">';
									$output .= '<img class="ts-lightbox-shape-image" src="' . $modal_thumb . '" ' . $modal_retina . ' data-no-lazy="1" alt="' . $alt_attribute . '" title="" style="">';
									$output .= '<div class="ts-lightbox-shape-caption"></div>';					
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</div>';
					} else if ($content_shape == "diamond") {
						$output .= '<div class="ts-lightbox-shape-padding">';
							$output .= '<div class="ts-lightbox-shape-holder" data-effect="ts-lightbox-shape-' . $content_shape . '" style="">';
								$output .= '<div class="ts-lightbox-shape-inner">';
									$output .= '<img class="ts-lightbox-shape-image" src="' . $modal_thumb . '" ' . $modal_retina . ' data-no-lazy="1" alt="' . $alt_attribute . '" title="" style="">';								
									$output .= '<div class="ts-lightbox-shape-caption"></div>';								
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</div>';
					} else if ($content_shape == "hexagon") {
						$output .= '<div class="ts-lightbox-shape-padding">';
							$output .= '<div class="ts-lightbox-shape-holder" data-effect="ts-lightbox-shape-' . $content_shape . '" style="">';
								$output .= '<div class="ts-lightbox-shape-inner1">';
									$output .= '<div class="ts-lightbox-shape-inner2">';
										$output .= '<img class="ts-lightbox-shape-image" src="' . $modal_thumb . '" ' . $modal_retina . ' data-no-lazy="1" alt="' . $alt_attribute . '" title="" style="">';
										$output .= '<div class="ts-lightbox-shape-caption"></div>';
									$output .= '</div>';
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</div>';
					} else if ($content_shape == "octagon") {
						$output .= '<div class="ts-lightbox-shape-padding">';
							$output .= '<div class="ts-lightbox-shape-holder" data-effect="ts-lightbox-shape-' . $content_shape . '" style="">';
								$output .= '<div class="ts-lightbox-shape-inner1">';
									$output .= '<div class="ts-lightbox-shape-inner2">';
										$output .= '<div class="ts-lightbox-shape-inner3">';
											$output .= '<img class="ts-lightbox-shape-image" src="' . $modal_thumb . '" ' . $modal_retina . ' data-no-lazy="1" alt="' . $alt_attribute . '" title="" style="">';
											$output .= '<div class="ts-lightbox-shape-caption"></div>';
										$output .= '</div>';
									$output .= '</div>';
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</div>';
					}
				}
			$output .= '</a>';
		$output .= '</div>';
		
		echo $output;
	
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>