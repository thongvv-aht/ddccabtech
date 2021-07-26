<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
pearl_add_element_style('circle_progress');


wp_enqueue_script( 'circle-progress' );

$circle_id = uniqid( 'circle_progress_' );

if( empty( $fill_color ) ){
	$fill_color = pearl_get_option('main_color', '#34ccff');
}

?>

<?php if ( $value || $title ): ?>
	<div class="circle_progress_wr<?php echo esc_attr( $css_class ); ?>">
		<div class="circle_progress">
			<div id="<?php echo esc_attr( $circle_id ); ?>"<?php echo ( ! empty( $size ) ) ? ' style="width: ' . esc_attr( $size ) . 'px; height: ' . esc_attr( $size ) . 'px;"' : ''; ?>>
				<div class="info">
					<div class="value"><?php echo esc_html( $value ); ?><i>%</i></div>
					<div class="title"><?php echo esc_html( $title ); ?></div>
				</div>
			</div>
		</div>
		<script>
			jQuery(document).ready(function ($) {
				var value_1 = <?php echo esc_js( $value ); ?> / 100;
				var value_2 = <?php echo esc_js( $value ); ?>;
				var inited = false;
				var circleEl = $('#<?php echo esc_js( $circle_id ); ?>');

				$(window).scroll(function () {

				circleEl.each(function () {
						if ($(this).is_on_screen()) {
							if (!inited) {
								$(this).circleProgress({
									value: value_1,
									size: <?php echo esc_js($size); ?>,
									thickness: 4,
									startAngle: -Math.PI / 4 * 2,
									animation: true,
									fill: {color: '<?php echo esc_js( $fill_color ); ?>'}
								}).on('circle-animation-progress', function (event, progress) {
									$(this).find('.value').html(parseInt(value_2 * progress) + '<i>%</i>');
									inited = true;
								});
							}
						}
					})
				})
			});
		</script>
	</div>
<?php endif; ?>