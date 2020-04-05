<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Invoice;
use App\Models\IPNStatus;
use App\Models\Item;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class PaypalController extends Controller
{
    /**
     * @var ExpressCheckout
     */
    protected $provider;

    public function __construct()
    {
        $this->provider = new ExpressCheckout();
    }

    public function getIndex(Request $request)
    {
        $response = [];
        if (session()->has('code')) {
            $response['code'] = session()->get('code');
            session()->forget('code');
        }

        if (session()->has('message')) {
            $response['message'] = session()->get('message');
            session()->forget('message');
        }

        return view('welcome', compact('response'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getExpressCheckout(Request $request,$id)
    {
        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $cart = $this->getCheckoutData($recurring,$id);
        $response = $this->provider->setExpressCheckout($cart, $recurring);
        try {
            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Error processing PayPal payment for invoice #'.$cart['id']);
        }
    }

    /**
     * Process payment on PayPal.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getExpressCheckoutSuccess(Request $request,$id)
    {
        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');

        $cart = $this->getCheckoutData($recurring,$id);
        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            if ($recurring === true) {
                $response = $this->provider->createMonthlySubscription($response['TOKEN'], 9.99, $cart['subscription_desc']);
                if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                    $status = 'Processed';
                } else {
                    $status = 'Invalid';
                }
            } else {
                // Perform transaction on PayPal
                $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
                $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            }
            $invoice = $this->updateInvoice($status,$id);
            if ($invoice->paid == 1) {
                return redirect()->route('payment.success', ['id' => $invoice->id])->with('success', __('Invoice has been paid successfully!'));
            } else {
                return redirect()->route('search')->with('error', __('Error processing PayPal payment for Order!'));
            }

        }
    }

    public function getAdaptivePay()
    {
        $this->provider = new AdaptivePayments();

        $data = [
            'receivers'  => [
                [
                    'email'   => 'johndoe@example.com',
                    'amount'  => 10,
                    'primary' => true,
                ],
                [
                    'email'   => 'janedoe@example.com',
                    'amount'  => 5,
                    'primary' => false,
                ],
            ],
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ];

        $response = $this->provider->createPayRequest($data);
    }

    /**
     * Parse PayPal IPN.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function notify(Request $request)
    {
        if (!($this->provider instanceof ExpressCheckout)) {
            $this->provider = new ExpressCheckout();
        }

        $post = [
            'cmd' => '_notify-validate',
        ];
        $data = $request->all();
        foreach ($data as $key => $value) {
            $post[$key] = $value;
        }

        $response = (string) $this->provider->verifyIPN($post);

        $ipn = new IPNStatus();
        $ipn->payload = json_encode($post);
        $ipn->status = $response;
        $ipn->save();
    }

    /**
     * Set cart data for processing payment on PayPal.
     *
     * @param bool $recurring
     *
     * @return array
     */
    protected function getCheckoutData($recurring = false,$invid)
    {
        $data = [];

        $invoice = Invoice::find($invid);
        if ($recurring === true) {
            $data['items'] = [
                $invoice
            ];

            $data['return_url'] = route('paypal.checkout-success',['mode' => 'recurring']);
            $data['subscription_desc'] = 'pay the bill #'.$invoice['id'];;
        } else {
            /* many item */
            $data['items'] = [
                $invoice
            ];

            $data['return_url'] = route('paypal.checkout-success',['id' => $invoice['id']]);
        }

        $data['invoice_id'] = config('paypal.invoice_prefix').'_'.$invoice['id'];;
        $data['invoice_description'] = "invoice #".$invoice['id'];
        $data['cancel_url'] = url('/');
        $data['total'] = $invoice['price'];

        return $data;
    }

    /**
     * Create invoice.
     *
     * @param array  $cart
     * @param string $status
     *
     * @return \App\Invoice
     */
    protected function updateInvoice($status,$id)
    {
        if ($status == 'Completed') {
            $invoice = Invoice::find($id);
            $invoice->paid = 1;
            $invoice->save();

            Notifications::create([
                'id_relation' => $invoice->id,
                'name_relation' => 'paid for trip',
                'message' => 'has paid for the package #'.$invoice->hasOne_request_send->package_id.' sent with your trip #'.$invoice->hasOne_request_send->trip_id,
                'redirection' => route('payment.detail',['id' => $invoice->id]),
                'from_user' => $invoice->hasOne_request_send->user_send,
                'to_user' => $invoice->hasOne_request_send->user_recei
            ]);
        }
        return $invoice;
    }
}
