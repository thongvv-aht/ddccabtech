<?php
	if (!class_exists('TS_CountDown')){
		class TS_CountDown {
			private $TS_VCSC_Countdown_Language;
			
			function __construct() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						$this->TS_VCSC_Countdown_Lean();
					} else if (function_exists('vc_map')) {
						add_action('init',                                  array($this, 'TS_VCSC_Countdown_Element'), 9999999);
					}
				} else {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						add_action('admin_init',							array($this, 'TS_VCSC_Countdown_Lean'), 9999999);
					} else if (function_exists('vc_map')) {
						add_action('admin_init',							array($this, 'TS_VCSC_Countdown_Element'), 9999999);
					}
				}
				if ((is_admin() == false) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAJAX == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAlways == "true")) {
					add_shortcode('TS-VCSC-Countdown',       				array($this, 'TS_VCSC_Countdown_Function'));
					add_shortcode('TS_VCSC_Countdown',       				array($this, 'TS_VCSC_Countdown_Function'));
				}
				// Retrieve Countdown Default Language Strings
				$this->TS_VCSC_Countdown_Language							= get_option('ts_vcsc_extend_settings_translationsCountdown', '');
				if (($this->TS_VCSC_Countdown_Language == false) || (empty($this->TS_VCSC_Countdown_Language))) {
					$this->TS_VCSC_Countdown_Language						= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults;
				}
			}
			
			// Register Element(s) via LeanMap
			function TS_VCSC_Countdown_Lean() {
				vc_lean_map('TS-VCSC-Countdown', 							array($this, 'TS_VCSC_Countdown_Element'), null);
			}
			
			// Countdown Shortcode
			function TS_VCSC_Countdown_Function ($atts) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
			
				extract( shortcode_atts( array(
					'style'							=> 'minimum',			
					'counter_scope'					=> '1',
					'counter_interval'				=> '60',
					'counter_datetime'				=> '',
					'counter_date'					=> '',
					'counter_time'					=> '',
					'counter_zone'					=> 'false',
					'counter_singleline'			=> 'false',
					'countup'						=> 'true',
					'breakpoints_flipboard'			=> '992,768,480,320',
					'shortcode_date'				=> '',
					'shortcode_datetime'			=> '',			
					'reset_hours'					=> 0,
					'reset_minutes'					=> 15,
					'reset_seconds'					=> 0,
					'reset_restart'					=> 'true',
					'reset_link'					=> '',
					'date_zeros'					=> 'true',
					'date_days'						=> 'true',
					'date_hours'					=> 'true',
					'date_minutes'					=> 'true',
					'date_seconds'					=> 'true',			
					'circle_width'					=> 5,			
					'border_type'					=> '',
					'border_thick'					=> 1,
					'border_radius'					=> '',
					'border_color'					=> '#dddddd',			
					'column_equal_width'			=> 'true',
					'column_background_color'		=> '#f7f7f7',
					'column_border_type'			=> '',
					'column_border_thick'			=> 1,
					'column_border_radius'			=> '',
					'column_border_color'			=> '#dddddd',			
					'color_background_basic'		=> '#f7f7f7',
					'color_numbers_basic'			=> '#000000',
					'color_text_basic'				=> '#000000',			
					'color_background_clock1'		=> '#000000',
					'color_numbers_clock1'			=> '#ffffff',			
					'color_background_clock2'		=> '#000000',
					'color_numbers_clock2'			=> '#00deff',
					'color_dividers_clock2'			=> '#00deff',			
					'color_background_bars'			=> '#ffc728',
					'color_numbers_bars'			=> '#ffffff',
					'color_text_bars'				=> '#a76500',
					'color_barback_bars'			=> '#a66600',
					'color_barfore_bars'			=> '#ffffff',			
					'color_background_circles'		=> '#000000',
					'color_numbers_circles'			=> '#ffffff',
					'color_text_circles'			=> '#929292',
					'color_circleback_all'			=> '#282828',
					'color_circlefore_days'			=> '#117d8b',
					'color_circlefore_hours'		=> '#117d8b',
					'color_circlefore_minutes'		=> '#117d8b',
					'color_circlefore_seconds'		=> '#117d8b',			
					'color_background_horizontal'	=> '#ffffff',
					'color_flippers_horizontal'		=> '#00bfa0',
					'color_numbers_horizontal'		=> '#ffffff',
					'color_text_horizontal'			=> '#929292',			
					'color_background_flipboard'	=> '#ffffff',
					'string_single_day'				=> ((array_key_exists('DaySingular', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['DaySingular'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['DaySingular']),
					'string_single_hour'			=> ((array_key_exists('HourSingular', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['HourSingular'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['HourSingular']),
					'string_single_minute'			=> ((array_key_exists('MinuteSingular', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['MinuteSingular'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['MinuteSingular']),
					'string_single_second'			=> ((array_key_exists('SecondSingular', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['SecondSingular'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['SecondSingular']),
					'string_plural_day'				=> ((array_key_exists('DayPlural', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['DayPlural'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['DayPlural']),
					'string_plural_hour'			=> ((array_key_exists('HourPlural', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['HourPlural'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['HourPlural']),
					'string_plural_minute'			=> ((array_key_exists('MinutePlural', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['MinutePlural'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['MinutePlural']),
					'string_plural_second'			=> ((array_key_exists('SecondPlural', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['SecondPlural'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['SecondPlural']),
					'conditionals'					=> '',
					'margin_top'					=> 0,
					'margin_bottom'					=> 0,
					'el_id' 						=> '',
					'el_class' 						=> '',
					'css'							=> '',
				), $atts ));
		
				// Check Conditional Output
				$render_conditionals				= (empty($conditionals) ? true : TS_VCSC_CheckConditionalOutput($conditionals));
				if (!$render_conditionals) {
					$myvariable 					= ob_get_clean();
					return $myvariable;
				}
				
				// Load Required Files
				wp_enqueue_style('ts-extend-font-roboto');
				wp_enqueue_style('ts-extend-font-unica');
				wp_enqueue_style('ts-extend-countdown');
				wp_enqueue_script('ts-extend-countdown');
			
				$countdown_randomizer				= mt_rand(999999, 9999999);
			
				if (!empty($el_id)) {
					$countdown_id					= $el_id;
				} else {
					$countdown_id					= 'ts-vcsc-countdown-' . $countdown_randomizer;
				}
		
				$output = '';
		
				// Link Values
				$reset_link 						= TS_VCSC_Advancedlinks_GetLinkData($reset_link);
				$a_href								= $reset_link['url'];
				$a_title 							= $reset_link['title'];
				$a_target 							= $reset_link['target'];
				
				if ($style == "flipboard") {
					$date_zeros						= "true";
				}
		
				// Date Settings
				if ((!empty($counter_date)) && ($counter_scope == "1")) {
					$string_date					= strtotime($counter_date);
					$string_date_day				= date("j", $string_date);
					$string_date_month				= date("n", $string_date);
					$string_date_year				= date("Y", $string_date);
					$string_reset					= "false";
				} else if ((!empty($shortcode_date)) && ($counter_scope == "1S")) {
					$shortcode						= rawurldecode(base64_decode(strip_tags($shortcode_date)));
					$shortcode						= do_shortcode($shortcode);
					$string_date					= strtotime($shortcode);			
					$string_date_day				= date("j", $string_date);
					$string_date_month				= date("n", $string_date);
					$string_date_year				= date("Y", $string_date);
					$string_reset					= "false";
				} else if ((!empty($counter_datetime)) && ($counter_scope == "2")) {
					$string_date					= strtotime($counter_datetime);
					$string_date_day				= date("j", $string_date);
					$string_date_month				= date("n", $string_date);
					$string_date_year				= date("Y", $string_date);
					$string_reset					= "false";
				} else if ((!empty($shortcode_datetime)) && ($counter_scope == "2S")) {
					$shortcode						= rawurldecode(base64_decode(strip_tags($shortcode_datetime)));
					$shortcode						= do_shortcode($shortcode);
					$string_date					= strtotime($shortcode);
					$string_date_day				= date("j", $string_date);
					$string_date_month				= date("n", $string_date);
					$string_date_year				= date("Y", $string_date);
					$string_reset					= "false";
				} else if ($counter_scope == "4") {
					$string_date_day				= '';
					$string_date_month				= '';
					$string_date_year				= '';
					$string_reset					= "true";
				} else if (($counter_scope == "3") || ((empty($counter_date)) && (empty($counter_datetime)) && ($counter_scope != "6") && ($counter_scope != "7"))) {
					$string_date					= strtotime(date('m/d/Y'));
					$string_date_day				= date("j", $string_date);
					$string_date_month				= date("n", $string_date);
					$string_date_year				= date("Y", $string_date);
					$string_reset					= "false";
				} else if ((!empty($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Downtime_Manager_Settings['dateonly'])) && ($counter_scope == "6")) {
					$string_date					= strtotime($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Downtime_Manager_Settings['dateonly']);
					$string_date_day				= date("j", $string_date);
					$string_date_month				= date("n", $string_date);
					$string_date_year				= date("Y", $string_date);
					$counter_zone					= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Downtime_Manager_Settings['timezone'];
					$string_reset					= "false";
				} else if ((!empty($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Downtime_Manager_Settings['datetime'])) && ($counter_scope == "7")) {
					$string_date					= strtotime($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Downtime_Manager_Settings['datetime']);
					$string_date_day				= date("j", $string_date);
					$string_date_month				= date("n", $string_date);
					$string_date_year				= date("Y", $string_date);
					$counter_zone					= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Downtime_Manager_Settings['timezone'];
					$string_reset					= "false";
				} else {
					$string_date_day				= '';
					$string_date_month				= '';
					$string_date_year				= '';
					$string_reset					= "false";
				}
		
				// Time Settings
				if ((!empty($counter_datetime)) && ($counter_scope == "2")) {
					$string_time					= strtotime($counter_datetime);
					$string_time_hour				= date("G", $string_time);
					$string_time_minute				= date("i", $string_time);
					$string_time_second				= date("s", $string_time);
					$string_repeat					= "false";
				} else if ((!empty($shortcode_datetime)) && ($counter_scope == "2S")) {
					$shortcode						= rawurldecode(base64_decode(strip_tags($shortcode_datetime)));
					$shortcode						= do_shortcode($shortcode);
					$string_time					= strtotime($shortcode);
					$string_time_hour				= date("G", $string_time);
					$string_time_minute				= date("i", $string_time);
					$string_time_second				= date("s", $string_time);
					$string_repeat					= "false";
				} else if ((!empty($counter_time)) && ($counter_scope == "3")) {
					$string_time					= strtotime($counter_time);
					$string_time_hour				= date("G", $string_time);
					$string_time_minute				= date("i", $string_time);
					$string_time_second				= date("s", $string_time);
					$string_repeat					= "true";
				} else if ($counter_scope == "7") {
					$string_time					= strtotime($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Downtime_Manager_Settings['datetime']);
					$string_time_hour				= date("G", $string_time);
					$string_time_minute				= date("i", $string_time);
					$string_time_second				= date("s", $string_time);
					$string_repeat					= "false";
				} else {
					$string_time_hour				= '0';
					$string_time_minute				= '0';
					$string_time_second				= '0';
					$string_repeat					= "false";
				}
				
				// Pageload / Repeat CountUp
				if ($counter_scope == "5") {
					$string_pageload				= "true";
					$countup						= "true";
				} else {
					$string_pageload				= "false";
					if (($counter_scope == "3") || ($counter_scope == "4")) {
						$countup					= "false";
					} else {
						$countup					= $countup;
					}
				}
				if ($counter_scope == "4") {
					//$counter_zone				= "false";
				}
		
				// Countdown Border Settings
				if (!empty($border_type)) {
					$countdown_border				= 'border: ' . $border_thick . 'px ' . $border_type . ' ' . $border_color . ';';
				} else {
					$countdown_border				= '';
				}
		
				// Column Border Settings
				if ($style == "columns") {
					if (!empty($column_border_type)) {
						$column_border				= 'border: ' . $column_border_thick . 'px ' . $column_border_type . ' ' . $column_border_color . ';';
					} else {
						$column_border				=	 '';
					}
				}
				
				// Data Attribute Settings
				$countdown_data_main				= 'data-id="' . $countdown_randomizer . '" data-type="' . $style . '" data-width="" data-segments="" data-breakpoints="' . $breakpoints_flipboard . '" data-singleline="' . $counter_singleline . '" data-zone="' . $counter_zone . '" data-countup="' . $countup . '" data-repeat="' . $string_repeat . '" data-pageload="' . $string_pageload . '" data-zeros="' . $date_zeros . '" data-show-days="' . $date_days . '" data-show-hours="' . $date_hours . '" data-show-minutes="' . $date_minutes . '" data-show-seconds="' . $date_seconds . '"';
				$countdown_data_date				= 'data-day="' . $string_date_day . '" data-month="' . $string_date_month . '" data-year="' . $string_date_year . '"';
				$countdown_data_time				= 'data-hour="' . $string_time_hour . '" data-minute="' . $string_time_minute . '" data-second="' . $string_time_second . '"';
				$countdown_data_reset				= 'data-resethours = "' . $reset_hours . '" data-resetminutes="' . $reset_minutes . '" data-resetseconds="' . $reset_seconds . '" data-resetlink="' . $a_href . '" data-resettarget="' . $a_target . '"';
				$countdown_data_strings				= 'data-label-day="' . $string_single_day . '" data-label-hour="' . $string_single_hour . '" data-label-minute="' . $string_single_minute . '" data-label-second="' . $string_single_second . '" data-label-days="' . $string_plural_day . '" data-label-hours="' . $string_plural_hour . '" data-label-minutes="' . $string_plural_minute . '" data-label-seconds="' . $string_plural_second . '"';
				if ($style == "circles") {
					$countdown_data_color			= 'data-color-width="' . $circle_width . '" data-color-back="' . $color_circleback_all . '" data-color-days="' . $color_circlefore_days . '" data-color-hours="' . $color_circlefore_hours . '" data-color-minutes="' . $color_circlefore_minutes . '" data-color-seconds="' . $color_circlefore_seconds . '"';
				} else {
					$countdown_data_color			= '';
				}
				
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS-VCSC-Countdown', $atts);
				} else {
					$css_class						= '';
				}
				
				$output .= '<div id="' . $countdown_id . '-container" class="ts-vcsc-countdown-container">';
					// Create Countdown Output
					// Minimum Style (Style 0)
					if ($style == "minimum") {
						$output .= '<div id="' . $countdown_id . '" data-reset="' . $string_reset . '" data-resetrestart="' . $reset_restart . '" ' . $countdown_data_main . ' ' . $countdown_data_reset . ' ' . $countdown_data_date . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' ' . $countdown_data_strings . ' class="ts-countdown-parent style-0 ' . $el_class . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . '; background: ' . $color_background_basic . '; ' . $countdown_border . '">';
							$output .= '<div id="' . $countdown_id . '_countdown" class="ts-countdown" style="background: ' . $color_background_basic . ';">';
								if (($date_days == "true") && ($string_reset == "false")) {
									$output .= '<span class="ce-days" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-days-label" style="color: ' . $color_text_basic . ';"></span> ';
								}
								if ($date_hours == "true") {
									$output .= '<span class="ce-hours" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-hours-label" style="color: ' . $color_text_basic . ';"></span> ';
								}
								if ($date_minutes == "true") {
									$output .= '<span class="ce-minutes" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-minutes-label" style="color: ' . $color_text_basic . ';"></span> ';
								}
								if ($date_seconds == "true") {
									$output .= '<span class="ce-seconds" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-seconds-label" style="color: ' . $color_text_basic . ';"></span>';
								}
							$output .= '</div>';
							if ((!empty($a_href)) && ($counter_scope == "4")) {
								$output .= '<a id="' . $countdown_id . '_link" href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '" style="display:none !important;">Countdown Link</a>';
							}
						$output .= '</div>';
					}
					// Basic Style with Columns (Style 1)
					if ($style == "columns") {
						$output .= '<div id="' . $countdown_id . '" data-reset="' . $string_reset . '" data-resetrestart="' . $reset_restart . '" data-equalize="' . $column_equal_width . '" ' . $countdown_data_main . ' ' . $countdown_data_reset . ' ' . $countdown_data_date . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' ' . $countdown_data_strings . ' class="ts-countdown-parent style-1 ' . $el_class . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . '; background: ' . $color_background_basic . '; ' . $countdown_border . '">';
							$output .= '<div id="' . $countdown_id . '_countdown" class="ts-countdown" style="background: ' . $color_background_basic . ';">';
								if (($date_days == "true") && ($string_reset == "false")) {
									$output .= '<div class="col ' . $column_border_radius . '" style="background: ' . $column_background_color . '; ' . $column_border . '"><span class="ce-days" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-days-label" style="color: ' . $color_text_basic . ';"></span></div>';
								}
								if ($date_hours == "true") {
									$output .= '<div class="col ' . $column_border_radius . '" style="background: ' . $column_background_color . '; ' . $column_border . '"><span class="ce-hours" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-hours-label" style="color: ' . $color_text_basic . ';"></span></div>';
								}
								if ($date_minutes == "true") {
									$output .= '<div class="col ' . $column_border_radius . '" style="background: ' . $column_background_color . '; ' . $column_border . '"><span class="ce-minutes" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-minutes-label" style="color: ' . $color_text_basic . ';"></span></div>';
								}
								if ($date_seconds == "true") {
									$output .= '<div class="col ' . $column_border_radius . '" style="background: ' . $column_background_color . '; ' . $column_border . '"><span class="ce-seconds" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-seconds-label" style="color: ' . $color_text_basic . ';"></span></div>';
								}
							$output .= '</div>';
							if ((!empty($a_href)) && ($counter_scope == "4")) {
								$output .= '<a id="' . $countdown_id . '_link" href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '" style="display:none !important;">Countdown Link</a>';
							}
						$output .= '</div>';
					}
					// Bars Style (Style 2)
					if ($style == "bars") {
						$output .= '<div id="' . $countdown_id . '" data-reset="' . $string_reset . '" data-resetrestart="' . $reset_restart . '" ' . $countdown_data_main . ' ' . $countdown_data_date . ' ' . $countdown_data_reset . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' ' . $countdown_data_strings . ' class="ts-countdown-parent style-2 ' . $el_class . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . '; background: ' . $color_background_bars . '; ' . $countdown_border . '">';
							$output .= '<div id="' . $countdown_id . '_countdown" class="ts-countdown clearfix-float" style="background: ' . $color_background_bars . ';">';
								$output .= '<div class="info clearfix-float" style="">';
									if (($date_days == "true") && ($string_reset == "false")) {
										$output .= '<div style="width: 100%; display: inline-block;">';
											$output .= '<div id="bar-days_' . $countdown_randomizer . '" class="bar bar-days" style="background: ' . $color_barback_bars . ';"><div class="fill" style="background: ' . $color_barfore_bars . ';"></div></div> ';
											$output .= '<span id="ce-days_' . $countdown_randomizer . '" class="ce-days" style="color: ' . $color_numbers_bars . ';"></span> <span class="ce-days-label" style="color: ' . $color_text_bars . ';"></span>';
										$output .= '</div>';
									}
									if ($date_hours == "true") {
										$output .= '<div style="width: 100%; display: inline-block;">';
											$output .= '<div id="bar-hours_' . $countdown_randomizer . '" class="bar bar-hours" style="background: ' . $color_barback_bars . ';"><div class="fill" style="background: ' . $color_barfore_bars . ';"></div></div>';
											$output .= '<span id="ce-hours_' . $countdown_randomizer . '" class="ce-hours" style="color: ' . $color_numbers_bars . ';"></span> <span class="ce-hours-label" style="color: ' . $color_text_bars . ';"></span>';
										$output .= '</div>';
									}
									if ($date_minutes == "true") {
										$output .= '<div style="width: 100%; display: inline-block;">';
											$output .= '<div id="bar-minutes_' . $countdown_randomizer . '" class="bar bar-minutes" style="background: ' . $color_barback_bars . ';"><div class="fill" style="background: ' . $color_barfore_bars . ';"></div></div>';
											$output .= '<span id="ce-minutes_' . $countdown_randomizer . '" class="ce-minutes" style="color: ' . $color_numbers_bars . ';"></span> <span class="ce-minutes-label" style="color: ' . $color_text_bars . ';"></span>';
										$output .= '</div>';
									}
									if ($date_seconds == "true") {
										$output .= '<div style="width: 100%; display: inline-block;">';
											$output .= '<div id="bar-seconds_' . $countdown_randomizer . '" class="bar bar-seconds" style="background: ' . $color_barback_bars . ';"><div class="fill" style="background: ' . $color_barfore_bars . ';"></div></div>';
											$output .= '<span id="ce-seconds_' . $countdown_randomizer . '" class="ce-seconds" style="color: ' . $color_numbers_bars . ';"></span> <span class="ce-seconds-label" style="color: ' . $color_text_bars . ';"></span>';
										$output .= '</div>';
									}
								$output .= '</div>';
							$output .= '</div>';
							if ((!empty($a_href)) && ($counter_scope == "4")) {
								$output .= '<a id="' . $countdown_id . '_link" href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '" style="display:none !important;">Countdown Link</a>';
							}
						$output .= '</div>';
					}
					// Digital Clock Style 1 (Style 3)
					if ($style == "clock1") {
						$output .= '<div id="' . $countdown_id . '" data-reset="' . $string_reset . '" data-resetrestart="' . $reset_restart . '" ' . $countdown_data_main . ' ' . $countdown_data_date . ' ' . $countdown_data_reset . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' ' . $countdown_data_strings . ' class="ts-countdown-parent style-3 ' . $el_class . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . '; background: ' . $color_background_clock1 . '; ' . $countdown_border . '">';
							$output .= '<div id="' . $countdown_id . '_countdown" class="ts-countdown" style="background: ' . $color_background_clock1 . ';">';
								if ($date_hours == "true") {
									$output .= '<span class="number ce-hours" style="color: ' . $color_numbers_clock1 . ';"></span>';
								}
								if ($date_minutes == "true") {
									$output .= '<span class="number ce-minutes" style="color: ' . $color_numbers_clock1 . ';"></span>';
								}
								if ($date_seconds == "true") {
									$output .= '<span class="number ce-seconds" style="color: ' . $color_numbers_clock1 . ';"></span>';
								}
							$output .= '</div>';
							if ((!empty($a_href)) && ($counter_scope == "4")) {
								$output .= '<a id="' . $countdown_id . '_link" href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '" style="display:none !important;">Countdown Link</a>';
							}
						$output .= '</div>';
					}
					// Digital Clock Style 2 (Style 7)
					if ($style == "clock2") {
						$output .= '<div id="' . $countdown_id . '" data-reset="' . $string_reset . '" data-resetrestart="' . $reset_restart . '" ' . $countdown_data_main . ' ' . $countdown_data_date . ' ' . $countdown_data_reset . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' ' . $countdown_data_strings . ' class="ts-countdown-parent style-7 ' . $el_class . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . '; background: ' . $color_background_clock2 . '; ' . $countdown_border . '">';
							$output .= '<div id="' . $countdown_id . '_countdown" class="ts-countdown" style="background: ' . $color_background_clock2 . ';">';
								if ($date_hours == "true") {
									$output .= '<span class="number ce-hours" style="color: ' . $color_numbers_clock2 . ';"></span><span class="ce-separator" style="color: ' . $color_dividers_clock2 . ';">:</span>';
								}
								if ($date_minutes == "true") {
									$output .= '<span class="number ce-minutes" style="color: ' . $color_numbers_clock2 . ';"></span><span class="ce-separator" style="color: ' . $color_dividers_clock2 . ';">:</span>';
								}
								if ($date_seconds == "true") {
									$output .= '<span class="number ce-seconds" style="color: ' . $color_numbers_clock2 . ';"></span>';
								}
							$output .= '</div>';
							if ((!empty($a_href)) && ($counter_scope == "4")) {
								$output .= '<a id="' . $countdown_id . '_link" href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '" style="display:none !important;">Countdown Link</a>';
							}
						$output .= '</div>';
					}
					// Circles Style (Style 9)
					if ($style == "circles") {
						$output .= '<div id="' . $countdown_id . '" data-reset="' . $string_reset . '" data-resetrestart="' . $reset_restart . '" ' . $countdown_data_main . ' ' . $countdown_data_date . ' ' . $countdown_data_reset . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' ' . $countdown_data_strings . ' class="ts-countdown-parent style-9 ' . $el_class . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . '; background: ' . $color_background_circles . '; ' . $countdown_border . '">';
							$output .= '<div id="' . $countdown_id . '_countdown" class="ts-countdown" style="background: ' . $color_background_circles . ';">';
								if (($date_days == "true") && ($string_reset == "false")) {
									$output .= '<div class="circle">';
										$output .= '<canvas id="days_' . $countdown_randomizer . '" width="300" height="300"></canvas>';
										$output .= '<div class="circle__values">';
											$output .= '<span class="ce-digit ce-days" style="color: ' . $color_numbers_circles . ';"></span>';
											$output .= '<span class="ce-label ce-days-label" style="color: ' . $color_text_circles . ';"></span>';
										$output .= '</div>';
									$output .= '</div>';
								}
								if ($date_hours == "true") {
									$output .= '<div class="circle">';
										$output .= '<canvas id="hours_' . $countdown_randomizer . '" width="300" height="300"></canvas>';
										$output .= '<div class="circle__values">';
											$output .= '<span class="ce-digit ce-hours" style="color: ' . $color_numbers_circles . ';"></span>';
											$output .= '<span class="ce-label ce-hours-label" style="color: ' . $color_text_circles . ';"></span>';
										$output .= '</div>';
									$output .= '</div>';
								}
								if ($date_minutes == "true") {
									$output .= '<div class="circle">';
										$output .= '<canvas id="minutes_' . $countdown_randomizer . '" width="300" height="300"></canvas>';
										$output .= '<div class="circle__values">';
											$output .= '<span class="ce-digit ce-minutes" style="color: ' . $color_numbers_circles . ';"></span>';
											$output .= '<span class="ce-label ce-minutes-label" style="color: ' . $color_text_circles . ';"></span>';
										$output .= '</div>';
									$output .= '</div>';
								}
								if ($date_seconds == "true") {
									$output .= '<div class="circle">';
										$output .= '<canvas id="seconds_' . $countdown_randomizer . '" width="300" height="300"></canvas>';
										$output .= '<div class="circle__values">';
											$output .= '<span class="ce-digit ce-seconds" style="color: ' . $color_numbers_circles . ';"></span>';
											$output .= '<span class="ce-label ce-seconds-label" style="color: ' . $color_text_circles . ';"></span>';
										$output .= '</div>';
									$output .= '</div>';
								}
							$output .= '</div>';
							if ((!empty($a_href)) && ($counter_scope == "4")) {
								$output .= '<a id="' . $countdown_id . '_link" href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '" style="display:none !important;">Countdown Link</a>';
							}
						$output .= '</div>';
					}
					// 3D Horizontal Flip (Style 6)
					if ($style == "horizontal") {
						$output .= '<div id="' . $countdown_id . '" data-reset="' . $string_reset . '" data-resetrestart="' . $reset_restart . '" ' . $countdown_data_main . ' ' . $countdown_data_date . ' ' . $countdown_data_reset . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' ' . $countdown_data_strings . ' class="ts-countdown-parent style-6 ' . $el_class . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . '; background: ' . $color_background_horizontal . '; ' . $countdown_border . '">';
							$output .= '<div id="' . $countdown_id . '_countdown" class="ts-countdown" style="background: ' . $color_background_horizontal . ';">';
								if (($date_days == "true") && ($string_reset == "false")) {
									$output .= '<div class="col">';
										$output .= '<div class="ce-days" style="color: ' . $color_numbers_horizontal . ';">';
											$output .= '<div class="ce-flip-wrap">';
												$output .= '<div class="ce-flip-front" style="background: ' . $color_flippers_horizontal . ';"></div>';
												$output .= '<div class="ce-flip-back" style="background: ' . $color_flippers_horizontal . ';"></div>';
											$output .= '</div>';
										$output .= '</div>';
										$output .= '<span class="ce-days-label" style="color: ' . $color_text_horizontal . ';"></span>';
									$output .= '</div>';
								}
								if ($date_hours == "true") {
									$output .= '<div class="col">';
										$output .= '<div class="ce-hours" style="color: ' . $color_numbers_horizontal . ';">';
											$output .= '<div class="ce-flip-wrap">';
												$output .= '<div class="ce-flip-front" style="background: ' . $color_flippers_horizontal . ';"></div>';
												$output .= '<div class="ce-flip-back" style="background: ' . $color_flippers_horizontal . ';"></div>';
											$output .= '</div>';
										$output .= '</div>';
										$output .= '<span class="ce-hours-label" style="color: ' . $color_text_horizontal . ';"></span>';
									$output .= '</div>';
								}
								if ($date_minutes == "true") {
									$output .= '<div class="col">';
										$output .= '<div class="ce-minutes" style="color: ' . $color_numbers_horizontal . ';">';
											$output .= '<div class="ce-flip-wrap">';
												$output .= '<div class="ce-flip-front" style="background: ' . $color_flippers_horizontal . ';"></div>';
												$output .= '<div class="ce-flip-back" style="background: ' . $color_flippers_horizontal . ';"></div>';
											$output .= '</div>';
										$output .= '</div>';
										$output .= '<span class="ce-minutes-label" style="color: ' . $color_text_horizontal . ';"></span>';
									$output .= '</div>';
								}
								if ($date_seconds == "true") {
									$output .= '<div class="col">';
										$output .= '<div class="ce-seconds" style="color: ' . $color_numbers_horizontal . ';">';
											$output .= '<div class="ce-flip-wrap">';
												$output .= '<div class="ce-flip-front" style="background: ' . $color_flippers_horizontal . ';"></div>';
												$output .= '<div class="ce-flip-back" style="background: ' . $color_flippers_horizontal . ';"></div>';
											$output .= '</div>';
										$output .= '</div>';
										$output .= '<span class="ce-seconds-label" style="color: ' . $color_text_horizontal . ';"></span>';
									$output .= '</div>';
								}
							$output .= '</div>';
							if ((!empty($a_href)) && ($counter_scope == "4")) {
								$output .= '<a id="' . $countdown_id . '_link" href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '" style="display:none !important;">Countdown Link</a>';
							}
						$output .= '</div>';
					}
					// Flipboard Style (Style 10)
					if ($style == "flipboard") {
						$output .= '<div id="' . $countdown_id . '" data-reset="' . $string_reset . '" data-resetrestart="' . $reset_restart . '" ' . $countdown_data_main . ' ' . $countdown_data_date . ' ' . $countdown_data_reset . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' ' . $countdown_data_strings . ' class="ts-countdown-parent style-10 ' . $el_class . ' ' . $css_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . '; background: ' . $color_background_flipboard . '; ' . $countdown_border . '">';
							$output .= '<div id="' . $countdown_id . '_countdown" class="ts-countdown" style="background: ' . $color_background_flipboard . ';">';
								if (($date_days == "true") && ($string_reset == "false")) {
									$output .= '<div class="unit-wrap">';
										$output .= '<div class="days"></div>';
										$output .= '<span class="ce-days-label"></span>';
									$output .= '</div>';
								}
								if ($date_hours == "true") {
									$output .= '<div class="unit-wrap">';
										$output .= '<div class="hours"></div>';
										$output .= '<span class="ce-hours-label"></span>';
									$output .= '</div>';
								}
								if ($date_minutes == "true") {
									$output .= '<div class="unit-wrap">';
										$output .= '<div class="minutes"></div>';
										$output .= '<span class="ce-minutes-label"></span>';
									$output .= '</div>';
								}
								if ($date_seconds == "true") {
									$output .= '<div class="unit-wrap">';
										$output .= '<div class="seconds"></div>';
										$output .= '<span class="ce-seconds-label"></span>';
									$output .= '</div>';
								}
							$output .= '</div>';
							if ((!empty($a_href)) && ($counter_scope == "4")) {
								$output .= '<a id="' . $countdown_id . '_link" href="' . $a_href . '" target="' . trim($a_target) . '" title="' . $a_title . '" style="display:none !important;">Countdown Link</a>';
							}
						$output .= '</div>';
					}
				$output .= '</div>';
				
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
	
			// Countdown Element
			function TS_VCSC_Countdown_Element() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Define Required Variables
				$TS_VCSC_Countdown_Targets = array(
					__( 'Specific Date Only', "ts_visual_composer_extend" )												=> "1",
					__( 'Specific Date Only [Shortcode]', "ts_visual_composer_extend" )									=> "1S",
					__( 'Specific Date and Time', "ts_visual_composer_extend" )											=> "2",
					__( 'Specific Date and Time [Shortcode]', "ts_visual_composer_extend" )								=> "2S",
					__( 'Specific Time Only (repeating on every day)', "ts_visual_composer_extend" )					=> "3",
					__( 'Resetting Counter (set interval up to 24 hours)', "ts_visual_composer_extend" )				=> "4",
					__( 'Count Time Since Pageload', "ts_visual_composer_extend" )										=> "5",
				);
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesDownpage == "true") {
					$TS_VCSC_Countdown_Targets[__( 'Downtime Expiration Date Only', "ts_visual_composer_extend" )] 		= "6";
					$TS_VCSC_Countdown_Targets[__( 'Downtime Expiration Date + Time', "ts_visual_composer_extend" )] 	= "7";
				};				
				// Add Countdown
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                      => __( "TS Countdown", "ts_visual_composer_extend" ),
					"base"                      => "TS-VCSC-Countdown",
					"icon" 	                    => "ts-composer-element-icon-countdown",
					"category"                  => __( "Composium", "ts_visual_composer_extend" ),
					"description"               => __("Place a countdown element", "ts_visual_composer_extend"),
					"admin_enqueue_js"			=> "",
					"admin_enqueue_css"			=> "",
					"params"                    => array(
						// Date and Time Settings
						array(
							"type"              => "seperator",
							"param_name"        => "seperator_1",
							"seperator"			=> "Date & Time Settings",
						),				
						array(
							"type"              => "dropdown",
							"heading"           => __( "Date / Time Limitations", "ts_visual_composer_extend" ),
							"param_name"        => "counter_scope",
							"width"             => 150,
							"value"             => $TS_VCSC_Countdown_Targets,
							"admin_label"		=> true,
							"description"       => __( "Select the countdown scope in terms of date and time.", "ts_visual_composer_extend" )
						),
						array(
							"type"              => "datetime_picker",
							"heading"           => __( "Date", "ts_visual_composer_extend" ),
							"param_name"        => "counter_date",
							"period"			=> "date",
							"value"             => "",
							"admin_label"		=> true,
							"description"       => __( "Select the date to which you want to count down to.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "counter_scope", 'value' => array('1') )
						),
						array(
							"type"              => "textarea_raw_html",
							"heading"           => __( "Date [Shortcode]", "ts_visual_composer_extend" ),
							"param_name"        => "shortcode_date",
							"value"             => base64_encode(""),
							"description"       => __( "Enter the shortcode that will dynamically generate the target date for the countdown; required date format: mm/dd/yyyy.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "counter_scope", 'value' => '1S' ),
						),				
						array(
							"type"              => "datetime_picker",
							"heading"           => __( "Date / Time", "ts_visual_composer_extend" ),
							"param_name"        => "counter_datetime",
							"period"			=> "datetime",
							"value"             => "",
							"admin_label"		=> true,
							"description"       => __( "Select the date and time to which you want to count down to.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "counter_scope", 'value' => array('2') )
						),
						array(
							"type"              => "textarea_raw_html",
							"heading"           => __( "Date / Time [Shortcode]", "ts_visual_composer_extend" ),
							"param_name"        => "shortcode_datetime",
							"value"             => base64_encode(""),
							"description"       => __( "Enter the shortcode that will dynamically generate the target date and time for the countdown; required date/time format: mm/dd/yyyy hh:mm AM/PM.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "counter_scope", 'value' => '2S' ),
						),	
						array(
							"type"              => "datetime_picker",
							"heading"           => __( "Time", "ts_visual_composer_extend" ),
							"param_name"        => "counter_time",
							"period"			=> "time",
							"value"             => "",
							"admin_label"		=> true,
							"description"       => __( "Select the time on the day above to which you want to count down to.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "counter_scope", 'value' => array('3') )
						),
						array(
							"type"              => "nouislider",
							"heading"           => __( "Reset in Hours", "ts_visual_composer_extend" ),
							"param_name"        => "reset_hours",
							"value"             => "0",
							"min"               => "0",
							"max"               => "23",
							"step"              => "1",
							"unit"              => 'hr',
							"description"       => __( "Define the number of hours until countdown reset.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "counter_scope", 'value' => array('4') )
						),
						array(
							"type"              => "nouislider",
							"heading"           => __( "Reset in Minutes", "ts_visual_composer_extend" ),
							"param_name"        => "reset_minutes",
							"value"             => "15",
							"min"               => "0",
							"max"               => "59",
							"step"              => "1",
							"unit"              => 'min',
							"description"       => __( "Define the number of minutes until countdown reset.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "counter_scope", 'value' => array('4') )
						),
						array(
							"type"              => "nouislider",
							"heading"           => __( "Reset in Seconds", "ts_visual_composer_extend" ),
							"param_name"        => "reset_seconds",
							"value"             => "0",
							"min"               => "0",
							"max"               => "59",
							"step"              => "1",
							"unit"              => 's',
							"description"       => __( "Define the number of seconds until countdown reset.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "counter_scope", 'value' => array('4') )
						),
						array(
							"type"				=> "switch_button",
							"heading"           => __( "Automatic Restart", "ts_visual_composer_extend" ),
							"param_name"        => "reset_restart",
							"value"             => "true",
							"description"       => __( "Switch the toggle if you want to restart the countdown after each expiration.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "counter_scope", 'value' => array('4') )
						),
						array(
							"type" 				=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ParameterLinkPicker['enabled'] == "false" ? "vc_link" : "advancedlinks"),
							"heading" 			=> __("Page Referrer", "ts_visual_composer_extend"),
							"param_name" 		=> "reset_link",
							"description" 		=> __("Provide an optional link to another site/page to be opened after countdown expires.", "ts_visual_composer_extend"),
							"dependency"        => array( 'element' => "counter_scope", 'value' => array('4') )
						),
						// Timezone + CountUp
						array(
							"type"              => "seperator",
							"param_name"        => "seperator_2",
							"seperator"			=> "Other Adjustments",
							"dependency"        => array( 'element' => "counter_scope", 'value' => array('1', '1S', '2', '2S', '3', '4', '5') ),
						),
						array(
							"type"              => "dropdown",
							"heading"           => __( "Timezone Adjustment", "ts_visual_composer_extend" ),
							"param_name"        => "counter_zone",
							"width"             => 150,
							"value"             => array(
								__( 'User Time / No Adjustment', "ts_visual_composer_extend" )			=> "false",
								'GMT -12:00'															=> "-12",
								'GMT -11:00'															=> "-11",
								'GMT -10:00'															=> "-10",
								'GMT -09:00'															=> "-9",
								'GMT -08:00'															=> "-8",
								'GMT -07:00'															=> "-7",
								'GMT -06:00'															=> "-6",
								'GMT -05:00'															=> "-5",
								'GMT -04:00'															=> "-4",
								'GMT -03:00'															=> "-3",
								'GMT -03:30'															=> "-3.5",
								'GMT -02:00'															=> "-2",
								'GMT -01:00'															=> "-1",
								'GMT 00:00'																=> "0",
								'GMT +01:00'															=> "1",
								'GMT +02:00'															=> "2",
								'GMT +03:00'															=> "3",
								'GMT +03:30'															=> "3.5",
								'GMT +04:00'															=> "4",
								'GMT +04:30'															=> "4.5",
								'GMT +05:00'															=> "5",
								'GMT +05:30'															=> "5.5",
								'GMT +05:45'															=> "5.75",
								'GMT +06:00'															=> "6",
								'GMT +06:30'															=> "6.5",
								'GMT +07:00'															=> "7",
								'GMT +08:00'															=> "8",
								'GMT +09:00'															=> "9",
								'GMT +09:30'															=> "9.5",
								'GMT +10:00'															=> "10",
								'GMT +11:00'															=> "11",
								'GMT +12:00'															=> "12",
								'GMT +13:00'															=> "13",
							),
							"admin_label"		=> true,
							"dependency"        => array( 'element' => "counter_scope", 'value' => array('1', '1S', '2', '2S', '3', '4', '5') ),
							"description"       => __( "If required, define a timezone adjustment for the element. Learn more:", "ts_visual_composer_extend" ) . ' <a href="http://www.timeanddate.com/time/map/" target="_blank">' . __( 'Time Zones', "ts_visual_composer_extend" ) . '</a>',
						),				
						array(
							"type"				=> "switch_button",
							"heading"           => __( "Switch to CountUp", "ts_visual_composer_extend" ),
							"param_name"        => "countup",
							"value"             => "true",
							"admin_label"		=> true,
							"description"       => __( "Switch the toggle if you want the countdown to automatically switch into 'count up' mode once target date / time has been reached or was intentionally set in the past in order to show expired time.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "counter_scope", 'value' => array('1', '1S', '2', '2S') )
						),
						// Display Options
						array(
							"type"              => "seperator",
							"param_name"        => "seperator_3",
							"seperator"			=> "Display Options",
						),
						array(
							"type"				=> "switch_button",
							"heading"           => __( "Show Remaining Days", "ts_visual_composer_extend" ),
							"param_name"        => "date_days",
							"value"             => "true",
							"description"       => __( "Switch the toggle if you want to show the number of days remaining.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => array('minimum', 'columns', 'bars', 'circles', 'flipboard') )
						),
						array(
							"type"				=> "switch_button",
							"heading"           => __( "Show Remaining Hours", "ts_visual_composer_extend" ),
							"param_name"        => "date_hours",
							"value"             => "true",
							"description"       => __( "Switch the toggle if you want to show the number of hours remaining.", "ts_visual_composer_extend" ),
						),
						array(
							"type"				=> "switch_button",
							"heading"           => __( "Show Remaining Minutes", "ts_visual_composer_extend" ),
							"param_name"        => "date_minutes",
							"value"             => "true",
							"description"       => __( "Switch the toggle if you want to show the number of minutes remaining.", "ts_visual_composer_extend" ),
						),
						array(
							"type"				=> "switch_button",
							"heading"           => __( "Show Remaining Seconds", "ts_visual_composer_extend" ),
							"param_name"        => "date_seconds",
							"value"             => "true",
							"description"       => __( "Switch the toggle if you want to show the number of seconds remaining.", "ts_visual_composer_extend" ),
						),
						// Style Settings
						array(
							"type"              => "seperator",
							"param_name"        => "seperator_4",
							"seperator"			=> "Style Settings",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "dropdown",
							"heading"           => __( "Style", "ts_visual_composer_extend" ),
							"param_name"        => "style",
							"width"             => 150,
							"value"             => array(
								__( 'Minimum Styling', "ts_visual_composer_extend" )				=> "minimum",
								__( 'Basic Styling with Columns', "ts_visual_composer_extend" )		=> "columns",
								__( 'Bars Layout', "ts_visual_composer_extend" )					=> "bars",
								__( 'Digital Clock 1', "ts_visual_composer_extend" )        		=> "clock1",
								__( 'Digital Clock 2', "ts_visual_composer_extend" )        		=> "clock2",
								__( 'Circles Layout', "ts_visual_composer_extend" )					=> "circles",
								__( '3D Horizontal Flip', "ts_visual_composer_extend" )				=> "horizontal",
								__( 'Flipboard Layout', "ts_visual_composer_extend" )				=> "flipboard",
							),
							"admin_label"		=> true,
							"description"       => __( "Select the style for the countdown element.", "ts_visual_composer_extend" ),
							"group" 			=> "Style Settings",
						),
						array(
							"type"				=> "switch_button",
							"heading"           => __( "Show Leading Zeros", "ts_visual_composer_extend" ),
							"param_name"        => "date_zeros",
							"value"             => "true",
							"description"       => __( "Switch the toggle if you want to show a leading zero for values less than 10.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => array('minimum', 'columns', 'bars', 'clock1', 'clock2', 'circles', 'horizontal') ),
							"group" 			=> "Style Settings",
						),			
						array(
							"type"				=> "switch_button",
							"heading"           => __( "Force Single Line", "ts_visual_composer_extend" ),
							"param_name"        => "counter_singleline",
							"value"             => "false",
							"description"       => __( "Switch the toggle if you want to hide all segments that do not fit into one line anymore.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => array('flipboard') ),
							"group" 			=> "Style Settings",
						),
						array(
							"type"				=> "textfield",
							"heading"			=> __( "Size Breakpoints", "ts_visual_composer_extend" ),
							"param_name"		=> "breakpoints_flipboard",
							"value"				=> "992,768,480,320",
							"description"		=> __( "Define four breakpoints, separated by comma, representing the countdown width, at which the countdown should switch to a smaller size.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => array('flipboard') ),
							"group" 			=> "Style Settings",
						),			
						array(
							"type"              => "dropdown",
							"heading"           => __( "Countdown Border Type", "ts_visual_composer_extend" ),
							"param_name"        => "border_type",
							"width"             => 300,
							"value"             => array(
								__( "None", "ts_visual_composer_extend" )                          => "",
								__( "Solid Border", "ts_visual_composer_extend" )                  => "solid",
								__( "Dotted Border", "ts_visual_composer_extend" )                 => "dotted",
								__( "Dashed Border", "ts_visual_composer_extend" )                 => "dashed",
								__( "Double Border", "ts_visual_composer_extend" )                 => "double",
								__( "Grouve Border", "ts_visual_composer_extend" )                 => "groove",
								__( "Ridge Border", "ts_visual_composer_extend" )                  => "ridge",
								__( "Inset Border", "ts_visual_composer_extend" )                  => "inset",
								__( "Outset Border", "ts_visual_composer_extend" )                 => "outset"
							),
							"description"       => __( "Select the type of border around the countdown element.", "ts_visual_composer_extend" ),
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "nouislider",
							"heading"           => __( "Countdown Border Thickness", "ts_visual_composer_extend" ),
							"param_name"        => "border_thick",
							"value"             => "1",
							"min"               => "1",
							"max"               => "10",
							"step"              => "1",
							"unit"              => 'px',
							"description"       => __( "Define the thickness of the countdown element border.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "border_type", 'value' => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Border_Type_Values ),
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "dropdown",
							"heading"           => __( "Countdown Border Radius", "ts_visual_composer_extend" ),
							"param_name"        => "border_radius",
							"value"             => array(
								__( "None", "ts_visual_composer_extend" )                          => "",
								__( "Small Radius", "ts_visual_composer_extend" )                  => "ts-radius-small",
								__( "Medium Radius", "ts_visual_composer_extend" )                 => "ts-radius-medium",
								__( "Large Radius", "ts_visual_composer_extend" )                  => "ts-radius-large",
							),
							"description"       => __( "Define the radius of the countdown element border.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "border_type", 'value' => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Border_Type_Values ),
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Countdown Border Color", "ts_visual_composer_extend" ),
							"param_name"        => "border_color",
							"value"             => "#dddddd",
							"description"       => __( "Define the color of the countdown element border.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "border_type", 'value' => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Border_Type_Values ),
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "nouislider",
							"heading"           => __( "Circle Width", "ts_visual_composer_extend" ),
							"param_name"        => "circle_width",
							"value"             => "5",
							"min"               => "5",
							"max"               => "25",
							"step"              => "1",
							"unit"              => 'px',
							"description"       => __( "Define the circle width in pixel.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'circles' ),
							"group" 			=> "Style Settings",
						),
						// Color Settings for Basic Style
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_background_basic",
							"value"             => "#f7f7f7",
							"description"       => __( "Define the overall background color for the countdown element.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => array('minimum', 'columns') ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Numbers Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_numbers_basic",
							"value"             => "#000000",
							"description"       => __( "Define the font color for the numbers.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => array('minimum', 'columns') ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Text Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_text_basic",
							"value"             => "#000000",
							"description"       => __( "Define the font color for the text strings.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => array('minimum', 'columns') ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						// Color Settings for Bars Style
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_background_bars",
							"value"             => "#ffc728",
							"description"       => __( "Define the background color for the countdown element.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'bars' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Numbers Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_numbers_bars",
							"value"             => "#ffffff",
							"description"       => __( "Define the font color for the numbers.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'bars' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Text Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_text_bars",
							"value"             => "#a76500",
							"description"       => __( "Define the font color for the text strings.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'bars' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Bar Background Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_barback_bars",
							"value"             => "#a66600",
							"description"       => __( "Define the background color for the animated bars.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'bars' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Bar Value Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_barfore_bars",
							"value"             => "#ffffff",
							"description"       => __( "Define the foreground color for the animated bars.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'bars' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						// Color Settings for Digital Clock Style 1
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_background_clock1",
							"value"             => "#000000",
							"description"       => __( "Define the background color for the countdown element.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'clock1' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Numbers Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_numbers_clock1",
							"value"             => "#ffffff",
							"description"       => __( "Define the font color for the numbers.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'clock1' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						// Color Settings for Digital Clock Style 2
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_background_clock2",
							"value"             => "#000000",
							"description"       => __( "Define the background color for the countdown element.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'clock2' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Numbers Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_numbers_clock2",
							"value"             => "#00deff",
							"description"       => __( "Define the font color for the numbers.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'clock2' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Dividers Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_dividers_clock2",
							"value"             => "#00deff",
							"description"       => __( "Define the color for the dividers between the numbers.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'clock2' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						// Color Settings for Circles Style
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_background_circles",
							"value"             => "#000000",
							"description"       => __( "Define the background color for the countdown element.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'circles' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Numbers Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_numbers_circles",
							"value"             => "#ffffff",
							"description"       => __( "Define the font color for the numbers.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'circles' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Text Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_text_circles",
							"value"             => "#929292",
							"description"       => __( "Define the font color for the text strings.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'circles' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Circles Background Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_circleback_all",
							"value"             => "#282828",
							"description"       => __( "Define the background color for the animated circles.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'circles' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Circles Value Color: Days", "ts_visual_composer_extend" ),
							"param_name"        => "color_circlefore_days",
							"value"             => "#117d8b",
							"description"       => __( "Define the background color for the animated days value.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'circles' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Circles Value Color: Hours", "ts_visual_composer_extend" ),
							"param_name"        => "color_circlefore_hours",
							"value"             => "#117d8b",
							"description"       => __( "Define the background color for the animated hours value.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'circles' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Circles Value Color: Minutes", "ts_visual_composer_extend" ),
							"param_name"        => "color_circlefore_minutes",
							"value"             => "#117d8b",
							"description"       => __( "Define the background color for the animated minutes value.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'circles' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Circles Value Color: Seconds", "ts_visual_composer_extend" ),
							"param_name"        => "color_circlefore_seconds",
							"value"             => "#117d8b",
							"description"       => __( "Define the background color for the animated seconds value.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'circles' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						// Color Settings for 3D Horizontal Flip Style
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_background_horizontal",
							"value"             => "#ffffff",
							"description"       => __( "Define the background color for the countdown element.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'horizontal' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Numbers Background Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_flippers_horizontal",
							"value"             => "#00bfa0",
							"description"       => __( "Define the background color for the numbers.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'horizontal' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Numbers Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_numbers_horizontal",
							"value"             => "#ffffff",
							"description"       => __( "Define the color for the numbers.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'horizontal' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Text Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_text_horizontal",
							"value"             => "#929292",
							"description"       => __( "Define the font color for the text strings below the numbers.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'horizontal' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						// Color Settings for Flipboard Style
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Background Color", "ts_visual_composer_extend" ),
							"param_name"        => "color_background_flipboard",
							"value"             => "#ffffff",
							"description"       => __( "Define the background color for the countdown element.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'flipboard' ),
							"group" 			=> "Style Settings",
						),
						// Column Settings
						array(
							"type"              => "seperator",
							"param_name"        => "seperator_5",
							"seperator"			=> "Column Settings",
							"dependency"        => array( 'element' => "style", 'value' => 'columns' ),
							"group" 			=> "Style Settings",
						),
						array(
							"type"				=> "switch_button",
							"heading"           => __( "Equalize Column Width", "ts_visual_composer_extend" ),
							"param_name"        => "column_equal_width",
							"value"             => "true",
							"description"       => __( "Switch the toggle if you want all columns to have an equal width based on the largest column.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'columns' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Column Background Color", "ts_visual_composer_extend" ),
							"param_name"        => "column_background_color",
							"value"             => "#f7f7f7",
							"description"       => __( "Define the color of the countdown column background.", "ts_visual_composer_extend" ),			
							"dependency"        => array( 'element' => "style", 'value' => 'columns' ),
							"edit_field_class"	=> "vc_col-sm-6 vc_column",
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "dropdown",
							"heading"           => __( "Column Border Type", "ts_visual_composer_extend" ),
							"param_name"        => "column_border_type",
							"width"             => 300,
							"value"             => array(
								__( "None", "ts_visual_composer_extend" )                          => "",
								__( "Solid Border", "ts_visual_composer_extend" )                  => "solid",
								__( "Dotted Border", "ts_visual_composer_extend" )                 => "dotted",
								__( "Dashed Border", "ts_visual_composer_extend" )                 => "dashed",
								__( "Double Border", "ts_visual_composer_extend" )                 => "double",
								__( "Grouve Border", "ts_visual_composer_extend" )                 => "groove",
								__( "Ridge Border", "ts_visual_composer_extend" )                  => "ridge",
								__( "Inset Border", "ts_visual_composer_extend" )                  => "inset",
								__( "Outset Border", "ts_visual_composer_extend" )                 => "outset"
							),
							"description"       => __( "Select the type of border around countdown columns.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "style", 'value' => 'columns' ),	
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "nouislider",
							"heading"           => __( "Column Border Thickness", "ts_visual_composer_extend" ),
							"param_name"        => "column_border_thick",
							"value"             => "1",
							"min"               => "1",
							"max"               => "10",
							"step"              => "1",
							"unit"              => 'px',
							"description"       => __( "Define the thickness of the countdown column border.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "column_border_type", 'value' => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Border_Type_Values ),
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "dropdown",
							"heading"           => __( "Column Border Radius", "ts_visual_composer_extend" ),
							"param_name"        => "column_border_radius",
							"value"             => array(
								__( "None", "ts_visual_composer_extend" )                          => "",
								__( "Small Radius", "ts_visual_composer_extend" )                  => "ts-radius-small",
								__( "Medium Radius", "ts_visual_composer_extend" )                 => "ts-radius-medium",
								__( "Large Radius", "ts_visual_composer_extend" )                  => "ts-radius-large",
								__( "Full Circle", "ts_visual_composer_extend" )                   => "ts-radius-full"
							),
							"description"       => __( "Define the radius of the countdown column border.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "column_border_type", 'value' => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Border_Type_Values ),
							"group" 			=> "Style Settings",
						),
						array(
							"type"              => "colorpicker",
							"heading"           => __( "Column Border Color", "ts_visual_composer_extend" ),
							"param_name"        => "column_border_color",
							"value"             => "#dddddd",
							"description"       => __( "Define the color of the countdown column border.", "ts_visual_composer_extend" ),
							"dependency"        => array( 'element' => "column_border_type", 'value' => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Border_Type_Values ),
							"group" 			=> "Style Settings",
						),
						// Text String Settings
						array(
							"type"              => "seperator",
							"param_name"        => "seperator_6",
							"seperator"			=> "Text Strings",
							"group" 			=> "Text Strings",
						),
						array(
							"type"              => "messenger",
							"param_name"        => "messenger",
							"layout"			=> "notice",
							"level"				=> "warning",
							"size"				=> "13",
							"message"			=> __( "If the default text strings as defined through the plugin's settings page need to be changed for this element in particular, please use the provided options below to do so.", "ts_visual_composer_extend" ),
							"group" 			=> "Text Strings",
						),
						array(
							"type"              => "textfield",
							"heading"           => __( "'Days' (Plural)", "ts_visual_composer_extend" ),
							"param_name"        => "string_plural_day",
							"value"             => ((array_key_exists('DayPlural', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['DayPlural'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['DayPlural']),
							"group" 			=> "Text Strings",
						),
						array(
							"type"              => "textfield",
							"heading"           => __( "'Day' (Singular)", "ts_visual_composer_extend" ),
							"param_name"        => "string_single_day",
							"value"             => ((array_key_exists('DaySingular', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['DaySingular'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['DaySingular']),
							"group" 			=> "Text Strings",
						),						
						array(
							"type"              => "textfield",
							"heading"           => __( "'Hours' (Plural)", "ts_visual_composer_extend" ),
							"param_name"        => "string_plural_hour",
							"value"             => ((array_key_exists('HourPlural', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['HourPlural'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['HourPlural']),
							"group" 			=> "Text Strings",
						),
						array(
							"type"              => "textfield",
							"heading"           => __( "'Hour' (Singular)", "ts_visual_composer_extend" ),
							"param_name"        => "string_single_hour",
							"value"             => ((array_key_exists('HourSingular', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['HourSingular'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['HourSingular']),
							"group" 			=> "Text Strings",
						),						
						array(
							"type"              => "textfield",
							"heading"           => __( "'Minutes' (Plural)", "ts_visual_composer_extend" ),
							"param_name"        => "string_plural_minute",
							"value"             => ((array_key_exists('MinutePlural', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['MinutePlural'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['MinutePlural']),
							"group" 			=> "Text Strings",
						),
						array(
							"type"              => "textfield",
							"heading"           => __( "'Minute' (Singular)", "ts_visual_composer_extend" ),
							"param_name"        => "string_single_minute",
							"value"             => ((array_key_exists('MinuteSingular', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['MinuteSingular'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['MinuteSingular']),
							"group" 			=> "Text Strings",
						),
						array(
							"type"              => "textfield",
							"heading"           => __( "'Seconds' (Plural)", "ts_visual_composer_extend" ),
							"param_name"        => "string_plural_second",
							"value"             => ((array_key_exists('SecondPlural', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['SecondPlural'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['SecondPlural']),
							"group" 			=> "Text Strings",
						),
						array(
							"type"              => "textfield",
							"heading"           => __( "'Second' (Singular)", "ts_visual_composer_extend" ),
							"param_name"        => "string_single_second",
							"value"             => ((array_key_exists('SecondSingular', $this->TS_VCSC_Countdown_Language)) ? $this->TS_VCSC_Countdown_Language['SecondSingular'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Countdown_Language_Defaults['SecondSingular']),
							"group" 			=> "Text Strings",
						),
						// Other Conditionals
						array(
							"type"              => "seperator",
							"param_name"        => "seperator_7",
							"seperator"			=> "Output Conditions",
							"group" 			=> "Other Settings",
						),
						array(
							"type"              => "ts_conditionals",
							"heading"			=> __( "Output Conditions", "ts_visual_composer_extend" ),
							"param_name"        => "conditionals",
							"group" 			=> "Other Settings",
						),
						// Other Settings
						array(
							"type"              => "seperator",
							"param_name"        => "seperator_8",
							"seperator"			=> "Other Settings",
							"group" 			=> "Other Settings",
						),
						array(
							"type"              => "nouislider",
							"heading"           => __( "Margin: Top", "ts_visual_composer_extend" ),
							"param_name"        => "margin_top",
							"value"             => "0",
							"min"               => "-50",
							"max"               => "200",
							"step"              => "1",
							"unit"              => 'px',
							"description"       => __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
							"group" 			=> "Other Settings",
						),
						array(
							"type"              => "nouislider",
							"heading"           => __( "Margin: Bottom", "ts_visual_composer_extend" ),
							"param_name"        => "margin_bottom",
							"value"             => "0",
							"min"               => "-50",
							"max"               => "200",
							"step"              => "1",
							"unit"              => 'px',
							"description"       => __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
							"group" 			=> "Other Settings",
						),
						array(
							"type"              => "textfield",
							"heading"           => __( "Define ID Name", "ts_visual_composer_extend" ),
							"param_name"        => "el_id",
							"value"             => "",
							"description"       => __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
							"group" 			=> "Other Settings",
						),
						array(
							"type"				=> "tag_editor",
							"heading"			=> __( "Extra Class Names", "ts_visual_composer_extend" ),
							"param_name"		=> "el_class",
							"value"				=> "",
							"description"		=> __( "Enter additional class names for the element.", "ts_visual_composer_extend" ),
							"group"				=> "Other Settings",
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
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Countdown'))) {
		class WPBakeryShortCode_TS_VCSC_Countdown extends WPBakeryShortCode {};
	}
	// Initialize "TS CountDown" Class
	if (class_exists('TS_CountDown')) {
		$TS_CountDown = new TS_CountDown;
	}
?>