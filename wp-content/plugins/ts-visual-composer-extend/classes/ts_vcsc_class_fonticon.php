<?php
	if (!class_exists('TS_Font_Icon')){
		class TS_Font_Icon{
			function __construct(){
				global $VISUAL_COMPOSER_EXTENSIONS;
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Visual_Composer_Elements['TS Icon Fonts']['active'] == "true") {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
						if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
							$this->TS_VCSC_Add_Icons_Element_Lean();
						} else if (function_exists('vc_map')) {
							add_action('init',								array($this, 'TS_VCSC_Add_Icons_Element'), 9999999);
						}
					} else {
						if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
							add_action('admin_init',						array($this, 'TS_VCSC_Add_Icons_Element_Lean'), 9999999);
						} else if (function_exists('vc_map')) {
							add_action('admin_init',						array($this, 'TS_VCSC_Add_Icons_Element'), 9999999);
						}
					}
				}
				if ((is_admin() == false) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAJAX == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAlways == "true")) {
					// WP Bakery Page Builder / CodeStar Generator
					add_shortcode('TS-VCSC-Font-Icons',						array($this, 'TS_VCSC_Add_Icons_Function'));
					add_shortcode('TS_VCSC_Font_Icons',						array($this, 'TS_VCSC_Add_Icons_Function'));
					// Old TinyMCE Shortcode Generator
					if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconicumActivated == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconicumMenuGenerator == "true")) {	
						add_shortcode('TS_TINY_Icon_Font',					array($this, 'TS_VCSC_Add_Icons_TinyMCE'));
						add_shortcode('TS_VCSC_Icon_Font',					array($this, 'TS_VCSC_Add_Icons_TinyMCE'));
					}
				}
			}
			
			// Register Element(s) via LeanMap
			function TS_VCSC_Add_Icons_Element_Lean() {
				vc_lean_map('TS-VCSC-Font-Icons', 							array($this, 'TS_VCSC_Add_Icons_Element'), null);
			}
			
			function TS_VCSC_Add_Icons_Function ($atts) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
				
				extract(shortcode_atts(array(
					// General Settings
					'icon_replace'				=> 'false',
					'icon' 						=> '',
					'icon_image'				=> '',
					'icon_color'				=> '#cccccc',
					'icon_background'			=> 'rgba(255, 255, 255, 0)',
					'icon_size_type'			=> 'px',
					'icon_size_slide'           => 30,
					'icon_size_points'			=> 30,
					'icon_size_ems'				=> 2,
					'icon_size_rem'				=> 2,
					'icon_size_percent'			=> 200,
					'icon_size_viewheight'		=> 2,
					'icon_size_viewwidth'		=> 2,
					'icon_frame_type' 			=> '',
					'icon_frame_thick'			=> 1,
					'icon_frame_radius'			=> '',
					'icon_frame_color'			=> '#000000',
					'padding' 					=> 'false',
					'icon_padding' 				=> 0,
					'icon_align' 				=> '',
					'link' 						=> '',
					'link_target'				=> '_parent',
					// Scroll Settings
					'scroll_navigate'			=> 'false',
					'scroll_target'				=> '',
					'scroll_speed'				=> 2000,
					'scroll_effect'				=> 'linear',
					'scroll_offset'				=> 'desktop:0px;tablet:0px;mobile:0px',
					'scroll_hashtag'			=> 'false',
					'scroll_placement'			=> 'bottomright',
					'scroll_distance'			=> 200,
					'scroll_left'				=> 20,
					'scroll_right'				=> 20,
					'scroll_top'				=> 20,
					'scroll_bottom'				=> 20,
					// Tooltip Settings
					'tooltip_css'				=> 'false',
					'tooltip_content'			=> '',
					'tooltip_base64'			=> '',
					'tooltip_position'			=> 'ts-simptip-position-top',
					'tooltip_style'				=> 'ts-simptip-style-black',
					'tooltip_animation'			=> 'swing',
					'tooltipster_offsetx'		=> 0,
					'tooltipster_offsety'		=> 0,
					// Animation Settings
					'animation_active'			=> '',
					'animation_icon'			=> '',
					'animation_view' 			=> '',
					'animation_totopin'			=> '',
					'animation_totopout'		=> '',
					'animation_delay' 			=> 0,
					// Other Settings
					'margin_top'				=> 0,
					'margin_bottom'				=> 0,
					'el_id' 					=> '',
					'el_class' 					=> '',
					'css'						=> '',
				), $atts));
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndWaypoints == "true") {
					if (wp_script_is('waypoints', $list = 'registered')) {
						wp_enqueue_script('waypoints');
					} else {
						wp_enqueue_script('ts-extend-waypoints');
					}
				}
				if ($tooltip_css == "true") {
					wp_enqueue_style('ts-extend-tooltipster');
					wp_enqueue_script('ts-extend-tooltipster');
				}
				wp_enqueue_style('ts-extend-animations');
				if ((($scroll_navigate == "true") && ($scroll_target != '')) || ($scroll_navigate == "gototop")) {
					wp_enqueue_script('jquery-easing');
				}
				wp_enqueue_style('ts-visual-composer-extend-front');
				wp_enqueue_script('ts-visual-composer-extend-front');
				
				$icon_color 					= !empty($icon_color) ? ('color:' . $icon_color .';') : '';
				$output 						= $icon_frame_class = $icon_frame_style = $animation_css = '';
				
				if (!empty($el_id)) {
					$icon_font_id				= $el_id;
				} else {
					$icon_font_id				= 'ts-vcsc-font-icon-' . mt_rand(999999, 9999999);
				}
				
				if (!empty($icon_image)) {
					$icon_image_path 			= wp_get_attachment_image_src($icon_image, 'large');
				}
				
				if (($scroll_navigate == "true") && ($scroll_target != '')) {
					$scroll_target				= str_replace("#", "", $scroll_target);
					$a_href						= "#" . $scroll_target;
					if ($tooltip_css == "true") {
						$a_title 				= "";
					} else {
						$a_title 				= $tooltip_content;
					}
					$a_target 					= "_parent";
				} else {
					$a_href						= $link;
					if ($tooltip_css == "true") {
						$a_title 				= "";
					} else {
						$a_title 				= $tooltip_content;
					}
					$a_target 					= $link_target;
				}
				if (($scroll_navigate == "true") && ($scroll_target != '')) {			
					$scroll_offset 				= explode(';', $scroll_offset);			
					$offsetDesktop				= explode(':', $scroll_offset[0]);
					$offsetDesktop				= str_replace("px", "", $offsetDesktop[1]);
					$offsetTablet				= explode(':', $scroll_offset[1]);
					$offsetTablet				= str_replace("px", "", $offsetTablet[1]);
					$offsetMobile				= explode(':', $scroll_offset[2]);
					$offsetMobile				= str_replace("px", "", $offsetMobile[1]);			
					$scroll_class				= 'ts-button-page-navigator';			
					$scroll_data				= 'data-scroll-target="' . $scroll_target . '" data-scroll-speed="' . $scroll_speed . '" data-scroll-effect="' . $scroll_effect . '" data-scroll-offsetdesktop="' . $offsetDesktop . '" data-scroll-offsettablet="' . $offsetTablet . '" data-scroll-offsetmobile="' . $offsetMobile . '" data-scroll-hashtag="' . $scroll_hashtag . '"';
				} else {
					$scroll_class				= '';
					$scroll_data				= '';
				}
				if ($scroll_navigate == "gototop") {
					$a_href						= "#TS_GoToTop_LinkIcon";
					$a_target					= "_parent";
					$a_title					= "";
					$margin_top					= 0;
					$margin_bottom				= 0;
					$animation_active			= "";
					$animation_icon				= "";
					$animation_view				= "";
					$gototop_class				= "ts-gototop-page-navigator ts-gototop-page-" . $scroll_placement;
					$gototop_data				= 'data-scroll-visible="false" data-scroll-target="TS_GoToTop_LinkIcon" data-scroll-distance="' . $scroll_distance . '" data-scroll-speed="' . $scroll_speed . '" data-scroll-effect="' . $scroll_effect . '" data-scroll-totopin="' . $animation_totopin . '" data-scroll-totopout="' . $animation_totopout . '"';
					if ($scroll_distance > 0) {
						$gototop_class			.= " ts-gototop-page-distance";
						$gototop_style			= "display: none;";
					} else {
						$gototop_style			= "";
					}
					if (($scroll_placement == "topleft") || ($scroll_placement == "centerleft") || ($scroll_placement == "bottomleft")) {
						$gototop_style			.= " left: " . $scroll_left . "px;";
					} else if (($scroll_placement == "topright") || ($scroll_placement == "centerright") || ($scroll_placement == "bottomright")) {
						$gototop_style			.= " right: " . $scroll_right . "px;";
					}
					if (($scroll_placement == "topleft") || ($scroll_placement == "topcenter") || ($scroll_placement == "topright")) {
						$gototop_style			.= " top: " . $scroll_top . "px;";
					} else if (($scroll_placement == "bottomleft") || ($scroll_placement == "bottomcenter") || ($scroll_placement == "bottomright")) {
						$gototop_style			.= " bottom: " . $scroll_bottom . "px;";
					}
				} else {
					$gototop_class				= "";
					$gototop_data				= "";
					$gototop_style				= "";
				}
				
				if ($padding == "true") {
					$icon_frame_padding			= 'padding: ' . $icon_padding . 'px; ';
				} else {
					$icon_frame_padding			= '';
				}
				
				// Size Adjustments
				if (($icon_size_type == "px") || ($icon_size_type == "")) {
					$icon_size_element			= $icon_size_slide . "px";
				} else if ($icon_size_type == "pt") {
					$icon_size_element			= $icon_size_points . "pt";
				} else if ($icon_size_type == "ems") {
					$icon_size_element			= $icon_size_ems . "em";
				} else if ($icon_size_type == "rem") {
					$icon_size_element			= $icon_size_rem . "rem";
				} else if ($icon_size_type == "%") {
					$icon_size_element			= $icon_size_percent . "%";
				} else if ($icon_size_type == "vh") {
					$icon_size_element			= $icon_size_viewheight . "vh";
				} else if ($icon_size_type == "vw") {
					$icon_size_element			= $icon_size_viewwidth . "vw";
				}
				
				$icon_style                     = '' . $icon_frame_padding . 'background-color:' . $icon_background . '; width: auto; height: auto; font-size: ' . $icon_size_element . '; line-height: 100%;';
				$icon_image_style				= '' . $icon_frame_padding . 'background-color:' . $icon_background . '; width: ' . $icon_size_element . '; height: auto; ';
				
				if ($icon_frame_type != '') {
					$icon_frame_class 	        = 'frame-enabled';
					$icon_frame_style 	        = 'border: ' . $icon_frame_thick . 'px ' . $icon_frame_type . ' ' . $icon_frame_color . ';';
				}
				
				if ($animation_view != '') {
					$animation_css				= TS_VCSC_GetCSSAnimation($animation_view, "true");			
				}
				
				// Tooltip
				if ($tooltip_css == "true") {
					$tooltip_position			= TS_VCSC_TooltipMigratePosition($tooltip_position);
					$tooltip_style				= TS_VCSC_TooltipMigrateStyle($tooltip_style);
					if (strlen($tooltip_base64) != 0) {
						$tooltip_content		= $tooltip_base64;
						$icon_tooltiphtml		= 'true';
					} else {
						$icon_tooltiphtml		= 'false';
					}			
					if (strlen($tooltip_content) != 0) {
						$icon_tooltipclasses	= "ts-has-tooltipster-tooltip";
						$icon_tooltipcontent	= 'data-tooltipster-html="' . $icon_tooltiphtml . '" data-tooltipster-title="" data-tooltipster-text="' . $tooltip_content . '" data-tooltipster-image="" data-tooltipster-position="' . $tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $tooltip_style . '" data-tooltipster-animation="' . $tooltip_animation . '" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
					} else {
						$icon_tooltipclasses	= "";
						$icon_tooltipcontent	= "";
					}
				} else {
					$icon_tooltipclasses		= "";
					$icon_tooltipcontent		= "";
					$icon_tooltiphtml			= 'false';
				}
				
				$output 						= '';
				
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 					= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-vcsc-font-icon ts-font-icons ts-shortcode ts-icon-align-' . $icon_align . ' ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Font-Icons', $atts);
				} else {
					$css_class					= 'ts-vcsc-font-icon ts-font-icons ts-shortcode ts-icon-align-' . $icon_align . ' ' . $el_class;
				}
		
				$output .= '<div id="' . $icon_font_id . '" style="' . $gototop_style . ' margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;" ' . $icon_tooltipcontent . ' class="' . $css_class . ' ' . $icon_tooltipclasses . ' ' . ($animation_view != '' ? 'ts-vcsc-font-icon-viewport' : '') . ' ' . $gototop_class . '" data-type="' . ($icon_replace == "false" ? "icon" : "image") . '" data-active="' . $animation_active . '" data-viewport="' . $animation_css . '" data-opacity="1" data-delay="' . $animation_delay . '" data-animation="' . $animation_icon . '" ' . $gototop_data . '>';		
					if ((($scroll_navigate == "true") && ($scroll_target != '')) || ($link != '') || ($scroll_navigate == "gototop")) {
						$output .= '<a class="ts-font-icons-link ' . $scroll_class . '" href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '" ' . $scroll_data . '>';
					}						
						if ($icon_replace == "false") {
							$output .= '<i class="ts-font-icon ' . $icon . ' ' . $icon_frame_class . ' ' . $icon_frame_radius . ' ' . $animation_active . '" style="' . $icon_style . $icon_frame_style . $icon_color . '"></i>';
						} else {
							$output .= '<img class="ts-font-icon ' . $icon_frame_class . ' ' . $animation_icon . ' ' . $icon_frame_radius . ' ' . $icon_frame_radius . ' ' . $animation_active . '" src="' . $icon_image_path[0] . '" style="' . $icon_frame_style . ' ' . $icon_image_style . ' display: inline-block !important;">';
						}			
					if ((($scroll_navigate == "true") && ($scroll_target != '')) || ($link != '')) {
						$output .= '</a>';
					}			
				$output .= '</div>';
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
			function TS_VCSC_Add_Icons_TinyMCE ($atts) {
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
					'id' 						=> '',
					'class' 					=> '',			
					'icon' 						=> '',
					'size'           			=> 16,			
					'color'						=> '#000000',
					'background'				=> '',
					'opacity'					=> 1,	
					'hoverchanges'				=> 'false',
					'hovercolor'				=> '#000000',
					'hoverbackground'			=> '',
					'hoveropacity'				=> 1,			
					'animation'					=> '',
					'viewport'					=> '',
					'delay'						=> 0,
					'shadow'					=> '',			
					'bordershow'				=> 'false',
					'bordertype' 				=> 'solid',
					'borderwidth'				=> 1,
					'borderradius'				=> '',
					'bordercolor'				=> '#cccccc',			
					'padding'					=> 0,
					'paddingtop'				=> 0,
					'paddingbottom'				=> 0,
					'paddingleft'				=> 0,
					'paddingright'				=> 0,
					'margin'					=> 5,
					'margintop'					=> 5,
					'marginbottom'				=> 5,
					'marginleft'				=> 5,
					'marginright'				=> 5,			
					'inline'					=> 'true',
					'align' 					=> 'ts-align-center',			
					'tooltipcontent'			=> '',
					'tooltipcss'				=> 'false',
					'tooltipposition'			=> 'ts-simptip-position-top',
					'tooltipstyle'				=> 'ts-simptip-style-black',			
					'tooltipanimation'			=> 'swing',
					'tooltiparrow'				=> 'true',
					'tooltipbackground'			=> '#000000',
					'tooltipborder'				=> '#000000',
					'tooltipcolor'				=> '#ffffff',
					'tooltipoffsetx'			=> 0,
					'tooltipoffsety'			=> 0,			
					'link' 						=> '',
					'target'					=> '_parent',
				), $atts));
				
				// Custom ID and Classes for Element
				// ---------------------------------
			
				// Retrieve Class for Icon
				if (strlen($icon) > 0) {
					$icon_icon					= $icon . "";
				} else {
					$icon_icon					= "";
				}
				// Define Custom ID for Element
				if (strlen($id) > 0) {
					$icon_id					= $id;
				} else {
					$icon_id					= 'ts-vcsc-generator-icon-' . mt_rand(999999, 9999999);
				}
				// Define Custom Class Name for Element
				if (strlen($class) > 0) {
					$icon_class					= $class . " ";
				} else {
					$icon_class					= "";
				}
				// Define Class for Border Radius
				if (strlen($borderradius) > 0) {
					$icon_borderradius			= $borderradius . " ";
				} else {
					$icon_borderradius			= "";
				}
				// Define Class for Animation
				if (strlen($animation) > 0) {
					$icon_animation				= $animation . " ";
				} else {
					$icon_animation				= "";
				}
				
				// Style Settings for Element
				// --------------------------
				
				// Define Size for Element
				if ($size != 16) {
					$icon_size					= "height:" . $size . "px; width:" . $size . "px; line-height:" . $size . "px; font-size:" . $size . "px; ";
				} else {
					$icon_size					= "";
				}
				
				// Define Color for Element
				if ($color != "#000000") {
					$icon_color					= "color: " . $color . "; ";
				} else {
					$icon_color					= "";
				}
				
				// Define Background for Element
				if (strlen($background) > 0) {
					$icon_background 			= " background-color: " . $background . "; ";
				} else {
					$icon_background			= "";
				}
				
				// Define Opacity for Element
				if (strlen($opacity) > 0) {
					$icon_opacity				= $opacity;
				} else {
					$icon_opacity				= "1";
				}
				
				if ($hoverchanges == "true") {
					// Define Hover Color for Element
					if (strlen($hovercolor) > 0) {
						$icon_hovercolor		= $hovercolor;
					} else {
						$icon_hovercolor		= $color;
					}
					
					// Define Hover Background for Element
					if (strlen($hoverbackground) > 0) {
						$icon_hoverbackground	= $hoverbackground;
					} else {
						$icon_hoverbackground	= $background;
					}
					
					// Define Hover Opacity for Element
					if (strlen($hoveropacity) > 0) {
						$icon_hoveropacity		= $hoveropacity;
					} else {
						$icon_hoveropacity		= "1";
					}
				}
				
				// Define Border for Element
				if ($bordershow == "true") {
					$icon_border 	        	= "border: " . $borderwidth . "px " . $bordertype . " " . $bordercolor . "; ";
				} else {
					$icon_border				= "";
				}
				
				// Define Paddings for Element
				if ($padding != 0) {
					$icon_paddingtop			= $padding;
					$paddingbottom				= $padding;
					$paddingleft				= $padding;
					$paddingright				= $padding;
				} else {
					if ($paddingtop != 0) {
						$icon_paddingtop		= $paddingtop;
					} else {
						$icon_paddingtop		= 0;
					}
					if ($paddingbottom != 0) {
						$icon_paddingbottom		= $paddingbottom;
					} else {
						$icon_paddingbottom		= 0;
					}
					if ($paddingleft != 0) {
						$icon_paddingleft		= $paddingleft;
					} else {
						$icon_paddingleft		= 0;
					}
					if ($paddingright != 0) {
						$icon_paddingright		= $paddingright;
					} else {
						$icon_paddingright		= 0;
					}
				}
				$icon_padding 					= "padding: " . $icon_paddingtop . "px " . $icon_paddingright . "px " . $icon_paddingbottom . "px " . $icon_paddingleft . "px; ";
				
				// Define Margins for Element
				if ($margintop != 5){
					$icon_margintop				= $margintop;
				} else {
					$icon_margintop				= 5;
				}
				if ($marginbottom != 5){
					$icon_marginbottom			= $marginbottom;
				} else {
					$icon_marginbottom			= 5;
				}
				if ($marginleft != 5){
					$icon_marginleft			= $marginleft;
				} else {
					$icon_marginleft			= 5;
				}
				if ($marginright != 5){
					$icon_marginright			= $marginright;
				} else {
					$icon_marginright			= 5;
				}
				$icon_margin 					= "margin: " . $icon_margintop . "px " . $marginright . "px " . $marginbottom . "px " . $marginleft . "px; ";
				
				// Define Class for Element Align
				if (strlen($align) > 0) {
					$icon_align					= " " . $align;
				} else {
					$icon_align					= "";
				}
				
				// Viewport Animation
				if (strlen($viewport) > 0) {
					$icon_viewport				= $viewport;
					$icon_viewportclass			= "ts-font-icon-generator-viewport";
				} else {
					$icon_viewport				= "";
					$icon_viewportclass			= "";
				}
				
				// Tooltip
				if ($tooltipcss == "true") {
					$tooltipposition			= TS_VCSC_TooltipMigratePosition($tooltipposition);
					$tooltipstyle				= TS_VCSC_TooltipMigrateStyle($tooltipstyle);
					if (strlen($tooltipcontent) != 0) {
						wp_enqueue_style('ts-extend-tooltipster');
						wp_enqueue_script('ts-extend-tooltipster');	
						$icon_tooltipclasses 	= "ts-has-tooltipster-tooltip";
						$icon_tooltipcontent	= 'data-tooltipster-html="false" data-tooltipster-title="" data-tooltipster-text="' . strip_tags($tooltipcontent) . '" data-tooltipster-image="" data-tooltipster-position="' . $tooltipposition . '" data-tooltipster-touch="false" data-tooltipster-arrow="' . $tooltiparrow . '" data-tooltipster-theme="' . $tooltipstyle . '" data-tooltipster-animation="' . $tooltipanimation . '" data-tooltipster-trigger="hover" data-tooltipster-background="' . $tooltipbackground . '" data-tooltipster-border="' . $tooltipborder . '" data-tooltipster-color="' . $tooltipcolor . '" data-tooltipster-offsetx="' . $tooltipoffsetx . '" data-tooltipster-offsety="' . $tooltipoffsety . '"';
					} else {
						$icon_tooltipclasses	= "";
						$icon_tooltipcontent	= "";
					}
				} else {
					$icon_tooltipclasses		= "";
					if (strlen($tooltipcontent) != 0) {
						$icon_tooltipcontent	= ' title="' . $tooltipcontent . '"';
					} else {
						$icon_tooltipcontent	= "";
					}
				}
				
				// Calculate Total Item Width
				$icon_totalwidth				= ($size + 2*$padding + $icon_marginleft + $icon_marginright + 2*$borderwidth);
				
				// Create Element Output
				// ---------------------
				if ($inline == "true") {
					$output 					= '<span class="ts-font-icon-holder ts-align-inline ' . $icon_tooltipclasses . '" ' . $icon_tooltipcontent . '>';
				} else {
					$output 					= '<div class="ts-font-icon-holder ' . $align . ' ' . $icon_tooltipclasses . '" ' . $icon_tooltipcontent . '>';
				}
			
				if (strlen($link) > 0) {
					$output .= '<a class="ts-font-icon-link" href="' . $link . '" target="' . $target . '">';
				}
			
				if ($hoverchanges == "true") {
					$output .= '<i id="' . $icon_id . '" class="ts-font-icon ts-font-icon-generator ' . $icon_icon . " " . $icon_borderradius . $icon_animation . $icon_class . $icon_viewportclass . '" data-viewport="' . $icon_viewport . '" data-delay="' . $delay . '" data-hover="true" data-opacity="' . $icon_opacity . '" data-hoveropacity="' . $icon_hoveropacity . '" data-color="' . $color . '" data-hovercolor="' . $icon_hovercolor . '" data-background="' . $background . '" data-hoverbackground="' . $icon_hoverbackground . '" style="' . $icon_size . $icon_color . $icon_background . $icon_border . $icon_padding . $icon_margin . '"></i>';
				} else {
					$output .= '<i id="' . $icon_id . '" class="ts-font-icon ts-font-icon-generator ' . $icon_icon . " " . $icon_borderradius . $icon_animation . $icon_class . $icon_viewportclass . '" data-viewport="' . $icon_viewport . '" data-delay="' . $delay . '" data-hover="false" data-opacity="' . $icon_opacity . '" style="' . $icon_size . $icon_color . $icon_background . $icon_border . $icon_padding . $icon_margin . '"></i>';
				}
				
				if (strlen($link) > 0) {
					$output .= '</a>';
				}
			
				if ($inline == "true") {
					$output .= '</span>';
				} else {
					$output .= '</div>';
				}
				
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
			function TS_VCSC_Add_Icons_Element() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                      	=> __( "TS Font Icon", "ts_visual_composer_extend" ),
					"base"                      	=> "TS-VCSC-Font-Icons",
					"icon" 	                    	=> "ts-composer-element-icon-icon-font",
					"class"                     	=> "",
					"category"                  	=> __("Composium", "ts_visual_composer_extend"),
					"description" 		    		=> __("Place a font (vector) icon or image", "ts_visual_composer_extend"),
					"js_view"     					=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorLivePreview == "true" ? "TS_VCSC_IconFontViewCustom" : ""),
					"admin_enqueue_js"				=> "",
					"admin_enqueue_css"				=> "",
					"params"                    	=> array(
						// Icon + Image Selections
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1",
							"seperator"				=> __( "Icon / Image Selection Settings", "ts_visual_composer_extend" ),
						),
						array(
							"type"					=> "switch_button",
							"heading"           	=> __( "Use Normal Image", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_replace",
							"value"             	=> "false",
							"description"       	=> __( "Switch the toggle to either use an icon or a normal image.", "ts_visual_composer_extend" )
						),		
						array(
							"type" 					=> "icons_panel",
							"heading" 				=> __( 'Select Icon', 'ts_visual_composer_extend' ),
							"param_name" 			=> 'icon',
							"value"					=> "",
							"settings" 				=> array(
								"emptyIcon" 				=> false,
								'emptyIconValue'			=> 'transparent',
								"type" 						=> 'extensions',
							),
							"admin_label"       	=> true,
							"description"       	=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorVisualSelector == "true" ? __( "Select the icon you want to display.", "ts_visual_composer_extend" ) : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorString),
							"dependency"        	=> array( 'element' => "icon_replace", 'value' => 'false' )
						),
						// Icon + Image Link
						array(
							"type"              	=> "attach_image",
							"heading"           	=> __( "Select Image", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_image",
							"value"             	=> "",
							"admin_label"       	=> true,
							"description"       	=> __( "Image must have equal dimensions for scaling purposes (i.e. 100x100).", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "icon_replace", 'value' => 'true' )
						),			
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Icon / Image Link Type", "ts_visual_composer_extend" ),
							"param_name"        	=> "scroll_navigate",
							"value"             	=> array(
								__( "Standard Link", "ts_visual_composer_extend" )					=> "false",
								__( "In-Page Navigation Link", "ts_visual_composer_extend" )		=> "true",
								__( "Go-To-Top Link", "ts_visual_composer_extend" )                 => "gototop",
								__( "No Link", "ts_visual_composer_extend" )                 		=> "none",
							),
							"admin_label"			=> true,
							"description"			=> __( "Define what type of link you want to apply to the icon or image.", "ts_visual_composer_extend" ),
						),
						// Icon + Image Sizes
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Icon / Image Size Type", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_size_type",
							"value"             	=> array(
								__( "Pixel", "ts_visual_composer_extend" )							=> "px",
								__( "Points", "ts_visual_composer_extend" )							=> "pt",
								__( "EM", "ts_visual_composer_extend" )								=> "ems",
								__( "REM", "ts_visual_composer_extend" )							=> "rem",
								__( "Percent", "ts_visual_composer_extend" )                 		=> "%",					
								__( "Viewport Height", "ts_visual_composer_extend" )				=> "vh",
								__( "Viewport Width", "ts_visual_composer_extend" )					=> "vw",
							),
							"admin_label"			=> true,
							"description"			=> __( "Define what size type you want to apply to the icon / image; select based on your intended usage.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Icon / Image Size Value", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_size_slide",
							"value"             	=> "30",
							"min"               	=> "16",
							"max"               	=> "512",
							"step"              	=> "1",
							"unit"              	=> 'px',
							"description"       	=> __( "Select the icon / image size in pixel.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "icon_size_type", 'value' => 'px' ),
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Icon / Image Size Value", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_size_points",
							"value"             	=> "30",
							"min"               	=> "16",
							"max"               	=> "512",
							"step"              	=> "1",
							"unit"              	=> 'pt',
							"description"       	=> __( "Select the icon / image size in points.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "icon_size_type", 'value' => 'pt' ),
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Icon / Image Size Value", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_size_ems",
							"value"             	=> "2",
							"min"               	=> "1",
							"max"               	=> "20",
							"step"              	=> "0.1",
							"decimals"				=> "1",
							"unit"              	=> 'em',
							"description"       	=> __( "Select the icon / image size in em.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "icon_size_type", 'value' => 'em' ),
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Icon / Image Size Value", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_size_rem",
							"value"             	=> "2",
							"min"               	=> "1",
							"max"               	=> "20",
							"step"              	=> "0.1",
							"decimals"				=> "1",
							"unit"              	=> 'rem',
							"description"       	=> __( "Select the icon / image size in rem.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "icon_size_type", 'value' => 'rem' ),
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Icon / Image Size Value", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_size_percent",
							"value"             	=> "200",
							"min"               	=> "100",
							"max"               	=> "1000",
							"step"              	=> "10",
							"unit"              	=> '%',
							"description"       	=> __( "Select the icon / image size in percent.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "icon_size_type", 'value' => '%' ),
						),			
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Icon / Image Size Value", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_size_viewheight",
							"value"             	=> "2",
							"min"               	=> "1",
							"max"               	=> "100",
							"step"              	=> "1",
							"unit"              	=> 'vh',
							"description"       	=> __( "Select the icon / image size in viewport height.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "icon_size_type", 'value' => 'vh' ),
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Icon / Image Size Value", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_size_viewwidth",
							"value"             	=> "2",
							"min"               	=> "1",
							"max"               	=> "100",
							"step"              	=> "1",
							"unit"              	=> 'vw',
							"description"       	=> __( "Select the icon / image size in viewport width.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "icon_size_type", 'value' => 'vw' ),
						),
						// Icon + Image Colors
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Icon Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_color",
							"value"             	=> "#cccccc",
							"description"       	=> __( "Define the color of the icon.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"        	=> array( 'element' => "icon_replace", 'value' => 'false' )
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Icon / Image Background Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_background",
							"value"             	=> "rgba(255, 255, 255, 0)",
							"description"       	=> __( "Define the background color for the icon / transparent image.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						// Icon + Image Alignment
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Icon / Image Align", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_align",
							"width"             	=> 150,
							"value"             	=> array(
								__( "No Align", "ts_visual_composer_extend" )                      => "none",
								__( "Float Left", "ts_visual_composer_extend" )                    => "left",
								__( "Float Right", "ts_visual_composer_extend" )                   => "right",
								__( "Center", "ts_visual_composer_extend" )                        => "center",
							),
							"dependency"			=> array( 'element' => 'scroll_navigate', 'value' => array("false", "true", "none") ),
							"description"       	=> __( "Select how to position the icon in the column.", "ts_visual_composer_extend" )
						),
						// Icon + Image Border Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_2",
							"seperator"				=> __( 'Icon / Image Border Settings', "ts_visual_composer_extend" ),
						),
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Icon / Image Border Type", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_frame_type",
							"width"             	=> 300,
							"value"             	=> array(
								__( "None", "ts_visual_composer_extend" )                          => "",
								__( "Solid Border", "ts_visual_composer_extend" )                  => "solid",
								__( "Dotted Border", "ts_visual_composer_extend" )                 => "dotted",
								__( "Dashed Border", "ts_visual_composer_extend" )                 => "dashed",
								__( "Double Border", "ts_visual_composer_extend" )                 => "double",
								__( "Grouve Border", "ts_visual_composer_extend" )                 => "groove",
								__( "Ridge Border", "ts_visual_composer_extend" )                  => "ridge",
								__( "Inset Border", "ts_visual_composer_extend" )                  => "inset",
								__( "Outset Border", "ts_visual_composer_extend" )                 => "outset",
							),
							"description"       	=> __( "Select the type of border around the icon / image.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Icon / Image Border Thickness", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_frame_thick",
							"value"             	=> "1",
							"min"               	=> "1",
							"max"               	=> "10",
							"step"              	=> "1",
							"unit"              	=> 'px',
							"description"       	=> __( "Define the thickness of the icon / image border.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "icon_frame_type", 'value' => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Border_Type_Values ),
						),
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Icon / Image Border Radius", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_frame_radius",
							"value"             	=> array(
								__( "None", "ts_visual_composer_extend" )                          => "",
								__( "Small Radius", "ts_visual_composer_extend" )                  => "ts-radius-small",
								__( "Medium Radius", "ts_visual_composer_extend" )                 => "ts-radius-medium",
								__( "Large Radius", "ts_visual_composer_extend" )                  => "ts-radius-large",
								__( "Full Circle", "ts_visual_composer_extend" )                   => "ts-radius-full"
							),
							"description"       	=> __( "Define the radius of the icon / image border.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"        	=> array( 'element' => "icon_frame_type", 'value' => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Border_Type_Values ),
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Icon / Image Frame Border Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_frame_color",
							"value"             	=> "#000000",
							"description"       	=> __( "Define the color of the icon / image border.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"        	=> array( 'element' => "icon_frame_type", 'value' => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Border_Type_Values ),
						),
						array(
							"type"					=> "switch_button",
							"heading"           	=> __( "Apply Padding to Icon / Image", "ts_visual_composer_extend" ),
							"param_name"        	=> "padding",
							"value"             	=> "false",
							"description"       	=> __( "Switch the toggle if you want to apply a padding to the icon / image.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Icon / Image Padding", "ts_visual_composer_extend" ),
							"param_name"        	=> "icon_padding",
							"value"             	=> "0",
							"min"               	=> "0",
							"max"               	=> "50",
							"step"              	=> "1",
							"unit"              	=> 'px',
							"description"       	=> __( "If image instead of icon, increase the image size by padding value.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "padding", 'value' => 'true' )
						),
						// Icon Link Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_3",
							"seperator"				=> "Icon Link Settings",
							"dependency"			=> array( 'element' => 'scroll_navigate', 'value' => array("false", "true", "gototop") ),
							"group"					=> "Link Settings"
						),
						array(
							"type"              	=> "textfield",
							"heading"           	=> __( "Link", "ts_visual_composer_extend" ),
							"param_name"        	=> "link",
							"value"             	=> "",
							"description"       	=> __( "Enter the link to the page or file here (starting with http://).", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => 'scroll_navigate', 'value' => "false" ),
							"group"					=> "Link Settings"
						),
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Link Target", "ts_visual_composer_extend" ),
							"param_name"        	=> "link_target",
							"value"             	=> array(
								__( "Same Window", "ts_visual_composer_extend" )                    => "_parent",
								__( "New Window", "ts_visual_composer_extend" )                     => "_blank"
							),
							"description"       	=> __( "Select how the link should be opened.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "link", 'not_empty' => true ),
							"group"					=> "Link Settings"
						),			
						array(
							"type"                  => "textfield",
							"heading"               => __( "Page Scroll Target", "ts_visual_composer_extend" ),
							"param_name"            => "scroll_target",
							"value"                 => "",
							"description"           => __( "Enter the unique ID for the page section you want to scroll to.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => 'true' ),
							"group"					=> "Link Settings"
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
							"group"					=> "Link Settings"
						),
						array(
							"type"              	=> "dropdown",
							"heading"           	=> __( "Link Placement", "ts_visual_composer_extend" ),
							"param_name"        	=> "scroll_placement",
							"value"             	=> array(					
								__( "Top Left", "ts_visual_composer_extend" )						=> "topleft",
								__( "Top Center", "ts_visual_composer_extend" )						=> "topcenter",
								__( "Top Right", "ts_visual_composer_extend" )                 		=> "topright",
								__( "Center Left", "ts_visual_composer_extend" )					=> "centerleft",
								__( "Center Right", "ts_visual_composer_extend" )					=> "centerright",					
								__( "Bottom Left", "ts_visual_composer_extend" )                 	=> "bottomleft",
								__( "Bottom Center", "ts_visual_composer_extend" )                 	=> "bottomcenter",
								__( "Bottom Right", "ts_visual_composer_extend" )                 	=> "bottomright",
								__( "Default", "ts_visual_composer_extend" )						=> "default",
							),
							"default"				=> "bottomright",
							"std"					=> "bottomright",
							"description"			=> __( "Define where on the screen the link should be placed; 'Default' equals position where this element has been placed in WP Bakery Page Builder.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => 'scroll_navigate', 'value' => "gototop" ),
							"group"					=> "Link Settings"
						),			
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Offset: Left", "ts_visual_composer_extend" ),
							"param_name"			=> "scroll_left",
							"value"					=> "20",
							"min"					=> "0",
							"max"					=> "100",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the offset from the left screen side that should be used for the link.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_placement", 'value' => array('topleft', 'centerleft', 'bottomleft') ),
							"group"					=> "Link Settings"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Offset: Right", "ts_visual_composer_extend" ),
							"param_name"			=> "scroll_right",
							"value"					=> "20",
							"min"					=> "0",
							"max"					=> "100",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the offset from the right screen side that should be used for the link.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_placement", 'value' => array('topright', 'centerright', 'bottomright') ),
							"group"					=> "Link Settings"
						),	
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Offset: Top", "ts_visual_composer_extend" ),
							"param_name"			=> "scroll_top",
							"value"					=> "20",
							"min"					=> "0",
							"max"					=> "100",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the offset from the top screen side that should be used for the link.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_placement", 'value' => array('topleft', 'topcenter', 'topright') ),
							"group"					=> "Link Settings"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Offset: Bottom", "ts_visual_composer_extend" ),
							"param_name"			=> "scroll_bottom",
							"value"					=> "20",
							"min"					=> "0",
							"max"					=> "100",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the offset from the bottom screen side that should be used for the link.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_placement", 'value' => array('bottomleft', 'bottomcenter', 'bottomright') ),
							"group"					=> "Link Settings"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Scroll Distance", "ts_visual_composer_extend" ),
							"param_name"			=> "scroll_distance",
							"value"					=> "200",
							"min"					=> "0",
							"max"					=> "600",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the required scroll distance from the top of the page in order to show the GoToTop link.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_placement", 'value' => array('topleft', 'topcenter', 'topright', 'bottomleft', 'bottomcenter', 'bottomright', 'centerleft', 'centerright') ),
							"group"					=> "Link Settings"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Page Scroll Speed", "ts_visual_composer_extend" ),
							"param_name"			=> "scroll_speed",
							"value"					=> "2000",
							"min"					=> "500",
							"max"					=> "10000",
							"step"					=> "100",
							"unit"					=> 'ms',
							"description"			=> __( "Define the speed that should be used to scroll to the section.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => array('true', 'gototop') ),
							"group"					=> "Link Settings"
						),						
						array(
							"type"                 	=> "dropdown",
							"heading"               => __( "Page Scroll Easing", "ts_visual_composer_extend" ),
							"param_name"            => "scroll_effect",
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"width"                 => 150,
							"value" 				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Easings_Array,
							"description"           => __( "Select the easing animation that should be applied to the page scroll.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => array('true', 'gototop') ),
							"group"					=> "Link Settings"
						),
						array(
							"type"                  => "switch_button",
							"heading"			    => __( 'Add Target as Hashtag', "ts_visual_composer_extend" ),
							"param_name"		    => "scroll_hashtag",
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"value"                 => "false",
							"description"		    => __( "Switch the toggle if you want to add the scroll target to the browser URL via hashtag.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => 'true' ),
							"group"					=> "Link Settings"
						),			
						// Icon Tooltip
						array(
							"type"					=> "seperator",
							"param_name"			=> "seperator_4",
							"seperator"				=> "Icon Tooltip",	
							"group"					=> "Tooltip Settings"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Use Advanced Tooltip", "ts_visual_composer_extend" ),
							"param_name"			=> "tooltip_css",
							"value"					=> "false",
							"description"       	=> __( "Switch the toggle if you want to apply am advanced tooltip to the image.", "ts_visual_composer_extend" ),				
							"group"					=> "Tooltip Settings"
						),
						array(
							"type"					=> "textarea",
							"heading"				=> __( "Tooltip Content", "ts_visual_composer_extend" ),
							"param_name"			=> "tooltip_content",
							"value"					=> "",
							"description"			=> __( "Enter the tooltip content here (do NOT use quotation marks or HTML).", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "tooltip_css", 'value' => 'false' ),
							"group"					=> "Tooltip Settings"
						),
						array(
							"type"					=> "textarea_raw_html",
							"heading"				=> __( "Tooltip Content", "ts_visual_composer_extend" ),
							"param_name"			=> "tooltip_base64",
							"value"					=> "",
							"description"			=> __( "Enter the tooltip content here; you can use special characters as well.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "tooltip_css", 'value' => 'true' ),
							"group"					=> "Tooltip Settings"
						),
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Tooltip Position", "ts_visual_composer_extend" ),
							"param_name"			=> "tooltip_position",
							"value"					=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Vertical,
							"description"			=> __( "Select the tooltip position in relation to the image.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "tooltip_css", 'value' => 'true' ),
							"group"					=> "Tooltip Settings"
						),
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Tooltip Style", "ts_visual_composer_extend" ),
							"param_name"			=> "tooltip_style",
							"value"             	=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Layouts,
							"description"			=> __( "Select the tooltip style.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "tooltip_css", 'value' => 'true' ),				
							"group"					=> "Tooltip Settings"
						),
						array(
							"type"				    => "dropdown",
							"heading"			    => __( "Tooltip Animation", "ts_visual_composer_extend" ),
							"param_name"		    => "tooltip_animation",
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Animations,
							"description"		    => __( "Select how the tooltip entry and exit should be animated once triggered.", "ts_visual_composer_extend" ),
							"group"					=> "Tooltip Settings",
							"dependency"            => array( 'element' => "tooltip_css", 'value' => 'true' ),
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
							"dependency"    		=> array( "element" => "tooltip_css", "value" => "true" ),
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
							"dependency"    		=> array( "element" => "tooltip_css", "value" => "true" ),
							"group" 				=> "Tooltip Settings",
						),
						// Animation Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_5",
							"seperator"				=> "Animation Settings",
							"group" 				=> "Animation Settings",
						),
						array(
							"type"					=> "css3animations",
							"heading"				=> __("Icon / Image Active Animation", "ts_visual_composer_extend"),
							"param_name"			=> "animation_active",
							"prefix"				=> "ts-infinite-css-",
							"connector"				=> "css3animations_active",
							"noneselect"			=> "true",
							"default"				=> "",
							"value"					=> "",
							"admin_label"			=> false,
							"description"			=> __("Select the active animation for the icon / image.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => array('true', 'false', 'none') ),
							"group" 				=> "Animation Settings",
						),
						array(
							"type"					=> "hidden_input",
							"heading"				=> __( "Icon / Image Active Animation", "ts_visual_composer_extend" ),
							"param_name"			=> "css3animations_active",
							"value"					=> "",
							"admin_label"			=> true,
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => array('true', 'false', 'none') ),
							"group" 				=> "Animation Settings",
						),
						array(
							"type"					=> "css3animations",
							"heading"				=> __("Icon / Image Hover Animation", "ts_visual_composer_extend"),
							"param_name"			=> "animation_icon",
							"prefix"				=> "ts-hover-css-",
							"connector"				=> "css3animations_in",
							"noneselect"			=> "true",
							"default"				=> "",
							"value"					=> "",
							"admin_label"			=> false,
							"description"			=> __("Select the hover animation for the icon / image.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => array('true', 'false', 'none') ),
							"group" 				=> "Animation Settings",
						),
						array(
							"type"					=> "hidden_input",
							"heading"				=> __( "Icon / Image Hover Animation", "ts_visual_composer_extend" ),
							"param_name"			=> "css3animations_in",
							"value"					=> "",
							"admin_label"			=> true,
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => array('true', 'false', 'none') ),
							"group" 				=> "Animation Settings",
						),		
						array(
							"type"					=> "css3animations",
							"heading"				=> __("Icon / Image Viewport Animation", "ts_visual_composer_extend"),
							"param_name"			=> "animation_view",
							"prefix"				=> "ts-viewport-css-",
							"connector"				=> "css3animations_view",
							"noneselect"			=> "true",
							"default"				=> "",
							"value"					=> "",
							"admin_label"			=> false,
							"description"			=> __("Select the viewport animation for the icon / image.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => array('true', 'false', 'none') ),
							"group" 				=> "Animation Settings",
						),
						array(
							"type"					=> "hidden_input",
							"heading"				=> __( "Icon / Image Viewport Animation", "ts_visual_composer_extend" ),
							"param_name"			=> "css3animations_view",
							"value"					=> "",
							"admin_label"			=> true,
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => array('true', 'false', 'none') ),
							"group" 				=> "Animation Settings",
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Animation Delay", "ts_visual_composer_extend" ),
							"param_name"        	=> "animation_delay",
							"value"             	=> "0",
							"min"               	=> "0",
							"max"               	=> "10000",
							"step"              	=> "100",
							"unit"              	=> 'ms',
							"description"       	=> __( "Define an optional delay for the viewport animation.", "ts_visual_composer_extend" ),
							"dependency"        	=> array( 'element' => "animation_view", 'not_empty' => true ),
							"group" 				=> "Animation Settings",
						),
						array(
							"type"					=> "css3animations",
							"heading"				=> __("Icon / Image In-Animation", "ts_visual_composer_extend"),
							"param_name"			=> "animation_totopin",
							"prefix"				=> "ts-viewport-css-",
							"connector"				=> "css3animations_totopin",
							"noneselect"			=> "true",
							"default"				=> "",
							"value"					=> "",
							"admin_label"			=> false,
							"description"			=> __("Select the in animation for the GoToTop link.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => 'gototop' ),
							"group" 				=> "Animation Settings",
						),
						array(
							"type"					=> "hidden_input",
							"heading"				=> __( "Icon / Image In-Animation", "ts_visual_composer_extend" ),
							"param_name"			=> "css3animations_totopin",
							"value"					=> "",
							"admin_label"			=> false,
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => 'gototop' ),
							"group" 				=> "Animation Settings",
						),
						array(
							"type"					=> "css3animations",
							"heading"				=> __("Icon / Image Out-Animation", "ts_visual_composer_extend"),
							"param_name"			=> "animation_totopout",
							"prefix"				=> "ts-viewport-css-",
							"connector"				=> "css3animations_totopout",
							"noneselect"			=> "true",
							"default"				=> "",
							"value"					=> "",
							"admin_label"			=> false,
							"description"			=> __("Select the out animation for the GoToTop link.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => 'gototop' ),
							"group" 				=> "Animation Settings",
						),
						array(
							"type"					=> "hidden_input",
							"heading"				=> __( "Icon / Image In-Animation", "ts_visual_composer_extend" ),
							"param_name"			=> "css3animations_totopout",
							"value"					=> "",
							"admin_label"			=> false,
							"dependency"            => array( 'element' => "scroll_navigate", 'value' => 'gototop' ),
							"group" 				=> "Animation Settings",
						),
						// Other Icon Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_6",
							"seperator"				=> "Other Icon Settings",
							"group" 				=> "Other Settings",
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Margin: Top", "ts_visual_composer_extend" ),
							"param_name"            => "margin_top",
							"value"                 => "0",
							"min"                   => "0",
							"max"                   => "200",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => 'scroll_navigate', 'value' => array("false", "true") ),
							"group" 				=> "Other Settings",
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Margin: Bottom", "ts_visual_composer_extend" ),
							"param_name"            => "margin_bottom",
							"value"                 => "0",
							"min"                   => "0",
							"max"                   => "200",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => 'scroll_navigate', 'value' => array("false", "true") ),
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
		}
	}
	// Register Container and Child Shortcode with WP Bakery Page Builder
	global $VISUAL_COMPOSER_EXTENSIONS;
	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Visual_Composer_Elements['TS Icon Fonts']['active'] == "false") {
		if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Icon_Font'))) {
			class WPBakeryShortCode_TS_VCSC_Icon_Font extends WPBakeryShortCode {};
		}
		if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Font_Icons'))) {
			class WPBakeryShortCode_TS_VCSC_Font_Icons extends WPBakeryShortCode {};
		}
	}
	// Initialize "TS Font Icon" Class
	if (class_exists('TS_Font_Icon')) {
		$TS_Font_Icon = new TS_Font_Icon;
	}
?>