<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models\Packages;

use GoDaddy\WordPress\MWC\Common\Models\Dimensions;
use GoDaddy\WordPress\MWC\Common\Models\Orders\LineItem;
use GoDaddy\WordPress\MWC\Common\Models\Weight;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;
use GoDaddy\WordPress\MWC\Shipping\Contracts\PackageStatusContract;
use GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package;
use GoDaddy\WordPress\MWC\Shipping\Models\ShippingLabel;
use GoDaddy\WordPress\MWC\Shipping\Models\ShippingRate;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package
 */
class PackageTest extends TestCase
{
    /**
     * Tests that can get the package ID.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::getId()
     *
     * @throws ReflectionException
     */
    public function testCanGetId()
    {
        $package = new Package();
        $id = '123';
        $property = TestHelpers::getInaccessibleProperty($package, 'id');

        $property->setValue($package, $id);

        $this->assertEquals($id, $property->getValue($package));
    }

    /**
     * Tests that can set the package ID.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::setId()
     *
     * @throws ReflectionException
     */
    public function testCanSetId()
    {
        $package = new Package();
        $id = '123';
        $property = TestHelpers::getInaccessibleProperty($package, 'id');

        $this->assertNull($property->getValue($package));

        $this->assertInstanceOf(get_class($package), $package->setId($id));

        $this->assertEquals($id, $property->getValue($package));
    }

    /**
     * Tests that can get items in the package.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::getItems()
     *
     * @throws ReflectionException
     */
    public function testCanGetItems()
    {
        $package = new Package();
        $itemA = (new LineItem())->setId(123);
        $itemB = (new LineItem())->setId(456);
        $items = [$itemA->getId() => $itemA, $itemB->getId() => $itemB];
        $property = TestHelpers::getInaccessibleProperty($package, 'items');

        $property->setValue($package, $items);

        $this->assertEquals($items, $package->getItems());
    }

    /**
     * Tests that can add an item to a package.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::addItem()
     * @dataProvider providerCanAddItemToPackage
     *
     * @param array $initialItems
     * @param array $initialItemQuantities
     * @param LineItem $addItem
     * @param float $addQuantity
     * @param array $resultItems
     * @param array $resultItemQuantities
     * @throws ReflectionException
     */
    public function testCanAddItem(array $initialItems, array $initialItemQuantities, LineItem $addItem, float $addQuantity, array $resultItems, array $resultItemQuantities)
    {
        $package = new Package();
        $items = TestHelpers::getInaccessibleProperty($package, 'items');
        $items->setValue($package, $initialItems);
        $itemQuantities = TestHelpers::getInaccessibleProperty($package, 'itemQuantities');
        $itemQuantities->setValue($package, $initialItemQuantities);

        $this->assertInstanceOf(get_class($package), $package->addItem($addItem, $addQuantity));

        $this->assertEquals($resultItems, $items->getValue($package));
        $this->assertEquals($resultItemQuantities, $itemQuantities->getValue($package));
    }

    /** @see testCanAddItem */
    public function providerCanAddItemToPackage() : array
    {
        $itemA = (new LineItem())->setId(123);
        $itemB = (new LineItem())->setId(456);

        return [
            'Add a different item in the package' => [
                [$itemA->getId() => $itemA],
                [$itemA->getId() => 1],
                $itemB,
                1,
                [$itemA->getId() => $itemA, $itemB->getId() => $itemB],
                [$itemA->getId() => 1, $itemB->getId() => 1],
            ],
            'Add an item in the package containing the same' => [
                [$itemA->getId() => $itemA],
                [$itemA->getId() => 1],
                $itemA,
                1,
                [$itemA->getId() => $itemA],
                [$itemA->getId() => 2],
            ],
            'Add an item to an empty package' => [
                [],
                [],
                $itemA,
                1,
                [$itemA->getId() => $itemA],
                [$itemA->getId() => 1],
            ],
        ];
    }

    /**
     * Tests that can remove an item from a package.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::removeItem()
     * @dataProvider providerCanRemoveItemFromPackage
     *
     * @param array $initialItems
     * @param array $initialItemQuantities
     * @param LineItem $removeItem
     * @param float $removeQuantity
     * @param array $resultItems
     * @param array $resultItemQuantities
     * @throws ReflectionException
     */
    public function testCanRemoveItem(array $initialItems, array $initialItemQuantities, LineItem $removeItem, float $removeQuantity, array $resultItems, array $resultItemQuantities)
    {
        $package = new Package();
        $items = TestHelpers::getInaccessibleProperty($package, 'items');
        $items->setValue($package, $initialItems);
        $itemQuantities = TestHelpers::getInaccessibleProperty($package, 'itemQuantities');
        $itemQuantities->setValue($package, $initialItemQuantities);

        $this->assertInstanceOf(get_class($package), $package->removeItem($removeItem, $removeQuantity));

        $this->assertEquals($resultItems, $items->getValue($package));
        $this->assertEquals($resultItemQuantities, $itemQuantities->getValue($package));
    }

    /** @see testCanRemoveItem */
    public function providerCanRemoveItemFromPackage() : array
    {
        $itemA = (new LineItem())->setId(123);
        $itemB = (new LineItem())->setId(456);

        return [
            'Remove some quantity of an item that is in a package' => [
                [$itemA->getId() => $itemA],
                [$itemA->getId() => 2],
                $itemA,
                1,
                [$itemA->getId() => $itemA],
                [$itemA->getId() => 1],
            ],
            'Remove some quantity of a different item that does not exist in the package' => [
                [$itemA->getId() => $itemA],
                [$itemA->getId() => 2],
                $itemB,
                1,
                [$itemA->getId() => $itemA],
                [$itemA->getId() => 2],
            ],
            'Remove all the quantity of an item in a package that contains multiple items' => [
                [$itemA->getId() => $itemA, $itemB->getId() => $itemB],
                [$itemA->getId() => 2, $itemB->getId() => 1],
                $itemA,
                2,
                [$itemB->getId() => $itemB],
                [$itemB->getId() => 1],
            ],
            'Remove the last item in a package' => [
                [$itemA->getId() => $itemA],
                [$itemA->getId() => 1],
                $itemA,
                1,
                [],
                [],
            ],
            'Remove an item that does not exist in the package' => [
                [$itemA->getId() => $itemA],
                [$itemA->getId() => 2],
                $itemB,
                1,
                [$itemA->getId() => $itemA],
                [$itemA->getId() => 2],
            ],
            'Remove an item from an empty package' => [
                [],
                [],
                $itemA,
                1,
                [],
                [],
            ]
        ];
    }

    /**
     * Tests that can get the quantity of an item in the package.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::getItemQuantity()
     * @dataProvider providerCanGetQuantitiesForItems
     *
     * @param array $setItems
     * @param array $setItemQuantities
     * @param LineItem $item
     * @param float|int $expected
     * @throws ReflectionException
     */
    public function testCanGetItemQuantity(array $setItems, array $setItemQuantities, LineItem $item, float $expected)
    {
        $package = new Package();
        $items = TestHelpers::getInaccessibleProperty($package, 'items');
        $items->setValue($package, $setItems);
        $itemQuantities = TestHelpers::getInaccessibleProperty($package, 'itemQuantities');
        $itemQuantities->setValue($package, $setItemQuantities);

        $this->assertEquals($expected, $package->getItemQuantity($item));
    }

    /** @see testCanGetItemQuantity */
    public function providerCanGetQuantitiesForItems() : array
    {
        $itemA = (new LineItem())->setId(123);
        $itemB = (new LineItem())->setId(456);

        return [
            'Quantity for item from package containing the item' => [
                [$itemA->getId() => $itemA],
                [$itemA->getId() => 1],
                $itemA,
                1,
            ],
            'Quantity for item from package containing multiple items' => [
                [$itemA->getId() => $itemA, $itemB->getId() => $itemB],
                [$itemA->getId() => 1, $itemB->getId() => 1],
                $itemB,
                1,
            ],
            'Quantity for item that does not exist in package' => [
                [$itemA->getId() => $itemA],
                [$itemA->getId() => 1],
                $itemB,
                0,
            ],
            'Quantity for item in a empty package' => [
                [],
                [],
                $itemA,
                0,
            ],
        ];
    }

    /**
     * Tests that can determine if a given item is in the package.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::hasItem()
     */
    public function testCanDetermineIfItemIsInPackage()
    {
        $package = new Package();
        $item = (new LineItem())->setId(123);

        $this->assertFalse($package->hasItem($item));

        $package->addItem($item, 1);

        $this->assertTrue($package->hasItem($item));
    }

    /**
     * Tests that can get the package status.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::getStatus()
     * @dataProvider providerPackageStatus
     *
     * @throws ReflectionException
     */
    public function testCanGetStatus(PackageStatusContract $status)
    {
        $package = new Package();
        $property = TestHelpers::getInaccessibleProperty($package, 'status');
        $property->setValue($package, $status);

        $this->assertEquals($status, $package->getStatus());
    }

    /**
     * Tests that can set the package status.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::setStatus()
     * @dataProvider providerPackageStatus
     *
     * @throws ReflectionException
     */
    public function testCanSetStatus(PackageStatusContract $status)
    {
        $package = new Package();
        $property = TestHelpers::getInaccessibleProperty($package, 'status');

        $this->assertNull($property->getValue($package));

        $this->assertInstanceOf(get_class($package), $package->setStatus($status));

        $this->assertEquals($status, $property->getValue($package));
    }

    /**
     * Tests that can determine if the package items can be fulfilled.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::canFulfillItems
     * @dataProvider providerPackageStatus
     *
     * @param PackageStatusContract $status
     * @param bool $fulfillable
     */
    public function testCanFulfillItems(PackageStatusContract $status, bool $fulfillable)
    {
        $this->assertEquals($fulfillable, (new Package())->setStatus($status)->canFulfillItems());
    }

    /** @see PackageTest status tests */
    public function providerPackageStatus() : array
    {
        return [
            'Status that cannot fulfill items' => [
                new class implements PackageStatusContract
                {
                    use HasLabelTrait;

                    public function canFulfillItems() : bool
                    {
                        return false;
                    }
                },
                false
            ],
            'Status that can fulfill items' => [
                new class implements PackageStatusContract
                {
                    use HasLabelTrait;

                    public function canFulfillItems() : bool
                    {
                        return true;
                    }
                },
                true
            ],
        ];
    }

    /**
     * Tests that can get the package shipping rate.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::getShippingRate()
     *
     * @throws ReflectionException
     */
    public function testCanGetShippingRate()
    {
        $package = new Package();

        $this->assertNull($package->getShippingRate());

        $shippingRate = new ShippingRate();
        $property = TestHelpers::getInaccessibleProperty($package, 'shippingRate');
        $property->setValue($package, $shippingRate);

        $this->assertEquals($shippingRate, $package->getShippingRate());
    }

    /**
     * Tests that can set the package shipping rate.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::setShippingRate()
     *
     * @throws ReflectionException
     */
    public function testCanSetShippingRate()
    {
        $package = new Package();
        $shippingRate = new ShippingRate();
        $property = TestHelpers::getInaccessibleProperty($package, 'shippingRate');

        $this->assertNull($property->getValue($package));

        $this->assertInstanceOf(get_class($package), $package->setShippingRate($shippingRate));

        $this->assertEquals($shippingRate, $property->getValue($package));
    }

    /**
     * Tests that can get the package shipping label.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::getShippingLabel()
     *
     * @throws ReflectionException
     */
    public function testCanGetShippingLabel()
    {
        $package = new Package();

        $this->assertNull($package->getShippingLabel());

        $shippingLabel = new ShippingLabel();
        $property = TestHelpers::getInaccessibleProperty($package, 'shippingLabel');
        $property->setValue($package, $shippingLabel);

        $this->assertEquals($shippingLabel, $package->getShippingLabel());
    }

    /**
     * Tests that can set the package shipping label.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::setShippingLabel()
     *
     * @throws ReflectionException
     */
    public function testCanSetShippingLabel()
    {
        $package = new Package();
        $shippingLabel = new ShippingLabel();
        $property = TestHelpers::getInaccessibleProperty($package, 'shippingLabel');

        $this->assertNull($property->getValue($package));

        $this->assertInstanceOf(get_class($package), $package->setShippingLabel($shippingLabel));

        $this->assertEquals($shippingLabel, $property->getValue($package));
    }

    /**
     * Tests that can get the package tracking number.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::getTrackingNumber()
     *
     * @throws ReflectionException
     */
    public function testCanGetTrackingNumber()
    {
        $package = new Package();

        $this->assertNull($package->getTrackingNumber());

        $trackingNumber = 'TrackingNumber123';
        $property = TestHelpers::getInaccessibleProperty($package, 'trackingNumber');
        $property->setValue($package, $trackingNumber);

        $this->assertEquals($trackingNumber, $package->getTrackingNumber());
    }

    /**
     * Tests that can set the package tracking number.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::getTrackingNumber()
     *
     * @throws ReflectionException
     */
    public function testCanSetTrackingNumber()
    {
        $package = new Package();
        $trackingNumber = 'TrackingNumber123';
        $property = TestHelpers::getInaccessibleProperty($package, 'trackingNumber');

        $this->assertNull($property->getValue($package));

        $this->assertInstanceOf(get_class($package), $package->setTrackingNumber($trackingNumber));

        $this->assertEquals($trackingNumber, $property->getValue($package));
    }

    /**
     * Tests that can get the package tracking URL.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::getTrackingUrl()
     *
     * @throws ReflectionException
     */
    public function testCanGetTrackingUrl()
    {
        $package = new Package();

        $this->assertNull($package->getTrackingUrl());

        $trackingUrl = 'https://example.com/tracking';
        $property = TestHelpers::getInaccessibleProperty($package, 'trackingUrl');
        $property->setValue($package, $trackingUrl);

        $this->assertEquals($trackingUrl, $package->getTrackingUrl());
    }

    /**
     * Tests that can set the package tracking URL.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package::setTrackingUrl()
     *
     * @throws ReflectionException
     */
    public function testCanSetTrackingUrl()
    {
        $package = new Package();
        $trackingUrl = 'https://example.com/tracking';
        $property = TestHelpers::getInaccessibleProperty($package, 'trackingUrl');

        $this->assertNull($property->getValue($package));

        $this->assertInstanceOf(get_class($package), $package->setTrackingUrl($trackingUrl));

        $this->assertEquals($trackingUrl, $property->getValue($package));
    }
}
