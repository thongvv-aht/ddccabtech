<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\AustraliaPost\Tracking;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\AustraliaPost\Tracking\AustraliaPostTrackingUrlBuilder;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\AustraliaPost\Tracking\AustraliaPostTrackingUrlBuilder
 */
class AustraliaPostTrackingUrlBuilderTest extends WPTestCase
{
    /**
     * Tests that can get the tracking URL template.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\AustraliaPost\Tracking\AustraliaPostTrackingUrlBuilder::getTrackingUrlTemplate()
     */
    public function testCanGetTrackingUrlTemplate()
    {
        $builder = new AustraliaPostTrackingUrlBuilder();

        $this->assertSame(
            'https://auspost.com.au/mypost/track/#/details/{tracking_number}',
            $builder->getTrackingUrlTemplate()
        );
    }
}
