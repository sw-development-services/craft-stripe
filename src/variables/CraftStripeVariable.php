<?php

namespace swdevelopment\craftstripe\variables;

use Craft;
use swdevelopment\craftstripe\CraftStripe;

class CraftStripeVariable
{
    public $settings;
    public function init(){
        $this->settings = CraftStripe::getInstance()->getSettings();
    }

    public function getSettings()
    {
        return CraftStripe::getInstance()->getSettings();
    }



}