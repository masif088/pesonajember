<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/register', function () {
    return redirect(route('login'));
});

Route::get('/', function () {
    return redirect('https://pesonajember.id');
})->name('homepage');

Route::get('/dashboard', function () {
    return redirect(route('dashboard'));
})->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    Route::prefix('supplier')->name('supplier.')->group(function () {
        route::get('/', [SupplierController::class,'index'])->name('index');
        route::get('/create', [SupplierController::class,'create'])->name('create');
        route::get('/edit/{id}', [SupplierController::class,'edit'])->name('edit');
        route::get('/show/{id}', [SupplierController::class,'show'])->name('show');
    });

    Route::prefix('partner')->name('partner.')->group(function () {
        route::get('/', [PartnerController::class,'index'])->name('index');
        route::get('/create', [PartnerController::class,'create'])->name('create');
        route::get('/edit/{id}', [PartnerController::class,'edit'])->name('edit');
        route::get('/show/{id}', [PartnerController::class,'show'])->name('show');
    });

    Route::prefix('order')->name('order.')->group(function () {
        route::get('/', [OrderController::class,'index'])->name('index');
        route::get('/create-e-catalog', [OrderController::class,'createECatalog'])->name('create-e-catalog');
        route::get('/create-e-catalog/order/{id}', [OrderController::class,'createECatalogOrder'])->name('create-e-catalog.order');
        route::get('/create-e-catalog/preview/{id}', [OrderController::class,'createECatalogPreview'])->name('create-e-catalog.preview');
        route::get('/create-by-order', [OrderController::class,'createByOrder'])->name('create-by-order');
        route::get('/create-by-flag', [OrderController::class,'createByFlag'])->name('create-by-flag');
        route::get('/edit/{id}', [OrderController::class,'edit'])->name('edit');
        route::get('/show/{id}', [OrderController::class,'show'])->name('show');
    });

    Route::prefix('customer')->name('customer.')->group(function () {
        route::get('/', [CustomerController::class,'index'])->name('index');
        route::get('/create', [CustomerController::class,'create'])->name('create');
        route::get('/edit/{id}', [CustomerController::class,'edit'])->name('edit');
        route::get('/show/{id}', [CustomerController::class,'show'])->name('show');
    });


});
