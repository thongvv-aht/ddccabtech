<?php
	/* ---------------------- */
	/* CUSTOM CODESTAR FIELDS */
	/* ---------------------- */
	
	/* ---------------------------------- */
	/* Plugin INDEPENDENT CodeStar Fields */
	/* ---------------------------------- */
	
	// Add New Hidden Input Field
	if (!class_exists('CSF_Field_inputhidden')) {		
		class CSF_Field_inputhidden extends CSF_Fields {	
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
			}
			public function render(){
				echo $this->field_before();
				echo '<input type="hidden" name="'. $this->field_name() .'" data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" value="'. $this->value .'"'. $this->field_attributes() .'/>';
				echo $this->field_after();
			}
			public function enqueue() {

			}
		}
	}
	
	// Add New Password Input Field
	if (!class_exists('CSF_Field_inputpassword')) {
		class CSF_Field_inputpassword extends CSF_Fields {		
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
			}  
			public function render(){		  
				echo $this->field_before();
				echo '<input type="password" name="'. $this->field_name() .'" data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" value="'. $this->value .'"'. $this->field_attributes() .'/>';
				echo $this->field_after();		  
			}
			public function enqueue() {

			}
		}
	}
	
	// Add New Device Types Field
	if (!class_exists('CSF_Field_devicetypes')) {
		class CSF_Field_devicetypes extends CSF_Fields {	
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
			}  	
			public function render(){
                $type 					= isset($this->field['type']) ? $this->field['type'] : '';
				$default				= isset($this->field['default']) ? $this->field['default'] : '';
				$parameters				= isset($this->field['settings']) ? $this->field['settings'] : array();				
				$unit					= isset($parameters['unit']) ? $parameters['unit'] : 'px';
				$devices				= isset($parameters['devices']) ? $parameters['devices'] : array();
				$collapsed				= isset($parameters['collapsed']) ? $parameters['collapsed'] : 'true';
				$pips					= isset($parameters['pips']) ? $parameters['pips'] : 'true';
                $min					= isset($parameters['min']) ? $parameters['min'] : '0';
                $max					= isset($parameters['max']) ? $parameters['max'] : '2048';
                $step					= isset($parameters['step']) ? $parameters['step'] : '1';
                $unit					= isset($parameters['unit']) ? $parameters['unit'] : 'px';
                $decimals				= isset($parameters['decimals']) ? $parameters['decimals'] : 0;				
				// Other Settings
				$random_id_number		= mt_rand(100000, 999999);
				$random_id_container	= 'ts-devicetypes-datastring-' . $random_id_number;
				$random_id_counter		= 0;
				$random_id_slider		= $random_id_number . '-' . $random_id_counter;
				$value					= $this->value;
				if (($value != '') && (is_numeric($value))) {
					$value				= "desktop: " . $value . 'px;';
				}
				$output					= '';
				echo $this->field_before();				
				$output  .= '<div id="ts-devicetypes-container-' . $random_id_slider . '" class="ts-devicetypes-container ts-settings-parameter-gradient-grey clearFixMe ' . ($collapsed == "true" ? 'ts-devicetypes-container-closed' : 'ts-devicetypes-container-open') . '" data-pips="' . $pips . '" data-input="' . $this->field_name() . '">';
					$output .= ' <div class="ts-devicetypes-listing" >';
					foreach ($devices as $device => $defaults) {
						$random_id_counter++;
						$random_id_slider		= $random_id_number . '-' . $random_id_counter;
						switch ($device) {
							case 'Desktop':       
								$class = 'required';
								$data_id  = strtolower((preg_replace('/\s+/', '_', $device)));
								$dashicon = "<i class='dashicons dashicons-desktop'></i>";
								$output .= $this->mediaitem($class, $dashicon, $device, $defaults['default'], $defaults['min'], $defaults['max'], $defaults['step'], $unit, $data_id, $random_id_slider);
								break;
							case 'Tablet':        
								$class = 'optional';
								$data_id  = strtolower((preg_replace('/\s+/', '_', $device)));
								$dashicon = "<i class='dashicons dashicons-tablet' style='transform: rotate(90deg); -webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);'></i>";
								$output .= $this->mediaitem($class, $dashicon, $device, $defaults['default'], $defaults['min'], $defaults['max'], $defaults['step'], $unit, $data_id, $random_id_slider);
								break;
							case 'Tablet Landscape':        
								$class = 'optional';
								$data_id  = strtolower((preg_replace('/\s+/', '_', $device)));
								$dashicon = "<i class='dashicons dashicons-tablet' style='transform: rotate(90deg); -webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);'></i>";
								$output .= $this->mediaitem($class, $dashicon, $device, $defaults['default'], $defaults['min'], $defaults['max'], $defaults['step'], $unit, $data_id, $random_id_slider);
								break;
							case 'Tablet Portrait':       
								$class = 'optional';
								$data_id  = strtolower((preg_replace('/\s+/', '_', $device)));
								$dashicon = "<i class='dashicons dashicons-tablet'></i>";
								$output .= $this->mediaitem($class, $dashicon, $device, $defaults['default'], $defaults['min'], $defaults['max'], $defaults['step'], $unit, $data_id, $random_id_slider);
								break;
							case 'Mobile':        
								$class = 'optional';
								$data_id  = strtolower((preg_replace('/\s+/', '_', $device)));
								$dashicon = "<i class='dashicons dashicons-smartphone'></i>";
								$output .= $this->mediaitem($class, $dashicon, $device, $defaults['default'], $defaults['min'], $defaults['max'], $defaults['step'], $unit, $data_id, $random_id_slider);
								break;
							case 'Mobile Landscape':        
								$class = 'optional';
								$data_id  = strtolower((preg_replace('/\s+/', '_', $device)));
								$dashicon = "<i class='dashicons dashicons-smartphone' style='transform: rotate(90deg); -webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);'></i>";
								$output .= $this->mediaitem($class, $dashicon, $device, $defaults['default'], $defaults['min'], $defaults['max'], $defaults['step'], $unit, $data_id, $random_id_slider);
								break;
							case 'Mobile Portrait':        
								$class = 'optional';
								$data_id  = strtolower((preg_replace('/\s+/', '_', $device)));
								$dashicon = "<i class='dashicons dashicons-smartphone'></i>";
								$output .= $this->mediaitem($class, $dashicon, $device, $defaults['default'], $defaults['min'], $defaults['max'], $defaults['step'], $unit, $data_id, $random_id_slider);
								break;
						}
					}
				$output .= '</div>';
					// Create Hidden Input to store final values
					$output .= '<input id="' . $random_id_container . '" type="hidden" data-unit="' . $unit . '"  name="' . $this->field_name() . '" class="ts-devicetypes-datastring ' . $type . '_field" value="' . $value . '" style="display: none;"/>';
				$output .= '</div>';
				echo $output;
				echo $this->field_after();
			}
			public function mediaitem($class, $dashicon, $device, $default, $min, $max, $step, $unit, $data_id, $identifier) {
				$tooltipVal  = str_replace('_', ' ', $data_id);
				$output  = '<div class="ts-devicetypes-item clearFixMe ' . $class . ' ' . $data_id . '" style="">';			
					$output .= '<div id="ts-devicetypes-input-slider-' . $identifier . '" class="ts-devicetypes-input-slider" style="display: inline-block;">';						
						$output .= '<div class="csf-table">';
							$output .= '<div class="ts-devicetypes-icon csf-table-cell">';
								$output .= '<div class="ts-devicetypes-tooltip">' . ucwords($tooltipVal) . '</div>';
								$output .= $dashicon;
							$output .= '</div>';
							$output .= '<div class="ts-devicetypes-slider csf-table-cell csf-table-expanded"><div class="csf-slider-ui"></div></div>';
							$output .= '<div class="ts-devicetypes-input csf-table-cell csf-nowrap">';
								$output .= '<input class="ts-devicetypes-item-input ignore" type="number" name="_nonce[ts-devicetypes-item-input-' . $identifier . ']" value="'. $default .'" data-id="' . $data_id . '" data-unit="' . $unit . '" data-max="'. $max .'" data-min="'. $min .'" data-step="'. $step .'" class="csf-number" />';
								$output .= (!empty($unit)) ? '<em>' . $unit . '</em>' : '';
							$output .= '</div>';
						$output .= '</div>';					
					$output .= '</div>';					
				$output .= '</div>';
				return $output;
			}
			public function enqueue() {
				wp_enqueue_script('jquery-ui-slider');
			}
		}
	}
	
	// Custom Switcher Field ("true"/"false" Output)
	if (!class_exists('CSF_Field_buttonswitch')) {
		class CSF_Field_buttonswitch extends CSF_Fields {		
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
			}  
			public function render() {
				if (($this->value === "true") || ($this->value === true) || ($this->value === "1") || ($this->value === 1)) {
					$this->value === "true";
				} else {
					$this->value === "false";
				}
				$output         	= '';
				$output .= $this->field_before();
				$output .= '<div class="ts-switch-button ts-codestar-custom-switcher" data-value="' . $this->value . '">';
					$output .= '<input type="hidden" style="display: none;" class="ts-codestar-value ' . $this->field_name() . '" data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" value="' . $this->value . '" name="' . $this->field_name() . '" ' . $this->field_attributes() . '/>';
					$output .= '<div class="ts-codestar-fieldset">';
						$output .= '<label class="ts-codestar-label">';							
							$output .= '<input id="' . $this->field_name() . '-checkbox" value="' . $this->value . '" class="ts-codestar-switcher-check ts-codestar-checkbox hidden" type="checkbox" ' . ($this->value == "true" ? 'checked="checked"' : '') . '> ';
							$output .= '<em data-on="' . __("Yes", "ts_visual_composer_extend") . '" data-off="' . __("No", "ts_visual_composer_extend") . '"></em>';
							$output .= '<span></span>';
						$output .= '</label>';
					$output .= '</div>';
				$output .= '</div>';
				$output .= $this->field_after();
				echo $output;
			}
			public function enqueue() {

			}
		}
	}
	
	// Custom Tag Editor Field
	if (!class_exists('CSF_Field_tageditor')) {
		class CSF_Field_tageditor extends CSF_Fields {		
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
			}  
			public function render() {
				// Tag Editor Settings
				$delimiter			= isset($this->field['delimiter'])		? $this->field['delimiter'] 	: ' ';
				$lowercase			= isset($this->field['lowercase'])		? $this->field['lowercase']		: 'true';
				$numbersonly		= isset($this->field['numbersonly'])	? $this->field['numbersonly']	: 'false';
				$sortable			= isset($this->field['sortable'])		? $this->field['sortable']		: 'true';
				$clickdelete		= isset($this->field['clickdelete'])	? $this->field['clickdelete']	: 'false';
				$placeholder		= isset($this->field['placeholder'])	? $this->field['placeholder'] 	: '';
				$randomizer			= rand(100000, 999999);
                $output         	= '';
				$delimiter			= '' . $delimiter . ';';
				$output         	= '';
				$output .= $this->field_before();
				$output .= '<div id="ts-tag-editor-wrapper-' . $randomizer . '"class="ts-tag-editor-wrapper" data-initialized="false" data-value="' . $this->value . '" data-sortable="' . $sortable . '" data-clickdelete="' . $clickdelete . '" data-delimiter="' . $delimiter . '" data-lowercase="' . $lowercase . '" data-numbersonly="' . $numbersonly . '" data-placeholder="' . $placeholder . '">';
					$output .= '<input id="ts-tag-editor-input-' . $randomizer . '" class="ts-tag-editor-input ' . $this->field_name() . '" ' . $this->field_attributes() . ' data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" name="' . $this->field_name() . '" type="text" value="' . $this->value . '"/>';
				$output .= '</div>';
				$output .= $this->field_after();
				echo $output;
			}
			public function enqueue() {

			}
		}
	}
	
	// Base64 Encoded Textarea Field
	if (!class_exists('CSF_Field_base64textarea')) {
		class CSF_Field_base64textarea extends CSF_Fields {		
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
			}  
			public function render() {
				// Base64 Textarea Settings
				$randomizer			= rand(100000, 999999);
				$output         	= '';
				$output .= $this->field_before();
				$output .= '<div id="ts-base64-textarea-wrapper-' . $randomizer . '" class="ts-base64-textarea-wrapper">';
					$output .= '<textarea id="ts-base64-textarea-editor-' . $randomizer . '" class="ts-base64-textarea-editor ignore" name="_nonce[ts-base64-textarea-editor-' . $randomizer . ']"></textarea>';
					$output .= '<textarea id="ts-base64-textarea-input-' . $randomizer . '" class="ts-base64-textarea-input" data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" name="'. $this->field_name() .'" ' . $this->field_attributes() .'>'. $this->value .'</textarea>';
				$output .= '</div>';
				$output .= $this->field_after();
				echo $output;
			}
			public function enqueue() {

			}
		}
	}
	
	// NoUiSlider Field
	if (!class_exists('CSF_Field_nouislider')) {
		class CSF_Field_nouislider extends CSF_Fields {		
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
			}  
			public function render() {
				// NoUiSlider Settings
                $type           	= isset($this->field['type']) ? $this->field['type'] : '';
                $min            	= isset($this->field['min']) ? $this->field['min'] : 0;
                $max            	= isset($this->field['max']) ? $this->field['max'] : 100;
                $step           	= isset($this->field['step']) ? $this->field['step'] : 1;
                $unit           	= isset($this->field['unit']) ? $this->field['unit'] : '';
                $decimals			= isset($this->field['decimals']) ? $this->field['decimals'] : 0;
				$callback			= isset($this->field['callback']) ? $this->field['callback'] : '';
				$extraction			= isset($this->field['extraction']) ? $this->field['extraction'] : 'false';
				// Range Additions
				$range				= isset($this->field['range']) ? $this->field['range'] : "false";
				$start				= isset($this->field['start']) ? $this->field['start'] : $min;
				$end				= isset($this->field['end']) ? $this->field['end'] : $max;				
				// Other Settings
			    $suffix         	= isset($this->field['suffix']) ? $this->field['suffix'] : '';
                $class          	= isset($this->field['class']) ? $this->field['class'] : '';
                $output         	= '';
				$randomizer			= mt_rand(999999, 9999999);
				// Contingency Checks
				if (($extraction == "true") && ($range == "false")) {
					$slidervalue	= preg_replace("/[^0-9]/", "", $this->value);
				} else {
					$slidervalue	= $this->value;
				}
				$output .= $this->field_before();
				if ($range == "false") {
					$output .= '<div id="ts-nouislider-input-slider-wrapper-' . $randomizer . '" class="ts-nouislider-input-slider-wrapper clearFixMe ts-settings-parameter-gradient-grey">';
						$output .= '<div id="ts-nouislider-input-slider-' . $randomizer . '" class="ts-nouislider-input-slider">';
							if ($extraction == "true") {
								$output .= '<input id="ts-nouislider-input-serial-' . $randomizer . '" class="ts-nouislider-input-serial nouislider-input-selector nouislider-input-composer" type="text" min="' . $min . '" max="' . $max . '" step="' . $step . '" value="' . $slidervalue . '"/>';								
							} else {
								$output .= '<input id="ts-nouislider-input-serial-' . $randomizer . '" name="' . $this->field_name() . '" class="ts-nouislider-input-serial nouislider-input-selector nouislider-input-composer ' . $this->field_name() . ' ' . $type . ' ' . $class . '" ' . $this->field_attributes() . ' type="text" min="' . $min . '" max="' . $max . '" step="' . $step . '" data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" value="' . $this->value . '"/>';
							}
							$output .= '<span class="ts-nouislider-input-unit">' . $unit . '</span>';
							$output .= '<span class="ts-nouislider-input-min">' . number_format_i18n($min, $decimals) . '</span>';
							$output .= '<span class="ts-nouislider-input-down dashicons-arrow-left"></span>';
							$output .= '<div id="ts-nouislider-input-element-' . $randomizer . '" class="ts-nouislider-input ts-nouislider-input-element" data-init="false" data-extract="' . $extraction . '" data-callback="' . $callback . '" data-pips="false" data-tooltip="false" data-value="' . $slidervalue . '" data-min="' . $min . '" data-max="' . $max . '" data-decimals="' . $decimals . '" data-step="' . $step . '" data-class="general" data-unit="' . $unit . '" style="width: 280px; float: left; margin-top: 10px;"></div>';
							$output .= '<span class="ts-nouislider-input-up dashicons-arrow-right"></span>';
							$output .= '<span class="ts-nouislider-input-max">' . number_format_i18n($max, $decimals) . '</span>';
						$output .= '</div>';
						if ($extraction == "true") {
							$output .= '<input id=ts-nouislider-input-value-' . $randomizer . '" name="' . $this->field_name() . '" class="wpb_vc_param_value ' . $this->field_name() . ' ' . $type . ' ' . $class . ' ts-nouislider-input-value" ' . $this->field_attributes() . ' style="display: none;"  data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" value="' . $this->value . '"/>';
						}
					$output .= '</div>';
				} else if ($range == "true") {
					$output .= '<div id="ts-nouislider-range-slider-wrapper-' . $randomizer . '" class="ts-nouislider-range-slider-wrapper clearFixMe ts-settings-parameter-gradient-grey" style="min-height: 150px;">';
						$output .= '<div id="ts-nouislider-range-slider-' . $randomizer . '" class="ts-nouislider-range-slider">';
							$output .= '<div id="ts-nouislider-range-output-' . $randomizer . '" class="ts-nouislider-range-output" data-controls="ts-nouislider-range-controls-' . $randomizer . '">';
								$output .= '<div id="ts-nouislider-range-human-' . $randomizer . '" class="ts-nouislider-range-human">';	
									$output .= '<span class="ts-nouislider-range-start"></span> - <span class="ts-nouislider-range-end"></span>';							
								$output .= '</div>';
							$output .= '</div>';
							$output .= '<div id="ts-nouislider-range-controls-' . $randomizer . '" class="ts-nouislider-range-controls" data-output="ts-nouislider-range-output-' . $randomizer . '">';
								$output .= '<input id="ts-nouislider-input-serial-' . $randomizer . '" name="' . $this->field_name() . '" class="ts-nouislider-input-serial nouislider-range-selector nouislider-input-composer ' . $this->field_name() . ' ' . $type . '" ' . $this->field_attributes() . ' type="hidden" data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" value="' . $this->value . '" style="display: none;"/>';
								$output .= '<span class="ts-nouislider-range-lower-down dashicons-arrow-left"></span>';
								$output .= '<span class="ts-nouislider-range-lower-up dashicons-arrow-right"></span>';						
								$output .= '<div id="ts-nouislider-range-element-' . $randomizer . '" class="ts-nouislider-range ts-nouislider-range-element" data-callback="' . $callback . '" data-value="' . $this->value . '" data-start="' . $start . '" data-end="' . $end . '" data-min="' . $min . '" data-max="' . $max . '" data-decimals="' . $decimals . '" data-step="' . $step . '" style="width: 400px; float: left; margin: 10px auto;"></div>';
								$output .= '<span class="ts-nouislider-range-upper-down dashicons-arrow-left"></span>';
								$output .= '<span class="ts-nouislider-range-upper-up dashicons-arrow-right"></span>';
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				}
				$output .= $this->field_after();
				echo $output;
			}
			public function enqueue() {
                wp_enqueue_style('ts-extend-nouislider');
                wp_enqueue_script('ts-extend-nouislider');
			}
		}
	}
	
	// Date/Time Picker Field
	if (!class_exists('CSF_Field_datetimepicker')) {
		class CSF_Field_datetimepicker extends CSF_Fields {
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
			}  
			public function render() {
                $type           	= isset($this->field['type']) 			? $this->field['type'] 			: '';
                $radios         	= isset($this->field['options']) 		? $this->field['options'] 		: '';
                $period         	= isset($this->field['period']) 		? $this->field['period'] 		: '';
				$range				= isset($this->field['range']) 			? $this->field['range'] 		: 'false';
				$text_start			= isset($this->field['text_start']) 	? $this->field['text_start'] 	: __('Start:', 'ts_visual_composer_extend');
				$text_end			= isset($this->field['text_end']) 		? $this->field['text_end'] 		: __('End:', 'ts_visual_composer_extend');
				$spacing			= isset($this->field['spacing']) 		? $this->field['spacing'] 		: 0;
				$year_start			= isset($this->field['year_start']) 	? $this->field['year_start'] 	: "1950";
				$year_end			= isset($this->field['year_end']) 		? $this->field['year_end'] 		: "2050";
				$randomizer			= rand(100000, 999999);
				// Other Variables
				$minutes_full		= array('0', 0, '00');
				$minutes_half		= array('30', 30);
				$minutes_quarter	= array('15', 15, '45', 45);
				$minutes_dozens		= array('5', 5, '10', 10, '20', 20, '25', 25, '35', 35, '40', 40, '50', 50, '55', 55);
				$minutes_start		= 60;
				$minutes_end		= 60;
				$minutes_interval	= 60;
				$output         	= '';
				$output .= $this->field_before();
				$output .= '<div id="ts-datetime-picker-wrapper-' . $randomizer . '" class="ts-datetime-picker-wrapper clearFixMe">';
					if ($range == "false") {
						if ($period == "datetime") {
							$time_start 		= strtotime($this->value);
							$time_start			= intval(date('i', $time_start));
							// Check Start Value
							if ($value == "") {
								$minutes_start	= 60;
							} else {
								$minutes_start	= $this->minuteinterval($time_start);
							}
							$minutes_interval	= $minutes_start;
							$output .= '<div id="ts-datetime-picker-element-' . $randomizer . '" class="ts-datetime-picker-element clearFixMe ts-xdsoft-datetimepicker-wrapper ts-settings-parameter-gradient-grey" data-year-start="' . $year_start . '" data-year-end="' . $year_end . '">';
								$output .= '<input name="' . $this->field_name() . '" id="' . $this->field_name() . '" class="ts-datetimepicker-value ' . $this->field_name() . ' ' . $type . '" type="hidden" ' . $this->field_attributes() . ' data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" value="' . $this->value . '"/>';
								$output .= '<label class="ts-datetimepicker-label" for="ts-datetimepicker-minutes-' . $randomizer . '">' . __( "Select the interval for the time selector:", "ts_visual_composer_extend" ) . '</label>';
								$output .= '<select id="ts-datetimepicker-minutes-' . $randomizer . '" class="ts-datetimepicker-minutes" data-identifier="' . $randomizer . '">';
									$output .= '<option value="60" ' . selected('60', 	$minutes_interval,	false) . '>' . __('60 Minutes', 'ts_visual_composer_extend') . '</option>';
									$output .= '<option value="30" ' . selected('30', 	$minutes_interval,	false) . '>' . __('30 Minutes', 'ts_visual_composer_extend') . '</option>';
									$output .= '<option value="15" ' . selected('15', 	$minutes_interval,	false) . '>' . __('15 Minutes', 'ts_visual_composer_extend') . '</option>';
									$output .= '<option value="10" ' . selected('10', 	$minutes_interval,	false) . '>' . __('10 Minutes', 'ts_visual_composer_extend') . '</option>';
									$output .= '<option value="5" ' . selected('5', 	$minutes_interval,	false) . '>' . __('5 Minutes', 'ts_visual_composer_extend') . '</option>';
									$output .= '<option value="1" ' . selected('1', 	$minutes_interval,	false) . '>' . __('1 Minute', 'ts_visual_composer_extend') . '</option>';
								$output .= '</select>';
								$output .= '<input class="ts-datetimepicker ts-datetimepicker-single" type="text" placeholder="" value="' . $this->value . '"/>';
							$output .= '</div>';
						} else if ($period == "date") {
							$output .= '<div id="ts-dateonly-picker-element-' . $randomizer . '" class="ts-dateonly-picker-element clearFixMe ts-xdsoft-datetimepicker-wrapper ts-settings-parameter-gradient-grey" data-year-start="' . $year_start . '" data-year-end="' . $year_end . '">';
								$output .= '<input name="' . $this->field_name() . '" id="' . $this->field_name() . '" class="ts-datepicker-value ' . $this->field_name() . ' ' . $type . '" type="hidden" ' . $this->field_attributes() . ' data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" value="' . $this->value . '"/>';
								$output .= '<input class="ts-datepicker ts-datepicker-single" type="text" placeholder="" value="' . $this->value . '"/>';
							$output .= '</div>';
						} else if ($period == "time") {
							// Time Picker via Slider
							if ($value != '') {
								$convert 		= date_parse($value);
								$minutes		= $convert['hour'] * 60 + $convert['minute'];
							} else {
								$minutes		= 1;
							}
							$output .= '<div id="ts-nouislider-time-slider-' . $randomizer . '" class="ts-nouislider-time-slider clearFixMe ts-settings-parameter-gradient-grey" >';
								$output .= '<div id="ts-nouislider-time-output-' . $randomizer . '" class="ts-nouislider-time-output" data-controls="ts-nouislider-time-controls-' . $randomizer . '">';
									$output .= '<div id="ts-nouislider-time-human-' . $randomizer . '" class="ts-nouislider-time-human">';	
										$output .= '<span class="ts-nouislider-time-final">' . $value . '</span>';							
									$output .= '</div>';
								$output .= '</div>';
								$output .= '<div id="ts-nouislider-time-controls-' . $randomizer . '" class="ts-nouislider-time-controls" data-output="ts-nouislider-time-output-' . $randomizer . '">';
									$output .= '<input style="width: 100px; float: left; margin-left: 0px; margin-right: 10px;" name="' . $this->field_name() . '"  class="ts-nouislider-serial nouislider-time-selector nouislider-input-composer ' . $this->field_name() . ' ' . $type . '" type="hidden" ' . $this->field_attributes() . ' data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" value="' . $this->value . '" style="display: none;"/>';
									$output .= '<span class="ts-nouislider-time-faster-down dashicons-controls-back" style="position: relative; float: left; display: inline-block; font-size: 30px; top: 30px; cursor: pointer; margin: 0;"></span>';	
									$output .= '<span class="ts-nouislider-time-lower-down dashicons-arrow-left" style="position: relative; float: left; display: inline-block; font-size: 50px; top: 20px; cursor: pointer; margin: 0;"></span>';								
									$output .= '<div id="ts-nouislider-time-element-' . $randomizer . '" class="ts-nouislider-time ts-nouislider-time-element" data-value="' . $minutes . '" data-unit="" data-min="1" data-max="1440" data-decimals="0" data-step="1" style="width: 400px; float: left; margin: 10px auto;"></div>';
									$output .= '<span class="ts-nouislider-time-lower-up dashicons-arrow-right" style="position: relative; float: left; display: inline-block; font-size: 50px; top: 20px; cursor: pointer; margin: 0;"></span>';	
									$output .= '<span class="ts-nouislider-time-faster-up dashicons-controls-forward" style="position: relative; float: left; display: inline-block; font-size: 30px; top: 30px; cursor: pointer; margin: 0;"></span>';
								$output .= '</div>';
							$output .= '</div>';					
						}
					} else {
						$value_array			= explode("|", $this->value);
						$value_start			= $value_array[0];
						$value_end				= $value_array[1];
						if ($period == "datetime") {
							$time_start 		= strtotime($value_start);
							$time_end 			= strtotime($value_end);
							$time_start			= intval(date('i', $time_start));
							$time_end			= intval(date('i', $time_end));
							// Check Start Value
							if ($value_start == "") {
								$minutes_start	= 60;
							} else {
								$minutes_start	= $this->minuteinterval($time_start);
							}
							// Check End Value
							if ($value_end == "") {
								$minutes_end	= 60;
							} else {
								$minutes_end	= $this->minuteinterval($time_end);
							}
							// Determine Final Interval
							if ($minutes_start > $minutes_end) {
								$minutes_interval	= $minutes_end;
							} else {
								$minutes_interval	= $minutes_start;
							}
							// Create Output
							$output .= '<div id="ts-datetime-range-element-' . $randomizer . '" class="ts-datetime-range-element clearFixMe ts-xdsoft-datetimepicker-wrapper ts-settings-parameter-gradient-grey" data-step="' . $minutes_interval . '" data-year-start="' . $year_start . '" data-year-end="' . $year_end . '">';
								$output .= '<input name="' . $this->field_name() . '" id="' . $this->field_name() . '" class="ts-datetimerange-value ' . $this->field_name() . ' ' . $type . '" type="hidden" ' . $this->field_attributes() . ' data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" value="' . $this->value . '"/>';
								$output .= '<div id="ts-datetime-range-human-' . $randomizer . '" class="ts-datetime-range-human">';
									$output .= '<div class="ts-datetimerange-output">';
										$output .= '<span class="ts-datetimerange-output-start">' . ($value_start != "" ? $value_start : "...") . '</span> - <span class="ts-datetimerange-output-end">' . ($value_end != "" ? $value_end : "...") . '</span>';
									$output .= '</div>';
								$output .= '</div>';
								$output .= '<label class="ts-datetimerange-label" for="ts-datetimerange-minutes-' . $randomizer . '">' . __( "Select the intervals for the time selectors:", "ts_visual_composer_extend" ) . '</label>';
								$output .= '<select id="ts-datetimerange-minutes-' . $randomizer . '" class="ts-datetimerange-minutes" data-identifier="' . $randomizer . '">';
									$output .= '<option value="60" ' . selected('60', 	$minutes_interval,	false) . '>' . __('60 Minutes', 'ts_visual_composer_extend') . '</option>';
									$output .= '<option value="30" ' . selected('30', 	$minutes_interval,	false) . '>' . __('30 Minutes', 'ts_visual_composer_extend') . '</option>';
									$output .= '<option value="15" ' . selected('15', 	$minutes_interval,	false) . '>' . __('15 Minutes', 'ts_visual_composer_extend') . '</option>';
									$output .= '<option value="10" ' . selected('10', 	$minutes_interval,	false) . '>' . __('10 Minutes', 'ts_visual_composer_extend') . '</option>';
									$output .= '<option value="5" ' . selected('5', 	$minutes_interval,	false) . '>' . __('5 Minutes', 'ts_visual_composer_extend') . '</option>';
									//$output .= '<option value="1" ' . selected('1', 	$minutes_interval,	false) . '>' . __('1 Minute', 'ts_visual_composer_extend') . '</option>';
								$output .= '</select>';
								$output .= '<div class="ts-datetimerange-picker ts-datetimerange-picker-start">';
									$output .= '<span class="ts-datetimerange-header">' . $text_start . '</span>';
									$output .= '<input id="ts-datetimerange-start-' . $randomizer . '" class="ts-datetimerange-start" data-time="' . date('h:i A', strtotime($value_start)) . '" data-date="' . date('m/d/Y', strtotime($value_start)) . '" type="text" placeholder="" value="' . $value_start . '"/>';
								$output .= '</div>';
								$output .= '<div class="ts-datetimerange-picker ts-datetimerange-picker-end">';
									$output .= '<span class="ts-datetimerange-header">' . $text_end . '</span>';
									$output .= '<input id="ts-datetimerange-end-' . $randomizer . '" class="ts-datetimerange-end" data-time="' . date('h:i A', strtotime($value_end)) . '" data-date="' . date('m/d/Y', strtotime($value_end)) . '" type="text" placeholder="" value="' . $value_end . '"/>';
								$output .= '</div>';
							$output .= '</div>';
						} else if ($period == "date") {
							$output .= '<div id="ts-dateonly-range-element-' . $randomizer . '" class="ts-dateonly-range-element clearFixMe ts-xdsoft-datetimepicker-wrapper ts-settings-parameter-gradient-grey" data-year-start="' . $year_start . '" data-year-end="' . $year_end . '">';
								$output .= '<input name="' . $this->field_name() . '" id="' . $this->field_name() . '" class="ts-dateonlyrange-value ' . $this->field_name() . ' ' . $type . '" type="hidden" ' . $this->field_attributes() . ' data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" value="' . $this->value . '"/>';
								$output .= '<div id="ts-dateonly-range-human-' . $randomizer . '" class="ts-dateonly-range-human">';
									$output .= '<div class="ts-dateonlyrange-output"><span class="ts-dateonlyrange-output-start">' . ($value_start != "" ? $value_start : "...") . '</span> - <span class="ts-dateonlyrange-output-end">' . ($value_end != "" ? $value_end : "...") . '</span></div>';
								$output .= '</div>';
								$output .= '<div class="ts-dateonlyrange-picker-center">';
									$output .= '<div class="ts-dateonlyrange-picker ts-dateonlyrange-picker-start">';
										$output .= '<span class="ts-dateonlyrange-header">' . $text_start . '</span>';
										$output .= '<input class="ts-dateonlyrange-start" type="text" placeholder="" value="' . $value_start . '"/>';
									$output .= '</div>';
									$output .= '<div class="ts-dateonlyrange-picker ts-dateonlyrange-picker-end">';
										$output .= '<span class="ts-dateonlyrange-header">' . $text_end . '</span>';
										$output .= '<input class="ts-dateonlyrange-end" type="text" placeholder="" value="' . $value_end . '"/>';
									$output .= '</div>';
								$output .= '</div>';
							$output .= '</div>';
						}
					}
				$output .= '</div>';
				$output .= $this->field_after();
				echo $output;
			}
			public function enqueue() {

			}
			public function minuteinterval($minute) {
				$minutes_full		= array('0', 0, '00');
				$minutes_half		= array('30', 30);
				$minutes_quarter	= array('15', 15, '45', 45);
				$minutes_dozens		= array('5', 5, '10', 10, '20', 20, '25', 25, '35', 35, '40', 40, '50', 50, '55', 55);
				$minutes_intval		= 60;
				if ($minute == '') {
					$minutes_intval	= 60;
				} else if ((in_array($minute, $minutes_full)) && (!in_array($minute, $minutes_half))) {
					$minutes_intval	= 60;
				} else if (in_array($minute, $minutes_half)) {
					$minutes_intval	= 30;
				} else if (in_array($minute, $minutes_quarter)) {
					$minutes_intval	= 15;
				} else if (in_array($minute, $minutes_dozens)) {
					$minutes_intval	= 5;
				} else {
					$minutes_intval	= 1;
				}
				return $minutes_intval;
			}
		}
	}
	
	
	/* ---------------------------------- */
	/* SHARED Plugin ONLY CodeStar Fields */
	/* ---------------------------------- */
	
	// Add New Defaults Storage Field
	if (!class_exists('CSF_Field_defaultsgenerator')) {		
		class CSF_Field_defaultsgenerator extends CSF_Fields {	
			private $TS_CodeStar_Generator;
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
				$this->TS_CodeStar_Generator	= isset($this->field['generator']) ? $this->field['generator'] : '';				
			}
			public function render(){
				echo $this->field_before();
				echo '<div class="ts-defaultsstorage-content" name="'. $this->field_name() .'" '. $this->field_attributes() .'>'. $this->value .'</div>';
				echo $this->field_after();
			}
			public function enqueue() {
				if (($this->TS_CodeStar_Generator == 'ts-composium-shortcode') && (class_exists('VISUAL_COMPOSER_EXTENSIONS'))) {
					global $VISUAL_COMPOSER_EXTENSIONS;
					$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_FilesRegistrations();
					wp_enqueue_style('ts-visual-composer-extend-generator');
					wp_enqueue_script('ts-visual-composer-extend-generator');					
				} else if (($this->TS_CodeStar_Generator == 'ts-tablenator-shortcode') && (class_exists('TS_ADVANCED_TABLESWP'))) {
					global $TS_ADVANCED_TABLESWP;
					$TS_ADVANCED_TABLESWP->TS_TablesWP_Files_Registrations();
                    wp_enqueue_style('ts-advanced-tables-generator');
                    wp_enqueue_script('ts-advanced-tables-generator');
				} else if (($this->TS_CodeStar_Generator == 'ts-changelogs-shortcode') && (class_exists('TS_CHANGELOG_ORGANIZER'))) {
					global $TS_CHANGELOG_ORGANIZER;
					$TS_CHANGELOG_ORGANIZER->TS_Changelog_Files_Registrations();
                    wp_enqueue_style('ts-changelog-generator');
                    wp_enqueue_script('ts-changelog-generator');
				}
			}
		}
	}
	
	
	// Add New Icon Picker Field
	if (!class_exists('CSF_Field_iconpicker')) {		
		class CSF_Field_iconpicker extends CSF_Fields {
			private $TS_CodeStar_Generator;
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
				$this->TS_CodeStar_Generator	= isset($this->field['generator']) ? $this->field['generator'] : '';
			}
			public function render(){				
                $type           		= isset($this->field['type']) ? $this->field['type'] : '';
				$default				= isset($this->field['default']) ? $this->field['default'] : '';
				$parameters				= isset($this->field['settings']) ? $this->field['settings'] : array();
				// Extract Custom Icon Picker Settings
				$icons_type				= isset($parameters['type']) ? $parameters['type'] : "extensions";
				$icons_source			= isset($parameters['source']) ? $parameters['source'] : array();
				if ((class_exists('VISUAL_COMPOSER_EXTENSIONS')) && (!isset($parameters['source']))) {					
					global $VISUAL_COMPOSER_EXTENSIONS;
					if ($icons_type == "extensions") {
						$icons_source	= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_List_Icons_Compliant;
					} else if ($icons_type == "rating") {
						$icons_source	= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_RatingScaleIconsCompliant;
					} else if ($icons_type == "hovereffect") {
						$icons_source	= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_HoverEffectsIconsSelectionCompliant + $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Icons_Compliant_Custom ;
					} else if ($icons_type == "navigator") {
						$icons_source	= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_NavigatorIconsCompliant + $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Icons_Compliant_Custom;
					} else if ($icons_type == "timeline") {
						$icons_source	= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_TimelineDateTimeCompliant;
					} else {
						$icons_source   = isset($parameters['source']) ? $parameters['source'] : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_List_Icons_Compliant;
					}
				}
				// Retrieve Settings
				$icons_empty			= isset($parameters['emptyIcon']) ? $parameters['emptyIcon'] : 'true';
				if ($icons_empty == true) {
					$icons_empty	= "true";
				} else if ($icons_empty == false) {
					$icons_empty	= "false";
				}
				$icons_transparent 		= isset($parameters['emptyIconValue']) ? $parameters['emptyIconValue'] : "";
				$icons_search			= isset($parameters['hasSearch']) ? $parameters['hasSearch'] : 'true';
				if ($icons_search == true) {
					$icons_search	= "true";
				} else if ($icons_search == false) {
					$icons_search	= "false";
				}				
				$icons_pagination		= isset($parameters['iconsPerPage']) ? $parameters['iconsPerPage'] : 192;
				// Check Value
				if (($this->value == "") && ($default != "")) {
					$value				= $default;
				} else {
					$value				= $this->value;
				}
				// Other Settings
				$randomizer				= mt_rand(999999, 9999999);
                $output         		= '';
				// Icon Picker Output
				echo $this->field_before();
				$output .= '<div id="ts-font-icons-picker-parent-' . $randomizer . '" class="ts-font-icons-picker-parent">';
					$output .= '<div id="ts-font-icons-picker-' . $this->field_name() . '" class="ts-visual-selector ts-font-icons-picker" data-value="' . $value . '" data-chosen="true" data-theme="inverted" data-empty="' . $icons_empty . '" data-transparent="' . $icons_transparent . '" data-search="' . $icons_search . '" data-pagecount="' . $icons_pagination . '" data-text-allfonts="' . __("From All Fonts", "ts_visual_composer_extend") . '" data-text-uncategorized="' . __("Uncategorized", "ts_visual_composer_extend") . '" data-text-searchicons="' . __("Search Icons ...", "ts_visual_composer_extend") . '">';
						$iconGroups		= array();
						$iconFonts		= 0;
						foreach ($icons_source as $group => $icons) {
							if (!is_array($icons) || !is_array(current($icons))) {
								$font			= "";
							} else {									
								$font			= str_replace("(", "", esc_attr($group));
								$font			= str_replace(")", "", $font);
							}
							if (($font != "") && (!in_array($font, $iconGroups))) {
								array_push($iconGroups, $font);
							}	
						}
						$iconFonts		= count($iconGroups);
						$iconGroups		= array();
						$output .= '<select id="' . $this->field_name() . '" name="' . $this->field_name() . '" class="' . $this->field_name() . ' ' . $type . '" value="' . $value . '" ' . $this->field_attributes() .'>';
							// Add Empty Placeholder
							if ($icons_empty == "true") {
								if (($value == "") || ($value == "transparent")) {
									$output .= '<option value="" selected="selected"></option>';
								} else {
									$output .= '<option value=""></option>';
								}
							}
							// Add Font Icons (based on provided Source)              
							foreach ($icons_source as $group => $icons) {
								if ($iconFonts > 1) {
									if (!is_array($icons) || !is_array(current($icons))) {
										$font		= "";
									} else {									
										$font		= str_replace("(", "", esc_attr($group));
										$font		= str_replace(")", "", $font);
									}
									if (($font != "") && (!in_array($font, $iconGroups))) {
										$output .= '<optgroup label="' . $font . '">';
									}
								}
								if (!is_array($icons) || !is_array(current($icons))) {
									$class_key      	= key($icons);
									$class_label		= (isset($icons[$class_key]) ? $icons[$class_key] : $class_key);
									$class_group    	= explode('-', esc_attr($class_key));
									if (($class_group[0] != "dashicons") && ($class_group[0] != "transparent")) {
										if ($value == esc_attr($class_key)) {
											$output .= '<option value="' . esc_attr($class_key) . '" selected="selected">' . esc_attr($class_label) . '</option>';
										} else {
											$output .= '<option value="' . esc_attr($class_key) . '">' . esc_attr($class_label) . '</option>';
										}
									} else {
										if ($value == esc_attr($class_key)) {
											$output .= '<option value="' . esc_attr($class_key) . '" selected="selected">' . esc_attr($class_label) . '</option>';
										} else {
											$output .= '<option value="' . esc_attr($class_key) . '">' . esc_attr($class_label) . '</option>';
										}
									}
								} else {
									foreach ($icons as $key => $label) {
										$class_key      = key($label);
										$class_label	= (isset($label[$class_key]) ? $label[$class_key] : $class_key);
										$class_group    = explode('-', esc_attr($class_key));
										$font           = str_replace("(", "", strtolower(strtolower(esc_attr($group))));
										$font           = str_replace(")", "", strtolower($font));
										if (($class_group[0] != "dashicons") && ($class_group[0] != "transparent")) {
											if ($value == esc_attr($class_key)) {
												$output .= '<option value="' . esc_attr($class_key) . '" selected="selected">' . esc_attr($class_label) . '</option>';
											} else {
												$output .= '<option value="' . esc_attr($class_key) . '">' . esc_attr($class_label) . '</option>';
											}
										} else {
											if ($value == esc_attr($class_key)) {
												$output .= '<option value="' . esc_attr($class_key) . '" selected="selected">' . esc_attr($class_label) . '</option>';
											} else {
												$output .= '<option value="' . esc_attr($class_key) . '">' . esc_attr($class_label) . '</option>';
											}
										}
									}
								}									
								if (($font != "") && (!in_array($font, $iconGroups)) && ($iconFonts > 1)) {
									$output .= '</optgroup>';
									array_push($iconGroups, $font);
								}
							}
						$output .= '</select>';
					$output .= '</div>';
				$output .= '</div>';
                echo $output;				
				echo $this->field_after();
			}
			public function enqueue() {
				if (($this->TS_CodeStar_Generator == 'ts-composium-shortcode') && (class_exists('VISUAL_COMPOSER_EXTENSIONS'))) {
					global $VISUAL_COMPOSER_EXTENSIONS;					
					$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconFontsEnqueue(false);		
				} else if (($this->TS_CodeStar_Generator == 'ts-tablenator-shortcode') && (class_exists('TS_ADVANCED_TABLESWP'))) {
					global $TS_ADVANCED_TABLESWP;
					$TS_ADVANCED_TABLESWP->TS_TablesWP_IconFontsEnqueue(false);
				} else if (($this->TS_CodeStar_Generator == 'ts-changelogs-shortcode') && (class_exists('TS_CHANGELOG_ORGANIZER'))) {
					
				}				
				wp_enqueue_script('ts-extend-iconpicker');
				wp_enqueue_style('ts-extend-iconpicker');
			}
		}
	}
	
	// Custom Preloader Preview Field
	if (!class_exists('CSF_Field_preloaders')) {
		class CSF_Field_preloaders extends CSF_Fields {
			private $TS_CodeStar_Generator;
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
				$this->TS_CodeStar_Generator	= isset($this->field['generator']) ? $this->field['generator'] : '';
			}  
			public function render() {
				$preview			= array();
				$generator			= '';
				if (($this->TS_CodeStar_Generator == 'ts-composium-shortcode') && (class_exists('VISUAL_COMPOSER_EXTENSIONS'))) {
					global $VISUAL_COMPOSER_EXTENSIONS;
					$preview		= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Preloader_Styles;
					$generator		= 'ts-composium-shortcode';
				} else if (($this->TS_CodeStar_Generator == 'ts-tablenator-shortcode') && (class_exists('TS_ADVANCED_TABLESWP'))) {
					global $TS_ADVANCED_TABLESWP;
					$preview		= $TS_ADVANCED_TABLESWP->TS_TablesWP_Preloader_Styles;
					$generator		= 'ts-tablenator-shortcode';
				} else if (($this->TS_CodeStar_Generator == 'ts-changelogs-shortcode') && (class_exists('TS_CHANGELOG_ORGANIZER'))) {
					global $TS_CHANGELOG_ORGANIZER;					
				}
				$shownone			= isset($this->field['shownone']) 	? $this->field['shownone'] 	: 'true';
				$prefix				= isset($this->field['prefix']) 	? $this->field['prefix'] : '';
				$connector			= isset($this->field['connector']) 	? $this->field['connector'] : '';
				$randomizer 		= rand(100000, 999999);
                $output         	= '';
				$output .= $this->field_before();
                $output .= '<div id="ts-live-review-wrapper-' . $randomizer . '" class="ts-live-preview-wrapper clearFixMe" data-initialized="false" data-preview="preloaders" data-chosen="true" data-connector="' . $connector . '" data-prefix="' . $prefix . '">';
					$output .= '<div class="ts-live-preview-selector">';
                        $output .= '<select name="' . $this->field_name() . '" class="ts-live-preview-selectbox ' . $this->field_name() . '" ' . $this->field_attributes() . ' data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" data-name="' . $this->field_name() . '" data-option="' . $this->value . '" value="' . $this->value . '">';						
							foreach ($preview as $key => $index) {
								if ($index == -1) {
									if ($shownone == "true") {
										$output .= '<option class="" value="' . $index . '" data-name="' . $key . '" data-value="' . $index . '" ' . selected($index, 	$this->value, false) . '>' . $key . '</option>';
									}
								} else {
									$output .= '<option class="" value="' . $index . '" data-name="' . $key . '" data-value="' . $index . '" ' . selected($index, 	$this->value, false) . '>' . $key . '</option>';
								}
							}
                        $output .= '</select>';
                    $output .= '</div>';
                    $output .= '<div class="ts-live-preview-display">';
						foreach ($preview as $key => $index) {
							if ($index != "-1") {
								if ($generator == 'ts-tablenator-shortcode') {
									$output .= TS_VCSC_CreatePreloaderCSS("ts-live-preview-preloader-" . $randomizer . "-" . $index, "ts-live-preview-hidden", $index, "true");
								} else if ($generator == 'ts-composium-shortcode') {
									$output .= TS_TablesWP_CreatePreloaderCSS("ts-live-preview-preloader-" . $randomizer . "-" . $index, "ts-live-preview-hidden", $index, "true");
								}
							}
						}
                    $output .= '</div>';
                $output .= '</div>';
				$output .= $this->field_after();
				echo $output;
			}
			public function enqueue() {

			}
		}
	}
	
	// Conditional Output Field
	if (!class_exists('CSF_Field_conditionalview')) {	
		class CSF_Field_conditionalview extends CSF_Fields {
			private $TS_CodeStar_Generator;
			private $TS_CodeStar_Conditionals_Roles;
			private $TS_CodeStar_Conditionals_Rights;
			private $TS_CodeStar_Conditionals_Tags;
			private $TS_CodeStar_Conditionals_Devices;			
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
				$this->TS_CodeStar_Generator	= isset($this->field['generator']) ? $this->field['generator'] : '';
			}  
			public function render() {
				$value								= $this->value;
                $type           					= isset($this->field['type']) 			? $this->field['type'] 			: '';
                $prefix         					= isset($this->field['prefix']) 		? $this->field['prefix'] 		: '';
				$connector							= isset($this->field['connector']) 		? $this->field['connector'] 	: '';
				$random 							= mt_rand (0, 1000000);
                $emptyholder                        = '';
				$defaults							= array(
					'viewerstatus'					=> 'everybody',
					'restriction'					=> 'none',						
					'userroles'						=> '',
					'userscope'						=> 'any',
					'usercaps'						=> '',
					'otherscope'					=> 'any',
					'othertags'						=> '',
					'devicetypes'					=> '',
				);
				// Retrieve User Roles + Capabilities + Tags
				$this->conditionals_arraydata();
				// Contingency Checks
				if (!empty($value)) {
					$value							= json_decode(base64_decode($value), true);
				}
				if (($this->TS_CodeStar_Generator == 'ts-composium-shortcode') && (function_exists('TS_VCSC_CheckIsAssociateArray'))) {
					if ((empty($value)) || (!TS_VCSC_CheckIsAssociateArray($value))) {
						$value						= $defaults;
					}
				} else if (($this->TS_CodeStar_Generator == 'ts-tablenator-shortcode') && (function_exists('TS_TablesWP_CheckIsAssociateArray'))) {
					if ((empty($value)) || (!TS_TablesWP_CheckIsAssociateArray($value))) {
						$value						= $defaults;
					}
				} else if (($this->TS_CodeStar_Generator == 'ts-changelogs-shortcode') && (function_exists('TS_Changelogs_CheckIsAssociateArray'))) {
					if ((empty($value)) || (!TS_Changelogs_CheckIsAssociateArray($value))) {
						$value						= $defaults;
					}
				}
				if (!isset($value['viewerstatus'])) {
					$value['viewerstatus']	        = 'everybody';
				}
				if (!isset($value['restriction'])) {
					$value['restriction']	        = 'none';
				}
				if (!isset($value['userroles'])) {
					$value['userroles']		        = '';
				}
				if (!isset($value['userscope'])) {
					$value['userscope']		        = 'any';
				}
				if (!isset($value['usercaps'])) {
					$value['usercaps']		        = '';
				}
				if (!isset($value['otherscope'])) {
					$value['otherscope']		    = 'any';
				}
				if (!isset($value['othertags'])) {
					$value['othertags']		        = '';
				}
				if (!isset($value['devicetypes'])) {
					$value['devicetypes']	        = '';
				}
				$emptyholder                        = trim($value['userroles']);
                if (!empty($emptyholder)) {
					$value['userroles']				= explode(',', $emptyholder);
				} else {
					$value['userroles']				= array();
				}
                $emptyholder                        = trim($value['othertags']);
				if (!empty($emptyholder)) {
					$value['othertags']				= explode(',', $emptyholder);
				} else {
					$value['othertags']				= array();
				}
                $emptyholder                        = trim($value['devicetypes']);
				if (!empty($emptyholder)) {
					$value['devicetypes']			= explode(',', $emptyholder);
				} else {
					$value['devicetypes']			= array();
				}
				if (count($value['othertags']) > 0) {
					$toggle_othertags 				= "true";
				} else {
					$toggle_othertags 				= "false";
				}
				if (count($value['devicetypes']) > 0) {
					$toggle_devicetypes				= "true";
				} else {
					$toggle_devicetypes				= "false";
				}
				if (($value['restriction'] == 'userroles') && (count($value['userroles']) == 0)) {
					$value['restriction']			= 'none';
				} else if (($value['restriction'] == 'userrights') && (empty($value['usercaps']))) {
					$value['restriction']			= 'none';
				}
				// Render Conditional Parameter
				$output         					= '';
				$output .= $this->field_before();
				$output .= '<div id="ts-conditionals-wrapper-' . $random . '" class="ts-conditionals-wrapper ts-settings-parameter-gradient-grey" data-connector="' . $connector . '" data-chosen="true" data-string-viewerstatus="' . __( "Visibility", "ts_visual_composer_extend" ) . '" data-string-everybody="' . __( "Everybody", "ts_visual_composer_extend" ) . '" data-string-loggedin="' . __( "Logged In Only", "ts_visual_composer_extend" ) . '" data-string-external="' . __( "External Only", "ts_visual_composer_extend" ) . '" data-string-userconditions="' . __( "User Conditions", "ts_visual_composer_extend" ) . '" data-string-none="' . __( "None", "ts_visual_composer_extend" ) . '" data-string-userroles="' . __( "User Role(s)", "ts_visual_composer_extend" ) . '" data-string-userrights="' . __( "User Right(s)", "ts_visual_composer_extend" ) . '" data-string-othertags="' . __( "Tag Conditions", "ts_visual_composer_extend" ) . '" data-string-yes="' . __( "Yes", "ts_visual_composer_extend" ) . '" data-string-no="' . __( "No", "ts_visual_composer_extend" ) . '">';
					// Render Logged-In User
					$output .= '<div class="ts-conditionals-title">' . __( "Visibility Condition", "ts_visual_composer_extend" ) . '</div>';					
					$output .= '<select class="ts-conditionals-viewerstatus">';
						$output .= '<option value="everybody" ' . selected($value['viewerstatus'], "everybody", false) . '>' . __( "Visible To Everybody", "ts_visual_composer_extend" ) . '</option>';
						$output .= '<option value="loggedin" ' . selected($value['viewerstatus'], "loggedin", false) . '>' . __( "Only Logged In Users", "ts_visual_composer_extend" ) . '</option>';
						$output .= '<option value="external" ' . selected($value['viewerstatus'], "external", false) . '>' . __( "Only External Visitors", "ts_visual_composer_extend" ) . '</option>';
					$output .= '</select>';
					$output .= '<div class="ts-conditionals-description vc_description">' . __( "Select if you want to limit the visibility of this table only to logged in user, external visitors only, or if it should be visble to everybody.", "ts_visual_composer_extend" ) . '</div>';							
					// Render User Restriction					
					$output .= '<div class="ts-conditionals-restrictions" style="display: ' . ($value['viewerstatus'] == "loggedin" ? "block" : "none") . ';">';
						$output .= '<div class="ts-conditionals-title">' . __( "User Conditions", "ts_visual_composer_extend" ) . '</div>';
						$output .= '<select class="ts-conditionals-restriction">';
							$output .= '<option value="none" ' . selected($value['restriction'], "none", false) . '>' . __( "No Other User Condition(s)", "ts_visual_composer_extend" ) . '</option>';
							$output .= '<option value="userroles" ' . selected($value['restriction'], "userroles", false) . '>' . __( "Fulfill Specific User Role(s)", "ts_visual_composer_extend" ) . '</option>';
							$output .= '<option value="userrights" ' . selected($value['restriction'], "userrights", false) . '>' . __( "Fulfill Specific User Right(s)", "ts_visual_composer_extend" ) . '</option>';
						$output .= '</select>';
						$output .= '<div class="ts-conditionals-description vc_description">' . __( "Select if the visiblity of the contents of this table should be limited to any specific user roles or capabilities.", "ts_visual_composer_extend" ) . '</div>';
					$output .= '</div>';
					// User Capabilities
					$output .= '<div class="ts-conditionals-userrights" style="display: ' . ($value['restriction'] == "userrights" ? "block" : "none") . ';">';						
						$output .= '<div class="ts-conditionals-autocomplete" data-autocomplete="' . implode(',', $this->TS_CodeStar_Conditionals_Rights) . '" style="display: none;"></div>';						
						$output .= '<div class="ts-conditionals-title">' . __( "User Right(s) (Capabilities)", "ts_visual_composer_extend" ) . '</div>';
						$output .= '<select class="ts-conditionals-userscope" style="margin-bottom: 10px;">';
							$output .= '<option value="any" ' . selected($value['userscope'], "any", false) . '>' . __( "Fulfill At Least One Capability", "ts_visual_composer_extend" ) . '</option>';
							$output .= '<option value="all" ' . selected($value['userscope'], "all", false) . '>' . __( "Fulfill All Capabilities", "ts_visual_composer_extend" ) . '</option>';
						$output .= '</select>';						
						$output .= '<div class="ts-tag-editor-wrapper">';							
							$output .= '<input class="ts-conditionals-usercaps ts-tag-editor-input" type="text" value="' . $value['usercaps'] . '"/>';
							$output .= '<div class="ts-conditionals-description vc_description">' . __( "Enter the specific capabilities a logged in user must have (either at least one or all of them) in order to see this table when viewing this page or post; separate capabilities with a space or comma character.", "ts_visual_composer_extend" ) . ' ' . __( "Learn more about user capabilities:", "ts_visual_composer_extend" ) . ' ' . '<a href="https://codex.wordpress.org/Roles_and_Capabilities#Capabilities" target="_blank">' . __( "User Capabilities", "ts_visual_composer_extend" ) . '</a></div>';
						$output .= '</div>';
					$output .= '</div>';
					// User Roles Selector
					$output .= '<div class="ts-conditionals-userroles" style="display: ' . ($value['restriction'] == "userroles" ? "block" : "none") . ';">';
						$output .= '<div class="ts-conditionals-title">' . __( "User Roles", "ts_visual_composer_extend" ) . '</div>';
						foreach ($this->TS_CodeStar_Conditionals_Roles as $role => $name) {
							$output .= '<label class="ts-conditionals-label">';
								$output .= '<input id="ts-conditionals-userrole-' . $role . '" class="ts-conditionals-userrole" type="checkbox" value="' . $role . '" ' . (checked(in_array($role, $value['userroles']), true, false)) . '>';
							$output .= $name . '</label>';
						}					
						$output .= '<div class="ts-conditionals-description vc_description">' . __( "Select any user role(s) a logged in user can have in order to see this table when viewing this page or post. Learn more about user roles:", "ts_visual_composer_extend" ) . ' ' . '<a href="https://codex.wordpress.org/Roles_and_Capabilities#Roles" target="_blank">' . __( "User Roles", "ts_visual_composer_extend" ) . '</a></div>';
					$output .= '</div>';
					// Render Device Type Settings
					$output .= '<div class="ts-conditionals-title">' . __( "Device Conditions", "ts_visual_composer_extend" ) . '</div>';
					$output .= '<div class="ts-conditionals-devicetoggle ts-switch-button ts-codestar-field-switcher" data-value="' . $toggle_devicetypes . '" data-render="string">';
						$output .= '<input type="hidden" style="display: none;" class="ts-codestar-value toggle-input hidden ignore" value="' . $toggle_devicetypes . '" name="_nonce[ts-conditionals-devicetoggle-input]"/>';
						$output .= '<div class="ts-codestar-fieldset">';
							$output .= '<label class="ts-codestar-label">';										
								$output .= '<input value="' . $toggle_devicetypes . '" class="ts-codestar-checkbox" type="checkbox" ' . ((($toggle_devicetypes == "true") || ($toggle_devicetypes == "1")) ? 'checked="checked"' : '') . '> ';
								$output .= '<em data-on="'. __("Yes", "ts_visual_composer_extend") .'" data-off="'. __("No", "ts_visual_composer_extend") .'"></em>';
								$output .= '<span></span>';
							$output .= '</label>';
						$output .= '</div>';
					$output .= '</div>';					
					$output .= '<div class="ts-conditionals-description vc_description">' . __( "Use the toggle if you want to limit the visibility of this table to specific device types.", "ts_visual_composer_extend" ) . '</div>';	
					$output .= '<div class="ts-conditionals-devicetypes" style="display: ' . ($toggle_devicetypes == "true" ? "block" : "none") . ';">';
						foreach($this->TS_CodeStar_Conditionals_Devices as $condition){
							$output .= '<label class="ts-conditionals-label" style="margin-left: ' . ((($condition == "tablets") || ($condition == "phones")) ? '22' : '0') . 'px;">';
								$output .= '<input class="ts-conditionals-devicetype" type="checkbox" value="' . $condition . '" ' . (checked(in_array($condition, $value['devicetypes']), true, false)) . '>';
							$output .= ucfirst($condition) . '</label>';
						}	
						$output .= '<div class="ts-conditionals-description vc_description">' . __( "Select the device types that must be used in order to see this table when viewing this page or post; mobile devices automatically include all tablet and phone devices.", "ts_visual_composer_extend" ) . '</div>';	
					$output .= '</div>';
					// Render Conditional Settings
					$output .= '<div class="ts-conditionals-title">' . __( "Other Conditions", "ts_visual_composer_extend" ) . '</div>';
					$output .= '<div class="ts-conditionals-othertoggle ts-switch-button ts-codestar-field-switcher" data-value="' . $toggle_othertags . '" data-render="string">';
						$output .= '<input type="hidden" style="display: none;" class="ts-codestar-value toggle-input hidden ignore" value="' . $toggle_othertags . '" name="_nonce[ts-conditionals-othertoggle-input]"/>';
						$output .= '<div class="ts-codestar-fieldset">';
							$output .= '<label class="ts-codestar-label">';										
								$output .= '<input value="' . $toggle_othertags . '" class="ts-codestar-checkbox" type="checkbox" ' . ((($toggle_othertags == "true") || ($toggle_othertags == "1")) ? 'checked="checked"' : '') . '> ';
								$output .= '<em data-on="'. __("Yes", "ts_visual_composer_extend") .'" data-off="'. __("No", "ts_visual_composer_extend") .'"></em>';
								$output .= '<span></span>';
							$output .= '</label>';
						$output .= '</div>';
					$output .= '</div>';					
					$output .= '<div class="ts-conditionals-description vc_description">' . __( "Use the toggle if you want to apply other (non-user related) conditions to the visibility of this table.", "ts_visual_composer_extend" ) . '</div>';					
					$output .= '<div class="ts-conditionals-othertags" style="display: ' . ($toggle_othertags == "true" ? "block" : "none") . ';">';
						$output .= '<select class="ts-conditionals-otherscope" style="margin-bottom: 10px;">';
							$output .= '<option value="any" ' . selected($value['otherscope'], "any", false) . '>' . __( "Fulfill At Least One Condition", "ts_visual_composer_extend" ) . '</option>';
							$output .= '<option value="all" ' . selected($value['otherscope'], "all", false) . '>' . __( "Fulfill All Conditions", "ts_visual_composer_extend" ) . '</option>';
						$output .= '</select>';
						foreach($this->TS_CodeStar_Conditionals_Tags as $condition){
							$output .= '<label class="ts-conditionals-label">';
								$output .= '<input class="ts-conditionals-othertag" type="checkbox" value="' . $condition . '" ' . (checked(in_array($condition, $value['othertags']), true, false)) . '>';
							$output .= $condition . '</label>';
						}					
						$output .= '<div class="ts-conditionals-description vc_description">' . __( "Select the conditionals tags that must be fulfilled (either at least one or all of them) in order to see this table when viewing this page or post. Learn more about conditional tags:", "ts_visual_composer_extend" ) . ' ' . '<a href="https://codex.wordpress.org/Conditional_Tags" target="_blank">' . __( "Conditional Tags", "ts_visual_composer_extend" ) . '</a></div>';
					$output .= '</div>';
					// Hidden Input for Data Aggregation
					$value['userroles']				= implode(',', $value['userroles']);
					$value['othertags']				= implode(',', $value['othertags']);
					$value['devicetypes']			= implode(',', $value['devicetypes']);
					$output .= '<textarea id="ts-conditionals-aggregate-' . $random . '" name="' . $this->field_name() . '" class="ts-conditionals-aggregate ' . $this->field_name() . ' ' . $type . '" data-default="" style="display: none;">' . base64_encode(json_encode($value)) . '</textarea>';
				$output .= '</div>';
				$output .= $this->field_after();
				echo $output;
			}
			public function enqueue() {

			}
			function conditionals_arraydata() {
				$this->TS_CodeStar_Conditionals_Roles 			= array();
				$this->TS_CodeStar_Conditionals_Rights			= array();
				if (($this->TS_CodeStar_Generator == 'ts-composium-shortcode') && (class_exists('VISUAL_COMPOSER_EXTENSIONS'))) {
					global $VISUAL_COMPOSER_EXTENSIONS;
					if ((!empty($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Conditionals_Roles)) && (!empty($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Conditionals_Rights))) {
						$this->TS_CodeStar_Conditionals_Roles	= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Conditionals_Roles;
						$this->TS_CodeStar_Conditionals_Rights	= $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Conditionals_Rights;
					}
				} else if (($this->TS_CodeStar_Generator == 'ts-tablenator-shortcode') && (class_exists('TS_ADVANCED_TABLESWP'))) {
					global $TS_ADVANCED_TABLESWP;
					if ((!empty($TS_ADVANCED_TABLESWP->TS_TablesWP_Conditionals_Roles)) && (!empty($TS_ADVANCED_TABLESWP->TS_TablesWP_Conditionals_Rights))) {
						$this->TS_CodeStar_Conditionals_Roles 	= $TS_ADVANCED_TABLESWP->TS_TablesWP_Conditionals_Roles;
						$this->TS_CodeStar_Conditionals_Rights 	= $TS_ADVANCED_TABLESWP->TS_TablesWP_Conditionals_Rights;
					}
				} else if (($this->TS_CodeStar_Generator == 'ts-changelogs-shortcode') && (class_exists('TS_CHANGELOG_ORGANIZER'))) {
					global $TS_CHANGELOG_ORGANIZER;
				}
				if ((empty($this->TS_CodeStar_Conditionals_Roles)) || (empty($this->TS_CodeStar_Conditionals_Rights))) {
					global $wp_roles;
					if (!isset($wp_roles)) {
						$wp_roles 						    = new WP_Roles();
					}
					$this->TS_CodeStar_Conditionals_Roles 		= $wp_roles->get_names();
					$this->TS_CodeStar_Conditionals_Rights		= array();
					foreach ($wp_roles->roles as $role) {
						foreach ($role['capabilities'] as $capabilities => $capability) {
							if (!in_array($capabilities, $this->TS_CodeStar_Conditionals_Rights)){
								array_push($this->TS_CodeStar_Conditionals_Rights, $capabilities);
							}
						}
					}
				}
				$this->TS_CodeStar_Conditionals_Tags			= array(
					'is_home',
					'is_front_page',
					'is_singular',
					'is_page',
					'is_single',
					'is_sticky',
					'is_category',
					'is_tax',
					'is_author',
					'is_archive',
					'is_search',
					'is_attachment',
					'is_tag',
					'is_paged',
					'is_main_query',
					'is_feed',
					'is_trackback',
					'is_404',
					'is_preview',
				);
				$this->TS_CodeStar_Conditionals_Devices			= array(
					'desktops',
					'mobiles',
					'tablets',					
					'phones',
				);
			}
		}
	}
	
	
	/* ---------------------------------- */
	/* SINGLE Plugin ONLY CodeStar Fields */
	/* ---------------------------------- */
	
	// Add New CSS3 Animations Field (Composium ONLY)
	if (!class_exists('CSF_Field_css3animations')) {		
		class CSF_Field_css3animations extends CSF_Fields {	
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
			}
			public function render(){
                global $VISUAL_COMPOSER_EXTENSIONS;
                $type 					= isset($this->field['type']) ? $this->field['type'] : '';
				$default				= isset($this->field['default']) ? $this->field['default'] : '';
				$parameters				= isset($this->field['settings']) ? $this->field['settings'] : array();
                $class 					= isset($parameters['class']) ? $parameters['class'] : '';
                $noneselect				= isset($parameters['noneselect']) ? $parameters['noneselect'] : 'false';
                $prefix					= isset($parameters['prefix']) ? $parameters['prefix'] : '';
                $connector				= isset($parameters['connector']) ? $parameters['connector'] : '';
				$animations				= isset($parameters['animations']) ? $parameters['animations'] : array();
                $effectgroups			= array();
                $selectedclass			= '';
                $selectedgroup			= '';
                $output 				= '';
                $css3animations 		= '';
				$randomizer				= mt_rand(999999, 9999999);
				$value 					= $this->value;
                if (empty($value)) {
                    $value				= $prefix . $default;
                }
                // Check for Conversion of VC Animations
                $value					= TS_VCSC_ConvertLegacyAnimation($value);
                // Create "None" Option if requested
                if ($noneselect == 'true') {
                    $css3animations .= '<option class="" value="" data-name=""data-group="" data-prefix="" data-value="">' . __( "None", "ts_visual_composer_extend" ) . '</option>';
                };
                foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Animations_Array as $Animation_Class => $animations) {
                    if ($animations) {
                        if (!in_array($animations['group'], $effectgroups)) {
                            array_push($effectgroups, $animations['group']);
                            $css3animations .= '<optgroup label="' . $animations['group'] . '">';
                        }
                        if ($value == $prefix . $animations['class']) {
                            $css3animations .= '<option class="' . $animations['class'] . '" value="' . $prefix . $animations['class'] . '" data-name="' . $Animation_Class . '" data-group="' . $animations['group'] . '" data-prefix="' . $prefix . '" data-value="' . $animations['class'] . '" selected="selected">' . $Animation_Class . '</option>';
                            $selectedgroup 	= $animations['group'];
                            $selectedclass	= 'ts-animation-frame ts-hover-css-' . $animations['class'];
                        } else {
                            $css3animations .= '<option class="' . $animations['class'] . '" value="' . $prefix . $animations['class'] . '" data-name="' . $Animation_Class . '"data-group="' . $animations['group'] . '" data-prefix="' . $prefix . '" data-value="' . $animations['class'] . '">' . $Animation_Class . '</option>';
                        }
                    }
                }
                unset($effectgroups);
				echo $this->field_before();
                $output .= '<div id="ts-css3-animations-wrapper-' . $randomizer . '" class="ts-css3-animations-wrapper clearFixMe ts-settings-parameter-gradient-grey" data-connector="' . $connector . '" data-prefix="' . $prefix . '" data-chosen="true" data-initialized="false">';
                    $output .= '<div class="ts-css3-animations-selector">';
                        $output .= '<select name="' . $this->field_name() . '" class="ts-css3-animations-select ' . $this->field_name() . ' ' . $type . ' ' . $class . ' ' . $value . '" data-class="' . $class . '" data-type="' . $type . '" data-name="' . $this->field_name() . '" data-option="' . $value . '" value="' . $value . '" ' . $this->field_attributes()  . '>';
                            $output .= $css3animations;
                        $output .= '</select>';
                    $output .= '</div>';
                    $output .= '<div class="ts-css3-animations-preview">';
                        $output .= '<span class="' . $selectedclass . '">' . __( "Animation Preview", "ts_visual_composer_extend" ) . '</span>';
                    $output .= '</div>';
                $output .= '</div>';
                echo $output;
				echo $this->field_after();
            }	
			public function enqueue() {
				wp_enqueue_style('ts-extend-animations');
			}
		}
	}
	
	// Custom Table Selector Field (Tablenator ONLY)
	if (!class_exists('CSF_Field_tablenatorpicker')) {
		class CSF_Field_tablenatorpicker extends CSF_Fields {		
			public function __construct($field, $value = '', $unique = '', $where = '', $parent = '') {
				parent::__construct($field, $value, $unique, $where, $parent);
			}  
			public function render() {
                global $TS_ADVANCED_TABLESWP;
				// Main Settings
				$table_chosen				= isset($this->field['chosen'])			? $this->field['chosen']			: 'false';
				// String Settings
				$string_rows				= isset($this->field['string_rows'])	? $this->field['string_rows']		: __( "Rows:", "ts_visual_composer_extend" );
				$string_cols				= isset($this->field['string_cols'])	? $this->field['string_cols']		: __( "Columns:", "ts_visual_composer_extend" );
				$string_create				= isset($this->field['string_create'])	? $this->field['string_create']		: __( "Created:", "ts_visual_composer_extend" );
				$string_update				= isset($this->field['string_update'])	? $this->field['string_update']		: __( "Updated:", "ts_visual_composer_extend" );
				// Other Settings
				$wordpress_date				= get_option('date_format');
				$wordpress_time				= get_option('time_format');
                $output         			= '';
				$randomizer					= rand(100000, 999999);
				// Get Existing Tables
				$output .= $this->field_before();
				$output .= '<div id="ts-advanced-tables-wrapper-' . $randomizer . '" class="ts-advanced-tables-wrapper clearFixMe" data-initialized="false" data-chosen="'. $table_chosen . '" data-name="' . $this->field_name() . '" data-value="' . $this->value . '">';
					$output .= '<div id="ts-advanced-tables-select-' . $randomizer . '" class="ts-advanced-tables-select">';
						$output .= '<select id="' . $this->field_name() . '" class="ts-advanced-tables-select-input ' . $this->field_name() . '" data-default="' . (isset($this->field['default']) ? $this->field['default'] : '') . '" name="' . $this->field_name() . '" ' . $this->field_attributes() . '>';
							if ($this->value == "") {
								$output .= '<option value="" disabled="disabled" ' . selected('', $this->value, false) . '>' . __( "Select Your Table", "ts_visual_composer_extend" ) . '</option>';
							}
							if (count($TS_ADVANCED_TABLESWP->TS_TablesWP_Custom_Tables) > 0) {
								foreach ($TS_ADVANCED_TABLESWP->TS_TablesWP_Custom_Tables as $tables => $table) {
									$output .= '<option value="' . $table['id'] . '" ' . selected($table['id'], $this->value) . ' data-value="' . $table['id'] . '" data-info="' . base64_encode(preg_replace('/\\\"/',"\"", (rawurldecode(base64_decode(strip_tags($table['info'])))))) . '" data-rows="' . $table['rows'] . '" data-columns="' . $table['columns'] . '" data-merged="' . $table['merged'] . '" data-created="' . date($wordpress_date . ' - ' . $wordpress_time, $table['create']) . '" data-updated="' . date($wordpress_date . ' - ' . $wordpress_time, $table['update']) . '">' . $table['name'] . ' (ID#' . $table['id'] . ')</option>';
								}
							}
						$output .= '</select>';
					$output .= '</div>';
					$output .= '<div id="ts-advanced-tables-summary-' . $randomizer . '" class="ts-advanced-tables-summary" data-string-rows="' . $string_rows . '" data-string-columns="' . $string_cols . '" data-string-created="' . $string_create . '" data-string-updated="' . $string_update . '">';
						if (($this->value != "") && (isset($TS_ADVANCED_TABLESWP->TS_TablesWP_Custom_Tables["table" . $this->value]))) {
							$table = $TS_ADVANCED_TABLESWP->TS_TablesWP_Custom_Tables["table" . $this->value];
							$output .= '<div id="ts-advanced-tables-summary-rows-' . $randomizer . '" class="ts-advanced-tables-summary-rows">' . $string_rows . ' ' . $table['rows'] . '</div>';
							$output .= '<div id="ts-advanced-tables-summary-columns-' . $randomizer . '" class="ts-advanced-tables-summary-columns">' . $string_cols . ' ' . $table['columns'] . '</div>';
							$output .= '<div id="ts-advanced-tables-summary-created-' . $randomizer . '" class="ts-advanced-tables-summary-created">' . $string_create . ' ' . date($wordpress_date . ' - ' . $wordpress_time, $table['create']) . '</div>';
							$output .= '<div id="ts-advanced-tables-summary-updated-' . $randomizer . '" class="ts-advanced-tables-summary-updated">' . $string_update . ' ' . date($wordpress_date . ' - ' . $wordpress_time, $table['update']) . '</div>';
							$output .= '<div id="ts-advanced-tables-summary-info-' . $randomizer . '" class="ts-advanced-tables-summary-info">';
								$output .= preg_replace('/\\\"/',"\"", (rawurldecode(base64_decode(strip_tags($table['info'])))));
							$output .= '</div>';
						} else {
							$output .= '<div id="ts-advanced-tables-summary-rows-' . $randomizer . '" class="ts-advanced-tables-summary-rows">' . $string_rows . ' N/A</div>';
							$output .= '<div id="ts-advanced-tables-summary-columns-' . $randomizer . '" class="ts-advanced-tables-summary-columns">' . $string_cols . ' N/A</div>';
							$output .= '<div id="ts-advanced-tables-summary-created-' . $randomizer . '" class="ts-advanced-tables-summary-created">' . $string_create . ' N/A</div>';
							$output .= '<div id="ts-advanced-tables-summary-updated-' . $randomizer . '" class="ts-advanced-tables-summary-updated">' . $string_update . ' N/A</div>';
							$output .= '<div id="ts-advanced-tables-summary-info-' . $randomizer . '" class="ts-advanced-tables-summary-info"></div>';
						}
					$output .= '</div>';
				$output .= '</div>';
				$output .= $this->field_after();
				echo $output;
			}
			public function enqueue() {

			}
		}
	}
?>