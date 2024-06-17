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
    public function customerTransactionConfirm($hash, $transaction)
    {
        return view('customer.customer-transaction-confirm', compact('hash', 'transaction'));
    }

    public function customerTransactionMockupRevision($hash, $transaction)
    {
    }

    public function customerTransactionSampleRevision($hash, $transaction)
    {
    }
}
