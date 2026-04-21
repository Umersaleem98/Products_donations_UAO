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
   $products = Product::with(['user','category','images'])
        ->where('user_id', auth()->id()) // 👈 ONLY current user
        ->latest()
        ->get();
    return view('pages.donors.post.index', compact('products'));
}

 public function create()
    {
        $categories = Category::all();
        return view('pages.donors.post.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'type' => 'required',
            'condition' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $product = Product::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'price' => $request->price,
            'condition' => $request->condition,
            'is_active' => $request->is_active ?? 1,
        ]);

        // Upload Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('donor.post.index')->with('success','Product added');
    }

    public function edit($id)
    {
        $product = Product::where('id',$id)
            ->where('user_id', auth()->id())
            ->with('images')
            ->firstOrFail();

        $categories = Category::all();

        return view('pages.donors.post.edit', compact('product','categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('id',$id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $request->validate([
            'title' => 'required',
            'category_id' => 'required'
        ]);

        $product->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'type' => $request->type,
            'price' => $request->price,
            'condition' => $request->condition,
            'is_active' => $request->is_active,
        ]);

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products','public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('donor.post.index')->with('success','Updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::where('id',$id)
            ->where('user_id', auth()->id())
            ->with('images')
            ->firstOrFail();

        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }

        $product->delete();

        return back()->with('success','Deleted successfully');
    }
}
