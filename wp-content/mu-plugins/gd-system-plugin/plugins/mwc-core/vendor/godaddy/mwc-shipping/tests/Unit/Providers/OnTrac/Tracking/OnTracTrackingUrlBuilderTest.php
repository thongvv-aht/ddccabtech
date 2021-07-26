<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers\OnTrac\Tracking;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\OnTrac\Tracking\OnTracTrackingUrlBuilder;

class OnTracTrackingUrlBuilderTest extends WPTestCase
{
    /**
     * Tests that can get the tracking URL template.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Providers\OnTrac\Tracking\OnTracTrackingUrlBuilder::getTrackingUrlTemplate()
     */
    public function testCanGetTrackingUrlTemplate()
    {
        $builder = new OnTracTrackingUrlBuilder();

        $this->assertSame(
            'https://www.ontrac.com/trackingdetail.asp?tracking={tracking_number}',
            $builder->getTrackingUrlTemplate()
        );
    }
}
