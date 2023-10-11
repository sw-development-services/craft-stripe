<?php

namespace swdevelopment\craftstripe\services;

use Carbon\Carbon;
use Craft;
use Stripe\StripeClient;
use swdevelopment\craftstripe\records\CustomerRecord;
use yii\base\Component;

// use swdevelopment\craftstripe\services\Stripe;

/**
 * Customers service
 */
class Customers extends Component
{
    public function getCustomerList( StripeClient $stripe )
    {
        // connect to stripe api and get the customer list
        return $stripe->customers->all();
    }

    public function getCustomerByID( $id ){
        // $record = new CustomerRecord();
        return CustomerRecord::find()->where(['customer_id' => $id])->one(); 
    }

    /**
     * saves customer to craft
     */
    public function save( $data ){
        $record = new CustomerRecord();
        $status = 0;

        $record->customer_id        = $data['id'];
        $record->address            = $data['address'];
        $record->balance            = $data['balance'];
        $record->created_at         = $data['created'];
        $record->currency           = 'usd';
        $record->default_source     = $data['default_source'];
        $record->delinquent         = $data['delinquent'];
        $record->description        = $data['description'];
        $record->discount           = $data['discount'];
        $record->email              = $data['email'];
        $record->invoice_prefix     = $data['invoice_prefix'];
        $record->name               = $data['name'];
        $record->phone              = $data['phone'];
        $record->tax_exempt         = $data['tax_exempt'];
        $record->dateCreated        = Carbon::now();
        $record->dateUpdated        = Carbon::now();
    
        $record->save();

        if(!$record->save()){
            return $record->getErrors();
        }

        return $record->id;
    }

    

}
