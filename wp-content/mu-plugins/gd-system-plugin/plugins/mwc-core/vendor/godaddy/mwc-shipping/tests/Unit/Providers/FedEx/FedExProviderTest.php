<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\FedEx;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\FedEx\FedExProvider;
use GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingTrackingTrait;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\FedEx\FedExProvider
 */
class FedExProviderTest extends WPTestCase
{
    /**
     * Tests that can determine if the provider offers shipment tracking.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\FedEx\FedExProvider::__construct()
     */
    public function testHasShippingTracking()
    {
        $this->assertContains(HasShippingTrackingTrait::class, class_uses(FedExProvider::class));
    }
}
