<?php

namespace App\Http\Controllers\Beneficiary;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductRequest;
use Illuminate\Http\Request;

class BeneficiaryProductController extends Controller
{
    public function index(Request $request)
    {
        $beneficiaryId = auth()->id();

        $requestedProductIds = ProductRequest::where('beneficiary_id', $beneficiaryId)
            ->pluck('product_id');

        $products = Product::with('category')
            ->whereNotIn('id', $requestedProductIds);

        if ($request->filled('category_id')) {
            $products->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $products->where('name', 'like', '%'.$request->search.'%');
        }

        $products = $products->latest()->get();

        // FIXED
        $categories = Category::all();

        return view(
            'pages.beneficiary.products.index',
            compact('products', 'categories')
        );
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        $requestExists = false;

        if (auth()->check()) {
            $requestExists = ProductRequest::where('product_id', $id)
                ->where('beneficiary_id', auth()->id())
                ->exists();
        }

        // RELATED PRODUCTS (same category, exclude current product)
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(6)
            ->get();

        return view('pages.beneficiary.products.show', [
            'product' => $product,
            'requestExists' => $requestExists,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    // SEND REQUEST TO DONOR
    public function sendRequest($id)
    {
        $product = Product::findOrFail($id);

        // prevent duplicate request
        $exists = ProductRequest::where('product_id', $id)
            ->where('beneficiary_id', auth()->id())
            ->first();

        if ($exists) {
            return back()->with('error', 'Request already sent.');
        }

        ProductRequest::create([
            'beneficiary_id' => auth()->id(),
            'product_id' => $product->id,
            'donor_id' => $product->user_id,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('beneficiary.products.index')
            ->with('success', 'Request sent successfully.');
    }

    public function myRequests()
    {
        $requests = ProductRequest::with(['product', 'donor'])
            ->where('beneficiary_id', auth()->id())
            ->latest()
            ->get();

        return view('pages.beneficiary.myrequest.index', compact('requests'));
    }
}
