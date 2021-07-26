<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$rand = uniqid('stm_album_info');

$classes = array('stm_album_info');
$classes[] = $rand;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = 'stm_album_info_' . $style;

$classes[] = (!empty($inversed)) ? 'inversed wtc' : '';

pearl_add_element_style('album_info', $style);

if (empty($album) and get_post_type() == 'stm_albums') $album = get_the_ID();

if (!empty($album)):
	$player_cols = 'col-md-12';
	$album_links = get_post_meta($album, 'album_links', true);
	if (has_post_thumbnail($album) or !empty($album_links)) {
		$player_cols = 'col-md-8';
	};
	$playlist = pearl_create_playlist($album);
	?>

	<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
        <?php pearl_load_vc_element('album_info', $atts, $style); ?>
	</div>

<?php endif; ?>