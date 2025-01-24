<?php

namespace App\Livewire\Backup\Attendance;

use Livewire\Component;

class AttendanceShow extends Component
{
    public $attendanceId;
    public $attendanceMaster;

    public function mount()
    {
        $this->attendanceMaster = \App\Models\AttendanceMaster::find($this->attendanceId);

    }

    public function render()
    {
        return view('livewire.attendance.attendance-show');
    }
}
