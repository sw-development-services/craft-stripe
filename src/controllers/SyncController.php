<?php

namespace swdevelopment\craftstripe\controllers;

use Craft;
use craft\web\Controller;
use Stripe\StripeClient;
use swdevelopment\craftstripe\CraftStripe;
use yii\web\Response;

/**
 * Sync controller
 */
class SyncController extends Controller
{
    public $defaultAction = 'sync';
    protected array|int|bool $allowAnonymous = self::ALLOW_ANONYMOUS_NEVER;

    public function actionSyncCustomers(){

        $stripe = new StripeClient( CraftStripe::getInstance()->stripe->getAPIKey() );

        $remoteCustomers = [
            'customers' => CraftStripe::getInstance()->customers->getCustomerList($stripe)->toArray() 
        ];

        // add other services


        return print_r($remoteCustomers);



    }

    public function actionSyncInvoices(){

    }

    public function actionSyncPayments(){

    }

    public function actionSyncProducts(){

    }

    public function actionSync(): Response 
    {
        
        // check which customers we have in the local database,
        // check the customers that are in remote
        // merge the ones that need to be synced
        // add merged to the local db

        // first get the remote data

        return $this->asSuccess("this will sync the data in Stripe to the Craft database");
    }
}

