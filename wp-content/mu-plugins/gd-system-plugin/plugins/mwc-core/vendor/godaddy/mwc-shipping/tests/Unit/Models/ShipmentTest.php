<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Models;

use DateTime;
use GoDaddy\WordPress\MWC\Common\Models\Address;
use GoDaddy\WordPress\MWC\Common\Models\Dimensions;
use GoDaddy\WordPress\MWC\Common\Models\Orders\LineItem;
use GoDaddy\WordPress\MWC\Common\Models\Weight;
use GoDaddy\WordPress\MWC\Common\Providers\Contracts\ProviderContract;
use GoDaddy\WordPress\MWC\Common\Tests\Helpers\Traits\HasPropertyAssertionsTrait;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;
use GoDaddy\WordPress\MWC\Shipping\Contracts\PackageContract;
use GoDaddy\WordPress\MWC\Shipping\Contracts\PackageStatusContract;
use GoDaddy\WordPress\MWC\Shipping\Models\Packages\Package;
use GoDaddy\WordPress\MWC\Shipping\Models\Packages\Statuses\LabelCreatedPackageStatus;
use GoDaddy\WordPress\MWC\Shipping\Models\Shipment;
use GoDaddy\WordPress\MWC\Shipping\Models\ShippingLabel;
use GoDaddy\WordPress\MWC\Shipping\Models\ShippingRate;
use GoDaddy\WordPress\MWC\Shipping\Models\ShippingService;
use GoDaddy\WordPress\MWC\Shipping\Shipping;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment
 */
class ShipmentTest extends WPTestCase
{
    use HasPropertyAssertionsTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->testObject = new Shipment();
    }

    /**
     * @see HasPropertyAssertionsTrait::testCanGetProperties()
     * @see HasPropertyAssertionsTrait::testCanSetProperties()
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getId
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::setId
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getOriginAddress
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::setOriginAddress
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getDestinationAddress
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::setDestinationAddress
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getProviderName
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::setProviderName
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getProviderLabel
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::setProviderLabel
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getService
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::setService
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getShippingRate
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::setShippingRate
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getPackages
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::setPackages
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getCreatedAt
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::setCreatedAt
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getUpdatedAt
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::setUpdatedAt
     */
    public function providerForTestProperties() : array
    {
        return [
            ['id', 'test'],
            ['originAddress', new Address()],
            ['destinationAddress', new Address()],
            ['providerName', 'test'],
            ['providerLabel', 'Test'],
            ['service', new ShippingService()],
            ['shippingRate', new ShippingRate()],
            ['packages', ['TEST_PACKAGE_ID' => (new Package)->setId('TEST_PACKAGE_ID')]],
            ['createdAt', new DateTime('2021-01-01')],
            ['updatedAt', new DateTime('2021-01-01')],
        ];
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::setPackages
     */
    public function testSetPackagesReplacesPackages()
    {
        $shipment = new Shipment();

        $package1 = (new Package())->setId('TEST_PACKAGE_ID_1');
        $package2 = (new Package())->setId('TEST_PACKAGE_ID_2');

        $shipment->setPackages([$package1]);

        $this->assertSame(['TEST_PACKAGE_ID_1' => $package1], $shipment->getPackages());

        $shipment->setPackages([$package2]);

        $this->assertSame(['TEST_PACKAGE_ID_2' => $package2], $shipment->getPackages());
    }

    /**
     * Tests that can get packages from shipment.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getPackages()
     *
     * @throws ReflectionException
     */
    public function testCanGetPackages()
    {
        $shipment = new Shipment();
        $packages = [(new Package())->setId(123), (new Package())->setId(456)];
        $property = TestHelpers::getInaccessibleProperty($shipment, 'packages');

        $property->setValue($shipment, $packages);

        $this->assertEquals($packages, $shipment->getPackages());
    }

    /**
     * Tests that can add a package to a shipment.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::addPackage()
     *
     * @throws ReflectionException
     */
    public function testCanAddPackage()
    {
        $shipment = new Shipment();
        $package = (new Package())->setId(123);
        $property = TestHelpers::getInaccessibleProperty($shipment, 'packages');

        $packages = $property->getValue($shipment);

        $this->assertIsArray($packages);
        $this->assertCount(0, $packages);

        $this->assertInstanceOf(get_class($shipment), $shipment->addPackage($package));

        $packages = $property->getValue($shipment);

        $this->assertIsArray($packages);
        $this->assertCount(1, $packages);
        $this->assertSame($package, current($packages));
    }

    /**
     * Tests that can add multiple packages to a shipment.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::addPackages()
     *
     * @throws ReflectionException
     */
    public function testCanAddPackages()
    {
        $shipment = new Shipment();
        $packageA = (new Package())->setId(123);
        $packageB = (new Package())->setId(456);
        $property = TestHelpers::getInaccessibleProperty($shipment, 'packages');

        $packages = $property->getValue($shipment);

        $this->assertIsArray($packages);
        $this->assertCount(0, $packages);

        $this->assertFalse($shipment->hasPackage($packageA));
        $this->assertFalse($shipment->hasPackage($packageB));

        $this->assertInstanceOf(get_class($shipment), $shipment->addPackages([$packageA, $packageB]));

        $this->assertNotEmpty($shipment->getPackages());
        $this->assertTrue($shipment->hasPackage($packageA));
        $this->assertTrue($shipment->hasPackage($packageB));

        $packages = $property->getValue($shipment);

        $this->assertIsArray($packages);
        $this->assertCount(2, $packages);
    }

    /**
     * Tests that can remove a package from a shipment.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::removePackage()
     *
     * @throws ReflectionException
     */
    public function testCanRemovePackage()
    {
        $shipment = new Shipment();
        $packageA = (new Package())->setId(123);
        $packageB = (new Package())->setId(456);
        $property = TestHelpers::getInaccessibleProperty($shipment, 'packages');

        $this->assertEmpty($property->getValue($shipment));

        $this->assertInstanceOf(get_class($shipment), $shipment->removePackage($packageA));
        $this->assertInstanceOf(get_class($shipment), $shipment->removePackage($packageB));

        $this->assertEmpty($property->getValue($shipment));

        $property->setValue($shipment, [$packageA->getId() => $packageA, $packageB->getId() => $packageB]);

        $this->assertInstanceOf(get_class($shipment), $shipment->removePackage($packageA));

        $this->assertFalse($shipment->hasPackage($packageA));
        $this->assertTrue($shipment->hasPackage($packageB));

        $packages = $property->getValue($shipment);

        $this->assertIsArray($packages);
        $this->assertCount(1, $packages);

        $this->assertInstanceOf(get_class($shipment), $shipment->removePackage($packageB));

        $this->assertFalse($shipment->hasPackage($packageA));
        $this->assertFalse($shipment->hasPackage($packageB));

        $packages = $property->getValue($shipment);

        $this->assertIsArray($packages);
        $this->assertCount(0, $packages);
    }

    /**
     * Tests that can remove multiple packages from a shipment.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::removePackages()
     */
    public function testCanRemovePackages()
    {
        $shipment = new Shipment();
        $packageA = (new Package())->setId(123);
        $packageB = (new Package())->setId(456);
        $property = TestHelpers::getInaccessibleProperty($shipment, 'packages');

        $this->assertInstanceOf(get_class($shipment), $shipment->removePackages([]));
        $this->assertInstanceOf(get_class($shipment), $shipment->removePackages([$packageA, $packageB]));

        $property->setValue($shipment, [$packageA->getId() => $packageA, $packageB->getId() => $packageB]);

        $this->assertInstanceOf(get_class($shipment), $shipment->removePackages([]));
        $this->assertTrue($shipment->hasPackage($packageA));
        $this->assertTrue($shipment->hasPackage($packageB));

        $this->assertInstanceOf(get_class($shipment), $shipment->removePackages([$packageA, $packageB]));

        $this->assertFalse($shipment->hasPackage($packageA));
        $this->assertFalse($shipment->hasPackage($packageB));

        $packages = $property->getValue($shipment);

        $this->assertIsArray($packages);
        $this->assertCount(0, $packages);
    }

    /**
     * Tests that can determine if a shipment contains a given package.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::hasPackage()
     */
    public function testCanDetermineIfHasPackage()
    {
        $shipment = new Shipment();
        $package = (new Package())->setId(123);

        $this->assertFalse($shipment->hasPackage($package));

        $shipment->addPackage($package);

        $this->assertTrue($shipment->hasPackage($package));
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getPackageTrackingUrl()
     */
    public function testCanGetPackageTrackingUrl()
    {
        $providerTrackingUrl = 'https://providertrackr.com/track/123456789';

        $shipment = $this->getMockBuilder(Shipment::class)
                            ->onlyMethods(['getPackageTrackingUrlUsingProvider'])
                            ->getMock();

        $shipment->expects($this->once())
                    ->method('getPackageTrackingUrlUsingProvider')
                    ->willReturn($providerTrackingUrl);

        $packageWithCustomTrackingUrl = $this->getPackageImplementation(true);
        $packageWithoutCustomTrackingUrl = $this->getPackageImplementation(false);

        $this->assertNull($shipment->getPackageTrackingUrl($packageWithCustomTrackingUrl));
        $this->assertNull($shipment->getPackageTrackingUrl($packageWithoutCustomTrackingUrl));

        $shipment->addPackage($packageWithCustomTrackingUrl);
        $shipment->addPackage($packageWithoutCustomTrackingUrl);

        $this->assertEquals($packageWithCustomTrackingUrl->getTrackingUrl(), $shipment->getPackageTrackingUrl($packageWithCustomTrackingUrl));
        $this->assertEquals($providerTrackingUrl, $shipment->getPackageTrackingUrl($packageWithoutCustomTrackingUrl));
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getPackageTrackingUrlUsingProvider()
     *
     * @throws ReflectionException
     */
    public function testCanGetPackageTrackingUrlUsingProvider()
    {
        $shipping = Shipping::getInstance();
        TestHelpers::setInaccessibleProperty($shipping, Shipping::class, 'providers', ['test' => $this->getProviderImplementation()]);

        $shipment = new Shipment();
        $shipment->setProviderName('other');

        $package = $this->getPackageImplementation();

        $method = TestHelpers::getInaccessibleMethod(Shipment::class, 'getPackageTrackingUrlUsingProvider');
        $this->assertNull($method->invoke($shipment, $package));

        $shipment->setProviderName('test');

        $this->assertEquals('123456789', $method->invoke($shipment, $package));
    }

    /**
     * Tests that can get packages that can fulfill items.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getPackagesThatCanFulfillItems()
     */
    public function testCanGetPackagesThatCanFulfillItems()
    {
        $shipment = new Shipment();

        $packageThatCanId = 22;

        /** @var MockObject|Package $packageThatCan */
        $packageThatCan = $this->getMockBuilder(Package::class)
                               ->onlyMethods(['canFulfillItems'])
                               ->getMock();

        $packageThatCan->setId($packageThatCanId);

        $packageThatCan->expects($this->once())
                       ->method('canFulfillItems')
                       ->willReturn(true);

        /** @var MockObject|Package $packageThatCannot */
        $packageThatCannot = $this->getMockBuilder(Package::class)
                                  ->onlyMethods(['canFulfillItems'])
                                  ->getMock();

        $packageThatCannot->setId(23);

        $packageThatCannot->expects($this->once())
                          ->method('canFulfillItems')
                          ->willReturn(false);

        $shipment->addPackage($packageThatCan);
        $shipment->addPackage($packageThatCannot);

        $this->assertEquals([$packageThatCanId => $packageThatCan], $shipment->getPackagesThatCanFulfillItems());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Models\Shipment::getProvider()
     *
     * @throws ReflectionException
     */
    public function testCanGetProvider()
    {
        $this->mockWordPressTransients();

        $shipping = Shipping::getInstance();
        TestHelpers::setInaccessibleProperty($shipping, Shipping::class, 'providers', ['test' => $this->getProviderImplementation()]);

        $shipment = new Shipment();
        $shipment->setProviderName('test');

        $method = TestHelpers::getInaccessibleMethod(Shipment::class, 'getProvider');

        $this->assertInstanceOf(get_class($this->getProviderImplementation()), $method->invoke($shipment));

        $shipment->setProviderName('alternative');

        $this->assertNull($method->invoke($shipment));
    }

    /**
     * Gets a ProviderContract mocked implementation.
     *
     * @return ProviderContract
     */
    private function getProviderImplementation() : ProviderContract
    {
        return new class() implements ProviderContract {
            use HasLabelTrait;

            private $description;

            public function getDescription() : string
            {
                return $this->description;
            }

            public function setDescription(string $value) : ProviderContract
            {
                $this->description = $value;

                return $this;
            }

            public function tracking()
            {
                return new class() {
                    public function getTrackingUrl(string $trackingNumber)
                    {
                        return $trackingNumber;
                    }
                };
            }
        };
    }

    /**
     * Gets a PackageContract mocked implementation.
     *
     * @param bool $hasCustomTrackingUrl whether or not this package has a custom tracking URL
     * @return PackageContract
     */
    private function getPackageImplementation(bool $hasCustomTrackingUrl = false) : PackageContract
    {
        return new class($hasCustomTrackingUrl ? 'https://packagetrackr.com/track/123456789' : '') implements PackageContract {
            public function __construct(string $trackingUrl = '')
            {
                $this->trackingUrl = $trackingUrl;
            }

            public function getId(): string
            {
                return '1';
            }

            public function setId(string $value): PackageContract
            {
                return $this;
            }

            public function getItems(): array
            {
                return [];
            }

            public function addItem(LineItem $item, float $quantity): PackageContract
            {
                return $this;
            }

            public function removeItem(LineItem $item, float $quantityToRemove): PackageContract
            {
                return $this;
            }

            public function getItemQuantity(LineItem $item): float
            {
                return 3;
            }

            public function hasItem(LineItem $item): bool
            {
                return true;
            }

            public function getStatus(): PackageStatusContract
            {
                return new LabelCreatedPackageStatus();
            }

            public function setStatus(PackageStatusContract $status): PackageContract
            {
                return $this;
            }

            public function canFulfillItems(): bool
            {
                return true;
            }

            public function getDimensions(): Dimensions
            {
                // TODO: Implement getDimensions() method.
            }

            public function setDimensions(Dimensions $dimensions)
            {
                // TODO: Implement setDimensions() method.
            }

            public function getWeight(): Weight
            {
                // TODO: Implement getWeight() method.
            }

            public function setWeight(Weight $weight)
            {
                // TODO: Implement setWeight() method.
            }

            public function getShippingRate()
            {
                // TODO: Implement getShippingRate() method.
            }

            public function setShippingRate(ShippingRate $shippingRate): PackageContract
            {
                return $this;
            }

            public function getShippingLabel()
            {
                // TODO: Implement getShippingLabel() method.
            }

            public function setShippingLabel(ShippingLabel $shippingLabel): PackageContract
            {
                return $this;
            }

            public function getTrackingNumber()
            {
                return '123456789';
            }

            public function setTrackingNumber(string $value): PackageContract
            {
                // TODO: Implement setTrackingNumber() method.
            }

            public function getTrackingUrl()
            {
                return $this->trackingUrl;
            }

            public function setTrackingUrl(string $value): PackageContract
            {
                return $this;
            }
        };
    }
}
