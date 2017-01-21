<?php

namespace Timitek\GetRealT\Providers;

use App;
use Config;
use Illuminate\Support\ServiceProvider;
use Lang;
use Timitek\GetRealT;
use Timitek\GetRealT\Facades\GetRealTFacade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;

class GetRealTServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('GetRealT', GetRealTFacade::class);
    }

    /**
     * Register routes, translations, views and publishers.
     *
     * @return void
     */
    public function boot(DispatcherContract $events, Router $router)
    {
        $this->loadRoutesFrom(realpath(__DIR__.'/../../routes/web.php'));

        $this->loadTranslationsFrom(realpath(__DIR__.'/../../resources/lang'), 'GetRealT');
        $this->publishes([realpath(__DIR__.'/../../resources/lang') => resource_path('lang/vendor/timitek')], 'translations');

        $this->loadViewsFrom(realpath(__DIR__.'/../../resources/views'), 'GetRealT');
        $this->publishes([realpath(__DIR__.'/../../resources/views') => base_path('resources/views/vendor/timitek/getrealt')], 'views');

        $this->loadMigrationsFrom(realpath(__DIR__.'/../../database/migrations'));
        $this->publishes([realpath(__DIR__.'/../../database/migrations') => database_path('migrations')], 'migrations');

        $this->publishes([realpath(__DIR__.'/../../resources/assets/themes') => public_path('assets')], 'public');

        $this->publishes([realpath(__DIR__.'/../../config') => config_path('')], 'config');

        $this->publishes([realpath(__DIR__.'/../../database/seeds') => database_path('seeds')], 'seeds');


        // View namespace
        View::addNamespace('getrealt', __DIR__.'/Views');

        // Configs
        Config::set('quarx.modules.getrealt', include(__DIR__.'/config.php'));

    }
}
