<?php
    global $VISUAL_COMPOSER_EXTENSIONS;	
    $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
		"name"                      => __( "TS Google Forms", "ts_visual_composer_extend" ),
		"base"                      => "TS-VCSC-Google-Forms",
		"icon" 	                    => "ts-composer-element-icon-google-form",
		"category"                  => __( "Composium", "ts_visual_composer_extend" ),
		"description"               => __("Place a Google Forms element", "ts_visual_composer_extend"),
		"admin_enqueue_js"			=> "",
		"admin_enqueue_css"			=> "",
		"params"                    => array(
			// Google Forms Settings
			array(
				"type"              => "seperator",
				"param_name"        => "seperator_1",
				"seperator"			=> "Form Settings",
			),
			array(
				"type"              => "textfield",
				"heading"           => __( "Form Key", "ts_visual_composer_extend" ),
				"param_name"        => "form_id",
				"value"             => "",
				"admin_label"		=> true,
				"description"       => __( "Enter the alpha-numeric Google Form key.", "ts_visual_composer_extend" )
			),
			array(
				"type"              => "nouislider",
				"heading"           => __( "Form Height", "ts_visual_composer_extend" ),
				"param_name"        => "form_height",
				"value"             => "500",
				"min"               => "100",
				"max"               => "2048",
				"step"              => "1",
				"unit"              => 'px',
				"description"       => __( "Define the desired height of the form.", "ts_visual_composer_extend" ),
			),
			array(
				"type"              => "seperator",
				"param_name"        => "seperator_2",
				"seperator"			=> "Other Settings",
			),
			array(
				"type"              => "nouislider",
				"heading"           => __( "Margin: Top", "ts_visual_composer_extend" ),
				"param_name"        => "margin_top",
				"value"             => "20",
				"min"               => "-50",
				"max"               => "500",
				"step"              => "1",
				"unit"              => 'px',
				"description"       => __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
			),
			array(
				"type"              => "nouislider",
				"heading"           => __( "Margin: Bottom", "ts_visual_composer_extend" ),
				"param_name"        => "margin_bottom",
				"value"             => "20",
				"min"               => "-50",
				"max"               => "500",
				"step"              => "1",
				"unit"              => 'px',
				"description"       => __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
			),
		)
	);	
	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
		return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
	} else {			
		vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
	};
?>