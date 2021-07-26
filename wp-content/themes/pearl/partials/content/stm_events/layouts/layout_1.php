<?php $tpl = 'partials/content/stm_events/single/'; ?>

<h2 class="stm_single_event__title text-transform"><?php the_title(); ?></h2>

<?php get_template_part($tpl . 'address'); ?>

<?php get_template_part($tpl . 'actions'); ?>

<div class="stm_single_event__content"><?php the_content(); ?></div>

<?php get_template_part($tpl . 'panel'); ?>

<div class="stm_single_event__excerpt stm_mgb_30"><?php the_excerpt(); ?></div>

<?php get_template_part($tpl . 'join_form'); ?>