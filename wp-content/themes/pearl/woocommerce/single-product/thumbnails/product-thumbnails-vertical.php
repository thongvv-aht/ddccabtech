<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && has_post_thumbnail() ) {

    foreach ( $attachment_ids as $attachment_id ) {
        $full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
        $thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
        $attributes      = array(
            'title'                   => get_post_field( 'post_title', $attachment_id ),
            'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
            'data-src'                => $full_size_image[0],
            'data-large_image'        => $full_size_image[0],
            'data-large_image_width'  => $full_size_image[1],
            'data-large_image_height' => $full_size_image[2],
        );

        $html  = '<div class="woocommerce-product-gallery__thumbnail">';
        $html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
        $html .= '</div>';

        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
    }
}
