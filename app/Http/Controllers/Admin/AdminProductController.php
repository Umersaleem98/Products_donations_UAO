<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pages.admin.products.index', compact('products'));
    }


     public function create()
    {
        $categories = Category::all();
        return view('pages.admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required'
        ]);

        Product::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success','Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('pages.admin.products.edit', compact('product','categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required'
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success','Product updated successfully');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return back()->with('success','Product deleted successfully');
    }
}
