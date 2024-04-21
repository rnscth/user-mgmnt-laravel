<?php
// AuthServiceProvider.php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-user', function (User $user, User $targetUser) {
            // Allow users with isAdmin property set to '1' to update other users
            return $user->isAdmin === 1 && $user->enabled === 1;
        });

        Gate::define('delete-user', function (User $user, User $targetUser) {

            // Allow users with isAdmin property set to '1' to delete other users
            return $user->isAdmin === 1 && $user->enabled && $user->id != $targetUser->id;
        });
    }
}
