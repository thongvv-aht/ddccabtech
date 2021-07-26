<?php

namespace GoDaddy\WordPress\MWC\Shipping\Providers\UPS;

use GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider;
use GoDaddy\WordPress\MWC\Shipping\Providers\UPS\Gateways\UPSTrackingGateway;
use GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingTrackingTrait;

/**
 * UPS shipping provider.
 */
class UPSProvider extends AbstractProvider
{
    use HasShippingTrackingTrait;

    /** @var string the name for the shipping provider */
    protected $name = 'ups';

    /** @var string the label for the shipping provider */
    protected $label = 'UPS';

    /**
     * Constructor.
     *
     * @since 0.1.0
     */
    public function __construct()
    {
        $this->trackingGateway = UPSTrackingGateway::class;
    }
}
