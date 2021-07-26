<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\UPS\Gateways;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\UPS\Gateways\UPSTrackingGateway;
use GoDaddy\WordPress\MWC\Shipping\Traits\CanBuildTrackingUrlTrait;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\UPS\Gateways\UPSTrackingGateway
 */
class UPSTrackingGatewayTest extends WPTestCase
{
    /**
     * Tests that can build tracking URLs.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\UPS\Gateways\UPSTrackingGateway::__construct()
     */
    public function testCanBuildTrackingUrls()
    {
        $this->assertContains(CanBuildTrackingUrlTrait::class, class_uses(UPSTrackingGateway::class));
    }
}
