<?php
	add_shortcode('TS-VCSC-Google-Maps', 	'TS_VCSC_Google_Maps_Function');
	function TS_VCSC_Google_Maps_Function ($atts, $content = null) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		// Retrieve Language Settings
		$TS_VCSC_Google_Map_Language 		= get_option('ts_vcsc_extend_settings_translationsGoogleMap', '');
		if (($TS_VCSC_Google_Map_Language == false) || (empty($TS_VCSC_Google_Map_Language))) {
			$TS_VCSC_Google_Map_Language	= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults;
		}
		
		wp_enqueue_style('ts-visual-composer-extend-front');
		wp_enqueue_script('ts-visual-composer-extend-front');
		
		extract( shortcode_atts( array(
			'googlemap_api'				=> 'true',
			'height'					=> '400',
			'coordinates'				=> '',
			'geolocation'				=> 'true',
			'autocomplete'				=> 'false',
			'geolayer'					=> '1',
			'maptype'					=> 'ROADMAP',
			'mapstyle'					=> 'style_default',
			'mapfullwidth'				=> 'false',
			'mapfullwrapper'			=> 'false',
			'breakouts'					=> 6,
			'mobileactivate'			=> 'true',
			'metric'					=> 'false',
			'controls_wheel'			=> 'true',
			'controls_pan'				=> 'true',
			'controls_zoom'				=> 'true',
			'controls_scale'			=> 'true',
			'controls_street'			=> 'true',
			'controls_style'			=> 'false',
			'directions'				=> 'true',
			'showgoogle'				=> 'true',
			'tooltipvisible'			=> 'false',
			'markerstyle'				=> 'default',
			'markerzoom'				=> 17,
			'markerimage'				=> '',
			'markerinternal'			=> '',
			'markeranimation'			=> 'true',
			'markeranimationtype'		=> 'drop',
			'margin_top'				=> 20,
			'margin_bottom'				=> 20,
			'el_id'						=> '',
			'el_class'					=> '',
			'css'						=> '',
		), $atts ));
		
		// Check for Front End Editor
		if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
			$editor_frontend			= "true";
		} else {
			$editor_frontend			= "false";
		}

		$randomizer						= mt_rand(999999, 9999999);
		
		if ($googlemap_api == "true") {
			wp_enqueue_script('ts-extend-mapapi-library');
		}
		wp_enqueue_script('ts-extend-infobox');
		wp_enqueue_script('ts-extend-googlemap');
		
		if (!empty($el_id)) {
			$map_id						= $el_id;
		} else {
			$map_id						= 'ts-vcsc-google-map-' . $randomizer;
		}
	
		if ($markerstyle == "image") {
			$marker_image 				= wp_get_attachment_image_src($markerimage, 'full');
			$marker_image				= $marker_image[0];
		} else if ($markerstyle == "marker") {
			$marker_image				= TS_VCSC_GetResourceURL('images/marker/' . $markerinternal);
		} else {
			$marker_image				= '';
		}
		
		if (function_exists('vc_shortcode_custom_css_class')) {
			$css_class					= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Google-Maps', $atts);
		} else {
			$css_class					= '';
		}
		
		$output 						= '';

		if (($mapfullwidth == "true") && ($mapfullwrapper == "true")) {
			$output .= '<div class="ts-map-wrapper" style="width: 100%; height: 100%; position: relative; display: block;">';
		}
			$output .= '<div id="' . $map_id . '" class="ts-map-frame ' . $css_class . ' clearFixMe" data-height="' . $height . '" data-activate="false" data-inline="' . $editor_frontend . '" data-break-parents="' . $breakouts . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;"></div>';
		if (($mapfullwidth == "true") && ($mapfullwrapper == "true")) {
			$output .= '</div>';
		}
		?>
			<script type="text/javascript">
				jQuery(document).ready(function($){
					<?php if ($editor_frontend == "true") { ?>
						var $style_default 			= [];
					<?php } ?>
					if (typeof jQuery.fn.TSGM_Map !== 'undefined') {
						jQuery('#<?php echo $map_id; ?>').TSGM_Map({
							TSGM_Height: 			'<?php echo $height; ?>',
							TSGM_Width:				'100',
							TSGM_MobileActivate:	<?php echo $mobileactivate; ?>,
							TSGM_AutoComplete:		<?php echo $autocomplete; ?>,
							TSGM_MapFullWidth:		<?php echo $mapfullwidth; ?>,
							TSGM_MapType:			'<?php echo $maptype; ?>',
							TSGM_MapStyle:			<?php echo ($editor_frontend == "true" ? "$" . "style_default" : "$" . $mapstyle); ?>,
							TSGM_MapCustom:			'<?php echo ($editor_frontend == "true" ? "style_default" : $mapstyle); ?>',
							TSGM_GeoLocation:		<?php echo $geolocation; ?>,
							TSGM_GeoLayer:			<?php echo $geolayer; ?>,
							TSGM_ScrollWheel:		<?php echo $controls_wheel; ?>,
							TSGM_PanControl:		<?php echo $controls_pan; ?>,
							TSGM_ZoomControl:		<?php echo $controls_zoom; ?>,
							TSGM_ScaleControl:		<?php echo $controls_scale; ?>,
							TSGM_StreetControl:		<?php echo $controls_street; ?>,
							TSGM_StyleControl:		<?php echo $controls_style; ?>,
							TSGM_Metric:			<?php echo $metric; ?>,
							TSGM_MapIcon:			'<?php echo $marker_image; ?>',
							TSGM_MapDirections:		<?php echo $directions; ?>,
							TSGM_MapGoogle:			<?php echo $showgoogle; ?>,
							TSGM_ZoomStartPoint:	<?php echo $markerzoom; ?>,
							TSGM_StartOpacity: 		8,
							TSGM_Animation:			<?php echo $markeranimation; ?>,
							TSGM_AnimationType:		'<?php echo $markeranimationtype; ?>',
							TSGM_ShowTarget:  		false,
							TSGM_ShowBouncer:  		true,
							TSGM_StartPanel: 		true,
							TSGM_TexStartPoint:		'',
							TSGM_Fixdestination:	'<?php echo $coordinates; ?>',
							TSGM_TooltipContent:	'<div class="ts-map-infobox"><?php echo trim(preg_replace('/\s+/', ' ', do_shortcode($content))); ?></div>',
							TSGM_TooltipVisible:	<?php echo $tooltipvisible; ?>,
							TSGM_TextCalcShow:		<?php echo '"' . ((array_key_exists('TextCalcShow', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextCalcShow'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextCalcShow']) . '"'; ?>,
							TSGM_TextCalcHide:		<?php echo '"' . ((array_key_exists('TextCalcHide', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextCalcHide'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextCalcHide']) . '"'; ?>,
							TSGM_TextDirectionShow:	<?php echo '"' . ((array_key_exists('TextDirectionShow', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextDirectionShow'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextDirectionShow']) . '"'; ?>,
							TSGM_TextDirectionHide:	<?php echo '"' . ((array_key_exists('TextDirectionHide', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextDirectionHide'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextDirectionHide']) . '"'; ?>,
							TSGM_TextResetMap:		<?php echo '"' . ((array_key_exists('TextResetMap', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextResetMap'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextResetMap']) . '"'; ?>,
							TSGM_PrintRouteText:	<?php echo '"' . ((array_key_exists('PrintRouteText', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['PrintRouteText'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['PrintRouteText']) . '"'; ?>,
							TSGM_TextDistance:		<?php echo '"' . ((array_key_exists('TextDistance', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextDistance'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextDistance']) . '"'; ?>,							
							TSGM_TextViewOnGoogle:	<?php echo '"' . ((array_key_exists('TextViewOnGoogle', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextViewOnGoogle'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextViewOnGoogle']) . '"'; ?>,
							TSGM_TextButtonCalc:	<?php echo '"' . ((array_key_exists('TextButtonCalc', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextButtonCalc'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextButtonCalc']) . '"'; ?>,
							TSGM_TextSetTarget:		<?php echo '"' . ((array_key_exists('TextSetTarget', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextSetTarget'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextSetTarget']) . '"'; ?>,
							TSGM_TextButtonGeo:		<?php echo '"' . ((array_key_exists('TextGeoLocation', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextGeoLocation'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextGeoLocation']) . '"'; ?>,
							TSGM_TextTravelMode:	<?php echo '"' . ((array_key_exists('TextTravelMode', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextTravelMode'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextTravelMode']) . '"'; ?>,
							TSGM_TextDriving:		<?php echo '"' . ((array_key_exists('TextDriving', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextDriving'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextDriving']) . '"'; ?>,
							TSGM_TextWalking:		<?php echo '"' . ((array_key_exists('TextWalking', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextWalking'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextWalking']) . '"'; ?>,
							TSGM_TextBicy:			<?php echo '"' . ((array_key_exists('TextBicy', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextBicy'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextBicy']) . '"'; ?>,
							TSGM_TextWP:			<?php echo '"' . ((array_key_exists('TextWP', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextWP'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextWP']) . '"'; ?>,
							TSGM_TextButtonAdd:		<?php echo '"' . ((array_key_exists('TextButtonAdd', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextButtonAdd'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextButtonAdd']) . '"'; ?>,
							TSGM_TextMapHome:		<?php echo '"' . ((array_key_exists('TextMapHome', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextMapHome'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextMapHome']) . '"'; ?>,
							TSGM_TextMapBikes:		<?php echo '"' . ((array_key_exists('TextMapBikes', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextMapBikes'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextMapBikes']) . '"'; ?>,
							TSGM_TextMapTraffic:	<?php echo '"' . ((array_key_exists('TextMapTraffic', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextMapTraffic'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextMapTraffic']) . '"'; ?>,
							TSGM_TextSpeedMiles:	<?php echo '"' . ((array_key_exists('TextMapSpeedMiles', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextMapSpeedMiles'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextMapSpeedMiles']) . '"'; ?>,
							TSGM_TextSpeedKM:		<?php echo '"' . ((array_key_exists('TextMapSpeedKM', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextMapSpeedKM'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextMapSpeedKM']) . '"'; ?>,
							TSGM_TextMapNoData:		<?php echo '"' . ((array_key_exists('TextMapNoData', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextMapNoData'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextMapNoData']) . '"'; ?>,							
							TSGM_TextMapMiles:		<?php echo '"' . ((array_key_exists('TextMapMiles', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextMapMiles'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextMapMiles']) . '"'; ?>,
							TSGM_TextMapKM:			<?php echo '"' . ((array_key_exists('TextMapKilometes', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextMapKilometes'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextMapKilometes']) . '"'; ?>,
							TSGM_TextButtonShow:	<?php echo '"' . ((array_key_exists('TextMapActivate', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextMapActivate'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextMapActivate']) . '"'; ?>,
							TSGM_TextButtonHide:	<?php echo '"' . ((array_key_exists('TextMapDeactivate', $TS_VCSC_Google_Map_Language)) ? $TS_VCSC_Google_Map_Language['TextMapDeactivate'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_Map_Language_Defaults['TextMapDeactivate']) . '"'; ?>,
						});
					}
				});
			</script>
		<?php
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>