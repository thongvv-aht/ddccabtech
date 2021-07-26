<?php

namespace GoDaddy\WordPress\MWC\Core\Events;

use GoDaddy\WordPress\MWC\Common\Events\Contracts\EventBridgeEventContract;
use GoDaddy\WordPress\MWC\Common\Extensions\Types\PluginExtension;
use GoDaddy\WordPress\MWC\Common\Traits\IsEventBridgeEventTrait;

/**
 * Abstract plugin event class.
 *
 * @since x.y.z
 */
abstract class AbstractPluginEvent implements EventBridgeEventContract
{
    use IsEventBridgeEventTrait;

    /** @var PluginExtension */
    protected $plugin;

    /**
     * AbstractPluginEvent constructor.
     *
     * @since x.y.z
     *
     * @param PluginExtension $plugin
     */
    public function __construct(PluginExtension $plugin)
    {
        $this->resource = 'plugin';
        $this->plugin = $plugin;
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
            'plugin' => [
                'slug' => $this->plugin->getSlug(),
            ],
        ];
    }
}
