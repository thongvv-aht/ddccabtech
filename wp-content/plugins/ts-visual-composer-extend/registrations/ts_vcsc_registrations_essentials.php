<?php
	// Variables for User Roles + Capabilities
	// ---------------------------------------
	$this->TS_VCSC_Conditionals_Roles					= '';
	$this->TS_VCSC_Conditionals_Rights					= '';

	
	// Variables for Element Counts
	// ----------------------------
	$this->TS_VCSC_CountTotalElements                   = 0;
	$this->TS_VCSC_CountDeprecatedElements				= 0;
	$this->TS_VCSC_CountActiveElements                  = 0;

	
	// Editor Fallback Settings
	// ------------------------
	$this->TS_VCSC_EditorVisualSelector					= 'false';
	$this->TS_VCSC_EditorElementFilter					= 'false';
	$this->TS_VCSC_EditorContainerToggle				= 'false';
	$this->TS_VCSC_EditorShortcodesPopup				= 'false';
	
	
    // Default Lightbox Settings
	// -------------------------
    $this->TS_VCSC_Lightbox_Setting_Defaults = array(
        'thumbs'                        				=> 'bottom',
        'thumbsize'                     				=> 50,
        'animation'                     				=> 'random',
        'captions'                      				=> 'data-title',
        'closer'                        				=> 1, // true/false
        'duration'                      				=> 5000,
        'save'                          				=> 0, // true/false
        'share'                         				=> 0, // true/false        
        'loadapis'                      				=> 1, // true/false
        'social' 	                    				=> 'fb,tw,pin',
        'notouch'                       				=> 1, // true/false
        'bgclose'			            				=> 1, // true/false
        'nohashes'			            				=> 1, // true/false
        'keyboard'			            				=> 1, // 0/1
        'fullscreen'		            				=> 1, // 0/1
        'zoom'				            				=> 1, // 0/1
        'fxspeed'			            				=> 300,
        'scheme'			            				=> 'dark',
		'controls'										=> 'circle', // circle, line
        'removelight'                   				=> 0,
        'customlight'                   				=> 0,
        'customcolor'		            				=> '#ffffff',
        'backlight' 		            				=> '#ffffff',
        'usecolor' 		                				=> 0, // true/false
        'urlcolorscan'                  				=> 0, // true/false
        'background'                    				=> '',
        'repeat'                        				=> 'no-repeat',
        'overlay'                       				=> '#000000',
        'noise'                         				=> '',
        'cors'                          				=> 0, // true/false
        'tapping'                       				=> 1, // true/false
        'scrollblock'                   				=> 'js',
        'protection'                    				=> 'none',
        'historyclose'                  				=> 0, // true/false
        'customscroll'                  				=> 1, // true/false
    );

	
    // Lightbox Animation Styles
	// -------------------------
    $this->TS_VCSC_Lightbox_Animations = array(
        __( 'Random', "ts_visual_composer_extend" )       	    => "random",
        __( 'Simple Switch', "ts_visual_composer_extend" )	    => "simpleSwitch",
        __( 'Simple Fade', "ts_visual_composer_extend" )	    => "simpleFade",
        __( 'Fade & Swipe', "ts_visual_composer_extend" )	    => "fade",
        __( 'Swipe', "ts_visual_composer_extend" )        	    => "swipe",
        __( 'Scale', "ts_visual_composer_extend" )        	    => "scale",
        __( 'Slide Up', "ts_visual_composer_extend" )     	    => "slideUp",
        __( 'Slide Down', "ts_visual_composer_extend" )   	    => "slideDown",
        __( 'Flip', "ts_visual_composer_extend" )         	    => "flip",
        __( 'Skew', "ts_visual_composer_extend" )         	    => "skew",
        __( 'Bounce Up', "ts_visual_composer_extend" )    	    => "bounceUp",
        __( 'Bounce Down', "ts_visual_composer_extend" )  	    => "bounceDown",
        __( 'Break In', "ts_visual_composer_extend" )     	    => "breakIn",
        __( 'Rotate In', "ts_visual_composer_extend" )    	    => "rotateIn",
        __( 'Rotate Out', "ts_visual_composer_extend" )   	    => "rotateOut",
        __( 'Hang Left', "ts_visual_composer_extend" )    	    => "hangLeft",
        __( 'Hang Right', "ts_visual_composer_extend" )   	    => "hangRight",
        __( 'Cycle Up', "ts_visual_composer_extend" )     	    => "cicleUp",
        __( 'Cycle Down', "ts_visual_composer_extend" )   	    => "cicleDown",
        __( 'Zoom In', "ts_visual_composer_extend" )      	    => "zoomIn",
        __( 'Throw In', "ts_visual_composer_extend" )     	    => "throwIn",
        __( 'Fall', "ts_visual_composer_extend" )         	    => "fall",
        __( 'Jump', "ts_visual_composer_extend" )         	    => "jump",
    );
	
	
    // Define Arrays for CSS Animations
    $this->TS_VCSC_CSS_Animations_Array = array(
        "Bounce"                        => array("class" => "bounce",               "group" => "Attention Seekers"),
        "Flash"                         => array("class" => "flash",                "group" => "Attention Seekers"),
        "Hinge"                         => array("class" => "hinge",                "group" => "Attention Seekers"),
        "Roll In"                       => array("class" => "rollIn",               "group" => "Attention Seekers"),
        "Roll Out"                      => array("class" => "rollOut",              "group" => "Attention Seekers"),
        "Rotate Full"                   => array("class" => "rotateFull",           "group" => "Attention Seekers"),
        "Rubberband"                    => array("class" => "rubberBand",           "group" => "Attention Seekers"),
        "Shake"                         => array("class" => "shake",                "group" => "Attention Seekers"),
        "Spin"                          => array("class" => "spin",                 "group" => "Attention Seekers"),
        "Swing"                         => array("class" => "swing",                "group" => "Attention Seekers"),
        "Tada"                          => array("class" => "tada",                 "group" => "Attention Seekers"),
        "Jello"                         => array("class" => "jello",                "group" => "Attention Seekers"),
        
        "Bounce In"                     => array("class" => "bounceIn",             "group" => "Bounce Entries"),
        "Bounce In Down"                => array("class" => "bounceInDown",         "group" => "Bounce Entries"),
        "Bounce In Left"                => array("class" => "bounceInLeft",         "group" => "Bounce Entries"),
        "Bounce In Right"               => array("class" => "bounceInRight",        "group" => "Bounce Entries"),
        "Bounce In Up"                  => array("class" => "bounceInUp",           "group" => "Bounce Entries"),
        
        "Bounce Out"                    => array("class" => "bounceOut",            "group" => "Bounce Exits"),
        "Bounce Out Down"               => array("class" => "bounceOutDown",        "group" => "Bounce Exits"),
        "Bounce Out Left"               => array("class" => "bounceOutLeft",        "group" => "Bounce Exits"),
        "Bounce Out Right"              => array("class" => "bounceOutRight",       "group" => "Bounce Exits"),
        "Bounce Out Up"                 => array("class" => "bounceOutUp",          "group" => "Bounce Exits"),
        
        "Fade In"                       => array("class" => "fadeIn",               "group" => "Fade Entries"),
        "Fade In Down"                  => array("class" => "fadeInDown",           "group" => "Fade Entries"),
        "Fade In Down Big"              => array("class" => "fadeInDownBig",        "group" => "Fade Entries"),
        "Fade In Left"                  => array("class" => "fadeInLeft",           "group" => "Fade Entries"),
        "Fade In Left Big"              => array("class" => "fadeInLeftBig",        "group" => "Fade Entries"),
        "Fade In Right"                 => array("class" => "fadeInRight",          "group" => "Fade Entries"),
        "Fade In Right Big"             => array("class" => "fadeInRightBig",       "group" => "Fade Entries"),
        "Fade In Up"                    => array("class" => "fadeInUp",             "group" => "Fade Entries"),
        "Fade In Up Big"                => array("class" => "fadeInUpBig",          "group" => "Fade Entries"),
        
        "Fade Out"                      => array("class" => "fadeOut",              "group" => "Fade Exits"),
        "Fade Out Down"                 => array("class" => "fadeOutDown",          "group" => "Fade Exits"),
        "Fade Out Down Big"             => array("class" => "fadeOutDownBig",       "group" => "Fade Exits"),
        "Fade Out Left"                 => array("class" => "fadeOutLeft",          "group" => "Fade Exits"),
        "Fade Out Left Big"             => array("class" => "fadeOutLeftBig",       "group" => "Fade Exits"),
        "Fade Out Right"                => array("class" => "fadeOutRight",         "group" => "Fade Exits"),
        "Fade Out Right Big"            => array("class" => "fadeOutRightBig",      "group" => "Fade Exits"),
        "Fade Out Up"                   => array("class" => "fadeOutUp",            "group" => "Fade Exits"),
        "Fade Out Up Big"               => array("class" => "fadeOutUpBig",         "group" => "Fade Exits"),
        
        "Flip In X"                     => array("class" => "flipInX",              "group" => "Flippers"),
        "Flip In Y"                     => array("class" => "flipInY",              "group" => "Flippers"),
        "Flip Out X"                    => array("class" => "flipOutX",             "group" => "Flippers"),
        "Flip Out Y"                    => array("class" => "flipOutY",             "group" => "Flippers"),
        
        "Light Speed In"                => array("class" => "lightSpeedIn",         "group" => "Lightspeed"),
        "Light Speed Out"               => array("class" => "lightSpeedOut",        "group" => "Lightspeed"),
        
        "Pulse Normal"                  => array("class" => "pulse",                "group" => "Pulsars"),
        "Pulse Grow"                    => array("class" => "pulseGrow",            "group" => "Pulsars"),
        "Pulse Shrink"                  => array("class" => "pulseShrink",          "group" => "Pulsars"),

        "Rotate In"                     => array("class" => "rotateIn",             "group" => "Rotate Entries"),
        "Rotate In Down Left"           => array("class" => "rotateInDownLeft",     "group" => "Rotate Entries"),
        "Rotate In Down Right"          => array("class" => "rotateInDownRight",    "group" => "Rotate Entries"),
        "Rotate In Up Left"             => array("class" => "rotateInUpLeft",       "group" => "Rotate Entries"),
        "Rotate In Up Right"            => array("class" => "rotateInUpRight",      "group" => "Rotate Entries"),
        
        "Rotate Out"                    => array("class" => "rotateOut",            "group" => "Rotate Exits"),
        "Rotate Out Down Left"          => array("class" => "rotateOutDownLeft",    "group" => "Rotate Exits"),
        "Rotate Out Down Right"         => array("class" => "rotateOutDownRight",   "group" => "Rotate Exits"),
        "Rotate Out Up Left"            => array("class" => "rotateOutUpLeft",      "group" => "Rotate Exits"),
        "Rotate Out Up Right"           => array("class" => "rotateOutUpRight",     "group" => "Rotate Exits"),

        "Slide In Up"                   => array("class" => "slideInUp",            "group" => "Slide Entries"),
        "Slide In Down"                 => array("class" => "slideInDown",          "group" => "Slide Entries"),
        "Slide In Left"                 => array("class" => "slideInLeft",          "group" => "Slide Entries"),
        "Slide In Right"                => array("class" => "slideInRight",         "group" => "Slide Entries"),
        
        "Slide Out Up"                  => array("class" => "slideOutUp",           "group" => "Slide Exits"),
        "Slide Out Down"                => array("class" => "slideOutDown",         "group" => "Slide Exits"),
        "Slide Out Left"                => array("class" => "slideOutLeft",         "group" => "Slide Exits"),
        "Slide Out Right"               => array("class" => "slideOutRight",        "group" => "Slide Exits"),

        "Wobble Standard"               => array("class" => "wobble",               "group" => "Wobblers"),
        "Wobble Vertical"               => array("class" => "wobbleVertical",       "group" => "Wobblers"),
        "Wobble Horizontal"             => array("class" => "wobbleHorizontal",     "group" => "Wobblers"),
        "Wobble Top"                    => array("class" => "wobbleTop",            "group" => "Wobblers"),
        "Wobble Bottom"                 => array("class" => "wobbleBottom",         "group" => "Wobblers"),
    );
	
	
    // Default Values for Menu Positions
    // ---------------------------------
    $this->TS_VCSC_Menu_Positions_Defaults = array(
        'ts_widgets'                                    => 50,
        'ts_timeline'                                   => 51,
        'ts_team'                                       => 52,
        'ts_testimonials'                               => 53,
        'ts_skillsets'                                  => 54,
        'ts_logos'                                      => 55,
        'ts_downtime'                                   => 56, 
    );
	
    
    // Default Values for Downtime Manager
    // -----------------------------------
    $this->TS_VCSC_Downtime_Manager_Defaults = array(
        'active'                                        => 0,
        'override'                                      => 1,
        'preview'                                       => 'preview',
        'cookie'                                        => '30',
        'timer'                     	                => 'dateonly',
        'timezone'                                      => '',
        'dateonly'						                => '',
        'datetime'						                => '',
        'timerange'						                => '0,72',
        'userroles'                                     => 'administrator',
		'downstatus'									=> '503',
        'singlepage'					                => 1,
        'alldevices'					                => '',
        'desktop'						                => '',
        'tablet'						                => '',
        'mobile'						                => '',
    );
	
    
    // Default Values for Sidebars Manager
    // -----------------------------------
    $this->TS_VCSC_Sidebars_Manager_Defaults = array(
        'count'                                         => '2',
        'ids'                                           => 'ts-custom-sidebar-1,ts-custom-sidebar-2',
        'names'                                         => '',
    );
	

    // Envato Item Information
    // -----------------------
    $this->TS_VCSC_Envato_Defaults                      = array(
        'data'                                          => array(),
        'name'                                          => "N/A",
        'info'                                          => "N/A",
        'link'                                          => "N/A",
        'price'                                         => 0,
        'sales'                                         => 0,
        'rating'                                        => 0,
        'votes'                                         => 0,
        'check'                                         => time(),
        'migrate'                                       => false,
    );
    $this->TS_VCSC_Envato_Globals                       = get_option("ts_vcsc_extend_settings_envato", array());
    if (!is_array($this->TS_VCSC_Envato_Globals)) {
        $this->TS_VCSC_Envato_Globals                   = $this->TS_VCSC_Envato_Defaults;
    } else if(count($this->TS_VCSC_Envato_Globals) == 0) {
        $this->TS_VCSC_Envato_Globals                   = $this->TS_VCSC_Envato_Defaults;
    }
    

    // Check if Provided via Extended License
    // --------------------------------------
    $this->TS_VCSC_PluginExtended				        = (get_option('ts_vcsc_extend_settings_extended', 0) == 1 ? "true" : "false");
    
    
    // Check if Dashboard Panel Active
    // -------------------------------
    $this->TS_VCSC_PluginDashboard				        = (get_option('ts_vcsc_extend_settings_dashboard', 0) == 1 ? "true" : "false");
    
    
    // Check for Jetpack Plugin + Photon Extensions
    // --------------------------------------------
    if (class_exists('Jetpack') && (method_exists('Jetpack', 'is_module_active'))) {
        if (Jetpack::is_module_active('photon')) {
            $this->TS_VCSC_JetpackPhoton_Active			= "true";
        } else {
            $this->TS_VCSC_JetpackPhoton_Active			= "false";
        }
    } else {
        $this->TS_VCSC_JetpackPhoton_Active				= "false";
    }
	
	
	// Check for QuForm Plugin Version
	// -------------------------------
	if (function_exists('iphorm_get_all_forms')) {
		$this->TS_VCSC_QuFormReleaseTypeUse				= 'function';
		$this->TS_VCSC_QuFormReleaseTypeBase			= 'iphorm';
	} else if (class_exists('Quform')) {
		$this->TS_VCSC_QuFormReleaseTypeUse				= 'class';
		$this->TS_VCSC_QuFormReleaseTypeBase			= 'quform';
	} else {
		$this->TS_VCSC_QuFormReleaseTypeUse				= 'none';
		$this->TS_VCSC_QuFormReleaseTypeBase			= 'quform';
	}
	
	
	// Global Lightbox Settings
	// ------------------------
	$this->TS_VCSC_LightboxGlobalSettings				= get_option('ts_vcsc_extend_settings_defaultLightboxSettings', '');
	if (($this->TS_VCSC_LightboxGlobalSettings == false) || (empty($this->TS_VCSC_LightboxGlobalSettings)) || (!is_array($this->TS_VCSC_LightboxGlobalSettings))) {
		$this->TS_VCSC_LightboxGlobalSettings			= array();
	}
	
    
    // Always Load + Process Shortcodes
    // --------------------------------
    $this->TS_VCSC_PluginAlways                         = ((get_option('ts_vcsc_extend_settings_shortcodesalways', 0)) == 1 ? "true" : "false");
    
    
    // Downtime Mode Settings
    // ----------------------
    $this->TS_VCSC_CustomPostTypesDownpage              = ((get_option('ts_vcsc_extend_settings_allowDowntimeManager', 0)) == 1 ? "true" : "false");
    $TS_VCSC_Downtime_Manager_Custom                    = get_option('ts_vcsc_extend_settings_downTimeMode', '');
    if (!is_array($TS_VCSC_Downtime_Manager_Custom)) {
        $TS_VCSC_Downtime_Manager_Custom                = array();
    }
    $this->TS_VCSC_Downtime_Manager_Settings = array(
        'active'                                        => ((array_key_exists('active', $TS_VCSC_Downtime_Manager_Custom))          ? $TS_VCSC_Downtime_Manager_Custom['active'] :          $this->TS_VCSC_Downtime_Manager_Defaults['active']),        
        'override'                                      => ((array_key_exists('override', $TS_VCSC_Downtime_Manager_Custom))        ? $TS_VCSC_Downtime_Manager_Custom['override'] :        $this->TS_VCSC_Downtime_Manager_Defaults['override']),        
        'preview'                                       => ((array_key_exists('preview', $TS_VCSC_Downtime_Manager_Custom))         ? $TS_VCSC_Downtime_Manager_Custom['preview'] :         $this->TS_VCSC_Downtime_Manager_Defaults['preview']),
        'cookie'                                        => ((array_key_exists('cookie', $TS_VCSC_Downtime_Manager_Custom))          ? $TS_VCSC_Downtime_Manager_Custom['cookie'] :          $this->TS_VCSC_Downtime_Manager_Defaults['cookie']),
        'timer'                     	                => ((array_key_exists('timer', $TS_VCSC_Downtime_Manager_Custom))           ? $TS_VCSC_Downtime_Manager_Custom['timer'] :           $this->TS_VCSC_Downtime_Manager_Defaults['timer']),
        'timezone'                     	                => ((array_key_exists('timezone', $TS_VCSC_Downtime_Manager_Custom))        ? $TS_VCSC_Downtime_Manager_Custom['timezone'] :        $this->TS_VCSC_Downtime_Manager_Defaults['timezone']),
        'dateonly'						                => ((array_key_exists('dateonly', $TS_VCSC_Downtime_Manager_Custom))        ? $TS_VCSC_Downtime_Manager_Custom['dateonly'] :        $this->TS_VCSC_Downtime_Manager_Defaults['dateonly']),
        'datetime'						                => ((array_key_exists('datetime', $TS_VCSC_Downtime_Manager_Custom))        ? $TS_VCSC_Downtime_Manager_Custom['datetime'] :        $this->TS_VCSC_Downtime_Manager_Defaults['datetime']),
        'timerange'						                => ((array_key_exists('timerange', $TS_VCSC_Downtime_Manager_Custom))       ? $TS_VCSC_Downtime_Manager_Custom['timerange'] :       $this->TS_VCSC_Downtime_Manager_Defaults['timerange']),
        'userroles'                                     => ((array_key_exists('userroles', $TS_VCSC_Downtime_Manager_Custom))       ? $TS_VCSC_Downtime_Manager_Custom['userroles'] :       $this->TS_VCSC_Downtime_Manager_Defaults['userroles']),
        'downstatus'                                   	=> ((array_key_exists('downstatus', $TS_VCSC_Downtime_Manager_Custom))     	? $TS_VCSC_Downtime_Manager_Custom['downstatus'] :     	$this->TS_VCSC_Downtime_Manager_Defaults['downstatus']),
		'singlepage'					                => ((array_key_exists('singlepage', $TS_VCSC_Downtime_Manager_Custom))      ? $TS_VCSC_Downtime_Manager_Custom['singlepage'] :      $this->TS_VCSC_Downtime_Manager_Defaults['singlepage']),
        'alldevices'					                => ((array_key_exists('alldevices', $TS_VCSC_Downtime_Manager_Custom))      ? $TS_VCSC_Downtime_Manager_Custom['alldevices'] :      $this->TS_VCSC_Downtime_Manager_Defaults['alldevices']),		
        'desktop'						                => ((array_key_exists('desktop', $TS_VCSC_Downtime_Manager_Custom))         ? $TS_VCSC_Downtime_Manager_Custom['desktop'] :         $this->TS_VCSC_Downtime_Manager_Defaults['desktop']),		
        'tablet'						                => ((array_key_exists('tablet', $TS_VCSC_Downtime_Manager_Custom))          ? $TS_VCSC_Downtime_Manager_Custom['tablet'] :          $this->TS_VCSC_Downtime_Manager_Defaults['tablet']),		
        'mobile'						                => ((array_key_exists('mobile', $TS_VCSC_Downtime_Manager_Custom))          ? $TS_VCSC_Downtime_Manager_Custom['mobile'] :          $this->TS_VCSC_Downtime_Manager_Defaults['mobile']),
    );
    
    
    // Sidebars Manager Settings
    // -------------------------
    $this->TS_VCSC_UseSidebarsManager                   = ((get_option('ts_vcsc_extend_settings_allowSidebarsManager', 0)) == 1 ? "true" : "false");
    $TS_VCSC_Sidebars_Manager_Custom                    = get_option('ts_vcsc_extend_settings_customSidebars', array());
    if (!is_array($TS_VCSC_Sidebars_Manager_Custom)) {
        $TS_VCSC_Sidebars_Manager_Custom                = array();
    }
    $this->TS_VCSC_Sidebars_Manager_Settings = array(
        'count'						                    => ((array_key_exists('count', $TS_VCSC_Sidebars_Manager_Custom))           ? $TS_VCSC_Sidebars_Manager_Custom['count'] :           $this->TS_VCSC_Sidebars_Manager_Defaults['count']),
        'ids'						                    => ((array_key_exists('ids', $TS_VCSC_Sidebars_Manager_Custom))             ? $TS_VCSC_Sidebars_Manager_Custom['ids'] :             $this->TS_VCSC_Sidebars_Manager_Defaults['ids']),
        'names'                                         => ((array_key_exists('names', $TS_VCSC_Sidebars_Manager_Custom))           ? $TS_VCSC_Sidebars_Manager_Custom['names'] :           $this->TS_VCSC_Sidebars_Manager_Defaults['names']),
    );
    
    
    // Define Menu Position for Post Types
    // -----------------------------------
    $this->TS_VCSC_CustomPostTypesPositions		        = get_option('ts_vcsc_extend_settings_menuPositions', $this->TS_VCSC_Menu_Positions_Defaults);			
    
    
    // Check for MultiSite Activation
    // ------------------------------
    $this->TS_VCSC_PluginIsMultiSiteActive 		        = (is_plugin_active_for_network(COMPOSIUM_SLUG) == true ? "true" : "false");
    
    
    // Activation Redirection
    // ----------------------
    $this->TS_VCSC_ActivationRedirect                   = (get_option('ts_vcsc_extend_settings_redirect', 0) == 1 ? "true" : "false");
    
    
    // External API Information
    // ------------------------
    $this->TS_VCSC_InformationExternalAPIs              = get_option('ts_vcsc_extend_settings_externalAPIs', array());
    
    
    // Check and Set other Global Variables
    // ------------------------------------
    // Plugin Menu Location
    if (get_option('ts_vcsc_extend_settings_allowFullOptions', 0) == 1)         { $this->TS_VCSC_PluginFullOptions = "true"; }              else { $this->TS_VCSC_PluginFullOptions = "false"; }  
    // Check if Custom Post Type Usage Permissable (Extended Usage)
    if ($this->TS_VCSC_PluginExtended == "true") {
        if (get_option('ts_vcsc_extend_settings_posttypes', 1) == 1)            { $this->TS_VCSC_UseCustomPostTypes = "true"; }             else { $this->TS_VCSC_UseCustomPostTypes = "false"; };    
        if (get_option('ts_vcsc_extend_settings_posttypeWidget', 1) == 1)       { $this->TS_VCSC_UseCustomPostWidget = "true"; }            else { $this->TS_VCSC_UseCustomPostWidget = "false"; };
        if (get_option('ts_vcsc_extend_settings_posttypeTeam', 1) == 1)         { $this->TS_VCSC_UseCustomPostTeam = "true"; }              else { $this->TS_VCSC_UseCustomPostTeam = "false"; };
        if (get_option('ts_vcsc_extend_settings_posttypeTestimonial', 1) == 1)  { $this->TS_VCSC_UseCustomPostTestimonial = "true"; }       else { $this->TS_VCSC_UseCustomPostTestimonial = "false"; };
        if (get_option('ts_vcsc_extend_settings_posttypeLogo', 1) == 1)         { $this->TS_VCSC_UseCustomPostLogo = "true"; }              else { $this->TS_VCSC_UseCustomPostLogo = "false"; };
        if (get_option('ts_vcsc_extend_settings_posttypeSkillset', 1) == 1)     { $this->TS_VCSC_UseCustomPostSkillset = "true"; }          else { $this->TS_VCSC_UseCustomPostSkillset = "false"; };
        if (get_option('ts_vcsc_extend_settings_posttypeTimeline', 1) == 1)     { $this->TS_VCSC_UseCustomPostTimeline = "true"; }          else { $this->TS_VCSC_UseCustomPostTimeline = "false"; };
    } else {
        $this->TS_VCSC_UseCustomPostTypes               = "true";
        $this->TS_VCSC_UseCustomPostWidget              = "true";
        $this->TS_VCSC_UseCustomPostTeam                = "true";
        $this->TS_VCSC_UseCustomPostTestimonial         = "true";
        $this->TS_VCSC_UseCustomPostLogo                = "true";
        $this->TS_VCSC_UseCustomPostSkillset            = "true";
        $this->TS_VCSC_UseCustomPostTimeline            = "true";
    }
    // Check Individual Custom Post Type
    if (get_option('ts_vcsc_extend_settings_customWidgets', 0) == 1)            { $this->TS_VCSC_CustomPostTypesWidgets = "true"; }         else { $this->TS_VCSC_CustomPostTypesWidgets = "false"; };
    if (get_option('ts_vcsc_extend_settings_customTeam', 0) == 1)               { $this->TS_VCSC_CustomPostTypesTeam = "true"; }            else { $this->TS_VCSC_CustomPostTypesTeam = "false"; };
    if (get_option('ts_vcsc_extend_settings_customTestimonial', 0) == 1)        { $this->TS_VCSC_CustomPostTypesTestimonial = "true"; }     else { $this->TS_VCSC_CustomPostTypesTestimonial = "false"; };
    if (get_option('ts_vcsc_extend_settings_customLogo', 0) == 1)               { $this->TS_VCSC_CustomPostTypesLogo = "true"; }            else { $this->TS_VCSC_CustomPostTypesLogo = "false"; };
    if (get_option('ts_vcsc_extend_settings_customSkillset', 0) == 1)           { $this->TS_VCSC_CustomPostTypesSkillset = "true"; }        else { $this->TS_VCSC_CustomPostTypesSkillset = "false"; };
    if (get_option('ts_vcsc_extend_settings_customTimelines', 0) == 1)          { $this->TS_VCSC_CustomPostTypesTimeline = "true"; }        else { $this->TS_VCSC_CustomPostTypesTimeline = "false"; };
    // Check for Built-In Lightbox
    if (get_option('ts_vcsc_extend_settings_builtinLightbox', 1) == 1)	        { $this->TS_VCSC_UseInternalLightbox = "true"; } 			else { $this->TS_VCSC_UseInternalLightbox = "false"; }
	// Check if Lightbox Integration with Media Manager
    if (get_option('ts_vcsc_extend_settings_lightboxIntegration', 0) == 1)      { $this->TS_VCSC_UseLightboxAutoMedia = "true"; } 			else { $this->TS_VCSC_UseLightboxAutoMedia = "false"; }
    // Check if Lightbox should Replace PrettyPhoto
    if (get_option('ts_vcsc_extend_settings_lightboxPrettyPhoto', 0) == 1)      { $this->TS_VCSC_UseLightboxPrettyPhoto = "true"; }         else { $this->TS_VCSC_UseLightboxPrettyPhoto = "false"; }
    // Check if Lightbox should Attach to All Image Links W/O Class
    if (get_option('ts_vcsc_extend_settings_lightboxAttachAllOther', 0) == 1)	{ $this->TS_VCSC_UseLightboxAttachAllOther = "true"; }		else { $this->TS_VCSC_UseLightboxAttachAllOther = "false"; }	
	// Plugin Menu Location
    if (get_option('ts_vcsc_extend_settings_mainmenu', 1) == 1)                 { $this->TS_VCSC_PluginMainMenu = "true"; }                 else { $this->TS_VCSC_PluginMainMenu = "false"; }
	// Auto-Update Routine
    if (get_option('ts_vcsc_extend_settings_allowAutoUpdate', 1) == 1)          { $this->TS_VCSC_UseUpdateAutomatic = "true"; }             else { $this->TS_VCSC_UseUpdateAutomatic = "false"; }
    // Shortcodes in Widgets
    if (get_option('ts_vcsc_extend_settings_allowShortcodesWidgets', 1) == 1)   { $this->TS_VCSC_UseShortcodesWidgets = "true"; }           else { $this->TS_VCSC_UseShortcodesWidgets = "false"; }
    // Custom Icon  Font Upload
    if (get_option('ts_vcsc_extend_settings_tinymceCustom', 0) == 1)            { $this->TS_VCSC_UseCustomIconFontUpload = "true"; }        else { $this->TS_VCSC_UseCustomIconFontUpload = "false"; }    
    // Auto-Paragraph Routine
    if (get_option('ts_vcsc_extend_settings_allowAutoParagraphs', 1) == 1)      { $this->TS_VCSC_UseAutoParagraphs = "true"; }              else { $this->TS_VCSC_UseAutoParagraphs = "false"; }
    // Enlighter JS
    if (get_option('ts_vcsc_extend_settings_allowEnlighterJS', 0) == 1)			{ $this->TS_VCSC_UseEnlighterJS = "true"; } 				else { $this->TS_VCSC_UseEnlighterJS = "false"; }
    // Single Page Navigator Builder
    if (get_option('ts_vcsc_extend_settings_allowPageNavigator', 0) == 1)		{ $this->TS_VCSC_UsePageNavigator = "true"; } 				else { $this->TS_VCSC_UsePageNavigator = "false"; }
    // Provide Code Editors
    if (get_option('ts_vcsc_extend_settings_codeeditors', 1) == 1)				{ $this->TS_VCSC_UseCodeEditors = "true"; }					else { $this->TS_VCSC_UseCodeEditors = "false"; }
    // Check if Waypoints should be loaded
    if (get_option('ts_vcsc_extend_settings_loadWaypoints', 1) == 1) 	        { $this->TS_VCSC_LoadFrontEndWaypoints = "true"; } 			else { $this->TS_VCSC_LoadFrontEndWaypoints = "false"; }    
    // Check if NoUiSlider should be loaded
    if (get_option('ts_vcsc_extend_settings_loadNoUiSlider', 1) == 1) 	        { $this->TS_VCSC_LoadEditorNoUiSlider = "true"; } 			else { $this->TS_VCSC_LoadEditorNoUiSlider = "false"; }	
	// Google Fonts Manager
    if (get_option('ts_vcsc_extend_settings_allowGoogleManager', 1) == 1)		{ $this->TS_VCSC_UseGoogleFontManager = "true"; } 			else { $this->TS_VCSC_UseGoogleFontManager = "false"; }
    // Custom Fonts Manager
    if (get_option('ts_vcsc_extend_settings_allowCustomManager', 0) == 1)		{ $this->TS_VCSC_UseCustomFontManager = "true"; } 			else { $this->TS_VCSC_UseCustomFontManager = "false"; }
    // WordPress Editors Icon Font Generator - Usage
	if (get_option('ts_vcsc_extend_settings_useIconGenerator', 0) == 1)			{ $this->TS_VCSC_UseTinyMCEGenerator = "true"; } 			else { $this->TS_VCSC_UseTinyMCEGenerator = "false"; }
	// WordPress Editors Icon Font Generator - Post Types
	$this->TS_VCSC_UsePostTypesGenerator 										= get_option('ts_vcsc_extend_settings_usePostTypes', '');
	if (($this->TS_VCSC_UsePostTypesGenerator != "") && ($this->TS_VCSC_UsePostTypesGenerator != "null")) {
		$this->TS_VCSC_UsePostTypesGenerator 									= explode(',', $this->TS_VCSC_UsePostTypesGenerator);
	} else {
		$this->TS_VCSC_UsePostTypesGenerator									= array();
	}
	// ThemeBuilder    
    if ($this->TS_VCSC_UseEnlighterJS == "true") {
        if (get_option('ts_vcsc_extend_settings_allowThemeBuilder', 0) == 1)	{ $this->TS_VCSC_UseThemeBuilder = "true"; } 				else { $this->TS_VCSC_UseThemeBuilder = "false"; }
    } else {
        $this->TS_VCSC_UseThemeBuilder 			        = "false";
    }
    // WP Bakery Page Builder Auto Assignment
    if (get_option('ts_vcsc_extend_settings_allowAutoAssignment', 1) == 1)      { $this->TS_VCSC_UseAutoAssignmentVC = "true"; }            else { $this->TS_VCSC_UseAutoAssignmentVC = "false"; }
    // WP Bakery Page Builder Frontend Editor
    if (get_option('ts_vcsc_extend_settings_frontendEditor', 1) == 1)           { $this->TS_VCSC_UseFrontendEditorVC = "true"; }            else { $this->TS_VCSC_UseFrontendEditorVC = "false"; }
    // Check which Hammer.js should be loaded
    if (get_option('ts_vcsc_extend_settings_loadHammerNew', 1) == 1)			{ $this->TS_VCSC_LoadFrontEndHammerNew = "true"; } 			else { $this->TS_VCSC_LoadFrontEndHammerNew = "false"; }
	// Check Limits WordPress AJAX Calls
    $this->TS_VCSC_Limit_Editor_AJAX_Calls = array(
		'disableasync'															=> false,
        'composerimage'						                    				=> false,
        'wpheartbeat'						                    				=> false,
    );
    
    
    // Define Output Priority for JS Variables
    // ---------------------------------------
    $this->TS_VCSC_Extensions_VariablesPriority         = get_option('ts_vcsc_extend_settings_variablesPriority', '6');

	
    // License Check Variables
    // -----------------------
    $this->TS_VCSC_External_URL                         = "http://maintenance.krautcoding.com/licenses/ts-envato-api-check-vc-extensions.php?license=";
    $this->TS_VCSC_API_Token                            = "ecrfCDjNSGTFOKIkpJBpNXBlhoddLAst";
    $this->TS_VCSC_API_ItemID                           = "7190695";    
    $this->TS_VCSC_Avoid_Duplications = array (
        'OGE0NTkyN2YtNjg4NC00OTZiLTkxMjMtMGMzNmI0NWI3YmMw',
        'Y2Q1MmU4ZmEtZTI3Ny00ZmIwLThiY2YtM2FlY2ZjZGUxOGYy',
        'ZWQzMjAyOGItNzEzYy00YTJmLWI4YTItOWJlYzljMGY1ZWJl',
        'MzJiYzNmYWItZWI0Ny00YjRhLWI4YTItODc2NGU2YjJiNzUz',
        'Yzk2N2Y2MTMtNmIxOC00ODRjLTg4ZWMtODkyOWU2ZjUyY2E0',
        'NzI5NmVlM2MtOWM0OS00OWE5LWFmOGItNDM3OTA1NThhYzIy',
        'NWNjMTM0YWYtNmM2Ni00YjU1LTkzYjUtOGQyODRiMjc2MGU1',
        'Zjk5MjdhYTAtOGUxYS00MDQ0LTgwN2YtZjA3NmRjNDlmZjdl',
        'YjBlMjZkMDctMWZiNi00ZGI2LWEzZmYtMmNjNDg2OGU5ODUz',
        'YmEwYmJhZWEtYjNiYS00YjQ3LWFiYzQtYjk1NDNkMGIxNTAx',
        'OTI1M2ZkZGItNTM1ZC00YmEyLTliMTktMmZhNDI2YmQyY2Yz',
        'N2Y1MzZlMGEtNTY4NS00YzQ1LTg4MTMtMTVjYmMyMDQxZWZj',
        'YzViNTk3NTQtMmE3ZS00MDA5LTlhZjMtMjNjODk1OTM3NGUy',
        'MzFhYzJjNzAtZmVhMS00N2ZiLWEzODAtZjEzYjcwMDQ5ODFh',
        'NWQyODBmMTAtNGI5MC00ZWViLWJhYjYtZmM3ZmUwOWEzMzk4',
        'OWMxOGJjNDgtNWY1Mi00ZTJiLTllYmMtMjQyYjNmM2NmNmE2',
        'MThhNDI5ZGEtOTliYi00OTI4LWI3ZDMtZTAwZDMwZmQzNzQ1',
        'ZWVlZmEwOWEtZTJhYy00YTczLTk1N2MtZjViYTA3N2E3ZmQ1',
        'YmI0MWI5MzEtZmU1Yy00ZmVlLWE4ODUtNjQyN2RhMzlmMTc5',
		'ZjQwNGZmMzEtMTM0OS00ZjZmLWFmZDktMjI5MGY5NmRlZTFk',
		'YTY1MjgxYWQtYmM2My00YTM1LThhOTItMjgwM2YyZGQ2ODk2',
		'YTkzNTNjN2EtYWFjNy00NWZmLWFjOWMtOWNkOGY3Y2RhMjUz',
		'ZjNmNzI4OTUtYTYyYy00NmJlLWE2Y2QtOTZjNjBjNjUzY2U2',
		'NzViOTBhMmUtODI0MC00NWRjLTk1MTgtZWFhODlmNDlmZGU2',
		'ZmYzMzE0OGMtZTQ2NS00ODkzLWEwZDYtYmFkYjAzYTgwNzhh',
		'NTY0ZWYzMjItOTU3NC00Y2RkLWJjMTMtNGFmYWJmYzA0NGVi',
		'MGE2MzRjZDItODI4MS00YWVjLTg0MDMtOThjODIxZDdlNzUz',
		'MGUxOTgyM2MtM2RiNC00NTYwLTk1ZGQtZmYwMThkNmU2MzE0',
		'YWU2ZTc1NjAtZjY3Yi00MWRlLTg4MTctNzUyNWJkOTQ0MDUy',
		'YTZkZTg5YTQtZWM5ZC00ZjkxLTk1MTgtNDRjMmE3NTM3Yjlh',
    );
    
    
    // Get Listing of Active Plugins
    // -----------------------------
    $this->TS_VCSC_WordPressActivePlugins               = get_option('active_plugins');
	
	
	// Registered Custom Fonts
	// -----------------------
	if ($this->TS_VCSC_UseCustomFontManager == "true") {
		$this->TS_VCSC_RegisteredCustomFonts			= get_option('ts_vcsc_extend_settings_fontCustoms', '');
		$this->TS_VCSC_RegisteredCustomFonts 			= base64_decode($this->TS_VCSC_RegisteredCustomFonts);
		$this->TS_VCSC_RegisteredCustomFonts 			= json_decode($this->TS_VCSC_RegisteredCustomFonts);
		if (($this->TS_VCSC_RegisteredCustomFonts == false) || (empty($this->TS_VCSC_RegisteredCustomFonts)) || ($this->TS_VCSC_RegisteredCustomFonts == "") || (!is_array($this->TS_VCSC_RegisteredCustomFonts))) {
			$this->TS_VCSC_RegisteredCustomFonts		= array();
		}
	} else {
		$this->TS_VCSC_RegisteredCustomFonts			= array();
	}
    
    
    // Status of WooCommerce Elements
    // ------------------------------
    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', $this->TS_VCSC_WordPressActivePlugins))) {
        $this->TS_VCSC_WooCommerceVersion 			    = ""; //$this->TS_VCSC_WooCommerceVersion();
        $this->TS_VCSC_WooCommerceActive 			    = "true";				
    } else {
        $this->TS_VCSC_WooCommerceVersion 			    = "";
        $this->TS_VCSC_WooCommerceActive 			    = "false";
    }
    
    
    // Status of bbPress Elements
    // --------------------------
    if (in_array('bbpress/bbpress.php', apply_filters('active_plugins', $this->TS_VCSC_WordPressActivePlugins))) {
        $this->TS_VCSC_bbPressVersion 			        = "";
        $this->TS_VCSC_bbPressActive 			        = "true";
    } else {
        $this->TS_VCSC_bbPressVersion 			        = "";
        $this->TS_VCSC_bbPressActive 			        = "false";
    }
    
    
    // Other Routine Checks
    // --------------------
    if ($this->TS_VCSC_PluginIsMultiSiteActive == "true") {
        $this->TS_VCSC_PluginKeystring                  = get_site_option('ts_vcsc_extend_settings_license', '');
        $this->TS_VCSC_PluginLicense			        = get_site_option('ts_vcsc_extend_settings_licenseKeyed', 'emptydelimiterfix');
        $this->TS_VCSC_PluginValid				        = (get_site_option('ts_vcsc_extend_settings_licenseValid', 0) == 1 ? "true" : "false");
        $this->TS_VCSC_PluginEnvato				        = get_site_option('ts_vcsc_extend_settings_licenseInfo', '');
    } else {
        $this->TS_VCSC_PluginKeystring                  = get_option('ts_vcsc_extend_settings_license', '');
        $this->TS_VCSC_PluginLicense			        = get_option('ts_vcsc_extend_settings_licenseKeyed', 'emptydelimiterfix');
        $this->TS_VCSC_PluginValid				        = (get_option('ts_vcsc_extend_settings_licenseValid', 0) == 1 ? "true" : "false");
        $this->TS_VCSC_PluginEnvato				        = get_option('ts_vcsc_extend_settings_licenseInfo', '');
    }
    if (($this->TS_VCSC_PluginLicense != '') && ($this->TS_VCSC_PluginLicense != 'emptydelimiterfix') && (in_array(base64_encode($this->TS_VCSC_PluginLicense), $this->TS_VCSC_Avoid_Duplications))) {
        $this->TS_VCSC_PluginUsage				        = "false";
    } else {
        $this->TS_VCSC_PluginUsage				        = "true";
    }
    if ($this->TS_VCSC_PluginUsage == "false") {
        if ($this->TS_VCSC_PluginIsMultiSiteActive == "true") {
            update_site_option('ts_vcsc_extend_settings_licenseInfo', '');
            update_site_option('ts_vcsc_extend_settings_licenseKeyed', 'emptydelimiterfix');
            update_site_option('ts_vcsc_extend_settings_licenseValid', 0);
        } else {
            update_option('ts_vcsc_extend_settings_licenseInfo', '');
            update_option('ts_vcsc_extend_settings_licenseKeyed', 'emptydelimiterfix');
            update_option('ts_vcsc_extend_settings_licenseValid', 0);
        }
    }
    if (($this->TS_VCSC_PluginKeystring != '') && (in_array(base64_encode($this->TS_VCSC_PluginKeystring), $this->TS_VCSC_Avoid_Duplications))) {
        $this->TS_VCSC_PluginSupport                    = "false";
    } else {
        $this->TS_VCSC_PluginSupport                    = "true";
    }
    
    
    // Check for Standalone Iconicum Plugin
    // ------------------------------------
    if ((in_array('ts-iconicum-icon-fonts/ts-iconicum-icon-fonts.php', apply_filters('active_plugins', get_option('active_plugins')))) || (class_exists('ICONICUM_ICON_FONTS'))) {
        $this->TS_VCSC_IconicumStandard			        = "true";
    } else {
        $this->TS_VCSC_IconicumStandard			        = "false";
    }
    // Submenu Generator
    if ($this->TS_VCSC_PluginIsMultiSiteActive == "true") {
        if (((($this->TS_VCSC_PluginExtended == "true") && (get_option('ts_vcsc_extend_settings_iconicum', 1) == 1) && (get_option('ts_vcsc_extend_settings_useMenuGenerator', 0) == 1)) || (($this->TS_VCSC_PluginExtended == "false") && (get_option('ts_vcsc_extend_settings_useMenuGenerator', 0) == 1))) && ($this->TS_VCSC_PluginUsage == 'true')) {
            $this->TS_VCSC_IconicumMenuGenerator 	    = "true";
        } else {
            $this->TS_VCSC_IconicumMenuGenerator 	    = "false";
        }
    } else {
        if (((($this->TS_VCSC_PluginExtended == "true") && (get_option('ts_vcsc_extend_settings_iconicum', 1) == 1) && (get_option('ts_vcsc_extend_settings_useMenuGenerator', 0) == 1)) || (($this->TS_VCSC_PluginExtended == "false") && (get_option('ts_vcsc_extend_settings_useMenuGenerator', 0) == 1))) && ($this->TS_VCSC_PluginUsage == 'true')) {
            $this->TS_VCSC_IconicumMenuGenerator 	    = "true";
        } else {
            $this->TS_VCSC_IconicumMenuGenerator 	    = "false";
        }
    }
    // tinyMCE Editor Generator
    if ($this->TS_VCSC_PluginIsMultiSiteActive == "true") {
        if (((($this->TS_VCSC_PluginExtended == "true") && (get_option('ts_vcsc_extend_settings_iconicum', 1) == 1) && (get_option('ts_vcsc_extend_settings_useIconGenerator', 0) == 1)) || (($this->TS_VCSC_PluginExtended == "false") && (get_option('ts_vcsc_extend_settings_useIconGenerator', 0) == 1))) && ($this->TS_VCSC_PluginUsage == 'true')) {
            $this->TS_VCSC_IconicumActivated 		    = "true";
        } else {
            $this->TS_VCSC_IconicumActivated 		    = "false";
        }
    } else {
        if (((($this->TS_VCSC_PluginExtended == "true") && (get_option('ts_vcsc_extend_settings_iconicum', 1) == 1) && (get_option('ts_vcsc_extend_settings_useIconGenerator', 0) == 1)) || (($this->TS_VCSC_PluginExtended == "false") && (get_option('ts_vcsc_extend_settings_useIconGenerator', 0) == 1))) && ($this->TS_VCSC_PluginUsage == 'true')) {
            $this->TS_VCSC_IconicumActivated 		    = "true";
        } else {
            $this->TS_VCSC_IconicumActivated 		    = "false";
        }
    }
	
    // Remove Unneeded Variables
    // -------------------------
    unset($this->TS_VCSC_WordPressActivePlugins);
?>