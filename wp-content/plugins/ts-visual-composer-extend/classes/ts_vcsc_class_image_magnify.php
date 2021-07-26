<?php
	if (!class_exists('TS_Image_Magnify')){
		class TS_Image_Magnify {
			private $TS_VCSC_Magnify_Language;
			
			function __construct() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						$this->TS_VCSC_Add_Image_Magnify_Lean();
					} else if (function_exists('vc_map')) {
						add_action('init',                                  array($this, 'TS_VCSC_Add_Image_Magnify_Element'), 9999999);
					}
				} else {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Image_Magnify_Lean'), 9999999);
					} else if (function_exists('vc_map')) {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Image_Magnify_Element'), 9999999);
					}
				}
				if ((is_admin() == false) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAJAX == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAlways == "true")) {
					add_shortcode('TS_VCSC_Image_Magnify',					array($this, 'TS_VCSC_Image_Magnify_Function'));
				}
				// Retrieve Language Settings
				$this->TS_VCSC_Magnify_Language								= get_option('ts_vcsc_extend_settings_translationsMagnify', '');
				if (($this->TS_VCSC_Magnify_Language == false) || (empty($this->TS_VCSC_Magnify_Language))) {
					$this->TS_VCSC_Magnify_Language							= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults;
				}		
			}
			
			// Register Element(s) via LeanMap
			function TS_VCSC_Add_Image_Magnify_Lean() {
				vc_lean_map('TS_VCSC_Image_Magnify', 						array($this, 'TS_VCSC_Add_Image_Magnify_Element'), null);
			}
			
			// Image Magnify
			function TS_VCSC_Image_Magnify_Function ($atts, $content = null) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();	
		
				extract( shortcode_atts( array(
					'layout'					=> 'loupe',
					'image'						=> '',
					'image_thumb'				=> 'large',
					'image_zoom'				=> 'full',
					
					'zoom_x'					=> 50,
					'zoom_y'					=> 50,
					'zoom_restore'				=> 'true',
					'zoom_timeout'				=> 6000,
					
					'background_type'       	=> 'color',
					'background_color'      	=> '#ffffff',
					'background_pattern'    	=> '',
					'background_image'			=> '',
					'background_size'			=> 'cover',
					'background_repeat'			=> 'no-repeat',
					
					'zoom_level'				=> 200,
					'zoom_size'					=> 100,
					'zoom_drag'					=> 'true',
					'zoom_circle'				=> 'true',
					'zoom_reflect'				=> 'false',
					'zoom_shadow'				=> 'true',
					'zoom_border'				=> 'true',
					'zoom_effect'				=> 'none',
					
					'zoom_show'					=> 'true',
					'zoom_note'					=> 'true',
					'zoom_outside'				=> 'false',
					'zoom_range'				=> 'true',
					'zoom_mouse'				=> 'false',
					'zoom_wheel'				=> 10,
					'zoom_pinch'				=> 'false',
					'zoom_lightbox'				=> 'true',
					
					'zoom_controls'				=> 'bottom',
					'zoom_scale'				=> 'true',
					'zoom_reset'				=> 'true',
					'zoom_rotate'				=> 'false',
					
					'string_zoomin'				=> ((array_key_exists('ZoomIn', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['ZoomIn'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['ZoomIn']),
					'string_zoomout'			=> ((array_key_exists('ZoomOut', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['ZoomOut'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['ZoomOut']),
					'string_zoomlevel'			=> ((array_key_exists('ZoomLevel', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['ZoomLevel'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['ZoomLevel']),
					'string_changelevel'		=> ((array_key_exists('ChangeLevel', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['ChangeLevel'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['ChangeLevel']),
					'string_next'				=> ((array_key_exists('Next', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['Next'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['Next']),
					'string_previous'			=> ((array_key_exists('Previous', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['Previous'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['Previous']),
					'string_reset'				=> ((array_key_exists('Reset', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['Reset'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['Reset']),
					'string_rotate'				=> ((array_key_exists('Rotate', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['Rotate'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['Rotate']),
					'string_lightbox'			=> ((array_key_exists('Lightbox', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['Lightbox'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['Lightbox']),
					
					'lightbox_group'			=> 'true',
					'lightbox_group_name'		=> '',
					'lightbox_size'				=> 'full',
					'lightbox_effect'			=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxDefaultAnimation,
					'lightbox_speed'			=> 5000,
					'lightbox_social'			=> 'true',
					'lightbox_backlight'		=> 'auto',
					'lightbox_backlight_color'	=> '#ffffff',
					
					'attribute_alt'				=> 'false',
					'attribute_alt_value'		=> '',
					'attribute_title'			=> '',
					
					'margin_top'				=> 0,
					'margin_bottom'				=> 0,
					'el_id' 					=> '',
					'el_class'                  => '',
					'css'						=> '',
				), $atts ));
				
				// Check for Front End Editor
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$editor_frontend			= "true";
					$zoom_drag					= "true";
					$zoom_mouse					= "false";
					$zoom_pinch					= "false";
				} else {
					$editor_frontend			= "false";
					$zoom_drag					= $zoom_drag;
					$zoom_mouse					= $zoom_mouse;
					$zoom_pinch					= $zoom_pinch;
				}
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					wp_enqueue_style('dashicons');
					wp_enqueue_script('ts-extend-krautlightbox');
					wp_enqueue_style('ts-extend-krautlightbox');
					wp_enqueue_script('ts-extend-zoomer');
					wp_enqueue_style('ts-extend-zoomer');			
					/*if ($zoom_mouse == "true") {
						wp_enqueue_script('ts-extend-mousewheel');
					}*/
				}
				wp_enqueue_style('ts-visual-composer-extend-front');			
				wp_enqueue_script('ts-visual-composer-extend-front');
				wp_enqueue_style('ts-extend-imageeffects');
				wp_enqueue_script('ts-extend-imageeffects');
				
				$output = $notice = $visible = $loupeclasses = '';
				
				$randomizer						= mt_rand(999999, 9999999);
				
				if (!empty($el_id)) {
					$image_id					= $el_id;
				} else {
					if ($layout == "loupe") {
						$image_id				= 'ts-vcsc-image-magnify-' . $randomizer;
					} else if ($layout == "buttons") {
						$image_id				= 'ts-vcsc-image-zoomer-' . $randomizer;
					}
				}
			
				
				$small_image					= wp_get_attachment_image_src($image, $image_thumb);
				$full_image						= wp_get_attachment_image_src($image, $image_zoom);
				
				$dimensions_x					= (isset($full_image[1]) ? $full_image[1] : 1);
				$dimensions_y					= (isset($full_image[2]) ? $full_image[2] : 1);
				
				$full_background				= "background: #34383f url('" . $full_image[0] . "') top left no-repeat;";
				$image_extension 				= pathinfo($small_image[0], PATHINFO_EXTENSION);
				
				if ($dimensions_x < $dimensions_y) {
					$image_adjust				= "width: auto; max-height: 100%; height: 100%;";
					$aspect						= "tall";
				} else {
					$image_adjust				= "width: 100%; max-width: 100%; height: auto;";
					$aspect						= "wide";
				}
				$image_ratio					= ($dimensions_x / $dimensions_y);
				
				if ($layout == "buttons") {
					if ($background_type == "pattern") {
						$background_style		= 'background: url(' . $background_pattern . ') repeat;';
					} else if ($background_type == "color") {
						$background_style		= 'background-color: ' . $background_color .';';
					} else if ($background_type == "image") {
						$background_image		= wp_get_attachment_image_src($background_image, 'full');
						$background_image		= $background_image[0];
						$background_style		= 'background: url(' . $background_image . ') ' . $background_repeat . ' 0 0; background-size: ' . $background_size . ';';
					}		
				}
				
				if ($attribute_alt == "true") {
					$alt_attribute				= $attribute_alt_value;
				} else {
					$alt_attribute				= basename($full_image[0], "." . $image_extension);
				}
				
				// Custom Width / Height
				$lightbox_dimensions			= '';
				
				if ($lightbox_backlight == "auto") {
					$nacho_color				= 'data-color=""';
				} else if ($lightbox_backlight == "custom") {
					$nacho_color				= 'data-color="' . $lightbox_backlight_color . '"';
				} else if ($lightbox_backlight == "hideit") {
					$nacho_color				= 'data-color="rgba(0, 0, 0, 0)"';
				}
				
				// Loupe Classes
				if ($zoom_shadow == "true") {
					$loupeclasses				.= ' ts-image-magnify-glass-shadow';
				}
				if ($zoom_border == "true") {
					$loupeclasses				.= ' ts-image-magnify-glass-border';
				}
				
				// Text Strings
				if ($layout == "loupe") {
					$text_strings				= 'data-string-changelevel="' . $string_changelevel . '" data-string-lightbox="' . $string_lightbox . '"';
				} else if ($layout == "buttons") {
					$text_strings				= 'data-string-zoomin="' . $string_zoomin . '" data-string-zoomout="' . $string_zoomout . '" data-string-zoomlevel="' . $string_zoomlevel . '" data-string-next="' . $string_next . '" data-string-previous="' . $string_previous . '" data-string-reset="' . $string_reset . '" data-string-rotate="' . $string_rotate . '" data-string-lightbox="' . $string_lightbox . '"';
				} else {
					$text_strings				= '';
				}
		
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 					= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Image_Magnify', $atts);
				} else {
					$css_class					= '';
				}
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					if ($layout == "loupe") {
						$output .= '<div id="' . $image_id . '" class="ts-image-magnify-container ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;" data-zoomeffect="' . $zoom_effect . '" data-zoomstartx="' . $zoom_x . '" data-zoomstarty="' . $zoom_y . '" data-zoomrestore="' . $zoom_restore . '" data-zoomtimeout="' . $zoom_timeout . '" data-zoomlevel="' . ($zoom_level / 100) . '" data-zoomrange="' . $zoom_range . '" data-zoomsize="' . $zoom_size . '" data-zoomcircle="' . $zoom_circle . '" data-zoomdrag="' . $zoom_drag . '" data-zoomreflect="' . $zoom_reflect . '" data-zoomshow="' . $zoom_show . '" data-zoomoutside="' . $zoom_outside . '" data-zoommouse="' . $zoom_mouse . '" data-zoomwheel="' . $zoom_wheel . '" data-zoompinch="' . $zoom_pinch . '" ' . $text_strings . '>';
							if (isset($full_image[0])) {
								if ($zoom_lightbox == "true") {
									$output .= '<a id="' . $image_id . '-trigger" href="' . (isset($full_image[0]) ? $full_image[0] : '') . '" title="' . $string_lightbox . '" class="ts-image-magnify-link ' . $image_id . '-parent nch-holder kraut-lightbox-media no-ajaxy" ' . $lightbox_dimensions . ' style="" data-title="' . $attribute_title . '" rel="' . ($lightbox_group == "true" ? "krautgroup" : $lightbox_group_name) . '" data-effect="' . $lightbox_effect . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '></a>';
								}
								if ($zoom_range == "true") {
									$output .= '<div class="ts-image-magnify-scale" title="' . $string_changelevel . '"></div>';
									$output .= '<input class="ts-image-magnify-range" type="range" min="1" max="10" step="0.1" value="">';
								}
								$output .= '<div class="ts-image-magnify-glass ' . $loupeclasses . '" style="' . $full_background . ' width: ' . $zoom_size . 'px; height: ' . $zoom_size . 'px;" data-zoom="' . ($zoom_level / 100) . '"><div class="ts-image-magnify-zoomed">';
									if ($zoom_note == "true") {
										$output .= '<span class="ts-image-magnify-level"></span>';
									}
								$output .= '</div></div>';
								$output .= '<img class="ts-image-magnify-preview ts-image-magnify-' . $zoom_effect . '" data-no-lazy="1" src="' . $small_image[0] . '" alt="' . $alt_attribute . '"/>';
							} else {
								$output .= '<div style="text-align: justify; color: red; font-weight: bold;">' . __("ERROR: Please assign a valid image to the element.", "ts_visual_composer_extend") . '</div>';
							}
						$output .= '</div>';
					}
					if ($layout == "buttons") {
						$output .= '<div id="' . $image_id . '" class="ts-image-zoomer-container ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;" data-width="' . $dimensions_x . '" data-height="' . $dimensions_y . '" data-aspect="' . $aspect . '" data-ratio="' . $image_ratio . '" data-position="' . $zoom_controls . '" data-scale="' . $zoom_scale . '" data-reset="' . $zoom_reset . '" data-rotate="' . $zoom_rotate . '" data-lightbox="' . $zoom_lightbox . '" ' . $text_strings . '>';
							if (isset($full_image[0])) {
								if ($zoom_lightbox == "true") {
									$output .= '<a id="' . $image_id . '-trigger" href="' . (isset($full_image[0]) ? $full_image[0] : '') . '" class="ts-image-zoomer-link ' . $image_id . '-parent nch-holder kraut-lightbox-media no-ajaxy" ' . $lightbox_dimensions . ' style="display: none;" data-title="' . $attribute_title . '" rel="' . ($lightbox_group == "true" ? "krautgroup" : $lightbox_group_name) . '" data-effect="' . $lightbox_effect . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '"></a>';
								}
								$output .= '<img class="ts-image-zoomer-holder" src="' . (isset($full_image[0]) ? $full_image[0] : '') . '" data-no-lazy="1" style="display: none; ' . $image_adjust . '" alt="' . $alt_attribute . '">';
								$output .= '<div class="ts-image-zoomer-viewer" style="' . $background_style . '">';
									$output .= '<img class="ts-image-zoomer-preview" src="' . (isset($full_image[0]) ? $full_image[0] : '') . '" alt="' . $alt_attribute . '" style="display: none; ' . $image_adjust . '" data-reset="' . $zoom_reset . '" data-rotate="' . $zoom_rotate . '" data-lightbox="' . $zoom_lightbox . '" data-trigger="' . $image_id . '-trigger">';
								$output .= '</div>';
							} else {
								$output .= '<div style="text-align: justify; color: red; font-weight: bold;">' . __("ERROR: Please assign a valid image to the element.", "ts_visual_composer_extend") . '</div>';
							}
						$output .= '</div>';
					}
				} else {
					$output .= '<div id="' . $image_id . '" class="ts-image-zoomer-edit ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; padding: 0; width: 100%; height: 100%;">';
						$output .= '<div style="text-align: justify; display: block; margin-bottom: 10px; font-style: italic;">' . __("Image Magnify or Zoom effects and controls are not available in front end editor mode.", "ts_visual_composer_extend") . '</div>';
						if ($layout == "loupe") {
							$output .= '<div style="text-align: justify; display: block; margin-bottom: 10px;">' . __( "Layout", "ts_visual_composer_extend" ) . ': ' . __("Loupe Layout", "ts_visual_composer_extend") . '</div>';
						} else if ($layout == "buttons") {
							$output .= '<div style="text-align: justify; display: block; margin-bottom: 10px;">' . __( "Layout", "ts_visual_composer_extend" ) . ': ' . __("Zoom Buttons", "ts_visual_composer_extend") . '</div>';
						}
						if (isset($full_image[0])) {
							$output .= '<img class="ts-image-zoomer-edit ts-image-magnify-' . $zoom_effect . '" data-no-lazy="1" src="' . $full_image[0] . '" alt="' . $alt_attribute . '" style="width: 100%; height: auto; margin: 0; padding: 0;"/>';
						} else {
							$output .= '<div style="text-align: justify; color: red; font-weight: bold;">' . __("ERROR: Please assign a valid image to the element.", "ts_visual_composer_extend") . '</div>';
						}
					$output .= '</div>';
				}
				
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
		
			// Add Image Magnify Element
			function TS_VCSC_Add_Image_Magnify_Element() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                      			=> __( "TS Image Magnify", "ts_visual_composer_extend" ),
					"base"                      			=> "TS_VCSC_Image_Magnify",
					"icon" 	                    			=> "ts-composer-element-icon-image-magnify",
					"category"                  			=> __( "Composium", "ts_visual_composer_extend" ),
					"description"               			=> __("Place an image with magnify effect", "ts_visual_composer_extend"),
					"admin_enqueue_js"        				=> "",
					"admin_enqueue_css"       				=> "",
					"params"                    			=> array(
						// Image Settings
						array(
							"type"              			=> "seperator",
							"param_name"        			=> "seperator_1",
							"seperator"         			=> "Image Settings",
						),
						array(
							"type"                  		=> "dropdown",
							"heading"               		=> __( "Layout", "ts_visual_composer_extend" ),
							"param_name"            		=> "layout",
							"width"                 		=> 300,
							"value"                 		=> array (
								__( "Loupe Layout", "ts_visual_composer_extend" )					=> "loupe",
								__( "Zoom Buttons", "ts_visual_composer_extend" )					=> "buttons",
							),
							"admin_label"           		=> true,
							"description"           		=> __( "Select the general layout for the magnify effect.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  		=> "attach_image",
							"holder" 						=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? "img" : ""),
							"heading"               		=> __( "Image", "ts_visual_composer_extend" ),
							"param_name"            		=> "image",
							"class"							=> "ts_vcsc_holder_image",
							"value"                 		=> "",
							"admin_label"           		=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? false : true),
							"description"           		=> __( "Select the image you want to use for the magnify effect.", "ts_visual_composer_extend" ),
						),			
						array(
							"type"                  		=> "dropdown",
							"heading"              	 		=> __( "Preview Image Size", "ts_visual_composer_extend" ),
							"param_name"            		=> "image_thumb",
							"width"                 		=> 150,
							"value"                 		=> array(
								__( 'Medium Size Image', "ts_visual_composer_extend" )			=> "medium",
								__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
								__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
							),
							"description"           		=> __( "Select which image size based on WordPress settings should be used for the preview image.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),
						array(
							"type"                  		=> "dropdown",
							"heading"               		=> __( "Zoom Image Size", "ts_visual_composer_extend" ),
							"param_name"            		=> "image_zoom",
							"width"                 		=> 150,
							"value"                 		=> array(
								__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
								__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
								__( 'Medium Size Image', "ts_visual_composer_extend" )			=> "medium",
							),
							"admin_label"           		=> true,
							"description"           		=> __( "Select which image size based on WordPress settings should be used for the zoomed image.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              			=> "dropdown",
							"heading"           			=> __( "Background Style", "ts_visual_composer_extend" ),
							"param_name"        			=> "background_type",
							"width"             			=> 300,
							"value"             			=> array(
								__( "Solid Color", "ts_visual_composer_extend" )				=> "color",
								__( "Background Pattern", "ts_visual_composer_extend" )			=> "pattern",
								__( "Custom Image", "ts_visual_composer_extend" )				=> "image",
							),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
							"description"       			=> __( "Select the background type for the zoom container.", "ts_visual_composer_extend" )
						),
						array(
							"type"              			=> "colorpicker",
							"heading"           			=> __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"        			=> "background_color",
							"value"             			=> "#ffffff",
							"description"       			=> __( "Select the background color for the zoom container.", "ts_visual_composer_extend" ),
							"dependency"        			=> array( 'element' => "background_type", 'value' => 'color' )
						),
						array(
							"type"              			=> "background",
							"heading"           			=> __( "Background Pattern", "ts_visual_composer_extend" ),
							"param_name"        			=> "background_pattern",
							"height"             			=> 200,
							"pattern"             			=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Background_List,
							"value"							=> "",
							"encoding"          			=> "false",
							"description"       			=> __( "Select the background pattern for the zoom container.", "ts_visual_composer_extend" ),
							"dependency"        			=> array( 'element' => "background_type", 'value' => 'pattern' )
						),
						array(
							"type"              			=> "attach_image",
							"heading"           			=> __( "Background Image", "ts_visual_composer_extend" ),
							"param_name"        			=> "background_image",
							"value"             			=> "false",
							"description"       			=> __( "Select an image or pattern to be used as background for the icon box.", "ts_visual_composer_extend" ),
							"dependency"        			=> array( 'element' => "background_type", 'value' => 'image' )
						),
						array(
							"type"							=> "dropdown",
							"heading"						=> __( "Background Size", "ts_visual_composer_extend" ),
							"param_name"					=> "background_size",
							"width"							=> 150,
							"value"							=> array(
								__( "Cover", "ts_visual_composer_extend" ) 			=> "cover",
								__( "150%", "ts_visual_composer_extend" )			=> "150%",
								__( "200%", "ts_visual_composer_extend" )			=> "200%",
								__( "Contain", "ts_visual_composer_extend" ) 		=> "contain",
								__( "Initial", "ts_visual_composer_extend" ) 		=> "initial",
								__( "Auto", "ts_visual_composer_extend" ) 			=> "auto",
							),
							"description"					=> __( "Select how the custom background image should be sized.", "ts_visual_composer_extend" ),
							"dependency"        			=> array( 'element' => "background_type", 'value' => 'image' )
						),
						array(
							"type"							=> "dropdown",
							"heading"						=> __( "Background Repeat", "ts_visual_composer_extend" ),
							"param_name"					=> "background_repeat",
							"width"							=> 150,
							"value"							=> array(
								__( "No Repeat", "ts_visual_composer_extend" )		=> "no-repeat",
								__( "Repeat X + Y", "ts_visual_composer_extend" )	=> "repeat",
								__( "Repeat X", "ts_visual_composer_extend" )		=> "repeat-x",
								__( "Repeat Y", "ts_visual_composer_extend" )		=> "repeat-y"
							),
							"description"					=> __( "Select if and how the background image should be repeated.", "ts_visual_composer_extend" ),
							"dependency"        			=> array( 'element' => "background_type", 'value' => 'image' )
						),
						array(
							"type"                  		=> "dropdown",
							"heading"              	 		=> __( "Controls Position", "ts_visual_composer_extend" ),
							"param_name"            		=> "zoom_controls",
							"width"                 		=> 150,
							"value"                 		=> array(
								__( 'Bottom', "ts_visual_composer_extend" )						=> "bottom",
								__( 'Top', "ts_visual_composer_extend" )						=> "top",
								__( 'Left', "ts_visual_composer_extend" )						=> "left",
								__( 'Right', "ts_visual_composer_extend" )						=> "right",
							),
							"description"           		=> __( "Select where the control buttons should be positioned.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
						),
						array(
							"type"                  		=> "dropdown",
							"heading"              	 		=> __( "Preview Image Effect", "ts_visual_composer_extend" ),
							"param_name"            		=> "zoom_effect",
							"width"                 		=> 150,
							"value"                 		=> array(
								__( 'None', "ts_visual_composer_extend" )						=> "none",
								__( 'Grayscale', "ts_visual_composer_extend" )					=> "grayscale",
								__( 'Sepia', "ts_visual_composer_extend" )						=> "sepia",
								__( 'Whitewash', "ts_visual_composer_extend" )					=> "whitewash",
								__( 'Small Blur', "ts_visual_composer_extend" )					=> "blursmall",
								__( 'Medium Blur', "ts_visual_composer_extend" )				=> "blurmedium",
								__( 'Large Blur', "ts_visual_composer_extend" )					=> "blurstrong",
							),
							"description"           		=> __( "Select what CSS3 effect should be applied to the preview image.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),
						array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Allow Zoom Scale Bar", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_range",
							"value"				    		=> "true",
							"description"       			=> __( "Switch the toggle if you want to provide a range / scale control to change the zoom factor.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),	
						array(
							"type"              			=> "switch_button",
							"heading"			    		=> __( "Add Custom ALT Attribute", "ts_visual_composer_extend" ),
							"param_name"		    		=> "attribute_alt",
							"value"				    		=> "false",
							"description"		    		=> __( "Switch the toggle if you want add a custom ALT attribute value, otherwise file name will be set.", "ts_visual_composer_extend" )
						),
						array(
							"type"                  		=> "textfield",
							"heading"               		=> __( "Enter ALT Attribute", "ts_visual_composer_extend" ),
							"param_name"            		=> "attribute_alt_value",
							"value"                 		=> "",
							"description"           		=> __( "Enter a custom value for the ALT attribute for this image.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "attribute_alt", 'value' => 'true' )
						),
						// Loupe Settings
						array(
							"type"              			=> "seperator",
							"param_name"        			=> "seperator_2",
							"seperator"         			=> "Loupe Settings",
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),
						array(
							"type"                  		=> "nouislider",
							"heading"               		=> __( "Initial Zoom Level", "ts_visual_composer_extend" ),
							"param_name"            		=> "zoom_level",
							"value"                 		=> "200",
							"min"                   		=> "100",
							"max"                   		=> "1000",
							"step"                  		=> "1",
							"unit"                  		=> '%',
							"description"           		=> __( "Define the initial zoom level to be used on hover.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),
						array(
							"type"                  		=> "nouislider",
							"heading"               		=> __( "Max. Loupe Size", "ts_visual_composer_extend" ),
							"param_name"            		=> "zoom_size",
							"value"                 		=> "100",
							"min"                   		=> "50",
							"max"                   		=> "250",
							"step"                  		=> "10",
							"unit"                  		=> 'px',
							"description"           		=> __( "Define the maximum size of the loupe (will be resized to 50% of image height, if necessary).", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),				
						array(
							"type"                  		=> "nouislider",
							"heading"               		=> __( "Horizontal Position", "ts_visual_composer_extend" ),
							"param_name"            		=> "zoom_x",
							"value"                 		=> "50",
							"min"                   		=> "0",
							"max"                   		=> "100",
							"step"                  		=> "1",
							"unit"                  		=> '%',
							"description"           		=> __( "Select the initial x-position (horizontal) for the loupe (based on loupe center).", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),
						array(
							"type"                  		=> "nouislider",
							"heading"               		=> __( "Vertical Position", "ts_visual_composer_extend" ),
							"param_name"            		=> "zoom_y",
							"value"                 		=> "50",
							"min"                   		=> "0",
							"max"                   		=> "100",
							"step"                  		=> "1",
							"unit"                  		=> '%',
							"description"           		=> __( "Select the initial y-position (vertical) for the loupe (based on loupe center).", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),				
						array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Move on Drag", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_drag",
							"value"				    		=> "true",
							"description"       			=> __( "Switch the toggle if you want to move the loupe only via drag; otherwise via hover.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),				
						array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Show as Circle", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_circle",
							"value"				    		=> "true",
							"description"       			=> __( "Switch the toggle if you want to show the loupe as circle or square.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),
						array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Reflections", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_reflect",
							"value"				    		=> "false",
							"description"       			=> __( "Switch the toggle if you want to add a reflection effect to the loupe.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),
						array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Show Shadow", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_shadow",
							"value"				    		=> "true",
							"description"       			=> __( "Switch the toggle if you want to add a shadow effect to the loupe.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),
						array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Show Border", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_border",
							"value"				    		=> "true",
							"description"       			=> __( "Switch the toggle if you want to add a border effect to the loupe.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),
						/*array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Always Show Loupe", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_show",
							"value"				    		=> "true",
							"description"       			=> __( "Switch the toggle if you want to always show the loupe over the image.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),*/
						array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Allow Outside", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_outside",
							"value"				    		=> "false",
							"description"       			=> __( "Switch the toggle if you want to allow the loupe to be moved outside of the image frame.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),				
			
						array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Allow Mousewheel", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_mouse",
							"value"				    		=> "false",
							"description"       			=> __( "Switch the toggle if you want to allow the mousewheel to increase / decrease the zoom factor; will disable page scroll while hovering over image.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),
						array(
							"type"                  		=> "nouislider",
							"heading"               		=> __( "Mousewheel Factor", "ts_visual_composer_extend" ),
							"param_name"            		=> "zoom_wheel",
							"value"                 		=> "10",
							"min"                   		=> "10",
							"max"                   		=> "100",
							"step"                  		=> "10",
							"unit"                  		=> '%',
							"description"           		=> __( "Define the factor by which the mousewheel should increase / decrease the zoom factor.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "zoom_mouse", 'value' => 'true' )
						),
						array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Allow Pinch Zoom", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_pinch",
							"value"				    		=> "false",
							"description"       			=> __( "Switch the toggle if you want to allow for pinch zooming of the loupe on touch devices.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
						),
						// Controlbar Settings
						array(
							"type"              			=> "seperator",
							"param_name"        			=> "seperator_3",
							"seperator"         			=> "Controlbar Settings",
							"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
						),
						array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Show Reset Button", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_reset",
							"value"				    		=> "true",
							"description"       			=> __( "Switch the toggle if you want to show a reset button in the control bar.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
						),				
						array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Show Zoom Level", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_scale",
							"value"				    		=> "true",
							"description"       			=> __( "Switch the toggle if you want to show the zoom scale in the control bar.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
						),
						array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Show Rotate Button", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_rotate",
							"value"				    		=> "false",
							"description"       			=> __( "Switch the toggle if you want to show a rotate button in the control bar.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
						),
						// Lightbox Settings
						array(
							"type"                  		=> "seperator",
							"param_name"            		=> "seperator_4",
							"seperator"                 	=> "Lightbox Settings",
							"group" 						=> "Lightbox Settings",
						),
						array(
							"type"             	 			=> "switch_button",
							"heading"			    		=> __( "Allow Lightbox", "ts_visual_composer_extend" ),
							"param_name"		    		=> "zoom_lightbox",
							"value"				    		=> "true",
							"description"       			=> __( "Switch the toggle if you want to open the full size image in a lightbox upon click.", "ts_visual_composer_extend" ),
							"group" 						=> "Lightbox Settings",
						),
						array(
							"type"                  		=> "textfield",
							"heading"               		=> __( "Enter TITLE Attribute", "ts_visual_composer_extend" ),
							"param_name"            		=> "attribute_title",
							"value"                 		=> "",
							"description"           		=> __( "Enter a title for the lightbox image.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "zoom_lightbox", 'value' => 'true' ),
							"group" 						=> "Lightbox Settings",
						),
						array(
							"type"              			=> "switch_button",
							"heading"			    		=> __( "Create AutoGroup", "ts_visual_composer_extend" ),
							"param_name"		    		=> "lightbox_group",
							"value"				    		=> "true",
							"description"		    		=> __( "Switch the toggle if you want the plugin to group this image with all other non-gallery images on the page.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "zoom_lightbox", 'value' => 'true' ),
							"group" 						=> "Lightbox Settings",
						),
						array(
							"type"                  		=> "textfield",
							"heading"               		=> __( "Group Name", "ts_visual_composer_extend" ),
							"param_name"            		=> "lightbox_group_name",
							"value"                 		=> "",
							"description"           		=> __( "Enter a custom group name to manually build group with other non-gallery items.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "lightbox_group", 'value' => 'false' ),
							"group" 						=> "Lightbox Settings",
						),
						array(
							"type"                  		=> "dropdown",
							"heading"               		=> __( "Transition Effect", "ts_visual_composer_extend" ),
							"param_name"           		 	=> "lightbox_effect",
							"width"                 		=> 150,
							"value"                 		=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Animations,
							"default" 						=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxDefaultAnimation,
							"std" 							=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxDefaultAnimation,
							"admin_label"           		=> true,
							"description"           		=> __( "Select the transition effect to be used for the image in the lightbox.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "zoom_lightbox", 'value' => 'true' ),
							"group" 						=> "Lightbox Settings",
						),
						array(
							"type"                  		=> "dropdown",
							"heading"               		=> __( "Backlight Effect", "ts_visual_composer_extend" ),
							"param_name"            		=> "lightbox_backlight",
							"width"                 		=> 150,
							"value"                 		=> array(
								__( 'Auto Color', "ts_visual_composer_extend" )       											=> "auto",
								__( 'Custom Color', "ts_visual_composer_extend" )     											=> "custom",
								__( 'Transparent Backlight', "ts_visual_composer_extend" )     	=> "hideit",
							),
							"admin_label"           		=> true,
							"description"           		=> __( "Select the backlight effect for the image.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "zoom_lightbox", 'value' => 'true' ),
							"group" 						=> "Lightbox Settings",
						),
						array(
							"type"                  		=> "colorpicker",
							"heading"               		=> __( "Custom Backlight Color", "ts_visual_composer_extend" ),
							"param_name"            		=> "lightbox_backlight_color",
							"value"                 		=> "#ffffff",
							"description"           		=> __( "Define the backlight color for the lightbox image.", "ts_visual_composer_extend" ),
							"dependency"            		=> array( 'element' => "lightbox_backlight", 'value' => 'custom' ),
							"group" 						=> "Lightbox Settings",
						),
						// Text String Settings
						array(
							"type"                  		=> "seperator",
							"param_name"            		=> "seperator_5",
							"seperator"						=> "Text Strings",
							"group" 						=> "Text Strings",
						),
						array(
							"type"              			=> "messenger",
							"param_name"        			=> "messenger",
							"layout"						=> "notice",
							"level"							=> "warning",
							"size"							=> "13",
							"message"						=> __( "If the default text strings as defined through the plugin's settings page need to be changed for this element in particular, please use the provided options below to do so.", "ts_visual_composer_extend" ),
							"group" 						=> "Text Strings",
						),
						array(
							"type"                  		=> "textfield",
							"heading"               		=> __( "'Change Zoom Level'", "ts_visual_composer_extend" ),
							"param_name"            		=> "string_changelevel",
							"value"                 		=> ((array_key_exists('ChangeLevel', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['ChangeLevel'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['ChangeLevel']),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
							"group" 						=> "Text Strings",
						),
						array(
							"type"                  		=> "textfield",
							"heading"               		=> __( "'Show Image in Lightbox'", "ts_visual_composer_extend" ),
							"param_name"            		=> "string_lightbox",
							"value"                 		=> ((array_key_exists('Lightbox', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['Lightbox'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['Lightbox']),
							"dependency"            		=> array( 'element' => "layout", 'value' => array('loupe', 'buttons') ),
							"group" 						=> "Text Strings",
						),
						array(
							"type"                  		=> "textfield",
							"heading"               		=> __( "'Zoom In'", "ts_visual_composer_extend" ),
							"param_name"            		=> "string_zoomin",
							"value"                 		=> ((array_key_exists('ZoomIn', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['ZoomIn'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['ZoomIn']),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
							"group" 						=> "Text Strings",
						),
						array(
							"type"                  		=> "textfield",
							"heading"               		=> __( "'Zoom Out'", "ts_visual_composer_extend" ),
							"param_name"            		=> "string_zoomout",
							"value"                 		=> ((array_key_exists('ZoomOut', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['ZoomOut'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['ZoomOut']),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
							"group" 						=> "Text Strings",
						),
						array(
							"type"                  		=> "textfield",
							"heading"               		=> __( "'Zoom Level'", "ts_visual_composer_extend" ),
							"param_name"            		=> "string_zoomlevel",
							"value"                 		=> ((array_key_exists('ZoomLevel', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['ZoomLevel'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['ZoomLevel']),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
							"group" 						=> "Text Strings",
						),
						array(
							"type"                  		=> "textfield",
							"heading"               		=> __( "'Reset Zoom'", "ts_visual_composer_extend" ),
							"param_name"            		=> "string_reset",
							"value"                 		=> ((array_key_exists('Reset', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['Reset'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['Reset']),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
							"group" 						=> "Text Strings",
						),
						array(
							"type"                  		=> "textfield",
							"heading"               		=> __( "'Rotate Image'", "ts_visual_composer_extend" ),
							"param_name"            		=> "string_rotate",
							"value"                 		=> ((array_key_exists('Rotate', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['Rotate'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['Rotate']),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
							"group" 						=> "Text Strings",
						),
						/*array(
							"type"                  		=> "textfield",
							"heading"               		=> __( "'Next'", "ts_visual_composer_extend" ),
							"param_name"            		=> "string_next",
							"value"                 		=> ((array_key_exists('Next', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['Next'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['Next']),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
							"group" 						=> "Text Strings",
						),
						array(
							"type"                  		=> "textfield",
							"heading"               		=> __( "'Previous'", "ts_visual_composer_extend" ),
							"param_name"            		=> "string_previous",
							"value"                 		=> ((array_key_exists('Previous', $this->TS_VCSC_Magnify_Language)) ? $this->TS_VCSC_Magnify_Language['Previous'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults['Previous']),
							"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
							"group" 						=> "Text Strings",
						),*/
						// Other Settings
						array(
							"type"                  		=> "seperator",
							"param_name"            		=> "seperator_6",
							"seperator"                 	=> "Other Settings",
							"group" 						=> "Other Settings",
						),
						array(
							"type"                  		=> "nouislider",
							"heading"               		=> __( "Margin: Top", "ts_visual_composer_extend" ),
							"param_name"            		=> "margin_top",
							"value"                 		=> "0",
							"min"                   		=> "0",
							"max"                   		=> "200",
							"step"                  		=> "1",
							"unit"                  		=> 'px',
							"description"           		=> __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
							"group" 						=> "Other Settings",
						),
						array(
							"type"                  		=> "nouislider",
							"heading"               		=> __( "Margin: Bottom", "ts_visual_composer_extend" ),
							"param_name"            		=> "margin_bottom",
							"value"                 			=> "0",
							"min"                   		=> "0",
							"max"                   		=> "200",
							"step"                  		=> "1",
							"unit"                  		=> 'px',
							"description"           		=> __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
							"group" 						=> "Other Settings",
						),
						array(
							"type"                  		=> "textfield",
							"heading"               		=> __( "Define ID Name", "ts_visual_composer_extend" ),
							"param_name"            		=> "el_id",
							"value"                 		=> "",
							"description"           		=> __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
							"group" 						=> "Other Settings",
						),
						array(
							"type"                  		=> "tag_editor",
							"heading"           			=> __( "Extra Class Names", "ts_visual_composer_extend" ),
							"param_name"            		=> "el_class",
							"value"                 		=> "",
							"description"      				=> __( "Enter additional class names for the element.", "ts_visual_composer_extend" ),
							"group" 						=> "Other Settings",
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
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Image_Magnify'))) {
		class WPBakeryShortCode_TS_VCSC_Image_Magnify extends WPBakeryShortCode {};
	}
	// Initialize "TS Image Magnify" Class
	if (class_exists('TS_Image_Magnify')) {
		$TS_Image_Magnify = new TS_Image_Magnify;
	}
?>