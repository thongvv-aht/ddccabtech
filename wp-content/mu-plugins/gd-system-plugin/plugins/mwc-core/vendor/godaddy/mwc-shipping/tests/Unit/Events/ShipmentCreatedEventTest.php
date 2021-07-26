<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Events;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Contracts\ShipmentContract;
use GoDaddy\WordPress\MWC\Shipping\Events\AbstractShipmentEvent;
use GoDaddy\WordPress\MWC\Shipping\Events\ShipmentCreatedEvent;
use GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment;
use Mockery;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Events\ShipmentCreatedEvent
 */
class ShipmentCreatedEventTest extends WPTestCase
{
    /**
     * Tests that the class extends the correct class
     */
    public function testExtends()
    {
        $orderFulfillment = Mockery::mock(OrderFulfillment::class);
        $shipment = Mockery::mock(ShipmentContract::class);

        $this->assertInstanceOf(AbstractShipmentEvent::class, new ShipmentCreatedEvent($orderFulfillment, $shipment));
    }
}
