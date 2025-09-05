<?php

namespace App\Providers;

use App\Models\Toko;
use Illuminate\Support\ServiceProvider;
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
        $toko = Toko::first();

        View::share('toko', $toko);
    }
}
