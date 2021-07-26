<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit;

use GoDaddy\WordPress\MWC\Common\Events\Events;
use GoDaddy\WordPress\MWC\Common\Models\Orders\LineItem;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Order;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Events\ShipmentCreatedEvent;
use GoDaddy\WordPress\MWC\Shipping\Events\ShipmentDeletedEvent;
use GoDaddy\WordPress\MWC\Shipping\Events\ShipmentUpdatedEvent;
use GoDaddy\WordPress\MWC\Shipping\Fulfillment;
use GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\FulfilledFulfillmentStatus;
use GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\PartiallyFulfilledFulfillmentStatus;
use GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\UnfulfilledFulfillmentStatus;
use GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment;
use GoDaddy\WordPress\MWC\Shipping\Models\Shipment;
use Mockery;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment
 */
class FulfillmentTest extends WPTestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment::update()
     */
    public function testCanUpdateOrderFulfillment()
    {
        $order = new Order();
        $order->setLineItems([
            (new LineItem())->setId(123)->setNeedsShipping(true),
            (new LineItem())->setId(456)->setNeedsShipping(false),
            (new LineItem())->setId(789)->setNeedsShipping(true),
            (new LineItem())->setId(357)->setNeedsShipping(false),
            (new LineItem())->setId(159)->setNeedsShipping(false),
        ]);

        $orderFulfillment = new OrderFulfillment();
        $orderFulfillment->setOrder($order);

        /** @var MockObject|Fulfillment $fulfillment */
        $fulfillment = $this->getMockBuilder(Fulfillment::class)
            ->onlyMethods(['updateShippableItemFulfillmentStatus', 'updateOrderFulfillmentStatus'])
            ->getMock();

        $fulfillment->expects($this->exactly(2))
            ->method('updateShippableItemFulfillmentStatus')
            ->with($this->isInstanceOf(OrderFulfillment::class), $this->isInstanceOf(LineItem::class));

        $fulfillment->expects($this->once())
            ->method('updateOrderFulfillmentStatus')
            ->with($this->isInstanceOf(OrderFulfillment::class));

        $fulfillment->update($orderFulfillment);
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment::updateOrderFulfillmentStatus()
     *
     * @param bool $areLineItemsThatNeedShippingFulfilled whether all the items that need shipping are fulfilled
     * @param array $shipmentsThatCanFulfillItems shipment objects that can fulfill items for this order
     * @param string $status class name for the fulfillment status that we expect to be assigned to the order
     *
     * @dataProvider providerCanUpdateOrderFulfillmentStatus
     */
    public function testCanUpdateOrderFulfillmentStatus(
        bool $areLineItemsThatNeedShippingFulfilled,
        array $shipmentsThatCanFulfillItems,
        string $status
    ) {
        $fulfillment = Mockery::mock(OrderFulfillment::class);
        $order = Mockery::mock(Order::class);

        $fulfillment->shouldReceive('getOrder')->andReturn($order);
        $fulfillment->shouldReceive('getShipmentsThatCanFulfillItems')->andReturn($shipmentsThatCanFulfillItems);

        $instance = Mockery::mock(Fulfillment::class)->makePartial();
        $instance->shouldAllowMockingProtectedMethods(true);
        $instance->shouldReceive('areAllLineItemsThatNeedShippingFulfilled')->andReturn($areLineItemsThatNeedShippingFulfilled);

        // the purpose of the method under test is to call setFulfillmentStatus() with an instance of the given status class
        $order->shouldReceive('setFulfillmentStatus')->once()->with(Mockery::type($status));

        $method = TestHelpers::getInaccessibleMethod(Fulfillment::class, 'updateOrderFulfillmentStatus');

        $method->invoke($instance, $fulfillment);

        $this->assertConditionsMet();
    }

    /** @see testCanUpdateOrderFulfillmentStatus() */
    public function providerCanUpdateOrderFulfillmentStatus()
    {
        return [
            'all items are fulfilled'     => [
                true,
                [],
                FulfilledFulfillmentStatus::class,
            ],
            'some items are fulfilled'    => [
                false,
                [new Shipment()],
                PartiallyFulfilledFulfillmentStatus::class,
            ],
            'no items are fulfilled'      => [
                false,
                [],
                UnfulfilledFulfillmentStatus::class,
            ],
        ];
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment::areAllLineItemsThatNeedShippingFulfilled()
     *
     * @param bool $expected whether all items should be considered fulfilled
     * @param LineItem[] $items line items that need shipping
     *
     * @dataProvider providerCanDetermineWhetherAllLineItemsThatNeedShippingAreFulfilled
     */
    public function testCanDetermineWhetherAllLineItemsThatNeedShippingAreFulfilled(bool $expected, array $items)
    {
        $fulfillment = Mockery::mock(OrderFulfillment::class);

        $fulfillment->shouldReceive('getLineItemsThatNeedShipping')->andReturn($items);

        $method = TestHelpers::getInaccessibleMethod(Fulfillment::class, 'areAllLineItemsThatNeedShippingFulfilled');

        $this->assertSame($expected, $method->invoke(Fulfillment::getInstance(), $fulfillment));
    }

    /** @see testCanDetermineWhetherAllLineItemsThatNeedShippingAreFulfilled */
    public function providerCanDetermineWhetherAllLineItemsThatNeedShippingAreFulfilled()
    {
        return [
            'no items that need shipping' => [
                true,
                [],
            ],
            'all items fulfilled'         => [
                true,
                [
                    (new LineItem())->setFulfillmentStatus(new FulfilledFulfillmentStatus()),
                    (new LineItem())->setFulfillmentStatus(new FulfilledFulfillmentStatus()),
                    (new LineItem())->setFulfillmentStatus(new FulfilledFulfillmentStatus()),
                ],
            ],
            'no items fulfilled'          => [
                false,
                [
                    (new LineItem())->setFulfillmentStatus(new UnfulfilledFulfillmentStatus()),
                    (new LineItem())->setFulfillmentStatus(new UnfulfilledFulfillmentStatus()),
                    (new LineItem())->setFulfillmentStatus(new PartiallyFulfilledFulfillmentStatus()),
                ],
            ],
            'one item unfulfilled'        => [
                false,
                [
                    (new LineItem())->setFulfillmentStatus(new FulfilledFulfillmentStatus()),
                    (new LineItem())->setFulfillmentStatus(new FulfilledFulfillmentStatus()),
                    (new LineItem())->setFulfillmentStatus(new UnfulfilledFulfillmentStatus()),
                ],
            ],
        ];
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment::updateShippableItemFulfillmentStatus()
     *
     * @dataProvider providerCanUpdateShippableItemFulfillmentStatus
     *
     * @param LineItem $lineItem
     * @param float $fulfilledQuantity
     * @param string $expectedStatusClassName
     *
     * @throws ReflectionException
     */
    public function testCanUpdateShippableItemFulfillmentStatus(
        LineItem $lineItem,
        float $fulfilledQuantity,
        string $expectedStatusClassName
    ) {
        $orderFulfillment = Mockery::mock(OrderFulfillment::class);

        $orderFulfillment->shouldReceive('getFulfilledQuantityForLineItem')->andReturn($fulfilledQuantity);

        TestHelpers::getInaccessibleMethod(Fulfillment::class, 'updateShippableItemFulfillmentStatus')->invoke(new Fulfillment(), $orderFulfillment, $lineItem);

        $this->assertInstanceOf($expectedStatusClassName, $lineItem->getFulfillmentStatus());
    }

    /**
     * @see testCanUpdateShippableItemFulfillmentStatus
     *
     * @return array[]
     */
    public function providerCanUpdateShippableItemFulfillmentStatus() : array
    {
        return [
            'line item fulfilled'           => [
                (new LineItem())->setQuantity(2),
                2, // fulfilled quantity
                FulfilledFulfillmentStatus::class, // expected status
            ],
            'line item unfulfilled'         => [
                (new LineItem())->setQuantity(3),
                0, // fulfilled quantity
                UnfulfilledFulfillmentStatus::class, // expected status
            ],
            'line item partially fulfilled' => [
                (new LineItem())->setQuantity(5),
                3, // fulfilled quantity
                PartiallyFulfilledFulfillmentStatus::class, // expected status
            ],
        ];
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment::updateShipment
     * @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment::updateShipmentProperties
     *
     * @throws \GoDaddy\WordPress\MWC\Common\Exceptions\BaseException
     */
    public function testCanUpdateShipment()
    {
        $shipment = (new Shipment())
            ->setId('TEST_SHIPMENT_ID')
            ->setProviderName('NEW_SHIPMENT_PROVIDER_NAME');

        /** @var Fulfillment|MockObject */
        $fulfillment = $this->getMockBuilder(Fulfillment::class)
            ->onlyMethods(['update'])
            ->getMock();
        $fulfillment->expects($this->once())
            ->method('update')
            ->with($this->isInstanceOf(OrderFulfillment::class));

        /** @var Shipment|MockObject */
        $foundShipment = $this->getMockBuilder(Shipment::class)
            ->onlyMethods(['getId', 'getProviderName', 'setProviderName', 'setProviderLabel', 'setPackages'])
            ->getMock();

        $foundShipment->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn('TEST_SHIPMENT_ID');

        $foundShipment->expects($this->once())
            ->method('setProviderName')
            ->with($shipment->getProviderName());

        $foundShipment->expects($this->once())
            ->method('setProviderLabel')
            ->with($shipment->getProviderLabel() ?: '');

        $foundShipment->expects($this->once())
            ->method('setPackages')
            ->with($shipment->getPackages());

        $orderFulfillment = (new OrderFulfillment())->addShipment($foundShipment);

        $this->mockStaticMethod(Events::class, 'broadcast')
             ->once()
             ->withArgs(function ($event) use ($orderFulfillment, $foundShipment) {
                 return $event instanceof ShipmentUpdatedEvent
                         && $event->getOrderFulfillment() === $orderFulfillment
                         && $event->getShipment() === $foundShipment;
             });

        $fulfillment->updateShipment($orderFulfillment, 'TEST_SHIPMENT_ID', $shipment);
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment::findShipment()
     *
     * @throws ReflectionException
     */
    public function testCanFindShipment()
    {
        $fulfillment = new Fulfillment();

        $orderFulfillment = $this->getMockBuilder(OrderFulfillment::class)
            ->onlyMethods(['getShipment'])
            ->getMock();
        $orderFulfillment->expects($this->once())
            ->method('getShipment')
            ->willReturn(new Shipment());

        $method = TestHelpers::getInaccessibleMethod(Fulfillment::class, 'findShipment');
        $actual = $method->invoke($fulfillment, $orderFulfillment, '123');

        $this->assertInstanceOf(Shipment::class, $actual);
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment::findShipment()
     *
     * @throws ReflectionException
     */
    public function testFindShipmentError()
    {
        $fulfillment = new Fulfillment();

        $orderFulfillment = $this->getMockBuilder(OrderFulfillment::class)
            ->onlyMethods(['getShipment'])
            ->getMock();
        $orderFulfillment->expects($this->once())
            ->method('getShipment')
            ->willReturn(null);

        $this->expectErrorMessage('Shipment not found with ID 123');

        $method = TestHelpers::getInaccessibleMethod(Fulfillment::class, 'findShipment');
        $method->invoke($fulfillment, $orderFulfillment, '123');
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment::addShipment()
     *
     * @throws \GoDaddy\WordPress\MWC\Common\Exceptions\BaseException
     */
    public function testCanAddShipment()
    {
        $shipment = new Shipment();
        $orderFulfillment = new OrderFulfillment();

        /** @var MockObject|Fulfillment $fulfillment */
        $fulfillment = $this->getMockBuilder(Fulfillment::class)
            ->onlyMethods(['addShipments'])
            ->getMock();

        $fulfillment->expects($this->once())
            ->method('addShipments');

        $fulfillment->addShipment($orderFulfillment, $shipment);
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment::addShipments()
     *
     * @throws \GoDaddy\WordPress\MWC\Common\Exceptions\BaseException
     */
    public function testCanAddShipments()
    {
        $shipment1 = new Shipment();
        $shipment2 = new Shipment();
        $orderFulfillment = new OrderFulfillment();
        $shipments = [$shipment1, $shipment2];

        /** @var MockObject|Fulfillment $fulfillment */
        $fulfillment = $this->getMockBuilder(Fulfillment::class)
            ->onlyMethods(['addShipmentToOrderFulfillment', 'update'])
            ->getMock();

        $fulfillment->expects($this->once())
            ->method('update')
            ->with($this->isInstanceOf(OrderFulfillment::class));

        $fulfillment->expects($this->exactly(2))
            ->method('addShipmentToOrderFulfillment')
            ->with($this->isInstanceOf(OrderFulfillment::class), $this->isInstanceOf(Shipment::class));

        $this->mockStaticMethod(Events::class, 'broadcast')
             ->twice()
             ->withArgs(function ($event) use ($orderFulfillment, $shipment1, $shipment2) {
                 return $event instanceof ShipmentCreatedEvent
                         && $event->getOrderFulfillment() === $orderFulfillment
                         && in_array($event->getShipment(), [$shipment1, $shipment2]);
             });

        $fulfillment->addShipments($orderFulfillment, $shipments);
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment::deleteShipment()
     */
    public function testCanDeleteShipment()
    {
        $foundShipment = new Shipment();
        $foundShipment->setId('123');

        $fulfillment = $this->getMockBuilder(Fulfillment::class)
            ->onlyMethods(['update'])
            ->getMock();
        $fulfillment->expects($this->once())
            ->method('update')
            ->with($this->isInstanceOf(OrderFulfillment::class));

        $orderFulfillment = $this->getMockBuilder(OrderFulfillment::class)
            ->onlyMethods(['getShipment', 'removeShipment'])
            ->getMock();
        $orderFulfillment->expects($this->once())
            ->method('getShipment')
            ->with('123')
            ->willReturn($foundShipment);
        $orderFulfillment->expects($this->once())
            ->method('removeShipment')
            ->with($foundShipment);

        $this->mockStaticMethod(Events::class, 'broadcast')
             ->once()
             ->withArgs(function ($event) use ($orderFulfillment, $foundShipment) {
                 return $event instanceof ShipmentDeletedEvent
                         && $event->getOrderFulfillment() === $orderFulfillment
                         && $event->getShipment() === $foundShipment;
             });

        $fulfillment->deleteShipment($orderFulfillment, '123');
    }

    /**
     *  @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment::addShipmentToOrderFulfillment()
     */
    public function testAddShipmentToOrderFulfillmentError()
    {
        $shipment = new Shipment();
        $orderFulfillment = new OrderFulfillment();
        $fulfillment = new Fulfillment();

        $this->expectErrorMessage('The Shipment provided did not include a provider name.');

        $method = TestHelpers::getInaccessibleMethod(Fulfillment::class, 'addShipmentToOrderFulfillment');
        $method->invoke($fulfillment, $orderFulfillment, $shipment);

        $this->assertConditionsMet();
    }

    /**
     *  @covers \GoDaddy\WordPress\MWC\Shipping\Fulfillment::addShipmentToOrderFulfillment()
     */
    public function testCanAddShipmentToOrderFulfillment()
    {
        $shipment = new Shipment();
        $orderFulfillment = new OrderFulfillment();
        $fulfillment = new Fulfillment();

        $shipment->setProviderName('Test');
        $shipment->setId('123');

        $method = TestHelpers::getInaccessibleMethod(Fulfillment::class, 'addShipmentToOrderFulfillment');
        $method->invoke($fulfillment, $orderFulfillment, $shipment);

        $this->assertEquals('123', $orderFulfillment->getShipments('Test')['123']->getId());
    }
}
