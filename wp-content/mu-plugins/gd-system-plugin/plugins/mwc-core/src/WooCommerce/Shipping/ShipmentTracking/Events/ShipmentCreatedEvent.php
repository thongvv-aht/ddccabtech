<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Shipping\ShipmentTracking\Events;

/**
 * Shipment created event.
 *
 * @since x.y.z
 */
class ShipmentCreatedEvent extends AbstractShipmentEvent
{
    /** @var string the name of the event resource */
    protected $resource = 'shipment';

    /** @var string the name of the event action */
    protected $action = 'created';
}
