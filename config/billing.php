<?php

return [

    'plan' => env('STRIPE_SUBSCRIPTION', 'default'),
    'price' => env("STRIPE_PRICE_ID", "price_1MLXkTAB46zMuKJxdIVHUwli")

];