<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SubscriptionController extends Controller
{
    public function intent()
    {
        $user = Auth::user();
        $paymentMethods = $user->paymentMethods();
        $defaultPayment = $user->defaultPaymentMethod();

        return $defaultPayment;

        return view('user.subscription.update-payment-method', [
            'intent' => $user->createSetupIntent(),
            'paymentMethods' => $paymentMethods,
            'defaultPayment' => $defaultPayment
        ]);
    }
}
