@extends('layouts.user')

@section('content')
<div class="wrapper">
    <div class="w-1/2 p-8 mx-auto bg-white rounded-md">
        <input id="card-holder-name" class="w-full text-sm border border-gray-200" type="text" placeholder="Card Holder Name">
 
        <!-- Stripe Elements Placeholder -->
        <div class="px-3 py-3 my-3 border shadow-sm">
            <div id="card-element"></div>
        </div>

        <button type="button" class="btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">
            Update Payment Method
        </button>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe("{{ config('cashier.key') }}");

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
    
    cardButton.addEventListener('click', async (e) => {
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value }
                }
            }
        );
    
        if (error) {
            // Display "error.message" to the user...
        } else {
            // The card has been verified successfully...
        }
    });
</script>
@endsection