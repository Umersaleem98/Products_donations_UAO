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
            'beneficiary.beneficiaryProfile',
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
        'donor_status' => 'required_without:message|in:accepted,rejected,pending',
        'message' => 'nullable|string|max:1000',
    ]);

    $productRequest = ProductRequest::where('donor_id', auth()->id())
        ->where('id', $id)
        ->firstOrFail();

    /**
     * ==========================
     * UPDATE STATUS (IF PROVIDED)
     * ==========================
     */
    if ($request->filled('donor_status')) {
        $productRequest->donor_status = $request->donor_status;
    }

    /**
     * ==========================
     * UPDATE MESSAGE (IF PROVIDED)
     * ==========================
     */
    if ($request->filled('message')) {
        $productRequest->message = $request->message;
    }

    $productRequest->save();

    return back()->with('success', 'Request updated successfully.');
}
}
