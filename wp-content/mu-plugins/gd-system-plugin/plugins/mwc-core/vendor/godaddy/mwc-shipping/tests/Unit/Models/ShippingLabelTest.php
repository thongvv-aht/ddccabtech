<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Shipping\Models\ShippingLabel;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers GoDaddy\WordPress\MWC\Shipping\Models\ShippingLabel
 */
class ShippingLabelTest extends TestCase
{
    /**
     * @covers GoDaddy\WordPress\MWC\Shipping\Models\ShippingLabel::getImageData()
     * @covers GoDaddy\WordPress\MWC\Shipping\Models\ShippingLabel::setImageData()
     *
     * @throws ReflectionException
     */
    public function testCanSetAndGetImageData()
    {
        $shippingLabel = new ShippingLabel();

        $property = TestHelpers::getInaccessibleProperty($shippingLabel, 'data');

        $this->assertNull($property->getValue($shippingLabel));

        $shippingLabel->setImageData('image-data-test');

        $this->assertEquals('image-data-test', $shippingLabel->getImageData());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\ShippingLabel::getImageFormat()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\ShippingLabel::setImageFormat()
     *
     * @throws ReflectionException
     */
    public function testCanSetAndGetImageFormat()
    {
        $shippingLabel = new ShippingLabel();

        $property = TestHelpers::getInaccessibleProperty($shippingLabel, 'format');

        $this->assertNull($property->getValue($shippingLabel));

        $shippingLabel->setImageFormat('jpeg');

        $this->assertEquals('jpeg', $shippingLabel->getImageFormat());
    }
}
