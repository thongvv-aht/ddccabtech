<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models\Orders\FulfillmentStatuses;

use GoDaddy\WordPress\MWC\Common\Contracts\FulfillmentStatusContract;
use PHPUnit\Framework\TestCase;

/**
 * Provides common tests for FulfillmentStatusContract implementations.
 */
abstract class AbstractFulfillmentStatusTest extends TestCase
{
    /**
     * Asserts that a fulfillment status adheres to its contract.
     *
     * @param FulfillmentStatusContract $fulfillmentStatus
     */
    protected function testContract(FulfillmentStatusContract $fulfillmentStatus)
    {
        $fulfillmentStatus
            ->setLabel('label')
            ->setName('name');

        $this->assertInstanceOf(FulfillmentStatusContract::class, $fulfillmentStatus);
        $this->assertSame('label', $fulfillmentStatus->getLabel());
        $this->assertSame('name', $fulfillmentStatus->getName());
    }
}
