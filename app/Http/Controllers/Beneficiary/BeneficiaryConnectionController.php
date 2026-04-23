<?php

namespace App\Http\Controllers\Beneficiary;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use Illuminate\Http\Request;

class BeneficiaryConnectionController extends Controller
{
   public function send(Request $request, $donorId)
{
    $user = auth()->user();

    // Only beneficiary allowed
    if ($user->role !== 'beneficiary') {
        abort(403);
    }

    // Prevent self request
    if ($user->id == $donorId) {
        return back()->with('error', 'Invalid request');
    }

    // Check existing connection
    $connection = Connection::where([
        'beneficiary_id' => $user->id,
        'donor_id' => $donorId
    ])->first();

    if ($connection) {
        if ($connection->status === 'pending') {
            return back()->with('error', 'Request already pending');
        }

        if ($connection->status === 'accepted') {
            return back()->with('success', 'Already connected');
        }

        if ($connection->status === 'rejected') {
            // Allow resend → update status
            $connection->update(['status' => 'pending']);
            return back()->with('success', 'Request sent again');
        }
    }

    // Create new request
    Connection::create([
        'beneficiary_id' => $user->id,
        'donor_id' => $donorId,
        'status' => 'pending'
    ]);

    return back()->with('success', 'Request sent successfully');
}
}
