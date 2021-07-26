<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models\Orders\FulfillmentStatuses;

use GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\FulfilledFulfillmentStatus;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\FulfilledFulfillmentStatus
 */
class FulfilledFulfillmentStatusTest extends AbstractFulfillmentStatusTest
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\FulfilledFulfillmentStatus::getLabel()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\FulfilledFulfillmentStatus::setLabel()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\FulfilledFulfillmentStatus::getName()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\FulfilledFulfillmentStatus::setName()
     */
    public function testCanAccessFulfillmentStatusContractMethods()
    {
        $this->testContract(new FulfilledFulfillmentStatus());
    }

    /**
     * Tests that can initialize name and label.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\FulfilledFulfillmentStatus::__construct()
     */
    public function testCanInitializeNameAndLabel()
    {
        $status = new FulfilledFulfillmentStatus();

        $this->assertEquals('fulfilled', $status->getName());
        $this->assertEquals('Fulfilled', $status->getLabel());
    }
}
