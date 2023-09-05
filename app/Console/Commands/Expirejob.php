<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\Job;

class Expirejob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move job to expire when job date has been arrived and no one is hired on the job';

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
        $curr_Date = Date('Y-m-d');
        Job::where('overall_status', 'publish')->where('date', '<=' , $curr_Date )->update(['overall_status' => 'expire']);
        $this->info('Un attended jobs moved to expire');
    }
}
