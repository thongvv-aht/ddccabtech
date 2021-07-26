<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\DHL\Tracking;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\DHL\Tracking\DHLTrackingUrlBuilder;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\DHL\Tracking\DHLTrackingUrlBuilder
 */
class DHLTrackingUrlBuilderTest extends WPTestCase
{
    /**
     * Tests that can get the tracking URL template.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\DHL\Tracking\DHLTrackingUrlBuilder::getTrackingUrlTemplate()
     */
    public function testCanGetTrackingUrlTemplate()
    {
        $builder = new DHLTrackingUrlBuilder();

        $this->assertSame(
            'https://www.dhl.com/us-en/home/tracking/tracking-ecommerce.html?tracking-id={tracking_number}',
            $builder->getTrackingUrlTemplate()
        );
    }
}
