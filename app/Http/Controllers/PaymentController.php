<?php

namespace App\Http\Controllers;

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
   public function processPayment(Request $request)
   {
      // configure client, request and HPP settings
      $config = new ServicesConfig();
      $config->merchantId = env('MERCHANT_ID');
      $config->accountId = $request->account_id;
      $config->sharedSecret = env('SHARED_SECRET');
      $config->serviceUrl = "https://pay.sandbox.realexpayments.com/pay";
      
      $config->hostedPaymentConfig = new HostedPaymentConfig();
      $config->hostedPaymentConfig->version = HppVersion::VERSION_2;
      $service = new HostedService($config);
      
      // Add 3D Secure 2 Mandatory and Recommended Fields
      $hostedPaymentData = new HostedPaymentData();
      $hostedPaymentData->customerEmail = $request->student_email;
      $hostedPaymentData->customerPhoneMobile = $request->student_phone;
      $hostedPaymentData->addressesMatch = false;
      
      $billingAddress = new Address();
      $billingAddress->streetAddress1 = $request->street_address_1;
      // $billingAddress->streetAddress2 = $request->street_address_2;
      // $billingAddress->streetAddress3 = $request->street_address_3;
      $billingAddress->city = $request->billing_city;
      $billingAddress->postalCode = $request->billing_post_code;
      $billingAddress->country = $request->billing_country;
      
      try {
         $hppJson = $service->charge(206)
            ->withCurrency("GBP")
            ->withHostedPaymentData($hostedPaymentData)
            ->withAddress($billingAddress, AddressType::BILLING)
            ->serialize();      
         // TODO: pass the HPP JSON to the client-side    
      } catch (ApiException $e) {
         // TODO: Add your error handling here
      }
   }
}
