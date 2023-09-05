<?php

namespace swdevelopment\craftstripe\services;

use Craft;
use Stripe\StripeClient;
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

    

}
