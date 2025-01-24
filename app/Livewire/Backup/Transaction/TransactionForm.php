<?php

namespace App\Livewire\Backup\Transaction;

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
    public $dataId;

    public $action = 'create';

    public $productFormLayout = false;

    public $shipperFormLayout = false;

    public $optionProducts;

    public $tax = 0;

    public $dateTransaction;

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
        'transaction_id' => null,
    ];

    public $transactionListId = null;

    public $optionShippers;

    public $optionPaymentModels;

    public $paymentModel;

    public $customer;

    public $transactionListUid = [];

    public $optionCustomers;

    public $optionShipperCategories;

    public function mount()
    {
        $this->dateTransaction = Carbon::now()->format('Y-m-d');
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
        if ($this->dataId != null) {
            $transaction = Transaction::find($this->dataId);
            $this->customer = $transaction->customer_id;
            $this->total = $transaction->total_money;
            $this->note = $transaction->note;
            $this->tax = $transaction->tax;
            $this->paymentModel = $transaction->payment_model_id;
            $this->dateTransaction = $transaction->created_at->format('Y-m-d');

            $this->transactionLists = [];

            foreach ($transaction->transactionLists->where('edit_count', $transaction->edit_count) as $tl) {
                $this->transactionLists[] = [
                    'product_id' => $tl->product_id ?? null,
                    'transaction_detail_type_id' => $tl->transaction_detail_type_id,
                    'shipper_category' => $tl->product_id ?? null,
                    'shipper_id' => $tl->shipper_id ?? null,
                    'amount' => $tl->amount,
                    'price' => $tl->price,
                    'transaction_id' => $tl->transaction_id ?? null,
                ];
                $this->transactionListUid[] = [
                    'product_id' => $tl->product_id,
                    'uid' => $tl->uid,
                    'transaction_status_id' => $tl->transaction_status_id,
                    'status' => true,
                ];

            }
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
            'created_at' => $this->dateTransaction.' '.Carbon::now()->format('H:i:s'),
        ]);

        $tsa = TransactionStatus::create([
            'transaction_id' => $transaction->id,
            'transaction_status_type_id' => 1,
            'created_at' => $this->dateTransaction.' '.Carbon::now()->format('H:i:s'),
        ]);

        TransactionStatusAttachment::create([
            'transaction_status_id' => $tsa->id,
            'key' => 'status document',
            'value' => 'Lakukan penagihan',
            'type' => 'string',
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
                    'uid' => quickRandom(10),
                ]);
                $total += ($tl['price']);
            } elseif ($tl['transaction_detail_type_id'] == 2 && $tl['product_id'] != null) {
                $tl = TransactionList::create([
                    'transaction_detail_type_id' => $tl['transaction_detail_type_id'],
                    'product_id' => $tl['product_id'],
                    'shipper_id' => null,
                    'shipper_category' => null,
                    'amount' => $tl['amount'],
                    'price' => $tl['price'],
                    'transaction_id' => $transaction->id,
                    'status_id' => 1,
                    'uid' => quickRandom(10),
                ]);



//                $ts = TransactionStatus::create([
//                    'transaction_status_type_id' => 3,
//                    'transaction_id' => $transaction->id,
//                    'transaction_list_id' => $tl->id,
//                ]);
//                TransactionList::find($tl->id)->update(
//                    ['transaction_status_id' => $ts->id]
//                );

                $total += ($tl['price'] * $tl['amount']);
            }
        }
        Transaction::find($transaction->id)->update(['total_money' => $total, 'transaction_status_id' => $tsa->id]);

        $this->redirect(route('transaction.index', 'Penagihan'));
    }

    public function update(): void
    {
        $now = Carbon::now();

        $transaction = Transaction::find($this->dataId);
        $editCount = $transaction->edit_count + 1;
        $total = 0;
        foreach ($this->transactionLists as $tl) {

            $uid = quickRandom(10);
            $transaction_status_id = null;

            $newTL = true;

            foreach ($this->transactionListUid as $index => $tluid) {
                if ($tluid['product_id'] == $tl['product_id'] && $tluid['status']) {
                    $uid = $tluid['uid'];
                    $this->transactionListUid[$index]['status'] = false;
                    $transaction_status_id = $tluid['transaction_status_id'];
                    $newTL = false;
                    break;
                }
            }

            $tl = TransactionList::create([
                'transaction_detail_type_id' => $tl['transaction_detail_type_id'],
                'product_id' => $tl['product_id'] ?? null,
                'shipper_id' => $tl['shipper_id'] ?? null,
                'shipper_category' => $tl['shipper_category'] ?? null,
                'amount' => $tl['amount'],
                'price' => $tl['price'],
                'transaction_id' => $transaction->id,
                'status_id' => 1,
                'edit_count' => $editCount,
                'uid' => $uid,
                'transaction_status_id' => $transaction_status_id,
            ]);

            if ($newTL && $tl['product_id'] != null) {
                if ($transaction->transaction_status_type_id==14){
                    $ts = TransactionStatus::create([
                        'transaction_status_type_id' => 3,
                        'transaction_id' => $transaction->id,
                        'transaction_list_id' => $tl->id,
                    ]);
                    TransactionList::find($tl->id)->update(
                        ['transaction_status_id' => $ts->id]
                    );
                }
            }

            if ($tl['transaction_detail_type_id'] == 1) {
                $total += ($tl['price']);
            } elseif ($tl['transaction_detail_type_id'] == 2) {
                $total += ($tl['price'] * $tl['amount']);
            }
        }
        //        $ts = TransactionStatus::create([
        //            'transaction_id' => $transaction->id,
        //            'transaction_status_type_id' => 1,
        //        ]);
        //        TransactionStatusAttachment::create([
        //            'transaction_status_id' => $ts->id,
        //            'key' => 'status document',
        //            'value' => 'Lakukan penagihan',
        //            'type' => 'string',
        //        ]);
        $transaction->update(
            [
                'total_money' => $total,
                'edit_count' => $editCount,
                'created_at' => $this->dateTransaction,
                'customer_id' => $this->customer,
                'payment_model_id' => $this->paymentModel,
                'note' => $this->note,
                'tax' => $this->tax,
            ]);
        $this->redirect(route('transaction.index', 'Penagihan'));
    }

    public function shipperFormLayoutSet(): void
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

    public function productFormLayoutSet(): void
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

    public function addTransactionDetail(): void
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

    public function overlay(): void
    {
        $this->productFormLayout = false;
        $this->shipperFormLayout = false;
    }

    protected $listeners = ['removeList'=>'removeList'];

    public $indexDeleted;
    public function delete($index)
    {
        $this->indexDeleted=$index;
        $this->dispatch('swal:confirm', data: [
            'icon' => 'warning',
            'title' => 'apakah anda yakin ingin menghapus data ini',
            'confirmText' => 'Hapus',
            'method' => 'removeList',
        ]);
    }

    public function removeList(): void
    {
        unset($this->transactionLists[$this->indexDeleted]);
        $this->indexDeleted = null;
    }

    public function render()
    {
        return view('livewire.transaction.transaction-form');
    }
}
