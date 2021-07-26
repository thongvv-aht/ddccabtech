<?php
/**
 * Order Shipments information shown in plain-text emails.
 *
 * This template can be overridden by copying it to yourtheme/mwc/emails/plain/order/order-shipments.php.
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

/** @var $columns */
/** @var $packages */

echo "\n----------------------------------------\n\n";
echo strtoupper(__('Shipments', 'mwc-core'));
echo "\n\n";

foreach ($packages as $package):
    printf(__('%s: %s', 'mwc-core'), $columns['carrier'], $package['providerLabel'] . "\n");
    printf(__('%s: %s', 'mwc-core'), $columns['tracking-number'], $package['trackingNumber'] . "\n");

    if (!empty($package['trackingUrl'])):
        printf(__('Tracking URL: %s', 'mwc-core'), $package['trackingUrl'] . "\n");
    endif;

    if (!empty($columns['items'])):
        printf(__('%s: ', 'mwc-core'), $columns['items']);

        foreach ($package['items'] as $item):
            printf(__('%s x %s', 'mwc-core'), $item['name'], $item['quantity'] . "\n");
        endforeach;
    endif;

    echo "\n";
endforeach;
