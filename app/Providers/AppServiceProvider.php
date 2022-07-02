<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Admin\Menu;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
        // $footermenus = \App\Models\Admin\Menu::where('bottom_display', 1)->get();
        // View::share('footermenus', $footermenus);
        Paginator::useBootstrap();
    }
}
