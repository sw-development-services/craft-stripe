<?php

namespace swdevelopment\craftstripe\services;

use Craft;
use Stripe\StripeClient;
use swdevelopment\craftstripe\CraftStripe;
use yii\base\Component;

/**
 * Webhooks service
 */
class Webhooks extends Component
{
    // setup webhooks for retreiving various data and use to trigger an event
    
    // webhook after invoice is created
    public function getWebhookEvent(){
        $payload = @file_get_contents('php://input');
        $event = null;

        try{
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        }catch(\UnexpectedValueException $e){
            http_response_code(400);
            exit();
        }

        switch($event->type){
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                // handle succeed action

                break;

            case 'payment_method.attached':
                $paymentMethod = $event->data->object;
                // do something with this
                break;
            case 'customer.created':
                $data = $event->data->object;
                // do something else
                
                break;

        }

        http_response_code(200);

    }

    public function getAllWebhooks( StripeClient $stripe ){
        return $stripe->webhookEndpoints->all();
    }


}
