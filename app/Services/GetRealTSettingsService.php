<?php

namespace Timitek\GetRealT\Services;

use App;
use Config;
use Artisan;
use Yab\Quarx\Repositories\ImageRepository;

class GetRealTSettingsService {
    
     /**
     * Set the in the environment file.
     *
     * @param  string  $key
     * @return void
     */
    private function setEnvironmentValue($environmentKey, $configKey, $newValue) {
        $replace = $environmentKey . '=' . $newValue;
        
        // Replace it if it is an existing key
        if (strpos(file_get_contents(App::environmentFilePath()), $environmentKey) !== false) {
            $existingValue = config($configKey);
            $existingValue = (is_bool($existingValue) ? ($existingValue ? 'true' : 'false') : $existingValue);
            $find = $environmentKey . '=' . $existingValue;
            $findQuoted = $environmentKey . '="' . $existingValue . '"';

            file_put_contents(App::environmentFilePath(), str_replace(
                $find,
                $replace,
                file_get_contents(App::environmentFilePath())
            ));

            file_put_contents(App::environmentFilePath(), str_replace(
                $findQuoted,
                $replace,
                file_get_contents(App::environmentFilePath())
            ));
        }
        // Append it if it is a new key
        else {
            file_put_contents(App::environmentFilePath(), $replace . PHP_EOL, FILE_APPEND);
        }

        Config::set($configKey, $newValue);
        
        // Reload the cached config       
        if (file_exists(App::getCachedConfigPath())) {
            Artisan::call("config:cache");
        }
    }
    
    public function setSiteName($name) {
        $this->setEnvironmentValue('GETREALT_SITE_NAME', 'getrealt.site_name', '"' . $name . '"');
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
    
    public function setGetRealTMapsKey($mapsKey) {
        $this->setEnvironmentValue('GETREALT_MAPS_KEY', 'getrealt.maps_key', $mapsKey);
    }
    
    public function setGetRealTLeadsEmail($email) {
        $this->setEnvironmentValue('GETREALT_LEADS_EMAIL', 'getrealt.leads_email', $email);
    }

    public function setGetRealTHeaderImageTag($tag) {
        $this->setEnvironmentValue('GETREALT_HEADER_IMAGE_TAG', 'getrealt.header_image_tag', $tag);
    }

    public function setGetRealTAdvancedEdit($enable) {
        $this->setEnvironmentValue('GETREALT_ADVANCED_EDIT', 'getrealt.advanced_edit', ($enable ? 'true' : 'false'));
    }
    
    
    public function getSettings() {
        return (object)[
            'site_name' => config('getrealt.site_name'),
            'customer_key' => config('getrets.customer_key'),
            'enable_example' => config('getrets.enable_example'),
            'maps_key' => config('getrealt.maps_key'),
            'leads_email' => config('getrealt.leads_email'),
            'theme' => config('getrealt.theme'),
            'header_image_tag' => config('getrealt.header_image_tag'),
            'advanced_edit' => config('getrealt.advanced_edit'),
        ];
    }

    public function getSettingsForm() {
        $imageRepo = new ImageRepository();
        $headerImageTags = array_merge([ 'none' ], $imageRepo->allTags());
        $headerImageTagOptions = collect($headerImageTags)->flatMap(function ($values) { 
            return [$values => $values]; 
        })->all();
        
        return [
            'site_name' => [
                'placeholder' => 'The name to be used for your site',
            ],
            'customer_key' => [
                'placeholder' => 'Customer Key from timitek.com',
            ],
            'advanced_edit' => [
                'type' => 'checkbox-inline',
                'label' => 'Advanced Edit',
                'before' => '<span></span>',
            ],
            /*'enable_example' => [
                'type' => 'checkbox',
            ],*/
            'maps_key' => [
                'placeholder' => 'Google Maps API Key',
            ],
            'leads_email' => [
                'placeholder' => 'Email address that leads are sent too',
            ],
            'header_image_tag' => [
                'type' => 'select',
                'options' => $headerImageTagOptions,
            ],
            'theme' => [
                'type' => 'select',
                'options' => [
                    'cerulean' => 'cerulean',
                    'cosmo' => 'cosmo',
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
            ],
        ];
    }

}
