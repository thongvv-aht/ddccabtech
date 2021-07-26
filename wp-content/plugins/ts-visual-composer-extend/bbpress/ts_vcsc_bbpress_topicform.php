<?php
    global $VISUAL_COMPOSER_EXTENSIONS;	
	$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
		"name" 							=> __("New Topic Form", "ts_visual_composer_extend"),
		"base" 							=> "bbp-topic-form",
		"icon" 							=> "ts-composer-element-icon-bbpress", 
		"class" 						=> "", 
		"category" 						=> __('bbPress', "ts_visual_composer_extend"),
		"description"					=> __("Place a list of recent topics", "ts_visual_composer_extend"),
		"admin_enqueue_js"				=> "",
		"admin_enqueue_css"				=> "",
		"show_settings_on_create" 		=> true,
		"params" 						=> array(
			array(
				"type"              	=> "seperator",
				"param_name"        	=> "seperator_1",
				"seperator"         	=> "bbPress: " . __("New Topic Form", "ts_visual_composer_extend"),
			),
			array(
				"type"              	=> "messenger",
				"heading"           	=> "",
				"param_name"        	=> "messenger",
				"color"					=> "#006BB7",
				"size"					=> "14",
				"value"					=> "",
				"message"            	=> __( "This element will display the 'New Topic' form where you can choose from a drop down menu the forum that this topic is to be associated with.", "ts_visual_composer_extend" )
			),
			array(
				"type" 					=> "bbpress_forumslist",
				"allforums"				=> "true",
				"heading" 				=> __("List of Forums", "ts_visual_composer_extend"),
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