<?php

namespace GoDaddy\WordPress\MWC\Shipping\Providers\USPS;

use GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider;
use GoDaddy\WordPress\MWC\Shipping\Providers\USPS\Gateways\USPSTrackingGateway;
use GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingTrackingTrait;

/**
 * USPS shipping provider.
 */
class USPSProvider extends AbstractProvider
{
    use HasShippingTrackingTrait;

    /** @var string the name for the shipping provider */
    protected $name = 'usps';

    /** @var string the label for the shipping provider */
    protected $label = 'USPS';

    /**
     * Constructor.
     *
     * @since 0.1.0
     */
    public function __construct()
    {
        $this->trackingGateway = USPSTrackingGateway::class;
    }
}
