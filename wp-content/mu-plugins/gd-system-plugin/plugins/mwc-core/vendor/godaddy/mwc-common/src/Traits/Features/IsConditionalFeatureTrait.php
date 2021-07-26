<?php

namespace GoDaddy\WordPress\MWC\Common\Traits\Features;

/**
 * A trait to help loading features conditionally.
 *
 * @since x.y.z
 */
trait IsConditionalFeatureTrait
{
    /**
     * Determines whether a feature should be loaded.
     *
     * @since x.y.z
     *
     * @return bool returns true by default, implementations using this trait may override this
     */
    public static function shouldLoadConditionalFeature() : bool
    {
        return true;
    }
}
