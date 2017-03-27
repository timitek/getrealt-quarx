<?php

namespace Timitek\GetRealT\Services;

use App;
use Config;
use Artisan;

class GetRealTContactService {
    
    public function getContact() {
        return (object)[
            'address_line1' => '215 North Washington',
            'address_line2' => 'EL Dorado, Arkansas 71730',
            'phone' => '(501) 779-8464',
            'email' => 'support@timitek.com',
            'facebook' => 'https://www.facebook.com/timitek.llc',
            'twitter' => 'https://twitter.com/timitek_llc'
        ];
    }

    public function getContactForm() {
        return [
            'address_line1' => [
                'placeholder' => 'Line 1 of the address',
            ],
            'address_line2' => [
                'placeholder' => 'Line 2 of the address',
            ],
            'phone' => [
                'placeholder' => 'Phone Number',
            ],
            'email' => [
                'placeholder' => 'Email address',
            ],
            'facebook' => [
                'placeholder' => 'Facebook URL',
            ],
            'twitter' => [
                'placeholder' => 'Twitter URL',
            ],
        ];
    }

}
