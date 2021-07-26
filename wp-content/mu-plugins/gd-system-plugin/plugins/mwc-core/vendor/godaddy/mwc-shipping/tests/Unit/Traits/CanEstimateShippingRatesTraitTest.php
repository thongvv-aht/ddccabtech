<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\DataSourceAdapterContract;
use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;
use GoDaddy\WordPress\MWC\Common\Http\Request;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Models\Shipment;
use GoDaddy\WordPress\MWC\Shipping\Traits\CanEstimateShippingRatesTrait;
use WP_Mock;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\CanEstimateShippingRatesTrait
 */
class CanEstimateShippingRatesTraitTest extends WPTestCase
{
    /**
     * Tests that can send a request to estimate shipping rates.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\CanEstimateShippingRatesTrait::estimate()
     *
     * @throws BaseException
     */
    public function testCanEstimateShippingRates()
    {
        WP_Mock::userFunction('wp_remote_request');
        WP_Mock::userFunction('is_wp_error');

        $this->mockWordPressTransients();

        $instance = $this->getMockInstance($this->getMockAdapter());
        $shipments = [new Shipment(), new Shipment()];

        $this->assertIsArray($instance->estimate($shipments));
    }

    /**
     * Gets an instance of a class implementing the adapter interface expected by the trait.
     *
     * @return DataSourceAdapterContract|object
     */
    private function getMockAdapter()
    {
        return new class() implements DataSourceAdapterContract
        {
            public function convertFromSource()
            {
                return (new Request())->url('https://example.com');
            }

            public function convertToSource()
            {
                return [];
            }
        };
    }

    /**
     * Gets an instance of a class implementing the trait.
     *
     * @param DataSourceAdapterContract $adapter
     * @return CanEstimateShippingRatesTrait|object
     */
    private function getMockInstance(DataSourceAdapterContract $adapter)
    {
        return new class($adapter)
        {
            use CanEstimateShippingRatesTrait;

            public function __construct(DataSourceAdapterContract $adapter)
            {
                $this->estimateRatesShipmentAdapter = get_class($adapter);
            }
        };
    }
}
