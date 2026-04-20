<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['user', 'category'])->latest()->get();

        return view('pages.admin.product.index', compact('products'));
    }

   public function create()
{
    $categories = Category::all();

    return view('pages.admin.product.create', compact('categories'));
}

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:sell,buy',
            'price' => 'required|numeric',
            'condition' => 'required|in:new,used',
            'is_active' => 'required|boolean',
        ]);

        Product::create([
            'user_id' => auth()->id(), // logged-in user
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'price' => $request->price,
            'condition' => $request->condition,
            'is_active' => $request->is_active,
        ]);

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('pages.admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:sell,buy',
            'price' => 'required|numeric',
            'condition' => 'required|in:new,used',
            'is_active' => 'required|boolean',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'price' => $request->price,
            'condition' => $request->condition,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return back()->with('success', 'Product deleted successfully!');
    }
}
