<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$classes = array();

pearl_add_element_style('ordered_list', $style);

if (isset($atts['list']) && strlen($atts['list']) > 0) {
    $atts['list'] = vc_param_group_parse_atts($atts['list']);
}

$color = (isset($atts['color']) && strlen($atts['color']) > 0) ? $atts['color'] : pearl_get_option('third_color');

$index = 0;

if (!empty($atts['list']) && is_array($atts['list'])):
	$list = $atts['list']; ?>
    <ul class="ordered_list <?php echo esc_attr(implode(' ', $classes)); ?>">
        <?php foreach ($list as $list_item):
            if (empty(array_filter($list_item))) continue;
            if ($index < 9 && $atts["leading_zero"]) $index = "0" . ($index + 1);
             ?>
            <li>
                <h5 class="ordered_list__text">
                    <span class="ordered_list__number" style="background-color: <?php echo esc_attr($color); ?>">
                        <?php echo esc_html($index); ?>
                    </span>
                    <?php echo esc_html($list_item['text']); ?>
                </h5>
            </li>
		<?php endforeach; ?>
    </ul>
<?php endif;

?>

