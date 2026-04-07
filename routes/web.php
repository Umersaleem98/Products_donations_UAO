<?php

use App\Http\Controllers\Admin\Buyers\BuyerProductsController;
use App\Http\Controllers\Admin\DashboardControllerr;
use App\Http\Controllers\Auth\AuthControllerr;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class,"index"])->name("home");
Route::get("about", [AboutController::class,"index"])->name("about.index");
Route::get("contact", [ContactController::class,"index"])->name("contact.index");
Route::get("product", [ProductsController::class,"index"])->name("product.index");



Route::get("dashboard", [DashboardControllerr::class, 'index'] )->name('dashboard');
Route::get("login", [AuthControllerr::class, 'Loginscreen'] )->name('login.index');
Route::get("register", [AuthControllerr::class, 'Regiserscreen'] )->name('register.index');

Route::get("buyters/products/index", [BuyerProductsController::class, 'index'] )->name('buyers.products.index');

