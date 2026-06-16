<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use App\Models\ProductRequest;
use Illuminate\Http\Request;

class DonorRequestController extends Controller
{
     public function donorRequests()
    {
        $requests = ProductRequest::with([
                'product',
                'beneficiary',
                'beneficiary.beneficiaryProfile'
            ])
            ->where('donor_id', auth()->id())
            ->where('admin_status', 'approved')
            ->latest()
            ->paginate(10);

        return view('pages.donor.request.index', compact('requests'));
    }

    public function updateRequestStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:accepted,rejected',
        'message' => 'nullable|string|max:1000'
    ]);

    $productRequest = ProductRequest::where('donor_id', auth()->id())
        ->where('id', $id)
        ->firstOrFail();

    $productRequest->update([
        'status' => $request->status,
        'donor_status' => $request->status,
        'message' => $request->message
    ]);

    return back()->with('success', 'Request updated successfully.');
}



}
