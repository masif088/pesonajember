<?php

namespace App\Livewire\Transaction;

use App\Models\Customer;
use App\Models\PaymentModel;
use App\Models\Product;
use App\Models\Shipper;
use App\Models\Transaction;
use App\Models\TransactionList;
use App\Models\TransactionStatus;
use App\Models\TransactionStatusAttachment;
use Carbon\Carbon;
use Livewire\Component;

class TransactionForm extends Component
{
    public $productFormLayout = false;

    public $shipperFormLayout = false;

    public $optionProducts;

    public $tax = 0;

    public $total = 0;

    public $note = '';

    public $transactionLists = [];

    public $transactionList = [
        'product_id' => null,
        'transaction_detail_type_id' => null,
        'shipper_category' => null,
        'shipper_id' => null,
        'amount' => 0,
        'price' => 0,

    ];

    public $optionShippers;

    public $optionPaymentModels;

    public $paymentModel;

    public $customer;

    public $optionCustomers;

    public $optionShipperCategories;

    public function mount()
    {
        $this->optionPaymentModels = eloquent_to_options(PaymentModel::get());
        $this->optionCustomers = [];
        foreach (Customer::get() as $c) {
            $this->optionCustomers[] = [
                'value' => $c->id,
                'title' => "$c->uid - $c->name - $c->email ($c->city $c->district)",
            ];
        }
        $this->optionShipperCategories = [
            ['value' => 'Pengiriman produk', 'title' => 'Pengiriman produk'],
            ['value' => 'Pengiriman sampel', 'title' => 'Pengiriman sample'],
        ];
        $this->optionShippers = eloquent_to_options(Shipper::get());
        $this->optionProducts = [];
        foreach (Product::get() as $product) {
            $this->optionProducts[] = [
                'value' => $product->id, 'title' => $product->code.' - '.$product->productCategory->title.' - '.$product->title.' (Rp. '.thousand_format($product->price).')',
            ];
        }
        $this->dispatch('select2dispatch');
    }

    public function create()
    {
        $now = Carbon::now();
        $count = Transaction::whereMonth('created_at', '=', $now->month)->get()->count();
        $transaction = Transaction::create([
            'customer_id' => $this->customer,
            'payment_model_id' => $this->paymentModel,
            'total_money' => $this->total,
            'note' => $this->note,
            'tax' => $this->tax,
            'uid' => $now->format('Ymd').(str_pad(($count + 1), 4, '0', STR_PAD_LEFT)),
        ]);

        $total = 0;
        foreach ($this->transactionLists as $tl) {
            if ($tl['transaction_detail_type_id'] == 1 && $tl['shipper_id'] != null) {
                TransactionList::create([
                    'transaction_detail_type_id' => $tl['transaction_detail_type_id'],
                    'product_id' => null,
                    'shipper_id' => $tl['shipper_id'],
                    'shipper_category' => $tl['shipper_category'],
                    'amount' => $tl['amount'],
                    'price' => $tl['price'],
                    'transaction_id' => $transaction->id,

                    'status_id' => 1,
                ]);
                $total += ($tl['price']);
            } elseif ($tl['transaction_detail_type_id'] == 2 && $tl['product_id'] != null) {
                TransactionList::create([
                    'transaction_detail_type_id' => $tl['transaction_detail_type_id'],
                    'product_id' => $tl['product_id'],
                    'shipper_id' => null,
                    'shipper_category' => null,
                    'amount' => $tl['amount'],
                    'price' => $tl['price'],
                    'transaction_id' => $transaction->id,

                    'status_id' => 1,
                ]);
                $total += ($tl['price'] * $tl['amount']);
            }
        }
        $ts = TransactionStatus::create([
            'transaction_id' => $transaction->id,
            'transaction_status_type_id' => 1,
        ]);
        TransactionStatusAttachment::create([
            'transaction_status_id' => $ts->id,
            'key' => 'status document',
            'value' => 'Lakukan penagihan',
            'type' => 'string',
        ]);
        Transaction::find($transaction->id)->update(['total_money' => $total, 'transaction_status_id' => $ts->id]);
        $this->redirect(route('transaction.index', 'Penagihan'));
    }

    public function shipperFormLayoutSet()
    {
        $this->shipperFormLayout = ! $this->shipperFormLayout;
        $this->dispatch('select2dispatch');
        $this->transactionList = [
            'transaction_detail_type_id' => 1,
            'shipper_category' => 'Pengiriman produk',
            'shipper_id' => null,
            'amount' => 0,
            'price' => 0,
            'product_id' => null,
        ];
    }

    public function productFormLayoutSet()
    {
        $this->productFormLayout = ! $this->productFormLayout;
        $this->dispatch('select2dispatch');
        $this->transactionList = [
            'transaction_detail_type_id' => 2,
            'shipper_category' => null,
            'shipper_id' => null,
            'amount' => 0,
            'price' => 0,
            'product_id' => null,
        ];
    }

    public function addTransactionDetail()
    {
        $this->transactionLists[] = $this->transactionList;
        $this->transactionList = [
            'transaction_detail_type_id' => null,
            'shipper_category' => null,
            'shipper_id' => null,
            'amount' => 0,
            'price' => 0,
            'product_id' => null,
        ];
        $this->productFormLayout = false;
        $this->shipperFormLayout = false;
    }

    public function overlay()
    {
        $this->productFormLayout = false;
        $this->shipperFormLayout = false;
    }

    public function removeList($index)
    {
        unset($this->transactionLists[$index]);
    }

    public function render()
    {
        return view('livewire.transaction.transaction-form');
    }
}
