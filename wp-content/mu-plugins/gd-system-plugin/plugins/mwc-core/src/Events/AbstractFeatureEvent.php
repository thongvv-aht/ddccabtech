<?php

namespace GoDaddy\WordPress\MWC\Core\Events;

use GoDaddy\WordPress\MWC\Common\Events\Contracts\EventBridgeEventContract;
use GoDaddy\WordPress\MWC\Common\Traits\IsEventBridgeEventTrait;

/**
 * Abstract feature event class.
 *
 * @since x.y.z
 */
abstract class AbstractFeatureEvent implements EventBridgeEventContract
{
    use IsEventBridgeEventTrait;

    /** @var string $featureId */
    protected $featureId;

    /**
     * AbstractFeatureEvent constructor.
     *
     * @since x.y.z
     *
     * @param string $featureId
     */
    public function __construct(string $featureId)
    {
        $this->featureId = $featureId;
        $this->resource = 'feature';
    }

    /**
     * Gets the data for the current event.
     *
     * @since x.y.z
     *
     * @return array
     */
    public function getData() : array
    {
        return [
            'feature' => [
                'id' => $this->featureId,
            ],
        ];
    }
}
