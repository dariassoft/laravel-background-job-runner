
## About Laravel Background Job Runner

This is a Laravel Sail implementation,


## Requirements
You need to have docker, composer, and php installed, if you need you check how to:
https://laravel.com/docs/11.x#installing-php

## Setup
- **Clon GitHub Repository https://github.com/dariassoft/laravel-background-job-runner**
- **Execute this commands:**
  - cd laravel-background-job-runner 
  - npm install && npm run build
  - composer install
  - cp .env.example .env

Create an alias to ./vendor/bin/sail
  - sail up -d
  - sail artisan migrate
  - sail composer dump-autoload

If you don't create an alias, need to use: 
- ./vendor/bin/sail ...
****

## Whitelist Classes Configuration for Security


To ensure only certain classes are allowed, add a configuration file for whitelisting.
- Edit File: config/background_jobs.php

## Check Logs

Check storage/logs/background_jobs_errors.log for errors and storage/logs/laravel.log for success logs.

## Summary of File Paths

- app/Jobs/BackgroundJobRunner.php: Contains the core background job logic.
- config/logging.php: Define custom log channels.
- app/Helpers/helpers.php: Define helper functions.
- app/Console/Commands/ExecuteJobCommand.php: Command to execute jobs in the background.
- config/background_jobs.php: Configuration file to whitelist allowed classes.

## Run the Background Job Command
Example:
 - sail artisan job:execute-job App\\Jobs\\Test1 play --params=p1,p2

