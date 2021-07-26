<?php

/**
 * @var $donation STM_Donation
 */

$donation = STM_Donation::instance(get_the_ID());


$parts = 'partials/content/stm_donations/parts/';
$path = 'partials/content/stm_donations/single/';

get_template_part($parts . 'post_info');
get_template_part($parts . 'image');
get_template_part($parts . 'details');


?>

<div class="stm_single_donation__content">
    <?php the_content(); ?>
</div>

<?php
get_template_part($path . 'actions');

get_template_part($path . 'comments');


$donation->print_form_modal();