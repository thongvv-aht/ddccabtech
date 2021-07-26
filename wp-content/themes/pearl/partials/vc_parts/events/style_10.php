<?php
$id = get_the_ID();
$date_start = get_post_meta($id, 'date_start', true);
$date_end = get_post_meta($id, 'date_end', true);
$date_start_time = get_post_meta($id, 'date_start_time', true);
$date_end_time = get_post_meta($id, 'date_end_time', true);
$address = get_post_meta($id, 'address', true);

$link = get_post_meta($id, 'link', true);
$link_text = get_post_meta($id, 'link_text', true);

$link_text = (!empty($link_text)) ? $link_text : esc_html__('Read more', 'pearl');
$link_url = (!empty($link)) ? $link : get_permalink();

$date_day_start = (!empty($date_start)) ? pearl_get_formatted_date($date_start, 'j') : '';
$date_day_end = (!empty($date_end)) ? pearl_get_formatted_date($date_end, 'j') : '';
$date_month_start = (!empty($date_start)) ? pearl_get_formatted_date($date_start, 'F') : '';
$date_month_end = (!empty($date_end)) ? pearl_get_formatted_date($date_end, 'F') : '';
$date_year_start = (!empty($date_start)) ? pearl_get_formatted_date($date_start, 'Y') : '';
$date_year_end = (!empty($date_end)) ? pearl_get_formatted_date($date_end, 'Y') : '';

$date = $time = '';
if( $date_month_start === $date_month_end ) {
    $date .= $date_month_start;
    if( $date_day_start < $date_day_end ) {
        $date .= ' ' . $date_day_start . ' &ndash; ' . $date_day_end;
    } else {
        $date .= ' ' .$date_day_start;
    }
    $date .= ', ' . $date_year_start;
} elseif(empty($date_month_end)) {
    $date .= $date_month_start . ' ' . $date_day_start . ', ' . $date_year_start;
} elseif($date_year_start != $date_year_end) {
    $date .= $date_month_start . ' ' . $date_day_start . ', ' . $date_year_start . ' &ndash; ' . $date_month_end . ' ' . $date_day_end . ', ' . $date_year_end;
} else {
    $date .= $date_month_start . ' ' . $date_day_start;
    $date .= ' &ndash; ' . $date_month_end . ' ' . $date_day_end;
    $date .= ', ' . $date_year_start;
}


if(!empty($date_start_time)) $time .= $date_start_time;

?>

<div <?php echo esc_attr(post_class('stm_event_single_list col-md-6')); ?>>

    <div class="stm_event_single_list__item">
        <?php if(has_post_thumbnail()):
            $img_id = get_post_thumbnail_id($id);
            $image = pearl_get_VC_img($img_id, '555x250');
            echo wp_kses_post($image);
        endif; ?>

        <div class="stm_event_single_list__content">
            <div class="stm_event_single_list__title">
                <h2><?php the_title(); ?></h2>
            </div>
            <div class="stm_event_single_list__info">
                <span class="stm_event_single_list__address"><?php echo sanitize_text_field($address); ?></span><span class="stm_event_single_list__date"><?php echo esc_attr($date); ?></span>
            </div>
            <div class="stm_event_single_list__action">
                <a href="<?php the_permalink(); ?>" class="stm_event_single_list__btn btn btn_solid btn_primary btn_left">
                    <?php echo sanitize_text_field($link_text); ?>
                </a>
            </div>

        </div>

    </div>

</div>
