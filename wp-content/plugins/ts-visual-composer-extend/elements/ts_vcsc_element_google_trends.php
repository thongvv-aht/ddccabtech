<?php
    global $VISUAL_COMPOSER_EXTENSIONS;	
    $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
		"name"                      => __( "TS Google Trends", "ts_visual_composer_extend" ),
		"base"                      => "TS-VCSC-Google-Trends",
		"icon" 	                    => "ts-composer-element-icon-google-trend",
		"category"                  => __( "Composium", "ts_visual_composer_extend" ),
		"description"               => __("Place a Google Trends element", "ts_visual_composer_extend"),
		"admin_enqueue_js"			=> "",
		"admin_enqueue_css"			=> "",
		"params"                    => array(
			// Google Trends Settings
			array(
				"type"              => "seperator",
				"param_name"        => "seperator_1",
				"seperator"			=> "Google Trend Settings",
			),
			array(
				"type"              => "nouislider",
				"heading"           => __( "Height in px", "ts_visual_composer_extend" ),
				"param_name"        => "trend_height",
				"value"             => "400",
				"min"               => "100",
				"max"               => "2048",
				"step"              => "1",
				"unit"              => 'px',
			),
			array(
				"type"              => "nouislider",
				"heading"           => __( "Width in px", "ts_visual_composer_extend" ),
				"param_name"        => "trend_width",
				"value"             => "1024",
				"min"               => "100",
				"max"               => "2048",
				"step"              => "1",
				"unit"              => 'px',
			),
			array(
				"type"              => "switch_button",
				"heading"           => __( "Show Trend Averages", "ts_visual_composer_extend" ),
				"param_name"        => "trend_average",
				"value"             => "false",
				"description"		=> __( "Switch the toggle to show or hide trend averages.", "ts_visual_composer_extend" )
			),
			array(
				"type"              => "textarea",
				"heading"           => __( "Tags", "ts_visual_composer_extend" ),
				"param_name"        => "trend_tags",
				"value"             => "",
				"admin_label"       => true,
				"description"       => __( "Enter the keywords (maximum of 5), separate by comma.", "ts_visual_composer_extend" )
			),
			array(
				"type"              => "textfield",
				"heading"           => __( "Geo-Location", "ts_visual_composer_extend" ),
				"param_name"        => "trend_geo",
				"value"             => "US",
				"description"       => __( "Enter the Geo Location for your trend (default is US).", "ts_visual_composer_extend" )
			),
		)
	);	
	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
		return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
	} else {			
		vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
	};
?>