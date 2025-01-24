<?php

namespace App\Livewire\Backup\Attendance;

use App\Models\Attendance;
use App\Models\GeneralInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class DashboardAttendance extends Component
{
    public $statusEntrance = 0;

    public $statusDischarge = 0;

    public $check;

    public $holiday = 0;

    public function mount()
    {

        $check = Attendance::where('user_id', '=', auth()->id())->whereHas('master', function (Builder $q) {
            $q->where('attendance_date', '=', Carbon::now()->format('Y-m-d'));
        })->first();
        if ($check != null) {
            if ($check->entrance_attendance_by_web != null) {
                $this->statusEntrance = 1;
            }
            if ($check->discharge_attendance_by_web != null) {
                $this->statusDischarge = 1;
            }
            $this->check = $check;
        }
    }

    public function entrance()
    {
        $check = Attendance::where('user_id', '=', auth()->id())->whereHas('master', function (Builder $q) {
            $q->where('attendance_date', '=', Carbon::now()->format('Y-m-d'));
        })->first();
        $attendanceStatus = 1;
        if (GeneralInfo::where('jam_masuk') > Carbon::now()->format('H:i')) {
            $attendanceStatus = 6;
        }
        if ($check != null) {
            $check->update([
                'attendance_status_id' => $attendanceStatus,
                'entrance_attendance_by_web' => Carbon::now(),
            ]);
        } else {
            Attendance::create([
                'user_id' => auth()->id(),
                'master_id' => \App\Models\AttendanceMaster::where('attendance_date', '=', Carbon::now()->format('Y-m-d'))->first()->id,
                'attendance_status_id' => $attendanceStatus,
                'entrance_attendance_by_web' => Carbon::now(),
            ]);
        }

        $check = Attendance::where('user_id', '=', auth()->id())->whereHas('master', function (Builder $q) {
            $q->where('attendance_date', '=', Carbon::now()->format('Y-m-d'));
        })->first();
        if ($check != null) {
            if ($check->entrance_attendance_by_web != null) {
                $this->statusEntrance = 1;
            }
            if ($check->discharge_attendance_by_web != null) {
                $this->statusDischarge = 1;
            }
            $this->check = $check;
        }
        $this->render();
    }

    public function discharge()
    {
        $check = Attendance::where('user_id', '=', auth()->id())->whereHas('master', function (Builder $q) {
            $q->where('attendance_date', '=', Carbon::now()->format('Y-m-d'));
        })->first();
        $attendanceStatus = 1;
        if (GeneralInfo::where('jam_masuk') > Carbon::now()->format('H:i')) {
            $attendanceStatus = 6;
        }
        if ($check != null) {
            $check->update([
                'attendance_status_id' => $attendanceStatus,
                'entrance_attendance_by_web' => Carbon::now(),
            ]);
        } else {
            Attendance::create([
                'user_id' => auth()->id(),
                'master_id' => \App\Models\AttendanceMaster::where('attendance_date', '=', Carbon::now()->format('Y-m-d'))->first()->id,
                'attendance_status_id' => $attendanceStatus,
                'entrance_attendance_by_web' => Carbon::now(),
            ]);
        }

        $check = Attendance::where('user_id', '=', auth()->id())->whereHas('master', function (Builder $q) {
            $q->where('attendance_date', '=', Carbon::now()->format('Y-m-d'));
        })->first();
        if ($check != null) {
            if ($check->entrance_attendance_by_web != null) {
                $this->statusEntrance = 1;
            }
            if ($check->discharge_attendance_by_web != null) {
                $this->statusDischarge = 1;
            }
            $this->check = $check;
        }

        $this->render();
    }

    public function render()
    {
        return view('livewire.attendance.dashboard-attendance');
    }
}
