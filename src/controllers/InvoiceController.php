<?php

namespace swdevelopment\craftstripe\controllers;

use Craft;
use craft\web\Controller;
use craft\web\View;
use Stripe\StripeClient;
use swdevelopment\craftstripe\CraftStripe;
use yii\web\Response;

/**
 * Invoice controller
 */
class InvoiceController extends Controller
{
    public $defaultAction = 'index';
    public $stripe;
    protected array|int|bool $allowAnonymous = self::ALLOW_ANONYMOUS_NEVER;

    /**
     * _craft-stripe/invoice action
     */

    // public function __construct(){
        //$this->stripe = new StripeClient( CraftStripe::getInstance()->stripe->getAPIKey() );   
    // }

    /**
     * Summary of actionIndex
     * @return \yii\web\Response
     */
    public function actionIndex(): Response
    {
        $stripe = new StripeClient( CraftStripe::getInstance()->stripe->getAPIKey() );   
        // getInvoices
        $invoices = [
            'invoices' => CraftStripe::getInstance()->invoices->getInvoices($stripe)->toArray() 
        ];
        // call invoice service to show all the invoices
        return $this->renderTemplate(
            'craft-stripe/admin/invoices/index',
            ['invoices' => $invoices],
            View::TEMPLATE_MODE_CP,
        );
    }

    /**
     * Creates a new invoice to a customer
     * @return \yii\web\Response
     */
    public function actionCreate(): Response
    {
        $stripe = new StripeClient( CraftStripe::getInstance()->stripe->getAPIKey() );   

        // gets all customers
        $customers = CraftStripe::getInstance()->customers->getCustomerList($stripe)->toArray();
        $products = CraftStripe::getInstance()->products->getProducts($stripe)->toArray();

        return $this->renderTemplate(
            'craft-stripe/admin/invoices/create',
            [ 'customers' => $customers, 'products' => $products ],
            View::TEMPLATE_MODE_CP
        );
    }

    /**
     * This will store the created invoice
     * @return string
     */
    public function actionStore(){

        // get post data
         $this->requirePostRequest();
        
        // get json data - payload
        $payload = Craft::$app->request->getBodyParams();

        $customerID = $payload['customer']['id'];

        // $amount = $payload['amount_due']['value'];
        // get customer information (email, phone)

        $footerContents = 'Thank you for choosing Car Care Solutions USA for your auto detailing needs!';

        // lookup products, these are essentially invoice items (line items)
        $products = $payload['product']['id'];
        // print_r($products);
    
        $stripe = new StripeClient( CraftStripe::getInstance()->stripe->getAPIKey() );
        // lookup each product price
        $prices = $stripe->prices->all(['product' => $products]);
        $priceObj = $prices['data'][0]->id;

        // print_r($priceObj);

        // if everything looks good lets push this to stripe
        
        $invoice = $stripe->invoices->create([
            'customer' => $customerID,
            'days_until_due' => 1,
            'collection_method' => 'send_invoice',
            'auto_advance'  => false,
            'footer'    => $footerContents

        ]);

        // grab the invoice id from the new created invoice
        print_r( $invoice );
        $invoiceID = $invoice->id;

        // add invoice items
        $stripe->invoiceItems->create([
            'customer' => $customerID,
            'price' => $priceObj,
            'invoice'   => $invoiceID
        ]);

        // finalize invoice
        $stripe->invoices->finalizeInvoice($invoiceID);

        // send to customer

        return "hey";
    }


}
