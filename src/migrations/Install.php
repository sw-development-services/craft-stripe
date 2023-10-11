<?php

namespace swdevelopment\craftstripe\migrations;

use Craft;
use craft\db\Migration;
use swdevelopment\craftstripe\records\CustomerRecord;
use swdevelopment\craftstripe\records\InvoiceRecord;

/**
 * Install migration.
 */
class Install extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        $this->dropTableIfExists('customers');
        $this->createTable(
            CustomerRecord::$tableName, [
            'id'                => $this->primaryKey(),
            'customer_id'       => $this->string(25)->notNull(),
            'address'           => $this->string(100),
            'balance'           => $this->decimal()->null(),
            'created_at'        => $this->integer(),
            'currency'          => $this->string()->notNull(),
            'default_source'    => $this->string()->null(),
            'delinquent'        => $this->boolean()->defaultValue(false),
            'description'       => $this->string(255)->null(),
            'discount'          => $this->string(255)->null(),
            'email'             => $this->string(255)->null(),
            'invoice_prefix'    => $this->string(25)->null(),
            'name'              => $this->string(50)->notNull(),
            'phone'             => $this->string(50)->null(),
            'tax_exempt'        => $this->boolean()->notNull()->defaultValue(true), 
            'dateCreated'       => $this->dateTime()->notNull(),
            'dateUpdated'       => $this->dateTime()->notNull()

        ]);

        $this->dropTableIfExists('invoices');
        $this->createTable(
            InvoiceRecord::$tableName, [
                'id'                        => $this->primaryKey(),
                'account_name'              => $this->string(255)->null(),
                'amount_due'                => $this->bigInteger()->null(),
                'amount_remaining'          => $this->bigInteger()->null(),
                'amount_shipping'           => $this->bigInteger()->null(),
                'application'               => $this->boolean()->null()->defaultValue(false),
                'application_fee_amount'    => $this->bigInteger()->null(),
                'attempt_count'             => $this->integer()->defaultValue(0)->null(),
                'collection_method'         => $this->string(50)->null(),
                'custom_fields'             => $this->json()->null(),
                'currency'                  => $this->string(25)->null(),
                'customer'                  => $this->string(25)->null(),
                'customer_address'          => $this->string(255)->null(),
                'customer_email'            => $this->string(50)->notNull(),
                'customer_name'             => $this->string(50)->notNull(),
                'customer_phone'            => $this->string(50)->null(),
                'customer_shipping'         => $this->string(50)->null(),
                'customer_tax_exempt'       => $this->string(50)->null(),
                'default_source'            => $this->string(50)->null(),
                'default_tax_rates'         => $this->json()->null(),
                'description'             => $this->string(255)->null(),
                'discounts'             => $this->json()->null(),
                'due_date'             => $this->timestamp()->null(),
                'effective_at'             => $this->timestamp()->null(),
                'ending_balance'             => $this->integer()->null(),
                'footer'             => $this->string(500)->null(),
                'invoice_pdf'             => $this->string(255)->null(),
                'live_mode'             => $this->boolean()->defaultValue(false),
                'number'             => $this->string(25)->defaultValue(''),
                'paid'             => $this->boolean()->defaultValue(false),
                'quote'             => $this->string(255)->null(),
                'receipt_number'             => $this->string(255)->null(),
                'shipping_cost'             => $this->string(255)->null(),
                'shipping_details'             => $this->string(255)->null(),
                'starting_balance'             => $this->integer()->null()->defaultValue(0),
                'statement_descriptor'             => $this->string(255)->null(),
                'subscription_details'             => $this->string(255)->null(),
                'subtotal'             => $this->integer()->defaultValue(0),
                'subtotal_excluding_tax'             => $this->integer()->defaultValue(0),
                'tax'             => $this->integer()->defaultValue(0),
                'total_tax_amounts'             => $this->json(),
                'transfer_data'             => $this->json(),
                'webhooks_delivered_at'             => $this->timestamp()->null()->defaultValue(null),
            ]
        );

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        $this->dropTableIfExists('customers');
        $this->dropTableIfExists('invoices');

        return true;
    }
}
