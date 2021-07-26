<?php
	add_shortcode('TS-VCSC-Youtube', 'TS_VCSC_Youtube_Function');
	function TS_VCSC_Youtube_Function ($atts, $content = null) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		extract( shortcode_atts( array(
			'content_type'					=> 'video',
			'content_youtube'				=> '',
			'content_playlist'				=> '',
			'content_search'				=> '',
			'content_combination'			=> '',
			'content_uploads'				=> '',
			'content_lightbox'				=> 'false',
			'content_ratio'					=> 'ts-ratio-sixteen-to-nine',
			
			'content_overlay_use'			=> 'false',
			'content_overlay_source'		=> 'internal',
			'content_overlay_lazy'			=> 'true',
			'content_overlay_image'			=> '',
			'content_overlay_quality'		=> 'medium',
			'content_overlay_level'			=> 'high',
			'content_overlay_trigger'		=> 'click',
			'content_overlay_text'			=> '',
			'content_overlay_font'			=> '#ffffff',
			'content_overlay_handle'		=> 'true',
			'content_overlay_color'			=> '#fb4400',
			'content_overlay_align'			=> 'center',
			
			'content_image_responsive'		=> 'true',
			'content_image_height'			=> 'height: 100%;',
			'content_image_width_r'			=> 100,
			'content_image_width_f'			=> 300,
			'content_image_size'			=> 'large',
			
			'video_controls'				=> 1,
			'video_autohide'				=> 1,
			'video_infobar'					=> 'true',
			'video_related'					=> 'false',
			'video_modest'					=> 'false',
			'video_loop'					=> 'false',
			'video_mute'					=> 'false',
			'video_start'					=> 0,
			'video_end'						=> 0,
			'video_quality'					=> 'auto', // auto, tiny, small, medium, large, hd720, hd1080
			
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
			
			'lightbox_group_name'			=> 'krautgroup',
			'lightbox_size'					=> 'full',
			'lightbox_effect'				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxDefaultAnimation,
			'lightbox_speed'				=> 5000,
			'lightbox_social'				=> 'true',
			'lightbox_play'					=> 'false',
			'lightbox_backlight_auto'		=> 'true',
			'lightbox_backlight_color'		=> '#ffffff',
			
			'lightbox_width'				=> 'auto',
			'lightbox_width_percent'		=> 100,
			'lightbox_width_pixel'			=> 960,
			'lightbox_height'				=> 'auto',
			'lightbox_height_percent'		=> 100,
			'lightbox_height_pixel'			=> 540,
			
			'content_youtube_start'			=> '',
			'content_youtube_end'			=> '',			
			'content_youtube_trigger'		=> 'default',
			'content_youtube_quality'		=> 'high',
			'content_youtube_title'			=> '',
			'content_youtube_subtitle'		=> '',
			'content_youtube_image'			=> '',
			'content_youtube_image_simple'	=> 'false',
			'content_youtube_icon'			=> '',
			'content_youtube_iconsize'		=> 30,
			'content_youtube_iconcolor' 	=> '#cccccc',
			'content_youtube_button'		=> '',
			'content_youtube_buttonstyle'	=> 'ts-dual-buttons-color-sun-flower',
			'content_youtube_buttonhover'	=> 'ts-dual-buttons-preview-default ts-dual-buttons-hover-default',
			'content_youtube_buttontext'	=> 'View Video',
			'content_youtube_buttonsize'	=> 16,
			'content_youtube_text'			=> '',
			'content_raw'					=> '',
			
			'youtube_user'					=> '',
			'youtube_channel'				=> '',
			'youtube_apikey'				=> (isset($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_InformationExternalAPIs['YouTube']) ? $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_InformationExternalAPIs['YouTube'] : ''),
			
			'content_tooltip_html'			=> 'true',
			'content_tooltip_content'		=> '',
			'content_tooltip_encoded'		=> '',
			'content_tooltip_position'		=> 'ts-simptip-position-top',
			'content_tooltip_style'			=> 'ts-simptip-style-black',
			'content_tooltip_animation'		=> 'swing',
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
			$modal_id						= 'ts-vcsc-youtube-' . mt_rand(999999, 9999999);
		}
		
		// YouTube API Key
		if ($youtube_apikey == "") {
			$youtube_apikey					= (isset($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_InformationExternalAPIs['YouTube']) ? $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_InformationExternalAPIs['YouTube'] : '');
		}		

		// Tooltip
		$content_tooltip_position			= TS_VCSC_TooltipMigratePosition($content_tooltip_position);
		$content_tooltip_style				= TS_VCSC_TooltipMigrateStyle($content_tooltip_style);		
		if ($content_tooltip_html == "false") {
			if (strlen($content_tooltip_content) != 0) {
				$youtube_tooltipclasses		= " ts-has-tooltipster-tooltip";
				$youtube_tooltipcontent 	= 'data-tooltipster-html="false" data-tooltipster-title="" data-tooltipster-text="' . strip_tags($content_tooltip_content) . '" data-tooltipster-image="" data-tooltipster-position="' . $content_tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $content_tooltip_style . '" data-tooltipster-animation="' . $content_tooltip_animation . '" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
			} else {
				$youtube_tooltipclasses		= "";
				$youtube_tooltipcontent		= "";
			}
		} else {
			if (strlen($content_tooltip_encoded) != 0) {
				$youtube_tooltipclasses		= " ts-has-tooltipster-tooltip";
				$youtube_tooltipcontent 	= 'data-tooltipster-html="true" data-tooltipster-title="" data-tooltipster-text="' . str_replace('<br/>', ' ', strip_tags($content_tooltip_encoded)) . '" data-tooltipster-image="" data-tooltipster-position="' . $content_tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $content_tooltip_style . '" data-tooltipster-animation="' . $content_tooltip_animation . '" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
			} else {
				$youtube_tooltipclasses		= "";
				$youtube_tooltipcontent		= "";
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
		
		if ($content_image_responsive == "true") {
			$image_dimensions				= 'width: 100%; height: auto;';
			$parent_dimensions				= 'width: ' . $content_image_width_r . '%; ' . $content_image_height . '';
		} else {
			$image_dimensions				= 'width: 100%; height: auto;';
			$parent_dimensions				= 'width: ' . $content_image_width_f . 'px; ' . $content_image_height . '';
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
		
		// Other Settings
		if ($lightbox_play == "true") {
			if ($content_overlay_use == 'true') {
				$video_autoplay				= ($content_type == 'video' ? '?autoplay=0' : '&autoplay=0');
			} else {
				$video_autoplay				= ($content_type == 'video' ? '?autoplay=1' : '&autoplay=1');
			}
		} else {
			$video_autoplay					= ($content_type == 'video' ? '?autoplay=0' : '&autoplay=0');
		}
		if ($video_loop == "true") {
			$videos_loop					= '&loop=1';
		} else {
			$videos_loop					= '&loop=0';
		}
		if ($video_related == "true") {
			$videos_related					= '&rel=1';
		} else {
			$videos_related					= '&rel=0';
		}
		if ($video_infobar == "true") {
			$videos_infobar					= '&showinfo=1';
		} else {
			$videos_infobar					= '&showinfo=0';
		}
		if ($video_modest == "true") {
			$videos_modest					= '&modestbranding=1';
		} else {
			$videos_modest					= '&modestbranding=0';
		}
		if ($video_mute == "true") {
			$videos_mute					= '&mute=1';
		} else {
			$videos_mute					= '&mute=0';
		}		
		$videos_controls					= '&controls=' . $video_controls;
		$videos_autohide					= '&autohide=' . $video_autohide;
		$videos_quality						= '&vq=' . $video_quality;
		if ($video_start > 0) {
			$videos_start					= '&start=' . $video_start;
		} else {
			$videos_start					= '';
		}
		if (($video_end > 0) && ($video_end > $video_start)) {
			$videos_end						= '&end=' . $video_end;
		} else {
			$videos_end						= '';
		}
		if ($content_type != 'video') {
			$content_youtube				= 'about:blank';
		}		
		$output								= '';

		// WP Bakery Page Builder Custom Override
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Youtube', $atts);
		} else {
			$css_class						= '';
		}
		
		// YouTube Video in Lightbox
		if ($content_lightbox == "true") {
			if ($content_type == 'combination') {
				$videos 					= explode(",", str_replace(' ', '', $content_combination));
				$count 						= count($videos);
				if ($count == 1) {
					$first 					= $content_combination;
					$other 					= '';
				} else if ($count > 1){
					$first 					= $videos[0];
					array_shift($videos);
					$other 					= implode(",", $videos);
				}
			} else {
				$first						= '';
				$other						= '';
			}
			$playlistdata					= 'data-contenttype="' . $content_type . '" data-listid="' . ($content_type == 'playlist' ? TS_VCSC_PlaylistID_Youtube($content_playlist) : '') . '" data-userid="' . ($content_type == 'uploads' ? $content_uploads : '') . '" data-videofirst="' . $first . '" data-videosother="' . $other . '" data-search="' . ($content_type == 'searchterm' ? str_replace(' ', '', $content_search) : '') . '"';
			if (($content_youtube_trigger == "preview") || ($content_youtube_trigger == "coverfirst")) {
				if ((preg_match('~((http|https|ftp|ftps)://|www.)(.+?)~', $content_youtube)) && ($content_youtube_trigger == "preview")) {
					$content_youtube		= $content_youtube;
				} else if (($content_youtube_trigger == "preview") && ($content_youtube_trigger == "preview")) {
					$content_youtube		= 'https://www.youtube.com/watch?v=' . $content_youtube;
				} else if (($content_youtube_trigger == "coverfirst") && ($content_type == 'combination')) {
					$content_youtube		= 'https://www.youtube.com/watch?v=' . $first;
				} else {
					$content_youtube		= 'about:blank';
				}
				if ($content_youtube != 'about:blank') {
					$modal_image 			= TS_VCSC_VideoImage_Youtube($content_youtube, $content_youtube_quality);
				} else {
					$modal_image 			= TS_VCSC_GetResourceURL('images/defaults/default_youtube.jpg');
				}
				if ($youtube_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' krautgrid-item kraut-lightbox-youtube kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' krautgrid-item kraut-lightbox-youtube kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_youtube . '" class="kraut-lightbox-media no-ajaxy" target="_blank" data-thumbnail="' . $modal_image . '" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-infobar="' . $video_infobar . '" data-controls="' . $video_controls . '" data-autohide="' . $video_autohide . '" data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-loop="' . $video_loop . '" data-modest="' . $video_modest . '" data-mute="' . $video_mute . '" data-quality="' . $video_quality . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img class="krautgrid-image-' . $overlay_animation . '" src="' . $modal_image . '" title="" data-no-lazy="1" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="krautgrid-caption ' . $overlay_classes . '" style="' . $overlay_background . ' ' . $overlay_styling . '">' . $overlay_addition . '</div>';
							if (!empty($content_youtube_title)) {
								$output .= '<div class="krautgrid-caption-text" style="background: ' . $overlay_title_back . '; color: ' . $overlay_title_color . ';">' . $content_youtube_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($youtube_tooltipcontent != '') {
					$output .= '</div>';
				}
			}			
			if ($content_youtube_trigger == "playcover") {
				if (($content_playlist != '') && ($content_type == 'playlist') && ($youtube_apikey != '')) {			
					$xmlfeed 				= TS_VCSC_RetrieveExternalData('https://www.googleapis.com/youtube/v3/playlists?part=snippet&id=' . TS_VCSC_PlaylistID_Youtube($content_playlist) . '&key=' . $youtube_apikey . '');
					if ($xmlfeed != '') {
						$xmlfeed 			= (json_decode($xmlfeed, true));
					} else {
						$xmlfeed			= array();
					}
				} else {
					$xmlfeed 				= array();
				}
				if ($xmlfeed != '') {
					if (isset($xmlfeed['items'][0]['snippet']['thumbnails']['standard']['url'])) {
						$modal_image 		= $xmlfeed['items'][0]['snippet']['thumbnails']['standard']['url'];
					} else if (isset($xmlfeed['items'][0]['snippet']['thumbnails']['high']['url'])) {
						$modal_image 		= $xmlfeed['items'][0]['snippet']['thumbnails']['high']['url'];
					} else if (isset($xmlfeed['items'][0]['snippet']['thumbnails']['medium']['url'])) {
						$modal_image 		= $xmlfeed['items'][0]['snippet']['thumbnails']['medium']['url'];
					} else if (isset($xmlfeed['items'][0]['snippet']['thumbnails']['default']['url'])) {
						$modal_image 		= $xmlfeed['items'][0]['snippet']['thumbnails']['default']['url'];
					} else {
						$modal_image 		= TS_VCSC_GetResourceURL('images/defaults/default_youtube.jpg');
					}
				} else {
					$modal_image 			= TS_VCSC_GetResourceURL('images/defaults/default_youtube.jpg');
				}
				$content_youtube			= 'about:blank';
				if ($youtube_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' krautgrid-item kraut-lightbox-youtube kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' krautgrid-item kraut-lightbox-youtube kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_youtube . '" class="kraut-lightbox-media no-ajaxy" target="_blank" data-thumbnail="' . $modal_image . '" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-infobar="' . $video_infobar . '" data-controls="' . $video_controls . '" data-autohide="' . $video_autohide . '" data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-loop="' . $video_loop . '" data-modest="' . $video_modest . '" data-mute="' . $video_mute . '" data-quality="' . $video_quality . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img class="krautgrid-image-' . $overlay_animation . '" src="' . $modal_image . '" title="" data-no-lazy="1" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="krautgrid-caption ' . $overlay_classes . '" style="' . $overlay_background . ' ' . $overlay_styling . '">' . $overlay_addition . '</div>';
							if (!empty($content_youtube_title)) {
								$output .= '<div class="krautgrid-caption-text" style="background: ' . $overlay_title_back . '; color: ' . $overlay_title_color . ';">' . $content_youtube_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($youtube_tooltipcontent != '') {
					$output .= '</div>';
				}			
			}
			if ($content_youtube_trigger == "usercover") {
				if (($content_uploads != '') && ($content_type == 'uploads') && ($youtube_apikey != '')) {
					$xmlfeed 				= TS_VCSC_RetrieveExternalData('https://www.googleapis.com/youtube/v3/channels?part=brandingSettings&forUsername=' . $content_uploads . '&key=' . $youtube_apikey . '');
					if ($xmlfeed != '') {
						$xmlfeed 			= (json_decode($xmlfeed, true));
					} else {
						$xmlfeed			= array();
					}
				} else {
					$xmlfeed				= array();
				}
				if ($xmlfeed != '') {
					if (isset($xmlfeed['items'][0]['brandingSettings']['image']['bannerTvImageUrl'])) {
						$modal_image 		= $xmlfeed['items'][0]['brandingSettings']['image']['bannerTvImageUrl'];
					} else if (isset($xmlfeed['items'][0]['brandingSettings']['image']['bannerImageUrl'])) {
						$modal_image 		= $xmlfeed['items'][0]['brandingSettings']['image']['bannerImageUrl'];
					} else {
						$modal_image 		= TS_VCSC_GetResourceURL('images/defaults/default_youtube.jpg');
					}
				} else {
					$modal_image 			= TS_VCSC_GetResourceURL('images/defaults/default_youtube.jpg');
				}
				$content_youtube			= 'about:blank';
				if ($youtube_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' krautgrid-item kraut-lightbox-youtube kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' krautgrid-item kraut-lightbox-youtube kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_youtube . '" class="kraut-lightbox-media no-ajaxy" target="_blank" data-thumbnail="' . $modal_image . '" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-infobar="' . $video_infobar . '" data-controls="' . $video_controls . '" data-autohide="' . $video_autohide . '" data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-loop="' . $video_loop . '" data-modest="' . $video_modest . '" data-mute="' . $video_mute . '" data-quality="' . $video_quality . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img class="krautgrid-image-' . $overlay_animation . '" src="' . $modal_image . '" title="" data-no-lazy="1" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="krautgrid-caption ' . $overlay_classes . '" style="' . $overlay_background . ' ' . $overlay_styling . '">' . $overlay_addition . '</div>';
							if (!empty($content_youtube_title)) {
								$output .= '<div class="krautgrid-caption-text" style="background: ' . $overlay_title_back . '; color: ' . $overlay_title_color . ';">' . $content_youtube_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($youtube_tooltipcontent != '') {
					$output .= '</div>';
				}			
			}
			if ($content_youtube_trigger == "default") {
				$modal_image = TS_VCSC_GetResourceURL('images/defaults/default_youtube.jpg');
				if ($youtube_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' krautgrid-item kraut-lightbox-youtube kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' krautgrid-item kraut-lightbox-youtube kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_youtube . '" class="kraut-lightbox-media no-ajaxy" target="_blank" data-thumbnail="' . $modal_image . '" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-infobar="' . $video_infobar . '" data-controls="' . $video_controls . '" data-autohide="' . $video_autohide . '" data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-loop="' . $video_loop . '" data-modest="' . $video_modest . '" data-mute="' . $video_mute . '" data-quality="' . $video_quality . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img class="krautgrid-image-' . $overlay_animation . '" src="' . $modal_image . '" title="" data-no-lazy="1" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="krautgrid-caption ' . $overlay_classes . '" style="' . $overlay_background . ' ' . $overlay_styling . '">' . $overlay_addition . '</div>';
							if (!empty($content_youtube_title)) {
								$output .= '<div class="krautgrid-caption-text" style="background: ' . $overlay_title_back . '; color: ' . $overlay_title_color . ';">' . $content_youtube_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($youtube_tooltipcontent != '') {
					$output .= '</div>';
				}
			}
			if ($content_youtube_trigger == "image") {
				$modal_image = wp_get_attachment_image_src($content_youtube_image, 'large');
				$modal_image = $modal_image[0];
				if ($content_youtube_image_simple == "false") {
					if ($youtube_tooltipcontent != '') {
						$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
							$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' krautgrid-item kraut-lightbox-youtube kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="width: 100%; height: 100%;">';
					} else {
							$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' krautgrid-item kraut-lightbox-youtube kraut-lightbox-single ' . $overlay_visible . ' kraut-lightbox-hover-' . $overlay_animation . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
					}
							$output .= '<a href="' . $content_youtube . '" class="kraut-lightbox-media no-ajaxy" target="_blank" data-thumbnail="' . $modal_image . '" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-infobar="' . $video_infobar . '" data-controls="' . $video_controls . '" data-autohide="' . $video_autohide . '" data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-loop="' . $video_loop . '" data-modest="' . $video_modest . '" data-mute="' . $video_mute . '" data-quality="' . $video_quality . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
								$output .= '<img class="krautgrid-image-' . $overlay_animation . '" src="' . $modal_image . '" title="" data-no-lazy="1" style="display: block; ' . $image_dimensions . '">';
								$output .= '<div class="krautgrid-caption ' . $overlay_classes . '" style="' . $overlay_background . ' ' . $overlay_styling . '">' . $overlay_addition . '</div>';
								if (!empty($content_youtube_title)) {
									$output .= '<div class="krautgrid-caption-text" style="background: ' . $overlay_title_back . '; color: ' . $overlay_title_color . ';">' . $content_youtube_title . '</div>';
								}
							$output .= '</a>';
						$output .= '</div>';
					if ($youtube_tooltipcontent != '') {
						$output .= '</div>';
					}
				} else {
					$output .= '<a href="' . $content_youtube . '" class="' . $modal_id . '-parent nch-holder kraut-lightbox-media no-ajaxy ' . $youtube_tooltipclasses . ' ' . $css_class . '" ' . $youtube_tooltipcontent . ' target="_blank" style="' . $parent_dimensions . '" ' . $playlistdata . ' data-thumbnail="' . $modal_image . '" data-controls="' . $video_controls . '" data-autohide="' . $video_autohide . '" data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-loop="' . $video_loop . '" data-modest="' . $video_modest . '" data-mute="' . $video_mute . '" data-quality="' . $video_quality . '" data-videoplay="' . $lightbox_play . '" data-title="' . $content_youtube_title . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
						$output .= '<img class="" src="' . $modal_image . '" style="display: block; ' . $image_dimensions . '">';
					$output .= '</a>';
				}
			}
			if ($content_youtube_trigger == "icon") {
				$icon_style = 'color: ' . $content_youtube_iconcolor . '; width:' . $content_youtube_iconsize . 'px; height:' . $content_youtube_iconsize . 'px; font-size:' . $content_youtube_iconsize . 'px; line-height:' . $content_youtube_iconsize . 'px;';
				$output .= '<div id="' . $modal_id . '" style="" class="' . $modal_id . '-parent nch-holder ts-vcsc-font-icon ts-font-icons ts-shortcode ts-icon-align-center ' . $el_class . ' ' . $css_class . ' ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a class="ts-font-icons-link kraut-lightbox-media no-ajaxy" href="' . $content_youtube . '" target="_blank" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-infobar="' . $video_infobar . '" data-controls="' . $video_controls . '" data-autohide="' . $video_autohide . '" data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-loop="' . $video_loop . '" data-modest="' . $video_modest . '" data-mute="' . $video_mute . '" data-quality="' . $video_quality . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
						$output .= '<i class="ts-font-icon ' . $content_youtube_icon . '" style="' . $icon_style . '"></i>';
					$output .= '</a>';
				$output .= '</div>';
			}
			if (($content_youtube_trigger == "flat") || ($content_youtube_trigger == "flaticon")) {
				wp_enqueue_style('ts-extend-buttonsdual');
				$button_style				= $content_youtube_buttonstyle . ' ' . $content_youtube_buttonhover;
				$output .= '<a id="' . $modal_id . '" class="ts-dual-buttons-container kraut-lightbox-media no-ajaxy ' . $css_class . ' ' . $el_class . '" href="' . $content_youtube . '" target="_blank" data-title="' . $content_youtube_title . '" data-infobar="' . $video_infobar . '" data-controls="' . $video_controls . '" data-autohide="' . $video_autohide . '" data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-loop="' . $video_loop . '" data-modest="' . $video_modest . '" data-mute="' . $video_mute . '" data-quality="' . $video_quality . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
					$output .= '<div id="' . $modal_id . '-trigger" class="ts-dual-buttons-wrapper clearFixMe ' . $button_style . ' ' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						if (($content_youtube_icon != '') && ($content_youtube_icon != 'transparent') && ($content_youtube_trigger == "flaticon")) {
							$output .= '<i class="ts-dual-buttons-icon ' . $content_youtube_icon . '" style="font-size: ' . $content_youtube_buttonsize . 'px; line-height: ' . $content_youtube_buttonsize . 'px;"></i>';
						}
						$output .= '<span class="ts-dual-buttons-title" style="font-size: ' . $content_youtube_buttonsize . 'px; line-height: ' . $content_youtube_buttonsize . 'px;">' . $content_youtube_buttontext . '</span>';			
					$output .= '</div>';
				$output .= '</a>';
			}
			if ($content_youtube_trigger == "winged") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' ' . $css_class . '" style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<div class="ts-lightbox-button-1 clearFixMe">';
						$output .= '<div class="top">' . $content_youtube_title . '</div>';
						$output .= '<div class="bottom">' . $content_youtube_subtitle . '</div>';
						$output .= '<a href="' . $content_youtube . '" class="kraut-lightbox-media no-ajaxy icon" target="_blank" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-infobar="' . $video_infobar . '" data-controls="' . $video_controls . '" data-autohide="' . $video_autohide . '" data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-loop="' . $video_loop . '" data-modest="' . $video_modest . '" data-mute="' . $video_mute . '" data-quality="' . $video_quality . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '><span class="youtube">' . $content_youtube_buttontext . '</span></a>';
					$output .= '</div>';
				$output .= '</div>';
			}
			if ($content_youtube_trigger == "simple") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' ' . $youtube_tooltipclasses . ' ' . $css_class . '" ' . $youtube_tooltipcontent . ' style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a href="' . $content_youtube . '" class="ts-lightbox-button-2 icon nch-lightbox" target="_blank" data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-infobar="' . $video_infobar . '" data-controls="' . $video_controls . '" data-autohide="' . $video_autohide . '" data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-loop="' . $video_loop . '" data-modest="' . $video_modest . '" data-mute="' . $video_mute . '" data-quality="' . $video_quality . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '><span class="youtube">' . $content_youtube_buttontext . '</span></a>';
				$output .= '</div>';
			}
			if ($content_youtube_trigger == "text") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' ' . $css_class . '" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a href="' . $content_youtube . '" class="kraut-lightbox-media no-ajaxy ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-infobar="' . $video_infobar . '" data-controls="' . $video_controls . '" data-autohide="' . $video_autohide . '" data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-loop="' . $video_loop . '" data-modest="' . $video_modest . '" data-mute="' . $video_mute . '" data-quality="' . $video_quality . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . ' target="_blank">' . $content_youtube_text . '</a>';
				$output .= '</div>';
			}
			if ($content_youtube_trigger == "custom") {
				if ($content_raw != "") {
					$content_raw =  rawurldecode(base64_decode(strip_tags($content_raw)));
					$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' ' . $css_class . '" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						$output .= '<a href="' . $content_youtube . '" class="kraut-lightbox-media no-ajaxy ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' data-title="' . $content_youtube_title . '" ' . $playlistdata . ' data-infobar="' . $video_infobar . '" data-controls="' . $video_controls . '" data-autohide="' . $video_autohide . '" data-start="' . $video_start . '" data-end="' . $video_end . '" data-related="' . $video_related . '" data-loop="' . $video_loop . '" data-modest="' . $video_modest . '" data-mute="' . $video_mute . '" data-quality="' . $video_quality . '" data-videoplay="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="0" data-duration="' . $lightbox_speed . '" ' . $nacho_color . 'style="" target="_blank">';
							$output .= $content_raw;
						$output .= '</a>';
					$output .= '</div>';
				}
			}
		}
		
		// Create Video iFrame Overlay
		if ($content_overlay_use == 'true') {
			$overlay_image					= '';
			if (($content_overlay_source == "internal") && ($content_overlay_image != '')) {
				$overlay_image 				= wp_get_attachment_image_src($content_overlay_image, $content_overlay_quality);
				$overlay_image				= (isset($overlay_image[0]) ? $overlay_image[0] : '');
			} else if ($content_overlay_source == "preview") {
				$overlay_image				= TS_VCSC_VideoImage_Youtube($content_youtube, $content_overlay_level);
			}
			$overlay_data 					= '<div class="ts-video-overlay">';
				$overlay_data				.= '<img class="ts-video-overlay-image" src="' . $overlay_image . '">';
				if ($content_overlay_text != '') {
					$overlay_data			.= '<div class="ts-video-overlay-text" style="color: ' . $content_overlay_font . '; text-align: ' . $content_overlay_align . '">';
						$overlay_data		.= '<span style="color: ' . $content_overlay_font . '; text-align: ' . $content_overlay_align . '">' . rawurldecode(base64_decode(strip_tags($content_overlay_text))) . '</span>';
					$overlay_data			.= '</div>';
				}
			$overlay_data 					.= '</div>';
			$overlay_class					= 'ts-video-overlay-true';
			$overlay_start					= '<div class="ts-video-overlay-wrapper" data-trigger="' . $content_overlay_trigger . '" data-autoplay="' . $lightbox_play . '">';
			$overlay_end					= '</div>';
			$overlay_lazy					= 'data-no-lazy="1"';
			if ($content_overlay_lazy == "true") {
				$overlay_source				= 'src="about:blank" data-lazy-';
			} else {
				$overlay_source				= '';
			}
			if ($content_overlay_handle == 'true') {
				$overlay_handle				= '<div class="ts-video-overlay-handle"><span class="frame_handle_' . $content_overlay_trigger . '" style="background-color: ' . $content_overlay_color . '"><i class="handle_' . $content_overlay_trigger . '"></i></span></div>';
			} else {
				$overlay_handle				= '';
			}
		} else {
			$overlay_data 					= '';
			$overlay_class					= 'ts-video-overlay-false';
			$overlay_start					= '';
			$overlay_end					= '';
			$overlay_handle					= '';
			$overlay_lazy					= '';
			$overlay_source					= '';
		}		
		
		// Single Video in iFrame
		if (($content_type == "video") && ($content_lightbox == "false")) {
			$modal_image = TS_VCSC_VideoID_Youtube($content_youtube);
			if ($video_loop == "true") {
				$video_playlist				= '&playlist=' . $modal_image;
			} else {
				$video_playlist				= '';
			}
			$output .= $overlay_start;	
				$output .= '<div id="' . $modal_id . '" class="ts-video-container ' . $content_ratio . ' ' . $youtube_tooltipclasses . ' ' . $overlay_class . '" ' . $youtube_tooltipcontent . ' style="">';
					$output .= '<iframe class="ts-video-iframe" width="100%" height="auto" ' . $overlay_lazy . ' ' . $overlay_source . 'src="https://www.youtube.com/embed/' . $modal_image . $video_autoplay . $videos_infobar . $videos_controls . $videos_autohide . $videos_start . $videos_end . $videos_related . $videos_loop . $video_playlist . $videos_modest . $videos_mute . $videos_quality . '&wmode=opaque" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>';
					$output .= $overlay_data;
				$output .= '</div>';
				$output	.= $overlay_handle;
			$output .= $overlay_end;			
		}
		// Defined Playlist in iFrame
		if (($content_type == "playlist") && ($content_lightbox == "false")) {
			$output .= $overlay_start;
				$output .= '<div id="' . $modal_id . '" class="ts-video-container ' . $content_ratio . ' ' . $youtube_tooltipclasses . ' ' . $overlay_class . '" ' . $youtube_tooltipcontent . ' style="">';
					$output .= '<iframe class="ts-video-iframe" width="100%" height="auto" ' . $overlay_lazy . ' ' . $overlay_source . 'src="https://www.youtube.com/embed?listType=playlist&list=' . TS_VCSC_PlaylistID_Youtube($content_playlist) . $videos_infobar . $video_autoplay . $videos_controls . $videos_autohide . $videos_related . $videos_loop . $videos_modest . $videos_mute . $videos_quality . '&wmode=opaque" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>';
					$output .= $overlay_data;
				$output .= '</div>';
			$output .= $overlay_end;
		}
		// Search Playlist in iFrame
		if (($content_type == "searchterm") && ($content_lightbox == "false")) {
			$output .= $overlay_start;
				$output .= '<div id="' . $modal_id . '" class="ts-video-container ' . $content_ratio . ' ' . $youtube_tooltipclasses . ' ' . $overlay_class . '" ' . $youtube_tooltipcontent . ' style="">';
					$output .= '<iframe class="ts-video-iframe" width="100%" height="auto" ' . $overlay_lazy . ' ' . $overlay_source . 'src="https://www.youtube.com/embed?listType=search&list=' . str_replace(' ', '', $content_search) . $videos_infobar . $video_autoplay . $videos_controls . $videos_autohide . $videos_related . $videos_loop . $videos_modest . $videos_mute . $videos_quality . '&wmode=opaque" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>';
					$output .= $overlay_data;
				$output .= '</div>';
			$output .= $overlay_end;
		}
		// Individual Videos Playlist in iFrame
		if (($content_type == "combination") && ($content_lightbox == "false")) {
			$output .= $overlay_start;
				$videos 	= explode(",", str_replace(' ', '', $content_combination));
				$count 		= count($videos);
				if ($count == 1) {
					$iframe = '<iframe class="ts-video-iframe" width="100%" height="auto" ' . $overlay_lazy . ' ' . $overlay_source . 'src="https://www.youtube.com/embed/' . $content_combination . $video_autoplay . $videos_controls . $videos_autohide . $videos_related . $videos_mute . $videos_quality . '&wmode=opaque" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>';
				} else if ($count > 1){
					$first = $videos[0];
					array_shift($videos);
					$other = implode(",", $videos);
					$iframe = '<iframe class="ts-video-iframe" width="100%" height="auto" ' . $overlay_lazy . ' ' . $overlay_source . 'src="https://www.youtube.com/embed/' . $first . '?playlist=' . $other . $videos_infobar . $video_autoplay . $videos_controls . $videos_autohide . $videos_related . $videos_loop . $videos_modest . $videos_mute . $videos_quality . '&wmode=opaque" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>';
				}
				$output .= '<div id="' . $modal_id . '" class="ts-video-container ' . $content_ratio . ' ' . $youtube_tooltipclasses . ' ' . $overlay_class . '" ' . $youtube_tooltipcontent . ' style="">';
					$output .= $iframe;
					$output .= $overlay_data;
				$output .= '</div>';
			$output .= $overlay_end;
		}
		// Playlist from User Uploads in iFrame
		if (($content_type == "uploads") && ($content_lightbox == "false")) {
			$output .= $overlay_start;
				$output .= '<div id="' . $modal_id . '" class="ts-video-container ' . $content_ratio . ' ' . $youtube_tooltipclasses . ' ' . $overlay_class . '" ' . $youtube_tooltipcontent . ' style="">';
					$output .= '<iframe class="ts-video-iframe" width="100%" height="auto" ' . $overlay_lazy . ' ' . $overlay_source . 'src="https://www.youtube.com/embed?listType=user_uploads&list=' . $content_uploads . $videos_infobar . $video_autoplay . $videos_controls . $videos_autohide . $videos_related . $videos_loop . $videos_modest . $videos_mute . $videos_quality . '&wmode=opaque" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>';
					$output .= $overlay_data;
				$output .= '</div>';
			$output .= $overlay_end;
		}

		echo $output;
	
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>