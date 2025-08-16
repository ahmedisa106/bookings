<?php

namespace Modules\Users\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected string $name = 'Users';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this->mapApiRoutes();
        $this->mapGuestRoutes();
        $this->mapProviderRoutes();
        $this->mapCustomerRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes(): void
    {
        Route::middleware('api')->prefix('api')->name('api.')->group(module_path($this->name, '/routes/api.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapGuestRoutes(): void
    {
        Route::middleware('api')->prefix('api')->name('api.')->group(module_path($this->name, '/routes/guest.php'));
    }

    /**
     * Define the "provider" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapProviderRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api/provider')->name('api.')
            ->group(module_path($this->name, '/routes/provider.php'));
    }

    /**
     * Define the "customer" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapCustomerRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api/customer')->name('api.')
            ->group(module_path($this->name, '/routes/customer.php'));
    }
}
