<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\CanadaPost\Gateways;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\CanadaPost\Gateways\CanadaPostTrackingGateway;
use GoDaddy\WordPress\MWC\Shipping\Traits\CanBuildTrackingUrlTrait;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\CanadaPost\Gateways\CanadaPostTrackingGateway
 */
class CanadaPostTrackingGatewayTest extends WPTestCase
{
    /**
     * Tests that can build tracking URLs.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\CanadaPost\Gateways\CanadaPostTrackingGateway::__construct()
     */
    public function testCanBuildTrackingUrls()
    {
        $this->assertContains(CanBuildTrackingUrlTrait::class, class_uses(CanadaPostTrackingGateway::class));
    }
}
