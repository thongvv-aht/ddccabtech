<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\UPS;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\UPS\UPSProvider;
use GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingTrackingTrait;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\UPS\UPSProvider
 */
class UPSProviderTest extends WPTestCase
{
    /**
     * Tests that can determine if the provider offers shipment tracking.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\UPS\UPSProvider::__construct()
     */
    public function testHasShippingTracking()
    {
        $this->assertContains(HasShippingTrackingTrait::class, class_uses(UPSProvider::class));
    }
}
