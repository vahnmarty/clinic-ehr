<?php

namespace App\Http\Livewire\User;

use Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SubscriptionPage extends Component
{
    use LivewireAlert;
    
    public function render()
    {
        $intent = $user->createSetupIntent();
        return view('livewire.user.subscription-page', compact('intent'));
    }

    public function subscribe()
    {
        $user = Auth::user();

        $user->createOrGetStripeCustomer();

        if ($user->hasDefaultPaymentMethod()) {
            $paymentMethod = $user->defaultPaymentMethod();
        }else{
            $paymentMethod = $user->paymentMethods()->first();
            $user->updateDefaultPaymentMethod($paymentMethod->id);
        }

        $subscribed = $user->newSubscription(config('billing.plan'), config('billing.price'))->create($paymentMethod->id);

        if($subscribed)
        {
            $this->alert('success', 'You are successfully subsribed to our standard plan!');
        }
    }
}
