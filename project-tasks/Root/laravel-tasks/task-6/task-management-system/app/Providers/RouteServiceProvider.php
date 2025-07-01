<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Route;
use Vinkla\Hashids\Facades\Hashids;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
public function boot()
{
    Route::macro('prefixHashed', function ($prefix) {
        $hashedPrefix = Hashids::encodeHex($prefix);
        return Route::prefix($hashedPrefix);
    });
}
}
