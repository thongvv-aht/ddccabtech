<?php
$id = get_the_ID();
$date_start = get_post_meta($id, 'date_start', true);
$address = get_post_meta($id, 'address', true);
$subtitle = get_post_meta($id, 'desc', true);


$link = get_post_meta($id, 'link', true);
$link_text = get_post_meta($id, 'link_text', true);

$link_text = (!empty($link_text)) ? $link_text : esc_html__('View more', 'pearl');
$link_url = (!empty($link)) ? $link : get_permalink();
$target = (!empty($link)) ? '_blank' : '';
$before_title = $after_title = '';


if (pearl_custom_post_single_enabled('events')) {
    $before_title = '<a class="wtc" href="'. get_the_permalink() .'">';
    $after_title = '</a>';
}

?>

<div
    <?php  post_class('stm_event_single_list no_deco'); ?>>

    <?php if(!empty($date_start)): ?>
        <div class="stm_event_single_list__alone hasDate heading_font">
            <span class="month_number">
                <?php echo sanitize_text_field(pearl_get_formatted_date($date_start, 'M')); ?>
                <?php echo sanitize_text_field(pearl_get_formatted_date($date_start, 'j')); ?>
            </span>
            <span class="day">
                <?php echo sanitize_text_field(pearl_get_formatted_date($date_start, 'D')); ?>
            </span>
        </div>
    <?php endif; ?>

    <div class="stm_event_single_list__alone hasTitle">
        <h3>
            <?php the_title($before_title, $after_title); ?>
        </h3>
    </div>
    <div class="stm_event_single_list__alone hasAddress heading_font">
        <?php echo sanitize_text_field($address); ?>
    </div>
    <div class="stm_event_single_list__alone hasButton">
        <a class="btn btn_solid btn_primary" href="<?php echo esc_url($link_url); ?>"
           <?php the_title_attribute(); ?>
           target="<?php echo sanitize_text_field($target); ?>">
            <?php echo sanitize_text_field($link_text); ?>
        </a>
    </div>
</div>