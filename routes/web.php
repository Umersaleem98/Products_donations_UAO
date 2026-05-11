<?php

use App\Http\Controllers\Admin\AdminCategorytController;
use App\Http\Controllers\Admin\AdminProductsController;
use App\Http\Controllers\Admin\AdminRequestController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Beneficiary\BeneficiaryProductController;
use App\Http\Controllers\Beneficiary\BeneficiaryProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Donor\DonorProductController;
use App\Http\Controllers\Donor\DonorProfileController;
use App\Http\Controllers\Donor\DonorRequestController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);



/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Notifications
    Route::get('/notification/read/{id}', function ($id) {

        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return back();

    })->name('notification.read');



    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->prefix('admin')->group(function () {

        // CATEGORY
        Route::get('category/index', [AdminCategorytController::class, 'index'])->name('admin.category.index');
        Route::get('category/create', [AdminCategorytController::class, 'create'])->name('admin.category.create');
        Route::post('category/store', [AdminCategorytController::class, 'store'])->name('admin.category.store');
        Route::get('category/edit/{id}', [AdminCategorytController::class, 'edit'])->name('admin.category.edit');
        Route::put('category/update/{id}', [AdminCategorytController::class, 'update'])->name('admin.category.update');
        Route::delete('category/delete/{id}', [AdminCategorytController::class, 'destroy'])->name('admin.category.delete');

        // PRODUCTS
        Route::get('products/index', [AdminProductsController::class,'index'])->name('admin.products.index');
        Route::get('products/create', [AdminProductsController::class,'create'])->name('admin.products.create');
        Route::post('products/store', [AdminProductsController::class,'store'])->name('admin.products.store');
        Route::get('product/{id}/edit', [AdminProductsController::class, 'edit'])->name('admin.product.edit');
        Route::put('products/update/{id}', [AdminProductsController::class,'update'])->name('admin.products.update');
        Route::delete('products/delete/{id}', [AdminProductsController::class, 'destroy'])->name('admin.products.delete');

        // USERS
        Route::get('user/index', [AdminUserController::class,'index'])->name('admin.user.index');
        Route::get('user/create', [AdminUserController::class,'create'])->name('admin.user.create');
        Route::post('user/store', [AdminUserController::class,'store'])->name('admin.user.store');
        Route::get('user/edit/{id}', [AdminUserController::class,'edit'])->name('admin.user.edit');
        Route::put('user/update/{id}', [AdminUserController::class,'update'])->name('admin.user.update');
        Route::get('user/delete/{id}', [AdminUserController::class,'destroy'])->name('admin.user.destroy');

        Route::post('user/delete-selected', [AdminUserController::class, 'deleteSelected'])->name('admin.user.delete.selected');

        // EXCEL
        Route::post('users/import', [AdminUserController::class, 'importUsers'])->name('admin.user.import');
        Route::get('users/export', [AdminUserController::class, 'exportUsers'])->name('admin.user.export');
        Route::post('users/export-selected', [AdminUserController::class, 'exportSelected'])->name('admin.user.export.selected');

        // REQUESTS
        Route::get('requests', [AdminRequestController::class, 'index'])->name('admin.requests');
        Route::post('request/{id}/update', [AdminRequestController::class, 'update'])->name('admin.request.update');
    });



    /*
    |--------------------------------------------------------------------------
    | DONOR ROUTES
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:donor')->prefix('donor')->group(function () {

        // PRODUCTS
        Route::get('product/index', [DonorProductController::class, 'index'])->name('donor.product.index');
        Route::get('product/create', [DonorProductController::class, 'create'])->name('donor.product.create');
        Route::post('products/store', [DonorProductController::class,'store'])->name('donor.product.store');
        Route::get('products/edit/{id}', [DonorProductController::class,'edit'])->name('donor.product.edit');
        Route::put('products/update/{id}', [DonorProductController::class,'update'])->name('donor.product.update');
        Route::delete('products/delete/{id}', [DonorProductController::class,'destroy'])->name('donor.products.delete');

        // PROFILE
        Route::get('profile/index', [DonorProfileController::class, 'index'])->name('donor.profile.index');
        Route::post('profile/update', [DonorProfileController::class, 'update'])->name('donor.profile.update');

        // REQUESTS
        Route::get('requests', [DonorRequestController::class, 'donorRequests'])->name('donor.requests');
        Route::post('request/{id}', [DonorRequestController::class, 'updateRequestStatus'])->name('donor.request.update');
    });



    /*
    |--------------------------------------------------------------------------
    | BENEFICIARY ROUTES
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:beneficiary')->prefix('beneficiary')->group(function () {

        // PRODUCTS
        Route::get('products/index', [BeneficiaryProductController::class, 'index'])->name('beneficiary.products.index');

        Route::get('products/detail/{id}', [BeneficiaryProductController::class, 'show'])
            ->name('beneficiary.products.detail.show');

        // PROFILE
        Route::get('profile/index', [BeneficiaryProfileController::class, 'index'])
            ->name('Beneficiary.profile.index');

        Route::post('profile/update', [BeneficiaryProfileController::class, 'update'])
            ->name('Beneficiary.profile.update');

        // REQUESTS
        Route::post('product/{id}/request', [BeneficiaryProductController::class, 'sendRequest'])
            ->name('product.request.send');

        Route::get('my-requests', [BeneficiaryProductController::class, 'myRequests'])
            ->name('beneficiary.my.requests');
    });

});