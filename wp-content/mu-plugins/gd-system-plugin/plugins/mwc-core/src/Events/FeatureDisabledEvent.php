<?php

namespace GoDaddy\WordPress\MWC\Core\Events;

/**
 * Feature disabled event class.
 *
 * @since x.y.z
 */
class FeatureDisabledEvent extends AbstractFeatureEvent
{
    /**
     * FeatureDisabledEvent constructor.
     *
     * @since x.y.z
     *
     * @param string $featureId
     */
    public function __construct(string $featureId)
    {
        parent::__construct($featureId);

        $this->action = 'disable';
    }
}
