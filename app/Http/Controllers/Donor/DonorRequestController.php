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
        $validated = $request->validate([
            'donor_status' => [
                'nullable',
                'required_without:message',
                'in:pending,approved,rejected',
            ],
            'message' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $productRequest = ProductRequest::where('id', $id)
            ->where('donor_id', auth()->id())
            ->where('admin_status', 'approved')
            ->firstOrFail();

        if (array_key_exists('donor_status', $validated)) {
            $productRequest->donor_status = $validated['donor_status'];
        }

        if (array_key_exists('message', $validated)) {
            $productRequest->message = $validated['message'];
        }

        $productRequest->save();

        return back()->with(
            'success',
            'Request updated successfully.'
        );
    }
}
