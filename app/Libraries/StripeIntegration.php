<?php


namespace App\Libraries;


use App\Models\Restaurant;

class StripeIntegration
{

    public function __construct()
    {
        $this->setApiKey();
    }

    public function setApiKey() {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function createAccount(Restaurant $restaurant) {

        return \Stripe\Account::create([
            'type' => 'custom',
            'country' => 'IT',
            'requested_capabilities' => [
                'card_payments',
                'transfers',
            ],
            'business_type' => 'individual',
        ]);
    }
}
