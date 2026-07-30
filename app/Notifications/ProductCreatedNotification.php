<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProductCreatedNotification extends Notification
{
    use Queueable;

    public $product;

    // ✅ FIXED constructor
    public function __construct($product)
    {
        $this->product = $product;
    }

    // ✅ channels
    public function via($notifiable)
    {
        return ['database'];
    }

    // ❌ remove toMail if not using email (avoid confusion)

    // ✅ database payload
    public function toArray($notifiable)
    {
        return [
            'title' => 'New Product Created',
            'message' => 'Product "' . $this->product->name . '" created by donor.',
            'product_id' => $this->product->id,
            'created_by' => auth()->user()->name ?? 'Donor',
        ];
    }
}
