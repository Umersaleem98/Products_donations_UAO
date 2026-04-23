<?php

namespace App\Http\Controllers\Beneficiary;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BeneficiaryProductController extends Controller
{
   public function index(Request $request)
    {
        // Get all categories
        $categories = Category::all();

        // Filter products by category (if selected)
        $products = Product::with(['user','category'])
            ->when($request->category_id, function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->latest()
            ->paginate(9);

        return view('pages.beneficiary.products.index', compact('products','categories'));
    }

public function show($id)
{
    $product = Product::with(['user', 'category'])
        ->findOrFail($id); // 🔥 MUST USE THIS



    return view('pages.beneficiary.products.show', compact('product'));
}
}
