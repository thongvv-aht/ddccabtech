<?php

namespace GoDaddy\WordPress\MWC\Shipping\Providers\AustraliaPost;

use GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider;
use GoDaddy\WordPress\MWC\Shipping\Providers\AustraliaPost\Gateways\AustraliaPostTrackingGateway;
use GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingTrackingTrait;

/**
 * Australia Post shipping provider.
 */
class AustraliaPostProvider extends AbstractProvider
{
    use HasShippingTrackingTrait;

    /** @var string the name for the shipping provider */
    protected $name = 'australia-post';

    /** @var string the label for the shipping provider */
    protected $label = 'Australia Post';

    /**
     * Constructor.
     *
     * @since 0.1.0
     */
    public function __construct()
    {
        $this->trackingGateway = AustraliaPostTrackingGateway::class;
    }
}
