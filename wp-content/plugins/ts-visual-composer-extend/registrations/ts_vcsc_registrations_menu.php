<?php
    global $VISUAL_COMPOSER_EXTENSIONS;

    // Create Custom Admin Menu for Plugin
    add_action('admin_menu', 'TS_VCSC_SyncMenu', 9999);
    function TS_VCSC_SyncMenu() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        global $ts_vcsc_main_page;
        global $ts_vcsc_settings_page;
        global $ts_vcsc_update_page;
        global $ts_vcsc_upload_page;
        global $ts_vcsc_preview_page;
        global $ts_vcsc_generator_page;
        global $ts_vcsc_customCSS_page;
        global $ts_vcsc_customJS_page;
        global $ts_vcsc_system_page;
        global $ts_vcsc_transfer_page;
        global $ts_vcsc_license_page;
        global $ts_vcsc_team_page;
        global $ts_vcsc_about_page;
        global $ts_vcsc_google_fonts;
        global $ts_vcsc_custom_fonts;
        global $ts_vcsc_enlighterjs_page;
        global $ts_vcsc_downtime_page;
        global $ts_vcsc_sidebars_page;
        global $ts_vcsc_statistics_page;
        if (get_option('ts_vcsc_extend_settings_mainmenu', 1) == 1) {
            $ts_vcsc_main_page = 		        add_menu_page(      "Composium",            "Composium",            'manage_options', 	    'TS_VCSC_Extender', 	'TS_VCSC_PageExtend', 	    TS_VCSC_GetResourceURL('images/logos/ts_vcsc_menu_icon_light.svg'),     '79.123456789');
        } else {
            $ts_vcsc_main_page = 		        add_options_page(   "Composium",            "Composium",            'manage_options', 	    'TS_VCSC_Extender', 	'TS_VCSC_PageExtend');
        }
        $ts_vcsc_settings_page = 				add_submenu_page( 	'TS_VCSC_Extender', 	"Settings",             "Settings",         	'manage_options', 	'TS_VCSC_Extender', 	'TS_VCSC_PageExtend');
        if ((($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginExtended == "true") && (get_option('ts_vcsc_extend_settings_fontimport', 1) == 1)) || (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginExtended == "false"))) {
            $ts_vcsc_upload_page = 				add_submenu_page( 	'TS_VCSC_Extender', 	"Import Font",          "Import Icon Font",     'manage_options', 	'TS_VCSC_Uploader', 	'TS_VCSC_PageUpload');
        }
        $ts_vcsc_preview_page = 				add_submenu_page( 	'TS_VCSC_Extender', 	"Icon Previews",        "Icon Previews",    	'manage_options', 	'TS_VCSC_Previews', 	'TS_VCSC_PagePreview');
        if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconicumStandard == "false") {
            if (get_option('ts_vcsc_extend_settings_useMenuGenerator', 0) == 1) {
                $ts_vcsc_generator_page =		add_submenu_page( 	'TS_VCSC_Extender', 	"Icon Generator",       "Icon Generator",		'manage_options', 	'TS_VCSC_Generator', 	'TS_VCSC_PageGenerator');
            }
        }
        if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseGoogleFontManager == "true") {
            $ts_vcsc_google_fonts =             add_submenu_page( 	'TS_VCSC_Extender', 	"Google Fonts",         "Google Fonts",    	    'manage_options', 	'TS_VCSC_GoogleFonts', 	'TS_VCSC_PageGoogleFonts');
        }
        if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseCustomFontManager == "true") {
            $ts_vcsc_custom_fonts =             add_submenu_page( 	'TS_VCSC_Extender', 	"Custom Fonts",         "Custom Fonts",    	    'manage_options', 	'TS_VCSC_CustomFonts', 	'TS_VCSC_PageCustomFonts');
        }
        if (($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseEnlighterJS == "true") && ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseThemeBuilder == "true")) {
            $ts_vcsc_enlighterjs_page =         add_submenu_page( 	'TS_VCSC_Extender', 	"EnlighterJS Theme",   "EnlighterJS Theme",     'manage_options', 	'TS_VCSC_EnlighterJS', 	'TS_VCSC_PageEnlighterJS');
        }
        if (current_user_can('manage_options')) {
            if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CustomPostTypesDownpage == "true") {
                $ts_vcsc_downtime_page =         add_submenu_page( 	'TS_VCSC_Extender', 	"Downtime Manager",     "Downtime Manager",     'manage_options', 	'TS_VCSC_Downtime', 	'TS_VCSC_PageDowntime');
            }
            if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UseSidebarsManager == "true") {
                $ts_vcsc_sidebars_page =        add_submenu_page( 	'TS_VCSC_Extender', 	"Sidebars Manager",     "Sidebars Manager",     'manage_options', 	'TS_VCSC_Sidebars', 	'TS_VCSC_PageSidebars');
            }
            if ((($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginExtended == "true") && (get_option('ts_vcsc_extend_settings_codeeditors', 1) == 1)) || ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginExtended == "false")) {
                $ts_vcsc_customCSS_page =		add_submenu_page( 	'TS_VCSC_Extender', 	"Custom CSS", 	        "Custom CSS",       	'manage_options', 	'TS_VCSC_CSS', 			'TS_VCSC_PageCustomCSS');
                $ts_vcsc_customJS_page =		add_submenu_page( 	'TS_VCSC_Extender', 	"Custom JS", 	        "Custom JS",        	'manage_options', 	'TS_VCSC_JS', 			'TS_VCSC_PageCustomJS');
            }
            if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_UserIsAdministrator == "true") {
                $ts_vcsc_statistics_page =      add_submenu_page( 	'TS_VCSC_Extender', 	"Usage Statistics",     "Usage Statistics",     'manage_options', 	'TS_VCSC_Usage', 		'TS_VCSC_PageUsage');            
            }
            $ts_vcsc_system_page =				add_submenu_page( 	'TS_VCSC_Extender', 	"System Info", 	        "System Info",      	'manage_options', 	'TS_VCSC_System', 		'TS_VCSC_SystemInfo');
            if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginExtended == "false") {
                $ts_vcsc_license_page =			add_submenu_page( 	'TS_VCSC_Extender', 	"License Key", 	        "License Key",      	'manage_options', 	'TS_VCSC_License', 		'TS_VCSC_PageLicense');
            }
            $ts_vcsc_transfer_page =			add_submenu_page( 	'TS_VCSC_Extender', 	"Transfer Settings",    "Transfer Settings",    'manage_options', 	'TS_VCSC_Transfers', 	'TS_VCSC_PageTransfers');
        }
        $ts_vcsc_about_page =			        add_submenu_page( 	'TS_VCSC_Extender', 	"About Composium",      "About Composium",      'manage_options', 	'TS_VCSC_About', 	    'TS_VCSC_PageAbout');
        // Define Position of Plugin Menu
        if (get_option('ts_vcsc_extend_settings_mainmenu', 1) == 1) {
            $VISUAL_COMPOSER_EXTENSIONS->settingsLink = "admin.php?page=TS_VCSC_Extender";
        } else {
            $VISUAL_COMPOSER_EXTENSIONS->settingsLink = "options-general.php?page=TS_VCSC_Extender";
        }			
    }

    function TS_VCSC_PageExtend() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {
            echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr;">' . "\n";
                include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_settings_main.php');
            echo '</div>' . "\n";
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_PageUpload() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {
            echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 25px;">' . "\n";
                include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_upload.php');
            echo '</div>' . "\n";	
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_PagePreview() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {
            echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 25px;">' . "\n";
                include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_previews.php');
            echo '</div>' . "\n";	
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_PageGenerator() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {
            echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 25px;">' . "\n";
                include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_generator.php');
            echo '</div>' . "\n";	
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_PageCustomCSS() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {
            // Get Stored Custom CSS; otherwise assign Default Message
            $ts_vcsc_extend_custom_css_default 	= get_option('ts_vcsc_extend_settings_customCSS');
            $ts_vcsc_extend_custom_css 			= get_option('ts_vcsc_extend_custom_css', $ts_vcsc_extend_custom_css_default);
            if (empty($ts_vcsc_extend_custom_css)) {
                $ts_vcsc_extend_custom_css		= $ts_vcsc_extend_custom_css_default;
            }
            if (isset($_GET['settings-updated']) && $_GET['settings-updated']) {
                echo "\n";
                echo "<script type='text/javascript'>" . "\n";
                    echo 'var VC_Extension_Demo	= false;' . "\n";
                    echo "var CustomCSSAdded = true;" . "\n";
                echo "</script>" . "\n";
            } else {
                echo '<script type="text/javascript">' . "\n";
                    echo 'var VC_Extension_Demo = false;' . "\n";
                    echo 'var CustomCSSAdded = false;' . "\n";
                echo '</script>' . "\n";
            }
            ?>
            <div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 0px;">
                <div class="ts-vcsc-settings-group-header" style="margin-top: 25px;">
                    <div class="display_header">
                        <h2><span class="dashicons dashicons-media-code"></span>Composium - WP Bakery Page Builder Extensions v<?php echo TS_VCSC_GetPluginVersion(); ?> ... Custom CSS Editor</h2>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="ts-vcsc-custom-code-wrap" style="margin-top: 0px;">
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
                            <table>
                                <tr style="height: 75px; width: 100%;">
                                    <td>
                                        <div class="ts-vcsc-notice-field ts-vcsc-success" style="margin-top: 10px; font-size: 13px; text-align: justify;">
                                            In order to adjust the plugins CSS to your theme, please use the Custom CSS Editor below and do not change the CSS file that comes with the
                                            plugin. Direct changes to the CSS file will be lost after each update but the Custom CSS entered here will be stored in the WordPress Database and will remain after each
                                            update.
                                        </div>
                                        <p style="text-align: justify; font-weight: bold;">While the Editor will do some basic checking, you are responsible to ensure that all code has been entered correctly.</p>
                                        <div class="ts-vcsc-notice-field ts-vcsc-warning" style="margin-top: 10px; font-size: 13px; text-align: justify;">
                                            The custom CSS code entered here will be used on all pages that utilize an element or feature of "Composium - WP Bakery Page Builder Extensions". If you want to limit your custom code to one page only, you should use the code editor that is provided by WP Bakery Page Builder itself (click on the cog-wheel icon at the top-right corner of the WP Bakery Page Builder page section).
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td colspan="2"><p style="margin-top: 0px;">The plugin will automatically wrap the code in ...<br/></td>
                                </tr>
                                <tr>
                                    <td style="width: 80px;"><img style='float: left; width: 75px; height: 75px;' src='<?php echo TS_VCSC_GetResourceURL('images/other/settings-custom-css.png'); ?>' height='75' width='75'></td>
                                    <td>
                                        <p>
                                            <code style="text-align: left;">
                                                &#60;style&#62;<br/>
                                                    <span style="margin-left: 20px;">... Your Custom CSS ...</span><br/>
                                                &#60;/style&#62;
                                            </code>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><p style="margin-top: 0px;">... so please don't add these lines to the editor; otherwise your code will fail.</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="ts-vcsc-section-main">
                        <div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-media-code"></i>Custom CSS Code Editor</div>
                        <div class="ts-vcsc-section-content">
                            <form id="ts_vcsc_extend_custom_css_form" method="post" action="options.php" style="margin-top: 15px;">                              
                                <div class="ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder">
                                    <span class="ts-advanced-link-tooltip-content"><?php _e("Click here to save your custom CSS code.", "ts_changelog_organizer"); ?></span>
                                    <button type="submit" name="Submit" id="ts_vcsc_extend_settings_submit_1" class="ButtonSubmit ts-advanced-link-button-main ts-advanced-link-button-blue ts-advanced-link-button-code" style="margin: 0;">
                                        <?php _e("Save Custom CSS", "ts_changelog_organizer"); ?>
                                    </button>
                                </div>                                
                                <?php settings_fields('ts_vcsc_extend_custom_css'); ?>
                                <div id="ts_fb_custom_css_container">
                                    <div id="ts_vcsc_extend_custom_css" name="ts_vcsc_extend_custom_css"></div>
                                </div>
                                <textarea id="ts_vcsc_extend_custom_css_textarea" name="ts_vcsc_extend_custom_css" style="display: none;"><?php echo $ts_vcsc_extend_custom_css; ?></textarea>
                                <div class="ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder" style="margin-bottom: 10px;">
                                    <span class="ts-advanced-link-tooltip-content"><?php _e("Click here to save your custom CSS code.", "ts_changelog_organizer"); ?></span>
                                    <button type="submit" name="Submit" id="ts_vcsc_extend_settings_submit_2" class="ButtonSubmit ts-advanced-link-button-main ts-advanced-link-button-blue ts-advanced-link-button-code" style="margin: 0;">
                                        <?php _e("Save Custom CSS", "ts_changelog_organizer"); ?>
                                    </button>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_PageCustomJS() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {
            // Get Stored Custom JS; otherwise assign Default Message
            $ts_vcsc_extend_custom_js_default 	= get_option('ts_vcsc_extend_settings_customJS');
            $ts_vcsc_extend_custom_js 			= get_option('ts_vcsc_extend_custom_js', $ts_vcsc_extend_custom_js_default);
            if (empty($ts_vcsc_extend_custom_js)) {
                $ts_vcsc_extend_custom_js		= $ts_vcsc_extend_custom_js_default;
            }
            if (isset($_GET['settings-updated']) && $_GET['settings-updated']) {
                echo "\n";
                echo "<script type='text/javascript'>" . "\n";
                    echo 'var VC_Extension_Demo = false;' . "\n";
                    echo "var CustomJSAdded = true;" . "\n";
                echo "</script>" . "\n";
            } else {
                echo '<script type="text/javascript">' . "\n";
                    echo 'var VC_Extension_Demo = false;' . "\n";
                    echo 'var CustomJSAdded = false;' . "\n";
                echo '</script>' . "\n";
            }
            ?>
            <div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 0px;">
                <div class="ts-vcsc-settings-group-header" style="margin-top: 25px;">
                    <div class="display_header">
                        <h2><span class="dashicons dashicons-media-code"></span>Composium - WP Bakery Page Builder Extensions v<?php echo TS_VCSC_GetPluginVersion(); ?> ... Custom JS Editor</h2>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="ts-vcsc-custom-code-wrap" style="margin-top: 0px;">
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
                            <table>
                                <tr>
                                    <td style="height: 75px; width: 100%;">
                                        <div class="ts-vcsc-notice-field ts-vcsc-success" style="margin-top: 10px; font-size: 13px; text-align: justify;">
                                            In order to add some custom JavaScript Code to the an element (i.e. for custom lightbox, etc.), please use the Custom JS Editor below and do not
                                            change the JS files that comes with the plugin. Direct changes to the JS files will be lost after each update but the Custom JS entered here will be stored in the WordPress
                                            Database and will remain after each update.
                                        </div>
                                        <p style="text-align: justify; font-weight: bold;">While the Editor will do some basic checking, you are responsible to ensure that all code has been entered correctly.</p>
                                        <div class="ts-vcsc-notice-field ts-vcsc-warning" style="margin-top: 10px; font-size: 13px; text-align: justify;">
                                            The custom JS code entered here will be used on all pages that utilize an element or feature of "Composium - WP Bakery Page Builder Extensions". If you want to limit your custom code to one page only, you should use the code editor that is provided by WP Bakery Page Builder itself (click on the cog-wheel icon at the top-right corner of the WP Bakery Page Builder page section).
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td colspan="2"><p style="margin-top: 0px;">The plugin will automatically wrap the code in ...<br/></td>
                                </tr>
                                <tr>
                                    <td style="width: 80px;"><img style='float: left; width: 75px; height: 75px;' src='<?php echo TS_VCSC_GetResourceURL('images/other/settings-custom-js.png'); ?>' height='75' width='75'></td>
                                    <td>
                                        <p>
                                            <code style="text-align: left;">
                                                &#60;script type="text/javascript"&#62;<br/>
                                                <span style="margin-left: 20px;">(function ($) {</span><br/>
                                                    <span style="margin-left: 40px;">... Your Custom JS ...</span><br/>
                                                <span style="margin-left: 20px;">})(jQuery);</span><br/>
                                                &#60;/script&#62;
                                            </code>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><p style="margin-top: 0px;">... so please don't add these lines to the editor; otherwise your code will fail. You can also use jQuery for your custom code.</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="ts-vcsc-section-main">
                        <div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-media-code"></i>Custom JS Code Editor</div>
                        <div class="ts-vcsc-section-content">
                            <form id="ts_vcsc_extend_custom_js_form" method="post" action="options.php" style="margin-top: 15px;">
                                <div class="ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder">
                                    <span class="ts-advanced-link-tooltip-content"><?php _e("Click here to save your custom JS code.", "ts_changelog_organizer"); ?></span>
                                    <button type="submit" name="Submit" id="ts_vcsc_extend_settings_submit_1" class="ButtonSubmit ts-advanced-link-button-main ts-advanced-link-button-blue ts-advanced-link-button-code" style="margin: 0;">
                                        <?php _e("Save Custom JS", "ts_changelog_organizer"); ?>
                                    </button>
                                </div>
                                <?php settings_fields('ts_vcsc_extend_custom_js'); ?>
                                <div id="ts_vcsc_extend_custom_js_container">
                                    <div id="ts_vcsc_extend_custom_js" name="ts_vcsc_extend_custom_js"></div>
                                </div>
                                <textarea id="ts_vcsc_extend_custom_js_textarea" name="ts_vcsc_extend_custom_js" style="display: none;"><?php echo $ts_vcsc_extend_custom_js; ?></textarea>
                                <div class="ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder" style="margin-bottom: 10px;">
                                    <span class="ts-advanced-link-tooltip-content"><?php _e("Click here to save your custom JS code.", "ts_changelog_organizer"); ?></span>
                                    <button type="submit" name="Submit" id="ts_vcsc_extend_settings_submit_1" class="ButtonSubmit ts-advanced-link-button-main ts-advanced-link-button-blue ts-advanced-link-button-code" style="margin: 0;">
                                        <?php _e("Save Custom JS", "ts_changelog_organizer"); ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_PageTransfers() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {			
            echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 25px;">' . "\n";
                include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_transfers.php');
            echo '</div>' . "\n";				
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_PageUsage() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {			
            echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 25px;">' . "\n";
                include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_statistics.php');
            echo '</div>' . "\n";				
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_SystemInfo() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {			
            echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 25px;">' . "\n";
                include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_system_info.php');
            echo '</div>' . "\n";				
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_PageLicense() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {		
            echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 25px;">' . "\n";
                include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_license.php');
            echo '</div>' . "\n";	
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_PageAbout() {
        global $VISUAL_COMPOSER_EXTENSIONS;	
        echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 25px;">' . "\n";
            include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_about.php');
        echo '</div>' . "\n";
    }
    function TS_VCSC_PageGoogleFonts() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {		
            echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 25px;">' . "\n";
                include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_fontsgoogle.php');
            echo '</div>' . "\n";	
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_PageCustomFonts() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {		
            echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 25px;">' . "\n";
                include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_fontscustom.php');
            echo '</div>' . "\n";	
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_PageEnlighterJS() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {		
            echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 25px;">' . "\n";
                include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_enlighterjs.php');
            echo '</div>' . "\n";	
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_PageDowntime() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {		
            echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 25px;">' . "\n";
                include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_downpage.php');
            echo '</div>' . "\n";	
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
    function TS_VCSC_PageSidebars() {
        global $VISUAL_COMPOSER_EXTENSIONS;
        if (current_user_can('manage_options')) {		
            echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame" style="direction: ltr; margin-top: 25px;">' . "\n";
                include($VISUAL_COMPOSER_EXTENSIONS->assets_dir . 'ts_vcsc_sidebars.php');
            echo '</div>' . "\n";	
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
?>