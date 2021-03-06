<?php

return [
    /*
     *--------------------------------------------------------------------------
     * Configuration Flags
     *--------------------------------------------------------------------------
     *
     * disable marketplace suggestions flag, string.
     *
     */
    'flags' => [
        'broadcastFirstGoDaddyPaymentsPaymentTransactionEvent' => get_option('gd_mwc_broadcast_first_godaddy_payments_payment_transaction_event', 'yes'),
        'broadcastGoDaddyPaymentsFirstActiveEvent'             => get_option('gd_mwc_broadcast_go_daddy_payments_first_active', 'yes') === 'yes',
        'disableMarketplaceSuggestions'                        => get_option('gd_mwc_disable_woocommerce_marketplace_suggestions', 'yes'),
        'maybeFireLocalPickupShippingMethodAddedEvent'         => get_option('gd_mwc_maybe_fire_local_pickup_shipping_method_added_event', 'yes'),
        'shouldDeactivateShipmentTrackingPlugin'               => get_option('mwc_should_deactivate_shipment_tracking_plugin', 'yes') === 'yes',
        'showShipmentTrackingPluginDeactivatedNotice'          => get_option('mwc_show_shipment_tracking_plugin_deactivated_notice') === 'yes',
        'broadcastShipmentTrackingFeatureEnabledEvent'         => get_option('mwc_broadcast_shipment_tracking_feature_enabled_event', 'yes') === 'yes',
    ],

    /*
     *--------------------------------------------------------------------------
     * Order Item meta that should be hidden
     *--------------------------------------------------------------------------
     */
    'hiddenOrderItemMeta' => [
        '_mwc_fulfillment_status',
    ],
];
