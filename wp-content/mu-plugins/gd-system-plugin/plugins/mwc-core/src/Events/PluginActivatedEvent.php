<?php

namespace GoDaddy\WordPress\MWC\Core\Events;

/**
 * Plugin activated event class.
 *
 * @since x.y.z
 */
class PluginActivatedEvent extends AbstractPluginEvent
{
    /** @var string the name of the event action */
    protected $action = 'activate';
}
