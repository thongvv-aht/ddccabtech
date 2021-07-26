<?php
	global $VISUAL_COMPOSER_EXTENSIONS;
	global $TS_VCSC_tinymceCustomCount;
	global $TS_VCSC_Icons_Custom;	
	global $wp_filesystem;
	
	function TS_VCSC_RecursiveRMDIR($dir) {
		foreach (scandir($dir) as $file) {
		   if ('.' === $file || '..' === $file) continue;
		   if (is_dir("$dir/$file")) TS_VCSC_RecursiveRMDIR("$dir/$file");
		   else unlink("$dir/$file");
		}
		rmdir($dir);
	}
	
	
	function TS_VCSC_ScanFolderFiles($dir, $filter = '', &$results = array()) {
		$files = scandir($dir);	
		foreach($files as $key => $value){
			$path = realpath($dir.DIRECTORY_SEPARATOR.$value);	
			if(!is_dir($path)) {
				if(empty($filter) || preg_match($filter, $path)) $results[] = $path;
			} elseif($value != "." && $value != "..") {
				TS_VCSC_ScanFolderFiles($path, $filter, $results);
			}
		}	
		return $results;
	} 
	
	//print_r (get_option('ts_vcsc_extend_settings_tinymceCustomArray', ''));
	//echo get_option('ts_vcsc_extend_settings_tinymceCustomName', '');
	//echo get_option('ts_vcsc_extend_settings_tinymceCustomAuthor', '');
	//echo get_option('ts_vcsc_extend_settings_tinymceCustomCount', '');
	//echo get_option('ts_vcsc_extend_settings_tinymceCustomDate', '');
	
	/* get uploaded file, unzip .zip, store files in appropriate locations, populate page with custom icons
	wp_handle_upload ( http://codex.wordpress.org/Function_Reference/wp_handle_upload )
	** TO DO RENAME UPLOADED FILE TO ts-vcsc-custom-pack.zip ** */
	if (isset($_POST['Submit']) && (isset($_FILES['custom_icon_pack']))) {
		$uploadedfile 				= $_FILES['custom_icon_pack'];
		$upload_replace   			= ((isset($_POST['ts_vcsc_custom_pack_replace'])) ? $_POST['ts_vcsc_custom_pack_replace'] : 'off');
		$upload_relative   			= ((isset($_POST['ts_vcsc_custom_pack_relative'])) ? $_POST['ts_vcsc_custom_pack_relative'] : 'off');
		$upload_debugme   			= ((isset($_POST['ts_vcsc_custom_pack_debug'])) ? $_POST['ts_vcsc_custom_pack_debug'] : 'off');
		$upload_nocurl   			= ((isset($_POST['ts_vcsc_custom_pack_nocurl'])) ? $_POST['ts_vcsc_custom_pack_nocurl'] : 'off');
		if ($upload_debugme == "on") {
			$upload_debugtxt		= '<br/><br/>';
		} else {
			$upload_debugtxt		= '';
		}		
		// Optional Username / Password
		$upload_user   				= ((isset($_POST['ts_vcsc_custom_pack_user'])) ? $_POST['ts_vcsc_custom_pack_user'] : '');
		$upload_password			= ((isset($_POST['ts_vcsc_custom_pack_password'])) ? $_POST['ts_vcsc_custom_pack_password'] : '');
		// Other Settings
		$upload_overrides 			= array('test_form' => false);
		$upload_directory 			= wp_upload_dir();		
		$font_directory				= $upload_directory['basedir'] . '/ts-vcsc-icons/custom-pack';
		
		// Check + Force Initialize WordPress Filesystem
		if (!$wp_filesystem || !is_object($wp_filesystem)) {
			WP_Filesystem();
		}

		//$filename 				= $uploadedFile
		$filename 					= $_FILES["custom_icon_pack"]["name"];
		$source 					= $_FILES["custom_icon_pack"]["tmp_name"];
		$type 						= $_FILES["custom_icon_pack"]["type"]; 
		$name 						= explode(".", $filename);
		$accepted_types 			= array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
		foreach ($accepted_types as $mime_type) {
			if ($mime_type == $type) {
				$okay 				= true;
				break;
			} 
		} 
		$continue 					= strtolower($name[1]) == 'zip' ? true : false;
		if (!$continue) {
			TS_VCSC_CustomFontImportMessages('warning', 'The file you are trying to upload is not a .zip file. Please try again.');
		}
		/* PHP current path */
		$filepath 					= $upload_directory['basedir'] . '/ts-vcsc-icons/custom-pack/';  	// absolute path to the directory where zipper.php is in
		$filenoext 					= basename ($filename, '.zip');  		// absolute path to the directory where zipper.php is in (lowercase)
		$filenoext 					= basename ($filenoext, '.ZIP');  		// absolute path to the directory where zipper.php is in (when uppercase)
		$targetdir 					= $filepath; 							// target directory
		$filenameClear				= trim(str_replace(' ', '-', $filename));
		//$targetzip 				= $filepath . $filename; 	
		$targetzip 					= $filepath . $filenameClear; 			// target zip file
		/* create directory if not exists', otherwise overwrite */
		/* target directory is same as filename without extension */
		if (is_dir($targetdir)) {
			TS_VCSC_RecursiveRMDIR ($targetdir);
		}
		mkdir($targetdir, 0777);
		/* here it is really happening */
		if (move_uploaded_file($source, $targetzip)) {
			if (function_exists('unzip_file')){
				$dest_path 			= $upload_directory['path'];
				$dest_url			= $upload_directory['url'];				
				//$unzipfile 		= unzip_file($dest_path . '/' . $filename, $dest_path);
				$unzipfile 			= unzip_file($dest_path . '/' . $filenameClear, $dest_path);
			} else {
				$unzipfile			= false;
			}
			$movefile 				= true;
		} else {	
			$movefile 				= false;
			$unzipfile				= false;
		}		
		// Scan for and immediately delete dangerous injected Files
		if ($unzipfile) {			
			$targetscan				= TS_VCSC_ScanFolderFiles($dest_path);
			$targetfail				= array("php", "php5", "js", "sql", "htm", "html", "bat", "beam", "doc", "docm", "xls", "xlsm", "xltm", "xlam", "ppt", "pptm", "pot", "potm", "ppa", "ppam", "pps", "ppsm", "sld", "sldm");
			foreach ($targetscan as $filename) {
				$targetcheck		= pathinfo($filename, PATHINFO_EXTENSION);
				if (in_array($targetcheck, $targetfail)) {
					wp_delete_file($filename);
				}
			}
		}
		// If Upload was Successful
		if ($movefile) {	
			echo '<script>
				jQuery(document).ready(function() {
					jQuery(".ts-vcsc-custom-pack-preloader").hide();
					jQuery("#uninstall-pack-button").removeAttr("disabled");
					jQuery("#ts-custom-iconfont-import-file").attr("disabled", "disabled");
					jQuery("#ts-custom-iconfont-import-file").parent().addClass("ts-custom-iconfont-import-disabled");
					jQuery("input[value=Import]").attr("disabled", "disabled");
					jQuery(".ts-vcsc-custom-pack-buttons").after("<div class=updated><p class=fontPackUploadedSuccess>Custom Font Pack successfully uploaded!</p></div>");
				});
			</script>';
			$dest 					= wp_upload_dir();
			$dest_path 				= $dest['path'];
			$dest_url				= $dest['url'];
			$fileNameNoSpaces 		= trim(str_replace(' ', '-', $uploadedfile['name']));
			$basicCheck				= true;
			$filesFound				= true;
			if ($unzipfile) {				
				if (file_exists($dest_path . '/' . $fileNameNoSpaces)) {
					rename($dest_path . '/' . $fileNameNoSpaces, $dest_path . '/ts-vcsc-custom-pack.zip');
				} else {
					$filesFound 	= false;
				}
				if (file_exists($dest_path . '/selection.json')) {
					rename($dest_path . '/selection.json', $dest_path . '/ts-vcsc-custom-pack.json');
				} else {
					$basicCheck		= false;
				}
				// Change Path of linked Font Files in Style.css
				if ((file_exists($dest_path . '/style.css')) && ($upload_replace == 'on')) {
					$styleCSS 		= $dest_path . '/style.css';
					if (ini_get('allow_url_fopen') == '1') {
						$currentStyles 						= file_get_contents($styleCSS);
						// for css and js files that are not needed any more
						if (strpos($dest_url, '/ts-vcsc-icons/custom-pack') !== false) {
							$newStyles 						= str_replace("url('fonts/", "url('" . $dest_url . "/fonts/", $currentStyles);
						} else {
							$newStyles 						= str_replace("url('fonts/", "url('" . $dest_url . "/ts-vcsc-icons/custom-pack/fonts/", $currentStyles);
						}
						// Write the contents back to the file
						$file_put_contents 					= file_put_contents($styleCSS, $newStyles);
					}
				} else if ($upload_replace == 'on') {
					$basicCheck 	= false;
				}
				// Delete unecessary files / add error checking
				if (file_exists($dest_path . '/demo-files')) {
					TS_VCSC_RemoveDirectory($dest_path . '/demo-files');
				};
				if (file_exists($dest_path . '/demo.html')) {
					unlink($dest_path . '/demo.html'); 
				};
				if (file_exists($dest_path . '/Read Me.txt')) {
					unlink($dest_path . '/Read Me.txt'); 
				};
				if (file_exists($dest_path . '/variables.scss')) {
					unlink($dest_path . '/variables.scss'); 
				};
				if (($basicCheck == true) && ($filesFound == true)) {
					// Process JSON File to create and store Font Array
					$Custom_JSON_URL 								= $dest_url . '/ts-vcsc-custom-pack.json';
					// Add to Debug Message
					if ($upload_debugme == "on") {
						if (($upload_user != '') && ($upload_password != '')) {
							$upload_debugtxt 						.= 'Authorization: ' . $upload_user . ' / ' . $upload_password . '<br/>';
						} else {
							$upload_debugtxt 						.= 'Authorization: N/A<br/>';
						}
						$upload_debugtxt 							.= 'JSON Reference #1: ' . $dest_path . '/ts-vcsc-custom-pack.json' . '<br/>';
						$upload_debugtxt 							.= 'JSON Reference #2: ' . $Custom_JSON_URL . '<br/>';
					}
					// Load JSON File
					if ((function_exists('curl_init')) && ($upload_nocurl == "off")) {
						if ($upload_debugme == "on") {
							$upload_debugtxt 						.= 'JSON Retrieval Method: cURL<br/>';
						}
						$ch 										= curl_init();
						$timeout 									= 30;
						curl_setopt($ch, CURLOPT_URL, 				$Custom_JSON_URL);
						curl_setopt($ch, CURLOPT_HEADER,			0);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 	1);
						curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 	$timeout);
						curl_setopt($ch, CURLOPT_PROTOCOLS,			CURLPROTO_ALL);
						curl_setopt($ch, CURLOPT_HTTPAUTH, 			CURLAUTH_ANY);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 	0);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 	0);
						curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 	1);
						curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, 1);
						if (($upload_user != '') && ($upload_password != '')) {
							curl_setopt($ch, CURLOPT_USERPWD,	$upload_user . ":" . $upload_password);
						}
						curl_setopt($ch, CURLOPT_USERAGENT, 	'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
						if (curl_exec($ch) === false) {
							$Custom_JSON						= array();
							if ($upload_debugme == "on") {
								$upload_debugtxt 				.= 'cURL Error: ' . curl_error($ch) . '</br>';
							}
						} else {
							$Custom_JSON 						= curl_exec($ch);
						}
						curl_close($ch);
					} else if (ini_get('allow_url_fopen') == '1') {
						if ($upload_debugme == "on") {
							$upload_debugtxt 						.= 'JSON Retrieval Method: file_get_contents()<br/>';
						}
						if (($upload_user != '') && ($upload_password != '')) {
							$context = stream_context_create(array (
								'http' => array (
									'header' => 'Authorization: Basic ' . base64_encode("$upload_user:$upload_password")
								)
							));
							$Custom_JSON 							= file_get_contents($Custom_JSON_URL, false, $context);	
						} else {
							$Custom_JSON							= file_get_contents($Custom_JSON_URL);
						}
					}
					if (!is_wp_error($Custom_JSON) && !empty($Custom_JSON)) {
						
						//echo $Custom_JSON;
						
						$Custom_Code                        		= json_decode($Custom_JSON, true);
						$Custom_MultiColored						= "false";
						
						if ($upload_debugme == "on") {
							$upload_debugtxt						.= '<br/>';
							$upload_debugtxt 						.= 'CSS File URL #1: ' . $dest_url . '/style.css' . '<br/>';
							$upload_debugtxt 						.= 'CSS File URL #2: ' . str_replace(home_url(), '', $dest_url . '/style.css') . '<br/>';
						}
						//var_dump($Custom_Code);
						
						// Check for MultiColored Icons
						if (isset($Custom_Code['icons'])) {
							foreach ($Custom_Code['icons'] as $item) {
								if (isset($item['icon']['isMulticolor'])) {
									 if (($item['icon']['isMulticolor'] == true) || ($item['icon']['isMulticolor'] == "true")) {
										$Custom_MultiColored	= "true";
									}
								}
							}
						}

						if ((isset($Custom_Code['IcoMoonType'])) && (isset($Custom_Code['icons'])) && ($Custom_MultiColored == "false")){
							$TS_VCSC_Icons_Custom               = array();
							$TS_Custom_User_Font				= array();
							if (isset($Custom_Code['preferences']['fontPref']['prefix'])) {
								$Custom_Class_Prefix			= $Custom_Code['preferences']['fontPref']['prefix'];
							} else {
								$Custom_Class_Prefix			= "";
							}
							if (isset($Custom_Code['preferences']['fontPref']['postfix'])) {
								$Custom_Class_Postfix			= $Custom_Code['preferences']['fontPref']['postfix'];
							} else {
								$Custom_Class_Postfix			= "";
							}
							if (isset($Custom_Code['metadata']['name'])) {
								$Custom_Font_Name				= $Custom_Code['metadata']['name'];
							} else {
								$Custom_Font_Name				= "Unknown Font";
							}
							if (isset($Custom_Code['metadata']['designer'])) {
								$Custom_Font_Author             = $Custom_Code['metadata']['designer'];
							} else {
								$Custom_Font_Author				= "Unknown Author";
							}
							if (isset($Custom_Code['icons'])) {
								foreach ($Custom_Code['icons'] as $item) {
									if (isset($item['properties']['name']) && isset($item['properties']['code'])) {
										$Custom_Class_Full = $Custom_Class_Prefix . $item['properties']['name'] . $Custom_Class_Postfix;
										$Custom_Class_Code = $item['properties']['code'];
										$TS_Custom_User_Font[$Custom_Class_Full] = $Custom_Class_Code;
									}
								}
							}
							$TS_VCSC_Icons_Custom				= $TS_Custom_User_Font;
							if (count($TS_VCSC_Icons_Custom) > 1) {
								if (is_array($TS_VCSC_Icons_Custom)) {
									$TS_VCSC_tinymceCustomCount	= count(array_unique($TS_VCSC_Icons_Custom));
								} else {
									$TS_VCSC_tinymceCustomCount	= count($TS_VCSC_Icons_Custom);
								}
							} else {
								$TS_VCSC_tinymceCustomCount		= count($TS_VCSC_Icons_Custom);
							}
							// Export Font Array to PHP file
							/*if (ini_get('allow_url_fopen') == '1') {
								$phpArray 						= $dest_path . '/ts-vcsc-custom-pack.php';
								$file_put_contents 				= file_put_contents($phpArray, '<?php $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Icons_Custom = ' . var_export($TS_VCSC_Icons_Custom, true) . '; ?>');
							}*/
							// Store Custom Font Data in WordPress Settings
							update_option('ts_vcsc_extend_settings_tinymceCustom', 			1);							
							if ($upload_relative == 'on') {
								update_option('ts_vcsc_extend_settings_tinymceCustomJSON', 	$dest_url . '/ts-vcsc-custom-pack.json');
								update_option('ts_vcsc_extend_settings_tinymceCustomPath', 	$dest_url . '/style.css');
								update_option('ts_vcsc_extend_settings_tinymceCustomPHP', 	$dest_url . '/ts-vcsc-custom-pack.php');
							} else {
								update_option('ts_vcsc_extend_settings_tinymceCustomJSON', 	str_replace(home_url(), '', $dest_url . '/ts-vcsc-custom-pack.json'));
								//update_option('ts_vcsc_extend_settings_tinymceCustomPath', wp_make_link_relative($dest_url . '/style.css'));
								update_option('ts_vcsc_extend_settings_tinymceCustomPath', 	str_replace(home_url(), '', $dest_url . '/style.css'));
								update_option('ts_vcsc_extend_settings_tinymceCustomPHP', 	str_replace(home_url(), '', $dest_url . '/ts-vcsc-custom-pack.php'));
							}							
							update_option('ts_vcsc_extend_settings_tinymceCustomArray', 	$TS_VCSC_Icons_Custom);
							update_option('ts_vcsc_extend_settings_tinymceCustomName', 		ucwords($Custom_Font_Name));
							update_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 	ucwords($Custom_Font_Author));
							update_option('ts_vcsc_extend_settings_tinymceCustomCount', 	$TS_VCSC_tinymceCustomCount);
							update_option('ts_vcsc_extend_settings_tinymceCustomDate',		date('Y/m/d h:i:s A'));
							// Display Success Message / Disable File Upload Field
							echo '<script>
								jQuery(document).ready(function() {
									jQuery("#dropDownDownload").removeAttr("disabled");
									jQuery(".fontPackUploadedSuccess").parent("div").after("<div class=updated><p class=fontPackSuccessUnzip>Custom Font Pack successfully unzipped!</p></div>");
								});
							</script>';	 
							echo '<script>
								jQuery(document).ready(function() {
								jQuery(".fontPackSuccessUnzip").parent("div").after("<div class=updated><p>A Custom Font named &quot;' . ucwords($Custom_Font_Name) . '&quot; with ' . $TS_VCSC_tinymceCustomCount . ' icon(s) could be found and installed!</p></div>");
									setTimeout(function() {
										jQuery(".updated").fadeOut();
									}, 5000);
								});
							</script>';
							$output = "";
							$output .= "<div id='ts-vcsc-extend-preview' class=''>";
								$output .="<div id='ts-vcsc-extend-preview-name'>Font Name: " . ucwords($Custom_Font_Name) . "</div>";
								$output .="<div id='ts-vcsc-extend-preview-author'>Font Author: " . 	get_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 'Custom User') . "</div>";
								$output .="<div id='ts-vcsc-extend-preview-count'>Icon Count: " . 		get_option('ts_vcsc_extend_settings_tinymceCustomCount', 0) . "</div>";
								$output .="<div id='ts-vcsc-extend-preview-date'>Uploaded: " . 			get_option('ts_vcsc_extend_settings_tinymceCustomDate', '') . "</div>";
								$output .= "<div id='ts-vcsc-extend-preview-list' class=''>";
								$icon_counter = 0;
								if ((isset($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Icons_Custom)) && (is_array($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Icons_Custom))) {
									foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Icons_Custom as $key => $option ) {
										$font = explode('-', $key);
										$output .= "<div class='ts-vcsc-icon-preview ts-freewall-active' data-name='" . $key . "' data-code='" . $option . "' data-font='" . strtolower($iconfont) . "' data-count='" . $icon_counter . "' rel='" . $key . "'><span class='ts-vcsc-icon-preview-icon'><i class='" . $key . "'></i></span><span class='ts-vcsc-icon-preview-name'>" . $key . "</span></div>";
										$icon_counter = $icon_counter + 1;
									}
								}
								$output .= "</div>";
							$output .= "</div>";
							TS_VCSC_CustomFontImportMessages('success', 'Your Custom Font Pack has been successfully installed. ' . $upload_debugtxt . '');
						} else if ($Custom_MultiColored == "true") {
							TS_VCSC_ResetCustomFont();
							echo '<script>
								jQuery(document).ready(function() {
									jQuery(".fontPackUploadedSuccess").parent("div").after("<div class=error><p>This font includes dual- or multi-colored icons, which are not supported by WP Bakery Page Builder. Please use only standard (single) colored icons.</p></div>");
								});
							</script>';
							TS_VCSC_CustomFontImportMessages('warning', 'This font includes dual- or multi-colored icons, which are not supported by WP Bakery Page Builder. Please use only standard (single) colored icons. ' . $upload_debugtxt . '');
						} else {
							TS_VCSC_ResetCustomFont();
							echo '<script>
								jQuery(document).ready(function() {
									jQuery(".fontPackUploadedSuccess").parent("div").after("<div class=error><p>This font was not created with the IcoMoon App and/or is missing a valid JSON data file. Please upload only font packages created via IcoMoon.</p></div>");
								});
							</script>';
							TS_VCSC_CustomFontImportMessages('warning', 'This font was not created with the IcoMoon App and/or is missing a valid JSON data file. Please upload only font packages created via IcoMoon. ' . $upload_debugtxt . '');
						}
					} else {
						TS_VCSC_ResetCustomFont();
						echo '<script>
							jQuery(document).ready(function() {
								jQuery(".fontPackUploadedSuccess").parent("div").after("<div class=error><p>There was a problem while importing the custom font package file.</p></div>");
							});
						</script>';
						TS_VCSC_CustomFontImportMessages('warning', 'There was a problem while importing the custom font package file. ' . $upload_debugtxt . '');
					}
				} else {
					TS_VCSC_ResetCustomFont();
					if ($filesFound == false) {
						echo '<script>
							jQuery(document).ready(function() {
								jQuery(".fontPackUploadedSuccess").parent("div").after("<div class=error><p>There seems to be an issue with the read/write permissions of the upload folder; please check your server settings.</p></div>");
							});
						</script>';
						TS_VCSC_CustomFontImportMessages('warning', 'There seems to be an issue with the read/write permissions of the upload folder; please check your server settings. ' . $upload_debugtxt . '');
					} else {
						echo '<script>
							jQuery(document).ready(function() {
								jQuery(".fontPackUploadedSuccess").parent("div").after("<div class=error><p>This font package is missing a valid JSON data file and/or style.css file. In that case, please upload only complete font packages created via IcoMoon.</p></div>");
							});
						</script>';
						TS_VCSC_CustomFontImportMessages('warning', 'This font package is missing a valid JSON data file and/or style.css file. Please upload only complete font packages created via IcoMoon. ' . $upload_debugtxt . '');
					}
				}
			} else {
				TS_VCSC_ResetCustomFont();
				echo '<script>
					jQuery(document).ready(function() {
						jQuery(".fontPackUploadedSuccess").parent("div").after("<div class=error><p>There was a problem while unzipping the custom font package file.</p></div>");
					});
				</script>';
				TS_VCSC_CustomFontImportMessages('warning', 'There was a problem while unzipping the custom font package file. ' . $upload_debugtxt . '');
			}
		} else {
			TS_VCSC_ResetCustomFont();
			echo '<script>
				jQuery(document).ready(function() {
					jQuery(".ts-vcsc-custom-pack-buttons").after("<div class=error><p class=fontPackUploadedError>There was a problem while uploading the custom font package file.</p></div>");
				});
			</script>';
			TS_VCSC_CustomFontImportMessages('warning', 'There was a problem while uploading the custom font package.' . $upload_debugtxt . '');
		}
	}
?>
<div class="ts-vcsc-settings-group-header">
	<div class="display_header">
		<h2><span class="dashicons dashicons-upload"></span>Composium - WP Bakery Page Builder Extensions v<?php echo TS_VCSC_GetPluginVersion(); ?> ... Custom Icon Font Import</h2>
	</div>
	<div class="clear"></div>
</div>
<div class="ts-vcsc-custom-upload-wrap wrap" style="margin-top: 0px;">
	<div class="ts-vcsc-section-main">
		<div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-info"></i>General Information</div>
		<div class="ts-vcsc-section-content">
			<?php
				if (current_user_can('manage_options')) {
					echo '<div class="ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder" style="margin: 10px auto;">
						<span class="ts-advanced-link-tooltip-content">' . __("Click here to return to the plugins settings page.", "ts_visual_composer_extend") . '</span>
						<a href="' . $VISUAL_COMPOSER_EXTENSIONS->settingsLink . '" target="_parent" class="ts-advanced-link-button-main ts-advanced-link-button-grey ts-advanced-link-button-settings">'. __("Back to Settings", "ts_visual_composer_extend") . '</a>
					</div>';
				}
			?>	
			<p>Welcome to the "Composium - WP Bakery Page Builder Extensions" - Custom Icon Font Pack section! Use the importer below to import a custom icon pack downloaded from <a href="http://icomoon.io/app/#/select" target="_blank">IcoMoon</a>.</p>
			<div class="ts-vcsc-info-field ts-vcsc-warning" style="margin-top: 15px; margin-bottom: 10px; font-size: 13px; text-align: justify;">
				The custom icon font that you can import using the controls below, will only be available in elements that are part of this add-on (provided, said elements can utilize an icon font), but will NOT be available in
				elements that are part of WP Bakery Page Builder itself, or elements that are provided by other add-ons and/or your theme.
			</div>	
			<div id="ts_vcsc_icons_upload_system_trigger" class="clearFixMe" style="margin-top: 10px;">
				<div class="ts-vcsc-notice-field ts-vcsc-info" style="margin-top: 15px; margin-bottom: 10px; font-size: 13px; text-align: justify;">
					Please ensure that your server is supporting and providing the following functions or features: cURL / allow_url_fopen / file_get_contents / file_put_contents / unzip_file.
				</div>
				<div class="ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder" style="margin-top: 10px; margin-bottom: 10px;">
					<span class="ts-advanced-link-tooltip-content"><?php echo __("Click here to see the results of your system check in regards to the icon font import routine.", "ts_visual_composer_extend"); ?></span>
					<button type="button" id="ts_vcsc_icons_upload_system_button" data-show="<?php _e("Show System Check", "ts_visual_composer_extend"); ?>" data-hide="<?php _e("Hide System Check", "ts_visual_composer_extend"); ?>" class="ts-advanced-link-button-main ts-advanced-link-button-turquoise ts-advanced-link-button-system">
						<?php _e("Show System Check", "ts_visual_composer_extend"); ?>
					</button>
				</div>
			</div>			
			<div id="ts_vcsc_icons_upload_system_check" style="display: none; padding-top: 20px; padding-bottom: 20px;">
				<div class="ts-vcsc-notice-field ts-vcsc-critical" style="margin-top: 0; margin-bottom: 20px; font-size: 13px; text-align: justify;">
					This is just a basic system check to see if the main requirements are fulfilled in order to use the font upload feature. The check itself is no guaranty for a successful upload as there are other factors involved that can influence the procedure.
				</div>
				<?php
					WP_Filesystem();
					$dest 				= wp_upload_dir();
					$dest_path 			= $dest['path'];
					echo 'Target Directory: ' . $dest_path . '<br/><br/>';
					if (strnatcmp(phpversion(), '5.2') >= 0)  {
						echo '<div style="width: 150px; float: left;">PHP Version of 5.2+:</div><span style="font-weight: bold; color: green;">' . phpversion() . '</span><br/>';
					} else {
						echo '<div style="width: 150px; float: left;">PHP Version of 5.2+:</div><span style="font-weight: bold; color: red;">' . phpversion() . '</span><br/>';
					}
					if (is_writable($dest_path)) {
						echo '<div style="width: 150px; float: left;">Directory writeable:</div><span style="font-weight: bold; color: green;">true</span><br/>';
					} else {
						echo '<div style="width: 150px; float: left;">Directory writeable:</div><span style="font-weight: bold; color: red;">false</span><br/>';
					}
					if  (in_array  ('curl', get_loaded_extensions())) {
						echo '<div style="width: 150px; float: left;">cURL enabled:</div><span style="font-weight: bold; color: green;">true</span><br/>';
					} else {
						echo '<div style="width: 150px; float: left;">cURL enabled:</div><span style="font-weight: bold; color: red;">false</span><br/>';
					}
					if( ini_get('allow_url_fopen') ) {
						echo '<div style="width: 150px; float: left;">allow_url_fopen:</div><span style="font-weight: bold; color: green;">true</span><br/>';
					} else {
						echo '<div style="width: 150px; float: left;">allow_url_fopen:</div><span style="font-weight: bold; color: red;">false</span><br/>';
					}
					if( function_exists('file_get_contents') ) {
						echo '<div style="width: 150px; float: left;">file_get_contents:</div><span style="font-weight: bold; color: green;">true</span><br/>';
					} else {
						echo '<div style="width: 150px; float: left;">file_get_contents:</div><span style="font-weight: bold; color: red;">false</span><br/>';
					}
					if( function_exists('file_put_contents') ) {
						echo '<div style="width: 150px; float: left;">file_put_contents:</div><span style="font-weight: bold; color: green;">true</span><br/>';
					} else {
						echo '<div style="width: 150px; float: left;">file_put_contents:</div><span style="font-weight: bold; color: red;">false</span><br/>';
					}
					if( function_exists('unzip_file') ) {
						echo '<div style="width: 150px; float: left;">unzip_file:</div><span style="font-weight: bold; color: green;">true</span><br/>';
					} else {
						echo '<div style="width: 150px; float: left;">unzip_file:</div><span style="font-weight: bold; color: red;">false</span><br/>';
					}
				?>
			</div>
		</div>
	</div>
	<div class="ts-vcsc-section-main">
		<div class="ts-vcsc-section-title ts-vcsc-section-hide"><i class="dashicons-format-video"></i>How to build a Custom Icon Font</div>
		<div class="ts-vcsc-section-content slideFade" style="display: none;">				
			<div class="ts-vcsc-notice-field ts-vcsc-success" style="margin-top: 10px; font-size: 13px; text-align: justify;">
				You can only upload a custom icon font that has been created and processed with the online IcoMoon App. That is necesseary because IcoMoon is including a custom JSON file with its font packages, which include
				all the information necessary for the plugin to "read" the font data and to add it to its internal databank.
			</div>	
			<div style="width: 50%; height: 100%;">
				<div class="ts-video-container">
					<iframe style="width: 100%;" width="100%" height="100%" src="//www.youtube.com/embed/XA03oGOhtXk" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>		
	<div class="ts-vcsc-section-main">
		<div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-upload"></i>Custom Font Upload</div>
		<div class="ts-vcsc-section-content clearFixMe">
			<script>				
				jQuery(document).ready(function() {
					setTimeout(function() {	
						var fontNameString 			= 'ts-vcsc-custom-pack';
						var newfontNameString 		= fontNameString.replace("Font Name:","");
						var customPackFontName 		= newfontNameString.split("(")[0];
						var customPackFontName 		= jQuery.trim(customPackFontName);
						jQuery('.downloadFontZipLink').parent('li').find('img').remove();
						jQuery('.downloadFontZipLink').text('Download ' + customPackFontName + '.zip');
						jQuery('.downloadFontjSonLink').parent('li').find('img').remove();
						jQuery('.downloadFontjSonLink').text('Download ' + customPackFontName + '.json');
					}, 2000);
				});
			</script>
			<!-- Handling Custom Font Pack Uploads -->
			<form id="ts_vcsc_icons_upload_custom_pack_form" enctype="multipart/form-data" action="" method="POST">
				<div id="ts-vcsc-async-upload-wrap" class="clearFixMe" style="margin-bottom:0;">
					<!-- Check Existing Upload -->
					<?php
						if (file_exists($dest_path . '/ts-vcsc-custom-pack.zip') == false) {
							$custom_package_exists = "false";
						} else {
							$custom_package_exists = "true";
						}
					?>
					<!-- File Import Field -->
					<?php
						if ($custom_package_exists == "false") {
							echo '<div class="ts-vcsc-notice-field ts-vcsc-success" style="margin-top: 10px; margin-bottom: 10px; font-size: 13px; text-align: justify;">
								You should have received a .zip file from IcoMoon, containing the font information. Please upload the original file as you received it; do NOT unzip it yourself or recompress prior to uploading it!
							</div>';
						}
					?>
					<div id="ts-custom-iconfont-import-upload" class="ts-custom-iconfont-import-upload" style="display: block; margin-top: 10px; margin-bottom: 20px;">
						<div id="ts-custom-iconfont-import-box" class="ts-custom-iconfont-import-box">
							<input type="file" accept=".zip" name="custom_icon_pack" id="ts-custom-iconfont-import-file" class="ts-custom-iconfont-import-file"/>
							<label id="ts-custom-iconfont-import-label" class="ts-custom-iconfont-import-label" for="ts-custom-iconfont-import-file" style="display: inline-block;">
								<span id="ts-custom-iconfont-import-name" class="ts-custom-iconfont-import-name"></span>
								<span id="ts-custom-iconfont-import-select" class="ts-custom-iconfont-import-select ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder">
									<span class="ts-advanced-link-tooltip-content"><?php echo __("Click here to select the ZIP file containing the icon font to be imported from your computer.", "ts_visual_composer_extend"); ?></span>
									<span class="ts-advanced-link-button-main ts-advanced-link-button-red ts-advanced-link-button-archive" style="margin: 0;">
										<?php echo __("Select ZIP File", "ts_visual_composer_extend"); ?>
									</span>
								</span>
							</label>
						</div>
					</div>
					<div id="ts-vcsc-custom-pack-settings" class="ts-vcsc-custom-pack-settings" style="width:100%; display: block;">
						<!-- Package Path -->
						<?php
							if ($custom_package_exists == "true") {
								$fontPackLocationString = 'Your Custom Icon Pack is located in: '; 
							} else {
								$fontPackLocationString = 'Your Custom Icon Pack will be installed to: ';
							}
						?>
						<div style="margin: 10px 0 10px 0; font-size: 12px; display: block;">
							<?php echo $fontPackLocationString . '<b>' . $dest_path . '</b>'; ?>.
						</div>
						<!-- Import Settings -->
						<div class="ts-vcsc-custom-pack-overwrite" style="display: block; width: 100%; margin-top: 10px; margin-bottom: 10px;">
							<input type="checkbox" id="ts_vcsc_custom_pack_replace" class="ts_vcsc_custom_pack_replace" name="ts_vcsc_custom_pack_replace" checked="checked">
							<label id="ts_vcsc_custom_pack_replace_label" class="" for="ts_vcsc_custom_pack_replace"><span>Replace Path Names inside Imported CSS File</span></label>
						</div>
						<div class="ts-vcsc-custom-pack-overwrite" style="display: block; width: 100%; margin-top: 10px; margin-bottom: 10px;">
							<input type="checkbox" id="ts_vcsc_custom_pack_relative" class="ts_vcsc_custom_pack_relative" name="ts_vcsc_custom_pack_relative" checked="checked">
							<label id="ts_vcsc_custom_pack_relative_label" class="" for="ts_vcsc_custom_pack_relative"><span>Use Absolute Path Names for Imported Files</span></label>
						</div>
						<div class="ts-vcsc-custom-pack-overwrite" style="display: block; width: 100%; margin-top: 10px; margin-bottom: 10px;">
							<input type="checkbox" id="ts_vcsc_custom_pack_debug" class="ts_vcsc_custom_pack_debug" name="ts_vcsc_custom_pack_debug">
							<label id="ts_vcsc_custom_pack_debug_label" class="" for="ts_vcsc_custom_pack_debug"><span>Show Debug Information</span></label>
						</div>
						<div class="ts-vcsc-custom-pack-overwrite" style="display: block; width: 100%; margin-top: 10px; margin-bottom: 10px;">
							<input type="checkbox" id="ts_vcsc_custom_pack_nocurl" class="ts_vcsc_custom_pack_nocurl" name="ts_vcsc_custom_pack_nocurl">
							<label id="ts_vcsc_custom_pack_nocurl_label" class="" for="ts_vcsc_custom_pack_nocurl"><span>Force "file_get_contents" over "cURL"</span></label>
						</div>
						<!-- Authorization Settings -->
						<div id="ts-vcsc-custom-pack-authorization-message" class="ts-vcsc-notice-field ts-vcsc-warning" style="margin-top: 20px; font-size: 13px; text-align: justify;">
							If your server requires authorization in order to load/open any files (for example, because it is a non-public staging/development server), you can provide those credentials here, as the plugin might
							otherwise not be able to read the imported JSON file that contains the icon definitions. Otherwise, leave the inputs empty.
						</div>		
						<div class="ts-vcsc-custom-pack-authorization" style="display: block; width: 100%; margin-top: 10px; margin-bottom: 10px;">
							<label id="ts_vcsc_custom_pack_user_label" class="" for="ts_vcsc_custom_pack_user"><span>Authorization: User Name</span></label>
							<input type="text" id="ts_vcsc_custom_pack_user" class="ts_vcsc_custom_pack_user" name="ts_vcsc_custom_pack_user">								
						</div>
						<div class="ts-vcsc-custom-pack-authorization" style="display: block; width: 100%; margin-top: 10px; margin-bottom: 10px;">
							<label id="ts_vcsc_custom_pack_password_label" class="" for="ts_vcsc_custom_pack_password"><span>Authorization: Password</span></label>
							<input type="text" id="ts_vcsc_custom_pack_password" class="ts_vcsc_custom_pack_password" name="ts_vcsc_custom_pack_password">								
						</div>
						<!-- Uninstall Message -->
						<?php if ($custom_package_exists == "true") { ?>
							<br/><span style="color: red;">If you have problems uninstalling the font pack, manually delete the "custom-pack" folder (following the path provided above) via FTP.</span></p>
						<?php } ?>
					</div>
					<div id="ts-vcsc-custom-pack-buttons" class="ts-vcsc-custom-pack-buttons">
						<div style="float: left;">
							<div class="ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder">
								<span class="ts-advanced-link-tooltip-content"><?php _e("Click here to import the selected icon font package.", "ts_visual_composer_extend"); ?></span>
								<button type="submit" name="Submit" id="ts_vcsc_import_font_submit" class="ts-advanced-link-button-main ts-advanced-link-button-blue ts-advanced-link-button-import" style="margin: 0;">
									<?php _e("Import Font", "ts_visual_composer_extend"); ?>
								</button>
							</div>							
						</div>
						<div style="margin-left: 20px; float: left;">
							<div class="ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder">
								<span class="ts-advanced-link-tooltip-content"><?php _e("Click here to uninstall the imported icon font package.", "ts_visual_composer_extend"); ?></span>
								<button type="button" id="uninstall-pack-button" onclick="TS_VCSC_UninstallFontPack(); return false;" class="ts-advanced-link-button-main ts-advanced-link-button-red ts-advanced-link-button-delete" style="margin: 0;">
									<?php _e("Uninstall Font", "ts_visual_composer_extend"); ?>
								</button>
							</div>							
							<?php
								$dest 		= wp_upload_dir();
								$dest_url 	= $dest['url'];
								$dest_path 	= $dest['path'];
							?>
						</div> 
						<div style="margin-left: 20px; float: left;">
							<div class="ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder">
								<span class="ts-advanced-link-tooltip-content"><?php _e("Click here to download the imported icon font package.", "ts_visual_composer_extend"); ?></span>
								<button type="button" id="dropDownDownload" disabled value="Dropdown" data-dropdown="#ts-dropdown-1" class="ts-advanced-link-button-main ts-advanced-link-button-green ts-advanced-link-button-export" style="margin: 0;">
									<?php _e("Download Font", "ts_visual_composer_extend"); ?>
								</button>
								<!-- jQuery Download Dropdown Menu -->
								<div id="ts-dropdown-1" style="" class="ts-dropdown ts-dropdown-anchor-left ts-dropdown-tip ts-dropdown-relative">
									<ul class="ts-dropdown-menu">
										<li><a title="This .zip file contains the original files you uploaded with your icon pack." class="downloadFontZipLink" href="<?php echo $dest_url.'/ts-vcsc-custom-pack.zip'; ?>"></a><img src="<?php echo site_url().'/wp-admin/images/wpspin_light.gif'?>" alt="preloader"></li>
										<li class="ts-dropdown-divider"></li>
										<li><a title="You can use this .json file to export your custom pack back into IcoMoon and then add or remove icons as you please." class="downloadFontjSonLink" download="ts-vcsc-custom-pack.json" href="<?php echo $dest_url.'/ts-vcsc-custom-pack.json'; ?>"></a><img src="<?php echo site_url().'/wp-admin/images/wpspin_light.gif'?>" alt="preloader"></li>
									</ul>
								</div>
							</div>						
						</div>
					</div>
					<!-- Display success or error message after font pack deletion -->
					<p id="delete_succes_and_error_message" style="display: none;"></p>
					<p id="unzip_succes_and_error_message" style="display: none;"></p>
				</div>
			</form>
			<?php if ($custom_package_exists == "true") { ?>
				<hr class="style-six" style="margin-top: 20px; margin-bottom: 20px;">
			<?php } ?>
			<div class="current-font-pack" style="float:left; width: 100%; display: block;">
				<img style="display: none;" class="ts-vcsc-custom-pack-preloader" src="<?php echo site_url().'/wp-admin/images/wpspin_light.gif'?>" alt="preloader">
				<div id="current-font-pack-preview" class="current-font-pack-preview"></div>
			</div>
		</div>
	</div>
</div>