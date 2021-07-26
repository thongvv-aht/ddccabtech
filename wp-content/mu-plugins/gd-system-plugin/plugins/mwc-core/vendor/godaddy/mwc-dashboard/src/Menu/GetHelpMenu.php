<?php

namespace GoDaddy\WordPress\MWC\Dashboard\Menu;

use Exception;
use GoDaddy\WordPress\MWC\Common\Configuration\Configuration;
use GoDaddy\WordPress\MWC\Common\Enqueue\Enqueue;
use GoDaddy\WordPress\MWC\Common\Content\AbstractAdminPage;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Common\Repositories\ManagedWooCommerceRepository;
use GoDaddy\WordPress\MWC\Common\Traits\Features\IsConditionalFeatureTrait;
use GoDaddy\WordPress\MWC\Dashboard\Pages\GetHelpPage;

/**
 * Class GetHelpMenu handler.
 *
 * @since 1.0.0
 */
class GetHelpMenu
{
    use IsConditionalFeatureTrait;

    /**
     * The minimum capability to load the menu items.
     *
     * @since 1.0.0
     *
     * @var string
     */
    const CAPABILITY = 'manage_options';

    /**
     * The slug for the top-level menu item.
     *
     * @since 1.0.0
     *
     * @var string
     */
    const MENU_SLUG = 'mwc-get-help';

    /**
     * The page to associate with the menu item.
     *
     * @since 1.0.0
     *
     * @var AbstractAdminPage
     */
    protected $page;

    /**
     * The app handle prefix for enqueing assets.
     *
     * @var string
     */
    protected $appHandle;

    /**
     * GetHelpMenu constructor.
     *
     * @since 1.0.0
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->addAdminActions();

        $this->page = (new GetHelpPage());
        $this->appHandle = 'mwcDashboardClient';
    }

    /**
     * Add WordPress actions to add menu item as well enqueue it's assets.
     *
     * @since 1.0.0
     *
     * @throws Exception
     */
    protected function addAdminActions()
    {
        // add main menu item
        Register::action()
            ->setGroup('admin_menu')
            ->setHandler([$this, 'addMenuItem'])
            ->execute();

        // enqueue the style assets
        Register::action()
            ->setGroup('admin_enqueue_scripts')
            ->setHandler([$this, 'enqueueAdminStyles'])
            ->execute();
    }

    /**
     * Enqueues menu style assets.
     *
     * @since 1.0.0
     *
     * @throws Exception
     */
    public function enqueueAdminStyles()
    {
        Enqueue::style()
            ->setHandle("{$this->appHandle}-admin")
            ->setSource(Configuration::get('mwc_dashboard.assets.css.admin.url'))
            ->execute();
    }

    /**
     * Adds parent menu item.
     *
     * @since 1.0.0
     */
    public function addMenuItem()
    {
        $pageTitle = __('Get Help', 'mwc-dashboard');
        $pageIcon = 'dashicons-sos';
        $iconFilePath = null;

        try {
            $iconFilePath = Configuration::get('mwc_dashboard.assets.images.go_icon.url');
        } catch (Exception $ex) {
            // ignore the icon and use the default SOS icon
        }

        if ($iconFilePath && is_readable($iconFilePath) && ! ManagedWooCommerceRepository::isReseller()) {
            $pageIcon = 'data:image/svg+xml;base64,'.base64_encode(file_get_contents($iconFilePath));
        }

        add_menu_page(
            $pageTitle,
            $pageTitle.'<div id="mwc-dashboard-main-menu-item"></div>',
            self::CAPABILITY,
            self::MENU_SLUG,
            '__return_empty_string', // TODO: update later to point to the actual page render method. NM {2020-12-29}
            $pageIcon,
            1
        );
    }

    /**
     * Determines whether the feature should be loaded.
     *
     * @since x.y.z
     *
     * @return bool
     * @throws Exception
     */
    public static function shouldLoadConditionalFeature(): bool
    {
        // should not display if Dashboard is disabled through configuration
        if (! Configuration::get('features.mwc_dashboard')) {
            return false;
        }

        // should not display for non-MWC sites
        if (! ManagedWooCommerceRepository::hasEcommercePlan()) {
            return false;
        }

        // display the dashboard for end-customers (non-resellers) or resellers with a support agreement
        return ! ManagedWooCommerceRepository::isReseller() ||
            ManagedWooCommerceRepository::isResellerWithSupportAgreement();
    }
}
