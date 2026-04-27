<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Notifications\NewProductNotification;

class DonorProductController extends Controller
{


public function index()
{
    $products = Product::with(['category','user'])
        ->where('user_id', Auth::id()) // ✅ only current user
        ->latest()
        ->get();

    return view('pages.donor.products.index', compact('products'));
}

       public function create()
    {
        $categories = Category::all();
        return view('pages.donor.products.create', compact('categories'));
    }

     public function store(Request $request)
{
    $product = Product::create([
        'user_id' => auth()->id(),
        'category_id' => $request->category_id,
        'name' => $request->name,
        'slug' => \Str::slug($request->name),
        'price' => $request->price,
    ]);

    // ✅ SEND NOTIFICATION TO ADMIN
    $admins = User::where('role', 'admin')->get();

    foreach ($admins as $admin) {
        $admin->notify(new NewProductNotification($product));
    }

    return redirect()->route('donor.products.index')
        ->with('success','Product added & admin notified');
}

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('pages.donor.products.edit', compact('product','categories'));
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

        return redirect()->route('donor.products.index')
            ->with('success','Product updated successfully');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return back()->with('success','Product deleted successfully');
    }
}
