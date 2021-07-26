<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Shipping\Contracts\GatewayContract;
use GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingLabelsTrait;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingLabelsTrait
 */
class HasShippingLabelsTraitTest extends TestCase
{
    /**
     * Tests that can get the shipping labels gateway.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingLabelsTrait::labels()
     *
     * @throws ReflectionException
     */
    public function testCanGetLabelsGateway()
    {
        $mock = $this->getMockForTrait(HasShippingLabelsTrait::class);
        $gateway = $this->getGateway();

        TestHelpers::getInaccessibleProperty(get_class($mock), 'labelsGateway')->setValue($mock, get_class($gateway));

        $this->assertInstanceOf(GatewayContract::class, $mock->labels());
    }

    /**
     * Gets a gateway instance.
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
