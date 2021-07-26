<?php

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$classes = array('stm_open_table', 'stm_open_table_' . $style);
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);

pearl_add_element_style('open_table', $style);

$type = 'Open_Table_Widget';
$args = array(
	'widget_id' => uniqid('stm_open_table')
);
global $wp_widget_factory;


$output = '';

if (is_object($wp_widget_factory) && isset($wp_widget_factory->widgets, $wp_widget_factory->widgets[$type])) {
	?>
	<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
		<div class="top_deco"></div>
		<?php if (!empty($title)) : ?>
			<?php if ($style == 'style_2'): ?>
			<h2 class="stm_open_table__title">
				<?php echo wp_kses_post($title); ?>
			</h2>
			<?php else: ?>
			<div class="stm_open_table__title mtc">
				<?php echo wp_kses_post($title); ?>
			</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ($powered): ?>
		<div class="stm_open_table__powered">
			<?php echo esc_html('POWERED BY OPENTABLE', 'pearl'); ?>
		</div>
		<?php endif; ?>

		<?php if (!empty($content) && $style == 'style_2') : ?>
		<div class="stm_open_table__content">
			<?php echo wp_kses_post($content); ?>
		</div>
		<?php endif; ?>


		<?php
		unset($atts['title']);
		ob_start();
		the_widget($type, $atts, $args);
		$output .= ob_get_clean();

		echo html_entity_decode($output);
		?>
		<div class="bottom_deco"></div>
	</div>
	<?php
}