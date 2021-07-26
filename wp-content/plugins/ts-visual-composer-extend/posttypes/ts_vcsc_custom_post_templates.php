<?php
    // Create Custom Messages
    function TS_VCSC_Widgets_Post_Messages($messages) {
		global $post, $post_ID;
		$post_type = get_post_type( $post_ID );
		$obj = get_post_type_object($post_type);
		$singular = $obj->labels->singular_name;
		$messages[$post_type] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => sprintf( __($singular.' updated.')),
			2 => __('Custom field updated.'),
			3 => __('Custom field deleted.'),
			4 => __($singular.' updated.'),
			5 => isset($_GET['revision']) ? sprintf( __($singular.' restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __($singular.' published.')),
			7 => __('Page saved.'),
			8 => sprintf( __($singular.' submitted.')),
			9 => sprintf( __($singular.' scheduled for: <strong>%1$s</strong>.'), date_i18n( __('M j, Y @ G:i'), strtotime($post->post_date))),
			10 => sprintf( __($singular.' draft updated.')),
		);
		return $messages;
    }
    
    // Add Content for Contextual Help Section
    function TS_VCSC_Widgets_Post_Help( $contextual_help, $screen_id, $screen ) { 
        if ('edit-ts_widgets' == $screen->id) {
            $contextual_help = '<h2>' . __('Templates & Widgets', 'ts_visual_composer_extend') . '</h2>
            <p>' . __('CP Widgets / Templates are an easy way to display any WP Bakery Page Builder element in your widget sidebar and/or to create templates, allowing you to modify content in one central location and have your changes reflected automatically everywhere where the template has been used.', 'ts_visual_composer_extend') . '</p> 
            <p>' . __('You can view/edit the details of each widget / template by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.', 'ts_visual_composer_extend') . '</p>';
        } else if ('ts_widgets' == $screen->id) {
            $contextual_help = '<h2>' . __('Editing CP Templates', 'ts_visual_composer_extend') . '</h2>
            <p>' . __('This page allows you to view or modify widget / template details. Please make sure to fill out the available boxes with the appropriate details. Widget / Template information can only be used with the Composium - WP Bakery Page Builder Extensions plugin.', 'ts_visual_composer_extend') . '</p>';
        }
        return $contextual_help;
    }
	
	// Create Custom Metaboxes
	function TS_VCSC_Widgets_Post_MetaBox() {
		global $pagenow;		
		$screen = TS_VCSC_GetCurrentPostType();
		
		if (($screen == 'ts_widgets') && ($pagenow == 'post-new.php' || $pagenow == 'post.php')) {	
			add_meta_box('ts_widgets_basic', __( 'Usage Information (BETA)', 'ts_visual_composer_extend' ), 'TS_VCSC_Widgets_Post_MetaContent', 'ts_widgets', 'normal', 'core');
		}
	}
	function TS_VCSC_Widgets_Post_MetaContent($post) {
		echo '<div style="margin-top: 25px;">';
			echo '<div class="ts-posts-widgets-info"><p>' . __('Use this custom post type to create content with the standard WordPress editor or WP Bakery Page Builder, which can be used via widget in any sidebar. In your "Appearance" -> "Widgets"
			section, you will find a matching widget "CP Widgets / Templates", allowing you to select the content created here to be added to any sidebar.', 'ts_visual_composer_extend') . '</p></div>';
			echo '<div class="ts-posts-widgets-warning"><p>' . __('While you will have access to all WP Bakery Page Builder and add-on elements, please be aware that not every element is suitable to be used in a narrow sidebar.', 'ts_visual_composer_extend') . '</p></div>';
			echo '<div class="ts-posts-widgets-critical"><p style="font-weight: bold;">' . __('For layout purposes, it is highly advised to only use full-width (one-column) rows, in order to best utilize the narrow width of a sidebar. Rows with multiple columns are usually not suitable for sidebars, unless the sidebar has an unusual large width.', 'ts_visual_composer_extend') . '</p></div>';
		echo '</div>';
	}
	
	// Load Required JS+CSS Files
	function TS_VCSC_Widgets_Post_Files() {
		global $pagenow;
		$screen = TS_VCSC_GetCurrentPostType();
		if ($screen=='ts_widgets') {
			if ($pagenow=='post-new.php' || $pagenow=='post.php') {
				if (!wp_script_is('jquery')) {
					wp_enqueue_script('jquery');
				}
				wp_enqueue_style('ts-extend-posttypes');
			}
		}
	}
	
	// Remove RevSlider + Essential Grid Metaboxes
	function TS_VCSC_Widgets_RemoveExternalMetaboxes() { 
		global $pagenow;
		$screen = TS_VCSC_GetCurrentPostType();
		if ($screen=='ts_widgets') {
			if ($pagenow=='post-new.php' || $pagenow=='post.php') {
				remove_meta_box('eg-meta-box', 'ts_widgets', 'normal'); 
				remove_meta_box('mymetabox_revslider_0', 'ts_widgets', 'normal'); 
			} 
		} 
	}
    
    // Create Custom Columns
	function TS_VCSC_Widgets_Set_CustomColumn_PostType($defaults) {
		$defaults = array_merge(
            $defaults,
            array('ids'                                 => _x('ID', 'ts_visual_composer_extend'))	
		);
		return $defaults;
	}
    
    // Pull Data for Custom Columns
	function TS_VCSC_Widgets_Get_CustomColumn_Data($columns, $post_id) {
		if ($columns === 'ids') {
            echo $post_id;
        }
	}
    
    // Create Custom Columns Styling
    function TS_VCSC_Widgets_AdjustColumnWidths() {
        echo '<style type="text/css">
            .column-ids {text-align: left; width: 60px !important; overflow: hidden;}
        </style>';
    }
    
	// Make Customs Columns Sortable		
	function TS_VCSC_Widgets_Sort_CustomColumns($columns) {
		$columns['ids'] = 'ids';    
		return $columns;
	}
	
	// Load All Routines
	if (is_admin()) {
		add_filter('post_updated_messages', 						'TS_VCSC_Widgets_Post_Messages');
		add_action('contextual_help', 								'TS_VCSC_Widgets_Post_Help', 				10, 3);
        add_action('admin_head',                                    'TS_VCSC_Widgets_AdjustColumnWidths');
		add_action('add_meta_boxes', 								'TS_VCSC_Widgets_Post_MetaBox' );
		add_action('admin_enqueue_scripts',							'TS_VCSC_Widgets_Post_Files', 				9999999999);
		add_action('add_meta_boxes', 								'TS_VCSC_Widgets_RemoveExternalMetaboxes', 	9999999999);
		add_filter('manage_ts_widgets_posts_columns',               'TS_VCSC_Widgets_Set_CustomColumn_PostType');
		add_action('manage_ts_widgets_posts_custom_column',         'TS_VCSC_Widgets_Get_CustomColumn_Data',    10, 2);
        add_filter('manage_edit-ts_widgets_sortable_columns',       'TS_VCSC_Widgets_Sort_CustomColumns');
	}
?>