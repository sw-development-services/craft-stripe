<?php

namespace swdevelopment\craftstripe\services;

use Craft;
use Stripe\StripeClient;
use yii\base\Component;

/**
 * Invoices service
 */
class Invoices extends Component
{

    public function getInvoices( StripeClient $stripe )
    {
        // connect to stripe api and get the customer list
        return $stripe->invoices->all();
    }

}
