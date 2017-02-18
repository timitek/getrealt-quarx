<?php

namespace Timitek\GetRealT\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LeadCaptured extends Notification
{
    use Queueable;
    
    private $info;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = '/listings/' . $this->info->listingType . '_' . $this->info->listingSource . '_' . $this->info->listingID;
        return (new MailMessage)
                    ->greeting('Lead Captured!')
                    ->line('A ' . $this->info->listingType . ' lead has been captured for listing ' . $this->info->listingID . ' (' . $this->info->listingSource . ').')
                    ->line('Name: ' . (empty($this->info->name) ? 'Not Given' : $this->info->name))
                    ->line('Phone: ' . (empty($this->info->phone) ? 'Not Given' : $this->info->phone))
                    ->line('Email: ' . (empty($this->info->email) ? 'Not Given' : $this->info->email))
                    ->line('Message: ' . (empty($this->info->message) ? 'Not Given' : $this->info->message))
                    ->action('View Listing', url($url))
                    ->line('Thank you for using GetRealT!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'listing_source' => $this->info->listingSource,
            'listing_type' => $this->info->listingType,
            'listing_id' => $this->info->listingID,
            'lead_name' => $this->info->name,
            'lead_phone' => $this->info->phone,
            'lead_email' => $this->info->email,
            'lead_message' => $this->info->message
        ];
    }
}
