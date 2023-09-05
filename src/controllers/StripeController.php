<?php

namespace swdevelopment\craftstripe\controllers;

use Craft;
use craft\web\Controller;
use craft\web\View;
use yii\web\Response;

/**
 * Stripe Controller controller
 */
class StripeController extends Controller
{
    public $defaultAction = 'index';
    protected array|int|bool $allowAnonymous = self::ALLOW_ANONYMOUS_NEVER;
    

    /**
     * craft-stripe/stripe-controller action
     */
    public function actionIndex(): Response
    {
        // return the view - frontend/index.twig

        $customers = ['jim', 'ben', 'tom'];

        return $this->renderTemplate(
            'craft-stripe/frontend/index',
            ['customers' => $customers],
            View::TEMPLATE_MODE_CP,
        );
        
    }

    public function actionExample(): Response{
        return $this->asJson([
            'foo' => true,
        ]);     
    }

    public function actionRender(): Response
    {
        $variables = [
            'variables_a' => 'template 1'
        ];

        // return template
        return $this->renderTemplate(
            '_craft-stripe/foo',
            $variables,
            View::TEMPLATE_MODE_CP,
        );
    }


}
