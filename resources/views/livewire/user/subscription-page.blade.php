<div>

    <div class="wrapper">
        <div class="grid grid-cols-10 gap-8 py-6">
            <div class="col-span-4 p-8 bg-white rounded-md shadow-md">
                <div class="flex flex-col items-center justify-center">
                    <img src="{{ asset('img/vector.jpg') }}" class="w-auto h-32" alt="">
                    <h3 class="mt-2 font-bold text-center text-indigo-500">Standard Plan</h3>
                    <div class="flex justify-center gap-1 mt-2">
                        <div class="text-xl text-gray-600">$</div>
                        <div class="text-5xl font-bold text-gray-900">300</div>
                        <div class="self-end text-lg text-gray-600">/mo</div>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t">
                    <div class="px-6">
                        <ul class="space-y-2">
                            <li class="flex justify-center w-full gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm">14-days free trial</span>
                            </li>
                            <li class="flex justify-center w-full gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm">Unlimited Clinics</span>
                            </li>
                            <li class="flex justify-center w-full gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm">Manage Patients</span>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-span-6 p-8 bg-white rounded-md shadow-md">
                <div>
                    <input id="card-holder-name" class="w-full text-sm border border-gray-200" type="text"
                        placeholder="Card Holder Name">

                    <!-- Stripe Elements Placeholder -->
                    <div class="px-3 py-3 my-3 border shadow-sm">
                        <div id="card-element"></div>
                    </div>

                    <button type="button" class="btn-primary" id="card-button"
                        data-secret="{{ $intent->client_secret }}">
                        Complete Order
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
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
            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            );

            if (error) {
                alert(error.message);
            } else {
                @this.subscribe();
            }
        });
    </script>
@endpush
