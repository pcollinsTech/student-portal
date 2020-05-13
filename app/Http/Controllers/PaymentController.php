<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Student;
use App\User;
use GlobalPayments\Api\Entities\Address;
use GlobalPayments\Api\Entities\Enums\AddressType;
use GlobalPayments\Api\ServicesConfig;
use GlobalPayments\Api\HostedPaymentConfig;
use GlobalPayments\Api\Entities\HostedPaymentData;
use GlobalPayments\Api\Entities\Enums\HppVersion;
use GlobalPayments\Api\Entities\Exceptions\ApiException;
use GlobalPayments\Api\Services\HostedService;

use Illuminate\Http\Request;

class PaymentController extends Controller
{

    protected $config;
    /**
     * PaymentController constructor.
     */
    public function __construct()
    {
        $this->config = new ServicesConfig();
        $this->config->merchantId = env('MERCHANT_ID');
        $this->config->sharedSecret = env('SHARED_SECRET');
        $this->config->serviceUrl = "https://pay.sandbox.realexpayments.com/pay";

        $this->config->hostedPaymentConfig = new HostedPaymentConfig();
        $this->config->hostedPaymentConfig->version = HppVersion::VERSION_2;
    }

    public function requestPayment(Request $request)
    {

        $amount = 206;

        $this->config->accountId = request('account_id');

        $service = new HostedService($this->config);


        // Add 3D Secure 2 Mandatory and Recommended Fields
        $hostedPaymentData = new HostedPaymentData();
        $hostedPaymentData->customerEmail = $request->student_email;
        $hostedPaymentData->customerPhoneMobile = $request->student_phone;
        $hostedPaymentData->addressesMatch = false;

        // TODO: Address entered may not be billing address...
        $billingAddress = new Address();
        $billingAddress->streetAddress1 = $request->street_address_1;
        // $billingAddress->streetAddress2 = $request->street_address_2;
        // $billingAddress->streetAddress3 = $request->street_address_3;
        $billingAddress->city = $request->billing_city;
        $billingAddress->postalCode = $request->billing_post_code;
        $billingAddress->country = $request->billing_country;

        try {

            // Create Payment Request
            $hppJson = $service->charge(206)
                ->withCurrency("GBP")
                ->withHostedPaymentData($hostedPaymentData)
                ->withAddress($billingAddress, AddressType::BILLING)
                ->serialize();

            $payload = json_decode($hppJson);


            // get The Student
            $student =  Student::find(request()->student_id);


            // Create Payment
            $payment = new Payment();
            $payment->payment_amount = $amount;
            $payment->response = '';
            $payment->type = 'registraion/application';
            $payment->status = 'created';

            // Set Order ID from payment request
            $payment->order_id = $payload->ORDER_ID;

            // Save the Payment for this user
            $student->user->payments()->save($payment);

            // Check for previous payment requests
            $existingPayments = Payment::where('entity_id', $student->user->id)
                ->where('type', 'registraion/application')
                ->where('id', '!=', $payment->id)->get();

            // Delete previous payment request
            Payment::destroy($existingPayments->map(function ($payment) {
                return $payment['id'];
            }));


            $payment->save();

            return response()->json($payload);
        } catch (ApiException $e) {
            // TODO: Add your error handling here
        }
    }

    /**
     * Process response from Realex
     */
    public function processPayment()
    {
        $this->config->accountId = request('account_id');
        $service = new HostedService($this->config);

        //       $parsedResponse = request('hppResponse');

        try {
            // create the response object from the response JSON
            $parsedResponse = $service->parseResponse(request('hppResponse'), true);

            $orderId = $parsedResponse->orderId; // GTI5Yxb0SumL_TkDMCAxQA
            $responseCode = $parsedResponse->responseCode; // 00
            $responseMessage = $parsedResponse->responseMessage; // [ test system ] Authorised
            $responseValues = $parsedResponse->responseValues; // get values accessible by key


            $payment = Payment::where('order_id', $orderId)->first();

            $user = $payment->entity;

            auth()->login($user);


            // TODO: add user to next step...
            if ($responseCode == '00') {

                $payment->status = 'accepted';
                $payment->save();

                session()->flash('message', 'Payment Accepted, please complete the rest of the registration process.');
                return redirect('profile');
            } else {


                $payment->status = 'declined';
                $payment->save();

                session()->flash('message', 'Your payment has been declined, please check your details and try again.');
                return redirect('profile');
            }
        } catch (ApiException $e) {

            return redirect('register');
        }
    }
}
