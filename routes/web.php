<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\MarginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductOutController;
use App\Http\Controllers\Admin\ProofOfCashController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\WalletController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/register', function () {
    return redirect(route('login'));
});

Route::get('/', function () {
    return redirect(route('admin.dashboard'));
})->name('homepage');

Route::get('/dashboard', function () {
    return redirect(route('admin.dashboard'));
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

    Route::prefix('proof-of-cash')->name('proof-of-cash.')->group(function () {
        route::get('/{id}', [ProofOfCashController::class,'index'])->name('index');
        route::get('/{id}/show/{orderId}', [ProofOfCashController::class,'show'])->name('show');
        route::get('/{id}/create/{orderId}', [ProofOfCashController::class,'create'])->name('create');
        route::get('/{id}/edit/{orderId}/poc/{poc}', [ProofOfCashController::class,'edit'])->name('edit');
    });

    Route::prefix('invoice')->name('invoice.')->group(function () {
        route::get('/{id}', [InvoiceController::class,'index'])->name('index');
        route::get('/{id}/show/{orderId}', [InvoiceController::class,'show'])->name('show');
        route::get('/{id}/create/{orderId}', [InvoiceController::class,'create'])->name('create');
        route::get('/{id}/edit/{orderId}/poc/{poc}', [InvoiceController::class,'edit'])->name('edit');

        route::get('/{id}/download/{invoiceId}', [InvoiceController::class,'download'])->name('download');
    });

    Route::prefix('order')->name('order.')->group(function () {
        route::get('/', [OrderController::class,'index'])->name('index');
        route::get('/order/recapitulation', [OrderController::class,'orderRecapitulation'])->name('order-recapitulation');
        route::get('/order/done', [OrderController::class,'orderDone'])->name('order-done');
        route::get('/order/cancel', [OrderController::class,'orderCancel'])->name('order.cancel');

        route::get('/create/{id}', [OrderController::class,'createECatalog'])->name('create');
        route::get('/input-order/{id}', [OrderController::class,'createECatalogOrder'])->name('input-order');
        route::get('/preview/{id}', [OrderController::class,'createECatalogPreview'])->name('preview');
        route::get('/edit/{id}', [OrderController::class,'edit'])->name('edit');
        route::get('/show/{id}', [OrderController::class,'show'])->name('show');
        route::get('/hpp/{id}', [OrderController::class,'hpp'])->name('hpp');
        route::get('/sharing/{id}', [OrderController::class,'sharing'])->name('sharing');
        route::get('/tax-edit/{id}', [OrderController::class,'taxEdit'])->name('tax-edit');

        route::get('/show/{id}/proof-of-cash/create/', [OrderController::class,'proofOfCashCreate'])->name('proof-of-cash.create');
        route::get('/show/{id}/proof-of-cash/edit/{poc}', [OrderController::class,'proofOfCashEdit'])->name('proof-of-cash.edit');
        route::get('/show/{id}/proof-of-cash/download/{poc}', [OrderController::class,'downloadProofOfCash'])->name('download.proof-of-cash');

        route::get('/{id}/mockup/create/', [OrderController::class,'createMockup'])->name('create-mockup');
        route::get('/{id}/mockup/download/{mockup}', [OrderController::class,'downloadMockup'])->name('download-mockup');

    });

//    Route::prefix('proof-of-cash')->name('proof-of-cash.')->group(function () {
//        route::get('/{id}', [ProofOfCashController::class,'index'])->name('index');
//        route::get('/{id}/create/', [OrderController::class,'create'])->name('create');
//        route::get('/{id}/edit/{poc}', [OrderController::class,'edit'])->name('edit');
//        route::get('/{id}/download/{poc}', [OrderController::class,'download'])->name('download');
//    });



    Route::prefix('product-out')->name('product-out.')->group(function () {
        route::get('/{id}', [ProductOutController::class,'index'])->name('index');
        route::get('/{id}/detail/{orderId}', [ProductOutController::class,'show'])->name('show');
        route::get('/{id}/detail/{orderId}/create', [ProductOutController::class,'create'])->name('create');
        route::get('/{id}/detail/{orderId}/edit/{outId}', [ProductOutController::class,'edit'])->name('edit');
        route::get('/{id}/detail/{orderId}/upload/{outId}', [ProductOutController::class,'upload'])->name('upload');
        route::get('/{id}/detail/{orderId}/upload/{outId}/download-product-out', [ProductOutController::class,'downloadProductOut'])->name('download-product-out');
        route::get('/{id}/detail/{orderId}/upload/{outId}/download-waybill', [ProductOutController::class,'downloadWaybill'])->name('download-waybill');
    });

    Route::prefix('margin')->name('margin.')->group(function () {
        route::get('/{id}', [MarginController::class,'index'])->name('index');
    });


    Route::prefix('customer')->name('customer.')->group(function () {
        route::get('/', [CustomerController::class,'index'])->name('index');
        route::get('/create', [CustomerController::class,'create'])->name('create');
        route::get('/edit/{id}', [CustomerController::class,'edit'])->name('edit');
        route::get('/show/{id}', [CustomerController::class,'show'])->name('show');
    });
    Route::prefix('wallet')->name('wallet.')->group(function () {
        route::get('/', [WalletController::class,'index'])->name('index');
        route::get('/create', [WalletController::class,'create'])->name('create');
        route::get('/edit/{id}', [WalletController::class,'edit'])->name('edit');
        route::get('/show/{id}/transaction', [WalletController::class,'show'])->name('show');
        route::get('/show/{id}/transaction/create', [WalletController::class,'createTransaction'])->name('create-transaction');
        route::get('/show/{id}/transaction/edit/{transaction}', [WalletController::class,'editTransaction'])->name('edit-transaction');
    });


});
