<?php

namespace GoDaddy\WordPress\MWC\Common\Providers\Contracts;

use GoDaddy\WordPress\MWC\Common\Contracts\HasLabelContract;

/**
 * The provider contract.
 *
 * @since x.y.z
 */
interface ProviderContract extends HasLabelContract
{
    /**
     * Gets the provider description.
     *
     * @return string
     */
    public function getDescription() : string;

    /**
     * Sets the provider description.
     *
     * @param string $value
     * @return self
     */
    public function setDescription(string $value);
}
