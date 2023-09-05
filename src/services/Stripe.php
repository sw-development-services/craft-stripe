<?php

namespace swdevelopment\craftstripe\services;

use Craft;
use \Stripe\StripeClient;
use swdevelopment\craftstripe\CraftStripe;
use yii\base\Component;

/**
 * Stripe service
 */
class Stripe extends Component
{

    public $baseStripeUrl = 'https://api.stripe.com';
    

    public function connect()
    {
        $stripe = new StripeClient( $this->getAPIKey() );
    }

    public static function getAPIKey()
    {
        if ( strpos( CraftStripe::getInstance()->getSettings()->secretKey, '$' ) !== false ) {
            return getenv( substr( CraftStripe::getInstance()->getSettings()->secretKey, 1 ) );
        }
        return CraftStripe::getInstance()->getSettings()->secretKey;
    }
}
