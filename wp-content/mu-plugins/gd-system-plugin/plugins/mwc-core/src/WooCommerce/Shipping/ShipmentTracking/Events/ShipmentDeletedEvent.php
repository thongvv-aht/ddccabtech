<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Shipping\ShipmentTracking\Events;

/**
 * Shipment deleted event.
 *
 * @since x.y.z
 */
class ShipmentDeletedEvent extends AbstractShipmentEvent
{
    /** @var string the name of the event resource */
    protected $resource = 'shipment';

    /** @var string the name of the event action */
    protected $action = 'deleted';
}
