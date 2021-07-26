<?php
if ($lightbox === 'enable') {
	wp_enqueue_script('lightgallery.js');
	wp_enqueue_style('lightgallery');
}

$uniq = uniqid('price_list_');


$link = !empty($link) ? vc_build_link($link) : '';


$excerpt_length = (!empty(intval($excerpt_length))) ? $excerpt_length : '9999';

$categories = array();

$service_taxonomy = 'service_category';

if(!empty($taxonomy)) {
    $taxonomies = explode(', ', $taxonomy);

    if(!empty($taxonomies)) {
        $categories = get_terms(array(
            'taxonomy' => $service_taxonomy,
            'include' => $taxonomies
        ));
    }
} else {
	$categories = get_terms(array($service_taxonomy));
}

if ($categories) { ?>
	<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">

		<?php if (!empty($title)) : ?>
			<h2 class="services_price_list__heading h2 ttc mbdc_b mbdc_a"><?php echo esc_html($title); ?></h2>
		<?php endif; ?>

        <?php if (!empty($categories)) : ?>
		<div class="services_pills_container">
			<ul role="tablist">
				<?php
				$categories = array_merge($categories);
				foreach ($categories as $key => $category) { ?>

					<li role="presentation" class="<?php echo 0 === $key ? esc_attr('active') : '' ?>">
						<a href="#<?php echo esc_attr($uniq); ?>_service-tab-<?php echo esc_attr($category->slug); ?>"
						   class="sbc_h no_scroll"
						   role="tab"
						   data-toggle="tab"
						   aria-controls="<?php echo esc_attr($uniq); ?>_service-tab-<?php echo esc_attr($category->slug); ?>"><?php echo esc_html($category->name); ?></a>
					</li>
				<?php } ?>
			</ul>
		</div>
        <?php endif; ?>


		<div class="tab-content">

			<?php foreach ($categories as $key => $category) { ?>


				<?php
				$args = array(
					'post_type'        => 'stm_services',
					'service_category' => $category->slug,
					'posts_per_page'   => -1
				);
				$posts = new WP_Query($args);
				?>
				<?php if ($posts->have_posts()) {
					?>

					<div class="service__tab stm_lightgallery tab-pane <?php echo 0 === $key ? 'active' : '' ?>"
						 role="tabpanel"
						 id="<?php echo esc_attr($uniq); ?>_service-tab-<?php echo esc_attr($category->slug); ?>">

						<?php
						if ($layout === 'list') : ?>
							<div class="services__tab_heading mbdc_b mbdc_a">
								<span><?php echo sanitize_text_field($category->name); ?></span>
							</div>
						<?php endif; ?>

						<?php while ($posts->have_posts()) {
							$posts->the_post();
							$post_classes = array('service__tab_item');
							$price = get_post_meta(get_the_ID(), 'service_price', true);
							$badge = get_post_meta(get_the_ID(), 'service_badge', true);


							if ($show_image === 'show' && !empty(get_the_post_thumbnail())) {
								$post_classes[] = 'tab_item_has_image';
							}
							?>

							<div <?php post_class(implode(' ', $post_classes)); ?>>
								<div class="service__tab_item_wrapper">

									<?php
									if ($show_image === 'show' && !empty(get_the_post_thumbnail_url())) :
										$image = pearl_get_VC_post_img_safe(get_the_ID(), $img_size,'full', true); ?>
									<a href="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" 
										class="service__image stm_price_list__image <?php if ($lightbox === 'enable') echo "stm_lightgallery__selector"; ?>"
										title="<?php echo esc_attr(get_the_title()) . ' - ' . esc_attr($price); ?>">
										<img src="<?php echo esc_attr($image); ?>" alt="<?php the_title(); ?>">
										<?php if ($badge) : ?>
											<span class="service__badge sbc"><?php echo esc_html($badge); ?></span>
										<?php endif; ?>
									</a>
									<?php endif; ?>

									<div class="service__tab_item_body">

										<h4 <?php the_title_attribute(); ?> class="service__header service__name">
											<?php if ($post_link) : ?>
												<a class="ttc no_deco" <?php the_title_attribute(); ?>
													href="<?php the_permalink(); ?>">
													<?php endif; ?>
													<?php if($style === 'style_2') {
														echo pearl_minimize_word(get_the_title(), 32, '');
													} else {
														the_title();
													}
													if ($post_link) : ?>
												</a>
											<?php endif; ?>
										</h4>

										<div class="service__text">
											<?php echo pearl_minimize_word(get_the_excerpt(), $excerpt_length); ?>
										</div>

										<div class="service__cost mtc">
											<span><?php echo esc_html($price); ?></span>
										</div>

									</div>
								</div>

							</div>

						<?php }
						wp_reset_postdata(); ?>

					</div>
				<?php } ?>
			<?php } ?>
		</div>

		<?php if (!empty($link) && !empty(array_filter($link))) :
			$btn_clasess = array('btn', 'btn_solid', 'btn_primary');
			?>
			<div class="services_price_list__button mbdc_b mbdc_a">
				<a class="<?php echo esc_attr(implode(' ', $btn_clasess)) ?>"
				   href="<?php echo esc_attr($link['url']); ?>"
					<?php if (!empty($link['rel'])) echo 'rel=" ' . $link['rel'] . ' "'; ?>
					<?php if (!empty($linl['target'])) echo 'target=" ' . $link['target'] . ' "'; ?>
				   title="<?php echo esc_attr($link['title']); ?>"><?php echo esc_html($link['title']) ?></a>
			</div>
		<?php endif; ?>


	</div>
<?php } ?>

