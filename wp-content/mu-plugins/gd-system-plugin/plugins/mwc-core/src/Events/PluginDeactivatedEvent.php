<?php

namespace GoDaddy\WordPress\MWC\Core\Events;

/**
 * Plugin deactivated event class.
 *
 * @since x.y.z
 */
class PluginDeactivatedEvent extends AbstractPluginEvent
{
    /** @var string the name of the event action */
    protected $action = 'deactivate';
}
