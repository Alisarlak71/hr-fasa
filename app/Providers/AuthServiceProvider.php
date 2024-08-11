<?php

namespace App\Providers;


use App\Models\Order;
use App\Models\UserVerificationRequest;
use App\Policies\OrderPolicy;
use App\Policies\UserInformationPolicy;
use App\Policies\UserVerificationRequestPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        UserInformationPolicy::class => UserInformationPolicy::class,
        UserVerificationRequest::class => UserVerificationRequestPolicy::class,
        Order::class => OrderPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

    }
}