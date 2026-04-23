<?php

namespace App\Http\Controllers\Donoe;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonorPostController extends Controller
{

   public function index()
{
    $products = Product::with(['user','category'])
        ->where('user_id', auth()->id())
        ->latest()
        ->paginate(10); // ✅ IMPORTANT

    return view('pages.donors.post.index', compact('products'));
}

 public function create()
    {
        $categories = Category::all();
        return view('pages.donors.post.create', compact('categories'));
    }

   public function store(Request $request)
{
    // VALIDATION
    $request->validate([
        'title'        => 'required|string|max:255',
        'category_id'  => 'required|exists:categories,id',
        'type'         => 'required|in:donate,sale',
        'price'        => 'nullable|numeric|min:0',
        'condition'    => 'required|in:new,used',
        'description'  => 'nullable|string',
        'is_active'    => 'required|in:0,1',
        'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // IMAGE UPLOAD (SINGLE)
    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    // CREATE PRODUCT
    $product = Product::create([
        'user_id'      => auth()->id(),
        'category_id'  => $request->category_id,
        'title'        => $request->title,
        'description'  => $request->description,
        'type'         => $request->type,
        'price'        => $request->price,
        'condition'    => $request->condition,
        'is_active'    => $request->is_active,
        'image'        => $imagePath, // ✅ store single image
    ]);

    return redirect()
        ->route('donor.post.index')
        ->with('success', 'Donation created successfully!');
}


   public function edit($id)
{
    $product = Product::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $categories = Category::all();

    return view('pages.donors.post.edit', compact('product', 'categories'));
}

    public function update(Request $request, $id)
{
    $product = Product::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    // VALIDATION
    $request->validate([
        'title'        => 'required|string|max:255',
        'category_id'  => 'required|exists:categories,id',
        'type'         => 'required|in:donate,sale',
        'price'        => 'nullable|numeric|min:0',
        'condition'    => 'required|in:new,used',
        'description'  => 'nullable|string',
        'is_active'    => 'required|in:0,1',
        'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // OLD IMAGE DELETE (optional but recommended)
    if ($request->hasFile('image')) {

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $imagePath = $request->file('image')->store('products', 'public');

        $product->image = $imagePath;
    }

    // UPDATE PRODUCT
    $product->update([
        'title'        => $request->title,
        'category_id'  => $request->category_id,
        'description'  => $request->description,
        'type'         => $request->type,
        'price'        => $request->price,
        'condition'    => $request->condition,
        'is_active'    => $request->is_active,
        'image'        => $product->image ?? null,
    ]);

    return redirect()
        ->route('donor.post.index')
        ->with('success', 'Updated successfully');
}

  public function destroy($id)
{
    $product = Product::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    // DELETE IMAGE FROM STORAGE (if exists)
    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }

    // DELETE PRODUCT
    $product->delete();

    return back()->with('success', 'Deleted successfully');
}
}
