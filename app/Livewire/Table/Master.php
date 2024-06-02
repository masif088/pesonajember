<?php

namespace App\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;

class Master extends Component
{
    use WithPagination;

    public $model;

    public $name;

    public $modelId;

    public $dataId;

    public $param1;

    public $param2;

    public $param3;

    public $data;

    public $dateSearch = false;

    public $extras = false;

    public $perPage = 10;

    public $sortField = 'id';

    public $sortAsc = false;

    public $search = '';

    protected $paginationTheme = 'tailwind';

    protected $listeners = ['deleteItem' => 'delete_item', 'delete' => 'delete',
        'refreshTable' => 'refresh', 'reRender' => 'render',
    ];

    public function refresh($month, $year)
    {
        $this->param1 = $month;
        $this->param2 = $year;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function deleteItem($id)
    {
        $this->data = $this->model::find($id);
        if (! $this->data) {
            $this->dispatch('deleteResult', ['status' => false, 'message' => 'Gagal menghapus data '.$this->name]);

            return;
        }
//        $this->dispatch('swal:alert',['title'=>'asd']);
        $this->dispatch('swal:confirm', data:[
            'icon' => 'warning',
            'title' => 'apakah anda yakin ingin menghapus data ini',
            'confirmText' => 'Hapus',
            'method' => 'delete',
        ]);

    }

    public function delete()
    {
        $this->data->delete();
        $this->dispatch('swal:alert', data:[
            'icon' => 'success',
            'title' => 'Berhasil menghapus data',
        ]);
    }

    public function render()
    {
        $data = $this->get_pagination_data();

        return view('livewire.table.master', $data);
    }

    public function get_pagination_data()
    {
        $this->model = "\App\Repository\View\\$this->name";
        $this->model = new $this->model();
        $data = $this->model::tableSearch(['query' => $this->search, 'param1' => $this->param1, 'param2' => $this->param2, 'param3' => $this->param3])
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        if ($this->perPage == -1) {
            $data = $data->get();
        } else {
            $data = $data->paginate($this->perPage);
        }

        $return = $this->model::tableView();
        $return['datas'] = $data;

        return $return;
    }
}
