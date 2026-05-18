<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class DonorProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'user'])
            ->where('user_id', Auth::id()) // ✅ only current user
            ->latest()
            ->paginate(10);

        return view('pages.donor.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('pages.donor.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:1024',
            'status' => 'required|in:active,inactive',
        ]);

        $imageNames = [];

        // ✅ IMAGE UPLOAD
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $filename = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

                $image->move(public_path('admin/products'), $filename);

                $imageNames[] = $filename;
            }
        }

        // ✅ CREATE PRODUCT (SAFE VERSION)
        $product = new Product;

        $product->user_id = auth()->id(); // make sure auth middleware is applied
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->images = json_encode($imageNames);
        $product->status = $request->status;

        $saved = $product->save();

        // ❗ DEBUG CHECK (TEMP)
        if (! $saved) {
            return back()->with('error', 'Product not saved. Check DB or fillable.');
        }

        // ✅ NOTIFICATION
        $users = User::where('id', '!=', auth()->id())->get();

        Notification::send($users, new ProductCreatedNotification($product));

        return redirect()
            ->route('donor.product.index')
            ->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('pages.donor.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price' => 'nullable|numeric|min:0',
        'description' => 'nullable|string',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $product = Product::findOrFail($id);

    // (OPTIONAL SECURITY CHECK)
    if ($product->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $imageNames = json_decode($product->images, true) ?? [];

    // ✅ ONLY REPLACE IMAGES IF NEW ONES ARE UPLOADED
    if ($request->hasFile('images')) {

        $newImages = [];

        foreach ($request->file('images') as $image) {

            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('admin/products'), $filename);

            $newImages[] = $filename;
        }

        // ✅ DELETE OLD ONLY AFTER SUCCESSFUL UPLOAD
        if (!empty($imageNames)) {
            foreach ($imageNames as $oldImage) {

                $oldPath = public_path('admin/products/' . $oldImage);

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
        }

        $imageNames = $newImages;
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

    return redirect()
        ->route('donor.product.index')
        ->with('success', 'Product updated successfully');
}

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // ✅ DELETE IMAGES FROM FOLDER IF EXISTS
        if ($product->images) {

            $images = json_decode($product->images, true);

            if (! empty($images)) {
                foreach ($images as $image) {

                    $path = public_path('admin/products/'.$image);

                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }
        }

        // ✅ DELETE PRODUCT RECORD
        $product->delete();

        return back()->with('success', 'Product deleted successfully');
    }
}
