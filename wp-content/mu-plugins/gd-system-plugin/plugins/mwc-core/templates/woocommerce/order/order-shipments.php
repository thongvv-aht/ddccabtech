<?php
/**
 * Order Shipments
 *
 * This template can be overridden by copying it to yourtheme/mwc/order/order-shipments.php.
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @version x.y.z
 */

defined('ABSPATH') || exit;

/** @var $columns */
/** @var $packages */
?>
<section class="woocommerce-order-shipments">

    <h2 class="woocommerce-order-shipments__title"><?php esc_html_e('Shipments', 'mwc-core'); ?></h2>

    <table class="woocommerce-table woocommerce-table--order-shipments shop_table order_shipments">

        <thead>
            <tr>
                <?php foreach ($columns as $columnId => $columnName): ?>
                    <th class="<?php esc_attr_e($columnId); ?>"><span class="nobr"><?php esc_html_e($columnName); ?></span></th>
                <?php endforeach; ?>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($packages as $package): ?>
                <tr>
                    <td><?php esc_html_e($package['providerLabel']); ?></td>
                    <td>
                        <?php if (!empty($package['trackingUrl'])): ?>
                            <a target="_blank" href="<?php esc_attr_e($package['trackingUrl']); ?>"><?php esc_html_e($package['trackingNumber']); ?></a>
                        <?php else: ?>
                            <?php esc_html_e($package['trackingNumber']); ?>
                        <?php endif; ?>
                    </td>
                    <?php if (!empty($columns['items'])): ?>
                        <td>
                            <?php foreach ($package['items'] as $index => $item): ?>
                                <a target="_blank" href="<?php esc_attr_e($item['url']); ?>"><?php esc_html_e($item['name']); ?></a> &times; <?php esc_html_e($item['quantity']); ?>
                                <?php if ($index !== count($package['items']) - 1 ): ?>
                                    <br>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
