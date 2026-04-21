<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\DashboardControllerr;
use App\Http\Controllers\Auth\AuthControllerr;
use App\Http\Controllers\Donoe\DonorPostController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about', [AboutController::class, 'index'])->name('about.index');
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('product', [ProductsController::class, 'index'])->name('product.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardControllerr::class, 'index'])->name('dashboard');
});
// Route::get("dashboard", [DashboardControllerr::class, 'index'] )->name('dashboard');
Route::get('login', [AuthControllerr::class, 'Loginscreen'])->name('login');
Route::post('login', [AuthControllerr::class, 'login'])->name('login.store');
Route::get('register', [AuthControllerr::class, 'Regiserscreen'])->name('register.index');
Route::post('register', [AuthControllerr::class, 'register'])->name('register.store');
Route::post('logout', [AuthControllerr::class, 'logout'])->name('logout');

Route::get('products/index', [AdminProductController::class, 'index'])->name('products.index');
Route::get('products/create', [AdminProductController::class, 'create'])->name('products.create');
Route::post('products/store', [AdminProductController::class, 'store'])->name('products.store');
Route::get('/product/{id}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
Route::put('/product/{id}', [AdminProductController::class, 'update'])->name('products.update');
Route::delete('/product/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');

Route::get('category/index', [AdminCategoryController::class, 'index'])->name('category.index');
Route::get('category/create', [AdminCategoryController::class, 'create'])->name('category.create');
Route::post('category/store', [AdminCategoryController::class, 'store'])->name('categories.store');
Route::get('/category/{id}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
Route::put('/category/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
Route::delete('/category/{id}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('users/index', [AdminUsersController::class, 'index'])->name('users.index');
Route::get('users/create', [AdminUsersController::class, 'create'])->name('users.create');
Route::post('users/store', [AdminUsersController::class, 'store'])->name('users.store');
Route::get('/admin/users/{id}/edit', [AdminUsersController::class, 'edit'])->name('users.edit');
Route::put('/admin/users/{id}', [AdminUsersController::class, 'update'])->name('users.update');
Route::delete('/admin/users/{id}', [AdminUsersController::class, 'destroy'])->name('users.destroy');


// Donor Routes 
Route::get('donor/post/index', [DonorPostController::class, 'index'])->name('donor.post.index');
Route::get('donor/post/create', [DonorPostController::class, 'create'])->name('donor.post.create');
Route::post('donor/post//store', [DonorPostController::class, 'store'])->name('donor.post.store');
Route::get('donor/post//{id}/edit', [DonorPostController::class, 'edit'])->name('donor.post.edit');
Route::put('donor/post//{id}', [DonorPostController::class, 'update'])->name('donor.post.update');
Route::delete('donor/post//{id}', [DonorPostController::class, 'destroy'])->name('donor.post.destroy');