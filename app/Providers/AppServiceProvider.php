<?php

namespace App\Providers;

use App\Events\BookingCreated;
use App\Listeners\BookingCreatedListner;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Users\Enums\UserRoleEnum;
use Modules\Users\Models\User;

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
        Event::listen(BookingCreated::class, BookingCreatedListner::class);

        Gate::before(function (User $user, string $ability) {
            if ($user->role == UserRoleEnum::ADMIN) {
                return true;
            }
        });

        Gate::define('store-services', function (User $user) {
            return $user->role == UserRoleEnum::PROVIDER;
        });
    }
}
