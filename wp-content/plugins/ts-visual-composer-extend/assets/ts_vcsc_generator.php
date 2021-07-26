<div class="wrap ts-settings" id="ts_changelog_frame" style="direction: ltr; margin-top: 0px;">
    <div class="ts-vcsc-settings-group-header" style="margin-top: 25px;">
        <div class="display_header">
            <h2><span class="dashicons dashicons-awards"></span>"Iconicum - WordPress Icon Fonts" (Bonus Plugin)</h2>
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
				<div class="ts-vcsc-notice-field ts-vcsc-success" style="margin-top: 10px; font-size: 13px; text-align: justify;">
					<?php echo __("Here you can generate the Shortcode for any of the Icon Fonts that are part of Composium - WP Bakery Page Builder Extensions. Embed the shortcode into the tinyMCE editor in order to utilize the font icons outside the WP Bakery Page Builder elements.", "ts_visual_composer_extend"); ?>					
				</div>
				<div class="ts-vcsc-notice-field ts-vcsc-critical" style="margin-top: 10px; font-size: 13px; text-align: justify;">
					<?php echo __("When using an icon font just by its class name but not via shortcode, you need to set that icon font to always load its related stylesheets and font files via the plugin settings (Font Manager).", "ts_visual_composer_extend"); ?>					
				</div>
            </div>
        </div>
        <div class="ts-vcsc-section-main">
            <div class="ts-vcsc-section-title ts-vcsc-section-show"><i class="dashicons-hammer"></i>Icon Shortcode Generator</div>
            <div class="ts-vcsc-section-content">
                <div id="ts-changelog-generator-section-banner" style="margin-top: 0px; margin-bottom: 10px;">
                    <img src="<?php echo TS_VCSC_GetResourceURL('images/other/icon_fonts.png'); ?>"/>
                </div>
                <div id="ts-changelog-generator-section-generator" class="ts-changelog-generator-section-generator clearFixMe" style="margin: 10px 0;">
                    <div class="ts-vcsc-notice-field ts-vcsc-success" style="margin-bottom: 20px; font-size: 13px; text-align: justify;">                        
                        <?php echo __("In order to embed the icon into your pages, a shortcode is required. The generator below will help you to easily create the right shortcode, based on your selected settings. If you use the popular WP Bakery Page Builder plugin, you are also able to use the dedicated builder element to insert icons. If enabled, the shortcode generator will also be provided within the default WordPress editors on assigned post types.", "ts_visual_composer_extend"); ?>
                    </div>
                    <div class="ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder">
                        <span class="ts-advanced-link-tooltip-content"><?php echo __("Click here to generate the full shortcode for embedding a changelog.", "ts_visual_composer_extend"); ?></span>
                        <a href="#" target="_parent" class="ts-advanced-link-button-main ts-advanced-link-button-green ts-advanced-link-button-code csf-shortcode-button ts-composium-generator-trigger" data-modal-id="ts-composium-shortcode" data-target-id="ts-composium-generator-input" data-editor-id="ts-composium-generator-input">
                            <?php echo __("Generate Shortcode", "ts_visual_composer_extend"); ?>
                        </a>
                    </div>
                    <div id="ts-settings-statistics-shortcode-wrapper" class="ts-settings-statistics-shortcode-wrapper" style="display: none; width: 100%; margin: 20px 0 0 0; padding: 0; float: left;">
                        <div id="ts-settings-statistics-clipboard-success" class="ts-vcsc-notice-field ts-vcsc-success" style="display: none; font-size: 13px; text-align: justify;">
                            <?php echo __("The shortcode for the icon has been copied to your clipboard!", "ts_visual_composer_extend"); ?>
                        </div>
                        <div id="ts-settings-statistics-clipboard-error" class="ts-vcsc-notice-field ts-vcsc-critical" style="display: none; font-size: 13px; text-align: justify;">
                            <?php echo __("The shortcode for the icon could NOT be copied to your clipboard!", "ts_visual_composer_extend"); ?>
                        </div>
                        <textarea id="ts-composium-generator-input" class="ts-composium-generator-input" name="ts-composium-generator-input" readonly="readonly" style="width: 100%; height: 100px;"></textarea>
                        <div class="ts-advanced-link-button-wrapper ts-advanced-link-tooltip-holder" style="margin-top: 10px;">
                            <span class="ts-advanced-link-tooltip-content"><?php echo __("Click here to copy the shortcode to the browser clipboard.", "ts_visual_composer_extend"); ?></span>
                            <a href="#" target="_parent" id="ts-composium-clipboard-button" class="ts-advanced-link-button-main ts-advanced-link-button-orange ts-advanced-link-button-copy" style="margin: 0;" data-clipboard-target="#ts-composium-generator-input">
                                <?php echo __("Copy to Clipboard", "ts_visual_composer_extend"); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>