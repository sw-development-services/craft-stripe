<?php

namespace swdevelopment\craftstripe\controllers;

use Craft;
use craft\web\Controller;
use craft\web\View;
use Stripe\StripeClient;
use swdevelopment\craftstripe\CraftStripe;
use yii\web\Response;

/**
 * Invoice controller
 */
class InvoiceController extends Controller
{
    public $defaultAction = 'index';
    protected array|int|bool $allowAnonymous = self::ALLOW_ANONYMOUS_NEVER;

    /**
     * _craft-stripe/invoice action
     */
    public function actionIndex(): Response
    {

        // send to service to get customers from Stripe
        $stripe = new StripeClient( CraftStripe::getInstance()->stripe->getAPIKey() );

        // getInvoices

        $invoices = [
            'invoices' => CraftStripe::getInstance()->invoices->getInvoices($stripe)->toArray() 
        ];
        // call invoice service to show all the invoices
        return $this->renderTemplate(
            'craft-stripe/frontend/invoices',
            ['invoices' => $invoices],
            View::TEMPLATE_MODE_CP,
        );
    }
}
