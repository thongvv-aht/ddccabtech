<?php
/*Medicall*/
$path = 'partials/content/post/single/';
$parts = 'partials/content/post/parts/';

if (pearl_check_string(pearl_get_option('post_info'))) {
	get_template_part("{$parts}/postinfo", 7);
}

if (pearl_check_string(pearl_get_option('post_image'))) {
	get_template_part("{$parts}/image");
}

if (pearl_check_string(pearl_get_option('post_title'))): ?>
	<h1 class="h2 stm_lh_40"><?php the_title(); ?></h1>
<?php endif; ?>

	<div class="stm_mgb_20">
		<?php the_content(); ?>
	</div>

<?php get_template_part("{$path}/actions");

if (pearl_check_string(pearl_get_option('post_author'))) {
	get_template_part("{$path}/author");
}

if (pearl_check_string(pearl_get_option('post_comments'))) {
	get_template_part("{$parts}/comments");
}