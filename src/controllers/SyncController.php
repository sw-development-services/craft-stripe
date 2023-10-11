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
    public $syncErrors = false;

    protected array|int|bool $allowAnonymous = self::ALLOW_ANONYMOUS_NEVER;

    public function actionSyncCustomers(){

        $recordsAdded = 0;
        // $syncError = false;
        $stripe = new StripeClient( CraftStripe::getInstance()->stripe->getAPIKey() );
        $remoteCustomers = [
            'customers' => CraftStripe::getInstance()->customers->getCustomerList( $stripe )->toArray() 
        ];

        if( !empty($remoteCustomers['customers']['data']) ){
            foreach( $remoteCustomers['customers']['data'] as $customer ){
                // check if the remote customer exists in craft, if it doesn't add to craft
                $customerExists = CraftStripe::getInstance()->customers->getCustomerByID( $customer['id'] );
                if( ! $customerExists ){
                    if( CraftStripe::getInstance()->customers->save( $customer ) > 0 ){
                        $recordsAdded++;
                    };
                }
            }
        }
        // return a status
    }

    public function actionSyncInvoices(){
        $stripe = new StripeClient( CraftStripe::getInstance()->stripe->getAPIKey() );
        $remoteInvoices = [
            'invoices' => CraftStripe::getInstance()->invoices->getInvoices($stripe)->toArray()
        ];

        dd($remoteInvoices);


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
        $this->requirePostRequest();
        // check if user is logged in
        if( !$this->requireAdmin() ){
            // throw message
        }
        
        // get json data - payload
        $payload = Craft::$app->request->getBodyParams();

        $selectedSyncTypes = $payload['syncTypes'];

        // check what the user wants to sync
        foreach( $selectedSyncTypes as $syncType ){
            // print_r($syncType);
            switch( $syncType ){
                case "customers":
                    $this->actionSyncCustomers();
                    break;
                case "products":
                    $this->actionSyncProducts();
                    break;
                case "invoices":
                    $this->actionSyncInvoices();
                    break;
            }
        }



        return $this->asSuccess("this will sync the data in Stripe to the Craft database");
    }
}

