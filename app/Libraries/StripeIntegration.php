<?php


namespace App\Libraries;


use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

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

    public function getTransfersForDestination(string $destination) {
        try {
            return \Stripe\Transfer::all(['destination' => $destination, 'limit' => 100]);
        } catch (\Exception $exception) {
            Log::error('Error get stripe transfers: ' . $exception->getMessage());
        }
    }

    public function getPayoutsForDestination(string $connected_account) {

        $externalAccounts = \Stripe\Account::allExternalAccounts(
            $connected_account,
            ['object' => 'bank_account', 'limit' => 100]
        );
        $payouts = [];
        foreach($externalAccounts['data'] as $externalAccount) {
            try {
                $payoutsTmp = \Stripe\Payout::all(
                    ['destination' => $externalAccount->id, 'limit' => 100],
                    ['stripe_account' => $connected_account]);
                $payouts['data'] = $payoutsTmp['data'];
            } catch (\Exception $exception) {
                Log::error('Error get stripe transfers: ' . $exception->getMessage());
            }
        }

        return $payouts;

    }
}
