<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Site Name
    |--------------------------------------------------------------------------
    |
    | The name to use for the site
    | 
    */

    'site_name' => env('GETREALT_SITE_NAME', 'GetRealT'),
    
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
    
    /*
    |--------------------------------------------------------------------------
    | Leads Email
    |--------------------------------------------------------------------------
    |
    | When somebody fills out the contact agent form, a lead e-mail is sent.
    | Specify the e-mail address you want to receive this e-mail
    | 
    */

    'leads_email' => env('GETREALT_LEADS_EMAIL', null),
    
];