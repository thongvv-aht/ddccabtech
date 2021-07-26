<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models\Orders\FulfillmentStatuses;

use GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\PartiallyFulfilledFulfillmentStatus;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\PartiallyFulfilledFulfillmentStatus
 */
class PartiallyFulfilledFulfillmentStatusTest extends AbstractFulfillmentStatusTest
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\PartiallyFulfilledFulfillmentStatus::getLabel()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\PartiallyFulfilledFulfillmentStatus::setLabel()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\PartiallyFulfilledFulfillmentStatus::getName()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\PartiallyFulfilledFulfillmentStatus::setName()
     */
    public function testCanAccessFulfillmentStatusContractMethods()
    {
        $this->testContract(new PartiallyFulfilledFulfillmentStatus());
    }

    /**
     * Tests that can initialize name and label.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\PartiallyFulfilledFulfillmentStatus::__construct()
     */
    public function testCanInitializeNameAndLabel()
    {
        $status = new PartiallyFulfilledFulfillmentStatus();

        $this->assertEquals('partially-fulfilled', $status->getName());
        $this->assertEquals('Partially Fulfilled', $status->getLabel());
    }
}
