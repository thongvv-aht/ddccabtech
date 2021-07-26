<?php
    global $VISUAL_COMPOSER_EXTENSIONS;
	
    $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
		"name"                      => __( "TS Advanced Text Block", "ts_visual_composer_extend" ),
		"base"                      => "TS_VCSC_Advanced_Textblock",
		"icon" 	                    => "icon-wpb-ts_vcsc_advanced_textblock",
		"class"                     => "",
		"category"                  => __( "Composium", "ts_visual_composer_extend" ),
		"description"               => __("Place an advanced textblock element", "ts_visual_composer_extend"),
		"admin_enqueue_js"        	=> "",
		"admin_enqueue_css"       	=> "",
		"params"                    => array(
			// Spacer Settings
			array(
				"type"              => "seperator",
				"param_name"        => "seperator_1",
				"value"				=> "",
				"seperator"         => "Textblock Content",
			),
			array(
				"type"              => "nouislider",
				"heading"           => __( "Height in px", "ts_visual_composer_extend" ),
				"param_name"        => "height",
				"value"             => "10",
				"min"               => "0",
				"max"               => "500",
				"step"              => "1",
				"unit"              => 'px',
				"admin_label"		=> true,
			),
		)
	);
	
	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
		return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
	} else {			
		vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
	}
?>