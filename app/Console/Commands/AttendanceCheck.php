<?php

namespace App\Console\Commands;

use App\Models\AttendanceMaster;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AttendanceCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $am = AttendanceMaster::whereDate('attendance_date', Carbon::now())->first();
//        dd($am);
        if ($am != null) {
            if (Carbon::now()->dayOfWeek == 1) {
                foreach ($am->attendances as $attendance) {
                    if ($attendance->entrance_attendance_by_web == null) {
                        $attendance->update([
                            'attendance_status_id' => 4,
                        ]);
                    }
                }
            }
        }
    }
}
