<?php

namespace App\Livewire\Material;

use App\Models\Material;
use App\Models\MaterialMutation as model;
use App\Models\MaterialMutationStatus;
use Carbon\Carbon;
use Livewire\Component;

class MaterialMutation extends Component
{
    public $dataId;

    public $date;

    public $note;

    public $value;

    public $mutation_status = 1;

    public $amount;

    public $optionMutationStatus;

    public function mount()
    {
        $this->date = Carbon::now()->format('Y-m-d');
        $this->optionMutationStatus = [];
        foreach (MaterialMutationStatus::get() as $item) {
            $operator = 'No change';
            if ($item->operation == 1) {
                $operator = '+';
            } elseif ($item->operation == -1) {
                $operator = '-';
            }
            $this->optionMutationStatus[] = [
                'value' => $item->id, 'title' => $item->title." ($operator)",
            ];
        }
    }

    public function create()
    {

        $material = Material::find($this->dataId);
        $operator = MaterialMutationStatus::find($this->mutation_status);
        $lastStock = $material->stock + ($operator->operation * $this->amount);
        if ($material != null) {
            if ($this->mutation_status==2){
                $material->update([
                    'stock' => $lastStock,
                    'value' => $material->value + ($this->value*$this->amount),
                ]);
            }else{
                $material->update([
                    'stock' => $lastStock,
                    'value' => $material->value + (($operator->operation * $this->amount) * ($material->value / $material->stock)),
                ]);
            }

        }

        model::create([
            'material_id' => $this->dataId,
            'material_mutation_status_id' => $this->mutation_status,
            'reference' => $operator->title.' pada tanggal '.$this->date,
            'note' => $this->note,
            'amount' => $this->amount,
            'value' => $this->value ?? null,
            'stock' => $lastStock,
        ]);

        $this->redirect(route('material.material-stock', $this->dataId));
    }

    public function render()
    {
        return view('livewire.material.material-mutation');
    }
}
