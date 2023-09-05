<?php

namespace swdevelopment\craftstripe\controllers;

use Craft;
use craft\web\Controller;
use craft\web\View;
use swdevelopment\craftstripe\CraftStripe;
use swdevelopment\craftstripe\services\Customers;
use swdevelopment\craftstripe\services\Stripe;
use \Stripe\StripeClient;

use yii\web\Response;



/**
 * Customer controller
 */
class CustomerController extends Controller
{
    public $defaultAction = 'index';
    protected array|int|bool $allowAnonymous = self::ALLOW_ANONYMOUS_NEVER;

    /**
     * _craft-stripe/customer action
     */
    /* public function actionIndex(): Response
    {
        // ...
    }*/

    /**
     * Summary of actionGetCustomers
     * @return \yii\web\Response
     */
    public function actionGetCustomers(): Response{

        // send to service to get customers from Stripe
        $stripe = new StripeClient( CraftStripe::getInstance()->stripe->getAPIKey() );

        // call service 
        $customers = [
            'customers' => CraftStripe::getInstance()->customers->getCustomerList($stripe)->toArray() 
        ];
        
        // return template
        return $this->renderTemplate(
            'craft-stripe/frontend/customers',
            $customers,
            View::TEMPLATE_MODE_CP,
        );
    
    }
}
