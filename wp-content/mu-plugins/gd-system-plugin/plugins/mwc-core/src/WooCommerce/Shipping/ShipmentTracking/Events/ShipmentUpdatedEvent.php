<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Shipping\ShipmentTracking\Events;

/**
 * Shipment updated event.
 *
 * @since x.y.z
 */
class ShipmentUpdatedEvent extends AbstractShipmentEvent
{
    /** @var string the name of the event resource */
    protected $resource = 'shipment';

    /** @var string the name of the event action */
    protected $action = 'updated';
}
