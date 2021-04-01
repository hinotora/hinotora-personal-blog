<?php

namespace App\Providers;

use App\Composers\AsideComposer;
use Illuminate\Support\ServiceProvider;
use App\Composers\HeaderCategoryComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('blocks.header', HeaderCategoryComposer::class);
        view()->composer('blocks.aside', AsideComposer::class);
    }
}
