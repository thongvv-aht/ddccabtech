<?php
$copyright = pearl_get_option('copyright');
$right_text = pearl_get_option('right_text');
$footer_socials = pearl_get_option('footer_socials');
$show_footer_socials = pearl_check_string(pearl_get_option('copyright_socials', 'false'));

$copyright_text_align_class = '';
$copyright_markup = 50;

if (empty($footer_socials) && empty($right_text)) {
	$copyright_text_align_class = 'text-center';
	$copyright_markup = 'full';
}

if (!empty($copyright) or !empty($right_text) or !empty($footer_socials) and $show_footer_socials): ?>

	<div class="stm-footer__bottom">
		<div class="stm_markup stm_markup_right stm_markup_<?php echo esc_attr($copyright_markup) ?>">
            <?php get_template_part("partials/footer/parts/copyright"); ?>

			<?php if (!empty($right_text) || !empty($footer_socials) && $show_footer_socials) : ?>

				<div class="stm_markup__sidebar text-right">
                    <?php get_template_part("partials/footer/parts/right_text"); ?>
                    <?php get_template_part("partials/footer/parts/socials"); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

<?php endif; ?>