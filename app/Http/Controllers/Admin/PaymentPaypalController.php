<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\src\Services\ExpressCheckout;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

// use PayPal\Rest\ApiContext;
// use PayPal\Auth\OAuthTokenCredential;
// use PayPal\Api\Agreement;
// use PayPal\Api\Payer;
// use PayPal\Api\Plan;
// use PayPal\Api\PaymentDefinition;
// use PayPal\Api\PayerInfo;
// use PayPal\Api\Item;
// use PayPal\Api\ItemList;
// use PayPal\Api\Amount;
// use PayPal\Api\Transaction;
// use PayPal\Api\RedirectUrls;
// use PayPal\Api\Payment;
// use PayPal\Api\PaymentExecution;
// use Illuminate\Support\Facades\Input;
// use Redirect;
// use URL;
// use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentPaypalController extends Controller
{
    // public function __construct()
    // {
    //      /** PayPal api context **/
    //      $paypal_conf = \Config::get('paypal');
    //      $this->_api_context = new ApiContext(new OAuthTokenCredential(
    //          $paypal_conf['client_id'],
    //          $paypal_conf['secret'])
    //      );
    //      $this->_api_context->setConfig($paypal_conf['settings']);
    // }

    protected $provider;
    
    public function Payment()
    {
        $data = [];
        $data['items'] = [
            [
                'name' => 'ItSolutionStuff.com',
                'price' => 100,
                'desc'  => 'Description for ItSolutionStuff.com',
                'qty' => 1
            ]
        ];
  
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('api.admin.payment.success');
        $data['cancel_url'] = route('api.admin.payment.cancel');
        $data['total'] = 100;

        $recurring = false;
        // $provider = new ExpressCheckout;
        $provider = new PayPalClient;
        $provider->setApiCredentials($config);
        $response = $provider->setExpressCheckout($data);
        // $provider = PayPal::setProvider();

  return $recurring;
  
        $response = $provider->setExpressCheckout($data);
  
        $response = $provider->setExpressCheckout($data, true);
  
        return $response;
        return redirect($response['paypal_link']);
    }

    // public function cancel()
    // {
    //     dd('Your payment is canceled. You can create cancel page here.');
    // }
  
    // /**
    //  * Responds with a welcome message with instructions
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function success(Request $request)
    // {
    //     $response = $provider->getExpressCheckoutDetails($request->token);
  
    //     if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
    //         dd('Your payment was successfully. You can create success page here.');
    //     }
  
    //     dd('Something is wrong.');
    // }

    public function PayWithPaypal()
    {
        
        $provider = new PayPalClient;

        // Through facade. No need to import namespaces
        $provider = PayPal::setProvider();
        $provider->getAccessToken();
        $provider->setCurrency('EUR');
        $provider->createOrder([
            "intent"=> "CAPTURE",
            "purchase_units"=> [
                "amount"=> [
                  "currency_code" => "USD",
                  "value" => "100.00"
                ]
            ]
        ]);
        $provider->capturePaymentOrder($order_id);
        return $provider;
        // exit;
        // $amountToBePaid = 100;
        // $payer = new Payer();
        // $payer->setPaymentMethod('paypal');

        // $item_1 = new Item();
        // $item_1->setName('Mobile Payment') /** item name **/
        //         ->setCurrency('USD')
        //         ->setQuantity(1)
        //         ->setPrice($amountToBePaid); /** unit price **/

        // $item_list = new ItemList();
        // $item_list->setItems(array($item_1));

        // $amount = new Amount();
        // $amount->setCurrency('USD')
        //         ->setTotal($amountToBePaid);
        // $redirect_urls = new RedirectUrls();

        // /** Specify return URL **/
        // $redirect_urls->setReturnUrl(URL::route('status'))
        //         ->setCancelUrl(URL::route('status'));
        
        // $transaction = new Transaction();
        // $transaction->setAmount($amount)
        //         ->setItemList($item_list)
        //         ->setDescription('Your transaction description');   

        // $payment = new Payment();
        // $payment->setIntent('Sale')
        //         ->setPayer($payer)
        //         ->setRedirectUrls($redirect_urls)
        //         ->setTransactions(array($transaction));
        //         return $payment;
        // try {
        //     $payment->create($this->_api_context);
        // } catch (\PayPal\Exception\PPConnectionException $ex) {
        //     if (\Config::get('app.debug')) {
        //         \Session::put('error', 'Connection timeout');
        //         return Redirect::route('/');
        //     } else {
        //         \Session::put('error', 'Some error occur, sorry for inconvenient');
        //         return Redirect::route('/');
        //     }
        // }
        // foreach ($payment->getLinks() as $link) {
        //     if ($link->getRel() == 'approval_url') {
        //         $redirect_url = $link->getHref();
        //         break;
        //     }
        // }
        
        // /** add payment ID to session **/
        // \Session::put('paypal_payment_id', $payment->getId());
        // if (isset($redirect_url)) {
        //     /** redirect to paypal **/
        //     return Redirect::away($redirect_url);
        // }

        // \Session::put('error', 'Unknown error occurred');
        // return Redirect::route('/');
    }

    // public function GetPaymentStatus(Request $request)
    // {
    //     /** Get the payment ID before session clear **/
    //     $payment_id = Session::get('paypal_payment_id');
    //     /** clear the session payment ID **/
    //     Session::forget('paypal_payment_id');
    //     if (empty($request->PayerID) || empty($request->token)) {
    //         session()->flash('error', 'Payment failed');
    //         return Redirect::route('/');
    //     }
    //     $payment = Payment::get($payment_id, $this->_api_context);
    //     $execution = new PaymentExecution();
    //     $execution->setPayerId($request->PayerID);
    //     /**Execute the payment **/
    //     $result = $payment->execute($execution, $this->_api_context);
        
    //     if ($result->getState() == 'approved') {
    //         session()->flash('success', 'Payment success');
    //         return Redirect::route('/');
    //     }
    //     session()->flash('error', 'Payment failed');
    //     return Redirect::route('/');
    // }
}
