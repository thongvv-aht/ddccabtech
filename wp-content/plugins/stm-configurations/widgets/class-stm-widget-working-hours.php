<?php

class Pearl_Working_Hours extends WP_Widget
{

	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'working_hours', // Base ID
		 esc_html__('Working Hours', 'stm-configurations'), // Name
			array('description' => esc_html__('Office working hours', 'stm-configurations'),) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance)
	{
		$title = !empty($instance['title']) ? $instance['title'] : '';

		$s = isset($instance['style']) ? $instance['style'] : 'style_1';
		pearl_add_widget_style('working_hours', $s);


		if (empty($args['before_widget'])) {
			$args['before_widget'] = '<aside class="widget widget-default working_hours mbdc working_hours_' . esc_attr($s) . '">';
		} else {
			$args['before_widget'] = str_replace('class="', 'class="working_hours_' . esc_attr($s) . ' ', $args['before_widget']);
		}
		if (empty($args['after_widget'])) {
			$args['after_widget'] = '</aside>';
		}
		if (!isset($args['widget_id'])) {
			$args['widget_id'] = $this->id;
		}

		echo html_entity_decode($args['before_widget']);
		if (!empty($title)) {
			echo html_entity_decode($args['before_title'] . esc_html($title) . $args['after_title']);
		}


		$days = array(
			'monday'    => esc_html__('Monday', 'stm-configurations'),
			'tuesday'   => esc_html__('Tuesday', 'stm-configurations'),
			'wednesday' => esc_html__('Wednesday', 'stm-configurations'),
			'thursday'  => esc_html__('Thursday', 'stm-configurations'),
			'friday'    => esc_html__('Friday', 'stm-configurations'),
			'saturday'  => esc_html__('Saturday', 'stm-configurations'),
			'sunday'    => esc_html__('Sunday', 'stm-configurations')
		);

        $current_day = date('N');
        $day_week = 1;
        ?>

		<div class="widget_inner">
			<table class="table_working_hours">
				<?php foreach ($days as $key => $day):
                    $active = ($day_week == $current_day) ? 'active' : '';

					if (!empty($instance[$key])): ?>
						<tr class="opened <?php echo esc_attr($active); ?>">
							<td class="day_label"><?php echo esc_attr($day); ?></td>
							<?php if ($s === 'style_3') : ?>
								<td class="day_sep">
									<div class="sep_item"></div>
								</td>
							<?php endif; ?>
							<td class="day_value"><?php echo esc_attr($instance[$key]); ?></td>
						</tr>
					<?php else: ?>
						<tr class="closed <?php echo esc_attr($active); ?>">
							<td class="day_label"><?php echo esc_attr($day); ?></td>
							<td class="day_value closed"><span><?php _e('Closed', 'stm-configurations'); ?></span>
							</td>
						</tr>
					<?php endif;
					$day_week++;
				endforeach; ?>
			</table>
		</div>
        <?php if(!empty($instance['socials']) and $instance['socials']):
            $socials = pearl_get_option('footer_socials');
            if (!empty($socials)): ?>
                <div class="stm-socials stm_mgt_29">
                    <?php foreach ($socials as $item):
                        if (!empty($item['social']) and !empty($item['url'])): ?>
                            <a href="<?php echo esc_url($item['url']); ?>"
                               class="stm-socials__icon stm-socials__icon_icon_only icon_24px stm-socials_opacity-hover"
                               target="_blank"
                               title="<?php esc_html_e('Social item', 'stm-configurations'); ?>">
                                <i class="<?php echo esc_attr($item['social']); ?>"></i>
                            </a>
                        <?php endif;
                    endforeach; ?>
                </div>
            <?php endif;
        endif; ?>

		<?php echo html_entity_decode($args['after_widget']);
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance)
	{

		$title = '';
		$monday = '';
		$tuesday = '';
		$wednesday = '';
		$thursday = '';
		$friday = '';
		$saturday = '';
		$sunday = '';

		$styles = pearl_load_styles(3);
		$styles = $styles['value'];
		$style_current = (!empty($instance['style'])) ? $instance['style'] : 'style_1';


		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = esc_html__('Working hours', 'stm-configurations');
		}

		if (isset($instance['monday'])) {
			$monday = $instance['monday'];
		}

		if (isset($instance['tuesday'])) {
			$tuesday = $instance['tuesday'];
		}

		if (isset($instance['wednesday'])) {
			$wednesday = $instance['wednesday'];
		}

		if (isset($instance['thursday'])) {
			$thursday = $instance['thursday'];
		}

		if (isset($instance['friday'])) {
			$friday = $instance['friday'];
		}

		if (isset($instance['saturday'])) {
			$saturday = $instance['saturday'];
		}

		if (isset($instance['sunday'])) {
			$sunday = $instance['sunday'];
		}

		?>
		<p>
			<label
				for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'stm-configurations'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
				   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
				   value="<?php echo esc_attr($title); ?>">
		</p>
		<p>
			<label
				for="<?php echo esc_attr($this->get_field_id('monday')); ?>"><?php _e('Monday', 'stm-configurations'); ?>
				:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('monday')); ?>"
				   name="<?php echo esc_attr($this->get_field_name('monday')); ?>" type="text"
				   value="<?php echo esc_attr($monday); ?>">
		</p>
		<p>
			<label
				for="<?php echo esc_attr($this->get_field_id('tuesday')); ?>"><?php _e('Tuesday', 'stm-configurations'); ?>
				:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('tuesday')); ?>"
				   name="<?php echo esc_attr($this->get_field_name('tuesday')); ?>" type="text"
				   value="<?php echo esc_attr($tuesday); ?>">
		</p>
		<p>
			<label
				for="<?php echo esc_attr($this->get_field_id('wednesday')); ?>"><?php _e('Wednesday', 'stm-configurations'); ?>
				:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('wednesday')); ?>"
				   name="<?php echo esc_attr($this->get_field_name('wednesday')); ?>" type="text"
				   value="<?php echo esc_attr($wednesday); ?>">
		</p>
		<p>
			<label
				for="<?php echo esc_attr($this->get_field_id('thursday')); ?>"><?php _e('Thursday', 'stm-configurations'); ?>
				:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('thursday')); ?>"
				   name="<?php echo esc_attr($this->get_field_name('thursday')); ?>" type="text"
				   value="<?php echo esc_attr($thursday); ?>">
		</p>
		<p>
			<label
				for="<?php echo esc_attr($this->get_field_id('friday')); ?>"><?php _e('Friday', 'stm-configurations'); ?>
				:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('friday')); ?>"
				   name="<?php echo esc_attr($this->get_field_name('friday')); ?>" type="text"
				   value="<?php echo esc_attr($friday); ?>">
		</p>
		<p>
			<label
				for="<?php echo esc_attr($this->get_field_id('saturday')); ?>"><?php _e('Saturday', 'stm-configurations'); ?>
				:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('saturday')); ?>"
				   name="<?php echo esc_attr($this->get_field_name('saturday')); ?>" type="text"
				   value="<?php echo esc_attr($saturday); ?>">
		</p>
		<p>
			<label
				for="<?php echo esc_attr($this->get_field_id('sunday')); ?>"><?php _e('Sunday', 'stm-configurations'); ?>
				:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('sunday')); ?>"
				   name="<?php echo esc_attr($this->get_field_name('sunday')); ?>" type="text"
				   value="<?php echo esc_attr($sunday); ?>">
		</p>

		<p>
			<select class="widefat" name="<?php echo esc_attr($this->get_field_name('style')) ?>"
					id="<?php echo esc_attr($this->get_field_id('style')) ?>">
				<?php
				foreach ($styles as $style_name => $style_class) {

					$selected = selected($style_current, $style_class, false);
					echo "<option {$selected} value='" . esc_attr($style_class) . "'>" . sanitize_text_field($style_name) . "</option>";
				}
				?>
			</select>
		</p>
        <p><input id="<?php echo esc_attr($this->get_field_id( 'socials' )); ?>"
                  name="<?php echo esc_attr($this->get_field_name( 'socials' )); ?>"
                  type="checkbox" <?php checked( isset( $instance['socials'] ) ? $instance['socials'] : 0 ); ?> />&nbsp;<label
                for="<?php echo esc_attr($this->get_field_id( 'socials' )); ?>"><?php esc_html_e( 'Add Socials Widget', 'stm-configurations' ); ?></label>
        </p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? esc_attr($new_instance['title']) : '';
		$instance['monday'] = (!empty($new_instance['monday'])) ? esc_attr($new_instance['monday']) : '';
		$instance['tuesday'] = (!empty($new_instance['tuesday'])) ? esc_attr($new_instance['tuesday']) : '';
		$instance['wednesday'] = (!empty($new_instance['wednesday'])) ? esc_attr($new_instance['wednesday']) : '';
		$instance['thursday'] = (!empty($new_instance['thursday'])) ? esc_attr($new_instance['thursday']) : '';
		$instance['friday'] = (!empty($new_instance['friday'])) ? esc_attr($new_instance['friday']) : '';
		$instance['saturday'] = (!empty($new_instance['saturday'])) ? esc_attr($new_instance['saturday']) : '';
		$instance['sunday'] = (!empty($new_instance['sunday'])) ? esc_attr($new_instance['sunday']) : '';
		$instance['style'] = isset($new_instance['style']) ? $new_instance['style'] : 'style_1';
        $instance['socials'] = ! empty( $new_instance['socials'] );


		return $instance;
	}

}

function pearl_register_working_hours_widget()
{
	register_widget('Pearl_Working_Hours');
}

add_action('widgets_init', 'pearl_register_working_hours_widget');