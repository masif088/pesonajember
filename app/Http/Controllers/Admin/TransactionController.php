<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionList;
use App\Models\TransactionStatus;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class TransactionController extends Controller
{
    public function index($tab)
    {
        return view('admin.transaction.index', compact('tab'));
    }

    public function productionTab($tab)
    {
        return view('admin.transaction.production', compact('tab'));
    }

    public function edit($id)
    {
        return view('admin.transaction.edit', compact('id'));
    }

    public function processProduction()
    {
        return view('admin.transaction.process-production');
    }

    public function billingPage($id)
    {
        return view('admin.transaction.billing-page', compact('id'));
    }

    public function mockupSite()
    {
        return view('admin.transaction.production.mockup-site');
    }

    public function mockupSiteEdit($id)
    {
        return view('admin.transaction.production.mockup-site-edit', compact('id'));
    }

    public function mockupSiteDownload($id)
    {
        $transactionList = TransactionList::find($id);
        $transaction = $transactionList->transaction;
        $data = [
            'transaction' => $transaction,
            'transactionList' => $transactionList,
            'product' => $transaction,
        ];

        $pdf = Pdf::loadView('pdf.test', $data);

        return $pdf->download($transaction->uid.'-'.Carbon::now()->format('d-m-y').'.pdf');
    }

    public function picEdit($id)
    {
        return view('admin.transaction.pic-edit', compact('id'));
    }

    public function qcEdit($id)
    {
        return view('admin.transaction.qc-edit', compact('id'));
    }

    public function weightEdit($id)
    {
        return view('admin.transaction.weight-edit', compact('id'));
    }

    public function shipperEdit($id)
    {
        return view('admin.transaction.production.sample-site-resi', compact('id'));
    }

    public function patternSite()
    {
        return view('admin.transaction.production.pattern-site');
    }

    public function sampleSite()
    {
        return view('admin.transaction.production.sample-site');
    }

    public function sampleSiteResi($id)
    {
        return view('admin.transaction.production.sample-site-resi', compact('id'));
    }

    public function sampleSiteImage($id)
    {
        return view('admin.transaction.production.sample-site-image', compact('id'));
    }

    public function sampleSiteImageDownload($id)
    {
        $transactionStatus = TransactionStatus::find($id);
        $file = $transactionStatus->transactionStatusAttachments->where('key', 'photo mockup')->first();

        return response()->download(storage_path('/app/'.$file->value));
    }

    public function transactionChangeStatus($id, $status)
    {
        $ts = TransactionStatus::create([
            'transaction_id' => $id,
            'transaction_status_type_id' => $status,
        ]);
        Transaction::find($id)->update([
            'transaction_status_id' => $ts->id,
        ]);

        return redirect()->back();
    }

    public function create()
    {
        return view('admin.transaction.create');
    }

    public function download($id)
    {
        $data = [
            'transaction' => Transaction::find($id),
        ];
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.invoice', $data);

        return $pdf->stream();
    }

    public function downloadNewOrder($id)
    {
        $data = ['transaction' => Transaction::find($id)];
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.invoice-0', $data);

        return $pdf->stream();
    }

    public function downloadKwitansi($id)
    {
        $data = ['transaction' => Transaction::find($id)];
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.kwitansi', $data);

        return $pdf->stream();
    }
}
