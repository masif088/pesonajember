<?php

namespace App\Console\Commands\SendMail;

use App\Mail\Attendance\AttendanceRemember;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Attendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmail:attendance';

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
        if (Carbon::now()->format('w') != 0) {
            foreach (User::get() as $user) {
                if ($user->nip != null) {
                    Mail::to($user->email)->send(new AttendanceRemember($user->id));
                }
            }
        }
    }
}
