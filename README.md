﻿# getrealt-quarx


An instant real estate website / portal.  Fully integrated with listings fed directly from your MLS, with the ability to generate your own leads!

**Live Demo at**: (<http://www.getrealt.com>)

**Help Documentation at**: (<http://help.getrealt.com>)

***

# Table of Contents
* [Compatibility Guide](#compatibility-guide)
* [Install](#install)
  * [Automated Install From Scratch](#automated-install-from-scratch)
  * [Manually adding to an existing project](#manually-adding-to-an-existing-project)
* [Further Information](#further-information)
* [Technonology Stack](#technonology-stack)

***

# Compatibility Guide

| Laravel Version | Package Tag |
|-----------------|-------------|
| 5.5.x | 1.1.x |
| 5.4.x | [1.0.x](<https://github.com/timitek/getrealt-quarx/releases/tag/1.0.4>) |

# Install

## Automated Install From Scratch
A command line install tool that will install everything from scratch is available for download at;
<https://github.com/timitek/getrealt-manager>

## Manually adding to an existing project

Manual installation requires a configured Laravel installation with Quarx and GetRETS.

**Step 1:** Install Laravel (<https://laravel.com/docs/>).

**Step 2:** Install Quarx (<https://github.com/YABhq/Quarx#installation>).

**Step 3:** Install GetRealT for Quarx

```
composer require timitek/getrealt-quarx
```

*alternatively, for the latest bleeding edge development version use*

```
composer require timitek/getrealt-quarx:dev-master --dev
```

**Note**: *For Laravel 5.4 and older it is necessary to add the following to the providers section within config/app.php.*

```php
Timitek\GetRETS\Providers\GetRETSServiceProvider::class,
```

Make GetRealT the active Quarx theme by modifying the config/quarx.php and changing the value for the frontend-theme.

```php
'frontend-theme' => '../../vendor/timitek/getrealt-quarx/resources/views/theme'
```

Publish all of the assets with the following commands.

```
php artisan vendor:publish --provider="Timitek\GetRETS\Providers\GetRETSServiceProvider" --tag=config --force

php artisan vendor:publish --provider="Timitek\GetRealT\Providers\GetRealTServiceProvider" --tag=config --force

php artisan vendor:publish --provider="Timitek\GetRealT\Providers\GetRealTServiceProvider" --tag=public --force
```

**Step 5:** Configure your site.

All of these settings can be configured directly from the quarx admin dashboard once your website is up and running from the GetRealT menu at /quarx/getrealt/settings.  However you may also manually modify the settings within the .env file.

**.env file note**: *If you modify the .env file directly, any values within the .env file that have spaces in them must be wrapped in double quotes ""*

**Map note**: *In order to display the maps on the listing details pages, obtain a google maps API key <https://developers.google.com/maps/documentation/javascript/get-api-key>*

Add values for the following settings to your .env file.

**GETRETS_CUSTOMER_KEY** = the customer key provided to you by timitek.com

**GETREALT_SITE_NAME** = What is the name you would like to use in the sites banner as the site name?

**GETREALT_THEME** = What is the initial theme you would like to use for the site?

**GETREALT_MAPS_KEY** = What is your google maps api key? <https://developers.google.com/maps/documentation/javascript/get-api-key>

**GETREALT_LEADS_EMAIL** = What e-mail address do you want your leads sent too?
                    

```
GETRETS_CUSTOMER_KEY=your_customer_key_from_timitek
GETREALT_SITE_NAME=GetRealT
GETREALT_THEME=united
GETREALT_MAPS_KEY=(Your Google maps API Key)
GETREALT_LEADS_EMAIL=support@timitek.com
```

***

# Further Information

For further documentation and information visit <http://www.getrealt.com> and <http://help.getrealt.com> or contact timitek at <http://www.timitek.com/getrealt>.
If you are interested in managed hosting / installation, visit <https://www.timitek.net>.

***


# Technonology Stack

**PHP Web Framework**: Laravel (<https://www.laravel.com/>)

**Content Management Library**: Quarx (<https://quarxcms.com/>)

**Listing Integration**: The Laravel module is provided by getrets-laravel (<https://github.com/timitek/getrets-laravel>)

**Cloud based RETS listing data API**: GetRETS (<http://www.timitek.com/>) - *A customer key is required for listing integration*
