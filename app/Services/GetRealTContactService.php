<?php

namespace Timitek\GetRealT\Services;

use App;
use Config;
use Artisan;
use Yab\Quarx\Repositories\WidgetRepository;

class GetRealTContactService {
    
    public function getContact() {
        $output = (object) [
                    'address_line1' => '',
                    'address_line2' => '',
                    'phone' => '',
                    'email' => '',
                    'facebook' => '',
                    'twitter' => '',
                    'youtube' => '',
                    'google_plus' => '',
                    'linkedin' => ''
        ];

        try {
            $currentWidget = WidgetRepository::getWidgetBySLUG('contact');
            if (!empty($currentWidget)) {
                $lines = explode("\n", $currentWidget->content);
                if (!empty($lines)) {
                    $firstLine = $lines[0];
                    if (strpos($firstLine, "<!--contact:") === 0) {
                        $serialized = str_replace("-->", "", str_replace("<!--contact:", "", $firstLine));
                        $output = unserialize($serialized);
                    }
                }
            }
        } catch (\Exception $e) {
            
        }

        return $output;
    }
    
    public function saveContact($details) {
            
        $serialized = serialize($details);

        $phone = empty($details->phone) ? '' :
'        <div class="contact-phone">
            <i class="fa fa-phone"></i> 
            ' . $details->phone . '
        </div>';
            
            $social = empty($details->facebook) && empty($details->twitter) && empty($details->youtube) && empty($details->google_plus) && empty($details->linkedin) ? '' : 
'    <div class="social-icons">
        ' . (empty($details->facebook) ? '' : '<a href="' . $details->facebook . '" target="_blank"><i class="fa fa-facebook"></i></a>') . '
        ' . (empty($details->twitter) ? '' : '<a href="' . $details->twitter . '" target="_blank"><i class="fa fa-twitter"></i></a>') . '
        ' . (empty($details->youtube) ? '' : '<a href="' . $details->youtube . '" target="_blank"><i class="fa fa-youtube"></i></a>') . '
        ' . (empty($details->google_plus) ? '' : '<a href="' . $details->google_plus . '" target="_blank"><i class="fa fa-google-plus"></i></a>') . '
        ' . (empty($details->linkedin) ? '' : '<a href="' . $details->linkedin . '" target="_blank"><i class="fa fa-linkedin"></i></a>') . '
    </div>';
            
            $content =
'<!--contact:' . $serialized . '-->
<div class="contact">
    <address>
        <div class="contact-mailing">
            <i class="fa fa-map-marker"></i>
            ' . $details->address_line1 . '<br>
            ' . $details->address_line2 . '
        </div>' . $phone . '
        <div class="contact-email">
            <i class="fa fa-envelope-open"></i> 
            <a href="mailto:' . $details->email . '">' . $details->email . '</a>
        <div>
    </address>' . $social . '
</div>';
            
            
        $currentWidget = WidgetRepository::getWidgetBySLUG('contact');
        if (empty($currentWidget)) {
            $widgetRepo = new WidgetRepository();
            $widgetRepo->store([
                'name' => 'Contact',
                'slug' => 'contact',
                'content' => $content
            ]);
        }
        else {
            $widgetRepo = new WidgetRepository();
            $widgetRepo->update($currentWidget, ['content' => $content]);
        }
        
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
                'placeholder' => 'Link your Facebook page',
            ],
            'twitter' => [
                'placeholder' => 'Link your Twitter page',
            ],
            'youtube' => [
                'placeholder' => "Link your YouTube page"
            ],
            'google_plus' => [
                'placeholder' => "Link your Google+ page"
            ],
            'linkedin' => [
                'placeholder' => "Link your LinkedIn page"
            ]
        ];
    }

}
