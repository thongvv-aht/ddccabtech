<?php
	global $VISUAL_COMPOSER_EXTENSIONS;
	if (isset($_POST['Submit'])) {
		//var_dump($_POST);
		if (trim ($_POST['ts_vcsc_extend_settings_true']) == 1) {
			
			echo '<div id="ts_vcsc_extend_settings_save" style="position: relative; margin: 20px auto 20px auto; width: 128px; height: 128px;">';
				echo TS_VCSC_CreatePreloaderCSS("ts-settings-panel-loader", "", 22, "false");
			echo '</div>';
			
			// Form Data Sent
			// --------------------------------------------------------------------------------------------------
			update_option('ts_vcsc_extend_settings_loadForcable',					intval(((isset($_POST['ts_vcsc_extend_settings_loadForcable']))				?	$_POST['ts_vcsc_extend_settings_loadForcable'] 				: 0)));
			update_option('ts_vcsc_extend_settings_loadLightbox', 					intval(((isset($_POST['ts_vcsc_extend_settings_loadLightbox']))				?	$_POST['ts_vcsc_extend_settings_loadLightbox'] 				: 0)));
			update_option('ts_vcsc_extend_settings_loadTooltip', 					intval(((isset($_POST['ts_vcsc_extend_settings_loadTooltip']))				?	$_POST['ts_vcsc_extend_settings_loadTooltip'] 				: 0)));
			update_option('ts_vcsc_extend_settings_loadFonts',						intval(((isset($_POST['ts_vcsc_extend_settings_loadFonts'])) 				?	$_POST['ts_vcsc_extend_settings_loadFonts'] 				: 0)));
			update_option('ts_vcsc_extend_settings_loadHeader', 					intval(((isset($_POST['ts_vcsc_extend_settings_loadHeader'])) 				?	$_POST['ts_vcsc_extend_settings_loadHeader'] 				: 0)));
			update_option('ts_vcsc_extend_settings_loadWaypoints',					intval(((isset($_POST['ts_vcsc_extend_settings_loadWaypoints'])) 			?	$_POST['ts_vcsc_extend_settings_loadWaypoints'] 			: 0)));
			update_option('ts_vcsc_extend_settings_loadjQuery',						intval(((isset($_POST['ts_vcsc_extend_settings_loadjQuery'])) 				?	$_POST['ts_vcsc_extend_settings_loadjQuery'] 				: 0)));
			update_option('ts_vcsc_extend_settings_loadEnqueue',					intval(((isset($_POST['ts_vcsc_extend_settings_loadEnqueue'])) 				?	$_POST['ts_vcsc_extend_settings_loadEnqueue'] 				: 0)));
			update_option('ts_vcsc_extend_settings_loadMooTools',					intval(((isset($_POST['ts_vcsc_extend_settings_loadMooTools'])) 			?	$_POST['ts_vcsc_extend_settings_loadMooTools'] 				: 0)));			
			update_option('ts_vcsc_extend_settings_loadDetector',					intval(((isset($_POST['ts_vcsc_extend_settings_loadDetector'])) 			?	$_POST['ts_vcsc_extend_settings_loadDetector'] 				: 0)));			
			update_option('ts_vcsc_extend_settings_loadHammerNew',					intval(((isset($_POST['ts_vcsc_extend_settings_loadHammerNew'])) 			?	$_POST['ts_vcsc_extend_settings_loadHammerNew'] 			: 0)));			
			if ((($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginExtended == "true") && (get_option('ts_vcsc_extend_settings_additions', 1) == 1)) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginExtended == "false")) {
				update_option('ts_vcsc_extend_settings_additionsRows',				intval(((isset($_POST['ts_vcsc_extend_settings_additionsRows']))			?	$_POST['ts_vcsc_extend_settings_additionsRows']				: 0)));
				update_option('ts_vcsc_extend_settings_additionsOffsets',			intval(((isset($_POST['ts_vcsc_extend_settings_additionsOffsets']))			?	$_POST['ts_vcsc_extend_settings_additionsOffsets']			: 0)));
				update_option('ts_vcsc_extend_settings_additionsColumns',			intval(((isset($_POST['ts_vcsc_extend_settings_additionsColumns']))			?	$_POST['ts_vcsc_extend_settings_additionsColumns']			: 0)));
				update_option('ts_vcsc_extend_settings_additionsSmoothScroll',		intval(((isset($_POST['ts_vcsc_extend_settings_additionsSmoothScroll']))	?	$_POST['ts_vcsc_extend_settings_additionsSmoothScroll']		: 0)));
				update_option('ts_vcsc_extend_settings_additionsRowEffectsBreak',	intval(((isset($_POST['ts_vcsc_extend_settings_additionsRowEffectsBreak']))	?	$_POST['ts_vcsc_extend_settings_additionsRowEffectsBreak']	: '600')));
			}
			if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesCheckup == "true") {
				update_option('ts_vcsc_extend_settings_customWidgets',				intval(((isset($_POST['ts_vcsc_extend_settings_customWidgets'])) 			?	$_POST['ts_vcsc_extend_settings_customWidgets'] 			: 0)));
				update_option('ts_vcsc_extend_settings_customTeam',					intval(((isset($_POST['ts_vcsc_extend_settings_customTeam'])) 				?	$_POST['ts_vcsc_extend_settings_customTeam'] 				: 0)));
				update_option('ts_vcsc_extend_settings_customTestimonial',			intval(((isset($_POST['ts_vcsc_extend_settings_customTestimonial']))		?	$_POST['ts_vcsc_extend_settings_customTestimonial'] 		: 0)));
				update_option('ts_vcsc_extend_settings_customSkillset',				intval(((isset($_POST['ts_vcsc_extend_settings_customSkillset']))			?	$_POST['ts_vcsc_extend_settings_customSkillset'] 			: 0)));				
				update_option('ts_vcsc_extend_settings_customTimelines',			intval(((isset($_POST['ts_vcsc_extend_settings_customTimelines']))			?	$_POST['ts_vcsc_extend_settings_customTimelines'] 			: 0)));
				update_option('ts_vcsc_extend_settings_customLogo',					intval(((isset($_POST['ts_vcsc_extend_settings_customLogo'])) 				?	$_POST['ts_vcsc_extend_settings_customLogo'] 				: 0)));				
			}
			update_option('ts_vcsc_extend_settings_useMenuGenerator',				intval(((isset($_POST['ts_vcsc_extend_settings_useMenuGenerator']))			?	$_POST['ts_vcsc_extend_settings_useMenuGenerator'] 			: 0)));
			update_option('ts_vcsc_extend_settings_useIconGenerator',				intval(((isset($_POST['ts_vcsc_extend_settings_useIconGenerator']))			?	$_POST['ts_vcsc_extend_settings_useIconGenerator'] 			: 0)));
			update_option('ts_vcsc_extend_settings_usePostTypes',					trim ($_POST['ts_vcsc_extend_settings_usePostTypes']));
			update_option('ts_vcsc_extend_settings_mainmenu', 						intval(((isset($_POST['ts_vcsc_extend_settings_mainmenu'])) 				?	$_POST['ts_vcsc_extend_settings_mainmenu'] 					: 0)));
			update_option('ts_vcsc_extend_settings_translationsDomain',				intval(((isset($_POST['ts_vcsc_extend_settings_translationsDomain'])) 		?	$_POST['ts_vcsc_extend_settings_translationsDomain'] 		: 0)));
			update_option('ts_vcsc_extend_settings_previewImages',					intval(((isset($_POST['ts_vcsc_extend_settings_previewImages'])) 			?	$_POST['ts_vcsc_extend_settings_previewImages'] 			: 0)));			
			update_option('ts_vcsc_extend_settings_containerToggle',				intval(((isset($_POST['ts_vcsc_extend_settings_containerToggle'])) 			?	$_POST['ts_vcsc_extend_settings_containerToggle'] 			: 0)));			
			update_option('ts_vcsc_extend_settings_elementFilter',					intval(((isset($_POST['ts_vcsc_extend_settings_elementFilter'])) 			?	$_POST['ts_vcsc_extend_settings_elementFilter'] 			: 0)));	
			update_option('ts_vcsc_extend_settings_tinymceEncoded',					intval(((isset($_POST['ts_vcsc_extend_settings_tinymceEncoded'])) 			?	$_POST['ts_vcsc_extend_settings_tinymceEncoded'] 			: 0)));	
			update_option('ts_vcsc_extend_settings_visualSelector',					intval(((isset($_POST['ts_vcsc_extend_settings_visualSelector'])) 			?	$_POST['ts_vcsc_extend_settings_visualSelector'] 			: 0)));
			update_option('ts_vcsc_extend_settings_nativePaginator',				intval(((isset($_POST['ts_vcsc_extend_settings_nativePaginator'])) 			?	$_POST['ts_vcsc_extend_settings_nativePaginator'] 			: '200')));
			update_option('ts_vcsc_extend_settings_backendPreview',					intval(((isset($_POST['ts_vcsc_extend_settings_backendPreview'])) 			?	$_POST['ts_vcsc_extend_settings_backendPreview'] 			: 0)));
			update_option('ts_vcsc_extend_settings_backgroundIndicator',			intval(((isset($_POST['ts_vcsc_extend_settings_backgroundIndicator'])) 		?	$_POST['ts_vcsc_extend_settings_backgroundIndicator'] 		: 0)));
			update_option('ts_vcsc_extend_settings_dashboard',						intval(((isset($_POST['ts_vcsc_extend_settings_dashboard'])) 				?	$_POST['ts_vcsc_extend_settings_dashboard'] 				: 0)));			
			update_option('ts_vcsc_extend_settings_shortcodesalways',				intval(((isset($_POST['ts_vcsc_extend_settings_shortcodesalways']))			?	$_POST['ts_vcsc_extend_settings_shortcodesalways']			: 0)));
			update_option('ts_vcsc_extend_settings_builtinLightbox',				intval(((isset($_POST['ts_vcsc_extend_settings_builtinLightbox'])) 			?	$_POST['ts_vcsc_extend_settings_builtinLightbox'] 			: 0)));
			update_option('ts_vcsc_extend_settings_lightboxIntegration',			intval(((isset($_POST['ts_vcsc_extend_settings_lightboxIntegration'])) 		?	$_POST['ts_vcsc_extend_settings_lightboxIntegration'] 		: 0)));
			update_option('ts_vcsc_extend_settings_lightboxPrettyPhoto',			intval(((isset($_POST['ts_vcsc_extend_settings_lightboxPrettyPhoto'])) 		?	$_POST['ts_vcsc_extend_settings_lightboxPrettyPhoto'] 		: 0)));
			update_option('ts_vcsc_extend_settings_lightboxAttachAllOther',			intval(((isset($_POST['ts_vcsc_extend_settings_lightboxAttachAllOther']))	?	$_POST['ts_vcsc_extend_settings_lightboxAttachAllOther']	: 0)));
			update_option('ts_vcsc_extend_settings_allowAutoUpdate',				intval(((isset($_POST['ts_vcsc_extend_settings_allowAutoUpdate'])) 			?	$_POST['ts_vcsc_extend_settings_allowAutoUpdate'] 			: 0)));			
			update_option('ts_vcsc_extend_settings_allowDeprecated',				intval(((isset($_POST['ts_vcsc_extend_settings_allowDeprecated'])) 			?	$_POST['ts_vcsc_extend_settings_allowDeprecated'] 			: 0)));
			update_option('ts_vcsc_extend_settings_allowShortcodesWidgets',			intval(((isset($_POST['ts_vcsc_extend_settings_allowShortcodesWidgets'])) 	?	$_POST['ts_vcsc_extend_settings_allowShortcodesWidgets']	: 0)));			
			update_option('ts_vcsc_extend_settings_allowAutoParagraphs',			intval(((isset($_POST['ts_vcsc_extend_settings_allowAutoParagraphs'])) 		?	$_POST['ts_vcsc_extend_settings_allowAutoParagraphs']		: 0)));
			if (TS_VCSC_CheckUserRole(array('administrator'))) {
				if ((function_exists('vc_enabled_frontend')) && (function_exists('vc_disable_frontend'))) {
					update_option('ts_vcsc_extend_settings_frontendEditor',			intval(((isset($_POST['ts_vcsc_extend_settings_frontendEditor'])) 			?	$_POST['ts_vcsc_extend_settings_frontendEditor'] 			: 0)));
				}
			}
			update_option('ts_vcsc_extend_settings_variablesPriority', 				intval(((isset($_POST['ts_vcsc_extend_settings_variablesPriority'])) 		?	$_POST['ts_vcsc_extend_settings_variablesPriority']			: '6')));
			
			// Simple / Extended Options
			update_option('ts_vcsc_extend_settings_allowFullOptions', 				intval(((isset($_POST['ts_vcsc_extend_settings_allowFullOptions']))			?	$_POST['ts_vcsc_extend_settings_allowFullOptions']			: 0)));
			
			// Google Fonts Manager
			update_option('ts_vcsc_extend_settings_allowGoogleManager', 			intval(((isset($_POST['ts_vcsc_extend_settings_allowGoogleManager']))		?	$_POST['ts_vcsc_extend_settings_allowGoogleManager']		: 0)));
			
			// Custom Fonts Manager
			update_option('ts_vcsc_extend_settings_allowCustomManager', 			intval(((isset($_POST['ts_vcsc_extend_settings_allowCustomManager']))		?	$_POST['ts_vcsc_extend_settings_allowCustomManager']		: 0)));
			
			// Website Downtime Manager
			update_option('ts_vcsc_extend_settings_allowDowntimeManager', 			intval(((isset($_POST['ts_vcsc_extend_settings_allowDowntimeManager']))		?	$_POST['ts_vcsc_extend_settings_allowDowntimeManager']		: 0)));
			
			// Widget Sidebars Manager
			update_option('ts_vcsc_extend_settings_allowSidebarsManager', 			intval(((isset($_POST['ts_vcsc_extend_settings_allowSidebarsManager']))		?	$_POST['ts_vcsc_extend_settings_allowSidebarsManager']		: 0)));
			
			// Single Page Navigator
			update_option('ts_vcsc_extend_settings_allowPageNavigator', 			intval(((isset($_POST['ts_vcsc_extend_settings_allowPageNavigator']))		?	$_POST['ts_vcsc_extend_settings_allowPageNavigator']		: 0)));
			
			// Shortcode Viewer Popup
			update_option('ts_vcsc_extend_settings_allowShortcodeViewer', 			intval(((isset($_POST['ts_vcsc_extend_settings_allowShortcodeViewer']))		?	$_POST['ts_vcsc_extend_settings_allowShortcodeViewer']		: 0)));

			// Extendend Container Nesting
			update_option('ts_vcsc_extend_settings_allowExtendedNesting', 			intval(((isset($_POST['ts_vcsc_extend_settings_allowExtendedNesting']))		?	$_POST['ts_vcsc_extend_settings_allowExtendedNesting']		: 0)));
			
			// WP Bakery Page Builder Auto Assignment
			update_option('ts_vcsc_extend_settings_allowAutoAssignment', 			intval(((isset($_POST['ts_vcsc_extend_settings_allowAutoAssignment']))		?	$_POST['ts_vcsc_extend_settings_allowAutoAssignment']		: 0)));
			
			// EnlighterJS - Syntax Highlighter
			update_option('ts_vcsc_extend_settings_allowEnlighterJS', 				intval(((isset($_POST['ts_vcsc_extend_settings_allowEnlighterJS']))			?	$_POST['ts_vcsc_extend_settings_allowEnlighterJS']			: 0)));
			update_option('ts_vcsc_extend_settings_allowThemeBuilder', 				intval(((isset($_POST['ts_vcsc_extend_settings_allowThemeBuilder']))		?	$_POST['ts_vcsc_extend_settings_allowThemeBuilder']			: 0)));
			
			// Extended Row & Column Settings
			$TS_VCSC_Row_Module_Allowable 		= trim ($_POST['ts_vcsc_extend_settings_rowAllowableOptionsValue']);
			$TS_VCSC_Row_Module_Allowable		= explode(',', $TS_VCSC_Row_Module_Allowable);
			$TS_VCSC_Row_Module_Globals 		= trim ($_POST['ts_vcsc_extend_settings_rowAllowableGlobalsValue']);
			if (($TS_VCSC_Row_Module_Globals == '') || ($TS_VCSC_Row_Module_Globals == 'null') || ($TS_VCSC_Row_Module_Globals == null)) {
				if (($key = array_search("globals", $TS_VCSC_Row_Module_Allowable)) !== false) {
					unset($TS_VCSC_Row_Module_Allowable[$key]);
				}
				$TS_VCSC_Row_Module_Globals		= array();
			} else {
				$TS_VCSC_Row_Module_Globals		= explode(',', $TS_VCSC_Row_Module_Globals);
			}
			$TS_VCSC_Row_Module_Backgrounds		= trim ($_POST['ts_vcsc_extend_settings_rowAllowableBackgroundsValue']);
			if (($TS_VCSC_Row_Module_Backgrounds == '') || ($TS_VCSC_Row_Module_Backgrounds == 'null') || ($TS_VCSC_Row_Module_Backgrounds == null)) {
				if (($key = array_search("backgrounds", $TS_VCSC_Row_Module_Allowable)) !== false) {
					unset($TS_VCSC_Row_Module_Allowable[$key]);
				}
				$TS_VCSC_Row_Module_Backgrounds	= array();
			} else {
				$TS_VCSC_Row_Module_Backgrounds	= explode(',', $TS_VCSC_Row_Module_Backgrounds);	
			}
			$TS_VCSC_Row_Module_Effects 		= trim ($_POST['ts_vcsc_extend_settings_rowAllowableEffectsValue']);
			if (($TS_VCSC_Row_Module_Effects == '') || ($TS_VCSC_Row_Module_Effects == 'null') || ($TS_VCSC_Row_Module_Effects == null)) {
				if (($key = array_search("effects", $TS_VCSC_Row_Module_Allowable)) !== false) {
					unset($TS_VCSC_Row_Module_Allowable[$key]);
				}
				$TS_VCSC_Row_Module_Effects		= array();
			} else {
				$TS_VCSC_Row_Module_Effects		= explode(',', $TS_VCSC_Row_Module_Effects);
			}			
			$TS_VCSC_Row_Module_Settings = array(
				"globals"						=> array (
					"enabled"               	=> (in_array("globals", $TS_VCSC_Row_Module_Allowable) ? "true" : "false"),
					"rowheight"             	=> (in_array("rowheight", $TS_VCSC_Row_Module_Globals) ? "true" : "false"),
					"rowwidth"              	=> (in_array("rowwidth", $TS_VCSC_Row_Module_Globals) ? "true" : "false"),
					"general"               	=> (in_array("general", $TS_VCSC_Row_Module_Globals) ? "true" : "false"),
					"visibility"            	=> (in_array("visibility", $TS_VCSC_Row_Module_Globals) ? "true" : "false"),
					"columnheight"          	=> (in_array("columnheight", $TS_VCSC_Row_Module_Globals) ? "true" : "false"),
					"viewport"              	=> (in_array("viewport", $TS_VCSC_Row_Module_Globals) ? "true" : "false"),
				),
				"backgrounds"					=> array (
					"enabled"               	=> (in_array("backgrounds", $TS_VCSC_Row_Module_Allowable) ? "true" : "false"),
					"imagesingle"           	=> (in_array("imagesingle", $TS_VCSC_Row_Module_Backgrounds) ? "true" : "false"),
					"imagefixed"            	=> (in_array("imagefixed", $TS_VCSC_Row_Module_Backgrounds) ? "true" : "false"),
					"imageslider"           	=> (in_array("imageslider", $TS_VCSC_Row_Module_Backgrounds) ? "true" : "false"),
					"imageparallax"         	=> (in_array("imageparallax", $TS_VCSC_Row_Module_Backgrounds) ? "true" : "false"),
					"imageautomove"         	=> (in_array("imageautomove", $TS_VCSC_Row_Module_Backgrounds) ? "true" : "false"),
					"imagemovement"         	=> (in_array("imagemovement", $TS_VCSC_Row_Module_Backgrounds) ? "true" : "false"),      
					"colorsingle"           	=> (in_array("colorsingle", $TS_VCSC_Row_Module_Backgrounds) ? "true" : "false"),
					"colorgradient"         	=> (in_array("colorgradient", $TS_VCSC_Row_Module_Backgrounds) ? "true" : "false"),
					"otherpatternbold"      	=> (in_array("otherpatternbold", $TS_VCSC_Row_Module_Backgrounds) ? "true" : "false"),
					"otherparticles"        	=> (in_array("otherparticles", $TS_VCSC_Row_Module_Backgrounds) ? "true" : "false"),
					"othertriangle"         	=> (in_array("othertriangle", $TS_VCSC_Row_Module_Backgrounds) ? "true" : "false"),
					"videoyoutube"          	=> (in_array("videoyoutube", $TS_VCSC_Row_Module_Backgrounds) ? "true" : "false"),
					"videohtml5"            	=> (in_array("videohtml5", $TS_VCSC_Row_Module_Backgrounds) ? "true" : "false"),
				),
				"effects"						=> array(
					"enabled"               	=> (in_array("effects", $TS_VCSC_Row_Module_Allowable) ? "true" : "false"),
					"overlays"              	=> (in_array("overlays", $TS_VCSC_Row_Module_Effects) ? "true" : "false"),
					"kenburns"              	=> (in_array("kenburns", $TS_VCSC_Row_Module_Effects) ? "true" : "false"),
					"seperators"            	=> (in_array("seperators", $TS_VCSC_Row_Module_Effects) ? "true" : "false"),
					"blurring"              	=> (in_array("blurring", $TS_VCSC_Row_Module_Effects) ? "true" : "false"),
				),
			);
			update_option('ts_vcsc_extend_settings_extendedRowsCustomizer', $TS_VCSC_Row_Module_Settings);
			
			// Save Settings WBP Extensions Elements
			$TS_VCSC_Extension_Elements 		= get_option('ts_vcsc_extend_settings_StandardElements', '');
			if ($TS_VCSC_Extension_Elements == '') {
				$TS_VCSC_Options_CleanUp 		= "true";
			} else {
				$TS_VCSC_Options_CleanUp 		= "false";
			}
			$TS_VCSC_Extension_Elements 		= array();
			foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
				$key 	= $element['setting'];
				$value 	= intval(((isset($_POST['ts_vcsc_extend_settings_custom' . $key])) ? $_POST['ts_vcsc_extend_settings_custom' . $key] : 0));
				$TS_VCSC_Extension_Elements[$key] = $value;
				if ($TS_VCSC_Options_CleanUp == "true") {
					delete_option('ts_vcsc_extend_settings_custom' . $key);
				}				
			}
			update_option('ts_vcsc_extend_settings_StandardElements',				$TS_VCSC_Extension_Elements);
			
			// Save Settings WBP Demo Elements
			$TS_VCSC_Extension_Demos			= array();
			foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Visual_Composer_Demos as $ElementName => $element) {
				$key 	= $element['setting'];
				$value 	= intval(((isset($_POST['ts_vcsc_extend_settings_demo' . $key])) ? $_POST['ts_vcsc_extend_settings_demo' . $key] : 0));
				$TS_VCSC_Extension_Demos[$key] = $value;
			}
			update_option('ts_vcsc_extend_settings_DemoElements',					$TS_VCSC_Extension_Demos);			
			
			// Save WooCommerce Settings
			if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_WooCommerceActive == "true") {
				$TS_VCSC_WooCommerce_Elements 	= get_option('ts_vcsc_extend_settings_WooCommerceElements', '');
				if ($TS_VCSC_WooCommerce_Elements == '') {
					$TS_VCSC_Options_CleanUp 	= "true";
				} else {
					$TS_VCSC_Options_CleanUp 	= "false";
				}
				$TS_VCSC_WooCommerce_Elements 	= array();
				foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_WooCommerce_Elements as $ElementName => $element) {
					$key 	= $element['setting'];
					$value 	= intval(((isset($_POST['ts_vcsc_extend_settings_woocommerce' . $key])) ? $_POST['ts_vcsc_extend_settings_woocommerce' . $key] : 0));
					$TS_VCSC_WooCommerce_Elements[$key] = $value;
					if ($TS_VCSC_Options_CleanUp == "true") {
						delete_option('ts_vcsc_extend_settings_woocommerce' . $key);
					}
				}
				update_option('ts_vcsc_extend_settings_WooCommerceElements',		$TS_VCSC_WooCommerce_Elements);
			}
			
			// Save bbPress Settings
			if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_bbPressActive == "true") {
				$TS_VCSC_bbPress_Elements 		= get_option('ts_vcsc_extend_settings_bbPressElements', '');
				if ($TS_VCSC_bbPress_Elements == '') {
					$TS_VCSC_Options_CleanUp 	= "true";
				} else {
					$TS_VCSC_Options_CleanUp 	= "false";
				}
				$TS_VCSC_bbPress_Elements 		= array();
				foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_bbPress_Elements as $ElementName => $element) {
					$key 	= $element['setting'];
					$value 	= intval(((isset($_POST['ts_vcsc_extend_settings_bbpress' . $key])) ? $_POST['ts_vcsc_extend_settings_bbpress' . $key] : 0));
					$TS_VCSC_bbPress_Elements[$key] = $value;
					if ($TS_VCSC_Options_CleanUp == "true") {
						delete_option('ts_vcsc_extend_settings_bbpress' . $key);
					}
				}
				update_option('ts_vcsc_extend_settings_bbPressElements',			$TS_VCSC_bbPress_Elements);
			}
			
			// External API Settings
			$TS_VCSC_External_API_Information = array(
				'GoogleMaps'					=> trim ($_POST['ts_vcsc_extend_settings_externalAPIGoogleMaps']),
				'YouTube'						=> trim ($_POST['ts_vcsc_extend_settings_externalAPIYouTube']),
			);
			update_option('ts_vcsc_extend_settings_externalAPIs', 					$TS_VCSC_External_API_Information);
			
			// Language Settings: Google Maps PLUS
			$TS_VCSC_Google_MapPLUS_Language = array (
				'ListenersStart'                => trim ($_POST['ts_vcsc_extend_settings_languageTextListenersStart']),
				'ListenersStop'                 => trim ($_POST['ts_vcsc_extend_settings_languageTextListenersStop']),
				'MobileShow'                    => trim ($_POST['ts_vcsc_extend_settings_languageTextMobileShow']),
				'MobileHide'                    => trim ($_POST['ts_vcsc_extend_settings_languageTextMobileHide']),
				'StyleDefault'                  => trim ($_POST['ts_vcsc_extend_settings_languageTextStyleDefault']),
				'StyleLabel'                    => trim ($_POST['ts_vcsc_extend_settings_languageTextStyleLabel']),
				'FilterAll'                     => trim ($_POST['ts_vcsc_extend_settings_languageTextFilterAll']),
				'FilterLabel'                   => trim ($_POST['ts_vcsc_extend_settings_languageTextFilterLabel']),
				'SelectLabel'                   => trim ($_POST['ts_vcsc_extend_settings_languageTextSelectLabel']),
				'ControlsOSM'                   => trim ($_POST['ts_vcsc_extend_settings_languageTextControlsOSM']),
				'ControlsHome'                  => trim ($_POST['ts_vcsc_extend_settings_languageTextControlsHome']),
				'ControlsBounds'                => trim ($_POST['ts_vcsc_extend_settings_languageTextControlsBounds']),
				'ControlsBike'                  => trim ($_POST['ts_vcsc_extend_settings_languageTextControlsBike']),
				'ControlsTraffic'               => trim ($_POST['ts_vcsc_extend_settings_languageTextControlsTraffic']),
				'ControlsTransit'               => trim ($_POST['ts_vcsc_extend_settings_languageTextControlsTransit']),
				'TrafficMiles'                  => trim ($_POST['ts_vcsc_extend_settings_languageTextTrafficMiles']),
				'TrafficKilometer'              => trim ($_POST['ts_vcsc_extend_settings_languageTextTrafficKilometer']),
				'TrafficNone'                   => trim ($_POST['ts_vcsc_extend_settings_languageTextTrafficNone']),
				'SearchButton'                  => trim ($_POST['ts_vcsc_extend_settings_languageTextSearchButton']),
				'SearchHolder'                  => trim ($_POST['ts_vcsc_extend_settings_languageTextSearchHolder']),
				'SearchGoogle'                  => trim ($_POST['ts_vcsc_extend_settings_languageTextSearchGoogle']),				
				'SearchGroup'                  	=> trim ($_POST['ts_vcsc_extend_settings_languageTextSearchGroup']),				
				'SearchDirections'              => trim ($_POST['ts_vcsc_extend_settings_languageTextSearchDirections']),
				'OtherLink'              		=> trim ($_POST['ts_vcsc_extend_settings_languageTextOtherLink']),
				'PlaceholderMarker'				=> trim ($_POST['ts_vcsc_extend_settings_languageTextPlaceholderMarker']),
				'ListingsButton'                => trim ($_POST['ts_vcsc_extend_settings_languageTextListingsButton']),
				'ListingsSearch'                => trim ($_POST['ts_vcsc_extend_settings_languageTextListingsSearch']),
				'SumoConfirm'			        => trim ($_POST['ts_vcsc_extend_settings_languageTextSumoConfirm']),
				'SumoCancel'			        => trim ($_POST['ts_vcsc_extend_settings_languageTextSumoCancel']),
				'SumoSelected'			        => trim ($_POST['ts_vcsc_extend_settings_languageTextSumoSelected']),
				'SumoAllSelected'		        => trim ($_POST['ts_vcsc_extend_settings_languageTextSumoAllSelected']),
				'SumoPlaceholder'		        => trim ($_POST['ts_vcsc_extend_settings_languageTextSumoPlaceholder']),
				'SumoSearchLocations'		    => trim ($_POST['ts_vcsc_extend_settings_languageTextSumoSearchLocations']),
				'SumoSearchGroups'		        => trim ($_POST['ts_vcsc_extend_settings_languageTextSumoSearchGroups']),
				'SumoSearchStyles'		        => trim ($_POST['ts_vcsc_extend_settings_languageTextSumoSearchStyles']),
			);
			update_option('ts_vcsc_extend_settings_translationsGoogleMapPLUS', 		$TS_VCSC_Google_MapPLUS_Language);
			
			// Language Settings: Google Maps (Deprecated)
			$TS_VCSC_Google_Map_Language = array (
				'TextCalcShow'		=> trim ($_POST['ts_vcsc_extend_settings_languageTextCalcShow']),
				'TextCalcHide'		=> trim ($_POST['ts_vcsc_extend_settings_languageTextCalcHide']),
				'TextDirectionShow'	=> trim ($_POST['ts_vcsc_extend_settings_languageTextDirectionShow']),
				'TextDirectionHide'	=> trim ($_POST['ts_vcsc_extend_settings_languageTextDirectionHide']),
				'TextViewOnGoogle'	=> trim ($_POST['ts_vcsc_extend_settings_languageTextViewOnGoogle']),
				'TextResetMap'		=> trim ($_POST['ts_vcsc_extend_settings_languageTextResetMap']),
				'PrintRouteText'	=> trim ($_POST['ts_vcsc_extend_settings_languagePrintRouteText']),
				'TextButtonCalc'	=> trim ($_POST['ts_vcsc_extend_settings_languageTextButtonCalc']),
				'TextSetTarget'		=> trim ($_POST['ts_vcsc_extend_settings_languageTextSetTarget']),
				'TextGeoLocation'	=> trim ($_POST['ts_vcsc_extend_settings_languageTextGeoLocation']),
				'TextTravelMode'	=> trim ($_POST['ts_vcsc_extend_settings_languageTextTravelMode']),
				'TextDriving'		=> trim ($_POST['ts_vcsc_extend_settings_languageTextDriving']),
				'TextWalking'		=> trim ($_POST['ts_vcsc_extend_settings_languageTextWalking']),
				'TextBicy'			=> trim ($_POST['ts_vcsc_extend_settings_languageTextBicy']),
				'TextWP'			=> trim ($_POST['ts_vcsc_extend_settings_languageTextWP']),
				'TextButtonAdd'		=> trim ($_POST['ts_vcsc_extend_settings_languageTextButtonAdd']),
				'TextDistance'		=> trim ($_POST['ts_vcsc_extend_settings_languageTextDistance']),
				'TextMapHome'		=> trim ($_POST['ts_vcsc_extend_settings_languageTextMapHome']),
				'TextMapBikes'		=> trim ($_POST['ts_vcsc_extend_settings_languageTextMapBikes']),
				'TextMapTraffic'	=> trim ($_POST['ts_vcsc_extend_settings_languageTextMapTraffic']),
				'TextMapSpeedMiles'	=> trim ($_POST['ts_vcsc_extend_settings_languageTextMapSpeedMiles']),
				'TextMapSpeedKM'	=> trim ($_POST['ts_vcsc_extend_settings_languageTextMapSpeedKM']),
				'TextMapNoData'		=> trim ($_POST['ts_vcsc_extend_settings_languageTextMapNoData']),
				'TextMapMiles'		=> trim ($_POST['ts_vcsc_extend_settings_languageTextMapMiles']),
				'TextMapKilometes'	=> trim ($_POST['ts_vcsc_extend_settings_languageTextMapKilometes']),
				'TextMapActivate'	=> trim ($_POST['ts_vcsc_extend_settings_languageTextMapActivate']),
				'TextMapDeactivate'	=> trim ($_POST['ts_vcsc_extend_settings_languageTextMapDeactivate']),
			);
			update_option('ts_vcsc_extend_settings_translationsGoogleMap', 			$TS_VCSC_Google_Map_Language);
			
			// Language Settings: Countdown
			$TS_VCSC_Countdown_Language = array (
				'DayPlural'			=> trim ($_POST['ts_vcsc_extend_settings_languageDayPlural']),
				'DaySingular'		=> trim ($_POST['ts_vcsc_extend_settings_languageDaySingular']),
				'HourPlural'		=> trim ($_POST['ts_vcsc_extend_settings_languageHourPlural']),
				'HourSingular'		=> trim ($_POST['ts_vcsc_extend_settings_languageHourSingular']),
				'MinutePlural'		=> trim ($_POST['ts_vcsc_extend_settings_languageMinutePlural']),
				'MinuteSingular'	=> trim ($_POST['ts_vcsc_extend_settings_languageMinuteSingular']),
				'SecondPlural'		=> trim ($_POST['ts_vcsc_extend_settings_languageSecondPlural']),
				'SecondSingular'	=> trim ($_POST['ts_vcsc_extend_settings_languageSecondSingular']),
			);
			update_option('ts_vcsc_extend_settings_translationsCountdown', 			$TS_VCSC_Countdown_Language);
			
			// Language Settings: Magnify
			$TS_VCSC_Magnify_Language = array (
				'ZoomIn'			=> trim ($_POST['ts_vcsc_extend_settings_languageMagnifyZoomIn']),
				'ZoomOut'			=> trim ($_POST['ts_vcsc_extend_settings_languageMagnifyZoomOut']),
				'ZoomLevel'			=> trim ($_POST['ts_vcsc_extend_settings_languageMagnifyZoomLevel']),
				'ChangeLevel'		=> trim ($_POST['ts_vcsc_extend_settings_languageMagnifyChangeLevel']),
				'Next'				=> trim ($_POST['ts_vcsc_extend_settings_languageMagnifyNext']),
				'Previous'			=> trim ($_POST['ts_vcsc_extend_settings_languageMagnifyPrevious']),
				'Reset'				=> trim ($_POST['ts_vcsc_extend_settings_languageMagnifyReset']),
				'Rotate'			=> trim ($_POST['ts_vcsc_extend_settings_languageMagnifyRotate']),
				'Lightbox'			=> trim ($_POST['ts_vcsc_extend_settings_languageMagnifyLightbox']),
			);
			update_option('ts_vcsc_extend_settings_translationsMagnify', 			$TS_VCSC_Magnify_Language);
			
			// Language Settings: Plyr Video Player
			$TS_VCSC_PlyrVideo_Language = array (
				'restart'			=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerRestart']),
				'rewind'			=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerRewind']),
				'play'				=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerPlay']),
				'pause'				=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerPause']),
				'forward'			=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerForward']),
				'played'			=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerPlayed']),
				'buffered'			=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerBuffered']),
				'currenttime'		=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerCurrenttime']),
				'duration'			=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerDuration']),
				'volume'			=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerVolume']),
				'togglemute'		=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerTogglemute']),
				'togglecaptions'	=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerToggleCaptions']),
				'togglefullscreen'	=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerToggleFullscreen']),
				'frametitle'		=> trim ($_POST['ts_vcsc_extend_settings_languagePlyrPlayerFrametitle']),
			);
			update_option('ts_vcsc_extend_settings_translationsPlyrPlayer',			$TS_VCSC_PlyrVideo_Language);
			
			// Language Settings: Loan Calculator
			$TS_VCSC_LoanCalculator_Language = array ();
			foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Loan_Calculator_Language_Defaults as $key => $value) {
				$settings_key 		= explode("_", $key);
				$settings_key 		= ucwords($settings_key[0]) . ucwords($settings_key[1]);
				$TS_VCSC_LoanCalculator_Language[$key] = trim ($_POST['ts_vcsc_extend_settings_languageLoanCalculator' . $settings_key]);
			}
			update_option('ts_vcsc_extend_settings_translationsLoanCalculator',		$TS_VCSC_LoanCalculator_Language);
			
			// Language Settings: Isotope Posts
			$TS_VCSC_Isotope_Posts_Language = array(
				'ButtonFilter'		=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsButtonFilter']),
				'ButtonLayout'		=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsButtonLayout']),
				'ButtonSort'		=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsButtonSort']),
				'SeeAll'			=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsSeeAll']),
				'Timeline' 			=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsTimeline']),
				'Masonry' 			=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsMasonry']),
				'FitRows'			=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsFitRows']),
				'StraightDown' 		=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsStraightDown']),
				'Date' 				=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsDate']),
				'Modified' 			=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsModified']),
				'Title' 			=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsTitle']),
				'Author' 			=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsAuthor']),
				'PostID' 			=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsPostID']),
				'Comments' 			=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsComments']),
				'Categories' 		=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsCategories']),
				'Tags' 				=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsTags']),
				// WooCommerce
				'WooFilterProducts'	=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsWooFilterProducts']),
				'WooTitle' 			=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsWooTitle']),
				'WooPrice' 			=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsWooPrice']),
				'WooRating'			=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsWooRating']),
				'WooDate' 			=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsWooDate']),
				'WooModified'		=> trim ($_POST['ts_vcsc_extend_settings_languageIsotopePostsWooModified']),
			);
			update_option('ts_vcsc_extend_settings_translationsIsotopePosts',		$TS_VCSC_Isotope_Posts_Language);
			
			// Lightbox Settings
			$removelight			= intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxBacklight'])) 			? 	$_POST['ts_vcsc_extend_settings_defaultLightboxBacklight'] 			: 0));
			$customlight			= intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxBackCustom'])) 			? 	$_POST['ts_vcsc_extend_settings_defaultLightboxBackCustom'] 		: 0));
			$customcolor			= ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxBackColor'])) 					? 	$_POST['ts_vcsc_extend_settings_defaultLightboxBackColor'] 			: '#ffffff');
			$sharenetworks			= preg_replace("/[^a-zA-Z,]/", "", $_POST['ts_vcsc_extend_settings_defaultLightboxNetworks']);
			$defaultsocialapis		= intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxLoadAPIs'])) 			?	$_POST['ts_vcsc_extend_settings_defaultLightboxLoadAPIs'] 			: 0)); 	// true/false
			$defaultanimation		= ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxAnimation'])) 					?	$_POST['ts_vcsc_extend_settings_defaultLightboxAnimation'] 			: 'random');
			if (($removelight == 0) && ($customlight == 1)) {
				$usecolor			= 1;
				$backlight			= $customcolor;
			} else if (($removelight == 1) && ($customlight == 0)) {
				$usecolor			= 1;
				$backlight			= '';
			} else if (($removelight == 1) && ($customlight == 1)) {
				$usecolor			= 1;
				$backlight			= '';
			} else if (($removelight == 0) && ($customlight == 0)) {
				$usecolor			= 0;
				$backlight			= '#ffffff';
			} else {
				$usecolor			= 0;
				$backlight			= '#ffffff';
			}
			$TS_VCSC_Lightbox_Defaults = array(
				'thumbs'			=> 'bottom',
				'thumbsize'			=> 50,
				'animation'			=> $defaultanimation,
				'captions'			=> 'data-title',
				'closer'			=> intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxCloser'])) 			?	$_POST['ts_vcsc_extend_settings_defaultLightboxCloser'] 			: 0)), 	// true/false
				'duration'			=> 5000,
				'save'				=> intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxSave'])) 				?	$_POST['ts_vcsc_extend_settings_defaultLightboxSave'] 				: 0)), 	// true/false
				'share'				=> intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxShare'])) 				?	$_POST['ts_vcsc_extend_settings_defaultLightboxShare'] 				: 0)), 	// true/false				
				'loadapis'			=> intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxLoadAPIs'])) 			?	$_POST['ts_vcsc_extend_settings_defaultLightboxLoadAPIs'] 			: 0)), 	// true/false
				'social'			=> strtolower($sharenetworks),				
				'notouch'			=> intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxNoTouch'])) 			?	$_POST['ts_vcsc_extend_settings_defaultLightboxNoTouch'] 			: 0)), 	// true/false
				'bgclose'			=> intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxBGClose'])) 			?	$_POST['ts_vcsc_extend_settings_defaultLightboxBGClose'] 			: 0)), 	// true/false
				'nohashes'			=> intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxHashtag'])) 			?	$_POST['ts_vcsc_extend_settings_defaultLightboxHashtag'] 			: 0)), 	// true/false
				'keyboard'			=> intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxKeyboard'])) 			?	$_POST['ts_vcsc_extend_settings_defaultLightboxKeyboard'] 			: 0)), 	// 0/1
				'fullscreen'		=> intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxFullScreen'])) 		?	$_POST['ts_vcsc_extend_settings_defaultLightboxFullScreen'] 		: 0)), 	// 0/1
				'zoom'				=> intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxZoom'])) 				?	$_POST['ts_vcsc_extend_settings_defaultLightboxZoom'] 				: 0)), 	// 0/1				
				'fxspeed'			=> intval(((isset($_POST['ts_vcsc_extend_settings_defaultLightboxSpeedFX'])) 			?	$_POST['ts_vcsc_extend_settings_defaultLightboxSpeedFX'] 			: 300)),
				'scheme'			=> ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxScheme'])) 					?	trim ($_POST['ts_vcsc_extend_settings_defaultLightboxScheme']) 		: 'dark'),
				'controls'			=> ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxControls'])) 					?	trim ($_POST['ts_vcsc_extend_settings_defaultLightboxControls'])	: 'circle'),
				'removelight'		=> $removelight,
				'customlight'		=> $customlight,
				'customcolor'		=> $customcolor,
				'backlight'			=> $backlight,
				'usecolor'			=> $usecolor,
				'urlcolorscan'		=> ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxURLScan'])) 					?	$_POST['ts_vcsc_extend_settings_defaultLightboxURLScan'] 			: 0),	// true/false
				'background'		=> ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxBackground'])) 				?	$_POST['ts_vcsc_extend_settings_defaultLightboxBackground'] 		: ''),
				'repeat'			=> ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxRepeat'])) 					?	$_POST['ts_vcsc_extend_settings_defaultLightboxRepeat'] 			: 'no-repeat'),
				'overlay'			=> ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxOverlay'])) 					?	$_POST['ts_vcsc_extend_settings_defaultLightboxOverlay'] 			: '#000000'),
				'noise'				=> ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxNoise'])) 					?	trim ($_POST['ts_vcsc_extend_settings_defaultLightboxNoise']) 		: ''),
				'cors'				=> ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxCors'])) 						?	$_POST['ts_vcsc_extend_settings_defaultLightboxCors'] 				: 0),	// true/false
				'tapping'			=> ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxTapping'])) 					?	$_POST['ts_vcsc_extend_settings_defaultLightboxTapping'] 			: 0),	// true/false
				'scrollblock'		=> ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxScrollBlock'])) 				?	$_POST['ts_vcsc_extend_settings_defaultLightboxScrollBlock'] 		: 'js'),
				'protection'		=> ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxProtection'])) 				?	$_POST['ts_vcsc_extend_settings_defaultLightboxProtection'] 		: 'none'),
				'historyclose'		=> ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxHistoryClose']))				?	$_POST['ts_vcsc_extend_settings_defaultLightboxHistoryClose']		: 0),	// true/false
				'customscroll'		=> ((isset($_POST['ts_vcsc_extend_settings_defaultLightboxCustomScroll']))				?	$_POST['ts_vcsc_extend_settings_defaultLightboxCustomScroll']		: 0),	// true/false
			);
			update_option('ts_vcsc_extend_settings_defaultLightboxSettings',					$TS_VCSC_Lightbox_Defaults);
			update_option('ts_vcsc_extend_settings_defaultLightboxSocialAPIs',					$defaultsocialapis);
			
			// Row Visibility Settings
			$TS_VCSC_Row_Visibility_Limits = array(
				'Large Devices'		=> intval(((isset($_POST['ts_vcsc_extend_settings_rowLimitLarge'])) 					?	$_POST['ts_vcsc_extend_settings_rowLimitLarge'] 					: 1200)),
				'Medium Devices'	=> intval(((isset($_POST['ts_vcsc_extend_settings_rowLimitMedium'])) 					?	$_POST['ts_vcsc_extend_settings_rowLimitMedium'] 					: 992)),
				'Small Devices'		=> intval(((isset($_POST['ts_vcsc_extend_settings_rowLimitSmall'])) 					?	$_POST['ts_vcsc_extend_settings_rowLimitSmall'] 					: 768)),
			);
			update_option('ts_vcsc_extend_settings_rowVisibilityLimits',						$TS_VCSC_Row_Visibility_Limits);
			
			// Menu Positions
			$TS_VCSC_Menu_Positions = array(
				'ts_widgets'		=> intval(((isset($_POST['ts_vcsc_extend_settings_positionWidgets'])) 					?	$_POST['ts_vcsc_extend_settings_positionWidgets'] 					: 50)),
				'ts_timeline'		=> intval(((isset($_POST['ts_vcsc_extend_settings_positionTimeline'])) 					?	$_POST['ts_vcsc_extend_settings_positionTimeline'] 					: 51)),
				'ts_team'			=> intval(((isset($_POST['ts_vcsc_extend_settings_positionTeam'])) 						?	$_POST['ts_vcsc_extend_settings_positionTeam'] 						: 52)),
				'ts_testimonials'	=> intval(((isset($_POST['ts_vcsc_extend_settings_positionTestimonials'])) 				?	$_POST['ts_vcsc_extend_settings_positionTestimonials'] 				: 53)),
				'ts_skillsets'		=> intval(((isset($_POST['ts_vcsc_extend_settings_positionSkillsets'])) 				?	$_POST['ts_vcsc_extend_settings_positionSkillsets'] 				: 54)),
				'ts_logos'			=> intval(((isset($_POST['ts_vcsc_extend_settings_positionLogos'])) 					?	$_POST['ts_vcsc_extend_settings_positionLogos'] 					: 55)),
				'ts_downtime'		=> intval(((isset($_POST['ts_vcsc_extend_settings_positionDowntime'])) 					?	$_POST['ts_vcsc_extend_settings_positionDowntime'] 					: 56)),
			);
			update_option('ts_vcsc_extend_settings_menuPositions',								$TS_VCSC_Menu_Positions);
			
			// Save Settings for each Installed Icon Font
			foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Icon_Font_Settings as $Icon_Font => $iconfont) {
				if (($iconfont['setting'] == 'Custom') && (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') != '')) {
					$fontActivate 	= intval(((isset($_POST['ts_vcsc_extend_settings_tinymce' . $iconfont['setting']])) ? $_POST['ts_vcsc_extend_settings_tinymce' . $iconfont['setting']] : 0));
					$fontLoad 		= intval(((isset($_POST['ts_vcsc_extend_settings_load' . $iconfont['setting']])) ? $_POST['ts_vcsc_extend_settings_load' . $iconfont['setting']] : 0));
					update_option('ts_vcsc_extend_settings_tinymce' . $iconfont['setting'],		$fontActivate);
					update_option('ts_vcsc_extend_settings_load' . $iconfont['setting'],		$fontLoad);
				} else if ($iconfont['setting'] != 'Custom'){
					$fontActivate 	= intval(((isset($_POST['ts_vcsc_extend_settings_tinymce' . $iconfont['setting']])) ? $_POST['ts_vcsc_extend_settings_tinymce' . $iconfont['setting']] : 0));
					$fontLoad 		= intval(((isset($_POST['ts_vcsc_extend_settings_load' . $iconfont['setting']])) ? $_POST['ts_vcsc_extend_settings_load' . $iconfont['setting']] : 0));
					update_option('ts_vcsc_extend_settings_tinymce' . $iconfont['setting'],		$fontActivate);
					update_option('ts_vcsc_extend_settings_load' . $iconfont['setting'],		$fontLoad);
				}
			}
			
			// Save Settings for WP Bakery Page Builder Icon Fonts
			if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorIconFontsInternal == "true") {
				foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Composer_Font_Settings as $Icon_Font => $iconfont) {
					$fontActivate 	= intval(((isset($_POST['ts_vcsc_extend_settings_tinymce' . $iconfont['setting']])) ? $_POST['ts_vcsc_extend_settings_tinymce' . $iconfont['setting']] : 0));
					$fontLoad 		= intval(((isset($_POST['ts_vcsc_extend_settings_load' . $iconfont['setting']])) ? $_POST['ts_vcsc_extend_settings_load' . $iconfont['setting']] : 0));
					update_option('ts_vcsc_extend_settings_tinymce' . $iconfont['setting'],		$fontActivate);
					update_option('ts_vcsc_extend_settings_load' . $iconfont['setting'],		$fontLoad);
				}
			}
			
			// Save Settings for Social Network Default Values
			$socialnetwork_defaults_names = array();
			$socialnetwork_defaults_datas = array();
			$socialnetwork_defaults_combo = array();
			foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Social_Networks_Array as $Social_Network => $social) {
				$social_defaults = array(
					'link'						=> trim ($_POST['ts_vcsc_social_link_' . $Social_Network]),
					'order' 					=> trim ($_POST['ts_vcsc_social_order_' . $Social_Network]),
					'original' 					=> $social['order'],
					'icon' 						=> $social['icon'],
				);
				array_push($socialnetwork_defaults_names, $Social_Network);
				$socialnetwork_defaults_datas[] = $social_defaults;		
			}
			$socialnetwork_defaults_combo 		= array_combine($socialnetwork_defaults_names, $socialnetwork_defaults_datas);				
			update_option('ts_vcsc_extend_settings_socialDefaults',					$socialnetwork_defaults_combo);
			
			// --------------------------------
			// Custom Setting Parameter Setting
			// --------------------------------
			$TS_VCSC_Custom_Parameters = array(
				"LinkPicker" 		=> array(),
				"NoUiSlider" 		=> array(),
				"IconPicker"		=> array(),
			);
			// Advanced Link Picker
			$TS_VCSC_Link_Picker = array(
				'enabled'			=> intval(((isset($_POST['ts_vcsc_extend_settings_linkerEnabled']))						?	$_POST['ts_vcsc_extend_settings_linkerEnabled']						: 0)),
				'global'			=> 1,
				'offset'			=> intval(((isset($_POST['ts_vcsc_extend_settings_linkerOffset'])) 						?	$_POST['ts_vcsc_extend_settings_linkerOffset'] 						: 25)),
				'posts'				=> intval(((isset($_POST['ts_vcsc_extend_settings_linkerPosts']))						?	$_POST['ts_vcsc_extend_settings_linkerPosts']						: 0)),
				'custom'			=> intval(((isset($_POST['ts_vcsc_extend_settings_linkerCustom']))						?	$_POST['ts_vcsc_extend_settings_linkerCustom']						: 0)),
				'orderby'			=> ((isset($_POST['ts_vcsc_extend_settings_linkerOrderby'])) 							?	$_POST['ts_vcsc_extend_settings_linkerOrderby'] 					: 'title'),
				'order'				=> ((isset($_POST['ts_vcsc_extend_settings_linkerOrder'])) 								?	$_POST['ts_vcsc_extend_settings_linkerOrder'] 						: 'ASC'),
			);
			$TS_VCSC_Custom_Parameters["LinkPicker"] = $TS_VCSC_Link_Picker;
			// Numeric Slider Input
			$TS_VCSC_NoUiSlider = array(
				'enabled'			=> 1,
				'pips'				=> intval(((isset($_POST['ts_vcsc_extend_settings_nouisliderPips']))					?	$_POST['ts_vcsc_extend_settings_nouisliderPips']					: 0)),
				'tooltip'			=> intval(((isset($_POST['ts_vcsc_extend_settings_nouisliderTooltip']))					?	$_POST['ts_vcsc_extend_settings_nouisliderTooltip']					: 0)),
				'input'				=> 1,
			);
			$TS_VCSC_Custom_Parameters["NoUiSlider"] = $TS_VCSC_NoUiSlider;
			// Screen Size Settings
			$TS_VCSC_ScreenSizes = array(
				'ExtraLarge'		=> 1440,
				'Large'				=> 1024,
				'Medium'			=> 720,
				'Small'				=> 360,
				'ExtraSmall'		=> 0,
			);
			$TS_VCSC_Custom_Parameters["ScreenSizes"] = $TS_VCSC_ScreenSizes;
			update_option('ts_vcsc_extend_settings_parametersCustom',				$TS_VCSC_Custom_Parameters);

			update_option('ts_vcsc_extend_settings_updated',						1);
		}
		echo '<script>';
			echo 'window.location="' . $_SERVER['REQUEST_URI'] . '";';
		echo '</script>';
		//Header('Location: '.$_SERVER['REQUEST_URI']);
		Exit();
	} else {
		if ((TS_VCSC_CurrentPageName() == "admin.php") && ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginMainMenu == "false")) {
			echo '<script>';
				echo 'window.location="' . site_url() . '/wp-admin/options-general.php?page=TS_VCSC_Extender";';
			echo '</script>';
			Exit();
		} else if ((TS_VCSC_CurrentPageName() == "options-general.php") && ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginMainMenu == "true")) {
			echo '<script>';
				echo 'window.location="' . site_url() . '/wp-admin/admin.php?page=TS_VCSC_Extender";';
			echo '</script>';
			Exit();
		}

		// Display a Normal Page
		// --------------------------------------------------------------------------------------------------
		$ts_vcsc_extend_settings_tinymceIcon 						= get_option('ts_vcsc_extend_settings_tinymceIcon',					1);
		$ts_vcsc_extend_settings_loadForcable						= get_option('ts_vcsc_extend_settings_loadForcable', 				0);
		$ts_vcsc_extend_settings_loadLightbox						= get_option('ts_vcsc_extend_settings_loadLightbox', 				0);
		$ts_vcsc_extend_settings_loadFonts							= get_option('ts_vcsc_extend_settings_loadFonts', 					0);
		$ts_vcsc_extend_settings_loadTooltip						= get_option('ts_vcsc_extend_settings_loadTooltip', 				0);
		$ts_vcsc_extend_settings_loadHeader							= get_option('ts_vcsc_extend_settings_loadHeader',					0);
		$ts_vcsc_extend_settings_loadWaypoints						= get_option('ts_vcsc_extend_settings_loadWaypoints',				1);
		$ts_vcsc_extend_settings_loadMagnific						= get_option('ts_vcsc_extend_settings_loadMagnific',				1);
		$ts_vcsc_extend_settings_loadjQuery							= get_option('ts_vcsc_extend_settings_loadjQuery',					0);
		$ts_vcsc_extend_settings_loadEnqueue						= get_option('ts_vcsc_extend_settings_loadEnqueue',					1);
		$ts_vcsc_extend_settings_loadMooTools						= get_option('ts_vcsc_extend_settings_loadMooTools', 				1);
		$ts_vcsc_extend_settings_loadDetector						= get_option('ts_vcsc_extend_settings_loadDetector', 				1);		
		$ts_vcsc_extend_settings_loadHammerNew						= get_option('ts_vcsc_extend_settings_loadHammerNew', 				1);		
		$ts_vcsc_extend_settings_additionsRows						= get_option('ts_vcsc_extend_settings_additionsRows',				0);
		$ts_vcsc_extend_settings_additionsOffsets					= get_option('ts_vcsc_extend_settings_additionsOffsets',			0);
		$ts_vcsc_extend_settings_additionsColumns					= get_option('ts_vcsc_extend_settings_additionsColumns',			0);
		$ts_vcsc_extend_settings_additionsSmoothScroll				= get_option('ts_vcsc_extend_settings_additionsSmoothScroll',		0);
		$ts_vcsc_extend_settings_additionsRowEffectsBreak			= get_option('ts_vcsc_extend_settings_additionsRowEffectsBreak',	'600');
		$ts_vcsc_extend_settings_customWidgets						= get_option('ts_vcsc_extend_settings_customWidgets',				0);
		$ts_vcsc_extend_settings_customTeam							= get_option('ts_vcsc_extend_settings_customTeam',					0);
		$ts_vcsc_extend_settings_customTestimonial					= get_option('ts_vcsc_extend_settings_customTestimonial',			0);
		$ts_vcsc_extend_settings_customSkillset						= get_option('ts_vcsc_extend_settings_customSkillset',				0);
		$ts_vcsc_extend_settings_customTimelines					= get_option('ts_vcsc_extend_settings_customTimelines',				0);
		$ts_vcsc_extend_settings_customLogo							= get_option('ts_vcsc_extend_settings_customLogo',					0);
		$ts_vcsc_extend_settings_useMenuGenerator					= get_option('ts_vcsc_extend_settings_useMenuGenerator',			0);
		$ts_vcsc_extend_settings_useIconGenerator					= get_option('ts_vcsc_extend_settings_useIconGenerator',			0);
		$ts_vcsc_extend_settings_usePostTypes						= get_option('ts_vcsc_extend_settings_usePostTypes',				'');
		$ts_vcsc_extend_settings_mainmenu							= get_option('ts_vcsc_extend_settings_mainmenu', 					1);
		$ts_vcsc_extend_settings_translationsDomain					= get_option('ts_vcsc_extend_settings_translationsDomain', 			1);
		$ts_vcsc_extend_settings_previewImages						= get_option('ts_vcsc_extend_settings_previewImages', 				1);
		$ts_vcsc_extend_settings_backendPreview						= get_option('ts_vcsc_extend_settings_backendPreview', 				1);
		$ts_vcsc_extend_settings_containerToggle					= get_option('ts_vcsc_extend_settings_containerToggle',				0);
		$ts_vcsc_extend_settings_elementFilter						= get_option('ts_vcsc_extend_settings_elementFilter',				0);
		$ts_vcsc_extend_settings_backgroundIndicator				= get_option('ts_vcsc_extend_settings_backgroundIndicator', 		1);
		$ts_vcsc_extend_settings_tinymceEncoded						= get_option('ts_vcsc_extend_settings_tinymceEncoded', 				1);
		$ts_vcsc_extend_settings_visualSelector						= get_option('ts_vcsc_extend_settings_visualSelector', 				1);
		$ts_vcsc_extend_settings_nativePaginator					= get_option('ts_vcsc_extend_settings_nativePaginator', 			'200');
		$ts_vcsc_extend_settings_dashboard							= get_option('ts_vcsc_extend_settings_dashboard', 					0);		
		$ts_vcsc_extend_settings_shortcodesalways					= get_option('ts_vcsc_extend_settings_shortcodesalways',			0);		
		$ts_vcsc_extend_settings_frontendEditor						= get_option('ts_vcsc_extend_settings_frontendEditor', 				1);
		$ts_vcsc_extend_settings_builtinLightbox					= get_option('ts_vcsc_extend_settings_builtinLightbox', 			1);
		$ts_vcsc_extend_settings_lightboxIntegration				= get_option('ts_vcsc_extend_settings_lightboxIntegration', 		0);
		$ts_vcsc_extend_settings_lightboxPrettyPhoto				= get_option('ts_vcsc_extend_settings_lightboxPrettyPhoto', 		0);		
		$ts_vcsc_extend_settings_lightboxAttachAllOther				= get_option('ts_vcsc_extend_settings_lightboxAttachAllOther', 		0);		
		$ts_vcsc_extend_settings_allowAutoUpdate					= get_option('ts_vcsc_extend_settings_allowAutoUpdate', 			1);	
		$ts_vcsc_extend_settings_allowDeprecated					= get_option('ts_vcsc_extend_settings_allowDeprecated', 			0);
		$ts_vcsc_extend_settings_variablesPriority					= get_option('ts_vcsc_extend_settings_variablesPriority', 			'6');
		$ts_vcsc_extend_settings_allowShortcodesWidgets 			= get_option('ts_vcsc_extend_settings_allowShortcodesWidgets', 		1);
		$ts_vcsc_extend_settings_allowAutoParagraphs 				= get_option('ts_vcsc_extend_settings_allowAutoParagraphs', 		1);
		
		// WBP Extensions Elements Settings
		$TS_VCSC_Extension_Elements 								= get_option('ts_vcsc_extend_settings_StandardElements', 			'');
		
		// WBP Demo Elements Settings
		$TS_VCSC_Extension_Demos 									= get_option('ts_vcsc_extend_settings_DemoElements', 				'');
		
		// WooCommerce Settings
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_WooCommerceActive == "true") {
			$TS_VCSC_WooCommerce_Elements							= get_option('ts_vcsc_extend_settings_WooCommerceElements', 		'');
		}
		
		// bbPress Settings
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_bbPressActive == "true") {
			$TS_VCSC_bbPress_Elements								= get_option('ts_vcsc_extend_settings_bbPressElements', 			'');
		}
		
		// External API Settings
		$TS_VCSC_External_API_Settings								= get_option('ts_vcsc_extend_settings_externalAPIs',				array());
		
		// Language Settings: Google Maps PLUS
		$TS_VCSC_Google_MapPLUS_Language 							= get_option('ts_vcsc_extend_settings_translationsGoogleMapPLUS',	$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults);
		
		// Language Settings: Google Maps (Deprecated)
		$TS_VCSC_Google_Map_Language 								= get_option('ts_vcsc_extend_settings_translationsGoogleMap',		$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults);
		
		// Language Settings: Countdown
		$TS_VCSC_Countdown_Language 								= get_option('ts_vcsc_extend_settings_translationsCountdown',		$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults);
		
		// Language Settings: Image Magnify
		$TS_VCSC_Magnify_Language 									= get_option('ts_vcsc_extend_settings_translationsMagnify',			$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Magnify_Language_Defaults);
		
		// Language Settings: Plyr Video Player
		$TS_VCSC_PlyrVideo_Language 								= get_option('ts_vcsc_extend_settings_translationsPlyrPlayer',		$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Plyr_Player_Language_Defaults);
		
		// Language Settings: Loan Calculator
		$TS_VCSC_LoanCalculator_Language							= get_option('ts_vcsc_extend_settings_translationsLoanCalculator',	$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Loan_Calculator_Language_Defaults);

		// Language Settings: Isotope Posts
		$TS_VCSC_Isotope_Posts_Language 							= get_option('ts_vcsc_extend_settings_translationsIsotopePosts',	$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Isotope_Posts_Language_Defaults);
		
		// Default Settings: Lightbox
		$TS_VCSC_Lightbox_Defaults 									= get_option('ts_vcsc_extend_settings_defaultLightboxSettings',		$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Setting_Defaults);
		
		// Default Settings: Row Visibility
		$TS_VCSC_Row_Visibility_Limits 								= get_option('ts_vcsc_extend_settings_rowVisibilityLimits',			$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Row_Toggle_Defaults);
		
		// Default Settings: Menu Positions
		$TS_VCSC_Menu_Positions 									= get_option('ts_vcsc_extend_settings_menuPositions',				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Menu_Positions_Defaults);
		
		// Simple / Extended Options Mode
		$ts_vcsc_extend_settings_allowFullOptions					= get_option('ts_vcsc_extend_settings_allowFullOptions', 			0);
		
		// Google Fonts Manager
		$ts_vcsc_extend_settings_allowGoogleManager					= get_option('ts_vcsc_extend_settings_allowGoogleManager', 			1);
		
		// Custom Fonts Manager
		$ts_vcsc_extend_settings_allowCustomManager					= get_option('ts_vcsc_extend_settings_allowCustomManager', 			0);
		
		// Website Downtime Manager
		$ts_vcsc_extend_settings_allowDowntimeManager				= get_option('ts_vcsc_extend_settings_allowDowntimeManager',		0);
		
		// Widget Sidebars Manager
		$ts_vcsc_extend_settings_allowSidebarsManager				= get_option('ts_vcsc_extend_settings_allowSidebarsManager',		0);
		
		// Single Page Navigator
		$ts_vcsc_extend_settings_allowPageNavigator					= get_option('ts_vcsc_extend_settings_allowPageNavigator', 			0);
		
		// Shortcode Viewer Popup
		$ts_vcsc_extend_settings_allowShortcodeViewer				= get_option('ts_vcsc_extend_settings_allowShortcodeViewer', 		0);
		
		// Extendend Container Nesting
		$ts_vcsc_extend_settings_allowExtendedNesting				= get_option('ts_vcsc_extend_settings_allowExtendedNesting', 		0);
		
		// WP Bakery Page Builder Auto Assignment
		$ts_vcsc_extend_settings_allowAutoAssignment				= get_option('ts_vcsc_extend_settings_allowAutoAssignment', 		1);
		
		// EnlighterJS - Syntax Highlighter
		$ts_vcsc_extend_settings_allowEnlighterJS					= get_option('ts_vcsc_extend_settings_allowEnlighterJS', 			0);
		$ts_vcsc_extend_settings_allowThemeBuilder					= get_option('ts_vcsc_extend_settings_allowThemeBuilder', 			0);
		
		// Contingency Check for Outdated PHP Version
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPHP == "false") {
			$ts_vcsc_extend_settings_customWidgets					= 0;
			$ts_vcsc_extend_settings_customTeam						= 0;
			$ts_vcsc_extend_settings_customTestimonial				= 0;
			$ts_vcsc_extend_settings_customSkillset					= 0;
			$ts_vcsc_extend_settings_customTimelines				= 0;
			$ts_vcsc_extend_settings_customLogo						= 0;
			$ts_vcsc_extend_settings_allowDowntimeManager			= 0;
		}
		
		// Retrieve Setting for each Installed Icon Font
		foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Icon_Font_Settings as $Icon_Font => $iconfont) {
			$default = ($iconfont['default'] == "true" ? 1 : 0);
			${'ts_vcsc_extend_settings_tinymce' . $iconfont['setting'] . ''}		= get_option('ts_vcsc_extend_settings_tinymce' . $iconfont['setting'],		$default);
			${'ts_vcsc_extend_settings_load' . $iconfont['setting'] . ''}			= get_option('ts_vcsc_extend_settings_load' . $iconfont['setting'],			0);
		}
		
		// Retrieve Setting for WP Bakery Page Builder Icon Fonts
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorIconFontsInternal == "true") {
			foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Composer_Font_Settings as $Icon_Font => $iconfont) {
				$default = ($iconfont['default'] == "true" ? 1 : 0);
				${'ts_vcsc_extend_settings_tinymce' . $iconfont['setting'] . ''}	= get_option('ts_vcsc_extend_settings_tinymce' . $iconfont['setting'],		$default);
				${'ts_vcsc_extend_settings_load' . $iconfont['setting'] . ''}		= get_option('ts_vcsc_extend_settings_load' . $iconfont['setting'],			0);
			}
		}
		
		// Basic Form Validation
		if (get_option('ts_vcsc_extend_settings_updated') == 1) {
			echo "\n";
			echo "<script type='text/javascript'>" . "\n";
				echo "var SettingsSaved = true;" . "\n";
			echo "</script>" . "\n";
		} else {
			echo "\n";
			echo "<script type='text/javascript'>" . "\n";
				echo "var SettingsSaved = false;" . "\n";
			echo "</script>" . "\n";
		}
		update_option('ts_vcsc_extend_settings_updated',	0);
	}

	// Simple / Extended Options Class
	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginFullOptions == "true") {
		$TS_VCSC_SimpleOptionsClass									= 'ts-settings-simple-options-show';
	} else {
		$TS_VCSC_SimpleOptionsClass									= 'ts-settings-simple-options-hide';
	}
	
	// License Message Check
	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginIsMultiSiteActive == "true") {
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginValid == "false") {
			echo '<div class="clearFixMe" style="font-weight: bold; text-align: justify; color: green; margin: 20px 0 10px 0; padding: 10px; background: #ffffff; border: 1px solid #dddddd;">Please enter your license key in order to activate the auto-update routine of the plugin!</div>';
		}
	} else {
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginValid == "false") {
			echo '<div class="clearFixMe" style="font-weight: bold; text-align: justify; color: green; margin: 20px 0 10px 0; padding: 10px; background: #ffffff; border: 1px solid #dddddd;">Please enter your license key in order to activate the auto-update routine of the plugin!</div>';
		}
	}
	
	// WP Bakery Page Builder 5.x Check
	if (TS_VCSC_VersionCompare($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Version, '5.0.0') >= 0) {
		$TS_VCSC_ComposerSectionElement 							= "true";
	} else {
		$TS_VCSC_ComposerSectionElement 							= "false";
	}
	// Render Function for Toggle Switch
	function TS_VCSC_CodeStarButton_Settings_Field($settings, $value) {
		$param_name     = isset($settings['param_name'])    ? $settings['param_name']   : '';
		$type           = isset($settings['type'])          ? $settings['type']         : '';
		$on            	= isset($settings['on'])            ? $settings['on']           : __( "Yes", "ts_visual_composer_extend" );
		$off            = isset($settings['off'])           ? $settings['off']          : __( "No", "ts_visual_composer_extend" );
		$label			= isset($settings['label'])			? $settings['label']		: '';
		$order			= isset($settings['order'])			? $settings['order']		: '1';
		$class          = isset($settings['class'])         ? $settings['class']        : '';
		$output         = '';
		// Value Conversion
		if (($value === "true") || ($value === 1) || ($value === true)) {
			$value		= "1";
		} else if (($value === "false") || ($value === 0) || ($value === false)) {
			$value		= "0";
		}
		// Final Output		
		$output .= '<div class="ts-switch-button ts-codestar-field-switcher ' . $class . '" data-value="' . $value . '">';
			$output .= '<div class="ts-codestar-fieldset">';
				$output .= '<label class="ts-codestar-label">';
					$output .= '<input id="' . $param_name . '" data-order="' . $order . '" value="' . $value . '" class="ts-codestar-checkbox ' . $param_name . '" name="' . $param_name . '" type="checkbox" ' . ($value == 1 ? 'checked="checked"' : '') . '>';
					$output .= '<em data-on="' . $on . '" data-off="' . $off . '"></em>';
					$output .= '<span></span>';
				$output .= '</label>';
			$output .= '</div>';
		$output .= '</div>';
		$output .= '<label class="labelToggleBox" for="' . $param_name . '">' . $label . '</label>';
		return $output;
	}
	function TS_VCSC_PostTypes_Settings_Field($settings, $value) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		$param_name     		= isset($settings['param_name']) ? $settings['param_name'] : '';
		$type           		= isset($settings['type']) ? $settings['type'] : '';
		$url            		= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
		$output         		= '';
		$randomizer				= rand(100000, 999999);
		$value_arr 				= $value;
		if (!is_array($value_arr)) {
			$value_arr      	= array_map('trim', explode(',', $value_arr));
		}
		$output .= '<div id="ts-posttypes-selector-holder-' . $randomizer . '" class="ts-posttypes-selector-holder ts-settings-parameter-gradient-grey ts-multiselect-holder" style="padding: 20px; border: 1px solid #e0e0e0;">';
			$output .= '<textarea name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="display: none;">' . $value . '</textarea >';
			$output .= '<select multiple="multiple" name="' . $param_name . '_multiple" id="' . $param_name . '_multiple" data-holder="' . $param_name . '" class="ts-multiple-options-multiselect dropdown ' . $param_name . '_multiple" value=" ' . $value . '" style="margin-bottom: 20px;" data-selectable="' . __( "Available Post Types:", "ts_visual_composer_extend" ) . '" data-selection="' . __( "Applied Post Types:", "ts_visual_composer_extend" ) . '">';
				$args = array(
					'public'   	=> true,
				 );
				$posttypes 		= get_post_types($args, 'names');
				foreach ($posttypes as $type) {
					if ($type != "attachment") {
						$object	= get_post_type_object($type);
						$output .= '<option value="' . $type . '" ' . selected(in_array($type, $value_arr), true, false) . '>' . $object->labels->singular_name . '</option>';
					}
				}
			$output .= '</select>';
			$output .= '<span class="ts-posttypes-selector-message" style="display: block; margin-top: 10px;">' . __( "Click on a name in 'Available Post Types' to add a shortcode generator button to all suitable WordPress editors in that post type; click on a name in 'Applied Post Types' to remove generator from that post type.", "ts_visual_composer_extend" ) . '</span>';
		$output .= '</div>';
		return $output;
	}
	// Functions to Generate Full Form Action URL
	function TS_VCSC_Get_URL_Origin($s, $use_forwarded_host = false) {
		$ssl      		= (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
		$sp       		= strtolower( $s['SERVER_PROTOCOL'] );
		$protocol 		= substr( $sp, 0, strpos( $sp, '/')) . (($ssl) ? 's' : '');
		$port     		= $s['SERVER_PORT'];
		$port     		= ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
		$host     		= ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
		$host     		= isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
		return $protocol . '://' . $host;
	}
	function TS_VCSC_Get_URL_Full($s, $use_forwarded_host = false) {
		return TS_VCSC_Get_URL_Origin($s, $use_forwarded_host) . $s['REQUEST_URI'];
	}	
	$action_url 		= TS_VCSC_Get_URL_Full($_SERVER);
?>
<div id="ts_vcsc_extend_errors" style="display: none;">
	<div class="ts-vcsc-section-main">
		<div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-hammer ts-vcsc-section-title-icon"></i><span class="ts-vcsc-section-title-header"></span></div>
		<div class="ts-vcsc-section-content"></div>
	</div>
</div>
<form id="ts_vcsc_extend_settings" data-type="settings" class="ts_vcsc_extend_global_settings" name="ts_vcsc_extend_settings" style="margin-top: 25px; width: 100%;" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<span id="gallery_settings_true" style="display: none !important; margin-bottom: 20px;">
		<input type="text" style="width: 20%;" id="ts_vcsc_extend_settings_true" name="ts_vcsc_extend_settings_true" value="0" size="100">
		<input type="text" style="width: 20%;" id="ts_vcsc_extend_settings_count" name="ts_vcsc_extend_settings_count" value="0" size="100">
	</span>
	<div class="wrapper ts-vcsc-settings-group-container">		
		<div class="ts-vcsc-settings-group-header">
			<div class="display_header">
				<h2><span class="dashicons dashicons-admin-generic"></span>Composium - WP Bakery Page Builder Extensions v<?php echo TS_VCSC_GetPluginVersion(); ?> ... Settings Panel</h2>
			</div>
			<div class="clear"></div>
		</div>
		<div class="ts-vcsc-settings-group-topbar ts-vcsc-settings-group-buttonbar">
			<a href="javascript:void(0);" class="ts-vcsc-settings-group-toggle">Expand</a>
			<div class="ts-vcsc-settings-group-actionbar">
				<div class="ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder ts-advanced-link-tooltip-right ts-advanced-link-tooltip-bottom">
					<span class="ts-advanced-link-tooltip-content"><?php _e("Click here to save your Composium plugin settings.", "ts_visual_composer_extend"); ?></span>
					<button type="submit" name="Submit" id="ts_vcsc_extend_settings_submit_1" class="ts-advanced-link-button-main ts-advanced-link-button-blue ts-advanced-link-button-save" style="margin: 0;">
						<?php echo __("Save Settings", "ts_visual_composer_extend"); ?>
					</button>
				</div>		
			</div>
			<div class="clear"></div>
		</div>		
		<div id="v-nav" class="ts-vcsc-settings-group-tabs">
			<ul id="v-nav-main" data-type="settings">
				<li id="link-ts-settings-logo" class="first" style="border-bottom: 1px solid #DDD; height: 250px;">
					<img style="width: 100%; height: auto; margin: 0 auto;" src="<?php echo TS_VCSC_GetResourceURL('images/logos/composium_vce.png'); ?>">
				</li>
				<li id="link-ts-settings-general" 		data-tab="ts-settings-general" 			data-order="1"		data-name="General Settings"		class="link-data current"><i class="dashicons-admin-generic"></i>General Settings<span id="errorTab1" class="errorMarker"></span></li>
				<li id="link-ts-settings-elements" 		data-tab="ts-settings-elements"			data-order="2"		data-name="Elements: Main"			class="link-data"><i class="dashicons-image-filter"></i>Elements: Main<span id="errorTab2" class="errorMarker"></span></li>
				<?php
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_WooCommerceActive == "true") {
						echo '<li id="link-ts-settings-woocommerce" 	data-tab="ts-settings-woocommerce" 		data-order="3"		data-name="Elements: WooCommerce"	class="link-data"><i class="dashicons-products"></i>Elements: WooCommerce<span id="errorTab3" class="errorMarker"></span></li>';
					}
				?>
				<?php
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_bbPressActive == "true") {
						echo '<li id="link-ts-settings-bbpress" 		data-tab="ts-settings-bbpress" 			data-order="4"		data-name="Elements: bbpress"		class="link-data"><i class="dashicons-admin-comments"></i>Elements: bbPress<span id="errorTab4" class="errorMarker"></span></li>';
					}
				?>
				<li id="link-ts-settings-other" 		data-tab="ts-settings-other"			data-order="5"		data-name="Elements: Other"	class="link-data"><i class="dashicons-smiley"></i>Elements: Other<span id="errorTab5" class="errorMarker"></span></li>
				<?php
					if ($TS_VCSC_ComposerSectionElement == "true") {
						echo '<li id="link-ts-settings-rowcolumn"		data-tab="ts-settings-rowcolumn"		data-order="6"		data-name="Sections, Rows & Columns"	class="link-data"><i class="dashicons-editor-kitchensink"></i>Sections, Rows & Columns<span id="errorTab6" class="errorMarker"></span></li>';
					} else {
						echo '<li id="link-ts-settings-rowcolumn"		data-tab="ts-settings-rowcolumn"		data-order="6"		data-name="Rows & Columns"				class="link-data"><i class="dashicons-editor-kitchensink"></i>Rows & Columns<span id="errorTab6" class="errorMarker"></span></li>';
					}
				?>
				<?php
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesCheckup == "true") {
						echo '<li id="link-ts-settings-posttypes"		data-tab="ts-settings-posttypes"		data-order="7"		data-name="Custom Post Type"		class="link-data"><i class="dashicons-admin-page"></i>Custom Post Types<span id="errorTab7" class="errorMarker"></span></li>';
					}
				?>
				<li id="link-ts-settings-composer" 		data-tab="ts-settings-composer"			data-order="8"		data-name="WP Bakery Page Builder"	class="link-data"><i class="dashicons-star-filled"></i>WP Bakery Page Builder<span id="errorTab8" class="errorMarker"></span></li>
				<li id="link-ts-settings-lightbox" 		data-tab="ts-settings-lightbox" 		data-order="9"		data-name="Lightbox Settings"		class="link-data"><i class="dashicons-images-alt2"></i>Lightbox Settings<span id="errorTab9" class="errorMarker"></span></li>
				<li id="link-ts-settings-language" 		data-tab="ts-settings-language" 		data-order="10"		data-name="Language Settings"		class="link-data"><i class="dashicons-translation"></i>Language Settings<span id="errorTab10" class="errorMarker"></span></li>
				<li id="link-ts-settings-social" 		data-tab="ts-settings-social" 			data-order="11"		data-name="Social Defaults"			class="link-data"><i class="dashicons-share"></i>Social Networks<span id="errorTab11" class="errorMarker"></span></li>
				<li id="link-ts-settings-apis" 			data-tab="ts-settings-apis" 			data-order="12"		data-name="External API's"			class="link-data"><i class="dashicons-admin-network"></i>External API's<span id="errorTab12" class="errorMarker"></span></li>
				<li id="link-ts-settings-iconfont" 		data-tab="ts-settings-iconfont" 		data-order="13"		data-name="Icon Fonts Manager"		class="link-data"><i class="dashicons-index-card"></i>Icon Fonts Manager<span id="errorTab13" class="errorMarker"></span></li>
				<?php
					if ((($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginExtended == "true") && (get_option('ts_vcsc_extend_settings_fontimport', 1) == 1)) || (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginExtended == "false"))) {
						echo '<a href="admin.php?page=TS_VCSC_Uploader" target="_parent" style="color: #000000;">';
							echo '<li id="link-ts-settings-import" 				data-tab="ts-settings-import" 			data-order="14"		data-name="Import Icon Font"				class="link-url"><i class="dashicons-upload"></i>Import Icon Font<span id="errorTab14" class="errorMarker"></span></li>';
						echo '</a>';
					}
				?>
				<a href="admin.php?page=TS_VCSC_Previews" target="_parent" style="color: #000000;">
					<li id="link-ts-settings-iconview"	data-tab="ts-settings-iconview" 		data-order="15"		data-name="Icon Preview"			class="link-url"><i class="dashicons-visibility"></i>Icon Previews<span id="errorTab15" class="errorMarker"></span></li>
				</a>
				<?php
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconicumStandard == "false") {
						if (get_option('ts_vcsc_extend_settings_useMenuGenerator', 0) == 1) {
							echo '<a href="admin.php?page=TS_VCSC_Generator" target="_parent" style="color: #000000;">';
								echo '<li id="link-ts-settings-generator" 		data-tab="ts-settings-generator"	data-order="16"		data-name="Icon Generator"			class="link-url"><i class="dashicons-hammer"></i>Icon Generator<span id="errorTab16" class="errorMarker"></span></li>';
							echo '</a>';
						}
					}
				?>				
				<li id="link-ts-settings-files" 		data-tab="ts-settings-files" 			data-order="17"		data-name="External Files"			class="link-data <?php echo $TS_VCSC_SimpleOptionsClass; ?>"><i class="dashicons-download"></i>External Files<span id="errorTab17" class="errorMarker"></span></li>
				<?php
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseGoogleFontManager == "true") {
						echo '<a href="admin.php?page=TS_VCSC_GoogleFonts" target="_parent" style="color: #000000;">';
							echo '<li id="link-ts-settings-google" 		data-tab="ts-settings-google"				data-order="18"		data-name="Google Fonts Manager"	class="link-url"><i class="dashicons-googleplus"></i>Google Fonts Manager<span id="errorTab18" class="errorMarker"></span></li>';
						echo '</a>';
					}
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseCustomFontManager == "true") {
						echo '<a href="admin.php?page=TS_VCSC_CustomFonts" target="_parent" style="color: #000000;">';
							echo '<li id="link-ts-settings-custom" 		data-tab="ts-settings-custom"				data-order="19"		data-name="Custom Fonts Manager"	class="link-url"><i class="dashicons-editor-textcolor"></i>Custom Fonts Manager<span id="errorTab19" class="errorMarker"></span></li>';
						echo '</a>';
					}
				?>
				<?php
					if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseEnlighterJS == "true") && ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseThemeBuilder == "true")) {
						echo '<a href="admin.php?page=TS_VCSC_EnlighterJS" target="_parent" style="color: #000000;">';
							echo '<li id="link-ts-settings-enlighterjs" 	data-tab="ts-settings-enlighterjs"		data-order="20"		data-name="EnlighterJS Theme"	class="link-url"><i class="dashicons-editor-code"></i>EnlighterJS Theme<span id="errorTab20" class="errorMarker"></span></li>';
						echo '</a>';
					}
				?>
				<?php
					if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesDownpage == "true") && (current_user_can('manage_options'))) {
						echo '<a href="admin.php?page=TS_VCSC_Downtime" target="_parent" style="color: #000000;">';
							echo '<li id="link-ts-settings-downtime" 		data-tab="ts-settings-downtime"			data-order="21"		data-name="Downtime Manager"	class="link-url"><i class="dashicons-clock"></i>Downtime Manager<span id="errorTab21" class="errorMarker"></span></li>';
						echo '</a>';
					}
				?>
				<?php
					if (current_user_can('manage_options')) {
						if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseSidebarsManager == "true") {
							echo '<a href="admin.php?page=TS_VCSC_Sidebars" target="_parent" style="color: #000000;">';
								echo '<li id="link-ts-settings-sidebars"	data-tab="ts-settings-sidebars"			data-order="22"		data-name="Sidebars Manager"		class="link-url ' . $TS_VCSC_SimpleOptionsClass . '"><i class="dashicons-welcome-widgets-menus"></i>Sidebars Manager<span id="errorTab22" class="errorMarker"></span></li>';
							echo '</a>';
						}
						if ((($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginExtended == "true") && (get_option('ts_vcsc_extend_settings_codeeditors', 1) == 1)) || (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginExtended == "false"))) {
							echo '<a href="admin.php?page=TS_VCSC_CSS" target="_parent" style="color: #000000;">';
								echo '<li id="link-ts-settings-customcss" 	data-tab="ts-settings-customcss"		data-order="23"		data-name="Add Custom CSS"			class="link-url ' . $TS_VCSC_SimpleOptionsClass . '"><i class="dashicons-media-code"></i>Custom CSS<span id="errorTab23" class="errorMarker"></span></li>';
							echo '</a>';
							echo '<a href="admin.php?page=TS_VCSC_JS" target="_parent" style="color: #000000;">';
								echo '<li id="link-ts-settings-customjs" 	data-tab="ts-settings-customjs" 		data-order="24"		data-name="Add Custom JS"			class="link-url ' . $TS_VCSC_SimpleOptionsClass . '"><i class="dashicons-media-code"></i>Custom JS<span id="errorTab24" class="errorMarker"></span></li>';
							echo '</a>';
						}
						if (function_exists('file_get_contents')) {
							echo '<li id="link-ts-settings-changelog" 		data-tab="ts-settings-changelog" 		data-order="25"		data-name="Changelog"				class="link-data"><i class="dashicons-media-text"></i>Changelog<span id="errorTab25" class="errorMarker"></span></li>';
						}
						if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UserIsAdministrator == "true") {
							echo '<a href="admin.php?page=TS_VCSC_Usage" target="_parent" style="color: #000000;">';
								echo '<li id="link-ts-settings-statistics" 		data-tab="ts-settings-statistics" 	data-order="26"		data-name="Usage Statistics"	class="link-url ' . $TS_VCSC_SimpleOptionsClass . '"><i class="dashicons-image-filter"></i>Usage Statistics<span id="errorTab26" class="errorMarker"></span></li>';
							echo '</a>';
						}
						echo '<a href="admin.php?page=TS_VCSC_System" target="_parent" style="color: #000000;">';
							echo '<li id="link-ts-settings-systeminfo" 		data-tab="ts-settings-systeminfo" 		data-order="76"		data-name="System Info"				class="link-url"><i class="dashicons-desktop"></i>System Info<span id="errorTab27" class="errorMarker"></span></li>';
						echo '</a>';
						if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginExtended == "false") {
							echo '<a href="admin.php?page=TS_VCSC_License" target="_parent" style="color: #000000;">';
								echo '<li id="link-ts-settings-license" 	data-tab="ts-settings-license"			data-order="28"		data-name="Licence Key"				class="link-url"><i class="dashicons-admin-network"></i>License Key<span id="errorTab28" class="errorMarker"></span></li>';
							echo '</a>';
						}
						echo '<a href="admin.php?page=TS_VCSC_Transfers" target="_parent" style="color: #000000;">';
							echo '<li id="link-ts-settings-transfers" 		data-tab="ts-settings-transfers"		data-order="29"		data-name="Transfer Settings"		class="link-url ' . $TS_VCSC_SimpleOptionsClass . '"><i class="dashicons-migrate"></i>Transfer Settings<span id="errorTab29" class="errorMarker"></span></li>';
						echo '</a>';
					}
					echo '<a href="admin.php?page=TS_VCSC_About" target="_parent" style="color: #000000;">';
						echo '<li id="link-ts-settings-about" 				data-tab="ts-settings-about"			data-order="30"		data-name="About Composium"			class="link-url last"><i class="dashicons-info"></i>About Composium<span id="errorTab30" class="errorMarker"></span></li>';
					echo '</a>';
				?>
			</ul>
		</div>
		<div class="ts-vcsc-settings-group-main">
			<?php
				include('ts_vcsc_settings_general.php');				
				include('ts_vcsc_settings_elements.php');
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_WooCommerceActive == "true") {
					include('ts_vcsc_settings_woocommerce.php');
				}
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_bbPressActive == "true") {
					include('ts_vcsc_settings_bbpress.php');
				}
				include('ts_vcsc_settings_other.php');
				include('ts_vcsc_settings_rowcolumn.php');
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesCheckup == "true") {
					include('ts_vcsc_settings_posttypes.php');
				}
				include('ts_vcsc_settings_composer.php');
				include('ts_vcsc_settings_lightbox.php');
				include('ts_vcsc_settings_language.php');
				include('ts_vcsc_settings_social.php');
				include('ts_vcsc_settings_iconfont.php');
				include('ts_vcsc_settings_apis.php');
				include('ts_vcsc_settings_external.php');
				if (function_exists('file_get_contents')) {
					include('ts_vcsc_settings_changelog.php');
				}
			?>
        </div>
		<div class="ts-vcsc-settings-group-bottombar ts-vcsc-settings-group-buttonbar" style="">
			<div class="ts-vcsc-settings-group-actionbar">
				<div class="ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder ts-advanced-link-tooltip-right">
					<span class="ts-advanced-link-tooltip-content"><?php _e("Click here to save your Composium plugin settings.", "ts_visual_composer_extend"); ?></span>
					<button type="submit" name="Submit" id="ts_vcsc_extend_settings_submit_2" class="ts-advanced-link-button-main ts-advanced-link-button-blue ts-advanced-link-button-save" style="margin: 0;">
						<?php _e("Save Settings", "ts_visual_composer_extend"); ?>
					</button>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>