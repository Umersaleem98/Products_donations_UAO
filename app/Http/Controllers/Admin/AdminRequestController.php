<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductRequest;
use Illuminate\Http\Request;

class AdminRequestController extends Controller
{
    // 📌 SHOW ALL REQUESTS
    public function index()
    {
        $requests = ProductRequest::with([
            'product',
            'beneficiary.beneficiaryProfile',
            'donor.donorProfile',
        ])
            ->latest()
            ->paginate(10);

        return view('pages.admin.requests.index', compact('requests'));
    }

    // 📌 ADMIN APPROVE / REJECT
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $req = ProductRequest::findOrFail($id);

        // update admin decision
        $req->admin_status = $request->status;

        // OPTIONAL: reset donor status if admin changes decision
        if ($request->status === 'rejected') {
            $req->donor_status = 'pending';
        }

        $req->save();

        return back()->with('success', 'Request updated successfully.');
    }
}
