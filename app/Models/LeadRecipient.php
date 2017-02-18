<?php

namespace Timitek\GetRealT\Models;

use Illuminate\Notifications\Notifiable;

class LeadRecipient {

    use Notifiable;
    
    public $email = null;
    
    public function __construct() {
        $this->email = config('getrealt.leads_email');
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }    
}