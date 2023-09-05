<?php

namespace swdevelopment\craftstripe\controllers;

use Craft;
use craft\web\Controller;
use craft\web\Request;
use yii\web\Response;

/**
 * Settings controller
 */
class SettingsController extends Controller
{
    public $defaultAction = 'index';
    protected array|int|bool $allowAnonymous = self::ALLOW_ANONYMOUS_NEVER;

    /**
     * _craft-stripe/settings action
     */
    public function actionSave(): Response
    {

        // settings will be saved to the Settings model
        // check the request variables

        $this->requirePostRequest();
        
        // get json data - payload
        $payload = Craft::$app->request->getBodyParams();

        $secretKey = $payload->secretKey;

        // update the database
        


        return $this->asJson([
            'foo' => true,
            'request' => $payload
        ]);   
    }
}
