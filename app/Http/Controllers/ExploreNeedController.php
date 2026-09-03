<?php

namespace App\Http\Controllers;

use App\Models\Category;

class ExploreNeedController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Get All Categories
        |--------------------------------------------------------------------------
        |
        | Every category created from the admin panel/database will
        | automatically appear on the Explore Needs page.
        |
        */

        $categories = Category::query()
            ->orderBy('name', 'asc')
            ->get();

        $totalCategories = $categories->count();

        return view(
            'pages.home.exploreNeed.index',
            compact(
                'categories',
                'totalCategories'
            )
        );
    }
}