<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppRunCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run {run?}';


    public function handle()
    {
        match ($this->argument('run')) {
            'init' => $this->init(),
            'etl' => $this->etl(),
            'all' => $this->all(),
            default => $this->default(),
        };
    }

    private function default(): void
    {
        $this->info('** ' . __METHOD__);
    }

    private function all(): void
    {
        $this->info('** ' . __METHOD__);
        $this->init();
        $this->etl();
    }

    private function init(): void
    {
        $this->info('** ' . __METHOD__);
        $this->call('migrate:refresh');
        $this->call('db:seed');
    }

    private function etl(): void
    {
        $this->info('** ' . __METHOD__);
        $this->call('payment:etl', ['run' => 'all']);
        $this->call('enrolment:etl', ['run' => 'all']);
        $this->call('dynamics:etl', ['run' => 'all']);
    }


}
