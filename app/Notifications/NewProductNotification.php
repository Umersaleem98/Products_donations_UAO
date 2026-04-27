<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewProductNotification extends Notification
{
   use Queueable;

    public $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database']; // IMPORTANT: use database (not mail unless needed)
    }

    /**
     * Store notification in database
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'New product added: ' . $this->product->name,
            'product_id' => $this->product->id,
            'user' => auth()->user()->name,
        ];
    }
}
