<?php

namespace swdevelopment\craftstripe;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use craft\events\RegisterUrlRulesEvent;
use craft\helpers\UrlHelper;
use craft\web\UrlManager;
use yii\base\Event;
use craft\web\twig\variables\Cp;
use craft\events\RegisterCpNavItemsEvent;

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
 * 
 * Stripe API - https://stripe.com/docs/api 
 */
class CraftStripe extends Plugin
{

    public static ?CraftStripe $plugin;
    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = true;

    // public bool $hasCpSection = true;
    public ?string $name = 'Craft Stripe';

    public string $handle = 'craft-stripe';

    public array $stripeErrors = [
        "200" => "Everything worked as expected"
    ];

    public static function config(): array
    {
        return [
            'components' => [
                'stripe' => Stripe::class, 
                'coupons' => Coupons::class, 
                'customers' => Customers::class, 
                'invoices' => Invoices::class, 
                'webhooks' => Webhooks::class
            ],
        ];
    }

    public function init(): void
    {
        parent::init();
        self::$plugin = $this;
        Craft::setAlias('@craftstripe', __DIR__);   

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
            
        });
    }

    protected function createSettingsModel(): ?Model
    {
        // return Craft::createObject(Settings::class);
        return new Settings();
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->getView()->renderTemplate("$this->handle/settings", [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    /* public function getSettingsResponse(): mixed{
        return Craft::$app->controller->redirect(UrlHelper::cpUrl("$this->handle/settings"));
    }*/

    /* public function getSettingsResponse(): mixed
    {
        return Craft::$app
            ->controller
            ->renderTemplate("$this->handle/settings/index");
    }
    */

    public function getSettings(): Settings
    {
        return parent::getSettings();
    }

    public function subnavs()
    {
        return [
            'dashboard' => ['label' => Craft::t($this->handle, 'Dashboard'), 'url' => "$this->handle/frontend/dashboard.twig"],
            'bar' => ['label' => 'Bar', 'url' => "$this->handle/bar"],
            'baz' => ['label' => 'Baz', 'url' => "$this->handle/baz"]
        ];
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/4.x/extend/events.html to get started)


        // Register control panel routes
        $this->registerControlPanelRoutes();

        $this->registerSiteUrls();

        $this->controlPanelSection();
        // $this->getCpNavItem();
    }

    /**
     * Summary of controlPanelSection
     * This will add a section on the Control Panel menu
     * @return void
     */
    private function controlPanelSection(){

        Event::on(
            Cp::class,
            Cp::EVENT_REGISTER_CP_NAV_ITEMS,
            function( RegisterCpNavItemsEvent $event ) {
                $event->navItems[] = [
                    'url' => $this->handle,
                    'label' => 'Craft Stripe',
                    'icon' => '@swdevelopment/craft-stripe/src/icon.svg',
                    'subnav' => $this->subnavs(),
                ];

            }
        );
    }


    private function registerSiteUrls()
    {
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['stripe/example'] = "$this->handle/stripe/example";
                $event->rules['stripe/render'] = "$this->handle/stripe/render";
                $event->rules['customer'] = "$this->handle/customer/index";
                // $event->rules['stripe/index'] = "$this->handle/stripe/get-customers";
                
                // $event->rules['craft-stripe'] = "$this->handle/customer/get-customers";
                //$event->rules['_craft-stripe'] = "$this->handle/settings";

            }
        );   
    }

    private function registerControlPanelRoutes()
    {
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                // $event->rules['craft-stripe/dashboard'] = "$this->handle/dashboard/index";
                $event->rules['craft-stripe'] = "$this->handle/stripe/index";
                $event->rules['craft-stripe/customers'] = "$this->handle/customer/get-customers";
                $event->rules['craft-stripe/invoices'] = "$this->handle/invoice/index";

                // $event->rules['_craft-stripe/settings/save'] = "$this->handle/settings/save";
                // $event->rules['_craft-stripe/settings/customers/save'] = "$this->handle/settings/customers/save";
            }
        );
    }

}
