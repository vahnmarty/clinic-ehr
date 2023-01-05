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

        return view('user.subscription.update-payment-method', [
            'intent' => $user->createSetupIntent(),
            'paymentMethods' => $paymentMethods,
            'defaultPayment' => $defaultPayment
        ]);
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();

        $user->createOrGetStripeCustomer();

        return $user
            ->newSubscription(config('billing.plan'), config('billing.price'))
            ->checkout([
                'success_url' => url('billing?checkout=success'),
                'cancel_url' => url('billing?checkout=cancelled'),
            ]);
    }

    public function defaultPayment(Request $request)
    {
        $user = Auth::user();
        $paymentMethods = $user->paymentMethods();
        $paymentMethod = $paymentMethods->first();
        $user->updateDefaultPaymentMethod($paymentMethod->id);
    }
}
