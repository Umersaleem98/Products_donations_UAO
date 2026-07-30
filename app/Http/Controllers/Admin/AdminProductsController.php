<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class AdminProductsController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
         $categories = Category::all();
        // $categories = Category::latest()->paginate(10);
        return view('pages.admin.products.index', compact('products', 'categories'));
    }

   

    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $imageNames = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $filename = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

                $image->move(public_path('admin/products'), $filename);

                $imageNames[] = $filename;
            }
        }

        // ✅ CREATE PRODUCT
        $products = Product::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'images' => json_encode($imageNames),
            'status' => $request->status,
        ]);

        // ✅ GET ALL USERS (EXCEPT CURRENT USER)
        $users = User::where('id', '!=', auth()->id())->get();



        // ✅ SEND NOTIFICATION (BEST METHOD)
        Notification::send($users, new ProductCreatedNotification($products));

        return redirect()
            ->route('admin.products.index')
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
            'price' => 'nullable',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $imageNames = json_decode($product->images, true) ?? [];

        // ✅ IF NEW IMAGES UPLOADED → DELETE OLD ONES
        if ($request->hasFile('images')) {

            // 🔥 delete old images from folder
            if (! empty($imageNames)) {
                foreach ($imageNames as $oldImage) {
                    $oldPath = public_path('admin/products/'.$oldImage);

                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
            }

            $imageNames = [];

            // 🔥 upload new images
            foreach ($request->file('images') as $image) {

                $filename = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

                $image->move(public_path('admin/products'), $filename);

                $imageNames[] = $filename;
            }
        }

        // ✅ UPDATE PRODUCT
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
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
