<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\CanadaPost;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\CanadaPost\CanadaPostProvider;
use GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingTrackingTrait;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\CanadaPost\CanadaPostProvider
 */
class CanadaPostProviderTest extends WPTestCase
{
    /**
     * Tests that can determine if the provider offers shipment tracking.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\CanadaPost\CanadaPostProvider::__construct()
     */
    public function testHasShippingTracking()
    {
        $this->assertContains(HasShippingTrackingTrait::class, class_uses(CanadaPostProvider::class));
    }
}
