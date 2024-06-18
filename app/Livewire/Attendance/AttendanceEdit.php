<?php

namespace App\Livewire\Attendance;

use App\Repository\Form\Attendance as model;
use Carbon\Carbon;
use Livewire\Component;

class AttendanceEdit extends Component
{
    public $form;

    public $action;
    public $master;

    public $dataId;

    public function mount()
    {
        $this->form = form_model(model::class,$this->dataId);
        $this->form['entrance_attendance_by_web'] = Carbon::parse($this->form['entrance_attendance_by_web'])->format('H:i');
        $this->form['discharge_attendance_by_web'] = Carbon::parse($this->form['discharge_attendance_by_web'])->format('H:i');
    }

    public function getRules()
    {
        return model::formRules();
    }

    public function create()
    {
//        dd($this->form);

        $this->validate();
        $this->resetErrorBag();

        model::create($this->form);

        $this->redirect(route('attendance.show',$this->master));
    }

    public function update()
    {


        $this->validate();
        $this->resetErrorBag();

        $this->form['entrance_attendance_by_web'] = Carbon::now()->format('Y-m-d'). ' '.$this->form['entrance_attendance_by_web'];
        $this->form['discharge_attendance_by_web'] = Carbon::now()->format('Y-m-d'). ' '.$this->form['discharge_attendance_by_web'];
        model::find($this->dataId)->update($this->form);
        $this->redirect(route('attendance.show',$this->master));
    }
    public function render()
    {
        return view('livewire.attendance.attendance-edit');
    }
}
