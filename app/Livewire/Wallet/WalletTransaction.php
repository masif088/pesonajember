<?php

namespace App\Livewire\Wallet;

use App\Models\Wallet;
use App\Models\WalletDetail;
use Carbon\Carbon;
use Livewire\Component;

class WalletTransaction extends Component
{
    public $wallet;
    public $walletTransactions;
    public $dataId;

    public $month;
    public $year;

    public function mount(){
        $this->wallet = Wallet::find($this->dataId);
        $now = Carbon::now();
        $this->month = $now->month;
        $this->year = $now->year;
        $this->transaction();
    }

    public function transaction(){
        $this->walletTransactions = WalletDetail::where('wallet_id', $this->dataId)->whereMonth('date',$this->month)->whereYear('date', $this->year)->get();
    }
    public function getSaldo($id):int{
        $wd1 = WalletDetail::where('id','<=',$id)->where('wallet_id', $this->dataId)->sum('debit');
        $wd2 = WalletDetail::where('id','<=',$id)->where('wallet_id', $this->dataId)->sum('credit');
        return $wd1-$wd2;
    }


    public function nextMonth(){
        $this->month = $this->month+ 1;
        if($this->month > 12){
            $this->month = 1;
            $this->year = $this->year + 1;
        }
        $this->transaction();
    }

    public function prevMonth(){
        $this->month = $this->month - 1;
        if($this->month < 1){
            $this->month = 12;
            $this->year = $this->year - 1;
        }
        $this->transaction();
    }

    protected $listeners = ['deleteItem' => 'delete_item', 'delete' => 'delete',
        'refreshTable' => 'refresh',
        'reRender' => 'render',
        'alert' => 'alert',
    ];
    public $data;
    public function deleteItem($id)
    {
        $this->data = WalletDetail::find($id);
        if (! $this->data) {
            $this->dispatch('deleteResult', ['status' => false, 'message' => 'Gagal menghapus data '.$this->name]);
            return;
        }
        $this->dispatch('swal:confirm', data: [
            'icon' => 'warning',
            'title' => 'apakah anda yakin ingin menghapus data ini',
            'confirmText' => 'Hapus',
            'method' => 'delete',
        ]);

    }

    public function delete()
    {
        try {
            if ($this->data!=null){
                $this->data->delete();
            }

            $this->dispatch('swal:alert', data: [
                'icon' => 'success',
                'title' => 'Berhasil menghapus data',
            ]);
        }catch (\Exception $exception){
            $this->dispatch('swal:alert', data: [
                'icon' => 'error',
                'title' => 'Gagal menghapus data',
            ]);
        }
        $this->transaction();


    }

    public function render()
    {
        return view('livewire.wallet.wallet-transaction');
    }
}
