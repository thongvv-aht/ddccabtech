<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models\Orders;

use GoDaddy\WordPress\MWC\Common\Models\Orders\LineItem;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Order;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\FulfilledFulfillmentStatus;
use GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\UnfulfilledFulfillmentStatus;
use GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment;
use GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package;
use GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\LabelCreatedPackageStatus;
use GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\NotTrackedPackageStatus;
use GoDaddy\WordPress\MWC\Shipping\Models\Shipment;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment
 */
class OrderFulfillmentTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment::getOrder()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment::setOrder()
     *
     * @throws ReflectionException
     */
    public function testCanSetAndGetOrder()
    {
        $orderFulfillment = new OrderFulfillment();

        $property = TestHelpers::getInaccessibleProperty($orderFulfillment, 'order');

        $this->assertNull($property->getValue($orderFulfillment));

        $order = new Order();

        $orderFulfillment->setOrder($order);

        $this->assertSame($order, $orderFulfillment->getOrder());
    }

    /**
     * Tests that can get a shipment with a given shipment ID.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment::getShipment()
     *
     * @throws ReflectionException
     */
    public function testCanGetShipment()
    {
        $orderFulfillment = new OrderFulfillment();

        // not found
        $this->assertNull($orderFulfillment->getShipment('1'));

        $shipment = (new Shipment())->setId('1');

        TestHelpers::setInaccessibleProperty($orderFulfillment,
            OrderFulfillment::class,
            'shipments',
            [
                '3' => (new Shipment())->setId('3'),
                '6' => (new Shipment())->setId('6'),
                '1' => $shipment,
                '17' => (new Shipment())->setId('17'),
            ]);

        $this->assertSame($shipment, $orderFulfillment->getShipment('1'));
        // not found
        $this->assertNull($orderFulfillment->getShipment('2'));
    }

    /**
     * Tests that can get shipments.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment::getShipments()
     *
     * @throws ReflectionException
     */
    public function testCanGetShipments()
    {
        $orderFulfillment = new OrderFulfillment();
        $property = TestHelpers::getInaccessibleProperty($orderFulfillment, 'shipments');
        $shipmentA = (new Shipment())->setId('1')->setProviderName('Provider A');
        $shipmentB = (new Shipment())->setId('2')->setProviderName('Provider B');
        $shipmentC = (new Shipment())->setId('3')->setProviderName($shipmentB->getProviderName());

        $shipments = [
            $shipmentA->getId() => $shipmentA,
            $shipmentB->getId() => $shipmentB,
            $shipmentC->getId() => $shipmentC,
        ];

        $this->assertEmpty($orderFulfillment->getShipments());

        $property->setValue($orderFulfillment, $shipments);

        $this->assertSame([
            $shipmentA->getId() => $shipmentA,
            $shipmentB->getId() => $shipmentB,
            $shipmentC->getId() => $shipmentC,
        ], $orderFulfillment->getShipments());

        $this->assertSame([
            $shipmentB->getId() => $shipmentB,
            $shipmentC->getId() => $shipmentC,
        ], $orderFulfillment->getShipments($shipmentC->getProviderName()));

        $this->assertEmpty($orderFulfillment->getShipments('INVALID_PROVIDER_NAME'));
    }

    /**
     * Tests that can get shipments that can fulfill their items.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment::getShipmentsThatCanFulfillItems()
     */
    public function testCanGetShipmentsThatCanFulfillItems()
    {
        $orderFulfillment = new OrderFulfillment();

        $fulfillablePackage = (new Package())
            ->setId(1)
            ->setStatus(new LabelCreatedPackageStatus());

        $fulfillableShipment = (new Shipment())
            ->setId(10)
            ->setProviderName('Fulfillable Shipment')
            ->addPackage($fulfillablePackage);

        $unfulfillablePackage = (new Package())
            ->setId(2)
            ->setStatus(new NotTrackedPackageStatus());

        $unfulfillableShipment = (new Shipment())
            ->setId('20')
            ->setProviderName('Unfulfillable Shipment')
            ->addPackage($unfulfillablePackage);

        $partiallyFulfillableShipment = (new Shipment())
            ->setId('30')
            ->setProviderName($fulfillableShipment->getProviderName())
            ->addPackages([$unfulfillablePackage, (clone $fulfillablePackage)->setId(3)]);

        $anotherFulfillableShipment = (new Shipment())
            ->setId('40')
            ->setProviderName('Another Fulfillable Shipment')
            ->addPackage((clone $fulfillablePackage)->setId(4));

        $this->assertEmpty($orderFulfillment->getShipmentsThatCanFulfillItems());

        $orderFulfillment->addShipment($unfulfillableShipment);

        $this->assertEmpty($orderFulfillment->getShipmentsThatCanFulfillItems());

        $orderFulfillment->addShipment($fulfillableShipment);

        $fulfillableShipments = $orderFulfillment->getShipmentsThatCanFulfillItems();

        $this->assertNotEmpty($fulfillableShipments);
        $this->assertArrayHasKey($fulfillableShipment->getProviderName(), $fulfillableShipments);
        $this->assertIsArray($fulfillableShipments[$fulfillableShipment->getProviderName()]);
        $this->assertCount(1, (array) $fulfillableShipments[$fulfillableShipment->getProviderName()]);
        $this->assertArrayHasKey($fulfillableShipment->getId(), (array) $fulfillableShipments[$fulfillableShipment->getProviderName()]);

        $orderFulfillment->addShipment($partiallyFulfillableShipment);

        $fulfillableShipments = $orderFulfillment->getShipmentsThatCanFulfillItems();

        $this->assertCount(2, (array) $fulfillableShipments[$fulfillableShipment->getProviderName()]);
        $this->assertArrayHasKey($partiallyFulfillableShipment->getId(), (array) $fulfillableShipments[$fulfillableShipment->getProviderName()]);

        $orderFulfillment->addShipment($anotherFulfillableShipment);

        $fulfillableProvider = $fulfillableShipment->getProviderName();
        $fulfillableShipmentsByProvider = $orderFulfillment->getShipmentsThatCanFulfillItems($fulfillableProvider);

        $this->assertCount(2, $fulfillableShipmentsByProvider);
        $this->assertArrayNotHasKey($unfulfillableShipment->getProviderName(), $fulfillableShipmentsByProvider);
        $this->assertArrayNotHasKey($anotherFulfillableShipment->getProviderName(), $fulfillableShipmentsByProvider);
        $this->assertEquals($fulfillableProvider, current($fulfillableShipmentsByProvider)->getProviderName());
        $this->assertEquals($fulfillableProvider, end($fulfillableShipmentsByProvider)->getProviderName());
    }

    /**
     * Tests that can get line items that need shipping.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment::getLineItemsThatNeedShipping()
     * @dataProvider  providerCanGetLineItemsThatNeedShipping
     *
     * @param array $lineItems
     * @param array $expected
     */
    public function testCanGetLineItemsThatNeedShipping(array $lineItems, array $expected)
    {
        $orderFulfillment = new OrderFulfillment();
        $order = new Order();

        $order->setLineItems($lineItems);
        $orderFulfillment->setOrder($order);

        $this->assertEquals($expected, $orderFulfillment->getLineItemsThatNeedShipping());
    }

    /** @see testCanGetLineItemsThatNeedShipping */
    public function providerCanGetLineItemsThatNeedShipping() : array
    {
        $shippableLineItem = new LineItem();
        $nonShippableLineItem = new LineItem();

        $shippableLineItem->setNeedsShipping(true);

        return [
            'Order with at least one shippable line item' => [
                [$shippableLineItem, $nonShippableLineItem],
                [$shippableLineItem],
            ],
            'Order with line items but none are shippable' => [
                [$nonShippableLineItem],
                [],
            ],
            'Order with no line items' => [
                [],
                [],
            ],
        ];
    }

    /**
     * Tests that can get the fulfilled line items.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment::getFulfilledLineItems()
     * @dataProvider providerCanGetFulfilledLineItems
     *
     * @param array $lineItems
     * @param array $expected
     */
    public function testCanGetFulfilledLineItems(array $lineItems, array $expected)
    {
        $orderFulfillment = new OrderFulfillment();
        $order = new Order();

        $order->setLineItems($lineItems);
        $orderFulfillment->setOrder($order);

        $this->assertEquals($expected, $orderFulfillment->getFulfilledLineItems());
    }

    /** @see testCanGetFulfilledLineItems */
    public function providerCanGetFulfilledLineItems() : array
    {
        $fulfilledLineItem = new LineItem();
        $nonFulfilledLineItem = new LineItem();
        $fulfilledLineItem->setFulfillmentStatus(new FulfilledFulfillmentStatus());
        $nonFulfilledLineItem->setFulfillmentStatus(new UnfulfilledFulfillmentStatus());

        return [
            'Order with at least one fulfilled line item' => [
                [$fulfilledLineItem, $nonFulfilledLineItem],
                [$fulfilledLineItem],
            ],
            'Order with line items but none are fulfilled' => [
                [$nonFulfilledLineItem],
                [],
            ],
            'Order with no line items' => [
                [],
                [],
            ],
        ];
    }

    /**
     * Tests that can get the fulfilled quantity for a line item.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment::getFulfilledQuantityForLineItem()
     */
    public function testCanGetFulfilledQuantityForLineItem()
    {
        $lineItem1 = (new LineItem())->setId(1);
        $lineItem2 = (new LineItem())->setId(2);
        $lineItem3 = (new LineItem())->setId(3);
        $lineItem4 = (new LineItem())->setId(4);

        $fulfillablePackage1 = (new Package())
            ->setId(1)
            ->setStatus(new LabelCreatedPackageStatus())
            ->addItem($lineItem1, 1);

        $fulfillablePackage2 = (new Package())
            ->setId(2)
            ->setStatus(new LabelCreatedPackageStatus())
            ->addItem($lineItem1, 1)
            ->addItem($lineItem2, 1);

        $unfulfillablePackage = (new Package())
            ->setId(3)
            ->setStatus(new NotTrackedPackageStatus())
            ->addItem($lineItem1, 1)
            ->addItem($lineItem2, 1)
            ->addItem($lineItem3, 1);

        $shipment = (new Shipment())
            ->setId('test-shipment')
            ->setProviderName('Test Shipment')
            ->addPackages([$fulfillablePackage1, $fulfillablePackage2, $unfulfillablePackage]);

        $orderFulfillment = (new OrderFulfillment())->addShipment($shipment);

        $this->assertEquals(0, $orderFulfillment->getFulfilledQuantityForLineItem($lineItem3));
        $this->assertEquals(1, $orderFulfillment->getFulfilledQuantityForLineItem($lineItem2));
        $this->assertEquals(2, $orderFulfillment->getFulfilledQuantityForLineItem($lineItem1));
        $this->assertEquals(0, $orderFulfillment->getFulfilledQuantityForLineItem($lineItem4));
    }

    /**
     * Tests that can add a shipment.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment::addShipment()
     *
     * @throws ReflectionException
     */
    public function testCanAddShipment()
    {
        $orderFulfillment = new OrderFulfillment();
        $property = TestHelpers::getInaccessibleProperty($orderFulfillment, 'shipments');
        $shipmentA = (new Shipment())->setId('123')->setProviderName('Provider A');
        $shipmentB = (new Shipment())->setId('456')->setProviderName('Provider B');

        $shipments = $property->getValue($orderFulfillment);
        $this->assertIsArray($shipments);
        $this->assertCount(0, $shipments);

        $this->assertInstanceOf(OrderFulfillment::class, $orderFulfillment->addShipment($shipmentA));

        $shipments = $property->getValue($orderFulfillment);
        $this->assertCount(1, $shipments);
        $this->assertArrayHasKey($shipmentA->getId(), $shipments);

        $this->assertInstanceOf(OrderFulfillment::class, $orderFulfillment->addShipment($shipmentB));

        $shipments = $property->getValue($orderFulfillment);
        $this->assertCount(2, $shipments);
        $this->assertArrayHasKey($shipmentB->getId(), $shipments);
    }

    /**
     * Tests that can remove a shipment.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment::removeShipment()
     *
     * @throws ReflectionException
     */
    public function testCanRemoveShipment()
    {
        $orderFulfillment = new OrderFulfillment();
        $property = TestHelpers::getInaccessibleProperty($orderFulfillment, 'shipments');
        $shipmentA = (new Shipment())->setId('123')->setProviderName('Provider A');
        $shipmentB = (new Shipment())->setId('456')->setProviderName('Provider B');
        $shipments = [$shipmentA->getId() => $shipmentA, $shipmentB->getId() => $shipmentB];

        $property->setValue($orderFulfillment, $shipments);

        $this->assertInstanceOf(OrderFulfillment::class, $orderFulfillment->removeShipment($shipmentA));

        $this->assertEquals([$shipmentB->getId() => $shipmentB], $property->getValue($orderFulfillment));

        $this->assertInstanceOf(OrderFulfillment::class, $orderFulfillment->removeShipment($shipmentB));

        $this->assertEmpty($property->getValue($orderFulfillment));
    }

    /**
     * Tests that can determine if a shipment is present.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment::hasShipment()
     */
    public function testCanDetermineIfHasShipment()
    {
        $orderFulfillment = new OrderFulfillment();
        $shipment = (new Shipment())->setId('1')->setProviderName('Test Provider');

        $this->assertFalse($orderFulfillment->hasShipment($shipment));

        $orderFulfillment->addShipment($shipment);

        $this->assertTrue($orderFulfillment->hasShipment($shipment));
    }

    /**
     * Tests that can determine if a shipment provider is present.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\OrderFulfillment::hasProvider()
     */
    public function testCanDetermineIfHasShipmentProvider()
    {
        $orderFulfillment = new OrderFulfillment();
        $shipment = (new Shipment())->setId('1')->setProviderName('Test Provider');

        $this->assertFalse($orderFulfillment->hasProvider($shipment->getProviderName()));

        $orderFulfillment->addShipment($shipment);

        $this->assertTrue($orderFulfillment->hasProvider($shipment->getProviderName()));
    }
}
