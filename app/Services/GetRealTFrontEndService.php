<?php

namespace Timitek\GetRealT\Services;

use Quarx;

class GetRealTFrontEndService {
    
    public function mainMenu() {
        $output = "";
        
        $mainMenu = Quarx::menu('main');
        if (!empty($mainMenu)) {
            $output = str_replace( '</a>', '</a></li>', str_replace( '<a ', '<li><a ', $mainMenu));
        }
        else {
            $output = "<li><a href='" . url('listings') . "'>Listings</a></li>" .
                      "<li><a href='" . url('blog') . "'>Blog</a></li>" .
                      "<li><a href='" . url('gallery') . "'>Gallery</a></li>" .
                      "<li><a href='" . url('faqs') . "'>FAQs</a></li>" .
                      "<li><a href='" . url('events') . "'>Events</a></li>";
        }
        
        return $output;
    }
    
}
