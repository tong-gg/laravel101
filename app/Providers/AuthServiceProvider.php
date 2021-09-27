<?php

namespace App\Providers;

use App\Models\Apartment;
use App\Models\User;
use App\Policies\ApartmentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Apartment::class => ApartmentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // params means, auth-user and model that you need to grant access -> return bool
//        using Gate
//        Gate::define('update-apartment', function(User $user, Apartment $apartment) {
//            return $user->isAdmin();
//        });
//
//        // create, no need model because you're constructing!
//        Gate::define('create-apartment', function (User $user) {
//            return $user->isAdmin();
//        });
//
//        Gate::define('create-room', function(User $user, Apartment $apartment) {
//           return $user->isAdmin() or ($user->isRole('OFFICER') && $user->id === $apartment->user_id);
//        });
    }
}
