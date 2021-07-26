<?php
/**
 * Increase products quantity and products list after ajax add to cart
 *
 * @return mixed
 */
function pearl_cart_fragments($fragments) {

    $fragments = (!empty($fragments)) ? $fragments : array();

	/*Mini cart*/
	ob_start();
	get_template_part('partials/header/elements/cart/mini-cart');
	$mini_cart = ob_get_contents();
	ob_end_clean();

	/*Quantity*/
	ob_start();
	get_template_part('partials/header/elements/cart/quantity');
	$quantity = ob_get_contents();
	ob_end_clean();

    /*Quantity*/
    ob_start();
    get_template_part('partials/header/elements/cart/quantity_with_text');
    $quantity_with_text = ob_get_contents();
    ob_end_clean();


	$fragments['.mini-cart'] = $mini_cart;
	$fragments['.cart__quantity-badge'] = $quantity;
	$fragments['.cart__quantity-item'] = $quantity_with_text;

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'pearl_cart_fragments' );