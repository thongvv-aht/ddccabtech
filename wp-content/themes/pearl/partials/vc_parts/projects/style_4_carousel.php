<?php
$link = vc_build_link($link);

$args = array(
    'post_type'      => 'stm_projects',
    'posts_per_page' => intval($number),
    'post_status'    => 'publish',
    'meta_query'     => array(
        array(
            'key' => '_thumbnail_id'
        )
    )
);

$id = 'stm_testimonial__carousel_' . pearl_random();

$q = new WP_Query($args);

$project_classes = array(
    'stm_projects_carousel__item stm_owl__glitches',
    'stm_item',
    'active_all'
);

if ($q->have_posts()):
    $link_filter = array_filter($link);
    if(empty($link['target'])) $link['target'] = '_self';
    ?>

    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">

        <div class="stm_projects_carousel__carousels">
            <div class="stm_projects_carousel__carousel owl-carousel"
                 id="<?php echo esc_attr($id) ?>">
                <?php while ($q->have_posts()): $q->the_post();
                    $post_id = get_the_ID();
                    $img_id = get_post_thumbnail_id($post_id);
                    $img = pearl_get_VC_img($img_id, $img_size);
                    $post_categories = get_the_terms($post_id, 'project_category');
                    ?>
                    <a href="<?php the_permalink(); ?>"
                        <?php post_class($project_classes); ?>
                       target="_self"
                       <?php the_title_attribute(); ?>>
                        <?php echo html_entity_decode($img); ?>
                        <span class="stm_projects_carousel__info">
                            <span class="stm_projects_carousel__category">
                                <?php
                                    foreach ( $post_categories as $category ) {
                                        echo esc_attr($category->name);
                                    }
                                ?>
                            </span>
                            <h4 class="stm_projects_carousel__name no_line">
                                <?php the_title(); ?>
                            </h4>
                            <span class="stm_projects_carousel__description"><?php echo pearl_minimize_word(get_the_excerpt(), 120); ?></span>
                        </span>
                    </a>

                <?php endwhile; ?>

            </div>
        </div>

    </div>

    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                var owlRtl = false;
                if ($('body').hasClass('rtl')) {
                    owlRtl = true;
                }

                var owl = $('#<?php echo esc_js($id); ?>').owlCarousel({
                    rtl: owlRtl,
                    items: 3,
                    dots: true,
                    nav: false,
                    autoplay: <?php echo esc_js($autoscroll); ?>,
                    slideBy: 1,
                    responsive: {
                        0: {
                            items: 1
                        },
                        767: {
                            items: 2
                        },
                        1024: {
                            items: 3
                        }
                    },
                    navText: '',
                    loop: true,
                });

            });

        })(jQuery);
    </script>

    <?php
    wp_reset_postdata();
endif;

?>
