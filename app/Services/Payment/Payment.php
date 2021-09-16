<?php

namespace App\Services\Payment;

use App\Models\Order;

class Payment
{
    /**
     * @var mixed
     */
    private $url;

    private $entityId;

    private $authKey;

    private $amount;

    private $currency = 'SAR';

    private $testMode;

    private $order;

    public function __construct(Order $order)
    {
        $this->url          = config('payment.url');

        $this->order        = $order;

        $this->entityId     = $order->payment_type == 1 ? config('payment.visa_entity_id') : config('payment.mada_entity_id');

        $this->authKey      = config('payment.token');

        $this->amount       = $this->order->total_price;

        $this->testMode     = $this->order->payment_type == 1 ? 'EXTERNAL' : 'INTERNAL';
    }

    public function prepareCheckout()
    {
        $url = $this->url."/v1/checkouts";
        $data = "entityId=" . $this->entityId .
            "&amount=" . (float)$this->amount .
            "&currency=" . $this->currency .
            "&paymentType=DB" .
            "&testMode=" . $this->testMode .
            "&merchantTransactionId=" . $this->order->id .
            "&customer.email=" . $this->order->email .
            "&billing.street1=" . $this->order->street .
            "&billing.city=" . $this->order->city .
            "&billing.state=" . $this->order->state .
            "&billing.country=SA" .
            "&billing.postcode=" . $this->order->post_code .
            "&customer.givenName=" . $this->order->first_name .
            "&customer.surname=" . $this->order->last_name;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer ' . $this->authKey));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }

    public static function checkResponse($entityId)
    {
        $url = config('payment.url') . request()->resourcePath;
        $url .= "?entityId=" . $entityId;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer ' . config('payment.token')));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }


}