<?php

namespace GoDaddy\WordPress\MWC\Common\Models;

use GoDaddy\WordPress\MWC\Common\Traits\HasUnitOfMeasurementTrait;

/**
 * An object representation of a weight amount.
 *
 * @since x.y.z
 */
class Weight
{
    use HasUnitOfMeasurementTrait;

    /** @var float the weight amount */
    private $value;

    /**
     * Gets the weight amount.
     *
     * @since x.y.z
     *
     * @return float
     */
    public function getValue() : float
    {
        return is_float($this->value) ? $this->value : 0;
    }

    /**
     * Sets the weight amount.
     *
     * @since x.y.z
     *
     * @param float $value
     * @return self
     */
    public function setValue(float $value) : Weight
    {
        $this->value = $value;

        return $this;
    }
}
