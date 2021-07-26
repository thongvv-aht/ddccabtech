<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Shipping\Contracts\TrackingUrlBuilderContract;
use GoDaddy\WordPress\MWC\Shipping\Traits\CanBuildTrackingUrlTrait;
use ReflectionException;
use stdClass;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\CanBuildTrackingUrlTrait
 */
class CanBuildTrackingUrlTraitTest extends WPTestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\CanBuildTrackingUrlTrait::getTrackingUrlBuilder()
     * @dataProvider providerTrackingUrlBuilder
     *
     * @param object|null $builderObject
     * @param object|null $expectedResult
     * @throws ReflectionException
     */
    public function testCanGetBuilderInstance($builderObject, $expectedResult = null)
    {
        $instance = $this->getMockTraitInstance();
        $property = TestHelpers::getInaccessibleProperty($instance, 'trackingUrlBuilder');
        $method = TestHelpers::getInaccessibleMethod($instance, 'getTrackingUrlBuilder');

        $property->setValue($instance, is_object($builderObject) ? get_class($builderObject) : $builderObject);
        $this->assertEquals($expectedResult, $method->invoke($instance));
    }

    /** @see testCanGetBuilderInstance */
    public function providerTrackingUrlBuilder() : array
    {
        $builder = $this->getMockTrackingUrlBuilder();

        return [
            'Default property value (null)'                      => [null, null],
            'Object not implementing TrackingUrlBuilderContract' => [new stdClass(), null],
            'Object implementing TrackingUrlBuilderContract'     => [$builder, $builder],
        ];
    }

    /**
     * Tests that can get the tracking URL.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\CanBuildTrackingUrlTrait::getTrackingUrl()
     *
     * @throws ReflectionException
     */
    public function testCanGetTrackingUrl()
    {
        $instance = $this->getMockTraitInstance();
        $property = TestHelpers::getInaccessibleProperty($instance, 'trackingUrlBuilder');

        $this->assertNull($instance->getTrackingUrl('test'));

        $property->setValue($instance, get_class($this->getMockTrackingUrlBuilder()));

        $this->assertEquals('test', $instance->getTrackingUrl('test'));
    }

    /**
     * Tests that can get the tracking URL template.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\CanBuildTrackingUrlTrait::getTrackingUrlTemplate()
     *
     * @throws ReflectionException
     */
    public function testCanGetTrackingUrlTemplate()
    {
        $instance = $this->getMockTraitInstance();

        $property = TestHelpers::getInaccessibleProperty($instance, 'trackingUrlBuilder');
        $property->setValue($instance, get_class($this->getMockTrackingUrlBuilder()));

        $this->assertSame('TEST_URL?TEST_PARAMETER={tracking_number}', $instance->getTrackingUrlTemplate());
    }

    /**
     * Gets an instance that uses the build tracking URL trait.
     *
     * @return CanBuildTrackingUrlTrait|object
     */
    private function getMockTraitInstance()
    {
        return new class() {
            use CanBuildTrackingUrlTrait;
        };
    }

    /**
     * Gets an instance that implements the tracking URL builder contract.
     *
     * @return TrackingUrlBuilderContract|object
     */
    private function getMockTrackingUrlBuilder() : TrackingUrlBuilderContract
    {
        return new class implements TrackingUrlBuilderContract {
            public function getTrackingUrl(string $trackingNumber) : string
            {
                return $trackingNumber;
            }

            public function getTrackingUrlTemplate() : string
            {
                return 'TEST_URL?TEST_PARAMETER={tracking_number}';
            }
        };
    }
}
