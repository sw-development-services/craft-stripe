<?php

namespace swdevelopment\craftstripe\models;

use Craft;
use craft\base\Model;

/**
 * craft-stripe settings
 */
class Settings extends Model
{
    // public string $name;
    public ?string $secretKey = null;
    public ?string $webhookSecret = null;

    public ?bool $enableWebhooks = false;

    public ?bool $enableSyncLogging = false;

    
}
