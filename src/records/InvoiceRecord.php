<?php


namespace swdevelopment\craftstripe\records;

use Craft;
use craft\db\ActiveRecord;


  /**
   * Summary of CustomerRecord
   * @author Tim Strawbridge
   * @copyright (c) 2023
   * 
   * @property int $id
   * @property string $account_name
   * @property float $amount_due
   * @property float $amount_remaining
   * @property float $amount_shipping
   * @property boolean $application
   * @property float $application_fee_amount
   * @property int $attempt_count
   * @property string $collection_method
   * @property array $custom_fields
   * @property string $currency
   * @property string $customer
   * @property string $customer_address
   * @property string $customer_email
   * @property string $customer_name
   * @property string $customer_phone
   * @property string $customer_shipping
   * @property string $customer_tax_exempt
   * @property string $default_source
   * @property array $default_tax_rates
   * @property string $description
   * @property array $discounts
   * @property string $due_date
   * @property string $effective_at
   * @property string $ending_balance
   * @property string $footer
   * @property string $invoice_pdf
   * @property boolean $live_mode
   * @property string $number
   * @property boolean $paid
   * @property string $quote
   * @property string $receipt_number
   * @property string $shipping_cost
   * @property string $shipping_details
   * @property int $starting_balance
   * @property string $statement_descriptor
   * @property string $subscription_details
   * @property int $subtotal
   * @property int $subtotal_excluding_tax
   * @property int $tax
   * @property array $total_tax_amounts
   * @property array $transfer_data
   * @property string $webhooks_delivered_at
   * 
   * 
   */


class InvoiceRecord extends ActiveRecord
{

    /**
     * Summary of tableName
     * @var string
     */
    public static $tableName = '{{%craft_stripe_invoices}}';

    /**
     * @return string
     */
    public static function tableName(): string {
        return self::$tableName;
    }


}


