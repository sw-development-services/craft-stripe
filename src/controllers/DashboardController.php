<?php

namespace swdevelopment\craftstripe\controllers;

use Craft;
use craft\web\Controller;
use craft\web\View;
use yii\web\Response;

/**
 * Dashboard controller
 */
class DashboardController extends Controller
{
    public $defaultAction = 'index';
    protected array|int|bool $allowAnonymous = self::ALLOW_ANONYMOUS_NEVER;

    /**
     * craft-stripe/dashboard action
     */
    public function actionIndex(): Response
    {
        /** 
         * grab new customers over the past month 
         * 
         * 
        */

        $customers = ['jim', 'ben', 'tom'];

        return $this->renderTemplate(
            'craft-stripe/admin/dashboard',
            $customers,
            View::TEMPLATE_MODE_CP,
        );
    }
}
