<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
{
    $products = Product::with(['user','category'])->latest()->get();
    return view('pages.admin.product.index', compact('products'));
}
}
