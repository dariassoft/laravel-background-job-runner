<?php

namespace App\Jobs;

use Exception;
use Illuminate\Support\Facades\Log;

class BackgroundJobRunner
{
    protected $class;
    protected $method;
    protected $parameters;
    protected $whitelistedClasses;

    public function __construct($class, $method, $parameters = [])
    {
        $this->class = $class;
        $this->method = $method;
        $this->parameters = $parameters;
        $this->whitelistedClasses = config('background_jobs.whitelisted_classes');
    }

    public function run()
    {
        try {
            // Check if the class is in the whitelist
            if (!in_array($this->class, $this->whitelistedClasses, true)) {
                Log::channel('background_jobs_errors')->error("Unauthorized attempt to execute: {$this->class}");
                throw new Exception("Unauthorized class: {$this->class}");
            }

            // Proceed to execute if class is whitelisted
            if (!class_exists($this->class)) {
                throw new Exception("Class {$this->class} not found.");
            }

            $jobInstance = new $this->class(...$this->parameters);

            if (!method_exists($jobInstance, $this->method)) {
                throw new Exception("Method {$this->method} does not exist on class {$this->class}.");
            }
            $parameters = serialize($this->parameters);
            Log::channel('background_jobs_success')->info("Job executed: {$this->class}@{$this->method}");
            return $jobInstance->{$this->method}($this->parameters);

        } catch (Exception $e) {
            // Log the error
            Log::channel('background_jobs_errors')->error("Job failed: {$this->class}@{$this->method} - {$e->getMessage()}");
        }
    }
}
