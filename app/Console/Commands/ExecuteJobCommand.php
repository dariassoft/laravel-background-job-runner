<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\BackgroundJobRunner;

class ExecuteJobCommand extends Command
{
    protected $signature = 'job:execute-job {class} {method} {--params=*}';
    protected $description = 'Execute a background job';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $class = $this->argument('class');
        $method = $this->argument('method');
        $parameters = $this->option('params');

        $jobRunner = new BackgroundJobRunner($class, $method, $parameters);
        $jobRunner->run();
    }
}
