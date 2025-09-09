<?php

namespace App\Providers;

use App\Models\Toko;
use Illuminate\Support\ServiceProvider;
use Schema;
use View;

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
        //
        if (Schema::hasTable('tokos')) {
            $toko = Toko::first();

            View::share('toko', $toko);
        }
    }
}
