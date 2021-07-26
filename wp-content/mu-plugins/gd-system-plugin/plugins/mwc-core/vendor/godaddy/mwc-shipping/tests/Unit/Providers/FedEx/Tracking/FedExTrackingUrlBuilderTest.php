<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\FedEx\Tracking;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\FedEx\Tracking\FedExTrackingUrlBuilder;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\FedEx\Tracking\FedExTrackingUrlBuilder
 */
class FedExTrackingUrlBuilderTest extends WPTestCase
{
    /**
     * Tests that can get the tracking URL template.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\FedEx\Tracking\FedExTrackingUrlBuilder::getTrackingUrlTemplate()
     */
    public function testCanGetTrackingUrlTemplate()
    {
        $builder = new FedExTrackingUrlBuilder();

        $this->assertSame(
            'https://www.fedex.com/apps/fedextrack/?action=track&tracknumbers={tracking_number}',
            $builder->getTrackingUrlTemplate()
        );
    }
}
