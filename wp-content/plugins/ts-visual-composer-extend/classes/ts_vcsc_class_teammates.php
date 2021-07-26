<?php
	if (!class_exists('TS_Teammates')){
		class TS_Teammates {
			function __construct() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						$this->TS_VCSC_Add_Team_Mates_Element_Lean();
					} else if (function_exists('vc_map')) {
						add_action('init',									array($this, 'TS_VCSC_Add_Team_Mates_Element_Standalone'), 9999999);
						add_action('init',									array($this, 'TS_VCSC_Add_Team_Mates_Element_Single'), 9999999);
						add_action('init',									array($this, 'TS_VCSC_Add_Team_Mates_Element_SliderCustom'), 9999999);
						add_action('init',									array($this, 'TS_VCSC_Add_Team_Mates_Element_SliderCategory'), 9999999);
					}
				} else {
					if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Team_Mates_Element_Lean'), 9999999);
					} else if (function_exists('vc_map')) {
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Team_Mates_Element_Standalone'), 9999999);
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Team_Mates_Element_Single'), 9999999);
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Team_Mates_Element_SliderCustom'), 9999999);
						add_action('admin_init',							array($this, 'TS_VCSC_Add_Team_Mates_Element_SliderCategory'), 9999999);
					}
				}
				if ((is_admin() == false) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAJAX == "true") || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginAlways == "true")) {
					add_shortcode('TS_VCSC_Team_Mates_Standalone',			array($this, 'TS_VCSC_Team_Mates_Standalone'));
					add_shortcode('TS_VCSC_Team_Mates_Single',				array($this, 'TS_VCSC_Team_Mates_Single'));
					add_shortcode('TS_VCSC_Team_Mates_Slider_Custom',		array($this, 'TS_VCSC_Team_Mates_Slider_Custom'));
					add_shortcode('TS_VCSC_Team_Mates_Slider_Category',		array($this, 'TS_VCSC_Team_Mates_Slider_Category'));
				}
			}
			
			// Register Element(s) via LeanMap
			function TS_VCSC_Add_Team_Mates_Element_Lean() {
				vc_lean_map('TS_VCSC_Team_Mates_Standalone', 				array($this, 'TS_VCSC_Add_Team_Mates_Element_Standalone'), null);
				vc_lean_map('TS_VCSC_Team_Mates_Single', 					array($this, 'TS_VCSC_Add_Team_Mates_Element_Single'), null);
				vc_lean_map('TS_VCSC_Team_Mates_Slider_Custom', 			array($this, 'TS_VCSC_Add_Team_Mates_Element_SliderCustom'), null);
				vc_lean_map('TS_VCSC_Team_Mates_Slider_Category', 			array($this, 'TS_VCSC_Add_Team_Mates_Element_SliderCategory'), null);
			}
			
			// Standalone Teammate
			function TS_VCSC_Team_Mates_Standalone ($atts, $content = null) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
				
				// Load Required Files
				wp_enqueue_script('ts-extend-krautlightbox');
				wp_enqueue_style('ts-extend-krautlightbox');
				wp_enqueue_style('ts-font-teammates');
				wp_enqueue_style('ts-extend-tooltipster');
				wp_enqueue_script('ts-extend-tooltipster');
				wp_enqueue_style('ts-extend-animations');
				wp_enqueue_style('ts-visual-composer-extend-front');
				wp_enqueue_script('ts-visual-composer-extend-front');
				
				extract( shortcode_atts( array(
					'team_member'					=> '',
					'custompost_name'				=> '',
					'style'							=> 'style1',
					'show_image'            		=> 'true',
					'image_style'					=> 'imagestyle1',
					'show_grayscale'        		=> 'true',
					'grayscale_hover'				=> 'true',
					'show_lightbox'         		=> 'true',
					'link_image'					=> 'false',
					'show_title'           	 		=> 'true',
					'show_content'          		=> 'true',
					'show_dedicated'        		=> 'false',
					'show_download'					=> 'true',
					'show_contact'					=> 'true',
					'show_opening'					=> 'true',
					'show_social'					=> 'true',
					'show_skills'					=> 'true',
					'bar_tooltip'					=> 'false',
					'icon_style' 					=> 'simple',
					'icon_color'					=> '#000000',
					'icon_background'				=> '#f5f5f5',
					'icon_frame_color'				=> '#f5f5f5',
					'icon_frame_thick'				=> 1,
					'icon_margin' 					=> 5,
					'icon_align'					=> 'left',
					'icon_hover'					=> '',
					'tooltip_style'					=> 'ts-simptip-style-black',
					'tooltip_position'				=> 'ts-simptip-position-top',
					'tooltip_animation'				=> 'swing',
					'tooltipster_offsetx'			=> 0,
					'tooltipster_offsety'			=> 0,
					'animation_view'				=> '',
					'content_wpautop'				=> 'true',
					'margin_top'					=> 0,
					'margin_bottom'					=> 0,
					'el_id' 						=> '',
					'el_class'              		=> '',
					'css'							=> '',
				), $atts ));
				
				$output 							= '';
				$wpautop 							= ($content_wpautop == "true" ? true : false);

				// Check for Teammate and End Shortcode if Empty
				if (empty($team_member)) {
					$output .= '<div style="text-align: justify; font-weight: bold; font-size: 14px; color: red;">Please select a teammate in the element settings!</div>';
					echo $output;
					$myvariable = ob_get_clean();
					return $myvariable;
				}
				
				// Check for Codestar Migration
				$codestarRetrieve					= "false";
				$codestarMigrated 					= get_post_meta($team_member, 'ts_vcsc_custompost_migrated', true);
				if (!empty($codestarMigrated)) {
					$codestarRetrieve				= "true";
				}
			
				if (!empty($el_id)) {
					$team_block_id					= $el_id;
				} else {
					$team_block_id					= 'ts-vcsc-meet-team-' . mt_rand(999999, 9999999);
				}
			
				if ($animation_view != '') {
					$animation_css              	= TS_VCSC_GetCSSAnimation($animation_view);
				} else {
					$animation_css					= '';
				}
				
				// Tooltip Settings
				$tooltip_position					= TS_VCSC_TooltipMigratePosition($tooltip_position);
				$tooltip_style						= TS_VCSC_TooltipMigrateStyle($tooltip_style);
				$team_tooltipclasses				= "ts-has-tooltipster-tooltip";
				$team_tooltipcontent				= 'data-tooltipster-title="" data-tooltipster-image="" data-tooltipster-position="' . $tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $tooltip_style . '" data-tooltipster-animation="' . $tooltip_animation . '" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
			
				if ((empty($icon_background)) || ($icon_style == 'simple')) {
					$icon_frame_style				= '';
				} else {
					$icon_frame_style				= 'background: ' . $icon_background . ';';
				}
				
				if ($icon_frame_thick > 0) {
					$icon_top_adjust				= 'top: ' . (10 - $icon_frame_thick) . 'px;';
				} else {
					$icon_top_adjust				= '';
				}
				
				if ($icon_style == 'simple') {
					$icon_frame_border				= '';
				} else {
					$icon_frame_border				= ' border: ' . $icon_frame_thick . 'px solid ' . $icon_frame_color . ';';
				}
				
				$icon_horizontal_adjust				= '';
			
				$team_social 						= '';				
				
				// WPML ID Conversion
				$team_member 						= TS_VCSC_WPMLConversionID($team_member, 'ts_team');
			
				// Retrieve Team Post Main Content
				$team_array							= array();
				$category_fields 	                = array();
				$args = array(
					'p'								=> $team_member,
					'no_found_rows' 				=> 1,
					'ignore_sticky_posts' 			=> 1,
					'posts_per_page' 				=> 1,
					'post_type' 					=> 'ts_team',
					'post_status' 					=> 'publish',
					'orderby' 						=> 'title',
					'order' 						=> 'ASC',
				);
				$team_query 						= new WP_Query($args);
				
				if ($team_query->have_posts()) {
					foreach($team_query->posts as $p) {
						if ($p->ID == $team_member) {
							$team_data = array(
								'author'			=> $p->post_author,
								'name'				=> $p->post_name,
								'title'				=> $p->post_title,
								'id'				=> $p->ID,
								'content'			=> $p->post_content,
							);
							$team_array[] 			= $team_data;
						}
					}
				}
				wp_reset_postdata();
				
				if (count($team_array) == 0) {
					$output .= '<div style="text-align: justify; font-weight: bold; font-size: 14px; color: red;">Please check your teammate selection in the element settings as no teammate data could be found!</div>';
					echo $output;
					$myvariable = ob_get_clean();
					return $myvariable;
				}
				
				// Build Team Post Main Content
				$Team_Author						= "";
				$Team_Name 							= "";
				$Team_Title 						= "";
				$Team_ID 							= "";
				$Team_Content 						= "";
				foreach ($team_array as $index => $array) {
					$Team_Author					= $team_array[$index]['author'];
					$Team_Name 						= $team_array[$index]['name'];
					$Team_Title 					= $team_array[$index]['title'];
					$Team_ID 						= $team_array[$index]['id'];
					$Team_Content 					= $team_array[$index]['content'];
					$Team_Image						= wp_get_attachment_image_src(get_post_thumbnail_id($Team_ID), 'full');
					if ($Team_Image == false) {
						$Team_Image          		= TS_VCSC_GetResourceURL('images/defaults/default_person.jpg');
					} else {
						$Team_Image          		= $Team_Image[0];
					}
				}
				
				// Retrieve Team Post Meta Content
				if ($codestarRetrieve == "true") {
					$custom_fields 					= get_post_meta($Team_ID, 'ts_vcsc_team_information', true);
					$custom_fields_array			= array();
					foreach ($custom_fields as $field_key => $field_values) {
						if (strpos($field_key, 'ts_vcsc_team_') !== false) {
							$field_key_split 		= explode("_", $field_key);
							$field_key_length 		= count($field_key_split) - 1;
							$custom_data = array(
								'group'				=> $field_key_split[$field_key_length - 1],
								'name'				=> 'Team_' . ucfirst($field_key_split[$field_key_length]),
								'value'				=> $field_values,
							);
							$custom_fields_array[] 	= $custom_data;
						}
					}
					foreach ($custom_fields_array as $index => $array) {
						${$custom_fields_array[$index]['name']} = $custom_fields_array[$index]['value'];
					}
				} else {
					$custom_fields 					= get_post_custom($Team_ID);
					$custom_fields_array			= array();
					foreach ($custom_fields as $field_key => $field_values) {
						if (!isset($field_values[0])) continue;
						if (in_array($field_key, array("_edit_lock", "_edit_last"))) continue;
						if (strpos($field_key, 'ts_vcsc_team_') !== false) {
							$field_key_split 		= explode("_", $field_key);
							$field_key_length 		= count($field_key_split) - 1;
							$custom_data = array(
								'group'				=> $field_key_split[$field_key_length - 1],
								'name'				=> 'Team_' . ucfirst($field_key_split[$field_key_length]),
								'value'				=> $field_values[0],
							);
							$custom_fields_array[] = $custom_data;
						}
					}
					foreach ($custom_fields_array as $index => $array) {
						${$custom_fields_array[$index]['name']} = $custom_fields_array[$index]['value'];
					}
				}				
				if (isset($Team_Position)) {
					$Team_Position 					= $Team_Position;
				} else {
					$Team_Position 					= '';
				}
				if (isset($Team_Buttonlabel)) {
					$Team_Buttonlabel				= $Team_Buttonlabel;
				} else {
					$Team_Buttonlabel				= '';
				}
				
				// Build Dedicated Page Link
				$team_dedicated     	= '';
				if ($show_dedicated == "true") {
					if ((isset($Team_Dedicatedpage)) && (($Team_Dedicatedpage != -1) || (($Team_Dedicatedpage == "external") && (isset($Team_Dedicatedlink))))) {
						if ($Team_Dedicatedpage == "external") {
							$Team_Dedicatedpage		= $Team_Dedicatedlink;
						} else {
							$Team_Dedicatedpage		= get_page_link($Team_Dedicatedpage);
						}
						if ((isset($Team_Dedicatedtarget)) && (($Team_Dedicatedtarget === true) || ($Team_Dedicatedtarget === "true"))) {
							$team_dedicated_target  = '_blank';
						} else {
							$team_dedicated_target  = '_parent';
						}
						$team_dedicated	.= '<div class="ts-teammate-dedicated">';
							if ((isset($Team_Dedicatedtooltip)) && ($Team_Dedicatedtooltip != "")) {
								if (((isset($Team_Dedicatedicon)) && ($Team_Dedicatedicon == "none")) || (!isset($Team_Dedicatedicon))) {
									$team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . ' ' . $team_tooltipclasses . '" data-tooltipster-text="' . $Team_Dedicatedtooltip . '"  ' . $team_tooltipcontent . ' href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '">' . $Team_Dedicatedlabel . '</a>';
								} else {
									$team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . ' ' . $team_tooltipclasses . '" data-tooltipster-text="' . $Team_Dedicatedtooltip . '"  ' . $team_tooltipcontent . ' href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '"><i class="ts-teamicon-' . $Team_Dedicatedicon . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Dedicatedcolor) ? "color: " . $Team_Dedicatedcolor . ":" : "") . '"></i> ' . $Team_Dedicatedlabel . '</a>';
								}                        
							} else {
								if (((isset($Team_Dedicatedicon)) && ($Team_Dedicatedicon == "none")) || (!isset($Team_Dedicatedicon))) {
									$team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . '" href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '">' . $Team_Dedicatedlabel . '</a>';
								} else {
									$team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . '" href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '"><i class="ts-teamicon-' . $Team_Dedicatedicon . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Dedicatedcolor) ? "color: " . $Team_Dedicatedcolor . ";" : "") . '"></i> ' . $Team_Dedicatedlabel . '</a>';
								}
							}
						$team_dedicated 	.= '</div>';
						if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
							wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
						}
					}
				} else if (($show_lightbox == "false") && ($link_image == "true")) {
					if ((isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
						$Team_Dedicatedpage         = get_page_link($Team_Dedicatedpage);
						if ((isset($Team_Dedicatedtarget)) && (($Team_Dedicatedtarget === true) || ($Team_Dedicatedtarget === "true"))) {
							$team_dedicated_target  = '_blank';
						} else {
							$team_dedicated_target  = '_parent';
						}
					}
				}            
				// Build Team Contact Information
				$team_contact			= '';
				$team_contact_count		= 0;
				if ($show_contact == "true") {
					$team_contact		.= '<div class="ts-team-contact">';
						if ((isset($Team_Email)) && (!empty($Team_Email))) {
							$team_contact_count++;
							if ((isset($Team_Emaillabel)) && (!empty($Team_Emaillabel))) {
								$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-email3 ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a target="_blank" class="" href="mailto:' . $Team_Email . '">' . $Team_Emaillabel . '</a></div>';
							} else {
								$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-email3 ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a target="_blank" class="" href="mailto:' . $Team_Email . '">' . $Team_Email . '</a></div>';
							}
						}
						if ((isset($Team_Phone)) && (!empty($Team_Phone))) {
							$team_contact_count++;
							$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-phone2 ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i>' . $Team_Phone . '</div>';
						}
						if ((isset($Team_Cell)) && (!empty($Team_Cell))) {
							$team_contact_count++;
							$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-mobile ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i>' . $Team_Cell . '</div>';
						}
						if ((isset($Team_Portfolio)) && (!empty($Team_Portfolio))) {
							$team_contact_count++;
							if ((isset($Team_Portfoliolabel)) && (!empty($Team_Portfoliolabel))) {
								$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-portfolio ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Portfolio) . '">' . $Team_Portfoliolabel . '</a></div>';
							} else {
								$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-portfolio ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Portfolio) . '">' . TS_VCSC_makeValidURL($Team_Portfolio) . '</a></div>';
							}
						}
						if ((isset($Team_Other)) && (!empty($Team_Other))) {
							$team_contact_count++;
							if ((isset($Team_Otherlabel)) && (!empty($Team_Otherlabel))) {
								$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-link ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Other) . '">' . $Team_Otherlabel . '</a></div>';
							} else {
								$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-link ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Other) . '">' . TS_VCSC_makeValidURL($Team_Other) . '</a></div>';
							}
						}
						if ((isset($Team_Skype)) && (!empty($Team_Skype))) {
							$team_contact_count++;
							$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-skype ts-font-icon ts-teammate-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i>' . $Team_Skype . '</div>';
						}
					$team_contact		.= '</div>';
				}
				// Build Opening / Contact Hours
				$team_opening			= '';
				$team_opening_count		= 0;
				if ($show_opening == "true") {
					$team_opening		.= '<div class="ts-team-opening-parent">';
						if ((isset($Team_Header)) && (!empty($Team_Header))) {
							if ($Team_Symbol == "none") {
								$team_opening .= '<div class="ts-team-opening-header">' . $Team_Header . '</div>';
							} else {
								$team_opening .= '<div class="ts-team-opening-header"><i class="ts-teamicon-' . $Team_Symbol . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Symbolcolor) ? "color: " . $Team_Symbolcolor . ";" : "") . '"></i>' . $Team_Header . '</div>';
							}
						}
						if ((isset($Team_Opening)) && ($Team_Opening != 'block') && (!empty($Team_Opening))) {
							$team_opening_count++;
							$team_opening .= '<div class="ts-team-opening-block">' . $Team_Opening . '</div>';
						}
					$team_opening		.= '</div>';
				}
				// Build Team Social Links
				$team_social 			= '';
				$team_social_count		= 0;
				if ($show_social == "true") {
					$team_social 		.= '<ul class="ts-teammate-icons ' . $icon_style . ' clearFixMe">';
						if ((isset($Team_Facebook)) && (!empty($Team_Facebook))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Facebook" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link facebook ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Facebook) . '"><i class="ts-teamicon-facebook1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Google)) && (!empty($Team_Google))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Google+" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link gplus ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Google) . '"><i class="ts-teamicon-googleplus1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Twitter)) && (!empty($Team_Twitter))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Twitter" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link twitter ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Twitter) . '"><i class="ts-teamicon-twitter1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Linkedin)) && (!empty($Team_Linkedin))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="LinkedIn" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link linkedin ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Linkedin) . '"><i class="ts-teamicon-linkedin ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Xing)) && (!empty($Team_Xing))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Xing" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link xing ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Xing) . '"><i class="ts-teamicon-xing3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Envato)) && (!empty($Team_Envato))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Envato" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link envato ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Envato) . '"><i class="ts-teamicon-envato ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Rss)) && (!empty($Team_Rss))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="RSS" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link rss ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Rss) . '"><i class="ts-teamicon-rss1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Forrst)) && (!empty($Team_Forrst))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Forrst" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link forrst ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Forrst) . '"><i class="ts-teamicon-forrst1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Flickr)) && (!empty($Team_Flickr))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Flickr" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link flickr ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Flickr) . '"><i class="ts-teamicon-flickr3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Instagram)) && (!empty($Team_Instagram))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Instagram" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link instagram ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Instagram) . '"><i class="ts-teamicon-instagram ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Picasa)) && (!empty($Team_Picasa))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Picasa" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link picasa ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Picasa) . '"><i class="ts-teamicon-picasa1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Pinterest)) && (!empty($Team_Pinterest))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Pinterest" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link pinterest ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Pinterest) . '"><i class="ts-teamicon-pinterest1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Vimeo)) && (!empty($Team_Vimeo))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Vimeo" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link vimeo ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Vimeo) . '"><i class="ts-teamicon-vimeo1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Youtube)) && (!empty($Team_Youtube))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="YouTube" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link youtube ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Youtube) . '"><i class="ts-teamicon-youtube1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
					$team_social 		.= '</ul>';
				}
				
				// Build Team Skills
				$team_skills 				= '';
				$team_skills_count			= 0;				
				if ((isset($Team_Skillset)) && ($show_skills == "true")) {
					$skill_background 		= '';
					if ($codestarRetrieve == "true") {
						$skill_entries		= $Team_Skillset;
					} else if (isset($Team_Skillset)) {
						$skill_entries		= get_post_meta($Team_ID, 'ts_vcsc_team_skills_skillset', true);
					} else {
						$skill_entries		= array();
					}
					if ((is_array($skill_entries)) && (!empty($skill_entries))) {
						$team_skills		.= '<div class="ts-teammate-member-skills">';
							foreach ((array) $skill_entries as $key => $entry) {
								$skill_name = $skill_value = $skill_color = '';
								if (isset($entry['skillname'])) {
									$skill_name      = esc_html($entry['skillname']);
								}
								if (isset($entry['skillvalue'])) {
									$skill_value     = esc_html($entry['skillvalue']);
								}
								if (isset($entry['skillcolor'])) {
									$skill_color     = esc_html($entry['skillcolor']);
								}
								if ((strlen($skill_name) != 0) && (strlen($skill_value) != 0)) {
									$team_skills_count++;
									if ((strlen($skill_color) != 0) && ($skill_color != '#')) {
										$skill_background = 'background-color: ' . $skill_color . ';';
									}
									$team_skills .= '<div class="ts-skillbars-style1-wrapper clearfix">';
										$team_skills .= '<div class="ts-skillbars-style1-name">' . $skill_name . '';
											if ($bar_tooltip == "false") {
												$team_skills .= '<span>(' . $skill_value . '%)</span>';
											}
										$team_skills .= '</div>';
										$team_skills .= '<div class="ts-skillbars-style1-skillbar" style="height: 5px; margin-bottom: 10px;"><div class="ts-skillbars-style1-value" data-color="' . $skill_color . '" data-level="' . $skill_value . '%" style="width: ' . $skill_value . '%; ' . $skill_background . '">';
											if ($bar_tooltip == "true") {
												$team_skills .= '<span class="ts-skillbars-style1-tooltip" style="padding: 2px 4px; font-size: 10px;">' . $skill_value . '%</span>';
											}
										$team_skills .= '</div></div>';
									$team_skills .= '</div>';
								}
							}
						$team_skills		.= '</div>';
					}
				} else if ((!isset($Team_Skillset)) && ($show_skills == "true")) {
					$skill_background 	= '';
					$team_skills		.= '<div class="ts-teammate-member-skills">';
						if ((isset($Team_Skillname1)) && (isset($Team_Skillvalue1))) {
							$team_skills_count++;
							if (isset($Team_Skillcolor1)) {
								$skill_background = 'background-color: ' . $Team_Skillcolor1 . ';';
							}
							$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname1 . '<span>(' . $Team_Skillvalue1 . '%)</span></div><div class="ts-skillbars-style1-skillbar" style="height: 5px;"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor1 . '" data-level="' . $Team_Skillvalue1 . '%" style="width: ' . $Team_Skillvalue1 . '%; ' . $skill_background . '"></div></div>';
						}
						if ((isset($Team_Skillname2)) && (isset($Team_Skillvalue2))) {
							$team_skills_count++;
							if (isset($Team_Skillcolor2)) {
								$skill_background = 'background-color: ' . $Team_Skillcolor2 . ';';
							}
							$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname2 . '<span>(' . $Team_Skillvalue2 . '%)</span></div><div class="ts-skillbars-style1-skillbar" style="height: 5px;"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor2 . '" data-level="' . $Team_Skillvalue2 . '%" style="width: ' . $Team_Skillvalue2 . '%; ' . $skill_background . '"></div></div>';
						}
						if ((isset($Team_Skillname3)) && (isset($Team_Skillvalue3))) {
							$team_skills_count++;
							if (isset($Team_Skillcolor3)) {
								$skill_background = 'background-color: ' . $Team_Skillcolor3 . ';';
							}
							$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname3 . '<span>(' . $Team_Skillvalue3 . '%)</span></div><div class="ts-skillbars-style1-skillbar" style="height: 5px;"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor3 . '" data-level="' . $Team_Skillvalue3 . '%" style="width: ' . $Team_Skillvalue3 . '%; ' . $skill_background . '"></div></div>';
						}
						if ((isset($Team_Skillname4)) && (isset($Team_Skillvalue4))) {
							$team_skills_count++;
							if (isset($Team_Skillcolor4)) {
								$skill_background = 'background-color: ' . $Team_Skillcolor4 . ';';
							}
							$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname4 . '<span>(' . $Team_Skillvalue4 . '%)</span></div><div class="ts-skillbars-style1-skillbar" style="height: 5px;"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor4 . '" data-level="' . $Team_Skillvalue4 . '%" style="width: ' . $Team_Skillvalue4 . '%; ' . $skill_background . '"></div></div>';
						}
						if ((isset($Team_Skillname5)) && (isset($Team_Skillvalue5))) {
							$team_skills_count++;
							if (isset($Team_Skillcolor5)) {
								$skill_background = 'background-color: ' . $Team_Skillcolor5 . ';';
							}
							$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname5 . '<span>(' . $Team_Skillvalue5 . '%)</span></div><div class="ts-skillbars-style1-skillbar" style="height: 5px;"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor5 . '" data-level="' . $Team_Skillvalue5 . '%" style="width: ' . $Team_Skillvalue5 . '%; ' . $skill_background . '"></div></div>';
						}
						if ((isset($Team_Skillname6)) && (isset($Team_Skillvalue6))) {
							$team_skills_count++;
							if (isset($Team_Skillcolor6)) {
								$skill_background = 'background-color: ' . $Team_Skillcolor6 . ';';
							}
							$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname6 . '<span>(' . $Team_Skillvalue6 . '%)</span></div><div class="ts-skillbars-style1-skillbar" style="height: 5px;"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor6 . '" data-level="' . $Team_Skillvalue6 . '%" style="width: ' . $Team_Skillvalue6 . '%; ' . $skill_background . '"></div></div>';
						}
					$team_skills		.= '</div>';
				}
				
				// Build Download Button
				$team_download 			= '';
				if ($show_download == "true") {
					if ((isset($Team_Buttonfile)) || ((isset($Team_Attachment)) && (!empty($Team_Attachment)))) {
						if (isset($Team_Buttonfile)) {
							$Team_File          = $Team_Buttonfile;
						} else {
							$Team_Attachment    = get_post_meta($Team_ID, 'ts_vcsc_team_basic_attachment', true);
							$Team_Attachment    = wp_get_attachment_url($Team_Attachment['id']);
							$Team_File          = $Team_Attachment;
						}
						$Team_FileFormat        = pathinfo($Team_File, PATHINFO_EXTENSION);
						if (isset($Team_Buttontype)) {
							$Team_Buttontype = $Team_Buttontype;
						} else {
							$Team_Buttontype = 'ts-button-3d';
						};
						if (!empty($Team_File)) {
							$team_download	.= '<div class="ts-teammate-download">';		
								if (isset($Team_Buttontooltip)) {
									if (((isset($Team_Buttonicon)) && ($Team_Buttonicon == "none")) || (!isset($Team_Buttonicon))) {
										$team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . ' ' . $team_tooltipclasses . '" data-format="' . $Team_FileFormat . '" data-tooltipster-text="' . $Team_Buttontooltip . '" ' . $team_tooltipcontent . ' href="' . $Team_File . '" target="_blank">' . $Team_Buttonlabel . '</a>';
									} else {
										$team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . ' ' . $team_tooltipclasses . '" data-format="' . $Team_FileFormat . '" data-tooltipster-text="' . $Team_Buttontooltip . '" ' . $team_tooltipcontent . ' href="' . $Team_File . '" target="_blank"><i class="ts-teamicon-' . $Team_Buttonicon . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Buttoncolor) ? "color: " . $Team_Buttoncolor . ":" : "") . '"></i> ' . $Team_Buttonlabel . '</a>';
									}                        
								} else {
									if (((isset($Team_Buttonicon)) && ($Team_Buttonicon == "none")) || (!isset($Team_Buttonicon))) {
										$team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . '" data-format="' . $Team_FileFormat . '" href="' . $Team_File . '" target="_blank">' . $Team_Buttonlabel . '</a>';
									} else {
										$team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . '" data-format="' . $Team_FileFormat . '" href="' . $Team_File . '" target="_blank"><i class="ts-teamicon-' . $Team_Buttonicon . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Buttoncolor) ? "color: " . $Team_Buttoncolor . ";" : "") . '"></i> ' . $Team_Buttonlabel . '</a>';
									}
								}						
							$team_download 	.= '</div>';
							if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
								wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
							}
						}
					}
				}
				
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 					= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-teammate ' . $animation_css . ' ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Team_Mates_Standalone', $atts);
				} else {
					$css_class					= 'ts-teammate ' . $animation_css . ' ' . $el_class;
				}
				
				// Grayscale Class
				if (($show_grayscale == "true") && ($grayscale_hover == "true")) {
					$grayscale_class	= 'ts-grayscale-hover';
				} else if (($show_grayscale == "true") && ($grayscale_hover == "false")) {
					$grayscale_class	= 'ts-grayscale-default';
				} else {
					$grayscale_class	= 'ts-grayscale-none';
				}			
				// Create Output
				if ($style == "style1") {
					$output .= '<div id="' . $team_block_id . '" class="ts-team1 ' . $css_class . ' ' . $grayscale_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						if (($show_image == "true") && (!empty($Team_Image))) {
							$output .= '<div class="team-avatar">';
								if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
									$output .= '<a class="ts-team-image-link" href="' . $Team_Dedicatedpage . '" target="' . $team_dedicated_target . '">';
								}
									$output .= '<img src="' . $Team_Image . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="' . $image_style . ' ' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '">';
								if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
									$output .= '</a>';
								}
							$output .= '</div>';
						}
						$output .= '<div class="team-user">';
							if (($show_title == "true") && (!empty($Team_Title))) {
								$output .= '<div class="team-title">' . $Team_Title . '</div>';
							}
							if (($show_title == "true") && (!empty($Team_Position))) {
								$output .= '<div class="team-job">' . $Team_Position . '</div>';
							}
							$output .= $team_dedicated;
							$output .= $team_download;
						$output .= '</div>';
						if (($show_content == "true") && (!empty($Team_Content))) {
							$output .= '<div class="team-information">';
								if (function_exists('wpb_js_remove_wpautop')){
									$output .= '' . wpb_js_remove_wpautop(do_shortcode($Team_Content), $wpautop) . '';
								} else {
									$output .= '' . do_shortcode($Team_Content) . '';
								}
							$output .= '</div>';
						}
						if ($team_contact_count > 0) {
							$output .= $team_contact;
						}
						if ($team_social_count > 0) {
							$output .= $team_social;
						}
						if ($team_opening_count > 0) {
							$output .= $team_opening;
						}
						if ($team_skills_count > 0) {
							$output .= $team_skills;
						}
					$output .= '</div>';
				}
				if ($style == "style2") {
					$output .= '<div id="' . $team_block_id . '" class="ts-team2 ' . $css_class . ' ' . $grayscale_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						$output .= '<div style="width: 25%; float: left;">';
							if (($show_image == "true") && (!empty($Team_Image))) {
								$output .= '<div class="ts-team2-header">';
									if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
										$output .= '<a class="ts-team-image-link" href="' . $Team_Dedicatedpage . '" target="' . $team_dedicated_target . '">';
									}
										$output .= '<img src="' . $Team_Image . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="' . $image_style . ' ' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '">';
									if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
										$output .= '</a>';
									}
								$output .= '</div>';
							}
							if ($team_social_count > 0) {
								$output .= '<div class="ts-team2-footer" style="' . (($show_image == "false") ? "margin-top: 0px;" : "") . '">';
									$output .= $team_social;
								$output .= '</div>';
							}
						$output .= '</div>';
						if (($show_image == "true") || ($team_social_count > 0)) {
							$output .= '<div class="ts-team2-content" style="">';
						} else {
							$output .= '<div class="ts-team2-content" style="width: 100%; margin-left: 0px;">';
						}
							$output .= '<div class="ts-team2-line"></div>';
							if (($show_title == "true") && (!empty($Team_Title))) {
								$output .= '<div class="ts-team2-name">' . $Team_Title . '</div>';
							}
							if (($show_title == "true") && (!empty($Team_Position))) {
								$output .= '<p class="ts-team2-lead">' . $Team_Position . '</p>';
							}
							if (($show_content == "true") && (!empty($Team_Content))) {
								if (function_exists('wpb_js_remove_wpautop')){
									$output .= '' . wpb_js_remove_wpautop(do_shortcode($Team_Content), $wpautop) . '';
								} else {
									$output .= '' . do_shortcode($Team_Content) . '';
								}
							}
						$output .= '</div>';
						$output .= $team_dedicated;
						$output .= $team_download;
						if ($team_contact_count > 0) {
							$output .= $team_contact;
						}
						if ($team_opening_count > 0) {
							$output .= $team_opening;
						}
						if ($team_skills_count > 0) {
							$output .= $team_skills;
						}
					$output .= '</div>';
				}
				if ($style == "style3") {
					$output .= '<div id="' . $team_block_id . '" class="ts-team3 ' . $css_class . ' ' . $grayscale_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						if (($show_image == "true") && (!empty($Team_Image))) {
							if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
								$output .= '<a class="ts-team-image-link" href="' . $Team_Dedicatedpage . '" target="' . $team_dedicated_target . '">';
							}
								$output .= '<img class="ts-team3-person-image ' . $image_style . ' ' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" src="' . $Team_Image . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="">';
							if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
								$output .= '</a>';
							}
						}
						if (($show_title == "true") && (!empty($Team_Title))) {
							$output .= '<div class="ts-team3-person-name">' . $Team_Title . '</div>';
						}
						if (($show_title == "true") && (!empty($Team_Position))) {
							$output .= '<div class="ts-team3-person-position">' . $Team_Position . '</div>';
						}
						if (($show_content == "true") && (!empty($Team_Content))) {
							if (function_exists('wpb_js_remove_wpautop')){
								$output .= '<div class="ts-team3-person-description">' . wpb_js_remove_wpautop(do_shortcode($Team_Content), $wpautop) . '</div>';
							} else {
								$output .= '<div class="ts-team3-person-description">' . do_shortcode($Team_Content) . '</div>';
							}
						}
							$output .= $team_dedicated;
							$output .= $team_download;
							if ($team_contact_count > 0) {
								$output .= $team_contact;
							}
							if ($team_social_count > 0) {
								$output .= $team_social;
							}
							if ($team_opening_count > 0) {
								$output .= $team_opening;
							}
							if ($team_skills_count > 0) {
								$output .= $team_skills;
							}
						$output .= '<div class="ts-team3-person-space"></div>';					
					$output .= '</div>';
				}
		
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
		
			// Single Teammate for Custom Slider
			function TS_VCSC_Team_Mates_Single ($atts, $content = null) {
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
				
				// Load Required Files
				wp_enqueue_script('ts-extend-krautlightbox');
				wp_enqueue_style('ts-extend-krautlightbox');
				wp_enqueue_style('ts-font-teammates');
				wp_enqueue_style('ts-extend-tooltipster');
				wp_enqueue_script('ts-extend-tooltipster');
				wp_enqueue_style('ts-extend-animations');
				wp_enqueue_style('ts-visual-composer-extend-front');
				wp_enqueue_script('ts-visual-composer-extend-front');
				
				extract( shortcode_atts( array(
					'team_member'					=> '',
					'custompost_name'				=> '',
					'style'							=> 'style1',
					'show_image'            		=> 'true',
					'image_style'					=> 'imagestyle1',
					'show_grayscale'        		=> 'true',
					'grayscale_hover'				=> 'true',
					'show_lightbox'         		=> 'true',
					'link_image'					=> 'false',
					'show_title'            		=> 'true',
					'show_content'          		=> 'true',
					'show_dedicated'        		=> 'false',
					'show_download'					=> 'true',
					'show_contact'					=> 'true',
					'show_opening'					=> 'true',
					'show_social'					=> 'true',
					'show_skills'					=> 'true',
					'bar_tooltip'					=> 'false',
					'icon_style' 					=> 'simple',
					'icon_color'					=> '#000000',
					'icon_background'				=> '#f5f5f5',
					'icon_frame_color'				=> '#f5f5f5',
					'icon_frame_thick'				=> 1,
					'icon_margin' 					=> 5,
					'icon_align'					=> 'left',
					'icon_hover'					=> '',
					'tooltip_style'					=> 'ts-simptip-style-black',
					'tooltip_position'				=> 'ts-simptip-position-top',
					'tooltip_animation'				=> 'swing',
					'tooltipster_offsetx'			=> 0,
					'tooltipster_offsety'			=> 0,
					'content_wpautop'				=> 'true',
					'el_id' 						=> '',
					'el_class'              		=> '',
					'css'							=> '',
				), $atts ));
				
				$output 							= '';
				$wpautop 							= ($content_wpautop == "true" ? true : false);
				
				// WPML ID Conversion
				$team_member 						= apply_filters('wpml_object_id', intval($team_member), 'ts_team');
				
				// Check for Teammate and End Shortcode if Empty
				if (empty($team_member)) {
					$output .= '<div style="text-align: justify; font-weight: bold; font-size: 14px; color: red;">Please select a teammate in the element settings!</div>';
					echo $output;
					$myvariable = ob_get_clean();
					return $myvariable;
				}
				
				// Check for Codestar Migration
				$codestarRetrieve					= "false";
				$codestarMigrated 					= get_post_meta($team_member, 'ts_vcsc_custompost_migrated', true);
				if (!empty($codestarMigrated)) {
					$codestarRetrieve				= "true";
				}
				
				// Check for Front End Editor
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$frontend_edit					= 'true';
				} else {
					$frontend_edit					= 'false';
				}
			
				$team_block_id					    = 'ts-vcsc-meet-team-' . mt_rand(999999, 9999999);
			
				$animation_css					    = '';
				
				// Tooltip Settings
				$tooltip_position					= TS_VCSC_TooltipMigratePosition($tooltip_position);
				$tooltip_style						= TS_VCSC_TooltipMigrateStyle($tooltip_style);
				$team_tooltipclasses				= "ts-has-tooltipster-tooltip";
				$team_tooltipcontent				= 'data-tooltipster-title="" data-tooltipster-image="" data-tooltipster-position="' . $tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $tooltip_style . '" data-tooltipster-animation="' . $tooltip_animation . '" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
			
				if ((empty($icon_background)) || ($icon_style == 'simple')) {
					$icon_frame_style				= '';
				} else {
					$icon_frame_style				= 'background: ' . $icon_background . ';';
				}
				
				if ($icon_frame_thick > 0) {
					$icon_top_adjust				= 'top: ' . (10 - $icon_frame_thick) . 'px;';
				} else {
					$icon_top_adjust				= '';
				}
				
				if ($icon_style == 'simple') {
					$icon_frame_border				= '';
				} else {
					$icon_frame_border				= ' border: ' . $icon_frame_thick . 'px solid ' . $icon_frame_color . ';';
				}
				
				$icon_horizontal_adjust				= '';
			
				$team_social 						= '';
				
				// WPML ID Conversion
				$team_member 						= TS_VCSC_WPMLConversionID($team_member, 'ts_team');
			
				// Retrieve Team Post Main Content
				$team_array							= array();
				$args = array(
					'p'								=> $team_member,
					'no_found_rows' 				=> 1,
					'ignore_sticky_posts' 			=> 1,
					'posts_per_page' 				=> 1,
					'post_type' 					=> 'ts_team',
					'post_status' 					=> 'publish',
					'orderby' 						=> 'title',
					'order' 						=> 'ASC',
				);
				$team_query 						= new WP_Query($args);
				if ($team_query->have_posts()) {
					foreach($team_query->posts as $p) {
						if ($p->ID == $team_member) {
							$team_data = array(
								'author'			=> $p->post_author,
								'name'				=> $p->post_name,
								'title'				=> $p->post_title,
								'id'				=> $p->ID,
								'content'			=> $p->post_content,
							);
							$team_array[] = $team_data;
						}
					}
				}
				wp_reset_postdata();
				
				if (count($team_array) == 0) {
					$output .= '<div style="text-align: justify; font-weight: bold; font-size: 14px; color: red;">Please check your teammate selection in the element settings as no teammate data could be found!</div>';
					echo $output;
					$myvariable = ob_get_clean();
					return $myvariable;
				}
				
				// Build Team Post Main Content
				foreach ($team_array as $index => $array) {
					$Team_Author					= $team_array[$index]['author'];
					$Team_Name 						= $team_array[$index]['name'];
					$Team_Title 					= $team_array[$index]['title'];
					$Team_ID 						= $team_array[$index]['id'];
					$Team_Content 					= $team_array[$index]['content'];
					$Team_Image						= wp_get_attachment_image_src(get_post_thumbnail_id($Team_ID), 'full');
					if ($Team_Image == false) {
						$Team_Image          		= TS_VCSC_GetResourceURL('images/defaults/default_person.jpg');
					} else {
						$Team_Image          		= $Team_Image[0];
					}
				}
				
				// Retrieve Team Post Meta Content
				if ($codestarRetrieve == "true") {
					$custom_fields 					= get_post_meta($Team_ID, 'ts_vcsc_team_information', true);
					$custom_fields_array			= array();
					foreach ($custom_fields as $field_key => $field_values) {
						if (strpos($field_key, 'ts_vcsc_team_') !== false) {
							$field_key_split 		= explode("_", $field_key);
							$field_key_length 		= count($field_key_split) - 1;
							$custom_data = array(
								'group'				=> $field_key_split[$field_key_length - 1],
								'name'				=> 'Team_' . ucfirst($field_key_split[$field_key_length]),
								'value'				=> $field_values,
							);
							$custom_fields_array[] 	= $custom_data;
						}
					}
					foreach ($custom_fields_array as $index => $array) {
						${$custom_fields_array[$index]['name']} = $custom_fields_array[$index]['value'];
					}
				} else {
					$custom_fields 					= get_post_custom($Team_ID);
					$custom_fields_array			= array();
					foreach ($custom_fields as $field_key => $field_values) {
						if (!isset($field_values[0])) continue;
						if (in_array($field_key, array("_edit_lock", "_edit_last"))) continue;
						if (strpos($field_key, 'ts_vcsc_team_') !== false) {
							$field_key_split 		= explode("_", $field_key);
							$field_key_length 		= count($field_key_split) - 1;
							$custom_data = array(
								'group'				=> $field_key_split[$field_key_length - 1],
								'name'				=> 'Team_' . ucfirst($field_key_split[$field_key_length]),
								'value'				=> $field_values[0],
							);
							$custom_fields_array[] = $custom_data;
						}
					}
					foreach ($custom_fields_array as $index => $array) {
						${$custom_fields_array[$index]['name']} = $custom_fields_array[$index]['value'];
					}
				}		
				if (isset($Team_Position)) {
					$Team_Position 					= $Team_Position;
				} else {
					$Team_Position 					= '';
				}
				if (isset($Team_Buttonlabel)) {
					$Team_Buttonlabel				= $Team_Buttonlabel;
				} else {
					$Team_Buttonlabel				= '';
				}
				
				// Build Dedicated Page Link
				$team_dedicated     = '';
				if ($show_dedicated == "true") {
					if ((isset($Team_Dedicatedpage)) && (($Team_Dedicatedpage != -1) || (($Team_Dedicatedpage == "external") && (isset($Team_Dedicatedlink))))) {
						if ($Team_Dedicatedpage == "external") {
							$Team_Dedicatedpage		= $Team_Dedicatedlink;
						} else {
							$Team_Dedicatedpage		= get_page_link($Team_Dedicatedpage);
						}
						if (isset($Team_Dedicatedtarget)) {
							$team_dedicated_target  = '_blank';
						} else {
							$team_dedicated_target  = '_parent';
						}
						$team_dedicated	.= '<div class="ts-teammate-dedicated">';
							if ((isset($Team_Dedicatedtooltip)) && ($Team_Dedicatedtooltip != "")) {
								if (((isset($Team_Dedicatedicon)) && ($Team_Dedicatedicon == "none")) || (!isset($Team_Dedicatedicon))) {
									$team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . ' ' . $team_tooltipclasses . '" data-tooltipster-text="' . $Team_Dedicatedtooltip . '"  ' . $team_tooltipcontent . ' href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '">' . $Team_Dedicatedlabel . '</a>';
								} else {
									$team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . ' ' . $team_tooltipclasses . '" data-tooltipster-text="' . $Team_Dedicatedtooltip . '"  ' . $team_tooltipcontent . ' href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '"><i class="ts-teamicon-' . $Team_Dedicatedicon . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Dedicatedcolor) ? "color: " . $Team_Dedicatedcolor . ";" : "") . '"></i> ' . $Team_Dedicatedlabel . '</a>';
								}                        
							} else {
								if (((isset($Team_Dedicatedicon)) && ($Team_Dedicatedicon == "none")) || (!isset($Team_Dedicatedicon))) {
									$team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . '" href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '">' . $Team_Dedicatedlabel . '</a>';
								} else {
									$team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . '" href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '"><i class="ts-teamicon-' . $Team_Dedicatedicon . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Dedicatedcolor) ? "color: " . $Team_Dedicatedcolor . ";" : "") . '"></i> ' . $Team_Dedicatedlabel . '</a>';
								}
							}
						$team_dedicated 	.= '</div>';
						if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
							wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
						}
					}
				} else if (($show_lightbox == "false") && ($link_image == "true")){
					if ((isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
						$Team_Dedicatedpage         = get_page_link($Team_Dedicatedpage);
						if (isset($Team_Dedicatedtarget)) {
							$team_dedicated_target  = '_blank';
						} else {
							$team_dedicated_target  = '_parent';
						}
					}
				}
				
				// Build Team Contact Information
				$team_contact		= '';
				$team_contact_count	= 0;
				if ($show_contact == "true") {
					$team_contact		.= '<div class="ts-team-contact">';
						if ((isset($Team_Email)) && (!empty($Team_Email))) {
							$team_contact_count++;
							if ((isset($Team_Emaillabel)) && (!empty($Team_Emaillabel))) {
								$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-email3 ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a target="_blank" class="" href="mailto:' . $Team_Email . '">' . $Team_Emaillabel . '</a></div>';
							} else {
								$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-email3 ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a target="_blank" class="" href="mailto:' . $Team_Email . '">' . $Team_Email . '</a></div>';
							}
						}
						if ((isset($Team_Phone)) && (!empty($Team_Phone))) {
							$team_contact_count++;
							$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-phone2 ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i>' . $Team_Phone . '</div>';
						}
						if ((isset($Team_Cell)) && (!empty($Team_Cell))) {
							$team_contact_count++;
							$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-mobile ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i>' . $Team_Cell . '</div>';
						}
						if ((isset($Team_Portfolio)) && (!empty($Team_Portfolio))) {
							$team_contact_count++;
							if ((isset($Team_Portfoliolabel)) && (!empty($Team_Portfoliolabel))) {
								$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-portfolio ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Portfolio) . '">' . $Team_Portfoliolabel . '</a></div>';
							} else {
								$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-portfolio ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Portfolio) . '">' . TS_VCSC_makeValidURL($Team_Portfolio) . '</a></div>';
							}
						}
						if ((isset($Team_Other)) && (!empty($Team_Other))) {
							$team_contact_count++;
							if ((isset($Team_Otherlabel)) && (!empty($Team_Otherlabel))) {
								$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-link ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Other) . '">' . $Team_Otherlabel . '</a></div>';
							} else {
								$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-link ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Other) . '">' . TS_VCSC_makeValidURL($Team_Other) . '</a></div>';
							}
						}
						if ((isset($Team_Skype)) && (!empty($Team_Skype))) {
							$team_contact_count++;
							$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-skype ts-font-icon ts-teammate-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i>' . $Team_Skype . '</div>';
						}
					$team_contact		.= '</div>';
				}
				
				// Build Opening / Contact Hours
				$team_opening			= '';
				$team_opening_count		= 0;
				if ($show_opening == "true") {
					$team_opening		.= '<div class="ts-team-opening-parent">';
						if ((isset($Team_Header)) && (!empty($Team_Header))) {
							if ($Team_Symbol == "none") {
								$team_opening .= '<div class="ts-team-opening-header">' . $Team_Header . '</div>';
							} else {
								$team_opening .= '<div class="ts-team-opening-header"><i class="ts-teamicon-' . $Team_Symbol . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Symbolcolor) ? "color: " . $Team_Symbolcolor . ";" : "") . '"></i>' . $Team_Header . '</div>';
							}
						}
						if ((isset($Team_Opening)) && ($Team_Opening != 'block') && (!empty($Team_Opening))) {
							$team_opening_count++;
							$team_opening .= '<div class="ts-team-opening-block">' . $Team_Opening . '</div>';
						}
					$team_opening		.= '</div>';
				}
				// Build Team Social Links
				$team_social 		= '';
				$team_social_count	= 0;
				if ($show_social == "true") {
					$team_social 		.= '<ul class="ts-teammate-icons ' . $icon_style . ' clearFixMe">';
						if ((isset($Team_Facebook)) && (!empty($Team_Facebook))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Facebook" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link facebook ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Facebook) . '"><i class="ts-teamicon-facebook1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Google)) && (!empty($Team_Google))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Google+" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link gplus ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Google) . '"><i class="ts-teamicon-googleplus1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Twitter)) && (!empty($Team_Twitter))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Twitter" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link twitter ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Twitter) . '"><i class="ts-teamicon-twitter1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Linkedin)) && (!empty($Team_Linkedin))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="LinkedIn" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link linkedin ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Linkedin) . '"><i class="ts-teamicon-linkedin ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Xing)) && (!empty($Team_Xing))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Xing" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link xing ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Xing) . '"><i class="ts-teamicon-xing3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Envato)) && (!empty($Team_Envato))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Envato" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link envato ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Envato) . '"><i class="ts-teamicon-envato ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Rss)) && (!empty($Team_Rss))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="RSS" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link rss ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Rss) . '"><i class="ts-teamicon-rss1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Forrst)) && (!empty($Team_Forrst))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Forrst" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link forrst ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Forrst) . '"><i class="ts-teamicon-forrst1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Flickr)) && (!empty($Team_Flickr))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Flickr" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link flickr ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Flickr) . '"><i class="ts-teamicon-flickr3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Instagram)) && (!empty($Team_Instagram))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Instagram" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link instagram ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Instagram) . '"><i class="ts-teamicon-instagram ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Picasa)) && (!empty($Team_Picasa))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Picasa" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link picasa ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Picasa) . '"><i class="ts-teamicon-picasa1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Pinterest)) && (!empty($Team_Pinterest))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Pinterest" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link pinterest ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Pinterest) . '"><i class="ts-teamicon-pinterest1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Vimeo)) && (!empty($Team_Vimeo))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Vimeo" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link vimeo ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Vimeo) . '"><i class="ts-teamicon-vimeo1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
						if ((isset($Team_Youtube)) && (!empty($Team_Youtube))) {
							$team_social_count++;
							$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="YouTube" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link youtube ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Youtube) . '"><i class="ts-teamicon-youtube1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
						}
					$team_social 		.= '</ul>';
				}
				
				// Build Team Skills
				$team_skills 				= '';
				$team_skills_count			= 0;
				if ((isset($Team_Skillset)) && ($show_skills == "true")) {
					$skill_background 		= '';
					if ($codestarRetrieve == "true") {
						$skill_entries		= $Team_Skillset;
					} else if (isset($Team_Skillset)) {
						$skill_entries		= get_post_meta($Team_ID, 'ts_vcsc_team_skills_skillset', true);
					} else {
						$skill_entries		= array();
					}
					if ((is_array($skill_entries)) && (!empty($skill_entries))) {
						$team_skills		.= '<div class="ts-teammate-member-skills">';
							foreach ((array) $skill_entries as $key => $entry) {
								$skill_name = $skill_value = $skill_color = '';
								if (isset($entry['skillname'])) {
									$skill_name      = esc_html($entry['skillname']);
								}
								if (isset($entry['skillvalue'])) {
									$skill_value     = esc_html($entry['skillvalue']);
								}
								if (isset($entry['skillcolor'])) {
									$skill_color     = esc_html($entry['skillcolor']);
								}
								if ((strlen($skill_name) != 0) && (strlen($skill_value) != 0)) {
									$team_skills_count++;
									if ((strlen($skill_color) != 0) && ($skill_color != '#')) {
										$skill_background = 'background-color: ' . $skill_color . ';';
									}
									$team_skills .= '<div class="ts-skillbars-style1-wrapper clearfix">';
										$team_skills .= '<div class="ts-skillbars-style1-name">' . $skill_name . '';
											if ($bar_tooltip == "false") {
												$team_skills .= '<span>(' . $skill_value . '%)</span>';
											}
										$team_skills .= '</div>';
										$team_skills .= '<div class="ts-skillbars-style1-skillbar" style="height: 5px; margin-bottom: 10px;"><div class="ts-skillbars-style1-value" data-color="' . $skill_color . '" data-level="' . $skill_value . '%" style="width: ' . $skill_value . '%; ' . $skill_background . '">';
											if ($bar_tooltip == "true") {
												$team_skills .= '<span class="ts-skillbars-style1-tooltip" style="padding: 2px 4px; font-size: 10px;">' . $skill_value . '%</span>';
											}
										$team_skills .= '</div></div>';
									$team_skills .= '</div>';
								}
							}
						$team_skills		.= '</div>';
					}
				} else if ((!isset($Team_Skillset)) && ($show_skills == "true")) {
					$skill_background 	= '';
					$team_skills		.= '<div class="ts-teammate-member-skills">';
						if ((isset($Team_Skillname1)) && (isset($Team_Skillvalue1))) {
							$team_skills_count++;
							if (isset($Team_Skillcolor1)) {
								$skill_background = 'background-color: ' . $Team_Skillcolor1 . ';';
							}
							$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname1 . '<span>(' . $Team_Skillvalue1 . '%)</span></div><div class="ts-skillbars-style1-skillbar"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor1 . '" data-level="' . $Team_Skillvalue1 . '%" style="width: ' . $Team_Skillvalue1 . '%; ' . $skill_background . '"></div></div>';
						}
						if ((isset($Team_Skillname2)) && (isset($Team_Skillvalue2))) {
							$team_skills_count++;
							if (isset($Team_Skillcolor2)) {
								$skill_background = 'background-color: ' . $Team_Skillcolor2 . ';';
							}
							$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname2 . '<span>(' . $Team_Skillvalue2 . '%)</span></div><div class="ts-skillbars-style1-skillbar"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor2 . '" data-level="' . $Team_Skillvalue2 . '%" style="width: ' . $Team_Skillvalue2 . '%; ' . $skill_background . '"></div></div>';
						}
						if ((isset($Team_Skillname3)) && (isset($Team_Skillvalue3))) {
							$team_skills_count++;
							if (isset($Team_Skillcolor3)) {
								$skill_background = 'background-color: ' . $Team_Skillcolor3 . ';';
							}
							$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname3 . '<span>(' . $Team_Skillvalue3 . '%)</span></div><div class="ts-skillbars-style1-skillbar"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor3 . '" data-level="' . $Team_Skillvalue3 . '%" style="width: ' . $Team_Skillvalue3 . '%; ' . $skill_background . '"></div></div>';
						}
						if ((isset($Team_Skillname4)) && (isset($Team_Skillvalue4))) {
							$team_skills_count++;
							if (isset($Team_Skillcolor4)) {
								$skill_background = 'background-color: ' . $Team_Skillcolor4 . ';';
							}
							$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname4 . '<span>(' . $Team_Skillvalue4 . '%)</span></div><div class="ts-skillbars-style1-skillbar"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor4 . '" data-level="' . $Team_Skillvalue4 . '%" style="width: ' . $Team_Skillvalue4 . '%; ' . $skill_background . '"></div></div>';
						}
						if ((isset($Team_Skillname5)) && (isset($Team_Skillvalue5))) {
							$team_skills_count++;
							if (isset($Team_Skillcolor5)) {
								$skill_background = 'background-color: ' . $Team_Skillcolor5 . ';';
							}
							$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname5 . '<span>(' . $Team_Skillvalue5 . '%)</span></div><div class="ts-skillbars-style1-skillbar"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor5 . '" data-level="' . $Team_Skillvalue5 . '%" style="width: ' . $Team_Skillvalue5 . '%; ' . $skill_background . '"></div></div>';
						}
						if ((isset($Team_Skillname6)) && (isset($Team_Skillvalue6))) {
							$team_skills_count++;
							if (isset($Team_Skillcolor6)) {
								$skill_background = 'background-color: ' . $Team_Skillcolor6 . ';';
							}
							$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname6 . '<span>(' . $Team_Skillvalue6 . '%)</span></div><div class="ts-skillbars-style1-skillbar"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor6 . '" data-level="' . $Team_Skillvalue6 . '%" style="width: ' . $Team_Skillvalue6 . '%; ' . $skill_background . '"></div></div>';
						}
					$team_skills		.= '</div>';
				}
				
				// Build Download Button
				$team_download 		= '';
				if ($show_download == "true") {
					if ((isset($Team_Buttonfile)) || (isset($Team_Attachment))) {
						if (isset($Team_Buttonfile)) {
							$Team_File          = $Team_Buttonfile;
						} else {
							$Team_Attachment    = get_post_meta($Team_ID, 'ts_vcsc_team_basic_attachment', true);
							$Team_Attachment    = wp_get_attachment_url($Team_Attachment['id']);
							$Team_File          = $Team_Attachment;
						}
						$Team_FileFormat        = pathinfo($Team_File, PATHINFO_EXTENSION);
						if (isset($Team_Buttontype)) {
							$Team_Buttontype = $Team_Buttontype;
						} else {
							$Team_Buttontype = 'ts-button-3d';
						};
						if (!empty($Team_File)) {
							$team_download	.= '<div class="ts-teammate-download">';
								if (isset($Team_Buttontooltip)) {
									if (((isset($Team_Buttonicon)) && ($Team_Buttonicon == "none")) || (!isset($Team_Buttonicon))) {
										$team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . ' ' . $team_tooltipclasses . '" data-format="' . $Team_FileFormat . '" data-tooltipster-text="' . $Team_Buttontooltip . '"  ' . $team_tooltipcontent . ' href="' . $Team_File . '" target="_blank">' . $Team_Buttonlabel . '</a>';
									} else {
										$team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . ' ' . $team_tooltipclasses . '" data-format="' . $Team_FileFormat . '" data-tooltipster-text="' . $Team_Buttontooltip . '"  ' . $team_tooltipcontent . ' href="' . $Team_File . '" target="_blank"><i class="ts-teamicon-' . $Team_Buttonicon . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Buttoncolor) ? "color: " . $Team_Buttoncolor . ":" : "") . '"></i> ' . $Team_Buttonlabel . '</a>';
									}                        
								} else {
									if (((isset($Team_Buttonicon)) && ($Team_Buttonicon == "none")) || (!isset($Team_Buttonicon))) {
										$team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . '" data-format="' . $Team_FileFormat . '" href="' . $Team_File . '" target="_blank">' . $Team_Buttonlabel . '</a>';
									} else {
										$team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . '" data-format="' . $Team_FileFormat . '" href="' . $Team_File . '" target="_blank"><i class="ts-teamicon-' . $Team_Buttonicon . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Buttoncolor) ? "color: " . $Team_Buttoncolor . ";" : "") . '"></i> ' . $Team_Buttonlabel . '</a>';
									}
								}
							$team_download 	.= '</div>';
							if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
								wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
							}
						}
					}
				}
	
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 	= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-teammate ' . $animation_css . ' ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Team_Mates_Single', $atts);
				} else {
					$css_class	= 'ts-teammate ' . $animation_css . ' ' . $el_class;
				}
				
				// Grayscale Class
				if (($show_grayscale == "true") && ($grayscale_hover == "true")) {
					$grayscale_class	= 'ts-grayscale-hover';
				} else if (($show_grayscale == "true") && ($grayscale_hover == "false")) {
					$grayscale_class	= 'ts-grayscale-default';
				} else {
					$grayscale_class	= 'ts-grayscale-none';
				}
				// Create Output
				if ($style == "style1") {
					$output .= '<div id="' . $team_block_id . '" class="ts-team1 ' . $css_class . ' ' . $grayscale_class . '" style="width: 95%;">';
						if (($show_image == "true") && (!empty($Team_Image))) {
							$output .= '<div class="team-avatar">';
								if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
									$output .= '<a class="ts-team-image-link" href="' . $Team_Dedicatedpage . '" target="' . $team_dedicated_target . '">';
								}
									$output .= '<img src="' . $Team_Image . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="' . $image_style . ' ' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '">';
								if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
									$output .= '</a>';
								}
							$output .= '</div>';
						}
						$output .= '<div class="team-user">';
							if (!empty($Team_Title)) {
								$output .= '<div class="team-title">' . $Team_Title . '</div>';
							}
							if (!empty($Team_Position)) {
								$output .= '<div class="team-job">' . $Team_Position . '</div>';
							}
							$output .= $team_dedicated;
							$output .= $team_download;
						$output .= '</div>';
						if (($show_content == "true") && (!empty($Team_Content))) {
							$output .= '<div class="team-information">';
								if (function_exists('wpb_js_remove_wpautop')){
									$output .= '' . wpb_js_remove_wpautop(do_shortcode($Team_Content), $wpautop) . '';
								} else {
									$output .= '' . do_shortcode($Team_Content) . '';
								}
							$output .= '</div>';
						}
						if ($team_contact_count > 0) {
							$output .= $team_contact;
						}
						if ($team_social_count > 0) {
							$output .= $team_social;
						}
						if ($team_opening_count > 0) {
							$output .= $team_opening;
						}
						if ($team_skills_count > 0) {
							$output .= $team_skills;
						}
					$output .= '</div>';
				}
				if ($style == "style2") {
					$output .= '<div id="' . $team_block_id . '" class="ts-team2 ' . $css_class . ' ' . $grayscale_class . '" style="width: 95%;">';
						$output .= '<div style="width: 25%; float: left;">';
							if (($show_image == "true") && (!empty($Team_Image))) {
								$output .= '<div class="ts-team2-header">';
									if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
										$output .= '<a class="ts-team-image-link" href="' . $Team_Dedicatedpage . '" target="' . $team_dedicated_target . '">';
									}
										$output .= '<img src="' . $Team_Image . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="' . $image_style . ' ' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '">';
									if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
										$output .= '</a>';
									}
								$output .= '</div>';
							}
							if ($team_social_count > 0) {
								if ($show_image == "true") {
									$output .= '<div class="ts-team2-footer" style="' . (($show_image == "false") ? "margin-top: 0px;" : "") . '">';
								} else {
									$output .= '<div class="ts-team2-footer" style="width: 100%; margin-top: 0px;">';
								}
									$output .= $team_social;
								$output .= '</div>';
							}
						$output .= '</div>';
						if (($show_image == "true") || ($team_social_count > 0)) {
							$output .= '<div class="ts-team2-content" style="">';
						} else {
							$output .= '<div class="ts-team2-content" style="width: 100%; margin-left: 0px;">';
						}
							$output .= '<div class="ts-team2-line"></div>';
							if (!empty($Team_Title)) {
								$output .= '<div class="ts-team2-name">' . $Team_Title . '</div>';
							}
							if (!empty($Team_Position)) {
								$output .= '<p class="ts-team2-lead">' . $Team_Position . '</p>';
							}
							if (($show_content == "true") && (!empty($Team_Content))) {
								if (function_exists('wpb_js_remove_wpautop')){
									$output .= '' . wpb_js_remove_wpautop(do_shortcode($Team_Content), $wpautop) . '';
								} else {
									$output .= '' . do_shortcode($Team_Content) . '';
								}
							}
						$output .= '</div>';
						$output .= $team_dedicated;
						$output .= $team_download;
						if ($team_contact_count > 0) {
							$output .= $team_contact;
						}
						if ($team_opening_count > 0) {
							$output .= $team_opening;
						}
						if ($team_skills_count > 0) {
							$output .= $team_skills;
						}
					$output .= '</div>';
				}
				if ($style == "style3") {
					$output .= '<div id="' . $team_block_id . '" class="ts-team3 ' . $css_class . ' ' . $grayscale_class . '" style="width: 95%;">';
						if (($show_image == "true") && (!empty($Team_Image))) {
							if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
								$output .= '<a class="ts-team-image-link" href="' . $Team_Dedicatedpage . '" target="' . $team_dedicated_target . '">';
							}
								$output .= '<img class="ts-team3-person-image ' . $image_style . ' ' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" src="' . $Team_Image . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="">';
							if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
								$output .= '</a>';
							}
						}
						if (!empty($Team_Title)) {
							$output .= '<div class="ts-team3-person-name">' . $Team_Title . '</div>';
						}
						if (!empty($Team_Position)) {
							$output .= '<div class="ts-team3-person-position">' . $Team_Position . '</div>';
						}
						if (($show_content == "true") && (!empty($Team_Content))) {
							if (function_exists('wpb_js_remove_wpautop')){
								$output .= '<div class="ts-team3-person-description">' . wpb_js_remove_wpautop(do_shortcode($Team_Content), $wpautop) . '</div>';
							} else {
								$output .= '<div class="ts-team3-person-description">' . do_shortcode($Team_Content) . '</div>';
							}
						}
							$output .= $team_dedicated;
							$output .= $team_download;
							if ($team_contact_count > 0) {
								$output .= $team_contact;
							}
							if ($team_social_count > 0) {
								$output .= $team_social;
							}
							if ($team_opening_count > 0) {
								$output .= $team_opening;
							}
							if ($team_skills_count > 0) {
								$output .= $team_skills;
							}
						$output .= '<div class="ts-team3-person-space" style="margin-bottom: 0;"></div>';					
					$output .= '</div>';
				}
		
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
				
			// Custom Teammate Slider
			function TS_VCSC_Team_Mates_Slider_Custom ($atts, $content = null){
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
	
				wp_enqueue_style('ts-extend-owlcarousel2');
				wp_enqueue_script('ts-extend-owlcarousel2');
				wp_enqueue_style('ts-font-ecommerce');
				wp_enqueue_style('ts-extend-animations');
				wp_enqueue_style('ts-visual-composer-extend-front');
				wp_enqueue_script('ts-visual-composer-extend-front');
				
				extract( shortcode_atts( array(
					'teammates_slide'				=> 1,
					'auto_height'                   => 'true',
					'page_rtl'						=> 'false',
					'auto_play'                     => 'false',
					'show_playpause'				=> 'true',
					'show_bar'                      => 'true',
					'bar_color'                     => '#dd3333',
					'show_speed'                    => 5000,
					'stop_hover'                    => 'true',
					'show_navigation'               => 'true',
					'show_dots'						=> 'true',
					'page_numbers'                  => 'false',
					'items_loop'					=> 'false',				
					'animation_in'					=> 'ts-viewport-css-flipInX',
					'animation_out'					=> 'ts-viewport-css-slideOutDown',
					'animation_mobile'				=> 'false',
					'content_wpautop'				=> 'true',
					'margin_top'                    => 0,
					'margin_bottom'                 => 0,
					'el_id' 						=> '',
					'el_class'              		=> '',
					'css'							=> '',
				), $atts ));
				
				$teammate_random                    = mt_rand(999999, 9999999);
				
				// Check for Front End Editor
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$slider_class					= 'owl-carousel2-edit';
					$slider_message					= '<div class="ts-composer-frontedit-message">' . __( 'The slider is currently viewed in front-end edit mode; slider features are disabled for performance and compatibility reasons.', "ts_visual_composer_extend" ) . '</div>';
					$product_style					= 'width: ' . (100 / $teammates_slide) . '%; height: 100%; float: left; margin: 0; padding: 0;';
					$frontend_edit					= 'true';
				} else {
					$slider_class					= 'ts-owlslider-parent owl-carousel2';
					$slider_message					= '';
					$product_style					= '';
					$frontend_edit					= 'false';
				}
				
				if (!empty($el_id)) {
					$teammate_slider_id			    = $el_id;
				} else {
					$teammate_slider_id			    = 'ts-vcsc-teammate-slider-' . $teammate_random;
				}
				
				$output 							= '';
				$wpautop 							= ($content_wpautop == "true" ? true : false);
				
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-teammates-slider ' . $slider_class . ' ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Team_Mates_Slider_Custom', $atts);
				} else {
					$css_class						= 'ts-teammates-slider ' . $slider_class . ' ' . $el_class;
				}
				
				$output .= '<div id="' . $teammate_slider_id . '-container" class="ts-teammates-slider-container" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					// Front-Edit Message
					if ($frontend_edit == "true") {
						$output .= $slider_message;
					}
					// Add Progressbar
					if (($auto_play == "true") && ($show_bar == "true") && ($frontend_edit == "false")) {
						$output .= '<div id="ts-owlslider-progressbar-' . $teammate_random . '" class="ts-owlslider-progressbar-holder" style=""><div class="ts-owlslider-progressbar" style="background: ' . $bar_color . '; height: 100%; width: 0%;"></div></div>';
					}
					// Add Navigation Controls
					if ($frontend_edit == "false") {
						$output .= '<div id="ts-owlslider-controls-' . $teammate_random . '" class="ts-owlslider-controls" style="' . (((($auto_play == "true") && ($show_playpause == "true"))  || ($show_navigation == "true")) ? "display: block;" : "display: none;") . '">';
							$output .= '<div id="ts-owlslider-controls-next-' . $teammate_random . '" style="' . (($show_navigation == "true") ? "display: block;" : "display: none;") . '" class="ts-owlslider-controls-next"><span class="ts-ecommerce-arrowright5"></span></div>';
							$output .= '<div id="ts-owlslider-controls-prev-' . $teammate_random . '" style="' . (($show_navigation == "true") ? "display: block;" : "display: none;") . '" class="ts-owlslider-controls-prev"><span class="ts-ecommerce-arrowleft5"></span></div>';
							if (($auto_play == "true") && ($show_playpause == "true")) {
								$output .= '<div id="ts-owlslider-controls-play-' . $teammate_random . '" class="ts-owlslider-controls-play active"><span class="ts-ecommerce-pause"></span></div>';
							}
						$output .= '</div>';
					}
					// Add Slider
					$output .= '<div id="' . $teammate_slider_id . '" class="' . $css_class . '" data-id="' . $teammate_random . '" data-items="' . $teammates_slide . '" data-rtl="' . $page_rtl . '" data-loop="' . $items_loop . '" data-navigation="' . $show_navigation . '" data-dots="' . $show_dots . '" data-mobile="' . $animation_mobile . '" data-animationin="' . $animation_in . '" data-animationout="' . $animation_out . '" data-height="' . $auto_height . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '">';
						if (function_exists('wpb_js_remove_wpautop')){
							$output .= wpb_js_remove_wpautop(do_shortcode($content), $wpautop);
						} else {
							$output .= do_shortcode($content);
						}
					$output .= '</div>';
				$output .= '</div>';
				
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
			// Category Teammate Slider
			function TS_VCSC_Team_Mates_Slider_Category ($atts, $content = null){
				global $VISUAL_COMPOSER_EXTENSIONS;
				ob_start();
	
				// Load Required Files
				wp_enqueue_script('ts-extend-krautlightbox');
				wp_enqueue_style('ts-extend-krautlightbox');
				wp_enqueue_style('ts-extend-owlcarousel2');
				wp_enqueue_script('ts-extend-owlcarousel2');
				wp_enqueue_style('ts-font-ecommerce');
				wp_enqueue_style('ts-font-teammates');
				wp_enqueue_style('ts-extend-animations');
				wp_enqueue_style('ts-visual-composer-extend-front');
				wp_enqueue_script('ts-visual-composer-extend-front');
				
				extract( shortcode_atts( array(
					'teammatecat'                   => '',
					'style'							=> 'style1',
					'show_image'                    => 'true',
					'image_style'					=> 'imagestyle1',
					'show_grayscale'                => 'true',
					'grayscale_hover'				=> 'true',
					'show_lightbox'                 => 'true',
					'link_image'					=> 'false',
					'show_title'                    => 'true',
					'show_content'                  => 'true',
					'show_dedicated'                => 'false',
					'show_download'			        => 'true',
					'show_contact'			        => 'true',
					'show_opening'					=> 'true',
					'show_social'			        => 'true',
					'show_skills'			        => 'true',
					'bar_tooltip'					=> 'false',
					'icon_style' 			        => 'simple',
					'icon_color'					=> '#000000',
					'icon_background'		        => '#f5f5f5',
					'icon_frame_color'		        => '#f5f5f5',
					'icon_frame_thick'		        => 1,
					'icon_margin' 			        => 5,
					'icon_align'			        => 'left',
					'icon_hover'			        => '',
					'tooltip_style'					=> 'ts-simptip-style-black',
					'tooltip_position'				=> 'ts-simptip-position-top',
					'tooltip_animation'				=> 'swing',
					'tooltipster_offsetx'			=> 0,
					'tooltipster_offsety'			=> 0,
					'teammates_slide'				=> 1,
					'auto_height'                   => 'true',
					'page_rtl'						=> 'false',
					'auto_play'                     => 'false',
					'show_playpause'				=> 'true',
					'show_bar'                      => 'true',
					'bar_color'                     => '#dd3333',
					'show_speed'                    => 5000,
					'stop_hover'                    => 'true',
					'show_navigation'               => 'true',
					'show_dots'						=> 'true',
					'page_numbers'                  => 'false',
					'items_loop'					=> 'false',				
					'animation_in'					=> 'ts-viewport-css-flipInX',
					'animation_out'					=> 'ts-viewport-css-slideOutDown',
					'animation_mobile'				=> 'false',
					'content_wpautop'				=> 'true',
					'margin_top'                    => 0,
					'margin_bottom'                 => 0,
					'el_id' 						=> '',
					'el_class'              		=> '',
					'css'							=> '',
				), $atts ));
				
				$teammate_random                    = mt_rand(999999, 9999999);
			
				$animation_css					    = '';
				
				// Tooltip Settings
				$tooltip_position					= TS_VCSC_TooltipMigratePosition($tooltip_position);
				$tooltip_style						= TS_VCSC_TooltipMigrateStyle($tooltip_style);
				$team_tooltipclasses				= "ts-has-tooltipster-tooltip";
				$team_tooltipcontent				= 'data-tooltipster-title="" data-tooltipster-image="" data-tooltipster-position="' . $tooltip_position . '" data-tooltipster-touch="false" data-tooltipster-arrow="true" data-tooltipster-theme="' . $tooltip_style . '" data-tooltipster-animation="' . $tooltip_animation . '" data-tooltipster-trigger="hover" data-tooltipster-offsetx="' . $tooltipster_offsetx . '" data-tooltipster-offsety="' . $tooltipster_offsety . '"';
			
	
				// Check for Front End Editor
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VCFrontEditMode == "true") {
					$slider_class					= 'owl-carousel2-edit';
					$slider_message					= '<div class="ts-composer-frontedit-message">' . __( 'The slider is currently viewed in front-end edit mode; slider features are disabled for performance and compatibility reasons.', "ts_visual_composer_extend" ) . '</div>';
					$product_style					= 'width: ' . (100 / $teammates_slide) . '%; height: 100%; float: left; margin: 0; padding: 0;';
					$frontend_edit					= 'true';
				} else {
					$slider_class					= 'ts-owlslider-parent owl-carousel2';
					$slider_message					= '';
					$product_style					= '';
					$frontend_edit					= 'false';
				}
				
				if (!empty($el_id)) {
					$teammate_slider_id			    = $el_id;
				} else {
					$teammate_slider_id			    = 'ts-vcsc-teammate-slider-' . $teammate_random;
				}
				
				if (!is_array($teammatecat)) {
					$teammatecat 				    = array_map('trim', explode(',', $teammatecat));
				}
				
				if ((empty($icon_background)) || ($icon_style == 'simple')) {
					$icon_frame_style				= '';
				} else {
					$icon_frame_style				= 'background: ' . $icon_background . ';';
				}
				
				if ($icon_frame_thick > 0) {
					$icon_top_adjust				= 'top: ' . (10 - $icon_frame_thick) . 'px;';
				} else {
					$icon_top_adjust				= '';
				}
				
				if ($icon_style == 'simple') {
					$icon_frame_border				= '';
				} else {
					$icon_frame_border				= ' border: ' . $icon_frame_thick . 'px solid ' . $icon_frame_color . ';';
				}
				
				$icon_horizontal_adjust				= '';
			
				$team_social 						= '';
				
				$output 							= '';
				$wpautop 							= ($content_wpautop == "true" ? true : false);
				
				// Retrieve Teammate Post Main Content
				$teammate_array					    = array();
				$category_fields 	                = array();
				$args = array(
					'no_found_rows' 				=> 1,
					'ignore_sticky_posts' 			=> 1,
					'posts_per_page' 				=> -1,
					'post_type' 					=> 'ts_team',
					'post_status' 					=> 'publish',
					'orderby' 						=> 'title',
					'order' 						=> 'ASC',
				);
				$teammate_query = new WP_Query($args);
				if ($teammate_query->have_posts()) {
					foreach($teammate_query->posts as $p) {
						$categories 				= TS_VCSC_GetTheCategoryByTax($p->ID, 'ts_team_category');
						if ($categories && !is_wp_error($categories)) {
							$category_slugs_arr     = array();
							$arrayMatch             = 0;
							foreach ($categories as $category) {
								if (in_array($category->slug, $teammatecat)) {
									$arrayMatch++;
								}
								$category_slugs_arr[] = $category->slug;
								$category_data = array(
									'slug'			=> $category->slug,
									'name'			=> $category->cat_name,
									'number'    	=> $category->term_id,
								);
								$category_fields[]  = $category_data;
							}
							$categories_slug_str    = join(",", $category_slugs_arr);
						} else {
							$category_slugs_arr     = array();
							$arrayMatch             = 0;
							if (in_array("ts-teammate-none-applied", $teammatecat)) {
								$arrayMatch++;
							}
							$category_slugs_arr[]   = '';
							$categories_slug_str    = join(",", $category_slugs_arr);
						}
						if ($arrayMatch > 0) {
							$teammate_data = array(
								'author'			=> $p->post_author,
								'name'				=> $p->post_name,
								'title'				=> $p->post_title,
								'id'				=> $p->ID,
								'content'			=> $p->post_content,
								'categories'        => $categories_slug_str,
							);
							$teammate_array[]       = $teammate_data;
						}
					}
				}
				wp_reset_postdata();
				
				if (function_exists('vc_shortcode_custom_css_class')) {
					$css_class 						= apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'ts-teammates-slider ' . $slider_class . ' ' . $el_class . ' ' . vc_shortcode_custom_css_class($css, ' '), 'TS_VCSC_Team_Mates_Slider_Category', $atts);
				} else {
					$css_class						= 'ts-teammates-slider ' . $slider_class . ' ' . $el_class;
				}
				
				$output .= '<div id="' . $teammate_slider_id . '-container" class="ts-teammates-slider-container" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					// Front-Edit Message
					if ($frontend_edit == "true") {
						$output .= $slider_message;
					}
					// Add Progressbar
					if (($auto_play == "true") && ($show_bar == "true") && ($frontend_edit == "false")) {
						$output .= '<div id="ts-owlslider-progressbar-' . $teammate_random . '" class="ts-owlslider-progressbar-holder" style=""><div class="ts-owlslider-progressbar" style="background: ' . $bar_color . '; height: 100%; width: 0%;"></div></div>';
					}
					// Add Navigation Controls
					if ($frontend_edit == "false") {
						$output .= '<div id="ts-owlslider-controls-' . $teammate_random . '" class="ts-owlslider-controls" style="' . (((($auto_play == "true") && ($show_playpause == "true"))  || ($show_navigation == "true")) ? "display: block;" : "display: none;") . '">';
							$output .= '<div id="ts-owlslider-controls-next-' . $teammate_random . '" style="' . (($show_navigation == "true") ? "display: block;" : "display: none;") . '" class="ts-owlslider-controls-next"><span class="ts-ecommerce-arrowright5"></span></div>';
							$output .= '<div id="ts-owlslider-controls-prev-' . $teammate_random . '" style="' . (($show_navigation == "true") ? "display: block;" : "display: none;") . '" class="ts-owlslider-controls-prev"><span class="ts-ecommerce-arrowleft5"></span></div>';
							if (($auto_play == "true") && ($show_playpause == "true"))  {
								$output .= '<div id="ts-owlslider-controls-play-' . $teammate_random . '" class="ts-owlslider-controls-play active"><span class="ts-ecommerce-pause"></span></div>';
							}
						$output .= '</div>';
					}
					// Add Slider
					$output .= '<div id="' . $teammate_slider_id . '" class="' . $css_class . '" data-id="' . $teammate_random . '" data-items="' . $teammates_slide . '" data-rtl="' . $page_rtl . '" data-loop="' . $items_loop . '" data-navigation="' . $show_navigation . '" data-dots="' . $show_dots . '" data-mobile="' . $animation_mobile . '" data-animationin="' . $animation_in . '" data-animationout="' . $animation_out . '" data-height="' . $auto_height . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '">';
						// Build Teammate Post Main Content
						foreach ($teammate_array as $index => $array) {
							$Team_Author			    		= $teammate_array[$index]['author'];
							$Team_Name 				    		= $teammate_array[$index]['name'];
							$Team_Title 			    		= $teammate_array[$index]['title'];
							$Team_ID 				    		= $teammate_array[$index]['id'];
							$Team_Content 			    		= $teammate_array[$index]['content'];
							$Team_Category 			    		= $teammate_array[$index]['categories'];
							$Team_Image				    		= wp_get_attachment_image_src(get_post_thumbnail_id($Team_ID), 'full');
							if ($Team_Image == false) {
								$Team_Image             		= TS_VCSC_GetResourceURL('images/defaults/default_person.jpg');
							} else {
								$Team_Image             		= $Team_Image[0];
							}
							
							// Check for Codestar Migration
							$codestarRetrieve					= "false";
							$codestarMigrated 					= get_post_meta($Team_ID, 'ts_vcsc_custompost_migrated', true);
							if (!empty($codestarMigrated)) {
								$codestarRetrieve				= "true";
							}
			 
							// Retrieve Teammate Post Meta Content
							if ($codestarRetrieve == "true") {
								$custom_fields 					= get_post_meta($Team_ID, 'ts_vcsc_team_information', true);
								$custom_fields_array			= array();
								foreach ($custom_fields as $field_key => $field_values) {
									if (strpos($field_key, 'ts_vcsc_team_') !== false) {
										$field_key_split 		= explode("_", $field_key);
										$field_key_length 		= count($field_key_split) - 1;
										$custom_data = array(
											'group'				=> $field_key_split[$field_key_length - 1],
											'name'				=> 'Team_' . ucfirst($field_key_split[$field_key_length]),
											'value'				=> $field_values,
										);
										$custom_fields_array[] 	= $custom_data;
									}
								}
								foreach ($custom_fields_array as $index => $array) {
									${$custom_fields_array[$index]['name']} = $custom_fields_array[$index]['value'];
								}
							} else {
								$custom_fields 					= get_post_custom($Team_ID);
								$custom_fields_array			= array();
								foreach ($custom_fields as $field_key => $field_values) {
									if (!isset($field_values[0])) continue;
									if (in_array($field_key, array("_edit_lock", "_edit_last"))) continue;
									if (strpos($field_key, 'ts_vcsc_team_') !== false) {
										$field_key_split 		= explode("_", $field_key);
										$field_key_length 		= count($field_key_split) - 1;
										$custom_data = array(
											'group'				=> $field_key_split[$field_key_length - 1],
											'name'				=> 'Team_' . ucfirst($field_key_split[$field_key_length]),
											'value'				=> $field_values[0],
										);
										$custom_fields_array[] = $custom_data;
									}
								}
								foreach ($custom_fields_array as $index => $array) {
									${$custom_fields_array[$index]['name']} = $custom_fields_array[$index]['value'];
								}
							}
							if (isset($Team_Position)) {
								$Team_Position 					= $Team_Position;
							} else {
								$Team_Position 					= '';
							}
							if (isset($Team_Buttonlabel)) {
								$Team_Buttonlabel				= $Team_Buttonlabel;
							} else {
								$Team_Buttonlabel				= '';
							}
							
							// Build Dedicated Page Link
							$team_dedicated     = '';
							if ($show_dedicated == "true") {
								if ((isset($Team_Dedicatedpage)) && (($Team_Dedicatedpage != -1) || (($Team_Dedicatedpage == "external") && (isset($Team_Dedicatedlink))))) {
									if ($Team_Dedicatedpage == "external") {
										$Team_Dedicatedpage		= $Team_Dedicatedlink;
									} else {
										$Team_Dedicatedpage		= get_page_link($Team_Dedicatedpage);
									}
									if (isset($Team_Dedicatedtarget)) {
										$team_dedicated_target  = '_blank';
									} else {
										$team_dedicated_target  = '_parent';
									}
									$team_dedicated	.= '<div class="ts-teammate-dedicated">';
										if (isset($Team_Dedicatedtooltip)) {
											if (((isset($Team_Dedicatedicon)) && ($Team_Dedicatedicon == "none")) || (!isset($Team_Dedicatedicon))) {
												$team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . ' ' . $team_tooltipclasses . '" data-tooltipster-text="' . $Team_Dedicatedtooltip . '"  ' . $team_tooltipcontent . ' href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '">' . $Team_Dedicatedlabel . '</a>';
											} else {
												$team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . ' ' . $team_tooltipclasses . '" data-tooltipster-text="' . $Team_Dedicatedtooltip . '"  ' . $team_tooltipcontent . ' href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '"><i class="ts-teamicon-' . $Team_Dedicatedicon . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Dedicatedcolor) ? "color: " . $Team_Dedicatedcolor . ";" : "") . '"></i> ' . $Team_Dedicatedlabel . '</a>';
											}                        
										} else {
											if (((isset($Team_Dedicatedicon)) && ($Team_Dedicatedicon == "none")) || (!isset($Team_Dedicatedicon))) {
												$team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . '" href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '">' . $Team_Dedicatedlabel . '</a>';
											} else {
												$team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . '" href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '"><i class="ts-teamicon-' . $Team_Dedicatedicon . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Dedicatedcolor) ? "color: " . $Team_Dedicatedcolor . ";" : "") . '"></i> ' . $Team_Dedicatedlabel . '</a>';
											}
										}
									$team_dedicated 	.= '</div>';
									if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
										wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
									}
								}
							} else if (($show_lightbox == "false") && ($link_image == "true")){
								if ((isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
									$Team_Dedicatedpage         = get_page_link($Team_Dedicatedpage);
									if (isset($Team_Dedicatedtarget)) {
										$team_dedicated_target  = '_blank';
									} else {
										$team_dedicated_target  = '_parent';
									}
								}
							}
							
							// Build Team Contact Information
							$team_contact		                = '';
							$team_contact_count	                = 0;
							if ($show_contact == "true") {
								$team_contact		.= '<div class="ts-team-contact">';
									if ((isset($Team_Email)) && (!empty($Team_Email))) {
										$team_contact_count++;
										if ((isset($Team_Emaillabel)) && (!empty($Team_Emaillabel))) {
											$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-email3 ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a target="_blank" class="" href="mailto:' . $Team_Email . '">' . $Team_Emaillabel . '</a></div>';
										} else {
											$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-email3 ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a target="_blank" class="" href="mailto:' . $Team_Email . '">' . $Team_Email . '</a></div>';
										}
									}
									if ((isset($Team_Phone)) && (!empty($Team_Phone))) {
										$team_contact_count++;
										$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-phone2 ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i>' . $Team_Phone . '</div>';
									}
									if ((isset($Team_Cell)) && (!empty($Team_Cell))) {
										$team_contact_count++;
										$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-mobile ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i>' . $Team_Cell . '</div>';
									}
									if ((isset($Team_Portfolio)) && (!empty($Team_Portfolio))) {
										$team_contact_count++;
										if ((isset($Team_Portfoliolabel)) && (!empty($Team_Portfoliolabel))) {
											$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-portfolio ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Portfolio) . '">' . $Team_Portfoliolabel . '</a></div>';
										} else {
											$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-portfolio ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Portfolio) . '">' . TS_VCSC_makeValidURL($Team_Portfolio) . '</a></div>';
										}
									}
									if ((isset($Team_Other)) && (!empty($Team_Other))) {
										$team_contact_count++;
										if ((isset($Team_Otherlabel)) && (!empty($Team_Otherlabel))) {
											$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-link ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Other) . '">' . $Team_Otherlabel . '</a></div>';
										} else {
											$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-link ts-font-icon ts-teammate-icon" style="color: ' . $icon_color . ';"></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Other) . '">' . TS_VCSC_makeValidURL($Team_Other) . '</a></div>';
										}
									}
									if ((isset($Team_Skype)) && (!empty($Team_Skype))) {
										$team_contact_count++;
										$team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-skype ts-font-icon ts-teammate-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i>' . $Team_Skype . '</div>';
									}
								$team_contact		.= '</div>';
							}
							
							// Build Opening / Contact Hours
							$team_opening						= '';
							$team_opening_count					= 0;
							if ($show_opening == "true") {
								$team_opening		.= '<div class="ts-team-opening-parent">';
									if ((isset($Team_Header)) && (!empty($Team_Header))) {
										if ($Team_Symbol == "none") {
											$team_opening .= '<div class="ts-team-opening-header">' . $Team_Header . '</div>';
										} else {
											$team_opening .= '<div class="ts-team-opening-header"><i class="ts-teamicon-' . $Team_Symbol . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Symbolcolor) ? "color: " . $Team_Symbolcolor . ";" : "") . '"></i>' . $Team_Header . '</div>';
										}
									}
									if ((isset($Team_Opening)) && ($Team_Opening != 'block') && (!empty($Team_Opening))) {
										$team_opening_count++;
										$team_opening .= '<div class="ts-team-opening-block">' . $Team_Opening . '</div>';
									}
								$team_opening		.= '</div>';
							}
							// Build Team Social Links
							$team_social 		                = '';
							$team_social_count	                = 0;
							if ($show_social == "true") {
								$team_social 		.= '<ul class="ts-teammate-icons ' . $icon_style . ' clearFixMe">';
									if ((isset($Team_Facebook)) && (!empty($Team_Facebook))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Facebook" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link facebook ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Facebook) . '"><i class="ts-teamicon-facebook1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
									if ((isset($Team_Google)) && (!empty($Team_Google))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Google+" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link gplus ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Google) . '"><i class="ts-teamicon-googleplus1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
									if ((isset($Team_Twitter)) && (!empty($Team_Twitter))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Twitter" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link twitter ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Twitter) . '"><i class="ts-teamicon-twitter1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
									if ((isset($Team_Linkedin)) && (!empty($Team_Linkedin))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="LinkedIn" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link linkedin ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Linkedin) . '"><i class="ts-teamicon-linkedin ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
									if ((isset($Team_Xing)) && (!empty($Team_Xing))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Xing" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link xing ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Xing) . '"><i class="ts-teamicon-xing3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
									if ((isset($Team_Envato)) && (!empty($Team_Envato))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Envato" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link envato ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Envato) . '"><i class="ts-teamicon-envato ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
									if ((isset($Team_Rss)) && (!empty($Team_Rss))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="RSS" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link rss ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Rss) . '"><i class="ts-teamicon-rss1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
									if ((isset($Team_Forrst)) && (!empty($Team_Forrst))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Forrst" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link forrst ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Forrst) . '"><i class="ts-teamicon-forrst1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
									if ((isset($Team_Flickr)) && (!empty($Team_Flickr))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Flickr" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link flickr ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Flickr) . '"><i class="ts-teamicon-flickr3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
									if ((isset($Team_Instagram)) && (!empty($Team_Instagram))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Instagram" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link instagram ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Instagram) . '"><i class="ts-teamicon-instagram ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
									if ((isset($Team_Picasa)) && (!empty($Team_Picasa))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Picasa" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link picasa ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Picasa) . '"><i class="ts-teamicon-picasa1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
									if ((isset($Team_Pinterest)) && (!empty($Team_Pinterest))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Pinterest" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link pinterest ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Pinterest) . '"><i class="ts-teamicon-pinterest1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
									if ((isset($Team_Vimeo)) && (!empty($Team_Vimeo))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="Vimeo" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link vimeo ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Vimeo) . '"><i class="ts-teamicon-vimeo1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
									if ((isset($Team_Youtube)) && (!empty($Team_Youtube))) {
										$team_social_count++;
										$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltipster-text="YouTube" ' . $team_tooltipcontent . '><a style="" target="_blank" class="ts-teammate-link youtube ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Youtube) . '"><i class="ts-teamicon-youtube1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
									}
								$team_social 		.= '</ul>';
							}
							
							// Build Team Skills
							$team_skills 		= '';
							$team_skills_count	= 0;
							if ((isset($Team_Skillset)) && ($show_skills == "true")) {
								$skill_background 		= '';
								if ($codestarRetrieve == "true") {
									$skill_entries		= $Team_Skillset;
								} else if (isset($Team_Skillset)) {
									$skill_entries		= get_post_meta($Team_ID, 'ts_vcsc_team_skills_skillset', true);
								} else {
									$skill_entries		= array();
								}
								if ((is_array($skill_entries)) && (!empty($skill_entries))) {
									$team_skills		.= '<div class="ts-teammate-member-skills">';
										foreach ((array) $skill_entries as $key => $entry) {
											$skill_name = $skill_value = $skill_color = '';
											if (isset($entry['skillname'])) {
												$skill_name      = esc_html($entry['skillname']);
											}
											if (isset($entry['skillvalue'])) {
												$skill_value     = esc_html($entry['skillvalue']);
											}
											if (isset($entry['skillcolor'])) {
												$skill_color     = esc_html($entry['skillcolor']);
											}
											if ((strlen($skill_name) != 0) && (strlen($skill_value) != 0)) {
												$team_skills_count++;
												if ((strlen($skill_color) != 0) && ($skill_color != '#')) {
													$skill_background = 'background-color: ' . $skill_color . ';';
												}
												$team_skills .= '<div class="ts-skillbars-style1-wrapper clearfix">';
													$team_skills .= '<div class="ts-skillbars-style1-name">' . $skill_name . '';
														if ($bar_tooltip == "false") {
															$team_skills .= '<span>(' . $skill_value . '%)</span>';
														}
													$team_skills .= '</div>';
													$team_skills .= '<div class="ts-skillbars-style1-skillbar" style="height: 5px; margin-bottom: 10px;"><div class="ts-skillbars-style1-value" data-color="' . $skill_color . '" data-level="' . $skill_value . '%" style="width: ' . $skill_value . '%; ' . $skill_background . '">';
														if ($bar_tooltip == "true") {
															$team_skills .= '<span class="ts-skillbars-style1-tooltip" style="padding: 2px 4px; font-size: 10px;">' . $skill_value . '%</span>';
														}
													$team_skills .= '</div></div>';
												$team_skills .= '</div>';
											}
										}
									$team_skills		.= '</div>';
								}
							} else if ((!isset($Team_Skillset)) && ($show_skills == "true")) {
								$skill_background 	= '';
								$team_skills		.= '<div class="ts-teammate-member-skills">';
									if ((isset($Team_Skillname1)) && (isset($Team_Skillvalue1))) {
										$team_skills_count++;
										if (isset($Team_Skillcolor1)) {
											$skill_background = 'background-color: ' . $Team_Skillcolor1 . ';';
										}
										$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname1 . '<span>(' . $Team_Skillvalue1 . '%)</span></div><div class="ts-skillbars-style1-skillbar"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor1 . '" data-level="' . $Team_Skillvalue1 . '%" style="width: ' . $Team_Skillvalue1 . '%; ' . $skill_background . '"></div></div>';
									}
									if ((isset($Team_Skillname2)) && (isset($Team_Skillvalue2))) {
										$team_skills_count++;
										if (isset($Team_Skillcolor2)) {
											$skill_background = 'background-color: ' . $Team_Skillcolor2 . ';';
										}
										$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname2 . '<span>(' . $Team_Skillvalue2 . '%)</span></div><div class="ts-skillbars-style1-skillbar"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor2 . '" data-level="' . $Team_Skillvalue2 . '%" style="width: ' . $Team_Skillvalue2 . '%; ' . $skill_background . '"></div></div>';
									}
									if ((isset($Team_Skillname3)) && (isset($Team_Skillvalue3))) {
										$team_skills_count++;
										if (isset($Team_Skillcolor3)) {
											$skill_background = 'background-color: ' . $Team_Skillcolor3 . ';';
										}
										$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname3 . '<span>(' . $Team_Skillvalue3 . '%)</span></div><div class="ts-skillbars-style1-skillbar"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor3 . '" data-level="' . $Team_Skillvalue3 . '%" style="width: ' . $Team_Skillvalue3 . '%; ' . $skill_background . '"></div></div>';
									}
									if ((isset($Team_Skillname4)) && (isset($Team_Skillvalue4))) {
										$team_skills_count++;
										if (isset($Team_Skillcolor4)) {
											$skill_background = 'background-color: ' . $Team_Skillcolor4 . ';';
										}
										$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname4 . '<span>(' . $Team_Skillvalue4 . '%)</span></div><div class="ts-skillbars-style1-skillbar"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor4 . '" data-level="' . $Team_Skillvalue4 . '%" style="width: ' . $Team_Skillvalue4 . '%; ' . $skill_background . '"></div></div>';
									}
									if ((isset($Team_Skillname5)) && (isset($Team_Skillvalue5))) {
										$team_skills_count++;
										if (isset($Team_Skillcolor5)) {
											$skill_background = 'background-color: ' . $Team_Skillcolor5 . ';';
										}
										$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname5 . '<span>(' . $Team_Skillvalue5 . '%)</span></div><div class="ts-skillbars-style1-skillbar"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor5 . '" data-level="' . $Team_Skillvalue5 . '%" style="width: ' . $Team_Skillvalue5 . '%; ' . $skill_background . '"></div></div>';
									}
									if ((isset($Team_Skillname6)) && (isset($Team_Skillvalue6))) {
										$team_skills_count++;
										if (isset($Team_Skillcolor6)) {
											$skill_background = 'background-color: ' . $Team_Skillcolor6 . ';';
										}
										$team_skills .= '<div class="ts-skillbars-style1-name">' . $Team_Skillname6 . '<span>(' . $Team_Skillvalue6 . '%)</span></div><div class="ts-skillbars-style1-skillbar"><div class="ts-skillbars-style1-value" data-color="' . $Team_Skillcolor6 . '" data-level="' . $Team_Skillvalue6 . '%" style="width: ' . $Team_Skillvalue6 . '%; ' . $skill_background . '"></div></div>';
									}
								$team_skills		.= '</div>';
							}
							
							// Build Download Button
							$team_download 		= '';
							if ($show_download == "true") {
								if ((isset($Team_Buttonfile)) || (isset($Team_Attachment))) {
									if (isset($Team_Buttonfile)) {
										$Team_File          = $Team_Buttonfile;
									} else {
										$Team_Attachment    = get_post_meta($Team_ID, 'ts_vcsc_team_basic_attachment', true);
										$Team_Attachment    = wp_get_attachment_url($Team_Attachment['id']);
										$Team_File          = $Team_Attachment;
									}
									$Team_FileFormat        = pathinfo($Team_File, PATHINFO_EXTENSION);
									if (isset($Team_Buttontype)) {
										$Team_Buttontype = $Team_Buttontype;
									} else {
										$Team_Buttontype = 'ts-button-3d';
									};
									if (!empty($Team_File)) {
										$team_download	.= '<div class="ts-teammate-download">';
											if (isset($Team_Buttontooltip)) {
												if (((isset($Team_Buttonicon)) && ($Team_Buttonicon == "none")) || (!isset($Team_Buttonicon))) {
													$team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . ' ' . $team_tooltipclasses . '" data-format="' . $Team_FileFormat . '" data-tooltipster-text="' . $Team_Buttontooltip . '"  ' . $team_tooltipcontent . ' href="' . $Team_File . '" target="_blank">' . $Team_Buttonlabel . '</a>';
												} else {
													$team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . ' ' . $team_tooltipclasses . '" data-format="' . $Team_FileFormat . '" data-tooltipster-text="' . $Team_Buttontooltip . '"  ' . $team_tooltipcontent . ' href="' . $Team_File . '" target="_blank"><i class="ts-teamicon-' . $Team_Buttonicon . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Buttoncolor) ? "color: " . $Team_Buttoncolor . ":" : "") . '"></i> ' . $Team_Buttonlabel . '</a>';
												}                        
											} else {
												if (((isset($Team_Buttonicon)) && ($Team_Buttonicon == "none")) || (!isset($Team_Buttonicon))) {
													$team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . '" data-format="' . $Team_FileFormat . '" href="' . $Team_File . '" target="_blank">' . $Team_Buttonlabel . '</a>';
												} else {
													$team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . '" data-format="' . $Team_FileFormat . '" href="' . $Team_File . '" target="_blank"><i class="ts-teamicon-' . $Team_Buttonicon . ' ts-font-icon ts-teammate-icon" style="' . (isset($Team_Buttoncolor) ? "color: " . $Team_Buttoncolor . ";" : "") . '"></i> ' . $Team_Buttonlabel . '</a>';
												}
											}	
										$team_download 	.= '</div>';
										if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
											wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
										}
									}
								}
							}
					
							// Grayscale Class
							if (($show_grayscale == "true") && ($grayscale_hover == "true")) {
								$grayscale_class	= 'ts-grayscale-hover';
							} else if (($show_grayscale == "true") && ($grayscale_hover == "false")) {
								$grayscale_class	= 'ts-grayscale-default';
							} else {
								$grayscale_class	= 'ts-grayscale-none';
							}
							// Create Output
							if ($style == "style1") {
								$output .= '<div class="ts-team1 ts-teammate ' . $grayscale_class . '" style="width: 95%; margin: 0 auto;">';
									if (($show_image == "true") && (!empty($Team_Image))) {
										$output .= '<div class="team-avatar">';
											if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
												$output .= '<a class="ts-team-image-link" href="' . $Team_Dedicatedpage . '" target="' . $team_dedicated_target . '">';
											}
												$output .= '<img src="' . $Team_Image . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="' . $image_style . ' ' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '">';
											if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
												$output .= '</a>';
											}
										$output .= '</div>';
									}
									$output .= '<div class="team-user">';
										if (!empty($Team_Title)) {
											$output .= '<div class="team-title">' . $Team_Title . '</div>';
										}
										if (!empty($Team_Position)) {
											$output .= '<div class="team-job">' . $Team_Position . '</div>';
										}
										$output .= $team_dedicated;
										$output .= $team_download;
									$output .= '</div>';
									if (($show_content == "true") && (!empty($Team_Content))) {
										$output .= '<div class="team-information">';
											if (function_exists('wpb_js_remove_wpautop')){
												$output .= '' . wpb_js_remove_wpautop(do_shortcode($Team_Content), $wpautop) . '';
											} else {
												$output .= '' . do_shortcode($Team_Content) . '';
											}
										$output .= '</div>';
									}
									if ($team_contact_count > 0) {
										$output .= $team_contact;
									}
									if ($team_social_count > 0) {
										$output .= $team_social;
									}
									if ($team_opening_count > 0) {
										$output .= $team_opening;
									}
									if ($team_skills_count > 0) {
										$output .= $team_skills;
									}
								$output .= '</div>';
							}
							if ($style == "style2") {
								$output .= '<div class="ts-team2 ts-teammate ' . $grayscale_class . '" style="width: 95%; margin: 0 auto;">';
								$output .= '<div style="width: 25%; float: left;">';
									if (($show_image == "true") && (!empty($Team_Image))) {
										$output .= '<div class="ts-team2-header">';
											if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
												$output .= '<a class="ts-team-image-link" href="' . $Team_Dedicatedpage . '" target="' . $team_dedicated_target . '">';
											}
												$output .= '<img src="' . $Team_Image . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="' . $image_style . ' ' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '">';
											if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
												$output .= '</a>';
											}
										$output .= '</div>';
									}
									if ($team_social_count > 0) {
										if ($show_image == "true") {
											$output .= '<div class="ts-team2-footer" style="' . (($show_image == "false") ? "margin-top: 0px;" : "") . '">';
										} else {
											$output .= '<div class="ts-team2-footer" style="width: 100%; margin-top: 0px;">';
										}
											$output .= $team_social;
										$output .= '</div>';
									}
								$output .= '</div>';
									if (($show_image == "true") || ($team_social_count > 0)) {
										$output .= '<div class="ts-team2-content" style="">';
									} else {
										$output .= '<div class="ts-team2-content" style="width: 100%; margin-left: 0px;">';
									}
										$output .= '<div class="ts-team2-line"></div>';
										if (!empty($Team_Title)) {
											$output .= '<div class="ts-team2-name">' . $Team_Title . '</div>';
										}
										if (!empty($Team_Position)) {
											$output .= '<p class="ts-team2-lead">' . $Team_Position . '</p>';
										}
										if (($show_content == "true") && (!empty($Team_Content))) {
											if (function_exists('wpb_js_remove_wpautop')){
												$output .= '' . wpb_js_remove_wpautop(do_shortcode($Team_Content), $wpautop) . '';
											} else {
												$output .= '' . do_shortcode($Team_Content) . '';
											}
										}
									$output .= '</div>';
									$output .= $team_dedicated;
									$output .= $team_download;
									if ($team_contact_count > 0) {
										$output .= $team_contact;
									}
									if ($team_opening_count > 0) {
										$output .= $team_opening;
									}
									if ($team_skills_count > 0) {
										$output .= $team_skills;
									}
								$output .= '</div>';
							}
							if ($style == "style3") {
								$output .= '<div class="ts-team3 ts-teammate ' . $grayscale_class . '" style="width: 95%; margin: 0 auto;">';
									if (($show_image == "true") && (!empty($Team_Image))) {
										if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
											$output .= '<a class="ts-team-image-link" href="' . $Team_Dedicatedpage . '" target="' . $team_dedicated_target . '">';
										}
											$output .= '<img class="ts-team3-person-image ' . $image_style . ' ' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" src="' . $Team_Image . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="">';
										if (($show_lightbox == "false") && ($link_image == "true") && (isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
											$output .= '</a>';
										}
									}
									if (!empty($Team_Title)) {
										$output .= '<div class="ts-team3-person-name">' . $Team_Title . '</div>';
									}
									if (!empty($Team_Position)) {
										$output .= '<div class="ts-team3-person-position">' . $Team_Position . '</div>';
									}
									if (($show_content == "true") && (!empty($Team_Content))) {
										if (function_exists('wpb_js_remove_wpautop')){
											$output .= '<div class="ts-team3-person-description">' . wpb_js_remove_wpautop(do_shortcode($Team_Content), $wpautop) . '</div>';
										} else {
											$output .= '<div class="ts-team3-person-description">' . do_shortcode($Team_Content) . '</div>';
										}
									}
										$output .= $team_dedicated;
										$output .= $team_download;
										if ($team_contact_count > 0) {
											$output .= $team_contact;
										}
										if ($team_social_count > 0) {
											$output .= $team_social;
										}
										if ($team_opening_count > 0) {
											$output .= $team_opening;
										}
										if ($team_skills_count > 0) {
											$output .= $team_skills;
										}
									$output .= '<div class="ts-team3-person-space"></div>';					
								$output .= '</div>';
							}
						
							foreach ($custom_fields_array as $index => $array) {
								unset(${$custom_fields_array[$index]['name']});
							}
							if ($frontend_edit == "true") {
								break;
							}
						}
					
					$output .= '</div>';
				$output .= '</div>';
				
				echo $output;
				
				$myvariable = ob_get_clean();
				return $myvariable;
			}
		
			// Add Teammate Elements
			function TS_VCSC_Add_Team_Mates_Element_Standalone() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Standalone Teammate
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                              => __( "TS Single Teammate", "ts_visual_composer_extend" ),
					"base"                              => "TS_VCSC_Team_Mates_Standalone",
					"icon" 	                            => "ts-composer-element-icon-teammates-single",
					"category"                          => __( "Composium", "ts_visual_composer_extend" ),
					"description"                       => __("Place a single teammate element", "ts_visual_composer_extend"),
					"admin_enqueue_js"            		=> "",
					"admin_enqueue_css"           		=> "",
					"params"                            => array(
						// Teammate Selection
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_1",
							"seperator"                 => "Main Content",
						),
						array(
							"type"                      => "custompost",
							"heading"                   => __( "Teammate", "ts_visual_composer_extend" ),
							"param_name"                => "team_member",
							"posttype"                  => "ts_team",
							"posttaxonomy"              => "ts_team_category",
							"taxonomy"              	=> "ts_team_category",
							"postsingle"				=> "Teammate",
							"postplural"				=> "Teammates",
							"postclass"					=> "teammate",
							"value"                     => "",
						),
						array(
							"type"                      => "hidden_input",
							"heading"                   => __( "Member Name", "ts_visual_composer_extend" ),
							"param_name"                => "custompost_name",
							"value"                     => "",
							"admin_label"		        => true,
						),
						// Style + Output Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_2",
							"seperator"					=> "Style and Output",
						),
						array(
							"type"                      => "dropdown",
							"heading"                   => __( "Design", "ts_visual_composer_extend" ),
							"param_name"                => "style",
							"value"                     => array(
								__( 'Style 1', "ts_visual_composer_extend" )          => "style1",
								__( 'Style 2', "ts_visual_composer_extend" )          => "style2",
								__( 'Style 3', "ts_visual_composer_extend" )          => "style3",
							),
							"admin_label"               => true,
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Name / Position", "ts_visual_composer_extend" ),
							"param_name"                => "show_title",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the name / position for the teammate.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Description", "ts_visual_composer_extend" ),
							"param_name"                => "show_content",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the description section for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Dedicated Page Link", "ts_visual_composer_extend" ),
							"param_name"                => "show_dedicated",
							"value"                     => "false",
							"description"               => __( "Switch the toggle if you want to show the link button to the dedicated page for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Download Button", "ts_visual_composer_extend" ),
							"param_name"                => "show_download",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the download button for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Contact Information", "ts_visual_composer_extend" ),
							"param_name"                => "show_contact",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the contact information for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Social Links", "ts_visual_composer_extend" ),
							"param_name"                => "show_social",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the social links for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Other Information", "ts_visual_composer_extend" ),
							"param_name"                => "show_opening",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the other information for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Skill Bars", "ts_visual_composer_extend" ),
							"param_name"                => "show_skills",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the skill bars for this teammember.", "ts_visual_composer_extend" )
						),						
						// Featured Image Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_3",
							"seperator"                 => "Featured Image",
							"group" 			        => "Featured Image",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Featured Image", "ts_visual_composer_extend" ),
							"param_name"                => "show_image",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the featured image for the teammate.", "ts_visual_composer_extend" ),
							"group" 			        => "Featured Image",
						),
						array(
							"type"                      => "dropdown",
							"heading"                   => __( "Image Style", "ts_visual_composer_extend" ),
							"param_name"                => "image_style",
							"value"                     => array(
								__( 'Circle with Rotate', "ts_visual_composer_extend" )			=> "imagestyle1",
								__( 'Circle without Rotate', "ts_visual_composer_extend" )		=> "imagestyle5",
								__( 'Square with Rotate', "ts_visual_composer_extend" )         => "imagestyle2",
								__( 'Square without Rotate', "ts_visual_composer_extend" )		=> "imagestyle6",
								__( 'Square to Circle', "ts_visual_composer_extend" )          	=> "imagestyle3",
								__( 'Square with Zoom', "ts_visual_composer_extend" )          	=> "imagestyle4",
							),
							"description"               => __( "Define which general style and hover effect should be applid to the featured image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_image", 'value' => 'true' ),
							"group" 			        => "Featured Image",
						),	
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Use Grayscale Effect", "ts_visual_composer_extend" ),
							"param_name"                => "show_grayscale",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to apply a grayscale effect on the featured image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_image", 'value' => 'true' ),
							"group" 			        => "Featured Image",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Use Grayscale on Hover", "ts_visual_composer_extend" ),
							"param_name"                => "grayscale_hover",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the grayscale effect when hovering over the featured image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_grayscale", 'value' => 'true' ),
							"group" 			        => "Featured Image",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Use Lightbox with Image", "ts_visual_composer_extend" ),
							"param_name"                => "show_lightbox",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to apply the lightbox to the featured image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_image", 'value' => 'true' ),
							"group" 			        => "Featured Image",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Link Image to Page", "ts_visual_composer_extend" ),
							"param_name"                => "link_image",
							"value"                     => "false",
							"description"               => __( "Switch the toggle if you want to apply the dedicated page link to the image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_lightbox", 'value' => 'false' ),
							"group" 			        => "Featured Image",
						),											
						// Social Icon Style
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_4",
							"seperator"					=> "Social Icon Settings",
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "dropdown",
							"heading"                   => __( "Style", "ts_visual_composer_extend" ),
							"param_name"                => "icon_style",
							"value"                     => array(
								"Simple"                => "simple",
								"Square"                => "square",
								"Rounded"               => "rounded",
								"Circle"                => "circle",
							),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"				    	=> "css3animations",
							"heading"			    	=> __("Icons Hover Animation", "ts_visual_composer_extend"),
							"param_name"		    	=> "icon_hover",
							"prefix"			    	=> "ts-hover-css-",
							"connector"			    	=> "css3animations_in",
							"noneselect"		    	=> "true",
							"default"			    	=> "",
							"value"				    	=> "",
							"admin_label"		    	=> false,
							"description"		    	=> __("Select the hover animation for the social icons.", "ts_visual_composer_extend"),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"				    	=> "hidden_input",
							"heading"			    	=> __( "Icons Hover Animation", "ts_visual_composer_extend" ),
							"param_name"		    	=> "css3animations_in",
							"value"				    	=> "",
							"admin_label"		    	=> true,
							"group" 			        => "Icon Settings",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Icon Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_color",
							"value"             		=> "#000000",
							"description"       		=> __( "Define the color of the icon; only applies to icons for contact information but not social icons.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "colorpicker",
							"heading"                   => __( "Icon Background Color", "ts_visual_composer_extend" ),
							"param_name"                => "icon_background",
							"value"                     => "#f5f5f5",
							"description"               => "",
							"dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "colorpicker",
							"heading"                   => __( "Icon Border Color", "ts_visual_composer_extend" ),
							"param_name"                => "icon_frame_color",
							"value"                     => "#f5f5f5",
							"description"               => "",
							"dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Icon Frame Border Thickness", "ts_visual_composer_extend" ),
							"param_name"                => "icon_frame_thick",
							"value"                     => "1",
							"min"                       => "1",
							"max"                       => "10",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => "",
							"dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Icon Margin", "ts_visual_composer_extend" ),
							"param_name"                => "icon_margin",
							"value"                     => "5",
							"min"                       => "0",
							"max"                       => "50",
							"step"                      => "1",
							"unit"                      => 'px',
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "dropdown",
							"heading"                   => __( "Icons Align", "ts_visual_composer_extend" ),
							"param_name"                => "icon_align",
							"width"                     => 150,
							"value"                     => array(
								__( 'Left', "ts_visual_composer_extend" )         => "left",
								__( 'Right', "ts_visual_composer_extend" )        => "right",
								__( 'Center', "ts_visual_composer_extend" )       => "center" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"						=> "dropdown",
							"heading"					=> __( "Tooltip Position", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltip_position",
							"value"						=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Vertical,
							"description"				=> __( "Select the tooltip position in relation to the trigger.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"						=> "dropdown",
							"heading"					=> __( "Tooltip Style", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltip_style",
							"value"             		=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Layouts,
							"description"				=> __( "Select the tooltip style.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"				    	=> "dropdown",
							"heading"			    	=> __( "Tooltip Animation", "ts_visual_composer_extend" ),
							"param_name"		    	=> "tooltip_animation",
							"value"                 	=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Animations,
							"description"		    	=> __( "Select how the tooltip entry and exit should be animated once triggered.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Tooltip X-Offset", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltipster_offsetx",
							"value"						=> "0",
							"min"						=> "-100",
							"max"						=> "100",
							"step"						=> "1",
							"unit"						=> 'px',
							"description"				=> __( "Define an optional X-Offset for the tooltip position.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Tooltip Y-Offset", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltipster_offsety",
							"value"						=> "0",
							"min"						=> "-100",
							"max"						=> "100",
							"step"						=> "1",
							"unit"						=> 'px',
							"description"				=> __( "Define an optional Y-Offset for the tooltip position.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),		
						// Other Teammate Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_5",
							"seperator"					=> "Other Settings",
							"group" 			        => "Other Settings",
						),
						array(
							"type"                      => "dropdown",
							"heading"                   => __( "Viewport Animation", "ts_visual_composer_extend" ),
							"param_name"                => "animation_view",
							"value"                     => array(
								"None"                              => "",
								"Top to Bottom"                     => "top-to-bottom",
								"Bottom to Top"                     => "bottom-to-top",
								"Left to Right"                     => "left-to-right",
								"Right to Left"                     => "right-to-left",
								"Appear from Center"                => "appear",
							),
							"description"               => __( "Select the viewport animation for the element.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "animations", 'value' => 'true' ),
							"group" 			        => "Other Settings",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Margin: Top", "ts_visual_composer_extend" ),
							"param_name"                => "margin_top",
							"value"                     => "0",
							"min"                       => "-50",
							"max"                       => "500",
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
							"min"                       => "-50",
							"max"                       => "500",
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
			function TS_VCSC_Add_Team_Mates_Element_Single() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Single Teammate (for Custom Slider)
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                           	=> __("TS Teammate Slide", "ts_visual_composer_extend"),
					"base"                           	=> "TS_VCSC_Team_Mates_Single",
					"icon"                           	=> "ts-composer-element-icon-teammates-single",
					"category"                       	=> __("Composium", "ts_visual_composer_extend"),
					"content_element"                	=> true,
					"as_child"                       	=> array('only' => 'TS_VCSC_Team_Mates_Slider_Custom'),
					"description"                    	=> __("Add a teammate slide element", "ts_visual_composer_extend"),
					"admin_enqueue_js"            		=> "",
					"admin_enqueue_css"           		=> "",
					"params"                         	=> array(
						// Teammate Selection
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_1",
							"seperator"					=> "Main Content",
						),
						array(
							"type"                      => "custompost",
							"heading"                   => __( "Teammate", "ts_visual_composer_extend" ),
							"param_name"                => "team_member",
							"posttype"                  => "ts_team",
							"posttaxonomy"              => "ts_team_category",
							"taxonomy"              	=> "ts_team_category",
							"postsingle"				=> "Teammate",
							"postplural"				=> "Teammates",
							"postclass"					=> "teammate",
							"value"                     => "",
						),
						array(
							"type"                      => "hidden_input",
							"heading"                   => __( "Member Name", "ts_visual_composer_extend" ),
							"param_name"                => "custompost_name",
							"value"                     => "",
							"admin_label"		        => true,
						),
						// Style + Output Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_2",
							"seperator"					=> "Style and Output",
						),
						array(
							"type"                      => "dropdown",
							"heading"                   => __( "Design", "ts_visual_composer_extend" ),
							"param_name"                => "style",
							"value"                     => array(
								__( 'Style 1', "ts_visual_composer_extend" )          => "style1",
								__( 'Style 2', "ts_visual_composer_extend" )          => "style2",
								__( 'Style 3', "ts_visual_composer_extend" )          => "style3",
							),
							"admin_label"               => true,
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Name / Position", "ts_visual_composer_extend" ),
							"param_name"                => "show_title",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the name / position for the teammate.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Description", "ts_visual_composer_extend" ),
							"param_name"                => "show_content",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the description section for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Dedicated Page Link", "ts_visual_composer_extend" ),
							"param_name"                => "show_dedicated",
							"value"                     => "false",
							"description"               => __( "Switch the toggle if you want to show the link button to the dedicated page for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Download Button", "ts_visual_composer_extend" ),
							"param_name"                => "show_download",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the download button for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Contact Information", "ts_visual_composer_extend" ),
							"param_name"                => "show_contact",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the contact information for this teammember.", "ts_visual_composer_extend" )
						),						
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Social Links", "ts_visual_composer_extend" ),
							"param_name"                => "show_social",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the social links for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Other Information", "ts_visual_composer_extend" ),
							"param_name"                => "show_opening",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the other information for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Skill Bars", "ts_visual_composer_extend" ),
							"param_name"                => "show_skills",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the skill bars for this teammember.", "ts_visual_composer_extend" )
						),
						// Featured Image Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_3",
							"seperator"					=> "Featured Image",
							"group" 			        => "Featured Image",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Featured Image", "ts_visual_composer_extend" ),
							"param_name"                => "show_image",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the featured image for the teammate.", "ts_visual_composer_extend" ),
							"group" 			        => "Featured Image",
						),
						array(
							"type"                      => "dropdown",
							"heading"                   => __( "Image Style", "ts_visual_composer_extend" ),
							"param_name"                => "image_style",
							"value"                     => array(
								__( 'Circle with Rotate', "ts_visual_composer_extend" )			=> "imagestyle1",
								__( 'Circle without Rotate', "ts_visual_composer_extend" )		=> "imagestyle5",
								__( 'Square with Rotate', "ts_visual_composer_extend" )         => "imagestyle2",
								__( 'Square without Rotate', "ts_visual_composer_extend" )		=> "imagestyle6",
								__( 'Square to Circle', "ts_visual_composer_extend" )          	=> "imagestyle3",
								__( 'Square with Zoom', "ts_visual_composer_extend" )          	=> "imagestyle4",
							),
							"description"               => __( "Define which general style and hover effect should be applid to the featured image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_image", 'value' => 'true' ),
							"group" 			        => "Featured Image",
						),	
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Use Grayscale Effect", "ts_visual_composer_extend" ),
							"param_name"                => "show_grayscale",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to apply a grayscale effect on the featured image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_image", 'value' => 'true' ),
							"group" 			        => "Featured Image",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Use Grayscale on Hover", "ts_visual_composer_extend" ),
							"param_name"                => "grayscale_hover",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the grayscale effect when hovering over the featured image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_grayscale", 'value' => 'true' ),
							"group" 			        => "Featured Image",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Use Lightbox with Image", "ts_visual_composer_extend" ),
							"param_name"                => "show_lightbox",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to apply the lightbox to the featured image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_image", 'value' => 'true' ),
							"group" 			        => "Featured Image",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Link Image to Page", "ts_visual_composer_extend" ),
							"param_name"                => "link_image",
							"value"                     => "false",
							"description"               => __( "Switch the toggle if you want to apply the dedicated page link to the image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_lightbox", 'value' => 'false' ),
							"group" 			        => "Featured Image",
						),						
						// Social Icon Style
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_4",
							"seperator"					=> "Social Icon Settings",
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "dropdown",
							"heading"                   => __( "Style", "ts_visual_composer_extend" ),
							"param_name"                => "icon_style",
							"value"                     => array(
								"Simple"                => "simple",
								"Square"                => "square",
								"Rounded"               => "rounded",
								"Circle"                => "circle",
							),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"				    	=> "css3animations",
							"heading"			    	=> __("Icons Hover Animation", "ts_visual_composer_extend"),
							"param_name"		    	=> "icon_hover",
							"prefix"			    	=> "ts-hover-css-",
							"connector"			    	=> "css3animations_in",
							"noneselect"		    	=> "true",
							"default"			    	=> "",
							"value"				    	=> "",
							"admin_label"		    	=> false,
							"description"		    	=> __("Select the hover animation for the social icons.", "ts_visual_composer_extend"),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"				    	=> "hidden_input",
							"heading"			    	=> __( "Icons Hover Animation", "ts_visual_composer_extend" ),
							"param_name"		    	=> "css3animations_in",
							"value"				    	=> "",
							"admin_label"		    	=> true,
							"group" 			        => "Icon Settings",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Icon Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_color",
							"value"             		=> "#000000",
							"description"       		=> __( "Define the color of the icon; only applies to icons for contact information but not social icons.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "colorpicker",
							"heading"                   => __( "Icon Background Color", "ts_visual_composer_extend" ),
							"param_name"                => "icon_background",
							"value"                     => "#f5f5f5",
							"description"               => "",
							"dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "colorpicker",
							"heading"                   => __( "Icon Border Color", "ts_visual_composer_extend" ),
							"param_name"                => "icon_frame_color",
							"value"                     => "#f5f5f5",
							"description"               => "",
							"dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Icon Frame Border Thickness", "ts_visual_composer_extend" ),
							"param_name"                => "icon_frame_thick",
							"value"                     => "1",
							"min"                       => "1",
							"max"                       => "10",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => "",
							"dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Icon Margin", "ts_visual_composer_extend" ),
							"param_name"                => "icon_margin",
							"value"                     => "5",
							"min"                       => "0",
							"max"                       => "50",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => "",
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "dropdown",
							"heading"                   => __( "Icons Align", "ts_visual_composer_extend" ),
							"param_name"                => "icon_align",
							"width"                     => 150,
							"value"                     => array(
								__( 'Left', "ts_visual_composer_extend" )         => "left",
								__( 'Right', "ts_visual_composer_extend" )        => "right",
								__( 'Center', "ts_visual_composer_extend" )       => "center" ),
							"description"               => "",
							"group" 			        => "Icon Settings",
						),
						array(
							"type"						=> "dropdown",
							"heading"					=> __( "Tooltip Position", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltip_position",
							"value"						=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Vertical,
							"description"				=> __( "Select the tooltip position in relation to the trigger.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"						=> "dropdown",
							"heading"					=> __( "Tooltip Style", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltip_style",
							"value"             		=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Layouts,
							"description"				=> __( "Select the tooltip style.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"				    	=> "dropdown",
							"heading"			    	=> __( "Tooltip Animation", "ts_visual_composer_extend" ),
							"param_name"		    	=> "tooltip_animation",
							"value"                 	=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Animations,
							"description"		    	=> __( "Select how the tooltip entry and exit should be animated once triggered.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Tooltip X-Offset", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltipster_offsetx",
							"value"						=> "0",
							"min"						=> "-100",
							"max"						=> "100",
							"step"						=> "1",
							"unit"						=> 'px',
							"description"				=> __( "Define an optional X-Offset for the tooltip position.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Tooltip Y-Offset", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltipster_offsety",
							"value"						=> "0",
							"min"						=> "-100",
							"max"						=> "100",
							"step"						=> "1",
							"unit"						=> 'px',
							"description"				=> __( "Define an optional Y-Offset for the tooltip position.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
					)
				);
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
					return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
				} else {			
					vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
				};
			}
			function TS_VCSC_Add_Team_Mates_Element_SliderCustom() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Teammates Slider 1 (Custom Build)
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"                              => __("TS Teammates Slider 1", "ts_visual_composer_extend"),
					"base"                              => "TS_VCSC_Team_Mates_Slider_Custom",
					"icon"                              => "ts-composer-element-icon-teammates-slider-custom",
					"category"                          => __("Composium", "ts_visual_composer_extend"),
					"as_parent"                         => array('only' => 'TS_VCSC_Team_Mates_Single'),
					"description"                       => __("Build a custom Teammate Slider", "ts_visual_composer_extend"),
					"controls" 							=> "full",
					"content_element"                   => true,
					"is_container" 						=> true,
					"container_not_allowed" 			=> false,
					"show_settings_on_create"           => true,
					"admin_enqueue_js"            		=> "",
					"admin_enqueue_css"           		=> "",
					"js_view"                           => "VcColumnView",
					"params"							=> array(
						// Slider Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_1",
							"seperator"					=> "Slider Settings",
						),
						array(
							"type" 						=> "css3animations",
							"heading" 					=> __("In-Animation Type", "ts_visual_composer_extend"),
							"param_name" 				=> "animation_in",
							"prefix"					=> "ts-viewport-css-",
							"connector"					=> "css3animations_in",
							"default"					=> "flipInX",
							"value" 					=> "",
							"admin_label"				=> false,
							"description" 				=> __("Select the CSS3 in-animation you want to apply to the slider.", "ts_visual_composer_extend"),
						),
						array(
							"type"                      => "hidden_input",
							"heading"                   => __( "In-Animation Type", "ts_visual_composer_extend" ),
							"param_name"                => "css3animations_in",
							"value"                     => "",
							"admin_label"		        => true,
						),						
						array(
							"type" 						=> "css3animations",
							"heading" 					=> __("Out-Animation Type", "ts_visual_composer_extend"),
							"param_name" 				=> "animation_out",
							"prefix"					=> "ts-viewport-css-",
							"connector"					=> "css3animations_out",
							"default"					=> "slideOutDown",
							"value" 					=> "",
							"admin_label"				=> false,
							"description" 				=> __("Select the CSS3 out-animation you want to apply to the slider.", "ts_visual_composer_extend"),
						),
						array(
							"type"                      => "hidden_input",
							"heading"                   => __( "Out-Animation Type", "ts_visual_composer_extend" ),
							"param_name"                => "css3animations_out",
							"value"                     => "",
							"admin_label"		        => true,
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Animate on Mobile", "ts_visual_composer_extend" ),
							"param_name"                => "animation_mobile",
							"value"                     => "false",
							"description"               => __( "Switch the toggle if you want to show the CSS3 animations on mobile devices.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Auto-Height", "ts_visual_composer_extend" ),
							"param_name"                => "auto_height",
							"value"                     => "true",
							"admin_label"		        => true,
							"description"               => __( "Switch the toggle if you want the slider to auto-adjust its height.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "RTL Page", "ts_visual_composer_extend" ),
							"param_name"                => "page_rtl",
							"value"                     => "false",
							"description"               => __( "Switch the toggle if the slider is used on a page with RTL (Right-To-Left) alignment.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Auto-Play", "ts_visual_composer_extend" ),
							"param_name"                => "auto_play",
							"value"                     => "false",
							"admin_label"		        => true,
							"description"               => __( "Switch the toggle if you want the auto-play the slider on page load.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Play / Pause", "ts_visual_composer_extend" ),
							"param_name"                => "show_playpause",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show a play / pause button to control the autoplay.", "ts_visual_composer_extend" ),
							"dependency" 				=> array("element" 	=> "auto_play", "value" => "true"),
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Progressbar", "ts_visual_composer_extend" ),
							"param_name"                => "show_bar",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show a progressbar during auto-play.", "ts_visual_composer_extend" ),
							"dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
						),
						array(
							"type"                      => "colorpicker",
							"heading"                   => __( "Progressbar Color", "ts_visual_composer_extend" ),
							"param_name"                => "bar_color",
							"value"                     => "#dd3333",
							"description"               => __( "Define the color of the animated progressbar.", "ts_visual_composer_extend" ),
							"dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Auto-Play Speed", "ts_visual_composer_extend" ),
							"param_name"                => "show_speed",
							"value"                     => "5000",
							"min"                       => "1000",
							"max"                       => "20000",
							"step"                      => "100",
							"unit"                      => 'ms',
							"description"               => __( "Define the speed used to auto-play the slider.", "ts_visual_composer_extend" ),
							"dependency" 				=> array("element" 	=> "auto_play","value" 	=> "true"),
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Stop on Hover", "ts_visual_composer_extend" ),
							"param_name"                => "stop_hover",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want the stop the auto-play while hovering over the slider.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "auto_play", 'value' => 'true' )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Top Navigation", "ts_visual_composer_extend" ),
							"param_name"                => "show_navigation",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show left/right navigation buttons for the slider.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Dot Navigation", "ts_visual_composer_extend" ),
							"param_name"                => "show_dots",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show dot navigation buttons below the slider.", "ts_visual_composer_extend" ),
						),
						// Other Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_2",
							"seperator"					=> "Other Settings",
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
					),						
				);
				if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
					return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
				} else {			
					vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
				};
			}
			function TS_VCSC_Add_Team_Mates_Element_SliderCategory() {
				global $VISUAL_COMPOSER_EXTENSIONS;
				// Add Teammates Slider 2 (by Categories)
				$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
					"name"								=> __("TS Teammates Slider 2", "ts_visual_composer_extend"),
					"base"								=> "TS_VCSC_Team_Mates_Slider_Category",
					"icon"								=> "ts-composer-element-icon-teammates-slider-category",
					"category"							=> __("Composium", "ts_visual_composer_extend"),
					"description"						=> __("Place a Teammate Slider (by Category)", "ts_visual_composer_extend"),
					"admin_enqueue_js"					=> "",
					"admin_enqueue_css"					=> "",
					"params"							=> array(
						// Teammate Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_1",
							"seperator"					=> "Teammate Categories",
						),
						array(
							"type"                      => "custompostcat",
							"heading"                   => __( "Teammate Categories", "ts_visual_composer_extend" ),
							"param_name"                => "teammatecat",
							"posttype"                  => "ts_team",
							"posttaxonomy"              => "ts_team_category",
							"taxonomy"              	=> "ts_team_category",
							"postsingle"				=> "Teammate",
							"postplural"				=> "Teammates",
							"postclass"					=> "teammate",
							"value"                     => "",
							"description"               => __( "Please select the teammate categories you want to use for the slider.", "ts_visual_composer_extend" )
						),
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_2",
							"seperator"					=> "Teammate Settings",
						),
						array(
							"type"                      => "dropdown",
							"heading"                   => __( "Design", "ts_visual_composer_extend" ),
							"param_name"                => "style",
							"value"                     => array(
								__( 'Style 1', "ts_visual_composer_extend" )          => "style1",
								__( 'Style 2', "ts_visual_composer_extend" )          => "style2",
								__( 'Style 3', "ts_visual_composer_extend" )          => "style3",
							),
							"admin_label"               => true,
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Featured Image", "ts_visual_composer_extend" ),
							"param_name"                => "show_image",
							"value"                     => "true",
							"admin_label"		        => true,
							"description"               => __( "Switch the toggle if you want to show the featured image for the teammate.", "ts_visual_composer_extend" )
						),
						array(
							"type"                      => "dropdown",
							"heading"                   => __( "Image Style", "ts_visual_composer_extend" ),
							"param_name"                => "image_style",
							"value"                     => array(
								__( 'Circle with Rotate', "ts_visual_composer_extend" )			=> "imagestyle1",
								__( 'Square with Rotate', "ts_visual_composer_extend" )         => "imagestyle2",
								__( 'Square to Circle', "ts_visual_composer_extend" )          	=> "imagestyle3",
								__( 'Square with Zoom', "ts_visual_composer_extend" )          	=> "imagestyle4",
							),
							"description"               => __( "Define which general style and hover effect should be applid to the featured image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_image", 'value' => 'true' ),
						),	
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Use Grayscale Effect", "ts_visual_composer_extend" ),
							"param_name"                => "show_grayscale",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to apply a grayscale effect on the featured image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_image", 'value' => 'true' )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Use Grayscale on Hover", "ts_visual_composer_extend" ),
							"param_name"                => "grayscale_hover",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the grayscale effect when hovering over the featured image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_grayscale", 'value' => 'true' )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Use Lightbox with Image", "ts_visual_composer_extend" ),
							"param_name"                => "show_lightbox",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to apply the lightbox to the featured image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_image", 'value' => 'true' )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Link Image to Page", "ts_visual_composer_extend" ),
							"param_name"                => "link_image",
							"value"                     => "false",
							"description"               => __( "Switch the toggle if you want to apply the dedicated page link to the image.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "show_lightbox", 'value' => 'false' )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Name / Position", "ts_visual_composer_extend" ),
							"param_name"                => "show_title",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the name / position for the teammate.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Description", "ts_visual_composer_extend" ),
							"param_name"                => "show_content",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the description section for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Dedicated Page Link", "ts_visual_composer_extend" ),
							"param_name"                => "show_dedicated",
							"value"                     => "false",
							"description"               => __( "Switch the toggle if you want to show the link button to the dedicated page for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Download Button", "ts_visual_composer_extend" ),
							"param_name"                => "show_download",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the download button for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Contact Information", "ts_visual_composer_extend" ),
							"param_name"                => "show_contact",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the contact information for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Social Links", "ts_visual_composer_extend" ),
							"param_name"                => "show_social",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the social links for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Other Information", "ts_visual_composer_extend" ),
							"param_name"                => "show_opening",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the other information for this teammember.", "ts_visual_composer_extend" )
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Skill Bars", "ts_visual_composer_extend" ),
							"param_name"                => "show_skills",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show the skill bars for this teammember.", "ts_visual_composer_extend" )
						),
						// Slider Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_3",
							"seperator"					=> "Slider Settings",
							"group" 			        => "Slider Settings",
						),
						array(
							"type" 						=> "css3animations",
							"heading" 					=> __("In-Animation Type", "ts_visual_composer_extend"),
							"param_name" 				=> "animation_in",
							"prefix"					=> "ts-viewport-css-",
							"connector"					=> "css3animations_in",
							"default"					=> "flipInX",
							"value" 					=> "",
							"admin_label"				=> false,
							"description" 				=> __("Select the CSS3 in-animation you want to apply to the slider.", "ts_visual_composer_extend"),
							"group" 			        => "Slider Settings",
						),
						array(
							"type"                      => "hidden_input",
							"heading"                   => __( "In-Animation Type", "ts_visual_composer_extend" ),
							"param_name"                => "css3animations_in",
							"value"                     => "",
							"admin_label"		        => true,
							"group" 			        => "Slider Settings",
						),						
						array(
							"type" 						=> "css3animations",
							"heading" 					=> __("Out-Animation Type", "ts_visual_composer_extend"),
							"param_name" 				=> "animation_out",
							"prefix"					=> "ts-viewport-css-",
							"connector"					=> "css3animations_out",
							"default"					=> "slideOutDown",
							"value" 					=> "",
							"admin_label"				=> false,
							"description" 				=> __("Select the CSS3 out-animation you want to apply to the slider.", "ts_visual_composer_extend"),
							"group" 			        => "Slider Settings",
						),
						array(
							"type"                      => "hidden_input",
							"heading"                   => __( "Out-Animation Type", "ts_visual_composer_extend" ),
							"param_name"                => "css3animations_out",
							"value"                     => "",
							"admin_label"		        => true,
							"group" 			        => "Slider Settings",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Animate on Mobile", "ts_visual_composer_extend" ),
							"param_name"                => "animation_mobile",
							"value"                     => "false",
							"description"               => __( "Switch the toggle if you want to show the CSS3 animations on mobile devices.", "ts_visual_composer_extend" ),
							"group" 			        => "Slider Settings",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Auto-Height", "ts_visual_composer_extend" ),
							"param_name"                => "auto_height",
							"value"                     => "true",
							"admin_label"		        => true,
							"description"               => __( "Switch the toggle if you want the slider to auto-adjust its height.", "ts_visual_composer_extend" ),
							"group" 			        => "Slider Settings",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "RTL Page", "ts_visual_composer_extend" ),
							"param_name"                => "page_rtl",
							"value"                     => "false",
							"description"               => __( "Switch the toggle if the slider is used on a page with RTL (Right-To-Left) alignment.", "ts_visual_composer_extend" ),
							"group" 			        => "Slider Settings",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Auto-Play", "ts_visual_composer_extend" ),
							"param_name"                => "auto_play",
							"value"                     => "false",
							"admin_label"		        => true,
							"description"               => __( "Switch the toggle if you want the auto-play the slider on page load.", "ts_visual_composer_extend" ),
							"group" 			        => "Slider Settings",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Play / Pause", "ts_visual_composer_extend" ),
							"param_name"                => "show_playpause",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show a play / pause button to control the autoplay.", "ts_visual_composer_extend" ),
							"dependency" 				=> array("element" 	=> "auto_play", "value" => "true"),
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Progressbar", "ts_visual_composer_extend" ),
							"param_name"                => "show_bar",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show a progressbar during auto-play.", "ts_visual_composer_extend" ),
							"dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
							"group" 			        => "Slider Settings",
						),
						array(
							"type"                      => "colorpicker",
							"heading"                   => __( "Progressbar Color", "ts_visual_composer_extend" ),
							"param_name"                => "bar_color",
							"value"                     => "#dd3333",
							"description"               => __( "Define the color of the animated progressbar.", "ts_visual_composer_extend" ),
							"dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
							"group" 			        => "Slider Settings",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Auto-Play Speed", "ts_visual_composer_extend" ),
							"param_name"                => "show_speed",
							"value"                     => "5000",
							"min"                       => "1000",
							"max"                       => "20000",
							"step"                      => "100",
							"unit"                      => 'ms',
							"description"               => __( "Define the speed used to auto-play the slider.", "ts_visual_composer_extend" ),
							"dependency" 				=> array("element" 	=> "auto_play","value" 	=> "true"),
							"group" 			        => "Slider Settings",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Stop on Hover", "ts_visual_composer_extend" ),
							"param_name"                => "stop_hover",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want the stop the auto-play while hovering over the slider.", "ts_visual_composer_extend" ),
							"dependency"                => array( 'element' => "auto_play", 'value' => 'true' ),
							"group" 			        => "Slider Settings",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Top Navigation", "ts_visual_composer_extend" ),
							"param_name"                => "show_navigation",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show left/right navigation buttons for the slider.", "ts_visual_composer_extend" ),
							"group" 			        => "Slider Settings",
						),
						array(
							"type"              	    => "switch_button",
							"heading"                   => __( "Show Dot Navigation", "ts_visual_composer_extend" ),
							"param_name"                => "show_dots",
							"value"                     => "true",
							"description"               => __( "Switch the toggle if you want to show dot navigation buttons below the slider.", "ts_visual_composer_extend" ),
							"dependency"                => "Slider Settings"
						),
						// Social Icon Style
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_5",
							"seperator"					=> "Social Icon Settings",
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "dropdown",
							"heading"                   => __( "Style", "ts_visual_composer_extend" ),
							"param_name"                => "icon_style",
							"value"                     => array(
								"Simple"                            => "simple",
								"Square"                            => "square",
								"Rounded"                           => "rounded",
								"Circle"                            => "circle",
							),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"              		=> "colorpicker",
							"heading"           		=> __( "Icon Color", "ts_visual_composer_extend" ),
							"param_name"        		=> "icon_color",
							"value"             		=> "#000000",
							"description"       		=> __( "Define the color of the icon; only applies to icons for contact information but not social icons.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "colorpicker",
							"heading"                   => __( "Icon Background Color", "ts_visual_composer_extend" ),
							"param_name"                => "icon_background",
							"value"                     => "#f5f5f5",
							"description"               => "",
							"dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "colorpicker",
							"heading"                   => __( "Icon Border Color", "ts_visual_composer_extend" ),
							"param_name"                => "icon_frame_color",
							"value"                     => "#f5f5f5",
							"dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Icon Frame Border Thickness", "ts_visual_composer_extend" ),
							"param_name"                => "icon_frame_thick",
							"value"                     => "1",
							"min"                       => "1",
							"max"                       => "10",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => "",
							"dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "nouislider",
							"heading"                   => __( "Icon Margin", "ts_visual_composer_extend" ),
							"param_name"                => "icon_margin",
							"value"                     => "5",
							"min"                       => "0",
							"max"                       => "50",
							"step"                      => "1",
							"unit"                      => 'px',
							"description"               => "",
							"group" 			        => "Icon Settings",
						),
						array(
							"type"                      => "dropdown",
							"heading"                   => __( "Icons Align", "ts_visual_composer_extend" ),
							"param_name"                => "icon_align",
							"width"                     => 150,
							"value"                     => array(
								__( 'Left', "ts_visual_composer_extend" )         => "left",
								__( 'Right', "ts_visual_composer_extend" )        => "right",
								__( 'Center', "ts_visual_composer_extend" )       => "center" ),
							"description"               => "",
							"group" 			        => "Icon Settings",
						),
						array(
							"type"				    	=> "css3animations",
							"heading"			    	=> __("Icons Hover Animation", "ts_visual_composer_extend"),
							"param_name"		    	=> "icon_hover",
							"prefix"			    	=> "ts-hover-css-",
							"connector"			    	=> "css3animations_in",
							"noneselect"		    	=> "true",
							"default"			    	=> "",
							"value"				    	=> "",
							"admin_label"		    	=> false,
							"description"		    	=> __("Select the hover animation for the social icons.", "ts_visual_composer_extend"),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"				    	=> "hidden_input",
							"heading"			    	=> __( "Icons Hover Animation", "ts_visual_composer_extend" ),
							"param_name"		    	=> "css3animations_in",
							"value"				    	=> "",
							"admin_label"		    	=> true,
							"group" 			        => "Icon Settings",
						),
						array(
							"type"						=> "dropdown",
							"heading"					=> __( "Tooltip Position", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltip_position",
							"value"						=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Vertical,
							"description"				=> __( "Select the tooltip position in relation to the trigger.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"						=> "dropdown",
							"heading"					=> __( "Tooltip Style", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltip_style",
							"value"             		=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Layouts,
							"description"				=> __( "Select the tooltip style.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"				    	=> "dropdown",
							"heading"			    	=> __( "Tooltip Animation", "ts_visual_composer_extend" ),
							"param_name"		    	=> "tooltip_animation",
							"value"                 	=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ToolTipster_Animations,
							"description"		    	=> __( "Select how the tooltip entry and exit should be animated once triggered.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Tooltip X-Offset", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltipster_offsetx",
							"value"						=> "0",
							"min"						=> "-100",
							"max"						=> "100",
							"step"						=> "1",
							"unit"						=> 'px',
							"description"				=> __( "Define an optional X-Offset for the tooltip position.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						array(
							"type"						=> "nouislider",
							"heading"					=> __( "Tooltip Y-Offset", "ts_visual_composer_extend" ),
							"param_name"				=> "tooltipster_offsety",
							"value"						=> "0",
							"min"						=> "-100",
							"max"						=> "100",
							"step"						=> "1",
							"unit"						=> 'px',
							"description"				=> __( "Define an optional Y-Offset for the tooltip position.", "ts_visual_composer_extend" ),
							"group" 			        => "Icon Settings",
						),
						// Other Settings
						array(
							"type"                      => "seperator",
							"param_name"                => "seperator_6",
							"seperator"					=> "Other Settings",
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
	if ((class_exists('WPBakeryShortCodesContainer')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Team_Mates_Slider_Custom'))) {
		class WPBakeryShortCode_TS_VCSC_Team_Mates_Slider_Custom extends WPBakeryShortCodesContainer {};
	}
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Team_Mates_Standalone'))) {
		class WPBakeryShortCode_TS_VCSC_Team_Mates_Standalone extends WPBakeryShortCode {};
	}
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Team_Mates_Single'))) {
		class WPBakeryShortCode_TS_VCSC_Team_Mates_Single extends WPBakeryShortCode {};
	}
	if ((class_exists('WPBakeryShortCode')) && (!class_exists('WPBakeryShortCode_TS_VCSC_Team_Mates_Slider_Category'))) {
		class WPBakeryShortCode_TS_VCSC_Team_Mates_Slider_Category extends WPBakeryShortCode {};
	}
	// Initialize "TS Teammates" Class
	if (class_exists('TS_Teammates')) {
		$TS_Teammates = new TS_Teammates;
	}
?>