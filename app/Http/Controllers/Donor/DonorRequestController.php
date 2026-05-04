<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use App\Models\ProductRequest;
use Illuminate\Http\Request;

class DonorRequestController extends Controller
{
    public function donorRequests()
{
    $requests = ProductRequest::with(['product', 'beneficiary'])
        ->where('donor_id', auth()->id())
        ->latest()
        ->get();

    return view('pages.donor.request.index', compact('requests'));
}

public function updateRequestStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:accepted,rejected'
    ]);

    $productRequest = ProductRequest::where('donor_id', auth()->id())
        ->findOrFail($id);

    $productRequest->update([
        'status' => $request->status
    ]);

    return back()->with('success', 'Request updated successfully.');
}
}
