<?php

namespace App\Livewire\Mockup;

use App\Models\Order;
use App\Repository\Form\Mockup as model;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class MockupForm extends Component
{

    public $orderId;

    use WithFileUploads;

    public $form;

    public $dataId;

    public $action;
    public $indexPath;

    public function mount()
    {
        $this->form = form_model(model::class);
        $this->form['order_id'] = $this->orderId;
        if ($this->dataId) {
            $this->form = form_model(model::class, $this->dataId);
        }
    }

    public function getRules()
    {
        return model::formRules();
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();
        $this->mockup();
        model::create($this->form);
        $this->redirect(route('admin.order.show', $this->orderId));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        $this->mockup();
        model::find($this->dataId)->update($this->form);
        $this->redirect(route('admin.order.show', $this->orderId));
    }

    /**
     * @return void
     */
    public function mockup(): void
    {
        if ($this->form['mockup_file'] != null) {
            $order =  Order::find($this->orderId);
            $mockup = $this->form['mockup_file'];
            $filename = Str::slug($order->order_number.'-'.$this->form['title']) . '.' . $mockup->getClientOriginalExtension();
            $mockup->storeAs('public/mockup_file', $filename);
            $this->form['mockup_file'] = 'mockup_file/' . $filename;
        }
    }

    public function render()
    {
        return view('livewire.mockup.mockup-form');
    }
}
