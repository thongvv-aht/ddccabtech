<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models\Packages\Statuses;

use GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\CancelledPackageStatus;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\CancelledPackageStatus
 */
class CancelledPackageStatusTest extends TestCase
{
    /**
     * Tests that can initialize name and label.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\CancelledPackageStatus::__construct()
     */
    public function testCanInitializeNameAndLabel()
    {
        $status = new CancelledPackageStatus();

        $this->assertEquals('cancelled', $status->getName());
        $this->assertEquals('Cancelled', $status->getLabel());
    }

    /**
     * Tests that can determine if the status can fulfill items.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\CancelledPackageStatus::canFulfillItems()
     */
    public function testCanFulfillItems()
    {
        $this->assertFalse((new CancelledPackageStatus())->canFulfillItems());
    }
}
