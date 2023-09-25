<?php

namespace swdevelopment\craftstripe\utilities;

use Craft;
use craft\base\Utility;

/**
 * Sync Stripe Data utility
 */
class SyncStripeData extends Utility
{
    public static function displayName(): string
    {
        return Craft::t('craft-stripe', 'Sync Stripe Data');
    }

    static function id(): string
    {
        return 'sync-stripe-data';
    }

    public static function iconPath(): ?string
    {
        return Craft::getAlias('@craftstripe/icon.svg');
    }

    static function contentHtml(): string
    {
        $view = Craft::$app->getView();
        // print_r($view);
        return $view->renderTemplate('craft-stripe/_utilities/sync.twig');
    }

    public static function footerHtml(): string{
        return 'Brought to you by Tim Strawbridge and SW Development Services, LLC with Love emoji';
    }
}
