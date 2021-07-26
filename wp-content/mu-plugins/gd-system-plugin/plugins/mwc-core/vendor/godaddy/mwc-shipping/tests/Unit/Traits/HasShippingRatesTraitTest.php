<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Shipping\Contracts\GatewayContract;
use GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingRatesTrait;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingRatesTrait
 */
class HasShippingRatesTraitTest extends TestCase
{
    /**
     * Tests that can get the shipping rates gateway.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingRatesTrait::rates()
     *
     * @throws ReflectionException
     */
    public function testCanGetRatesGateway()
    {
        $mock = $this->getMockForTrait(HasShippingRatesTrait::class);
        $gateway = $this->getGateway();

        TestHelpers::getInaccessibleProperty(get_class($mock), 'ratesGateway')->setValue($mock, get_class($gateway));

        $this->assertInstanceOf(GatewayContract::class, $mock->rates());
    }

    /**
     * Gets an instance of a gateway.
     *
     * @return GatewayContract
     */
    private function getGateway() : GatewayContract
    {
        return new class implements GatewayContract
        {
        };
    }
}
