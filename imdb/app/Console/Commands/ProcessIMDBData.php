<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessIMDBDataJob;

class ProcessIMDBData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imdb:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process free data from IMDB API, 1000 per day';

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
     * @return void
     */
    public function handle()
    {
        ProcessIMDBDataJob::dispatch();
        $this->info('IMDB data processing job dispatched.');
    }
}
