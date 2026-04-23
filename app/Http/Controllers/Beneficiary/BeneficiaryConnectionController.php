<?php

namespace App\Http\Controllers\Beneficiary;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use Illuminate\Http\Request;

class BeneficiaryConnectionController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'donor_id' => 'required|exists:users,id',
        ]);

        // prevent duplicate request
        $exists = Connection::where('product_id', $request->product_id)
            ->where('donor_id', $request->donor_id)
            ->where('beneficiary_id', auth()->id())
            ->first();

        if ($exists) {
            return back()->with('error', 'Request already sent');
        }

        Connection::create([
            'product_id' => $request->product_id,
            'donor_id' => $request->donor_id,
            'beneficiary_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return back()->with('success', 'Request sent successfully');
    }
}
