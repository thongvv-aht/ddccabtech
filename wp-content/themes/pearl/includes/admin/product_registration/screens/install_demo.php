<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

$demos = array(
	'business'      => array(
		'label' => esc_html__('Business', 'pearl'),
    ),
    'gym' => array(
        'label' => esc_html__('GYM', 'pearl')
    ),
    'creativethree' => array(
        'label' => esc_html__('Dark Creative Agency', 'pearl')
    ),
    'hosting' => array(
        'label' => esc_html__('Hosting', 'pearl')
    ),
    'book' => array(
        'label' => esc_html__('Book', 'pearl')
    ),
    'barbershop' => array(
        'label' => esc_html__('Barbershop', 'pearl')
    ),
    'taxi' => array(
        'label' => esc_html__('Taxi', 'pearl')
    ),
    'sports_complex' => array(
        'label' => esc_html__('Sports Complex', 'pearl')
    ),
    'company' => array(
        'label' => esc_html__('Company', 'pearl')
    ),
    'logistics'     => array(
        'label' => esc_html__('Transportation', 'pearl'),
    ),
    'businessthree' => array(
        'label' => esc_html__('Business Three', 'pearl'),
    ),
    'businesstwo' => array(
        'label' => esc_html__('Business Two', 'pearl')
    ),
    'digital' => array(
        'label' => esc_html__('Digital agency', 'pearl')
    ),
    'construction'  => array(
        'label' => esc_html__('Construction', 'pearl'),
    ),
    'restaurant'    => array(
        'label' => esc_html__('Restaurant', 'pearl'),
    ),
    'constructiontwo'  => array(
        'label' => esc_html__('Construction Two', 'pearl'),
    ),
    'logisticstwo'     => array(
        'label' => esc_html__('Transportation Two', 'pearl'),
    ),
    'coffeeshop' => array(
        'label' => esc_html__('Coffee-shop', 'pearl')
    ),
    'consulting' => array(
        'label' => esc_html__('Consulting', 'pearl')
    ),
    'medicall'      => array(
        'label' => esc_html__('Medical', 'pearl'),
    ),
    'charity'       => array(
        'label' => esc_html__('Charity', 'pearl'),
    ),
    'factory' => array(
        'label' => esc_html__('Factory', 'pearl')
    ),
    'finance' => array(
        'label' => esc_html__('Finance', 'pearl')
    ),
    'businessfour'  => array(
        'label' => esc_html__('Business Four', 'pearl'),
    ),
    'store'         => array(
        'label' => esc_html__('Store', 'pearl'),
    ),
    'creativetwo' => array(
        'label' => esc_html__('Creative Agency Two', 'pearl')
    ),
    'advisory' => array(
        'label' => esc_html__('Advisory', 'pearl')
    ),
    'medicaltwo'      => array(
        'label' => esc_html__('Medical Two', 'pearl'),
    ),
    'beauty'        => array(
        'label' => esc_html__('Beauty', 'pearl'),
    ),
    'furniture' => array(
        'label' => esc_html__('Furniture', 'pearl')
    ),
    'creative' => array(
        'label' => esc_html__('Creative agency', 'pearl')
    ),
    'renovation' => array(
        'label' => esc_html__('Renovation', 'pearl')
    ),
    'software' => array(
        'label' => esc_html__('Software', 'pearl')
    ),
    'app' => array(
        'label' => esc_html__('App landing', 'pearl')
    ),
	'portfolio'     => array(
		'label' => esc_html__('Portfolio', 'pearl'),
	),
	'personal_blog' => array(
		'label' => esc_html__('Personal Blog', 'pearl'),
	),
	'startup'       => array(
		'label' => esc_html__('Startup', 'pearl'),
	),
	'psychologist' => array(
		'label' => esc_html__('Psychologist', 'pearl')
    ),
	'rental'        => array(
		'label' => esc_html__('Rental', 'pearl'),
	),
	'corporate' => array(
		'label' => esc_html__('Corporate', 'pearl')
	),
	'healthcoach'   => array(
		'label' => esc_html__('Healthcoach', 'pearl'),
	),
	'church'        => array(
		'label' => esc_html__('Church', 'pearl'),
	),
	'artist'        => array(
		'label' => esc_html__('Music', 'pearl'),
	),
    'conference' => array(
        'label' => esc_html__('Conference', 'pearl')
    ),
    'portfoliotwo'  => array(
        'label' => esc_html__('Portfolio Two', 'pearl'),
    ),
    'seoagency'     => array(
        'label' => esc_html__('SEO Agency', 'pearl'),
    ),
    'politician' => array(
        'label' => esc_html__('Candidate', 'pearl')
    ),
	'lawyer' => array(
		'label' => esc_html__('Lawyer', 'pearl')
	),
    'magazine' => array(
        'label' => esc_html__('Magazine', 'pearl')
    ),
    'photographer'  => array(
        'label' => esc_html__('Photographer', 'pearl'),
    ),
    'viral'       => array(
        'label' => esc_html__('Viral', 'pearl'),
    ),
    'dj' => array(
        'label' => esc_html__('Dj / Artist', 'pearl')
    ),
);

$auth_code = stm_check_auth();
$plugins = pearl_require_plugins(true);
?>
<div class="wrap about-wrap stm-admin-wrap  stm-admin-demos-screen">
	<?php pearl_get_admin_tabs('demos'); ?>

	<?php if( !empty($auth_code) ):
		$current_demo = '';
		?>
		<?php if (empty(!$current_demo = get_option('stm_layout'))): ?>
			<div class="stm_demo_import__notice">
				<h4>
					<i class="stmicon-uniE6A8"></i> <?php printf('You already installed <a href="%s" target="_blank">%s</a> layout', get_home_url(), $demos[$current_demo]['label']); ?>
				</h4>
				<p><?php _e('If you want to import another layout, please <a href="https://wordpress.org/plugins/wordpress-reset/" target="_blank">Reset WordPress</a> database.', 'pearl'); ?></p>
			</div>
		<?php endif; ?>
        <div class="stm_demo_import_choices">
            <script>
                var stm_layouts = {};
            </script>
			<?php foreach ($demos as $demo_key => $demo_value): ?>
                <script>
                    stm_layouts['<?php echo esc_attr($demo_key); ?>'] = <?php echo json_encode(pearl_layout_plugins($demo_key)); ?>;
                </script>
                <label class="<?php echo esc_attr($demo_key == $current_demo) ? 'active' : ''; ?>">
                    <div class="inner">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/includes/admin/product_registration/assets/img/layouts/' . $demo_key . '.jpg'); ?>"/>
						<?php if ($demo_key == $current_demo): ?>
                            <div class="installed"><?php esc_html_e('Installed', 'pearl'); ?></div>
						<?php else: ?>
                            <div class="install"
                                 data-layout="<?php echo esc_attr($demo_key); ?>"><?php esc_html_e('Import', 'pearl'); ?></div>
						<?php endif; ?>
                        <span class="stm_layout__label"><?php echo esc_attr($demo_value['label']); ?></span>
                    </div>
                </label>
			<?php endforeach; ?>
        </div>


        <div class="stm_install__demo_popup">
            <div class="stm_install__demo_popup_close"></div>
            <div class="inner">

                <!-- Privacy Policy -->
                <div class="privacy_policy">
                    <h4><?php esc_html_e('Privacy Policy', 'pearl'); ?></h4>
                    <div class="stm_install__demo_popup_close"></div>
                    <div class="stm_plugins_status">
                        <?php require_once 'privacy_policy.php'; ?>
                    </div>
                    <div class="privacy_policy_button decline" data-value="decline"><?php esc_html_e('Decline', 'pearl'); ?></div>
                    <div class="privacy_policy_button" data-value="accept"><?php esc_html_e('Accept', 'pearl'); ?></div>
                    <input type="hidden" name="skip_api" id="skip_api" value="0"/>
                </div>

                <div class="demo_install" style="display: none;">
                    <h4><?php esc_html_e('Demo Installation', 'pearl'); ?></h4>
                    <div class="stm_install__demo_popup_close"></div>
                    <div class="stm_plugins_status">
                        <?php foreach ($plugins as $plugin):
                            $active = (pearl_check_plugin_active($plugin['slug'])) ? 'installed' : 'not-installed';
                            $active_text = ($active == 'installed') ? esc_html__('Installed & Activated', 'pearl') : esc_html__('Not installed', 'pearl');
                            ?>
                            <div id="<?php echo sanitize_text_field('stm_' . $plugin['slug']); ?>"
                                class="stm_single_plugin_info <?php echo esc_attr($active); ?>"
                                data-active="<?php echo esc_attr($active); ?>"
                                data-slug="<?php echo sanitize_text_field($plugin['slug']); ?>">
                                <div class="image">
                                    <img
                                            src="<?php echo esc_url(get_template_directory_uri() . '/includes/admin/product_registration/assets/img/plugins/' . $plugin['slug'] . '.png'); ?>"/>
                                </div>
                                <div class="title"><?php echo sanitize_text_field($plugin['name']); ?></div>
                                <div class="status">
                                    <span><?php echo sanitize_text_field($active_text); ?></span>
                                    <div class="loading-dots"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="stm_content_status">
                            <div class="image">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/includes/admin/product_registration/assets/img/plugins/demo.png'); ?>"/>
                            </div>
                            <div class="title"><?php esc_html_e('Demo content', 'pearl'); ?></div>
                            <div class="status"><span></span>
                                <div class="loading-dots"></div>
                            </div>
                        </div>
                    </div>
                    <div class="stm_install__demo_start"><?php esc_html_e('Setup Layout', 'pearl'); ?></div>
                </div>

            </div>
        </div>
	<?php else: ?>
        <div class="stm-admin-message">
			<?php printf(
			        wp_kses_post(
			                __('Please enter your <a href="%s">Activation Token</a> before running the Pearl.', 'pearl')
                    ),
            admin_url("admin.php?page=my-pearl")); ?>
        </div>
	<?php endif; ?>

</div>

<script>
    (function ($) {
        var plugins = <?php echo html_entity_decode(json_encode(wp_list_pluck($plugins, 'slug'))); ?>;
        var layout = 'business';
        var plugin = false;
        var layout_plugins = [];
        var installation = false;

		<?php if(!empty($_GET['layout_importing'])): ?>
        layout = '<?php echo esc_js($_GET['layout_importing']); ?>';
		<?php endif; ?>

        $(document).ready(function () {
            next_installable();
            show_popup();

			<?php if(!empty($_GET['layout_importing'])): ?>
            layout = '<?php echo esc_js($_GET['layout_importing']); ?>';
            $('.stm_demo_import_choices .install').click();
            setTimeout(function () {
                $('.stm_install__demo_popup .inner .stm_install__demo_start').click();
            }, 1000);

            window.history.pushState('', '', '<?php echo esc_url(remove_query_arg('layout_importing')) ?>');

            /* Privacy Policy */
            $('.stm_install__demo_popup .privacy_policy').hide();
            $('.stm_install__demo_popup .demo_install').show();
			<?php endif; ?>

            $('.stm_install__demo_popup .inner .stm_install__demo_start').on('click', function (e) {
                e.preventDefault();

                if ($(this).attr('target') === '_blank') {
                    var win = window.open($(this).attr('href'), '_blank');
                    win.focus();

                    return;
                }

                if (!$(this).hasClass('installing')) {
                    next_installable();

                    if (!plugin) {
                        /* Plugins installed, Install demo */
                        performAjax('import_demo');
                    } else {
                        /* Install plugin */
                        performAjax(plugins[plugin]);
                    }
                }
            });

            /* Privacy Policy */
            $('.privacy_policy_button').on('click', function (e) {
                e.preventDefault();
                
                $('.stm_install__demo_popup .privacy_policy').hide();
                $('.stm_install__demo_popup .demo_install').show();
                
                if ( $(this).data('value') == 'decline' ) {
	                $('#skip_api').val(1);
                } 
            });

        });

        function performAjax(plugin_slug) {
            installation = true;
            var installing = "<?php esc_html_e('Installing', 'pearl'); ?>";
            var installed = "<?php esc_html_e('Installed & Activated', 'pearl'); ?>";
            var $current_plugin = $('#stm_' + plugin_slug);

			<?php if(!empty($_GET['layout_importing'])): ?>
            layout = '<?php echo esc_js($_GET['layout_importing']); ?>';
			<?php endif; ?>

            $.ajax({
                url: ajaxurl,
                dataType: 'json',
                context: this,
                data: {
                    'layout': layout,
                    'plugin': plugin_slug,
                    'action': 'pearl_install_plugin',
                    'security': pearl_install_plugin
                },
                beforeSend: function () {
                    $current_plugin
                        .addClass('installing')
                        .find('.status > span').text(installing);
                    $('.stm_install__demo_popup .inner .stm_install__demo_start').addClass('installing');
                },
                complete: function (data) {
                    $current_plugin
                        .removeClass('installing')
                        .find('.status > span').html(installed).text();

                    var dt = data.responseJSON;
                    if (typeof dt.next !== 'undefined') {
                        plugin = dt.plugin_slug;
                        performAjax(dt.next);
                    }

                    if (typeof dt.activated !== 'undefined' && dt.activated) {
                        plugin = dt.plugin_slug;
                        $current_plugin.removeClass('.not-installed').addClass('installed').attr('data-active', 'installed');
                    }

                    if (typeof dt.import_demo !== 'undefined' && dt.import_demo) {
                        install_demo()
                    }
                },
                error: function () {
                    window.location.href += '&layout_importing=' + layout;
                }

            });
        }

        function install_demo() {
            installation = true;
            var importing_demo_text = "<?php esc_html_e('Importing Demo', 'pearl'); ?>";
            var imported_demo_text = "<?php esc_html_e('Imported', 'pearl'); ?>";

			<?php if(!empty($_GET['layout_importing'])): ?>
            layout = '<?php echo esc_js($_GET['layout_importing']); ?>';
			<?php endif; ?>

            $.ajax({
                url: ajaxurl,
                dataType: 'json',
                context: this,
                data: {
                    'demo_template': layout,
                    'action': 'stm_demo_import_content'
                },
                beforeSend: function () {
                    $('.stm_content_status').addClass('installing');
                    $('.stm_content_status .status > span').text(importing_demo_text);
                },
                complete: function (data) {
                    installation = false;
                    $('.stm_install__demo_popup .inner .stm_install__demo_start').removeClass('installing');
                    $('.stm_content_status').removeClass('installing').addClass('installed');
                    $('.stm_content_status .status > span').text(imported_demo_text);

                    var dt = data.responseJSON;
                    if (typeof dt.title !== 'undefined' && typeof dt.url !== 'undefined') {
                        var demo_start = '.stm_install__demo_popup .inner .stm_install__demo_start';
                        $(demo_start).text(dt.title);
                        $(demo_start).attr('href', dt.url);
                        $(demo_start).attr('target', '_blank');
                        $('<a class="stm_install_demo_to" href="' + dt.theme_options + '">' + dt.theme_options_title + '</a>').insertBefore(demo_start);
                    }

                    /* Privacy Policy */
                    /* Analytics */
                    if ($('#skip_api').val() == 0) {
                            $.ajax({
                            url: 'https://panel.stylemixthemes.com/api/active/',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                theme: 'pearl',
                                layout: layout,
                                website: "<?php echo esc_url(get_site_url()); ?>",

                                <?php
                                $token = get_option('envato_market', array());
                                $token = (!empty($token['token'])) ? $token['token'] : ''; ?>
                                token: "<?php echo esc_js($token); ?>"
                            }
                        });
                    }
                    
                }
            });
        }

        function show_popup() {
            $('.stm_demo_import_choices .install').on('click', function (e) {
                e.preventDefault();
                layout = $(this).attr('data-layout');

				<?php if(!empty($_GET['layout_importing'])): ?>
                layout = '<?php echo esc_js($_GET['layout_importing']); ?>';
				<?php endif; ?>

                hide_plugins(layout);
                $('.stm_install__demo_popup').addClass('active');
            });

            $('.stm_install__demo_popup_close').on('click', function (e) {
                e.preventDefault();
                if (!installation) {
                    $('.stm_install__demo_popup').removeClass('active');
                }
            });
        }

        function next_installable() {
            $('.stm_single_plugin_info').each(function () {
                var active = $(this).attr('data-active');
                var currentPlugin = $(this).attr('data-slug');
                if (active == 'not-installed' && !plugin && layout_plugins.indexOf(currentPlugin) !== -1) plugin = currentPlugin;
            });
        }

        function hide_plugins(layout) {
            layout_plugins = stm_layouts[layout];

            $('.stm_single_plugin_info').each(function () {
                var plugin_slug = $(this).attr('data-slug');
                if (layout_plugins.indexOf(plugin_slug) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        }

    })(jQuery);
</script>