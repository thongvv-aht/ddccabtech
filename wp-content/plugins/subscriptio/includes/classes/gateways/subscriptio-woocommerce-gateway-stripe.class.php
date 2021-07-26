<?php

// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * WooCommerce Stripe payment gateway extension integration
 *
 * https://wordpress.org/plugins/woocommerce-gateway-stripe/
 *
 * @class Subscriptio_WooCommerce_Gateway_Stripe
 * @package Subscriptio
 * @author RightPress
 */
class Subscriptio_WooCommerce_Gateway_Stripe
{

    private $min_supported_version = '4.1';

    // Singleton instance
    protected static $instance = false;

    /**
     * Singleton control
     */
    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     *
     * @access public
     * @return void
     */
    public function __construct()
    {

        // Process automatic renewal payment
        add_filter('subscriptio_automatic_payment_stripe', array($this, 'process_renewal_payment'), 10, 3);

        // Maybe force save source during checkout
        add_filter('wc_stripe_force_save_source', array($this, 'maybe_force_save_source'));

        // Maybe hide save payment method checkbox during checkout
        add_filter('wc_stripe_display_save_payment_method_checkbox', array($this, 'maybe_hide_save_payment_method_checkbox'));

        // Maybe save order payment method details to subscriptions
        add_action('wc_gateway_stripe_process_response', array($this, 'maybe_save_order_payment_method_details_to_subscriptions'), 10, 2);

        // Maybe print update subscriptions payment method checkbox on payment method change
        add_action('wc_stripe_cards_payment_fields', array($this, 'maybe_display_update_subscriptions_payment_method_checkbox'));

        // Maybe save new payment method details to subscriptions
        add_action('wc_stripe_add_payment_method_stripe_success', array($this, 'maybe_save_new_payment_method_details_to_subscriptions'), 10, 2);

        // Maybe display version warning
        add_action('admin_notices', array($this, 'maybe_display_version_warning'), -1);
    }

    /**
     * Get Stripe payment gateway object
     *
     * @access public
     * @return WC_Gateway_Stripe|null
     */
    public static function get_payment_gateway()
    {

        $payment_gateway = null;

        // Get payment gateway
        if (WC()->payment_gateways()) {

            $payment_gateways = WC()->payment_gateways()->payment_gateways();

            if (isset($payment_gateways['stripe']) && is_a($payment_gateways['stripe'], 'WC_Gateway_Stripe')) {
                $payment_gateway = $payment_gateways['stripe'];
            }
        }

        return $payment_gateway;
    }

    /**
     * Process automatic subscription renewal payment
     *
     * Based on WC_Stripe_Subs_Compat::process_subscription_payment()
     *
     * @access public
     * @param bool $payment_successful
     * @param array $order
     * @param array $subscription
     * @return bool
     */
    public function process_renewal_payment($payment_successful, $order, $subscription)
    {

        try {

            // Get payment gateway
            $payment_gateway = Subscriptio_WooCommerce_Gateway_Stripe::get_payment_gateway();

            // No payment gateway or some of the required methods are no longer callable
            if (!$payment_gateway
                || !is_callable(array($payment_gateway, 'prepare_order_source'))
                || !is_callable(array($payment_gateway, 'generate_payment_request'))
                || !is_callable(array($payment_gateway, 'process_response'))
                || !is_callable(array('WC_Stripe_Helper', 'get_stripe_amount'))
                || !is_callable(array('WC_Stripe_API', 'request'))
                || !is_callable(array('WC_Stripe_Helper', 'get_localized_messages'))
                || !is_callable(array('WC_Stripe_Logger', 'log'))
                || !class_exists('WC_Stripe_Exception')) {
                // TBD: Might be wise to log this event
                return false;
            }

            // Stripe customer id and source id are not set on order
            if (!$order->get_meta('_stripe_customer_id', true) && !$order->get_meta('_stripe_source_id', true)) {

                // Get legacy Stripe customer id from customer meta
                if ($stripe_customer_id = RightPress_WC_Legacy::customer_get_meta($order->get_customer_id(), '_subscriptio_stripe_customer_id', true)) {

                    // Set Stripe customer id
                    // Note: We are setting it in two different ways to make sure they are immediately available everywhere
                    $order->update_meta_data('_stripe_customer_id', $stripe_customer_id);
                    update_post_meta($order->get_id(), '_stripe_customer_id', $stripe_customer_id);

                    // Get legacy Stripe default card from customer meta
                    if ($stripe_customer_default_card = RightPress_WC_Legacy::customer_get_meta($order->get_customer_id(), '_subscriptio_stripe_customer_default_card', true)) {

                        // Set Stripe source id
                        $order->update_meta_data('_stripe_source_id', $stripe_customer_default_card);
                        update_post_meta($order->get_id(), '_stripe_source_id', $stripe_customer_default_card);
                    }
                }
            }

            // Prepare order source
            $prepared_source = $payment_gateway->prepare_order_source($order);

            // Unable to prepare order source or customer is not set
            if (!is_object($prepared_source) || !$prepared_source->customer) {
                return false;
            }

            // Write to Stripe log
            WC_Stripe_Logger::log("Info: Begin processing subscription payment for order {$order->get_id()} for the amount of {$order->get_total()}");

            // Generate request
            $request = $payment_gateway->generate_payment_request($order, $prepared_source);

            // Capture payment immediately
            $request['capture'] = 'true';

            // Set request meta data
            $request['metadata']['subscription_id'] = $subscription->id;
            $request['metadata']['payment_type']    = 'recurring';
            $request['metadata']['site_url']        = esc_url(get_site_url());

            // Send request
            $response = WC_Stripe_API::request($request);

            // Error occurred
            if (!empty($response->error)) {

                // Get localized messages
                $localized_messages = WC_Stripe_Helper::get_localized_messages();

                // Get localized message
                if ($response->error->type === 'card_error') {
                    $localized_message = isset($localized_messages[$response->error->code]) ? $localized_messages[$response->error->code] : $response->error->message;
                }
                else {
                    $localized_message = isset($localized_messages[$response->error->type]) ? $localized_messages[$response->error->type] : $response->error->message;
                }

                // Add order note
                $order->add_order_note($localized_message);

                // Throw exception
                throw new WC_Stripe_Exception(print_r($response, true), $localized_message);
            }

            // Call process payment action
            do_action('wc_gateway_stripe_process_payment', $response, $order);

            // Process response
            $payment_gateway->process_response($response, $order);

            // Subscription automatic payment processed successfully
            return true;
        }
        catch (WC_Stripe_Exception $e) {

            // Write to Stripe log
            WC_Stripe_Logger::log('Error: ' . $e->getMessage());

            // Call error action
            do_action('wc_gateway_stripe_process_payment_error', $e, $order);

            // Update order status
            $order->update_status('failed');

            // Subscription automatic payment failed to process
            return false;
        }
    }

    /**
     * Maybe force save source
     *
     * @access public
     * @param bool $force
     * @return bool
     */
    public function maybe_force_save_source($force)
    {

        // Check if customer has at least one non-terminated subscription
        // Note: We are essentially guessing that the order customer is paying for is subscription order since
        // the hook that we are using is limited (does not provide order details)
        if (Subscriptio_User::has_subscription()) {

            // Get unpaid statuses
            $wc_order_statuses  = array_keys(wc_get_order_statuses());
            $wc_paid_statuses   = wc_get_is_paid_statuses();
            $unpaid_statuses    = array_diff($wc_order_statuses, $wc_paid_statuses);

            // Get customer's unpaid orders
            $unpaid_orders = wc_get_orders(array(
                'customer'  => get_current_user_id(),
                'status'    => $unpaid_statuses,
                'limit'     => -1,
                'orderby'   => 'date',
                'order'     => 'DESC',
                'return'    => 'ids',
            ));

            // If customer has an unpaid order, we guess that this order is related to a subscription
            if (!empty($unpaid_orders)) {

                // Force save source
                $force = true;
            }
        }

        return $force;
    }

    /**
     * Maybe hide save payment method checkbox
     *
     * Checkbox is hidden since payment token will be saved in any case when cart contains subscription
     *
     * @access public
     * @param bool $display
     * @return bool
     */
    public function maybe_hide_save_payment_method_checkbox($display)
    {

        global $wp_query;

        if (Subscriptio::cart_contains_subscription() || (!empty($_GET['pay_for_order']) && !empty($wp_query->query_vars['order-pay']) && Subscriptio_Order_Handler::get_subscriptions_from_order_id($wp_query->query_vars['order-pay']))) {
            $display = false;
        }

        return $display;
    }

    /**
     * Maybe save order payment method details to subscriptions
     *
     * @access public
     * @param object $response
     * @param WC_Order $order
     * @return void
     */
    public function maybe_save_order_payment_method_details_to_subscriptions($response, $order)
    {

        // Get Stripe customer and source ids
        $stripe_customer_id = $order->get_meta('_stripe_customer_id', true);
        $stripe_source_id   = $order->get_meta('_stripe_source_id', true);

        // Get subscriptions related to order
        $subscriptions = Subscriptio_Order_Handler::get_subscriptions_from_order_id($order->get_id());

        // Check if payment details should be updated
        if ($subscriptions && ($stripe_customer_id || $stripe_source_id)) {

            // Iterate over subscriptions
            foreach ($subscriptions as $subscription) {

                // Save Stripe customer id
                if ($stripe_customer_id) {
                    update_post_meta($subscription->id, '_stripe_customer_id', $stripe_customer_id);
                }

                // Save Stripe source id
                if ($stripe_source_id) {
                    update_post_meta($subscription->id, '_stripe_source_id', $stripe_source_id);
                }
            }
        }
    }

    /**
     * Maybe print update subscriptions payment method checkbox on payment method change
     *
     * @access public
     * @param string $gateway_id
     * @return void
     */
    public function maybe_display_update_subscriptions_payment_method_checkbox($gateway_id)
    {

        // Only display this on add payment method page for 'stripe' payment gateway
        if (is_add_payment_method_page() && $gateway_id === 'stripe') {

            // Customer has non-terminated subscriptions
            if (Subscriptio_User::has_subscription()) {

                // Open container
                echo '<div class="form-row form-row-wide">';

                // Print input
                echo '<input type="checkbox" id="wc-stripe-update-subscriptio-subscriptions-payment-method" name="wc-stripe-update-subscriptio-subscriptions-payment-method" value="yes">';

                // Print label
                echo '<label for="wc-stripe-update-subscriptio-subscriptions-payment-method" style="display: inline;">' . esc_html__('Use this payment method for all of my subscriptions', 'subscriptio') . '</label>';

                // Close container
                echo '</div>';
            }
        }
    }

    /**
     * Maybe save new payment method details to subscriptions
     *
     * @access public
     * @param string $source_id
     * @param object $source_object
     * @return void
     */
    public function maybe_save_new_payment_method_details_to_subscriptions($source_id, $source_object)
    {

        // Get payment gateway
        if ($payment_gateway = Subscriptio_WooCommerce_Gateway_Stripe::get_payment_gateway()) {

            // Customer opted to update payment method on subscriptions
            if (!empty($_POST['wc-stripe-update-subscriptio-subscriptions-payment-method'])) {

                // Iterate over customer's non-terminated subscriptions
                foreach (Subscriptio_User::find_subscriptions(true) as $subscription) {

                    // Update payment method and source id
                    update_post_meta($subscription->id, 'payment_method', 'stripe');
                    update_post_meta($subscription->id, 'payment_method_title', $payment_gateway->method_title);
                    update_post_meta($subscription->id, '_stripe_source_id', $source_id);

                    // Update source id on last unpaid renewal order
                    if (!empty($subscription->last_order_id)) {
                        if ($order = wc_get_order($subscription->last_order_id)) {
                            if (!$order->is_paid()) {
                                $order->update_meta_data('_stripe_source_id', $source_id);
                                $order->save();
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Maybe display version warning
     *
     * @access public
     * @return void
     */
    public function maybe_display_version_warning()
    {

        if (defined('WC_STRIPE_VERSION') && !version_compare(WC_STRIPE_VERSION, $this->min_supported_version, '>=')) {
            echo '<div class="error"><p>' . sprintf(__('<strong>Subscriptio</strong> integrates with WooCommerce Stripe Payment Gateway extension to enable automatic recurring payments, however the lowest supported version is %s. Please update WooCommerce Stripe Payment Gateway extension to the latest version at your earliest convenience. If you use have active subscriptions that uses this payment gateway extension, automatic payments will not be processed until the update is complete.', 'subscriptio'), $this->min_supported_version) . ' ' . sprintf(__('If you have any questions, please contact %s.', 'subscriptio'), '<a href="http://url.rightpress.net/new-support-ticket">' . __('RightPress Support', 'subscriptio') . '</a>') . '</p></div>';
        }
    }





}

Subscriptio_WooCommerce_Gateway_Stripe::get_instance();
