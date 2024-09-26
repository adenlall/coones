<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

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
        if (config('app.debug')) {

            DB::listen(function ($query) {
                Log::debug('SQL Query Executed: ' . $query->sql . ' [Bindings: ' . implode(', ', $query->bindings) . '] (Time: ' . $query->time . 'ms)');
            });

        }
    }
}
