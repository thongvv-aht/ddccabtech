<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\USPS\Gateways;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\USPS\Gateways\USPSTrackingGateway;
use GoDaddy\WordPress\MWC\Shipping\Traits\CanBuildTrackingUrlTrait;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\USPS\Gateways\USPSTrackingGateway
 */
class USPSTrackingGatewayTest extends WPTestCase
{
    /**
     * Tests that can build tracking URLs.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\USPS\Gateways\USPSTrackingGateway::__construct()
     */
    public function testCanBuildTrackingUrls()
    {
        $this->assertContains(CanBuildTrackingUrlTrait::class, class_uses(USPSTrackingGateway::class));
    }
}
