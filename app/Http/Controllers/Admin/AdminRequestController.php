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
        'admin_status' => 'required|in:approved,rejected',
    ]);

    $req = ProductRequest::findOrFail($id);

    /**
     * ============================
     * ALLOW STATUS SWITCHING
     * ============================
     * admin can change:
     * pending → approved → rejected → approved (any time)
     */

    $newStatus = $request->admin_status;

    // If status is same, no need to update
    if ($req->admin_status === $newStatus) {
        return back()->with('info', 'No changes made.');
    }

    // ================= UPDATE ADMIN STATUS =================
    $req->admin_status = $newStatus;

    /**
     * ================= BUSINESS RULES =================
     */

    if ($newStatus === 'rejected') {

        // reset donor decision when admin rejects
        $req->donor_status = 'pending';

    } elseif ($newStatus === 'approved') {

        // allow donor to decide again only if not already decided
        if (!in_array($req->donor_status, ['accepted', 'rejected'])) {
            $req->donor_status = 'pending';
        }
    }

    $req->save();

    return back()->with('success', 'Request status updated successfully.');
}
}
