<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LogClear extends Command
{
    protected $signature = 'log:clear';

    protected $description = 'Clears storage/logs/laravel.log';

    public function handle()
    {
        file_put_contents(storage_path('logs/laravel.log'), '');
    }
}
