<?php

namespace GoDaddy\WordPress\MWC\Core\Events;

/**
 * Feature enabled event class.
 *
 * @since x.y.z
 */
class FeatureEnabledEvent extends AbstractFeatureEvent
{
    /**
     * FeatureEnabledEvent constructor.
     *
     * @since x.y.z
     *
     * @param string $featureId
     */
    public function __construct(string $featureId)
    {
        parent::__construct($featureId);

        $this->action = 'enable';
    }
}
