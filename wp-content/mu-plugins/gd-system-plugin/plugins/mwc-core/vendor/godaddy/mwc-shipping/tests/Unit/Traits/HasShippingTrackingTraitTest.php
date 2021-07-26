<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Shipping\Contracts\GatewayContract;
use GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingTrackingTrait;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingTrackingTrait
 */
class HasShippingTrackingTraitTest extends TestCase
{
    /**
     * Tests that can get the tracking gateway.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingTrackingTrait::tracking()
     *
     * @throws ReflectionException
     */
    public function testCanGetTracking()
    {
        $mock = $this->getMockForTrait(HasShippingTrackingTrait::class);
        $property = TestHelpers::getInaccessibleProperty(get_class($mock), 'trackingGateway');

        $property->setValue($mock, get_class($this->getGateway()));

        $this->assertInstanceOf(GatewayContract::class, $mock->tracking());
    }

    /**
     * Gets an instance of a gateway.
     *
     * @return GatewayContract
     */
    private function getGateway() : GatewayContract
    {
        return new class implements GatewayContract
        {
        };
    }
}
