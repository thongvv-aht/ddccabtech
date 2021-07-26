<?php
$path = 'partials/content/post/single/';
$parts = 'partials/content/post/parts/';

$bg_image = '';
if(has_post_thumbnail()) {
	wp_enqueue_script('parallax');
    $bg_image = pearl_get_VC_post_img_safe(get_the_id(), '1920x940', 'large', true);
    if(!empty($bg_image)) {
        $bg_image = 'style="background-image: url(\'' . $bg_image . '\')"';
    }
}
?>

<div class="tbc post_title_box vc_container-fluid-force stm-parallax"
     data-parallax="stm_parallax_post_<?php echo get_the_ID(); ?>"
    <?php echo html_entity_decode($bg_image); ?>>
    <div class="text-center">
		<?php if (!empty($category = get_the_category())): ?>
            <div class="post-category mtc text-uppercase">
				<?php foreach($category as $single_category): ?>
                    <a class="no_deco" href="<?php echo esc_url(get_term_link($single_category)); ?>">
						<?php echo esc_attr($single_category->name); ?>
                    </a>
				<?php endforeach; ?>
            </div>
		<?php endif; ?>

		<?php if (pearl_check_string(pearl_get_option('post_title'))): ?>
            <h1 class="post-title mtc_a"><?php the_title(); ?></h1>
		<?php endif; ?>

		<?php if (pearl_check_string(pearl_get_option('post_info'))) {
			get_template_part("{$parts}/postinfo", 12);
		} ?>
    </div>
</div>

<?php if (pearl_check_string(pearl_get_option('post_share'))): ?>
    <div class="stm_single_event__share">
		<?php get_template_part('partials/content/post/single/share'); ?>
    </div>
<?php endif; ?>

<div class="stm_mgb_20 stm_single_post__content">
    <?php the_content(); ?>
</div>
<div class="clearfix"></div>

<?php pearl_wp_link_pages(); ?>

<div class="text-center">
    <?php if (pearl_check_string(pearl_get_option('post_share'))): ?>
        <div class="stm_single_event__share bottom_share">
            <?php get_template_part('partials/content/post/single/share'); ?>
        </div>
    <?php endif; ?>
    <?php if(!empty($tags = get_the_tags())): ?>
        <div class="post_tags">
            <?php foreach($tags as $tag): ?>
                <a href="<?php echo esc_url(get_tag_link($tag)) ?>"
                   title="<?php echo esc_attr($tag->name); ?>"
                   class="post_tag mbc_a">
                    <?php echo wp_kses_post($tag->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php if (pearl_check_string(pearl_get_option('post_image')) and has_post_thumbnail()) {
	get_template_part("{$parts}/image");
} ?>

<?php if (pearl_check_string(pearl_get_option('post_author'))) {
	$author_name = apply_filters('author_name_14_post_layout', get_the_author_meta('display_name'));
	$author_avatar = apply_filters('author_avatar_14_post_layout', get_avatar(get_the_author_meta('email'), 174));
	?>
    <div class="stm_author_box clearfix stm_mgb_50">
        <div class="stm_author_box__avatar">
			<?php echo pearl_sanitize_output($author_avatar); ?>
        </div>
        <div class="stm_author_box__info">
            <div class="stm_author_box__name">
				<?php esc_html_e('Written by:', 'pearl'); ?>
                <strong class="heading_font"><?php echo esc_html($author_name); ?></strong>
            </div>
        </div>
    </div>
<?php } ?>

<?php get_template_part("{$parts}/prev_next_posts_2"); ?>

<?php if (pearl_check_string(pearl_get_option('post_comments'))) {
	get_template_part("{$parts}/comments");
}