<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Mark one notification as read.
     */
    public function markAsRead(
        Request $request,
        string $id
    ): RedirectResponse {
        $notification = $request->user()
            ->notifications()
            ->whereKey($id)
            ->firstOrFail();

        $notification->markAsRead();

        $productId = $notification->data['product_id'] ?? null;

        if (
            $productId &&
            Product::whereKey($productId)->exists()
        ) {
            return redirect()->route(
                'admin.product.edit',
                $productId
            );
        }

        return redirect()->route('dashboard');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(
        Request $request
    ): RedirectResponse {
        $request->user()
            ->unreadNotifications()
            ->update([
                'read_at' => now(),
            ]);

        return back()->with(
            'success',
            'All notifications have been marked as read.'
        );
    }

    /**
     * Delete all notifications.
     */
    public function clearAll(
        Request $request
    ): RedirectResponse {
        $request->user()
            ->notifications()
            ->delete();

        return back()->with(
            'success',
            'All notifications have been cleared.'
        );
    }
}
