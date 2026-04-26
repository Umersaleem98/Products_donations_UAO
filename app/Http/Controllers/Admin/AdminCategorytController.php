<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminCategorytController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('pages.admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.admin.category.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $category = new Category();

    $category->name = $request->name;
    $category->slug = \Illuminate\Support\Str::slug($request->name);

    $category->save(); // ✅ important

    return redirect()->route('admin.category.index')
        ->with('success', 'Category created successfully');
}

    public function edit($id)
{
    $category = Category::findOrFail($id);

    return view('pages.admin.category.edit', compact('category'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $category = Category::findOrFail($id);

    $category->name = $request->name;
    $category->slug = Str::slug($request->name);

    $category->save();

    return redirect()->route('admin.category.index')
        ->with('success', 'Category updated successfully');
}

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Category deleted successfully');
    }
}
