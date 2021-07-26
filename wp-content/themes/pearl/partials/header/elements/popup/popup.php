<?php if (!empty($element['data'])):

    $btn_c = array(
		'btn btn_primary btn_solid'
    );

    $icon = $text = '';
    if (!empty($element['data']['icon'])) {
        $icon = $element['data']['icon'];
        $btn_c[] = 'stm-button_icon';
    }

    $text = (!empty($element['data']['text'])) ? $element['data']['text'] : '';

    $target = 'headerModal' . $element['value'];
    ?>

    <a href="#"
       data-toggle="modal"
       data-target="#<?php echo esc_attr($target); ?>"
       class="stm-header-popup__button <?php echo implode(' ', $btn_c); ?>">
        <i class="stm-button__icon <?php echo esc_attr($icon); ?>"></i>
        <span class="stm-button__text"><?php echo sprintf(_x('%s', 'STM button text', 'pearl'), $text); ?></span>
    </a>


    <!--Popup itself-->
    <?php if (!empty($element['value'])): ?>
        <?php pearl_load_element('popup', array('page_id' => $element['value']), 'modal'); ?>
		<script>
			(function($){
				$(document).ready(function(){
					var popup = $('#headerModal<?php echo esc_js($element['value']) ?>');
					popup.appendTo('body');
				})
			})(jQuery)
		</script>
    <?php endif;

endif; ?>
