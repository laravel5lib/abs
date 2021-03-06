<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Model\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('export', function (User $user) {
            return $user->isAdmin() or $user->plan() === 'personal';
        });

        Gate::define('csv-import', function (User $user) {
            return $user->isAdmin() or $user->plan() === 'personal';
        });

        Gate::define('admin-voyager', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('notify-mail', function (User $user) {
            return true;
            //            return $user->plan() !== 'free';
        });
    }
}
