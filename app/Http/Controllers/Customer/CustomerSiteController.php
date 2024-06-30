<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class CustomerSiteController extends Controller
{
    public function customerDashboard($hash)
    {
        return view('customer.index', compact('hash'));
    }

    public function customerTransactionProduction($hash, $transaction)
    {
        return view('customer.customer-transaction-production', compact('hash', 'transaction'));
    }
    public function customerTransactionConfirm($hash, $transaction,$transactionList)
    {
        return view('customer.customer-transaction-confirm', compact('hash', 'transaction','transactionList'));
    }

    public function customerTransactionMockupRevision($hash, $transaction)
    {
    }

    public function customerTransactionSampleRevision($hash, $transaction)
    {
    }

    public function customerTransactionDownloadPdf($path)
    {
//        dd(storage_path('/storage/app/'.base64_decode($path)));
        return response()->download(storage_path('/app/'.base64_decode($path)));
    }
}
