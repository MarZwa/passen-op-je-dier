<?php

namespace App\Providers;

use App\Models\Pet;
use App\Models\User;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Request as RequestModel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('get-pet-requests', function (User $user, Pet $pet) {
            return $user->id === $pet->owner_id;
        });

        Gate::define('create-pet-request', function (User $user, Pet $pet) {
            return $user->id === $pet->owner_id;
        });

        Gate::define('destroy-request', function (User $user, RequestModel $request) {
            return $user->id === $request->pet->owner_id || $user->role === 'Admin';
        });

        Gate::define('store-assets', function (User $user, Request $request) {
            return $user->id === intval($request->user_id);
        });

        Gate::define('destroy-pet', function (User $user, Pet $pet) {
            return $user->id === $pet->owner_id || $user->role === 'Admin';
        });

        Gate::define('get-request-registrations', function (User $user, RequestModel $request) {
            return $user->id === $request->pet->owner_id;
        });

        Gate::define('answer-registration', function (User $user, Registration $registration) {
            return $user->id === $registration->request->pet->owner_id;
        });

        Gate::define('destroy-registration', function (User $user, Registration $registration) {
            return $user->id === $registration->user_id;
        });

        Gate::define('is-owner', function (User $user) {
            return $user->role === 'Owner';
        });

        Gate::define('is-sitter', function (User $user) {
            return $user->role === 'Sitter';
        });

        Gate::define('is-admin', function (User $user) {
            return $user->role === 'Admin';
        });
    }
}
