<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminProductsController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        // $categories = Category::latest()->paginate(10);
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
            'price' => 'required',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageNames = [];

        // ✅ Upload Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('admin/products'), $filename);

                $imageNames[] = $filename;
            }
        }

        Product::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'images' => json_encode($imageNames),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('pages.admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $imageNames = json_decode($product->images, true) ?? [];

        // ✅ If new images uploaded → delete old ones
        if ($request->hasFile('images')) {

            foreach ($imageNames as $oldImage) {
                $path = public_path('admin/products/' . $oldImage);

                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $imageNames = [];

            foreach ($request->file('images') as $image) {

                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('admin/products'), $filename);

                $imageNames[] = $filename;
            }
        }

        // ✅ Update Product
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'images' => json_encode($imageNames),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return back()->with('success', 'Product deleted successfully');
    }
}
