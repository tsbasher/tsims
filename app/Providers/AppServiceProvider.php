<?php

namespace App\Providers;

use App\Http\View\Composers\FrontendComposer;
use App\Models\ProductGroup;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        //
        Paginator::useBootstrapFive();
        View::composer('frontend.*', FrontendComposer::class);
    }
}
