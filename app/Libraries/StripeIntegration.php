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

    public function getTransfersForBalanceTransaction(string $destination, string $balance_transaction) {
        try {
            return \Stripe\Transfer::all([
                'destination' => $destination,
                'limit' => 100
            ]);
        } catch (\Exception $exception) {
            Log::error('Error get stripe transfers: ' . $exception->getMessage());
        }
    }

    public function getPayoutsForConnectedAccount(string $connected_account) {

        $externalAccounts = \Stripe\Account::allExternalAccounts(
            $connected_account,
            ['object' => 'bank_account', 'limit' => 100]
        );
        $payouts = [];
        if (isset($externalAccounts['data'])) {
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
        }

        return $payouts;

    }

    public function getPayoutDetail(string $payout_id, string $connected_account) {
                try {
                    $payout = \Stripe\Payout::retrieve(
                        $payout_id,
                        ['stripe_account' => $connected_account]);
                } catch (\Exception $exception) {
                    Log::error('Error get stripe transfers: ' . $exception->getMessage());
                }

        return $payout;

    }

    public function getBalanceForConnectedAccount(string $connected_account) {
        try {
            return \Stripe\Balance::retrieve(['stripe_account' => $connected_account]);
        } catch (\Exception $exception) {
            Log::error('Error get stripe balance: ' . $exception->getMessage());
        }
    }
    
    public function capturePayment(string $paymentIntentId){
        try{
            $intent = \Stripe\PaymentIntent::retrieve( $paymentIntentId );
            Log::info("-----START CAPTURE PAYMENT".$intent->status);
            // Confirm the PaymentIntent to collect the money
            $intent->confirm();
            if($intent->status == 'requires_capture') {
                Log::info("Charging the card for: " . $intent->amount_capturable);
                // Because capture_method was set to manual we need to manually capture in order to move the funds
                // You have 7 days to capture a confirmed PaymentIntent
                // To cancel a payment before capturing use .cancel() (https://stripe.com/docs/api/payment_intents/cancel)
                $intent->capture();
                return $intent->status;
            }
            else{
                Log::info("The intent status is " . $intent->status);
                $stripeResponse = new \StdClass();
                $stripeResponse->status = 'error';
                $stripeResponse->errors = "The intent status is " . $intent->status;
                return $stripeResponse;
            }
        } catch (\Throwable $exception) {
            Log::error("Unexpected error during the capture of payment. " . $exception->getMessage() );
            $stripeResponse = new \StdClass();
            $stripeResponse->status = 'error';
            $stripeResponse->errors = $exception->getMessage();
            return $stripeResponse;
        }
    }

    public function cancelPayment(string $paymentIntentId){
        try{
            $intent = \Stripe\PaymentIntent::retrieve( $paymentIntentId );
            Log::info("-----START CANCELING PAYMENT".$intent->status);
            // Confirm the PaymentIntent to collect the money
            //$intent->confirm();
            if($intent->status == 'requires_payment_method' || $intent->status == 'requires_capture' || $intent->status == 'requires_confirmation' || $intent->status == 'requires_action') {
                Log::info("PAYMENT CANCELED WITH THE AMOUNT OF: " . $intent->amount_capturable);
                // Because capture_method was set to manual we need to manually capture in order to move the funds
                // You have 7 days to capture a confirmed PaymentIntent
                // To cancel a payment before capturing use .cancel() (https://stripe.com/docs/api/payment_intents/cancel)
                $intent->cancel();
                return $intent->status;
            }
            else{
                Log::info("The intent status is " . $intent->status);
                $stripeResponse = new \StdClass();
                $stripeResponse->status = 'error';
                $stripeResponse->errors = "The intent status is " . $intent->status;
                return $stripeResponse;
            }
        } catch (\Throwable $exception) {
            Log::error("Unexpected error during the canceling of payment. " . $exception->getMessage() );
            $stripeResponse = new \StdClass();
            $stripeResponse->status = 'error';
            $stripeResponse->errors = $exception->getMessage();
            return $stripeResponse;
        }
    }

    public function updatePayment(string $paymentIntentId, $orderPickups, $commissionToPay){
        try{
            $intent = \Stripe\PaymentIntent::retrieve( $paymentIntentId );
            Log::info("-----START UPDATING THIS AMOUNT AND COMMISSION ".$orderPickups->totalOrderAmount." ".$orderPickups->totalPmuFeeAmount);
            // Confirm the PaymentIntent to collect the money
            // $intent->confirm();
            if($intent->status !== 'canceled') {
                Log::info("PAYMENT ABOUT TO BE UPDATED");
                $applicationFeeAmount = $orderPickups->totalPmuFeeAmount;
                if( $commissionToPay > 0.0 ){
                    return \Stripe\PaymentIntent::update( $paymentIntentId, ['amount' => $orderPickups->totalOrderAmount * 100] );
                } else {
                    return \Stripe\PaymentIntent::update( $paymentIntentId, ['amount' => $orderPickups->totalOrderAmount * 100,
                        'application_fee_amount' => $applicationFeeAmount
                    ] );
                }
            }
        } catch (\Throwable $exception) {
            Log::error("Unexpected error during the updating of payment. " . $exception->getMessage() );
            $stripeResponse = new \StdClass();
            $stripeResponse->status = 'error';
            $stripeResponse->errors = $exception->getMessage();
            return $stripeResponse;
        }
    }
}
