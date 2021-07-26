<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\AustraliaPost;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\AustraliaPost\AustraliaPostProvider;
use GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingTrackingTrait;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\AustraliaPost\AustraliaPostProvider
 */
class AustraliaPostProviderTest extends WPTestCase
{
    /**
     * Tests that can determine if the provider offers shipment tracking.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\AustraliaPost\AustraliaPostProvider::__construct()
     */
    public function testHasShippingTracking()
    {
        $this->assertContains(HasShippingTrackingTrait::class, class_uses(AustraliaPostProvider::class));
    }
}
