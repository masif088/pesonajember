<?php

namespace App\Livewire\Attendance;

use App\Models\User;
use Livewire\Component;

class AttendanceShowUser extends Component
{
    public $userId;
    public $user;
    public function mount()
    {
        $this->user = User::find($this->userId);
    }
    public function render()
    {
        return view('livewire.attendance.attendance-show-user');
    }
}
