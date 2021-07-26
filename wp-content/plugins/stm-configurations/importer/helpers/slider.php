<?php

function stm_theme_import_sliders($layout)
{
	$slider_names = array(
		'business' => array(
			'homeslider',
		),
		'construction' => array(
			'main_slider',
			'about_us'
		),
        'logisticstwo' => array(
            'transportation-two',
            'about_us_slider'
        ),
        'constructiontwo' => array(
            'main_slider',
            'about_us'
        ),
		'artist' => array(
			'home_slider',
		),
		'logistics' => array(
			'about_us_slider'
		),
		'beauty' => array(
			'main_slider'
		),
		'restaurant' => array(
			'bonappetit'
		),
        'rental' => array(
			'home_slider'
		),
		'church' => array(
			'main-slider'
		),
        'store' => array(
            'home_slider',
            'about_slider'
        ),
        'factory' => array(
            'home_slider'
        ),
		'furniture' => array(
			'home_slider'
		),
		'renovation' => array(
			'main_slider',
			'about_us'
		),
        'digital' => array(
            'home_slider'
        ),
        'politician' => array(
            'home_slider'
        ),
        'finance' => array(
            'home_slider'
        ),
        'creative' => array(
            'home_slider'
        ),
        'dj' => array(
            'home_slider',
            'albums'
        ),
        'businesstwo' => array(
            'home_slider'
        ),
        'consulting' => array(
            'home_slider'
        ),
        'creativetwo' => array(
            'home_slider'
        ),
        'conference' => array(
            'home_slider'
        ),
        'app' => array(
            'home_slider'
        ),
        'businessthree' => array(
            'home_slider'
        ),
        'seoagency' => array(
            'home_slider'
        ),
        'sports_complex' => array(
            'home_slider'
        ),
        'gym' => array(
            'gym_slider'
        ),
	);

	if (!empty($slider_names[$layout])) {
		if (class_exists('RevSlider')) {
			$path = STM_CONFIGURATIONS_PATH . '/importer/demos/' . $layout . '/sliders/';
			foreach ($slider_names[$layout] as $slider_name) {
				$slider_path = $path . $slider_name . '.zip';
				if (file_exists($slider_path)) {
					$slider = new RevSlider();
					$slider->importSliderFromPost(true, true, $slider_path);
				}
			}
		}
	}
}