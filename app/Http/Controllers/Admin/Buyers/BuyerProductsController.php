<?php

namespace App\Http\Controllers\Admin\Buyers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuyerProductsController extends Controller
{
    public function index()
    {
        return view("pages.admin.buyers.product-list.index");
    }
}
