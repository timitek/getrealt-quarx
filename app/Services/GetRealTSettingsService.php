<?php

namespace Timitek\GetRealT\Services;

use App;
use Config;
use Artisan;

class GetRealTSettingsService {
    
     /**
     * Set the in the environment file.
     *
     * @param  string  $key
     * @return void
     */
    private function setEnvironmentValue($environmentKey, $configKey, $newValue) {
        $existingValue = config($configKey);
        $existingValue = (is_bool($existingValue) ? ($existingValue ? 'true' : 'false') : $existingValue);
        $find = $environmentKey . '=' . $existingValue;
        $replace = $environmentKey . '=' . $newValue;
        file_put_contents(App::environmentFilePath(), str_replace(
            $find,
            $replace,
            file_get_contents(App::environmentFilePath())
        ));

        Config::set($configKey, $newValue);
        
        // Reload the cached config       
        if (file_exists(App::getCachedConfigPath())) {
            Artisan::call("config:cache");
        }
    }
    
    public function setCustomerKey($customerKey) {
        $this->setEnvironmentValue('GETRETS_CUSTOMER_KEY', 'getrets.customer_key', $customerKey);
    }
    
    public function setEnableExample($enable) {
        $this->setEnvironmentValue('GETRETS_ENABLE_EXAMPLE', 'getrets.enable_example', ($enable ? 'true' : 'false'));
    }
    
    public function setGetRealTTheme($theme) {
        $this->setEnvironmentValue('GETREALT_THEME', 'getrealt.theme', $theme);
    }
    
    public function getSettings() {
        return (object)[
            'customer_key' => config('getrets.customer_key'),
            'enable_example' => config('getrets.enable_example'),
            'theme' => config('getrealt.theme')
        ];
    }

    public function getSettingsForm() {
        return [
            'customer_key' => [
                'placeholder' => 'Customer Key from timitek.com',
            ],
            'enable_example' => [
                'type' => 'checkbox',
            ],
            'theme' => [
                'type' => 'select',
                'options' => [
                    'cerulean' => 'cerulean',
                    'cosmo' => 'cosmo',
                    'custom' => 'custom',
                    'cyborg' => 'cyborg',
                    'darkly' => 'darkly',
                    'flatly' => 'flatly',
                    'journal' => 'journal',
                    'lumen' => 'lumen',
                    'paper' => 'paper',
                    'readable' => 'readable',
                    'sandstone' => 'sandstone',
                    'simplex' => 'simplex',
                    'slate' => 'slate',
                    'spacelab' => 'spacelab',
                    'superhero' => 'superhero',
                    'united' => 'united',
                    'yeti' => 'yeti'
                ]
            ]
        ];
    }

}
