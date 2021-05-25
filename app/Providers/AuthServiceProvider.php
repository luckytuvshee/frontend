<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Employee' => 'App\Policies\EmployeePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('see-product', '\App\Policies\EmployeePolicy@see_product');
        Gate::define('edit-product', '\App\Policies\EmployeePolicy@edit_product');
        Gate::define('see-users', '\App\Policies\EmployeePolicy@see_users');
        Gate::define('see-baskets', '\App\Policies\EmployeePolicy@see_baskets');
        Gate::define('alter-users', '\App\Policies\EmployeePolicy@alter_users');
        Gate::define('anything-employees', '\App\Policies\EmployeePolicy@anything_employees');
        Gate::define('anything-shipments', '\App\Policies\EmployeePolicy@anything_shipments');
        Gate::define('anything-address', '\App\Policies\EmployeePolicy@anything_address');
        Gate::define('see-reports', '\App\Policies\EmployeePolicy@see_reports');
    }
}
