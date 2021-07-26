<?php
pearl_add_element_style('posts_list', $style);
?>

<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="stm_posts_list_single">

	<?php if (!empty($show_image) and has_post_thumbnail() ): ?>
	<span class="stm_posts_list_single__image">
		<?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>
	</span>
	<?php endif; ?>

	<?php if (!empty($show_date)): ?>
	<span class="stm_posts_list_single__date h5">
		<span class="stm_posts_list_single__date_day"><?php echo get_the_date('d') ?></span>
		<span class="stm_posts_list_single__date_month"><?php echo get_the_date('M') ?></span>
	</span>
	<?php endif; ?>

	<span class="stm_posts_list_single__body">

		<?php if (!empty($show_title)): ?>
		<span class="stm_posts_list_single__title h4">
			<?php the_title() ?>
		</span>
		<?php endif; ?>

		<?php if (!empty($show_excerpt)): ?>
		<span class="stm_posts_list_single__excerpt">
			<?php the_excerpt(); ?>
		</span>
		<?php endif; ?>

	</span>
</a>