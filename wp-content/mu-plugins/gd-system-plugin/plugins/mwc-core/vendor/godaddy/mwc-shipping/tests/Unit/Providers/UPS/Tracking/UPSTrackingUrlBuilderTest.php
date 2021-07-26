<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\UPS\Tracking;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\UPS\Tracking\UPSTrackingUrlBuilder;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\UPS\Tracking\UPSTrackingUrlBuilder
 */
class UPSTrackingUrlBuilderTest extends WPTestCase
{
    /**
     * Tests that can get the tracking URL template.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\UPS\Tracking\UPSTrackingUrlBuilder::getTrackingUrlTemplate()
     */
    public function testCanGetTrackingUrlTemplate()
    {
        $builder = new UPSTrackingUrlBuilder();

        $this->assertSame(
            'https://www.ups.com/track?loc=en_US&tracknum={tracking_number}',
            $builder->getTrackingUrlTemplate()
        );
    }
}
