<?php
	if (!class_exists('TS_Image_Galleries')){
		class TS_Image_Galleries {
			function __construct() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						$this->TS_VCSC_Add_Lightbox_Gallery_Lean();
					} else if (function_exists('vc_map')) {
						add_action('init',                                  array($this, 'TS_VCSC_Add_Lightbox_Gallery_Elements'), 9999999);
					}
				} else {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Lightbox_Gallery_Lean'), 9999999);
					} else if (function_exists('vc_map')) {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Lightbox_Gallery_Elements'), 9999999);
					}
				}
				if ((is_admin() == false) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAJAX == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAlways == "true")) {
					add_shortcode('TS_VCSC_Lightbox_Gallery',				array($this, 'TS_VCSC_Lightbox_Gallery_Standalone'));
				}
			}
			
			// Register Element(s) via LeanMap
			function TS_VCSC_Add_Lightbox_Gallery_Lean() {
				vc_lean_map('TS_VCSC_Lightbox_Gallery',						array($this, 'TS_VCSC_Add_Lightbox_Gallery_Elements'), null);
			}
			
			// Function to create Array with Image Data
			function TS_VCSC_LightboxGridImageDataArray($i, $p, $t, $a, $g, $l) {
				return array('image' => (!empty($i) ? $i : ""), 'preview' => (!empty($p) ? $p : (!empty($i) ? $i : "")), 'title' => (!empty($t) ? $t : ""), 'alt' => (!empty($a) ? $a : ""), 'groups' => (!empty($g) ? $g : ""), 'links' => (!empty($l) ? $l : ""), 'lightbox' => (!empty($t) ? $t : ""), 'data_preview' => '', 'data_lightboxfull' => '', 'data_lightboxthumb' => '', 'data_wordpressthumb' => '');
			}
			
			// Standalone Lightbox Gallery
			function TS_VCSC_Lightbox_Gallery_Standalone ($atts, $content = null) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
				
				extract( shortcode_atts( array(
					'content_style'				=> 'Grid',
					'content_linkstyle'			=> 'lightbox',
					'content_title'				=> '',
					'content_preloader'			=> 0,
					'title_wrapper'				=> 'div',
					'content_trigger_image'		=> '',
					'content_trigger_title'		=> '',
		
					'content_external'			=> 'false',
					'content_alternate'			=> 'false',
					'content_previews'			=> '',
					'content_images'			=> '',
					'content_paths_previews'	=> '',
					'content_paths_images'		=> '',
					'content_images_titledata'	=> 'custom',
					'content_images_titles'		=> '',
					'content_images_altdata'	=> 'true',
					'content_images_alts'		=> '',
					'content_images_groups'		=> '',
					'content_images_links'		=> '',
					'content_images_size'		=> 'medium',
					'content_images_width'		=> 1280,
					'content_images_height'		=> 720,
					
					'filters_available'			=> 'Available Groups',
					'filters_selected'			=> 'Filtered Groups',
					'filters_nogroups'			=> 'No Groups',
					'filters_toggle'			=> 'Toggle Filter',
					'filters_toggle_style'		=> 'ts-color-button-belize-hole-flat',
					'filters_showall'			=> 'Show All',
					'filters_showall_style'		=> 'ts-color-button-green-sea-flat',
					
					'trigger_grayscale'			=> 'false',
					
					'thumbnail_position'		=> 'bottom',
					'thumbnail_height'			=> 100,
					'thumbnail_size'			=> 'match',
					'thumbnail_custom_width'	=> 100,
					'thumbnail_custom_height'	=> 100,
					
					'lightbox_title'			=> 'overlay',
					'lightbox_size'				=> 'full',
					'lightbox_effect'			=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxDefaultAnimation,
					'lightbox_pageload'			=> 'false',
					'lightbox_autooption'		=> 'true',
					'lightbox_autoplay'			=> 'false',
					'lightbox_save'				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxSaveImages,
					'lightbox_speed'			=> 5000,
					'lightbox_social'			=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxSocialShare,
					'lightbox_nohashes'			=> 'true',
					'lightbox_backlight'		=> 'auto',
					'lightbox_backlight_color'	=> '#ffffff',
					'lightbox_usecors'			=> 'global',
					
					'fullwidth'					=> 'false',
					'breakouts'					=> 6,

					'data_grid_preloader'		=> -1,
					'data_grid_breaks'			=> '240,480,720,960',
					'data_grid_space'			=> 2,
					'data_grid_order'			=> 'false',
					'data_grid_shuffle'			=> 'false',
					'data_grid_limit'			=> 0,
					
					'honeycombs_layout'			=> 'flat',
					'honeycombs_breaks'			=> '1280,960,640',
					'honeycombs_sizes'			=> '340,250,180,100',
					'honeycombs_tooltips'		=> 'true',
					'honeycombs_rotate'			=> 'true',
					
					'freewall_width'			=> 250,
					'freewall_shuffle'			=> 'false',
		
					'slickmain_lazyload'		=> 'false',
					'slickmain_vertical'		=> 'false',
					'slickmain_singlemode'		=> 'singlenone', 		// singlefade, singleroll, singlenone ... only if slick_thumbnails => nothumbs
					'slickmain_scrollitems'		=> 'single', 			// single, visible ... only if slick_singlemode => singlenone
					'slickmain_centermode'		=> 'false',				// only if slick_scrollitems => single
					'slickmain_initialitem'		=> 0,					//
					'slickmain_maxitems'		=> 3,					// only if slick_singlemode => singlenone
					'slickmain_spacing'			=> 0,					// only if slick_singlemode => singlenone
					'slickmain_breakpoints'		=> '1024/2,480/1',		// only if slick_singlemode => singlenone						
					'slickmain_infinite'		=> 'true',
					'slickmain_graylayer'		=> 'true',
					'slickmain_theme'			=> 'dark',
					'slickmain_wingshow'		=> 'true',				// only if slick_singlemode => singlenone or singleroll
					'slickmain_wingwidth'		=> 6,
					'slickmain_bullets'			=> 'true',				//
					'slickmain_autoplay'		=> 'false',				//
					'slickmain_interval'		=> 4000,				//
					'slickmain_rtlmode'			=> 'false',				//
					'slickmain_limituse'		=> 'false',
					'slickmain_limitcount'		=> 8,
					'slickthumb_distance'		=> 10,
					'slickthumb_position'		=> 'thumbsbottom',		// thumbstop, thumbsbottom
					'slickthumb_centermode'		=> 'false',
					'slickthumb_maxitems' 		=> 8,
					'slickthumb_spacing'		=> 0,
					'slickthumb_singlemode'		=> 'singleroll', 		// singlefade, singleroll
					'slickthumb_breakpoints'	=> '1440/10,1280/8,1024/7,960/6,768/5,640/4,480/3,240/2',
		
					'number_images'				=> 1,
					'slide_margin'				=> 10,
					'break_custom'				=> 'false',
					'break_string'				=> '1,2,3,4,5,6,7,8',
					'auto_height'				=> 'true',
					'page_rtl'					=> 'false',
					'auto_play'					=> 'false',
					'show_playpause'			=> 'true',
					'slide_show'				=> 'false',
					'show_bar'					=> 'true',
					'bar_color'					=> '#dd3333',
					'show_speed'				=> 5000,
					'stop_hover'				=> 'true',
					'show_navigation'			=> 'true',
					'dot_navigation'			=> 'true',
					'page_numbers'				=> 'false',
					'items_loop'				=> 'false',				
					'animation_in'				=> 'ts-viewport-css-flipInX',
					'animation_out'				=> 'ts-viewport-css-slideOutDown',
					'animation_mobile'			=> 'false',
					
					'stack_speed'				=> 600,
					'stack_piles'				=> 'true',
					
					'nivo_effect'				=> 'random',
					'nivo_slices'				=> 15,
					'nivo_columns'				=> 8,
					'nivo_rows'					=> 4,
					'nivo_start'				=> 0,
					'nivo_random'				=> 'false',
					'nivo_lazy'					=> 'false',
					
					'flex_animation'			=> 'slide',
					'flex_scroll_thumbs'		=> 'true',
					'flex_scroll_single'		=> 'true',
					'flex_margin'				=> 0,
					'flex_position'				=> 'bottom',
					'flex_border_width'			=> 5,				
					'flex_breaks_thumbs'		=> '200,400,600,800,1000,1200,1400,1600,1800',
					'flex_breaks_single'		=> '240,480,720,960,1280,1600,1980',
					
					'flex_border_color'			=> "#ffffff",
					'flex_background'			=> "#ffffff",
					
					'pagawa_style'				=> 'light',
					'pagawa_animation'			=> 'sliding',
					'pagawa_transition'			=> 500,
					'pagawa_thumbnails'			=> 'true',
					'pagawa_position'			=> 'bottom',
					'pagawa_height'				=> 0,
					'pagawa_break'				=> 480,
					'pagawa_touch'				=> 'true',
					'pagawa_autoplay'			=> 'false',
					'pagawa_interval'			=> 5000,
					'pagawa_hover'				=> 'true',
					'pagawa_titles'				=> 'true',
					
					'polaroid_reversal'			=> 'true',
					'polaroid_whitespace'		=> 20,
					'polaroid_margin'			=> 20,
					'polaroid_maxheight'		=> 800,
					'polaroid_visible'			=> 4,
					'polaroid_counter'			=> 'true',
					'polaroid_position'			=> 'topright',
					'polaroid_layout'			=> 'horizontalRight',
					'polaroid_alignment'		=> 'topcenter',
					'polaroid_fullsize'			=> 'true',
					'polaroid_rotation'			=> 'true',
					'polaroid_autostart'		=> 'false',
					'polaroid_delay'			=> 3000,
					
					'flipster_style'			=> 'coverflow',			// coverflow|carousel|flat|wheel
					'flipster_grayout'			=> 'false',
					'flipster_mirror'			=> 'true',
					'flipster_start'			=> 1,
					'flipster_limit'			=> 0,
					'flipster_loop'				=> 'true',
					'flipster_click'			=> 'true',
					'flipster_touch'			=> 'true',
					'flipster_mouse'			=> 'false',
					'flipster_keyboard'			=> 'true',
					'flipster_arrows'			=> 'true',
					'flipster_navigation'		=> 'false',				// false, before, after
					'flipster_autoplay'			=> 'false',
					'flipster_speed'			=> 2000,
					'flipster_maxwidth'			=> 320,
					'flipster_coverflow'		=> -60,
					'flipster_carousel'			=> -45,
					'flipster_flatline'			=> -30,
					'flipster_wheel'			=> -5,
					
					'flex_tooltipthumbs'		=> "false",				
					'slice_tooltipthumbs'		=> "none",
					'tooltipster_theme'			=> 'ts-simptip-style-black',
					'tooltipster_position'		=> 'ts-simptip-position-top',
					'tooltipster_animation'		=> 'swing',
					'tooltipster_offsetx'		=> 0,
					'tooltipster_offsety'		=> 0,
					
					'content_wpautop'			=> 'true',
					
					'margin_top'				=> 0,
					'margin_bottom'				=> 0,
					'el_id'						=> '',
					'el_class'					=> '',
					'css'						=> '',
				), $atts ));
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					wp_enqueue_style('ts-extend-animations');								
					wp_enqueue_script('ts-visual-composer-extend-galleries');
					wp_enqueue_style('ts-visual-composer-extend-front');
					wp_enqueue_script('ts-visual-composer-extend-front');
				} else {
					wp_enqueue_style('ts-visual-composer-extend-front');
				}
		
				$randomizer						= mt_rand(999999, 9999999);
				$wpautop 						= ($content_wpautop == "true" ? true : false);
			
				if (!empty($el_id)) {
					$modal_id					= $el_id;
					$nacho_group				= 'krautgroup' . $randomizer;
				} else {
					$modal_id					= 'ts-vcsc-image-gallery-' . $randomizer;
					$nacho_group				= 'krautgroup' . $randomizer;
				}
				
				// Turn Photon Off (For Correct Image Information)
				$photon_removed 				= '';
				if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_JetpackPhoton_Active == "true") && ((strtolower($content_style) == "polaroid"))) {
					$photon_removed 			= remove_filter('image_downsize', array(Jetpack_Photon::instance(), 'filter_image_downsize'));
				}
				
				// Adjust Backlight for Jetpack Photon
				if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_JetpackPhoton_Active == "true") && ($lightbox_backlight == "auto")) {
					$lightbox_backlight			= 'hideit';
				}
				
				// Tooltip Adjustments
				$tooltipster_position			= TS_VCSC_TooltipMigratePosition($tooltipster_position);
				
				// Build String for Gallery Type
				if ($content_style == "Grid") {
					$gallery_type				= __( 'Rectangle Grid of all Images', "ts_visual_composer_extend" );
				} else if ($content_style == "Freewall") {
					$gallery_type				= __( 'Freewall Fluid Grid of all Images', "ts_visual_composer_extend" );
				} else if ($content_style == "Honeycombs") {
					$gallery_type				= __( 'Honeycombs Fluid Grid of all Images', "ts_visual_composer_extend" );
				} else if ($content_style == "First") {
					$gallery_type				= __( 'First Image Only', "ts_visual_composer_extend" );
				} else if ($content_style == "Random") {
					$gallery_type				= __( 'Random Image Only', "ts_visual_composer_extend" );
				} else if ($content_style == "Image") {
					$gallery_type				= __( 'Single Custom Image', "ts_visual_composer_extend" );
				} else if ($content_style == "SlickSingle") {
					$gallery_type				= __( 'Slick Image Slider (No Thumbnails)', "ts_visual_composer_extend" );
				} else if ($content_style == "SlickThumb") {
					$gallery_type				= __( 'Slick Image Slider (With Thumbnails)', "ts_visual_composer_extend" );
				} else if ($content_style == "Slider") {
					$gallery_type				= __( 'Owl Image Slider', "ts_visual_composer_extend" );
				} else if ($content_style == "FlexThumb") {
					$gallery_type				= __( 'Flex Image Slider (With Thumbnails)', "ts_visual_composer_extend" );
				} else if ($content_style == "FlexSingle") {
					$gallery_type				= __( 'Flex Image Slider (No Thumbnails)', "ts_visual_composer_extend" );
				} else if ($content_style == "PWGSlideshow") {
					$gallery_type				= __( 'Pagawa Slideshow', "ts_visual_composer_extend" );
				} else if ($content_style == "NivoSlider") {
					$gallery_type				= __( 'NivoSlider', "ts_visual_composer_extend" );
				} else if ($content_style == "SliceBox") {
					$gallery_type				= __( 'SliceBox Slider', "ts_visual_composer_extend" );
				} else if ($content_style == "Stack") {
					$gallery_type				= __( 'Line Image Stack', "ts_visual_composer_extend" );
				} else if ($content_style == "Polaroid") {
					$gallery_type				= __( 'Polaroid Image Stack', "ts_visual_composer_extend" );
				} else if ($content_style == "Flipster") {
					$gallery_type				= __( 'Flipster Slider', "ts_visual_composer_extend" );
				}
				
				// Check for Front End Editor
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$frontend_message			= '<div class="ts-composer-frontedit-message">' . __( 'The image gallery is currently viewed in front-end editor mode; all gallery features are disabled for performance and compatibility reasons.', "ts_visual_composer_extend" ) . '</div>';
					$frontend_edit				= 'true';
				} else {
					$frontend_message			= '';
					$frontend_edit				= 'false';
				}
				
				// Content: Gallery
				$modal_gallery					= '';
				$modal_thumbs					= '';
				
				// Replace Internal Images With External Ones
				if ($content_external == "true") {
					$content_images				= $content_paths_images;
					$content_previews			= $content_paths_previews;					
				} else {
					$content_images				= $content_images;
					$content_previews			= $content_previews;
				}
	
				// Image and Limitation Adjustments
				if (!empty($content_images)) {
					$count_images 				= substr_count($content_images, ",") + 1;
				} else {
					$count_images				= 0;
				}
				if ($flipster_start > $flipster_limit) {
					$flipster_start 			= $flipster_limit;
				}
				if (($data_grid_limit > $count_images) && (strtolower($content_style) != "flipster")) {
					$data_grid_limit			= 0;
				} else if (($flipster_limit > $count_images) && (strtolower($content_style) == "flipster")) {
					$flipster_limit				= 0;
				}				
				if (!empty($data_grid_breaks)) {
					$data_grid_breaks 			= str_replace(' ', '', $data_grid_breaks);
					$count_columns				= substr_count($data_grid_breaks, ",") + 1;
				} else {
					$count_columns				= 0;
				}
				
				if ((!isset($content_images)) || ($content_images == '')) {
					$content_images				= array();
				} else {
					$content_images				= explode(',', $content_images);
				}
				if ((!isset($content_previews)) || ($content_previews == '')) {
					$content_previews			= array();
				} else {
					$content_previews			= explode(',', $content_previews);
				}
				if ((!isset($content_images_titles)) || ($content_images_titles == '')) {
					$content_images_titles		= array();
				} else {
					$content_images_titles		= explode(',', $content_images_titles);
					$content_images_titles		= TS_VCSC_ConvertPlaceholderComma($content_images_titles);
				}				
				if ((!isset($content_images_alts)) || ($content_images_alts == '')) {
					$content_images_alts		= array();
				} else {
					$content_images_alts		= explode(',', $content_images_alts);
					$content_images_alts		= TS_VCSC_ConvertPlaceholderComma($content_images_alts);
				}				
				if ((!isset($content_images_groups)) || ($content_images_groups == '')) {
					$content_images_groups		= array();
				} else {
					$content_images_groups		= explode(',', $content_images_groups);
					$content_images_groups		= TS_VCSC_ConvertPlaceholderComma($content_images_groups);
				}
				if ((!isset($content_images_links)) || ($content_images_links == '')) {
					$content_images_links		= array();
				} else {
					$content_images_links		= explode(',', $content_images_links);
					$content_images_links		= TS_VCSC_ConvertPlaceholderComma($content_images_links);
				}

				// Create + Check Array with Image Data
				$content_combined 				= array_map(array($this, 'TS_VCSC_LightboxGridImageDataArray'), $content_images, $content_previews, $content_images_titles, $content_images_alts, $content_images_groups, $content_images_links);
				foreach($content_combined as $image => $meta) {
					if ($meta['image'] == '') {
						unset($content_combined[$image]);
					}
				}

				// Add WordPress MetaData for Image Data				
				foreach($content_combined as $image => $meta) {
					if (($content_external == "false") && (($content_images_titledata != "custom") || ($content_images_altdata == "false") || ($lightbox_title != 'overlay'))) {
						$content_meta								= TS_VCSC_GetImageMetaData($meta['image']);						
						// Add Overlay Title Data
						if ($content_images_titledata == "title") {
							$content_combined[$image]['title']		= (isset($content_meta['title']) ? $content_meta['title'] : "");
						} else if ($content_images_titledata == "alt") {
							$content_combined[$image]['title']		= (isset($content_meta['alt']) ? $content_meta['alt'] : "");
						} else if ($content_images_titledata == "caption") {
							$content_combined[$image]['title']		= (isset($content_meta['caption']) ? $content_meta['caption'] : "");
						} else if ($content_images_titledata == "content") {
							$content_combined[$image]['title']		= (isset($content_meta['content']) ? $content_meta['content'] : "");
						}
						// Add Lightbox Title Data
						if ($lightbox_title == "overlay") {
							$content_combined[$image]['lightbox']	= $content_combined[$image]['title'];
						} else if ($lightbox_title == "title") {
							$content_combined[$image]['lightbox']	= (isset($content_meta['title']) ? $content_meta['title'] : "");
						} else if ($lightbox_title == "alt") {
							$content_combined[$image]['lightbox']	= (isset($content_meta['alt']) ? $content_meta['alt'] : "");
						} else if ($lightbox_title == "caption") {
							$content_combined[$image]['lightbox']	= (isset($content_meta['caption']) ? $content_meta['caption'] : "");
						} else if ($lightbox_title == "content") {
							$content_combined[$image]['lightbox']	= (isset($content_meta['content']) ? $content_meta['content'] : "");
						}
						// Add Media ALT Data
						if ($content_images_altdata == "false") {
							$content_combined[$image]['alt']		= (isset($content_meta['alt']) ? $content_meta['alt'] : "");
						}
					}
				}
				
				// Shuffle Image Data Array
				if (((strtolower($content_style) == "grid") && ($data_grid_shuffle == "true") && ($data_grid_order == "false")) || ((strtolower($content_style) == "freewall") && ($freewall_shuffle == 'true')) || ((strtolower($content_style) == "honeycombs") && ($freewall_shuffle == 'true'))) {
					shuffle($content_combined);
				}				
				
				$i 								= -1;
				$k								= -1;
				$b								= 0;
				$output 						= '';
				
				if ($content_images_groups != '') {
					if ($filters_toggle_style != '') {
						wp_enqueue_style('ts-extend-buttonsflat');
					}
					wp_enqueue_style('ts-extend-multiselect');
					wp_enqueue_script('ts-extend-multiselect');
				}
				
				$content_style 					= strtolower($content_style);
				$image_placeholder				= TS_VCSC_GetResourceURL('images/other/image_placeholder_01.jpg');
				
				if ($content_linkstyle != "none") {
					if ($content_linkstyle == "lightbox") {
						if (strtolower($content_style) == "honeycombs") {
							$image_link_class	= "kraut-lightbox-honeycombs no-ajaxy";
						} else if (strtolower($content_style) == "pwgslideshow") {
							$image_link_class	= "kraut-lightbox-pwgslideshow no-ajaxy";
						} else if ((strtolower($content_style) == "slicksingle") || (strtolower($content_style) == "slickthumb")) {
							$image_link_class	= "kraut-lightbox-slickslider no-ajaxy";
						} else {
							$image_link_class	= "kraut-lightbox-media no-ajaxy";
						}
					} else {
						$image_link_class		= "kraut-lightbox-disabled";
					}
					$image_title_class			= "";
				} else {
					$image_link_class			= "kraut-lightbox-disabled";
					$image_title_class			= "krautgrid-nolink";
				}

				if (($data_grid_limit != 0) && (strtolower($content_style) != "flipster")) {
					$nachoLength				= $data_grid_limit - 1;
				} else if (($flipster_limit != 0) && (strtolower($content_style) == "flipster")) {
					$nachoLength				= $flipster_limit - 1;
				} else {
					$nachoLength 				= count($content_combined) - 1;
				}
				
				if ((!empty($content)) && ($content != '')) {
					$nacho_info 				= 'data-info="' . $nacho_group . '-info"';
				} else {
					$nacho_info					= '';
				}
				if ($lightbox_backlight != "auto") {
					if ($lightbox_backlight == "custom") {
						$nacho_color			= 'data-color="' . $lightbox_backlight_color . '" data-nohashes="' . $lightbox_nohashes . '"';
					} else if ($lightbox_backlight == "hideit") {
						$nacho_color			= 'data-color="rgba(0, 0, 0, 0)" data-nohashes="' . $lightbox_nohashes . '"';
					} else if ($lightbox_backlight == "remove") {
						$nacho_color			= 'data-color="remove" data-nohashes="' . $lightbox_nohashes . '"';
					}
				} else {
					$nacho_color				= 'data-nohashes="' . $lightbox_nohashes . '"';
				}
				
				// Retrieve URLs for all Required Image Versions				
				foreach($content_combined as $image => $meta) {
					if ($content_external == "true") {
						$content_combined[$image]['data_preview']				= $meta['preview'];
						$content_combined[$image]['data_lightboxfull']			= $meta['image'];						
						$content_combined[$image]['data_lightboxthumb']			= $meta['preview'];
						$content_combined[$image]['data_wordpressthumb']		= $meta['preview'];
					} else {
						// Lightbox Full Size Image
						$content_combined[$image]['data_lightboxfull']			= wp_get_attachment_image_src(preg_replace('/[^\d]/', '', $meta['image']), $lightbox_size);
						// Gallery Preview Image
						if (($meta['image'] != $meta['preview']) && ($meta['preview'] != '')) {
							if ($content_images_size == 'custom') {
								$content_combined[$image]['data_preview']		= TS_VCSC_CreateCustomImageSize(preg_replace('/[^\d]/', '', $meta['preview']), $content_images_width, $content_images_height);
							} else {
								$content_combined[$image]['data_preview']		= wp_get_attachment_image_src(preg_replace('/[^\d]/', '', $meta['preview']), $content_images_size);
							}							
						} else {
							if (($lightbox_size == $content_images_size) && ($lightbox_size != 'custom')) {
								$content_combined[$image]['data_preview']		= $content_combined[$image]['data_lightboxfull'];
							} else {
								if ($content_images_size == "custom") {
									$content_combined[$image]['data_preview']	= TS_VCSC_CreateCustomImageSize(preg_replace('/[^\d]/', '', $meta['image']), $content_images_width, $content_images_height);
								} else {
									$content_combined[$image]['data_preview']	= wp_get_attachment_image_src(preg_replace('/[^\d]/', '', $meta['image']), $content_images_size);
								}
							}
						}
						// Lightbox Thumbnail Image
						if ((($content_images_size == $thumbnail_size) && ($meta['image'] == $meta['preview']) && ($thumbnail_size != "custom")) || ($thumbnail_size == "match")) {
							$content_combined[$image]['data_lightboxthumb']		= $content_combined[$image]['data_preview'];
						} else if ($thumbnail_size == "custom") {							
							$content_combined[$image]['data_lightboxthumb']		= TS_VCSC_CreateCustomImageSize(preg_replace('/[^\d]/', '', $meta['image']), $thumbnail_custom_width, $thumbnail_custom_height);
						} else {
							$content_combined[$image]['data_lightboxthumb']		= wp_get_attachment_image_src(preg_replace('/[^\d]/', '', $meta['image']), $thumbnail_size);
						}
						// WordPress Thumbnail Image
						$content_combined[$image]['data_wordpressthumb']		= wp_get_attachment_image_src(preg_replace('/[^\d]/', '', $meta['image']), 'thumbnail');
					}
					// Double Check ALT Tag
					if (($content_combined[$image]['alt'] == "") && (isset($content_combined[$image]['data_preview'][0])) && ($content_images_altdata == "false")) {
						$content_path			= TS_VCSC_GetPathInfo($content_combined[$image]['data_preview'][0]);
						$content_combined[$image]['alt']	= (isset($content_path['filename']) ? $content_path['filename'] : "");
					}
					// Check for Missing Images + Remove
					if (($content_external == "false") && ((!isset($content_combined[$image]['data_preview'][0])) || (!isset($content_combined[$image]['data_lightboxfull'][0])))) {
						unset($content_combined[$image]);
					}
				}
				
				// WP Bakery Page Builder Custom Override
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 					= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-image-gallery-wrapper ts-kraut-lightbox-frame ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Lightbox_Gallery', $atts);
				} else {
					$css_class 					= 'ts-image-gallery-wrapper ts-kraut-lightbox-frame ' . $el_class;
				}
				
				if ($frontend_edit == "false") {
					$lightbox_removable						= array('slider', 'flexthumb', 'flexsingle', 'nivoslider', 'slicebox', 'slicksingle', 'slickthumb', 'stack', 'polaroid');
					// Load Lightbox Script
					if ((strtolower($content_style) == "grid") || ((in_array(strtolower($content_style), $lightbox_removable)) && ($content_linkstyle == "lightbox")) || (!in_array(strtolower($content_style), $lightbox_removable))) {
						wp_enqueue_script('ts-extend-krautlightbox');
						wp_enqueue_style('ts-extend-krautlightbox');
					}
					wp_enqueue_style('ts-font-ecommerce');
					// Auto-Grid Layout
					if (strtolower($content_style) == "grid") {
						$fullwidth_allow					= "true";
						$grid_style							= 'width: 20%; height: 100%; display: inline-block; margin: 0; padding: 0;';
						// Grid Preloader
						if ($data_grid_preloader != -1) {
							$modal_gallery .= '<div id="ts-krautlightbox-grid-preloader-' . $randomizer . '" class="ts-lightbox-gallery-grid-preloader">';
								$modal_gallery .= TS_VCSC_CreatePreloaderCSS("ts-lightbox-gallery-grid-preloader-" . $randomizer, "", $data_grid_preloader, "true");
							$modal_gallery .= '</div>';
						}
						// Grid Gallery
						$modal_gallery .= '<div id="' . $modal_id . '-grid" class="ts-lightbox-gallery-grid">';
							foreach($content_combined as $image => $meta) {
								$i++;
								if (($data_grid_limit != 0) && ($i > ($data_grid_limit - 1))) {
									$i						= ($data_grid_limit - 1);
									break;
								}
								if ($content_external == "true") {
									$modal_image			= $meta['data_lightboxfull'];
									$preview_thumb			= $meta['data_preview'];
									$modal_thumb			= $meta['data_lightboxthumb'];
								} else {
									$preview_thumb 			= $meta['data_preview'][0];
									$modal_image 			= $meta['data_lightboxfull'][0];
									$modal_thumb 			= $meta['data_lightboxthumb'][0];
								}
								if ($i == $nachoLength) {
									if (($count_images < $count_columns) || (($data_grid_limit != 0) && ($data_grid_limit < $count_columns))) {
										$data_grid_string	= explode(',', $data_grid_breaks);
										$data_grid_breaks	= array();
										if (($data_grid_limit != 0) && ($data_grid_limit < $count_columns)) {
											foreach ($data_grid_string as $single_break) {
												$b++;
												if ($b <= $data_grid_limit) {
													array_push($data_grid_breaks, $single_break);
												} else {
													break;
												}
											}
										} else {
											foreach ($data_grid_string as $single_break) {
												$b++;
												if ($b <= $count_images) {
													array_push($data_grid_breaks, $single_break);
												} else {
													break;
												}
											}
										}
										$data_grid_breaks	= implode(",", $data_grid_breaks);
									} else {
										$data_grid_breaks 	= $data_grid_breaks;
									}
									$modal_gallery .= '<a style="' . $grid_style . '; display: none;" id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-preview="' . $preview_thumb . '" data-thumbnail="' . $modal_thumb . '" data-random="' . $randomizer . '" data-include="true" data-hover="' . (!empty($meta['title']) ? $meta['title'] : "") . '" data-alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" data-groups="' . (!empty($meta['groups']) ? (str_replace('/', ',', $meta['groups'])) : "") . '" class="kraut-lightbox-media no-ajaxy ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . ' data-captions="true" data-grid="' . $data_grid_breaks . '" data-gridpreloader="' . ($data_grid_preloader != -1 ? "true" : "false") . '" data-gridspace="' . $data_grid_space . '" data-gridorder="' . $data_grid_order . '" data-gridfilter="true" data-gridavailable="' . $filters_available . '" data-gridselected="' . $filters_selected . '" data-gridnogroups="' . $filters_nogroups . '" data-gridtoggle="' . $filters_toggle . '" data-gridtogglestyle="' . $filters_toggle_style . '" data-gridshowall="' . $filters_showall . '" data-gridshowallstyle="' . $filters_showall_style . '" data-no-lazy="1">';
										$modal_gallery .= '#' . ($i + 1);
									$modal_gallery .= '</a>';
								} else {
									$modal_gallery .= '<a style="' . $grid_style . '; display: none;" id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-preview="' . $preview_thumb . '" data-thumbnail="' . $modal_thumb . '" data-include="true" data-hover="' . (!empty($meta['title']) ? $meta['title'] : "") . '" data-alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" data-groups="' . (!empty($meta['groups']) ? (str_replace('/', ',', $meta['groups'])) : "") . '" class="kraut-lightbox-media no-ajaxy ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-no-lazy="1">';
										$modal_gallery .= '#' . ($i + 1);
									$modal_gallery .= '</a>';
								}
							}					
						$modal_gallery .= '</div>';
						if ($data_grid_limit != 0) {
							foreach($content_combined as $image => $meta ) {
								$k++;
								if ($k > ($data_grid_limit - 1)) {
									if ($content_external == "true") {
										$modal_image		= $meta['data_lightboxfull'];
										$preview_thumb		= $meta['data_preview'];
										$modal_thumb		= $meta['data_lightboxthumb'];
									} else {
										$preview_thumb 		= $meta['data_preview'][0];
										$modal_image 		= $meta['data_lightboxfull'][0];
										$modal_thumb 		= $meta['data_lightboxthumb'][0];
									}
									$modal_gallery .= '<a style="display: none !important; width: 0px; height: 0px; margin: 0; padding: 0;" id="' . $nacho_group . '-' . $k .'" href="' . $modal_image . '" target="_blank" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-thumbnail="' . $modal_thumb . '" data-include="false" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="kraut-lightbox-media no-ajaxy nofancybox kraut-lb-nogrid" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
										$modal_gallery .= '#' . ($k + 1);
									$modal_gallery .= '</a>';
								}
							}
						}
						if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") && ($lightbox_pageload == "true")) {					
							$modal_gallery .= '<script type="text/javascript">';
								$modal_gallery .= 'jQuery(window).load(function(){';
									$modal_gallery .= 'jQuery(".' . $nacho_group . '").krautlightbox("open");';
								$modal_gallery .= '});';
							$modal_gallery .= '</script>';
						}
					}
					// Freewall-Grid Layout
					if (strtolower($content_style) == "freewall") {
						wp_enqueue_script('ts-extend-freewall');
						$fullwidth_allow				= "true";
						$filter_settings				= 'data-gridfilter="true" data-gridavailable="' . $filters_available . '" data-gridselected="' . $filters_selected . '" data-gridnogroups="' . $filters_nogroups . '" data-gridtoggle="' . $filters_toggle . '" data-gridtogglestyle="' . $filters_toggle_style . '" data-gridshowall="' . $filters_showall . '" data-gridshowallstyle="' . $filters_showall_style . '"';
						$modal_gallery .= '<div id="ts-lightbox-freewall-grid-' . $randomizer . '-container" class="ts-lightbox-freewall-grid-container" data-random="' . $randomizer . '" data-width="' . $freewall_width . '" data-gutter="' . $data_grid_space . '" ' . $filter_settings . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';		
							// Add Freewall Grid
							foreach($content_combined as $image => $meta) {
								$i++;
								if (($data_grid_limit != 0) && ($i > ($data_grid_limit - 1))) {
									$i						= ($data_grid_limit - 1);
									break;
								}
								if ($content_external == "true") {
									$modal_image			= $meta['data_lightboxfull'];
									$preview_thumb			= $meta['data_preview'];
									$modal_thumb			= $meta['data_lightboxthumb'];								
								} else {
									$preview_thumb 			= $meta['data_preview'][0];
									$modal_image 			= $meta['data_lightboxfull'][0];
									$modal_thumb 			= $meta['data_lightboxthumb'][0];
								}
								if ($i == $nachoLength) {
									$data_grid_breaks 	= str_replace(' ', '', $data_grid_breaks);
									$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="ts-lightbox-freewall-item ts-lightbox-freewall-active ' . $nacho_group . '-parent ' . $el_class . ' krautgrid-item krautgrid-tile kraut-lightbox-image" data-fixSize="false" style="width: ' . $freewall_width . 'px; margin: 0; padding: 0;" data-showing="true" data-groups="' . (!empty($meta['groups']) ? (str_replace('/', ',', $meta['groups'])) : "") . '">';
										$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="' . $image_link_class . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
											$modal_gallery .= '<img src="' . $preview_thumb . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1" class="kraut-lb-makegrid">';
											$modal_gallery .= '<div class="krautgrid-caption ' . $image_title_class . '"></div>';
											if (!empty($meta['title'])) {
												$modal_gallery .= '<div class="krautgrid-caption-text">' . $meta['title'] . '</div>';
											}
										$modal_gallery .= '</a>';
									$modal_gallery .= '</div>';
								} else {
									$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="ts-lightbox-freewall-item ts-lightbox-freewall-active ' . $nacho_group . '-parent ' . $el_class . ' krautgrid-item krautgrid-tile kraut-lightbox-image" data-fixSize="false" style="width: ' . $freewall_width . 'px; margin: 0; padding: 0;" data-showing="true" data-groups="' . (!empty($meta['groups']) ? (str_replace('/', ',', $meta['groups'])) : "") . '">';
										$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="' . $image_link_class . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
											$modal_gallery .= '<img src="' . $preview_thumb . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1" class="kraut-lb-makegrid">';
											$modal_gallery .= '<div class="krautgrid-caption ' . $image_title_class . '"></div>';
											if (!empty($meta['title'])) {
												$modal_gallery .= '<div class="krautgrid-caption-text">' . $meta['title'] . '</div>';
											}
										$modal_gallery .= '</a>';
									$modal_gallery .= '</div>';
								}
							}
						$modal_gallery .= '</div>';
						if ($data_grid_limit != 0) {
							foreach($content_combined as $image => $meta ) {
								$k++;
								if ($k > ($data_grid_limit - 1)) {
									if ($content_external == "true") {
										$modal_image		= $meta['data_lightboxfull'];
										$preview_thumb		= $meta['data_preview'];
										$modal_thumb		= $meta['data_lightboxthumb'];
									} else {
										$preview_thumb 		= $meta['data_preview'][0];
										$modal_image 		= $meta['data_lightboxfull'][0];
										$modal_thumb 		= $meta['data_lightboxthumb'][0];
									}
									$modal_gallery .= '<a style="display: none !important; width: 0px; height: 0px; margin: 0; padding: 0;" id="' . $nacho_group . '-' . $k .'" href="' . $modal_image . '" target="_blank" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-thumbnail="' . $modal_thumb . '" data-include="false" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="kraut-lightbox-media no-ajaxy nofancybox kraut-lb-nogrid" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
										$modal_gallery .= 'Lightbox Image #' . ($k + 1);
									$modal_gallery .= '</a>';
								}
							}
						}
						if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") && ($content_linkstyle == "lightbox") && ($lightbox_pageload == "true")) {
							$modal_gallery .= '<script type="text/javascript">';
								$modal_gallery .= 'jQuery(window).load(function(){';
									$modal_gallery .= 'jQuery(".' . $nacho_group . '").krautlightbox("open");';
								$modal_gallery .= '});';
							$modal_gallery .= '</script>';
						}
					}
					// Honeycomb-Grid Layout
					if (strtolower($content_style) == "honeycombs") {
						wp_enqueue_style('ts-extend-tooltipster');
						wp_enqueue_script('ts-extend-tooltipster');
						wp_enqueue_style('ts-extend-honeycombs');
						wp_enqueue_script('ts-extend-honeycombs');
						$fullwidth_allow				= "true";
						if ($honeycombs_tooltips == "true") {
							$data_tooltips				= 'data-tooltipster-position="' . $tooltipster_position . '" data-tooltipster-touch="false" data-tooltipster-theme="' . $tooltipster_theme . '" data-tooltipster-animation="' . $tooltipster_animation . '" data-tooltipster-arrow="true" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
						} else {
							$data_tooltips				= '';
						}
						if ($honeycombs_rotate == "false") {
							$honeycombs_rotate			= 'ts-honeycombs-gallery-norotate';
						} else {
							$honeycombs_rotate			= '';
						}
						$filter_settings				= 'data-gridfilter="true" data-gridavailable="' . $filters_available . '" data-gridselected="' . $filters_selected . '" data-gridnogroups="' . $filters_nogroups . '" data-gridtoggle="' . $filters_toggle . '" data-gridtogglestyle="' . $filters_toggle_style . '" data-gridshowall="' . $filters_showall . '" data-gridshowallstyle="' . $filters_showall_style . '"';
						$modal_gallery .= '<div id="ts-honeycombs-gallery-wrapper-' . $randomizer . '" class="ts-honeycombs-gallery-wrapper" data-inline="' . $frontend_edit . '" data-currentsize="full" data-layout="' . $honeycombs_layout . '" data-tooltips="' . $honeycombs_tooltips . '" ' . $data_tooltips . ' data-fullwidth="' . $fullwidth . '" data-break-parents="' . $breakouts . '" data-breakpoints="' . $honeycombs_breaks . '" data-combsizes="' . $honeycombs_sizes . '" data-margin="' . $data_grid_space . '" data-random="' . $randomizer . '" ' . $filter_settings . '>';
							$modal_gallery .= '<img id="ts-honeycombs-gallery-loader-' . $randomizer . '" class="ts-honeycombs-gallery-loader" src="' . TS_VCSC_GetResourceURL('images/other/ajax_loader.gif') . '" data-no-lazy="1" style="margin: 0 auto;">';
							$modal_gallery .= '<div class="ts-honeycombs-gallery-inner">';
								// Add Honeycombs Grid
								foreach($content_combined as $image => $meta) {
									$i++;
									if (($data_grid_limit != 0) && ($i > ($data_grid_limit - 1))) {
										$i						= ($data_grid_limit - 1);
										break;
									}
									if ($content_external == "true") {
										$modal_image		= $meta['data_lightboxfull'];
										$preview_thumb		= $meta['data_preview'];
										$modal_thumb		= $meta['data_lightboxthumb'];						
									} else {
										$preview_thumb 		= $meta['data_preview'][0];
										$modal_image 		= $meta['data_lightboxfull'][0];
										$modal_thumb 		= $meta['data_lightboxthumb'][0];
									}
									if ((!empty($meta['title'])) && ($honeycombs_tooltips == "true")) {
										$thumb_tooltipclasses	= 'ts-honeycombs-gallery-tooltip';
										$thumb_tooltipcontent 	= 'data-tooltipster-title="" data-tooltipster-text="' . $meta['title'] . '" data-tooltipster-image=""';
									} else {
										$thumb_tooltipclasses	= "";
										$thumb_tooltipcontent	= "";
									}									
									if ($i == $nachoLength) {
										$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-showing="true" data-groups="' . (!empty($meta['groups']) ? (str_replace('/', ',', $meta['groups'])) : "") . '" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="ts-honeycombs-gallery-comb ts-honeycombs-gallery-active ' . $image_link_class . ' ' . $honeycombs_rotate . ' ts-hover-image ' . $nacho_group . ' nofancybox ' . $thumb_tooltipclasses . '" ' . $thumb_tooltipcontent . ' rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';								
											$modal_gallery .= '<div class="ts-honeycombs-gallery-hex-left">';
												$modal_gallery .= '<div class="ts-honeycombs-gallery-hex-right">';
													$modal_gallery .= '<div class="ts-honeycombs-gallery-hex-inner" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" style="background-image: url(' . $preview_thumb . ');">';
														$modal_gallery .= '<div class="ts-honeycombs-gallery-overlay"></div>';
													$modal_gallery .= '</div>';
												$modal_gallery .= '</div>';
											$modal_gallery .= '</div>';											
										$modal_gallery .= '</a>';
									} else {
										$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-showing="true" data-groups="' . (!empty($meta['groups']) ? (str_replace('/', ',', $meta['groups'])) : "") . '" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="ts-honeycombs-gallery-comb ts-honeycombs-gallery-active ' . $image_link_class . ' ' . $honeycombs_rotate . ' ts-hover-image ' . $nacho_group . ' nofancybox ' . $thumb_tooltipclasses . '" ' . $thumb_tooltipcontent . ' rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
											$modal_gallery .= '<div class="ts-honeycombs-gallery-hex-left">';
												$modal_gallery .= '<div class="ts-honeycombs-gallery-hex-right">';
													$modal_gallery .= '<div class="ts-honeycombs-gallery-hex-inner" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" style="background-image: url(' . $preview_thumb . ');">';
														$modal_gallery .= '<div class="ts-honeycombs-gallery-overlay"></div>';
													$modal_gallery .= '</div>';
												$modal_gallery .= '</div>';
											$modal_gallery .= '</div>';	
										$modal_gallery .= '</a>';
									}					
								}
							$modal_gallery .= '</div>';
							if ($data_grid_limit != 0) {
								foreach($content_combined as $image => $meta ) {
									$k++;
									if ($k > ($data_grid_limit - 1)) {
										if ($content_external == "true") {
											$modal_image	= $meta['data_lightboxfull'];
											$preview_thumb	= $meta['data_preview'];
											$modal_thumb	= $meta['data_lightboxthumb'];	
										} else {
											$preview_thumb 	= $meta['data_preview'][0];
											$modal_image 	= $meta['data_lightboxfull'][0];
											$modal_thumb 	= $meta['data_lightboxthumb'][0];
										}
										$modal_gallery .= '<a style="display: none !important; width: 0px; height: 0px; margin: 0; padding: 0;" id="' . $nacho_group . '-' . $k .'" href="' . $modal_image . '" target="_blank" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-thumbnail="' . $modal_thumb . '" data-include="false" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="kraut-lightbox-media no-ajaxy nofancybox kraut-lb-nogrid" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
											$modal_gallery .= 'Lightbox Image #' . ($k + 1);
										$modal_gallery .= '</a>';
									}
								}
							}
						$modal_gallery .= '</div>';
						if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") && ($content_linkstyle == "lightbox") && ($lightbox_pageload == "true")) {
							$modal_gallery .= '<script type="text/javascript">';
								$modal_gallery .= 'jQuery(window).load(function(){';
									$modal_gallery .= 'jQuery(".' . $nacho_group . '").krautlightbox("open");';
								$modal_gallery .= '});';
							$modal_gallery .= '</script>';
						}
					}
					// First or Random Image Only Layout
					if ((strtolower($content_style) == "first") || (strtolower($content_style) == "random")) {
						$fullwidth_allow			= "false";
						if (strtolower($content_style) == "random") {
							$modal_pick				= rand(0, $nachoLength);
						} else {
							$modal_pick				= 0;
						}
						foreach($content_combined as $image => $meta) {
							$i++;	
							if ($content_external == "true") {
								$modal_image				= $meta['data_lightboxfull'];
								$preview_thumb				= $meta['data_preview'];
								$modal_thumb				= $meta['data_lightboxthumb'];								
							} else {
								$preview_thumb 				= $meta['data_preview'][0];
								$modal_image 				= $meta['data_lightboxfull'][0];
								$modal_thumb 				= $meta['data_lightboxthumb'][0];
							}
							if (($i == $modal_pick) || ($nachoLength == 0)) {
								$modal_gallery .= '<div class="krautgrid-item krautgrid-tile kraut-lightbox-trigger ' . ($trigger_grayscale == "true" ? "kraut-lightbox-trigger-grayscale" : "") . '" style="">';
									$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="kraut-lightbox-media no-ajaxy ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
										$modal_gallery .= '<img data-no-lazy="1" src="' . $preview_thumb . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" class="nachocover">';
										$modal_gallery .= '<div class="krautgrid-caption"></div>';
										if (!empty($meta['title'])) {
											$modal_gallery .= '<div class="krautgrid-caption-text">' . (!empty($meta['title']) ? $meta['title'] : "") . '</div>';
										} 
									$modal_gallery .= '</a>';
								$modal_gallery .= '</div>';
							} else if ($i == $nachoLength) {
								$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" style="display: none;" href="' . $modal_image . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="kraut-lightbox-media no-ajaxy ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
									$modal_gallery .= 'Lightbox Image #' . ($i + 1);
								$modal_gallery .= '</a>';
							} else {
								$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" style="display: none;" href="' . $modal_image . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="kraut-lightbox-media no-ajaxy ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
									$modal_gallery .= 'Lightbox Image #' . ($i + 1);
								$modal_gallery .= '</a>';
							}
						}
						if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") && ($lightbox_pageload == "true")) {
							$modal_gallery .= '<script type="text/javascript">';
								$modal_gallery .= 'jQuery(window).load(function(){';
									$modal_gallery .= 'jQuery(".' . $nacho_group . '").krautlightbox("open");';
								$modal_gallery .= '});';
							$modal_gallery .= '</script>';
						}
					}
					// Custom Image Layout
					if (strtolower($content_style) == "image") {
						$fullwidth_allow			= "false";
						if (!empty($content_trigger_image)) {					
							if ($content_images_size == 'custom') {
								$trigger_thumb				= TS_VCSC_CreateCustomImageSize($content_trigger_image, $content_images_width, $content_images_height);
							} else {
								$trigger_thumb				= wp_get_attachment_image_src($content_trigger_image, $content_images_size);
							}				
							$modal_gallery .= '<div class="krautgrid-item krautgrid-tile kraut-lightbox-trigger ' . ($trigger_grayscale == "true" ? "kraut-lightbox-trigger-grayscale" : "") . '" style="">';
								$modal_gallery .= '<a href="#" class="kraut-lightbox-trigger nofancybox" data-title="' . (!empty($content_trigger_title) ? $content_trigger_title : "") . '" data-group="' . $nacho_group . '">';
									$modal_gallery .= '<img src="' . $trigger_thumb[0] . '" data-no-lazy="1" alt="" title="" style="">';
									$modal_gallery .= '<div class="krautgrid-caption"></div>';
									if (!empty($content_trigger_title)) {
										$modal_gallery .= '<div class="krautgrid-caption-text">' . (!empty($content_trigger_title) ? $content_trigger_title : "") . '</div>';
									}
								$modal_gallery .= '</a>';
							$modal_gallery .= '</div>';
							foreach($content_combined as $image => $meta) {
								$i++;
								if ($content_external == "true") {
									$modal_image			= $meta['data_lightboxfull'];
									$preview_thumb			= $meta['data_preview'];
									$modal_thumb			= $meta['data_lightboxthumb'];
								} else {
									$preview_thumb 			= $meta['data_preview'][0];
									$modal_image 			= $meta['data_lightboxfull'][0];
									$modal_thumb 			= $meta['data_lightboxthumb'][0];
								}
								if ($i == $nachoLength) {
									$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" style="display: none;" href="' . $modal_image . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="kraut-lightbox-media no-ajaxy ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
										$modal_gallery .= 'Lightbox Image #' . ($i + 1);
									$modal_gallery .= '</a>';
								} else {
									$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" style="display: none;" href="' . $modal_image . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="kraut-lightbox-media no-ajaxy ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
										$modal_gallery .= 'Lightbox Image #' . ($i + 1);
									$modal_gallery .= '</a>';
								}
							}
							if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") && ($lightbox_pageload == "true")) {
								$modal_gallery .= '<script type="text/javascript">';
									$modal_gallery .= 'jQuery(window).load(function(){';
										$modal_gallery .= 'jQuery(".' . $nacho_group . '").krautlightbox("open");';
									$modal_gallery .= '});';
								$modal_gallery .= '</script>';
							}
						}
					}
					// Slick Slider Layout
					if ((strtolower($content_style) == "slickthumb") || (strtolower($content_style) == "slicksingle")) {
						wp_enqueue_style('ts-extend-slickslider');
						wp_enqueue_script('ts-extend-slickslider');
						$fullwidth_allow				= "true";
						// Contingency Check
						if (($slickmain_limituse == "true") && ($slickmain_initialitem > ($slickmain_limitcount - 1))) {
							$slickmain_initialitem		= 0;
						}
						// Check Adjustments for Thumbs
						if (strtolower($content_style) == "slickthumb") {
							$slickmain_singlemode		= $slickthumb_singlemode;
							$slickmain_maxitems 		= 1;
							$slickmain_scrollitems		= "single";
							$slickmain_centermode		= "false";							
							if ($slickthumb_position == "thumbstop") {
								$slickthumb_bullets		= "false";
							} else {								
								$slickthumb_bullets		= $slickmain_bullets;
								$slickmain_bullets		= "false";
							}
							$slickthumb_wingshow		= "true";
							$slickthumb_wingwidth 		= $slickmain_wingwidth;
							$slickmain_wingshow			= "false";
							$slickthumb_data			= 'data-asnavfor="ts-slickslider-gallery-slider-' . $randomizer . '" data-singlemode="' . $slickthumb_singlemode . '" data-centermode="' . $slickthumb_centermode . '" data-spacing="' . $slickthumb_spacing . '" data-wingshow="' . $slickthumb_wingshow . '" data-wingwidth="' . $slickthumb_wingwidth . '" data-breakpoints="' . $slickthumb_breakpoints . '" data-maxitems="' . $slickthumb_maxitems . '" data-infinite="' . $slickmain_infinite . '" data-bullets="' . $slickthumb_bullets . '" data-thumbposition="' . $slickthumb_position . '"';
						} else {
							$slickthumb_data			= '';
						}
						$slickmain_data					= 'data-asnavfor="ts-slickslider-gallery-thumbs-' . $randomizer . '" data-singlemode="' . $slickmain_singlemode . '" data-centermode="' . $slickmain_centermode . '" data-spacing="' . $slickmain_spacing . '" data-scrollitems="' . $slickmain_scrollitems . '" data-wingshow="' . $slickmain_wingshow . '" data-wingwidth="' . $slickmain_wingwidth . '" data-breakpoints="' . $slickmain_breakpoints . '" data-initialitem="' . $slickmain_initialitem . '" data-maxitems="' . $slickmain_maxitems . '" data-infinite="' . $slickmain_infinite . '" data-variable="true" data-adaptive="false" data-autoplay="' . $slickmain_autoplay . '" data-interval="' . $slickmain_interval . '" data-bullets="' . $slickmain_bullets . '" data-rtlmode="' . $slickmain_rtlmode . '"';
						$slickmain_filter				= 'data-filter-available="' . $filters_available . '" data-filter-selected="' . $filters_selected . '" data-filter-nogroups="' . $filters_nogroups . '" data-filter-toggletext="' . $filters_toggle . '" data-filter-togglestyle="' . $filters_toggle_style . '" data-filter-showtext="' . $filters_showall . '" data-filter-showstyle="' . $filters_showall_style . '"';
						$modal_gallery .= '<div id="ts-slickslider-gallery-container-' . $randomizer . '-container" data-identifier="' . $randomizer . '" class="ts-slickslider-slider-container ts-slickslider-gallery-container ts-slickslider-movement-' . ($slickmain_vertical == "true" ? "vertical" : "horizontal") . ' ts-slickslider-direction-' . ($slickmain_rtlmode == "true" ? "rtl" : "ltr") . '" data-thumbnails="' . ((strtolower($content_style) == "slickthumb") ? $slickthumb_position : "thumbsnone") . '" ' . $slickmain_filter . '>';
							if (strtolower($content_style) == "slickthumb") {
								if ($slickthumb_position == "thumbstop") {
									$slickthumb_distance = 'margin-bottom: ' . $slickthumb_distance . 'px;';
								} else if ($slickthumb_position == "thumbsbottom") {
									$slickthumb_distance = 'margin-top: ' . $slickthumb_distance . 'px;';
								}
								$modal_thumbs .= '<div id="ts-slickslider-gallery-thumbs-' . $randomizer . '" class="ts-slickslider-gallery-thumbs ts-slickslider-theme-' . $slickmain_theme . ' slick-slider ' . ($slickmain_graylayer == "true" ? "ts-slickslider-gallery-gray" : "") . '" ' . $slickthumb_data . ' style="' . ((($slickthumb_bullets == "true") && ($slickthumb_position == "thumbsbottom")) ? "margin-bottom: 40px;" : "") . ' ' . $slickthumb_distance . '">';
									$i 							= -1;
									foreach($content_combined as $image => $meta) {
										$i++;
										if ($slickmain_limituse == "true" && ($i >= $slickmain_limitcount)) {
											break;
										}
										if ($content_external == "true") {
											$preview_thumb		= $meta['data_preview'];							
										} else {
											$preview_thumb		= TS_VCSC_CreateCustomImageSize($meta['preview'], 200, 200);
											$preview_thumb		= $preview_thumb[0];									
										}						
										$modal_thumbs .= '<div id="' . $nacho_group . '-thumb-' . $i .'-parent" class="ts-slickslider-thumb" style="margin: 0 ' . ($slickthumb_spacing / 2) . 'px;" data-groups="' . (!empty($meta['groups']) ? (str_replace('/', ',', $meta['groups'])) : "") . '">';
											$modal_thumbs .= '<img class="ts-slickslider-gallery-image" src="' . ($slickmain_lazyload == "true" ? "" : $preview_thumb) . '" data-lazy="' . ($slickmain_lazyload == "false" ? "" : $preview_thumb) . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1" data-title="' . (!empty($meta['title']) ? $meta['title'] : "") . '" style="">';
										$modal_thumbs .= '</div>';
									}
									if (($slickthumb_centermode == "true") && ($slickthumb_singlemode != "singlefade") && ($slickthumb_wingshow == "true")) {
										$modal_thumbs .= '<div id="ts-slickslider-gallery-wingleft-' . $randomizer . '" class="ts-slickslider-gallery-wings ts-slickslider-gallery-wingleft" style="width: ' . $slickmain_wingwidth . '%;"></div>';
										$modal_thumbs .= '<div id="ts-slickslider-gallery-wingright-' . $randomizer . '" class="ts-slickslider-gallery-wings ts-slickslider-gallery-wingright" style="width: ' . $slickmain_wingwidth . '%;"></div>';
									}
								$modal_thumbs .= '</div>';
							}
							if ((strtolower($content_style) == "slickthumb") && ($slickthumb_position == "thumbstop")) {
								$modal_gallery .= $modal_thumbs;
							}
							$modal_gallery .= '<div id="ts-slickslider-gallery-slider-' . $randomizer . '" class="ts-slickslider-gallery-slider ts-slickslider-theme-' . $slickmain_theme . ' slick-slider ' . ($slickmain_graylayer == "true" ? "ts-slickslider-gallery-gray" : "") . '" ' . $slickmain_data . ' style="' . ($slickmain_bullets == "true" ? "margin-bottom: 40px;" : "") . '">';
								$i 								= -1;
								foreach ($content_combined as $image => $meta) {
									$i++;
									if ($content_external == "true") {
										$modal_image			= $meta['data_lightboxfull'];
										$preview_thumb			= $meta['data_preview'];
										$modal_thumb			= $meta['data_lightboxthumb'];							
									} else {
										$preview_thumb 			= $meta['data_preview'][0];
										$modal_image 			= $meta['data_lightboxfull'][0];
										$modal_thumb 			= $meta['data_lightboxthumb'][0];
									}
									if ($slickmain_limituse == "true" && ($i >= $slickmain_limitcount)) {
										if ($i == $nachoLength) {
											$data_grid_breaks 		= str_replace(' ', '', $data_grid_breaks);
											if ($content_linkstyle != "none") {
												$modal_gallery .= '<a id="' . $nacho_group . '-link-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" data-thumb="' . $modal_thumb . '" data-clone="' . $nacho_group . '-link-' . $i .'" class="ts-slickslider-gallery-link ' . $image_link_class . ' ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>' . $i . '</a>';
											}
										} else {
											if ($content_linkstyle != "none") {
												$modal_gallery .= '<a id="' . $nacho_group . '-link-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" data-thumb="' . $modal_thumb . '" data-clone="' . $nacho_group . '-link-' . $i .'" class="ts-slickslider-gallery-link ' . $image_link_class . ' ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">' . $i . '</a>';
											}
										}
									} else {
										if ($i == $nachoLength) {
											$data_grid_breaks 		= str_replace(' ', '', $data_grid_breaks);
											$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="ts-slickslider-section" style="margin: 0 ' . ($slickmain_spacing / 2) . 'px;" data-groups="' . (!empty($meta['groups']) ? (str_replace('/', ',', $meta['groups'])) : "") . '">';											
												if ($content_linkstyle != "none") {
													$modal_gallery .= '<a id="' . $nacho_group . '-link-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" data-thumb="' . $modal_thumb . '" data-clone="' . $nacho_group . '-link-' . $i .'" class="' . $image_link_class . ' ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
												}
													$modal_gallery .= '<img class="ts-slickslider-gallery-image" src="' . ($slickmain_lazyload == "true" ? "" : $preview_thumb) . '" data-lazy="' . ($slickmain_lazyload == "false" ? "" : $preview_thumb) . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1" data-title="' . (!empty($meta['title']) ? $meta['title'] : "") . '" style="">';
													$modal_gallery .= '<div class="ts-slickslider-gallery-' . ($content_linkstyle != "none" ? "overlay" : "noeffect") . '"></div>';
													if (!empty($meta['title'])) {
														$modal_gallery .= '<div class="ts-slickslider-gallery-title">' . $meta['title'] . '</div>';
													}
												if ($content_linkstyle != "none") {
													$modal_gallery .= '</a>';
												}
											$modal_gallery .= '</div>';
										} else {
											$modal_gallery .= '<div id="' . $nacho_group . '-section-' . $i .'-parent" class="ts-slickslider-section" style="margin: 0 ' . ($slickmain_spacing / 2) . 'px;" data-groups="' . (!empty($meta['groups']) ? (str_replace('/', ',', $meta['groups'])) : "") . '">';											
												if ($content_linkstyle != "none") {
													$modal_gallery .= '<a id="' . $nacho_group . '-link-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" data-thumb="' . $modal_thumb . '" data-clone="' . $nacho_group . '-link-' . $i .'" class="' . $image_link_class . ' ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
												}
													$modal_gallery .= '<img class="ts-slickslider-gallery-image" src="' . ($slickmain_lazyload == "true" ? "" : $preview_thumb) . '" data-lazy="' . ($slickmain_lazyload == "false" ? "" : $preview_thumb) . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1" data-title="' . (!empty($meta['title']) ? $meta['title'] : "") . '" style="">';
													$modal_gallery .= '<div class="ts-slickslider-gallery-' . ($content_linkstyle != "none" ? "overlay" : "noeffect") . '"></div>';
													if (!empty($meta['title'])) {
														$modal_gallery .= '<div class="ts-slickslider-gallery-title">' . $meta['title'] . '</div>';
													}
												if ($content_linkstyle != "none") {
													$modal_gallery .= '</a>';
												}
											$modal_gallery .= '</div>';
										}
									}
								}
							$modal_gallery .= '</div>';
							if ($slickmain_autoplay == "true") {
								$modal_gallery .= '<div id="ts-slickslider-gallery-autoplay-' . $randomizer . '" class="ts-slickslider-gallery-autoplay">';
									$modal_gallery .= '<div id="ts-slickslider-gallery-start-' . $randomizer . '" class="ts-slickslider-gallery-start"></div>';
									$modal_gallery .= '<div id="ts-slickslider-gallery-pause-' . $randomizer . '" class="ts-slickslider-gallery-pause"></div>';
								$modal_gallery .= '</div>';
							}
							if (($slickmain_centermode == "true") && ($slickmain_singlemode != "singlefade") && ($slickmain_wingshow == "true")) {
								$modal_gallery .= '<div id="ts-slickslider-gallery-wingleft-' . $randomizer . '" class="ts-slickslider-gallery-wings ts-slickslider-gallery-wingleft" style="width: ' . $slickmain_wingwidth . '%;"></div>';
								$modal_gallery .= '<div id="ts-slickslider-gallery-wingright-' . $randomizer . '" class="ts-slickslider-gallery-wings ts-slickslider-gallery-wingright" style="width: ' . $slickmain_wingwidth . '%;"></div>';
							}
							if ((strtolower($content_style) == "slickthumb") && ($slickthumb_position == "thumbsbottom")) {
								$modal_gallery .= $modal_thumbs;
							}
							$modal_gallery .= '<div id="ts-slickslider-gallery-linksonly-' . $randomizer . '" class="ts-slickslider-gallery-linksonly" style="display: none;"></div>';
						$modal_gallery .= '</div>';
						if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") && ($content_linkstyle == "lightbox") && ($lightbox_pageload == "true")) {
							$modal_gallery .= '<script type="text/javascript">';
								$modal_gallery .= 'jQuery(window).load(function(){';
									$modal_gallery .= 'jQuery(".' . $nacho_group . '").krautlightbox("open");';
								$modal_gallery .= '});';
							$modal_gallery .= '</script>';
						}
					}
					// Owl Slider Layout
					if (strtolower($content_style) == "slider") {
						wp_enqueue_style('ts-extend-owlcarousel2');
						wp_enqueue_script('ts-extend-owlcarousel2');
						$fullwidth_allow			= "true";
						$modal_gallery .= '<div id="ts-lightbox-gallery-slider-' . $randomizer . '-container" class="ts-lightbox-gallery-container" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';		
							// Add Progressbar
							if (($auto_play == "true") && ($show_bar == "true")) {
								$modal_gallery .= '<div id="ts-owlslider-progressbar-' . $randomizer . '" class="ts-owlslider-progressbar-holder" style=""><div class="ts-owlslider-progressbar" style="background: ' . $bar_color . '; height: 100%; width: 0%;"></div></div>';
							}
							// Add Navigation Controls
							$modal_gallery .= '<div id="ts-owlslider-controls-' . $randomizer . '" class="ts-owlslider-controls" style="' . (((($auto_play == "true") && ($show_playpause == "true")) || ($show_navigation == "true")) ? "display: block;" : "display: none;") . '">';
								$modal_gallery .= '<div id="ts-owlslider-controls-next-' . $randomizer . '" style="' . (($show_navigation == "true") ? "display: block;" : "display: none;") . '" class="ts-owlslider-controls-next" title="Next"><span class="ts-ecommerce-arrowright5"></span></div>';
								$modal_gallery .= '<div id="ts-owlslider-controls-prev-' . $randomizer . '" style="' . (($show_navigation == "true") ? "display: block;" : "display: none;") . '" class="ts-owlslider-controls-prev" title="Previous"><span class="ts-ecommerce-arrowleft5"></span></div>';							
								if (($auto_play == "true") && ($show_playpause == "true")) {
									$modal_gallery .= '<div id="ts-owlslider-controls-play-' . $randomizer . '" class="ts-owlslider-controls-play active" title="Play / Pause"><span class="ts-ecommerce-pause"></span></div>';
								}
								$modal_gallery .= '<div id="ts-owlslider-controls-refresh-' . $randomizer . '" style="display: none;" class="ts-owlslider-controls-refresh" title="Refresh"><span class="ts-ecommerce-cycle"></span></div>';
							$modal_gallery .= '</div>';
							// Add Slider
							$modal_gallery .= '<div id="ts-lightbox-gallery-slider-' . $randomizer . '" class="ts-owlslider-parent owl-carousel2 ts-lightbox-gallery-slider" data-id="' . $randomizer . '" data-items="' . $number_images . '" data-breakpointscustom="' . $break_custom . '" data-breakpointitems="' . $break_string . '" data-rtl="' . $page_rtl . '" data-loop="' . $items_loop . '" data-navigation="' . $show_navigation . '" data-dots="' . $dot_navigation . '" data-mobile="' . $animation_mobile . '" data-animationin="' . $animation_in . '" data-animationout="' . $animation_out . '" data-height="' . $auto_height . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '" data-margin="' . $slide_margin . '">';
								foreach($content_combined as $image => $meta) {
									$i++;					
									if ($content_external == "true") {
										$modal_image			= $meta['data_lightboxfull'];
										$preview_thumb			= $meta['data_preview'];
										$modal_thumb			= $meta['data_lightboxthumb'];									
									} else {
										$preview_thumb 			= $meta['data_preview'][0];
										$modal_image 			= $meta['data_lightboxfull'][0];
										$modal_thumb 			= $meta['data_lightboxthumb'][0];
									}
									if ($i == $nachoLength) {
										$data_grid_breaks 		= str_replace(' ', '', $data_grid_breaks);
										$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' krautgrid-item krautgrid-tile kraut-lightbox-image" style="">';
											if ($content_linkstyle != "none") {
												$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="' . $image_link_class . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
											}
												$modal_gallery .= '<img src="' . $preview_thumb . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1" style="">';
												$modal_gallery .= '<div class="krautgrid-caption ' . $image_title_class . '"></div>';
												if (!empty($meta['title'])) {
													$modal_gallery .= '<div class="krautgrid-caption-text">' . $meta['title'] . '</div>';
												}
											if ($content_linkstyle != "none") {
												$modal_gallery .= '</a>';
											}
										$modal_gallery .= '</div>';
									} else {
										$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' krautgrid-item krautgrid-tile kraut-lightbox-image" style="">';
											if ($content_linkstyle != "none") {
												$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="' . $image_link_class . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
											}
												$modal_gallery .= '<img src="' . $preview_thumb . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1" style="">';
												$modal_gallery .= '<div class="krautgrid-caption ' . $image_title_class . '"></div>';
												if (!empty($meta['title'])) {
													$modal_gallery .= '<div class="krautgrid-caption-text">' . $meta['title'] . '</div>';
												}
											if ($content_linkstyle != "none") {
												$modal_gallery .= '</a>';
											}
										$modal_gallery .= '</div>';
									}
								}
							$modal_gallery .= '</div>';
						$modal_gallery .= '</div>';
						if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") && ($content_linkstyle == "lightbox") && ($lightbox_pageload == "true")) {
							$modal_gallery .= '<script type="text/javascript">';
								$modal_gallery .= 'jQuery(window).load(function(){';
									$modal_gallery .= 'jQuery(".' . $nacho_group . '").krautlightbox("open");';
								$modal_gallery .= '});';
							$modal_gallery .= '</script>';
						}
					}
					// Flex Slider Layout
					if ((strtolower($content_style) == "flexthumb") || (strtolower($content_style) == "flexsingle")) {
						wp_enqueue_style('ts-extend-tooltipster');
						wp_enqueue_script('ts-extend-tooltipster');
						wp_enqueue_style('ts-extend-flexslider2');
						wp_enqueue_script('ts-extend-flexslider2');
						$fullwidth_allow			= "true";
						if ((strtolower($content_style) == "flexsingle") && ($flex_animation == "fade")) {
							$number_images 			= 1;
							$flex_margin 			= 0;
						}
						$modal_gallery .= '<div id="ts-lightbox-gallery-flexslider-' . $randomizer . '-container" class="ts-flexslider-container ts-lightbox-flexslider-container" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;" data-main="ts-lightbox-flexslider-main-' . $randomizer . '" data-frontend="' . $frontend_edit . '" data-id="' . $randomizer . '" data-scrollthumbs="' . $flex_scroll_thumbs . '" data-scrollsingle="' . $flex_scroll_single . '" data-count="' . (count($content_images)) . '" data-combo="' . ((strtolower($content_style) == "flexthumb") ? "true" : "false") . '" data-thumbs="ts-lightbox-flexslider-thumbs-' . $randomizer . '" data-images="' . $number_images . '" data-margin="' . $flex_margin . '" data-rtl="' . $page_rtl . '" data-navigation="' . $dot_navigation . '" data-animation="' . $flex_animation . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '">';
							// Add Progressbar
							if (($auto_play == "true") && ($show_bar == "true")) {
								$modal_gallery .= '<div id="ts-flexslider-progressbar-container-' . $randomizer . '" class="ts-flexslider-progressbar-container" style="width: 100%; height: 100%; background: #ededed;"><div id="ts-flexslider-progressbar-' . $randomizer . '" class="ts-flexslider-progressbar" style="background: ' . $bar_color . '; height: 10px;"></div></div>';
							}
							// Add Slider (Thumbs)
							if ((strtolower($content_style) == "flexthumb") && ($flex_position == 'top')) {
								$modal_gallery .= '<div id="ts-lightbox-flexslider-thumbs-' . $randomizer . '" class="ts-flexslider-parent flex-carousel ts-lightbox-gallery-flexslider ts-lightbox-gallery-flexslider-thumbs" style="margin-bottom: ' . ($dot_navigation == "true" ? 10 : 0) . 'px; border: ' . $flex_border_width . 'px solid ' . $flex_border_color . '; background: ' . $flex_background . '; margin-top: ' . ($flex_border_width == 0 ? 5: 0) . 'px;" data-id="' . $randomizer . '" data-breaks="' . $flex_breaks_thumbs . '">';
									$modal_gallery .= '<ul class="slides">';
										$i 								= -1;
										foreach($content_combined as $image => $meta) {
											$i++;
											if ($content_external == "true") {
												$preview_thumb			= $meta['data_preview'];							
											} else {
												$preview_thumb			= TS_VCSC_CreateCustomImageSize($meta['preview'], 200, 200);
												$preview_thumb			= $preview_thumb[0];									
											}	
											if ((!empty($content_images_titles[$i])) && ($flex_tooltipthumbs == "true")) {
												$thumb_tooltipclasses	= 'ts-has-tooltipster-tooltip';
												$thumb_tooltipcontent 	= 'data-tooltipster-title="" data-tooltipster-text="' . $meta['preview'] . '" data-tooltipster-image="" data-tooltipster-position="' . $tooltipster_position . '" data-tooltipster-touch="false" data-tooltipster-theme="' . $tooltipster_theme . '" data-tooltipster-animation="' . $tooltipster_animation . '" data-tooltipster-arrow="true" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
											} else {
												$thumb_tooltipclasses	= "";
												$thumb_tooltipcontent	= "";
											}									
											$modal_gallery .= '<li class="' . $thumb_tooltipclasses . '" ' . $thumb_tooltipcontent . ' style="cursor: pointer; margin: 0 ' . $flex_margin . 'px 0 0;">';
												$modal_gallery .= '<img src="' . $preview_thumb . '" data-no-lazy="1" style="">';
											$modal_gallery .= '</li>';
										}
									$modal_gallery .= '</ul>';
								$modal_gallery .= '</div>';
							}
							// Add Slider (Main)
							$modal_gallery .= '<div id="ts-lightbox-flexslider-main-' . $randomizer . '" class="ts-flexslider-parent flex-carousel ts-lightbox-gallery-flexslider ts-lightbox-gallery-flexslider-main" style="margin-bottom: ' . ((($frontend_edit == "false") && (strtolower($content_style) == "flexsingle")) ? 40: 0) . 'px; border: ' . $flex_border_width . 'px solid ' . $flex_border_color . '; background: ' . $flex_background . ';" data-id="' . $randomizer . '" data-breaks="' . $flex_breaks_single . '">';
								$modal_gallery .= '<ul class="slides">';
									$i 								= -1;
									foreach($content_combined as $image => $meta) {
										$i++;
										if ($content_external == "true") {
											$modal_image			= $meta['data_lightboxfull'];
											$preview_thumb			= $meta['data_preview'];
											$modal_thumb			= $meta['data_lightboxthumb'];
										} else {
											$modal_image 			= $meta['data_lightboxfull'][0];
											$modal_thumb 			= $meta['data_lightboxthumb'][0];
											$preview_thumb 			= $meta['data_preview'][0];
										}
										if ($i == $nachoLength) {
											$data_grid_breaks 	= str_replace(' ', '', $data_grid_breaks);
											$modal_gallery .= '<li data-counter="' . ($i + 1) . '" style="' . ((strtolower($content_style) == "flexthumb") ? "margin: 0;" : "margin: 0px " . ((($number_images == 1) || ($page_rtl == "true")) ? 0 : $flex_margin) . "px 0px " . ((($number_images == 1) || ($page_rtl == "false")) ? 0 : $flex_margin) . "px;") . '"><div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' krautgrid-item krautgrid-tile kraut-lightbox-image" style="">';
												if ($content_linkstyle != "none") {
													$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-thumb="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="' . $image_link_class . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
												}
													$modal_gallery .= '<img src="' . $preview_thumb . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1" style="">';
													$modal_gallery .= '<div class="krautgrid-caption ' . $image_title_class . '"></div>';
													if (!empty($meta['title'])) {
														$modal_gallery .= '<div class="krautgrid-caption-text">' . $meta['title'] . '</div>';
													}
												if ($content_linkstyle != "none") {
													$modal_gallery .= '</a>';
												}
											$modal_gallery .= '</div></li>';
										} else {
											$modal_gallery .= '<li data-counter="' . ($i + 1) . '" style="' . ((strtolower($content_style) == "flexthumb") ? "margin: 0;" : "margin: 0px " . ((($number_images == 1) || ($page_rtl == "true")) ? 0 : $flex_margin) . "px 0px " . ((($number_images == 1) || ($page_rtl == "false")) ? 0 : $flex_margin) . "px;") . '"><div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' krautgrid-item krautgrid-tile kraut-lightbox-image" style="">';
												if ($content_linkstyle != "none") {
													$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-thumb="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="' . $image_link_class . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
												}
													$modal_gallery .= '<img src="' . $preview_thumb . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1" style="">';
													$modal_gallery .= '<div class="krautgrid-caption ' . $image_title_class . '"></div>';
													if (!empty($meta['title'])) {
														$modal_gallery .= '<div class="krautgrid-caption-text">' . $meta['title'] . '</div>';
													}
												if ($content_linkstyle != "none") {
													$modal_gallery .= '</a>';
												}
											$modal_gallery .= '</div></li>';
										}
									}
								$modal_gallery .= '</ul>';
								// Add Play/Pause Control
								if (($auto_play == "true") && ($show_playpause == "true")) {
									$modal_gallery .= '<div id="ts-flexslider-controls-' . $randomizer . '" class="ts-flexslider-controls" style="display: none;">';
										$modal_gallery .= '<div id="ts-flexslider-controls-play-' . $randomizer . '" class="ts-flexslider-controls-play active"><span class="ts-ecommerce-pause"></span></div>';
									$modal_gallery .= '</div>';
								}
							$modal_gallery .= '</div>';
							// Add Slider (Thumbs)
							if ((strtolower($content_style) == "flexthumb") && ($flex_position == 'bottom')) {
								$modal_gallery .= '<div id="ts-lightbox-flexslider-thumbs-' . $randomizer . '" class="ts-flexslider-parent flex-carousel ts-lightbox-gallery-flexslider ts-lightbox-gallery-flexslider-thumbs" style="margin-bottom: ' . ($dot_navigation == "true" ? 40 : 0) . 'px; border: ' . $flex_border_width . 'px solid ' . $flex_border_color . '; background: ' . $flex_background . '; margin-top: ' . ($flex_border_width == 0 ? 5: 0) . 'px;" data-id="' . $randomizer . '" data-breaks="' . $flex_breaks_thumbs . '">';
									$modal_gallery .= '<ul class="slides">';
										$i 								= -1;
										foreach($content_combined as $image => $meta) {
											$i++;
											if ($content_external == "true") {
												$preview_thumb			= $meta['data_preview'];							
											} else {
												$preview_thumb			= TS_VCSC_CreateCustomImageSize($meta['preview'], 200, 200);
												$preview_thumb			= $preview_thumb[0];									
											}
											if ((!empty($content_images_titles[$i])) && ($flex_tooltipthumbs == "true")) {
												$thumb_tooltipclasses	= 'ts-has-tooltipster-tooltip';
												$thumb_tooltipcontent 	= 'data-tooltipster-title="" data-tooltipster-text="' . $meta['preview'] . '" data-tooltipster-image="" data-tooltipster-position="' . $tooltipster_position . '" data-tooltipster-touch="false" data-tooltipster-theme="' . $tooltipster_theme . '" data-tooltipster-animation="' . $tooltipster_animation . '" data-tooltipster-arrow="true" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
											} else {
												$thumb_tooltipclasses	= "";
												$thumb_tooltipcontent	= "";
											}									
											$modal_gallery .= '<li class="' . $thumb_tooltipclasses . '" ' . $thumb_tooltipcontent . ' style="cursor: pointer; margin: 0 ' . $flex_margin . 'px 0 0;">';
												$modal_gallery .= '<img src="' . $preview_thumb . '" data-no-lazy="1" style="">';
											$modal_gallery .= '</li>';
										}
									$modal_gallery .= '</ul>';
								$modal_gallery .= '</div>';
							}
						$modal_gallery .= '</div>';
						if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") && ($content_linkstyle == "lightbox") && ($lightbox_pageload == "true")) {
							$modal_gallery .= '<script type="text/javascript">';
								$modal_gallery .= 'jQuery(window).load(function(){';
									$modal_gallery .= 'jQuery(".' . $nacho_group . '").krautlightbox("open");';
								$modal_gallery .= '});';
							$modal_gallery .= '</script>';
						}
					}
					// Pagawa Slideshow
					if (strtolower($content_style) == "pwgslideshow") {
						wp_enqueue_style('ts-extend-pgwslideshow');
						wp_enqueue_script('ts-extend-pgwslideshow');
						$fullwidth_allow			= "false";
						$modal_gallery .= '<div id="ts-pagawa-slideshow-container-' . $randomizer . '-container" class="ts-pagawa-slideshow-container" data-style="' . $pagawa_style . '" data-animation="' . $pagawa_animation . '" data-thumbnails="' . $pagawa_thumbnails . '" data-position="' . $pagawa_position . '" data-height="' . $pagawa_height . '" data-break="' . $pagawa_break . '" data-touch="' . $pagawa_touch . '" data-autoplay="' . $pagawa_autoplay . '" data-hover="' . $pagawa_hover . '" data-titles="' . $pagawa_titles . '" data-transition="' . $pagawa_transition . '" data-interval="' . $pagawa_interval . '">';
							$modal_gallery .= '<ul id="ts-pagawa-slideshow-wrapper-' . $randomizer . '" class="ts-pagawa-slideshow-wrapper" style="display: none;">';				
								foreach($content_combined as $image => $meta) {
									$i++;
									if ($content_external == "true") {
										$modal_image			= $meta['data_lightboxfull'];
										$modal_thumb			= $meta['data_lightboxthumb'];
										$thumb_image			= $meta['data_preview'];
										$slide_image			= $meta['data_preview'];
									} else {
										$modal_image 			= $meta['data_lightboxfull'][0];
										$modal_thumb 			= $meta['data_lightboxthumb'][0];
										$thumb_image			= TS_VCSC_CreateCustomImageSize($meta['preview'], 200, 200);
										$thumb_image			= $thumb_image[0];
										$slide_image			= $meta['data_preview'][0];
									}
									if ($i == $nachoLength) {
										$data_grid_breaks 		= str_replace(' ', '', $data_grid_breaks);
										$modal_gallery .= '<li>';
											if ($content_linkstyle != "none") {
												$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" data-thumb="' . $modal_thumb . '" class="' . $image_link_class . ' ts-pagawa-lightbox-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
											}
												$modal_gallery .= '<img src="' . $thumb_image . '" data-large-src="' . $slide_image . '" data-title="' . (!empty($meta['title']) ? $meta['title'] : "") . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-description="">';
											if ($content_linkstyle != "none") {
												$modal_gallery .= '</a>';
											}
										$modal_gallery .= '</li>';
									} else {
										$modal_gallery .= '<li>';
											if ($content_linkstyle != "none") {
												$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" data-thumb="' . $modal_thumb . '" class="' . $image_link_class . ' ts-pagawa-lightbox-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
											}
												$modal_gallery .= '<img src="' . $thumb_image . '" data-large-src="' . $slide_image . '" data-title="' . (!empty($meta['title']) ? $meta['title'] : "") . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-description="">';
											if ($content_linkstyle != "none") {
												$modal_gallery .= '</a>';
											}
										$modal_gallery .= '</li>';
									}
								}
							$modal_gallery .= '</ul>';
						$modal_gallery .= '</div>';
						if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") && ($content_linkstyle == "lightbox") && ($lightbox_pageload == "true")) {
							$modal_gallery .= '<script type="text/javascript">';
								$modal_gallery .= 'jQuery(window).load(function(){';
									$modal_gallery .= 'jQuery(".' . $nacho_group . '").krautlightbox("open");';
								$modal_gallery .= '});';
							$modal_gallery .= '</script>';
						}
					}
					// Nivo Slider Layout
					if (strtolower($content_style) == "nivoslider") {
						wp_enqueue_script('ts-extend-hammer');
						wp_enqueue_style('ts-extend-nivoslider');
						wp_enqueue_script('ts-extend-nivoslider');
						$fullwidth_allow			= "true";
						$modal_gallery .= '<div id="ts-lightbox-gallery-slider-' . $randomizer . '-container" class="ts-nivoslider-container" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';		
							// Add Progressbar
							if (($auto_play == "true") && ($show_bar == "true")) {
								$modal_gallery .= '<div id="ts-nivoslider-progressbar-container-' . $randomizer . '" class="ts-nivoslider-progressbar-container" style=""><div id="ts-nivoslider-progressbar-' . $randomizer . '" class="ts-nivoslider-progressbar" style="background: ' . $bar_color . ';"></div></div>';
							}
							// Add Play/Pause Control
							if (($auto_play == "true") && ($show_playpause == "true")) {	
								$modal_gallery .= '<div id="ts-nivoslider-controls-options-' . $randomizer . '" class="ts-nivoslider-controls-options" style="' . ((($auto_play == "true") && ($show_bar == "true")) ? "top: 0px;" : "") . '">';
									$modal_gallery .= '<span id="ts-nivoslider-controls-play-' . $randomizer . '" class="ts-nivoslider-controls-play" style="' . ($auto_play == "true" ? "display: none;" : "") . '"></span>';
									$modal_gallery .= '<span id="ts-nivoslider-controls-pause-' . $randomizer . '" class="ts-nivoslider-controls-pause" style=""></span>';
								$modal_gallery .= '</div>';
							}
							// Add Slider
							$modal_gallery .= '<div id="ts-lightbox-gallery-slider-' . $randomizer . '" class="ts-nivoslider-parent nivo-carousel nivoSlider ts-lightbox-gallery-slider" style="' . ((($auto_play == "true") && ($show_bar == "true")) ? "margin-top: 10px;" : "") . '" data-id="' . $randomizer . '" data-items="' . $number_images . '" data-rtl="' . $page_rtl . '" data-navigation="' . $dot_navigation . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '" data-lazy="' . $nivo_lazy . '" data-effect="' . $nivo_effect . '" data-slices="'. $nivo_slices . '" data-columns="'. $nivo_columns . '" data-rows="'. $nivo_rows . '" data-start="'. $nivo_start . '" data-random="'. $nivo_random . '">';
								foreach($content_combined as $image => $meta) {
									$i++;
									if ($content_external == "true") {
										$modal_image			= $meta['data_lightboxfull'];
										$preview_thumb			= $meta['data_preview'];
										$modal_thumb			= $meta['data_lightboxthumb'];
										$thumb_image			= $meta['data_preview'];								
									} else {
										$modal_image			= $meta['data_lightboxfull'][0];
										$preview_thumb			= $meta['data_preview'][0];
										$modal_thumb			= $meta['data_lightboxthumb'][0];
										$thumb_image			= $meta['data_preview'][0];
									}
									if ($i == $nachoLength) {
										$data_grid_breaks 	= str_replace(' ', '', $data_grid_breaks);
										if ($content_linkstyle != "none") {
											$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" data-thumb="' . $thumb_image . '" class="' . $image_link_class . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
										}
											$modal_gallery .= '<img src="' . ($nivo_lazy == "false" ? $preview_thumb : $image_placeholder) . '" data-nivo-lazy="' . $preview_thumb . '" data-nivo-loaded="' . ($nivo_lazy == "true" ? "false" : "true") . '" style="" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-transition-left="slideInLeft" data-transition-right="slideInRight" data-no-lazy="1" data-thumb="' . $thumb_image . '" data-title="' . (!empty($meta['title']) ? $meta['title'] : "") . '" >';
										if ($content_linkstyle != "none") {
											$modal_gallery .= '</a>';
										}
									} else {
										if ($content_linkstyle != "none") {
											$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" data-thumb="' . $thumb_image . '" class="' . $image_link_class . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
										}
											$modal_gallery .= '<img src="' . ($nivo_lazy == "false" ? $preview_thumb : $image_placeholder) . '" data-nivo-lazy="' . $preview_thumb . '" data-nivo-loaded="' . ($nivo_lazy == "true" ? "false" : "true") . '" style="" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-transition-left="slideInLeft" data-transition-right="slideInRight" data-no-lazy="1" data-thumb="' . $thumb_image . '" data-title="' . (!empty($meta['title']) ? $meta['title'] : "") . '" >';
										if ($content_linkstyle != "none") {
											$modal_gallery .= '</a>';
										}
										
									}
								}
							$modal_gallery .= '</div>';
						$modal_gallery .= '</div>';
						if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") && ($content_linkstyle == "lightbox") && ($lightbox_pageload == "true")) {
							$modal_gallery .= '<script type="text/javascript">';
								$modal_gallery .= 'jQuery(window).load(function(){';
									$modal_gallery .= 'jQuery(".' . $nacho_group . '").krautlightbox("open");';
								$modal_gallery .= '});';
							$modal_gallery .= '</script>';
						}
					}
					// SliceBox Layout
					if (strtolower($content_style) == "slicebox") {
						wp_enqueue_style('ts-extend-tooltipster');
						wp_enqueue_script('ts-extend-tooltipster');	
						wp_enqueue_style('ts-extend-slicebox');
						wp_enqueue_script('ts-extend-slicebox');
						$fullwidth_allow			= "false";
						$modal_gallery .= '<div id="ts-lightbox-gallery-slicebox-' . $randomizer . '" class="ts-lightbox-gallery-slicebox" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;" data-frontend="' . $frontend_edit . '" data-id="' . $randomizer . '" data-count="' . (count($content_images)) . '" data-images="' . $number_images . '" data-rtl="' . $page_rtl . '" data-navigation="' . $dot_navigation . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '">';
							// Add Progressbar
							if (($auto_play == "true") && ($show_bar == "true")) {
								$modal_gallery .= '<div id="ts-slicebox-progressbar-container-' . $randomizer . '" class="ts-slicebox-progressbar-container" style="width: 100%; height: 100%; background: #ededed;"><div id="ts-slicebox-progressbar-' . $randomizer . '" class="ts-slicebox-progressbar" style="background: ' . $bar_color . '; height: 10px; max-width: 100%;"></div></div>';
							}
							// Add Slider
							$modal_gallery .= '<ul class="sb-slider ts-lightbox-gallery-slicebox-slider" style="margin: 0 auto;">';
								foreach($content_combined as $image => $meta) {
									$i++;
									if ($content_external == "true") {
										$modal_image			= $meta['data_lightboxfull'];
										$preview_thumb			= $meta['data_preview'];
										$modal_thumb			= $meta['data_lightboxthumb'];
										$preview_width			= 1;
										$preview_height			= 1;
										$preview_ratio			= 1;
									} else {
										$modal_image 			= $meta['data_lightboxfull'][0];
										$preview_thumb 			= $meta['data_preview'][0];
										$preview_width			= $meta['data_preview'][1];
										$preview_height			= ($meta['data_preview'][2] == 0 ? 1 : $meta['data_preview'][2]);
										$preview_ratio			= ($preview_width / $preview_height);
										if ($content_linkstyle == "lightbox") {
											$modal_thumb 		= $meta['data_lightboxthumb'][0];
										} else {
											$modal_thumb		= '';
										}
									}
									if ($i == $nachoLength) {
										$data_grid_breaks 	= str_replace(' ', '', $data_grid_breaks);
										$modal_gallery .= '<li data-counter="' . ($i + 1) . '">';
											$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' krautgrid-item krautgrid-tile kraut-lightbox-image" style="">';
												if ($content_linkstyle != "none") {
													$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-thumb="' . $modal_thumb . '" data-title="' . (!empty($meta['title']) ? $meta['title'] : "") . '" class="' . $image_link_class . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
												}
													$modal_gallery .= '<img src="' . $preview_thumb . '" style="" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1" data-width="' . $preview_width . '" data-height="' . $preview_height . '" data-ratio="' . $preview_ratio . '" data-stack="">';
													$modal_gallery .= '<div class="krautgrid-caption ' . $image_title_class . '"></div>';
												if ($content_linkstyle != "none") {
													$modal_gallery .= '</a>';
												}
											$modal_gallery .= '</div>';
											if (!empty($meta['title'])) {
												$modal_gallery .= '<div class="sb-description">' . $meta['title'] . '</div>';
											}
										$modal_gallery .= '</li>';
									} else {
										$modal_gallery .= '<li>';
											$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' krautgrid-item krautgrid-tile kraut-lightbox-image" style="">';
												if ($content_linkstyle != "none") {
													$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-thumb="' . $modal_thumb . '" data-title="' . (!empty($meta['title']) ? $meta['title'] : "") . '" class="' . $image_link_class . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
												}
													$modal_gallery .= '<img src="' . $preview_thumb . '" style="" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1" data-width="' . $preview_width . '" data-height="' . $preview_height . '" data-ratio="' . $preview_ratio . '" data-stack="">';
													$modal_gallery .= '<div class="krautgrid-caption ' . $image_title_class . '"></div>';
												if ($content_linkstyle != "none") {
													$modal_gallery .= '</a>';
												}
											$modal_gallery .= '</div>';
											if (!empty($meta['title'])) {
												$modal_gallery .= '<div class="sb-description">' . $meta['title'] . '</div>';
											}
										$modal_gallery .= '</li>';
									}
								}
							$modal_gallery .= '</ul>';
							// Add Autoplay Controls
							if (($auto_play == "true") && ($show_playpause == "true")) {	
								$modal_gallery .= '<div id="nav-options" class="ts-slicebox-controls-options nav-options" style="' . ((($auto_play == "true") && ($show_bar == "true") && ($frontend_edit == "false")) ? "top: 10px;" : "") . '">';
									$modal_gallery .= '<span class="ts-slicebox-controls-play" style="' . ($auto_play == "true" ? "display: none;" : "") . '"></span>';
									$modal_gallery .= '<span class="ts-slicebox-controls-pause" style=""></span>';
								$modal_gallery .= '</div>';
							}
							// Add Next / Prev Navigation
							$modal_gallery .= '<div id="nav-arrows" class="ts-slicebox-controls-arrows nav-arrows">';
								$modal_gallery .= '<a class="ts-slicebox-controls-next" href="#"></a>';
								$modal_gallery .= '<a class="ts-slicebox-controls-prev" href="#"></a>';
							$modal_gallery .= '</div>';
							// Add Navigation Dots
							if ($dot_navigation == "true") {
								$modal_gallery .= '<div id="nav-dots" class="ts-slicebox-controls-dots nav-dots">';
									$i 								= -1;
									foreach($content_combined as $image => $meta) {
										$i++;
										if ($slice_tooltipthumbs == "image") {
											if ($content_external == "true") {
												$modal_image		= $meta['data_preview'];
											} else {
												$modal_image		= TS_VCSC_CreateCustomImageSize($meta['preview'], 200, 200);
												$modal_image		= $modal_image[0];
											}
											$thumb_tooltipclasses	= 'ts-has-tooltipster-tooltip';
											$thumb_tooltipcontent 	= 'data-tooltipster-image="' . $modal_image . '" data-tooltipster-title="" data-tooltipster-text="" data-tooltipster-position="' . $tooltipster_position . '" data-tooltipster-touch="false" data-tooltipster-theme="' . $tooltipster_theme . ' tooltipster-image" data-tooltipster-animation="' . $tooltipster_animation . '" data-tooltipster-arrow="true" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
										} else if (($slice_tooltipthumbs == "title") && (!empty($meta['title']))) {
											$thumb_tooltipclasses	= 'ts-has-tooltipster-tooltip';
											$thumb_tooltipcontent 	= 'data-tooltipster-image="" data-tooltipster-title="" data-tooltipster-text="' . $meta['title'] . '" data-tooltipster-position="' . $tooltipster_position . '" data-tooltipster-touch="false" data-tooltipster-theme="' . $tooltipster_theme . '" data-tooltipster-animation="' . $tooltipster_animation . '" data-tooltipster-arrow="true" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
										} else {
											$thumb_tooltipclasses	= '';
											$thumb_tooltipcontent	= '';
										}
										if ($i == 0) {
											$modal_gallery .= '<span class="nav-dot-current ts-slicebox-controls-dots ' . $thumb_tooltipclasses . '" ' . $thumb_tooltipcontent . '></span>';
										} else {
											$modal_gallery .= '<span class="ts-slicebox-controls-dots ' . $thumb_tooltipclasses . '" ' . $thumb_tooltipcontent . '></span>';
										}
									}
								$modal_gallery .= '</div>';
							}
						$modal_gallery .= '</div>';
						if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") && ($content_linkstyle == "lightbox") && ($lightbox_pageload == "true")) {
							$modal_gallery .= '<script type="text/javascript">';
								$modal_gallery .= 'jQuery(window).load(function(){';
									$modal_gallery .= 'jQuery(".' . $nacho_group . '").krautlightbox("open");';
								$modal_gallery .= '});';
							$modal_gallery .= '</script>';
						}
					}			
					// Line Stack Layout
					if (strtolower($content_style) == "stack") {
						wp_enqueue_style('ts-extend-stackslider');
						wp_enqueue_script('ts-extend-stackslider');
						$fullwidth_allow					= "false";
						$modal_gallery .= '<ul id="ts-lightbox-gallery-stack-' . $randomizer . '" class="ts-lightbox-gallery-stack" data-speed="' . $stack_speed . '" data-piles="' . $stack_piles . '" data-group="' . $nacho_group . '" data-lightbox="' . ($content_linkstyle == "lightbox" ? "true" : "false") . '">';
							foreach($content_combined as $image => $meta) {
								$i++;
								if ($content_external == "true") {
									$modal_image			= $meta['data_lightboxfull'];
									$preview_thumb			= $meta['data_preview'];
									$modal_thumb			= $meta['data_lightboxthumb'];
									$preview_width			= 1;
									$preview_height			= 1;
									$preview_ratio			= 1;
								} else {
									$modal_image 			= $meta['data_lightboxfull'][0];
									$preview_thumb 			= $meta['data_preview'][0];
									$preview_width			= $meta['data_preview'][1];
									$preview_height			= ($meta['data_preview'][2] == 0 ? 1 : $meta['data_preview'][2]);
									$preview_ratio			= ($preview_width / $preview_height);
									if ($content_linkstyle == "lightbox") {
										$modal_thumb 		= $meta['data_lightboxthumb'][0];
									} else {
										$modal_thumb		= '';
									}
								}
								if ($i == $nachoLength) {
									$data_grid_breaks 		= str_replace(' ', '', $data_grid_breaks);
									$modal_gallery .= '<li>';
										$modal_gallery .= '<div class="st-item">';
											$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' krautgrid-item krautgrid-tile kraut-lightbox-image" style="">';
												if ($content_linkstyle != "none") {
													$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="' . ($content_linkstyle == "lightbox" ? "kraut-lightbox-stack" : "kraut-lightbox-disabled") . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
												}
													$modal_gallery .= '<img src="' . $preview_thumb . '" style="" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1" data-width="' . $preview_width . '" data-height="' . $preview_height . '" data-ratio="' . $preview_ratio . '" data-stack="">';
													$modal_gallery .= '<div class="krautgrid-caption ' . $image_title_class . '"></div>';
													if (!empty($meta['title'])) {
														$modal_gallery .= '<div class="krautgrid-caption-text">' . $meta['title'] . '</div>';
													}
												if ($content_linkstyle != "none") {
													$modal_gallery .= '</a>';
												}
											$modal_gallery .= '</div>';
										$modal_gallery .= '</div>';
										if (!empty($meta['title'])) {
											$modal_gallery .= '<div class="st-title">' . $meta['title'] . '</div>';
										} else {
											$modal_gallery .= '<div class="st-title"></div>';
										}
									$modal_gallery .= '</li>';
								} else {
									$modal_gallery .= '<li>';
										$modal_gallery .= '<div class="st-item">';
											$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' krautgrid-item krautgrid-tile kraut-lightbox-image" style="">';
												if ($content_linkstyle != "none") {
													$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="' . ($content_linkstyle == "lightbox" ? "kraut-lightbox-stack" : "kraut-lightbox-disabled") . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
												}
													$modal_gallery .= '<img src="' . $preview_thumb . '" style="" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1" data-width="' . $preview_width . '" data-height="' . $preview_height . '" data-ratio="' . $preview_ratio . '" data-stack="">';
													$modal_gallery .= '<div class="krautgrid-caption ' . $image_title_class . '"></div>';
													if (!empty($meta['title'])) {
														$modal_gallery .= '<div class="krautgrid-caption-text">' . $meta['title'] . '</div>';
													}
												if ($content_linkstyle != "none") {
													$modal_gallery .= '</a>';
												}
											$modal_gallery .= '</div>';
										$modal_gallery .= '</div>';
										if (!empty($meta['title'])) {
											$modal_gallery .= '<div class="st-title">' . $meta['title'] . '</div>';
										} else {
											$modal_gallery .= '<div class="st-title"></div>';
										}
									$modal_gallery .= '</li>';
								}
							}
						$modal_gallery .= '</ul>';
						if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") && ($content_linkstyle == "lightbox") && ($lightbox_pageload == "true")) {
							$modal_gallery .= '<script type="text/javascript">';
								$modal_gallery .= 'jQuery(window).load(function(){';
									$modal_gallery .= 'jQuery(".' . $nacho_group . '").krautlightbox("open");';
								$modal_gallery .= '});';
							$modal_gallery .= '</script>';
						}
					}
					// Polaroid Stack Layout
					if (strtolower($content_style) == "polaroid") {	
						wp_enqueue_style('ts-extend-polaroidgallery');
						wp_enqueue_script('jquery-easing');
						wp_enqueue_script('ts-extend-transit');
						wp_enqueue_script('ts-extend-hammer');
						wp_enqueue_script('ts-extend-transformmatrix');
						wp_enqueue_script('ts-extend-polaroidgallery');
						$fullwidth_allow					= "false";
						$modal_polaroids					= "";
						$polaroids_height					= 0;
						$polaroids_swipe					= '';
						$polaroid_ratio						= 1;
						/*if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_JetpackPhoton_Active == "true") {
							add_filter('jetpack_photon_override_image_downsize', '__return_true');
						}*/
						foreach (($polaroid_reversal == "true" ? (array_reverse($content_combined)) : $content_combined) as $image => $meta) {
							$i++;
							if ($content_external == "true") {
								$modal_image			= $meta['data_lightboxfull'];
								$preview_thumb			= $meta['data_preview'];
								$modal_thumb			= $meta['data_lightboxthumb'];
								$preview_width			= 1;
								$preview_height			= 1;
								$preview_ratio			= 1;
								$polaroid_ratio			= 1;
							} else {
								$modal_image 			= $meta['data_lightboxfull'][0];
								$preview_thumb 			= $meta['data_preview'][0];
								$preview_width			= $meta['data_preview'][1];
								$preview_height			= ($meta['data_preview'][2] == 0 ? 1 : $meta['data_preview'][2]);
								$preview_ratio			= ($preview_width / $preview_height);
								$polaroid_ratio			= $preview_ratio;
								if ((($preview_height + 20) > $polaroids_height) && (($preview_height + 20) <= $polaroid_maxheight)) {
									$polaroids_height	= ($preview_height + 20);
								}
								if ($content_linkstyle == "lightbox") {
									$modal_thumb 		= $meta['data_lightboxthumb'][0];
								} else {
									$modal_thumb		= '';
								}
							}
							if ($i == $nachoLength) {
								$data_grid_breaks 		= str_replace(' ', '', $data_grid_breaks);
								$polaroids_swipe .= $i;
								$modal_polaroids .= '<div id="ts-polaroid-gallery-slide-' . $randomizer . '-' . $i . '" class="ts-polaroid-gallery-slide ts-polaroid-gallery-slide-hidden" style="width: ' . ($preview_width + $polaroid_whitespace) . 'px; height: ' . ($preview_height + $polaroid_whitespace) . 'px;">';
									$modal_polaroids .= '<div class="ts-polaroid-gallery-wrapper" style="width: ' . $preview_width . 'px; height: ' . $preview_height . 'px;">';								
										$modal_polaroids .= '<div class="ts-polaroid-gallery-preview" style="width: 100%; height: 100%; background-image: url(' . $preview_thumb . ');" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-width="' . $preview_width . '" data-height="' . $preview_height . '" data-ratio="' . $polaroid_ratio . '"></div>';
										if (!empty($meta['title'])) {
											$modal_polaroids .= '<div class="ts-polaroid-gallery-caption">';
												$modal_polaroids .= '<div class="ts-polaroid-gallery-caption-style1">' . (!empty($meta['title']) ? $meta['title'] : "") . '</div>';
											$modal_polaroids .= '</div>';
										}
										if ($content_linkstyle != "none") {
											$modal_polaroids .= '<div class="ts-polaroid-gallery-links">';
												$modal_polaroids .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="' . $image_link_class . ' ts-hover-image ' . $nacho_group . ' nofancybox ts-polaroid-gallery-link-lightbox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
													$modal_polaroids .= '<img src="' . $preview_thumb . '" data-no-lazy="1" style="display: none;">';
													$modal_polaroids .= '<span class="ts-ecommerce-plus3"></span>';
												$modal_polaroids .= '</a>';
											$modal_polaroids .= '</div>';
										}
									$modal_polaroids .= '</div>';
								$modal_polaroids .= '</div>';
							} else {
								$polaroids_swipe .= $i . ',';
								$modal_polaroids .= '<div id="ts-polaroid-gallery-slide-' . $randomizer . '-' . $i . '" class="ts-polaroid-gallery-slide ts-polaroid-gallery-slide-hidden" style="width: ' . ($preview_width + $polaroid_whitespace) . 'px; height: ' . ($preview_height + $polaroid_whitespace) . 'px;">';
									$modal_polaroids .= '<div class="ts-polaroid-gallery-wrapper" style="width: ' . $preview_width . 'px; height: ' . $preview_height . 'px;">';							
										$modal_polaroids .= '<div class="ts-polaroid-gallery-preview" style="width: 100%; height: 100%; background-image:  url(' . $preview_thumb . ');" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-width="' . $preview_width . '" data-height="' . $preview_height . '" data-ratio="' . $polaroid_ratio . '"></div>';
										if (!empty($meta['title'])) {
											$modal_polaroids .= '<div class="ts-polaroid-gallery-caption">';
												$modal_polaroids .= '<div class="ts-polaroid-gallery-caption-style1">' . (!empty($meta['title']) ? $meta['title'] : "") . '</div>';
											$modal_polaroids .= '</div>';
										}
										if ($content_linkstyle != "none") {
											$modal_polaroids .= '<div class="ts-polaroid-gallery-links">';
												$modal_polaroids .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="' . $image_link_class . ' ts-hover-image ' . $nacho_group . ' nofancybox ts-polaroid-gallery-link-lightbox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
													$modal_polaroids .= '<img src="' . $preview_thumb . '" data-no-lazy="1" style="display: none;">';
													$modal_polaroids .= '<span class="ts-ecommerce-plus3"></span>';
												$modal_polaroids .= '</a>';
											$modal_polaroids .= '</div>';
										}
									$modal_polaroids .= '</div>';
								$modal_polaroids .= '</div>';
							}
						}
						if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_JetpackPhoton_Active == "true") {
							//remove_filter('jetpack_photon_override_image_downsize', '__return_true');
							$content_external			= 'true';
						}
						$modal_data						= 'data-external="' . $content_external . '" data-whitespcae="' . $polaroid_whitespace . '" data-addition="20" data-initialheight="' . $polaroids_height . '" data-maxheight="' . $polaroid_maxheight . '" data-lastwidth="0" data-layout="' . $polaroid_layout . '" data-visible="' . ($polaroid_visible > $nachoLength ? $nachoLength : $polaroid_visible) . '" data-fullsize="' . $polaroid_fullsize . '" data-margin="' . $polaroid_margin . '" data-rotation="' . $polaroid_rotation . '" data-autostart="' . $polaroid_autostart . '" data-delay="' . $polaroid_delay . '" data-counter="' . $polaroid_counter . '" data-position="' . $polaroid_position . '" data-swipe="' . $polaroids_swipe . '"';
						// Polaroid Stack
						$stack_height					= 'height: ' . $polaroids_height . 'px;';
						$modal_gallery .= '<div id="ts-polaroid-gallery-stack-' . $randomizer . '" class="ts-polaroid-gallery-stack" style="width: 100%; ' . $stack_height . '" ' . $modal_data . '>';        
							// Slider Preloader
							if ($content_preloader != -1) {
								$modal_gallery .= '<div class="ts-polaroid-gallery-preloader" style="' . $stack_height . '">';
									$modal_gallery .= TS_VCSC_CreatePreloaderCSS("ts-polaroid-gallery-preloader-" . $randomizer, "", $content_preloader, "true");
								$modal_gallery .= '</div>';
							}
							// Slider Counter
							if ($polaroid_counter == 'true') {
								$modal_gallery .= '<div class="ts-polaroid-gallery-counter ts-polaroid-gallery-counter-' . $polaroid_position . '" style="display: none;">1 / ' . ($nachoLength + 1) . '</div>';
							}
							// Slider Content
							$modal_gallery .= '<div class="ts-polaroid-gallery-images" style="width: 100%; ' . $stack_height . '">';               
								$modal_gallery .= $modal_polaroids;
								$modal_polaroids 	= "";
							$modal_gallery .= '</div>';
							// Slider Controls
							$modal_gallery .= '<div class="ts-polaroid-gallery-controls ts-polaroid-gallery-controls-' . $polaroid_alignment . '" style="display: none;">';
								if (($polaroid_alignment == "topcenter") || ($polaroid_alignment == "bottomcenter")) {
									$modal_gallery .= '<div class="ts-polaroid-gallery-controls-prev">';
										$modal_gallery .= '<span class="ts-ecommerce-arrowleft2"></span>';
									$modal_gallery .= '</div>';
									$modal_gallery .= '<div class="ts-polaroid-gallery-controls-play">';
										$modal_gallery .= '<span class="ts-ecommerce-play"></span>';
									$modal_gallery .= '</div>';
									$modal_gallery .= '<div class="ts-polaroid-gallery-controls-next">';
										$modal_gallery .= '<span class="ts-ecommerce-arrowright2"></span>';
									$modal_gallery .= '</div>';
								} else {
									$modal_gallery .= '<div class="ts-polaroid-gallery-controls-next">';
										$modal_gallery .= '<span class="ts-ecommerce-arrowright2"></span>';
									$modal_gallery .= '</div>';
									$modal_gallery .= '<div class="ts-polaroid-gallery-controls-play">';
										$modal_gallery .= '<span class="ts-ecommerce-play"></span>';
									$modal_gallery .= '</div>';
									$modal_gallery .= '<div class="ts-polaroid-gallery-controls-prev">';
										$modal_gallery .= '<span class="ts-ecommerce-arrowleft2"></span>';
									$modal_gallery .= '</div>';
								}
							$modal_gallery .= '</div> ';
						$modal_gallery .= '</div>';
						if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") && ($content_linkstyle == "lightbox") && ($lightbox_pageload == "true")) {
							$modal_gallery .= '<script type="text/javascript">';
								$modal_gallery .= 'jQuery(window).load(function(){';
									$modal_gallery .= 'jQuery(".' . $nacho_group . '").krautlightbox("open");';
								$modal_gallery .= '});';
							$modal_gallery .= '</script>';
						}
					}
					// Flipster Coverflow Layout
					if (strtolower($content_style) == "flipster") {
						wp_enqueue_script('ts-extend-hammer');
						wp_enqueue_style('ts-extend-flipster');
						wp_enqueue_script('ts-extend-flipster');
						$fullwidth_allow					= "false";
						if ($flipster_style == "coverflow") {
							$flipster_spacing				= $flipster_coverflow;
						} else if ($flipster_style == "carousel") {
							$flipster_spacing				= $flipster_carousel;
						} else if ($flipster_style == "flatline") {
							$flipster_spacing				= $flipster_flatline;
						} else if ($flipster_style == "wheel") {
							$flipster_spacing				= $flipster_wheel;
						}
						$modal_gallery .= '<div id="ts-lightbox-gallery-flipster-main-' . $randomizer . '" class="ts-lightbox-gallery-flipster-main">';
							// Slider Preloader
							if ($content_preloader != -1) {
								$modal_gallery .= '<div class="ts-lightbox-gallery-flipster-preloader" style="height: 300px; position: relative;">';
									$modal_gallery .= TS_VCSC_CreatePreloaderCSS("ts-lightbox-gallery-flipster-preloader-" . $randomizer, "", $content_preloader, "true");
								$modal_gallery .= '</div>';
							}
							// Gallery Output
							$modal_gallery .= '<div id="ts-lightbox-gallery-flipster-wrapper-' . $randomizer . '" class="ts-lightbox-gallery-flipster-wrapper ts-flipster-processing" style="visibility: hidden; position: fixed; top: -99999px; left: -99999px;">';
								$modal_gallery .= '<ul id="ts-lightbox-gallery-flipster-holder-' . $randomizer . '" class="ts-lightbox-gallery-flipster-holder" data-preloader="' . ($content_preloader != -1 ? "true" : "false") . '" data-style="' . $flipster_style . '" data-maxwidth="' . $flipster_maxwidth . '" data-spacing="' . $flipster_spacing . '" data-start="' . $flipster_start . '" data-loop="' . $flipster_loop . '" data-grayout="' . $flipster_grayout . '" data-mirror="' . $flipster_mirror . '" data-arrows="' . $flipster_arrows . '" data-navigation="' . $flipster_navigation . '" data-click="' . $flipster_click . '" data-wheel="' . $flipster_mouse . '" data-touch="' . $flipster_touch . '" data-keyboard="' . $flipster_keyboard . '" data-autoplay="' . $flipster_autoplay . '" data-speed="' . $flipster_speed . '">';
									foreach($content_combined as $image => $meta) {
										$i++;
										if (($flipster_limit != 0) && ($i > ($flipster_limit - 1))) {
											$i						= ($flipster_limit - 1);
											break;
										}
										if ($content_external == "true") {
											$modal_image			= $meta['data_lightboxfull'];
											$preview_thumb			= $meta['data_preview'];
											$modal_thumb			= $meta['data_lightboxthumb'];
											$preview_width			= 1;
											$preview_height			= 1;
											$preview_ratio			= 1;
										} else {
											$modal_image 			= $meta['data_lightboxfull'][0];
											$preview_thumb 			= $meta['data_preview'][0];
											$preview_width			= $meta['data_preview'][1];
											$preview_height			= ($meta['data_preview'][2] == 0 ? 1 : $meta['data_preview'][2]);
											$preview_ratio			= ($preview_width / $preview_height);
											if ($content_linkstyle == "lightbox") {
												$modal_thumb 		= $meta['data_lightboxthumb'][0];
											} else {
												$modal_thumb		= '';
											}
										}
										if ($i == $nachoLength) {
											$data_grid_breaks 		= str_replace(' ', '', $data_grid_breaks);
											$modal_gallery .= '<li class="krautgrid-item kraut-lightbox-image ' . ($content_linkstyle == "window" ? "kraut-lightbox-window" : "") . '" data-category="" style="max-width: ' . $flipster_maxwidth . 'px;">';
												if ($content_linkstyle != "none") {
													$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="' . ($content_linkstyle == "lightbox" ? "kraut-lightbox-media" : "kraut-lightbox-disabled") . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-play="' . ($lightbox_autooption == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '></a>';
												}
												$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' ts-flipster-tile">';
													$modal_gallery .= '<img src="' . $preview_thumb . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1">';
													if (!empty($meta['title'])) {
														$modal_gallery .= '<div class="ts-flipster-title">' . $meta['title'] . '</div>';
													}
												$modal_gallery .= '</div>';
											$modal_gallery .= '</li>';
										} else {
											$modal_gallery .= '<li class="krautgrid-item kraut-lightbox-image ' . ($content_linkstyle == "window" ? "kraut-lightbox-window" : "") . '" data-category="" style="max-width: ' . $flipster_maxwidth . 'px;">';
												if ($content_linkstyle != "none") {
													$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image . '" target="_blank" data-thumbnail="' . $modal_thumb . '" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="' . ($content_linkstyle == "lightbox" ? "kraut-lightbox-media" : "kraut-lightbox-disabled") . ' ts-hover-image ' . $nacho_group . ' nofancybox" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-usecors="' . $lightbox_usecors . '" data-save="' . ($lightbox_save == "true" ? 1 : 0) . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '"></a>';
												}
												$modal_gallery .= '<div id="' . $nacho_group . '-' . $i .'-parent" class="' . $nacho_group . '-parent ' . $el_class . ' ts-flipster-tile">';
													$modal_gallery .= '<img src="' . $preview_thumb . '" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-no-lazy="1">';
													if (!empty($meta['title'])) {
														$modal_gallery .= '<div class="ts-flipster-title">' . $meta['title'] . '</div>';
													}
												$modal_gallery .= '</div>';
											$modal_gallery .= '</li>';
										}
									}
								$modal_gallery .= '</ul>';
							$modal_gallery .= '</div>';
							// Layout Excluded Images
							if ($flipster_limit != 0) {
								foreach($content_combined as $image => $meta ) {
									$k++;
									if ($k > ($flipster_limit - 1)) {
										if ($content_external == "true") {
											$modal_image		= $meta['data_lightboxfull'];
											$preview_thumb		= $meta['data_preview'];
											$modal_thumb		= $meta['data_lightboxthumb'];
										} else {
											$preview_thumb 		= $meta['data_preview'][0];
											$modal_image 		= $meta['data_lightboxfull'][0];
											$modal_thumb 		= $meta['data_lightboxthumb'][0];
										}
										$modal_gallery .= '<a style="display: none !important; width: 0px; height: 0px; margin: 0; padding: 0;" id="' . $nacho_group . '-' . $k .'" href="' . $modal_image . '" target="_blank" alt="' . (!empty($meta['alt']) ? $meta['alt'] : "") . '" data-thumbnail="' . $modal_thumb . '" data-include="false" data-title="' . (!empty($meta['lightbox']) ? $meta['lightbox'] : "") . '" class="kraut-lightbox-media no-ajaxy nofancybox kraut-lb-nogrid" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . ' data-share="' . ($lightbox_social == "true" ? 1 : 0) . '">';
											$modal_gallery .= 'Lightbox Image #' . ($k + 1);
										$modal_gallery .= '</a>';
									}
								}
							}
						$modal_gallery .= '</div>';
					}
				} else {
					$modal_gallery .= '<div class="ts-image-gallery-preview-style_message">' . __( "Gallery Style", "ts_visual_composer_extend" ) . ': ' . $gallery_type . '</div>';
					$modal_gallery .= $frontend_message;
					foreach($content_combined as $image => $meta) {
						if ($content_external == "true") {
							$modal_image					= $meta['data_lightboxfull'];
							$preview_thumb					= $meta['data_preview'];
							$modal_thumb					= $meta['data_lightboxthumb'];	
						} else {
							$preview_thumb 					= $meta['data_preview'][0];
							$modal_image 					= $meta['data_lightboxfull'][0];
							$modal_thumb 					= $meta['data_lightboxthumb'][0];
						}
						$modal_gallery .= '<div class="ts-image-gallery-preview-frontend-editor">';
							$modal_gallery .= '<img src="' . $preview_thumb . '" class="">';
						$modal_gallery .= '</div>';
					}
				}
				
				$output .= '<div id="' . $modal_id . '" class="' . $css_class . ' ' . ((($fullwidth == "true") && ($fullwidth_allow == "true") && (strtolower($content_style) != "honeycombs")) ? "ts-lightbox-nacho-full-frame" : "") . '" data-style="' . $content_style . '" data-break-parents="' . $breakouts . '" data-inline="' . $frontend_edit . '" style="margin-top: '  . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; position: relative;">';
					if (!empty($content_title)) {
						$output .= '<' . $title_wrapper . ' id="' . $nacho_group . '-title" class="ts-lightbox-nacho-title">' . $content_title. '</' . $title_wrapper . '>';
					}
					// Parse Gallery Description
					$format 					= htmlspecialchars($content);
					if ((!empty($content)) && ($content != '') && ($content != '<p></p>') && ($content != '<br>') && ($content != '<br/>') && ($content != '<br />') && ($format != '&lt;p&gt;&lt;/p&gt;') && ($format != '&lt;br&gt;') && ($format != '&lt;br/&gt;') && ($format != '&lt;br /&gt;')) {
						$output .= '<div id="' . $nacho_group . '-info" class="ts-lightbox-nacho-info kraut-lb-hide-if-javascript">';
							if (function_exists('wpb_js_remove_wpautop')){
								$output .= wpb_js_remove_wpautop(do_shortcode($content), $wpautop);
							} else {
								$output .= do_shortcode($content);
							}
						$output .= '</div>';
					}
					$output .= $modal_gallery;
				$output .= '</div>';
		
				echo $output;
				
				// Turn Photon Back On
				if ($photon_removed != '') {
					add_filter('image_downsize', array(Jetpack_Photon::instance(), 'filter_image_downsize'), 10, 3);
				}
				$photon_removed 				= '';
				
				// Clear Out Variables
				unset ($content_combined);	
				unset ($modal_gallery);
			
				$myvariable = ob_get_clean();
				return $myvariable;
			}
			
			// Add Lightbox Gallery Elements
			function TS_VCSC_Add_Lightbox_Gallery_Elements() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                          => __( "TS Image Gallery", "ts_visual_composer_extend" ),
					"base"                          => "TS_VCSC_Lightbox_Gallery",
					"icon" 	                        => "ts-composer-element-icon-lightbox-gallery",
					"class"                         => "ts_vcsc_main_lightbox_gallery",
					"category"                      => __( "Composium", "ts_visual_composer_extend" ),
					"description"                   => __("Place multiple images in a gallery", "ts_visual_composer_extend"),
					"admin_enqueue_js"              => "",
					"admin_enqueue_css"             => "",
					"params"                        => array(
						// Gallery Content
						array(
							"type"                  => "seperator",
							"param_name"            => "seperator_1",
							"seperator"				=> "Gallery Content",
						),						
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Use External Images", "ts_visual_composer_extend" ),
							"param_name"            => "content_external",
							"value"                 => "false",
							"admin_label"           => true,
							"description"           => __( "Switch the toggle if you want to use images hosted outside of the WordPress installation.", "ts_visual_composer_extend" ),
						),						
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Use Different Previews", "ts_visual_composer_extend" ),
							"param_name"            => "content_alternate",
							"value"                 => "false",
							"dependency"            => array( 'element' => "content_external", 'value' => 'false' ),
							"description"           => __( "Switch the toggle if you want to use different preview images than the ones intended for the lightbox.", "ts_visual_composer_extend" ),
						),
						// Lightbox Images
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Lightbox Image Source", "ts_visual_composer_extend" ),
							"param_name"            => "lightbox_size",
							"width"                 => 150,
							"value"                 => array(
								__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
								__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
								__( 'Medium Size Image', "ts_visual_composer_extend" )			=> "medium",
							),
							"admin_label"           => true,
							"description"           => __( "Select which image size based on WordPress settings should be used for the lightbox image.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_external", 'value' => 'false' ),
						),
						array(
							"type"                  => "attach_images",
							"heading"               => __( "Select Lightbox Images", "ts_visual_composer_extend" ),
							"holder"				=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? "imagelist" : ""),
							"param_name"            => "content_images",
							"value"                 => "",
							"admin_label"           => ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? false : true),
							"description"           => __( "Select the main images for your gallery; move images to arrange order in which to display.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_external", 'value' => 'false' ),
						),
						array(
							"type"                  => "exploded_textarea",
							"heading"               => __( "External Lightbox Image Paths", "ts_visual_composer_extend" ),
							"param_name"            => "content_paths_images",
							"value"                 => "",
							"description"           => __( "Enter the path to each external main image; separate paths by line break.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_external", 'value' => 'true' ),
						),
						// Preview Images
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Preview Images: Size", "ts_visual_composer_extend" ),
							"param_name"            => "content_images_size",
							"width"                 => 150,
							"value"                 => array(								
								__( 'Thumbnail Size Image', "ts_visual_composer_extend" )		=> "thumbnail",
								__( 'Medium Size Image', "ts_visual_composer_extend" )			=> "medium",
								__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
								__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
								__( 'Custom Image Size', "ts_visual_composer_extend" )			=> "custom",
							),
							"default"				=> "medium",
							"standard"				=> "medium",
							"std"					=> "medium",
							"admin_label"           => true,
							"description"           => __( "Select which image size based on WordPress settings should be used for the preview image.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_external", 'value' => 'false' ),
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Preview Images: Width", "ts_visual_composer_extend" ),
							"param_name"            => "content_images_width",
							"value"                 => "1280",
							"min"                   => "300",
							"max"                   => "1920",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the custom width for all gallery preview images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_images_size", 'value' => 'custom' ),
						),	
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Preview Images: Height", "ts_visual_composer_extend" ),
							"param_name"            => "content_images_height",
							"value"                 => "720",
							"min"                   => "300",
							"max"                   => "1080",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the custom height for all gallery preview images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_images_size", 'value' => 'custom' ),
						),	
						array(
							"type"                  => "attach_images",
							"heading"               => __( "Preview Images: Select", "ts_visual_composer_extend" ),
							"param_name"            => "content_previews",
							"value"                 => "",
							"admin_label"           => true,
							"description"           => __( "Select the images to be used for the previews or thumbnails; define one image for each image you defined as lightbox images above.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_alternate", 'value' => 'true' ),
						),
						array(
							"type"                  => "exploded_textarea",
							"heading"               => __( "Preview Image: External Paths", "ts_visual_composer_extend" ),
							"param_name"            => "content_paths_previews",
							"value"                 => "",
							"description"           => __( "Enter the path to each external preview image; separate paths by line break. If no images defined, images defined as external lightbox images will be used instead.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_external", 'value' => 'true' ),
						),
						// Image Information
						array(
							"type"                  => "seperator",
							"param_name"            => "seperator_2",
							"seperator"				=> "Image Information",
						),	
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Image Titles Source", "ts_visual_composer_extend" ),
							"param_name"            => "content_images_titledata",
							"width"                 => 150,
							"value"                 => array(
								__( 'Custom Image Titles', "ts_visual_composer_extend" )		=> "custom",
								__( 'WP Media ALT Tags', "ts_visual_composer_extend" )			=> "alt",
								__( 'WP Media Titles', "ts_visual_composer_extend" )			=> "title",
								__( 'WP Media Captions', "ts_visual_composer_extend" )			=> "caption",
								__( 'WP Media Descriptions', "ts_visual_composer_extend" )		=> "content",
							),
							"description"           => __( "Select which source should be used for the image title(s) shown in the (preview image) overlay(s).", "ts_visual_composer_extend" ),
						),						
						array(
							"type"                  => "exploded_textarea",
							"heading"               => __( "Image Titles", "ts_visual_composer_extend" ),
							"param_name"            => "content_images_titles",
							"value"                 => "",
							"description"           => __( "Enter titles for images; separate individual images by line break; use an empty line for image without title.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_images_titledata", 'value' => 'custom' ),
						),
						array(
							"type"              	=> "switch_button",
							"heading"			    => __( "Add Custom ALT Attribute", "ts_visual_composer_extend" ),
							"param_name"		    => "content_images_altdata",
							"value"				    => "true",
							"description"		    => __( "Switch the toggle if you want add custom ALT attribute values, otherwise WordPress ALT data or file names will be set.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  => "exploded_textarea",
							"heading"               => __( "Image ALT Tags", "ts_visual_composer_extend" ),
							"param_name"            => "content_images_alts",
							"value"                 => "",
							"description"           => __( "Enter ALT tags for images; separate individual images by line break; use an empty line for image without tag.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_images_altdata", 'value' => 'true' ),
						),
						// Gallery Info
						array(
							"type"                  => "seperator",
							"param_name"            => "seperator_3",
							"seperator"				=> "Gallery Information",
							"group" 				=> "Gallery Info",
						),
						array(
							"type"              	=> "messenger",
							"param_name"        	=> "messenger",
							"color"					=> "#006BB7",
							"size"					=> "14",
							"message"            	=> __( "This information will apply to the overall gallery, and not to an individual image within the gallery.", "ts_visual_composer_extend" ),
							"margin_top"			=> 0,
							"padding_top"			=> 0,
							"border_top"			=> "false",
							"group" 				=> "Gallery Info",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Gallery Title", "ts_visual_composer_extend" ),
							"param_name"            => "content_title",
							"value"                 => "",
							"admin_label"           => true,
							"description"           => __( "Enter a title for the gallery itself; leave empty if you don't want to show a title.", "ts_visual_composer_extend" ),
							"group" 				=> "Gallery Info",
						),
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Title Wrap", "ts_visual_composer_extend" ),
							"param_name"			=> "title_wrapper",
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
							"group" 				=> "Gallery Info",
						),	
						array(
							"type"		            => "textarea_html",
							"heading"               => __( "Gallery Description", "ts_visual_composer_extend" ),
							"param_name"            => "content",
							"value"                 => "",
							"admin_label"           => false,
							"description"           => __( "Create a detailed description / summary for the gallery.", "ts_visual_composer_extend" ),
							"group" 				=> "Gallery Info",
						),
						// Display Settings
						array(
							"type"                  => "seperator",
							"param_name"            => "seperator_4",
							"seperator"				=> "Layout Settings",
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Gallery Style", "ts_visual_composer_extend" ),
							"param_name"            => "content_style",
							"width"                 => 150,
							"value"                 => array(
								__( 'Rectangle Grid of all Images', "ts_visual_composer_extend" )				=> "Grid",
								__( 'Freewall Fluid Grid of all Images', "ts_visual_composer_extend" )			=> "Freewall",
								__( 'Honeycombs Fluid Grid of all Images', "ts_visual_composer_extend" )		=> "Honeycombs",
								__( 'First Image Only', "ts_visual_composer_extend" )							=> "First",
								__( 'Random Image Only', "ts_visual_composer_extend" )							=> "Random",
								__( 'Single Custom Image', "ts_visual_composer_extend" )						=> "Image",
								__( 'Slick Image Slider (No Thumbnails)', "ts_visual_composer_extend" )			=> "SlickSingle",
								__( 'Slick Image Slider (With Thumbnails)', "ts_visual_composer_extend" )		=> "SlickThumb",
								__( 'Owl Image Slider', "ts_visual_composer_extend" )							=> "Slider",
								__( 'Flex Image Slider (No Thumbnails)', "ts_visual_composer_extend" )			=> "FlexSingle",
								__( 'Flex Image Slider (With Thumbnails)', "ts_visual_composer_extend" )		=> "FlexThumb",
								__( 'Pagawa Slideshow', "ts_visual_composer_extend" )							=> "PWGSlideshow",
								__( 'NivoSlider', "ts_visual_composer_extend" )									=> "NivoSlider",
								__( 'SliceBox Slider', "ts_visual_composer_extend" )							=> "SliceBox",								
								__( 'Line Image Stack', "ts_visual_composer_extend" )							=> "Stack",
								__( 'Polaroid Image Stack', "ts_visual_composer_extend" )						=> "Polaroid",
								__( 'Flipster Slider', "ts_visual_composer_extend" )							=> "Flipster",
							),
							"admin_label"           => true,
							"description"           => __( "Select how the lightbox should be previewed on your page.", "ts_visual_composer_extend" ),
							"group" 				=> "Layout"
						),						
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Image Links", "ts_visual_composer_extend" ),
							"param_name"            => "content_linkstyle",
							"width"                 => 150,
							"value"                 => array(
								__( 'Open Image Links in Lightbox', "ts_visual_composer_extend" )				=> "lightbox",
								__( 'Open Image Links in New Tab', "ts_visual_composer_extend" )				=> "window",
								//__( 'Open Custom Links in Popup', "ts_visual_composer_extend" )				=> "popup",
								//__( 'Open Custom Links in New Tab', "ts_visual_composer_extend" )				=> "custom",
								__( 'Apply No Links', "ts_visual_composer_extend" )								=> "none",
							),
							"admin_label"           => true,
							"description"           => __( "Select how the gallery should handle image links.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Slider', 'FlexThumb', 'FlexSingle', 'NivoSlider', 'SliceBox', 'SlickSingle', 'SlickThumb', 'Stack', 'Polaroid', 'Flipster', 'PWGSlideshow') ),
							"group" 				=> "Layout"
						),
						array(
							"type"				    => "livepreview",
							"heading"			    => __( "Preloader Style", "ts_visual_composer_extend" ),
							"param_name"		    => "content_preloader",
							"preview"				=> "preloaders",
							"value"                 => 0,
							"description"		    => __( "Select the style for the preloader animation to be shown while the element is rendering.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Polaroid', 'Flipster') ),
							"group"					=> "Layout",
						),
						array(
							"type"				    => "livepreview",
							"heading"			    => __( "Preloader Style", "ts_visual_composer_extend" ),
							"param_name"		    => "data_grid_preloader",
							"preview"				=> "preloaders",
							"value"                 => -1,
							"description"		    => __( "Select the style for the preloader animation to be shown while the element is rendering.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid') ),
							"group"					=> "Layout",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Apply Grayscale Effect", "ts_visual_composer_extend" ),
							"param_name"            => "trigger_grayscale",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if you want to apply a grayscale effect to the trigger image.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('First', 'Image', 'Random') ),
							"group" 				=> "Layout"
						),						
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Make Gallery Full-Width", "ts_visual_composer_extend" ),
							"param_name"            => "fullwidth",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if you want to attempt showing the gallery in full width (will not work with all themes).", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid', 'Freewall', 'Honeycombs', 'Slider', 'SlickSingle', 'SlickThumb', 'FlexThumb', 'FlexSingle') ),
							//"save_always" 		=> true,
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Full Gallery Breakouts", "ts_visual_composer_extend" ),
							"param_name"            => "breakouts",
							"value"                 => "6",
							"min"                   => "0",
							"max"                   => "99",
							"step"                  => "1",
							"unit"                  => '',
							"description"           => __( "Define the number of parent containers the gallery should attempt to break away from.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "fullwidth", 'value' => 'true' ),
							"group" 				=> "Layout"
						),						
						// Image Settings
						array(
							"type"                  => "attach_image",
							"heading"               => __( "Select Image", "ts_visual_composer_extend" ),
							"param_name"            => "content_trigger_image",
							"value"                 => "",
							"description"           => __( "Select the trigger image for lightbox gallery.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Image' ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Enter TITLE Attribute", "ts_visual_composer_extend" ),
							"param_name"            => "content_trigger_title",
							"value"                 => "",
							"description"           => __( "Enter a title for the image that triggers the lightbox.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Image' ),
							"group" 				=> "Layout"
						),
						// Grid + Freewall + Honeycomb Settings						
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Comb Alignment", "ts_visual_composer_extend" ),
							"param_name"            => "honeycombs_layout",
							"width"                 => 150,
							"value"                 => array(
								__( 'Flat Comb Side on Top', "ts_visual_composer_extend" )			=> "flat",
								__( 'Comb Corner (Edge) on Top', "ts_visual_composer_extend" )		=> "edge",
							),
							"admin_label"           => true,
							"description"           => __( "Select how the honeycomb elements should be aligned inside the honeycomb grid.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Honeycombs' ),
							"group" 				=> "Layout"
						),						
						array(
							"type"                  => "textfield",
							"heading"               => __( "Grid Break Points", "ts_visual_composer_extend" ),
							"param_name"            => "data_grid_breaks",
							"value"                 => "240,480,720,960",
							"description"           => __( "Define the break points (columns) for the grid based on available screen size; separate by comma.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Grid' ),
							"group" 				=> "Layout"
						),						
						array(
							"type"                  => "textfield",
							"heading"               => __( "Comb Break Points", "ts_visual_composer_extend" ),
							"param_name"            => "honeycombs_break",
							"value"                 => "1280,960,640",
							"description"           => __( "Define the break points (width) to trigger different comb sizes; separate by comma (3 breakpoints required).", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Honeycombs' ),
							"group" 				=> "Layout"
						),						
						array(
							"type"              	=> "switch_button",
							"heading"			    => __( "Comb Rotate on Hover", "ts_visual_composer_extend" ),
							"param_name"		    => "honeycombs_rotate",
							"value"				    => "true",
							"description"		    => __( "Switch the toggle if the individual comb should have a rotating animation when hovering.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Honeycombs' ),
							"group" 				=> "Layout"
						),						
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Image Width", "ts_visual_composer_extend" ),
							"param_name"            => "freewall_width",
							"value"                 => "250",
							"min"                   => "100",
							"max"                   => "500",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the desired width of each element in the grid; will be adjusted if necessary.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Freewall' ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Comb Sizes", "ts_visual_composer_extend" ),
							"param_name"            => "honeycombs_sizes",
							"value"                 => "340,250,180,100",
							"description"           => __( "Define the individual comb sizes, triggered by the breakpoints above; separate by comma (4 sizes required).", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Honeycombs' ),
							"group" 				=> "Layout"
						),	
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Grid Space", "ts_visual_composer_extend" ),
							"param_name"            => "data_grid_space",
							"value"                 => "2",
							"min"                   => "0",
							"max"                   => "20",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the space between elements in the grid.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid', 'Freewall', 'Honeycombs') ),
							"group" 				=> "Layout"
						),
						array(
							"type"              	=> "switch_button",
							"heading"			    => __( "Maintain Image Order", "ts_visual_composer_extend" ),
							"param_name"		    => "data_grid_order",
							"value"				    => "false",
							"description"		    => __( "Switch the toggle to attempt keeping original image order in grid; plugin will always determine final order for best layout.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Grid' ),
							"group" 				=> "Layout"
						),						
						array(
							"type"              	=> "switch_button",
							"heading"			    => __( "Shuffle Images", "ts_visual_composer_extend" ),
							"param_name"		    => "data_grid_shuffle",
							"value"				    => "false",
							"description"		    => __( "Switch the toggle to randomly shuffle the image order if possible.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "data_grid_order", 'value' => 'false' ),
							"group" 				=> "Layout"
						),
						array(
							"type"              	=> "switch_button",
							"heading"			    => __( "Shuffle Images", "ts_visual_composer_extend" ),
							"param_name"		    => "freewall_shuffle",
							"value"				    => "false",
							"description"		    => __( "Switch the toggle to randomly shuffle the image order if possible.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Freewall', 'Honeycombs') ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Grid Limit", "ts_visual_composer_extend" ),
							"param_name"            => "data_grid_limit",
							"value"                 => "0",
							"min"                   => "0",
							"max"                   => "50",
							"step"                  => "1",
							"unit"                  => '',
							"description"           => __( "Define the number of images to be included in the grid; set to '0' (Zero) to include all images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid', 'Freewall', 'Honeycombs') ),
							"group" 				=> "Layout"
						),
						// Slick Slider Settings
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Limit Visible Images", "ts_visual_composer_extend" ),
							"param_name"			=> "slickmain_limituse",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if you want to limit the total number of images within the slider, but still show all images within the lightbox.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('SlickSingle', 'SlickThumb') ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Number of Visible Images", "ts_visual_composer_extend" ),
							"param_name"			=> "slickmain_limitcount",
							"value"					=> "8",
							"min"					=> "6",
							"max"					=> "36",
							"step"					=> "1",
							"unit"					=> '',
							"description"			=> __( "Define the total number of images to be shown within the slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "slickmain_limituse", 'value' => 'true' ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Display Mode", "ts_visual_composer_extend" ),
							"param_name"            => "slickmain_singlemode",
							"width"                 => 150,
							"value"                 => array(
								__( 'Multiple Slides', "ts_visual_composer_extend" )				=> "singlenone",
								__( 'Single Slides (Roll)', "ts_visual_composer_extend" )			=> "singleroll",
								__( 'Single Slides (Fade)', "ts_visual_composer_extend" )			=> "singlefade",
							),
							"description"           => __( "Select how the SlickSlider should display its slides.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'SlickSingle' ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Display Mode", "ts_visual_composer_extend" ),
							"param_name"            => "slickthumb_singlemode",
							"width"                 => 150,
							"value"                 => array(
								__( 'Single Slides (Roll)', "ts_visual_composer_extend" )			=> "singleroll",
								__( 'Single Slides (Fade)', "ts_visual_composer_extend" )			=> "singlefade",
							),
							"description"           => __( "Select how the SlickSlider should display its slides.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'SlickThumb' ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Slides to Scroll", "ts_visual_composer_extend" ),
							"param_name"            => "slickmain_scrollitems",
							"width"                 => 150,
							"value"                 => array(
								__( 'Single Slide', "ts_visual_composer_extend" )					=> "single",
								__( 'Visible Slides', "ts_visual_composer_extend" )					=> "visible",
							),
							"description"           => __( "Select how many slides should be moved when used the next/previous navigation controls.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "slickmain_singlemode", 'value' => 'singlenone' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Use Center Mode", "ts_visual_composer_extend" ),
							"param_name"			=> "slickmain_centermode",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if the slider should attempt to center the active slide among all visible slides.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "slickmain_scrollitems", 'value' => 'single' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Slide Spacing", "ts_visual_composer_extend" ),
							"param_name"			=> "slickmain_spacing",
							"value"					=> "0",
							"min"					=> "0",
							"max"					=> "30",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the spacing (margin) between the slides.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "slickmain_singlemode", 'value' => 'singlenone' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Initial Slide", "ts_visual_composer_extend" ),
							"param_name"			=> "slickmain_initialitem",
							"value"					=> "0",
							"min"					=> "0",
							"max"					=> "100",
							"step"					=> "1",
							"unit"					=> '',
							"description"			=> __( "Define the initial active slide; use 0 (zero) for the first slide.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "slickmain_singlemode", 'value' => 'singlenone' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Maximum Number of Slides", "ts_visual_composer_extend" ),
							"param_name"			=> "slickmain_maxitems",
							"value"					=> "3",
							"min"					=> "1",
							"max"					=> "10",
							"step"					=> "1",
							"unit"					=> '',
							"description"			=> __( "Define the maximum number of slides that can be visible at the same time.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "slickmain_singlemode", 'value' => 'singlenone' ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Slide Break Points", "ts_visual_composer_extend" ),
							"param_name"            => "slickmain_breakpoints",
							"value"                 => "1024/2,480/1",
							"description"           => __( "Define the break points (to determine slide count) for the slider based on available screen size; separate by comma and assign the number of slider to each breakpoint using the '/' character.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "slickmain_singlemode", 'value' => 'singlenone' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Use Infinite Scroll", "ts_visual_composer_extend" ),
							"param_name"			=> "slickmain_infinite",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to use an infinite scroll with the slider (will automatically clone first and last slides).", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "content_style", 'value' => array('SlickSingle', 'SlickThumb') ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Use Grayfilter", "ts_visual_composer_extend" ),
							"param_name"			=> "slickmain_graylayer",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to apply a gray filter to all non-current slides or thumbnails.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "content_style", 'value' => array('SlickSingle', 'SlickThumb') ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Slider Theme", "ts_visual_composer_extend" ),
							"param_name"            => "slickmain_theme",
							"width"                 => 150,
							"value"                 => array(
								__( 'Dark Theme', "ts_visual_composer_extend" )						=> "dark",
								__( 'Light Theme', "ts_visual_composer_extend" )					=> "light",
							),
							"description"           => __( "Select the overall color scheme for slider controls.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('SlickSingle', 'SlickThumb') ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Use Bullet Navigation", "ts_visual_composer_extend" ),
							"param_name"			=> "slickmain_bullets",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to provide bullets below the slider to directly navigate to slides.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "content_style", 'value' => array('SlickSingle', 'SlickThumb') ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Use RTL Mode", "ts_visual_composer_extend" ),
							"param_name"			=> "slickmain_rtlmode",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if you want to use the slider on a page in RTL layout.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "content_style", 'value' => array('SlickSingle', 'SlickThumb') ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Use AutoPlay Mode", "ts_visual_composer_extend" ),
							"param_name"			=> "slickmain_autoplay",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if you want to use the slider in auto-play mode.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('SlickSingle', 'SlickThumb') ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "AutoPlay Speed", "ts_visual_composer_extend" ),
							"param_name"			=> "slickmain_interval",
							"value"					=> "4000",
							"min"					=> "1000",
							"max"					=> "20000",
							"step"					=> "100",
							"unit"					=> '',
							"description"			=> __( "Define the interval (speed) at which the slider should auto-play to the next slide.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "slickmain_autoplay", 'value' => 'true' ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Thumbnails Position", "ts_visual_composer_extend" ),
							"param_name"            => "slickthumb_position",
							"width"                 => 150,
							"value"                 => array(
								__( 'Bottom', "ts_visual_composer_extend" )					=> "thumbsbottom",
								__( 'Top', "ts_visual_composer_extend" )					=> "thumbstop",
							),
							"description"           => __( "Select where the thumbnails should be placed in relation to the main slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'SlickThumb' ),
							"group" 				=> "Layout"
						),						
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Thumbnails Distance", "ts_visual_composer_extend" ),
							"param_name"			=> "slickthumb_distance",
							"value"					=> "10",
							"min"					=> "0",
							"max"					=> "50",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the distance between the thumbnails and the main slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'SlickThumb' ),
							"group" 				=> "Layout"
						),						
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Use Center Mode", "ts_visual_composer_extend" ),
							"param_name"			=> "slickthumb_centermode",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if the slider should attempt to center the active thumbnail among all visible thumbnails.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'SlickThumb' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Thumbnails Spacing", "ts_visual_composer_extend" ),
							"param_name"			=> "slickthumb_spacing",
							"value"					=> "0",
							"min"					=> "0",
							"max"					=> "30",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the spacing (margin) between the thumbnails.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'SlickThumb' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Maximum Number of Thumbnails", "ts_visual_composer_extend" ),
							"param_name"			=> "slickthumb_maxitems",
							"value"					=> "8",
							"min"					=> "1",
							"max"					=> "10",
							"step"					=> "1",
							"unit"					=> '',
							"description"			=> __( "Define the maximum number of thumbnails that can be visible at the same time.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'SlickThumb' ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Thumbnails Break Points", "ts_visual_composer_extend" ),
							"param_name"            => "slickthumb_breakpoints",
							"value"                 => "1440/10,1280/8,1024/7,960/6,768/5,640/4,480/3,240/2",
							"description"           => __( "Define the break points (to determine thumbnail count) for the slider based on available width; separate by comma and assign the number of thumbnails to each breakpoint using the '/' character.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'SlickThumb' ),
							"group" 				=> "Layout"
						),
						// Owl Slider Settings
						array(
							"type"					=> "css3animations",
							"heading"				=> __("In-Animation Type", "ts_visual_composer_extend"),
							"param_name"			=> "animation_in",
							"prefix"				=> "ts-viewport-css-",
							"connector"				=> "css3animations_in",
							"default"				=> "flipInX",
							"value"					=> "",
							"admin_label"			=> false,
							"description"			=> __("Select the CSS3 in-animation you want to apply to the slider.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
							"group" 			    => "Layout"
						),
						array(
							"type"					=> "hidden_input",
							"heading"				=> __( "In-Animation Type", "ts_visual_composer_extend" ),
							"param_name"			=> "css3animations_in",
							"value"					=> "",
							"admin_label"			=> false,
							"dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
							"group"					=> "Layout"
						),						
						array(
							"type"					=> "css3animations",
							"heading"				=> __("Out-Animation Type", "ts_visual_composer_extend"),
							"param_name"			=> "animation_out",
							"prefix"				=> "ts-viewport-css-",
							"connector"				=> "css3animations_out",
							"default"				=> "slideOutDown",
							"value"					=> "",
							"admin_label"			=> false,
							"description"			=> __("Select the CSS3 out-animation you want to apply to the slider.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
							"group"					=> "Layout"
						),
						array(
							"type"					=> "hidden_input",
							"heading"				=> __( "Out-Animation Type", "ts_visual_composer_extend" ),
							"param_name"			=> "css3animations_out",
							"value"					=> "",
							"admin_label"			=> false,
							"dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
							"group"					=> "Layout"
						),						
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Animation Type", "ts_visual_composer_extend" ),
							"param_name"            => "flex_animation",
							"width"                 => 150,
							"value"                 => array(
								__( 'Slide', "ts_visual_composer_extend" )				=> "slide",
								__( 'Fade', "ts_visual_composer_extend" )				=> "fade",
							),
							"description"           => __( "Select how the Flexslider should animate between the slides. A 'Fade' transition will set the slider to one item per slide.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('FlexThumb', 'FlexSingle') ),
							"group" 				=> "Layout"
						),						
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Animate on Mobile", "ts_visual_composer_extend" ),
							"param_name"			=> "animation_mobile",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if you want to show the CSS3 animations on mobile devices.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
							"group"					=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Auto-Height", "ts_visual_composer_extend" ),
							"param_name"			=> "auto_height",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want the slider to auto-adjust its height.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "RTL Page", "ts_visual_composer_extend" ),
							"param_name"			=> "page_rtl",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if the slider is used on a page with RTL (Right-To-Left) alignment.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Slider', 'FlexThumb', 'FlexSingle') ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Thumbnails Position", "ts_visual_composer_extend" ),
							"param_name"            => "flex_position",
							"width"                 => 150,
							"value"                 => array(
								__( 'Bottom', "ts_visual_composer_extend" )					=> "bottom",
								__( 'Top', "ts_visual_composer_extend" )					=> "top",
							),
							"description"           => __( "Select where the thumbnails should be positioned in relation to the main image(s).", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'FlexThumb'),
							"group" 				=> "Layout"
						),						
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Mousescroll for Thumbnails", "ts_visual_composer_extend" ),
							"param_name"			=> "flex_scroll_thumbs",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if the thumbnails can be scrolled with the mouse wheel.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'FlexThumb'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Thumbnail Break Points", "ts_visual_composer_extend" ),
							"param_name"            => "flex_breaks_thumbs",
							"value"                 => "200,400,600,800,1000,1200,1400,1600,1800",
							"description"           => __( "Define the break points (to determine thumbail count) for the slider based on available screen size; separate by comma.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'FlexThumb' ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Slide Break Points", "ts_visual_composer_extend" ),
							"param_name"            => "flex_breaks_single",
							"value"                 => "240,480,720,960,1280,1600,1980",
							"description"           => __( "Define the break points (to determine item count per slide) for the slider based on available screen size; separate by comma.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'FlexSingle' ),
							"group" 				=> "Layout"
						),						
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Max. Number of Images", "ts_visual_composer_extend" ),
							"param_name"			=> "number_images",
							"value"					=> "1",
							"min"					=> "1",
							"max"					=> "10",
							"step"					=> "1",
							"unit"					=> '',
							"description"			=> __( "Define the maximum number of images per slide.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Slider', 'FlexSingle') ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Custom Number Settings", "ts_visual_composer_extend" ),
							"param_name"			=> "break_custom",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if you want to define different numbers of elements per slide for pre-defined slider widths.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Slider') ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Items per Slide", "ts_visual_composer_extend" ),
							"param_name"            => "break_string",
							"value"                 => "1,2,3,4,5,6,7,8",
							"description"           => __( "Define the number of items per slide based on the following slider widths: 0,360,720,960,1280,1440,1600,1920; separate by comma (total of 8 values required).", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "break_custom", 'value' => 'true' ),
							"group" 				=> "Layout"
						),	
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Image Spacing", "ts_visual_composer_extend" ),
							"param_name"			=> "slide_margin",
							"value"					=> "10",
							"min"					=> "0",
							"max"					=> "50",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the spacing between slide images (if more than one element is shown per slide).", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Slider') ),
							"group" 				=> "Layout"
						),						
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Image Spacing", "ts_visual_composer_extend" ),
							"param_name"			=> "flex_margin",
							"value"					=> "0",
							"min"					=> "0",
							"max"					=> "10",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the spacing between the images in the slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('FlexThumb', 'FlexSingle') ),
							"group" 				=> "Layout"
						),						
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Mousescroll for Images", "ts_visual_composer_extend" ),
							"param_name"			=> "flex_scroll_single",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if the images can be scrolled with the mouse wheel.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'FlexSingle'),
							"group" 				=> "Layout"
						),						
						array(
							"type"              	=> "switch_button",
							"heading"				=> __( "Auto-Play", "ts_visual_composer_extend" ),
							"param_name"			=> "auto_play",
							"value"					=> "false",
							"admin_label"           => true,
							"description"			=> __( "Switch the toggle if you want the auto-play the slider on page load.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Slider', 'FlexThumb', 'FlexSingle', 'SliceBox', 'NivoSlider') ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Show Play / Pause", "ts_visual_composer_extend" ),
							"param_name"			=> "show_playpause",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to show a play / pause button to control the autoplay.", "ts_visual_composer_extend" ),
							"dependency" 			=> array("element" 	=> "auto_play", "value" => "true"),
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Show Progressbar", "ts_visual_composer_extend" ),
							"param_name"			=> "show_bar",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to show a progressbar during auto-play.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "auto_play", 'value' => 'true' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "colorpicker",
							"heading"				=> __( "Progressbar Color", "ts_visual_composer_extend" ),
							"param_name"			=> "bar_color",
							"value"					=> "#dd3333",
							"description"			=> __( "Define the color of the animated progressbar.", "ts_visual_composer_extend" ),
							"dependency"			=> array("element" 	=> "show_bar", "value" => "true"),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Auto-Play Speed", "ts_visual_composer_extend" ),
							"param_name"			=> "show_speed",
							"value"					=> "5000",
							"min"					=> "1000",
							"max"					=> "20000",
							"step"					=> "100",
							"unit"					=> 'ms',
							"description"			=> __( "Define the speed used to auto-play the slider.", "ts_visual_composer_extend" ),
							"dependency"			=> array("element" 	=> "auto_play", "value" => "true"),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Stop on Hover", "ts_visual_composer_extend" ),
							"param_name"			=> "stop_hover",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want the stop the auto-play while hovering over the slider.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "auto_play", 'value' => 'true' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Show Top Navigation", "ts_visual_composer_extend" ),
							"param_name"			=> "show_navigation",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to show a left/right navigation buttons for the slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Slider' ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Show Dot Navigation", "ts_visual_composer_extend" ),
							"param_name"			=> "dot_navigation",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to show dot navigation buttons below the slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Slider', 'FlexThumb', 'FlexSingle', 'NivoSlider', 'SliceBox') ),
							"group" 				=> "Layout"
						),												
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Border Width", "ts_visual_composer_extend" ),
							"param_name"            => "flex_border_width",
							"value"                 => "5",
							"min"                   => "0",
							"max"                   => "20",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the border width around the slider; set to 0 (zero) to remove border.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('FlexThumb', 'FlexSingle') ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "colorpicker",
							"heading"               => __( "Border Color", "ts_visual_composer_extend" ),
							"param_name"            => "flex_border_color",
							"value"                 => "#ffffff",
							"description"           => __( "Define the color for the border around the slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('FlexThumb', 'FlexSingle') ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "colorpicker",
							"heading"               => __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"            => "flex_background",
							"value"                 => "#ffffff",
							"description"           => __( "Define the background color for the slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('FlexThumb', 'FlexSingle') ),
							"group" 				=> "Layout"
						),
						// Pagawa Slideshow
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Slideshow Style", "ts_visual_composer_extend" ),
							"param_name"            => "pagawa_style",
							"width"                 => 150,
							"value"                 => array(
								__( 'Light', "ts_visual_composer_extend" )					=> "light",
								__( 'Dark', "ts_visual_composer_extend" )					=> "dark",
							),
							"description"           => __( "Select the overall style for the slideshow.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'PWGSlideshow'),
							"group" 				=> "Layout"
						),						
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Maximum Height", "ts_visual_composer_extend" ),
							"param_name"            => "pagawa_height",
							"value"                 => "0",
							"min"                   => "0",
							"max"                   => "1000",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the maximum height for the slideshow; set to 0 (zero) for auto height.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'PWGSlideshow'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Controls Adjustment", "ts_visual_composer_extend" ),
							"param_name"            => "pagawa_break",
							"value"                 => "480",
							"min"                   => "360",
							"max"                   => "1024",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the slideshow width at which thumbnails and controls should be sized smaller for small screen devices.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'PWGSlideshow'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Slideshow Animation", "ts_visual_composer_extend" ),
							"param_name"            => "pagawa_animation",
							"width"                 => 150,
							"value"                 => array(
								__( 'Slide', "ts_visual_composer_extend" )					=> "sliding",
								__( 'Fade', "ts_visual_composer_extend" )					=> "fading",
							),
							"description"           => __( "Select the transition animation between each slide.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'PWGSlideshow'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Transition Speed", "ts_visual_composer_extend" ),
							"param_name"            => "pagawa_transition",
							"value"                 => "500",
							"min"                   => "200",
							"max"                   => "1000",
							"step"                  => "100",
							"unit"                  => 'ms',
							"description"           => __( "Define the speed (duration) of each slide transition.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'PWGSlideshow'),
							"group" 				=> "Layout"
						),						
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Touch Controls", "ts_visual_composer_extend" ),
							"param_name"			=> "pagawa_touch",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to allow the slideshow to be controlled via touch gestures.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'PWGSlideshow'),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Thumbnails Navigation", "ts_visual_composer_extend" ),
							"param_name"			=> "pagawa_thumbnails",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to provide a navigation bar with image thumbnails.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'PWGSlideshow'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Thumbnails Position", "ts_visual_composer_extend" ),
							"param_name"            => "pagawa_position",
							"width"                 => 150,
							"value"                 => array(
								__( 'Bottom', "ts_visual_composer_extend" )					=> "bottom",
								__( 'Top', "ts_visual_composer_extend" )					=> "top",
							),
							"description"           => __( "Select where the thumbnail naviation bar should be placed in relation to the slideshow.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "pagawa_thumbnails", 'value' => 'true'),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Show Image Titles", "ts_visual_composer_extend" ),
							"param_name"			=> "pagawa_titles",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to also show the image titles in the slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'PWGSlideshow'),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Slideshow AutoPlay", "ts_visual_composer_extend" ),
							"param_name"			=> "pagawa_autoplay",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if you want to apply an autoplay to the slideshow.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'PWGSlideshow'),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Pause on Hover", "ts_visual_composer_extend" ),
							"param_name"			=> "pagawa_hover",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to pause the autoplay when hovering over the slideshow.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'pagawa_autoplay' => 'true'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "AutoPlay Delay", "ts_visual_composer_extend" ),
							"param_name"            => "pagawa_interval",
							"value"                 => "5000",
							"min"                   => "1000",
							"max"                   => "10000",
							"step"                  => "100",
							"unit"                  => 'ms',
							"description"           => __( "Define the autoplay delay between each slide transition.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'pagawa_autoplay' => 'true'),
							"group" 				=> "Layout"
						),
						// NivoSlider Settings
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Transition Effect", "ts_visual_composer_extend" ),
							"param_name"            => "nivo_effect",
							"width"                 => 150,
							"value"                 => array(
								__( 'Random', "ts_visual_composer_extend" )					=> "random",
								__( 'Fold', "ts_visual_composer_extend" )					=> "fold",
								__( 'Fade', "ts_visual_composer_extend" )					=> "fade",
								__( 'Slide In Right', "ts_visual_composer_extend" )			=> "slideInRight",
								__( 'Slide In Left', "ts_visual_composer_extend" )			=> "slideInLeft",								
								__( 'Slice Down', "ts_visual_composer_extend" )				=> "sliceDown",
								__( 'Slice Down Left', "ts_visual_composer_extend" )		=> "sliceDownLeft",
								__( 'Slice Up', "ts_visual_composer_extend" )				=> "sliceUp",
								__( 'Slice Up Left', "ts_visual_composer_extend" )			=> "sliceUpLeft",
								__( 'Slice Up Down', "ts_visual_composer_extend" )			=> "sliceUpDown",
								__( 'Slice Up Down Left', "ts_visual_composer_extend" )		=> "sliceUpDownLeft",								
								__( 'Box Random', "ts_visual_composer_extend" )				=> "boxRandom",
								__( 'Box Rain', "ts_visual_composer_extend" )				=> "boxRain",
								__( 'Box Rain Reverse', "ts_visual_composer_extend" )		=> "boxRainReverse",
								__( 'Box Rain Grow', "ts_visual_composer_extend" )			=> "boxRainGrow",
								__( 'Box Rain Grow Reverse', "ts_visual_composer_extend" )	=> "boxRainGrowReverse",
							),
							"description"           => __( "Select the transition effect for the slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'NivoSlider'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Number of Slices", "ts_visual_composer_extend" ),
							"param_name"            => "nivo_slices",
							"value"                 => "15",
							"min"                   => "5",
							"max"                   => "25",
							"step"                  => "1",
							"unit"                  => 'x',
							"description"           => __( "Define the number of slices for the slider animation.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "nivo_effect", 'value' => array('random', 'sliceDown', 'sliceDownLeft', 'sliceUp', 'sliceUpLeft', 'sliceUpDown', 'sliceUpDownLeft') ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Number of Columns", "ts_visual_composer_extend" ),
							"param_name"            => "nivo_columns",
							"value"                 => "8",
							"min"                   => "2",
							"max"                   => "16",
							"step"                  => "1",
							"unit"                  => 'x',
							"description"           => __( "Define the number of columns for the slider animation.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "nivo_effect", 'value' => array('random', 'boxRandom', 'boxRain', 'boxRainReverse', 'boxRainGrow', 'boxRainGrowReverse') ),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Number of Rows", "ts_visual_composer_extend" ),
							"param_name"            => "nivo_rows",
							"value"                 => "4",
							"min"                   => "2",
							"max"                   => "16",
							"step"                  => "1",
							"unit"                  => 'x',
							"description"           => __( "Define the number of rows for the slider animation.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "nivo_effect", 'value' => array('random', 'boxRandom', 'boxRain', 'boxRainReverse', 'boxRainGrow', 'boxRainGrowReverse') ),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Start with Random Image", "ts_visual_composer_extend" ),
							"param_name"			=> "nivo_random",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if you want to start the slider with a random image.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'NivoSlider'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Start Image", "ts_visual_composer_extend" ),
							"param_name"            => "nivo_start",
							"value"                 => "0",
							"min"                   => "0",
							"max"                   => "50",
							"step"                  => "1",
							"unit"                  => '',
							"description"           => __( "Define the image that should be first shown after the slider initialized; 0 (zero) equals the first image.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "nivo_random", 'value' => 'false'),
							"group" 				=> "Layout"
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Use On Demand Loading", "ts_visual_composer_extend" ),
							"param_name"            => "nivo_lazy",
							"value"                 => "false",
							"dependency"            => array( 'element' => "content_external", 'value' => 'false' ),
							"description"           => __( "Switch the toggle if you want to load the images within the slider on demand only (lazyload); might cause slight animation delays until required image has been loaded.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'NivoSlider'),
							"group" 				=> "Layout"
						),						
						// Polaroid Stack Settings
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Reverse Polaroids", "ts_visual_composer_extend" ),
							"param_name"			=> "polaroid_reversal",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to reverse the image order in order to ensure that the first image in your selection is also the top image in the polaroid stack; will also reverse order in lightbox.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Polaroid'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Max. Height", "ts_visual_composer_extend" ),
							"param_name"            => "polaroid_maxheight",
							"value"                 => "800",
							"min"                   => "200",
							"max"                   => "2048",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the maximum height for the Polaroid Stack gallery.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Polaroid'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Visible Polaroids", "ts_visual_composer_extend" ),
							"param_name"            => "polaroid_visible",
							"value"                 => "4",
							"min"                   => "2",
							"max"                   => "30",
							"step"                  => "1",
							"unit"                  => '',
							"description"           => __( "Define the additional number of Polaroids in the stack, aside from the Polaroid currently shown.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Polaroid'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Top / Bottom Margin", "ts_visual_composer_extend" ),
							"param_name"            => "polaroid_margin",
							"value"                 => "20",
							"min"                   => "0",
							"max"                   => "200",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define an additional top and bottom margin that should be applied to the Polaroid stack.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Polaroid'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Polaroid Animation", "ts_visual_composer_extend" ),
							"param_name"            => "polaroid_layout",
							"width"                 => 150,
							"value"                 => array(
								__( 'Horizontal Left', "ts_visual_composer_extend" )				=> "horizontalLeft",
								__( 'Horizontal Right', "ts_visual_composer_extend" )				=> "horizontalRight",
								__( 'Vertical Above', "ts_visual_composer_extend" )					=> "verticalAbove",
								__( 'Vertical Round', "ts_visual_composer_extend" )					=> "verticalRound",
							),
							"description"           => __( "Select how the Polaroids should be animated when going through the stack.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Polaroid'),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Autostart Polaroids", "ts_visual_composer_extend" ),
							"param_name"			=> "polaroid_autostart",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if you want to automatically cycle through the images in the polaroid stack.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Polaroid'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Controls Position", "ts_visual_composer_extend" ),
							"param_name"            => "polaroid_alignment",
							"width"                 => 150,
							"value"                 => array(
								__( 'Top Center', "ts_visual_composer_extend" )						=> "topcenter",
								__( 'Bottom Center', "ts_visual_composer_extend" )					=> "bottomcenter",
								__( 'Left Center', "ts_visual_composer_extend" )					=> "leftcenter",
								__( 'Right Center', "ts_visual_composer_extend" )					=> "rightcenter",
							),
							"description"           => __( "Select where the stack controls should be positioned in relation to the Polaroids.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Polaroid'),
							"group" 				=> "Layout"
						),		
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Show Polaroid Counter", "ts_visual_composer_extend" ),
							"param_name"			=> "polaroid_counter",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to show a counter for the Polaroids.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Polaroid'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Counter Position", "ts_visual_composer_extend" ),
							"param_name"            => "polaroid_position",
							"width"                 => 150,
							"value"                 => array(
								__( 'Top Right', "ts_visual_composer_extend" )					=> "topright",
								__( 'Top Left', "ts_visual_composer_extend" )						=> "topleft",
								__( 'Bottom Left', "ts_visual_composer_extend" )					=> "bottomleft",
								__( 'Bottom Right', "ts_visual_composer_extend" )					=> "bottomright",
							),
							"description"           => __( "Select where the Polaroid counter should be positioned in relation to the Polaroids.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "polaroid_counter", 'value' => 'true'),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Rotate Polaroids", "ts_visual_composer_extend" ),
							"param_name"			=> "polaroid_rotation",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to slightly rotate each Polaroid in the stack.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Polaroid'),
							"group" 				=> "Layout"
						),
						// Flipster Settings
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Flipster Style", "ts_visual_composer_extend" ),
							"param_name"            => "flipster_style",
							"width"                 => 150,
							"value"                 => array(
								__( 'CoverFlow', "ts_visual_composer_extend" )						=> "coverflow",
								__( 'Carousel', "ts_visual_composer_extend" )						=> "carousel",
								__( 'Flat Line', "ts_visual_composer_extend" )						=> "flatline",
								__( 'Wheel', "ts_visual_composer_extend" )							=> "wheel",
							),
							"description"           => __( "Select the layout style for the Flipster gallery.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Flipster Maximum Width", "ts_visual_composer_extend" ),
							"param_name"            => "flipster_maxwidth",
							"value"                 => "320",
							"min"                   => "200",
							"max"                   => "1024",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the maximum width an image can have within the selected layout.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Flipster Start Image", "ts_visual_composer_extend" ),
							"param_name"            => "flipster_start",
							"value"                 => "1",
							"min"                   => "0",
							"max"                   => "99",
							"step"                  => "1",
							"unit"                  => '',
							"description"           => __( "Define the image the Flipster gallery should start out with; set to 0 (zero) to center gallery layout.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),						
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Flipster Slider Limit", "ts_visual_composer_extend" ),
							"param_name"            => "flipster_limit",
							"value"                 => "0",
							"min"                   => "0",
							"max"                   => "50",
							"step"                  => "1",
							"unit"                  => '',
							"description"           => __( "Define the number of images to be included in the flipster slider; set to '0' (Zero) to include all images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),						
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Flipster Image Spacing", "ts_visual_composer_extend" ),
							"param_name"            => "flipster_coverflow",
							"value"                 => "-60",
							"min"                   => "-75",
							"max"                   => "-45",
							"step"                  => "1",
							"unit"                  => '%',
							"description"           => __( "Define how close/overlapping the images should appear; the lower the number, the closer the images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "flipster_style", 'value' => 'coverflow'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Flipster Image Spacing", "ts_visual_composer_extend" ),
							"param_name"            => "flipster_carousel",
							"value"                 => "-45",
							"min"                   => "-60",
							"max"                   => "-30",
							"step"                  => "1",
							"unit"                  => '%',
							"description"           => __( "Define how close/overlapping the images should appear; the lower the number, the closer the images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "flipster_style", 'value' => 'carousel'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Flipster Image Spacing", "ts_visual_composer_extend" ),
							"param_name"            => "flipster_flatline",
							"value"                 => "-30",
							"min"                   => "-40",
							"max"                   => "-20",
							"step"                  => "1",
							"unit"                  => '%',
							"description"           => __( "Define how close/overlapping the images should appear; the lower the number, the closer the images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "flipster_style", 'value' => 'flatline'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Flipster Image Spacing", "ts_visual_composer_extend" ),
							"param_name"            => "flipster_wheel",
							"value"                 => "-5",
							"min"                   => "-15",
							"max"                   => "0",
							"step"                  => "1",
							"unit"                  => '%',
							"description"           => __( "Define how close/overlapping the images should appear; the lower the number, the closer the images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "flipster_style", 'value' => 'wheel'),
							"group" 				=> "Layout"
						),
						/*array(
							"type"					=> "switch_button",
							"heading"				=> __( "Flipster Grayout", "ts_visual_composer_extend" ),
							"param_name"			=> "flipster_grayout",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if you want to apply a gray filter to all non-active images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),*/
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Flipster Mirror", "ts_visual_composer_extend" ),
							"param_name"			=> "flipster_mirror",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to apply a mirror effect to the bottom of all images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Flipster Loop", "ts_visual_composer_extend" ),
							"param_name"			=> "flipster_loop",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to automatically loop the Flipster slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Flipster Autoplay", "ts_visual_composer_extend" ),
							"param_name"			=> "flipster_autoplay",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if you want to automatically loop the Flipster slider.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Flipster Speed", "ts_visual_composer_extend" ),
							"param_name"            => "flipster_speed",
							"value"                 => "2000",
							"min"                   => "1000",
							"max"                   => "100000",
							"step"                  => "100",
							"unit"                  => 'ms',
							"description"           => __( "Define the speed in ms at which the Flipster slider should progress through the images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "flipster_autoplay", 'value' => 'true'),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Flipster Arrow Navigation", "ts_visual_composer_extend" ),
							"param_name"			=> "flipster_arrows",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to provide left/right navigation arrows.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Flipster Number Navigation", "ts_visual_composer_extend" ),
							"param_name"            => "flipster_navigation",
							"width"                 => 150,
							"value"                 => array(
								__( 'No Number Navigation', "ts_visual_composer_extend" )						=> "false",
								__( 'Number Navigation Above', "ts_visual_composer_extend" )					=> "before",
								__( 'Number Navigation Below', "ts_visual_composer_extend" )					=> "after",
							),
							"description"           => __( "Define if and where you want to provide an additional number navigation control for the images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Flipster Click Navigation", "ts_visual_composer_extend" ),
							"param_name"			=> "flipster_click",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to allow to navigate to images by simply clicking on them.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Flipster Touch Navigation", "ts_visual_composer_extend" ),
							"param_name"			=> "flipster_touch",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to allow the slider to be navigated by touch gestures.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Flipster Keyboard Navigation", "ts_visual_composer_extend" ),
							"param_name"			=> "flipster_keyboard",
							"value"					=> "true",
							"description"			=> __( "Switch the toggle if you want to allow the slider to be navigated by keyboard.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),
						array(
							"type"					=> "switch_button",
							"heading"				=> __( "Flipster Mouse Navigation", "ts_visual_composer_extend" ),
							"param_name"			=> "flipster_mouse",
							"value"					=> "false",
							"description"			=> __( "Switch the toggle if you want to allow the slider to be navigated by mouse wheel.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Flipster'),
							"group" 				=> "Layout"
						),
						// Filter Settings
						array(
							"type"                  => "seperator",
							"param_name"            => "seperator_6",
							"seperator"				=> "Filter Settings",
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid', 'Freewall', 'Honeycombs', 'SlickSingle', 'SlickThumb') ),
							"group" 				=> "Filter",
						),
						array(
							"type"                  => "exploded_textarea",
							"heading"               => __( "Image Groups", "ts_visual_composer_extend" ),
							"param_name"            => "content_images_groups",
							"value"                 => "",
							"description"           => __( "Enter groups or categories for images; separate multiple groups for one image with '/' and individual images by line break; use an empty line for image without group.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid', 'Freewall', 'Honeycombs', 'SlickSingle', 'SlickThumb') ),
							"group" 				=> "Filter",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Filter Toggle: Text", "ts_visual_composer_extend" ),
							"param_name"            => "filters_toggle",
							"value"                 => "Toggle Filter",
							"description"           => __( "Enter a text to be used for the filter button.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid', 'Freewall', 'Honeycombs', 'SlickSingle', 'SlickThumb') ),
							"group" 				=> "Filter",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Filter Toggle: Style", "ts_visual_composer_extend" ),
							"param_name"            => "filters_toggle_style",
							"width"                 => 150,
							"value"                 => array(
								__( 'No Style', "ts_visual_composer_extend" )				=> "",
								__( 'Sun Flower Flat', "ts_visual_composer_extend" )		=> "ts-color-button-sun-flower",
								__( 'Orange Flat', "ts_visual_composer_extend" )			=> "ts-color-button-orange-flat",
								__( 'Carot Flat', "ts_visual_composer_extend" )     		=> "ts-color-button-carrot-flat",
								__( 'Pumpkin Flat', "ts_visual_composer_extend" )			=> "ts-color-button-pumpkin-flat",
								__( 'Alizarin Flat', "ts_visual_composer_extend" )			=> "ts-color-button-alizarin-flat",
								__( 'Pomegranate Flat', "ts_visual_composer_extend" )		=> "ts-color-button-pomegranate-flat",
								__( 'Turquoise Flat', "ts_visual_composer_extend" )			=> "ts-color-button-turquoise-flat",
								__( 'Green Sea Flat', "ts_visual_composer_extend" )			=> "ts-color-button-green-sea-flat",
								__( 'Emerald Flat', "ts_visual_composer_extend" )			=> "ts-color-button-emerald-flat",
								__( 'Nephritis Flat', "ts_visual_composer_extend" )			=> "ts-color-button-nephritis-flat",
								__( 'Peter River Flat', "ts_visual_composer_extend" )		=> "ts-color-button-peter-river-flat",
								__( 'Belize Hole Flat', "ts_visual_composer_extend" )		=> "ts-color-button-belize-hole-flat",
								__( 'Amethyst Flat', "ts_visual_composer_extend" )			=> "ts-color-button-amethyst-flat",
								__( 'Wisteria Flat', "ts_visual_composer_extend" )			=> "ts-color-button-wisteria-flat",
								__( 'Wet Asphalt Flat', "ts_visual_composer_extend" )		=> "ts-color-button-wet-asphalt-flat",
								__( 'Midnight Blue Flat', "ts_visual_composer_extend" )		=> "ts-color-button-midnight-blue-flat",
								__( 'Clouds Flat', "ts_visual_composer_extend" )			=> "ts-color-button-clouds-flat",
								__( 'Silver Flat', "ts_visual_composer_extend" )			=> "ts-color-button-silver-flat",
								__( 'Concrete Flat', "ts_visual_composer_extend" )			=> "ts-color-button-concrete-flat",
								__( 'Asbestos Flat', "ts_visual_composer_extend" )			=> "ts-color-button-asbestos-flat",
								__( 'Graphite Flat', "ts_visual_composer_extend" )			=> "ts-color-button-graphite-flat",
							),
							"default"				=> "ts-color-button-belize-hole-flat",
							"std"					=> "ts-color-button-belize-hole-flat",
							"description"           => __( "Select the color scheme for the filter button.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid', 'Freewall', 'Honeycombs', 'SlickSingle', 'SlickThumb') ),
							"group" 				=> "Filter",
						),						
						array(
							"type"                  => "textfield",
							"heading"               => __( "Show All Toggle: Text", "ts_visual_composer_extend" ),
							"param_name"            => "filters_showall",
							"value"                 => "Show All",
							"description"           => __( "Enter a text to be used for the show all button.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid', 'Freewall', 'Honeycombs', 'SlickSingle', 'SlickThumb') ),
							"group" 				=> "Filter",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Show All Toggle: Style", "ts_visual_composer_extend" ),
							"param_name"            => "filters_showall_style",
							"width"                 => 150,
							"value"                 => array(
								__( 'No Style', "ts_visual_composer_extend" )				=> "",
								__( 'Sun Flower Flat', "ts_visual_composer_extend" )		=> "ts-color-button-sun-flower",
								__( 'Orange Flat', "ts_visual_composer_extend" )			=> "ts-color-button-orange-flat",
								__( 'Carot Flat', "ts_visual_composer_extend" )     		=> "ts-color-button-carrot-flat",
								__( 'Pumpkin Flat', "ts_visual_composer_extend" )			=> "ts-color-button-pumpkin-flat",
								__( 'Alizarin Flat', "ts_visual_composer_extend" )			=> "ts-color-button-alizarin-flat",
								__( 'Pomegranate Flat', "ts_visual_composer_extend" )		=> "ts-color-button-pomegranate-flat",
								__( 'Turquoise Flat', "ts_visual_composer_extend" )			=> "ts-color-button-turquoise-flat",
								__( 'Green Sea Flat', "ts_visual_composer_extend" )			=> "ts-color-button-green-sea-flat",
								__( 'Emerald Flat', "ts_visual_composer_extend" )			=> "ts-color-button-emerald-flat",
								__( 'Nephritis Flat', "ts_visual_composer_extend" )			=> "ts-color-button-nephritis-flat",
								__( 'Peter River Flat', "ts_visual_composer_extend" )		=> "ts-color-button-peter-river-flat",
								__( 'Belize Hole Flat', "ts_visual_composer_extend" )		=> "ts-color-button-belize-hole-flat",
								__( 'Amethyst Flat', "ts_visual_composer_extend" )			=> "ts-color-button-amethyst-flat",
								__( 'Wisteria Flat', "ts_visual_composer_extend" )			=> "ts-color-button-wisteria-flat",
								__( 'Wet Asphalt Flat', "ts_visual_composer_extend" )		=> "ts-color-button-wet-asphalt-flat",
								__( 'Midnight Blue Flat', "ts_visual_composer_extend" )		=> "ts-color-button-midnight-blue-flat",
								__( 'Clouds Flat', "ts_visual_composer_extend" )			=> "ts-color-button-clouds-flat",
								__( 'Silver Flat', "ts_visual_composer_extend" )			=> "ts-color-button-silver-flat",
								__( 'Concrete Flat', "ts_visual_composer_extend" )			=> "ts-color-button-concrete-flat",
								__( 'Asbestos Flat', "ts_visual_composer_extend" )			=> "ts-color-button-asbestos-flat",
								__( 'Graphite Flat', "ts_visual_composer_extend" )			=> "ts-color-button-graphite-flat",
							),
							"default"				=> "ts-color-button-green-sea-flat",
							"std"					=> "ts-color-button-green-sea-flat",
							"description"           => __( "Select the color scheme for the show all button.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid', 'Freewall', 'Honeycombs', 'SlickSingle', 'SlickThumb') ),
							"group" 				=> "Filter",
						),	
						array(
							"type"                  => "textfield",
							"heading"               => __( "Text: Available Groups", "ts_visual_composer_extend" ),
							"param_name"            => "filters_available",
							"value"                 => "Available Groups",
							"description"           => __( "Enter a text to be used a header for the section with the available groups.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid', 'Freewall', 'Honeycombs', 'SlickSingle', 'SlickThumb') ),
							"group" 				=> "Filter",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Text: Selected Groups", "ts_visual_composer_extend" ),
							"param_name"            => "filters_selected",
							"value"                 => "Filtered Groups",
							"description"           => __( "Enter a text to be used a header for the section with the selected groups.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid', 'Freewall', 'Honeycombs', 'SlickSingle', 'SlickThumb') ),
							"group" 				=> "Filter",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Text: Ungrouped Images", "ts_visual_composer_extend" ),
							"param_name"            => "filters_nogroups",
							"value"                 => "No Groups",
							"description"           => __( "Enter a text to be used to group images without any other groups applied to it.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => array('Grid', 'Freewall', 'Honeycombs', 'SlickSingle', 'SlickThumb') ),
							"group" 				=> "Filter",
						),						
						// Lightbox Settings
						array(
							"type"                  => "seperator",
							"param_name"            => "seperator_7",
							"seperator"				=> "Lightbox Settings",
							"group" 				=> "Lightbox",
						),				
						array(
							"type"              	=> "switch_button",
							"heading"			    => __( "Open on Pageload", "ts_visual_composer_extend" ),
							"param_name"		    => "lightbox_pageload",
							"value"				    => "false",
							"description"		    => __( "Switch the toggle if you want automatically open the lightbox gallery on page load.", "ts_visual_composer_extend" ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Lightbox Title Source", "ts_visual_composer_extend" ),
							"param_name"            => "lightbox_title",
							"width"                 => 150,
							"value"                 => array(
								__( 'Overlay Image Titles', "ts_visual_composer_extend" )		=> "overlay",
								__( 'WP Media ALT Tags', "ts_visual_composer_extend" )			=> "alt",
								__( 'WP Media Titles', "ts_visual_composer_extend" )			=> "title",
								__( 'WP Media Captions', "ts_visual_composer_extend" )			=> "caption",
								__( 'WP Media Descriptions', "ts_visual_composer_extend" )		=> "content",
							),
							"description"           => __( "Select which source should be used for the image titles in the lightbox.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_external", 'value' => 'false' ),
							"group" 				=> "Lightbox",
						),	
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Thumbnail Position", "ts_visual_composer_extend" ),
							"param_name"            => "thumbnail_position",
							"width"                 => 150,
							"value"                 => array(
								__( 'Bottom', "ts_visual_composer_extend" )       => "bottom",
								__( 'Top', "ts_visual_composer_extend" )          => "top",
								__( 'Left', "ts_visual_composer_extend" )         => "left",
								__( 'Right', "ts_visual_composer_extend" )        => "right",
								__( 'None', "ts_visual_composer_extend" )         => "0",
							),
							"admin_label"           => true,
							"description"           => __( "Select the position of the thumbnails in the lightbox.", "ts_visual_composer_extend" ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Thumbnail Row Height", "ts_visual_composer_extend" ),
							"param_name"            => "thumbnail_height",
							"value"                 => "100",
							"min"                   => "50",
							"max"                   => "200",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the overall height of the thumbnails section in the lightbox.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "thumbnail_position", 'value' => array('bottom', 'top', 'left', 'right') ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Thumbnail Images: Size", "ts_visual_composer_extend" ),
							"param_name"            => "thumbnail_size",
							"width"                 => 150,
							"value"                 => array(
								__( 'Use Preview Image', "ts_visual_composer_extend" )			=> "match",								
								__( 'Thumbnail Size Image', "ts_visual_composer_extend" )		=> "thumbnail",
								__( 'Medium Size Image', "ts_visual_composer_extend" )			=> "medium",
								__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
								__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
								__( 'Custom Image Size', "ts_visual_composer_extend" )			=> "custom",
							),
							"admin_label"           => true,
							"description"           => __( "Select which image size based on WordPress settings should be used for the lightbox thumbnail images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "thumbnail_position", 'value' => array('bottom', 'top', 'left', 'right') ),
							"group" 				=> "Lightbox",
						),						
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Thumbnail Images: Width", "ts_visual_composer_extend" ),
							"param_name"            => "thumbnail_custom_width",
							"value"                 => "100",
							"min"                   => "50",
							"max"                   => "200",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the custom width for all lightbox thumbnail images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "thumbnail_size", 'value' => 'custom' ),
						),	
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Thumbnail Images: Height", "ts_visual_composer_extend" ),
							"param_name"            => "thumbnail_custom_heigt",
							"value"                 => "100",
							"min"                   => "50",
							"max"                   => "200",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define the custom height for all lightbox thumbnail images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "thumbnail_size", 'value' => 'custom' ),
						),						
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Transition Effect", "ts_visual_composer_extend" ),
							"param_name"            => "lightbox_effect",
							"width"                 => 150,
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Animations,
							"default" 				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxDefaultAnimation,
							"std" 					=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxDefaultAnimation,
							"admin_label"           => true,
							"description"           => __( "Select the transition effect to be used for each image in the lightbox.", "ts_visual_composer_extend" ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"              	=> "switch_button",
							"heading"			    => __( "Autoplay Option", "ts_visual_composer_extend" ),
							"param_name"		    => "lightbox_autooption",
							"value"				    => "false",
							"description"		    => __( "Switch the toggle if you want to provide an autoplay option for the lightbox.", "ts_visual_composer_extend" ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"              	=> "switch_button",
							"heading"			    => __( "Start Autoplay", "ts_visual_composer_extend" ),
							"param_name"		    => "lightbox_autoplay",
							"value"				    => "false",
							"description"		    => __( "Switch the toggle if you want to automatically start the autoplay once the lightbox is opened the first time.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "lightbox_autooption", 'value' => 'true' ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Autoplay Speed", "ts_visual_composer_extend" ),
							"param_name"            => "lightbox_speed",
							"value"                 => "5000",
							"min"                   => "1000",
							"max"                   => "20000",
							"step"                  => "100",
							"unit"                  => 'ms',
							"description"           => __( "Define the speed at which autoplay should rotate between images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "lightbox_autooption", 'value' => 'true' ),
							"group" 				=> "Lightbox",
						),						
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Backlight Effect", "ts_visual_composer_extend" ),
							"param_name"            => "lightbox_backlight",
							"width"                 => 150,
							"value"                 => array(
								__( 'Auto Color', "ts_visual_composer_extend" )					=> "auto",
								__( 'Custom Color', "ts_visual_composer_extend" )				=> "custom",
								__( 'Transparent Backlight', "ts_visual_composer_extend" )		=> "hideit",
								__( 'Fully Remove Backlight', "ts_visual_composer_extend" )		=> "remove",
							),
							"admin_label"           => true,
							"description"           => __( "Select the backlight effect for the gallery images.", "ts_visual_composer_extend" ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"                  => "colorpicker",
							"heading"               => __( "Custom Backlight Color", "ts_visual_composer_extend" ),
							"param_name"            => "lightbox_backlight_color",
							"value"                 => "#ffffff",
							"description"           => __( "Define the backlight color for the gallery images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "lightbox_backlight", 'value' => 'custom' ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"                  => "dropdown",
							"heading"			    => __( "Force CORS Requests", "ts_visual_composer_extend" ),
							"param_name"		    => "lightbox_usecors",
							"width"                 => 150,
							"value"                 => array(
								__( 'Use Global Setting', "ts_visual_composer_extend" )       	=> "global",
								__( 'Force CORS Requests', "ts_visual_composer_extend" )		=> "true",
								__( 'Disable CORS Requests', "ts_visual_composer_extend" )		=> "false",
							),
							"admin_label"           => true,
							"description"		    => __( "Switch the toggle if you want to use CORS requests for the lightbox to retrieve color information for the backlight. Use only if your image(s) are served from an external server (i.e. CDN) and the server supports CORS.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "lightbox_backlight", 'value' => 'auto' ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"              	=> "switch_button",
							"heading"			    => __( "Image Download Buttons", "ts_visual_composer_extend" ),
							"param_name"		    => "lightbox_save",
							"value"				    => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxSaveImages,
							"description"		    => __( "Switch the toggle if you want show a download button for each image shown within the lightbox.", "ts_visual_composer_extend" ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"              	=> "switch_button",
							"heading"			    => __( "Social Share Buttons", "ts_visual_composer_extend" ),
							"param_name"		    => "lightbox_social",
							"value"				    => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxSocialShare,
							"description"		    => __( "Switch the toggle if you want show social share buttons with deeplinking for each image (if hashtag navigation enabled).", "ts_visual_composer_extend" ),
							"group" 				=> "Lightbox",
						),
						array(
							"type"              	=> "switch_button",
							"heading"			    => __( "Remove Hashtag Navigation", "ts_visual_composer_extend" ),
							"param_name"		    => "lightbox_nohashes",
							"value"				    => "true",
							"description"		    => __( "Switch the toggle if you want to remove the hashtag navigation links from the lightbox.", "ts_visual_composer_extend" ),
							"group" 				=> "Lightbox",
						),
						// Tooltip Settings
						array(
							"type"                  => "seperator",
							"param_name"            => "seperator_8",
							"seperator"				=> "Tooltip Settings",
							"group" 				=> "Tooltip",
						),
						array(
							"type"              	=> "messenger",
							"param_name"        	=> "messenger",
							"color"					=> "#AD0000",
							"size"					=> "14",
							"message"            	=> __( "The following tooltip settings apply only if the gallery can utilize tooltips.", "ts_visual_composer_extend" ),
							"group" 				=> "Tooltip"
						),
						array(
							"type"              	=> "switch_button",
							"heading"			    => __( "Thumbnail Tooltip", "ts_visual_composer_extend" ),
							"param_name"		    => "flex_tooltipthumbs",
							"value"				    => "false",
							"description"		    => __( "Switch the toggle if you want show a title tooltip with the thumbnail images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'FlexThumb' ),
							"group" 				=> "Tooltip"
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __( "Navigation Dots Tooltip", "ts_visual_composer_extend" ),
							"param_name"            => "slice_tooltipthumbs",
							"width"                 => 150,
							"value"                 => array(
								__( 'None', "ts_visual_composer_extend" )					=> "none",
								__( 'Image Title', "ts_visual_composer_extend" )			=> "title",
								__( 'Image Thumbnail', "ts_visual_composer_extend" )		=> "image",
							),
							"description"           => __( "Select which kind of tooltip should be assigned to the navigation dots.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "dot_navigation", 'value' => 'true' ),
							"group" 				=> "Tooltip"
						),
						array(
							"type"              	=> "switch_button",
							"heading"			    => __( "Honeycomb Tooltip", "ts_visual_composer_extend" ),
							"param_name"		    => "honeycombs_tooltips",
							"value"				    => "false",
							"description"		    => __( "Switch the toggle if you want show a title tooltip with the honeycomb images.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "content_style", 'value' => 'Honeycombs' ),
							"group" 				=> "Tooltip"
						),
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Tooltip Style", "ts_visual_composer_extend" ),
							"param_name"			=> "tooltipster_theme",
							"value"					=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Layouts,
							"description"			=> __( "Select the tooltip style.", "ts_visual_composer_extend" ),
							"group" 				=> "Tooltip"
						),
						array(
							"type"				    => "dropdown",
							"heading"			    => __( "Tooltip Animation", "ts_visual_composer_extend" ),
							"param_name"		    => "tooltipster_animation",
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Animations,
							"description"		    => __( "Select how the tooltip entry and exit should be animated once triggered.", "ts_visual_composer_extend" ),
							"group" 				=> "Tooltip"
						),	
						array(
							"type"				    => "dropdown",
							"heading"			    => __( "Tooltip Position", "ts_visual_composer_extend" ),
							"param_name"		    => "tooltipster_position",
							"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Vertical,
							"description"		    => __( "Select the tooltip position in relation to the trigger.", "ts_visual_composer_extend" ),
							"group" 				=> "Tooltip"
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
							"group" 				=> "Tooltip"
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
							"group" 				=> "Tooltip"
						),
						// Other Settings
						array(
							"type"                  => "seperator",
							"param_name"            => "seperator_9",
							"seperator"				=> "Other Settings",
							"group" 				=> "Other",
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
							"group" 				=> "Other",
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
							"group" 				=> "Other",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Define ID Name", "ts_visual_composer_extend" ),
							"param_name"            => "el_id",
							"value"                 => "",
							"description"           => __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
							"group" 				=> "Other",
						),
						array(
							"type"                  => "tag_editor",
							"heading"           	=> __( "Extra Class Names", "ts_visual_composer_extend" ),
							"param_name"            => "el_class",
							"value"                 => "",
							"description"      		=> __( "Enter additional class names for the element.", "ts_visual_composer_extend" ),
							"group" 				=> "Other",
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
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Lightbox_Gallery'))) {
		//class WPBakeryShortCode_TS_VCSC_Lightbox_Gallery extends WPBakeryShortCode {};
		class WPBakeryShortCode_TS_VCSC_Lightbox_Gallery extends WPBakeryShortCode {
			public function singleParamHtmlHolder($param, $value, $settings = Array(), $atts = Array()) {
				$output 		= '';
				// Compatibility Fixes
				$old_names 		= array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
				$new_names 		= array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
				$value 			= str_ireplace($old_names, $new_names, $value);
				//$value 		= __($value, "ts_visual_composer_extend");
				//
				$param_name 	= isset($param['param_name']) ? $param['param_name'] : '';
				$heading 		= isset($param['heading']) ? $param['heading'] : '';
				$type 			= isset($param['type']) ? $param['type'] : '';
				$class 			= isset($param['class']) ? $param['class'] : '';
	
				if (isset($param['holder']) === true && in_array($param['holder'], array('div', 'span', 'p', 'pre', 'code'))) {
					$output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
				} else if (isset($param['holder']) === true && $param['holder'] == 'input') {
					$output .= '<'.$param['holder'].' readonly="true" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'">';
				} else if (isset($param['holder']) === true && in_array($param['holder'], array('img', 'iframe'))) {
					if (!empty($value)) {
						$output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" src="'.$value.'">';
					}
				} else if (isset($param['holder']) === true && $param['holder'] == 'imagelist') {
					$images_ids = empty($value) ? array() : explode(',', trim($value));
					$output .= '<ul style="margin-top: 5px;" class="attachment-thumbnails' . (empty($images_ids) ? ' image-exists' : '' ) . '" data-name="' . $param_name . '">';
						foreach($images_ids as $image) {
							$img = wpb_getImageBySize(array( 'attach_id' => (int)$image, 'thumb_size' => 'thumbnail' ));
							$output .= ( $img ? '<li>'.$img['thumbnail'].'</li>' : '<li><img width="150" height="150" test="'.$image.'" src="' . WPBakeryVisualComposer::getInstance()->assetURL('vc/blank.gif') . '" class="attachment-thumbnail" alt="" title="" /></li>');
						}
					$output .= '</ul>';
					$output .= '<a style="max-width: 100%; display: block;" href="#" class="column_edit_trigger' . ( !empty($images_ids) ? ' image-exists' : '' ) . '" style="margin-bottom: 10px;">' . __( 'Add or Remove Image(s)', "ts_visual_composer_extend" ) . '</a>';
				}
				
				if (isset($param['admin_label']) && $param['admin_label'] === true) {
					$output .= '<span style="max-width: 100%; display: block;" class="vc_admin_label admin_label_' . $param['param_name'] . (empty($value) ? ' hidden-label' : '') . '"><label>'. $param['heading'] . '</label>: ' . $value . '</span>';
				}
	
				return $output;
			}
		}
	}
	// Initialize "TS Image Galleries" Class
	if (class_exists('TS_Image_Galleries')) {
		$TS_Image_Galleries = new TS_Image_Galleries;
	}
?>