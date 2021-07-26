<?php 

add_action('vc_after_init', 'pearl_moduleVc_likes_and_share');

function pearl_moduleVc_likes_and_share()
{
    vc_map(
        array(
            "name" => esc_html__('Pearl post likes and share', 'pearl'),
            "base" => "stm_likes_and_share",
            "params" => array(
                vc_map_add_css_animation(),
                pearl_vc_add_css_editor()
            ),
        )
    );
}

if (class_exists('WPBakeryShortCode') && pearl_is_use_plugin('sharethis-share-buttons/sharethis-share-buttons.php')) {
    class WPBakeryShortCode_Stm_Likes_And_Share extends WPBakeryShortCode
    {
    }
}