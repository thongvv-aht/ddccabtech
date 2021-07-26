<?php
	if (!class_exists('TS_Google_Maps_Plus')){
		class TS_Google_Maps_Plus {
			private $TS_VCSC_Google_MapPLUS_Language;
			
			function __construct() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						$this->TS_VCSC_Add_GoogleMapsPlus_Elements_Lean();
					} else if (function_exists('vc_map')) {
						add_action('init',									array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Container'), 9999999);
						add_action('init',									array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Marker'), 9999999);
						add_action('init',									array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Overlay'), 9999999);
						add_action('init',									array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Curveline'), 9999999);
						add_action('init',									array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Single'), 9999999);
					}
				} else {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_GoogleMapsPlus_Elements_Lean'), 9999999);
					} else if (function_exists('vc_map')) {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Container'), 9999999);
						add_action('admin_init',							array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Marker'), 9999999);
						add_action('admin_init',							array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Overlay'), 9999999);
						add_action('admin_init',							array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Curveline'), 9999999);
						add_action('admin_init',							array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Single'), 9999999);
					}
				}
				if ((is_admin() == false) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAJAX == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAlways == "true")) {
					add_shortcode('TS_VCSC_GoogleMapsPlus_Marker',			array($this, 'TS_VCSC_GoogleMapsPlus_Marker'));
					add_shortcode('TS_VCSC_GoogleMapsPlus_Overlay',			array($this, 'TS_VCSC_GoogleMapsPlus_Overlay'));
					add_shortcode('TS_VCSC_GoogleMapsPlus_Curveline',		array($this, 'TS_VCSC_GoogleMapsPlus_Curveline'));
					add_shortcode('TS_VCSC_GoogleMapsPlus_Container',		array($this, 'TS_VCSC_GoogleMapsPlus_Container'));
					add_shortcode('TS_VCSC_GoogleMapsPlus_Single',			array($this, 'TS_VCSC_GoogleMapsPlus_Single'));
				}
				// Retrieve Google Maps Default Language Strings
				$this->TS_VCSC_Google_MapPLUS_Language						= get_option('ts_vcsc_extend_settings_translationsGoogleMapPLUS',	$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults);
			}
			
			// Register Element(s) via LeanMap
			function TS_VCSC_Add_GoogleMapsPlus_Elements_Lean() {
				vc_lean_map('TS_VCSC_GoogleMapsPlus_Container', 			array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Container'), null);
				vc_lean_map('TS_VCSC_GoogleMapsPlus_Marker', 				array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Marker'), null);
				vc_lean_map('TS_VCSC_GoogleMapsPlus_Overlay', 				array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Overlay'), null);
				vc_lean_map('TS_VCSC_GoogleMapsPlus_Curveline', 			array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Curveline'), null);
				vc_lean_map('TS_VCSC_GoogleMapsPlus_Single', 				array($this, 'TS_VCSC_Add_GoogleMapsPlus_Element_Single'), null);
			}
			
			// Marker Conversion Callback
			function TS_VCSC_GoogleMapsPlus_Image($marker) {
				if (substr($marker, -4) == ".png") {
					return $marker;
				} else {
					return str_replace("ts-mapmarker-", "", $marker) . ".png";
				}				
			}
			
			// Register + Load API with Custom Language + Region
			function TS_VCSC_GoogleMapsPlus_LoadAPI($language, $region) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Unregister Already Registered API
				wp_deregister_script('ts-extend-mapapi-library');
				// Register New API
				if (isset($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_InformationExternalAPIs['GoogleMaps'])) {
					wp_register_script('ts-extend-mapapi-library',			'https://maps.google.com/maps/api/js?key=' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_InformationExternalAPIs['GoogleMaps'] . '&language=' . $language . '&region=' . $region . '&libraries=places,geometry', false, false, false);
				} else {
					wp_register_script('ts-extend-mapapi-library',			'https://maps.google.com/maps/api/js?libraries=places,geometry', false, false, false);
				}
				// Load New API
				wp_enqueue_script('ts-extend-mapapi-library');
			}			
			
			// Element Callback for Localization Settings
			function TS_VCSC_GoogleMapsPlus_Localizations($setting) {
				if ($setting == "language") {
					return array(
						"af"			=> __( "Afrikaans", "ts_visual_composer_extend" ),
						"sq"			=> __( "Albanian", "ts_visual_composer_extend" ),
						"am"			=> __( "Amharic", "ts_visual_composer_extend" ),
						"ar"			=> __( "Arabic", "ts_visual_composer_extend" ),
						"ar"			=> __( "Armenian", "ts_visual_composer_extend" ),
						"az"			=> __( "Azerbaijani", "ts_visual_composer_extend" ),
						"eu"			=> __( "Basque", "ts_visual_composer_extend" ),
						"be"			=> __( "Belarusian", "ts_visual_composer_extend" ),
						"bn"			=> __( "Bengali", "ts_visual_composer_extend" ),
						"bs"			=> __( "Bosnian", "ts_visual_composer_extend" ),
						"bg"			=> __( "Bulgarian", "ts_visual_composer_extend" ),
						"my"			=> __( "Burmese", "ts_visual_composer_extend" ),
						"ca"			=> __( "Catalan", "ts_visual_composer_extend" ),
						"zh"			=> __( "Chinese", "ts_visual_composer_extend" ),
						"zh-cn"			=> __( "Chinese (Simplified)", "ts_visual_composer_extend" ),
						"zh-hk"			=> __( "Chinese (Hong Kong)", "ts_visual_composer_extend" ),
						"zh-tw"			=> __( "Chinese (Traditional)", "ts_visual_composer_extend" ),
						"hr"			=> __( "Croatian", "ts_visual_composer_extend" ),
						"cs"			=> __( "Czech", "ts_visual_composer_extend" ),
						"da"			=> __( "Danish", "ts_visual_composer_extend" ),
						"nl"			=> __( "Dutch", "ts_visual_composer_extend" ),
						"en"			=> __( "English", "ts_visual_composer_extend" ),
						"en-au"			=> __( "English (Australian)", "ts_visual_composer_extend" ),
						"en-gb"			=> __( "English (Great Britain)", "ts_visual_composer_extend" ),
						"et"			=> __( "Estonian", "ts_visual_composer_extend" ),
						"fa"			=> __( "Farsi", "ts_visual_composer_extend" ),
						"fi"			=> __( "Finnish", "ts_visual_composer_extend" ),
						"fil"			=> __( "Filipino", "ts_visual_composer_extend" ),
						"fr"			=> __( "French", "ts_visual_composer_extend" ),
						"fr-ca"			=> __( "French (Canada)", "ts_visual_composer_extend" ),
						"gl"			=> __( "Galician", "ts_visual_composer_extend" ),
						"ka"			=> __( "Georgian", "ts_visual_composer_extend" ),
						"de"			=> __( "German", "ts_visual_composer_extend" ),
						"el"			=> __( "Greek", "ts_visual_composer_extend" ),
						"gu"			=> __( "Gujarati", "ts_visual_composer_extend" ),
						"iw"			=> __( "Hebrew", "ts_visual_composer_extend" ),
						"hi"			=> __( "Hindi", "ts_visual_composer_extend" ),
						"hu"			=> __( "Hungarian", "ts_visual_composer_extend" ),
						"is"			=> __( "Icelandic", "ts_visual_composer_extend" ),
						"id"			=> __( "Indonesian", "ts_visual_composer_extend" ),
						"it"			=> __( "Italian", "ts_visual_composer_extend" ),
						"ja"			=> __( "Japanese", "ts_visual_composer_extend" ),
						"kn"			=> __( "Kannada", "ts_visual_composer_extend" ),
						"kk"			=> __( "Kazakh", "ts_visual_composer_extend" ),
						"km"			=> __( "Khmer", "ts_visual_composer_extend" ),
						"ko"			=> __( "Korean", "ts_visual_composer_extend" ),
						"ky"			=> __( "Kyrgyz", "ts_visual_composer_extend" ),
						"lo"			=> __( "Lao", "ts_visual_composer_extend" ),
						"lv"			=> __( "Latvian", "ts_visual_composer_extend" ),
						"lt"			=> __( "Lithuanian", "ts_visual_composer_extend" ),
						"mk"			=> __( "Macedonian", "ts_visual_composer_extend" ),
						"ms"			=> __( "Malay", "ts_visual_composer_extend" ),
						"ml"			=> __( "Malayalam", "ts_visual_composer_extend" ),
						"mr"			=> __( "Marathi", "ts_visual_composer_extend" ),
						"mn"			=> __( "Mongolian", "ts_visual_composer_extend" ),
						"ne"			=> __( "Nepali", "ts_visual_composer_extend" ),
						"no"			=> __( "Norwegian", "ts_visual_composer_extend" ),
						"pl"			=> __( "Polish", "ts_visual_composer_extend" ),
						"pt"			=> __( "Portuguese", "ts_visual_composer_extend" ),
						"pt-br"			=> __( "Portuguese (Brazil)", "ts_visual_composer_extend" ),
						"pt-pt"			=> __( "Portuguese (Portugal)", "ts_visual_composer_extend" ),
						"pa"			=> __( "Punjabi", "ts_visual_composer_extend" ),
						"ro"			=> __( "Romanian", "ts_visual_composer_extend" ),
						"ru"			=> __( "Russian", "ts_visual_composer_extend" ),
						"sr"			=> __( "Serbian", "ts_visual_composer_extend" ),
						"si"			=> __( "Sinhalese", "ts_visual_composer_extend" ),
						"sk"			=> __( "Slovak", "ts_visual_composer_extend" ),
						"sl"			=> __( "Slovenian", "ts_visual_composer_extend" ),
						"es"			=> __( "Spanish", "ts_visual_composer_extend" ),
						"es-419"		=> __( "Spanish (Latin America)", "ts_visual_composer_extend" ),
						"sw"			=> __( "Swahili", "ts_visual_composer_extend" ),
						"sv"			=> __( "Swedish", "ts_visual_composer_extend" ),
						"ta"			=> __( "Tamil", "ts_visual_composer_extend" ),
						"te"			=> __( "Telugu", "ts_visual_composer_extend" ),
						"th"			=> __( "Thai", "ts_visual_composer_extend" ),
						"tr"			=> __( "Turkish", "ts_visual_composer_extend" ),
						"uk"			=> __( "Ukrainian", "ts_visual_composer_extend" ),
						"ur"			=> __( "Urdu", "ts_visual_composer_extend" ),
						"uz"			=> __( "Uzbek", "ts_visual_composer_extend" ),
						"vi"			=> __( "Vietnamese", "ts_visual_composer_extend" ),
						"zu"			=> __( "Zulu", "ts_visual_composer_extend" ),
					);
				} else if ($setting == "region") {
					return array (
						"AF" 			=> __( "Afghanistan", "ts_visual_composer_extend" ),
						"AX" 			=> __( "Ã…land Islands", "ts_visual_composer_extend" ),
						"AL" 			=> __( "Albania", "ts_visual_composer_extend" ),
						"DZ" 			=> __( "Algeria", "ts_visual_composer_extend" ),
						"AS" 			=> __( "American Samoa", "ts_visual_composer_extend" ),
						"AD" 			=> __( "Andorra", "ts_visual_composer_extend" ),
						"AO" 			=> __( "Angola", "ts_visual_composer_extend" ),
						"AI" 			=> __( "Anguilla", "ts_visual_composer_extend" ),
						"AQ" 			=> __( "Antarctica", "ts_visual_composer_extend" ),
						"AG" 			=> __( "Antigua and Barbuda", "ts_visual_composer_extend" ),
						"AR" 			=> __( "Argentina", "ts_visual_composer_extend" ),
						"AM" 			=> __( "Armenia", "ts_visual_composer_extend" ),
						"AW" 			=> __( "Aruba", "ts_visual_composer_extend" ),
						"AU" 			=> __( "Australia", "ts_visual_composer_extend" ),
						"AT" 			=> __( "Austria", "ts_visual_composer_extend" ),
						"AZ" 			=> __( "Azerbaijan", "ts_visual_composer_extend" ),
						"BS" 			=> __( "Bahamas", "ts_visual_composer_extend" ),
						"BH" 			=> __( "Bahrain", "ts_visual_composer_extend" ),
						"BD" 			=> __( "Bangladesh", "ts_visual_composer_extend" ),
						"BB" 			=> __( "Barbados", "ts_visual_composer_extend" ),
						"BY" 			=> __( "Belarus", "ts_visual_composer_extend" ),
						"BE" 			=> __( "Belgium", "ts_visual_composer_extend" ),
						"BZ" 			=> __( "Belize", "ts_visual_composer_extend" ),
						"BJ" 			=> __( "Benin", "ts_visual_composer_extend" ),
						"BM" 			=> __( "Bermuda", "ts_visual_composer_extend" ),
						"BT" 			=> __( "Bhutan", "ts_visual_composer_extend" ),
						"BO" 			=> __( "Bolivia, Plurinational State of", "ts_visual_composer_extend" ),
						"BQ" 			=> __( "Bonaire, Sint Eustatius and Saba", "ts_visual_composer_extend" ),
						"BA" 			=> __( "Bosnia and Herzegovina", "ts_visual_composer_extend" ),
						"BW" 			=> __( "Botswana", "ts_visual_composer_extend" ),
						"BV" 			=> __( "Bouvet Island", "ts_visual_composer_extend" ),
						"BR" 			=> __( "Brazil", "ts_visual_composer_extend" ),
						"IO" 			=> __( "British Indian Ocean Territory", "ts_visual_composer_extend" ),
						"BN" 			=> __( "Brunei Darussalam", "ts_visual_composer_extend" ),
						"BG" 			=> __( "Bulgaria", "ts_visual_composer_extend" ),
						"BF" 			=> __( "Burkina Faso", "ts_visual_composer_extend" ),
						"BI" 			=> __( "Burundi", "ts_visual_composer_extend" ),
						"KH" 			=> __( "Cambodia", "ts_visual_composer_extend" ),
						"CM" 			=> __( "Cameroon", "ts_visual_composer_extend" ),
						"CA" 			=> __( "Canada", "ts_visual_composer_extend" ),
						"CV" 			=> __( "Cape Verde", "ts_visual_composer_extend" ),
						"KY" 			=> __( "Cayman Islands", "ts_visual_composer_extend" ),
						"CF" 			=> __( "Central African Republic", "ts_visual_composer_extend" ),
						"TD" 			=> __( "Chad", "ts_visual_composer_extend" ),
						"CL" 			=> __( "Chile", "ts_visual_composer_extend" ),
						"CN" 			=> __( "China", "ts_visual_composer_extend" ),
						"CX" 			=> __( "Christmas Island", "ts_visual_composer_extend" ),
						"CC" 			=> __( "Cocos (Keeling) Islands", "ts_visual_composer_extend" ),
						"CO" 			=> __( "Colombia", "ts_visual_composer_extend" ),
						"KM" 			=> __( "Comoros", "ts_visual_composer_extend" ),
						"CG" 			=> __( "Congo", "ts_visual_composer_extend" ),
						"CD" 			=> __( "Congo, the Democratic Republic of the", "ts_visual_composer_extend" ),
						"CK" 			=> __( "Cook Islands", "ts_visual_composer_extend" ),
						"CR" 			=> __( "Costa Rica", "ts_visual_composer_extend" ),
						"CI" 			=> __( "CÃ´te d'Ivoire", "ts_visual_composer_extend" ),
						"HR" 			=> __( "Croatia", "ts_visual_composer_extend" ),
						"CU" 			=> __( "Cuba", "ts_visual_composer_extend" ),
						"CW" 			=> __( "CuraÃ§ao", "ts_visual_composer_extend" ),
						"CY" 			=> __( "Cyprus", "ts_visual_composer_extend" ),
						"CZ" 			=> __( "Czech Republic", "ts_visual_composer_extend" ),
						"DK" 			=> __( "Denmark", "ts_visual_composer_extend" ),
						"DJ" 			=> __( "Djibouti", "ts_visual_composer_extend" ),
						"DM" 			=> __( "Dominica", "ts_visual_composer_extend" ),
						"DO" 			=> __( "Dominican Republic", "ts_visual_composer_extend" ),
						"EC" 			=> __( "Ecuador", "ts_visual_composer_extend" ),
						"EG" 			=> __( "Egypt", "ts_visual_composer_extend" ),
						"SV" 			=> __( "El Salvador", "ts_visual_composer_extend" ),
						"GQ" 			=> __( "Equatorial Guinea", "ts_visual_composer_extend" ),
						"ER" 			=> __( "Eritrea", "ts_visual_composer_extend" ),
						"EE" 			=> __( "Estonia", "ts_visual_composer_extend" ),
						"ET" 			=> __( "Ethiopia", "ts_visual_composer_extend" ),
						"FK" 			=> __( "Falkland Islands (Malvinas)", "ts_visual_composer_extend" ),
						"FO" 			=> __( "Faroe Islands", "ts_visual_composer_extend" ),
						"FJ" 			=> __( "Fiji", "ts_visual_composer_extend" ),
						"FI" 			=> __( "Finland", "ts_visual_composer_extend" ),
						"FR" 			=> __( "France", "ts_visual_composer_extend" ),
						"GF" 			=> __( "French Guiana", "ts_visual_composer_extend" ),
						"PF" 			=> __( "French Polynesia", "ts_visual_composer_extend" ),
						"TF" 			=> __( "French Southern Territories", "ts_visual_composer_extend" ),
						"GA" 			=> __( "Gabon", "ts_visual_composer_extend" ),
						"GM" 			=> __( "Gambia", "ts_visual_composer_extend" ),
						"GE" 			=> __( "Georgia", "ts_visual_composer_extend" ),
						"DE" 			=> __( "Germany", "ts_visual_composer_extend" ),
						"GH" 			=> __( "Ghana", "ts_visual_composer_extend" ),
						"GI" 			=> __( "Gibraltar", "ts_visual_composer_extend" ),
						"GR" 			=> __( "Greece", "ts_visual_composer_extend" ),
						"GL" 			=> __( "Greenland", "ts_visual_composer_extend" ),
						"GD" 			=> __( "Grenada", "ts_visual_composer_extend" ),
						"GP" 			=> __( "Guadeloupe", "ts_visual_composer_extend" ),
						"GU" 			=> __( "Guam", "ts_visual_composer_extend" ),
						"GT" 			=> __( "Guatemala", "ts_visual_composer_extend" ),
						"GG" 			=> __( "Guernsey", "ts_visual_composer_extend" ),
						"GN" 			=> __( "Guinea", "ts_visual_composer_extend" ),
						"GW" 			=> __( "Guinea-Bissau", "ts_visual_composer_extend" ),
						"GY" 			=> __( "Guyana", "ts_visual_composer_extend" ),
						"HT" 			=> __( "Haiti", "ts_visual_composer_extend" ),
						"HM" 			=> __( "Heard Island and McDonald Mcdonald Islands", "ts_visual_composer_extend" ),
						"VA" 			=> __( "Holy See (Vatican City State)", "ts_visual_composer_extend" ),
						"HN" 			=> __( "Honduras", "ts_visual_composer_extend" ),
						"HK" 			=> __( "Hong Kong", "ts_visual_composer_extend" ),
						"HU" 			=> __( "Hungary", "ts_visual_composer_extend" ),
						"IS" 			=> __( "Iceland", "ts_visual_composer_extend" ),
						"IN" 			=> __( "India", "ts_visual_composer_extend" ),
						"ID" 			=> __( "Indonesia", "ts_visual_composer_extend" ),
						"IR" 			=> __( "Iran, Islamic Republic of", "ts_visual_composer_extend" ),
						"IQ" 			=> __( "Iraq", "ts_visual_composer_extend" ),
						"IE" 			=> __( "Ireland", "ts_visual_composer_extend" ),
						"IM" 			=> __( "Isle of Man", "ts_visual_composer_extend" ),
						"IL" 			=> __( "Israel", "ts_visual_composer_extend" ),
						"IT" 			=> __( "Italy", "ts_visual_composer_extend" ),
						"JM" 			=> __( "Jamaica", "ts_visual_composer_extend" ),
						"JP" 			=> __( "Japan", "ts_visual_composer_extend" ),
						"JE" 			=> __( "Jersey", "ts_visual_composer_extend" ),
						"JO" 			=> __( "Jordan", "ts_visual_composer_extend" ),
						"KZ" 			=> __( "Kazakhstan", "ts_visual_composer_extend" ),
						"KE" 			=> __( "Kenya", "ts_visual_composer_extend" ),
						"KI" 			=> __( "Kiribati", "ts_visual_composer_extend" ),
						"KP" 			=> __( "Korea, Democratic People's Republic of", "ts_visual_composer_extend" ),
						"KR" 			=> __( "Korea, Republic of", "ts_visual_composer_extend" ),
						"KW" 			=> __( "Kuwait", "ts_visual_composer_extend" ),
						"KG" 			=> __( "Kyrgyzstan", "ts_visual_composer_extend" ),
						"LA" 			=> __( "Lao People's Democratic Republic", "ts_visual_composer_extend" ),
						"LV" 			=> __( "Latvia", "ts_visual_composer_extend" ),
						"LB" 			=> __( "Lebanon", "ts_visual_composer_extend" ),
						"LS" 			=> __( "Lesotho", "ts_visual_composer_extend" ),
						"LR" 			=> __( "Liberia", "ts_visual_composer_extend" ),
						"LY" 			=> __( "Libya", "ts_visual_composer_extend" ),
						"LI" 			=> __( "Liechtenstein", "ts_visual_composer_extend" ),
						"LT" 			=> __( "Lithuania", "ts_visual_composer_extend" ),
						"LU" 			=> __( "Luxembourg", "ts_visual_composer_extend" ),
						"MO" 			=> __( "Macao", "ts_visual_composer_extend" ),
						"MK" 			=> __( "Macedonia, the Former Yugoslav Republic of", "ts_visual_composer_extend" ),
						"MG" 			=> __( "Madagascar", "ts_visual_composer_extend" ),
						"MW" 			=> __( "Malawi", "ts_visual_composer_extend" ),
						"MY" 			=> __( "Malaysia", "ts_visual_composer_extend" ),
						"MV" 			=> __( "Maldives", "ts_visual_composer_extend" ),
						"ML" 			=> __( "Mali", "ts_visual_composer_extend" ),
						"MT" 			=> __( "Malta", "ts_visual_composer_extend" ),
						"MH" 			=> __( "Marshall Islands", "ts_visual_composer_extend" ),
						"MQ" 			=> __( "Martinique", "ts_visual_composer_extend" ),
						"MR" 			=> __( "Mauritania", "ts_visual_composer_extend" ),
						"MU" 			=> __( "Mauritius", "ts_visual_composer_extend" ),
						"YT" 			=> __( "Mayotte", "ts_visual_composer_extend" ),
						"MX" 			=> __( "Mexico", "ts_visual_composer_extend" ),
						"FM" 			=> __( "Micronesia, Federated States of", "ts_visual_composer_extend" ),
						"MD" 			=> __( "Moldova, Republic of", "ts_visual_composer_extend" ),
						"MC" 			=> __( "Monaco", "ts_visual_composer_extend" ),
						"MN" 			=> __( "Mongolia", "ts_visual_composer_extend" ),
						"ME" 			=> __( "Montenegro", "ts_visual_composer_extend" ),
						"MS" 			=> __( "Montserrat", "ts_visual_composer_extend" ),
						"MA" 			=> __( "Morocco", "ts_visual_composer_extend" ),
						"MZ" 			=> __( "Mozambique", "ts_visual_composer_extend" ),
						"MM" 			=> __( "Myanmar", "ts_visual_composer_extend" ),
						"NA" 			=> __( "Namibia", "ts_visual_composer_extend" ),
						"NR" 			=> __( "Nauru", "ts_visual_composer_extend" ),
						"NP" 			=> __( "Nepal", "ts_visual_composer_extend" ),
						"NL" 			=> __( "Netherlands", "ts_visual_composer_extend" ),
						"NC" 			=> __( "New Caledonia", "ts_visual_composer_extend" ),
						"NZ" 			=> __( "New Zealand", "ts_visual_composer_extend" ),
						"NI" 			=> __( "Nicaragua", "ts_visual_composer_extend" ),
						"NE" 			=> __( "Niger", "ts_visual_composer_extend" ),
						"NG" 			=> __( "Nigeria", "ts_visual_composer_extend" ),
						"NU" 			=> __( "Niue", "ts_visual_composer_extend" ),
						"NF" 			=> __( "Norfolk Island", "ts_visual_composer_extend" ),
						"MP" 			=> __( "Northern Mariana Islands", "ts_visual_composer_extend" ),
						"NO" 			=> __( "Norway", "ts_visual_composer_extend" ),
						"OM" 			=> __( "Oman", "ts_visual_composer_extend" ),
						"PK" 			=> __( "Pakistan", "ts_visual_composer_extend" ),
						"PW" 			=> __( "Palau", "ts_visual_composer_extend" ),
						"PS" 			=> __( "Palestine, State of", "ts_visual_composer_extend" ),
						"PA" 			=> __( "Panama", "ts_visual_composer_extend" ),
						"PG" 			=> __( "Papua New Guinea", "ts_visual_composer_extend" ),
						"PY" 			=> __( "Paraguay", "ts_visual_composer_extend" ),
						"PE" 			=> __( "Peru", "ts_visual_composer_extend" ),
						"PH" 			=> __( "Philippines", "ts_visual_composer_extend" ),
						"PN" 			=> __( "Pitcairn", "ts_visual_composer_extend" ),
						"PL" 			=> __( "Poland", "ts_visual_composer_extend" ),
						"PT" 			=> __( "Portugal", "ts_visual_composer_extend" ),
						"PR" 			=> __( "Puerto Rico", "ts_visual_composer_extend" ),
						"QA" 			=> __( "Qatar", "ts_visual_composer_extend" ),
						"RE" 			=> __( "RÃ©union", "ts_visual_composer_extend" ),
						"RO" 			=> __( "Romania", "ts_visual_composer_extend" ),
						"RU" 			=> __( "Russian Federation", "ts_visual_composer_extend" ),
						"RW" 			=> __( "Rwanda", "ts_visual_composer_extend" ),
						"BL" 			=> __( "Saint BarthÃ©lemy", "ts_visual_composer_extend" ),
						"SH" 			=> __( "Saint Helena, Ascension and Tristan da Cunha", "ts_visual_composer_extend" ),
						"KN" 			=> __( "Saint Kitts and Nevis", "ts_visual_composer_extend" ),
						"LC" 			=> __( "Saint Lucia", "ts_visual_composer_extend" ),
						"MF" 			=> __( "Saint Martin (French part)", "ts_visual_composer_extend" ),
						"PM" 			=> __( "Saint Pierre and Miquelon", "ts_visual_composer_extend" ),
						"VC" 			=> __( "Saint Vincent and the Grenadines", "ts_visual_composer_extend" ),
						"WS" 			=> __( "Samoa", "ts_visual_composer_extend" ),
						"SM" 			=> __( "San Marino", "ts_visual_composer_extend" ),
						"ST" 			=> __( "Sao Tome and Principe", "ts_visual_composer_extend" ),
						"SA" 			=> __( "Saudi Arabia", "ts_visual_composer_extend" ),
						"SN" 			=> __( "Senegal", "ts_visual_composer_extend" ),
						"RS" 			=> __( "Serbia", "ts_visual_composer_extend" ),
						"SC" 			=> __( "Seychelles", "ts_visual_composer_extend" ),
						"SL" 			=> __( "Sierra Leone", "ts_visual_composer_extend" ),
						"SG" 			=> __( "Singapore", "ts_visual_composer_extend" ),
						"SX" 			=> __( "Sint Maarten (Dutch part)", "ts_visual_composer_extend" ),
						"SK" 			=> __( "Slovakia", "ts_visual_composer_extend" ),
						"SI" 			=> __( "Slovenia", "ts_visual_composer_extend" ),
						"SB" 			=> __( "Solomon Islands", "ts_visual_composer_extend" ),
						"SO" 			=> __( "Somalia", "ts_visual_composer_extend" ),
						"ZA" 			=> __( "South Africa", "ts_visual_composer_extend" ),
						"GS" 			=> __( "South Georgia and the South Sandwich Islands", "ts_visual_composer_extend" ),
						"SS" 			=> __( "South Sudan", "ts_visual_composer_extend" ),
						"ES" 			=> __( "Spain", "ts_visual_composer_extend" ),
						"LK" 			=> __( "Sri Lanka", "ts_visual_composer_extend" ),
						"SD" 			=> __( "Sudan", "ts_visual_composer_extend" ),
						"SR" 			=> __( "Suriname", "ts_visual_composer_extend" ),
						"SJ" 			=> __( "Svalbard and Jan Mayen", "ts_visual_composer_extend" ),
						"SZ" 			=> __( "Swaziland", "ts_visual_composer_extend" ),
						"SE" 			=> __( "Sweden", "ts_visual_composer_extend" ),
						"CH" 			=> __( "Switzerland", "ts_visual_composer_extend" ),
						"SY" 			=> __( "Syrian Arab Republic", "ts_visual_composer_extend" ),
						"TW" 			=> __( "Taiwan", "ts_visual_composer_extend" ),
						"TJ" 			=> __( "Tajikistan", "ts_visual_composer_extend" ),
						"TZ" 			=> __( "Tanzania, United Republic of", "ts_visual_composer_extend" ),
						"TH" 			=> __( "Thailand", "ts_visual_composer_extend" ),
						"TL" 			=> __( "Timor-Leste", "ts_visual_composer_extend" ),
						"TG" 			=> __( "Togo", "ts_visual_composer_extend" ),
						"TK" 			=> __( "Tokelau", "ts_visual_composer_extend" ),
						"TO" 			=> __( "Tonga", "ts_visual_composer_extend" ),
						"TT" 			=> __( "Trinidad and Tobago", "ts_visual_composer_extend" ),
						"TN" 			=> __( "Tunisia", "ts_visual_composer_extend" ),
						"TR" 			=> __( "Turkey", "ts_visual_composer_extend" ),
						"TM" 			=> __( "Turkmenistan", "ts_visual_composer_extend" ),
						"TC" 			=> __( "Turks and Caicos Islands", "ts_visual_composer_extend" ),
						"TV" 			=> __( "Tuvalu", "ts_visual_composer_extend" ),
						"UG" 			=> __( "Uganda", "ts_visual_composer_extend" ),
						"UA" 			=> __( "Ukraine", "ts_visual_composer_extend" ),
						"AE" 			=> __( "United Arab Emirates", "ts_visual_composer_extend" ),
						"GB" 			=> __( "United Kingdom", "ts_visual_composer_extend" ),
						"US" 			=> __( "United States", "ts_visual_composer_extend" ),
						"UM" 			=> __( "United States Minor Outlying Islands", "ts_visual_composer_extend" ),
						"UY" 			=> __( "Uruguay", "ts_visual_composer_extend" ),
						"UZ" 			=> __( "Uzbekistan", "ts_visual_composer_extend" ),
						"VU" 			=> __( "Vanuatu", "ts_visual_composer_extend" ),
						"VE" 			=> __( "Venezuela, Bolivarian Republic of", "ts_visual_composer_extend" ),
						"VN" 			=> __( "Vietnam", "ts_visual_composer_extend" ),
						"VG" 			=> __( "Virgin Islands, British", "ts_visual_composer_extend" ),
						"VI" 			=> __( "Virgin Islands, U.S.", "ts_visual_composer_extend" ),
						"WF" 			=> __( "Wallis and Futuna", "ts_visual_composer_extend" ),
						"EH" 			=> __( "Western Sahara", "ts_visual_composer_extend" ),
						"YE" 			=> __( "Yemen", "ts_visual_composer_extend" ),
						"ZM" 			=> __( "Zambia", "ts_visual_composer_extend" ),
						"ZW" 			=> __( "Zimbabwe", "ts_visual_composer_extend" ),
					);
				} else {
					return array();
				}
			}
	
			// Google Maps Marker
			function TS_VCSC_GoogleMapsPlus_Marker ($atts, $content = null) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
			
				extract( shortcode_atts( array(
					// Marker Location
					'marker_position'				=> 'coordinates',		// coordinates, address
					'marker_address'				=> '',
					'marker_latitude'				=> '',
					'marker_longitude'				=> '',
					// Marker Identifier
					'marker_identifier'				=> '',
					// Featured Image
					'marker_featured'				=> '',
					// Marker Style
					'marker_style'					=> 'default',			// default, internal, image, external
					'marker_internal'				=> '',
					'marker_image'					=> '',
					'marker_external'				=> '',
					'marker_width'					=> 32,
					'marker_height'					=> 32,
					'marker_animation'				=> 'false',
					'marker_entry'					=> 'drop',
					// Infowindow Style
					'window_type'					=> 'global',			// global, google, override
					'window_shadow'					=> 'false',
					'window_background'				=> '#333333',
					'window_fontcolor'				=> '#ffffff',
					'window_arrowshow'				=> 'true',
					'window_arrowcolor'				=> '#333333',
					'window_maxwdidth'				=> 800,
					'window_offset'					=> 0,
					'window_closer'					=> 'topright',					
					// Infowindow Content
					'marker_tags'					=> '',
					'marker_group'					=> '',
					'marker_title'					=> '',
					'marker_include'				=> 'true',
					'marker_popup'					=> 'false',
					'marker_draggable'				=> 'false',
					'marker_streetview'				=> 'false',
					// Streetview Settings
					'marker_streetadjust'			=> 'false',
					'marker_streetheading'			=> 0,
					'marker_streetpitch'			=> 0,
					'marker_streetzoom'				=> 1,
					// Infowindow Buttons
					'marker_directions'				=> 'false',
					'marker_directions_text'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchDirections'])		? $this->TS_VCSC_Google_MapPLUS_Language['SearchDirections']	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchDirections']),
					'marker_viewer'					=> 'false',
					'marker_viewer_text'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchGoogle'])			? $this->TS_VCSC_Google_MapPLUS_Language['SearchGoogle']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchGoogle']),
					'marker_link'					=> 'false',
					'marker_url'					=> '',
					'marker_button'					=> (isset($this->TS_VCSC_Google_MapPLUS_Language['OtherLink'])				? $this->TS_VCSC_Google_MapPLUS_Language['OtherLink']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink']),
					// Other Settings
					'css'							=> '',
				), $atts ));
				
				$map_random                    		= mt_rand(999999, 9999999);
				$map_valid							= "false";
				$output 							= '';
				
				// Check for Missing Location
				if (($marker_position == "coordinates") && (($marker_latitude == "") || ($marker_longitude == ""))) {
					$map_valid						= "false";
				} else if (($marker_position == "address") && ($marker_address == '')) {
					$map_valid						= "false";
				} else {
					$map_valid						= "true";
				}
				if (($map_valid == "false") && ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false")) {
					echo $output;
					$myvariable 					= ob_get_clean();
					return $myvariable;
				}
				
				if (!empty($marker_identifier)) {
					$marker_elemid					= $marker_identifier;
					$marker_dataid					= $marker_identifier;
				} else {
					$marker_elemid					= 'ts-advanced-google-map-marker-single-' . $map_random;
					$marker_dataid					= 'map-marker-single-' . $map_random;
				}
				
				// Link Values
				if ($marker_link = "true") {
					$link 							= TS_VCSC_Advancedlinks_GetLinkData($marker_url);
					$a_href							= $link['url'];
					$a_title 						= $link['title'];
					$a_target 						= $link['target'];
				} else {
					$a_href							= '';
					$a_title 						= '';
					$a_target 						= '';
				}
	
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-advanced-google-map-marker-single ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_GoogleMapsPlus_Marker', $atts);
				} else {
					$css_class						= 'ts-advanced-google-map-marker-single';
				}
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					if (($marker_style == "internal") && ($marker_internal != '')) {
						$marker_internal 			= $this->TS_VCSC_GoogleMapsPlus_Image($marker_internal);
						$marker_icon				= urlencode(TS_VCSC_GetResourceURL('images/marker/' . $marker_internal));
						$marker_size				= 'width: 32px; height: 37px;';
					} else if (($marker_style == "image") && ($marker_image != '')) {
						$marker_icon 				= wp_get_attachment_image_src($marker_image, 'full');						
						$marker_icon				= urlencode($marker_icon[0]);
						$marker_size				= 'width: ' . $marker_width . 'px; height: ' . $marker_height . 'px;';
					} else if (($marker_style == "external") && ($marker_external != '')) {
						$marker_icon				= $marker_external;
						$marker_size				= 'width: ' . $marker_width . 'px; height: ' . $marker_height . 'px;';
					} else {
						$marker_icon				= urlencode(TS_VCSC_GetResourceURL('images/defaults/default_mapmarker.png'));
						$marker_size				= 'width: 32px; height: 32px;';
					}
				} else {
					$marker_icon					= '';
					$marker_size					= '';
				}
				
				$marker_data						= 'data-id="' . $marker_dataid . '" data-processed="false" data-group="' . $marker_group . '" data-tags="' . $marker_tags . '" data-streetview="' . $marker_streetview . '" data-draggable="' . $marker_draggable . '" data-title="' . $marker_title . '" ';
				$marker_data						.= 'data-source="' . $marker_style . '" data-icon="' . $marker_icon . '" data-animation-allow="' . $marker_animation . '" data-animation-type="' . $marker_entry . '" data-latitude="' . ($marker_position == 'coordinates' ? $marker_latitude : '') . '" data-longitude="' . ($marker_position == 'coordinates' ? $marker_longitude : '') . '" data-address="' . ($marker_position == 'address' ? $marker_address : '') . '" data-draggable="false" data-popup="' . $marker_popup . '" ';
				$marker_data						.= 'data-window-type="' . $window_type . '" data-window-offset="' . $window_offset . '" data-window-closer="' . $window_closer . '" data-window-maxwidth="' . $window_maxwdidth . '" data-window-shadow="' . $window_shadow . '" data-window-background="' . $window_background . '" data-window-fontcolor="' . $window_fontcolor . '" data-window-arrowshow="' . $window_arrowshow . '" data-window-arrowcolor="' . $window_arrowcolor . '" ';
				$marker_data						.= 'data-street-adjust="' . $marker_streetadjust . '" data-street-heading="' . $marker_streetheading . '" data-street-pitch="' . $marker_streetpitch . '" data-street-zoom="' . $marker_streetzoom . '" ';
				
				if ($marker_style == "internal") {
					$marker_width					= 32;
					$marker_height					= 37;
				} else if (($marker_style == "image") || ($marker_style == "external")) {
					$marker_width					= $marker_width;
					$marker_height					= $marker_height;
				} else if ($marker_style == "default") {
					$marker_width					= 32;
					$marker_height					= 32;
				}
				$marker_data						.= 'data-marker-width="' . $marker_width . '" data-marker-height="' . $marker_height . '"';
				
				if ($marker_position == "coordinates") {
					$google_directions				= 'https://www.google.com/maps?saddr=My+Location&daddr=' . $marker_latitude . ',' . $marker_longitude . '';
					$google_viewer					= 'https://www.google.com/maps?q=' . $marker_latitude . ',' . $marker_longitude . '';
				} else if ($marker_position == "address") {
					$google_directions				= 'https://www.google.com/maps?saddr=My+Location&daddr=' . urlencode($marker_address) . '';
					$google_viewer					= 'https://www.google.com/maps?q=' . urlencode($marker_address) . '';
				}				
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					$output .= '<div id="' . $marker_elemid . '" class="' . $css_class . '" ' . $marker_data . '>';
						if (($marker_include == "true") && ($marker_title != '')) {
							$output .= '<div class="ts-advanced-google-map-marker-title">' . $marker_title . '</div>';
						}
						if (($content != '') || ($marker_directions == "true") || ($marker_viewer == "true") || (($marker_link == "true") && ($a_href != ''))) {
							$output .= '<div class="ts-advanced-google-map-marker-content">';
								if ($content != '') {
									$output .= do_shortcode($content);
								}
								if (($marker_directions == "true") || ($marker_viewer == "true") || (($marker_link == "true") && ($a_href != ''))) {
									$output .= '<div class="ts-advanced-google-map-marker-controls">';
										if ($marker_directions == "true") {
											$output .= '<a class="ts-advanced-google-map-marker-directions" href="' . $google_directions . '" target="_blank">' . $marker_directions_text . '</a>';
										}
										if ($marker_viewer == "true") {
											$output .= '<a class="ts-advanced-google-map-marker-viewer" href="' . $google_viewer . '" target="_blank">' . $marker_viewer_text . '</a>';
										}
										if (($marker_link == "true") && ($a_href != '')) {
											$output .= '<a class="ts-advanced-google-map-marker-link" href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '">' . $marker_button . '</a>';
										}
									$output .= '</div>';
								}
							$output .= '</div>';
						}
					$output .= '</div>';
					$output .= '<div id="ts-advanced-google-map-marker-listing-' . $map_random . '" class="ts-advanced-google-map-marker-listing ts-advanced-google-map-details-listing" data-id="' . $marker_dataid . '" data-style="marker" data-type="marker" data-title="' . $marker_title . '" data-group="' . $marker_group . '" data-tags="' . $marker_tags . '">';
						$marker_class = '';
						if ($marker_featured != '') {
							$marker_featured = wp_get_attachment_image_src($marker_featured, 'thumbnail');
							if (isset($marker_featured[0])) {
								$marker_class = 'ts-advanced-google-map-featured-offset';
								$marker_featured = "url('" . $marker_featured[0] . "')";
								$output .= '<div style="background-image: ' . $marker_featured . ';" class="ts-advanced-google-map-marker-featured"></div>';
							}
						}
						$output .= '<img src="' . urldecode($marker_icon) . '" class="ts-advanced-google-map-marker-icon ' . $marker_class . '" style="' . $marker_size . '">';
						$output .= '<div class="ts-advanced-google-map-marker-title ' . $marker_class . '">' . $marker_title . '</div>';						
						if ($marker_position == 'coordinates') {
							$output .= '<div class="ts-advanced-google-map-marker-location ' . $marker_class . '">' . $marker_latitude . '&deg; / ' . $marker_longitude . '&deg;</div>';
						} else {
							$output .= '<div class="ts-advanced-google-map-marker-location ' . $marker_class . '">' . $marker_address . '</div>';
						}
						if ($marker_group != "") {
							$output .= '<div class="ts-advanced-google-map-marker-groups ' . $marker_class . '">' . str_replace(array("|", " , "), array(", ", ", "), $marker_group) . '</div>';
						} else {
							$output .= '<div class="ts-advanced-google-map-marker-groups ' . $marker_class . '">...</div>';
						}
						if ($marker_tags != "") {
							$output .= '<div class="ts-advanced-google-map-marker-tags ' . $marker_class . '">' . str_replace(array("|", " , "), array(", ", ", "), $marker_tags) . '</div>';
						} else {
							$output .= '<div class="ts-advanced-google-map-marker-tags ' . $marker_class . '">...</div>';
						}
					$output .= '</div>';
				} else {
					$output .= '<div class="ts-advanced-google-map-settings-edit-marker">';
						if ($marker_style == "default") {
							$marker_icon			= TS_VCSC_GetResourceURL('images/defaults/default_mapmarker.png');
						} else if ($marker_style == "internal") {
							$marker_icon			= TS_VCSC_GetResourceURL('images/marker/' . $marker_internal);
						} else if ($marker_style == "image") {
							$marker_icon			= wp_get_attachment_image_src($markerimage, 'full');
							$marker_icon			= $marker_icon[0];
						}
						$output .= '<img class="ts-advanced-google-map-settings-edit-icon" src="' . $marker_icon . '">';
						$output .= '<div class="ts-advanced-google-map-settings-edit-excerpt">';
							$output .= 'Title: ' . ($marker_title != '' ? $marker_title : 'N/A') . '<br/>';
							$output .= 'Group: ' . ($marker_group != '' ? $marker_group : 'N/A') . '<br/>';
							if ($marker_position == 'address') {
								$output .= 'Address: ' . $marker_address . '<br/>';
							} else if ($marker_position == 'coordinates') {
								$output .= 'Coordinates: Latitude ' . $marker_latitude . ' / Longitude ' . $marker_longitude . '<br/>';
							}
						$output .= '</div>';
					$output .= '</div>';
				}
				
				echo $output;
				
				$myvariable 						= ob_get_clean();
				return $myvariable;
			}
			
			// Google Maps Overlay
			function TS_VCSC_GoogleMapsPlus_Overlay ($atts, $content = null) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
				
				extract( shortcode_atts( array(
					// Overlay Settings
					'overlay_type'					=> 'circle', // circle, rectangle, polygon, polyline
					'overlay_title'					=> '',
					'overlay_group'					=> '',
					'overlay_tags'					=> '',
					'overlay_include'				=> 'true',
					'overlay_popup'					=> 'false',
					'overlay_editable'				=> 'false',
					'overlay_output'				=> '',
					'overlay_draggable'				=> 'false',
					// Overlay Identifier
					'overlay_identifier'			=> '',
					// Featured Image
					'overlay_featured'				=> '',
					// Infowindow Style
					'window_type'					=> 'global',			// global, google, override
					'window_shadow'					=> 'false',
					'window_background'				=> '#333333',
					'window_fontcolor'				=> '#ffffff',
					'window_arrowshow'				=> 'true',
					'window_arrowcolor'				=> '#333333',
					'window_maxwdidth'				=> 800,
					'window_offset'					=> 0,
					'window_closer'					=> 'topright',	
					// Infowindow Button
					'overlay_link'					=> 'false',
					'overlay_url'					=> '',
					'overlay_button'				=> (isset($this->TS_VCSC_Google_MapPLUS_Language['OtherLink'])			? $this->TS_VCSC_Google_MapPLUS_Language['OtherLink']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink']),
					// Style Settings
					'style_stroke_rgba'				=> 'rgba(255, 0, 0, 1)',
					'style_stroke_weight'			=> 2,
					'style_fill_rgba'				=> 'rgba(255, 0, 0, 0.2)',
					// Circle Settings
					'circle_latitude'				=> '',
					'circle_longitude'				=> '',
					'circle_radius_miles'			=> 10,
					'circle_radius_feet'			=> 10000,
					'circle_radius_km'				=> 10,
					'circle_radius_meters'			=> 1000,				
					'circle_radius_unit'			=> 'miles',
					// Rectangle Settings
					'rectangle_nelatitude'			=> '',
					'rectangle_nelongitude'			=> '',
					'rectangle_swlatitude'			=> '',
					'rectangle_swlongitude'			=> '',
					// Polygon + Polyline Settings
					'polytype_input'				=> 'group',
					'polytype_coordinates'			=> '',
					'polytype_datasets'				=> '',
					'polytype_geodesic'				=> 'false',
					// Other Settings
					'css'							=> '',
				), $atts ));
				
				$map_random                    		= mt_rand(999999, 9999999);
				$map_valid							= "false";
				$output 							= '';
				$poly_coordinates					= '';
				
				// Check for Missing Location
				if (($overlay_type == "circle") && (($circle_latitude == "") || ($circle_longitude == ""))) {
					$map_valid						= "false";
				} else if (($overlay_type == "rectangle") && (($rectangle_nelatitude == "") || ($rectangle_nelongitude == "") || ($rectangle_swlatitude == "") || ($rectangle_swlongitude == ""))) {
					$map_valid						= "false";
				} else if ((($overlay_type == "polygon") || ($overlay_type == "polyline")) && ($polytype_coordinates == "") && ($polytype_input == "group")) {
					$map_valid						= "false";
				} else if ((($overlay_type == "polygon") || ($overlay_type == "polyline")) && ($polytype_datasets == "") && ($polytype_input == "exploded")) {
					$map_valid						= "false";
				} else {
					$map_valid						= "true";
				}
				if (($map_valid == "false") && ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false")) {
					echo $output;
					$myvariable 					= ob_get_clean();
					return $myvariable;
				}
				
				if (!empty($overlay_identifier)) {
					$overlay_elemid					= $overlay_identifier;
					$overlay_dataid					= $overlay_identifier;
				} else {
					$overlay_elemid					= 'ts-advanced-google-map-overlay-single-' . $map_random;
					$overlay_dataid					= 'map-overlay-single-' . $map_random;
				}
	
				// Link Values
				if ($overlay_link = "true") {
					$link 							= TS_VCSC_Advancedlinks_GetLinkData($overlay_url);
					$a_href							= $link['url'];
					$a_title 						= $link['title'];
					$a_target 						= $link['target'];
				} else {
					$a_href							= '';
					$a_title 						= '';
					$a_target 						= '';
				}
				
				// Adjust Circle Radius
				if ($overlay_type == "circle") {
					if ($circle_radius_unit == 'miles') {
						$circle_radius				= ($circle_radius_miles * 1000 * 1.609344001);
					} else if ($circle_radius_unit == 'feet') {
						$circle_radius				= ($circle_radius_feet / 3.2808399);
					} else if ($circle_radius_unit == 'kilometers') {
						$circle_radius				= ($circle_radius_km * 1000);
					} else if ($circle_radius_unit == 'meters') {
						$circle_radius				= $circle_radius_meters;
					}
				}
				
				// Process Group Values
				if (($overlay_type == "polygon" || $overlay_type == "polyline") && isset($polytype_coordinates) && strlen($polytype_coordinates) > 0 && ($polytype_input == "group")) {
					$coordinates 					= json_decode(urldecode($polytype_coordinates), true);
					if (is_array($coordinates)) {	
						foreach ((array) $coordinates as $key => $entry) {
							if (isset($entry['coordinates'])) {
								$poly_location      = esc_html($entry['coordinates']);
							}
							if (strlen($poly_location) != 0) {
								$poly_coordinates 	.= $poly_location . '/';
							}
						}
						$poly_coordinates 			= rtrim($poly_coordinates, '/');
					}
					$poly_coordinates				= preg_replace('/\s+/', '', $poly_coordinates);
				}
				
				// Process Exploded Textarea
				if (($overlay_type == "polygon" || $overlay_type == "polyline") && isset($polytype_datasets) && strlen($polytype_datasets) > 0 && ($polytype_input == "exploded")) {
					$coordinates 					= preg_replace('/,+/', ',', $polytype_datasets);
					$coordinates 					= explode(',', $polytype_datasets);
					if (is_array($coordinates)) {
						foreach ((array) $coordinates as $key => $entry) {
							$poly_coordinates 		.= str_replace('/', ',', $entry) . '/';
						}
						$poly_coordinates 			= rtrim($poly_coordinates, '/');
					}
					$poly_coordinates				= preg_replace('/\s+/', '', $poly_coordinates);
				}
				
				
				// Create Data Strings
				$data_style							= 'data-style-strokergba="' . $style_stroke_rgba . '" data-style-strokeweight="' . $style_stroke_weight . '" data-style-fillrgba="' . $style_fill_rgba . '"';
				$data_window						= 'data-window-type="' . $window_type . '" data-window-offset="' . $window_offset . '" data-window-closer="' . $window_closer . '" data-window-maxwidth="' . $window_maxwdidth . '" data-window-shadow="' . $window_shadow . '" data-window-background="' . $window_background . '" data-window-fontcolor="' . $window_fontcolor . '" data-window-arrowshow="' . $window_arrowshow . '" data-window-arrowcolor="' . $window_arrowcolor . '" ';
				$data_total							= 'data-id="' . $overlay_dataid . '" data-processed="false" data-popup="' . $overlay_popup . '" data-editable="' . $overlay_editable . '" data-output="' . $overlay_output . '" data-draggable="' . $overlay_draggable . '" data-group="' . $overlay_group . '" data-tags="' . $overlay_tags . '" data-title="' . $overlay_title . '" data-overlay-type="' . $overlay_type . '" ' . $data_style . ' ' . $data_window . ' ';
				if ($overlay_type == "circle") {
					$data_total						.= 'data-circle-latitude="' . $circle_latitude . '" data-circle-longitude="' . $circle_longitude . '" data-circle-radius="' . $circle_radius . '" data-circle-unit="' . $circle_radius_unit . '"';
				} else if ($overlay_type == "rectangle") {
					$data_total						.= 'data-rectangle-swlatitude="' . $rectangle_swlatitude . '" data-rectangle-swlongitude="' . $rectangle_swlongitude . '" data-rectangle-nelatitude="' . $rectangle_nelatitude . '" data-rectangle-nelongitude="' . $rectangle_nelongitude . '"';
				} else if ($overlay_type == "polygon") {
					$data_total						.= 'data-polygon-coordinates="' . $poly_coordinates . '"';
				} else if ($overlay_type == "polyline") {
					$data_total						.= 'data-polyline-coordinates="' . $poly_coordinates . '" data-polyline-geodesic="' . $polytype_geodesic . '"';
				}
				
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-advanced-google-map-overlay-single ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_GoogleMapsPlus_Overlay', $atts);
				} else {
					$css_class						= 'ts-advanced-google-map-overlay-single';
				}
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					$output .= '<div id="' . $overlay_elemid . '" class="' . $css_class . '" ' . $data_total . '>';
						if (($overlay_include == "true") && ($overlay_title != '')) {
							$output .= '<div class="ts-advanced-google-map-overlay-title">' . $overlay_title . '</div>';
						}
						if (($content != '') || (($overlay_link == "true") && ($a_href != ''))) {
							$output .= '<div class="ts-advanced-google-map-overlay-content">';
								if ($content != '') {
									$output .= do_shortcode($content);
								}
								if (($overlay_link == "true") && ($a_href != '')) {
									$output .= '<div class="ts-advanced-google-map-overlay-controls">';
										$output .= '<a class="ts-advanced-google-map-overlay-link" href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '">' . $overlay_button . '</a>';
									$output .= '</div>';
								}
							$output .= '</div>';
						}
					$output .= '</div>';
					$output .= '<div id="ts-advanced-google-map-overlay-listing-' . $map_random . '" class="ts-advanced-google-map-overlay-listing ts-advanced-google-map-details-listing" data-id="' . $overlay_dataid . '" data-style="overlay" data-type="' . $overlay_type . '" data-title="' . $overlay_title . '" data-group="' . $overlay_group . '" data-tags="' . $overlay_tags . '">';
						$overlay_class = '';
						if ($overlay_featured != '') {
							$overlay_featured = wp_get_attachment_image_src($overlay_featured, 'thumbnail');
							if (isset($overlay_featured[0])) {
								$overlay_class = 'ts-advanced-google-map-featured-offset';
								$overlay_featured = "url('" . $overlay_featured[0] . "')";
								$output .= '<div style="background-image: ' . $overlay_featured . ';" class="ts-advanced-google-map-overlay-featured"></div>';
							}
						}
						if ($overlay_type == "polygon") {
							$output .= '<svg class="ts-advanced-google-map-overlay-icon ts-advanced-google-map-overlay-' . $overlay_type . ' ' . $overlay_class . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" style="fill: ' . $style_fill_rgba . '; stroke: ' . $style_stroke_rgba . '; stroke-width: ' . $style_stroke_weight . ';">';
								$output .= '<path d="M8 32 L32 24 L24 8 L0 0 Z"/>';
							$output .= '</svg>';
						} else if ($overlay_type == "polyline") {
							$output .= '<svg class="ts-advanced-google-map-overlay-icon ts-advanced-google-map-overlay-' . $overlay_type . ' ' . $overlay_class . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" style="stroke: ' . $style_stroke_rgba . '; stroke-width: ' . $style_stroke_weight . '; fill:none;">';
								$output .= '<path d="M24,32 Q32,0 0,' . $style_stroke_weight . '"/>';
							$output .= '</svg>';
						} else {
							$output .= '<div class="ts-advanced-google-map-overlay-icon ts-advanced-google-map-overlay-' . $overlay_type . ' ' . $overlay_class . '" style="background: ' . $style_fill_rgba . '; border: ' . $style_stroke_weight . 'px solid ' . $style_stroke_rgba . ';"></div>';
						}
						$output .= '<div class="ts-advanced-google-map-overlay-title ' . $overlay_class . '">' . $overlay_title . '</div>';
						if ($overlay_group != "") {
							$output .= '<div class="ts-advanced-google-map-overlay-groups ' . $overlay_class . '">' . str_replace(array("|", " , "), array(", ", ", "), $overlay_group) . '</div>';
						} else {
							$output .= '<div class="ts-advanced-google-map-overlay-groups ' . $overlay_class . '">...</div>';
						}
						if ($overlay_tags != "") {
							$output .= '<div class="ts-advanced-google-map-overlay-tags ' . $overlay_class . '">' . str_replace(array("|", " , "), array(", ", ", "), $overlay_tags) . '</div>';
						} else {
							$output .= '<div class="ts-advanced-google-map-overlay-tags ' . $overlay_class . '">...</div>';
						}
					$output .= '</div>';
				} else {
					$output .= '<div class="ts-advanced-google-map-settings-edit-overlay">';
						if ($overlay_type == "polygon") {
							$output .= '<svg class="ts-advanced-google-map-overlay-icon ts-advanced-google-map-overlay-' . $overlay_type . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" style="fill: ' . $style_fill_rgba . '; stroke: ' . $style_stroke_rgba . '; stroke-width: ' . $style_stroke_weight . ';">';
								$output .= '<path d="M8 32 L32 24 L24 8 L0 0 Z"/>';
							$output .= '</svg>';
						} else if ($overlay_type == "polyline") {
							$output .= '<svg class="ts-advanced-google-map-overlay-icon ts-advanced-google-map-overlay-' . $overlay_type . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" style="stroke: ' . $style_stroke_rgba . '; stroke-width: ' . $style_stroke_weight . '; fill:none;">';
								$output .= '<path d="M24,32 Q32,0 0,' . $style_stroke_weight . '"/>';
							$output .= '</svg>';
						} else {
							$output .= '<div class="ts-advanced-google-map-overlay-icon ts-advanced-google-map-overlay-' . $overlay_type . '" style="background: ' . $style_fill_rgba . '; border: ' . $style_stroke_weight . 'px solid ' . $style_stroke_rgba . ';"></div>';
						}
						$output .= '<div class="ts-advanced-google-map-settings-edit-excerpt">';
							$output .= '<span style="font-weight: bold;">Overlay Type: ' . ucfirst($overlay_type) . '</span><br/>';
							$output .= 'Title: ' . ($overlay_title != '' ? $overlay_title : 'N/A') . '<br/>';
							$output .= 'Group: ' . ($overlay_group != '' ? $overlay_group : 'N/A') . '<br/>';
						$output .= '</div>';
					$output .= '</div>';
				}
				
				echo $output;
				
				$myvariable 						= ob_get_clean();
				return $myvariable;
			}
			
			// Googe Maps Curveline
 			function TS_VCSC_GoogleMapsPlus_Curveline ($atts, $content = null) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
				
				extract( shortcode_atts( array(
					// Curveline Settings
					'curveline_title'				=> '',
					'curveline_group'				=> '',
					'curveline_tags'				=> '',
					'curveline_draggable'			=> 'false',
					'curveline_output'				=> '',
					// Curveline Identifier
					'curveline_identifier'			=> '',
					// Featured Image
					'curveline_featured'			=> '',
					// Start + End Settings
					'curveline_startlat'			=> '',
					'curveline_startlng'			=> '',
					'curveline_endlat'				=> '',
					'curveline_endlng'				=> '',
					'curveline_curvature'			=> 20,
					'curveline_position'			=> 'right',
					'curveline_zindex'				=> -1,
					// Style Settings
					'style_stroke_rgba'				=> 'rgba(255, 0, 0, 1)',
					'style_stroke_weight'			=> 2,
					// Start Marker Settings
					'marker1_style'					=> 'default',			// default, internal, image, external, hide
					'marker1_internal'				=> '',
					'marker1_image'					=> '',
					'marker1_external'				=> '',
					'marker1_width'					=> 32,
					'marker1_height'				=> 32,
					'marker1_window'				=> 'custom',			// custom, none
					'marker1_reuse'					=> 'true',
					'marker1_title'					=> '',
					'marker1_content'				=> '',
					'marker1_popup'					=> 'false',
					'marker1_link'					=> 'false',
					'marker1_url'					=> '',
					'marker1_button'				=> (isset($this->TS_VCSC_Google_MapPLUS_Language['OtherLink'])			? $this->TS_VCSC_Google_MapPLUS_Language['OtherLink']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink']),
					// End Marker Settings
					'marker2_style'					=> 'inherit',			// inherit, default, internal, image, external, hide
					'marker2_internal'				=> '',
					'marker2_image'					=> '',
					'marker2_external'				=> '',
					'marker2_width'					=> 32,
					'marker2_height'				=> 32,
					'marker2_window'				=> 'inherit',			// inherit, custom, none
					'marker2_reuse'					=> 'true',
					'marker2_title'					=> '',
					'marker2_content'				=> '',
					'marker2_popup'					=> 'false',
					'marker2_link'					=> 'false',
					'marker2_url'					=> '',
					'marker2_button'				=> (isset($this->TS_VCSC_Google_MapPLUS_Language['OtherLink'])			? $this->TS_VCSC_Google_MapPLUS_Language['OtherLink']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink']),
					// Infowindow Style
					'window_type'					=> 'global',			// global, google, override
					'window_shadow'					=> 'false',
					'window_background'				=> '#333333',
					'window_fontcolor'				=> '#ffffff',
					'window_arrowshow'				=> 'true',
					'window_arrowcolor'				=> '#333333',
					'window_maxwdidth'				=> 800,
					'window_offset'					=> 0,
					'window_closer'					=> 'topright',	
					// Other Settings
					'css'							=> '',
				), $atts ));
				
				$map_random                    		= mt_rand(999999, 9999999);
				$map_valid							= "false";
				$map_markers						= 2;
				$output 							= '';
				$window								= '';

				// Check for Missing Location
				if ((($curveline_startlat == "") || ($curveline_startlng == "") || ($curveline_endlat == "") || ($curveline_endlng == ""))) {
					$map_valid						= "false";
				} else {
					$map_valid						= "true";
				}
				if (($map_valid == "false") && ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false")) {
					echo $output;
					$myvariable 					= ob_get_clean();
					return $myvariable;
				}
				
				if (!empty($curveline_identifier)) {
					$curveline_elemid				= $curveline_identifier;
					$curveline_dataid				= $curveline_identifier;
				} else {
					$curveline_elemid				= 'ts-advanced-google-map-curveline-single-' . $map_random;
					$curveline_dataid				= 'map-curveline-single-' . $map_random;
				}
	
				// Link Values
				if (($marker1_link == "true") && ($marker1_url != '')) {
					$link1 							= TS_VCSC_Advancedlinks_GetLinkData($marker1_url);
					$a1_href						= $link1['url'];
					$a1_title 						= $link1['title'];
					$a1_target 						= $link1['target'];
					$a1_rel 						= $link1['rel'];
					if (!empty($a1_rel)) {
						$a1_rel 					= 'rel="' . esc_attr(trim($a1_rel)) . '"';
					}
				} else {
					$a1_href						= '';
					$a1_title 						= '';
					$a1_target 						= '';
					$a1_rel							= '';
				}
				if (($marker2_link == "true") && ($marker2_url != '')) {
					$link2 							= TS_VCSC_Advancedlinks_GetLinkData($marker2_url);
					$a2_href						= $link2['url'];
					$a2_title 						= $link2['title'];
					$a2_target 						= $link2['target'];
					$a2_rel 						= $link2['rel'];
					if (!empty($a2_rel)) {
						$a2_rel 					= 'rel="' . esc_attr(trim($a2_rel)) . '"';
					}
				} else {
					$a2_href						= '';
					$a2_title 						= '';
					$a2_target 						= '';
					$a2_rel							= '';
				}
				
				// Marker Titles
				if ($marker1_reuse == "true") {
					$marker1_title					= $curveline_title;
				}
				if ($marker2_reuse == "true") {
					$marker2_title					= $curveline_title;
				}

				// Start Marker Settings
				if ($marker1_style == "hide") {
					$map_markers--;
					$marker1_icon					= urlencode(TS_VCSC_GetResourceURL('images/defaults/default_mapmarker.png'));
				} else if (($marker1_style == "internal") && ($marker1_internal != '')) {
					$marker1_internal 				= $this->TS_VCSC_GoogleMapsPlus_Image($marker1_internal);
					$marker1_icon					= urlencode(TS_VCSC_GetResourceURL('images/marker/' . $marker1_internal));
				} else if (($marker1_style == "image") && ($marker1_image != '')) {
					$marker1_icon 					= wp_get_attachment_image_src($marker1_image, 'full');						
					$marker1_icon					= urlencode($marker1_icon[0]);
				} else if (($marker1_style == "external") && ($marker1_external != '')) {
					$marker1_icon					= $marker1_external;
				} else {
					$marker1_icon					= urlencode(TS_VCSC_GetResourceURL('images/defaults/default_mapmarker.png'));
				}
				if ($marker1_style == "internal") {
					$marker1_width					= 32;
					$marker1_height					= 37;
				} else if (($marker1_style == "image") || ($marker1_style == "external")) {
					$marker1_width					= $marker1_width;
					$marker1_height					= $marker1_height;
				} else if (($marker1_style == "hide") || ($marker1_style == "default")) {
					$marker1_width					= 32;
					$marker1_height					= 32;
				}
				$marker1_data						= 'data-marker1-style="' . $marker1_style . '" data-marker1-icon="' . $marker1_icon . '" data-marker1-width="' . $marker1_width . '" data-marker1-height="' . $marker1_height . '"';
				// End Marker Settings
				if ($marker2_style == "inherit") {
					$marker2_style					= $marker1_style;
					$marker2_icon					= $marker1_icon;
				} else if ($marker2_style == "hide") {
					$map_markers--;
					$marker2_icon					= urlencode(TS_VCSC_GetResourceURL('images/defaults/default_mapmarker.png'));
				} else if (($marker2_style == "internal") && ($marker2_internal != '')) {
					$marker2_internal 				= $this->TS_VCSC_GoogleMapsPlus_Image($marker2_internal);
					$marker2_icon					= urlencode(TS_VCSC_GetResourceURL('images/marker/' . $marker2_internal));
				} else if (($marker2_style == "image") && ($marker2_image != '')) {
					$marker2_icon 					= wp_get_attachment_image_src($marker2_image, 'full');						
					$marker2_icon					= urlencode($marker2_icon[0]);
				} else if (($marker2_style == "external") && ($marker2_external != '')) {
					$marker2_icon					= $marker2_external;
				} else {
					$marker2_icon					= urlencode(TS_VCSC_GetResourceURL('images/defaults/default_mapmarker.png'));
				}
				if ($marker2_style == "internal") {
					$marker2_width					= 32;
					$marker2_height					= 37;
				} else if (($marker2_style == "image") || ($marker2_style == "external")) {
					$marker2_width					= $marker2_width;
					$marker2_height					= $marker2_height;
				} else if (($marker2_style == "hide") || ($marker2_style == "default")) {
					$marker2_width					= 32;
					$marker2_height					= 32;
				}
				$marker2_data						= 'data-marker2-style="' . $marker2_style . '" data-marker2-icon="' . $marker2_icon . '" data-marker2-width="' . $marker2_width . '" data-marker2-height="' . $marker2_height . '"';
			
				// Create Data Strings
				$data_style							= 'data-style-strokergba="' . $style_stroke_rgba . '" data-style-strokeweight="' . $style_stroke_weight . '"';
				$data_window						= 'data-window-type="' . $window_type . '" data-window-offset="' . $window_offset . '" data-window-closer="' . $window_closer . '" data-window-maxwidth="' . $window_maxwdidth . '" data-window-shadow="' . $window_shadow . '" data-window-background="' . $window_background . '" data-window-fontcolor="' . $window_fontcolor . '" data-window-arrowshow="' . $window_arrowshow . '" data-window-arrowcolor="' . $window_arrowcolor . '" ';
				$data_total							= 'data-id="' . $curveline_dataid . '" data-processed="false" data-editable="' . $curveline_draggable . '" data-popup="false" data-output="' . $curveline_output . '" data-draggable="' . $curveline_draggable . '" data-group="' . $curveline_group . '" data-tags="' . $curveline_tags . '" data-title="' . $curveline_title . '" data-curveline-type="curveline" ' . $data_style . ' ' . $data_window . ' ';
				$data_total							.= 'data-curveline-markers="' . $map_markers . '" data-curveline-curvature="' . $curveline_curvature . '" data-curveline-position="' . $curveline_position . '" data-curveline-zindex="' . $curveline_zindex . '" data-curveline-startlat="' . $curveline_startlat . '" data-curveline-startlng="' . $curveline_startlng . '" data-curveline-endlat="' . $curveline_endlat . '" data-curveline-endlng="' . $curveline_endlng . '" ' . $marker1_data . ' ' . $marker2_data . '';
				
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-advanced-google-map-curveline-single ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_GoogleMapsPlus_Curveline', $atts);
				} else {
					$css_class						= 'ts-advanced-google-map-overlay-single';
				}
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					$output .= '<div id="' . $curveline_elemid . '" class="' . $css_class . '" ' . $data_total . '>';
						$output .= '<div id="ts-advanced-google-map-curveline-start-' . $map_random . '" class="ts-advanced-google-map-curveline-start" data-popup="' . $marker1_popup . '">';
							if ($marker1_window == "custom") {							
								if ($marker1_title != '') {
									$window .= '<div class="ts-advanced-google-map-curveline-title">' . $marker1_title . '</div>';
								}
								if (($marker1_content != '') || (($marker1_link == "true") && ($a1_href != ''))) {
									$window .= '<div class="ts-advanced-google-map-curveline-content">';
										if ($marker1_content != '') {
											$window .= do_shortcode(rawurldecode(base64_decode(strip_tags($marker1_content))));
										}
										if (($marker1_link == "true") && ($a1_href != '')) {
											$window .= '<div class="ts-advanced-google-map-curveline-controls">';
												$window .= '<a class="ts-advanced-google-map-curveline-link" href="' . $a1_href . '" target="' . $a1_target . '" title="' . $a1_title . '" ' . $a1_rel . '>' . $marker1_button . '</a>';
											$window .= '</div>';
										}
									$window .= '</div>';
								}
							}
							$output .= $window;
						$output .= '</div>';
						$output .= '<div id="ts-advanced-google-map-curveline-end-' . $map_random . '" class="ts-advanced-google-map-curveline-end" data-popup="' . $marker2_popup . '">';
							if (($marker2_window == "inherit") || ($marker2_window == "custom")) {
								if ($marker2_window == "inherit") {
									$output .= $window;
								} else {
									if ($marker2_title != '') {
										$output .= '<div class="ts-advanced-google-map-curveline-title">' . $marker2_title . '</div>';
									}
									if (($marker2_content != '') || (($marker2_link == "true") && ($a2_href != ''))) {
										$output .= '<div class="ts-advanced-google-map-curveline-content">';
											if ($marker2_content != '') {
												$output .= do_shortcode(rawurldecode(base64_decode(strip_tags($marker2_content))));
											}
											if (($marker2_link == "true") && ($a2_href != '')) {
												$output .= '<div class="ts-advanced-google-map-curveline-controls">';
													$output .= '<a class="ts-advanced-google-map-curveline-link" href="' . $a2_href . '" target="' . $a2_target . '" title="' . $a2_title . '" ' . $a2_rel . '>' . $marker2_button . '</a>';
												$output .= '</div>';
											}
										$output .= '</div>';
									}
								}
							}
						$output .= '</div>';
					$output .= '</div>';
					$output .= '<div id="ts-advanced-google-map-curveline-listing-' . $map_random . '" class="ts-advanced-google-map-curveline-listing ts-advanced-google-map-details-listing" data-id="' . $curveline_dataid . '" data-style="curveline" data-type="curveline" data-title="' . $curveline_title . '" data-group="' . $curveline_group . '" data-tags="' . $curveline_tags . '">';						
						$curveline_class = '';
						if ($curveline_featured != '') {
							$curveline_featured = wp_get_attachment_image_src($curveline_featured, 'thumbnail');
							if (isset($curveline_featured[0])) {
								$curveline_class = 'ts-advanced-google-map-featured-offset';
								$curveline_featured = "url('" . $curveline_featured[0] . "')";
								$output .= '<div style="background-image: ' . $curveline_featured . ';" class="ts-advanced-google-map-curveline-featured"></div>';
							}
						}						
						$output .= '<svg class="ts-advanced-google-map-curveline-icon ts-advanced-google-map-curveline-curveline ' . $curveline_class . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" style="stroke: ' . $style_stroke_rgba . '; stroke-width: ' . $style_stroke_weight . '; fill:none;">';
							$output .= '<path d="M24,32 Q32,0 0,' . $style_stroke_weight . '"/>';
						$output .= '</svg>';
						$output .= '<div class="ts-advanced-google-map-curveline-title ' . $curveline_class . '">' . $curveline_title . '</div>';
						if ($curveline_group != "") {
							$output .= '<div class="ts-advanced-google-map-curveline-groups ' . $curveline_class . '">' . str_replace(array("|", " , "), array(", ", ", "), $curveline_group) . '</div>';
						} else {
							$output .= '<div class="ts-advanced-google-map-curveline-groups ' . $curveline_class . '">...</div>';
						}
						if ($curveline_tags != "") {
							$output .= '<div class="ts-advanced-google-map-curveline-tags ' . $curveline_class . '">' . str_replace(array("|", " , "), array(", ", ", "), $curveline_tags) . '</div>';
						} else {
							$output .= '<div class="ts-advanced-google-map-curveline-tags ' . $curveline_class . '">...</div>';
						}
					$output .= '</div>';
				} else {
					$output .= '<div class="ts-advanced-google-map-settings-edit-curveline">';
						$output .= '<svg class="ts-advanced-google-map-curveline-icon ts-advanced-google-map-curveline-curveline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" style="stroke: ' . $style_stroke_rgba . '; stroke-width: ' . $style_stroke_weight . '; fill:none;">';
							$output .= '<path d="M24,32 Q32,0 0,' . $style_stroke_weight . '"/>';
						$output .= '</svg>';
						$output .= '<div class="ts-advanced-google-map-settings-edit-excerpt">';
							$output .= 'Title: ' . ($curveline_title != '' ? $curveline_title : 'N/A') . '<br/>';
							$output .= 'Group: ' . ($curveline_group != '' ? $curveline_group : 'N/A') . '<br/>';
						$output .= '</div>';
					$output .= '</div>';
				}
				
				echo $output;
				
				$myvariable 						= ob_get_clean();
				return $myvariable;
			}
			
			// Google Maps Container
			function TS_VCSC_GoogleMapsPlus_Container ($atts, $content = null) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
				
				extract( shortcode_atts( array(
					// Main Settings
					'googlemap_api'					=> 'true',
					'googlemap_openlayers'			=> 'true',
					'googlemap_listeners'			=> 'false',
					'googlemap_external'			=> 'false',
					'googlemap_type'				=> 'ROAD',
					'googlemap_style'				=> 'style_default',				
					'googlemap_snazzytitle'			=> '',
					'googlemap_snazzycode'			=> '',
					'googlemap_pois'				=> 'default',
					'googlemap_resize'				=> '',
					'googlemap_height'				=> 450,					
					'googlemap_street'				=> 450,
					'googlemap_splitview'			=> "false",
					'googlemap_splitwidth'			=> 250,
					'googlemap_delay'				=> 200,
					'googlemap_clusters'			=> 'false',
					'googlemap_singleinfo'			=> 'true',
					'googlemap_metric'				=> 'false',
					'googlemap_tiles'				=> 'false',
					'googlemap_mobile'				=> 'false',
					'googlemap_full'				=> 'false',					
					'googlemap_breaks'				=> 0,					
					'googlemap_zoom'				=> 12,
					'googlemap_localize'			=> 'false',
					'googlemap_language'			=> 'en',
					'googlemap_region'				=> 'US',
					// Debug Mode
					'debug_enabled'					=> 'false',
					'debug_output'					=> 'console',
					// Map Center					
					'center_type'					=> 'markers',			// markers, coordinates, address, fitall, dynamic
					'center_address'				=> '',
					'center_latitude'				=> '',
					'center_longitude'				=> '',
					'center_dynamic'				=> '%5B%7B%22center_width%22%3A%224096%22%2C%22center_type%22%3A%22markers%22%2C%22center_zoom%22%3A%2212%22%7D%5D',
					// Preloader Settings
					'preloader_use'					=> 'false',
					'preloader_style'				=> 0,
					'preloader_background'			=> '#ffffff',
					// Marker Import
					'import_json_marker'			=> 'false',
					'import_path_marker'			=> '',
					'import_height_marker'			=> 32,
					'import_width_marker'			=> 32,
					// KML File Import
					'import_kml_file'				=> 'false',
					'import_kml_path'				=> '',
					// Marker Export
					'export_button_use'				=> 'false',
					'export_button_title'			=> 'Download Markers via CSV',
					'export_button_icon'			=> 'false',
					'export_file_header'			=> 'true',
					'export_file_name'				=> 'mapmarkerexport',
					'export_file_scope'				=> 'id,title,group,address,latitude,longitude,description',
					// Cluster Settings
					'clusterer_curves'				=> 'false',
					'clusterer_type'				=> 'default', 			// default, pins, singlepin, people, conversations, hearts, custom
					'clusterer_custom'				=> 1,
					'clusterer_level1_image'		=> '',
					'clusterer_level1_color'		=> '#ffffff',
					'clusterer_level1_values'		=> 'width:52;height:52;fontsize:11;offsetx:0;offsety:0;',
					'clusterer_level2_image'		=> '',
					'clusterer_level2_color'		=> '#ffffff',
					'clusterer_level2_values'		=> 'width:58;height:58;fontsize:12;offsetx:0;offsety:0;',
					'clusterer_level3_image'		=> '',
					'clusterer_level3_color'		=> '#ffffff',
					'clusterer_level3_values'		=> 'width:66;height:66;fontsize:13;offsetx:0;offsety:0;',
					'clusterer_level4_image'		=> '',
					'clusterer_level4_color'		=> '#ffffff',
					'clusterer_level4_values'		=> 'width:78;height:78;fontsize:14;offsetx:0;offsety:0;',
					'clusterer_level5_image'		=> '',
					'clusterer_level5_color'		=> '#ffffff',
					'clusterer_level5_values'		=> 'width:90;height:90;fontsize:17;offsetx:0;offsety:0;',
					// Map Controls
					'controls_styler'				=> 'false',
					'controls_groups'				=> 'false',
					'controls_tags'					=> 'false',
					'controls_select'				=> 'false',				// false, true, detail, combo
					'controls_search'				=> 'false',
					'controls_street'				=> 'true',
					'controls_scaler'				=> 'true',
					'controls_pan'					=> 'true',
					'controls_zoomer'				=> 'true',
					'controls_wheel'				=> 'auto',
					'controls_gesture'				=> 'auto',
					'controls_types'				=> 'true',
					'controls_home'					=> 'true',
					'controls_bounds'				=> 'false',
					'controls_fullscreen'			=> 'false',
					// Controls Container					
					'controls_background'			=> '#f9f9f9',
					'controls_autoopen'				=> 'true',
					'controls_togglecolor'			=> '#696969',
					// Sumo Float Width
					'controls_floatwidth'			=> 400,
					// Styler Options
					'styler_screenlimit'			=> 400,
					'styler_search'					=> 'true',
					// Filter Options
					'filter_screenlimit'			=> 400,
					'filter_multiple'				=> 'false',
					'filter_confirm'				=> 'true',
					'filter_search'					=> 'true',
					'filter_initialmultiple'		=> '',
					'filter_initialsingle'			=> '',
					'filter_zoomlevel'				=> 21,
					// Selector Option
					'locator_screenlimit'			=> 400,
					'locator_search'				=> 'true',
					'locator_autoopen'				=> 'true',
					'locator_listingheight'			=> 400,
					'locator_listingitemback'		=> '#f9f9f9',
					'locator_listingsearchback'		=> '#ffffff',
					'locator_listingprettybar'		=> 'true',
					'locator_listingfeatured'		=> 'true',
					'locator_zoomlevel'				=> 17,
					'locator_mapmarker'				=> 'ROADMAP',
					'locator_mapoverlay'			=> 'TERRAIN',					
					// Search Options
					'search_screenlimit'			=> 400,
					'search_infowindow'				=> 'true',
					'search_autoopen'				=> 'true',
					'search_googlelinks'			=> 'true',
					'search_addselector'			=> 'true',
					'search_zoomlevel'				=> 17,
					'search_maptype'				=> 'ROADMAP',
					// Infowindow Style
					'window_global'					=> 'google',			// google, override
					'window_shadow'					=> 'false',
					'window_background'				=> '#333333',
					'window_fontcolor'				=> '#ffffff',
					'window_arrowshow'				=> 'true',
					'window_arrowcolor'				=> '#333333',
					'window_maxwdidth'				=> 800,
					'window_offset'					=> 0,
					'window_closer'					=> 'topright',
					'window_mapclick'				=> 'false',
					// Draggable Breakpoint
					'draggable_allow'				=> 'toggle', 			// toggle, all, desktop, mobile, screen, none
					'draggable_width'				=> 400,
					// Layer Settings
					'layers_biking'					=> 'true',
					'layers_traffic'				=> 'true',
					'layers_transit'				=> 'false',
					// Language Settings
					'string_mobile_show'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['MobileShow'])				? $this->TS_VCSC_Google_MapPLUS_Language['MobileShow']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['MobileShow']),
					'string_mobile_hide'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['MobileHide'])				? $this->TS_VCSC_Google_MapPLUS_Language['MobileHide']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['MobileHide']),
					'string_listeners_start'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ListenersStart'])			? $this->TS_VCSC_Google_MapPLUS_Language['ListenersStart']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListenersStart']),
					'string_listeners_stop'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ListenersStop'])			? $this->TS_VCSC_Google_MapPLUS_Language['ListenersStop']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListenersStop']),
					'string_filter_all'				=> (isset($this->TS_VCSC_Google_MapPLUS_Language['FilterAll'])				? $this->TS_VCSC_Google_MapPLUS_Language['FilterAll']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['FilterAll']),
					'string_filter_label'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['FilterLabel'])			? $this->TS_VCSC_Google_MapPLUS_Language['FilterLabel']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['FilterLabel']),
					'string_select_label'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SelectLabel'])			? $this->TS_VCSC_Google_MapPLUS_Language['SelectLabel']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SelectLabel']),
					'string_style_default'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['StyleDefault'])			? $this->TS_VCSC_Google_MapPLUS_Language['StyleDefault']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['StyleDefault']),
					'string_style_label'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['StyleLabel'])				? $this->TS_VCSC_Google_MapPLUS_Language['StyleLabel']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['StyleLabel']),
					'string_controls_osm'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsOSM'])			? $this->TS_VCSC_Google_MapPLUS_Language['ControlsOSM']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsOSM']),
					'string_controls_home'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsHome'])			? $this->TS_VCSC_Google_MapPLUS_Language['ControlsHome']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsHome']),
					'string_controls_bounds'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsBounds'])			? $this->TS_VCSC_Google_MapPLUS_Language['ControlsBounds']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsBounds']),
					'string_controls_bike'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsBike'])			? $this->TS_VCSC_Google_MapPLUS_Language['ControlsBike']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsBike']),
					'string_controls_traffic'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsTraffic'])		? $this->TS_VCSC_Google_MapPLUS_Language['ControlsTraffic']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsTraffic']),
					'string_controls_transit'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsTransit'])		? $this->TS_VCSC_Google_MapPLUS_Language['ControlsTransit']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsTransit']),
					'string_traffic_miles'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['TrafficMiles'])			? $this->TS_VCSC_Google_MapPLUS_Language['TrafficMiles']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficMiles']),
					'string_traffic_kilometer'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['TrafficKilometer'])		? $this->TS_VCSC_Google_MapPLUS_Language['TrafficKilometer']	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficKilometer']),
					'string_traffic_none'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['TrafficNone'])			? $this->TS_VCSC_Google_MapPLUS_Language['TrafficNone']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficNone']),
					'string_search_button'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchButton'])			? $this->TS_VCSC_Google_MapPLUS_Language['SearchButton']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchButton']),
					'string_search_holder'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchHolder'])			? $this->TS_VCSC_Google_MapPLUS_Language['SearchHolder']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchHolder']),
					'string_search_google'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchGoogle'])			? $this->TS_VCSC_Google_MapPLUS_Language['SearchGoogle']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchGoogle']),
					'string_search_directions'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchDirections'])		? $this->TS_VCSC_Google_MapPLUS_Language['SearchDirections']	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchDirections']),
					'string_search_group'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchGroup'])			? $this->TS_VCSC_Google_MapPLUS_Language['SearchGroup']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchGroup']),
					'string_other_link'				=> (isset($this->TS_VCSC_Google_MapPLUS_Language['OtherLink'])				? $this->TS_VCSC_Google_MapPLUS_Language['OtherLink']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink']),
					'string_marker_placeholder'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['PlaceholderMarker'])		? $this->TS_VCSC_Google_MapPLUS_Language['PlaceholderMarker']	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['PlaceholderMarker']),
					// Sumo Text Strings
					'string_sumo_confirm'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoConfirm'])			? $this->TS_VCSC_Google_MapPLUS_Language['SumoConfirm']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoConfirm']),
					'string_sumo_cancel'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoCancel'])				? $this->TS_VCSC_Google_MapPLUS_Language['SumoCancel']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoCancel']),
					'string_sumo_selected'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSelected'])			? $this->TS_VCSC_Google_MapPLUS_Language['SumoSelected']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSelected']),
					'string_sumo_allselected'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoAllSelected'])		? $this->TS_VCSC_Google_MapPLUS_Language['SumoAllSelected']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoAllSelected']),
					'string_sumo_placeholder'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoPlaceholder'])		? $this->TS_VCSC_Google_MapPLUS_Language['SumoPlaceholder']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoPlaceholder']),
					'string_sumo_searchmarker'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSearchLocations'])	? $this->TS_VCSC_Google_MapPLUS_Language['SumoSearchLocations']	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchLocations']),
					'string_sumo_searchgroup'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSearchGroups'])		? $this->TS_VCSC_Google_MapPLUS_Language['SumoSearchGroups']	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchGroups']),
					'string_sumo_searchstyle'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSearchStyles'])		? $this->TS_VCSC_Google_MapPLUS_Language['SumoSearchStyles']	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchStyles']),
					// Detail Listing Strings
					'string_listings_button'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ListingsButton'])			? $this->TS_VCSC_Google_MapPLUS_Language['ListingsButton']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListingsButton']),
					'string_listings_search'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ListingsSearch'])			? $this->TS_VCSC_Google_MapPLUS_Language['ListingsSearch']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListingsSearch']),
					// Other Settings
					'margin_top'                    => 0,
					'margin_bottom'                 => 0,
					'el_id' 						=> '',
					'el_class'                  	=> '',
					'css'							=> '',
				), $atts ));
				
				$map_random                    		= mt_rand(999999, 9999999);
				$output 							= '';

				wp_enqueue_style('dashicons');
				wp_enqueue_style('ts-extend-sumo');
				wp_enqueue_script('ts-extend-sumo');
				if ($locator_listingprettybar == "true") {
					wp_enqueue_style('ts-extend-perfectscrollbar');
					wp_enqueue_script('ts-extend-perfectscrollbar');
				}
				wp_enqueue_style('ts-visual-composer-extend-front');
				wp_enqueue_script('ts-visual-composer-extend-front');
				wp_enqueue_style('ts-extend-googlemapsplus');
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					if ($googlemap_api == "true") {
						if ($googlemap_localize == "true") {
							$this->TS_VCSC_GoogleMapsPlus_LoadAPI($googlemap_language, $googlemap_region);
						} else {
							wp_enqueue_script('ts-extend-mapapi-library');
						}
					}
					if (($googlemap_clusters == "true") && (($content != '') || (($import_json_marker == "true") && ($import_path_marker != '')))) {
						wp_enqueue_script('ts-extend-markerclusterer');
					}
					wp_enqueue_script('ts-extend-googlemapsplus');
				}
				
				if (!empty($el_id)) {
					$map_id			    			= $el_id;
				} else {
					$map_id			    			= 'ts-advanced-google-map-container-' . $map_random;
				}			
	
				
				// Contingency Checks
				if ($googlemap_listeners == "true") {
					$googlemap_singleinfo			= "true";
					$window_global					= "google";
					$window_mapclick				= "false";
				}
				if ($filter_multiple == "true") {
					$filter_initial					= trim($filter_initialmultiple);
				} else {
					$filter_initial					= trim($filter_initialsingle);
				}
				$filter_initial 					= rtrim($filter_initial, ',');
				if (($controls_select == "detail") || ($controls_select == "combo")) {
					$controls_listings				= "true";
				} else {
					$controls_listings				= "false";
				}
				if (($controls_select == "true") || ($controls_select == "combo")) {
					$controls_select				= "true";
				} else {
					$controls_select				= "false";
				}
				
				// Dynamic Center Rules
				if ($center_type == "dynamic") {
					$dynamic_groups					= array();
					$dynamic_types					= '';
					if (isset($center_dynamic) && strlen($center_dynamic) > 0 ) {			
						$dynamic_entries 			= json_decode(urldecode($center_dynamic), true);
						if (!is_array($dynamic_entries)) {
							$dynamic_entries		= array();
						} else {
							$dynamic_entries		= TS_VCSC_SortMultiArray($dynamic_entries, 'center_width');
							$dynamic_entries 		= array_reverse($dynamic_entries);
						}
						$dynamic_entries			= urlencode(json_encode($dynamic_entries));
					}
				} else {
					$dynamic_entries				= urlencode(json_encode(array()));
				}
				
				// WP Bakery Page Builder Styling Override
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-advanced-google-map-container ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_GoogleMapsPlus_Container', $atts);
				} else {
					$css_class						= 'ts-advanced-google-map-container ' . $el_class;
				}
				
				// Compile Clusterer Data
				if ($clusterer_type == "custom") {
					$clusterer_count				= $clusterer_custom;
					$clusterer_data					= array();
					$clusterer_image				= "";
					$clusterer_values				= array();
					$clusterer_width				= 0;
					$clusterer_height				= 0;					
					$clusterer_fontsize				= 0;
					$clusterer_offsetx				= 0;
					$clusterer_offsety				= 0;
					for ($x = 1; $x <= $clusterer_custom; $x++) {
						if (${"clusterer_level{$x}_image"} != "") {
							$clusterer_image		= wp_get_attachment_image_src(${"clusterer_level{$x}_image"}, 'full');
							if (($clusterer_image[0] != "null") && ($clusterer_image[0] != "") && ($clusterer_image[0] != null)) {
								$clusterer_image	= $clusterer_image[0];
							} else {
								$clusterer_image	= "";
							}
							if ($clusterer_image != "") {
								$clusterer_values 	= explode(";", ${"clusterer_level{$x}_values"});
								$clusterer_width	= (isset($clusterer_values[0]) ? explode(":", $clusterer_values[0]) : 0);
								$clusterer_height	= (isset($clusterer_values[1]) ? explode(":", $clusterer_values[1]) : 0);			
								$clusterer_fontsize	= (isset($clusterer_values[2]) ? explode(":", $clusterer_values[2]) : 0);
								$clusterer_offsetx	= (isset($clusterer_values[3]) ? explode(":", $clusterer_values[3]) : 0);
								$clusterer_offsety	= (isset($clusterer_values[4]) ? explode(":", $clusterer_values[4]) : 0);
								$clusterer_data[$x - 1] = array(
									'url'			=> urlencode($clusterer_image),
									'height'		=> $clusterer_height[1],
									'width'			=> $clusterer_width[1],
									'textColor'		=> ${"clusterer_level{$x}_color"},
									'textSize'		=> $clusterer_fontsize[1],
									'anchorText'	=> array($clusterer_offsety[1], $clusterer_offsetx[1]),
									'anchorIcon'	=> array(round($clusterer_width[1]/2), round($clusterer_height[1]/2)),
								);
							} else {
								$clusterer_count--;
							}
						} else {
							$clusterer_count--;
						}
					}
					if (($clusterer_count == 0) || (count($clusterer_data) == 0)) {
						$clusterer_type				= "default";
						$clusterer_data				= "";
					} else {
						$clusterer_data				= json_encode($clusterer_data, JSON_NUMERIC_CHECK);
						$clusterer_data				= base64_encode($clusterer_data);
					}					
				} else {
					$clusterer_count				= 0;
					$clusterer_data					= "";
				}
				
				// Compile Main Data
				$map_data							= 'data-initialized="false" data-mapheight="' . $googlemap_height . '" data-singleinfo="' . $googlemap_singleinfo . '" data-loadapi="' . $googlemap_api . '" data-listeners="' . $googlemap_listeners . '" data-externalwatch="' . $googlemap_external . '" data-delay="' . $googlemap_delay . '" data-mapsearch="' . $controls_search . '" data-activate="' . $googlemap_mobile . '" data-metric="' . $googlemap_metric . '" data-center-type="' . $center_type . '" data-center-latitude="' . ($center_type == 'coordinates' ? $center_latitude : '') . '" data-center-longitude="' . ($center_type == 'coordinates' ? $center_longitude : '') . '" data-center-address="' . ($center_type == 'address' ? $center_address : '') . '" data-center-dynamic="' . $dynamic_entries . '" data-zoom="' . $googlemap_zoom . '" data-maptype="' . $googlemap_type . '" data-mapstyle="' . $googlemap_style . '" data-poistyle="' . $googlemap_pois . '" data-openlayers="' . $googlemap_openlayers . '" data-mapresize="' . $googlemap_resize . '" data-debug-enabled="' . $debug_enabled . '" data-debug-output="' . $debug_output . '"';
				$map_preloader						= 'data-preloader-use="' . $preloader_use . '"';
				$map_marker							= 'data-marker-default="' . urlencode(TS_VCSC_GetResourceURL('images/defaults/default_mapmarker.png')) . '" data-marker-height="37" data-marker-width="32"';
				$map_clusterer						= 'data-mapclusters="' . $googlemap_clusters . '" data-clusterer-curves="' . $clusterer_curves . '" data-clusterer-type="' . $clusterer_type . '" data-clusterer-path="' . TS_VCSC_GetResourceURL('images/clusterer') . '" data-clusterer-custom="' . $clusterer_count . '" data-clusterer-data="' . $clusterer_data . '" ';
				$map_street							= 'data-street-split="' . $googlemap_splitview . '" data-street-width="' . $googlemap_splitwidth . '" data-street-height="' . $googlemap_height . '"';
				$map_controls						= 'data-controls-floatwidth="' . $controls_floatwidth . '" data-controls-listings="' . $controls_listings . '" data-controls-fullscreen="' . $controls_fullscreen . '" data-controls-home="' . $controls_home . '" data-controls-bounds="' . $controls_bounds . '" data-controls-types="' . $controls_types . '" data-controls-pan="' . $controls_pan . '" data-controls-zoomer="' . $controls_zoomer . '" data-controls-gesture="' . $controls_gesture . '" data-controls-wheel="' . $controls_wheel . '" data-controls-styler="' . $controls_styler . '" data-controls-groups="' . $controls_groups . '" data-controls-tags="' . $controls_tags . '" data-controls-select="' . $controls_select . '" data-controls-street="' . $controls_street . '" data-controls-scaler="' . $controls_scaler . '"';
				$map_filter							= 'data-filter-screenlimit="' . $filter_screenlimit . '" data-filter-zoomlevel="' . $filter_zoomlevel . '" data-filter-multiple="' . $filter_multiple . '" data-filter-confirm="' . $filter_confirm . '" data-filter-search="' . $filter_search . '" data-filter-initial="' . $filter_initial . '"';
				$map_styler							= 'data-styler-screenlimit="' . $styler_screenlimit . '" data-styler-search="' . $styler_search . '"';
				$map_locator						= 'data-locator-screenlimit="' . $locator_screenlimit . '" data-locator-search="' . $locator_search . '" data-locator-autoopen="' . $locator_autoopen . '" data-locator-zoomlevel="' . $locator_zoomlevel . '" data-locator-mapmarker="' . $locator_mapmarker . '" data-locator-mapoverlay="' . $locator_mapoverlay . '"';
				$map_sumostrings					= 'data-sumo-confirm="' . $string_sumo_confirm . '" data-sumo-cancel="' . $string_sumo_cancel . '" data-sumo-selected="' . $string_sumo_selected . '" data-sumo-allselected="' . $string_sumo_allselected . '" data-sumo-placeholder="' . $string_sumo_placeholder . '" data-sumo-searchmarker="' . $string_sumo_searchmarker . '" data-sumo-searchgroup="' . $string_sumo_searchgroup . '" data-sumo-searchstyle="' . $string_sumo_searchstyle . '"';
				$map_search							= 'data-search-screenlimit="' . $search_screenlimit . '" data-search-window="' . $search_infowindow . '" data-search-open="' . $search_autoopen . '" data-search-links="' . $search_googlelinks . '" data-search-selector="' . $search_addselector . '" data-search-zoomlevel="' . $search_zoomlevel . '" data-search-maptype="' . $search_maptype . '"';
				$map_draggable						= 'data-draggable-allow="' . $draggable_allow . '" data-draggable-width="' . $draggable_width . '"';
				$map_layers							= 'data-layers-biking="' . $layers_biking . '" data-layers-traffic="' . $layers_traffic . '" data-layers-transit="' . $layers_transit . '"';
				$map_fullwidth						= 'data-fullwidth="' . $googlemap_full . '" data-break-parents="' . $googlemap_breaks . '"';
				$map_listing						= 'data-listing-prettybar="' . $locator_listingprettybar . '" data-listing-featured="' . $locator_listingfeatured . '"';
				if ($googlemap_style != "style_snazzyimport") {
					$googlemap_snazzytitle			= '';
					$googlemap_snazzycode			= '';
				}
				$map_snazzystyle					= 'data-snazzy-import="' . ($googlemap_style == "style_snazzyimport" ? "true" : "false") . '" data-snazzy-title="' . $googlemap_snazzytitle . '" data-snazzy-code="' . $googlemap_snazzycode . '"';
				if ($import_json_marker == "false") {
					$import_path_marker				= '';
				}
				$map_import							= 'data-import-markerjson="' . $import_json_marker . '" data-import-markerpath="' . $import_path_marker . '" data-import-markerheight="' . $import_height_marker . '" data-import-markerwidth="' . $import_width_marker . '" data-import-kmlfile="' . $import_kml_file . '" data-import-kmlpath="' . $import_kml_path . '"';
				$map_export							= 'data-export-use="' . $export_button_use . '" data-export-title="' . $export_button_title . '" data-export-icononly="' . $export_button_icon . '" data-export-filename="' . $export_file_name . '" data-export-fileheader="' . $export_file_header . '" data-export-filescope="' . $export_file_scope . '"';
				$map_window							= 'data-window-global="' . $window_global . '" data-window-offset="' . $window_offset . '" data-window-mapclick="' . $window_mapclick . '" data-window-closer="' . $window_closer . '" data-window-maxwidth="' . $window_maxwdidth . '" data-window-shadow="' . $window_shadow . '" data-window-background="' . $window_background . '" data-window-fontcolor="' . $window_fontcolor . '" data-window-arrowshow="' . $window_arrowshow . '" data-window-arrowcolor="' . $window_arrowcolor . '"';
				
				// Compile Language Settings
				$map_language						= 'data-string-otherlink="' . $string_other_link . '" data-string-markerplaceholder="' . $string_marker_placeholder . '" ';			
				$map_language						.= 'data-string-mobileshow="' . $string_mobile_show . '" data-string-mobilehide="' . $string_mobile_hide . '" data-string-listenersstart="' . $string_listeners_start . '" data-string-listenersstop="' . $string_listeners_stop . '" ';
				$map_language						.= 'data-string-filterall="' . $string_filter_all . '" data-string-filterlabel="' . $string_filter_label . '" data-string-selectlabel="' . $string_select_label . '" ';	
				$map_language						.= 'data-string-styledefault="' . $string_style_default . '" data-string-stylelabel="' . $string_style_label . '" ';
				$map_language						.= 'data-string-controlsosm="' . $string_controls_osm . '" data-string-controlshome="' . $string_controls_home . '" data-string-controlsbounds="' . $string_controls_bounds . '" data-string-controlsbike="' . $string_controls_bike . '" data-string-controlstraffic="' . $string_controls_traffic . '" data-string-controlstransit="' . $string_controls_transit . '" ';
				$map_language 						.= 'data-string-trafficmiles="' . $string_traffic_miles . '" data-string-traffickilometers="' . $string_traffic_kilometer . '" data-string-trafficnone="' . $string_traffic_none . '" ';
				$map_language 						.= 'data-string-searchgroup="' . $string_search_group . '" data-string-searchbutton="' . $string_search_button . '" data-string-searchholder="' . $string_search_holder . '" data-string-searchgoogle="' . $string_search_google . '" data-string-searchdirect="' . $string_search_directions . '"';
				$map_language						.= 'data-string-listingbutton="' . $string_listings_button . '" data-string-listingsearch="' . $string_listings_search . '"';
				
				// Compile Map Attributes
				$map_attributes						= $map_data . ' ' . $map_preloader . ' ' . $map_marker . ' ' . $map_clusterer . ' ' . $map_street . ' ' . $map_controls . ' ' . $map_filter . ' ' . $map_styler . ' ' . $map_locator . ' ' . $map_sumostrings . ' ' . $map_search . ' ' . $map_draggable . ' ' . $map_layers . ' ' . $map_window . ' ' . $map_import . ' ' . $map_export . ' ' . $map_snazzystyle . ' ' . $map_language . ' ' . $map_listing;

				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					$output .= '<div id="' . $map_id . '" class="' . $css_class . '" data-urlcheck="' . $map_id . '" data-random="' . $map_random . '" ' . $map_fullwidth . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						if ($preloader_use == "true") {
							$output .= '<div id="ts-advanced-google-map-preloader-' . $map_random . '" class="ts-advanced-google-map-preloader" style="height: ' . $googlemap_height . 'px; background: ' . $preloader_background . ';">';
								$output .= TS_VCSC_CreatePreloaderCSS("ts-advanced-google-map-loader-" . $map_random, "", $preloader_style, "true");
							$output .= '</div>';
						}
						$output .= '<div id="ts-advanced-google-map-errors-' . $map_random . '" class="ts-advanced-google-map-errors" style="display: none;"></div>';
						$output .= '<div id="ts-advanced-google-map-contents-' . $map_random . '" class="ts-advanced-google-map-contents" style="display: none;">';
							$output .= do_shortcode($content);
						$output .= '</div>';						
						if (($controls_styler == "false") && ($controls_groups == "false") && ($controls_tags == "false") && ($controls_select == "false") && ($controls_search == "false")) {
							$controls_class			= "ts-advanced-google-map-novisibility";
							$controls_style			= "display: none; background: " . $controls_background . ";";
						} else {
							$controls_class			= "";
							$controls_style			= "display: " . ($preloader_use == "true" ? "none" : "block") . "; background: " . $controls_background . ";";
						}
						if ($controls_autoopen == "false") {
							$controls_class			.= ' ts-advanced-google-map-collapsed';
							$controls_toggle		= 'ts-advanced-google-map-toggleshow';
						} else {
							$controls_toggle		= 'ts-advanced-google-map-togglehide';
						}
						$output .= '<div id="ts-advanced-google-map-controls-' . $map_random . '" class="ts-advanced-google-map-controls ' . $controls_class . '" style="' . $controls_style . '"><div class="ts-advanced-google-map-togglemain ' . $controls_toggle . '" style="color: ' . $controls_togglecolor . ';"></div></div>';
						$output .= '<div id="ts-advanced-google-map-directions-' . $map_random . '" class="ts-advanced-google-map-directions ts-advanced-google-map-novisibility" style="display: none;"></div>';
						if ($googlemap_listeners == "true") {
							$output .= '<div id="ts-advanced-google-map-listeners-' . $map_random . '" class="ts-advanced-google-map-listeners" style="display: block;" data-visible="true">';					
								$output .= '<table id="ts-advanced-google-map-listeners-details-' . $map_random . '" class="ts-advanced-google-map-listeners-details"><tbody>
									<tr>
										<td width="120">Mouse Position:</td>
										<td width="200" id="d_mouseLatLon" class="ts-advanced-google-map-listeners-details-mouseposition">N/A</td>
										<td width="40">&nbsp;</td>
										<td width="120">Map Center:</td>
										<td width="200" id="d_mapcenter" class="ts-advanced-google-map-listeners-details-mapcenter">N/A</td>
									</tr>
									<tr>
										<td>Mouse Tile:</td>
										<td class="ts-advanced-google-map-listeners-details-mousetile">N/A</td>
										<td></td>
										<td>Map NE:</td>
										<td class="ts-advanced-google-map-listeners-details-mapnortheast">N/A</td>
									</tr>
									<tr>
										<td>Mouse Pixels:</td>
										<td class="ts-advanced-google-map-listeners-details-mousepixels">N/A</td>
										<td></td>
										<td>Map SW:</td>
										<td class="ts-advanced-google-map-listeners-details-mapsouthwest">N/A</td>
									</tr>
									<tr>
										<td>Mouse Click Coordinates:</td>
										<td class="ts-advanced-google-map-listeners-details-mouseclick">N/A</td>
										<td></td>
										<td>Map Zoom:</td>
										<td class="ts-advanced-google-map-listeners-details-mapzoom">N/A</td>
									<tr>
										<td>Mouse Click Address (Approximated):</td>
										<td colspan="4" class="ts-advanced-google-map-listeners-details-mouseaddress">N/A</td>
									</tr>								
								</tbody></table>';					
							$output .= '</div>';
						}
						$output .= '<div id="ts-advanced-google-map-streetview-' . $map_random . '" class="ts-advanced-google-map-streetview ts-advanced-google-map-novisibility" style="height: 0px;"></div>';
						$output .= '<div id="ts-advanced-google-map-wrapper-' . $map_random . '" class="ts-advanced-google-map-wrapper ' . ($googlemap_tiles == 'true' ? 'ts-advanced-google-map-tiled' : '') . '" style="height: ' . $googlemap_height . 'px;" ' . $map_attributes . '></div>';
						$output .= '<div id="ts-advanced-google-map-listings-' . $map_random . '" class="ts-advanced-google-map-listings" style="display: none;">';
							$output .= '<div class="ts-advanced-google-map-listings-overlay" style="display: none;"></div>';
							$output .= '<div class="ts-advanced-google-map-listings-search" style="background: ' . $locator_listingsearchback . ';">';
								$output .= '<input type="text" id="ts-advanced-google-map-listings-input-' . $map_random . '" class="ts-advanced-google-map-listings-input" placeholder="' . $string_listings_search . '">';								
								$output .= '<div id="ts-advanced-google-map-listings-cancel-' . $map_random . '" class="ts-advanced-google-map-listings-cancel" style="display: none;"></div>';
								$output .= '<div id="ts-advanced-google-map-listings-button-' . $map_random . '" class="ts-advanced-google-map-listings-button">' . $string_listings_button . '</div>';
							$output .= '</div>';
							$output .= '<div class="ts-advanced-google-map-listings-locations" style="max-height: ' . $locator_listingheight . 'px; background: ' . $locator_listingitemback . ';"></div>';
						$output .= '</div>';
					$output .= '</div>';
				} else {
					$output .= '<div id="' . $map_id . '" class="ts-advanced-google-map-container-edit" style="margin-top: 40px; margin-bottom: 40px;">';
						$output .= '<div class="ts-advanced-google-map-settings-edit-main">';
							$output .= '<img class="ts-advanced-google-map-settings-edit-image" src="' . TS_VCSC_GetResourceURL('images/defaults/default_googlemap.jpg') . '">';
							$output .= '<div class="ts-advanced-google-map-settings-edit-values">';
								$output .= 'Map Type: ' . $googlemap_type . '<br/>';
								$output .= 'Map Height: ' . $googlemap_height . 'px<br/>';
								$output .= 'Initial Zoom: ' . $googlemap_zoom . '<br/>';
								if ($center_type == 'coordinates') {
									$output .= 'Map Center (Coordinates): Latitude ' . ($center_latitude != '' ? $center_latitude : 'N/A') . ' / Longitude ' . ($center_longitude != '' ? $center_longitude : 'N/A') . '<br/>';								
								} else if ($center_type == 'address') {
									$output .= 'Map Center (Address): ' . ($center_address != '' ? $center_address : 'N/A') . '<br/>';
								} else if ($center_type == 'markers') {
									$output .= 'Map Center: Set automatically based on map markers.';
								}
							$output .= '</div>';
						$output .= '</div>';
						$output .= '<div class="ts-advanced-google-map-settings-edit-content">';
							$output .= do_shortcode($content);
						$output .= '</div>';
					$output .= '</div>';
				}
				
				echo $output;
				
				unset($map_attributes);
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
			
			// Google Maps Single
			function TS_VCSC_GoogleMapsPlus_Single ($atts, $content = null) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
				
				extract( shortcode_atts( array(
					// Main Settings
					'googlemap_api'					=> 'true',
					'googlemap_openlayers'			=> 'true',
					'googlemap_listeners'			=> 'false',
					'googlemap_external'			=> 'false',
					'googlemap_type'				=> 'ROAD',
					'googlemap_style'				=> 'style_default',				
					'googlemap_snazzytitle'			=> '',
					'googlemap_snazzycode'			=> '',
					'googlemap_pois'				=> 'default',
					'googlemap_resize'				=> '',
					'googlemap_height'				=> 450,
					'googlemap_street'				=> 450,
					'googlemap_splitview'			=> "false",
					'googlemap_splitwidth'			=> 250,
					'googlemap_delay'				=> 200,					
					'googlemap_clusters'			=> 'false',				
					'googlemap_singleinfo'			=> 'true',
					'googlemap_metric'				=> 'false',
					'googlemap_mobile'				=> 'false',
					'googlemap_full'				=> 'false',
					'googlemap_breaks'				=> 0,
					'googlemap_zoom'				=> 12,
					'googlemap_localize'			=> 'false',
					'googlemap_language'			=> 'en',
					'googlemap_region'				=> 'US',
					// Debug Mode
					'debug_enabled'					=> 'false',
					'debug_output'					=> 'console',
					// Map Center					
					'center_type'					=> 'markers',			// markers, coordinates, address, fitall, dynamic
					'center_address'				=> '',
					'center_latitude'				=> '',
					'center_longitude'				=> '',
					'center_dynamic'				=> '%5B%7B%22center_width%22%3A%224096%22%2C%22center_type%22%3A%22markers%22%2C%22center_zoom%22%3A%2212%22%7D%5D',
					// Marker Import
					'import_json_marker'			=> 'false',
					'import_path_marker'			=> '',
					'import_height_marker'			=> 32,
					'import_width_marker'			=> 32,
					// Cluster Settings
					'clusterer_type'				=> 'default', 			// default, pins, singlepin, people, conversations, hearts
					'clusterer_custom'				=> '',
					// Map Controls
					'controls_styler'				=> 'false',
					'controls_groups'				=> 'false',
					'controls_tags'					=> 'false',
					'controls_select'				=> 'false',
					'controls_search'				=> 'false',
					'controls_street'				=> 'true',
					'controls_scaler'				=> 'true',
					'controls_pan'					=> 'true',
					'controls_zoomer'				=> 'true',
					'controls_wheel'				=> 'auto',
					'controls_gesture'				=> 'auto',
					'controls_types'				=> 'true',
					'controls_home'					=> 'true',
					'controls_bounds'				=> 'false',
					'controls_fullscreen'			=> 'false',
					// Controls Container					
					'controls_background'			=> '#f9f9f9',
					'controls_autoopen'				=> 'true',
					'controls_togglecolor'			=> '#696969',
					// Sumo Float Width
					'controls_floatwidth'			=> 400,
					// Styler Options
					'styler_screenlimit'			=> 400,
					'styler_search'					=> 'true',
					// Filter Options
					'filter_screenlimit'			=> 400,
					'filter_multiple'				=> 'false',
					'filter_confirm'				=> 'true',
					'filter_search'					=> 'true',					
					// Selector Option
					'locator_screenlimit'			=> 400,
					'locator_search'				=> 'true',
					'locator_autoopen'				=> 'true',
					'locator_listingheight'			=> 380,
					'locator_listingitemback'		=> '#f9f9f9',
					'locator_listingsearchback'		=> '#ffffff',
					'locator_listingprettybar'		=> 'false',
					'locator_listingfeatured'		=> 'false',
					'locator_zoomlevel'				=> 17,
					'locator_mapmarker'				=> 'ROADMAP',
					'locator_mapoverlay'			=> 'TERRAIN',	
					// Search Options
					'search_screenlimit'			=> 400,
					'search_infowindow'				=> 'true',
					'search_autoopen'				=> 'true',
					'search_googlelinks'			=> 'true',
					'search_addselector'			=> 'false',
					'search_zoomlevel'				=> 17,
					'search_maptype'				=> 'ROADMAP',
					// Draggable Breakpoint
					'draggable_allow'				=> 'toggle', 			// toggle, all, desktop, mobile, screen, none
					'draggable_width'				=> 400,
					// Layer Settings
					'layers_biking'					=> 'true',
					'layers_traffic'				=> 'true',
					'layers_transit'				=> 'false',
					// Marker Location
					'marker_position'				=> 'coordinates',		// coordinates, address
					'marker_address'				=> '',
					'marker_latitude'				=> '',
					'marker_longitude'				=> '',
					// Featured Image
					'marker_featured'				=> '',
					// Marker Style
					'marker_style'					=> 'default',			// default, internal, image
					'marker_internal'				=> '',
					'marker_image'					=> '',
					'marker_external'				=> '',
					'marker_width'					=> 32,
					'marker_height'					=> 32,
					'marker_animation'				=> 'false',
					'marker_entry'					=> 'drop',
					// Infowindow Style
					'window_global'					=> 'google',			// google, override
					'window_shadow'					=> 'false',
					'window_background'				=> '#333333',					
					'window_fontcolor'				=> '#ffffff',
					'window_arrowshow'				=> 'true',
					'window_arrowcolor'				=> '#333333',
					'window_maxwdidth'				=> 800,
					'window_offset'					=> 0,
					'window_closer'					=> 'topright',
					'window_mapclick'				=> 'false',
					// Infowindow Content
					'marker_tags'					=> '',
					'marker_group'					=> '',
					'marker_title'					=> '',
					'marker_include'				=> 'true',
					'marker_popup'					=> 'false',
					'marker_draggable'				=> 'false',
					'marker_streetview'				=> 'false',
					// Streetview Settings
					'marker_streetadjust'			=> 'false',
					'marker_streetheading'			=> 0,
					'marker_streetpitch'			=> 0,
					'marker_streetzoom'				=> 1,
					// Infowindow Buttons
					'marker_directions'				=> 'false',
					'marker_viewer'					=> 'false',
					'marker_link'					=> 'false',
					'marker_url'					=> '',
					// Language Settings
					'string_mobile_show'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['MobileShow'])				? $this->TS_VCSC_Google_MapPLUS_Language['MobileShow']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['MobileShow']),
					'string_mobile_hide'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['MobileHide'])				? $this->TS_VCSC_Google_MapPLUS_Language['MobileHide']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['MobileHide']),
					'string_listeners_start'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ListenersStart'])			? $this->TS_VCSC_Google_MapPLUS_Language['ListenersStart']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListenersStart']),
					'string_listeners_stop'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ListenersStop'])			? $this->TS_VCSC_Google_MapPLUS_Language['ListenersStop']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListenersStop']),
					'string_filter_all'				=> (isset($this->TS_VCSC_Google_MapPLUS_Language['FilterAll'])				? $this->TS_VCSC_Google_MapPLUS_Language['FilterAll']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['FilterAll']),
					'string_filter_label'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['FilterLabel'])			? $this->TS_VCSC_Google_MapPLUS_Language['FilterLabel']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['FilterLabel']),
					'string_select_label'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SelectLabel'])			? $this->TS_VCSC_Google_MapPLUS_Language['SelectLabel']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SelectLabel']),
					'string_style_default'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['StyleDefault'])			? $this->TS_VCSC_Google_MapPLUS_Language['StyleDefault']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['StyleDefault']),
					'string_style_label'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['StyleLabel'])				? $this->TS_VCSC_Google_MapPLUS_Language['StyleLabel']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['StyleLabel']),
					'string_controls_osm'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsOSM'])			? $this->TS_VCSC_Google_MapPLUS_Language['ControlsOSM']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsOSM']),
					'string_controls_home'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsHome'])			? $this->TS_VCSC_Google_MapPLUS_Language['ControlsHome']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsHome']),
					'string_controls_bounds'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsBounds'])			? $this->TS_VCSC_Google_MapPLUS_Language['ControlsBounds']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsBounds']),
					'string_controls_bike'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsBike'])			? $this->TS_VCSC_Google_MapPLUS_Language['ControlsBike']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsBike']),
					'string_controls_traffic'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsTraffic'])		? $this->TS_VCSC_Google_MapPLUS_Language['ControlsTraffic']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsTraffic']),
					'string_controls_transit'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsTransit'])		? $this->TS_VCSC_Google_MapPLUS_Language['ControlsTransit']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsTransit']),
					'string_traffic_miles'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['TrafficMiles'])			? $this->TS_VCSC_Google_MapPLUS_Language['TrafficMiles']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficMiles']),
					'string_traffic_kilometer'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['TrafficKilometer'])		? $this->TS_VCSC_Google_MapPLUS_Language['TrafficKilometer']	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficKilometer']),
					'string_traffic_none'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['TrafficNone'])			? $this->TS_VCSC_Google_MapPLUS_Language['TrafficNone']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficNone']),
					'string_search_button'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchButton'])			? $this->TS_VCSC_Google_MapPLUS_Language['SearchButton']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchButton']),
					'string_search_holder'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchHolder'])			? $this->TS_VCSC_Google_MapPLUS_Language['SearchHolder']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchHolder']),
					'string_search_google'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchGoogle'])			? $this->TS_VCSC_Google_MapPLUS_Language['SearchGoogle']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchGoogle']),
					'string_search_directions'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchDirections'])		? $this->TS_VCSC_Google_MapPLUS_Language['SearchDirections']	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchDirections']),
					'string_search_group'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchGroup'])			? $this->TS_VCSC_Google_MapPLUS_Language['SearchGroup']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchGroup']),
					'string_other_link'				=> (isset($this->TS_VCSC_Google_MapPLUS_Language['OtherLink'])				? $this->TS_VCSC_Google_MapPLUS_Language['OtherLink']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink']),
					'string_marker_placeholder'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['PlaceholderMarker'])		? $this->TS_VCSC_Google_MapPLUS_Language['PlaceholderMarker']	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['PlaceholderMarker']),
					// Sumo Text Strings
					'string_sumo_confirm'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoConfirm'])			? $this->TS_VCSC_Google_MapPLUS_Language['SumoConfirm']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoConfirm']),
					'string_sumo_cancel'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoCancel'])				? $this->TS_VCSC_Google_MapPLUS_Language['SumoCancel']			: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoCancel']),
					'string_sumo_selected'			=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSelected'])			? $this->TS_VCSC_Google_MapPLUS_Language['SumoSelected']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSelected']),
					'string_sumo_allselected'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoAllSelected'])		? $this->TS_VCSC_Google_MapPLUS_Language['SumoAllSelected']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoAllSelected']),
					'string_sumo_placeholder'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoPlaceholder'])		? $this->TS_VCSC_Google_MapPLUS_Language['SumoPlaceholder']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoPlaceholder']),
					'string_sumo_searchmarker'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSearchLocations'])	? $this->TS_VCSC_Google_MapPLUS_Language['SumoSearchLocations']	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchLocations']),
					'string_sumo_searchgroup'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSearchGroups'])		? $this->TS_VCSC_Google_MapPLUS_Language['SumoSearchGroups']	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchGroups']),
					'string_sumo_searchstyle'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSearchStyles'])		? $this->TS_VCSC_Google_MapPLUS_Language['SumoSearchStyles']	: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchStyles']),
					// Detail Listing Strings
					'string_listings_button'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ListingsButton'])			? $this->TS_VCSC_Google_MapPLUS_Language['ListingsButton']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListingsButton']),
					'string_listings_search'		=> (isset($this->TS_VCSC_Google_MapPLUS_Language['ListingsSearch'])			? $this->TS_VCSC_Google_MapPLUS_Language['ListingsSearch']		: $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListingsSearch']),
					// Other Settings
					'margin_top'                    => 0,
					'margin_bottom'                 => 0,
					'el_id' 						=> '',
					'el_class'                  	=> '',
					'css'							=> '',
				), $atts ));
				
				$map_random                    		= mt_rand(999999, 9999999);
				$controls_listings					= 'false';
				$output 							= '';
				
				// Check for Missing Location
				if (($marker_position == "coordinates") && (($marker_latitude == "") || ($marker_longitude == ""))) {
					$map_valid						= "false";
				} else if (($marker_position == "address") && ($marker_address == '')) {
					$map_valid						= "false";
				} else {
					$map_valid						= "true";
				}
				if (($map_valid == "false") && ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false")) {
					echo $output;
					$myvariable 					= ob_get_clean();
					return $myvariable;
				}
				
				wp_enqueue_style('dashicons');
				wp_enqueue_style('ts-extend-sumo');
				wp_enqueue_script('ts-extend-sumo');
				wp_enqueue_style('ts-visual-composer-extend-front');
				wp_enqueue_script('ts-visual-composer-extend-front');
				wp_enqueue_style('ts-extend-googlemapsplus');
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					if ($googlemap_api == "true") {
						if ($googlemap_localize == "true") {
							$this->TS_VCSC_GoogleMapsPlus_LoadAPI($googlemap_language, $googlemap_region);
						} else {
							wp_enqueue_script('ts-extend-mapapi-library');
						}
					}
					wp_enqueue_script('ts-extend-googlemapsplus');
				}
				
				if (!empty($el_id)) {
					$map_id			    			= $el_id;
				} else {
					$map_id			    			= 'ts-advanced-google-map-container-' . $map_random;
				}
				
				// Link Values
				if ($marker_link = "true") {
					$link 							= TS_VCSC_Advancedlinks_GetLinkData($marker_url);
					$a_href							= $link['url'];
					$a_title 						= $link['title'];
					$a_target 						= $link['target'];
				} else {
					$a_href							= '';
					$a_title 						= '';
					$a_target 						= '';
				}				
				
				if ($marker_position == "coordinates") {
					$google_directions				= 'https://www.google.com/maps?saddr=My+Location&daddr=' . $marker_latitude . ',' . $marker_longitude . '';
					$google_viewer					= 'https://www.google.com/maps?q=' . $marker_latitude . ',' . $marker_longitude . '';
				} else if ($marker_position == "address") {
					$google_directions				= 'https://www.google.com/maps?saddr=My+Location&daddr=' . urlencode($marker_address) . '';
					$google_viewer					= 'https://www.google.com/maps?q=' . urlencode($marker_address) . '';
				}
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					if (($marker_style == "internal") && ($marker_internal != '')) {
						$marker_internal 			= $this->TS_VCSC_GoogleMapsPlus_Image($marker_internal);
						$marker_icon				= urlencode(TS_VCSC_GetResourceURL('images/marker/' . $marker_internal));
					} else if (($marker_style == "image") && ($marker_image != '')) {
						$marker_icon 				= wp_get_attachment_image_src($marker_image, 'full');
						$marker_icon				= urlencode($marker_icon[0]);
					} else if (($marker_style == "external") && ($marker_external != '')) {
						$marker_icon				= $marker_external;
					} else {
						$marker_icon				= urlencode(TS_VCSC_GetResourceURL('images/defaults/default_mapmarker.png'));
					}
				} else {
					$marker_icon					= '';
				}
				
				// Dynamic Center Rules
				if ($center_type == "dynamic") {
					$dynamic_groups					= array();
					$dynamic_types					= '';
					if (isset($center_dynamic) && strlen($center_dynamic) > 0 ) {			
						$dynamic_entries 			= json_decode(urldecode($center_dynamic), true);
						if (!is_array($dynamic_entries)) {
							$dynamic_entries		= array();
						} else {
							$dynamic_entries		= TS_VCSC_SortMultiArray($dynamic_entries, 'center_width');
							$dynamic_entries 		= array_reverse($dynamic_entries);
						}
						$dynamic_entries			= urlencode(json_encode($dynamic_entries));
					}
				} else {
					$dynamic_entries				= urlencode(json_encode(array()));
				}
				
				$marker_data						= 'data-id="map-marker-single-' . $map_random . '" data-processed="false" data-group="' . $marker_group . '" data-tags="' . $marker_tags . '" data-streetview="' . $marker_streetview . '" data-draggable="' . $marker_draggable . '" data-title="' . $marker_title . '" ';
				$marker_data						.= 'data-source="' . $marker_style . '" data-icon="' . $marker_icon . '" data-animation-allow="' . $marker_animation . '" data-animation-type="' . $marker_entry . '" data-latitude="' . ($marker_position == 'coordinates' ? $marker_latitude : '') . '" data-longitude="' . ($marker_position == 'coordinates' ? $marker_longitude : '') . '" data-address="' . ($marker_position == 'address' ? $marker_address : '') . '" data-draggable="false" data-popup="' . $marker_popup . '" ';
				$marker_data						.= 'data-window-type="' . $window_global . '" data-window-closer="' . $window_closer . '" data-window-offset="' . $window_offset . '" data-window-maxwidth="' . $window_maxwdidth . '" data-window-shadow="' . $window_shadow . '" data-window-background="' . $window_background . '" data-window-fontcolor="' . $window_fontcolor . '" data-window-arrowshow="' . $window_arrowshow . '" data-window-arrowcolor="' . $window_arrowcolor . '" ';
				if ($marker_style == "internal") {
					$marker_width					= 32;
					$marker_height					= 37;
				} else if ($marker_style == "default") {
					$marker_width					= 32;
					$marker_height					= 32;
				}
				$marker_data						.= 'data-marker-width="' . $marker_width . '" data-marker-height="' . $marker_height . '" ';
				$marker_data						.= 'data-street-adjust="' . $marker_streetadjust . '" data-street-heading="' . $marker_streetheading . '" data-street-pitch="' . $marker_streetpitch . '" data-street-zoom="' . $marker_streetzoom . '" ';
				

				// WP Bakery Page Builder Styling Override
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-advanced-google-map-container ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_GoogleMapsPlus_Container', $atts);
				} else {
					$css_class						= 'ts-advanced-google-map-container ' . $el_class;
				}
				
				$clusterer_count					= 0;
				$clusterer_data						= "";
				
				// Compile Main Data
				$map_data							= 'data-initialized="false" data-mapheight="' . $googlemap_height . '" data-singleinfo="' . $googlemap_singleinfo . '" data-loadapi="' . $googlemap_api . '" data-listeners="' . $googlemap_listeners . '" data-externalwatch="' . $googlemap_external . '" data-delay="' . $googlemap_delay . '" data-mapsearch="' . $controls_search . '" data-activate="' . $googlemap_mobile . '" data-metric="' . $googlemap_metric . '" data-center-type="' . $center_type . '" data-center-latitude="' . ($center_type == 'coordinates' ? $center_latitude : '') . '" data-center-longitude="' . ($center_type == 'coordinates' ? $center_longitude : '') . '" data-center-address="' . ($center_type == 'address' ? $center_address : '') . '" data-center-dynamic="' . $dynamic_entries . '" data-zoom="' . $googlemap_zoom . '" data-maptype="' . $googlemap_type . '" data-mapstyle="' . $googlemap_style . '" data-poistyle="' . $googlemap_pois . '" data-openlayers="' . $googlemap_openlayers . '" data-mapresize="' . $googlemap_resize . '" data-debug-enabled="' . $debug_enabled . '" data-debug-output="' . $debug_output . '"';
				$map_preloader						= 'data-preloader-use="false"';
				$map_marker							= 'data-marker-default="' . urlencode(TS_VCSC_GetResourceURL('images/defaults/default_mapmarker.png')) . '" data-marker-height="37" data-marker-width="32"';
				$map_clusterer						= 'data-mapclusters="' . $googlemap_clusters . '" data-clusterer-type="' . $clusterer_type . '" data-clusterer-path="' . TS_VCSC_GetResourceURL('images/clusterer') . '" data-clusterer-custom="' . $clusterer_count . '" data-clusterer-data="' . $clusterer_data . '" ';
				$map_street							= 'data-street-split="' . $googlemap_splitview . '" data-street-width="' . $googlemap_splitwidth . '" data-street-height="' . $googlemap_height . '"';
				$map_controls						= 'data-controls-floatwidth="' . $controls_floatwidth . '" data-controls-listings="false" data-controls-fullscreen="' . $controls_fullscreen . '" data-controls-home="' . $controls_home . '" data-controls-bounds="' . $controls_bounds . '" data-controls-types="' . $controls_types . '" data-controls-pan="' . $controls_pan . '" data-controls-zoomer="' . $controls_zoomer . '" data-controls-gesture="' . $controls_gesture . '" data-controls-wheel="' . $controls_wheel . '" data-controls-styler="' . $controls_styler . '" data-controls-groups="' . $controls_groups . '" data-controls-tags="' . $controls_tags . '" data-controls-select="' . $controls_select . '" data-controls-street="' . $controls_street . '" data-controls-scaler="' . $controls_scaler . '"';
				$map_filter							= 'data-filter-screenlimit="' . $filter_screenlimit . '" data-filter-multiple="' . $filter_multiple . '" data-filter-confirm="' . $filter_confirm . '" data-filter-search="' . $filter_search . '"';
				$map_styler							= 'data-styler-screenlimit="' . $styler_screenlimit . '" data-styler-search="' . $styler_search . '"';
				$map_locator						= 'data-locator-screenlimit="' . $locator_screenlimit . '" data-locator-search="' . $locator_search . '" data-locator-autoopen="' . $locator_autoopen . '" data-locator-zoomlevel="' . $locator_zoomlevel . '" data-locator-mapmarker="' . $locator_mapmarker . '" data-locator-mapoverlay="' . $locator_mapoverlay . '"';
				$map_sumostrings					= 'data-sumo-confirm="' . $string_sumo_confirm . '" data-sumo-cancel="' . $string_sumo_cancel . '" data-sumo-selected="' . $string_sumo_selected . '" data-sumo-allselected="' . $string_sumo_allselected . '" data-sumo-placeholder="' . $string_sumo_placeholder . '" data-sumo-searchmarker="' . $string_sumo_searchmarker . '" data-sumo-searchgroup="' . $string_sumo_searchgroup . '" data-sumo-searchstyle="' . $string_sumo_searchstyle . '"';
				$map_search							= 'data-search-screenlimit="' . $search_screenlimit . '" data-search-window="' . $search_infowindow . '" data-search-open="' . $search_autoopen . '" data-search-links="' . $search_googlelinks . '" data-search-selector="' . $search_addselector . '" data-search-zoomlevel="' . $search_zoomlevel . '" data-search-maptype="' . $search_maptype . '"';
				$map_draggable						= 'data-draggable-allow="' . $draggable_allow . '" data-draggable-width="' . $draggable_width . '"';
				$map_layers							= 'data-layers-biking="' . $layers_biking . '" data-layers-traffic="' . $layers_traffic . '" data-layers-transit="' . $layers_transit . '"';
				$map_fullwidth						= 'data-fullwidth="' . $googlemap_full . '" data-break-parents="' . $googlemap_breaks . '"';
				$map_listing						= 'data-listing-prettybar="' . $locator_listingprettybar . '" data-listing-featured="' . $locator_listingfeatured . '"';
				if ($googlemap_style != "style_snazzyimport") {
					$googlemap_snazzytitle			= '';
					$googlemap_snazzycode			= '';
				}
				$map_snazzystyle					= 'data-snazzy-import="' . ($googlemap_style == "style_snazzyimport" ? "true" : "false") . '" data-snazzy-title="' . $googlemap_snazzytitle . '" data-snazzy-code="' . $googlemap_snazzycode . '"';
				if ($import_json_marker == "false") {
					$import_path_marker				= '';
				}
				$map_import							= 'data-import-markerjson="' . $import_json_marker . '" data-import-markerpath="' . $import_path_marker . '" data-import-markerheight="' . $import_height_marker . '" data-import-markerwidth="' . $import_width_marker . '"';
				$map_window							= 'data-window-global="' . $window_global . '" data-window-offset="' . $window_offset . '" data-window-mapclick="' . $window_mapclick . '" data-window-closer="' . $window_closer . '" data-window-maxwidth="' . $window_maxwdidth . '" data-window-shadow="' . $window_shadow . '" data-window-background="' . $window_background . '" data-window-fontcolor="' . $window_fontcolor . '" data-window-arrowshow="' . $window_arrowshow . '" data-window-arrowcolor="' . $window_arrowcolor . '"';

				// Compile Language Settings
				$map_language						= 'data-string-otherlink="' . $string_other_link . '" data-string-markerplaceholder="' . $string_marker_placeholder . '" ';			
				$map_language						.= 'data-string-mobileshow="' . $string_mobile_show . '" data-string-mobilehide="' . $string_mobile_hide . '" data-string-listenersstart="' . $string_listeners_start . '" data-string-listenersstop="' . $string_listeners_stop . '" ';
				$map_language						.= 'data-string-filterall="' . $string_filter_all . '" data-string-filterlabel="' . $string_filter_label . '" data-string-selectlabel="' . $string_select_label . '" ';	
				$map_language						.= 'data-string-styledefault="' . $string_style_default . '" data-string-stylelabel="' . $string_style_label . '" ';
				$map_language						.= 'data-string-controlsosm="' . $string_controls_osm . '" data-string-controlshome="' . $string_controls_home . '" data-string-controlsbounds="' . $string_controls_bounds . '" data-string-controlsbike="' . $string_controls_bike . '" data-string-controlstraffic="' . $string_controls_traffic . '" data-string-controlstransit="' . $string_controls_transit . '" ';
				$map_language 						.= 'data-string-trafficmiles="' . $string_traffic_miles . '" data-string-traffickilometers="' . $string_traffic_kilometer . '" data-string-trafficnone="' . $string_traffic_none . '" ';
				$map_language 						.= 'data-string-searchgroup="' . $string_search_group . '" data-string-searchbutton="' . $string_search_button . '" data-string-searchholder="' . $string_search_holder . '" data-string-searchgoogle="' . $string_search_google . '" data-string-searchdirect="' . $string_search_directions . '"';
				$map_language						.= 'data-string-listingbutton="' . $string_listings_button . '" data-string-listingsearch="' . $string_listings_search . '"';
				
				// Compile Map Attributes
				$map_attributes						= $map_data . ' ' . $map_preloader . ' ' . $map_marker . ' ' . $map_clusterer . ' ' . $map_street . ' ' . $map_controls . ' ' . $map_filter . ' ' . $map_styler . ' ' . $map_locator . ' ' . $map_sumostrings . ' ' . $map_search . ' ' . $map_draggable . ' ' . $map_layers . ' ' . $map_window . ' ' . $map_import . ' ' . $map_snazzystyle . ' ' . $map_language . ' ' . $map_listing;
				
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "false") {
					$output .= '<div id="' . $map_id . '" class="' . $css_class . '" data-urlcheck="' . $map_id . '" data-random="' . $map_random . '" ' . $map_fullwidth . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						$output .= '<div id="ts-advanced-google-map-errors-' . $map_random . '" class="ts-advanced-google-map-errors" style="display: none;"></div>';
						$output .= '<div id="ts-advanced-google-map-contents-' . $map_random . '" class="ts-advanced-google-map-contents" style="display: none;">';
							$output .= '<div id="ts-advanced-google-map-marker-single-' . $map_random . '" class="ts-advanced-google-map-marker-single" ' . $marker_data . '>';
								if ($marker_title != '') {
									$output .= '<div class="ts-advanced-google-map-marker-title">' . $marker_title . '</div>';
								}
								if (($content != '') || ($marker_directions == "true") || ($marker_viewer == "true") || (($marker_link == "true") && ($a_href != ''))) {
									$output .= '<div class="ts-advanced-google-map-marker-content">';
										if ($content != '') {
											$output .= do_shortcode($content);
										}
										if (($marker_directions == "true") || ($marker_viewer == "true") || (($marker_link == "true") && ($a_href != ''))) {
											$output .= '<div class="ts-advanced-google-map-marker-controls">';
												if ($marker_directions == "true") {
													$output .= '<a class="ts-advanced-google-map-marker-directions" href="' . $google_directions . '" target="_blank">' . $string_search_directions . '</a>';
												}
												if ($marker_viewer == "true") {
													$output .= '<a class="ts-advanced-google-map-marker-viewer" href="' . $google_viewer . '" target="_blank">' . $string_search_google . '</a>';
												}
												if (($marker_link == "true") && ($a_href != '')) {
													$output .= '<a class="ts-advanced-google-map-marker-link" href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '">' . $string_other_link . '</a>';
												}
											$output .= '</div>';
										}
									$output .= '</div>';
								}
							$output .= '</div>';
						$output .= '</div>';
						if (($controls_styler == "false") && ($controls_groups == "false") && ($controls_tags == "false") && ($controls_select == "false") && ($controls_search == "false")) {
							$controls_class			= "ts-advanced-google-map-novisibility";
							$controls_style			= "display: none; background: " . $controls_background . ";";
						} else {
							$controls_class			= "";
							$controls_style			= "display: block; background: " . $controls_background . ";";
						}
						if ($controls_autoopen == "false") {
							$controls_class			.= ' ts-advanced-google-map-collapsed';
							$controls_toggle		= 'ts-advanced-google-map-toggleshow';
						} else {
							$controls_toggle		= 'ts-advanced-google-map-togglehide';
						}
						$output .= '<div id="ts-advanced-google-map-controls-' . $map_random . '" class="ts-advanced-google-map-controls ' . $controls_class . '" style="' . $controls_style . '"><div class="ts-advanced-google-map-togglemain ' . $controls_toggle . '" style="color: ' . $controls_togglecolor . ';"></div></div>';
						$output .= '<div id="ts-advanced-google-map-directions-' . $map_random . '" class="ts-advanced-google-map-directions ts-advanced-google-map-novisibility" style="display: none;"></div>';
						$output .= '<div id="ts-advanced-google-map-streetview-' . $map_random . '" class="ts-advanced-google-map-streetview ts-advanced-google-map-novisibility" style="display: none; height: ' . $googlemap_street . 'px;"></div>';
						$output .= '<div id="ts-advanced-google-map-wrapper-' . $map_random . '" class="ts-advanced-google-map-wrapper" style="height: ' . $googlemap_height . 'px;" ' . $map_attributes . '></div>';
						$output .= '<div id="ts-advanced-google-map-listing-' . $map_random . '" class="ts-advanced-google-map-listing" style="display: none;"></div>';
					$output .= '</div>';
				} else {
					$output .= '<div id="' . $map_id . '" class="ts-advanced-google-map-container-edit" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						$output .= '<div class="ts-advanced-google-map-settings-edit-main" style="margin-bottom: 0px; padding-bottom: 0px; border-bottom: 0px;">';
							$output .= '<img class="ts-advanced-google-map-settings-edit-image" src="' . TS_VCSC_GetResourceURL('images/defaults/default_googlemap.jpg') . '">';
							$output .= '<div class="ts-advanced-google-map-settings-edit-values">';
								$output .= 'Map Type: ' . $googlemap_type . '<br/>';
								$output .= 'Map Height: ' . $googlemap_height . 'px<br/>';
								$output .= 'Initial Zoom: ' . $googlemap_zoom . '<br/>';
								if ($center_type == 'coordinates') {
									$output .= 'Map Center (Coordinates): Latitude ' . ($center_latitude != '' ? $center_latitude : 'N/A') . ' / Longitude ' . ($center_longitude != '' ? $center_longitude : 'N/A') . '<br/>';								
								} else if ($center_type == 'address') {
									$output .= 'Map Center (Address): ' . ($center_address != '' ? $center_address : 'N/A') . '<br/>';
								} else if ($center_type == 'markers') {
									$output .= 'Map Center: Set automatically based on map markers.';
								}
							$output .= '</div>';
						$output .= '</div>';
						$output .= '<div class="ts-advanced-google-map-settings-edit-content">';
							$output .= '<div class="ts-advanced-google-map-settings-edit-marker" style="padding: 0px; margin: 0px; border: none;">';
								if ($marker_style == "default") {
									$marker_icon			= TS_VCSC_GetResourceURL('images/defaults/default_mapmarker.png');
								} else if ($marker_style == "internal") {
									$marker_icon			= TS_VCSC_GetResourceURL('images/marker/' . $marker_internal);
								} else if ($marker_style == "image") {
									$marker_icon			= wp_get_attachment_image_src($markerimage, 'full');
									$marker_icon			= $marker_icon[0];
								}
								$output .= '<img class="ts-advanced-google-map-settings-edit-icon" src="' . $marker_icon . '">';
								$output .= '<div class="ts-advanced-google-map-settings-edit-excerpt">';
									$output .= 'Title: ' . ($marker_title != '' ? $marker_title : 'N/A') . '<br/>';
									if ($marker_position == 'address') {
										$output .= 'Address: ' . $marker_address . '<br/>';
									} else if ($marker_position == 'coordinates') {
										$output .= 'Coordinates: Latitude ' . $marker_latitude . ' / Longitude ' . $marker_longitude . '<br/>';
									}
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				}
				
				echo $output;
				
				unset($map_attributes);
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
			
			// Add Google Maps Elements
			function TS_VCSC_Add_GoogleMapsPlus_Element_Container() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Google Maps Container
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                              => __("TS Google Maps PLUS", "ts_visual_composer_extend"),
					"base"                              => "TS_VCSC_GoogleMapsPlus_Container",
					"icon"                              => "ts-composer-element-icon-google-maps-container",
					"category"                          => __("Composium", "ts_visual_composer_extend"),
					"as_parent"                         => array('only' => 'TS_VCSC_GoogleMapsPlus_Marker,TS_VCSC_GoogleMapsPlus_Overlay,TS_VCSC_GoogleMapsPlus_Curveline'),
					"description"                       => __("Create an advanced Google Map (multiple marker)", "ts_visual_composer_extend"),
					"js_view"                           => "VcColumnView",
					"controls" 							=> "full",
					"content_element"                   => true,
					"is_container" 						=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseExtendedNesting == "true" ? false : true),
					"container_not_allowed" 			=> false,
					"show_settings_on_create"           => true,
					"admin_enqueue_js"        			=> "",
					"admin_enqueue_css"       			=> "",
					"front_enqueue_js"					=> "",
					"front_enqueue_css"					=> "",
					"params"                            => array(
						// Map Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_1",
							"seperator"                 => "Map Settings",
						),						
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Map Listeners Panel", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_listeners",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to show a panel that provides map and mouse status information; useful for creating the map and finding locations, but should not be used for public map due to extensive listener events.", "ts_visual_composer_extend" ),
						),						
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Map Tiles", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_tiles",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to show the outline of the individual tiles that make up the map", "ts_visual_composer_extend" ),
						),						
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Map Type", "ts_visual_composer_extend"),
							"param_name"            	=> "googlemap_type",
							"admin_label"           	=> true,
							"value"                 	=> array(
								__("Road Map", "ts_visual_composer_extend")                  => "ROADMAP",
								__("Satellite Map", "ts_visual_composer_extend")             => "SATELLITE",
								__("Hybrid Map", "ts_visual_composer_extend")                => "HYBRID",
								__("Terrain Map", "ts_visual_composer_extend")               => "TERRAIN",
								__("Open Street Map", "ts_visual_composer_extend")           => "OSM",
							),
							"description"           	=> __( "Select the map type the map should initially be shown with.", "ts_visual_composer_extend" )
						),
						array(
							"type"			        	=> "dropdown",
							"heading"               	=> __( "Road Map Style", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_style",
							"admin_label"           	=> true,
							"value"			        	=> array(
								__( "Default", "ts_visual_composer_extend") 							=> "style_default",
								__( "Import Custom Snazzy Maps Style", "ts_visual_composer_extend")		=> "style_snazzyimport",
								__( "Apple Maps-Esque", "ts_visual_composer_extend") 					=> "style_apple_mapsesque",
								__( "Avocado World", "ts_visual_composer_extend") 						=> "style_avocado_world",
								__( "Become A Dinosaur", "ts_visual_composer_extend") 					=> "style_become_dinosaur",
								__( "Bentley", "ts_visual_composer_extend") 							=> "style_bentley",
								__( "Black And White", "ts_visual_composer_extend") 					=> "style_black_white",
								__( "Blue Essence", "ts_visual_composer_extend") 						=> "style_blue_essence",
								__( "Blue Gray", "ts_visual_composer_extend") 							=> "style_blue_gray",
								__( "Blue Water", "ts_visual_composer_extend") 							=> "style_blue_water",
								__( "Bright & Bubbly", "ts_visual_composer_extend") 					=> "style_bright_bubbly",
								__( "Clean Cut", "ts_visual_composer_extend") 							=> "style_clean_cut",
								__( "Cobalt", "ts_visual_composer_extend") 								=> "style_cobalt",
								__( "Cool Gray", "ts_visual_composer_extend") 							=> "style_cool_gray",
								__( "Countries", "ts_visual_composer_extend") 							=> "style_countries",
								__( "Flat Green", "ts_visual_composer_extend") 							=> "style_flat_green",
								__( "Flat Map", "ts_visual_composer_extend") 							=> "style_flat_map",
								__( "Gowalla", "ts_visual_composer_extend") 							=> "style_gowalla",
								__( "Greyscale", "ts_visual_composer_extend") 							=> "style_greyscale",
								__( "Hopper", "ts_visual_composer_extend") 								=> "style_hopper",
								__( "Icy Blue", "ts_visual_composer_extend") 							=> "style_icy_blue",
								__( "Light Monochrome", "ts_visual_composer_extend") 					=> "style_light_monochrome",
								__( "Lunar Landscape", "ts_visual_composer_extend") 					=> "style_lunar_landscape",
								__( "Map Box", "ts_visual_composer_extend") 							=> "style_mapbox",
								__( "Midnight Commander", "ts_visual_composer_extend") 					=> "style_midnight_commander",
								__( "Nature", "ts_visual_composer_extend") 								=> "style_nature",
								__( "Neutral Blue", "ts_visual_composer_extend") 						=> "style_neutral_blue",
								__( "Old Timey", "ts_visual_composer_extend") 							=> "style_old_timey",
								__( "Pale Dawn", "ts_visual_composer_extend") 							=> "style_pale_dawn",
								__( "Paper", "ts_visual_composer_extend") 								=> "style_paper",
								__( "Red Alert", "ts_visual_composer_extend") 							=> "style_red_alert",
								__( "Red Hues", "ts_visual_composer_extend") 							=> "style_red_hues",
								__( "Retro", "ts_visual_composer_extend") 								=> "style_retro",
								__( "Route XL", "ts_visual_composer_extend") 							=> "style_route_xl",
								__( "Shades of Grey", "ts_visual_composer_extend") 						=> "style_shades_grey",
								__( "Shift Worker", "ts_visual_composer_extend") 						=> "style_shift_worker",
								__( "Snazzy Maps", "ts_visual_composer_extend") 						=> "style_snazzy_maps",
								__( "Subtle", "ts_visual_composer_extend") 								=> "style_subtle",
								__( "Subtle Grayscale", "ts_visual_composer_extend") 					=> "style_subtle_grayscale",
								__( "Unimposed Topography", "ts_visual_composer_extend") 				=> "style_unimposed_topo",
								__( "Vintage", "ts_visual_composer_extend") 							=> "style_vintage",
							),
							"description"           	=> __( "Select the color style for the road map layout.", "ts_visual_composer_extend" )
						),						
						array(
							"type"                  	=> "textfield",
							"heading"               	=> __( "Snazzy Maps Style Name", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_snazzytitle",
							"value"                 	=> "",
							"description"           	=> __( "Enter a name for your custom Snazzy Maps style here.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "googlemap_style", 'value' => 'style_snazzyimport' ),
						),
						array(
							"type"              		=> "textarea_raw_html",
							"heading"           		=> __( "Snazzy Maps Style Code", "ts_visual_composer_extend" ),
							"param_name"        		=> "googlemap_snazzycode",
							"value"             		=> base64_encode(""),
							"description"      	 		=> __( "Enter the map style code obtained from Snazzy Maps here:", "ts_visual_composer_extend" ) . ' <a href="https://snazzymaps.com/" target="_blank">SnazzyMaps</a>',
							"dependency"            	=> array( 'element' => "googlemap_style", 'value' => 'style_snazzyimport' ),
						),						
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Map Google POI's", "ts_visual_composer_extend"),
							"param_name"            	=> "googlemap_pois",
							"admin_label"           	=> true,
							"value"                 	=> array(
								__("Default (Based on Map Style)", "ts_visual_composer_extend")			=> "default",
								__("Provide POI's With Infowindow", "ts_visual_composer_extend")		=> "clickable",
								__("Provide Only POI's Labels", "ts_visual_composer_extend")			=> "inactive",
								__("Hide All POI's", "ts_visual_composer_extend")               		=> "remove",
							),
							"description"           	=> __( "Select if and how Google POI's should be displayed on the map.", "ts_visual_composer_extend" )
						),						
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Map Height", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_height",
							"value"                 	=> "450",
							"min"                   	=> "100",
							"max"                   	=> "2048",
							"step"                  	=> "1",
							"unit"                  	=> 'px',
							"admin_label"           	=> true,
							"description"           	=> __( "Define the height in pixel for the map.", "ts_visual_composer_extend" )
						),
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Streetview Height", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_street",
							"value"                 	=> "450",
							"min"                   	=> "100",
							"max"                   	=> "2048",
							"step"                  	=> "1",
							"unit"                  	=> 'px',
							"description"           	=> __( "Define the height in pixel for the streetview container (for markers with streetview enabled).", "ts_visual_composer_extend" )
						),	
						array(
							"type"			        	=> "dropdown",
							"heading"               	=> __( "Map Center / Home", "ts_visual_composer_extend" ),
							"param_name"            	=> "center_type",
							"value"			        	=> array(
								__( "First Marker (No KML)", "ts_visual_composer_extend" )			=> "markers",
								__( "Custom Coordinates", "ts_visual_composer_extend")				=> "coordinates",
								__( "Custom Address", "ts_visual_composer_extend" )					=> "address",
								__( "Fit All Objects", "ts_visual_composer_extend" )        		=> "fitall",
								__( "Define Based on Map Width", "ts_visual_composer_extend" )		=> "dynamic",
							),
							"description"           	=> __( "Please define how the initial and home center of the map should be determined.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Zoom Level", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_zoom",
							"value"                 	=> "12",
							"min"                   	=> "0",
							"max"                   	=> "21",
							"step"                  	=> "1",
							"unit"                  	=> '',
							"admin_label"           	=> true,
							"description"           	=> __( "Define the initial and home button zoom level for the map.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "center_type", 'value' => array('markers', 'coordinates', 'address') ),
						),		
						array(
							"type"		            	=> "textfield",
							"heading"               	=> __( "Center Latitude", "ts_visual_composer_extend" ),
							"param_name"            	=> "center_latitude",
							"value"                	 	=> "",
							"admin_label"           	=> true,
							"description"	        	=> __( "Please provide the latitude for the map center.", "ts_visual_composer_extend"),
							"dependency"            	=> array( 'element' => "center_type", 'value' => 'coordinates' ),
						),
						array(
							"type"		            	=> "textfield",
							"heading"               	=> __( "Center Longitude", "ts_visual_composer_extend" ),
							"param_name"            	=> "center_longitude",
							"value"                 	=> "",
							"admin_label"           	=> true,
							"description"	        	=> __( "Please provide the longitude for the map center.", "ts_visual_composer_extend"),
							"dependency"            	=> array( 'element' => "center_type", 'value' => 'coordinates' ),
						),						
						array(
							"type"		            	=> "textfield",
							"heading"               	=> __( "Center Address", "ts_visual_composer_extend" ),
							"param_name"            	=> "center_address",
							"value"                	 	=> "",
							"admin_label"           	=> true,
							"description"	        	=> __( "Please provide the address for the map center.", "ts_visual_composer_extend"),
							"dependency"            	=> array( 'element' => "center_type", 'value' => 'address' ),
						),
						array(
							'type' 						=> 'param_group',
							'heading' 					=> __( 'Dynamic Center Rules', 'ts_visual_composer_extend' ),
							'param_name' 				=> 'center_dynamic',
							'description' 				=> __( 'Define the dynamic center rules for the map, applied based on the determined map width. Please start with the largest width and work your way down.', 'ts_visual_composer_extend' ),
							'save_always' 				=> true,
							"dependency"            	=> array( 'element' => "center_type", 'value' => 'dynamic' ),
							'value' 					=> urlencode(json_encode(array(
								array(
									'center_width' 				=> 4096,
									'center_type'				=> 'markers',
									'center_zoom'				=> 12,
									'center_latitude'			=> '',
									'center_longitude'			=> '',
									'center_address'			=> '',
								),
							))),
							'params' 					=> array(
								array(
									"type"              		=> "nouislider",
									"heading"           		=> __( "Maximum Map Width", "ts_visual_composer_extend" ),
									"param_name"        		=> "center_width",
									"value"             		=> "4096",
									"min"               		=> "240",
									"max"               		=> "4096",
									"step"              		=> "1",
									"unit"              		=> 'px',
									"admin_label"           	=> true,
									"description"       		=> "Define the maximum map width at which the following center rules should be applied."
								),
								array(
									"type"			        	=> "dropdown",
									"heading"               	=> __( "Map Center / Home", "ts_visual_composer_extend" ),
									"param_name"            	=> "center_type",
									"value"			        	=> array(
										__( "First Marker (No KML)", "ts_visual_composer_extend" )			=> "markers",
										__( "Custom Coordinates", "ts_visual_composer_extend")				=> "coordinates",
										__( "Custom Address", "ts_visual_composer_extend" )					=> "address",
										__( "Fit All Objects", "ts_visual_composer_extend" )        		=> "fitall",
									),
									"admin_label"           	=> true,
									"description"           	=> __( "Please define how the center of the map should be determined.", "ts_visual_composer_extend" ),
								),
								array(
									"type"                  	=> "nouislider",
									"heading"               	=> __( "Zoom Level", "ts_visual_composer_extend" ),
									"param_name"            	=> "center_zoom",
									"value"                 	=> "12",
									"min"                   	=> "0",
									"max"                   	=> "21",
									"step"                  	=> "1",
									"unit"                  	=> '',
									"description"           	=> __( "Define the initial and home button zoom level for the map.", "ts_visual_composer_extend" ),
									"dependency"            	=> array( 'element' => "center_type", 'value' => array('markers', 'coordinates', 'address') ),
								),		
								array(
									"type"		            	=> "textfield",
									"heading"               	=> __( "Center Latitude", "ts_visual_composer_extend" ),
									"param_name"            	=> "center_latitude",
									"value"                	 	=> "",
									"description"	        	=> __( "Please provide the latitude for the map center.", "ts_visual_composer_extend"),
									"dependency"            	=> array( 'element' => "center_type", 'value' => 'coordinates' ),
								),
								array(
									"type"		            	=> "textfield",
									"heading"               	=> __( "Center Longitude", "ts_visual_composer_extend" ),
									"param_name"            	=> "center_longitude",
									"value"                 	=> "",
									"description"	        	=> __( "Please provide the longitude for the map center.", "ts_visual_composer_extend"),
									"dependency"            	=> array( 'element' => "center_type", 'value' => 'coordinates' ),
								),						
								array(
									"type"		            	=> "textfield",
									"heading"               	=> __( "Center Address", "ts_visual_composer_extend" ),
									"param_name"            	=> "center_address",
									"value"                	 	=> "",
									"description"	        	=> __( "Please provide the address for the map center.", "ts_visual_composer_extend"),
									"dependency"            	=> array( 'element' => "center_type", 'value' => 'address' ),
								),
								
							)
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Resize Event", "ts_visual_composer_extend"),
							"param_name"            	=> "googlemap_resize",
							"admin_label"           	=> true,
							"value"                 	=> array(
								__("No Change", "ts_visual_composer_extend")                  	=> "none",
								__("Set Map to Initial State", "ts_visual_composer_extend")		=> "redraw",
								__("Fit Map to Show All Markers", "ts_visual_composer_extend")	=> "fitmarkers",
							),
							"description"           	=> __( "Select how the map should react if a window resize event has been detected.", "ts_visual_composer_extend" )
						),						
						/*array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Require Activate on Mobile", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_mobile",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if the map should require activation on mobile devices to ease scrolling.", "ts_visual_composer_extend" )
						),*/						
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Require Map Activation", "ts_visual_composer_extend"),
							"param_name"            	=> "googlemap_mobile",
							"admin_label"           	=> true,
							"value"                 	=> array(
								__("Do Not Require Activation", "ts_visual_composer_extend")	=> "false",
								__("Mobile Devices Only", "ts_visual_composer_extend")			=> "true",
								__("Require On All Devices", "ts_visual_composer_extend")		=> "always",
							),
							"description"           	=> __( "Select if the map should require a manual activation to make it visible on the screen.", "ts_visual_composer_extend" )
						),						
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Use Metric Dimensions", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_metric",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to use metric dimensions for distances and speeds.", "ts_visual_composer_extend" )
						),						
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Make Map Full-Width", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_full",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want attempt showing the map in full width (will not work with all themes).", "ts_visual_composer_extend" )
						),
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Full Width Breakouts", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_breaks",
							"value"                 	=> "0",
							"min"                   	=> "0",
							"max"                   	=> "99",
							"step"                  	=> "1",
							"unit"                  	=> '',
							"description"           	=> __( "Define the number of parent containers the map should attempt to break away from.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "googlemap_full", 'value' => 'true' ),
						),
						// JSON Marker Import
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_2",
							"seperator"                 => "JSON File Import",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Import Markers from JSON", "ts_visual_composer_extend" ),
							"param_name"            	=> "import_json_marker",
							"value"                 	=> "false",
							"admin_label"           	=> true,
							"description"           	=> __( "Switch the toggle if you want to import (additional) markers via dedicated JSON file.", "ts_visual_composer_extend" ),
						),
						array(
							"type"		            	=> "textfield",
							"heading"               	=> __( "JSON: File Path", "ts_visual_composer_extend" ),
							"param_name"            	=> "import_path_marker",
							"value"                	 	=> "",							
							"description"	        	=> __( "Please provide the full path to the JSON file that defines the (additional) marker.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "import_json_marker", 'value' => 'true' ),
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "JSON: Marker Width", "ts_visual_composer_extend" ),
							"param_name"                => "import_width_marker",
							"value"                     => "32",
							"min"                       => "16",
							"max"                       => "64",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Define the default width for all custom marker icons defined in the JSON import file.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "import_json_marker", 'value' => 'true' ),
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "JSON: Marker Height", "ts_visual_composer_extend" ),
							"param_name"                => "import_height_marker",
							"value"                     => "32",
							"min"                       => "16",
							"max"                       => "64",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Define the default height for all custom marker icons defined in the JSON import file.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "import_json_marker", 'value' => 'true' ),
						),						
						// KML File Import
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_3",
							"seperator"                 => "KML File Import",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Import Data from KML File", "ts_visual_composer_extend" ),
							"param_name"            	=> "import_kml_file",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to import marker and overlay data from a Google My Map generated KML file.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              		=> "messenger",
							"param_name"        		=> "messenger_1",
							"color"						=> "#006BB7",
							"size"						=> "13",
							"layout"					=> "notice",
							"message"            		=> __( "Please be aware that advanced features like group filter, direct location selectors, marker clusterer and others will not work with markers and overlays that have been added to the map via KML file.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "import_kml_file", 'value' => 'true' ),
						),
						array(
							"type"		            	=> "textfield",
							"heading"               	=> __( "KML: File Path", "ts_visual_composer_extend" ),
							"param_name"            	=> "import_kml_path",
							"value"                	 	=> "",							
							"description"	        	=> __( "Please provide the full path to the KML file that you generated via Google My Map.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "import_kml_file", 'value' => 'true' ),
						),
						// Infowindows Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_4",
							"seperator"                 => "Infowindows Settings",
							"dependency"            	=> array( 'element' => "googlemap_listeners", 'value' => 'false' ),
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "One Infowindow Only", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_singleinfo",
							"value"                 	=> "true",
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"description"           	=> __( "Switch the toggle if you want to have only one marker or overlay infowindow open at any time.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "googlemap_listeners", 'value' => 'false' ),
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Close on Map Click", "ts_visual_composer_extend" ),
							"param_name"            	=> "window_mapclick",
							"value"                 	=> "false",
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"description"           	=> __( "Switch the toggle if you want to close all open infowindows when clicking on the map.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "googlemap_listeners", 'value' => 'false' ),
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Infowindow Style", "ts_visual_composer_extend"),
							"param_name"            	=> "window_global",
							"admin_label"           	=> true,
							"value"                 	=> array(
								__("Google Default Style", "ts_visual_composer_extend")			=> "google",
								__("Composium Custom Style", "ts_visual_composer_extend")		=> "override",
							),
							"description"           	=> __( "Select what global style should be used for the marker and/or overlay infowindows.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "googlemap_listeners", 'value' => 'false' ),
						),
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Infowindow Offset", "ts_visual_composer_extend" ),
							"param_name"            	=> "window_offset",
							"value"                 	=> "0",
							"min"                   	=> "-100",
							"max"                   	=> "100",
							"step"                  	=> "1",
							"unit"                  	=> 'px',
							"description"           	=> __( "Define an optional vertical offset for the infowindow in relation to the marker image.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Infowindow Closer Position", "ts_visual_composer_extend"),
							"param_name"            	=> "window_closer",
							"value"                 	=> array(
								__("Top Right", "ts_visual_composer_extend")					=> "topright",
								__("Top Center", "ts_visual_composer_extend")					=> "topcenter",
								__("Top Left", "ts_visual_composer_extend")						=> "topleft",								
								__("Bottom Right", "ts_visual_composer_extend")					=> "bottomright",
								__("Bottom Center", "ts_visual_composer_extend")				=> "bottomcenter",
								__("Bottom Left", "ts_visual_composer_extend")					=> "bottomleft",
							),
							"description"           	=> __( "Select where the close button for the infowindows should be placed.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "window_global", 'value' => 'override' ),
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Infowindow Shadow", "ts_visual_composer_extend" ),
							"param_name"            	=> "window_shadow",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to add a shadow effect to the infowindows.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "window_global", 'value' => 'override' ),
						),	
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Infowindow Background Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "window_background",
							"value"             		=> "#333333",
							"description"       		=> __( "Define the global background color for the infowindows.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "window_global", 'value' => 'override' ),
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Infowindow Font Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "window_fontcolor",
							"value"             		=> "#ffffff",
							"description"       		=> __( "Define the global font color for the infowindows.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "window_global", 'value' => 'override' ),
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Infowindow Arrow", "ts_visual_composer_extend" ),
							"param_name"            	=> "window_arrowshow",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to add a down arrow to the infowindows, pointing towards the marker.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "window_global", 'value' => 'override' ),
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Infowindow Arrow Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "window_arrowcolor",
							"value"             		=> "#333333",
							"description"       		=> __( "Define the global background color for the infowindow arrows.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "window_arrowshow", 'value' => 'true' ),
						),						
						// Preloader Setting
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_5",
							"seperator"					=> "Preloader Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Preloader Animation", "ts_visual_composer_extend" ),
							"param_name"            	=> "preloader_use",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to show a preloader animation while the map is rendering; useful for complex maps with a large marker count.", "ts_visual_composer_extend" )
						),		
						array(
							"type"				    	=> "livepreview",
							"heading"			    	=> __( "Preloader: Style", "ts_visual_composer_extend" ),
							"param_name"		    	=> "preloader_style",
							"preview"					=> "preloaders",
							"shownone"					=> "false",
							"value"                 	=> 0,
							"description"		    	=> __( "Select the style for the preloader animation to be shown while the element is rendering.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "preloader_use", 'value' => 'true' ),
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Preloader: Background Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "preloader_background",
							"value"             		=> "#ffffff",
							"description"       		=> __( "Define the background color for the preloader container.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "preloader_use", 'value' => 'true' ),
						),
						// API Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_6",
							"seperator"                 => "API Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Load Google Map API", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_api",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to load the Google Map API; disable only if the API is already loaded by another plugin or theme as it is required for the map.", "ts_visual_composer_extend" )
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Localize Google Map", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_localize",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to forcibly localize the map; otherwise, language and region settings will be used based on browser settings. Using this option will affect ALL maps on this page or post!", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "googlemap_api", 'value' => 'true' ),
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Google Map Language", "ts_visual_composer_extend"),
							"param_name"            	=> "googlemap_language",
							"value"                 	=> array_flip($this->TS_VCSC_GoogleMapsPlus_Localizations("language")),
							"description"           	=> __( "Select the language that should be used for Google internal textual information within the map.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"default"					=> "en",
							"standard"					=> "en",
							"std"						=> "en",
							"dependency"            	=> array( 'element' => "googlemap_localize", 'value' => 'true' ),
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Google Map Region", "ts_visual_composer_extend"),
							"param_name"            	=> "googlemap_region",
							"value"                 	=> array_flip($this->TS_VCSC_GoogleMapsPlus_Localizations("region")),
							"description"           	=> __( "Select the geographic region that should be used for general application behavior (can differ for individual countries).", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"default"					=> "US",
							"standard"					=> "US",
							"std"						=> "US",
							"dependency"            	=> array( 'element' => "googlemap_localize", 'value' => 'true' ),
						),	
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Geocode Delay", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_delay",
							"value"                 	=> "200",
							"min"                   	=> "0",
							"max"                   	=> "1000",
							"step"                  	=> "10",
							"unit"                  	=> 'ms',
							"description"           	=> __( "Define the delay in ms between each address geocoding request that will be sent to Google.", "ts_visual_composer_extend" )
						),						
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Load OpenLayersMap API", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_openlayers",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to load the OpenLayersMap API in order to add the OpenLayers style option to the map.", "ts_visual_composer_extend" )
						),
						// Marker Clusterer Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_7",
							"seperator"                 => "Clusterer Settings",
							"group"						=> "Clusterer",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Use Marker Clusterer", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_clusters",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to apply an automatic marker clusterer to the map.", "ts_visual_composer_extend" ),
							"group"						=> "Clusterer",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Include Curvelines", "ts_visual_composer_extend" ),
							"param_name"            	=> "clusterer_curves",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to include any curveline elements within the marker clusterer.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "googlemap_clusters", 'value' => 'true' ),
							"group"						=> "Clusterer",
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Clusterer Style", "ts_visual_composer_extend"),
							"param_name"            	=> "clusterer_type",
							"value"                 	=> array(
								__("Default", "ts_visual_composer_extend")						=> "default",
								__("Pins", "ts_visual_composer_extend")							=> "pins",								
								__("People", "ts_visual_composer_extend")						=> "people",
								__("Conversation Bubble", "ts_visual_composer_extend")			=> "conversations",
								__("Hearts", "ts_visual_composer_extend")						=> "hearts",
								__("Stars", "ts_visual_composer_extend")						=> "stars",
								__("Single Pin 1", "ts_visual_composer_extend")					=> "singlepin1",
								__("Single Pin 2", "ts_visual_composer_extend")					=> "singlepin2",
								__("Single Pin 3", "ts_visual_composer_extend")					=> "singlepin3",
								__("Single Circle 1", "ts_visual_composer_extend")				=> "singlecircle1",
								__("Single Circle 2", "ts_visual_composer_extend")				=> "singlecircle2",
								__("Single Circle 3", "ts_visual_composer_extend")				=> "singlecircle3",
								__("Custom", "ts_visual_composer_extend")						=> "custom",
							),
							"description"           	=> __( "Select what style should be used for the clusterer icons.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "googlemap_clusters", 'value' => 'true' ),
							"group"						=> "Clusterer",
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Number of Cluster Levels", "ts_visual_composer_extend"),
							"param_name"            	=> "clusterer_custom",
							"value"                 	=> array(
								__("1 Level", "ts_visual_composer_extend")						=> "1",
								__("2 Levels", "ts_visual_composer_extend")						=> "2",
								__("3 Levels", "ts_visual_composer_extend")						=> "3",
								__("4 Levels", "ts_visual_composer_extend")						=> "4",
								__("5 Levels", "ts_visual_composer_extend")						=> "5",
							),
							"description"           	=> __( "Define the number of cluster levels you want to define custom markers for.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "clusterer_type", 'value' => 'custom' ),
							"group"						=> "Clusterer",
						),
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_7a",
							"seperator"                 => "Cluster Level 1",
							"uppercase"					=> "false",
							"fontsize"					=> 16,
							"borderwidth"				=> 1,
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("1","2","3","4","5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type"                  	=> "attach_image",
							"heading"               	=> __( "Cluster Image", "ts_visual_composer_extend" ),
							"param_name"            	=> "clusterer_level1_image",
							"value"                 	=> "",
							"description"           	=> __( "Select the image to be used for this level of the marker clusterer routine.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",	
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("1","2","3","4","5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Font Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "clusterer_level1_color",
							"value"             		=> "#ffffff",
							"description"       		=> __( "Define the color to be used for the marker count applied to this level of the marker clusterer routine.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("1","2","3","4","5") ),
							"group"						=> "Clusterer",
						),						
						array(
							"type" 						=> "advanced_styling",
							"heading" 					=> __("Clusterer Settings", "ts_visual_composer_extend"),
							"param_name" 				=> "clusterer_level1_values",
							"style_type"				=> "clusterer",
							"show_main"					=> "false",
							"show_preview"				=> "false",
							"show_width"				=> "true",
							"show_style"				=> "false",
							"show_radius" 				=> "false",					
							"show_color"				=> "false",
							"show_unit_width"			=> "false",
							"show_unit_radius"			=> "false",
							"label_width"				=> "",
							"override_all"				=> "false",
							"default_positions"			=> array(
								//"All"						=> array("string" => __("All", "ts_visual_composer_extend"), "width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px"),
								"Width"						=> array("string" => __("Width", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "false"),
								"Height"					=> array("string" => __("Height", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
								"FontSize"					=> array("string" => __("Font Size", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "false"),
								"OffsetX"					=> array("string" => __("Offset-X", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
								"OffsetY"					=> array("string" => __("Offset-Y", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
							),
							"value"						=> "width:52;height:52;fontsize:11;offsetx:0;offsety:0;",
							"description"       		=> __( "Define the required settings for this clusterer level; all units are in pixels (px); offsets refer to the position of the clusterer value within the clusterer icon.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("1","2","3","4","5") ),
							"group"						=> "Clusterer",
						),						
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_7b",
							"seperator"                 => "Cluster Level 2",
							"uppercase"					=> "false",
							"fontsize"					=> 16,
							"borderwidth"				=> 1,
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("2","3","4","5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type"                  	=> "attach_image",
							"heading"               	=> __( "Cluster Image", "ts_visual_composer_extend" ),
							"param_name"            	=> "clusterer_level2_image",
							"value"                 	=> "",
							"description"           	=> __( "Select the image to be used for this level of the marker clusterer routine.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",	
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("2","3","4","5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Font Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "clusterer_level2_color",
							"value"             		=> "#ffffff",
							"description"       		=> __( "Define the color to be used for the marker count applied to this level of the marker clusterer routine.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("2","3","4","5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type" 						=> "advanced_styling",
							"heading" 					=> __("Clusterer Settings", "ts_visual_composer_extend"),
							"param_name" 				=> "clusterer_level2_values",
							"style_type"				=> "clusterer",
							"show_main"					=> "false",
							"show_preview"				=> "false",
							"show_width"				=> "true",
							"show_style"				=> "false",
							"show_radius" 				=> "false",					
							"show_color"				=> "false",
							"show_unit_width"			=> "false",
							"show_unit_radius"			=> "false",
							"label_width"				=> "",
							"override_all"				=> "false",
							"default_positions"			=> array(
								//"All"						=> array("string" => __("All", "ts_visual_composer_extend"), "width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px"),
								"Width"						=> array("string" => __("Width", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "false"),
								"Height"					=> array("string" => __("Height", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
								"FontSize"					=> array("string" => __("Font Size", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "false"),
								"OffsetX"					=> array("string" => __("Offset-X", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
								"OffsetY"					=> array("string" => __("Offset-Y", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
							),
							"value"						=> "width:58;height:58;fontsize:12;offsetx:0;offsety:0;",
							"description"       		=> __( "Define the required settings for this clusterer level; all units are in pixels (px); offsets refer to the position of the clusterer value within the clusterer icon.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("2","3","4","5") ),
							"group"						=> "Clusterer",
						),	
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_7c",
							"seperator"                 => "Cluster Level 3",
							"uppercase"					=> "false",
							"fontsize"					=> 16,
							"borderwidth"				=> 1,
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("3","4","5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type"                  	=> "attach_image",
							"heading"               	=> __( "Cluster Image", "ts_visual_composer_extend" ),
							"param_name"            	=> "clusterer_level3_image",
							"value"                 	=> "",
							"description"           	=> __( "Select the image to be used for this level of the marker clusterer routine.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",	
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("3","4","5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Font Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "clusterer_level3_color",
							"value"             		=> "#ffffff",
							"description"       		=> __( "Define the color to be used for the marker count applied to this level of the marker clusterer routine.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("3","4","5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type" 						=> "advanced_styling",
							"heading" 					=> __("Clusterer Settings", "ts_visual_composer_extend"),
							"param_name" 				=> "clusterer_level3_values",
							"style_type"				=> "clusterer",
							"show_main"					=> "false",
							"show_preview"				=> "false",
							"show_width"				=> "true",
							"show_style"				=> "false",
							"show_radius" 				=> "false",					
							"show_color"				=> "false",
							"show_unit_width"			=> "false",
							"show_unit_radius"			=> "false",
							"label_width"				=> "",
							"override_all"				=> "false",
							"default_positions"			=> array(
								//"All"						=> array("string" => __("All", "ts_visual_composer_extend"), "width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px"),
								"Width"						=> array("string" => __("Width", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "false"),
								"Height"					=> array("string" => __("Height", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
								"FontSize"					=> array("string" => __("Font Size", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "false"),
								"OffsetX"					=> array("string" => __("Offset-X", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
								"OffsetY"					=> array("string" => __("Offset-Y", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
							),
							"value"						=> "width:66;height:66;fontsize:13;offsetx:0;offsety:0;",
							"description"       		=> __( "Define the required settings for this clusterer level; all units are in pixels (px); offsets refer to the position of the clusterer value within the clusterer icon.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("3","4","5") ),
							"group"						=> "Clusterer",
						),	
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_7d",
							"seperator"                 => "Cluster Level 4",
							"uppercase"					=> "false",
							"fontsize"					=> 16,
							"borderwidth"				=> 1,
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("4","5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type"                  	=> "attach_image",
							"heading"               	=> __( "Cluster Image", "ts_visual_composer_extend" ),
							"param_name"            	=> "clusterer_level4_image",
							"value"                 	=> "",
							"description"           	=> __( "Select the image to be used for this level of the marker clusterer routine.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",	
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("4","5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Font Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "clusterer_level4_color",
							"value"             		=> "#ffffff",
							"description"       		=> __( "Define the color to be used for the marker count applied to this level of the marker clusterer routine.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("4","5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type" 						=> "advanced_styling",
							"heading" 					=> __("Clusterer Settings", "ts_visual_composer_extend"),
							"param_name" 				=> "clusterer_level4_values",
							"style_type"				=> "clusterer",
							"show_main"					=> "false",
							"show_preview"				=> "false",
							"show_width"				=> "true",
							"show_style"				=> "false",
							"show_radius" 				=> "false",					
							"show_color"				=> "false",
							"show_unit_width"			=> "false",
							"show_unit_radius"			=> "false",
							"label_width"				=> "",
							"override_all"				=> "false",
							"default_positions"			=> array(
								//"All"						=> array("string" => __("All", "ts_visual_composer_extend"), "width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px"),
								"Width"						=> array("string" => __("Width", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "false"),
								"Height"					=> array("string" => __("Height", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
								"FontSize"					=> array("string" => __("Font Size", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "false"),
								"OffsetX"					=> array("string" => __("Offset-X", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
								"OffsetY"					=> array("string" => __("Offset-Y", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
							),
							"value"						=> "width:78;height:78;fontsize:14;offsetx:0;offsety:0;",
							"description"       		=> __( "Define the required settings for this clusterer level; all units are in pixels (px); offsets refer to the position of the clusterer value within the clusterer icon.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("4","5") ),
							"group"						=> "Clusterer",
						),	
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_7e",
							"seperator"                 => "Cluster Level 5",
							"uppercase"					=> "false",
							"fontsize"					=> 16,
							"borderwidth"				=> 1,
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type"                  	=> "attach_image",
							"heading"               	=> __( "Cluster Image", "ts_visual_composer_extend" ),
							"param_name"            	=> "clusterer_level5_image",
							"value"                 	=> "",
							"description"           	=> __( "Select the image to be used for this level of the marker clusterer routine.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",	
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Font Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "clusterer_level5_color",
							"value"             		=> "#ffffff",
							"description"       		=> __( "Define the color to be used for the marker count applied to this level of the marker clusterer routine.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("5") ),
							"group"						=> "Clusterer",
						),
						array(
							"type" 						=> "advanced_styling",
							"heading" 					=> __("Clusterer Settings", "ts_visual_composer_extend"),
							"param_name" 				=> "clusterer_level5_values",
							"style_type"				=> "clusterer",
							"show_main"					=> "false",
							"show_preview"				=> "false",
							"show_width"				=> "true",
							"show_style"				=> "false",
							"show_radius" 				=> "false",					
							"show_color"				=> "false",
							"show_unit_width"			=> "false",
							"show_unit_radius"			=> "false",
							"label_width"				=> "",
							"override_all"				=> "false",
							"default_positions"			=> array(
								//"All"						=> array("string" => __("All", "ts_visual_composer_extend"), "width" => "1", "unitwidth" => "px", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px"),
								"Width"						=> array("string" => __("Width", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "false"),
								"Height"					=> array("string" => __("Height", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
								"FontSize"					=> array("string" => __("Font Size", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "false"),
								"OffsetX"					=> array("string" => __("Offset-X", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
								"OffsetY"					=> array("string" => __("Offset-Y", "ts_visual_composer_extend"), "width" => "0", "unitwidth" => "", "style" => "solid", "color" => "#000000", "radius" => "0", "unitradius" => "px", "auto" => "true"),
							),
							"value"						=> "width:90;height:90;fontsize:17;offsetx:0;offsety:0;",
							"description"       		=> __( "Define the required settings for this clusterer level; all units are in pixels (px); offsets refer to the position of the clusterer value within the clusterer icon.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "clusterer_custom", 'value' => array("5") ),
							"group"						=> "Clusterer",
						),	
						// Standard Controls
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_8",
							"seperator"                 => "Map Handling",
							"group" 			        => "Map Handling",
						),
						array(
							"type"              		=> "switch_button",
							"heading"              	 	=> __( "Show Type Controls", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_types",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want show the controls for the different map types.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Zoom Controls", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_zoomer",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want show the map zoom controls.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),						
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Fullscreen Controls", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_fullscreen",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want show fullscreen controls.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),						
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Pan Controls", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_pan",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want show the map pan controls.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),						
						array(
							"type"			        	=> "dropdown",
							"heading"               	=> __( "Allow Map Dragging", "ts_visual_composer_extend" ),
							"param_name"            	=> "draggable_allow",
							"value"			        	=> array(
								__( "Provide On/Off Toggle", "ts_visual_composer_extend" )	=> "toggle",
								__( "All Devices", "ts_visual_composer_extend" )        	=> "all",
								__( "Desktop Devices", "ts_visual_composer_extend")			=> "desktop",
								__( "Mobile Devices", "ts_visual_composer_extend" )			=> "mobile",
								__( "Based on Screen Width", "ts_visual_composer_extend" )	=> "screen",
								__( "No Dragging", "ts_visual_composer_extend" )        	=> "none",
							),
							"description"           	=> __( "Please define if and on which devices the map can be dragged.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Minimum Screen Width", "ts_visual_composer_extend" ),
							"param_name"                => "draggable_width",
							"value"                     => "400",
							"min"                       => "240",
							"max"                       => "1280",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Define the minimum screen width at which the map should be draggable.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "draggable_allow", 'value' => 'screen' ),
							"group"						=> "Map Handling",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show StreetView Controls", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_street",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want show the map streetview controls.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Scale Controls", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_scaler",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want show the map scale controls.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),
						array(
							"type"			        	=> "dropdown",
							"heading"               	=> __( "Map Gesture Handling", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_gesture",
							"value"			        	=> array(
								__( "Use Automatic Mode", "ts_visual_composer_extend" )				=> "auto",
								__( "Use Cooperative Mode", "ts_visual_composer_extend" )        	=> "cooperative",
								__( "Use Greedy Mode", "ts_visual_composer_extend")					=> "greedy",
								__( "Disable Gesture Handling", "ts_visual_composer_extend")		=> "none",
							),
							"description"           	=> __( "Please define how gesture controls and mouse scroll events should be handled on mobile and desktop devices.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),
						array(
							"type"			        	=> "dropdown",
							"heading"               	=> __( "Mouse Wheel Event", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_wheel",
							"value"			        	=> array(
								__( "Use Automatic Mode", "ts_visual_composer_extend" )				=> "auto",
								__( "Force Mousewheel Zoom", "ts_visual_composer_extend" )        	=> "true",
								__( "Prevent Mousewheel Zoom", "ts_visual_composer_extend")			=> "false",
							),
							"description"           	=> __( "Please define how a mousewheel event above the map are should be handled. Forcing a mousewheel zoom can override any setting made in regards to the map gesture handling setting above.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),
						// Custom Controls
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_9",
							"seperator"                 => "General Options",
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Home Reset", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_home",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to provide a button to recenter and zoom the map to its initial center coordinates.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),						
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Fit All", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_bounds",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to provide a button change the map zoom and location to fit all markers.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						// Layer Controls
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_10",
							"seperator"                 => "Layer Options",
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Layer: Bicycles", "ts_visual_composer_extend" ),
							"param_name"            	=> "layers_biking",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to provide a button to add a layer with biking trails to the map.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Layer: Traffic", "ts_visual_composer_extend" ),
							"param_name"            	=> "layers_traffic",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to provide a button to add a layer with traffic information to the map.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Layer: Transit", "ts_visual_composer_extend" ),
							"param_name"            	=> "layers_transit",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to provide a button to add a layer with public transit information to the map.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						// Advanced Features
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_11",
							"seperator"                 => "Advanced Feature Controls",
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Controls: Open on Init", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_autoopen",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to render the sections with the advanced map feature controls opened or closed.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Controls: Selectbox Float", "ts_visual_composer_extend" ),
							"param_name"                => "controls_floatwidth",
							"value"                     => "400",
							"min"                       => "240",
							"max"                       => "640",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Define the screen width at which the various selectboxes are shown as floating popups instead.", "ts_visual_composer_extend" ),
							"group"						=> "Map Features",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Controls: Background Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "controls_background",
							"value"             		=> "#f9f9f9",
							"description"       		=> __( "Define the background color for the section that contains the advanced map feature controls.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Controls: Toggle Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "controls_togglecolor",
							"value"             		=> "#696969",
							"description"       		=> __( "Define the color for the toggle that shows/hides the section that contains the advanced map feature controls.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group" 			        => "Map Features",
						),
						// Style Selector
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_12",
							"seperator"                 => "Snazzy Style Selector",
							"bordertype"				=> "dashed",
							"fontsize"					=> 16,
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Styles: Show Style Selector", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_styler",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to provide a selector so users can apply different styles to the map.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Styles: Minimum Screen Width", "ts_visual_composer_extend" ),
							"param_name"                => "styler_screenlimit",
							"value"                     => "400",
							"min"                       => "240",
							"max"                       => "1280",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Define the minimum screen width at which the styles selector should be visible.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_styler", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Styles: Show Search Option", "ts_visual_composer_extend" ),
							"param_name"            	=> "styler_search",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to provide an option to quickly search all available Snazzy Maps styles by keyword.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_styler", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						// Location Selector
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_13",
							"seperator"                 => "Location Selector",
							"bordertype"				=> "dashed",
							"fontsize"					=> 16,
							"group" 			        => "Map Features",
						),
						array(
							"type"			        	=> "dropdown",
							"heading"               	=> __( "Location: Show Location Selector", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_select",
							"value"			        	=> array(
								__( "No Location Selector", "ts_visual_composer_extend" )							=> "false",
								__( "Location Selector Selectbox Only", "ts_visual_composer_extend" )        		=> "true",
								__( "Detail Listing Below Map Only", "ts_visual_composer_extend")					=> "detail",
								__( "Location Selector Selectbox + Detail Listing", "ts_visual_composer_extend")	=> "combo",								
							),
							"description"           	=> __( "Select if you want to provide a control option to directly go to an existing location on the map.", "ts_visual_composer_extend" ),
							"group"						=> "Map Features",
						),						
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Location: Allow External Triggers", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_external",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to allow the map to be controlled via external location triggers on the page the map is embedded in.", "ts_visual_composer_extend" ),
							"group"						=> "Map Features",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Location: Marker Zoom Level", "ts_visual_composer_extend" ),
							"param_name"                => "locator_zoomlevel",
							"value"                     => "17",
							"min"                       => "0",
							"max"                       => "20",
							"step"                      => "1",
							"unit"                      => 'x',
							"description"               => __( "Define the zoom level to be used when selecting a marker via any of the supported location selector methods.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Location: Marker Map Type", "ts_visual_composer_extend"),
							"param_name"            	=> "locator_mapmarker",
							"value"                 	=> array(
								__("Road Map", "ts_visual_composer_extend")                  => "ROADMAP",
								__("Satellite Map", "ts_visual_composer_extend")             => "SATELLITE",
								__("Hybrid Map", "ts_visual_composer_extend")                => "HYBRID",
								__("Terrain Map", "ts_visual_composer_extend")               => "TERRAIN",
							),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"description"           	=> __( "Select the map type to be used when selecting a marker via any of the supported location selector methods.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Location: Overlay Map Type", "ts_visual_composer_extend"),
							"param_name"            	=> "locator_mapoverlay",
							"value"                 	=> array(
								__("Road Map", "ts_visual_composer_extend")                  => "ROADMAP",
								__("Satellite Map", "ts_visual_composer_extend")             => "SATELLITE",
								__("Hybrid Map", "ts_visual_composer_extend")                => "HYBRID",
								__("Terrain Map", "ts_visual_composer_extend")               => "TERRAIN",
							),
							"standard"					=> "TERRAIN",
							"std"						=> "TERRAIN",
							"default"					=> "TERRAIN",
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"description"           	=> __( "Select the map type to be used when selecting an overlay via any of the supported location selector methods.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Location: Minimum Screen Width", "ts_visual_composer_extend" ),
							"param_name"                => "locator_screenlimit",
							"value"                     => "400",
							"min"                       => "240",
							"max"                       => "1280",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Define the minimum screen width at which the location selector selectbox should be visible.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_select", 'value' => array('true', 'combo')),
							"group" 			        => "Map Features",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Location: Maximum Listing Height", "ts_visual_composer_extend" ),
							"param_name"                => "locator_listingheight",
							"value"                     => "400",
							"min"                       => "300",
							"max"                       => "1000",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Define the maximum height for the detailed location listing section.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_select", 'value' => array('detail', 'combo')),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Location: Detail Listing Background Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "locator_listingsearchback",
							"value"             		=> "#ffffff",
							"description"       		=> __( "Define the overall background color for the detail location listing section.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "controls_select", 'value' => array('detail', 'combo')),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Location: Detail Item Background Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "locator_listingitemback",
							"value"             		=> "#f9f9f9",
							"description"       		=> __( "Define the background color for the individual location items in the detail location listing.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "controls_select", 'value' => array('detail', 'combo')),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Location: Show Search Option", "ts_visual_composer_extend" ),
							"param_name"            	=> "locator_search",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to provide an option to quickly search all available locations by keyword.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "controls_select", 'value' => array('true', 'combo', 'detail')),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Location: Auto-Open Infowindow", "ts_visual_composer_extend" ),
							"param_name"            	=> "locator_autoopen",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to automatically open the infowindow for the selected location.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "controls_select", 'value' => array('true', 'combo', 'detail')),
							"group" 			        => "Map Features",
						),
						// Filter Feature
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_14",
							"seperator"                 => "Filter Feature",
							"bordertype"				=> "dashed",
							"fontsize"					=> 16,
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Filter: Show Group Filter", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_groups",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to provide a filter option to filter markers based on their assigned groups.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Filter: Minimum Screen Width", "ts_visual_composer_extend" ),
							"param_name"                => "filter_screenlimit",
							"value"                     => "400",
							"min"                       => "240",
							"max"                       => "1280",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Define the minimum screen width at which the group filter should be visible.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_groups", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Filter: Show Search Option", "ts_visual_composer_extend" ),
							"param_name"            	=> "filter_search",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to provide an option to quickly search all available groups by keyword.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_groups", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Filter: Allow Multiple", "ts_visual_composer_extend" ),
							"param_name"            	=> "filter_multiple",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to allow the filter to be used with multiple active groups or just one group.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_groups", 'value' => 'true' ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Filter: Confirm Requirement", "ts_visual_composer_extend" ),
							"param_name"            	=> "filter_confirm",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if the filter will only be processed, after the user clicks on a provided confirmation button.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "filter_multiple", 'value' => 'true' ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group" 			        => "Map Features",
						),
						array(
							"type"                  	=> "tag_editor",
							"heading"           		=> __( "Filter: Initial Groups", "ts_visual_composer_extend" ),
							"param_name"            	=> "filter_initialmultiple",
							"value"                 	=> "",
							"delimiter"					=> ",",
							"lowercase"					=> "false",
							"description"      		 	=> __( "Optionally, enter the exact names of existing groups the map should be filtered for when rendering initially; press ENTER after each name.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "filter_multiple", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Filter: Initial Group", "ts_visual_composer_extend" ),
							"param_name"                => "filter_initialsingle",
							"value"                     => "",
							"description"           	=> __( "Optionally, provide te name of a single group the map should be filtered for when rendering initially.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "filter_multiple", 'value' => 'false' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Filter: Group Zoom Level", "ts_visual_composer_extend" ),
							"param_name"                => "filter_zoomlevel",
							"value"                     => "21",
							"min"                       => "0",
							"max"                       => "21",
							"step"                      => "1",
							"unit"                      => 'x',
							"description"               => __( "Define the maximum allowable zoom level that can be used when using the group filter.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_groups", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						// Search Feature
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_15",
							"seperator"                 => "Search Feature",
							"bordertype"				=> "dashed",
							"fontsize"					=> 16,
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Search: Provide Search Input", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_search",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to provide a search option for users to find new addresses or coordinates on the map.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Search: Minimum Screen Width", "ts_visual_composer_extend" ),
							"param_name"                => "search_screenlimit",
							"value"                     => "400",
							"min"                       => "240",
							"max"                       => "1280",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Define the minimum screen width at which the search bar should be visible.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_search", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Search: Add To Location Selector", "ts_visual_composer_extend" ),
							"param_name"            	=> "search_addselector",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to add any found locations to the optional location selector for an easier retrieval.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "controls_search", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Search: Create Infowindow", "ts_visual_composer_extend" ),
							"param_name"            	=> "search_infowindow",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to automatically create an infowindow for the search result, showing the determined coordinates and other information.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "controls_search", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Search: Auto-Open Infowindow", "ts_visual_composer_extend" ),
							"param_name"            	=> "search_autoopen",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to automatically open the infowindow for the search result.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "search_infowindow", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Search: Google Links Infowindow", "ts_visual_composer_extend" ),
							"param_name"            	=> "search_googlelinks",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to add links to the infowindow to obtain directions to the search result and to view the search result on the official Google Maps website.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "search_infowindow", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                    	=> "tag_editor",
							"heading"                   => __( "Search:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchGroup'],
							"param_name"                => "string_search_group",
							"lowercase"					=> "false",
							"delimiter"					=> "|",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchGroup']) ? $this->TS_VCSC_Google_MapPLUS_Language['SearchGroup'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchGroup']),
							"description"           	=> __( "Provide the group name(s) that should be assigned to all new locations added to the map via this search feature; press ENTER after each group name.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "search_addselector", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),						
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Search: Marker Zoom Level", "ts_visual_composer_extend" ),
							"param_name"                => "search_zoomlevel",
							"value"                     => "17",
							"min"                       => "0",
							"max"                       => "20",
							"step"                      => "1",
							"unit"                      => 'x',
							"description"               => __( "Define the zoom level to be used when adding a new marker to the map based on a user search.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_search", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Search: Marker Map Type", "ts_visual_composer_extend"),
							"param_name"            	=> "search_mapmarker",
							"value"                 	=> array(
								__("Road Map", "ts_visual_composer_extend")                  => "ROADMAP",
								__("Satellite Map", "ts_visual_composer_extend")             => "SATELLITE",
								__("Hybrid Map", "ts_visual_composer_extend")                => "HYBRID",
								__("Terrain Map", "ts_visual_composer_extend")               => "TERRAIN",
							),
							"description"           	=> __( "Select the map type to be used when adding a new marker to the map based on a user search.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_search", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),		
						// Text Strings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_16",
							"seperator"                 => "Text Strings",
							"group" 			        => "Text Strings",
						),
						array(
							"type"              		=> "messenger",
							"param_name"        		=> "messenger_2",
							"color"						=> "#006BB7",
							"size"						=> "13",
							"layout"					=> "notice",
							"message"            		=> __( "The map will use some text strings for buttons and other control elements. You can translate or change those text strings using the options provided below.", "ts_visual_composer_extend" ),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['MobileShow'],
							"param_name"                => "string_mobile_show",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['MobileShow']) ? $this->TS_VCSC_Google_MapPLUS_Language['MobileShow'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['MobileShow']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['MobileHide'],
							"param_name"                => "string_mobile_hide",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['MobileHide']) ? $this->TS_VCSC_Google_MapPLUS_Language['MobileHide'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['MobileHide']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListenersStart'],
							"param_name"                => "string_listeners_start",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ListenersStart']) ? $this->TS_VCSC_Google_MapPLUS_Language['ListenersStart'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListenersStart']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListenersStop'],
							"param_name"                => "string_listeners_stop",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ListenersStop']) ? $this->TS_VCSC_Google_MapPLUS_Language['ListenersStop'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListenersStop']),
							"group" 			        => "Text Strings",
						),						
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['StyleDefault'],
							"param_name"                => "string_style_default",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['StyleDefault']) ? $this->TS_VCSC_Google_MapPLUS_Language['StyleDefault'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['StyleDefault']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['StyleLabel'],
							"param_name"                => "string_style_label",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['StyleLabel']) ? $this->TS_VCSC_Google_MapPLUS_Language['StyleLabel'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['StyleLabel']),
							"group" 			        => "Text Strings",
						),						
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['FilterAll'],
							"param_name"                => "string_filter_all",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['FilterAll']) ? $this->TS_VCSC_Google_MapPLUS_Language['FilterAll'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['FilterAll']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['FilterLabel'],
							"param_name"                => "string_filter_label",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['FilterLabel']) ? $this->TS_VCSC_Google_MapPLUS_Language['FilterLabel'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['FilterLabel']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SelectLabel'],
							"param_name"                => "string_select_label",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SelectLabel']) ? $this->TS_VCSC_Google_MapPLUS_Language['SelectLabel'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SelectLabel']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsOSM'],
							"param_name"                => "string_controls_osm",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsOSM']) ? $this->TS_VCSC_Google_MapPLUS_Language['ControlsOSM'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsOSM']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsHome'],
							"param_name"                => "string_controls_home",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsHome']) ? $this->TS_VCSC_Google_MapPLUS_Language['ControlsHome'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsHome']),
							"group" 			        => "Text Strings",
						),						
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsBounds'],
							"param_name"                => "string_controls_bounds",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsBounds']) ? $this->TS_VCSC_Google_MapPLUS_Language['ControlsBounds'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsBounds']),
							"group" 			        => "Text Strings",
						),						
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsBike'],
							"param_name"                => "string_controls_bike",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsBike']) ? $this->TS_VCSC_Google_MapPLUS_Language['ControlsBike'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsBike']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' .$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsTraffic'],
							"param_name"                => "string_controls_transit",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsTraffic']) ? $this->TS_VCSC_Google_MapPLUS_Language['ControlsTraffic'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsTraffic']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsTransit'],
							"param_name"                => "string_controls_traffic",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsTransit']) ? $this->TS_VCSC_Google_MapPLUS_Language['ControlsTransit'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsTransit']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficMiles'],
							"param_name"                => "string_traffic_miles",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['TrafficMiles']) ? $this->TS_VCSC_Google_MapPLUS_Language['TrafficMiles'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficMiles']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficKilometer'],
							"param_name"                => "string_traffic_kilometer",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['TrafficKilometer']) ? $this->TS_VCSC_Google_MapPLUS_Language['TrafficKilometer'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficKilometer']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficNone'],
							"param_name"                => "string_traffic_none",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['TrafficNone']) ? $this->TS_VCSC_Google_MapPLUS_Language['TrafficNone'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficNone']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchButton'],
							"param_name"                => "string_search_button",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchButton']) ? $this->TS_VCSC_Google_MapPLUS_Language['SearchButton'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchButton']),
							"group" 			        => "Text Strings",
						),						
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ). ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchHolder'],
							"param_name"                => "string_search_holder",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchHolder']) ? $this->TS_VCSC_Google_MapPLUS_Language['SearchHolder'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchHolder']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchGoogle'],
							"param_name"                => "string_search_google",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchGoogle']) ? $this->TS_VCSC_Google_MapPLUS_Language['SearchGoogle'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchGoogle']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchDirections'],
							"param_name"                => "string_search_directions",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchDirections']) ? $this->TS_VCSC_Google_MapPLUS_Language['SearchDirections'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchDirections']),
							"group" 			        => "Text Strings",
						),										
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink'],
							"param_name"                => "string_other_link",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['OtherLink']) ? $this->TS_VCSC_Google_MapPLUS_Language['OtherLink'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['PlaceholderMarker'],
							"param_name"                => "string_marker_placeholder",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['PlaceholderMarker']) ? $this->TS_VCSC_Google_MapPLUS_Language['PlaceholderMarker'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['PlaceholderMarker']),
							"group" 			        => "Text Strings",
						),						
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoConfirm'],
							"param_name"                => "string_sumo_confirm",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoConfirm']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoConfirm'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoConfirm']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoCancel'],
							"param_name"                => "string_sumo_cancel",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoCancel']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoCancel'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoCancel']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSelected'],
							"param_name"                => "string_sumo_selected",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSelected']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoSelected'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSelected']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoAllSelected'],
							"param_name"                => "string_sumo_allselected",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoAllSelected']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoAllSelected'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoAllSelected']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoPlaceholder'],
							"param_name"                => "string_sumo_placeholder",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoPlaceholder']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoPlaceholder'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoPlaceholder']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchLocations'],
							"param_name"                => "string_sumo_searchmarker",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSearchLocations']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoSearchLocations'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchLocations']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchGroups'],
							"param_name"                => "string_sumo_searchgroup",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSearchGroups']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoSearchGroups'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchGroups']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchStyles'],
							"param_name"                => "string_sumo_searchstyle",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSearchStyles']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoSearchStyles'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchStyles']),
							"group" 			        => "Text Strings",
						),						
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListingsButton'],
							"param_name"                => "string_listings_button",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ListingsButton']) ? $this->TS_VCSC_Google_MapPLUS_Language['ListingsButton'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListingsButton']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListingsSearch'],
							"param_name"                => "string_listings_search",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ListingsSearch']) ? $this->TS_VCSC_Google_MapPLUS_Language['ListingsSearch'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListingsSearch']),
							"group" 			        => "Text Strings",
						),						
						// Other Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_17",
							"seperator"                 => "Other Settings",
							"group" 			        => "Other Settings",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Margin: Top", "ts_visual_composer_extend" ),
							"param_name"                => "margin_top",
							"value"                     => "0",
							"min"                       => "0",
							"max"                       => "200",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
							"group" 			        => "Other Settings",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Margin: Bottom", "ts_visual_composer_extend" ),
							"param_name"                => "margin_bottom",
							"value"                     => "0",
							"min"                       => "0",
							"max"                       => "200",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
							"group" 			        => "Other Settings",
						),
						array(
							"type"                      => "textfield",
							"heading"                   => __( "Define ID Name", "ts_visual_composer_extend" ),
							"param_name"                => "el_id",
							"value"                     => "",
							"description"               => __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
							"group" 			        => "Other Settings",
						),
						array(
							"type"                  	=> "tag_editor",
							"heading"           		=> __( "Extra Class Names", "ts_visual_composer_extend" ),
							"param_name"            	=> "el_class",
							"value"                 	=> "",
							"description"      		 	=> __( "Enter additional class names for the element.", "ts_visual_composer_extend" ),
							"group" 					=> "Other Settings",
						),
					)
				);
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
					return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
				} else {			
					vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
				};
			}
			function TS_VCSC_Add_GoogleMapsPlus_Element_Marker() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Google Maps Marker
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                      	=> __( "TS Google Maps Marker", "ts_visual_composer_extend" ),
					"base"                      	=> "TS_VCSC_GoogleMapsPlus_Marker",
					"icon" 	                    	=> "ts-composer-element-icon-google-maps-marker",
					"content_element"               => true,
					"as_child"                      => array('only' => 'TS_VCSC_GoogleMapsPlus_Container'),
					"description"               	=> __("Place a marker to this Google Map", "ts_visual_composer_extend"),
					"category"                  	=> __( "Composium", "ts_visual_composer_extend" ),
					"admin_enqueue_js"        		=> "",
					"admin_enqueue_css"       		=> "",
					"front_enqueue_js"				=> "",
					"front_enqueue_css"				=> "",
					"params"                    	=> array(
						// Marker Information
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1a",
							"seperator"				=> "Marker Information"
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Marker Title", "ts_visual_composer_extend" ),
							"param_name"            => "marker_title",
							"value"                 => "",
							"admin_label"           => true,
							"description"	        => __( "Please provide a title for the infowindow.", "ts_visual_composer_extend"),
						),
						array(
							"type"                  => "tag_editor",
							"heading"           	=> __( "Marker Groups", "ts_visual_composer_extend" ),
							"param_name"            => "marker_group",
							"value"                 => "",
							"delimiter"				=> "|",
							"lowercase"				=> "false",
							"description"      		=> __( "Optionally, please provide names of groups this marker belongs to; press ENTER after each group name.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  => "tag_editor",
							"heading"           	=> __( "Marker Tags", "ts_visual_composer_extend" ),
							"param_name"            => "marker_tags",
							"value"                 => "",
							"delimiter"				=> "|",
							"lowercase"				=> "false",
							"description"      		=> __( "Optionally, please provide searchable tags for the marker; press ENTER after each tag string.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Trigger Streetview", "ts_visual_composer_extend" ),
							"param_name"            => "marker_streetview",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if clicking the marker should also open a streetview, along with the optional infowindow.", "ts_visual_composer_extend" ),
						),
						// Streetview Adjustments
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Streetview: Point-Of-View", "ts_visual_composer_extend" ),
							"param_name"            => "marker_streetadjust",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if you want to adjust the point-of-view for the streetview (heading and pitch).", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker_streetview", 'value' => 'true' ),
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Streetview: Heading", "ts_visual_composer_extend" ),
							"param_name"            => "marker_streetheading",
							"value"                 => "0",
							"min"                   => "0",
							"max"                   => "360",
							"step"                  => "1",
							"unit"                  => '°',
							"description"           => __( "Define the rotation angle around the camera locus in degrees relative from true north. Headings are measured clockwise (90 degrees is true east).", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker_streetadjust", 'value' => 'true' ),
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Streetview: Pitch", "ts_visual_composer_extend" ),
							"param_name"            => "marker_streetpitch",
							"value"                 => "0",
							"min"                   => "-90",
							"max"                   => "90",
							"step"                  => "1",
							"unit"                  => '°',
							"description"           => __( "Definee the angle variance 'up' or 'down' from the camera's initial default pitch, which is often (but not always) flat horizontal.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker_streetadjust", 'value' => 'true' ),
						),
						// Marker Location
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1b",
							"seperator"				=> "Marker Location"
						),
						array(
							"type"			        => "dropdown",
							"heading"               => __( "Marker Location", "ts_visual_composer_extend" ),
							"param_name"            => "marker_position",
							"value"			        => array(
								__( "Coordinates", "ts_visual_composer_extend")           	=> "coordinates",
								__( "Address", "ts_visual_composer_extend" )        		=> "address",
							),
							"description"           => __( "Please define how you want to provide the location for this marker.", "ts_visual_composer_extend" ),
						),						
						array(
							"type"		            => "textfield",
							"heading"               => __( "Marker Latitude", "ts_visual_composer_extend" ),
							"param_name"            => "marker_latitude",
							"value"                 => "",
							"admin_label"           => true,
							"description"	        => __( "Please provide the latitude for the map marker.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker_position", 'value' => 'coordinates' ),
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Marker Longitude", "ts_visual_composer_extend" ),
							"param_name"            => "marker_longitude",
							"value"                 => "",
							"admin_label"           => true,
							"description"	        => __( "Please provide the longitude for the map marker.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker_position", 'value' => 'coordinates' ),
						),						
						array(
							"type"		            => "textfield",
							"heading"               => __( "Marker Address", "ts_visual_composer_extend" ),
							"param_name"            => "marker_address",
							"value"                 => "",
							"admin_label"           => true,
							"description"	        => __( "Please provide the address for the map marker.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker_position", 'value' => 'address' ),
						),
						// Marker Featured Image
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1c",
							"seperator"				=> "Marker Image"
						),
						array(
							"type"                  => "attach_image",
							"heading"               => __( "Featured Image", "ts_visual_composer_extend" ),
							"param_name"            => "marker_featured",
							"value"                 => "",
							"description"           => __( "Select an optional featured image to be shown alongside this location within the optional location listing that can be shown below the map.", "ts_visual_composer_extend" ),
						),
						// Marker Identifier
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1d",
							"seperator"				=> "Marker Identifier",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Optional Marker ID", "ts_visual_composer_extend" ),
							"param_name"            => "marker_identifier",
							"value"                 => "",
							"description"	        => __( "Please provide an optional and unique ID for this marker, to be used to identify and target the marker for various internal routines; otherwise, a random ID will be assigned.", "ts_visual_composer_extend"),
						),
						// Infowindow Content
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_2a",
							"seperator"				=> "Infowindow Content",
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Auto-Show Infowindow", "ts_visual_composer_extend" ),
							"param_name"            => "marker_popup",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if the infowindow should be shown automatically after the map has been rendered; will not be applied if marker clustering is enabled and should be limited to one such popup per map.", "ts_visual_composer_extend" ),
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Show Title in InfoWindow", "ts_visual_composer_extend" ),
							"param_name"            => "marker_include",
							"value"                 => "true",
							"description"           => __( "Switch the toggle if the marker title should also be shown in the infowindow.", "ts_visual_composer_extend" ),
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"		            => "textarea_html",
							"heading"               => __( "Marker Content", "ts_visual_composer_extend" ),
							"param_name"            => "content",
							"value"                 => "",
							"admin_label"			=> false,
							"description"           => __( "Enter the infowindow content but keep its limited size on the map in mind.", "ts_visual_composer_extend" ),
							"group"					=> "Marker Infowindow",
						),
						// Infowindow Buttons
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_2b",
							"seperator"				=> "Infowindow Buttons",
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Show Directions Button", "ts_visual_composer_extend" ),
							"param_name"            => "marker_directions",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if you want to show a link to generate directions inside the infowindow.", "ts_visual_composer_extend" ),
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Button Text", "ts_visual_composer_extend" ),
							"param_name"            => "marker_directions_text",
							"value"                 => (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchDirections']) ? $this->TS_VCSC_Google_MapPLUS_Language['SearchDirections'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchDirections']),
							"description"	        => __( "Please provide the text string for the directions link button inside the infowindow.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker_directions", 'value' => 'true' ),
							"group"					=> "Marker Infowindow",
						),	
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Show Google Button", "ts_visual_composer_extend" ),
							"param_name"            => "marker_viewer",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if you want to show a link to view the marker on an official Google map.", "ts_visual_composer_extend" ),
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Button Text", "ts_visual_composer_extend" ),
							"param_name"            => "marker_viewer_text",
							"value"                 => (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchGoogle']) ? $this->TS_VCSC_Google_MapPLUS_Language['SearchGoogle'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchGoogle']),
							"description"	        => __( "Please provide the text string for the Google link button inside the infowindow.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker_viewer", 'value' => 'true' ),
							"group"					=> "Marker Infowindow",
						),	
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Show Extra Button", "ts_visual_composer_extend" ),
							"param_name"            => "marker_link",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if you want to provide another custom link button inside the infowindow.", "ts_visual_composer_extend" ),
							"group"					=> "Marker Infowindow",
						),
						array(
							"type" 					=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ParameterLinkPicker['enabled'] == "false" ? "vc_link" : "advancedlinks"),
							"heading" 				=> __("Link + Title", "ts_visual_composer_extend"),
							"param_name" 			=> "marker_url",
							"description" 			=> __("Provide an optional link to another site/page, to be used for the extra button inside the infowindow.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker_link", 'value' => 'true' ),
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Button Text", "ts_visual_composer_extend" ),
							"param_name"            => "marker_button",
							"value"					=> (isset($this->TS_VCSC_Google_MapPLUS_Language['OtherLink']) ? $this->TS_VCSC_Google_MapPLUS_Language['OtherLink'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink']),
							"description"	        => __( "Please provide the text string for the extra link button inside the infowindow.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker_link", 'value' => 'true' ),
							"group"					=> "Marker Infowindow",
						),						
						// Infowindow Styling
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_2c",
							"seperator"				=> "Infowindow Styling",
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __("Infowindow Style", "ts_visual_composer_extend"),
							"param_name"            => "window_type",
							"admin_label"           => true,
							"value"                 => array(
								__("Global Map Settings", "ts_visual_composer_extend")			=> "global",
								__("Google Default Style", "ts_visual_composer_extend")			=> "google",
								__("Composium Custom Style", "ts_visual_composer_extend")		=> "override",
							),
							"description"           => __( "Select what style should be used for the marker and/or overlay infowindows.", "ts_visual_composer_extend" ),
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Infowindow Offset", "ts_visual_composer_extend" ),
							"param_name"            => "window_offset",
							"value"                 => "0",
							"min"                   => "-100",
							"max"                   => "100",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define an optional vertical offset for the infowindow in relation to the marker image.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "window_type", 'value' => array('google', 'override') ),
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __("Infowindow Closer Position", "ts_visual_composer_extend"),
							"param_name"            => "window_closer",
							"value"                 => array(
								__("Top Right", "ts_visual_composer_extend")					=> "topright",
								__("Top Center", "ts_visual_composer_extend")					=> "topcenter",
								__("Top Left", "ts_visual_composer_extend")						=> "topleft",								
								__("Bottom Right", "ts_visual_composer_extend")					=> "bottomright",
								__("Bottom Center", "ts_visual_composer_extend")				=> "bottomcenter",
								__("Bottom Left", "ts_visual_composer_extend")					=> "bottomleft",
							),
							"description"           => __( "Select where the close button for the infowindows should be placed.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "window_type", 'value' => 'override' ),
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Infowindow Shadow", "ts_visual_composer_extend" ),
							"param_name"            => "window_shadow",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if you want to add a shadow effect to the infowindows.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "window_type", 'value' => 'override' ),
							"group"					=> "Marker Infowindow",
						),	
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Infowindow Background Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "window_background",
							"value"             	=> "#333333",
							"description"       	=> __( "Define the global background color for the infowindows.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "window_type", 'value' => 'override' ),
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Infowindow Font Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "window_fontcolor",
							"value"             	=> "#ffffff",
							"description"       	=> __( "Define the global font color for the infowindows.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "window_type", 'value' => 'override' ),
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Infowindow Arrow", "ts_visual_composer_extend" ),
							"param_name"            => "window_arrowshow",
							"value"                 => "true",
							"description"           => __( "Switch the toggle if you want to add a down arrow to the infowindows, pointing towards the marker.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "window_type", 'value' => 'override' ),
							"group"					=> "Marker Infowindow",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Infowindow Arrow Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "window_arrowcolor",
							"value"             	=> "#333333",
							"description"       	=> __( "Define the global background color for the infowindow arrows.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "window_arrowshow", 'value' => 'true' ),
							"group"					=> "Marker Infowindow",
						),
						// Marker Style
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_3a",
							"seperator"				=> "Marker Settings",
							"group"					=> "Marker Style",
						),
						array(
							"type"			        => "dropdown",
							"heading"               => __( "Marker Style", "ts_visual_composer_extend" ),
							"param_name"            => "marker_style",
							"value"			        => array(
								__( "Default Marker", "ts_visual_composer_extend")           	=> "default",
								__( "Marker Selection", "ts_visual_composer_extend" )        	=> "internal",
								__( "Wordpress Image", "ts_visual_composer_extend" )			=> "image",
								__( "External Image", "ts_visual_composer_extend" )          	=> "external",								
							),
							"group"					=> "Marker Style",
						),						
						array(
							"type" 					=> "icons_panel",
							"heading" 				=> __( 'Marker Icon', 'ts_visual_composer_extend' ),
							"param_name" 			=> 'marker_internal',
							"value"					=> "",
							"settings" 				=> array(
								"emptyIcon" 			=> false,
								"emptyIconValue"		=> 'transparent',
								"iconsPerPage"			=> 198,
								"override"				=> true,
								"type" 					=> 'mapmarkers',
							),
							"description"           => __( "Select the marker image you want to use as marker.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker_style", 'value' => 'internal' ),
							"group"					=> "Marker Style",
						),
						array(
							"type"                  => "attach_image",
							"heading"               => __( "Custom Marker Image", "ts_visual_composer_extend" ),
							"param_name"            => "marker_image",
							"value"                 => "",
							"description"           => __( "Select the image you want to use as marker; should have a maximum equal dimension of 64x64.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker_style", 'value' => 'image' ),
							"group"					=> "Marker Style",
						),					
						array(
							"type"		            => "textfield",
							"heading"               => __( "External Marker Path", "ts_visual_composer_extend" ),
							"param_name"            => "marker_external",
							"value"					=> "",
							"description"	        => __( "Please provide the full external path to the image to be used for the marker; should have a maximum equal dimension of 64x64.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker_style", 'value' => 'external' ),
							"group"					=> "Marker Style",
						),						
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Marker Width", "ts_visual_composer_extend" ),
							"param_name"			=> "marker_width",
							"value"					=> "32",
							"min"					=> "16",
							"max"					=> "96",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the width that should be used to display the marker on the map.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker_style", 'value' => array('image', 'external') ),
							"group"					=> "Marker Style",
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Marker Height", "ts_visual_composer_extend" ),
							"param_name"			=> "marker_height",
							"value"					=> "32",
							"min"					=> "16",
							"max"					=> "96",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the height that should be used to display the marker on the map.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker_style", 'value' => array('image', 'external') ),
							"group"					=> "Marker Style",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Marker Animation", "ts_visual_composer_extend" ),
							"param_name"            => "marker_animation",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if you want to animate the marker when it enters the map.", "ts_visual_composer_extend" ),
							"group"					=> "Marker Style",
						),
						array(
							"type"			        => "dropdown",
							"heading"               => __( "Animation Type", "ts_visual_composer_extend" ),
							"param_name"            => "marker_entry",
							"value"			        => array(
								__( "Drop", "ts_visual_composer_extend")                 => "drop",
								__( "Bounce", "ts_visual_composer_extend" )              => "bounce",
							),
							"description"           => __( "Select the type of animation the marker should have when it enters the map.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker_animation", 'value' => 'true' ),
							"group"					=> "Marker Style",
						),
					)
				);
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
					return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
				} else {			
					vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
				};
			}
			function TS_VCSC_Add_GoogleMapsPlus_Element_Overlay() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Google Maps Overlay
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                      	=> __( "TS Google Maps Overlay", "ts_visual_composer_extend" ),
					"base"                      	=> "TS_VCSC_GoogleMapsPlus_Overlay",
					"icon" 	                    	=> "ts-composer-element-icon-google-maps-overlay",
					"content_element"               => true,
					"as_child"                      => array('only' => 'TS_VCSC_GoogleMapsPlus_Container'),
					"description"               	=> __("Place an overlay to this Google Map", "ts_visual_composer_extend"),
					"category"                  	=> __( "Composium", "ts_visual_composer_extend" ),
					"admin_enqueue_js"        		=> "",
					"admin_enqueue_css"       		=> "",
					"front_enqueue_js"				=> "",
					"front_enqueue_css"				=> "",
					"params"                    	=> array(
						// Overlay Information
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1a",
							"seperator"				=> "Overlay Information",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Overlay Title", "ts_visual_composer_extend" ),
							"param_name"            => "overlay_title",
							"value"                 => "",
							"admin_label"           => true,
							"description"	        => __( "Please provide a title for the infowindow.", "ts_visual_composer_extend"),
						),
						array(
							"type"                  => "tag_editor",
							"heading"           	=> __( "Overlay Groups", "ts_visual_composer_extend" ),
							"param_name"            => "overlay_group",
							"value"                 => "",
							"delimiter"				=> "|",
							"lowercase"				=> "false",
							"description"      		=> __( "Optionally, please provide names of groups this overlay belongs to; press ENTER after each group name.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  => "tag_editor",
							"heading"           	=> __( "Overlay Tags", "ts_visual_composer_extend" ),
							"param_name"            => "overlay_tags",
							"value"                 => "",
							"delimiter"				=> "|",
							"lowercase"				=> "false",
							"description"      		=> __( "Optionally, please provide searchable tags for the overlay; press ENTER after each tag string.", "ts_visual_composer_extend" ),
						),
						// Overlay Information
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1b",
							"seperator"				=> "Overlay Type",
						),
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Overlay Type", "ts_visual_composer_extend" ),
							"param_name"			=> "overlay_type",
							"value"					=> array(
								"Circle"						=> "circle",
								"Rectangle"						=> "rectangle",
								"Polygon"						=> "polygon",
								"Polyline"						=> "polyline",
							),
							"admin_label"			=> true,
							"description"			=> __( "Select what type of overlay you want to create.", "ts_visual_composer_extend" ),							
						),
						// Circle Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1c",
							"seperator"				=> "Circle Settings",
							"dependency"            => array( 'element' => "overlay_type", 'value' => 'circle' ),
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Circle Latitude", "ts_visual_composer_extend" ),
							"param_name"            => "circle_latitude",
							"value"                 => "",
							"description"	        => __( "Please provide the latitude for the circle center.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "overlay_type", 'value' => 'circle' ),
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Circle Longitude", "ts_visual_composer_extend" ),
							"param_name"            => "circle_longitude",
							"value"                 => "",
							"description"	        => __( "Please provide the longitude for the circle center.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "overlay_type", 'value' => 'circle' ),
						),
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Radius Unit", "ts_visual_composer_extend" ),
							"param_name"			=> "circle_radius_unit",
							"value"					=> array(
								"Miles"						=> "miles",
								"Feet"						=> "feet",
								"Meters"					=> "meters",
								"Kilometers"				=> "kilometers",
							),
							"admin_label"			=> true,
							"description"			=> __( "Select what unit you want to apply to the circle radius.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "overlay_type", 'value' => 'circle' ),
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Circle Radius", "ts_visual_composer_extend" ),
							"param_name"        	=> "circle_radius_miles",
							"value"             	=> "10",
							"min"               	=> "1",
							"max"               	=> "500",
							"step"              	=> "1",
							"unit"              	=> 'Mi',
							"description"       	=> __( "Define the radius for the circle overlay.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "circle_radius_unit", 'value' => 'miles' ),
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Circle Radius", "ts_visual_composer_extend" ),
							"param_name"        	=> "circle_radius_feet",
							"value"             	=> "10000",
							"min"               	=> "1",
							"max"               	=> "100000",
							"step"              	=> "100",
							"unit"              	=> 'ft',
							"description"       	=> __( "Define the radius for the circle overlay.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "circle_radius_unit", 'value' => 'feet' ),
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Circle Radius", "ts_visual_composer_extend" ),
							"param_name"        	=> "circle_radius_km",
							"value"             	=> "10",
							"min"               	=> "1",
							"max"               	=> "1000",
							"step"              	=> "1",
							"unit"              	=> 'KM',
							"description"       	=> __( "Define the radius for the circle overlay.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "circle_radius_unit", 'value' => 'kilometers' ),
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Circle Radius", "ts_visual_composer_extend" ),
							"param_name"        	=> "circle_radius_meters",
							"value"             	=> "1000",
							"min"               	=> "1",
							"max"               	=> "10000",
							"step"              	=> "10",
							"unit"              	=> 'm',
							"description"       	=> __( "Define the radius for the circle overlay.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "circle_radius_unit", 'value' => 'meters' ),
						),
						// Rectangle Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1d",
							"seperator"				=> "Rectangle North-East (Upper Right) Settings",
							"dependency"            => array( 'element' => "overlay_type", 'value' => 'rectangle' ),
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "North-East Latitude", "ts_visual_composer_extend" ),
							"param_name"            => "rectangle_nelatitude",
							"value"                 => "",
							"description"	        => __( "Please provide the north-east latitude for the rectangle (upper right corner).", "ts_visual_composer_extend"),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "overlay_type", 'value' => 'rectangle' ),
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "North-East Longitude", "ts_visual_composer_extend" ),
							"param_name"            => "rectangle_nelongitude",
							"value"                 => "",
							"description"	        => __( "Please provide the north-east longitude for the rectangle (upper right corner).", "ts_visual_composer_extend"),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "overlay_type", 'value' => 'rectangle' ),
						),						
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1e",
							"seperator"				=> "Rectangle South-West (Lower Left) Settings",
							"dependency"            => array( 'element' => "overlay_type", 'value' => 'rectangle' ),
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "South-West Latitude", "ts_visual_composer_extend" ),
							"param_name"            => "rectangle_swlatitude",
							"value"                 => "",
							"description"	        => __( "Please provide the south-west latitude for the rectangle (lower left corner).", "ts_visual_composer_extend"),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "overlay_type", 'value' => 'rectangle' ),
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "South-West Longitude", "ts_visual_composer_extend" ),
							"param_name"            => "rectangle_swlongitude",
							"value"                 => "",
							"description"	        => __( "Please provide the south-west longitude for the rectangle (lower left corner).", "ts_visual_composer_extend"),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "overlay_type", 'value' => 'rectangle' ),
						),
						// Polygon + Polyline Group
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1f",
							"seperator"				=> "Poly-Object Settings",
							"dependency"            => array( 'element' => "overlay_type", 'value' => array('polygon', 'polyline') ),
						),						
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Coordinates Input", "ts_visual_composer_extend" ),
							"param_name"			=> "polytype_input",
							"value"					=> array(
								"Repeatable Group Entry"		=> "group",
								"Quick Entry (Line Break)"		=> "exploded",
							),
							"dependency"			=> array( 'element' => "overlay_type", 'value' => array('polygon', 'polyline')),
							"description"			=> __( "Select how you want to provide the coordinates for hte polygon or polyline.", "ts_visual_composer_extend" ),							
						),						
						array(
							'type'					=> 'param_group',
							'heading'				=> __( 'Polygon + Polyline Coordinates', 'ts_visual_composer_extend' ),
							'param_name'			=> 'polytype_coordinates',
							'description'			=> __( 'Enter at least three coordinates for a polygon or two for a polyline, using the repeatable group below.', 'ts_visual_composer_extend' ),
							'save_always'			=> true,
							'value'					=> urlencode(json_encode(array(
								array(
									'coordinates' 				=> '',
								),
							))),
							'params'				=> array(
								array(
									'type' 						=> 'textfield',
									'heading' 					=> __( 'Latitude / Longitude', 'ts_visual_composer_extend' ),
									'param_name' 				=> 'coordinates',
									'description' 				=> __( 'Enter the coordinates (latitude + longitude; separated by comma) of this location in the polygon or polyline.', 'ts_visual_composer_extend' ),
									'admin_label' 				=> true,
								),
							),
							"dependency"			=> array( 'element' => "polytype_input", 'value' => 'group'),
						),
						array(
							"type"                  => "exploded_textarea",
							"heading"               => __( "Polygon + Polyline Coordinates", "ts_visual_composer_extend" ),
							"param_name"            => "polytype_datasets",
							"value"                 => "",
							"description"           => __( "Enter the coordinate sets like '52.49477475/13.52567196' (Latitude/Longitude); separate individual coordinate sets by line break and do not use commas.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "polytype_input", 'value' => 'exploded'),
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Make Geodesic Polyline", "ts_visual_composer_extend" ),
							"param_name"            => "polytype_geodesic",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if you want to display the polyline segments as geodesic lines.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "overlay_type", 'value' => 'polyline'),
						),
						// Overlay Featured Image
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1g",
							"seperator"				=> "Overlay Image"
						),
						array(
							"type"                  => "attach_image",
							"heading"               => __( "Featured Image", "ts_visual_composer_extend" ),
							"param_name"            => "overlay_featured",
							"value"                 => "",
							"description"           => __( "Select an optional featured image to be shown alongside this location within the optional location listing that can be shown below the map.", "ts_visual_composer_extend" ),
						),						
						// Overlay Identifier
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1h",
							"seperator"				=> "Overlay Identifier",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Optional Overlay ID", "ts_visual_composer_extend" ),
							"param_name"            => "overlay_identifier",
							"value"                 => "",
							"description"	        => __( "Please provide an optional and unique ID for this overlay, to be used to identify and target the marker for various internal routines; otherwise, a random ID will be assigned.", "ts_visual_composer_extend"),
						),						
						// Overlay Style
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_2a",
							"seperator"				=> "Overlay Style",
							"group"					=> "Overlay Style",
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Stroke Strength", "ts_visual_composer_extend" ),
							"param_name"        	=> "style_stroke_weight",
							"value"             	=> "2",
							"min"               	=> "1",
							"max"               	=> "10",
							"step"              	=> "1",
							"unit"              	=> 'px',
							"description"       	=> __( "Define the stroke strength of the overlay outline.", "ts_visual_composer_extend" ),
							"group"					=> "Overlay Style",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Stroke Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "style_stroke_rgba",
							"value"             	=> "rgba(255, 0, 0, 1)",
							"description"       	=> __( "Define the stroke color for the overlay outline.", "ts_visual_composer_extend" ),
							"group"					=> "Overlay Style",
						),		
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Fill Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "style_fill_rgba",
							"value"             	=> "rgba(255, 0, 0, 0.2)",
							"description"       	=> __( "Define the fill color for the overlay.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "overlay_type", 'value' => array('circle', 'rectangle', 'polygon')),
							"group"					=> "Overlay Style",
						),						
						// Infowindow Content
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_3a",
							"seperator"				=> "Overlay Content",
							"dependency"			=> array( 'element' => "overlay_type", 'value' => array('circle', 'rectangle', 'polygon', 'polyline')),
							"group"					=> "Overlay Infowindow",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Show Infowindow", "ts_visual_composer_extend" ),
							"param_name"            => "overlay_popup",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if the infowindow should be shown automatically after the map has been rendered; will not be applied if marker clustering is enabled and should be limited to one such popup per map.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "overlay_type", 'value' => array('circle', 'rectangle', 'polygon', 'polyline')),
							"group"					=> "Overlay Infowindow",
						),
						array(
							"type"		            => "textarea_html",
							"heading"               => __( "Overlay Content", "ts_visual_composer_extend" ),
							"param_name"            => "content",
							"value"                 => "",
							"admin_label"			=> false,
							"description"           => __( "Enter the infowindow content but keep its limited size on the map in mind.", "ts_visual_composer_extend" ),
							"dependency"			=> array( 'element' => "overlay_type", 'value' => array('circle', 'rectangle', 'polygon', 'polyline')),
							"group"					=> "Overlay Infowindow",
						),
						// Infowindow Button
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Show Extra Button", "ts_visual_composer_extend" ),
							"param_name"            => "overlay_link",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if you want to provide another custom link button inside the infowindow.", "ts_visual_composer_extend" ),
							"group"					=> "Overlay Infowindow",
						),
						array(
							"type" 					=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ParameterLinkPicker['enabled'] == "false" ? "vc_link" : "advancedlinks"),
							"heading" 				=> __("Link + Title", "ts_visual_composer_extend"),
							"param_name" 			=> "overlay_url",
							"description" 			=> __("Provide an optional link to another site/page, to be used for the extra button inside the infowindow.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "overlay_link", 'value' => 'true' ),
							"group"					=> "Overlay Infowindow",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Button Text", "ts_visual_composer_extend" ),
							"param_name"            => "overlay_button",
							"value"					=> (isset($this->TS_VCSC_Google_MapPLUS_Language['OtherLink']) ? $this->TS_VCSC_Google_MapPLUS_Language['OtherLink'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink']),
							"description"	        => __( "Please provide the text string for the extra link button inside the infowindow.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "overlay_link", 'value' => 'true' ),
							"group"					=> "Overlay Infowindow",
						),			
						// Other Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_4a",
							"seperator"				=> "Other Settings",
							"group"					=> "Other Settings",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Overlay Draggable", "ts_visual_composer_extend" ),
							"param_name"            => "overlay_draggable",
							"value"                 => "false",
							"admin_label"			=> true,
							"description"           => __( "Switch the toggle if the overlay should be made draggable on the map.", "ts_visual_composer_extend" ),
							"group"					=> "Other Settings",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Overlay Editable", "ts_visual_composer_extend" ),
							"param_name"            => "overlay_editable",
							"value"                 => "false",
							"admin_label"			=> true,
							"description"           => __( "Switch the toggle if the overlay should be made editable on the map.", "ts_visual_composer_extend" ),
							"group"					=> "Other Settings",
						),						
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Output Edit Changes", "ts_visual_composer_extend" ),
							"param_name"			=> "overlay_output",
							"value"					=> array(
								"None"							=> "",
								"Console Log"					=> "console",
								"Info Window"					=> "popup",
							),							
							"description"			=> __( "Select if and how any relevant changes to the overlay should be communicated after editing.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "overlay_editable", 'value' => 'true' ),
							"group"					=> "Other Settings",
						),
					)
				);
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
					return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
				} else {			
					vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
				};
			}
			function TS_VCSC_Add_GoogleMapsPlus_Element_Curveline() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Google Maps Curveline
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                      	=> __( "TS Google Maps Curveline", "ts_visual_composer_extend" ),
					"base"                      	=> "TS_VCSC_GoogleMapsPlus_Curveline",
					"icon" 	                    	=> "ts-composer-element-icon-google-maps-curveline",
					"content_element"               => true,
					"as_child"                      => array('only' => 'TS_VCSC_GoogleMapsPlus_Container'),
					"description"               	=> __("Place a curved line between two markers", "ts_visual_composer_extend"),
					"category"                  	=> __( "Composium", "ts_visual_composer_extend" ),
					"admin_enqueue_js"        		=> "",
					"admin_enqueue_css"       		=> "",
					"front_enqueue_js"				=> "",
					"front_enqueue_css"				=> "",
					"params"                    	=> array(
						// Overlay Information
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1a",
							"seperator"				=> "Curveline Information",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Curveline Title", "ts_visual_composer_extend" ),
							"param_name"            => "curveline_title",
							"value"                 => "",
							"admin_label"           => true,
							"description"	        => __( "Please provide a title for the infowindow.", "ts_visual_composer_extend"),
						),
						array(
							"type"                  => "tag_editor",
							"heading"           	=> __( "Curveline Groups", "ts_visual_composer_extend" ),
							"param_name"            => "curveline_group",
							"value"                 => "",
							"delimiter"				=> "|",
							"lowercase"				=> "false",
							"description"      		=> __( "Optionally, please provide names of groups this curveline belongs to; press ENTER after each group name.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  => "tag_editor",
							"heading"           	=> __( "Curveline Tags", "ts_visual_composer_extend" ),
							"param_name"            => "curveline_tags",
							"value"                 => "",
							"delimiter"				=> "|",
							"lowercase"				=> "false",
							"description"      		=> __( "Optionally, please provide searchable tags for the curveline; press ENTER after each tag string.", "ts_visual_composer_extend" ),
						),
						// Curveline Settings
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1b",
							"seperator"				=> "Curved Line Settings",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Start Latitude", "ts_visual_composer_extend" ),
							"param_name"            => "curveline_startlat",
							"value"                 => "",
							"description"	        => __( "Please provide the start latitude for the curved line.", "ts_visual_composer_extend"),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Start Longitude", "ts_visual_composer_extend" ),
							"param_name"            => "curveline_startlng",
							"value"                 => "",
							"description"	        => __( "Please provide the start longitude for the curved line.", "ts_visual_composer_extend"),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "End Latitude", "ts_visual_composer_extend" ),
							"param_name"            => "curveline_endlat",
							"value"                 => "",
							"description"	        => __( "Please provide the end latitude for the curved line.", "ts_visual_composer_extend"),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "End Longitude", "ts_visual_composer_extend" ),
							"param_name"            => "curveline_endlng",
							"value"                 => "",
							"description"	        => __( "Please provide the end longitude for the curved line.", "ts_visual_composer_extend"),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
						),
						array(
							"type"			        => "dropdown",
							"heading"               => __( "Curveline Position", "ts_visual_composer_extend" ),
							"param_name"            => "curveline_position",
							"value"			        => array(
								__( "Right", "ts_visual_composer_extend")				=> "right",
								__( "Left", "ts_visual_composer_extend" )        		=> "left",
							),
							"admin_label"           => true,
							"description"	        => __( "Please define on which side the line should be curved.", "ts_visual_composer_extend"),
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Curveline Curvature", "ts_visual_composer_extend" ),
							"param_name"			=> "curveline_curvature",
							"value"					=> "20",
							"min"					=> "0",
							"max"					=> "100",
							"step"					=> "1",
							"unit"					=> '',
							"admin_label"           => true,
							"description"			=> __( "Please define how strong the curvature of the line should be.", "ts_visual_composer_extend" ),
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Curveline Draggable", "ts_visual_composer_extend" ),
							"param_name"            => "curveline_draggable",
							"value"                 => "false",
							"admin_label"			=> true,
							"description"           => __( "Switch the toggle if the curveline start and end points should be made draggable on the map.", "ts_visual_composer_extend" ),
						),
						array(
							"type"					=> "dropdown",
							"heading"				=> __( "Output Drag Changes", "ts_visual_composer_extend" ),
							"param_name"			=> "curveline_output",
							"value"					=> array(
								"None"							=> "",
								"Console Log"					=> "console",
								"Info Window"					=> "popup",
							),							
							"description"			=> __( "Select if and how any position changes to the curveline should be communicated after editing.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "curveline_draggable", 'value' => 'true' ),
						),
						// Curveline Featured Image
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1c",
							"seperator"				=> "Curveline Image"
						),
						array(
							"type"                  => "attach_image",
							"heading"               => __( "Featured Image", "ts_visual_composer_extend" ),
							"param_name"            => "curveline_featured",
							"value"                 => "",
							"description"           => __( "Select an optional featured image to be shown alongside this location within the optional location listing that can be shown below the map.", "ts_visual_composer_extend" ),
						),
						// Curveline Identifier
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_1d",
							"seperator"				=> "Curveline Identifier",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Optional Curveline ID", "ts_visual_composer_extend" ),
							"param_name"            => "curveline_identifier",
							"value"                 => "",
							"description"	        => __( "Please provide an optional and unique ID for this overlay, to be used to identify and target the marker for various internal routines; otherwise, a random ID will be assigned.", "ts_visual_composer_extend"),
						),						
						// Start Marker
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_2a",
							"seperator"				=> "Start Marker Style",
							"group"					=> "Start Marker",
						),
						array(
							"type"			        => "dropdown",
							"heading"               => __( "Marker Style", "ts_visual_composer_extend" ),
							"param_name"            => "marker1_style",
							"value"			        => array(
								__( "Default Marker", "ts_visual_composer_extend")           	=> "default",
								__( "Marker Selection", "ts_visual_composer_extend" )        	=> "internal",
								__( "Wordpress Image", "ts_visual_composer_extend" )			=> "image",
								__( "External Image", "ts_visual_composer_extend" )          	=> "external",
								__( "Hide Marker", "ts_visual_composer_extend" )          		=> "hide",
							),
							"group"					=> "Start Marker",
						),						
						array(
							"type" 					=> "icons_panel",
							"heading" 				=> __( 'Marker Icon', 'ts_visual_composer_extend' ),
							"param_name" 			=> 'marker1_internal',
							"value"					=> "",
							"settings" 				=> array(
								"emptyIcon" 				=> false,
								"emptyIconValue"			=> 'transparent',
								"iconsPerPage"				=> 198,
								"override"					=> true,
								"type" 						=> 'mapmarkers',
							),							
							"description"           => __( "Select the marker image you want to use as marker.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker1_style", 'value' => 'internal' ),
							"group"					=> "Start Marker",
						),						
						array(
							"type"                  => "attach_image",
							"heading"               => __( "Marker Image", "ts_visual_composer_extend" ),
							"param_name"            => "marker1_image",
							"value"                 => "",
							"description"           => __( "Select the image you want to use as marker; should have a maximum equal dimension of 64x64.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker1_style", 'value' => 'image' ),
							"group"					=> "Start Marker",
						),				
						array(
							"type"		            => "textfield",
							"heading"               => __( "Marker Path", "ts_visual_composer_extend" ),
							"param_name"            => "marker1_external",
							"value"					=> "",
							"description"	        => __( "Please provide the full external path to the image to be used for the marker; should have a maximum equal dimension of 64x64.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker1_style", 'value' => 'external' ),
							"group"					=> "Start Marker",
						),						
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Marker Width", "ts_visual_composer_extend" ),
							"param_name"			=> "marker1_width",
							"value"					=> "32",
							"min"					=> "16",
							"max"					=> "96",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the width that should be used to display the marker on the map.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker1_style", 'value' => array('image', 'external') ),
							"group"					=> "Start Marker",
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Marker Height", "ts_visual_composer_extend" ),
							"param_name"			=> "marker1_height",
							"value"					=> "32",
							"min"					=> "16",
							"max"					=> "96",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the height that should be used to display the marker on the map.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker1_style", 'value' => array('image', 'external') ),
							"group"					=> "Start Marker",
						),
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_2b",
							"seperator"				=> "Start Marker Infowindow",
							"group"					=> "Start Marker",
						),
						array(
							"type"			        => "dropdown",
							"heading"               => __( "Marker Infowindow", "ts_visual_composer_extend" ),
							"param_name"            => "marker1_window",
							"value"			        => array(
								__( "Custom Infowindow", "ts_visual_composer_extend")			=> "custom",
								__( "No Infowindow", "ts_visual_composer_extend" )        		=> "none",
							),
							"dependency"            => array( 'element' => "marker1_style", 'value' => array('default', 'internal', 'image', 'external') ),
							"group"					=> "Start Marker",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Title Source", "ts_visual_composer_extend" ),
							"param_name"            => "marker1_reuse",
							"value"                 => "true",
							"description"           => __( "Switch the toggle if you want to use the overall curveline title for this marker.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker1_window", 'value' => array('custom') ),
							"group"					=> "Start Marker",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Marker Title", "ts_visual_composer_extend" ),
							"param_name"            => "marker1_title",
							"value"                 => "",
							"dependency"            => array( 'element' => "marker1_reuse", 'value' => 'false' ),
							"group"					=> "Start Marker",
						),
						array(
							"type"              	=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorBase64TinyMCE == "true" ? "wysiwyg_base64" : "textarea_raw_html"),
							"heading"           	=> __( "Infowindow Content", "ts_visual_composer_extend" ),
							"param_name"        	=> "marker1_content",
							"value"             	=> base64_encode(""),
							"description"       	=> __( "Enter the content for the marker infowindow.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker1_window", 'value' => array('custom') ),
							"group"					=> "Start Marker",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Show Extra Button", "ts_visual_composer_extend" ),
							"param_name"            => "marker1_link",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if you want to provide another custom link button inside the infowindow.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker1_window", 'value' => array('custom') ),
							"group"					=> "Start Marker",
						),
						array(
							"type" 					=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ParameterLinkPicker['enabled'] == "false" ? "vc_link" : "advancedlinks"),
							"heading" 				=> __("Link + Title", "ts_visual_composer_extend"),
							"param_name" 			=> "marker1_url",
							"description" 			=> __("Provide an optional link to another site/page, to be used for the extra button inside the infowindow.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker1_link", 'value' => 'true' ),
							"group"					=> "Start Marker",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Button Text", "ts_visual_composer_extend" ),
							"param_name"            => "marker1_button",
							"value"					=> (isset($this->TS_VCSC_Google_MapPLUS_Language['OtherLink']) ? $this->TS_VCSC_Google_MapPLUS_Language['OtherLink'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink']),
							"description"	        => __( "Please provide the text string for the extra link button inside the infowindow.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker1_link", 'value' => 'true' ),
							"group"					=> "Start Marker",
						),						
						// End Marker
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_3a",
							"seperator"				=> "End Marker Style",
							"group"					=> "End Marker",
						),
						array(
							"type"			        => "dropdown",
							"heading"               => __( "Marker Style", "ts_visual_composer_extend" ),
							"param_name"            => "marker2_style",
							"value"			        => array(
								__( "Same as Start Marker", "ts_visual_composer_extend")		=> "inherit",
								__( "Default Marker", "ts_visual_composer_extend")           	=> "default",
								__( "Marker Selection", "ts_visual_composer_extend" )        	=> "internal",
								__( "Wordpress Image", "ts_visual_composer_extend" )			=> "image",
								__( "External Image", "ts_visual_composer_extend" )          	=> "external",
								__( "Hide Marker", "ts_visual_composer_extend" )          		=> "hide",
							),
							"group"					=> "End Marker",
						),
						array(
							"type" 					=> "icons_panel",
							"heading" 				=> __( 'Marker Icon', 'ts_visual_composer_extend' ),
							"param_name" 			=> 'marker2_internal',
							"value"					=> "",
							"settings" 				=> array(
								"emptyIcon" 				=> false,
								"emptyIconValue"			=> 'transparent',
								"iconsPerPage"				=> 198,
								"override"					=> true,
								"type" 						=> 'mapmarkers',
							),
							"description"           => __( "Select the marker image you want to use as marker.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker2_style", 'value' => 'internal' ),
							"group"					=> "End Marker",
						),		
						array(
							"type"                  => "attach_image",
							"heading"               => __( "Marker Image", "ts_visual_composer_extend" ),
							"param_name"            => "marker2_image",
							"value"                 => "",
							"description"           => __( "Select the image you want to use as marker; should have a maximum equal dimension of 64x64.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker2_style", 'value' => 'image' ),
							"group"					=> "End Marker",
						),					
						array(
							"type"		            => "textfield",
							"heading"               => __( "Marker Path", "ts_visual_composer_extend" ),
							"param_name"            => "marker2_external",
							"value"					=> "",
							"description"	        => __( "Please provide the full external path to the image to be used for the marker; should have a maximum equal dimension of 64x64.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker2_style", 'value' => 'external' ),
							"group"					=> "End Marker",
						),						
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Marker Width", "ts_visual_composer_extend" ),
							"param_name"			=> "marker2_width",
							"value"					=> "32",
							"min"					=> "16",
							"max"					=> "96",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the width that should be used to display the marker on the map.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker2_style", 'value' => array('image', 'external') ),
							"group"					=> "End Marker",
						),
						array(
							"type"					=> "nouislider",
							"heading"				=> __( "Marker Height", "ts_visual_composer_extend" ),
							"param_name"			=> "marker2_height",
							"value"					=> "32",
							"min"					=> "16",
							"max"					=> "96",
							"step"					=> "1",
							"unit"					=> 'px',
							"description"			=> __( "Define the height that should be used to display the marker on the map.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker2_style", 'value' => array('image', 'external') ),
							"group"					=> "End Marker",
						),
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_3b",
							"seperator"				=> "End Marker Infowindow",
							"group"					=> "End Marker",
						),
						array(
							"type"			        => "dropdown",
							"heading"               => __( "End Marker Infowindow", "ts_visual_composer_extend" ),
							"param_name"            => "marker2_window",
							"value"			        => array(
								__( "Same as Start Marker", "ts_visual_composer_extend")		=> "inherit",
								__( "Custom Infowindow", "ts_visual_composer_extend")			=> "custom",
								__( "No Infowindow", "ts_visual_composer_extend" )        		=> "none",
							),
							"dependency"            => array( 'element' => "marker2_style", 'value' => array('inherit', 'default', 'internal', 'image', 'external') ),
							"group"					=> "End Marker",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Title Source", "ts_visual_composer_extend" ),
							"param_name"            => "marker2_reuse",
							"value"                 => "true",
							"description"           => __( "Switch the toggle if you want to use the overall curveline title for this marker.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker2_window", 'value' => array('custom') ),
							"group"					=> "End Marker",
						),
						array(
							"type"                  => "textfield",
							"heading"               => __( "Marker Title", "ts_visual_composer_extend" ),
							"param_name"            => "marker2_title",
							"value"                 => "",
							"dependency"            => array( 'element' => "marker2_reuse", 'value' => 'false' ),
							"group"					=> "End Marker",
						),
						array(
							"type"              	=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorBase64TinyMCE == "true" ? "wysiwyg_base64" : "textarea_raw_html"),
							"heading"           	=> __( "Infowindow Content", "ts_visual_composer_extend" ),
							"param_name"        	=> "marker2_content",
							"value"             	=> base64_encode(""),
							"description"       	=> __( "Enter the content for the marker infowindow.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker2_window", 'value' => array('custom') ),
							"group"					=> "End Marker",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Show Extra Button", "ts_visual_composer_extend" ),
							"param_name"            => "marker2_link",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if you want to provide another custom link button inside the infowindow.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "marker2_window", 'value' => array('custom') ),
							"group"					=> "End Marker",
						),
						array(
							"type" 					=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ParameterLinkPicker['enabled'] == "false" ? "vc_link" : "advancedlinks"),
							"heading" 				=> __("Link + Title", "ts_visual_composer_extend"),
							"param_name" 			=> "marker2_url",
							"description" 			=> __("Provide an optional link to another site/page, to be used for the extra button inside the infowindow.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker2_link", 'value' => 'true' ),
							"group"					=> "End Marker",
						),
						array(
							"type"		            => "textfield",
							"heading"               => __( "Button Text", "ts_visual_composer_extend" ),
							"param_name"            => "marker2_button",
							"value"					=> (isset($this->TS_VCSC_Google_MapPLUS_Language['OtherLink']) ? $this->TS_VCSC_Google_MapPLUS_Language['OtherLink'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink']),
							"description"	        => __( "Please provide the text string for the extra link button inside the infowindow.", "ts_visual_composer_extend"),
							"dependency"            => array( 'element' => "marker2_link", 'value' => 'true' ),
							"group"					=> "End Marker",
						),
						// Curveline Style
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_4a",
							"seperator"				=> "Curveline Style",
							"group"					=> "Other Styling",
						),
						array(
							"type"              	=> "nouislider",
							"heading"           	=> __( "Stroke Strength", "ts_visual_composer_extend" ),
							"param_name"        	=> "style_stroke_weight",
							"value"             	=> "2",
							"min"               	=> "1",
							"max"               	=> "10",
							"step"              	=> "1",
							"unit"              	=> 'px',
							"description"       	=> __( "Define the stroke strength of the overlay outline.", "ts_visual_composer_extend" ),
							"group"					=> "Other Styling",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Stroke Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "style_stroke_rgba",
							"value"             	=> "rgba(255, 0, 0, 1)",
							"description"       	=> __( "Define the stroke color for the overlay outline.", "ts_visual_composer_extend" ),
							"group"					=> "Other Styling",
						),
						// Infowindows Style
						array(
							"type"              	=> "seperator",
							"param_name"        	=> "seperator_4b",
							"seperator"				=> "Infowindow Style",
							"group"					=> "Other Styling",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __("Infowindow Style", "ts_visual_composer_extend"),
							"param_name"            => "window_type",
							"admin_label"           => true,
							"value"                 => array(
								__("Global Map Settings", "ts_visual_composer_extend")			=> "global",
								__("Google Default Style", "ts_visual_composer_extend")			=> "google",
								__("Composium Custom Style", "ts_visual_composer_extend")		=> "override",
							),
							"description"           => __( "Select what style should be used for the marker and/or overlay infowindows.", "ts_visual_composer_extend" ),
							"group"					=> "Other Styling",
						),
						array(
							"type"                  => "nouislider",
							"heading"               => __( "Infowindow Offset", "ts_visual_composer_extend" ),
							"param_name"            => "window_offset",
							"value"                 => "0",
							"min"                   => "-100",
							"max"                   => "100",
							"step"                  => "1",
							"unit"                  => 'px',
							"description"           => __( "Define an optional vertical offset for the infowindow in relation to the marker image.", "ts_visual_composer_extend" ),
							"dependency"            => array( 'element' => "window_type", 'value' => array('google', 'override') ),
							"group"					=> "Other Styling",
						),
						array(
							"type"                  => "dropdown",
							"heading"               => __("Infowindow Closer Position", "ts_visual_composer_extend"),
							"param_name"            => "window_closer",
							"value"                 => array(
								__("Top Right", "ts_visual_composer_extend")					=> "topright",
								__("Top Center", "ts_visual_composer_extend")					=> "topcenter",
								__("Top Left", "ts_visual_composer_extend")						=> "topleft",								
								__("Bottom Right", "ts_visual_composer_extend")					=> "bottomright",
								__("Bottom Center", "ts_visual_composer_extend")				=> "bottomcenter",
								__("Bottom Left", "ts_visual_composer_extend")					=> "bottomleft",
							),
							"description"           => __( "Select where the close button for the infowindows should be placed.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "window_type", 'value' => 'override' ),
							"group"					=> "Other Styling",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Infowindow Shadow", "ts_visual_composer_extend" ),
							"param_name"            => "window_shadow",
							"value"                 => "false",
							"description"           => __( "Switch the toggle if you want to add a shadow effect to the infowindows.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "window_type", 'value' => 'override' ),
							"group"					=> "Other Styling",
						),	
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Infowindow Background Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "window_background",
							"value"             	=> "#333333",
							"description"       	=> __( "Define the global background color for the infowindows.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "window_type", 'value' => 'override' ),
							"group"					=> "Other Styling",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Infowindow Font Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "window_fontcolor",
							"value"             	=> "#ffffff",
							"description"       	=> __( "Define the global font color for the infowindows.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "window_type", 'value' => 'override' ),
							"group"					=> "Other Styling",
						),
						array(
							"type"              	=> "switch_button",
							"heading"               => __( "Infowindow Arrow", "ts_visual_composer_extend" ),
							"param_name"            => "window_arrowshow",
							"value"                 => "true",
							"description"           => __( "Switch the toggle if you want to add a down arrow to the infowindows, pointing towards the marker.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "window_type", 'value' => 'override' ),
							"group"					=> "Other Styling",
						),
						array(
							"type"              	=> "colorpicker",
							"heading"           	=> __( "Infowindow Arrow Color", "ts_visual_composer_extend" ),
							"param_name"        	=> "window_arrowcolor",
							"value"             	=> "#333333",
							"description"       	=> __( "Define the global background color for the infowindow arrows.", "ts_visual_composer_extend" ),
							"edit_field_class"		=> "vc_col-sm-6 vc_column",
							"dependency"            => array( 'element' => "window_arrowshow", 'value' => 'true' ),
							"group"					=> "Other Styling",
						),
					),
				);
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
					return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
				} else {			
					vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
				};
			}
			function TS_VCSC_Add_GoogleMapsPlus_Element_Single() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Google Maps Single
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                              => __("TS Google Maps SINGLE", "ts_visual_composer_extend"),
					"base"                              => "TS_VCSC_GoogleMapsPlus_Single",
					"icon"                              => "ts-composer-element-icon-google-maps-single",
					"category"                          => __("Composium", "ts_visual_composer_extend"),
					"description"                       => __("Create an advanced Google Map (single marker)", "ts_visual_composer_extend"),
					"admin_enqueue_js"            		=> "",
					"admin_enqueue_css"           		=> "",
					"params"                            => array(
						// Map Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_1",
							"seperator"                 => "Map Settings",
						),					
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Map Type", "ts_visual_composer_extend"),
							"param_name"            	=> "googlemap_type",
							"admin_label"           	=> true,
							"value"                 	=> array(
								__("Road Map", "ts_visual_composer_extend")                  => "ROADMAP",
								__("Satellite Map", "ts_visual_composer_extend")             => "SATELLITE",
								__("Hybrid Map", "ts_visual_composer_extend")                => "HYBRID",
								__("Terrain Map", "ts_visual_composer_extend")               => "TERRAIN",
								__("Open Street Map", "ts_visual_composer_extend")           => "OSM",
							),
							"description"           	=> __( "Select the map type the map should initially be shown with.", "ts_visual_composer_extend" )
						),
						array(
							"type"			        	=> "dropdown",
							"heading"               	=> __( "Road Map Style", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_style",
							"admin_label"           	=> true,
							"value"			        	=> array(
								__( "Default", "ts_visual_composer_extend") 							=> "style_default",
								__( "Import Custom Snazzy Maps Style", "ts_visual_composer_extend")		=> "style_snazzyimport",
								__( "Apple Maps-Esque", "ts_visual_composer_extend") 					=> "style_apple_mapsesque",
								__( "Avocado World", "ts_visual_composer_extend") 						=> "style_avocado_world",
								__( "Become A Dinosaur", "ts_visual_composer_extend") 					=> "style_become_dinosaur",
								__( "Bentley", "ts_visual_composer_extend") 							=> "style_bentley",
								__( "Black And White", "ts_visual_composer_extend") 					=> "style_black_white",
								__( "Blue Essence", "ts_visual_composer_extend") 						=> "style_blue_essence",
								__( "Blue Gray", "ts_visual_composer_extend") 							=> "style_blue_gray",
								__( "Blue Water", "ts_visual_composer_extend") 							=> "style_blue_water",
								__( "Bright & Bubbly", "ts_visual_composer_extend") 					=> "style_bright_bubbly",
								__( "Clean Cut", "ts_visual_composer_extend") 							=> "style_clean_cut",
								__( "Cobalt", "ts_visual_composer_extend") 								=> "style_cobalt",
								__( "Cool Gray", "ts_visual_composer_extend") 							=> "style_cool_gray",
								__( "Countries", "ts_visual_composer_extend") 							=> "style_countries",
								__( "Flat Green", "ts_visual_composer_extend") 							=> "style_flat_green",
								__( "Flat Map", "ts_visual_composer_extend") 							=> "style_flat_map",
								__( "Gowalla", "ts_visual_composer_extend") 							=> "style_gowalla",
								__( "Greyscale", "ts_visual_composer_extend") 							=> "style_greyscale",
								__( "Hopper", "ts_visual_composer_extend") 								=> "style_hopper",
								__( "Icy Blue", "ts_visual_composer_extend") 							=> "style_icy_blue",
								__( "Light Monochrome", "ts_visual_composer_extend") 					=> "style_light_monochrome",
								__( "Lunar Landscape", "ts_visual_composer_extend") 					=> "style_lunar_landscape",
								__( "Map Box", "ts_visual_composer_extend") 							=> "style_mapbox",
								__( "Midnight Commander", "ts_visual_composer_extend") 					=> "style_midnight_commander",
								__( "Nature", "ts_visual_composer_extend") 								=> "style_nature",
								__( "Neutral Blue", "ts_visual_composer_extend") 						=> "style_neutral_blue",
								__( "Old Timey", "ts_visual_composer_extend") 							=> "style_old_timey",
								__( "Pale Dawn", "ts_visual_composer_extend") 							=> "style_pale_dawn",
								__( "Paper", "ts_visual_composer_extend") 								=> "style_paper",
								__( "Red Alert", "ts_visual_composer_extend") 							=> "style_red_alert",
								__( "Red Hues", "ts_visual_composer_extend") 							=> "style_red_hues",
								__( "Retro", "ts_visual_composer_extend") 								=> "style_retro",
								__( "Route XL", "ts_visual_composer_extend") 							=> "style_route_xl",
								__( "Shades of Grey", "ts_visual_composer_extend") 						=> "style_shades_grey",
								__( "Shift Worker", "ts_visual_composer_extend") 						=> "style_shift_worker",
								__( "Snazzy Maps", "ts_visual_composer_extend") 						=> "style_snazzy_maps",
								__( "Subtle", "ts_visual_composer_extend") 								=> "style_subtle",
								__( "Subtle Grayscale", "ts_visual_composer_extend") 					=> "style_subtle_grayscale",
								__( "Unimposed Topography", "ts_visual_composer_extend") 				=> "style_unimposed_topo",
								__( "Vintage", "ts_visual_composer_extend") 							=> "style_vintage",
							),
							"description"           	=> __( "Select the color style for the road map layout.", "ts_visual_composer_extend" )
						),						
						array(
							"type"                  	=> "textfield",
							"heading"               	=> __( "Snazzy Maps Style Name", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_snazzytitle",
							"value"                 	=> "",
							"description"           	=> __( "Enter a name for your custom Snazzy Maps style here.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "googlemap_style", 'value' => 'style_snazzyimport' ),
						),
						array(
							"type"              		=> "textarea_raw_html",
							"heading"           		=> __( "Snazzy Maps Style Code", "ts_visual_composer_extend" ),
							"param_name"        		=> "googlemap_snazzycode",
							"value"             		=> base64_encode(""),
							"description"      	 		=> __( "Enter the map style code obtained from Snazzy Maps here:", "ts_visual_composer_extend" ) . ' <a href="https://snazzymaps.com/" target="_blank">SnazzyMaps</a>',
							"dependency"            	=> array( 'element' => "googlemap_style", 'value' => 'style_snazzyimport' ),
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Map Google POI's", "ts_visual_composer_extend"),
							"param_name"            	=> "googlemap_pois",
							"admin_label"           	=> true,
							"value"                 	=> array(
								__("Default (Based on Map Style)", "ts_visual_composer_extend")			=> "default",
								__("Provide POI's With Infowindow", "ts_visual_composer_extend")		=> "clickable",
								__("Provide Only POI's Labels", "ts_visual_composer_extend")			=> "inactive",
								__("Hide All POI's", "ts_visual_composer_extend")               		=> "remove",
							),
							"description"           	=> __( "Select if and how Google POI's should be displayed on the map.", "ts_visual_composer_extend" )
						),	
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Map Height", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_height",
							"value"                 	=> "450",
							"min"                   	=> "100",
							"max"                   	=> "2048",
							"step"                  	=> "1",
							"unit"                  	=> 'px',
							"admin_label"           	=> true,
							"description"           	=> __( "Define the height in pixel for the map.", "ts_visual_composer_extend" )
						),
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Streetview Height", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_street",
							"value"                 	=> "450",
							"min"                   	=> "100",
							"max"                   	=> "2048",
							"step"                  	=> "1",
							"unit"                  	=> 'px',
							"description"           	=> __( "Define the height in pixel for the streetview container (for markers with streetview enabled).", "ts_visual_composer_extend" )
						),	
						array(
							"type"			        	=> "dropdown",
							"heading"               	=> __( "Map Center / Zoom", "ts_visual_composer_extend" ),
							"param_name"            	=> "center_type",
							"value"			        	=> array(
								__( "Marker Location", "ts_visual_composer_extend" )				=> "markers",
								__( "Coordinates", "ts_visual_composer_extend")           			=> "coordinates",
								__( "Address", "ts_visual_composer_extend" )        				=> "address",
								__( "Define Based on Map Width", "ts_visual_composer_extend" )		=> "dynamic",
							),
							"description"           	=> __( "Please define how the initial and home center of the map should be determined.", "ts_visual_composer_extend" ),
						),
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Zoom Level", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_zoom",
							"value"                 	=> "12",
							"min"                   	=> "0",
							"max"                   	=> "21",
							"step"                  	=> "1",
							"unit"                  	=> '',
							"admin_label"           	=> true,
							"description"           	=> __( "Define the initial zoom level for the map.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "center_type", 'value' => array('markers', 'coordinates', 'address') ),
						),		
						array(
							"type"		            	=> "textfield",
							"heading"               	=> __( "Center Latitude", "ts_visual_composer_extend" ),
							"param_name"            	=> "center_latitude",
							"value"                	 	=> "",
							"admin_label"           	=> true,
							"description"	        	=> __( "Please provide the latitude for the map center.", "ts_visual_composer_extend"),
							"dependency"            	=> array( 'element' => "center_type", 'value' => 'coordinates' ),
						),
						array(
							"type"		            	=> "textfield",
							"heading"               	=> __( "Center Longitude", "ts_visual_composer_extend" ),
							"param_name"            	=> "center_longitude",
							"value"                 	=> "",
							"admin_label"           	=> true,
							"description"	        	=> __( "Please provide the longitude for the map center.", "ts_visual_composer_extend"),
							"dependency"            	=> array( 'element' => "center_type", 'value' => 'coordinates' ),
						),						
						array(
							"type"		            	=> "textfield",
							"heading"               	=> __( "Center Address", "ts_visual_composer_extend" ),
							"param_name"            	=> "center_address",
							"value"                	 	=> "",
							"admin_label"           	=> true,
							"description"	        	=> __( "Please provide the address for the map center.", "ts_visual_composer_extend"),
							"dependency"            	=> array( 'element' => "center_type", 'value' => 'address' ),
						),
						array(
							'type' 						=> 'param_group',
							'heading' 					=> __( 'Dynamic Center Rules', 'ts_visual_composer_extend' ),
							'param_name' 				=> 'center_dynamic',
							'description' 				=> __( 'Define the dynamic center rules for the map, applied based on the determined map width. Please start with the largest width and work your way down.', 'ts_visual_composer_extend' ),
							'save_always' 				=> true,
							"dependency"            	=> array( 'element' => "center_type", 'value' => 'dynamic' ),
							'value' 					=> urlencode(json_encode(array(
								array(
									'center_width' 				=> 4096,
									'center_type'				=> 'markers',
									'center_zoom'				=> 12,
									'center_latitude'			=> '',
									'center_longitude'			=> '',
									'center_address'			=> '',
								),
							))),
							'params' 					=> array(
								array(
									"type"              		=> "nouislider",
									"heading"           		=> __( "Maximum Map Width", "ts_visual_composer_extend" ),
									"param_name"        		=> "center_width",
									"value"             		=> "4096",
									"min"               		=> "240",
									"max"               		=> "4096",
									"step"              		=> "1",
									"unit"              		=> 'px',
									"admin_label"           	=> true,
									"description"       		=> "Define the maximum map width at which the following center rules should be applied."
								),
								array(
									"type"			        	=> "dropdown",
									"heading"               	=> __( "Map Center / Home", "ts_visual_composer_extend" ),
									"param_name"            	=> "center_type",
									"value"			        	=> array(
										__( "First Marker (No KML)", "ts_visual_composer_extend" )			=> "markers",
										__( "Custom Coordinates", "ts_visual_composer_extend")				=> "coordinates",
										__( "Custom Address", "ts_visual_composer_extend" )					=> "address",
										__( "Fit All Objects", "ts_visual_composer_extend" )        		=> "fitall",
									),
									"admin_label"           	=> true,
									"description"           	=> __( "Please define how the center of the map should be determined.", "ts_visual_composer_extend" ),
								),
								array(
									"type"                  	=> "nouislider",
									"heading"               	=> __( "Zoom Level", "ts_visual_composer_extend" ),
									"param_name"            	=> "center_zoom",
									"value"                 	=> "12",
									"min"                   	=> "0",
									"max"                   	=> "21",
									"step"                  	=> "1",
									"unit"                  	=> '',
									"description"           	=> __( "Define the initial and home button zoom level for the map.", "ts_visual_composer_extend" ),
									"dependency"            	=> array( 'element' => "center_type", 'value' => array('markers', 'coordinates', 'address') ),
								),		
								array(
									"type"		            	=> "textfield",
									"heading"               	=> __( "Center Latitude", "ts_visual_composer_extend" ),
									"param_name"            	=> "center_latitude",
									"value"                	 	=> "",
									"description"	        	=> __( "Please provide the latitude for the map center.", "ts_visual_composer_extend"),
									"dependency"            	=> array( 'element' => "center_type", 'value' => 'coordinates' ),
								),
								array(
									"type"		            	=> "textfield",
									"heading"               	=> __( "Center Longitude", "ts_visual_composer_extend" ),
									"param_name"            	=> "center_longitude",
									"value"                 	=> "",
									"description"	        	=> __( "Please provide the longitude for the map center.", "ts_visual_composer_extend"),
									"dependency"            	=> array( 'element' => "center_type", 'value' => 'coordinates' ),
								),						
								array(
									"type"		            	=> "textfield",
									"heading"               	=> __( "Center Address", "ts_visual_composer_extend" ),
									"param_name"            	=> "center_address",
									"value"                	 	=> "",
									"description"	        	=> __( "Please provide the address for the map center.", "ts_visual_composer_extend"),
									"dependency"            	=> array( 'element' => "center_type", 'value' => 'address' ),
								),
								
							)
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Resize Event", "ts_visual_composer_extend"),
							"param_name"            	=> "googlemap_resize",
							"admin_label"           	=> true,
							"value"                 	=> array(
								__("No Change", "ts_visual_composer_extend")                  	=> "none",
								__("Set Map to Initial State", "ts_visual_composer_extend")		=> "redraw",
								__("Fit Map to Show All Markers", "ts_visual_composer_extend")	=> "fitmarkers",
							),
							"description"           	=> __( "Select how the map should react if a window resize event has been detected.", "ts_visual_composer_extend" )
						),						
						/*array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Require Activate on Mobile", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_mobile",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if the map should require activation on mobile devices to ease scrolling.", "ts_visual_composer_extend" )
						),*/						
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Require Map Activation", "ts_visual_composer_extend"),
							"param_name"            	=> "googlemap_mobile",
							"admin_label"           	=> true,
							"value"                 	=> array(
								__("Do Not Require Activation", "ts_visual_composer_extend")	=> "false",
								__("Mobile Devices Only", "ts_visual_composer_extend")			=> "true",
								__("Require On All Devices", "ts_visual_composer_extend")		=> "always",
							),
							"description"           	=> __( "Select if the map should require a manual activation to make it visible on the screen.", "ts_visual_composer_extend" )
						),		
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Use Metric Dimensions", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_metric",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to use metric dimensions for distances and speeds.", "ts_visual_composer_extend" )
						),						
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Make Map Full-Width", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_full",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want attempt showing the map in full width (will not work with all themes).", "ts_visual_composer_extend" )
						),
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Full Width Breakouts", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_breaks",
							"value"                 	=> "0",
							"min"                   	=> "0",
							"max"                   	=> "99",
							"step"                  	=> "1",
							"unit"                  	=> '',
							"description"           	=> __( "Define the number of parent containers the map should attempt to break away from.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "googlemap_full", 'value' => 'true' )
						),
						// API Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_2",
							"seperator"                 => "API Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Load Google Map API", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_api",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to load the Google Map API; disable only if the API is already loaded by another plugin or theme as it is required for the map.", "ts_visual_composer_extend" )
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Localize Google Map", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_localize",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to forcibly localize the map; otherwise, language and region settings will be used based on browser settings. Using this option will affect ALL maps on this page or post!", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "googlemap_api", 'value' => 'true' ),
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Google Map Language", "ts_visual_composer_extend"),
							"param_name"            	=> "googlemap_language",
							"value"                 	=> array_flip($this->TS_VCSC_GoogleMapsPlus_Localizations("language")),
							"description"           	=> __( "Select the language that should be used for Google internal textual information within the map.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"default"					=> "en",
							"standard"					=> "en",
							"std"						=> "en",
							"dependency"            	=> array( 'element' => "googlemap_localize", 'value' => 'true' ),
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Google Map Region", "ts_visual_composer_extend"),
							"param_name"            	=> "googlemap_region",
							"value"                 	=> array_flip($this->TS_VCSC_GoogleMapsPlus_Localizations("region")),
							"description"           	=> __( "Select the geographic region that should be used for general application behavior (can differ for individual countries).", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"default"					=> "US",
							"standard"					=> "US",
							"std"						=> "US",
							"dependency"            	=> array( 'element' => "googlemap_localize", 'value' => 'true' ),
						),	
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Geocode Delay", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_delay",
							"value"                 	=> "200",
							"min"                   	=> "0",
							"max"                   	=> "1000",
							"step"                  	=> "10",
							"unit"                  	=> 'ms',
							"description"           	=> __( "Define the delay in ms between each address geocoding request that will be sent to Google.", "ts_visual_composer_extend" )
						),						
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Load OpenLayersMap API", "ts_visual_composer_extend" ),
							"param_name"            	=> "googlemap_openlayers",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to load the OpenLayersMap API in order to add the OpenLayers style option to the map.", "ts_visual_composer_extend" )
						),
						// Standard Controls
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_3",
							"seperator"                 => "Map Handling",
							"group" 			        => "Map Handling",
						),
						array(
							"type"              		=> "switch_button",
							"heading"              	 	=> __( "Show Type Controls", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_types",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want show the controls for the different map types.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Zoom Controls", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_zoomer",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want show the map zoom controls.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Fullscreen Controls", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_fullscreen",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want show fullscreen controls.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),	
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Pan Controls", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_pan",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want show the map pan controls.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),						
						array(
							"type"			        	=> "dropdown",
							"heading"               	=> __( "Allow Map Dragging", "ts_visual_composer_extend" ),
							"param_name"            	=> "draggable_allow",
							"value"			        	=> array(
								__( "Provide On/Off Toggle", "ts_visual_composer_extend" )	=> "toggle",
								__( "All Devices", "ts_visual_composer_extend" )        	=> "all",
								__( "Desktop Devices", "ts_visual_composer_extend")			=> "desktop",
								__( "Mobile Devices", "ts_visual_composer_extend" )			=> "mobile",
								__( "Based on Screen Width", "ts_visual_composer_extend" )	=> "screen",
								__( "No Dragging", "ts_visual_composer_extend" )        	=> "none",
							),
							"description"           	=> __( "Please define if and on which devices the map can be dragged.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Minimum Screen Width", "ts_visual_composer_extend" ),
							"param_name"                => "draggable_width",
							"value"                     => "400",
							"min"                       => "240",
							"max"                       => "1280",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Define the minimum screen width at which the map should be draggable.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "draggable_allow", 'value' => 'screen' ),
							"group"						=> "Map Handling",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show StreetView Controls", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_street",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want show the map streetview controls.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Scale Controls", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_scaler",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want show the map scale controls.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),
						array(
							"type"			        	=> "dropdown",
							"heading"               	=> __( "Map Gesture Handling", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_gesture",
							"value"			        	=> array(
								__( "Use Automatic Mode", "ts_visual_composer_extend" )				=> "auto",
								__( "Use Cooperative Mode", "ts_visual_composer_extend" )        	=> "cooperative",
								__( "Use Greedy Mode", "ts_visual_composer_extend")					=> "greedy",
								__( "Disable Gesture Handling", "ts_visual_composer_extend")		=> "none",
							),
							"description"           	=> __( "Please define how gesture controls and mouse scroll events should be handled on mobile and desktop devices.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),
						array(
							"type"			        	=> "dropdown",
							"heading"               	=> __( "Mouse Wheel Event", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_wheel",
							"value"			        	=> array(
								__( "Use Automatic Mode", "ts_visual_composer_extend" )				=> "auto",
								__( "Force Mousewheel Zoom", "ts_visual_composer_extend" )        	=> "true",
								__( "Prevent Mousewheel Zoom", "ts_visual_composer_extend")			=> "false",
							),
							"description"           	=> __( "Please define how a mousewheel event above the map are should be handled. Forcing a mousewheel zoom can override any setting made in regards to the map gesture handling setting above.", "ts_visual_composer_extend" ),
							"group"						=> "Map Handling",
						),
						// Custom Controls
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_4",
							"seperator"                 => "General Options",
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Home Reset", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_home",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to provide a button to recenter and zoom the map to its initial center coordinates.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),						
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Fit All", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_bounds",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to provide a button change the map zoom and location to fit all markers.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						// Layer Controls
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_5",
							"seperator"                 => "Layer Options",
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Layer: Bicycles", "ts_visual_composer_extend" ),
							"param_name"            	=> "layers_biking",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to provide a button to add a layer with biking trails to the map.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Layer: Traffic", "ts_visual_composer_extend" ),
							"param_name"            	=> "layers_traffic",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to provide a button to add a layer with traffic information to the map.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Layer: Transit", "ts_visual_composer_extend" ),
							"param_name"            	=> "layers_transit",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to provide a button to add a layer with public transit information to the map.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						// Advanced Features
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_6",
							"seperator"                 => "Advanced Feature Controls",
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Controls: Open on Init", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_autoopen",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to render the sections with the advanced map feature controls opened or closed.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Controls: Selectbox Float", "ts_visual_composer_extend" ),
							"param_name"                => "controls_floatwidth",
							"value"                     => "400",
							"min"                       => "240",
							"max"                       => "640",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Define the screen width at which the various selectboxes are shown as floating popups instead.", "ts_visual_composer_extend" ),
							"group"						=> "Map Features",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Controls: Background Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "controls_background",
							"value"             		=> "#f9f9f9",
							"description"       		=> __( "Define the background color for the section that contains the advanced map feature controls.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Controls: Toggle Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "controls_togglecolor",
							"value"             		=> "#696969",
							"description"       		=> __( "Define the color for the toggle that shows/hides the section that contains the advanced map feature controls.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"group" 			        => "Map Features",
						),
						// Style Selector
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_7",
							"seperator"                 => "Snazzy Style Selector",
							"bordertype"				=> "dashed",
							"fontsize"					=> 16,
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Styles: Show Style Selector", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_styler",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to provide a selector so users can apply different styles to the map.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Styles: Minimum Screen Width", "ts_visual_composer_extend" ),
							"param_name"                => "styler_screenlimit",
							"value"                     => "400",
							"min"                       => "240",
							"max"                       => "1280",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Define the minimum screen width at which the styles selector should be visible.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_styler", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Styles: Show Search Option", "ts_visual_composer_extend" ),
							"param_name"            	=> "styler_search",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to provide an option to quickly search all available Snazzy Maps styles by keyword.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_styler", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						// Search Feature
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_8",
							"seperator"                 => "Search Feature",
							"bordertype"				=> "dashed",
							"fontsize"					=> 16,
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Search: Provide Search Input", "ts_visual_composer_extend" ),
							"param_name"            	=> "controls_search",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to provide a search option for users to find new addresses or coordinates on the map.", "ts_visual_composer_extend" ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Search: Minimum Screen Width", "ts_visual_composer_extend" ),
							"param_name"                => "search_screenlimit",
							"value"                     => "400",
							"min"                       => "240",
							"max"                       => "1280",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Define the minimum screen width at which the search bar should be visible.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_search", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Search: Create Infowindow", "ts_visual_composer_extend" ),
							"param_name"            	=> "search_infowindow",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to automatically create an infowindow for the search result, showing the determined coordinates and other information.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "controls_search", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Search: Auto-Open Infowindow", "ts_visual_composer_extend" ),
							"param_name"            	=> "search_autoopen",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to automatically open the infowindow for the search result.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "search_infowindow", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Search: Google Links Infowindow", "ts_visual_composer_extend" ),
							"param_name"            	=> "search_googlelinks",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to add links to the infowindow to obtain directions to the search result and to view the search result on the official Google Maps website.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "search_infowindow", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Search: Marker Zoom Level", "ts_visual_composer_extend" ),
							"param_name"                => "search_zoomlevel",
							"value"                     => "17",
							"min"                       => "0",
							"max"                       => "20",
							"step"                      => "1",
							"unit"                      => 'x',
							"description"               => __( "Define the zoom level to be used when adding a new marker to the map based on a user search.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_search", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Search: Marker Map Type", "ts_visual_composer_extend"),
							"param_name"            	=> "search_mapmarker",
							"value"                 	=> array(
								__("Road Map", "ts_visual_composer_extend")                  => "ROADMAP",
								__("Satellite Map", "ts_visual_composer_extend")             => "SATELLITE",
								__("Hybrid Map", "ts_visual_composer_extend")                => "HYBRID",
								__("Terrain Map", "ts_visual_composer_extend")               => "TERRAIN",
							),
							"description"           	=> __( "Select the map type to be used when adding a new marker to the map based on a user search.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "controls_search", 'value' => 'true' ),
							"group" 			        => "Map Features",
						),		
						// Marker Location
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_9",
							"seperator"					=> "Marker Location",			
							"group" 			        => "Marker Settings",
						),
						array(
							"type"		            	=> "textfield",
							"heading"               	=> __( "Marker Title", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_title",
							"value"                 	=> "",
							"admin_label"           	=> true,
							"description"	        	=> __( "Please provide a title for the infowindow.", "ts_visual_composer_extend"),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"			        	=> "dropdown",
							"heading"               	=> __( "Marker Location", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_position",
							"value"			        	=> array(
								__( "Coordinates", "ts_visual_composer_extend")           	=> "coordinates",
								__( "Address", "ts_visual_composer_extend" )        		=> "address",
							),
							"description"           	=> __( "Please define how you want to provide the location for this marker.", "ts_visual_composer_extend" ),
							"group" 			        => "Marker Settings",
						),						
						array(
							"type"		            	=> "textfield",
							"heading"               	=> __( "Marker Latitude", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_latitude",
							"value"                 	=> "",
							"description"	        	=> __( "Please provide the latitude for the map marker.", "ts_visual_composer_extend"),
							"dependency"            	=> array( 'element' => "marker_position", 'value' => 'coordinates' ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"		            	=> "textfield",
							"heading"               	=> __( "Marker Longitude", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_longitude",
							"value"                 	=> "",
							"description"	        	=> __( "Please provide the longitude for the map marker.", "ts_visual_composer_extend"),
							"dependency"            	=> array( 'element' => "marker_position", 'value' => 'coordinates' ),
							"group" 			        => "Marker Settings",
						),						
						array(
							"type"		            	=> "textfield",
							"heading"               	=> __( "Marker Address", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_address",
							"value"                	 	=> "",
							"description"	        	=> __( "Please provide the address for the map marker.", "ts_visual_composer_extend"),
							"dependency"            	=> array( 'element' => "marker_position", 'value' => 'address' ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Trigger Streetview", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_streetview",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if clicking the marker should also open a streetview, along with the optional infowindow.", "ts_visual_composer_extend" ),
							"group" 			        => "Marker Settings",
						),
						// Streetview Adjustments
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Streetview: Point-Of-View", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_streetadjust",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to adjust the point-of-view for the streetview (heading and pitch).", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "marker_streetview", 'value' => 'true' ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Streetview: Heading", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_streetheading",
							"value"                 	=> "0",
							"min"                   	=> "0",
							"max"                   	=> "360",
							"step"                  	=> "1",
							"unit"                  	=> '°',
							"description"           	=> __( "Define the rotation angle around the camera locus in degrees relative from true north. Headings are measured clockwise (90 degrees is true east).", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "marker_streetadjust", 'value' => 'true' ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Streetview: Pitch", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_streetpitch",
							"value"                 	=> "0",
							"min"                   	=> "-90",
							"max"                   	=> "90",
							"step"                  	=> "1",
							"unit"                  	=> '°',
							"description"           	=> __( "Definee the angle variance 'up' or 'down' from the camera's initial default pitch, which is often (but not always) flat horizontal.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "marker_streetadjust", 'value' => 'true' ),
							"group" 			        => "Marker Settings",
						),
						// Marker Content
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_10",
							"seperator"					=> "Infowindow Content",
							"group" 			        => "Marker Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Auto-Show Infowindow", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_popup",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if the infowindow should be shown automatically after the map has been rendered; should not be used when marker clustering is enabled and limit to one such popup per map.", "ts_visual_composer_extend" ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"		            	=> "textarea_html",
							"heading"               	=> __( "Marker Content", "ts_visual_composer_extend" ),
							"param_name"            	=> "content",
							"value"                 	=> "",
							"admin_label"				=> false,
							"description"           	=> __( "Enter the infowindow content but keep its limited size on the map in mind.", "ts_visual_composer_extend" ),
							"group" 			        => "Marker Settings",
						),
						// Infowindow Buttons
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_11",
							"seperator"					=> "Infowindow Buttons",
							"group" 			        => "Marker Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Directions Button", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_directions",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to show a link to generate directions inside the infowindow.", "ts_visual_composer_extend" ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Google Button", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_viewer",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to show a link to view the marker on an official Google map.", "ts_visual_composer_extend" ),
							"group" 			        => "Marker Settings",
						),	
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Show Extra Button", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_link",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to provide another custom link button inside the infowindow.", "ts_visual_composer_extend" ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type" 						=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ParameterLinkPicker['enabled'] == "false" ? "vc_link" : "advancedlinks"),
							"heading" 					=> __("Link + Title", "ts_visual_composer_extend"),
							"param_name" 				=> "marker_url",
							"description" 				=> __("Provide an optional link to another site/page, to be used for the extra button inside the infowindow.", "ts_visual_composer_extend"),
							"dependency"            	=> array( 'element' => "marker_link", 'value' => 'true' ),
							"group" 			        => "Marker Settings",
						),
						// Infowindow Style
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_12",
							"seperator"					=> "Infowindow Style",
							"group" 			        => "Marker Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Close on Map Click", "ts_visual_composer_extend" ),
							"param_name"            	=> "window_mapclick",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to close all open infowindows when clicking on the map.", "ts_visual_composer_extend" )
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Infowindow Style", "ts_visual_composer_extend"),
							"param_name"            	=> "window_global",
							"admin_label"           	=> true,
							"value"                 	=> array(
								__("Google Default Style", "ts_visual_composer_extend")			=> "google",
								__("Composium Custom Style", "ts_visual_composer_extend")		=> "override",
							),
							"description"           	=> __( "Select what global style should be used for the marker and/or overlay infowindows.", "ts_visual_composer_extend" ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"                  	=> "nouislider",
							"heading"               	=> __( "Infowindow Offset", "ts_visual_composer_extend" ),
							"param_name"            	=> "window_offset",
							"value"                 	=> "0",
							"min"                   	=> "-100",
							"max"                   	=> "100",
							"step"                  	=> "1",
							"unit"                  	=> 'px',
							"description"           	=> __( "Define an optional vertical offset for the infowindow in relation to the marker image.", "ts_visual_composer_extend" ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"                  	=> "dropdown",
							"heading"               	=> __("Infowindow Closer Position", "ts_visual_composer_extend"),
							"param_name"            	=> "window_closer",
							"value"                 	=> array(
								__("Top Right", "ts_visual_composer_extend")					=> "topright",
								__("Top Center", "ts_visual_composer_extend")					=> "topcenter",
								__("Top Left", "ts_visual_composer_extend")						=> "topleft",								
								__("Bottom Right", "ts_visual_composer_extend")					=> "bottomright",
								__("Bottom Center", "ts_visual_composer_extend")				=> "bottomcenter",
								__("Bottom Left", "ts_visual_composer_extend")					=> "bottomleft",
							),
							"description"           	=> __( "Select where the close button for the infowindows should be placed.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "window_global", 'value' => 'override' ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Infowindow Shadow", "ts_visual_composer_extend" ),
							"param_name"            	=> "window_shadow",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to add a shadow effect to the infowindows.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "window_global", 'value' => 'override' ),
							"group" 			        => "Marker Settings",
						),	
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Infowindow Background Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "window_background",
							"value"             		=> "#333333",
							"description"       		=> __( "Define the global background color for the infowindows.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "window_global", 'value' => 'override' ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Infowindow Font Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "window_fontcolor",
							"value"             		=> "#ffffff",
							"description"       		=> __( "Define the global font color for the infowindows.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "window_global", 'value' => 'override' ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Infowindow Arrow", "ts_visual_composer_extend" ),
							"param_name"            	=> "window_arrowshow",
							"value"                 	=> "true",
							"description"           	=> __( "Switch the toggle if you want to add a down arrow to the infowindows, pointing towards the marker.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "window_global", 'value' => 'override' ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Infowindow Arrow Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "window_arrowcolor",
							"value"             		=> "#333333",
							"description"       		=> __( "Define the global background color for the infowindow arrows.", "ts_visual_composer_extend" ),
							"edit_field_class"			=> "vc_col-sm-6 vc_column",
							"dependency"            	=> array( 'element' => "window_arrowshow", 'value' => 'true' ),
							"group" 			        => "Marker Settings",
						),
						// Marker Style
						array(
							"type"              		=> "seperator",
							"param_name"        		=> "seperator_13",
							"seperator"					=> "Marker Settings",
							"group" 			        => "Marker Settings",
						),
						array(
							"type"			       	 	=> "dropdown",
							"heading"               	=> __( "Marker Style", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_style",
							"value"			        	=> array(
								__( "Default Marker", "ts_visual_composer_extend")           	=> "default",
								__( "Marker Selection", "ts_visual_composer_extend" )        	=> "internal",
								__( "Wordpress Image", "ts_visual_composer_extend" )			=> "image",
								__( "External Image", "ts_visual_composer_extend" )          	=> "external",
							),
							"group"						=> "Marker Settings",
						),
						array(
							"type"                  	=> "attach_image",
							"heading"               	=> __( "Custom Marker Image", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_image",
							"value"                 	=> "",
							"description"           	=> __( "Select the image you want to use as marker; should have a maximum equal dimension of 64x64.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "marker_style", 'value' => 'image' ),
							"group"						=> "Marker Settings",
						),
						array(
							"type" 						=> "icons_panel",
							"heading" 					=> __( 'Marker Icon', 'ts_visual_composer_extend' ),
							"param_name" 				=> 'marker_internal',
							"value"						=> "",
							"settings" 					=> array(
								"emptyIcon" 				=> false,
								"emptyIconValue"			=> 'transparent',
								"iconsPerPage"				=> 198,
								"override"					=> true,
								"type" 						=> 'mapmarkers',
							),
							"description"           	=> __( "Select the marker image you want to use as marker.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "marker_style", 'value' => 'internal' ),
							"group"						=> "Marker Settings",
						),						
						array(
							"type"		            	=> "textfield",
							"heading"               	=> __( "External Marker Path", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_external",
							"value"						=> "",
							"description"	        	=> __( "Please provide the full external path to the image to be used for the marker; should have a maximum equal dimension of 64x64.", "ts_visual_composer_extend"),
							"dependency"            	=> array( 'element' => "marker_style", 'value' => 'external' ),
							"group"						=> "Marker Settings",
						),						
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Marker Width", "ts_visual_composer_extend" ),
							"param_name"				=> "marker_width",
							"value"						=> "32",
							"min"						=> "16",
							"max"						=> "96",
							"step"						=> "1",
							"unit"						=> 'px',
							"description"				=> __( "Define the width that should be used to display the marker on the map.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "marker_style", 'value' => array('image', 'external') ),
							"group"						=> "Marker Settings",
						),
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Marker Height", "ts_visual_composer_extend" ),
							"param_name"				=> "marker_height",
							"value"						=> "32",
							"min"						=> "16",
							"max"						=> "96",
							"step"						=> "1",
							"unit"						=> 'px',
							"description"				=> __( "Define the height that should be used to display the marker on the map.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "marker_style", 'value' => array('image', 'external') ),
							"group"						=> "Marker Settings",
						),						
						array(
							"type"              		=> "switch_button",
							"heading"               	=> __( "Marker Animation", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_animation",
							"value"                 	=> "false",
							"description"           	=> __( "Switch the toggle if you want to animate the marker when it enters the map.", "ts_visual_composer_extend" ),
							"group" 			        => "Marker Settings",
						),
						array(
							"type"			        	=> "dropdown",
							"heading"               	=> __( "Animation Type", "ts_visual_composer_extend" ),
							"param_name"            	=> "marker_entry",
							"value"			        	=> array(
								__( "Drop", "ts_visual_composer_extend")                 => "drop",
								__( "Bounce", "ts_visual_composer_extend" )              => "bounce",
							),
							"description"           	=> __( "Select the type of animation the marker should have when it enters the map.", "ts_visual_composer_extend" ),
							"dependency"            	=> array( 'element' => "marker_animation", 'value' => 'true' ),
							"group" 			        => "Marker Settings",
						),
						// Text Strings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_14",
							"seperator"                 => "Text Strings",
							"group" 			        => "Text Strings",
						),
						array(
							"type"              		=> "messenger",
							"param_name"        		=> "messenger",
							"color"						=> "#006BB7",
							"size"						=> "13",
							"layout"					=> "notice",
							"message"            		=> __( "The map will use some text strings for buttons and other control elements. You can translate or change those text strings using the options provided below.", "ts_visual_composer_extend" ),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['MobileShow'],
							"param_name"                => "string_mobile_show",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['MobileShow']) ? $this->TS_VCSC_Google_MapPLUS_Language['MobileShow'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['MobileShow']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['MobileHide'],
							"param_name"                => "string_mobile_hide",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['MobileHide']) ? $this->TS_VCSC_Google_MapPLUS_Language['MobileHide'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['MobileHide']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListenersStart'],
							"param_name"                => "string_listeners_start",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ListenersStart']) ? $this->TS_VCSC_Google_MapPLUS_Language['ListenersStart'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListenersStart']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListenersStop'],
							"param_name"                => "string_listeners_stop",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ListenersStop']) ? $this->TS_VCSC_Google_MapPLUS_Language['ListenersStop'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ListenersStop']),
							"group" 			        => "Text Strings",
						),						
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['StyleDefault'],
							"param_name"                => "string_style_default",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['StyleDefault']) ? $this->TS_VCSC_Google_MapPLUS_Language['StyleDefault'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['StyleDefault']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['StyleLabel'],
							"param_name"                => "string_style_label",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['StyleLabel']) ? $this->TS_VCSC_Google_MapPLUS_Language['StyleLabel'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['StyleLabel']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SelectLabel'],
							"param_name"                => "string_select_label",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SelectLabel']) ? $this->TS_VCSC_Google_MapPLUS_Language['SelectLabel'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SelectLabel']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsOSM'],
							"param_name"                => "string_controls_osm",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsOSM']) ? $this->TS_VCSC_Google_MapPLUS_Language['ControlsOSM'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsOSM']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsHome'],
							"param_name"                => "string_controls_home",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsHome']) ? $this->TS_VCSC_Google_MapPLUS_Language['ControlsHome'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsHome']),
							"group" 			        => "Text Strings",
						),						
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsBounds'],
							"param_name"                => "string_controls_bounds",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsBounds']) ? $this->TS_VCSC_Google_MapPLUS_Language['ControlsBounds'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsBounds']),
							"group" 			        => "Text Strings",
						),						
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsBike'],
							"param_name"                => "string_controls_bike",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsBike']) ? $this->TS_VCSC_Google_MapPLUS_Language['ControlsBike'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsBike']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsTraffic'],
							"param_name"                => "string_controls_transit",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsTraffic']) ? $this->TS_VCSC_Google_MapPLUS_Language['ControlsTraffic'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsTraffic']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsTransit'],
							"param_name"                => "string_controls_traffic",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['ControlsTransit']) ? $this->TS_VCSC_Google_MapPLUS_Language['ControlsTransit'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['ControlsTransit']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficMiles'],
							"param_name"                => "string_traffic_miles",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['TrafficMiles']) ? $this->TS_VCSC_Google_MapPLUS_Language['TrafficMiles'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficMiles']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficKilometer'],
							"param_name"                => "string_traffic_kilometer",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['TrafficKilometer']) ? $this->TS_VCSC_Google_MapPLUS_Language['TrafficKilometer'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficKilometer']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficNone'],
							"param_name"                => "string_traffic_none",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['TrafficNone']) ? $this->TS_VCSC_Google_MapPLUS_Language['TrafficNone'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['TrafficNone']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchButton'],
							"param_name"                => "string_search_button",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchButton']) ? $this->TS_VCSC_Google_MapPLUS_Language['SearchButton'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchButton']),
							"group" 			        => "Text Strings",
						),						
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchHolder'],
							"param_name"                => "string_search_holder",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchHolder']) ? $this->TS_VCSC_Google_MapPLUS_Language['SearchHolder'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchHolder']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchGoogle'],
							"param_name"                => "string_search_google",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchGoogle']) ? $this->TS_VCSC_Google_MapPLUS_Language['SearchGoogle'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchGoogle']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchDirections'],
							"param_name"                => "string_search_directions",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SearchDirections']) ? $this->TS_VCSC_Google_MapPLUS_Language['SearchDirections'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SearchDirections']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink'],
							"param_name"                => "string_other_link",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['OtherLink']) ? $this->TS_VCSC_Google_MapPLUS_Language['OtherLink'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['OtherLink']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['PlaceholderMarker'],
							"param_name"                => "string_marker_placeholder",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['PlaceholderMarker']) ? $this->TS_VCSC_Google_MapPLUS_Language['PlaceholderMarker'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['PlaceholderMarker']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoConfirm'],
							"param_name"                => "string_sumo_confirm",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoConfirm']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoConfirm'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoConfirm']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoCancel'],
							"param_name"                => "string_sumo_cancel",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoCancel']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoCancel'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoCancel']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSelected'],
							"param_name"                => "string_sumo_selected",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSelected']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoSelected'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSelected']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoAllSelected'],
							"param_name"                => "string_sumo_allselected",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoAllSelected']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoAllSelected'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoAllSelected']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoPlaceholder'],
							"param_name"                => "string_sumo_placeholder",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoPlaceholder']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoPlaceholder'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoPlaceholder']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchLocations'],
							"param_name"                => "string_sumo_searchmarker",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSearchLocations']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoSearchLocations'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchLocations']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchGroups'],
							"param_name"                => "string_sumo_searchgroup",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSearchGroups']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoSearchGroups'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchGroups']),
							"group" 			        => "Text Strings",
						),
						array(
							"type"                    	=> "textfield",
							"heading"                   => __( "Text:", "ts_visual_composer_extend" ) . ' ' . $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchStyles'],
							"param_name"                => "string_sumo_searchstyle",
							"value"                     => (isset($this->TS_VCSC_Google_MapPLUS_Language['SumoSearchStyles']) ? $this->TS_VCSC_Google_MapPLUS_Language['SumoSearchStyles'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Google_MapPLUS_Language_Defaults['SumoSearchStyles']),
							"group" 			        => "Text Strings",
						),
						// Other Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_15",
							"seperator"                 => "Other Settings",
							"group" 			        => "Other Settings",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Margin: Top", "ts_visual_composer_extend" ),
							"param_name"                => "margin_top",
							"value"                     => "0",
							"min"                       => "0",
							"max"                       => "200",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
							"group" 			        => "Other Settings",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Margin: Bottom", "ts_visual_composer_extend" ),
							"param_name"                => "margin_bottom",
							"value"                     => "0",
							"min"                       => "0",
							"max"                       => "200",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
							"group" 			        => "Other Settings",
						),
						array(
							"type"                      => "textfield",
							"heading"                   => __( "Define ID Name", "ts_visual_composer_extend" ),
							"param_name"                => "el_id",
							"value"                     => "",
							"description"               => __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
							"group" 			        => "Other Settings",
						),
						array(
							"type"                  	=> "tag_editor",
							"heading"           		=> __( "Extra Class Names", "ts_visual_composer_extend" ),
							"param_name"            	=> "el_class",
							"value"                 	=> "",
							"description"      		 	=> __( "Enter additional class names for the element.", "ts_visual_composer_extend" ),
							"group" 					=> "Other Settings",
						),
					)
				);
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
					return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
				} else {			
					vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
				};
			}
		}
	}
	// Register Container and Child Shortcode with WP Bakery Page Builder
	if ((class_exists('WPBakeryShortCodesContainer')) && (!class_exists('WPBakeryShortCode_TS_VCSC_GoogleMapsPlus_Container'))) {
		class WPBakeryShortCode_TS_VCSC_GoogleMapsPlus_Container extends WPBakeryShortCodesContainer {};
	}
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_GoogleMapsPlus_Single'))) {
		class WPBakeryShortCode_TS_VCSC_GoogleMapsPlus_Single extends WPBakeryShortCode {};
	}
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_GoogleMapsPlus_Marker'))) {
		class WPBakeryShortCode_TS_VCSC_GoogleMapsPlus_Marker extends WPBakeryShortCode {};
	}
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_GoogleMapsPlus_Overlay'))) {
		class WPBakeryShortCode_TS_VCSC_GoogleMapsPlus_Overlay extends WPBakeryShortCode {};
	}
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_GoogleMapsPlus_Curveline'))) {
		class WPBakeryShortCode_TS_VCSC_GoogleMapsPlus_Curveline extends WPBakeryShortCode {};
	}
	// Initialize "TS Google Maps Plus" Class
	if (class_exists('TS_Google_Maps_Plus')) {
		$TS_Google_Maps_Plus = new TS_Google_Maps_Plus;
	}
?>