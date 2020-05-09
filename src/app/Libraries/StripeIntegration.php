<?php


namespace App\Libraries;


use App\Models\Restaurant;
use App\Models\User;

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
                'transfers'
            ],
            'business_type' => 'company',
            'company' => [
                'name' => $restaurant->name,
                'owners_provided' => true
            ],
            'tos_acceptance' => [
                'date' => time(),
                'ip' => $_SERVER['REMOTE_ADDR']
            ]
        ]);
    }

    protected function createOwner(User $user) {

    }
}
