<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\CanadaPost\Tracking;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\CanadaPost\Tracking\CanadaPostTrackingUrlBuilder;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\CanadaPost\Tracking\CanadaPostTrackingUrlBuilder
 */
class CanadaPostTrackingUrlBuilderTest extends WPTestCase
{
    /**
     * Tests that can get the tracking URL template.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\CanadaPost\Tracking\CanadaPostTrackingUrlBuilder::getTrackingUrlTemplate()
     */
    public function testCanGetTrackingUrlTemplate()
    {
        $builder = new CanadaPostTrackingUrlBuilder();

        $this->assertSame(
            'https://www.canadapost.ca/cpotools/apps/track/personal/findByTrackNumber?trackingNumber={tracking_number}',
            $builder->getTrackingUrlTemplate()
        );
    }
}
