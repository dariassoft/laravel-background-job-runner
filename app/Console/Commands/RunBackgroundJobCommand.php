<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RunBackgroundJobCommand extends Command
{
    protected $signature = 'job:run-background {class} {method} {--params=*}';
    protected $description = 'Run a job in the background';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $class = $this->argument('class');
        $method = $this->argument('method');
        $parameters = $this->option('params');

        $this->runInBackground($class, $method, $parameters);
    }

    protected function runInBackground($class, $method, $parameters)
    {

        $command = "php " . base_path('artisan') . " job:execute-job {$class} {$method} " . implode(' ', $parameters) . " > /dev/null 2>&1 &";
        Log::channel('background_jobs_errors')->error("Job executed: {$command}");
        exec($command);
    }
}
