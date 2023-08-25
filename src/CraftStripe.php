<?php

namespace swdevelopment\craftstripe;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use swdevelopment\craftstripe\models\Settings;
use swdevelopment\craftstripe\services\Coupons;
use swdevelopment\craftstripe\services\Customers;
use swdevelopment\craftstripe\services\Invoices;
use swdevelopment\craftstripe\services\Stripe;
use swdevelopment\craftstripe\services\Webhooks;

/**
 * craft-stripe plugin
 *
 * @method static CraftStripe getInstance()
 * @method Settings getSettings()
 * @property-read Stripe $stripe
 * @property-read Coupons $coupons
 * @property-read Customers $customers
 * @property-read Invoices $invoices
 * @property-read Webhooks $webhooks
 */
class CraftStripe extends Plugin
{
    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = true;

    public static function config(): array
    {
        return [
            'components' => ['stripe' => Stripe::class, 'coupons' => Coupons::class, 'customers' => Customers::class, 'invoices' => Invoices::class, 'webhooks' => Webhooks::class],
        ];
    }

    public function init(): void
    {
        parent::init();

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
            // ...
        });
    }

    protected function createSettingsModel(): ?Model
    {
        return Craft::createObject(Settings::class);
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('_craft-stripe/_settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/4.x/extend/events.html to get started)
    }
}
