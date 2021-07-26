<?php

namespace GoDaddy\WordPress\MWC\Shipping\Providers\FedEx;

use GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider;
use GoDaddy\WordPress\MWC\Shipping\Providers\FedEx\Gateways\FedExTrackingGateway;
use GoDaddy\WordPress\MWC\Shipping\Traits\HasShippingTrackingTrait;

/**
 * FedEx shipping provider.
 */
class FedExProvider extends AbstractProvider
{
    use HasShippingTrackingTrait;

    /** @var string the name for the shipping provider */
    protected $name = 'fedex';

    /** @var string the label for the shipping provider */
    protected $label = 'FedEx';

    /**
     * Constructor.
     *
     * @since 0.1.0
     */
    public function __construct()
    {
        $this->trackingGateway = FedExTrackingGateway::class;
    }
}
