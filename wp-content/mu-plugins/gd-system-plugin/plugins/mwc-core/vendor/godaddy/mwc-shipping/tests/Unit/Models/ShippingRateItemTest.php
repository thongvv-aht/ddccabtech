<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models;

use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Shipping\Models\ShippingRateItem;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @covers GoDaddy\WordPress\MWC\Shipping\Models\ShippingRateItem
 */
class ShippingRateItemTest extends TestCase
{
    /**
     * @covers GoDaddy\WordPress\MWC\Shipping\Models\ShippingRateItem::setPrice()
     * @covers GoDaddy\WordPress\MWC\Shipping\Models\ShippingRateItem::getPrice()
     */
    public function testCanSetAndGetPrice()
    {
        $shippingRateItem = new ShippingRateItem();

        $property = TestHelpers::getInaccessibleProperty($shippingRateItem, 'price');

        $this->assertNull($property->getValue($shippingRateItem));

        $currencyAmount = new CurrencyAmount();

        $shippingRateItem->setPrice($currencyAmount);

        $this->assertSame($currencyAmount, $shippingRateItem->getPrice());
    }

    /**
     * @covers GoDaddy\WordPress\MWC\Shipping\Models\ShippingRateItem::setIsIncluded()
     * @covers GoDaddy\WordPress\MWC\Shipping\Models\ShippingRateItem::getIsIncluded()
     */
    public function testCanSetAndGetIsIncluded()
    {
        $shippingRateItem = new ShippingRateItem();

        $property = TestHelpers::getInaccessibleProperty($shippingRateItem, 'isIncluded');

        $this->assertNull($property->getValue($shippingRateItem));

        $shippingRateItem->setIsIncluded(true);

        $this->assertTrue($shippingRateItem->getIsIncluded());
    }
}
