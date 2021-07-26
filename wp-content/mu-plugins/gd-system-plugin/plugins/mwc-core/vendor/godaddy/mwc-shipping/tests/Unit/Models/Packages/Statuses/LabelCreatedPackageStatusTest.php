<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models\Packages\Statuses;

use GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\LabelCreatedPackageStatus;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\LabelCreatedPackageStatus
 */
class LabelCreatedPackageStatusTest extends TestCase
{
    /**
     * Tests that can initialize name and label.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\LabelCreatedPackageStatus::__construct()
     */
    public function testCanInitializeNameAndLabel()
    {
        $status = new LabelCreatedPackageStatus();

        $this->assertEquals('label-created', $status->getName());
        $this->assertEquals('Label Created', $status->getLabel());
    }

    /**
     * Tests that can determine if the status can fulfill items.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\LabelCreatedPackageStatus::canFulfillItems()
     */
    public function testCanFulfillItems()
    {
        $this->assertTrue((new LabelCreatedPackageStatus())->canFulfillItems());
    }
}
