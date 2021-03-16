<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Traits\ConsumesExternalServices;

class StripeService
{
    use ConsumesExternalServices;

    protected $baseUri;

    protected $key;

    protected $secret;

    public function __construct()
    {
        $this->baseUri = config('services.stripe.base_uri');
        $this->key = config('services.stripe.key');
        $this->secret = config('services.stripe.secret');
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        return "Bearer {$this->secret}";
    }

    public function handlePayment(Request $request)
    {
        // $order = $this->createOrder($request->value, $request->currency);

        // $orderLinks = collect($order->links);

        // $approve = $orderLinks->where('rel', 'approve')->first();

        // session()->put('approvalId', $order->id);

        // return redirect($approve->href);
    }

    public function handleApproval()
    {
        // if (session()->has('approvalId'))
        // {
        //     $approvalId = session()->get('approvalId');

        //     $payment = $this->capturePayment($approvalId);

        //     $name = $payment->payer->name->given_name;
        //     $payment = $payment->purchase_units[0]->payments->captures[0]->amount;
        //     $amount = $payment->value;
        //     $currency = $payment->currency_code;

        //     return redirect()
        //         ->route('home')
        //         ->withSuccess(['payment' => "Thanks, {$name}. We received your {$amount}{$currency} payment."]);
        // }

        // return redirect()
        //     ->route('home')
        //     ->withErrors('We cannot capture the payment. Try again, please');
    }

    public function resolveFactor($currency)
    {
        $zeroDecimalCurrencies = ['JPY'];

        if(in_array(strtoupper($currency), $zeroDecimalCurrencies)){
            return 1;
        }

        return 100;
    }
}