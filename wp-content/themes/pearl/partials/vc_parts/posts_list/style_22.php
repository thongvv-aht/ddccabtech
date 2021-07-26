<?php
pearl_add_element_style('posts_list', $style);
?>

<div class="stm_posts_list_single">
	<div class="stm_posts_list_single__container">

		<?php if (!empty($show_image) and has_post_thumbnail() ): ?>
		<div class="stm_posts_list_single__image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>
			</a>

			<?php if (!empty($show_date)): ?>
			<div class="stm_posts_list_single__date">
				<?php echo get_the_date('d M') ?>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<div class="stm_posts_list_single__body">

			<?php if (!empty($show_title)): ?>
			<h5 class="stm_posts_list_single__title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_title() ?>
				</a>
			</h5>
			<?php endif; ?>

			<?php if (!empty($show_excerpt)): ?>
			<div class="stm_posts_list_single__excerpt">
				<?php the_excerpt(); ?>
			</div>
			<?php endif; ?>

		</div>
	</div>
</div>