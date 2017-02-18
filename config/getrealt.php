<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Theme
    |--------------------------------------------------------------------------
    |
    | GetRealT uses Bootswatch themes
    | http://bootswatch.com/
    | 
    | Specify the theme you want applied in this setting
    | 
    */

    'theme' => env('GETREALT_THEME', 'united'),
    
    /*
    |--------------------------------------------------------------------------
    | Google Maps API Key
    |--------------------------------------------------------------------------
    |
    | GetRealT uses google maps to display a map on the listings page.
    | Obtain your key from;
    | https://developers.google.com/maps/documentation/javascript/get-api-key
    | 
    */

    'maps_key' => env('GETREALT_MAPS_KEY', null),
    
];