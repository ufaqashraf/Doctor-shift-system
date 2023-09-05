<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class Timesheet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:timesheet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To Send Message Do not forget to submit timesheet after 1 hour expiry of job time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $user = User::all();

        foreach ($user as $a)
        {
            //use push notifcation logic for submit timesheet here
        }

        $this->info('Hourly Update has been sent successfully');


    }
}
