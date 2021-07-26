<?php $tpl = 'partials/content/stm_events/single/'; ?>

<?php get_template_part($tpl . 'title_box_3'); ?>

<?php get_template_part($tpl . 'address'); ?>

<?php get_template_part($tpl . 'thumbnail'); ?>

<?php get_template_part($tpl . 'actions_2'); ?>

<div class="stm_single_event__content"><?php the_content(); ?></div>

<?php get_template_part($tpl . 'panel_2'); ?>

<div class="stm_single_event__excerpt stm_mgb_30"><?php the_excerpt(); ?></div>

<?php get_template_part($tpl . 'join_form_2'); ?>