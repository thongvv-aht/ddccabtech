<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\DataSourceAdapterContract;
use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;
use GoDaddy\WordPress\MWC\Common\Http\Request;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Models\Shipment;
use GoDaddy\WordPress\MWC\Shipping\Traits\CanCancelShippingLabelsTrait;
use WP_Mock;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\CanCancelShippingLabelsTrait
 */
class CanCancelShippingLabelsTraitTest extends WPTestCase
{
    /**
     * Tests that can send a request to cancel shipping labels.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\CanCancelShippingLabelsTrait::cancel()
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

        $this->assertIsArray($instance->cancel($shipments));
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
     * @return CanCancelShippingLabelsTrait|object
     */
    private function getMockInstance(DataSourceAdapterContract $adapter)
    {
        return new class($adapter)
        {
            use CanCancelShippingLabelsTrait;

            public function __construct(DataSourceAdapterContract $adapter)
            {
                $this->cancelLabelShipmentAdapter = get_class($adapter);
            }
        };
    }
}
