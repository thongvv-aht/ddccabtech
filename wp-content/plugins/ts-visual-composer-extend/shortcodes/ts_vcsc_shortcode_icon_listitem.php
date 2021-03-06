<?php
	add_shortcode('TS-VCSC-Icon-List', 'TS_VCSC_Icon_List_Function');
	function TS_VCSC_Icon_List_Function ($atts, $content = '') {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();

		extract( shortcode_atts( array(
			'icon'						=> '',
			'color'						=> '#7dbd21',
			'font_color'				=> '#000000',
			'text_align'				=> 'left',
			'position'					=> 'left',
			'margin_right'				=> 10,
			'font_size'					=> 12,
			'icon_size'					=> 12,
			'link'						=> '',
			'link_target'				=> '_parent',
			'tooltip_css'				=> 'false',
			'tooltip_content'			=> '',
			'tooltip_position'			=> 'ts-simptip-position-top',
			'tooltip_style'				=> 'ts-simptip-style-black',
			'tooltip_animation'			=> 'swing',
			'tooltipster_offsetx'		=> 0,
			'tooltipster_offsety'		=> 0,
			'animation_effect'			=> 'hover',
			'animation_class'			=> '',
			'animation_view' 			=> '',
			'animation_delay'			=> 0,
			'content_wpautop'			=> 'true',
			'margin_top'                => 0,
			'margin_bottom'             => 10,
			'el_id' 					=> '',
			'el_class'                  => '',
			'css'						=> '',
		), $atts ) );
		
		$wpautop 						= ($content_wpautop == "true" ? true : false);
		
		if (($tooltip_content != '') && ($tooltip_css == 'true')) {
			wp_enqueue_style('ts-extend-tooltipster');
			wp_enqueue_script('ts-extend-tooltipster');
		}
		wp_enqueue_style('ts-extend-animations');
		wp_enqueue_style('ts-visual-composer-extend-front');
		wp_enqueue_script('ts-visual-composer-extend-front');
		
		// Main Styles
		$add_style 						= array();		
		$add_style[] 					= 'margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; text-align:' . $text_align . ';';
		if ($font_size) {
			$add_style[] 				= 'font-size:' . $font_size . 'px;';
			$add_style[] 				= 'line-height:' . $font_size . 'px;';
		}		
		if ($font_color) {
			$add_style[] 				= 'color: ' . $font_color . ';';
		}		
		$add_style 						= implode('', $add_style);	
		if ($add_style) {
			$add_style 					= wp_kses( $add_style, array() );
			$add_style 					= ' style="' . esc_attr($add_style) . '"';
		}
		
		// CSS Animations
		if ($animation_view !== '') {
			$css_animation_classes 		= TS_VCSC_GetCSSAnimation($animation_view, "true");
		} else {
			$css_animation_classes 		= '';
		}
		if (!empty($animation_class)) {
			if ($animation_effect == "infinite") {
				$animation_icon			= 'ts-infinite-css-' . $animation_class;
				$animation_hover		= '';
			} else {
				$animation_icon			= '';
				$animation_hover		= 'ts-infinite-css-' . $animation_class;
			}
		} else {
			$animation_icon				= '';
			$animation_hover			= '';
		}
		
		// Tooltip
		if ($tooltip_css == "true") {
			if (strlen($tooltip_content) != 0) {
				$icon_tooltipposition	= TS_VCSC_TooltipMigratePosition($tooltip_position);
				$icon_tooltipstyle		= TS_VCSC_TooltipMigrateStyle($tooltip_style);
				$icon_tooltipclasses	= 'ts-has-tooltipster-tooltip';		
				$icon_tooltipcontent	= 'data-tooltipster-html="false" data-tooltipster-title="" data-tooltipster-text="' . strip_tags($tooltip_content) . '" data-tooltipster-image="" data-tooltipster-position="' . $icon_tooltipposition . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $icon_tooltipstyle . '" data-tooltipster-animation="' . $tooltip_animation . '" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
			} else {
				$icon_tooltipclasses	= "";
				$icon_tooltipcontent	= "";
			}
		} else {
			$icon_tooltipclasses		= "";
			if (strlen($tooltip_content) != 0) {
				$icon_tooltipcontent	= ' title="' . $tooltip_content . '"';
			} else {
				$icon_tooltipcontent	= "";
			}
		}		
		
		if ($position == "left") {
			$span_padding 				= 'padding-left: ' . intval($margin_right) . 'px;';
		} else {
			$span_padding 				= 'padding-right: ' . intval($margin_right) . 'px;';
		}
		
		$icon_style = 'color: ' . $color . '; width: ' . $icon_size . 'px; height: ' . $icon_size . 'px; font-size: ' . $icon_size . 'px; line-height: ' . $icon_size . 'px;';
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class 					= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Icon-List', $atts);
		} else {
			$css_class					= '';
		}

		$output ='<div class="ts-list-item ' . ($animation_view != '' ? 'ts-list-item-viewport' : '') . ' ' . $el_class . ' ' . $css_class . '" ' . $add_style . ' data-viewport="' . $css_animation_classes . '" data-delay="' . $animation_delay . '" data-animation="' . $animation_hover . '" data-opacity="1">';
			if ($link) {
				$output .= '<a href="' . esc_url($link) . '" target="' . $link_target . '">';
			}
				if ($position == "left") {
					$output .= '<i class="ts-list-item-icon ts-font-icon ' . $icon . ' ' . $animation_icon . '" style="' . $icon_style . '"></i>';
				}
				$output .= '<div class="ts-list-item-content ' . $icon_tooltipclasses . '" ' . $icon_tooltipcontent . ' style="color: ' . $font_color . '; ' . $span_padding . '">';
					if (function_exists('wpb_js_remove_wpautop')){
						$output .= wpb_js_remove_wpautop($content, $wpautop);
					} else {
						$output .= $content;
					}
				$output .='</div>';
				if ($position == "right") {
					$output .= '<i class="ts-list-item-icon ts-font-icon ' . $icon . ' ' . $animation_icon . '" style="' . $icon_style . '"></i>';
				}
			if ($link) {
				$output .= '</a>';
			}
		$output .= '</div>';
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>