<?php

namespace App\Console\Commands\SendMail;

use App\Mail\Transaction\NewOrderMail;
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
        for ($i = 0; $i < 2; $i++) {
            Mail::to('mokhamadasif@gmail.com')->send(new NewOrderMail());
        }

    }
}
