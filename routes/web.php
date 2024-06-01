<?php

use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\CompanyAssetController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\GeneralInfoController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\MutationStatusController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\SellingController;
use App\Http\Controllers\Admin\ShipperController;
use App\Http\Controllers\Admin\SubmissionController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\FinanceController;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//
//    //    $pdf = App::make('dompdf.wrapper');
//    //    $pdf->loadView('pdf.test', $data);
//    //    return $pdf->stream;
//    //    $transaction = Transaction::find(1);
        return redirect(route('dashboard'));
//
//    $data = [
//        'salary' => \App\Models\Salary::find(1),
//    ];
//    $pdf = App::make('dompdf.wrapper');
//    $pdf->loadView('pdf.salary', $data);
//
//    return $pdf->stream();
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    Route::prefix('material')->name('material.')->group(function () {
        Route::get('index', [MaterialController::class, 'index'])->name('index');
        Route::get('create', [MaterialController::class, 'create'])->name('create');
        Route::get('edit', [MaterialController::class, 'edit'])->name('edit');

        Route::get('material-stock/{id}', [MaterialController::class, 'materialStock'])->name('material-stock');
        Route::get('material-stock/{id}/mutation', [MaterialController::class, 'materialStockMutation'])->name('material-stock-mutation');

        Route::get('category', [MaterialController::class, 'category'])->name('category');
        Route::get('category/create', [MaterialController::class, 'categoryCreate'])->name('category.create');
        Route::get('category/edit/{id}', [MaterialController::class, 'categoryEdit'])->name('category.edit');
    });

    Route::prefix('submission')->name('submission.')->group(function () {
        Route::get('', [SubmissionController::class, 'index'])->name('index');
        Route::get('create', [SubmissionController::class, 'create'])->name('create');
        Route::get('edit/{id}', [SubmissionController::class, 'edit'])->name('edit');
        Route::get('show/{id}', [SubmissionController::class, 'show'])->name('show');
    });

    Route::prefix('production')->name('production.')->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
    });

    Route::prefix('selling')->name('selling.')->group(function () {
        Route::get('', [SellingController::class, 'index'])->name('index');
        Route::get('create', [SellingController::class, 'create'])->name('create');
        Route::get('edit/{id}', [SellingController::class, 'edit'])->name('edit');
    });

    Route::prefix('bank')->name('bank.')->group(function () {
        Route::get('', [BankController::class, 'index'])->name('index');
        Route::get('create', [BankController::class, 'create'])->name('create');
        Route::get('edit/{id}', [BankController::class, 'edit'])->name('edit');
    });

    Route::prefix('company-asset')->name('company-asset.')->group(function () {
        Route::get('', [CompanyAssetController::class, 'index'])->name('index');
        Route::get('create', [CompanyAssetController::class, 'create'])->name('create');
        Route::get('edit/{id}', [CompanyAssetController::class, 'edit'])->name('edit');
        Route::get('show/{id}', [CompanyAssetController::class, 'show'])->name('show');
        Route::get('show/create/{id}', [CompanyAssetController::class, 'createShrinkage'])->name('create-shrinkage');
    });

    Route::prefix('shipper')->name('shipper.')->group(function () {
        Route::get('', [ShipperController::class, 'index'])->name('index');
        Route::get('create', [ShipperController::class, 'create'])->name('create');
        Route::get('edit', [ShipperController::class, 'edit'])->name('edit');
    });

    Route::prefix('mutation-status')->name('mutation-status.')->group(function () {
        Route::get('', [MutationStatusController::class, 'index'])->name('index');
        Route::get('create', [MutationStatusController::class, 'create'])->name('create');
        Route::get('edit', [MutationStatusController::class, 'edit'])->name('edit');
    });

    Route::prefix('partner')->name('partner.')->group(function () {
        Route::get('', [PartnerController::class, 'index'])->name('index');
        Route::get('create', [PartnerController::class, 'create'])->name('create');
        Route::get('edit', [PartnerController::class, 'edit'])->name('edit');
        Route::get('category', [PartnerController::class, 'category'])->name('category');
        Route::get('category/create', [PartnerController::class, 'categoryCreate'])->name('category.create');
        Route::get('category/edit/{id}', [PartnerController::class, 'categoryEdit'])->name('category.edit');
    });

    Route::prefix('supplier')->name('supplier.')->group(function () {
        Route::get('', [SupplierController::class, 'index'])->name('index');
        Route::get('create', [SupplierController::class, 'create'])->name('create');
        Route::get('edit', [SupplierController::class, 'edit'])->name('edit');
        Route::get('category', [SupplierController::class, 'category'])->name('category');
        Route::get('category/create', [SupplierController::class, 'categoryCreate'])->name('category.create');
        Route::get('category/edit/{id}', [SupplierController::class, 'categoryEdit'])->name('category.edit');
    });

    Route::prefix('transaction')->name('transaction.')->group(function () {
        Route::get('', function () {
            return redirect(\route('transaction.index', 'Penagihan'));
        });
        Route::get('selling/{tab}', [TransactionController::class, 'index'])->name('index');
        Route::get('create', [TransactionController::class, 'create'])->name('create');
        Route::get('edit', [TransactionController::class, 'edit'])->name('edit');

        Route::get('billing-page/{id}', [TransactionController::class, 'billingPage'])->name('billing-page');
        Route::get('transaction/change/{id}/status/{status}/', [TransactionController::class, 'transactionChangeStatus'])->name('transaction.change.status');

        Route::get('mockup-site', [TransactionController::class, 'mockupSite'])->name('mockup-site');
        Route::get('mockup-site/{id}', [TransactionController::class, 'mockupSiteEdit'])->name('mockup-site-edit');
        Route::get('mockup-site/{id}/download', [TransactionController::class, 'mockupSiteDownload'])->name('mockup-site-download');

        Route::get('pic/{id}', [TransactionController::class, 'picEdit'])->name('pic-edit');
        Route::get('qc/{id}', [TransactionController::class, 'qcEdit'])->name('qc-edit');
        Route::get('shipper/{id}', [TransactionController::class, 'shipperEdit'])->name('shipper-edit');

        Route::get('pattern-site', [TransactionController::class, 'patternSite'])->name('pattern-site');

        Route::get('sample-site', [TransactionController::class, 'sampleSite'])->name('sample-site');
        Route::get('sample-site/resi/{id}', [TransactionController::class, 'sampleSiteResi'])->name('sample-site.resi');

        Route::get('/production', function () {
            return redirect(\route('transaction.production.tab', 'Potong'));
        })->name('production');

        Route::get('production/tab/{tab}', [TransactionController::class, 'productionTab'])->name('production.tab');
    });

    Route::prefix('general-info')->name('general-info.')->group(function () {
        Route::get('', [GeneralInfoController::class, 'index'])->name('index');
        Route::get('create', [GeneralInfoController::class, 'create'])->name('create');
        Route::get('edit/{id}', [GeneralInfoController::class, 'edit'])->name('edit');
    });

    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('', [CustomerController::class, 'index'])->name('index');
        Route::get('create', [CustomerController::class, 'create'])->name('create');
        Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('edit');
    });

    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('', [EmployeeController::class, 'index'])->name('index');
        Route::get('create', [EmployeeController::class, 'create'])->name('create');
        Route::get('edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
    });

    Route::prefix('salary')->name('salary.')->group(function () {

        Route::get('download/{id}',[SalaryController::class,'download'])->name('download');
    });

    Route::prefix('finance')->name('finance.')->group(function () {

        Route::get('journal', [FinanceController::class, 'journal'])->name('journal');
        Route::get('journal/create', [FinanceController::class, 'journalCreate'])->name('journal.create');
        Route::get('journal/edit/{id}', [FinanceController::class, 'journalEdit'])->name('journal.edit');

        Route::get('account-names', [FinanceController::class, 'accountNames'])->name('account-names');
        Route::get('account-names/create', [FinanceController::class, 'accountNamesCreate'])->name('account-names.create');
        Route::get('account-names/edit/{id}', [FinanceController::class, 'accountNamesEdit'])->name('account-names.edit');

        Route::get('ledger', [FinanceController::class, 'ledger'])->name('ledger');
        Route::get('balance-sheet', [FinanceController::class, 'balanceSheet'])->name('balance-sheet');
        Route::get('worksheet', [FinanceController::class, 'worksheet'])->name('worksheet');
        Route::get('calc-balance', [FinanceController::class, 'calcBalance'])->name('calc-balance');
        Route::get('profit-and-loss', [FinanceController::class, 'profitAndLoss'])->name('profit-and-loss');
        Route::get('calc-profit-and-loss', [FinanceController::class, 'calcProfitAndLoss'])->name('calc-profit-and-loss');
    });

});
