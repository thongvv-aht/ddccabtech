<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit;

use Exception;
use GoDaddy\WordPress\MWC\Common\Configuration\Configuration;
use GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Shipping;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Shipping
 */
class ShippingTest extends WPTestCase
{
    /**
     * Tests that can set providers upon initialization.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Shipping::__construct()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Shipping::setProviders()
     *
     * @throws ReflectionException|Exception
     */
    public function testCanSetProviders()
    {
        $this->mockWordPressTransients();

        $shipping = new Shipping();
        $providers = TestHelpers::getInaccessibleProperty($shipping, 'providers');

        $this->assertEquals([], $providers->getValue($shipping));

        $configurationProvider = $this->getMockForAbstractClass(AbstractProvider::class);
        $configurationProviders = ['test-provider' => $configurationProvider];

        Configuration::set('shipping.providers', $configurationProviders);

        $shipping = new Shipping();
        $providers = TestHelpers::getInaccessibleProperty($shipping, 'providers');

        $this->assertEquals(['' => $configurationProvider], $providers->getValue($shipping));
    }
}
