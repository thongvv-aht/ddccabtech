<?php
    global $VISUAL_COMPOSER_EXTENSIONS;
    $url                                                                        = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;

    // Check if JS Files should be loaded in HEAD or BODY
    if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) 	        { $FOOTER = true; } else { $FOOTER = false; }
    
    // Icon Font Files
    // ---------------
    foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
        if ($iconfont != "Custom") {
            wp_register_style('ts-font-' . strtolower($iconfont),				$url . 'css/ts-font-' . strtolower($iconfont) . '.css', null, false, 'all');
        } else if ($iconfont == "Custom") {
            $Custom_Font_CSS                                                    = get_option('ts_vcsc_extend_settings_tinymceCustomPath', '');
            wp_register_style('ts-font-' . strtolower($iconfont) . 'vcsc', 		$Custom_Font_CSS, null, false, 'all');
        }
    }
    // Check if WP Bakery Page Builder Internal Font Files are Registered
    if ((function_exists('vc_asset_url')) && (defined('WPB_VC_VERSION'))) {
        foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Composer_Icon_Fonts as $Icon_Font => $iconfont) {
            if (strtolower($iconfont) == "vc_awesome") {
                if (!wp_style_is('font-awesome', 'registered')) {
                    wp_register_style('font-awesome', vc_asset_url('lib/bower/font-awesome/css/font-awesome.min.css'), array(), WPB_VC_VERSION);
                }
            } else if (strtolower($iconfont) == "vc_entypo") {
                if (!wp_style_is('vc_entypo', 'registered')) {
                    wp_register_style('vc_entypo', vc_asset_url('css/lib/vc-entypo/vc_entypo.min.css'), false, WPB_VC_VERSION);
                }
            } else if (strtolower($iconfont) == "vc_linecons") {
                if (!wp_style_is('vc_linecons', 'registered')) {
                    wp_register_style('vc_linecons', vc_asset_url('css/lib/vc-linecons/vc_linecons_icons.min.css'), false, WPB_VC_VERSION);
                }
            } else if (strtolower($iconfont) == "vc_openiconic") {
                if (!wp_style_is('vc_openiconic', 'registered')) {
                    wp_register_style('vc_openiconic', vc_asset_url('css/lib/vc-open-iconic/vc_openiconic.min.css'), false, WPB_VC_VERSION);
                }
            } else if (strtolower($iconfont) == "vc_typicons") {
                if (!wp_style_is('vc_typicons', 'registered')) {
                    wp_register_style('vc_typicons', vc_asset_url('css/lib/typicons/src/font/typicons.min.css'), false, WPB_VC_VERSION);
                }
            } else if (strtolower($iconfont) == "vc_monosocial") {
                if ((!wp_style_is('vc_monosocialiconsfont', 'registered')) && (TS_VCSC_VersionCompare(WPB_VC_VERSION, '4.11.0') >= 0)) {
                    wp_register_style('vc_monosocialiconsfont', vc_asset_url('css/lib/monosocialiconsfont/monosocialiconsfont.min.css'), false, WPB_VC_VERSION);
                }
            } else if (strtolower($iconfont) == "vc_material") {
                if ((!wp_style_is('vc_material', 'registered')) && (TS_VCSC_VersionCompare(WPB_VC_VERSION, '5.0.0') >= 0)) {
                    wp_register_style('vc_material', vc_asset_url('css/lib/vc-material/vc_material.min.css'), false, WPB_VC_VERSION);
                }
            }
        }
    }
    // Custom Table Styling Font
    wp_register_style('ts-font-tablefont', 		                                $url . 'css/ts-font-tablefont.css', null, false, 'all');
    
    // Map Marker Image Font
    wp_register_style('ts-font-mapmarker', 		                                $url . 'css/ts-font-mapmarker.css', null, false, 'all');

    // Internal Files
    // --------------
    // Front-End Files
    wp_register_style('ts-visual-composer-extend-custom',						false, null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-custom',						false, array('jquery'), COMPOSIUM_VERSION, true);
    wp_register_style('ts-visual-composer-extend-front',						$url . 'css/ts-visual-composer-extend-front.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-front',						$url . 'js/ts-visual-composer-extend-front.min.js', array('jquery'), COMPOSIUM_VERSION, $FOOTER);
    wp_register_script('ts-visual-composer-extend-galleries',					$url . 'js/ts-visual-composer-extend-galleries.min.js', array('jquery'), COMPOSIUM_VERSION, $FOOTER);
    wp_register_script('ts-visual-composer-extend-backgrounds',					$url . 'js/ts-visual-composer-extend-backgrounds.min.js', array('jquery'), COMPOSIUM_VERSION, $FOOTER);    
    wp_register_script('ts-visual-composer-extend-dependencies',				$url . 'js/ts-visual-composer-extend-dependencies.min.js', array('jquery'), COMPOSIUM_VERSION, $FOOTER);    
    wp_register_style('ts-visual-composer-extend-editor',						$url . 'css/ts-visual-composer-extend-editor.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-editor',					    $url . 'js/ts-visual-composer-extend-editor.min.js', array('jquery'), COMPOSIUM_VERSION, $FOOTER);
    wp_register_style('ts-visual-composer-extend-demos',						$url . 'css/ts-visual-composer-extend-demos.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-demos',						$url . 'js/ts-visual-composer-extend-demos.min.js', array('jquery'), COMPOSIUM_VERSION, $FOOTER);
    // Front-End Forms
    wp_register_style('ts-visual-composer-extend-forms',						$url . 'css/ts-visual-composer-extend-forms.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-forms',						$url . 'js/ts-visual-composer-extend-forms.min.js', array('jquery'), COMPOSIUM_VERSION, $FOOTER);
    // General Animations Files
    wp_register_style('ts-extend-animations',                 					$url . 'css/ts-visual-composer-extend-animations.min.css', null, COMPOSIUM_VERSION, 'all');
    // General Settings Files
    wp_register_style('ts-vcsc-extend',                              			$url . 'css/ts-visual-composer-extend-settings.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-vcsc-extend', 										$url . 'js/ts-visual-composer-extend-settings.min.js', array('jquery'), COMPOSIUM_VERSION, true);
    // Post Type Settings Files
    wp_register_script('ts-extend-posttypes', 									$url . 'js/ts-visual-composer-extend-posttypes.min.js', array('jquery'), COMPOSIUM_VERSION, true);
    wp_register_style('ts-extend-posttypes',									$url . 'css/ts-visual-composer-extend-posttypes.min.css', null, COMPOSIUM_VERSION, 'all');
    // EnlighterJS Theme Builder
    wp_register_script('ts-extend-themebuilder', 								$url . 'js/ts-visual-composer-extend-themebuilder.min.js', array('jquery'), COMPOSIUM_VERSION, true);
    wp_register_style('ts-extend-themebuilder',									$url . 'css/ts-visual-composer-extend-themebuilder.min.css', null, COMPOSIUM_VERSION, 'all');
    // Plugin Admin Files
    wp_register_style('ts-visual-composer-extend-admin',             			$url . 'css/ts-visual-composer-extend-admin.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-admin',            			$url . 'js/ts-visual-composer-extend-admin.min.js', array('jquery'), COMPOSIUM_VERSION, true);
    // Downtime Manager Files
     wp_register_style('ts-visual-composer-extend-downtime',             		$url . 'css/ts-visual-composer-extend-downtime.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-downtime',            		$url . 'js/ts-visual-composer-extend-downtime.min.js', array('jquery'), COMPOSIUM_VERSION, true);
    // Sidebars Manager Files
    wp_register_script('ts-visual-composer-extend-sidebars',            		$url . 'js/ts-visual-composer-extend-sidebars.min.js', array('jquery'), COMPOSIUM_VERSION, true);
    // Google Fonts Manager Files
    wp_register_style('ts-visual-composer-extend-google',             			$url . 'css/ts-visual-composer-extend-google.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-google',            			$url . 'js/ts-visual-composer-extend-google.min.js', array('jquery'), COMPOSIUM_VERSION, true);
    // Custom Fonts Manager Files
    wp_register_style('ts-visual-composer-extend-fonts',             			$url . 'css/ts-visual-composer-extend-fonts.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-fonts',            			$url . 'js/ts-visual-composer-extend-fonts.min.js', array('jquery'), COMPOSIUM_VERSION, true);
    // Font Icon Generator Files
    wp_register_style('ts-visual-composer-extend-generator',				    $url . 'css/ts-visual-composer-extend-generator.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-generator',				    $url . 'js/ts-visual-composer-extend-generator.min.js', array('wp-color-picker'), COMPOSIUM_VERSION, true);
    // WP Bakery Page Builder Styling + Elements
    wp_register_style('ts-visual-composer-extend-parameters',                   $url . 'css/ts-visual-composer-extend-parameters.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-parameters',					$url . 'js/ts-visual-composer-extend-parameters.min.js', array('jquery'), COMPOSIUM_VERSION, $FOOTER);
    wp_register_style('ts-visual-composer-extend-preview',						$url . 'css/ts-visual-composer-extend-preview.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_style('ts-visual-composer-extend-basic',						$url . 'css/ts-visual-composer-extend-basic.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_style('ts-visual-composer-extend-composer',						$url . 'css/ts-visual-composer-extend-composer.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-categories',                  $url . 'js/ts-visual-composer-extend-categories.min.js', array('jquery'), COMPOSIUM_VERSION, true);    
    // Widgets
    wp_register_style('ts-visual-composer-extend-widgets',						$url . 'css/ts-visual-composer-extend-widgets.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-widgets',						$url . 'js/ts-visual-composer-extend-widgets.min.js', array('jquery'), COMPOSIUM_VERSION, $FOOTER);
    // Usage Statistics
    wp_register_style('ts-visual-composer-extend-statistics',					$url . 'css/ts-visual-composer-extend-statistics.min.css', null, COMPOSIUM_VERSION, 'all');
    wp_register_script('ts-visual-composer-extend-statistics',					$url . 'js/ts-visual-composer-extend-statistics.min.js', array('jquery'), COMPOSIUM_VERSION, $FOOTER);
    // Buttons Styling
    wp_register_style('ts-visual-composer-extend-buttons',					    $url . 'css/ts-visual-composer-extend-buttons.min.css', null, COMPOSIUM_VERSION, 'all');
    
    // WP Bakery Page Builder Backbone
    wp_register_script('ts-vcsc-backend-rows',									$url . 'js/backend/ts-vcsc-backend-rows.min.js', array('jquery'), COMPOSIUM_VERSION, true);
    wp_register_script('ts-vcsc-backend-other',									$url . 'js/backend/ts-vcsc-backend-other.min.js', array('jquery'), COMPOSIUM_VERSION, true);
    wp_register_script('ts-vcsc-backend-basic',									$url . 'js/backend/ts-vcsc-backend-basic.min.js', array('jquery'), COMPOSIUM_VERSION, true);
    wp_register_script('ts-vcsc-backend-shortcode',								$url . 'js/backend/ts-vcsc-backend-shortcode.min.js', array('jquery'), COMPOSIUM_VERSION, true);
    wp_register_script('ts-vcsc-backend-collapse',								$url . 'js/backend/ts-vcsc-backend-collapse.min.js', array('jquery'), COMPOSIUM_VERSION, true);
    
    // E-Commerce Font
    wp_register_style('ts-font-ecommerce',                 						$url . 'css/ts-font-ecommerce.css', null, COMPOSIUM_VERSION, 'all');
    // Teammate Font
    wp_register_style('ts-font-teammates',                 						$url . 'css/ts-font-teammates.css', null, COMPOSIUM_VERSION, 'all');
    // Mediaplayer Font
    wp_register_style('ts-font-mediaplayer',                 					$url . 'css/ts-font-mediaplayer.css', null, COMPOSIUM_VERSION, 'all');
    // Classy Gradient
    wp_register_script('ts-extend-classygradient',					            $url . 'js/jquery.vcsc.classygradient.min.js', array('jquery'), false, true);
    // Advanced Colorpicker
    wp_register_style('ts-extend-colorpicker',					                $url . 'css/jquery.vcsc.colorpicker.min.css', null, false, 'all');
    wp_register_script('ts-extend-colorpicker',					                $url . 'js/jquery.vcsc.colorpicker.min.js', array('jquery'), false, true);
    // Alpha Colorpicker
    wp_register_script('ts-extend-colorpickeralpha',                            $url . 'js/jquery.vcsc.colorpickeralpha.min.js', array('jquery','wp-color-picker'), false, true);
    // Font Icon Picker
    wp_register_style('ts-extend-iconpicker',					                $url . 'css/jquery.vcsc.fonticonpicker.min.css', null, false, 'all');
    wp_register_script('ts-extend-iconpicker',					                $url . 'js/jquery.vcsc.fonticonpicker.min.js', array('jquery'), false, true);
    // Perfect Scrollbar
    wp_register_style('ts-extend-perfectscrollbar',                             $url . 'css/jquery.vcsc.perfectscrollbar.min.css', null, false, 'all');
    wp_register_script('ts-extend-perfectscrollbar',                            $url . 'js/jquery.vcsc.perfectscrollbar.min.js', array('jquery'), false, $FOOTER);
    
    
    /* Other Main Libraries */
    /* -------------------- */
    // MooTools (NoConflict)
    wp_register_script('ts-library-mootools',								    $url . 'js/mootools.main.more.min.js', null, '1.6.0', false);

    
    // 3rd Party Files
    // ---------------
    // Hammer
    if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LoadFrontEndHammerNew == "true") {
        wp_register_script('ts-extend-hammer', 								    $url . 'js/jquery.vcsc.hammer2.min.js', array('jquery'), '2.0.4', $FOOTER);
    } else {
        wp_register_script('ts-extend-hammer', 								    $url . 'js/jquery.vcsc.hammer1.min.js', array('jquery'), '1.1.3', $FOOTER);
    }
    // TouchSwipe
    wp_register_script('ts-extend-touchswipe',                                  $url . 'js/jquery.vcsc.touchswipe.min.js', array('jquery'), false, $FOOTER);
    // Lightbox
    if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseInternalLightbox == "true") {
        if ((((array_key_exists('customscroll', $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxGlobalSettings)) ? $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_LightboxGlobalSettings['customscroll'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults['customscroll']) == 1 ? 'true' : 'false') == "true") {
            wp_register_style('ts-extend-krautlightbox',                        $url . 'css/jquery.vcsc.krautlightbox.min.css', array('ts-extend-perfectscrollbar'), COMPOSIUM_VERSION, 'all');
            wp_register_script('ts-extend-krautlightbox',                       $url . 'js/jquery.vcsc.krautlightbox.min.js', array('jquery', 'ts-extend-hammer', 'ts-extend-perfectscrollbar'), COMPOSIUM_VERSION, true);
        } else {
            wp_register_style('ts-extend-krautlightbox',                        $url . 'css/jquery.vcsc.krautlightbox.min.css', null, COMPOSIUM_VERSION, 'all');
            wp_register_script('ts-extend-krautlightbox',                       $url . 'js/jquery.vcsc.krautlightbox.min.js', array('jquery', 'ts-extend-hammer'), COMPOSIUM_VERSION, true);
        }
    }
    // Textillate Animations Files
    wp_register_style('ts-extend-textillate',                 					$url . 'css/jquery.vcsc.textillate.min.css', null, false, 'all');
    wp_register_script('ts-extend-textillate',									$url . 'js/jquery.vcsc.textillate.min.js', array('jquery'), false, $FOOTER);
    // Patternbolt Pattern
    wp_register_style('ts-extend-patternbolt',                 					$url . 'css/jquery.vcsc.patternbolt.min.css', null, false, 'all');
    // iHover Effects
    wp_register_style('ts-extend-ihover',                 						$url . 'css/jquery.vcsc.ihover.min.css', null, false, 'all');
    wp_register_script('ts-extend-ihover',										$url . 'js/jquery.vcsc.ihover.min.js', array('jquery'), false, $FOOTER);
    // YouTube iFrame API
    wp_register_script('ts-extend-youtube-iframe',                              'https://www.youtube.com/iframe_api', null, false, $FOOTER);
    // Google Charts API
    wp_register_script('ts-extend-google-charts',								'https://www.google.com/jsapi', array('jquery'), false, false);
    wp_register_style('ts-extend-google-charts',                 				$url . 'css/jquery.vcsc.googlecharts.min.css', null, false, 'all');
    // Google Maps API
    if (isset($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_InformationExternalAPIs['GoogleMaps'])) {
        wp_register_script('ts-extend-mapapi-none',								'https://maps.google.com/maps/api/js?key=' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_InformationExternalAPIs['GoogleMaps'], false, false, false);
        wp_register_script('ts-extend-mapapi-library',							'https://maps.google.com/maps/api/js?key=' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_InformationExternalAPIs['GoogleMaps'] . '&libraries=places,geometry', false, false, false);
    } else {
        wp_register_script('ts-extend-mapapi-none',								'https://maps.google.com/maps/api/js', false, false, false);
        wp_register_script('ts-extend-mapapi-library',							'https://maps.google.com/maps/api/js?libraries=places,geometry', false, false, false);
    }
    // Custom Google Map Scripts
    wp_register_script('ts-extend-infobox', 									$url . 'js/jquery.vcsc.infobox.min.js', array('jquery'), false, $FOOTER);
    wp_register_script('ts-extend-googlemap', 									$url . 'js/jquery.vcsc.googlemap.min.js', array('jquery'), false, $FOOTER);    
    wp_register_style('ts-extend-googlemapsplus',                 				$url . 'css/jquery.vcsc.gomapplus.min.css', null, false, 'all');
    wp_register_script('ts-extend-googlemapsplus', 								$url . 'js/jquery.vcsc.gomapplus.min.js', array('jquery'), false, $FOOTER);
    wp_register_script('ts-extend-markerclusterer', 							$url . 'js/jquery.vcsc.markerclusterer.min.js', array('jquery','ts-extend-googlemapsplus'), false, $FOOTER);    
    // Waypoints
    wp_register_script('ts-extend-waypoints',									$url . 'js/jquery.vcsc.waypoints.min.js', array('jquery'), false, $FOOTER);
    // Waypoints Sticky
    wp_register_script('ts-extend-waypointssticky',								$url . 'js/jquery.vcsc.waypoints.sticky.min.js', array('jquery'), false, $FOOTER);    
    // Particles
    wp_register_script('ts-extend-particles',									$url . 'js/jquery.vcsc.particles.min.js', array('jquery'), false, $FOOTER);
    // Pricing Tables
    wp_register_style('ts-extend-pricingtables',                 				$url . 'css/jquery.vcsc.pricingtables.min.css', null, false, 'all');
    wp_register_style('ts-extend-pricinginspired',                 				$url . 'css/jquery.vcsc.pricinginspired.min.css', null, false, 'all');
    // Tooltipster Tooltips
    wp_register_style('ts-extend-tooltipster',                 					$url . 'css/jquery.vcsc.tooltipster.min.css', null, false, 'all');
    wp_register_script('ts-extend-tooltipster',									$url . 'js/jquery.vcsc.tooltipster.min.js', array('jquery'), false, $FOOTER);			
    // YouTube Player
    wp_register_style('ts-extend-ytplayer',										$url . 'css/jquery.vcsc.mb.ytplayer.min.css', null, false, 'all');
    wp_register_script('ts-extend-ytplayer',									$url . 'js/jquery.vcsc.mb.ytplayer.min.js', array('jquery'), false, false);
    // Multibackground Player
    wp_register_script('ts-extend-multibackground',								$url . 'js/jquery.vcsc.multibackground.min.js', array('jquery'), false, false);
    // CountUp Counter
    wp_register_script('ts-extend-countup',										$url . 'js/jquery.vcsc.countup.min.js', array('jquery'), false, $FOOTER);
    // Circliful Counter
    wp_register_script('ts-extend-circliful', 									$url . 'js/jquery.vcsc.circliful.min.js', array('jquery'), false, $FOOTER);
    // Countdown Script
    wp_register_style('ts-extend-countdown',									$url . 'css/jquery.vcsc.countdown.min.css', null, false, 'all');
    wp_register_script('ts-extend-countdown',									$url . 'js/jquery.vcsc.countdown.min.js', array('jquery'), false, $FOOTER);  
    // Liquid Gauge Counter
    wp_register_script('ts-extend-d3v3', 								        $url . 'js/jquery.vcsc.d3.v3.min.js', array('jquery'), false, $FOOTER);  
    wp_register_script('ts-extend-wavegauge', 								    $url . 'js/jquery.vcsc.wavegauge.min.js', array('jquery'), false, $FOOTER);    
    // Buttons CSS
    wp_register_style('ts-extend-buttons',                 						$url . 'css/jquery.vcsc.buttons.min.css', null, false, 'all');
    // Buttons Flex CSS
    wp_register_style('ts-extend-buttonsflex',                 					$url . 'css/jquery.vcsc.buttons.flex.min.css', null, false, 'all');
    // Buttons Flat CSS
    wp_register_style('ts-extend-buttonsflat',                 					$url . 'css/jquery.vcsc.buttons.flat.min.css', null, false, 'all');
    // Buttons Creative Link
    wp_register_style('ts-extend-creativelinks',                 				$url . 'css/jquery.vcsc.creativelinks.min.css', null, false, 'all');
    // Buttons Dual CSS
    wp_register_style('ts-extend-buttonsdual',                 					$url . 'css/jquery.vcsc.buttons.dual.min.css', null, false, 'all');
    // Badonkatrunc Shortener
    wp_register_script('ts-extend-badonkatrunc',								$url . 'js/jquery.vcsc.badonkatrunc.min.js', array('jquery'), false, $FOOTER);
    // QR-Code Maker
    wp_register_script('ts-extend-qrcode',										$url . 'js/jquery.vcsc.qrcode.min.js', array('jquery'), false, $FOOTER);
    // Image Adipoli
    wp_register_script('ts-extend-adipoli', 									$url . 'js/jquery.vcsc.adipoli.min.js', array('jquery'), false, $FOOTER);
    // Amaran Popup
    wp_register_style('ts-extend-amaran',				        				$url . 'css/jquery.vcsc.amaran.min.css', null, false, 'all');
    wp_register_script('ts-extend-amaran',			            				$url . 'js/jquery.vcsc.amaran.min.js', array('jquery'), false, $FOOTER);
    // Element Focus
    wp_register_script('ts-extend-elementfocus',			            		$url . 'js/jquery.vcsc.elementfocus.min.js', array('jquery'), false, $FOOTER);
    // SweetAlert Popup
    wp_register_style('ts-extend-sweetalert',				        			$url . 'css/jquery.vcsc.sweetalert.min.css', null, false, 'all');
    wp_register_script('ts-extend-sweetalert',			            			$url . 'js/jquery.vcsc.sweetalert.min.js', array('jquery'), false, $FOOTER);
    // Image Caman
    wp_register_script('ts-extend-caman', 										$url . 'js/jquery.vcsc.caman.full.min.js', array('jquery'), false, $FOOTER);
    // Image TiltFX
    wp_register_script('ts-extend-tiltfx', 										$url . 'js/jquery.vcsc.tiltfx.min.js', array('jquery'), false, $FOOTER);
    // Owl Carousel 2
    wp_register_style('ts-extend-owlcarousel2',				        			$url . 'css/jquery.vcsc.owl.carousel.min.css', null, false, 'all');
    wp_register_script('ts-extend-owlcarousel2',			            		$url . 'js/jquery.vcsc.owl.carousel.min.js', array('jquery'), false, $FOOTER);			
    // Flex Slider 2
    wp_register_style('ts-extend-flexslider2',				        			$url . 'css/jquery.vcsc.flexslider.min.css', null, false, 'all');
    wp_register_script('ts-extend-flexslider2',			            			$url . 'js/jquery.vcsc.flexslider.min.js', array('jquery'), false, $FOOTER);
    // Nivo Slider
    wp_register_style('ts-extend-nivoslider',				        			$url . 'css/jquery.vcsc.nivoslider.min.css', null, false, 'all');	
    wp_register_script('ts-extend-nivoslider',			            			$url . 'js/jquery.vcsc.nivoslider.min.js', array('jquery'), false, $FOOTER);
    // SliceBox Slider
    wp_register_style('ts-extend-slicebox',				        				$url . 'css/jquery.vcsc.slicebox.min.css', null, false, 'all');
    wp_register_script('ts-extend-slicebox',			            			$url . 'js/jquery.vcsc.slicebox.min.js', array('jquery'), false, $FOOTER);
    // Line Stack Slider
    wp_register_style('ts-extend-stackslider',				        			$url . 'css/jquery.vcsc.stackslider.min.css', null, false, 'all');
    wp_register_script('ts-extend-stackslider',			            			$url . 'js/jquery.vcsc.stackslider.min.js', array('jquery'), false, $FOOTER);   
    // Polaroid Stack Slider
    wp_register_style('ts-extend-polaroidgallery',				        		$url . 'css/jquery.vcsc.polaroidgallery.min.css', null, false, 'all');
    wp_register_script('ts-extend-polaroidgallery',			            		$url . 'js/jquery.vcsc.polaroidgallery.min.js', array('jquery'), false, $FOOTER);
    wp_register_script('ts-extend-transformmatrix',			            		$url . 'js/jquery.vcsc.transformmatrix.min.js', array('jquery'), false, $FOOTER);
    // Slides.js Slider
    wp_register_style('ts-extend-slidesjs',				        			    $url . 'css/jquery.vcsc.slides.min.css', null, false, 'all');
    wp_register_script('ts-extend-slidesjs',			            			$url . 'js/jquery.vcsc.slides.min.js', array('jquery'), false, $FOOTER);
    // DropDown Script
    wp_register_style('ts-extend-dropdown', 									$url . 'css/jquery.vcsc.dropdown.min.css', null, false, 'all');
    wp_register_script('ts-extend-dropdown', 									$url . 'js/jquery.vcsc.dropdown.min.js', array('jquery'), false, true);
    // Isotope Script
    wp_register_script('ts-extend-isotope',										$url . 'js/jquery.vcsc.isotope.min.js', array('jquery'), false, $FOOTER);
    // Parallaxify Script
    wp_register_script('ts-extend-parallaxify',									$url . 'js/jquery.vcsc.parallaxify.min.js', array('jquery'), false, $FOOTER);
    // Trianglify Script
    wp_register_script('ts-extend-trianglify',									$url . 'js/jquery.vcsc.trianglify.min.js', array('jquery'), false, $FOOTER);
    // NewsTicker
    wp_register_script('ts-extend-newsticker',			            			$url . 'js/jquery.vcsc.newsticker.min.js', array('jquery'), false, $FOOTER);
    // vTicker
    wp_register_script('ts-extend-vticker',			            				$url . 'js/jquery.vcsc.vticker.min.js', array('jquery'), false, $FOOTER);
    // Typed
    wp_register_script('ts-extend-typed',			            				$url . 'js/jquery.vcsc.typed.min.js', array('jquery'), false, $FOOTER);    
    // MorphText
    wp_register_script('ts-extend-morphtext', 									$url . 'js/jquery.vcsc.morphed.min.js', array('jquery'), false, true);    
    // Rapha�l
    wp_register_script('ts-extend-raphael',			            				$url . 'js/jquery.vcsc.raphael.min.js', array('jquery'), false, $FOOTER);
    // Mousewheel
    wp_register_script('ts-extend-mousewheel',			            			$url . 'js/jquery.vcsc.mousewheel.min.js', array('jquery'), false, $FOOTER);
    // Snap SVG
    wp_register_script('ts-extend-snapsvg',			            				$url . 'js/jquery.vcsc.snap.svg.min.js', array('jquery'), false, $FOOTER);
    // iPresenter Script
    wp_register_style('ts-extend-ipresenter', 									$url . 'css/jquery.vcsc.ipresenter.min.css', null, false, 'all');
    wp_register_script('ts-extend-ipresenter', 									$url . 'js/jquery.vcsc.ipresenter.min.js', array('jquery'), false, true);
    // SlitSlider Script
    wp_register_style('ts-extend-slitslider', 									$url . 'css/jquery.vcsc.slitslider.min.css', null, false, 'all');
    wp_register_script('ts-extend-slitslider', 									$url . 'js/jquery.vcsc.slitslider.min.js', array('jquery'), false, true);
    // Image Hover Effects
    wp_register_style('ts-extend-hovereffects', 								$url . 'css/jquery.vcsc.hovereffects.min.css', null, false, 'all');
    // Zoomer Script
    wp_register_style('ts-extend-zoomer', 										$url . 'css/jquery.vcsc.zoomer.min.css', null, false, 'all');
    wp_register_script('ts-extend-zoomer', 										$url . 'js/jquery.vcsc.zoomer.min.js', array('jquery'), false, true);
    // Vegas Script
    wp_register_style('ts-extend-vegas', 										$url . 'css/jquery.vcsc.vegas.min.css', null, false, 'all');
    wp_register_script('ts-extend-vegas', 										$url . 'js/jquery.vcsc.vegas.min.js', array('jquery'), false, true);
    // Wallpaper Script
    wp_register_style('ts-extend-wallpaper', 									$url . 'css/jquery.vcsc.wallpaper.min.css', null, false, 'all');
    wp_register_script('ts-extend-wallpaper', 									$url . 'js/jquery.vcsc.wallpaper.min.js', array('jquery'), false, true);
    // Flipboard Title
    wp_register_script('ts-extend-flipflap',			            			$url . 'js/jquery.vcsc.flipflap.min.js', array('jquery'), false, $FOOTER);
    // CSS Timeline
    wp_register_style('ts-extend-csstimeline', 									$url . 'css/jquery.vcsc.csstimeline.min.css', null, false, 'all');
    wp_register_script('ts-extend-csstimeline',			            			$url . 'js/jquery.vcsc.csstimeline.min.js', array('jquery'), false, $FOOTER);
    // Horizontal Timeline
    wp_register_style('ts-extend-horizontaltimeline', 							$url . 'css/jquery.vcsc.horizontaltimeline.min.css', null, false, 'all');
    wp_register_script('ts-extend-horizontaltimeline',			            	$url . 'js/jquery.vcsc.horizontaltimeline.min.js', array('jquery'), false, $FOOTER);
    // Sumo Select
    wp_register_style('ts-extend-sumo', 				        				$url . 'css/jquery.vcsc.sumoselect.min.css', null, false, 'all');
    wp_register_script('ts-extend-sumo', 										$url . 'js/jquery.vcsc.sumoselect.min.js', array('jquery'), false, true);
    // Fancy Tabs Script
    wp_register_style('ts-extend-fancytabs', 									$url . 'css/jquery.vcsc.pwstabs.min.css', null, false, 'all');
    wp_register_script('ts-extend-fancytabs', 									$url . 'js/jquery.vcsc.pwstabs.min.js', array('jquery'), false, false);
    // Single Page Navigator Script
    wp_register_style('ts-extend-singlepage', 									$url . 'css/jquery.vcsc.singlepage.min.css', null, false, 'all');
    wp_register_script('ts-extend-singlepage', 									$url . 'js/jquery.vcsc.singlepage.min.js', array('jquery'), false, true);
    // jQuery Transit
    wp_register_script('ts-extend-transit', 									$url . 'js/jquery.vcsc.transit.min.js', array('jquery'), false, true);    
    // jQuery Grid-A-Licious
    wp_register_script('ts-extend-gridalicious', 								$url . 'js/jquery.vcsc.gridalicious.min.js', array('jquery'), false, true);
    // jQuery Placeholder
    wp_register_style('ts-extend-placeholder', 									$url . 'css/jquery.vcsc.placeholder.min.css', null, false, 'all');
    wp_register_script('ts-extend-placeholder', 								$url . 'js/jquery.vcsc.placeholder.min.js', array('jquery'), false, true); 
    // Icon Wall
    wp_register_style('ts-extend-iconwall', 									$url . 'css/jquery.vcsc.iconwall.min.css', null, false, 'all');
    wp_register_script('ts-extend-iconwall', 									$url . 'js/jquery.vcsc.iconwall.min.js', array('jquery'), false, true);
    // Image Shapes
    wp_register_style('ts-extend-imageshapes', 									$url . 'css/jquery.vcsc.imageshapes.min.css', null, false, 'all');
    wp_register_script('ts-extend-imageshapes', 								$url . 'js/jquery.vcsc.imageshapes.min.js', array('jquery'), false, true);
    // Honeycomb Grid
    wp_register_style('ts-extend-honeycombs', 									$url . 'css/jquery.vcsc.honeycombs.min.css', null, false, 'all');
    wp_register_script('ts-extend-honeycombs', 								    $url . 'js/jquery.vcsc.honeycombs.min.js', array('jquery'), false, true);
    // Circle Loop Steps
    wp_register_style('ts-extend-circlesteps', 									$url . 'css/jquery.vcsc.circlesteps.min.css', null, false, 'all');
    wp_register_script('ts-extend-circlesteps', 								$url . 'js/jquery.vcsc.circlesteps.min.js', array('jquery'), false, true);
    // Syntax Highlighter
    wp_register_script('ts-extend-enlighterjs',                                 $url . 'js/mootools.enlighterjs.min.js', array('ts-library-mootools'), false, true);
    wp_register_style('ts-extend-enlighterjs',                                  $url . 'css/mootools.enlighterjs.min.css', null, false, 'all');
    wp_register_style('ts-extend-syntaxinit',						            $url . 'css/jquery.vcsc.syntaxinit.min.css', null, false, 'all');
    wp_register_script('ts-extend-syntaxinit',						            $url . 'js/jquery.vcsc.syntaxinit.min.js', array('jquery','ts-library-mootools','ts-extend-enlighterjs'), false, $FOOTER);
    // Pagawa Slideshow
    wp_register_style('ts-extend-pgwslideshow',						            $url . 'css/jquery.vcsc.pgwslideshow.min.css', null, false, 'all');
    wp_register_script('ts-extend-pgwslideshow',                                $url . 'js/jquery.vcsc.pgwslideshow.min.js', array('jquery'), false, $FOOTER);    
    // Slick Slider
    wp_register_style('ts-extend-slickslider',						            $url . 'css/jquery.vcsc.slickslider.min.css', null, false, 'all');
    wp_register_script('ts-extend-slickslider',                                 $url . 'js/jquery.vcsc.slickslider.min.js', array('jquery'), false, $FOOTER);    
    // Flipster Coverflow Slider
    wp_register_style('ts-extend-flipster',						                $url . 'css/jquery.vcsc.flipster.min.css', null, false, 'all');
    wp_register_script('ts-extend-flipster',                                    $url . 'js/jquery.vcsc.flipster.min.js', array('jquery'), false, $FOOTER);    
    // Odometer Counter
    wp_register_style('ts-extend-odometer',						                $url . 'css/jquery.vcsc.odometer.min.css', null, false, 'all');
    wp_register_script('ts-extend-odometer',                                    $url . 'js/jquery.vcsc.odometer.min.js', array('jquery'), false, $FOOTER);       
    // Projekktor HTML5 Player
    wp_register_style('ts-extend-projekktormain',                               $url . 'projekktor/jquery.projekktor.logo.min.css', null, false, 'all');
    wp_register_script('ts-extend-projekktormain',                              $url . 'projekktor/jquery.projekktor.logo.min.js', array('jquery'), false, $FOOTER);
    wp_register_style('ts-extend-projekktormaccaco',                            $url . 'projekktor/themes/maccaco/projekktor.style.min.css', null, false, 'all');
    wp_register_style('ts-extend-projekktorminimum',                            $url . 'projekktor/themes/minimum/minimum.style.min.css', null, false, 'all');
    wp_register_style('ts-extend-projekktorlookslike',                          $url . 'projekktor/themes/totallylookslike/totallylookslike.style.min.css', null, false, 'all');
    wp_register_script('ts-extend-projekktorshare',                             $url . 'projekktor/plugins/projekktor.share.min.js', array('jquery','ts-extend-projekktormain'), false, $FOOTER);
    wp_register_style('ts-extend-projekktorshare',                              $url . 'projekktor/plugins/projekktor.share.min.css', null, false, 'all');
    wp_register_script('ts-extend-projekktorlogo',                              $url . 'projekktor/plugins/projekktor.logo.min.js', array('jquery','ts-extend-projekktormain'), false, $FOOTER);
    wp_register_style('ts-extend-projekktorlogo',                               $url . 'projekktor/plugins/projekktor.logo.min.css', null, false, 'all');    
    wp_register_script('ts-extend-projekktortitle',                             $url . 'projekktor/plugins/projekktor.postertitle.min.js', array('jquery','ts-extend-projekktormain'), false, $FOOTER);
    wp_register_style('ts-extend-projekktortitle',                              $url . 'projekktor/plugins/projekktor.postertitle.min.css', null, false, 'all');
    // Moment JS
    wp_register_script('ts-extend-momentjs',					                $url . 'js/jquery.vcsc.momentjs.min.js', array('jquery'), false, $FOOTER);
    // Rating Scale
    wp_register_style('ts-extend-ratingscale',						            $url . 'css/jquery.vcsc.ratingscale.min.css', null, false, 'all');
    // CSS Preloader Animations
    wp_register_style('ts-extend-preloaders',						            $url . 'css/jquery.vcsc.preloaders.min.css', null, false, 'all');
    // Process Lines
    wp_register_style('ts-extend-processlines',						            $url . 'css/jquery.vcsc.processlines.min.css', null, false, 'all');
    // Icon Info Box
    wp_register_style('ts-extend-iconboxes',						            $url . 'css/jquery.vcsc.iconboxes.min.css', null, false, 'all');
    // Image Effects
    wp_register_style('ts-extend-imageeffects',						            $url . 'css/jquery.vcsc.imageeffects.min.css', null, false, 'all');
    wp_register_script('ts-extend-imageeffects',                                $url . 'js/jquery.vcsc.imageeffects.min.js', array('jquery'), false, $FOOTER);
    // MP3 Audio Player
    wp_register_style('ts-extend-mp3player',						            $url . 'css/jquery.vcsc.mp3player.min.css', null, false, 'all');
    wp_register_script('ts-extend-mp3player',                                   $url . 'js/jquery.vcsc.mp3player.min.js', array('jquery'), false, $FOOTER);
    // Plyr Video Player
    wp_register_style('ts-extend-plyrvideo',						            $url . 'css/jquery.vcsc.plyrvideo.min.css', null, false, 'all');
    wp_register_script('ts-extend-plyrvideo',                                   $url . 'js/jquery.vcsc.plyrvideo.min.js', array('jquery'), false, $FOOTER);
    // Loan Calculator
    wp_register_style('ts-extend-loancalculator',                               $url . 'css/jquery.vcsc.loancalculator.min.css', null, false, 'all');
    wp_register_script('ts-extend-loancalculator',                              $url . 'js/jquery.vcsc.loancalculator.min.js', array('jquery'), false, $FOOTER);
    // ChartJS
    wp_register_script('ts-extend-chartjs',                                     $url . 'js/jquery.vcsc.chartjs.min.js', array('jquery'), false, $FOOTER);
    // FixTo
    wp_register_script('ts-extend-fixto',                                       $url . 'js/jquery.vcsc.fixto.min.js', array('jquery'), false, $FOOTER);
    // Fixed/Sticky Content
    wp_register_script('ts-extend-fixedcontent',                                $url . 'js/jquery.vcsc.fixedcontent.min.js', array('jquery'), false, $FOOTER);
    
    
    // Google Fonts
    // ------------
    wp_register_style('ts-extend-font-roboto',									'https://fonts.googleapis.com/css?family=Roboto:400', null, false, 'all');
    wp_register_style('ts-extend-font-unica',									'https://fonts.googleapis.com/css?family=Unica+One', null, false, 'all');    
    wp_register_style('ts-extend-font-wallpoet',								'https://fonts.googleapis.com/css?family=Wallpoet', null, false, 'all');
    wp_register_style('ts-extend-font-arimo',								    'https://fonts.googleapis.com/css?family=Arimo', null, false, 'all');
    wp_register_style('ts-extend-font-rye',								        'https://fonts.googleapis.com/css?family=Rye', null, false, 'all');
    wp_register_style('ts-extend-font-economica',                               'https://fonts.googleapis.com/css?family=Economica', null, false, 'all');
    
    
    // TableSaw Files
    // --------------
    wp_register_script('ts-extend-tablesaw',					                $url . 'tablesaw/tablesaw.jquery.min.js', array('jquery'), false, true);
    wp_register_style('ts-extend-tablesaw',                                     $url . 'tablesaw/tablesaw.jquery.min.css', null, false, 'all');
    
    
    // DataTables Files
    // ----------------
    // Full Files (Core + Responsive + Fixed Header + Buttons General API + Buttons HTML + Buttons Visibility + Browser Print)
    wp_register_script('ts-extend-datatables-full',					            $url . 'datatables/js/datatables.full.min.js', array('jquery'), false, $FOOTER);
    wp_register_style('ts-extend-datatables-full',                              $url . 'datatables/css/datatables.full.min.css', null, false, 'all');
    // Core Files
    wp_register_script('ts-extend-datatables-core',					            $url . 'datatables/js/datatables.core.min.js', array('jquery'), false, $FOOTER);
    wp_register_style('ts-extend-datatables-core',                              $url . 'datatables/css/datatables.core.min.css', null, false, 'all');
    // Custom Styling
    wp_register_style('ts-extend-datatables-custom',                            $url . 'datatables/css/datatables.custom.min.css', null, false, 'all');
    // Responsive Tables
    wp_register_script('ts-extend-datatables-responsive',                       $url . 'datatables/js/datatables.responsive.min.js', array('jquery'), false, $FOOTER);
    wp_register_style('ts-extend-datatables-responsive',                        $url . 'datatables/css/datatables.responsive.min.css', null, false, 'all');
    // Fixed Header
    wp_register_script('ts-extend-datatables-fixedheader',                      $url . 'datatables/js/datatables.fixedheader.min.js', array('jquery'), false, $FOOTER);
    wp_register_style('ts-extend-datatables-fixedheader',                       $url . 'datatables/css/datatables.fixedheader.min.css', null, false, 'all');
    // Fixed Columns
    wp_register_script('ts-extend-datatables-fixedcolumns',                     $url . 'datatables/js/datatables.fixedcolumns.min.js', array('jquery'), false, $FOOTER);
    wp_register_style('ts-extend-datatables-fixedcolumns',                      $url . 'datatables/css/datatables.fixedcolumns.min.css', null, false, 'all');
    // Column Reorder
    wp_register_script('ts-extend-datatables-columnreorder',                    $url . 'datatables/js/datatables.columnreorder.min.js', array('jquery'), false, $FOOTER);
    wp_register_style('ts-extend-datatables-columnreorder',                     $url . 'datatables/css/datatables.columnreorder.min.css', null, false, 'all');
    // Row Reorder
    wp_register_script('ts-extend-datatables-rowreorder',                       $url . 'datatables/js/datatables.rowreorder.min.js', array('jquery'), false, $FOOTER);
    wp_register_style('ts-extend-datatables-rowreorder',                        $url . 'datatables/css/datatables.rowreorder.min.css', null, false, 'all');
    // Table Scroller
    wp_register_script('ts-extend-datatables-tablescroller',                    $url . 'datatables/js/datatables.tablescroller.min.js', array('jquery'), false, $FOOTER);
    wp_register_style('ts-extend-datatables-tablescroller',                     $url . 'datatables/css/datatables.tablescroller.min.css', null, false, 'all');
    // Table Select
    wp_register_script('ts-extend-datatables-tableselect',                      $url . 'datatables/js/datatables.tableselect.min.js', array('jquery'), false, $FOOTER);
    wp_register_style('ts-extend-datatables-tableselect',                       $url . 'datatables/css/datatables.tableselect.min.css', null, false, 'all');
    // Buttons: General API
    wp_register_script('ts-extend-datatables-buttons',                          $url . 'datatables/js/datatables.buttons.min.js', array('jquery'), false, $FOOTER);
    wp_register_style('ts-extend-datatables-buttons',                           $url . 'datatables/css/datatables.buttons.min.css', null, false, 'all');
    // Buttons: Columns Visibility
    wp_register_script('ts-extend-datatables-visibility',                       $url . 'datatables/js/datatables.visibility.min.js', array('jquery'), false, $FOOTER);
    // Buttons: HTML5 Copy, CSV, Excel, PDF (Main)
    wp_register_script('ts-extend-datatables-html5',                            $url . 'datatables/js/datatables.html5.min.js', array('jquery'), false, $FOOTER);
    // Buttons: Flash Copy, CSV, Excel, PDF (Main)
    wp_register_script('ts-extend-datatables-flash',                            $url . 'datatables/js/datatables.flash.min.js', array('jquery'), false, $FOOTER);
    // Buttons: Brower Print
    wp_register_script('ts-extend-datatables-print',                            $url . 'datatables/js/datatables.print.min.js', array('jquery'), false, $FOOTER);
    // Buttons: Excel Export
    wp_register_script('ts-extend-datatables-jszip',                            $url . 'datatables/js/datatables.jszip.min.js', array('jquery'), false, $FOOTER);
    // Buttons: PDF Export
    wp_register_script('ts-extend-datatables-pdfmaker',                         $url . 'datatables/js/datatables.pdfmaker.min.js', array('jquery'), false, $FOOTER);
    wp_register_script('ts-extend-datatables-pdffonts',                         $url . 'datatables/js/datatables.pdffonts.min.js', array('jquery'), false, $FOOTER);
    
    
    // Back-End Files
    // --------------
    // NoUiSlider
    wp_register_style('ts-extend-nouislider',									$url . 'css/jquery.vcsc.nouislider.min.css', null, false, 'all');
    wp_register_script('ts-extend-nouislider',									$url . 'js/jquery.vcsc.nouislider.min.js', array('jquery'), false, true);
    // jRange Slider
    wp_register_style('ts-extend-jrange',									    $url . 'css/jquery.vcsc.jrange.min.css', null, false, 'all');
    wp_register_script('ts-extend-jrange',									    $url . 'js/jquery.vcsc.jrange.min.js', array('jquery'), false, true);
    // MultiSelect
    wp_register_style('ts-extend-multiselect',									$url . 'css/jquery.vcsc.multi.select.min.css', null, false, 'all');
    wp_register_script('ts-extend-multiselect',									$url . 'js/jquery.vcsc.multi.select.min.js', array('jquery'), false, $FOOTER);
    // Toggles / Switch
    wp_register_script('ts-extend-toggles',										$url . 'js/jquery.vcsc.toggles.min.js', array('jquery'), false, true);
    // Freewall
    wp_register_script('ts-extend-freewall', 									$url . 'js/jquery.vcsc.freewall.min.js', array('jquery'), false, $FOOTER);
    // Brickwork
    wp_register_script('ts-extend-brickwork', 									$url . 'js/jquery.vcsc.brickwork.min.js', array('jquery'), false, true);
    // Moment JS
    wp_register_script('ts-extend-momentjs',									$url . 'js/jquery.vcsc.momentjs.min.js', array('jquery'), false, true);    
    // Switch Button
    wp_register_script('ts-extend-switchbutton',								$url . 'js/jquery.vcsc.switchbutton.min.js', array('jquery'), false, true);  
    // Date & Time Picker
    wp_register_script('ts-extend-picker',										$url . 'js/jquery.vcsc.datetimepicker.min.js', array('jquery'), false, true);
    // Lightbox Me
    wp_register_script('ts-extend-lightboxme',									$url . 'js/jquery.vcsc.lightboxme.min.js', array('jquery', 'wp-color-picker'), false, true);
    // Clipboard
    wp_register_script('ts-extend-clipboard',									$url . 'js/jquery.vcsc.clipboard.min.js', array('jquery'), false, true);
    // Repeatable Fields
    wp_register_script('ts-extend-repeatable',                                  $url . 'js/jquery.vcsc.repeatablefields.min.js', array('jquery'), false, true);
    // Messi Popup
    wp_register_style('ts-extend-messi', 				        				$url . 'css/jquery.vcsc.messi.min.css', null, false, 'all');
    wp_register_script('ts-extend-messi',                            			$url . 'js/jquery.vcsc.messi.min.js', array('jquery'), false, true);
    // DragSort
    wp_register_script('ts-extend-dragsort',									$url . 'js/jquery.vcsc.dragsort.min.js', array('jquery'), false, true);
    // jQuery Easing
    wp_register_script('jquery-easing', 										$url . 'js/jquery.vcsc.easing.min.js', array('jquery'), false, true);
    // Select 2
    wp_register_style('ts-extend-select2',										$url . 'css/jquery.vcsc.select2.min.css', null, false, 'all');
    wp_register_script('ts-extend-select2',										$url . 'js/jquery.vcsc.select2.min.js', array('jquery'), false, true);
    // Validation Engine
    wp_register_script('validation-engine', 									$url . 'js/jquery.vcsc.validationengine.min.js', array('jquery'), false, true);
    wp_register_style('validation-engine',										$url . 'css/jquery.vcsc.validationengine.min.css', null, false, 'all');
    wp_register_script('validation-engine-en', 									$url . 'js/jquery.vcsc.validationengine.en.min.js', array('jquery'), false, true);
?>