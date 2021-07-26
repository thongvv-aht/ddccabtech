<?php
	add_shortcode('TS-VCSC-Social-Icons', 'TS_VCSC_Icons_Social_Function');
	function TS_VCSC_Icons_Social_Function ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();

		wp_enqueue_style('ts-font-teammates');
		wp_enqueue_style('ts-extend-tooltipster');
		wp_enqueue_script('ts-extend-tooltipster');	
		wp_enqueue_style('ts-extend-animations');
		wp_enqueue_style('ts-visual-composer-extend-front');
		wp_enqueue_script('ts-visual-composer-extend-front');

		extract( shortcode_atts( array(
			'icon_style' 				=> 'simple',
			'icon_background'			=> '#f5f5f5',
			'icon_frame_color'			=> '#f5f5f5',
			'icon_size'					=> 20,
			'icon_frame_thick'			=> 1,
			'icon_margin' 				=> 5,
			'icon_padding'				=> 10,
			'icon_align'				=> 'left',
			'icon_hover'				=> '',
			'tooltip_show'				=> 'false',
			'tooltip_text'				=> 'Click here to view our profile on ',
			'tooltip_css'				=> 'false',
			'tooltip_style'				=> 'ts-simptip-style-black',
			'tooltip_position'			=> 'ts-simptip-position-top',
			'tooltip_animation'			=> 'swing',
			'tooltipster_offsetx'		=> 0,
			'tooltipster_offsety'		=> 0,
			'email'						=> '',
			'phone'						=> '',
			'cell'						=> '',
			'portfolio'					=> '',
			'link'						=> '',
			'behance'					=> '',
			'digg'						=> '',
			'dribbble'					=> '',
			'dropbox'					=> '',
			'envato'					=> '',
			'evernote'					=> '',
			'facebook'					=> '',
			'flickr'					=> '',
			'github'					=> '',
			'gplus'						=> '',
			'instagram'					=> '',
			'lastfm'					=> '',
			'linkedin'					=> '',
			'paypal'					=> '',
			'picasa'					=> '',
			'pinterest'					=> '',
			'rss'						=> '',
			'skype'						=> '',
			'soundcloud'				=> '',
			'spotify'					=> '',
			'stumbleupon'				=> '',
			'twitter'					=> '',
			'tumblr'					=> '',
			'vimeo'						=> '',
			'vkontakte'					=> '',
			'wikipedia'					=> '',
			'xing'						=> '',
			'youtube'					=> '',
			'el_id'						=> '',
			'el_class' 					=> '',
			'css'						=> '',
		), $atts ) );
		
		if (!empty($el_id)) {
			$social_icon_id				= $el_id;
		} else {
			$social_icon_id				= 'ts-vcsc-social-icons-' . mt_rand(999999, 9999999);
		}
	
		if ((empty($icon_background)) || ($icon_style == 'simple')) {
			$icon_frame_style			= 'padding: 0px;';
		} else {
			$icon_frame_style			= 'padding: 0px; background: ' . $icon_background . ';';
		}
		
		if ($icon_style == 'simple') {
			$icon_frame_border			= '';
		} else {
			$icon_frame_border			= ' border: ' . $icon_frame_thick . 'px solid ' . $icon_frame_color . ';';
		}
		
		if ($icon_align == "left") {
			$icon_margin_adjust 		= "margin-left: -" . $icon_margin . "px;";
			$icon_horizontal_adjust		= "";
		} else if ($icon_align == "right") {
			$icon_margin_adjust 		= "margin-right: -" . $icon_margin . "px;";
			$icon_horizontal_adjust		= "";
		} else {
			$icon_margin_adjust 		= "";
			$icon_horizontal_adjust		= "";
		}
		
		$icon_size_adjust 				= "font-size: " . $icon_size . "px; line-height: " . ($icon_size + $icon_padding) . "px; height: " . $icon_size . "px; width: " . $icon_size . "px;";
		$link_size_adjust 				= "height: " . ($icon_size + $icon_padding) . "px; width: " . ($icon_size + $icon_padding) . "px; line-height: " . ($icon_size + $icon_padding) . "px;";
		
		// Tooltip
		$tooltip_position				= TS_VCSC_TooltipMigratePosition($tooltip_position);
		$tooltip_style					= TS_VCSC_TooltipMigrateStyle($tooltip_style);
		$tooltip_class					= 'ts-has-tooltipster-tooltip';	
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class 					= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Social-Icons', $atts);
		} else {
			$css_class					= '';
		}
		
		$output = '';
		$output .= '<div class="ts-social-icon-links ' . $el_class . ' ' . $css_class . ' clearFixMe" style="' . $icon_margin_adjust . '">';
			$output .= '<div id="social-networks-' . $social_icon_id . '" class="ts-social-network-shortcode ts-shortcode social-align-' . $icon_align . '">';
				$output .= '<ul class="ts-social-icons ' . $icon_style . '">';
					$social_array 						= array();
					$social_count 						= 0;
					$social_defaults 					= get_option('ts_vcsc_extend_settings_socialDefaults', '');
					if (($social_defaults == false) || (empty($social_defaults)) || ($social_defaults == "") || (!is_array($social_defaults))) {
						$social_defaults				= array();
					}
					foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Social_Networks_Array as $Social_Network => $social) {
						if (($social['class'] == "ts-social-email") || ($social['class'] == "ts-social-phone") || ($social['class'] == "ts-social-cell") || ($social['class'] == "ts-social-skype")) {
							$social_lines = array(
								'network' 				=> $Social_Network,
								'class'					=> $social['class'],
								'icon'					=> $social['icon'],
								'link'					=> (${$social['string']} == ' ' ? '' : ${$social['string']}),
								'order'					=> (isset($social_defaults[$Social_Network]['order']) ? $social_defaults[$Social_Network]['order'] : $social['order']),
								'title'					=> '' . ${$social['string']} . ''
							);
						} else if (($social['class'] == "ts-social-portfolio") || ($social['class'] == "ts-social-link")) {
							$social_lines = array(
								'network' 				=> $Social_Network,
								'class'					=> $social['class'],
								'icon'					=> $social['icon'],
								'link'					=> (${$social['string']} == ' ' ? '' : ${$social['string']}),
								'order'					=> (isset($social_defaults[$Social_Network]['order']) ? $social_defaults[$Social_Network]['order'] : $social['order']),
								'title'					=> '' . ucfirst($Social_Network) . ''
							);
						} else {
							$social_lines = array(
								'network' 				=> $Social_Network,
								'class'					=> $social['class'],
								'icon'					=> $social['icon'],
								'link'					=> (${$social['string']} == ' ' ? '' : ${$social['string']}),
								'order'					=> (isset($social_defaults[$Social_Network]['order']) ? $social_defaults[$Social_Network]['order'] : $social['order']),
								'title'					=> '' . $tooltip_text . ucfirst($Social_Network) . ''
							);
						}
						$social_array[] 				= $social_lines;
						$social_count 					= $social_count + 1;
					}
					TS_VCSC_SortMultiArray($social_array, 'order');
					if ($icon_align == "right") {
						$social_array = array_reverse($social_array);
					}
					foreach ($social_array as $index => $array) {
						$Social_Network 				= $social_array[$index]['network'];
						$Social_Class					= $social_array[$index]['class'];
						$Social_Icon					= $social_array[$index]['icon'];
						$Social_Order					= $social_array[$index]['order'];
						$Social_Link					= $social_array[$index]['link'];
						if (($Social_Class == "ts-social-phone") || ($Social_Class == "ts-social-cell")) {
							if ($tooltip_css == "false") {
								$Social_Title			= 'title="' . $social_array[$index]['title'] . '"';
								$Tooltip_Class			= '';
							} else {
								$Social_Title			= 'data-tooltipster-html="false" data-tooltipster-title="" data-tooltipster-text="' . $social_array[$index]['title'] . '" data-tooltipster-image="" data-tooltipster-position="' . $tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $tooltip_style . '" data-tooltipster-animation="' . $tooltip_animation . '" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
								$Tooltip_Class			= $tooltip_class;
							}
						} else {						
							if ($tooltip_show == 'true') {
								if ($tooltip_css == "false") {
									$Social_Title		= 'title="' . $social_array[$index]['title'] . '"';
									$Tooltip_Class		= '';
								} else {
									$Social_Title		= 'data-tooltipster-html="false" data-tooltipster-title="" data-tooltipster-text="' . $social_array[$index]['title'] . '" data-tooltipster-image="" data-tooltipster-position="' . $tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $tooltip_style . '" data-tooltipster-animation="' . $tooltip_animation . '" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
									$Tooltip_Class		= $tooltip_class;
								}
							} else {
								$Social_Title			= '';
								$Tooltip_Class			= '';
							}
						}
						if (!empty($Social_Link)) {
							if ($Social_Class == "ts-social-email") {
								$output .= '<li class="ts-social-icon ' . $icon_hover . ' ' . $icon_align . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . ' ' . $link_size_adjust . '"><a style="" target="_blank" class="' . $Social_Class . ' ' . $Tooltip_Class . '" style="" href="mailto:' . $Social_Link . '" ' . $Social_Title . ' rel="nofollow"><i class="' . $Social_Icon . '" style="' . $icon_horizontal_adjust . ' ' . $icon_size_adjust . '"></i></a></li>';
							} else if ($Social_Class == "ts-social-phone") {
								$output .= '<li class="ts-social-icon ' . $icon_hover . ' ' . $icon_align . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . ' ' . $link_size_adjust . '"><a style="" target="_blank" class="' . $Social_Class . ' ' . $Tooltip_Class . '" style="" href="tel:' . $Social_Link . '" ' . $Social_Title . ' rel="nofollow"><i class="' . $Social_Icon . '" style="' . $icon_horizontal_adjust . ' ' . $icon_size_adjust . '"></i></a></li>';
							} else if ($Social_Class == "ts-social-cell") {
								$output .= '<li class="ts-social-icon ' . $icon_hover . ' ' . $icon_align . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . ' ' . $link_size_adjust . '"><a style="" target="_blank" class="' . $Social_Class . ' ' . $Tooltip_Class . '" style="" href="tel:' . $Social_Link . '" ' . $Social_Title . ' rel="nofollow"><i class="' . $Social_Icon . '" style="' . $icon_horizontal_adjust . ' ' . $icon_size_adjust . '"></i></a></li>';
							} else if ($Social_Class == "ts-social-skype") {
								$output .= '<li class="ts-social-icon ' . $icon_hover . ' ' . $icon_align . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . ' ' . $link_size_adjust . '"><a style="" target="_blank" class="' . $Social_Class . ' ' . $Tooltip_Class . '" style="" href="skype:' . $Social_Link . '?call" ' . $Social_Title . ' rel="nofollow"><i class="' . $Social_Icon . '" style="' . $icon_horizontal_adjust . ' ' . $icon_size_adjust . '"></i></a></li>';
							} else {
								$output .= '<li class="ts-social-icon ' . $icon_hover . ' ' . $icon_align . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . ' ' . $link_size_adjust . '"><a style="" target="_blank" class="' . $Social_Class . ' ' . $Tooltip_Class . '" style="" href="' . TS_VCSC_makeValidURL($Social_Link) . '" ' . $Social_Title . ' rel="nofollow"><i class="' . $Social_Icon . '" style="' . $icon_horizontal_adjust . ' ' . $icon_size_adjust . '"></i></a></li>';
							}
						}
					}			
				$output .= '</ul>';
			$output .= '</div>';
		$output .= '</div>';
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>