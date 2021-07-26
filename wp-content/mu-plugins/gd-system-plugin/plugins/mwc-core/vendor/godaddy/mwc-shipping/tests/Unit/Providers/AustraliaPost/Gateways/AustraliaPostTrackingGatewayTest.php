<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\AustraliaPost\Gateways;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\AustraliaPost\Gateways\AustraliaPostTrackingGateway;
use GoDaddy\WordPress\MWC\Shipping\Traits\CanBuildTrackingUrlTrait;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\AustraliaPost\Gateways\AustraliaPostTrackingGateway
 */
class AustraliaPostTrackingGatewayTest extends WPTestCase
{
    /**
     * Tests that can build tracking URLs.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\AustraliaPost\Gateways\AustraliaPostTrackingGateway::__construct()
     */
    public function testCanBuildTrackingUrls()
    {
        $this->assertContains(CanBuildTrackingUrlTrait::class, class_uses(AustraliaPostTrackingGateway::class));
    }
}
