<?php get_header('404'); ?>

<?php
$bg = pearl_get_option('error_page_bg');
$bg_style = '';
if (!empty($bg)) {
	$bg = pearl_get_image_url($bg);
	$bg_style = 'style="background-image:url(\'' . $bg . '\')"';
}
?>
	<div class="stm_errorpage page-404-style-6">
		<div class="stm_errorpage__bg" <?php echo sanitize_text_field($bg_style); ?>>
			<div class="content-404 text-center">
				<h2><?php esc_html_e('404', 'pearl'); ?></h2>
				<h5><?php esc_html_e('Oops! Wrong turn, page not found!', 'pearl'); ?></h5>
				<div class="img-404">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/img-404.png" alt="" />
				</div>
				<h5><?php esc_html_e('Let\'s get you back on track...', 'pearl'); ?></h5>
				<a href="<?php echo esc_url(home_url('/')); ?>" class="btn-return-home">
					<?php esc_html_e('Return Home', 'pearl'); ?>
				</a>
			</div>
		</div>
	</div>
<?php get_footer('404'); ?>