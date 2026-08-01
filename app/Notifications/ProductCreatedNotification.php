<?php

namespace App\Notifications;

use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProductCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected Product $product,
        protected User $donor
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'product_created',
            'title' => 'New Product Submitted',

            'message' => $this->donor->name
                . ' submitted a new product: '
                . $this->product->name . '.',

            'product_id' => $this->product->id,
            'product_name' => $this->product->name,

            'created_by_id' => $this->donor->id,
            'created_by_name' => $this->donor->name,
            'created_by_role' => $this->donor->role,

            'donor_id' => $this->donor->id,
            'donor_name' => $this->donor->name,
            'donor_role' => $this->donor->role,

            'icon' => 'bi-box-seam',
        ];
    }

    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}
