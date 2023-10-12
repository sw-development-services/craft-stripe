<?php

namespace swdevelopment\craftstripe\controllers;

use Craft;
use craft\web\Controller;
use craft\web\View;
use swdevelopment\craftstripe\CraftStripe;
use yii\web\Response;

use Stripe\StripeClient;

/**
 * Webhook controller
 */
class WebhookController extends Controller
{
    public $defaultAction = 'index';
    protected array|int|bool $allowAnonymous = self::ALLOW_ANONYMOUS_NEVER;

    /**
     * craft-stripe/webhook action
     */
    public function actionIndex() : Response
    {
        // lets add some data
        $stripe = new StripeClient( CraftStripe::getInstance()->stripe->getAPIKey() );

        $remoteWebhooks =  CraftStripe::getInstance()->webhooks->getAllWebhooks( $stripe )->toArray();

        return $this->renderTemplate(
            'craft-stripe/admin/webhooks/_index',
            [ 'webhooks' => $remoteWebhooks ],
            View::TEMPLATE_MODE_CP,
        );
    }
}
