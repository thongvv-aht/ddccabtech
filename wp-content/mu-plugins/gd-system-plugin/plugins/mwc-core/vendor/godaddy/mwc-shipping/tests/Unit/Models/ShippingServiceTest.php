<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models;

use GoDaddy\WordPress\MWC\Shipping\Models\ShippingService;
use PHPUnit\Framework\TestCase;

/**
 * @covers GoDaddy\WordPress\MWC\Shipping\Models\ShippingService
 */
class ShippingServiceTest extends TestCase
{
    /**
     * @covers GoDaddy\WordPress\MWC\Shipping\Models\ShippingService::getLabel()
     * @covers GoDaddy\WordPress\MWC\Shipping\Models\ShippingService::setLabel()
     * @covers GoDaddy\WordPress\MWC\Shipping\Models\ShippingService::getName()
     * @covers GoDaddy\WordPress\MWC\Shipping\Models\ShippingService::setName()
     */
    public function testCanAccessTraitMethods()
    {
        $shippingService = (new ShippingService())
            ->setLabel('label')
            ->setName('name');

        $this->assertSame('label', $shippingService->getLabel());
        $this->assertSame('name', $shippingService->getName());
    }
}