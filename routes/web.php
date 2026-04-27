<?php

use App\Http\Controllers\Admin\AdminCategorytController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Donor\DonorProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;




Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/notifications/read', function () {

    auth()->user()->unreadNotifications->markAsRead();

    return back()->with('success', 'Notifications marked as read');

});
// Auth Controller
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AdminController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('admin/category/index', [AdminCategorytController::class, 'index'])->name('admin.category.index');
Route::get('admin/category/create', [AdminCategorytController::class, 'create'])->name('admin.category.create');
Route::post('admin/category/store', [AdminCategorytController::class, 'store'])->name('admin.category.store');
Route::get('admin/category/edit/{id}', [AdminCategorytController::class, 'edit'])->name('admin.category.edit');
Route::put('admin/category/update/{id}', [AdminCategorytController::class, 'update'])->name('admin.category.update');
Route::delete('admin/category/delete/{id}', [AdminCategorytController::class, 'destroy'])->name('admin.category.delete');

 Route::get('products', [AdminProductController::class,'index'])->name('admin.products.index');
Route::get('products/create', [AdminProductController::class,'create'])->name('admin.products.create');
Route::post('products/store', [AdminProductController::class,'store'])->name('admin.products.store');
Route::get('products/edit/{id}', [AdminProductController::class,'edit'])->name('admin.products.edit');
Route::put('products/update/{id}', [AdminProductController::class,'update'])->name('admin.products.update');
Route::delete('products/delete/{id}', [AdminProductController::class,'destroy'])->name('admin.products.delete');


Route::get('donor/product/index', [DonorProductController::class, 'index'])->name('donor.products.index');
Route::get('donor/product/create', [DonorProductController::class, 'create'])->name('donor.products.create');
Route::post('products/store', [DonorProductController::class,'store'])->name('donor.products.store');
Route::get('products/edit/{id}', [DonorProductController::class,'edit'])->name('donor.products.edit');
Route::put('products/update/{id}', [DonorProductController::class,'update'])->name('donor.products.update');
Route::delete('products/delete/{id}', [DonorProductController::class,'destroy'])->name('donor.products.delete');