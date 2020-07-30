<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Validator::extend('allowed_email', function($attribute, $value, $parameters, $validator) {
            $allowedEmails = DB::table('user_emails')->pluck('email')->toArray();
            return in_array($value, $allowedEmails);
        }, 'Το E-mail δεν είναι έγκυρο για εγγραφή στην πλατφόρμα.');

        Gate::define('admin', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('supervisor', function ($user) {
            return $user->hasAnyRoles([
                'admin',
                'epoptis',
            ]);
        });

        Gate::define('doy', function ($user) {
            return $user->hasAnyRoles([
                'admin',
                'doy',
            ]);
        });

        Gate::define('epitropi', function ($user) {
            return $user->hasAnyRoles([
                'admin',
                'epitropi',
            ]);
        });

        Gate::define('create-shifts', function ($user) {
            return $user->hasAnyRoles([
                'admin',
                'doy',
                'epoptis',
            ]);
        });

        Gate::define('view-shifts', function ($user) {
            return $user->hasAnyRoles([
                'admin',
                'epoptis',
                'epistatis',
                'doy',
                'epitropi'
            ]);
        });

        Gate::define('confirm-shifts', function ($user) {
            return $user->hasAnyRoles([
                'admin',
                'epoptis',
                'epitropi'
            ]);
        });

        Gate::define('confirm-shifts-steward', function ($user) {
            return $user->hasAnyRoles([
                'admin',
                'epistatis',
                'epoptis',
            ]);
        });

        Gate::define('edit-shifts', function ($user) {
            return $user->hasAnyRoles([
                'admin',
            ]);
        });

        Gate::define('assign-shifts', function ($user) {
            return $user->hasAnyRoles([
                'admin',
                'epistatis',
                'epoptis',
            ]);
        });

        Gate::define('manage-shifts', function ($user) {
            return $user->hasAnyRoles([
                'admin',
                'epoptis',
                'epistatis',
                'epitropi',
            ]);
        });

        Gate::define('manage-security', function ($user) {
            return $user->hasAnyRoles([
                'admin',
                'epitropi',
                'doy',
            ]);
        });

        Gate::define('create-guard', function ($user) {
            return $user->hasAnyRoles([
                'admin',
                'doy',
                'epoptis',
            ]);
        });

        Gate::define('see-all', function ($user) {
            return $user->hasAnyRoles([
                'admin',
                'epitropi',
                'doy'
            ]);
        });

        Gate::define('use-application', function ($user) {
            return $user->hasAnyRoles([
                'admin',
                'epoptis',
                'epistatis',
                'doy',
                'epitropi',
                'user',
            ]);
        });
    }
}
