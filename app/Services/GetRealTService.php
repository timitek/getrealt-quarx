<?php

namespace Timitek\GetRealT\Services;

use App;
use Config;
use Artisan;

class GetRealTService {
    
     /**
     * Set the application key in the environment file.
     *
     * @param  string  $key
     * @return void
     */
    private function setEnvironmentValue($environmentName, $configKey, $newValue) {
        /*
            file_put_contents($this->laravel->environmentFilePath(), str_replace(
                'APP_KEY='.$this->laravel['config']['app.key'],
                'APP_KEY='.$key,
                file_get_contents($this->laravel->environmentFilePath())
            ));
         */
        file_put_contents(App::environmentFilePath(), str_replace(
            $environmentName . '=' . Config::get($configKey),
            $environmentName . '=' . $newValue,
            file_get_contents(App::environmentFilePath())
        ));
        
        Config::set($configKey, $newValue);
        
        // Reload the cached config       
        if (file_exists($cached = App::getCachedConfigPath())) {
            Artisan::call("config:cache");
        }
        
    }
    
    public function setCustomerKey($customerKey) {
        $this->setEnvironmentValue('GETRETS_CUSTOMER_KEY', 'getrets.customer_key', $customerKey);
    }
    
    public function setEnableExample($enable) {
        $this->setEnvironmentValue('GETRETS_ENABLE_EXAMPLE', 'getrets.enable_example', $enable);
    }
    
    public function setGetRealTTheme($theme) {
        $this->setEnvironmentValue('GETREALT_THEME', 'getrealt.theme', $theme);
    }
}
