<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\CompanyAssetController;
use App\Http\Controllers\Admin\CooperativeController;
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
use App\Http\Controllers\Customer\CustomerSiteController;
use App\Http\Controllers\FinanceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.index');
})->name('frontpage');

Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/{hash_id}', [CustomerSiteController::class, 'customerDashboard'])->name('customer-dashboard');

    Route::get('/{hash_id}/transaction/{transaction_id}/production', [CustomerSiteController::class, 'customerTransactionProduction'])->name('customer-transaction-production');
    Route::get('/{hash_id}/transaction/{transaction_id}/confirm', [CustomerSiteController::class, 'customerTransactionConfirm'])->name('customer-transaction-confirm');

    Route::get('/{hash_id}/transaction/{transaction_id}/mockup/revision', [CustomerSiteController::class, 'customerTransactionMockupRevision'])->name('customer-transaction-mockup-revision');
    Route::get('/{hash_id}/transaction/{transaction_id}/sample/revision', [CustomerSiteController::class, 'customerTransactionSampleRevision'])->name('customer-transaction-sample-revision');
});
Route::get('/dashboard', function () {
    return redirect(route('dashboard'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');


    Route::prefix('material')->name('material.')->group(function () {
        Route::get('index', [MaterialController::class, 'index'])->name('index');
        Route::get('create', [MaterialController::class, 'create'])->name('create');
        Route::get('edit/{id}', [MaterialController::class, 'edit'])->name('edit');

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
        Route::get('show/{id}', [ProductController::class, 'show'])->name('show');

        Route::get('category', [ProductController::class, 'category'])->name('category');
        Route::get('category/create', [ProductController::class, 'categoryCreate'])->name('category.create');
        Route::get('category/edit/{id}', [ProductController::class, 'categoryEdit'])->name('category.edit');
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

    Route::prefix('cooperative')->name('cooperative.')->group(function () {
        Route::get('', [CooperativeController::class, 'index'])->name('index');
        Route::get('create', [CooperativeController::class, 'create'])->name('create');
        Route::get('edit/{id}', [CooperativeController::class, 'edit'])->name('edit');

        Route::get('credit-employee', [CooperativeController::class, 'creditEmployee'])->name('credit-employee');
        Route::get('credit-employee/create', [CooperativeController::class, 'creditEmployeeCreate'])->name('credit-employee-create');
        Route::get('credit-employee/edit/{id}', [CooperativeController::class, 'creditEmployeeEdit'])->name('credit-employee-edit');

        Route::get('credit-employee/detail/{user}', [CooperativeController::class, 'creditEmployeeDetail'])->name('credit-employee-detail');
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
        Route::get('edit/{id}', [ShipperController::class, 'edit'])->name('edit');
    });

    Route::prefix('mutation-status')->name('mutation-status.')->group(function () {
        Route::get('', [MutationStatusController::class, 'index'])->name('index');
        Route::get('create', [MutationStatusController::class, 'create'])->name('create');
        Route::get('edit/{id}', [MutationStatusController::class, 'edit'])->name('edit');
    });

    Route::prefix('partner')->name('partner.')->group(function () {
        Route::get('', [PartnerController::class, 'index'])->name('index');
        Route::get('create', [PartnerController::class, 'create'])->name('create');
        Route::get('edit/{id}', [PartnerController::class, 'edit'])->name('edit');
        Route::get('category', [PartnerController::class, 'category'])->name('category');
        Route::get('category/create', [PartnerController::class, 'categoryCreate'])->name('category.create');
        Route::get('category/edit/{id}', [PartnerController::class, 'categoryEdit'])->name('category.edit');
    });

    Route::prefix('supplier')->name('supplier.')->group(function () {
        Route::get('', [SupplierController::class, 'index'])->name('index');
        Route::get('create', [SupplierController::class, 'create'])->name('create');
        Route::get('edit/{id}', [SupplierController::class, 'edit'])->name('edit');
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
        Route::get('weight/{id}', [TransactionController::class, 'weightEdit'])->name('weight-edit');
        Route::get('shipper/{id}', [TransactionController::class, 'shipperEdit'])->name('shipper-edit');

        Route::get('pattern-site', [TransactionController::class, 'patternSite'])->name('pattern-site');

        Route::get('sample-site', [TransactionController::class, 'sampleSite'])->name('sample-site');
        Route::get('sample-site/resi/{id}', [TransactionController::class, 'sampleSiteResi'])->name('sample-site.resi');
        Route::get('sample-site/image/{id}', [TransactionController::class, 'sampleSiteImage'])->name('sample-site.image');
        Route::get('sample-site/image/{id}/download', [TransactionController::class, 'sampleSiteImageDownload'])->name('sample-site.image.download');

        Route::get('/production', function () {
            return redirect(\route('transaction.production.tab', 'Potong'));
        })->name('production');

        Route::get('production/tab/{tab}', [TransactionController::class, 'productionTab'])->name('production.tab');

        Route::get('download/{id}', [TransactionController::class, 'download'])->name('download');
        Route::get('download/{id}/new-order', [TransactionController::class, 'downloadNewOrder'])->name('download-new-order');
        Route::get('download/{id}/kwitansi', [TransactionController::class, 'downloadKwitansi'])->name('download-kwitansi');
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

        Route::get('', [SalaryController::class, 'index'])->name('index');
        Route::get('create', [SalaryController::class, 'create'])->name('create');
        Route::get('edit/{id}', [SalaryController::class, 'edit'])->name('edit');

        Route::get('download/{id}', [SalaryController::class, 'download'])->name('download');
    });

    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::get('', [AttendanceController::class, 'index'])->name('index');
        Route::get('create', [AttendanceController::class, 'create'])->name('create');
        Route::get('edit/{id}', [AttendanceController::class, 'edit'])->name('edit');
        Route::get('show/{id}', [AttendanceController::class, 'show'])->name('show');
        Route::get('show/{id}/create', [AttendanceController::class, 'createAttendance'])->name('create-attendance');
        Route::get('show/{id}/edit/{attendanceId}', [AttendanceController::class, 'editAttendance'])->name('edit-attendance');
        Route::get('show/user-attendance/{user}', [AttendanceController::class, 'userAttendance'])->name('user-attendance');
    });

    Route::prefix('finance')->name('finance.')->group(function () {

        Route::get('journal', [FinanceController::class, 'journal'])->name('journal');
        Route::get('journal/create', [FinanceController::class, 'journalCreate'])->name('journal.create');
        Route::get('journal/edit/{id}', [FinanceController::class, 'journalEdit'])->name('journal.edit');

        Route::get('account-names', [FinanceController::class, 'accountNames'])->name('account-names');
        Route::get('account-names/create', [FinanceController::class, 'accountNamesCreate'])->name('account-names.create');
        Route::get('account-names/edit/{id}', [FinanceController::class, 'accountNamesEdit'])->name('account-names.edit');

        Route::get('account-opening-balance', [FinanceController::class, 'accountOpeningBalance'])->name('account-opening-balance');
        Route::get('account-opening-balance/create', [FinanceController::class, 'accountOpeningBalanceCreate'])->name('account-opening-balance.create');
        Route::get('account-opening-balance/edit/{id}', [FinanceController::class, 'accountOpeningBalanceEdit'])->name('account-opening-balance.edit');

        Route::get('petty-cash', [FinanceController::class, 'pettyCash'])->name('petty-cash');
        Route::get('petty-cash/create', [FinanceController::class, 'pettyCashCreate'])->name('petty-cash.create');
        Route::get('petty-cash/edit/{id}', [FinanceController::class, 'pettyCashEdit'])->name('petty-cash.edit');

        Route::get('big-cash', [FinanceController::class, 'bigCash'])->name('big-cash');
        Route::get('big-cash/create', [FinanceController::class, 'bigCashCreate'])->name('big-cash.create');
        Route::get('big-cash/edit/{id}', [FinanceController::class, 'bigCashEdit'])->name('big-cash.edit');

        Route::get('transaction', [FinanceController::class, 'transaction'])->name('transaction');
        Route::get('transaction-history', [FinanceController::class, 'transactionHistory'])->name('transaction-history');
        Route::get('transaction/payment/{id}', [FinanceController::class, 'transactionPayment'])->name('transaction.payment');
        Route::get('transaction/payment/detail/{id}', [FinanceController::class, 'transactionPaymentDetail'])->name('transaction.payment.detail');

        Route::get('ledger', [FinanceController::class, 'ledger'])->name('ledger');
        Route::get('balance-sheet', [FinanceController::class, 'balanceSheet'])->name('balance-sheet');
        Route::get('worksheet', [FinanceController::class, 'worksheet'])->name('worksheet');
        Route::get('calc-balance', [FinanceController::class, 'calcBalance'])->name('calc-balance');
        Route::get('profit-and-loss', [FinanceController::class, 'profitAndLoss'])->name('profit-and-loss');
        Route::get('calc-profit-and-loss', [FinanceController::class, 'calcProfitAndLoss'])->name('calc-profit-and-loss');
    });

});
