<?php

namespace Modules\Bookings\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected string $name = 'Bookings';

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
        $this->mapProviderRoutes();
        $this->mapCustomerRoutes();
        $this->mapAdminRoutes();
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapAdminRoutes(): void
    {
        Route::middleware('api')->prefix('api/admin')->name('api.')->group(module_path($this->name, '/routes/admin.php'));
    }

    /**
     * Define the "customer" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapCustomerRoutes(): void
    {
        Route::middleware('api')->prefix('api/customer')->name('api.')->group(module_path($this->name, '/routes/customer.php'));
    }

    /**
     * Define the "provider" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapProviderRoutes(): void
    {
        Route::middleware('api')->prefix('api/provider')->name('api.')->group(module_path($this->name, '/routes/provider.php'));
    }
}
