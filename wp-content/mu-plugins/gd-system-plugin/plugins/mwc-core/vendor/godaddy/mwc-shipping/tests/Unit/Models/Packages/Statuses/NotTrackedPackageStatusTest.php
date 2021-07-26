<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models\Packages\Statuses;

use GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\NotTrackedPackageStatus;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\NotTrackedPackageStatus
 */
class NotTrackedPackageStatusTest extends TestCase
{
    /**
     * Tests that can initialize name and label.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\NotTrackedPackageStatus::__construct()
     */
    public function testCanInitializeNameAndLabel()
    {
        $status = new NotTrackedPackageStatus();

        $this->assertEquals('not-tracked', $status->getName());
        $this->assertEquals('Not Tracked', $status->getLabel());
    }

    /**
     * Tests that can determine if the status can fulfill items.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\NotTrackedPackageStatus::canFulfillItems()
     */
    public function testCanFulfillItems()
    {
        $this->assertFalse((new NotTrackedPackageStatus())->canFulfillItems());
    }
}
