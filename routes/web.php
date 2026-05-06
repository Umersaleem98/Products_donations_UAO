<?php

use App\Http\Controllers\Admin\AdminCategorytController;
use App\Http\Controllers\Admin\AdminExcelController;
use App\Http\Controllers\Admin\AdminProductsController;
use App\Http\Controllers\Admin\AdminRequestController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Beneficiary\BeneficiaryProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Donor\DonorProductController;
use App\Http\Controllers\Donor\DonorProfileController;
use App\Http\Controllers\Donor\DonorRequestController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;






Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('admin/category/index', [AdminCategorytController::class, 'index'])->name('admin.category.index');
Route::get('admin/category/create', [AdminCategorytController::class, 'create'])->name('admin.category.create');
Route::post('admin/category/store', [AdminCategorytController::class, 'store'])->name('admin.category.store');
Route::get('admin/category/edit/{id}', [AdminCategorytController::class, 'edit'])->name('admin.category.edit');
Route::put('admin/category/update/{id}', [AdminCategorytController::class, 'update'])->name('admin.category.update');
Route::delete('admin/category/delete/{id}', [AdminCategorytController::class, 'destroy'])->name('admin.category.delete');

Route::get('admin/products/index', [AdminProductsController::class,'index'])->name('admin.products.index');
Route::get('admin/products/create', [AdminProductsController::class,'create'])->name('admin.products.create');
Route::post('admin/products/store', [AdminProductsController::class,'store'])->name('admin.products.store');
Route::get('admin/product/{id}/edit', [AdminProductsController::class, 'edit'])->name('admin.product.edit');
Route::put('admin/products/update/{id}', [AdminProductsController::class,'update'])->name('admin.products.update');
Route::delete('admin/products/delete/{id}', [AdminProductsController::class, 'destroy'])->name('admin.products.delete');

Route::get('admin/user/index', [AdminUserController::class,'index'])->name('admin.user.index');
Route::get('admin/user/create', [AdminUserController::class,'create'])->name('admin.user.create');
Route::post('admin/user/store', [AdminUserController::class,'store'])->name('admin.user.store');
Route::get('admin/user/edit/{id}', [AdminUserController::class,'edit'])->name('admin.user.edit');
Route::put('admin/user/update/{id}', [AdminUserController::class,'update'])->name('admin.user.update');
Route::get('admin/user/delete/{id}', [AdminUserController::class,'destroy'])->name('admin.user.destroy');
// excel Routes 
Route::post('/admin/users/import', [AdminUserController::class, 'importUsers'])->name('admin.user.import');
Route::get('/admin/users/export', [AdminUserController::class, 'exportUsers'])->name('admin.user.export');
Route::post('/admin/users/export-selected', [AdminUserController::class, 'exportSelected'])->name('admin.user.export.selected');

Route::get('admin/requests', [AdminRequestController::class, 'index'])->name('admin.requests');
Route::post('admin/request/{id}/update', [AdminRequestController::class, 'update'])->name('admin.request.update');


Route::get('donor/product/index', [DonorProductController::class, 'index'])->name('donor.product.index');
Route::get('donor/product/create', [DonorProductController::class, 'create'])->name('donor.product.create');
Route::post('donor/products/store', [DonorProductController::class,'store'])->name('donor.product.store');
Route::get('donor/products/edit/{id}', [DonorProductController::class,'edit'])->name('donor.product.edit');
Route::put('donor/products/update/{id}', [DonorProductController::class,'update'])->name('donor.product.update');
Route::delete('donor/products/delete/{id}', [DonorProductController::class,'destroy'])->name('donor.products.delete');

Route::get('donor/profile/index', [DonorProfileController::class, 'index'])->name('donor.profile.index');
Route::post('/donor/profile/update', [DonorProfileController::class, 'update'])->name('donor.profile.update');

Route::get('donor/requests', [DonorRequestController::class, 'donorRequests'])->name('donor.requests');

Route::post('donor/request/{id}', [DonorRequestController::class, 'updateRequestStatus'])->name('donor.request.update');


// beneficiary routes
Route::get('beneficiary/products/index', [BeneficiaryProductController::class, 'index'])->name('beneficiary.products.index');

// PRODUCT DETAIL
Route::get('beneficiary/products/detail/{id}', [BeneficiaryProductController::class, 'show'])->name('beneficiary.products.detail.show');

// SEND REQUEST TO DONOR
Route::post('product/{id}/request', [BeneficiaryProductController::class, 'sendRequest'])
    ->name('product.request.send');

    Route::get('beneficiary/my-requests', [BeneficiaryProductController::class, 'myRequests'])
    ->name('beneficiary.my.requests');