<?php

use App\Jobs\BackgroundJobRunner;

if (!function_exists('runBackgroundJob')) {
    function runBackgroundJob($class, $method, $parameters = [])
    {
        $jobRunner = new BackgroundJobRunner($class, $method, $parameters);
        $jobRunner->run();
    }
}
