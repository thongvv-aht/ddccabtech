<?php

namespace GoDaddy\WordPress\MWC\Core\Events;

use Exception;
use GoDaddy\WordPress\MWC\Common\Configuration\Configuration;
use GoDaddy\WordPress\MWC\Common\Events\Contracts\ProducerContract;
use GoDaddy\WordPress\MWC\Common\Repositories\ManagedWooCommerceRepository;
use GoDaddy\WordPress\MWC\Common\Traits\Features\IsConditionalFeatureTrait;

/**
 * Producers.
 *
 * @since x.y.z
 */
class Producers
{
    use IsConditionalFeatureTrait;

    /**
     * Class constructor.
     *
     * @since x.y.z
     *
     * @throws Exception
     */
    public function __construct()
    {
        foreach (Configuration::get('events.producers', []) as $className) {
            if (is_a($className, ProducerContract::class, true)) {
                (new $className())->setup();
            }
        }
    }

    /**
     * Determines whether the feature should be loaded.
     *
     * @since x.y.z
     *
     * @return bool
     * @throws Exception
     */
    public static function shouldLoadConditionalFeature() : bool
    {
        // TODO: we'll add a WooCommerceRepository::isWooCommerceActive() check to this when no longer checking for WC at the system plugin level {@wvega 2021-07-03}
        return ManagedWooCommerceRepository::hasEcommercePlan();
    }
}
