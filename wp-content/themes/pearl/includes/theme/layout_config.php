<?php
/**
 * Get theme current layout
 *
 */
function pearl_get_layout()
{
    return (apply_filters('stm_layout', get_option('stm_layout', 'business')));
}

/**
 * Get layout configs
 *
 * @param string $layout
 * @return mixed
 */
function pearl_get_layout_config($layout = 'business')
{
    $layout = pearl_get_layout();
    $layouts = pearl_layout_configs();

    return $layouts[$layout];
}
/**
 * Default layouts configs
 *
 * @return array
 */
function pearl_layout_configs()
{
    $layouts = array(
        'business' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#222',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Exo',
                'subsets' => 'latin,latin-ext',
                'color' => '#3c98ff',
                'fw' => '800',
            ),
            'main_color' => '#3c98ff',
            'secondary_color' => '#3c98ff',
            'third_color' => '#293742',
            'logo' => 'light'
        ),
        'construction' => array(
            'main_font' => array(
                'name' => 'Roboto',
                'color' => '#333333',
                'size' => '14',
                'fw' => '400',
                'ln' => '16'
            ),
            'secondary_font' => array(
                'name' => 'Roboto',
                'subsets' => 'latin,latin-ext',
                'color' => '#333',
                'fw' => '900'
            ),
            'main_color' => '#dac725',
            'secondary_color' => '#dac725',
            'third_color' => '#333333',
            'logo' => 'dark'
        ),
        'constructiontwo' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'color' => '#333333',
                'size' => '15',
                'fw' => '400',
                'ln' => '16'
            ),
            'secondary_font' => array(
                'name' => 'Noto Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#333',
                'fw' => '700'
            ),
            'main_color' => '#dac725',
            'secondary_color' => '#dac725',
            'third_color' => '#333333',
            'logo' => 'dark'
        ),
        'logistics' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'color' => '#333333',
                'size' => '14',
                'fw' => '400',
                'ln' => '16'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#002040',
                'fw' => '900'
            ),
            'main_color' => '#002040',
            'secondary_color' => '#58c747',
            'third_color' => '#122a4c',
            'logo' => 'light'
        ),
        'logisticstwo' => array(
            'main_font' => array(
                'name' => 'Poppins',
                'color' => '#333333',
                'size' => '14',
                'fw' => '400',
                'ln' => '16'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '900'
            ),
            'main_color' => '#297ee8',
            'secondary_color' => '#333333',
            'third_color' => '#297ee8',
            'logo' => 'dark'
        ),
        'beauty' => array(
            'main_font' => array(
                'name' => 'Montserrat',
                'color' => '#808080',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Playfair Display',
                'subsets' => 'latin,latin-ext',
                'color' => '#5c373e',
                'fw' => '700'
            ),
            'main_color' => '#c54045',
            'secondary_color' => '#63bac1',
            'third_color' => '#5c373e',
            'logo' => 'dark'
        ),
        'healthcoach' => array(
            'main_font' => array(
                'name' => 'Source+Sans+Pro',
                'color' => '#888888',
                'size' => '16',
                'fw' => '400',
                'ln' => '30'
            ),
            'secondary_font' => array(
                'name' => 'Lobster+Two',
                'subsets' => 'latin,latin-ext',
                'color' => '#192227',
                'fw' => '700'
            ),
            'main_color' => '#74c000',
            'secondary_color' => '#ff6445',
            'third_color' => '#192227',
            'logo' => 'dark'
        ),
        'medicall' => array(
            'main_font' => array(
                'name' => 'Montserrat',
                'color' => '#595959',
                'size' => '15',
                'fw' => '300',
                'ln' => '30'
            ),
            'secondary_font' => array(
                'name' => 'Rubik',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '400'
            ),
            'main_color' => '#74c000',
            'secondary_color' => '#ff6445',
            'third_color' => '#192227',
            'logo' => 'dark'
        ),
        'charity' => array(
            'main_font' => array(
                'name' => 'Fira Sans',
                'color' => '#808080',
                'size' => '16',
                'fw' => '400',
                'ln' => '28'
            ),
            'secondary_font' => array(
                'name' => 'PT Serif',
                'subsets' => 'latin,latin-ext',
                'color' => '#591e00',
                'fw' => '600'
            ),
            'main_color' => '#fdb714',
            'secondary_color' => '#00749c',
            'third_color' => '#591e00',
            'logo' => 'dark'
        ),
        'artist' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'color' => '#0c0c0d',
                'size' => '15',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Montserrat',
                'subsets' => 'latin,latin-ext',
                'color' => '#0c0c0d',
                'fw' => '700'
            ),
            'main_color' => '#d61515',
            'secondary_color' => '#d61515',
            'third_color' => '#0c0c0d',
            'logo' => 'dark'
        ),
        'restaurant' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#222',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Exo',
                'subsets' => 'latin,latin-ext',
                'color' => '#3c98ff',
                'fw' => '800',
            ),
            'main_color' => '#3c98ff',
            'secondary_color' => '#3c98ff',
            'third_color' => '#293742',
            'logo' => 'light'
        ),
        'rental' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#222',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Exo',
                'subsets' => 'latin,latin-ext',
                'color' => '#3c98ff',
                'fw' => '800',
            ),
            'main_color' => '#3c98ff',
            'secondary_color' => '#3c98ff',
            'third_color' => '#293742',
            'logo' => 'light'
        ),
        'portfolio' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#222',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Exo',
                'subsets' => 'latin,latin-ext',
                'color' => '#3c98ff',
                'fw' => '800',
            ),
            'main_color' => '#3c98ff',
            'secondary_color' => '#3c98ff',
            'third_color' => '#293742',
            'logo' => 'dark'
        ),
        'store' => array(
            'main_font' => array(
                'name' => 'Encode Sans Expanded',
                'subsets' => 'latin,latin-ext',
                'color' => '#000',
                'size' => '14',
                'fw' => '400',
                'ln' => '30'
            ),
            'secondary_font' => array(
                'name' => 'Raleway',
                'subsets' => 'latin,latin-ext',
                'color' => '#000',
                'fw' => '400',
            ),
            'main_color' => '#000000',
            'secondary_color' => '#c64047',
            'third_color' => '#f47969',
            'logo' => 'dark'
        ),
        'personal_blog' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#222',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Exo',
                'subsets' => 'latin,latin-ext',
                'color' => '#3c98ff',
                'fw' => '400',
            ),
            'main_color' => '#3c98ff',
            'secondary_color' => '#3c98ff',
            'third_color' => '#293742',
            'logo' => 'dark'
        ),
        'church' => array(
            'main_font' => array(
                'name' => 'Quattrocento Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#808080',
                'size' => '16',
                'fw' => '400',
                'ln' => '26'
            ),
            'secondary_font' => array(
                'name' => 'Libre Baskerville',
                'subsets' => 'latin,latin-ext',
                'color' => '#1a1a1a',
                'fw' => '6]700',
            ),
            'menu' => array(
                'Main menu' => array(
                    'row' => 'center',
                    'col' => 'right'
                ),
                'Top menu' => array(
                    'row' => 'top',
                    'col' => 'center'
                )
            ),
            'main_color' => '#d9b684',
            'secondary_color' => '#789cb6',
            'third_color' => '#1a1a1a',
            'logo' => 'light'
        ),
        'startup' => array(
            'main_font' => array(
                'name' => 'Muli',
                'subsets' => 'latin,latin-ext',
                'color' => '#222527',
                'size' => '28',
                'fw' => '700',
                'ln' => '40'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#222527',
                'fw' => '600',
            ),
            'main_color' => '#0037c2',
            'secondary_color' => '#0037c2',
            'third_color' => '#222527',
            'logo' => 'light'
        ),
        'viral' => array(
            'main_font' => array(
                'name' => 'Roboto',
                'subsets' => 'latin,latin-ext',
                'color' => '#404040',
                'size' => '16',
                'fw' => '400',
                'ln' => '30'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#000000',
                'fw' => '700',
            ),
            'main_color' => '#000000',
            'secondary_color' => '#289dfd',
            'third_color' => '#ffffff',
            'logo' => 'dark'
        ),
        'magazine' => array(
            'main_font' => array(
                'name' => 'Merriweather',
                'subsets' => 'latin,latin-ext',
                'color' => '#222222',
                'size' => '18',
                'fw' => '400',
                'ln' => '32'
            ),
            'secondary_font' => array(
                'name' => 'Playfair Display',
                'subsets' => 'latin,latin-ext',
                'color' => '#222222',
                'fw' => '700',
            ),
            'menu' => array(
                'Main menu' => array(
                    'row' => 'center',
                    'col' => 'left'
                ),
                'Top menu' => array(
                    'row' => 'top',
                    'col' => 'right'
                )
            ),
            'main_color' => '#222222',
            'secondary_color' => '#0089d8',
            'third_color' => '#0089d8',
            'logo' => 'dark'
        ),
        'lawyer' => array(
            'main_font' => array(
                'name' => 'Merriweather',
                'subsets' => 'latin,latin-ext',
                'color' => '#222222',
                'size' => '18',
                'fw' => '400',
                'ln' => '32'
            ),
            'secondary_font' => array(
                'name' => 'Playfair Display',
                'subsets' => 'latin,latin-ext',
                'color' => '#222222',
                'fw' => '700',
            ),
            'main_color' => '#222222',
            'secondary_color' => '#0089d8',
            'third_color' => '#0089d8',
            'logo' => 'dark'
        ),
        'factory' => array(
            'main_font' => array(
                'name' => 'Roboto',
                'subsets' => 'latin,latin-ext',
                'color' => '#565656',
                'size' => '18',
                'fw' => '300',
                'ln' => '34'
            ),
            'secondary_font' => array(
                'name' => 'Roboto',
                'subsets' => 'latin,latin-ext',
                'color' => '#222222',
                'fw' => '300',
            ),
            'main_color' => '#111111',
            'secondary_color' => '#0172f2',
            'third_color' => '#0172f2',
            'logo' => 'dark'
        ),
        'psychologist' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'size' => '15',
                'fw' => '400',
                'ln' => '32'
            ),
            'secondary_font' => array(
                'name' => 'Raleway',
                'subsets' => 'latin,latin-ext',
                'color' => '#181f45',
                'fw' => '700',
            ),
            'main_color' => '#222222',
            'secondary_color' => '#0089d8',
            'third_color' => '#0089d8',
            'logo' => 'dark'
        ),
        'company' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#222',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Montserrat',
                'subsets' => 'latin,latin-ext',
                'color' => '#222',
                'fw' => '400',
            ),
            'main_color' => '#ec1111',
            'secondary_color' => '#ec1111',
            'third_color' => '#222222',
            'logo' => 'light'
        ),
        'corporate' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#2d2d2c',
                'size' => '16',
                'fw' => '400',
                'ln' => '30'
            ),
            'secondary_font' => array(
                'name' => 'Montserrat',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '400',
            ),
            'main_color' => '#1c41df',
            'secondary_color' => '#1c41df',
            'third_color' => '#333333',
            'logo' => 'light'
        ),
        'furniture' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'size' => '16',
                'fw' => '400',
                'ln' => '30'
            ),
            'secondary_font' => array(
                'name' => 'Roboto Slab',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '700',
            ),
            'main_color' => '#ffdd00',
            'secondary_color' => '#ffdd00',
            'third_color' => '#333333',
            'logo' => 'light'
        ),
        'renovation' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'color' => '#777777',
                'size' => '16',
                'fw' => '400',
                'ln' => '30'
            ),
            'secondary_font' => array(
                'name' => 'Raleway',
                'subsets' => 'latin,latin-ext',
                'color' => '#34495e',
                'fw' => '900'
            ),
            'main_color' => '#f0c61a',
            'secondary_color' => '#f0c61a',
            'third_color' => '#333333',
            'logo' => 'light'
        ),
        'advisory' => array(
            'main_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'size' => '16',
                'fw' => '400',
                'ln' => '30'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#3c98ff',
                'fw' => '700',
            ),
            'main_color' => '#ffb129',
            'secondary_color' => '#ffb129',
            'third_color' => '#3f51b5',
            'logo' => 'dark'
        ),
        'digital' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'color' => '#777777',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '700'
            ),
            'main_color' => '#a0ce4e',
            'secondary_color' => '#f3e500',
            'third_color' => '#333333',
            'logo' => 'light'
        ),
        'politician' => array(
            'main_font' => array(
                'name' => 'Ubuntu',
                'color' => '#808080',
                'size' => '15',
                'fw' => '400',
                'ln' => '26'
            ),
            'secondary_font' => array(
                'name' => 'Saira',
                'subsets' => 'latin,latin-ext',
                'color' => '#23282d',
                'fw' => '500'
            ),
            'main_color' => '#313366',
            'secondary_color' => '#dd3a45',
            'third_color' => '#23282d',
            'logo' => 'dark'
        ),
        'finance' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'color' => '#777777',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Rajdhani',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '700'
            ),
            'main_color' => '#00a63f',
            'secondary_color' => '#00a63f',
            'third_color' => '#213364',
            'logo' => 'light'
        ),
        'creative' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'color' => '#777777',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Roboto',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '700'
            ),
            'main_color' => '#7988cb',
            'secondary_color' => '#ffcc5e',
            'third_color' => '#222222',
            'logo' => 'dark'
        ),
        'dj' => array(
            'main_font' => array(
                'name' => 'Montserrat',
                'color' => '#333333',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Oswald',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '700'
            ),
            'main_color' => '#b40000',
            'secondary_color' => '#b40000',
            'third_color' => '#000000',
            'logo' => 'light'
        ),
        'businesstwo' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'color' => '#93a2c4',
                'size' => '15',
                'fw' => '400',
                'ln' => '26'
            ),
            'secondary_font' => array(
                'name' => 'Economica',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '700'
            ),
            'main_color' => '#f47957',
            'secondary_color' => '#23282d',
            'third_color' => '#0b86a8',
            'logo' => 'dark'
        ),
        'consulting' => array(
            'main_font' => array(
                'name' => 'Roboto',
                'color' => '#1c1d1b',
                'size' => '15',
                'fw' => '400',
                'ln' => '26'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#1c1d1b',
                'fw' => '600'
            ),
            'main_color' => '#1c1d1b',
            'secondary_color' => '#ffce4b',
            'third_color' => '#1c1d1b',
            'logo' => 'light'
        ),
        'creativetwo' => array(
            'main_font' => array(
                'name' => 'Roboto',
                'color' => '#808080',
                'size' => '15',
                'fw' => '400',
                'ln' => '26'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#0a1a40',
                'fw' => '600'
            ),
            'main_color' => '#0a1a40',
            'secondary_color' => '#6e7bff',
            'third_color' => '#0a1a40',
            'logo' => 'dark'
        ),
        'conference' => array(
            'main_font' => array(
                'name' => 'Montserrat',
                'color' => '#808080',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Cairo',
                'subsets' => 'latin,latin-ext',
                'color' => '#231f20',
                'fw' => '700'
            ),
            'main_color' => '#231f20',
            'secondary_color' => '#ff481f',
            'third_color' => '#231f20',
            'logo' => 'light'
        ),
        'app' => array(
            'main_font' => array(
                'name' => 'Fira Sans',
                'color' => '#333333',
                'size' => '17',
                'fw' => '400',
                'ln' => '25'
            ),
            'secondary_font' => array(
                'name' => 'Fira Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#222527',
                'fw' => '500'
            ),
            'main_color' => '#222527',
            'secondary_color' => '#b06afe',
            'third_color' => '#40a6ff',
            'logo' => 'light'
        ),
        'businessthree' => array(
            'main_font' => array(
                'name' => 'Fira Sans',
                'color' => '#1c1d1b',
                'size' => '15',
                'fw' => '400',
                'ln' => '26'
            ),
            'secondary_font' => array(
                'name' => 'Nunito Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#1c1d1b',
                'fw' => '700'
            ),
            'main_color' => '#1c1d1b',
            'secondary_color' => '#3f9f42',
            'third_color' => '#1c1d1b',
            'logo' => 'dark'
        ),
        'seoagency' => array(
            'main_font' => array(
                'name' => 'Raleway',
                'color' => '#323a45',
                'size' => '15',
                'fw' => '400',
                'ln' => '26'
            ),
            'secondary_font' => array(
                'name' => 'Raleway',
                'subsets' => 'latin,latin-ext',
                'color' => '#323a45',
                'fw' => '300'
            ),
            'main_color' => '#5d95fc',
            'secondary_color' => '#e48377',
            'third_color' => '#323a45',
            'logo' => 'dark'
        ),
        'portfoliotwo' => array(
            'main_font' => array(
                'name' => 'Karla',
                'subsets' => 'latin,latin-ext',
                'color' => '#222',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
            ),
            'main_color' => '#1b1bff',
            'secondary_color' => '#1b1bff',
            'third_color' => '#000',
            'logo' => 'light'
        ),
        'photographer' => array(
            'main_font' => array(
                'name' => 'Fira Mono',
                'subsets' => 'latin,latin-ext',
                'color' => '#fff',
                'size' => '14',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Rubik',
                'subsets' => 'latin,latin-ext',
                'color' => '#fff',
                'fw' => '800',
            ),
            'main_color' => '#fff',
            'secondary_color' => '#1a1a1a',
            'third_color' => '#fff',
            'logo' => 'light'
        ),
        'businessfour' => array(
            'main_font' => array(
                'name' => 'Montserrat',
                'subsets' => 'latin,latin-ext',
                'color' => '#404040',
                'size' => '14',
                'fw' => '300',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#000',
                'fw' => '600',
            ),
            'main_color' => '#4a57fe',
            'secondary_color' => '#000',
            'third_color' => '#4a57fe',
            'logo' => 'light'
        ),
        'medicaltwo' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'color' => '#404040',
                'size' => '15',
                'fw' => '300',
                'ln' => '30'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '400'
            ),
            'main_color' => '#74c000',
            'secondary_color' => '#ffaa00',
            'third_color' => '#333333',
            'logo' => 'dark'
        ),
        'software' => array(
            'main_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'size' => '16',
                'fw' => '400',
                'ln' => '26'
            ),
            'secondary_font' => array(
                'name' => 'Quicksand',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '700',
            ),
            'main_color' => '#333333',
            'secondary_color' => '#ff5b83',
            'third_color' => '#2e5deb',
            'logo' => 'dark'
        ),
        'coffeeshop' => array(
            'main_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#000000',
                'size' => '16',
                'fw' => '400,700',
                'ln' => '26'
            ),
            'secondary_font' => array(
                'name' => 'Merriweather',
                'subsets' => 'latin,latin-ext',
                'color' => '#000000',
                'fw' => '700',
            ),
            'main_color' => '#000000',
            'secondary_color' => '#f6f0ed',
            'third_color' => '#a66a4d',
            'logo' => 'light'
        ),
        'taxi' => array(
            'main_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'size' => '16',
                'fw' => '400,700',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '700',
            ),
            'main_color' => '#ffd201',
            'secondary_color' => '#aaaaaa',
            'third_color' => '#333333',
            'logo' => 'dark'
        ),
        'sports_complex' => array(
            'main_font' => array(
                'name' => 'Montserrat',
                'subsets' => 'latin,latin-ext',
                'color' => '#555555',
                'size' => '14',
                'fw' => '400',
                'ln' => '30'
            ),
            'secondary_font' => array(
                'name' => 'Roboto Condensed',
                'subsets' => 'latin,latin-ext',
                'color' => '#323232',
                'fw' => '700',
            ),
            'main_color' => '#323232',
            'secondary_color' => '#4fbe6e',
            'third_color' => '#4fbe6e',
            'logo' => 'light'
        ),
        'barbershop' => array(
            'main_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'size' => '16',
                'fw' => '400',
                'ln' => '28'
            ),
            'secondary_font' => array(
                'name' => 'Barlow',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '700',
            ),
            'main_color' => '#333333',
            'secondary_color' => '#ffb852',
            'third_color' => '#ffffff',
            'logo' => 'light'
        ),
        'book' => array(
            'main_font' => array(
                'name' => 'Nunito Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#353c50',
                'size' => '16',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Merriweather',
                'subsets' => 'latin,latin-ext',
                'color' => '#353c50',
                'fw' => '700',
            ),
            'main_color' => '#1fd581',
            'secondary_color' => '#353c50',
            'third_color' => '#353c50',
            'logo' => 'dark'
        ),
        'creativethree' => array(
            'main_font' => array(
                'name' => 'Montserrat',
                'subsets' => 'latin,latin-ext',
                'color' => '#323232',
                'size' => '16',
                'fw' => '400',
                'ln' => '24'
            ),
            'secondary_font' => array(
                'name' => 'Montserrat',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '700',
            ),
            'main_color' => '#323232',
            'secondary_color' => '#25be5a',
            'third_color' => '#5325be',
            'logo' => 'light'
        ),
        'hosting' => array(
            'main_font' => array(
                'name' => 'Montserrat',
                'subsets' => 'latin,latin-ext',
                'color' => '#ffffff',
                'size' => '16',
                'fw' => '400',
                'ln' => '26'
            ),
            'secondary_font' => array(
                'name' => 'Montserrat',
                'subsets' => 'latin,latin-ext',
                'color' => '#353c50',
                'fw' => '700',
            ),
            'main_color' => '#00ce87',
            'secondary_color' => '#ffffff',
            'third_color' => 'rgba(255, 255, 255, .5)',
            'logo' => 'light'
        ),
        'gym' => array(
            'main_font' => array(
                'name' => 'Nunito Sans',
                'subsets' => 'latin,latin-ext',
                'color' => '#ffffff',
                'size' => '16',
                'fw' => '400',
                'ln' => '26'
            ),
            'secondary_font' => array(
                'name' => 'Montserrat',
                'subsets' => 'latin,latin-ext',
                'color' => '#ffffff',
                'fw' => '700',
            ),
            'main_color' => '#77b219',
            'secondary_color' => '#424248',
            'third_color' => '##77d419',
            'logo' => 'light'
        ),
    );

    return $layouts;
}


function pearl_layout_plugins($layout = 'business', $get_layouts = false)
{
    $required = array(
        'stm-configurations',
        'js_composer',
        'contact-form-7',
    );
    $plugins = array(
        'business' => array(
            'revslider',
            'breadcrumb-navxt',
            'mailchimp-for-wp',
            'booked',
        ),
        'construction' => array(
            'revslider',
            'breadcrumb-navxt',
        ),
        'constructiontwo' => array(
            'revslider',
            'breadcrumb-navxt',
            'mailchimp-for-wp',
        ),
        'logistics' => array(
            'breadcrumb-navxt',
            'recent-tweets-widget',
            'revslider',
        ),
        'logisticstwo' => array(
            'breadcrumb-navxt',
            'recent-tweets-widget',
            'revslider',
            'mailchimp-for-wp',
        ),
        'beauty' => array(
            'breadcrumb-navxt',
            'booked',
            'revslider',
            'recent-tweets-widget',
        ),
        'healthcoach' => array(
            'breadcrumb-navxt',
            'mailchimp-for-wp',
        ),
        'medicall' => array(
            'breadcrumb-navxt',
            'booked',
        ),
        'charity' => array(
            'breadcrumb-navxt',
            'mailchimp-for-wp',
        ),
        'artist' => array(
            'breadcrumb-navxt',
            'recent-tweets-widget',
            'revslider',
            'booked',
            'mailchimp-for-wp',
        ),
        'restaurant' => array(
            'breadcrumb-navxt',
            'open-table-widget',
            'revslider',
        ),
        'rental' => array(
            'breadcrumb-navxt',
            'revslider',
            'recent-tweets-widget',
            'mailchimp-for-wp',
        ),
        'portfolio' => array(),
        'store' => array(
            'yith-woocommerce-wishlist',
            'woocommerce',
            'revslider',
            'breadcrumb-navxt',
            'mailchimp-for-wp',
            'instagram-feed'
        ),
        'personal_blog' => array(
            'amp',
            'mailchimp-for-wp',
            'instagram-feed'
        ),
        'church' => array(
            'breadcrumb-navxt',
            'revslider'
        ),
        'startup' => array(
            'mailchimp-for-wp',
        ),
        'viral' => array(
            'mailchimp-for-wp',
            'adrotate',
            'sharethis-share-buttons',
        ),
        'magazine' => array(
            'mailchimp-for-wp',
            'adrotate',
            'sharethis-share-buttons',
        ),
        'lawyer' => array(
            'booked',
            'mailchimp-for-wp',
        ),
        'psychologist' => array(
            'mailchimp-for-wp',
        ),
        'factory' => array(
            'breadcrumb-navxt',
            'mailchimp-for-wp',
            'revslider',
            'sharethis-share-buttons',
        ),
        'company' => array(
            'breadcrumb-navxt',
        ),
        'corporate' => array(
            'breadcrumb-navxt',
            'mailchimp-for-wp',
            'booked',
        ),
        'furniture' => array(
            'breadcrumb-navxt',
            'mailchimp-for-wp',
            'revslider',
            'sharethis-share-buttons',
        ),
        'renovation' => array(
            'revslider',
            'breadcrumb-navxt',
        ),
        'advisory' => array(
            'revslider',
            'breadcrumb-navxt',
            'mailchimp-for-wp',
            'booked',
            'woocommerce',
        ),
        'digital' => array(
            'revslider',
            'breadcrumb-navxt',
            'mailchimp-for-wp',
            'recent-tweets-widget',
            'booked',
        ),
        'politician' => array(
            'revslider',
            'breadcrumb-navxt',
            'woocommerce',
        ),
        'finance' => array(
            'revslider',
            'breadcrumb-navxt',
            'mailchimp-for-wp',
        ),
        'creative' => array(
            'revslider',
            'breadcrumb-navxt',
            'recent-tweets-widget'
        ),
        'dj' => array(
            'revslider',
            'mailchimp-for-wp'
        ),
        'businesstwo' => array(
            'revslider',
            'breadcrumb-navxt'
        ),
        'consulting' => array(
            'revslider',
            'breadcrumb-navxt'
        ),
        'creativetwo' => array(
            'revslider',
            'mailchimp-for-wp',
            'breadcrumb-navxt'
        ),
        'conference' => array(
            'revslider',
            'breadcrumb-navxt'
        ),
        'app' => array(
            'revslider',
            'mailchimp-for-wp'
        ),
        'businessthree' => array(
            'revslider',
            'breadcrumb-navxt'
        ),
        'seoagency' => array(
            'revslider',
            'mailchimp-for-wp',
            'breadcrumb-navxt'
        ),
        'portfoliotwo' => array(
            'mailchimp-for-wp'
        ),
        'photographer' => array(
            'woocommerce'
        ),
        'businessfour' => array(
            'mailchimp-for-wp'
        ),
        'medicaltwo' => array(
            'breadcrumb-navxt',
            'booked',
        ),
        'software' => array(
            'breadcrumb-navxt',
            'mailchimp-for-wp',
        ),
        'coffeeshop' => array(
            'mailchimp-for-wp',
            'open-table-widget',
            'instagram-feed',
            'woocommerce'
        ),
        'taxi' => array(
            'mailchimp-for-wp',
            'breadcrumb-navxt'
        ),
        'sports_complex' => array(
            'revslider',
            'breadcrumb-navxt',
            'instagram-feed',
            'recent-tweets-widget'
        ),
        'barbershop' => array(
            'mailchimp-for-wp',
            'breadcrumb-navxt',
            'instagram-feed',
            'booked',
        ),
        'book' => array(
            'mailchimp-for-wp'
        ),
        'hosting' => array(
            'mailchimp-for-wp',
            'cost-calculator-builder'
        ),
        'creativethree' => array(
        ),
        'gym' => array(
            'revslider',
        ),
    );

    if ($get_layouts) return $plugins;

    return array_merge($required, $plugins[$layout]);
}

function pearl_premium_bundled_plugins() {
    return array(
        'stm-gdpr-compliance',
        'LayerSlider',
    );
}