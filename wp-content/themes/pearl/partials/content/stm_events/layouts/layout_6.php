<?php $tpl = 'partials/content/stm_events/single/'; ?>

<?php get_template_part($tpl . 'address'); ?>

<div class="stm_single_event__excerpt stm_mgb_30">
    <?php the_excerpt(); ?>
    <?php get_template_part($tpl . 'actions'); ?>
</div>

<div class="stm_single_event__content">
    <?php the_content(); ?>
</div>