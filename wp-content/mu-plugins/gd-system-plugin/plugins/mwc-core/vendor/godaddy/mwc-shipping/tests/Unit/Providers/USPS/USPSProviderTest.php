<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\USPS;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\USPS\USPSProvider;
use GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingTrackingTrait;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\USPS\Gateways\USPSTrackingGateway
 */
class USPSProviderTest extends WPTestCase
{
    /**
     * Tests that can determine if the provider offers shipment tracking.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\USPS\USPSProvider::__construct()
     */
    public function testHasShippingTracking()
    {
        $this->assertContains(HasShippingTrackingTrait::class, class_uses(USPSProvider::class));
    }
}
