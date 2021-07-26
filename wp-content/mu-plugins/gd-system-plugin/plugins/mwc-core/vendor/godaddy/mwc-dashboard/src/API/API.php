<?php

namespace GoDaddy\WordPress\MWC\Dashboard\API;

use Exception;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Common\Repositories\ManagedWooCommerceRepository;
use GoDaddy\WordPress\MWC\Common\Traits\Features\IsConditionalFeatureTrait;
use GoDaddy\WordPress\MWC\Dashboard\API\Controllers\AccountController;
use GoDaddy\WordPress\MWC\Dashboard\API\Controllers\ExtensionsController;
use GoDaddy\WordPress\MWC\Dashboard\API\Controllers\MessagesController;
use GoDaddy\WordPress\MWC\Dashboard\API\Controllers\Orders\ItemsController;
use GoDaddy\WordPress\MWC\Dashboard\API\Controllers\Orders\OrdersController;
use GoDaddy\WordPress\MWC\Dashboard\API\Controllers\Orders\ShipmentsController;
use GoDaddy\WordPress\MWC\Dashboard\API\Controllers\PluginsController;
use GoDaddy\WordPress\MWC\Dashboard\API\Controllers\Shipping\ProvidersController;
use GoDaddy\WordPress\MWC\Dashboard\API\Controllers\ShopController;
use GoDaddy\WordPress\MWC\Dashboard\API\Controllers\SupportController;
use GoDaddy\WordPress\MWC\Dashboard\API\Controllers\UserController;

class API
{
    use IsConditionalFeatureTrait;

    /**
     * All available API controllers.
     *
     * @var array
     */
    protected $controllers;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->setControllers();

        Register::action()
            ->setGroup('rest_api_init')
            ->setHandler([$this, 'registerRoutes'])
            ->execute();
    }

    /**
     * Registers all available API controllers.
     */
    protected function setControllers()
    {
        $this->controllers = [
            new AccountController(),
            new ExtensionsController(),
            new ItemsController(),
            new MessagesController(),
            new OrdersController(),
            new PluginsController(),
            new ProvidersController(),
            new ShipmentsController(),
            new ShopController(),
            new SupportController(),
            new UserController(),
        ];
    }

    /**
     * Registers the routes for all available API controllers.
     */
    public function registerRoutes()
    {
        foreach ($this->controllers as $controller) {
            $controller->registerRoutes();
        }
    }

    /**
     * Determines whether the feature can be loaded.
     *
     * @since x.y.z
     *
     * @return bool
     * @throws Exception
     */
    public static function shouldLoadConditionalFeature(): bool
    {
        return ManagedWooCommerceRepository::hasEcommercePlan();
    }
}
