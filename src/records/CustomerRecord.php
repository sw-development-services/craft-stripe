<?php


namespace swdevelopment\craftstripe\records;

use Craft;
use craft\db\ActiveRecord;
use swdevelopment\craftstripe\CraftStripe;


  /**
   * Summary of CustomerRecord
   * @author Tim Strawbridge
   * @copyright (c) 2023
   * 
   * @property int $id
   * @property string $customer_id
   * @property string $address
   * @property float $balance
   * @property int $created_at
   * @property string $currency
   * @property string $default_source
   * @property boolean $delinquent
   * @property string $description
   * @property string $discount
   * @property string $email
   * @property string $invoice_prefix
   * @property string $name
   * @property string $phone
   * @property boolean $tax_exempt
   * @property string $dateCreated
   * @property string $dateUpdated
   * 
   */


class CustomerRecord extends ActiveRecord
{
    //CraftStripe::$plugin->getInstance()->databasePrefix;
    /**
     * Summary of tableName
     * @var string
     */
    public static $tableName = '{{%craft_stripe_customers}}';
    /**
     * @return string
     */
    public static function tableName(): string {
        return self::$tableName;
    }


}


