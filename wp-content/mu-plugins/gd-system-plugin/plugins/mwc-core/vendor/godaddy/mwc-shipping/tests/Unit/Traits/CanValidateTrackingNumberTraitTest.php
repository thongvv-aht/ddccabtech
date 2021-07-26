<?php

namespace GoDaddy\WordPress\MWC\Shipping\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Shipping\Contracts\TrackingNumberValidatorContract;
use GoDaddy\WordPress\MWC\Shipping\Traits\CanValidateTrackingNumberTrait;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use stdClass;

/**
 * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\CanValidateTrackingNumberTrait
 */
class CanValidateTrackingNumberTraitTest extends TestCase
{
    /**
     * Tests that can get the tracking number validator instance.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\CanValidateTrackingNumberTrait::getTrackingNumberValidator()
     * @dataProvider providerTrackingNumberValidator
     *
     * @param object|null $validatorObject
     * @param object|null $expectedResult
     * @throws ReflectionException
     */
    public function testCanGetValidatorInstance($validatorObject, $expectedResult)
    {
        $instance = $this->getMockTraitInstance();
        $property = TestHelpers::getInaccessibleProperty($instance, 'trackingNumberValidator');
        $method = TestHelpers::getInaccessibleMethod($instance, 'getTrackingNumberValidator');

        $property->setValue($instance, is_object($validatorObject) ? get_class($validatorObject) : $validatorObject);
        $this->assertEquals($expectedResult, $method->invoke($instance));
    }

    /** @see testCanInstantiateValidator */
    public function providerTrackingNumberValidator() : array
    {
        $validator = $this->getMockTrackingNumberValidator();

        return [
            'Default property value (null)'                           => [null, null],
            'Object not implementing TrackingNumberValidatorContract' => [new stdClass(), null],
            'Object implementing TrackingNumberValidatorContract'     => [$validator, $validator],
        ];
    }

    /**
     * Tests that can determine if a tracking number is valid.
     *
     * @covers \GoDaddy\WordPress\MWC\Shipping\Traits\CanValidateTrackingNumberTrait::isValidTrackingNumber()
     *
     * @throws ReflectionException
     */
    public function testCanValidateTrackingNumber()
    {
        $instance = $this->getMockTraitInstance();
        $property = TestHelpers::getInaccessibleProperty($instance, 'trackingNumberValidator');

        $this->assertFalse($instance->isValidTrackingNumber('isValid'));

        $shouldReturnFalse = $this->getMockTrackingNumberValidator();
        $property->setValue($instance, get_class($shouldReturnFalse));

        $this->assertFalse($instance->isValidTrackingNumber('isNotValid'));

        $shouldReturnTrue = $this->getMockTrackingNumberValidator();
        $property->setValue($instance, get_class($shouldReturnTrue));

        $this->assertTrue($instance->isValidTrackingNumber('isValid'));
    }

    /**
     * Gets an instance of a class implementing the trait.
     *
     * @return CanValidateTrackingNumberTrait|object
     */
    private function getMockTraitInstance()
    {
        return new class()
        {
            use CanValidateTrackingNumberTrait;
        };
    }

    /**
     * Gets an instance of a class implementing a tracking number validator.
     *
     * @return TrackingNumberValidatorContract
     */
    private function getMockTrackingNumberValidator() : TrackingNumberValidatorContract
    {
        return new class() implements TrackingNumberValidatorContract
        {
            public function isValidTrackingNumber(string $trackingNumber) : bool
            {
                switch ($trackingNumber) {
                    case 'isValid' :
                        return true;
                    default :
                    case 'isNotValid' :
                        return false;
                }
            }
        };
    }
}
