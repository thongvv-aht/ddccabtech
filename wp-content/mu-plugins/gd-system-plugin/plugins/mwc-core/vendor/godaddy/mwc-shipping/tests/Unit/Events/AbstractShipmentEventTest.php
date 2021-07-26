<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Events;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Contracts\ShipmentContract;
use GoDaddy\WordPress\MWC\Shipping\Events\AbstractShipmentEvent;
use GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment;
use Mockery;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Events\AbstractShipmentEvent
 */
class AbstractShipmentEventTest extends WPTestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Events\AbstractShipmentEvent::__construct()
     */
    public function testConstructor()
    {
        $orderFulfillment = Mockery::mock(OrderFulfillment::class);
        $shipment = Mockery::mock(ShipmentContract::class);

        $this->getInstance($orderFulfillment, $shipment);

        $this->assertConditionsMet();
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Events\AbstractShipmentEvent::getOrderFulfillment()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Events\AbstractShipmentEvent::setOrderFulfillment()
     */
    public function testCanGetSetOrderFulfillment()
    {
        $orderFulfillment = Mockery::mock(OrderFulfillment::class);
        $shipment = Mockery::mock(ShipmentContract::class);

        $instance = $this->getInstance($orderFulfillment, $shipment);

        $this->assertSame($orderFulfillment, $instance->getOrderFulfillment());

        $anotherOrderFulfillment = Mockery::mock(OrderFulfillment::class);

        $this->assertInstanceOf(AbstractShipmentEvent::class, $instance->setOrderFulfillment($anotherOrderFulfillment));
        $this->assertSame($anotherOrderFulfillment, $instance->getOrderFulfillment());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Events\AbstractShipmentEvent::getShipment()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Events\AbstractShipmentEvent::setShipment()
     */
    public function testCanGetSetShipment()
    {
        $orderFulfillment = Mockery::mock(OrderFulfillment::class);
        $shipment = Mockery::mock(ShipmentContract::class);

        $instance = $this->getInstance($orderFulfillment, $shipment);

        $this->assertSame($shipment, $instance->getShipment());

        $anotherShipment = Mockery::mock(ShipmentContract::class);

        $this->assertInstanceOf(AbstractShipmentEvent::class, $instance->setShipment($anotherShipment));
        $this->assertSame($anotherShipment, $instance->getShipment());
    }

    /**
     * Gets an instance of an object implementing the abstract.
     *
     * @param OrderFulfillment $orderFulfillment
     * @param ShipmentContract $shipment
     * @return AbstractShipmentEvent
     */
    private function getInstance(OrderFulfillment $orderFulfillment, ShipmentContract $shipment) : AbstractShipmentEvent
    {
        return new class($orderFulfillment, $shipment) extends AbstractShipmentEvent{};
    }
}
