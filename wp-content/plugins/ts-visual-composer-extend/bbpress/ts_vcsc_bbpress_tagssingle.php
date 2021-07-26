<?php
    global $VISUAL_COMPOSER_EXTENSIONS;	
	$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
		"name" 							=> __("Single Topic Tags", "ts_visual_composer_extend"),
		"base" 							=> "bbp-single-tag",
		"icon" 							=> "ts-composer-element-icon-bbpress", 
		"class" 						=> "", 
		"category" 						=> __('bbPress', "ts_visual_composer_extend"),
		"description"					=> __("Place a cloud of topic tags", "ts_visual_composer_extend"),
		"admin_enqueue_js"				=> "",
		"admin_enqueue_css"				=> "",
		"show_settings_on_create" 		=> true,
		"params" 						=> array(
			array(
				"type"              	=> "seperator",
				"param_name"        	=> "seperator_1",
				"seperator"         	=> "bbPress: " . __("Single Topic Tags", "ts_visual_composer_extend"),
			),
			array(
				"type"              	=> "messenger",
				"param_name"        	=> "messenger",
				"color"					=> "#006BB7",
				"size"					=> "14",
				"value"					=> "",
				"message"            	=> __( "This element will display a list of all topic tags.", "ts_visual_composer_extend" )
			),
			array(
				"type" 					=> "bbpress_tagslist",
				"heading" 				=> __("List of Tags", "ts_visual_composer_extend"),
				"param_name" 			=> "id"
			)
		)
	);	
	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
		return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
	} else {			
		vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
	};
?>