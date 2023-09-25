<?php

namespace swdevelopment\craftstripe\services;

use Craft;
use Stripe\StripeClient;
use yii\base\Component;

/**
 * Products service
 */
class Products extends Component
{
    // retrieve products from stripe
    public function getProducts( StripeClient $stripe ){
        return $stripe->products->all();
    }

}
