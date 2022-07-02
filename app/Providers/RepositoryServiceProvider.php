<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Admin\UserRepository', 'App\Repositories\Admin\UserRepositoryEloquent');
        $this->app->bind('App\Repositories\Admin\MenuRepository', 'App\Repositories\Admin\MenuRepositoryEloquent');
        $this->app->bind('App\Repositories\Admin\PageRepository', 'App\Repositories\Admin\PageRepositoryEloquent');
        $this->app->bind('App\Repositories\Admin\PageSectionRepository', 'App\Repositories\Admin\PageSectionRepositoryEloquent');
        $this->app->bind('App\Repositories\Admin\PageColumnRepository', 'App\Repositories\Admin\PageColumnRepositoryEloquent');
        $this->app->bind('App\Repositories\Admin\PageRowRepository', 'App\Repositories\Admin\PageRowRepositoryEloquent');
        $this->app->bind('App\Repositories\Admin\PageStaticRepository', 'App\Repositories\Admin\PageStaticRepositoryEloquent');
        $this->app->bind('App\Repositories\Admin\OrderRepository', 'App\Repositories\Admin\OrderRepositoryEloquent');
        $this->app->bind('App\Repositories\Admin\ShipmentRepository', 'App\Repositories\Admin\ShipmentRepositoryEloquent');
        $this->app->bind('App\Repositories\Admin\OrderNoteRepository', 'App\Repositories\Admin\OrderNoteRepositoryEloquent');

        $this->app->bind('App\Repositories\Admin\ConfigRepository', 'App\Repositories\Admin\ConfigRepositoryEloquent');
        $this->app->bind('App\Repositories\Admin\SettingsBrandRepository', 'App\Repositories\Admin\SettingsBrandRepositoryEloquent');
        $this->app->bind('App\Repositories\Admin\ProductRepository', 'App\Repositories\Admin\ProductRepositoryEloquent');
        $this->app->bind('App\Repositories\Admin\ProductPhotoRepository', 'App\Repositories\Admin\ProductPhotoRepositoryEloquent');
        $this->app->bind('App\Repositories\Admin\PageMetaTagRepository', 'App\Repositories\Admin\PageMetaTagRepositoryEloquent');

        // Customer
        $this->app->bind('App\Repositories\Customer\CustomerRepository', 'App\Repositories\Customer\CustomerRepositoryEloquent');
        $this->app->bind('App\Repositories\Customer\CustomerAddressRepository', 'App\Repositories\Customer\CustomerAddressRepositoryEloquent');
        $this->app->bind('App\Repositories\Customer\DeviceRepository', 'App\Repositories\Customer\DeviceRepositoryEloquent');
        $this->app->bind('App\Repositories\Customer\StateRepository', 'App\Repositories\Customer\StateRepositoryEloquent');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
