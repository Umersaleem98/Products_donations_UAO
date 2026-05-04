<?php

namespace App\Http\Controllers\Beneficiary;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BeneficiaryProductController extends Controller
{
    public function index()
{
    $products = Product::with('category')->get();
    $categories = Category::all();

    return view('pages.beneficiary.products.index', compact('products', 'categories'));
}


public function detail($id)
{
   $product = Product::with('category')->findOrFail($id);

    return view('pages.beneficiary.products.show', compact('product'));
}
}
