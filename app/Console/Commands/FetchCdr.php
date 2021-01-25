<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CronMaster;

class FetchCdr extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch_cdr:auto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Call Data Records!';

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
     * @return int
     */
    public function handle()
    {
        $cron=new CronMaster();
        $cron->fetch_cdr();
    }
}
