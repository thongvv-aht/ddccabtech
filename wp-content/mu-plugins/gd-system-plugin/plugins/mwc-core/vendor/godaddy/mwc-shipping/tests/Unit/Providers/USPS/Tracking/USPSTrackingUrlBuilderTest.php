<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\USPS\Tracking;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\USPS\Tracking\USPSTrackingUrlBuilder;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\USPS\Tracking\USPSTrackingUrlBuilder
 */
class USPSTrackingUrlBuilderTest extends WPTestCase
{
    /**
     * Tests that can get the tracking URL template.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\USPS\Tracking\USPSTrackingUrlBuilder::getTrackingUrlTemplate()
     */
    public function testCanGetTrackingUrlTemplate()
    {
        $builder = new USPSTrackingUrlBuilder();

        $this->assertSame(
            'https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1={tracking_number}',
            $builder->getTrackingUrlTemplate()
        );
    }
}
