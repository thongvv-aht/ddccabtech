<?php
$per_row = (empty($per_row)) ? 3 : $per_row;
$img_size = (empty($img_size)) ? '' : $img_size;

$classes = array(
	'stm_loop__grid stm_loop__single_style_3 no_deco col-sm-' . 12 / $per_row . ' col-xs-12'
);
?>

<div <?php post_class(implode(' ', $classes)); ?>>
	<div class="stm_services__container text-center">
		<?php if (has_post_thumbnail()): ?>
			<?php if ($post_link): ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php endif; ?>

				<div class="stm_services__image">
					<?php if (!empty($img_size)): ?>
						<?php echo wp_kses_post(pearl_get_VC_img(get_post_thumbnail_id(), $img_size)); ?>
					<?php else: ?>
						<?php the_post_thumbnail('pearl-img-370-450', array('class' => 'stm_mgb_15 img-responsive')); ?>
					<?php endif; ?>
				</div>
			
			<?php if ($post_link): ?>
			</a>
			<?php endif; ?>

            <div class="stm_services__content">
                <div class="stm_services__title stm_animated">
					<?php if ($post_link): ?>
                    <a <?php the_title_attribute(); ?> href="<?php the_permalink(); ?>"
					   class="h4 no_line title"><?php the_title(); ?></a>   
					<?php else: ?>
						<strong><?php the_title(); ?></strong> Service
					<?php endif; ?>
                </div>
            </div>
		<?php endif; ?>
	</div>
</div>