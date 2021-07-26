<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models\Orders\FulfillmentStatuses;

use GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\UnfulfilledFulfillmentStatus;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\UnfulfilledFulfillmentStatus
 */
class UnfulfilledFulfillmentStatusTest extends AbstractFulfillmentStatusTest
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\UnfulfilledFulfillmentStatus::getLabel()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\UnfulfilledFulfillmentStatus::setLabel()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\UnfulfilledFulfillmentStatus::getName()
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\UnfulfilledFulfillmentStatus::setName()
     */
    public function testCanAccessFulfillmentStatusContractMethods()
    {
        $this->testContract(new UnfulfilledFulfillmentStatus());
    }

    /**
     * Tests that can initialize name and label.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Orders\FulfillmentStatuses\UnfulfilledFulfillmentStatus::__construct()
     */
    public function testCanInitializeNameAndLabel()
    {
        $status = new UnfulfilledFulfillmentStatus();

        $this->assertEquals('unfulfilled', $status->getName());
        $this->assertEquals('Unfulfilled', $status->getLabel());
    }
}
