<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Dashboard' => 'App\Policies\DashboardPolicy',
        'App\Models\Company' => 'App\Policies\CompanyPolicy',
        'App\Models\Menu' => 'App\Policies\MenuPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Media' => 'App\Policies\MediaPolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\Pickup' => 'App\Policies\PickupPolicy',
        'App\Models\Mealtype' => 'App\Policies\MealtypePolicy',
        'App\Models\Showcase' => 'App\Policies\ShowcasePolicy',
        'App\Models\Timeslot' => 'App\Policies\TimeslotPolicy',
        'App\Models\Order' => 'App\Policies\OrderPolicy',
        'App\Models\OrderPickup' => 'App\Policies\OrderPickupPolicy',
        'App\Models\Payment' => 'App\Policies\PaymentPolicy',
        'App\Models\PickupSubscription' => 'App\Policies\SubscriptionPolicy',
        'App\Models\LoyaltyCardProduct' => 'App\Policies\LoyaltyCardProductPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();

    }
}
