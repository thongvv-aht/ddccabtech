<?php

namespace GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses;

use GoDaddy\WordPress\MWC\Common\Contracts\OrderStatusContract;
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;

/**
 * Class CancelledOrderStatus
 */
final class CancelledOrderStatus implements OrderStatusContract
{
    use HasLabelTrait;

    public function __construct()
    {
        $this->setName('cancelled')
            ->setLabel('Cancelled');
    }
}
