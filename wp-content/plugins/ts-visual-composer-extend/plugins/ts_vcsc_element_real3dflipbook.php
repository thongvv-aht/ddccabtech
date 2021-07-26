<?php
    global $VISUAL_COMPOSER_EXTENSIONS;

	$real3dflipbooks 				= get_option('flipbooks', array());
	$TS_VCSC_Real3DFlipBooks 		= array ();
	foreach ($real3dflipbooks as $flipbook) {
		if ((isset($flipbook["id"])) && (isset($flipbook["name"]))) {
			$TS_VCSC_Real3DFlipBooks[$flipbook["name"]]	= $flipbook["id"];
		}
	};
	if (count($TS_VCSC_Real3DFlipBooks) == 0) {
		$TS_VCSC_Real3DFlipBooks[__("No Real 3D Flipbooks found!", "ts_visual_composer_extend")]	= '-1';
	}
	
	$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
		"name"                      => __( "Real 3D FlipBook", "ts_visual_composer_extend" ),
		"base"                      => "real3dflipbook",
		"icon" 	                    => "ts-composer-element-icon-real3dflipbook",
		"category"                  => ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorElementFilter == "true" ? __( "Composium", "ts_visual_composer_extend" ) : __( '3rd Party Plugins', "ts_visual_composer_extend" )),
		"description"               => __("Place a Real 3D Flipbook element", "ts_visual_composer_extend"),
		"admin_enqueue_js"			=> "",
		"admin_enqueue_css"			=> "",
		"params"                    => array(
			// Real 3D FlipBook Settings
			array(
				"type"              => "seperator",
				"param_name"        => "seperator_1",
				"seperator"			=> "Real 3D FlipBook",
			),
			array(
				"type"              => "dropdown",
				"heading"           => __( "Real 3D FlipBook", "ts_visual_composer_extend" ),
				"param_name"        => "id",
				"width"             => 300,
				"value"             => $TS_VCSC_Real3DFlipBooks,
				"admin_label"       => true,
				"save_always" 		=> true,
				"description"       => __( "Select the Real 3D FlipBook you want to use.", "ts_visual_composer_extend" ),
			),
			array(
				"type"              => "messenger",
				"param_name"        => "messenger",
				"color"				=> "#FF0000",
				"message"           => __( "Please make sure that the Real 3D FlipBook Plugin is installed and activated.", "ts_visual_composer_extend" )
			),
		)
	);

	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
		return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
	} else {			
		vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
	};
?>