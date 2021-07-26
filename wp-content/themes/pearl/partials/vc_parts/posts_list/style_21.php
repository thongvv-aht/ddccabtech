<?php
pearl_add_element_style('posts_list', $style);
?>

<div class="stm_posts_list_single">
	<div class="stm_posts_list_single__container">
		<?php if (!empty($show_image) and has_post_thumbnail() ): ?>
			<div class="stm_posts_list_single__image">
				<a href="<?php the_permalink(); ?>"
				   <?php the_title_attribute(); ?> class="no_deco">
					<?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>
				</a>
			</div>
		<?php endif; ?>
		<div class="stm_posts_list_single__body <?php if ( has_post_thumbnail() ): ?>has_single__image<?php endif; ?>">

			<?php if (!empty($show_title)): ?>
				<h5>
					<a href="<?php the_permalink(); ?>"
					   <?php the_title_attribute(); ?> class="no_deco">
						<?php the_title() ?>
					</a>
				</h5>
			<?php endif; ?>

			<?php if (!empty($show_excerpt)): ?>
				<div class="stm_posts_list_single__excerpt">
					<?php the_excerpt(); ?>
				</div>
			<?php endif; ?>

            <div class="stm_posts_list_single__info">


                <div class="categories info__item">
                    <?php
                    $categories = wp_get_post_categories(get_the_ID(), array('fields' => 'all'));

                    foreach ($categories as $category) : ?>
                        <a class="ttc ttc_h" href="<?php echo esc_attr(get_category_link($category->term_id)); ?>">
                            <div class="category">
                                <?php echo wp_kses_post($category->name); ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
			</div>
		</div>
	</div>
</div>