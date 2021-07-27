<!DOCTYPE html>
<html <?php language_attributes(); ?> id="main_html">
<head>
	<?php do_action('pearl_head_start'); ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap" rel="stylesheet"> 
    <?php wp_head(); ?>
	<?php do_action('pearl_head_end'); ?>

    <script>/*<![CDATA[*/(function(w,a,b,d,s){w[a]=w[a]||{};w[a][b]=w[a][b]||{q:[],track:function(r,e,t){this.q.push({r:r,e:e,t:t||+new Date});}};var e=d.createElement(s);var f=d.getElementsByTagName(s)[0];e.async=1;e.src='//a40632.actonsoftware.com/cdnr/58/acton/bn/tracker/40632';f.parentNode.insertBefore(e,f);})(window,'ActOn','Beacon',document,'script');ActOn.Beacon.track();/*]]>*/</script>
    <script type="text/javascript" src="//script.crazyegg.com/pages/scripts/0071/1371.js" async="async"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>

    <meta name="google-site-verification" content="oOsKX9vJVK1oJ8nakw7xU608se-29Pk2KoMHEwqSIMc">
</head>
<body <?php body_class('page-' . esc_attr(get_page_uri())); ?> <?php pearl_body_bg(); ?> ontouchstart="true">
    <?php do_action('pearl_body_start'); ?> 
	<?php
    if(pearl_check_string(pearl_get_option('enable_bubbles', '')))
		get_template_part('partials/other/bubbles'); ?>

    <div class="modal fade webinar-modal" id="webinarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="https://a40632.actonsoftware.com/acton/fs/blocks/showLandingPage/a/40632/p/p-0007/t/page/fm/0"></iframe>
                </div>
            </div>
        </div>
    </div>

    <div id="wrapper">
        <?php do_action('pearl_before_header'); ?>
        <?php get_template_part('partials/header/main'); ?>

        <?php
            //Pre content settings

            //Global settings
            $page_pre_content_box = pearl_get_option('page_pre_content_box');
            $stm_pre_content_global = pearl_get_option('page_pre_content');
            //Page settings
            $id = get_the_ID();
            $stm_pre_content_custom = get_post_meta($id, 'stm_pre_content', true);
        ?>
        <?php if( $page_pre_content_box == 'true' ): ?>
            <div class="pre_content">
                <?php if( empty ($stm_pre_content_custom) ): ?>
                    <?php pearl_sidebar(true, $stm_pre_content_global); ?>
                <?php elseif( $stm_pre_content_custom == true) : ?>
                <?php else: ?>
                    <?php pearl_sidebar(true, $stm_pre_content_custom); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <div class="site-content">
            <div class="<?php echo esc_attr(apply_filters('pearl_site_container', '')); ?>">