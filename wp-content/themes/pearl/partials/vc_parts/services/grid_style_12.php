<?php
$per_row = (empty($per_row)) ? 3 : $per_row;
$img_size = (empty($img_size)) ? '' : $img_size;

$classes = array(
	'stm_loop__grid stm_loop__single_style_3 no_deco col-md-' . 12 / $per_row
);
?>

<div <?php post_class(implode(' ', $classes)); ?>>
	<div class="stm_services__container">
		<?php if (has_post_thumbnail()): ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<div class="stm_services__image">
					<?php if (!empty($img_size)): ?>
						<?php echo wp_kses_post(pearl_get_VC_img(get_post_thumbnail_id(), $img_size)); ?>
					<?php else: ?>
						<?php the_post_thumbnail('pearl-img-370-450', array('class' => 'stm_mgb_15 img-responsive')); ?>
					<?php endif; ?>
				</div>
			</a>

            <div class="stm_services__content">
                <div class="stm_services__title stm_animated">
                    <a <?php the_title_attribute(); ?> href="<?php the_permalink(); ?>"
                       class="h4 no_line title"><?php the_title(); ?></a>
                </div>

                <div class="excerpt">
                    <p><?php echo pearl_minimize_word(get_the_excerpt(), 120); ?></p>

                    <a href="<?php the_permalink(); ?>"
                       class="stm_services__more_link"><?php _e('Learn More', 'pearl'); ?><i class="stmicon-navigate_next"></i></a>
                </div>
            </div>
		<?php endif; ?>
	</div>
</div>