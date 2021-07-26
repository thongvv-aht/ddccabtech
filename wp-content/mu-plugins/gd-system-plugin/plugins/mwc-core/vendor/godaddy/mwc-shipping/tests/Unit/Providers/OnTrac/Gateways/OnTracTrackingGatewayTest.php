<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\OnTrac\Gateways;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\OnTrac\Gateways\OnTracTrackingGateway;
use GoDaddy\WordPress\MWC\Shipping\Traits\CanBuildTrackingUrlTrait;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\OnTrac\Gateways\OnTracTrackingGateway
 */
class OnTracTrackingGatewayTest extends WPTestCase
{
    /**
     * Tests that can build tracking URLs.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\OnTrac\Gateways\OnTracTrackingGateway::__construct()
     */
    public function testCanBuildTrackingUrls()
    {
        $this->assertContains(CanBuildTrackingUrlTrait::class, class_uses(OnTracTrackingGateway::class));
    }
}
