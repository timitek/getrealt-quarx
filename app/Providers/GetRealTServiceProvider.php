<?php

namespace Timitek\GetRealT\Providers;

use App;
use Config;
use Lang;
use Blade;
use Quarx;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Timitek\GetRealT;
use Timitek\GetRealT\Facades\GetRealTServiceFacade;
use Timitek\GetRealT\Facades\GetRealTFrontEndServiceFacade;
use Timitek\GetRealT\Services\GetRealTService;
use Timitek\GetRealT\Services\GetRealTFrontEndService;

class GetRealTServiceProvider extends ServiceProvider
{
    protected function registerAliases() {
        $loader = AliasLoader::getInstance();

        $loader->alias('GetRealT', GetRealTServiceFacade::class);
        
        $loader->alias('GetRealTFrontEnd', GetRealTFrontEndServiceFacade::class);
    }
    
    protected function registerServices() {
        $this->app->bind('GetRealT', function ($app) {
            return new GetRealTService();
        });
        
        $this->app->bind('GetRealTFrontEnd', function ($app) {
            return new GetRealTFrontEndService();
        });
    }
    
    protected function loadResources() {
        $this->loadRoutesFrom(realpath(__DIR__.'/../../routes/web.php'));
        $this->loadTranslationsFrom(realpath(__DIR__.'/../../resources/lang'), 'GetRealT');
        $this->loadMigrationsFrom(realpath(__DIR__.'/../../database/migrations'));
        $this->loadViewsFrom(realpath(__DIR__.'/../../resources/views'), 'GetRealT');
    }
    
    protected function loadPublishes() {
        $this->publishes([realpath(__DIR__.'/../../config') => config_path('')], 'config');
        $this->publishes([realpath(__DIR__.'/../../resources/assets/themes') => public_path('assets') . '/themes'], 'public');
        $this->publishes([realpath(__DIR__.'/../../resources/lang') => resource_path('lang/vendor/timitek')], 'translations');
        $this->publishes([realpath(__DIR__.'/../../resources/views') => base_path('resources/views/vendor/timitek/getrealt')], 'views');
        $this->publishes([realpath(__DIR__.'/../../database/migrations') => database_path('migrations')], 'migrations');
        $this->publishes([realpath(__DIR__.'/../../database/seeds') => database_path('seeds')], 'seeds');
    }

    protected function registerDirectives() {
        Blade::directive('mainMenu', function ($expression) {
            return "<?php echo GetRealTFrontEnd::mainMenu(); ?>";
        });
    }
    
    private function addQuarxMenu($menu) {                
        $packageViews = Config::get('quarx.package-menus');

        if (is_null($packageViews)) {
            $packageViews = [];
        }

        $menuView = realpath(__DIR__.'/../../resources/views/quarx/') . $menu;

        if (!in_array($menuView, $packageViews)) {
            array_push($packageViews, $menuView);
            Config::set('quarx.package-menus', $packageViews);
        }
    }
    
    protected function registerQuarxModule() {
        $this->addQuarxMenu('/getrealt/menu.php');
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAliases();
        $this->registerServices();
    }

    /**
     * Register routes, translations, views and publishers.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadResources();
        $this->loadPublishes();
        $this->registerDirectives();
        $this->registerQuarxModule();        
    }
}
