<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models;

use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Shipping\Models\ShippingRate;
use GoDaddy\WordPress\MWC\Shipping\Models\ShippingRateItem;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Models\ShippingRate
 */
class ShippingRateTest extends TestCase
{
    /**
     * Tests that can get the ID.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\ShippingRate::getId()
     *
     * @throws ReflectionException
     */
    public function testCanGetId()
    {
        $rate = new ShippingRate();
        $property = TestHelpers::getInaccessibleProperty($rate, 'id');

        $property->setValue($rate, 'test-id');

        $this->assertEquals('test-id', $rate->getId());
    }

    /**
     * Tests that can set the ID.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\ShippingRate::setId()
     *
     * @throws ReflectionException
     */
    public function testCanSetId()
    {
        $rate = new ShippingRate();
        $property = TestHelpers::getInaccessibleProperty($rate, 'id');

        $this->assertNull($property->getValue($rate));

        $this->assertInstanceOf(get_class($rate), $rate->setId('test-id'));

        $this->assertEquals('test-id', $property->getValue($rate));
    }

    /**
     * Tests that can get the items.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\ShippingRate::getItems()
     *
     * @throws ReflectionException
     */
    public function testCanGetItems()
    {
        $rate = new ShippingRate();
        $items = [new ShippingRateItem()];
        $property = TestHelpers::getInaccessibleProperty($rate, 'items');

        $property->setValue($rate, $items);

        $this->assertEquals($items, $rate->getItems());
    }

    /**
     * Tests that can set the items.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\ShippingRate::setItems()
     *
     * @throws ReflectionException
     */
    public function testCanSetItems()
    {
        $rate = new ShippingRate();
        $items = [new ShippingRateItem()];
        $property = TestHelpers::getInaccessibleProperty($rate, 'items');

        $this->assertIsArray($property->getValue($rate));
        $this->assertEmpty($property->getValue($rate));

        $this->assertInstanceOf(get_class($rate), $rate->setItems($items));

        $this->assertEquals($items, $property->getValue($rate));
    }

    /**
     * Tests that can add an item.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\ShippingRate::addItem()
     */
    public function testCanAddItem()
    {
        $rate = new ShippingRate();
        $item = new ShippingRateItem();
        $items = TestHelpers::getInaccessibleProperty($rate, 'items');

        $this->assertCount(0, $items->getValue($rate));

        $this->assertInstanceOf(get_class($rate), $rate->addItem($item));

        $this->assertCount(1, $items->getValue($rate));
        $this->assertEquals($item, current($items->getValue($rate)));
    }

    /**
     * Tests that can get the total.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\ShippingRate::getTotal()
     *
     * @throws ReflectionException
     */
    public function testCanGetTotal()
    {
        $rate = new ShippingRate();
        $total = new CurrencyAmount();
        $property = TestHelpers::getInaccessibleProperty($rate, 'total');

        $property->setValue($rate, $total);

        $this->assertEquals($total, $rate->getTotal());
    }

    /**
     * Tests that can set the total.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\ShippingRate::setTotal()
     *
     * @throws ReflectionException
     */
    public function testCanSetTotal()
    {
        $rate = new ShippingRate();
        $total = new CurrencyAmount();
        $property = TestHelpers::getInaccessibleProperty($rate, 'total');

        $this->assertNull($property->getValue($rate));

        $this->assertInstanceOf(get_class($rate), $rate->setTotal($total));

        $this->assertEquals($total, $property->getValue($rate));
    }
}
