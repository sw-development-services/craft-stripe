<?php

namespace swdevelopment\craftstripe\controllers;

use Craft;
use craft\web\Controller;
use yii\web\Response;

/**
 * Stripe Controller controller
 */
class StripeController extends Controller
{
    public $defaultAction = 'index';
    protected array|int|bool $allowAnonymous = self::ALLOW_ANONYMOUS_NEVER;

    /**
     * _craft-stripe/stripe-controller action
     */
    public function actionIndex(): Response
    {
        // ...
    }
}
