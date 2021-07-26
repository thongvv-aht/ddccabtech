<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\GoDaddyPayments\Frontend;

use Exception;
use GoDaddy\WordPress\MWC\Common\Configuration\Configuration;
use GoDaddy\WordPress\MWC\Common\Enqueue\Enqueue;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Common\Repositories\ManagedWooCommerceRepository;
use GoDaddy\WordPress\MWC\Common\Repositories\WordPressRepository;
use GoDaddy\WordPress\MWC\Core\Payments\Poynt;
use WC_Customer;
use WC_Order;

class PaymentForm extends \GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\Frontend\PaymentForm
{
    /**
     * Registers the hooks.
     *
     * @since x.y.z
     *
     * @throws Exception
     */
    protected function registerHooks()
    {
        parent::registerHooks();

        Register::action()
            ->setGroup('wp_enqueue_scripts')
            ->setHandler([$this, 'enqueueScripts'])
            ->execute();
    }

    /**
     * Enqueues the scripts.
     *
     * @since x.y.z
     *
     * @throws Exception
     */
    public function enqueueScripts()
    {
        $sdkUrl = ManagedWooCommerceRepository::isProductionEnvironment() ? Configuration::get('payments.poynt.api.productionSdkUrl') : Configuration::get('payments.poynt.api.stagingSdkUrl');

        Enqueue::script()
            ->setHandle('poynt-collect-sdk')
            ->setSource($sdkUrl)
            ->execute();

        Enqueue::script()
            ->setHandle('mwc-payments-poynt-payment-form')
            ->setSource(WordPressRepository::getAssetsUrl('js/payments/frontend/poynt.js'))
            ->setDependencies(['jquery', 'poynt-collect-sdk'])
            ->attachInlineScriptObject('poyntPaymentFormI18n')
            ->attachInlineScriptVariables([
                'defaultErrorMessage' => __('An error occurred, please try again or try an alternate form of payment.', 'mwc-core')
            ])
            ->execute();

        wc_enqueue_js(sprintf(
            'window.mwc_payments_poynt_payment_form_handler = new MWCPaymentsPoyntPaymentFormHandler(%s);',
            ArrayHelper::jsonEncode([
                'appId' => Poynt::getAppId(),
                'businessId' => Poynt::getBusinessId(),
                'customerAddress' => $this->getCustomerAddress(),
                'isLoggingEnabled' => Configuration::get('mwc.debug'),
            ])
        ));
    }

    /**
     * Renders the payment fields.
     *
     * @since x.y.z
     */
    protected function renderPaymentFields()
    {
        parent::renderPaymentFields();

        $nonceFieldId = 'mwc-payments-'.$this->providerName.'-payment-nonce'; ?>
        <div id="mwc-payments-poynt-hosted-form"></div>
        <input type="hidden" id="<?php echo esc_attr($nonceFieldId); ?>" name="<?php echo esc_attr($nonceFieldId); ?>">
        <?php
    }

    /**
     * Gets the current customer's address.
     *
     * @since x.y.z
     *
     * @return array
     */
    private function getCustomerAddress() : array
    {
        global $wp;

        $address = [
            'firstName' => '',
            'lastName'  => '',
            'line1'     => '',
            'postcode'  => '',
        ];

        // if on the checkout pay page use the order's address details
        if (is_checkout_pay_page()) {
            $order = wc_get_order((int) $wp->query_vars['order-pay'] ?? 0);

            if ($order instanceof WC_Order) {
                $address['firstName'] = $order->get_billing_first_name();
                $address['lastName'] = $order->get_billing_last_name();
                $address['line1'] = $order->get_billing_address_1();
                $address['postcode'] = $order->get_billing_postcode();
            }

            return $address;
        }

        // get the current customer's address details if available
        if (WC()->customer instanceof WC_Customer) {
            $address['firstName'] = WC()->customer->get_billing_first_name();
            $address['lastName'] = WC()->customer->get_billing_last_name();
            $address['line1'] = WC()->customer->get_billing_address_1();
            $address['postcode'] = WC()->customer->get_billing_postcode();
        }

        return $address;
    }
}
