<?php
	add_shortcode('TS-VCSC-Icon-Counter', 'TS_VCSC_Icon_Counter_Function');
	function TS_VCSC_Icon_Counter_Function ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();

		wp_enqueue_script('ts-extend-countup');
		wp_enqueue_style('ts-extend-animations');
		wp_enqueue_style('ts-visual-composer-extend-front');
		wp_enqueue_script('ts-visual-composer-extend-front');
		
		extract( shortcode_atts( array(
			'icon'                      	=> '',
			'icon_position'             	=> 'top',
			'icon_size_slide'           	=> 75,
			'icon_margin'					=> 10,
			'icon_color'                	=> '#000000',
			'icon_background'		    	=> '',
			'icon_frame_type' 				=> '',
			'icon_frame_thick'				=> 1,
			'icon_frame_radius'				=> '',
			'icon_frame_color'				=> '#000000',
			'icon_replace'					=> 'false',
			'icon_image'					=> '',
			'padding'						=> 'false',
			'icon_padding'					=> 5,
			
			'link_counter'					=> '',
			'link_data'						=> '',
			'link_buttonstyle'				=> 'ts-dual-buttons-color-sun-flower',
			'link_buttonhover'				=> 'ts-dual-buttons-preview-default ts-dual-buttons-hover-default',
			'link_buttontext' 				=> 'Learn More',
			'link_buttonsize' 				=> 16,
			
			'counter_value_start'			=> 0,			
			'counter_value_by_shortcode'	=> 'false',			
			'counter_value_end'				=> '',
			'counter_value_end_shortcode'	=> '',			
			'counter_value_size'			=> 30,
			'counter_value_color'			=> '#000000',
			'counter_value_format'			=> 'false',
			'counter_value_plus'			=> 'false',
			'counter_value_seperator'		=> '',

			'counter_value_before'			=> '',
			'counter_value_after'			=> '',
			
			'counter_seperator'				=> 'false',
			'counter_note'					=> '',
			'counter_note_size'				=> 15,
			'counter_note_color'			=> '#000000',
			'counter_speed'					=> 2000,
			'counter_viewport'				=> 'true',
			'counter_offset'				=> 'full', // full, top, bottom
			'counter_delay'					=> 0,
			'counter_repeat'				=> 'false',
			
			'tooltip_html'					=> 'false',
			'tooltip_content'				=> '',
			'tooltip_encoded'				=> '',
			'tooltip_position'				=> 'ts-simptip-position-top',
			'tooltip_style'					=> 'ts-simptip-style-black',
			'tooltipster_offsetx'			=> 0,
			'tooltipster_offsety'			=> 0,
			
			'animation_icon'				=> '',
			'margin_top'                	=> 0,
			'margin_bottom'             	=> 0,
			'el_id' 						=> '',
			'el_class'                  	=> '',
			'css'							=> '',
		), $atts ));
		
		$randomizer							= mt_rand(999999, 9999999);
	
		if (!empty($el_id)) {
			$icon_counter_id				= $el_id;
		} else {
			$icon_counter_id				= 'ts-vcsc-icon-counter-' . $randomizer;
		}
		
		if (!empty($icon_image)) {
			$icon_image_path 				= wp_get_attachment_image_src($icon_image, 'large');
		}
		
		if ($animation_icon != '') {
			$icon_counter_animation			= "ts-viewport-css-" . $animation_icon;
			$icon_hover_animation			= "ts-hover-css-" . $animation_icon;
		} else {
			$icon_counter_animation			= "";
			$icon_hover_animation			= "";
		}
	
		if ($padding == "true") {
			$icon_frame_padding				= 'padding: ' . $icon_padding . 'px; ';
		} else {
			$icon_frame_padding				= '';
		}	
		
		$icon_style                     	= '' . $icon_frame_padding . 'color: ' . $icon_color . '; background-color:' . $icon_background . '; width:' . $icon_size_slide . 'px; height:' . $icon_size_slide . 'px; font-size:' . $icon_size_slide . 'px; line-height:' . $icon_size_slide . 'px;';
		$icon_image_style					= '' . $icon_frame_padding . 'background-color:' . $icon_background . '; width: ' . $icon_size_slide . 'px; height: ' . $icon_size_slide . 'px; ';
	
		if ($icon_frame_type != '') {
			$icon_frame_class 	        	= 'frame-enabled';
			$icon_frame_style 	        	= 'border: ' . $icon_frame_thick . 'px ' . $icon_frame_type . ' ' . $icon_frame_color . ';';
		} else {
			$icon_frame_class				= '';
			$icon_frame_style				= '';
		}
		
		if ($counter_seperator == "true") {
			$icon_seperator					= ' seperator';
		} else {
			$icon_seperator					= '';
		}
		
		// Counter Link
		if ($link_counter != '') {
			$link 							= TS_VCSC_Advancedlinks_GetLinkData($link_data);
			$a_href							= $link['url'];
			$a_title 						= $link['title'];
			$a_target 						= $link['target'];
			$link_start						= '<a href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '" style="border: none; text-decoration: none;">';
			$link_end						= '</a>';
			$link_button					= '';			
			if ($link_counter == "flat") {
				wp_enqueue_style('ts-extend-buttonsdual');
				$button_style				= $link_buttonstyle . ' ' . $link_buttonhover;
				$link_button .= '<a class="ts-dual-buttons-container" href="' . $a_href . '" target="' . $a_target . '" data-title="' . $a_title . '">';
					$link_button .= '<div class="ts-dual-buttons-wrapper clearFixMe ' . $button_style . '" style="width: 100%; margin-top: 20px; margin-bottom: 20px;">';
						$link_button .= '<span class="ts-dual-buttons-title" style="font-size: ' . $link_buttonsize . 'px; line-height: ' . $link_buttonsize . 'px;">' . $link_buttontext . '</span>';			
					$link_button .= '</div>';
				$link_button .= '</a>';
			}
		} else {
			$link_start						= '';
			$link_end						= '';
			$link_button					= '';
		}
		
		// Number Formatting
		if ($counter_value_format == "true") {
			$format_value_plus				= $counter_value_plus;
			$format_value_seperator			= $counter_value_seperator;
		} else {
			$format_value_plus				= '';
			$format_value_seperator			= '';
		}
		
		// End Value as Shortcode
		if ($counter_value_by_shortcode == "true") {
			$counter_value_end				= rawurldecode(base64_decode(strip_tags($counter_value_end_shortcode)));
			$counter_value_end				= do_shortcode($counter_value_end);
			$counter_value_end				= (int)$counter_value_end;
		}
		
		// Tooltip
		$tooltip_position					= TS_VCSC_TooltipMigratePosition($tooltip_position);
		$tooltip_style						= TS_VCSC_TooltipMigrateStyle($tooltip_style);
		$icon_tooltipclasses				= 'ts-has-tooltipster-tooltip';		
		if ($tooltip_html == "false") {
			if (strlen($tooltip_content) != 0) {
				wp_enqueue_style('ts-extend-tooltipster');
				wp_enqueue_script('ts-extend-tooltipster');	
				$icon_tooltipclasses		= " ts-has-tooltipster-tooltip";
				$icon_tooltipcontent 		= 'data-tooltipster-html="false" data-tooltipster-title="" data-tooltipster-text="' . strip_tags($tooltip_content) . '" data-tooltipster-image="" data-tooltipster-position="' . $tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $tooltip_style . '" data-tooltipster-animation="swing" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
			} else {
				$icon_tooltipclasses		= "";
				$icon_tooltipcontent		= "";
			}
		} else {
			if (strlen($tooltip_encoded) != 0) {
				wp_enqueue_style('ts-extend-tooltipster');
				wp_enqueue_script('ts-extend-tooltipster');	
				$icon_tooltipclasses		= " ts-has-tooltipster-tooltip";
				$icon_tooltipcontent 		= 'data-tooltipster-html="true" data-tooltipster-title="" data-tooltipster-text="' . strip_tags($tooltip_encoded) . '" data-tooltipster-image="" data-tooltipster-position="' . $tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $tooltip_style . '" data-tooltipster-animation="swing" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
			} else {
				$icon_tooltipclasses		= "";
				$icon_tooltipcontent		= "";
			}
		}		
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Icon-Counter', $atts);
		} else {
			$css_class						= '';
		}
		
		$output 							= '';
		
		if ($icon_position == 'top') {
			$output .= '<div id="' . $icon_counter_id . '" class="ts-icon-counter ' . $el_class . ' ts-counter-top ' . $icon_seperator . '' . $icon_tooltipclasses . ' ' . $css_class . '" ' . $icon_tooltipcontent . ' style="margin-bottom: ' . $margin_bottom . 'px; margin-top: ' . $margin_top . 'px;">';
				if (($link_counter == 'element') && ($link_data != '')) {
					$output .= $link_start;
				}
					$output .= '<table class="ts-counter-icon-holder" border="0" style="border: none !important; border-color: transparent !important;">';
						$output .= '<tr>';
							$output .= '<td style="text-align: center;">';
								$output .= '<div class="ts-counter-icon-top">';
									if (($link_counter == 'icon') && ($link_data != '')) {
										$output .= $link_start;
									}
										if ($icon_replace == "false") {
											$output .= '<div class="ts-counter-icon">';
												$output .= '<i class="ts-font-icon ' . $icon . ' ' . $icon_frame_radius . ' ' . $icon_hover_animation . '" style="' . $icon_style . ' ' . $icon_frame_style . '"></i>';
											$output .= '</div>';
										} else {
											$output .= '<div class="ts-counter-image" style="' . $icon_image_style . ';">';
												$output .= '<img class="ts-font-icon ' . $icon_frame_radius . ' ' . $icon_hover_animation . '" src="' . $icon_image_path[0] .'">';
											$output .= '</div>';
										}
									if (($link_counter == 'icon') && ($link_data != '')) {
										$output .= $link_end;
									}
								$output .= '</div>';
							$output .= '</td>';
						$output .= '</tr>';
						$output .= '<tr>';
							$output .= '<td style="text-align: center;">';
								if (($link_counter == 'content') && ($link_data != '')) {
									$output .= $link_start;
								}
									$output .= '<div class="ts-counter-content">';
										$output .= '<div id="ts-counter-value-' . $randomizer . '" class="ts-counter-value" style="font-size: ' . $counter_value_size . 'px; color: ' . $counter_value_color . ';" data-viewport="' . $counter_viewport . '" data-offset="' . $counter_offset . '" data-delay="' . $counter_delay . '" data-repeat="' . $counter_repeat . '" data-before="' . $counter_value_before . '" data-after="' . $counter_value_after . '" data-format="' . $counter_value_format . '" data-seperator="' . $format_value_seperator . '" data-plus="' . $format_value_plus . '" data-animation="' . $icon_counter_animation . '" data-start="' . $counter_value_start . '" data-end="' . $counter_value_end . '" data-speed="' . $counter_speed . '">' . $counter_value_before . '' . $counter_value_start . '' . $counter_value_after . '</div>';
										$output .= '<div class="ts-counter-note" style="font-size: ' . $counter_note_size . 'px; color: ' . $counter_note_color . ';">' . $counter_note . '</div>';
									$output .= '</div>';
								if (($link_counter == 'content') && ($link_data != '')) {
									$output .= $link_end;
								}
							$output .= '</td>';
						$output .= '</tr>';
					$output .= '</table>';
					if ($link_counter == "flat") {
						$output .= $link_button;
					}
				if (($link_counter == 'element') && ($link_data != '')) {
					$output .= $link_end;
				}
			$output .= '</div>';
		} else if ($icon_position == 'left') {
			$output .= '<div id="' . $icon_counter_id . '" class="ts-icon-counter ' . $el_class . ' ts-counter-left ' . $icon_seperator . '' . $icon_tooltipclasses . ' ' . $css_class . '" ' . $icon_tooltipcontent . ' style="margiin-bottom: ' . $margin_bottom . 'px; margin-top: ' . $margin_top . 'px;">';
				if (($link_counter == 'element') && ($link_data != '')) {
					$output .= $link_start;
				}
					$output .= '<table class="ts-counter-icon-holder" border="0" style="border: none !important; border-color: transparent !important;">';
						$output .= '<tr>';
							$output .= '<td style="padding-right: 15px; text-align: left;">';
								$output .= '<div class="ts-counter-icon-left">';
									if (($link_counter == 'icon') && ($link_data != '')) {
										$output .= $link_start;
									}
										if ($icon_replace == "false") {
											$output .= '<div class="ts-counter-icon">';
												$output .= '<i class="ts-font-icon ' . $icon . ' ' . $icon_frame_radius . ' ' . $icon_hover_animation . '" style="' . $icon_style . ' ' . $icon_frame_style . '"></i>';
											$output .= '</div>';
										} else {
											$output .= '<div class="ts-counter-image" style="' . $icon_image_style . ';">';
												$output .= '<img class="ts-font-icon ' . $icon_frame_radius . ' ' . $icon_hover_animation . '" src="' . $icon_image_path[0] .'">';
											$output .= '</div>';
										}
									if (($link_counter == 'icon') && ($link_data != '')) {
										$output .= $link_end;
									}
								$output .= '</div>';
							$output .= '</td>';
							$output .= '<td>';
								if (($link_counter == 'content') && ($link_data != '')) {
									$output .= $link_start;
								}
									$output .= '<div class="ts-counter-content">';
										$output .= '<div id="ts-counter-value-' . $randomizer . '" class="ts-counter-value" style="font-size: ' . $counter_value_size . 'px; color: ' . $counter_value_color . ';" data-viewport="' . $counter_viewport . '" data-offset="' . $counter_offset . '" data-delay="' . $counter_delay . '" data-repeat="' . $counter_repeat . '" data-before="' . $counter_value_before . '" data-after="' . $counter_value_after . '" data-format="' . $counter_value_format . '" data-seperator="' . $format_value_seperator . '" data-plus="' . $format_value_plus . '" data-animation="' . $icon_counter_animation . '" data-start="' . $counter_value_start . '" data-end="' . $counter_value_end . '" data-speed="' . $counter_speed . '">' . $counter_value_before . '' . $counter_value_start . '' . $counter_value_after . '</div>';
										$output .= '<div class="ts-counter-note" style="font-size: ' . $counter_note_size . 'px; color: ' . $counter_note_color . ';">' . $counter_note . '</div>';
									$output .= '</div>';
								if (($link_counter == 'content') && ($link_data != '')) {
									$output .= $link_end;
								}
							$output .= '</td>';
						$output .= '</tr>';
					$output .= '</table>';
					if ($link_counter == "flat") {
						$output .= $link_button;
					}
				if (($link_counter == 'element') && ($link_data != '')) {
					$output .= $link_end;
				}
			$output .= '</div>';
		} else {
			$output .= '<div id="' . $icon_counter_id . '" class="ts-icon-counter ' . $el_class . ' ts-counter-right ' . $icon_seperator . '' . $icon_tooltipclasses . ' ' . $css_class . '" ' . $icon_tooltipcontent . ' style="margiin-bottom: ' . $margin_bottom . 'px; margin-top: ' . $margin_top . 'px;">';
				if (($link_counter == 'element') && ($link_data != '')) {
					$output .= $link_start;
				}
					$output .= '<table class="ts-counter-icon-holder" border="0" style="border: none !important; border-color: transparent !important;">';
						$output .= '<tr>';
							$output .= '<td style="padding-right: 15px; text-align: right;">';
								if (($link_counter == 'content') && ($link_data != '')) {
									$output .= $link_start;
								}
									$output .= '<div class="ts-counter-content">';
										$output .= '<div id="ts-counter-value-' . $randomizer . '" class="ts-counter-value" style="font-size: ' . $counter_value_size . 'px; color: ' . $counter_value_color . ';" data-viewport="' . $counter_viewport . '" data-offset="' . $counter_offset . '" data-delay="' . $counter_delay . '" data-repeat="' . $counter_repeat . '" data-before="' . $counter_value_before . '" data-after="' . $counter_value_after . '" data-format="' . $counter_value_format . '" data-seperator="' . $format_value_seperator . '" data-plus="' . $format_value_plus . '" data-animation="' . $icon_counter_animation . '" data-start="' . $counter_value_start . '" data-end="' . $counter_value_end . '" data-speed="' . $counter_speed . '">' . $counter_value_before . '' . $counter_value_start . '' . $counter_value_after . '</div>';
										$output .= '<div class="ts-counter-note" style="font-size: ' . $counter_note_size . 'px; color: ' . $counter_note_color . ';">' . $counter_note . '</div>';
									$output .= '</div>';
								if (($link_counter == 'content') && ($link_data != '')) {
									$output .= $link_end;
								}
							$output .= '</td>';
							$output .= '<td>';
								$output .= '<div class="ts-counter-icon-right">';
									if (($link_counter == 'icon') && ($link_data != '')) {
										$output .= $link_start;
									}
										if ($icon_replace == "false") {
											$output .= '<div class="ts-counter-icon">';
												$output .= '<i class="ts-font-icon ' . $icon . ' ' . $icon_frame_radius . ' ' . $icon_hover_animation . '" style="' . $icon_style . ' ' . $icon_frame_style . '"></i>';
											$output .= '</div>';
										} else {
											$output .= '<div class="ts-counter-image" style="' . $icon_image_style . '">';
												$output .= '<img class="ts-font-icon ' . $icon_frame_radius . ' ' . $icon_hover_animation . '" src="' . $icon_image_path[0] .'">';
											$output .= '</div>';
										}
									if (($link_counter == 'icon') && ($link_data != '')) {
										$output .= $link_end;
									}
								$output .= '</div>';
							$output .= '</td>';
						$output .= '</tr>';
					$output .= '</table>';
					if ($link_counter == "flat") {
						$output .= $link_button;
					}
				if (($link_counter == 'element') && ($link_data != '')) {
					$output .= $link_end;
				}
			$output .= '</div>';
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>