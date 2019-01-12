<?php

namespace App\Http\Controllers;

use Cart;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use App\Http\Controllers\Controller;
use PayPal\Auth\OAuthTokenCredential;

class PaypalController extends Controller
{
    private $apiContext;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // ### Api Context
        // Use an ApiContext object to authenticate API calls.
        // The clientId and clientSecret for the OAuthTokenCredential class
        // can be retrieved from developer.paypal.com
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('services.paypal.client_id'),
                config('services.paypal.client_secret')
            )
        );

        $this->apiContext->setConfig(config('services.paypal.settings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function preparePayment(Request $request)
    {
        // ### Payer
        // A resource representing a Payer that funds a payment.
        // For paypal account payments, set payment method to 'paypal'.
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $cartSubTotal = Cart::getSubTotal();
        $shipping = 6.50;
        $shipping = $shipping[0];
        $total = ($cartSubTotal + $shipping);

        //dd($cartSubTotal, $shipping, $total, session()->all());

        // ### Itemized information
        // (Optional) Lets you specify item wise information.
        $item = new Item();
        $item->setName('Cart')
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($cartSubTotal);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        // ### Additional payment details
        // Use this optional field to set additional payment
        // information such as tax, shipping charges etc.
        $details = new Details();
        $details->setShipping($shipping)
            ->setSubtotal($cartSubTotal);

        // ### Amount
        // Lets you specify a payment amount.
        // You can also specify additional details such as shipping, tax.
        $amount = new Amount();
        $amount->setCurrency('EUR')
            ->setDetails($details)
            ->setTotal($total);

        // ### Transaction
        // A transaction defines the contract of a payment -
        // what is the payment for and who is fulfilling it.
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('FreznoShop')
            ->setInvoiceNumber(uniqid());

        // ### Redirect urls
        // Set the urls that the buyer must be redirected to
        // after payment approval / cancellation.
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.execute', ['success' => true]))
            ->setCancelUrl(route('paypal.execute', ['success' => false]));

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent set to 'sale'
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        // ### Create Payment
        // Create a payment by calling the 'create' method
        // passing it a valid apiContext.
        // (See bootstrap.php for more on `ApiContext`)
        // The return object contains the state and the
        // url to which the buyer must be redirected to
        // for payment approval.
        try {
            $payment->create($this->apiContext);
        } catch (Exception $ex) {

            // Error: Payment failed
            return redirect('checkout')->withErrors($ex->getCode().':'.$ex->getMessage());
        }

        // ### Get redirect url
        // The API response provides the url that you must redirect the buyer to.
        // Retrieve the url from the $payment->getApprovalLink() method.
        $approvalUrl = $payment->getApprovalLink();

        $request->session()->put('payment_id', $payment->id);

        // Result: Approve Payment
        return redirect($approvalUrl); //redirect()->to($approvalUrl);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function executePayment(Request $request)
    {
        if (isset($_GET['success']) && $_GET['success'] == true) {

            // Get the payment Object by passing paymentId.
            // payment id was previously stored in session in
            // CreatePaymentUsingPayPal.php
            $paymentId = $request->session()->get('payment_id');
            $payment = Payment::get($paymentId, $this->apiContext);

            // ### Payment Execute
            // PaymentExecution object includes information necessary
            // to execute a PayPal account payment.
            // The payer_id is added to the request query parameters
            // when the user is redirected from paypal back to your site
            $execution = new PaymentExecution();
            $execution->setPayerId($request->input('PayerID'));

            try {
                // Result: Execute Payment
                $result = $payment->execute($execution, $this->apiContext);

                try {
                    $payment = Payment::get($paymentId, $this->apiContext);

                    $code = $request->session()->pull('payment_id');
                } catch (Exception $e) {

                    // Error: Get Payment
                    return redirect('checkout')->withErrors($e->getCode().':'.$e->getMessage());
                }
            } catch (Exception $e) {

                // Error: Executed Payment
                return redirect('checkout')->withErrors($e->getCode().':'.$e->getMessage());
            }

            // Result: Get Payment
            $payments = Payment::get($paymentId, $this->apiContext);

            session()->push('paypal', 'success');

            return redirect()->action('CheckoutController@confirmPurchase');

        } else {

            // Result: User Cancelled the Approval
            return redirect('checkout')->withErrors('User Cancelled the Approval');
        }
    }

    public function getStatus(Request $request)
    {
        $request->session()->reflash();
        return 'Abort'; //view('pages.status');
    }
}
