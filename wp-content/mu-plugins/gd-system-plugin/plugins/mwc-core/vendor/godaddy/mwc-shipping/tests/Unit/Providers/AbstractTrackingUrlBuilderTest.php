<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Providers;

use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Providers\AbstractTrackingUrlBuilder;
use Mockery;
use Mockery\MockInterface;

class AbstractTrackingUrlBuilderTest extends WPTestCase
{
    /**
     * @covers GoDaddy\WordPress\MWC\Shipping\Providers\AbstractTrackingUrlBuilder::getTrackingUrl()
     *
     * @dataProvider providerCanGetTrackingUrl
     */
    public function testCanGetTrackingUrl(string $trackingUrl, string $template, string $trackingNumber)
    {
        /** @var AbstractTrackingUrlBuilder|MockInterface */
        $builder = Mockery::mock(AbstractTrackingUrlBuilder::class)->makePartial();

        $builder->shouldReceive('getTrackingUrlTemplate')->andReturn('TEST_URL?TEST_PARAMETER={tracking_number}');

        $this->assertSame($trackingUrl, $builder->getTrackingUrl($trackingNumber));
    }

    /** @see testCanGetTrackingUrl() */
    public function providerCanGetTrackingUrl()
    {
        return [
            'default' => [
                'TEST_URL?TEST_PARAMETER=TEST_TRACKING_NUMBER',
                'TEST_URL?TEST_PARAMETER={tracking_number}',
                'TEST_TRACKING_NUMBER',
            ],
            'has surrounding space' => [
                'TEST_URL?TEST_PARAMETER=TEST_TRACKING_NUMBER',
                'TEST_URL?TEST_PARAMETER={tracking_number}',
                ' TEST_TRACKING_NUMBER ',
            ],
            'needs urlencoding' => [
                'TEST_URL?TEST_PARAMETER=TEST%20TRACKING%20NUMBER',
                'TEST_URL?TEST_PARAMETER={tracking_number}',
                'TEST TRACKING NUMBER',
            ],
            'needs urlencoding has surrounding space' => [
                'TEST_URL?TEST_PARAMETER=TEST%20TRACKING%20NUMBER',
                'TEST_URL?TEST_PARAMETER={tracking_number}',
                ' TEST TRACKING NUMBER ',
            ],
        ];
    }
}
