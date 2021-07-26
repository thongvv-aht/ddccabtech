<?php 
$id = get_the_ID();
$img_size = '320x220';
$post_format = get_post_format($id);
$video_label = false;
$video_link = false;

if ($post_format === 'video') {
    $video_label = esc_html('Video', 'pearl');
    $video_link = get_post_meta($id, 'single_post_video', true);
    if ($video_duration = get_post_meta($id, 'single_post_video_duration', true)) {
        if ($video_duration && $video_duration !== 0) {
            $video_duration = new DateInterval($video_duration);
            if ($video_duration->format('%H') > 0) {
                $video_label = $video_duration->format('%H:%I:%S');
            } else {
                $video_label = $video_duration->format('%I:%S');
            }
        }
    }
}

$post_views = get_post_meta($id, 'stm_post_views', true);
if (empty($post_views)) {
    $post_views = 0;
}
?>

<div <?php post_class('stm_posts_list_single'); ?>>
    <div class="stm_posts_list_single__container">
        <?php if (has_post_thumbnail()) :
            $image_url = pearl_get_VC_post_img_safe($id, $img_size, 'large', true);
        ?>

            <div class="stm_posts_list_single__image">
                <a href="<?php the_permalink(); ?>"
                   <?php the_title_attribute(); ?> class="no_deco">
                   <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title() ?>">
                </a>
				<?php if (!empty($video_label)) : ?>
                    <div class="video_label mbc_b">
						<?php
        echo wp_kses_post($video_label);
        ?>
                    </div>
				<?php endif; ?>
            </div>

		<?php endif; ?>
        <div class="stm_posts_list_single__body <?php if (has_post_thumbnail()) : ?>has_single__image<?php endif; ?>">
                <div class="stm_posts_list_single__title">
                    <h4>
                        <a href="<?php the_permalink(); ?>"
                        <?php the_title_attribute(); ?> class="no_deco">
                            <?php the_title() ?>
                        </a>
                    </h4>
                </div>

                <div class="stm_posts_list_single__excerpt">
					<?php echo get_the_excerpt(); ?>
                </div>
        </div>
    </div>
</div>