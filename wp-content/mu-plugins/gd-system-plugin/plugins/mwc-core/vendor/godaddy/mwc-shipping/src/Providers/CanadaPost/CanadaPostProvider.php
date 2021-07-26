<?php

namespace GoDaddy\WordPress\MWC\Shipping\Providers\CanadaPost;

use GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider;
use GoDaddy\WordPress\MWC\Shipping\Providers\CanadaPost\Gateways\CanadaPostTrackingGateway;
use GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingTrackingTrait;

/**
 * Canada Post shipping provider.
 */
class CanadaPostProvider extends AbstractProvider
{
    use HasShippingTrackingTrait;

    /** @var string the name for the shipping provider */
    protected $name = 'canada-post';

    /** @var string the label for the shipping provider */
    protected $label = 'Canada Post';

    /**
     * Constructor.
     *
     * @since 0.1.0
     */
    public function __construct()
    {
        $this->trackingGateway = CanadaPostTrackingGateway::class;
    }
}
