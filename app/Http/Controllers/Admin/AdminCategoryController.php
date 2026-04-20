<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('pages.admin.category.index', compact('categories'));
    }

        public function create()
    {
        return view('pages.admin.category.create');
    }

     public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        // Insert into DB
        Category::create([
            'name' => $request->name,
        ]);

        // Redirect back with success message
        return redirect()
            ->back()
            ->with('success', 'Category created successfully!');
    }

     public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return back()->with('success', 'Category deleted successfully!');
    }

}
