<?php

namespace App\Console\Commands;

use App\Models\AttendanceMaster;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class attendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance';

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
        $am = AttendanceMaster::whereDate('attendance_date',Carbon::now())->first();
        if ($am==null){
            if (Carbon::now()->dayOfWeek!=0){
                $am = AttendanceMaster::create([
                    'attendance_date' => Carbon::now(),
                    'status' => 'Hari Kerja'
                ]);
                foreach (User::get() as $user){
                    \App\Models\Attendance::create([
                        'master_id' => $am->id,
                        'user_id' => $user->id,
                        'attendance_status_id' => 7,
                    ]);
                }
            }else{
                $am = AttendanceMaster::create([
                    'attendance_date' => Carbon::now(),
                    'status' => 'Akhir Pekan'
                ]);
            }
        }
    }
}
